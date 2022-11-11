-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 12, 2014 at 06:56 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pkl`
--

-- --------------------------------------------------------

--
-- Table structure for table `pokja`
--

CREATE TABLE IF NOT EXISTS `pokja` (
  `Id` varchar(5) NOT NULL,
  `Nama` varchar(40) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pokja`
--

INSERT INTO `pokja` (`Id`, `Nama`) VALUES
('PO1', 'Dini Kun Zuraida, S.Pd'),
('PO2', 'Cholera'),
('PO3', 'Toror Seler'),
('PO4', 'Drs. Darsono'),
('PO5', 'Antob');

-- --------------------------------------------------------

--
-- Table structure for table `tblabsensiswa`
--

CREATE TABLE IF NOT EXISTS `tblabsensiswa` (
  `Id` int(6) NOT NULL AUTO_INCREMENT,
  `Nis` int(6) DEFAULT NULL,
  `NmSiswa` varchar(50) DEFAULT NULL,
  `TglAbsen` varchar(10) DEFAULT NULL,
  `Absensi` varchar(16) DEFAULT NULL,
  `absent` varchar(6) NOT NULL DEFAULT 'Absent',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tblabsensiswa`
--

INSERT INTO `tblabsensiswa` (`Id`, `Nis`, `NmSiswa`, `TglAbsen`, `Absensi`, `absent`) VALUES
(4, 11276, 'ALVIANA TRI AK', '2014-09-12', 'Izin', 'Absent');

-- --------------------------------------------------------

--
-- Table structure for table `tblforwardd`
--

CREATE TABLE IF NOT EXISTS `tblforwardd` (
  `IdF` int(11) NOT NULL AUTO_INCREMENT,
  `UserF` varchar(30) NOT NULL,
  `DudiF` varchar(30) NOT NULL,
  `TimestampF` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Verified` char(1) NOT NULL,
  `Confirmed` char(1) NOT NULL,
  `PembimbingS` varchar(90) NOT NULL,
  `PembimbingD` varchar(9) NOT NULL,
  PRIMARY KEY (`IdF`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tblforwardd`
--

INSERT INTO `tblforwardd` (`IdF`, `UserF`, `DudiF`, `TimestampF`, `Verified`, `Confirmed`, `PembimbingS`, `PembimbingD`) VALUES
(4, 'USR149', 'D2', '2014-09-12 22:32:56', 'T', 'T', '', 'PD3');

-- --------------------------------------------------------

--
-- Table structure for table `tbljurusan`
--

CREATE TABLE IF NOT EXISTS `tbljurusan` (
  `Id` int(3) NOT NULL AUTO_INCREMENT,
  `Jur` varchar(50) DEFAULT NULL,
  `Sngktn` varchar(10) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbljurusan`
--

INSERT INTO `tbljurusan` (`Id`, `Jur`, `Sngktn`) VALUES
(1, 'Akuntansi', 'AK'),
(2, 'Administrasi Perkantoran', 'AP'),
(3, 'Tata Busana', 'TB'),
(4, 'Tata Niaga', 'TN'),
(5, 'Rekayasa Perangkat Lunak', 'RPL'),
(6, 'Teknik Komputer & Jaringan', 'TKJ'),
(7, 'Agribisnis Perikanan', 'APi'),
(8, 'Mekatronika', 'MT'),
(9, 'Tata Rias', 'TR');

-- --------------------------------------------------------

--
-- Table structure for table `tblkepsek`
--

CREATE TABLE IF NOT EXISTS `tblkepsek` (
  `NIP` varchar(20) NOT NULL,
  `Nama` varchar(30) NOT NULL,
  PRIMARY KEY (`NIP`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblkepsek`
--

INSERT INTO `tblkepsek` (`NIP`, `Nama`) VALUES
('19650101837789', 'Drs. Azis Poerwanto');

-- --------------------------------------------------------

--
-- Table structure for table `tblmasterdudi`
--

CREATE TABLE IF NOT EXISTS `tblmasterdudi` (
  `Id` varchar(5) NOT NULL DEFAULT '',
  `NmDudi` varchar(50) DEFAULT NULL,
  `Alamat` varchar(103) DEFAULT NULL,
  `NoTelp` varchar(15) DEFAULT NULL,
  `NmPmpn` varchar(30) DEFAULT NULL,
  `magang` int(4) NOT NULL,
  `dayatampung` int(9) NOT NULL,
  `tipe` varchar(255) NOT NULL,
  `KdOwner` varchar(9) NOT NULL,
  `FotoD` varchar(255) NOT NULL DEFAULT 'nodudi.jpg',
  `PathD` varchar(255) NOT NULL DEFAULT 'img/foto/nodudi.jpg',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblmasterdudi`
--

INSERT INTO `tblmasterdudi` (`Id`, `NmDudi`, `Alamat`, `NoTelp`, `NmPmpn`, `magang`, `dayatampung`, `tipe`, `KdOwner`, `FotoD`, `PathD`) VALUES
('D2', 'PT. Anugrah Kharisma Jaya', 'Sunrise Garden Complex No. 8-C,Jl. Surya Mandala I,Jakarta Barat Indonesia', '85881892', 'Tommy .K', 1, 20, '2', 'USR40', 'nodudi.jpg', 'img/foto/nodudi.jpg'),
('D3', 'PT. Anugrah Parmindo Lestari', 'Jalan HR Rasuna Said Kav 62 Setiabudi Atrium Lt 4,Karet,Setia Budi Jakarta Selatan', '215881892', 'Samsuardi', 0, 20, '2,3,4,5,6', 'USR18', 'nodudi.jpg', 'img/foto/nodudi.jpg'),
('D4', 'PT. Anzen Pakarindo', 'Jl Mega Kuningan Tmr Lot 8-9/9,Kuningan Timur,Setia Budi Jakarta Selatan', '215881894', 'Edi Zulkarnaen', 0, 23, '1,2,3,4,5,6', 'USR41', 'nodudi.jpg', 'img/foto/nodudi.jpg'),
('D5', 'PT. AON Indonesia', 'Jl Boulevard Artha Gading Rukan Artha Gading Niaga Bl C/29,Kelapa Gading Jakarta Utara Indonesia', '215881895', 'Rizaldy', 0, 19, '2', 'USR42', 'nodudi.jpg', 'img/foto/nodudi.jpg'),
('D6', 'PT. Antam Tbk', 'Jl Bendungan Hilir Raya 60 Gunanusa Bldg,Bendungan Hilir,Tanah Abang Jakarta', '215881896', 'Rendra Bell', 0, 6, '3', 'USR45', 'nodudi.jpg', 'img/foto/nodudi.jpg'),
('D7', 'PT. Bangun Tjipta Pratama', 'Jl Jatinegara Tmr I 4,Rawa Bunga,Jatinegara Jakarta Timur Indonesia', '215881897', 'Imam Wibowo, S.E.', 0, 18, '4', 'USR46', 'nodudi.jpg', 'img/foto/nodudi.jpg'),
('D8', 'PT. Badja Abadi Sentosa', 'Jalan Gondangdia Kecil 12-14 Ged Dana Graha Lt 3,Gondangdia,Menteng Jakarta', '215881898', 'Lasmi Nafisa', 0, 9, '1,5', 'USR33', 'C360_2014-05-21-09-13-51.jpg', 'img/foto/C360_2014-05-21-09-13-51.jpg'),
('D9', 'PT. Bakrie & Brothers Tbk', 'Jl RS Fatmawati 20 Rukan Fatmawati Mas Bl III/319,Cipete Utara,Kebayoran Baru Jakarta Selatan Indonesia', '215881899', 'Bakrie Dany, S.E.', 0, 6, '6', 'USR47', 'nodudi.jpg', 'img/foto/nodudi.jpg'),
('D11', 'PT. Bahtera Sejahtera Makmur', 'Jl Pantai Indah Utr II Pantai Indah Kapuk Bl L/8-G,Kapuk Muara,Penjaringan Jakarta Utara Indonesia', '215881900', 'Dyan Florist', 0, 3, '6', 'USR49', 'nodudi.jpg', 'img/foto/nodudi.jpg'),
('D1', 'Indokom', 'Jl. Overste Isdiman No 31, Purwokerto', '82652787190', 'Willy Brodus', 4, 4, '4,5,6,7', 'USR14', '22102013.jpg', 'img/foto/22102013.jpg'),
('D12', 'PT. Mitra Solution', 'Wangon, Banjarnegara', '87627378', 'Saeful', 0, 6, '5,6,8', 'USR107', 'nodudi.jpg', 'img/foto/nodudi.jpg'),
('D10', 'ICT SMK Negeri 1 Bawang', 'Banjarnegara', '82652787192', 'Eko Eicho', 3, 3, '2,4,5,6', 'USR19', 'nodudi.jpg', 'img/foto/nodudi.jpg'),
('D13', 'PT. MENCARI CINTA SEJATI', 'Dimana mana', '9829983890', 'Adrian', 0, 20, '1', 'USR118', 'nodudi.jpg', 'img/foto/nodudi.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tblmastermahasiswa`
--

CREATE TABLE IF NOT EXISTS `tblmastermahasiswa` (
  `NIS` int(5) NOT NULL DEFAULT '0',
  `NmSiswa` varchar(50) DEFAULT NULL,
  `TglLhr` varchar(10) DEFAULT NULL,
  `TmptLhr` varchar(30) DEFAULT NULL,
  `Almt` varchar(255) DEFAULT NULL,
  `Email` varchar(50) NOT NULL,
  `NoTelp` bigint(11) DEFAULT NULL,
  `Kls` varchar(9) DEFAULT NULL,
  `Jur` varchar(24) DEFAULT NULL,
  PRIMARY KEY (`NIS`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblmastermahasiswa`
--

INSERT INTO `tblmastermahasiswa` (`NIS`, `NmSiswa`, `TglLhr`, `TmptLhr`, `Almt`, `Email`, `NoTelp`, `Kls`, `Jur`) VALUES
(11267, 'GUSNA HAPSARI N', '1996-12-30', 'Banjarnegara', 'Banjarnegara', 'gusnahapsarin@gmailcom', 85547987333, 'XI TKJ 3', '8'),
(11268, 'LHAEWY FELLYNDA', '1996-11-21', 'Banjarnegara', 'Banjarnegara', 'lhaewyfellynda@gmailcom', 8594154460, 'XI TN 2', '7'),
(11269, 'DHINNASTY ADHE P.', '1994-12-20', 'Banjarnegara', 'Banjarnegara', 'dhinnastyadhep@gmailcom', 85598392311, 'XI TKJ 3', '8'),
(11270, 'SEPTIAN ANDRI N.', '1998-10-20', 'Banjarnegara', 'Banjarnegara', 'septianandrin@gmailcom', 85142213415, 'XI TKJ 1', '1'),
(11271, 'REDI HANA SOFA', '1998-10-19', 'Banjarnegara', 'Banjarnegara', 'redihanasofa@gmailcom', 85498105372, 'XI AP 2', '7'),
(11272, 'ANA SUMARTI PRATAMA', '1995-12-10', 'Banjarnegara', 'Banjarnegara', 'anasumartipratama@gmailcom', 8518570327, 'XI TKJ 3', '7'),
(11273, 'RAKA ADI N.', '1995-12-21', 'Banjarnegara', 'Banjarnegara', 'rakaadin@gmailcom', 85509772354, 'XI TKJ 3', '7'),
(11274, 'SEPTIN NOOR J.', '1997-11-27', 'Banjarnegara', 'Banjarnegara', 'septinnoorj@gmailcom', 85870804765, 'XI TB 2', '2'),
(11275, 'HANDY WIRANATA', '1995-11-15', 'Banjarnegara', 'Banjarnegara', 'handywiranata@gmailcom', 85972811993, 'XI TR 1', '4'),
(11276, 'ALVIANA TRI AK', '1994-10-19', 'Banjarnegara', 'Banjarnegara', 'alvianatriak@gmailcom', 85127285594, 'XI TKJ 2', '1'),
(11277, 'TRI SUMARAHWATI', '1996-11-27', 'Banjarnegara', 'Banjarnegara', 'trisumarahwati@gmailcom', 85794615144, 'XI TR 1', '5'),
(11278, 'AMEKA SYIFA SAFIRA', '1997-11-22', 'Banjarnegara', 'Banjarnegara', 'amekasyifasafira@gmailcom', 85348849812, 'XI TB 2', '7'),
(11279, 'ANGGRAENI NOVITASARI', '1998-11-26', 'Banjarnegara', 'Banjarnegara', 'anggraeninovitasari@gmailcom', 8525470613, 'XI TKJ 2', '6'),
(11280, 'ATRIAT GUSTANTI', '1997-11-21', 'Banjarnegara', 'Banjarnegara', 'atriatgustanti@gmailcom', 85592603611, 'XI AK 1', '1'),
(11281, 'NUR MALITASARI', '1998-19-12', 'Banjarnegara', 'Banjarnegara', 'nurmalitasari@gmailcom', 85373886614, 'XI AK 1', '1'),
(11282, 'YOSIKA RISKIANA', '1996-11-27', 'Banjarnegara', 'Banjarnegara', 'yosikariskiana@gmailcom', 8523440425, 'XI TR 1', '9'),
(11283, 'VEGA IMAS PRIMANANDA', '1995-10-16', 'Banjarnegara', 'Banjarnegara', 'vegaimasprimananda@gmailcom', 85465851802, 'XI AP 2', '4'),
(11284, 'NOVIA TRI HANDAYANI', '1998-10-24', 'Banjarnegara', 'Banjarnegara', 'noviatrihandayani@gmailcom', 85692245674, 'XI MT 1', '3'),
(11285, 'DENA NATALIA WURY', '1994-12-27', 'Banjarnegara', 'Banjarnegara', 'denanataliawury@gmailcom', 85180596835, 'XI TR 2', '2'),
(11286, 'RISA YULIAWAN', '1997-10-24', 'Banjarnegara', 'Banjarnegara', 'risayuliawan@gmailcom', 85461406255, 'XI RPL 3', '7'),
(11287, 'DIANA RETFININGSIH', '1998-10-15', 'Banjarnegara', 'Banjarnegara', 'dianaretfiningsih@gmailcom', 85447944981, 'XI TKJ 3', '8'),
(11288, 'YOLANDA ARUM P', '1997-10-14', 'Banjarnegara', 'Banjarnegara', 'yolandaarump@gmailcom', 85404420316, 'XI TR 2', '2'),
(11289, 'GUNAWAN WIBISONO', '1995-10-18', 'Banjarnegara', 'Banjarnegara', 'gunawanwibisono@gmailcom', 85368458823, 'XI Api 1', '1'),
(11290, 'MERLIN MARSELINA', '1997-10-23', 'Banjarnegara', 'Banjarnegara', 'merlinmarselina@gmailcom', 8553911947, 'XI TKJ 3', '1'),
(11291, 'RIZKI NURFARIDA', '1998-12-12', 'Banjarnegara', 'Banjarnegara', 'rizkinurfarida@gmailcom', 85235103140, 'XI TKJ 1', '1'),
(11292, 'AZMIA LUSIANOSA R.', '1994-10-25', 'Banjarnegara', 'Banjarnegara', 'azmialusianosar@gmailcom', 85301151948, 'XI Api 3', '1'),
(11293, 'ESTIANA', '1998-10-23', 'Banjarnegara', 'Banjarnegara', 'estiana@gmailcom', 85806785931, 'XI MT 1', '7'),
(11294, 'NIKMAT SETIAWAN', '1994-11-12', 'Banjarnegara', 'Banjarnegara', 'nikmatsetiawan@gmailcom', 85442901992, 'XI MT 3', '9'),
(11295, 'MIANA WIHNINGSIH', '1994-11-13', 'Banjarnegara', 'Banjarnegara', 'mianawihningsih@gmailcom', 85913632584, 'XI AP 2', '7'),
(11296, 'OKI PRISILIA', '1997-11-15', 'Banjarnegara', 'Banjarnegara', 'okiprisilia@gmailcom', 85494455886, 'XI TB 2', '3'),
(11297, 'DAVID RAKA FAJRI', '1996-11-12', 'Banjarnegara', 'Banjarnegara', 'davidrakafajri@gmailcom', 8571128865, 'XI AP 2', '3'),
(11298, 'KRIS PUJI LESTARI', '1994-12-29', 'Banjarnegara', 'Banjarnegara', 'krispujilestari@gmailcom', 85959592453, 'XI TKJ 2', '4'),
(11299, 'ENA YULIANA', '1996-10-15', 'Banjarnegara', 'Banjarnegara', 'enayuliana@gmailcom', 85676143599, 'XI TB 3', '5'),
(11300, 'NELY FRESTIATIN', '1994-11-20', 'Banjarnegara', 'Banjarnegara', 'nelyfrestiatin@gmailcom', 85384577105, 'XI AP 1', '1'),
(11301, 'NUR FATIMAH', '1998-12-13', 'Banjarnegara', 'Banjarnegara', 'nurfatimah@gmailcom', 85108984511, 'XI AK 3', '8'),
(11302, 'ANDRIANY', '1995-12-18', 'Banjarnegara', 'Banjarnegara', 'andriany@gmailcom', 85454628530, 'XI Api 2', '7'),
(11303, 'AISYAH SAFITRI A.', '1997-11-30', 'Banjarnegara', 'Banjarnegara', 'aisyahsafitria@gmailcom', 85320106815, 'XI TKJ 2', '9'),
(11304, 'CHOTIJAH AJENG TRIYANI', '1995-10-23', 'Banjarnegara', 'Banjarnegara', 'chotijahajengtriyani@gmailcom', 85439108411, 'XI AK 3', '8'),
(11305, 'AGUNG PAMUJI', '1995-10-25', 'Banjarnegara', 'Banjarnegara', 'agungpamuji@gmailcom', 85474907506, 'XI RPL 3', '4'),
(11306, 'NANDA NURRIZKA Y.', '1998-11-12', 'Banjarnegara', 'Banjarnegara', 'nandanurrizkay@gmailcom', 8566528110, 'XI AP 2', '7'),
(11307, 'KHANIS NURHIDAYAH', '1994-11-14', 'Banjarnegara', 'Banjarnegara', 'khanisnurhidayah@gmailcom', 8554257259, 'XI AP 1', '2'),
(11308, 'MELY ANNISA PUTRI', '1995-12-30', 'Banjarnegara', 'Banjarnegara', 'melyannisaputri@gmailcom', 85113366468, 'XI TKJ 2', '9'),
(11309, 'DEVI YOGA ERISA', '1996-10-28', 'Banjarnegara', 'Banjarnegara', 'deviyogaerisa@gmailcom', 85823100590, 'XI Api 2', '1'),
(11310, 'BINTANG SABDA E.', '1995-11-19', 'Banjarnegara', 'Banjarnegara', 'bintangsabdae@gmailcom', 85615157389, 'XI TN 2', '2'),
(11311, 'ADITYA SURYA S.', '1995-12-26', 'Banjarnegara', 'Banjarnegara', 'adityasuryas@gmailcom', 85749373413, 'XI AP 2', '9'),
(11312, 'YOLA RESTU AP', '1998-10-24', 'Banjarnegara', 'Banjarnegara', 'yolarestuap@gmailcom', 85654934630, 'XI TR 3', '1'),
(11313, 'NENA ASTRIANI', '1994-12-23', 'Banjarnegara', 'Banjarnegara', 'nenaastriani@gmailcom', 8586387727, 'XI TKJ 3', '8'),
(11314, 'BRILIAN TINA FAJRIN', '1996-10-23', 'Banjarnegara', 'Banjarnegara', 'briliantinafajrin@gmailcom', 8557976569, 'XI AP 2', '2'),
(11315, 'ZULFA AMALIA NOOR FAUZAH', '1998-11-17', 'Banjarnegara', 'Banjarnegara', 'zulfaamalianoorfauzah@gmailcom', 85467324977, 'XI RPL 2', '4'),
(11316, 'ASHA YANUAR PA', '1995-10-19', 'Banjarnegara', 'Banjarnegara', 'ashayanuarpa@gmailcom', 85608885771, 'XI RPL 2', '6'),
(11317, 'FIKRI ALIMMUNTAMAN', '1996-10-21', 'Banjarnegara', 'Banjarnegara', 'fikrialimmuntaman@gmailcom', 85689986676, 'XI RPL 1', '7'),
(11318, 'ANTENG PANCA ROSYANI', '1994-11-20', 'Banjarnegara', 'Banjarnegara', 'antengpancarosyani@gmailcom', 8573975955, 'XI RPL 3', '7'),
(11319, 'MUH MIFTAHUL HUDA', '1995-12-22', 'Banjarnegara', 'Banjarnegara', 'muhmiftahulhuda@gmailcom', 85933701775, 'XI AP 3', '8'),
(11320, 'INDRI KUSUMANINGSIH', '1994-10-25', 'Banjarnegara', 'Banjarnegara', 'indrikusumaningsih@gmailcom', 8519978412, 'XI AK 1', '3'),
(11321, 'NANING DESTANTI', '1996-12-14', 'Banjarnegara', 'Banjarnegara', 'naningdestanti@gmailcom', 85272673852, 'XI TR 1', '9'),
(11322, 'AFRIAN ZAKKA SUKMAWAN', '1994-12-21', 'Banjarnegara', 'Banjarnegara', 'afrianzakkasukmawan@gmailcom', 85121825817, 'XI MT 1', '8'),
(11323, 'SYARAFINA FIRDAUS', '1996-12-24', 'Banjarnegara', 'Banjarnegara', 'syarafinafirdaus@gmailcom', 85960870259, 'XI TN 3', '8'),
(11324, 'SAMSUL ARIFIN', '1994-10-10', 'Banjarnegara', 'Banjarnegara', 'samsularifin@gmailcom', 85116889243, 'XI AK 1', '9'),
(11325, 'FITA MUSLIMAH', '1997-10-19', 'Banjarnegara', 'Banjarnegara', 'fitamuslimah@gmailcom', 85364559330, 'XI AK 2', '1'),
(11326, 'ATIKA WIDIANTI', '1998-12-27', 'Banjarnegara', 'Banjarnegara', 'atikawidianti@gmailcom', 85824478229, 'XI TKJ 2', '6'),
(11327, 'MUHAMMAD NUR A.', '1996-10-21', 'Banjarnegara', 'Banjarnegara', 'muhammadnura@gmailcom', 85162257701, 'XI MT 1', '1'),
(11328, 'APRILIA EKAWATI', '1995-12-15', 'Banjarnegara', 'Banjarnegara', 'apriliaekawati@gmailcom', 85301829815, 'XI Api 2', '4'),
(11329, 'TEGUH SANTOSO', '1994-10-30', 'Banjarnegara', 'Banjarnegara', 'teguhsantoso@gmailcom', 85776234276, 'XI RPL 2', '2'),
(11330, 'ISTI SOLIHATUN', '1998-10-22', 'Banjarnegara', 'Banjarnegara', 'istisolihatun@gmailcom', 85735469560, 'XI TN 3', '8'),
(11331, 'NUR OKTAVIANA', '1997-10-28', 'Banjarnegara', 'Banjarnegara', 'nuroktaviana@gmailcom', 85837141674, 'XI RPL 1', '7'),
(11332, 'KIKI NURUL F', '1998-12-26', 'Banjarnegara', 'Banjarnegara', 'kikinurulf@gmailcom', 8584336185, 'XI TKJ 2', '8'),
(11333, 'AZKA AMALINA', '1994-10-25', 'Banjarnegara', 'Banjarnegara', 'azkaamalina@gmailcom', 85818922407, 'XI TB 2', '5'),
(11334, 'REZZA ANGGA JS', '1995-10-15', 'Banjarnegara', 'Banjarnegara', 'rezzaanggajs@gmailcom', 85984373177, 'XI TKJ 2', '8'),
(11335, 'ANA FATMAWATI', '1994-11-17', 'Banjarnegara', 'Banjarnegara', 'anafatmawati@gmailcom', 85501619949, 'XI AP 1', '1'),
(11336, 'HALFA NIDAULHUSNA', '1995-11-28', 'Banjarnegara', 'Banjarnegara', 'halfanidaulhusna@gmailcom', 85251669882, 'XI AP 3', '4'),
(11337, 'TRI STYOWATI', '1998-11-23', 'Banjarnegara', 'Banjarnegara', 'tristyowati@gmailcom', 8560613863, 'XI MT 2', '2'),
(11338, 'ANGGIT PRIAGUNG', '1996-11-15', 'Banjarnegara', 'Banjarnegara', 'anggitpriagung@gmailcom', 85928423759, 'XI TB 3', '6'),
(11339, 'EKO BAYU M.', '1995-12-22', 'Banjarnegara', 'Banjarnegara', 'ekobayum@gmailcom', 85514214668, 'XI TKJ 1', '9'),
(11340, 'SULISTIA RINI', '1997-10-20', 'Banjarnegara', 'Banjarnegara', 'sulistiarini@gmailcom', 85373611690, 'XI TKJ 3', '2'),
(11341, 'OKI HARI SAPUTRA', '1995-11-26', 'Banjarnegara', 'Banjarnegara', 'okiharisaputra@gmailcom', 85520309845, 'XI Api 2', '8');

-- --------------------------------------------------------

--
-- Table structure for table `tblmasterpembimbing`
--

CREATE TABLE IF NOT EXISTS `tblmasterpembimbing` (
  `NIP` int(20) NOT NULL DEFAULT '0',
  `NmPmbgI` varchar(23) DEFAULT NULL,
  `Almt` text,
  `NoTelp` bigint(11) DEFAULT NULL,
  PRIMARY KEY (`NIP`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblmasterpembimbing`
--

INSERT INTO `tblmasterpembimbing` (`NIP`, `NmPmbgI`, `Almt`, `NoTelp`) VALUES
(1000032342, 'Eko Nurunianto S. S.T.', 'Banjarmangu, Banjarnegara', 81231829931),
(1038137, 'Maryantoe S.Pd', 'Banjarnegara, Jawa Tengah', 89483384841);

-- --------------------------------------------------------

--
-- Table structure for table `tblmasterpembimbingdudi`
--

CREATE TABLE IF NOT EXISTS `tblmasterpembimbingdudi` (
  `Id` varchar(6) NOT NULL DEFAULT '',
  `IdDudi` varchar(4) DEFAULT NULL,
  `NmPmbg` varchar(30) DEFAULT NULL,
  `NoTelp` bigint(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblmasterpembimbingdudi`
--

INSERT INTO `tblmasterpembimbingdudi` (`Id`, `IdDudi`, `NmPmbg`, `NoTelp`) VALUES
('PD6', 'D4', 'Tarno', 876678876),
('PD2', 'D10', 'Reagan Ronald', 81231123921),
('PD3', 'D2', 'Martin', 85673666111),
('PD4', 'D8', 'Sutoyo S.Kom.', 854432222111),
('PD7', 'D8', 'Seno Raharjo,', 85231123333),
('PD8', 'D12', 'Miskun', 87890098891),
('PD9', 'D9', 'Ar', 8789898989),
('PD11', 'D13', 'Arie', 87789878898),
('PD10', 'D3', 'Turno', 876678876),
('PD12', 'D5', 'Tedo', 83373373373),
('PD13', 'D6', 'Ana', 873373373),
('PD14', 'D7', 'Panji', 876678876),
('PD15', 'D11', 'batera', 872272272272);

-- --------------------------------------------------------

--
-- Table structure for table `tblnilai`
--

CREATE TABLE IF NOT EXISTS `tblnilai` (
  `Id` varchar(5) NOT NULL DEFAULT '',
  `Nis` int(6) DEFAULT NULL,
  `NmSiswa` varchar(50) DEFAULT NULL,
  `NilaiA` decimal(3,2) NOT NULL,
  `NilaiB` decimal(3,2) NOT NULL,
  `NilaiC` decimal(3,2) NOT NULL,
  `NilaiD` decimal(3,2) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblnilai`
--

INSERT INTO `tblnilai` (`Id`, `Nis`, `NmSiswa`, `NilaiA`, `NilaiB`, `NilaiC`, `NilaiD`) VALUES
('NIL1', 11267, 'GUSNA HAPSARI N', 9.00, 8.80, 9.80, 9.25),
('NIL2', 11268, 'LHAEWY FELLYNDA', 9.25, 8.60, 8.80, 8.50),
('NIL3', 11269, 'DHINNASTY ADHE P.', 9.25, 8.80, 8.40, 8.75),
('NIL4', 11270, 'SEPTIAN ANDRI N.', 9.00, 8.40, 8.40, 9.50),
('NIL5', 11271, 'REDI HANA SOFA', 8.25, 8.40, 9.20, 9.00),
('NIL6', 11272, 'ANA SUMARTI PRATAMA', 9.25, 7.20, 8.40, 7.25),
('NIL7', 11273, 'RAKA ADI N.', 9.25, 8.20, 7.40, 9.50),
('NIL8', 11274, 'SEPTIN NOOR J.', 7.25, 8.60, 8.80, 8.75),
('NIL9', 11275, 'HANDY WIRANATA', 8.50, 7.40, 8.40, 9.25),
('NIL10', 11276, 'ALVIANA TRI AK', 7.00, 9.40, 7.80, 8.50),
('NIL11', 11277, 'TRI SUMARAHWATI', 7.25, 6.60, 7.60, 8.75),
('NIL12', 11278, 'AMEKA SYIFA SAFIRA', 7.25, 8.00, 8.60, 8.75),
('NIL13', 11279, 'ANGGRAENI NOVITASARI', 7.75, 7.60, 8.20, 8.75),
('NIL14', 11280, 'ATRIAT GUSTANTI', 7.50, 7.40, 8.60, 8.75),
('NIL15', 11281, 'NUR MALITASARI', 7.00, 8.80, 8.60, 7.75),
('NIL16', 11282, 'YOSIKA RISKIANA', 7.75, 9.00, 8.40, 8.25),
('NIL17', 11283, 'VEGA IMAS PRIMANANDA', 8.50, 5.80, 8.20, 8.25),
('NIL18', 11284, 'NOVIA TRI HANDAYANI', 8.25, 7.40, 7.40, 8.75),
('NIL19', 11285, 'DENA NATALIA WURY', 7.75, 7.60, 8.80, 7.75),
('NIL20', 11286, 'RISA YULIAWAN', 8.75, 7.00, 8.60, 7.25),
('NIL21', 11287, 'DIANA RETFININGSIH', 7.00, 8.00, 8.80, 7.50),
('NIL22', 11288, 'YOLANDA ARUM P', 8.50, 6.40, 8.80, 7.50),
('NIL23', 11289, 'GUNAWAN WIBISONO', 7.25, 7.60, 8.00, 8.75),
('NIL24', 11290, 'MERLIN MARSELINA', 7.25, 7.40, 7.80, 8.25),
('NIL25', 11291, 'RIZKI NURFARIDA', 7.00, 7.60, 8.00, 7.50),
('NIL26', 11292, 'AZMIA LUSIANOSA R.', 7.75, 6.80, 8.20, 8.25),
('NIL27', 11293, 'ESTIANA', 7.25, 6.20, 8.60, 8.75),
('NIL28', 11294, 'NIKMAT SETIAWAN', 7.75, 6.60, 8.00, 8.25),
('NIL29', 11295, 'MIANA WIHNINGSIH', 7.75, 8.20, 7.60, 7.25),
('NIL30', 11296, 'OKI PRISILIA', 7.75, 8.20, 7.80, 7.25),
('NIL31', 11297, 'DAVID RAKA FAJRI', 6.75, 6.20, 8.40, 8.75),
('NIL32', 11298, 'KRIS PUJI LESTARI', 6.25, 6.00, 8.20, 6.75),
('NIL33', 11299, 'ENA YULIANA', 7.75, 7.60, 8.00, 6.50),
('NIL34', 11300, 'NELY FRESTIATIN', 5.25, 6.80, 9.00, 8.75),
('NIL35', 11301, 'NUR FATIMAH', 7.50, 6.80, 8.00, 7.75),
('NIL36', 11302, 'ANDRIANY', 7.50, 6.80, 8.20, 7.25),
('NIL37', 11303, 'AISYAH SAFITRI A.', 7.00, 7.60, 8.20, 7.25),
('NIL38', 11304, 'CHOTIJAH AJENG TRIYANI', 7.25, 5.40, 7.60, 9.50),
('NIL39', 11305, 'AGUNG PAMUJI', 7.25, 7.00, 7.60, 7.75),
('NIL40', 11306, 'NANDA NURRIZKA Y.', 6.50, 8.40, 7.60, 7.00),
('NIL41', 11307, 'KHANIS NURHIDAYAH', 6.75, 6.80, 8.00, 8.00),
('NIL42', 11308, 'MELY ANNISA PUTRI', 5.75, 8.00, 7.60, 8.50),
('NIL43', 11309, 'DEVI YOGA ERISA', 7.25, 6.80, 7.60, 7.50),
('NIL44', 11310, 'BINTANG SABDA E.', 6.75, 6.80, 7.80, 8.00),
('NIL45', 11311, 'ADITYA SURYA S.', 6.75, 6.20, 8.00, 8.50),
('NIL46', 11312, 'YOLA RESTU AP', 6.00, 6.40, 8.20, 8.50),
('NIL47', 11313, 'NENA ASTRIANI', 6.25, 7.40, 8.40, 7.00),
('NIL48', 11314, 'BRILIAN TINA FAJRIN', 6.00, 7.60, 7.60, 7.75),
('NIL49', 11315, 'ZULFA AMALIA NOOR FAUZAH', 6.75, 5.40, 8.60, 8.00),
('NIL50', 11316, 'ASHA YANUAR PA', 6.50, 6.80, 7.80, 8.75),
('NIL51', 11317, 'FIKRI ALIMMUNTAMAN', 8.00, 6.80, 7.20, 7.75),
('NIL52', 11318, 'ANTENG PANCA ROSYANI', 7.25, 8.40, 6.40, 7.50),
('NIL53', 11319, 'MUH MIFTAHUL HUDA', 7.50, 6.20, 8.00, 7.75),
('NIL54', 11320, 'INDRI KUSUMANINGSIH', 8.25, 6.80, 7.80, 6.00),
('NIL55', 11321, 'NANING DESTANTI', 7.25, 7.40, 7.40, 7.25),
('NIL56', 11322, 'AFRIAN ZAKKA SUKMAWAN', 6.00, 6.80, 7.60, 8.25),
('NIL57', 11323, 'SYARAFINA FIRDAUS', 6.50, 7.20, 8.00, 7.50),
('NIL58', 11324, 'SAMSUL ARIFIN', 7.50, 6.20, 8.80, 8.00),
('NIL59', 11325, 'FITA MUSLIMAH', 5.50, 7.60, 8.40, 7.50),
('NIL60', 11326, 'ATIKA WIDIANTI', 5.75, 5.60, 8.80, 8.75),
('NIL61', 11327, 'MUHAMMAD NUR A.', 7.75, 6.60, 6.40, 8.75),
('NIL62', 11328, 'APRILIA EKAWATI', 7.25, 6.00, 7.40, 8.75),
('NIL63', 11329, 'TEGUH SANTOSO', 6.25, 6.00, 7.60, 9.50),
('NIL64', 11330, 'ISTI SOLIHATUN', 7.00, 5.80, 8.40, 7.75),
('NIL65', 11331, 'NUR OKTAVIANA', 6.25, 6.40, 8.20, 8.75),
('NIL66', 11332, 'KIKI NURUL F', 6.25, 6.00, 8.20, 7.75),
('NIL67', 11333, 'AZKA AMALINA', 7.00, 5.80, 8.00, 7.50),
('NIL68', 11334, 'REZZA ANGGA JS', 6.25, 6.60, 7.80, 8.00),
('NIL69', 11335, 'ANA FATMAWATI', 7.00, 5.80, 8.00, 6.75),
('NIL70', 11336, 'HALFA NIDAULHUSNA', 5.50, 7.00, 7.80, 7.50),
('NIL71', 11337, 'TRI STYOWATI', 6.75, 5.20, 8.20, 7.75),
('NIL72', 11338, 'ANGGIT PRIAGUNG', 5.00, 6.20, 8.40, 7.50),
('NIL73', 11339, 'EKO BAYU M.', 6.50, 4.60, 8.00, 8.25),
('NIL74', 11340, 'SULISTIA RINI', 3.50, 6.40, 6.60, 4.25),
('NIL75', 11341, 'OKI HARI SAPUTRA', 3.50, 4.40, 6.25, 5.75);

-- --------------------------------------------------------

--
-- Table structure for table `tblpermohonan`
--

CREATE TABLE IF NOT EXISTS `tblpermohonan` (
  `Id` int(9) NOT NULL AUTO_INCREMENT,
  `Nama` varchar(40) NOT NULL,
  `Dudi` varchar(40) NOT NULL,
  `Stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tblpermohonan`
--


-- --------------------------------------------------------

--
-- Table structure for table `tblpost`
--

CREATE TABLE IF NOT EXISTS `tblpost` (
  `Postid` int(11) NOT NULL AUTO_INCREMENT,
  `Post` text NOT NULL,
  `Sender` varchar(40) NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL,
  `Usrid` varchar(10) NOT NULL,
  PRIMARY KEY (`Postid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `tblpost`
--

INSERT INTO `tblpost` (`Postid`, `Post`, `Sender`, `Date`, `Time`, `Usrid`) VALUES
(1, 'Hai', 'alvians', '2014-09-10', '07:16:42', 'USR4'),
(2, 'Hai juga, selamat pagi', 'sam', '2014-09-10', '07:16:59', 'USR18'),
(3, 'Gimana kabar?', 'dhien', '2014-09-10', '07:17:18', 'USR3'),
(4, 'Alhamdulilah', 'dini', '2014-09-10', '07:17:31', 'USR98'),
(5, 'Sesuatu', 'seno', '2014-09-10', '07:17:50', 'USR112'),
(6, 'Saya telah lahir saudara', 'martin', '2014-09-10', '12:23:15', 'USR116'),
(7, 'Hai', 'dinik', '2014-09-10', '17:08:40', 'USR98'),
(8, 'hai', 'huda', '2014-09-11', '09:31:42', 'USR103'),
(9, '<div>', 'alvians', '2014-09-11', '17:03:06', 'USR4'),
(10, '<div>', 'alvians', '2014-09-11', '17:03:18', 'USR4'),
(11, '<img>', 'azis', '2014-09-11', '18:31:34', 'USR111'),
(12, 'aku mau jahil <div>pamerdulu</div>', 'riyan', '2014-09-11', '19:41:50', 'USR113'),
(13, 'tolong siapapun yan', 'azis', '2014-09-12', '09:41:18', 'USR111'),
(14, 'habis pulang jumatan, huft', 'eicho', '2014-09-12', '13:18:55', 'USR19'),
(15, 'Sy admin', 'admin', '2014-09-12', '23:49:10', 'USR99');

-- --------------------------------------------------------

--
-- Table structure for table `tblreason`
--

CREATE TABLE IF NOT EXISTS `tblreason` (
  `ReasId` int(9) NOT NULL AUTO_INCREMENT,
  `UserId` varchar(20) NOT NULL,
  `IdDudi` varchar(10) NOT NULL,
  `Reason` text NOT NULL,
  `Terima` tinyint(1) NOT NULL,
  `Penolak` tinyint(1) NOT NULL,
  PRIMARY KEY (`ReasId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tblreason`
--

INSERT INTO `tblreason` (`ReasId`, `UserId`, `IdDudi`, `Reason`, `Terima`, `Penolak`) VALUES
(5, 'USR124', 'D1', 'Sudah Penuh', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE IF NOT EXISTS `tbluser` (
  `Id` varchar(7) NOT NULL DEFAULT '',
  `Username` varchar(7) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL,
  `Level` varchar(14) DEFAULT NULL,
  `AktifUser` varchar(1) DEFAULT NULL,
  `KdUser` varchar(30) NOT NULL DEFAULT 'NULL',
  `Foto` varchar(255) NOT NULL DEFAULT 'noface.jpg',
  `Path` varchar(255) NOT NULL DEFAULT 'img/foto/noface.jpg',
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Username` (`Username`),
  UNIQUE KEY `Username_2` (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`Id`, `Username`, `Password`, `Level`, `AktifUser`, `KdUser`, `Foto`, `Path`) VALUES
('USR100', 'cholera', 'qlIwLEzb6X1rCiNVzbUQHw1hV0+W7NXUmw50vvI4gGA=', 'pokja', 'n', 'PO2', 'noface.jpg', 'img/foto/noface.jpg'),
('USR101', 'toror', 'iF0xVhMKgBN4Qy81WezmSs/PLtfGQQu93C2TCmGSRWA=', 'pokja', 'n', 'PO3', 'noface.jpg', 'img/foto/noface.jpg'),
('USR105', 'ekonur', 'IzbawLrBglz1ciJlFRyRvqKAIF8/FBG5COdBGySNMrA=', 'pembimbing', 'n', '1000032342', 'noface.jpg', 'img/foto/noface.jpg'),
('USR107', 'saeful', 'ILQSgG7Er19hP003kfnFmERgFYW4CFtGHPAY62z1nCs=', 'dudiowner', 'y', 'D12', 'noface.jpg', 'img/foto/noface.jpg'),
('USR108', 'darsono', 'RVarPzirEf3U9uIoHly+CuDuyzMlxVN0VyYEMw4gCnE=', 'pokja', 'n', 'PO4', 'noface.jpg', 'img/foto/noface.jpg'),
('USR109', 'maryant', 'GyBvKYaICJG6zkQzouXz7t0xjwaFrbR3NfHz+PL6ACQ=', 'pembimbing', 'n', '1038137', 'noface.jpg', 'img/foto/noface.jpg'),
('USR110', 'tarno', 'nSYdUGpQzC/9UoD4eQ5AKM8Gn46FRg956USTt2cV5s0=', 'pembimbingdudi', 'n', 'PD6', 'noface.jpg', 'img/foto/noface.jpg'),
('USR111', 'azis', 'MOyUtoWdwOaNc/FJyoT1takCf3WYkIS76ET57CWA+uY=', 'kepsek', 'n', '19650101837789', 'noface.jpg', 'img/foto/noface.jpg'),
('USR112', 'seno', 'ACj4uNuZaFJmXJ6nP3qk3xTihHv6ll9mPCzDI3Y+khg=', 'pembimbingdudi', 'n', 'PD7', 'noface.jpg', 'img/foto/noface.jpg'),
('USR114', 'miskun', 'WFt5ilWw3i4xi7Xg7oZO1+BZy+e5jtnE2YDTCrPgFq0=', 'pembimbingdudi', 'n', 'PD8', 'noface.jpg', 'img/foto/noface.jpg'),
('USR116', 'martin', 'ZOfP9dAIzpzF5JCXdiveEDTGyq89d4gZpra6vMKDAdE=', 'pembimbingdudi', 'n', 'PD3', 'noface.jpg', 'img/foto/noface.jpg'),
('USR118', 'adrian', '8+qInqqFPgDvkCtH938Fh81awV3+ICBlKCP9Fq93SBI=', 'dudiowner', 'n', 'D13', 'noface.jpg', 'img/foto/noface.jpg'),
('USR119', 'antob', 'T1mas3MpQVCJWDif+NuOig+VJT+WAGj/SJLhGK0rpME=', 'pokja', 'n', 'PO5', 'noface.jpg', 'img/foto/noface.jpg'),
('USR123', 'wen', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'pembimbingdudi', 'n', 'PD9', 'noface.jpg', 'img/foto/noface.jpg'),
('USR125', 'turno', 'MFT2ylkj7VzyD+GSH5s17fsiKOWz3g+4FMbDb1qG0gs=', 'pembimbingdudi', 'n', 'PD10', 'noface.jpg', 'img/foto/noface.jpg'),
('USR131', 'gusna', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11267', 'noface.jpg', 'img/foto/noface.jpg'),
('USR132', 'lhaewy', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11268', 'noface.jpg', 'img/foto/noface.jpg'),
('USR133', 'dhinna', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11269', 'noface.jpg', 'img/foto/noface.jpg'),
('USR134', 'septia', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11270', 'noface.jpg', 'img/foto/noface.jpg'),
('USR135', 'redih', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11271', 'noface.jpg', 'img/foto/noface.jpg'),
('USR136', 'anasu', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11272', 'noface.jpg', 'img/foto/noface.jpg'),
('USR137', 'rakaa', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11273', 'noface.jpg', 'img/foto/noface.jpg'),
('USR138', 'septin', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11274', 'noface.jpg', 'img/foto/noface.jpg'),
('USR139', 'handy', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11275', 'noface.jpg', 'img/foto/noface.jpg'),
('USR14', 'willy', 'sdR06CT5SFNkFNxcBtZ2A9qQ1jc33aqSH3M1cAW2SPw=', 'dudiowner', 'n', 'D001', 'noface.jpg', 'img/foto/noface.jpg'),
('USR140', 'alvian', 'l6Z+WDUHeIsEHFKFOgj2sNxCHMTxT4KeUZC9vH3FhQo=', 'siswa', 'y', '11276', 'noface.jpg', 'img/foto/noface.jpg'),
('USR141', 'trisu', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11277', 'noface.jpg', 'img/foto/noface.jpg'),
('USR142', 'ameka', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11278', 'noface.jpg', 'img/foto/noface.jpg'),
('USR143', 'anggra', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11279', 'noface.jpg', 'img/foto/noface.jpg'),
('USR144', 'atriat', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11280', 'noface.jpg', 'img/foto/noface.jpg'),
('USR145', 'nurma', '5luo6wF3kCAkoJRPttR7iWxMPuQJcNC9g8demxGoykA=', 'siswa', 'n', '11281', 'noface.jpg', 'img/foto/noface.jpg'),
('USR146', 'yosika', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11282', 'noface.jpg', 'img/foto/noface.jpg'),
('USR147', 'vegai', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11283', 'noface.jpg', 'img/foto/noface.jpg'),
('USR148', 'novia', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11284', 'noface.jpg', 'img/foto/noface.jpg'),
('USR149', 'denan', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11285', 'noface.jpg', 'img/foto/noface.jpg'),
('USR150', 'risay', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11286', 'noface.jpg', 'img/foto/noface.jpg'),
('USR151', 'diana', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11287', 'noface.jpg', 'img/foto/noface.jpg'),
('USR152', 'yoland', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11288', 'noface.jpg', 'img/foto/noface.jpg'),
('USR153', 'gunawa', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11289', 'noface.jpg', 'img/foto/noface.jpg'),
('USR154', 'merlin', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11290', 'noface.jpg', 'img/foto/noface.jpg'),
('USR155', 'rizki', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11291', 'noface.jpg', 'img/foto/noface.jpg'),
('USR156', 'azmia', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11292', 'noface.jpg', 'img/foto/noface.jpg'),
('USR157', 'estian', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11293', 'noface.jpg', 'img/foto/noface.jpg'),
('USR158', 'nikmat', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11294', 'noface.jpg', 'img/foto/noface.jpg'),
('USR159', 'miana', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11295', 'noface.jpg', 'img/foto/noface.jpg'),
('USR160', 'okipr', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11296', 'noface.jpg', 'img/foto/noface.jpg'),
('USR161', 'david', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11297', 'noface.jpg', 'img/foto/noface.jpg'),
('USR162', 'krisp', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11298', 'noface.jpg', 'img/foto/noface.jpg'),
('USR163', 'enayu', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11299', 'noface.jpg', 'img/foto/noface.jpg'),
('USR164', 'nelyf', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11300', 'noface.jpg', 'img/foto/noface.jpg'),
('USR165', 'nurfa', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11301', 'noface.jpg', 'img/foto/noface.jpg'),
('USR166', 'andria', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11302', 'noface.jpg', 'img/foto/noface.jpg'),
('USR167', 'aisyah', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11303', 'noface.jpg', 'img/foto/noface.jpg'),
('USR168', 'chotij', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11304', 'noface.jpg', 'img/foto/noface.jpg'),
('USR169', 'agung', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11305', 'noface.jpg', 'img/foto/noface.jpg'),
('USR170', 'nanda', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11306', 'noface.jpg', 'img/foto/noface.jpg'),
('USR171', 'khanis', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11307', 'noface.jpg', 'img/foto/noface.jpg'),
('USR172', 'melya', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11308', 'noface.jpg', 'img/foto/noface.jpg'),
('USR173', 'deviy', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11309', 'noface.jpg', 'img/foto/noface.jpg'),
('USR174', 'bintan', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11310', 'noface.jpg', 'img/foto/noface.jpg'),
('USR175', 'aditya', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11311', 'noface.jpg', 'img/foto/noface.jpg'),
('USR176', 'yolar', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11312', 'noface.jpg', 'img/foto/noface.jpg'),
('USR177', 'nenaa', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11313', 'noface.jpg', 'img/foto/noface.jpg'),
('USR178', 'brilia', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11314', 'noface.jpg', 'img/foto/noface.jpg'),
('USR179', 'zulfa', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11315', 'noface.jpg', 'img/foto/noface.jpg'),
('USR18', 'sam', 'MYTJisin/T9RXv+UiHp+dCLHSiRh0wJtBQR9WDnkD6E=', 'dudiowner', 'n', 'D3', 'noface.jpg', 'img/foto/noface.jpg'),
('USR180', 'ashay', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11316', 'noface.jpg', 'img/foto/noface.jpg'),
('USR181', 'fikri', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11317', 'noface.jpg', 'img/foto/noface.jpg'),
('USR182', 'anteng', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11318', 'noface.jpg', 'img/foto/noface.jpg'),
('USR183', 'muhmi', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11319', 'noface.jpg', 'img/foto/noface.jpg'),
('USR184', 'indri', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11320', 'noface.jpg', 'img/foto/noface.jpg'),
('USR185', 'naning', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11321', 'noface.jpg', 'img/foto/noface.jpg'),
('USR186', 'afrian', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11322', 'noface.jpg', 'img/foto/noface.jpg'),
('USR187', 'syaraf', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11323', 'noface.jpg', 'img/foto/noface.jpg'),
('USR188', 'samsul', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11324', 'noface.jpg', 'img/foto/noface.jpg'),
('USR189', 'fitam', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11325', 'noface.jpg', 'img/foto/noface.jpg'),
('USR19', 'eicho', 'pGd/bo65C80T+ZTy2gEvXcmtmIxvEqKPPTPwALAxmGg=', 'dudiowner', 'n', 'D10', 'noface.jpg', 'img/foto/noface.jpg'),
('USR190', 'atika', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11326', 'noface.jpg', 'img/foto/noface.jpg'),
('USR191', 'muhamm', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11327', 'noface.jpg', 'img/foto/noface.jpg'),
('USR192', 'aprili', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11328', 'noface.jpg', 'img/foto/noface.jpg'),
('USR193', 'teguh', '4tm8lHN9DHfj+bZsNzqYZfv0vW0UyLDMaYoihFKUaWk=', 'siswa', 'n', '11329', 'noface.jpg', 'img/foto/noface.jpg'),
('USR194', 'istis', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11330', 'noface.jpg', 'img/foto/noface.jpg'),
('USR195', 'nurok', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11331', 'noface.jpg', 'img/foto/noface.jpg'),
('USR196', 'kikin', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11332', 'noface.jpg', 'img/foto/noface.jpg'),
('USR197', 'azkaa', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11333', 'noface.jpg', 'img/foto/noface.jpg'),
('USR198', 'rezza', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11334', 'noface.jpg', 'img/foto/noface.jpg'),
('USR199', 'anafa', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11335', 'noface.jpg', 'img/foto/noface.jpg'),
('USR200', 'halfa', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11336', 'noface.jpg', 'img/foto/noface.jpg'),
('USR201', 'trist', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11337', 'noface.jpg', 'img/foto/noface.jpg'),
('USR202', 'anggit', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11338', 'noface.jpg', 'img/foto/noface.jpg'),
('USR203', 'ekoba', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11339', 'noface.jpg', 'img/foto/noface.jpg'),
('USR204', 'sulist', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11340', 'noface.jpg', 'img/foto/noface.jpg'),
('USR205', 'okiha', 'q1bmHOAxq98k05e+4gFOpXIU7AGZQoZVNar28UtB01k=', 'siswa', 'n', '11341', 'noface.jpg', 'img/foto/noface.jpg'),
('USR206', 'ari', 'iLuZWDHBow7996cfCUe9lJ2K4yyLYM4dqgZg1Ki7qEU=', 'pembimbingdudi', 'n', 'PD11', 'noface.jpg', 'img/foto/noface.jpg'),
('USR207', 'tedo', '1QRCWTgLm4cKyMSE0D/Wfc9N1+R8/JA7UtrV3tCGqms=', 'pembimbingdudi', 'n', 'PD12', 'noface.jpg', 'img/foto/noface.jpg'),
('USR208', 'ana', 'D+vlWcMd1SwA6aQo5ffYrBG9rfFTLNmvR9/RzTvNYzQ=', 'pembimbingdudi', 'n', 'PD13', 'noface.jpg', 'img/foto/noface.jpg'),
('USR209', 'panji', 'AM3o7v/IRv9giiAmTw8AikSYbl/fZBI9wbpHR2aHb1w=', 'pembimbingdudi', 'n', 'PD14', 'noface.jpg', 'img/foto/noface.jpg'),
('USR210', 'batera', 'VDR9q394p5T43lGSl9g3tp8E7jP598fUzz32y8VVV3w=', 'pembimbingdudi', 'n', 'PD15', 'noface.jpg', 'img/foto/noface.jpg'),
('USR33', 'lasmi', 'avgZfe50ZFJ4lnkNpTd/PVjdKXt6TnIB/SVT0Q8E+98=', 'dudiowner', 'n', 'D8', 'noface.jpg', 'img/foto/noface.jpg'),
('USR40', 'tommy', 'NkzB2y56VW34aazT0N2phQ6DYy2+7PgDgQ67213yeDE=', 'dudiowner', 'n', 'D2', 'noface.jpg', 'img/foto/noface.jpg'),
('USR41', 'edi', 'C9cB88L0wPgc7kQnOHEkbyH8MIrfw/Ukyv0iGbZxqp0=', 'dudiowner', 'n', 'D4', 'noface.jpg', 'img/foto/noface.jpg'),
('USR42', 'rizaldy', '79Grqad8Mn/YEwtZcpsYNpDpls9IeqbdqgUizrV1zBs=', 'dudiowner', 'n', 'D5', 'noface.jpg', 'img/foto/noface.jpg'),
('USR45', 'rendra', '3Xr+RUZ/bsKMOqgTBRWvKzagqs5y7TZ5S7txc0c5gwo=', 'dudiowner', 'n', 'D6', 'noface.jpg', 'img/foto/noface.jpg'),
('USR46', 'imam', 'Z7zNR8NZzdHDUwf60YM0SNEzS6PWp4/qHNOwvgBL+RQ=', 'dudiowner', 'n', 'D7', 'noface.jpg', 'img/foto/noface.jpg'),
('USR47', 'bakrie', 'UwX0CXD//Cq9N2vct1xfRUP/egMjUyZxtJmoBAL87Gk=', 'dudiowner', 'n', 'D9', 'noface.jpg', 'img/foto/noface.jpg'),
('USR49', 'dyan', 'yyPX7qk13jbDwvQ1j6UyUWIG/Z0CzY7m3Ug1EExebkQ=', 'dudiowner', 'n', 'D11', 'noface.jpg', 'img/foto/noface.jpg'),
('USR92', 'reagan', 'ycev2/kIEc46zvN7f12QDYSTAtK1L7kygzW4KZ1vit8=', 'pembimbingdudi', 'n', 'PD2', 'noface.jpg', 'img/foto/noface.jpg'),
('USR98', 'dinik', '04/JTfitpAnfELf2dbKkXkwg59pKVuWfoqaUKDr2JLc=', 'pokja', 'n', 'PO1', 'noface.jpg', 'img/foto/noface.jpg'),
('USR99', 'admin', 'QrUgcNdRjaE74hfEIeThKa/RaqA9N/KpBI+X7VeiyfE=', 'admin', 'n', 'NULL', 'Jellyfish.jpg', 'img/foto/Jellyfish.jpg');
