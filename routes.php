<?php

use App\Controllers\HomeController;
use App\Controllers\GaleriController;
use App\Controllers\NotulensiController;
use App\Controllers\PengumumanController;
use App\Controllers\WargaController;
use App\Controllers\LaporanController;
use App\Controllers\KegiatanController;
use App\Controllers\PengurusController;
use App\Controllers\StatistikController;
use App\Controllers\AdminController;

$router = new \Core\Router();

// ==========================================
// 1. ROUTES PUBLIK (Bisa diakses semua warga)
// ==========================================

// Halaman Utama & Profil
$router->get('/', [HomeController::class, 'index']);
$router->get('/tentang-kami', [HomeController::class, 'about']);
$router->get('/pengurus-rw', [HomeController::class, 'pengurus']);
// Layanan Warga (Aula RW 021 & TPST)
$router->get('/layanan', function () {
    return view('user/layanan.php');
});
$router->get('/aula-rw', function () {
    return view('user/layanan.php');
});
$router->get('/tpst', function () {
    return view('user/tpst.php');
});
$router->get('/kebersihan', function () {
    return view('user/tpst.php');
});

// Kegiatan Rutin Publik (Panduan Warga)
$router->get('/kegiatan', [KegiatanController::class, 'index']);

// Notulensi & Statistik Warga
$router->get('/notulensi', [NotulensiController::class, 'index']);
$router->get('/notulensi/detail', [NotulensiController::class, 'show']);
$router->get('/statistik', [StatistikController::class, 'index']);
$router->get('/pengumuman', [PengumumanController::class, 'index']);

// Galeri Publik
$router->get('/galeri', [GaleriController::class, 'index']);

// Hubungi Kami & Lokasi Maps
$router->get('/contact', function () {
    return view('user/hubungi-kami.php');
});
$router->get('/hubungi-kami', function () {
    return view('user/hubungi-kami.php');
});
$router->get('/lokasi', function () {
    return view('user/lokasi.php');
});
$router->get('/maps', function () {
    return view('user/lokasi.php');
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
    if (!\Core\Csrf::verify($_POST['_csrf_token'] ?? null)) {
        \Core\Session::flash('errors', ['identity' => 'Sesi keamanan telah kadaluarsa. Silakan coba lagi.']);
        return redirect('/login');
    }

    $identity = trim($_POST['identity'] ?? $_POST['username'] ?? $_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $form = \Http\Forms\LoginForm::validate([
        'identity' => $identity,
        'password' => $password,
    ]);

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
// 3. ROUTES ADMIN / PORTAL SIRW 021 (LENGKAP CRUD)
// ==========================================

// Dasbor Utama Pengurus
$router->get('/admin', [AdminController::class, 'dashboard'])->only('auth');
$router->get('/dashboard', [AdminController::class, 'dashboard'])->only('auth');

// --- A. Manajemen Data Warga ---
$router->get('/admin/warga', [WargaController::class, 'index'])->only('auth');
$router->get('/admin/warga/create', [WargaController::class, 'create'])->only('auth');
$router->post('/warga', [WargaController::class, 'store'])->only('auth');

// Edit, Update & Delete Warga
$router->get('/admin/warga/edit', [WargaController::class, 'edit'])->only('auth');
$router->post('/admin/warga/update', [WargaController::class, 'update'])->only('auth');
$router->post('/admin/warga/delete', [WargaController::class, 'destroy'])->only('auth');

// Approve & Reject (RT ke RW)
$router->post('/admin/warga/approve', [WargaController::class, 'approve'])->only('auth');
$router->post('/admin/warga/reject', [WargaController::class, 'reject'])->only('auth');

$router->get('/admin/pengurus', [PengurusController::class, 'index'])->only('auth');
$router->get('/admin/pengurus/create', [PengurusController::class, 'create'])->only('auth');
$router->post('/admin/pengurus', [PengurusController::class, 'store'])->only('auth');
$router->get('/admin/pengurus/edit', [PengurusController::class, 'edit'])->only('auth');
$router->post('/admin/pengurus/update', [PengurusController::class, 'update'])->only('auth');
$router->post('/admin/pengurus/delete', [PengurusController::class, 'destroy'])->only('auth');
// --- D. Manajemen Notulensi Rapat ---
$router->get('/admin/notulensi', [NotulensiController::class, 'adminIndex'])->only('auth');
$router->get('/admin/notulensi/create', [NotulensiController::class, 'create'])->only('auth');
$router->post('/admin/notulensi', [NotulensiController::class, 'store'])->only('auth');
$router->get('/admin/notulensi/edit', [NotulensiController::class, 'edit'])->only('auth');
$router->post('/admin/notulensi/update', [NotulensiController::class, 'update'])->only('auth');
$router->post('/admin/notulensi/delete', [NotulensiController::class, 'destroy'])->only('auth');

// --- E. Manajemen Galeri Kegiatan ---
$router->get('/admin/galeri', [GaleriController::class, 'adminIndex'])->only('auth');
$router->get('/admin/galeri/create', [GaleriController::class, 'create'])->only('auth');
$router->post('/admin/galeri', [GaleriController::class, 'store'])->only('auth');
$router->get('/admin/galeri/edit', [GaleriController::class, 'edit'])->only('auth');
$router->post('/admin/galeri/update', [GaleriController::class, 'update'])->only('auth');
$router->post('/admin/galeri/delete', [GaleriController::class, 'destroy'])->only('auth');

// --- F. Manajemen Kegiatan Rutin ---
$router->get('/admin/kegiatan', [KegiatanController::class, 'adminIndex'])->only('auth');
$router->get('/admin/kegiatan/create', [KegiatanController::class, 'create'])->only('auth');
$router->post('/admin/kegiatan', [KegiatanController::class, 'store'])->only('auth');
$router->get('/admin/kegiatan/edit', [KegiatanController::class, 'edit'])->only('auth');
$router->post('/admin/kegiatan/update', [KegiatanController::class, 'update'])->only('auth');
$router->post('/admin/kegiatan/delete', [KegiatanController::class, 'destroy'])->only('auth');

// --- C. Manajemen Pengumuman (DITAMBAHKAN) ---
$router->get('/admin/pengumuman', [PengumumanController::class, 'adminIndex'])->only('auth');
$router->get('/admin/pengumuman/create', [PengumumanController::class, 'create'])->only('auth');
$router->post('/admin/pengumuman', [PengumumanController::class, 'store'])->only('auth');
$router->get('/admin/pengumuman/edit', [PengumumanController::class, 'edit'])->only('auth');
$router->post('/admin/pengumuman/update', [PengumumanController::class, 'update'])->only('auth');
$router->post('/admin/pengumuman/delete', [PengumumanController::class, 'destroy'])->only('auth');

$router->get('/admin/warga/template', [App\Controllers\WargaController::class, 'downloadTemplate'])->only('auth');
$router->post('/admin/warga/import', [App\Controllers\WargaController::class, 'import'])->only('auth');
