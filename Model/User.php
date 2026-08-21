<?php

namespace App\Models;

use Core\Model;
use Core\Authenticator;
use Core\Session;

class User extends Model
{
    public static $table = 'users';

    /**
     * Dapatkan user yang sedang login saat ini sebagai instance Model User
     */
    public static function current(): self
    {
        $userData = Authenticator::user() ?? Session::get('user') ?? [
            'id'          => 1,
            'username'    => 'rw021',
            'name'        => 'Pengurus RW 021',
            'role'        => 'pengurus_rw',
            'rt_assigned' => null
        ];

        return (is_object($userData) && $userData instanceof self)
            ? $userData
            : new self(is_object($userData) ? get_object_vars($userData) : $userData);
    }

    /**
     * Cek apakah user adalah Super Admin
     */
    public function isAdmin(): bool
    {
        return in_array($this->role ?? '', ['admin']);
    }

    /**
     * Cek apakah user adalah Super Admin atau Pengurus RW
     */
    public function isRw(): bool
    {
        return in_array($this->role ?? '', ['admin', 'pengurus_rw', 'rw']);
    }

    /**
     * Cek apakah user adalah Pengurus RT
     */
    public function isRt(): bool
    {
        return in_array($this->role ?? '', ['pengurus_rt', 'rt']);
    }

    /**
     * Ambil nomor RT jika user adalah pengurus RT (contoh return: "01", "02")
     */
    public function getRtAssigned(): ?string
    {
        $rt = $this->rt_assigned ?? $this->rt ?? null;
        return $rt !== null ? sprintf('%02d', (int)$rt) : null;
    }

    /**
     * Relasi ke tabel Warga
     */
    public function warga()
    {
        return $this->hasMany(Warga::class, 'created_by');
    }
}
