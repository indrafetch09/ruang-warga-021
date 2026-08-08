<?php

namespace Core;

use Http\Forms\LoginForm;

class Authenticator
{
    /**
     * Mencoba otentikasi user dengan Email / Username & Password
     */
    public function attempt(string $identity, string $password): bool
    {
        $db = App::resolve(Database::class);

        // Cari berdasarkan email ATAU username
        $user = $db->query(
            'SELECT * FROM users WHERE (email = :identity OR username = :identity) LIMIT 1',
            ['identity' => $identity]
        )->find();

        if ($user) {
            // Cek status aktif akun jika ada kolom is_active
            if (isset($user['is_active']) && (int)$user['is_active'] === 0) {
                return false;
            }

            // Verifikasi password
            if (password_verify($password, $user['password'])) {
                $this->login($user);
                LoginForm::clearRateLimit();
                return true;
            }
        }

        // Catat percoban gagal untuk throttling brute force
        LoginForm::recordFailedAttempt();

        return false;
    }

    /**
     * Daftarkan user ke dalam sesi aktif
     */
    public function login(array $user): void
    {
        $_SESSION['user'] = [
            'id'       => $user['id'] ?? null,
            'name'     => $user['name'] ?? 'Pengurus RW',
            'email'    => $user['email'] ?? '',
            'role'     => $user['role'] ?? 'pengurus_rw',
            'rt_id'    => $user['rt_id'] ?? null,
            'logged_at'=> time(),
        ];

        // Mencegah Session Fixation
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_regenerate_id(true);
        }
    }

    /**
     * Hapus seluruh data sesi pengguna (Logout)
     */
    public function logout(): void
    {
        Session::destroy();
    }

    /**
     * Cek apakah user sedang terautentikasi
     */
    public static function check(): bool
    {
        return !empty($_SESSION['user']['id']) || !empty($_SESSION['user']['email']);
    }

    /**
     * Dapatkan payload data user yang sedang login
     */
    public static function user(): ?array
    {
        return $_SESSION['user'] ?? null;
    }

    /**
     * Dapatkan ID user
     */
    public static function id(): ?int
    {
        return $_SESSION['user']['id'] ?? null;
    }

    /**
     * Dapatkan Role user (misal: 'admin_rw', ' ketua_rt', 'pengurus_rw')
     */
    public static function role(): ?string
    {
        return $_SESSION['user']['role'] ?? null;
    }

    /**
     * Cek apakah user adalah Admin RW / Super Admin
     */
    public static function isAdmin(): bool
    {
        $role = self::role();
        return $role === 'admin_rw' || $role === 'admin' || $role === 'rw';
    }
}
