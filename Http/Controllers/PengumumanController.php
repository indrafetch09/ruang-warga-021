<?php

namespace App\Controllers;

use Core\App;
use Core\Database;
use Core\Session;
use Core\Validator;
use Core\Csrf;
use App\Models\Pengumuman;

class PengumumanController
{
    /**
     * 1. Menampilkan Form Tambah Pengumuman (Khusus Admin/Pengurus)
     */
    public function create()
    {
        return view('admin/tambah-pengumuman.php');
    }

    /**
     * 2. Memproses & Menyimpan Data Pengumuman Baru Ke Database
     */
    public function store()
    {
        // 1. Verifikasi CSRF Token
        if (!Csrf::verify($_POST['_csrf_token'] ?? null)) {
            Session::flash('error', 'Sesi keamanan telah kadaluarsa. Silakan coba lagi.');
            return redirect('/admin/pengumuman/create');
        }

        $judul            = trim($_POST['judul'] ?? '');
        $kategori         = trim($_POST['kategori'] ?? 'umum');
        $tanggalPublikasi = $_POST['tanggal_publikasi'] ?? date('Y-m-d');
        $pesan            = trim($_POST['pesan'] ?? '');
        $labelTombol      = trim($_POST['label_tombol'] ?? '');
        $tautanUrl        = trim($_POST['tautan_url'] ?? '');
        $isPublished      = isset($_POST['is_published']) && $_POST['is_published'] ? 1 : 0;

        // 2. Validasi Form Input
        $errors = [];

        if (!Validator::string($judul, 3, 255)) {
            $errors['judul'] = 'Judul pengumuman harus diisi (3 - 255 karakter).';
        }

        if (!Validator::string($pesan, 10)) {
            $errors['pesan'] = 'Isi pesan pengumuman minimal 10 karakter.';
        }

        if (!empty($tautanUrl) && !filter_var($tautanUrl, FILTER_VALIDATE_URL)) {
            $errors['tautan_url'] = 'Format URL tautan tidak valid.';
        }

        if (!empty($errors)) {
            Session::flash('errors', $errors);
            Session::flash('old', $_POST);
            return redirect('/admin/pengumuman/create');
        }

        // 3. Simpan ke Database
        $db = App::resolve(Database::class);

        $db->query(
            "INSERT INTO " . (Pengumuman::$table ?? 'pengumuman') . " 
            (judul, kategori, tanggal_publikasi, pesan, label_tombol, tautan_url, is_published, created_at) 
            VALUES 
            (:judul, :kategori, :tanggal_publikasi, :pesan, :label_tombol, :tautan_url, :is_published, NOW())",
            [
                'judul'             => $judul,
                'kategori'          => $kategori,
                'tanggal_publikasi' => $tanggalPublikasi,
                'pesan'             => $pesan,
                'label_tombol'      => !empty($labelTombol) ? $labelTombol : null,
                'tautan_url'        => !empty($tautanUrl) ? $tautanUrl : null,
                'is_published'      => $isPublished
            ]
        );

        Session::flash('sukses', 'Pengumuman berhasil dibuat dan dipublikasikan!');
        return redirect('/dashboard');
    }

    /**
     * 3. Menampilkan Form Edit Pengumuman (Khusus Admin/Pengurus)
     */
    public function edit()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            abort(404);
        }

        $db = App::resolve(Database::class);
        $pengumuman = $db->query("SELECT * FROM " . (Pengumuman::$table ?? 'pengumuman') . " WHERE id = :id", ['id' => $id])->find();

        if (!$pengumuman) {
            abort(404);
        }

        return view('admin/edit-pengumuman.php', [
            'pengumuman' => $pengumuman
        ]);
    }

    /**
     * 4. Memproses Update Data Pengumuman Ke Database
     */
    public function update()
    {
        // 1. Verifikasi CSRF Token
        if (!Csrf::verify($_POST['_csrf_token'] ?? null)) {
            Session::flash('error', 'Sesi keamanan telah kadaluarsa. Silakan coba lagi.');
            return redirect('/dashboard');
        }

        $id = $_POST['id'] ?? null;
        if (!$id) {
            abort(404);
        }

        $judul            = trim($_POST['judul'] ?? '');
        $kategori         = trim($_POST['kategori'] ?? 'umum');
        $tanggalPublikasi = $_POST['tanggal_publikasi'] ?? date('Y-m-d');
        $pesan            = trim($_POST['pesan'] ?? '');
        $labelTombol      = trim($_POST['label_tombol'] ?? '');
        $tautanUrl        = trim($_POST['tautan_url'] ?? '');
        $isPublished      = isset($_POST['is_published']) && $_POST['is_published'] ? 1 : 0;

        // 2. Validasi Input
        $errors = [];

        if (!Validator::string($judul, 3, 255)) {
            $errors['judul'] = 'Judul pengumuman harus diisi (3 - 255 karakter).';
        }

        if (!Validator::string($pesan, 10)) {
            $errors['pesan'] = 'Isi pesan pengumuman minimal 10 karakter.';
        }

        if (!empty($tautanUrl) && !filter_var($tautanUrl, FILTER_VALIDATE_URL)) {
            $errors['tautan_url'] = 'Format URL tautan tidak valid.';
        }

        if (!empty($errors)) {
            Session::flash('errors', $errors);
            return redirect('/admin/pengumuman/edit?id=' . $id);
        }

        // 3. Update Database
        $db = App::resolve(Database::class);

        $db->query(
            "UPDATE " . (Pengumuman::$table ?? 'pengumuman') . " SET 
                judul = :judul, 
                kategori = :kategori, 
                tanggal_publikasi = :tanggal_publikasi, 
                pesan = :pesan, 
                label_tombol = :label_tombol, 
                tautan_url = :tautan_url, 
                is_published = :is_published 
            WHERE id = :id",
            [
                'id'                => $id,
                'judul'             => $judul,
                'kategori'          => $kategori,
                'tanggal_publikasi' => $tanggalPublikasi,
                'pesan'             => $pesan,
                'label_tombol'      => !empty($labelTombol) ? $labelTombol : null,
                'tautan_url'        => !empty($tautanUrl) ? $tautanUrl : null,
                'is_published'      => $isPublished
            ]
        );

        Session::flash('sukses', 'Pengumuman berhasil diperbarui!');
        return redirect('/admin/pengumuman');
    }

    /**
     * 5. Memproses Hapus Data Pengumuman
     */
    public function destroy()
    {
        // 1. Verifikasi CSRF Token
        if (!Csrf::verify($_POST['_csrf_token'] ?? null)) {
            Session::flash('error', 'Sesi keamanan telah kadaluarsa. Silakan coba lagi.');
            return redirect('/admin/pengumuman');
        }

        $id = $_POST['id'] ?? null;

        if ($id) {
            $db = App::resolve(Database::class);
            $db->query("DELETE FROM " . (Pengumuman::$table ?? 'pengumuman') . " WHERE id = :id", ['id' => $id]);
            Session::flash('sukses', 'Pengumuman berhasil dihapus.');
        }

        return redirect('/admin/pengumuman');
    }

    public function adminIndex()
    {
        $db = App::resolve(Database::class);

        $search   = $_GET['search'] ?? '';
        $kategori = $_GET['kategori'] ?? '';
        $status   = $_GET['status'] ?? ''; // 'published' atau 'draft'

        $query  = "SELECT * FROM " . (Pengumuman::$table ?? 'pengumuman') . " WHERE 1=1";
        $params = [];

        if (!empty($search)) {
            $query .= " AND (judul LIKE :search OR pesan LIKE :search)";
            $params['search'] = "%{$search}%";
        }

        if (!empty($kategori)) {
            $query .= " AND kategori = :kategori";
            $params['kategori'] = $kategori;
        }

        if ($status === 'published') {
            $query .= " AND is_published = 1";
        } elseif ($status === 'draft') {
            $query .= " AND is_published = 0";
        }

        $query .= " ORDER BY tanggal_publikasi DESC, id DESC";

        $pengumumanList = $db->query($query, $params)->get();

        return view('admin/pengumuman.php', [
            'pengumumanList' => $pengumumanList,
            'search'         => $search,
            'kategori'       => $kategori,
            'status'         => $status
        ]);
    }
}
