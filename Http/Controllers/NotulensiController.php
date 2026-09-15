<?php

namespace App\Controllers;

use Core\App;
use Core\Database;
use Core\Session;
use Core\Authenticator;
use Core\Csrf;
use App\Models\Notulensi;

class NotulensiController
{
    /**
     * 1. Menampilkan Daftar Arsip Rapat (Sisi Publik & Admin)
     */
    public function index()
    {
        $db = App::resolve(Database::class);

        $search   = $_GET['search'] ?? '';
        $kategori = $_GET['kategori'] ?? '';
        $tahun    = $_GET['tahun'] ?? '';

        $query  = "SELECT * FROM " . (Notulensi::$table ?? 'notulensi') . " WHERE 1=1";
        $params = [];

        if (!empty($search)) {
            $query .= " AND (judul LIKE :search OR hasil_pembahasan LIKE :search)";
            $params['search'] = "%{$search}%";
        }

        if (!empty($kategori)) {
            $query .= " AND kategori = :kategori";
            $params['kategori'] = $kategori;
        }

        if (!empty($tahun)) {
            $query .= " AND YEAR(tanggal) = :tahun";
            $params['tahun'] = $tahun;
        }

        $query .= " ORDER BY tanggal DESC";

        $notulensiRaw  = $db->query($query, $params)->get();
        $notulensiList = array_map(fn($row) => new Notulensi($row), $notulensiRaw);

        return view('user/notulensi.php', [
            'notulensiList' => $notulensiList,
            'search'        => $search,
            'kategori'      => $kategori,
            'tahun'         => $tahun
        ]);
    }

    /**
     * 2. Menampilkan Detail Rapat (Sisi Publik & Admin)
     */
    public function show()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            abort(404);
        }

        $notulensi = Notulensi::find($id);

        if (!$notulensi) {
            abort(404);
        }

        return view('user/detail-notulensi.php', [
            'notulensi' => $notulensi
        ]);
    }

    /**
     * 3. Menampilkan Form Tambah Notulensi (Khusus Admin)
     */
    public function create()
    {
        $user = Authenticator::user() ?? Session::get('user');

        return view('admin/tambah-notulensi.php', [
            'user' => $user
        ]);
    }

    /**
     * 4. Memproses Simpan Data & Upload Lampiran
     */
    public function store()
    {
        // 1. Verifikasi Token CSRF
        if (!Csrf::verify($_POST['_csrf_token'] ?? null)) {
            Session::flash('error', 'Sesi keamanan telah kadaluarsa. Silakan coba lagi.');
            Session::flash('old', $_POST);
            return redirect('/admin/notulensi/create');
        }

        $db = App::resolve(Database::class);

        // 2. Proses Upload File Lampiran
        $fileName = null;

        if (isset($_FILES['lampiran']) && $_FILES['lampiran']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = base_path('public/uploads/notulensi/');

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileExtension     = strtolower(pathinfo($_FILES['lampiran']['name'], PATHINFO_EXTENSION));
            $allowedExtensions = ['pdf', 'doc', 'docx'];

            if (in_array($fileExtension, $allowedExtensions)) {
                $fileName   = uniqid('notulen_') . '.' . $fileExtension;
                $targetFile = $uploadDir . $fileName;

                if (!move_uploaded_file($_FILES['lampiran']['tmp_name'], $targetFile)) {
                    $fileName = null;
                }
            } else {
                Session::flash('error', 'Format file tidak diizinkan. Hanya dokumen PDF, DOC, atau DOCX.');
                Session::flash('old', $_POST);
                return redirect('/admin/notulensi/create');
            }
        }

        // 3. Insert Data ke Database
        $db->query(
            "INSERT INTO " . (Notulensi::$table ?? 'notulensi') . " 
            (judul, kategori, no_surat, tanggal, waktu_mulai, waktu_selesai, lokasi, notulis, agenda, hasil_pembahasan, keputusan_akhir, file_lampiran) 
            VALUES 
            (:judul, :kategori, :no_surat, :tanggal, :waktu_mulai, :waktu_selesai, :lokasi, :notulis, :agenda, :hasil_pembahasan, :keputusan_akhir, :file_lampiran)",
            [
                'judul'            => trim($_POST['judul'] ?? ''),
                'kategori'         => trim($_POST['kategori'] ?? ''),
                'no_surat'         => !empty($_POST['no_surat']) ? trim($_POST['no_surat']) : null,
                'tanggal'          => $_POST['tanggal'] ?? date('Y-m-d'),
                'waktu_mulai'      => $_POST['waktu_mulai'] ?? null,
                'waktu_selesai'    => !empty($_POST['waktu_selesai']) ? $_POST['waktu_selesai'] : null,
                'lokasi'           => trim($_POST['lokasi'] ?? ''),
                'notulis'          => trim($_POST['notulis'] ?? ''),
                'agenda'           => trim($_POST['agenda'] ?? ''),
                'hasil_pembahasan' => trim($_POST['hasil_pembahasan'] ?? ''),
                'keputusan_akhir'  => trim($_POST['keputusan_akhir'] ?? ''),
                'file_lampiran'    => $fileName
            ]
        );

        Session::flash('sukses', 'Notulensi berhasil disimpan dan dipublikasikan.');

        return redirect('/notulensi');
    }

    /**
     * 5. Menampilkan Form Edit Notulensi (Khusus Admin)
     */
    public function edit()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            abort(404);
        }

        $notulensi = Notulensi::find($id);

        if (!$notulensi) {
            abort(404);
        }

        $user = Authenticator::user() ?? Session::get('user');

        return view('admin/edit-notulensi.php', [
            'notulensi' => $notulensi,
            'user'      => $user
        ]);
    }

    /**
     * 6. Memproses Update Data & Ganti Lampiran Notulensi
     */
    public function update()
    {
        // 1. Verifikasi Token CSRF
        if (!Csrf::verify($_POST['_csrf_token'] ?? null)) {
            Session::flash('error', 'Sesi keamanan telah kadaluarsa. Silakan coba lagi.');
            return redirect('/notulensi');
        }

        $id = $_POST['id'] ?? null;
        if (!$id) {
            abort(404);
        }

        $notulensiLama = Notulensi::find($id);
        if (!$notulensiLama) {
            abort(404);
        }

        $db = App::resolve(Database::class);

        // Ambil nama file lama sebagai default
        $fileName = $notulensiLama->file_lampiran ?? $notulensiLama['file_lampiran'] ?? null;

        // 2. Jika ada file lampiran baru diunggah
        if (isset($_FILES['lampiran']) && $_FILES['lampiran']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = base_path('public/uploads/notulensi/');

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileExtension     = strtolower(pathinfo($_FILES['lampiran']['name'], PATHINFO_EXTENSION));
            $allowedExtensions = ['pdf', 'doc', 'docx'];

            if (in_array($fileExtension, $allowedExtensions)) {
                $newFileName = uniqid('notulen_') . '.' . $fileExtension;
                $targetFile  = $uploadDir . $newFileName;

                if (move_uploaded_file($_FILES['lampiran']['tmp_name'], $targetFile)) {
                    // Hapus file dokumen lama dari server jika ada
                    if (!empty($fileName) && file_exists($uploadDir . $fileName)) {
                        unlink($uploadDir . $fileName);
                    }
                    $fileName = $newFileName;
                }
            } else {
                Session::flash('error', 'Format file tidak diizinkan. Hanya dokumen PDF, DOC, atau DOCX.');
                return redirect('/admin/notulensi/edit?id=' . $id);
            }
        }

        // 3. Update Database
        $db->query(
            "UPDATE " . (Notulensi::$table ?? 'notulensi') . " SET 
                judul = :judul, 
                kategori = :kategori, 
                no_surat = :no_surat, 
                tanggal = :tanggal, 
                waktu_mulai = :waktu_mulai, 
                waktu_selesai = :waktu_selesai, 
                lokasi = :lokasi, 
                notulis = :notulis, 
                agenda = :agenda, 
                hasil_pembahasan = :hasil_pembahasan, 
                keputusan_akhir = :keputusan_akhir, 
                file_lampiran = :file_lampiran 
            WHERE id = :id",
            [
                'id'               => $id,
                'judul'            => trim($_POST['judul'] ?? ''),
                'kategori'         => trim($_POST['kategori'] ?? ''),
                'no_surat'         => !empty($_POST['no_surat']) ? trim($_POST['no_surat']) : null,
                'tanggal'          => $_POST['tanggal'] ?? date('Y-m-d'),
                'waktu_mulai'      => $_POST['waktu_mulai'] ?? null,
                'waktu_selesai'    => !empty($_POST['waktu_selesai']) ? $_POST['waktu_selesai'] : null,
                'lokasi'           => trim($_POST['lokasi'] ?? ''),
                'notulis'          => trim($_POST['notulis'] ?? ''),
                'agenda'           => trim($_POST['agenda'] ?? ''),
                'hasil_pembahasan' => trim($_POST['hasil_pembahasan'] ?? ''),
                'keputusan_akhir'  => trim($_POST['keputusan_akhir'] ?? ''),
                'file_lampiran'    => $fileName
            ]
        );

        Session::flash('sukses', 'Notulensi rapat berhasil diperbarui!');

        return redirect('/notulensi');
    }

    /**
     * 7. Memproses Hapus Data Notulensi beserta Dokumen Lampirannya
     */
    public function destroy()
    {
        // 1. Verifikasi CSRF Token
        if (!Csrf::verify($_POST['_csrf_token'] ?? null)) {
            Session::flash('error', 'Sesi keamanan telah kadaluarsa. Silakan coba lagi.');
            return redirect('/notulensi');
        }

        $id = $_POST['id'] ?? null;

        if ($id) {
            $notulensi = Notulensi::find($id);

            if ($notulensi) {
                $fileName = $notulensi->file_lampiran ?? $notulensi['file_lampiran'] ?? null;

                // Hapus file fisik dari disk
                if (!empty($fileName)) {
                    $uploadDir = base_path('public/uploads/notulensi/');
                    if (file_exists($uploadDir . $fileName)) {
                        unlink($uploadDir . $fileName);
                    }
                }

                // Hapus data dari DB
                $db = App::resolve(Database::class);
                $db->query("DELETE FROM " . (Notulensi::$table ?? 'notulensi') . " WHERE id = :id", ['id' => $id]);

                Session::flash('sukses', 'Notulensi rapat berhasil dihapus.');
            }
        }

        return redirect('/notulensi');
    }

    public function adminIndex()
    {
        $db = App::resolve(Database::class);

        $search   = $_GET['search'] ?? '';
        $kategori = $_GET['kategori'] ?? '';

        $query  = "SELECT * FROM " . (Notulensi::$table ?? 'notulensi') . " WHERE 1=1";
        $params = [];

        if (!empty($search)) {
            $query .= " AND (judul LIKE :search OR hasil_pembahasan LIKE :search OR no_surat LIKE :search)";
            $params['search'] = "%{$search}%";
        }

        if (!empty($kategori)) {
            $query .= " AND kategori = :kategori";
            $params['kategori'] = $kategori;
        }

        $query .= " ORDER BY tanggal DESC";

        $notulensiList = $db->query($query, $params)->get();

        return view('admin/notulensi.php', [
            'notulensiList' => $notulensiList,
            'search'        => $search,
            'kategori'      => $kategori
        ]);
    }
}
