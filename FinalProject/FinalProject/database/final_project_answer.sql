-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2020 at 07:15 PM
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
-- Table structure for table `final_project_answer`
--

CREATE TABLE IF NOT EXISTS `final_project_answer` (
  `ansId` int(11) NOT NULL AUTO_INCREMENT,
  `quId` int(11) NOT NULL,
  `quOption` varchar(512) NOT NULL,
  `quAnswer` tinyint(1) NOT NULL,
  PRIMARY KEY (`ansId`),
  KEY `quId` (`quId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `final_project_answer`
--

INSERT INTO `final_project_answer` (`ansId`, `quId`, `quOption`, `quAnswer`) VALUES
(1, 1, 'PHP: Hypertext Preprocessor  ', 1),
(2, 1, 'Personal Hypertext Processor', 0),
(3, 1, 'Private Home Page', 0),
(4, 2, '<?php>...</?>', 0),
(5, 2, '<&>...</&>', 0),
(6, 2, '<?php...?>  ', 1),
(7, 2, '<script>...</script>', 0),
(8, 3, 'echo \"Hello World\";  ', 1),
(9, 3, 'Document.Write(\"Hello World\");', 0),
(10, 3, '\"Hello World\";', 0),
(11, 4, '$', 1),
(12, 4, '!', 0),
(13, 4, '&', 0),
(14, 5, ';', 1),
(15, 5, '.', 0),
(16, 5, 'New line', 0),
(17, 5, '</php>', 0),
(18, 6, '<script>  ', 1),
(19, 6, '<javascript>\r\n', 0),
(20, 6, '<js>\r\n', 0),
(21, 6, '<scripting>\r\n', 0),
(22, 7, 'document.getElementById(\"demo\").innerHTML = \"Hello World!\";  ', 1),
(23, 7, '#demo.innerHTML = \"Hello World!\";\r\n', 0),
(24, 7, 'document.getElementByName(\"p\").innerHTML = \"Hello World!\";\r\n', 0),
(25, 7, 'document.getElement(\"p\").innerHTML = \"Hello World!\";\r\n', 0),
(26, 8, 'Both the <head> section and the <body> section are correct  ', 1),
(27, 8, 'The <body> section\r\n', 0),
(28, 8, 'The <head> section\r\n', 0),
(29, 9, '<script src=\"xxx.js\">  ', 1),
(30, 9, '<script href=\"xxx.js\">\r\n', 0),
(31, 9, '<script name=\"xxx.js\">\r\n', 0),
(32, 10, 'False  ', 1),
(33, 10, 'True', 0),
(34, 11, '<body bg=\"yellow\">  ', 0),
(35, 11, '<body style=\"background-color:yellow;\">  ', 1),
(36, 11, '<background>yellow</background>\r\n', 0),
(37, 12, '<a href=\"url\" target=\"new\">  ', 0),
(38, 12, '<a href=\"url\" new>', 0),
(39, 12, '<a href=\"url\" target=\"_blank\">  ', 1),
(40, 13, '<input type=\"list\">  ', 0),
(41, 13, '<input type=\"dropdown\">', 0),
(42, 13, '<select>  ', 1),
(43, 13, '<list>', 0),
(44, 14, '<input type=\"textbox\"> ', 0),
(45, 14, '<textarea>  ', 1),
(46, 14, '<input type=\"textarea\">', 0),
(47, 15, '<head>  ', 0),
(48, 15, '<meta>', 0),
(49, 15, '<title>  ', 1),
(50, 16, '<style src=\"mystyle.css\">  ', 0),
(51, 16, '<link rel=\"stylesheet\" type=\"text/css\" href=\"mystyle.css\">  ', 1),
(52, 16, '<stylesheet>mystyle.css</stylesheet>', 0),
(53, 17, 'body:color=black;  ', 0),
(54, 17, '{body:color=black;}', 0),
(55, 17, '{body;color:black;}', 0),
(56, 17, 'body {color: black;}  ', 1),
(57, 18, '<p style=\"font-size:bold;\">  ', 0),
(58, 18, '<p style=\"text-size:bold;\">', 0),
(59, 18, 'p {text-size:bold;}', 0),
(60, 18, 'p {font-weight:bold;}  ', 1),
(61, 19, 'a {underline:none;}  ', 0),
(62, 19, 'a {decoration:no-underline;}', 0),
(63, 19, 'a {text-decoration:no-underline;}', 0),
(64, 19, 'a {text-decoration:none;}  ', 1),
(65, 20, 'You can\'t do that with CSS  ', 0),
(66, 20, 'transform:capitalize', 0),
(67, 20, 'text-transform:capitalize  ', 1),
(68, 20, 'text-style:capitalize', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
