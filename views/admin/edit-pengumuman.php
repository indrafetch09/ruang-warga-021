<!doctype html>
<html lang="id">

<head>
    <title>Edit Pengumuman - Dasbor Pengurus RW 021</title>
    <?php require base_path('views/partials/head.php'); ?>
</head>

<body class="text-gray-800 bg-gray-50 flex flex-col min-h-screen">
    <?php require base_path('views/partials/admin-header.php'); ?>

    <div class="flex flex-1 max-w-[1400px] w-full mx-auto relative">
        <?php require base_path('views/partials/admin-sidebar.php'); ?>

        <main class="flex-1 w-full min-w-0 p-4 sm:p-6 lg:p-8 space-y-6">

            <!-- HEADER SECTION -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                <div>
                    <a href="/dashboard" class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-purple-600 transition mb-2 group">
                        <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke Dasbor
                    </a>
                    <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">
                        Edit Pengumuman
                    </h2>
                    <p class="text-xs md:text-sm text-gray-500 mt-1">
                        Perbarui isi pengumuman atau status publikasi untuk warga RW 021.
                    </p>
                </div>
            </div>

            <!-- ALERT ERRORS -->
            <?php
            $errors = \Core\Session::get('errors') ?? [];
            $flashError = \Core\Session::get('error');
            ?>

            <?php if (!empty($flashError)): ?>
                <div class="p-4 bg-red-50 border border-red-200 text-red-700 text-sm font-bold rounded-xl flex items-center gap-2 shadow-sm max-w-4xl mx-auto mb-4">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <?= htmlspecialchars($flashError) ?>
                </div>
            <?php endif; ?>

            <!-- FORM CONTAINER -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden max-w-4xl mx-auto">
                <form action="/admin/pengumuman/update" method="POST">
                    <?= \Core\Csrf::field() ?>
                    <input type="hidden" name="id" value="<?= $pengumuman['id'] ?>">

                    <div class="p-6 md:p-8 space-y-6">

                        <!-- Judul Pengumuman -->
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Judul Pengumuman <span class="text-rose-500">*</span></label>
                            <input type="text" name="judul" value="<?= htmlspecialchars($pengumuman['judul'] ?? '') ?>" placeholder="Contoh: Pemadaman Listrik Bergilir" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm font-semibold" required />
                            <?php if (isset($errors['judul'])): ?>
                                <p class="text-xs text-rose-500 mt-1 font-semibold"><?= $errors['judul'] ?></p>
                            <?php endif; ?>
                        </div>

                        <!-- Grid Kategori & Tanggal Publikasi -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Kategori Pengumuman <span class="text-rose-500">*</span></label>
                                <?php $katSelect = strtolower($pengumuman['kategori'] ?? 'info'); ?>
                                <select name="kategori" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm font-semibold cursor-pointer" required>
                                    <option value="urgent" <?= $katSelect === 'urgent' ? 'selected' : '' ?>>Penting / Urgent (Merah)</option>
                                    <option value="kegiatan" <?= $katSelect === 'kegiatan' ? 'selected' : '' ?>>Kegiatan / Event (Hijau)</option>
                                    <option value="info" <?= $katSelect === 'info' ? 'selected' : '' ?>>Informasi Warga (Ungu)</option>
                                    <option value="umum" <?= $katSelect === 'umum' ? 'selected' : '' ?>>Umum</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Tanggal Publikasi <span class="text-rose-500">*</span></label>
                                <input type="date" name="tanggal_publikasi" value="<?= htmlspecialchars($pengumuman['tanggal_publikasi'] ?? date('Y-m-d')) ?>" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm font-semibold cursor-pointer" required />
                            </div>
                        </div>

                        <!-- Isi Pesan -->
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Pesan / Isi Pengumuman <span class="text-rose-500">*</span></label>
                            <textarea name="pesan" rows="5" placeholder="Tuliskan isi pengumuman secara lengkap..." class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm resize-none" required><?= htmlspecialchars($pengumuman['pesan'] ?? '') ?></textarea>
                            <?php if (isset($errors['pesan'])): ?>
                                <p class="text-xs text-rose-500 mt-1 font-semibold"><?= $errors['pesan'] ?></p>
                            <?php endif; ?>
                        </div>

                        <!-- Grid Label Tombol & Tautan URL -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-gray-100">
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Label Tombol Tautan</label>
                                <p class="text-[11px] text-gray-400 mb-2">Opsional. Contoh: Daftar Sekarang, Baca Selengkapnya</p>
                                <input type="text" name="label_tombol" value="<?= htmlspecialchars($pengumuman['label_tombol'] ?? '') ?>" placeholder="e.g. Daftar Lomba" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm font-semibold" />
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Tautan / Link URL</label>
                                <p class="text-[11px] text-gray-400 mb-2">Opsional. Tautan eksternal/formulir jika ada.</p>
                                <input type="url" name="tautan_url" value="<?= htmlspecialchars($pengumuman['tautan_url'] ?? '') ?>" placeholder="https://..." class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm font-semibold" />
                                <?php if (isset($errors['tautan_url'])): ?>
                                    <p class="text-xs text-rose-500 mt-1 font-semibold"><?= $errors['tautan_url'] ?></p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Checkbox Status Publikasi -->
                        <div class="flex items-center gap-3 pt-2">
                            <input type="checkbox" id="is_published" name="is_published" value="1" <?= (!empty($pengumuman['is_published'])) ? 'checked' : '' ?> class="w-5 h-5 text-purple-600 border-gray-300 rounded focus:ring-purple-500 cursor-pointer">
                            <label for="is_published" class="text-sm font-bold text-gray-700 cursor-pointer">
                                Tampilkan Pengumuman Ini di Beranda Portal Warga
                            </label>
                        </div>

                    </div>

                    <!-- Tombol Aksi -->
                    <div class="px-6 py-5 md:px-8 bg-gray-50 border-t border-gray-200 flex flex-col sm:flex-row-reverse gap-3">
                        <button type="submit" class="px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white text-sm font-bold rounded-xl shadow-md transition flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Perbarui Pengumuman
                        </button>
                        <a href="/dashboard" class="px-6 py-3 bg-white border border-gray-300 hover:bg-gray-100 text-gray-700 text-sm font-bold rounded-xl transition text-center">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>

</html>
