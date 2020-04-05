-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2020 at 04:23 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
(1, 'Zhaosheng', 'zhaosheng@gmail.com', '$2y$10$wvn6/WjY6LSy0jdTt5GsUu4aqM/fTIzbo0IrYnZqyhBjC6lJvaYly'),
(2, 'Zhilin', 'zhilin@gmail.com', '$2y$10$wvn6/WjY6LSy0jdTt5GsUu4aqM/fTIzbo0IrYnZqyhBjC6lJvaYly'),
(3, 'Stephanie', 'stephanie@johnabbottcollege.com', '$2y$10$wvn6/WjY6LSy0jdTt5GsUu4aqM/fTIzbo0IrYnZqyhBjC6lJvaYly');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
