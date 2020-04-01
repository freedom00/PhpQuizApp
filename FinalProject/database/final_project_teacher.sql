-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 01, 2020 at 06:04 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

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

DROP TABLE IF EXISTS `final_project_teacher`;
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
(1, 'Zhaosheng', 'zhaosheng@gmail.com', '4$2y$10$wvn6/WjY6LSy0jdTt5GsUu4aqM/fTIzbo0IrYnZqyhBjC6lJvaYly'),
(2, 'Zhilin', 'zhilin@gmail.com', '$2y$10$wvn6/WjY6LSy0jdTt5GsUu4aqM/fTIzbo0IrYnZqyhBjC6lJvaYly');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
