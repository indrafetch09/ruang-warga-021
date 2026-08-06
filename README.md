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
       'dbname'  => 'ruang_warga_021',
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
