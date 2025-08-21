-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2022 at 03:50 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_simelur`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_penyaluran`
--

CREATE TABLE `detail_penyaluran` (
  `id_detail` bigint(20) NOT NULL,
  `id_penyalurandt` bigint(20) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `penyaluran`
--

CREATE TABLE `penyaluran` (
  `id_penyaluran` bigint(20) NOT NULL,
  `tgl_penyaluran` date NOT NULL,
  `nama_penyaluran` varchar(255) NOT NULL,
  `isi_penyaluran` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penyaluran`
--

INSERT INTO `penyaluran` (`id_penyaluran`, `tgl_penyaluran`, `nama_penyaluran`, `isi_penyaluran`) VALUES
(1, '2022-05-25', 'testing', 'haha hihi'),
(2, '2022-05-25', 'uuuuwuww', 'SSSSSSSSSSSSSSSSSSSKKKKKKKKKKKKKKKKKKKKKKKKKWIIIIIIIIIIIIIIIDDDDDDDD'),
(3, '2022-05-11', 'asdff', 'Kunjungan dr kaffah preneur ke lahan pembangunan STP Khoiru Ummah di Rimbo Panjang. Memberikan dana wakaf senilai 8 juta rupiah, yg diterima langsung secara simbolis oleh Ketua Yayasan Generasi Ummat Terbaik');

-- --------------------------------------------------------

--
-- Table structure for table `sys_login`
--

CREATE TABLE `sys_login` (
  `log_id` bigint(20) NOT NULL,
  `log_user` varchar(50) DEFAULT NULL,
  `log_pass` varchar(50) DEFAULT NULL,
  `log_level` smallint(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `sys_login`
--

INSERT INTO `sys_login` (`log_id`, `log_user`, `log_pass`, `log_level`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1),
(2, 'sv', '743541121c12a113af807d1582c74bea', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_penyaluran`
--
ALTER TABLE `detail_penyaluran`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `penyaluran`
--
ALTER TABLE `penyaluran`
  ADD PRIMARY KEY (`id_penyaluran`);

--
-- Indexes for table `sys_login`
--
ALTER TABLE `sys_login`
  ADD PRIMARY KEY (`log_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_penyaluran`
--
ALTER TABLE `detail_penyaluran`
  MODIFY `id_detail` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `penyaluran`
--
ALTER TABLE `penyaluran`
  MODIFY `id_penyaluran` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sys_login`
--
ALTER TABLE `sys_login`
  MODIFY `log_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
