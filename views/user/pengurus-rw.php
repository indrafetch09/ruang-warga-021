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

    <!-- PAGE HEADER -->
    <div class="bg-purple-50 py-16 border-b border-purple-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 tracking-tight mb-4">
                Struktur <span class="text-purple-600">Pengurus & Data RT</span>
            </h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Mengenal lebih dekat sosok-sosok yang mengabdi serta persebaran warga
                di lingkungan RW 021 (Periode 2024-2027).
            </p>
        </div>
    </div>

    <!-- MAIN CONTENT - STRUKTUR ORGANISASI -->
    <div class="py-20 bg-gray-50 flex-1">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <?php 
                // Data Inti Pengurus (Fallback jika belum di-set dari Controller)
                $ketua = $ketuaRw ?? [
                    'nama' => 'Drs. Ahmad Santoso',
                    'jabatan' => 'Ketua RW 021',
                    'periode' => 'Masa Bakti: 2024 - 2027',
                    'foto' => 'https://ui-avatars.com/api/?name=Ahmad+Santoso&background=7c3aed&color=fff&size=150'
                ];

                $sekretaris = $sekretarisRw ?? [
                    'nama' => 'Hj. Rina Melati, S.E.',
                    'foto' => 'https://ui-avatars.com/api/?name=Rina+Melati&background=10b981&color=fff&size=150'
                ];

                $bendahara = $bendaharaRw ?? [
                    'nama' => 'Hendra Wijaya',
                    'foto' => 'https://ui-avatars.com/api/?name=Hendra+Wijaya&background=10b981&color=fff&size=150'
                ];

                $seksi = $seksiList ?? [
                    ['nama' => 'Budi Purnomo', 'seksi' => 'Keamanan (Kamtib)', 'color' => 'amber', 'foto' => 'https://ui-avatars.com/api/?name=Budi+Purnomo&background=f59e0b&color=fff&size=150'],
                    ['nama' => 'Yanto Basuki', 'seksi' => 'Lingkungan & Kebersihan', 'color' => 'sky', 'foto' => 'https://ui-avatars.com/api/?name=Yanto+Basuki&background=0ea5e9&color=fff&size=150'],
                    ['nama' => 'Ibu Siti Aminah', 'seksi' => 'Sosial & PKK', 'color' => 'rose', 'foto' => 'https://ui-avatars.com/api/?name=Siti+Aminah&background=f43f5e&color=fff&size=150'],
                    ['nama' => 'Rizky Aditama', 'seksi' => 'Pemuda & Olahraga', 'color' => 'purple', 'foto' => 'https://ui-avatars.com/api/?name=Rizky+Aditama&background=8b5cf6&color=fff&size=150']
                ];

                $dataRtList = $listRt ?? [
                    ['rt' => '01', 'ketua' => 'Bpk. Agus S.', 'kk' => 65, 'warga' => 230],
                    ['rt' => '02', 'ketua' => 'Bpk. Herman', 'kk' => 80, 'warga' => 285],
                    ['rt' => '03', 'ketua' => 'Bpk. Dedi J.', 'kk' => 75, 'warga' => 260],
                    ['rt' => '04', 'ketua' => 'Ibu Wahyuni', 'kk' => 60, 'warga' => 220],
                    ['rt' => '05', 'ketua' => 'Bpk. Suryo', 'kk' => 70, 'warga' => 250]
                ];
            ?>

            <!-- LEVEL 1: KETUA RW -->
            <div class="flex justify-center mb-6 md:mb-12">
                <div class="relative w-full max-w-sm hierarchy-line-bottom">
                    <div class="bg-white rounded-2xl shadow-lg border border-purple-100 p-8 flex flex-col items-center text-center transform hover:-translate-y-1 transition-transform duration-300">
                        <img src="<?= htmlspecialchars($ketua['foto']) ?>" alt="Ketua RW" class="w-28 h-28 rounded-full mb-4 object-cover border-4 border-purple-50 shadow-md" />
                        <span class="bg-purple-100 text-purple-700 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-widest mb-3">
                            <?= htmlspecialchars($ketua['jabatan']) ?>
                        </span>
                        <h3 class="text-xl font-bold text-gray-900 mb-1">
                            <?= htmlspecialchars($ketua['nama']) ?>
                        </h3>
                        <p class="text-sm text-gray-500"><?= htmlspecialchars($ketua['periode']) ?></p>
                    </div>
                </div>
            </div>

            <!-- LEVEL 2: SEKRETARIS & BENDAHARA -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-12 max-w-4xl mx-auto mb-16 hierarchy-branch">
                <!-- Sekretaris -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 flex flex-col items-center text-center hierarchy-branch-item hover:border-purple-300 transition-colors">
                    <img src="<?= htmlspecialchars($sekretaris['foto']) ?>" alt="Sekretaris" class="w-20 h-20 rounded-full mb-4 object-cover border-4 border-emerald-50 shadow-md" />
                    <span class="bg-emerald-50 text-emerald-600 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest mb-2">Sekretaris</span>
                    <h3 class="text-lg font-bold text-gray-900 mb-1">
                        <?= htmlspecialchars($sekretaris['nama']) ?>
                    </h3>
                </div>
                <!-- Bendahara -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 flex flex-col items-center text-center hierarchy-branch-item hover:border-purple-300 transition-colors">
                    <img src="<?= htmlspecialchars($bendahara['foto']) ?>" alt="Bendahara" class="w-20 h-20 rounded-full mb-4 object-cover border-4 border-emerald-50 shadow-md" />
                    <span class="bg-emerald-50 text-emerald-600 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest mb-2">Bendahara</span>
                    <h3 class="text-lg font-bold text-gray-900 mb-1">
                        <?= htmlspecialchars($bendahara['nama']) ?>
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
