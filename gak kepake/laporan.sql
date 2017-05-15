-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2017 at 00:00 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laporan`
--


-- --------------------------------------------------------
--
-- Table structure for table `inspeksi`
--
CREATE TABLE `inspeksi`(
  `idinspeksi` varchar(15) NOT NULL,
  `idjenis_inspeksi` int(3) NOT NULL,
  `idjenis_kerusakan` int(3) NOT NULL,
  `waktu_kerusakan` date NOT NULL,
  `waktu_perbaikan` date DEFAULT NULL,
  `idpetugas` int(3) NOT NULL,
  `direktori_kerusakan` varchar(255) NOT NULL,
  `direktori_perbaikan` varchar(255) DEFAULT NULL,
  `lokasi` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=latin1;
--
-- Dumping data for table `inspieksi`
--

INSERT INTO `inspeksi` (`idinspeksi`, `idjenis_inspeksi`, `idjenis_kerusakan`, `waktu_kerusakan`, `waktu_perbaikan`, `idpetugas`, `direktori_kerusakan`,`direktori_perbaikan`,`lokasi`,`status`) VALUES
('20170101000001', 101, 201, '2017-01-01', '2017-01-01',6,'gambar-kerusakan/101.jpg','gambar-perbaikan/101.jpg','Tol banyumanik km 10',1),
('20170102000002', 102, 203, '2017-01-02', '',6,'gambar-kerusakan/102.jpg','','Tol banyumanik km 11',0),
('20170102000003', 102, 203, '2017-01-02', '',6,'gambar-kerusakan/103.jpg','','Tol banyumanik km 13',0);

--
-- Indexes for table `inspeksi`
--
ALTER TABLE `inspeksi`
  ADD PRIMARY KEY (`idinspeksi`);
-- --------------------------------------------------------
--
-- Table structure for table `petugas`
--
CREATE TABLE `jenis_inspeksi` (
  `idjenis_inspeksi` int(3) NOT NULL,
  `nama_inspeksi` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--
-- Dumping data for table `petugas`
--
INSERT INTO `jenis_inspeksi` (`idjenis_inspeksi`, `nama_inspeksi`) VALUES
(101, 'Jembatan'),
(102, 'Jalan'),
(103, 'PJU'),
(104, 'Lain-lain');


--
-- Indexes for table `petugas`
--
ALTER TABLE `jenis_inspeksi`
  ADD PRIMARY KEY (`idjenis_inspeksi`);

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `jenis_inspeksi`
  MODIFY `idjenis_inspeksi` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;
  -- --------------------------------------------------------
  --
  -- Table structure for table `petugas`
  --
  CREATE TABLE `jenis_kerusakan` (
    `idjenis_kerusakan` int(3) NOT NULL,
    `nama_kerusakan` varchar(40) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
  --
  -- Dumping data for table `petugas`
  --
  INSERT INTO `jenis_kerusakan` (`idjenis_kerusakan`, `nama_kerusakan`) VALUES
  (201, 'Retak'),
  (202, 'Patah'),
  (203, 'Lubang'),
  (204, 'Lain-lain');


  --
  -- Indexes for table `petugas`
  --
  ALTER TABLE `jenis_kerusakan`
    ADD PRIMARY KEY (`idjenis_kerusakan`);

  --
  -- AUTO_INCREMENT for table `petugas`
  --
  ALTER TABLE `jenis_kerusakan`
    MODIFY `idjenis_kerusakan` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;

-- --------------------------------------------------------
--
-- Table structure for table `petugas`
--
CREATE TABLE `petugas` (
  `idpetugas` int(3) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `nip` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `level` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--
-- Dumping data for table `petugas`
--
INSERT INTO `petugas` (`idpetugas`, `nama`, `nip`, `password`, `level`) VALUES
(1, 'ADMIN', '11111', '123123', '1'),
(2, 'GM', '22222', '123123', '2'),
(3, 'HRGA', '33333', '123123', '3'),
(4, 'Operasional', '44444', '123123', '4'),
(5, 'Budgeting', '55555', '123123', '5'),
(6, 'Petugas1', '66666', '123123', '6');


--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`idpetugas`);

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `idpetugas` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
-- --------------------------------------------------------
