<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= htmlspecialchars($heading ?? 'Kelola Laporan Bulanan') ?> - Dasbor Pengurus RW 21</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <style>body { font-family: "Plus Jakarta Sans", sans-serif; }</style>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen text-gray-800">
    <?php require base_path('views/partials/admin-header.php'); ?>

    <!-- WRAPPER SIDEBAR & MAIN CONTENT -->
    <div class="flex flex-1 max-w-[1400px] w-full mx-auto relative">
        <?php require base_path('views/partials/admin-sidebar.php'); ?>

        <main class="flex-1 w-full min-w-0 p-4 sm:p-6 lg:p-8 space-y-6">

            <!-- PAGE HEADER -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                <div>
                    <a href="/laporan" class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-purple-600 transition mb-2 group">
                        <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke Arsip Laporan
                    </a>
                    <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">
                        <?= htmlspecialchars($heading ?? 'Buat Laporan Bulanan RW 021') ?>
                    </h1>
                </div>
            </div>

            <!-- FORM CARD -->
            <div class="bg-white rounded-2xl border border-purple-100 shadow-sm overflow-hidden max-w-3xl">
                <form action="/laporan" method="POST">
                    <?= \Core\Csrf::field() ?>
                    <?php if (!empty($laporan['id'])): ?>
                        <input type="hidden" name="id" value="<?= htmlspecialchars($laporan['id']) ?>">
                    <?php endif; ?>

                    <div class="p-6 md:p-8 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Bulan -->
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Bulan Laporan</label>
                                <select name="bulan" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm font-semibold">
                                    <?php
                                    $namaBulan = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'];
                                    $currentBulan = (int)($laporan['bulan'] ?? date('n'));
                                    foreach ($namaBulan as $num => $nama):
                                    ?>
                                        <option value="<?= $num ?>" <?= $currentBulan === $num ? 'selected' : '' ?>><?= $nama ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Tahun -->
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Tahun</label>
                                <input type="number" name="tahun" value="<?= htmlspecialchars($laporan['tahun'] ?? date('Y')) ?>" min="2020" max="2030" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm font-semibold" required>
                            </div>
                        </div>

                        <!-- Ringkasan Catatan Laporan -->
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Catatan Ringkasan Laporan Bulanan</label>
                            <textarea name="catatan" rows="5" placeholder="Tuliskan catatan rekapitulasi penting bulanan (misal: total iuran kas, kegiatan kerja bakti, dll.)..." class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition text-sm resize-none"><?= htmlspecialchars($laporan['catatan'] ?? '') ?></textarea>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="px-6 py-5 bg-gray-50 border-t border-gray-200 flex flex-col sm:flex-row-reverse gap-3">
                        <button type="submit" class="px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white text-sm font-bold rounded-xl shadow-md transition flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Simpan Laporan
                        </button>
                        <a href="/laporan" class="px-6 py-3 bg-white border border-gray-300 hover:bg-gray-100 text-gray-700 text-sm font-bold rounded-xl transition text-center">
                            Batal
                        </a>
                    </div>
                </form>
            </div>

        </main>
    </div>
</body>
</html>
