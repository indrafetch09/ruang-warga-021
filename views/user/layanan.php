<!DOCTYPE html>
<html lang="id">

<head>
    <?php $title = "Aula RW 021 & Fasilitas Balai Warga - Ruang Warga 021";
    require base_path('views/partials/head.php'); ?>
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
                    <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight">Aula <span class="text-purple-600">RW 021 & Posyandu Bunga Tanjung</span></h1>
                    <p class="text-xs md:text-sm text-gray-500 max-w-2xl leading-relaxed">Gedung balai pertemuan utama warga, pelayanan Posyandu, serta izin peminjaman gedung.</p>
                </div>
            </div>

            <!-- SECTION AULA RW FULL -->
            <div class="flex items-center justify-center">
                <div>
                    <h2 class="text-center text-2xl md:text-3xl font-extrabold text-gray-900">Profil & Fasilitas Aula RW 021</h2>
                </div>
            </div>

            <!-- GALERI SLIDER AKTIVITAS AULA -->
            <?php
            $galeriAula = $galeriAula ?? [
                ['foto' => '/images/aula_posyandu.jpg', 'judul' => 'Posyandu Bunga Tanjung'],
                ['foto' => '/images/aula_rapat.jpg', 'judul' => 'Musyawarah Warga RW 021'],
                ['foto' => '/images/aula_badminton.jpg', 'judul' => 'Badminton Indoor'],
                ['foto' => '/images/aula_senam.jpg', 'judul' => 'Senam Sehat Warga']
            ];
            ?>

            <div class="space-y-3">
                <div class="flex justify-between items-center px-1 pt-8">
                    <h2 class="text-2xl text-purple-700 font-bold">Aula RW 021 RT 05</h2>
                </div>

                <?php if (empty($galeriAula)): ?>
                    <!-- EMPTY STATE GALERI AULA -->
                    <div class="p-8 bg-gray-50 border border-gray-200 text-center">
                        <p class="text-gray-500 text-sm">Dokumentasi foto fasilitas Aula belum diunggah.</p>
                    </div>
                <?php else: ?>
                    <!-- TOP GRID ROW -->
                    <div class="relative overflow-hidden">
                        <div class="flex gap-4 w-max animate-slide-right">
                            <?php foreach ($galeriAula as $item): ?>
                                <div class="w-72 sm:w-96 flex-shrink-0 relative group overflow-hidden shadow-md ">
                                    <img src="<?= htmlspecialchars($item['foto']) ?>" alt="<?= htmlspecialchars($item['judul']) ?>" class="w-full h-52 sm:h-64 object-cover transform group-hover:scale-105 transition duration-500" />
                                </div>
                            <?php endforeach; ?>
                            <!-- Duplicate Loop for Seamless Infinite Scroll -->
                            <?php foreach ($galeriAula as $item): ?>
                                <div class="w-72 sm:w-96 flex-shrink-0 relative group overflow-hidden shadow-md " aria-hidden="true">
                                    <img src="<?= htmlspecialchars($item['foto']) ?>" alt="" class="w-full h-52 sm:h-64 object-cover transform group-hover:scale-105 transition duration-500" />
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <p class=" pt-5 text-start text-sm">Description Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim veritatis ut dicta suscipit commodi exercitationem facilis dolorem, placeat fuga molestiae doloremque repellat corrupti velit dolorum obcaecati minima pariatur laboriosam eos.</p>
                    </div>

                    <div class="flex justify-between items-center px-1 pt-8">
                        <h2 class="text-2xl text-purple-700 font-bold">Posyandu Bunga Tanjung</h2>
                    </div>
                    <!-- BOTTOM GRID ROW -->
                    <div class="relative overflow-hidden ">
                        <div class="flex gap-4 w-max animate-slide-left">
                            <?php foreach (array_reverse($galeriAula) as $item): ?>
                                <div class="w-72 sm:w-96 flex-shrink-0 relative group overflow-hidden shadow-md">
                                    <img src="<?= htmlspecialchars($item['foto']) ?>" alt="<?= htmlspecialchars($item['judul']) ?>" class="w-full h-52 sm:h-64 object-cover transform group-hover:scale-105 transition duration-500" onerror="this.src='https://images.unsplash.com/photo-1517457373958-b7bdd4587205?auto=format&fit=crop&w=800&q=80'" />
                                </div>
                            <?php endforeach; ?>
                            <?php foreach (array_reverse($galeriAula) as $item): ?>
                                <div class="w-72 sm:w-96 flex-shrink-0 relative group overflow-hidden shadow-md " aria-hidden="true">
                                    <img src="<?= htmlspecialchars($item['foto']) ?>" alt="" class="w-full h-52 sm:h-64 object-cover transform group-hover:scale-105 transition duration-500" onerror="this.src='https://images.unsplash.com/photo-1517457373958-b7bdd4587205?auto=format&fit=crop&w=800&q=80'" />
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <p class=" pt-5 text-start text-sm">Description Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim veritatis ut dicta suscipit commodi exercitationem facilis dolorem, placeat fuga molestiae doloremque repellat corrupti velit dolorum obcaecati minima pariatur laboriosam eos.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <?php require base_path('views/partials/footer.php'); ?>

    <script>
        const modalData = {
            'peminjaman-aula': {
                category: 'Aula RW 021 & Fasilitas',
                title: 'Peminjaman & Sewa Gedung Balai RW 021',
                headerBg: 'bg-purple-700',
                description: 'Prosedur izin penggunaan dan peminjaman fasilitas Aula RW 021 Bojong Nangka untuk syukuran keluarga, rapat organisasi, sosialisasi dinas, dan kegiatan warga.',
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
                category: 'Aula RW 021 & Fasilitas',
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
                schedule: 'Aula RW 021 Posyandu Bunga Tanjung<br>Setiap Minggu Ke-4 (Pukul 08.00 - 11.30 WIB)',
                coordinator: 'Pengurus Kader Posyandu Bunga Tanjung',
                wa: 'https://wa.me/6282299007700'
            },
            'badminton-info': {
                category: 'Aula RW 021 & Fasilitas',
                title: 'Jadwal Olahraga & Badminton Indoor',
                headerBg: 'bg-purple-700',
                description: 'Penggunaan lapangan bulu tangkis indoor Aula RW 021 bagi perkumpulan PB warga, latihan Karate anak, dan Senam Jasmani.',
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
                schedule: 'Aula RW 021 Dasana Indah<br>Sesuai Pembagian Jadwal Klub',
                coordinator: 'Khusairi (Humas & Keamanan RW - 081511322022)',
                wa: 'https://wa.me/6281511322022'
            }
        };

        function submitBookingAula(e) {
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

            const text = `Halo Pengurus RW 021 (Sekretaris Galih Wirapati),\n\nSaya ingin mengajukan *PEMINJAMAN AULA RW 021*:\n\n👤 *Nama Pemohon*: ${nama}\n🏡 *Asal Wilayah*: RT ${rt} RW 021\n📱 *No. WhatsApp*: ${wa}\n📅 *Tanggal Acara*: ${tanggal}\n⏰ *Jam/Waktu*: ${waktu}\n🎉 *Jenis Acara*: ${acara}\n📝 *Catatan Keperluan*: ${catatan || '-'}\n\nMohon informasi persetujuan & ketersediaan gedung Aula. Terima kasih.`;

            const encoded = encodeURIComponent(text);
            window.open(`https://wa.me/6287888872828?text=${encoded}`, '_blank');
        }

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