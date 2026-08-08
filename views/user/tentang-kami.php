<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tentang Kami - Sistem Informasi RW 21</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="/css/theme.css" />
    <style>
        .logo-container {
            border-radius: 0 0 24px 24px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--color-border-light);
            border-top-width: 0;
        }

        /* Animasi untuk modal */
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

        /* Scrollbar halus untuk modal */
        #postModal .overflow-y-auto::-webkit-scrollbar {
            width: 4px;
        }

        #postModal .overflow-y-auto::-webkit-scrollbar-track {
            background: transparent;
        }

        #postModal .overflow-y-auto::-webkit-scrollbar-thumb {
            background: var(--color-scrollbar-thumb);
            border-radius: 8px;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- NAVBAR -->
    <?php require base_path('views/partials/navbar.php'); ?>

    <!-- PAGE HEADER -->
    <div class="bg-purple-50 py-16 border-b border-purple-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 tracking-tight mb-4">
                Mengenal Lebih Dekat <span class="text-purple-600">RW 21</span>
            </h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Ruang informasi tentang arah gerak, rutinitas, dan kekompakan warga
                dalam mewujudkan lingkungan yang asri dan aman.
            </p>
        </div>
    </div>

    <!-- VISI & MISI SECTION (Arah Gerak) -->
    <div class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-extrabold text-black tracking-tight sm:text-4xl">
                    Arah Gerak <span class="text-purple-600">RW 21</span>
                </h2>
                <p class="mt-4 max-w-2xl text-lg text-gray-500 mx-auto">
                    Bersama mewujudkan lingkungan yang aman, asri, dan adaptif terhadap
                    perkembangan teknologi digital.
                </p>
            </div>
            <div class="flex flex-wrap gap-1 md:gap-2">
                <button
                    class="px-6 py-3 bg-gradient-to-r from-purple-600 to-purple-500 text-white font-semibold rounded-t-xl md:rounded-t-2xl shadow-sm focus:outline-none transition-all">
                    Visi
                </button>
                <button
                    class="px-6 py-3 bg-purple-100 text-purple-700 font-medium rounded-t-xl md:rounded-t-2xl hover:bg-purple-200 focus:outline-none transition-all">
                    Misi Utama
                </button>
                <button
                    class="px-6 py-3 bg-purple-100 text-purple-700 font-medium rounded-t-xl md:rounded-t-2xl hover:bg-purple-200 focus:outline-none transition-all">
                    Program Kerja
                </button>
            </div>
            <div
                class="bg-gradient-to-br from-purple-600 via-purple-700 to-purple-900 rounded-b-2xl rounded-tr-2xl p-6 md:p-10 shadow-xl overflow-hidden relative">
                <div class="absolute inset-0 opacity-10" style="
              background-image: radial-gradient(
                circle at 2px 2px,
                white 1px,
                transparent 0
              );
              background-size: 24px 24px;
            "></div>
                <div class="relative z-10 flex flex-col md:flex-row gap-8 items-center">
                    <div class="w-full md:w-1/3">
                        <h3 class="text-4xl font-bold text-white mb-2">Visi Kami</h3>
                        <p class="text-purple-100 font-medium text-sm mb-4">
                            Tujuan utama yang ingin dicapai oleh kepengurusan RW 21 untuk
                            masa depan.
                        </p>
                        <span
                            class="inline-block px-3 py-1 bg-emerald-500 text-white rounded-full text-xs font-bold tracking-wide">#RW21Maju</span>
                    </div>
                    <div class="w-full md:w-2/3 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div
                            class="bg-white/10 backdrop-blur-md border border-white/20 p-6 rounded-xl hover:bg-white/20 transition-all">
                            <div
                                class="w-12 h-12 bg-emerald-400 rounded-lg flex items-center justify-center mb-4 shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9">
                                    </path>
                                </svg>
                            </div>
                            <h4 class="text-lg font-bold text-white mb-2">
                                Digitalisasi Pelayanan
                            </h4>
                            <p class="text-purple-100 text-sm leading-relaxed">
                                Mewujudkan sistem administrasi kependudukan yang cepat,
                                transparan, dan dapat diakses 24/7 melalui portal warga.
                            </p>
                        </div>
                        <div
                            class="bg-white/10 backdrop-blur-md border border-white/20 p-6 rounded-xl hover:bg-white/20 transition-all">
                            <div
                                class="w-12 h-12 bg-emerald-400 rounded-lg flex items-center justify-center mb-4 shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                    </path>
                                </svg>
                            </div>
                            <h4 class="text-lg font-bold text-white mb-2">
                                Lingkungan Inklusif
                            </h4>
                            <p class="text-purple-100 text-sm leading-relaxed">
                                Membangun komunitas warga yang saling peduli, guyub rukun, dan
                                menjunjung tinggi nilai toleransi antar tetangga.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JADWAL KEGIATAN RUTIN -->
    <div class="py-20 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <span
                    class="inline-flex items-center justify-center gap-1.5 px-3 py-1 bg-white text-gray-600 rounded-full text-xs font-bold tracking-wide uppercase mb-4 border border-gray-200 shadow-sm">
                    <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    Panduan Mingguan Warga
                </span>
                <h2 class="text-3xl font-extrabold text-black tracking-tight sm:text-4xl">
                    Jadwal <span class="text-purple-600">Kegiatan Rutin</span>
                </h2>
                <p class="mt-4 max-w-2xl text-lg text-gray-500 mx-auto">
                    Jadwal tetap pelayanan administrasi, keamanan, kebersihan, dan
                    aktivitas sosial warga RW 21.
                </p>
            </div>

            <!-- LEGENDA KATEGORI -->
            <div class="flex flex-wrap justify-center gap-4 mb-10">
                <div class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    <span class="text-sm font-medium text-gray-600">Administrasi</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                        </path>
                    </svg>
                    <span class="text-sm font-medium text-gray-600">Kebersihan</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                        </path>
                    </svg>
                    <span class="text-sm font-medium text-gray-600">Keamanan</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                        </path>
                    </svg>
                    <span class="text-sm font-medium text-gray-600">Sosial & Kesehatan</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                        </path>
                    </svg>
                    <span class="text-sm font-medium text-gray-600">Keagamaan</span>
                </div>
            </div>

            <!-- GRID 7 HARI (Clickable for Overlay Modal Detail) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-7 gap-4">
                <!-- Senin -->
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm flex flex-col overflow-hidden">
                    <div class="bg-gray-50 border-b border-gray-200 px-4 py-3 text-center">
                        <span class="text-xs font-bold text-gray-700 uppercase tracking-widest">Senin</span>
                    </div>
                    <div class="p-3 flex-1 flex flex-col gap-3">
                        <div onclick="openJadwalModal('surat-pengantar')" class="cursor-pointer border border-gray-100 rounded-lg p-3 hover:border-purple-300 hover:bg-purple-50/50 transition duration-150 group">
                            <div class="flex items-start gap-2 mb-2">
                                <span class="text-xs font-bold text-gray-900 group-hover:text-purple-700 leading-tight">Pelayanan & Administrasi</span>
                            </div>
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
                            <div class="flex items-start gap-2 mb-2">
                                <span class="text-xs font-bold text-gray-900 group-hover:text-indigo-700 leading-tight">Soccer Passing</span>
                            </div>
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
                            <div class="flex items-start gap-2 mb-2">
                                <span class="text-xs font-bold text-gray-900 group-hover:text-indigo-700 leading-tight">Senam Jasmani</span>
                            </div>
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
                            <div class="flex items-start gap-2 mb-2">
                                <span class="text-xs font-bold text-gray-900 group-hover:text-emerald-700 leading-tight">Angkut Sampah</span>
                            </div>
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
                            <div class="flex items-start gap-2 mb-2">
                                <span class="text-xs font-bold text-gray-900 group-hover:text-purple-700 leading-tight">PB Karang Taruna</span>
                            </div>
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
                            <div class="flex items-start gap-2 mb-2">
                                <span class="text-xs font-bold text-gray-900 group-hover:text-indigo-700 leading-tight">Senam Jasmani</span>
                            </div>
                            <p class="text-[10px] text-gray-500 mb-2 leading-relaxed">Senam Pagi (07.00 WIB)</p>
                            <span class="text-[10px] font-bold text-indigo-700 block">Lihat Detail &rarr;</span>
                        </div>
                        <div onclick="openJadwalModal('ronda')" class="cursor-pointer border border-gray-100 rounded-lg p-3 hover:border-amber-300 hover:bg-amber-50/50 transition duration-150 group">
                            <div class="flex items-start gap-2 mb-2">
                                <span class="text-xs font-bold text-gray-900 group-hover:text-amber-700 leading-tight">Ronda Malam Siskamling</span>
                            </div>
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
                            <div class="flex items-start gap-2 mb-2">
                                <span class="text-xs font-bold text-gray-900 group-hover:text-rose-700 leading-tight">Posyandu ILP</span>
                            </div>
                            <p class="text-[10px] text-gray-500 mb-2 leading-relaxed">Minggu Ke-4 (08.00 WIB)</p>
                            <span class="text-[10px] font-bold text-rose-700 block">Lihat Detail &rarr;</span>
                        </div>
                        <div onclick="openJadwalModal('karate')" class="cursor-pointer border border-gray-100 rounded-lg p-3 hover:border-indigo-300 hover:bg-indigo-50/50 transition duration-150 group">
                            <div class="flex items-start gap-2 mb-2">
                                <span class="text-xs font-bold text-gray-900 group-hover:text-indigo-700 leading-tight">Latihan Karate</span>
                            </div>
                            <p class="text-[10px] text-gray-500 mb-2 leading-relaxed">Sore (15.30 - 17.00 WIB)</p>
                            <span class="text-[10px] font-bold text-indigo-700 block">Lihat Detail &rarr;</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Catatan Kaki -->
            <div class="mt-10 bg-white rounded-xl border border-gray-200 p-5 max-w-3xl mx-auto shadow-sm">
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 bg-purple-50 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-gray-900 mb-1">
                            Catatan Penting
                        </h4>
                        <ul class="text-xs text-gray-500 space-y-1.5 list-disc list-inside">
                            <li>
                                Jadwal dapat berubah sewaktu-waktu. Pantau selalu pengumuman
                                di grup WhatsApp RW.
                            </li>
                            <li>
                                Untuk layanan administrasi di luar jam, silakan hubungi Ketua
                                RT masing-masing.
                            </li>
                            <li>
                                Ronda malam wajib diikuti sesuai jadwal. Jika berhalangan,
                                harap mencari pengganti.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- KEGIATAN UNGGULAN SECTION (Galeri) -->
    <div class="py-20 bg-purple-800 relative z-10 border-t border-purple-900/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-extrabold text-white tracking-tight sm:text-4xl">
                    Galeri <span class="text-emerald-400">Kegiatan</span> Warga
                </h2>
                <p class="mt-4 max-w-2xl text-lg text-purple-200 mx-auto">
                    Dokumentasi berbagai program dan aktivitas yang membangun kerukunan
                    serta kesejahteraan bersama.
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div onclick="openModal('https://images.unsplash.com/photo-1528605248644-14dd04022da1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80', 'Kerja Bakti Bulanan', '03 Agustus 2026', 'Kegiatan gotong royong membersihkan lingkungan, saluran air, dan fasilitas umum setiap hari Minggu di minggu pertama. Kegiatan ini diikuti oleh warga dari RT 01 hingga RT 05 untuk menjaga kebersihan dan mengantisipasi genangan air di musim hujan.')"
                    class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 cursor-pointer group">
                    <div class="overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1528605248644-14dd04022da1?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                            alt="Kerja Bakti"
                            class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-500" />
                        <div
                            class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center text-white font-medium text-sm gap-1">
                            <span>🔍 Klik untuk detail</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-purple-600 transition-colors">
                            Kerja Bakti Bulanan
                        </h3>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Kegiatan gotong royong membersihkan lingkungan, saluran air, dan
                            fasilitas umum.
                        </p>
                    </div>
                </div>
                <!-- Card 2 -->
                <div onclick="openModal('https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80', 'Posyandu & Lansia', '27 Juli 2026', 'Pelayanan kesehatan gratis untuk balita, ibu hamil, dan pemeriksaan kesehatan rutin bagi warga lanjut usia setiap bulan. Bekerja sama dengan Puskesmas setempat untuk menyediakan penimbangan balita, vitamin, serta cek tensi dan gula darah.')"
                    class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 cursor-pointer group">
                    <div class="overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                            alt="Posyandu"
                            class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-500" />
                        <div
                            class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center text-white font-medium text-sm gap-1">
                            <span>🔍 Klik untuk detail</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-purple-600 transition-colors">
                            Posyandu & Lansia
                        </h3>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Pelayanan kesehatan gratis untuk balita, ibu hamil, dan
                            pemeriksaan rutin lansia.
                        </p>
                    </div>
                </div>
                <!-- Card 3 -->
                <div onclick="openModal('https://images.unsplash.com/photo-1531206715517-5c0ba140b2b8?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80', 'Bazar UMKM Warga', '15 Juli 2026', 'Mendukung perputaran ekonomi warga melalui bazar makanan dan kerajinan lokal pada setiap perayaan hari besar nasional. Diikuti lebih dari 20 pelaku UMKM lokal RW 21 untuk mempromosikan produk unggulan rumahan.')"
                    class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 cursor-pointer group">
                    <div class="overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1531206715517-5c0ba140b2b8?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                            alt="UMKM"
                            class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-500" />
                        <div
                            class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center text-white font-medium text-sm gap-1">
                            <span>🔍 Klik untuk detail</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-purple-600 transition-colors">
                            Bazar UMKM Warga
                        </h3>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Mendukung perputaran ekonomi warga melalui bazar makanan dan
                            kerajinan lokal.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <?php require base_path('views/partials/footer.php'); ?>

    <!-- MODAL POPUP INSTAGRAM STYLE -->
    <div id="postModal"
        class="fixed inset-0 bg-black/80 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4 transition-all duration-300">
        <div
            class="bg-white rounded-2xl overflow-hidden max-w-4xl w-full max-h-[90vh] flex flex-col md:flex-row shadow-2xl relative animate-in">
            <button onclick="closeModal()"
                class="absolute top-3 right-3 z-20 w-9 h-9 bg-black/50 hover:bg-black/80 text-white rounded-full flex items-center justify-center md:bg-gray-100 md:text-gray-600 md:hover:bg-gray-200 transition">
                ✕
            </button>
            <div class="w-full md:w-3/5 bg-black flex items-center justify-center min-h-[250px] md:min-h-[500px]">
                <img id="modalImage" src="" alt="Detail Kegiatan"
                    class="w-full h-full object-cover max-h-[60vh] md:max-h-[80vh]" />
            </div>
            <div class="w-full md:w-2/3 p-6 flex flex-col justify-between bg-white overflow-y-auto">
                <div>
                    <div class="flex items-center gap-3 border-b border-gray-100 pb-4 mb-4">
                        <div
                            class="w-10 h-10 bg-purple-600 rounded-full flex items-center justify-center text-white font-bold text-xs">
                            RW21
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 text-sm leading-tight">
                                Pengurus RW 21
                            </h4>
                            <p id="modalDate" class="text-xs text-gray-500 mt-0.5"></p>
                        </div>
                        <span
                            class="ml-auto px-2.5 py-1 bg-emerald-100 text-emerald-800 text-[11px] font-bold rounded-full">Kegiatan</span>
                    </div>
                    <h3 id="modalTitle" class="text-2xl font-extrabold text-gray-900 mb-3"></h3>
                    <p id="modalDescription" class="text-gray-600 text-sm leading-relaxed whitespace-pre-line mb-6"></p>
                </div>
                <div class="border-t border-gray-100 pt-4 mt-auto">
                    <div class="flex items-center justify-between text-gray-500 text-xs">
                        <span class="flex items-center gap-1 text-emerald-600 font-semibold">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Terbuka Untuk Warga
                        </span>
                        <button onclick="closeModal()"
                            class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-lg text-xs transition">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL OVERLAY DETAIL JADWAL KEGIATAN RUTIN -->
    <div id="jadwal-modal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-2xl rounded-2xl shadow-2xl overflow-hidden animate-in fade-in zoom-in duration-200 max-h-[90vh] flex flex-col">
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

    <!-- JAVASCRIPT UNTUK MODAL -->
    <script>
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
                category: 'Kegiatan Rutin Olahraga',
                title: 'Senam Sehat Jasmani (SSJ) & Prolanis',
                headerBg: 'bg-indigo-700',
                description: 'Kegiatan senam kesegaran jasmani rutin warga RW 021 Dasana Indah untuk menjaga kesehatan fisik, kebugaran jantung, serta pemeriksaan tensi darah lansia.',
                subitems: [
                    'Senam Kesegaran Jasmani (SKJ) Warga',
                    'Senam Prolanis & Pemeriksaan Tensi Darah',
                    'Edukasi Pola Hidup Sehat & Ramah Lansia'
                ],
                requirements: [
                    'Terbuka untuk seluruh warga RW 021 (Lansia & Umum)',
                    'Mengenakan pakaian olahraga dan sepatu'
                ],
                schedule: 'Aula RW 021 Dasana Indah<br>Setiap Rabu & Sabtu (Pukul 07.00 - 09.00 WIB)',
                coordinator: 'Any Noviyani (Koordinator Senam)',
                wa: 'https://wa.me/6281511322022'
            },
            'posyandu': {
                category: 'Layanan Kesehatan Lingkungan',
                title: 'Posyandu ILP (Integrasi Layanan Primer)',
                headerBg: 'bg-indigo-700',
                description: 'Pelayanan kesehatan terpadu mencakup penimbangan balita, pemberian imunisasi, vitamin A, pencegahan stunting, serta cek kesehatan ibu hamil dan lansia.',
                subitems: [
                    'Penimbangan & Pengukuran Tinggi Badan Balita',
                    'Pemberian Imunisasi Rutin & Vitamin A',
                    'Pemeriksaan Kesehatan Lansia & Ibu Hamil'
                ],
                requirements: [
                    'Membawa Buku KIA (Kesehatan Ibu dan Anak)',
                    'Membawa Fotokopi KK / KTP Orang Tua'
                ],
                schedule: 'Aula RW 021 Dasana Indah<br>Setiap Minggu Ke-4 (Pukul 08.00 - 12.00 WIB)',
                coordinator: 'Emi Surahmi (Koordinator Posyandu)',
                wa: 'https://wa.me/6281511322022'
            },
            'karate': {
                category: 'Olahraga & Seni Bela Diri',
                title: 'Latihan Karate Anak & Remaja',
                headerBg: 'bg-indigo-700',
                description: 'Pelatihan seni bela diri karate bagi anak-anak dan remaja RW 021 untuk melatih ketahanan fisik, kedisiplinan, dan mental keolahragaan.',
                subitems: [
                    'Latihan Teknik Dasar Kata & Kumite',
                    'Persiapan Kejuaraan Pelajar & Daerah'
                ],
                requirements: [
                    'Usia 6 - 18 Tahun (Anak & Remaja RW 021)',
                    'Mengenakan Seragam Karate (Gi)'
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

        document.getElementById("postModal").addEventListener("click", function (e) {
            if (e.target === this) closeModal();
        });

        document.addEventListener("keydown", function (e) {
            if (e.key === "Escape") {
                closeModal();
                closeJadwalModal();
            }
        });
    </script>
</body>

</html>
