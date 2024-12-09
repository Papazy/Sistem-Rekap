-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Des 2024 pada 05.01
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
(1, 'Polres', 'Triwulan 1', 1.55, 10, 0, 10),
(3, 'Polda', 'A', 2.33, 3, 1, 4),
(4, 'Polda', 'B', 0.01, 0, 1, 3),
(5, 'Polda', 'C', 0.01, 0.03, 1, 3),
(6, 'Polda', 'D', 0.02, 0.03, 4, 6);

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
-- Struktur dari tabel `triwulan`
--

CREATE TABLE `triwulan` (
  `id` int(11) NOT NULL,
  `Triwulan` int(11) NOT NULL,
  `Periode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `triwulan`
--

INSERT INTO `triwulan` (`id`, `Triwulan`, `Periode`) VALUES
(1, 1, 'November - Januari');

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
  `Periode` date NOT NULL,
  `Triwulan` int(11) NOT NULL,
  `program` varchar(2) NOT NULL,
  `giat` varchar(5) NOT NULL,
  `min` float NOT NULL,
  `max` float NOT NULL,
  `min_file` int(11) NOT NULL,
  `max_file` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `verifikasi_polres`
--

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

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `batasan`
--
ALTER TABLE `batasan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `judul_riwayat`
--
ALTER TABLE `judul_riwayat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kegiatan_polda`
--
ALTER TABLE `kegiatan_polda`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kegiatan_polres`
--
ALTER TABLE `kegiatan_polres`
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
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `batasan`
--
ALTER TABLE `batasan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `judul_riwayat`
--
ALTER TABLE `judul_riwayat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
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
-- AUTO_INCREMENT untuk tabel `triwulan`
--
ALTER TABLE `triwulan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
