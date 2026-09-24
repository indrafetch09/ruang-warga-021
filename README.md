# 🏘️ Ruang Warga 021

**Sistem Informasi Rukun Warga 021** — Platform digital berbasis web untuk mendukung administrasi dan komunikasi warga RW 021.

---

## 📋 Deskripsi

Ruang Warga 021 adalah aplikasi web sederhana berbasis PHP yang dibangun tanpa framework besar. Aplikasi ini membantu pengurus dan warga RW 021 dalam mengelola informasi, catatan, dan keperluan administrasi lingkungan secara digital.

---

## ✨ Fitur

- 🔐 **Autentikasi** — Registrasi dan login warga
- 📝 **Manajemen Catatan** — Buat, lihat, edit, dan hapus catatan/pengumuman
- 🏠 **Halaman Beranda** — Informasi umum RW 021
- ℹ️ **Halaman Tentang** — Profil dan informasi RW 021
- 📞 **Halaman Kontak** — Informasi kontak pengurus

---

## 🛠️ Teknologi

| Komponen       | Teknologi                         |
|----------------|-----------------------------------|
| Backend        | PHP (Native, tanpa framework)     |
| Database       | MySQL (via PDO)                   |
| Autoload       | Composer (PSR-4)                  |
| Collections    | `illuminate/collections` v10      |
| Testing        | Pest PHP v3                       |
| Template       | PHP native views                  |

---

---
## ⚙️ Instalasi & Konfigurasi

### Prasyarat

- PHP >= 8.1
- MySQL / MariaDB
- Composer

### Langkah Instalasi

1. **Clone repository**
   ```bash
   git clone
   cd 
   ```

2. **Install dependensi**
   ```bash
   composer install
   ```

3. **Konfigurasi database**

   Edit file `config.php` dan sesuaikan dengan konfigurasi database lokal Anda:
   ```php
   'database' => [
       'host'    => 'localhost',
       'port'    => 3306,
       'dbname'  => 'rw021',
       'charset' => 'utf8mb4',
   ],
   ```

4. **Buat database** dan jalankan migrasi / seed jika tersedia.

5. **Jalankan server lokal**
   ```bash
   php -S localhost:8000 -t public
   ```

6. Akses aplikasi di browser: `http://localhost:8000`

---

## 🐳 Docker (Dev)

Cara tercepat untuk menjalankan aplikasi tanpa setup PHP/MySQL lokal:

```bash
# 1. (Opsional) Buat .env - jika dilewati, nilai default dari compose yang dipakai
cp .env.example .env

# 2. Build & jalankan (app + MariaDB)
docker compose up --build

# 3. Akses aplikasi
#    http://localhost:8000
```

Kredensial database dev (tetap, hanya untuk dev):

| Item     | Nilai |
|----------|-------|
| Host     | `db` (di dalam compose) |
| Port     | `3306` |
| Database | `${DB_NAME} / rw021` |
| User     | `${DB_USER}` |
| Password | `${DB_PASS}` |
| Root     | `root`  |

Source code di-mount dari host, jadi perubahan kode langsung berlaku (hot reload).

**Migrasi database** dijalankan manual karena `database/migrate.php` menghapus
database (DROP DATABASE):

```bash
docker compose exec app php database/migrate.php
docker compose exec app php database/seed_user.php
```

> Catatan: `database/schema.sql` belum ada di repo, sehingga migrate memerlukan
> file skema tersebut terlebih dahulu.

**Composer / Pest di dalam container** (tidak perlu PHP di host):

```bash
docker compose run --rm --entrypoint composer app install
docker compose exec app vendor/bin/pest
```

Setelah selesai: `docker compose down` (tambah `-v` jika ingin menghapus volume DB juga).

---

## 🧪 Menjalankan Test

```bash
./vendor/bin/pest
```

---

## 🤝 Kontribusi

1. Fork repository ini
2. Buat branch fitur baru: `git checkout -b fitur/nama-fitur`
3. Commit perubahan: `git commit -m "Menambahkan fitur ..."`
4. Push ke branch: `git push origin fitur/nama-fitur`
5. Buat Pull Request

---

## 📄 Lisensi

Proyek ini dikembangkan untuk keperluan internal RW 021. Semua hak cipta dilindungi.

---

> Dibuat dengan ❤️ untuk warga RW 021
