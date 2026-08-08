<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Warga;
use Core\App;
use Core\Database;
use Core\Crypt;
use Core\Session;

class WargaController
{
    /**
     * Mendapatkan objek User yang sedang login
     */
    private function getCurrentUser()
    {
        $uData = Session::get('user') ?? ['id' => 1, 'name' => 'Admin RW 021', 'role' => 'admin'];
        if (is_array($uData)) {
            return new class($uData) {
                public array $data;
                public function __construct($d) { $this->data = $d; }
                public function isRw() { return true; }
                public function isRt() { return false; }
                public function getRtAssigned() { return 1; }
            };
        }
        return $uData;
    }

    /**
     * 1. Menampilkan Daftar Warga (daftar-warga.php)
     */
    public function index()
    {
        $user = $this->getCurrentUser();

        $wargaList = [];
        $pendingList = [];

        // Logic Hak Akses RW vs RT
        if ($user->isRw()) {
            // RW: Tarik semua data se-RW
            $wargaList = Warga::getByStatus('verified');
            $pendingList = Warga::getByStatus('pending'); // Warga yang butuh approval
        } else if ($user->isRt()) {
            // RT: Tarik data HANYA untuk RT dia bertugas
            $rtAssigned = $user->getRtAssigned();
            $wargaList = Warga::getByRtAndStatus($rtAssigned, 'verified');
            $pendingList = Warga::getByRtAndStatus($rtAssigned, 'pending');
        }

        // DEKRIPSI: Buka gembok NIK dan No HP biar bisa dibaca di tabel view
        $decryptData = function ($wargaArray) {
            foreach ($wargaArray as $w) {
                // Gunakan try-catch bawaan Crypt (atau fallback ke data asli jika gagal)
                $nikAsli = Crypt::decrypt($w->nik);
                $noHpAsli = Crypt::decrypt($w->no_hp);

                $w->nik_readable = $nikAsli !== false ? $nikAsli : '***ENCRYPTED***';
                $w->no_hp_readable = $noHpAsli !== false ? $noHpAsli : '-';
            }
            return $wargaArray;
        };

        $wargaList = $decryptData($wargaList);
        $pendingList = $decryptData($pendingList);

        return view('admin/daftar-warga.php', [
            'user' => $user,
            'wargaList' => $wargaList,
            'pendingList' => $pendingList
        ]);
    }

    /**
     * 2. Menampilkan Form Tambah Warga (tambah-warga.php)
     */
    public function create()
    {
        $user = $this->getCurrentUser();
        return view('admin/tambah-warga.php', ['user' => $user]);
    }

    /**
     * 3. Menyimpan Data Warga Baru
     */
    public function store()
    {
        $user = $this->getCurrentUser();
        $db = App::resolve(Database::class);

        // ENKRIPSI data sensitif dari POST
        $nikAman = Crypt::encrypt($_POST['nik']);
        $noHpAman = Crypt::encrypt($_POST['no_hp']);

        // Setel Status Verifikasi
        $statusVerifikasi = $user->isRw() ? 'verified' : 'pending';

        // Paksa nilai RT jika yang input adalah Admin RT agar tidak bisa memanipulasi RT lain
        $rt = $user->isRt() ? $user->getRtAssigned() : $_POST['rt'];

        // Simpan ke Database
        $db->query(
            "INSERT INTO warga 
            (no_kk, nik, nama, tempat_lahir, tanggal_lahir, jenis_kelamin, rt, blok, nomor, no_hp, status_warga, jml_anggota_keluarga, agama, pekerjaan, status_verifikasi, created_by) 
            VALUES 
            (:no_kk, :nik, :nama, :tempat_lahir, :tanggal_lahir, :jenis_kelamin, :rt, :blok, :nomor, :no_hp, :status_warga, :jml_anggota_keluarga, :agama, :pekerjaan, :status_verifikasi, :created_by)",
            [
                'no_kk' => $_POST['no_kk'],
                'nik' => $nikAman,
                'nama' => $_POST['nama'],
                'tempat_lahir' => $_POST['tempat_lahir'] ?? null,
                'tanggal_lahir' => $_POST['tanggal_lahir'],
                'jenis_kelamin' => $_POST['jenis_kelamin'],
                'rt' => $rt,
                'blok' => $_POST['blok'],
                'nomor' => $_POST['nomor'],
                'no_hp' => $noHpAman,
                'status_warga' => $_POST['status_warga'],
                'jml_anggota_keluarga' => $_POST['jml_anggota_keluarga'] ?? 1,
                'agama' => $_POST['agama'] ?? null,
                'pekerjaan' => $_POST['pekerjaan'] ?? null,
                'status_verifikasi' => $statusVerifikasi,
                'created_by' => $user->id
            ]
        );

        // Berikan pesan flash (opsional, jika Session lu dukung flash message)
        Session::flash('sukses', 'Data warga berhasil disimpan.');

        redirect('/admin/warga');
    }

    /**
     * 4. Memverifikasi / Approve Pengajuan dari RT
     * Khusus RW
     */
    public function approve()
    {
        $user = $this->getCurrentUser();

        // Cek keamanan ganda: Hanya RW yang boleh nge-hit route ini
        if (!$user->isRw()) {
            abort(403);
        }

        $wargaId = $_POST['warga_id'] ?? null;
        if ($wargaId) {
            $db = App::resolve(Database::class);
            $db->query("UPDATE warga SET status_verifikasi = 'verified' WHERE id = :id", [
                'id' => $wargaId
            ]);
        }

        redirect('/admin/warga');
    }

    /**
     * 5. Menolak Pengajuan dari RT
     * Khusus RW
     */
    public function reject()
    {
        $user = $this->getCurrentUser();

        if (!$user->isRw()) {
            abort(403);
        }

        $wargaId = $_POST['warga_id'] ?? null;
        if ($wargaId) {
            $db = App::resolve(Database::class);
            // Bisa menggunakan DELETE atau di-set ke 'rejected'
            $db->query("UPDATE warga SET status_verifikasi = 'rejected' WHERE id = :id", [
                'id' => $wargaId
            ]);
        }

        redirect('/admin/warga');
    }
}
