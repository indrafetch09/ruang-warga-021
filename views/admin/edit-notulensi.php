<!doctype html>
<html lang="id">

<head>
    <title>Edit Notulensi - Dasbor Pengurus RW 021</title>
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
                    <a href="/notulensi" class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-purple-600 transition mb-2 group">
                        <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke Arsip Notulensi
                    </a>
                    <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">
                        Edit Notulensi Rapat
                    </h2>
                    <p class="text-xs md:text-sm text-gray-500 mt-1">
                        Perbarui rincian agenda, hasil keputusan, atau ganti dokumen lampiran rapat.
                    </p>
                </div>
            </div>

            <!-- ALERT ERROR -->
            <?php $flashError = \Core\Session::get('error'); ?>
            <?php if (!empty($flashError)): ?>
                <div class="p-4 bg-red-50 border border-red-200 text-red-700 text-sm font-bold rounded-xl flex items-center gap-2 shadow-sm max-w-4xl mx-auto mb-4">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <?= htmlspecialchars($flashError) ?>
                </div>
            <?php endif; ?>

            <?php
            // Helper parsing array/object
            $nJudul     = $notulensi->judul ?? $notulensi['judul'] ?? '';
            $nKategori  = $notulensi->kategori ?? $notulensi['kategori'] ?? '';
            $nNoSurat   = $notulensi->no_surat ?? $notulensi['no_surat'] ?? '';
            $nTanggal   = $notulensi->tanggal ?? $notulensi['tanggal'] ?? '';
            $nWMulai    = $notulensi->waktu_mulai ?? $notulensi['waktu_mulai'] ?? '';
            $nWSelesai  = $notulensi->waktu_selesai ?? $notulensi['waktu_selesai'] ?? '';
            $nLokasi    = $notulensi->lokasi ?? $notulensi['lokasi'] ?? '';
            $nNotulis   = $notulensi->notulis ?? $notulensi['notulis'] ?? '';
            $nAgenda    = $notulensi->agenda ?? $notulensi['agenda'] ?? '';
            $nHasil     = $notulensi->hasil_pembahasan ?? $notulensi['hasil_pembahasan'] ?? '';
            $nKeputusan = $notulensi->keputusan_akhir ?? $notulensi['keputusan_akhir'] ?? '';
            $nFile      = $notulensi->file_lampiran ?? $notulensi['file_lampiran'] ?? '';
            $nId        = $notulensi->id ?? $notulensi['id'] ?? '';
            ?>

            <!-- FORM CONTAINER -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden max-w-4xl mx-auto">
                <form action="/admin/notulensi/update" method="POST" enctype="multipart/form-data">
                    <?= \Core\Csrf::field() ?>
                    <input type="hidden" name="id" value="<?= $nId ?>">

                    <div class="p-6 md:p-8 space-y-6">

                        <!-- Judul & No Surat -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Judul Rapat <span class="text-rose-500">*</span></label>
                                <input type="text" name="judul" value="<?= htmlspecialchars($nJudul) ?>" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm font-semibold" />
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Nomor Surat / Dokumen</label>
                                <input type="text" name="no_surat" value="<?= htmlspecialchars($nNoSurat) ?>" placeholder="e.g. 014/RW21/VIII/2026" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm font-semibold" />
                            </div>
                        </div>

                        <!-- Kategori, Tanggal, Lokasi -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Kategori Rapat <span class="text-rose-500">*</span></label>
                                <select name="kategori" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm font-semibold cursor-pointer">
                                    <option value="rutin" <?= $nKategori === 'rutin' ? 'selected' : '' ?>>Rapat Rutin</option>
                                    <option value="khusus" <?= $nKategori === 'khusus' ? 'selected' : '' ?>>Rapat Khusus</option>
                                    <option value="laporan" <?= $nKategori === 'laporan' ? 'selected' : '' ?>>Laporan Kas</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Tanggal Rapat <span class="text-rose-500">*</span></label>
                                <input type="date" name="tanggal" value="<?= htmlspecialchars($nTanggal) ?>" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm font-semibold cursor-pointer" />
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Lokasi <span class="text-rose-500">*</span></label>
                                <input type="text" name="lokasi" value="<?= htmlspecialchars($nLokasi) ?>" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm font-semibold" />
                            </div>
                        </div>

                        <!-- Waktu & Notulis -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Waktu Mulai <span class="text-rose-500">*</span></label>
                                <input type="text" name="waktu_mulai" value="<?= htmlspecialchars($nWMulai) ?>" placeholder="e.g. 20:00 WIB" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm font-semibold" />
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Waktu Selesai</label>
                                <input type="text" name="waktu_selesai" value="<?= htmlspecialchars($nWSelesai) ?>" placeholder="e.g. 22:30 WIB" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm font-semibold" />
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Notulis / Penulis <span class="text-rose-500">*</span></label>
                                <input type="text" name="notulis" value="<?= htmlspecialchars($nNotulis) ?>" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm font-semibold" />
                            </div>
                        </div>

                        <!-- Agenda -->
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Agenda Rapat <span class="text-rose-500">*</span></label>
                            <textarea name="agenda" rows="3" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm font-normal resize-none"><?= htmlspecialchars($nAgenda) ?></textarea>
                        </div>

                        <!-- Hasil Pembahasan -->
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Hasil Pembahasan <span class="text-rose-500">*</span></label>
                            <textarea name="hasil_pembahasan" rows="4" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm font-normal resize-none"><?= htmlspecialchars($nHasil) ?></textarea>
                        </div>

                        <!-- Keputusan Akhir -->
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Keputusan Akhir <span class="text-rose-500">*</span></label>
                            <textarea name="keputusan_akhir" rows="3" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm font-normal resize-none"><?= htmlspecialchars($nKeputusan) ?></textarea>
                        </div>

                        <!-- Lampiran Document -->
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Lampiran Dokumen</label>
                            <?php if (!empty($nFile)): ?>
                                <div class="mb-3 p-3 bg-purple-50 border border-purple-200 rounded-xl flex items-center justify-between gap-3 w-max">
                                    <span class="text-xs font-bold text-purple-800">Dokumen Saat Ini: <?= htmlspecialchars($nFile) ?></span>
                                    <a href="/uploads/notulensi/<?= htmlspecialchars($nFile) ?>" download class="text-xs font-extrabold text-purple-600 hover:underline">Unduh</a>
                                </div>
                            <?php endif; ?>

                            <p class="text-[11px] text-gray-400 mb-2">Ganti file (Opsional). Hanya menerima PDF, DOC, atau DOCX.</p>
                            <input type="file" name="lampiran" accept=".pdf,.doc,.docx" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 transition cursor-pointer" />
                        </div>

                    </div>

                    <!-- Tombol Aksi -->
                    <div class="px-6 py-5 md:px-8 bg-gray-50 border-t border-gray-200 flex flex-col sm:flex-row-reverse gap-3">
                        <button type="submit" class="px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white text-sm font-bold rounded-xl shadow-md transition flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Perbarui Notulensi
                        </button>
                        <a href="/notulensi" class="px-6 py-3 bg-white border border-gray-300 hover:bg-gray-100 text-gray-700 text-sm font-bold rounded-xl transition text-center">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>

</html>
