<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Notulensi - Ruang Warga 021</title>
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

        /* Styling spesifik untuk isi artikel/notulensi */
        .prose h3 {
            color: var(--color-text-main);
            font-weight: 700;
            font-size: 1.25rem;
            margin-top: 2rem;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .prose p {
            margin-bottom: 1rem;
            line-height: 1.75;
        }

        .prose ul {
            list-style-type: disc;
            padding-left: 1.25rem;
            margin-bottom: 1rem;
            line-height: 1.75;
        }

        .prose li {
            margin-bottom: 0.5rem;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- NAVBAR -->
    <?php require base_path('views/partials/navbar.php'); ?>

    <!-- MAIN CONTENT -->
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Tombol Kembali -->
            <a href="/notulensi"
                class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-purple-600 transition mb-6 group">
                <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Arsip Notulensi
            </a>

            <!-- Document Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <!-- Card Header -->
                <div class="border-b border-gray-100 p-6 md:p-10 pb-6 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-purple-500 to-emerald-400"></div>

                    <div class="flex items-center gap-2 mb-4">
                        <span
                            class="bg-emerald-50 text-emerald-600 text-xs font-bold px-2.5 py-1 rounded uppercase tracking-wider">Rapat
                            Rutin</span>
                        <span class="text-sm text-gray-400 font-medium">No: 014/RW21/VIII/2026</span>
                    </div>

                    <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 leading-tight mb-6">
                        Rapat Persiapan HUT RI ke-81
                    </h1>

                    <!-- Info Grid -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 bg-gray-50 p-4 rounded-xl border border-gray-100">
                        <div>
                            <span class="block text-[10px] uppercase font-bold text-gray-400 mb-1">Tanggal</span>
                            <span class="text-sm font-semibold text-gray-800">12 Agt 2026</span>
                        </div>
                        <div>
                            <span class="block text-[10px] uppercase font-bold text-gray-400 mb-1">Waktu</span>
                            <span class="text-sm font-semibold text-gray-800">20:00 - 22:30 WIB</span>
                        </div>
                        <div>
                            <span class="block text-[10px] uppercase font-bold text-gray-400 mb-1">Lokasi</span>
                            <span class="text-sm font-semibold text-gray-800">Balai Warga RW 021</span>
                        </div>
                        <div>
                            <span class="block text-[10px] uppercase font-bold text-gray-400 mb-1">Notulis</span>
                            <span class="text-sm font-semibold text-gray-800">Sekretaris RW</span>
                        </div>
                    </div>
                </div>

                <!-- Card Body (Isi Notulensi) -->
                <div class="p-6 md:p-10 pt-6 prose max-w-none text-gray-600">
                    <h3>
                        <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                        Agenda Rapat
                    </h3>
                    <p>
                        Rapat rutin bulanan kali ini difokuskan pada persiapan menyambut
                        Hari Kemerdekaan Republik Indonesia yang ke-81. Beberapa poin
                        agenda utama yang dibahas meliputi:
                    </p>
                    <ul>
                        <li>
                            Pembentukan struktur panitia penyelenggara HUT RI tingkat RW.
                        </li>
                        <li>
                            Penyusunan rincian rancangan anggaran biaya (RAB) kegiatan.
                        </li>
                        <li>
                            Pembahasan teknis pelaksanaan lomba antar RT dan gerak jalan
                            sehat.
                        </li>
                        <li>Penetapan besaran iuran partisipasi warga.</li>
                    </ul>

                    <h3>
                        <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z">
                            </path>
                        </svg>
                        Hasil Pembahasan
                    </h3>
                    <p>
                        Berdasarkan musyawarah mufakat yang dihadiri oleh Ketua RW,
                        jajaran pengurus RW, serta perwakilan Ketua RT 01 hingga RT 05,
                        diperoleh beberapa pembahasan sebagai berikut:
                    </p>
                    <ul>
                        <li>
                            <strong>Ketua Panitia:</strong> Disepakati Bapak Budi (RT 03)
                            akan menjadi Ketua Panitia HUT RI tahun ini, dibantu oleh Karang
                            Taruna sebagai seksi operasional lomba.
                        </li>
                        <li>
                            <strong>Jenis Lomba:</strong> Lomba anak-anak akan difokuskan
                            pada lomba tradisional (makan kerupuk, balap karung, tarik
                            tambang). Lomba dewasa meliputi turnamen voli antar RT dan tenis
                            meja.
                        </li>
                        <li>
                            <strong>Anggaran:</strong> Estimasi dana yang dibutuhkan adalah
                            Rp 8.500.000. Dana ini akan ditalangi sebagian dari kas RW
                            sebesar Rp 2.000.000, sisanya dari iuran warga dan proposal
                            donatur (UMKM sekitar).
                        </li>
                    </ul>

                    <h3>
                        <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Keputusan Akhir
                    </h3>
                    <p>
                        Rapat menyetujui poin-poin keputusan final yang mengikat untuk
                        dilaksanakan oleh seluruh warga RW 021:
                    </p>
                    <ul>
                        <li>
                            Iuran partisipasi kegiatan ditetapkan sebesar
                            <strong>Rp 50.000 per Kepala Keluarga (KK)</strong>. Penarikan
                            dikoordinir oleh RT masing-masing selambatnya tanggal 10 Agustus
                            2026.
                        </li>
                        <li>
                            Acara <strong>Jalan Sehat Warga</strong> akan dilaksanakan pada
                            hari Minggu, 16 Agustus 2026 pukul 06.00 WIB, dengan titik
                            kumpul di Lapangan Utama RW.
                        </li>
                        <li>
                            Puncak acara pembagian hadiah dan panggung gembira dilaksanakan
                            pada malam tirakatan, tanggal 17 Agustus 2026 pukul 19.30 WIB.
                        </li>
                    </ul>
                    <p>
                        Rapat ditutup pada pukul 22:30 WIB dengan doa bersama. Demikian
                        notulensi ini dibuat agar dapat menjadi acuan bersama.
                    </p>

                    <!-- Lampiran Document Info -->
                    <div
                        class="mt-12 bg-purple-50 border border-purple-100 rounded-xl p-5 flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="flex items-center gap-3 w-full">
                            <div
                                class="w-12 h-12 bg-white rounded-lg border border-purple-200 flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-rose-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 text-sm">
                                    Notulensi_Rapat_HUT_RI_12Agt.pdf
                                </h4>
                                <p class="text-xs text-gray-500">
                                    Dokumen Resmi Ditandatangani • 1.2 MB
                                </p>
                            </div>
                        </div>
                        <button
                            class="w-full sm:w-auto px-5 py-2.5 bg-white border border-gray-200 text-purple-700 font-bold text-sm rounded-lg shadow-sm hover:bg-gray-50 transition whitespace-nowrap flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            Unduh Dokumen
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <?php require base_path('views/partials/footer.php'); ?>
</body>

</html>
