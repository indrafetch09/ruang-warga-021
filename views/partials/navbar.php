<?php
if (!function_exists('navClass')) {
    function navClass(string $path): string {
        $uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
        $isActive = ($path === '/' && $uri === '/')
                 || ($path !== '/' && str_starts_with($uri, $path));

        return $isActive
            ? 'font-bold text-purple-700 transition'
            : 'font-medium text-gray-700 hover:text-purple-600 transition';
    }
}
$currentUri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);

$isProfilActive  = str_starts_with($currentUri, '/tentang-kami') || str_starts_with($currentUri, '/pengurus-rw') || str_starts_with($currentUri, '/galeri');
$isLayananActive = str_starts_with($currentUri, '/layanan') || str_starts_with($currentUri, '/tpst');
$isInfoActive    = str_starts_with($currentUri, '/notulensi') || str_starts_with($currentUri, '/statistik') || str_starts_with($currentUri, '/lokasi') || str_starts_with($currentUri, '/maps');
?>
<!-- NAVBAR UTAMA (Berdasarkan spesifikasi docs/features/users.md) -->
<nav class="bg-white border-b border-purple-100 sticky top-0 z-50 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-24">

            <!-- Logo Area -->
            <a href="/" class="flex items-center gap-3 sm:pl-10 pl-0 group">
                <div class="flex-shrink-0 h-100 w-28 bg-white logo-container flex flex-col items-center justify-center p-2 z-10 border border-purple-200 shadow-md rounded-b-2xl group-hover:border-purple-400 transition">
                    <div class="w-14 h-14 bg-purple-600 rounded-full flex items-center justify-center text-white font-bold text-center text-xs leading-tight mb-1 shadow-md group-hover:scale-105 transition p-1">
                        <!--Logo RW 021-->
                        Ruang Warga 021
                    </div>
                    <span class="text-[9px] text-center font-bold text-gray-700 leading-tight">RUANG<br />WARGA 021</span>
                </div>
            </a>

            <!-- Menu Navigasi (Desktop) -->
            <div class="hidden md:flex flex-1 justify-end items-center space-x-6 text-gray-700 text-base">

                <!-- 1. Beranda -->
                <a href="/" class="<?= navClass('/') ?>">Beranda</a>

                <!-- 2. Profil RW (Dropdown) -->
                <!-- ponytail: inline SVG icons added directly for dropdown items without heavy icon library dependency -->
                <div class="relative group py-2">
                    <button class="flex items-center gap-1 transition text-base <?= $isProfilActive ? 'font-bold text-purple-700' : 'font-medium text-gray-700 hover:text-purple-600' ?>">
                        <span>Profil RW</span>
                        <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="absolute left-0 top-full hidden group-hover:block w-56 bg-white border border-purple-100 rounded-xl shadow-xl py-2 z-50">
                        <a href="/tentang-kami" class="flex items-center gap-2.5 px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition">
                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            <span>Profil</span>
                        </a>
                        <a href="/galeri" class="flex items-center gap-2.5 px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition">
                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span>Galeri Kegiatan</span>
                        </a>
                        <a href="/pengurus-rw#rw" class="flex items-center gap-2.5 px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition">
                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            <span>Struktur RW</span>
                        </a>
                    </div>
                </div>

                <!-- 3. Layanan (Dropdown) -->
                <div class="relative group py-2">
                    <button class="flex items-center gap-1 transition text-base <?= $isLayananActive ? 'font-bold text-purple-700' : 'font-medium text-gray-700 hover:text-purple-600' ?>">
                        <span>Layanan</span>
                        <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="absolute left-0 top-full hidden group-hover:block w-64 bg-white border border-purple-100 rounded-xl shadow-xl py-2 z-50">
                        <a href="/layanan" class="flex items-center gap-2.5 px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition">
                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            <span>Aula RW 021 & Fasilitas</span>
                        </a>
                        <a href="/tpst" class="flex items-center gap-2.5 px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition">
                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            <span>Kebersihan Lingkungan (TPST)</span>
                        </a>
                    </div>
                </div>

                <!-- 4. Informasi (Dropdown) -->
                <div class="relative group py-2">
                    <button class="flex items-center gap-1 transition text-base <?= $isInfoActive ? 'font-bold text-purple-700' : 'font-medium text-gray-700 hover:text-purple-600' ?>">
                        <span>Informasi</span>
                        <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="absolute left-0 top-full hidden group-hover:block w-52 bg-white border border-purple-100 rounded-xl shadow-xl py-2 z-50">
                        <a href="/notulensi" class="flex items-center gap-2.5 px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition">
                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            <span>Notulensi</span>
                        </a>
                        <a href="/statistik" class="flex items-center gap-2.5 px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition">
                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                            <span>Statistik Warga</span>
                        </a>
                        <a href="/lokasi" class="flex items-center gap-2.5 px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition">
                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span>Maps Peta Lokasi</span>
                        </a>
                    </div>
                </div>

                <!-- 5. Hubungi Kami -->
                <a href="/contact" class="<?= navClass('/contact') ?>">Hubungi Kami</a>


                <!-- 6. PORTAL ADMIN (Admin Warga) -->
                <?php if ($_SESSION['user'] ?? false): ?>
                    <a href="/dashboard" class="px-4 py-3 bg-purple-600 hover:bg-purple-700 text-white font-medium text-sm rounded-[10px] transition duration-150 flex items-center gap-2 shadow-sm">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        Admin Warga
                    </a>
                <?php else: ?>
                    <a href="/login" class="px-4 py-3 bg-purple-600 hover:bg-purple-700 text-white font-medium text-sm rounded-[10px] transition duration-150 flex items-center gap-2 shadow-sm">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        Admin Warga
                    </a>
                <?php endif; ?>

            </div>

            <!-- Mobile Hamburger Button -->
            <div class="md:hidden flex items-center">
                <button type="button" id="mobile-menu-button" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')" class="text-gray-600 hover:text-purple-600 focus:outline-none p-2 rounded-lg border border-gray-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu Dropdown -->
    <div id="mobile-menu" class="hidden md:hidden border-t border-purple-100 bg-white px-4 pt-4 pb-6 space-y-4 text-base font-medium shadow-lg">
        <a href="/" class="block px-3 py-2.5 rounded-md hover:bg-purple-50 text-gray-800 font-medium text-base tracking-wider">Beranda</a>

        <!-- Mobile Submenu: Profil RW -->
        <div class="pl-3 py-1 border-l-2 border-purple-300 space-y-2">
            <span class="block text-xs font-medium text-purple-700 uppercase tracking-wider">Profil RW</span>
            <a href="/tentang-kami" class="flex items-center gap-2 px-2 py-1 rounded text-sm font-medium text-gray-700 hover:text-purple-700">
                <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                Profil & Galeri
            </a>
            <a href="/pengurus-rw#rw" class="flex items-center gap-2 px-2 py-1 rounded text-sm font-medium text-gray-700 hover:text-purple-700">
                <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                Struktur RW
            </a>
        </div>

        <!-- Mobile Submenu: Layanan -->
        <div class="pl-3 py-1 border-l-2 border-purple-300 space-y-2">
            <span class="block text-xs font-medium text-purple-700 uppercase tracking-wider">Layanan</span>
            <a href="/layanan" class="flex items-center gap-2 px-2 py-1 rounded text-sm font-medium text-gray-700 hover:text-purple-700">
                <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                Aula RW 021 & Fasilitas
            </a>
            <a href="/tpst" class="flex items-center gap-2 px-2 py-1 rounded text-sm font-medium text-gray-700 hover:text-purple-700">
                <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                Kebersihan Lingkungan (TPST)
            </a>
        </div>

        <!-- Mobile Submenu: Informasi -->
        <div class="pl-3 py-1 border-l-2 border-purple-300 space-y-2">
            <span class="block text-xs font-medium text-purple-700 uppercase tracking-wider">Informasi</span>
            <a href="/notulensi" class="flex items-center gap-2 px-2 py-1 rounded text-sm font-medium text-gray-700 hover:text-purple-700">
                <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Notulensi Rapat
            </a>
            <a href="/statistik" class="flex items-center gap-2 px-2 py-1 rounded text-sm font-medium text-gray-700 hover:text-purple-700">
                <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                Statistik Warga
            </a>
            <a href="/lokasi" class="flex items-center gap-2 px-2 py-1 rounded text-sm font-medium text-gray-700 hover:text-purple-700">
                <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                Maps Peta Lokasi
            </a>
        </div>

        <a href="/contact" class="block px-3 py-2.5 rounded-md bg-emerald-50 text-emerald-700 font-bold text-base">Hubungi Kami</a>

        <!-- Portal Admin (Admin Warga) in Mobile Menu -->
        <?php if ($_SESSION['user'] ?? false): ?>
            <a href="/dashboard" class="inline-flex items-center justify-center gap-2 px-9 py-4 bg-purple-600 text-white font-medium rounded-[10px] hover:bg-purple-700 transition duration-150">Admin Warga (Dashboard)</a>
        <?php else: ?>
            <a href="/login" class="inline-flex items-center justify-center gap-2 px-9 py-4 bg-purple-600 text-white font-medium rounded-[10px] hover:bg-purple-700 transition duration-150">Admin Warga (Login)</a>
        <?php endif; ?>
    </div>
</nav>
