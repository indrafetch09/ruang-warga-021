<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kelola Notulensi Rapat - Dasbor Pengurus RW 021</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: "Plus Jakarta Sans", sans-serif;
        }
    </style>
</head>

<body class="text-gray-800 bg-gray-50 flex flex-col min-h-screen">
    <?php require base_path('views/partials/admin-header.php'); ?>

    <!-- WRAPPER SIDEBAR & MAIN CONTENT -->
    <div class="flex flex-1 max-w-[1400px] w-full mx-auto relative">
        <?php require base_path('views/partials/admin-sidebar.php'); ?>

        <main class="flex-1 w-full min-w-0 p-4 sm:p-6 lg:p-8 space-y-6">

            <!-- HEADER SECTION & TOMBOL TAMBAH -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-gray-200 pb-6">
                <div>
                    <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900">Kelola <span class="text-purple-600">Notulensi Rapat</span></h1>
                    <p class="text-xs md:text-sm text-gray-500 mt-1">Daftar arsip, hasil keputusan, dan dokumen rapat warga RW 021.</p>
                </div>
                <a href="/admin/notulensi/create" class="px-5 py-2.5 bg-purple-600 hover:bg-purple-700 text-white font-bold text-xs rounded-xl shadow-md transition inline-flex items-center gap-2 whitespace-nowrap">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    + Tambah Notulensi Baru
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
                        <input type="text" id="searchNotulensi" onkeyup="filterNotulensiRealtime()" placeholder="Cari judul, agenda, notulis, atau no. surat..." class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs font-semibold focus:outline-none focus:ring-2 focus:ring-purple-500 transition" />
                    </div>

                    <!-- Kategori Dropdown -->
                    <div class="w-full md:w-auto flex gap-3">
                        <select id="filterKategoriNotulensi" onchange="filterNotulensiRealtime()" class="w-full md:w-auto px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs font-semibold text-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-500 cursor-pointer">
                            <option value="">Semua Kategori</option>
                            <option value="rutin">Rapat Rutin</option>
                            <option value="khusus">Rapat Khusus</option>
                            <option value="laporan">Laporan Kas</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- TABEL LIST NOTULENSI -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <?php if (empty($notulensiList)): ?>
                    <!-- EMPTY STATE -->
                    <div class="text-center py-12 px-4">
                        <div class="w-16 h-16 bg-purple-50 text-purple-600 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="text-base font-bold text-gray-900">Belum Ada Notulensi Rapat</h3>
                        <p class="text-xs text-gray-500 mt-1 max-w-sm mx-auto">Data notulensi rapat belum ditemukan atau belum diinput oleh pengurus.</p>
                        <a href="/admin/notulensi/create" class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-purple-600 text-white font-bold text-xs rounded-xl hover:bg-purple-700 transition">
                            + Tambah Notulensi Pertama
                        </a>
                    </div>
                <?php else: ?>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead>
                                <tr class="bg-purple-50/80 text-purple-900 font-bold uppercase tracking-wider border-b border-purple-100">
                                    <th class="p-4">Tanggal & No. Surat</th>
                                    <th class="p-4">Judul & Agenda</th>
                                    <th class="p-4">Kategori</th>
                                    <th class="p-4">Notulis / Lokasi</th>
                                    <th class="p-4">Dokumen</th>
                                    <th class="p-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <?php foreach ($notulensiList as $item): ?>
                                    <?php
                                    $nId       = $item->id ?? $item['id'] ?? '';
                                    $nJudul    = $item->judul ?? $item['judul'] ?? 'Tanpa Judul';
                                    $nNoSurat  = $item->no_surat ?? $item['no_surat'] ?? '-';
                                    $nTanggal  = $item->tanggal ?? $item['tanggal'] ?? '';
                                    $nKategori = strtolower($item->kategori ?? $item['kategori'] ?? 'rutin');
                                    $nLokasi   = $item->lokasi ?? $item['lokasi'] ?? '-';
                                    $nNotulis  = $item->notulis ?? $item['notulis'] ?? '-';
                                    $nAgenda   = $item->agenda ?? $item['agenda'] ?? '';
                                    $nFile     = $item->file_lampiran ?? $item['file_lampiran'] ?? '';
                                    ?>
                                    <tr class="notulensi-row hover:bg-purple-50/30 transition" data-kategori="<?= htmlspecialchars($nKategori) ?>">
                                        <!-- Tanggal & No Surat -->
                                        <td class="p-4">
                                            <span class="block font-bold text-gray-900"><?= !empty($nTanggal) ? date('d M Y', strtotime($nTanggal)) : '-' ?></span>
                                            <span class="text-[11px] font-medium text-gray-400">No: <?= htmlspecialchars($nNoSurat) ?></span>
                                        </td>

                                        <!-- Judul & Agenda -->
                                        <td class="p-4 max-w-xs">
                                            <a href="/notulensi/detail?id=<?= $nId ?>" target="_blank" class="font-bold text-gray-900 hover:text-purple-600 transition line-clamp-1">
                                                <?= htmlspecialchars($nJudul) ?>
                                            </a>
                                            <p class="text-[11px] text-gray-500 line-clamp-1 mt-0.5"><?= htmlspecialchars($nAgenda) ?></p>
                                        </td>

                                        <!-- Kategori -->
                                        <td class="p-4">
                                            <?php if ($nKategori === 'rutin'): ?>
                                                <span class="bg-emerald-50 text-emerald-700 border border-emerald-200 text-[10px] font-extrabold px-2.5 py-1 rounded-md uppercase">Rapat Rutin</span>
                                            <?php elseif ($nKategori === 'khusus'): ?>
                                                <span class="bg-purple-50 text-purple-700 border border-purple-200 text-[10px] font-extrabold px-2.5 py-1 rounded-md uppercase">Rapat Khusus</span>
                                            <?php else: ?>
                                                <span class="bg-sky-50 text-sky-700 border border-sky-200 text-[10px] font-extrabold px-2.5 py-1 rounded-md uppercase">Laporan Kas</span>
                                            <?php endif; ?>
                                        </td>

                                        <!-- Notulis & Lokasi -->
                                        <td class="p-4">
                                            <span class="block font-semibold text-gray-800"><?= htmlspecialchars($nNotulis) ?></span>
                                            <span class="text-[11px] text-gray-400"><?= htmlspecialchars($nLokasi) ?></span>
                                        </td>

                                        <!-- Dokumen Lampiran -->
                                        <td class="p-4">
                                            <?php if (!empty($nFile)): ?>
                                                <a href="/uploads/notulensi/<?= htmlspecialchars($nFile) ?>" download class="inline-flex items-center gap-1 text-purple-600 font-bold hover:underline">
                                                    <svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                    </svg>
                                                    Unduh
                                                </a>
                                            <?php else: ?>
                                                <span class="text-gray-400 italic text-[11px]">Tidak Ada</span>
                                            <?php endif; ?>
                                        </td>

                                        <!-- Aksi -->
                                        <td class="p-4 text-center">
                                            <div class="flex items-center justify-center gap-1.5">
                                                <!-- Detail -->
                                                <a href="/notulensi/detail?id=<?= $nId ?>" target="_blank" class="p-1.5 bg-gray-100 text-gray-600 hover:bg-purple-100 hover:text-purple-700 rounded-lg transition" title="Lihat Detail">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </a>

                                                <!-- Edit -->
                                                <a href="/admin/notulensi/edit?id=<?= $nId ?>" class="p-1.5 bg-amber-50 text-amber-700 border border-amber-200 hover:bg-amber-100 rounded-lg transition" title="Edit Notulensi">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>

                                                <!-- Delete -->
                                                <form action="/admin/notulensi/delete" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus notulensi rapat ini?')">
                                                    <?= \Core\Csrf::field() ?>
                                                    <input type="hidden" name="id" value="<?= $nId ?>">
                                                    <button type="submit" class="p-1.5 bg-rose-50 text-rose-700 border border-rose-200 hover:bg-rose-100 rounded-lg transition" title="Hapus Notulensi">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr id="emptyNotulensiSearchState" class="hidden">
                                    <td colspan="6" class="p-8 text-center text-gray-400 font-medium">
                                        Notulensi rapat tidak ditemukan sesuai kata kunci/filter.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>

        </main>
    </div>

    <script>
        function filterNotulensiRealtime() {
            const query = document.getElementById('searchNotulensi').value.toLowerCase().trim();
            const kategori = document.getElementById('filterKategoriNotulensi').value.toLowerCase();

            const rows = document.querySelectorAll('.notulensi-row');
            let visibleCount = 0;

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                const rowKat = row.getAttribute('data-kategori') || '';

                const matchesQuery = query === '' || text.includes(query);
                const matchesKat = kategori === '' || rowKat === kategori;

                if (matchesQuery && matchesKat) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            const emptyState = document.getElementById('emptyNotulensiSearchState');
            if (emptyState) {
                if (visibleCount === 0 && rows.length > 0) {
                    emptyState.classList.remove('hidden');
                } else {
                    emptyState.classList.add('hidden');
                }
            }
        }
    </script>
</body>

</html>
