<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ruang Warga 021</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="/css/theme.css" />
    <style>
        .logo-container {
            border-radius: 0 0 24px 24px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--color-border-light);
            border-top-width: 0;
        }

        .hero-gradient {
            background: linear-gradient(90deg,
                    rgba(255, 255, 255, 1) 0%,
                    rgba(255, 255, 255, 1) 45%,
                    rgba(255, 255, 255, 0) 100%);
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- NAVBAR -->
    <?php require base_path('views/partials/navbar.php'); ?>

    <!-- HERO SECTION -->
    <div class="relative bg-white overflow-hidden min-h-[600px] flex items-center">
        <div class="absolute inset-0">
            <img class="w-full h-full object-cover object-right"
                src="https://images.unsplash.com/photo-1596524430615-b46475ddff6e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80"
                alt="Warga" />
            <div class="absolute inset-0 hero-gradient"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center w-full">
            <div class="max-w-2xl pt-10 pb-20 z-10">
                <h1 class="text-5xl md:text-6xl font-extrabold text-black leading-tight tracking-tight mb-2">
                    Layanan Responsif.
                </h1>
                <h1 class="text-5xl md:text-6xl font-extrabold text-purple-600 mb-6">
                    Warga Sejahtera.
                </h1>
                <p class="mt-4 text-lg text-gray-600 mb-8 max-w-lg leading-relaxed">
                    Portal resmi RW 021. Kombinasi pelayanan digital yang serba cepat
                    dengan semangat menjaga lingkungan yang asri dan guyub antarwarga.
                </p>
                <div class="mt-8 flex gap-4 items-center">
                    <a href="/tentang-kami" class="inline-flex items-center justify-center gap-2 px-9 py-4 bg-purple-600 text-white font-medium rounded-[10px] hover:bg-purple-700 transition duration-150 shadow-md">
                        Lihat Profil RW
                        <span class="gap-2"> &rarr; </span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- STATISTIK SECTION (DINAMIS) -->
    <div class="bg-gray-50 py-12 border-b border-gray-200 relative z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8">
                <!-- Card 1: KK -->
                <div class="bg-white rounded-2xl shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] border border-purple-50 p-6 flex flex-col items-center text-center transform hover:-translate-y-1 transition-transform duration-300">
                    <div class="w-12 h-12 bg-emerald-50 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <span class="text-3xl md:text-4xl font-extrabold text-purple-700"><?= number_format($stats['total_kk'] ?? 0) ?></span>
                    <span class="mt-2 text-sm text-gray-500 font-medium">Kepala Keluarga</span>
                </div>
                <!-- Card 2: Total Warga -->
                <div class="bg-white rounded-2xl shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] border border-purple-50 p-6 flex flex-col items-center text-center transform hover:-translate-y-1 transition-transform duration-300">
                    <div class="w-12 h-12 bg-emerald-50 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <span class="text-3xl md:text-4xl font-extrabold text-purple-700"><?= number_format($stats['total_warga'] ?? 0) ?></span>
                    <span class="mt-2 text-sm text-gray-500 font-medium">Total Warga</span>
                </div>
                <!-- Card 3: Fasilitas -->
                <div class="bg-white rounded-2xl shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] border border-purple-50 p-6 flex flex-col items-center text-center transform hover:-translate-y-1 transition-transform duration-300">
                    <div class="w-12 h-12 bg-emerald-50 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <span class="text-3xl md:text-4xl font-extrabold text-purple-700"><?= number_format($stats['total_fasilitas'] ?? 0) ?></span>
                    <span class="mt-2 text-sm text-gray-500 font-medium">Fasilitas Umum</span>
                </div>
                <!-- Card 4: UMKM -->
                <div class="bg-white rounded-2xl shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] border border-purple-50 p-6 flex flex-col items-center text-center transform hover:-translate-y-1 transition-transform duration-300">
                    <div class="w-12 h-12 bg-emerald-50 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <span class="text-3xl md:text-4xl font-extrabold text-purple-700"><?= number_format($stats['total_umkm'] ?? 0) ?></span>
                    <span class="mt-2 text-sm text-gray-500 font-medium">UMKM Aktif</span>
                </div>
            </div>
        </div>
    </div>

    <!-- PENGUMUMAN WARGA SECTION -->
    <div class="py-16 bg-purple-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-8 gap-4">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <span class="flex h-3 w-3 relative">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-rose-500"></span>
                        </span>
                        <h2 class="text-3xl font-extrabold text-black tracking-tight">
                            Pengumuman <span class="text-purple-600">Penting</span>
                        </h2>
                    </div>
                    <p class="text-lg text-gray-500">Informasi terbaru seputar lingkungan RW 021.</p>
                </div>
                <div class="hidden md:block">
                    <a href="/informasi" class="text-purple-600 font-semibold hover:text-purple-700 flex items-center gap-1 group">
                        Lihat Papan Informasi
                        <span aria-hidden="true" class="transform group-hover:translate-x-1 transition-transform">&rarr;</span>
                    </a>
                </div>
            </div>

            <?php if (empty($pengumumanList)): ?>
                <!-- EMPTY STATE PENGUMUMAN -->
                <div class="bg-white rounded-xl p-10 text-center border border-purple-100 shadow-sm">
                    <p class="text-gray-500 text-sm">Belum ada pengumuman terbaru untuk warga.</p>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <?php foreach ($pengumumanList as $pengumuman): ?>
                        <?php
                        $kategori = $pengumuman->kategori ?? 'Umum';
                        $borderColor = 'border-purple-100';
                        $bgColor = 'bg-purple-500';
                        $textColor = 'text-purple-600';

                        if ($kategori === 'Mendesak' || $kategori === 'Penting') {
                            $borderColor = 'border-rose-100';
                            $bgColor = 'bg-rose-500';
                            $textColor = 'text-rose-600';
                        } elseif ($kategori === 'Kegiatan' || $kategori === 'Sosial') {
                            $borderColor = 'border-emerald-100';
                            $bgColor = 'bg-emerald-500';
                            $textColor = 'text-emerald-600';
                        }
                        ?>
                        <div class="bg-white rounded-xl p-6 border <?= $borderColor ?> shadow-sm relative overflow-hidden group hover:shadow-md transition">
                            <div class="absolute top-0 left-0 w-1 h-full <?= $bgColor ?>"></div>
                            <div class="flex justify-between items-start mb-4">
                                <span class="text-xs text-gray-400 font-medium">
                                    <?= !empty($pengumuman->tanggal_publikasi) ? date('d M Y', strtotime($pengumuman->tanggal_publikasi)) : 'Baru saja' ?>
                                </span>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2"><?= htmlspecialchars($pengumuman->judul ?? '-') ?></h3>
                            <p class="text-gray-600 text-sm leading-relaxed mb-4 line-clamp-3">
                                <?= htmlspecialchars($pengumuman->pesan ?? '') ?>
                            </p>
                            <?php if (!empty($pengumuman->tautan_url)): ?>
                                <a href="<?= htmlspecialchars($pengumuman->tautan_url) ?>" class="<?= $textColor ?> text-sm font-semibold hover:underline">
                                    <?= htmlspecialchars($pengumuman->label_tombol ?? 'Baca selengkapnya') ?> &rarr;
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- NOTULEN RAPAT SECTION -->
    <div class="py-20 bg-white border-b border-gray-100">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-10 gap-4">
                <div>
                    <h2 class="text-3xl font-extrabold text-black tracking-tight sm:text-4xl">
                        Notulen Rapat <span class="text-emerald-600">Terbaru</span>
                    </h2>
                    <p class="mt-4 text-lg text-gray-500">
                        Transparansi informasi dan hasil keputusan rapat pengurus beserta warga RW 021.
                    </p>
                </div>
                <div class="hidden md:block">
                    <a href="/notulensi" class="text-purple-600 font-semibold hover:text-purple-700 flex items-center gap-1 group">
                        Lihat Semua Arsip
                        <span aria-hidden="true" class="transform group-hover:translate-x-1 transition-transform">&rarr;</span>
                    </a>
                </div>
            </div>

            <!-- List Container -->
            <?php if (empty($notulensiList)): ?>
                <!-- EMPTY STATE NOTULENSI -->
                <div class="bg-gray-50 rounded-xl p-10 text-center border border-gray-200">
                    <p class="text-gray-500 text-sm">Belum ada notulensi rapat yang dipublikasikan.</p>
                </div>
            <?php else: ?>
                <div class="flex flex-col space-y-6">
                    <?php foreach ($notulensiList as $notulen): ?>
                        <?php
                        $tglTime = !empty($notulen->tanggal) ? strtotime($notulen->tanggal) : time();
                        $tglDay = date('d', $tglTime);
                        $tglMonth = date('M', $tglTime);
                        $tglYear = date('Y', $tglTime);
                        ?>
                        <div class="flex flex-col sm:flex-row gap-6 bg-white p-4 rounded-xl border-l-4 border-emerald-500 hover:shadow-lg transition-shadow duration-300">
                            <div class="flex-shrink-0 w-24 flex flex-col rounded-md overflow-hidden shadow-sm border border-purple-100">
                                <div class="bg-purple-100 py-2 flex flex-col items-center justify-center relative">
                                    <div class="absolute top-2 left-2 w-2 h-2 bg-purple-800 rounded-full"></div>
                                    <div class="absolute top-2 right-2 w-2 h-2 bg-purple-800 rounded-full"></div>
                                    <span class="text-2xl font-bold text-purple-800 mt-2"><?= $tglDay ?></span>
                                    <span class="text-sm font-semibold text-purple-800 uppercase"><?= $tglMonth ?></span>
                                </div>
                                <div class="bg-purple-800 py-1.5 flex justify-center items-center">
                                    <span class="text-xs font-bold text-white tracking-widest"><?= $tglYear ?></span>
                                </div>
                            </div>
                            <div class="flex-1">
                                <a href="/notulensi/show?id=<?= $notulen->id ?>" class="text-xl font-bold text-purple-700 hover:text-purple-600 transition-colors mb-2 block">
                                    <?= htmlspecialchars($notulen->judul ?? '-') ?>
                                </a>
                                <p class="text-gray-600 text-sm leading-relaxed mb-2 line-clamp-3">
                                    <?= htmlspecialchars($notulen->hasil_pembahasan ?? $notulen->agenda ?? '-') ?>
                                </p>
                                <span class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-2 py-1 rounded">
                                    <?= htmlspecialchars($notulen->kategori ?? 'Rapat Rutin') ?>
                                </span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <!-- Tombol Lihat Semua (Mobile) -->
            <div class="mt-8 text-center md:hidden">
                <a href="/notulensi" class="inline-flex items-center justify-center px-6 py-3 border border-purple-200 text-purple-700 font-medium rounded-full hover:bg-purple-50 transition duration-150 w-full">Lihat Semua Arsip &rarr;</a>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <?php require base_path('views/partials/footer.php'); ?>
</body>

</html>
