-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Feb 2025 pada 07.55
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
-- Struktur dari tabel `user_profile`
--

CREATE TABLE `user_profile` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `bio` varchar(255) NOT NULL,
  `role` enum('admin1','admin2','user1','user2','mahasiswa') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_profile`
--

INSERT INTO `user_profile` (`user_id`, `username`, `password`, `email`, `telepon`, `alamat`, `bio`, `role`, `created_at`) VALUES
(1, 'Intan', '$2y$10$QBWrm6VyPk3nW4ZZCF7jsOQYydMhEb7T3VLF/zr5LX0QBDQaGyfXO', 'intan@example.com', '081234567890', 'Jl. Merdeka No.1, Cirebon', 'Admin utama', 'admin1', '2025-02-13 06:47:03'),
(2, 'Jueni', '$2y$10$QBWrm6VyPk3nW4ZZCF7jsOQYydMhEb7T3VLF/zr5LX0QBDQaGyfXO', 'jueni@example.com', '082134567891', 'Jl. Diponegoro No.2, Cirebon', 'Admin kedua', 'admin2', '2025-02-13 06:47:48'),
(3, 'Heru', '$2y$10$2vtcn/qhEaLnPJo4pakDhuI5asdhR6cOqrjsBpfhQajzrbw6AEyjS', 'heru@example.com', '083234567892', 'Jl. Sudirman No.3, Cirebon', 'User level 1', 'user1', '2025-02-13 06:48:32'),
(4, 'Nanang', '$2y$10$2vtcn/qhEaLnPJo4pakDhuI5asdhR6cOqrjsBpfhQajzrbw6AEyjS', 'nanang@example.com', '084234567893', 'Jl. Kartini No.4, Cirebon', 'User level 2', 'user2', '2025-02-13 06:48:55'),
(5, 'Rosdiana', '$2y$10$rdiQqa722SVdSLuuA3ww6uoxph9IgpAQ6.C4rz38SFlvwtGonyM8G', 'rosdiana@example.com', '085234567894', 'Jl. Ahmad Yani No.5, Cirebon', 'Mahasiswa PKL', 'mahasiswa', '2025-02-13 06:49:33'),
(6, 'Selvia', '$2y$10$rdiQqa722SVdSLuuA3ww6uoxph9IgpAQ6.C4rz38SFlvwtGonyM8G', 'selvia@example.com', '086234567895', 'Jl. Hasanuddin No.6, Cirebon', 'Mahasiswa PKL', 'mahasiswa', '2025-02-13 06:49:50'),
(7, 'Salma', '$2y$10$rdiQqa722SVdSLuuA3ww6uoxph9IgpAQ6.C4rz38SFlvwtGonyM8G', 'salma@example.com', '087234567896', 'Jl. Pahlawan No.7, Cirebon', 'Mahasiswa PKL', 'mahasiswa', '2025-02-13 06:50:16');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
