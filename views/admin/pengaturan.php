<!doctype html>
<html lang="id">

<head>
    <title>Pengaturan Sistem & Akun - Dasbor Pengurus RW 021</title>
    <?php require base_path('views/partials/head.php'); ?>
</head>

<body class="text-gray-800 bg-gray-50 flex flex-col min-h-screen">
    <?php require base_path('views/partials/admin-header.php'); ?>

    <div class="flex flex-1 max-w-[1400px] w-full mx-auto relative">
        <?php require base_path('views/partials/admin-sidebar.php'); ?>

        <main class="flex-1 w-full min-w-0 p-4 sm:p-6 lg:p-8 space-y-8">

            <!-- PAGE HEADER -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 pb-6 border-b border-gray-200">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight flex items-center gap-3">
                        <span>Pengaturan <span class="text-purple-600">Sistem & Akun</span></span>
                    </h1>
                    <p class="text-xs sm:text-sm text-gray-500 mt-1">
                        Kelola data profil, keamanan kata sandi, dan manajemen akun pengurus RW 021.
                    </p>
                </div>
            </div>

            <!-- FLASH ALERTS -->
            <?php if ($sukses = \Core\Session::get('sukses')): ?>
                <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl flex items-center gap-3 text-sm font-semibold shadow-sm">
                    <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span><?= htmlspecialchars($sukses) ?></span>
                </div>
            <?php endif; ?>

            <?php if ($errors = \Core\Session::get('errors')): ?>
                <div class="p-4 bg-rose-50 border border-rose-200 text-rose-800 rounded-2xl text-sm shadow-sm space-y-1">
                    <div class="font-bold flex items-center gap-2">
                        <svg class="w-5 h-5 text-rose-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Terjadi kesalahan pada formulir:</span>
                    </div>
                    <ul class="list-disc list-inside pl-5 text-xs text-rose-700">
                        <?php foreach ((array)$errors as $err): ?>
                            <li><?= htmlspecialchars($err) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- GRID SECTION 1 & 2: PROFIL & KEAMANAN AKUN SAYA -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- 1. KARTU PROFIL AKUN SAYA -->
                <div class="bg-white rounded-2xl border border-purple-100 p-6 shadow-sm space-y-5">
                    <div class="flex items-center gap-3 border-b border-gray-100 pb-4">
                        <div class="w-10 h-10 bg-purple-100 text-purple-700 rounded-xl flex items-center justify-center font-bold">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-base font-bold text-gray-900">Profil Akun Saya</h2>
                            <p class="text-xs text-gray-500">Informasi identitas dan kontak login akun Anda</p>
                        </div>
                    </div>

                    <form action="/admin/pengaturan/profile" method="POST" class="space-y-4">
                        <?= \Core\Csrf::field() ?>

                        <div>
                            <label for="username" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Username / ID Pengurus</label>
                            <input type="text" id="username" name="username" value="<?= htmlspecialchars($userData['username'] ?? '') ?>" required
                                class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-purple-500" />
                        </div>

                        <div>
                            <label for="email" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Alamat Email</label>
                            <input type="email" id="email" name="email" value="<?= htmlspecialchars($userData['email'] ?? '') ?>" required
                                class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-purple-500" />
                        </div>

                        <div class="grid grid-cols-2 gap-4 pt-1">
                            <div>
                                <span class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Peran / Role</span>
                                <span class="inline-block px-3 py-1.5 bg-purple-50 text-purple-700 rounded-xl text-xs font-bold uppercase tracking-wider">
                                    <?= htmlspecialchars($userData['role'] ?? 'Pengurus') ?>
                                </span>
                            </div>
                            <div>
                                <span class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Wilayah Tugas</span>
                                <span class="inline-block px-3 py-1.5 bg-gray-100 text-gray-700 rounded-xl text-xs font-bold">
                                    <?= !empty($userData['rt_assigned']) ? 'RT ' . htmlspecialchars($userData['rt_assigned']) : 'Semua RT (RW 021)' ?>
                                </span>
                            </div>
                        </div>

                        <div class="pt-3">
                            <button type="submit" class="w-full py-2.5 px-4 bg-purple-600 hover:bg-purple-700 text-white rounded-xl text-xs font-bold transition shadow-sm inline-flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                                </svg>
                                <span>Simpan Perubahan Profil</span>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- 2. KARTU GANTI KATA SANDI (PRIBADI) -->
                <div id="keamanan" class="bg-white rounded-2xl border border-purple-100 p-6 shadow-sm space-y-5">
                    <div class="flex items-center gap-3 border-b border-gray-100 pb-4">
                        <div class="w-10 h-10 bg-amber-100 text-amber-700 rounded-xl flex items-center justify-center font-bold">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-base font-bold text-gray-900">Keamanan & Ganti Sandi</h2>
                            <p class="text-xs text-gray-500">Perbarui kata sandi akun Anda secara berkala</p>
                        </div>
                    </div>

                    <form action="/admin/pengaturan/password" method="POST" class="space-y-4">
                        <?= \Core\Csrf::field() ?>

                        <div>
                            <label for="current_password" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Kata Sandi Saat Ini</label>
                            <input type="password" id="current_password" name="current_password" required placeholder="••••••••"
                                class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-purple-500" />
                        </div>

                        <div>
                            <label for="new_password" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Kata Sandi Baru (Min. 6 Karakter)</label>
                            <input type="password" id="new_password" name="new_password" required minlength="6" placeholder="••••••••"
                                class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-purple-500" />
                        </div>

                        <div>
                            <label for="confirm_password" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Konfirmasi Kata Sandi Baru</label>
                            <input type="password" id="confirm_password" name="confirm_password" required minlength="6" placeholder="••••••••"
                                class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-purple-500" />
                        </div>

                        <div class="pt-3">
                            <button type="submit" class="w-full py-2.5 px-4 bg-gray-900 hover:bg-black text-white rounded-xl text-xs font-bold transition shadow-sm inline-flex items-center justify-center gap-2">
                                <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                <span>Perbarui Kata Sandi</span>
                            </button>
                        </div>
                    </form>
                </div>

            </div>

            <!-- 3. KELOLA AKUN PENGURUS & RESET PASSWORD (KHUSUS SUPER ADMIN) -->
            <?php if ($user->isAdmin()): ?>
                <div id="kelola-akun" class="bg-white rounded-2xl border border-purple-100 p-6 shadow-sm space-y-5">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 border-b border-gray-100 pb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-indigo-100 text-indigo-700 rounded-xl flex items-center justify-center font-bold">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-base font-bold text-gray-900">Manajemen Akun & Reset Kata Sandi Pengurus</h2>
                                <p class="text-xs text-gray-500">Khusus Super Admin: Reset kata sandi pengurus RT/RW yang mengalami kendala lupa password.</p>
                            </div>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs text-gray-700">
                            <thead class="bg-gray-50 text-gray-500 uppercase tracking-wider font-extrabold border-b border-gray-200">
                                <tr>
                                    <th class="py-3 px-4">Pengguna</th>
                                    <th class="py-3 px-4">Email</th>
                                    <th class="py-3 px-4">Peran (Role)</th>
                                    <th class="py-3 px-4">Wilayah RT</th>
                                    <th class="py-3 px-4 text-right">Aksi Pemulihan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <?php foreach ($allUsers as $u): ?>
                                    <tr class="hover:bg-purple-50/40 transition">
                                        <td class="py-3.5 px-4 font-bold text-gray-900">
                                            <?= htmlspecialchars($u['username']) ?>
                                            <?php if ($u['id'] === $user->id): ?>
                                                <span class="ml-1 px-2 py-0.5 bg-purple-100 text-purple-700 text-[10px] rounded-full font-extrabold">Akun Anda</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="py-3.5 px-4 text-gray-600 font-medium">
                                            <?= htmlspecialchars($u['email']) ?>
                                        </td>
                                        <td class="py-3.5 px-4">
                                            <?php
                                            $roleBadge = 'bg-gray-100 text-gray-700';
                                            if ($u['role'] === 'admin') $roleBadge = 'bg-purple-100 text-purple-700 font-extrabold';
                                            elseif ($u['role'] === 'pengurus_rw') $roleBadge = 'bg-indigo-100 text-indigo-700 font-bold';
                                            elseif ($u['role'] === 'pengurus_rt') $roleBadge = 'bg-emerald-100 text-emerald-700 font-bold';
                                            ?>
                                            <span class="px-2.5 py-1 rounded-lg text-[10px] uppercase tracking-wider <?= $roleBadge ?>">
                                                <?= htmlspecialchars($u['role']) ?>
                                            </span>
                                        </td>
                                        <td class="py-3.5 px-4 font-semibold text-gray-700">
                                            <?= !empty($u['rt_assigned']) ? 'RT ' . htmlspecialchars($u['rt_assigned']) : 'Semua RT' ?>
                                        </td>
                                        <td class="py-3.5 px-4 text-right">
                                            <button type="button" onclick="openResetModal(<?= $u['id'] ?>, '<?= htmlspecialchars($u['username']) ?>')"
                                                class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-700 rounded-lg text-xs font-bold border border-rose-200 transition">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                                                </svg>
                                                <span>Reset Sandi</span>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>

            <!-- 4. PUSAT BANTUAN & INFORMASI PEMULIHAN SANDI -->
            <div class="bg-purple-900 text-white rounded-2xl p-6 sm:p-8 shadow-md relative overflow-hidden">
                <div class="relative z-10 space-y-3 max-w-2xl">
                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-white/10 rounded-full text-purple-200 text-xs font-bold uppercase tracking-wider">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        <span>Alur Bantuan Lupa Kata Sandi</span>
                    </div>
                    <h3 class="text-xl sm:text-2xl font-black tracking-tight text-white">
                        Pengurus Mengalami Kendala Login atau Lupa Sandi?
                    </h3>
                    <p class="text-xs sm:text-sm text-purple-200 leading-relaxed">
                        Jika Ketua RT atau Pengurus RW lupa kata sandi, mereka dapat menekan tombol <strong>"Lupa Sandi"</strong> di halaman login untuk menghubungi Administrator RW. Super Admin dapat langsung mereset kata sandi melalui panel di atas.
                    </p>
                    <div class="pt-2">
                        <a href="https://wa.me/6282299007700?text=Halo%20Admin%20RW%20021,%20saya%20pengurus%20ingin%20mengajukan%20bantuan%20reset%20kata%20sandi." target="_blank"
                            class="inline-flex items-center gap-2 px-5 py-2.5 bg-white text-purple-900 font-bold text-xs rounded-xl hover:bg-purple-50 transition shadow-sm">
                            <span>Hubungi Koordinator IT RW 021 via WhatsApp</span>
                            <span>&rarr;</span>
                        </a>
                    </div>
                </div>
            </div>

        </main>
    </div>

    <!-- MODAL RESET KATA SANDI (SUPER ADMIN) -->
    <div id="reset-password-modal" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl space-y-4">
            <div class="flex justify-between items-center border-b border-gray-100 pb-3">
                <h3 class="text-base font-bold text-gray-900 flex items-center gap-2">
                    <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                    </svg>
                    <span>Reset Kata Sandi Pengurus</span>
                </h3>
                <button type="button" onclick="closeResetModal()" class="text-gray-400 hover:text-gray-700 text-xl font-bold">&times;</button>
            </div>

            <p class="text-xs text-gray-600">
                Atur kata sandi baru untuk akun: <strong id="reset-modal-username" class="text-purple-700"></strong>.
            </p>

            <form action="/admin/pengaturan/reset-password" method="POST" class="space-y-4">
                <?= \Core\Csrf::field() ?>
                <input type="hidden" id="reset-modal-user-id" name="target_user_id" value="" />

                <div>
                    <label for="target_new_password" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Kata Sandi Baru</label>
                    <input type="text" id="target_new_password" name="target_new_password" required minlength="6" placeholder="Masukkan kata sandi baru (min. 6 karakter)"
                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 font-mono" />
                </div>

                <div class="flex justify-end gap-2 pt-3 border-t border-gray-100">
                    <button type="button" onclick="closeResetModal()" class="px-4 py-2 text-xs font-bold text-gray-600 hover:bg-gray-100 rounded-xl transition">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 text-xs font-bold text-white bg-rose-600 hover:bg-rose-700 rounded-xl transition shadow-sm">
                        Simpan & Reset Sandi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openResetModal(userId, username) {
            document.getElementById('reset-modal-user-id').value = userId;
            document.getElementById('reset-modal-username').innerText = username;
            document.getElementById('target_new_password').value = 'rw021-' + Math.random().toString(36).substring(2, 7);
            document.getElementById('reset-password-modal').classList.remove('hidden');
        }

        function closeResetModal() {
            document.getElementById('reset-password-modal').classList.add('hidden');
        }

        document.getElementById('reset-password-modal').addEventListener('click', function(e) {
            if (e.target === this) closeResetModal();
        });
    </script>
</body>

</html>