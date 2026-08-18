<!doctype html>
<html lang="id">

<head>
    <?php $title = "Galeri Kegiatan - Ruang Warga 021"; require base_path('views/partials/head.php'); ?>
    <style>
        .logo-container {
            border-radius: 0 0 24px 24px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--color-border-light);
            border-top-width: 0;
        }

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
            background: var(--color-scrollbar-thumb, #cbd5e1);
            border-radius: 8px;
        }
    </style>
</head>

<body class="bg-gray-50 flex flex-col min-h-screen">
    <!-- NAVBAR -->
    <?php require base_path('views/partials/navbar.php'); ?>

    <!-- MAIN CONTENT - GALERI -->
    <div class="py-12 bg-gray-50 flex-1">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <!-- SIMPLE PAGE HEADER -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-gray-200 pb-6">
                <div>
                    <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900">Galeri <span class="text-purple-600">Dokumentasi Kegiatan</span></h1>
                    <p class="text-xs md:text-sm text-gray-500 mt-1">Dokumentasi momen gotong royong, perayaan, dan kegiatan warga RW 021.</p>
                </div>
            </div>

            <!-- Filter Kategori Dinamis -->
            <?php
            $activeKategori = $_GET['kategori'] ?? '';
            $categories = [
                '' => 'Semua',
                'Sosial & Kebersihan' => 'Sosial & Kebersihan',
                'Perayaan' => 'Perayaan',
                'Kesehatan' => 'Kesehatan'
            ];
            ?>
            <div class="flex flex-wrap justify-center gap-2 mb-10">
                <?php foreach ($categories as $key => $label): ?>
                    <a href="/galeri<?= $key !== '' ? '?kategori=' . urlencode($key) : '' ?>"
                        class="px-5 py-2 rounded-full text-sm font-semibold transition <?= $activeKategori === $key ? 'bg-purple-600 text-white shadow-md' : 'bg-white border border-gray-200 text-gray-600 hover:bg-gray-100' ?>">
                        <?= $label ?>
                    </a>
                <?php endforeach; ?>
            </div>

            <!-- Grid Foto / Dynamic List -->
            <?php if (empty($galeriList)): ?>
                <!-- EMPTY STATE -->
                <div class="bg-white rounded-2xl border border-gray-200 p-12 text-center max-w-lg mx-auto shadow-sm my-8">
                    <div class="w-16 h-16 bg-purple-50 text-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-1">Belum Ada Foto Galeri</h3>
                    <p class="text-gray-500 text-sm mb-6">
                        <?= !empty($activeKategori) ? 'Tidak ditemukan foto untuk kategori "' . htmlspecialchars($activeKategori) . '".' : 'Dokumentasi foto kegiatan belum tersedia saat ini.' ?>
                    </p>
                    <?php if (!empty($activeKategori)): ?>
                        <a href="/galeri" class="inline-flex items-center px-4 py-2 bg-purple-600 text-white font-medium text-xs rounded-lg hover:bg-purple-700 transition">
                            Tampilkan Semua Foto
                        </a>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                    <?php foreach ($galeriList as $item): ?>
                        <?php
                        // Tentukan URL Foto (jika dari database atau Unsplash fallback)
                        $imgSrc = !empty($item->file_foto)
                            ? '/uploads/galeri/' . htmlspecialchars($item->file_foto)
                            : 'https://images.unsplash.com/photo-1528605248644-14dd04022da1?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';

                        $tglFormatted = !empty($item->tanggal) ? date('d F Y', strtotime($item->tanggal)) : '-';

                        // Badge color berdasarkan kategori
                        $badgeColor = 'bg-purple-500';
                        if (($item->kategori ?? '') === 'Sosial & Kebersihan') $badgeColor = 'bg-emerald-500';
                        elseif (($item->kategori ?? '') === 'Kesehatan') $badgeColor = 'bg-rose-500';
                        elseif (($item->kategori ?? '') === 'Perayaan') $badgeColor = 'bg-amber-500';
                        ?>

                        <div onclick="openModal('<?= $imgSrc ?>', '<?= htmlspecialchars(addslashes($item->judul ?? 'Kegiatan')) ?>', '<?= $tglFormatted ?>', '<?= htmlspecialchars(addslashes($item->deskripsi ?? '')) ?>')"
                            class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 cursor-pointer group border border-gray-100">
                            <div class="overflow-hidden relative h-56">
                                <img src="<?= $imgSrc ?>" alt="<?= htmlspecialchars($item->judul ?? 'Foto') ?>"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                    onerror="this.src='https://images.unsplash.com/photo-1528605248644-14dd04022da1?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'" />

                                <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center text-white font-medium text-sm gap-1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                                    </svg>
                                    <span>Lihat Detail</span>
                                </div>
                                <span class="absolute top-3 left-3 <?= $badgeColor ?> text-white text-[10px] font-bold px-2 py-1 rounded">
                                    <?= htmlspecialchars($item->kategori ?? 'Kegiatan') ?>
                                </span>
                            </div>
                            <div class="p-5">
                                <h3 class="text-lg font-bold text-gray-900 mb-1 group-hover:text-purple-600 transition-colors line-clamp-1">
                                    <?= htmlspecialchars($item->judul ?? '-') ?>
                                </h3>
                                <p class="text-xs text-gray-400 mb-3"><?= $tglFormatted ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- FOOTER -->
    <?php require base_path('views/partials/footer.php'); ?>

    <!-- MODAL POPUP INSTAGRAM STYLE -->
    <div id="postModal" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4 transition-all duration-300">
        <div class="bg-white rounded-2xl overflow-hidden max-w-4xl w-full max-h-[90vh] flex flex-col md:flex-row shadow-2xl relative animate-in">
            <button onclick="closeModal()"
                class="absolute top-3 right-3 z-20 w-9 h-9 bg-black/50 hover:bg-black/80 text-white rounded-full flex items-center justify-center md:bg-gray-100 md:text-gray-600 md:hover:bg-gray-200 transition">
                ✕
            </button>

            <div class="w-full md:w-3/5 bg-black flex items-center justify-center min-h-[250px] md:min-h-[500px]">
                <img id="modalImage" src="" alt="Detail Kegiatan" class="w-full h-full object-cover max-h-[60vh] md:max-h-[80vh]" />
            </div>

            <div class="w-full md:w-2/3 p-6 flex flex-col justify-between bg-white overflow-y-auto">
                <div>
                    <div class="flex items-center gap-3 border-b border-gray-100 pb-4 mb-4">
                        <div class="w-10 h-10 bg-purple-600 rounded-full flex items-center justify-center text-white font-bold text-xs">
                            RW21
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 text-sm leading-tight">
                                Pengurus RW 021
                            </h4>
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
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Dokumentasi Terbuka
                        </span>
                        <button onclick="closeModal()" class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-lg text-xs transition">
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

        document.getElementById("postModal").addEventListener("click", function(e) {
            if (e.target === this) closeModal();
        });

        document.addEventListener("keydown", function(e) {
            if (e.key === "Escape") closeModal();
        });
    </script>
</body>

</html>
