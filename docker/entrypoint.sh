#!/bin/sh
set -e

DB_HOST="${DB_HOST:-db}"
DB_PORT="${DB_PORT:-3306}"
DB_USER="${DB_USER:-root}"
DB_PASS="${DB_PASS:-}"

echo "[entrypoint] Menunggu database ${DB_HOST}:${DB_PORT} ..."

wait=0
until php -r '
    $h = getenv("DB_HOST");
    $p = getenv("DB_PORT");
    $u = getenv("DB_USER");
    $pw = getenv("DB_PASS");
    try {
        new PDO("mysql:host={$h};port={$p}", $u, $pw);
        exit(0);
    } catch (Exception $e) {
        exit(1);
    }
' 2>/dev/null || [ "$wait" -ge 60 ]; do
    wait=$((wait + 1))
    sleep 1
done

if [ "$wait" -ge 60 ]; then
    echo "[entrypoint] WARNING: Database tidak merespon setelah 60 detik. Melanjutkan..."
fi

if [ "${DB_AUTO_MIGRATE:-1}" = "1" ]; then
    echo "[entrypoint] Menjalankan migrasi database ..."
    php database/migrate.php
    echo "[entrypoint] Menjalankan seed user ..."
    php database/seed_user.php
fi

exec "$@"