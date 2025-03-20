-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2025 at 06:42 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bengkel`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `no_urut` bigint(20) UNSIGNED NOT NULL,
  `nik` varchar(50) NOT NULL,
  `tanggal_booking` date DEFAULT NULL,
  `jam_booking` varchar(20) DEFAULT NULL,
  `tanggal_penanganan` timestamp NULL DEFAULT NULL,
  `no_antrian_per_hari` varchar(255) DEFAULT NULL,
  `keluhan` varchar(255) DEFAULT NULL,
  `nopol` varchar(20) NOT NULL,
  `merek` varchar(100) NOT NULL,
  `tipe` varchar(100) NOT NULL,
  `transmisi` varchar(50) NOT NULL,
  `kapasitas` int(11) NOT NULL,
  `tahun` year(4) NOT NULL,
  `status` enum('Menunggu','Dibatalkan','Dikonfirmasi','Menunggu Sparepart','Dalam Antrian','Sedang Dikerjakan','Siap Diambil','Selesai & Diambil') NOT NULL,
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
-- Table structure for table `jasa_servis`
--

CREATE TABLE `jasa_servis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jasa_servis`
--

INSERT INTO `jasa_servis` (`id`, `jenis`, `harga`, `created_at`, `updated_at`) VALUES
(5, 'Tune-Up Mesin', 4000000, '2025-03-18 05:44:17', '2025-03-18 05:44:17'),
(6, 'Servis Rem', 5000000, '2025-03-18 05:45:33', '2025-03-18 05:45:33'),
(7, 'Spooring & Balancing', 1500000, '2025-03-18 05:46:42', '2025-03-18 05:46:42'),
(8, 'Servis Kaki-kaki', 9000000, '2025-03-18 05:47:31', '2025-03-18 05:47:31'),
(9, 'Ganti Busi & Koil', 3000000, '2025-03-18 05:47:59', '2025-03-18 05:47:59'),
(10, 'Carbon Cleaning', 3500000, '2025-03-18 05:48:53', '2025-03-18 05:48:53'),
(11, 'Servis AC', 3000000, '2025-03-18 05:49:30', '2025-03-18 05:49:30'),
(12, 'Detailing dan Coating Body Mobil', 10000000, '2025-03-18 05:49:56', '2025-03-18 05:50:32'),
(13, 'Ganti Oli & Filter Oli', 2500000, '2025-03-18 05:52:21', '2025-03-18 05:52:21'),
(14, 'Remapping ECU (Tuning Performa Mesin)', 18000000, '2025-03-18 05:53:15', '2025-03-18 05:53:15');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) NOT NULL,
  `hp` varchar(15) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id`, `nama`, `foto`, `alamat`, `hp`, `created_at`, `updated_at`) VALUES
(1, 'Anip', 'karyawan/4CCPyujyqIqT0o1MjI190xTzKC9x13Nj1Kv35kMO.jpg', 'Turi, Sumberagung, Jetis, Banul', '0833456678', '2025-02-23 19:05:06', '2025-03-01 02:07:11'),
(2, 'Grock', 'karyawan/xwv7xu5ybmsQZbhcM2aEFqNnwANkrysIufDeSCB8.jpg', 'Land Of Down', '081929737', '2025-03-14 23:36:37', '2025-03-14 23:36:37');

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan`
--

CREATE TABLE `kendaraan` (
  `nopol` varchar(20) NOT NULL,
  `merek` varchar(50) NOT NULL,
  `tipe` varchar(50) NOT NULL,
  `transmisi` enum('manual','matic') NOT NULL,
  `kapasitas` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `id_pelanggan` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kendaraan`
--

INSERT INTO `kendaraan` (`nopol`, `merek`, `tipe`, `transmisi`, `kapasitas`, `tahun`, `gambar`, `id_pelanggan`, `created_at`, `updated_at`) VALUES
('AB 1087 HG', 'Mitsubishi', 'Xpander', 'manual', 1500, 2021, 'kendaraan/S4cVrbxjDHElPrgLhQbZh6VAgSOnjzfKEeOFOeIJ.jpg', '08192', '2025-03-17 19:01:44', '2025-03-18 14:39:20'),
('AB 6767 RR', 'HONDA', 'CIvic Type R', 'manual', 3000, 2022, 'kendaraan/iONvCsULVX6u1ArmIEeRI2XH8HkzzMN3hYAFcqbn.jpg', '123412', '2025-03-18 21:18:48', '2025-03-18 21:18:48'),
('AB 7189 CS', 'Porche', '911 GT 3 RS', 'manual', 4000, 2022, 'kendaraan/Dnw4XGhxYUw3R1RB4wwuJhC1spjRjvNilMyhYzSz.jpg', '12345', '2025-03-16 08:27:24', '2025-03-16 09:52:45'),
('AB 7812 LK', 'BMW', 'M3 F80', 'manual', 4000, 2014, 'kendaraan/vvHwFLtiLJeIEsiD1h3Fkmkh08zlICRYwSa1o35S.jpg', '12345', '2025-03-16 20:35:48', '2025-03-16 20:35:48'),
('AB 8102 RW', 'HONDA', 'Civic Type R', 'manual', 2000, 2017, 'kendaraan/AA5P11yAx33dluqvrjhQgNR1WDkcrhU6dJDj6lmt.jpg', '12345', '2025-03-17 18:52:17', '2025-03-18 20:09:43'),
('AB 9129 TR', 'Toyota', 'Innova Reborn', 'manual', 2000, 2015, 'kendaraan/3VSYDxUt665S9itaR02mTeQPJ6k38m1zx2xHKTwH.jpg', '08192', '2025-03-16 07:49:37', '2025-03-16 07:49:37'),
('AB 9812 DB', 'Ford', 'Mustang', 'manual', 4000, 2018, 'kendaraan/tOes88b9OoxfFzhlOThS8YDSarrsrAEfuMGHzeU3.jpg', '123412', '2025-03-18 21:12:57', '2025-03-18 21:12:57'),
('AB 9812 VG', 'BMW', 'M3 F80', 'manual', 3000, 2014, 'kendaraan/NnRjcm8kBtAkReD09z4HFBz3rpiWF0il7RZkTh5T.jpg', '12345', '2025-03-16 02:56:21', '2025-03-16 02:56:21'),
('B 1 AC', 'McLaren', 'Senna', 'manual', 5000, 2024, 'kendaraan/7fcbcIHKauGPMbDveWdzy1HzLdIqpDlx2lpB3j31.jpg', '123412', '2025-03-18 21:28:21', '2025-03-19 00:01:55'),
('B 6712 YU', 'Honda', 'City', 'manual', 1500, 2020, 'kendaraan/KTBalLT1Cln6nl7UdhHybyDRIInO3YRWhsfzxSHb.jpg', '08192', '2025-03-17 19:09:36', '2025-03-17 19:09:36');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_01_31_033726_create_pelanggan_table', 1),
(6, '2025_01_31_033800_create_kendaraan_table', 1),
(7, '2025_01_31_033839_create_karyawan_table', 1),
(8, '2025_01_31_033924_create_sparepart_table', 1),
(9, '2025_01_31_034001_create_jasa_servis_table', 1),
(10, '2025_02_05_015305_create_bookings_table', 1),
(11, '2025_02_05_015406_create_riwayat_table', 1),
(12, '2025_02_07_020115_update_status_column_in_riwayat_table', 1),
(13, '2025_02_10_075525_create_permission_tables', 1),
(14, '2025_02_20_004831_add_foto_to_karyawans_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1);

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
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `ktp` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `hp` varchar(15) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto_profile` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`ktp`, `nama`, `alamat`, `hp`, `email`, `password`, `foto_profile`, `created_at`, `updated_at`) VALUES
('08192', 'Lionel Messi', 'Argentina', '082978293', 'messi@gmail.com', '$2y$12$5rRRG0786EJlMOp4WkenPu7KKg9itDvFTdTOlC5XbFGTcS2BJyJxe', '1742022614_mesi.jpeg', '2025-03-14 23:39:36', '2025-03-15 00:10:15'),
('11456', 'Bernadette', 'Land Of Down', '09093084234', 'vito@gmail.com', '$2y$12$Al031BN6kw/KZJ2l72qnqO5mHQ7UbUc66yXgbThahiwkz.Cbz0EPu', NULL, '2025-03-18 20:27:02', '2025-03-18 20:27:02'),
('123412', 'Timothy', 'Jakarta', '089182372', 'timoti@gmail.com', '$2y$12$LMOx6zzj2rzpEOSrcNdP5uGpbDjaZMshJ1EonkK3sWb5A77X1oAae', '1742357590_9d73bcc98296b34c36d3c785b51b8518f4c46cf3.jpg', '2025-03-18 21:11:57', '2025-03-18 21:13:10'),
('12345', 'Khanif Van Den Berg', 'Turi', '0822864794', 'khanif@gmail.com', '$2y$12$ymSb8t02x/FDVLowWLlQeuIzrWGL4mGd9BfhO.NZ7OoRKgTemcXHa', '1741983388_lockheedmartin.png', '2025-02-25 02:10:02', '2025-03-14 13:16:28');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'view users', 'web', '2025-02-23 19:02:26', '2025-02-23 19:02:26'),
(2, 'create users', 'web', '2025-02-23 19:02:26', '2025-02-23 19:02:26'),
(3, 'edit users', 'web', '2025-02-23 19:02:26', '2025-02-23 19:02:26'),
(4, 'delete users', 'web', '2025-02-23 19:02:26', '2025-02-23 19:02:26'),
(5, 'view pelanggan', 'web', '2025-02-23 19:02:26', '2025-02-23 19:02:26'),
(6, 'create pelanggan', 'web', '2025-02-23 19:02:26', '2025-02-23 19:02:26'),
(7, 'edit pelanggan', 'web', '2025-02-23 19:02:26', '2025-02-23 19:02:26'),
(8, 'delete pelanggan', 'web', '2025-02-23 19:02:26', '2025-02-23 19:02:26');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `riwayat`
--

CREATE TABLE `riwayat` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date DEFAULT NULL,
  `keluhan` varchar(255) NOT NULL,
  `penanganan` varchar(255) NOT NULL,
  `catatan` varchar(255) NOT NULL,
  `id_karyawan` bigint(20) UNSIGNED NOT NULL,
  `nopol` varchar(20) NOT NULL,
  `id_jasa` bigint(20) UNSIGNED NOT NULL,
  `kode_sparepart` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`kode_sparepart`)),
  `ktp_pelanggan` varchar(50) NOT NULL,
  `status` enum('proses','selesai') NOT NULL DEFAULT 'selesai',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `riwayat`
--

INSERT INTO `riwayat` (`id`, `tanggal`, `keluhan`, `penanganan`, `catatan`, `id_karyawan`, `nopol`, `id_jasa`, `kode_sparepart`, `ktp_pelanggan`, `status`, `created_at`, `updated_at`) VALUES
(73, '2025-03-19', 'we', 'Penanganan standar servis', 'Tidak ada catatan tambahan', 1, 'AB 7189 CS', 5, '[{\"kode\":\"33\",\"jumlah\":\"1\"},{\"kode\":\"55\",\"jumlah\":\"1\"},{\"kode\":\"66\",\"jumlah\":\"3\"}]', '12345', 'proses', '2025-03-18 22:41:14', '2025-03-18 22:41:14'),
(74, '2025-03-19', 'www', '-', 'Tidak ada catatan tambahan', 1, 'B 1 AC', 14, '[{\"kode\":\"22\",\"jumlah\":\"1\"}]', '123412', 'proses', '2025-03-18 23:33:45', '2025-03-18 23:33:45'),
(76, '2025-03-19', 'qw', 'Penanganan standar servis', 'Tidak ada catatan tambahan', 1, 'AB 9812 VG', 5, '[{\"kode\":\"11\",\"jumlah\":\"8\"}]', '12345', 'proses', '2025-03-18 23:34:49', '2025-03-18 23:34:49'),
(77, '2025-03-19', 's', 'Penanganan standar servis', 'Tidak ada catatan tambahan', 1, 'AB 6767 RR', 14, '[{\"kode\":\"11\",\"jumlah\":\"20\"},{\"kode\":\"22\",\"jumlah\":\"20\"},{\"kode\":\"33\",\"jumlah\":\"20\"},{\"kode\":\"44\",\"jumlah\":\"20\"},{\"kode\":\"55\",\"jumlah\":\"20\"},{\"kode\":\"66\",\"jumlah\":\"20\"}]', '123412', 'proses', '2025-03-19 00:05:22', '2025-03-19 00:05:22');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2025-02-23 19:02:26', '2025-02-23 19:02:26');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sparepart`
--

CREATE TABLE `sparepart` (
  `kode` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sparepart`
--

INSERT INTO `sparepart` (`kode`, `nama`, `jumlah`, `harga`, `created_at`, `updated_at`) VALUES
('11', 'Busi', 0, 350000, '2025-03-16 10:18:46', '2025-03-19 00:05:22'),
('22', 'Aki', 0, 850000, '2025-03-16 10:19:12', '2025-03-19 00:05:22'),
('33', 'Kampas Rem', 0, 550000, '2025-03-16 10:21:51', '2025-03-19 00:05:22'),
('44', 'Filter Udara', 0, 50000, '2025-03-16 10:22:56', '2025-03-19 00:05:22'),
('55', 'Kampas Kopling', 0, 1700000, '2025-03-16 10:23:25', '2025-03-19 00:05:22'),
('66', 'Ban', 0, 2000000, '2025-03-18 21:21:05', '2025-03-19 00:05:22');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@example.com', NULL, '$2y$12$m3LdIcjrqhvq4DMe.bJjE.hYtFhXOrRdGSn4L2yxemoIZFy7YxNpm', NULL, '2025-02-23 19:02:03', '2025-02-23 19:02:03'),
(2, 'Karyawan User', 'karyawan@example.com', NULL, '$2y$12$HwC8WERxXR220ohwg9Xw7u3esuvtS.hQIG1gxXuDIlIlUaZtMNsd6', NULL, '2025-02-23 19:02:04', '2025-02-23 19:02:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`no_urut`),
  ADD KEY `bookings_nik_foreign` (`nik`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jasa_servis`
--
ALTER TABLE `jasa_servis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD PRIMARY KEY (`nopol`),
  ADD KEY `kendaraan_id_pelanggan_foreign` (`id_pelanggan`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`ktp`),
  ADD UNIQUE KEY `pelanggan_email_unique` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `riwayat`
--
ALTER TABLE `riwayat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `riwayat_id_karyawan_foreign` (`id_karyawan`),
  ADD KEY `riwayat_nopol_foreign` (`nopol`),
  ADD KEY `riwayat_id_jasa_foreign` (`id_jasa`),
  ADD KEY `riwayat_ktp_pelanggan_foreign` (`ktp_pelanggan`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sparepart`
--
ALTER TABLE `sparepart`
  ADD PRIMARY KEY (`kode`);

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
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `no_urut` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jasa_servis`
--
ALTER TABLE `jasa_servis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `riwayat`
--
ALTER TABLE `riwayat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_nik_foreign` FOREIGN KEY (`nik`) REFERENCES `pelanggan` (`ktp`) ON DELETE CASCADE;

--
-- Constraints for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD CONSTRAINT `kendaraan_id_pelanggan_foreign` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`ktp`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `riwayat`
--
ALTER TABLE `riwayat`
  ADD CONSTRAINT `riwayat_id_jasa_foreign` FOREIGN KEY (`id_jasa`) REFERENCES `jasa_servis` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `riwayat_id_karyawan_foreign` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `riwayat_ktp_pelanggan_foreign` FOREIGN KEY (`ktp_pelanggan`) REFERENCES `pelanggan` (`ktp`) ON DELETE CASCADE,
  ADD CONSTRAINT `riwayat_nopol_foreign` FOREIGN KEY (`nopol`) REFERENCES `kendaraan` (`nopol`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
