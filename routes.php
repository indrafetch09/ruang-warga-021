<?php

$router = new \Core\Router();

// ==========================================
// 1. ROUTES PUBLIK (Bisa diakses semua warga)
// ==========================================

// Halaman Utama & Profil
$router->get('/', 'home/index.php'); // Menampilkan index.view.php
$router->get('/tentang-kami', 'home/about.php'); // Menampilkan tentang-kami.php
$router->get('/pengurus-rw', 'home/pengurus.php'); // Menampilkan pengurus-rw.php

// Notulensi Publik
$router->get('/notulensi', 'notulensi/index.php'); // Menampilkan notulensi.php (List)
$router->get('/notulensi/detail', 'notulensi/show.php'); // Menampilkan detail-notulensi.php

// Galeri Publik
$router->get('/galeri', 'galeri/index.php'); // Menampilkan galeri.php


// ==========================================
// 2. ROUTES AUTENTIKASI (Login & Logout)
// ==========================================

// Login hanya untuk Guest (Belum login)
$router->get('/login', 'session/create.php')->only('guest'); // Menampilkan login.php
$router->post('/login', 'session/store.php')->only('guest'); // Proses validasi login

// Logout hanya untuk Auth (Sudah login)
$router->delete('/logout', 'session/destroy.php')->only('auth'); // Proses hapus session


// ==========================================
// 3. ROUTES ADMIN (Hanya bisa diakses Pengurus)
// ==========================================

// Dasbor Utama Pengurus
$router->get('/dashboard', 'dashboard/index.php')->only('auth'); // Menampilkan dashboard.php

// Manajemen Data Warga (Penduduk)
$router->get('/admin/warga', 'warga/index.php')->only('auth'); // Menampilkan daftar-warga.php
$router->get('/admin/warga/create', 'warga/create.php')->only('auth'); // Menampilkan tambah-warga.php
$router->post('/admin/warga', 'warga/store.php')->only('auth'); // Proses simpan data warga
$router->patch('/admin/warga/approve', 'warga/approve.php')->only('auth'); // Proses approval RW (opsional)

// Manajemen Pengumuman
$router->get('/admin/pengumuman/create', 'pengumuman/create.php')->only('auth'); // Menampilkan tambah-pengumuman.php
$router->post('/admin/pengumuman', 'pengumuman/store.php')->only('auth'); // Proses simpan pengumuman

// Manajemen Notulensi
$router->get('/admin/notulensi/create', 'notulensi/create.php')->only('auth'); // Menampilkan tambah-notulensi.php
$router->post('/admin/notulensi', 'notulensi/store.php')->only('auth'); // Proses simpan notulensi & upload file

// Manajemen Galeri
$router->get('/admin/galeri/create', 'galeri/create.php')->only('auth'); // Menampilkan tambah-galeri.php
$router->post('/admin/galeri', 'galeri/store.php')->only('auth'); // Proses simpan galeri & upload foto

// Manajemen Kegiatan Rutin
$router->get('/admin/kegiatan/create', 'kegiatan/create.php')->only('auth'); // Menampilkan tambah-kegiatan.php
$router->post('/admin/kegiatan', 'kegiatan/store.php')->only('auth'); // Proses simpan kegiatan rutin
