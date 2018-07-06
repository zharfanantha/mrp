-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2018 at 02:59 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `malangraya`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `email`, `password`) VALUES
(1, 'zharfan', 'zharfan@gmail.com', 'zharfan'),
(4, 'afan', 'afan@gmail.com', 'afan');

-- --------------------------------------------------------

--
-- Table structure for table `batas_atribut`
--

CREATE TABLE `batas_atribut` (
  `id_batas` int(11) NOT NULL,
  `atribut` varchar(100) NOT NULL,
  `bawah` int(50) NOT NULL,
  `tengah` int(50) NOT NULL,
  `atas` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `batas_atribut`
--

INSERT INTO `batas_atribut` (`id_batas`, `atribut`, `bawah`, `tengah`, `atas`) VALUES
(1, 'Jarak', 19, 39, 58),
(2, 'Biaya', 27500, 55000, 82500),
(3, 'Bencana', 4, 8, 12);

-- --------------------------------------------------------

--
-- Table structure for table `data_objek`
--

CREATE TABLE `data_objek` (
  `id_objek` int(11) NOT NULL,
  `nama_objek` varchar(100) NOT NULL,
  `jarak` int(50) NOT NULL,
  `biaya` int(50) NOT NULL,
  `bencana` int(50) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `alamat` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_objek`
--

INSERT INTO `data_objek` (`id_objek`, `nama_objek`, `jarak`, `biaya`, `bencana`, `kategori`, `alamat`) VALUES
(1, 'Sumber Sirah', 24, 10000, 2, 'Pemandian', 'Jalan Sunan Gunung Jati, RT.05 / RW.02, Putukrejo, Gondanglegi, Putukrejo, Gondanglegi, Malang, Jawa Timur 65174'),
(2, 'Kalireco', 17, 10000, 3, 'Pemandian', 'Jl. Sumber Waras 2 No.97, Kalirejo, Lawang, Malang, Jawa Timur 65216'),
(3, 'Air Panas Cangar', 41, 15000, 12, 'Pemandian', 'Tulungrejo, Bumiaji, Sumber Brantas, Batu, Kota Batu, Jawa Timur 65336'),
(4, 'Sumber Air Krabyakan', 20, 10000, 3, 'Pemandian', 'Desa Sumber Ngepoh, SumbernNgepoh, Lawang, Malang, Jawa Timur 65216'),
(5, 'Sumber Maron', 28, 10000, 8, 'Pemandian', 'Karangsuko, Pagelaran, Malang, Jawa Timur 65174'),
(6, 'Sumber Jenon', 20, 10000, 5, 'Pemandian', 'Gunungronggo, Tajinan, Malang, Jawa Timur 65172'),
(7, 'Sumber Taman', 29, 10000, 8, 'Pemandian', 'Desa Karangsuko, Pagelaran, Brongkal, Pagelaran, Malang, Jawa Timur 65174'),
(8, 'Wendit Waterpark', 8, 25000, 7, 'Pemandian', 'Jl. Raya Asri Katon, Desa Mangliawan, Kec. Pakis, Kab. Malang, Jawa Timur - Indonesia'),
(9, 'Kolam Renang Songgoriti', 23, 25000, 12, 'Pemandian', 'Jl. Arumdalu, Songgokerto, Kec. Batu, Kota Batu, Jawa Timur 65312'),
(10, 'Hawaii Waterpark', 11, 110000, 3, 'Pemandian', 'Jalan Graha Kencana Raya, Banjararum, Singosari, Banjararum, Singosari, Kota Malang, Jawa Timur 65126'),
(11, 'Sumber Pitu Tumpang', 30, 20000, 6, 'Air Terjun', 'Duwet Krajan, Tumpang, Malang, Jawa Timur - Indonesia'),
(12, 'Coban Rondo', 31, 30000, 11, 'Air Terjun', 'Jl. Coban Rondo, Pandesari, Pujon, Malang, Jawa Timur 65391'),
(13, 'Coban Talun', 29, 15000, 12, 'Air Terjun', 'Dusun Wonorejo, Desa Tulungrejo, Bumiaji, Tulungrejo, Bumiaji, Kota Batu, Jawa Timur 65336'),
(14, 'Coban Rais', 21, 15000, 12, 'Air Terjun', 'Oro-Oro Ombo, Kehutanan, Kec. Batu, Kota Batu, Jawa Timur 65151'),
(15, 'Coban Sewu', 41, 15000, 11, 'Air Terjun', 'Desa Bendosari, Kecamatan Pujon, Bendosari, Pujon, Malang, Jawa Timur 65391'),
(16, 'Coban Gintung', 68, 15000, 8, 'Air Terjun', 'Sidorenggo, Ampelgading, Malang, Jawa Timur 65183'),
(17, 'Coban Pelangi', 32, 15000, 7, 'Air Terjun', 'Ngadas, Poncokusumo, Malang, Jawa Timur 65157'),
(18, 'Coban Jahe', 24, 10000, 16, 'Air Terjun', 'Desa begawan, Taji, Jabung, Taji, Jabung, Malang, Jawa Timur 65156'),
(19, 'Coban Tundo', 61, 10000, 11, 'Air Terjun', 'Tambakasri, Sumbermanjing, Malang, Jawa Timur 65181'),
(20, 'Coban Parang Tejo', 19, 10000, 1, 'Air Terjun', 'Princi, Gading Kulon, Kucur, Dau, Malang, Jawa Timur 65151'),
(21, 'Coban Jodo', 27, 10000, 16, 'Air Terjun', 'Bendolawang, Ngadirejo, Jabung, Malang, Jawa Timur 65156'),
(22, 'Coban Cinde', 29, 10000, 6, 'Air Terjun', 'Benjor, Tumpang, Malang, Jawa Timur 65156'),
(23, 'Coban Kethak', 55, 10000, 1, 'Air Terjun', 'Jl. Raya Kasembon, Kasembon, Malang, Jawa Timur 65393'),
(24, 'Coban Tengah', 30, 10000, 11, 'Air Terjun', 'Pandesari, Pujon, Malang, Jawa Timur 65391'),
(25, 'Coban Glotak', 20, 10000, 7, 'Air Terjun', 'Jalan Raya Coban Glothak, Gang I, Sukodadi, Wagir, Dalisodo, Wagir, Malang, Jawa Timur 65158'),
(26, 'Coban Kodok', 32, 15000, 11, 'Air Terjun', 'Dusun Gumul, Sukomulyo, Pujon, Malang, Jawa Timur 65391'),
(27, 'Coban Putri', 20, 20000, 12, 'Air Terjun', 'Perhutani Oro oro Ombo, Coban Putri, Kehutanan, Kec. Batu, Kota Batu, Jawa Timur 65321'),
(28, 'Coban Siuk', 28, 10000, 16, 'Air Terjun', 'Taji, Jabung, Malang, Jawa Timur 65155'),
(29, 'Coban Trisula', 34, 10000, 7, 'Air Terjun', 'Ngadas, Poncokusumo, Malang, Jawa Timur 65157'),
(30, 'Coban Baung', 25, 15000, 10, 'Air Terjun', 'Purwodadi, Blimbing, Malang, Jawa Timur 67163'),
(31, 'Coban Supit Urang', 35, 10000, 11, 'Air Terjun', 'Madiredo, Pujon, Wiyurejo, Pujon, Malang, Jawa Timur 65392'),
(32, 'Coban Bidadari', 31, 20000, 7, 'Air Terjun', 'Gubugklakah, Poncokusumo, Gubugklakah, Poncokusumo, Malang, Jawa Timur 65157'),
(33, 'Pantai Balekambang', 60, 20000, 10, 'Pantai', 'Dusun Sumber Jambe, Desa Srigonco, Kecamatan Bantur, Sumberbening, Bantur, Malang, Jawa Timur 65179'),
(34, 'Pantai Ngliyep', 67, 15000, 4, 'Pantai', 'Desa Kedungsalam, Donomulyo, Kedungsalam, Donomulyo, Malang, Jawa Timur 65167'),
(35, 'Pantai Tiga Warna', 74, 100000, 11, 'Pantai', 'Jl. Sendang Biru, Tambakrejo, Sumbermanjing, Malang, Jawa Timur 65176'),
(36, 'Pantai Sendang Biru', 72, 20000, 11, 'Pantai', 'Sendangbiru, Tambakrejo, Sumbermanjing Wetan, Malang, Jawa Timur 65176'),
(37, 'Pantai Goa Cina', 71, 20000, 11, 'Pantai', 'Dusun Tumpak Awu, Desa Sitiarjo, Kec. Sumbermanjing Wetan, Kab. Malang, Jawa Timur 65176'),
(38, 'Pantai Bajul Mati', 67, 20000, 4, 'Pantai', 'Gajahrejo, Gedangan, Malang, Jawa Timur 65178'),
(39, 'Pantai Mbehi', 64, 20000, 10, 'Pantai', 'Bandungrejo, Bantur, Malang, Jawa Timur 65179'),
(40, 'Pantai Batu Bengkung', 65, 10000, 4, 'Pantai', 'Gajahrejo, Gedangan, Malang, Jawa Timur'),
(41, 'Pantai Sendiki', 70, 10000, 11, 'Pantai', 'Tambakrejo, Sumbermanjing, Tambakrejo, Sumbermanjing, Malang, Jawa Timur 65148'),
(42, 'Pantai Selok', 63, 15000, 10, 'Pantai', 'Sumberbening, Bantur, Malang, Jawa Timur 65179'),
(43, 'Pantai Banyu Meneng', 63, 15000, 10, 'Pantai', 'Sumberbening, Bantur, Malang, Jawa Timur 65179'),
(44, 'Pantai Kedung Celeng', 64, 10000, 4, 'Pantai', 'Jalan Raya Banjarejo, Kedungsalam, Donomulyo, Kedungsalam, Donomulyo, Malang, Jawa Timur 65167'),
(45, 'Pantai Sipelot', 76, 10000, 13, 'Pantai', 'Pujiharjo, Tirtoyudo, Pujiharjo, Tirto Yudo, Malang, Jawa Timur 65182'),
(46, 'Pantai Lenggoksono', 70, 35000, 13, 'Pantai', 'Purwodadi, Tirto Yudo, Malang, Jawa Timur 65182'),
(47, 'Pantai Clungup', 73, 10000, 11, 'Pantai', 'Sendang Biru, Tambakrejo, Sumbermanjing, Malang, Jawa Timur'),
(48, 'Pantai Kondang Merak', 63, 15000, 10, 'Pantai', 'Sumberbening, Bantur, Malang, Jawa Timur 65179'),
(49, 'Pantai Jonggring Saloko', 70, 10000, 4, 'Pantai', 'Desa Mentaraman, Donomulyo, Malang, Jawa Timur 65167'),
(50, 'Pantai Kondang Iwak', 65, 10000, 4, 'Pantai', 'Dusun Sumberpucung, Desa Tulungrejo, Kecamatan Donomulyo, Kabupaten Malang, Jawa Timur'),
(51, 'Pantai Modangan', 71, 15000, 4, 'Pantai', 'Sumberejo, RT.41 / RW.10, Sumberoto, Donomulyo, Sumberoto, Donomulyo, Malang, Jawa Timur'),
(52, 'Pantai Kali Apus', 71, 25000, 11, 'Pantai', 'Tambakasri, Sumbermanjing, Tambakasri, Malang, Jawa Timur 65176'),
(53, 'Pantai Pancer', 68, 10000, 11, 'Pantai', 'Sidoasri, Sumbermanjing, Malang, Jawa Timur 65176'),
(54, 'Pantai Bangsong', 76, 10000, 11, 'Pantai', 'Tambakrejo, Sumbermanjing, Malang, Jawa Timur 65176'),
(55, 'Pantai Ngudel', 59, 20000, 4, 'Pantai', 'Sidurejo, Gedangan, Malang, Jawa Timur 65178'),
(56, 'Pantai Savanna', 74, 25000, 11, 'Pantai', 'Tambakrejo, Sumbermanjing, Malang, Jawa Timur 65176'),
(57, 'Pantai Tamban', 70, 15000, 11, 'Pantai', 'Tambakrejo, Sumbermanjing, Malang, Jawa Timur 65176'),
(58, 'Pantai Ungapan', 67, 15000, 4, 'Pantai', 'Gajahrejo, Gedangan, Malang, Jawa Timur'),
(59, 'Pantai Bowele', 70, 15000, 13, 'Pantai', 'Purwodadi, Tirto Yudo, Malang, Jawa Timur 65182'),
(60, 'Pantai Waru-Waru', 71, 10000, 11, 'Pantai', 'Pulau Sempu, Tambakrejo, Sumbermanjing, Malang, Jawa Timur 65176'),
(61, 'Pantai Watu Leter', 77, 15000, 11, 'Pantai', 'Rowotrate, Sitiarjo, Sumbermanjing, Malang, Jawa Timur 65176'),
(62, 'Pantai Kuncaran', 58, 15000, 4, 'Pantai', 'Sidurejo, Gedangan, Malang, Jawa Timur 65178'),
(63, 'Pantai Watu Lepek', 65, 15000, 4, 'Pantai', 'Gajahrejo, Gedangan, Malang, Jawa Timur 65178'),
(64, 'Pantai Nganteb', 58, 15000, 4, 'Pantai', 'Tumpakrejo, Sidurejo, Gedangan, Malang, Jawa Timur'),
(65, 'Pantai Bolu Bolu', 68, 10000, 13, 'Pantai', 'Purwodadi, Tirto Yudo, Malang, Jawa Timur 65182'),
(66, 'Pantai Banyu Anjlok', 70, 10000, 13, 'Pantai', 'Lenggoksono, Purwodadi, Tirto Yudo, Malang, Jawa Timur 65182'),
(67, 'Pulau Sempu', 72, 45000, 11, 'Pantai', 'Tambakrejo, Sumbermanjing, Malang, Jawa Timur'),
(68, 'Pantai Wedi Awu', 71, 10000, 13, 'Pantai', 'Purwodadi, Tirto Yudo, Malang, Jawa Timur 65182'),
(69, 'Pantai Bantol', 64, 10000, 4, 'Pantai', 'Dusun Sumberceleng, Desa Banjarejo, Donomulyo, Malang, Jawa Timur 60253'),
(70, 'Pantai Wonogoro', 56, 10000, 4, 'Pantai', 'Tumpakrejo, Gedangan, Malang, Jawa Timur 65178'),
(71, 'Pantai Perawan', 77, 10000, 11, 'Pantai', 'Sidoasri, Sumbermanjing, Malang, Jawa Timur 65176'),
(72, 'Pantai Kondang Bandung', 70, 10000, 4, 'Pantai', 'Purwodadi, Donomulyo, Malang, Jawa Timur'),
(73, 'Pantai Mrutu', 75, 10000, 4, 'Pantai', 'Sumberoto, Donomulyo, Malang, Jawa Timur'),
(74, 'Pantai Jolangkung', 66, 10000, 4, 'Pantai', 'Pantai jolangkung, Gajahrejo, Gedangan, Malang, Jawa Timur 65178'),
(75, 'Eco Green Park', 18, 70000, 12, 'Hiburan', 'Jl. Oro-Oro Ombo No.9A, Temas, Kec. Batu, Kota Batu, Jawa Timur 65314'),
(76, 'Alun-Alun Kota Batu', 18, 5000, 12, 'Hiburan', 'Jl. Agus Salim, Sisir, Kec. Batu, Kota Batu, Jawa Timur 65314'),
(77, 'Batu Secret Zoo', 17, 110000, 12, 'Hiburan', 'Jl. Oro-Oro Ombo No.9, Temas, Kec. Batu, Kota Batu, Jawa Timur 65315'),
(78, 'Jawa Timur Park 1', 18, 100000, 12, 'Hiburan', 'Jl. Kartika No. 2, Sisir, Batu, Sisir, Kec. Batu, Kota Batu, Jawa Timur 65315'),
(79, 'Jawa Timur Park 2', 18, 110000, 12, 'Hiburan', 'Jalan Raya Oro-Oro Ombo No.9, Temas, Batu, Temas, Kec. Batu, Kota Batu, Jawa Timur 65315'),
(80, 'Museum Angkut', 18, 90000, 12, 'Hiburan', 'Jl. Terusan Sultan Agung No. 2, Batu, Jawa Timur'),
(81, 'Batu Night Spectacular', 17, 110000, 12, 'Hiburan', 'Jalan Hayam Wuruk No. 1, Oro-Oro Ombo, Batu, Oro-Oro Ombo, Kec. Batu, Kota Batu, Jawa Timur 65316'),
(82, 'Predator Fun Park', 16, 60000, 3, 'Hiburan', 'Jl. Raya Tlekung No. 315, Dusun Gangsiran, Desa Tlekung, Kecamatan Junrejo, Tlekung, Junrejo, Kota Batu, Jawa Timur 65327'),
(83, 'Bagong Adventure Museum Tubuh', 18, 65000, 12, 'Hiburan', 'Jalan Kartika No. 1, Sisir, Batu, Sisir, Kec. Batu, Kota Batu, Jawa Timur 65314'),
(84, 'Pasar Parkiran', 18, 10000, 12, 'Hiburan', 'Jl. Sultan Angung, Sisir, Kecamatan Batu, Sisir, Kec. Batu, Kota Batu, Jawa Timur 65314'),
(85, 'Taman Selecta', 28, 30000, 12, 'Hiburan', 'Jl. Raya Selecta No. 1, Bumiaji, Tulungrejo, Bumiaji, Kota Batu, Jawa Timur 65336'),
(86, 'Batu Wonderland', 17, 30000, 12, 'Hiburan', 'Jalan Imam Bonjol Bawah No. 9, Temas, Batu, Temas, Kec. Batu, Kota Batu, Jawa Timur 65315'),
(87, 'Taman Sengkaling', 10, 20000, 1, 'Hiburan', 'Jl. Raya Sengkaling No.194, Mulyoagung, Dau, Malang, Jawa Timur 65151'),
(88, 'Wisata Paralayang', 27, 10000, 12, 'Hiburan', 'Jl. Songgokerto, Songgokerto, Kec. Batu, Kota Batu, Jawa Timur 65312'),
(89, 'Kebun Teh Wonosari', 20, 20000, 3, 'Hiburan', 'Toyomarto, Lawang, Malang, Jawa Timur 65153'),
(90, 'Kampung Warna-Warni', 3, 10000, 10, 'Hiburan', 'Gang 1, Jodipan, Blimbing, Kesatrian, Blimbing, Kota Malang, Jawa Timur 65126'),
(91, 'Malang Night Paradise', 10, 40000, 10, 'Hiburan', 'Jl. Graha Kencana Raya No.66, Balearjosari, Blimbing, Kota Malang, Jawa Timur 65126'),
(92, 'Candi Songgoriti', 23, 5000, 12, 'Budaya', 'Songgokerto, Batu Sub-District, Batu City, East Java 65312'),
(93, 'Candi Singosari', 10, 10000, 3, 'Budaya', 'Jl. Kertanegara No.148, Candirenggo, Singosari, Malang, Jawa Timur 65153'),
(94, 'Candi Sumberawan', 15, 10000, 3, 'Budaya', 'Sumberawan, Toyomarto, Singosari, Toyomarto, Singosari, Malang, Jawa Timur 65153'),
(95, 'Candi Kidal', 15, 5000, 6, 'Budaya', 'JL. Candi Kidal No.65125, Kidal, Tumpang, Malang, East Java 65126'),
(96, 'Candi Jago', 18, 5000, 6, 'Budaya', 'Jl. Wisnuwardhana, Tumpang, Malang, Jawa Timur 65156'),
(97, 'Candi Badut', 7, 5000, 1, 'Budaya', 'Jalan Candi 5D, Karangwidoro, Dau, Karangwidoro, Dau, Kota Malang, Jawa Timur 65146'),
(98, 'Masjid Tiban', 28, 5000, 7, 'Religi', 'Jl. Anggur, Sananrejo, Turen, Malang, Jawa Timur 65175'),
(99, 'Kelenteng Eng An Kiong', 4, 5000, 13, 'Religi', 'Jl. R.E. Martadinata, Kotalama, Kedungkandang, Kota Malang, Jawa Timur 65118'),
(100, 'Pantai Wedi Putih', 72, 15000, 13, 'Pantai', 'Purwodadi, Tirto Yudo, Malang, Jawa Timur 65182');

-- --------------------------------------------------------

--
-- Table structure for table `fuzzifikasi`
--

CREATE TABLE `fuzzifikasi` (
  `id_fuzzifikasi` int(11) NOT NULL,
  `id_objek` int(11) NOT NULL,
  `jrkdekat` float NOT NULL,
  `jrksedang` float NOT NULL,
  `jrkjauh` float NOT NULL,
  `bgtmurah` float NOT NULL,
  `bgtsedang` float NOT NULL,
  `bgtmahal` float NOT NULL,
  `bncsedikit` float NOT NULL,
  `bncsedang` float NOT NULL,
  `bncbanyak` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fuzzifikasi`
--

INSERT INTO `fuzzifikasi` (`id_fuzzifikasi`, `id_objek`, `jrkdekat`, `jrksedang`, `jrkjauh`, `bgtmurah`, `bgtsedang`, `bgtmahal`, `bncsedikit`, `bncsedang`, `bncbanyak`) VALUES
(1, 1, 0.75, 0.25, 0, 1, 0, 0, 1, 0, 0),
(2, 2, 1, 0, 0, 1, 0, 0, 1, 0, 0),
(3, 3, 0, 0.89, 0.11, 1, 0, 0, 0, 0, 1),
(4, 4, 0.95, 0.05, 0, 1, 0, 0, 1, 0, 0),
(5, 5, 0.55, 0.45, 0, 1, 0, 0, 0, 1, 0),
(6, 6, 0.95, 0.05, 0, 1, 0, 0, 0.75, 0.25, 0),
(7, 7, 0.5, 0.5, 0, 1, 0, 0, 0, 1, 0),
(8, 8, 1, 0, 0, 1, 0, 0, 0.25, 0.75, 0),
(9, 9, 0.8, 0.2, 0, 1, 0, 0, 0, 0, 1),
(10, 10, 1, 0, 0, 0, 0, 1, 1, 0, 0),
(11, 11, 0.45, 0.55, 0, 1, 0, 0, 0.5, 0.5, 0),
(12, 12, 0.4, 0.6, 0, 0.91, 0.09, 0, 0, 0.25, 0.75),
(13, 13, 0.5, 0.5, 0, 1, 0, 0, 0, 0, 1),
(14, 14, 0.9, 0.1, 0, 1, 0, 0, 0, 0, 1),
(15, 15, 0, 0.89, 0.11, 1, 0, 0, 0, 0.25, 0.75),
(16, 16, 0, 0, 1, 1, 0, 0, 0, 1, 0),
(17, 17, 0.35, 0.65, 0, 1, 0, 0, 0.25, 0.75, 0),
(18, 18, 0.75, 0.25, 0, 1, 0, 0, 0, 0, 1),
(19, 19, 0, 0, 1, 1, 0, 0, 0, 0.25, 0.75),
(20, 20, 1, 0, 0, 1, 0, 0, 1, 0, 0),
(21, 21, 0.6, 0.4, 0, 1, 0, 0, 0, 0, 1),
(22, 22, 0.5, 0.5, 0, 1, 0, 0, 0.5, 0.5, 0),
(23, 23, 0, 0.16, 0.84, 1, 0, 0, 1, 0, 0),
(24, 24, 0.45, 0.55, 0, 1, 0, 0, 0, 0.25, 0.75),
(25, 25, 0.95, 0.05, 0, 1, 0, 0, 0.25, 0.75, 0),
(26, 26, 0.35, 0.65, 0, 1, 0, 0, 0, 0.25, 0.75),
(27, 27, 0.95, 0.05, 0, 1, 0, 0, 0, 0, 1),
(28, 28, 0.55, 0.45, 0, 1, 0, 0, 0, 0, 1),
(29, 29, 0.25, 0.75, 0, 1, 0, 0, 0.25, 0.75, 0),
(30, 30, 0.7, 0.3, 0, 1, 0, 0, 0, 0.5, 0.5),
(31, 31, 0.2, 0.8, 0, 1, 0, 0, 0, 0.25, 0.75),
(32, 32, 0.4, 0.6, 0, 1, 0, 0, 0.25, 0.75, 0),
(33, 33, 0, 0, 1, 1, 0, 0, 0, 0.5, 0.5),
(34, 34, 0, 0, 1, 1, 0, 0, 1, 0, 0),
(35, 35, 0, 0, 1, 0, 0, 1, 0, 0.25, 0.75),
(36, 36, 0, 0, 1, 1, 0, 0, 0, 0.25, 0.75),
(37, 37, 0, 0, 1, 1, 0, 0, 0, 0.25, 0.75),
(38, 38, 0, 0, 1, 1, 0, 0, 1, 0, 0),
(39, 39, 0, 0, 1, 1, 0, 0, 0, 0.5, 0.5),
(40, 40, 0, 0, 1, 1, 0, 0, 1, 0, 0),
(41, 41, 0, 0, 1, 1, 0, 0, 0, 0.25, 0.75),
(42, 42, 0, 0, 1, 1, 0, 0, 0, 0.5, 0.5),
(43, 43, 0, 0, 1, 1, 0, 0, 0, 0.5, 0.5),
(44, 44, 0, 0, 1, 1, 0, 0, 1, 0, 0),
(45, 45, 0, 0, 1, 1, 0, 0, 0, 0, 1),
(46, 46, 0, 0, 1, 0.73, 0.27, 0, 0, 0, 1),
(47, 47, 0, 0, 1, 1, 0, 0, 0, 0.25, 0.75),
(48, 48, 0, 0, 1, 1, 0, 0, 0, 0.5, 0.5),
(49, 49, 0, 0, 1, 1, 0, 0, 1, 0, 0),
(50, 50, 0, 0, 1, 1, 0, 0, 1, 0, 0),
(51, 51, 0, 0, 1, 1, 0, 0, 1, 0, 0),
(52, 52, 0, 0, 1, 1, 0, 0, 0, 0.25, 0.75),
(53, 53, 0, 0, 1, 1, 0, 0, 0, 0.25, 0.75),
(54, 54, 0, 0, 1, 1, 0, 0, 0, 0.25, 0.75),
(55, 55, 0, 0, 1, 1, 0, 0, 1, 0, 0),
(56, 56, 0, 0, 1, 1, 0, 0, 0, 0.25, 0.75),
(57, 57, 0, 0, 1, 1, 0, 0, 0, 0.25, 0.75),
(58, 58, 0, 0, 1, 1, 0, 0, 1, 0, 0),
(59, 59, 0, 0, 1, 1, 0, 0, 0, 0, 1),
(60, 60, 0, 0, 1, 1, 0, 0, 0, 0.25, 0.75),
(61, 61, 0, 0, 1, 1, 0, 0, 0, 0.25, 0.75),
(62, 62, 0, 0, 1, 1, 0, 0, 1, 0, 0),
(63, 63, 0, 0, 1, 1, 0, 0, 1, 0, 0),
(64, 64, 0, 0, 1, 1, 0, 0, 1, 0, 0),
(65, 65, 0, 0, 1, 1, 0, 0, 0, 0, 1),
(66, 66, 0, 0, 1, 1, 0, 0, 0, 0, 1),
(67, 67, 0, 0, 1, 0.36, 0.64, 0, 0, 0.25, 0.75),
(68, 68, 0, 0, 1, 1, 0, 0, 0, 0, 1),
(69, 69, 0, 0, 1, 1, 0, 0, 1, 0, 0),
(70, 70, 0, 0.11, 0.89, 1, 0, 0, 1, 0, 0),
(71, 71, 0, 0, 1, 1, 0, 0, 0, 0.25, 0.75),
(72, 72, 0, 0, 1, 1, 0, 0, 1, 0, 0),
(73, 73, 0, 0, 1, 1, 0, 0, 1, 0, 0),
(74, 74, 0, 0, 1, 1, 0, 0, 1, 0, 0),
(75, 75, 1, 0, 0, 0, 0.45, 0.55, 0, 0, 1),
(76, 76, 1, 0, 0, 1, 0, 0, 0, 0, 1),
(77, 77, 1, 0, 0, 0, 0, 1, 0, 0, 1),
(78, 78, 1, 0, 0, 0, 0, 1, 0, 0, 1),
(79, 79, 1, 0, 0, 0, 0, 1, 0, 0, 1),
(80, 80, 1, 0, 0, 0, 0, 1, 0, 0, 1),
(81, 81, 1, 0, 0, 0, 0, 1, 0, 0, 1),
(82, 82, 1, 0, 0, 0, 0.82, 0.18, 1, 0, 0),
(83, 83, 1, 0, 0, 0, 0.64, 0.36, 0, 0, 1),
(84, 84, 1, 0, 0, 1, 0, 0, 0, 0, 1),
(85, 85, 0.55, 0.45, 0, 0.91, 0.09, 0, 0, 0, 1),
(86, 86, 1, 0, 0, 0.91, 0.09, 0, 0, 0, 1),
(87, 87, 1, 0, 0, 1, 0, 0, 1, 0, 0),
(88, 88, 0.6, 0.4, 0, 1, 0, 0, 0, 0, 1),
(89, 89, 0.95, 0.05, 0, 1, 0, 0, 1, 0, 0),
(90, 90, 1, 0, 0, 1, 0, 0, 0, 0.5, 0.5),
(91, 91, 1, 0, 0, 0.55, 0.45, 0, 0, 0.5, 0.5),
(92, 92, 0.8, 0.2, 0, 1, 0, 0, 0, 0, 1),
(93, 93, 1, 0, 0, 1, 0, 0, 1, 0, 0),
(94, 94, 1, 0, 0, 1, 0, 0, 1, 0, 0),
(95, 95, 1, 0, 0, 1, 0, 0, 0.5, 0.5, 0),
(96, 96, 1, 0, 0, 1, 0, 0, 0.5, 0.5, 0),
(97, 97, 1, 0, 0, 1, 0, 0, 1, 0, 0),
(98, 98, 0.55, 0.45, 0, 1, 0, 0, 0.25, 0.75, 0),
(99, 99, 1, 0, 0, 1, 0, 0, 0, 0, 1),
(100, 100, 0, 0, 1, 1, 0, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `koordinat_objek`
--

CREATE TABLE `koordinat_objek` (
  `id_koordinat` int(10) NOT NULL,
  `id_objek` int(10) NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `koordinat_objek`
--

INSERT INTO `koordinat_objek` (`id_koordinat`, `id_objek`, `latitude`, `longitude`) VALUES
(1, 1, '-8.122911', '112.620597'),
(2, 2, '-7.842615', '112.701101'),
(3, 3, '-7.741727', '112.534377'),
(4, 4, '-7.84279', '112.720401'),
(5, 5, '-8.165472', '112.593748'),
(6, 6, '-8.049661', '112.716464'),
(7, 7, '-8.176771', '112.601382'),
(8, 8, '-7.952746', '112.673985'),
(9, 9, '-7.866382', '112.492262'),
(10, 10, '-7.923462', '112.658253'),
(11, 11, '-8.013583', '112.821727'),
(12, 12, '-7.884994', '112.477319'),
(13, 13, '-7.805056', '112.517058'),
(14, 14, '-7.91223', '112.518925'),
(15, 15, '-7.866413', '112.42335'),
(16, 16, '-8.252156', '112.914597'),
(17, 17, '-8.011501', '112.865349'),
(18, 18, '-7.969469', '112.802997'),
(19, 19, '-8.341181', '112.794773'),
(20, 20, '-7.931402', '112.515367'),
(21, 21, '-7.98832', '112.834235'),
(22, 22, '-7.989812', '112.836834'),
(23, 23, '-7.802906', '112.356975'),
(24, 24, '-7.89206', '112.475157'),
(25, 25, '-7.982234', '112.52127'),
(26, 26, '-7.868808', '112.453579'),
(27, 27, '-7.912999', '112.526406'),
(28, 28, '-7.957091', '112.82087'),
(29, 29, '-8.000102', '112.870854'),
(30, 30, '-8.032181', '112.500057'),
(31, 31, '-7.791004', '112.460352'),
(32, 32, '-8.011161', '112.85816'),
(33, 33, '-8.403446', '112.539126'),
(34, 34, '-8.38365', '112.424305'),
(35, 35, '-8.439143', '112.677794'),
(36, 36, '-8.431837', '112.686473'),
(37, 37, '-8.447192', '112.65371'),
(38, 38, '-8.430919', '112.635428'),
(39, 39, '-8.402236', '112.504308'),
(40, 40, '-8.430171', '112.615103'),
(41, 41, '-8.416813', '112.725938'),
(42, 42, '-8.39713', '112.514048'),
(43, 43, '-8.396223', '112.515071'),
(44, 44, '-8.3955', '112.449653'),
(45, 45, '-8.380618', '112.899231'),
(46, 46, '-8.372372', '112.838931'),
(47, 47, '-8.437532', '112.668611'),
(48, 48, '-8.396498', '112.519231'),
(49, 49, '-8.379562', '112.396102'),
(50, 50, '-8.395604', '112.481597'),
(51, 51, '-8.349174', '112.359808'),
(52, 52, '-8.41626', '112.740629'),
(53, 53, '-8.386197', '112.782061'),
(54, 54, '-8.443144', '112.663967'),
(55, 55, '-8.416713', '112.585918'),
(56, 56, '-8.443174', '112.673236'),
(57, 57, '-8.417298', '112.709878'),
(58, 58, '-8.434982', '112.640362'),
(59, 59, '-8.370681', '112.83759'),
(60, 60, '-8.430822', '112.692693'),
(61, 61, '-8.445227', '112.648405'),
(62, 62, '-8.414743', '112.581136'),
(63, 63, '-8.432465', '112.616701'),
(64, 64, '-8.409934', '112.576774'),
(65, 65, '-8.38655', '112.815352'),
(66, 66, '-8.372687', '112.820665'),
(67, 67, '-8.442856', '112.697336'),
(68, 68, '-8.376208', '112.846479'),
(69, 69, '-8.395161', '112.452122'),
(70, 70, '-8.40543', '112.566287'),
(71, 71, '-8.386073', '112.773353'),
(72, 72, '-8.372215', '112.388759'),
(73, 73, '-8.373019', '112.373'),
(74, 74, '-8.428199', '112.628545'),
(75, 75, '-7.887374', '112.528233'),
(76, 76, '-7.871153', '112.526925'),
(77, 77, '-7.888231', '112.529828'),
(78, 78, '-7.883915', '112.524782'),
(79, 79, '-7.888958', '112.529618'),
(80, 80, '-7.878915', '112.520208'),
(81, 81, '-7.896525', '112.534535'),
(82, 82, '-7.913067', '112.548409'),
(83, 83, '-7.88404', '112.523794'),
(84, 84, '-7.880033', '112.524438'),
(85, 85, '-7.818035', '112.525219'),
(86, 86, '-7.880351', '112.533101'),
(87, 87, '-7.915384', '112.588909'),
(88, 88, '-7.854872', '112.496731'),
(89, 89, '-7.821613', '112.642577'),
(90, 90, '-7.983221', '112.637631'),
(91, 91, '-7.92293', '112.657003'),
(92, 92, '-7.867092', '112.492701'),
(93, 93, '-7.887785', '112.663881'),
(94, 94, '-7.855344', '112.644833'),
(95, 95, '-8.02556', '112.70861'),
(96, 96, '-8.005843', '112.764108'),
(97, 97, '-7.957783', '112.59854'),
(98, 98, '-8.150973', '112.713123'),
(99, 99, '-7.987589', '112.635782'),
(100, 100, '-8.381313', '112.841898');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `batas_atribut`
--
ALTER TABLE `batas_atribut`
  ADD PRIMARY KEY (`id_batas`);

--
-- Indexes for table `data_objek`
--
ALTER TABLE `data_objek`
  ADD PRIMARY KEY (`id_objek`);

--
-- Indexes for table `fuzzifikasi`
--
ALTER TABLE `fuzzifikasi`
  ADD PRIMARY KEY (`id_fuzzifikasi`);

--
-- Indexes for table `koordinat_objek`
--
ALTER TABLE `koordinat_objek`
  ADD PRIMARY KEY (`id_koordinat`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `batas_atribut`
--
ALTER TABLE `batas_atribut`
  MODIFY `id_batas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `data_objek`
--
ALTER TABLE `data_objek`
  MODIFY `id_objek` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
--
-- AUTO_INCREMENT for table `fuzzifikasi`
--
ALTER TABLE `fuzzifikasi`
  MODIFY `id_fuzzifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
--
-- AUTO_INCREMENT for table `koordinat_objek`
--
ALTER TABLE `koordinat_objek`
  MODIFY `id_koordinat` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
