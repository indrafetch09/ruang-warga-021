<?php

namespace App\Models;

use Core\Model;
use Core\App;
use Core\Database;

class Warga extends Model
{
    public static $table = 'warga';

    // Relasi Balik ke User (Siapa yang menginput)
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Scope: Ambil warga berdasarkan RT tertentu saja
    public static function getByRt($rtNumber)
    {
        $db = App::resolve(Database::class);
        $results = $db->query("SELECT * FROM " . static::$table . " WHERE rt = :rt ORDER BY nama ASC", [
            'rt' => $rtNumber
        ])->get();

        return array_map(fn($row) => new static($row), $results);
    }

    // Scope: Ambil warga berdasarkan status verifikasi
    public static function getByStatus($status)
    {
        $db = App::resolve(Database::class);
        $results = $db->query("SELECT * FROM " . static::$table . " WHERE status_verifikasi = :status", [
            'status' => $status
        ])->get();

        return array_map(fn($row) => new static($row), $results);
    }

    // Scope: Kombinasi filter RT dan Status (Berguna untuk Admin RT melihat data pending mereka)
    public static function getByRtAndStatus($rtNumber, $status)
    {
        $db = App::resolve(Database::class);
        $results = $db->query("SELECT * FROM " . static::$table . " WHERE rt = :rt AND status_verifikasi = :status", [
            'rt' => $rtNumber,
            'status' => $status
        ])->get();

        return array_map(fn($row) => new static($row), $results);
    }
}
