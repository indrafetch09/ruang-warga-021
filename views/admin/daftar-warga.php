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
            // Role & Wilayah Pengurus
            $isRw = $user->isRw();
            $isRt = $user->isRt();
            $assignedRt = (int)($user->getRtAssigned() ?? 1);

            // Helper Ambil Properti Object / Array secara aman
            $getVal = function ($item, $key, $default = '-') {
                if (is_object($item)) return $item->$key ?? $default;
                if (is_array($item)) return $item[$key] ?? $default;
                return $default;
            };

            // Mapping Label & Badge Status Keluarga
            $formatStatusKeluarga = function ($status) {
                return match (strtolower((string)$status)) {
                    'kepala_keluarga' => ['label' => 'Kepala Keluarga', 'class' => 'bg-purple-100 text-purple-800 border-purple-200'],
                    'istri'           => ['label' => 'Istri', 'class' => 'bg-rose-100 text-rose-800 border-rose-200'],
                    'anak'            => ['label' => 'Anak', 'class' => 'bg-sky-100 text-sky-800 border-sky-200'],
                    'orang_tua'       => ['label' => 'Orang Tua / Mertua', 'class' => 'bg-amber-100 text-amber-800 border-amber-200'],
                    default           => ['label' => 'Famili Lain', 'class' => 'bg-gray-100 text-gray-700 border-gray-200'],
                };
            };

            // Helper Format Alamat Pintar (Tidak memaksakan kata 'Blok')
            $formatAlamat = function ($blok, $nomor) {
                $b = trim((string)$blok);
                $n = trim((string)$nomor);

                if (empty($b) || $b === '-') {
                    return (!empty($n) && $n !== '-') ? 'No. ' . $n : '-';
                }

                // Jika berupa nama jalan, gang, komplek, atau kavling
                if (preg_match('/^(?:JL|JALAN|GG|GANG|KOMP|KOMPLEK|KAV|KAVLING|PERUM)\b/i', $b)) {
                    return (!empty($n) && $n !== '-') ? "{$b} No. {$n}" : $b;
                }

                // Jika sudah ada kata "Blok" di dalamnya
                if (stripos($b, 'blok') === 0) {
                    return (!empty($n) && $n !== '-') ? "{$b} No. {$n}" : $b;
                }

                // Format perumahan (TA 14 -> Blok TA 14 No. 11)
                return (!empty($n) && $n !== '-') ? "Blok {$b} No. {$n}" : "Blok {$b}";
            };

            // Helper Convert Item ke Array Murni untuk JSON Modal
            $toArray = function ($item) use ($getVal) {
                return [
                    'id'                  => $getVal($item, 'id', ''),
                    'nama'                => $getVal($item, 'nama', ''),
                    'nik_readable'        => $getVal($item, 'nik_readable', '***ENCRYPTED***'),
                    'nik_kk_readable'     => $getVal($item, 'nik_kk_readable', '-'),
                    'tempat_lahir'        => $getVal($item, 'tempat_lahir', '-'),
                    'tanggal_lahir'       => $getVal($item, 'tanggal_lahir', '-'),
                    'jenis_kelamin'       => $getVal($item, 'jenis_kelamin', '-'),
                    'rt'                  => $getVal($item, 'rt', 1),
                    'blok'                => $getVal($item, 'blok', '-'),
                    'nomor'               => $getVal($item, 'nomor', '-'),
                    'agama'               => $getVal($item, 'agama', '-'),
                    'pekerjaan'           => $getVal($item, 'pekerjaan', '-'),
                    'status_keluarga'     => $getVal($item, 'status_keluarga', 'famili_lain'),
                    'status_verifikasi'   => $getVal($item, 'status_verifikasi', 'verified'),
                    'status_warga'        => $getVal($item, 'status_warga', 'tetap'),
                ];
            };

            $listWarga = $wargaList ?? [];
            $listPending = $pendingList ?? [];
            ?>

            <!-- PAGE HEADER & ACTION BUTTONS -->
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

                <div class="flex flex-wrap items-center gap-2">
                    <button type="button" onclick="openImportModal()" class="px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl text-xs transition shadow-md flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                        </svg>
                        Import Excel (CSV)
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
                    <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span><?= htmlspecialchars($sukses) ?></span>
                </div>
            <?php endif; ?>

            <?php if ($error = \Core\Session::get('error')): ?>
                <div class="p-4 bg-rose-50 border border-rose-200 text-rose-800 text-sm font-bold rounded-xl flex items-center gap-2 shadow-sm">
                    <svg class="w-5 h-5 text-rose-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span><?= htmlspecialchars($error) ?></span>
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
                    NIK Warga dan NIK Kepala Keluarga dienkripsi secara ketat di basis data. Sebagai pengurus terautentikasi, Anda dapat meninjau rincian lengkap melalui tombol <span class="font-bold underline">Detail</span> di setiap baris.
                </div>
            </div>

            <!-- TABS SWITCHER -->
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

            <!-- TOOLBAR FILTER REALTIME -->
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
                <div class="w-full md:w-1/2 relative">
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input type="text" id="searchInput" onkeyup="filterWargaRealtime()" placeholder="Ketik nama, NIK, blok, atau nomor rumah..." class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm font-medium" />
                </div>

                <div class="w-full md:w-auto flex flex-col sm:flex-row gap-3">
                    <select id="rtFilterSelect" onchange="filterWargaRealtime()" <?= $isRt ? 'disabled' : '' ?> class="w-full sm:w-auto px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm font-semibold text-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-500 cursor-pointer">
                        <?php if ($isRw): ?>
                            <option value="">Semua Wilayah RT</option>
                            <?php for ($i = 1; $i <= 10; $i++): ?>
                                <option value="<?= $i ?>">RT <?= sprintf('%02d', $i) ?></option>
                            <?php endfor; ?>
                        <?php else: ?>
                            <option value="<?= $assignedRt ?>">RT <?= sprintf('%02d', $assignedRt) ?> (Wilayah Anda)</option>
                        <?php endif; ?>
                    </select>
                </div>
            </div>

            <!-- TAB 1: TABEL WARGA TERVERIFIKASI -->
            <div id="tab-verified-content" class="space-y-6">
                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
                    <?php if (empty($listWarga)): ?>
                        <div class="p-12 text-center">
                            <div class="w-16 h-16 bg-purple-50 text-purple-600 rounded-full flex items-center justify-center mx-auto mb-3">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-base font-bold text-gray-800">Tidak ada data warga terverifikasi</h3>
                        </div>
                    <?php else: ?>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse whitespace-nowrap">
                                <thead>
                                    <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase tracking-wider text-gray-500 font-bold">
                                        <th class="px-6 py-4">No</th>
                                        <th class="px-6 py-4">Nama Warga</th>
                                        <th class="px-6 py-4">Status Keluarga</th>
                                        <th class="px-6 py-4">Alamat Rumah</th>
                                        <th class="px-6 py-4 text-center">RT</th>
                                        <th class="px-6 py-4 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                                    <?php $no = 1;
                                    foreach ($listWarga as $w): ?>
                                        <?php
                                        $wArr = $toArray($w);
                                        $skInfo = $formatStatusKeluarga($wArr['status_keluarga']);
                                        ?>
                                        <tr class="warga-row hover:bg-purple-50/40 transition-colors" data-rt="<?= (int)$wArr['rt'] ?>">
                                            <td class="px-6 py-4 font-medium text-gray-400 row-number"><?= $no++ ?></td>
                                            <td class="px-6 py-4 font-bold text-gray-900">
                                                <?= htmlspecialchars($wArr['nama']) ?>
                                                <span class="block text-[11px] text-gray-400 font-normal">NIK: <?= htmlspecialchars($wArr['nik_readable']) ?></span>
                                            </td>
                                            <td class="px-6 py-4">
                                                <span class="px-2.5 py-1 font-bold text-xs rounded-full border <?= $skInfo['class'] ?>">
                                                    <?= htmlspecialchars($skInfo['label']) ?>
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 font-medium">
                                                <?= htmlspecialchars($formatAlamat($wArr['blok'], $wArr['nomor'])) ?>
                                            </td>
                                            <td class="px-6 py-4 text-center font-bold text-purple-700">
                                                RT <?= sprintf('%02d', $wArr['rt']) ?>
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <div class="flex items-center justify-center gap-2">
                                                    <button onclick='showDetailModal(<?= json_encode($wArr) ?>)' class="text-purple-600 hover:text-purple-800 font-bold text-xs px-3 py-1.5 rounded-lg bg-purple-50 hover:bg-purple-100 transition">
                                                        Detail
                                                    </button>
                                                    <a href="/admin/warga/edit?id=<?= $wArr['id'] ?>" class="text-amber-600 hover:text-amber-800 font-bold text-xs px-3 py-1.5 rounded-lg bg-amber-50 hover:bg-amber-100 transition">
                                                        Edit
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr id="emptyVerifiedState" class="hidden">
                                        <td colspan="6" class="p-8 text-center text-gray-400 font-medium">
                                            Tidak ada data warga yang cocok dengan pencarian.
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- TAB 2: TABEL MENUNGGU PERSETUJUAN -->
            <div id="tab-pending-content" class="space-y-6 hidden">
                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
                    <div class="p-4 bg-amber-50 border-b border-amber-100 flex items-center justify-between">
                        <span class="text-xs font-bold text-amber-900 uppercase tracking-wider">
                            Daftar Pengajuan Warga Baru (Perlu Verifikasi / ACC RW)
                        </span>
                        <?php if ($isRw): ?>
                            <span class="text-xs text-amber-700 font-semibold">Anda memiliki hak akses untuk ACC data</span>
                        <?php else: ?>
                            <span class="text-xs text-amber-700 font-semibold">Menunggu tinjauan & persetujuan Pengurus RW</span>
                        <?php endif; ?>
                    </div>

                    <?php if (empty($listPending)): ?>
                        <div class="p-12 text-center">
                            <div class="w-16 h-16 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-3">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <h3 class="text-base font-bold text-gray-800">Tidak ada pengajuan pending</h3>
                            <p class="text-xs text-gray-500 mt-1">Semua data warga yang diajukan telah diverifikasi.</p>
                        </div>
                    <?php else: ?>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse whitespace-nowrap">
                                <thead>
                                    <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase tracking-wider text-gray-500 font-bold">
                                        <th class="px-6 py-4">Nama Warga</th>
                                        <th class="px-6 py-4">Status Keluarga</th>
                                        <th class="px-6 py-4">Alamat Rumah</th>
                                        <th class="px-6 py-4 text-center">RT</th>
                                        <th class="px-6 py-4 text-center">Aksi (ACC / Tolak)</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                                    <?php foreach ($listPending as $pw): ?>
                                        <?php
                                        $pwArr = $toArray($pw);
                                        $skInfo = $formatStatusKeluarga($pwArr['status_keluarga']);
                                        ?>
                                        <tr class="warga-row hover:bg-amber-50/30 transition-colors" data-rt="<?= (int)$pwArr['rt'] ?>">
                                            <td class="px-6 py-4 font-bold text-gray-900">
                                                <?= htmlspecialchars($pwArr['nama']) ?>
                                                <span class="block text-[11px] text-gray-400 font-normal">NIK: <?= htmlspecialchars($pwArr['nik_readable']) ?></span>
                                            </td>
                                            <td class="px-6 py-4">
                                                <span class="px-2.5 py-1 font-bold text-xs rounded-full border <?= $skInfo['class'] ?>">
                                                    <?= htmlspecialchars($skInfo['label']) ?>
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 font-medium">
                                                <?= htmlspecialchars($formatAlamat($pwArr['blok'], $pwArr['nomor'])) ?>
                                            </td>
                                            <td class="px-6 py-4 text-center font-bold text-purple-700">
                                                RT <?= sprintf('%02d', $pwArr['rt']) ?>
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <div class="flex items-center justify-center gap-2">
                                                    <button onclick='showDetailModal(<?= json_encode($pwArr) ?>)' class="text-purple-600 hover:text-purple-800 font-bold text-xs px-3 py-1.5 rounded-lg bg-purple-50 hover:bg-purple-100 transition">
                                                        Detail
                                                    </button>

                                                    <?php if ($isRw): ?>
                                                        <form action="/admin/warga/approve" method="POST" class="inline">
                                                            <?= \Core\Csrf::field() ?>
                                                            <input type="hidden" name="warga_id" value="<?= $pwArr['id'] ?>">
                                                            <button type="submit" class="text-emerald-700 hover:text-emerald-900 font-bold text-xs px-3 py-1.5 rounded-lg bg-emerald-100 hover:bg-emerald-200 transition" onclick="return confirm('Setujui (ACC) pengajuan warga ini?')">
                                                                ACC
                                                            </button>
                                                        </form>

                                                        <form action="/admin/warga/reject" method="POST" class="inline">
                                                            <?= \Core\Csrf::field() ?>
                                                            <input type="hidden" name="warga_id" value="<?= $pwArr['id'] ?>">
                                                            <button type="submit" class="text-rose-700 hover:text-rose-900 font-bold text-xs px-3 py-1.5 rounded-lg bg-rose-100 hover:bg-rose-200 transition" onclick="return confirm('Tolak pengajuan warga ini?')">
                                                                Tolak
                                                            </button>
                                                        </form>
                                                    <?php else: ?>
                                                        <span class="px-3 py-1 bg-amber-100 text-amber-800 text-xs font-bold rounded-lg">
                                                            Menunggu ACC RW
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr id="emptyPendingState" class="hidden">
                                        <td colspan="5" class="p-8 text-center text-gray-400 font-medium">
                                            Tidak ada pengajuan warga yang cocok dengan pencarian.
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </main>
    </div>

    <!-- MODAL IMPORT DATA WARGA DARI EXCEL/CSV -->
    <div id="importModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl overflow-hidden flex flex-col">
            <div class="px-6 py-4 bg-emerald-700 text-white flex justify-between items-center">
                <h3 class="text-base font-bold flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                    </svg>
                    Import Data Warga dari File Excel
                </h3>
                <button type="button" onclick="closeImportModal()" class="text-white/80 hover:text-white text-2xl font-bold">&times;</button>
            </div>

            <form action="/admin/warga/import" method="POST" enctype="multipart/form-data" class="p-6 space-y-5 text-sm">
                <?= \Core\Csrf::field() ?>

                <div class="p-4 bg-emerald-50 border border-emerald-200 rounded-xl space-y-2">
                    <p class="text-xs font-bold text-emerald-950">Gunakan format template yang telah disediakan:</p>
                    <p class="text-[11px] text-emerald-800 leading-relaxed">
                        Unduh file template, isi data warga di Excel, lalu simpan (<em>Save As</em>) dengan format <strong>CSV (Comma Delimited)</strong>.
                    </p>
                    <a href="/admin/warga/template" class="inline-flex items-center gap-1.5 text-xs font-extrabold text-emerald-700 hover:text-emerald-900 underline mt-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        Unduh Template File Excel (.CSV)
                    </a>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Pilih File CSV / Excel Warga</label>
                    <input type="file" name="file_import" accept=".csv" required class="w-full px-3 py-2.5 bg-gray-50 border border-gray-300 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-emerald-500 cursor-pointer" />
                </div>

                <div class="pt-3 flex justify-end gap-2 border-t border-gray-100">
                    <button type="button" onclick="closeImportModal()" class="px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold text-xs rounded-xl transition">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl shadow-md transition flex items-center gap-1.5">
                        Proses Import Data
                    </button>
                </div>
            </form>
        </div>
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
                        <p id="m-nama" class="font-bold text-gray-900 text-base">-</p>
                    </div>
                    <div>
                        <span class="text-xs text-gray-400 font-bold uppercase block">Status Verifikasi</span>
                        <p id="m-status-verifikasi" class="font-bold text-purple-700">-</p>
                    </div>
                </div>

                <div class="space-y-2">
                    <div class="flex justify-between border-b border-gray-100 pb-2">
                        <span class="text-gray-500 font-medium">NIK Warga:</span>
                        <span id="m-nik" class="font-bold text-gray-900">-</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-100 pb-2">
                        <span class="text-gray-500 font-medium">NIK Kepala Keluarga:</span>
                        <span id="m-nik-kk" class="font-bold text-gray-900">-</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-100 pb-2">
                        <span class="text-gray-500 font-medium">Hubungan Keluarga:</span>
                        <span id="m-status-keluarga" class="font-bold text-purple-700">-</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-100 pb-2">
                        <span class="text-gray-500 font-medium">Tempat / Tanggal Lahir:</span>
                        <span id="m-ttl" class="font-bold text-gray-900">-</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-100 pb-2">
                        <span class="text-gray-500 font-medium">Jenis Kelamin:</span>
                        <span id="m-jk" class="font-bold text-gray-900">-</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-100 pb-2">
                        <span class="text-gray-500 font-medium">Alamat Domisili:</span>
                        <span id="m-alamat" class="font-bold text-gray-900">-</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-100 pb-2">
                        <span class="text-gray-500 font-medium">Wilayah RT:</span>
                        <span id="m-rt" class="font-bold text-purple-700">-</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-100 pb-2">
                        <span class="text-gray-500 font-medium">Agama / Pekerjaan:</span>
                        <span id="m-agama-pekerjaan" class="font-bold text-gray-900">-</span>
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

    <<<<<<< HEAD
        <!-- SCRIPT TERPUSAT -->
        <script src="/script.js"></script>
        =======
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
        >>>>>>> main
</body>

</html>