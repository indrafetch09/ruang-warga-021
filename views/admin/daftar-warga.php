<!doctype html>
<html lang="id">

<head>
    <?php $title = "Data Penduduk - Dasbor Pengurus RW 021";
    require base_path('views/partials/head.php'); ?>
</head>

<body class="bg-gray-50 flex flex-col min-h-screen text-gray-800">
    <!-- ADMIN HEADER -->
    <?php require base_path('views/partials/admin-header.php'); ?>

    <!-- WRAPPER SIDEBAR & MAIN CONTENT -->
    <div class="flex flex-1 max-w-[1400px] w-full mx-auto relative">
        <?php require base_path('views/partials/admin-sidebar.php'); ?>

        <main class="flex-1 w-full min-w-0 p-4 sm:p-6 lg:p-8 space-y-6">

            <?php
            // Helper pengecekan role user
            $isObject = is_object($user);
            $isRw = ($isObject && method_exists($user, 'isRw')) ? $user->isRw() : (($user['role'] ?? $user->data['role'] ?? '') === 'admin' || ($user['role'] ?? $user->data['role'] ?? '') === 'rw');
            $isRt = ($isObject && method_exists($user, 'isRt')) ? $user->isRt() : (($user['role'] ?? $user->data['role'] ?? '') === 'rt');
            $assignedRt = ($isObject && method_exists($user, 'getRtAssigned')) ? $user->getRtAssigned() : ($user['rt'] ?? $user->data['rt'] ?? 1);

            // Helper Ambil Properti Object / Array
            $getVal = function ($item, $key, $default = '-') {
                if (is_object($item)) return $item->$key ?? $default;
                if (is_array($item)) return $item[$key] ?? $default;
                return $default;
            };

            // Fallback Data Contoh jika database masih kosong
            $listWarga = $wargaList ?? [];
            $listPending = $pendingList ?? [];
            ?>

            <!-- PAGE HEADER & ACTION -->
            <div class="bg-white p-6 rounded-2xl border border-purple-100 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">
                            Data <span class="text-purple-600">Penduduk</span>
                        </h1>
                        <?php if ($isRw): ?>
                            <span class="px-3 py-1 bg-purple-100 text-purple-700 font-bold text-xs rounded-full border border-purple-200">
                                Akses RW (Semua RT)
                            </span>
                        <?php else: ?>
                            <span class="px-3 py-1 bg-emerald-100 text-emerald-800 font-bold text-xs rounded-full border border-emerald-200">
                                Wilayah RT <?= sprintf('%02d', $assignedRt) ?>
                            </span>
                        <?php endif; ?>
                    </div>
                    <p class="text-xs text-gray-500">
                        <?= $isRw ? 'Direktori data seluruh Kepala Keluarga (KK) dan warga terdaftar di RW 021.' : 'Direktori data warga terdaftar khusus di lingkungan RT ' . sprintf('%02d', $assignedRt) . '.' ?>
                    </p>
                </div>

                <div class="flex gap-3">
                    <button onclick="openGlobalSettingsModal()" class="px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-xl text-xs transition flex items-center gap-1.5 border border-gray-200 shadow-sm">
                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Pengaturan Data
                    </button>
                    <a href="/admin/warga/create" class="px-4 py-2.5 bg-purple-600 hover:bg-purple-700 text-white font-bold rounded-xl text-xs transition shadow-md flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Warga Baru
                    </a>
                </div>
            </div>

            <!-- FLASH MESSAGE NOTIFICATION -->
            <?php if ($sukses = \Core\Session::get('sukses')): ?>
                <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-bold rounded-xl flex items-center gap-2 shadow-sm">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <?= htmlspecialchars($sukses) ?>
                </div>
            <?php endif; ?>

            <!-- PRIVACY ALERT BANNER -->
            <div class="p-4 bg-sky-50 border border-sky-100 rounded-xl flex gap-3 items-start">
                <div class="mt-0.5 text-sky-500 flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="text-xs text-sky-800 leading-relaxed">
                    <strong class="font-bold">Keamanan & Privasi Data Warga:</strong>
                    NIK dan Nomor Kontak warga dienkripsi secara ketat di basis data. Sebagai pengurus terautentikasi, Anda dapat meninjau rincian lengkap melalui tombol <span class="font-bold underline">Detail</span> di setiap baris.
                </div>
            </div>

            <!-- TABS SWITCHER (VERIFIED vs PENDING) -->
            <div class="flex border-b border-gray-200 gap-2">
                <button id="tab-verified-btn" onclick="switchTab('verified')" class="px-5 py-3 text-sm font-bold border-b-2 border-purple-600 text-purple-600 flex items-center gap-2 transition">
                    <span>Warga Terverifikasi</span>
                    <span class="px-2 py-0.5 text-xs bg-purple-100 text-purple-700 rounded-full font-extrabold"><?= count($listWarga) ?></span>
                </button>
                <button id="tab-pending-btn" onclick="switchTab('pending')" class="px-5 py-3 text-sm font-bold border-b-2 border-transparent text-gray-500 hover:text-purple-600 flex items-center gap-2 transition">
                    <span>Menunggu Persetujuan</span>
                    <?php if (count($listPending) > 0): ?>
                        <span class="px-2 py-0.5 text-xs bg-amber-100 text-amber-800 rounded-full font-extrabold animate-pulse"><?= count($listPending) ?></span>
                    <?php else: ?>
                        <span class="px-2 py-0.5 text-xs bg-gray-100 text-gray-600 rounded-full font-bold">0</span>
                    <?php endif; ?>
                </button>
            </div>

            <!-- TAB 1: TABEL WARGA TERVERIFIKASI -->
            <div id="tab-verified-content" class="space-y-6">
                <!-- TOOLBAR FILTER -->
                <form action="/admin/warga" method="GET" class="flex flex-col md:flex-row justify-between items-center gap-4 bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
                    <div class="w-full md:w-1/3 relative">
                        <svg class="w-5 h-5 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input type="text" name="q" value="<?= htmlspecialchars($_GET['q'] ?? '') ?>" placeholder="Cari nama Kepala Keluarga..." class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm font-medium" />
                    </div>

                    <div class="w-full md:w-auto flex flex-col sm:flex-row gap-3">
                        <!-- Pilihan RT: Jika RW bisa pilih semua RT, Jika RT dikunci ke RT miliknya -->
                        <select name="rt" onchange="this.form.submit()" <?= $isRt ? 'disabled' : '' ?> class="w-full sm:w-auto px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm font-semibold text-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-500 cursor-pointer">
                            <?php if ($isRw): ?>
                                <option value="">Semua RT</option>
                                <?php for ($i = 1; $i <= 10; $i++): ?>
                                    <option value="<?= $i ?>" <?= ($_GET['rt'] ?? '') == $i ? 'selected' : '' ?>>RT <?= sprintf('%02d', $i) ?></option>
                                <?php endfor; ?>
                            <?php else: ?>
                                <option value="<?= $assignedRt ?>">RT <?= sprintf('%02d', $assignedRt) ?> (Wilayah Anda)</option>
                            <?php endif; ?>
                        </select>

                        <select name="status_warga" onchange="this.form.submit()" class="w-full sm:w-auto px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm font-semibold text-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-500 cursor-pointer">
                            <option value="">Semua Status</option>
                            <option value="tetap" <?= ($_GET['status_warga'] ?? '') === 'tetap' ? 'selected' : '' ?>>Warga Tetap</option>
                            <option value="kontrak" <?= ($_GET['status_warga'] ?? '') === 'kontrak' ? 'selected' : '' ?>>Warga Kontrak</option>
                            <option value="kos" <?= ($_GET['status_warga'] ?? '') === 'kos' ? 'selected' : '' ?>>Kos</option>
                        </select>
                    </div>
                </form>

                <!-- TABEL DATA -->
                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
                    <?php if (empty($listWarga)): ?>
                        <div class="p-12 text-center">
                            <div class="w-16 h-16 bg-purple-50 text-purple-600 rounded-full flex items-center justify-center mx-auto mb-3 font-bold text-2xl">👥</div>
                            <h3 class="text-base font-bold text-gray-800">Tidak ada data warga ditemukan</h3>
                            <p class="text-xs text-gray-500 mt-1">Belum ada data warga terverifikasi yang sesuai dengan kriteria pencarian.</p>
                        </div>
                    <?php else: ?>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse whitespace-nowrap">
                                <thead>
                                    <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase tracking-wider text-gray-500 font-bold">
                                        <th class="px-6 py-4">No</th>
                                        <th class="px-6 py-4">Kepala Keluarga</th>
                                        <th class="px-6 py-4">Blok / No. Rumah</th>
                                        <th class="px-6 py-4 text-center">RT</th>
                                        <th class="px-6 py-4 text-center">Anggota</th>
                                        <th class="px-6 py-4">Status Warga</th>
                                        <th class="px-6 py-4 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                                    <?php $no = 1;
                                    foreach ($listWarga as $w): ?>
                                        <tr class="hover:bg-purple-50/40 transition-colors">
                                            <td class="px-6 py-4 font-medium text-gray-400"><?= $no++ ?></td>
                                            <td class="px-6 py-4 font-bold text-gray-900">
                                                <?= htmlspecialchars($getVal($w, 'nama')) ?>
                                                <span class="block text-[11px] text-gray-400 font-normal">KK: <?= htmlspecialchars($getVal($w, 'no_kk')) ?></span>
                                            </td>
                                            <td class="px-6 py-4 font-medium">
                                                Blok <?= htmlspecialchars($getVal($w, 'blok')) ?> No. <?= htmlspecialchars($getVal($w, 'nomor')) ?>
                                            </td>
                                            <td class="px-6 py-4 text-center font-bold text-purple-700">
                                                <?= sprintf('%02d', $getVal($w, 'rt')) ?>
                                            </td>
                                            <td class="px-6 py-4 text-center font-semibold">
                                                <?= htmlspecialchars($getVal($w, 'jml_anggota_keluarga', 1)) ?> Orang
                                            </td>
                                            <td class="px-6 py-4">
                                                <?php
                                                $st = strtolower($getVal($w, 'status_warga', 'tetap'));
                                                $badgeClass = match ($st) {
                                                    'kontrak' => 'bg-amber-100 text-amber-800',
                                                    'kos'     => 'bg-sky-100 text-sky-800',
                                                    default   => 'bg-emerald-100 text-emerald-800'
                                                };
                                                ?>
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold <?= $badgeClass ?>">
                                                    <?= ucfirst($st) ?>
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <div class="flex items-center justify-center gap-2">
                                                    <button onclick="showDetailModal(<?= htmlspecialchars(json_encode($w)) ?>)" class="text-purple-600 hover:text-purple-800 font-bold text-xs px-3 py-1.5 rounded-lg bg-purple-50 hover:bg-purple-100 transition">
                                                        Detail
                                                    </button>
                                                    <button onclick="openRowSettingsModal(<?= htmlspecialchars(json_encode($w)) ?>)" class="text-gray-600 hover:text-gray-800 font-bold text-xs p-1.5 rounded-lg bg-gray-100 hover:bg-gray-200 transition" title="Pengaturan Warga">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- TAB 2: TABEL MENUNGGU PERSETUJUAN (PENDING APPROVAL) -->
            <div id="tab-pending-content" class="space-y-6 hidden">
                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
                    <div class="p-4 bg-amber-50 border-b border-amber-100 flex items-center justify-between">
                        <span class="text-xs font-bold text-amber-900 uppercase tracking-wider">
                            Daftar Pengajuan Warga Baru (Perlu Verifikasi)
                        </span>
                        <?php if ($isRw): ?>
                            <span class="text-xs text-amber-700 font-semibold">Khusus Hak Akses RW</span>
                        <?php else: ?>
                            <span class="text-xs text-amber-700 font-semibold">Status Pengajuan RT <?= sprintf('%02d', $assignedRt) ?></span>
                        <?php endif; ?>
                    </div>

                    <?php if (empty($listPending)): ?>
                        <div class="p-12 text-center">
                            <div class="w-16 h-16 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-3 font-bold text-2xl">✓</div>
                            <h3 class="text-base font-bold text-gray-800">Tidak ada pengajuan pending</h3>
                            <p class="text-xs text-gray-500 mt-1">Semua data warga yang diajukan telah diverifikasi.</p>
                        </div>
                    <?php else: ?>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse whitespace-nowrap">
                                <thead>
                                    <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase tracking-wider text-gray-500 font-bold">
                                        <th class="px-6 py-4">Nama Warga</th>
                                        <th class="px-6 py-4">Alamat Rumah</th>
                                        <th class="px-6 py-4 text-center">RT</th>
                                        <th class="px-6 py-4">No. HP</th>
                                        <th class="px-6 py-4 text-center">Aksi Verifikasi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                                    <?php foreach ($listPending as $pw): ?>
                                        <tr class="hover:bg-amber-50/30 transition-colors">
                                            <td class="px-6 py-4 font-bold text-gray-900">
                                                <?= htmlspecialchars($getVal($pw, 'nama')) ?>
                                                <span class="block text-[11px] text-gray-400 font-normal">NIK: <?= htmlspecialchars($getVal($pw, 'nik_readable', '***')) ?></span>
                                            </td>
                                            <td class="px-6 py-4 font-medium">
                                                Blok <?= htmlspecialchars($getVal($pw, 'blok')) ?> No. <?= htmlspecialchars($getVal($pw, 'nomor')) ?>
                                            </td>
                                            <td class="px-6 py-4 text-center font-bold text-purple-700">
                                                RT <?= sprintf('%02d', $getVal($pw, 'rt')) ?>
                                            </td>
                                            <td class="px-6 py-4 font-semibold text-emerald-700">
                                                <?= htmlspecialchars($getVal($pw, 'no_hp_readable')) ?>
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <div class="flex items-center justify-center gap-2">
                                                    <button onclick="showDetailModal(<?= htmlspecialchars(json_encode($pw)) ?>)" class="text-purple-600 hover:text-purple-800 font-bold text-xs px-3 py-1.5 rounded-lg bg-purple-50 hover:bg-purple-100 transition">
                                                        Detail
                                                    </button>
                                                    <button onclick="openRowSettingsModal(<?= htmlspecialchars(json_encode($pw)) ?>)" class="text-amber-700 hover:text-amber-900 font-bold text-xs px-3 py-1.5 rounded-lg bg-amber-100 hover:bg-amber-200 transition">
                                                        Setujui / Verifikasi
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </main>
    </div>

    <!-- MODAL POPUP DETAIL WARGA -->
    <div id="detailModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl overflow-hidden flex flex-col">
            <div class="px-6 py-4 bg-purple-700 text-white flex justify-between items-center">
                <h3 class="text-lg font-bold">Rincian Data Kependudukan</h3>
                <button onclick="closeDetailModal()" class="text-white/80 hover:text-white text-2xl font-bold">&times;</button>
            </div>

            <div class="p-6 space-y-4 text-sm text-gray-700">
                <div class="grid grid-cols-2 gap-4 bg-gray-50 p-4 rounded-xl border border-gray-100">
                    <div>
                        <span class="text-xs text-gray-400 font-bold uppercase block">Nama Lengkap</span>
                        <p id="m-nama" class="font-bold text-gray-900 text-base"></p>
                    </div>
                    <div>
                        <span class="text-xs text-gray-400 font-bold uppercase block">Status Warga</span>
                        <p id="m-status" class="font-bold text-purple-700"></p>
                    </div>
                </div>

                <div class="space-y-2">
                    <div class="flex justify-between border-b border-gray-100 pb-2">
                        <span class="text-gray-500 font-medium">No. Kartu Keluarga (KK):</span>
                        <span id="m-kk" class="font-bold text-gray-900"></span>
                    </div>
                    <div class="flex justify-between border-b border-gray-100 pb-2">
                        <span class="text-gray-500 font-medium">NIK (Hasil Dekripsi):</span>
                        <span id="m-nik" class="font-bold text-gray-900"></span>
                    </div>
                    <div class="flex justify-between border-b border-gray-100 pb-2">
                        <span class="text-gray-500 font-medium">Alamat Domisili:</span>
                        <span id="m-alamat" class="font-bold text-gray-900"></span>
                    </div>
                    <div class="flex justify-between border-b border-gray-100 pb-2">
                        <span class="text-gray-500 font-medium">Wilayah RT:</span>
                        <span id="m-rt" class="font-bold text-purple-700"></span>
                    </div>
                    <div class="flex justify-between border-b border-gray-100 pb-2">
                        <span class="text-gray-500 font-medium">Jumlah Anggota Keluarga:</span>
                        <span id="m-anggota" class="font-bold text-gray-900"></span>
                    </div>
                    <div class="flex justify-between border-b border-gray-100 pb-2">
                        <span class="text-gray-500 font-medium">Nomor Handphone / WA:</span>
                        <span id="m-hp" class="font-bold text-emerald-700"></span>
                    </div>
                </div>
            </div>

            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-end">
                <button onclick="closeDetailModal()" class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold text-xs rounded-xl transition">
                    Tutup Detail
                </button>
            </div>
        </div>
    </div>

    <!-- MODAL PENGATURAN INDIVIDUAL WARGA -->
    <div id="rowSettingsModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl overflow-hidden flex flex-col">
            <div class="px-6 py-4 bg-purple-700 text-white flex justify-between items-center">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-widest bg-white/20 px-2 py-0.5 rounded">Pengaturan Warga</span>
                    <h3 id="rs-nama-header" class="text-lg font-bold mt-1">Pengaturan Data Penduduk</h3>
                </div>
                <button onclick="closeRowSettingsModal()" class="text-white/80 hover:text-white text-2xl font-bold">&times;</button>
            </div>

            <form onsubmit="saveRowSettings(event)" class="p-6 space-y-4 text-sm text-gray-700">
                <input type="hidden" id="rs-warga-id" value="" />

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Status Verifikasi Penduduk</label>
                    <select id="rs-status-verifikasi" class="w-full px-3 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-600 focus:outline-none text-xs font-bold">
                        <option value="verified">Verified (Terverifikasi Aktif)</option>
                        <option value="pending">Pending (Menunggu Persetujuan)</option>
                        <option value="rejected">Rejected (Ditolak / Non-aktif)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Status Tempat Tinggal</label>
                    <select id="rs-status-warga" class="w-full px-3 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-600 focus:outline-none text-xs font-bold">
                        <option value="tetap">Tetap (Pemilik / Warga Tetap)</option>
                        <option value="kontrak">Kontrak / Sewa</option>
                        <option value="kos">Kos / Sementar</option>
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Penetapan RT</label>
                        <select id="rs-rt" class="w-full px-3 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-600 focus:outline-none text-xs font-bold">
                            <?php for ($i = 1; $i <= 10; $i++): ?>
                                <option value="<?= $i ?>">RT <?= sprintf('%02d', $i) ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Peran / Hak Akses</label>
                        <select id="rs-role" class="w-full px-3 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-600 focus:outline-none text-xs font-bold">
                            <option value="warga">Warga Biasa</option>
                            <option value="rt">Pengurus RT</option>
                            <option value="rw">Pengurus RW / Admin</option>
                        </select>
                    </div>
                </div>

                <div class="p-3 bg-purple-50 rounded-xl border border-purple-100 text-xs text-purple-800">
                    <strong>Catatan Pengurus:</strong> Perubahan status dan hak akses akan langsung memperbarui hak pakai portal Ruang Warga 021.
                </div>

                <div class="pt-2 flex justify-end gap-3 border-t border-gray-100">
                    <button type="button" onclick="closeRowSettingsModal()" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold text-xs rounded-xl transition">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 bg-purple-600 hover:bg-purple-700 text-white font-bold text-xs rounded-xl transition shadow-md">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL PENGATURAN GLOBAL PENDUDUK -->
    <div id="globalSettingsModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl overflow-hidden flex flex-col">
            <div class="px-6 py-4 bg-gray-900 text-white flex justify-between items-center">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-widest bg-white/20 px-2 py-0.5 rounded">Sistem Data Penduduk</span>
                    <h3 class="text-lg font-bold mt-1">Pengaturan Penduduk RW 021</h3>
                </div>
                <button onclick="closeGlobalSettingsModal()" class="text-white/80 hover:text-white text-2xl font-bold">&times;</button>
            </div>

            <div class="p-6 space-y-5 text-sm text-gray-700">
                <div class="space-y-3">
                    <h4 class="text-xs font-bold text-purple-700 uppercase tracking-wider">Parameter Pengelolaan Data</h4>

                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl border border-gray-200">
                        <div>
                            <span class="font-bold text-xs text-gray-900 block">Otomatiskan Persetujuan Verifikasi</span>
                            <span class="text-[11px] text-gray-500">Verifikasi warga otomatis jika diinput oleh Pengurus RT</span>
                        </div>
                        <input type="checkbox" checked class="w-4 h-4 text-purple-600 rounded focus:ring-purple-500" />
                    </div>

                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl border border-gray-200">
                        <div>
                            <span class="font-bold text-xs text-gray-900 block">Enkripsi NIK & Kontak Warga</span>
                            <span class="text-[11px] text-gray-500">Lindungi privasi NIK dari tampilan umum</span>
                        </div>
                        <input type="checkbox" checked disabled class="w-4 h-4 text-purple-600 rounded focus:ring-purple-500 opacity-60" />
                    </div>
                </div>

                <div class="border-t border-gray-100 pt-4 space-y-3">
                    <h4 class="text-xs font-bold text-purple-700 uppercase tracking-wider">Ekspor & Rekapitulasi Data</h4>
                    <div class="grid grid-cols-2 gap-3">
                        <button onclick="exportDataWarga('csv')" class="py-2.5 px-3 bg-emerald-50 hover:bg-emerald-100 text-emerald-800 font-bold text-xs rounded-xl border border-emerald-200 transition flex items-center justify-center gap-1.5">
                            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Ekspor CSV
                        </button>
                        <button onclick="exportDataWarga('json')" class="py-2.5 px-3 bg-purple-50 hover:bg-purple-100 text-purple-800 font-bold text-xs rounded-xl border border-purple-200 transition flex items-center justify-center gap-1.5">
                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                            Ekspor JSON
                        </button>
                    </div>
                </div>
            </div>

            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-end">
                <button onclick="closeGlobalSettingsModal()" class="px-5 py-2 bg-gray-900 hover:bg-black text-white font-bold text-xs rounded-xl transition">
                    Tutup Pengaturan
                </button>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT TAB & MODAL CONTROL -->
    <script>
        function switchTab(type) {
            const vBtn = document.getElementById('tab-verified-btn');
            const pBtn = document.getElementById('tab-pending-btn');
            const vContent = document.getElementById('tab-verified-content');
            const pContent = document.getElementById('tab-pending-content');

            if (type === 'verified') {
                vBtn.className = "px-5 py-3 text-sm font-bold border-b-2 border-purple-600 text-purple-600 flex items-center gap-2 transition";
                pBtn.className = "px-5 py-3 text-sm font-bold border-b-2 border-transparent text-gray-500 hover:text-purple-600 flex items-center gap-2 transition";
                vContent.classList.remove('hidden');
                pContent.classList.add('hidden');
            } else {
                pBtn.className = "px-5 py-3 text-sm font-bold border-b-2 border-purple-600 text-purple-600 flex items-center gap-2 transition";
                vBtn.className = "px-5 py-3 text-sm font-bold border-b-2 border-transparent text-gray-500 hover:text-purple-600 flex items-center gap-2 transition";
                pContent.classList.remove('hidden');
                vContent.classList.add('hidden');
            }
        }

        function showDetailModal(data) {
            document.getElementById('m-nama').innerText = data.nama || '-';
            document.getElementById('m-status').innerText = (data.status_warga || 'tetap').toUpperCase();
            document.getElementById('m-kk').innerText = data.no_kk || '-';
            document.getElementById('m-nik').innerText = data.nik_readable || '***ENCRYPTED***';
            document.getElementById('m-alamat').innerText = `Blok ${data.blok || '-'} No. ${data.nomor || '-'}`;
            document.getElementById('m-rt').innerText = `RT ${String(data.rt || 1).padStart(2, '0')}`;
            document.getElementById('m-anggota').innerText = `${data.jml_anggota_keluarga || 1} Orang`;
            document.getElementById('m-hp').innerText = data.no_hp_readable || '-';

            document.getElementById('detailModal').classList.remove('hidden');
        }

        function closeDetailModal() {
            document.getElementById('detailModal').classList.add('hidden');
        }

        function openGlobalSettingsModal() {
            document.getElementById('globalSettingsModal').classList.remove('hidden');
        }

        function closeGlobalSettingsModal() {
            document.getElementById('globalSettingsModal').classList.add('hidden');
        }

        function openRowSettingsModal(data) {
            document.getElementById('rs-warga-id').value = data.id || '';
            document.getElementById('rs-nama-header').innerText = `Pengaturan Data: ${data.nama || 'Warga'}`;
            document.getElementById('rs-status-verifikasi').value = data.status_verifikasi || 'verified';
            document.getElementById('rs-status-warga').value = data.status_warga || 'tetap';
            document.getElementById('rs-rt').value = data.rt || 1;
            document.getElementById('rs-role').value = data.role || 'warga';

            document.getElementById('rowSettingsModal').classList.remove('hidden');
        }

        function closeRowSettingsModal() {
            document.getElementById('rowSettingsModal').classList.add('hidden');
        }

        function saveRowSettings(e) {
            e.preventDefault();
            alert('Pengaturan Warga berhasil disimpan dan diperbarui.');
            closeRowSettingsModal();
        }

        function exportDataWarga(format) {
            alert(`Mengespor rekapitulasi data penduduk format .${format.toUpperCase()}...`);
        }

        document.getElementById('detailModal').addEventListener('click', function(e) {
            if (e.target === this) closeDetailModal();
        });
        document.getElementById('rowSettingsModal').addEventListener('click', function(e) {
            if (e.target === this) closeRowSettingsModal();
        });
        document.getElementById('globalSettingsModal').addEventListener('click', function(e) {
            if (e.target === this) closeGlobalSettingsModal();
        });
    </script>
</body>

</html>