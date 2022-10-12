-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2022 at 08:43 AM
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
-- Database: `inventorybarang`
--

-- --------------------------------------------------------

--
-- Table structure for table `keluar`
--

CREATE TABLE `keluar` (
  `idkeluar` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `penerima` varchar(25) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keluar`
--

INSERT INTO `keluar` (`idkeluar`, `idbarang`, `tanggal`, `penerima`, `qty`) VALUES
(12, 19, '2022-09-05 11:01:19', 'Satpam', 50),
(13, 20, '2022-09-05 11:01:37', 'Sopir', 71),
(14, 21, '2022-09-05 11:01:53', 'OB', 20),
(17, 21, '2022-09-06 04:13:29', 'Saya', 20),
(18, 19, '2022-09-06 04:16:55', 'Saya', 45),
(19, 27, '2022-09-06 04:20:01', 'Saya', 900),
(21, 30, '2022-09-24 03:42:29', 'Ketua kelas', 150),
(22, 29, '2022-09-28 06:55:18', 'Riswon', 500),
(23, 35, '2022-10-08 12:07:03', 'Guru', 30);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `iduser` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`iduser`, `username`, `password`) VALUES
(1, 'sarpras123', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `masuk`
--

CREATE TABLE `masuk` (
  `idmasuk` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `keterangan` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `masuk`
--

INSERT INTO `masuk` (`idmasuk`, `idbarang`, `tanggal`, `keterangan`, `qty`) VALUES
(11, 18, '2022-09-05 10:59:16', 'Lab. ruang 1', 10),
(12, 19, '2022-09-05 10:59:35', 'Perpustakaan', 25),
(13, 20, '2022-09-05 10:59:49', 'Kantor', 51),
(14, 21, '2022-09-05 11:00:19', 'Ruang Kepala Sekolah', 15),
(15, 23, '2022-09-05 11:00:40', 'Guru', 255),
(16, 24, '2022-09-09 12:34:14', 'Distributor', 200),
(17, 32, '2022-09-24 03:41:36', 'Dosen', 150),
(18, 33, '2022-09-24 03:41:58', 'Keuangan', 200),
(19, 34, '2022-10-08 12:06:36', 'Lab. Komputer 1', 50),
(20, 37, '2022-10-10 11:11:34', 'awal', 50);

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `idpeminjaman` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `tanggalpinjam` timestamp NOT NULL DEFAULT current_timestamp(),
  `qty` int(11) NOT NULL,
  `peminjam` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Dipinjam'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`idpeminjaman`, `idbarang`, `tanggalpinjam`, `qty`, `peminjam`, `status`) VALUES
(1, 23, '2022-09-08 17:00:00', 100, 'Bang Udin', 'kembali'),
(2, 20, '2022-09-08 17:00:00', 20, 'Bang itu', 'kembali'),
(3, 24, '2022-09-08 17:00:00', 200, 'ketua', 'kembali'),
(4, 23, '2022-09-08 17:00:00', 200, 'Guru', 'kembali'),
(5, 25, '2022-09-08 17:00:00', 600, 'Dosen', 'kembali'),
(6, 25, '2022-09-08 17:00:00', 200, 'Dosen ipa', 'kembali'),
(7, 23, '2022-09-09 17:00:00', 30, 'guru', 'kembali'),
(8, 36, '2022-10-07 17:00:00', 55, 'siswa', 'kembali'),
(9, 43, '2022-10-08 17:00:00', 150, 'Dosen', 'kembali'),
(10, 40, '2022-10-09 17:00:00', 25, 'Security', 'kembali'),
(11, 40, '2022-10-09 17:00:00', 25, 'Security', 'kembali'),
(12, 34, '2022-10-09 17:00:00', 25, 'Security', 'Dipinjam'),
(13, 35, '2022-10-11 17:00:00', 15, 'Dosen', 'kembali'),
(14, 38, '2022-10-11 17:00:00', 14, 'Dosen', 'kembali'),
(15, 36, '2022-10-11 17:00:00', 123, 'Dosen', 'kembali'),
(16, 41, '2022-10-11 17:00:00', 25, 'Dosen', 'Dipinjam'),
(17, 48, '2022-10-11 17:00:00', 3, 'Dosen', 'Dipinjam');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `idbarang` int(11) NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp(),
  `kodebarang` varchar(100) NOT NULL,
  `namabarang` varchar(100) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `baik` int(11) NOT NULL,
  `rusak_sedang` int(11) NOT NULL,
  `rusak_berat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`idbarang`, `tanggal`, `kodebarang`, `namabarang`, `deskripsi`, `baik`, `rusak_sedang`, `rusak_berat`) VALUES
(35, '2022-10-12', 'SMK-02', 'Keyboard', 'Elektronik', 25, 5, 2),
(36, '2022-10-12', 'SMK-03', 'Monitor', 'Elektronik', 52, 10, 8),
(37, '2022-10-12', 'SMK-04', 'Casing', 'Elektronik', 75, 40, 31),
(38, '2022-10-12', 'SMK-05', 'RAM 16GB 2666mhz', 'Elektronik', 88, 1, 25),
(39, '2022-10-12', 'SMK-06', 'Intel Core', 'Elektronik', 99, 4, 7),
(40, '2022-10-12', 'SMK-07', 'AMD Ryzen 3', 'Elektronik', 58, 20, 3),
(41, '2022-10-12', 'SMK-08', 'Motherboard', 'Elektronik', 26, 3, 5),
(43, '2022-10-12', 'SMK-10', 'Cooling cpu', 'Elektronik', 57, 8, 1),
(44, '2022-10-12', 'SMK-11', 'Meja Komputer', 'Furniture', 68, 5, 3),
(45, '2022-10-12', 'SMK-12', 'Kursi Kayu', 'Furniture', 91, 25, 14),
(46, '2022-10-12', 'SMK-13', 'Papan Tulis', 'Kebutuhan kelas', 98, 68, 14),
(47, '2022-10-12', 'SMK-14', 'Penghapus Papan Tulis', 'Kebutuhan kelas', 23, 11, 4),
(48, '2022-10-12', 'SMK-15', 'Kipas Angin', 'Elektronik', 147, 75, 5),
(49, '2022-10-12', 'SMK-02', 'Acces Point\'', 'Elektronik', 3, 2, 1),
(50, '2022-10-11', 'BOSS 2021', 'Acces Point222', 'Furniture', 5, 4, 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `keluar`
--
ALTER TABLE `keluar`
  ADD PRIMARY KEY (`idkeluar`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`iduser`);

--
-- Indexes for table `masuk`
--
ALTER TABLE `masuk`
  ADD PRIMARY KEY (`idmasuk`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`idpeminjaman`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`idbarang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `keluar`
--
ALTER TABLE `keluar`
  MODIFY `idkeluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `masuk`
--
ALTER TABLE `masuk`
  MODIFY `idmasuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `idpeminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `idbarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
