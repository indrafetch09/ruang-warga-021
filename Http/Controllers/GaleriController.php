<?php

namespace App\Controllers;

use Core\App;
use Core\Database;
use Core\Session;

class GaleriController
{
    /**
     * 1. Menampilkan Halaman Galeri Foto (Sisi Publik & Admin)
     * Target View: galeri.php
     */
    public function index()
    {
        $db = App::resolve(Database::class);

        // Menangkap filter kategori jika ada
        $kategori = $_GET['kategori'] ?? '';

        $query = "SELECT * FROM galeri WHERE 1=1";
        $params = [];

        // Logic Filter Kategori
        if (!empty($kategori)) {
            $query .= " AND kategori = :kategori";
            $params['kategori'] = $kategori;
        }

        // Urutkan foto berdasarkan tanggal kegiatan terbaru
        $query .= " ORDER BY tanggal DESC, created_at DESC";

        $galeriList = $db->query($query, $params)->get();

        return view('galeri.php', [
            'galeriList' => $galeriList,
            'kategori' => $kategori
        ]);
    }

    /**
     * 2. Menampilkan Form Tambah Galeri (Khusus Admin)
     * Target View: tambah-galeri.php
     */
    public function create()
    {
        return view('tambah-galeri.php');
    }

    /**
     * 3. Memproses Simpan Data & Upload Foto Galeri
     */
    public function store()
    {
        $db = App::resolve(Database::class);

        $fileName = null;

        // 1. Logic Upload File Foto
        // (Pastikan di tambah-galeri.php, <input type="file" name="image-upload">)
        if (isset($_FILES['image-upload']) && $_FILES['image-upload']['error'] === UPLOAD_ERR_OK) {

            // Tentukan folder tujuan (pastikan folder public/uploads/galeri/ ada)
            $uploadDir = base_path('public/uploads/galeri/');

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileExtension = strtolower(pathinfo($_FILES['image-upload']['name'], PATHINFO_EXTENSION));
            $allowedExtensions = ['jpg', 'jpeg', 'png'];

            if (in_array($fileExtension, $allowedExtensions)) {

                // Validasi ukuran maksimal 5MB (5 * 1024 * 1024 bytes)
                if ($_FILES['image-upload']['size'] > 5242880) {
                    Session::flash('error', 'Ukuran foto maksimal 5MB.');
                    redirect('/admin/galeri/create');
                }

                // Generate nama unik untuk mencegah duplikasi nama file
                $fileName = uniqid('galeri_') . '.' . $fileExtension;
                $targetFile = $uploadDir . $fileName;

                if (!move_uploaded_file($_FILES['image-upload']['tmp_name'], $targetFile)) {
                    Session::flash('error', 'Sistem gagal memindahkan file unggahan.');
                    redirect('/admin/galeri/create');
                }
            } else {
                Session::flash('error', 'Format foto tidak diizinkan. Hanya menerima JPG, JPEG, atau PNG.');
                redirect('/admin/galeri/create');
            }
        } else {
            // Wajib ada foto untuk galeri
            Session::flash('error', 'File foto wajib diunggah!');
            redirect('/admin/galeri/create');
        }

        // 2. Simpan data ke Database
        $db->query(
            "INSERT INTO galeri 
            (judul, tanggal, kategori, deskripsi, file_foto) 
            VALUES 
            (:judul, :tanggal, :kategori, :deskripsi, :file_foto)",
            [
                'judul' => $_POST['judul'],
                'tanggal' => $_POST['tanggal'],
                'kategori' => $_POST['kategori'],
                'deskripsi' => $_POST['deskripsi'],
                'file_foto' => $fileName // Simpan nama file ke tabel
            ]
        );

        Session::flash('sukses', 'Dokumentasi berhasil ditambahkan ke Galeri Warga.');

        // Redirect ke halaman daftar galeri
        redirect('/galeri');
    }
}
