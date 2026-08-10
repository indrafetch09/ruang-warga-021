<?php

namespace App\Controllers;

use App\Models\Pengumuman;
use App\Models\Notulensi;
use App\Models\Pengurus;
use App\Models\Warga;
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

        // A. Hitung Ringkasan Statistik Warga
        $totalWarga = (int)($db->query("SELECT COUNT(id) as total FROM warga WHERE status_verifikasi = 'verified'")->find()['total'] ?? 0);
        $totalKK    = (int)($db->query("SELECT COUNT(DISTINCT no_kk) as total FROM warga WHERE status_verifikasi = 'verified'")->find()['total'] ?? 0);

        // B. Menggunakan Scope Method buatan lu: Pengumuman::getPublished()
        $pengumumanTerbaru = array_slice(Pengumuman::getPublished(), 0, 3);

        // C. Ambil 3 Notulensi Rapat Terbaru (Mapped ke Model Notulensi)
        $notulensiRaw     = $db->query("SELECT * FROM " . Notulensi::$table . " ORDER BY tanggal DESC LIMIT 3")->get();
        $notulensiTerbaru = array_map(fn($row) => new Notulensi($row), $notulensiRaw);

        return view('user/index.view.php', [
            'totalWarga'       => $totalWarga,
            'totalKK'          => $totalKK,
            'pengumumanList'   => $pengumumanTerbaru,
            'notulensiList'    => $notulensiTerbaru
        ]);
    }

    /**
     * 2. Halaman Tentang Kami (tentang-kami.php)
     */
    public function about()
    {
        $db = App::resolve(Database::class);

        $profil = $db->query("SELECT * FROM profil_rw LIMIT 1")->find();

        return view('user/tentang-kami.php', [
            'profil' => $profil
        ]);
    }

    /**
     * 3. Halaman Struktur Pengurus RW (pengurus-rw.php)
     */
    public function pengurus()
    {
        $db = App::resolve(Database::class);

        $rawPengurus = $db->query("SELECT p.*, w.no_hp FROM pengurus p LEFT JOIN warga w ON p.warga_id = w.id ORDER BY p.id ASC")->get();

        $ketua = null;
        $sekretaris = null;
        $bendahara = null;
        $seksiList = [];

        foreach ($rawPengurus as $p) {
            $nama = $p['nama'] ?? 'Pengurus';
            $jabatan = $p['jabatan'] ?? '';
            $foto = 'https://ui-avatars.com/api/?name=' . urlencode($nama) . '&background=7c3aed&color=fff&size=150';

            if (stripos($jabatan, 'ketua rw') !== false || (stripos($jabatan, 'ketua') !== false && ($p['tingkat'] ?? '') === 'RW')) {
                $ketua = ['nama' => $nama, 'jabatan' => $jabatan, 'periode' => 'Masa Bakti 2024 - 2027', 'foto' => $foto];
            } elseif (stripos($jabatan, 'sekretaris') !== false) {
                $sekretaris = ['nama' => $nama, 'foto' => $foto];
            } elseif (stripos($jabatan, 'bendahara') !== false) {
                $bendahara = ['nama' => $nama, 'foto' => $foto];
            } else {
                $seksiList[] = ['nama' => $nama, 'seksi' => $jabatan, 'color' => 'purple', 'foto' => $foto];
            }
        }

        $rtStatsRaw = $db->query("SELECT rt, COUNT(DISTINCT no_kk) as kk, COUNT(id) as warga FROM warga WHERE status_verifikasi = 'verified' GROUP BY rt ORDER BY rt ASC")->get();
        $listRt = [];
        foreach ($rtStatsRaw as $row) {
            $rtNum = sprintf('%02d', (int)$row['rt']);
            $ketuaRtRow = array_filter($rawPengurus, fn($pr) => ($pr['tingkat'] ?? '') === 'RT' && ($pr['no_wilayah'] ?? '') === $rtNum);
            $ketuaRtName = !empty($ketuaRtRow) ? reset($ketuaRtRow)['nama'] : 'Ketua RT ' . $rtNum;

            $listRt[] = [
                'rt' => $rtNum,
                'ketua' => $ketuaRtName,
                'kk' => (int)$row['kk'],
                'warga' => (int)$row['warga']
            ];
        }

        return view('user/pengurus-rw.php', [
            'ketuaRw'      => $ketua,
            'sekretarisRw' => $sekretaris,
            'bendaharaRw'  => $bendahara,
            'seksiList'    => $seksiList,
            'listRt'       => $listRt
        ]);
    }
}
