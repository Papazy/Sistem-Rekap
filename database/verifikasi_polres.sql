-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2024 at 12:18 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `evaluasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `verifikasi_polres`
--

CREATE TABLE `verifikasi_polres` (
  `id` int(11) NOT NULL,
  `Polda` varchar(30) NOT NULL,
  `Polres` varchar(30) NOT NULL,
  `Sudah_diupload` int(11) NOT NULL,
  `Sudah_diverifikasi` int(11) NOT NULL,
  `Belum_diverifikasi` int(11) NOT NULL,
  `Ditolak` int(11) NOT NULL,
  `Ditolak_akumulasi` int(11) NOT NULL,
  `Persentase` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `verifikasi_polres`
--

INSERT INTO `verifikasi_polres` (`id`, `Polda`, `Polres`, `Sudah_diupload`, `Sudah_diverifikasi`, `Belum_diverifikasi`, `Ditolak`, `Ditolak_akumulasi`, `Persentase`) VALUES
(1, 'Aceh', 'Aceh Timur', 89, 89, 0, 0, 6, 27.13),
(2, 'Aceh', 'Gayo Lues', 90, 88, 2, 0, 16, 26.83),
(3, 'Aceh', 'Kota Lhokseumawe', 90, 87, 3, 0, 19, 26.52);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `verifikasi_polres`
--
ALTER TABLE `verifikasi_polres`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
