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

// Layanan Warga (Administrasi Kependudukan & TPST)
$router->get('/layanan', function () {
    return view('user/layanan.php');
});

// Notulensi & Statistik Warga
$router->get('/notulensi', [NotulensiController::class, 'index']);
$router->get('/notulensi/detail', [NotulensiController::class, 'show']);
$router->get('/statistik', function () {
    return view('user/statistik.php');
});

// Galeri Publik
$router->get('/galeri', [GaleriController::class, 'index']);

// Hubungi Kami / Contact
$router->get('/contact', function () {
    return view('user/hubungi-kami.php');
});
$router->get('/hubungi-kami', function () {
    return view('user/hubungi-kami.php');
});

// Laporan Bulanan (Public list & Auth create/store)
$router->get('/laporan', [LaporanController::class, 'index'])->only('auth');
$router->get('/laporan/create', [LaporanController::class, 'create'])->only('auth');
$router->post('/laporan', [LaporanController::class, 'store'])->only('auth');


// ==========================================
// 2. ROUTES AUTENTIKASI (Login & Logout)
// ==========================================

// Login (Guest Only)
$router->get('/login', function () {
    return view('user/login.php');
})->only('guest');

$router->post('/login', function () {
    // 1. Verifikasi CSRF Token
    if (!\Core\Csrf::verify($_POST['_csrf_token'] ?? null)) {
        \Core\Session::flash('errors', ['identity' => 'Sesi keamanan telah kadaluarsa. Silakan coba lagi.']);
        return redirect('/login');
    }

    $identity = trim($_POST['identity'] ?? $_POST['username'] ?? $_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // 2. Form Validation & Rate Limiting Check
    $form = \Http\Forms\LoginForm::validate([
        'identity' => $identity,
        'password' => $password,
    ]);

    // 3. Attempt Authentication
    $signedIn = (new \Core\Authenticator())->attempt($identity, $password);

    if (!$signedIn) {
        $form->error('identity', 'Email/ID Pengurus atau kata sandi yang Anda masukkan salah.')->throw();
    }

    \Core\Session::flash('sukses', 'Selamat datang kembali di Portal Ruang Warga 021!');
    redirect('/dashboard');
})->only('guest');

// Logout (Auth Only)
$router->post('/logout', function () {
    (new \Core\Authenticator())->logout();
    redirect('/');
})->only('auth');

$router->delete('/logout', function () {
    (new \Core\Authenticator())->logout();
    redirect('/');
})->only('auth');


// ==========================================
// 3. ROUTES ADMIN / PORTAL SIRW 21
// ==========================================

use App\Controllers\AdminController;

// Dasbor Utama Pengurus
$router->get('/admin', [AdminController::class, 'dashboard'])->only('auth');
$router->get('/dashboard', [AdminController::class, 'dashboard'])->only('auth');

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
    return view('admin/tambah-kegiatan.php');
})->only('auth');

$router->post('/admin/kegiatan', function () {
    return redirect('/dashboard');
})->only('auth');
