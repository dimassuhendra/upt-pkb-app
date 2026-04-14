-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2026 at 05:09 AM
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
-- Database: `upt_pkb_app`
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

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-boost.roster.scan', 'a:2:{s:6:\"roster\";O:21:\"Laravel\\Roster\\Roster\":3:{s:13:\"\0*\0approaches\";O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}s:11:\"\0*\0packages\";O:32:\"Laravel\\Roster\\PackageCollection\":2:{s:8:\"\0*\0items\";a:8:{i:0;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:5:\"^12.0\";s:10:\"\0*\0package\";E:37:\"Laravel\\Roster\\Enums\\Packages:LARAVEL\";s:14:\"\0*\0packageName\";s:17:\"laravel/framework\";s:10:\"\0*\0version\";s:7:\"12.43.1\";s:6:\"\0*\0dev\";b:0;}i:1;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:6:\"v0.3.8\";s:10:\"\0*\0package\";E:37:\"Laravel\\Roster\\Enums\\Packages:PROMPTS\";s:14:\"\0*\0packageName\";s:15:\"laravel/prompts\";s:10:\"\0*\0version\";s:5:\"0.3.8\";s:6:\"\0*\0dev\";b:0;}i:2;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:6:\"v0.5.1\";s:10:\"\0*\0package\";E:33:\"Laravel\\Roster\\Enums\\Packages:MCP\";s:14:\"\0*\0packageName\";s:11:\"laravel/mcp\";s:10:\"\0*\0version\";s:5:\"0.5.1\";s:6:\"\0*\0dev\";b:1;}i:3;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:5:\"^1.24\";s:10:\"\0*\0package\";E:34:\"Laravel\\Roster\\Enums\\Packages:PINT\";s:14:\"\0*\0packageName\";s:12:\"laravel/pint\";s:10:\"\0*\0version\";s:6:\"1.26.0\";s:6:\"\0*\0dev\";b:1;}i:4;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:5:\"^1.41\";s:10:\"\0*\0package\";E:34:\"Laravel\\Roster\\Enums\\Packages:SAIL\";s:14:\"\0*\0packageName\";s:12:\"laravel/sail\";s:10:\"\0*\0version\";s:6:\"1.51.0\";s:6:\"\0*\0dev\";b:1;}i:5;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:4:\"^4.2\";s:10:\"\0*\0package\";E:34:\"Laravel\\Roster\\Enums\\Packages:PEST\";s:14:\"\0*\0packageName\";s:12:\"pestphp/pest\";s:10:\"\0*\0version\";s:5:\"4.2.0\";s:6:\"\0*\0dev\";b:1;}i:6;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:6:\"12.5.3\";s:10:\"\0*\0package\";E:37:\"Laravel\\Roster\\Enums\\Packages:PHPUNIT\";s:14:\"\0*\0packageName\";s:15:\"phpunit/phpunit\";s:10:\"\0*\0version\";s:6:\"12.5.3\";s:6:\"\0*\0dev\";b:1;}i:7;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:10:\"\0*\0package\";E:41:\"Laravel\\Roster\\Enums\\Packages:TAILWINDCSS\";s:14:\"\0*\0packageName\";s:11:\"tailwindcss\";s:10:\"\0*\0version\";s:6:\"4.1.18\";s:6:\"\0*\0dev\";b:1;}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}s:21:\"\0*\0nodePackageManager\";E:43:\"Laravel\\Roster\\Enums\\NodePackageManager:NPM\";}s:9:\"timestamp\";i:1770163849;}', 1770250249);

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
  `no_uji` varchar(255) NOT NULL,
  `no_kendaraan` varchar(255) NOT NULL,
  `no_rangka` varchar(255) NOT NULL,
  `no_mesin` varchar(255) NOT NULL,
  `merek` varchar(255) NOT NULL,
  `tipe` varchar(255) NOT NULL,
  `tahun_pembuatan` year(4) NOT NULL,
  `bahan_bakar` varchar(255) NOT NULL,
  `jbb` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kendaraan`
--

INSERT INTO `kendaraan` (`id`, `pemilik_id`, `no_uji`, `no_kendaraan`, `no_rangka`, `no_mesin`, `merek`, `tipe`, `tahun_pembuatan`, `bahan_bakar`, `jbb`, `created_at`, `updated_at`) VALUES
(1, 1, 'JKT1234567', 'B 9999 ABC', 'MHM1234567890XYZ', 'ENG123456789', 'Toyota', 'Dyna ST 110', '2022', 'Solar', 5000, '2026-02-03 16:57:48', '2026-02-03 16:57:48');

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
(6, '2025_12_20_041131_create_petugas_table', 1),
(7, '2025_12_20_041154_create_pendaftaran_uji_table', 1),
(8, '2025_12_20_041209_create_rating_pelayanan_table', 1);

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
  `alamat` text NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemilik`
--

INSERT INTO `pemilik` (`id`, `nik`, `nama_lengkap`, `alamat`, `no_hp`, `jenis_kelamin`, `created_at`, `updated_at`) VALUES
(1, '3201234567890001', 'Budi Santoso', 'Jl. Merdeka No. 10, Jakarta', '081234567890', 'L', '2026-02-03 16:57:48', '2026-02-03 16:57:48');

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran_uji`
--

CREATE TABLE `pendaftaran_uji` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kendaraan_id` bigint(20) UNSIGNED NOT NULL,
  `nomor_antrean` varchar(255) NOT NULL,
  `tgl_uji` date NOT NULL,
  `biaya_retribusi` int(11) NOT NULL,
  `hasil_emisi` enum('belum_diuji','lulus','tidak_lulus') NOT NULL DEFAULT 'belum_diuji',
  `hasil_klakson` enum('belum_diuji','lulus','tidak_lulus') NOT NULL DEFAULT 'belum_diuji',
  `hasil_lampu` enum('belum_diuji','lulus','tidak_lulus') NOT NULL DEFAULT 'belum_diuji',
  `hasil_rem` enum('belum_diuji','lulus','tidak_lulus') NOT NULL DEFAULT 'belum_diuji',
  `hasil_kuncup_roda` enum('belum_diuji','lulus','tidak_lulus') NOT NULL DEFAULT 'belum_diuji',
  `hasil_spedometer` enum('belum_diuji','lulus','tidak_lulus') NOT NULL DEFAULT 'belum_diuji',
  `pos_sekarang` enum('petugas_emisi','petugas_klakson','petugas_lampu','petugas_rem','petugas_kuncup_roda','petugas_spedometer') NOT NULL DEFAULT 'petugas_emisi',
  `status_kelulusan` enum('proses','lulus','tidak_lulus') NOT NULL DEFAULT 'proses',
  `masa_berlaku_kir` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nip` varchar(255) NOT NULL,
  `nama_petugas` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rating_pelayanan`
--

CREATE TABLE `rating_pelayanan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pendaftaran_id` bigint(20) UNSIGNED NOT NULL,
  `petugas_id` bigint(20) UNSIGNED NOT NULL,
  `skor_bintang` int(11) NOT NULL,
  `komentar_saran` text DEFAULT NULL,
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
('9L7Nsy9T4MviG4wEKoGqYILhGaq1Kx8EJLsSfgK7', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36 Edg/144.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoid1RZM1VvSzJPNUREejRJMTU4YVM0UHE2TVl4U1JNVTgyNXN5cFdyTyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbi1hZG1pbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1770163236);

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
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin PKB', 'admin_pusat', 'admin@uptpkb.go.id', NULL, '$2y$12$niBmaILkVO5/Z97I1QtHdev4FMOJh48kSGENtcW.fY/q0xUMXzLC2', 'super_admin', NULL, '2026-02-03 16:57:48', '2026-02-03 16:57:48'),
(2, 'Sunaryo', 'admin_sunaryo', 'sunaryo@upt-pkb.go.id', NULL, '$2y$12$fu5SEnzB6mNGkwF7dEHCGedA.jIN2N4XHLHxGs6YtWsKSRxINHDQe', 'petugas', NULL, '2026-02-03 16:57:48', '2026-02-03 16:57:48'),
(3, 'Bambang', 'admin_bambang', 'bambang@upt-pkb.go.id', NULL, '$2y$12$vI6RGyzeQcFg597NW1uG2OLpBxjD.Rrro8cMwhTXT8CfjsbdkU87a', 'petugas', NULL, '2026-02-03 16:57:48', '2026-02-03 16:57:48');

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
  ADD UNIQUE KEY `kendaraan_no_uji_unique` (`no_uji`),
  ADD UNIQUE KEY `kendaraan_no_kendaraan_unique` (`no_kendaraan`),
  ADD UNIQUE KEY `kendaraan_no_rangka_unique` (`no_rangka`),
  ADD UNIQUE KEY `kendaraan_no_mesin_unique` (`no_mesin`),
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
  ADD UNIQUE KEY `pemilik_nik_unique` (`nik`);

--
-- Indexes for table `pendaftaran_uji`
--
ALTER TABLE `pendaftaran_uji`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pendaftaran_uji_kendaraan_id_foreign` (`kendaraan_id`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `petugas_nip_unique` (`nip`);

--
-- Indexes for table `rating_pelayanan`
--
ALTER TABLE `rating_pelayanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rating_pelayanan_pendaftaran_id_foreign` (`pendaftaran_id`),
  ADD KEY `rating_pelayanan_petugas_id_foreign` (`petugas_id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pendaftaran_uji`
--
ALTER TABLE `pendaftaran_uji`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rating_pelayanan`
--
ALTER TABLE `rating_pelayanan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD CONSTRAINT `kendaraan_pemilik_id_foreign` FOREIGN KEY (`pemilik_id`) REFERENCES `pemilik` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pendaftaran_uji`
--
ALTER TABLE `pendaftaran_uji`
  ADD CONSTRAINT `pendaftaran_uji_kendaraan_id_foreign` FOREIGN KEY (`kendaraan_id`) REFERENCES `kendaraan` (`id`);

--
-- Constraints for table `rating_pelayanan`
--
ALTER TABLE `rating_pelayanan`
  ADD CONSTRAINT `rating_pelayanan_pendaftaran_id_foreign` FOREIGN KEY (`pendaftaran_id`) REFERENCES `pendaftaran_uji` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rating_pelayanan_petugas_id_foreign` FOREIGN KEY (`petugas_id`) REFERENCES `petugas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
