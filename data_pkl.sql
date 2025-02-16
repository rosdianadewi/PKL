-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Feb 2025 pada 19.56
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
-- Struktur dari tabel `data_pkl`
--

CREATE TABLE `data_pkl` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') NOT NULL,
  `asal_universitas` varchar(100) NOT NULL,
  `prodi` varchar(100) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_pkl`
--

INSERT INTO `data_pkl` (`id`, `nama`, `nim`, `jenis_kelamin`, `asal_universitas`, `prodi`, `tanggal_mulai`, `tanggal_selesai`) VALUES
(1, 'Rosdiana', '210511173', 'perempuan', 'Universitas Muhammadiyah Cirebon', 'Teknik Informatika', '2024-12-03', '2025-01-03'),
(2, 'Rizkiana', '210511080', 'perempuan', 'Universitas Muhammadiyah Cirebon', 'Teknik Informatika', '2024-12-16', '2025-01-13'),
(3, 'Selvya', '210511139', 'perempuan', 'Universitas Muhammadiyah Cirebon', 'Teknik Informatika', '2024-12-16', '2025-01-13'),
(4, 'Salma', '210511132', 'perempuan', 'Universitas Muhammadiyah Cirebon', 'Teknik Informatika', '2024-12-16', '2025-01-13');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data_pkl`
--
ALTER TABLE `data_pkl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data_pkl`
--
ALTER TABLE `data_pkl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
