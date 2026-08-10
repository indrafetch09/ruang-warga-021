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

// Notulensi & Statistik Warga
$router->get('/notulensi', [NotulensiController::class, 'index']);
$router->get('/notulensi/detail', [NotulensiController::class, 'show']);
$router->get('/statistik', function () {
    $db = \Core\App::resolve(\Core\Database::class);

    $totalWarga = (int)($db->query("SELECT COUNT(id) as total FROM warga WHERE status_verifikasi = 'verified'")->find()['total'] ?? 0);
    $totalKK    = (int)($db->query("SELECT COUNT(DISTINCT no_kk) as total FROM warga WHERE status_verifikasi = 'verified'")->find()['total'] ?? 0);
    $totalAll   = (int)($db->query("SELECT COUNT(id) as total FROM warga")->find()['total'] ?? 0);

    $pctVerified = $totalAll > 0 ? round(($totalWarga / $totalAll) * 100) . '%' : '0%';

    $summaryData = [
        'total_kk'   => $totalKK,
        'total_jiwa' => $totalWarga,
        'total_rt'   => 10,
        'verifikasi' => $pctVerified
    ];

    $rtCountsRaw = $db->query("SELECT rt, COUNT(DISTINCT no_kk) as kk, COUNT(id) as jiwa FROM warga WHERE status_verifikasi = 'verified' GROUP BY rt")->get();

    $listDataRt = [];
    for ($i = 1; $i <= 10; $i++) {
        $listDataRt[$i] = ['kk' => 0, 'jiwa' => 0];
    }
    foreach ($rtCountsRaw as $row) {
        $rtNum = (int)$row['rt'];
        if ($rtNum >= 1 && $rtNum <= 10) {
            $listDataRt[$rtNum] = [
                'kk'   => (int)$row['kk'],
                'jiwa' => (int)$row['jiwa']
            ];
        }
    }

    return view('user/statistik.php', [
        'summaryData' => $summaryData,
        'listDataRt'  => $listDataRt
    ]);
});

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
// 3. ROUTES ADMIN / PORTAL SIRW 021
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
