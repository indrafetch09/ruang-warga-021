<?php

namespace App\Controllers;

use Core\App;
use Core\Database;
use Core\Session;

class PengumumanController
{
    /**
     * 1. Menampilkan Form Tambah Pengumuman (Khusus Admin)
     * Target View: tambah-pengumuman.php
     */
    public function create()
    {
        return view('tambah-pengumuman.php');
    }

    /**
     * 2. Memproses Simpan Data Pengumuman
     */
    public function store()
    {
        $db = App::resolve(Database::class);

        // Cek input form untuk is_published (misal pakai checkbox atau radio button)
        // Kalau dari checkbox dan diceklis, biasanya nilainya 'on' atau '1'
        $isPublished = isset($_POST['is_published']) && $_POST['is_published'] ? 1 : 0;

        // Kalau di form HTML lu nggak ada input is_published dan defaultnya selalu tayang,
        // lu bisa hardcode variabel ini jadi $isPublished = 1;

        $db->query(
            "INSERT INTO pengumuman 
            (judul, kategori, tanggal_publikasi, pesan, label_tombol, tautan_url, is_published) 
            VALUES 
            (:judul, :kategori, :tanggal_publikasi, :pesan, :label_tombol, :tautan_url, :is_published)",
            [
                'judul'             => $_POST['judul'],
                'kategori'          => $_POST['kategori'],
                'tanggal_publikasi' => $_POST['tanggal_publikasi'],
                'pesan'             => $_POST['pesan'],

                // Kolom opsional: kalau form kosong, masukkan NULL ke database
                'label_tombol'      => !empty($_POST['label_tombol']) ? $_POST['label_tombol'] : null,
                'tautan_url'        => !empty($_POST['tautan_url']) ? $_POST['tautan_url'] : null,
                'is_published'      => $isPublished
            ]
        );

        Session::flash('sukses', 'Pengumuman berhasil dibuat dan disiarkan ke portal warga.');

        // Lempar balik ke dasbor biar admin bisa lihat ringkasannya
        redirect('/dashboard');
    }
}
