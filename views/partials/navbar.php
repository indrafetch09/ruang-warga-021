<?php
// ponytail: navbar dropdown based on docs/features/users.md specs
if (!function_exists('navClass')) {
    function navClass(string $path): string {
        $uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
        $isActive = ($path === '/' && $uri === '/')
                 || ($path !== '/' && str_starts_with($uri, $path));

        return $isActive
            ? 'font-bold text-purple-700 border-b-2 border-purple-600 pb-1 transition'
            : 'font-medium text-gray-700 hover:text-purple-600 transition';
    }
}
$currentUri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);

$isProfilActive  = str_starts_with($currentUri, '/tentang-kami') || str_starts_with($currentUri, '/pengurus-rw') || str_starts_with($currentUri, '/galeri');
$isLayananActive = str_starts_with($currentUri, '/layanan');
$isInfoActive    = str_starts_with($currentUri, '/notulensi') || str_starts_with($currentUri, '/statistik') || str_starts_with($currentUri, '/laporan');
?>
<!-- NAVBAR UTAMA (Berdasarkan spesifikasi docs/features/users.md) -->
<nav class="bg-white border-b border-purple-100 sticky top-0 z-50 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-24">

            <!-- Logo Area -->
            <a href="/" class="flex items-center bg-red-800 gap-3 sm:pl-10 pl-0 group">
                <div class="flex-shrink-0 h-100 w-28 bg-red-800 logo-container flex flex-col items-center justify-center p-2 z-10 border border-purple-200 shadow-md rounded-b-2xl group-hover:border-purple-400 transition">
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
                <div class="relative group py-2">
                    <button class="flex items-center gap-1 font-medium transition text-base <?= $isProfilActive ? 'text-purple-700 border-b-2 border-purple-600 pb-1' : 'text-gray-700 hover:text-purple-600' ?>">
                        <span>Profil RW</span>
                        <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="absolute left-0 top-full hidden group-hover:block w-56 bg-white border border-purple-100 rounded-xl shadow-xl py-2 z-50">
                        <a href="/tentang-kami" class="block px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition">Profil</a>
                        <a href="/galeri" class="block px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition">Galeri Kegiatan</a>
                        <a href="/pengurus-rw#rw" class="block px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition">Struktur RW</a>
                    </div>
                </div>

                <!-- 3. Layanan (Dropdown) -->
                <div class="relative group py-2">
                    <button class="flex items-center gap-1 font-medium transition text-base <?= $isLayananActive ? 'text-purple-700 border-b-2 border-purple-600 pb-1' : 'text-gray-700 hover:text-purple-600' ?>">
                        <span>Layanan</span>
                        <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="absolute left-0 top-full hidden group-hover:block w-64 bg-white border border-purple-100 rounded-xl shadow-xl py-2 z-50">
                        <a href="/layanan" class="block px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition">Aula RW 021 & Fasilitas</a>
                        <a href="/tpst" class="block px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition">Kebersihan Lingkungan (TPST)</a>
                    </div>
                </div>

                <!-- 4. Informasi (Dropdown) -->
                <div class="relative group py-2">
                    <button class="flex items-center gap-1 font-medium transition text-base <?= $isInfoActive ? 'text-purple-700 border-b-2 border-purple-600 pb-1' : 'text-gray-700 hover:text-purple-600' ?>">
                        <span>Informasi</span>
                        <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="absolute left-0 top-full hidden group-hover:block w-52 bg-white border border-purple-100 rounded-xl shadow-xl py-2 z-50">
                        <a href="/notulensi" class="block px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition">Notulensi</a>
                        <a href="/statistik" class="block px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition">Statistik Warga</a>
                        <a href="/contact#maps" class="block px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition">Maps Peta Lokasi</a>
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
            <a href="/tentang-kami" class="block px-2 py-1 rounded text-sm font-medium text-gray-700 hover:text-purple-700">Profil & Galeri</a>
            <a href="/pengurus-rw#rw" class="block px-2 py-1 rounded text-sm font-medium text-gray-700 hover:text-purple-700">Struktur RW</a>
        </div>

        <!-- Mobile Submenu: Layanan -->
        <div class="pl-3 py-1 border-l-2 border-purple-300 space-y-2">
            <span class="block text-xs font-medium text-purple-700 uppercase tracking-wider">Layanan</span>
            <a href="/layanan" class="block px-2 py-1 rounded text-sm font-medium text-gray-700 hover:text-purple-700">Aula RW 021 & Fasilitas</a>
            <a href="/tpst" class="block px-2 py-1 rounded text-sm font-medium text-gray-700 hover:text-purple-700">Kebersihan Lingkungan (TPST)</a>
        </div>

        <!-- Mobile Submenu: Informasi -->
        <div class="pl-3 py-1 border-l-2 border-purple-300 space-y-2">
            <span class="block text-xs font-medium text-purple-700 uppercase tracking-wider">Informasi</span>
            <a href="/notulensi" class="block px-2 py-1 rounded text-sm font-medium text-gray-700 hover:text-purple-700">Notulensi Rapat</a>
            <a href="/statistik" class="block px-2 py-1 rounded text-sm font-medium text-gray-700 hover:text-purple-700">Statistik Warga</a>
            <a href="/contact#maps" class="block px-2 py-1 rounded text-sm font-medium text-gray-700 hover:text-purple-700">Maps Peta Lokasi</a>
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
