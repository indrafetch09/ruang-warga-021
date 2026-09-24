# Requirements — Ruang Warga 021

Sistem Informasi Rukun Warga RW 021: platform digital untuk administrasi, komunikasi, dan layanan warga. Aplikasi PHP native (tanpa framework) dengan front-controller `public/index.php`, autoload Composer (PSR-4), dan database MySQL via PDO.

---

## 1. Teknologi

| Komponen       | Spesifikasi                                                              |
|----------------|--------------------------------------------------------------------------|
| Backend        | PHP >= 8.1 (native, tanpa framework) — target image `php:8.3-cli`        |
| Database       | MySQL / MariaDB via PDO — image `mariadb:10.4` (basis dump schema)       |
| Autoload       | Composer 2 (PSR-4: `Core\`, `Http\`, `App\Controllers\`, `App\Models\`)  |
| Dependencies   | `illuminate/collections ^10.9`, `vlucas/phpdotenv ^5.6` (dev: `pestphp/pest ^3`) |
| Frontend       | Tailwind CSS (CDN), Google Fonts (Plus Jakarta Sans), Chart.js, Google Maps embed |
| Web server     | PHP built-in server: `php -S 0.0.0.0:8000 -t public`                     |

## 2. Persyaratan Runtime

- **PHP extensions (wajib):** `pdo`, `pdo_mysql`
- **PHP extensions (opsional):** `pdo_sqlite` (hanya untuk menjalankan test)
- **Composer:** `composer install --no-dev` pada saat build image
- **File system:** `public/uploads/{galeri,notulensi}` harus writable oleh user proses PHP
- **Network egress:** dibutuhkan untuk Tailwind CDN, Google Fonts (Plus Jakarta Sans), dan Google Maps (embed)

## 3. Environment Variables

| Variabel              | Default                      | Deskripsi                                             |
|-----------------------|------------------------------|-------------------------------------------------------|
| `APP_NAME`            | `Ruang Warga 021`            | Nama aplikasi                                         |
| `APP_ENV`             | `local`                      | Environment (`local` / `production`)                  |
| `APP_KEY`             | `SistemInformasiRW21-RahasiaSuper` | Kunci enkripsi NIK/No HP (min. 32 karakter)     |
| `DB_HOST`             | `db`                         | Host database (nama service di compose)               |
| `DB_PORT`             | `3306`                       | Port database                                         |
| `DB_NAME`             | `sisrw21`                    | Nama database                                         |
| `DB_CHARSET`          | `utf8mb4`                    | Charset database                                      |
| `DB_USER`             |                              | User database                                         |
| `DB_PASS`             |                              | Password database                                     |
| `MYSQL_DATABASE`      | `$DB_NAME`                   | (container db) Inisialisasi database otomatis         |
| `MYSQL_USER` / `MYSQL_PASSWORD` | `$DB_USER` / `$DB_PASS` | (container db) Kredensial non-root             |
| `MYSQL_ROOT_PASSWORD` | `root`                       | (container db) Password root                          |
| `DB_AUTO_MIGRATE`     | `1`                          | Jalankan migrate + seed otomatis saat start (`1`=ya, `0`=tidak) |
| `WEB_PORT`            | `8000`                       | Port publik aplikasi pada host                        |

> `.env` tidak dikomit ke git (gitignored). Salin `.env.example` menjadi `.env` sebelum menjalankan aplikasi. Di docker-compose, nilai diambil otomatis dari `.env`.

## 4. Port & Networking

- `app : 8000` → host (`http://localhost:8000`)
- `db : 3306` → internal container (opsional dipublikasikan: `ports: "3306:3306"`)

## 5. Storage / Persistence

| Volume          | Mount point                       | Fungsi                              |
|-----------------|-----------------------------------|-------------------------------------|
| `db_data`       | `/var/lib/mysql`                  | Data MariaDB                        |
| `uploads_data`  | `/var/www/html/public/uploads`    | Upload galeri & notulensi           |

Volume memastikan data bertahan saat container rebuild.

## 6. Setup Database (Automatis)

- `database/migrate.php` — **menghapus (DROP) dan membuat ulang** database dari `database/schema.sql`. Dijalankan otomatis saat container start jika `DB_AUTO_MIGRATE=1`. **Peringatan:** seluruh data hilang setiap kali container (re)start kecuali `DB_AUTO_MIGRATE=0`.
- `database/seed_user.php` — seeding user idempotent (`ON DUPLICATE KEY UPDATE`). **Catatan:** versi saat ini hanya menyiapkan prepared statement (belum menyisipkan baris user). Tambahkan kredensial awal pada file ini bila ingin akun bawaan.

## 7. Routing & Session

- Front-container: `public/index.php` — session PHP standar.
- Cookie session dikonfigurasi aman: `HttpOnly`, `SameSite=Lax`, `use_only_cookies`.

## 8. Catatan Keamanan

- Jangan commit `.env`, `*.sql`, atau `public/uploads/` ke git.
- Ganti `APP_KEY` saat produksi.
- Kelola kredensial database via environment variables, bukan hardcoded di `config.php`.
- `migrate.php` butuh user database dengan hak `CREATE` / `DROP DATABASE`.

## 9. Quickstart (Docker)

```bash
# 1. Siapkan konfigurasi
cp .env.example .env
# sesuaikan DB_USER, DB_PASS, DB_NAME di .env

# 2. Build & jalankan
docker compose up -d --build

# 3. Akses aplikasi
# http://localhost:8000

# 4. Inspeksi / hentikan
docker compose logs -f app
docker compose down

# 5. Reset total (termasuk volume)
docker compose down -v && docker compose up -d
```

## 10. Menjalankan Tanpa Docker (Lokal)

Prasyarat: PHP >= 8.1 (dengan `pdo_mysql`), Composer, MySQL/MariaDB.

```bash
composer install
# atur .env (salinan dari .env.example)
php database/migrate.php
php database/seed_user.php
php -S localhost:8000 -t public
```