<?php

namespace App\Models;

use Core\Model;

class User extends Model
{
    public static $table = 'user';

    // Relasi ke tabel Warga
    public function warga()
    {
        return $this->hasMany(Warga::class, 'created_by');
    }

    // Cek apakah user adalah Super Admin (RW)
    public function isRw()
    {
        return $this->role === 'pengurus_rw' || $this->role === 'admin';
    }

    // Cek apakah user adalah Admin RT
    public function isRt()
    {
        return $this->role === 'pengurus_rt';
    }

    // Ambil nomor RT jika user adalah pengurus RT (contoh return: "01", "02")
    public function getRtAssigned()
    {
        return $this->rt_assigned;
    }
}
