<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Laporan Bulanan - Dasbor Pengurus RW 021</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <style>
        body { font-family: "Plus Jakarta Sans", sans-serif; }
        @media print {
            .no-print { display: none !important; }
            body { background: white !important; }
            .print-card { border: none !important; shadow: none !important; }
        }
    </style>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen text-gray-800">
    <!-- ADMIN HEADER -->
    <?php require base_path('views/partials/admin-header.php'); ?>

    <!-- WRAPPER SIDEBAR & MAIN CONTENT -->
    <div class="flex flex-1 max-w-[1400px] w-full mx-auto relative">
        <div class="no-print">
            <?php require base_path('views/partials/admin-sidebar.php'); ?>
        </div>

        <main class="flex-1 w-full min-w-0 p-4 sm:p-6 lg:p-8 space-y-6">

            <?php
                $namaBulan = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'];
                $bulanNum = (int)($laporan['bulan'] ?? date('n'));
                $bulanText = $namaBulan[$bulanNum] ?? 'Agustus';
                $tahunText = htmlspecialchars($laporan['tahun'] ?? date('Y'));
                
                // Fallback Rincian Kas & Statistik jika tidak dikirim dari Controller
                $rekapKas = $laporan['rekap_kas'] ?? [
                    'pemasukan' => 14500000,
                    'pengeluaran' => 9200000,
                    'saldo_akhir' => 5300000
                ];
            ?>

            <!-- BREADCRUMB & ACTION BAR -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 no-print">
                <div>
                    <a href="/laporan" class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-purple-600 transition mb-2 group">
                        <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke Daftar Laporan
                    </a>
                    <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">
                        Laporan Bulanan: <span class="text-purple-600"><?= $bulanText ?> <?= $tahunText ?></span>
                    </h1>
                </div>

                <div class="flex items-center gap-3">
                    <button onclick="window.print()" class="px-4 py-2.5 bg-white border border-gray-300 hover:bg-gray-100 text-gray-700 text-sm font-bold rounded-xl shadow-sm transition flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                        </svg>
                        Cetak
                    </button>
                    <a href="/laporan/export?id=<?= $laporan['id'] ?? 1 ?>&format=pdf" class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold rounded-xl shadow-md transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Export PDF
                    </a>
                </div>
            </div>

            <!-- MAIN REPORT CARD -->
            <div class="bg-white rounded-2xl border border-purple-100 shadow-sm print-card overflow-hidden">
                <!-- HEAD BANNER -->
                <div class="p-6 md:p-8 bg-gradient-to-r from-purple-700 to-purple-900 text-white flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <span class="inline-block px-3 py-1 bg-white/20 backdrop-blur-md text-white text-xs font-bold rounded-full uppercase tracking-widest mb-2">
                            Dokumen Resmi RW 021
                        </span>
                        <h2 class="text-2xl md:text-3xl font-extrabold">Rekapitulasi Periode <?= $bulanText ?> <?= $tahunText ?></h2>
                        <p class="text-purple-200 text-xs md:text-sm mt-1">Sistem Informasi Manajemen Pelayanan Warga Bojong Nangka</p>
                    </div>
                    <div class="text-left md:text-right text-xs text-purple-200">
                        <p>Diterbitkan: <strong class="text-white"><?= date('d F Y', strtotime($laporan['created_at'] ?? 'now')) ?></strong></p>
                        <p class="mt-0.5">Penanggung Jawab: <strong class="text-white">Pengurus RW 021</strong></p>
                    </div>
                </div>

                <div class="p-6 md:p-8 space-y-8">
                    
                    <!-- SUMMARY FINANCIAL CARDS -->
                    <div>
                        <h3 class="text-xs font-extrabold text-gray-400 uppercase tracking-wider mb-4">1. Ringkasan Kas & Keuangan RW</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div class="p-5 rounded-xl bg-emerald-50 border border-emerald-100">
                                <span class="text-xs font-bold text-emerald-700 uppercase block mb-1">Pemasukan Bulan Ini</span>
                                <span class="text-2xl font-extrabold text-emerald-800 block">Rp <?= number_format($rekapKas['pemasukan']) ?></span>
                            </div>
                            <div class="p-5 rounded-xl bg-rose-50 border border-rose-100">
                                <span class="text-xs font-bold text-rose-700 uppercase block mb-1">Pengeluaran Bulan Ini</span>
                                <span class="text-2xl font-extrabold text-rose-800 block">Rp <?= number_format($rekapKas['pengeluaran']) ?></span>
                            </div>
                            <div class="p-5 rounded-xl bg-purple-50 border border-purple-100">
                                <span class="text-xs font-bold text-purple-700 uppercase block mb-1">Saldo Bersih / Sisa Kas</span>
                                <span class="text-2xl font-extrabold text-purple-900 block">Rp <?= number_format($rekapKas['saldo_akhir']) ?></span>
                            </div>
                        </div>
                    </div>

                    <hr class="border-gray-100" />

                    <!-- CATATAN REKAPITULASI -->
                    <div>
                        <h3 class="text-xs font-extrabold text-gray-400 uppercase tracking-wider mb-3">2. Catatan & Laporan Pelaksanaan Kegiatan</h3>
                        <div class="p-5 bg-gray-50 rounded-xl border border-gray-200 text-sm text-gray-700 leading-relaxed whitespace-pre-line">
                            <?= !empty($laporan['catatan']) ? htmlspecialchars($laporan['catatan']) : 'Tidak ada catatan khusus yang diinputkan untuk periode bulan ini.' ?>
                        </div>
                    </div>

                    <hr class="border-gray-100" />

                    <!-- SIGNATURE FOOTER -->
                    <div class="pt-4 grid grid-cols-2 gap-8 text-center text-xs text-gray-600">
                        <div>
                            <p class="mb-12">Mengetahui,<br><strong class="text-gray-900">Ketua RW 021</strong></p>
                            <p class="font-bold text-gray-900 underline">( Drs. Ahmad Santoso )</p>
                        </div>
                        <div>
                            <p class="mb-12">Dibuat Oleh,<br><strong class="text-gray-900">Sekretaris RW 021</strong></p>
                            <p class="font-bold text-gray-900 underline">( Hj. Rina Melati, S.E. )</p>
                        </div>
                    </div>

                </div>
            </div>

        </main>
    </div>
</body>
</html>
