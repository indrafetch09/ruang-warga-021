<?php

namespace App\Controllers;

use Core\App;
use Core\Database;
use Core\Session;
use App\Models\LaporanBulanan;

class LaporanController
{
    /**
     * 1. Menampilkan Daftar Laporan Bulanan
     */
    public function index()
    {
        $db = App::resolve(Database::class);
        $id = $_GET['id'] ?? null;

        if ($id) {
            $laporan = LaporanBulanan::find($id);
            if (!$laporan) {
                abort(404);
            }
            return view('admin/laporan/show.view.php', [
                'heading' => 'Detail Laporan Bulanan',
                'laporan' => $laporan
            ]);
        }

        $laporansRaw = $db->query('SELECT * FROM ' . LaporanBulanan::$table . ' ORDER BY tahun DESC, bulan DESC')->get();
        $laporans    = array_map(fn($row) => new LaporanBulanan($row), $laporansRaw);

        return view('admin/laporan/index.view.php', [
            'heading'  => 'Laporan Bulanan',
            'laporans' => $laporans
        ]);
    }

    /**
     * 2. Form Tambah / Edit Laporan Bulanan
     */
    public function create()
    {
        $id = $_GET['id'] ?? null;

        $laporan = null;
        $heading = 'Tambah Laporan Bulanan';

        if ($id) {
            $laporan = LaporanBulanan::find($id);
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

        $id    = $_POST['id'] ?? null;
        $bulan = (int)($_POST['bulan'] ?? date('n'));
        $tahun = (int)($_POST['tahun'] ?? date('Y'));

        if ($id) {
            $db->query(
                "UPDATE " . LaporanBulanan::$table . " SET bulan = :bulan, tahun = :tahun, updated_at = NOW() WHERE id = :id",
                ['bulan' => $bulan, 'tahun' => $tahun, 'id' => $id]
            );
            Session::flash('sukses', 'Laporan bulanan berhasil diperbarui.');
        } else {
            $db->query(
                "INSERT INTO " . LaporanBulanan::$table . " (bulan, tahun) VALUES (:bulan, :tahun)",
                ['bulan' => $bulan, 'tahun' => $tahun]
            );
            Session::flash('sukses', 'Laporan bulanan berhasil dibuat.');
        }

        redirect('/laporan');
    }
}
