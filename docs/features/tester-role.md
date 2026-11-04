# Role Tester (Khusus Development)

> **Status:** Terimplementasi (Nov 2026)
> **Lingkup:** Akun QA untuk development — **bukan untuk produksi**
> **Ringkas:** `tester` berperilaku **persis seperti `pengurus_rw`**: melihat semua data lintas RT, termasuk menulis/mengubah data. Implementasinya sangat kecil agar mudah dilepas lagi di produksi.

---

## 1. Prinsip

1. **Dev-only.** Role hanya untuk QA / verifikasi fitur saat development (mis.
   mengisi payload karena `migrate.php` menghapus database).
2. **Perilaku = pengurus_rw.** Tester dapat membaca dan memanipulasi data —
   bukan read-only.
3. **Jejak kode minimal.** Tidak ada middleware, tampilan, atau rute tambahan.
   Satu-satunya perubahan kode: `isRw()` mengizinkan role `tester` di **dua
   tempat**, sehingga semua gerbang yang sudah ada (`isRw()`) memperlakukan
   tester seperti RW secara otomatis.

---

## 2. Implementasi

### a. Izinkan `tester` di `isRw()` — 2 file

```php
// Model/User.php
public function isRw(): bool
{
    // 'tester' = akun khusus development, berperilaku sama seperti pengurus RW
    return in_array($this->role ?? '', ['admin', 'pengurus_rw', 'rw', 'tester']);
}

// Core/Authenticator.php
public static function isRw(): bool
{
    // 'tester' = akun khusus development, berperilaku sama seperti pengurus RW
    return in_array(self::role(), ['admin', 'pengurus_rw', 'rw', 'tester']);
}
```

Efek otomatisnya (tanpa perubahan lain di kode):

- Gerbang `isRw()` di controller (`KegiatanController`,
  `PengumumanController`, `PengurusController::index`, `WargaController`) →
  tester lolos, termasuk $statusVerifikasi langsung `verified`.
- Sidebar (`views/partials/admin-sidebar.php` → `$isRwUser`) → semua menu tampil.
- Badge/level "Khusus RW" pada dashboard & Data Penduduk mengikuti jalur RW.

### b. ENUM role di database

```sql
-- database/schema.sql (sudah) dan ALTER live:
ALTER TABLE users
  MODIFY role ENUM('admin','pengurus_rw','pengurus_rt','tester')
  NOT NULL DEFAULT 'pengurus_rt';
```

### c. Buat akun (via SQL, bukan UI — role tidak dikampilkan di form)

```php
// docker compose exec app php -r '...'
$h = password_hash("GANTI-INI", PASSWORD_BCRYPT);
$pdo = new PDO("mysql:host=db;dbname=rw021;charset=utf8mb4", $DB_USER, $DB_PASS);
$pdo->prepare(
  "INSERT INTO users (username, password, role, created_at) VALUES (?,?,?,NOW())"
)->execute(["tester", $h, "tester"]);
```

> Password akun tester tidak boleh dipakai password produksi mana pun. Ganti
> lewat **Pengaturan** setelah login.

---

## 3. Perilaku Setelah Implementasi

| Aksi                                                                                                                  | Status                                                                                           |
| --------------------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------ |
| Login & semua halaman baca (dashboard, warga, pengurus, kegiatan, pengumuman, notulensi, galeri, pengaturan, laporan) | `200`                                                                                            |
| Semua form create/edit (`warga`, `pengumuman`, `kegiatan`, `notulensi`, `galeri`, `laporan`)                          | `200` — seperti RW                                                                               |
| Semua aksi tulis (store/update/delete/approve/reject/import)                                                          | diizinkan — seperti RW                                                                           |
| Form/Aksi manajemen pengurus (`PengurusController::create/store`)                                                     | tetap **khusus `admin`** (`isRw()` tidak cukup) — tester pun terkena aturan yang sama seperti RW |
| Data milik RT lain                                                                                                    | terlihat — sama seperti RW                                                                       |

Sudah diverifikasi: login `tester` → 9 halaman baca `200`, semua form tulis
`200` (`/admin/warga/edit?id=…` `200` untuk id yang ada), sidebar 8 menu,
badge "Akses Baca" tidak muncul (tidak ada UI read-only tersisa).

---

## 4. Checklist Kera Aksi sebelum Deploy Produksi

1. **Lepas dari kode** — hapus `'tester'` dari `isRw()` di
   `Model/User.php` dan `Core/Authenticator.php` (biarkan komentar dihapus juga).
2. **Bersihkan akun** — di database produksi tidak boleh ada user `tester`:

   ```sql
   SELECT id, username FROM users WHERE role = 'tester';
   -- lalu: DELETE FROM users WHERE role = 'tester';
   ```

3. **(Opsional) Rapikan ENUM** — hanya setelah tidak ada baris yang memakai
   nilai `tester`:

   ```sql
   ALTER TABLE users
     MODIFY role ENUM('admin','pengurus_rw','pengurus_rt')
     NOT NULL DEFAULT 'pengurus_rt';
   ```

   Sinkronkan juga `database/schema.sql`.

4. **Verifikasi** — `php -l` dua file berubah; login role lain masih normal;
   `docker compose logs app` tidak ada error.

---

## 5. Referensi Kode

| Topik                   | Lokasi                                                                           |
| ----------------------- | -------------------------------------------------------------------------------- |
| Perubahan perilaku role | `Model/User.php` → `isRw()`; `Core/Authenticator.php` → `isRw()`                 |
| Cek role statis lain    | `Core/Middleware/Role.php` (middleware role generik, tidak relevan untuk tester) |
| ENUM role               | `database/schema.sql` (bagian `users`)                                           |
| Akun                    | dibuat via SQL (lihat §2c)                                                       |
