-- Database Setup: RW 021
-- Run: mysql -u root -p < database/setup.sql

CREATE DATABASE IF NOT EXISTS `rw021`
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE `rw021`;

-- ponytail: role defaults to 'user', no RBAC table needed for 2 roles
CREATE TABLE IF NOT EXISTS `users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `name` VARCHAR(255) NULL,
  `role` ENUM('admin','user') NOT NULL DEFAULT 'user',
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `rt` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `no_rt` INT UNSIGNED NOT NULL,
  `ketua` VARCHAR(255) NULL,
  `no_hp` VARCHAR(50) NULL,
  `total_kk` INT DEFAULT 0,
  `alamat_sekretariat` TEXT NULL,
  `catatan` TEXT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `warga` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nik` VARCHAR(16) NOT NULL UNIQUE,
  `nama` VARCHAR(255) NOT NULL,
  `alamat` TEXT NOT NULL,
  `rt_id` INT UNSIGNED NULL,
  `status` VARCHAR(50) DEFAULT 'aktif',
  `keterangan` TEXT NULL,
  `nik_kk` VARCHAR(16) NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`rt_id`) REFERENCES `rt`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `notes` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `body` TEXT NOT NULL,
  `user_id` INT UNSIGNED NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `app_settings` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` VARCHAR(100) NOT NULL UNIQUE,
  `value` TEXT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Laporan Bulanan (monthly report for kelurahan)
CREATE TABLE IF NOT EXISTS `laporan_bulanan` (
  `id`         INT UNSIGNED    NOT NULL AUTO_INCREMENT,
  `bulan`      TINYINT UNSIGNED NOT NULL COMMENT '1-12',
  `tahun`      SMALLINT UNSIGNED NOT NULL,

  -- I. PENDIDIKAN
  `pend_tk`             INT DEFAULT 0,
  `pend_sd`             INT DEFAULT 0,
  `pend_smp`            INT DEFAULT 0,
  `pend_sma`            INT DEFAULT 0,
  `pend_d1d3`           INT DEFAULT 0,
  `pend_sarjana`        INT DEFAULT 0,
  `pend_s2`             INT DEFAULT 0,
  `pend_s3`             INT DEFAULT 0,
  `pend_pontren`        INT DEFAULT 0,
  `pend_agama`          INT DEFAULT 0,
  `pend_slb`            INT DEFAULT 0,
  `pend_kursus`         INT DEFAULT 0,

  -- Sarana Pendidikan Umum
  `sarpend_paud_n`      INT DEFAULT 0,
  `sarpend_paud_s`      INT DEFAULT 0,
  `sarpend_paud_murid`  INT DEFAULT 0,
  `sarpend_paud_guru`   INT DEFAULT 0,
  `sarpend_tk_n`        INT DEFAULT 0,
  `sarpend_tk_s`        INT DEFAULT 0,
  `sarpend_tk_murid`    INT DEFAULT 0,
  `sarpend_tk_guru`     INT DEFAULT 0,
  `sarpend_sd_n`        INT DEFAULT 0,
  `sarpend_sd_s`        INT DEFAULT 0,
  `sarpend_sd_murid`    INT DEFAULT 0,
  `sarpend_sd_guru`     INT DEFAULT 0,
  `sarpend_smp_n`       INT DEFAULT 0,
  `sarpend_smp_s`       INT DEFAULT 0,
  `sarpend_smp_murid`   INT DEFAULT 0,
  `sarpend_smp_guru`    INT DEFAULT 0,
  `sarpend_sma_n`       INT DEFAULT 0,
  `sarpend_sma_s`       INT DEFAULT 0,
  `sarpend_sma_murid`   INT DEFAULT 0,
  `sarpend_sma_guru`    INT DEFAULT 0,
  `sarpend_smk_n`       INT DEFAULT 0,
  `sarpend_smk_s`       INT DEFAULT 0,
  `sarpend_smk_murid`   INT DEFAULT 0,
  `sarpend_smk_guru`    INT DEFAULT 0,
  `sarpend_pt_n`        INT DEFAULT 0,
  `sarpend_pt_s`        INT DEFAULT 0,
  `sarpend_pt_murid`    INT DEFAULT 0,
  `sarpend_pt_guru`     INT DEFAULT 0,
  `sarpend_mi_n`        INT DEFAULT 0,
  `sarpend_mi_s`        INT DEFAULT 0,
  `sarpend_mi_murid`    INT DEFAULT 0,
  `sarpend_mi_guru`     INT DEFAULT 0,
  `sarpend_mts_n`       INT DEFAULT 0,
  `sarpend_mts_s`       INT DEFAULT 0,
  `sarpend_mts_murid`   INT DEFAULT 0,
  `sarpend_mts_guru`    INT DEFAULT 0,
  `sarpend_ma_n`        INT DEFAULT 0,
  `sarpend_ma_s`        INT DEFAULT 0,
  `sarpend_ma_murid`    INT DEFAULT 0,
  `sarpend_ma_guru`     INT DEFAULT 0,
  `sarpend_pontren_n`   INT DEFAULT 0,
  `sarpend_pontren_s`   INT DEFAULT 0,
  `sarpend_pontren_murid` INT DEFAULT 0,
  `sarpend_pontren_guru`  INT DEFAULT 0,

  -- Non-formal / kursus
  `kursus_montir_mobil` INT DEFAULT 0,
  `kursus_mengemudi`    INT DEFAULT 0,
  `kursus_montir_tv`    INT DEFAULT 0,
  `kursus_memasak`      INT DEFAULT 0,
  `kursus_menjahit`     INT DEFAULT 0,
  `kursus_komputer`     INT DEFAULT 0,
  `kursus_kecantikan`   INT DEFAULT 0,
  `kursus_bahasa`       INT DEFAULT 0,

  -- II. KESEHATAN & KB
  `kes_rumah_bersalin`  INT DEFAULT 0,
  `kes_poliklinik`      INT DEFAULT 0,
  `kes_dokter_praktek`  INT DEFAULT 0,
  `kes_dokter_khitan`   INT DEFAULT 0,
  `kes_apotek`          INT DEFAULT 0,
  `kes_panti_pijat`     INT DEFAULT 0,
  `kes_dr_umum`         INT DEFAULT 0,
  `kes_dr_gigi`         INT DEFAULT 0,
  `kes_dr_spesialis`    INT DEFAULT 0,
  `kes_bidan`           INT DEFAULT 0,
  `kes_perawat`         INT DEFAULT 0,
  `kes_mantri`          INT DEFAULT 0,
  `kes_tuna_netra`      INT DEFAULT 0,
  `kes_tuna_wicara`     INT DEFAULT 0,
  `kes_tuna_rungu`      INT DEFAULT 0,
  `kes_tuna_fisik`      INT DEFAULT 0,
  `kes_mck`             INT DEFAULT 0,

  -- III. SARANA KEAGAMAAN
  `sar_mesjid`          INT DEFAULT 0,
  `sar_mushola`         INT DEFAULT 0,
  `sar_vihara`          INT DEFAULT 0,
  `sar_gereja_katolik`  INT DEFAULT 0,
  `sar_gereja_protestan` INT DEFAULT 0,
  `sar_pura`            INT DEFAULT 0,
  `sar_majelis_taklim`  INT DEFAULT 0,
  `tok_ulama`           INT DEFAULT 0,
  `tok_mubaligh`        INT DEFAULT 0,
  `tok_mubalighoh`      INT DEFAULT 0,
  `tok_pendeta`         INT DEFAULT 0,
  `tok_bikshu`          INT DEFAULT 0,
  `ntcr_nikah`          INT DEFAULT 0,
  `ntcr_talak`          INT DEFAULT 0,
  `ntcr_cerai`          INT DEFAULT 0,
  `ntcr_rujuk`          INT DEFAULT 0,
  `haji_lk`             INT DEFAULT 0,
  `haji_pr`             INT DEFAULT 0,

  -- IV. OLAHRAGA, KESENIAN, KEBUDAYAAN
  `or_sepakbola`        INT DEFAULT 0,
  `or_voli`             INT DEFAULT 0,
  `or_bulutangkis`      INT DEFAULT 0,
  `or_tenis_lapangan`   INT DEFAULT 0,
  `or_tenis_meja`       INT DEFAULT 0,
  `or_basket`           INT DEFAULT 0,
  `or_futsal`           INT DEFAULT 0,
  `or_sarana`           INT DEFAULT 0,
  `kes_band`            INT DEFAULT 0,
  `kes_qasidah`         INT DEFAULT 0,
  `kes_orkes_melayu`    INT DEFAULT 0,

  -- V. TRANSPORTASI & MEDIA
  `trans_truk`          INT DEFAULT 0,
  `trans_pickup`        INT DEFAULT 0,
  `trans_ojek`          INT DEFAULT 0,
  `trans_becak`         INT DEFAULT 0,
  `media_tv`            INT DEFAULT 0,
  `media_telepon`       INT DEFAULT 0,
  `listrik_penerangan`  INT DEFAULT 0,
  `listrik_umum`        INT DEFAULT 0,

  -- X. NIAGA
  `niaga_toko`          INT DEFAULT 0,
  `niaga_warung`        INT DEFAULT 0,
  `niaga_rumah_makan`   INT DEFAULT 0,
  `niaga_warung_nasi`   INT DEFAULT 0,
  `niaga_bengkel`       INT DEFAULT 0,
  `niaga_material`      INT DEFAULT 0,
  `niaga_photocopy`     INT DEFAULT 1,

  -- VII. KAMTIBMAS
  `kam_pos_hansip`      INT DEFAULT 0,
  `kam_pos_ronda`       INT DEFAULT 0,
  `kam_personil`        INT DEFAULT 0,

  -- XII. KEPENDUDUKAN
  `pend_lk`             INT DEFAULT 0,
  `pend_pr`             INT DEFAULT 0,
  `pend_jumlah`         INT DEFAULT 0,
  `pend_wni_asli_lk`    INT DEFAULT 0,
  `pend_wni_asli_pr`    INT DEFAULT 0,
  `pend_wni_ket_lk`     INT DEFAULT 0,
  `pend_wni_ket_pr`     INT DEFAULT 0,
  `agama_islam_lk`      INT DEFAULT 0,
  `agama_islam_pr`      INT DEFAULT 0,
  `agama_kristen_lk`    INT DEFAULT 0,
  `agama_kristen_pr`    INT DEFAULT 0,
  `agama_katolik_lk`    INT DEFAULT 0,
  `agama_katolik_pr`    INT DEFAULT 0,
  `agama_budha_lk`      INT DEFAULT 0,
  `agama_budha_pr`      INT DEFAULT 0,
  `agama_hindu_lk`      INT DEFAULT 0,
  `agama_hindu_pr`      INT DEFAULT 0,
  `umur_0_5`            INT DEFAULT 0,
  `umur_6_10`           INT DEFAULT 0,
  `umur_11_15`          INT DEFAULT 0,
  `umur_16_20`          INT DEFAULT 0,
  `umur_21_25`          INT DEFAULT 0,
  `umur_26_30`          INT DEFAULT 0,
  `umur_31_35`          INT DEFAULT 0,
  `umur_36_40`          INT DEFAULT 0,
  `umur_41_45`          INT DEFAULT 0,
  `umur_46_50`          INT DEFAULT 0,
  `umur_51_55`          INT DEFAULT 0,
  `umur_56_60`          INT DEFAULT 0,
  `umur_61_65`          INT DEFAULT 0,
  `umur_66_70`          INT DEFAULT 0,
  `umur_71_75`          INT DEFAULT 0,
  `umur_76_79`          INT DEFAULT 0,
  `mut_lahir_lk`        INT DEFAULT 0,
  `mut_lahir_pr`        INT DEFAULT 0,
  `mut_mati_lk`         INT DEFAULT 0,
  `mut_mati_pr`         INT DEFAULT 0,
  `mut_datang_lk`       INT DEFAULT 0,
  `mut_datang_pr`       INT DEFAULT 0,
  `mut_pindah_lk`       INT DEFAULT 0,
  `mut_pindah_pr`       INT DEFAULT 0,
  `kerja_pns`           INT DEFAULT 0,
  `kerja_tni`           INT DEFAULT 0,
  `kerja_polri`         INT DEFAULT 0,
  `kerja_swasta`        INT DEFAULT 0,
  `kerja_wiraswasta`    INT DEFAULT 0,
  `kerja_tani`          INT DEFAULT 0,
  `kerja_pertukangan`   INT DEFAULT 0,
  `kerja_buruh_tani`    INT DEFAULT 0,
  `kerja_pensiunan`     INT DEFAULT 0,
  `kerja_nelayan`       INT DEFAULT 0,
  `kerja_pemulung`      INT DEFAULT 0,
  `kerja_jasa`          INT DEFAULT 0,
  `kerja_tidak`         INT DEFAULT 0,
  `kerja_ibu_rt`        INT DEFAULT 0,
  `kk_total`            INT DEFAULT 0,
  `sejah_mampu`         INT DEFAULT 0,
  `sejah_sederhana`     INT DEFAULT 0,
  `sejah_miskin`        INT DEFAULT 0,

  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_laporan_bulan_tahun` (`bulan`, `tahun`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Seed default admin
INSERT IGNORE INTO `users` (`email`, `password`, `name`, `role`)
VALUES ('admin@rw021.local', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Admin RW 021', 'admin');
-- ponytail: seeded password is bcrypt of "password", change on first login

-- Seed RT 1-10
INSERT IGNORE INTO `rt` (`no_rt`) VALUES (1),(2),(3),(4),(5),(6),(7),(8),(9),(10);
