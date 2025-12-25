-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 07, 2025 at 08:04 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elections_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `Username` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Password` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`Username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`Username`, `Password`) VALUES
('admin', '4d0c73cca02deed0f78f42cb47befd5e10f0a525');

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

DROP TABLE IF EXISTS `candidate`;
CREATE TABLE IF NOT EXISTS `candidate` (
  `Candidate_ID` int NOT NULL AUTO_INCREMENT,
  `Candidate_NAME` varchar(255) NOT NULL,
  `Candidate_DOB` year NOT NULL,
  `Candidate_SECT` varchar(150) NOT NULL,
  `Candidate_PHOTO` text NOT NULL,
  `List_ID` int NOT NULL,
  PRIMARY KEY (`Candidate_ID`),
  KEY `fk_candidate_list` (`List_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `candidate`
--

INSERT INTO `candidate` (`Candidate_ID`, `Candidate_NAME`, `Candidate_DOB`, `Candidate_SECT`, `Candidate_PHOTO`, `List_ID`) VALUES
(1, 'Alain Aoun', '1971', 'Maronite (Christian)', 'Alain Aoun.jfif', 1),
(2, 'Fadi Abou Rahhal', '1975', 'Maronite (Christian)', 'Fadi Abou Rahhal.jfif', 1),
(3, 'Neemat Frem', '1967', 'Maronite (Christian)', 'Neemat Frem.jpg', 1),
(4, 'Shadi Waked', '1972', 'Shiite', 'Shadi Waked.jfif', 2),
(5, 'Elie El Khoury', '1958', 'Maronite (Christian)', 'Elie El Khoury.jfif', 2),
(6, 'Josephine Zgheib', '1975', 'Maronite (Christian)', 'Josephine Zgheib.jfif', 2),
(7, 'Michel Helou', '1989', 'Maronite (Christian)', 'Michel Helou.jpg', 3),
(8, 'Khalil Al Helou', '1956', 'Sunni Muslim', 'Khalil Al Helou.png', 3),
(9, 'Ramzi Kanj', '1967', 'Shiite', 'Ramzi Kanj.jpg', 3),
(10, 'Ibrahim Azar', '1969', 'Maronite (Christian)', 'Ibrahim Azar.jfif', 4),
(11, 'Ziad Aswad', '1968', 'Shiite', 'Ziad Aswad.jfif', 4),
(12, 'Hasan Ayoub', '1970', 'Shiite', 'Hasan Ayoub.jfif', 4),
(13, 'Bahia Hariri', '1952', 'Sunni Muslim', 'Bahia Hariri.jpg', 5),
(14, 'Ghassan Hasbani', '1972', 'Greek Orthodox Christian', 'Ghassan Hasbani.jfif', 5),
(15, 'Nadim Gemayel', '1982', 'Maronite (Christian)', 'Nadim Gemayel.jpg', 5),
(16, 'Sara Hamdan', '1982', 'Maronite (Christian)', 'Sara Hamdan.jfif', 6),
(17, 'Karim Jaber', '1984', 'Greek Catholic (Rum)', 'Karim Jaber.jpg', 6),
(18, 'Wissam Chamseddine', '1976', 'Sunni', 'Wissam Chamseddine.jfif', 6),
(19, 'Elias Skaff', '1948', 'Greek Catholic (Rum)', 'Elias Skaff.jpg', 7),
(20, 'Razi El Hajj', '1980', 'Maronite (Christian)', 'Razi El Hajj.jpg', 7),
(21, 'Tony Maalouf', '1972', 'Maronite (Christian)', 'Tony Maalouf.jpg', 7),
(22, 'Salim Aoun', '1980', 'Greek Catholic (Rum)', 'Salim Aoun.jfif', 8),
(23, 'Joseph Semaan', '1979', 'Maronite (Christian)', 'Joseph Semaan.jfif', 8),
(24, 'Nicole Yazbeck', '1983', 'Sunni', 'Nicole Yazbeck.png', 8),
(25, 'Michel Daher', '1961', 'Greek Catholic (Rum)', 'Michel Daher.jfif', 9),
(26, 'Ali Hamieh', '1980', 'Shiite', 'Ali Hamieh.jfif', 9),
(27, 'Hassan Mrad', '1975', 'Shiite', 'Hassan Mrad.jfif', 9);

-- --------------------------------------------------------

--
-- Table structure for table `list`
--

DROP TABLE IF EXISTS `list`;
CREATE TABLE IF NOT EXISTS `list` (
  `List_ID` int NOT NULL AUTO_INCREMENT,
  `List_NAME` varchar(255) NOT NULL,
  `List_LOGO` text NOT NULL,
  `Qaza_ID` int NOT NULL,
  PRIMARY KEY (`List_ID`),
  KEY `fk_list_qaza` (`Qaza_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `list`
--

INSERT INTO `list` (`List_ID`, `List_NAME`, `List_LOGO`, `Qaza_ID`) VALUES
(1, 'We Were and Will Remain', 'We Were and Will Remain.svg', 1),
(2, 'With You We Can Until the End', 'With You We Can Until the End.jpg', 1),
(3, 'The Cry of a Nation', 'The Cry of a Nation.png', 1),
(4, 'Together We Can', 'Together We Can.jpg', 2),
(5, 'Voice of the South', 'Voice of the South.png', 2),
(6, 'Saida for Reform', 'Saida for Reform.jfif', 2),
(7, 'Zahle the Message', 'Zahle the Message.jpg', 3),
(8, 'Zahle for Sovereignty and Change', 'Zahle for Sovereignty and Change.png', 3),
(9, 'Together for Zahle', 'Together for Zahle.jpg', 3);

-- --------------------------------------------------------

--
-- Table structure for table `qaza`
--

DROP TABLE IF EXISTS `qaza`;
CREATE TABLE IF NOT EXISTS `qaza` (
  `Qaza_ID` int NOT NULL AUTO_INCREMENT,
  `Qaza_NAME` varchar(255) NOT NULL,
  PRIMARY KEY (`Qaza_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `qaza`
--

INSERT INTO `qaza` (`Qaza_ID`, `Qaza_NAME`) VALUES
(1, 'Mount Lebanon Governorate'),
(2, 'South Lebanon Governorate'),
(3, 'Bekaa Governorate');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `candidate`
--
ALTER TABLE `candidate`
  ADD CONSTRAINT `fk_candidate_list` FOREIGN KEY (`List_ID`) REFERENCES `list` (`List_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `list`
--
ALTER TABLE `list`
  ADD CONSTRAINT `fk_list_qaza` FOREIGN KEY (`Qaza_ID`) REFERENCES `qaza` (`Qaza_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
