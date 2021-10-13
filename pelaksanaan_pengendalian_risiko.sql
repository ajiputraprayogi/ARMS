-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2021 at 05:24 AM
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
-- Table structure for table `pelaksanaan_pengendalian_risiko`
--

CREATE TABLE `pelaksanaan_pengendalian_risiko` (
  `id` bigint(20) NOT NULL,
  `id_pengendalian` varchar(250) DEFAULT NULL,
  `realisasi_waktu` date DEFAULT NULL,
  `hambatan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelaksanaan_pengendalian_risiko`
--

INSERT INTO `pelaksanaan_pengendalian_risiko` (`id`, `id_pengendalian`, `realisasi_waktu`, `hambatan`) VALUES
(1, '9', '2021-10-13', 'sdfa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pelaksanaan_pengendalian_risiko`
--
ALTER TABLE `pelaksanaan_pengendalian_risiko`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pelaksanaan_pengendalian_risiko`
--
ALTER TABLE `pelaksanaan_pengendalian_risiko`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
