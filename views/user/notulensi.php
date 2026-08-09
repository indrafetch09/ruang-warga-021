<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Arsip Notulen Rapat - Ruang Warga 021</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="/css/theme.css" />
</head>

<body class="bg-gray-50 flex flex-col min-h-screen">
    <!-- NAVBAR -->
    <?php require base_path('views/partials/navbar.php'); ?>

    <!-- PAGE HEADER -->
    <div class="bg-purple-50 py-16 border-b border-purple-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 tracking-tight mb-4">
                Arsip <span class="text-purple-600">Notulen Rapat</span>
            </h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Transparansi informasi dan dokumentasi hasil keputusan seluruh forum
                warga dan pengurus RW 021.
            </p>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="py-12 bg-white flex-1">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Filter & Search Bar (Method GET) -->
            <form action="/notulensi" method="GET" class="bg-white border border-gray-200 p-4 rounded-xl shadow-sm mb-10 flex flex-col md:flex-row gap-4 items-center justify-between">
                <div class="w-full md:w-1/2 relative">
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input type="text" name="q" value="<?= htmlspecialchars($_GET['q'] ?? '') ?>" placeholder="Cari judul atau kata kunci rapat..."
                        class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition text-sm" />
                </div>
                
                <div class="w-full md:w-auto flex gap-3">
                    <select name="kategori" onchange="this.form.submit()"
                        class="w-full md:w-auto px-4 py-2.5 border border-gray-300 rounded-lg text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 bg-white cursor-pointer">
                        <option value="">Semua Kategori</option>
                        <option value="rutin" <?= ($_GET['kategori'] ?? '') === 'rutin' ? 'selected' : '' ?>>Rapat Rutin</option>
                        <option value="khusus" <?= ($_GET['kategori'] ?? '') === 'khusus' ? 'selected' : '' ?>>Rapat Khusus</option>
                        <option value="laporan" <?= ($_GET['kategori'] ?? '') === 'laporan' ? 'selected' : '' ?>>Laporan Kas</option>
                    </select>

                    <select name="tahun" onchange="this.form.submit()"
                        class="w-full md:w-auto px-4 py-2.5 border border-gray-300 rounded-lg text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 bg-white cursor-pointer">
                        <option value="2026" <?= ($_GET['tahun'] ?? '2026') === '2026' ? 'selected' : '' ?>>2026</option>
                        <option value="2025" <?= ($_GET['tahun'] ?? '') === '2025' ? 'selected' : '' ?>>2025</option>
                    </select>
                </div>
            </form>

            <!-- List of Notulensi (Dynamic / Fallback) -->
            <?php 
                $listNotulensi = $notulensi ?? [
                    [
                        'id' => 1,
                        'tgl_day' => '12',
                        'tgl_month' => 'Agt',
                        'tgl_year' => '2026',
                        'kategori' => 'Rapat Rutin',
                        'kategori_type' => 'emerald',
                        'waktu' => '20:00 WIB',
                        'judul' => 'Rapat Persiapan HUT RI ke-81',
                        'ringkasan' => 'Membahas pembentukan panitia lomba 17 Agustus tingkat RW, rincian anggaran kegiatan, dan penetapan rute jalan sehat warga. Disepakati bahwa iuran partisipasi per KK adalah sebesar Rp50.000...'
                    ],
                    [
                        'id' => 2,
                        'tgl_day' => '28',
                        'tgl_month' => 'Jul',
                        'tgl_year' => '2026',
                        'kategori' => 'Rapat Khusus',
                        'kategori_type' => 'purple',
                        'waktu' => '19:30 WIB',
                        'judul' => 'Evaluasi Keamanan Lingkungan',
                        'ringkasan' => 'Tindak lanjut dari laporan warga terkait aturan jam malam untuk tamu. Forum menyetujui penambahan 3 titik CCTV baru di area gang buntu dan portal utama akan mulai ditutup penuh pada pukul 23.00 WIB.'
                    ],
                    [
                        'id' => 3,
                        'tgl_day' => '05',
                        'tgl_month' => 'Jul',
                        'tgl_year' => '2026',
                        'kategori' => 'Laporan Kas',
                        'kategori_type' => 'emerald',
                        'waktu' => '10:00 WIB',
                        'judul' => 'Laporan Transparansi Iuran Kas Semester I',
                        'ringkasan' => 'Pemaparan rincian pemasukan dan pengeluaran kas RW untuk periode Januari hingga Juni 2026. Saldo akhir yang dilaporkan telah disetujui tanpa ada sanggahan dari perwakilan tiap RT.'
                    ],
                    [
                        'id' => 4,
                        'tgl_day' => '15',
                        'tgl_month' => 'Jun',
                        'tgl_year' => '2026',
                        'kategori' => 'Rapat Khusus',
                        'kategori_type' => 'amber',
                        'waktu' => '20:00 WIB',
                        'judul' => 'Sosialisasi Pembuatan Sistem Portal Warga',
                        'ringkasan' => 'Diskusi awal mengenai perancangan dan kebutuhan sistem portal digital warga. Pengurus RT dan RW menyetujui anggaran awal dan fitur-fitur mandiri yang akan dikembangkan oleh tim IT warga.'
                    ],
                    [
                        'id' => 5,
                        'tgl_day' => '02',
                        'tgl_month' => 'Jun',
                        'tgl_year' => '2026',
                        'kategori' => 'Rapat Rutin',
                        'kategori_type' => 'emerald',
                        'waktu' => '19:30 WIB',
                        'judul' => 'Pembentukan Satgas Bank Sampah',
                        'ringkasan' => 'Pemilihan ketua satgas dan pemaparan sistem bagi hasil untuk warga yang mengumpulkan sampah botol plastik dan kardus bekas. Disepakati lokasi penimbangan berada di sebelah Balai RW.'
                    ]
                ];
            ?>

            <?php if (empty($listNotulensi)): ?>
                <!-- EMPTY STATE NOTULENSI -->
                <div class="py-16 text-center bg-gray-50 rounded-2xl border border-dashed border-gray-300">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <h3 class="text-lg font-bold text-gray-800">Tidak ada arsip notulen ditemukan</h3>
                    <p class="text-sm text-gray-500 mt-1">Coba gunakan kata kunci lain atau ubah filter pencarian Anda.</p>
                </div>
            <?php else: ?>
                <div class="flex flex-col space-y-6">
                    <?php foreach ($listNotulensi as $item): ?>
                        <?php 
                            $badgeColor = match($item['kategori_type'] ?? 'emerald') {
                                'purple' => 'text-purple-600 bg-purple-50 border-l-purple-500',
                                'amber'  => 'text-amber-600 bg-amber-50 border-l-amber-500',
                                default  => 'text-emerald-600 bg-emerald-50 border-l-emerald-500',
                            };
                            $borderColor = match($item['kategori_type'] ?? 'emerald') {
                                'purple' => 'border-l-purple-500',
                                'amber'  => 'border-l-amber-500',
                                default  => 'border-l-emerald-500',
                            };
                        ?>
                        <div class="flex flex-col sm:flex-row gap-6 bg-white p-5 rounded-xl border border-gray-100 border-l-4 <?= $borderColor ?> hover:shadow-lg transition-all duration-300 group">
                            <!-- Tanggal Box -->
                            <div class="flex-shrink-0 w-24 flex flex-col rounded-md overflow-hidden shadow-sm border border-purple-100">
                                <div class="bg-purple-100 py-2 flex flex-col items-center justify-center relative">
                                    <div class="absolute top-2 left-2 w-2 h-2 bg-purple-800 rounded-full"></div>
                                    <div class="absolute top-2 right-2 w-2 h-2 bg-purple-800 rounded-full"></div>
                                    <span class="text-2xl font-bold text-purple-800 mt-2"><?= htmlspecialchars($item['tgl_day']) ?></span>
                                    <span class="text-sm font-semibold text-purple-800 uppercase"><?= htmlspecialchars($item['tgl_month']) ?></span>
                                </div>
                                <div class="bg-purple-800 py-1.5 flex justify-center items-center">
                                    <span class="text-xs font-bold text-white tracking-widest"><?= htmlspecialchars($item['tgl_year']) ?></span>
                                </div>
                            </div>

                            <!-- Konten Notulensi -->
                            <div class="flex-1 flex flex-col justify-center">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="text-xs font-semibold px-2.5 py-1 rounded <?= $badgeColor ?>">
                                        <?= htmlspecialchars($item['kategori']) ?>
                                    </span>
                                    <?php if (!empty($item['waktu'])): ?>
                                        <span class="text-xs text-gray-400 font-medium flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <?= htmlspecialchars($item['waktu']) ?>
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <a href="/notulensi/detail?id=<?= $item['id'] ?>" class="inline-block">
                                    <h3 class="text-xl font-bold text-gray-900 group-hover:text-purple-600 transition-colors mb-2">
                                        <?= htmlspecialchars($item['judul']) ?>
                                    </h3>
                                </a>

                                <p class="text-gray-600 text-sm leading-relaxed mb-4 line-clamp-2">
                                    <?= htmlspecialchars($item['ringkasan']) ?>
                                </p>

                                <a href="/notulensi/detail?id=<?= $item['id'] ?>" class="text-sm font-bold text-purple-600 hover:text-purple-700 flex items-center gap-1 w-max">
                                    Baca Detail
                                    <span class="transform group-hover:translate-x-1 transition-transform">&rarr;</span>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Pagination Container -->
                <div class="mt-12 flex justify-center items-center gap-2">
                    <button class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-300 text-gray-400 cursor-not-allowed" disabled>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                    <button class="w-10 h-10 flex items-center justify-center rounded-lg bg-purple-600 text-white font-bold shadow-md">1</button>
                    <button class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-300 hover:bg-gray-50 text-gray-700 font-medium transition">2</button>
                    <button class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-300 hover:bg-gray-50 text-gray-700 font-medium transition">3</button>
                    <span class="text-gray-400 px-1">...</span>
                    <button class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-300 hover:bg-gray-50 text-gray-700 font-medium transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
            <?php endif; ?>

        </div>
    </div>

    <!-- FOOTER -->
    <?php require base_path('views/partials/footer.php'); ?>
</body>

</html>
