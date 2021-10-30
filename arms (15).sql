-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2021 at 04:16 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arms_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `akar_masalah_why`
--

CREATE TABLE `akar_masalah_why` (
  `id` int(11) NOT NULL,
  `kode_analisis` text DEFAULT NULL,
  `uraian` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akar_masalah_why`
--

INSERT INTO `akar_masalah_why` (`id`, `kode_analisis`, `uraian`) VALUES
(1, '123.MONEY.3.1.MN.1', 'test'),
(2, '123.MONEY.3.1.MN.1', 'test dua'),
(3, '123.MONEY.3.1.MN.1', 'test'),
(4, '123.MONEY.3.1.MN.1', 'test dua'),
(12, '526.INVES.1.1.MN.2', 'gfddfg'),
(15, '.1.1.1.MN.1', 'asdf'),
(16, '.1.1.1.MN.1', 'sadf'),
(24, '526.INVES.1.2.MN.1', 'gfddfg'),
(40, 'G.1.1.BMN.6.1.MD.1', 'Dokumen pengadaan tidak ada'),
(41, 'G.1.1.BMN.6.1.MD.1', 'tidak dilakukan pencatatan dan pendokumentasian bukti pembelian dan pembayaran'),
(42, 'G.1.1.BMN.6.1.MD.1', 'Berita Acara Pemeriksaan Fisik Barang tidak ada'),
(43, 'G.1.1.BMN.6.1.MD.1', 'Berita Acara Serah Terima Barang tidak ada'),
(44, 'G.1.1.BMN.5.1.MY.1', 'Tidak dilakukan validasi data CP/CL'),
(45, 'G.1.1.BMN.5.1.MY.1', 'Pemeriksaan fisik lemah'),
(46, 'G.1.1.BMN.5.1.MY.1', 'Verifikasi dokumen administrasi tidak cermat'),
(47, 'G.1.1.BMN.6.2.MD.1', 'Kurangnya pengendalian'),
(48, 'G.1.1.BMN.6.2.MD.1', 'pengawasan pelaksanaan kegiatan di lapangan kurang efektif'),
(49, 'G.1.1.BMN.6.2.MD.1', 'Tim tidak melakukan peneguran'),
(50, 'G.1.1.BMN.6.2.MD.1', 'Pengendalian kegiatan lemah'),
(51, 'G.1.1.BMN.6.3.MN.1', 'PJ tidak melakukan reviu atas kinerja keuangan'),
(52, 'G.1.1.BMN.6.3.MN.1', 'PJ tidak melakukan verifikasi fisik dan dokumen'),
(53, 'G.1.1.BMN.6.3.MN.1', 'tim telaah kurang melakukan ekplorasi terhadap para pihak terkait'),
(54, 'G.1.1.BMN.6.3.MD.1', 'PJ tidak melakukan reviu atas kinerja keuangan'),
(55, 'G.1.1.BMN.6.3.MD.1', 'PJ tidak melakukan verifikasi fisik dan dokumen'),
(56, 'G.1.1.BMN.6.3.MD.1', 'tim telaah kurang melakukan ekplorasi terhadap para pihak terkait'),
(61, 'G.1.1.BMN.5.3.MY.1', 'tidak dilakukan reviu berjenjang'),
(62, 'G.1.1.BMN.5.3.MY.1', 'Auditor tidak memenuhi kompetensi'),
(63, 'G.1.1.BMN.5.3.MY.1', 'kurangnya pengembangan kompetensi'),
(64, 'G.1.1.BMN.5.3.MY.1', 'Refocusing anggaran'),
(65, 'G.1.1.BMN.5.4.MD.1', 'Verifikasi dan reviu belanja tidak cermat'),
(66, 'G.1.1.BMN.5.4.MD.1', 'tidak dilakukan reviu berjenjang'),
(67, 'G.1.1.BMN.5.4.MD.1', 'Otorisasi atas pencacatatan kejadian penting kurang cermat'),
(68, 'G.1.1.BMN.7.1.EX.1', 'Pengendalian atas pengelolaan sistem informasi belum efektif'),
(69, 'G.1.1.BMN.7.1.EX.1', 'tidak dilakukan proses klarifikasi'),
(70, 'G.1.1.BMN.7.1.EX.1', 'Reviu atas transaksi tidak cermat'),
(71, 'G.1.1.BMN.7.1.EX.1', 'Pencatatan tidak tertib'),
(72, 'G.1.1.BMN.7.2.EX.1', 'Pengendalian atas pengelolaan sistem informasi belum efektif'),
(73, 'G.1.1.BMN.7.2.EX.1', 'tidak dilakukan proses klarifikasi'),
(74, 'G.1.1.BMN.7.2.EX.1', 'Reviu atas transaksi tidak cermat'),
(75, 'G.1.1.BMN.7.2.EX.1', 'Pencatatan tidak tertib'),
(76, 'G.1.1.BMN.7.3.MD.1', 'Verifikasi dan reviu belanja tidak cermat'),
(77, 'G.1.1.BMN.7.3.MD.1', 'tidak dilakukan reviu berjenjang'),
(78, 'G.1.1.BMN.7.3.MD.1', 'Otorisasi atas pencacatatan kejadian penting kurang cermat'),
(79, 'G.1.1.BMN.6.4.MD.1', 'tidak dilakukan reviu berjenjang'),
(80, 'G.1.1.BMN.6.4.MD.1', 'Otorisasi atas pencacatatan kejadian penting kurang cermat'),
(81, 'G.1.1.BMN.5.5.MD.1', 'Reviu atas transaksi dan kejadian penting tidak berjalan'),
(82, 'G.1.1.BMN.5.5.MD.1', 'Pencatatan atas transaksi dan kejadian penting tidak cermat'),
(83, 'G.1.1.BMN.5.2.MD.1', 'Verifikasi dan reviu belanja tidak cermat'),
(84, 'G.1.1.BMN.5.2.MD.1', 'tidak ada bukti/ hilang'),
(85, 'G.1.1.BMN.5.2.MD.1', 'tim telaah kurang melakukan ekplorasi terhadap para pihak terkait'),
(86, 'G.1.1.BMN.5.2.MD.1', 'Akuntabilitas terhadap sumber daya dan pencatatannya kurang tertib'),
(87, 'G.1.1.EP.LAKIN.4.1.EX.1', 'Capaian Rendah'),
(88, 'G.1.1.EP.LAKIN.4.1.EX.1', 'Kegiatan Tidak Terealisasi'),
(89, 'G.1.1.EP.LAKIN.4.1.EX.1', 'Jumlah SDM Kurang'),
(90, 'G.1.1.EP.LAKIN.4.1.EX.1', 'Pembatasan Mobilitas'),
(91, 'G.1.1.EP.LAKIN.4.1.EX.1', 'Force Majeur (Pandemi)'),
(92, 'G.1.1.EP.LAKIN.6.1.MD.1', 'Pergeseran jadwal kegiatan'),
(93, 'G.1.1.EP.LAKIN.6.1.MD.1', 'Kebijakan Pimpinan'),
(94, 'G.1.1.EP.LAKIN.6.1.MD.1', 'Tuntutan pencapaian kinerja'),
(95, 'G.1.1.EP.LAKIN.2.1.MD.1', 'Belum ada revisi peraturan'),
(96, 'G.1.1.EP.LAKIN.2.1.MD.1', 'Belum ada perubahan metodologi'),
(97, 'G.1.1.EP.LAKIN.2.1.MD.1', 'Kurang kajian atas metodologi'),
(98, 'G.1.1.EP.LAKIN.7.1.EX.1', 'Pergeseran jadwal pemeriksaan'),
(99, 'G.1.1.EP.LAKIN.7.1.EX.1', 'Pembatasan Mobilitas'),
(100, 'G.1.1.EP.LAKIN.7.1.EX.1', 'Force Majeur (Pandemi)'),
(101, 'G.1.1.EP.LAKIN.5.1.MN.1', 'Adanya perbedaan persepsi dari penerapan SBIK'),
(102, 'G.1.1.EP.LAKIN.5.1.MN.1', 'Kurangnya kompetensi dari SDM'),
(103, 'G.1.1.EP.LAKIN.5.1.MN.1', 'Kurangnya pelatihan atas metodologi pengukuran'),
(104, 'G.1.1.INV.ATT.6.1.MD.1', 'Materi dumas bersifat rahasia'),
(105, 'G.1.1.INV.ATT.6.1.MD.1', 'Pengadu tidak melampirkan cukup bukti.'),
(106, 'G.1.1.INV.ATT.6.1.MD.1', 'Media dumas tidak mensyaratkan bukti pendukung.'),
(107, 'G.1.1.INV.ATT.5.1.MD.1', 'keterbatasan jumlah SDM'),
(108, 'G.1.1.INV.ATT.5.1.MD.1', 'kurangnya pengembangan kompetensi'),
(109, 'G.1.1.INV.ATT.5.1.MD.1', 'Refocusing anggaran'),
(113, 'G.1.1.INV.ATT.5.1.MY.1', 'keterbatasan jumlah SDM'),
(114, 'G.1.1.INV.ATT.5.1.MY.1', 'kurangnya pengembangan kompetensi'),
(115, 'G.1.1.INV.ATT.5.1.MY.1', 'Refocusing anggaran'),
(116, 'G.1.1.INV.ATT.6.3.MD.1', 'bukti yang diperoleh tidak lengkap'),
(117, 'G.1.1.INV.ATT.6.3.MD.1', 'tim telaah kurang memahami materi aduan'),
(118, 'G.1.1.INV.ATT.6.3.MD.1', 'tim telaah kurang melakukan ekplorasi terhadap para pihak terkait'),
(119, 'G.1.1.INV.ATT.6.3.MD.1', 'tim telaah kurang melakukan ekplorasi terhadap para pihak terkait'),
(120, 'G.1.1.INV.ATT.6.4.MD.1', 'Rumusan hipotesa tidak tepat'),
(121, 'G.1.1.INV.ATT.6.4.MD.1', 'tim telaah kurang memahami materi aduan'),
(122, 'G.1.1.INV.ATT.6.4.MD.1', 'tim telaah kurang melakukan ekplorasi terhadap para pihak terkait'),
(123, 'G.1.1.INV.ATT.6.5.MD.1', 'Auditi tidak kooperatif'),
(124, 'G.1.1.INV.ATT.6.5.MD.1', 'tidak ada bukti/ hilang'),
(125, 'G.1.1.INV.ATT.6.5.MD.1', 'tim telaah kurang melakukan ekplorasi terhadap para pihak terkait'),
(126, 'G.1.1.INV.ATT.6.6.MY.1', 'tidak dilakukan reviu berjenjang'),
(127, 'G.1.1.INV.ATT.6.6.MY.1', 'Auditor tidak memenuhi kompetensi'),
(128, 'G.1.1.INV.ATT.6.6.MY.1', 'kurangnya pengembangan kompetensi'),
(129, 'G.1.1.INV.ATT.6.6.MY.1', 'Refocusing anggaran'),
(130, 'G.1.1.INV.ATT.6.7.MD.1', 'KKA tidak lengkap'),
(131, 'G.1.1.INV.ATT.6.7.MD.1', 'tidak dilakukan reviu berjenjang'),
(132, 'G.1.1.INV.ATT.6.7.MD.1', 'KKA tidak terdokumentasi dengan baik'),
(133, 'G.1.1.INV.ATT.6.8.MD.1', 'Proses audit tidak sesuai standar'),
(134, 'G.1.1.INV.ATT.6.8.MD.1', 'tidak dilakukan proses klarifikasi'),
(135, 'G.1.1.INV.ATT.6.8.MD.1', 'Salah menetapkan sebab yang hakiki'),
(136, 'G.1.1.INV.ATT.6.8.MD.1', 'kurang tepat menetapkan kriteria audit'),
(137, 'G.1.1.INV.ATT.6.9.EX.1', 'Pengiriman tidak tercatat'),
(138, 'G.1.1.INV.ATT.6.9.EX.1', 'Perubahan nomenklatur Satker'),
(139, 'G.1.1.INV.ATT.6.9.EX.1', 'Pengiriman LHA tidak didokumentasi-kan'),
(140, 'G.1.1.INV.ATT.7.3.MD.1', 'Proses audit tidak sesuai standar'),
(141, 'G.1.1.INV.ATT.7.3.MD.1', 'tidak dilakukan proses klarifikasi'),
(142, 'G.1.1.INV.ATT.7.3.MD.1', 'Salah menetapkan sebab yang hakiki'),
(143, 'G.1.1.INV.ATT.7.3.MD.1', 'kurang tepat menetapkan kriteria audit');

-- --------------------------------------------------------

--
-- Table structure for table `akar_masalah_why_thumb`
--

CREATE TABLE `akar_masalah_why_thumb` (
  `id` bigint(11) NOT NULL,
  `kode_analisis` text DEFAULT NULL,
  `uraian` text DEFAULT NULL,
  `pembuat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akar_masalah_why_thumb`
--

INSERT INTO `akar_masalah_why_thumb` (`id`, `kode_analisis`, `uraian`, `pembuat`) VALUES
(315, NULL, 'Pengendalian atas pengelolaan sistem informasi belum efektif', 1),
(316, NULL, 'tidak dilakukan proses klarifikasi', 1),
(317, NULL, 'Reviu atas transaksi tidak cermat', 1),
(318, NULL, 'Pencatatan tidak tertib', 1);

-- --------------------------------------------------------

--
-- Table structure for table `analisa_masalah`
--

CREATE TABLE `analisa_masalah` (
  `id` int(11) NOT NULL,
  `kode_analisis` varchar(50) DEFAULT NULL,
  `kode_risiko` varchar(50) DEFAULT NULL,
  `kategori_penyebab` varchar(50) DEFAULT NULL,
  `akar_masalah` text DEFAULT NULL,
  `tindakan_pengendalian` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `analisa_masalah`
--

INSERT INTO `analisa_masalah` (`id`, `kode_analisis`, `kode_risiko`, `kategori_penyebab`, `akar_masalah`, `tindakan_pengendalian`, `created_at`, `updated_at`) VALUES
(15, 'G.1.1.BMN.6.1.MD.1', 'G.1.1.BMN.6.1', 'MD', 'Pencatatan transaksi dan kejadian penting tidak te', '1. Memanfaatkan teknologi informasi untuk memperoleh bukti (P18.c)\r\n2. Pencatatan Akurat dan Tepat waktu atas transaksi dan kejadian penting (P18.h)', '2021-10-24 09:56:15', '2021-10-24 09:56:15'),
(16, 'G.1.1.BMN.5.1.MY.1', 'G.1.1.BMN.5.1', 'MY', 'Pelaksanaan reviu kinerja tidak optimal', 'Reviu berjenjang secara efektif (P18.a)', '2021-10-24 10:02:06', '2021-10-24 10:02:06'),
(17, 'G.1.1.BMN.6.2.MD.1', 'G.1.1.BMN.6.2', 'MD', 'Pengawasan dan evaluasi penyedia barang tidak opti', 'Reviu berjenjang secara efektif (P18.a)', '2021-10-24 10:06:32', '2021-10-24 10:06:32'),
(18, 'G.1.1.BMN.6.3.MD.1', 'G.1.1.BMN.6.3', 'MD', 'Pengendalian fisik atas aset lemah', 'Pengendalian fisik atas aset (P.18.d)', '2021-10-24 10:08:31', '2021-10-24 10:08:31'),
(19, 'G.1.1.BMN.5.2.MD.1', 'G.1.1.BMN.5.2', 'MD', 'Pencatatan transaksi dan kejadian penting tidak te', '\"1. Memanfaatkan teknologi informasi untuk memperoleh bukti (P18.c)\r\n2. Pencatatan Akurat dan Tepat waktu atas transaksi dan kejadian penting (P18.h)\r\n3. Akuntabilitas sumberdaya dan pencatatannya (P18.j)\"', '2021-10-24 10:13:05', '2021-10-24 10:13:05'),
(20, 'G.1.1.BMN.5.3.MY.1', 'G.1.1.BMN.5.3', 'MY', '-', 'Pembinaan Sumber daya manusia/Mendesain pelatihan yang sesuai dengan kebutuhan (P18,b)', '2021-10-24 10:17:46', '2021-10-24 10:17:46'),
(21, 'G.1.1.BMN.5.4.MD.1', 'G.1.1.BMN.5.4', 'MD', 'Pencatatan transaksi dan kejadian penting tidak te', '\"1. Reviu Berjenjang berbantuan teknologi informasi (P18.a, b)\r\n2. Pencatatan Akurat dan Tepat waktu atas transaksi dan kejadian penting (P18.h)\r\n3. Akuntabilitas sumberdaya dan pencatatannya (P18.j)\"', '2021-10-24 10:18:43', '2021-10-24 10:18:43'),
(22, 'G.1.1.BMN.7.1.EX.1', 'G.1.1.BMN.7.1', 'EX', 'Pengendalian atas transaksi dan kejadian penting k', '\"1. Reviu Berjenjang (P18.a)\r\n2. Pencatatan Akurat dan Tepat waktu atas transaksi dan kejadian penting (P18.h)\r\n3. Akuntabilitas sumberdaya dan pencatatannya (P18.j)\"', '2021-10-24 10:19:38', '2021-10-24 10:19:38'),
(23, 'G.1.1.BMN.7.2.EX.1', 'G.1.1.BMN.7.2', 'EX', 'Pengendalian atas transaksi dan kejadian penting k', '\"1. Reviu Berjenjang (P18.a)\r\n2. Pencatatan Akurat dan Tepat waktu atas transaksi dan kejadian penting (P18.h)\"', '2021-10-24 10:20:35', '2021-10-24 10:20:35'),
(24, 'G.1.1.BMN.7.3.MD.1', 'G.1.1.BMN.7.3', 'MD', 'Pencatatan transaksi dan kejadian penting tidak te', '\"1. Reviu Berjenjang (P18.a)\r\n2. Pencatatan Akurat dan Tepat waktu atas transaksi dan kejadian penting (P18.h)\r\n3. Akuntabilitas sumberdaya dan pencatatannya (P18.j)\"', '2021-10-24 10:21:30', '2021-10-24 10:21:30'),
(25, 'G.1.1.BMN.6.4.MD.1', 'G.1.1.BMN.6.4', 'MD', 'Pencatatan transaksi dan kejadian penting tidak te', '\"1. Reviu Berjenjang (P18.a)\r\n2. Pencatatan Akurat dan Tepat waktu atas transaksi dan kejadian penting (P18.h)\r\n3. Akuntabilitas sumberdaya dan pencatatannya (P18.j)\"', '2021-10-24 10:22:13', '2021-10-24 10:22:13'),
(26, 'G.1.1.BMN.5.5.MD.1', 'G.1.1.BMN.5.5', 'MD', 'Pengendalian akuntabilitas terhadap sumber daya le', '\"1. Reviu Berjenjang (P18.a)\r\n2. Pencatatan Akurat dan Tepat waktu atas transaksi dan kejadian penting (P18.h)\r\n3. Akuntabilitas sumberdaya dan pencatatannya (P18.j)\"', '2021-10-24 10:23:10', '2021-10-24 10:23:10'),
(27, 'G.1.1.EP.LAKIN.4.1.EX.1', 'G.1.1.EP.LAKIN.4.1', 'EX', 'Force Majeur (Pandemi)', 'Memanfaatkan teknologi informasi untuk mempercepat realisasi kegiatan (via online)', '2021-10-24 15:51:56', '2021-10-24 15:51:56'),
(28, 'G.1.1.EP.LAKIN.6.1.MD.1', 'G.1.1.EP.LAKIN.6.1', 'MD', 'Tuntutan pencapaian kinerja', 'Dilakukan pemantauan secara berkala', '2021-10-24 15:52:56', '2021-10-24 15:52:56'),
(29, 'G.1.1.EP.LAKIN.2.1.MD.1', 'G.1.1.EP.LAKIN.2.1', 'MD', 'Kurang kajian atas metodologi', 'Melakukan kajian atas metodologi penyusunan LAKIN', '2021-10-24 16:09:09', '2021-10-24 16:09:09'),
(30, 'G.1.1.EP.LAKIN.7.1.EX.1', 'G.1.1.EP.LAKIN.7.1', 'EX', 'Force Majeur (Pandemi)', 'Memanfaatkan teknologi informasi untuk mempercepat realisasi kegiatan (via online)', '2021-10-24 16:10:18', '2021-10-24 16:10:18'),
(31, 'G.1.1.EP.LAKIN.5.1.MN.1', 'G.1.1.EP.LAKIN.5.1', 'MN', 'Kurangnya pelatihan atas metodologi pengukuran', 'Mendisain pelatihan yang sesuai dengan kebutuhan', '2021-10-24 16:11:03', '2021-10-24 16:11:03'),
(32, 'G.1.1.INV.ATT.6.1.MD.1', 'G.1.1.INV.ATT.6.1', 'MD', 'Pengadu tidak melampirkan bukti pendukung.', '1. Memanfaatkan teknologi informasi untuk memperoleh bukti (P18.c)\r\n2. Pencatatan Akurat dan Tepat waktu atas transaksi dan kejadian penting (P18.h)', '2021-10-24 20:19:56', '2021-10-24 20:19:56'),
(33, 'G.1.1.INV.ATT.5.1.MY.1', 'G.1.1.INV.ATT.5.1', 'MY', 'Kurangnya kompetensi', 'Briefing teknis (P18.b)', '2021-10-25 01:23:57', '2021-10-25 01:23:57'),
(34, 'G.1.1.INV.ATT.6.3.MD.1', 'G.1.1.INV.ATT.6.3', 'MD', 'Data & Informasi Spesifik tidak diperoleh', 'Gelar kasus (P18.b)', '2021-10-25 01:28:34', '2021-10-25 01:28:34'),
(35, 'G.1.1.INV.ATT.6.4.MD.1', 'G.1.1.INV.ATT.6.4', 'MD', 'tim telaah kurang melakukan ekplorasi terhadap par', 'Gelar kasus (P18.b)', '2021-10-25 01:31:17', '2021-10-25 01:31:17'),
(36, 'G.1.1.INV.ATT.6.5.MD.1', 'G.1.1.INV.ATT.6.5', 'MD', 'tim telaah kurang melakukan ekplorasi terhadap par', '1. Memanfaatkan teknologi informasi untuk memperoleh bukti (P18.c)\r\n2. Pencatatan Akurat dan Tepat waktu atas transaksi dan kejadian penting (P18.h)\r\n3. Akuntabilitas sumberdaya dan pencatatannya (P18.j)', '2021-10-25 01:32:04', '2021-10-25 01:32:04'),
(37, 'G.1.1.INV.ATT.6.6.MY.1', 'G.1.1.INV.ATT.6.6', 'MY', '-', 'Pembinaan Sumber daya manusia/Mendesain pelatihan yang sesuai dengan kebutuhan (P18,b)', '2021-10-25 01:42:53', '2021-10-25 01:42:53'),
(38, 'G.1.1.INV.ATT.6.7.MD.1', 'G.1.1.INV.ATT.6.7', 'MD', 'KKA tidak dilakukan reviu berjenjang', '1. Reviu Berjenjang berbantuan teknologi informasi (P18.a, b)\r\n2. Pencatatan Akurat dan Tepat waktu atas transaksi dan kejadian penting (P18.h)\r\n3. Akuntabilitas sumberdaya dan pencatatannya (P18.j)', '2021-10-25 01:44:04', '2021-10-25 01:44:04'),
(39, 'G.1.1.INV.ATT.6.8.MD.1', 'G.1.1.INV.ATT.6.8', 'MD', 'salah menetapkan rekomendasi', '1. Reviu Berjenjang (P18.a)\r\n2. Pencatatan Akurat dan Tepat waktu atas transaksi dan kejadian penting (P18.h)\r\n3. Akuntabilitas sumberdaya dan pencatatannya (P18.j)', '2021-10-25 01:45:00', '2021-10-25 01:45:00'),
(40, 'G.1.1.INV.ATT.6.9.EX.1', 'G.1.1.INV.ATT.6.9', 'EX', 'Pengiriman laporan tidak terdokumentasi', '1. Reviu Berjenjang (P18.a)\r\n2. Pencatatan Akurat dan Tepat waktu atas transaksi dan kejadian penting (P18.h)', '2021-10-25 01:45:48', '2021-10-25 01:45:48'),
(41, 'G.1.1.INV.ATT.7.3.MD.1', 'G.1.1.INV.ATT.7.3', 'MD', 'Rekomendasi tidak rekomacu.', '1. Reviu Berjenjang (P18.a)\r\n2. Pencatatan Akurat dan Tepat waktu atas transaksi dan kejadian penting (P18.h)\r\n3. Akuntabilitas sumberdaya dan pencatatannya (P18.j)', '2021-10-25 01:47:02', '2021-10-25 01:47:02');

-- --------------------------------------------------------

--
-- Table structure for table `analisa_risiko`
--

CREATE TABLE `analisa_risiko` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_pelaksanaan_manajemen_risiko` int(11) DEFAULT NULL,
  `id_prob` varchar(255) DEFAULT NULL,
  `id_prob_residu` varchar(255) DEFAULT NULL,
  `id_dampak` varchar(255) DEFAULT NULL,
  `id_dampak_residu` varchar(255) DEFAULT NULL,
  `kode_risiko` varchar(255) DEFAULT NULL,
  `pr` varchar(255) DEFAULT NULL,
  `pr_residu` varchar(255) DEFAULT NULL,
  `frekuensi_residu` varchar(255) DEFAULT NULL,
  `frekuensi_melekat` varchar(255) DEFAULT NULL,
  `dampak_residu` varchar(255) DEFAULT NULL,
  `besaran_residu` varchar(255) DEFAULT NULL,
  `dampak_melekat` varchar(255) DEFAULT NULL,
  `besaran_melekat` int(11) NOT NULL,
  `sudah_ada_pengendalian` varchar(255) DEFAULT NULL,
  `apakah_memadai` text DEFAULT NULL,
  `uraian_pengendalian` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `analisa_risiko`
--

INSERT INTO `analisa_risiko` (`id`, `id_pelaksanaan_manajemen_risiko`, `id_prob`, `id_prob_residu`, `id_dampak`, `id_dampak_residu`, `kode_risiko`, `pr`, `pr_residu`, `frekuensi_residu`, `frekuensi_melekat`, `dampak_residu`, `besaran_residu`, `dampak_melekat`, `besaran_melekat`, `sudah_ada_pengendalian`, `apakah_memadai`, `uraian_pengendalian`, `created_at`, `updated_at`) VALUES
(25, 13, '11', '10', '5', '5', 'G.1.1.BMN.6.1', '#ffc000', '#ffff00', '3 - Kadang Terjadi', '4 - Sering Terjadi', '3 - Moderat', '14', '3 - Moderat', 16, 'Sudah', 'Memadai', 'SOP Verifikasi', '2021-10-24 09:18:45', '2021-10-24 09:18:45'),
(26, 13, '10', '10', '5', '5', 'G.1.1.BMN.5.1', '#ffff00', '#ffff00', '3 - Kadang Terjadi', '3 - Kadang Terjadi', '3 - Moderat', '14', '3 - Moderat', 14, 'Sudah', 'Memadai', 'SOP Verifikasi', '2021-10-24 09:20:30', '2021-10-24 09:20:30'),
(27, 13, '11', '9', '6', '3', 'G.1.1.BMN.6.2', '#ff0000', '#ffff00', '2 - Jarang Terjadi', '4 - Sering Terjadi', '4 - Signifikan', '13', '5 - Sangat Signifikan', 24, 'Sudah', 'Memadai', 'SOP Verifikasi', '2021-10-24 09:24:52', '2021-10-24 09:24:52'),
(28, 13, '10', '10', '6', '3', 'G.1.1.BMN.6.3', '#ff0000', '#ffc000', '3 - Kadang Terjadi', '3 - Kadang Terjadi', '4 - Signifikan', '17', '5 - Sangat Signifikan', 22, 'Sudah', 'Memadai', 'SOP Verifikasi', '2021-10-24 09:38:12', '2021-10-24 09:38:12'),
(29, 13, '10', '9', '6', '3', 'G.1.1.BMN.5.2', '#ff0000', '#ffff00', '2 - Jarang Terjadi', '3 - Kadang Terjadi', '4 - Signifikan', '13', '5 - Sangat Signifikan', 22, 'Sudah', 'Memadai', 'SOP Verifikasi', '2021-10-24 09:40:32', '2021-10-24 09:40:32'),
(30, 13, '10', '9', '6', '3', 'G.1.1.BMN.5.3', '#ff0000', '#ffff00', '2 - Jarang Terjadi', '3 - Kadang Terjadi', '4 - Signifikan', '13', '5 - Sangat Signifikan', 22, 'Sudah', 'Memadai', 'SOP Verifikasi', '2021-10-24 09:45:01', '2021-10-24 09:45:01'),
(31, 13, '10', '10', '3', '3', 'G.1.1.BMN.5.4', '#ffc000', '#ffc000', '3 - Kadang Terjadi', '3 - Kadang Terjadi', '4 - Signifikan', '17', '4 - Signifikan', 17, 'Sudah', 'Memadai', 'SOP Verifikasi', '2021-10-24 09:45:59', '2021-10-24 09:45:59'),
(32, 13, '9', '9', '5', '5', 'G.1.1.BMN.7.1', '#00b050', '#00b050', '2 - Jarang Terjadi', '2 - Jarang Terjadi', '3 - Moderat', '11', '3 - Moderat', 11, 'Sudah', 'Belum Memadai', 'SOP Verifikasi', '2021-10-24 09:50:09', '2021-10-24 09:50:09'),
(33, 13, '9', '8', '4', '4', 'G.1.1.BMN.7.2', '#00b050', '#32bdea', '1 - Hampir Tidak Terjadi', '2 - Jarang Terjadi', '2 - Minor', '3', '2 - Minor', 7, 'Sudah', 'Belum Memadai', 'SOP Verifikasi', '2021-10-24 09:51:55', '2021-10-24 09:51:55'),
(34, 13, '10', '10', '6', '3', 'G.1.1.BMN.7.3', '#ff0000', '#ffc000', '3 - Kadang Terjadi', '3 - Kadang Terjadi', '4 - Signifikan', '17', '5 - Sangat Signifikan', 22, 'Sudah', 'Belum Memadai', 'SOP Verifikasi', '2021-10-24 09:52:39', '2021-10-24 09:52:39'),
(35, 13, '11', '10', '5', '4', 'G.1.1.BMN.6.4', '#ffc000', '#00b050', '3 - Kadang Terjadi', '4 - Sering Terjadi', '2 - Minor', '10', '3 - Moderat', 16, 'Sudah', 'Memadai', 'SOP Verifikasi', '2021-10-24 09:53:31', '2021-10-24 09:53:31'),
(36, 13, '11', '11', '3', '3', 'G.1.1.BMN.5.5', '#ffc000', '#ffc000', '4 - Sering Terjadi', '4 - Sering Terjadi', '4 - Signifikan', '19', '4 - Signifikan', 19, 'Sudah', 'Memadai', 'SOP Verifikasi', '2021-10-24 09:54:27', '2021-10-24 09:54:27'),
(37, 12, '8', '8', '3', '5', 'G.1.1.EP.LAKIN.5.1', '#00b050', '#32bdea', '1 - Hampir Tidak Terjadi', '1 - Hampir Tidak Terjadi', '3 - Moderat', '5', '4 - Signifikan', 8, 'Sudah', 'Memadai', 'Dilakukan pemantauan berkala terhadap IKK', '2021-10-24 15:42:54', '2021-10-24 15:42:54'),
(38, 12, '11', '11', '3', '5', 'G.1.1.EP.LAKIN.6.1', '#ffc000', '#ffc000', '4 - Sering Terjadi', '4 - Sering Terjadi', '3 - Moderat', '16', '4 - Signifikan', 19, 'Sudah', 'Memadai', 'Dilakukan Pemantauan realisasi kepada masing-masing PJ Kegiatan', '2021-10-24 15:43:46', '2021-10-24 15:43:46'),
(39, 12, '8', '8', '5', '5', 'G.1.1.EP.LAKIN.3.1', '#32bdea', '#32bdea', '1 - Hampir Tidak Terjadi', '1 - Hampir Tidak Terjadi', '3 - Moderat', '5', '3 - Moderat', 5, NULL, 'Memadai', '-', '2021-10-24 15:46:21', '2021-10-24 15:46:21'),
(40, 12, '1', '1', '6', '6', 'G.1.1.EP.LAKIN.7.1', '#ff0000', '#ff0000', '5 - Hampir Pasti Terjadi', '5 - Hampir Pasti Terjadi', '5 - Sangat Signifikan', '25', '5 - Sangat Signifikan', 25, NULL, 'Memadai', '-', '2021-10-24 15:47:11', '2021-10-24 15:47:11'),
(41, 12, '9', '9', '3', '5', 'G.1.1.EP.LAKIN.6.2', '#ffff00', '#00b050', '2 - Jarang Terjadi', '2 - Jarang Terjadi', '3 - Moderat', '11', '4 - Signifikan', 13, 'Sudah', 'Memadai', 'Telah disusun Manual IKU atau SBIK', '2021-10-24 15:48:02', '2021-10-24 15:48:02'),
(42, 14, '11', '10', '4', '4', 'G.1.1.INV.ATT.6.1', '#ffff00', '#00b050', '3 - Kadang Terjadi', '4 - Sering Terjadi', '2 - Minor', '10', '2 - Minor', 12, 'Sudah', 'Memadai', 'SOP Telaah', '2021-10-24 20:16:54', '2021-10-24 20:16:54'),
(43, 14, '11', '10', '4', '4', 'G.1.1.INV.ATT.6.1', '#ffff00', '#00b050', '3 - Kadang Terjadi', '4 - Sering Terjadi', '2 - Minor', '10', '2 - Minor', 12, 'Sudah', 'Memadai', 'SOP Telaah', '2021-10-24 21:14:10', '2021-10-24 21:14:10'),
(44, 14, '10', '9', '4', '4', 'G.1.1.INV.ATT.6.2', '#00b050', '#00b050', '2 - Jarang Terjadi', '3 - Kadang Terjadi', '2 - Minor', '7', '2 - Minor', 10, 'Sudah', 'Memadai', 'SOP Pembentukan Tim AI/ATT', '2021-10-24 21:14:50', '2021-10-24 21:14:50'),
(45, 14, '8', '8', '5', '5', 'G.1.1.INV.ATT.6.3', '#32bdea', '#32bdea', '1 - Hampir Tidak Terjadi', '1 - Hampir Tidak Terjadi', '3 - Moderat', '5', '3 - Moderat', 5, 'Sudah', 'Memadai', 'SOP Pengendalian Pengumpulan dan Analisis Bukti.', '2021-10-24 21:18:18', '2021-10-24 21:18:18'),
(46, 14, '9', '8', '6', '6', 'G.1.1.INV.ATT.6.4', '#ff0000', '#ff0000', '1 - Hampir Tidak Terjadi', '2 - Jarang Terjadi', '5 - Sangat Signifikan', '20', '5 - Sangat Signifikan', 21, 'Sudah', 'Memadai', 'SOP Pengendalian Pembuktian Modus Operandi', '2021-10-24 21:19:05', '2021-10-24 21:19:05'),
(47, 14, '10', '9', '6', '6', 'G.1.1.INV.ATT.6.5', '#ff0000', '#ff0000', '2 - Jarang Terjadi', '3 - Kadang Terjadi', '5 - Sangat Signifikan', '21', '5 - Sangat Signifikan', 22, 'Sudah', 'Memadai', 'SOP Pengendalian Pengumpulan dan Analisis Bukti.', '2021-10-25 00:55:24', '2021-10-25 00:55:24'),
(48, 14, '9', '8', '6', '6', 'G.1.1.INV.ATT.6.6', '#ff0000', '#ff0000', '1 - Hampir Tidak Terjadi', '2 - Jarang Terjadi', '5 - Sangat Signifikan', '20', '5 - Sangat Signifikan', 21, 'Sudah', 'Memadai', 'SOP Pengendalian Pengumpulan dan Analisis Bukti', '2021-10-25 01:16:14', '2021-10-25 01:16:14'),
(49, 14, '11', '10', '3', '3', 'G.1.1.INV.ATT.6.7', '#ffc000', '#ffc000', '3 - Kadang Terjadi', '4 - Sering Terjadi', '4 - Signifikan', '17', '4 - Signifikan', 19, 'Sudah', 'Memadai', 'SOP Pengendalian Pengumpulan dan Analisis Bukti', '2021-10-25 01:17:25', '2021-10-25 01:17:25'),
(50, 14, '8', '8', '3', '3', 'G.1.1.INV.ATT.7.1', '#00b050', '#00b050', '1 - Hampir Tidak Terjadi', '1 - Hampir Tidak Terjadi', '4 - Signifikan', '8', '4 - Signifikan', 8, 'Sudah', 'Memadai', 'SOP Pengendalian LHA', '2021-10-25 01:18:58', '2021-10-25 01:18:58'),
(51, 14, '9', '8', '3', '3', 'G.1.1.INV.ATT.7.2', '#ffff00', '#00b050', '1 - Hampir Tidak Terjadi', '2 - Jarang Terjadi', '4 - Signifikan', '8', '4 - Signifikan', 13, 'Sudah', 'Memadai', 'SOP Pengendalian LHA', '2021-10-25 01:19:54', '2021-10-25 01:19:54'),
(52, 14, '10', '9', '6', '6', 'G.1.1.INV.ATT.7.3', '#ff0000', '#ff0000', '2 - Jarang Terjadi', '3 - Kadang Terjadi', '5 - Sangat Signifikan', '21', '5 - Sangat Signifikan', 22, 'Sudah', 'Memadai', 'SOP Pengendalian LHA', '2021-10-25 01:20:55', '2021-10-25 01:20:55');

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
(5, 'INV.ATT', 'Inspektorat Investigasi', NULL, '2021-10-19 01:57:10'),
(7, 'BMN', 'Biro KP dan BMN', NULL, NULL),
(8, 'EP.LAKIN', 'Sekretariat Inspektorat Jenderal', NULL, NULL);

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
(1, 'Sasaran Strategis/Program', NULL, '2021-10-18 18:42:15'),
(5, 'Program', NULL, '2021-09-28 00:02:31'),
(7, 'Proses Bisnis', NULL, NULL);

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
(1, '1', 'Risiko Bencana', NULL, '2021-09-27 23:59:50'),
(3, '2', 'Risiko Kebijakan', NULL, '2021-09-28 00:00:01'),
(4, '3', 'Risiko Kecurangan', NULL, NULL),
(5, '4', 'Risiko Kepatuhan', NULL, NULL),
(6, '5', 'Risiko Operasional', NULL, NULL),
(7, '6', 'Risiko Pemangku Kepentingan', NULL, NULL);

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
(1, 'Informasi dan Komunikasi', NULL, '2021-10-18 19:05:30'),
(3, 'Kegiatan Pengendalian', NULL, '2021-10-18 19:05:40'),
(5, 'Lingkungan Pengendalian', NULL, NULL),
(6, 'Penilaian Risiko', NULL, NULL),
(7, 'Pemantauan Pengendalian Intern', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `konteks`
--

CREATE TABLE `konteks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `faktur_konteks` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_konteks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_departemen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detail_ancaman` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `indikator_kinerja_kegiatan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `konteks`
--

INSERT INTO `konteks` (`id`, `faktur_konteks`, `kode`, `nama`, `id_konteks`, `id_departemen`, `detail_ancaman`, `indikator_kinerja_kegiatan`, `created_at`, `updated_at`) VALUES
(13, 'FK2021-09-29-00001', 'KODE001', 'yogapamungkas', '2', NULL, 'sdfasfd', 'safdasdf', NULL, '2021-09-29 02:40:05'),
(21, 'FK2021-10-01-00004', 'KODE001', 'satu', '1', NULL, '456', '4654', NULL, NULL),
(22, 'FK2021-09-29-00001', 'KODE002', 'Teh Gelas1', '5', NULL, '6465', '144165', NULL, '2021-10-03 23:05:11'),
(23, '5', '6', 'sadasd1', '1', NULL, 'asdasd1', 'asdasd', NULL, '2021-10-07 06:26:01'),
(24, 'FK2021-09-29-00003', '526', 'Pengadaan', '5', NULL, 'Kemungkinan kejadian keterlambatan distribusi dan pengadaan karena corona, dan kejadian lain terkait dengan kerugian negara karena adanya kesalahan dalam penanganan program pengadaan.', 'Keberhasilan program dalam batasan budget dan waktu.', NULL, NULL),
(25, 'FK2021-10-06-00006', '526', 'Pengadaan Barang', '7', '5', 'Kemungkinan Perubahan jadwal dan persyaratan karena adanya peraturan baru dari pemerintah atau adanya kejadian luar biasa terkait dengan operasional proses yang mengakibatkan permasalahan pada proses pengadaan.', 'Ketepatan waktu pengerjaan.\r\nKesesuaian dengan budget.', NULL, NULL),
(26, 'FK2021-10-07-00007', '123', 'Pengadaan Barang', '1', '6', 'Kemungkinan kejadian keterlambatan distribusi dan pengadaan karena corona, dan kejadian lain terkait dengan kerugian negara karena adanya kesalahan dalam penanganan program pengadaan.', 'Keberhasilan program dalam batasan budget dan waktu.', NULL, NULL),
(27, 'FK2021-10-07-00007', 'test', 'test', '5', NULL, 'as', 'sf', NULL, NULL),
(28, '8', 'test', 'test', '1', '6', 'test', 'test', NULL, NULL),
(29, '8', 'test', 'test', '7', '6', 'test', 'test', NULL, NULL),
(31, '9', 'G.1.1', 'Perjanjian Kinerja', '1', '5', '1. Pihak ketiga tidak bertanggungjawab\r\n2. Pergantian pejabat\r\n3. Perusahaan pailit\r\n4. Pemilik TGR meninggal\r\n5. Rekomendasi tidak rekomacu', 'Rasio Rekomendasi Audit Tujuan Tertentu di Lingkup Kementerian Pertanian yang Ditindaklanjuti sebesar 75%', NULL, NULL),
(32, '9', 'G.1.2', 'Telaah materi aduan', '7', '5', 'Nil', 'Hasil telaah berkadar pengawasan', NULL, NULL),
(33, '10', 'asdf', 'sadf', '1', NULL, 'sadf', 'sadf', NULL, NULL),
(34, '1', 'G.1.1', 'Perjanjian Kerja', '1', '8', '- Nilai Evaluasi AKIP kurang dari 82.\r\n- Data Capaian Realisasi Berubah-ubah.\r\n- Petunjuk Teknis / Pedoman Penyusunan Lakin tidak memadai.\r\n- Data dari Eksternal (Menpan RB/BPK/KPK) terlambat dipublikasi.\r\n- Pengukuran Indikator Kinerja Tidak Tepat', 'Nilai AKIp Inspektorat Jenderal 82', NULL, NULL),
(35, '2', 'G.1.1', 'Perjanjian Kinerja', '1', '7', '- Pihak ketiga tidak bertanggungjawab\r\n- Pergantian pejabat\r\n- BMN Hilang\r\n- BMN Pindah Lokasi\r\n- BMN Dijual', 'Indeks kepuasan layanan keuangan dan BMN di Biro Keuangan dan Perlengkapan sebesar 3,23 (Skala Likert 1 - 4)', NULL, NULL),
(36, '2', 'G.1.2', 'Data Kontrak', '7', '7', '-', 'Data kontrak lengkap dan valid.', NULL, NULL),
(37, '2', 'G.1.3', 'Rincian Kontrak', '7', '7', '-', 'Rincian Kontrak jelas, terukur dan rinci.', NULL, NULL),
(38, '2', 'G.1.4', 'Input delivery Order dan Bukti terima dari vendor', '7', '7', '-', 'Aplikatif untuk membuktikan TAO', NULL, NULL),
(39, '2', 'G.1.5', 'Konfirmasi Terima Barang', '7', '7', '-', 'Barang diterima oleh Calon Petani Yang Tepat.', NULL, NULL),
(40, '2', 'G.1.6', 'Input Berita Acara Serah Terima Barang (BAST)', '7', '7', '-', 'BAST terdokumentasi', NULL, NULL),
(41, '2', 'G.1.7', 'Pengajuan Pembayaran', '7', '7', '-', 'Pengajuan pembayaran tepat waktu.', NULL, NULL),
(42, '2', 'G.1.8', 'Input Surat Perintah Membayar dan Surat Perintah Pencairan Dana (SPM/SP2D)', '7', '7', '-', 'Pembayaran SPM dan SP2D tepat waktu, tepat sasaran', NULL, NULL),
(43, '2', 'G.1.9', 'Reviu oleh Inspektorat Jenderal Kementan', '7', '7', '-', 'Rekomendasi hasil audit dapat ditindaklanjuti tepat waktu.', NULL, NULL),
(44, '3', 'G.1.1', 'Perjanjian Kinerja', '1', '5', '- Pihak ketiga tidak bertanggung jawab\r\n- Pergantian pejabat\r\n- Perusahaan pailit\r\n- Pemilik TGR meninggal\r\n- Rekomendasi tidak rekomacu', 'Rasio Rekomendasi Audit Tujuan Tertentu di Lingkup Kementerian Pertanian yang Ditindaklanjuti sebesar 75%', NULL, NULL),
(45, '3', 'G.1.1.1', 'Telaah materi aduan', '7', '5', '-', 'Hasil telaah berkadar pengawasan', NULL, NULL);

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
(1, 1, 'Tidak Signifikan', '- Beban keuangan negara: ≤0,01% dari total anggaran non belanja pegawai pada unit pemilik risiko.\r\n- Penurunan reputasi: Jumlah keluhan pemangku kepentingan (stakehoder) ≤ 10\r\n- Kesehatan dan Keselamatan Kerja: Tidak berbahaya\r\n- Realisasi capaian kinerja sasaran strategis: 100% > Capaian IKU ≥ 97%\r\n- Temuan hasil pemeriksaan BPK dan hasil pengawasan inspektorat: Tidak ada temuan pengembalian uang ke kas negara dan penyimpangan material', NULL, NULL, '2021-10-01 21:28:09'),
(3, 4, 'Signifikan', 'Sesuai dengan area dampak, kriteria ini berdasarkan efek berikut:\r\n\r\nBeban keuangan negara: >1% – 5% dari total anggaran non belanja pegawai pada unit pemilik risiko.\r\nPenurunan Reputasi: Pemberitaan negatif di media lokal dan/atau, Pemberitaan negatif di media sosial yang sesuai fakta.\r\nKesehatan dan Keselamatan Kerja: Gangguan kesehatan fisik dan atau mental berat (tidak mampu melaksanakan tugas >3 minggu atau mengakibatkan cacat tetap atau gangguan jiwa permanen).\r\nRealisasi capaian kinerja sasaran strategis: 87% > Capaian IKU ⩾ 80%\r\nTemuan hasil pemeriksaan BPK dan hasil pengawasan inspektorat\r\n: Ada temuan pengembalian uang ke kas negara dan/atau penyimpangan >1%–5% dari total anggaran.', NULL, NULL, '2021-09-28 00:13:20'),
(4, 2, 'Minor', '- Beban keuangan negara: >0,01% - 0,1% dari total anggaran non belanja pegawai pada unit pemilik risiko.\r\n- Penurunan reputasi: Jumlah keluhan pemangku kepentingan (stakehoder) sebanyak 10 s.d. 20\r\n- Kesehatan dan Keselamatan Kerja: Gangguan kesehatan fisik ringan (mampu bekerja pada hari yang sama).\r\n- Realisasi capaian kinerja sasaran strategis: 97% > Capaian IKU ≥ 92%\r\n- Temuan hasil pemeriksaan BPK dan hasil pengawasan inspektorat: ada temuan pengembalian uang ke kas negara dan/atau penyimpanagan s/d 0,1% dari total anggaran.', NULL, NULL, NULL),
(5, 3, 'Moderat', '- Beban keuangan negara: >0,1% - 1% dari total anggaran non belanja pegawai pada unit pemilik risiko.\r\n- Penurunan reputasi: Jumlah keluhan pemangku kepentingan (stakehoder) sebanyak >20\r\n- Kesehatan dan Keselamatan Kerja: Gangguan kesehatan fisik dan/atau mental sedang (tidak mampu melaksanakan tugas >1 hari s/d 3 minggu).\r\n- Realisasi capaian kinerja sasaran strategis: 92% > Capaian IKU ≥ 87%.\r\n- Temuan hasil pemeriksaan BPK dan hasil pengawasan inspektorat: Ada temuan pengembalian uang ke kas negara dan/atau penyimpangan >0,1% - 1% dari total anggaran.', NULL, NULL, NULL),
(6, 5, 'Sangat Signifikan', '- Beban keuangan negara: >5% dari total anggaran non belanja pegawai pada unit pemilik risiko.\r\n- Penurunan reputasi: Pemberitaan negatif di media massa nasional dan atau media massa internasional | Pemberitaan negatif di media sosial menjadi trending topic nasional dan atau internasional\r\n- Kesehatan dan Keselamatan Kerja: Kejadian fatal/kematian.\r\n- Realisasi capaian kinerja sasaran strategis: 80% > Capaian IKU ≥ 70%.\r\n- Temuan hasil pemeriksaan BPK dan hasil pengawasan inspektorat: Ada temuan pengembalian uang ke kas negara dan/atau penyimpangan >5% dari total anggaran.', NULL, NULL, NULL);

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
(1, 5, 'Hampir Pasti Terjadi', '- Persentase dalam 1 tahun: 50% < x < 100%, dan/atau\r\n- Jumlah frekuensi dalam 1 tahun: sangat sering (>12 kali), dan/atau\r\n- Kejadian Toleransi Rendah: 1 kejadian dalam 1 tahun terakhir.', NULL, NULL, '2021-10-01 21:23:08'),
(8, 1, 'Hampir Tidak Terjadi', 'Persentase dalam 1 tahun: 0% < X ⩽ 5%, dan/atau\r\nJumlah Frekuensi dalam 1 tahun: sangat jarang,< 2 kali, dan/atau\r\nKejadian Toleransi Rendah: 1 kejadian dalam 5 tahun terakhir.', NULL, NULL, NULL),
(9, 2, 'Jarang Terjadi', '- Persentase dalam 1 tahun: 5% < x ≤ 10%, dan/atau\r\n- Jumlah frekuensi dalam 1 tahun: jarang: 2 kali s.d. 5 kali, dan/atau\r\n- Kejadian Toleransi Rendah: 1 kejadian dalam 4 tahun terakhir.', NULL, NULL, NULL),
(10, 3, 'Kadang Terjadi', '- Persentase dalam 1 tahun: 10% < x ≤ 20%, dan/atau\r\n- Jumlah frekuensi dalam 1 tahun: cukup sering: 6 s.d. 9 kali, dan/atau\r\n- Kejadian Toleransi Rendah: 1 kejadian dalam 3 tahun terakhir.', NULL, NULL, NULL),
(11, 4, 'Sering Terjadi', '- Persentase dalam 1 tahun: 20% < x ≤ 50%, dan/atau\r\n- Jumlah frekuensi dalam 1 tahun: sering: 10 kali s.d. 12 kali, dan/atau\r\n- Kejadian Toleransi Rendah: 1 kejadian dalam 2 tahun terakhir.', NULL, NULL, NULL);

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
(1, 'Efektivitas  dan efisiensi', NULL, '2021-10-18 19:03:49'),
(4, 'Ketaatan, Efektivitas dan Efisiensi', NULL, '2021-10-18 19:04:01'),
(5, 'Ketaatan', NULL, NULL),
(6, 'Keandalan Pelaporan Keuangan', NULL, NULL),
(7, 'Pengamanan Aset Negara', NULL, NULL);

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
(14, '2014_10_12_000000_create_users_table', 1),
(15, '2014_10_12_100000_create_password_resets_table', 1),
(16, '2019_08_19_000000_create_failed_jobs_table', 1),
(17, '2021_09_25_034108_probabilitas', 1),
(18, '2021_09_25_035126_create_dampaks_table', 1),
(19, '2021_09_25_035826_create_besaranresikos_table', 1),
(20, '2021_09_25_040207_create_kategoriresikos_table', 1),
(21, '2021_09_25_040430_create_jeniskonteks_table', 1),
(22, '2021_09_25_040603_create_penyebabs_table', 1),
(23, '2021_09_25_040739_create_metodes_table', 1),
(24, '2021_09_25_041103_create_klasifikasi_sub_unsur_spips_table', 1),
(25, '2021_09_25_041245_create_departemens_table', 1),
(26, '2021_09_28_061908_create_konteks_table', 2),
(27, '2021_09_28_065159_create_pemangku_kepentingans_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelaksanaan_manajemen_risiko`
--

CREATE TABLE `pelaksanaan_manajemen_risiko` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `faktur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_departemen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pemilik_risiko` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan_pemilik_risiko` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_koordinator_pengelola_risiko` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan_koordinator_pengelola_risiko` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `priode_penerapan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `priode_penerapan_awal` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `priode_penerapan_akhir` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `selera_risiko` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pelaksanaan_manajemen_risiko`
--

INSERT INTO `pelaksanaan_manajemen_risiko` (`id`, `faktur`, `id_departemen`, `nama_pemilik_risiko`, `jabatan_pemilik_risiko`, `nama_koordinator_pengelola_risiko`, `jabatan_koordinator_pengelola_risiko`, `priode_penerapan`, `priode_penerapan_awal`, `priode_penerapan_akhir`, `selera_risiko`, `created_at`, `updated_at`) VALUES
(12, '1', '8', 'Inspektorat Jenderal', 'Inspektur Jenderal', 'Kelompok Perencanaan dan Evaluasi', 'Koordinator Kelompok Perencanaan dan Evaluasi', '2021', '1970-01-01', '1970-01-01', 15, NULL, '2021-10-24 08:49:24'),
(13, '2', '7', 'Kepala Biro KP dan BMN', 'Kepala Biro KP dan BMN', 'Bagian Perencanaan dan Evaluasi', 'Koordinator Perencanaan dan Evaluasi', '2021', '2021-01-01', '2021-12-31', 10, NULL, '2021-10-24 05:57:52'),
(14, '3', '5', 'Inspektorat Investigasi', 'Inspektur Investigasi', 'Bagian Perencanaan dan Evaluasi', 'Koordinator Perencanaan dan Evaluasi', '2021', '2021-01-01', '2021-12-31', 10, NULL, NULL);

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
(5, '17', '2021-09-29', 'Data transaksi belum update.'),
(6, '18', '2021-10-26', 'kurangnya penguasaan kompetensi teknis substantif oleh petugas.'),
(7, '19', '2021-10-28', 'Penanggungjawab kurang melakukan eksplorasi terhadap para pihak terkait.'),
(8, '20', '2021-12-07', 'Penanggungjawab kurang melakukan eksplorasi terhadap para pihak terkait.'),
(9, '21', '2021-11-01', 'Dokumen transaksi dimusnahkan/Hilang.'),
(10, '22', '2021-10-26', 'Dokumen transaksi dimusnahkan/Hilang.'),
(11, '23', '2021-10-13', 'Anggaran untuk gaji dikorupsi.'),
(12, '29', '2021-10-04', 'Server error'),
(13, '30', '2021-10-01', 'Dokumen belum update'),
(14, '31', '2021-09-27', 'Dokumen kajian belum memadai.'),
(15, '32', '2021-10-01', 'Server Error.'),
(16, '33', '2021-09-14', 'Kegagalan dalam sertifikasi. Sebagian SDM gagal mendapatkan sertifikasi kompetensi.'),
(17, '34', '2021-10-27', '1. Data/Laporan/Berita belum update\r\n2. Pengadu tidak melampirkan cukup bukti.'),
(18, '35', '2021-10-28', '1. Data/ laporan/ berita belum update\r\n2. Pengadu tidak melampirkan cukup bukti'),
(19, '36', '2021-10-27', 'kurangnya penguasaan kompetensi teknis substantif.'),
(20, '37', '2021-10-27', 'Tim kurang melakukan eksplorasi terhadap para pihak terkait.'),
(21, '38', '2021-11-05', 'pelaku kunci tidak ada.'),
(22, '39', '2021-11-15', 'kegagalan sertifikasi kompetensi.'),
(23, '41', '2021-11-05', '1. kesulitan menetapkan penyebab hakiki.\r\n2. kriteria audit multitafsir.');

-- --------------------------------------------------------

--
-- Table structure for table `pemangku_kepentingan`
--

CREATE TABLE `pemangku_kepentingan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `faktur_pemangku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pemangku_kepentingan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelompok_pemangku_kepentingan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemangku_kepentingan`
--

INSERT INTO `pemangku_kepentingan` (`id`, `faktur_pemangku`, `pemangku_kepentingan`, `keterangan`, `kelompok_pemangku_kepentingan`, `created_at`, `updated_at`) VALUES
(1, '', 'sfdasafd', 'asdsadf', NULL, NULL, '2021-09-28 19:32:51'),
(2, '', 'dsfa', 'sdfa', NULL, NULL, NULL),
(10, 'FK2021-09-29-00003', 'ghggh', 'gsfgfd', NULL, NULL, NULL),
(12, 'FK2021-09-29-00003', 'Tes', 'Tess', NULL, NULL, NULL),
(13, 'FK2021-09-29-00001', 'coba1', '45', NULL, NULL, '2021-10-03 23:05:39'),
(14, 'FK2021-10-04-00005', 'test', '1', NULL, NULL, NULL),
(15, 'FK2021-10-04-00005', 'coba', '2', NULL, NULL, NULL),
(16, 'FK2021-10-06-00006', 'Inspektorat Jenderal', 'Sebagai pengawas dari departemen pemilik risiko.', NULL, NULL, NULL),
(17, 'FK2021-10-06-00006', 'Departemen keuangan', 'Sebagai pengawas budget.', NULL, NULL, NULL),
(18, 'FK2021-10-07-00007', 'Departemen keuangan', 'Sebagai pengawas budget.', NULL, NULL, NULL),
(19, '8', 'test', 'test', NULL, NULL, NULL),
(20, '8', 'sdf', 'asd', NULL, NULL, NULL),
(21, '8', 'test', 'test', NULL, NULL, NULL),
(23, '9', 'Pemangku Kepentingan', 'PJ Perjanjian Kinerja', NULL, NULL, NULL),
(24, '9', 'Inspektur Jenderal', 'PJ Perjanjian Kinerja', NULL, NULL, NULL),
(25, '9', 'Eselon I', 'Pengguna Data Kinerja', NULL, NULL, NULL),
(26, '9', 'UPT dan Dinas', 'Pengguna Data Kinerja', NULL, NULL, NULL),
(27, '10', 'satu', 'tesstttttttt', NULL, NULL, NULL),
(28, '1', 'Menteri Pertanian', 'PJ Perjanjian Kerja', NULL, NULL, NULL),
(29, '1', 'Inspektur Jenderal', 'PJ Perjanjian Kerja', NULL, NULL, NULL),
(30, '1', 'Inspektorat IV Itjen Kementan', 'Reviuer', NULL, NULL, NULL),
(31, '1', 'Kementerian Pan dan RB', 'Evaluator', NULL, NULL, NULL),
(32, '1', 'Eselon I', 'Pengguna Data Kinerja', NULL, NULL, NULL),
(33, '2', 'Menteri Pertanian', 'PJ Perjanjian Kinerja', NULL, NULL, NULL),
(34, '2', 'Inspektur Jenderal', 'PJ Perjanjian Kinerja', NULL, NULL, NULL),
(35, '2', 'Eselon I', 'Pengguna Data Kinerja', NULL, NULL, NULL),
(36, '2', 'Eselon II', 'Pengguna Data Kinerja', NULL, NULL, NULL),
(37, '2', 'UPT dan Dinas', 'Pengguna Data Kinerja', NULL, NULL, NULL),
(38, '2', 'Masyarakat/Mitra', 'Stakeholder Eksternal', NULL, NULL, NULL),
(39, '3', 'Menteri Pertanian', 'PJ Perjanjian Kinerja', NULL, NULL, NULL),
(40, '3', 'Inspektur Jenderal', 'PJ Perjanjian Kinerja', NULL, NULL, NULL),
(41, '3', 'Eselon I', 'Pengguna data kinerja', NULL, NULL, NULL),
(42, '3', 'Masyarakat/Mitra', 'Stakeholder Eksternal', NULL, NULL, NULL),
(43, '3', 'UPT dan Dinas', 'Pengguna Data Kinerja', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pencatatan_peristiwa_resiko`
--

CREATE TABLE `pencatatan_peristiwa_resiko` (
  `id` int(255) UNSIGNED NOT NULL,
  `id_manajemen` varchar(250) NOT NULL,
  `id_risiko` varchar(250) NOT NULL,
  `departemen_id` varchar(255) NOT NULL,
  `tahun` varchar(255) DEFAULT NULL,
  `resiko_id` varchar(255) DEFAULT NULL,
  `pernyataan` varchar(255) DEFAULT NULL,
  `uraian` text DEFAULT NULL,
  `waktu` date NOT NULL,
  `tempat` varchar(255) NOT NULL,
  `kriteria_id` varchar(255) NOT NULL,
  `pemicu` text NOT NULL,
  `penyebab_id` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pencatatan_peristiwa_resiko`
--

INSERT INTO `pencatatan_peristiwa_resiko` (`id`, `id_manajemen`, `id_risiko`, `departemen_id`, `tahun`, `resiko_id`, `pernyataan`, `uraian`, `waktu`, `tempat`, `kriteria_id`, `pemicu`, `penyebab_id`, `created_at`, `updated_at`) VALUES
(5, '12', '36', '12', NULL, 'G.1.1.EP.LAKIN.4.1', NULL, 'Server Error', '2021-09-15', 'Inspektorat Jenderal', '1', 'Internet tidak stabil dan server down.', '7', '2021-10-25 04:07:46', '2021-10-24 21:07:46'),
(6, '12', '37', '12', NULL, 'G.1.1.EP.LAKIN.6.1', NULL, 'Dokumen Belum Update', '2021-09-29', 'Inspektorat Jenderal', '4', 'Tidak ada update informasi', '4', '2021-10-25 04:07:57', '2021-10-24 21:07:57'),
(7, '12', '38', '12', NULL, 'G.1.1.EP.LAKIN.2.1', NULL, 'Dokumen kajian belum memadai.', '2021-08-03', 'Inspektorat Jenderal', '4', 'Referensi Kurang', '4', '2021-10-25 04:08:08', '2021-10-24 21:08:08'),
(8, '12', '39', '12', NULL, 'G.1.1.EP.LAKIN.7.1', NULL, 'Server Error', '2021-10-11', 'Inspektorat Jenderal', '3', 'Internet tidak stabil dan server down.', '7', '2021-10-25 04:08:17', '2021-10-24 21:08:17'),
(9, '12', '40', '12', NULL, 'G.1.1.EP.LAKIN.5.1', NULL, 'Kegagalan dalam sertifikasi.', '2021-09-29', 'Inspektorat Jenderal', '4', 'Tidak cukup memahami materi', '1', '2021-10-25 04:08:44', '2021-10-24 21:08:44'),
(10, '13', '24', '13', NULL, 'G.1.1.BMN.6.1', NULL, 'Data transaksi belum update.', '2021-10-05', 'Sekretariat Jenderal', '5', 'Petugas lalai melakukan update data.', '4', '2021-10-25 04:09:12', '2021-10-24 21:09:12'),
(11, '14', '41', '5', NULL, 'G.1.1.INV.ATT.6.1', NULL, '1. Data/ laporan/ berita belum update\r\n2. Pengadu tidak melampirkan cukup bukti', '2021-10-27', 'Inspektorat Jenderal', '4', 'Belum ditetapkan kewajiban pengadu melampirkan bukti dukung.', '4', '2021-10-25 02:36:46', '0000-00-00 00:00:00'),
(12, '13', '25', '7', NULL, 'G.1.1.BMN.5.1', NULL, 'Kurangnya penguasaan kompetensi teknis substantif oleh petugas.', '2021-10-07', 'Sekretariat Jenderal', '5', 'Petugas tidak cermat dalam melakukan verifikasi bukti transaksi dan kejadian penting.', '3', '2021-10-25 07:18:31', '0000-00-00 00:00:00'),
(13, '13', '26', '7', NULL, 'G.1.1.BMN.6.2', NULL, 'Penanggungjawab kurang melakukan eksplorasi terhadap para pihak terkait.', '2021-10-04', 'Sekretariat Jenderal', '3', 'Pengendalian pelaksanaan kontrak tidak optimal.', '4', '2021-10-25 07:21:14', '0000-00-00 00:00:00'),
(14, '13', '27', '7', NULL, 'G.1.1.BMN.6.3', NULL, 'Penanggungjawab kurang melakukan eksplorasi terhadap para pihak terkait.', '2021-10-13', 'Sekretariat Jenderal', '3', 'Tidak melakukan pemeriksaan fisik di lapangan.', '4', '2021-10-25 07:21:56', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `pengendalian_risiko`
--

CREATE TABLE `pengendalian_risiko` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `faktur` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_manajemen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_departemen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_risiko` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_akar_masalah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_tindak_pengendalian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `respons_risiko` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail_respons_risiko` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kegiatan_pengendalian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_klasifikasi_sub_unsur_spip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penanggung_jawab` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `indikator_keluaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target_waktu` date NOT NULL,
  `target_waktu_akhir` date NOT NULL,
  `status_pelaksanaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `frekuensi_saat_ini` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dampak_saat_ini` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pr_saat_ini` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `besaran_saat_ini` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengendalian_risiko`
--

INSERT INTO `pengendalian_risiko` (`id`, `faktur`, `id_manajemen`, `id_departemen`, `id_risiko`, `id_akar_masalah`, `kode_tindak_pengendalian`, `respons_risiko`, `detail_respons_risiko`, `kegiatan_pengendalian`, `id_klasifikasi_sub_unsur_spip`, `penanggung_jawab`, `indikator_keluaran`, `target_waktu`, `target_waktu_akhir`, `status_pelaksanaan`, `frekuensi_saat_ini`, `dampak_saat_ini`, `pr_saat_ini`, `besaran_saat_ini`, `created_at`, `updated_at`) VALUES
(17, '2', '13', '7', '24', '15', 'PG.G.1.1.BMN.6.1.MD.1', 'Mengurangi Frekuensi', 'Melakukan penelusuran bukti transaksi dan kejadian penting.', '1. Memanfaatkan teknologi informasi untuk memperoleh bukti (P18.c)\r\n2. Pencatatan Akurat dan Tepat waktu atas transaksi dan kejadian penting (P18.h)', '1', 'Kepala Biro KP & BMN', 'Bukti Transaksi atas kejadian penting', '2021-09-29', '2021-10-01', 'Selesai Dilaksanakan', '3 - Kadang Terjadi', '3 - Moderat', '#ffff00', '14', NULL, NULL),
(18, '2', '13', '7', '25', '16', 'PG.G.1.1.BMN.5.1.MY.1', 'Mengurangi Frekuensi, Mengurangi Dampak', 'Melakukan penelusuran bukti transaksi dan kejadian penting untuk mendapatkan data dan informasi penting', 'Reviu berjenjang secara efektif (P18.a)', '1', 'Kepala Biro KP & BMN', 'Bukti Transaksi atas kejadian penting', '2021-10-26', '2021-10-26', 'Selesai Dilaksanakan', '3 - Kadang Terjadi', '3 - Moderat', '#ffff00', '14', NULL, NULL),
(19, '2', '13', '7', '26', '17', 'PG.G.1.1.BMN.6.2.MD.1', 'Mengurangi Frekuensi, Mengurangi Dampak', 'Melakukan reviu berjenjang atas transaksi dan kejadian penting', 'Reviu berjenjang secara efektif (P18.a)', '1', 'Kepala Biro KP & BMN', 'Bukti Transaksi atas kejadian penting', '2021-10-28', '2021-10-28', 'Dalam Proses Pelaksanaan', '2 - Jarang Terjadi', '4 - Signifikan', '#ffff00', '13', NULL, NULL),
(20, '2', '13', '7', '27', '18', 'PG.G.1.1.BMN.6.3.MD.1', 'Mengurangi Frekuensi, Mengurangi Dampak', 'Melakukan penelurusan bukti atas transaksi dan kejadian penting.', 'Pengendalian fisik atas aset (P.18.d)', '1', 'Kepala Biro KP & BMN', 'Bukti Transaksi atas kejadian penting', '2021-11-05', '2021-11-05', 'Selesai Dilaksanakan', '3 - Kadang Terjadi', '4 - Signifikan', '#ffc000', '17', NULL, NULL),
(21, '2', '13', '7', '28', '19', 'PG.G.1.1.BMN.5.2.MD.1', 'Mengurangi Frekuensi', 'Melakukan reviu kinerja atas pencatatan transaksi dan kejadian penting.', '1. Memanfaatkan teknologi informasi untuk memperoleh bukti (P18.c)\r\n2. Pencatatan Akurat dan Tepat waktu atas transaksi dan kejadian penting (P18.h)\r\n3. Akuntabilitas sumberdaya dan pencatatannya (P18.j)', '1', 'Kepala Biro KP & BMN', 'Bukti Transaksi atas kejadian penting', '2021-11-01', '2021-11-06', 'Selesai Dilaksanakan', '2 - Jarang Terjadi', '4 - Signifikan', '#ffff00', '13', NULL, NULL),
(22, '2', '13', '7', '29', '20', 'PG.G.1.1.BMN.5.3.MY.1', 'Mengurangi Frekuensi, Mengurangi Dampak', 'Mendapatkan bukti yang relevan, kompeten, material dan cukup atas transaksi dan kejadian yang penting', 'Pembinaan Sumber daya manusia/Mendesain pelatihan yang sesuai dengan kebutuhan (P18,b)', '3', 'Kepala Biro KP & BMN', 'Bukti Transaksi atas kejadian penting', '2021-11-08', '2021-11-12', 'Dalam Proses Pelaksanaan', '2 - Jarang Terjadi', '4 - Signifikan', '#ffff00', '13', NULL, NULL),
(23, '2', '13', '7', '30', '21', 'PG.G.1.1.BMN.5.4.MD.1', 'Mengurangi Frekuensi', 'Mendapatkan bukti yang relevan, kompeten, material dan cukup atas transaksi dan kejadian yang penting.', '1. Reviu Berjenjang berbantuan teknologi informasi (P18.a, b)\r\n2. Pencatatan Akurat dan Tepat waktu atas transaksi dan kejadian penting (P18.h)\r\n3. Akuntabilitas sumberdaya dan pencatatannya (P18.j)', '3', 'Kepala Biro KP & BMN', 'Bukti Transaksi atas kejadian penting', '2021-11-09', '2021-11-11', 'Dalam Proses Pelaksanaan', '3 - Kadang Terjadi', '4 - Signifikan', '#ffc000', '17', NULL, NULL),
(24, '2', '13', '7', '31', '22', 'PG.G.1.1.BMN.7.1.EX.1', 'Mengurangi Frekuensi', 'Mendapatkan bukti relevan, kompeten, material dan cukup atas transaksi dan kejadian yang penting berbasis teknologi informasi.', '1. Reviu Berjenjang (P18.a)\r\n2. Pencatatan Akurat dan Tepat waktu atas transaksi dan kejadian penting (P18.h)\r\n3. Akuntabilitas sumberdaya dan pencatatannya (P18.j)', '3', 'Kepala Biro KP & BMN', 'Bukti Transaksi atas kejadian penting', '2021-11-22', '2021-11-26', 'Belum Dilaksanakan', '2 - Jarang Terjadi', '3 - Moderat', '#00b050', '11', NULL, NULL),
(25, '2', '13', '7', '32', '23', 'PG.G.1.1.BMN.7.2.EX.1', 'Mengurangi Frekuensi', 'Mendapatkan bukti relevan, kompeten, material dan cukup atas transaksi dan kejadian yang penting berbasis teknologi informasi.', '1. Reviu Berjenjang (P18.a)\r\n2. Pencatatan Akurat dan Tepat waktu atas transaksi dan kejadian penting (P18.h)', '3', 'Kepala Biro KP & BMN', 'Bukti Transaksi atas kejadian penting', '2021-11-29', '2021-12-03', 'Belum Dilaksanakan', '1 - Hampir Tidak Terjadi', '2 - Minor', '#32bdea', '3', NULL, NULL),
(26, '2', '13', '7', '33', '24', 'PG.G.1.1.BMN.7.3.MD.1', 'Mengurangi Dampak', 'Melakukan verifikasi dan reviu berjenjang atas transaksi dan kejadian penting terkait.', '1. Reviu Berjenjang (P18.a)\r\n2. Pencatatan Akurat dan Tepat waktu atas transaksi dan kejadian penting (P18.h)\r\n3. Akuntabilitas sumberdaya dan pencatatannya (P18.j)', '3', 'Kepala Biro KP & BMN', 'Bukti Transaksi atas kejadian penting', '2021-11-16', '2021-11-18', 'Belum Dilaksanakan', '3 - Kadang Terjadi', '4 - Signifikan', '#ffc000', '17', NULL, NULL),
(27, '2', '13', '7', '34', '25', 'PG.G.1.1.BMN.6.4.MD.1', 'Mengurangi Frekuensi, Mengurangi Dampak', 'Melakukan verifikasi dan reviu berjenjang atas transaksi dan kejadian penting terkait.', '1. Reviu Berjenjang (P18.a)\r\n2. Pencatatan Akurat dan Tepat waktu atas transaksi dan kejadian penting (P18.h)\r\n3. Akuntabilitas sumberdaya dan pencatatannya (P18.j)', '3', 'Kepala Biro KP & BMN', 'Bukti Transaksi atas kejadian penting', '2021-12-01', '2021-12-07', 'Belum Dilaksanakan', '3 - Kadang Terjadi', '2 - Minor', '#00b050', '10', NULL, NULL),
(28, '2', '13', '7', '35', '26', 'PG.G.1.1.BMN.5.5.MD.1', 'Mengurangi Frekuensi, Mengurangi Dampak', 'Melakukan verifikasi dan reviu berjenjang atas transaksi dan kejadian penting terkait.', '1. Reviu Berjenjang (P18.a)\r\n2. Pencatatan Akurat dan Tepat waktu atas transaksi dan kejadian penting (P18.h)\r\n3. Akuntabilitas sumberdaya dan pencatatannya (P18.j)', '3', 'Kepala Biro KP & BMN', 'Bukti Transaksi atas kejadian penting', '2021-11-02', '2021-11-04', 'Belum Dilaksanakan', '4 - Sering Terjadi', '4 - Signifikan', '#ffc000', '19', NULL, NULL),
(29, '1', '12', '8', '36', '27', 'PG.G.1.1.EP.LAKIN.4.1.EX.1', 'Mengurangi Dampak', 'Mempercepat realisasi kegiatan', 'Memanfaatkan teknologi informasi', '1', 'Koordinator Perencanaan dan Evaluasi', 'Aplikasi Komunikasi (Langganan Zoom)', '2021-10-01', '2021-12-31', 'Selesai Dilaksanakan', '1 - Hampir Tidak Terjadi', '3 - Moderat', '#32bdea', '5', NULL, NULL),
(30, '1', '8', '12', '37', '28', 'PG.G.1.1.EP.LAKIN.6.1.MD.1', 'Mengurangi Frekuensi, Mengurangi Dampak', 'Agar capaian realisasi sesuai target', 'Melakukan pemantauan', '7', 'Koordinator Perencanaan dan Evaluasi', 'Dokumen Pemantauan', '2021-10-25', '2021-11-25', 'Dalam Proses Pelaksanaan', '4 - Sering Terjadi', '3 - Moderat', '#ffc000', '16', NULL, NULL),
(31, '1', '12', '8', '38', '29', 'PG.G.1.1.EP.LAKIN.2.1.MD.1', 'Mengurangi Dampak', 'Nilai Evaluasi AKIP lebih tinggi/sesuai target', 'Melakukan Kajian Metodologi', '3', 'Koordinator Perencanaan dan Evaluasi', 'Dokumen Kajian', '2021-07-01', '2021-12-31', 'Dalam Proses Pelaksanaan', '1 - Hampir Tidak Terjadi', '3 - Moderat', '#32bdea', '5', NULL, NULL),
(32, '1', '12', '8', '39', '30', 'PG.G.1.1.EP.LAKIN.7.1.EX.1', 'Mengurangi Frekuensi, Mengurangi Dampak', 'Mempercepat data realisasi', 'Memanfaatkan teknologi informasi', '1', 'Koordinator Perencanaan dan Evaluasi', 'Aplikasi Komunikasi (Langganan Zoom)', '2021-10-01', '2021-12-31', 'Selesai Dilaksanakan', '5 - Hampir Pasti Terjadi', '5 - Sangat Signifikan', '#ff0000', '25', NULL, NULL),
(33, '1', '12', '8', '40', '31', 'PG.G.1.1.EP.LAKIN.5.1.MN.1', 'Mengurangi Frekuensi, Mengurangi Dampak', 'Meningkatkan kompetensi SDM', 'Melakukan pelatihan SDM', '3', 'Koordinator Perencanaan dan Evaluasi', 'Sertifikasi Kompetensi', '2021-01-01', '2021-12-31', 'Selesai Dilaksanakan', '2 - Jarang Terjadi', '3 - Moderat', '#00b050', '11', NULL, NULL),
(34, '3', '14', '5', '41', '32', 'PG.G.1.1.INV.ATT.6.1.MD.1', 'Mengurangi Frekuensi', 'Mendapatkan bukti dukung hasil telaah yang rekomacu', '1. Memanfaatkan teknologi informasi untuk memperoleh bukti (P18.c)\r\n2. Pencatatan akurat dan tepat waktu atas transaksi dan kejadian penting (P18.h)', '1', 'Inspektur Investigasi', 'Data/Laporan/Berita', '2021-10-26', '2021-10-28', 'Selesai Dilaksanakan', '3 - Kadang Terjadi', '2 - Minor', '#00b050', '10', NULL, NULL),
(35, '3', '14', '5', '42', '33', 'PG.G.1.1.INV.ATT.5.1.MY.1', 'Mengurangi Frekuensi', 'Meningkatkan kompetensi auditor.', 'Briefing teknis (P18.b)', '1', 'Inspektur Investigasi', 'Dokumen', '2021-10-28', '2021-10-28', 'Selesai Dilaksanakan', '2 - Jarang Terjadi', '2 - Minor', '#00b050', '7', NULL, NULL),
(36, '3', '14', '5', '43', '34', 'PG.G.1.1.INV.ATT.6.3.MD.1', 'Mengurangi Frekuensi, Mengurangi Dampak', 'Merumuskan modus operandi (why, when, what, where, who, how dan how much),', 'Gelar kasus (P18.b)', '1', 'Inspektur Investigasi', 'Dokumen', '2021-10-27', '2021-10-27', 'Selesai Dilaksanakan', '1 - Hampir Tidak Terjadi', '3 - Moderat', '#32bdea', '5', NULL, NULL),
(37, '3', '14', '5', '44', '35', 'PG.G.1.1.INV.ATT.6.4.MD.1', 'Mengurangi Frekuensi', 'Menyusun program kerja yang terstruktur untuk menelusuri dan membuktikan modus operandi.', 'Gelar kasus (P18.b).', '1', 'Inspektur Investigasi', 'Dokumen', '2021-10-27', '2021-10-27', 'Selesai Dilaksanakan', '1 - Hampir Tidak Terjadi', '5 - Sangat Signifikan', '#ff0000', '20', NULL, NULL),
(38, '3', '14', '5', '45', '36', 'PG.G.1.1.INV.ATT.6.5.MD.1', 'Mengurangi Frekuensi', 'Mendapatkan bukti audit yang rekomacu (relevan, kompeten, material dan cukup).', '1. Memanfaatkan teknologi informasi untuk memperoleh bukti (P18.c)\r\n2. Pencatatan Akurat dan Tepat waktu atas transaksi dan kejadian penting (P18.h)\r\n3. Akuntabilitas sumberdaya dan pencatatannya (P18.j)', '1', 'Inspektur Investigasi', 'Surat permintaan keterangan', '2021-11-01', '2021-11-09', 'Selesai Dilaksanakan', '2 - Jarang Terjadi', '5 - Sangat Signifikan', '#ff0000', '21', NULL, NULL),
(39, '3', '14', '5', '46', '37', 'PG.G.1.1.INV.ATT.6.6.MY.1', 'Mengurangi Frekuensi', 'Mendapatkan bukti audit yang rekomacu (relevan, kompeten, material dan cukup) untuk mengungkap dan membuktikan modus operandi.', 'Pembinaan Sumber daya manusia/Mendesain pelatihan yang sesuai dengan kebutuhan (P18,b).', '3', 'Inspektur Investigasi', 'Sertifikasi kompetensi', '2021-11-15', '2021-11-19', 'Dalam Proses Pelaksanaan', '1 - Hampir Tidak Terjadi', '5 - Sangat Signifikan', '#ff0000', '20', NULL, NULL),
(40, '3', '5', '14', '47', '38', 'PG.G.1.1.INV.ATT.6.7.MD.1', 'Mengurangi Frekuensi', 'Menyusun Kertas Kerja Audit lengkap, valid, akurat, tertelusur dan terdokumentasikan dengan baik/tertib.', '1. Reviu Berjenjang berbantuan teknologi informasi (P18.a, b).\r\n2. Pencatatan Akurat dan Tepat waktu atas transaksi dan kejadian penting (P18.h).\r\n3. Akuntabilitas sumberdaya dan pencatatannya (P18.j).', '3', 'Inspektur Investigasi', 'Aplikasi.', '2021-11-10', '2021-11-12', 'Terlambat', '3 - Kadang Terjadi', '4 - Signifikan', '#ffc000', '17', NULL, NULL),
(41, '3', '14', '5', '48', '39', 'PG.G.1.1.INV.ATT.6.8.MD.1', 'Mengurangi Frekuensi, Mengurangi Dampak', 'Menyusun laporan hasil audit sesuai standar yang didukung dengan bukti-bukti yang rekomacu dan tepat waktu;', '1. Reviu Berjenjang (P18.a).\r\n2. Pencatatan Akurat dan Tepat waktu atas transaksi dan kejadian penting (P18.h).\r\n3. Akuntabilitas sumberdaya dan pencatatannya (P18.j).', '3', 'Inspektur Investigasi', 'Dokumen FHA', '2021-11-05', '2021-11-05', 'Selesai Dilaksanakan', '1 - Hampir Tidak Terjadi', '4 - Signifikan', '#00b050', '8', NULL, NULL),
(42, '3', '14', '5', '49', '40', 'PG.G.1.1.INV.ATT.6.9.EX.1', 'Mengurangi Frekuensi', 'Memastikan bahwa laporan hasil audit telah diterima oleh auditi/mitra secara tepat waktu dan tepat sasaran.', '1. Reviu Berjenjang (P18.a).\r\n2. Pencatatan Akurat dan Tepat waktu atas transaksi dan kejadian penting (P18.h).', '3', 'Inspektur Investigasi', 'Form Penerimaan LHA', '2021-11-05', '2021-11-05', 'Belum Dilaksanakan', '1 - Hampir Tidak Terjadi', '4 - Signifikan', '#00b050', '8', NULL, NULL),
(43, '3', '14', '5', '50', '41', 'PG.G.1.1.INV.ATT.7.3.MD.1', 'Mengurangi Frekuensi', 'Melakukan reviu berjenjang dalam penyusunan laporan hasil audit secara berjenjang mulai dari penyusunan KKA, penetapan kriteria, sebab, akibat dan rekomendasi.', '1. Reviu Berjenjang (P18.a)\r\n2. Pencatatan Akurat dan Tepat waktu atas transaksi dan kejadian penting (P18.h)\r\n3. Akuntabilitas sumberdaya dan pencatatannya (P18.j)', '3', 'Inspektur Investigasi', 'Berita Acara Tindak Lanjut', '2021-11-05', '2021-11-05', 'Belum Dilaksanakan', '2 - Jarang Terjadi', '5 - Sangat Signifikan', '#ff0000', '21', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `penyebab`
--

CREATE TABLE `penyebab` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(255) NOT NULL,
  `penyebab` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penyebab`
--

INSERT INTO `penyebab` (`id`, `kode`, `penyebab`, `created_at`, `updated_at`) VALUES
(1, 'MN', 'Orang (Man)', NULL, '2021-09-28 00:03:31'),
(3, 'MY', 'Dana (Money)', NULL, '2021-09-28 00:03:43'),
(4, 'MD', 'Metode (Method)', NULL, NULL),
(5, 'MR', 'Bahan (Material)', NULL, NULL),
(6, 'MC', 'Mesin (Machine)', NULL, NULL),
(7, 'EX', 'Eksternal', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `perubahan_besaran_risiko`
--

CREATE TABLE `perubahan_besaran_risiko` (
  `id` int(11) NOT NULL,
  `id_pelaksanaan_manajemen_risiko` int(11) DEFAULT NULL,
  `kode_resiko_teridentifikasi` varchar(200) DEFAULT NULL,
  `besaran_saat_ini` varchar(200) DEFAULT NULL,
  `frekuensi_saat_ini` varchar(200) DEFAULT NULL,
  `dampak_saat_ini` varchar(200) DEFAULT NULL,
  `pr_saat_ini` varchar(200) DEFAULT NULL,
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
-- Dumping data for table `perubahan_besaran_risiko`
--

INSERT INTO `perubahan_besaran_risiko` (`id`, `id_pelaksanaan_manajemen_risiko`, `kode_resiko_teridentifikasi`, `besaran_saat_ini`, `frekuensi_saat_ini`, `dampak_saat_ini`, `pr_saat_ini`, `id_frekuensi_aktual`, `label_frekuensi`, `id_dampak_aktual`, `label_dampak_aktual`, `besaran_aktual`, `warna_aktual`, `deviasi`, `rekomendasi`) VALUES
(13, 12, 'G.1.1.EP.LAKIN.4.1', NULL, NULL, NULL, NULL, 8, NULL, 1, NULL, 1, '#32bdea', 4, NULL),
(14, 14, 'G.1.1.INV.ATT.6.1', NULL, NULL, NULL, NULL, 10, NULL, 4, NULL, 10, '#00b050', 0, 'Mendapatkan bukti dukung hasil telaah yang rekomacu.'),
(16, 14, 'G.1.1.INV.ATT.6.3', NULL, NULL, NULL, NULL, 8, NULL, 4, NULL, 3, '#32bdea', 2, 'test'),
(17, 14, 'G.1.1.INV.ATT.6.5', NULL, NULL, NULL, NULL, 9, NULL, 3, NULL, 13, '#ffff00', 8, 'Dianalisis kembali apakah memungkinkan untuk menurunkan skor frekuensi setelah menurunkan skor dampak yang sudah dilaksanakan di sini.'),
(18, 14, 'G.1.1.INV.ATT.5.1', '7', '2 - Jarang Terjadi', '2 - Minor', '#00b050', 8, NULL, 1, NULL, 1, '#32bdea', 6, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `resiko_teridentifikasi`
--

CREATE TABLE `resiko_teridentifikasi` (
  `id` int(11) NOT NULL,
  `faktur` varchar(255) DEFAULT NULL,
  `kode_risiko` varchar(255) DEFAULT NULL,
  `number` varchar(255) DEFAULT NULL,
  `full_kode` varchar(255) DEFAULT NULL,
  `id_departmen` varchar(255) DEFAULT NULL,
  `departmen_pemilik_resiko` varchar(255) DEFAULT NULL,
  `periode_penerapan` varchar(255) DEFAULT NULL,
  `id_konteks` varchar(255) DEFAULT NULL,
  `id_jenis_konteks` varchar(255) DEFAULT NULL,
  `konteks` varchar(255) DEFAULT NULL,
  `kode_konteks` varchar(255) DEFAULT NULL,
  `pernyataan_risiko` varchar(255) DEFAULT NULL,
  `id_kategori` varchar(255) DEFAULT NULL,
  `kategori_risiko` varchar(255) DEFAULT NULL,
  `uraian_dampak` varchar(255) DEFAULT NULL,
  `metode_spip` varchar(255) DEFAULT NULL,
  `status_persetujuan` varchar(255) DEFAULT NULL,
  `diajukan_oleh` varchar(255) DEFAULT NULL,
  `diajukan_tanggal` date DEFAULT NULL,
  `persetujuan_oleh` varchar(255) DEFAULT NULL,
  `tanggal_persetujua` date DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `kode_departemen` varchar(255) DEFAULT NULL,
  `id_analisis` varchar(255) DEFAULT NULL,
  `pr` varchar(255) DEFAULT NULL,
  `pr_akhir` varchar(200) DEFAULT NULL,
  `frekuensi_akhir` varchar(250) DEFAULT NULL,
  `dampak_akhir` varchar(250) DEFAULT NULL,
  `frekuensi_awal` varchar(150) DEFAULT NULL,
  `dampak_awal` varchar(150) DEFAULT NULL,
  `besaran_awal` varchar(255) DEFAULT NULL,
  `besaran_akhir` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resiko_teridentifikasi`
--

INSERT INTO `resiko_teridentifikasi` (`id`, `faktur`, `kode_risiko`, `number`, `full_kode`, `id_departmen`, `departmen_pemilik_resiko`, `periode_penerapan`, `id_konteks`, `id_jenis_konteks`, `konteks`, `kode_konteks`, `pernyataan_risiko`, `id_kategori`, `kategori_risiko`, `uraian_dampak`, `metode_spip`, `status_persetujuan`, `diajukan_oleh`, `diajukan_tanggal`, `persetujuan_oleh`, `tanggal_persetujua`, `keterangan`, `status`, `kode_departemen`, `id_analisis`, `pr`, `pr_akhir`, `frekuensi_akhir`, `dampak_akhir`, `frekuensi_awal`, `dampak_awal`, `besaran_awal`, `besaran_akhir`, `created_at`, `updated_at`) VALUES
(24, '2', 'G.1.1.BMN.6', '1', 'G.1.1.BMN.6.1', '7', 'Biro KP dan BMN', '2021', '35', '1', 'Sasaran Strategis/Program', 'G.1.1', 'Belanja barang tidak dapat diyakini keterjadiannya;', '6', '6', 'Realisasi Capaian Kinerja Sasaran Strategis', '6', 'disetujui', 'Biro Keuangan, Perlengkapan dan BMN', '2021-10-24', 'Biro Keuangan, Perlengkapan dan BMN', '2021-10-24', NULL, 'Belum memenuhi selera risiko', 'BMN', '24', '#ffc000', '#ffff00', '3 - Kadang Terjadi', '3 - Moderat', '4 - Sering Terjadi', '3 - Moderat', '16', '14', '2021-10-24 08:28:38', '2021-10-24 08:28:38'),
(25, '2', 'G.1.1.BMN.5', '1', 'G.1.1.BMN.5.1', '7', 'Biro KP dan BMN', '2021', '35', '1', 'Sasaran Strategis/Program', 'G.1.1', 'Pertanggungjawaban realisasi belanja pengelolaan lahan tidak sesuai fakta.', '5', '5', 'Realisasi Capaian Kinerja Sasaran Strategis.', '6', 'disetujui', 'Biro Keuangan, Perlengkapan dan BMN', '2021-10-24', 'Biro Keuangan, Perlengkapan dan BMN', '2021-10-24', NULL, 'Belum memenuhi selera risiko', 'BMN', '25', '#ffff00', '#ffff00', '3 - Kadang Terjadi', '3 - Moderat', '3 - Kadang Terjadi', '3 - Moderat', '14', '14', '2021-10-24 08:29:30', '2021-10-24 08:29:30'),
(26, '2', 'G.1.1.BMN.6', '2', 'G.1.1.BMN.6.2', '7', 'Biro KP dan BMN', '2021', '35', '1', 'Sasaran Strategis/Program', 'G.1.1', 'Pelaksanaan kegiatan swakelola tersebut tidak dilaksanakan sendiri (disub-kontrakan) oleh Kontraktor.', '6', '6', 'Realisasi Capaian Kinerja Sasaran Strategis.', '6', 'disetujui', 'Biro Keuangan, Perlengkapan dan BMN', '2021-10-24', 'Biro Keuangan, Perlengkapan dan BMN', '2021-10-24', NULL, 'Belum memenuhi selera risiko', 'BMN', '26', '#ff0000', '#ffff00', '2 - Jarang Terjadi', '4 - Signifikan', '4 - Sering Terjadi', '5 - Sangat Signifikan', '24', '13', '2021-10-24 08:33:06', '2021-10-24 08:33:06'),
(27, '2', 'G.1.1.BMN.6', '3', 'G.1.1.BMN.6.3', '7', 'Biro KP dan BMN', '2021', '35', '1', 'Sasaran Strategis/Program', 'G.1.1', 'Laporan realisasi pekerjaan tidak sesuai fakta di lapangan.', '6', '6', 'Realisasi Capaian Kinerja Sasaran Strategis.', '6', 'disetujui', 'Biro Keuangan, Perlengkapan dan BMN', '2021-10-24', 'Biro Keuangan, Perlengkapan dan BMN', '2021-10-24', NULL, 'Belum memenuhi selera risiko', 'BMN', '27', '#ff0000', '#ffc000', '3 - Kadang Terjadi', '4 - Signifikan', '3 - Kadang Terjadi', '5 - Sangat Signifikan', '22', '17', '2021-10-24 08:38:56', '2021-10-24 08:38:56'),
(28, '2', 'G.1.1.BMN.5', '2', 'G.1.1.BMN.5.2', '7', 'Biro KP dan BMN', '2021', '35', '1', 'Sasaran Strategis/Program', 'G.1.1', 'Terdapat selisih antara rekapitulasi belanja yang disampaikan kepada BPK dengan RAB pengolahan lahan.', '5', '5', 'Realisasi Capaian Kinerja Sasaran Strategis.', '6', 'disetujui', 'Biro Keuangan, Perlengkapan dan BMN', '2021-10-24', 'Biro Keuangan, Perlengkapan dan BMN', '2021-10-24', NULL, 'Belum memenuhi selera risiko', 'BMN', '28', '#ff0000', '#ffff00', '2 - Jarang Terjadi', '4 - Signifikan', '3 - Kadang Terjadi', '5 - Sangat Signifikan', '22', '13', '2021-10-24 08:43:00', '2021-10-24 08:43:00'),
(29, '2', 'G.1.1.BMN.5', '3', 'G.1.1.BMN.5.3', '7', 'Biro KP dan BMN', '2021', '35', '1', 'Sasaran Strategis/Program', 'G.1.1', 'Surat Pertanggung Jawaban (SPJ) yang disampaikan tidak sesuai dengan belanja tunai.', '5', '5', 'Penurunan Reputasi dan Realisasi Capaian Kinerja Sasaran Strategis.', '6', 'disetujui', 'Biro Keuangan, Perlengkapan dan BMN', '2021-10-24', 'Biro Keuangan, Perlengkapan dan BMN', '2021-10-24', NULL, 'Belum memenuhi selera risiko', 'BMN', '29', '#ff0000', '#ffff00', '2 - Jarang Terjadi', '4 - Signifikan', '3 - Kadang Terjadi', '5 - Sangat Signifikan', '22', '13', '2021-10-24 08:47:56', '2021-10-24 08:47:56'),
(30, '2', 'G.1.1.BMN.5', '4', 'G.1.1.BMN.5.4', '7', 'Biro KP dan BMN', '2021', '35', '1', 'Sasaran Strategis/Program', 'G.1.1', 'Pembayaran gaji tenaga kerja tidak didukung bukti yang memadai.', '5', '5', 'Penurunan Reputasi dan Realisasi Capaian Kinerja Sasaran Strategis.', '6', 'disetujui', 'Biro Keuangan, Perlengkapan dan BMN', '2021-10-24', 'Biro Keuangan, Perlengkapan dan BMN', '2021-10-24', NULL, 'Belum memenuhi selera risiko', 'BMN', '30', '#ffc000', '#ffc000', '3 - Kadang Terjadi', '4 - Signifikan', '3 - Kadang Terjadi', '4 - Signifikan', '17', '17', '2021-10-24 08:53:52', '2021-10-24 08:53:52'),
(31, '2', 'G.1.1.BMN.7', '1', 'G.1.1.BMN.7.1', '7', 'Biro KP dan BMN', '2021', '35', '1', 'Sasaran Strategis/Program', 'G.1.1', 'Pembelian sparepart secara on-line namun tidak ditemukan dalam aplikasi terkait.', '7', '7', 'Penurunan Reputasi.', '6', 'disetujui', 'Biro Keuangan, Perlengkapan dan BMN', '2021-10-24', 'Biro Keuangan, Perlengkapan dan BMN', '2021-10-24', NULL, 'Belum memenuhi selera risiko', 'BMN', '31', '#00b050', '#00b050', '2 - Jarang Terjadi', '3 - Moderat', '2 - Jarang Terjadi', '3 - Moderat', '11', '11', '2021-10-24 08:54:37', '2021-10-24 08:54:37'),
(32, '2', 'G.1.1.BMN.7', '2', 'G.1.1.BMN.7.2', '7', 'Biro KP dan BMN', '2021', '35', '1', 'Sasaran Strategis/Program', 'G.1.1', 'Kuitansi pembelian sparepart secara on-line tidak dilengkapi dengan tanggal pembelian.', '7', '7', 'Penurunan Reputasi.', '6', 'disetujui', 'Biro Keuangan, Perlengkapan dan BMN', '2021-10-24', 'Biro Keuangan, Perlengkapan dan BMN', '2021-10-24', NULL, 'Belum memenuhi selera risiko', 'BMN', '32', '#00b050', '#32bdea', '1 - Hampir Tidak Terjadi', '2 - Minor', '2 - Jarang Terjadi', '2 - Minor', '7', '3', '2021-10-24 08:55:21', '2021-10-24 08:55:21'),
(33, '2', 'G.1.1.BMN.7', '3', 'G.1.1.BMN.7.3', '7', 'Biro KP dan BMN', '2021', '35', '1', 'Sasaran Strategis/Program', 'G.1.1', 'Kesalahan perhitungan didalam invoice dan tidak dilengkapi dengan spesifikasi barang.', '7', '7', 'Penurunan Reputasi.', '6', 'disetujui', 'Biro Keuangan, Perlengkapan dan BMN', '2021-10-24', 'Biro Keuangan, Perlengkapan dan BMN', '2021-10-24', NULL, 'Belum memenuhi selera risiko', 'BMN', '33', '#ff0000', '#ffc000', '3 - Kadang Terjadi', '4 - Signifikan', '3 - Kadang Terjadi', '5 - Sangat Signifikan', '22', '17', '2021-10-24 08:56:12', '2021-10-24 08:56:12'),
(34, '2', 'G.1.1.BMN.6', '4', 'G.1.1.BMN.6.4', '7', 'Biro KP dan BMN', '2021', '35', '1', 'Sasaran Strategis/Program', 'G.1.1', 'Terdapat selisih jumlah BBM dan upah pengolahan lahan antara yang diterima kelompok tani (poktan) dan yang dilaporkan pelaksana.', '6', '6', 'Realisasi Capaian Kinerja Sasaran Strategis.', '6', 'disetujui', 'Biro Keuangan, Perlengkapan dan BMN', '2021-10-24', 'Biro Keuangan, Perlengkapan dan BMN', '2021-10-24', NULL, 'Belum memenuhi selera risiko', 'BMN', '34', '#ffc000', '#00b050', '3 - Kadang Terjadi', '2 - Minor', '4 - Sering Terjadi', '3 - Moderat', '16', '10', '2021-10-24 09:07:50', '2021-10-24 09:07:50'),
(35, '2', 'G.1.1.BMN.5', '5', 'G.1.1.BMN.5.5', '7', 'Biro KP dan BMN', '2021', '35', '1', 'Sasaran Strategis/Program', 'G.1.1', 'Indikasi terjadi kelebihan pembayaran atas dokumen pertanggungjawaban yang tidak sesuai fakta.', '5', '5', 'Penurunan Reputasi dan Realisasi Capaian Kinerja Sasaran Strategis.', '6', 'disetujui', 'Biro Keuangan, Perlengkapan dan BMN', '2021-10-24', 'Biro Keuangan, Perlengkapan dan BMN', '2021-10-24', NULL, 'Belum memenuhi selera risiko', 'BMN', '35', '#ffc000', '#ffc000', '4 - Sering Terjadi', '4 - Signifikan', '4 - Sering Terjadi', '4 - Signifikan', '19', '19', '2021-10-24 09:08:39', '2021-10-24 09:08:39'),
(36, '1', 'G.1.1.EP.LAKIN.4', '1', 'G.1.1.EP.LAKIN.4.1', '8', 'Sekretariat Inspektorat Jenderal', '2021', '34', '1', 'Sasaran Strategis/Program', 'G.1.1', 'Nilai Evaluasi AKIP kurang dari 82.', '5', '4', 'Penurunan Reputasi.', '5', 'disetujui', 'Sekretariat Inspektorat Jenderal', '2021-10-01', 'Inspektorat Jenderal', '2021-10-04', NULL, 'Memenuhi Selera Risiko', 'EP.LAKIN', '36', '#00b050', '#32bdea', '1 - Hampir Tidak Terjadi', '1 - Tidak Signifikan', '1 - Hampir Tidak Terjadi', '4 - Signifikan', '8', '1', '2021-10-24 12:59:33', '2021-10-24 08:49:52'),
(37, '1', 'G.1.1.EP.LAKIN.6', '1', 'G.1.1.EP.LAKIN.6.1', '8', 'Sekretariat Inspektorat Jenderal', '2021', '34', '1', 'Sasaran Strategis/Program', 'G.1.1', 'Data Capaian Realisasi Berubah Ubah.', '6', '6', 'Realisasi Capaian Kinerja Sasaran Strategis.', '1', 'disetujui', 'Sekretariat Inspektorat Jenderal', '2021-10-01', 'Inspektorat Jenderal', '2021-10-04', NULL, 'Belum memenuhi selera risiko', 'EP.LAKIN', '37', '#ffc000', '#ffc000', '4 - Sering Terjadi', '3 - Moderat', '4 - Sering Terjadi', '4 - Signifikan', '19', '16', '2021-10-24 13:00:35', '2021-10-24 13:00:35'),
(38, '1', 'G.1.1.EP.LAKIN.2', '1', 'G.1.1.EP.LAKIN.2.1', '8', 'Sekretariat Inspektorat Jenderal', '2021', '34', '1', 'Sasaran Strategis/Program', 'G.1.1', 'Petunjuk Teknis / Pedoman Penyusunan Lakin Tidak Memadai.', '3', '2', 'Penurunan Reputasi.', '5', 'disetujui', 'Sekretariat Inspektorat Jenderal', '2021-10-01', 'Inspektorat Jenderal', '2021-10-04', NULL, 'Memenuhi Selera Risiko', 'EP.LAKIN', '38', '#32bdea', '#32bdea', '1 - Hampir Tidak Terjadi', '3 - Moderat', '1 - Hampir Tidak Terjadi', '3 - Moderat', '5', '5', '2021-10-24 13:01:48', '2021-10-24 08:50:03'),
(39, '1', 'G.1.1.EP.LAKIN.7', '1', 'G.1.1.EP.LAKIN.7.1', '8', 'Sekretariat Inspektorat Jenderal', '2021', '34', '1', 'Sasaran Strategis/Program', 'G.1.1', 'Data dari Eksternal (Menpan RB/BPKP/KPK) terlambat dipublikasi.', '7', '7', 'Temuan hasil pemeriksaan BPK dan hasil pengawasan Inspektorat.', '5', 'disetujui', 'Sekretariat Inspektorat Jenderal', '2021-10-01', 'Inspektorat Jenderal', '2021-10-04', NULL, 'Belum memenuhi selera risiko', 'EP.LAKIN', '39', '#ff0000', '#ff0000', '5 - Hampir Pasti Terjadi', '5 - Sangat Signifikan', '5 - Hampir Pasti Terjadi', '5 - Sangat Signifikan', '25', '25', '2021-10-24 13:03:33', '2021-10-24 13:03:33'),
(40, '1', 'G.1.1.EP.LAKIN.5', '1', 'G.1.1.EP.LAKIN.5.1', '8', 'Sekretariat Inspektorat Jenderal', '2021', '34', '1', 'Sasaran Strategis/Program', 'G.1.1', 'Pengukuran Indikator Kinerja Tidak Tepat.', '6', '5', 'Realisasi Capaian Kinerja Sasaran Strategis.', '1', 'disetujui', 'Sekretariat Inspektorat Jenderal', '2021-10-01', 'Inspektorat Jenderal', '2021-10-04', NULL, 'Memenuhi Selera Risiko', 'EP.LAKIN', '40', '#ffff00', '#00b050', '2 - Jarang Terjadi', '3 - Moderat', '2 - Jarang Terjadi', '4 - Signifikan', '13', '11', '2021-10-24 13:04:25', '2021-10-24 08:50:12'),
(41, '3', 'G.1.1.INV.ATT.5', '2', 'G.1.1.INV.ATT.5.2', '5', 'Inspektorat Investigasi', '2021', '44', '1', 'Sasaran Strategis/Program', 'G.1.1', 'Bukti yang diperoleh sebagai bahan telaahan tidak lengkap', '6', '5', 'Realisasi Capaian Kinerja Sasaran Strategis', '1', 'disetujui', 'Inspektorat Investigasi', '2021-10-24', 'Inspektorat Jenderal', '2021-10-25', NULL, 'Memenuhi Selera Risiko', 'INV.ATT', '41', '#ffff00', '#00b050', '3 - Kadang Terjadi', '2 - Minor', '4 - Sering Terjadi', '2 - Minor', '12', '10', '2021-10-24 20:14:56', '2021-10-27 05:46:31'),
(42, '3', 'G.1.1.INV.ATT.5', '1', 'G.1.1.INV.ATT.5.1', '5', 'Inspektorat Investigasi', '2021', '44', '1', 'Sasaran Strategis/Program', 'G.1.1', 'Tim audit yang diajukan tidak memenuhi kompetensi sesuai dengan materi audit', '6', '5', 'Realisasi Capaian Kinerja Sasaran Strategis', '1', 'disetujui', 'Inspektorat Investigasi', '2021-10-24', 'Inspektorat Jenderal', '2021-10-25', NULL, 'Memenuhi Selera Risiko', 'INV.ATT', '42', '#00b050', '#32bdea', '1 - Hampir Tidak Terjadi', '1 - Tidak Signifikan', '3 - Kadang Terjadi', '2 - Minor', '10', '1', '2021-10-24 20:46:06', '2021-10-24 18:21:44'),
(43, '3', 'G.1.1.INV.ATT.6', '3', 'G.1.1.INV.ATT.6.3', '5', 'Inspektorat Investigasi', '2021', '44', '1', 'Sasaran Strategis/Program', 'G.1.1', 'Rumusan modus operandi jauh dari kenyataan', '6', '6', 'Realisasi Capaian Kinerja Sasaran Strategis', '1', 'disetujui', 'Inspektorat Investigasi', '2021-10-24', 'Inspektorat Jenderal', '2021-10-25', NULL, 'Memenuhi Selera Risiko', 'INV.ATT', '43', '#32bdea', '#32bdea', '1 - Hampir Tidak Terjadi', '3 - Moderat', '1 - Hampir Tidak Terjadi', '3 - Moderat', '5', '5', '2021-10-24 20:55:37', '2021-10-24 20:55:37'),
(44, '3', 'G.1.1.INV.ATT.6', '4', 'G.1.1.INV.ATT.6.4', '5', 'Inspektorat Investigasi', '2021', '44', '1', 'Sasaran Strategis/Program', 'G.1.1', 'Langkah-langkah kerja yang disusun tidak aplikatif untuk membuktikan adanya modus operandi pelanggaran ketentuan.', '6', '6', 'Realisasi Capaian Kinerja Sasaran Strategis.', '1', 'disetujui', 'Inspektorat Investigasi', '2021-10-24', 'Inspektorat Jenderal', '2021-10-25', NULL, 'Belum memenuhi selera risiko', 'INV.ATT', '44', '#ff0000', '#ff0000', '1 - Hampir Tidak Terjadi', '5 - Sangat Signifikan', '2 - Jarang Terjadi', '5 - Sangat Signifikan', '21', '20', '2021-10-24 20:59:57', '2021-10-24 20:59:57'),
(45, '3', 'G.1.1.INV.ATT.6', '5', 'G.1.1.INV.ATT.6.5', '5', 'Inspektorat Investigasi', '2021', '44', '1', 'Sasaran Strategis/Program', 'G.1.1', 'Bukti yang diperoleh tidak lengkap.', '6', '6', 'Realisasi Capaian Kinerja Sasaran Strategis.', '1', 'disetujui', 'Inspektorat Investigasi', '2021-10-24', 'Inspektorat Jenderal', '2021-10-25', NULL, 'Belum memenuhi selera risiko', 'INV.ATT', '45', '#ff0000', '#ff0000', '2 - Jarang Terjadi', '5 - Sangat Signifikan', '3 - Kadang Terjadi', '5 - Sangat Signifikan', '22', '21', '2021-10-24 21:00:48', '2021-10-24 21:00:48'),
(46, '3', 'G.1.1.INV.ATT.6', '6', 'G.1.1.INV.ATT.6.6', '5', 'Inspektorat Investigasi', '2021', '44', '1', 'Sasaran Strategis/Program', 'G.1.1', 'Perolehan pengungkapan bukti untuk pengungkapan modus operandi tidak profesional.', '6', '6', 'Penurunan Reputasi dan Realisasi Capaian Kinerja Sasaran Strategis.', '4', 'disetujui', 'Inspektorat Investigasi', '2021-10-24', 'Inspektorat Jenderal', '2021-10-25', NULL, 'Belum memenuhi selera risiko', 'INV.ATT', '46', '#ff0000', '#ff0000', '1 - Hampir Tidak Terjadi', '5 - Sangat Signifikan', '2 - Jarang Terjadi', '5 - Sangat Signifikan', '21', '20', '2021-10-24 21:04:04', '2021-10-24 21:04:04'),
(47, '3', 'G.1.1.INV.ATT.6', '7', 'G.1.1.INV.ATT.6.7', '5', 'Inspektorat Investigasi', '2021', '44', '1', 'Sasaran Strategis/Program', 'G.1.1', 'Kertas Kerja Audit (KKA) tidak dapat ditelusuri .', '6', '6', 'Penurunan Reputasi dan Realisasi Capaian Kinerja Sasaran Strategis.', '4', 'diajukan', 'Inspektorat Investigasi', '2021-10-24', 'Inspektorat Jenderal', '2021-10-25', NULL, 'Belum memenuhi selera risiko', 'INV.ATT', '47', '#ffc000', '#ffc000', '3 - Kadang Terjadi', '4 - Signifikan', '4 - Sering Terjadi', '4 - Signifikan', '19', '17', '2021-10-24 21:05:23', '2021-10-24 21:05:23'),
(48, '3', 'G.1.1.INV.ATT.6', '8', 'G.1.1.INV.ATT.6.8', '5', 'Inspektorat Investigasi', '2021', '44', '1', 'Sasaran Strategis/Program', 'G.1.1', 'Laporan digugat.', '7', '6', 'Penurunan Reputasi.', '4', 'disetujui', 'Inspektorat Investigasi', '2021-10-24', 'Inspektorat Jenderal', '2021-10-25', NULL, 'Memenuhi Selera Risiko', 'INV.ATT', '48', '#00b050', '#00b050', '1 - Hampir Tidak Terjadi', '4 - Signifikan', '1 - Hampir Tidak Terjadi', '4 - Signifikan', '8', '8', '2021-10-24 21:06:08', '2021-10-24 18:22:04'),
(49, '3', 'G.1.1.INV.ATT.6', '9', 'G.1.1.INV.ATT.6.9', '5', 'Inspektorat Investigasi', '2021', '44', '1', 'Sasaran Strategis/Program', 'G.1.1', 'Laporan tidak diterima oleh yang berhak .', '7', '6', 'Penurunan Reputasi.', '4', 'disetujui', 'Inspektorat Investigasi', '2021-10-24', 'Inspektorat Jenderal', '2021-10-25', NULL, 'Memenuhi Selera Risiko', 'INV.ATT', '49', '#ffff00', '#00b050', '1 - Hampir Tidak Terjadi', '4 - Signifikan', '2 - Jarang Terjadi', '4 - Signifikan', '13', '8', '2021-10-24 21:10:12', '2021-10-24 18:22:13'),
(50, '3', 'G.1.1.INV.ATT.7', '3', 'G.1.1.INV.ATT.7.3', '5', 'Inspektorat Investigasi', '2021', '44', '1', 'Sasaran Strategis/Program', 'G.1.1', 'Rekomendasi tidak dapat ditindaklanjuti.', '7', '7', 'Realisasi Capaian Kinerja Sasaran Strategis.', '1', 'disetujui', 'Inspektorat Investigasi', '2021-10-24', 'Inspektorat Jenderal', '2021-10-25', NULL, 'Belum memenuhi selera risiko', 'INV.ATT', '50', '#ff0000', '#ff0000', '2 - Jarang Terjadi', '5 - Sangat Signifikan', '3 - Kadang Terjadi', '5 - Sangat Signifikan', '22', '21', '2021-10-24 21:10:51', '2021-10-24 21:10:51');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Superadmin', NULL, NULL),
(2, 'Admin', NULL, NULL),
(3, 'User', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `telp`, `level`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', 'admin@gmail.com', '08123456789', 'Superadmin', NULL, '$2y$10$YMBMtOqrXPF.i8c7lO1BH.mTuJR7yXMjiiHgLKQWSLi0GEXFWO9eu', NULL, '2021-09-27 20:58:30', '2021-09-27 20:58:30'),
(2, 'asdfsdf', 'safdsfd', 'dsfasafd@gmail.com', '08123456789', 'Admin', NULL, '$2y$10$Qqf.q8M68mx1TYDiMipRYu0kftIyxWFqUQtIDPXxdrh1PTovLsBZu', NULL, NULL, NULL),
(3, 'fdhgsdfg', 'safddfsa', 'asdfgfa@gmail.com', '08123456789', 'User', NULL, '$2y$10$MTn4CStysHojvSbeApyQ0ORRU.WZSz2GMGKHELhbNXfmTXBqlyM1O', NULL, NULL, NULL),
(4, 'taufikisme', 'taufik', 'taufik@gmail.com', '08124081290581', 'User', NULL, '$2y$10$6C6wbl/qWv8X88oKn0gxUuGBK/DcNm.VpIAyTCsj4CjB49uZiQD5q', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akar_masalah_why`
--
ALTER TABLE `akar_masalah_why`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `akar_masalah_why_thumb`
--
ALTER TABLE `akar_masalah_why_thumb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `analisa_masalah`
--
ALTER TABLE `analisa_masalah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `analisa_risiko`
--
ALTER TABLE `analisa_risiko`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `konteks`
--
ALTER TABLE `konteks`
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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pelaksanaan_manajemen_risiko`
--
ALTER TABLE `pelaksanaan_manajemen_risiko`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelaksanaan_pengendalian_risiko`
--
ALTER TABLE `pelaksanaan_pengendalian_risiko`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemangku_kepentingan`
--
ALTER TABLE `pemangku_kepentingan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pencatatan_peristiwa_resiko`
--
ALTER TABLE `pencatatan_peristiwa_resiko`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengendalian_risiko`
--
ALTER TABLE `pengendalian_risiko`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penyebab`
--
ALTER TABLE `penyebab`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perubahan_besaran_risiko`
--
ALTER TABLE `perubahan_besaran_risiko`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resiko_teridentifikasi`
--
ALTER TABLE `resiko_teridentifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
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
-- AUTO_INCREMENT for table `akar_masalah_why`
--
ALTER TABLE `akar_masalah_why`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `akar_masalah_why_thumb`
--
ALTER TABLE `akar_masalah_why_thumb`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=319;

--
-- AUTO_INCREMENT for table `analisa_masalah`
--
ALTER TABLE `analisa_masalah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `analisa_risiko`
--
ALTER TABLE `analisa_risiko`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `besaran_resiko`
--
ALTER TABLE `besaran_resiko`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `departemen`
--
ALTER TABLE `departemen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_konteks`
--
ALTER TABLE `jenis_konteks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kategori_resiko`
--
ALTER TABLE `kategori_resiko`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `klasifikasi_sub_unsur_spip`
--
ALTER TABLE `klasifikasi_sub_unsur_spip`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `konteks`
--
ALTER TABLE `konteks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `kriteria_dampak`
--
ALTER TABLE `kriteria_dampak`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kriteria_probabilitas`
--
ALTER TABLE `kriteria_probabilitas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `metode_pencapaian_tujuan`
--
ALTER TABLE `metode_pencapaian_tujuan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `pelaksanaan_manajemen_risiko`
--
ALTER TABLE `pelaksanaan_manajemen_risiko`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pelaksanaan_pengendalian_risiko`
--
ALTER TABLE `pelaksanaan_pengendalian_risiko`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `pemangku_kepentingan`
--
ALTER TABLE `pemangku_kepentingan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `pencatatan_peristiwa_resiko`
--
ALTER TABLE `pencatatan_peristiwa_resiko`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pengendalian_risiko`
--
ALTER TABLE `pengendalian_risiko`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `penyebab`
--
ALTER TABLE `penyebab`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `perubahan_besaran_risiko`
--
ALTER TABLE `perubahan_besaran_risiko`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `resiko_teridentifikasi`
--
ALTER TABLE `resiko_teridentifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
