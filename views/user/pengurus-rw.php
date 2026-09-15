<!doctype html>
<html lang="id">

<head>
    <?php $title = "Struktur Pengurus - Ruang Warga 021";
    require base_path('views/partials/head.php'); ?>
    <style>
        @media (min-width: 768px) {
            .hierarchy-line-bottom::after {
                content: "";
                position: absolute;
                bottom: -20px;
                left: 50%;
                transform: translateX(-50%);
                width: 2px;
                height: 20px;
                background-color: #cbd5e1;
            }

            .hierarchy-branch {
                position: relative;
            }

            .hierarchy-branch::before {
                content: "";
                position: absolute;
                top: -20px;
                left: 20%;
                right: 25%;
                height: 2px;
                background-color: #cbd5e1;
            }

            .hierarchy-branch-item::before {
                content: "";
                position: absolute;
                top: -20px;
                left: 50%;
                transform: translateX(-50%);
                width: 2px;
                height: 20px;
                background-color: #cbd5e1;
            }
        }
    </style>
</head>

<body class="bg-gray-50 flex flex-col min-h-screen">
    <!-- NAVBAR -->
    <?php require base_path('views/partials/navbar.php'); ?>

    <?php
    // Helper Avatar Auto Generator
    $getAvatar = function ($nama, $bg = '7c3aed', $color = 'fff') {
        $cleanName = (!empty($nama) && $nama !== 'Belum Ditugaskan') ? $nama : 'Belum Ada';
        $nameEnc = urlencode($cleanName);
        return "https://ui-avatars.com/api/?name={$nameEnc}&background={$bg}&color={$color}&size=150&bold=true";
    };

    // LOGIKA SINKRONISASI DATABASE DENGAN SLOT STATIS
    $mapJabatan = [];
    $allPengurus = $pengurusList ?? [];

    foreach ($allPengurus as $p) {
        $jab = is_object($p) ? $p->jabatan : ($p['jabatan'] ?? '');
        if ($jab) {
            $mapJabatan[$jab][] = $p;
        }
    }

    $getSlotInfo = function ($jabatanKey) use ($mapJabatan) {
        if (!empty($mapJabatan[$jabatanKey])) {
            $items = $mapJabatan[$jabatanKey];
            $names = array_map(fn($item) => is_object($item) ? $item->nama : $item['nama'], $items);
            $periode = is_object($items[0]) ? ($items[0]->periode ?? '2025 - 2028') : ($items[0]['periode'] ?? '2025 - 2028');
            return [
                'assigned' => true,
                'nama' => implode(', ', $names),
                'periode' => $periode
            ];
        }
        return [
            'assigned' => false,
            'nama' => 'Belum Ditugaskan',
            'periode' => 'Periode 2025 - 2028'
        ];
    };
    ?>

    <!-- HERO / HEADER BANNER -->
    <div class="bg-purple-900 text-white py-12 md:py-16 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-3xl">
                <span class="bg-amber-400 text-purple-950 text-xs font-black px-3.5 py-1 rounded-lg uppercase tracking-widest inline-block mb-3 shadow-sm">
                    PERIODE 2025 - 2028
                </span>
                <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight text-white mb-4">
                    Struktur Organisasi Pengurus RW 021
                </h1>
                <p class="text-base md:text-lg text-purple-200 leading-relaxed">
                    Bagan organisasi, susunan kepengurusan, dan penanggung jawab seksi pelayanan lingkungan RW 021 Bojong Nangka.
                </p>
            </div>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <main class="py-10 bg-gray-50 flex-1">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

            <!-- LEVEL 1: PENASEHAT -->
            <?php $penasehatInfo = $getSlotInfo('Penasehat'); ?>
            <div class="flex justify-center">
                <div class="w-full max-w-2xl bg-white rounded-lg p-6 border border-rose-100 shadow-sm text-center">
                    <span class="bg-rose-600 text-white text-[11px] font-black px-4 py-1 rounded-lg uppercase tracking-wider inline-block mb-4 shadow-sm">
                        Penasehat
                    </span>

                    <div class="flex flex-wrap justify-center gap-6">
                        <div class="flex flex-col items-center">
                            <img src="<?= $getAvatar($penasehatInfo['nama'], $penasehatInfo['assigned'] ? '9f1239' : 'cbd5e1') ?>" class="w-14 h-14 rounded-full mb-2 border-2 border-rose-100 shadow-sm" alt="Penasehat" />
                            <h5 class="font-extrabold text-xs <?= $penasehatInfo['assigned'] ? 'text-gray-900' : 'text-gray-400 italic' ?>">
                                <?= htmlspecialchars($penasehatInfo['nama']) ?>
                            </h5>
                        </div>
                    </div>
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
                    <div class="bg-white rounded-lg shadow-xl border-2 border-purple-300 p-8 flex flex-col items-center text-center transform hover:-translate-y-1 transition-all">
                        <img src="<?= $getAvatar($ketuaInfo['nama'], $ketuaInfo['assigned'] ? '7c3aed' : 'cbd5e1') ?>" alt="Ketua RW" class="w-28 h-28 rounded-full mb-4 object-cover border-4 border-purple-100 shadow-md" />
                        <span class="bg-amber-400 text-purple-950 text-xs font-black px-4 py-1 rounded-lg uppercase tracking-widest mb-3 shadow-sm">
                            KETUA RW 021
                        </span>
                        <h3 class="text-xl md:text-2xl font-black <?= $ketuaInfo['assigned'] ? 'text-gray-900' : 'text-gray-400 italic' ?> mb-1">
                            <?= htmlspecialchars($ketuaInfo['nama']) ?>
                        </h3>
                        <p class="text-xs font-bold text-purple-600"><?= htmlspecialchars($ketuaInfo['periode']) ?></p>
                    </div>
                </div>
            </div>

            <!-- LEVEL 3: SEKRETARIS & BENDAHARA -->
            <?php $sekretarisInfo = $getSlotInfo('Sekretaris'); ?>
            <?php $bendaharaInfo  = $getSlotInfo('Bendahara'); ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-12 max-w-4xl mx-auto my-8 hierarchy-branch">
                <!-- Sekretaris -->
                <div class="bg-white rounded-lg shadow-md border border-purple-100 p-6 flex flex-col items-center text-center hierarchy-branch-item">
                    <img src="<?= $getAvatar($sekretarisInfo['nama'], $sekretarisInfo['assigned'] ? '059669' : 'cbd5e1') ?>" alt="Sekretaris" class="w-20 h-20 rounded-full mb-3 object-cover border-4 border-emerald-50 shadow-sm" />
                    <span class="bg-amber-400 text-purple-950 text-[11px] font-black px-3 py-1 rounded-lg uppercase tracking-wider mb-2">SEKRETARIS</span>
                    <h3 class="text-lg font-extrabold <?= $sekretarisInfo['assigned'] ? 'text-gray-900' : 'text-gray-400 italic' ?>">
                        <?= htmlspecialchars($sekretarisInfo['nama']) ?>
                    </h3>
                </div>

                <!-- Bendahara -->
                <div class="bg-white rounded-lg shadow-md border border-purple-100 p-6 flex flex-col items-center text-center hierarchy-branch-item">
                    <img src="<?= $getAvatar($bendaharaInfo['nama'], $bendaharaInfo['assigned'] ? '059669' : 'cbd5e1') ?>" alt="Bendahara" class="w-20 h-20 rounded-full mb-3 object-cover border-4 border-emerald-50 shadow-sm" />
                    <span class="bg-amber-400 text-purple-950 text-[11px] font-black px-3 py-1 rounded-lg uppercase tracking-wider mb-2">BENDAHARA</span>
                    <h3 class="text-lg font-extrabold <?= $bendaharaInfo['assigned'] ? 'text-gray-900' : 'text-gray-400 italic' ?>">
                        <?= htmlspecialchars($bendaharaInfo['nama']) ?>
                    </h3>
                </div>
            </div>

            <!-- LEVEL 4: SEKSI - SEKSI -->
            <?php
            $seksiListDef = [
                'Pembangunan & Infrastruktur',
                'Keamanan & Ketertiban',
                'Pemberdayaan Masyarakat',
                'Kepemudaan, Olah Raga & Seni',
                'Humas'
            ];
            ?>
            <div class="space-y-6">
                <div class="flex items-center justify-center gap-4">
                    <div class="h-px bg-purple-200 flex-1"></div>
                    <span class="bg-amber-400 text-purple-950 text-xs font-black px-6 py-2 rounded-lg uppercase tracking-widest shadow-sm">
                        SEKSI - SEKSI
                    </span>
                    <div class="h-px bg-purple-200 flex-1"></div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <?php foreach ($seksi as $s): ?>
                        <?php
                        $badgeColor = match ($s['color'] ?? 'purple') {
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

            <!-- LEVEL 5: SUB-TIM & LEMBAGA -->
            <?php
            $timListDef = [
                'Team Kebersihan',
                'Hansip',
                'Karang Taruna',
                'PKK',
                'Posyandu'
            ];
            ?>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
                <?php foreach ($timListDef as $timName): ?>
                    <?php $timInfo = $getSlotInfo($timName); ?>
                    <div class="bg-white p-4 rounded-lg border border-gray-200 text-center">
                        <span class="bg-amber-300 text-purple-950 text-[10px] font-extrabold px-2 py-0.5 rounded-lg block mb-2">
                            <?= htmlspecialchars($timName) ?>
                        </span>
                        <h5 class="font-bold text-xs <?= $timInfo['assigned'] ? 'text-gray-900' : 'text-gray-400 italic' ?>">
                            <?= htmlspecialchars($timInfo['nama']) ?>
                        </h5>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- LEVEL 6: JAJARAN KETUA RT 001 - RT 010 -->
            <div class="pt-8">
                <div class="flex items-center justify-center gap-4 mb-8">
                    <div class="h-px bg-purple-200 flex-1"></div>
                    <span class="bg-purple-900 text-white text-xs font-black px-6 py-2 rounded-lg uppercase tracking-widest shadow-sm">
                        JAJARAN KETUA RT 001 - RT 010
                    </span>
                    <div class="h-px bg-purple-200 flex-1"></div>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
                    <?php for ($i = 1; $i <= 10; $i++): ?>
                        <?php
                        $noRt = sprintf('%03d', $i);
                        $noRtFormatted = sprintf('%02d', $i);
                        $rtJabatanKey = "Ketua RT {$noRt}";
                        $rtInfo = $getSlotInfo($rtJabatanKey);
                        ?>
                        <div class="bg-white rounded-lg border border-purple-100 p-4 flex flex-col items-center text-center justify-between">
                            <div class="flex flex-col items-center">
                                <span class="bg-amber-300 text-purple-950 text-[10px] font-black px-3 py-0.5 rounded-lg uppercase tracking-wider mb-2">
                                    KETUA RT <?= $noRtFormatted ?>
                                </span>
                                <img src="<?= $getAvatar($rtInfo['nama'], $rtInfo['assigned'] ? '581c87' : 'cbd5e1') ?>" class="w-14 h-14 rounded-full mb-2 border-2 border-purple-100 shadow-sm" alt="Ketua RT" />
                                <h4 class="text-xs font-extrabold <?= $rtInfo['assigned'] ? 'text-gray-900' : 'text-gray-400 italic' ?>">
                                    <?= htmlspecialchars($rtInfo['nama']) ?>
                                </h4>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>

        </div>
    </main>

    <!-- FOOTER -->
    <?php require base_path('views/partials/footer.php'); ?>
</body>

</html>