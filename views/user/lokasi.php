<!doctype html>
<html lang="id">

<head>
    <title>Peta & Lokasi Sekretariat - Ruang Warga 021</title>
    <?php require base_path('views/partials/head.php'); ?>
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
                    Peta & Lokasi Sekretariat RW 021
                </h1>
                <p class="text-base md:text-lg text-purple-200 leading-relaxed">
                    Denah lokasi Balai Pertemuan RW 021 (Posyandu Bunga Tanjung) Perumahan Dasana Indah, Bojong Nangka.
                </p>
            </div>
        </div>
    </div>

    <!-- MAIN CONTENT - MAPS DEDICATED SECTION -->
    <div class="py-12 md:py-16 bg-white flex-1">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

            <!-- EMBEDDED GOOGLE MAPS -->
            <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-md">
                <div class="w-full h-[500px] rounded-lg overflow-hidden shadow-inner">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.1956554593455!2d106.594195!3d-6.2516586!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69fdda23895485%3A0xccc8a8aee72f4e42!2sAula%20RW%20021%20RT%2005%20(Posyandu%20Bunga%20Tanjung)%20Bojong%20Nangka!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

            <!-- Address Card & Info Box -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-6 bg-purple-50/60 rounded-lg border border-purple-100">
                    <div class="w-10 h-10 bg-purple-600 text-white rounded-lg flex items-center justify-center font-bold mb-3 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="font-extrabold text-gray-900 text-base mb-1">Alamat Resmi</h3>
                    <p class="text-xs text-gray-600 leading-relaxed font-medium">
                        Aula RW 021 (Posyandu Bunga Tanjung)<br />
                        Perumahan Dasana Indah, RT 05 / RW 021,<br />
                        Kel. Bojong Nangka, Kec. Kelapa Dua,<br />
                        Kab. Tangerang, Banten 15810
                    </p>
                </div>

                <div class="p-6 bg-purple-50/60 rounded-lg border border-purple-100">
                    <div class="w-10 h-10 bg-emerald-600 text-white rounded-lg flex items-center justify-center font-bold mb-3 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="font-extrabold text-gray-900 text-base mb-1">Jam Operasional</h3>
                    <p class="text-xs text-gray-600 leading-relaxed font-medium">
                        <strong>Senin – Sabtu:</strong> 19.00 – 21.00 WIB<br />
                        <strong>Posyandu:</strong> Minggu ke-4 (08.00 WIB)<br />
                        <strong>Kegiatan Olahraga:</strong> Sesuai Jadwal Balai
                    </p>
                </div>

                <div class="p-6 bg-purple-50/60 rounded-lg border border-purple-100 flex flex-col justify-between">
                    <div>
                        <div class="w-10 h-10 bg-indigo-600 text-white rounded-lg flex items-center justify-center font-bold mb-3 shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                        </div>
                        <h3 class="font-extrabold text-gray-900 text-base mb-1">Navigasi Google Maps</h3>
                        <p class="text-xs text-gray-600 leading-relaxed font-medium mb-3">Buka rute langsung melalui aplikasi Google Maps di smartphone Anda.</p>
                    </div>
                    <a href="https://maps.google.com/?q=Aula+RW+021+Bojong+Nangka" target="_blank" class="w-full py-2.5 bg-purple-700 hover:bg-purple-800 text-white text-xs font-bold rounded-lg transition text-center flex items-center justify-center gap-1.5 shadow-sm">
                        <span>Buka di Google Maps</span>
                        <span>&rarr;</span>
                    </a>
                </div>
            </div>

        </div>
    </div>

    <!-- FOOTER -->
    <?php require base_path('views/partials/footer.php'); ?>
</body>

</html>