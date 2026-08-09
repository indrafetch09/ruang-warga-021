<?php

namespace App\Controllers;

use Core\App;
use Core\Database;
use Core\Session;
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

        $query  = "SELECT * FROM " . Notulensi::$table . " WHERE 1=1";
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

        // Mapping hasil array mentah ke instance Objek Model Notulensi
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

        // Menggunakan method Notulensi::find() dari Core\Model
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
        return view('admin/tambah-notulensi.php');
    }

    /**
     * 4. Memproses Simpan Data & Upload Lampiran
     */
    public function store()
    {
        $db = App::resolve(Database::class);

        $fileName = null;

        if (isset($_FILES['file-upload']) && $_FILES['file-upload']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = base_path('public/uploads/notulensi/');

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileExtension     = strtolower(pathinfo($_FILES['file-upload']['name'], PATHINFO_EXTENSION));
            $allowedExtensions = ['pdf', 'doc', 'docx'];

            if (in_array($fileExtension, $allowedExtensions)) {
                $fileName   = uniqid('notulen_') . '.' . $fileExtension;
                $targetFile = $uploadDir . $fileName;

                if (!move_uploaded_file($_FILES['file-upload']['tmp_name'], $targetFile)) {
                    $fileName = null;
                }
            } else {
                Session::flash('error', 'Format file tidak diizinkan. Hanya PDF/DOC/DOCX.');
                redirect('/admin/notulensi/create');
            }
        }

        $db->query(
            "INSERT INTO " . Notulensi::$table . " 
            (judul, kategori, no_surat, tanggal, waktu_mulai, waktu_selesai, lokasi, notulis, agenda, hasil_pembahasan, keputusan_akhir, file_lampiran) 
            VALUES 
            (:judul, :kategori, :no_surat, :tanggal, :waktu_mulai, :waktu_selesai, :lokasi, :notulis, :agenda, :hasil_pembahasan, :keputusan_akhir, :file_lampiran)",
            [
                'judul'            => $_POST['judul'],
                'kategori'         => $_POST['kategori'],
                'no_surat'         => $_POST['no_surat'] ?? null,
                'tanggal'          => $_POST['tanggal'],
                'waktu_mulai'      => $_POST['waktu_mulai'],
                'waktu_selesai'    => !empty($_POST['waktu_selesai']) ? $_POST['waktu_selesai'] : null,
                'lokasi'           => $_POST['lokasi'],
                'notulis'          => $_POST['notulis'],
                'agenda'           => $_POST['agenda'],
                'hasil_pembahasan' => $_POST['hasil_pembahasan'],
                'keputusan_akhir'  => $_POST['keputusan_akhir'],
                'file_lampiran'    => $fileName
            ]
        );

        Session::flash('sukses', 'Notulensi berhasil disimpan dan dipublikasikan.');

        redirect('/notulensi');
    }
}
