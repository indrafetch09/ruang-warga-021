<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= htmlspecialchars($heading ?? 'Detail Laporan Bulanan') ?> - Dasbor Pengurus RW 21</title>
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
                        Kembali ke Daftar Laporan
                    </a>
                    <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">
                        Detail Laporan Bulan <?= htmlspecialchars($laporan['bulan'] ?? '') ?> Tahun <?= htmlspecialchars($laporan['tahun'] ?? '') ?>
                    </h1>
                </div>
                <div class="flex gap-2">
                    <a href="/laporan/create?id=<?= $laporan['id'] ?>" class="px-4 py-2.5 bg-purple-600 hover:bg-purple-700 text-white font-bold rounded-[10px] text-xs transition shadow-sm">
                        Edit Laporan
                    </a>
                </div>
            </div>

            <!-- CARD DETAIL LAPORAN -->
            <div class="bg-white p-6 md:p-8 rounded-2xl border border-purple-100 shadow-sm space-y-6 max-w-4xl">
                <div class="flex justify-between items-center border-b border-gray-100 pb-4">
                    <div>
                        <span class="text-xs font-extrabold uppercase tracking-wider text-purple-700">Laporan Resmi RW 021</span>
                        <h2 class="text-xl font-bold text-gray-900">Periode <?= htmlspecialchars($laporan['bulan'] ?? '') ?>/<?= htmlspecialchars($laporan['tahun'] ?? '') ?></h2>
                    </div>
                    <span class="px-3 py-1 bg-purple-100 text-purple-800 text-xs font-bold rounded-full">
                        Diterbitkan: <?= date('d M Y', strtotime($laporan['created_at'] ?? 'now')) ?>
                    </span>
                </div>

                <div>
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Catatan Ringkasan</h3>
                    <p class="text-sm font-medium text-gray-800 leading-relaxed bg-gray-50 p-4 rounded-xl border border-gray-200">
                        <?= nl2br(htmlspecialchars($laporan['catatan'] ?? 'Tidak ada catatan ringkasan khusus untuk periode ini.')) ?>
                    </p>
                </div>
            </div>

        </main>
    </div>
</body>
</html>
