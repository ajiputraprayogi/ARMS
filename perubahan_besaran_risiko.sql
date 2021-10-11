-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2021 at 01:06 AM
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
-- Table structure for table `perubahan_besaran_risiko`
--

CREATE TABLE `perubahan_besaran_risiko` (
  `id` int(11) NOT NULL,
  `id_pelaksanaan_manajemen_risiko` int(11) DEFAULT NULL,
  `kode_resiko_teridentifikasi` varchar(200) DEFAULT NULL,
  `id_frekuensi_aktual` int(11) DEFAULT NULL,
  `label_frekuensi` varchar(80) DEFAULT NULL,
  `id_dampak_aktual` int(11) DEFAULT NULL,
  `label_dampak_aktual` varchar(80) DEFAULT NULL,
  `besaran_aktual` int(11) DEFAULT NULL,
  `warna_aktual` varchar(25) DEFAULT NULL,
  `deviasi` int(11) DEFAULT NULL,
  `rekomendasi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `perubahan_besaran_risiko`
--
ALTER TABLE `perubahan_besaran_risiko`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `perubahan_besaran_risiko`
--
ALTER TABLE `perubahan_besaran_risiko`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
