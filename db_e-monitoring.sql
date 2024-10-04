-- phpMyAdmin SQL Dump
-- version 5.2.2-dev+20240814.4929e9867f
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2024 at 11:48 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_e-monitoring`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `username` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `nama`, `username`, `email`, `password`, `level`) VALUES
(1, 'Administrator', 'rendan', 'admin@pengadaan.com', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(3, 'user', 'user', 'user@pengadaan.com', 'user**24', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `monitoring`
--

CREATE TABLE `monitoring` (
  `id_rendan` int(11) NOT NULL,
  `no_rks` varchar(50) NOT NULL,
  `tgl_rks` date NOT NULL,
  `hpe` varchar(50) NOT NULL,
  `no_nd_rendan` varchar(30) NOT NULL,
  `tgl_nd_rendan` date NOT NULL,
  `no_add` varchar(30) NOT NULL,
  `tgl_add` varchar(30) NOT NULL,
  `revisi_nd_rks` varchar(30) NOT NULL,
  `revisi_tgl_rks` varchar(30) NOT NULL,
  `no_lemari` varchar(30) NOT NULL,
  `no_rak` varchar(30) NOT NULL,
  `user` varchar(30) NOT NULL,
  `pekerjaan` varchar(100) NOT NULL,
  `nd_user` varchar(30) NOT NULL,
  `tgl_user` date NOT NULL,
  `no_skki` varchar(30) NOT NULL,
  `no_prk` varchar(30) NOT NULL,
  `rab_awal` varchar(30) NOT NULL,
  `rab_akhir` varchar(30) NOT NULL,
  `metode` enum('Pelelangan Terbatas','Pelelangan Terbuka','Pengadaan Langsung','Penunjukan Langsung','Tender Terbuka','Tender Terbatas','Repeat Order') NOT NULL,
  `waktu` varchar(30) NOT NULL,
  `revisi_nd_user` varchar(30) NOT NULL,
  `revisi_tgl_user` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monitoring`
--
ALTER TABLE `monitoring`
  ADD PRIMARY KEY (`id_rendan`),
  ADD KEY `no_rks` (`no_rks`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `monitoring`
--
ALTER TABLE `monitoring`
  MODIFY `id_rendan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
