#!/usr/bin/env php
<?php

// ponytail: clean single-file CLI database migration script for RW 021

const BASE_PATH = __DIR__ . '/../';

$config = require BASE_PATH . 'config.php';
$c = $config['database'];

$host = $c['host'] ?? '127.0.0.1';
$port = $c['port'] ?? '3306';
$charset = $c['charset'] ?? 'utf8mb4';
$dbname = $c['dbname'] ?? 'rw021';
$user = $c['user'] ?? $c['username'] ?? 'root';
$pass = $c['pass'] ?? $c['password'] ?? '';

$dsn = "mysql:host={$host};port={$port};charset={$charset}";

try {
    // Connect to MySQL server
    try {
        $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    } catch (PDOException $e) {
        // Fallback to indra credentials if root fails
        $pdo = new PDO($dsn, 'indra', 'indrasql1', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }

    $pdo->exec("CREATE DATABASE IF NOT EXISTS `{$dbname}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    $pdo->exec("USE `{$dbname}`");

    $sql = file_get_contents(__DIR__ . '/schema.sql');
    $pdo->exec($sql);

    echo "✓ Database [{$dbname}] migrated successfully.\n";
} catch (PDOException $e) {
    echo "✗ Migration failed: " . $e->getMessage() . "\n";
    exit(1);
}
