#!/usr/bin/env php
<?php

// ponytail: single-file CLI user seeder script for RW 021

const BASE_PATH = __DIR__ . '/../';

$config = require BASE_PATH . 'config.php';
$c = $config['database'];

$host = $c['host'] ?? '127.0.0.1';
$port = $c['port'] ?? '3306';
$charset = $c['charset'] ?? 'utf8mb4';
$dbname = $c['dbname'] ?? 'sisrw21';
$user = $c['user'] ?? $c['username'] ?? 'root';
$pass = $c['pass'] ?? $c['password'] ?? '';

$dsn = "mysql:host={$host};port={$port};dbname={$dbname};charset={$charset}";

try {
    // Koneksi Database Murni dari Config
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    echo "🌱 Seeding users into database [{$dbname}]...\n\n";

    // DAFTAR AKUN USER (ADMIN, RW, RT)
    $users = [
        // 1. Super Admin
        [
            'username'    => 'admin',
            'password'    => password_hash('admin123', PASSWORD_BCRYPT),
            'role'        => 'admin',
            'rt_assigned' => null
        ],

        // 2. Pengurus RW
        [
            'username'    => 'rw021',
            'password'    => password_hash('rw123', PASSWORD_BCRYPT),
            'role'        => 'pengurus_rw',
            'rt_assigned' => null
        ],

        // 3. Pengurus RT (RT 01 sampai RT 05)
        [
            'username'    => 'rt01',
            'password'    => password_hash('rt01123', PASSWORD_BCRYPT),
            'role'        => 'pengurus_rt',
            'rt_assigned' => '01'
        ],
        [
            'username'    => 'rt02',
            'password'    => password_hash('rt02123', PASSWORD_BCRYPT),
            'role'        => 'pengurus_rt',
            'rt_assigned' => '02'
        ],
        [
            'username'    => 'rt03',
            'password'    => password_hash('rt03123', PASSWORD_BCRYPT),
            'role'        => 'pengurus_rt',
            'rt_assigned' => '03'
        ],
        [
            'username'    => 'rt04',
            'password'    => password_hash('rt04123', PASSWORD_BCRYPT),
            'role'        => 'pengurus_rt',
            'rt_assigned' => '04'
        ],
        [
            'username'    => 'rt05',
            'password'    => password_hash('rt05123', PASSWORD_BCRYPT),
            'role'        => 'pengurus_rt',
            'rt_assigned' => '05'
        ],
    ];

    $stmt = $pdo->prepare("
        INSERT INTO `user` (`username`, `password`, `role`, `rt_assigned`, `created_at`) 
        VALUES (:username, :password, :role, :rt_assigned, NOW())
        ON DUPLICATE KEY UPDATE 
            `password` = VALUES(`password`),
            `role` = VALUES(`role`),
            `rt_assigned` = VALUES(`rt_assigned`)
    ");

    foreach ($users as $u) {
        $stmt->execute($u);
        $rtLabel = $u['rt_assigned'] ? " (Wilayah RT {$u['rt_assigned']})" : "";
        echo "  [+] User: {$u['username']} | Role: {$u['role']}{$rtLabel}\n";
    }

    echo "\n✓ User seeding completed successfully!\n";
} catch (PDOException $e) {
    echo "\n✗ User seeding failed: " . $e->getMessage() . "\n";
    exit(1);
}
