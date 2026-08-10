<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dasbor Pengurus - Ruang Warga 021</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="/css/theme.css" />
    <style>
        body { font-family: "Plus Jakarta Sans", sans-serif; }
    </style>
</head>

<body class="text-gray-800 bg-gray-50 flex flex-col min-h-screen">
    <?php require base_path('views/partials/admin-header.php'); ?>

    <!-- WRAPPER SIDEBAR & MAIN CONTENT -->
    <div class="flex flex-1 max-w-[1400px] w-full mx-auto relative">
        <?php require base_path('views/partials/admin-sidebar.php'); ?>

        <!-- MAIN CONTENT -->
        <main class="flex-1 w-full min-w-0 p-4 sm:p-6 lg:p-8 space-y-8">

            <?php
                // Helper Role Check
                $isObject = is_object($user);
                $isRw = ($isObject && method_exists($user, 'isRw')) ? $user->isRw() : (($user['role'] ?? $user->role ?? '') === 'admin' || ($user['role'] ?? $user->role ?? '') === 'rw' || ($user['role'] ?? $user->role ?? '') === 'pengurus_rw');
                $isRt = ($isObject && method_exists($user, 'isRt')) ? $user->isRt() : (($user['role'] ?? $user->role ?? '') === 'rt' || ($user['role'] ?? $user->role ?? '') === 'pengurus_rt');
                $assignedRt = ($isObject && method_exists($user, 'getRtAssigned')) ? $user->getRtAssigned() : ($user['rt'] ?? $user->rt ?? 1);
            ?>

            <!-- Alert Message Flash (Jika Ada) -->
            <?php $sukses = \Core\Session::get('sukses'); ?>
            <?php if ($sukses): ?>
                <div class="p-4 bg-emerald-50 border border-emerald-200 rounded-2xl flex items-center justify-between text-emerald-800 text-sm font-semibold shadow-sm">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span><?= htmlspecialchars($sukses) ?></span>
                    </div>
                </div>
            <?php endif; ?>

            <!-- SIMPLE PAGE HEADER -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-gray-200 pb-6">
                <div>
                    <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900">Selamat Datang di <span class="text-purple-600">Admin RW 021</span></h1>
                </div>
            </div>

            <!-- RINGKASAN STATISTIK DARI DATABASE -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                <!-- Card 1: Total Penduduk -->
                <div class="bg-white p-5 rounded-2xl border border-purple-100 shadow-sm flex items-center gap-4 hover:-translate-y-0.5 transition duration-200">
                    <div class="w-12 h-12 bg-purple-100 text-purple-700 rounded-2xl flex items-center justify-center flex-shrink-0 font-bold">
                        <svg class="w-6 h-6 text-purple-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">Total Warga</p>
                        <h3 class="text-2xl font-extrabold text-gray-900"><?= number_format($totalWarga ?? 0) ?></h3>
                    </div>
                </div>

                <!-- Card 2: Total KK -->
                <div class="bg-white p-5 rounded-2xl border border-purple-100 shadow-sm flex items-center gap-4 hover:-translate-y-0.5 transition duration-200">
                    <div class="w-12 h-12 bg-emerald-100 text-emerald-700 rounded-2xl flex items-center justify-center flex-shrink-0 font-bold">
                        <svg class="w-6 h-6 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">Kepala Keluarga</p>
                        <h3 class="text-2xl font-extrabold text-gray-900"><?= number_format($totalKK ?? 0) ?></h3>
                    </div>
                </div>

                <!-- Card 3: Verifikasi Pending -->
                <div class="bg-white p-5 rounded-2xl border border-purple-100 shadow-sm flex items-center gap-4 hover:-translate-y-0.5 transition duration-200">
                    <div class="w-12 h-12 bg-amber-100 text-amber-700 rounded-2xl flex items-center justify-center flex-shrink-0 font-bold">
                        <svg class="w-6 h-6 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">Pending Verifikasi</p>
                        <h3 class="text-2xl font-extrabold text-gray-900"><?= number_format($totalPending ?? 0) ?></h3>
                    </div>
                </div>

                <!-- Card 4: Notulensi Rapat -->
                <div class="bg-white p-5 rounded-2xl border border-purple-100 shadow-sm flex items-center gap-4 hover:-translate-y-0.5 transition duration-200">
                    <div class="w-12 h-12 bg-sky-100 text-sky-700 rounded-2xl flex items-center justify-center flex-shrink-0 font-bold">
                        <svg class="w-6 h-6 text-sky-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">Arsip Rapat</p>
                        <h3 class="text-2xl font-extrabold text-gray-900"><?= number_format($totalNotulensi ?? 0) ?></h3>
                    </div>
                </div>
            </div>

            <!-- GRID MANAJEMEN UTAMA -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- KIRI (2-cols): MENU UTAMA & TABEL TERBARU -->
                <div class="lg:col-span-2 space-y-8">

                    <!-- Quick Actions Grid -->
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Menu Akses Cepat</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Card Penduduk -->
                            <div class="bg-white p-6 rounded-2xl border border-purple-100 shadow-sm hover:border-purple-300 transition flex flex-col justify-between">
                                <div>
                                    <div class="flex justify-between items-start mb-3">
                                        <div class="w-10 h-10 bg-purple-100 text-purple-700 rounded-xl flex items-center justify-center font-bold">
                                            <svg class="w-5 h-5 text-purple-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                        </div>
                                        <span class="text-xs bg-purple-50 text-purple-700 font-bold px-2.5 py-1 rounded-full"><?= $totalWarga ?? 0 ?> Terdaftar</span>
                                    </div>
                                    <h4 class="font-bold text-gray-900 text-base mb-1">Manajemen Penduduk</h4>
                                </div>
                                <div class="flex gap-2">
                                    <a href="/admin/warga" class="flex-1 text-center bg-purple-50 hover:bg-purple-100 text-purple-700 font-bold py-2 rounded-[10px] text-xs transition border border-purple-200">Lihat Data</a>
                                    <a href="/admin/warga/create" class="bg-purple-600 hover:bg-purple-700 text-white font-bold px-4 py-2 rounded-[10px] text-xs transition">+ Tambah</a>
                                </div>
                            </div>

                            <!-- Card Pengumuman -->
                            <div class="bg-white p-6 rounded-2xl border border-purple-100 shadow-sm hover:border-emerald-300 transition flex flex-col justify-between">
                                <div>
                                    <div class="flex justify-between items-start mb-3">
                                        <div class="w-10 h-10 bg-emerald-100 text-emerald-700 rounded-xl flex items-center justify-center font-bold">
                                            <svg class="w-5 h-5 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                                            </svg>
                                        </div>
                                        <span class="text-xs bg-emerald-50 text-emerald-700 font-bold px-2.5 py-1 rounded-full"><?= $totalPengumuman ?? 0 ?> Berita</span>
                                    </div>
                                    <h4 class="font-bold text-gray-900 text-base mb-1">Pengumuman Warga</h4>
                                </div>
                                <div class="flex gap-2">
                                    <a href="/admin/pengumuman/create" class="flex-1 text-center bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 rounded-[10px] text-xs transition shadow-sm">+ Buat Pengumuman Baru</a>
                                </div>
                            </div>

                            <!-- Card Notulensi -->
                            <div class="bg-white p-6 rounded-2xl border border-purple-100 shadow-sm hover:border-sky-300 transition flex flex-col justify-between">
                                <div>
                                    <div class="flex justify-between items-start mb-3">
                                        <div class="w-10 h-10 bg-sky-100 text-sky-700 rounded-xl flex items-center justify-center font-bold">
                                            <svg class="w-5 h-5 text-sky-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                            </svg>
                                        </div>
                                        <span class="text-xs bg-sky-50 text-sky-700 font-bold px-2.5 py-1 rounded-full"><?= $totalNotulensi ?? 0 ?> Dokumen</span>
                                    </div>
                                    <h4 class="font-bold text-gray-900 text-base mb-1">Notulensi Rapat</h4>
                                </div>
                                <div class="flex gap-2">
                                    <a href="/notulensi" class="flex-1 text-center bg-gray-50 hover:bg-gray-100 text-gray-700 font-bold py-2 rounded-[10px] text-xs transition border border-gray-200">Arsip</a>
                                    <a href="/admin/notulensi/create" class="bg-sky-600 hover:bg-sky-700 text-white font-bold px-4 py-2 rounded-[10px] text-xs transition">+ Tambah</a>
                                </div>
                            </div>

                            <!-- Card Galeri Dokumentasi (Khusus RW) -->
                            <div class="bg-white p-6 rounded-2xl border border-purple-100 shadow-sm hover:border-indigo-300 transition flex flex-col justify-between">
                                <div>
                                    <div class="flex justify-between items-start mb-3">
                                        <div class="w-10 h-10 bg-indigo-100 text-indigo-700 rounded-xl flex items-center justify-center font-bold">
                                            <svg class="w-5 h-5 text-indigo-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                        <span class="text-xs bg-indigo-50 text-indigo-700 font-bold px-2.5 py-1 rounded-full">
                                            <?= $isRw ? 'Khusus RW' : 'Akses Publik' ?>
                                        </span>
                                    </div>
                                    <h4 class="font-bold text-gray-900 text-base mb-1">Galeri Kegiatan</h4>
                                </div>
                                <div class="flex gap-2">
                                    <a href="/tentang" class="flex-1 text-center bg-gray-50 hover:bg-gray-100 text-gray-700 font-bold py-2 rounded-[10px] text-xs transition border border-gray-200">Lihat Galeri</a>
                                    <?php if ($isRw): ?>
                                        <a href="/admin/galeri/create" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-4 py-2 rounded-[10px] text-xs transition">+ Unggah</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel Warga Terbaru -->
                    <div class="bg-white rounded-2xl border border-purple-100 shadow-sm p-6">
                        <div class="flex justify-between items-center mb-4 border-b border-gray-100 pb-3">
                            <h3 class="font-bold text-gray-900 text-base">Pendaftaran Warga Terbaru</h3>
                            <a href="/admin/warga" class="text-xs font-bold text-purple-700 hover:underline">Lihat Semua Warga &rarr;</a>
                        </div>

                        <?php if (empty($recentWarga)): ?>
                            <p class="text-xs text-gray-500 text-center py-6">Belum ada data warga terdaftar.</p>
                        <?php else: ?>
                            <div class="overflow-x-auto">
                                <table class="w-full text-left text-xs">
                                    <thead>
                                        <tr class="bg-purple-50 text-purple-900 font-bold uppercase tracking-wider">
                                            <th class="p-3 rounded-l-lg">Nama Warga</th>
                                            <th class="p-3">RT</th>
                                            <th class="p-3">Status Verifikasi</th>
                                            <th class="p-3 rounded-r-lg">Tanggal Input</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100">
                                        <?php foreach ($recentWarga as $w): ?>
                                            <tr class="hover:bg-gray-50 transition">
                                                <td class="p-3 font-semibold text-gray-900"><?= htmlspecialchars($w['nama'] ?? 'Tanpa Nama') ?></td>
                                                <td class="p-3 font-bold text-purple-700">RT <?= sprintf('%02d', $w['rt'] ?? 1) ?></td>
                                                <td class="p-3">
                                                    <?php if (($w['status_verifikasi'] ?? '') === 'verified'): ?>
                                                        <span class="bg-emerald-100 text-emerald-800 text-[10px] font-bold px-2 py-0.5 rounded-full">Terverifikasi</span>
                                                    <?php else: ?>
                                                        <span class="bg-amber-100 text-amber-800 text-[10px] font-bold px-2 py-0.5 rounded-full">Pending</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="p-3 text-gray-500"><?= date('d M Y', strtotime($w['created_at'] ?? 'now')) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>

                <!-- KANAN (1-col): ANALITIK SEBARAN RT & AKUN -->
                <div class="space-y-6">

                    <!-- Sebaran Warga per RT -->
                    <div class="bg-white p-6 rounded-2xl border border-purple-100 shadow-sm">
                        <h3 class="font-bold text-gray-900 text-base mb-4">Sebaran Penduduk per RT</h3>
                        <div class="space-y-3">
                            <?php for ($i = 1; $i <= 10; $i++):
                                $count = $wargaPerRt[$i] ?? 0;
                                $max = max(1, max($wargaPerRt ?: [1]));
                                $pct = round(($count / $max) * 100);
                            ?>
                                <div>
                                    <div class="flex justify-between text-xs font-semibold mb-1">
                                        <span class="text-gray-700">RT <?= sprintf('%02d', $i) ?></span>
                                        <span class="text-purple-700 font-bold"><?= $count ?> Jiwa</span>
                                    </div>
                                    <div class="w-full bg-gray-100 rounded-full h-2">
                                        <div class="bg-purple-600 h-2 rounded-full" style="width: <?= $pct ?>%"></div>
                                    </div>
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>

                    <!-- Panel Info Akun -->
                    <div class="bg-purple-50 p-6 rounded-2xl border border-purple-200 text-xs space-y-3">
                        <h4 class="font-bold text-purple-900 text-sm">Informasi Akun Sesi</h4>
                        <div class="flex justify-between border-b border-purple-200 pb-2">
                            <span class="text-gray-600">Nama Pengurus</span>
                            <span class="font-bold text-purple-900"><?= htmlspecialchars($user['name'] ?? 'Pengurus') ?></span>
                        </div>
                        <div class="flex justify-between border-b border-purple-200 pb-2">
                            <span class="text-gray-600">Email</span>
                            <span class="font-bold text-purple-900"><?= htmlspecialchars($user['email'] ?? '-') ?></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Hak Akses</span>
                            <span class="font-bold text-emerald-700 uppercase"><?= htmlspecialchars($user['role'] ?? 'Admin') ?></span>
                        </div>
                    </div>

                </div>

            </div>

        </main>
    </div>
</body>

</html>
