-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Jan 2024 pada 07.39
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restapi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absen`
--

CREATE TABLE `absen` (
  `absen_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `presensi_id` varchar(7) NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp(),
  `kehadiran` varchar(10) NOT NULL DEFAULT 'check.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `absen`
--

INSERT INTO `absen` (`absen_id`, `user_id`, `presensi_id`, `tanggal`, `kehadiran`) VALUES
(1, 2, 'oWNDRhE', '2024-01-09 12:21:22', 'check.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `kelas_id` int(11) NOT NULL,
  `nama_kelas` varchar(100) NOT NULL,
  `semester` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`kelas_id`, `nama_kelas`, `semester`) VALUES
(1, 'Ilmu Komputer', 7),
(2, 'Teknologi Informasi', 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `krs`
--

CREATE TABLE `krs` (
  `krs_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mk_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `nilai` varchar(3) NOT NULL DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `krs`
--

INSERT INTO `krs` (`krs_id`, `user_id`, `mk_id`, `kelas_id`, `nilai`) VALUES
(6, 2, 2, 2, 'A'),
(7, 2, 4, 2, 'B');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mata_kuliah`
--

CREATE TABLE `mata_kuliah` (
  `mk_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `matakuliah` varchar(50) NOT NULL,
  `sks` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mata_kuliah`
--

INSERT INTO `mata_kuliah` (`mk_id`, `kelas_id`, `matakuliah`, `sks`) VALUES
(1, 1, 'Pemrograman WEB', 3),
(2, 2, 'Pemrograman Mobile', 3),
(3, 1, 'Basis Data Terdistribusi ', 3),
(4, 2, 'Etika Profesi ', 2),
(5, 1, 'Keamanan Informasi ', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(2, '2023-12-25-061327', 'App\\Database\\Migrations\\Mahasiswa', 'default', 'App', 1703486077, 1),
(3, '2023-12-31-045547', 'App\\Database\\Migrations\\User', 'default', 'App', 1704000153, 2),
(4, '2023-12-31-075637', 'App\\Database\\Migrations\\User', 'default', 'App', 1704009430, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `presensi`
--

CREATE TABLE `presensi` (
  `presensi_id` varchar(7) NOT NULL,
  `mk_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `presensi`
--

INSERT INTO `presensi` (`presensi_id`, `mk_id`, `created_at`) VALUES
('oWNDRhE', 1, '2024-01-09 12:09:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nim` varchar(30) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `jurusan` varchar(20) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `user_img` varchar(255) NOT NULL DEFAULT 'default.png',
  `password` varchar(255) NOT NULL,
  `level` varchar(20) NOT NULL DEFAULT 'Mahasiswa',
  `reset_at` datetime DEFAULT current_timestamp(),
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `email`, `nim`, `fullname`, `jurusan`, `alamat`, `user_img`, `password`, `level`, `reset_at`, `created_at`, `updated_at`) VALUES
(1, 'tedyramadan47@gmail.com', '220110018', 'Muhammad Tedy Ramadan', 'Ilmu Komputer', NULL, 'default.png', 'Gyb123', 'Admin', '2024-01-07 13:09:16', '2024-01-07 13:09:16', '2024-01-07 13:09:16'),
(2, 'rama@gmail.com', '20202020', 'Rama', 'Teknologi Informasi', NULL, 'default.png', 'rama123', 'Mahasiswa', '2024-01-07 13:36:07', '2024-01-07 13:36:07', '2024-01-07 13:36:07'),
(3, 'hafiz@gmail.com', '220110087', 'Muhammad Hafiz', 'Teknologi Informasi', NULL, 'default.png', 'hafiz123', 'Mahasiswa', '2024-01-09 11:57:16', '2024-01-09 11:57:16', '2024-01-09 11:57:16'),
(4, 'hakim@gmail.com', '220110046', 'Hakim Hakienan', 'Teknologi Informasi', NULL, 'default.png', 'hakim123', 'Mahasiswa', '2024-01-09 12:02:23', '2024-01-09 12:02:23', '2024-01-09 12:02:23'),
(5, 'zainal@gmail.com', '220110099', 'Zainal Arifin ', 'Ilmu Komputer', NULL, 'default.png', 'zainal123', 'Mahasiswa', '2024-01-09 12:04:02', '2024-01-09 12:04:02', '2024-01-09 12:04:02'),
(6, 'rahman@gmail.com', '220110088', 'Rahman', 'Teknologi Informasi', NULL, 'default.png', 'rahman123', 'Mahasiswa', '2024-01-09 12:04:57', '2024-01-09 12:04:57', '2024-01-09 12:04:57');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absen`
--
ALTER TABLE `absen`
  ADD PRIMARY KEY (`absen_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `absen_ibfk_2` (`presensi_id`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`kelas_id`);

--
-- Indeks untuk tabel `krs`
--
ALTER TABLE `krs`
  ADD PRIMARY KEY (`krs_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `kelas_id` (`kelas_id`),
  ADD KEY `mk_id_3` (`kelas_id`),
  ADD KEY `krs_ibfk_2` (`mk_id`);

--
-- Indeks untuk tabel `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD PRIMARY KEY (`mk_id`),
  ADD KEY `mk_ibfk_1` (`kelas_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `presensi`
--
ALTER TABLE `presensi`
  ADD PRIMARY KEY (`presensi_id`),
  ADD KEY `mk_id` (`mk_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`nim`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absen`
--
ALTER TABLE `absen`
  MODIFY `absen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `kelas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `krs`
--
ALTER TABLE `krs`
  MODIFY `krs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  MODIFY `mk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `absen`
--
ALTER TABLE `absen`
  ADD CONSTRAINT `absen_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `absen_ibfk_2` FOREIGN KEY (`presensi_id`) REFERENCES `presensi` (`presensi_id`);

--
-- Ketidakleluasaan untuk tabel `krs`
--
ALTER TABLE `krs`
  ADD CONSTRAINT `krs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `krs_ibfk_2` FOREIGN KEY (`mk_id`) REFERENCES `mata_kuliah` (`mk_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `krs_ibfk_3` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`kelas_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD CONSTRAINT `mk_ibfk_1` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`kelas_id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `presensi`
--
ALTER TABLE `presensi`
  ADD CONSTRAINT `presensi_ibfk_1` FOREIGN KEY (`mk_id`) REFERENCES `mata_kuliah` (`mk_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
