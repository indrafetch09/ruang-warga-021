<!doctype html>
<html lang="id">

<head>
    <title>Kelola Pengumuman - Dasbor Pengurus RW 021</title>
    <?php require base_path('views/partials/head.php'); ?>
</head>

<body class="text-gray-800 bg-gray-50 flex flex-col min-h-screen">
    <?php require base_path('views/partials/admin-header.php'); ?>

    <!-- WRAPPER SIDEBAR & MAIN CONTENT -->
    <div class="flex flex-1 max-w-[1400px] w-full mx-auto relative">
        <?php require base_path('views/partials/admin-sidebar.php'); ?>

        <main class="flex-1 w-full min-w-0 p-4 sm:p-6 lg:p-8 space-y-6">

            <!-- HEADER SECTION & TOMBOL BUAT -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-gray-200 pb-6">
                <div>
                    <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900">Kelola <span class="text-purple-600">Pengumuman Warga</span></h1>
                    <p class="text-xs md:text-sm text-gray-500 mt-1">Daftar berita, kabar penting, dan siaran pengumuman untuk warga RW 021.</p>
                </div>
                <a href="/admin/pengumuman/create" class="px-5 py-2.5 bg-purple-600 hover:bg-purple-700 text-white font-bold text-xs rounded-xl shadow-md transition inline-flex items-center gap-2 whitespace-nowrap">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Buat Pengumuman Baru
                </a>
            </div>

            <!-- ALERT FLASH SESSION -->
            <?php $sukses = \Core\Session::get('sukses'); ?>
            <?php $error = \Core\Session::get('error'); ?>

            <?php if (!empty($sukses)): ?>
                <div class="p-4 bg-emerald-50 border border-emerald-200 rounded-2xl flex items-center gap-2 text-emerald-800 text-sm font-semibold shadow-sm">
                    <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span><?= htmlspecialchars($sukses) ?></span>
                </div>
            <?php endif; ?>

            <?php if (!empty($error)): ?>
                <div class="p-4 bg-rose-50 border border-rose-200 rounded-2xl flex items-center gap-2 text-rose-800 text-sm font-semibold shadow-sm">
                    <svg class="w-5 h-5 text-rose-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span><?= htmlspecialchars($error) ?></span>
                </div>
            <?php endif; ?>

            <!-- FILTER & SEARCH BAR REALTIME -->
            <div class="bg-white p-4 rounded-2xl border border-gray-200 shadow-sm flex flex-col md:flex-row gap-4 items-center justify-between">
                <div class="w-full flex flex-col md:flex-row gap-3 items-center">
                    <!-- Search Input -->
                    <div class="w-full md:w-1/2 relative">
                        <svg class="w-4 h-4 text-gray-400 absolute left-3.5 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" id="searchPengumuman" onkeyup="filterPengumumanRealtime()" placeholder="Ketik judul atau isi pengumuman..." class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs font-semibold focus:outline-none focus:ring-2 focus:ring-purple-500 transition" />
                    </div>

                    <!-- Filter Dropdowns -->
                    <div class="w-full md:w-auto flex flex-wrap md:flex-nowrap gap-3">
                        <select id="filterKategoriPengumuman" onchange="filterPengumumanRealtime()" class="px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs font-semibold text-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-500 cursor-pointer">
                            <option value="">Semua Kategori</option>
                            <option value="urgent">Urgent / Penting</option>
                            <option value="kegiatan">Kegiatan</option>
                            <option value="info">Informasi</option>
                            <option value="umum">Umum</option>
                        </select>

                        <select id="filterStatusPengumuman" onchange="filterPengumumanRealtime()" class="px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs font-semibold text-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-500 cursor-pointer">
                            <option value="">Semua Status</option>
                            <option value="published">Published (Tayang)</option>
                            <option value="draft">Draft (Sembunyi)</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- TABEL LIST PENGUMUMAN -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <?php if (empty($pengumumanList)): ?>
                    <!-- EMPTY STATE -->
                    <div class="text-center py-12 px-4">
                        <div class="w-16 h-16 bg-purple-50 text-purple-600 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                            </svg>
                        </div>
                        <h3 class="text-base font-bold text-gray-900">Belum Ada Pengumuman</h3>
                        <p class="text-xs text-gray-500 mt-1 max-w-sm mx-auto">Pengumuman warga belum ditemukan atau belum ada yang dipublikasikan.</p>
                        <a href="/admin/pengumuman/create" class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-purple-600 text-white font-bold text-xs rounded-xl hover:bg-purple-700 transition">
                            + Buat Pengumuman Pertama
                        </a>
                    </div>
                <?php else: ?>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead>
                                <tr class="bg-purple-50/80 text-purple-900 font-bold uppercase tracking-wider border-b border-purple-100">
                                    <th class="p-4">Tanggal & Status</th>
                                    <th class="p-4">Judul & Isi Pesan</th>
                                    <th class="p-4">Kategori</th>
                                    <th class="p-4">Tautan</th>
                                    <th class="p-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <?php foreach ($pengumumanList as $item): ?>
                                    <?php
                                    $pId        = $item['id'] ?? '';
                                    $pJudul     = $item['judul'] ?? 'Tanpa Judul';
                                    $pTanggal   = $item['tanggal_publikasi'] ?? '';
                                    $pKategori  = strtolower($item['kategori'] ?? 'umum');
                                    $pPesan     = $item['pesan'] ?? '';
                                    $pLabelBtn  = $item['label_tombol'] ?? '';
                                    $pUrl       = $item['tautan_url'] ?? '';
                                    $pIsPublish = !empty($item['is_published']);
                                    $pStatusStr = $pIsPublish ? 'published' : 'draft';
                                    ?>
                                    <tr class="pengumuman-row hover:bg-purple-50/30 transition" data-kategori="<?= $pKategori ?>" data-status="<?= $pStatusStr ?>">
                                        <!-- Tanggal & Status Published -->
                                        <td class="p-4">
                                            <span class="block font-bold text-gray-900"><?= !empty($pTanggal) ? date('d M Y', strtotime($pTanggal)) : '-' ?></span>
                                            <span class="mt-1 inline-block">
                                                <?php if ($pIsPublish): ?>
                                                    <span class="bg-emerald-100 text-emerald-800 text-[10px] font-extrabold px-2 py-0.5 rounded-full flex items-center gap-1 w-max">
                                                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span> Tayang
                                                    </span>
                                                <?php else: ?>
                                                    <span class="bg-amber-100 text-amber-800 text-[10px] font-extrabold px-2 py-0.5 rounded-full flex items-center gap-1 w-max">
                                                        <span class="w-1.5 h-1.5 bg-amber-500 rounded-full"></span> Draft
                                                    </span>
                                                <?php endif; ?>
                                            </span>
                                        </td>

                                        <!-- Judul & Pesan -->
                                        <td class="p-4 max-w-sm">
                                            <h4 class="font-bold text-gray-900 text-sm"><?= htmlspecialchars($pJudul) ?></h4>
                                            <p class="text-[11px] text-gray-500 line-clamp-2 mt-0.5"><?= htmlspecialchars($pPesan) ?></p>
                                        </td>

                                        <!-- Kategori Badge -->
                                        <td class="p-4">
                                            <?php if ($pKategori === 'urgent'): ?>
                                                <span class="bg-rose-50 text-rose-700 border border-rose-200 text-[10px] font-extrabold px-2.5 py-1 rounded-md uppercase">Penting</span>
                                            <?php elseif ($pKategori === 'kegiatan'): ?>
                                                <span class="bg-emerald-50 text-emerald-700 border border-emerald-200 text-[10px] font-extrabold px-2.5 py-1 rounded-md uppercase">Kegiatan</span>
                                            <?php elseif ($pKategori === 'info'): ?>
                                                <span class="bg-purple-50 text-purple-700 border border-purple-200 text-[10px] font-extrabold px-2.5 py-1 rounded-md uppercase">Informasi</span>
                                            <?php else: ?>
                                                <span class="bg-gray-100 text-gray-700 border border-gray-200 text-[10px] font-extrabold px-2.5 py-1 rounded-md uppercase">Umum</span>
                                            <?php endif; ?>
                                        </td>

                                        <!-- Tautan Tambahan -->
                                        <td class="p-4">
                                            <?php if (!empty($pUrl)): ?>
                                                <a href="<?= htmlspecialchars($pUrl) ?>" target="_blank" class="inline-flex items-center gap-1 text-purple-600 font-bold hover:underline text-[11px]">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                                    </svg>
                                                    <?= htmlspecialchars(!empty($pLabelBtn) ? $pLabelBtn : 'Buka Link') ?>
                                                </a>
                                            <?php else: ?>
                                                <span class="text-gray-400 italic text-[11px]">Tanpa Tautan</span>
                                            <?php endif; ?>
                                        </td>

                                        <!-- Aksi -->
                                        <td class="p-4 text-center">
                                            <div class="flex items-center justify-center gap-1.5">
                                                <a href="/admin/pengumuman/edit?id=<?= $pId ?>" class="p-1.5 bg-amber-50 text-amber-700 border border-amber-200 hover:bg-amber-100 rounded-lg transition" title="Edit Pengumuman">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>

                                                <form action="/admin/pengumuman/delete" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengumuman ini?')">
                                                    <?= \Core\Csrf::field() ?>
                                                    <input type="hidden" name="id" value="<?= $pId ?>">
                                                    <button type="submit" class="p-1.5 bg-rose-50 text-rose-700 border border-rose-200 hover:bg-rose-100 rounded-lg transition" title="Hapus Pengumuman">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr id="emptyPengumumanSearchState" class="hidden">
                                    <td colspan="5" class="p-8 text-center text-gray-400 font-medium">
                                        Pengumuman tidak ditemukan sesuai kata kunci/filter.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>

        </main>
    </div>

    <script src="/script.js"></script>
</body>

</html>