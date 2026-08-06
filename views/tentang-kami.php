<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tentang Kami - Sistem Informasi RW 21</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <style>
        body {
            font-family: "Plus Jakarta Sans", sans-serif;
        }

        .logo-container {
            border-radius: 0 0 24px 24px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
            border: 1px solid #e9d5ff;
            border-top-width: 0;
        }

        /* Animasi untuk modal */
        @keyframes fadeInZoom {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .animate-in {
            animation: fadeInZoom 0.25s ease-out forwards;
        }

        /* Scrollbar halus untuk modal */
        #postModal .overflow-y-auto::-webkit-scrollbar {
            width: 4px;
        }

        #postModal .overflow-y-auto::-webkit-scrollbar-track {
            background: transparent;
        }

        #postModal .overflow-y-auto::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 8px;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- NAVBAR -->
    <nav class="bg-white border-b border-purple-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-24">
                <!-- Logo Area -->
                <div
                    class="flex-shrink-0 h-32 w-32 bg-white logo-container flex flex-col items-center justify-center p-2 z-10">
                    <div
                        class="w-16 h-16 bg-purple-600 rounded-full flex items-center justify-center text-white font-bold text-xl mb-1 shadow-md">
                        RW 21
                    </div>
                    <span
                        class="text-[10px] text-center font-semibold text-gray-600 leading-tight">SISTEM<br />INFORMASI</span>
                </div>

                <!-- Text Info Kiri -->
                <div class="hidden md:flex flex-col ml-6 text-sm font-medium">
                    <span class="text-purple-700">#Kompak Bersama</span>
                    <span class="text-emerald-600 font-semibold">#Lingkungan Asri & Aman</span>
                    <span class="text-purple-500">Pelayanan Digital 2026</span>
                </div>

                <!-- Menu Navigasi -->
                <div class="hidden md:flex flex-1 justify-end items-center space-x-6 text-gray-600 font-medium text-sm">
                    <a href="index.html" class="hover:text-purple-600 transition">Beranda</a>
                    <a href="tentang-kami.html"
                        class="hover:text-purple-600 font-semibold text-purple-700 transition">Tentang Kami</a>
                    <a href="#" class="hover:text-purple-600 transition">Layanan</a>
                    <a href="notulensi.html" class="hover:text-purple-600 transition">Informasi</a>
                    <a href="#"
                        class="bg-emerald-50 text-emerald-700 px-4 py-2 rounded-full font-bold flex items-center gap-1 border border-emerald-200 hover:bg-emerald-100 transition shadow-sm">
                        Hubungi Kami
                        <svg class="w-4 h-4 text-emerald-600 ml-1" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- PAGE HEADER -->
    <div class="bg-purple-50 py-16 border-b border-purple-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 tracking-tight mb-4">
                Mengenal Lebih Dekat <span class="text-purple-600">RW 21</span>
            </h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Ruang informasi tentang arah gerak, rutinitas, dan kekompakan warga
                dalam mewujudkan lingkungan yang asri dan aman.
            </p>
        </div>
    </div>

    <!-- VISI & MISI SECTION (Arah Gerak) -->
    <div class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-extrabold text-black tracking-tight sm:text-4xl">
                    Arah Gerak <span class="text-purple-600">RW 21</span>
                </h2>
                <p class="mt-4 max-w-2xl text-lg text-gray-500 mx-auto">
                    Bersama mewujudkan lingkungan yang aman, asri, dan adaptif terhadap
                    perkembangan teknologi digital.
                </p>
            </div>
            <div class="flex flex-wrap gap-1 md:gap-2">
                <button
                    class="px-6 py-3 bg-gradient-to-r from-purple-600 to-purple-500 text-white font-semibold rounded-t-xl md:rounded-t-2xl shadow-sm focus:outline-none transition-all">
                    Visi
                </button>
                <button
                    class="px-6 py-3 bg-purple-100 text-purple-700 font-medium rounded-t-xl md:rounded-t-2xl hover:bg-purple-200 focus:outline-none transition-all">
                    Misi Utama
                </button>
                <button
                    class="px-6 py-3 bg-purple-100 text-purple-700 font-medium rounded-t-xl md:rounded-t-2xl hover:bg-purple-200 focus:outline-none transition-all">
                    Program Kerja
                </button>
            </div>
            <div
                class="bg-gradient-to-br from-purple-600 via-purple-700 to-purple-900 rounded-b-2xl rounded-tr-2xl p-6 md:p-10 shadow-xl overflow-hidden relative">
                <div class="absolute inset-0 opacity-10" style="
              background-image: radial-gradient(
                circle at 2px 2px,
                white 1px,
                transparent 0
              );
              background-size: 24px 24px;
            "></div>
                <div class="relative z-10 flex flex-col md:flex-row gap-8 items-center">
                    <div class="w-full md:w-1/3">
                        <h3 class="text-4xl font-bold text-white mb-2">Visi Kami</h3>
                        <p class="text-purple-100 font-medium text-sm mb-4">
                            Tujuan utama yang ingin dicapai oleh kepengurusan RW 21 untuk
                            masa depan.
                        </p>
                        <span
                            class="inline-block px-3 py-1 bg-emerald-500 text-white rounded-full text-xs font-bold tracking-wide">#RW21Maju</span>
                    </div>
                    <div class="w-full md:w-2/3 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div
                            class="bg-white/10 backdrop-blur-md border border-white/20 p-6 rounded-xl hover:bg-white/20 transition-all">
                            <div
                                class="w-12 h-12 bg-emerald-400 rounded-lg flex items-center justify-center mb-4 shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9">
                                    </path>
                                </svg>
                            </div>
                            <h4 class="text-lg font-bold text-white mb-2">
                                Digitalisasi Pelayanan
                            </h4>
                            <p class="text-purple-100 text-sm leading-relaxed">
                                Mewujudkan sistem administrasi kependudukan yang cepat,
                                transparan, dan dapat diakses 24/7 melalui portal warga.
                            </p>
                        </div>
                        <div
                            class="bg-white/10 backdrop-blur-md border border-white/20 p-6 rounded-xl hover:bg-white/20 transition-all">
                            <div
                                class="w-12 h-12 bg-emerald-400 rounded-lg flex items-center justify-center mb-4 shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                    </path>
                                </svg>
                            </div>
                            <h4 class="text-lg font-bold text-white mb-2">
                                Lingkungan Inklusif
                            </h4>
                            <p class="text-purple-100 text-sm leading-relaxed">
                                Membangun komunitas warga yang saling peduli, guyub rukun, dan
                                menjunjung tinggi nilai toleransi antar tetangga.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JADWAL KEGIATAN RUTIN -->
    <div class="py-20 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <span
                    class="inline-flex items-center justify-center gap-1.5 px-3 py-1 bg-white text-gray-600 rounded-full text-xs font-bold tracking-wide uppercase mb-4 border border-gray-200 shadow-sm">
                    <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    Panduan Mingguan Warga
                </span>
                <h2 class="text-3xl font-extrabold text-black tracking-tight sm:text-4xl">
                    Jadwal <span class="text-purple-600">Kegiatan Rutin</span>
                </h2>
                <p class="mt-4 max-w-2xl text-lg text-gray-500 mx-auto">
                    Jadwal tetap pelayanan administrasi, keamanan, kebersihan, dan
                    aktivitas sosial warga RW 21.
                </p>
            </div>

            <!-- LEGENDA KATEGORI -->
            <div class="flex flex-wrap justify-center gap-4 mb-10">
                <div class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    <span class="text-sm font-medium text-gray-600">Administrasi</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                        </path>
                    </svg>
                    <span class="text-sm font-medium text-gray-600">Kebersihan</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                        </path>
                    </svg>
                    <span class="text-sm font-medium text-gray-600">Keamanan</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                        </path>
                    </svg>
                    <span class="text-sm font-medium text-gray-600">Sosial & Kesehatan</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                        </path>
                    </svg>
                    <span class="text-sm font-medium text-gray-600">Keagamaan</span>
                </div>
            </div>

            <!-- GRID 7 HARI -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-7 gap-4">
                <!-- Senin -->
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm flex flex-col overflow-hidden">
                    <div class="bg-gray-50 border-b border-gray-200 px-4 py-3 text-center">
                        <span class="text-xs font-bold text-gray-700 uppercase tracking-widest">Senin</span>
                    </div>
                    <div class="p-3 flex-1 flex flex-col gap-3">
                        <div
                            class="border border-gray-100 rounded-lg p-3 hover:border-purple-200 hover:bg-gray-50 transition-colors">
                            <div class="flex items-start gap-2 mb-2">
                                <div class="mt-0.5 text-purple-500 flex-shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                </div>
                                <span class="text-sm font-bold text-gray-900 leading-tight">Pelayanan &
                                    Administrasi</span>
                            </div>
                            <p class="text-[11px] text-gray-500 mb-3 leading-relaxed">
                                Surat pengantar, KTP, dll.
                            </p>
                            <div class="flex flex-col gap-1.5">
                                <div class="flex items-center text-[11px] font-medium text-gray-500">
                                    <svg class="w-3.5 h-3.5 mr-1.5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    19.00 - 21.00
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Selasa -->
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm flex flex-col overflow-hidden">
                    <div class="bg-gray-50 border-b border-gray-200 px-4 py-3 text-center">
                        <span class="text-xs font-bold text-gray-700 uppercase tracking-widest">Selasa</span>
                    </div>
                    <div class="p-3 flex-1 flex flex-col gap-3">
                        <div
                            class="border border-gray-100 rounded-lg p-3 hover:border-purple-200 hover:bg-gray-50 transition-colors">
                            <div class="flex items-start gap-2 mb-2">
                                <div class="mt-0.5 text-purple-500 flex-shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z">
                                        </path>
                                    </svg>
                                </div>
                                <span class="text-sm font-bold text-gray-900 leading-tight">Rapat Koordinasi</span>
                            </div>
                            <p class="text-[11px] text-gray-500 mb-3 leading-relaxed">
                                Minggu ke-1
                            </p>
                            <div class="flex flex-col gap-1.5">
                                <div class="flex items-center text-[11px] font-medium text-gray-500">
                                    <svg class="w-3.5 h-3.5 mr-1.5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    20.00 WIB
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rabu -->
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm flex flex-col overflow-hidden">
                    <div class="bg-gray-50 border-b border-gray-200 px-4 py-3 text-center">
                        <span class="text-xs font-bold text-gray-700 uppercase tracking-widest">Rabu</span>
                    </div>
                    <div class="p-3 flex-1 flex flex-col gap-3">
                        <div
                            class="border border-gray-100 rounded-lg p-3 hover:border-purple-200 hover:bg-gray-50 transition-colors">
                            <div class="flex items-start gap-2 mb-2">
                                <div class="mt-0.5 text-emerald-500 flex-shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                </div>
                                <span class="text-sm font-bold text-gray-900 leading-tight">Angkut Sampah</span>
                            </div>
                            <p class="text-[11px] text-gray-500 mb-3 leading-relaxed">
                                Oleh petugas DLH
                            </p>
                            <div class="flex flex-col gap-1.5">
                                <div class="flex items-center text-[11px] font-medium text-gray-500">
                                    <svg class="w-3.5 h-3.5 mr-1.5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    07.00 - 10.00
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kamis -->
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm flex flex-col overflow-hidden">
                    <div class="bg-gray-50 border-b border-gray-200 px-4 py-3 text-center">
                        <span class="text-xs font-bold text-gray-700 uppercase tracking-widest">Kamis</span>
                    </div>
                    <div class="p-3 flex-1 flex flex-col gap-3">
                        <div
                            class="border border-gray-100 rounded-lg p-3 hover:border-purple-200 hover:bg-gray-50 transition-colors">
                            <div class="flex items-start gap-2 mb-2">
                                <div class="mt-0.5 text-sky-500 flex-shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                        </path>
                                    </svg>
                                </div>
                                <span class="text-sm font-bold text-gray-900 leading-tight">Pengajian Warga</span>
                            </div>
                            <p class="text-[11px] text-gray-500 mb-3 leading-relaxed">
                                Kajian rutin mingguan
                            </p>
                            <div class="flex flex-col gap-1.5">
                                <div class="flex items-center text-[11px] font-medium text-gray-500">
                                    <svg class="w-3.5 h-3.5 mr-1.5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Ba'da Isya
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Jumat -->
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm flex flex-col overflow-hidden">
                    <div class="bg-gray-50 border-b border-gray-200 px-4 py-3 text-center">
                        <span class="text-xs font-bold text-gray-700 uppercase tracking-widest">Jumat</span>
                    </div>
                    <div class="p-3 flex-1 flex flex-col gap-3">
                        <div
                            class="border border-gray-100 rounded-lg p-3 hover:border-purple-200 hover:bg-gray-50 transition-colors">
                            <div class="flex items-start gap-2 mb-2">
                                <div class="mt-0.5 text-amber-500 flex-shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                        </path>
                                    </svg>
                                </div>
                                <span class="text-sm font-bold text-gray-900 leading-tight">Ronda Malam Grup 1</span>
                            </div>
                            <div class="flex items-center text-[11px] font-medium text-gray-500">
                                <svg class="w-3.5 h-3.5 mr-1.5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                22.00 - 04.00
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sabtu -->
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm flex flex-col overflow-hidden">
                    <div class="bg-gray-50 border-b border-gray-200 px-4 py-3 text-center">
                        <span class="text-xs font-bold text-gray-700 uppercase tracking-widest">Sabtu</span>
                    </div>
                    <div class="p-3 flex-1 flex flex-col gap-3">
                        <div
                            class="border border-gray-100 rounded-lg p-3 hover:border-purple-200 hover:bg-gray-50 transition-colors">
                            <div class="flex items-start gap-2 mb-2">
                                <div class="mt-0.5 text-rose-500 flex-shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                        </path>
                                    </svg>
                                </div>
                                <span class="text-sm font-bold text-gray-900 leading-tight">Senam Pagi</span>
                            </div>
                            <div class="flex items-center text-[11px] font-medium text-gray-500">
                                <svg class="w-3.5 h-3.5 mr-1.5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                06.30 WIB
                            </div>
                        </div>
                        <div
                            class="border border-gray-100 rounded-lg p-3 hover:border-purple-200 hover:bg-gray-50 transition-colors">
                            <div class="flex items-start gap-2 mb-2">
                                <div class="mt-0.5 text-amber-500 flex-shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                        </path>
                                    </svg>
                                </div>
                                <span class="text-sm font-bold text-gray-900 leading-tight">Ronda Grup 2</span>
                            </div>
                            <div class="flex items-center text-[11px] font-medium text-gray-500">
                                <svg class="w-3.5 h-3.5 mr-1.5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                22.00 - 04.00
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Minggu -->
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm flex flex-col overflow-hidden">
                    <div class="bg-gray-50 border-b border-gray-200 px-4 py-3 text-center">
                        <span class="text-xs font-bold text-gray-700 uppercase tracking-widest">Minggu</span>
                    </div>
                    <div class="p-3 flex-1 flex flex-col gap-3">
                        <div
                            class="border border-gray-100 rounded-lg p-3 hover:border-purple-200 hover:bg-gray-50 transition-colors">
                            <div class="flex items-start gap-2 mb-2">
                                <div class="mt-0.5 text-emerald-500 flex-shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                </div>
                                <span class="text-sm font-bold text-gray-900 leading-tight">Kerja Bakti</span>
                            </div>
                            <div class="flex items-center text-[11px] font-medium text-gray-500">
                                <svg class="w-3.5 h-3.5 mr-1.5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                07.00 WIB (Mg ke-1)
                            </div>
                        </div>
                        <div
                            class="border border-gray-100 rounded-lg p-3 hover:border-purple-200 hover:bg-gray-50 transition-colors">
                            <div class="flex items-start gap-2 mb-2">
                                <div class="mt-0.5 text-rose-500 flex-shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                        </path>
                                    </svg>
                                </div>
                                <span class="text-sm font-bold text-gray-900 leading-tight">Posyandu</span>
                            </div>
                            <div class="flex items-center text-[11px] font-medium text-gray-500">
                                <svg class="w-3.5 h-3.5 mr-1.5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                08.00 WIB (Mg ke-2)
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Catatan Kaki -->
            <div class="mt-10 bg-white rounded-xl border border-gray-200 p-5 max-w-3xl mx-auto shadow-sm">
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 bg-purple-50 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-gray-900 mb-1">
                            Catatan Penting
                        </h4>
                        <ul class="text-xs text-gray-500 space-y-1.5 list-disc list-inside">
                            <li>
                                Jadwal dapat berubah sewaktu-waktu. Pantau selalu pengumuman
                                di grup WhatsApp RW.
                            </li>
                            <li>
                                Untuk layanan administrasi di luar jam, silakan hubungi Ketua
                                RT masing-masing.
                            </li>
                            <li>
                                Ronda malam wajib diikuti sesuai jadwal. Jika berhalangan,
                                harap mencari pengganti.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- KEGIATAN UNGGULAN SECTION (Galeri) -->
    <div class="py-20 bg-purple-800 relative z-10 border-t border-purple-900/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-extrabold text-white tracking-tight sm:text-4xl">
                    Galeri <span class="text-emerald-400">Kegiatan</span> Warga
                </h2>
                <p class="mt-4 max-w-2xl text-lg text-purple-200 mx-auto">
                    Dokumentasi berbagai program dan aktivitas yang membangun kerukunan
                    serta kesejahteraan bersama.
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div onclick="openModal('https://images.unsplash.com/photo-1528605248644-14dd04022da1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80', 'Kerja Bakti Bulanan', '03 Agustus 2026', 'Kegiatan gotong royong membersihkan lingkungan, saluran air, dan fasilitas umum setiap hari Minggu di minggu pertama. Kegiatan ini diikuti oleh warga dari RT 01 hingga RT 05 untuk menjaga kebersihan dan mengantisipasi genangan air di musim hujan.')"
                    class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 cursor-pointer group">
                    <div class="overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1528605248644-14dd04022da1?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                            alt="Kerja Bakti"
                            class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-500" />
                        <div
                            class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center text-white font-medium text-sm gap-1">
                            <span>🔍 Klik untuk detail</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-purple-600 transition-colors">
                            Kerja Bakti Bulanan
                        </h3>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Kegiatan gotong royong membersihkan lingkungan, saluran air, dan
                            fasilitas umum.
                        </p>
                    </div>
                </div>
                <!-- Card 2 -->
                <div onclick="openModal('https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80', 'Posyandu & Lansia', '27 Juli 2026', 'Pelayanan kesehatan gratis untuk balita, ibu hamil, dan pemeriksaan kesehatan rutin bagi warga lanjut usia setiap bulan. Bekerja sama dengan Puskesmas setempat untuk menyediakan penimbangan balita, vitamin, serta cek tensi dan gula darah.')"
                    class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 cursor-pointer group">
                    <div class="overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                            alt="Posyandu"
                            class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-500" />
                        <div
                            class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center text-white font-medium text-sm gap-1">
                            <span>🔍 Klik untuk detail</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-purple-600 transition-colors">
                            Posyandu & Lansia
                        </h3>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Pelayanan kesehatan gratis untuk balita, ibu hamil, dan
                            pemeriksaan rutin lansia.
                        </p>
                    </div>
                </div>
                <!-- Card 3 -->
                <div onclick="openModal('https://images.unsplash.com/photo-1531206715517-5c0ba140b2b8?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80', 'Bazar UMKM Warga', '15 Juli 2026', 'Mendukung perputaran ekonomi warga melalui bazar makanan dan kerajinan lokal pada setiap perayaan hari besar nasional. Diikuti lebih dari 20 pelaku UMKM lokal RW 21 untuk mempromosikan produk unggulan rumahan.')"
                    class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 cursor-pointer group">
                    <div class="overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1531206715517-5c0ba140b2b8?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                            alt="UMKM"
                            class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-500" />
                        <div
                            class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center text-white font-medium text-sm gap-1">
                            <span>🔍 Klik untuk detail</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-purple-600 transition-colors">
                            Bazar UMKM Warga
                        </h3>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Mendukung perputaran ekonomi warga melalui bazar makanan dan
                            kerajinan lokal.
                        </p>
                    </div>
                </div>
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

    <!-- MODAL POPUP INSTAGRAM STYLE -->
    <div id="postModal"
        class="fixed inset-0 bg-black/80 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4 transition-all duration-300">
        <div
            class="bg-white rounded-2xl overflow-hidden max-w-4xl w-full max-h-[90vh] flex flex-col md:flex-row shadow-2xl relative animate-in">
            <button onclick="closeModal()"
                class="absolute top-3 right-3 z-20 w-9 h-9 bg-black/50 hover:bg-black/80 text-white rounded-full flex items-center justify-center md:bg-gray-100 md:text-gray-600 md:hover:bg-gray-200 transition">
                ✕
            </button>
            <div class="w-full md:w-3/5 bg-black flex items-center justify-center min-h-[250px] md:min-h-[500px]">
                <img id="modalImage" src="" alt="Detail Kegiatan"
                    class="w-full h-full object-cover max-h-[60vh] md:max-h-[80vh]" />
            </div>
            <div class="w-full md:w-2/3 p-6 flex flex-col justify-between bg-white overflow-y-auto">
                <div>
                    <div class="flex items-center gap-3 border-b border-gray-100 pb-4 mb-4">
                        <div
                            class="w-10 h-10 bg-purple-600 rounded-full flex items-center justify-center text-white font-bold text-xs">
                            RW21
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 text-sm leading-tight">
                                Pengurus RW 21
                            </h4>
                            <p id="modalDate" class="text-xs text-gray-500 mt-0.5"></p>
                        </div>
                        <span
                            class="ml-auto px-2.5 py-1 bg-emerald-100 text-emerald-800 text-[11px] font-bold rounded-full">Kegiatan</span>
                    </div>
                    <h3 id="modalTitle" class="text-2xl font-extrabold text-gray-900 mb-3"></h3>
                    <p id="modalDescription" class="text-gray-600 text-sm leading-relaxed whitespace-pre-line mb-6"></p>
                </div>
                <div class="border-t border-gray-100 pt-4 mt-auto">
                    <div class="flex items-center justify-between text-gray-500 text-xs">
                        <span class="flex items-center gap-1 text-emerald-600 font-semibold">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Terbuka Untuk Warga
                        </span>
                        <button onclick="closeModal()"
                            class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-lg text-xs transition">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT UNTUK MODAL -->
    <script>
        function openModal(imageSrc, title, date, description) {
            document.getElementById("modalImage").src = imageSrc;
            document.getElementById("modalTitle").innerText = title;
            document.getElementById("modalDate").innerText = date;
            document.getElementById("modalDescription").innerText = description;
            const modal = document.getElementById("postModal");
            modal.classList.remove("hidden");
            document.body.style.overflow = "hidden";
        }

        function closeModal() {
            const modal = document.getElementById("postModal");
            modal.classList.add("hidden");
            document.body.style.overflow = "auto";
        }

        document
            .getElementById("postModal")
            .addEventListener("click", function (e) {
                if (e.target === this) closeModal();
            });

        document.addEventListener("keydown", function (e) {
            if (e.key === "Escape") closeModal();
        });
    </script>
</body>

</html>
