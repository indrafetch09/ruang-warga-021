<?php

namespace App\Models;

use Core\Model;
use Core\App;
use Core\Database;

class Pengumuman extends Model
{
    public static $table = 'pengumuman';

    // Scope: Ambil hanya pengumuman yang aktif/di-publish untuk Beranda Warga
    public static function getPublished()
    {
        $db = App::resolve(Database::class);
        // is_published di MySQL biasanya berupa tipe tinyint (1 = true, 0 = false)
        $results = $db->query("SELECT * FROM " . static::$table . " WHERE is_published = 1 ORDER BY tanggal_publikasi DESC")->get();

        return array_map(fn($row) => new static($row), $results);
    }
}
