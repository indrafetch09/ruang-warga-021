<!doctype html>
<html lang="id">

<head>
    <title>Assign Pengurus - Ruang Warga 021</title>
    <?php require base_path('views/partials/head.php'); ?>
</head>

<body class="bg-gray-50 min-h-screen py-10">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Tombol Kembali -->
        <a href="/pengurus-rw" class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-purple-600 transition mb-6 group">
            <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Struktur Pengurus
        </a>

        <!-- FLASH ERROR -->
        <?php $flashError = \Core\Session::get('error'); ?>
        <?php if (!empty($flashError)): ?>
            <div class="p-4 bg-red-50 border border-red-200 text-red-700 text-sm font-bold rounded-xl flex items-center gap-2 shadow-sm mb-6">
                <svg class="w-5 h-5 text-red-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span><?= htmlspecialchars($flashError) ?></span>
            </div>
        <?php endif; ?>

        <!-- Card Form -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-6 md:p-8 border-b border-gray-100 bg-purple-50/50">
                <h1 class="text-2xl font-extrabold text-gray-900">Assign / Penugasan Pengurus RW 021</h1>
                <p class="text-sm text-gray-500 mt-1">Cari nama warga terdaftar lalu tentukan posisi jabatannya.</p>
            </div>

            <form action="/admin/pengurus" method="POST" class="p-6 md:p-8 space-y-6">
                <?= \Core\Csrf::field() ?>
                <input type="hidden" name="warga_id" id="selectedWargaId" required>

                <!-- SECTION FITUR CARI WARGA DENGAN KLIK -->
                <div class="bg-purple-50/40 p-5 rounded-2xl border border-purple-100 space-y-4">
                    <label class="block text-xs font-bold uppercase text-purple-900 tracking-wider">
                        1. Cari & Pilih Warga Terverifikasi <span class="text-rose-500">*</span>
                    </label>

                    <!-- Filter RT + Search Bar -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <div>
                            <select id="filterRt" class="w-full px-3 py-2.5 bg-white border border-gray-200 rounded-xl text-xs font-semibold text-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-500 cursor-pointer">
                                <option value="">Semua RT (RT 01 - 10)</option>
                                <?php for ($i = 1; $i <= 10; $i++): ?>
                                    <option value="<?= sprintf('%02d', $i) ?>">RT <?= sprintf('%02d', $i) ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>

                        <div class="sm:col-span-2 relative">
                            <input type="text" id="searchWargaInput" placeholder="Ketik nama, blok, atau nomor rumah..." class="w-full px-3 py-2.5 pl-9 bg-white border border-gray-200 rounded-xl text-xs font-semibold text-gray-800 focus:outline-none focus:ring-2 focus:ring-purple-500" />
                            <svg class="w-4 h-4 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Indikator Warga Terpilih -->
                    <div id="selectedWargaBadge" class="hidden p-3 bg-purple-600 text-white rounded-xl text-xs font-bold flex items-center justify-between shadow-sm">
                        <span id="selectedWargaText">Warga Terpilih: -</span>
                        <span class="text-[10px] bg-purple-800 px-2 py-0.5 rounded uppercase">Terpilih ✓</span>
                    </div>

                    <!-- List Kartu Warga Terverifikasi -->
                    <div id="wargaListContainer" class="max-h-48 overflow-y-auto space-y-2 pr-1 custom-scrollbar border border-gray-200 rounded-xl p-2 bg-white">
                        <?php foreach ($wargaList as $w) : ?>
                            <?php 
                            $wId    = is_object($w) ? $w->id : $w['id'];
                            $wNama  = is_object($w) ? $w->nama : $w['nama'];
                            $wRt    = is_object($w) ? $w->rt : $w['rt'];
                            $wBlok  = is_object($w) ? $w->blok : $w['blok'];
                            $wNomor = is_object($w) ? $w->nomor : $w['nomor'];
                            $rtFormatted = sprintf('%02d', (int)$wRt);
                            $searchQuery = strtolower(htmlspecialchars($wNama . ' rt ' . $rtFormatted . ' blok ' . $wBlok . ' ' . $wNomor));
                            ?>
                            <div onclick="selectWarga('<?= $wId ?>', '<?= htmlspecialchars(addslashes($wNama)) ?>', '<?= $rtFormatted ?>', '<?= htmlspecialchars(addslashes($wBlok)) ?>', '<?= htmlspecialchars(addslashes($wNomor)) ?>', this)"
                                 data-rt="<?= $rtFormatted ?>" 
                                 data-search="<?= $searchQuery ?>"
                                 class="warga-card p-3 rounded-xl border border-gray-100 hover:border-purple-300 hover:bg-purple-50/50 cursor-pointer transition flex items-center justify-between">
                                <div>
                                    <h4 class="text-xs font-bold text-gray-900"><?= htmlspecialchars($wNama) ?></h4>
                                    <p class="text-[11px] text-gray-500">RT <?= htmlspecialchars($rtFormatted) ?> • Blok <?= htmlspecialchars($wBlok) ?>/<?= htmlspecialchars($wNomor) ?></p>
                                </div>
                                <span class="check-icon hidden text-purple-600 font-bold text-sm">✓</span>
                            </div>
                        <?php endforeach; ?>
                        <div id="noWargaMsg" class="hidden p-4 text-center text-xs text-gray-400">
                            Warga tidak ditemukan. Coba ketik nama lain atau ganti filter RT.
                        </div>
                    </div>
                </div>

                <!-- Grid Hirarki & Nama Jabatan -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-700 tracking-wider mb-2">
                            2. Kategori Hirarki <span class="text-rose-500">*</span>
                        </label>
                        <select id="selectKategori" name="kategori_jabatan" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm bg-white cursor-pointer font-semibold">
                            <option value="penasehat">Penasehat</option>
                            <option value="ketua">Ketua</option>
                            <option value="sekretaris">Sekretaris</option>
                            <option value="bendahara">Bendahara</option>
                            <option value="seksi" selected>Seksi / Koordinator</option>
                            <option value="tim_pendukung">Tim & Lembaga Pendukung</option>
                            <option value="ketua_rt">Ketua RT</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-700 tracking-wider mb-2">
                            3. Posisi / Jabatan Resmi <span class="text-rose-500">*</span>
                        </label>
                        <select id="selectJabatan" name="jabatan" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm bg-white cursor-pointer font-semibold">
                            <!-- Opsi diisi otomatis via JavaScript -->
                        </select>
                    </div>
                </div>

                <!-- Masa Bakti / Periode -->
                <div>
                    <label class="block text-xs font-bold uppercase text-gray-700 tracking-wider mb-2">
                        4. Masa Bakti / Periode
                    </label>
                    <input type="text" name="periode" value="2025 - 2028" placeholder="Misal: 2025 - 2028" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm font-semibold" />
                </div>

                <!-- Submit Button -->
                <div class="pt-4 flex gap-4">
                    <button type="submit" class="w-full md:w-auto px-8 py-3.5 bg-purple-600 hover:bg-purple-700 text-white font-bold text-sm rounded-xl shadow-lg shadow-purple-200 transition">
                        Simpan Pengurus
                    </button>
                    <a href="/pengurus-rw" class="w-full md:w-auto px-8 py-3.5 bg-white border border-gray-300 text-gray-700 font-bold text-sm rounded-xl hover:bg-gray-50 transition text-center">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- JAVASCRIPT LOGIC -->
    <script src="/script.js"></script>
</body>

</html>
