<?php

namespace App\Controllers;

use Core\App;
use Core\Database;
use Core\Session;
use App\Models\Pengumuman;

class PengumumanController
{
    /**
     * 1. Menampilkan Form Tambah Pengumuman (Khusus Admin)
     */
    public function create()
    {
        return view('admin/tambah-pengumuman.php');
    }

    /**
     * 2. Memproses Simpan Data Pengumuman
     */
    public function store()
    {
        $db = App::resolve(Database::class);

        $isPublished = isset($_POST['is_published']) && $_POST['is_published'] ? 1 : 0;

        $db->query(
            "INSERT INTO " . Pengumuman::$table . " 
            (judul, kategori, tanggal_publikasi, pesan, label_tombol, tautan_url, is_published) 
            VALUES 
            (:judul, :kategori, :tanggal_publikasi, :pesan, :label_tombol, :tautan_url, :is_published)",
            [
                'judul'             => $_POST['judul'],
                'kategori'          => $_POST['kategori'],
                'tanggal_publikasi' => $_POST['tanggal_publikasi'],
                'pesan'             => $_POST['pesan'],
                'label_tombol'      => !empty($_POST['label_tombol']) ? $_POST['label_tombol'] : null,
                'tautan_url'        => !empty($_POST['tautan_url']) ? $_POST['tautan_url'] : null,
                'is_published'      => $isPublished
            ]
        );

        Session::flash('sukses', 'Pengumuman berhasil dibuat dan disiarkan ke portal warga.');

        redirect('/dashboard');
    }
}
