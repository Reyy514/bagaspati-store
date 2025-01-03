-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Des 2024 pada 03.18
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
-- Database: `db_bagaspati`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_disney`
--

CREATE TABLE `tb_disney` (
  `id` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `stok_barang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_disney`
--

INSERT INTO `tb_disney` (`id`, `nama_produk`, `harga`, `stok_barang`) VALUES
(1, 'SHARING 6U 1 BULAN', 30000.00, 99),
(2, 'SHARING 5U 1 BULAN', 34000.00, 99),
(3, 'SHARING 6U RENEW 2 BULAN', 55000.00, 99),
(4, 'SHARING 5U RENEW 2 BULAN', 62000.00, 99),
(5, 'SHARING 6U RENEW 3 BULAN', 80000.00, 99),
(6, 'SHARING 5U RENEW 3 BULAN', 88000.00, 99),
(7, 'PRIVATE PLAN PREMIUM 1 BULAN', 145000.00, 70),
(8, 'PRIVATE PLAN BASIC 1 BULAN', 80000.00, 90);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_iqiyi`
--

CREATE TABLE `tb_iqiyi` (
  `id` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `stok_barang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_iqiyi`
--

INSERT INTO `tb_iqiyi` (`id`, `nama_produk`, `harga`, `stok_barang`) VALUES
(1, 'SHARING 1 BULAN', 15000.00, 99),
(2, 'SHARING 3 BULAN', 17000.00, 99),
(3, 'SHARING 6 BULAN', 20000.00, 99),
(4, 'PRIVATE 1 BULAN', 33000.00, 99);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_netflix`
--

CREATE TABLE `tb_netflix` (
  `id` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `stok_barang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_netflix`
--

INSERT INTO `tb_netflix` (`id`, `nama_produk`, `harga`, `stok_barang`) VALUES
(1, 'SHARING 1P1U 1 HARI', 3000.00, 99),
(2, 'SHARING 1P1U 3 HARI', 7000.00, 99),
(3, 'SHARING 1P1U 5 HARI', 9000.00, 99),
(4, 'SHARING 1P1U 7 HARI', 12000.00, 99),
(5, 'SHARING 1P1U 14 HARI', 19000.00, 99),
(6, 'SHARING 1P1U 1 BULAN', 30000.00, 99),
(7, 'SHARING 1P1U 3 BULAN', 90000.00, 99),
(8, 'SHARING 1P2U 1 BULAN', 20000.00, 99),
(9, 'SHARING 1P2U 3 BULAN', 60000.00, 99),
(10, 'PRIVATE 1 BULAN', 130000.00, 99),
(11, 'PRIVATE 1 TAHUN', 1560000.00, 19);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_spotify`
--

CREATE TABLE `tb_spotify` (
  `id` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `stok_barang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_spotify`
--

INSERT INTO `tb_spotify` (`id`, `nama_produk`, `harga`, `stok_barang`) VALUES
(1, 'INDIVIDUAL PLAN 7 HARI', 17000.00, 99),
(2, 'INDIVIDUAL PLAN 1 BULAN', 20000.00, 99),
(3, 'INDIVIDUAL PLAN 2 BULAN', 35000.00, 99),
(4, 'INDIVIDUAL PLAN 3 BULAN', 40000.00, 99),
(5, 'FAMILY PLAN 1 BULAN', 30000.00, 99);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_vidio`
--

CREATE TABLE `tb_vidio` (
  `id` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `stok_barang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_vidio`
--

INSERT INTO `tb_vidio` (`id`, `nama_produk`, `harga`, `stok_barang`) VALUES
(1, 'PRIVATE ALL DEVICE PLATINUM 1 BULAN', 40000.00, 99),
(2, 'PRIVATE ALL DEVICE DIAMOND 1 BULAN', 120000.00, 99),
(3, 'PRIVATE TV ONLY PLATINUM 1 BULAN', 30000.00, 99),
(4, 'PRIVATE MOBILE ONLY PLATINUM 1 BULAN', 35000.00, 99);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_viu`
--

CREATE TABLE `tb_viu` (
  `id` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `stok_barang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_viu`
--

INSERT INTO `tb_viu` (`id`, `nama_produk`, `harga`, `stok_barang`) VALUES
(1, 'PRIVATE 1 BULAN', 10000.00, 99),
(2, 'PRIVATE 2 BULAN', 13000.00, 99),
(3, 'PRIVATE 3 BULAN', 15000.00, 99),
(4, 'PRIVATE 4 BULAN', 17000.00, 99),
(5, 'PRIVATE 5 BULAN', 20000.00, 99),
(6, 'PRIVATE 6 BULAN', 22000.00, 99),
(7, 'PRIVATE 1 TAHUN', 30000.00, 99),
(8, 'PRIVATE LESS LIMIT 1 BULAN', 13000.00, 99),
(9, 'PRIVATE LESS LIMIT 3 BULAN', 18000.00, 99),
(10, 'PRIVATE LESS LIMIT 6 BULAN', 20000.00, 99),
(11, 'PRIVATE LESS LIMIT 1 TAHUN', 25000.00, 99);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_yt`
--

CREATE TABLE `tb_yt` (
  `id` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `stok_barang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_yt`
--

INSERT INTO `tb_yt` (`id`, `nama_produk`, `harga`, `stok_barang`) VALUES
(1, 'INDIVIDUAL PLAN 1 BULAN', 13000.00, 99),
(2, 'INDIVIDUAL PLAN MIX 2 BULAN', 15000.00, 99),
(3, 'INDIVIDUAL PLAN FULL INPLAN 3 BULAN', 23000.00, 99),
(4, 'INDIVIDUAL PLAN MIX 4 BULAN', 25000.00, 99),
(5, 'INDIVIDUAL PLAN MIX 5 BULAN', 28000.00, 99),
(6, 'INDIVIDUAL PLAN MIX 6 BULAN', 30000.00, 99),
(7, 'FAMILY PLAN 1 BULAN', 8000.00, 99),
(8, 'FAMILY PLAN 2 BULAN', 10000.00, 99),
(9, 'FAMILY PLAN 3 BULAN', 13000.00, 99),
(10, 'FAMILY PLAN 4 BULAN', 17000.00, 99),
(11, 'FAMILY PLAN 5 BULAN', 20000.00, 99),
(12, 'FAMILY PLAN 6 BULAN', 22000.00, 99);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'ReyyVERT', '$2y$10$rJZP1Le/z9SwZuJguCYp3.9h2gJ3HXY3c0exMy/q3hWOSmLhrRBQO', 'admin', '2024-12-18 04:24:53');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_disney`
--
ALTER TABLE `tb_disney`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_iqiyi`
--
ALTER TABLE `tb_iqiyi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_netflix`
--
ALTER TABLE `tb_netflix`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_spotify`
--
ALTER TABLE `tb_spotify`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_vidio`
--
ALTER TABLE `tb_vidio`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_viu`
--
ALTER TABLE `tb_viu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_yt`
--
ALTER TABLE `tb_yt`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT untuk tabel `tb_disney`
--
ALTER TABLE `tb_disney`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_iqiyi`
--
ALTER TABLE `tb_iqiyi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_netflix`
--
ALTER TABLE `tb_netflix`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tb_spotify`
--
ALTER TABLE `tb_spotify`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_vidio`
--
ALTER TABLE `tb_vidio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_viu`
--
ALTER TABLE `tb_viu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tb_yt`
--
ALTER TABLE `tb_yt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
