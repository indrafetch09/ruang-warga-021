#!/usr/bin/env php
<?php

use Core\Crypt;

const BASE_PATH = __DIR__ . '/../';

$config = require BASE_PATH . 'config.php';
require_once BASE_PATH . 'vendor/autoload.php';

$c = $config['database'];

$dsn = "mysql:host={$c['host']};port={$c['port']};dbname={$c['dbname']};charset={$c['charset']}";

/**
 * Cari ID baris berdasarkan satu kolom. Dipakai agar seeder aman dijalankan
 * berulang kali (idempotent) tanpa membuat data ganda.
 */
function fetchId(PDO $pdo, string $table, string $column, string $value): ?int
{
    $stmt = $pdo->prepare("SELECT id FROM `{$table}` WHERE `{$column}` = :value LIMIT 1");
    $stmt->execute(['value' => $value]);
    $id = $stmt->fetchColumn();

    return $id === false ? null : (int) $id;
}

try {
    $pdo = new PDO($dsn, $c['user'] ?? $c['username'], $c['pass'] ?? $c['password'], [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    echo "🌱 Seeding dummy data into [{$c['dbname']}]...\n\n";

    $pdo->beginTransaction();

    // =========================================================================
    // 1. WARGA (12 orang, 4 keluarga, campuran status verifikasi & RT)
    // =========================================================================
    $wargaDummy = [
        // Keluarga Budi Santoso - RT 01
        ['nik' => '3171010101010001', 'kk' => '3171010101010001', 'nama' => 'Budi Santoso', 'tempat_lahir' => 'Jakarta', 'tanggal_lahir' => '1985-03-12', 'jk' => 'L', 'rt' => '01', 'blok' => 'A', 'nomor' => '01', 'agama' => 'islam', 'pekerjaan' => 'Karyawan Swasta', 'status_keluarga' => 'kepala_keluarga', 'status' => 'verified'],
        ['nik' => '3171010101010002', 'kk' => '3171010101010001', 'nama' => 'Siti Aminah', 'tempat_lahir' => 'Bandung', 'tanggal_lahir' => '1988-07-21', 'jk' => 'P', 'rt' => '01', 'blok' => 'A', 'nomor' => '01', 'agama' => 'islam', 'pekerjaan' => 'Mengurus Rumah Tangga', 'status_keluarga' => 'istri', 'status' => 'verified'],
        ['nik' => '3171010101010003', 'kk' => '3171010101010001', 'nama' => 'Rizky Santoso', 'tempat_lahir' => 'Jakarta', 'tanggal_lahir' => '2012-11-05', 'jk' => 'L', 'rt' => '01', 'blok' => 'A', 'nomor' => '01', 'agama' => 'islam', 'pekerjaan' => 'Pelajar/Mahasiswa', 'status_keluarga' => 'anak', 'status' => 'verified'],

        // Keluarga Ahmad Fauzi - RT 02 (menunggu verifikasi)
        ['nik' => '3171010101010004', 'kk' => '3171010101010004', 'nama' => 'Ahmad Fauzi', 'tempat_lahir' => 'Surabaya', 'tanggal_lahir' => '1982-01-18', 'jk' => 'L', 'rt' => '02', 'blok' => 'B', 'nomor' => '04', 'agama' => 'islam', 'pekerjaan' => 'Wiraswasta', 'status_keluarga' => 'kepala_keluarga', 'status' => 'pending'],
        ['nik' => '3171010101010005', 'kk' => '3171010101010004', 'nama' => 'Nur Aisyah', 'tempat_lahir' => 'Surabaya', 'tanggal_lahir' => '1986-09-30', 'jk' => 'P', 'rt' => '02', 'blok' => 'B', 'nomor' => '04', 'agama' => 'islam', 'pekerjaan' => 'Mengurus Rumah Tangga', 'status_keluarga' => 'istri', 'status' => 'pending'],
        ['nik' => '3171010101010006', 'kk' => '3171010101010004', 'nama' => 'Dinda Fauzi', 'tempat_lahir' => 'Surabaya', 'tanggal_lahir' => '2015-04-14', 'jk' => 'P', 'rt' => '02', 'blok' => 'B', 'nomor' => '04', 'agama' => 'islam', 'pekerjaan' => 'Pelajar/Mahasiswa', 'status_keluarga' => 'anak', 'status' => 'pending'],

        // Keluarga Joko Susilo - RT 03
        ['nik' => '3171010101010007', 'kk' => '3171010101010007', 'nama' => 'Joko Susilo', 'tempat_lahir' => 'Semarang', 'tanggal_lahir' => '1979-06-08', 'jk' => 'L', 'rt' => '03', 'blok' => 'C', 'nomor' => '07', 'agama' => 'islam', 'pekerjaan' => 'Pedagang', 'status_keluarga' => 'kepala_keluarga', 'status' => 'verified'],
        ['nik' => '3171010101010008', 'kk' => '3171010101010007', 'nama' => 'Sri Wahyuni', 'tempat_lahir' => 'Yogyakarta', 'tanggal_lahir' => '1983-12-02', 'jk' => 'P', 'rt' => '03', 'blok' => 'C', 'nomor' => '07', 'agama' => 'islam', 'pekerjaan' => 'Guru', 'status_keluarga' => 'istri', 'status' => 'verified'],
        ['nik' => '3171010101010009', 'kk' => '3171010101010007', 'nama' => 'Bayu Susilo', 'tempat_lahir' => 'Semarang', 'tanggal_lahir' => '2009-02-25', 'jk' => 'L', 'rt' => '03', 'blok' => 'C', 'nomor' => '07', 'agama' => 'islam', 'pekerjaan' => 'Pelajar/Mahasiswa', 'status_keluarga' => 'anak', 'status' => 'rejected'],

        // Keluarga Hendra Gunawan - RT 04
        ['nik' => '3171010101010010', 'kk' => '3171010101010010', 'nama' => 'Hendra Gunawan', 'tempat_lahir' => 'Medan', 'tanggal_lahir' => '1980-10-10', 'jk' => 'L', 'rt' => '04', 'blok' => 'D', 'nomor' => '10', 'agama' => 'kristen', 'pekerjaan' => 'Karyawan BUMN', 'status_keluarga' => 'kepala_keluarga', 'status' => 'verified'],
        ['nik' => '3171010101010011', 'kk' => '3171010101010010', 'nama' => 'Maya Sari', 'tempat_lahir' => 'Medan', 'tanggal_lahir' => '1987-05-19', 'jk' => 'P', 'rt' => '04', 'blok' => 'D', 'nomor' => '10', 'agama' => 'kristen', 'pekerjaan' => 'Perawat', 'status_keluarga' => 'istri', 'status' => 'pending'],
        ['nik' => '3171010101010012', 'kk' => '3171010101010010', 'nama' => 'Sumarni', 'tempat_lahir' => 'Klaten', 'tanggal_lahir' => '1955-08-17', 'jk' => 'P', 'rt' => '04', 'blok' => 'D', 'nomor' => '10', 'agama' => 'islam', 'pekerjaan' => 'Pensiunan', 'status_keluarga' => 'orang_tua', 'status' => 'verified'],
    ];

    $insertWarga = $pdo->prepare(
        "INSERT INTO warga
            (nik, nik_kepala_keluarga, nama, tempat_lahir, tanggal_lahir, jenis_kelamin, rt, blok, nomor, agama, pekerjaan, status_keluarga, status_verifikasi, created_by, created_at)
         VALUES
            (:nik, :nik_kk, :nama, :tempat_lahir, :tanggal_lahir, :jenis_kelamin, :rt, :blok, :nomor, :agama, :pekerjaan, :status_keluarga, :status_verifikasi, 1, NOW())"
    );

    $wargaIds = [];
    $totalWargaBaru = 0;

    foreach ($wargaDummy as $w) {
        $existingId = fetchId($pdo, 'warga', 'nama', $w['nama']);

        if ($existingId !== null) {
            $wargaIds[$w['nama']] = $existingId;
            continue;
        }

        $insertWarga->execute([
            'nik'               => Crypt::encrypt($w['nik']),
            'nik_kk'            => Crypt::encrypt($w['kk']),
            'nama'              => $w['nama'],
            'tempat_lahir'      => $w['tempat_lahir'],
            'tanggal_lahir'     => $w['tanggal_lahir'],
            'jenis_kelamin'     => $w['jk'],
            'rt'                => $w['rt'],
            'blok'              => $w['blok'],
            'nomor'             => $w['nomor'],
            'agama'             => $w['agama'],
            'pekerjaan'         => $w['pekerjaan'],
            'status_keluarga'   => $w['status_keluarga'],
            'status_verifikasi' => $w['status'],
        ]);

        $wargaIds[$w['nama']] = (int) $pdo->lastInsertId();
        $totalWargaBaru++;
    }

    echo "  ✓ Warga        : {$totalWargaBaru} baris baru (total dummy " . count($wargaDummy) . ")\n";

    // =========================================================================
    // 2. PENGURUS (struktur organisasi RW 021)
    // =========================================================================
    $pengurusDummy = [
        ['nama' => 'Sumarni',       'jabatan' => 'Penasehat',                     'kategori_jabatan' => 'penasehat',    'urutan' => 1, 'periode' => '2025 - 2028'],
        ['nama' => 'Budi Santoso',  'jabatan' => 'Ketua RW 021',                  'kategori_jabatan' => 'ketua',        'urutan' => 2, 'periode' => '2025 - 2028'],
        ['nama' => 'Siti Aminah',   'jabatan' => 'Sekretaris',                    'kategori_jabatan' => 'sekretaris',   'urutan' => 3, 'periode' => '2025 - 2028'],
        ['nama' => 'Sri Wahyuni',   'jabatan' => 'Bendahara',                     'kategori_jabatan' => 'bendahara',    'urutan' => 4, 'periode' => '2025 - 2028'],
        ['nama' => 'Hendra Gunawan', 'jabatan' => 'Pembangunan & Infrastruktur',  'kategori_jabatan' => 'seksi',        'urutan' => 5, 'periode' => '2025 - 2028'],
        ['nama' => 'Joko Susilo',   'jabatan' => 'Keamanan & Ketertiban',         'kategori_jabatan' => 'seksi',        'urutan' => 5, 'periode' => '2025 - 2028'],
        ['nama' => 'Rizky Santoso', 'jabatan' => 'Humas',                         'kategori_jabatan' => 'seksi',        'urutan' => 5, 'periode' => '2025 - 2028'],
        ['nama' => 'Ahmad Fauzi',   'jabatan' => 'Ketua RT 001',                  'kategori_jabatan' => 'ketua_rt',     'urutan' => 7, 'periode' => '2025 - 2028'],
        ['nama' => 'Nur Aisyah',    'jabatan' => 'Ketua RT 002',                  'kategori_jabatan' => 'ketua_rt',     'urutan' => 7, 'periode' => '2025 - 2028'],
        ['nama' => 'Dinda Fauzi',   'jabatan' => 'Team Kebersihan',               'kategori_jabatan' => 'tim_pendukung', 'urutan' => 6, 'periode' => '2025 - 2028'],
    ];

    $insertPengurus = $pdo->prepare(
        "INSERT INTO pengurus (warga_id, nama, jabatan, kategori_jabatan, urutan, periode)
         VALUES (:warga_id, :nama, :jabatan, :kategori_jabatan, :urutan, :periode)"
    );

    $totalPengurusBaru = 0;

    foreach ($pengurusDummy as $p) {
        $exists = $pdo->prepare("SELECT id FROM pengurus WHERE nama = :nama AND jabatan = :jabatan LIMIT 1");
        $exists->execute(['nama' => $p['nama'], 'jabatan' => $p['jabatan']]);

        if ($exists->fetchColumn() !== false) {
            continue;
        }

        $insertPengurus->execute([
            'warga_id'         => $wargaIds[$p['nama']] ?? null,
            'nama'             => $p['nama'],
            'jabatan'          => $p['jabatan'],
            'kategori_jabatan' => $p['kategori_jabatan'],
            'urutan'           => $p['urutan'],
            'periode'          => $p['periode'],
        ]);

        $totalPengurusBaru++;
    }

    echo "  ✓ Pengurus     : {$totalPengurusBaru} baris baru (total dummy " . count($pengurusDummy) . ")\n";

    // =========================================================================
    // 3. NOTULENSI RAPAT
    // =========================================================================
    $notulensiDummy = [
        [
            'judul' => 'Rapat Rutin Evaluasi Keamanan Lingkungan',
            'kategori' => 'rutin',
            'no_surat' => '014/RW21/X/2026',
            'tanggal' => '2026-10-04',
            'waktu_mulai' => '19:30:00',
            'waktu_selesai' => '21:00:00',
            'lokasi' => 'Balai Warga RW 021',
            'notulis' => 'Siti Aminah',
            'agenda' => "1. Evaluasi jadwal ronda malam\n2. Laporan kejadian selama bulan September\n3. Rencana pemasangan CCTV di gerbang utama",
            'hasil_pembahasan' => "Ronda malam berjalan tertib, namun masih ada tiga jadwal yang kosong. Warga mengusulkan penambahan lampu penerangan di gang B dan C. Pemasangan CCTV akan dikoordinasikan dengan pengurus RT.",
            'keputusan_akhir' => "1. Jadwal ronda diperbarui dan ditempel di pos kamling\n2. Lampu penerangan gang ditambah maksimal 2 minggu\n3. Anggaran CCTV diajukan pada rapat berikutnya",
        ],
        [
            'judul' => 'Rapat Khusus Persiapan HUT RI ke-81',
            'kategori' => 'khusus',
            'no_surat' => '021/RW21/VIII/2026',
            'tanggal' => '2026-08-01',
            'waktu_mulai' => '20:00:00',
            'waktu_selesai' => '22:15:00',
            'lokasi' => 'Balai Warga RW 021',
            'notulis' => 'Rizky Santoso',
            'agenda' => "1. Pembentukan panitia HUT RI\n2. Penetapan anggaran kegiatan\n3. Penjadwalan lomba dan kerja bakti",
            'hasil_pembahasan' => "Panitia inti terbentuk dengan ketua dari karang taruna. Anggaran disepakati bersumber dari iuran warga dan sponsor UMKM sekitar. Lomba akan dilaksanakan selama dua hari di lapangan RW.",
            'keputusan_akhir' => "1. Panitia berjumlah 15 orang\n2. Iuran kegiatan Rp 50.000 per KK\n3. Kerja bakti serentak pada Minggu pertama Agustus",
        ],
        [
            'judul' => 'Laporan Kas Bulanan September 2026',
            'kategori' => 'laporan',
            'no_surat' => null,
            'tanggal' => '2026-09-30',
            'waktu_mulai' => '19:00:00',
            'waktu_selesai' => '20:00:00',
            'lokasi' => 'Sekretariat RW 021',
            'notulis' => 'Sri Wahyuni',
            'agenda' => "1. Saldo kas awal bulan\n2. Rincian pemasukan iuran warga\n3. Rincian pengeluaran operasional",
            'hasil_pembahasan' => "Pemasukan iuran bulan September tercatat dari 85 KK. Pengeluaran terbesar digunakan untuk perbaikan lampu jalan dan konsumsi kegiatan posyandu.",
            'keputusan_akhir' => "1. Saldo akhir kas dilaporkan dan disetujui\n2. Tunggakan iuran akan ditagih oleh ketua RT masing-masing",
        ],
    ];

    $insertNotulensi = $pdo->prepare(
        "INSERT INTO notulensi
            (judul, kategori, no_surat, tanggal, waktu_mulai, waktu_selesai, lokasi, notulis, agenda, hasil_pembahasan, keputusan_akhir, file_lampiran, created_at)
         VALUES
            (:judul, :kategori, :no_surat, :tanggal, :waktu_mulai, :waktu_selesai, :lokasi, :notulis, :agenda, :hasil_pembahasan, :keputusan_akhir, NULL, NOW())"
    );

    $totalNotulensiBaru = 0;

    foreach ($notulensiDummy as $n) {
        if (fetchId($pdo, 'notulensi', 'judul', $n['judul']) !== null) {
            continue;
        }

        $insertNotulensi->execute($n);
        $totalNotulensiBaru++;
    }

    echo "  ✓ Notulensi    : {$totalNotulensiBaru} baris baru (total dummy " . count($notulensiDummy) . ")\n";

    // =========================================================================
    // 4. GALERI KEGIATAN (file contoh diambil dari public/images)
    // =========================================================================
    $galeriDummy = [
        ['judul' => 'Kerja Bakti Membersihkan Saluran Air', 'tanggal' => '2026-09-14', 'kategori' => 'sosial', 'deskripsi' => 'Warga bergotong royong membersihkan saluran air dan area sekitar balai warga.', 'sumber' => 'balairw21.jpg', 'file' => 'dummy_kerja_bakti.jpg'],
        ['judul' => 'Senam Sehat Lansia RW 021', 'tanggal' => '2026-09-21', 'kategori' => 'kesehatan', 'deskripsi' => 'Kegiatan senam pagi bersama warga lansia di lapangan RW 021.', 'sumber' => 'senam.jpg', 'file' => 'dummy_senam_lansia.jpg'],
        ['judul' => 'Posyandu Balita Bulan September', 'tanggal' => '2026-09-25', 'kategori' => 'kesehatan', 'deskripsi' => 'Pelayanan penimbangan dan imunisasi balita di posyandu RW 021.', 'sumber' => 'posyandu.jpg', 'file' => 'dummy_posyandu.jpg'],
        ['judul' => 'Rapat Koordinasi Pengurus RT', 'tanggal' => '2026-10-02', 'kategori' => 'pertemuan', 'deskripsi' => 'Rapat koordinasi rutin pengurus RW dan ketua RT membahas program akhir tahun.', 'sumber' => 'rapat.jpg', 'file' => 'dummy_rapat_koordinasi.jpg'],
        ['judul' => 'Turnamen Badminton Antar RT', 'tanggal' => '2026-10-12', 'kategori' => 'perayaan', 'deskripsi' => 'Turnamen badminton dalam rangka mempererat kebersamaan antar warga RT.', 'sumber' => 'badminton.jpg', 'file' => 'dummy_badminton.jpg'],
        ['judul' => 'Kegiatan Keagamaan di Masjid RW 021', 'tanggal' => '2026-10-18', 'kategori' => 'lainnya', 'deskripsi' => 'Kajian rutin dan kegiatan keagamaan warga di Masjid Hayaatul Islam.', 'sumber' => 'masjid.jpg', 'file' => 'dummy_kajian_masjid.jpg'],
    ];

    $uploadDir = BASE_PATH . 'public/uploads/galeri/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $insertGaleri = $pdo->prepare(
        "INSERT INTO galeri (judul, tanggal, kategori, deskripsi, file_foto, created_at)
         VALUES (:judul, :tanggal, :kategori, :deskripsi, :file_foto, NOW())"
    );

    $totalGaleriBaru = 0;

    foreach ($galeriDummy as $g) {
        if (fetchId($pdo, 'galeri', 'judul', $g['judul']) !== null) {
            continue;
        }

        $sumber = BASE_PATH . 'public/images/' . $g['sumber'];
        $tujuan = $uploadDir . $g['file'];

        if (is_file($sumber) && !is_file($tujuan)) {
            @copy($sumber, $tujuan);
        }

        $insertGaleri->execute([
            'judul'     => $g['judul'],
            'tanggal'   => $g['tanggal'],
            'kategori'  => $g['kategori'],
            'deskripsi' => $g['deskripsi'],
            'file_foto' => $g['file'],
        ]);

        $totalGaleriBaru++;
    }

    echo "  ✓ Galeri       : {$totalGaleriBaru} baris baru (total dummy " . count($galeriDummy) . ")\n";

    // =========================================================================
    // 5. KEGIATAN RUTIN
    // =========================================================================
    $kegiatanDummy = [
        ['nama' => 'Kerja Bakti Lingkungan', 'hari' => 'minggu', 'kategori' => 'kebersihan', 'waktu' => '07:00 - 09:00', 'lokasi' => 'Area RW 021', 'frekuensi' => 'Setiap Minggu', 'deskripsi' => 'Membersihkan saluran air, taman, dan area umum bersama warga.', 'persyaratan' => 'Membawa alat kebersihan sendiri dan memakai pakaian kerja.'],
        ['nama' => 'Ronda Malam', 'hari' => 'sabtu', 'kategori' => 'keamanan', 'waktu' => '22:00 - 03:00', 'lokasi' => 'Pos Kamling RW 021', 'frekuensi' => 'Setiap Sabtu', 'deskripsi' => 'Patroli keliling lingkungan RW 021 bersama warga terjadwal.', 'persyaratan' => 'Warga laki-laki usia 18-60 tahun sesuai jadwal RT.'],
        ['nama' => 'Senam Sehat Warga', 'hari' => 'minggu', 'kategori' => 'sosial', 'waktu' => '06:00 - 07:30', 'lokasi' => 'Lapangan RW 021', 'frekuensi' => 'Setiap Minggu', 'deskripsi' => 'Senam pagi bersama untuk menjaga kebugaran warga.', 'persyaratan' => 'Terbuka untuk semua warga, membawa air minum.'],
        ['nama' => 'Posyandu Balita & Lansia', 'hari' => 'rabu', 'kategori' => 'sosial', 'waktu' => '08:00 - 11:00', 'lokasi' => 'Balai Warga RW 021', 'frekuensi' => 'Setiap Rabu pekan ke-2', 'deskripsi' => 'Penimbangan, imunisasi, dan pemeriksaan kesehatan ringan.', 'persyaratan' => 'Membawa buku KIA/KMS dan kartu identitas.'],
        ['nama' => 'Pengajian Rutin', 'hari' => 'jumat', 'kategori' => 'keagamaan', 'waktu' => "Ba'da Maghrib", 'lokasi' => 'Masjid Hayaatul Islam', 'frekuensi' => 'Setiap Jumat', 'deskripsi' => 'Kajian keislaman bersama ustaz setempat.', 'persyaratan' => 'Terbuka untuk seluruh warga muslim.'],
        ['nama' => 'Pelayanan Administrasi Warga', 'hari' => 'senin', 'kategori' => 'administrasi', 'waktu' => '08:00 - 15:00', 'lokasi' => 'Sekretariat RW 021', 'frekuensi' => 'Setiap Hari Kerja', 'deskripsi' => 'Pelayanan surat keterangan, domisili, dan administrasi warga.', 'persyaratan' => 'Membawa fotokopi KTP dan KK.'],
    ];

    $insertKegiatan = $pdo->prepare(
        "INSERT INTO kegiatan_rutin
            (nama_kegiatan, hari, kategori, waktu_pelaksanaan, lokasi, keterangan_frekuensi, deskripsi_singkat, persyaratan_ketentuan, created_at)
         VALUES
            (:nama_kegiatan, :hari, :kategori, :waktu_pelaksanaan, :lokasi, :keterangan_frekuensi, :deskripsi_singkat, :persyaratan_ketentuan, NOW())"
    );

    $totalKegiatanBaru = 0;

    foreach ($kegiatanDummy as $k) {
        if (fetchId($pdo, 'kegiatan_rutin', 'nama_kegiatan', $k['nama']) !== null) {
            continue;
        }

        $insertKegiatan->execute([
            'nama_kegiatan'         => $k['nama'],
            'hari'                  => $k['hari'],
            'kategori'              => $k['kategori'],
            'waktu_pelaksanaan'     => $k['waktu'],
            'lokasi'                => $k['lokasi'],
            'keterangan_frekuensi'  => $k['frekuensi'],
            'deskripsi_singkat'     => $k['deskripsi'],
            'persyaratan_ketentuan' => $k['persyaratan'],
        ]);

        $totalKegiatanBaru++;
    }

    echo "  ✓ Kegiatan     : {$totalKegiatanBaru} baris baru (total dummy " . count($kegiatanDummy) . ")\n";

    // =========================================================================
    // 6. PENGUMUMAN (semua kategori: urgent, kegiatan, info, umum)
    // =========================================================================
    $pengumumanDummy = [
        [
            'judul' => 'Perbaikan Jaringan Air Bersih pada Sabtu Pagi',
            'kategori' => 'urgent',
            'tanggal' => '2026-11-14',
            'pesan' => "Diberitahukan kepada seluruh warga RW 021 bahwa akan dilakukan perbaikan jaringan air bersih pada Sabtu, 14 November 2026 pukul 08.00 - 14.00 WIB.\n\nSelama proses perbaikan, aliran air ke beberapa blok akan dihentikan sementara. Mohon warga menyiapkan cadangan air.",
            'label' => null,
            'url' => null,
            'published' => 1,
        ],
        [
            'judul' => 'Kerja Bakti Serentak Akhir Bulan',
            'kategori' => 'kegiatan',
            'tanggal' => '2026-11-20',
            'pesan' => "Seluruh warga RW 021 diundang untuk mengikuti kerja bakti serentak pada Minggu, 22 November 2026 pukul 07.00 WIB.\n\nTitik kumpul di balai warga. Mohon membawa alat kebersihan masing-masing.",
            'label' => null,
            'url' => null,
            'published' => 1,
        ],
        [
            'judul' => 'Jadwal Posyandu Balita Bulan November',
            'kategori' => 'info',
            'tanggal' => '2026-11-10',
            'pesan' => "Posyandu balita dan lansia RW 021 akan dilaksanakan pada Rabu, 12 November 2026 pukul 08.00 - 11.00 WIB di Balai Warga.\n\nMohon membawa buku KIA/KMS dan kartu identitas.",
            'label' => 'Lihat Jadwal',
            'url' => 'https://example.com/jadwal-posyandu',
            'published' => 1,
        ],
        [
            'judul' => 'Pembayaran Iuran Warga Bulan November',
            'kategori' => 'umum',
            'tanggal' => '2026-11-01',
            'pesan' => "Pembayaran iuran warga bulan November 2026 dapat dilakukan kepada ketua RT masing-masing mulai tanggal 1 sampai 15 November 2026.\n\nBesaran iuran tetap Rp 50.000 per KK.",
            'label' => null,
            'url' => null,
            'published' => 1,
        ],
        [
            'judul' => 'Peringatan Cuaca Ekstrem dan Angin Kencang',
            'kategori' => 'urgent',
            'tanggal' => '2026-11-12',
            'pesan' => "BMKG memprediksi cuaca ekstrem berupa hujan lebat dan angin kencang di wilayah RW 021 selama tiga hari ke depan.\n\nMohon warga memangkas dahan pohon yang rawan tumbang dan memeriksa atap rumah.",
            'label' => null,
            'url' => null,
            'published' => 0,
        ],
        [
            'judul' => 'Layanan Administrasi Libur Tanggal 25 November',
            'kategori' => 'info',
            'tanggal' => '2026-11-18',
            'pesan' => "Pelayanan administrasi di sekretariat RW 021 akan libur pada Selasa, 25 November 2026.\n\nPelayanan kembali dibuka pada Rabu, 26 November 2026 pukul 08.00 WIB.",
            'label' => null,
            'url' => null,
            'published' => 0,
        ],
    ];

    $insertPengumuman = $pdo->prepare(
        "INSERT INTO pengumuman
            (judul, kategori, tanggal_publikasi, pesan, label_tombol, tautan_url, is_published, created_at)
         VALUES
            (:judul, :kategori, :tanggal_publikasi, :pesan, :label_tombol, :tautan_url, :is_published, NOW())"
    );

    $totalPengumumanBaru = 0;

    foreach ($pengumumanDummy as $p) {
        if (fetchId($pdo, 'pengumuman', 'judul', $p['judul']) !== null) {
            continue;
        }

        $insertPengumuman->execute([
            'judul'             => $p['judul'],
            'kategori'          => $p['kategori'],
            'tanggal_publikasi' => $p['tanggal'],
            'pesan'             => $p['pesan'],
            'label_tombol'      => $p['label'],
            'tautan_url'        => $p['url'],
            'is_published'      => $p['published'],
        ]);

        $totalPengumumanBaru++;
    }

    echo "  ✓ Pengumuman   : {$totalPengumumanBaru} baris baru (total dummy " . count($pengumumanDummy) . ")\n";

    // =========================================================================
    // 7. PROFIL RW (dipakai halaman Beranda / Tentang Kami)
    // =========================================================================
    $totalProfilBaru = 0;

    if ((int) $pdo->query("SELECT COUNT(*) FROM profil_rw")->fetchColumn() === 0) {
        $pdo->prepare(
            "INSERT INTO profil_rw (nama_rw, alamat, visi_misi, deskripsi)
             VALUES (:nama_rw, :alamat, :visi_misi, :deskripsi)"
        )->execute([
            'nama_rw'   => 'RW 021',
            'alamat'    => 'Jl. Persatuan Raya No. 21, Kelurahan Sukamaju, Kecamatan Cimanggis, Depok, Jawa Barat',
            'visi_misi' => "Visi:\nMenjadi lingkungan RW yang aman, sehat, rukun, dan berdaya saing.\n\nMisi:\n1. Meningkatkan keamanan dan ketertiban lingkungan.\n2. Mendorong partisipasi warga dalam kegiatan sosial.\n3. Meningkatkan kualitas pelayanan administrasi warga.",
            'deskripsi' => 'RW 021 merupakan lingkungan permukiman yang aktif dengan berbagai kegiatan warga, mulai dari kerja bakti, posyandu, kegiatan keagamaan, hingga kegiatan olahraga bersama.',
        ]);
        $totalProfilBaru = 1;
    }

    echo "  ✓ Profil RW    : {$totalProfilBaru} baris baru\n";

    // =========================================================================
    // 8. PESAN KONTAK (data masuk dari form hubungi kami)
    // =========================================================================
    $pesanDummy = [
        ['nama' => 'Andi Pratama', 'wa' => '081234567801', 'rt' => '01', 'kategori' => 'administrasi', 'pesan' => 'Selamat pagi, saya ingin menanyakan syarat pembuatan surat keterangan domisili. Terima kasih.'],
        ['nama' => 'Rina Marlina', 'wa' => '081234567802', 'rt' => '03', 'kategori' => 'pengaduan', 'pesan' => 'Mohon tindak lanjut lampu jalan di gang C yang sudah mati sejak seminggu terakhir.'],
        ['nama' => 'Dedi Kurniawan', 'wa' => '081234567803', 'rt' => '02', 'kategori' => 'saran', 'pesan' => 'Usulan agar diadakan kembali senam pagi bersama setiap minggu di lapangan RW.'],
    ];

    $insertPesan = $pdo->prepare(
        "INSERT INTO pesan_kontak (nama, no_whatsapp, rt_asal, kategori, pesan, tanggal_kirim)
         VALUES (:nama, :no_whatsapp, :rt_asal, :kategori, :pesan, NOW())"
    );

    $totalPesanBaru = 0;

    foreach ($pesanDummy as $m) {
        $exists = $pdo->prepare("SELECT id FROM pesan_kontak WHERE nama = :nama AND pesan = :pesan LIMIT 1");
        $exists->execute(['nama' => $m['nama'], 'pesan' => $m['pesan']]);

        if ($exists->fetchColumn() !== false) {
            continue;
        }

        $insertPesan->execute([
            'nama'        => $m['nama'],
            'no_whatsapp' => $m['wa'],
            'rt_asal'     => $m['rt'],
            'kategori'    => $m['kategori'],
            'pesan'       => $m['pesan'],
        ]);

        $totalPesanBaru++;
    }

    echo "  ✓ Pesan kontak : {$totalPesanBaru} baris baru (total dummy " . count($pesanDummy) . ")\n";

    $pdo->commit();

    echo "\n✓ Dummy data seeding completed successfully!\n";
} catch (Throwable $e) {
    if (isset($pdo) && $pdo->inTransaction()) {
        $pdo->rollBack();
    }

    echo "\n✗ Dummy data seeding failed: " . $e->getMessage() . "\n";
    exit(1);
}
