<!DOCTYPE html>
<html lang="id">

<head>
    <title>Balai RW 021 & Fasilitas Balai Warga - Ruang Warga 021</title>
    <?php require base_path('views/partials/head.php'); ?>
    <style>
        @keyframes marquee-right {
            from {
                transform: translateX(-50%);
            }
            to {
                transform: translateX(0%);
            }
        }

        @keyframes marquee-left {
            from {
                transform: translateX(0%);
            }
            to {
                transform: translateX(-50%);
            }
        }

        .animate-slide-right {
            animation: marquee-right 28s linear infinite;
        }

        .animate-slide-left {
            animation: marquee-left 28s linear infinite;
        }

        .animate-slide-right:hover,
        .animate-slide-left:hover {
            animation-play-state: paused;
        }
    </style>
</head>

<body class="bg-gray-50 flex flex-col min-h-screen text-gray-800">

    <?php require base_path('views/partials/navbar.php'); ?>

    <!-- MAIN CONTENT -->
    <div class="py-12 md:py-16 flex-1">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

            <!-- PAGE HEADER -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-gray-200 pb-8 pt-2">
                <div class="space-y-2">
                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-purple-50 border border-purple-200 text-purple-700 text-xs font-bold rounded-lg uppercase tracking-wider">
                        <span class="w-2 h-2 rounded-full bg-purple-600"></span>
                        Fasilitas & Pelayanan Warga
                    </div>
                    <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight">
                        Balai RW 021 <span class="text-purple-600">& Posyandu Bunga Tanjung</span>
                    </h1>
                    <p class="text-sm md:text-base text-gray-600 max-w-3xl leading-relaxed">
                        Pusat sarana publik terpadu RW 021 Bojong Nangka untuk kegiatan musyawarah warga, pelayanan kesehatan balita & lansia, fasilitas olahraga bulutangkis indoor, serta pengajuan izin peminjaman gedung.
                    </p>
                </div>
                <div class="flex-shrink-0">
                    <a href="#form-peminjaman" class="inline-flex items-center gap-2 px-6 py-3.5 bg-purple-600 hover:bg-purple-700 text-white font-bold text-xs rounded-lg transition duration-150 shadow-md">
                        <span>Ajukan Peminjaman Balai</span>
                        <span>&rarr;</span>
                    </a>
                </div>
            </div>

            <!-- SUMMARY STATS CARDS -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
                <div class="bg-white p-5 rounded-lg border border-purple-100 shadow-sm text-center">
                    <span class="text-2xl sm:text-3xl font-extrabold text-purple-700 block mb-1">150 Orang</span>
                    <span class="text-xs text-gray-500 font-bold uppercase tracking-wider">Kapasitas Gedung</span>
                </div>
                <div class="bg-white p-5 rounded-lg border border-purple-100 shadow-sm text-center">
                    <span class="text-2xl sm:text-3xl font-extrabold text-emerald-600 block mb-1">Minggu Ke-4</span>
                    <span class="text-xs text-gray-500 font-bold uppercase tracking-wider">Jadwal Posyandu</span>
                </div>
                <div class="bg-white p-5 rounded-lg border border-purple-100 shadow-sm text-center">
                    <span class="text-2xl sm:text-3xl font-extrabold text-purple-700 block mb-1">5 Klub PB</span>
                    <span class="text-xs text-gray-500 font-bold uppercase tracking-wider">Badminton Indoor</span>
                </div>
                <div class="bg-white p-5 rounded-lg border border-purple-100 shadow-sm text-center">
                    <span class="text-2xl sm:text-3xl font-extrabold text-emerald-600 block mb-1">Online</span>
                    <span class="text-xs text-gray-500 font-bold uppercase tracking-wider">Izin Peminjaman</span>
                </div>
            </div>

            <!-- SECTION PROFIL & DOKUMENTASI GAMBAR BALAI -->
            <div id="balai-rw" class="bg-white p-6 md:p-10 rounded-lg shadow-sm border border-purple-100 space-y-8">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 border-b border-gray-100 pb-4">
                    <div>
                        <span class="text-xs font-extrabold text-purple-700 uppercase tracking-widest block mb-1">Dokumentasi & Pratinjau</span>
                        <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900">Aktivitas & Fasilitas Balai RW 021</h2>
                        <p class="text-xs sm:text-sm text-gray-500 mt-1">Gedung serbaguna yang aktif digunakan untuk kegiatan sosial, keagamaan, olahraga, dan kesehatan warga.</p>
                    </div>
                </div>

                <!-- GALERI SLIDER AKTIVITAS BALAI -->
                <?php
                $galeriBalai = $galeriBalai ?? $galeriAula ?? [
                    ['foto' => '/images/aula_posyandu.jpg', 'judul' => 'Pelayanan Posyandu Bunga Tanjung', 'sub' => 'Kesehatan Balita & Lansia'],
                    ['foto' => '/images/aula_rapat.jpg', 'judul' => 'Musyawarah & Rapat Warga', 'sub' => 'Pertemuan Rutin RW 021'],
                    ['foto' => '/images/aula_badminton.jpg', 'judul' => 'Lapangan Badminton Indoor', 'sub' => 'Olahraga & Kebersamaan'],
                    ['foto' => '/images/aula_senam.jpg', 'judul' => 'Senam Kebugaran Jasmani', 'sub' => 'Kebugaran Mingguan'],
                    ['foto' => 'https://images.unsplash.com/photo-1517457373958-b7bdd4587205?auto=format&fit=crop&w=800&q=80', 'judul' => 'Gedung Pertemuan Serbaguna', 'sub' => 'Fasilitas Peminjaman Acara']
                ];
                ?>

                <div class="space-y-4">
                    <!-- TOP GRID ROW -->
                    <div class="relative overflow-hidden rounded-lg">
                        <div class="flex gap-4 w-max animate-slide-right">
                            <?php foreach ($galeriBalai as $item): ?>
                                <div class="w-72 sm:w-80 flex-shrink-0 relative group overflow-hidden shadow-sm rounded-lg border border-gray-100 bg-gray-900">
                                    <img src="<?= htmlspecialchars($item['foto']) ?>" alt="<?= htmlspecialchars($item['judul']) ?>" class="w-full h-48 sm:h-52 object-cover transform group-hover:scale-105 transition duration-500 opacity-90 group-hover:opacity-100" onerror="this.src='https://images.unsplash.com/photo-1517457373958-b7bdd4587205?auto=format&fit=crop&w=800&q=80'" />
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex flex-col justify-end p-4">
                                        <span class="text-[10px] font-bold uppercase tracking-wider text-purple-300"><?= htmlspecialchars($item['sub'] ?? 'Fasilitas RW 021') ?></span>
                                        <h4 class="text-sm font-bold text-white"><?= htmlspecialchars($item['judul']) ?></h4>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <!-- Duplicate Loop for Infinite Scroll -->
                            <?php foreach ($galeriBalai as $item): ?>
                                <div class="w-72 sm:w-80 flex-shrink-0 relative group overflow-hidden shadow-sm rounded-lg border border-gray-100 bg-gray-900" aria-hidden="true">
                                    <img src="<?= htmlspecialchars($item['foto']) ?>" alt="" class="w-full h-48 sm:h-52 object-cover transform group-hover:scale-105 transition duration-500 opacity-90 group-hover:opacity-100" onerror="this.src='https://images.unsplash.com/photo-1517457373958-b7bdd4587205?auto=format&fit=crop&w=800&q=80'" />
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex flex-col justify-end p-4">
                                        <span class="text-[10px] font-bold uppercase tracking-wider text-purple-300"><?= htmlspecialchars($item['sub'] ?? 'Fasilitas RW 021') ?></span>
                                        <h4 class="text-sm font-bold text-white"><?= htmlspecialchars($item['judul']) ?></h4>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- BOTTOM GRID ROW -->
                    <div class="relative overflow-hidden rounded-lg">
                        <div class="flex gap-4 w-max animate-slide-left">
                            <?php foreach (array_reverse($galeriBalai) as $item): ?>
                                <div class="w-72 sm:w-80 flex-shrink-0 relative group overflow-hidden shadow-sm rounded-lg border border-gray-100 bg-gray-900">
                                    <img src="<?= htmlspecialchars($item['foto']) ?>" alt="<?= htmlspecialchars($item['judul']) ?>" class="w-full h-48 sm:h-52 object-cover transform group-hover:scale-105 transition duration-500 opacity-90 group-hover:opacity-100" onerror="this.src='https://images.unsplash.com/photo-1517457373958-b7bdd4587205?auto=format&fit=crop&w=800&q=80'" />
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex flex-col justify-end p-4">
                                        <span class="text-[10px] font-bold uppercase tracking-wider text-purple-300"><?= htmlspecialchars($item['sub'] ?? 'Fasilitas RW 021') ?></span>
                                        <h4 class="text-sm font-bold text-white"><?= htmlspecialchars($item['judul']) ?></h4>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <!-- Duplicate Loop for Infinite Scroll -->
                            <?php foreach (array_reverse($galeriBalai) as $item): ?>
                                <div class="w-72 sm:w-80 flex-shrink-0 relative group overflow-hidden shadow-sm rounded-lg border border-gray-100 bg-gray-900" aria-hidden="true">
                                    <img src="<?= htmlspecialchars($item['foto']) ?>" alt="" class="w-full h-48 sm:h-52 object-cover transform group-hover:scale-105 transition duration-500 opacity-90 group-hover:opacity-100" onerror="this.src='https://images.unsplash.com/photo-1517457373958-b7bdd4587205?auto=format&fit=crop&w=800&q=80'" />
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex flex-col justify-end p-4">
                                        <span class="text-[10px] font-bold uppercase tracking-wider text-purple-300"><?= htmlspecialchars($item['sub'] ?? 'Fasilitas RW 021') ?></span>
                                        <h4 class="text-sm font-bold text-white"><?= htmlspecialchars($item['judul']) ?></h4>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- DESKRIPSI LENGKAP FASILITAS & LAYANAN (3 COLUMNS) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- CARD 1: BALAI PERTEMUAN -->
                <div class="bg-white p-6 sm:p-8 rounded-lg border border-purple-100 shadow-sm flex flex-col justify-between space-y-5 hover:shadow-md hover:border-purple-200 transition">
                    <div class="space-y-4">
                        <div class="w-12 h-12 rounded-lg bg-purple-100 text-purple-700 flex items-center justify-center font-bold">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Gedung Balai Pertemuan</h3>
                            <p class="text-xs text-gray-600 mt-2 leading-relaxed">
                                Gedung pertemuan utama warga yang dilengkapi fasilitas 100+ kursi lipat, meja rapat, sound system wireless, kipas angin gantung, panggung mini, serta area parkir. Dapat disewa untuk acara syukuran, rapat dinas, arisan, maupun pertemuan keagamaan.
                            </p>
                        </div>
                        <div class="space-y-1.5 pt-2 border-t border-gray-100 text-xs text-gray-600">
                            <div class="flex items-center gap-2">
                                <span class="text-purple-600 font-bold">✓</span>
                                <span>Kapasitas hingga 150 kursi</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-purple-600 font-bold">✓</span>
                                <span>Sound system & mic wireless</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-purple-600 font-bold">✓</span>
                                <span>Toilet bersih & mushola terdekat</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="button" onclick="openModal('peminjaman-balai')" class="text-xs font-bold text-purple-700 hover:text-purple-900 inline-flex items-center gap-1">
                            <span>Lihat Prosedur & Tarif</span>
                            <span>&rarr;</span>
                        </button>
                    </div>
                </div>

                <!-- CARD 2: POSYANDU BUNGA TANJUNG -->
                <div class="bg-white p-6 sm:p-8 rounded-lg border border-purple-100 shadow-sm flex flex-col justify-between space-y-5 hover:shadow-md hover:border-purple-200 transition">
                    <div class="space-y-4">
                        <div class="w-12 h-12 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Posyandu Bunga Tanjung</h3>
                            <p class="text-xs text-gray-600 mt-2 leading-relaxed">
                                Pelayanan kesehatan gratis ibu, balita, dan lansia binaan Puskesmas. Menyediakan penimbangan berat badan, imunisasi dasar, vitamin A, makanan tambahan (PMT), serta cek tensi darah dan kadar gula rutin bagi warga usia lanjut.
                            </p>
                        </div>
                        <div class="space-y-1.5 pt-2 border-t border-gray-100 text-xs text-gray-600">
                            <div class="flex items-center gap-2">
                                <span class="text-emerald-600 font-bold">✓</span>
                                <span>Setiap Minggu ke-4 (08.00 - 11.30 WIB)</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-emerald-600 font-bold">✓</span>
                                <span>Pemberian Makanan Tambahan (PMT)</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-emerald-600 font-bold">✓</span>
                                <span>Cek tensi, gula darah & kolesterol lansia</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="button" onclick="openModal('posyandu-info')" class="text-xs font-bold text-emerald-700 hover:text-emerald-900 inline-flex items-center gap-1">
                            <span>Lihat Jadwal & Alur Layanan</span>
                            <span>&rarr;</span>
                        </button>
                    </div>
                </div>

                <!-- CARD 3: BADMINTON & OLAHRAGA -->
                <div class="bg-white p-6 sm:p-8 rounded-lg border border-purple-100 shadow-sm flex flex-col justify-between space-y-5 hover:shadow-md hover:border-purple-200 transition">
                    <div class="space-y-4">
                        <div class="w-12 h-12 rounded-lg bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Badminton & Senam Bersama</h3>
                            <p class="text-xs text-gray-600 mt-2 leading-relaxed">
                                Sarana lapangan indoor bulutangkis aktif dengan pencahayaan lampu LED terang. Mewadahi klub olahraga warga (PB DABO, PB SELSAB, Karang Taruna), senam kebugaran jasmani ibu-ibu, dan kelas latihan bela diri anak-anak.
                            </p>
                        </div>
                        <div class="space-y-1.5 pt-2 border-t border-gray-100 text-xs text-gray-600">
                            <div class="flex items-center gap-2">
                                <span class="text-indigo-600 font-bold">✓</span>
                                <span>Lapangan badminton standar indoor</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-indigo-600 font-bold">✓</span>
                                <span>Senam Sehat (Rabu & Sabtu pagi)</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-indigo-600 font-bold">✓</span>
                                <span>Jadwal bergilir klub malam hari</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="button" onclick="openModal('badminton-info')" class="text-xs font-bold text-indigo-700 hover:text-indigo-900 inline-flex items-center gap-1">
                            <span>Lihat Jadwal Klub Warga</span>
                            <span>&rarr;</span>
                        </button>
                    </div>
                </div>

            </div>

            <!-- SECTION FORM PEMINJAMAN BALAI (INTEGRASI WA) -->
            <div id="form-peminjaman" class="bg-white p-6 md:p-10 rounded-lg shadow-sm border border-purple-100 space-y-6">
                <div class="border-b border-gray-100 pb-4">
                    <span class="text-xs font-extrabold text-purple-700 uppercase tracking-widest block mb-1">Pengajuan Digital</span>
                    <h2 class="text-2xl font-extrabold text-gray-900">Formulir Peminjaman Balai RW 021</h2>
                    <p class="text-xs sm:text-sm text-gray-500 mt-1">Isi formulir di bawah ini untuk mengajukan jadwal peminjaman gedung balai. Sistem akan menghubungkan Anda langsung ke WhatsApp Sekretaris RW.</p>
                </div>

                <form onsubmit="submitBookingBalai(event)" class="space-y-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                        <div>
                            <label for="book_nama" class="block text-xs font-bold text-gray-700 mb-1">Nama Pemohon / Penanggung Jawab *</label>
                            <input type="text" id="book_nama" required placeholder="Contoh: Budi Santoso" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-purple-600 focus:border-purple-600 text-xs" />
                        </div>

                        <div>
                            <label for="book_rt" class="block text-xs font-bold text-gray-700 mb-1">Asal Wilayah RT *</label>
                            <select id="book_rt" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-purple-600 focus:border-purple-600 text-xs">
                                <?php for ($i = 1; $i <= 10; $i++): ?>
                                    <option value="<?= sprintf('%02d', $i) ?>">RT <?= sprintf('%02d', $i) ?> / RW 021</option>
                                <?php endfor; ?>
                                <option value="Luar RW 021">Warga Luar RW 021</option>
                            </select>
                        </div>

                        <div>
                            <label for="book_wa" class="block text-xs font-bold text-gray-700 mb-1">No. WhatsApp Aktif *</label>
                            <input type="tel" id="book_wa" required placeholder="08xxxxxxxxxx" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-purple-600 focus:border-purple-600 text-xs" />
                        </div>

                        <div>
                            <label for="book_tanggal" class="block text-xs font-bold text-gray-700 mb-1">Tanggal Acara / Penggunaan *</label>
                            <input type="date" id="book_tanggal" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-purple-600 focus:border-purple-600 text-xs" />
                        </div>

                        <div>
                            <label for="book_waktu" class="block text-xs font-bold text-gray-700 mb-1">Waktu / Jam Penggunaan *</label>
                            <input type="text" id="book_waktu" required placeholder="Contoh: 09.00 - 13.00 WIB" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-purple-600 focus:border-purple-600 text-xs" />
                        </div>

                        <div>
                            <label for="book_acara" class="block text-xs font-bold text-gray-700 mb-1">Jenis Acara / Keperluan *</label>
                            <select id="book_acara" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-purple-600 focus:border-purple-600 text-xs">
                                <option value="Syukuran / Pernikahan / Keluarga">Syukuran / Pernikahan / Acara Keluarga</option>
                                <option value="Rapat RT / Organisasi / Komunitas">Rapat RT / Organisasi / Komunitas</option>
                                <option value="Pengajian / Kegiatan Keagamaan">Pengajian / Kegiatan Keagamaan</option>
                                <option value="Sosialisasi / Pelatihan Instansi">Sosialisasi / Pelatihan Instansi</option>
                                <option value="Kegiatan Olahraga / Perlombaan">Kegiatan Olahraga / Perlombaan</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="book_catatan" class="block text-xs font-bold text-gray-700 mb-1">Catatan Tambahan & Kebutuhan Fasilitas</label>
                        <textarea id="book_catatan" rows="3" placeholder="Tuliskan estimasi jumlah undangan, kebutuhan kursi/meja/sound system..." class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-purple-600 focus:border-purple-600 text-xs"></textarea>
                    </div>

                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 pt-2">
                        <span class="text-xs text-gray-500">
                            * Pengajuan peminjaman akan diproses oleh Sekretariat RW 021 untuk konfirmasi ketersediaan jadwal.
                        </span>
                        <button type="submit" class="px-8 py-3.5 bg-purple-600 hover:bg-purple-700 text-white font-bold text-xs rounded-lg transition duration-150 shadow-md flex items-center gap-2">
                            <span>Kirim Pengajuan ke WhatsApp &rarr;</span>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <!-- FOOTER -->
    <?php require base_path('views/partials/footer.php'); ?>

    <!-- MODAL DETAIL OVERLAY -->
    <div id="detail-modal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-lg max-w-2xl w-full max-h-[90vh] overflow-hidden flex flex-col shadow-2xl">
            <!-- Modal Header -->
            <div id="modal-header-bg" class="px-6 py-5 bg-purple-700 text-white flex justify-between items-center">
                <div>
                    <span id="modal-category" class="text-[10px] font-extrabold uppercase tracking-widest bg-white/20 px-2.5 py-0.5 rounded-lg">Balai RW 021</span>
                    <h3 id="modal-title" class="text-xl font-bold mt-1">Detail Layanan</h3>
                </div>
                <button type="button" onclick="closeModal()" class="text-white/80 hover:text-white text-2xl font-bold p-1 focus:outline-none">&times;</button>
            </div>

            <!-- Modal Content -->
            <div class="p-6 overflow-y-auto space-y-6 flex-1 text-gray-800">
                <div>
                    <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Deskripsi Singkat</h4>
                    <p id="modal-description" class="text-sm text-gray-700 leading-relaxed"></p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-t border-b border-gray-100 py-4">
                    <div>
                        <h4 class="text-xs font-bold text-purple-700 uppercase tracking-wider mb-2">Layanan & Fitur</h4>
                        <ul id="modal-subitems" class="text-xs text-gray-600 space-y-1.5 list-disc list-inside"></ul>
                    </div>

                    <div>
                        <h4 class="text-xs font-bold text-amber-700 uppercase tracking-wider mb-2">Persyaratan / Catatan</h4>
                        <ul id="modal-requirements" class="text-xs text-gray-600 space-y-1.5"></ul>
                    </div>
                </div>

                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                    <div>
                        <span class="text-xs font-bold text-gray-400 uppercase block">Lokasi & Waktu Operasional</span>
                        <span id="modal-schedule" class="text-xs font-bold text-gray-800"></span>
                    </div>
                    <div>
                        <span class="text-xs font-bold text-gray-400 uppercase block">Koordinator Kontak</span>
                        <span id="modal-coordinator" class="text-xs font-bold text-purple-700"></span>
                    </div>
                </div>

                <div class="pt-2">
                    <a id="modal-wa-btn" href="#" target="_blank" class="w-full py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-lg flex items-center justify-center gap-2 transition shadow-md">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.157 4.228 4.301-1.127z" />
                        </svg>
                        Hubungi Koordinator via WhatsApp
                    </a>
                </div>
            </div>

            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end">
                <button type="button" onclick="closeModal()" class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold text-xs rounded-lg transition">Tutup</button>
            </div>
        </div>
    </div>

    <script>
        const modalData = {
            'peminjaman-balai': {
                category: 'Balai RW 021 & Fasilitas',
                title: 'Peminjaman & Sewa Gedung Balai RW 021',
                headerBg: 'bg-purple-700',
                description: 'Prosedur izin penggunaan dan peminjaman fasilitas Balai RW 021 Bojong Nangka untuk syukuran keluarga, rapat organisasi, sosialisasi dinas, dan kegiatan warga.',
                subitems: [
                    'Penggunaan untuk Acara Syukuran / Pernikahan Warga',
                    'Rapat RT, Karang Taruna, & Keagamaan',
                    'Kegiatan Sosialisasi Pemerintah & Puskesmas'
                ],
                requirements: [
                    'Warga RW 021 / Penyewa Berizin Pengurus RT',
                    'Mengisi Form Peminjaman Online di Halaman Ini',
                    'Mematuhi Jam Operasional & Ketertiban Lingkungan'
                ],
                schedule: 'Balai Warga RW 021 RT 05<br>Sesuai Pengajuan Jadwal Peminjaman',
                coordinator: 'Galih Wirapati (Sekretaris RW - 087888872828)',
                wa: 'https://wa.me/6287888872828'
            },
            'posyandu-info': {
                category: 'Balai RW 021 & Fasilitas',
                title: 'Layanan Posyandu Bunga Tanjung RW 021',
                headerBg: 'bg-purple-700',
                description: 'Pusat pelayanan kesehatan ibu, balita, dan lansia rutin bulanan yang diselenggarakan oleh kader Posyandu Bunga Tanjung RW 021.',
                subitems: [
                    'Penimbangan & Pengukuran Tumbuh Kembang Balita',
                    'Pemberian Makanan Tambahan (PMT) & Vitamin A',
                    'Pemeriksaan Kesehatan Lansia & Cek Gula Darah/Tensi'
                ],
                requirements: [
                    'Membawa Buku KIA (Kartu Menuju Sehat / KMS)',
                    'Warga RW 021 RT 01 - RT 10'
                ],
                schedule: 'Balai RW 021 Posyandu Bunga Tanjung<br>Setiap Minggu Ke-4 (Pukul 08.00 - 11.30 WIB)',
                coordinator: 'Pengurus Kader Posyandu Bunga Tanjung',
                wa: 'https://wa.me/6282299007700'
            },
            'badminton-info': {
                category: 'Balai RW 021 & Fasilitas',
                title: 'Jadwal Olahraga & Badminton Indoor',
                headerBg: 'bg-purple-700',
                description: 'Penggunaan lapangan bulu tangkis indoor Balai RW 021 bagi perkumpulan PB warga, latihan Karate anak, dan Senam Jasmani.',
                subitems: [
                    'PB DABO (Senin & Rabu 19.30 WIB)',
                    'PB SELSAB (Selasa & Sabtu 19.30 WIB)',
                    'Karang Taruna RW 021 (Jumat 19.30 WIB)',
                    'Senam Sehat Jasmani (Rabu & Sabtu 07.00 WIB)',
                    'Latihan Karate (Minggu 15.30 WIB)'
                ],
                requirements: [
                    'Wajib Menggunakan Sepatu Olahraga Indoor',
                    'Menjaga Kebersihan & Mematikan Lampu Usai Pakai'
                ],
                schedule: 'Balai RW 021 Dasana Indah<br>Sesuai Pembagian Jadwal Klub',
                coordinator: 'Khusairi (Humas & Keamanan RW - 081511322022)',
                wa: 'https://wa.me/6281511322022'
            }
        };

        function submitBookingBalai(e) {
            e.preventDefault();
            const nama = document.getElementById('book_nama').value.trim();
            const rt = document.getElementById('book_rt').value;
            const wa = document.getElementById('book_wa').value.trim();
            const tanggal = document.getElementById('book_tanggal').value;
            const waktu = document.getElementById('book_waktu').value.trim();
            const acara = document.getElementById('book_acara').value;
            const catatan = document.getElementById('book_catatan').value.trim();

            if (!nama || !wa || !tanggal || !waktu) {
                alert('Mohon lengkapi Nama, No. WhatsApp, Tanggal, dan Waktu Acara.');
                return;
            }

            const text = `Halo Pengurus RW 021 (Sekretaris Galih Wirapati),\n\nSaya ingin mengajukan *PEMINJAMAN BALAI RW 021*:\n\n👤 *Nama Pemohon*: ${nama}\n🏡 *Asal Wilayah*: RT ${rt} RW 021\n📱 *No. WhatsApp*: ${wa}\n📅 *Tanggal Acara*: ${tanggal}\n⏰ *Jam/Waktu*: ${waktu}\n🎉 *Jenis Acara*: ${acara}\n📝 *Catatan Keperluan*: ${catatan || '-'}\n\nMohon informasi persetujuan & ketersediaan gedung Balai. Terima kasih.`;

            const encoded = encodeURIComponent(text);
            window.open(`https://wa.me/6287888872828?text=${encoded}`, '_blank');
        }

        const submitBookingAula = submitBookingBalai;

        function openModal(key) {
            const data = modalData[key];
            if (!data) return;

            document.getElementById('modal-category').innerText = data.category;
            document.getElementById('modal-title').innerText = data.title;
            document.getElementById('modal-header-bg').className = `px-6 py-5 ${data.headerBg} text-white flex justify-between items-center`;
            document.getElementById('modal-description').innerText = data.description;

            const subitemsContainer = document.getElementById('modal-subitems');
            subitemsContainer.innerHTML = '';
            data.subitems.forEach(item => {
                const li = document.createElement('li');
                li.innerText = item;
                subitemsContainer.appendChild(li);
            });

            const reqContainer = document.getElementById('modal-requirements');
            reqContainer.innerHTML = '';
            data.requirements.forEach(req => {
                const li = document.createElement('li');
                li.innerHTML = `• ${req}`;
                reqContainer.appendChild(li);
            });

            document.getElementById('modal-schedule').innerHTML = data.schedule;
            document.getElementById('modal-coordinator').innerText = data.coordinator;
            document.getElementById('modal-wa-btn').href = data.wa;

            document.getElementById('detail-modal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('detail-modal').classList.add('hidden');
        }

        window.addEventListener('DOMContentLoaded', () => {
            const urlParams = new URLSearchParams(window.location.search);
            const detailKey = urlParams.get('detail');
            if (detailKey && modalData[detailKey]) {
                openModal(detailKey);
            }
        });

        document.getElementById('detail-modal').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });
    </script>
</body>

</html>