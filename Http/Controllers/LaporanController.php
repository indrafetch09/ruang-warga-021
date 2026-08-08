<?php

namespace App\Controllers;

use Core\App;
use Core\Database;
use Core\Session;

class LaporanController
{
    /**
     * 1. Menampilkan Daftar Laporan Bulanan
     */
    public function index()
    {
        $db = App::resolve(Database::class);

        $id = $_GET['id'] ?? null;

        // Jika ada param ?id=X, tampilkan detail laporan
        if ($id) {
            $laporan = $db->query('SELECT * FROM laporan_bulanan WHERE id = :id', ['id' => $id])->find();
            if (!$laporan) {
                abort(404);
            }
            return view('admin/laporan/show.view.php', [
                'heading' => 'Detail Laporan Bulanan',
                'laporan' => $laporan
            ]);
        }

        // Tampilkan daftar laporan bulanan
        $laporans = $db->query('SELECT * FROM laporan_bulanan ORDER BY tahun DESC, bulan DESC')->get();

        return view('admin/laporan/index.view.php', [
            'heading' => 'Laporan Bulanan',
            'laporans' => $laporans
        ]);
    }

    /**
     * 2. Form Tambah / Edit Laporan Bulanan
     */
    public function create()
    {
        $db = App::resolve(Database::class);
        $id = $_GET['id'] ?? null;

        $laporan = null;
        $heading = 'Tambah Laporan Bulanan';

        if ($id) {
            $laporan = $db->query('SELECT * FROM laporan_bulanan WHERE id = :id', ['id' => $id])->find();
            $heading = 'Edit Laporan Bulanan';
        }

        return view('admin/laporan/create.view.php', [
            'heading' => $heading,
            'laporan' => $laporan
        ]);
    }

    /**
     * 3. Simpan Data Laporan Bulanan
     */
    public function store()
    {
        $db = App::resolve(Database::class);

        $id = $_POST['id'] ?? null;
        $bulan = (int)($_POST['bulan'] ?? date('n'));
        $tahun = (int)($_POST['tahun'] ?? date('Y'));

        if ($id) {
            // Update
            $db->query(
                "UPDATE laporan_bulanan SET bulan = :bulan, tahun = :tahun, updated_at = NOW() WHERE id = :id",
                ['bulan' => $bulan, 'tahun' => $tahun, 'id' => $id]
            );
            Session::flash('sukses', 'Laporan bulanan berhasil diperbarui.');
        } else {
            // Insert
            $db->query(
                "INSERT INTO laporan_bulanan (bulan, tahun) VALUES (:bulan, :tahun)",
                ['bulan' => $bulan, 'tahun' => $tahun]
            );
            Session::flash('sukses', 'Laporan bulanan berhasil dibuat.');
        }

        redirect('/laporan');
    }
}
