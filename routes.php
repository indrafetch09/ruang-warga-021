<?php

use App\Controllers\HomeController;
use App\Controllers\GaleriController;
use App\Controllers\NotulensiController;
use App\Controllers\PengumumanController;
use App\Controllers\WargaController;
use App\Controllers\LaporanController;

$router = new \Core\Router();

// ==========================================
// 1. ROUTES PUBLIK (Bisa diakses semua warga)
// ==========================================

// Halaman Utama & Profil
$router->get('/', [HomeController::class, 'index']);
$router->get('/tentang-kami', [HomeController::class, 'about']);
$router->get('/pengurus-rw', [HomeController::class, 'pengurus']);

// Notulensi Publik
$router->get('/notulensi', [NotulensiController::class, 'index']);
$router->get('/notulensi/detail', [NotulensiController::class, 'show']);

// Galeri Publik
$router->get('/galeri', [GaleriController::class, 'index']);

// Hubungi Kami / Contact
$router->get('/contact', function () {
    return view('hubungi-kami.php');
});
$router->get('/hubungi-kami', function () {
    return view('hubungi-kami.php');
});

// Laporan Bulanan (Public list & Auth create/store)
$router->get('/laporan', [LaporanController::class, 'index'])->only('auth');
$router->get('/laporan/create', [LaporanController::class, 'create'])->only('auth');
$router->post('/laporan', [LaporanController::class, 'store'])->only('auth');


// ==========================================
// 2. ROUTES AUTENTIKASI (Login & Logout)
// ==========================================

// Login hanya untuk Guest (Belum login)
$router->get('/login', function () {
    return view('login.php');
})->only('guest');

$router->post('/login', function () {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $auth = new \Core\Authenticator();
    if ($auth->attempt($email, $password)) {
        redirect('/dashboard');
    } else {
        \Core\Session::flash('errors', ['email' => 'Email atau password yang Anda masukkan salah.']);
        redirect('/login');
    }
})->only('guest');

// Logout hanya untuk Auth (Sudah login)
$router->delete('/logout', function () {
    (new \Core\Authenticator())->logout();
    redirect('/');
})->only('auth');


// ==========================================
// 3. ROUTES ADMIN / PORTAL SIRW 21
// ==========================================

// Dasbor Utama Pengurus
$router->get('/admin', function () {
    return view('dashboard.php');
})->only('auth');

$router->get('/dashboard', function () {
    return view('dashboard.php');
})->only('auth');

// Manajemen Data Warga (Penduduk)
$router->get('/admin/warga', [WargaController::class, 'index'])->only('auth');
$router->get('/warga/create', [WargaController::class, 'create'])->only('auth');
$router->post('/warga', [WargaController::class, 'store'])->only('auth');

// Manajemen Pengumuman
$router->get('/admin/pengumuman/create', [PengumumanController::class, 'create'])->only('auth');
$router->post('/admin/pengumuman', [PengumumanController::class, 'store'])->only('auth');

// Manajemen Notulensi
$router->get('/admin/notulensi/create', [NotulensiController::class, 'create'])->only('auth');
$router->post('/admin/notulensi', [NotulensiController::class, 'store'])->only('auth');

// Manajemen Galeri
$router->get('/admin/galeri/create', [GaleriController::class, 'create'])->only('auth');
$router->post('/admin/galeri', [GaleriController::class, 'store'])->only('auth');

// Manajemen Kegiatan Rutin
$router->get('/admin/kegiatan/create', function () {
    return view('tambah-kegiatan.php');
})->only('auth');

$router->post('/admin/kegiatan', function () {
    return redirect('/dashboard');
})->only('auth');
