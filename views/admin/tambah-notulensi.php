<!doctype html>
<html lang="id">

<head>
    <?php $title = "Tambah Notulensi - Dasbor Pengurus RW 021";
    require base_path('views/partials/head.php'); ?>
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
                    <a href="/admin/notulensi" class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-purple-600 transition mb-2 group">
                        <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke Arsip Notulensi
                    </a>
                    <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">Tambah Notulensi Rapat</h2>
                    <p class="text-xs md:text-sm text-gray-500 mt-1">Dokumentasikan hasil musyawarah warga atau pengurus untuk arsip resmi sistem.</p>
                </div>
            </div>

            <!-- FORM CONTAINER -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden max-w-5xl mx-auto">
                <form action="/admin/notulensi" method="POST" enctype="multipart/form-data">
                    <?= \Core\Csrf::field() ?>

                    <!-- Bagian 1: Informasi Pelaksanaan -->
                    <div class="p-6 md:p-8 border-b border-gray-100">
                        <h3 class="text-base font-bold text-purple-700 mb-6 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Informasi Pelaksanaan Rapat
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Judul Rapat <span class="text-rose-500">*</span></label>
                                <input type="text" name="judul" placeholder="Contoh: Rapat Persiapan HUT RI ke-81 Wilayah RW 021" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm font-semibold" required>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Kategori Rapat <span class="text-rose-500">*</span></label>
                                <select name="kategori" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm font-semibold cursor-pointer" required>
                                    <option value="" disabled selected>Pilih Kategori</option>
                                    <option value="Rapat Rutin">Rapat Rutin</option>
                                    <option value="Rapat Khusus">Rapat Khusus / Insidental</option>
                                    <option value="Laporan Kas">Laporan Pertanggungjawaban / Kas</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Nomor Surat / Arsip</label>
                                <input type="text" name="no_surat" placeholder="Contoh: 014/RW21/VIII/2026" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm font-semibold">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Tanggal Pelaksanaan <span class="text-rose-500">*</span></label>
                                <input type="date" name="tanggal" value="<?= date('Y-m-d') ?>" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm font-semibold text-gray-700" required>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Waktu Mulai <span class="text-rose-500">*</span></label>
                                    <input type="time" name="waktu_mulai" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm font-semibold text-gray-700" required>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Waktu Selesai</label>
                                    <input type="time" name="waktu_selesai" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm font-semibold text-gray-700">
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Lokasi <span class="text-rose-500">*</span></label>
                                <input type="text" name="lokasi" placeholder="Contoh: Balai Warga RW 021" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm font-semibold" required>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Notulis / Penulis <span class="text-rose-500">*</span></label>
                                <input type="text" name="notulis" value="<?= htmlspecialchars($user['name'] ?? '') ?>" placeholder="Nama penulis notulensi" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm font-semibold" required>
                            </div>
                        </div>
                    </div>

                    <!-- Bagian 2: Rincian Pembahasan -->
                    <div class="p-6 md:p-8 border-b border-gray-100">
                        <h3 class="text-base font-bold text-emerald-600 mb-6 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Rincian Pembahasan
                        </h3>

                        <div class="space-y-6">
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Agenda Rapat <span class="text-rose-500">*</span></label>
                                <p class="text-[11px] text-gray-400 mb-2">Tuliskan poin-poin utama agenda musyawarah.</p>
                                <textarea name="agenda" rows="3" placeholder="1. Pembentukan Panitia 17-an&#10;2. Pembahasan Anggaran Kebersihan..." class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 transition text-sm" required></textarea>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Hasil Pembahasan <span class="text-rose-500">*</span></label>
                                <p class="text-[11px] text-gray-400 mb-2">Uraikan ringkasan diskusi dan masukan dari peserta rapat.</p>
                                <textarea name="hasil_pembahasan" rows="5" placeholder="Berdasarkan hasil musyawarah warga, beberapa ketua RT menyampaikan usulan..." class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 transition text-sm" required></textarea>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Keputusan Akhir <span class="text-rose-500">*</span></label>
                                <p class="text-[11px] text-gray-400 mb-2">Tuliskan kesimpulan dan poin keputusan final yang disepakati.</p>
                                <textarea name="keputusan_akhir" rows="4" placeholder="1. Iuran kegiatan disepakati sebesar Rp 50.000/KK...&#10;2. Pelaksanaan kerja bakti serentak pada tanggal..." class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 transition text-sm" required></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Bagian 3: Lampiran Dokumen -->
                    <div class="p-6 md:p-8">
                        <h3 class="text-base font-bold text-sky-600 mb-6 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                            </svg>
                            Lampiran Dokumen Resmi
                        </h3>

                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Unggah File Dokumen (PDF / DOCX)</label>

                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:bg-gray-50 transition cursor-pointer">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600 justify-center">
                                        <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-bold text-purple-600 hover:text-purple-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-purple-500">
                                            <span>Pilih file dokumen</span>
                                            <input id="file-upload" name="lampiran" type="file" class="sr-only" accept=".pdf,.doc,.docx">
                                        </label>
                                        <p class="pl-1">atau *drag and drop*</p>
                                    </div>
                                    <p class="text-xs text-gray-500">
                                        Format PDF atau DOCX, ukuran maksimal 5MB.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="px-6 py-5 md:px-8 bg-gray-50 border-t border-gray-200 flex flex-col sm:flex-row-reverse gap-3">
                        <button type="submit" class="px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white text-sm font-bold rounded-xl shadow-md transition flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Simpan Notulensi
                        </button>
                        <a href="/admin/notulensi" class="px-6 py-3 bg-white border border-gray-300 hover:bg-gray-100 text-gray-700 text-sm font-bold rounded-xl transition text-center">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>

</html>