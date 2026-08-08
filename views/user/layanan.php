<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Panduan Layanan Warga - Ruang Warga 021</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="/css/theme.css" />
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">

    <?php require base_path('views/partials/navbar.php'); ?>

    <!-- HEADER -->
    <div class="bg-purple-50 py-12 border-b border-purple-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-block px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-xs font-bold tracking-wide uppercase mb-3">Layanan Digital Warga</span>
            <h1 class="text-4xl font-extrabold text-gray-900 mb-2">Panduan <span class="text-purple-600">Layanan Kependudukan & Kebersihan</span></h1>
            <p class="text-gray-600 max-w-2xl mx-auto">Klik kartu di bawah ini untuk melihat syarat, rincian jenis surat (KTP, KK, SKTM, Pindah), dan pengangkutan sampah TPST.</p>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="py-12 flex-1">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">

            <!-- SECTION 1: Administrasi Kependudukan -->
            <div id="administrasi" class="scroll-mt-28 bg-white p-8 md:p-10 rounded-2xl shadow-sm border border-purple-100">
                <div class="flex items-center gap-4 mb-6 border-b border-gray-100 pb-4">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">1. Administrasi Kependudukan</h2>
                        <p class="text-sm text-gray-500">Klik kartu di bawah ini untuk melihat rincian surat pengantar (KTP, KK, SKTM, Pindah, dll.), syarat, dan prosedur.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-4">
                    
                    <!-- Card 1: Surat Pengantar RW -->
                    <div onclick="openModal('surat-pengantar')" class="p-6 bg-purple-50/50 rounded-2xl border border-purple-100 hover:border-purple-400 hover:shadow-md hover:-translate-y-1 transition duration-200 cursor-pointer flex flex-col justify-between group">
                        <div>
                            <div class="flex justify-between items-start mb-3">
                                <span class="text-xs font-bold bg-purple-100 text-purple-800 px-2.5 py-1 rounded-full group-hover:bg-purple-600 group-hover:text-white transition">Lihat Detail</span>
                            </div>
                            <h3 class="font-bold text-gray-900 text-base mb-2 group-hover:text-purple-700 transition">Surat Pengantar RW</h3>
                            <p class="text-xs text-gray-600 mb-4 leading-relaxed">Pengurusan KTP, KK, Surat Pindah, SKTM Beasiswa/BPJS, Pengantar Nikah, & Kematian.</p>
                        </div>
                        <span class="text-xs font-extrabold text-purple-700">Rincian Dokumen & Syarat &rarr;</span>
                    </div>

                    <!-- Card 2: Pendaftaran Warga Baru -->
                    <div onclick="openModal('warga-baru')" class="p-6 bg-purple-50/50 rounded-2xl border border-purple-100 hover:border-purple-400 hover:shadow-md hover:-translate-y-1 transition duration-200 cursor-pointer flex flex-col justify-between group">
                        <div>
                            <div class="flex justify-between items-start mb-3">
                                <span class="text-xs font-bold bg-purple-100 text-purple-800 px-2.5 py-1 rounded-full group-hover:bg-purple-600 group-hover:text-white transition">Lihat Detail</span>
                            </div>
                            <h3 class="font-bold text-gray-900 text-base mb-2 group-hover:text-purple-700 transition">Pendaftaran Warga Baru</h3>
                            <p class="text-xs text-gray-600 mb-4 leading-relaxed">Pendataan bagi penghuni tetap baru, penyewa rumah/kontrakan, atau indekos RW 021.</p>
                        </div>
                        <span class="text-xs font-extrabold text-purple-700">Prosedur Pendataan &rarr;</span>
                    </div>

                    <!-- Card 3: Legalisasi Dokumen -->
                    <div onclick="openModal('legalisasi')" class="p-6 bg-purple-50/50 rounded-2xl border border-purple-100 hover:border-purple-400 hover:shadow-md hover:-translate-y-1 transition duration-200 cursor-pointer flex flex-col justify-between group">
                        <div>
                            <div class="flex justify-between items-start mb-3">
                                <span class="text-xs font-bold bg-purple-100 text-purple-800 px-2.5 py-1 rounded-full group-hover:bg-purple-600 group-hover:text-white transition">Lihat Detail</span>
                            </div>
                            <h3 class="font-bold text-gray-900 text-base mb-2 group-hover:text-purple-700 transition">Legalisasi & Stempel RW</h3>
                            <p class="text-xs text-gray-600 mb-4 leading-relaxed">Pengesahan dan stempel basah Ketua RW 021 untuk berkas kedinasan / umum.</p>
                        </div>
                        <span class="text-xs font-extrabold text-purple-700">Jam Layanan & Syarat &rarr;</span>
                    </div>

                </div>
            </div>

            <!-- SECTION 2: Kebersihan Lingkungan (TPST) -->
            <div id="tpst" class="scroll-mt-28 bg-white p-8 md:p-10 rounded-2xl shadow-sm border border-emerald-100">
                <div class="flex items-center gap-4 mb-6 border-b border-gray-100 pb-4">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">2. Kebersihan Lingkungan (TPST)</h2>
                        <p class="text-sm text-gray-500">Klik kartu di bawah untuk detail pengangkutan sampah rumah tangga dan program Bank Sampah.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div onclick="openModal('tpst-jadwal')" class="p-6 bg-emerald-50/50 rounded-2xl border border-emerald-100 hover:border-emerald-400 hover:shadow-md hover:-translate-y-1 transition duration-200 cursor-pointer flex flex-col justify-between group">
                        <div>
                            <div class="flex justify-between items-start mb-3">
                                <span class="text-xs font-bold bg-emerald-100 text-emerald-800 px-2.5 py-1 rounded-full group-hover:bg-emerald-600 group-hover:text-white transition">Lihat Detail</span>
                            </div>
                            <h3 class="font-bold text-gray-900 text-lg mb-2 group-hover:text-emerald-700 transition">Jadwal Pengangkatan Sampah</h3>
                            <p class="text-xs text-gray-600 mb-4">Pemisahan pengangkutan sampah organik harian dan anorganik mingguan.</p>
                        </div>
                        <span class="text-xs font-extrabold text-emerald-700">Rincian Aturan & Jam Tempuh &rarr;</span>
                    </div>

                    <div onclick="openModal('bank-sampah')" class="p-6 bg-emerald-50/50 rounded-2xl border border-emerald-100 hover:border-emerald-400 hover:shadow-md hover:-translate-y-1 transition duration-200 cursor-pointer flex flex-col justify-between group">
                        <div>
                            <div class="flex justify-between items-start mb-3">
                                <span class="text-xs font-bold bg-emerald-100 text-emerald-800 px-2.5 py-1 rounded-full group-hover:bg-emerald-600 group-hover:text-white transition">Lihat Detail</span>
                            </div>
                            <h3 class="font-bold text-gray-900 text-lg mb-2 group-hover:text-emerald-700 transition">Program Bank Sampah RW 021</h3>
                            <p class="text-xs text-gray-600 mb-4">Setor botol plastik, kardus, dan kaleng menjadi saldo rupiah tabungan warga.</p>
                        </div>
                        <span class="text-xs font-extrabold text-emerald-700">Jadwal Penimbangan & Daftar Harga &rarr;</span>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- MODAL POPUP INTERAKTIF -->
    <div id="detail-modal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-2xl rounded-2xl shadow-2xl overflow-hidden animate-in fade-in zoom-in duration-200 max-h-[90vh] flex flex-col">
            <!-- Modal Header -->
            <div id="modal-header-bg" class="px-6 py-5 bg-purple-700 text-white flex justify-between items-center">
                <div>
                    <span id="modal-category" class="text-[10px] font-bold tracking-wider uppercase opacity-80">Administrasi RW</span>
                    <h3 id="modal-title" class="text-xl font-bold leading-tight">Surat Pengantar RW</h3>
                </div>
                <button type="button" onclick="closeModal()" class="text-white/80 hover:text-white text-2xl font-bold p-1">&times;</button>
            </div>

            <!-- Modal Content (Scrollable) -->
            <div class="p-6 space-y-6 overflow-y-auto flex-1 text-sm text-gray-700">
                <!-- Deskripsi -->
                <div>
                    <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Penjelasan Layanan</h4>
                    <p id="modal-description" class="leading-relaxed text-gray-800 font-medium">Deskripsi penjelasan singkat.</p>
                </div>

                <!-- Rincian Dokumen / Sub-Item -->
                <div id="modal-subitems-container" class="bg-purple-50/50 p-4 rounded-xl border border-purple-100">
                    <h4 class="text-xs font-bold text-purple-900 uppercase tracking-wider mb-2">Dokumen / Jenis Layanan Dilayani</h4>
                    <ul id="modal-subitems" class="space-y-2 text-xs font-semibold text-purple-950">
                        <!-- Filled by JS -->
                    </ul>
                </div>

                <!-- Syarat & Prosedur -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-4 bg-gray-50 rounded-xl border border-gray-200">
                        <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Persyaratan Dokumen</h4>
                        <ul id="modal-requirements" class="text-xs text-gray-700 space-y-1.5 font-medium">
                            <!-- Filled by JS -->
                        </ul>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-xl border border-gray-200">
                        <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Jam Layanan & Lokasi</h4>
                        <p id="modal-schedule" class="text-xs text-gray-700 font-semibold leading-relaxed">Jadwal layanan.</p>
                    </div>
                </div>

                <!-- Penanggung Jawab / Koordinator -->
                <div class="p-4 bg-emerald-50 rounded-xl border border-emerald-200 flex justify-between items-center">
                    <div>
                        <span class="text-[10px] font-bold uppercase text-emerald-800">Koordinator / Penanggung Jawab</span>
                        <p id="modal-coordinator" class="font-bold text-emerald-950 text-sm">Syahdian Gusti Akbar (Ketua RW)</p>
                    </div>
                    <a id="modal-wa-btn" href="https://wa.me/6282299007700" target="_blank" rel="noopener noreferrer" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold rounded-[10px] transition shadow-sm flex items-center gap-1">
                        Chat WA
                    </a>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end">
                <button type="button" onclick="closeModal()" class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold text-xs rounded-[10px] transition">Tutup Detail</button>
            </div>
        </div>
    </div>

    <script>
        const modalData = {
            'surat-pengantar': {
                category: 'Administrasi Kependudukan',
                title: 'Surat Pengantar RW 021',
                headerBg: 'bg-purple-700',
                description: 'Surat pengantar resmi dari Pengurus RW 021 Bojong Nangka untuk pengurusan berbagai dokumen kependudukan sipil di tingkat Kelurahan dan Kecamatan.',
                subitems: [
                    'Pembuatan & Perpanjangan KTP-el Baru / Rusak / Hilang',
                    'Pembuatan & Perubahan Kartu Keluarga (KK)',
                    'Surat Keterangan Pindah Masuk / Keluar Wilayah',
                    'Surat Keterangan Tidak Mampu (SKTM) untuk Beasiswa & BPJS',
                    'Surat Pengantar Nikah / Numpang Nikah',
                    'Surat Keterangan Kematian & Kelahiran'
                ],
                requirements: [
                    'Fotokopi KTP & Kartu Keluarga (KK) Pemohon',
                    'Surat Pengantar Asli dari Ketua RT setempat',
                    'Pas Foto 3x4 (2 Lembar) bila diperlukan',
                    'Surat Kehilangan dari Kepolisian (khusus KTP/KK Hilang)'
                ],
                schedule: 'Balai Warga RW 021 / Rumah Ketua RT-RW<br>Setiap Hari (Pukul 19.00 - 21.00 WIB)',
                coordinator: 'Galih Wirapati (Sekretaris RW - 087888872828)',
                wa: 'https://wa.me/6287888872828'
            },
            'warga-baru': {
                category: 'Administrasi Kependudukan',
                title: 'Pendaftaran & Pendataan Warga Baru',
                headerBg: 'bg-purple-700',
                description: 'Layanan pendaftaran dan pendataan hak domisili bagi warga tetap baru, penyewa rumah/kontrakan, maupun indekos di wilayah RW 021.',
                subitems: [
                    'Pencatatan Warga Tetap Domisili Baru',
                    'Pendataan Penyewa Kontrakan / Indekos',
                    'Verifikasi Status Tinggal oleh Pengurus RT/RW'
                ],
                requirements: [
                    'Fotokopi KTP & KK Asal Pemohon',
                    'Surat Keterangan Pindah dari Daerah Asal (khusus warga tetap)',
                    'Surat Perjanjian Sewa/Kontrak (khusus penyewa)',
                    'Mengisi Form Pendataan Warga Ruang Warga 021'
                ],
                schedule: 'Pelaporan max 2x24 jam ke Ketua RT setempat dilanjutkan ke Sekretariat RW 021.',
                coordinator: 'Syahdian Gusti Akbar (Ketua RW - 082299007700)',
                wa: 'https://wa.me/6282299007700'
            },
            'legalisasi': {
                category: 'Administrasi Kependudukan',
                title: 'Legalisasi & Stempel Basah RW',
                headerBg: 'bg-purple-700',
                description: 'Pengesahan tanda tangan dan stempel basah resmi Ketua RW 021 untuk berbagai keperluan berkas dinas, umum, dan perizinan lingkungan.',
                subitems: [
                    'Legalisasi Permohonan Beasiswa & Bantuan Pemerintah',
                    'Surat Keterangan Domisili Usaha / UMKM',
                    'Penandatanganan Berkas Perizinan Lingkungan'
                ],
                requirements: [
                    'Berkas Asli yang sudah ditandatangani Ketua RT',
                    'Fotokopi KTP Pemohon yang masih berlaku'
                ],
                schedule: 'Balai Warga RW 021<br>Pukul 19.00 - 21.00 WIB',
                coordinator: 'Syahdian Gusti Akbar (Ketua RW - 082299007700)',
                wa: 'https://wa.me/6282299007700'
            },
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
                coordinator: 'Tim Kebersihan TPST RW 021',
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
            
            // Render subitems
            const subitemsContainer = document.getElementById('modal-subitems');
            subitemsContainer.innerHTML = '';
            data.subitems.forEach(item => {
                const li = document.createElement('li');
                li.innerText = item;
                subitemsContainer.appendChild(li);
            });

            // Render requirements
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

        // Auto open modal from URL query param ?detail=key
        window.addEventListener('DOMContentLoaded', () => {
            const urlParams = new URLSearchParams(window.location.search);
            const detailKey = urlParams.get('detail');
            if (detailKey && modalData[detailKey]) {
                openModal(detailKey);
            }
        });

        // Close on backdrop click
        document.getElementById('detail-modal').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });
    </script>

</body>
</html>
