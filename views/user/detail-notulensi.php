<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= htmlspecialchars($notulensi->judul ?? $notulensi['judul'] ?? 'Detail Notulensi') ?> - Ruang Warga 021</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="/css/theme.css" />
    <style>
        body { font-family: "Plus Jakarta Sans", sans-serif; }
    </style>
</head>

<body class="bg-gray-50 flex flex-col min-h-screen">
    <!-- NAVBAR -->
    <?php require base_path('views/partials/navbar.php'); ?>

    <?php
    // Helper extract data (Aman dari Array vs Object error)
    $isArr = is_array($notulensi);

    $nJudul     = $isArr ? ($notulensi['judul'] ?? 'Notulensi Rapat') : ($notulensi->judul ?? 'Notulensi Rapat');
    $nKategori  = $isArr ? ($notulensi['kategori'] ?? 'rutin') : ($notulensi->kategori ?? 'rutin');
    $nNoSurat   = $isArr ? ($notulensi['no_surat'] ?? '-') : ($notulensi->no_surat ?? '-');
    $nTanggal   = $isArr ? ($notulensi['tanggal'] ?? date('Y-m-d')) : ($notulensi->tanggal ?? date('Y-m-d'));
    $nWMulai    = $isArr ? ($notulensi['waktu_mulai'] ?? '-') : ($notulensi->waktu_mulai ?? '-');
    $nWSelesai  = $isArr ? ($notulensi['waktu_selesai'] ?? '') : ($notulensi->waktu_selesai ?? '');
    $nLokasi    = $isArr ? ($notulensi['lokasi'] ?? '-') : ($notulensi->lokasi ?? '-');
    $nNotulis   = $isArr ? ($notulensi['notulis'] ?? '-') : ($notulensi->notulis ?? '-');
    $nAgenda    = $isArr ? ($notulensi['agenda'] ?? '-') : ($notulensi->agenda ?? '-');
    $nHasil     = $isArr ? ($notulensi['hasil_pembahasan'] ?? '-') : ($notulensi->hasil_pembahasan ?? '-');
    $nKeputusan = $isArr ? ($notulensi['keputusan_akhir'] ?? '-') : ($notulensi->keputusan_akhir ?? '-');
    $nFile      = $isArr ? ($notulensi['file_lampiran'] ?? null) : ($notulensi->file_lampiran ?? null);

    // Helper Format Hari Indonesia
    $daftarHari = [
        'Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu'
    ];
    $namaHari = $daftarHari[date('l', strtotime($nTanggal))] ?? '';
    $tglFormatIndo = $namaHari . ', ' . date('d F Y', strtotime($nTanggal));
    ?>

    <!-- MAIN CONTENT -->
    <main class="py-10 bg-gray-50 flex-1">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- BREADCRUMB / TOMBOL KEMBALI -->
            <div>
                <a href="/notulensi" class="inline-flex items-center gap-2 text-sm font-semibold text-gray-500 hover:text-purple-600 transition group">
                    <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Arsip Notulensi
                </a>
            </div>

            <!-- CONTAINER DOKUMEN NOTULENSI FORMAL -->
            <article class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden">
                
                <!-- HEADER NOTULENSI -->
                <div class="p-6 md:p-8 bg-purple-50/60 border-b border-purple-100">
                    <div class="flex flex-wrap items-center justify-between gap-3 mb-3">
                        <div>
                            <?php if ($nKategori === 'rutin'): ?>
                                <span class="bg-emerald-100 text-emerald-800 text-[11px] font-extrabold px-3 py-1 rounded-full uppercase tracking-wider">Rapat Rutin</span>
                            <?php elseif ($nKategori === 'khusus'): ?>
                                <span class="bg-purple-100 text-purple-800 text-[11px] font-extrabold px-3 py-1 rounded-full uppercase tracking-wider">Rapat Khusus</span>
                            <?php else: ?>
                                <span class="bg-sky-100 text-sky-800 text-[11px] font-extrabold px-3 py-1 rounded-full uppercase tracking-wider">Laporan Kas</span>
                            <?php endif; ?>
                        </div>

                        <span class="text-xs text-gray-500 font-medium">No. Dokumen: <strong class="text-gray-800 font-mono"><?= htmlspecialchars($nNoSurat) ?></strong></span>
                    </div>

                    <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900 leading-tight mb-4">
                        <?= htmlspecialchars($nJudul) ?>
                    </h1>

                    <!-- METADATA GRID -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-4 border-t border-purple-100 text-xs">
                        <div>
                            <span class="block text-gray-400 font-medium uppercase text-[10px]">Hari & Tanggal</span>
                            <strong class="text-gray-800 font-bold"><?= $tglFormatIndo ?></strong>
                        </div>
                        <div>
                            <span class="block text-gray-400 font-medium uppercase text-[10px]">Waktu Pelaksanaan</span>
                            <strong class="text-gray-800 font-bold"><?= htmlspecialchars($nWMulai) ?> <?= !empty($nWSelesai) ? '- ' . htmlspecialchars($nWSelesai) : '' ?></strong>
                        </div>
                        <div>
                            <span class="block text-gray-400 font-medium uppercase text-[10px]">Tempat / Lokasi</span>
                            <strong class="text-gray-800 font-bold"><?= htmlspecialchars($nLokasi) ?></strong>
                        </div>
                        <div>
                            <span class="block text-gray-400 font-medium uppercase text-[10px]">Notulis / Pencatat</span>
                            <strong class="text-purple-700 font-bold"><?= htmlspecialchars($nNotulis) ?></strong>
                        </div>
                    </div>
                </div>

                <!-- ISI NOTULENSI -->
                <div class="p-6 md:p-8 space-y-8">
                    
                    <!-- PARAGRAF PEMBUKA OTOMATIS (BERITA ACARA) -->
                    <div class="bg-purple-50/50 border-l-4 border-purple-600 p-4 rounded-r-2xl text-gray-700 text-sm leading-relaxed italic">
                        <strong>Berita Acara:</strong> Pada hari <span class="font-bold text-gray-900"><?= $tglFormatIndo ?></span>, bertempat di <span class="font-bold text-gray-900"><?= htmlspecialchars($nLokasi) ?></span>, telah diselenggarakan <span class="font-bold text-gray-900"><?= htmlspecialchars($nJudul) ?></span> yang dihadiri oleh pengurus RW 021, jajaran RT, serta perwakilan warga setempat. Berikut adalah rincian agenda dan hasil kesepakatan musyawarah:
                    </div>

                    <!-- SECTION 1: AGENDA RAPAT -->
                    <div>
                        <h3 class="text-xs font-extrabold text-purple-700 uppercase tracking-widest mb-3 flex items-center gap-2">
                            <span class="w-2 h-2 bg-purple-600 rounded-full"></span>
                            Agenda Utama Rapat
                        </h3>
                        <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100 text-gray-800 text-sm font-medium whitespace-pre-line leading-relaxed">
                            <?= htmlspecialchars($nAgenda) ?>
                        </div>
                    </div>

                    <!-- SECTION 2: HASIL PEMBAHASAN -->
                    <div>
                        <h3 class="text-xs font-extrabold text-purple-700 uppercase tracking-widest mb-3 flex items-center gap-2">
                            <span class="w-2 h-2 bg-purple-600 rounded-full"></span>
                            Jalannya Rapat & Hasil Pembahasan
                        </h3>
                        <div class="text-gray-700 text-sm leading-relaxed whitespace-pre-line space-y-2">
                            <?= htmlspecialchars($nHasil) ?>
                        </div>
                    </div>

                    <!-- SECTION 3: KEPUTUSAN AKHIR (HIGHLIGHTED) -->
                    <div class="bg-emerald-50/80 border border-emerald-200 rounded-2xl p-5 md:p-6 shadow-sm">
                        <h3 class="text-xs font-extrabold text-emerald-800 uppercase tracking-widest mb-2 flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Keputusan Akhir Musyawarah
                        </h3>
                        <div class="text-emerald-950 font-semibold text-sm leading-relaxed whitespace-pre-line">
                            <?= htmlspecialchars($nKeputusan) ?>
                        </div>
                    </div>

                    <!-- SECTION 4: LAMPIRAN DOKUMEN -->
                    <?php if (!empty($nFile)): ?>
                        <div class="pt-4 border-t border-gray-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            <div>
                                <h4 class="text-sm font-bold text-gray-900">Dokumen Lampiran Resmi</h4>
                                <p class="text-xs text-gray-500 mt-0.5">Unduh berkas fisik/PDF hasil ttd notulensi rapat ini.</p>
                            </div>
                            <a href="/uploads/notulensi/<?= htmlspecialchars($nFile) ?>" download class="px-5 py-2.5 bg-purple-600 hover:bg-purple-700 text-white font-bold text-xs rounded-xl shadow-md transition flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                                Unduh Lampiran Berkas
                            </a>
                        </div>
                    <?php endif; ?>

                    <!-- SECTION 5: BLOK PENGESAHAN / TANDA TANGAN (LEGALITAS) -->
                    <div class="pt-8 border-t border-gray-200 mt-8">
                        <p class="text-xs text-center text-gray-400 mb-6 italic">Demikian notulensi hasil musyawarah ini dibuat untuk dipergunakan sebagaimana mestinya.</p>
                        
                        <div class="grid grid-cols-2 gap-8 text-center text-xs">
                            <div>
                                <p class="text-gray-500 mb-12">Notulis / Pencatatan</p>
                                <p class="font-bold text-gray-900 underline uppercase"><?= htmlspecialchars($nNotulis) ?></p>
                                <p class="text-[10px] text-gray-400">Pengurus RW 021</p>
                            </div>
                            <div>
                                <p class="text-gray-500 mb-12">Mengetahui,<br>Ketua RW 021</p>
                                <p class="font-bold text-gray-900 underline uppercase">Ketua RW 021</p>
                                <p class="text-[10px] text-gray-400">Ruang Warga 021</p>
                            </div>
                        </div>
                    </div>

                </div>
            </article>

        </div>
    </main>

    <!-- FOOTER -->
    <?php require base_path('views/partials/footer.php'); ?>
</body>

</html>
