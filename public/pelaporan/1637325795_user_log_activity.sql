-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2021 at 08:03 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `user_log_activity`
--

CREATE TABLE `user_log_activity` (
  `id` bigint(20) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `activity` enum('log-in','log-out') DEFAULT NULL,
  `waktu` datetime DEFAULT NULL,
  `ip_address` varchar(150) DEFAULT NULL,
  `browser_information` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_log_activity`
--

INSERT INTO `user_log_activity` (`id`, `user_id`, `activity`, `waktu`, `ip_address`, `browser_information`) VALUES
(1, 2, 'log-in', '2021-11-19 06:51:23', '127.0.0.1', 'Google Chrome '),
(2, 2, 'log-out', '2021-11-19 06:53:38', '127.0.0.1', 'Google Chrome '),
(3, 1, 'log-in', '2021-11-19 06:54:11', '127.0.0.1', 'Google Chrome '),
(4, 1, 'log-out', '2021-11-19 06:58:22', '127.0.0.1', 'Google Chrome '),
(5, 2, 'log-in', '2021-11-19 06:58:44', '127.0.0.1', 'Google Chrome '),
(6, 2, 'log-out', '2021-11-19 06:58:59', '127.0.0.1', 'Google Chrome '),
(7, 1, 'log-in', '2021-11-19 06:59:25', '127.0.0.1', 'Google Chrome ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_log_activity`
--
ALTER TABLE `user_log_activity`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_log_activity`
--
ALTER TABLE `user_log_activity`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
