-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 12, 2017 at 08:52 PM
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
  `npp` varchar(5) NOT NULL,
  `direktori_kerusakan` varchar(255) NOT NULL,
  `direktori_perbaikan` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `lokasi` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inspeksi`
--

INSERT INTO `inspeksi` (`idinspeksi`, `idjenis_inspeksi`, `idjenis_kerusakan`, `waktu_kerusakan`, `waktu_perbaikan`, `npp`, `direktori_kerusakan`, `direktori_perbaikan`, `keterangan`, `lokasi`, `status`) VALUES
('20170118001', 101, 202, '2017-05-01', '2017-05-18', '05297', 'gambar-kerusakan/20170118001_101.jpg', 'gambar-perbaikan/20170118001_asd.jpg', '', 'Jalan Tol Banyumanik Km 10', 1),
('20170118002', 102, 204, '2017-05-18', '2017-05-22', '05297', 'gambar-kerusakan/20170118002_1506016solo780x390.jpg', 'gambar-perbaikan/20170118002_75407_620.jpg', 'rusak sebelah kanan', 'Jalan Tol bawen Km 1', 1),
('20170118003', 103, 204, '2017-05-18', '2017-05-23', '05297', 'gambar-kerusakan/20170118003_102.jpeg', 'gambar-perbaikan/20170118003_20170117003_174657.jpg', 'cat pudar', 'Gerbang tol manyaran', 1),
('20170612001', 101, 201, '2017-06-02', '2017-06-10', '05297', 'gambar-kerusakan/20170612001_jalan1.jpg', 'gambar-perbaikan/20170612001_jalan6.jpg', '', 'Km. 3 dari gerbang tol tembalang sebelah kiri', 1),
('20170612002', 101, 202, '2017-05-28', '2017-06-09', '05297', 'gambar-kerusakan/20170612002_jalan5.jpg', 'gambar-perbaikan/20170612002_jalan9.jpg', '', 'Km. 3 dari gerbang tol manyaran sebelah kanan', 1),
('20170612003', 101, 203, '2017-06-12', '0000-00-00', '05297', 'gambar-kerusakan/20170612003_jalan2.jpg', '', '', 'Km. 1.5 dari gerbang tol tembalang sebelah kiri', 0),
('20170612004', 101, 204, '2017-06-10', '0000-00-00', '05297', 'gambar-kerusakan/20170612004_jalan3.jpg', '', 'Banjir, irigasi kurang', 'Km. 1 dari gerbang tol bawen sebelah kiri', 0),
('20170612005', 102, 201, '2017-06-12', '2017-06-12', '05297', 'gambar-kerusakan/20170612005_jembatan3.jpg', 'gambar-perbaikan/20170612005_jembatan2.jpg', '', 'Km. 1 dari gerbang tol tembalang sebelah kiri', 1),
('20170612006', 102, 202, '2017-06-12', '0000-00-00', '05297', 'gambar-kerusakan/20170612006_jembatan 6.jpg', '', '', 'jembatan penyebrangan km 5 dari gerbang tol manayaran\r\n', 0),
('20170612007', 102, 203, '2017-06-03', '0000-00-00', '05297', 'gambar-kerusakan/20170612007_jembatan8.jpg', '', '', 'Km. 3.6 dari gerbang tol banyumaniksebelah kiri', 0),
('20170612008', 102, 204, '2017-06-04', '0000-00-00', '05297', 'gambar-kerusakan/20170612008_lain-lain4.jpg', '', 'Pembatas jembatan rusak', 'Km. 3 dari gerbang tol mukitiharjo sebelah kanan', 0),
('20170612009', 103, 202, '2017-06-03', '0000-00-00', '05297', 'gambar-kerusakan/20170612009_pju5.jpg', '', '', 'Km. 3.7 dari gerbang tol ungatan sebelah kiri', 0),
('20170612010', 103, 203, '2017-06-12', '0000-00-00', '05297', 'gambar-kerusakan/20170612010_pju4.jpg', '', '', 'Km. 9 dari gerbang tol mbawan sebalah kanan\r\n', 0),
('20170612011', 103, 204, '2017-06-11', '2017-06-12', '05297', 'gambar-kerusakan/20170612011_pju7.jpg', 'gambar-perbaikan/20170612011_pju9.jpg', 'lampu PJU Mati', 'Km. 6.4 dari gerbang tol tembalang sebelah kiri', 1),
('20170612012', 104, 202, '2017-06-05', '2017-06-10', '05297', 'gambar-kerusakan/20170612012_lain-lain2.jpg', 'gambar-perbaikan/20170612012_lain-lain8.jpg', '', 'Km. 9.43 dari gerbang tol ungaran sebelah kiri', 1),
('20170612013', 104, 204, '2017-06-01', '2017-06-12', '05297', 'gambar-kerusakan/20170612013_lain-lain5.jpg', 'gambar-perbaikan/20170612013_lain-lain7.jpg', 'plang roboh', 'Km. 6.6 dari gerbang tol tembalang sebelah kiri', 1);

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
(101, 'Jalan'),
(102, 'Jembatan'),
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
(201, 'Lubang'),
(202, 'Patah'),
(203, 'Retak'),
(204, 'Lain-lain');

-- --------------------------------------------------------

--
-- Table structure for table `labarugi`
--

CREATE TABLE `labarugi` (
  `no_anggaran` int(11) NOT NULL,
  `nama_anggaran` varchar(100) NOT NULL,
  `anggaran` bigint(100) NOT NULL,
  `bulan` int(10) NOT NULL,
  `tahun` int(10) NOT NULL,
  `tipe_anggaran` int(10) NOT NULL,
  `flag` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `labarugi`
--

INSERT INTO `labarugi` (`no_anggaran`, `nama_anggaran`, `anggaran`, `bulan`, `tahun`, `tipe_anggaran`, `flag`) VALUES
(71, 'Pendapatan Tol', 134067625903, 2, 2013, 1, 'Tambah'),
(72, 'Pendapatan Non Tol', 584908389, 2, 2013, 1, 'Tambah'),
(73, 'Gaji dan Tunjangan', 24729786560, 2, 2013, 7, 'Kurang'),
(76, 'Kesehatan', 1078712302, 2, 2013, 7, 'Kurang'),
(77, 'Lembur', 1685395231, 2, 2013, 7, 'Kurang'),
(78, 'Kesejahteraan Lainnya', 3636598061, 2, 2013, 7, 'Kurang'),
(79, 'Pengumpulan Tol', 4649119987, 2, 2013, 6, 'Kurang'),
(80, 'Pelayanan Pemakai Jalan Tol', 4655536305, 2, 2013, 6, 'Kurang'),
(82, 'Pemeliharaan Jalan Tol', 3857683315, 2, 2013, 6, 'Kurang'),
(83, 'Pajak Bumi dan Bangunan', 7257398204, 2, 2013, 8, 'Kurang'),
(85, 'Penyusutan dan Amortisasi', 16225759807, 2, 2013, 9, 'Kurang'),
(86, 'Beban Umum dan Administrasi', 3581903220, 2, 2013, 10, 'Kurang'),
(87, 'Beban Overlay', 15584352180, 2, 2013, 11, 'Kurang'),
(88, 'Penghasilan Bunga', 0, 2, 2013, 3, 'Tambah'),
(89, 'Penghasilan Lain-Lain', 0, 2, 2013, 4, 'Tambah'),
(90, 'Beban Lain-Lain', 0, 2, 2013, 5, 'Tambah'),
(92, 'Bonus Insentif dan Pesangon', 7750048260, 2, 2013, 7, 'Kurang'),
(108, 'Pendapatan Tol', 150000000000, 1, 2013, 1, 'Tambah'),
(109, 'Pendapatan Non Tol', 600000000, 1, 2013, 1, 'Tambah'),
(110, 'Gaji dan Tunjangan', 35000000000, 1, 2013, 7, 'Kurang'),
(111, 'Bonus Insentif dan Pesangon', 8000000000, 1, 2013, 7, 'Kurang'),
(113, 'Kesehatan', 1000000000, 1, 2013, 7, 'Kurang'),
(114, 'Lembur', 1000000000, 1, 2013, 7, 'Kurang'),
(115, 'Kesejahteraan Lainnya', 3000000000, 1, 2013, 7, 'Kurang'),
(116, 'Pengumpulan Tol', 4000000000, 1, 2013, 6, 'Kurang'),
(117, 'Pelayanan Pemakai Jalan Tol', 4000000000, 1, 2013, 6, 'Kurang'),
(119, 'Pemeliharaan Jalan Tol', 3000000000, 1, 2013, 6, 'Kurang'),
(120, 'Pajak Bumi dan Bangunan', 7000000000, 1, 2013, 8, 'Kurang'),
(121, 'Penyusutan dan Amortisasi', 16000000000, 1, 2013, 9, 'Kurang'),
(122, 'Beban Umum dan Administrasi', 3000000000, 1, 2013, 10, 'Kurang'),
(123, 'Beban Overlay', 15000000000, 1, 2013, 11, 'Kurang'),
(124, 'Penghasilan Bunga', 0, 1, 2013, 3, 'Tambah'),
(125, 'Penghasilan Lain-Lain', 0, 1, 2013, 4, 'Tambah'),
(126, 'Beban Lain-Lain', 0, 1, 2013, 5, 'Tambah'),
(127, 'Pendapatan Tol', 135000000000, 3, 2013, 1, 'Tambah'),
(128, 'Pendapatan Non Tol', 500000000, 3, 2013, 1, 'Tambah'),
(129, 'Gaji dan Tunjangan', 20000000000, 3, 2013, 7, 'Kurang'),
(130, 'Bonus Insentif dan Pesangon', 5000000000, 3, 2013, 7, 'Kurang'),
(132, 'Kesehatan', 900000000, 3, 2013, 7, 'Kurang'),
(133, 'Lembur', 950000000, 3, 2013, 7, 'Kurang'),
(134, 'Kesejahteraan Lainnya', 3000000000, 3, 2013, 7, 'Kurang'),
(135, 'Pengumpulan Tol', 3000000000, 3, 2013, 6, 'Kurang'),
(136, 'Pelayanan Pemakai Jalan Tol', 3000000000, 3, 2013, 6, 'Kurang'),
(137, 'Pemeliharaan Jalan Tol', 3000000000, 3, 2013, 6, 'Kurang'),
(138, 'Pajak Bumi dan Bangunan', 7500000000, 3, 2013, 8, 'Kurang'),
(139, 'Penyusutan dan Amortisasi', 10000000000, 3, 2013, 9, 'Kurang'),
(140, 'Beban Umum dan Administrasi', 3500000000, 3, 2013, 10, 'Kurang'),
(141, 'Beban Overlay', 11000000000, 3, 2013, 11, 'Kurang'),
(142, 'Penghasilan Bunga', 0, 3, 2013, 3, 'Tambah'),
(143, 'Penghasilan Lain-Lain', 0, 3, 2013, 4, 'Tambah'),
(173, 'Pendapatan Tol', 134067625903, 4, 2013, 1, 'Tambah'),
(174, 'Gaji dan Tunjangan', 24729786560, 4, 2013, 7, 'Kurang'),
(175, 'Pendapatan Non Tol', 584908389, 4, 2013, 1, 'Tambah'),
(176, 'Bonus Insentif dan Pesangon', 7750048260, 4, 2013, 7, 'Kurang'),
(177, 'Kesehatan', 1078712302, 4, 2013, 7, 'Kurang'),
(178, 'Lembur', 1685395231, 4, 2013, 7, 'Kurang'),
(179, 'Kesejahteraan Lainnya', 3636598061, 4, 2013, 7, 'Kurang'),
(180, 'Pengumpulan Tol', 4649119987, 4, 2013, 6, 'Kurang'),
(181, 'Pelayanan Pemakai Jalan Tol', 4655536305, 4, 2013, 6, 'Kurang'),
(182, 'Pemeliharaan Jalan Tol', 3857683315, 4, 2013, 6, 'Kurang'),
(183, 'Pajak Bumi dan Bangunan', 7257398204, 4, 2013, 8, 'Kurang'),
(184, 'Penyusutan dan Amortisasi', 16225759807, 4, 2013, 9, 'Kurang'),
(185, 'Beban Umum dan Administrasi', 3581903220, 4, 2013, 10, 'Kurang'),
(186, 'Beban Overlay', 15584352180, 4, 2013, 11, 'Kurang'),
(187, 'Penghasilan Bunga', 0, 4, 2013, 3, 'Tambah'),
(188, 'Penghasilan Lain-Lain', 0, 4, 2013, 4, 'Tambah'),
(189, 'Beban Lain-Lain', 0, 4, 2013, 5, 'Tambah'),
(190, 'Pendapatan Tol', 10000000000, 5, 2013, 1, 'Tambah'),
(195, 'Gaji dan Tunjangan', 250000000, 5, 2013, 7, 'Kurang');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `npp` varchar(5) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `level` varchar(10) NOT NULL,
  `request` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`npp`, `nama`, `password`, `level`, `request`) VALUES
('05291', 'ADMIN', 'e10adc3949ba59abbe56e057f20f883e', 'admin', 0),
('05292', 'Kristanto', 'e10adc3949ba59abbe56e057f20f883e', 'gm', 0),
('05293', 'Zaimil', 'e10adc3949ba59abbe56e057f20f883e', 'dgm_hrga', 0),
('05294', 'Taufik', 'e10adc3949ba59abbe56e057f20f883e', 'dgm_op', 0),
('05295', 'Muzakir M', 'e10adc3949ba59abbe56e057f20f883e', 'dgm_fn', 0),
('05296', 'Sunarso', 'e10adc3949ba59abbe56e057f20f883e', 'ptg_hrga', 0),
('05297', 'Rifka Aryansyach', 'e10adc3949ba59abbe56e057f20f883e', 'ptg_op', 0),
('05298', 'Hadi Makmurarto', 'e10adc3949ba59abbe56e057f20f883e', 'ptg_fn', 0),
('15297', 'Genta Satria', 'e10adc3949ba59abbe56e057f20f883e', 'ptg_op', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tahun`
--

CREATE TABLE `tahun` (
  `id_tahun` int(10) NOT NULL,
  `nama_tahun` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tahun`
--

INSERT INTO `tahun` (`id_tahun`, `nama_tahun`) VALUES
(2013, 2013),
(2014, 2014),
(2015, 2015),
(2016, 2016);

-- --------------------------------------------------------

--
-- Table structure for table `tipe_anggaran`
--

CREATE TABLE `tipe_anggaran` (
  `id_tipe` int(10) NOT NULL,
  `nama_tipe` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipe_anggaran`
--

INSERT INTO `tipe_anggaran` (`id_tipe`, `nama_tipe`) VALUES
(1, 'Pendapat Usaha'),
(2, 'Beban Usaha'),
(3, 'Penghasilan Bunga'),
(4, 'Penghasilan Lain-Lain'),
(5, 'Beban Lain Lain'),
(6, 'Beban Operasi'),
(7, 'Beban SDM'),
(8, 'Pajak Bumi dan Bangunan'),
(9, 'Penyusutan dan Amortisasi'),
(10, 'Beban Umum dan Administrasi'),
(11, 'Beban Overlay');

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
  ADD PRIMARY KEY (`npp`);

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
  MODIFY `idjenis_kerusakan` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;
--
-- AUTO_INCREMENT for table `labarugi`
--
ALTER TABLE `labarugi`
  MODIFY `no_anggaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;
--
-- AUTO_INCREMENT for table `tipe_anggaran`
--
ALTER TABLE `tipe_anggaran`
  MODIFY `id_tipe` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
