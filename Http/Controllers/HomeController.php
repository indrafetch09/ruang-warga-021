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
        // A. Ambil semua data Pengurus via Model
        $pengurusList = Pengurus::all();

        // B. EAGER LOADING: Menggunakan fungsi relasi warga() di model Pengurus
        $pengurusList = Model::with($pengurusList, 'warga', Warga::class, 'warga_id', 'belongsTo');

        // C. Dekripsi No HP Warga
        foreach ($pengurusList as $p) {
            if ($p->warga && !empty($p->warga->no_hp)) {
                $noHpPlain = Crypt::decrypt($p->warga->no_hp);
                $p->no_hp_readable = $noHpPlain !== false ? $noHpPlain : $p->warga->no_hp;
            } else {
                $p->no_hp_readable = '-';
            }
        }

        return view('user/pengurus-rw.php', [
            'pengurusList' => $pengurusList
        ]);
    }
}
