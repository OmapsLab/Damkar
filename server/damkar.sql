-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 06, 2013 at 06:14 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `damkar`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) NOT NULL,
  `pass` varchar(100) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `user`, `pass`) VALUES
(1, 'sysadmin', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Table structure for table `masyarakat`
--

CREATE TABLE IF NOT EXISTS `masyarakat` (
  `id_masyarakat` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `hp` varchar(50) NOT NULL,
  PRIMARY KEY (`id_masyarakat`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `masyarakat`
--

INSERT INTO `masyarakat` (`id_masyarakat`, `nama`, `alamat`, `hp`) VALUES
(5, 'a', 'aa', '0867799');

-- --------------------------------------------------------

--
-- Table structure for table `pengaduan`
--

CREATE TABLE IF NOT EXISTS `pengaduan` (
  `id_pengaduan` int(11) NOT NULL AUTO_INCREMENT,
  `id_masyarakat_f` int(11) NOT NULL,
  `id_peta_f` int(11) NOT NULL,
  `foto` text NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'PENDING',
  `tgl_pengaduan` datetime NOT NULL,
  PRIMARY KEY (`id_pengaduan`),
  KEY `id_masyarakat_f` (`id_masyarakat_f`),
  KEY `id_peta_f` (`id_peta_f`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `pengaduan`
--

INSERT INTO `pengaduan` (`id_pengaduan`, `id_masyarakat_f`, `id_peta_f`, `foto`, `status`, `tgl_pengaduan`) VALUES
(3, 5, 4, '', 'PENDING', '2013-08-28 02:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `peta`
--

CREATE TABLE IF NOT EXISTS `peta` (
  `id_peta` int(11) NOT NULL AUTO_INCREMENT,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  PRIMARY KEY (`id_peta`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `peta`
--

INSERT INTO `peta` (`id_peta`, `latitude`, `longitude`) VALUES
(4, '-112223', '107.30803');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD CONSTRAINT `pengaduan_ibfk_1` FOREIGN KEY (`id_masyarakat_f`) REFERENCES `masyarakat` (`id_masyarakat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengaduan_ibfk_2` FOREIGN KEY (`id_peta_f`) REFERENCES `peta` (`id_peta`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
