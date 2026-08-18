<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tambah Pengumuman - Dasbor Pengurus RW 021</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: "Plus Jakarta Sans", sans-serif;
        }
    </style>
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
                        Buat Pengumuman Baru
                    </h2>
                    <p class="text-xs md:text-sm text-gray-500 mt-1">
                        Siarkan informasi penting, himbauan, atau agenda acara kepada warga RW 021.
                    </p>
                </div>
            </div>

            <!-- ALERT ERROR / FLASH SESSION -->
            <?php
            $errors = \Core\Session::get('errors') ?? [];
            $old = \Core\Session::get('old') ?? [];
            $flashError = \Core\Session::get('error');
            ?>

            <?php if (!empty($flashError)): ?>
                <div class="p-4 bg-red-50 border border-red-200 rounded-xl text-xs text-red-600 font-semibold max-w-4xl mx-auto mb-4">
                    ⚠ <?= htmlspecialchars($flashError) ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($errors)): ?>
                <div class="p-4 bg-red-50 border border-red-200 rounded-xl max-w-4xl mx-auto mb-4">
                    <ul class="text-xs text-red-600 font-medium space-y-1">
                        <?php foreach ($errors as $err): ?>
                            <li>• <?= htmlspecialchars($err) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- FORM CONTAINER -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden max-w-4xl mx-auto">
                <form action="/admin/pengumuman" method="POST">
                    <!-- CSRF Field Hidden Input -->
                    <input type="hidden" name="_csrf_token" value="<?= \Core\Csrf::token() ?>">

                    <div class="p-6 md:p-8 space-y-6">

                        <!-- Judul Pengumuman -->
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                                Judul Pengumuman <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" name="judul" value="<?= htmlspecialchars($old['judul'] ?? '') ?>" placeholder="Contoh: Kerja Bakti Serentak Menyambut HUT RI" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm font-semibold" required />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Kategori -->
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                                    Kategori <span class="text-rose-500">*</span>
                                </label>
                                <select name="kategori" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm font-semibold cursor-pointer" required>
                                    <?php $cat = $old['kategori'] ?? 'umum'; ?>
                                    <option value="umum" <?= $cat === 'umum' ? 'selected' : '' ?>>Info Umum / Himbauan</option>
                                    <option value="kegiatan" <?= $cat === 'kegiatan' ? 'selected' : '' ?>>Agenda / Kegiatan</option>
                                    <option value="darurat" <?= $cat === 'darurat' ? 'selected' : '' ?>>Penting / Darurat</option>
                                    <option value="keuangan" <?= $cat === 'keuangan' ? 'selected' : '' ?>>Iuran & Keuangan</option>
                                </select>
                            </div>

                            <!-- Tanggal Publikasi -->
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                                    Tanggal Tampil <span class="text-rose-500">*</span>
                                </label>
                                <input type="date" name="tanggal_publikasi" value="<?= htmlspecialchars($old['tanggal_publikasi'] ?? date('Y-m-d')) ?>" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm font-semibold" required />
                            </div>
                        </div>

                        <!-- Pesan / Isi Pengumuman -->
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                                Isi Pengumuman <span class="text-rose-500">*</span>
                            </label>
                            <textarea name="pesan" rows="6" placeholder="Tulis rincian pengumuman di sini..." class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm resize-none" required><?= htmlspecialchars($old['pesan'] ?? '') ?></textarea>
                        </div>

                        <!-- Opsional Link Call to Action -->
                        <div class="p-4 bg-purple-50 rounded-xl border border-purple-100 space-y-4">
                            <h4 class="text-xs font-bold text-purple-900 uppercase tracking-wide">Tombol Aksi Tambahan (Opsional)</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">Label Tombol</label>
                                    <input type="text" name="label_tombol" value="<?= htmlspecialchars($old['label_tombol'] ?? '') ?>" placeholder="Contoh: Isi Form Pendaftaran" class="w-full px-3 py-2 bg-white border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-purple-500" />
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">URL / Link Tujuan</label>
                                    <input type="url" name="tautan_url" value="<?= htmlspecialchars($old['tautan_url'] ?? '') ?>" placeholder="https://..." class="w-full px-3 py-2 bg-white border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-purple-500" />
                                </div>
                            </div>
                        </div>

                        <!-- Checkbox Publish Directly -->
                        <div class="flex items-center gap-3 pt-2">
                            <input type="checkbox" id="is_published" name="is_published" value="1" <?= (!isset($old['is_published']) || $old['is_published']) ? 'checked' : '' ?> class="w-4 h-4 text-purple-600 rounded border-gray-300 focus:ring-purple-500 cursor-pointer">
                            <label for="is_published" class="text-sm font-semibold text-gray-700 cursor-pointer">
                                Langsung publikasikan agar bisa dilihat warga
                            </label>
                        </div>

                    </div>

                    <!-- Tombol Aksi -->
                    <div class="px-6 py-5 md:px-8 bg-gray-50 border-t border-gray-200 flex flex-col sm:flex-row-reverse gap-3">
                        <button type="submit" class="px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white text-sm font-bold rounded-xl shadow-md transition flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Simpan & Terbitan
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
