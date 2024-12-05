-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Des 2024 pada 17.45
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
(3, 'Sistem Evaluasi Polres ', '2024-07-04'),
(5, 'Sistem Evaluasi Polda Aceh', '2024-07-04'),
(13, 'Sistem Evaluasi', '2024-07-04'),
(14, 'Sistem Evaluasi ', '2024-07-05'),
(15, 'Patroli lalu lintas', '2024-10-16'),
(16, '533', '2024-10-16'),
(17, 'Sistem Evaluasi ', '2024-11-06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatan_polda`
--

CREATE TABLE `kegiatan_polda` (
  `id` int(11) NOT NULL,
  `PG` varchar(255) NOT NULL,
  `nama_kegiatan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kegiatan_polda`
--

INSERT INTO `kegiatan_polda` (`id`, `PG`, `nama_kegiatan`) VALUES
(1, 'A11', 'Optimalisasi pelaksanaan tatap muka/sambang oleh Polisi RW untuk berinteraksi dengan warga, mengidentifikasi dan menindaklanjuti gangguan keamanan serta mensosialisasikan nomor telepon dinasnya agar warga mudah menghubungi jika membutuhkan bantuan Polisis'),
(7, 'C82', '-'),
(8, 'C91', '-'),
(9, 'C92', '-'),
(10, 'C93', '-'),
(11, 'C94', '-'),
(12, 'D101', '-'),
(13, 'D102', '-'),
(14, 'D103', '-'),
(15, 'D104', '-'),
(16, 'D111', '-'),
(17, 'D112', '-'),
(18, 'D121', '-'),
(19, 'D122', '-'),
(20, 'D131', '-'),
(21, 'D132', '-'),
(22, 'D141', '-'),
(23, 'D142', '-'),
(24, 'F151', '-'),
(25, 'F152', '-'),
(26, 'G161', '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatan_polres`
--

CREATE TABLE `kegiatan_polres` (
  `id` int(11) NOT NULL,
  `PG` varchar(255) NOT NULL,
  `nama_kegiatan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kegiatan_polres`
--

INSERT INTO `kegiatan_polres` (`id`, `PG`, `nama_kegiatan`) VALUES
(1, 'A11', 'Optimalisasi Respon Pengaduan  Masyarakat yang cepat dan berkuaitas oleh akun resmi Satuan Wil/Sat \r\n'),
(2, 'A21', 'Optimalisasi penyebaran konten positif dan pengalihan isu negatif Polri yang dilakukan oleh akun Sobat Kamtibmas\r\n'),
(3, 'A41', 'Meningkatnya Kegiatan berupa :\r\na. Amplifikasi sosialisasi nomor Whatsapp Kasatwil(Kapolres) sehingga dikenal lebih dikenal banyak orang.'),
(4, 'C72', 'Terlaksananya giat Bakti Kesehatan berupa pengobatan gratis, dan sebagainya pda RS Polri/Faskes Polri.\r\n'),
(5, 'C81', 'Terlaksananya giat Jumat Berkah sebagai wujud kepedulan Polri	\r\n'),
(6, 'C82 ', 'Terlaksananya giat bazar pasar Murah bapokting atau kegiatan bakti sosial di slum area dengan melibatkan stakeholder\r\n'),
(8, 'C92', '-'),
(11, 'D101', 'Optimalisasi pelaksanaan tatap muka/sambang oleh Polisi RW untuk berinteraksi dengan warga, mengidentifikasi dan menindaklanjuti gangguan keamanan serta mensosialisasikan nomor telepon dinasnya agar warga mudah menghubungi jika membutuhkan bantuan Polisi\r'),
(12, 'D102', 'Optimalisasi kegitan tatap muka/sambang oleh Bhabinkamtibmas untuk berinteraksi dengan warga, mengindentifikasi dan menindaklanjuti gangguan keamanan serta mensosialisasikan nomor telepon dinasnya agar warga mudah menghubungi jika membutuhkan bantuan poli'),
(13, 'D103', 'Meningkatkan Kegiatan Pelatihan SatKamling/Pamswakarsa\r\n'),
(14, 'D104', 'Meningkatkan aktivitas pengamanan di lingkungan oleh Satkamling/Pamswakarsa\r\n'),
(15, 'D111', 'Optimalisasi penyelenggaraan kegiatan gabungan TNI_POLRI dalam bentuk olah raga/ seni budaya/keagamaan atau kegiatan sosial lainnya.\r\n'),
(16, 'D112', 'Optimalisasi kegiatan patroli gabungan TNI-POLRI dalam menjaga Kamtibmas.\r\n'),
(17, 'D121', 'Meningkatkan patroli dialogis (jalan Kaki, bersepeda/motor) dipusat keramaian seperti pasar,terminal, warung, dan tempat-temat aktivitas masyarakat lainnya.\r\n'),
(18, 'D122', 'Optimalisasi pergelaran(penjagaan dan pengaturan) anggota Polri pada waktu :\r\na. Pagi hari jam kerja/sekolah dengan sasaran titik rawan macet, rawan lakam anak sekolah dan tempat perbelanjaan;\r\nb. Sore hari jam pulang kerja dengan sasaran titik rawan mace'),
(19, 'E131', 'Optimalisasi kegiatan JUMAT CURHAT oleh Kasatwil secara rutin untuk berkomunikasi secara langsung dengan masyarakat\r\n'),
(20, 'E132', 'Optimalisasi kegiatan MINGGU KASIH oleh Kasatwil secara rutin untuk berkomunikasi secara langsung dengan masyarakat\r\n'),
(21, 'E141', 'Meningkatkan pengisian IKM (E-Survey) pada setiap pelayanan publik di satker dan satwil kemudian menindaklanjuti hasil survey tersebut untuk memperbaiki kualitas pelayanan publik\r\n'),
(22, 'E142', 'Meningkatkan kegiatan sosialisasi dan penindakan pelanggaran budaya anti pungli,gratifikasi, transaksional dalam pelayanan publik Polri kepada masyarakat umum atau yang sedang menerima pelayanan publik\r\n'),
(23, 'F151', 'Optimalisasi kegiatan anev atau gelar perkara dan tindak lanjut percepatan penyelesaian perkara setiap minggu.\r\n'),
(24, 'F152', 'Optimalisasi kegiatan press release pengungkapan perkara pidana\r\n'),
(25, 'G161', 'Terlaksananya penutupan/mematikan lampu rotator bagian belakang pada seluruh kendaraan dinas Polri sehingga tidak mengganggu pengguna jalan dibelakang\r\n');

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

--
-- Dumping data untuk tabel `laporan_polda`
--

INSERT INTO `laporan_polda` (`id`, `Periode`, `PG`, `Min`, `Max`, `Triwulan`) VALUES
(10, '2024-07-05', 'A11', 30, 90, 1),
(15, '2024-07-26', 'D141', 40, 70, 1),
(16, '2024-07-25', 'D141', 40, 70, 1),
(17, '2024-07-19', 'D142', 40, 70, 2);

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

--
-- Dumping data untuk tabel `laporan_polres`
--

INSERT INTO `laporan_polres` (`id`, `PG`, `Min`, `Max`, `Periode`, `Triwulan`) VALUES
(201, 'A11', 70, 30, '2024-07-05', 1),
(202, 'A21', 70, 30, '2024-07-05', 1),
(203, 'A11', 40, 70, '2024-07-01', 1),
(205, 'A21', 40, 70, '2024-07-01', 1),
(206, 'A21', 30, 80, '2024-07-06', 1),
(207, 'C92', 20, 80, '2024-11-08', 1);

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

--
-- Dumping data untuk tabel `persentase_polda`
--

INSERT INTO `persentase_polda` (`id`, `Satker`, `Periode`, `Persentase`, `PG`, `Triwulan`) VALUES
(9, 'BID HUMAS', '2024-07-05', 90, 'A11', 1),
(10, 'BID HUMAS', '2024-07-26', 80, 'D141', 1),
(11, 'BID HUMAS', '2024-07-25', 55, 'D141', 1),
(12, 'RO SDM', '2024-07-19', 65, 'D142', 1);

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

--
-- Dumping data untuk tabel `persentase_polres`
--

INSERT INTO `persentase_polres` (`id`, `Polres`, `Periode`, `Persentase`, `PG`, `Triwulan`) VALUES
(4625, 'Bireuen', '2024-07-01', 88.89, 'A11', 1),
(4626, 'Pidie Jaya', '2024-07-01', 88.89, 'A11', 1),
(4627, 'Pidie', '2024-07-01', 88.89, 'A11', 1),
(4628, 'Nagan Raya', '2024-07-01', 88.89, 'A11', 1),
(4629, 'Kota Subulussalam', '2024-07-01', 88.89, 'A11', 1),
(4630, 'Kota Sabang', '2024-07-01', 88.89, 'A11', 1),
(4631, 'Kota Lhokseumawe', '2024-07-01', 88.89, 'A11', 1),
(4632, 'Kota Langsa', '2024-07-01', 88.89, 'A11', 1),
(4633, 'Kota Banda Aceh', '2024-07-01', 88.89, 'A11', 1),
(4634, 'Gayo Lues', '2024-07-01', 88.89, 'A11', 1),
(4635, 'Bener Meriah', '2024-07-01', 88.89, 'A11', 1),
(4636, 'Aceh Besar', '2024-07-01', 50, 'A11', 1),
(4637, 'Aceh Utara', '2024-07-01', 88.89, 'A11', 1),
(4638, 'Aceh Timur', '2024-07-01', 50, 'A11', 1),
(4639, 'Aceh Tenggara', '2024-07-01', 88.89, 'A11', 1),
(4640, 'Aceh Tengah', '2024-07-01', 88.89, 'A11', 1),
(4641, 'Aceh Tamiang', '2024-07-01', 88.89, 'A11', 1),
(4642, 'Aceh Singkil', '2024-07-01', 88.89, 'A11', 1),
(4643, 'Aceh Besar', '2024-07-01', 88.89, 'A21', 1),
(4644, 'Aceh Besar', '2024-07-01', 50, 'A11', 1),
(4645, 'Aceh Besar', '2024-07-01', 50, 'A11', 1),
(4646, 'Simeulue', '2024-07-01', 88.89, 'A11', 1),
(4647, 'Aceh Barat', '2024-07-06', 88.89, 'A21', 1),
(4648, 'Bireuen', '2024-07-06', 88.89, 'A21', 1),
(4649, 'Pidie Jaya', '2024-07-06', 88.89, 'A21', 1),
(4650, 'Pidie', '2024-07-06', 88.89, 'A21', 1),
(4651, 'Nagan Raya', '2024-07-06', 88.89, 'A21', 1),
(4652, 'Kota Subulussalam', '2024-07-06', 88.89, 'A21', 1),
(4653, 'Kota Sabang', '2024-07-06', 88.89, 'A21', 1),
(4654, 'Kota Lhokseumawe', '2024-07-06', 88.89, 'A21', 1),
(4655, 'Kota Langsa', '2024-07-06', 88.89, 'A21', 1),
(4656, 'Kota Banda Aceh', '2024-07-06', 88.89, 'A21', 1),
(4657, 'Gayo Lues', '2024-07-06', 88.89, 'A21', 1),
(4658, 'Bener Meriah', '2024-07-06', 88.89, 'A21', 1),
(4659, 'Aceh Barat Daya', '2024-07-06', 88.89, 'A21', 1),
(4660, 'Aceh Utara', '2024-07-06', 88.89, 'A21', 1),
(4661, 'Aceh Timur', '2024-07-06', 88.89, 'A21', 1),
(4662, 'Aceh Tenggara', '2024-07-06', 88.89, 'A21', 1),
(4663, 'Aceh Tengah', '2024-07-06', 88.89, 'A21', 1),
(4664, 'Aceh Tamiang', '2024-07-06', 88.89, 'A21', 1),
(4665, 'Aceh Singkil', '2024-07-06', 88.89, 'A21', 1),
(4666, 'Aceh Selatan', '2024-07-06', 88.89, 'A21', 1),
(4667, 'Aceh Jaya', '2024-07-06', 88.89, 'A21', 1),
(4668, 'Aceh Besar', '2024-07-06', 88.89, 'A21', 1),
(4669, 'Simeulue', '2024-07-06', 88.89, 'A21', 1),
(4670, 'Aceh Barat', '2024-11-08', 100, 'C92', 1),
(4671, 'Bireuen', '2024-11-08', 100, 'C92', 1),
(4672, 'Pidie Jaya', '2024-11-08', 100, 'C92', 1),
(4673, 'Pidie', '2024-11-08', 100, 'C92', 1),
(4674, 'Nagan Raya', '2024-11-08', 100, 'C92', 1),
(4675, 'Kota Subulussalam', '2024-11-08', 100, 'C92', 1),
(4676, 'Kota Sabang', '2024-11-08', 100, 'C92', 1),
(4677, 'Kota Lhokseumawe', '2024-11-08', 100, 'C92', 1),
(4678, 'Kota Langsa', '2024-11-08', 100, 'C92', 1),
(4679, 'Kota Banda Aceh', '2024-11-08', 100, 'C92', 1),
(4680, 'Gayo Lues', '2024-11-08', 100, 'C92', 1),
(4681, 'Bener Meriah', '2024-11-08', 100, 'C92', 1),
(4682, 'Aceh Barat Daya', '2024-11-08', 100, 'C92', 1),
(4683, 'Aceh Utara', '2024-11-08', 100, 'C92', 1),
(4684, 'Aceh Timur', '2024-11-08', 100, 'C92', 1),
(4685, 'Aceh Tenggara', '2024-11-08', 100, 'C92', 1),
(4686, 'Aceh Tengah', '2024-11-08', 100, 'C92', 1),
(4687, 'Aceh Tamiang', '2024-11-08', 100, 'C92', 1),
(4688, 'Aceh Singkil', '2024-11-08', 100, 'C92', 1),
(4689, 'Aceh Selatan', '2024-11-08', 100, 'C92', 1),
(4690, 'Aceh Jaya', '2024-11-08', 100, 'C92', 1),
(4691, 'Aceh Besar', '2024-11-08', 100, 'C92', 1),
(4692, 'Simeulue', '2024-11-08', 100, 'C92', 1);

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
(5, 1, '01 Januari 2024 - 01 Juni 2024'),
(6, 2, '02 Juni 2024 - 02 December 2024');

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
  `giat` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `verifikasi_polres`
--

INSERT INTO `verifikasi_polres` (`id`, `Polda`, `Polres`, `Sudah_diupload`, `Sudah_diverifikasi`, `Belum_diverifikasi`, `Ditolak`, `Ditolak_akumulasi`, `Persentase`, `Periode`, `Triwulan`, `program`, `giat`) VALUES
(182, 'Aceh', 'Aceh Timur', 5, 5, 0, 0, 0, 27.78, '2024-12-05', 1, 'A', '11'),
(183, 'Aceh', 'Pidie', 5, 5, 0, 0, 0, 27.78, '2024-12-05', 1, 'A', '11'),
(184, 'Aceh', 'Simeulue', 5, 5, 0, 0, 0, 27.78, '2024-12-05', 1, 'A', '11'),
(185, 'Aceh', 'Aceh Selatan', 5, 5, 0, 0, 0, 27.78, '2024-12-05', 1, 'A', '11'),
(186, 'Aceh', 'Aceh Barat', 5, 5, 0, 0, 0, 27.78, '2024-12-05', 1, 'A', '11'),
(187, 'Aceh', 'Aceh Besar', 5, 5, 0, 0, 0, 27.78, '2024-12-05', 1, 'A', '11'),
(188, 'Aceh', 'Aceh Tamiang', 5, 5, 0, 0, 0, 27.78, '2024-12-05', 1, 'A', '11'),
(189, 'Aceh', 'Kota Subulussalam', 5, 5, 0, 0, 0, 27.78, '2024-12-05', 1, 'A', '11'),
(190, 'Aceh', 'Nagan Raya', 5, 5, 0, 0, 0, 27.78, '2024-12-05', 1, 'A', '11'),
(191, 'Aceh', 'Aceh Utara', 5, 5, 0, 0, 0, 27.78, '2024-12-05', 1, 'A', '11'),
(192, 'Aceh', 'Gayo Lues', 5, 5, 0, 0, 0, 27.78, '2024-12-05', 1, 'A', '11'),
(193, 'Aceh', 'Bireuen', 5, 5, 0, 0, 0, 27.78, '2024-12-05', 1, 'A', '11'),
(194, 'Aceh', 'Kota Sabang', 5, 5, 0, 0, 0, 27.78, '2024-12-05', 1, 'A', '11'),
(195, 'Aceh', 'Kota Banda Aceh', 5, 5, 0, 0, 0, 27.78, '2024-12-05', 1, 'A', '11'),
(196, 'Aceh', 'Aceh Jaya', 5, 5, 0, 0, 0, 27.78, '2024-12-05', 1, 'A', '11'),
(197, 'Aceh', 'Aceh Tengah', 5, 5, 0, 0, 0, 27.78, '2024-12-05', 1, 'A', '11'),
(198, 'Aceh', 'Aceh Barat Daya', 5, 5, 0, 0, 0, 27.78, '2024-12-05', 1, 'A', '11'),
(199, 'Aceh', 'Aceh Tenggara', 5, 5, 0, 0, 0, 27.78, '2024-12-05', 1, 'A', '11'),
(200, 'Aceh', 'Kota Lhokseumawe', 5, 5, 0, 0, 0, 27.78, '2024-12-05', 1, 'A', '11'),
(201, 'Aceh', 'Kota Langsa', 5, 5, 0, 0, 0, 27.78, '2024-12-05', 1, 'A', '11'),
(202, 'Aceh', 'Bener Meriah', 5, 5, 0, 0, 0, 27.78, '2024-12-05', 1, 'A', '11'),
(203, 'Aceh', 'Pidie Jaya', 5, 4, 1, 0, 0, 22.22, '2024-12-05', 1, 'A', '11'),
(204, 'Aceh', 'Aceh Singkil', 0, 0, 0, 0, 0, 0, '2024-12-05', 1, 'A', '11'),
(205, 'Polda', 'Polres', 0, 0, 0, 0, 0, 0, '2024-12-05', 2, 'B', '3'),
(206, 'Aceh', 'Aceh Timur', 90, 88, 1, 1, 6, 26.83, '2024-12-05', 2, 'B', '3'),
(207, 'Aceh', 'Gayo Lues', 90, 87, 3, 0, 16, 26.52, '2024-12-05', 2, 'B', '3'),
(208, 'Aceh', 'Kota Lhokseumawe', 90, 86, 4, 0, 19, 26.22, '2024-12-05', 2, 'B', '3'),
(209, 'Aceh', 'Aceh Utara', 89, 86, 3, 0, 20, 26.22, '2024-12-05', 2, 'B', '3'),
(210, 'Aceh', 'Aceh Tengah', 89, 85, 4, 0, 5, 25.91, '2024-12-05', 2, 'B', '3'),
(211, 'Aceh', 'Aceh Tamiang', 90, 85, 3, 2, 5, 25.91, '2024-12-05', 2, 'B', '3'),
(212, 'Aceh', 'Aceh Jaya', 89, 85, 4, 0, 4, 25.91, '2024-12-05', 2, 'B', '3'),
(213, 'Aceh', 'Kota Subulussalam', 89, 84, 5, 0, 5, 25.61, '2024-12-05', 2, 'B', '3'),
(214, 'Aceh', 'Aceh Barat', 89, 84, 5, 0, 5, 25.61, '2024-12-05', 2, 'B', '3'),
(215, 'Aceh', 'Kota Sabang', 89, 84, 5, 0, 14, 25.61, '2024-12-05', 2, 'B', '3'),
(216, 'Aceh', 'Pidie', 89, 83, 6, 0, 9, 25.3, '2024-12-05', 2, 'B', '3'),
(217, 'Aceh', 'Kota Banda Aceh', 89, 83, 6, 0, 14, 25.3, '2024-12-05', 2, 'B', '3'),
(218, 'Aceh', 'Aceh Barat Daya', 85, 79, 4, 2, 3, 24.09, '2024-12-05', 2, 'B', '3'),
(219, 'Aceh', 'Aceh Tenggara', 84, 79, 5, 0, 12, 24.09, '2024-12-05', 2, 'B', '3'),
(220, 'Aceh', 'Pidie Jaya', 85, 79, 6, 0, 9, 24.09, '2024-12-05', 2, 'B', '3'),
(221, 'Aceh', 'Nagan Raya', 86, 78, 8, 0, 3, 23.78, '2024-12-05', 2, 'B', '3'),
(222, 'Aceh', 'Kota Langsa', 84, 77, 5, 2, 8, 23.48, '2024-12-05', 2, 'B', '3'),
(223, 'Aceh', 'Bireuen', 85, 76, 7, 2, 10, 23.17, '2024-12-05', 2, 'B', '3'),
(224, 'Aceh', 'Simeulue', 79, 76, 1, 2, 6, 23.17, '2024-12-05', 2, 'B', '3'),
(225, 'Aceh', 'Aceh Besar', 82, 70, 6, 6, 18, 21.34, '2024-12-05', 2, 'B', '3'),
(226, 'Aceh', 'Aceh Selatan', 83, 67, 10, 6, 11, 20.43, '2024-12-05', 2, 'B', '3'),
(227, 'Aceh', 'Bener Meriah', 68, 64, 2, 2, 15, 19.51, '2024-12-05', 2, 'B', '3'),
(228, 'Aceh', 'Aceh Singkil', 70, 63, 7, 0, 8, 19.21, '2024-12-05', 2, 'B', '3'),
(229, 'Aceh', 'Aceh Timur', 5, 2, 0, 0, 0, 27.78, '2024-12-05', 1, 'A', '1'),
(230, 'Aceh', 'Pidie', 5, 3, 0, 0, 0, 27.78, '2024-12-05', 1, 'A', '1'),
(231, 'Aceh', 'Simeulue', 5, 4, 0, 0, 0, 27.78, '2024-12-05', 1, 'A', '1'),
(232, 'Aceh', 'Aceh Selatan', 5, 5, 0, 0, 0, 27.78, '2024-12-05', 1, 'A', '1'),
(233, 'Aceh', 'Aceh Barat', 5, 5, 0, 0, 0, 27.78, '2024-12-05', 1, 'A', '1'),
(234, 'Aceh', 'Aceh Besar', 5, 3, 0, 0, 0, 27.78, '2024-12-05', 1, 'A', '1'),
(235, 'Aceh', 'Aceh Tamiang', 5, 3, 0, 0, 0, 27.78, '2024-12-05', 1, 'A', '1'),
(236, 'Aceh', 'Kota Subulussalam', 5, 3, 0, 0, 0, 27.78, '2024-12-05', 1, 'A', '1'),
(237, 'Aceh', 'Nagan Raya', 5, 3, 0, 0, 0, 27.78, '2024-12-05', 1, 'A', '1'),
(238, 'Aceh', 'Aceh Utara', 5, 3, 0, 0, 0, 27.78, '2024-12-05', 1, 'A', '1'),
(239, 'Aceh', 'Gayo Lues', 5, 3, 0, 0, 0, 27.78, '2024-12-05', 1, 'A', '1'),
(240, 'Aceh', 'Bireuen', 5, 3, 0, 0, 0, 27.78, '2024-12-05', 1, 'A', '1'),
(241, 'Aceh', 'Kota Sabang', 5, 3, 0, 0, 0, 27.78, '2024-12-05', 1, 'A', '1'),
(242, 'Aceh', 'Kota Banda Aceh', 5, 3, 0, 0, 0, 27.78, '2024-12-05', 1, 'A', '1'),
(243, 'Aceh', 'Aceh Jaya', 5, 3, 0, 0, 0, 27.78, '2024-12-05', 1, 'A', '1'),
(244, 'Aceh', 'Aceh Tengah', 5, 3, 0, 0, 0, 27.78, '2024-12-05', 1, 'A', '1'),
(245, 'Aceh', 'Aceh Barat Daya', 5, 3, 0, 0, 0, 27.78, '2024-12-05', 1, 'A', '1'),
(246, 'Aceh', 'Aceh Tenggara', 5, 3, 0, 0, 0, 27.78, '2024-12-05', 1, 'A', '1'),
(247, 'Aceh', 'Kota Lhokseumawe', 5, 3, 0, 0, 0, 27.78, '2024-12-05', 1, 'A', '1'),
(248, 'Aceh', 'Kota Langsa', 5, 3, 0, 0, 0, 27.78, '2024-12-05', 1, 'A', '1'),
(249, 'Aceh', 'Bener Meriah', 5, 3, 0, 0, 0, 27.78, '2024-12-05', 1, 'A', '1'),
(250, 'Aceh', 'Pidie Jaya', 5, 3, 1, 0, 0, 22.22, '2024-12-05', 1, 'A', '1'),
(251, 'Aceh', 'Aceh Singkil', 0, 0, 0, 0, 0, 0, '2024-12-05', 1, 'A', '1');

--
-- Indexes for dumped tables
--

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
-- Indeks untuk tabel `verifikasi_polres`
--
ALTER TABLE `verifikasi_polres`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `judul_riwayat`
--
ALTER TABLE `judul_riwayat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `kegiatan_polda`
--
ALTER TABLE `kegiatan_polda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `kegiatan_polres`
--
ALTER TABLE `kegiatan_polres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `laporan_polda`
--
ALTER TABLE `laporan_polda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `laporan_polres`
--
ALTER TABLE `laporan_polres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=208;

--
-- AUTO_INCREMENT untuk tabel `persentase_polda`
--
ALTER TABLE `persentase_polda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `persentase_polres`
--
ALTER TABLE `persentase_polres`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4693;

--
-- AUTO_INCREMENT untuk tabel `triwulan`
--
ALTER TABLE `triwulan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT untuk tabel `verifikasi_polres`
--
ALTER TABLE `verifikasi_polres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=252;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
