<?php

namespace App\Controllers;

use Core\App;
use Core\Database;
use Core\Session;

class NotulensiController
{
    /**
     * 1. Menampilkan Daftar Arsip Rapat (Sisi Publik & Admin)
     * Target View: notulensi.php (atau notulensi.view.php)
     */
    public function index()
    {
        $db = App::resolve(Database::class);

        // Menangkap request dari Search Bar & Filter
        $search = $_GET['search'] ?? '';
        $kategori = $_GET['kategori'] ?? '';
        $tahun = $_GET['tahun'] ?? '';

        // Bikin base query
        $query = "SELECT * FROM notulensi WHERE 1=1";
        $params = [];

        // Logic Filter Pencarian
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

        // Urutkan dari yang terbaru
        $query .= " ORDER BY tanggal DESC";

        $notulensiList = $db->query($query, $params)->get();

        return view('notulensi.php', [
            'notulensiList' => $notulensiList,
            'search' => $search,
            'kategori' => $kategori,
            'tahun' => $tahun
        ]);
    }

    /**
     * 2. Menampilkan Detail Rapat (Sisi Publik & Admin)
     * Target View: detail-notulensi.php
     */
    public function show()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            abort(404);
        }

        $db = App::resolve(Database::class);
        $notulensi = $db->query("SELECT * FROM notulensi WHERE id = :id", ['id' => $id])->find();

        if (!$notulensi) {
            abort(404);
        }

        return view('detail-notulensi.php', [
            'notulensi' => $notulensi
        ]);
    }

    /**
     * 3. Menampilkan Form Tambah Notulensi (Khusus Admin)
     * Target View: tambah-notulensi.php
     */
    public function create()
    {
        return view('tambah-notulensi.php');
    }

    /**
     * 4. Memproses Simpan Data & Upload Lampiran
     */
    public function store()
    {
        $db = App::resolve(Database::class);

        // 1. Inisialisasi variabel nama file
        $fileName = null;

        // 2. Logic Upload File Lampiran
        if (isset($_FILES['file-upload']) && $_FILES['file-upload']['error'] === UPLOAD_ERR_OK) {

            // Tentukan folder tujuan (pastikan folder public/uploads/notulensi/ ada)
            $uploadDir = base_path('public/uploads/notulensi/');

            // Bikin foldernya kalau belum ada
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // Ambil ekstensi file asli
            $fileExtension = strtolower(pathinfo($_FILES['file-upload']['name'], PATHINFO_EXTENSION));
            $allowedExtensions = ['pdf', 'doc', 'docx'];

            // Validasi tipe file
            if (in_array($fileExtension, $allowedExtensions)) {
                // Bikin nama file unik biar gak numpuk/bentrok
                $fileName = uniqid('notulen_') . '.' . $fileExtension;
                $targetFile = $uploadDir . $fileName;

                // Pindahkan file dari temp ke folder tujuan
                if (!move_uploaded_file($_FILES['file-upload']['tmp_name'], $targetFile)) {
                    // Jika gagal upload, set null
                    $fileName = null;
                }
            } else {
                Session::flash('error', 'Format file tidak diizinkan. Hanya PDF/DOC/DOCX.');
                redirect('/admin/notulensi/create');
            }
        }

        // 3. Simpan data ke Database
        $db->query(
            "INSERT INTO notulensi 
            (judul, kategori, no_surat, tanggal, waktu_mulai, waktu_selesai, lokasi, notulis, agenda, hasil_pembahasan, keputusan_akhir, file_lampiran) 
            VALUES 
            (:judul, :kategori, :no_surat, :tanggal, :waktu_mulai, :waktu_selesai, :lokasi, :notulis, :agenda, :hasil_pembahasan, :keputusan_akhir, :file_lampiran)",
            [
                'judul' => $_POST['judul'],
                'kategori' => $_POST['kategori'],
                'no_surat' => $_POST['no_surat'] ?? null,
                'tanggal' => $_POST['tanggal'],
                'waktu_mulai' => $_POST['waktu_mulai'],
                'waktu_selesai' => !empty($_POST['waktu_selesai']) ? $_POST['waktu_selesai'] : null,
                'lokasi' => $_POST['lokasi'],
                'notulis' => $_POST['notulis'],
                'agenda' => $_POST['agenda'],
                'hasil_pembahasan' => $_POST['hasil_pembahasan'],
                'keputusan_akhir' => $_POST['keputusan_akhir'],
                'file_lampiran' => $fileName // Nama file yang sudah di-generate (atau null)
            ]
        );

        Session::flash('sukses', 'Notulensi berhasil disimpan dan dipublikasikan.');

        // Redirect ke halaman arsip rapat
        redirect('/notulensi');
    }
}
