<!DOCTYPE html>
<html lang="id">

<head>
    <title>Statistik Demografi Warga - Ruang Warga 021</title>
    <?php require base_path('views/partials/head.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gray-50 flex flex-col min-h-screen">

    <?php require base_path('views/partials/navbar.php'); ?>

    <!-- MAIN CONTENT -->
    <div class="py-12 flex-1">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

            <!-- SIMPLE PAGE HEADER -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-gray-200 pb-6">
                <div>
                    <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900">Statistik <span class="text-purple-600">Demografi Penduduk</span></h1>
                    <p class="text-xs md:text-sm text-gray-500 mt-1">Grafik rekapitulasi data demografi dan sebaran jumlah KK per RT 01 s/d 10.</p>
                </div>
            </div>

            <?php
            $summary = $summaryData ?? [
                'total_kk' => 0,
                'total_jiwa' => 0,
                'total_rt' => 10,
                'verifikasi' => '0%'
            ];

            $dataRt = $listDataRt ?? [];
            for ($i = 1; $i <= 10; $i++) {
                if (!isset($dataRt[$i])) {
                    $dataRt[$i] = ['kk' => 0, 'jiwa' => 0];
                }
            }
            ?>

            <!-- SUMMARY CARDS -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
                <div class="bg-white p-6 rounded-2xl border border-purple-100 shadow-sm text-center hover:shadow-md transition">
                    <span class="text-3xl md:text-4xl font-extrabold text-purple-700 block mb-1"><?= number_format($summary['total_kk']) ?></span>
                    <span class="text-xs text-gray-500 font-bold uppercase tracking-wider">Kepala Keluarga (KK)</span>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-purple-100 shadow-sm text-center hover:shadow-md transition">
                    <span class="text-3xl md:text-4xl font-extrabold text-purple-700 block mb-1"><?= number_format($summary['total_jiwa']) ?></span>
                    <span class="text-xs text-gray-500 font-bold uppercase tracking-wider">Total Jiwa Warga</span>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-purple-100 shadow-sm text-center hover:shadow-md transition">
                    <span class="text-3xl md:text-4xl font-extrabold text-purple-700 block mb-1"><?= htmlspecialchars($summary['total_rt']) ?></span>
                    <span class="text-xs text-gray-500 font-bold uppercase tracking-wider">Rukun Tetangga (RT 01-10)</span>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-purple-100 shadow-sm text-center hover:shadow-md transition">
                    <span class="text-3xl md:text-4xl font-extrabold text-emerald-600 block mb-1"><?= htmlspecialchars($summary['verifikasi']) ?></span>
                    <span class="text-xs text-gray-500 font-bold uppercase tracking-wider">Terverifikasi Digital</span>
                </div>
            </div>

            <!-- CHARTS SECTION -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- BAR CHART -->
                <div class="lg:col-span-2 bg-white p-6 md:p-8 rounded-2xl border border-purple-100 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-6 border-b border-gray-100 pb-4">
                            <div>
                                <h2 class="text-lg md:text-xl font-extrabold text-gray-900">Diagram Batang: Sebaran Penduduk per RT</h2>
                                <p class="text-xs text-gray-500 mt-1">Perbandingan jumlah Kepala Keluarga (KK) dan estimasi Jiwa di RT 01 s/d RT 10.</p>
                            </div>
                            <span class="hidden sm:inline-block px-3 py-1 bg-purple-50 text-purple-700 text-xs font-bold rounded-lg border border-purple-200">RT 01 - RT 10</span>
                        </div>
                        <div class="relative h-80 w-full">
                            <canvas id="barChartRt"></canvas>
                        </div>
                    </div>
                </div>

                <!-- PIE CHART -->
                <div class="bg-white p-6 md:p-8 rounded-2xl border border-purple-100 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="mb-6 border-b border-gray-100 pb-4">
                            <h2 class="text-lg md:text-xl font-extrabold text-gray-900">Diagram Lingkaran: Kelompok Usia</h2>
                            <p class="text-xs text-gray-500 mt-1">Persentase sebaran rentang umur populasi warga.</p>
                        </div>
                        <div class="relative h-72 w-full flex items-center justify-center">
                            <canvas id="pieChartUsia"></canvas>
                        </div>
                    </div>
                </div>

            </div>

            <!-- SECONDARY CHARTS & DATA TABLE -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- DOUGHNUT CHART -->
                <div class="bg-white p-6 md:p-8 rounded-2xl border border-purple-100 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="mb-6 border-b border-gray-100 pb-4">
                            <h2 class="text-lg md:text-xl font-extrabold text-gray-900">Komposisi Gender Warga</h2>
                            <p class="text-xs text-gray-500 mt-1">Rasio Laki-laki vs Perempuan di RW 021.</p>
                        </div>
                        <div class="relative h-64 w-full flex items-center justify-center">
                            <canvas id="pieChartGender"></canvas>
                        </div>
                    </div>
                    <?php
                    $lCount = $genderStats['L'] ?? $chartGenderData[0] ?? 0;
                    $pCount = $genderStats['P'] ?? $chartGenderData[1] ?? 0;
                    $gTotal = max($lCount + $pCount, 1);
                    $pctL = ($lCount > 0) ? round(($lCount / $gTotal) * 100) : 0;
                    $pctP = ($pCount > 0) ? round(($pCount / $gTotal) * 100) : 0;
                    ?>
                    <div class="mt-6 pt-4 border-t border-gray-100 flex justify-around text-center">
                        <div>
                            <span class="text-xs font-bold text-gray-400 uppercase">Laki-laki</span>
                            <span class="text-lg font-extrabold text-blue-600 block"><?= number_format($lCount) ?> Jiwa (<?= $pctL ?>%)</span>
                        </div>
                        <div class="border-r border-gray-200"></div>
                        <div>
                            <span class="text-xs font-bold text-gray-400 uppercase">Perempuan</span>
                            <span class="text-lg font-extrabold text-pink-600 block"><?= number_format($pCount) ?> Jiwa (<?= $pctP ?>%)</span>
                        </div>
                    </div>
                </div>

                <!-- TABEL RINCIAN SEBARAN RT -->
                <div class="lg:col-span-2 bg-white p-6 md:p-8 rounded-2xl border border-purple-100 shadow-sm">
                    <h2 class="text-lg md:text-xl font-extrabold text-gray-900 mb-6 border-b border-gray-100 pb-4">Rincian Data Kependudukan RT 01 - RT 10</h2>

                    <?php if (empty($dataRt)): ?>
                        <div class="p-8 text-center text-gray-500 text-sm">
                            Data rekapitulasi RT belum tersedia.
                        </div>
                    <?php else: ?>
                        <div class="space-y-4">
                            <?php foreach ($dataRt as $i => $row): ?>
                                <?php $pct = round(($row['kk'] / max($summary['total_kk'], 1)) * 100); ?>
                                <div>
                                    <div class="flex justify-between items-center text-xs font-bold text-gray-700 mb-1">
                                        <span class="flex items-center gap-2">
                                            <span class="w-2 h-2 rounded-full bg-purple-600"></span>
                                            RT <?= sprintf('%02d', $i) ?> RW 021
                                        </span>
                                        <span class="text-gray-500 font-semibold"><?= $row['kk'] ?> KK &bull; <strong class="text-purple-700"><?= $row['jiwa'] ?> Jiwa</strong> (<?= $pct ?>%)</span>
                                    </div>
                                    <div class="w-full bg-gray-100 rounded-full h-2.5 overflow-hidden">
                                        <div class="bg-gradient-to-r from-purple-500 to-purple-700 h-2.5 rounded-full transition-all duration-300" style="width: <?= min($pct * 2.5, 100) ?>%"></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

            </div>

            <!-- FOOTER -->
            <?php require base_path('views/partials/footer.php'); ?>

            <!-- DYNAMIC DATA BINDING UNTUK CHART.JS -->
            <script>
                window.chartBarLabels = <?= json_encode($chartBarLabels ?? ['RT 01', 'RT 02', 'RT 03', 'RT 04', 'RT 05', 'RT 06', 'RT 07', 'RT 08', 'RT 09', 'RT 10']) ?>;
                window.chartBarKk = <?= json_encode($chartBarKk ?? [32, 35, 28, 40, 38, 30, 36, 34, 39, 38]) ?>;
                window.chartBarJiwa = <?= json_encode($chartBarJiwa ?? [112, 123, 98, 140, 133, 105, 126, 119, 137, 133]) ?>;
                window.chartUsiaData = <?= json_encode($chartUsiaData ?? [215, 180, 680, 170]) ?>;
                window.chartGenderData = <?= json_encode($chartGenderData ?? [635, 610]) ?>;
            </script>
            <script src="/script.js"></script>
</body>

</html>