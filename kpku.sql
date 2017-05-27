-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 27, 2017 at 02:38 AM
-- Server version: 5.7.17-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kpku`
--

-- --------------------------------------------------------

--
-- Table structure for table `bulan`
--

CREATE TABLE `bulan` (
  `id_bulan` int(10) NOT NULL,
  `nama_bulan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bulan`
--

INSERT INTO `bulan` (`id_bulan`, `nama_bulan`) VALUES
(1, 'Januari'),
(2, 'Febuari'),
(3, 'Maret'),
(4, 'April'),
(5, 'Mei'),
(6, 'Juni'),
(7, 'Juli'),
(8, 'Agustus'),
(9, 'September'),
(10, 'Oktober'),
(11, 'November'),
(12, 'Desember');

-- --------------------------------------------------------

--
-- Table structure for table `inspeksi`
--

CREATE TABLE `inspeksi` (
  `idinspeksi` varchar(15) NOT NULL,
  `idjenis_inspeksi` int(3) NOT NULL,
  `idjenis_kerusakan` int(3) NOT NULL,
  `waktu_kerusakan` date NOT NULL,
  `waktu_perbaikan` date DEFAULT NULL,
  `idpetugas` int(3) NOT NULL,
  `direktori_kerusakan` varchar(255) NOT NULL,
  `direktori_perbaikan` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `lokasi` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inspeksi`
--

INSERT INTO `inspeksi` (`idinspeksi`, `idjenis_inspeksi`, `idjenis_kerusakan`, `waktu_kerusakan`, `waktu_perbaikan`, `idpetugas`, `direktori_kerusakan`, `direktori_perbaikan`, `keterangan`, `lokasi`, `status`) VALUES
('20170118001', 101, 202, '2017-05-01', '2017-05-18', 7, 'gambar-kerusakan/20170118001_101.jpg', 'gambar-perbaikan/20170118001_asd.jpg', '', 'Jalan Tol Banyumanik Km 10', 1),
('20170118002', 102, 204, '2017-05-18', '2017-05-19', 7, 'gambar-kerusakan/20170118002_1506016solo780x390.jpg', 'gambar-perbaikan/20170118002_75407_620.jpg', 'rusak sebelah kanan', 'Jalan Tol bawen Km 1', 1),
('20170118003', 103, 204, '2017-05-18', '2017-05-18', 7, 'gambar-kerusakan/20170118003_102.jpeg', 'gambar-perbaikan/20170118003_20170117003_174657.jpg', 'cat pudar', 'Gerbang tol manyaran', 1),
('20170118004', 104, 203, '2017-05-18', '0000-00-00', 7, 'gambar-kerusakan/20170118004_75407_620.jpg', '', 'rusak parah ', 'Tol km 12  sdasd', 0),
('20170119001', 101, 201, '2017-05-19', '0000-00-00', 7, 'gambar-kerusakan/20170119001_asd.jpg', '', '', 'asdasd', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_inspeksi`
--

CREATE TABLE `jenis_inspeksi` (
  `idjenis_inspeksi` int(3) NOT NULL,
  `nama_inspeksi` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_inspeksi`
--

INSERT INTO `jenis_inspeksi` (`idjenis_inspeksi`, `nama_inspeksi`) VALUES
(101, 'Jembatan'),
(102, 'Jalan'),
(103, 'PJU'),
(104, 'Lain-lain');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_kerusakan`
--

CREATE TABLE `jenis_kerusakan` (
  `idjenis_kerusakan` int(3) NOT NULL,
  `nama_kerusakan` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_kerusakan`
--

INSERT INTO `jenis_kerusakan` (`idjenis_kerusakan`, `nama_kerusakan`) VALUES
(201, 'Retak'),
(202, 'Patah'),
(203, 'Lubang'),
(204, 'Lain-lain'),
(205, 'asedasdff');

-- --------------------------------------------------------

--
-- Table structure for table `labarugi`
--

CREATE TABLE `labarugi` (
  `no_anggaran` int(11) NOT NULL,
  `nama_anggaran` varchar(100) NOT NULL,
  `anggaran` bigint(100) DEFAULT NULL,
  `bulan` int(10) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `tipe_anggaran` varchar(100) NOT NULL,
  `flag` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `labarugi`
--

INSERT INTO `labarugi` (`no_anggaran`, `nama_anggaran`, `anggaran`, `bulan`, `tahun`, `tipe_anggaran`, `flag`) VALUES
(71, 'Pendapatan Tol', 134067625903, 2, '2013', '1', 'Tambah'),
(72, 'Pendapatan Non Tol', 584908389, 2, '2013', '1', 'Tambah'),
(73, 'Gaji dan Tunjangan', 24729786560, 2, '2013', '7', 'Kurang'),
(76, 'Kesehatan', 1078712302, 2, '2013', '7', 'Kurang'),
(77, 'Lembur', 1685395231, 2, '2013', '7', 'Kurang'),
(78, 'Kesejahteraan Lainnya', 3636598061, 2, '2013', '7', 'Kurang'),
(79, 'Pengumpulan Tol', 4649119987, 2, '2013', '6', 'Kurang'),
(80, 'Pelayanan Pemakai Jalan Tol', 4655536305, 2, '2013', '6', 'Kurang'),
(82, 'Pemeliharaan Jalan Tol', 3857683315, 2, '2013', '6', 'Kurang'),
(83, 'Pajak Bumi dan Bangunan', 7257398204, 2, '2013', '8', 'Kurang'),
(85, 'Penyusutan dan Amortisasi', 16225759807, 2, '2013', '9', 'Kurang'),
(86, 'Beban Umum dan Administrasi', 3581903220, 2, '2013', '10', 'Kurang'),
(87, 'Beban Overlay', 15584352180, 2, '2013', '11', 'Kurang'),
(88, 'Penghasilan Bunga', 0, 2, '2013', '3', 'Tambah'),
(89, 'Penghasilan Lain-Lain', 0, 2, '2013', '4', 'Tambah'),
(90, 'Beban Lain-Lain', 0, 2, '2013', '5', 'Tambah'),
(92, 'Bonus Insentif dan Pesangon', 7750048260, 2, '2013', '7', 'Kurang'),
(108, 'Pendapatan Tol', 150000000000, 1, '2013', '1', 'Tambah'),
(109, 'Pendapatan Non Tol', 600000000, 1, '2013', '1', 'Tambah'),
(110, 'Gaji dan Tunjangan', 25000000000, 1, '2013', '7', 'Kurang'),
(111, 'Bonus Insentif dan Pesangon', 8000000000, 1, '2013', '7', 'Kurang'),
(113, 'Kesehatan', 1000000000, 1, '2013', '7', 'Kurang'),
(114, 'Lembur', 1000000000, 1, '2013', '7', 'Kurang'),
(115, 'Kesejahteraan Lainnya', 3000000000, 1, '2013', '7', 'Kurang'),
(116, 'Pengumpulan Tol', 4000000000, 1, '2013', '6', 'Kurang'),
(117, 'Pelayanan Pemakai Jalan Tol', 4000000000, 1, '2013', '6', 'Kurang'),
(119, 'Pemeliharaan Jalan Tol', 3000000000, 1, '2013', '6', 'Kurang'),
(120, 'Pajak Bumi dan Bangunan', 7000000000, 1, '2013', '8', 'Kurang'),
(121, 'Penyusutan dan Amortisasi', 16000000000, 1, '2013', '9', 'Kurang'),
(122, 'Beban Umum dan Administrasi', 3000000000, 1, '2013', '10', 'Kurang'),
(123, 'Beban Overlay', 15000000000, 1, '2013', '11', 'Kurang'),
(124, 'Penghasilan Bunga', 0, 1, '2013', '3', 'Tambah'),
(125, 'Penghasilan Lain-Lain', 0, 1, '2013', '4', 'Tambah'),
(126, 'Beban Lain-Lain', 0, 1, '2013', '5', 'Tambah'),
(127, 'Pendapatan Tol', 135000000000, 3, '2013', '1', 'Tambah'),
(128, 'Pendapatan Non Tol', 500000000, 3, '2013', '1', 'Tambah'),
(129, 'Gaji dan Tunjangan', 20000000000, 3, '2013', '7', 'Kurang'),
(130, 'Bonus Insentif dan Pesangon', 5000000000, 3, '2013', '7', 'Kurang'),
(132, 'Kesehatan', 900000000, 3, '2013', '7', 'Kurang'),
(133, 'Lembur', 950000000, 3, '2013', '7', 'Kurang'),
(134, 'Kesejahteraan Lainnya', 3000000000, 3, '2013', '7', 'Kurang'),
(135, 'Pengumpulan Tol', 3000000000, 3, '2013', '6', 'Kurang'),
(136, 'Pelayanan Pemakai Jalan Tol', 3000000000, 3, '2013', '6', 'Kurang'),
(137, 'Pemeliharaan Jalan Tol', 3000000000, 3, '2013', '6', 'Kurang'),
(138, 'Pajak Bumi dan Bangunan', 7500000000, 3, '2013', '8', 'Kurang'),
(139, 'Penyusutan dan Amortisasi', 10000000000, 3, '2013', '9', 'Kurang'),
(140, 'Beban Umum dan Administrasi', 3500000000, 3, '2013', '10', 'Kurang'),
(141, 'Beban Overlay', 11000000000, 3, '2013', '11', 'Kurang'),
(142, 'Penghasilan Bunga', 0, 3, '2013', '3', 'Tambah'),
(143, 'Penghasilan Lain-Lain', 0, 3, '2013', '4', 'Tambah'),
(144, 'Beban Lain-Lain', 0, 3, '2013', '5', 'Tambah');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `idpetugas` int(3) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `npp` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `level` varchar(10) NOT NULL,
  `request` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`idpetugas`, `nama`, `npp`, `password`, `level`, `request`) VALUES
(1, 'ADMIN', '11111', 'e10adc3949ba59abbe56e057f20f883e', 'admin', 0),
(2, 'GM', '22222', 'e10adc3949ba59abbe56e057f20f883e', 'gm', 0),
(3, 'DGM HRGA', '33333', 'e10adc3949ba59abbe56e057f20f883e', 'dgm_hrga', 0),
(4, 'DGM Operasional', '44444', 'e10adc3949ba59abbe56e057f20f883e', 'dgm_op', 0),
(5, 'DGM Finanance', '55555', 'e10adc3949ba59abbe56e057f20f883e', 'dgm_fn', 0),
(6, 'Petugas hrga', '66666', 'e10adc3949ba59abbe56e057f20f883e', 'ptg_hrga', 0),
(7, 'Petugas op', '77777', 'e10adc3949ba59abbe56e057f20f883e', 'ptg_op', 0),
(8, 'Petugas fn', '88888', 'e10adc3949ba59abbe56e057f20f883e', 'ptg_fn', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tahun`
--

CREATE TABLE `tahun` (
  `id_tahun` int(10) NOT NULL,
  `nama_tahun` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tahun`
--

INSERT INTO `tahun` (`id_tahun`, `nama_tahun`) VALUES
(2013, '2013'),
(2014, '2014'),
(2015, '2015'),
(2016, '2016'),
(2017, '2017');

-- --------------------------------------------------------

--
-- Table structure for table `tipe_anggaran`
--

CREATE TABLE `tipe_anggaran` (
  `id_tipe` int(10) NOT NULL,
  `nama_tipe` varchar(50) NOT NULL,
  `flag` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipe_anggaran`
--

INSERT INTO `tipe_anggaran` (`id_tipe`, `nama_tipe`, `flag`) VALUES
(1, 'Pendapat Usaha', 'Hitung'),
(2, 'Beban Usaha', 'Hitung'),
(3, 'Penghasilan Bunga', 'Hitung'),
(4, 'Penghasilan Lain-Lain', 'Hitung'),
(5, 'Beban Lain Lain', 'Hitung'),
(6, 'Beban Operasi', 'Hitung'),
(7, 'Beban SDM', 'Hitung'),
(8, 'Pajak Bumi dan Bangunan', 'Hitung'),
(9, 'Penyusutan dan Amortisasi', 'Hitung'),
(10, 'Beban Umum dan Administrasi', 'Hitung'),
(11, 'Beban Overlay', 'Hitung');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bulan`
--
ALTER TABLE `bulan`
  ADD PRIMARY KEY (`id_bulan`);

--
-- Indexes for table `inspeksi`
--
ALTER TABLE `inspeksi`
  ADD PRIMARY KEY (`idinspeksi`);

--
-- Indexes for table `jenis_inspeksi`
--
ALTER TABLE `jenis_inspeksi`
  ADD PRIMARY KEY (`idjenis_inspeksi`);

--
-- Indexes for table `jenis_kerusakan`
--
ALTER TABLE `jenis_kerusakan`
  ADD PRIMARY KEY (`idjenis_kerusakan`);

--
-- Indexes for table `labarugi`
--
ALTER TABLE `labarugi`
  ADD PRIMARY KEY (`no_anggaran`),
  ADD UNIQUE KEY `nama_anggaran` (`nama_anggaran`,`bulan`,`tahun`),
  ADD UNIQUE KEY `nama_anggaran_2` (`nama_anggaran`,`bulan`,`tahun`),
  ADD UNIQUE KEY `nama_anggaran_3` (`nama_anggaran`,`bulan`,`tahun`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`idpetugas`),
  ADD UNIQUE KEY `nip` (`npp`);

--
-- Indexes for table `tahun`
--
ALTER TABLE `tahun`
  ADD PRIMARY KEY (`id_tahun`);

--
-- Indexes for table `tipe_anggaran`
--
ALTER TABLE `tipe_anggaran`
  ADD PRIMARY KEY (`id_tipe`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bulan`
--
ALTER TABLE `bulan`
  MODIFY `id_bulan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `jenis_inspeksi`
--
ALTER TABLE `jenis_inspeksi`
  MODIFY `idjenis_inspeksi` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;
--
-- AUTO_INCREMENT for table `jenis_kerusakan`
--
ALTER TABLE `jenis_kerusakan`
  MODIFY `idjenis_kerusakan` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;
--
-- AUTO_INCREMENT for table `labarugi`
--
ALTER TABLE `labarugi`
  MODIFY `no_anggaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;
--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `idpetugas` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tipe_anggaran`
--
ALTER TABLE `tipe_anggaran`
  MODIFY `id_tipe` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
