<?php

namespace App\Models;

use Core\Model;

class PengajuanLayanan extends Model
{
    public static $table = 'pengajuan_layanan';

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id');
    }
}
