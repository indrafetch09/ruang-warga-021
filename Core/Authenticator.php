<?php

namespace Core;

use Http\Forms\LoginForm;

class Authenticator
{
    /**
     * Mencoba otentikasi user berdasarkan Username & Password
     */
    public function attempt(string $identity, string $password): bool
    {
        $db = App::resolve(Database::class);

        // Cari berdasarkan username di tabel 'user'
        $user = $db->query(
            'SELECT * FROM `users` WHERE username = :identity LIMIT 1',
            ['identity' => $identity]
        )->find();

        if ($user) {
            // Verifikasi password (BCRYPT)
            if (password_verify($password, $user['password'])) {
                $this->login($user);
                LoginForm::clearRateLimit();
                return true;
            }
        }

        // Catat percobaan gagal untuk throttling brute force
        LoginForm::recordFailedAttempt();

        return false;
    }

    /**
     * Daftarkan user ke dalam sesi aktif
     */
    public function login(array $user): void
    {
        $_SESSION['user'] = [
            'id'          => $user['id'] ?? null,
            'username'    => $user['username'] ?? '',
            'name'        => $user['username'] ?? 'Pengurus RW',
            'role'        => $user['role'] ?? 'pengurus_rt',
            'rt_assigned' => $user['rt_assigned'] ?? null,
            'logged_at'   => time(),
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
        return !empty($_SESSION['user']['id']) || !empty($_SESSION['user']['username']);
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
     * Dapatkan Role user ('admin', 'pengurus_rw', 'pengurus_rt')
     */
    public static function role(): ?string
    {
        return $_SESSION['user']['role'] ?? null;
    }

    /**
     * Cek apakah user adalah Admin atau Pengurus RW
     */
    public static function isAdmin(): bool
    {
        $role = self::role();
        return in_array($role, ['admin', 'pengurus_rw']);
    }
}
