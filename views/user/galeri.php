<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Galeri Kegiatan - Sistem Informasi RW 21</title>
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
            background: #d1d5db;
            border-radius: 8px;
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
                Galeri <span class="text-purple-600">Kegiatan Warga</span>
            </h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Dokumentasi momen-momen kebersamaan, gotong royong, dan perayaan warga
                RW 21.
            </p>
        </div>
    </div>

    <!-- MAIN CONTENT - GALERI -->
    <div class="py-12 bg-gray-50 flex-1">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Filter Kategori -->
            <div class="flex flex-wrap justify-center gap-2 mb-10">
                <button
                    class="px-5 py-2 rounded-full bg-purple-600 text-white text-sm font-semibold shadow-md transition">
                    Semua
                </button>
                <button
                    class="px-5 py-2 rounded-full bg-white border border-gray-200 text-gray-600 text-sm font-medium hover:bg-gray-100 transition">
                    Sosial & Kebersihan
                </button>
                <button
                    class="px-5 py-2 rounded-full bg-white border border-gray-200 text-gray-600 text-sm font-medium hover:bg-gray-100 transition">
                    Perayaan
                </button>
                <button
                    class="px-5 py-2 rounded-full bg-white border border-gray-200 text-gray-600 text-sm font-medium hover:bg-gray-100 transition">
                    Kesehatan
                </button>
            </div>

            <!-- Grid Foto -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                <!-- Item 1 -->
                <div onclick="openModal('https://images.unsplash.com/photo-1528605248644-14dd04022da1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80', 'Kerja Bakti Membersihkan Saluran Air', '03 Agustus 2026', 'Kegiatan gotong royong membersihkan lingkungan, saluran air, dan fasilitas umum setiap hari Minggu di minggu pertama. Kegiatan ini diikuti oleh warga dari RT 01 hingga RT 05 untuk menjaga kebersihan dan mengantisipasi genangan air di musim hujan.')"
                    class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 cursor-pointer group border border-gray-100">
                    <div class="overflow-hidden relative h-56">
                        <img src="https://images.unsplash.com/photo-1528605248644-14dd04022da1?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                            alt="Kerja Bakti"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                        <div
                            class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center text-white font-medium text-sm gap-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                            </svg>
                            <span>Lihat Detail</span>
                        </div>
                        <span
                            class="absolute top-3 left-3 bg-emerald-500 text-white text-[10px] font-bold px-2 py-1 rounded">Sosial
                            & Kebersihan</span>
                    </div>
                    <div class="p-5">
                        <h3
                            class="text-lg font-bold text-gray-900 mb-1 group-hover:text-purple-600 transition-colors line-clamp-1">
                            Kerja Bakti Membersihkan Saluran Air
                        </h3>
                        <p class="text-xs text-gray-400 mb-3">03 Agustus 2026</p>
                    </div>
                </div>

                <!-- Item 2 -->
                <div onclick="openModal('https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80', 'Posyandu & Pemeriksaan Lansia', '27 Juli 2026', 'Pelayanan kesehatan gratis untuk balita, ibu hamil, dan pemeriksaan kesehatan rutin bagi warga lanjut usia setiap bulan. Bekerja sama dengan Puskesmas setempat untuk menyediakan penimbangan balita, vitamin, serta cek tensi dan gula darah.')"
                    class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 cursor-pointer group border border-gray-100">
                    <div class="overflow-hidden relative h-56">
                        <img src="https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                            alt="Posyandu"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                        <div
                            class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center text-white font-medium text-sm gap-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                            </svg>
                            <span>Lihat Detail</span>
                        </div>
                        <span
                            class="absolute top-3 left-3 bg-rose-500 text-white text-[10px] font-bold px-2 py-1 rounded">Kesehatan</span>
                    </div>
                    <div class="p-5">
                        <h3
                            class="text-lg font-bold text-gray-900 mb-1 group-hover:text-purple-600 transition-colors line-clamp-1">
                            Posyandu & Pemeriksaan Lansia
                        </h3>
                        <p class="text-xs text-gray-400 mb-3">27 Juli 2026</p>
                    </div>
                </div>

                <!-- Item 3 -->
                <div onclick="openModal('https://images.unsplash.com/photo-1531206715517-5c0ba140b2b8?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80', 'Bazar UMKM Makanan Tradisional', '15 Juli 2026', 'Mendukung perputaran ekonomi warga melalui bazar makanan dan kerajinan lokal pada setiap perayaan hari besar nasional. Diikuti lebih dari 20 pelaku UMKM lokal RW 21 untuk mempromosikan produk unggulan rumahan.')"
                    class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 cursor-pointer group border border-gray-100">
                    <div class="overflow-hidden relative h-56">
                        <img src="https://images.unsplash.com/photo-1531206715517-5c0ba140b2b8?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                            alt="UMKM"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                        <div
                            class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center text-white font-medium text-sm gap-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                            </svg>
                            <span>Lihat Detail</span>
                        </div>
                        <span
                            class="absolute top-3 left-3 bg-amber-500 text-white text-[10px] font-bold px-2 py-1 rounded">Perayaan</span>
                    </div>
                    <div class="p-5">
                        <h3
                            class="text-lg font-bold text-gray-900 mb-1 group-hover:text-purple-600 transition-colors line-clamp-1">
                            Bazar UMKM Makanan Tradisional
                        </h3>
                        <p class="text-xs text-gray-400 mb-3">15 Juli 2026</p>
                    </div>
                </div>

                <!-- Item 4 -->
                <div onclick="openModal('https://images.unsplash.com/photo-1517457373958-b7bdd4587205?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80', 'Rapat Koordinasi Pengurus RW & RT', '05 Juli 2026', 'Pertemuan rutin bulanan antara pengurus RW dan seluruh perwakilan RT untuk membahas program kerja bulan berikutnya, evaluasi kas, dan menampung aspirasi warga.')"
                    class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 cursor-pointer group border border-gray-100">
                    <div class="overflow-hidden relative h-56">
                        <img src="https://images.unsplash.com/photo-1517457373958-b7bdd4587205?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                            alt="Rapat"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                        <div
                            class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center text-white font-medium text-sm gap-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                            </svg>
                            <span>Lihat Detail</span>
                        </div>
                        <span
                            class="absolute top-3 left-3 bg-purple-500 text-white text-[10px] font-bold px-2 py-1 rounded">Pertemuan</span>
                    </div>
                    <div class="p-5">
                        <h3
                            class="text-lg font-bold text-gray-900 mb-1 group-hover:text-purple-600 transition-colors line-clamp-1">
                            Rapat Koordinasi Pengurus RW & RT
                        </h3>
                        <p class="text-xs text-gray-400 mb-3">05 Juli 2026</p>
                    </div>
                </div>

                <!-- Item 5 -->
                <div onclick="openModal('https://images.unsplash.com/photo-1542838132-92c53300491e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80', 'Pembagian Sembako Bantuan', '20 Juni 2026', 'Penyaluran bantuan sembako kepada warga yang membutuhkan di sekitar lingkungan RW 21, terselenggara berkat donasi rutin kas warga dan sumbangan sukarela.')"
                    class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 cursor-pointer group border border-gray-100">
                    <div class="overflow-hidden relative h-56">
                        <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                            alt="Bantuan"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                        <div
                            class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center text-white font-medium text-sm gap-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                            </svg>
                            <span>Lihat Detail</span>
                        </div>
                        <span
                            class="absolute top-3 left-3 bg-emerald-500 text-white text-[10px] font-bold px-2 py-1 rounded">Sosial
                            & Kebersihan</span>
                    </div>
                    <div class="p-5">
                        <h3
                            class="text-lg font-bold text-gray-900 mb-1 group-hover:text-purple-600 transition-colors line-clamp-1">
                            Pembagian Sembako Bantuan
                        </h3>
                        <p class="text-xs text-gray-400 mb-3">20 Juni 2026</p>
                    </div>
                </div>

                <!-- Item 6 -->
                <div onclick="openModal('https://images.unsplash.com/photo-1551632811-561732d1e306?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80', 'Senam Pagi Akhir Pekan', '14 Juni 2026', 'Kegiatan senam sehat bersama setiap Sabtu pagi di lapangan utama RW 21 untuk menjaga kebugaran dan mempererat tali silaturahmi antarwarga.')"
                    class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 cursor-pointer group border border-gray-100">
                    <div class="overflow-hidden relative h-56">
                        <img src="https://images.unsplash.com/photo-1551632811-561732d1e306?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                            alt="Senam"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                        <div
                            class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center text-white font-medium text-sm gap-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                            </svg>
                            <span>Lihat Detail</span>
                        </div>
                        <span
                            class="absolute top-3 left-3 bg-rose-500 text-white text-[10px] font-bold px-2 py-1 rounded">Kesehatan</span>
                    </div>
                    <div class="p-5">
                        <h3
                            class="text-lg font-bold text-gray-900 mb-1 group-hover:text-purple-600 transition-colors line-clamp-1">
                            Senam Pagi Akhir Pekan
                        </h3>
                        <p class="text-xs text-gray-400 mb-3">14 Juni 2026</p>
                    </div>
                </div>
            </div>

            <!-- Load More Button -->
            <div class="text-center mt-12">
                <button
                    class="px-6 py-3 border border-purple-200 text-purple-700 font-bold rounded-full hover:bg-purple-50 transition w-full md:w-auto shadow-sm">
                    Muat Lebih Banyak
                </button>
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
                            Dokumentasi Terbuka
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

    <!-- JAVASCRIPT UNTUK MODAL -->
    <script>
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

        document
            .getElementById("postModal")
            .addEventListener("click", function (e) {
                if (e.target === this) closeModal();
            });

        document.addEventListener("keydown", function (e) {
            if (e.key === "Escape") closeModal();
        });
    </script>
</body>

</html>
