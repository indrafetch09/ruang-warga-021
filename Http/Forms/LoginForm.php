<?php

namespace Http\Forms;

use Core\App;
use Core\Database;
use Core\ValidationException;
use Core\Validator;

class LoginForm
{
    protected $errors = [];

    public function __construct(public array $attributes)
    {
        // Rate limiting check: Maksimal 5 percobaan gagal per 5 menit
        $this->checkRateLimit();

        if (!Validator::string($attributes['identity'] ?? '', 1, 255)) {
            $this->errors['identity'] = 'Silakan masukkan Email atau Username yang valid.';
        }

        if (!Validator::string($attributes['password'] ?? '', 1, 255)) {
            $this->errors['password'] = 'Kata sandi tidak boleh kosong.';
        }
    }

    public static function validate(array $attributes): static
    {
        $instance = new static($attributes);

        if ($instance->hasErrors()) {
            $instance->throw();
        }

        return $instance;
    }

    public function hasErrors(): bool
    {
        return count($this->errors) > 0;
    }

    public function errors(): array
    {
        return $this->errors;
    }

    public function error(string $field, string $message): static
    {
        $this->errors[$field] = $message;

        return $this;
    }

    public function throw(): void
    {
        ValidationException::throw($this->errors(), $this->attributes);
    }

    /**
     * Sederhana & Efektif: Throttle percobaan login gagal untuk mencegah brute-force
     */
    protected function checkRateLimit(): void
    {
        $key = '_login_throttle_' . md5($_SERVER['REMOTE_ADDR'] ?? '127.0.0.1');
        $throttle = $_SESSION[$key] ?? ['count' => 0, 'expires' => 0];

        if ($throttle['expires'] > time() && $throttle['count'] >= 5) {
            $secondsRemaining = $throttle['expires'] - time();
            $this->error('identity', "Terlalu banyak percobaan login gagal. Silakan tunggu {$secondsRemaining} detik.");
            $this->throw();
        }
    }

    /**
     * Catat kegagalan login untuk throttling
     */
    public static function recordFailedAttempt(): void
    {
        $key = '_login_throttle_' . md5($_SERVER['REMOTE_ADDR'] ?? '127.0.0.1');
        $throttle = $_SESSION[$key] ?? ['count' => 0, 'expires' => 0];

        if ($throttle['expires'] < time()) {
            $throttle = ['count' => 1, 'expires' => time() + 300]; // 5 menit
        } else {
            $throttle['count']++;
        }

        $_SESSION[$key] = $throttle;
    }

    /**
     * Bersihkan throttle setelah login berhasil
     */
    public static function clearRateLimit(): void
    {
        $key = '_login_throttle_' . md5($_SERVER['REMOTE_ADDR'] ?? '127.0.0.1');
        unset($_SESSION[$key]);
    }
}
