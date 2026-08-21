<!DOCTYPE html>
<html lang="id">

<head>
    <title>Balai RW 021 & Fasilitas Balai Warga - Ruang Warga 021</title>
    <?php require base_path('views/partials/head.php'); ?>
    <style>
        /* 2x2 Grid Directional Animations */
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
            animation: marquee-right 25s linear infinite;
        }

        .animate-slide-left {
            animation: marquee-left 25s linear infinite;
        }

        .animate-slide-right:hover,
        .animate-slide-left:hover {
            animation-play-state: paused;
        }
    </style>
</head>

<body class="bg-gray-50 flex flex-col min-h-screen">

    <?php require base_path('views/partials/navbar.php'); ?>

    <!-- MAIN CONTENT -->
    <div class="py-16 md:py-20 flex-1">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

            <!-- SIMPLE PAGE HEADER -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-gray-200 pb-8 pt-4">
                <div class="space-y-2">
                    <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight">Balai <span class="text-purple-600">RW 021 & Posyandu Bunga Tanjung</span></h1>
                    <p class="text-xs md:text-sm text-gray-500 max-w-2xl leading-relaxed">Gedung balai pertemuan utama warga, pelayanan Posyandu, serta izin peminjaman gedung.</p>
                </div>
            </div>

            <!-- SECTION BALAI RW FULL -->
            <div id="balai-rw" class="bg-white p-6 md:p-10 rounded-2xl shadow-sm border border-purple-100 space-y-10">

                <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                    <div>
                        <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 mt-2">Profil & Fasilitas Balai RW 021</h2>
                        <p class="text-sm text-gray-500 mt-1">Balai pertemuan yang fleksibel untuk musyawarah, pelayanan kesehatan rutin, dan kegiatan olahraga warga.</p>
                    </div>
                </div>

                <!-- GALERI SLIDER AKTIVITAS BALAI -->
                <?php
                $galeriBalai = $galeriBalai ?? $galeriAula ?? [
                    ['foto' => '/images/aula_posyandu.jpg', 'judul' => 'Posyandu Bunga Tanjung'],
                    ['foto' => '/images/aula_rapat.jpg', 'judul' => 'Musyawarah Warga RW 021'],
                    ['foto' => '/images/aula_badminton.jpg', 'judul' => 'Badminton Indoor'],
                    ['foto' => '/images/aula_senam.jpg', 'judul' => 'Senam Sehat Warga']
                ];
                ?>

                <div class="space-y-3">
                    <div class="flex justify-between items-center px-1">
                        <span class="text-lg text-purple-700 font-bold">Balai RW 021 RT 05</span>
                    </div>

                    <?php if (empty($galeriBalai)): ?>
                        <!-- EMPTY STATE GALERI BALAI -->
                        <div class="p-8 bg-gray-50 rounded-2xl border border-gray-200 text-center">
                            <p class="text-gray-500 text-sm">Dokumentasi foto fasilitas Balai belum diunggah.</p>
                        </div>
                    <?php else: ?>
                        <!-- TOP GRID ROW -->
                        <div class="relative overflow-hidden rounded-xl">
                            <div class="flex gap-4 w-max animate-slide-right">
                                <?php foreach ($galeriBalai as $item): ?>
                                    <div class="w-72 sm:w-96 flex-shrink-0 relative group overflow-hidden shadow-md rounded-xl">
                                        <img src="<?= htmlspecialchars($item['foto']) ?>" alt="<?= htmlspecialchars($item['judul']) ?>" class="w-full h-52 sm:h-64 object-cover transform group-hover:scale-105 transition duration-500" onerror="this.src='https://images.unsplash.com/photo-1517457373958-b7bdd4587205?auto=format&fit=crop&w=800&q=80'" />
                                    </div>
                                <?php endforeach; ?>
                                <!-- Duplicate Loop for Seamless Infinite Scroll -->
                                <?php foreach ($galeriBalai as $item): ?>
                                    <div class="w-72 sm:w-96 flex-shrink-0 relative group overflow-hidden shadow-md rounded-xl" aria-hidden="true">
                                        <img src="<?= htmlspecialchars($item['foto']) ?>" alt="" class="w-full h-52 sm:h-64 object-cover transform group-hover:scale-105 transition duration-500" onerror="this.src='https://images.unsplash.com/photo-1517457373958-b7bdd4587205?auto=format&fit=crop&w=800&q=80'" />
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- BOTTOM GRID ROW -->
                        <div class="relative overflow-hidden rounded-xl">
                            <div class="flex gap-4 w-max animate-slide-left">
                                <?php foreach (array_reverse($galeriBalai) as $item): ?>
                                    <div class="w-72 sm:w-96 flex-shrink-0 relative group overflow-hidden shadow-md rounded-xl">
                                        <img src="<?= htmlspecialchars($item['foto']) ?>" alt="<?= htmlspecialchars($item['judul']) ?>" class="w-full h-52 sm:h-64 object-cover transform group-hover:scale-105 transition duration-500" onerror="this.src='https://images.unsplash.com/photo-1517457373958-b7bdd4587205?auto=format&fit=crop&w=800&q=80'" />
                                    </div>
                                <?php endforeach; ?>
                                <?php foreach (array_reverse($galeriBalai) as $item): ?>
                                    <div class="w-72 sm:w-96 flex-shrink-0 relative group overflow-hidden shadow-md rounded-xl" aria-hidden="true">
                                        <img src="<?= htmlspecialchars($item['foto']) ?>" alt="" class="w-full h-52 sm:h-64 object-cover transform group-hover:scale-105 transition duration-500" onerror="this.src='https://images.unsplash.com/photo-1517457373958-b7bdd4587205?auto=format&fit=crop&w=800&q=80'" />
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

            </div>

        </div>
    </div>


    <!-- FOOTER -->
    <?php require base_path('views/partials/footer.php'); ?>

    <!-- MODAL DETAIL OVERLAY -->
    <div id="detail-modal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-hidden flex flex-col shadow-2xl">
            <!-- Modal Header -->
            <div id="modal-header-bg" class="px-6 py-5 bg-purple-700 text-white flex justify-between items-center">
                <div>
                    <span id="modal-category" class="text-[10px] font-extrabold uppercase tracking-widest bg-white/20 px-2.5 py-0.5 rounded">Balai RW 021</span>
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

                <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
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
                    <a id="modal-wa-btn" href="#" target="_blank" class="w-full py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl flex items-center justify-center gap-2 transition shadow-md">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.157 4.228 4.301-1.127z" />
                        </svg>
                        Hubungi Koordinator via WhatsApp
                    </a>
                </div>
            </div>

            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end">
                <button type="button" onclick="closeModal()" class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold text-xs rounded-xl transition">Tutup</button>
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
            'peminjaman-aula': {
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
                    'Penimbangan & Pengukuran Tumbuh Tumbuh Balita',
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

        // Backward compatibility
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