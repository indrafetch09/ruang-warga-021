<!DOCTYPE html>
<html lang="id">

<head>
    <title>Kebersihan Lingkungan (TPST & Bank Sampah) - Ruang Warga 021</title>
    <?php require base_path('views/partials/head.php'); ?>
    <style>
        @keyframes marquee-right {
            from {
                transform: translateX(-50%);
            }

            to {
                transform: translateX(0%);
            }
        }

        @keyframes marquee-left {
            from {
                transform: translateX(0%);
            }

            to {
                transform: translateX(-50%);
            }
        }

        .animate-slide-right {
            animation: marquee-right 28s linear infinite;
        }

        .animate-slide-left {
            animation: marquee-left 28s linear infinite;
        }

        .animate-slide-right:hover,
        .animate-slide-left:hover {
            animation-play-state: paused;
        }
    </style>
</head>

<body class="bg-gray-50 flex flex-col min-h-screen text-gray-800">

    <?php require base_path('views/partials/navbar.php'); ?>

    <!-- MAIN CONTENT -->
    <div class="py-12 md:py-16 flex-1">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

            <!-- PAGE HEADER -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-gray-200 pb-8 pt-2">
                <div class="space-y-2">
                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-bold rounded-lg uppercase tracking-wider">
                        <span class="w-2 h-2 rounded-full bg-emerald-600"></span>
                        Kebersihan & Lingkungan Hidup
                    </div>
                    <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight">
                        Layanan Kebersihan <span class="text-emerald-600">TPST & Bank Sampah RW 021</span>
                    </h1>
                    <p class="text-sm md:text-base text-gray-600 max-w-3xl leading-relaxed">
                        Sistem pengelolaan sampah mandiri dan terpadu RW 021 Bojong Nangka. Melayani jadwal armada pengangkutan sampah rumah tangga harian, pemilahan organik/anorganik, serta tabungan daur ulang Bank Sampah untuk mewujudkan lingkungan yang sehat, asri, dan produktif.
                    </p>
                </div>
                <div class="flex-shrink-0">
                    <a href="https://wa.me/6281511322022" target="_blank" class="inline-flex items-center gap-2 px-6 py-3.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-lg transition duration-150 shadow-md">
                        <span>Hubungi Koordinator Kebersihan</span>
                        <span>&rarr;</span>
                    </a>
                </div>
            </div>

            <!-- SUMMARY STATS TPST -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
                <div class="bg-white p-5 rounded-lg border border-emerald-100 shadow-sm text-center">
                    <span class="text-2xl sm:text-3xl font-extrabold text-emerald-600 block mb-1">Setiap Hari</span>
                    <span class="text-xs text-gray-500 font-bold uppercase tracking-wider">Sampah Dapur Organik</span>
                </div>
                <div class="bg-white p-5 rounded-lg border border-emerald-100 shadow-sm text-center">
                    <span class="text-2xl sm:text-3xl font-extrabold text-emerald-600 block mb-1">Senin & Kamis</span>
                    <span class="text-xs text-gray-500 font-bold uppercase tracking-wider">Sampah Anorganik Kering</span>
                </div>
                <div class="bg-white p-5 rounded-lg border border-emerald-100 shadow-sm text-center">
                    <span class="text-2xl sm:text-3xl font-extrabold text-purple-700 block mb-1">RT 01 - 10</span>
                    <span class="text-xs text-gray-500 font-bold uppercase tracking-wider">Cakupan Armada Gerobak</span>
                </div>
                <div class="bg-white p-5 rounded-lg border border-emerald-100 shadow-sm text-center">
                    <span class="text-2xl sm:text-3xl font-extrabold text-emerald-600 block mb-1">Bank Sampah</span>
                    <span class="text-xs text-gray-500 font-bold uppercase tracking-wider">Tabungan Daur Ulang</span>
                </div>
            </div>

            <!-- SECTION GAMBAR & DOKUMENTASI TPST -->
            <?php
            $galeriTpst = [
                ['foto' => 'https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?auto=format&fit=crop&w=800&q=80', 'judul' => 'Pemilahan Sampah Bank Sampah', 'sub' => 'Daur Ulang Warga'],
                ['foto' => 'https://images.unsplash.com/photo-1605600659873-d808a13e4d2a?auto=format&fit=crop&w=800&q=80', 'judul' => 'Pemilahan Organik & Anorganik', 'sub' => 'Edukasi Lingkungan'],
                ['foto' => 'https://images.unsplash.com/photo-1618477461853-cf6ed80faba5?auto=format&fit=crop&w=800&q=80', 'judul' => 'Armada Gerobak Pengangkutan', 'sub' => 'Operasional Kebersihan'],
                ['foto' => 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?auto=format&fit=crop&w=800&q=80', 'judul' => 'Gotong Royong Kebersihan Lingkungan', 'sub' => 'Kerja Bakti RW 021'],
                ['foto' => 'https://images.unsplash.com/photo-1528323273322-d81458248d40?auto=format&fit=crop&w=800&q=80', 'judul' => 'Pusat Pengumpulan Sampah Terpadu', 'sub' => 'TPST 021 Bojong Nangka']
            ];
            ?>
            <div class="bg-white p-6 md:p-10 rounded-lg shadow-sm border border-emerald-100 space-y-8">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 border-b border-gray-100 pb-4">
                    <div>
                        <span class="text-xs font-extrabold text-emerald-700 uppercase tracking-widest block mb-1">Dokumentasi & Galeri</span>
                        <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900">Aktivitas TPST & Bank Sampah RW 021</h2>
                        <p class="text-xs sm:text-sm text-gray-500 mt-1">Dokumentasi operasional armada pengangkutan lingkungan dan kegiatan setor tabungan daur ulang warga.</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <!-- TOP GRID ROW -->
                    <div class="relative overflow-hidden rounded-lg">
                        <div class="flex gap-4 w-max animate-slide-right">
                            <?php foreach ($galeriTpst as $item): ?>
                                <div class="w-72 sm:w-80 flex-shrink-0 relative group overflow-hidden shadow-sm rounded-lg border border-gray-100 bg-gray-900">
                                    <img src="<?= htmlspecialchars($item['foto']) ?>" alt="<?= htmlspecialchars($item['judul']) ?>" class="w-full h-48 sm:h-52 object-cover transform group-hover:scale-105 transition duration-500 opacity-90 group-hover:opacity-100" onerror="this.src='https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?auto=format&fit=crop&w=800&q=80'" />
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex flex-col justify-end p-4">
                                        <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-300"><?= htmlspecialchars($item['sub']) ?></span>
                                        <h4 class="text-sm font-bold text-white"><?= htmlspecialchars($item['judul']) ?></h4>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <!-- Duplicate Loop for Infinite Scroll -->
                            <?php foreach ($galeriTpst as $item): ?>
                                <div class="w-72 sm:w-80 flex-shrink-0 relative group overflow-hidden shadow-sm rounded-lg border border-gray-100 bg-gray-900" aria-hidden="true">
                                    <img src="<?= htmlspecialchars($item['foto']) ?>" alt="" class="w-full h-48 sm:h-52 object-cover transform group-hover:scale-105 transition duration-500 opacity-90 group-hover:opacity-100" onerror="this.src='https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?auto=format&fit=crop&w=800&q=80'" />
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex flex-col justify-end p-4">
                                        <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-300"><?= htmlspecialchars($item['sub']) ?></span>
                                        <h4 class="text-sm font-bold text-white"><?= htmlspecialchars($item['judul']) ?></h4>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- BOTTOM GRID ROW -->
                    <div class="relative overflow-hidden rounded-lg">
                        <div class="flex gap-4 w-max animate-slide-left">
                            <?php foreach ($galeriTpst as $item): ?>
                                <div class="w-72 sm:w-80 flex-shrink-0 relative group overflow-hidden shadow-sm rounded-lg border border-gray-100 bg-gray-900">
                                    <img src="<?= htmlspecialchars($item['foto']) ?>" alt="<?= htmlspecialchars($item['judul']) ?>" class="w-full h-48 sm:h-52 object-cover transform group-hover:scale-105 transition duration-500 opacity-90 group-hover:opacity-100" onerror="this.src='https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?auto=format&fit=crop&w=800&q=80'" />
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex flex-col justify-end p-4">
                                        <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-300"><?= htmlspecialchars($item['sub']) ?></span>
                                        <h4 class="text-sm font-bold text-white"><?= htmlspecialchars($item['judul']) ?></h4>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <!-- Duplicate Loop for Infinite Scroll -->
                            <?php foreach ($galeriTpst as $item): ?>
                                <div class="w-72 sm:w-80 flex-shrink-0 relative group overflow-hidden shadow-sm rounded-lg border border-gray-100 bg-gray-900" aria-hidden="true">
                                    <img src="<?= htmlspecialchars($item['foto']) ?>" alt="" class="w-full h-48 sm:h-52 object-cover transform group-hover:scale-105 transition duration-500 opacity-90 group-hover:opacity-100" onerror="this.src='https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?auto=format&fit=crop&w=800&q=80'" />
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex flex-col justify-end p-4">
                                        <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-300"><?= htmlspecialchars($item['sub']) ?></span>
                                        <h4 class="text-sm font-bold text-white"><?= htmlspecialchars($item['judul']) ?></h4>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- DESKRIPSI LENGKAP LAYANAN KEBERSIHAN (3 CARDS) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- CARD 1: PENGANGKUTAN SAMPAH -->
                <div class="bg-white p-6 sm:p-8 rounded-lg border border-emerald-100 shadow-sm flex flex-col justify-between space-y-5 hover:shadow-md hover:border-emerald-200 transition">
                    <div class="space-y-4">
                        <div class="w-12 h-12 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Pengangkutan Sampah Harian</h3>
                            <p class="text-xs text-gray-600 mt-2 leading-relaxed">
                                Armada motor gerobak keliling RW 021 mengambil sampah rumah tangga di depan pagar rumah setiap pagi hari. Sampah organik basah diambil setiap hari (06.00 - 09.00 WIB), sedangkan sampah anorganik kering diangkut setiap hari Senin dan Kamis.
                            </p>
                        </div>
                        <div class="space-y-1.5 pt-2 border-t border-gray-100 text-xs text-gray-600">
                            <div class="flex items-center gap-2">
                                <span class="text-emerald-600 font-bold">✓</span>
                                <span>Organik: Setiap hari (06.00 - 09.00 WIB)</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-emerald-600 font-bold">✓</span>
                                <span>Anorganik: Senin & Kamis</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-emerald-600 font-bold">✓</span>
                                <span>Wajib kantong sampah terikat rapat</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="button" onclick="openFacilityModal('tpst-jadwal')" class="text-xs font-bold text-emerald-700 hover:text-emerald-900 inline-flex items-center gap-1">
                            <span>Lihat Rincian Jadwal & Wilayah</span>
                            <span>&rarr;</span>
                        </button>
                    </div>
                </div>

                <!-- CARD 2: BANK SAMPAH BERKAH -->
                <div class="bg-white p-6 sm:p-8 rounded-lg border border-emerald-100 shadow-sm flex flex-col justify-between space-y-5 hover:shadow-md hover:border-emerald-200 transition">
                    <div class="space-y-4">
                        <div class="w-12 h-12 rounded-lg bg-purple-100 text-purple-700 flex items-center justify-center font-bold">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Bank Sampah "Berkah 021"</h3>
                            <p class="text-xs text-gray-600 mt-2 leading-relaxed">
                                Program pemberdayaan warga untuk mengonversi sampah anorganik bernilai ekonomis (botol plastik PET, kardus, kaleng logam, dan minyak jelantah) menjadi saldo tabungan rupiah yang dapat dicairkan atau digunakan untuk membayar iuran warga.
                            </p>
                        </div>
                        <div class="space-y-1.5 pt-2 border-t border-gray-100 text-xs text-gray-600">
                            <div class="flex items-center gap-2">
                                <span class="text-purple-600 font-bold">✓</span>
                                <span>Penimbangan tiap Minggu ke-2 & ke-4</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-purple-600 font-bold">✓</span>
                                <span>Menerima botol, kardus, kaleng & jelantah</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-purple-600 font-bold">✓</span>
                                <span>Buku tabungan rekening warga</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="button" onclick="openFacilityModal('bank-sampah')" class="text-xs font-bold text-purple-700 hover:text-purple-900 inline-flex items-center gap-1">
                            <span>Daftar Harga & Cara Setor</span>
                            <span>&rarr;</span>
                        </button>
                    </div>
                </div>

                <!-- CARD 3: TATA TERTIB & IURAN -->
                <div class="bg-white p-6 sm:p-8 rounded-lg border border-emerald-100 shadow-sm flex flex-col justify-between space-y-5 hover:shadow-md hover:border-emerald-200 transition">
                    <div class="space-y-4">
                        <div class="w-12 h-12 rounded-lg bg-teal-100 text-teal-700 flex items-center justify-center font-bold">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Tata Tertib & Iuran Sampah</h3>
                            <p class="text-xs text-gray-600 mt-2 leading-relaxed">
                                Iuran kebersihan lingkungan dikelola secara transparan untuk pembelian BBM armada gerobak motor, pemeliharaan alat TPST, dan upah petugas harian. Warga diharapkan menaruh tempat sampah di area yang mudah dijangkau armada.
                            </p>
                        </div>
                        <div class="space-y-1.5 pt-2 border-t border-gray-100 text-xs text-gray-600">
                            <div class="flex items-center gap-2">
                                <span class="text-teal-600 font-bold">✓</span>
                                <span>Iuran bulanan melalui pengurus RT</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-teal-600 font-bold">✓</span>
                                <span>Larangan membuang puing/batu ke gerobak</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-teal-600 font-bold">✓</span>
                                <span>Layanan darurat sampah menumpuk</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="button" onclick="openFacilityModal('tpst-aturan')" class="text-xs font-bold text-teal-700 hover:text-teal-900 inline-flex items-center gap-1">
                            <span>Lihat SOP & Regulasi</span>
                            <span>&rarr;</span>
                        </button>
                    </div>
                </div>

            </div>

            <!-- PANDUAN PEMILAHAN SAMPAH RUMAH TANGGA -->
            <div class="bg-gradient-to-br from-emerald-800 to-teal-900 text-white p-6 sm:p-10 rounded-lg shadow-lg space-y-6">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-emerald-300">Panduan Praktis</span>
                    <h3 class="text-2xl font-bold tracking-tight mt-1">Cara Memilah Sampah dari Rumah</h3>
                    <p class="text-xs sm:text-sm text-emerald-100 mt-1 max-w-2xl leading-relaxed">
                        Partisipasi aktif warga dalam memilah sampah di rumah mempermudah proses daur ulang dan mempercepat kerja petugas armada kebersihan RW 021.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
                    <div class="bg-white/10 p-5 rounded-lg border border-white/10 space-y-2">
                        <div class="flex items-center gap-2 text-emerald-300 font-bold text-sm">
                            <span class="w-3 h-3 rounded-full bg-emerald-400"></span>
                            <span>1. Sampah Organik</span>
                        </div>
                        <p class="text-emerald-100 leading-relaxed">Sisa makanan, sayuran, kulit buah, dan daun kebun. Masukkan ke kantong tersendiri untuk diolah menjadi pupuk kompos.</p>
                        <span class="text-[11px] font-semibold text-emerald-200 block pt-1">Diangkut: Setiap Hari (06.00 - 09.00)</span>
                    </div>

                    <div class="bg-white/10 p-5 rounded-lg border border-white/10 space-y-2">
                        <div class="flex items-center gap-2 text-amber-300 font-bold text-sm">
                            <span class="w-3 h-3 rounded-full bg-amber-400"></span>
                            <span>2. Sampah Anorganik Daur Ulang</span>
                        </div>
                        <p class="text-emerald-100 leading-relaxed">Botol plastik bersih, kardus, kaleng, koran, dan minyak jelantah. Kumpulkan dalam kondisi kering untuk disetor ke Bank Sampah.</p>
                        <span class="text-[11px] font-semibold text-amber-200 block pt-1">Setor: Minggu ke-2 & ke-4</span>
                    </div>

                    <div class="bg-white/10 p-5 rounded-lg border border-white/10 space-y-2">
                        <div class="flex items-center gap-2 text-rose-300 font-bold text-sm">
                            <span class="w-3 h-3 rounded-full bg-rose-400"></span>
                            <span>3. Sampah Residu & B3</span>
                        </div>
                        <p class="text-emerald-100 leading-relaxed">Pampers, tisu kotor, baterai bekas, pecahan kaca, atau limbah medis rumah tangga. Ikat rapat dalam kantong khusus.</p>
                        <span class="text-[11px] font-semibold text-rose-200 block pt-1">Diangkut: Senin & Kamis</span>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- FOOTER -->
    <?php require base_path('views/partials/footer.php'); ?>

    <!-- MODAL DETAIL OVERLAY -->
    <div id="detail-modal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-lg max-w-2xl w-full max-h-[90vh] overflow-hidden flex flex-col shadow-2xl">
            <!-- Modal Header -->
            <div id="modal-header-bg" class="px-6 py-5 bg-emerald-700 text-white flex justify-between items-center">
                <div>
                    <span id="modal-category" class="text-[10px] font-extrabold uppercase tracking-widest bg-white/20 px-2.5 py-0.5 rounded-lg">TPST RW 021</span>
                    <h3 id="modal-title" class="text-xl font-bold mt-1">Detail Layanan</h3>
                </div>
                <button type="button" onclick="closeFacilityModal()" class="text-white/80 hover:text-white text-2xl font-bold p-1 focus:outline-none">&times;</button>
            </div>

            <!-- Modal Content -->
            <div class="p-6 overflow-y-auto space-y-6 flex-1 text-gray-800">
                <div>
                    <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Deskripsi Singkat</h4>
                    <p id="modal-description" class="text-sm text-gray-700 leading-relaxed"></p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-t border-b border-gray-100 py-4">
                    <div>
                        <h4 class="text-xs font-bold text-emerald-700 uppercase tracking-wider mb-2">Aturan & Operasional</h4>
                        <ul id="modal-subitems" class="text-xs text-gray-600 space-y-1.5 list-disc list-inside"></ul>
                    </div>

                    <div>
                        <h4 class="text-xs font-bold text-amber-700 uppercase tracking-wider mb-2">Persyaratan / Catatan</h4>
                        <ul id="modal-requirements" class="text-xs text-gray-600 space-y-1.5"></ul>
                    </div>
                </div>

                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                    <div>
                        <span class="text-xs font-bold text-gray-400 uppercase block">Lokasi & Waktu Operasional</span>
                        <span id="modal-schedule" class="text-xs font-bold text-gray-800"></span>
                    </div>
                    <div>
                        <span class="text-xs font-bold text-gray-400 uppercase block">Koordinator Kontak</span>
                        <span id="modal-coordinator" class="text-xs font-bold text-emerald-700"></span>
                    </div>
                </div>

                <div class="pt-2">
                    <a id="modal-wa-btn" href="#" target="_blank" class="w-full py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-lg flex items-center justify-center gap-2 transition shadow-md">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.157 4.228 4.301-1.127z" />
                        </svg>
                        Hubungi Koordinator TPST via WhatsApp
                    </a>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end">
                <button type="button" onclick="closeFacilityModal()" class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold text-xs rounded-lg transition">Tutup</button>
            </div>
        </div>
    </div>

    <script>
        const facilityModalData = {
            'tpst-jadwal': {
                category: 'Pengangkutan Sampah RW 021',
                title: 'Jadwal Operasional Armada Gerobak Sampah',
                headerBg: 'bg-emerald-700',
                description: 'Jadwal pengambilan sampah rumah tangga oleh petugas armada motor gerobak RW 021 Bojong Nangka untuk seluruh warga RT 01 sampai RT 10.',
                subitems: [
                    'Sampah Organik Basah: Setiap Hari (Pukul 06.00 - 09.00 WIB)',
                    'Sampah Anorganik Kering: Senin & Kamis (Pukul 09.00 - 12.00 WIB)',
                    'Sampah Kebun / Ranting: Sabtu (Berdasarkan Laporan RT)'
                ],
                requirements: [
                    'Wadah / kantong sampah ditaruh di depan pagar rumah sebelum pukul 06.00 WIB',
                    'Wajib menggunakan plastik tertutup rapat agar tidak berserakan dan terhindar dari kucing/hujan',
                    'Dilarang mencampurkan puing bangunan atau pecahan kaca tajam tanpa pengaman'
                ],
                schedule: 'Wilayah RT 01 s.d RT 10 RW 021<br>Setiap Hari (06.00 - 12.00 WIB)',
                coordinator: 'Khusairi (Koordinator Kebersihan & Humas RW - 081511322022)',
                wa: 'https://wa.me/6281511322022'
            },
            'bank-sampah': {
                category: 'Bank Sampah Berkah 021',
                title: 'Program Tabungan Daur Ulang Bank Sampah',
                headerBg: 'bg-purple-700',
                description: 'Konversi sampah anorganik rumah tangga menjadi saldo rupiah. Seluruh hasil timbangan akan dicatat dalam buku tabungan warga dan dapat ditarik sewaktu-waktu.',
                subitems: [
                    'Kardus / Kertas HVS / Koran: Rp 1.500 - Rp 2.500 / kg',
                    'Botol Plastik PET Bening Bersih: Rp 2.500 - Rp 4.000 / kg',
                    'Kaleng Minuman / Logam / Besi: Rp 3.000 - Rp 6.000 / kg',
                    'Minyak Jelantah Bekas Pakai: Rp 5.000 - Rp 7.000 / liter'
                ],
                requirements: [
                    'Sampah disetor dalam kondisi bersih dan kering (botol dipipihkan)',
                    'Membawa Buku Tabungan Bank Sampah saat jadwal penimbangan',
                    'Bisa dibuka oleh perorangan maupun kolektif per RT'
                ],
                schedule: 'Posko Bank Sampah RW 021 (Samping Balai RT 05)<br>Minggu Ke-2 & Ke-4 (Pukul 08.30 - 11.30 WIB)',
                coordinator: 'Pengurus Bank Sampah Berkah RW 021',
                wa: 'https://wa.me/6281511322022'
            },
            'tpst-aturan': {
                category: 'Tata Tertib & SOP Kebersihan',
                title: 'Regulasi & SOP Pengelolaan TPST 021',
                headerBg: 'bg-teal-700',
                description: 'Peraturan bersama demi menjaga kebersihan, ketertiban, dan kenyamanan lingkungan hidup seluruh warga RW 021.',
                subitems: [
                    'Iuran kebersihan dibayarkan tertib setiap awal bulan melalui bendahara RT masing-masing',
                    'Petugas armada hanya mengangkut sampah domestik rumah tangga',
                    'Penebangan pohon besar atau puing renovasi wajib sewa armada khusus'
                ],
                requirements: [
                    'Menjaga kebersihan drainase dan selokan di depan rumah masing-masing',
                    'Dilarang keras membakar sampah dalam bentuk apa pun di pemukiman',
                    'Laporkan jika armada pengangkut tidak melintas lebih dari 2 hari berturut-turut'
                ],
                schedule: 'Kantor Sekretariat TPST RW 021<br>Senin - Sabtu (08.00 - 16.00 WIB)',
                coordinator: 'Seksi Lingkungan Hidup & Kebersihan RW 021',
                wa: 'https://wa.me/6281511322022'
            }
        };

        function openFacilityModal(key) {
            const data = facilityModalData[key];
            if (!data) return;

            document.getElementById('modal-category').innerText = data.category;
            document.getElementById('modal-title').innerText = data.title;
            document.getElementById('modal-header-bg').className = `px-6 py-5 ${data.headerBg} text-white flex justify-between items-center`;
            document.getElementById('modal-description').innerText = data.description;

            const subitemsContainer = document.getElementById('modal-subitems');
            subitemsContainer.innerHTML = '';
            data.subitems.forEach(item => {
                const li = document.createElement('li');
                li.innerText = item;
                subitemsContainer.appendChild(li);
            });

            const reqContainer = document.getElementById('modal-requirements');
            reqContainer.innerHTML = '';
            data.requirements.forEach(req => {
                const li = document.createElement('li');
                li.innerHTML = `• ${req}`;
                reqContainer.appendChild(li);
            });

            document.getElementById('modal-schedule').innerHTML = data.schedule;
            document.getElementById('modal-coordinator').innerText = data.coordinator;
            document.getElementById('modal-wa-btn').href = data.wa;

            document.getElementById('detail-modal').classList.remove('hidden');
        }

        function closeFacilityModal() {
            document.getElementById('detail-modal').classList.add('hidden');
        }

        document.getElementById('detail-modal').addEventListener('click', function(e) {
            if (e.target === this) closeFacilityModal();
        });
    </script>
</body>

</html>