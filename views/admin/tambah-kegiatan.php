<!doctype html>
<html lang="id">

<head>
    <title>Tambah Kegiatan Rutin - Dasbor Pengurus RW 021</title>
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
                    <a href="/admin/kegiatan" class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-purple-600 transition mb-2 group">
                        <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke Daftar Kegiatan
                    </a>
                    <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">
                        Tambah Kegiatan Rutin
                    </h2>
                    <p class="text-xs md:text-sm text-gray-500 mt-1">
                        Masukkan jadwal kegiatan mingguan atau bulanan yang akan tampil pada panduan warga RW 021.
                    </p>
                </div>
            </div>

            <!-- ALERT ERROR / FLASH SESSION -->
            <?php
            $flashError = \Core\Session::get('error');
            $old = \Core\Session::get('old') ?? [];
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
                <form action="/admin/kegiatan" method="POST">
                    <?= \Core\Csrf::field() ?>

                    <!-- Bagian 1: Detail Utama -->
                    <div class="p-6 md:p-8 border-b border-gray-100">
                        <h3 class="text-base font-bold text-purple-700 mb-6 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 022 2h2a2 2 0 022-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                            </svg>
                            Informasi Kegiatan
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Nama Kegiatan <span class="text-rose-500">*</span></label>
                                <input type="text" name="nama" value="<?= htmlspecialchars($old['nama'] ?? '') ?>" placeholder="Contoh: Senam Pagi Warga, Ronda Malam, Pengajian Rutin" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm font-semibold" required />
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Hari Pelaksanaan <span class="text-rose-500">*</span></label>
                                <?php $hariSelect = $old['hari'] ?? ''; ?>
                                <select name="hari" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm font-semibold cursor-pointer" required>
                                    <option value="" disabled <?= empty($hariSelect) ? 'selected' : '' ?>>Pilih Hari</option>
                                    <option value="senin" <?= $hariSelect === 'senin' ? 'selected' : '' ?>>Senin</option>
                                    <option value="selasa" <?= $hariSelect === 'selasa' ? 'selected' : '' ?>>Selasa</option>
                                    <option value="rabu" <?= $hariSelect === 'rabu' ? 'selected' : '' ?>>Rabu</option>
                                    <option value="kamis" <?= $hariSelect === 'kamis' ? 'selected' : '' ?>>Kamis</option>
                                    <option value="jumat" <?= $hariSelect === 'jumat' ? 'selected' : '' ?>>Jumat</option>
                                    <option value="sabtu" <?= $hariSelect === 'sabtu' ? 'selected' : '' ?>>Sabtu</option>
                                    <option value="minggu" <?= $hariSelect === 'minggu' ? 'selected' : '' ?>>Minggu</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Kategori Kegiatan <span class="text-rose-500">*</span></label>
                                <?php $katSelect = $old['kategori'] ?? ''; ?>
                                <select name="kategori" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm font-semibold cursor-pointer" required>
                                    <option value="" disabled <?= empty($katSelect) ? 'selected' : '' ?>>Pilih Kategori (Tema / Warna)</option>
                                    <option value="administrasi" <?= $katSelect === 'administrasi' ? 'selected' : '' ?>>Administrasi & Pelayanan (Ungu)</option>
                                    <option value="kebersihan" <?= $katSelect === 'kebersihan' ? 'selected' : '' ?>>Kebersihan Lingkungan (Hijau)</option>
                                    <option value="keamanan" <?= $katSelect === 'keamanan' ? 'selected' : '' ?>>Keamanan & Ronda (Kuning)</option>
                                    <option value="sosial" <?= $katSelect === 'sosial' ? 'selected' : '' ?>>Kesehatan & Posyandu (Merah)</option>
                                    <option value="keagamaan" <?= $katSelect === 'keagamaan' ? 'selected' : '' ?>>Keagamaan & Kajian (Biru)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Bagian 2: Waktu, Lokasi, Persyaratan & Deskripsi -->
                    <div class="p-6 md:p-8">
                        <h3 class="text-base font-bold text-emerald-600 mb-6 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Waktu, Lokasi & Detail Keterangan
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Waktu Pelaksanaan <span class="text-rose-500">*</span></label>
                                <p class="text-[11px] text-gray-400 mb-2">Bisa berupa rentang jam atau teks spesifik.</p>
                                <input type="text" name="waktu" value="<?= htmlspecialchars($old['waktu'] ?? '') ?>" placeholder="Contoh: 19.30 - 21.00 atau Ba'da Isya" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 transition text-sm font-semibold" required />
                            </div>

                            <!-- INPUT LOKASI DITAMBAHKAN DI SINI -->
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Lokasi Pelaksanaan <span class="text-rose-500">*</span></label>
                                <p class="text-[11px] text-gray-400 mb-2">Tempat atau patokan lokasi kegiatan.</p>
                                <input type="text" name="lokasi" value="<?= htmlspecialchars($old['lokasi'] ?? '') ?>" placeholder="Contoh: Balai Warga RW 021 / Pos Ronda RT 03" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 transition text-sm font-semibold" required />
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Keterangan Frekuensi</label>
                                <p class="text-[11px] text-gray-400 mb-2">Opsional. Misal: Minggu ke-1, Setiap Pekan, dll.</p>
                                <input type="text" name="frekuensi" value="<?= htmlspecialchars($old['frekuensi'] ?? '') ?>" placeholder="Contoh: Setiap Sabtu Pekan Pertama" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 transition text-sm font-semibold" />
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Syarat & Ketentuan</label>
                                <p class="text-[11px] text-gray-400 mb-2">Opsional. Ketentuan atau dokumen/peralatan yang wajib dibawa peserta.</p>
                                <textarea name="persyaratan_ketentuan" rows="2" placeholder="Contoh: Wajib membawa KTP asli, mengenakan pakaian olahraga, khusus warga RT 01 - RT 05..." class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 transition text-sm resize-none"><?= htmlspecialchars($old['persyaratan_ketentuan'] ?? '') ?></textarea>
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Deskripsi Singkat</label>
                                <p class="text-[11px] text-gray-400 mb-2">Penjelasan singkat mengenai perlengkapan atau teknis kegiatan.</p>
                                <textarea name="deskripsi" rows="3" placeholder="Contoh: Dilaksanakan di Balai Warga, dimohon membawa peralatan kebersihan masing-masing..." class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 transition text-sm resize-none"><?= htmlspecialchars($old['deskripsi'] ?? '') ?></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="px-6 py-5 md:px-8 bg-gray-50 border-t border-gray-200 flex flex-col sm:flex-row-reverse gap-3">
                        <button type="submit" class="px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white text-sm font-bold rounded-xl shadow-md transition flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Simpan Kegiatan
                        </button>
                        <a href="/admin/kegiatan" class="px-6 py-3 bg-white border border-gray-300 hover:bg-gray-100 text-gray-700 text-sm font-bold rounded-xl transition text-center">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>

</html>