<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dasbor Pengurus - Sistem Informasi RW 21</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <style>
        body {
            font-family: "Plus Jakarta Sans", sans-serif;
            background-color: #f8fafc;
        }

        .logo-container {
            border-radius: 0 0 16px 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            border: 1px solid #e9d5ff;
            border-top-width: 0;
        }

        /* Custom scrollbar untuk sidebar */
        .sidebar-scroll::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar-scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar-scroll::-webkit-scrollbar-thumb {
            background: #e5e7eb;
            border-radius: 4px;
        }
    </style>
</head>

<body class="text-gray-800 flex flex-col min-h-screen">
    <!-- TOP NAVBAR KHUSUS ADMIN -->
    <nav class="bg-white border-b border-purple-200 sticky top-0 z-50 shadow-sm">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo & Branding -->
                <div class="flex items-center gap-4">
                    <!-- Hamburger Icon (Mobile Only) -->
                    <button class="lg:hidden text-gray-500 hover:text-purple-600 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>

                    <div
                        class="flex-shrink-0 h-24 w-20 bg-white logo-container hidden sm:flex flex-col items-center justify-center p-2 z-10">
                        <div
                            class="w-10 h-10 bg-purple-600 rounded-full flex items-center justify-center text-white font-bold text-sm mb-1 shadow-md">
                            RW
                        </div>
                        <span class="text-[8px] text-center font-bold text-gray-600 leading-tight">ADMIN</span>
                    </div>
                    <div>
                        <h1 class="text-lg font-extrabold text-gray-900 leading-tight">
                            Dasbor Pengurus
                        </h1>
                        <p class="text-xs text-gray-500 font-medium">
                            Sistem Informasi RW 21
                        </p>
                    </div>
                </div>

                <!-- Admin Profile Menu -->
                <div class="flex items-center gap-4">
                    <div class="hidden sm:block text-right">
                        <p class="text-sm font-bold text-gray-900">Ahmad Santoso</p>
                        <p class="text-xs text-purple-600 font-medium">Ketua RW</p>
                    </div>
                    <img src="https://ui-avatars.com/api/?name=Ahmad+Santoso&background=7c3aed&color=fff" alt="Admin"
                        class="w-10 h-10 rounded-full border-2 border-purple-100 shadow-sm" />
                    <!-- Tombol Keluar -->
                    <a href="login.html" class="ml-2 p-2 text-rose-500 hover:bg-rose-50 rounded-lg transition"
                        title="Keluar">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- WRAPPER UNTUK SIDEBAR & MAIN CONTENT -->
    <div class="flex flex-1 max-w-[1400px] w-full mx-auto">
        <!-- SIDEBAR (KIRI) -->
        <aside
            class="hidden lg:block w-64 flex-shrink-0 bg-white border-r border-gray-200 h-[calc(100vh-5rem)] sticky top-20 sidebar-scroll overflow-y-auto">
            <div class="p-5 flex flex-col gap-2">
                <p class="text-[10px] font-extrabold text-gray-400 uppercase tracking-widest px-3 mb-1 mt-2">
                    Menu Utama
                </p>

                <!-- Menu Active -->
                <a href="dashboard.html"
                    class="flex items-center gap-3 px-3 py-2.5 bg-purple-50 text-purple-700 rounded-lg font-bold text-sm transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                        </path>
                    </svg>
                    Dasbor Utama
                </a>

                <a href="daftar-warga.html"
                    class="flex items-center gap-3 px-3 py-2.5 text-gray-600 hover:bg-gray-50 hover:text-purple-600 rounded-lg font-medium text-sm transition group">
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-purple-500 transition" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                    Data Penduduk
                </a>

                <a href="#"
                    class="flex items-center gap-3 px-3 py-2.5 text-gray-600 hover:bg-gray-50 hover:text-purple-600 rounded-lg font-medium text-sm transition group">
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-purple-500 transition" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z">
                        </path>
                    </svg>
                    Pengumuman
                </a>

                <p class="text-[10px] font-extrabold text-gray-400 uppercase tracking-widest px-3 mb-1 mt-4">
                    Arsip & Dokumentasi
                </p>

                <a href="notulensi.html"
                    class="flex items-center gap-3 px-3 py-2.5 text-gray-600 hover:bg-gray-50 hover:text-purple-600 rounded-lg font-medium text-sm transition group">
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-purple-500 transition" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    Notulensi Rapat
                </a>

                <a href="galeri.html"
                    class="flex items-center gap-3 px-3 py-2.5 text-gray-600 hover:bg-gray-50 hover:text-purple-600 rounded-lg font-medium text-sm transition group">
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-purple-500 transition" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    Galeri Kegiatan
                </a>

                <a href="#"
                    class="flex items-center gap-3 px-3 py-2.5 text-gray-600 hover:bg-gray-50 hover:text-purple-600 rounded-lg font-medium text-sm transition group">
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-purple-500 transition" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    Jadwal Rutin
                </a>
            </div>

            <div class="p-5 mt-auto border-t border-gray-100">
                <a href="index.html" target="_blank"
                    class="flex items-center justify-center gap-2 px-3 py-2 bg-gray-900 text-white rounded-lg text-sm font-semibold hover:bg-gray-800 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                    Lihat Web Warga
                </a>
            </div>
        </aside>

        <!-- MAIN CONTENT (KANAN) -->
        <main class="flex-1 w-full min-w-0 p-4 sm:p-6 lg:p-10">
            <!-- Welcome Header -->
            <div class="mb-8">
                <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                    Selamat Datang, Bapak Ahmad!
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Berikut adalah ringkasan data dan menu manajemen Sistem Informasi RW
                    21.
                </p>
            </div>

            <!-- STATISTIK CEPAT -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 mb-10">
                <!-- Stat 1 -->
                <div
                    class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4 hover:-translate-y-1 transition-transform">
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">
                            Total Warga
                        </p>
                        <h3 class="text-2xl font-extrabold text-gray-900">1.245</h3>
                    </div>
                </div>
                <!-- Stat 2 -->
                <div
                    class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4 hover:-translate-y-1 transition-transform">
                    <div class="w-12 h-12 bg-emerald-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">
                            Kepala Keluarga
                        </p>
                        <h3 class="text-2xl font-extrabold text-gray-900">350</h3>
                    </div>
                </div>
                <!-- Stat 3 -->
                <div
                    class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4 hover:-translate-y-1 transition-transform">
                    <div class="w-12 h-12 bg-sky-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">
                            Pengumuman Aktif
                        </p>
                        <h3 class="text-2xl font-extrabold text-gray-900">3</h3>
                    </div>
                </div>
                <!-- Stat 4 -->
                <div
                    class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4 hover:-translate-y-1 transition-transform">
                    <div class="w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">
                            Arsip Rapat
                        </p>
                        <h3 class="text-2xl font-extrabold text-gray-900">24</h3>
                    </div>
                </div>
            </div>

            <!-- MENU MANAJEMEN -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Menu 1: Penduduk -->
                <div
                    class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 hover:shadow-lg transition flex flex-col h-full group">
                    <div class="flex items-center gap-4 mb-4">
                        <div
                            class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center text-purple-600 group-hover:bg-purple-600 group-hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Data Penduduk</h3>
                    </div>
                    <p class="text-sm text-gray-500 flex-1 mb-6">
                        Kelola data warga, Kepala Keluarga, dan status domisili penduduk
                        RW 21.
                    </p>
                    <div class="grid grid-cols-2 gap-2 mt-auto">
                        <a href="daftar-warga.html"
                            class="text-center px-4 py-2 bg-gray-50 text-gray-700 text-sm font-semibold border border-gray-200 rounded-lg hover:bg-gray-100 transition">Lihat
                            Data</a>
                        <a href="tambah-warga.html"
                            class="text-center px-4 py-2 bg-purple-50 text-purple-700 text-sm font-semibold border border-purple-200 rounded-lg hover:bg-purple-100 transition">+
                            Tambah</a>
                    </div>
                </div>

                <!-- Menu 2: Pengumuman -->
                <div
                    class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 hover:shadow-lg transition flex flex-col h-full group">
                    <div class="flex items-center gap-4 mb-4">
                        <div
                            class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Pengumuman</h3>
                    </div>
                    <p class="text-sm text-gray-500 flex-1 mb-6">
                        Buat siaran dan informasi penting untuk ditampilkan di halaman
                        Beranda warga.
                    </p>
                    <div class="grid grid-cols-2 gap-2 mt-auto">
                        <a href="#"
                            class="text-center px-4 py-2 bg-gray-50 text-gray-700 text-sm font-semibold border border-gray-200 rounded-lg hover:bg-gray-100 transition">Kelola</a>
                        <a href="tambah-pengumuman.html"
                            class="text-center px-4 py-2 bg-emerald-50 text-emerald-700 text-sm font-semibold border border-emerald-200 rounded-lg hover:bg-emerald-100 transition">+
                            Buat Baru</a>
                    </div>
                </div>

                <!-- Menu 3: Notulensi -->
                <div
                    class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 hover:shadow-lg transition flex flex-col h-full group">
                    <div class="flex items-center gap-4 mb-4">
                        <div
                            class="w-12 h-12 bg-sky-100 rounded-xl flex items-center justify-center text-sky-600 group-hover:bg-sky-600 group-hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Arsip Notulensi</h3>
                    </div>
                    <p class="text-sm text-gray-500 flex-1 mb-6">
                        Dokumentasikan dan kelola hasil rapat pengurus maupun rapat rutin
                        warga.
                    </p>
                    <div class="grid grid-cols-2 gap-2 mt-auto">
                        <a href="notulensi.html"
                            class="text-center px-4 py-2 bg-gray-50 text-gray-700 text-sm font-semibold border border-gray-200 rounded-lg hover:bg-gray-100 transition">Lihat
                            Arsip</a>
                        <a href="tambah-notulensi.html"
                            class="text-center px-4 py-2 bg-sky-50 text-sky-700 text-sm font-semibold border border-sky-200 rounded-lg hover:bg-sky-100 transition">+
                            Tambah</a>
                    </div>
                </div>

                <!-- Menu 4: Galeri -->
                <div
                    class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 hover:shadow-lg transition flex flex-col h-full group">
                    <div class="flex items-center gap-4 mb-4">
                        <div
                            class="w-12 h-12 bg-rose-100 rounded-xl flex items-center justify-center text-rose-600 group-hover:bg-rose-600 group-hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Galeri Kegiatan</h3>
                    </div>
                    <p class="text-sm text-gray-500 flex-1 mb-6">
                        Unggah dan kelola foto dokumentasi kegiatan untuk ditampilkan di
                        portal.
                    </p>
                    <div class="grid grid-cols-2 gap-2 mt-auto">
                        <a href="galeri.html"
                            class="text-center px-4 py-2 bg-gray-50 text-gray-700 text-sm font-semibold border border-gray-200 rounded-lg hover:bg-gray-100 transition">Lihat
                            Galeri</a>
                        <a href="tambah-galeri.html"
                            class="text-center px-4 py-2 bg-rose-50 text-rose-700 text-sm font-semibold border border-rose-200 rounded-lg hover:bg-rose-100 transition">+
                            Unggah</a>
                    </div>
                </div>

                <!-- Menu 5: Jadwal Rutin -->
                <div
                    class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 hover:shadow-lg transition flex flex-col h-full group">
                    <div class="flex items-center gap-4 mb-4">
                        <div
                            class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center text-amber-600 group-hover:bg-amber-600 group-hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Jadwal Mingguan</h3>
                    </div>
                    <p class="text-sm text-gray-500 flex-1 mb-6">
                        Atur jadwal kegiatan rutin harian atau mingguan seperti ronda dan
                        posyandu.
                    </p>
                    <div class="grid grid-cols-2 gap-2 mt-auto">
                        <a href="#"
                            class="text-center px-4 py-2 bg-gray-50 text-gray-700 text-sm font-semibold border border-gray-200 rounded-lg hover:bg-gray-100 transition">Kelola</a>
                        <a href="tambah-kegiatan.html"
                            class="text-center px-4 py-2 bg-amber-50 text-amber-700 text-sm font-semibold border border-amber-200 rounded-lg hover:bg-amber-100 transition">+
                            Tambah</a>
                    </div>
                </div>

                <!-- Menu 6: Layanan Surat (Coming Soon) -->
                <div
                    class="bg-gray-50 rounded-2xl border border-dashed border-gray-300 shadow-sm p-6 flex flex-col h-full opacity-60">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 bg-gray-200 rounded-xl flex items-center justify-center text-gray-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Layanan Surat</h3>
                        <span
                            class="px-2 py-0.5 bg-gray-200 text-gray-600 text-[10px] font-bold rounded uppercase">Segera</span>
                    </div>
                    <p class="text-sm text-gray-500 flex-1">
                        Fitur manajemen pengajuan surat pengantar warga secara digital
                        (Masih dalam tahap pengembangan).
                    </p>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
