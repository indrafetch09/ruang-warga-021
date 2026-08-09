<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kelola Notulen Rapat - Dasbor Pengurus RW 021</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: "Plus Jakarta Sans", sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 flex flex-col min-h-screen text-gray-800">
    <!-- ADMIN HEADER -->
    <?php require base_path('views/partials/admin-header.php'); ?>

    <!-- WRAPPER SIDEBAR & MAIN CONTENT -->
    <div class="flex flex-1 max-w-[1400px] w-full mx-auto relative">
        <?php require base_path('views/partials/admin-sidebar.php'); ?>

        <main class="flex-1 w-full min-w-0 p-4 sm:p-6 lg:p-8 space-y-6">

            <!-- PAGE TITLE & BUTTON -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-2">
                <div>
                    <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">Kelola Notulen Rapat</h1>
                    <p class="text-sm text-gray-500 mt-1">Arsip dan dokumentasi hasil musyawarah warga serta keputusan rapat pengurus RW 021.</p>
                </div>
                <a href="/admin/notulensi/create" class="px-5 py-2.5 bg-purple-600 hover:bg-purple-700 text-white font-bold text-sm rounded-xl shadow-md transition flex items-center gap-2">
                    <span class="text-lg">+</span> Tambah Notulensi
                </a>
            </div>

            <!-- SEARCH & FILTER BAR -->
            <form action="/admin/notulensi" method="GET" class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm flex flex-col md:flex-row gap-4 justify-between items-center">
                <div class="w-full md:w-1/2 relative">
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input type="text" name="q" value="<?= htmlspecialchars($_GET['q'] ?? '') ?>" placeholder="Cari judul rapat atau materi bahasan..." class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm">
                </div>
                <div class="w-full md:w-auto flex gap-3">
                    <select name="kategori" onchange="this.form.submit()" class="px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-purple-500">
                        <option value="">Semua Kategori</option>
                        <option value="Rapat Rutin" <?= ($_GET['kategori'] ?? '') === 'Rapat Rutin' ? 'selected' : '' ?>>Rapat Rutin</option>
                        <option value="Rapat Khusus" <?= ($_GET['kategori'] ?? '') === 'Rapat Khusus' ? 'selected' : '' ?>>Rapat Khusus</option>
                        <option value="Laporan Kas" <?= ($_GET['kategori'] ?? '') === 'Laporan Kas' ? 'selected' : '' ?>>Laporan Kas</option>
                    </select>
                </div>
            </form>

            <?php
            $listNotulensi = $notulensis ?? [
                [
                    'id' => 1,
                    'tanggal' => '2026-08-12',
                    'judul' => 'Rapat Persiapan HUT RI ke-81',
                    'kategori' => 'Rapat Rutin',
                    'pemimpin' => 'Drs. Ahmad Santoso',
                    'created_at' => '2026-08-12 21:30:00'
                ],
                [
                    'id' => 2,
                    'tanggal' => '2026-07-28',
                    'judul' => 'Evaluasi Keamanan Lingkungan & Jam Malam Portal',
                    'kategori' => 'Rapat Khusus',
                    'pemimpin' => 'Khusairi (Humas)',
                    'created_at' => '2026-07-28 22:00:00'
                ]
            ];
            ?>

            <!-- TABLE CONTAINER -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <?php if (empty($listNotulensi)): ?>
                    <div class="p-12 text-center">
                        <div class="w-16 h-16 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mx-auto mb-4 font-bold text-2xl">📝</div>
                        <h3 class="text-lg font-bold text-gray-800 mb-1">Belum Ada Notulensi</h3>
                        <p class="text-gray-500 text-sm">Belum ada dokumen hasil rapat yang dicatat ke sistem.</p>
                    </div>
                <?php else: ?>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-gray-50 border-b border-gray-200 text-xs font-bold uppercase text-gray-500 tracking-wider">
                                <tr>
                                    <th class="py-4 px-6">Tanggal Rapat</th>
                                    <th class="py-4 px-6">Judul Rapat</th>
                                    <th class="py-4 px-6">Kategori</th>
                                    <th class="py-4 px-6">Pemimpin Rapat</th>
                                    <th class="py-4 px-6 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <?php foreach ($listNotulensi as $item): ?>
                                    <tr class="hover:bg-purple-50/30 transition">
                                        <td class="py-4 px-6 font-semibold text-gray-900 whitespace-nowrap">
                                            <?= date('d M Y', strtotime($item['tanggal'])) ?>
                                        </td>
                                        <td class="py-4 px-6 font-bold text-gray-900">
                                            <a href="/notulensi/detail?id=<?= $item['id'] ?>" class="hover:text-purple-600 transition">
                                                <?= htmlspecialchars($item['judul']) ?>
                                            </a>
                                        </td>
                                        <td class="py-4 px-6 whitespace-nowrap">
                                            <span class="px-3 py-1 bg-purple-50 text-purple-700 font-bold text-xs rounded-full border border-purple-200">
                                                <?= htmlspecialchars($item['kategori']) ?>
                                            </span>
                                        </td>
                                        <td class="py-4 px-6 text-gray-600 whitespace-nowrap">
                                            <?= htmlspecialchars($item['pemimpin'] ?? 'Pengurus RW') ?>
                                        </td>
                                        <td class="py-4 px-6 text-right space-x-2 whitespace-nowrap">
                                            <a href="/admin/notulensi/edit?id=<?= $item['id'] ?>" class="inline-block px-3 py-1.5 bg-amber-50 hover:bg-amber-100 text-amber-700 font-bold text-xs rounded-lg transition">
                                                Edit
                                            </a>
                                            <form action="/admin/notulensi/delete" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus notulensi rapat ini?')">
                                                <?= \Core\Csrf::field() ?>
                                                <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                                <button type="submit" class="px-3 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-700 font-bold text-xs rounded-lg transition">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>

        </main>
    </div>
</body>

</html>
