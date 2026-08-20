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

$dsn = "mysql:host={$host};port={$port};charset={$charset}";

try {
    // Connect to MySQL server
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    $pdo->exec("DROP DATABASE IF EXISTS `{$dbname}`");
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `{$dbname}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    $pdo->exec("USE `{$dbname}`");

    $sql = file_get_contents(__DIR__ . '/schema.sql');
    $pdo->exec($sql);

    echo "✓ Database [{$dbname}] migrated successfully.\n";
} catch (PDOException $e) {
    echo "✗ Migration failed: " . $e->getMessage() . "\n";
    exit(1);
}
