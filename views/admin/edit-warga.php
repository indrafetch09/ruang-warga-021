<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Data Warga - Dasbor Pengurus RW 021</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="/css/theme.css" />
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

            <?php
            $isObject = is_object($user);
            $isRt = ($isObject && method_exists($user, 'isRt')) ? $user->isRt() : (($user['role'] ?? '') === 'rt');
            $assignedRt = ($isObject && method_exists($user, 'getRtAssigned')) ? $user->getRtAssigned() : ($user['rt'] ?? 1);

            // Helper ekstraksi data aman
            $val = function($key, $default = '') use ($warga) {
                if (is_array($warga)) return $warga[$key] ?? $default;
                if (is_object($warga)) return $warga->$key ?? $default;
                return $default;
            };
            ?>

            <!-- HEADER SECTION -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                <div>
                    <a href="/admin/warga" class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-purple-600 transition mb-2 group">
                        <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke Data Penduduk
                    </a>
                    <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">
                        Edit Data Warga
                    </h2>
                    <p class="text-xs md:text-sm text-gray-500 mt-1">
                        Perbarui rincian identitas, hubungan keluarga, dan pekerjaan warga.
                    </p>
                </div>
            </div>

            <!-- FORM CONTAINER -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden max-w-4xl mx-auto">
                <form action="/admin/warga/update" method="POST">
                    <?= \Core\Csrf::field() ?>
                    <input type="hidden" name="id" value="<?= $val('id') ?>">

                    <!-- Bagian 1: Identitas Utama -->
                    <div class="p-6 md:p-8 border-b border-gray-100">
                        <h3 class="text-base font-bold text-purple-700 mb-6 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path>
                            </svg>
                            Identitas Kependudukan
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">NIK Warga <span class="text-rose-500">*</span></label>
                                <input type="number" name="nik" value="<?= htmlspecialchars($val('nik_readable', $val('nik'))) ?>" placeholder="16 digit NIK Warga" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm font-semibold" required />
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">NIK Kepala Keluarga <span class="text-rose-500">*</span></label>
                                <input type="number" name="nik_kepala_keluarga" value="<?= htmlspecialchars($val('nik_kk_readable', $val('nik_kepala_keluarga'))) ?>" placeholder="16 digit NIK Kepala Keluarga" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm font-semibold" required />
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Nama Lengkap (Sesuai KTP) <span class="text-rose-500">*</span></label>
                                <input type="text" name="nama" value="<?= htmlspecialchars($val('nama')) ?>" placeholder="Masukkan nama lengkap" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm font-semibold" required />
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Hubungan Dalam Keluarga (Status KK) <span class="text-rose-500">*</span></label>
                                <?php $sk = strtolower($val('status_keluarga', 'famili_lain')); ?>
                                <select name="status_keluarga" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm font-semibold cursor-pointer" required>
                                    <option value="kepala_keluarga" <?= $sk === 'kepala_keluarga' ? 'selected' : '' ?>>Kepala Keluarga</option>
                                    <option value="istri" <?= $sk === 'istri' ? 'selected' : '' ?>>Istri</option>
                                    <option value="anak" <?= $sk === 'anak' ? 'selected' : '' ?>>Anak</option>
                                    <option value="orang_tua" <?= $sk === 'orang_tua' ? 'selected' : '' ?>>Orang Tua / Mertua</option>
                                    <option value="famili_lain" <?= ($sk === 'famili_lain' || $sk === 'anggota_keluarga') ? 'selected' : '' ?>>Famili Lain / Lainnya</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" value="<?= htmlspecialchars($val('tempat_lahir')) ?>" placeholder="Contoh: Tangerang" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm font-semibold" />
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" value="<?= htmlspecialchars($val('tanggal_lahir')) ?>" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm font-semibold text-gray-700" />
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Jenis Kelamin</label>
                                <?php $jk = $val('jenis_kelamin'); ?>
                                <select name="jenis_kelamin" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm font-semibold cursor-pointer">
                                    <option value="L" <?= $jk === 'L' ? 'selected' : '' ?>>Laki-laki</option>
                                    <option value="P" <?= $jk === 'P' ? 'selected' : '' ?>>Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Bagian 2: Alamat Domisili -->
                    <div class="p-6 md:p-8 border-b border-gray-100">
                        <h3 class="text-base font-bold text-emerald-600 mb-6 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Alamat Domisili RW 021
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Rukun Tetangga (RT) <span class="text-rose-500">*</span></label>
                                <?php $wRt = (int)$val('rt', 1); ?>
                                <?php if ($isRt): ?>
                                    <input type="hidden" name="rt" value="<?= $assignedRt ?>">
                                    <input type="text" value="RT <?= sprintf('%02d', $assignedRt) ?> (Wilayah Anda)" class="w-full px-4 py-3 bg-gray-100 border border-gray-200 rounded-xl text-sm font-bold text-purple-700 cursor-not-allowed" readonly />
                                <?php else: ?>
                                    <select name="rt" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 transition text-sm font-semibold cursor-pointer" required>
                                        <?php for ($i = 1; $i <= 10; $i++): ?>
                                            <option value="<?= $i ?>" <?= $wRt === $i ? 'selected' : '' ?>>RT <?= sprintf('%02d', $i) ?></option>
                                        <?php endfor; ?>
                                    </select>
                                <?php endif; ?>
                            </div>

                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Blok <span class="text-rose-500">*</span></label>
                                    <input type="text" name="blok" value="<?= htmlspecialchars($val('blok')) ?>" placeholder="Misal: TA 14" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 transition text-sm font-semibold" required />
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">No. Rumah <span class="text-rose-500">*</span></label>
                                    <input type="text" name="nomor" value="<?= htmlspecialchars($val('nomor')) ?>" placeholder="Misal: 11" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 transition text-sm font-semibold" required />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bagian 3: Informasi Tambahan & Pekerjaan -->
                    <div class="p-6 md:p-8">
                        <h3 class="text-base font-bold text-gray-900 mb-6 flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 022 2h2a2 2 0 022-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                            </svg>
                            Informasi Tambahan & Pekerjaan
                        </h3>

                        <div class="space-y-6">
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Agama</label>
                                <?php $wAgama = strtolower($val('agama')); ?>
                                <select name="agama" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm font-semibold cursor-pointer">
                                    <option value="islam" <?= $wAgama === 'islam' ? 'selected' : '' ?>>Islam</option>
                                    <option value="kristen" <?= $wAgama === 'kristen' ? 'selected' : '' ?>>Kristen Protestan</option>
                                    <option value="katolik" <?= $wAgama === 'katolik' ? 'selected' : '' ?>>Katolik</option>
                                    <option value="hindu" <?= $wAgama === 'hindu' ? 'selected' : '' ?>>Hindu</option>
                                    <option value="buddha" <?= $wAgama === 'buddha' ? 'selected' : '' ?>>Buddha</option>
                                    <option value="konghucu" <?= $wAgama === 'konghucu' ? 'selected' : '' ?>>Konghucu</option>
                                </select>
                            </div>

                            <!-- DEPENDENT DROPDOWN PEKERJAAN -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                                        1. Kategori Bidang Pekerjaan <span class="text-rose-500">*</span>
                                    </label>
                                    <select id="selectKategoriPekerjaan" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm font-semibold cursor-pointer">
                                        <option value="profesional">Perdagangan & Jasa Profesional</option>
                                        <option value="status_kondisi">Status & Kondisi Umum</option>
                                        <option value="aparatur">Aparatur Negara & Pejabat Publik</option>
                                        <option value="industri">Industri, Konstruksi & Transportasi</option>
                                        <option value="pendidikan">Pendidikan & Penelitian</option>
                                        <option value="kesehatan">Kesehatan & Medis</option>
                                        <option value="jasa_perorangan">Keterampilan & Jasa Perorangan</option>
                                        <option value="media_seni">Seni, Budaya & Media</option>
                                        <option value="spiritual">Keagamaan & Spiritual</option>
                                        <option value="pertanian">Pertanian & Peternakan</option>
                                        <option value="olahraga">Olahraga</option>
                                        <option value="lainnya">Lainnya</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                                        2. Profesi Pekerjaan Resmi <span class="text-rose-500">*</span>
                                    </label>
                                    <select id="selectPekerjaan" name="pekerjaan" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm font-semibold cursor-pointer">
                                        <!-- Diisi otomatis oleh script.js -->
                                    </select>
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
                            Perbarui Data Warga
                        </button>
                        <a href="/admin/warga" class="px-6 py-3 bg-white border border-gray-300 hover:bg-gray-100 text-gray-700 text-sm font-bold rounded-xl transition text-center">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <!-- PENGATURAN AWAL NILAI PEKERJAAN & SCRIPT -->
    <script>
        window.currentPekerjaan = <?= json_encode($val('pekerjaan', 'Karyawan Swasta')) ?>;
    </script>
    <script src="/script.js"></script>
</body>

</html>
