<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Warga;
use Core\App;
use Core\Database;
use Core\Crypt;
use Core\Session;
use Core\Authenticator;
use Core\Csrf;

class WargaController
{
    private function getCurrentUser()
    {
        $userData = Authenticator::user() ?? Session::get('user') ?? ['id' => 1, 'username' => 'rw021', 'role' => 'pengurus_rw', 'rt_assigned' => null];

        if (is_object($userData) && method_exists($userData, 'isRw')) {
            return $userData;
        }

        $data = is_object($userData) ? get_object_vars($userData) : $userData;

        return new class($data) {
            public array $data;
            public int $id;
            public string $role;
            public ?int $rtAssigned;

            public function __construct($d)
            {
                $this->data       = $d;
                $this->id         = (int)($d['id'] ?? 1);
                $this->role       = strtolower($d['role'] ?? 'pengurus_rw');
                $this->rtAssigned = isset($d['rt_assigned']) ? (int)$d['rt_assigned'] : (isset($d['rt']) ? (int)$d['rt'] : null);
            }

            public function isRw(): bool
            {
                return in_array($this->role, ['admin', 'pengurus_rw', 'rw']);
            }

            public function isRt(): bool
            {
                return in_array($this->role, ['pengurus_rt', 'rt']);
            }

            public function getRtAssigned(): ?int
            {
                return $this->rtAssigned;
            }

            public function __get($name)
            {
                return $this->data[$name] ?? null;
            }
        };
    }

    public function index()
    {
        $user = $this->getCurrentUser();
        $wargaList   = [];
        $pendingList = [];

        if ($user->isRw()) {
            $wargaList   = Warga::getByStatus('verified');
            $pendingList = Warga::getByStatus('pending');
        } else if ($user->isRt()) {
            $rtAssigned  = $user->getRtAssigned();
            $wargaList   = Warga::getByRtAndStatus($rtAssigned, 'verified');
            $pendingList = Warga::getByRtAndStatus($rtAssigned, 'pending');
        }

        $decryptData = function ($wargaArray) {
            foreach ($wargaArray as $w) {
                $rawNik   = is_object($w) ? ($w->nik ?? '') : ($w['nik'] ?? '');
                $rawNikKk = is_object($w) ? ($w->nik_kepala_keluarga ?? '') : ($w['nik_kepala_keluarga'] ?? '');

                $nikAsli   = Crypt::decrypt($rawNik);
                $nikKkAsli = Crypt::decrypt($rawNikKk);

                $readableNik   = ($nikAsli !== false && !empty($nikAsli)) ? $nikAsli : $rawNik;
                $readableNikKk = ($nikKkAsli !== false && !empty($nikKkAsli)) ? $nikKkAsli : $rawNikKk;

                if (is_object($w)) {
                    $w->nik_readable    = $readableNik;
                    $w->nik_kk_readable = $readableNikKk;
                } else {
                    $w['nik_readable']    = $readableNik;
                    $w['nik_kk_readable'] = $readableNikKk;
                }
            }
            return $wargaArray;
        };

        return view('admin/daftar-warga.php', [
            'user'        => $user,
            'wargaList'   => $decryptData($wargaList),
            'pendingList' => $decryptData($pendingList)
        ]);
    }

    public function create()
    {
        $user = $this->getCurrentUser();
        return view('admin/tambah-warga.php', ['user' => $user]);
    }

    public function store()
    {
        if (!Csrf::verify($_POST['_csrf_token'] ?? null)) {
            Session::flash('error', 'Sesi keamanan telah kadaluarsa. Silakan coba lagi.');
            return redirect('/admin/warga/create');
        }

        $user = $this->getCurrentUser();
        $db   = App::resolve(Database::class);

        $nikRaw   = trim($_POST['nik'] ?? '');
        $nikKkRaw = trim($_POST['nik_kepala_keluarga'] ?? '');

        $allowedStatus = ['kepala_keluarga', 'istri', 'anak', 'orang_tua', 'famili_lain'];
        $statusKeluarga = strtolower(trim($_POST['status_keluarga'] ?? 'famili_lain'));
        if (!in_array($statusKeluarga, $allowedStatus)) {
            $statusKeluarga = 'famili_lain';
        }

        $nikAman   = Crypt::encrypt($nikRaw);
        $nikKkAman = Crypt::encrypt($nikKkRaw);

        $statusVerifikasi = $user->isRw() ? 'verified' : 'pending';
        $rtVal = $user->isRt() ? $user->getRtAssigned() : ($_POST['rt'] ?? 1);
        $rtFormatted = sprintf('%02d', (int)$rtVal);

        $pekerjaan = trim($_POST['pekerjaan'] ?? 'Karyawan Swasta');

        $db->query(
            "INSERT INTO " . (Warga::$table ?? 'warga') . "
            (nik, nik_kepala_keluarga, nama, tempat_lahir, tanggal_lahir, jenis_kelamin, rt, blok, nomor, agama, pekerjaan, status_keluarga, status_verifikasi, created_by, created_at)
            VALUES
            (:nik, :nik_kepala_keluarga, :nama, :tempat_lahir, :tanggal_lahir, :jenis_kelamin, :rt, :blok, :nomor, :agama, :pekerjaan, :status_keluarga, :status_verifikasi, :created_by, NOW())",
            [
                'nik'                 => $nikAman,
                'nik_kepala_keluarga' => $nikKkAman,
                'nama'                => trim($_POST['nama'] ?? ''),
                'tempat_lahir'        => !empty($_POST['tempat_lahir']) ? trim($_POST['tempat_lahir']) : null,
                'tanggal_lahir'       => !empty($_POST['tanggal_lahir']) ? $_POST['tanggal_lahir'] : null,
                'jenis_kelamin'       => $_POST['jenis_kelamin'] ?? null,
                'rt'                  => $rtFormatted,
                'blok'                => trim($_POST['blok'] ?? ''),
                'nomor'               => trim($_POST['nomor'] ?? ''),
                'agama'               => $_POST['agama'] ?? null,
                'pekerjaan'           => !empty($pekerjaan) ? $pekerjaan : 'Karyawan Swasta',
                'status_keluarga'     => $statusKeluarga,
                'status_verifikasi'   => $statusVerifikasi,
                'created_by'          => $user->id
            ]
        );

        if ($user->isRt()) {
            Session::flash('sukses', 'Pengajuan warga baru berhasil dikirim dan menunggu persetujuan (ACC) dari RW.');
        } else {
            Session::flash('sukses', 'Data warga baru berhasil disimpan.');
        }

        return redirect('/admin/warga');
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            abort(404);
        }

        $user = $this->getCurrentUser();
        $db   = App::resolve(Database::class);
        $warga = $db->query("SELECT * FROM warga WHERE id = :id", ['id' => $id])->find();

        if (!$warga) {
            abort(404);
        }

        $nikAsli   = Crypt::decrypt($warga['nik'] ?? '');
        $nikKkAsli = Crypt::decrypt($warga['nik_kepala_keluarga'] ?? '');

        $warga['nik_readable']    = ($nikAsli !== false && !empty($nikAsli)) ? $nikAsli : ($warga['nik'] ?? '');
        $warga['nik_kk_readable'] = ($nikKkAsli !== false && !empty($nikKkAsli)) ? $nikKkAsli : ($warga['nik_kepala_keluarga'] ?? '');

        return view('admin/edit-warga.php', [
            'user'  => $user,
            'warga' => $warga
        ]);
    }

    public function update()
    {
        if (!Csrf::verify($_POST['_csrf_token'] ?? null)) {
            Session::flash('error', 'Sesi keamanan telah kadaluarsa. Silakan coba lagi.');
            return redirect('/admin/warga');
        }

        $id = $_POST['id'] ?? null;
        if (!$id) {
            abort(404);
        }

        $user = $this->getCurrentUser();
        $db   = App::resolve(Database::class);

        $nikRaw   = trim($_POST['nik'] ?? '');
        $nikKkRaw = trim($_POST['nik_kepala_keluarga'] ?? '');

        $allowedStatus = ['kepala_keluarga', 'istri', 'anak', 'orang_tua', 'famili_lain'];
        $statusKeluarga = strtolower(trim($_POST['status_keluarga'] ?? 'famili_lain'));
        if (!in_array($statusKeluarga, $allowedStatus)) {
            $statusKeluarga = 'famili_lain';
        }

        $nikAman   = Crypt::encrypt($nikRaw);
        $nikKkAman = Crypt::encrypt($nikKkRaw);

        $rtVal = $user->isRt() ? $user->getRtAssigned() : ($_POST['rt'] ?? 1);
        $rtFormatted = sprintf('%02d', (int)$rtVal);
        $pekerjaan = trim($_POST['pekerjaan'] ?? 'Karyawan Swasta');

        $db->query(
            "UPDATE " . (Warga::$table ?? 'warga') . " SET 
                nik = :nik,
                nik_kepala_keluarga = :nik_kepala_keluarga,
                nama = :nama,
                tempat_lahir = :tempat_lahir,
                tanggal_lahir = :tanggal_lahir,
                jenis_kelamin = :jenis_kelamin,
                rt = :rt,
                blok = :blok,
                nomor = :nomor,
                agama = :agama,
                pekerjaan = :pekerjaan,
                status_keluarga = :status_keluarga
            WHERE id = :id",
            [
                'id'                  => $id,
                'nik'                 => $nikAman,
                'nik_kepala_keluarga' => $nikKkAman,
                'nama'                => trim($_POST['nama'] ?? ''),
                'tempat_lahir'        => !empty($_POST['tempat_lahir']) ? trim($_POST['tempat_lahir']) : null,
                'tanggal_lahir'       => !empty($_POST['tanggal_lahir']) ? $_POST['tanggal_lahir'] : null,
                'jenis_kelamin'       => $_POST['jenis_kelamin'] ?? null,
                'rt'                  => $rtFormatted,
                'blok'                => trim($_POST['blok'] ?? ''),
                'nomor'               => trim($_POST['nomor'] ?? ''),
                'agama'               => $_POST['agama'] ?? null,
                'pekerjaan'           => !empty($pekerjaan) ? $pekerjaan : 'Karyawan Swasta',
                'status_keluarga'     => $statusKeluarga,
            ]
        );

        Session::flash('sukses', 'Data warga berhasil diperbarui!');
        return redirect('/admin/warga');
    }

    public function approve()
    {
        if (!Csrf::verify($_POST['_csrf_token'] ?? null)) {
            Session::flash('error', 'Sesi keamanan telah kadaluarsa.');
            return redirect('/admin/warga');
        }

        $user = $this->getCurrentUser();
        if (!$user->isRw()) {
            abort(403);
        }

        $wargaId = $_POST['warga_id'] ?? null;
        if ($wargaId) {
            $db = App::resolve(Database::class);
            $db->query("UPDATE " . (Warga::$table ?? 'warga') . " SET status_verifikasi = 'verified' WHERE id = :id", [
                'id' => $wargaId
            ]);
            Session::flash('sukses', 'Data warga berhasil diverifikasi (ACC).');
        }

        return redirect('/admin/warga');
    }

    public function reject()
    {
        if (!Csrf::verify($_POST['_csrf_token'] ?? null)) {
            Session::flash('error', 'Sesi keamanan telah kadaluarsa.');
            return redirect('/admin/warga');
        }

        $user = $this->getCurrentUser();
        if (!$user->isRw()) {
            abort(403);
        }

        $wargaId = $_POST['warga_id'] ?? null;
        if ($wargaId) {
            $db = App::resolve(Database::class);
            $db->query("UPDATE " . (Warga::$table ?? 'warga') . " SET status_verifikasi = 'rejected' WHERE id = :id", [
                'id' => $wargaId
            ]);
            Session::flash('sukses', 'Pengajuan data warga telah ditolak.');
        }

        return redirect('/admin/warga');
    }

    public function destroy()
    {
        if (!Csrf::verify($_POST['_csrf_token'] ?? null)) {
            Session::flash('error', 'Sesi keamanan telah kadaluarsa.');
            return redirect('/admin/warga');
        }

        $wargaId = $_POST['id'] ?? $_POST['warga_id'] ?? null;
        if ($wargaId) {
            $db = App::resolve(Database::class);
            $db->query("DELETE FROM " . (Warga::$table ?? 'warga') . " WHERE id = :id", [
                'id' => $wargaId
            ]);
            Session::flash('sukses', 'Data warga berhasil dihapus.');
        }

        return redirect('/admin/warga');
    }


    /**
     * IMPORT CERDAS: Universal Address Parser (Blok/Jalan/Gang & No)
     */
    public function import()
    {
        if (!Csrf::verify($_POST['_csrf_token'] ?? null)) {
            Session::flash('error', 'Sesi keamanan telah kadaluarsa. Silakan coba lagi.');
            return redirect('/admin/warga');
        }

        if (empty($_FILES['file_import']['tmp_name']) || $_FILES['file_import']['error'] !== UPLOAD_ERR_OK) {
            Session::flash('error', 'Silakan pilih file CSV / Excel yang valid.');
            return redirect('/admin/warga');
        }

        $user = $this->getCurrentUser();
        $db   = App::resolve(Database::class);
        $file = $_FILES['file_import']['tmp_name'];

        $handle = fopen($file, 'r');
        if (!$handle) {
            Session::flash('error', 'Gagal membaca file.');
            return redirect('/admin/warga');
        }

        // 1. CEK FILE EXCEL BINARY (.XLSX)
        $firstBytes = fread($handle, 4);
        rewind($handle);
        if ($firstBytes === "PK\x03\x04") {
            fclose($handle);
            Session::flash('error', 'File masih berformat .xlsx murni. Buka file di Excel, klik Save As, lalu pilih format CSV (Comma delimited) (*.csv).');
            return redirect('/admin/warga');
        }

        // 2. DETEKSI DELIMITER (; atau , atau TAB)
        $sampleText = "";
        for ($i = 0; $i < 5; $i++) {
            $sampleText .= fgets($handle);
        }
        rewind($handle);

        $delimiter = ';';
        $countSemicolon = substr_count($sampleText, ';');
        $countComma     = substr_count($sampleText, ',');
        $countTab       = substr_count($sampleText, "\t");

        if ($countTab > $countSemicolon && $countTab > $countComma) {
            $delimiter = "\t";
        } elseif ($countComma > $countSemicolon) {
            $delimiter = ',';
        }

        // 3. SCAN BARIS HEADER DENGAN FILTER PROTEKSI
        $headerMap = [];
        $maxHeaderScan = 15;

        for ($scan = 0; $scan < $maxHeaderScan; $scan++) {
            $row = fgetcsv($handle, 4000, $delimiter);
            if (!$row) break;

            $rowString = strtolower(implode(' ', $row));
            if (str_contains($rowString, 'nama') || str_contains($rowString, 'nik') || str_contains($rowString, 'alamat')) {
                foreach ($row as $idx => $colName) {
                    $clean = strtolower(trim(preg_replace('/[\xEF\xBB\xBF\r\n\t]/', ' ', $colName)));
                    $clean = preg_replace('/\([^)]*\)/', '', $clean);
                    $clean = trim(preg_replace('/[^a-z0-9_ ]/', '', $clean));

                    // Abaikan kolom orang tua / ayah / ibu
                    if (str_contains($clean, 'orang tua') || str_contains($clean, 'ayah') || str_contains($clean, 'ibu') || str_contains($clean, 'wali')) {
                        continue;
                    }

                    // Proteksi nomor urut baris (NO / NO. / NO URUT) agar tidak tertukar nomor rumah
                    if ($clean === 'no' || $clean === 'no.' || $clean === 'no urut' || $clean === 'nomor urut') {
                        continue;
                    }

                    if (str_contains($clean, 'nik kk') || str_contains($clean, 'no kk')) {
                        $headerMap['nik_kk'] = $idx;
                    } elseif (str_contains($clean, 'nik') || str_contains($clean, 'ktp') || str_contains($clean, 'induk')) {
                        $headerMap['nik'] = $idx;
                    } elseif ($clean === 'nama' || $clean === 'nama lengkap' || $clean === 'nama warga' || str_contains($clean, 'nama')) {
                        if (!isset($headerMap['nama'])) {
                            $headerMap['nama'] = $idx;
                        }
                    } elseif (str_contains($clean, 'tempat') || str_contains($clean, 'ttl') || str_contains($clean, 'lahir')) {
                        $headerMap['ttl'] = $idx;
                    } elseif (str_contains($clean, 'kelamin') || str_contains($clean, 'jk') || str_contains($clean, 'gender')) {
                        $headerMap['jenis_kelamin'] = $idx;
                    } elseif (str_contains($clean, 'alamat') || str_contains($clean, 'domisili')) {
                        $headerMap['alamat'] = $idx;
                    } elseif ($clean === 'rt' || str_contains($clean, 'rukun tetangga')) {
                        $headerMap['rt'] = $idx;
                    } elseif (str_contains($clean, 'blok')) {
                        $headerMap['blok'] = $idx;
                    } elseif (str_contains($clean, 'no rumah') || str_contains($clean, 'nomor rumah')) {
                        $headerMap['nomor'] = $idx;
                    } elseif (str_contains($clean, 'agama')) {
                        $headerMap['agama'] = $idx;
                    } elseif (str_contains($clean, 'status') || str_contains($clean, 'hubungan') || str_contains($clean, 'shdk')) {
                        $headerMap['status_keluarga'] = $idx;
                    } elseif (str_contains($clean, 'pekerjaan') || str_contains($clean, 'profesi')) {
                        $headerMap['pekerjaan'] = $idx;
                    }
                }
                break;
            }
        }

        // 4. SANITASI ENUM PEKERJAAN
        $validPekerjaanList = [
            'Pegawai Negeri Sipil (PNS)',
            'Tentara Nasional Indonesia (TNI)',
            'Kepolisian RI (POLRI)',
            'Anggota DPR-RI',
            'Anggota DPD',
            'Anggota BPK',
            'Presiden',
            'Wakil Presiden',
            'Anggota Mahkamah Konstitusi',
            'Anggota Kabinet / Kementerian',
            'Duta Besar / Kepala Perwakilan',
            'Gubernur',
            'Wakil Gubernur',
            'Bupati',
            'Wakil Bupati',
            'Walikota',
            'Wakil Walikota',
            'Anggota DPRD Propinsi',
            'Anggota DPRD Kabupaten / Kota',
            'Anggota Lembaga Tinggi Lainnya',
            'Perangkat Desa',
            'Kepala Desa',
            'Belum/Tidak Bekerja',
            'Mengurus Rumah Tangga',
            'Pelajar/Mahasiswa',
            'Pensiunan',
            'Karyawan Swasta',
            'Wiraswasta',
            'Pedagang',
            'Karyawan BUMN',
            'Karyawan BUMD',
            'Karyawan Honorer',
            'Perdagangan',
            'Pialang',
            'Manajer',
            'Konsultan',
            'Pengacara',
            'Notaris',
            'Akuntan',
            'Penterjemah',
            'Guru',
            'Dosen',
            'Peneliti',
            'Asisten Ahli',
            'Dokter',
            'Perawat',
            'Bidan',
            'Apoteker',
            'Psikiater / Psikolog',
            'Tabib',
            'Paraji',
            'Industri',
            'Konstruksi',
            'Tenaga Tata Usaha',
            'Buruh Harian Lepas',
            'Pekerja Pengolahan, Kerajinan',
            'Mekanik',
            'Teknisi',
            'Operator',
            'Pilot',
            'Pelaut',
            'Sopir',
            'Transportasi',
            'Pembantu Rumah Tangga',
            'Tukang Cukur',
            'Tukang Listrik',
            'Tukang Batu',
            'Tukang Kayu',
            'Tukang Sol Sepatu',
            'Tukang Las / Pandai Besi',
            'Tukang Jahit',
            'Tukang Gigi',
            'Penata Rias',
            'Penata Busana',
            'Penata Rambut',
            'Juru Masak',
            'Cheff',
            'Arsitek',
            'Wartawan',
            'Seniman',
            'Artis',
            'Perancang Busana',
            'Penyiar Televisi',
            'Penyiar Radio',
            'Promotor Acara',
            'Ustadz / Mubaligh',
            'Imam Masjid',
            'Pendeta',
            'Pastor',
            'Biarawati',
            'Paranormal',
            'Petani / Pekebun',
            'Peternak',
            'Nelayan / Perikanan',
            'Buruh Tani / Perkebunan',
            'Buruh Nelayan / Perikanan',
            'Buruh Peternakan',
            'Atlet',
            'Lainnya'
        ];

        $normalizePekerjaan = function ($raw) use ($validPekerjaanList) {
            $clean = preg_replace('/[\r\n\t]+/', ' ', (string)$raw);
            $clean = preg_replace('/\s+/', ' ', $clean);
            $clean = trim($clean);

            if (empty($clean)) return 'Karyawan Swasta';

            if (str_contains($clean, '-')) {
                $parts = explode('-', $clean);
                $clean = trim(end($parts));
            }

            $lower = strtolower($clean);

            foreach ($validPekerjaanList as $item) {
                if (strtolower($item) === $lower) return $item;
            }

            if (str_contains($lower, 'swasta') || str_contains($lower, 'karyawan')) return 'Karyawan Swasta';
            if (str_contains($lower, 'rumah tangga') || str_contains($lower, 'irt') || str_contains($lower, 'pengurus rumah') || str_contains($lower, 'mengurus')) return 'Mengurus Rumah Tangga';
            if (str_contains($lower, 'pelajar') || str_contains($lower, 'mahasis')) return 'Pelajar/Mahasiswa';
            if (str_contains($lower, 'blm') || str_contains($lower, 'belum') || str_contains($lower, 'tidak bekerja')) return 'Belum/Tidak Bekerja';
            if (str_contains($lower, 'wira') || str_contains($lower, 'usaha')) return 'Wiraswasta';
            if (str_contains($lower, 'pns') || str_contains($lower, 'pegawai negeri') || str_contains($lower, 'asn')) return 'Pegawai Negeri Sipil (PNS)';
            if (str_contains($lower, 'dokter')) return 'Dokter';
            if (str_contains($lower, 'perawat')) return 'Perawat';
            if (str_contains($lower, 'bidan')) return 'Bidan';
            if (str_contains($lower, 'bumn')) return 'Karyawan BUMN';
            if (str_contains($lower, 'bumd')) return 'Karyawan BUMD';
            if (str_contains($lower, 'honorer')) return 'Karyawan Honorer';
            if (str_contains($lower, 'guru')) return 'Guru';
            if (str_contains($lower, 'dosen')) return 'Dosen';
            if (str_contains($lower, 'tni') || str_contains($lower, 'tentara')) return 'Tentara Nasional Indonesia (TNI)';
            if (str_contains($lower, 'polri') || str_contains($lower, 'polisi')) return 'Kepolisian RI (POLRI)';
            if (str_contains($lower, 'dagang') || str_contains($lower, 'pedagang')) return 'Pedagang';
            if (str_contains($lower, 'pensiun')) return 'Pensiunan';
            if (str_contains($lower, 'buruh')) return 'Buruh Harian Lepas';
            if (str_contains($lower, 'sopir') || str_contains($lower, 'driver')) return 'Sopir';
            if (str_contains($lower, 'tani') || str_contains($lower, 'kebun')) return 'Petani / Pekebun';

            return 'Lainnya';
        };

        // 5. UNIVERSAL SMART ADDRESS PARSER (Jalan / Gang / Blok & Nomor Rumah)
        $parseUniversalAlamat = function ($alamatRaw, $blokInput = '', $nomorInput = '') {
            $blok  = !empty($blokInput) ? trim($blokInput) : '';
            $nomor = !empty($nomorInput) ? trim($nomorInput) : '';

            if (!empty($alamatRaw)) {
                $raw = preg_replace('/[\r\n\t]+/', ' ', (string)$alamatRaw);
                $raw = trim(preg_replace('/\s+/', ' ', $raw));

                // A. Ekstraksi Nomor Rumah
                if (empty($nomor) || $nomor === '-') {
                    // Pola: "NO. 11", "NO 11A", "NOMOR: 12", "NO. G/455"
                    if (preg_match('/(?:NO\.?|NOMOR|KAV\.?|UNIT)\s*[:.]?\s*([0-9A-Z\/\-\.]+)/i', $raw, $mNo)) {
                        $nomor = trim($mNo[1], " .,-");
                    }
                    // Pola: " - G/455" atau " - 455" di ujung string
                    elseif (preg_match('/-\s*([0-9A-Z\/\.]+)$/i', $raw, $mNo)) {
                        $nomor = trim($mNo[1], " .,-");
                    }
                    // Pola slash di akhir seperti "TA. 14/11"
                    elseif (preg_match('/\/([0-9A-Z\-]+)$/i', $raw, $mNo)) {
                        $nomor = trim($mNo[1], " .,-");
                    }
                }

                // B. Ekstraksi Blok / Jalan / Gang
                if (empty($blok) || $blok === '-') {
                    // Pola Jalan / Gang (misal: "JL. JELAMBAR BARAT II - G/455" atau "GG. KANCIL NO. 5")
                    if (preg_match('/(?:JL\.?|JALAN|GG\.?|GANG|KOMP\.?|KOMPLEK)\s+([A-Z0-9\.\s\/-]+?)(?=\s*(?:NO|NOMOR|RT|RW|-|\/|,|$))/i', $raw, $mJl)) {
                        $blok = trim($mJl[0], " -.,");
                    }
                    // Pola Blok Perumahan (misal: "BLOK TA. 14 NO. 11", "BLOK B 2")
                    elseif (preg_match('/(?:BLOK|BLK)\s*[:.]?\s*([A-Z0-9\.\s\/-]+?)(?=\s*(?:NO|NOMOR|RT|RW|-|\/|,|$))/i', $raw, $mBlok)) {
                        $cleanBlok = trim(str_replace(['.', ':'], '', $mBlok[1]));
                        $blok = trim($cleanBlok, " -.,");
                    }
                    // Pola Umum (Bersihkan nama perumahan di depan, nomor, dan RT/RW)
                    else {
                        $cleaned = preg_replace('/(?:NO\.?|NOMOR|KAV\.?|UNIT)\s*[:.]?\s*[0-9A-Z\/\-\.]+/i', '', $raw);
                        $cleaned = preg_replace('/-\s*[0-9A-Z\/\.]+$/i', '', $cleaned);
                        $cleaned = preg_replace('/RT\.?\s*[0-9]+\s*(?:RW\.?\s*[0-9]+)?/i', '', $cleaned);
                        $cleaned = trim(preg_replace('/^[^,]+,\s*/', '', $cleaned)); // Hapus nama perumahan depan
                        $cleaned = trim($cleaned, " ,.-");
                        $blok = !empty($cleaned) ? $cleaned : '-';
                    }
                }
            }

            $blokFinal  = !empty($blok) ? mb_substr($blok, 0, 20) : '-';
            $nomorFinal = !empty($nomor) ? mb_substr($nomor, 0, 20) : '-';

            return [$blokFinal, $nomorFinal];
        };

        // 6. SANITASI STATUS HUBUNGAN KELUARGA
        $normalizeStatusKeluarga = function ($raw) {
            $clean = strtolower(trim(preg_replace('/[\r\n\t\s]+/', ' ', (string)$raw)));
            if (str_contains($clean, 'kepala') || str_contains($clean, 'suami')) return 'kepala_keluarga';
            if (str_contains($clean, 'istri')) return 'istri';
            if (str_contains($clean, 'anak')) return 'anak';
            if (str_contains($clean, 'orang tua') || str_contains($clean, 'mertua') || str_contains($clean, 'ayah') || str_contains($clean, 'ibu')) return 'orang_tua';
            return 'famili_lain';
        };

        $allowedAgama = ['islam', 'kristen', 'katolik', 'hindu', 'buddha', 'konghucu'];
        $suksesCount = 0;
        $statusVerifikasi = $user->isRw() ? 'verified' : 'pending';
        $currentKepalaKeluargaNik = null;

        // 7. PROSES EKSEKUSI DATA
        while (($row = fgetcsv($handle, 4000, $delimiter)) !== false) {
            $row = array_map(function ($v) {
                $v = preg_replace('/[\r\n\t]+/', ' ', (string)$v);
                return trim(preg_replace('/\s+/', ' ', $v), " '\"");
            }, $row);

            if (empty(array_filter($row))) continue;

            $nikRaw       = $row[$headerMap['nik'] ?? 3] ?? '';
            $nikKkRaw     = $row[$headerMap['nik_kk'] ?? -1] ?? '';
            $nama         = $row[$headerMap['nama'] ?? 2] ?? '';
            $alamatRaw    = $row[$headerMap['alamat'] ?? 1] ?? '';
            $ttlRaw       = $row[$headerMap['ttl'] ?? 5] ?? '';
            $jkRaw        = $row[$headerMap['jenis_kelamin'] ?? 4] ?? '';
            $rtInput      = $row[$headerMap['rt'] ?? -1] ?? '';
            $blokInput    = $row[$headerMap['blok'] ?? -1] ?? '';
            $nomorInput   = $row[$headerMap['nomor'] ?? -1] ?? '';
            $agamaRaw     = $row[$headerMap['agama'] ?? 6] ?? '';
            $statusRaw    = $row[$headerMap['status_keluarga'] ?? 9] ?? '';
            $pekerjaanRaw = $row[$headerMap['pekerjaan'] ?? 8] ?? '';

            if (empty($nikRaw) || empty($nama) || strtolower($nama) === 'nama' || strtolower($nikRaw) === 'nik') {
                continue;
            }

            // Normalisasi Hubungan Keluarga
            $statusKeluarga = $normalizeStatusKeluarga($statusRaw);
            if ($statusKeluarga === 'kepala_keluarga') {
                $currentKepalaKeluargaNik = $nikRaw;
                $nikKkFinal = $nikRaw;
            } else {
                $nikKkFinal = !empty($nikKkRaw) ? $nikKkRaw : ($currentKepalaKeluargaNik ?? $nikRaw);
            }

            // Universal Address Parsing
            [$blok, $nomor] = $parseUniversalAlamat($alamatRaw, $blokInput, $nomorInput);

            if (empty($rtInput) && preg_match('/RT\.?\s*([0-9]+)/i', $alamatRaw, $mRt)) {
                $rtInput = $mRt[1];
            }

            // Ekstraksi TTL
            $tempatLahir = null;
            $tglFormatted = date('Y-m-d');

            if (!empty($ttlRaw)) {
                if (str_contains($ttlRaw, ',')) {
                    $parts = explode(',', $ttlRaw, 2);
                    $tempatLahir = trim($parts[0]);
                    $tglLahirStr = trim($parts[1]);
                } else {
                    $tglLahirStr = $ttlRaw;
                }

                if (preg_match('/(\d{1,2})[-\/](\d{1,2})[-\/](\d{4})/', $tglLahirStr, $mDate)) {
                    $tglFormatted = sprintf('%04d-%02d-%02d', (int)$mDate[3], (int)$mDate[2], (int)$mDate[1]);
                } elseif (preg_match('/(\d{4})[-\/](\d{1,2})[-\/](\d{1,2})/', $tglLahirStr, $mDate)) {
                    $tglFormatted = sprintf('%04d-%02d-%02d', (int)$mDate[1], (int)$mDate[2], (int)$mDate[3]);
                }
            }

            // RT & Gender
            $rtNum = (int)preg_replace('/[^0-9]/', '', (string)$rtInput);
            $rtNumber = $user->isRt() ? (int)$user->getRtAssigned() : ($rtNum > 0 ? $rtNum : 8);
            $rtFormatted = sprintf('%02d', max(1, min(10, $rtNumber)));

            $upperJk = strtoupper($jkRaw);
            $jenisKelamin = (str_starts_with($upperJk, 'P') || str_contains($upperJk, 'PEREMPUAN') || str_contains($upperJk, 'WANITA')) ? 'P' : 'L';
            $agama = in_array(strtolower($agamaRaw), $allowedAgama) ? strtolower($agamaRaw) : 'islam';

            $pekerjaan = $normalizePekerjaan($pekerjaanRaw);

            // Enkripsi
            $nikAman   = Crypt::encrypt($nikRaw);
            $nikKkAman = Crypt::encrypt($nikKkFinal);

            // Simpan ke Database
            $db->query(
                "INSERT INTO " . (Warga::$table ?? 'warga') . "
                (nik, nik_kepala_keluarga, nama, tempat_lahir, tanggal_lahir, jenis_kelamin, rt, blok, nomor, agama, pekerjaan, status_keluarga, status_verifikasi, created_by, created_at)
                VALUES
                (:nik, :nik_kepala_keluarga, :nama, :tempat_lahir, :tanggal_lahir, :jenis_kelamin, :rt, :blok, :nomor, :agama, :pekerjaan, :status_keluarga, :status_verifikasi, :created_by, NOW())",
                [
                    'nik'                 => $nikAman,
                    'nik_kepala_keluarga' => $nikKkAman,
                    'nama'                => $nama,
                    'tempat_lahir'        => $tempatLahir,
                    'tanggal_lahir'       => $tglFormatted,
                    'jenis_kelamin'       => $jenisKelamin,
                    'rt'                  => $rtFormatted,
                    'blok'                => $blok,
                    'nomor'               => $nomor,
                    'agama'               => $agama,
                    'pekerjaan'           => $pekerjaan,
                    'status_keluarga'     => $statusKeluarga,
                    'status_verifikasi'   => $statusVerifikasi,
                    'created_by'          => $user->id
                ]
            );

            $suksesCount++;
        }

        fclose($handle);

        if ($suksesCount === 0) {
            Session::flash('error', 'Tidak ada data warga yang berhasil diimpor.');
        } else {
            Session::flash('sukses', "Berhasil mengimpor {$suksesCount} data warga ke database!");
        }

        return redirect('/admin/warga');
    }
}
