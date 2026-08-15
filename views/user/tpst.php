<!DOCTYPE html>
<html lang="id">

<head>
    <?php $title = "Kebersihan Lingkungan (TPST & Bank Sampah) - Ruang Warga 021";
    require base_path('views/partials/head.php'); ?>
</head>

<body class="bg-gray-50 flex flex-col min-h-screen">

    <?php require base_path('views/partials/navbar.php'); ?>

    <!-- MAIN CONTENT -->
    <div class="py-16 md:py-20 flex-1">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

            <!-- ponytail: Page header with generous spacing and padding -->
            <!-- SIMPLE PAGE HEADER -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-gray-200 pb-8 pt-4">
                <div class="space-y-2">
                    <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight">Layanan <span class="text-emerald-600">Kebersihan TPST & Bank Sampah</span></h1>
                    <p class="text-xs md:text-sm text-gray-500 max-w-2xl leading-relaxed">Jadwal pengangkutan sampah rumah tangga dan program daur ulang Bank Sampah RW 021.</p>
                </div>
            </div>

            <!-- SUMMARY STATS TPST -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
                <div class="bg-white p-6 rounded-2xl border border-emerald-100 shadow-sm text-center">
                    <span class="text-3xl md:text-4xl font-extrabold text-emerald-600 block mb-1">Setiap Hari</span>
                    <span class="text-xs text-gray-500 font-bold uppercase tracking-wider">Sampah Dapur Organik</span>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-emerald-100 shadow-sm text-center">
                    <span class="text-3xl md:text-4xl font-extrabold text-emerald-600 block mb-1">2x Seminggu</span>
                    <span class="text-xs text-gray-500 font-bold uppercase tracking-wider">Sampah Anorganik Kering</span>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-emerald-100 shadow-sm text-center">
                    <span class="text-3xl md:text-4xl font-extrabold text-emerald-600 block mb-1">RT 01-10</span>
                    <span class="text-xs text-gray-500 font-bold uppercase tracking-wider">Cakupan Armada TPST</span>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-emerald-100 shadow-sm text-center">
                    <span class="text-3xl md:text-4xl font-extrabold text-purple-700 block mb-1">Bank Sampah</span>
                    <span class="text-xs text-gray-500 font-bold uppercase tracking-wider">Tabungan Daur Ulang</span>
                </div>
            </div>

            <!-- SECTION KEBERSIHAN TPST -->
            <div id="tpst" class="bg-white p-6 md:p-10 rounded-2xl shadow-sm border border-emerald-100 space-y-8">

                <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                    <div>
                        <h2 class="text-2xl font-extrabold text-gray-900 mt-2">Layanan Pengangkutan & Bank Sampah RW 021</h2>
                        <p class="text-sm text-gray-500 mt-1">Klik kartu di bawah ini untuk melihat jadwal rincian jam pengangkutan dan tata cara penimbangan sampah daur ulang.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div onclick="openModal('tpst-jadwal')" class="p-6 bg-emerald-50/50 rounded-2xl border border-emerald-100 hover:border-emerald-400 hover:shadow-md transition duration-200 cursor-pointer flex flex-col justify-between group">
                        <div>
                            <h3 class="font-bold text-gray-900 text-lg mb-2 group-hover:text-emerald-700 transition">Jadwal Pengangkatan Sampah</h3>
                            <p class="text-xs text-gray-600 mb-4 leading-relaxed">Pengangkutan sampah dapur organik harian (06.00 - 09.00 WIB) dan sampah anorganik kering setiap Senin & Kamis.</p>
                        </div>
                        <span class="text-xs font-extrabold text-emerald-700">Rincian Aturan & Jam &rarr;</span>
                    </div>

                    <div onclick="openModal('bank-sampah')" class="p-6 bg-emerald-50/50 rounded-2xl border border-emerald-100 hover:border-emerald-400 hover:shadow-md transition duration-200 cursor-pointer flex flex-col justify-between group">
                        <div>
                            <h3 class="font-bold text-gray-900 text-lg mb-2 group-hover:text-emerald-700 transition">Program Bank Sampah RW 021</h3>
                            <p class="text-xs text-gray-600 mb-4 leading-relaxed">Setor botol plastik, kardus, dan kaleng menjadi saldo rupiah tabungan warga RW 021.</p>
                        </div>
                        <span class="text-xs font-extrabold text-emerald-700">Jadwal Timbang & Harga &rarr;</span>
                    </div>

                </div>

            </div>

        </div>
    </div>

    <!-- FOOTER -->
    <?php require base_path('views/partials/footer.php'); ?>

    <!-- MODAL DETAIL OVERLAY -->
    <div id="detail-modal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-hidden flex flex-col shadow-2xl animate-in">
            <!-- Modal Header -->
            <div id="modal-header-bg" class="px-6 py-5 bg-emerald-700 text-white flex justify-between items-center">
                <div>
                    <span id="modal-category" class="text-[10px] font-extrabold uppercase tracking-widest bg-white/20 px-2.5 py-0.5 rounded">TPST RW 021</span>
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
                        <h4 class="text-xs font-bold text-emerald-700 uppercase tracking-wider mb-2">Aturan & Operasional</h4>
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
                        <span id="modal-coordinator" class="text-xs font-bold text-emerald-700"></span>
                    </div>
                </div>

                <div class="pt-2">
                    <a id="modal-wa-btn" href="#" target="_blank" class="w-full py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl flex items-center justify-center gap-2 transition shadow-md">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.157 4.228 4.301-1.127z" />
                        </svg>
                        Hubungi Koordinator TPST via WhatsApp
                    </a>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end">
                <button type="button" onclick="closeModal()" class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold text-xs rounded-xl transition">Tutup</button>
            </div>
        </div>
    </div>

    <!-- SCRIPT DATA TPST -->
    <script>
        const modalData = {
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
            'bank-sampah': {
                category: 'Kebersihan Lingkungan (TPST)',
                title: 'Program Bank Sampah RW 021',
                headerBg: 'bg-emerald-700',
                description: 'Program pengolahan lingkungan berbasis ekonomi di mana warga menyetorkan sampah daur ulang terpilah menjadi saldo tabungan rupiah.',
                subitems: [
                    'Botol & Gelas Plastik Bersih',
                    'Kardus, Kertas Gazet, & Buku Bekas',
                    'Kaleng Alumunium & Besi Tua'
                ],
                requirements: [
                    'Membawa sampah terpisah sesuai kategori (plastik/kertas/besi)',
                    'Membawa Buku Tabungan Bank Sampah Warga'
                ],
                schedule: 'Posko TPST RW 021<br>Setiap Minggu Ke-2 & Ke-4 (Pukul 08.00 - 11.00 WIB)',
                coordinator: 'Sudarno (Bendahara RW - 081380126762)',
                wa: 'https://wa.me/6281380126762'
            }
        };

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