-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2021 at 02:38 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.13

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
  `id_prob` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_dampak` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  `kode_warna` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` enum('Sangat Rendah','Rendah','Sedang','Tinggi','Sangat Tinggi') COLLATE utf8mb4_unicode_ci DEFAULT 'Sangat Rendah',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `besaran_resiko`
--

INSERT INTO `besaran_resiko` (`id`, `id_prob`, `id_dampak`, `nilai`, `kode_warna`, `level`, `created_at`, `updated_at`) VALUES
(1, '1', '4', 15, '#ffff00', 'Sedang', NULL, NULL),
(2, '8', '3', 8, '#00b050', 'Rendah', NULL, NULL),
(3, '1', '6', 25, '#ff0000', 'Sangat Tinggi', NULL, NULL),
(4, '8', '1', 1, '#32bdea', 'Sangat Rendah', NULL, NULL),
(5, '1', '2', 3, '#32bdea', 'Sangat Rendah', NULL, NULL),
(6, '1', '2', 3, '#32bdea', 'Sangat Rendah', NULL, NULL),
(7, '2', '1', 2, '#32bdea', 'Sangat Rendah', NULL, NULL),
(8, '2', '1', 2, '#32bdea', 'Sangat Rendah', NULL, NULL),
(9, '1', '2', 2, '#32bdea', 'Sangat Rendah', NULL, NULL),
(10, '1', '2', 2, '#4ac4ec', 'Sangat Rendah', NULL, NULL),
(12, '8', '4', 3, '#32bdea', 'Sangat Rendah', NULL, NULL),
(13, '8', '5', 5, '#32bdea', 'Sangat Rendah', NULL, NULL),
(14, '8', '6', 20, '#ff0000', 'Sangat Tinggi', NULL, NULL),
(15, '9', '1', 2, '#32bdea', 'Sangat Rendah', NULL, NULL),
(16, '9', '4', 7, '#00b050', 'Rendah', NULL, NULL),
(17, '9', '5', 11, '#00b050', 'Rendah', NULL, NULL),
(18, '9', '3', 13, '#ffff00', 'Sedang', NULL, NULL),
(19, '9', '6', 21, '#ff0000', 'Sangat Tinggi', NULL, NULL),
(20, '10', '1', 4, '#32bdea', 'Sangat Rendah', NULL, NULL),
(21, '10', '4', 10, '#00b050', 'Rendah', NULL, NULL),
(22, '10', '5', 14, '#ffff00', 'Sedang', NULL, NULL),
(23, '10', '3', 17, '#ffc000', 'Tinggi', NULL, NULL),
(24, '10', '6', 22, '#ff0000', 'Sangat Tinggi', NULL, NULL),
(25, '11', '1', 6, '#00b050', 'Rendah', NULL, NULL),
(26, '11', '4', 12, '#ffff00', 'Sedang', NULL, NULL),
(27, '11', '5', 16, '#ffc000', 'Tinggi', NULL, NULL),
(28, '11', '3', 19, '#ffc000', 'Tinggi', NULL, NULL),
(29, '11', '6', 24, '#ff0000', 'Sangat Tinggi', NULL, NULL),
(30, '1', '1', 9, '#00b050', 'Rendah', NULL, NULL),
(32, '1', '5', 18, '#ffc000', 'Tinggi', NULL, NULL),
(33, '1', '3', 23, '#ff0000', 'Sangat Tinggi', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `besaran_resiko`
--
ALTER TABLE `besaran_resiko`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `besaran_resiko`
--
ALTER TABLE `besaran_resiko`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
