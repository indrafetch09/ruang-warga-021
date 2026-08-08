<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Arsip Notulen Rapat - Sistem Informasi RW 21</title>
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
    </style>
</head>

<body class="bg-gray-50">
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
                warga dan pengurus RW 21.
            </p>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="py-12 bg-white min-h-screen">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Filter & Search Bar -->
            <div
                class="bg-white border border-gray-200 p-4 rounded-xl shadow-sm mb-10 flex flex-col md:flex-row gap-4 items-center justify-between">
                <div class="w-full md:w-1/2 relative">
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input type="text" placeholder="Cari judul atau kata kunci rapat..."
                        class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition text-sm" />
                </div>
                <div class="w-full md:w-auto flex gap-3">
                    <select
                        class="w-full md:w-auto px-4 py-2.5 border border-gray-300 rounded-lg text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 bg-white cursor-pointer">
                        <option value="">Semua Kategori</option>
                        <option value="rutin">Rapat Rutin</option>
                        <option value="khusus">Rapat Khusus</option>
                        <option value="laporan">Laporan Kas</option>
                    </select>
                    <select
                        class="w-full md:w-auto px-4 py-2.5 border border-gray-300 rounded-lg text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 bg-white cursor-pointer">
                        <option value="2026">2026</option>
                        <option value="2025">2025</option>
                    </select>
                </div>
            </div>

            <!-- List of Notulensi -->
            <div class="flex flex-col space-y-6">
                <!-- Item 1 -->
                <div
                    class="flex flex-col sm:flex-row gap-6 bg-white p-5 rounded-xl border border-gray-100 border-l-4 border-l-emerald-500 hover:shadow-lg transition-all duration-300 group">
                    <!-- Tanggal Box -->
                    <div
                        class="flex-shrink-0 w-24 flex flex-col rounded-md overflow-hidden shadow-sm border border-purple-100">
                        <div class="bg-purple-100 py-2 flex flex-col items-center justify-center relative">
                            <div class="absolute top-2 left-2 w-2 h-2 bg-purple-800 rounded-full"></div>
                            <div class="absolute top-2 right-2 w-2 h-2 bg-purple-800 rounded-full"></div>
                            <span class="text-2xl font-bold text-purple-800 mt-2">12</span>
                            <span class="text-sm font-semibold text-purple-800 uppercase">Agt</span>
                        </div>
                        <div class="bg-purple-800 py-1.5 flex justify-center items-center">
                            <span class="text-xs font-bold text-white tracking-widest">2026</span>
                        </div>
                    </div>
                    <!-- Konten -->
                    <div class="flex-1 flex flex-col justify-center">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded">Rapat
                                Rutin</span>
                            <span class="text-xs text-gray-400 font-medium flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                20:00 WIB
                            </span>
                        </div>
                        <a href="/notulensi/detail" class="inline-block">
                            <h3
                                class="text-xl font-bold text-gray-900 group-hover:text-purple-600 transition-colors mb-2">
                                Rapat Persiapan HUT RI ke-81
                            </h3>
                        </a>
                        <p class="text-gray-600 text-sm leading-relaxed mb-4 line-clamp-2">
                            Membahas pembentukan panitia lomba 17 Agustus tingkat RW,
                            rincian anggaran kegiatan, dan penetapan rute jalan sehat warga.
                            Disepakati bahwa iuran partisipasi per KK adalah sebesar
                            Rp50.000...
                        </p>
                        <a href="/notulensi/detail"
                            class="text-sm font-bold text-purple-600 hover:text-purple-700 flex items-center gap-1 w-max">
                            Baca Detail
                            <span class="transform group-hover:translate-x-1 transition-transform">&rarr;</span>
                        </a>
                    </div>
                </div>

                <!-- Item 2 -->
                <div
                    class="flex flex-col sm:flex-row gap-6 bg-white p-5 rounded-xl border border-gray-100 border-l-4 border-l-purple-500 hover:shadow-lg transition-all duration-300 group">
                    <div
                        class="flex-shrink-0 w-24 flex flex-col rounded-md overflow-hidden shadow-sm border border-purple-100">
                        <div class="bg-purple-100 py-2 flex flex-col items-center justify-center relative">
                            <div class="absolute top-2 left-2 w-2 h-2 bg-purple-800 rounded-full"></div>
                            <div class="absolute top-2 right-2 w-2 h-2 bg-purple-800 rounded-full"></div>
                            <span class="text-2xl font-bold text-purple-800 mt-2">28</span>
                            <span class="text-sm font-semibold text-purple-800 uppercase">Jul</span>
                        </div>
                        <div class="bg-purple-800 py-1.5 flex justify-center items-center">
                            <span class="text-xs font-bold text-white tracking-widest">2026</span>
                        </div>
                    </div>
                    <div class="flex-1 flex flex-col justify-center">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-xs font-semibold text-purple-600 bg-purple-50 px-2.5 py-1 rounded">Rapat
                                Khusus</span>
                        </div>
                        <a href="/notulensi/detail" class="inline-block">
                            <h3
                                class="text-xl font-bold text-gray-900 group-hover:text-purple-600 transition-colors mb-2">
                                Evaluasi Keamanan Lingkungan
                            </h3>
                        </a>
                        <p class="text-gray-600 text-sm leading-relaxed mb-4 line-clamp-2">
                            Tindak lanjut dari laporan warga terkait aturan jam malam untuk
                            tamu. Forum menyetujui penambahan 3 titik CCTV baru di area gang
                            buntu dan portal utama akan mulai ditutup penuh pada pukul 23.00
                            WIB.
                        </p>
                        <a href="/notulensi/detail"
                            class="text-sm font-bold text-purple-600 hover:text-purple-700 flex items-center gap-1 w-max">
                            Baca Detail
                            <span class="transform group-hover:translate-x-1 transition-transform">&rarr;</span>
                        </a>
                    </div>
                </div>

                <!-- Item 3 -->
                <div
                    class="flex flex-col sm:flex-row gap-6 bg-white p-5 rounded-xl border border-gray-100 border-l-4 border-l-emerald-500 hover:shadow-lg transition-all duration-300 group">
                    <div
                        class="flex-shrink-0 w-24 flex flex-col rounded-md overflow-hidden shadow-sm border border-purple-100">
                        <div class="bg-purple-100 py-2 flex flex-col items-center justify-center relative">
                            <div class="absolute top-2 left-2 w-2 h-2 bg-purple-800 rounded-full"></div>
                            <div class="absolute top-2 right-2 w-2 h-2 bg-purple-800 rounded-full"></div>
                            <span class="text-2xl font-bold text-purple-800 mt-2">05</span>
                            <span class="text-sm font-semibold text-purple-800 uppercase">Jul</span>
                        </div>
                        <div class="bg-purple-800 py-1.5 flex justify-center items-center">
                            <span class="text-xs font-bold text-white tracking-widest">2026</span>
                        </div>
                    </div>
                    <div class="flex-1 flex flex-col justify-center">
                        <div class="flex items-center gap-2 mb-2">
                            <span
                                class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded">Laporan
                                Kas</span>
                        </div>
                        <a href="/notulensi/detail" class="inline-block">
                            <h3
                                class="text-xl font-bold text-gray-900 group-hover:text-purple-600 transition-colors mb-2">
                                Laporan Transparansi Iuran Kas Semester I
                            </h3>
                        </a>
                        <p class="text-gray-600 text-sm leading-relaxed mb-4 line-clamp-2">
                            Pemaparan rincian pemasukan dan pengeluaran kas RW untuk periode
                            Januari hingga Juni 2026. Saldo akhir yang dilaporkan telah
                            disetujui tanpa ada sanggahan dari perwakilan tiap RT.
                        </p>
                        <a href="/notulensi/detail"
                            class="text-sm font-bold text-purple-600 hover:text-purple-700 flex items-center gap-1 w-max">
                            Baca Detail
                            <span class="transform group-hover:translate-x-1 transition-transform">&rarr;</span>
                        </a>
                    </div>
                </div>

                <!-- Item 4 (Tambahan) -->
                <div
                    class="flex flex-col sm:flex-row gap-6 bg-white p-5 rounded-xl border border-gray-100 border-l-4 border-l-amber-500 hover:shadow-lg transition-all duration-300 group">
                    <div
                        class="flex-shrink-0 w-24 flex flex-col rounded-md overflow-hidden shadow-sm border border-purple-100">
                        <div class="bg-purple-100 py-2 flex flex-col items-center justify-center relative">
                            <div class="absolute top-2 left-2 w-2 h-2 bg-purple-800 rounded-full"></div>
                            <div class="absolute top-2 right-2 w-2 h-2 bg-purple-800 rounded-full"></div>
                            <span class="text-2xl font-bold text-purple-800 mt-2">15</span>
                            <span class="text-sm font-semibold text-purple-800 uppercase">Jun</span>
                        </div>
                        <div class="bg-purple-800 py-1.5 flex justify-center items-center">
                            <span class="text-xs font-bold text-white tracking-widest">2026</span>
                        </div>
                    </div>
                    <div class="flex-1 flex flex-col justify-center">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-xs font-semibold text-amber-600 bg-amber-50 px-2.5 py-1 rounded">Rapat
                                Khusus</span>
                        </div>
                        <a href="/notulensi/detail" class="inline-block">
                            <h3
                                class="text-xl font-bold text-gray-900 group-hover:text-purple-600 transition-colors mb-2">
                                Sosialisasi Pembuatan Sistem Portal Warga
                            </h3>
                        </a>
                        <p class="text-gray-600 text-sm leading-relaxed mb-4 line-clamp-2">
                            Diskusi awal mengenai perancangan dan kebutuhan sistem portal
                            digital warga. Pengurus RT dan RW menyetujui anggaran awal dan
                            fitur-fitur mandiri yang akan dikembangkan oleh tim IT warga.
                        </p>
                        <a href="/notulensi/detail"
                            class="text-sm font-bold text-purple-600 hover:text-purple-700 flex items-center gap-1 w-max">
                            Baca Detail
                            <span class="transform group-hover:translate-x-1 transition-transform">&rarr;</span>
                        </a>
                    </div>
                </div>

                <!-- Item 5 (Tambahan) -->
                <div
                    class="flex flex-col sm:flex-row gap-6 bg-white p-5 rounded-xl border border-gray-100 border-l-4 border-l-emerald-500 hover:shadow-lg transition-all duration-300 group">
                    <div
                        class="flex-shrink-0 w-24 flex flex-col rounded-md overflow-hidden shadow-sm border border-purple-100">
                        <div class="bg-purple-100 py-2 flex flex-col items-center justify-center relative">
                            <div class="absolute top-2 left-2 w-2 h-2 bg-purple-800 rounded-full"></div>
                            <div class="absolute top-2 right-2 w-2 h-2 bg-purple-800 rounded-full"></div>
                            <span class="text-2xl font-bold text-purple-800 mt-2">02</span>
                            <span class="text-sm font-semibold text-purple-800 uppercase">Jun</span>
                        </div>
                        <div class="bg-purple-800 py-1.5 flex justify-center items-center">
                            <span class="text-xs font-bold text-white tracking-widest">2026</span>
                        </div>
                    </div>
                    <div class="flex-1 flex flex-col justify-center">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded">Rapat
                                Rutin</span>
                        </div>
                        <a href="/notulensi/detail" class="inline-block">
                            <h3
                                class="text-xl font-bold text-gray-900 group-hover:text-purple-600 transition-colors mb-2">
                                Pembentukan Satgas Bank Sampah
                            </h3>
                        </a>
                        <p class="text-gray-600 text-sm leading-relaxed mb-4 line-clamp-2">
                            Pemilihan ketua satgas dan pemaparan sistem bagi hasil untuk
                            warga yang mengumpulkan sampah botol plastik dan kardus bekas.
                            Disepakati lokasi penimbangan berada di sebelah Balai RW.
                        </p>
                        <a href="/notulensi/detail"
                            class="text-sm font-bold text-purple-600 hover:text-purple-700 flex items-center gap-1 w-max">
                            Baca Detail
                            <span class="transform group-hover:translate-x-1 transition-transform">&rarr;</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Pagination Container -->
            <div class="mt-12 flex justify-center items-center gap-2">
                <button
                    class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-300 text-gray-400 cursor-not-allowed"
                    disabled>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                        </path>
                    </svg>
                </button>
                <button
                    class="w-10 h-10 flex items-center justify-center rounded-lg bg-purple-600 text-white font-bold shadow-md">
                    1
                </button>
                <button
                    class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-300 hover:bg-gray-50 text-gray-700 font-medium transition">
                    2
                </button>
                <button
                    class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-300 hover:bg-gray-50 text-gray-700 font-medium transition">
                    3
                </button>
                <span class="text-gray-400 px-1">...</span>
                <button
                    class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-300 hover:bg-gray-50 text-gray-700 font-medium transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- FOOTER SIMPLE -->
    <footer class="bg-gray-900 py-8 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-gray-400 text-sm">
                &copy; 2026 Sistem Informasi RW 21. Seluruh Hak Cipta Dilindungi.
            </p>
        </div>
    </footer>
</body>

</html>
