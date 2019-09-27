-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 27, 2019 at 10:17 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `BUILDERS_ASSOCIATION`
--

-- --------------------------------------------------------

--
-- Table structure for table `COMPANIES`
--

CREATE TABLE `COMPANIES` (
  `ID` int(10) NOT NULL,
  `NAME` varchar(60) NOT NULL,
  `USERNAME` varchar(50) NOT NULL,
  `PASSWORD` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `PLACED_CANDIDATES`
--

CREATE TABLE `PLACED_CANDIDATES` (
  `ID` bigint(20) NOT NULL,
  `NAME` varchar(60) DEFAULT NULL,
  `NUMBER` varchar(10) DEFAULT NULL,
  `EMAIL` varchar(40) DEFAULT NULL,
  `QUALIFICATION` enum('Diploma','Graduate','Post-Graduate') NOT NULL DEFAULT 'Diploma',
  `EXPERIENCE` enum('Fresher','0-5 Years','5+ Years') NOT NULL DEFAULT 'Fresher',
  `DISTRICT` varchar(25) NOT NULL DEFAULT 'CHENNAI',
  `RESUME` varchar(50) DEFAULT NULL,
  `COMPANY` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `UNPLACED_CANDIDATES`
--

CREATE TABLE `UNPLACED_CANDIDATES` (
  `ID` bigint(20) NOT NULL,
  `NAME` varchar(60) NOT NULL,
  `NUMBER` varchar(10) NOT NULL,
  `EMAIL` varchar(40) NOT NULL,
  `QUALIFICATION` enum('Diploma','Graduate','Post-Graduate') NOT NULL DEFAULT 'Diploma',
  `EXPERIENCE` enum('Fresher','0-5 Years','5+ Years') NOT NULL DEFAULT 'Fresher',
  `DISTRICT` varchar(25) NOT NULL DEFAULT 'CHENNAI',
  `RESUME` varchar(50) NOT NULL,
  `REFERRED_COMPANY` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `COMPANIES`
--
ALTER TABLE `COMPANIES`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `USERNAME` (`USERNAME`);

--
-- Indexes for table `PLACED_CANDIDATES`
--
ALTER TABLE `PLACED_CANDIDATES`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `UNPLACED_CANDIDATES`
--
ALTER TABLE `UNPLACED_CANDIDATES`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `NUMBER` (`NUMBER`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `COMPANIES`
--
ALTER TABLE `COMPANIES`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `UNPLACED_CANDIDATES`
--
ALTER TABLE `UNPLACED_CANDIDATES`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
