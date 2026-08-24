<?php

namespace App\Controllers;

use Core\App;
use Core\Database;
use Core\Session;
use Core\Csrf;

class KegiatanController
{
    /**
     * 1. Menampilkan Halaman Jadwal Kegiatan Rutin Publik (Sisi Warga)
     */
    public function index()
    {
        $db = App::resolve(Database::class);

        $kegiatanRaw = $db->query("SELECT * FROM kegiatan_rutin ORDER BY FIELD(hari, 'senin','selasa','rabu','kamis','jumat','sabtu','minggu')")->get();

        $kegiatanByHari = [
            'senin'   => [],
            'selasa'  => [],
            'rabu'    => [],
            'kamis'   => [],
            'jumat'   => [],
            'sabtu'   => [],
            'minggu'  => []
        ];

        foreach ($kegiatanRaw as $item) {
            $hariKey = strtolower($item['hari'] ?? '');
            if (isset($kegiatanByHari[$hariKey])) {
                $kegiatanByHari[$hariKey][] = $item;
            }
        }

        return view('user/kegiatan.php', [
            'kegiatanByHari' => $kegiatanByHari
        ]);
    }

    /**
     * 2. Menampilkan Form Tambah Kegiatan Rutin (Khusus Admin/Pengurus RW)
     */
    public function create()
    {
        $user = \App\Models\User::current();
        if (!$user->isRw()) {
            Session::flash('error', 'Akses ditolak. Pengurus RT tidak memiliki hak akses untuk menambah kegiatan.');
            return redirect('/dashboard');
        }

        return view('admin/tambah-kegiatan.php');
    }

    /**
     * 3. Memproses Simpan Data Kegiatan Rutin (Khusus Admin/Pengurus RW)
     */
    public function store()
    {
        $user = \App\Models\User::current();
        if (!$user->isRw()) {
            Session::flash('error', 'Akses ditolak. Pengurus RT tidak memiliki hak akses untuk menambah kegiatan.');
            return redirect('/dashboard');
        }

        if (!Csrf::verify($_POST['_csrf_token'] ?? null)) {
            Session::flash('error', 'Sesi keamanan telah kadaluarsa. Silakan coba lagi.');
            Session::flash('old', $_POST);
            return redirect('/admin/kegiatan/create');
        }

        $allowedHari     = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'];
        $allowedKategori = ['administrasi', 'kebersihan', 'keamanan', 'sosial', 'keagamaan'];

        $hari     = strtolower(trim($_POST['hari'] ?? ''));
        $kategori = strtolower(trim($_POST['kategori'] ?? ''));

        if (!in_array($hari, $allowedHari) || !in_array($kategori, $allowedKategori)) {
            Session::flash('error', 'Pilihan hari atau kategori kegiatan tidak valid.');
            Session::flash('old', $_POST);
            return redirect('/admin/kegiatan/create');
        }

        $namaKegiatan = trim($_POST['nama'] ?? '');
        $waktu        = trim($_POST['waktu'] ?? '');
        $lokasi       = trim($_POST['lokasi'] ?? '');

        if (empty($namaKegiatan) || empty($waktu)) {
            Session::flash('error', 'Nama kegiatan dan waktu pelaksanaan wajib diisi!');
            Session::flash('old', $_POST);
            return redirect('/admin/kegiatan/create');
        }

        $db = App::resolve(Database::class);

        $db->query(
            "INSERT INTO kegiatan_rutin 
            (nama_kegiatan, hari, kategori, waktu_pelaksanaan, lokasi, keterangan_frekuensi, deskripsi_singkat, persyaratan_ketentuan) 
            VALUES 
            (:nama_kegiatan, :hari, :kategori, :waktu_pelaksanaan, :lokasi, :keterangan_frekuensi, :deskripsi_singkat, :persyaratan_ketentuan)",
            [
                'nama_kegiatan'         => $namaKegiatan,
                'hari'                  => $hari,
                'kategori'              => $kategori,
                'waktu_pelaksanaan'     => $waktu,
                'lokasi'                => !empty($lokasi) ? $lokasi : null,
                'keterangan_frekuensi'  => !empty($_POST['frekuensi']) ? trim($_POST['frekuensi']) : null,
                'deskripsi_singkat'     => !empty($_POST['deskripsi']) ? trim($_POST['deskripsi']) : null,
                'persyaratan_ketentuan' => !empty($_POST['persyaratan_ketentuan']) ? trim($_POST['persyaratan_ketentuan']) : null
            ]
        );

        Session::flash('sukses', 'Kegiatan rutin berhasil ditambahkan ke jadwal warga!');

        return redirect('/admin/kegiatan');
    }

    /**
     * 4. Menampilkan Form Edit Kegiatan Rutin (Khusus Admin/Pengurus RW)
     */
    public function edit()
    {
        $user = \App\Models\User::current();
        if (!$user->isRw()) {
            Session::flash('error', 'Akses ditolak. Pengurus RT tidak memiliki hak akses untuk mengedit kegiatan.');
            return redirect('/dashboard');
        }

        $id = $_GET['id'] ?? null;

        if (!$id) {
            abort(404);
        }

        $db = App::resolve(Database::class);
        $kegiatan = $db->query("SELECT * FROM kegiatan_rutin WHERE id = :id", ['id' => $id])->find();

        if (!$kegiatan) {
            abort(404);
        }

        return view('admin/edit-kegiatan.php', [
            'kegiatan' => $kegiatan
        ]);
    }

    /**
     * 5. Memproses Update Data Kegiatan Rutin (Khusus Admin/Pengurus RW)
     */
    public function update()
    {
        $user = \App\Models\User::current();
        if (!$user->isRw()) {
            Session::flash('error', 'Akses ditolak. Pengurus RT tidak memiliki hak akses untuk mengedit kegiatan.');
            return redirect('/dashboard');
        }

        if (!Csrf::verify($_POST['_csrf_token'] ?? null)) {
            Session::flash('error', 'Sesi keamanan telah kadaluarsa. Silakan coba lagi.');
            return redirect('/admin/kegiatan');
        }

        $id = $_POST['id'] ?? null;
        if (!$id) {
            abort(404);
        }

        $allowedHari     = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'];
        $allowedKategori = ['administrasi', 'kebersihan', 'keamanan', 'sosial', 'keagamaan'];

        $hari     = strtolower(trim($_POST['hari'] ?? ''));
        $kategori = strtolower(trim($_POST['kategori'] ?? ''));

        if (!in_array($hari, $allowedHari) || !in_array($kategori, $allowedKategori)) {
            Session::flash('error', 'Pilihan hari atau kategori kegiatan tidak valid.');
            return redirect('/admin/kegiatan/edit?id=' . $id);
        }

        $namaKegiatan = trim($_POST['nama'] ?? '');
        $waktu        = trim($_POST['waktu'] ?? '');
        $lokasi       = trim($_POST['lokasi'] ?? '');

        if (empty($namaKegiatan) || empty($waktu)) {
            Session::flash('error', 'Nama kegiatan dan waktu pelaksanaan wajib diisi!');
            return redirect('/admin/kegiatan/edit?id=' . $id);
        }

        $db = App::resolve(Database::class);

        $db->query(
            "UPDATE kegiatan_rutin SET 
                nama_kegiatan = :nama_kegiatan,
                hari = :hari,
                kategori = :kategori,
                waktu_pelaksanaan = :waktu_pelaksanaan,
                lokasi = :lokasi,
                keterangan_frekuensi = :keterangan_frekuensi,
                deskripsi_singkat = :deskripsi_singkat,
                persyaratan_ketentuan = :persyaratan_ketentuan
            WHERE id = :id",
            [
                'id'                    => $id,
                'nama_kegiatan'         => $namaKegiatan,
                'hari'                  => $hari,
                'kategori'              => $kategori,
                'waktu_pelaksanaan'     => $waktu,
                'lokasi'                => !empty($lokasi) ? $lokasi : null,
                'keterangan_frekuensi'  => !empty($_POST['frekuensi']) ? trim($_POST['frekuensi']) : null,
                'deskripsi_singkat'     => !empty($_POST['deskripsi']) ? trim($_POST['deskripsi']) : null,
                'persyaratan_ketentuan' => !empty($_POST['persyaratan_ketentuan']) ? trim($_POST['persyaratan_ketentuan']) : null
            ]
        );

        Session::flash('sukses', 'Jadwal kegiatan rutin berhasil diperbarui!');

        return redirect('/admin/kegiatan');
    }

    /**
     * 6. Hapus Data Kegiatan Rutin (Khusus Admin/Pengurus RW)
     */
    public function destroy()
    {
        $user = \App\Models\User::current();
        if (!$user->isRw()) {
            Session::flash('error', 'Akses ditolak. Pengurus RT tidak memiliki hak akses untuk menghapus kegiatan.');
            return redirect('/dashboard');
        }

        if (!Csrf::verify($_POST['_csrf_token'] ?? null)) {
            Session::flash('error', 'Sesi keamanan telah kadaluarsa. Silakan coba lagi.');
            return redirect('/admin/kegiatan');
        }

        $id = $_POST['id'] ?? null;

        if ($id) {
            $db = App::resolve(Database::class);
            $db->query("DELETE FROM kegiatan_rutin WHERE id = :id", ['id' => $id]);
            Session::flash('sukses', 'Jadwal kegiatan rutin berhasil dihapus.');
        }

        return redirect('/admin/kegiatan');
    }

    public function adminIndex()
    {
        $user = \App\Models\User::current();
        if (!$user->isRw()) {
            Session::flash('error', 'Akses ditolak. Pengurus RT tidak memiliki hak akses manajemen kegiatan.');
            return redirect('/dashboard');
        }

        $db = App::resolve(Database::class);

        $search   = $_GET['search'] ?? '';
        $hari     = $_GET['hari'] ?? '';
        $kategori = $_GET['kategori'] ?? '';

        $query  = "SELECT * FROM kegiatan_rutin WHERE 1=1";
        $params = [];

        if (!empty($search)) {
            $query .= " AND (nama_kegiatan LIKE :search OR deskripsi_singkat LIKE :search OR persyaratan_ketentuan LIKE :search OR lokasi LIKE :search)";
            $params['search'] = "%{$search}%";
        }

        if (!empty($hari)) {
            $query .= " AND hari = :hari";
            $params['hari'] = $hari;
        }

        if (!empty($kategori)) {
            $query .= " AND kategori = :kategori";
            $params['kategori'] = $kategori;
        }

        $query .= " ORDER BY FIELD(hari, 'senin','selasa','rabu','kamis','jumat','sabtu','minggu'), id DESC";

        $kegiatanList = $db->query($query, $params)->get();

        return view('admin/kegiatan.php', [
            'kegiatanList' => $kegiatanList,
            'search'       => $search,
            'hari'         => $hari,
            'kategori'     => $kategori
        ]);
    }
}
