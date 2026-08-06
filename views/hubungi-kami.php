<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hubungi Kami - Sistem Informasi RW 21</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <style>
        body {
            font-family: "Plus Jakarta Sans", sans-serif;
        }

        .logo-container {
            border-radius: 0 0 24px 24px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
            border: 1px solid #e9d5ff;
            border-top-width: 0;
        }
    </style>
</head>

<body class="bg-gray-50 flex flex-col min-h-screen">
    <!-- NAVBAR -->
    <nav class="bg-white border-b border-purple-100 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-24">
                <!-- Logo Area -->
                <div
                    class="flex-shrink-0 h-32 w-32 bg-white logo-container flex flex-col items-center justify-center p-2 z-10">
                    <div
                        class="w-16 h-16 bg-purple-600 rounded-full flex items-center justify-center text-white font-bold text-xl mb-1 shadow-md">
                        RW 21
                    </div>
                    <span
                        class="text-[10px] text-center font-semibold text-gray-600 leading-tight">SISTEM<br />INFORMASI</span>
                </div>

                <!-- Text Info Kiri -->
                <div class="hidden md:flex flex-col ml-6 text-sm font-medium">
                    <span class="text-purple-700">#Kompak Bersama</span>
                    <span class="text-emerald-600 font-semibold">#Lingkungan Asri & Aman</span>
                    <span class="text-purple-500">Pelayanan Digital 2026</span>
                </div>

                <!-- Menu Navigasi -->
                <div class="hidden md:flex flex-1 justify-end items-center space-x-6 text-gray-600 font-medium text-sm">
                    <a href="index.html" class="hover:text-purple-600 transition">Beranda</a>
                    <a href="tentang-kami.html" class="hover:text-purple-600 transition">Tentang Kami</a>
                    <a href="#" class="hover:text-purple-600 transition">Layanan</a>
                    <a href="notulensi.html" class="hover:text-purple-600 transition">Informasi</a>
                    <a href="galeri.html" class="hover:text-purple-600 transition">Galeri</a>
                    <!-- Tombol Hubungi Kami di-set Active (Ganti warna) -->
                    <a href="hubungi-kami.html"
                        class="bg-emerald-600 text-white px-5 py-2.5 rounded-full font-bold flex items-center gap-1 shadow-md hover:bg-emerald-700 transition">
                        Hubungi Kami
                        <svg class="w-4 h-4 text-white ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- PAGE HEADER -->
    <div class="bg-purple-50 py-16 border-b border-purple-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 tracking-tight mb-4">
                Sapa <span class="text-purple-600">Pengurus RW</span>
            </h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Butuh bantuan administrasi atau ingin berkunjung ke balai warga?
                Silakan hubungi kami melalui kontak di bawah ini.
            </p>
        </div>
    </div>

    <!-- MAIN CONTENT - CONTACT SECTION -->
    <div class="py-16 bg-white flex-1">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8 lg:gap-12">
                <!-- Kiri: Info Kontak -->
                <div class="w-full lg:w-5/12 flex flex-col gap-6">
                    <div>
                        <h2 class="text-2xl font-extrabold text-gray-900 mb-2">
                            Informasi Kontak
                        </h2>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Hubungi layanan interaktif kami untuk respon yang lebih cepat,
                            atau kunjungi langsung sekretariat RW pada alamat yang tertera.
                        </p>
                    </div>

                    <!-- Card Alamat -->
                    <div
                        class="flex items-start gap-4 p-6 bg-white rounded-2xl border border-gray-200 shadow-sm hover:border-purple-300 hover:shadow-md transition-all">
                        <div
                            class="w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-gray-900 mb-2">
                                Sekretariat RW 21
                            </h4>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                Balai Warga RW 21, Jl. Padjajaran Raya No. 45<br />
                                Pamulang, Kota Tangerang Selatan<br />
                                Banten 15417
                            </p>
                        </div>
                    </div>

                    <!-- Card WhatsApp -->
                    <div
                        class="flex items-start gap-4 p-6 bg-white rounded-2xl border border-gray-200 shadow-sm hover:border-emerald-300 hover:shadow-md transition-all">
                        <div
                            class="w-14 h-14 bg-emerald-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-gray-900 mb-2">
                                WhatsApp Center
                            </h4>
                            <p class="text-sm text-gray-600 leading-relaxed mb-3">
                                Layanan *chat* interaktif warga untuk keperluan darurat dan
                                administrasi.
                            </p>
                            <a href="#"
                                class="inline-flex items-center justify-center px-5 py-2.5 bg-emerald-50 text-emerald-700 font-bold text-sm rounded-lg hover:bg-emerald-100 transition">
                                Hubungi Sekarang &rarr;
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Kanan: Peta Lokasi (Embed Google Maps) -->
                <div class="w-full lg:w-7/12 flex flex-col">
                    <div class="flex items-center gap-3 mb-6">
                        <h2 class="text-2xl font-extrabold text-gray-900">Peta Lokasi</h2>
                        <div class="h-px bg-gray-200 flex-1"></div>
                    </div>
                    <!-- Maps Container -->
                    <div
                        class="w-full min-h-[400px] lg:h-full bg-gray-100 rounded-2xl overflow-hidden shadow-inner border border-gray-200">
                        <!-- Ganti src iframe di bawah ini dengan link embed Google Maps asli lokasi Balai Warga RW 21 -->
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126907.0863952132!2d106.66649712399233!3d-6.284201386706915!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69faca0f1c60d3%3A0xc3b59379fb811fec!2sPamulang%2C%20South%20Tangerang%20City%2C%20Banten!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid"
                            width="100%" height="100%" style="border: 0; min-height: 400px" allowfullscreen=""
                            loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER SIMPLE -->
    <footer class="bg-gray-900 py-8 border-t border-gray-800 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-gray-400 text-sm">
                &copy; 2026 Sistem Informasi RW 21. Seluruh Hak Cipta Dilindungi.
            </p>
        </div>
    </footer>
</body>

</html>
