<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tentang Kami - Ruang Warga 021</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="/css/theme.css" />
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

        #postModal .overflow-y-auto::-webkit-scrollbar {
            width: 4px;
        }
        #postModal .overflow-y-auto::-webkit-scrollbar-track {
            background: transparent;
        }
        #postModal .overflow-y-auto::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 8px;
        }
    </style>
</head>

<body class="bg-gray-50 flex flex-col min-h-screen">
    <!-- NAVBAR -->
    <?php require base_path('views/partials/navbar.php'); ?>

    <!-- MAIN CONTENT CONTAINER -->
    <div class="py-12 bg-gray-50 flex-1">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

            <!-- SIMPLE PAGE HEADER -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-gray-200 pb-6">
                <div>
                    <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900">Profil <span class="text-purple-600">RW 021</span></h1>
                    <p class="text-xs md:text-sm text-gray-500 mt-1">Letak geografis, visi, misi, dan profil lingkungan RW 021 Bojong Nangka.</p>
                </div>
            </div>

            <!-- SECTION: LETAK GEOGRAFIS -->
            <div class="bg-white rounded-2xl p-6 md:p-10 shadow-sm border border-gray-200 space-y-6">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-gray-100 pb-4">
                    <div>
                        <span class="text-xs font-bold text-purple-600 uppercase tracking-widest">Informasi Wilayah</span>
                        <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 mt-1">
                            Letak <span class="text-purple-600">Geografis RW 021</span>
                        </h2>
                        <p class="text-xs md:text-sm text-gray-500 mt-1">Gambaran lokasi, batas wilayah administrasi, dan koordinat lingkungan RW 021 Bojong Nangka.</p>
                    </div>
                    <a href="/lokasi" class="px-4 py-2 bg-purple-50 hover:bg-purple-100 text-purple-700 font-extrabold text-xs rounded-xl border border-purple-200 transition inline-flex items-center gap-1.5">
                        <span>Lihat Peta Lengkap</span>
                        <span>&rarr;</span>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Card 1: Alamat Administrasi -->
                    <div class="bg-purple-50/60 p-6 rounded-2xl border border-purple-100 space-y-3">
                        <div class="w-10 h-10 bg-purple-600 text-white rounded-xl flex items-center justify-center font-bold shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <h3 class="font-extrabold text-gray-900 text-base">Wilayah Administrasi</h3>
                        <ul class="text-xs text-gray-600 space-y-1.5 font-medium">
                            <li><strong class="text-gray-800">Pemukiman:</strong> Perumahan Dasana Indah</li>
                            <li><strong class="text-gray-800">Cakupan RT:</strong> RT 01 s/d RT 06 (RW 021)</li>
                            <li><strong class="text-gray-800">Kelurahan:</strong> Bojong Nangka</li>
                            <li><strong class="text-gray-800">Kecamatan:</strong> Kelapa Dua</li>
                            <li><strong class="text-gray-800">Kabupaten:</strong> Tangerang, Banten 15810</li>
                        </ul>
                    </div>

                    <!-- Card 2: Batas Wilayah -->
                    <div class="bg-purple-50/60 p-6 rounded-2xl border border-purple-100 space-y-3">
                        <div class="w-10 h-10 bg-emerald-600 text-white rounded-xl flex items-center justify-center font-bold shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                        </div>
                        <h3 class="font-extrabold text-gray-900 text-base">Batas Wilayah</h3>
                        <ul class="text-xs text-gray-600 space-y-1.5 font-medium">
                            <li><strong class="text-gray-800">Utara:</strong> Wilayah Kelurahan Medang</li>
                            <li><strong class="text-gray-800">Selatan:</strong> Curug Sangereng & Gading Serpong</li>
                            <li><strong class="text-gray-800">Timur:</strong> Kawasan Kelapa Dua</li>
                            <li><strong class="text-gray-800">Barat:</strong> Kecamatan Legok</li>
                        </ul>
                    </div>

                    <!-- Card 3: Pusat Sekretariat -->
                    <div class="bg-purple-50/60 p-6 rounded-2xl border border-purple-100 space-y-3 flex flex-col justify-between">
                        <div>
                            <div class="w-10 h-10 bg-indigo-600 text-white rounded-xl flex items-center justify-center font-bold shadow-sm mb-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            </div>
                            <h3 class="font-extrabold text-gray-900 text-base">Pusat Sekretariat</h3>
                            <p class="text-xs text-gray-600 leading-relaxed font-medium">
                                Posko Sekretariat & Aula RW 021 berlokasi di RT 05 / RW 021 Dasana Indah. Berfungsi sebagai pusat posyandu, ruang musyawarah warga, dan balai olahraga.
                            </p>
                        </div>
                        <a href="/lokasi" class="w-full py-2.5 bg-purple-600 hover:bg-purple-700 text-white text-xs font-bold rounded-xl transition text-center flex items-center justify-center gap-1.5 shadow-sm mt-3">
                            <span>Buka Petunjuk Rute</span>
                            <span>&rarr;</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- SECTION: JADWAL KEGIATAN RUTIN -->
            <div class="bg-white rounded-2xl p-6 md:p-10 shadow-sm border border-gray-200 space-y-6">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-gray-100 pb-4">
                    <div>
                        <span class="text-xs font-bold text-purple-600 uppercase tracking-widest">Agenda Warga</span>
                        <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 mt-1">
                            Jadwal <span class="text-purple-600">Kegiatan Rutin</span>
                        </h2>
                        <p class="text-xs md:text-sm text-gray-500 mt-1">Jadwal pelayanan administrasi, kegiatan olahraga, pelayanan posyandu, dan siskamling warga.</p>
                    </div>
                </div>

                <!-- GRID 7 HARI -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-7 gap-4">
                    <!-- Senin -->
                    <div class="bg-white rounded-xl border border-gray-200 shadow-sm flex flex-col overflow-hidden">
                        <div class="bg-gray-50 border-b border-gray-200 px-4 py-3 text-center">
                            <span class="text-xs font-bold text-gray-700 uppercase tracking-widest">Senin</span>
                        </div>
                        <div class="p-3 flex-1 flex flex-col gap-3">
                            <div onclick="openJadwalModal('surat-pengantar')" class="cursor-pointer border border-gray-100 rounded-lg p-3 hover:border-purple-300 hover:bg-purple-50/50 transition duration-150 group">
                                <span class="text-xs font-bold text-gray-900 group-hover:text-purple-700 leading-tight block mb-1">Pelayanan & Administrasi</span>
                                <p class="text-[10px] text-gray-500 mb-2 leading-relaxed">Surat Pengantar, KTP, KK, SKTM</p>
                                <span class="text-[10px] font-bold text-purple-700 block">Lihat Detail &rarr;</span>
                            </div>
                        </div>
                    </div>

                    <!-- Selasa -->
                    <div class="bg-white rounded-xl border border-gray-200 shadow-sm flex flex-col overflow-hidden">
                        <div class="bg-gray-50 border-b border-gray-200 px-4 py-3 text-center">
                            <span class="text-xs font-bold text-gray-700 uppercase tracking-widest">Selasa</span>
                        </div>
                        <div class="p-3 flex-1 flex flex-col gap-3">
                            <div onclick="openJadwalModal('soccer')" class="cursor-pointer border border-gray-100 rounded-lg p-3 hover:border-indigo-300 hover:bg-indigo-50/50 transition duration-150 group">
                                <span class="text-xs font-bold text-gray-900 group-hover:text-indigo-700 leading-tight block mb-1">Soccer Passing</span>
                                <p class="text-[10px] text-gray-500 mb-2 leading-relaxed">Latihan Usia Dini (16.00 WIB)</p>
                                <span class="text-[10px] font-bold text-indigo-700 block">Lihat Detail &rarr;</span>
                            </div>
                        </div>
                    </div>

                    <!-- Rabu -->
                    <div class="bg-white rounded-xl border border-gray-200 shadow-sm flex flex-col overflow-hidden">
                        <div class="bg-gray-50 border-b border-gray-200 px-4 py-3 text-center">
                            <span class="text-xs font-bold text-gray-700 uppercase tracking-widest">Rabu</span>
                        </div>
                        <div class="p-3 flex-1 flex flex-col gap-3">
                            <div onclick="openJadwalModal('senam')" class="cursor-pointer border border-gray-100 rounded-lg p-3 hover:border-indigo-300 hover:bg-indigo-50/50 transition duration-150 group">
                                <span class="text-xs font-bold text-gray-900 group-hover:text-indigo-700 leading-tight block mb-1">Senam Jasmani</span>
                                <p class="text-[10px] text-gray-500 mb-2 leading-relaxed">SSJ & Prolanis (07.00 WIB)</p>
                                <span class="text-[10px] font-bold text-indigo-700 block">Lihat Detail &rarr;</span>
                            </div>
                        </div>
                    </div>

                    <!-- Kamis -->
                    <div class="bg-white rounded-xl border border-gray-200 shadow-sm flex flex-col overflow-hidden">
                        <div class="bg-gray-50 border-b border-gray-200 px-4 py-3 text-center">
                            <span class="text-xs font-bold text-gray-700 uppercase tracking-widest">Kamis</span>
                        </div>
                        <div class="p-3 flex-1 flex flex-col gap-3">
                            <div onclick="openJadwalModal('tpst-jadwal')" class="cursor-pointer border border-gray-100 rounded-lg p-3 hover:border-emerald-300 hover:bg-emerald-50/50 transition duration-150 group">
                                <span class="text-xs font-bold text-gray-900 group-hover:text-emerald-700 leading-tight block mb-1">Angkut Sampah</span>
                                <p class="text-[10px] text-gray-500 mb-2 leading-relaxed">Petugas TPST RW 021</p>
                                <span class="text-[10px] font-bold text-emerald-700 block">Lihat Detail &rarr;</span>
                            </div>
                        </div>
                    </div>

                    <!-- Jumat -->
                    <div class="bg-white rounded-xl border border-gray-200 shadow-sm flex flex-col overflow-hidden">
                        <div class="bg-gray-50 border-b border-gray-200 px-4 py-3 text-center">
                            <span class="text-xs font-bold text-gray-700 uppercase tracking-widest">Jumat</span>
                        </div>
                        <div class="p-3 flex-1 flex flex-col gap-3">
                            <div onclick="openJadwalModal('badminton')" class="cursor-pointer border border-gray-100 rounded-lg p-3 hover:border-purple-300 hover:bg-purple-50/50 transition duration-150 group">
                                <span class="text-xs font-bold text-gray-900 group-hover:text-purple-700 leading-tight block mb-1">PB Karang Taruna</span>
                                <p class="text-[10px] text-gray-500 mb-2 leading-relaxed">Bulu Tangkis (19.30 WIB)</p>
                                <span class="text-[10px] font-bold text-purple-700 block">Lihat Detail &rarr;</span>
                            </div>
                        </div>
                    </div>

                    <!-- Sabtu -->
                    <div class="bg-white rounded-xl border border-gray-200 shadow-sm flex flex-col overflow-hidden">
                        <div class="bg-gray-50 border-b border-gray-200 px-4 py-3 text-center">
                            <span class="text-xs font-bold text-gray-700 uppercase tracking-widest">Sabtu</span>
                        </div>
                        <div class="p-3 flex-1 flex flex-col gap-3">
                            <div onclick="openJadwalModal('senam')" class="cursor-pointer border border-gray-100 rounded-lg p-3 hover:border-indigo-300 hover:bg-indigo-50/50 transition duration-150 group">
                                <span class="text-xs font-bold text-gray-900 group-hover:text-indigo-700 leading-tight block mb-1">Senam Jasmani</span>
                                <p class="text-[10px] text-gray-500 mb-2 leading-relaxed">Senam Pagi (07.00 WIB)</p>
                                <span class="text-[10px] font-bold text-indigo-700 block">Lihat Detail &rarr;</span>
                            </div>
                            <div onclick="openJadwalModal('ronda')" class="cursor-pointer border border-gray-100 rounded-lg p-3 hover:border-amber-300 hover:bg-amber-50/50 transition duration-150 group">
                                <span class="text-xs font-bold text-gray-900 group-hover:text-amber-700 leading-tight block mb-1">Ronda Siskamling</span>
                                <p class="text-[10px] text-gray-500 mb-2 leading-relaxed">Keamanan (22.00 - 04.00 WIB)</p>
                                <span class="text-[10px] font-bold text-amber-700 block">Lihat Detail &rarr;</span>
                            </div>
                        </div>
                    </div>

                    <!-- Minggu -->
                    <div class="bg-white rounded-xl border border-gray-200 shadow-sm flex flex-col overflow-hidden">
                        <div class="bg-gray-50 border-b border-gray-200 px-4 py-3 text-center">
                            <span class="text-xs font-bold text-gray-700 uppercase tracking-widest">Minggu</span>
                        </div>
                        <div class="p-3 flex-1 flex flex-col gap-3">
                            <div onclick="openJadwalModal('posyandu')" class="cursor-pointer border border-gray-100 rounded-lg p-3 hover:border-rose-300 hover:bg-rose-50/50 transition duration-150 group">
                                <span class="text-xs font-bold text-gray-900 group-hover:text-rose-700 leading-tight block mb-1">Posyandu ILP</span>
                                <p class="text-[10px] text-gray-500 mb-2 leading-relaxed">Minggu Ke-4 (08.00 WIB)</p>
                                <span class="text-[10px] font-bold text-rose-700 block">Lihat Detail &rarr;</span>
                            </div>
                            <div onclick="openJadwalModal('karate')" class="cursor-pointer border border-gray-100 rounded-lg p-3 hover:border-indigo-300 hover:bg-indigo-50/50 transition duration-150 group">
                                <span class="text-xs font-bold text-gray-900 group-hover:text-indigo-700 leading-tight block mb-1">Latihan Karate</span>
                                <p class="text-[10px] text-gray-500 mb-2 leading-relaxed">Sore (15.30 - 17.00 WIB)</p>
                                <span class="text-[10px] font-bold text-indigo-700 block">Lihat Detail &rarr;</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Catatan Kaki -->
                <div class="bg-gray-50 rounded-xl border border-gray-200 p-5 max-w-3xl mx-auto shadow-sm">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-gray-900 mb-1">Catatan Penting</h4>
                            <ul class="text-xs text-gray-500 space-y-1.5 list-disc list-inside">
                                <li>Jadwal dapat berubah sewaktu-waktu. Pantau selalu pengumuman di grup WhatsApp RW.</li>
                                <li>Untuk layanan administrasi di luar jam, silakan hubungi Ketua RT masing-masing.</li>
                                <li>Ronda malam wajib diikuti sesuai jadwal. Jika berhalangan, harap mencari pengganti.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION: VISI & MISI (TOGGLE BUTTONS & WHITE BG) -->
            <div>
                <div class="flex items-center gap-2 mb-0">
                    <button type="button" id="tab-visi-btn" onclick="toggleVisiMisi('visi')"
                        class="px-6 py-3 font-bold text-sm rounded-t-xl transition-all shadow-sm bg-purple-600 text-white border-t border-x border-purple-600">
                        Visi
                    </button>
                    <button type="button" id="tab-misi-btn" onclick="toggleVisiMisi('misi')"
                        class="px-6 py-3 font-bold text-sm rounded-t-xl transition-all shadow-sm bg-gray-100 text-gray-600 hover:bg-gray-200 border-t border-x border-gray-200">
                        Misi
                    </button>
                </div>

                <!-- WHITE BACKGROUND CONTAINER -->
                <div class="bg-white rounded-b-2xl rounded-tr-2xl p-6 md:p-10 shadow-sm border border-gray-200 relative overflow-hidden">

                    <!-- VISI CONTENT -->
                    <div id="content-visi" class="flex flex-col md:flex-row gap-8 items-start">
                        <div class="w-full md:w-1/3">
                            <h3 class="text-3xl font-extrabold text-gray-900 mb-2">Visi Kami</h3>
                            <p class="text-gray-600 font-medium text-sm leading-relaxed mb-4">
                                Tujuan utama dan cita-cita yang ingin dicapai oleh kepengurusan RW 021 untuk masa depan warga.
                            </p>
                            <span class="inline-block px-3 py-1 bg-emerald-100 text-emerald-800 rounded-full text-xs font-bold tracking-wide">#RW021Maju</span>
                        </div>
                        <div class="w-full md:w-2/3 grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="bg-purple-50/60 border border-purple-100 p-6 rounded-2xl hover:border-purple-300 transition-all">
                                <div class="w-12 h-12 bg-purple-600 text-white rounded-xl flex items-center justify-center mb-4 shadow-sm">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m-9 9a9 9 0 019-9"></path>
                                    </svg>
                                </div>
                                <h4 class="text-lg font-bold text-gray-900 mb-2">Digitalisasi Pelayanan</h4>
                                <p class="text-gray-600 text-sm leading-relaxed">
                                    Mewujudkan sistem administrasi kependudukan yang cepat, transparan, dan dapat diakses 24/7 melalui portal warga.
                                </p>
                            </div>
                            <div class="bg-purple-50/60 border border-purple-100 p-6 rounded-2xl hover:border-purple-300 transition-all">
                                <div class="w-12 h-12 bg-purple-600 text-white rounded-xl flex items-center justify-center mb-4 shadow-sm">
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

                    <!-- MISI CONTENT (TOGGLEABLE) -->
                    <div id="content-misi" class="hidden flex flex-col md:flex-row gap-8 items-start">
                        <div class="w-full md:w-1/3">
                            <h3 class="text-3xl font-extrabold text-gray-900 mb-2">Misi Kami</h3>
                            <p class="text-gray-600 font-medium text-sm leading-relaxed mb-4">
                                Program kerja konkret dan langkah operasional pengurus RW 021 untuk merealisasikan visi lingkungan.
                            </p>
                            <span class="inline-block px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-bold tracking-wide">#AksiWarga021</span>
                        </div>
                        <div class="w-full md:w-2/3 grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="bg-emerald-50/60 border border-emerald-100 p-6 rounded-2xl hover:border-emerald-300 transition-all">
                                <div class="w-12 h-12 bg-emerald-600 text-white rounded-xl flex items-center justify-center mb-4 shadow-sm">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                </div>
                                <h4 class="text-lg font-bold text-gray-900 mb-2">Keamanan & Ketertiban 24 Jam</h4>
                                <p class="text-gray-600 text-sm leading-relaxed">
                                    Optimalisasi sistem jam malam portal, penambahan CCTV lingkungan, dan pos ronda aktif di tiap RT.
                                </p>
                            </div>
                            <div class="bg-emerald-50/60 border border-emerald-100 p-6 rounded-2xl hover:border-emerald-300 transition-all">
                                <div class="w-12 h-12 bg-emerald-600 text-white rounded-xl flex items-center justify-center mb-4 shadow-sm">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                    </svg>
                                </div>
                                <h4 class="text-lg font-bold text-gray-900 mb-2">Pengelolaan Sampah Terpadu</h4>
                                <p class="text-gray-600 text-sm leading-relaxed">
                                    Penguatan armada TPST, pemilahan sampah organik & anorganik, serta aktivasi rutin Bank Sampah warga.
                                </p>
                            </div>
                            <div class="bg-emerald-50/60 border border-emerald-100 p-6 rounded-2xl hover:border-emerald-300 transition-all">
                                <div class="w-12 h-12 bg-emerald-600 text-white rounded-xl flex items-center justify-center mb-4 shadow-sm">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.684a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </div>
                                <h4 class="text-lg font-bold text-gray-900 mb-2">Posyandu & Kesehatan</h4>
                                <p class="text-gray-600 text-sm leading-relaxed">
                                    Pemeriksaan berkala Balita, Lansia, serta senam kebugaran di Aula Posyandu Bunga Tanjung.
                                </p>
                            </div>
                            <div class="bg-emerald-50/60 border border-emerald-100 p-6 rounded-2xl hover:border-emerald-300 transition-all">
                                <div class="w-12 h-12 bg-emerald-600 text-white rounded-xl flex items-center justify-center mb-4 shadow-sm">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                                <h4 class="text-lg font-bold text-gray-900 mb-2">Musyawarah & Karang Taruna</h4>
                                <p class="text-gray-600 text-sm leading-relaxed">
                                    Penyelenggaraan rapat terbuka warga secara akuntabel dan fasilitasi sarana olahraga Karang Taruna.
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

    <!-- MODAL POPUP INSTAGRAM STYLE -->
    <div id="postModal" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4 transition-all duration-300">
        <div class="bg-white rounded-2xl overflow-hidden max-w-4xl w-full max-h-[90vh] flex flex-col md:flex-row shadow-2xl relative animate-in">
            <button onclick="closeModal()" class="absolute top-3 right-3 z-20 w-9 h-9 bg-black/50 hover:bg-black/80 text-white rounded-full flex items-center justify-center md:bg-gray-100 md:text-gray-600 md:hover:bg-gray-200 transition">
                ✕
            </button>
            <div class="w-full md:w-3/5 bg-black flex items-center justify-center min-h-[250px] md:min-h-[500px]">
                <img id="modalImage" src="" alt="Detail Kegiatan" class="w-full h-full object-cover max-h-[60vh] md:max-h-[80vh]" />
            </div>
            <div class="w-full md:w-2/3 p-6 flex flex-col justify-between bg-white overflow-y-auto">
                <div>
                    <div class="flex items-center gap-3 border-b border-gray-100 pb-4 mb-4">
                        <div class="w-10 h-10 bg-purple-600 rounded-full flex items-center justify-center text-white font-bold text-xs">RW21</div>
                        <div>
                            <h4 class="font-bold text-gray-900 text-sm leading-tight">Pengurus RW 021</h4>
                            <p id="modalDate" class="text-xs text-gray-500 mt-0.5"></p>
                        </div>
                        <span class="ml-auto px-2.5 py-1 bg-emerald-100 text-emerald-800 text-[11px] font-bold rounded-full">Kegiatan</span>
                    </div>
                    <h3 id="modalTitle" class="text-2xl font-extrabold text-gray-900 mb-3"></h3>
                    <p id="modalDescription" class="text-gray-600 text-sm leading-relaxed whitespace-pre-line mb-6"></p>
                </div>
                <div class="border-t border-gray-100 pt-4 mt-auto">
                    <div class="flex items-center justify-between text-gray-500 text-xs">
                        <span class="flex items-center gap-1 text-emerald-600 font-semibold">
                            ✓ Terbuka Untuk Warga
                        </span>
                        <button onclick="closeModal()" class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-lg text-xs transition">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL OVERLAY DETAIL JADWAL KEGIATAN RUTIN -->
    <div id="jadwal-modal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-2xl rounded-2xl shadow-2xl overflow-hidden animate-in max-h-[90vh] flex flex-col">
            <div id="jmodal-header-bg" class="px-6 py-5 bg-purple-700 text-white flex justify-between items-center">
                <div>
                    <span id="jmodal-category" class="text-[10px] font-bold tracking-wider uppercase opacity-80">Jadwal Kegiatan Rutin</span>
                    <h3 id="jmodal-title" class="text-xl font-bold leading-tight">Detail Kegiatan</h3>
                </div>
                <button type="button" onclick="closeJadwalModal()" class="text-white/80 hover:text-white text-2xl font-bold p-1">&times;</button>
            </div>

            <div class="p-6 space-y-6 overflow-y-auto flex-1 text-sm text-gray-700">
                <div>
                    <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Penjelasan Detail Kegiatan</h4>
                    <p id="jmodal-description" class="leading-relaxed text-gray-800 font-medium"></p>
                </div>

                <div id="jmodal-subitems-container" class="bg-purple-50/50 p-4 rounded-xl border border-purple-100">
                    <h4 class="text-xs font-bold text-purple-900 uppercase tracking-wider mb-2">Rincian Acara & Sesi Latihan</h4>
                    <ul id="jmodal-subitems" class="space-y-2 text-xs font-semibold text-purple-950"></ul>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-4 bg-gray-50 rounded-xl border border-gray-200">
                        <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Persyaratan / Ketentuan</h4>
                        <ul id="jmodal-requirements" class="text-xs text-gray-700 space-y-1.5 font-medium"></ul>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-xl border border-gray-200">
                        <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Jam & Lokasi Presisi</h4>
                        <p id="jmodal-schedule" class="text-xs text-gray-700 font-semibold leading-relaxed"></p>
                    </div>
                </div>

                <div class="p-4 bg-emerald-50 rounded-xl border border-emerald-200 flex justify-between items-center">
                    <div>
                        <span class="text-[10px] font-bold uppercase text-emerald-800">Koordinator / Penanggung Jawab</span>
                        <p id="jmodal-coordinator" class="font-bold text-emerald-950 text-sm"></p>
                    </div>
                    <a id="jmodal-wa-btn" href="#" target="_blank" rel="noopener noreferrer" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold rounded-[10px] transition shadow-sm flex items-center gap-1">
                        Chat WA
                    </a>
                </div>
            </div>

            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end">
                <button type="button" onclick="closeJadwalModal()" class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold text-xs rounded-[10px] transition">Tutup Detail</button>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT UNTUK MODAL & TAB TOGGLE -->
    <script>
        function toggleVisiMisi(tab) {
            const visiBtn = document.getElementById('tab-visi-btn');
            const misiBtn = document.getElementById('tab-misi-btn');
            const visiContent = document.getElementById('content-visi');
            const misiContent = document.getElementById('content-misi');

            if (tab === 'visi') {
                visiBtn.className = 'px-6 py-3 font-bold text-sm rounded-t-xl transition-all shadow-sm bg-purple-600 text-white border-t border-x border-purple-600';
                misiBtn.className = 'px-6 py-3 font-bold text-sm rounded-t-xl transition-all shadow-sm bg-gray-100 text-gray-600 hover:bg-gray-200 border-t border-x border-gray-200';
                visiContent.classList.remove('hidden');
                misiContent.classList.add('hidden');
            } else {
                misiBtn.className = 'px-6 py-3 font-bold text-sm rounded-t-xl transition-all shadow-sm bg-purple-600 text-white border-t border-x border-purple-600';
                visiBtn.className = 'px-6 py-3 font-bold text-sm rounded-t-xl transition-all shadow-sm bg-gray-100 text-gray-600 hover:bg-gray-200 border-t border-x border-gray-200';
                misiContent.classList.remove('hidden');
                visiContent.classList.add('hidden');
            }
        }

        const jadwalData = {
            'surat-pengantar': {
                category: 'Pelayanan & Administrasi',
                title: 'Pelayanan Surat Pengantar RW 021',
                headerBg: 'bg-purple-700',
                description: 'Layanan penerbitan surat pengantar resmi dari Pengurus RW 021 Bojong Nangka untuk pengurusan KTP-el, KK, Surat Pindah, SKTM Beasiswa/BPJS, Pengantar Nikah, dan Surat Kematian.',
                subitems: [
                    'Pembuatan & Perpanjangan KTP-el Baru / Rusak / Hilang',
                    'Pembuatan & Perubahan Kartu Keluarga (KK)',
                    'Surat Keterangan Pindah Masuk / Keluar Wilayah',
                    'Surat Keterangan Tidak Mampu (SKTM) Beasiswa & BPJS'
                ],
                requirements: [
                    'Fotokopi KTP & Kartu Keluarga (KK) Pemohon',
                    'Surat Pengantar Asli dari Ketua RT setempat',
                    'Pas foto 3x4 bila dibutuhkan'
                ],
                schedule: 'Rumah Ketua RT/RW / Balai Warga RW 021<br>Setiap Hari (Pukul 19.00 - 21.00 WIB)',
                coordinator: 'Galih Wirapati (Sekretaris RW - 087888872828)',
                wa: 'https://wa.me/6287888872828'
            },
            'senam': {
                category: 'Kesehatan & Olahraga Warga',
                title: 'Senam Jasmani & Prolanis',
                headerBg: 'bg-indigo-700',
                description: 'Kegiatan senam kebugaran jasmani rutin untuk seluruh warga, lansia, dan anggota Prolanis demi menjaga imunitas tubuh.',
                subitems: [
                    'Senam Sehat Jasmani (SSJ)',
                    'Senam Prolanis & Penimbangan Kesehatan'
                ],
                requirements: [
                    'Warga RW 021 (Bebas Semua Usia)',
                    'Mengenakan Pakaian Olahraga Rapi'
                ],
                schedule: 'Halaman / Aula RW 021 Dasana Indah<br>Setiap Rabu & Sabtu (Pukul 07.00 WIB)',
                coordinator: 'Hj. Rina Melati (Sekretaris RW)',
                wa: 'https://wa.me/6287888872828'
            },
            'posyandu': {
                category: 'Pelayanan Kesehatan Balita & Lansia',
                title: 'Posyandu ILP Bunga Tanjung',
                headerBg: 'bg-rose-700',
                description: 'Pelayanan kesehatan terintegrasi siklus hidup (ILP) untuk pemantauan tumbuh kembang Balita, imunisasi dasar, penimbangan, dan cek kesehatan Lansia.',
                subitems: [
                    'Penimbangan & Pengukuran Tinggi Badan Balita',
                    'Pemberian Makanan Tambahan (PMT) Bergizi',
                    'Pemeriksaan Tekanan Darah & Gula Darah Lansia'
                ],
                requirements: [
                    'Buku KIA / Kartu Posyandu Balita',
                    'KTP / Kartu Berobat Lansia'
                ],
                schedule: 'Gedung Posyandu Bunga Tanjung (Aula RW 021)<br>Minggu Ke-4 Setiap Bulan (Pukul 08.00 - 11.00 WIB)',
                coordinator: 'Kader Posyandu Bunga Tanjung',
                wa: 'https://wa.me/6281511322022'
            },
            'karate': {
                category: 'Olahraga & Seni Bela Diri',
                title: 'Latihan Karate Dojo RW 021',
                headerBg: 'bg-indigo-700',
                description: 'Latihan seni bela diri karate untuk anak-anak dan remaja warga RW 021 untuk melatih kedisiplinan, ketangkasan, dan pembentukan karakter positif.',
                subitems: [
                    'Latihan Kata & Kumite Dasar',
                    'Persiapan Ujian Kenaikan Sabuk & Kejuaraan'
                ],
                requirements: [
                    'Terbuka Untuk Anak-anak & Remaja RW 021',
                    'Seragam Karate (Gi)'
                ],
                schedule: 'Aula RW 021 Dasana Indah<br>Setiap Hari Minggu (Pukul 15.30 - 17.00 WIB)',
                coordinator: 'Syahdian Gusti A (Ketua RW - 082299007700)',
                wa: 'https://wa.me/6282299007700'
            },
            'soccer': {
                category: 'Olahraga Anak & Remaja',
                title: 'Soccer Passing & Dribbling',
                headerBg: 'bg-indigo-700',
                description: 'Pembinaan olahraga sepak bola dan futsal usia dini untuk melatih kontrol bola, akurasi umpan (passing), dan kelincahan (dribbling).',
                subitems: [
                    'Drill Latihan Passing, Dribbling, & Shooting',
                    'Futsal & Mini Soccer Antar RT'
                ],
                requirements: [
                    'Anak-anak & Remaja Usia Dini RW 021',
                    'Mengenakan Sepatu Olahraga / Futsal'
                ],
                schedule: 'Lapangan / Aula RW 021<br>Setiap Selasa & Kamis (Pukul 16.00 - 17.30 WIB)',
                coordinator: 'Amin Toat (Koordinator Soccer)',
                wa: 'https://wa.me/6281511322022'
            },
            'badminton': {
                category: 'Olahraga Warga',
                title: 'Jadwal Bulu Tangkis / Badminton',
                headerBg: 'bg-indigo-700',
                description: 'Kegiatan keolahragaan bulu tangkis interaktif antar klub persatuan bulu tangkis (PB) di wilayah RW 021 Dasana Indah.',
                subitems: [
                    'Senin (19.30 - 23.00) : PB DABO (Tarmizi)',
                    'Selasa (19.30 - 23.00) : PB SELSAB (Saepuri)',
                    'Rabu (19.30 - 23.00) : PB DABO (Tarmizi)',
                    'Kamis (19.30 - 23.00) : Bebas / Rutin Umum',
                    'Jum’at (19.30 - 23.00) : Karang Taruna RW 021',
                    'Sabtu (19.30 - 23.00) : PB SELSAB (Saepuri)',
                    'Minggu (06.00 - 12.00) : PB DASANA (Aidi Alisan)'
                ],
                requirements: [
                    'Warga RW 021 & Anggota PB',
                    'Wajib mematuhi tata tertib aula & waktu max pkl 23.00 WIB'
                ],
                schedule: 'Aula RW 021 Dasana Indah<br>Sesuai Pembagian Jadwal Hari PB di Atas',
                coordinator: 'Tarmizi / Saepuri / Aidi Alisan',
                wa: 'https://wa.me/6281511322022'
            },
            'tpst-jadwal': {
                category: 'Kebersihan Lingkungan (TPST)',
                title: 'Jadwal Pengangkatan Sampah Lingkungan',
                headerBg: 'bg-emerald-700',
                description: 'Pengaturan armada kebersihan TPST RW 021 untuk pengangkutan sampah rumah tangga basah (organik) dan sampah kering (anorganik).',
                subitems: [
                    'Sampah Organik / Dapur: Diangkut Setiap Hari (Pukul 06.00 - 09.00 WIB)',
                    'Sampah Anorganik & Kering: Diangkut Setiap Senin & Kamis'
                ],
                requirements: [
                    'Membuang sampah dalam wadah tertutup / kantong terikat rapi',
                    'Dilarang membuang puing bangunan & limbah B3 di bak sampah umum'
                ],
                schedule: 'Seluruh Jalur Perumahan RT 01 - RT 10 RW 021',
                coordinator: 'Sudarno (Bendahara RW - 081380126762)',
                wa: 'https://wa.me/6281380126762'
            },
            'ronda': {
                category: 'Keamanan Lingkungan',
                title: 'Jadwal Ronda Malam Siskamling RW 021',
                headerBg: 'bg-amber-700',
                description: 'Patroli keamanan siskamling malam warga RW 021 Dasana Indah untuk menjaga ketertiban, pencegahan tindak kejahatan, serta pengawasan portal perumahan.',
                subitems: [
                    'Grup 1 (Senin & Kamis): Petugas RT 01 - RT 03',
                    'Grup 2 (Selasa & Jumat): Petugas RT 04 - RT 06',
                    'Grup 3 (Rabu & Sabtu): Petugas RT 07 - RT 10'
                ],
                requirements: [
                    'Petugas ronda wajib hadir pkl 22.00 - 04.00 WIB di Pos Ronda Utama',
                    'Membawa senter, mantel hujan, dan tongkat ronda',
                    'Jika berhalangan wajib koordinasi dengan Ketua RT setempat'
                ],
                schedule: 'Pos Siskamling Utama RW 021<br>Setiap Malam (Pukul 22.00 - 04.00 WIB)',
                coordinator: 'Khusairi (Humas & Keamanan RW - 081511322022)',
                wa: 'https://wa.me/6281511322022'
            }
        };

        function openJadwalModal(key) {
            const data = jadwalData[key];
            if (!data) return;

            document.getElementById('jmodal-category').innerText = data.category;
            document.getElementById('jmodal-title').innerText = data.title;
            document.getElementById('jmodal-header-bg').className = `px-6 py-5 ${data.headerBg} text-white flex justify-between items-center`;
            document.getElementById('jmodal-description').innerText = data.description;

            const subitemsContainer = document.getElementById('jmodal-subitems');
            subitemsContainer.innerHTML = '';
            data.subitems.forEach(item => {
                const li = document.createElement('li');
                li.innerText = item;
                subitemsContainer.appendChild(li);
            });

            const reqContainer = document.getElementById('jmodal-requirements');
            reqContainer.innerHTML = '';
            data.requirements.forEach(req => {
                const li = document.createElement('li');
                li.innerHTML = `• ${req}`;
                reqContainer.appendChild(li);
            });

            document.getElementById('jmodal-schedule').innerHTML = data.schedule;
            document.getElementById('jmodal-coordinator').innerText = data.coordinator;
            document.getElementById('jmodal-wa-btn').href = data.wa;

            document.getElementById('jadwal-modal').classList.remove('hidden');
        }

        function closeJadwalModal() {
            document.getElementById('jadwal-modal').classList.add('hidden');
        }

        document.getElementById('jadwal-modal').addEventListener('click', function(e) {
            if (e.target === this) closeJadwalModal();
        });

        function openModal(imageSrc, title, date, description) {
            document.getElementById("modalImage").src = imageSrc;
            document.getElementById("modalTitle").innerText = title;
            document.getElementById("modalDate").innerText = date;
            document.getElementById("modalDescription").innerText = description;
            const modal = document.getElementById("postModal");
            modal.classList.remove("hidden");
            document.body.style.overflow = "hidden";
        }

        function closeModal() {
            const modal = document.getElementById("postModal");
            modal.classList.add("hidden");
            document.body.style.overflow = "auto";
        }

        document.getElementById("postModal").addEventListener("click", function(e) {
            if (e.target === this) closeModal();
        });

        document.addEventListener("keydown", function(e) {
            if (e.key === "Escape") {
                closeModal();
                closeJadwalModal();
            }
        });
    </script>
</body>

</html>
