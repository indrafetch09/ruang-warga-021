<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tambah Dokumentasi Galeri - Dasbor Pengurus RW 21</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="/css/theme.css" />
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
                    <!-- Link kembali ke galeri (atau ke list admin galeri nantinya) -->
                    <a href="/galeri"
                        class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-purple-600 transition mb-3 group">
                        <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke Galeri
                    </a>
                    <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                        Unggah Dokumentasi
                    </h2>
                    <p class="text-sm text-gray-500 mt-1">
                        Tambahkan foto kegiatan warga terbaru untuk ditampilkan di Galeri.
                    </p>
                </div>
            </div>

            <!-- FORM CONTAINER -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <form action="#" method="POST" enctype="multipart/form-data">
                    <!-- Bagian 1: Upload Foto -->
                    <div class="p-6 md:p-8 border-b border-gray-100">
                        <h3 class="text-lg font-bold text-purple-700 mb-6 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            File Foto Kegiatan
                        </h3>

                        <div>
                            <div
                                class="mt-1 flex justify-center px-6 pt-8 pb-10 border-2 border-gray-300 border-dashed rounded-xl hover:bg-gray-50 hover:border-purple-300 transition cursor-pointer group">
                                <div class="space-y-2 text-center">
                                    <svg class="mx-auto h-16 w-16 text-gray-400 group-hover:text-purple-500 transition-colors"
                                        stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600 justify-center">
                                        <label for="image-upload"
                                            class="relative cursor-pointer bg-white rounded-md font-bold text-purple-600 hover:text-purple-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-purple-500 px-1">
                                            <span>Pilih gambar</span>
                                            <input id="image-upload" name="image-upload" type="file" class="sr-only"
                                                accept="image/png, image/jpeg, image/jpg" required />
                                        </label>
                                        <p class="pl-1">atau *drag and drop*</p>
                                    </div>
                                    <p class="text-xs text-gray-500 font-medium">
                                        Format JPG, JPEG, PNG maksimal 5MB. Disarankan lanskap
                                        (16:9).
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bagian 2: Detail Kegiatan -->
                    <div class="p-6 md:p-8 border-b border-gray-100">
                        <h3 class="text-lg font-bold text-emerald-600 mb-6 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Informasi Kegiatan
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Kegiatan <span
                                        class="text-rose-500">*</span></label>
                                <input type="text" placeholder="Contoh: Kerja Bakti Membersihkan Saluran Air"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition text-sm"
                                    required />
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Pelaksanaan
                                    <span class="text-rose-500">*</span></label>
                                <input type="date"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition text-sm text-gray-600"
                                    required />
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori Galeri <span
                                        class="text-rose-500">*</span></label>
                                <select
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition text-sm cursor-pointer"
                                    required>
                                    <option value="" disabled selected>Pilih Kategori</option>
                                    <option value="sosial">Sosial & Kebersihan</option>
                                    <option value="perayaan">Perayaan & Event</option>
                                    <option value="kesehatan">Kesehatan & Posyandu</option>
                                    <option value="pertemuan">Pertemuan / Rapat</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Bagian 3: Deskripsi -->
                    <div class="p-6 md:p-8">
                        <h3 class="text-lg font-bold text-sky-600 mb-6 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h7"></path>
                            </svg>
                            Deskripsi Lengkap
                        </h3>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Keterangan / Cerita Kegiatan
                                <span class="text-rose-500">*</span></label>
                            <p class="text-xs text-gray-500 mb-2">
                                Deskripsi ini akan muncul saat warga meng-klik foto di halaman
                                Galeri.
                            </p>
                            <textarea rows="5"
                                placeholder="Tuliskan keterangan detail mengenai acara ini, siapa yang hadir, dan apa tujuan kegiatannya..."
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition text-sm resize-none"
                                required></textarea>
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
                            Simpan ke Galeri
                        </button>
                        <a href="/galeri"
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
