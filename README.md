# Ruang Warga 021

Sistem Informasi Rukun Warga RW 021 — aplikasi web untuk administrasi,
komunikasi, dan layanan warga. Dibangun dengan PHP native (tanpa framework),
front controller di `public/index.php`, dan MariaDB via PDO.

|                |                                                  |
| -------------- | ------------------------------------------------ |
| Bahasa         | Indonesia                                        |
| Runtime        | PHP >= 8.1, MariaDB 11.8                         |
| Setup tercepat | Docker Compose (lihat [Quickstart](#quickstart)) |

---

## Fitur

### Portal Publik (tanpa login)

- **Beranda & profil RW** — `/`, `/tentang-kami`, `/pengurus-rw`
- **Layanan warga** — administrasi kependudukan, TPS/kebersihan (`/layanan`, `/tps`)
- **Informasi** — pengumuman, jadwal kegiatan, notulensi rapat + detail,
  galeri kegiatan, statistik warga (Chart.js), peta lokasi (Google Maps embed)
- **Laporan bulanan** — daftar laporan (perlu login) — `/laporan`

### Dashboard Pengurus (perlu login)

- **Data Warga** — CRUD, import CSV/Excel, verifikasi (ACC/Tolak) data pending
- **Manajemen Pengurus** — CRUD akun pengurus RW/RT
- **Notulensi, Galeri, Kegiatan, Pengumuman** — CRUD masing-masing
- **Pengaturan** — profil, ganti password, reset password pengurus lain

### Role & Hak Akses

| Role          | Lihat data      | Tulis data              | Catatan                                                                                       |
| ------------- | --------------- | ----------------------- | --------------------------------------------------------------------------------------------- |
| `admin`       | semua RT        | ya                      |                                                                                               |
| `pengurus_rw` | semua RT        | ya                      |                                                                                               |
| `pengurus_rt` | RT sendiri saja | RT sendiri saja (warga) | Tidak bisa akses modul mengelola pengurus (khusus Super Admin)                                |
| `tester`      | semua RT        | ya                      | **Khusus development** — berperilaku persis seperti `pengurus_rw`; jangan dipakai di produksi |

> Akun `tester` disediakan untuk keperluan testing/QA payload manajemen saat
> development. Untuk produksi: hapus/ubah akun ber-role `tester` dan keluarkan
> `'tester'` dari `isRw()` — detail di
> [`docs/features/tester-role.md`](docs/features/tester-role.md).

---

## Arsitektur

- **Front controller** — `public/index.php` → `Core\Router`
- **Middleware** — `guest`, `auth` (registrasi di `Core\Middleware\Middleware`)
- **Model** — `App\Models\` + `App\Core\Model` (PDO, `illuminate/collections`)
- **Enkripsi** — NIK & No HP tersimpan terenkripsi (kunci `APP_KEY`, min. 32 karakter)

Struktur:

```
├── public/index.php      # front controller
├── routes.php            # seluruh definisi rute + middleware
├── App/Controllers       # controller HTTP
├── App/Models            # model + query
├── Core/                 # router, middleware, session, csrf, authenticator
├── Model/                # model inti (User, ...)
├── Views/                # PHP native views (user/, admin/, partials/)
├── database/             # schema.sql, migrate.php, seed_user.php
├── docs/                 # REQUIREMENTS.md, db/, features/
└── docker-compose.yml    # app (php:8.5-cli) + db (mariadb:11.8)
```

---

## Quickstart

### Docker (disarankan)

```bash
cp .env.example .env          # wajib isi minimal DB_NAME, DB_USER, DB_PASS
docker compose up --build     # app + mariadb
# buka http://localhost:8000
```

> Tanpa `.env`, default dev dipakai: database `rw021`, user/password
> `rw021`/`rw021`. Jika `.env` ada tapi `DB_USER`/`DB_PASS` kosong, `env()`
> menganggapnya tidak diset dan memakai default — mencegah error
> `Access denied for user ''`.

Migrasi dijalankan manual karena `database/migrate.php` melakukan `DROP DATABASE`:

```bash
docker compose exec app php database/migrate.php
docker compose exec app php database/seed_user.php
```

> `DB_AUTO_MIGRATE=1` (default) juga menjalankan migrate + seed otomatis saat
> kontainer pertama kali start.

Composer / Pest tanpa PHP di host:

```bash
docker compose run --rm --entrypoint composer app install
docker compose exec app vendor/bin/pest
```

Matikan stack: `docker compose down` (tambah `-v` untuk hapus volume DB).

### PHP Native

```bash
composer install
mysql -u root -e "CREATE DATABASE rw021 CHARACTER SET utf8mb4;"
mysql -u root -e "CREATE USER IF NOT EXISTS 'rw021'@'%' IDENTIFIED BY 'rw021'; GRANT ALL PRIVILEGES ON rw021.* TO 'rw021'@'%'; FLUSH PRIVILEGES;"
php database/migrate.php
php database/seed_user.php
php -S localhost:8000 -t public
```

Kredensial DB dev (hanya untuk dev): user `${DB_USER}`, password `${DB_PASS}`,
root `root`.

---

## Konfigurasi

Environment variable lengkap ada di [docs/REQUIREMENTS.md](docs/REQUIREMENTS.md).
Yang paling penting:

| Variabel              | Default           | Fungsi                             |
| --------------------- | ----------------- | ---------------------------------- |
| `APP_KEY`             | —                 | Kunci enkripsi(min. 32 karakter)   |
| `DB_NAME`             | `rw021`           | Nama database                      |
| `DB_USER` / `DB_PASS` | `rw021` / `rw021` | Kredensial non-root                |
| `DB_AUTO_MIGRATE`     | `1`               | Migrate + seed otomatis saat start |
| `WEB_PORT`            | `8000`            | Port publik                        |

> `.env` tidak dikomit. Salin dari `.env.example`.

---

## Testing

```bash
docker compose exec app vendor/bin/pest
```

---

## Larangan yang Perlu Diketahui

- `database/migrate.php` akan **menghapus database** (`DROP DATABASE`).
  Jangan dijalankan pada database berisi data asli.
- `public/uploads/{galeri,notulensi}` harus writable oleh proses PHP.
- Frontend butuh jaringan keluar untuk Tailwind CDN, Google Fonts
  (Plus Jakarta Sans), dan Google Maps embed.

---

## Dokumentasi Lain

- [`docs/REQUIREMENTS.md`](docs/REQUIREMENTS.md) — spesifikasi teknis & env var
- [`docs/features/admin/admin.md`](docs/features/admin/admin.md) — rancangan fitur dashboard admin
- [`docs/features/tester-role.md`](docs/features/tester-role.md) — role `tester` (khusus development): perilaku RW dan cara menghapusnya di produksi
- [`docs/features/user.md`](docs/features/user.md) — rancangan fitur portal publik
- [`docs/db/`](docs/db/) — skema & relasi database

---

## Lisensi

Proyek internal RW 021.
