-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2026 at 12:53 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_upt-pkb-v2`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hasil_uji`
--

CREATE TABLE `hasil_uji` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pendaftaran_id` bigint(20) UNSIGNED NOT NULL,
  `petugas_id` bigint(20) UNSIGNED NOT NULL,
  `kondisi_ban` tinyint(1) DEFAULT 1,
  `kondisi_kaca` tinyint(1) DEFAULT 1,
  `klakson` tinyint(1) DEFAULT 1,
  `wiper` tinyint(1) DEFAULT 1,
  `lampu_sign` tinyint(1) DEFAULT 1,
  `kedalaman_alur_ban` tinyint(1) DEFAULT 1,
  `emisi_co` decimal(5,2) DEFAULT NULL,
  `emisi_hc` decimal(8,2) DEFAULT NULL,
  `emisi_asap_opasitas` decimal(5,2) DEFAULT NULL,
  `rem_utama_kiri` decimal(8,2) DEFAULT NULL COMMENT 'Satuan Newton atau kg',
  `rem_utama_kanan` decimal(8,2) DEFAULT NULL,
  `selisih_rem_per_sumbu` decimal(5,2) DEFAULT NULL COMMENT 'Persentase penyimpangan',
  `rem_parkir` decimal(8,2) DEFAULT NULL,
  `lampu_utama_kekuatan` decimal(8,2) DEFAULT NULL COMMENT 'Satuan Candela',
  `lampu_utama_penyimpangan` decimal(5,2) DEFAULT NULL COMMENT 'Derajat penyimpangan',
  `kebisingan_desibel` decimal(5,2) DEFAULT NULL,
  `side_slip` decimal(5,2) DEFAULT NULL COMMENT 'mm per meter',
  `hasil_akhir` enum('lulus','tidak_lulus') DEFAULT NULL,
  `masa_berlaku_sampai` date DEFAULT NULL,
  `catatan_perbaikan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hasil_uji`
--

INSERT INTO `hasil_uji` (`id`, `pendaftaran_id`, `petugas_id`, `kondisi_ban`, `kondisi_kaca`, `klakson`, `wiper`, `lampu_sign`, `kedalaman_alur_ban`, `emisi_co`, `emisi_hc`, `emisi_asap_opasitas`, `rem_utama_kiri`, `rem_utama_kanan`, `selisih_rem_per_sumbu`, `rem_parkir`, `lampu_utama_kekuatan`, `lampu_utama_penyimpangan`, `kebisingan_desibel`, `side_slip`, `hasil_akhir`, `masa_berlaku_sampai`, `catatan_perbaikan`, `created_at`, `updated_at`) VALUES
(1, 2, 3, 1, 1, 1, 1, 1, 0, 0.03, 3.00, 3.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-03 07:59:16', '2026-01-03 08:01:05');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan`
--

CREATE TABLE `kendaraan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pemilik_id` bigint(20) UNSIGNED NOT NULL,
  `no_kendaraan` varchar(12) NOT NULL,
  `no_rangka` varchar(25) NOT NULL,
  `no_mesin` varchar(25) NOT NULL,
  `no_bpkb` varchar(20) NOT NULL,
  `merek` varchar(255) NOT NULL,
  `tipe` varchar(255) NOT NULL,
  `jenis_kendaraan` enum('Bus','Truk','Angkot','Mobil Barang','Mobil Penumpang') NOT NULL,
  `model` varchar(255) NOT NULL,
  `tahun_pembuatan` int(11) NOT NULL,
  `tahun_perakitan` int(11) NOT NULL,
  `isi_silinder` int(11) NOT NULL,
  `warna` varchar(255) NOT NULL,
  `warna_tnkb` varchar(255) NOT NULL,
  `bahan_bakar` enum('Bensin','Solar','Listrik','Hybrid') NOT NULL,
  `jumlah_roda` int(11) NOT NULL,
  `jumlah_sumbu` int(11) NOT NULL,
  `kapasitas_penumpang` int(11) NOT NULL DEFAULT 0,
  `berat_kosong` int(11) NOT NULL COMMENT 'dalam kg',
  `jbb` int(11) NOT NULL COMMENT 'Jumlah Berat yang Diperbolehkan dalam kg',
  `jbi` int(11) NOT NULL COMMENT 'Jumlah Berat yang Diizinkan dalam kg',
  `masa_berlaku_stnk` date NOT NULL,
  `masa_berlaku_uji_kir` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kendaraan`
--

INSERT INTO `kendaraan` (`id`, `pemilik_id`, `no_kendaraan`, `no_rangka`, `no_mesin`, `no_bpkb`, `merek`, `tipe`, `jenis_kendaraan`, `model`, `tahun_pembuatan`, `tahun_perakitan`, `isi_silinder`, `warna`, `warna_tnkb`, `bahan_bakar`, `jumlah_roda`, `jumlah_sumbu`, `kapasitas_penumpang`, `berat_kosong`, `jbb`, `jbi`, `masa_berlaku_stnk`, `masa_berlaku_uji_kir`, `created_at`, `updated_at`) VALUES
(1, 1, 'B 3866 KOA', 'MHFZ29G3JK123456', '2GD12345678', 'L01234567', 'Yoyota', 'Hilux', 'Mobil Barang', 'Single Cabin', 2021, 2021, 2393, 'Hitam', 'Kuning', 'Solar', 4, 2, 2, 1800, 2800, 2500, '2026-08-15', '2025-12-31', '2025-12-26 00:11:03', '2025-12-26 00:11:03');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_12_19_155904_create_pemilik_table', 1),
(5, '2025_12_20_041103_create_kendaraan_table', 1),
(6, '2025_12_20_041154_create_pendaftaran_uji_table', 1),
(7, '2025_12_20_041209_create_rating_pelayanan_table', 1),
(8, '2025_12_25_095202_create_hasil_uji_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemilik`
--

CREATE TABLE `pemilik` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat_ktp` text NOT NULL,
  `provinsi` varchar(255) NOT NULL,
  `kota_kabupaten` varchar(255) NOT NULL,
  `kecamatan` varchar(255) NOT NULL,
  `kelurahan` varchar(255) NOT NULL,
  `kode_pos` varchar(5) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `pekerjaan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemilik`
--

INSERT INTO `pemilik` (`id`, `nik`, `nama_lengkap`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat_ktp`, `provinsi`, `kota_kabupaten`, `kecamatan`, `kelurahan`, `kode_pos`, `no_hp`, `email`, `pekerjaan`, `created_at`, `updated_at`) VALUES
(1, '3275041807010010', 'Dimas Suhendra', 'L', 'Bekasi', '2001-07-18', 'Jalan Pulau Bawaen 1, Warung Kayren\r\nKecamatan Sukarame Kota Bandar Lampung', 'Lampung', 'Bandar Lampung', 'Sukabumi', 'Sukabumi', '35131', '085780809099', 'dimassuhendra0104@gmail.com', 'Mahasiswa', '2025-12-25 21:24:46', '2025-12-25 21:24:46'),
(2, '3275041807010012', 'Bimantara', 'L', 'Palembang', '2003-08-08', 'Jalan Pulau Bawaen 1, Warung Kayren\r\nKecamatan Sukarame Kota Bandar Lampung', 'Lampung', 'Bandar Lampung', 'Sukarame', 'Sukarame', '35131', '085780809099', 'bimantara007@gmail.com', 'Guru', '2025-12-25 23:29:26', '2025-12-25 23:35:44');

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kendaraan_id` bigint(20) UNSIGNED NOT NULL,
  `petugas_id` bigint(20) UNSIGNED DEFAULT NULL,
  `kode_pendaftaran` varchar(255) NOT NULL,
  `tgl_daftar` date NOT NULL,
  `nomor_antrean` varchar(10) NOT NULL,
  `jenis_pendaftaran` enum('Baru','Berkala','Numpang Uji','Mutasi') NOT NULL,
  `total_biaya` int(11) NOT NULL DEFAULT 0,
  `metode_pembayaran` enum('Tunai','Transfer','QRIS') DEFAULT NULL,
  `status_pembayaran` enum('Pending','Lunas','Batal') NOT NULL DEFAULT 'Pending',
  `tgl_bayar` timestamp NULL DEFAULT NULL,
  `status_uji` enum('Menunggu','Proses','Lulus','Tidak Lulus','Batal') NOT NULL DEFAULT 'Menunggu',
  `catatan_petugas` text DEFAULT NULL,
  `foto_kendaraan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pendaftaran`
--

INSERT INTO `pendaftaran` (`id`, `kendaraan_id`, `petugas_id`, `kode_pendaftaran`, `tgl_daftar`, `nomor_antrean`, `jenis_pendaftaran`, `total_biaya`, `metode_pembayaran`, `status_pembayaran`, `tgl_bayar`, `status_uji`, `catatan_petugas`, `foto_kendaraan`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'REG-20251226-VLPW', '2025-12-26', '001', 'Baru', 150000, NULL, 'Lunas', NULL, 'Menunggu', NULL, NULL, '2025-12-26 00:22:48', '2025-12-26 00:22:48'),
(2, 1, 1, 'REG-20260103-KGPO', '2026-01-03', '001', 'Mutasi', 150000, NULL, 'Lunas', NULL, 'Proses', NULL, NULL, '2026-01-02 21:11:54', '2026-01-03 08:01:05');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pendaftaran_id` bigint(20) UNSIGNED NOT NULL,
  `petugas_id` bigint(20) UNSIGNED DEFAULT NULL,
  `skor_bintang` tinyint(3) UNSIGNED NOT NULL,
  `kategori_keluhan` enum('pelayanan','kecepatan','fasilitas','lainnya') DEFAULT NULL,
  `komentar` text DEFAULT NULL,
  `tampilkan_publik` tinyint(1) NOT NULL DEFAULT 1,
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('957gNsTBOHdY7YN0KcaywEbxh1kursdANtwKl8Nb', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSGhwWE85Tk1kbXZlQjZGTHVOcU1PYkhUOWVxMHRvVTdEVktNRjdNbSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbi1hZG1pbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fX0=', 1768218668),
('haWKqE0bNZuKcmU5ojYwP6UILmFqOIu0Q4GfxCD3', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTDQ0SEl1OVQyRlpXRWowM3NaOFJOYVNXZWtTQUFNZEV4Mk51bUl0VSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZXR1Z2FzL2VtaXNpLzIiO3M6NToicm91dGUiO3M6MTk6InBldHVnYXMuZW1pc2kuaW5kZXgiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=', 1767414795),
('V4xsbej9HOHpib89q7P8I6BfUU1XOMC6UUOJR4KL', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNVk1TkpGNnBDM05ndVd2Y0JNdVNPcndXa2pqeHRhMHBFM3lTRTYySSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZXR1Z2FzL3JlbS8yIjtzOjU6InJvdXRlIjtzOjE3OiJwZXR1Z2FzLnJlbS5pbmRleCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjQ7fQ==', 1767454916);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('super_admin','admin_pendaftaran','petugas') NOT NULL DEFAULT 'admin_pendaftaran',
  `pos_tugas` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `role`, `pos_tugas`, `is_active`, `last_login_at`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin Pusat UPT PKB', 'admin_pusat', 'admin@upt-pkb.go.id', '2025-12-25 03:28:48', '$2y$12$QLtw39noDu38nB.zKF7FceVFdKOXx/HssZJUH9bRM2i8wBgABWdA2', 'admin_pendaftaran', NULL, 1, NULL, NULL, '2025-12-25 03:28:48', '2025-12-25 03:28:48', NULL),
(2, 'Bambang Sartono', 'bambang-sartono', 'bambang-sartono@upt-pkb.go.id', '2025-12-25 03:28:48', '$2y$12$u.eVtEb8pN8MOVxSI0Ms0ehJyismX0EAlZ4/417rSZo526JAkK9n.', 'petugas', 'Pos 1', 1, NULL, NULL, '2025-12-25 03:28:49', '2025-12-25 03:28:49', NULL),
(3, 'Hendra Supriadi', 'petugas_dua', 'supriadi@upt-pkb.go.id', NULL, '$2y$12$16uJUaurno75lQtTJrdhZepZ7bfUDwR76v0rMNMehfiD3EXBnHINK', 'petugas', 'Pos 2', 1, NULL, NULL, '2025-12-26 00:51:44', '2025-12-26 02:52:24', NULL),
(4, 'Maman Sutarman', 'petugas_tiga', 'maman@upt-pkb.go.id', NULL, '$2y$12$wV/9CmAssGi8l6R804rbzuoWEPCBV5VHxw/ncrsOE3fvPfPjV9noa', 'petugas', 'Pos 3', 1, NULL, NULL, '2025-12-26 00:53:42', '2025-12-26 02:52:30', NULL),
(5, 'Agus Halim', 'agus-halim', 'agus@upt-pkb.go.id', NULL, '$2y$12$j4Q674Ou55CIugscnkfCj.3rCfhfU4VUawF/o5n45fEDFQKpQ4/yu', 'petugas', 'Pos 4', 1, NULL, NULL, '2025-12-26 00:54:21', '2025-12-26 02:52:34', NULL),
(6, 'Arif Yanto', 'arif-yanto', 'yanto@upt-pkb.go.id', NULL, '$2y$12$nKaqfpKruVowb1yjKe7VIeIGgQHVxlqccsnNYU7q1x.ZWuj1jmmJu', 'petugas', 'Pos 5', 1, NULL, NULL, '2025-12-26 00:55:14', '2025-12-26 02:52:38', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hasil_uji`
--
ALTER TABLE `hasil_uji`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hasil_uji_pendaftaran_id_unique` (`pendaftaran_id`),
  ADD KEY `hasil_uji_petugas_id_foreign` (`petugas_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kendaraan_no_kendaraan_unique` (`no_kendaraan`),
  ADD UNIQUE KEY `kendaraan_no_rangka_unique` (`no_rangka`),
  ADD UNIQUE KEY `kendaraan_no_mesin_unique` (`no_mesin`),
  ADD UNIQUE KEY `kendaraan_no_bpkb_unique` (`no_bpkb`),
  ADD KEY `kendaraan_pemilik_id_foreign` (`pemilik_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pemilik`
--
ALTER TABLE `pemilik`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pemilik_nik_unique` (`nik`),
  ADD UNIQUE KEY `pemilik_email_unique` (`email`);

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pendaftaran_kode_pendaftaran_unique` (`kode_pendaftaran`),
  ADD KEY `pendaftaran_kendaraan_id_foreign` (`kendaraan_id`),
  ADD KEY `pendaftaran_petugas_id_foreign` (`petugas_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ratings_pendaftaran_id_unique` (`pendaftaran_id`),
  ADD KEY `ratings_petugas_id_foreign` (`petugas_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hasil_uji`
--
ALTER TABLE `hasil_uji`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kendaraan`
--
ALTER TABLE `kendaraan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pemilik`
--
ALTER TABLE `pemilik`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hasil_uji`
--
ALTER TABLE `hasil_uji`
  ADD CONSTRAINT `hasil_uji_pendaftaran_id_foreign` FOREIGN KEY (`pendaftaran_id`) REFERENCES `pendaftaran` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hasil_uji_petugas_id_foreign` FOREIGN KEY (`petugas_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD CONSTRAINT `kendaraan_pemilik_id_foreign` FOREIGN KEY (`pemilik_id`) REFERENCES `pemilik` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD CONSTRAINT `pendaftaran_kendaraan_id_foreign` FOREIGN KEY (`kendaraan_id`) REFERENCES `kendaraan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pendaftaran_petugas_id_foreign` FOREIGN KEY (`petugas_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_pendaftaran_id_foreign` FOREIGN KEY (`pendaftaran_id`) REFERENCES `pendaftaran` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ratings_petugas_id_foreign` FOREIGN KEY (`petugas_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
