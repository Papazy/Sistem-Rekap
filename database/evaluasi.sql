-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Des 2024 pada 18.07
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

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
-- Struktur dari tabel `batasan`
--

CREATE TABLE `batasan` (
  `id` int(11) NOT NULL,
  `satuan` varchar(25) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `min` float NOT NULL,
  `max` float NOT NULL,
  `min_file` int(11) NOT NULL,
  `max_file` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `batasan`
--

INSERT INTO `batasan` (`id`, `satuan`, `nama`, `min`, `max`, `min_file`, `max_file`) VALUES
<<<<<<< HEAD
(3, 'Polda', 'A', 2.33, 3, 1, 4),
(4, 'Polda', 'B', 0.01, 0, 1, 3),
(5, 'Polda', 'C', 0.01, 0.03, 1, 3),
(7, 'Polres', 'A', 20.33, 30.21, 23, 34);

-- --------------------------------------------------------

--
-- Struktur dari tabel `giat`
--

CREATE TABLE `giat` (
  `id` int(11) NOT NULL,
  `nama_giat` varchar(255) NOT NULL,
  `program_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `giat`
--

INSERT INTO `giat` (`id`, `nama_giat`, `program_id`) VALUES
(1, '1', 1),
(2, '2', 1),
(3, '3', 1),
(4, '4', 1),
(5, '1', 2),
(6, '2', 2),
(7, '3', 2),
(8, '4', 2),
(9, '5', 2),
(10, '1', 3),
(11, '2', 3),
(12, '3', 3),
(13, '4', 3),
(14, '5', 3),
(15, '6', 3),
(16, '1', 4),
(17, '2', 4),
(18, '3', 4),
(19, '4', 4),
(20, '5', 4),
(21, '1', 5),
(22, '2', 5),
(23, '3', 5),
(24, '4', 5),
(25, '1', 6),
(26, '2', 6),
(27, '3', 6),
(28, '4', 6),
(29, '5', 6),
(30, '6', 6),
(31, '7', 6),
(32, '1', 19),
(33, '2', 19),
(34, '3', 19),
(35, '4', 19),
(36, '1', 20),
(37, '2', 20),
(38, '3', 20),
(39, '4', 20),
(40, '5', 20),
(41, '1', 21),
(42, '2', 21),
(43, '3', 21),
(44, '4', 21),
(45, '5', 21),
(46, '6', 21),
(47, '1', 22),
(48, '2', 22),
(49, '3', 22),
(50, '4', 22),
(51, '5', 22),
(52, '1', 23),
(53, '2', 23),
(54, '3', 23),
(55, '4', 23),
(56, '5', 23),
(57, '6', 23),
(58, '1', 24),
(59, '2', 24),
(60, '3', 24),
(61, '4', 24),
(62, '5', 24),
(63, '1', 25),
(64, '2', 25),
(65, '3', 25),
(66, '4', 25),
(67, '5', 25),
(68, '6', 25),
(69, '1', 26),
(70, '2', 26),
(71, '3', 26),
(72, '4', 26);
=======
(1, 'Polres', 'Triwulan 1', 1.55, 10, 0, 10),
(3, 'Polda', 'A', 2.33, 3, 1, 4),
(4, 'Polda', 'B', 0.01, 0, 1, 3),
(5, 'Polda', 'C', 0.01, 0.03, 1, 3),
(6, 'Polda', 'D', 0.02, 0.03, 4, 6);
>>>>>>> 574483ee1342554ed2b3a4c0b3648b367906a389

-- --------------------------------------------------------

--
-- Struktur dari tabel `judul_riwayat`
--

CREATE TABLE `judul_riwayat` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `judul_riwayat`
--

INSERT INTO `judul_riwayat` (`id`, `judul`, `tanggal`) VALUES
(1, 'Sistem Evaluasi Data', '2024-12-08');

-- --------------------------------------------------------

--
<<<<<<< HEAD
=======
-- Struktur dari tabel `kegiatan_polda`
--

CREATE TABLE `kegiatan_polda` (
  `id` int(11) NOT NULL,
  `PG` varchar(255) NOT NULL,
  `nama_kegiatan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatan_polres`
--

CREATE TABLE `kegiatan_polres` (
  `id` int(11) NOT NULL,
  `PG` varchar(255) NOT NULL,
  `nama_kegiatan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
>>>>>>> 574483ee1342554ed2b3a4c0b3648b367906a389
-- Struktur dari tabel `laporan_polda`
--

CREATE TABLE `laporan_polda` (
  `id` int(11) NOT NULL,
  `Periode` date NOT NULL,
  `PG` varchar(30) NOT NULL,
  `Min` float NOT NULL,
  `Max` float NOT NULL,
  `Triwulan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan_polres`
--

CREATE TABLE `laporan_polres` (
  `id` int(11) NOT NULL,
  `PG` varchar(30) NOT NULL,
  `Min` float NOT NULL,
  `Max` float NOT NULL,
  `Periode` date NOT NULL,
  `Triwulan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `persentase_polda`
--

CREATE TABLE `persentase_polda` (
  `id` int(11) NOT NULL,
  `Satker` varchar(255) NOT NULL,
  `Periode` date NOT NULL,
  `Persentase` float NOT NULL,
  `PG` varchar(11) NOT NULL,
  `Triwulan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `persentase_polres`
--

CREATE TABLE `persentase_polres` (
  `id` int(100) NOT NULL,
  `Polres` varchar(255) NOT NULL,
  `Periode` date NOT NULL,
  `Persentase` float NOT NULL,
  `PG` varchar(255) NOT NULL,
  `Triwulan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `program`
--

CREATE TABLE `program` (
  `id` int(11) NOT NULL,
  `triwulan_id` int(11) NOT NULL,
  `nama_program` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `program`
--

INSERT INTO `program` (`id`, `triwulan_id`, `nama_program`) VALUES
(1, 1, 'A'),
(2, 1, 'B'),
(3, 1, 'C'),
(4, 1, 'D'),
(5, 1, 'E'),
(6, 1, 'F'),
(7, 2, 'A'),
(8, 2, 'B'),
(9, 2, 'C'),
(10, 2, 'D'),
(11, 2, 'E'),
(12, 2, 'F'),
(13, 3, 'A'),
(14, 3, 'B'),
(15, 3, 'C'),
(16, 3, 'D'),
(17, 3, 'E'),
(18, 3, 'F'),
(19, 4, 'A'),
(20, 4, 'B'),
(21, 4, 'C'),
(22, 4, 'D'),
(23, 4, 'E'),
(24, 4, 'F'),
(25, 5, 'A'),
(26, 5, 'B'),
(27, 5, 'C'),
(28, 5, 'D'),
(29, 5, 'E'),
(30, 5, 'F'),
(31, 6, 'A'),
(32, 6, 'B'),
(33, 6, 'C'),
(34, 6, 'D'),
(35, 6, 'E'),
(36, 6, 'F');

-- --------------------------------------------------------

--
-- Struktur dari tabel `triwulan`
--

CREATE TABLE `triwulan` (
  `id` int(11) NOT NULL,
  `Triwulan` int(11) NOT NULL,
  `Periode` date NOT NULL,
  `Tenggat` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `triwulan`
--

<<<<<<< HEAD
INSERT INTO `triwulan` (`id`, `Triwulan`, `Periode`, `Tenggat`) VALUES
(1, 1, '2024-12-08', 'Senin, 1 Januari - Minggu, 31 Maret'),
(2, 2, '2024-12-08', 'Senin, 1 April - Minggu, 30 Juni'),
(3, 3, '2024-12-08', 'Senin, 1 Juli - Senin, 30 September'),
(4, 4, '2024-12-08', 'Selasa, 1 Oktober - Selasa, 31 Desember'),
(5, 5, '2024-12-08', 'Rabu, 1 Januari - Selasa, 31 Maret'),
(6, 6, '2024-12-08', 'Rabu, 1 April - Selasa, 30 Juni');
=======
INSERT INTO `triwulan` (`id`, `Triwulan`, `Periode`) VALUES
(1, 1, 'November - Januari');
>>>>>>> 574483ee1342554ed2b3a4c0b3648b367906a389

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `jabatan` varchar(128) NOT NULL,
  `role` int(1) NOT NULL,
  `foto` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nama`, `alamat`, `jabatan`, `role`, `foto`) VALUES
(56, 'admin', '$2y$10$c.QG32DI282SOPRfFQMGjuXFGTfvcRh3gd6SCRA8JT6QSXHzkK/Vi', 'rizky', 'bandung', 'Operator', 1, '409-coding.png'),
(57, 'user', '$2y$10$.tY5BqZl7c1AYY9YfIXCae1QiCquzwiKOqCeRWO96OyYc1e2bUzK6', 'joyboy', 'jakarta', 'Komandan', 2, '208-joyboy.png'),
(58, 'hulk', '$2y$10$C9PfQjpNRV021Ce10NEMfeBg7WC6E5Il6fyKEzMwZuPvnJW0VnDoq', 'hulk', 'bekasi', 'Wakil komandan', 2, '547-hulk.png'),
(59, 'alex', '$2y$10$W81XMr937Y03sTpxlAQ5UuCppu94r/8DISc/HojVGIO/FWFMxVWqC', 'alex', 'bali', 'Petugas', 1, '132-alex.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `verifikasi_polda`
--

CREATE TABLE `verifikasi_polda` (
  `id` int(11) NOT NULL,
  `Polda` varchar(30) DEFAULT NULL,
  `Satker` varchar(30) DEFAULT NULL,
  `Sudah_diupload` int(11) DEFAULT NULL,
  `Sudah_diverifikasi` int(11) DEFAULT NULL,
  `Belum_diverifikasi` int(11) DEFAULT NULL,
  `Ditolak` int(11) DEFAULT NULL,
  `Ditolak_akumulasi` int(11) DEFAULT NULL,
  `Persentase` float DEFAULT NULL,
  `Periode` date DEFAULT NULL,
  `Triwulan` int(11) DEFAULT NULL,
  `program` varchar(2) DEFAULT NULL,
  `giat` varchar(5) DEFAULT NULL,
  `min` float DEFAULT NULL,
  `max` float DEFAULT NULL,
  `min_file` int(11) DEFAULT NULL,
  `max_file` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `verifikasi_polda`
--

INSERT INTO `verifikasi_polda` (`id`, `Polda`, `Satker`, `Sudah_diupload`, `Sudah_diverifikasi`, `Belum_diverifikasi`, `Ditolak`, `Ditolak_akumulasi`, `Persentase`, `Periode`, `Triwulan`, `program`, `giat`, `min`, `max`, `min_file`, `max_file`) VALUES
(1, 'Aceh', 'Aceh Timur', 12, 9, 3, 0, 0, 25, '2024-12-09', 1, 'A', '1', 0.02, 0.09, 1, 3),
(2, 'Aceh', 'Kota Subulussalam', 11, 9, 2, 0, 0, 25, '2024-12-09', 1, 'A', '1', 0.02, 0.09, 1, 3),
(3, 'Aceh', 'Aceh Besar', 12, 9, 3, 0, 0, 25, '2024-12-09', 1, 'A', '1', 0.02, 0.09, 1, 3),
(4, 'Aceh', 'Pidie', 12, 9, 3, 0, 0, 25, '2024-12-09', 1, 'A', '1', 0.02, 0.09, 1, 3),
(5, 'Aceh', 'Kota Sabang', 11, 9, 2, 0, 0, 25, '2024-12-09', 1, 'A', '1', 0.02, 0.09, 1, 3),
(6, 'Aceh', 'Aceh Barat Daya', 12, 9, 3, 0, 0, 25, '2024-12-09', 1, 'A', '1', 0.02, 0.09, 1, 3),
(7, 'Aceh', 'Pidie Jaya', 9, 9, 0, 0, 0, 25, '2024-12-09', 1, 'A', '1', 0.02, 0.09, 1, 3),
(8, 'Aceh', 'Aceh Jaya', 11, 9, 2, 0, 0, 25, '2024-12-09', 1, 'A', '1', 0.02, 0.09, 1, 3),
(9, 'Aceh', 'Aceh Tamiang', 12, 9, 3, 0, 0, 25, '2024-12-09', 1, 'A', '1', 0.02, 0.09, 1, 3),
(10, 'Aceh', 'Aceh Barat', 12, 9, 3, 0, 0, 25, '2024-12-09', 1, 'A', '1', 0.02, 0.09, 1, 3),
(11, 'Aceh', 'Nagan Raya', 12, 9, 3, 0, 0, 25, '2024-12-09', 1, 'A', '1', 0.02, 0.09, 1, 3),
(12, 'Aceh', 'Bener Meriah', 12, 9, 3, 0, 0, 25, '2024-12-09', 1, 'A', '1', 0.02, 0.09, 1, 3),
(13, 'Aceh', 'Gayo Lues', 12, 9, 3, 0, 0, 25, '2024-12-09', 1, 'A', '1', 0.02, 0.09, 1, 3),
(14, 'Aceh', 'Aceh Utara', 12, 9, 3, 0, 0, 25, '2024-12-09', 1, 'A', '1', 0.02, 0.09, 1, 3),
(15, 'Aceh', 'Kota Langsa', 11, 9, 2, 0, 0, 25, '2024-12-09', 1, 'A', '1', 0.02, 0.09, 1, 3),
(16, 'Aceh', 'Bireuen', 11, 9, 2, 0, 0, 25, '2024-12-09', 1, 'A', '1', 0.02, 0.09, 1, 3),
(17, 'Aceh', 'Kota Lhokseumawe', 12, 9, 3, 0, 0, 25, '2024-12-09', 1, 'A', '1', 0.02, 0.09, 1, 3),
(18, 'Aceh', 'Kota Banda Aceh', 12, 9, 3, 0, 0, 25, '2024-12-09', 1, 'A', '1', 0.02, 0.09, 1, 3),
(19, 'Aceh', 'Aceh Tengah', 12, 9, 3, 0, 0, 25, '2024-12-09', 1, 'A', '1', 0.02, 0.09, 1, 3),
(20, 'Aceh', 'Simeulue', 11, 8, 3, 0, 0, 22.22, '2024-12-09', 1, 'A', '1', 0.02, 0.09, 1, 3),
(21, 'Aceh', 'Aceh Tenggara', 10, 8, 2, 0, 0, 22.22, '2024-12-09', 1, 'A', '1', 0.02, 0.09, 1, 3),
(22, 'Aceh', 'Aceh Selatan', 10, 8, 2, 0, 0, 22.22, '2024-12-09', 1, 'A', '1', 0.02, 0.09, 1, 3),
(23, 'Aceh', 'Aceh Singkil', 11, 6, 5, 0, 0, 16.67, '2024-12-09', 1, 'A', '1', 0.02, 0.09, 1, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `verifikasi_polres`
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
  `Persentase` float NOT NULL,
  `Periode` datetime NOT NULL,
  `Triwulan` int(11) NOT NULL,
<<<<<<< HEAD
  `program` int(11) NOT NULL,
  `giat` int(11) NOT NULL,
  `Min` float NOT NULL,
  `Max` float NOT NULL,
  `Min_upload` int(11) NOT NULL,
  `Max_upload` int(11) NOT NULL
=======
  `program` varchar(2) NOT NULL,
  `giat` varchar(5) NOT NULL,
  `min` float NOT NULL,
  `max` float NOT NULL,
  `min_file` int(11) NOT NULL,
  `max_file` int(11) NOT NULL
>>>>>>> 574483ee1342554ed2b3a4c0b3648b367906a389
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `verifikasi_polres`
--

<<<<<<< HEAD
INSERT INTO `verifikasi_polres` (`id`, `Polda`, `Polres`, `Sudah_diupload`, `Sudah_diverifikasi`, `Belum_diverifikasi`, `Ditolak`, `Ditolak_akumulasi`, `Persentase`, `Periode`, `Triwulan`, `program`, `giat`, `Min`, `Max`, `Min_upload`, `Max_upload`) VALUES
(140, 'Aceh', 'Aceh Timur', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:30:00', 1, 1, 1, 23.33, 34.55, 12, 45),
(141, 'Aceh', 'Pidie', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:30:00', 1, 1, 1, 23.33, 34.55, 12, 45),
(142, 'Aceh', 'Simeulue', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:30:00', 1, 1, 1, 23.33, 34.55, 12, 45),
(143, 'Aceh', 'Aceh Selatan', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:30:00', 1, 1, 1, 23.33, 34.55, 12, 45),
(144, 'Aceh', 'Aceh Barat', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:30:00', 1, 1, 1, 23.33, 34.55, 12, 45),
(145, 'Aceh', 'Aceh Besar', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:30:00', 1, 1, 1, 23.33, 34.55, 12, 45),
(146, 'Aceh', 'Aceh Tamiang', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:30:00', 1, 1, 1, 23.33, 34.55, 12, 45),
(147, 'Aceh', 'Kota Subulussalam', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:30:00', 1, 1, 1, 23.33, 34.55, 12, 45),
(148, 'Aceh', 'Nagan Raya', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:30:00', 1, 1, 1, 23.33, 34.55, 12, 45),
(149, 'Aceh', 'Aceh Utara', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:30:00', 1, 1, 1, 23.33, 34.55, 12, 45),
(150, 'Aceh', 'Gayo Lues', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:30:00', 1, 1, 1, 23.33, 34.55, 12, 45),
(151, 'Aceh', 'Bireuen', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:30:00', 1, 1, 1, 23.33, 34.55, 12, 45),
(152, 'Aceh', 'Kota Sabang', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:30:00', 1, 1, 1, 23.33, 34.55, 12, 45),
(153, 'Aceh', 'Kota Banda Aceh', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:30:00', 1, 1, 1, 23.33, 34.55, 12, 45),
(154, 'Aceh', 'Aceh Jaya', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:30:00', 1, 1, 1, 23.33, 34.55, 12, 45),
(155, 'Aceh', 'Aceh Tengah', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:30:00', 1, 1, 1, 23.33, 34.55, 12, 45),
(156, 'Aceh', 'Aceh Barat Daya', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:30:00', 1, 1, 1, 23.33, 34.55, 12, 45),
(157, 'Aceh', 'Aceh Tenggara', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:30:00', 1, 1, 1, 23.33, 34.55, 12, 45),
(158, 'Aceh', 'Kota Lhokseumawe', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:30:00', 1, 1, 1, 23.33, 34.55, 12, 45),
(159, 'Aceh', 'Kota Langsa', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:30:00', 1, 1, 1, 23.33, 34.55, 12, 45),
(160, 'Aceh', 'Bener Meriah', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:30:00', 1, 1, 1, 23.33, 34.55, 12, 45),
(161, 'Aceh', 'Pidie Jaya', 5, 4, 1, 0, 0, 22.22, '2024-12-10 22:30:00', 1, 1, 1, 23.33, 34.55, 12, 45),
(162, 'Aceh', 'Aceh Singkil', 0, 0, 0, 0, 0, 0, '2024-12-10 22:30:00', 1, 1, 1, 23.33, 34.55, 12, 45),
(163, 'Aceh', 'Aceh Timur', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:50:00', 1, 1, 2, 20.33, 45.44, 30, 59),
(164, 'Aceh', 'Pidie', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:50:00', 1, 1, 2, 20.33, 45.44, 30, 59),
(165, 'Aceh', 'Simeulue', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:50:00', 1, 1, 2, 20.33, 45.44, 30, 59),
(166, 'Aceh', 'Aceh Selatan', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:50:00', 1, 1, 2, 20.33, 45.44, 30, 59),
(167, 'Aceh', 'Aceh Barat', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:50:00', 1, 1, 2, 20.33, 45.44, 30, 59),
(168, 'Aceh', 'Aceh Besar', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:50:00', 1, 1, 2, 20.33, 45.44, 30, 59),
(169, 'Aceh', 'Aceh Tamiang', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:50:00', 1, 1, 2, 20.33, 45.44, 30, 59),
(170, 'Aceh', 'Kota Subulussalam', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:50:00', 1, 1, 2, 20.33, 45.44, 30, 59),
(171, 'Aceh', 'Nagan Raya', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:50:00', 1, 1, 2, 20.33, 45.44, 30, 59),
(172, 'Aceh', 'Aceh Utara', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:50:00', 1, 1, 2, 20.33, 45.44, 30, 59),
(173, 'Aceh', 'Gayo Lues', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:50:00', 1, 1, 2, 20.33, 45.44, 30, 59),
(174, 'Aceh', 'Bireuen', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:50:00', 1, 1, 2, 20.33, 45.44, 30, 59),
(175, 'Aceh', 'Kota Sabang', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:50:00', 1, 1, 2, 20.33, 45.44, 30, 59),
(176, 'Aceh', 'Kota Banda Aceh', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:50:00', 1, 1, 2, 20.33, 45.44, 30, 59),
(177, 'Aceh', 'Aceh Jaya', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:50:00', 1, 1, 2, 20.33, 45.44, 30, 59),
(178, 'Aceh', 'Aceh Tengah', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:50:00', 1, 1, 2, 20.33, 45.44, 30, 59),
(179, 'Aceh', 'Aceh Barat Daya', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:50:00', 1, 1, 2, 20.33, 45.44, 30, 59),
(180, 'Aceh', 'Aceh Tenggara', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:50:00', 1, 1, 2, 20.33, 45.44, 30, 59),
(181, 'Aceh', 'Kota Lhokseumawe', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:50:00', 1, 1, 2, 20.33, 45.44, 30, 59),
(182, 'Aceh', 'Kota Langsa', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:50:00', 1, 1, 2, 20.33, 45.44, 30, 59),
(183, 'Aceh', 'Bener Meriah', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:50:00', 1, 1, 2, 20.33, 45.44, 30, 59),
(184, 'Aceh', 'Pidie Jaya', 5, 4, 1, 0, 0, 22.22, '2024-12-10 22:50:00', 1, 1, 2, 20.33, 45.44, 30, 59),
(185, 'Aceh', 'Aceh Singkil', 0, 0, 0, 0, 0, 0, '2024-12-10 22:50:00', 1, 1, 2, 20.33, 45.44, 30, 59),
(186, 'Aceh', 'Aceh Timur', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:58:00', 1, 1, 3, 20.21, 32.11, 40, 70),
(187, 'Aceh', 'Pidie', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:58:00', 1, 1, 3, 20.21, 32.11, 40, 70),
(188, 'Aceh', 'Simeulue', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:58:00', 1, 1, 3, 20.21, 32.11, 40, 70),
(189, 'Aceh', 'Aceh Selatan', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:58:00', 1, 1, 3, 20.21, 32.11, 40, 70),
(190, 'Aceh', 'Aceh Barat', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:58:00', 1, 1, 3, 20.21, 32.11, 40, 70),
(191, 'Aceh', 'Aceh Besar', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:58:00', 1, 1, 3, 20.21, 32.11, 40, 70),
(192, 'Aceh', 'Aceh Tamiang', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:58:00', 1, 1, 3, 20.21, 32.11, 40, 70),
(193, 'Aceh', 'Kota Subulussalam', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:58:00', 1, 1, 3, 20.21, 32.11, 40, 70),
(194, 'Aceh', 'Nagan Raya', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:58:00', 1, 1, 3, 20.21, 32.11, 40, 70),
(195, 'Aceh', 'Aceh Utara', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:58:00', 1, 1, 3, 20.21, 32.11, 40, 70),
(196, 'Aceh', 'Gayo Lues', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:58:00', 1, 1, 3, 20.21, 32.11, 40, 70),
(197, 'Aceh', 'Bireuen', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:58:00', 1, 1, 3, 20.21, 32.11, 40, 70),
(198, 'Aceh', 'Kota Sabang', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:58:00', 1, 1, 3, 20.21, 32.11, 40, 70),
(199, 'Aceh', 'Kota Banda Aceh', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:58:00', 1, 1, 3, 20.21, 32.11, 40, 70),
(200, 'Aceh', 'Aceh Jaya', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:58:00', 1, 1, 3, 20.21, 32.11, 40, 70),
(201, 'Aceh', 'Aceh Tengah', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:58:00', 1, 1, 3, 20.21, 32.11, 40, 70),
(202, 'Aceh', 'Aceh Barat Daya', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:58:00', 1, 1, 3, 20.21, 32.11, 40, 70),
(203, 'Aceh', 'Aceh Tenggara', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:58:00', 1, 1, 3, 20.21, 32.11, 40, 70),
(204, 'Aceh', 'Kota Lhokseumawe', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:58:00', 1, 1, 3, 20.21, 32.11, 40, 70),
(205, 'Aceh', 'Kota Langsa', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:58:00', 1, 1, 3, 20.21, 32.11, 40, 70),
(206, 'Aceh', 'Bener Meriah', 5, 5, 0, 0, 0, 27.78, '2024-12-10 22:58:00', 1, 1, 3, 20.21, 32.11, 40, 70),
(207, 'Aceh', 'Pidie Jaya', 5, 4, 1, 0, 0, 22.22, '2024-12-10 22:58:00', 1, 1, 3, 20.21, 32.11, 40, 70),
(208, 'Aceh', 'Aceh Singkil', 0, 0, 0, 0, 0, 0, '2024-12-10 22:58:00', 1, 1, 3, 20.21, 32.11, 40, 70);
=======
INSERT INTO `verifikasi_polres` (`id`, `Polda`, `Polres`, `Sudah_diupload`, `Sudah_diverifikasi`, `Belum_diverifikasi`, `Ditolak`, `Ditolak_akumulasi`, `Persentase`, `Periode`, `Triwulan`, `program`, `giat`, `min`, `max`, `min_file`, `max_file`) VALUES
(1, 'Aceh', 'Aceh Timur', 12, 9, 3, 0, 0, 25, '2024-12-09', 1, 'A', '1', 1.2, 3.4, 1, 4),
(2, 'Aceh', 'Kota Subulussalam', 11, 9, 2, 0, 0, 25, '2024-12-09', 1, 'A', '1', 1.2, 3.4, 1, 4),
(3, 'Aceh', 'Aceh Besar', 12, 9, 3, 0, 0, 25, '2024-12-09', 1, 'A', '1', 1.2, 3.4, 1, 4),
(4, 'Aceh', 'Pidie', 12, 9, 3, 0, 0, 25, '2024-12-09', 1, 'A', '1', 1.2, 3.4, 1, 4),
(5, 'Aceh', 'Kota Sabang', 11, 9, 2, 0, 0, 25, '2024-12-09', 1, 'A', '1', 1.2, 3.4, 1, 4),
(6, 'Aceh', 'Aceh Barat Daya', 12, 9, 3, 0, 0, 25, '2024-12-09', 1, 'A', '1', 1.2, 3.4, 1, 4),
(7, 'Aceh', 'Pidie Jaya', 9, 9, 0, 0, 0, 25, '2024-12-09', 1, 'A', '1', 1.2, 3.4, 1, 4),
(8, 'Aceh', 'Aceh Jaya', 11, 9, 2, 0, 0, 25, '2024-12-09', 1, 'A', '1', 1.2, 3.4, 1, 4),
(9, 'Aceh', 'Aceh Tamiang', 12, 9, 3, 0, 0, 25, '2024-12-09', 1, 'A', '1', 1.2, 3.4, 1, 4),
(10, 'Aceh', 'Aceh Barat', 12, 9, 3, 0, 0, 25, '2024-12-09', 1, 'A', '1', 1.2, 3.4, 1, 4),
(11, 'Aceh', 'Nagan Raya', 12, 9, 3, 0, 0, 25, '2024-12-09', 1, 'A', '1', 1.2, 3.4, 1, 4),
(12, 'Aceh', 'Bener Meriah', 12, 9, 3, 0, 0, 25, '2024-12-09', 1, 'A', '1', 1.2, 3.4, 1, 4),
(13, 'Aceh', 'Gayo Lues', 12, 9, 3, 0, 0, 25, '2024-12-09', 1, 'A', '1', 1.2, 3.4, 1, 4),
(14, 'Aceh', 'Aceh Utara', 12, 9, 3, 0, 0, 25, '2024-12-09', 1, 'A', '1', 1.2, 3.4, 1, 4),
(15, 'Aceh', 'Kota Langsa', 11, 9, 2, 0, 0, 25, '2024-12-09', 1, 'A', '1', 1.2, 3.4, 1, 4),
(16, 'Aceh', 'Bireuen', 11, 9, 2, 0, 0, 25, '2024-12-09', 1, 'A', '1', 1.2, 3.4, 1, 4),
(17, 'Aceh', 'Kota Lhokseumawe', 12, 9, 3, 0, 0, 25, '2024-12-09', 1, 'A', '1', 1.2, 3.4, 1, 4),
(18, 'Aceh', 'Kota Banda Aceh', 12, 9, 3, 0, 0, 25, '2024-12-09', 1, 'A', '1', 1.2, 3.4, 1, 4),
(19, 'Aceh', 'Aceh Tengah', 12, 9, 3, 0, 0, 25, '2024-12-09', 1, 'A', '1', 1.2, 3.4, 1, 4),
(20, 'Aceh', 'Simeulue', 11, 8, 3, 0, 0, 22.22, '2024-12-09', 1, 'A', '1', 1.2, 3.4, 1, 4),
(21, 'Aceh', 'Aceh Tenggara', 10, 8, 2, 0, 0, 22.22, '2024-12-09', 1, 'A', '1', 1.2, 3.4, 1, 4),
(22, 'Aceh', 'Aceh Selatan', 10, 8, 2, 0, 0, 22.22, '2024-12-09', 1, 'A', '1', 1.2, 3.4, 1, 4),
(23, 'Aceh', 'Aceh Singkil', 11, 6, 5, 0, 0, 16.67, '2024-12-09', 1, 'A', '1', 1.2, 3.4, 1, 4);
>>>>>>> 574483ee1342554ed2b3a4c0b3648b367906a389

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `batasan`
--
ALTER TABLE `batasan`
  ADD PRIMARY KEY (`id`);

--
<<<<<<< HEAD
-- Indeks untuk tabel `giat`
--
ALTER TABLE `giat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `program_id` (`program_id`);

--
=======
>>>>>>> 574483ee1342554ed2b3a4c0b3648b367906a389
-- Indeks untuk tabel `judul_riwayat`
--
ALTER TABLE `judul_riwayat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `laporan_polda`
--
ALTER TABLE `laporan_polda`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `laporan_polres`
--
ALTER TABLE `laporan_polres`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `persentase_polda`
--
ALTER TABLE `persentase_polda`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `persentase_polres`
--
ALTER TABLE `persentase_polres`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `fk_triwulan` (`triwulan_id`);

--
-- Indeks untuk tabel `triwulan`
--
ALTER TABLE `triwulan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `verifikasi_polda`
--
ALTER TABLE `verifikasi_polda`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `verifikasi_polres`
--
ALTER TABLE `verifikasi_polres`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Triwulan` (`Triwulan`),
  ADD KEY `program` (`program`),
  ADD KEY `giat` (`giat`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `batasan`
--
ALTER TABLE `batasan`
<<<<<<< HEAD
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `giat`
--
ALTER TABLE `giat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
=======
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
>>>>>>> 574483ee1342554ed2b3a4c0b3648b367906a389

--
-- AUTO_INCREMENT untuk tabel `judul_riwayat`
--
ALTER TABLE `judul_riwayat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
<<<<<<< HEAD
=======
-- AUTO_INCREMENT untuk tabel `kegiatan_polda`
--
ALTER TABLE `kegiatan_polda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kegiatan_polres`
--
ALTER TABLE `kegiatan_polres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
>>>>>>> 574483ee1342554ed2b3a4c0b3648b367906a389
-- AUTO_INCREMENT untuk tabel `laporan_polda`
--
ALTER TABLE `laporan_polda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `laporan_polres`
--
ALTER TABLE `laporan_polres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `persentase_polda`
--
ALTER TABLE `persentase_polda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `persentase_polres`
--
ALTER TABLE `persentase_polres`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `program`
--
ALTER TABLE `program`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `triwulan`
--
ALTER TABLE `triwulan`
<<<<<<< HEAD
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
=======
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
>>>>>>> 574483ee1342554ed2b3a4c0b3648b367906a389

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT untuk tabel `verifikasi_polda`
--
ALTER TABLE `verifikasi_polda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `verifikasi_polres`
--
ALTER TABLE `verifikasi_polres`
<<<<<<< HEAD
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `giat`
--
ALTER TABLE `giat`
  ADD CONSTRAINT `giat_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `program` (`id`);

--
-- Ketidakleluasaan untuk tabel `program`
--
ALTER TABLE `program`
  ADD CONSTRAINT `fk_triwulan` FOREIGN KEY (`triwulan_id`) REFERENCES `triwulan` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `verifikasi_polres`
--
ALTER TABLE `verifikasi_polres`
  ADD CONSTRAINT `verifikasi_polres_ibfk_1` FOREIGN KEY (`Triwulan`) REFERENCES `triwulan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `verifikasi_polres_ibfk_2` FOREIGN KEY (`program`) REFERENCES `program` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `verifikasi_polres_ibfk_3` FOREIGN KEY (`giat`) REFERENCES `giat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
=======
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
>>>>>>> 574483ee1342554ed2b3a4c0b3648b367906a389
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
