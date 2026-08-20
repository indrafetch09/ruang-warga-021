<?php

namespace Core;

use Http\Forms\LoginForm;

class Authenticator
{
    /**
     * Mencoba otentikasi user berdasarkan Username / Email & Password
     */
    public function attempt(string $identity, string $password): bool
    {
        $db = App::resolve(Database::class);

        // Cari berdasarkan username ATAU email di tabel 'users'
        $user = $db->query(
            'SELECT * FROM `users` WHERE (username = :identity OR email = :email) LIMIT 1',
            [
                'identity' => $identity,
                'email'    => $identity,
            ]
        )->find();

        if ($user) {
            // Cek status aktif akun
            if (isset($user['is_active']) && (int)$user['is_active'] === 0) {
                return false;
            }

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
            'name'        => $user['name'] ?? $user['username'] ?? 'Pengurus RW',
            'email'       => $user['email'] ?? '',
            'role'        => $user['role'] ?? 'admin',
            'is_active'   => (int)($user['is_active'] ?? 1),
            'logged_at'   => time(),
        ];

        // Mencegah Session Fixation
        if (session_status() === PHP_SESSION_ACTIVE && !headers_sent()) {
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
