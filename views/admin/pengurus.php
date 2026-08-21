<!doctype html>
<html lang="id">

<head>
    <title>Manajemen Pengurus - Dasbor RW 021</title>
    <?php require base_path('views/partials/head.php'); ?>
</head>

<body class="text-gray-800 bg-gray-50 flex flex-col min-h-screen">
    <?php require base_path('views/partials/admin-header.php'); ?>

    <?php
    $currentUser = $user ?? \App\Models\User::current();
    $isAdmin = $currentUser->isAdmin();
    ?>

    <div class="flex flex-1 max-w-[1400px] w-full mx-auto relative">
        <?php require base_path('views/partials/admin-sidebar.php'); ?>

        <main class="flex-1 w-full min-w-0 p-4 sm:p-6 lg:p-8 space-y-6">

            <!-- FLASH MESSAGE -->
            <?php $sukses = \Core\Session::get('sukses'); ?>
            <?php $error  = \Core\Session::get('error'); ?>

            <?php if (!empty($sukses)): ?>
                <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-bold rounded-2xl flex items-center gap-2 shadow-sm">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span><?= htmlspecialchars($sukses) ?></span>
                </div>
            <?php endif; ?>

            <?php if (!empty($error)): ?>
                <div class="p-4 bg-rose-50 border border-rose-200 text-rose-800 text-sm font-bold rounded-2xl flex items-center gap-2 shadow-sm">
                    <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span><?= htmlspecialchars($error) ?></span>
                </div>
            <?php endif; ?>

            <!-- PAGE HEADER -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-gray-200 pb-6">
                <div>
                    <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">
                        Manajemen Pengurus RW 021
                    </h2>
                    <p class="text-xs md:text-sm text-gray-500 mt-1">
                        Daftar warga terdaftar yang telah ditugaskan ke dalam struktur organisasi RW 021.
                    </p>
                </div>
                <?php if ($isAdmin): ?>
                    <a href="/admin/pengurus/create" class="px-5 py-2.5 bg-purple-600 hover:bg-purple-700 text-white font-bold text-xs rounded-xl shadow-md transition inline-flex items-center gap-2">
                        + Assign Pengurus Baru
                    </a>
                <?php endif; ?>
            </div>

            <!-- TABEL PENGURUS -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-gray-50 border-b border-gray-200 text-gray-500 uppercase text-[11px] tracking-wider font-bold">
                            <tr>
                                <th class="px-6 py-4">No</th>
                                <th class="px-6 py-4">Nama Pengurus</th>
                                <th class="px-6 py-4">Kategori Hirarki</th>
                                <th class="px-6 py-4">Jabatan Resmi</th>
                                <th class="px-6 py-4">Masa Bakti</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <?php if (empty($pengurusList)): ?>
                                <tr>
                                    <td colspan="6" class="px-6 py-8 text-center text-gray-400 text-sm">
                                        Belum ada pengurus yang ditugaskan.
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php $no = 1;
                                foreach ($pengurusList as $p): ?>
                                    <?php
                                    $id   = is_object($p) ? $p->id : $p['id'];
                                    $nama = is_object($p) ? $p->nama : $p['nama'];
                                    $kat  = is_object($p) ? $p->kategori_jabatan : $p['kategori_jabatan'];
                                    $jab  = is_object($p) ? $p->jabatan : $p['jabatan'];
                                    $per  = is_object($p) ? $p->periode : $p['periode'];
                                    ?>
                                    <tr class="hover:bg-gray-50/80 transition-colors">
                                        <td class="px-6 py-4 font-bold text-gray-500"><?= $no++ ?></td>
                                        <td class="px-6 py-4 font-extrabold text-gray-900"><?= htmlspecialchars($nama) ?></td>
                                        <td class="px-6 py-4">
                                            <span class="px-2.5 py-1 bg-purple-50 text-purple-700 rounded-lg text-xs font-bold uppercase tracking-wider">
                                                <?= htmlspecialchars(str_replace('_', ' ', $kat)) ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 font-bold text-gray-700"><?= htmlspecialchars($jab) ?></td>
                                        <td class="px-6 py-4 text-xs font-medium text-gray-500"><?= htmlspecialchars($per) ?></td>
                                        <td class="px-6 py-4 text-center">
                                            <?php if ($isAdmin): ?>
                                                <div class="inline-flex items-center gap-2">
                                                    <a href="/admin/pengurus/edit?id=<?= $id ?>" class="px-3 py-1.5 bg-amber-50 border border-amber-200 text-amber-700 rounded-lg text-xs font-bold hover:bg-amber-100 transition">
                                                        Edit
                                                    </a>
                                                    <form action="/admin/pengurus/delete" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengurus ini?')">
                                                        <?= \Core\Csrf::field() ?>
                                                        <input type="hidden" name="id" value="<?= $id ?>">
                                                        <button type="submit" class="px-3 py-1.5 bg-rose-50 border border-rose-200 text-rose-700 rounded-lg text-xs font-bold hover:bg-rose-100 transition">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            <?php else: ?>
                                                <span class="px-2.5 py-1 bg-gray-100 text-gray-400 rounded-lg text-xs font-semibold">
                                                    Khusus Admin
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>
</body>

</html>
