<?php
$currentUser = \Core\Authenticator::user() ?? ($_SESSION['user'] ?? ['name' => 'Pengurus RW', 'role' => 'Admin']);
?>
<!-- TOP NAVBAR KHUSUS ADMIN -->
<nav class="bg-white border-b border-purple-200 sticky top-0 z-50 shadow-sm">
    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo & Branding -->
            <div class="flex items-center gap-4">
                <!-- Hamburger Icon (Mobile Only) -->
                <button type="button" onclick="document.getElementById('admin-mobile-sidebar').classList.toggle('hidden')" class="lg:hidden text-gray-500 hover:text-purple-600 focus:outline-none p-2 rounded-lg border border-gray-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>

                <a href="/dashboard" class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-purple-600 rounded-full flex items-center justify-center text-white font-bold text-xs shadow-md">
                        <img
                            class="w-10 h-10 absolute"
                            src="/images/logo_rw21.webp"
                            alt="logo RW 021" />
                    </div>
                    <div>
                        <h1 class="text-base font-extrabold text-gray-900 leading-tight">
                            Dasbor Pengurus
                        </h1>
                        <p class="text-xs text-purple-600 font-semibold">
                            Portal Admin Warga 021
                        </p>
                    </div>
                </a>
            </div>

            <!-- Admin Profile Menu -->
            <div class="flex items-center gap-4">
                <div class="hidden sm:block text-right">
                    <p class="text-sm font-bold text-gray-900"><?= htmlspecialchars($currentUser['name'] ?? 'Pengurus RW') ?></p>
                    <p class="text-xs text-purple-600 font-bold uppercase tracking-wider"><?= htmlspecialchars($currentUser['role'] ?? 'Admin') ?></p>
                </div>
                <img src="https://ui-avatars.com/api/?name=<?= urlencode($currentUser['name'] ?? 'Admin') ?>&background=7c3aed&color=fff" alt="Admin Avatar"
                    class="w-10 h-10 rounded-full border-2 border-purple-200 shadow-sm" />

                <!-- Form Logout Safe CSRF -->
                <form action="/logout" method="POST" class="inline">
                    <?= \Core\Csrf::field() ?>
                    <button type="submit" class="ml-2 p-2 text-rose-600 hover:bg-rose-50 rounded-[10px] border border-rose-100 transition flex items-center gap-1 text-xs font-bold" title="Keluar">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        <span class="hidden sm:inline">Keluar</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>