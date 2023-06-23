-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2023 at 06:00 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bengkelakiong`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_registrasi`
--

CREATE TABLE `data_registrasi` (
  `id` int(4) UNSIGNED NOT NULL,
  `data_user_id` int(4) UNSIGNED NOT NULL,
  `nama_bengkel` varchar(20) DEFAULT NULL,
  `alamat_bengkel` varchar(50) DEFAULT NULL,
  `hp_bengkel` varchar(15) DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  `id_layanan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `data_registrasi`
--

INSERT INTO `data_registrasi` (`id`, `data_user_id`, `nama_bengkel`, `alamat_bengkel`, `hp_bengkel`, `status`, `id_layanan`) VALUES
(5, 4, 'Bengkel Akiongs', 'aa', 'aa', 2, 0),
(6, 5, 'BENGKEL AHUAT', 'aa', 'aa', 2, 0),
(7, 12, 'Bengkel Cobe 3', 'Aa', 'aaa', 2, 0),
(8, 15, 'bengkel s', 'jalan hidup', 'kita berbeda', 2, 0),
(9, 27, 'Bengkel Coba 4', 'bengkel', '08923128931', 2, 0),
(10, 31, 'bngkl cobe', 'bngkl', 'r', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `data_reservasi`
--

CREATE TABLE `data_reservasi` (
  `id` int(4) UNSIGNED NOT NULL,
  `tgl_reservasi` date DEFAULT NULL,
  `data_user_id` int(4) UNSIGNED NOT NULL,
  `data_registrasi_id` int(4) UNSIGNED NOT NULL,
  `layanan_id` int(4) UNSIGNED NOT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `data_reservasi`
--

INSERT INTO `data_reservasi` (`id`, `tgl_reservasi`, `data_user_id`, `data_registrasi_id`, `layanan_id`, `status`) VALUES
(28, '2023-11-15', 2, 1, 2, 3),
(31, '2023-05-17', 2, 1, 2, 1),
(67, '2023-06-02', 13, 5, 12, 4),
(69, '2023-06-10', 13, 10, 22, 4),
(70, '2023-06-03', 13, 5, 19, 2);

-- --------------------------------------------------------

--
-- Table structure for table `data_reservhomeserv`
--

CREATE TABLE `data_reservhomeserv` (
  `id` int(4) UNSIGNED NOT NULL,
  `tgl_reservasi` date DEFAULT NULL,
  `data_user_id` int(4) UNSIGNED NOT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `data_registrasi_id` int(4) UNSIGNED NOT NULL,
  `motor` text DEFAULT NULL,
  `layanan_id` int(4) UNSIGNED NOT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `data_reservhomeserv`
--

INSERT INTO `data_reservhomeserv` (`id`, `tgl_reservasi`, `data_user_id`, `no_hp`, `data_registrasi_id`, `motor`, `layanan_id`, `status`) VALUES
(10, '2023-05-12', 2, '0832113', 1, 'a                                ', 1, 2),
(14, '2023-05-18', 2, '', 2, '\r\n                                a', 2, 4),
(15, '2023-05-17', 2, '08321213', 2, 'a\r\n                                ', 1, 4),
(16, '2023-05-26', 2, '0832121321', 1, '\r\n                                ', 3, 1),
(41, '2023-05-30', 13, '0832113', 5, 't\r\n                                ', 12, 4),
(42, '2023-06-27', 13, '0832113', 10, '4\r\n                                ', 22, 4),
(43, '2023-06-15', 13, 'a', 5, 't\r\n                                ', 12, 2);

-- --------------------------------------------------------

--
-- Table structure for table `data_user`
--

CREATE TABLE `data_user` (
  `id` int(4) UNSIGNED NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `level` enum('Pengguna','Bengkel','Admin') DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `data_user`
--

INSERT INTO `data_user` (`id`, `nama`, `username`, `password`, `level`, `alamat`, `foto`) VALUES
(1, 'admin', 'admin', '$2y$10$GsDEh08Qc6nBz.wm4GmMnu.W20s57oY7vQvGZ3ZBxdEXSrh5Eo2hq', 'Admin', 'aaa', '1684070873_9349da14e80687620127.png'),
(2, 'user1', 'user1', '$2y$10$Z3tRKNII2BS5Cm7jDhp.DexuX8Y4cIA0ZR0Bockmd9aJlbLE8/vte', 'Pengguna', 'a', '1684157443_78cf7430e77aaa74f633.jpg'),
(3, 'user2', 'user2', '$2y$10$iRQAKqa10GbDID7WGpTBYeEajbo0R.p7P/mHNrDypES8sWn1KSBrW', 'Pengguna', 'a', ''),
(4, 'Akiong', 'bengkel1', '$2y$10$GB9BHeQfUDUoQIPHrufVN.PAO0zenl4oufONkvxc8ex1y7sAaO9US', 'Bengkel', 'Pontianak', '1686282917_b87a2b4537e4937b949d.png'),
(5, 'Ahuat', 'bengkel2', '$2y$10$6DU30gdo5doR2mDCH5XriOvZJAzIVGJGYbb.uo8otb6aOzIGtPhv6', 'Bengkel', 'a', '1684157692_1f3fffb931967f3fa85d.jpg'),
(11, 'aaaaaaaaaaa', 'aaaaaaaaaaaaaa', '$2y$10$fAW3OnPgsJS5BTON8v4.AOp4Lmw3eCFhvuUmrJVdAbHZT0wgcjgc6', 'Pengguna', 'aaaaaaaaa', NULL),
(12, 'bengkel34', 'bengkel34', '$2y$10$ABjnIklTCV.px4BCGLjsp.gQ28nmZ/uFh/vcIL8pDF1dIiI7UDhkK', 'Bengkel', 'aaaa', NULL),
(13, 'bona', 'bona', '$2y$10$StzvgOiX69ISNqTnRKUxZeEUsIby1gsNjNwFCj1Nyz5phyZxMNHpu', 'Pengguna', 'paris', NULL),
(14, 'iykh', 'iyakah123', '$2y$10$Q1XIKhosxlMqVlh.b9V71OUwZCt4EAcijwKWD3nLBZIxNVTGrAGB6', 'Bengkel', 'a', NULL),
(16, 'c', 'aa', '$2y$10$0CUJargAxC/VMfpusaLSwuYxH4ki9W0/AgRIe7r9YJBmORZdKCb7q', 'Admin', 'a', NULL),
(17, 'coy', 'coy', '$2y$10$s3tGVcG.o3AxPIAY7Jp5ruUBnkPdO0l0Q7WUguOE8oaGkOdfyM6Cu', 'Pengguna', 'a', NULL),
(19, 'yves', 'yves', '$2y$10$r11ZW2EqyK1/M/ylFo6KaeZinlnZcQ6QBkhQQldEWn/D6SVU56MPO', 'Pengguna', 'a', NULL),
(20, 'p', 'p', '$2y$10$raqE9Q9aZDtdoIVrN.w1QOLDu.t58k5dE0BxhynNG8ZAim8b8D4oe', 'Pengguna', 'p', NULL),
(26, 'user3', 'user3', '$2y$10$8X/6hf0mQnwBEKk1fgtC/.PL7joEmihR0iEdthBCG.wnYh0qTa1GC', 'Pengguna', 'paris', NULL),
(27, 'bengkel4', 'bengkel4', '$2y$10$UoF67wL4qloN4ieaUoO9ZOXMT7CLvX184zNmz5cCcumU0O4OY3MXu', 'Bengkel', 'f', NULL),
(28, 'wir', 'santaiajawir', '$2y$10$fGk/fa1Iw5FINZk3AxmRRehoUy07NLwwzFexW9ih9/08VGpmfzjYK', 'Pengguna', 'a', NULL),
(29, 'santaiwirr', 'santai2', '$2y$10$g23feS.9X5mZHr/57/RhGOc9QRcncSubgxdCkZ9EfmXP950p8NhJa', 'Pengguna', 'a', NULL),
(30, 'admintes', 'admintes', '$2y$10$O5uytSw.IzU.5r1u.6GHW.V6vzgIAS4caqMqbVSwIT0gIXK.QmfnO', 'Admin', 'test', NULL),
(31, 'bengkelnyoba', 'bengkelcobe', '$2y$10$soqzbEIVpExVKPEOW6uhLu.4hDoOluple9uI9.sWEyofKqCuyQU5e', 'Bengkel', 'a', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `layanan`
--

CREATE TABLE `layanan` (
  `id` int(4) UNSIGNED NOT NULL,
  `data_user_id` int(4) UNSIGNED NOT NULL,
  `data_registrasi_id` int(4) UNSIGNED DEFAULT NULL,
  `layanan` varchar(25) DEFAULT NULL,
  `harga` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `layanan`
--

INSERT INTO `layanan` (`id`, `data_user_id`, `data_registrasi_id`, `layanan`, `harga`) VALUES
(12, 4, 5, 'ganti oli akiong', 'test'),
(13, 4, 5, 'tambal ban akiong', 'test'),
(14, 5, 6, 'test ahuat', 'test'),
(15, 5, 6, 'test ahuat2', 'test'),
(16, 12, 7, 'cobe3', '30k'),
(17, 27, 9, 'cobajak', '50k'),
(19, 4, 5, 'ganti oli2', '50k'),
(20, 4, 5, 's', 's'),
(21, 4, 5, 'a', 't'),
(22, 31, 10, 'testing', 'testing');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2023-04-11-154043', 'App\\Database\\Migrations\\Datauser', 'default', 'App', 1683775868, 1),
(2, '2023-04-13-125306', 'App\\Database\\Migrations\\DataregistrasiMigration', 'default', 'App', 1683775868, 1),
(3, '2023-04-15-131622', 'App\\Database\\Migrations\\LayanananMigration', 'default', 'App', 1683775868, 1),
(4, '2023-04-17-130325', 'App\\Database\\Migrations\\DatareservhomeservMigration', 'default', 'App', 1683775868, 1),
(5, '2024-04-14-144100', 'App\\Database\\Migrations\\DatareservasiMigration', 'default', 'App', 1683775868, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_registrasi`
--
ALTER TABLE `data_registrasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_reservasi`
--
ALTER TABLE `data_reservasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_reservasi_data_user_id_foreign` (`data_user_id`),
  ADD KEY `data_reservasi_data_registrasi_id_foreign` (`data_registrasi_id`),
  ADD KEY `data_reservasi_layanan_id_foreign` (`layanan_id`);

--
-- Indexes for table `data_reservhomeserv`
--
ALTER TABLE `data_reservhomeserv`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_reservhomeserv_data_user_id_foreign` (`data_user_id`),
  ADD KEY `data_reservhomeserv_data_registrasi_id_foreign` (`data_registrasi_id`),
  ADD KEY `data_reservhomeserv_layanan_id_foreign` (`layanan_id`);

--
-- Indexes for table `data_user`
--
ALTER TABLE `data_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_registrasi`
--
ALTER TABLE `data_registrasi`
  MODIFY `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `data_reservasi`
--
ALTER TABLE `data_reservasi`
  MODIFY `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `data_reservhomeserv`
--
ALTER TABLE `data_reservhomeserv`
  MODIFY `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `data_user`
--
ALTER TABLE `data_user`
  MODIFY `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `layanan`
--
ALTER TABLE `layanan`
  MODIFY `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_reservasi`
--
ALTER TABLE `data_reservasi`
  ADD CONSTRAINT `data_reservasi_data_registrasi_id_foreign` FOREIGN KEY (`data_registrasi_id`) REFERENCES `data_registrasi` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `data_reservasi_data_user_id_foreign` FOREIGN KEY (`data_user_id`) REFERENCES `data_user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `data_reservasi_layanan_id_foreign` FOREIGN KEY (`layanan_id`) REFERENCES `layanan` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `data_reservhomeserv`
--
ALTER TABLE `data_reservhomeserv`
  ADD CONSTRAINT `data_reservhomeserv_data_registrasi_id_foreign` FOREIGN KEY (`data_registrasi_id`) REFERENCES `data_registrasi` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `data_reservhomeserv_data_user_id_foreign` FOREIGN KEY (`data_user_id`) REFERENCES `data_user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `data_reservhomeserv_layanan_id_foreign` FOREIGN KEY (`layanan_id`) REFERENCES `layanan` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
