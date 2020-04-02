-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2020 at 06:12 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ipd19`
--

-- --------------------------------------------------------

--
-- Table structure for table `final_project_result`
--

DROP TABLE IF EXISTS `final_project_result`;
CREATE TABLE IF NOT EXISTS `final_project_result` (
  `retId` int(11) NOT NULL AUTO_INCREMENT,
  `stuId` int(11) NOT NULL,
  `subId` int(11) NOT NULL,
  `tmConsume` varchar(25) NOT NULL,
  `quCount` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  PRIMARY KEY (`retId`),
  KEY `stuId` (`stuId`),
  KEY `subId` (`subId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `final_project_result`
--

INSERT INTO `final_project_result` (`retId`, `stuId`, `subId`, `tmConsume`, `quCount`, `score`) VALUES
(1, 1, 1, '00:00:13', 6, 6),
(2, 1, 1, '00:00:16', 6, 6),
(3, 1, 1, '00:00:15', 6, 6);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
