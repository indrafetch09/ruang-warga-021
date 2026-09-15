<!doctype html>
<html lang="id">

<head>
    <title>Edit Pengurus - Ruang Warga 021</title>
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

        <!-- ALERT ERROR -->
        <?php $flashError = \Core\Session::get('error'); ?>
        <?php if (!empty($flashError)): ?>
            <div class="p-4 bg-red-50 border border-red-200 text-red-700 text-sm font-bold rounded-xl flex items-center gap-2 shadow-sm mb-4">
                <svg class="w-5 h-5 text-red-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <?= htmlspecialchars($flashError) ?>
            </div>
        <?php endif; ?>

        <?php
        $pId      = is_object($pengurus) ? $pengurus->id : ($pengurus['id'] ?? '');
        $pWId     = is_object($pengurus) ? $pengurus->warga_id : ($pengurus['warga_id'] ?? '');
        $pKat     = is_object($pengurus) ? $pengurus->kategori_jabatan : ($pengurus['kategori_jabatan'] ?? 'seksi');
        $pJabatan = is_object($pengurus) ? $pengurus->jabatan : ($pengurus['jabatan'] ?? '');
        $pPeriode = is_object($pengurus) ? $pengurus->periode : ($pengurus['periode'] ?? '2025 - 2028');
        ?>

        <!-- Card Form -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-6 md:p-8 border-b border-gray-100 bg-purple-50/50">
                <h1 class="text-2xl font-extrabold text-gray-900">Edit Jabatan Pengurus</h1>
                <p class="text-sm text-gray-500 mt-1">Ubah data penugasan atau alokasi jabatan pengurus RW 021.</p>
            </div>

            <form action="/admin/pengurus/update" method="POST" class="p-6 md:p-8 space-y-6">
                <?= \Core\Csrf::field() ?>
                <input type="hidden" name="id" value="<?= $pId ?>">

                <!-- Select Warga -->
                <div>
                    <label class="block text-xs font-bold uppercase text-gray-700 tracking-wider mb-2">
                        Pilih Warga Terverifikasi <span class="text-rose-500">*</span>
                    </label>
                    <select name="warga_id" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm bg-white cursor-pointer font-semibold">
                        <option value="">-- Pilih Warga (Terverifikasi) --</option>
                        <?php foreach ($wargaList as $w) : ?>
                            <?php
                            $wId    = is_object($w) ? $w->id : $w['id'];
                            $wNama  = is_object($w) ? $w->nama : $w['nama'];
                            $wRt    = is_object($w) ? $w->rt : $w['rt'];
                            $wBlok  = is_object($w) ? $w->blok : $w['blok'];
                            $wNomor = is_object($w) ? $w->nomor : $w['nomor'];
                            ?>
                            <option value="<?= $wId ?>" <?= $wId == $pWId ? 'selected' : '' ?>>
                                <?= htmlspecialchars($wNama) ?> (RT <?= htmlspecialchars($wRt) ?> - Blok <?= htmlspecialchars($wBlok) ?>/<?= htmlspecialchars($wNomor) ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Grid Hirarki & Nama Jabatan -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-700 tracking-wider mb-2">
                            Kategori Hirarki <span class="text-rose-500">*</span>
                        </label>
                        <select id="selectKategori" name="kategori_jabatan" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm bg-white cursor-pointer font-semibold">
                            <option value="penasehat" <?= $pKat === 'penasehat' ? 'selected' : '' ?>>Penasehat</option>
                            <option value="ketua" <?= $pKat === 'ketua' ? 'selected' : '' ?>>Ketua</option>
                            <option value="sekretaris" <?= $pKat === 'sekretaris' ? 'selected' : '' ?>>Sekretaris</option>
                            <option value="bendahara" <?= $pKat === 'bendahara' ? 'selected' : '' ?>>Bendahara</option>
                            <option value="seksi" <?= $pKat === 'seksi' ? 'selected' : '' ?>>Seksi / Koordinator</option>
                            <option value="tim_pendukung" <?= $pKat === 'tim_pendukung' ? 'selected' : '' ?>>Tim & Lembaga Pendukung</option>
                            <option value="ketua_rt" <?= $pKat === 'ketua_rt' ? 'selected' : '' ?>>Ketua RT</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-700 tracking-wider mb-2">
                            Posisi / Jabatan Resmi <span class="text-rose-500">*</span>
                        </label>
                        <select id="selectJabatan" name="jabatan" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm bg-white cursor-pointer font-semibold">
                            <!-- Opsi otomatis terisi via JavaScript -->
                        </select>
                    </div>
                </div>

                <!-- Masa Bakti / Periode -->
                <div>
                    <label class="block text-xs font-bold uppercase text-gray-700 tracking-wider mb-2">
                        Masa Bakti / Periode
                    </label>
                    <input type="text" name="periode" value="<?= htmlspecialchars($pPeriode) ?>" placeholder="e.g. 2025 - 2028" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm font-semibold" />
                </div>

                <!-- Submit Button -->
                <div class="pt-4 flex gap-4">
                    <button type="submit" class="w-full md:w-auto px-8 py-3.5 bg-purple-600 hover:bg-purple-700 text-white font-bold text-sm rounded-xl shadow-lg shadow-purple-200 transition">
                        Perbarui Pengurus
                    </button>
                    <a href="/pengurus-rw" class="w-full md:w-auto px-8 py-3.5 bg-white border border-gray-300 text-gray-700 font-bold text-sm rounded-xl hover:bg-gray-50 transition text-center">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- JAVASCRIPT UNTUK DYNAMIC DEPENDENT DROPDOWN -->
    <script src="/script.js"></script>
</body>

</html>
