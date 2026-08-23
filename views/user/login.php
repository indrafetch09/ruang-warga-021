<!doctype html>
<html lang="id">

<head>
    <title>Login Pengurus - Ruang Warga 021</title>
    <?php require base_path('views/partials/head.php'); ?>
    <style>
        .bg-login-image {
            background-image: url("/images/kkn_rw21.webp");
            background-size: cover;
            background-position: center;
        }

        .overlay-gradient {
            background: linear-gradient(135deg,
                    rgba(147, 51, 234, 0.9) 0%,
                    rgba(88, 28, 135, 0.95) 100%);
        }
    </style>
</head>

<body class="bg-gray-50 flex min-h-screen">
    <!-- KIRI: GAMBAR & BRANDING (Layar Besar) -->
    <div class="hidden md:flex lg:w-1/2 bg-login-image relative">
        <div class="absolute inset-0 overlay-gradient"></div>
        <div class="relative z-10 flex flex-col justify-between p-12 text-white w-full">
            <!-- Logo Kiri Atas -->
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center text-purple-700 font-bold text-xl shadow-lg">
                    RW
                </div>
                <div>
                    <h2 class="font-bold tracking-widest uppercase text-sm">
                        Admin Warga
                    </h2>
                    <p class="text-purple-200 text-xs">RW 021</p>
                </div>
            </div>

            <!-- Teks Tengah -->
            <div class="max-w-md">
                <h1 class="text-4xl font-extrabold mb-4 leading-tight">
                    Melayani dengan Hati, Berinovasi untuk Warga.
                </h1>
                <p class="text-purple-200 text-lg leading-relaxed mb-8">
                    Sistem manajemen administrasi, pelaporan, dan pengelolaan data warga
                    RW 021. Akses ini dikhususkan bagi jajaran pengurus untuk mempermudah
                    pelayanan.
                </p>
            </div>

            <!-- Footer Kiri Bawah -->
            <div class="text-purple-300 text-sm">
                &copy; <?= date('Y') ?> Pengurus RW 021. V 1.0.0
            </div>
        </div>
    </div>

    <!-- KANAN: FORM LOGIN -->
    <div class="w-full lg:w-1/2 flex flex-col items-center justify-center p-8 sm:p-12 relative bg-white">
        <div class="w-full max-w-md">
            <!-- Tombol Kembali -->
            <div class="mb-6">
                <a href="/" class="inline-flex items-center gap-2 text-sm font-semibold text-gray-500 hover:text-purple-600 transition group">
                    <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Beranda Utama
                </a>
            </div>

            <!-- Logo Khusus Mobile -->
            <div class="lg:hidden flex items-center gap-3 mb-8">
                <div class="w-12 h-12 bg-purple-600 rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-lg">
                    RW
                </div>
                <div>
                    <h2 class="font-bold text-gray-900 tracking-widest uppercase text-sm">
                        Admin Warga
                    </h2>
                    <p class="text-gray-500 text-xs">RW 021</p>
                </div>
            </div>

            <div class="mb-8">
                <h2 class="text-3xl font-extrabold text-gray-900 mb-2">
                    Selamat Datang!
                </h2>
                <p class="text-gray-500 text-sm">
                    Silakan masukkan kredensial Anda untuk mengakses dasbor.
                </p>
            </div>

            <!-- Alert Flash Message (Gagal / Peringatan / Sukses) -->
            <?php
            $errors = \Core\Session::get('errors') ?? [];
            $flashError = \Core\Session::get('error');
            $flashSukses = \Core\Session::get('sukses');
            ?>

            <?php if (!empty($flashSukses)): ?>
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-xl text-xs text-emerald-700 font-semibold flex items-center gap-2">
                    <svg class="w-4 h-4 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span><?= htmlspecialchars($flashSukses) ?></span>
                </div>
            <?php endif; ?>

            <?php if (!empty($flashError)): ?>
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-xs text-red-600 font-semibold flex items-center gap-2">
                    <svg class="w-4 h-4 text-red-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    <span><?= htmlspecialchars($flashError) ?></span>
                </div>
            <?php endif; ?>

            <?php if (!empty($errors)): ?>
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
                    <ul class="text-xs text-red-600 font-medium space-y-1">
                        <?php foreach ($errors as $error): ?>
                            <li>• <?= htmlspecialchars($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- Alert Peringatan Hak Akses -->
            <div class="mb-6 p-4 bg-amber-50 border border-amber-200 rounded-xl flex gap-3 items-start">
                <div class="mt-0.5 text-amber-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-amber-800">Akses Terbatas</h4>
                    <p class="text-xs text-amber-700 mt-1 leading-relaxed">
                        Halaman ini khusus untuk Pengurus RW dan Ketua RT. Warga umum tidak perlu melakukan login.
                    </p>
                </div>
            </div>

            <form action="/login" method="POST" class="space-y-5">
                <?= \Core\Csrf::field() ?>

                <!-- ID Pengguna / Email -->
                <div>
                    <label for="identity" class="block text-sm font-semibold text-gray-700 mb-2">ID Pengurus / Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <input type="text" id="identity" name="identity" value="<?= htmlspecialchars($_SESSION['_flash']['old']['identity'] ?? '') ?>" placeholder="Masukkan ID atau Email Anda"
                            class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-[10px] focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition text-sm"
                            required />
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Kata Sandi</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <input type="password" id="password" name="password" placeholder="••••••••"
                            class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-[10px] focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition text-sm"
                            required />
                    </div>
                </div>

                <!-- Checkbox & Lupa Password -->
                <div class="flex items-center justify-between mt-4">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember-me" type="checkbox"
                            class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded cursor-pointer" />
                        <label for="remember-me" class="ml-2 block text-sm text-gray-600 cursor-pointer">
                            Ingat saya
                        </label>
                    </div>
                    <div class="text-sm">
                        <button type="button" onclick="openForgotModal()" class="font-semibold text-purple-600 hover:text-purple-500 transition">
                            Lupa sandi?
                        </button>
                    </div>
                </div>

                <!-- Button Submit -->
                <div class="pt-2">
                    <button type="submit"
                        class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-[10px] shadow-md text-sm font-bold text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition duration-200">
                        Masuk ke Dasbor
                    </button>
                </div>
            </form>

            <div class="mt-8 text-center text-xs text-gray-500">
                Mengalami kendala login?
                <button type="button" onclick="openForgotModal()" class="font-bold text-purple-600 hover:underline">Hubungi Tim IT</button>
            </div>
        </div>
    </div>

    <!-- MODAL BANTUAN LUPA KATA SANDI -->
    <div id="forgot-password-modal" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl space-y-4 relative">
            <div class="flex justify-between items-center border-b border-gray-100 pb-3">
                <h3 class="text-base font-bold text-gray-900 flex items-center gap-2">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                    <span>Pemulihan Kata Sandi Pengurus</span>
                </h3>
                <button type="button" onclick="closeForgotModal()" class="text-gray-400 hover:text-gray-700 text-xl font-bold">&times;</button>
            </div>

            <div class="space-y-3 text-xs text-gray-600 leading-relaxed">
                <p>
                    Untuk menjaga keamanan data warga RW 021, reset kata sandi akun Pengurus RT dan RW dilakukan secara terpusat oleh <strong>Administrator Sistem RW 021</strong>.
                </p>
                <div class="p-3 bg-purple-50 rounded-xl border border-purple-100 text-purple-900">
                    <p class="font-bold mb-1.5 flex items-center gap-1.5 text-xs">
                        <svg class="w-4 h-4 text-purple-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                        <span>Langkah Pemulihan Akun:</span>
                    </p>
                    <ol class="list-decimal list-inside space-y-1 text-[11px] text-purple-800">
                        <li>Hubungi Administrator RW melalui WhatsApp resmi.</li>
                        <li>Sebutkan <strong>Nama Lengkap</strong> dan <strong>Wilayah RT</strong> Anda.</li>
                        <li>Admin akan mereset dan memberikan kata sandi sementara yang dapat langsung Anda ubah di menu Pengaturan.</li>
                    </ol>
                </div>
            </div>

            <div class="flex flex-col gap-2 pt-2 border-t border-gray-100">
                <a href="https://wa.me/6282299007700?text=Halo%20Admin%20RW%20021,%20saya%20pengurus%20ingin%20mengajukan%20reset%20kata%20sandi%20akun%20dasbor." target="_blank"
                    class="w-full py-3 px-4 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs font-bold text-center transition flex items-center justify-center gap-2 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    <span>Hubungi Admin RW via WhatsApp</span>
                </a>
                <button type="button" onclick="closeForgotModal()" class="w-full py-2.5 px-4 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl text-xs font-bold transition">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <script>
        function openForgotModal() {
            document.getElementById('forgot-password-modal').classList.remove('hidden');
        }

        function closeForgotModal() {
            document.getElementById('forgot-password-modal').classList.add('hidden');
        }

        document.getElementById('forgot-password-modal').addEventListener('click', function(e) {
            if (e.target === this) closeForgotModal();
        });
    </script>
</body>

</html>