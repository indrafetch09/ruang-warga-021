<!doctype html>
<html lang="id">

<head>
    <title>Kelola Kegiatan Rutin - Dasbor Pengurus RW 021</title>
    <?php require base_path('views/partials/head.php'); ?>
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
                    <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900">Kelola <span class="text-purple-600">Kegiatan Rutin</span></h1>
                    <p class="text-xs md:text-sm text-gray-500 mt-1">Daftar jadwal kegiatan mingguan dan bulanan warga RW 021.</p>
                </div>
                <a href="/admin/kegiatan/create" class="px-5 py-2.5 bg-purple-600 hover:bg-purple-700 text-white font-bold text-xs rounded-xl shadow-md transition inline-flex items-center gap-2 whitespace-nowrap">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Kegiatan Baru
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
                        <input type="text" id="searchKegiatan" onkeyup="filterKegiatanRealtime()" placeholder="Ketik nama kegiatan atau deskripsi..." class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs font-semibold focus:outline-none focus:ring-2 focus:ring-purple-500 transition" />
                    </div>

                    <!-- Dropdown Hari & Kategori -->
                    <div class="w-full md:w-auto flex flex-wrap md:flex-nowrap gap-3">
                        <select id="filterHariKegiatan" onchange="filterKegiatanRealtime()" class="px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs font-semibold text-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-500 cursor-pointer">
                            <option value="">Semua Hari</option>
                            <option value="senin">Senin</option>
                            <option value="selasa">Selasa</option>
                            <option value="rabu">Rabu</option>
                            <option value="kamis">Kamis</option>
                            <option value="jumat">Jumat</option>
                            <option value="sabtu">Sabtu</option>
                            <option value="minggu">Minggu</option>
                        </select>

                        <select id="filterKategoriKegiatan" onchange="filterKegiatanRealtime()" class="px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs font-semibold text-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-500 cursor-pointer">
                            <option value="">Semua Kategori</option>
                            <option value="administrasi">Administrasi (Ungu)</option>
                            <option value="kebersihan">Kebersihan (Hijau)</option>
                            <option value="keamanan">Keamanan (Kuning)</option>
                            <option value="sosial">Kesehatan/Sosial (Merah)</option>
                            <option value="keagamaan">Keagamaan (Biru)</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- TABEL LIST KEGIATAN -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <?php if (empty($kegiatanList)): ?>
                    <!-- EMPTY STATE -->
                    <div class="text-center py-12 px-4">
                        <div class="w-16 h-16 bg-purple-50 text-purple-600 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-base font-bold text-gray-900">Belum Ada Jadwal Kegiatan</h3>
                        <p class="text-xs text-gray-500 mt-1 max-w-sm mx-auto">Data jadwal kegiatan rutin belum ditemukan atau belum ditambahkan oleh pengurus.</p>
                        <a href="/admin/kegiatan/create" class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-purple-600 text-white font-bold text-xs rounded-xl hover:bg-purple-700 transition">
                            + Tambah Kegiatan Pertama
                        </a>
                    </div>
                <?php else: ?>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead>
                                <tr class="bg-purple-50/80 text-purple-900 font-bold uppercase tracking-wider border-b border-purple-100">
                                    <th class="p-4">Hari & Waktu</th>
                                    <th class="p-4">Nama Kegiatan & Deskripsi</th>
                                    <th class="p-4">Kategori</th>
                                    <th class="p-4">Syarat / Frekuensi</th>
                                    <th class="p-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <?php foreach ($kegiatanList as $item): ?>
                                    <?php
                                    $kId       = $item['id'] ?? '';
                                    $kNama     = $item['nama_kegiatan'] ?? 'Tanpa Nama';
                                    $kHariRaw  = strtolower($item['hari'] ?? '');
                                    $kHari     = ucfirst($kHariRaw);
                                    $kWaktu    = $item['waktu_pelaksanaan'] ?? '-';
                                    $kKategori = strtolower($item['kategori'] ?? 'administrasi');
                                    $kFrek     = $item['keterangan_frekuensi'] ?? '-';
                                    $kDesk     = $item['deskripsi_singkat'] ?? '';
                                    $kSyarat   = $item['persyaratan_ketentuan'] ?? '';
                                    ?>
                                    <tr class="kegiatan-row hover:bg-purple-50/30 transition" data-hari="<?= $kHariRaw ?>" data-kategori="<?= $kKategori ?>">
                                        <!-- Hari & Waktu -->
                                        <td class="p-4">
                                            <span class="block font-extrabold text-purple-900 text-sm"><?= htmlspecialchars($kHari) ?></span>
                                            <span class="text-[11px] font-semibold text-gray-500"><?= htmlspecialchars($kWaktu) ?></span>
                                        </td>

                                        <!-- Nama & Deskripsi -->
                                        <td class="p-4 max-w-xs">
                                            <h4 class="font-bold text-gray-900 text-sm"><?= htmlspecialchars($kNama) ?></h4>
                                            <?php if (!empty($kDesk)): ?>
                                                <p class="text-[11px] text-gray-500 line-clamp-1 mt-0.5"><?= htmlspecialchars($kDesk) ?></p>
                                            <?php endif; ?>
                                        </td>

                                        <!-- Kategori Badge -->
                                        <td class="p-4">
                                            <?php if ($kKategori === 'administrasi'): ?>
                                                <span class="bg-purple-50 text-purple-700 border border-purple-200 text-[10px] font-extrabold px-2.5 py-1 rounded-md uppercase">Administrasi</span>
                                            <?php elseif ($kKategori === 'kebersihan'): ?>
                                                <span class="bg-emerald-50 text-emerald-700 border border-emerald-200 text-[10px] font-extrabold px-2.5 py-1 rounded-md uppercase">Kebersihan</span>
                                            <?php elseif ($kKategori === 'keamanan'): ?>
                                                <span class="bg-amber-50 text-amber-700 border border-amber-200 text-[10px] font-extrabold px-2.5 py-1 rounded-md uppercase">Keamanan</span>
                                            <?php elseif ($kKategori === 'sosial'): ?>
                                                <span class="bg-rose-50 text-rose-700 border border-rose-200 text-[10px] font-extrabold px-2.5 py-1 rounded-md uppercase">Kesehatan / Sosial</span>
                                            <?php else: ?>
                                                <span class="bg-sky-50 text-sky-700 border border-sky-200 text-[10px] font-extrabold px-2.5 py-1 rounded-md uppercase">Keagamaan</span>
                                            <?php endif; ?>
                                        </td>

                                        <!-- Syarat & Frekuensi -->
                                        <td class="p-4">
                                            <span class="block font-semibold text-gray-800"><?= htmlspecialchars($kFrek) ?></span>
                                            <?php if (!empty($kSyarat)): ?>
                                                <span class="text-[11px] text-emerald-700 font-medium line-clamp-1" title="<?= htmlspecialchars($kSyarat) ?>">
                                                    Syarat: <?= htmlspecialchars($kSyarat) ?>
                                                </span>
                                            <?php endif; ?>
                                        </td>

                                        <!-- Aksi -->
                                        <td class="p-4 text-center">
                                            <div class="flex items-center justify-center gap-1.5">
                                                <a href="/admin/kegiatan/edit?id=<?= $kId ?>" class="p-1.5 bg-amber-50 text-amber-700 border border-amber-200 hover:bg-amber-100 rounded-lg transition" title="Edit Kegiatan">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>

                                                <form action="/admin/kegiatan/delete" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal kegiatan ini?')">
                                                    <?= \Core\Csrf::field() ?>
                                                    <input type="hidden" name="id" value="<?= $kId ?>">
                                                    <button type="submit" class="p-1.5 bg-rose-50 text-rose-700 border border-rose-200 hover:bg-rose-100 rounded-lg transition" title="Hapus Kegiatan">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr id="emptyKegiatanSearchState" class="hidden">
                                    <td colspan="5" class="p-8 text-center text-gray-400 font-medium">
                                        Kegiatan tidak ditemukan sesuai kata kunci/filter.
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