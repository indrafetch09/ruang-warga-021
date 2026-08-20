<?php

namespace App\Controllers;

use Core\App;
use Core\Database;

class StatistikController
{
    /**
     * Menampilkan halaman statistik kependudukan warga RW 021
     */
    public function index()
    {
        $db = App::resolve(Database::class);

        // 1. Total statistik umum (warga terverifikasi)
        $totalWarga = (int)($db->query("SELECT COUNT(id) as total FROM warga WHERE status_verifikasi = 'verified'")->find()['total'] ?? 0);
        $totalKK    = (int)($db->query("SELECT COUNT(id) as total FROM warga WHERE status_verifikasi = 'verified' AND status_keluarga = 'kepala_keluarga'")->find()['total'] ?? 0);
        $totalAll   = (int)($db->query("SELECT COUNT(id) as total FROM warga")->find()['total'] ?? 0);

        // Fallback jika belum ada field status_keluarga spesifik tapi ada nik_kepala_keluarga
        if ($totalKK === 0 && $totalWarga > 0) {
            $totalKK = (int)($db->query("SELECT COUNT(DISTINCT CASE WHEN nik_kepala_keluarga IS NOT NULL AND nik_kepala_keluarga != '' THEN nik_kepala_keluarga ELSE id END) as total FROM warga WHERE status_verifikasi = 'verified'")->find()['total'] ?? 0);
        }

        $pctVerified = $totalAll > 0 ? round(($totalWarga / $totalAll) * 100) . '%' : '100%';

        $summaryData = [
            'total_kk'   => $totalKK,
            'total_jiwa' => $totalWarga,
            'total_rt'   => 10,
            'verifikasi' => $pctVerified
        ];

        // 2. Data sebaran penduduk per RT 01 s/d RT 10 (menggunakan status_keluarga / nik_kepala_keluarga)
        $rtCountsRaw = $db->query("
            SELECT 
                rt, 
                COUNT(CASE WHEN status_keluarga = 'kepala_keluarga' THEN 1 END) as kk_count,
                COUNT(DISTINCT CASE WHEN nik_kepala_keluarga IS NOT NULL AND nik_kepala_keluarga != '' THEN nik_kepala_keluarga ELSE NULL END) as kk_nik_count,
                COUNT(id) as jiwa 
            FROM warga 
            WHERE status_verifikasi = 'verified' 
            GROUP BY rt
        ")->get();

        $listDataRt = [];
        $chartBarLabels = [];
        $chartBarKk = [];
        $chartBarJiwa = [];

        for ($i = 1; $i <= 10; $i++) {
            $listDataRt[$i] = ['kk' => 0, 'jiwa' => 0];
            $chartBarLabels[] = 'RT ' . sprintf('%02d', $i);
        }

        foreach ($rtCountsRaw as $row) {
            $rtNum = (int)$row['rt'];
            if ($rtNum >= 1 && $rtNum <= 10) {
                $kk = (int)($row['kk_count'] > 0 ? $row['kk_count'] : $row['kk_nik_count']);
                $jiwa = (int)$row['jiwa'];

                $listDataRt[$rtNum] = [
                    'kk'   => $kk,
                    'jiwa' => $jiwa
                ];
            }
        }

        for ($i = 1; $i <= 10; $i++) {
            $chartBarKk[]   = $listDataRt[$i]['kk'];
            $chartBarJiwa[] = $listDataRt[$i]['jiwa'];
        }

        // 3. Komposisi Gender (L / P)
        $genderRaw = $db->query("
            SELECT jenis_kelamin, COUNT(id) as total 
            FROM warga 
            WHERE status_verifikasi = 'verified' 
            GROUP BY jenis_kelamin
        ")->get();

        $genderStats = ['L' => 0, 'P' => 0];
        foreach ($genderRaw as $g) {
            $jk = strtoupper($g['jenis_kelamin'] ?? '');
            if (isset($genderStats[$jk])) {
                $genderStats[$jk] = (int)$g['total'];
            }
        }

        $chartGenderData = [$genderStats['L'], $genderStats['P']];

        // 4. Kelompok Usia (Anak <12, Remaja 12-25, Dewasa 26-59, Lansia >=60)
        $usiaRaw = $db->query("
            SELECT 
                SUM(CASE WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) < 12 THEN 1 ELSE 0 END) as anak,
                SUM(CASE WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 12 AND 25 THEN 1 ELSE 0 END) as remaja,
                SUM(CASE WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 26 AND 59 THEN 1 ELSE 0 END) as dewasa,
                SUM(CASE WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) >= 60 THEN 1 ELSE 0 END) as lansia
            FROM warga 
            WHERE status_verifikasi = 'verified'
        ")->find();

        $chartUsiaData = [
            (int)($usiaRaw['anak'] ?? 0),
            (int)($usiaRaw['remaja'] ?? 0),
            (int)($usiaRaw['dewasa'] ?? 0),
            (int)($usiaRaw['lansia'] ?? 0),
        ];

        return view('user/statistik.php', [
            'summaryData'     => $summaryData,
            'listDataRt'      => $listDataRt,
            'genderStats'     => $genderStats,
            'chartBarLabels'  => $chartBarLabels,
            'chartBarKk'      => $chartBarKk,
            'chartBarJiwa'    => $chartBarJiwa,
            'chartGenderData' => $chartGenderData,
            'chartUsiaData'   => $chartUsiaData,
        ]);
    }
}
