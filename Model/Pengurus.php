<?php

namespace App\Models;

use Core\Model;

class Pengurus extends Model
{
    public static $table = 'pengurus';

    // Relasi untuk menarik detail data Warga dari tabel Pengurus
    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id');
    }
}
