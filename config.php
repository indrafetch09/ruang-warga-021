<?php

// Pastikan dependencies & helper env() tersedia
if (!function_exists('env')) {
    if (file_exists(__DIR__ . '/vendor/autoload.php')) {
        require_once __DIR__ . '/vendor/autoload.php';
    }
    if (file_exists(__DIR__ . '/Core/functions.php')) {
        require_once __DIR__ . '/Core/functions.php';
    }
}

// Inisialisasi Dotenv jika file .env ada
if (class_exists('Dotenv\Dotenv') && file_exists(__DIR__ . '/.env')) {
    $dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__);
    $dotenv->safeLoad();
}

return [
    'app' => [
        'name' => env('APP_NAME', 'Ruang Warga 021'),
        'env' => env('APP_ENV', 'local'),
        'key' => env('APP_KEY', 'SistemInformasiRW21-RahasiaSuper'),
    ],

    'database' => [
        'host' => env('DB_HOST', '127.0.0.1'),
        'port' => env('DB_PORT', '3306'),
        'dbname' => env('DB_NAME', 'sisrw21'),
        'charset' => env('DB_CHARSET', 'utf8mb4'),
        'user' => env('DB_USER', 'root'),
        'password' => env('DB_PASS', ''),
    ],
];
