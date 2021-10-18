-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 18, 2021 at 06:14 PM
-- Server version: 10.3.30-MariaDB-cll-lve
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u5225440_arms`
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
(13, '526.INVES.1.1.EX.1', 'Diperkirakan awal adalah karena efek dari lockdown, sehingga layanan logistik akan kesulitan melakukan loading dan unloading barang dikarenakan restriksi akses.'),
(14, '526.INVES.1.1.EX.1', 'Pembatasan akses disebabkan oleh COVID-19, bergantung kepada policy masing-masing daerah, hal ini sulit untuk diperkirakan di masing-masing daerah. Sehingga harus dicek kebijakan masing-masing daerah.'),
(15, '.1.1.1.MN.1', 'asdf'),
(16, '.1.1.1.MN.1', 'sadf'),
(20, '526.INVES.1.1.MN.3', 'asdf'),
(21, '526.INVES.1.1.MN.3', 'sadf'),
(22, '526.INVES.1.1.MN.3', 'aasdf'),
(23, '526.INVES.1.1.MN.1', 'asdasf'),
(24, '526.INVES.1.2.MN.1', 'gfddfg'),
(25, '526.INVES.1.1.MN.4', 'gfddfg'),
(29, 'test.MONEY.3.1.MN.1', 'sadf'),
(30, 'test.MONEY.3.2.MC.1', 'sdf');

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

-- --------------------------------------------------------

--
-- Table structure for table `analisa_masalah`
--

CREATE TABLE `analisa_masalah` (
  `id` int(11) NOT NULL,
  `kode_analisis` varchar(50) DEFAULT NULL,
  `kode_risiko` varchar(50) DEFAULT NULL,
  `kategori_penyebab` varchar(50) DEFAULT NULL,
  `akar_masalah` varchar(50) DEFAULT NULL,
  `tindakan_pengendalian` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `analisa_masalah`
--

INSERT INTO `analisa_masalah` (`id`, `kode_analisis`, `kode_risiko`, `kategori_penyebab`, `akar_masalah`, `tindakan_pengendalian`, `created_at`, `updated_at`) VALUES
(3, '526.INVES.1.1.MN.1', '526.INVES.1.1', 'MN', 'asdf', 'sadf', '2021-10-10 00:21:39', '2021-10-10 00:21:39'),
(4, '526.INVES.1.1.MN.4', '526.INVES.1.1', 'MN', 'jhk', 'jk', '2021-10-10 00:22:43', '2021-10-10 00:22:43'),
(5, '526.INVES.1.1.EX.1', '526.INVES.1.1', 'EX', 'Lockdown yang dilaksanakan oleh pemerintah daerah ', 'Melakukan negosiasi untuk menjamin agar distribusi terkait dengan pengadaan yang bergantung pada logistik masing-masing daerah bisa diberi akses khusus, sehingga tidak menghambat pelaksanaan program yang bergantung pada pengadaan tersebut.', '2021-10-10 04:12:28', '2021-10-10 04:12:28'),
(6, '526.INVES.1.1.MN.3', '526.INVES.1.1', 'MN', 'asdf', 'sdf sdf', '2021-10-10 08:14:04', '2021-10-10 08:14:04'),
(10, 'test.MONEY.3.1.MN.1', 'test.MONEY.3.1', 'MN', 'sadf', 'safd', '2021-10-11 04:44:06', '2021-10-11 04:44:06'),
(11, 'test.MONEY.3.2.MC.1', 'test.MONEY.3.2', 'MC', 'asdfsadf', 'asdadfsdf', '2021-10-11 11:17:14', '2021-10-11 11:17:14');

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
(11, 7, '10', '9', '5', '4', '526.INVES.1.2', '#ffff00', '#00b050', '2 - Jarang Terjadi', '3 - Kadang Terjadi', '2 - Minor', '7', '3 - Moderat', 14, 'Sudah', 'Memadai', 'testing edit', '2021-10-10 14:11:28', '2021-10-10 07:50:09'),
(12, 8, '8', '8', '1', '1', '123.MONEY.3.1', '#32bdea', '#32bdea', '1 - Hampir Tidak Terjadi', '1 - Hampir Tidak Terjadi', '1 - Tidak Signifikan', '1', '1 - Tidak Signifikan', 1, NULL, 'Memadai', 'asdf', '2021-10-10 14:43:35', '2021-10-10 07:51:34'),
(14, 9, '1', '1', '5', '1', 'test.MONEY.4.1', '#ffc000', '#00b050', '5 - Hampir Pasti Terjadi', '5 - Hampir Pasti Terjadi', '1 - Tidak Signifikan', '9', '3 - Moderat', 18, 'Sudah', 'Memadai', 'safd', '2021-10-11 03:02:22', '2021-10-11 03:02:22'),
(15, 9, '1', '8', '1', '1', 'test.MONEY.3.1', '#00b050', '#32bdea', '1 - Hampir Tidak Terjadi', '5 - Hampir Pasti Terjadi', '1 - Tidak Signifikan', '1', '1 - Tidak Signifikan', 9, 'Sudah', 'Memadai', 'sdfa', '2021-10-11 04:49:53', '2021-10-10 22:11:01'),
(16, 9, '1', '1', '6', '1', 'test.MONEY.1.2', '#ff0000', '#00b050', '5 - Hampir Pasti Terjadi', '5 - Hampir Pasti Terjadi', '1 - Tidak Signifikan', '9', '5 - Sangat Signifikan', 25, 'Sudah', 'Memadai', 'sa', '2021-10-11 04:57:55', '2021-10-10 22:05:41'),
(17, 9, '1', '1', '5', '1', 'test.MONEY.3.2', '#ffc000', '#00b050', '5 - Hampir Pasti Terjadi', '5 - Hampir Pasti Terjadi', '1 - Tidak Signifikan', '9', '3 - Moderat', 18, 'Sudah', 'Memadai', 'safd', '2021-10-11 05:09:02', '2021-10-10 22:10:34'),
(18, 8, '8', '11', '5', '6', '123.MONEY.3.1', '#32bdea', '#ff0000', '4 - Sering Terjadi', '1 - Hampir Tidak Terjadi', '5 - Sangat Signifikan', '24', '3 - Moderat', 5, 'Sudah', 'Memadai', 'sdfasdfsf', '2021-10-11 11:15:17', '2021-10-11 11:15:17'),
(19, 8, '9', '1', '6', '1', '123.MONEY.3.1', '#ff0000', '#00b050', '5 - Hampir Pasti Terjadi', '2 - Jarang Terjadi', '1 - Tidak Signifikan', '9', '5 - Sangat Signifikan', 21, 'Sudah', 'Memadai', 'sadf', '2021-10-11 13:09:16', '2021-10-11 13:09:16');

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
(1, '1', 'Departemen 1', NULL, '2021-09-27 18:47:59'),
(4, '2', 'Department 2', NULL, NULL),
(5, 'INVES', 'Inspektorat Investigasi', NULL, NULL),
(6, 'MONEY', 'Inspektorat Keuangan', NULL, '2021-10-06 22:13:06');

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
(1, 'Sasaran Strategi', NULL, '2021-09-28 00:02:25'),
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
(1, 'Sub Unsur 1', NULL, '2021-09-27 20:12:22'),
(3, 'Sub Unsur 2', NULL, NULL);

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
  `detail_ancaman` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `indikator_kinerja_kegiatan` text COLLATE utf8mb4_unicode_ci NOT NULL,
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
(23, 'FK2021-10-04-00005', '6', 'sadasd1', '1', NULL, 'asdasd1', 'asdasd', NULL, '2021-10-07 06:26:01'),
(24, 'FK2021-09-29-00003', '526', 'Pengadaan', '5', NULL, 'Kemungkinan kejadian keterlambatan distribusi dan pengadaan karena corona, dan kejadian lain terkait dengan kerugian negara karena adanya kesalahan dalam penanganan program pengadaan.', 'Keberhasilan program dalam batasan budget dan waktu.', NULL, NULL),
(25, 'FK2021-10-06-00006', '526', 'Pengadaan Barang', '7', '5', 'Kemungkinan Perubahan jadwal dan persyaratan karena adanya peraturan baru dari pemerintah atau adanya kejadian luar biasa terkait dengan operasional proses yang mengakibatkan permasalahan pada proses pengadaan.', 'Ketepatan waktu pengerjaan.\r\nKesesuaian dengan budget.', NULL, NULL),
(26, 'FK2021-10-07-00007', '123', 'Pengadaan Barang', '1', '6', 'Kemungkinan kejadian keterlambatan distribusi dan pengadaan karena corona, dan kejadian lain terkait dengan kerugian negara karena adanya kesalahan dalam penanganan program pengadaan.', 'Keberhasilan program dalam batasan budget dan waktu.', NULL, NULL),
(27, 'FK2021-10-07-00007', 'test', 'test', '5', NULL, 'as', 'sf', NULL, NULL),
(28, '8', 'test', 'test', '1', '6', 'test', 'test', NULL, NULL),
(29, '8', 'test', 'test', '7', '6', 'test', 'test', NULL, NULL),
(30, '9', 'asdf', 'asdf', '7', '6', 'n,', 'hkb', NULL, NULL);

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
(1, 'Metode Satu', NULL, '2021-09-28 00:06:50'),
(4, 'Metode Dua', NULL, NULL);

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
  `selera_risiko` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pelaksanaan_manajemen_risiko`
--

INSERT INTO `pelaksanaan_manajemen_risiko` (`id`, `faktur`, `id_departemen`, `nama_pemilik_risiko`, `jabatan_pemilik_risiko`, `nama_koordinator_pengelola_risiko`, `jabatan_koordinator_pengelola_risiko`, `priode_penerapan`, `selera_risiko`, `created_at`, `updated_at`) VALUES
(3, 'FK2021-09-29-00002', '4', 'test', 'admin', 'Aji Putra Prayogi', 'Superadmin', '2022', 3, NULL, NULL),
(5, 'FK2021-10-01-00004', '4', 'test', 'admin', 'Admin', 'Superadmin', '2024', 8, NULL, NULL),
(6, 'FK2021-10-04-00005', '4', 'asdasd1', 'sadasda', 'Admin', 'Superadmin', '2021', 21, NULL, '2021-10-04 05:23:12'),
(7, 'FK2021-10-06-00006', '5', 'Muhammad', 'Auditor Muda', 'Heni Nugraha', 'Auditor Madya', '2022', 9, NULL, NULL),
(8, 'FK2021-10-07-00007', '6', 'Aji Putra Prayogi', 'Auditor Muda', 'Heni Nugraha', 'Auditor Madya', '2023', 7, NULL, NULL),
(9, '8', '6', 'Junet', 'Rekam Medis', 'Admin', 'Superadmin', '2026', 25, NULL, NULL);

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

-- --------------------------------------------------------

--
-- Table structure for table `pemangku_kepentingan`
--

CREATE TABLE `pemangku_kepentingan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `faktur_pemangku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pemangku_kepentingan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemangku_kepentingan`
--

INSERT INTO `pemangku_kepentingan` (`id`, `faktur_pemangku`, `pemangku_kepentingan`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, '', 'sfdasafd', 'asdsadf', NULL, '2021-09-28 19:32:51'),
(2, '', 'dsfa', 'sdfa', NULL, NULL),
(7, 'FK2021-09-29-00002', 'coba', 'sdafsdfasfd', NULL, NULL),
(8, 'FK2021-09-29-00003', 'test kode generate1', 'sdfasd', NULL, NULL),
(9, 'FK2021-09-29-00003', 'satu', 'sfdsdf', NULL, NULL),
(10, 'FK2021-09-29-00003', 'ghggh', 'gsfgfd', NULL, NULL),
(11, 'FK2021-10-01-00004', 'test', '56', NULL, NULL),
(12, 'FK2021-09-29-00003', 'Tes', 'Tess', NULL, NULL),
(13, 'FK2021-09-29-00001', 'coba1', '45', NULL, '2021-10-03 23:05:39'),
(14, 'FK2021-10-04-00005', 'test', '1', NULL, NULL),
(15, 'FK2021-10-04-00005', 'coba', '2', NULL, NULL),
(16, 'FK2021-10-06-00006', 'Inspektorat Jenderal', 'Sebagai pengawas dari departemen pemilik risiko.', NULL, NULL),
(17, 'FK2021-10-06-00006', 'Departemen keuangan', 'Sebagai pengawas budget.', NULL, NULL),
(18, 'FK2021-10-07-00007', 'Departemen keuangan', 'Sebagai pengawas budget.', NULL, NULL),
(19, '8', 'test', 'test', NULL, NULL),
(20, '8', 'sdf', 'asd', NULL, NULL),
(21, '8', 'test', 'test', NULL, NULL),
(22, '9', 'hkhkj', 'hjghj', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pencatatan_peristiwa_resiko`
--

CREATE TABLE `pencatatan_peristiwa_resiko` (
  `id` int(255) UNSIGNED NOT NULL,
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

INSERT INTO `pencatatan_peristiwa_resiko` (`id`, `departemen_id`, `tahun`, `resiko_id`, `pernyataan`, `uraian`, `waktu`, `tempat`, `kriteria_id`, `pemicu`, `penyebab_id`, `created_at`, `updated_at`) VALUES
(1, '5', NULL, '526.INVES.1.1', NULL, NULL, '2021-10-15', 'Kediri', '5', 'edit data', '3', '2021-10-16 13:10:18', '2021-10-16 06:10:18'),
(3, '5', NULL, '123.MONEY.3.1', NULL, NULL, '2021-10-16', 'Kediri', '5', 'mencoba', '6', '2021-10-16 08:53:15', '0000-00-00 00:00:00'),
(4, '7', NULL, '526.INVES.1.2', NULL, NULL, '2021-10-23', 'Fakultas Teknik Universitas Nusantara PGRI Kediri', '3', 'hghj', '1', '2021-10-16 13:07:40', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `pengendalian_risiko`
--

CREATE TABLE `pengendalian_risiko` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_manajemen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_departemen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_risiko` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_akar_masalah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_tindak_pengendalian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `respons_risiko` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kegiatan_pengendalian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_klasifikasi_sub_unsur_spip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penanggung_jawab` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `indikator_keluaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target_waktu` date NOT NULL,
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

INSERT INTO `pengendalian_risiko` (`id`, `id_manajemen`, `id_departemen`, `id_risiko`, `id_akar_masalah`, `kode_tindak_pengendalian`, `respons_risiko`, `kegiatan_pengendalian`, `id_klasifikasi_sub_unsur_spip`, `penanggung_jawab`, `indikator_keluaran`, `target_waktu`, `status_pelaksanaan`, `frekuensi_saat_ini`, `dampak_saat_ini`, `pr_saat_ini`, `besaran_saat_ini`, `created_at`, `updated_at`) VALUES
(8, '6', '9', '9', '11', 'PG.test.MONEY.4.1.MN.1', 'Mengurangi Dampak', 'test edit', '1', 'test penanggung jawab', 'test indikator', '2021-10-11', 'Belum Dilaksanakan', '5 - Hampir Pasti Terjadi', '1 - Tidak Signifikan', '#00b050', '9', NULL, '2021-10-16 04:11:58'),
(9, '6', '9', '9', '11', 'PG.test.MONEY.3.2.MC.1', 'Mengurangi Dampak', 'test', '1', 'test penanggung jawab', 'test indikator', '2021-10-11', 'Belum Dilaksanakan', '1 - Hampir Tidak Terjadi', '1 - Tidak Signifikan', '#32bdea', '1', NULL, '2021-10-16 04:11:35'),
(10, '9', '6', '12', '11', 'PG.test.MONEY.3.2.MC.1', 'Mengurangi Frekuensi', 'test', '1', 'jhk', 'hkjgjk', '2021-10-15', 'Belum Dilaksanakan', '1 - Hampir Tidak Terjadi', '1 - Tidak Signifikan', '#32bdea', '1', NULL, NULL);

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

INSERT INTO `perubahan_besaran_risiko` (`id`, `id_pelaksanaan_manajemen_risiko`, `kode_resiko_teridentifikasi`, `id_frekuensi_aktual`, `label_frekuensi`, `id_dampak_aktual`, `label_dampak_aktual`, `besaran_aktual`, `warna_aktual`, `deviasi`, `rekomendasi`) VALUES
(1, 9, 'test.MONEY.3.2', 8, NULL, 1, NULL, 1, '#32bdea', 8, 'dsfg');

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
(4, NULL, '526.INVES.1', '1', '526.INVES.1.1', '5', 'Inspektorat Investigasi', '2022', '7', '25', 'Proses Bisnis', '526', 'Kemungkinan terjadi keterlambatan pada pengadaan barang yang memerlukan transportasi dari luar negeri dikarenakan pandemi.', '1', '1', 'Dampak keterlambatan akan mengakibatkan operasional yang memerlukan barang-barang tersebut tidak bisa dilaksanakan atau minimal terhambat pelaksanaannya (terganggu pelaksanaannya).', '1', 'disetujui', 'Admin', '2021-10-06', 'Heni Nugraha', '2021-10-06', 'Risiko valid dan bisa diterima penjelasannya.', 'Belum memenuhi selera risiko', 'INVES', NULL, '#ffff00', '#00b050', '2 - Jarang Terjadi', '2 - Minor', '3 - Kadang Terjadi', '3 - Moderat', '14', '7', '2021-10-06 12:46:35', '2021-10-06 12:46:35'),
(5, NULL, '123.MONEY.3', '1', '123.MONEY.3.1', '6', 'Inspektorat Keuangan', '2023', '1', '26', 'Sasaran Strategi', '123', 'Kemungkinan terjadi keterlambatan pada pengadaan barang yang memerlukan transportasi dari luar negeri dikarenakan pandemi.', '4', '3', 'Dampak keterlambatan akan mengakibatkan operasional yang memerlukan barang-barang tersebut tidak bisa dilaksanakan atau minimal terhambat pelaksanaannya (terganggu pelaksanaannya).', '4', 'disetujui', 'Admin', '2021-10-06', 'Heni Nugraha', '2021-10-07', 'Risiko valid dan bisa diterima penjelasannya.', 'Belum memenuhi selera risiko', 'MONEY', '5', '#ff0000', '#00b050', '5 - Hampir Pasti Terjadi', '1 - Tidak Signifikan', '2 - Jarang Terjadi', '5 - Sangat Signifikan', '21', '9', '2021-10-07 05:17:30', '2021-10-07 05:17:30'),
(7, NULL, '526.INVES.2', '1', '526.INVES.1.2', '5', 'Inspektorat Investigasi', '2022', '7', '25', 'Proses Bisnis', '526', 'Kemungkinan terjadi keterlambatan pada pengadaan barang yang memerlukan transportasi dari luar negeri dikarenakan pandemi.', '1', '1', 'Dampak keterlambatan akan mengakibatkan operasional yang memerlukan barang-barang tersebut tidak bisa dilaksanakan atau minimal terhambat pelaksanaannya (terganggu pelaksanaannya).', '1', 'disetujui', 'Admin', '2021-10-06', 'Heni Nugraha', '2021-10-06', 'Risiko valid dan bisa diterima penjelasannya.', 'Belum memenuhi selera risiko', 'INVES', NULL, '#ffff00', '#00b050', '2 - Jarang Terjadi', '2 - Minor', '3 - Kadang Terjadi', '3 - Moderat', '14', '7', '2021-10-06 12:46:35', '2021-10-06 12:46:35'),
(9, '8', 'test.MONEY.3', '1', 'test.MONEY.3.1', '6', 'Inspektorat Keuangan', '2026', '28', '1', 'Sasaran Strategi', 'test', 'sdfa', '4', '3', 'safd', '1', 'disetujui', 'Admin', '2021-10-11', 'Heni Nugraha', '2021-10-11', 'sfad', 'Memenuhi Selera Risiko', 'MONEY', '9', '#00b050', '#32bdea', '1 - Hampir Tidak Terjadi', '1 - Tidak Signifikan', '5 - Hampir Pasti Terjadi', '1 - Tidak Signifikan', '9', '1', '2021-10-11 03:01:21', '2021-10-10 21:23:25'),
(12, '8', 'test.MONEY.3', '2', 'test.MONEY.3.2', '6', 'Inspektorat Keuangan', '2026', '29', '7', 'Proses Bisnis', 'test', 'sadf', '3', '3', 'sadf', '1', NULL, 'Admin', '2021-10-11', 'sdfa', '2021-10-11', 'sdfa', 'Belum memenuhi selera risiko', 'MONEY', '12', '#ffc000', '#32bdea', '1 - Hampir Tidak Terjadi', '1 - Tidak Signifikan', '5 - Hampir Pasti Terjadi', '3 - Moderat', '18', '1', '2021-10-11 05:08:03', '2021-10-11 05:08:03');

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
(3, 'fdhgsdfg', 'safddfsa', 'asdfgfa@gmail.com', '08123456789', 'User', NULL, '$2y$10$MTn4CStysHojvSbeApyQ0ORRU.WZSz2GMGKHELhbNXfmTXBqlyM1O', NULL, NULL, NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `akar_masalah_why_thumb`
--
ALTER TABLE `akar_masalah_why_thumb`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;

--
-- AUTO_INCREMENT for table `analisa_masalah`
--
ALTER TABLE `analisa_masalah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `analisa_risiko`
--
ALTER TABLE `analisa_risiko`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `besaran_resiko`
--
ALTER TABLE `besaran_resiko`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `departemen`
--
ALTER TABLE `departemen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `konteks`
--
ALTER TABLE `konteks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `pelaksanaan_manajemen_risiko`
--
ALTER TABLE `pelaksanaan_manajemen_risiko`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pelaksanaan_pengendalian_risiko`
--
ALTER TABLE `pelaksanaan_pengendalian_risiko`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pemangku_kepentingan`
--
ALTER TABLE `pemangku_kepentingan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `pencatatan_peristiwa_resiko`
--
ALTER TABLE `pencatatan_peristiwa_resiko`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengendalian_risiko`
--
ALTER TABLE `pengendalian_risiko`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `penyebab`
--
ALTER TABLE `penyebab`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `perubahan_besaran_risiko`
--
ALTER TABLE `perubahan_besaran_risiko`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `resiko_teridentifikasi`
--
ALTER TABLE `resiko_teridentifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
