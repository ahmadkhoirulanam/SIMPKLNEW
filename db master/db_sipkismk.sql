-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2022 at 03:38 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sipkismk`
--

-- --------------------------------------------------------

--
-- Table structure for table `building`
--

CREATE TABLE `building` (
  `building_id` int(8) NOT NULL,
  `code` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `latitude_longtitude` varchar(100) NOT NULL,
  `radius` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `building`
--

INSERT INTO `building` (`building_id`, `code`, `name`, `address`, `latitude_longtitude`, `radius`) VALUES
(1, 'SWUKZ/2021', 'S-widodo.com', 'Jl. Zainal Abidin Labuhan ratu gg. harapn no. 18 Bandar Lampung', '-5.4028178,105.260116', 1000),
(7, 'SWFEI/2022', 'upgris', 'dr.cipto', '-6.988313034173705,110.43556725195043', 2500),
(8, 'SW5RR/2022', 'pgri', 'sidodadi timur', '-6.988302976729185,110.43544948568868', 10000000);

-- --------------------------------------------------------

--
-- Table structure for table `cuty`
--

CREATE TABLE `cuty` (
  `cuty_id` int(11) NOT NULL,
  `employees_id` int(11) NOT NULL,
  `cuty_start` date NOT NULL,
  `cuty_end` date NOT NULL,
  `date_work` date NOT NULL,
  `cuty_total` int(5) NOT NULL,
  `cuty_description` varchar(100) NOT NULL,
  `cuty_status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `data_request_sktm`
--
-- Error reading structure for table db_sipkismk.data_request_sktm: #1932 - Table 'db_sipkismk.data_request_sktm' doesn't exist in engine
-- Error reading data for table db_sipkismk.data_request_sktm: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `db_sipkismk`.`data_request_sktm`' at line 1

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `employees_code` varchar(20) NOT NULL,
  `employees_email` varchar(30) NOT NULL,
  `employees_password` varchar(100) NOT NULL,
  `employees_name` varchar(50) NOT NULL,
  `position_id` int(5) NOT NULL,
  `shift_id` int(11) NOT NULL,
  `building_id` int(11) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `created_login` datetime NOT NULL,
  `created_cookies` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employees_code`, `employees_email`, `employees_password`, `employees_name`, `position_id`, `shift_id`, `building_id`, `photo`, `created_login`, `created_cookies`) VALUES
(6, 'OM001-2021', 'swidodo.com@gmail.com', 'd060522d419e32b1f5929878c5949c09b2acf30f754954d77644957774f96836', 'Widodo', 2, 1, 1, 'OM001-2021-1a9d0a42736063ec60e8833614f44a6d-142948-.jpg', '2021-12-03 14:40:10', '4c6c453e7a58b5fc11908a3916f944e1'),
(14, '123456789', 'intan@gmail.com', 'acd2bcf0a751e78ba7a1904d55cb26b00b7b5c21ea1c7a91b373c2cf44ae0b29', 'Intan', 1, 1, 1, '', '2021-12-03 14:38:48', '4c6c453e7a58b5fc11908a3916f944e1'),
(15, '123', 'anam@gmail.com', '0381540e609416d1805a525df24f14bb12714b7fffb5249d8f34dd6724973f05', 'anam', 1, 1, 7, '2022-08-01c6b6259d47728868c5b9bdfac9e4d696.jpg', '2022-08-01 20:57:22', 'd199ec3cf75b7bf12fc6e496575f5894'),
(16, '34211', 'kanam5999@gmail.com', 'fe143b7c954b17b8ab0938704798cc0bc821f6e93ebff411ff0fdb8285305112', 'Ahmad khoirul anam yes', 1, 1, 7, '2022-08-02c0fcaebe0e9eaf80b7d08039fb4e7142.jpg', '2022-11-15 09:32:36', '270c2a912f98ef3bba86427478a8a54d'),
(17, '342112', 'admin@gmail.com', 'b2aa1a6ef126cbe2f992802b34c816c7fe0ece9f0681d761d903bd2e24707fa5', 'anam', 7, 1, 8, '2022-08-03c6b6259d47728868c5b9bdfac9e4d696.jpg', '2022-11-15 09:27:52', '270c2a912f98ef3bba86427478a8a54d'),
(18, '1231231', 'ad@gmail.com', '08ab870f9999a67c014a927ec0ce3cdcdbef423ab638671f6db3e4e32b97d0b5', 'adiitya', 7, 1, 7, '2022-08-238c390771a3a1af8d5ac52677dd979db0.jpg', '2022-08-23 18:58:47', 'a1dd0a8c9380f993ee391b4ca92f691f'),
(19, '54', 'abid@gmail.com', 'b2aa1a6ef126cbe2f992802b34c816c7fe0ece9f0681d761d903bd2e24707fa5', 'anam', 1, 1, 7, '2022-09-080677446f81ffd24fa8d103e0e309bf97.jpg', '2022-11-15 09:27:52', '270c2a912f98ef3bba86427478a8a54d');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `position_id` int(5) NOT NULL,
  `position_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`position_id`, `position_name`) VALUES
(1, 'STAFF'),
(2, 'ACCOUNTING'),
(7, 'MARKETING');

-- --------------------------------------------------------

--
-- Table structure for table `presence`
--

CREATE TABLE `presence` (
  `presence_id` int(11) NOT NULL,
  `employees_id` int(11) NOT NULL,
  `presence_date` date NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL,
  `picture_in` text NOT NULL,
  `picture_out` varchar(150) NOT NULL,
  `present_id` int(11) NOT NULL COMMENT 'Masuk,Pulang,Tidak Hadir',
  `latitude_longtitude_in` varchar(200) NOT NULL,
  `latitude_longtitude_out` varchar(200) NOT NULL,
  `information` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `presence`
--

INSERT INTO `presence` (`presence_id`, `employees_id`, `presence_date`, `time_in`, `time_out`, `picture_in`, `picture_out`, `present_id`, `latitude_longtitude_in`, `latitude_longtitude_out`, `information`) VALUES
(1, 6, '2021-08-10', '21:48:19', '22:45:54', '2021-08-10-in-1628606899-6.jpeg', '2021-08-10-out-1628610354-6.jpeg', 1, '-4.5585849,105.40680789999999', '-4.5585849,105.40680789999999', ''),
(2, 6, '2021-08-11', '00:19:18', '00:22:11', '2021-08-11-in-1628615958-6.jpeg', '2021-08-11-out-1628616131-6.jpeg', 1, '-4.5585849,105.40680789999999', '-4.5585849,105.40680789999999', ''),
(3, 6, '2021-12-03', '14:43:21', '00:00:00', '2021-12-03-in-1638517401-6.jpeg', '', 1, '-5.3870592,105.2803072', '', ''),
(4, 15, '2022-08-01', '21:14:39', '21:14:53', '2022-08-01-in-1659363279-15.jpeg', '2022-08-01-out-1659363293-15.jpeg', 1, '-6.9952685,110.4536356', '-6.9952685,110.4536356', ''),
(5, 16, '2022-08-02', '19:52:43', '20:08:00', '2022-08-02-in-1659444763-16.jpeg', '2022-08-02-out-1659445680-16.jpeg', 1, '-6.9952671,110.4536489', '-6.9953119,110.453661', ''),
(6, 16, '2022-08-03', '09:23:46', '09:25:08', '2022-08-03-in-1659493426-16.jpeg', '2022-08-03-out-1659493508-16.jpeg', 1, '-6.9888868,110.4354975', '-6.9888895,110.4354939', '');

-- --------------------------------------------------------

--
-- Table structure for table `present_status`
--

CREATE TABLE `present_status` (
  `present_id` int(6) NOT NULL,
  `present_name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `present_status`
--

INSERT INTO `present_status` (`present_id`, `present_name`) VALUES
(1, 'Hadir'),
(2, 'Sakit'),
(3, 'Izin');

-- --------------------------------------------------------

--
-- Table structure for table `shift`
--

CREATE TABLE `shift` (
  `shift_id` int(11) NOT NULL,
  `shift_name` varchar(20) NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shift`
--

INSERT INTO `shift` (`shift_id`, `shift_name`, `time_in`, `time_out`) VALUES
(1, 'FULL TIME', '07:30:00', '17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sw_site`
--

CREATE TABLE `sw_site` (
  `site_id` int(4) NOT NULL,
  `site_url` varchar(100) NOT NULL,
  `site_name` varchar(50) NOT NULL,
  `site_company` varchar(30) NOT NULL,
  `site_manager` varchar(30) NOT NULL,
  `site_director` varchar(30) NOT NULL,
  `site_phone` char(12) NOT NULL,
  `site_address` text NOT NULL,
  `site_description` text NOT NULL,
  `site_logo` varchar(50) NOT NULL,
  `site_email` varchar(30) NOT NULL,
  `site_email_domain` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sw_site`
--

INSERT INTO `sw_site` (`site_id`, `site_url`, `site_name`, `site_company`, `site_manager`, `site_director`, `site_phone`, `site_address`, `site_description`, `site_logo`, `site_email`, `site_email_domain`) VALUES
(1, 'http://localhost/product/absensi.v3', 'Absensi v.3', 'informatika', 'Intan Permata Sari', 'tes', '089666665781', 'Jl. Zainal Bidin Labuhan Ratu gg. Harapan 1 No 18', 'Absensi v.3', 'whiteswlogowebpng.png', 'swidodo.com@gmail.com', 'info@domain.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bimbingan`
--

CREATE TABLE `tbl_bimbingan` (
  `kdbimbingan` int(11) NOT NULL,
  `kdpenempatan` int(11) NOT NULL,
  `nip` char(21) NOT NULL,
  `nis` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `judul` varchar(50) NOT NULL,
  `catatan` text NOT NULL,
  `file` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_bimbingan`
--

INSERT INTO `tbl_bimbingan` (`kdbimbingan`, `kdpenempatan`, `nip`, `nis`, `tanggal`, `judul`, `catatan`, `file`) VALUES
(1, 1, '123', 11, '2017-11-05', 'wawawawaw', 'jfndslf ljs d fd d  ', ''),
(3, 4, '233', 123, '2022-07-15', '123', 'sss', 'lampiran/bimbingan/Ahmad_Khoirul_Anam_izajah.pdf'),
(4, 4, '233', 123, '2022-07-15', '123', 'ww', 'lampiran/bimbingan/CV_Ahmad_khoirul_anam_3-3.pdf'),
(5, 3, '233', 11, '2022-07-15', '123', 'ww', 'lampiran/bimbingan/Ahmad_Khoirul_Anam_hima.pdf'),
(6, 4, '233', 123, '2022-07-15', 'pkl', 'revisi bab 2', 'lampiran/bimbingan/Ahmad_Khoirul_Anam_izajah1.pdf'),
(7, 16, '233', 16670007, '2022-08-03', 'draf bimbingan', 'sss', 'lampiran/bimbingan/Ahmad_khoirul_anam_berkas.rar'),
(8, 16, '233', 16670007, '2022-08-03', 'bim1', 'sss', 'lampiran/bimbingan/Ahmad_Khoirul_Anam_hima1.pdf'),
(9, 17, '233', 16670007, '2022-08-07', 'draf bimbingan', 'Silakan bisa dipelajari', 'lampiran/bimbingan/Ahmad_Khoirul_Anam_hima2.pdf'),
(10, 18, '233', 16670023, '2022-08-12', 'Revisi Bab 1', 'Tambah Reverensi', 'lampiran/bimbingan/tong_jadi.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_file`
--

CREATE TABLE `tbl_file` (
  `kdfile` int(11) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `nama` text NOT NULL,
  `share` int(11) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_file`
--

INSERT INTO `tbl_file` (`kdfile`, `judul`, `tanggal`, `nama`, `share`, `keterangan`) VALUES
(2, 'draf PKL', '2022-07-15', 'Ahmad_Khoirul_Anam_izajah.pdf', 0, 'draf PKL'),
(3, 'draf PKL', '2022-08-16', '811-2551-1-SM.pdf', 0, 'anam');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_guru`
--

CREATE TABLE `tbl_guru` (
  `nip` char(21) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `mapel` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_industri`
--

CREATE TABLE `tbl_industri` (
  `kdind` int(11) NOT NULL,
  `nama_industri` varchar(50) NOT NULL,
  `bidang_kerja` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `alamat_industri` text NOT NULL,
  `wilayah` varchar(50) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `website` text NOT NULL,
  `email` text NOT NULL,
  `syarat` text NOT NULL,
  `kuota` int(20) NOT NULL,
  `foto` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_industri`
--

INSERT INTO `tbl_industri` (`kdind`, `nama_industri`, `bidang_kerja`, `deskripsi`, `alamat_industri`, `wilayah`, `telepon`, `website`, `email`, `syarat`, `kuota`, `foto`) VALUES
(2, 'Kementrian Pendidikan', 'as', 'asfdsa alf ldsaf', 'asidfjids sdfdlk f', 'jambi', '083234', 'https://fb.com', 'askfh@hasw.com', 'sdfdjf', 12, 'logo-None-kemdikbud.png'),
(3, 'PT. Abadi Sejahtera', 'IT', 'dd', 'dd', 'Semarang', '3', '3', 'samsung@gmail.com', 'ss', 20, 'emarket.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_info`
--

CREATE TABLE `tbl_info` (
  `kdinfo` int(11) NOT NULL,
  `kdlabel` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `judul` text NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` text NOT NULL,
  `penulis` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_info`
--

INSERT INTO `tbl_info` (`kdinfo`, `kdlabel`, `tanggal`, `judul`, `deskripsi`, `gambar`, `penulis`) VALUES
(4, 1, '2017-11-06', 'asff', '<p>sdgdsg</p>', 'foto/info/fb2016.png', 'Anwar-kun'),
(5, 2, '2017-11-06', 'kvkbk', 'kgkbjkbjk', 'foto/info/foto-lastgooglenews-facebookdeepweb21.jpeg', 'Anwar-kun');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jurusan`
--

CREATE TABLE `tbl_jurusan` (
  `kdjurusan` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_jurusan`
--

INSERT INTO `tbl_jurusan` (`kdjurusan`, `nama`) VALUES
(1, 'Informatika');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kelas`
--

CREATE TABLE `tbl_kelas` (
  `kdkelas` int(11) NOT NULL,
  `kdjurusan` char(5) NOT NULL,
  `nama` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kelas`
--

INSERT INTO `tbl_kelas` (`kdkelas`, `kdjurusan`, `nama`) VALUES
(3, '1', '6B'),
(2, '1', '6A');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_label`
--

CREATE TABLE `tbl_label` (
  `kdlabel` int(11) NOT NULL,
  `nama_label` varchar(50) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_label`
--

INSERT INTO `tbl_label` (`kdlabel`, `nama_label`, `keterangan`) VALUES
(1, 'Pengumuman', '-'),
(2, 'Tips', '-'),
(3, 'Industri', '-'),
(4, 'Sekolah', '-'),
(5, 'Lain-lain', '-');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nilai`
--

CREATE TABLE `tbl_nilai` (
  `kdnilai` int(11) NOT NULL,
  `kdpenempatan` int(11) NOT NULL,
  `keterangan` enum('Nilai-Dosen','Intansi','Laporan') NOT NULL,
  `nilai` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_nilai`
--

INSERT INTO `tbl_nilai` (`kdnilai`, `kdpenempatan`, `keterangan`, `nilai`) VALUES
(22, 20, 'Nilai-Dosen', 45),
(23, 20, 'Intansi', 56);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pemb`
--

CREATE TABLE `tbl_pemb` (
  `kdpemb` int(11) NOT NULL,
  `kdjurusan` char(5) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` text NOT NULL,
  `nip` char(21) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `wilayah` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pemb`
--

INSERT INTO `tbl_pemb` (`kdpemb`, `kdjurusan`, `username`, `password`, `nip`, `nama_lengkap`, `wilayah`) VALUES
(2, '1', 'pembimbing', '9d98460ff5d64814e7d341a965f38db1', '123', 'Ankun', 'jambi'),
(3, '1', 'dosen', 'ce28eed1511f631af6b2a7bb0a85d636', '233', 'Bambang Agus Herlambang', 'upgris'),
(7, '1', 'aan', '4607ed4bd8140e9664875f907f48ae14', 's', 's', 's'),
(8, '1', 'anam', '80437b9dadf860bbf7bc9b469d506b9a', 'a@gmail.com', 'ss', 's');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pemblap`
--

CREATE TABLE `tbl_pemblap` (
  `kdpemblap` int(11) NOT NULL,
  `kdjurusan` char(5) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` text NOT NULL,
  `nip` char(21) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `wilayah` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pemblap`
--

INSERT INTO `tbl_pemblap` (`kdpemblap`, `kdjurusan`, `username`, `password`, `nip`, `nama_lengkap`, `wilayah`) VALUES
(13, '1', 'kominfo', 'dc2f4ef676263fe9dde73a9ae6299258', '123451234', 'Susanto', 'Semarang');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penempatan`
--

CREATE TABLE `tbl_penempatan` (
  `kdpenempatan` int(11) NOT NULL,
  `nis` int(11) NOT NULL,
  `kdpemb` int(11) NOT NULL,
  `kdind` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `wilayah` varchar(50) NOT NULL,
  `tahun` year(4) NOT NULL,
  `status` enum('-','proses','ditolak','diterima') NOT NULL,
  `surat` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_penempatan`
--

INSERT INTO `tbl_penempatan` (`kdpenempatan`, `nis`, `kdpemb`, `kdind`, `tanggal`, `wilayah`, `tahun`, `status`, `surat`) VALUES
(18, 16670023, 3, 3, '2022-08-12', 'Semarang', 2022, 'diterima', NULL),
(20, 16670007, 3, 3, '2022-11-09', 'upgris', 2022, 'diterima', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_siswa`
--

CREATE TABLE `tbl_siswa` (
  `nis` int(11) NOT NULL,
  `kdkelas` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `telp` varchar(14) NOT NULL,
  `foto` text NOT NULL,
  `password` text NOT NULL,
  `kdpemb` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_siswa`
--

INSERT INTO `tbl_siswa` (`nis`, `kdkelas`, `nama_lengkap`, `telp`, `foto`, `password`, `kdpemb`) VALUES
(16670045, 2, 'Budi Bangun Negoro', '444', 'Ahmad_Khoirul_Anam_CSS.pdf', '550a141f12de6341fba65b0ad0433500', 3),
(16670007, 2, 'ahmad khoirul anam', '08896083456', 'me1.jpg', '770442e7977c95c94ba014df32b2dc01', 3),
(166700071, 2, 's', '333', 'me.jpg', 'ee17fa65b1adc19f4b4b7da14904f4ec', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tolak_penempatan`
--

CREATE TABLE `tbl_tolak_penempatan` (
  `kdtolak` int(11) NOT NULL,
  `kdpenempatan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `alasan` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `identitas` varchar(32) NOT NULL,
  `password` text NOT NULL,
  `status` varchar(11) NOT NULL,
  `foto` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `nama_lengkap`, `identitas`, `password`, `status`, `foto`) VALUES
(1, 'admin', 'Admin-Informatika', 'admin', '21232f297a57a5a743894a0e4a801fc3', '-', 'foto-lastgooglenews-facebookdeepweb2.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fullname` varchar(40) NOT NULL,
  `registered` datetime NOT NULL,
  `created_login` datetime NOT NULL,
  `last_login` datetime NOT NULL,
  `session` varchar(100) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `browser` varchar(30) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `email`, `password`, `fullname`, `registered`, `created_login`, `last_login`, `session`, `ip`, `browser`, `level`) VALUES
(1, 'Widodo', 'swidodo.com@gmail.com', '88222999e01f1910a5ac39fa37d3b8b704973d503d0ff7c84d46305b92cfa0f6', 'Admin', '2021-02-03 10:22:00', '2022-11-15 09:30:06', '2022-11-15 09:31:26', '-', '1', 'Google Crome', 1),
(3, 'admin', 'kanam5999@gmail.com', '88b3340abaa6acbf87abe45f68fa8960224c1e36f6a96433bcbc490c84c9c6d2', 'tes admin', '2022-11-15 09:31:18', '2022-11-15 09:32:09', '2022-11-15 09:31:34', '-', '1', 'Google Crome', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_level`
--

CREATE TABLE `user_level` (
  `level_id` int(4) NOT NULL,
  `level_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_level`
--

INSERT INTO `user_level` (`level_id`, `level_name`) VALUES
(1, 'Administrator'),
(2, 'Operator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `building`
--
ALTER TABLE `building`
  ADD PRIMARY KEY (`building_id`);

--
-- Indexes for table `cuty`
--
ALTER TABLE `cuty`
  ADD PRIMARY KEY (`cuty_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`position_id`);

--
-- Indexes for table `presence`
--
ALTER TABLE `presence`
  ADD PRIMARY KEY (`presence_id`);

--
-- Indexes for table `present_status`
--
ALTER TABLE `present_status`
  ADD PRIMARY KEY (`present_id`);

--
-- Indexes for table `shift`
--
ALTER TABLE `shift`
  ADD PRIMARY KEY (`shift_id`);

--
-- Indexes for table `sw_site`
--
ALTER TABLE `sw_site`
  ADD PRIMARY KEY (`site_id`);

--
-- Indexes for table `tbl_bimbingan`
--
ALTER TABLE `tbl_bimbingan`
  ADD PRIMARY KEY (`kdbimbingan`);

--
-- Indexes for table `tbl_file`
--
ALTER TABLE `tbl_file`
  ADD PRIMARY KEY (`kdfile`);

--
-- Indexes for table `tbl_guru`
--
ALTER TABLE `tbl_guru`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `tbl_industri`
--
ALTER TABLE `tbl_industri`
  ADD PRIMARY KEY (`kdind`);

--
-- Indexes for table `tbl_info`
--
ALTER TABLE `tbl_info`
  ADD PRIMARY KEY (`kdinfo`);

--
-- Indexes for table `tbl_jurusan`
--
ALTER TABLE `tbl_jurusan`
  ADD PRIMARY KEY (`kdjurusan`);

--
-- Indexes for table `tbl_kelas`
--
ALTER TABLE `tbl_kelas`
  ADD PRIMARY KEY (`kdkelas`);

--
-- Indexes for table `tbl_label`
--
ALTER TABLE `tbl_label`
  ADD PRIMARY KEY (`kdlabel`);

--
-- Indexes for table `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  ADD PRIMARY KEY (`kdnilai`);

--
-- Indexes for table `tbl_pemb`
--
ALTER TABLE `tbl_pemb`
  ADD PRIMARY KEY (`kdpemb`);

--
-- Indexes for table `tbl_pemblap`
--
ALTER TABLE `tbl_pemblap`
  ADD PRIMARY KEY (`kdpemblap`);

--
-- Indexes for table `tbl_penempatan`
--
ALTER TABLE `tbl_penempatan`
  ADD PRIMARY KEY (`kdpenempatan`);

--
-- Indexes for table `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  ADD PRIMARY KEY (`nis`);

--
-- Indexes for table `tbl_tolak_penempatan`
--
ALTER TABLE `tbl_tolak_penempatan`
  ADD PRIMARY KEY (`kdtolak`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_level`
--
ALTER TABLE `user_level`
  ADD PRIMARY KEY (`level_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `building`
--
ALTER TABLE `building`
  MODIFY `building_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cuty`
--
ALTER TABLE `cuty`
  MODIFY `cuty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `position_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `presence`
--
ALTER TABLE `presence`
  MODIFY `presence_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `present_status`
--
ALTER TABLE `present_status`
  MODIFY `present_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `shift`
--
ALTER TABLE `shift`
  MODIFY `shift_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sw_site`
--
ALTER TABLE `sw_site`
  MODIFY `site_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_bimbingan`
--
ALTER TABLE `tbl_bimbingan`
  MODIFY `kdbimbingan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_file`
--
ALTER TABLE `tbl_file`
  MODIFY `kdfile` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_industri`
--
ALTER TABLE `tbl_industri`
  MODIFY `kdind` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_info`
--
ALTER TABLE `tbl_info`
  MODIFY `kdinfo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_jurusan`
--
ALTER TABLE `tbl_jurusan`
  MODIFY `kdjurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_kelas`
--
ALTER TABLE `tbl_kelas`
  MODIFY `kdkelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_label`
--
ALTER TABLE `tbl_label`
  MODIFY `kdlabel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  MODIFY `kdnilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_pemb`
--
ALTER TABLE `tbl_pemb`
  MODIFY `kdpemb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_pemblap`
--
ALTER TABLE `tbl_pemblap`
  MODIFY `kdpemblap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_penempatan`
--
ALTER TABLE `tbl_penempatan`
  MODIFY `kdpenempatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_tolak_penempatan`
--
ALTER TABLE `tbl_tolak_penempatan`
  MODIFY `kdtolak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_level`
--
ALTER TABLE `user_level`
  MODIFY `level_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
