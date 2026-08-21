<!doctype html>
<html lang="id">

<head>
    <title>Edit Galeri - Dasbor Pengurus RW 021</title>
    <?php require base_path('views/partials/head.php'); ?>
</head>

<body class="text-gray-800 bg-gray-50 flex flex-col min-h-screen">
    <?php require base_path('views/partials/admin-header.php'); ?>

    <!-- WRAPPER SIDEBAR & MAIN CONTENT -->
    <div class="flex flex-1 max-w-[1400px] w-full mx-auto relative">
        <?php require base_path('views/partials/admin-sidebar.php'); ?>

        <main class="flex-1 w-full min-w-0 p-4 sm:p-6 lg:p-8 space-y-6">

            <!-- HEADER SECTION -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                <div>
                    <a href="/admin/galeri/create" class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-purple-600 transition mb-2 group">
                        <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke Kelola Galeri
                    </a>
                    <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">
                        Edit Dokumentasi Galeri
                    </h2>
                    <p class="text-xs md:text-sm text-gray-500 mt-1">
                        Perbarui detail judul, kategori, atau ganti foto dokumentasi warga RW 021.
                    </p>
                </div>
            </div>

            <!-- ALERT ERROR / FLASH SESSION -->
            <?php
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
                <form action="/admin/galeri/update" method="POST" enctype="multipart/form-data">
                    <?= \Core\Csrf::field() ?>
                    <input type="hidden" name="id" value="<?= $galeri['id'] ?>">

                    <div class="p-6 md:p-8 space-y-6">
                        <!-- Judul Foto -->
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Judul Dokumentasi <span class="text-rose-500">*</span></label>
                            <input type="text" name="judul" value="<?= htmlspecialchars($galeri['judul'] ?? '') ?>" placeholder="Contoh: Kerja Bakti Massal RT 03" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm font-semibold" required />
                        </div>

                        <!-- Grid Tanggal & Kategori -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Tanggal Kegiatan <span class="text-rose-500">*</span></label>
                                <input type="date" name="tanggal" value="<?= htmlspecialchars($galeri['tanggal'] ?? date('Y-m-d')) ?>" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm font-semibold cursor-pointer" required />
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Kategori Kegiatan <span class="text-rose-500">*</span></label>
                                <?php $katSelect = strtolower($galeri['kategori'] ?? ''); ?>
                                <select name="kategori" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm font-semibold cursor-pointer" required>
                                    <option value="sosial" <?= $katSelect === 'sosial' ? 'selected' : '' ?>>Sosial & Kemasyarakatan</option>
                                    <option value="perayaan" <?= $katSelect === 'perayaan' ? 'selected' : '' ?>>Perayaan & Event</option>
                                    <option value="kesehatan" <?= $katSelect === 'kesehatan' ? 'selected' : '' ?>>Kesehatan & Posyandu</option>
                                    <option value="pertemuan" <?= $katSelect === 'pertemuan' ? 'selected' : '' ?>>Pertemuan & Rapat</option>
                                    <option value="lainnya" <?= $katSelect === 'lainnya' ? 'selected' : '' ?>>Lainnya</option>
                                </select>
                            </div>
                        </div>

                        <!-- Preview Foto Lama & Upload Foto Baru -->
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Foto Saat Ini</label>
                            <?php if (!empty($galeri['file_foto'])): ?>
                                <div class="mb-4 w-48 h-32 rounded-xl overflow-hidden border border-gray-200 shadow-sm">
                                    <img src="/uploads/galeri/<?= htmlspecialchars($galeri['file_foto']) ?>" alt="Foto Galeri" class="w-full h-full object-cover">
                                </div>
                            <?php endif; ?>

                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Ganti Foto (Opsional)</label>
                            <p class="text-[11px] text-gray-400 mb-2">Biarkan kosong jika tidak ingin mengubah foto. Maksimal 10MB (JPG, JPEG, PNG, WEBP).</p>
                            <input type="file" name="foto_file" accept="image/jpeg,image/png,image/webp" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 transition cursor-pointer" />
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Deskripsi Singkat</label>
                            <textarea name="deskripsi" rows="3" placeholder="Penjelasan singkat mengenai dokumentasi kegiatan..." class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm resize-none"><?= htmlspecialchars($galeri['deskripsi'] ?? '') ?></textarea>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="px-6 py-5 md:px-8 bg-gray-50 border-t border-gray-200 flex flex-col sm:flex-row-reverse gap-3">
                        <button type="submit" class="px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white text-sm font-bold rounded-xl shadow-md transition flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Perbarui Galeri
                        </button>
                        <a href="/admin/galeri/create" class="px-6 py-3 bg-white border border-gray-300 hover:bg-gray-100 text-gray-700 text-sm font-bold rounded-xl transition text-center">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>

</html>
