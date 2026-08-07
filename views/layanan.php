<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Layanan Warga - Ruang Warga 021</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <style>body { font-family: "Plus Jakarta Sans", sans-serif; }</style>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">

    <?php require base_path('views/partials/navbar.php'); ?>

    <!-- HEADER -->
    <div class="bg-purple-50 py-12 border-b border-purple-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-block px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-xs font-bold tracking-wide uppercase mb-3">Layanan Digital</span>
            <h1 class="text-4xl font-extrabold text-gray-900 mb-2">Portal <span class="text-purple-600">Layanan Warga</span></h1>
            <p class="text-gray-600 max-w-2xl mx-auto">Kemudahan layanan administrasi kependudukan dan pengelolaan kebersihan lingkungan RW 021.</p>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="py-12 flex-1">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">

            <!-- SECTION 1: Administrasi Kependudukan -->
            <div id="administrasi" class="scroll-mt-28 bg-white p-8 md:p-10 rounded-2xl shadow-sm border border-purple-100">
                <div class="flex items-center gap-4 mb-6 border-b border-gray-100 pb-4">
                    <div class="w-12 h-12 bg-purple-100 text-purple-700 rounded-xl flex items-center justify-center font-bold text-xl">📄</div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">1. Administrasi Kependudukan</h2>
                        <p class="text-sm text-gray-500">Layanan pengurusan surat pengantar, pendataan warga baru, dan permohonan dokumen RW 021.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="p-5 bg-purple-50/50 rounded-xl border border-purple-100">
                        <h3 class="font-bold text-gray-900 mb-2">Surat Pengantar RW</h3>
                        <p class="text-xs text-gray-600 mb-4">Persyaratan pembuatan KTP, KK, Surat Pindah, dan Keterangan Kurang Mampu.</p>
                        <span class="text-xs font-bold text-purple-700">Syarat: Fotokopi KTP/KK & Pengantar RT</span>
                    </div>
                    <div class="p-5 bg-purple-50/50 rounded-xl border border-purple-100">
                        <h3 class="font-bold text-gray-900 mb-2">Pendaftaran Warga Baru</h3>
                        <p class="text-xs text-gray-600 mb-4">Pendataan bagi penghuni baru (Tetap, Kontrak, atau Kos) di wilayah RW 021.</p>
                        <span class="text-xs font-bold text-purple-700">Syarat: Mengisi Form Data Warga RT/RW</span>
                    </div>
                    <div class="p-5 bg-purple-50/50 rounded-xl border border-purple-100">
                        <h3 class="font-bold text-gray-900 mb-2">Legalisasi Dokumen</h3>
                        <p class="text-xs text-gray-600 mb-4">Pengesahan dan stempel basah Ketua RW 021 untuk permohonan dinas/umum.</p>
                        <span class="text-xs font-bold text-purple-700">Jam Layanan: 19.00 - 21.00 WIB</span>
                    </div>
                </div>

                <div class="flex justify-end">
                    <a href="/contact" class="px-6 py-2.5 bg-purple-600 hover:bg-purple-700 text-white font-bold text-sm rounded-[10px] transition shadow-md">
                        Hubungi Sekretariat RW ↗
                    </a>
                </div>
            </div>

            <!-- SECTION 2: Kebersihan Lingkungan (TPST) -->
            <div id="tpst" class="scroll-mt-28 bg-white p-8 md:p-10 rounded-2xl shadow-sm border border-emerald-100">
                <div class="flex items-center gap-4 mb-6 border-b border-gray-100 pb-4">
                    <div class="w-12 h-12 bg-emerald-100 text-emerald-700 rounded-xl flex items-center justify-center font-bold text-xl">🧹</div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">2. Kebersihan Lingkungan (TPST)</h2>
                        <p class="text-sm text-gray-500">Pengelolaan sampah terpadu, pemilahan organik/anorganik, dan jadwal petugas TPST RW 021.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="p-6 bg-emerald-50/50 rounded-xl border border-emerald-100">
                        <h3 class="font-bold text-gray-900 text-lg mb-2">🚛 Jadwal Pengangkatan Sampah</h3>
                        <ul class="text-xs text-gray-600 space-y-2">
                            <li class="flex items-center justify-between border-b border-emerald-100 pb-1">
                                <span>Sampah Anorganik & Kering</span>
                                <span class="font-bold text-emerald-800">Senin & Kamis</span>
                            </li>
                            <li class="flex items-center justify-between border-b border-emerald-100 pb-1">
                                <span>Sampah Organik & Rumah Tangga</span>
                                <span class="font-bold text-emerald-800">Setiap Hari (06.00 - 09.00)</span>
                            </li>
                        </ul>
                    </div>

                    <div class="p-6 bg-emerald-50/50 rounded-xl border border-emerald-100">
                        <h3 class="font-bold text-gray-900 text-lg mb-2">♻️ Program Bank Sampah RW 021</h3>
                        <p class="text-xs text-gray-600 mb-3">Warga dapat menyetorkan sampah daur ulang (botol plastik, kardus, kaleng) menjadi tabungan tunai.</p>
                        <span class="text-xs font-bold text-emerald-800">Jadwal Penimbangan: Minggu Ke-2 & Ke-4 (08.00 - 11.00 WIB)</span>
                    </div>
                </div>

                <div class="flex justify-end">
                    <a href="/contact" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm rounded-[10px] transition shadow-md">
                        Hubungi Tim TPST ↗
                    </a>
                </div>
            </div>

        </div>
    </div>

</body>
</html>
