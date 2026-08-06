<?php

namespace App\Models;

use Core\Model;

class Notulensi extends Model
{
    public static $table = 'notulensi';

    // Kalau mau nambah filter berdasarkan kategori (rutin/khusus), 
    // bisa bikin static method kayak di model-model sebelumnya.
}
