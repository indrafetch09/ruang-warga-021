<!doctype html>
<html lang="id">

<head>
    <title>Kelola Galeri Kegiatan - Dasbor Pengurus RW 021</title>
    <?php require base_path('views/partials/head.php'); ?>
</head>

<body class="text-gray-800 bg-gray-50 flex flex-col min-h-screen">
    <!-- ADMIN HEADER -->
    <?php require base_path('views/partials/admin-header.php'); ?>

    <!-- WRAPPER SIDEBAR & MAIN CONTENT -->
    <div class="flex flex-1 max-w-[1400px] w-full mx-auto relative">
        <?php require base_path('views/partials/admin-sidebar.php'); ?>

        <main class="flex-1 w-full min-w-0 p-4 sm:p-6 lg:p-8 space-y-8">

            <!-- HEADER SECTION -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <a href="/dashboard" class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-purple-600 transition mb-2 group">
                        <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke Dasbor
                    </a>
                    <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">
                        Galeri Dokumentasi <span class="text-purple-600">Kegiatan RW 021</span>
                    </h2>
                    <p class="text-xs md:text-sm text-gray-500 mt-1">
                        Unggah dan kelola foto kegiatan kemasyarakatan, Posyandu, olahraga, dan kerja bakti warga RW 021.
                    </p>
                </div>
            </div>

            <!-- FLASH MESSAGE NOTIFICATION -->
            <?php
            $sukses = \Core\Session::get('sukses');
            $flashError = \Core\Session::get('error');
            $old = \Core\Session::get('old') ?? [];
            ?>

            <?php if (!empty($sukses)): ?>
                <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-bold rounded-xl flex items-center gap-2 shadow-sm max-w-4xl">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <?= htmlspecialchars($sukses) ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($flashError)): ?>
                <div class="p-4 bg-red-50 border border-red-200 text-red-700 text-sm font-bold rounded-xl flex items-center gap-2 shadow-sm max-w-4xl">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <?= htmlspecialchars($flashError) ?>
                </div>
            <?php endif; ?>

            <!-- FORM UNGGAH FOTO GALERI -->
            <div class="bg-white rounded-2xl shadow-sm border border-purple-100 overflow-hidden max-w-4xl">
                <form action="/admin/galeri" method="POST" enctype="multipart/form-data">
                    <?= \Core\Csrf::field() ?>

                    <div class="p-6 md:p-8 space-y-6">
                        <h3 class="text-base font-bold text-purple-700 border-b border-purple-100 pb-3 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Unggah Foto Dokumentasi Baru
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Judul Kegiatan / Foto <span class="text-rose-500">*</span></label>
                                <input type="text" name="judul" value="<?= htmlspecialchars($old['judul'] ?? '') ?>" placeholder="Contoh: Kerja Bakti Massal RT 05 & Pembersihan Saluran Air" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm font-semibold" required />
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Kategori Kegiatan <span class="text-rose-500">*</span></label>
                                <?php $cat = $old['kategori'] ?? ''; ?>
                                <select name="kategori" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm font-semibold cursor-pointer" required>
                                    <option value="" disabled <?= empty($cat) ? 'selected' : '' ?>>Pilih Kategori</option>
                                    <option value="sosial" <?= $cat === 'sosial' ? 'selected' : '' ?>>Sosial & Gotong Royong</option>
                                    <option value="kesehatan" <?= $cat === 'kesehatan' ? 'selected' : '' ?>>Kesehatan & Posyandu</option>
                                    <option value="perayaan" <?= $cat === 'perayaan' ? 'selected' : '' ?>>Perayaan & Olahraga</option>
                                    <option value="pertemuan" <?= $cat === 'pertemuan' ? 'selected' : '' ?>>Musyawarah & Rapat RW</option>
                                    <option value="lainnya" <?= $cat === 'lainnya' ? 'selected' : '' ?>>Lain-Lain / Umum</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Tanggal Pelaksanaan <span class="text-rose-500">*</span></label>
                                <input type="date" name="tanggal" value="<?= htmlspecialchars($old['tanggal'] ?? date('Y-m-d')) ?>" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm font-semibold" required />
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Dokumentasi Foto <span class="text-rose-500">*</span></label>

                                <!-- DRAG AND DROP ZONE -->
                                <div id="dropzone" onclick="document.getElementById('file-input').click()" class="relative border-2 border-dashed border-purple-200 hover:border-purple-500 bg-purple-50/40 hover:bg-purple-50/80 rounded-2xl p-8 text-center cursor-pointer transition flex flex-col items-center justify-center space-y-3 group">
                                    <input type="file" id="file-input" name="foto_file" accept="image/*" class="hidden" onchange="handleFileSelect(event)" required />

                                    <div id="dropzone-empty" class="flex flex-col items-center space-y-2">
                                        <div class="w-14 h-14 bg-purple-100 group-hover:bg-purple-200 text-purple-700 rounded-2xl flex items-center justify-center shadow-sm transition">
                                            <svg class="w-7 h-7 text-purple-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                            </svg>
                                        </div>
                                        <div class="text-xs">
                                            <span class="font-extrabold text-purple-700 hover:underline">Klik untuk telusuri foto</span> atau tarik & lepas (drag and drop) gambar di sini
                                        </div>
                                        <p class="text-[11px] text-gray-400">Format yang didukung: PNG, JPG, JPEG, WEBP (Maksimal 10 MB)</p>
                                    </div>

                                    <!-- PREVIEW CONTAINER -->
                                    <div id="dropzone-preview" class="hidden flex flex-col items-center space-y-3 w-full">
                                        <div class="relative w-full max-w-xs h-48 rounded-xl overflow-hidden shadow-md border border-purple-200">
                                            <img id="preview-image" src="" alt="Pratinjau Foto" class="w-full h-full object-cover" />
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span id="file-name" class="text-xs font-bold text-gray-800">filename.jpg</span>
                                            <button type="button" onclick="event.stopPropagation(); removeFile();" class="text-xs font-bold text-rose-600 hover:text-rose-800 underline">Ganti Foto</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Keterangan / Deskripsi Singkat</label>
                                <!-- NAMA FIELD DISESUAIKAN DENGAN NAMA KOLOM DATABASE 'deskripsi' -->
                                <textarea name="deskripsi" rows="3" placeholder="Tuliskan catatan singkat atau lokasi tempat dokumentasi foto diambil..." class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm font-medium"><?= htmlspecialchars($old['deskripsi'] ?? '') ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 bg-gray-50 border-t border-gray-100 flex items-center justify-end gap-3">
                        <a href="/dashboard" class="px-5 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold text-xs rounded-xl transition">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-2.5 bg-purple-600 hover:bg-purple-700 text-white font-bold text-xs rounded-xl transition shadow-md flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Simpan & Publikasikan Foto
                        </button>
                    </div>
                </form>
            </div>

            <!-- ARSIP GALERI TERUNGGAH (DINAMIS DARI DATABASE) -->
            <div class="bg-white rounded-2xl p-6 md:p-8 shadow-sm border border-gray-200 max-w-4xl space-y-4">
                <h3 class="text-base font-bold text-gray-900 border-b border-gray-100 pb-3">Dokumentasi Foto Terbaru</h3>

                <?php if (!empty($recentGaleri)): ?>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                        <?php foreach ($recentGaleri as $g): ?>
                            <div class="group relative rounded-xl overflow-hidden border border-purple-100 shadow-sm hover:shadow-md transition">
                                <img src="/uploads/galeri/<?= htmlspecialchars($g['file_foto']) ?>" alt="<?= htmlspecialchars($g['judul']) ?>" class="w-full h-36 object-cover transform group-hover:scale-105 transition duration-300" />
                                <div class="p-3 bg-white">
                                    <span class="text-[10px] font-bold text-purple-700 uppercase block mb-0.5"><?= htmlspecialchars($g['kategori']) ?></span>
                                    <h4 class="text-xs font-bold text-gray-900 truncate"><?= htmlspecialchars($g['judul']) ?></h4>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-xs text-gray-400 italic">Belum ada foto yang diunggah.</p>
                <?php endif; ?>
            </div>

        </main>
    </div>

    <!-- DRAG AND DROP SCRIPT -->
    <script src="/script.js"></script>
</body>

</html>
