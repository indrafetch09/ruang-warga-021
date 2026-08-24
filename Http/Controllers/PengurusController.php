<?php

namespace App\Controllers;

use App\Models\Pengurus;
use App\Models\Warga;
use App\Models\User;
use Core\App;
use Core\Database;
use Core\Session;
use Core\Csrf;

class PengurusController
{
    /**
     * 1. Daftar Struktur Pengurus (Admin Panel)
     */
    public function index()
    {
        $user = User::current();
        if (!$user->isRw()) {
            Session::flash('error', 'Akses ditolak. Pengurus RT tidak memiliki hak akses manajemen pengurus.');
            return redirect('/dashboard');
        }

        $db = App::resolve(Database::class);
        $pengurusList = $db->query("SELECT * FROM pengurus ORDER BY urutan ASC, id ASC")->get();

        return view('admin/pengurus.php', [
            'user'         => $user,
            'pengurusList' => $pengurusList
        ]);
    }

    /**
     * 2. Form Tambah Pengurus (Khusus Super Admin)
     */
    public function create()
    {
        $user = User::current();
        if (!$user->isAdmin()) {
            Session::flash('error', 'Akses ditolak. Hanya Super Admin yang berhak menugaskan pengurus.');
            return redirect('/admin/pengurus');
        }

        $wargaList = Warga::getByStatus('verified');

        return view('admin/tambah-pengurus.php', [
            'user'      => $user,
            'wargaList' => $wargaList
        ]);
    }

    /**
     * 3. Simpan Data Pengurus Baru (Khusus Super Admin)
     */
    public function store()
    {
        if (!Csrf::verify($_POST['_csrf_token'] ?? null)) {
            Session::flash('error', 'Sesi keamanan telah kadaluarsa. Silakan coba lagi.');
            return redirect('/admin/pengurus/create');
        }

        $user = User::current();
        if (!$user->isAdmin()) {
            Session::flash('error', 'Akses ditolak. Hanya Super Admin yang berhak menugaskan pengurus.');
            return redirect('/admin/pengurus');
        }

        $db = App::resolve(Database::class);
        $wargaId = $_POST['warga_id'] ?? null;

        if (!$wargaId) {
            Session::flash('error', 'Silakan cari dan pilih nama warga terlebih dahulu.');
            return redirect('/admin/pengurus/create');
        }

        $warga = Warga::find($wargaId);
        if (!$warga) {
            Session::flash('error', 'Data warga tidak ditemukan.');
            return redirect('/admin/pengurus/create');
        }

        $wargaIdVal   = is_object($warga) ? ($warga->id ?? null) : ($warga['id'] ?? null);
        $wargaNamaVal = is_object($warga) ? ($warga->nama ?? '') : ($warga['nama'] ?? '');

        // Auto-assign urutan tampilan berdasarkan kategori hirarki
        $urutanInput = $_POST['urutan'] ?? null;
        if (empty($urutanInput)) {
            switch ($_POST['kategori_jabatan'] ?? '') {
                case 'penasehat':
                    $urutanInput = 1;
                    break;
                case 'ketua':
                    $urutanInput = 2;
                    break;
                case 'sekretaris':
                    $urutanInput = 3;
                    break;
                case 'bendahara':
                    $urutanInput = 4;
                    break;
                case 'seksi':
                    $urutanInput = 5;
                    break;
                case 'tim_pendukung':
                    $urutanInput = 6;
                    break;
                case 'ketua_rt':
                    $urutanInput = 7;
                    break;
                default:
                    $urutanInput = 99;
                    break;
            }
        }

        // Query INSERT Bersih
        $db->query(
            "INSERT INTO pengurus 
            (warga_id, nama, jabatan, kategori_jabatan, urutan, periode) 
            VALUES 
            (:warga_id, :nama, :jabatan, :kategori_jabatan, :urutan, :periode)",
            [
                'warga_id'         => $wargaIdVal,
                'nama'             => $wargaNamaVal,
                'jabatan'          => trim($_POST['jabatan'] ?? ''),
                'kategori_jabatan' => $_POST['kategori_jabatan'] ?? 'seksi',
                'urutan'           => $urutanInput,
                'periode'          => !empty($_POST['periode']) ? trim($_POST['periode']) : '2025 - 2028'
            ]
        );

        Session::flash('sukses', 'Pengurus RW 021 berhasil ditambahkan!');

        return redirect('/admin/pengurus');
    }

    /**
     * 4. Form Edit Pengurus (Khusus Super Admin)
     */
    public function edit()
    {
        $user = User::current();
        if (!$user->isAdmin()) {
            Session::flash('error', 'Akses ditolak. Hanya Super Admin yang berhak mengedit data pengurus.');
            return redirect('/admin/pengurus');
        }

        $id = $_GET['id'] ?? null;

        if (!$id) {
            abort(404);
        }

        $db = App::resolve(Database::class);
        $pengurus = $db->query("SELECT * FROM pengurus WHERE id = :id", ['id' => $id])->find();

        if (!$pengurus) {
            abort(404);
        }

        $wargaList = Warga::getByStatus('verified');

        return view('admin/edit-pengurus.php', [
            'user'      => $user,
            'pengurus'  => $pengurus,
            'wargaList' => $wargaList
        ]);
    }

    /**
     * 5. Update Data Pengurus (Khusus Super Admin)
     */
    public function update()
    {
        if (!Csrf::verify($_POST['_csrf_token'] ?? null)) {
            Session::flash('error', 'Sesi keamanan telah kadaluarsa. Silakan coba lagi.');
            return redirect('/admin/pengurus');
        }

        $user = User::current();
        if (!$user->isAdmin()) {
            Session::flash('error', 'Akses ditolak. Hanya Super Admin yang berhak mengubah data pengurus.');
            return redirect('/admin/pengurus');
        }

        $id = $_POST['id'] ?? null;
        if (!$id) {
            abort(404);
        }

        $wargaId = $_POST['warga_id'] ?? null;
        if (!$wargaId) {
            Session::flash('error', 'Silakan pilih warga terlebih dahulu.');
            return redirect('/admin/pengurus/edit?id=' . $id);
        }

        $warga = Warga::find($wargaId);
        if (!$warga) {
            Session::flash('error', 'Data warga tidak ditemukan.');
            return redirect('/admin/pengurus/edit?id=' . $id);
        }

        $wargaIdVal   = is_object($warga) ? ($warga->id ?? null) : ($warga['id'] ?? null);
        $wargaNamaVal = is_object($warga) ? ($warga->nama ?? '') : ($warga['nama'] ?? '');

        $urutanInput = $_POST['urutan'] ?? null;
        if (empty($urutanInput)) {
            switch ($_POST['kategori_jabatan'] ?? '') {
                case 'penasehat':
                    $urutanInput = 1;
                    break;
                case 'ketua':
                    $urutanInput = 2;
                    break;
                case 'sekretaris':
                    $urutanInput = 3;
                    break;
                case 'bendahara':
                    $urutanInput = 4;
                    break;
                case 'seksi':
                    $urutanInput = 5;
                    break;
                case 'tim_pendukung':
                    $urutanInput = 6;
                    break;
                case 'ketua_rt':
                    $urutanInput = 7;
                    break;
                default:
                    $urutanInput = 99;
                    break;
            }
        }

        // Query UPDATE
        $db = App::resolve(Database::class);
        $db->query(
            "UPDATE pengurus SET 
                warga_id = :warga_id, 
                nama = :nama, 
                jabatan = :jabatan, 
                kategori_jabatan = :kategori_jabatan, 
                urutan = :urutan, 
                periode = :periode 
            WHERE id = :id",
            [
                'id'               => $id,
                'warga_id'         => $wargaIdVal,
                'nama'             => $wargaNamaVal,
                'jabatan'          => trim($_POST['jabatan'] ?? ''),
                'kategori_jabatan' => $_POST['kategori_jabatan'] ?? 'seksi',
                'urutan'           => $urutanInput,
                'periode'          => !empty($_POST['periode']) ? trim($_POST['periode']) : '2025 - 2028'
            ]
        );

        Session::flash('sukses', 'Data pengurus berhasil diperbarui!');

        return redirect('/admin/pengurus');
    }

    /**
     * 6. Hapus Pengurus (Khusus Super Admin)
     */
    public function destroy()
    {
        if (!Csrf::verify($_POST['_csrf_token'] ?? null)) {
            Session::flash('error', 'Sesi keamanan telah kadaluarsa. Silakan coba lagi.');
            return redirect('/admin/pengurus');
        }

        $user = User::current();
        if (!$user->isAdmin()) {
            Session::flash('error', 'Akses ditolak. Hanya Super Admin yang berhak menghapus data pengurus.');
            return redirect('/admin/pengurus');
        }

        $id = $_POST['id'] ?? null;

        if ($id) {
            $db = App::resolve(Database::class);
            $db->query("DELETE FROM pengurus WHERE id = :id", ['id' => $id]);
            Session::flash('sukses', 'Pengurus berhasil dihapus.');
        }

        return redirect('/admin/pengurus');
    }
}
