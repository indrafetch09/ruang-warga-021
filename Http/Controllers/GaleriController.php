<?php

namespace App\Controllers;

use Core\App;
use Core\Database;
use Core\Session;
use Core\Csrf;
use App\Models\Galeri;

class GaleriController
{
    /**
     * 1. Menampilkan Halaman Galeri Foto (Sisi Publik & Admin)
     */
    public function index()
    {
        $kategori = $_GET['kategori'] ?? '';

        if (!empty($kategori)) {
            $galeriList = Galeri::where('kategori', $kategori);
        } else {
            $galeriList = Galeri::all();
        }

        return view('user/galeri.php', [
            'galeriList' => $galeriList,
            'kategori'   => $kategori
        ]);
    }

    /**
     * 2. Menampilkan Form Tambah Galeri (Khusus Admin)
     */
    public function create()
    {
        $db = App::resolve(Database::class);
        $recentGaleri = $db->query("SELECT * FROM " . (Galeri::$table ?? 'galeri') . " ORDER BY created_at DESC LIMIT 6")->get();

        return view('admin/tambah-galeri.php', [
            'recentGaleri' => $recentGaleri
        ]);
    }

    /**
     * 3. Memproses Simpan Data & Upload Foto Galeri Baru
     */
    public function store()
    {
        // 1. Verifikasi CSRF
        if (!Csrf::verify($_POST['_csrf_token'] ?? null)) {
            Session::flash('error', 'Sesi keamanan telah kadaluarsa. Silakan coba lagi.');
            Session::flash('old', $_POST);
            return redirect('/admin/galeri/create');
        }

        $db = App::resolve(Database::class);

        // 2. Validasi Kategori sesuai ENUM MySQL
        $allowedKategori = ['sosial', 'perayaan', 'kesehatan', 'pertemuan', 'lainnya'];
        $kategoriInput   = $_POST['kategori'] ?? '';

        if (!in_array($kategoriInput, $allowedKategori)) {
            Session::flash('error', 'Silakan pilih kategori kegiatan yang valid.');
            Session::flash('old', $_POST);
            return redirect('/admin/galeri/create');
        }

        // 3. Process Upload Foto
        $fileName = null;

        if (isset($_FILES['foto_file']) && $_FILES['foto_file']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = base_path('public/uploads/galeri/');

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileExtension     = strtolower(pathinfo($_FILES['foto_file']['name'], PATHINFO_EXTENSION));
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];

            if (!in_array($fileExtension, $allowedExtensions)) {
                Session::flash('error', 'Format foto tidak diizinkan. Hanya menerima JPG, JPEG, PNG, atau WEBP.');
                Session::flash('old', $_POST);
                return redirect('/admin/galeri/create');
            }

            if ($_FILES['foto_file']['size'] > 10485760) {
                Session::flash('error', 'Ukuran foto maksimal 10MB.');
                Session::flash('old', $_POST);
                return redirect('/admin/galeri/create');
            }

            $fileName   = uniqid('galeri_') . '.' . $fileExtension;
            $targetFile = $uploadDir . $fileName;

            if (!move_uploaded_file($_FILES['foto_file']['tmp_name'], $targetFile)) {
                Session::flash('error', 'Sistem gagal memindahkan file unggahan.');
                Session::flash('old', $_POST);
                return redirect('/admin/galeri/create');
            }
        } else {
            Session::flash('error', 'File foto wajib diunggah!');
            Session::flash('old', $_POST);
            return redirect('/admin/galeri/create');
        }

        // 4. Insert Data ke Database
        $db->query(
            "INSERT INTO " . (Galeri::$table ?? 'galeri') . " (judul, tanggal, kategori, deskripsi, file_foto) 
             VALUES (:judul, :tanggal, :kategori, :deskripsi, :file_foto)",
            [
                'judul'     => trim($_POST['judul'] ?? ''),
                'tanggal'   => $_POST['tanggal'] ?? date('Y-m-d'),
                'kategori'  => $kategoriInput,
                'deskripsi' => trim($_POST['deskripsi'] ?? ''),
                'file_foto' => $fileName
            ]
        );

        Session::flash('sukses', 'Dokumentasi berhasil ditambahkan ke Galeri Warga.');

        return redirect('/admin/galeri/create');
    }

    /**
     * 4. Menampilkan Form Edit Galeri (Khusus Admin)
     */
    public function edit()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            abort(404);
        }

        $db = App::resolve(Database::class);
        $galeri = $db->query("SELECT * FROM " . (Galeri::$table ?? 'galeri') . " WHERE id = :id", ['id' => $id])->find();

        if (!$galeri) {
            abort(404);
        }

        return view('admin/edit-galeri.php', [
            'galeri' => $galeri
        ]);
    }

    /**
     * 5. Memproses Update Data & Ganti Foto Galeri
     */
    public function update()
    {
        // 1. Verifikasi CSRF
        if (!Csrf::verify($_POST['_csrf_token'] ?? null)) {
            Session::flash('error', 'Sesi keamanan telah kadaluarsa. Silakan coba lagi.');
            return redirect('/admin/galeri/create');
        }

        $id = $_POST['id'] ?? null;
        if (!$id) {
            abort(404);
        }

        $db = App::resolve(Database::class);

        // Ambil data galeri lama untuk mengecek file foto yang tersimpan
        $galeriLama = $db->query("SELECT * FROM " . (Galeri::$table ?? 'galeri') . " WHERE id = :id", ['id' => $id])->find();
        if (!$galeriLama) {
            abort(404);
        }

        // 2. Validasi Kategori
        $allowedKategori = ['sosial', 'perayaan', 'kesehatan', 'pertemuan', 'lainnya'];
        $kategoriInput   = $_POST['kategori'] ?? '';

        if (!in_array($kategoriInput, $allowedKategori)) {
            Session::flash('error', 'Silakan pilih kategori kegiatan yang valid.');
            return redirect('/admin/galeri/edit?id=' . $id);
        }

        $fileName = $galeriLama['file_foto']; // Default pakai foto lama

        // 3. Jika Ada File Foto Baru Ditimpa/Diunggah
        if (isset($_FILES['foto_file']) && $_FILES['foto_file']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = base_path('public/uploads/galeri/');

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileExtension     = strtolower(pathinfo($_FILES['foto_file']['name'], PATHINFO_EXTENSION));
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];

            if (!in_array($fileExtension, $allowedExtensions)) {
                Session::flash('error', 'Format foto tidak diizinkan. Hanya menerima JPG, JPEG, PNG, atau WEBP.');
                return redirect('/admin/galeri/edit?id=' . $id);
            }

            if ($_FILES['foto_file']['size'] > 10485760) {
                Session::flash('error', 'Ukuran foto baru maksimal 10MB.');
                return redirect('/admin/galeri/edit?id=' . $id);
            }

            $newFileName = uniqid('galeri_') . '.' . $fileExtension;
            $targetFile  = $uploadDir . $newFileName;

            if (move_uploaded_file($_FILES['foto_file']['tmp_name'], $targetFile)) {
                // Hapus foto lama dari disk jika ada
                if (!empty($galeriLama['file_foto']) && file_exists($uploadDir . $galeriLama['file_foto'])) {
                    unlink($uploadDir . $galeriLama['file_foto']);
                }
                $fileName = $newFileName;
            } else {
                Session::flash('error', 'Sistem gagal memindahkan file foto baru.');
                return redirect('/admin/galeri/edit?id=' . $id);
            }
        }

        // 4. Update Database
        $db->query(
            "UPDATE " . (Galeri::$table ?? 'galeri') . " SET 
                judul = :judul, 
                tanggal = :tanggal, 
                kategori = :kategori, 
                deskripsi = :deskripsi, 
                file_foto = :file_foto 
            WHERE id = :id",
            [
                'id'        => $id,
                'judul'     => trim($_POST['judul'] ?? ''),
                'tanggal'   => $_POST['tanggal'] ?? date('Y-m-d'),
                'kategori'  => $kategoriInput,
                'deskripsi' => trim($_POST['deskripsi'] ?? ''),
                'file_foto' => $fileName
            ]
        );

        Session::flash('sukses', 'Dokumentasi galeri berhasil diperbarui!');

        return redirect('/admin/galeri/create');
    }

    /**
     * 6. Memproses Hapus Data Galeri beserta File Fotonya
     */
    public function destroy()
    {
        // 1. Verifikasi CSRF
        if (!Csrf::verify($_POST['_csrf_token'] ?? null)) {
            Session::flash('error', 'Sesi keamanan telah kadaluarsa. Silakan coba lagi.');
            return redirect('/admin/galeri/create');
        }

        $id = $_POST['id'] ?? null;

        if ($id) {
            $db = App::resolve(Database::class);
            $galeri = $db->query("SELECT * FROM " . (Galeri::$table ?? 'galeri') . " WHERE id = :id", ['id' => $id])->find();

            if ($galeri) {
                // Hapus file fisik dari folder uploads
                $uploadDir = base_path('public/uploads/galeri/');
                if (!empty($galeri['file_foto']) && file_exists($uploadDir . $galeri['file_foto'])) {
                    unlink($uploadDir . $galeri['file_foto']);
                }

                // Hapus rekord dari database
                $db->query("DELETE FROM " . (Galeri::$table ?? 'galeri') . " WHERE id = :id", ['id' => $id]);
                Session::flash('sukses', 'Dokumentasi galeri berhasil dihapus.');
            }
        }

        return redirect('/admin/galeri/create');
    }

    public function adminIndex()
    {
        $db = App::resolve(Database::class);

        $search   = $_GET['search'] ?? '';
        $kategori = $_GET['kategori'] ?? '';

        $query  = "SELECT * FROM " . (Galeri::$table ?? 'galeri') . " WHERE 1=1";
        $params = [];

        if (!empty($search)) {
            $query .= " AND (judul LIKE :search OR deskripsi LIKE :search)";
            $params['search'] = "%{$search}%";
        }

        if (!empty($kategori)) {
            $query .= " AND kategori = :kategori";
            $params['kategori'] = $kategori;
        }

        $query .= " ORDER BY tanggal DESC, created_at DESC";

        $galeriList = $db->query($query, $params)->get();

        return view('admin/galeri.php', [
            'galeriList' => $galeriList,
            'search'     => $search,
            'kategori'   => $kategori
        ]);
    }
}
