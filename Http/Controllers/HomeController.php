<?php

namespace App\Controllers;

use App\Models\Pengumuman;
use App\Models\Notulensi;
use App\Models\Pengurus;
use App\Models\Warga;
use App\Models\Galeri;
use Core\Model;
use Core\Crypt;
use Core\App;
use Core\Database;

class HomeController
{
    /**
     * 1. Halaman Beranda / Dashboard Publik (index.view.php)
     */
    public function index()
    {
        $db = App::resolve(Database::class);

        $totalWarga = (int)($db->query("SELECT COUNT(id) as total FROM warga WHERE status_verifikasi = 'verified'")->find()['total'] ?? 0);
        $totalKK    = (int)($db->query("SELECT COUNT(id) as total FROM warga WHERE status_verifikasi = 'verified' AND status_keluarga = 'kepala_keluarga'")->find()['total'] ?? 0);

        $pengumumanTerbaru = array_slice(Pengumuman::getPublished(), 0, 3);

        $notulensiRaw     = $db->query("SELECT * FROM " . (Notulensi::$table ?? 'notulensi') . " ORDER BY tanggal DESC LIMIT 3")->get();
        $notulensiTerbaru = array_map(fn($row) => new Notulensi($row), $notulensiRaw);

        $galeriRaw        = $db->query("SELECT * FROM " . (Galeri::$table ?? 'galeri') . " ORDER BY tanggal DESC, id DESC LIMIT 6")->get();
        $galeriTerbaru    = array_map(fn($row) => new Galeri($row), $galeriRaw);

        return view('user/index.view.php', [
            'totalWarga'       => $totalWarga,
            'totalKK'          => $totalKK,
            'pengumumanList'   => $pengumumanTerbaru,
            'notulensiList'    => $notulensiTerbaru,
            'galeriList'       => $galeriTerbaru
        ]);
    }

    /**
     * 2. Halaman Tentang Kami / Profil (tentang-kami.php)
     */
    public function about()
    {
        $db = App::resolve(Database::class);
        $profil = $db->query("SELECT * FROM profil_rw LIMIT 1")->find();

        // Ambil seluruh data kegiatan rutin dari database
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

        return view('user/tentang-kami.php', [
            'profil'         => $profil,
            'kegiatanByHari' => $kegiatanByHari
        ]);
    }

    /**
     * 3. Halaman Struktur Pengurus RW & Data RT (pengurus-rw.php)
     */
    public function pengurus()
    {
        $db = App::resolve(Database::class);
        $pengurusList = $db->query("SELECT * FROM pengurus ORDER BY id ASC")->get();

        return view('user/pengurus-rw.php', [
            'pengurusList' => $pengurusList
        ]);
    }
}
