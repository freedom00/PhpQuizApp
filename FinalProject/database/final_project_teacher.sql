-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2020 at 07:18 PM
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
-- Table structure for table `final_project_teacher`
--

CREATE TABLE IF NOT EXISTS `final_project_teacher` (
  `tchId` int(11) NOT NULL AUTO_INCREMENT,
  `tchName` varchar(50) NOT NULL,
  `tchEmail` varchar(255) NOT NULL,
  `tchPassword` varchar(255) NOT NULL,
  PRIMARY KEY (`tchId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `final_project_teacher`
--

INSERT INTO `final_project_teacher` (`tchId`, `tchName`, `tchEmail`, `tchPassword`) VALUES
(1, 'Zhaosheng', 'zhaosheng@gmail.com', '4297f44b13955235245b2497399d7a93'),
(2, 'Zhilin', 'zhilin@gmail.com', '4297f44b13955235245b2497399d7a93');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
