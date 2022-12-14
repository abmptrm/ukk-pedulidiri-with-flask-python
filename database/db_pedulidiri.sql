-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2022 at 04:15 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pedulidiri`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbperjalanan`
--

CREATE TABLE `tbperjalanan` (
  `id_catatan` int(11) NOT NULL,
  `nik` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` varchar(100) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `suhu` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbperjalanan`
--

INSERT INTO `tbperjalanan` (`id_catatan`, `nik`, `tanggal`, `waktu`, `lokasi`, `suhu`) VALUES
(1, '202cb962ac59075b964b07152d234b70', '2022-12-01', '15:05', 'Toko Komputer', '21'),
(2, '202cb962ac59075b964b07152d234b70', '2023-01-01', '22:06', 'Toko Mainan', '22'),
(3, '202cb962ac59075b964b07152d234b70', '2022-12-19', '14:06', 'Toko Handphone', '27');

-- --------------------------------------------------------

--
-- Table structure for table `tbuser`
--

CREATE TABLE `tbuser` (
  `nik` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbuser`
--

INSERT INTO `tbuser` (`nik`, `nama`) VALUES
('202cb962ac59075b964b07152d234b70', '7815696ecbf1c96e6894b779456d330e'),
('250cf8b51c773f3f8dc8b4be867a9a02', 'dc855efb0dc7476760afaa1b281665f1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbperjalanan`
--
ALTER TABLE `tbperjalanan`
  ADD PRIMARY KEY (`id_catatan`),
  ADD KEY `nik` (`nik`);

--
-- Indexes for table `tbuser`
--
ALTER TABLE `tbuser`
  ADD PRIMARY KEY (`nik`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbperjalanan`
--
ALTER TABLE `tbperjalanan`
  MODIFY `id_catatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbperjalanan`
--
ALTER TABLE `tbperjalanan`
  ADD CONSTRAINT `tbperjalanan_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `tbuser` (`nik`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
