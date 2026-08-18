<?php

namespace App\Controllers;

use App\Models\Pengurus;
use App\Models\Warga;
use Core\App;
use Core\Database;
use Core\Session;
use Core\Csrf;

class PengurusController
{
    /**
     * 1. Form Tambah Pengurus
     */

    public function index()
    {
        $db = App::resolve(Database::class);
        $pengurusList = $db->query("SELECT * FROM pengurus ORDER BY urutan ASC, id ASC")->get();

        // Diubah dari 'admin/manajemen-pengurus.php' menjadi 'admin/pengurus.php'
        return view('admin/pengurus.php', [
            'pengurusList' => $pengurusList
        ]);
    }
    public function create()
    {
        $wargaList = Warga::getByStatus('verified');

        return view('admin/tambah-pengurus.php', [
            'wargaList' => $wargaList
        ]);
    }

    /**
     * 2. Simpan Data Pengurus Baru
     */
    public function store()
    {
        if (!Csrf::verify($_POST['_csrf_token'] ?? null)) {
            Session::flash('error', 'Sesi keamanan telah kadaluarsa. Silakan coba lagi.');
            return redirect('/admin/pengurus/create');
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

        // Query INSERT Bersih (Tanpa tingkat & no_wilayah)
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

        return redirect('/pengurus-rw');
    }

    /**
     * 3. Form Edit Pengurus
     */
    public function edit()
    {
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
            'pengurus'  => $pengurus,
            'wargaList' => $wargaList
        ]);
    }

    /**
     * 4. Update Data Pengurus
     */
    public function update()
    {
        if (!Csrf::verify($_POST['_csrf_token'] ?? null)) {
            Session::flash('error', 'Sesi keamanan telah kadaluarsa. Silakan coba lagi.');
            return redirect('/pengurus-rw');
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

        // Query UPDATE Bersih (Tanpa tingkat & no_wilayah)
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

        return redirect('/pengurus-rw');
    }

    /**
     * 5. Hapus Pengurus
     */
    public function destroy()
    {
        if (!Csrf::verify($_POST['_csrf_token'] ?? null)) {
            Session::flash('error', 'Sesi keamanan telah kadaluarsa. Silakan coba lagi.');
            return redirect('/pengurus-rw');
        }

        $id = $_POST['id'] ?? null;

        if ($id) {
            $db = App::resolve(Database::class);
            $db->query("DELETE FROM pengurus WHERE id = :id", ['id' => $id]);
            Session::flash('sukses', 'Pengurus berhasil dihapus.');
        }

        return redirect('/pengurus-rw');
    }
}
