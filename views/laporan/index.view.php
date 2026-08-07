<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Laporan Bulanan - Sistem Informasi RW 21</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <style>body { font-family: "Plus Jakarta Sans", sans-serif; }</style>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">

    <?php require base_path('views/partials/navbar.php'); ?>

    <!-- HEADER -->
    <div class="bg-purple-50 py-12 border-b border-purple-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-2">Arsip <span class="text-purple-600">Laporan Bulanan</span></h1>
            <p class="text-gray-600 max-w-2xl mx-auto">Rekapitulasi data kependudukan dan kegiatan rutin warga RW 21 setiap bulan.</p>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="py-12 flex-1">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold text-gray-800">Daftar Laporan</h2>
                <?php if ($_SESSION['user'] ?? false): ?>
                    <a href="/laporan/create" class="bg-purple-600 hover:bg-purple-700 text-white font-bold px-5 py-2.5 rounded-[10px] transition shadow-md flex items-center gap-2 text-sm">
                        <span>+</span> Buat Laporan Baru
                    </a>
                <?php endif; ?>
            </div>

            <?php if (empty($laporans)): ?>
                <div class="bg-white p-12 rounded-2xl shadow-sm border border-gray-100 text-center">
                    <div class="w-16 h-16 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mx-auto mb-4 font-bold text-2xl">📋</div>
                    <h3 class="text-lg font-bold text-gray-800 mb-1">Belum Ada Laporan</h3>
                    <p class="text-gray-500 text-sm">Belum ada dokumen laporan bulanan yang diterbitkan.</p>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php 
                    $namaBulan = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'];
                    foreach ($laporans as $lap): 
                        $bulanText = $namaBulan[(int)$lap['bulan']] ?? $lap['bulan'];
                    ?>
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition flex flex-col justify-between">
                            <div>
                                <div class="flex justify-between items-start mb-4">
                                    <span class="bg-purple-100 text-purple-800 text-xs font-bold px-3 py-1 rounded-full">Tahun <?= htmlspecialchars($lap['tahun']) ?></span>
                                    <span class="text-xs text-gray-400"><?= date('d M Y', strtotime($lap['created_at'] ?? 'now')) ?></span>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Laporan Bulan <?= $bulanText ?></h3>
                                <p class="text-sm text-gray-600 mb-6">Rekapitulasi resmi kependudukan dan kegiatan wilayah RW 21.</p>
                            </div>
                            <div class="flex gap-2">
                                <a href="/laporan?id=<?= $lap['id'] ?>" class="flex-1 text-center bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold py-2 rounded-[10px] text-sm transition">Detail</a>
                                <?php if ($_SESSION['user'] ?? false): ?>
                                    <a href="/laporan/export?id=<?= $lap['id'] ?>&format=pdf" class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-4 py-2 rounded-[10px] text-sm transition">PDF</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </div>
    </div>

</body>
</html>
