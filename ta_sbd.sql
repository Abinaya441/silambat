-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2021 at 08:55 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ta_sbd`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(3) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin1234', '$2y$10$CslR0VIRmsCg98h.LTSfNORFphoXeRfUxVHPZtyY/GE/E008ZT3F6');

-- --------------------------------------------------------

--
-- Stand-in structure for view `nota`
-- (See below for the actual view)
--
CREATE TABLE `nota` (
`id_transaksi` int(3)
,`id_pelanggan` int(3)
,`nama` varchar(100)
,`no_hp` int(20)
,`no_ktp` int(20)
,`id_paket` int(3)
,`nama_paket` varchar(20)
,`jenis_paket` varchar(20)
,`tanggal` varchar(20)
,`total_harga` bigint(66)
);

-- --------------------------------------------------------

--
-- Table structure for table `paket`
--

CREATE TABLE `paket` (
  `id_paket` int(3) NOT NULL,
  `nama_paket` varchar(20) NOT NULL,
  `jenis_paket` varchar(20) NOT NULL,
  `harga` int(100) NOT NULL,
  `is_delete` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paket`
--

INSERT INTO `paket` (`id_paket`, `nama_paket`, `jenis_paket`, `harga`, `is_delete`) VALUES
(1, 'Esok Sampai', 'Reguler', 15000, b'0'),
(2, 'Esok Sampai', 'Kargo', 20000, b'0'),
(3, 'Esok Sampai', 'Berbahaya', 50000, b'0'),
(4, 'Mungkin Sampai', 'Reguler', 10000, b'0'),
(5, 'Mungkin Sampai', 'Kargo', 15000, b'0'),
(6, 'Mungkin Sampai', 'Berbahaya', 30000, b'0');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(3) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_ktp` int(20) NOT NULL,
  `no_hp` int(20) NOT NULL,
  `is_delete` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama`, `no_ktp`, `no_hp`, `is_delete`) VALUES
(1, 'Abinaya', 123456789, 987654321, b'0'),
(2, 'Isaqofi', 987654321, 123456789, b'0'),
(3, 'Kiko', 2147483647, 819999999, b'0'),
(4, 'Android321', 4321, 1234, b'0');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_transaksi` int(3) NOT NULL,
  `id_pelanggan` int(3) NOT NULL,
  `id_paket` int(3) NOT NULL,
  `tanggal` varchar(20) NOT NULL,
  `jumlah` int(16) NOT NULL,
  `is_delete` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_transaksi`, `id_pelanggan`, `id_paket`, `tanggal`, `jumlah`, `is_delete`) VALUES
(1, 1, 3, '25/11/2020', 2, b'0'),
(2, 3, 6, '25/11/2022', 3, b'0');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(3) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'praktikan', '$2y$10$CslR0VIRmsCg98h.LTSfNORFphoXeRfUxVHPZtyY/GE/E008ZT3F6');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_total`
-- (See below for the actual view)
--
CREATE TABLE `view_total` (
`nama_paket` varchar(20)
,`jenis_paket` varchar(20)
,`nama` varchar(100)
,`no_hp` int(20)
,`no_ktp` int(20)
,`tanggal` varchar(20)
,`total_harga` bigint(66)
);

-- --------------------------------------------------------

--
-- Structure for view `nota`
--
DROP TABLE IF EXISTS `nota`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `nota`  AS  select `pembayaran`.`id_transaksi` AS `id_transaksi`,`pelanggan`.`id_pelanggan` AS `id_pelanggan`,`pelanggan`.`nama` AS `nama`,`pelanggan`.`no_hp` AS `no_hp`,`pelanggan`.`no_ktp` AS `no_ktp`,`paket`.`id_paket` AS `id_paket`,`paket`.`nama_paket` AS `nama_paket`,`paket`.`jenis_paket` AS `jenis_paket`,`pembayaran`.`tanggal` AS `tanggal`,`paket`.`harga` * `pembayaran`.`jumlah` AS `total_harga` from ((`pelanggan` join `pembayaran` on(`pelanggan`.`id_pelanggan` = `pembayaran`.`id_pelanggan`)) join `paket` on(`paket`.`id_paket` = `pembayaran`.`id_paket`)) where `pembayaran`.`is_delete` = 0 ;

-- --------------------------------------------------------

--
-- Structure for view `view_total`
--
DROP TABLE IF EXISTS `view_total`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_total`  AS  select `paket`.`nama_paket` AS `nama_paket`,`paket`.`jenis_paket` AS `jenis_paket`,`pelanggan`.`nama` AS `nama`,`pelanggan`.`no_hp` AS `no_hp`,`pelanggan`.`no_ktp` AS `no_ktp`,`pembayaran`.`tanggal` AS `tanggal`,`paket`.`harga` * `pembayaran`.`jumlah` AS `total_harga` from ((`paket` join `pembayaran` on(`paket`.`id_paket` = `pembayaran`.`id_paket`)) join `pelanggan` on(`pelanggan`.`id_pelanggan` = `pembayaran`.`id_pelanggan`)) where `pembayaran`.`is_delete` = 0 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `FK_paket` (`id_paket`),
  ADD KEY `FK_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `paket`
--
ALTER TABLE `paket`
  MODIFY `id_paket` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_transaksi` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `FK_paket` FOREIGN KEY (`id_paket`) REFERENCES `paket` (`id_paket`),
  ADD CONSTRAINT `FK_pelanggan` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
