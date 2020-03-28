-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2020 at 07:16 PM
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
-- Table structure for table `final_project_question`
--

CREATE TABLE IF NOT EXISTS `final_project_question` (
  `quId` int(11) NOT NULL AUTO_INCREMENT,
  `subId` int(11) NOT NULL,
  `quName` varchar(1024) NOT NULL,
  `quType` enum('sgl','mul') NOT NULL,
  PRIMARY KEY (`quId`),
  KEY `subId` (`subId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `final_project_question`
--

INSERT INTO `final_project_question` (`quId`, `subId`, `quName`, `quType`) VALUES
(1, 1, 'What does PHP stand for?', 'sgl'),
(2, 1, 'PHP server scripts are surrounded by delimiters, which?', 'sgl'),
(3, 1, 'How do you write \"Hello World\" in PHP?', 'sgl'),
(4, 1, 'All variables in PHP start with which symbol?', 'sgl'),
(5, 1, 'What is the correct way to end a PHP statement?', 'sgl'),
(6, 2, 'Inside which HTML element do we put the JavaScript?', 'sgl'),
(7, 2, 'What is the correct JavaScript syntax to change the content of the HTML element below?\r\n<p id=\"demo\">This is a demonstration.</p>\r\n\r\n', 'sgl'),
(8, 2, 'Where is the correct place to insert a JavaScript?', 'sgl'),
(9, 2, 'What is the correct syntax for referring to an external script called \"xxx.js\"?\r\n', 'sgl'),
(10, 2, 'The external JavaScript file must contain the <script> tag.\r\n\r\n', 'sgl'),
(11, 3, 'What is the correct HTML for adding a background color?\r\n\r\n', 'sgl'),
(12, 3, 'How can you open a link in a new tab/browser window?\r\n\r\n', 'sgl'),
(13, 3, 'What is the correct HTML for making a drop-down list?\r\n\r\n', 'sgl'),
(14, 3, 'What is the correct HTML for making a text area?', 'sgl'),
(15, 3, 'Which HTML element defines the title of a document?', 'sgl'),
(16, 4, 'What is the correct HTML for referring to an external style sheet?', 'sgl'),
(17, 4, 'Which is the correct CSS syntax?', 'sgl'),
(18, 4, 'What is the correct CSS syntax for making all the <p> elements bold?', 'sgl'),
(19, 4, 'How do you display hyperlinks without an underline?', 'sgl'),
(20, 4, 'How do you make each word in a text start with a capital letter?\r\n\r\n', 'sgl');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
