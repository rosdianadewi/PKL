-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Feb 2025 pada 14.57
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pkl`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajuan_pkl`
--

CREATE TABLE `pengajuan_pkl` (
  `id` int(11) NOT NULL,
  `nama_mahasiswa` varchar(100) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `judul_pkl` varchar(255) NOT NULL,
  `tanggal_pengajuan` date NOT NULL,
  `status` enum('Menunggu','Disetujui','Ditolak') DEFAULT 'Menunggu',
  `alasan_penolakan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengajuan_pkl`
--

INSERT INTO `pengajuan_pkl` (`id`, `nama_mahasiswa`, `nim`, `judul_pkl`, `tanggal_pengajuan`, `status`, `alasan_penolakan`) VALUES
(1, 'Rosdiana', '210511173', 'Sistem Informasi Pengelolaan Data PKL', '2024-12-31', 'Disetujui', NULL),
(2, 'Rizkiana', '210511080', 'Sistem Informasi Manajemen Gudang', '2025-02-01', 'Menunggu', NULL),
(3, 'Selvia', '210511139', 'Pengembangan Website E-Commerce', '2025-02-02', 'Disetujui', NULL),
(4, 'Salma', '210511132', 'Analisis Data dengan Python', '2025-02-03', 'Ditolak', 'Judul tidak sesuai dengan bidang penelitian'),
(5, 'Dewi Permata', '210004', 'Sistem Informasi Kepegawaian', '2025-02-04', 'Disetujui', NULL),
(6, 'Eko Prasetyo', '210005', 'Aplikasi Mobile untuk Pemesanan Makanan', '2025-02-05', 'Menunggu', NULL),
(7, 'Fajar Ramadhan', '210006', 'Pembuatan Dashboard Admin dengan Laravel', '2025-02-06', 'Disetujui', NULL),
(8, 'Gita Sari', '210007', 'Pengembangan Chatbot dengan AI', '2025-02-07', 'Ditolak', 'Proposal kurang lengkap'),
(9, 'Hadi Kurniawan', '210008', 'Sistem Absensi Karyawan Berbasis Web', '2025-02-08', 'Menunggu', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pengajuan_pkl`
--
ALTER TABLE `pengajuan_pkl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pengajuan_pkl`
--
ALTER TABLE `pengajuan_pkl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
