<?php

namespace Core;

class Csrf
{
    /**
     * Ambil atau buat CSRF token untuk sesi saat ini
     */
    public static function token(): string
    {
        if (empty($_SESSION['_csrf_token'])) {
            $_SESSION['_csrf_token'] = bin2hex(random_bytes(32));
        }

        return $_SESSION['_csrf_token'];
    }

    /**
     * Hasilkan tag input HTML hidden untuk form
     */
    public static function field(): string
    {
        return '<input type="hidden" name="_csrf_token" value="' . self::token() . '">';
    }

    /**
     * Verifikasi CSRF token secara aman menggunakan hash_equals
     */
    public static function verify(?string $token): bool
    {
        if (empty($token) || empty($_SESSION['_csrf_token'])) {
            return false;
        }

        return hash_equals($_SESSION['_csrf_token'], $token);
    }
}
