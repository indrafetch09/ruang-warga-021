<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tambah Kegiatan Rutin - Dasbor Pengurus RW 21</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <style>
        body {
            font-family: "Plus Jakarta Sans", sans-serif;
            background-color: #f8fafc;
        }

        .logo-container {
            border-radius: 0 0 16px 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            border: 1px solid #e9d5ff;
            border-top-width: 0;
        }
    </style>
</head>

<body class="text-gray-800 bg-gray-50 flex flex-col min-h-screen">
    <?php require base_path('views/partials/admin-header.php'); ?>

    <!-- WRAPPER SIDEBAR & MAIN CONTENT -->
    <div class="flex flex-1 max-w-[1400px] w-full mx-auto relative">
        <?php require base_path('views/partials/admin-sidebar.php'); ?>

        <main class="flex-1 w-full min-w-0 p-4 sm:p-6 lg:p-8 space-y-6">

    <!-- MAIN CONTENT -->
    <div class="py-10 flex-1">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
                <div>
                    <!-- Link kembali ke halaman utama dashboard atau manajemen jadwal -->
                    <a href="/dashboard"
                        class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-purple-600 transition mb-3 group">
                        <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke Dashboard
                    </a>
                    <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                        Tambah Kegiatan Rutin
                    </h2>
                    <p class="text-sm text-gray-500 mt-1">
                        Masukkan jadwal kegiatan mingguan yang akan tampil di panduan
                        warga.
                    </p>
                </div>
            </div>

            <!-- FORM CONTAINER -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <form action="#" method="POST">
                    <!-- Bagian 1: Detail Utama -->
                    <div class="p-6 md:p-8 border-b border-gray-100">
                        <h3 class="text-lg font-bold text-purple-700 mb-6 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                                </path>
                            </svg>
                            Informasi Kegiatan
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Kegiatan <span
                                        class="text-rose-500">*</span></label>
                                <input type="text" placeholder="Contoh: Senam Pagi, Ronda Malam, Pengajian"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition text-sm"
                                    required />
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Hari Pelaksanaan
                                    <span class="text-rose-500">*</span></label>
                                <select
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition text-sm cursor-pointer"
                                    required>
                                    <option value="" disabled selected>Pilih Hari</option>
                                    <option value="senin">Senin</option>
                                    <option value="selasa">Selasa</option>
                                    <option value="rabu">Rabu</option>
                                    <option value="kamis">Kamis</option>
                                    <option value="jumat">Jumat</option>
                                    <option value="sabtu">Sabtu</option>
                                    <option value="minggu">Minggu</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori Kegiatan
                                    <span class="text-rose-500">*</span></label>
                                <select
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition text-sm cursor-pointer"
                                    required>
                                    <option value="" disabled selected>
                                        Pilih Kategori (Ikon & Warna)
                                    </option>
                                    <option value="administrasi">
                                        Administrasi & Pelayanan (Ungu)
                                    </option>
                                    <option value="kebersihan">
                                        Kebersihan Lingkungan (Hijau)
                                    </option>
                                    <option value="keamanan">Keamanan & Ronda (Kuning)</option>
                                    <option value="sosial">Kesehatan & Sosial (Merah)</option>
                                    <option value="keagamaan">Keagamaan & Kajian (Biru)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Bagian 2: Waktu & Deskripsi -->
                    <div class="p-6 md:p-8">
                        <h3 class="text-lg font-bold text-emerald-600 mb-6 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Waktu & Keterangan Tambahan
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Waktu Pelaksanaan
                                    <span class="text-rose-500">*</span></label>
                                <p class="text-xs text-gray-500 mb-2">
                                    Bisa berupa rentang jam atau teks spesifik.
                                </p>
                                <input type="text" placeholder="Contoh: 19.00 - 21.00 atau Ba'da Isya"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition text-sm"
                                    required />
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Keterangan Frekuensi /
                                    Waktu</label>
                                <p class="text-xs text-gray-500 mb-2">
                                    Opsional. Misal: Minggu ke-1, Setiap Hari, dll.
                                </p>
                                <input type="text" placeholder="Contoh: Mg ke-1 atau Setiap Sabtu"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition text-sm" />
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Singkat</label>
                                <p class="text-xs text-gray-500 mb-2">
                                    Penjelasan singkat tentang kegiatan tersebut (maks. 2
                                    baris).
                                </p>
                                <textarea rows="3" placeholder="Contoh: Oleh petugas DLH / Surat pengantar, KTP, dll."
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition text-sm resize-none"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div
                        class="px-6 py-5 md:px-8 bg-gray-50 border-t border-gray-200 flex flex-col sm:flex-row-reverse gap-3">
                        <button type="submit"
                            class="px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white text-sm font-bold rounded-xl shadow-md shadow-purple-200 transition-all flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            Simpan Kegiatan
                        </button>
                        <a href="/dashboard"
                            class="px-6 py-3 bg-white border border-gray-300 hover:bg-gray-100 text-gray-700 text-sm font-bold rounded-xl transition-all text-center">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
