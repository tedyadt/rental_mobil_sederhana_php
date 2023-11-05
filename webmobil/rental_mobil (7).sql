-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2023 at 06:23 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rental_mobil`
--

-- --------------------------------------------------------

--
-- Table structure for table `mobil`
--

CREATE TABLE `mobil` (
  `plat_mobil` varchar(50) NOT NULL,
  `nama_mobil` varchar(30) DEFAULT NULL,
  `merk_mobil` varchar(30) DEFAULT NULL,
  `harga_rental` int(11) DEFAULT NULL,
  `foto_mobil` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mobil`
--

INSERT INTO `mobil` (`plat_mobil`, `nama_mobil`, `merk_mobil`, `harga_rental`, `foto_mobil`) VALUES
('L174', 'Kita chan', 'Kessoku', 2147483647, 'Ikuyo-Kita-PC-Wallpaper.jpg'),
('L756', 'Camry', 'Honda', 190000000, '01_attitude-black_0.png'),
('L900', 'Juke', 'Nissan', 1700000000, 'Nissan-Juke-R.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `penyewa`
--

CREATE TABLE `penyewa` (
  `id_penyewa` varchar(50) NOT NULL,
  `nama_penyewa` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `telp` varchar(30) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `ktp` varchar(50) NOT NULL,
  `KK` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penyewa`
--

INSERT INTO `penyewa` (`id_penyewa`, `nama_penyewa`, `email`, `telp`, `alamat`, `ktp`, `KK`) VALUES
('098', 'kana', '76756', '4543543', 'jl.jalanan', '', ''),
('123', 'anto', '90898789896', '07867565', 'jl.luruss', '', ''),
('127', 'tedy', '083424234', '120454', 'jl.alasan', '', ''),
('235', 'tedy kecap', 'tedyaditiya123@gmail.com', '0978678', 'jl sendang bulu', '2457589', '875535345323'),
('331', 'Fahreza', '0854455', '4354324', 'jl.rungkut industri', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(10) NOT NULL,
  `nama_penyewa` varchar(50) NOT NULL,
  `nama_mobil` varchar(50) NOT NULL,
  `tgl_pinjam` varchar(30) NOT NULL,
  `tgl_kembali` varchar(30) NOT NULL,
  `harga_rental` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `nama_penyewa`, `nama_mobil`, `tgl_pinjam`, `tgl_kembali`, `harga_rental`, `timestamp`) VALUES
(123151, '235', 'L900', '2023-07-22', '2023-07-23', 0, '2023-07-25 04:00:12'),
(123152, 'anto', 'Camry', '2023-07-22', '2023-07-23', 0, '2023-07-25 04:00:12'),
(123153, 'tedy', 'Kita chan', '2023-07-22', '2023-07-24', 10900000, '2023-07-25 04:00:12'),
(123154, 'tedy', 'kijang ', '2023-07-22', '2023-07-25', 60000, '2023-07-25 04:00:12'),
(123155, 'anto', 'mk5', '2023-07-25', '2023-07-28', 600000, '2023-07-25 04:01:44'),
(123156, 'tedy kecap', 'Juke', '2023-07-25', '2023-07-26', 1700000000, '2023-07-25 04:08:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mobil`
--
ALTER TABLE `mobil`
  ADD PRIMARY KEY (`plat_mobil`);

--
-- Indexes for table `penyewa`
--
ALTER TABLE `penyewa`
  ADD PRIMARY KEY (`id_penyewa`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123157;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
