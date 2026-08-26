<!doctype html>
<html lang="id">

<head>
    <title>Profil - Ruang Warga 021</title>
    <?php require base_path('views/partials/head.php'); ?>
    <style>
        @keyframes fadeInZoom {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .animate-in {
            animation: fadeInZoom 0.25s ease-out forwards;
        }

        #jadwal-modal .overflow-y-auto::-webkit-scrollbar {
            width: 4px;
        }

        #jadwal-modal .overflow-y-auto::-webkit-scrollbar-track {
            background: transparent;
        }

        #jadwal-modal .overflow-y-auto::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 8px;
        }
    </style>
</head>

<body class="bg-gray-50 flex flex-col min-h-screen">
    <!-- NAVBAR -->
    <?php require base_path('views/partials/navbar.php'); ?>

    <!-- HERO / HEADER BANNER -->
    <div class="bg-purple-900 text-white py-12 md:py-16 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-3xl">
                <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight text-white mb-4">
                    Profil RW 021
                </h1>
                <p class="text-base md:text-lg text-purple-200 leading-relaxed">
                    Letak geografis, visi, misi, dan profil lingkungan RW 021 Bojong Nangka, Kelapa Dua, Tangerang.
                </p>
            </div>
        </div>
    </div>

    <!-- MAIN CONTENT CONTAINER -->
    <div class="py-12 md:py-16 bg-gray-50 flex-1">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

            <!-- SECTION: LETAK GEOGRAFIS -->
            <div class="bg-white rounded-lg p-6 md:p-10 shadow-sm border border-gray-200 space-y-6">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-gray-100 pb-4">
                    <div>
                        <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 mt-1">
                            Letak <span class="text-purple-600">Geografis RW 021</span>
                        </h2>
                    </div>
                    <a href="/lokasi" class="px-4 py-2 bg-purple-50 hover:bg-purple-100 text-purple-700 font-extrabold text-xs rounded-lg border border-purple-200 transition inline-flex items-center gap-1.5">
                        <span>Lihat Peta Lengkap</span>
                        <span>&rarr;</span>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Card 1 -->
                    <div class="bg-purple-50/60 p-6 rounded-lg border border-purple-100 space-y-3">
                        <div class="w-10 h-10 bg-purple-600 text-white rounded-lg flex items-center justify-center font-bold shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <h3 class="font-extrabold text-gray-900 text-base">Wilayah Administrasi</h3>
                        <ul class="text-xs text-gray-600 space-y-1.5 font-medium">
                            <li><strong class="text-gray-800">Pemukiman:</strong> Perumahan Dasana Indah</li>
                            <li><strong class="text-gray-800">Cakupan RT:</strong> RT 01 s/d RT 10 (RW 021)</li>
                            <li><strong class="text-gray-800">Kelurahan:</strong> Bojong Nangka</li>
                            <li><strong class="text-gray-800">Kecamatan:</strong> Kelapa Dua</li>
                            <li><strong class="text-gray-800">Kabupaten:</strong> Tangerang, Banten 15810</li>
                        </ul>
                    </div>

                    <!-- Card 2 -->
                    <div class="bg-purple-50/60 p-6 rounded-lg border border-purple-100 space-y-3">
                        <div class="w-10 h-10 bg-emerald-600 text-white rounded-lg flex items-center justify-center font-bold shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                            </svg>
                        </div>
                        <h3 class="font-extrabold text-gray-900 text-base">Batas Wilayah</h3>
                        <ul class="text-xs text-gray-600 space-y-1.5 font-medium">
                            <li><strong class="text-gray-800">Utara:</strong> Wilayah Kelurahan Medang</li>
                            <li><strong class="text-gray-800">Selatan:</strong> Curug Sangereng & Gading Serpong</li>
                            <li><strong class="text-gray-800">Timur:</strong> Kawasan Kelapa Dua</li>
                            <li><strong class="text-gray-800">Barat:</strong> Kecamatan Legok</li>
                        </ul>
                    </div>

                    <!-- Card 3 -->
                    <div class="bg-purple-50/60 p-6 rounded-lg border border-purple-100 space-y-3 flex flex-col justify-between">
                        <div>
                            <div class="w-10 h-10 bg-indigo-600 text-white rounded-lg flex items-center justify-center font-bold shadow-sm mb-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <h3 class="font-extrabold text-gray-900 text-base">Pusat Sekretariat</h3>
                            <p class="text-xs text-gray-600 leading-relaxed font-medium">
                                Posko Sekretariat & Aula RW 021 berlokasi di Dasana Indah. Berfungsi sebagai pusat posyandu, ruang musyawarah warga, dan balai kegiatan.
                            </p>
                        </div>
                        <a href="/lokasi" class="w-full py-2.5 bg-purple-600 hover:bg-purple-700 text-white text-xs font-bold rounded-lg transition text-center flex items-center justify-center gap-1.5 shadow-sm mt-3">
                            <span>Buka Petunjuk Rute</span>
                            <span>&rarr;</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- SECTION: JADWAL KEGIATAN RUTIN -->
            <?php
            if (!isset($kegiatanByHari)) {
                $db = \Core\App::resolve(\Core\Database::class);
                $kegiatanRaw = $db->query("SELECT * FROM kegiatan_rutin ORDER BY FIELD(hari, 'senin','selasa','rabu','kamis','jumat','sabtu','minggu')")->get();

                $kegiatanByHari = [
                    'senin'   => [],
                    'selasa'  => [],
                    'rabu'    => [],
                    'kamis'   => [],
                    'jumat'   => [],
                    'sabtu'   => [],
                    'minggu'  => []
                ];

                foreach ($kegiatanRaw as $item) {
                    $hariKey = strtolower($item['hari'] ?? '');
                    if (isset($kegiatanByHari[$hariKey])) {
                        $kegiatanByHari[$hariKey][] = $item;
                    }
                }
            }

            $daysMap = [
                'senin'   => 'Senin',
                'selasa'  => 'Selasa',
                'rabu'    => 'Rabu',
                'kamis'   => 'Kamis',
                'jumat'   => 'Jumat',
                'sabtu'   => 'Sabtu',
                'minggu'  => 'Minggu'
            ];
            ?>

            <div class="bg-white rounded-lg p-6 md:p-10 shadow-sm border border-gray-200 space-y-6">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-gray-100 pb-4">
                    <div>
                        <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 mt-1">
                            Jadwal <span class="text-purple-600">Kegiatan Rutin</span>
                        </h2>
                    </div>
                </div>

                <!-- GRID 7 HARI -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-7 gap-4">
                    <?php foreach ($daysMap as $dayKey => $dayLabel): ?>
                        <div class="bg-white rounded-lg border border-gray-200 shadow-sm flex flex-col overflow-hidden">
                            <div class="bg-gray-50 border-b border-gray-200 px-4 py-3 text-center">
                                <span class="text-xs font-bold text-gray-700 uppercase tracking-widest"><?= $dayLabel ?></span>
                            </div>
                            <div class="p-3 flex-1 flex flex-col gap-3">
                                <?php if (!empty($kegiatanByHari[$dayKey])): ?>
                                    <?php foreach ($kegiatanByHari[$dayKey] as $k): ?>
                                        <?php
                                        $kat = strtolower($k['kategori'] ?? 'administrasi');
                                        $hoverClass = 'hover:border-purple-300 hover:bg-purple-50/50';
                                        $textClass  = 'text-purple-700';

                                        if ($kat === 'kebersihan') {
                                            $hoverClass = 'hover:border-emerald-300 hover:bg-emerald-50/50';
                                            $textClass  = 'text-emerald-700';
                                        } elseif ($kat === 'keamanan') {
                                            $hoverClass = 'hover:border-amber-300 hover:bg-amber-50/50';
                                            $textClass  = 'text-amber-700';
                                        } elseif ($kat === 'sosial') {
                                            $hoverClass = 'hover:border-rose-300 hover:bg-rose-50/50';
                                            $textClass  = 'text-rose-700';
                                        } elseif ($kat === 'keagamaan') {
                                            $hoverClass = 'hover:border-blue-300 hover:bg-blue-50/50';
                                            $textClass  = 'text-blue-700';
                                        }

                                        $jsonPayload = htmlspecialchars(json_encode($k), ENT_QUOTES, 'UTF-8');
                                        ?>
                                        <div onclick="openDynamicJadwalModal(<?= $jsonPayload ?>)" class="cursor-pointer border border-gray-100 rounded-lg p-3 <?= $hoverClass ?> transition duration-150 group">
                                            <span class="text-xs font-bold text-gray-900 group-hover:<?= $textClass ?> leading-tight block mb-1">
                                                <?= htmlspecialchars($k['nama_kegiatan'] ?? '') ?>
                                            </span>

                                            <div class="flex items-center gap-1 text-[10px] text-gray-500 mb-1 leading-relaxed">
                                                <svg class="w-3.5 h-3.5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <span class="truncate"><?= htmlspecialchars($k['waktu_pelaksanaan'] ?? '') ?></span>
                                            </div>

                                            <?php if (!empty($k['lokasi'])): ?>
                                                <div class="flex items-center gap-1 text-[10px] text-purple-600 font-semibold mb-2">
                                                    <svg class="w-3.5 h-3.5 text-purple-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    </svg>
                                                    <span class="truncate"><?= htmlspecialchars($k['lokasi']) ?></span>
                                                </div>
                                            <?php endif; ?>

                                            <span class="text-[10px] font-bold <?= $textClass ?> block">Lihat Detail &rarr;</span>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="flex-1 flex items-center justify-center py-6">
                                        <span class="text-[11px] text-gray-400 italic">Tidak ada agenda</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Catatan Kaki -->
                <div class="bg-gray-50 rounded-lg border border-gray-200 p-5 max-w-3xl mx-auto shadow-sm">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-gray-900 mb-1">Catatan Penting</h4>
                            <ul class="text-xs text-gray-500 space-y-1.5 list-disc list-inside">
                                <li>Jadwal dapat berubah sewaktu-waktu. Pantau selalu pengumuman di pengurus RT/RW.</li>
                                <li>Untuk layanan administrasi di luar jam, silakan hubungi Ketua RT masing-masing.</li>
                                <li>Ronda malam wajib diikuti sesuai jadwal. Jika berhalangan, harap berkoordinasi dengan petugas.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION: VISI & MISI -->
            <div>
                <div class="flex items-center gap-2 mb-0">
                    <button type="button" id="tab-visi-btn" onclick="toggleVisiMisi('visi')"
                        class="px-6 py-3 font-bold text-sm rounded-t-lg transition-all shadow-sm bg-purple-600 text-white border-t border-x border-purple-600">
                        Visi
                    </button>
                    <button type="button" id="tab-misi-btn" onclick="toggleVisiMisi('misi')"
                        class="px-6 py-3 font-bold text-sm rounded-t-lg transition-all shadow-sm bg-gray-100 text-gray-600 hover:bg-gray-200 border-t border-x border-gray-200">
                        Misi
                    </button>
                </div>

                <div class="bg-white rounded-b-lg rounded-tr-lg p-6 md:p-10 shadow-sm border border-gray-200 relative overflow-hidden">
                    <!-- VISI CONTENT -->
                    <div id="content-visi" class="flex flex-col md:flex-row gap-8 items-start">
                        <div class="w-full md:w-1/3">
                            <h3 class="text-3xl font-extrabold text-gray-900 mb-2">Visi Kami</h3>
                        </div>
                        <div class="w-full md:w-2/3 grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="bg-purple-50/60 border border-purple-100 p-6 rounded-lg hover:border-purple-300 transition-all">
                                <div class="w-12 h-12 bg-purple-600 text-white rounded-lg flex items-center justify-center mb-4 shadow-sm">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m-9 9a9 9 0 019-9"></path>
                                    </svg>
                                </div>
                                <h4 class="text-lg font-bold text-gray-900 mb-2">Digitalisasi Pelayanan</h4>
                                <p class="text-gray-600 text-sm leading-relaxed">
                                    Mewujudkan sistem administrasi kependudukan yang cepat, transparan, dan dapat diakses melalui portal warga.
                                </p>
                            </div>
                            <div class="bg-purple-50/60 border border-purple-100 p-6 rounded-lg hover:border-purple-300 transition-all">
                                <div class="w-12 h-12 bg-purple-600 text-white rounded-lg flex items-center justify-center mb-4 shadow-sm">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                </div>
                                <h4 class="text-lg font-bold text-gray-900 mb-2">Lingkungan Inklusif</h4>
                                <p class="text-gray-600 text-sm leading-relaxed">
                                    Membangun komunitas warga yang saling peduli, guyub rukun, dan menjunjung tinggi nilai toleransi antar tetangga.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- MISI CONTENT -->
                    <div id="content-misi" class="hidden flex flex-col md:flex-row gap-8 items-start">
                        <div class="w-full md:w-1/3">
                            <h3 class="text-3xl font-extrabold text-gray-900 mb-2">Misi Kami</h3>
                        </div>
                        <div class="w-full md:w-2/3 grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="bg-emerald-50/60 border border-emerald-100 p-6 rounded-lg hover:border-emerald-300 transition-all">
                                <div class="w-12 h-12 bg-emerald-600 text-white rounded-lg flex items-center justify-center mb-4 shadow-sm">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                </div>
                                <h4 class="text-lg font-bold text-gray-900 mb-2">Keamanan & Ketertiban 24 Jam</h4>
                                <p class="text-gray-600 text-sm leading-relaxed">
                                    Optimalisasi sistem jam malam portal, penambahan CCTV lingkungan, dan pos ronda aktif di tiap RT.
                                </p>
                            </div>
                            <div class="bg-emerald-50/60 border border-emerald-100 p-6 rounded-lg hover:border-emerald-300 transition-all">
                                <div class="w-12 h-12 bg-emerald-600 text-white rounded-lg flex items-center justify-center mb-4 shadow-sm">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                    </svg>
                                </div>
                                <h4 class="text-lg font-bold text-gray-900 mb-2">Pengelolaan Kebersihan</h4>
                                <p class="text-gray-600 text-sm leading-relaxed">
                                    Penguatan armada pengangkutan sampah, pemilahan sampah, serta kerja bakti rutin warga.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- FOOTER -->
    <?php require base_path('views/partials/footer.php'); ?>

    <!-- MODAL OVERLAY DETAIL JADWAL KEGIATAN RUTIN -->
    <div id="jadwal-modal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-2xl rounded-lg shadow-2xl overflow-hidden animate-in max-h-[90vh] flex flex-col">
            <div id="jmodal-header-bg" class="px-6 py-5 bg-purple-700 text-white flex justify-between items-center transition-colors">
                <div>
                    <span id="jmodal-category" class="text-[10px] font-bold tracking-wider uppercase opacity-80">Jadwal Kegiatan Rutin</span>
                    <h3 id="jmodal-title" class="text-xl font-bold leading-tight">Detail Kegiatan</h3>
                </div>
                <button type="button" onclick="closeJadwalModal()" class="text-white/80 hover:text-white text-2xl font-bold p-1">&times;</button>
            </div>

            <div class="p-6 space-y-6 overflow-y-auto flex-1 text-sm text-gray-700">
                <div>
                    <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Deskripsi Kegiatan</h4>
                    <p id="jmodal-description" class="leading-relaxed text-gray-800 font-medium"></p>
                </div>

                <div id="jmodal-frekuensi-box" class="bg-purple-50/60 p-4 rounded-lg border border-purple-100 hidden">
                    <h4 class="text-xs font-bold text-purple-900 uppercase tracking-wider mb-1">Keterangan Frekuensi / Rutinitas</h4>
                    <p id="jmodal-frekuensi" class="text-xs font-bold text-purple-950"></p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Persyaratan / Ketentuan</h4>
                        <p id="jmodal-requirements" class="text-xs text-gray-700 font-medium leading-relaxed"></p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Waktu, Hari & Lokasi</h4>
                        <p id="jmodal-schedule" class="text-xs text-gray-700 font-semibold leading-relaxed"></p>
                    </div>
                </div>

                <div class="p-4 bg-emerald-50 rounded-lg border border-emerald-200 flex justify-between items-center">
                    <div>
                        <span class="text-[10px] font-bold uppercase text-emerald-800">Penanggung Jawab / Pengurus</span>
                        <p id="jmodal-coordinator" class="font-bold text-emerald-950 text-sm">Pengurus RW 021</p>
                    </div>
                    <a id="jmodal-wa-btn" href="https://wa.me/6281511322022" target="_blank" rel="noopener noreferrer" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold rounded-lg transition shadow-sm flex items-center gap-1">
                        Chat WA
                    </a>
                </div>
            </div>

            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end">
                <button type="button" onclick="closeJadwalModal()" class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold text-xs rounded-lg transition">Tutup Detail</button>
            </div>
        </div>
    </div>

    <!-- UNIVERSAL APP SCRIPT -->
    <script src="/script.js"></script>
</body>

</html>