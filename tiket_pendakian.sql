-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2026 at 03:06 AM
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
-- Database: `tiket_pendakian`
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
-- Table structure for table `detail_pendaki`
--

CREATE TABLE `detail_pendaki` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pemesanan_id` bigint(20) UNSIGNED NOT NULL,
  `pendaki_id` bigint(20) UNSIGNED NOT NULL,
  `status_pendakian` varchar(255) NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
-- Table structure for table `gunungs`
--

CREATE TABLE `gunungs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_gunung` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `jalur_pendakian` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_pendakians`
--

CREATE TABLE `jadwal_pendakians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gunung_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal_naik` date NOT NULL,
  `tanggal_turun` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(4, '2025_12_12_033352_create_pendakis_table', 1),
(5, '2025_12_12_033451_create_gunungs_table', 1),
(6, '2025_12_12_033545_create_jadwalpendakians_table', 1),
(7, '2025_12_12_033714_create_pemesanans_table', 1),
(8, '2025_12_12_033741_create_detailpendakis_table', 1),
(9, '2026_01_08_121821_create_penjualan_tiket_table', 1),
(10, '2026_01_13_000000_add_address_fields_to_pendakis_table', 2),
(11, '2026_01_13_000001_modify_alamat_nullable_in_pendakis_table', 3),
(12, '2026_01_13_000002_add_pemesanan_to_penjualan_tiket_table', 4),
(13, '2026_01_14_000001_add_payment_verification_to_penjualan_tiket', 5),
(14, '2026_01_14_add_foto_to_pendakis_table', 5),
(15, '2026_01_16_000001_add_status_pendakian_to_detail_pendaki', 6);

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
-- Table structure for table `pemesanans`
--

CREATE TABLE `pemesanans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jalur_pendakian` varchar(255) NOT NULL,
  `tgl_naik` date NOT NULL,
  `tgl_turun` date NOT NULL,
  `jumlah_anggota` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemesanans`
--

INSERT INTO `pemesanans` (`id`, `jalur_pendakian`, `tgl_naik`, `tgl_turun`, `jumlah_anggota`, `created_at`, `updated_at`) VALUES
(53, 'Suwanting', '2026-01-20', '2026-01-21', 1, '2026-01-19 18:52:24', '2026-01-19 18:52:24');

-- --------------------------------------------------------

--
-- Table structure for table `pendakis`
--

CREATE TABLE `pendakis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text DEFAULT NULL,
  `no_hp` varchar(15) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `dusun` varchar(255) DEFAULT NULL,
  `desa` varchar(255) DEFAULT NULL,
  `rt_rw` varchar(255) DEFAULT NULL,
  `kecamatan` varchar(255) DEFAULT NULL,
  `kabupaten` varchar(255) DEFAULT NULL,
  `provinsi` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pendakis`
--

INSERT INTO `pendakis` (`id`, `nama`, `nik`, `jenis_kelamin`, `tanggal_lahir`, `alamat`, `no_hp`, `foto`, `dusun`, `desa`, `rt_rw`, `kecamatan`, `kabupaten`, `provinsi`, `created_at`, `updated_at`) VALUES
(1, 'meme', '1214325435', 'Perempuan', '2026-01-20', 'pakis', '9327468215', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-12 22:15:54', '2026-01-12 22:15:54'),
(2, 'avisa', '456789', 'Perempuan', '2026-01-23', 'pakistan', '085749490144', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-12 22:17:37', '2026-01-12 22:17:37'),
(3, 'Avisa Aswa Azzahra', '0073053503', 'Perempuan', '2007-07-28', NULL, '085607828404', NULL, 'Pakis Kulon', 'Pakis', '01/02', 'Trowulan', 'Mojokerto', 'Jawa Timur', '2026-01-13 06:23:29', '2026-01-13 06:23:29'),
(5, 'avisa aswa azzahra', '28072007', 'Perempuan', '2026-01-13', NULL, '085607828404', NULL, 'Pakis Kulon', 'Pakis', '01/02', 'Trowulan', 'Mojokerto', 'Jawa Timur', '2026-01-13 06:32:40', '2026-01-13 06:32:40'),
(6, 'chelsea avril', '09887868', 'Perempuan', '2026-01-29', NULL, '098129675', NULL, 'gembongan wetan', 'gembongan', '01/02', 'gedeg', 'Mojokerto', 'Jawa Timur', '2026-01-13 07:17:27', '2026-01-13 07:17:27'),
(7, 'dea devina wiratmaja', '08512345', 'Perempuan', '2026-01-31', NULL, '08578215489', NULL, 'Pakis Kulon', 'Pakis', '01/02', 'Trowulan', 'Mojokerto', 'Jawa Timur', '2026-01-13 07:31:51', '2026-01-13 07:31:51'),
(8, 'Chelsea avril salsabila az-zahra', '9379827488276', 'Perempuan', '2008-04-22', NULL, '085730805161', NULL, 'Gembongan', 'Gembongan wetan', '31/08', 'Gedeg', 'Mojokerto', 'Jawa Timur', '2026-01-13 21:18:39', '2026-01-13 21:19:02'),
(9, 'avisa aswa azzahra', '0816543456600', 'Perempuan', '2026-01-06', NULL, '08578215489', NULL, 'Pakis Kulon', 'Pakis', '01/02', 'Trowulan', 'Mojokerto', 'Jawa Timur', '2026-01-14 19:55:56', '2026-01-14 19:55:56'),
(12, 'avisa', '1234123454276572', 'Perempuan', '2026-01-16', 'vdajhakv', '085731250559', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-16 05:29:28', '2026-01-16 05:29:28'),
(13, 'dea', '6158487631541733', 'Perempuan', '2026-01-16', 'kAJLHKDSGAHF', '091384786275', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-16 05:29:28', '2026-01-16 05:29:28'),
(15, 'celsi', '1234567890654321', 'Perempuan', '2026-01-13', NULL, '0812312310', NULL, 'gembongan wetan', 'gembongan', '31/08', 'gedeg', 'Mojokerto', 'Jawa Timur', '2026-01-16 05:53:24', '2026-01-16 05:55:13'),
(16, 'avisa', '5317468279418326', 'Perempuan', '2026-01-17', NULL, '0812312313098', NULL, 'pakis kulon', 'pakis', '01/02', 'trowulan', 'Mojokerto', 'Jawa Timur', '2026-01-16 05:53:24', '2026-01-16 05:53:24'),
(17, 'dea devina wiratmaja', '1234567890987654', 'Perempuan', '2020-12-31', NULL, '0987654323456', NULL, 'pakis kulon', 'pakis', '01/02', 'trowulan', 'Mojokerto', 'Jawa Timur', '2026-01-16 06:04:11', '2026-01-16 06:04:11'),
(18, 'avisa aswa azzahra', '9098765432345678', 'Perempuan', '2026-01-01', NULL, '0987656789876', NULL, 'pakis kulon', 'pakis', '01/02', 'trowulan', 'Mojokerto', 'Jawa Timur', '2026-01-16 06:08:55', '2026-01-16 06:08:55'),
(19, 'avisa aswa azzahra', '1234667386296476', 'Perempuan', '2007-07-28', NULL, '085731250559', NULL, 'pakis kulon', 'pakis', '01/02', 'trowulan', 'mojokerto', 'Jawa Timur', '2026-01-19 04:14:33', '2026-01-19 04:14:33');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_tiket`
--

CREATE TABLE `penjualan_tiket` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_tiket` varchar(255) NOT NULL,
  `nama_pendaki` varchar(255) NOT NULL,
  `tanggal_pendakian` date NOT NULL,
  `jumlah_tiket` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `status_pembayaran` enum('pending','verified','rejected') NOT NULL DEFAULT 'pending',
  `metode_pembayaran` varchar(255) DEFAULT NULL,
  `bukti_pembayaran` varchar(255) DEFAULT NULL,
  `verified_by` bigint(20) UNSIGNED DEFAULT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `catatan_verifikasi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pemesanan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `harga_per_orang` decimal(10,0) NOT NULL DEFAULT 20000
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penjualan_tiket`
--

INSERT INTO `penjualan_tiket` (`id`, `kode_tiket`, `nama_pendaki`, `tanggal_pendakian`, `jumlah_tiket`, `total_harga`, `status_pembayaran`, `metode_pembayaran`, `bukti_pembayaran`, `verified_by`, `verified_at`, `catatan_verifikasi`, `created_at`, `updated_at`, `pemesanan_id`, `harga_per_orang`) VALUES
(27, 'TK-111D7EE0', 'Suwanting', '2026-01-20', 1, 20000, 'pending', 'e-wallet', 'pembayaran/bukti_27_1768873969.jpeg', NULL, NULL, NULL, '2026-01-19 18:52:37', '2026-01-19 18:52:49', 53, 20000);

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
('KOaGEAxWyGkWJRuHj5mSEA9hNVjzI8AiDAmkSEhm', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36 Edg/144.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSVBwV1htblo2eHhYbHBseWp4NVJQOFYxYjVHZkp0Y1lhVkFnVFNIQyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo5OiJkYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=', 1768874728);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `role` enum('Admin','Pendaki') NOT NULL DEFAULT 'Pendaki',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Admin Pendakian', 'admin@tiketpendakian.com', '2026-01-13 07:49:20', '$2y$12$gEo1LanzznyJaZu/Nl.pYefMqYVG0NRR81k8QXyWT3i2TU1sapHMC', 'Qr8QhZKRzB3Yptmlj5jLB7EYQE684fwtzyPkrZurXjhfSAz4SFmTo2tWyJdJ', 'Admin', '2026-01-13 07:49:20', '2026-01-13 07:49:20'),
(2, 'Pendaki User', 'pendaki@tiketpendakian.com', '2026-01-13 07:49:21', '$2y$12$1AiAy9FvC1GdCgXzBNDOUuGm/i.gSY7nRrsxWNCd.Q4wWzHphipqu', 'lpcFuAhuQOBrTJuF2VheiKyaiRr1Kq07XMMP9fjLFFiqwbsEEQ1PWpdhQhNo', 'Pendaki', '2026-01-13 07:49:21', '2026-01-13 07:49:21');

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
-- Indexes for table `detail_pendaki`
--
ALTER TABLE `detail_pendaki`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_pendaki_pemesanan_id_foreign` (`pemesanan_id`),
  ADD KEY `detail_pendaki_pendaki_id_foreign` (`pendaki_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `gunungs`
--
ALTER TABLE `gunungs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal_pendakians`
--
ALTER TABLE `jadwal_pendakians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwal_pendakians_gunung_id_foreign` (`gunung_id`);

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
-- Indexes for table `pemesanans`
--
ALTER TABLE `pemesanans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pendakis`
--
ALTER TABLE `pendakis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pendakis_nik_unique` (`nik`);

--
-- Indexes for table `penjualan_tiket`
--
ALTER TABLE `penjualan_tiket`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `penjualan_tiket_kode_tiket_unique` (`kode_tiket`),
  ADD KEY `penjualan_tiket_pemesanan_id_foreign` (`pemesanan_id`),
  ADD KEY `penjualan_tiket_verified_by_foreign` (`verified_by`);

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
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_pendaki`
--
ALTER TABLE `detail_pendaki`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gunungs`
--
ALTER TABLE `gunungs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwal_pendakians`
--
ALTER TABLE `jadwal_pendakians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pemesanans`
--
ALTER TABLE `pemesanans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `pendakis`
--
ALTER TABLE `pendakis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `penjualan_tiket`
--
ALTER TABLE `penjualan_tiket`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_pendaki`
--
ALTER TABLE `detail_pendaki`
  ADD CONSTRAINT `detail_pendaki_pemesanan_id_foreign` FOREIGN KEY (`pemesanan_id`) REFERENCES `pemesanans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_pendaki_pendaki_id_foreign` FOREIGN KEY (`pendaki_id`) REFERENCES `pendakis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jadwal_pendakians`
--
ALTER TABLE `jadwal_pendakians`
  ADD CONSTRAINT `jadwal_pendakians_gunung_id_foreign` FOREIGN KEY (`gunung_id`) REFERENCES `gunungs` (`id`);

--
-- Constraints for table `penjualan_tiket`
--
ALTER TABLE `penjualan_tiket`
  ADD CONSTRAINT `penjualan_tiket_pemesanan_id_foreign` FOREIGN KEY (`pemesanan_id`) REFERENCES `pemesanans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `penjualan_tiket_verified_by_foreign` FOREIGN KEY (`verified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
