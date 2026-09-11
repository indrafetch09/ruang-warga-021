#!/usr/bin/env php
<?php

const BASE_PATH = __DIR__ . '/../';

$config = require BASE_PATH . 'config.php';
$c = $config['database'];

$host = $c['host'];
$port = $c['port'];
$charset = $c['charset'];
$dbname = $c['dbname'];
$user = $c['user'] ?? $c['username'];
$pass = $c['pass'] ?? $c['password'];

$dsn = "mysql:host={$host};port={$port};dbname={$dbname};charset={$charset}";

try {
    // Koneksi Database Murni dari Config
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    echo "🌱 Seeding users into database [{$dbname}]...\n\n";

    $stmt = $pdo->prepare("
        INSERT INTO `users` (`username`, `password`, `role`, `rt_assigned`, `created_at`) 
        VALUES (:username, :password, :role, :rt_assigned, NOW())
        ON DUPLICATE KEY UPDATE 
            `password` = VALUES(`password`),
            `role` = VALUES(`role`),
            `rt_assigned` = VALUES(`rt_assigned`)
    ");

    echo "\n✓ User seeding completed successfully!\n";
} catch (PDOException $e) {
    echo "\n✗ User seeding failed: " . $e->getMessage() . "\n";
    exit(1);
}
