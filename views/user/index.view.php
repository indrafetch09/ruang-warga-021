<!doctype html>
<html lang="id">

<head>
    <title>Ruang Warga 021</title>
    <?php require base_path('views/partials/head.php'); ?>
    <style>
        .logo-container {
            border-radius: 0 0 24px 24px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--color-border-light);
            border-top-width: 0;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- NAVBAR -->
    <?php require base_path('views/partials/navbar.php'); ?>

    <!-- HERO SECTION -->
    <div class="relative bg-white overflow-hidden min-h-[650px] flex items-center">
        <div class="absolute inset-0">
            <img class="w-full h-full object-cover object-right"
                src="https://images.unsplash.com/photo-1596524430615-b46475ddff6e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80"
                alt="Warga" />
            <div class="absolute inset-0 bg-white/75"></div>
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

    <!-- ponytail: Layanan Warga recap section -->
    <!-- LAYANAN WARGA SECTION -->
    <div class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <div>
                <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Layanan </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Card 1: Balai & Fasilitas RW 021 -->
                <div class="bg-white rounded-2xl border border-purple-100 p-6 md:p-8 shadow-sm space-y-4 hover:shadow-md transition">
                    <div class="w-12 h-12 bg-purple-600 text-white rounded-xl flex items-center justify-center shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-extrabold text-gray-900">Balai & Fasilitas Balai Warga</h3>
                        <p class="text-xs text-gray-500 mt-1 leading-relaxed">Profil balai pertemuan, kegiatan Posyandu Bunga Tanjung, bulu tangkis indoor, dan peminjaman balai.</p>
                    </div>
                    <a href="/layanan" class="text-xs font-extrabold text-purple-600 hover:text-purple-800 inline-flex items-center gap-1.5 transition">
                        <span>Selengkapnya</span>
                        <span>&rarr;</span>
                    </a>
                </div>

                <!-- Card 2: Kebersihan & TPST RW 021 -->
                <div class="bg-white rounded-2xl border border-purple-100 p-6 md:p-8 shadow-sm space-y-4 hover:shadow-md transition">
                    <div class="w-12 h-12 bg-purple-600 text-white rounded-xl flex items-center justify-center shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-extrabold text-gray-900">Pengelolaan Sampah & TPST 021</h3>
                        <p class="text-xs text-gray-500 mt-1 leading-relaxed">Jadwal armada pengangkutan sampah lingkungan, pemilahan organik/anorganik, & iuran kebersihan.</p>
                    </div>
                    <a href="/tpst" class="text-xs font-extrabold text-purple-600 hover:text-purple-800 inline-flex items-center gap-1.5 transition">
                        <span>Selengkapnya</span>
                        <span>&rarr;</span>
                    </a>
                </div>

                <!-- Card 3: Pengaduan & Kontak Pengurus -->
                <div class="bg-white rounded-2xl border border-purple-100 p-6 md:p-8 shadow-sm space-y-4 hover:shadow-md transition">
                    <div class="w-12 h-12 bg-purple-600 text-white rounded-xl flex items-center justify-center shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-extrabold text-gray-900">Kontak Resmi & Pengaduan Warga</h3>
                        <p class="text-xs text-gray-500 mt-1 leading-relaxed">Layanan komunikasi WhatsApp pengurus RW 021 & formulir pengiriman aspirasi/pertanyaan warga.</p>
                    </div>
                    <a href="/kontak" class="text-xs font-extrabold text-purple-600 hover:text-purple-800 inline-flex items-center gap-1.5 transition">
                        <span>Selengkapnya</span>
                        <span>&rarr;</span>
                    </a>
                </div>

                <!-- Card 4: Statistik & Demografi Warga -->
                <div class="bg-white rounded-2xl border border-purple-100 p-6 md:p-8 shadow-sm space-y-4 hover:shadow-md transition">
                    <div class="w-12 h-12 bg-purple-600 text-white rounded-xl flex items-center justify-center shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-extrabold text-gray-900">Demografi & Statistik Warga</h3>
                        <p class="text-xs text-gray-500 mt-1 leading-relaxed">Data statistik kependudukan RW 021, jumlah Kepala Keluarga, sebaran usia, & rincian per RT.</p>
                    </div>
                    <a href="/statistik" class="text-xs font-extrabold text-purple-600 hover:text-purple-800 inline-flex items-center gap-1.5 transition">
                        <span>Selengkapnya</span>
                        <span>&rarr;</span>
                    </a>
                </div>

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
                    <a href="/pengumuman" class="text-purple-600 font-semibold hover:text-purple-700 flex items-center gap-1 group">
                        Lihat Papan Informasi
                        <span aria-hidden="true" class="transform group-hover:translate-x-1 transition-transform">&rarr;</span>
                    </a>
                </div>
            </div>

            <?php if (empty($pengumumanList)): ?>
                <!-- EMPTY STATE PENGUMUMAN -->
                <div class="bg-white rounded-2xl p-10 text-center border border-purple-100 shadow-sm">
                    <p class="text-gray-500 text-sm">Belum ada pengumuman terbaru untuk warga.</p>
                </div>
            <?php else: ?>
                <div class="space-y-4">
                    <?php foreach ($pengumumanList as $pengumuman): ?>
                        <?php
                        $kat = strtolower($pengumuman->kategori ?? 'umum');
                        $tgl = !empty($pengumuman->tanggal_publikasi) ? strtotime($pengumuman->tanggal_publikasi) : time();
                        $isToday = (date('Y-m-d', $tgl) === date('Y-m-d'));

                        // Retain theme colors with matching soft background tones
                        $badgeBg = 'bg-purple-100 text-purple-800';
                        $btnStyle = 'border border-gray-200 text-gray-700 hover:border-purple-300 hover:text-purple-700 hover:bg-purple-50';

                        if (in_array($kat, ['mendesak', 'darurat', 'penting'])) {
                            $badgeBg = 'bg-rose-100 text-rose-800';
                            $btnStyle = 'bg-rose-600 text-white hover:bg-rose-700 shadow-sm';
                        } elseif (in_array($kat, ['kegiatan', 'sosial', 'agenda'])) {
                            $badgeBg = 'bg-emerald-100 text-emerald-800';
                            $btnStyle = 'border border-emerald-200 text-emerald-700 hover:bg-emerald-50';
                        }
                        ?>
                        <div class="bg-white rounded-2xl p-4 sm:p-5 border border-purple-100/70 shadow-sm hover:shadow-md transition duration-200 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 group">

                            <!-- KIRI: KOTAK TANGGAL / INFO (Matching Image UI) -->
                            <div class="flex-shrink-0 w-28 h-20 sm:w-32 sm:h-20 <?= $badgeBg ?> rounded-2xl flex flex-col items-center justify-center text-center p-2">
                                <span class="text-[11px] font-bold uppercase tracking-wider">
                                    <?= $isToday ? 'HARI INI' : date('d M', $tgl) ?>
                                </span>
                                <span class="text-xl sm:text-2xl font-extrabold tracking-tight mt-0.5">
                                    <?= date('Y', $tgl) ?>
                                </span>
                            </div>

                            <!-- TENGAH: JUDUL & DESKRIPSI -->
                            <div class="flex-1 min-w-0 pr-0 sm:pr-4 space-y-1">
                                <div class="flex flex-wrap items-center gap-2">
                                    <h3 class="text-base sm:text-lg font-bold text-gray-900 group-hover:text-purple-700 transition">
                                        <?= htmlspecialchars($pengumuman->judul ?? '-') ?>
                                    </h3>
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-extrabold uppercase tracking-wider <?= $badgeBg ?>">
                                        <?= htmlspecialchars(ucfirst($kat)) ?>
                                    </span>
                                </div>
                                <p class="text-xs sm:text-sm text-gray-500 leading-relaxed line-clamp-2">
                                    <?= htmlspecialchars($pengumuman->pesan ?? '') ?>
                                </p>
                            </div>

                            <!-- KANAN: CALL TO ACTION BUTTON (Matching Image UI "+ Add to calendar" look) -->
                            <div class="flex-shrink-0 w-full sm:w-auto pt-2 sm:pt-0 border-t sm:border-t-0 border-gray-100 flex justify-end">
                                <?php if (!empty($pengumuman->tautan_url)): ?>
                                    <a href="<?= htmlspecialchars($pengumuman->tautan_url) ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl text-xs font-bold transition <?= $btnStyle ?>">
                                        <span>+ <?= htmlspecialchars($pengumuman->label_tombol ?? 'Buka Tautan') ?></span>
                                    </a>
                                <?php else: ?>
                                    <a href="/pengumuman" class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl text-xs font-bold transition <?= $btnStyle ?>">
                                        <span>+ Detail Info</span>
                                    </a>
                                <?php endif; ?>
                            </div>

                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <!-- Tombol Lihat Semua Pengumuman (Mobile) -->
            <div class="mt-8 text-center md:hidden">
                <a href="/pengumuman" class="inline-flex items-center justify-center px-6 py-3 border border-purple-200 text-purple-700 font-bold text-sm rounded-xl hover:bg-purple-50 transition duration-150 w-full bg-white shadow-sm">
                    Lihat Papan Informasi &rarr;
                </a>
            </div>
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