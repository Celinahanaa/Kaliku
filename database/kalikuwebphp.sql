-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 02 Jun 2024 pada 04.03
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
-- Database: `kalikuwebphp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemasukan`
--

CREATE TABLE `pemasukan` (
  `id_pemasukan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `sumber` varchar(50) NOT NULL,
  `jumlah` int(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pemasukan`
--

INSERT INTO `pemasukan` (`id_pemasukan`, `id_user`, `tanggal`, `sumber`, `jumlah`, `created_at`) VALUES
(23, 22, '2024-05-08', 'upah', 50000, '2024-05-09 20:05:51'),
(40, 5, '2024-05-10', 'penjualan', 70000, '2024-05-10 16:14:26'),
(49, 23, '2024-05-10', 'upah', 500000, '2024-05-10 18:51:12'),
(51, 23, '2024-05-08', 'bonus', 60000, '2024-05-10 18:52:28'),
(53, 5, '2024-05-11', 'Upah', 3000, '2024-05-11 20:13:19'),
(54, 5, '2024-05-11', 'Upah', 3000, '2024-05-11 20:13:32'),
(55, 5, '2024-05-11', 'Upah', 3900, '2024-05-11 20:14:50'),
(56, 5, '2024-05-11', 'Upah', 3900, '2024-05-11 20:15:22'),
(57, 5, '2024-05-11', 'Gaji', 70000, '2024-05-11 20:27:36'),
(58, 5, '2024-05-11', 'Gaji', 70000, '2024-05-11 20:28:32'),
(59, 5, '2024-05-11', 'Gaji', 70000, '2024-05-11 20:28:48'),
(60, 5, '2024-05-11', 'Gaji', 70000, '2024-05-11 20:28:57'),
(61, 5, '2024-05-11', 'Gaji', 70000, '2024-05-11 20:29:07'),
(62, 5, '2024-05-11', 'Gaji', 70000, '2024-05-11 20:29:26'),
(63, 5, '2024-05-11', 'Bonus', 70000, '2024-05-11 20:29:38'),
(65, 5, '2024-05-10', 'Penjualan', 60000, '2024-05-11 20:32:21'),
(66, 5, '2024-05-11', 'Penjualan', 80000, '2024-05-11 20:34:51'),
(67, 5, '2024-05-11', 'Penjualan', 80000, '2024-05-11 20:35:29'),
(68, 5, '2024-05-11', 'Investasi', 6000, '2024-05-11 20:38:02'),
(69, 5, '2024-05-09', 'Bonus', 5000, '2024-05-11 20:38:13'),
(70, 5, '2024-05-09', 'Gaji', 500000, '2024-05-11 20:56:01'),
(71, 5, '2024-05-09', 'Gaji', 500000, '2024-05-11 21:02:29'),
(72, 5, '2024-05-11', 'Penjualan', 50000, '2024-05-11 21:11:51'),
(74, 30, '2024-05-11', 'Upah', 300000, '2024-05-11 23:35:36'),
(75, 30, '2024-05-11', 'Upah', 250000, '2024-05-11 23:37:06'),
(76, 5, '0000-00-00', '', 0, '2024-05-12 00:17:02'),
(77, 5, '2024-05-12', 'Gaji', 50000, '2024-05-12 00:19:19'),
(78, 5, '2024-05-12', 'Investasi', 1000000, '2024-05-12 00:34:50'),
(79, 31, '2024-05-12', 'Pemberian', 150000, '2024-05-12 15:15:57'),
(80, 32, '2024-05-16', 'Penjualan', 150000, '2024-05-16 14:02:38'),
(81, 32, '0000-00-00', 'Gaji', 7777, '2024-05-16 14:06:05'),
(82, 2, '2024-05-20', 'Bonus', 500000, '2024-05-20 15:47:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `sumber` varchar(50) NOT NULL,
  `jumlah` int(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengeluaran`
--

INSERT INTO `pengeluaran` (`id_pengeluaran`, `id_user`, `tanggal`, `sumber`, `jumlah`, `created_at`) VALUES
(5, 22, '2024-05-09', 'pakaian', 20000, '2024-05-09 20:06:04'),
(12, 23, '2024-05-10', 'kesehatan', 50000, '2024-05-10 18:51:29'),
(15, 5, '2024-05-11', 'Komunikasi', 40000, '2024-05-11 21:03:42'),
(16, 5, '2024-05-11', 'Makanan', 7000, '2024-05-11 21:13:50'),
(17, 5, '2024-05-10', 'Pajak', 50000, '2024-05-11 21:15:29'),
(18, 5, '2024-05-11', 'Hiburan', 15000, '2024-05-11 21:28:46'),
(19, 30, '2024-05-11', 'Listrik', 50000, '2024-05-11 23:36:12'),
(20, 5, '2024-05-12', 'Perhiasan', 1000000, '2024-05-12 00:24:53'),
(21, 31, '2024-05-12', 'Makanan', 15000, '2024-05-12 15:16:08'),
(22, 32, '2024-05-16', 'Makanan', 50000, '2024-05-16 14:03:01'),
(24, 2, '2024-05-27', 'Transportasi', 50000, '2024-05-27 10:54:48'),
(25, 2, '2024-05-27', 'Makanan', 70000, '2024-05-27 10:55:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'hanaa', '123', '2024-05-08 18:49:29'),
(2, 'caca', '123', '2024-05-08 19:04:37'),
(5, 'rara', '123', '2024-05-08 19:16:37'),
(6, 'bubu', '123', '2024-05-08 19:27:20'),
(7, 'ruru', '123', '2024-05-08 19:28:24'),
(8, 'rroro', '123', '2024-05-08 19:29:31'),
(9, 'rror', '123', '2024-05-08 19:30:00'),
(10, 'rro', '122', '2024-05-08 19:30:35'),
(11, 'g', '123', '2024-05-08 19:37:08'),
(13, 'gg', '123', '2024-05-08 19:37:49'),
(14, 'gggg', '123', '2024-05-08 19:38:11'),
(15, 'vava', '123', '2024-05-08 19:39:11'),
(16, 'gu', '34', '2024-05-08 19:40:42'),
(21, 'riri', '134', '2024-05-08 20:17:11'),
(22, 'runay', '123', '2024-05-09 20:04:58'),
(23, 'anya', '123', '2024-05-10 18:50:31'),
(30, 'lala', '234', '2024-05-11 23:34:37'),
(31, 'vivi', '123', '2024-05-12 15:03:43'),
(32, 'Bara', '123', '2024-05-16 14:01:44'),
(33, 'baba', '123', '2024-05-20 15:51:31');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD PRIMARY KEY (`id_pemasukan`),
  ADD KEY `id` (`id_user`);

--
-- Indeks untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`),
  ADD KEY `id` (`id_user`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pemasukan`
--
ALTER TABLE `pemasukan`
  MODIFY `id_pemasukan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD CONSTRAINT `pemasukan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD CONSTRAINT `pengeluaran_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
