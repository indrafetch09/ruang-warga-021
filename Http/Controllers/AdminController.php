<?php

namespace App\Controllers;

use Core\App;
use Core\Database;
use Core\Authenticator;

class AdminController
{
    /**
     * Tampilkan Dasbor Utama Pengurus (Admin Portal)
     */
    public function dashboard()
    {
        $db = App::resolve(Database::class);
        $user = Authenticator::user();

        // 1. Hitung Statistik Real dari Database
        $totalWarga     = (int)($db->query("SELECT COUNT(id) as count FROM warga")->find()['count'] ?? 0);
        $totalKK        = (int)($db->query("SELECT COUNT(DISTINCT no_kk) as count FROM warga WHERE no_kk IS NOT NULL AND no_kk != ''")->find()['count'] ?? 0);
        $totalVerified  = (int)($db->query("SELECT COUNT(id) as count FROM warga WHERE status_verifikasi = 'verified'")->find()['count'] ?? 0);
        $totalPending   = (int)($db->query("SELECT COUNT(id) as count FROM warga WHERE status_verifikasi = 'pending'")->find()['count'] ?? 0);
        
        $totalPengumuman= (int)($db->query("SELECT COUNT(id) as count FROM pengumuman")->find()['count'] ?? 0);
        $totalNotulensi = (int)($db->query("SELECT COUNT(id) as count FROM notulensi")->find()['count'] ?? 0);
        $totalGaleri    = (int)($db->query("SELECT COUNT(id) as count FROM galeri")->find()['count'] ?? 0);
        $totalLaporan   = (int)($db->query("SELECT COUNT(id) as count FROM laporan_bulanan")->find()['count'] ?? 0);

        // 2. Data Warga Terbaru
        $recentWarga = $db->query("SELECT * FROM warga ORDER BY created_at DESC LIMIT 5")->get();

        // 3. Data Notulensi Rapat Terbaru
        $recentNotulensi = $db->query("SELECT * FROM notulensi ORDER BY tanggal DESC LIMIT 5")->get();

        // 4. Sebaran Penduduk per RT
        $wargaPerRtRaw = $db->query("SELECT rt, COUNT(id) as total FROM warga GROUP BY rt ORDER BY rt ASC")->get();
        $wargaPerRt = [];
        foreach ($wargaPerRtRaw as $row) {
            $wargaPerRt[(int)$row['rt']] = (int)$row['total'];
        }

        return view('admin/dashboard.php', [
            'user'             => $user,
            'totalWarga'       => $totalWarga,
            'totalKK'          => $totalKK,
            'totalVerified'    => $totalVerified,
            'totalPending'     => $totalPending,
            'totalPengumuman'  => $totalPengumuman,
            'totalNotulensi'   => $totalNotulensi,
            'totalGaleri'      => $totalGaleri,
            'totalLaporan'     => $totalLaporan,
            'recentWarga'      => $recentWarga,
            'recentNotulensi'  => $recentNotulensi,
            'wargaPerRt'       => $wargaPerRt,
        ]);
    }
}
