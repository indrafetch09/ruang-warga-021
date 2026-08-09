<?php

namespace App\Controllers;

use Core\App;
use Core\Database;
use Core\Session;
use App\Models\Galeri;

class GaleriController
{
    /**
     * 1. Menampilkan Halaman Galeri Foto (Sisi Publik & Admin)
     */
    public function index()
    {
        $kategori = $_GET['kategori'] ?? '';

        // Menggunakan helper Model::where() jika ada filter kategori
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
        return view('admin/tambah-galeri.php');
    }

    /**
     * 3. Memproses Simpan Data & Upload Foto Galeri
     */
    public function store()
    {
        $db = App::resolve(Database::class);

        if (!isset($_FILES['image-upload']) || $_FILES['image-upload']['error'] !== UPLOAD_ERR_OK) {
            Session::flash('error', 'File foto wajib diunggah!');
            redirect('/admin/galeri/create');
        }

        $uploadDir = base_path('public/uploads/galeri/');

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileExtension     = strtolower(pathinfo($_FILES['image-upload']['name'], PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png'];

        if (!in_array($fileExtension, $allowedExtensions)) {
            Session::flash('error', 'Format foto tidak diizinkan. Hanya menerima JPG, JPEG, atau PNG.');
            redirect('/admin/galeri/create');
        }

        if ($_FILES['image-upload']['size'] > 5242880) {
            Session::flash('error', 'Ukuran foto maksimal 5MB.');
            redirect('/admin/galeri/create');
        }

        $fileName   = uniqid('galeri_') . '.' . $fileExtension;
        $targetFile = $uploadDir . $fileName;

        if (!move_uploaded_file($_FILES['image-upload']['tmp_name'], $targetFile)) {
            Session::flash('error', 'Sistem gagal memindahkan file unggahan.');
            redirect('/admin/galeri/create');
        }

        // Simpan data
        $db->query(
            "INSERT INTO " . Galeri::$table . " (judul, tanggal, kategori, deskripsi, file_foto) 
             VALUES (:judul, :tanggal, :kategori, :deskripsi, :file_foto)",
            [
                'judul'     => $_POST['judul'],
                'tanggal'   => $_POST['tanggal'],
                'kategori'  => $_POST['kategori'],
                'deskripsi' => $_POST['deskripsi'],
                'file_foto' => $fileName
            ]
        );

        Session::flash('sukses', 'Dokumentasi berhasil ditambahkan ke Galeri Warga.');

        redirect('/galeri');
    }
}
