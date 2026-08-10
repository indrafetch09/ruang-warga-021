<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Struktur Pengurus - Ruang Warga 021</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="/css/theme.css" />
    <style>
        /* Garis penghubung hierarki (Desktop Only) */
        @media (min-width: 768px) {
            .hierarchy-line-bottom::after {
                content: "";
                position: absolute;
                bottom: -24px;
                left: 50%;
                transform: translateX(-50%);
                width: 2px;
                height: 24px;
                background-color: #e5e7eb;
            }

            .hierarchy-branch {
                position: relative;
            }

            .hierarchy-branch::before {
                content: "";
                position: absolute;
                top: -24px;
                left: 25%;
                right: 25%;
                height: 2px;
                background-color: #e5e7eb;
            }

            .hierarchy-branch-item::before {
                content: "";
                position: absolute;
                top: -24px;
                left: 50%;
                transform: translateX(-50%);
                width: 2px;
                height: 24px;
                background-color: #e5e7eb;
            }
        }
    </style>
</head>

<body class="bg-gray-50 flex flex-col min-h-screen">
    <!-- NAVBAR -->
    <?php require base_path('views/partials/navbar.php'); ?>

    <!-- MAIN CONTENT - STRUKTUR ORGANISASI -->
    <div class="py-12 bg-gray-50 flex-1">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

            <!-- SIMPLE PAGE HEADER -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-gray-200 pb-6">
                <div>
                    <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900">Struktur <span class="text-purple-600">Pengurus & Data RT</span></h1>
                    <p class="text-xs md:text-sm text-gray-500 mt-1">Bagan organisasi pengurus RW 021 dan rekap data Rukun Tetangga (RT).</p>
                </div>
            </div>

            <?php
                $ketua = $ketuaRw ?? null;
                $sekretaris = $sekretarisRw ?? null;
                $bendahara = $bendaharaRw ?? null;
                $seksi = $seksiList ?? [];
                $dataRtList = $listRt ?? [];

                $ketuaFoto = $ketua['foto'] ?? 'https://ui-avatars.com/api/?name=Ketua+RW&background=7c3aed&color=fff&size=150';
                $ketuaJabatan = $ketua['jabatan'] ?? 'Ketua RW 021';
                $ketuaNama = $ketua['nama'] ?? 'Belum Diinputkan';
                $ketuaPeriode = $ketua['periode'] ?? 'Masa Bakti 2024 - 2027';

                $sekretarisFoto = $sekretaris['foto'] ?? 'https://ui-avatars.com/api/?name=Sekretaris&background=10b981&color=fff&size=150';
                $sekretarisNama = $sekretaris['nama'] ?? 'Belum Diinputkan';

                $bendaharaFoto = $bendahara['foto'] ?? 'https://ui-avatars.com/api/?name=Bendahara&background=10b981&color=fff&size=150';
                $bendaharaNama = $bendahara['nama'] ?? 'Belum Diinputkan';
            ?>

            <!-- LEVEL 1: KETUA RW -->
            <div class="flex justify-center mb-6 md:mb-12">
                <div class="relative w-full max-w-sm hierarchy-line-bottom">
                    <div class="bg-white rounded-2xl shadow-lg border border-purple-100 p-8 flex flex-col items-center text-center transform hover:-translate-y-1 transition-transform duration-300">
                        <img src="<?= htmlspecialchars($ketuaFoto) ?>" alt="Ketua RW" class="w-28 h-28 rounded-full mb-4 object-cover border-4 border-purple-50 shadow-md" />
                        <span class="bg-purple-100 text-purple-700 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-widest mb-3">
                            <?= htmlspecialchars($ketuaJabatan) ?>
                        </span>
                        <h3 class="text-xl font-bold text-gray-900 mb-1">
                            <?= htmlspecialchars($ketuaNama) ?>
                        </h3>
                        <p class="text-sm text-gray-500"><?= htmlspecialchars($ketuaPeriode) ?></p>
                    </div>
                </div>
            </div>

            <!-- LEVEL 2: SEKRETARIS & BENDAHARA -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-12 max-w-4xl mx-auto mb-16 hierarchy-branch">
                <!-- Sekretaris -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 flex flex-col items-center text-center hierarchy-branch-item hover:border-purple-300 transition-colors">
                    <img src="<?= htmlspecialchars($sekretarisFoto) ?>" alt="Sekretaris" class="w-20 h-20 rounded-full mb-4 object-cover border-4 border-emerald-50 shadow-md" />
                    <span class="bg-emerald-50 text-emerald-600 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest mb-2">Sekretaris</span>
                    <h3 class="text-lg font-bold text-gray-900 mb-1">
                        <?= htmlspecialchars($sekretarisNama) ?>
                    </h3>
                </div>
                <!-- Bendahara -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 flex flex-col items-center text-center hierarchy-branch-item hover:border-purple-300 transition-colors">
                    <img src="<?= htmlspecialchars($bendaharaFoto) ?>" alt="Bendahara" class="w-20 h-20 rounded-full mb-4 object-cover border-4 border-emerald-50 shadow-md" />
                    <span class="bg-emerald-50 text-emerald-600 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest mb-2">Bendahara</span>
                    <h3 class="text-lg font-bold text-gray-900 mb-1">
                        <?= htmlspecialchars($bendaharaNama) ?>
                    </h3>
                </div>
            </div>

            <!-- LEVEL 3: SEKSI-SEKSI -->
            <div class="mb-16">
                <div class="flex items-center justify-center gap-4 mb-8">
                    <div class="h-px bg-gray-200 flex-1 max-w-[100px]"></div>
                    <h2 class="text-xl font-extrabold text-gray-800 uppercase tracking-wide">
                        Koordinator Seksi
                    </h2>
                    <div class="h-px bg-gray-200 flex-1 max-w-[100px]"></div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <?php foreach ($seksi as $s): ?>
                        <?php
                            $badgeColor = match($s['color'] ?? 'purple') {
                                'amber' => 'text-amber-600 border-amber-50',
                                'sky'   => 'text-sky-600 border-sky-50',
                                'rose'  => 'text-rose-600 border-rose-50',
                                default => 'text-purple-600 border-purple-50'
                            };
                        ?>
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex flex-col items-center text-center hover:shadow-md transition-shadow">
                            <img src="<?= htmlspecialchars($s['foto']) ?>" alt="Seksi" class="w-16 h-16 rounded-full mb-3 object-cover border-2 <?= $badgeColor ?>" />
                            <span class="text-[10px] font-bold <?= explode(' ', $badgeColor)[0] ?> mb-1 uppercase"><?= htmlspecialchars($s['seksi']) ?></span>
                            <h4 class="text-base font-bold text-gray-900"><?= htmlspecialchars($s['nama']) ?></h4>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- LEVEL 4: KETUA RT & DATA WARGA -->
            <div>
                <div class="flex items-center justify-center gap-4 mb-8">
                    <div class="h-px bg-gray-200 flex-1 max-w-[100px]"></div>
                    <h2 class="text-xl font-extrabold text-gray-800 uppercase tracking-wide text-center">
                        Pengurus Rukun Tetangga & Data Warga
                    </h2>
                    <div class="h-px bg-gray-200 flex-1 max-w-[100px]"></div>
                </div>

                <?php if (empty($dataRtList)): ?>
                    <div class="p-8 text-center bg-white rounded-2xl border border-gray-200 text-gray-500 text-sm">
                        Data Wilayah RT belum diinputkan.
                    </div>
                <?php else: ?>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
                        <?php foreach ($dataRtList as $rt): ?>
                            <div class="bg-white rounded-2xl border border-gray-200 p-6 flex flex-col items-center text-center hover:border-purple-400 hover:shadow-lg transition-all">
                                <div class="w-14 h-14 bg-gradient-to-br from-purple-100 to-purple-200 text-purple-700 rounded-full flex items-center justify-center font-extrabold text-xl mb-4 shadow-inner">
                                    <?= htmlspecialchars($rt['rt']) ?>
                                </div>
                                <h4 class="text-base font-bold text-gray-900 mb-1">
                                    <?= htmlspecialchars($rt['ketua']) ?>
                                </h4>
                                <p class="text-xs text-gray-500 font-medium mb-5 bg-gray-100 px-3 py-1 rounded-full">
                                    Ketua RT <?= htmlspecialchars($rt['rt']) ?>
                                </p>

                                <div class="w-full bg-gray-50 rounded-xl p-3 grid grid-cols-2 gap-2 border border-gray-100 mt-auto">
                                    <div class="border-r border-gray-200">
                                        <span class="block text-xl font-extrabold text-purple-600"><?= number_format($rt['kk']) ?></span>
                                        <span class="text-[10px] text-gray-500 font-bold uppercase tracking-wider">KK</span>
                                    </div>
                                    <div>
                                        <span class="block text-xl font-extrabold text-emerald-600"><?= number_format($rt['warga']) ?></span>
                                        <span class="text-[10px] text-gray-500 font-bold uppercase tracking-wider">Warga</span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>

    <!-- FOOTER -->
    <?php require base_path('views/partials/footer.php'); ?>
</body>

</html>
