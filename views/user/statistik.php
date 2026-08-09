<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Statistik Demografi Warga - Ruang Warga 021</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="/css/theme.css" />
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">

    <?php require base_path('views/partials/navbar.php'); ?>

    <!-- HEADER SECTION -->
    <div class="bg-purple-50 py-12 border-b border-purple-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-2">Statistik <span class="text-purple-600">Penduduk & Wilayah</span></h1>
            <p class="text-gray-600 max-w-2xl mx-auto text-sm md:text-base">Grafik rekapitulasi data demografi, sebaran jumlah Kepala Keluarga (KK), serta kelompok usia se-wilayah RW 021 Bojong Nangka.</p>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="py-12 flex-1">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

            <?php
                // Data Kartu Ringkasan (Fallback dari Controller)
                $summary = $summaryData ?? [
                    'total_kk' => 350,
                    'total_jiwa' => 1245,
                    'total_rt' => 10,
                    'verifikasi' => '98%'
                ];

                // Data RT Detail
                $dataRt = $listDataRt ?? [
                    1 => ['kk' => 32, 'jiwa' => 112],
                    2 => ['kk' => 35, 'jiwa' => 123],
                    3 => ['kk' => 28, 'jiwa' => 98],
                    4 => ['kk' => 40, 'jiwa' => 140],
                    5 => ['kk' => 38, 'jiwa' => 133],
                    6 => ['kk' => 30, 'jiwa' => 105],
                    7 => ['kk' => 36, 'jiwa' => 126],
                    8 => ['kk' => 34, 'jiwa' => 119],
                    9 => ['kk' => 39, 'jiwa' => 137],
                    10 => ['kk' => 38, 'jiwa' => 133]
                ];
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

            <!-- CHARTS SECTION: BAR CHART & PIE CHARTS -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- BAR CHART: SEBARAN KK & JIWA PER RT -->
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

                <!-- PIE CHART: DEMOGRAFI USIA -->
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

                <!-- DOUGHNUT CHART: GENDER -->
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
                    <div class="mt-6 pt-4 border-t border-gray-100 flex justify-around text-center">
                        <div>
                            <span class="text-xs font-bold text-gray-400 uppercase">Laki-laki</span>
                            <span class="text-lg font-extrabold text-blue-600 block">635 Jiwa (51%)</span>
                        </div>
                        <div class="border-r border-gray-200"></div>
                        <div>
                            <span class="text-xs font-bold text-gray-400 uppercase">Perempuan</span>
                            <span class="text-lg font-extrabold text-pink-600 block">610 Jiwa (49%)</span>
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

        </div>
    </div>

    <!-- FOOTER -->
    <?php require base_path('views/partials/footer.php'); ?>

    <!-- SCRIPT INITIALIZE CHART.JS (DYNAMIC DATA INJECTION) -->
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        // Data Dynamic Injection dari Controller / Fallback JSON
        const barLabels = <?= json_encode($chartBarLabels ?? ['RT 01', 'RT 02', 'RT 03', 'RT 04', 'RT 05', 'RT 06', 'RT 07', 'RT 08', 'RT 09', 'RT 10']) ?>;
        const barKk = <?= json_encode($chartBarKk ?? [32, 35, 28, 40, 38, 30, 36, 34, 39, 38]) ?>;
        const barJiwa = <?= json_encode($chartBarJiwa ?? [112, 123, 98, 140, 133, 105, 126, 119, 137, 133]) ?>;

        const usiaData = <?= json_encode($chartUsiaData ?? [215, 180, 680, 170]) ?>;
        const genderData = <?= json_encode($chartGenderData ?? [635, 610]) ?>;

        // 1. BAR CHART: Sebaran KK & Jiwa per RT
        const ctxBar = document.getElementById('barChartRt').getContext('2d');
        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: barLabels,
                datasets: [
                    {
                        label: 'Jumlah KK',
                        data: barKk,
                        backgroundColor: '#9333ea',
                        borderRadius: 6,
                    },
                    {
                        label: 'Estimasi Jiwa',
                        data: barJiwa,
                        backgroundColor: '#059669',
                        borderRadius: 6,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: { font: { family: 'Plus Jakarta Sans', weight: 'bold' } }
                    },
                    tooltip: {
                        backgroundColor: '#1e1b4b',
                        titleFont: { family: 'Plus Jakarta Sans', size: 13, weight: 'bold' },
                        bodyFont: { family: 'Plus Jakarta Sans', size: 12 }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: '#f3f4f6' },
                        ticks: { font: { family: 'Plus Jakarta Sans' } }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { family: 'Plus Jakarta Sans', weight: 'bold' } }
                    }
                }
            }
        });

        // 2. PIE CHART: Kelompok Usia Warga
        const ctxPie = document.getElementById('pieChartUsia').getContext('2d');
        new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: ['Anak (0-12 thn)', 'Remaja (13-18 thn)', 'Dewasa (19-59 thn)', 'Lansia (60+ thn)'],
                datasets: [{
                    data: usiaData,
                    backgroundColor: ['#c084fc', '#38bdf8', '#7e22ce', '#f59e0b'],
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { font: { family: 'Plus Jakarta Sans', weight: '600' }, padding: 15 }
                    },
                    tooltip: {
                        backgroundColor: '#1e1b4b',
                        callbacks: {
                            label: function(context) {
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const val = context.raw;
                                const pct = ((val / total) * 100).toFixed(1);
                                return ` ${context.label}: ${val} Jiwa (${pct}%)`;
                            }
                        }
                    }
                }
            }
        });

        // 3. DOUGHNUT CHART: Komposisi Gender
        const ctxGender = document.getElementById('pieChartGender').getContext('2d');
        new Chart(ctxGender, {
            type: 'doughnut',
            data: {
                labels: ['Laki-laki', 'Perempuan'],
                datasets: [{
                    data: genderData,
                    backgroundColor: ['#2563eb', '#ec4899'],
                    borderWidth: 3,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { font: { family: 'Plus Jakarta Sans', weight: '600' }, padding: 12 }
                    }
                }
            }
        });
    });
    </script>
</body>
</html>
