<!doctype html>
<html lang="id">

<head>
    <title>Papan Informasi & Pengumuman - Ruang Warga 021</title>
    <?php require base_path('views/partials/head.php'); ?>
</head>

<body class="bg-gray-50 flex flex-col min-h-screen">
    <!-- NAVBAR -->
    <?php require base_path('views/partials/navbar.php'); ?>

    <!-- HERO / HEADER BANNER -->
    <div class="bg-purple-900 text-white py-12 md:py-16 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-3xl">
                <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight text-white mb-4">
                    Pengumuman & Informasi Warga
                </h1>
                <p class="text-base md:text-lg text-purple-200 leading-relaxed">
                    Pemberitahuan resmi pengurus, agenda kegiatan lingkungan, edaran penting, serta pengumuman layanan bagi seluruh warga RW 021.
                </p>
            </div>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <main class="py-10 flex-1">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <!-- FILTER & SEARCH BAR -->
            <div class="bg-white rounded-lg shadow-sm border border-purple-100 p-5 md:p-6">
                <form action="/pengumuman" method="GET" class="flex flex-col md:flex-row gap-4 items-center justify-between">

                    <!-- Search Input -->
                    <div class="w-full md:w-1/2 relative">
                        <svg class="w-5 h-5 text-gray-400 absolute left-3.5 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input type="text" name="q" value="<?= htmlspecialchars($search ?? '') ?>" placeholder="Cari judul atau isi pengumuman..."
                            class="w-full pl-11 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:bg-white transition text-sm text-gray-800 placeholder-gray-400" />
                    </div>

                    <!-- Category Pills / Select -->
                    <div class="w-full md:w-auto flex flex-wrap items-center gap-2">
                        <?php
                        $selectedCat = strtolower($kategori ?? '');
                        $categories = [
                            ''         => 'Semua',
                            'mendesak' => 'Mendesak',
                            'penting'  => 'Penting',
                            'kegiatan' => 'Kegiatan',
                            'sosial'   => 'Sosial',
                            'umum'     => 'Umum'
                        ];
                        ?>
                        <?php foreach ($categories as $catKey => $catLabel): ?>
                            <?php $isActive = ($selectedCat === $catKey); ?>
                            <a href="/pengumuman<?= !empty($catKey) ? '?kategori=' . urlencode($catKey) : '' ?><?= !empty($search) ? (!empty($catKey) ? '&' : '?') . 'q=' . urlencode($search) : '' ?>"
                                class="px-4 py-2 rounded-lg text-xs font-bold transition <?= $isActive ? 'bg-purple-600 text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-purple-50 hover:text-purple-700' ?>">
                                <?= $catLabel ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </form>
            </div>

            <!-- GRID DAFTAR PENGUMUMAN -->
            <?php if (empty($pengumumanList)): ?>
                <!-- Empty State -->
                <div class="bg-white rounded-lg p-12 text-center border border-purple-100 shadow-sm space-y-4">
                    <div class="w-16 h-16 bg-purple-50 text-purple-600 rounded-full flex items-center justify-center mx-auto">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-gray-900">Belum Ada Pengumuman</h2>
                    <p class="text-sm text-gray-500 max-w-md mx-auto">
                        Tidak ditemukan pengumuman sesuai filter atau kata kunci pencarian yang Anda masukkan.
                    </p>
                    <?php if (!empty($search) || !empty($kategori)): ?>
                        <a href="/pengumuman" class="inline-flex items-center gap-2 px-5 py-2.5 bg-purple-600 text-white rounded-lg text-xs font-bold hover:bg-purple-700 transition shadow-sm">
                            Reset Filter & Tampilkan Semua
                        </a>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($pengumumanList as $p): ?>
                        <?php
                        $kat = strtolower(is_object($p) ? ($p->kategori ?? 'umum') : ($p['kategori'] ?? 'umum'));
                        $judul = is_object($p) ? ($p->judul ?? '-') : ($p['judul'] ?? '-');
                        $pesan = is_object($p) ? ($p->pesan ?? '') : ($p['pesan'] ?? '');
                        $tgl = is_object($p) ? ($p->tanggal_publikasi ?? null) : ($p['tanggal_publikasi'] ?? null);
                        $labelTombol = is_object($p) ? ($p->label_tombol ?? '') : ($p['label_tombol'] ?? '');
                        $tautanUrl = is_object($p) ? ($p->tautan_url ?? '') : ($p['tautan_url'] ?? '');

                        // Styling badges based on category
                        $badgeBg = 'bg-purple-100 text-purple-800 border-purple-200';
                        $accentColor = 'bg-purple-600';

                        if (in_array($kat, ['mendesak', 'darurat', 'penting'])) {
                            $badgeBg = 'bg-rose-100 text-rose-800 border-rose-200';
                            $accentColor = 'bg-rose-600';
                        } elseif (in_array($kat, ['kegiatan', 'sosial', 'agenda'])) {
                            $badgeBg = 'bg-emerald-100 text-emerald-800 border-emerald-200';
                            $accentColor = 'bg-emerald-600';
                        } elseif (in_array($kat, ['layanan', 'fasilitas'])) {
                            $badgeBg = 'bg-blue-100 text-blue-800 border-blue-200';
                            $accentColor = 'bg-blue-600';
                        }
                        ?>
                        <div class="bg-white rounded-lg border border-purple-100 shadow-sm hover:shadow-md transition flex flex-col justify-between overflow-hidden relative group">
                            <div class="h-1.5 w-full <?= $accentColor ?>"></div>
                            <div class="p-6 space-y-4 flex-1">
                                <!-- Badge & Tanggal -->
                                <div class="flex items-center justify-between gap-2">
                                    <span class="px-3 py-1 rounded-lg text-[11px] font-extrabold uppercase tracking-wider border <?= $badgeBg ?>">
                                        <?= htmlspecialchars(ucfirst($kat)) ?>
                                    </span>
                                    <span class="text-xs font-semibold text-gray-400 flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <?= !empty($tgl) ? date('d M Y', strtotime($tgl)) : 'Baru saja' ?>
                                    </span>
                                </div>

                                <!-- Judul -->
                                <h3 class="text-lg font-extrabold text-gray-900 leading-snug group-hover:text-purple-700 transition">
                                    <?= htmlspecialchars($judul) ?>
                                </h3>

                                <!-- Pesan -->
                                <p class="text-sm text-gray-600 leading-relaxed whitespace-pre-line">
                                    <?= htmlspecialchars($pesan) ?>
                                </p>
                            </div>

                            <!-- Footer Card / Action Link -->
                            <?php if (!empty($tautanUrl)): ?>
                                <div class="px-6 py-4 bg-purple-50/50 border-t border-purple-50 flex items-center justify-between">
                                    <a href="<?= htmlspecialchars($tautanUrl) ?>" target="_blank" rel="noopener noreferrer" class="text-xs font-bold text-purple-700 hover:text-purple-900 inline-flex items-center gap-1.5 transition">
                                        <span><?= htmlspecialchars(!empty($labelTombol) ? $labelTombol : 'Informasi Lengkap') ?></span>
                                        <span>&rarr;</span>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </div>
    </main>

    <!-- FOOTER -->
    <?php require base_path('views/partials/footer.php'); ?>
</body>

</html>