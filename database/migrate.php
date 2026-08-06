#!/usr/bin/env php
<?php

// ponytail: one script, no migration framework — db-schema.sql is already idempotent

const BASE_PATH = __DIR__ . '/../';

$config = require BASE_PATH . 'config.php';
$c = $config['database'];

$dsn = "mysql:host={$c['host']};port={$c['port']};charset={$c['charset']}";

try {
    $pdo = new PDO($dsn, 'indra', 'indrasql1', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    // ponytail: patch old tables forward before CREATE IF NOT EXISTS skips them
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `{$c['dbname']}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    $pdo->exec("USE `{$c['dbname']}`");

    $patches = [
        "ALTER TABLE `users` ADD COLUMN `role` ENUM('admin','user') NOT NULL DEFAULT 'user'",
        "ALTER TABLE `users` ADD COLUMN `is_active` TINYINT(1) NOT NULL DEFAULT 1",
        "ALTER TABLE `notes` ADD CONSTRAINT `fk_notes_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE",
    ];
    foreach ($patches as $patch) {
        try { $pdo->exec($patch); } catch (PDOException $e) { /* already applied */ }
    }

    $sql = file_get_contents(__DIR__ . '/db-schema.sql');
    $pdo->exec($sql);

    echo "✓ Database migrated successfully.\n";
} catch (PDOException $e) {
    echo "✗ Migration failed: " . $e->getMessage() . "\n";
    exit(1);
}
