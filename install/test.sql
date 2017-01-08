-- phpMyAdmin SQL Dump
-- version 4.6.4deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 08, 2017 at 11:37 PM
-- Server version: 5.7.16-0ubuntu0.16.10.1
-- PHP Version: 7.0.8-3ubuntu3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_banners`
--

CREATE TABLE `tbl_banners` (
  `ID` int(11) NOT NULL,
  `title` varchar(20) NOT NULL,
  `description` varchar(50) NOT NULL,
  `picture` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_banners`
--

INSERT INTO `tbl_banners` (`ID`, `title`, `description`, `picture`) VALUES
(1, 'Best 101 banners', 'Simple best 101 banners', '811578.jpg'),
(2, 'Best 50 banners', 'Simple best 50 banners', '955641.jpg'),
(3, 'Banner success', 'Banner succes', '418498.jpg'),
(4, 'Banner Mistake', 'Banner Mistake...', '565290.jpg'),
(5, 'Blog People', 'Blog People', '479950.jpg'),
(6, 'Angular JS', 'Example Angular JS', '542610.jpg'),
(7, 'Angular JS 2', 'Demo expression', '519563.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_banners`
--
ALTER TABLE `tbl_banners`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_banners`
--
ALTER TABLE `tbl_banners`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
