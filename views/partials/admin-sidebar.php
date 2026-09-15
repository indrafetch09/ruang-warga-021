<?php
$uri = $_SERVER['REQUEST_URI'] ?? '';
$isDashboard  = ($uri === '/dashboard' || $uri === '/admin');
$isWarga      = str_contains($uri, '/warga');
$isPengurus   = str_contains($uri, '/pengurus');
$isPengumuman = str_contains($uri, '/pengumuman');
$isKegiatan   = str_contains($uri, '/kegiatan');
$isNotulensi  = str_contains($uri, '/notulensi');
$isGaleri     = str_contains($uri, '/galeri');
$isSettings   = str_contains($uri, '/pengaturan') || str_contains($uri, '/warga#settings');

$sidebarUser = \App\Models\User::current();
$isRwUser    = $sidebarUser->isRw();

if (!function_exists('getNavClass')) {
    function getNavClass($isActive)
    {
        return $isActive
            ? 'flex items-center gap-3 px-3.5 py-2.5 bg-purple-700 text-white rounded-[10px] font-bold text-sm transition shadow-sm'
            : 'flex items-center gap-3 px-3.5 py-2.5 text-gray-600 hover:bg-purple-50 hover:text-purple-700 rounded-[10px] font-medium text-sm transition group';
    }
}

if (!function_exists('getIconClass')) {
    function getIconClass($isActive)
    {
        return $isActive ? 'w-5 h-5 text-white' : 'w-5 h-5 text-gray-400 group-hover:text-purple-600 transition';
    }
}
?>

<!-- SIDEBAR DESKTOP -->
<aside class="hidden lg:block w-64 flex-shrink-0 bg-white border-r border-purple-100 h-[calc(100vh-5rem)] sticky top-20 sidebar-scroll overflow-y-auto">
    <div class="p-5 flex flex-col gap-2">
        <p class="text-[10px] font-extrabold text-purple-700 uppercase tracking-widest px-3 mb-1 mt-2">
            Menu Utama
        </p>

        <!-- 1. Dasbor -->
        <a href="/dashboard" class="<?= getNavClass($isDashboard) ?>">
            <svg class="<?= getIconClass($isDashboard) ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
            </svg>
            Dasbor Utama
        </a>

        <!-- 2. Data Penduduk -->
        <a href="/admin/warga" class="<?= getNavClass($isWarga) ?>">
            <svg class="<?= getIconClass($isWarga) ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            Data Penduduk
        </a>

        <?php if ($isRwUser): ?>
            <!-- 3. Manajemen Pengurus (Khusus RW/Admin) -->
            <a href="/admin/pengurus" class="<?= getNavClass($isPengurus) ?>">
                <svg class="<?= getIconClass($isPengurus) ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                Manajemen Pengurus
            </a>

            <!-- 4. Pengumuman Admin (Khusus RW/Admin) -->
            <a href="/admin/pengumuman" class="<?= getNavClass($isPengumuman) ?>">
                <svg class="<?= getIconClass($isPengumuman) ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                </svg>
                Pengumuman
            </a>

            <!-- 5. Kegiatan Admin (Khusus RW/Admin) -->
            <a href="/admin/kegiatan" class="<?= getNavClass($isKegiatan) ?>">
                <svg class="<?= getIconClass($isKegiatan) ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Kegiatan Rutin
            </a>
        <?php endif; ?>

        <p class="text-[10px] font-extrabold text-purple-700 uppercase tracking-widest px-3 mb-1 mt-4">
            Arsip & Dokumentasi
        </p>

        <!-- 6. Notulensi Admin -->
        <a href="/admin/notulensi" class="<?= getNavClass($isNotulensi) ?>">
            <svg class="<?= getIconClass($isNotulensi) ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            Notulensi Rapat
        </a>

        <!-- 7. Galeri Admin -->
        <a href="/admin/galeri" class="<?= getNavClass($isGaleri) ?>">
            <svg class="<?= getIconClass($isGaleri) ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            Galeri Kegiatan
        </a>

        <p class="text-[10px] font-extrabold text-purple-700 uppercase tracking-widest px-3 mb-1 mt-4">
            Sistem & Konfigurasi
        </p>

        <!-- 8. Pengaturan -->
        <a href="/admin/pengaturan" class="<?= getNavClass($isSettings) ?>">
            <svg class="<?= getIconClass($isSettings) ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            Pengaturan Sistem
        </a>
    </div>

    <div class="p-5 mt-auto border-t border-purple-100">
        <a href="/" target="_blank" class="flex items-center justify-center gap-2 px-3 py-2.5 bg-gray-900 text-white rounded-[10px] text-xs font-bold hover:bg-purple-900 transition shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
            </svg>
            Lihat Web Warga
        </a>
    </div>
</aside>

<!-- SIDEBAR MOBILE OVERLAY -->
<div id="admin-mobile-sidebar" class="hidden fixed inset-0 z-50 bg-black/60 backdrop-blur-sm lg:hidden flex">
    <div class="w-72 bg-white h-full p-5 flex flex-col justify-between overflow-y-auto">
        <div class="flex flex-col gap-2">
            <div class="flex items-center justify-between pb-4 border-b border-gray-100 mb-2">
                <div class="flex items-center gap-3">
                    <span class="font-extrabold text-lg text-gray-900">Menu Pengurus</span>
                </div>
                <button type="button" onclick="document.getElementById('admin-mobile-sidebar').classList.add('hidden')" class="text-gray-400 hover:text-gray-700 text-xl font-bold p-1">&times;</button>
            </div>

            <!-- 1. Dasbor -->
            <a href="/dashboard" class="<?= getNavClass($isDashboard) ?>">
                <svg class="<?= getIconClass($isDashboard) ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                </svg>
                <span>Dasbor Utama</span>
            </a>

            <!-- 2. Data Penduduk -->
            <a href="/admin/warga" class="<?= getNavClass($isWarga) ?>">
                <svg class="<?= getIconClass($isWarga) ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <span>Data Penduduk</span>
            </a>

            <?php if ($isRwUser): ?>
                <!-- 3. Manajemen Pengurus (Khusus RW/Admin) -->
                <a href="/admin/pengurus" class="<?= getNavClass($isPengurus) ?>">
                    <svg class="<?= getIconClass($isPengurus) ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span>Manajemen Pengurus</span>
                </a>

                <!-- 4. Pengumuman (Khusus RW/Admin) -->
                <a href="/admin/pengumuman" class="<?= getNavClass($isPengumuman) ?>">
                    <svg class="<?= getIconClass($isPengumuman) ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                    </svg>
                    <span>Pengumuman</span>
                </a>

                <!-- 5. Kegiatan Rutin (Khusus RW/Admin) -->
                <a href="/admin/kegiatan" class="<?= getNavClass($isKegiatan) ?>">
                    <svg class="<?= getIconClass($isKegiatan) ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span>Kegiatan Rutin</span>
                </a>
            <?php endif; ?>

            <p class="text-[10px] font-extrabold text-purple-700 uppercase tracking-widest px-3 mb-1 mt-3">
                Arsip & Dokumentasi
            </p>

            <!-- 6. Notulensi Rapat -->
            <a href="/admin/notulensi" class="<?= getNavClass($isNotulensi) ?>">
                <svg class="<?= getIconClass($isNotulensi) ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <span>Notulensi Rapat</span>
            </a>

            <!-- 7. Galeri Kegiatan -->
            <a href="/admin/galeri" class="<?= getNavClass($isGaleri) ?>">
                <svg class="<?= getIconClass($isGaleri) ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <span>Galeri Kegiatan</span>
            </a>

            <p class="text-[10px] font-extrabold text-purple-700 uppercase tracking-widest px-3 mb-1 mt-3">
                Sistem & Konfigurasi
            </p>

            <!-- 8. Pengaturan Sistem -->
            <a href="/admin/pengaturan" class="<?= getNavClass($isSettings) ?>">
                <svg class="<?= getIconClass($isSettings) ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span>Pengaturan Sistem</span>
            </a>
        </div>

        <div class="border-t border-gray-100 pt-4">
            <a href="/" target="_blank" class="w-full flex items-center justify-center gap-2 px-3 py-2.5 bg-gray-900 text-white rounded-[10px] text-xs font-bold hover:bg-purple-900 transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                </svg>
                <span>Lihat Web Warga</span>
            </a>
        </div>
    </div>
</div>