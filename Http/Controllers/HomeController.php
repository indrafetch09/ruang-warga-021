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

        // A. Hitung Ringkasan Statistik Warga (Hanya data verified)
        $totalWarga = $db->query("SELECT COUNT(id) as total FROM warga WHERE status_verifikasi = 'verified'")->find()['total'];
        $totalKK    = $db->query("SELECT COUNT(DISTINCT no_kk) as total FROM warga WHERE status_verifikasi = 'verified'")->find()['total'];

        // B. Ambil 3 Pengumuman Terbaru yang Di-publish (Memakai Scope Model Pengumuman)
        $pengumumanTerbaru = array_slice(Pengumuman::getPublished(), 0, 3);

        // C. Ambil 3 Notulensi Rapat Terbaru
        $notulensiTerbaru = $db->query("SELECT * FROM notulensi ORDER BY tanggal DESC LIMIT 3")->get();

        return view('index.view.php', [
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

        // Ambil data profil RW dari database
        $profil = $db->query("SELECT * FROM profil_rw LIMIT 1")->find();

        return view('tentang-kami.php', [
            'profil' => $profil
        ]);
    }

    /**
     * 3. Halaman Struktur Pengurus RW (pengurus-rw.php)
     * Menggunakan EAGER LOADING + DEKRIPSI DATA
     */
    public function pengurus()
    {
        // A. Ambil semua data Pengurus
        $pengurusList = Pengurus::all();

        // B. EAGER LOADING: Load data relasi Warga secara massal (1 Query tambahan pakian WHERE IN)
        // Parameter: ($models, $relationName, $relatedModel, $foreignKey, $type)
        $pengurusList = Model::with($pengurusList, 'warga', Warga::class, 'warga_id', 'belongsTo');

        // C. DEKRIPSI DATA: No HP Warga yang terenkripsi di DB kita buka kembali agar bisa dibaca di View
        foreach ($pengurusList as $p) {
            // Contoh LAZY LOADING (jika $p->warga dipanggil tanpa Eager Loading di atas, 
            // magic __get() di Model.php akan otomatis nge-fetch data Warga secara lazy)
            if ($p->warga && !empty($p->warga->no_hp)) {
                // Dekripsi No HP dari cipher base64 ke teks biasa
                $noHpPlain = Crypt::decrypt($p->warga->no_hp);
                $p->no_hp_readable = $noHpPlain !== false ? $noHpPlain : $p->warga->no_hp;
            } else {
                $p->no_hp_readable = '-';
            }
        }

        return view('pengurus-rw.php', [
            'pengurusList' => $pengurusList
        ]);
    }
}
