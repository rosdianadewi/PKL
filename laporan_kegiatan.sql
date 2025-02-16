-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Feb 2025 pada 16.50
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
-- Struktur dari tabel `laporan_kegiatan`
--

CREATE TABLE `laporan_kegiatan` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `status` enum('Pending','Diproses','Selesai') DEFAULT 'Pending',
  `nama_peserta` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `laporan_kegiatan`
--

INSERT INTO `laporan_kegiatan` (`id`, `judul`, `deskripsi`, `tanggal`, `status`, `nama_peserta`) VALUES
(1, 'Pembuatan Rancangan Sistem', 'Membuat desain awal sistem informasi yang akan dikembangkan', '2024-12-05', 'Diproses', 'Rosdiana'),
(2, 'Pengumpulan Data', 'Mengumpulkan data untuk mendukung sistem', '2024-12-17', 'Pending', 'Rizkiana'),
(3, 'Pengembangan Fitur CRUD', 'Mengimplementasikan fitur CRUD pada sistem informasi PKL', '2024-12-18', 'Pending', 'Selvya'),
(4, 'Uji Coba Sistem', 'Melakukan testing sistem untuk memastikan tidak ada bug', '2024-12-31', 'Diproses', 'Salma'),
(5, 'Penyusunan Laporan Akhir', 'Menyusun laporan akhir mengenai hasil PKL', '2025-01-03', 'Selesai', 'Rosdiana');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `laporan_kegiatan`
--
ALTER TABLE `laporan_kegiatan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `laporan_kegiatan`
--
ALTER TABLE `laporan_kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
