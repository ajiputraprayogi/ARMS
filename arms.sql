-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2021 at 11:02 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arms`
--

-- --------------------------------------------------------

--
-- Table structure for table `besaran_resiko`
--

CREATE TABLE `besaran_resiko` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `probabilitas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dampak` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai` int(11) NOT NULL,
  `kode_warna` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departemen`
--

CREATE TABLE `departemen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departemen`
--

INSERT INTO `departemen` (`id`, `kode`, `nama`, `created_at`, `updated_at`) VALUES
(1, '1', 'satu1', NULL, '2021-09-27 00:17:43');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_konteks`
--

CREATE TABLE `jenis_konteks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `konteks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_konteks`
--

INSERT INTO `jenis_konteks` (`id`, `konteks`, `created_at`, `updated_at`) VALUES
(1, '11', NULL, '2021-09-27 00:02:01');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_resiko`
--

CREATE TABLE `kategori_resiko` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resiko` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori_resiko`
--

INSERT INTO `kategori_resiko` (`id`, `kode`, `resiko`, `created_at`, `updated_at`) VALUES
(1, '1', 'satu1', NULL, '2021-09-26 23:58:24');

-- --------------------------------------------------------

--
-- Table structure for table `klasifikasi_sub_unsur_spip`
--

CREATE TABLE `klasifikasi_sub_unsur_spip` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `klasifikasi_sub_unsur_spip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `klasifikasi_sub_unsur_spip`
--

INSERT INTO `klasifikasi_sub_unsur_spip` (`id`, `klasifikasi_sub_unsur_spip`, `created_at`, `updated_at`) VALUES
(1, '11', NULL, '2021-09-27 00:14:50');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria_dampak`
--

CREATE TABLE `kriteria_dampak` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nilai` int(11) NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uraian` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kriteria_dampak`
--

INSERT INTO `kriteria_dampak` (`id`, `nilai`, `nama`, `uraian`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'satu1', 'satu', NULL, NULL, '2021-09-26 23:53:08');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria_probabilitas`
--

CREATE TABLE `kriteria_probabilitas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nilai` int(11) NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uraian` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kriteria_probabilitas`
--

INSERT INTO `kriteria_probabilitas` (`id`, `nilai`, `nama`, `uraian`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'satu1', 'satu', NULL, NULL, '2021-09-26 23:47:59'),
(2, 2, 'dua', 'dua', NULL, NULL, NULL),
(4, 1, 'satu', 'satu', NULL, NULL, NULL),
(5, 1, '1', NULL, NULL, NULL, NULL),
(7, 1, 'satu', 'satu', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `metode_pencapaian_tujuan`
--

CREATE TABLE `metode_pencapaian_tujuan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `metode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `metode_pencapaian_tujuan`
--

INSERT INTO `metode_pencapaian_tujuan` (`id`, `metode`, `created_at`, `updated_at`) VALUES
(1, '11', NULL, '2021-09-27 00:12:06');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2021_09_25_034108_probabilitas', 1),
(5, '2021_09_25_035126_create_dampaks_table', 2),
(6, '2021_09_25_035826_create_besaranresikos_table', 3),
(7, '2021_09_25_040207_create_kategoriresikos_table', 4),
(8, '2021_09_25_040430_create_jeniskonteks_table', 5),
(9, '2021_09_25_040603_create_penyebabs_table', 5),
(10, '2021_09_25_040739_create_metodes_table', 5),
(11, '2021_09_25_041103_create_klasifikasi_sub_unsur_spips_table', 5),
(12, '2021_09_25_041245_create_departemens_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `penyebab`
--

CREATE TABLE `penyebab` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penyebab` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penyebab`
--

INSERT INTO `penyebab` (`id`, `kode`, `penyebab`, `created_at`, `updated_at`) VALUES
(1, '1', 'satu1', NULL, '2021-09-27 00:09:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `besaran_resiko`
--
ALTER TABLE `besaran_resiko`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_konteks`
--
ALTER TABLE `jenis_konteks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_resiko`
--
ALTER TABLE `kategori_resiko`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `klasifikasi_sub_unsur_spip`
--
ALTER TABLE `klasifikasi_sub_unsur_spip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kriteria_dampak`
--
ALTER TABLE `kriteria_dampak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kriteria_probabilitas`
--
ALTER TABLE `kriteria_probabilitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `metode_pencapaian_tujuan`
--
ALTER TABLE `metode_pencapaian_tujuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penyebab`
--
ALTER TABLE `penyebab`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `besaran_resiko`
--
ALTER TABLE `besaran_resiko`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departemen`
--
ALTER TABLE `departemen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_konteks`
--
ALTER TABLE `jenis_konteks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kategori_resiko`
--
ALTER TABLE `kategori_resiko`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `klasifikasi_sub_unsur_spip`
--
ALTER TABLE `klasifikasi_sub_unsur_spip`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kriteria_dampak`
--
ALTER TABLE `kriteria_dampak`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kriteria_probabilitas`
--
ALTER TABLE `kriteria_probabilitas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `metode_pencapaian_tujuan`
--
ALTER TABLE `metode_pencapaian_tujuan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `penyebab`
--
ALTER TABLE `penyebab`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
