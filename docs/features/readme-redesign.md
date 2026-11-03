# Draft Ulang README

> **Status:** Diterapkan ke `README.md` (Nov 2026). Versi lama bisa dilihat via `git log -- README.md`.
> **Tujuan:** Mengganti README lama yang strukturnya tidak lagi cocok dengan isi aplikasi.

---

## 1. Audit README Lama — Apa yang Salah

| # | Masalah | Bukti |
|---|---------|-------|
| 1 | Daftar fitur tidak sesuai dengan isi aplikasi | Menyebut "Manajemen Catatan" dan "Halaman Kontak" satu-dua baris; padahal aplikasi punya 12 controller: warga CRUD + import/ACC, pengurus, notulensi, galeri, kegiatan, pengumuman, statistik, laporan, pengaturan |
| 2 | Tidak ada penjelasan role & hak akses | Aplikasi punya 4 role (`admin`, `pengurus_rw`, `pengurus_rt`, `tester` read-only). README tidak menyebut satu pun |
| 3 | Instruksi instalasi "mantul" | `git clone` dan `cd` tanpa URL/nama folder |
| 4 | Instruksi migrate menyebut "MySQL", padahal dev pakai MariaDB 10.4 (compose) | `docker-compose.yml`, `docs/REQUIREMENTS.md` |
| 5 | Informasi basi | "> Catatan: `database/schema.sql` belum ada di repo" — file sekarang ada (30 KB+) |
| 6 | Tidak ada struktur proyek & pintu masuk kode | Front controller `public/index.php`, namespace `Core\`, `Http\`, `App\Controllers\`, `App\Models\` tidak dijelaskan |
| 7 | Emoji di tiap heading membebani, daftar fitur terasa generik/noise | Seluruh file |
| 8 | Tidak ada tautan ke dokumentasi internal | `docs/REQUIREMENTS.md`, `docs/db/`, `docs/features/` sudah ada tapi tidak pernah dirujuk |

---

## 2. Usulan README Baru (Full Text)

# Ruang Warga 021

Sistem Informasi Rukun Warga RW 021 — aplikasi web untuk administrasi,
komunikasi, dan layanan warga. Dibangun dengan PHP native (tanpa framework),
front controller di `public/index.php`, dan MariaDB via PDO.

| | |
|---|---|
| Bahasa | Indonesia |
| Runtime | PHP >= 8.1, MariaDB 10.4 |
| Setup tercepat | Docker Compose (lihat [Quickstart](#quickstart)) |

---

## Fitur

### Portal Publik (tanpa login)
- **Beranda & profil RW** — `/', /tentang-kami, /pengurus-rw`
- **Layanan warga** — administrasi kependudukan, TPS/kebersihan
- **Informasi** — pengumuman, jadwal kegiatan, notulensi rapat + detail,
  galeri kegiatan, statistik warga (Chart.js), peta lokasi (Google Maps embed)
- **Laporan bulanan** — daftar laporan (perlu login)

### Dashboard Pengurus (perlu login)
- **Data Warga** — CRUD, import CSV/Excel, verifikasi (ACC/Tolak) pending
- **Manajemen Pengurus** — CRUD akun pengurus RW/RT
- **Notulensi, Galeri, Kegiatan, Pengumuman** — CRUD masing-masing
- **Pengaturan** — profil, ganti password, reset password pengurus lain

### Role & Hak Akses

| Role | Lihat data | Tulis data | Catatan |
|------|-----------|------------|---------|
| `admin` | semua RT | ya | |
| `pengurus_rw` | semua RT | ya | |
| `pengurus_rt` | RT sendiri saja | RT sendiri saja (warga) | Tidak bisa akses modul pengurus/pengumuman/kegiatan |
| `tester` | semua RT | **tidak** | Read-only; semua aksi tulis diblok middleware dengan 403 |

Role `tester` diproteksi dua lapis:

1. **Server-side** — `Core\Middleware\Write` menyaring semua rute tulis
   (36 rute: form create/edit + POST store/update/delete/approve/reject/import).
   Logout, profil sendiri, dan ganti password sendiri tetap boleh.
2. **Tampilan** — tombol tulis tidak dirender untuk tester (`isTester()` check
   di view), bukan sekadar disembunyikan dengan CSS.

---

## Arsitektur

- **Front controller** — `public/index.php` → `Core\Router`
- **Middleware** — `guest`, `auth`, `write` ( registrasi di `Core\Middleware\Middleware` )
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
└── docker-compose.yml    # app (php:8.3-cli) + db (mariadb:10.4)
```

---

## Quickstart

### Docker (disarankan)

```bash
cp .env.example .env          # opsional; default compose dipakai bila dilewati
docker compose up --build     # app + mariadb
# buka http://localhost:8000
```

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
php database/migrate.php
php database/seed_user.php
php -S localhost:8000 -t public
```

Kredensial DB dev (hanya untuk dev): user `${DB_USER}`, password `${DB_PASS}`,
root `root`.

---

## Konfigurasi

Environment variable lengkap ada di [docs/REQUIREMENTS.md](../REQUIREMENTS.md).
Yang paling penting:

| Variabel | Default | Fungsi |
|----------|---------|--------|
| `APP_KEY` | — | Kunci enkripsi NIK/No HP (min. 32 karakter) |
| `DB_NAME` | `rw021` | Nama database |
| `DB_USER` / `DB_PASS` | — | Kredensial non-root |
| `DB_AUTO_MIGRATE` | `1` | Migrate + seed otomatis saat start |
| `WEB_PORT` | `8000` | Port publik |

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

- [`docs/REQUIREMENTS.md`](../REQUIREMENTS.md) — spesifikasi teknis & env var
- [`docs/features/admin/admin.md`](admin.md) — rancangan fitur dashboard admin
- [`docs/features/user.md`](user.md) — rancangan fitur portal publik
- [`docs/db/`](../db/) — skema & relasi database

---

## Lisensi

Proyek internal RW 021.
