<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Statistik Warga - Ruang Warga 021</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="/css/theme.css" />
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">

    <?php require base_path('views/partials/navbar.php'); ?>

    <!-- HEADER -->
    <div class="bg-purple-50 py-12 border-b border-purple-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-block px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-xs font-bold tracking-wide uppercase mb-3">Informasi Publik</span>
            <h1 class="text-4xl font-extrabold text-gray-900 mb-2">Statistik <span class="text-purple-600">Demografi Warga</span></h1>
            <p class="text-gray-600 max-w-2xl mx-auto">Ringkasan data kependudukan dan sebaran warga se-wilayah RW 021 Bojong Nangka.</p>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="py-12 flex-1">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

            <!-- Summary Cards -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm text-center">
                    <span class="text-3xl font-extrabold text-purple-700 block mb-1">350</span>
                    <span class="text-xs text-gray-500 font-semibold uppercase tracking-wider">Kepala Keluarga</span>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm text-center">
                    <span class="text-3xl font-extrabold text-purple-700 block mb-1">1.245</span>
                    <span class="text-xs text-gray-500 font-semibold uppercase tracking-wider">Total Jiwa</span>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm text-center">
                    <span class="text-3xl font-extrabold text-purple-700 block mb-1">10</span>
                    <span class="text-xs text-gray-500 font-semibold uppercase tracking-wider">Rukun Tetangga (RT)</span>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm text-center">
                    <span class="text-3xl font-extrabold text-emerald-600 block mb-1">98%</span>
                    <span class="text-xs text-gray-500 font-semibold uppercase tracking-wider">Warga Terverifikasi</span>
                </div>
            </div>

            <!-- RT Distribution Table -->
            <div class="bg-white p-8 rounded-2xl border border-purple-100 shadow-sm">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Sebaran Penduduk per RT (RT 01 - RT 10)</h2>
                
                <div class="space-y-4">
                    <?php for ($i = 1; $i <= 10; $i++): 
                        $kk = [32, 35, 28, 40, 38, 30, 36, 34, 39, 38][$i - 1];
                        $jiwa = $kk * 3.5;
                        $pct = round(($kk / 350) * 100);
                    ?>
                        <div>
                            <div class="flex justify-between items-center text-xs font-semibold text-gray-700 mb-1">
                                <span>RT <?= sprintf('%02d', $i) ?> RW 021</span>
                                <span><?= $kk ?> KK (± <?= round($jiwa) ?> Jiwa)</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-2.5 overflow-hidden">
                                <div class="bg-purple-600 h-2.5 rounded-full" style="width: <?= $pct ?>%"></div>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>

        </div>
    </div>

</body>
</html>
