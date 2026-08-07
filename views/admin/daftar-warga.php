<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Data Penduduk - Sistem Informasi RW 21</title>
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

        /* Custom Scrollbar untuk tabel */
        .table-container::-webkit-scrollbar {
            height: 8px;
        }

        .table-container::-webkit-scrollbar-track {
            background: #f3f4f6;
            border-radius: 8px;
        }

        .table-container::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 8px;
        }

        .table-container::-webkit-scrollbar-thumb:hover {
            background: #9ca3af;
        }
    </style>
</head>

<body class="bg-gray-50 flex flex-col min-h-screen text-gray-800">
    <?php require base_path('views/partials/admin-header.php'); ?>

    <!-- WRAPPER SIDEBAR & MAIN CONTENT -->
    <div class="flex flex-1 max-w-[1400px] w-full mx-auto relative">
        <?php require base_path('views/partials/admin-sidebar.php'); ?>

        <main class="flex-1 w-full min-w-0 p-4 sm:p-6 lg:p-8 space-y-6">
            <!-- PAGE HEADER -->
            <div class="bg-white p-6 rounded-2xl border border-purple-100 shadow-sm flex flex-col md:flex-row justify-between items-center gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">
                        Data <span class="text-purple-600">Penduduk RW 021</span>
                    </h1>
                    <p class="text-xs text-gray-500 mt-1">
                        Direktori daftar Kepala Keluarga (KK) dan data warga terdaftar.
                    </p>
                </div>
                <div class="flex gap-3">
                    <a href="/warga/create" class="px-4 py-2.5 bg-purple-600 hover:bg-purple-700 text-white font-bold rounded-[10px] text-xs transition shadow-sm flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Warga Baru
                    </a>
                </div>
            </div>
            <!-- Privacy Alert -->
            <div class="mb-8 p-4 bg-sky-50 border border-sky-100 rounded-xl flex gap-3 items-start">
                <div class="mt-0.5 text-sky-500 flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-sky-800">
                        Informasi Privasi Data
                    </h4>
                    <p class="text-xs text-sky-700 mt-1 leading-relaxed">
                        Tabel ini hanya menampilkan data umum kependudukan (Nama KK,
                        Alamat RT, Jumlah Anggota). Data spesifik seperti NIK, Nomor HP,
                        dan detail keluarga disembunyikan demi menjaga privasi warga.
                        Pengurus dapat melihat data lengkap melalui
                        <a href="/login" class="font-bold underline">Portal Admin</a>.
                    </p>
                </div>
            </div>

            <!-- Toolbar (Search & Filter) -->
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6">
                <div class="w-full md:w-1/3 relative">
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input type="text" placeholder="Cari nama Kepala Keluarga..."
                        class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition text-sm" />
                </div>

                <div class="w-full md:w-auto flex flex-col sm:flex-row gap-3">
                    <select
                        class="w-full sm:w-auto px-4 py-2.5 border border-gray-300 rounded-lg text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 bg-white cursor-pointer">
                        <option value="">Semua RT</option>
                        <option value="01">RT 01</option>
                        <option value="02">RT 02</option>
                        <option value="03">RT 03</option>
                        <option value="04">RT 04</option>
                        <option value="05">RT 05</option>
                    </select>

                    <select
                        class="w-full sm:w-auto px-4 py-2.5 border border-gray-300 rounded-lg text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 bg-white cursor-pointer">
                        <option value="">Status Warga</option>
                        <option value="tetap">Warga Tetap</option>
                        <option value="kontrak">Warga Kontrak / Kos</option>
                    </select>
                </div>
            </div>

            <!-- Tabel Data -->
            <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
                <div class="overflow-x-auto table-container">
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                        <thead>
                            <tr
                                class="bg-gray-50 border-b border-gray-200 text-xs uppercase tracking-wider text-gray-500 font-bold">
                                <th class="px-6 py-4">No</th>
                                <th class="px-6 py-4">Kepala Keluarga</th>
                                <th class="px-6 py-4">Blok / No. Rumah</th>
                                <th class="px-6 py-4 text-center">RT</th>
                                <th class="px-6 py-4 text-center">Jml. Anggota</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                            <!-- Row 1 -->
                            <tr class="hover:bg-purple-50/50 transition-colors">
                                <td class="px-6 py-4 font-medium text-gray-400">1</td>
                                <td class="px-6 py-4 font-bold text-gray-900">
                                    Agus Setiawan
                                </td>
                                <td class="px-6 py-4">Blok A No. 12</td>
                                <td class="px-6 py-4 text-center font-semibold">01</td>
                                <td class="px-6 py-4 text-center">4 Orang</td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        Tetap
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <button
                                        class="text-purple-600 hover:text-purple-800 font-semibold text-xs px-3 py-1.5 rounded-md hover:bg-purple-100 transition">
                                        Detail
                                    </button>
                                </td>
                            </tr>

                            <!-- Row 2 -->
                            <tr class="hover:bg-purple-50/50 transition-colors">
                                <td class="px-6 py-4 font-medium text-gray-400">2</td>
                                <td class="px-6 py-4 font-bold text-gray-900">
                                    Budi Purnomo
                                </td>
                                <td class="px-6 py-4">Blok B No. 05</td>
                                <td class="px-6 py-4 text-center font-semibold">02</td>
                                <td class="px-6 py-4 text-center">3 Orang</td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        Tetap
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <button
                                        class="text-purple-600 hover:text-purple-800 font-semibold text-xs px-3 py-1.5 rounded-md hover:bg-purple-100 transition">
                                        Detail
                                    </button>
                                </td>
                            </tr>

                            <!-- Row 3 -->
                            <tr class="hover:bg-purple-50/50 transition-colors">
                                <td class="px-6 py-4 font-medium text-gray-400">3</td>
                                <td class="px-6 py-4 font-bold text-gray-900">
                                    Citra Kirana
                                </td>
                                <td class="px-6 py-4">Blok A No. 18</td>
                                <td class="px-6 py-4 text-center font-semibold">01</td>
                                <td class="px-6 py-4 text-center">2 Orang</td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold bg-amber-100 text-amber-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                        Kontrak
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <button
                                        class="text-purple-600 hover:text-purple-800 font-semibold text-xs px-3 py-1.5 rounded-md hover:bg-purple-100 transition">
                                        Detail
                                    </button>
                                </td>
                            </tr>

                            <!-- Row 4 -->
                            <tr class="hover:bg-purple-50/50 transition-colors">
                                <td class="px-6 py-4 font-medium text-gray-400">4</td>
                                <td class="px-6 py-4 font-bold text-gray-900">Dedi Jumadi</td>
                                <td class="px-6 py-4">Blok C No. 02</td>
                                <td class="px-6 py-4 text-center font-semibold">03</td>
                                <td class="px-6 py-4 text-center">5 Orang</td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        Tetap
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <button
                                        class="text-purple-600 hover:text-purple-800 font-semibold text-xs px-3 py-1.5 rounded-md hover:bg-purple-100 transition">
                                        Detail
                                    </button>
                                </td>
                            </tr>

                            <!-- Row 5 -->
                            <tr class="hover:bg-purple-50/50 transition-colors">
                                <td class="px-6 py-4 font-medium text-gray-400">5</td>
                                <td class="px-6 py-4 font-bold text-gray-900">
                                    Eko Prasetyo
                                </td>
                                <td class="px-6 py-4">Blok D No. 10</td>
                                <td class="px-6 py-4 text-center font-semibold">04</td>
                                <td class="px-6 py-4 text-center">1 Orang</td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold bg-amber-100 text-amber-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                        Kos
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <button
                                        class="text-purple-600 hover:text-purple-800 font-semibold text-xs px-3 py-1.5 rounded-md hover:bg-purple-100 transition">
                                        Detail
                                    </button>
                                </td>
                            </tr>

                            <!-- Row 6 -->
                            <tr class="hover:bg-purple-50/50 transition-colors">
                                <td class="px-6 py-4 font-medium text-gray-400">6</td>
                                <td class="px-6 py-4 font-bold text-gray-900">
                                    Faisal Rahman
                                </td>
                                <td class="px-6 py-4">Blok E No. 22</td>
                                <td class="px-6 py-4 text-center font-semibold">05</td>
                                <td class="px-6 py-4 text-center">4 Orang</td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        Tetap
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <button
                                        class="text-purple-600 hover:text-purple-800 font-semibold text-xs px-3 py-1.5 rounded-md hover:bg-purple-100 transition">
                                        Detail
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Footer -->
                <div
                    class="px-6 py-4 border-t border-gray-200 bg-gray-50 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="text-sm text-gray-500">
                        Menampilkan <span class="font-bold text-gray-900">1</span> sampai
                        <span class="font-bold text-gray-900">6</span> dari
                        <span class="font-bold text-gray-900">350</span> data
                    </div>
                    <div class="flex items-center gap-2">
                        <button
                            class="px-3 py-1.5 border border-gray-300 rounded-md text-sm font-medium text-gray-400 cursor-not-allowed bg-white"
                            disabled>
                            Sebelumnya
                        </button>
                        <button
                            class="px-3 py-1.5 border border-purple-600 bg-purple-600 text-white rounded-md text-sm font-bold shadow-sm">
                            1
                        </button>
                        <button
                            class="px-3 py-1.5 border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 rounded-md text-sm font-medium transition">
                            2
                        </button>
                        <button
                            class="px-3 py-1.5 border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 rounded-md text-sm font-medium transition">
                            3
                        </button>
                        <span class="text-gray-400">...</span>
                        <button
                            class="px-3 py-1.5 border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 rounded-md text-sm font-medium transition">
                            Selanjutnya
                        </button>
                    </div>
                </div>
        </main>
    </div>
</body>
</html>
