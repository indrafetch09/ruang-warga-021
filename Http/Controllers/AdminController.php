<?php

namespace App\Controllers;

use Core\App;
use Core\Database;
use App\Models\User;
use App\Models\Warga;
use App\Models\Notulensi;

class AdminController
{
    /**
     * Tampilkan Dasbor Utama Pengurus (Admin Portal)
     */
    public function dashboard()
    {
        $db = App::resolve(Database::class);
        $user = User::current();

        // 1. Hitung Statistik Real dari Database
        $totalWarga      = (int)($db->query("SELECT COUNT(id) as count FROM warga")->find()['count'] ?? 0);
        $totalKK         = (int)($db->query("SELECT COUNT(id) as count FROM warga WHERE status_keluarga = 'kepala_keluarga'")->find()['count'] ?? 0);
        $totalVerified   = (int)($db->query("SELECT COUNT(id) as count FROM warga WHERE status_verifikasi = 'verified'")->find()['count'] ?? 0);
        $totalPending    = (int)($db->query("SELECT COUNT(id) as count FROM warga WHERE status_verifikasi = 'pending'")->find()['count'] ?? 0);

        $totalPengumuman = (int)($db->query("SELECT COUNT(id) as count FROM pengumuman")->find()['count'] ?? 0);
        $totalNotulensi  = (int)($db->query("SELECT COUNT(id) as count FROM notulensi")->find()['count'] ?? 0);
        $totalGaleri     = (int)($db->query("SELECT COUNT(id) as count FROM galeri")->find()['count'] ?? 0);

        // 2. Data Warga Terbaru
        $recentWargaRaw = $db->query("SELECT * FROM warga ORDER BY created_at DESC LIMIT 5")->get();
        $recentWarga    = array_map(fn($row) => new Warga($row), $recentWargaRaw);

        // 3. Data Notulensi Rapat Terbaru
        $recentNotulensiRaw = $db->query("SELECT * FROM notulensi ORDER BY tanggal DESC LIMIT 5")->get();
        $recentNotulensi    = array_map(fn($row) => new Notulensi($row), $recentNotulensiRaw);

        // 4. Sebaran Penduduk per RT
        $wargaPerRtRaw = $db->query("SELECT rt, COUNT(id) as total FROM warga GROUP BY rt ORDER BY rt ASC")->get();
        $wargaPerRt    = [];
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
            'recentWarga'      => $recentWarga,
            'recentNotulensi'  => $recentNotulensi,
            'wargaPerRt'       => $wargaPerRt,
        ]);
    }
}
