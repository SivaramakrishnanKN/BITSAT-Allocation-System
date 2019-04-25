-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2019 at 04:31 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bitsat`
--

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `BranchID` varchar(2) NOT NULL,
  `BranchName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`BranchID`, `BranchName`) VALUES
('A3', 'Civil'),
('A7', 'Computer Science'),
('AA', 'ECE');

-- --------------------------------------------------------

--
-- Table structure for table `college`
--

CREATE TABLE `college` (
  `CollegeID` varchar(1) NOT NULL,
  `Campus` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `college`
--

INSERT INTO `college` (`CollegeID`, `Campus`) VALUES
('G', 'Goa'),
('H', 'Hyderabad'),
('P', 'Pilani');

-- --------------------------------------------------------

--
-- Table structure for table `collegebranch`
--

CREATE TABLE `collegebranch` (
  `CollegeID` varchar(1) NOT NULL,
  `BranchID` varchar(2) NOT NULL,
  `TotalSeats` int(11) NOT NULL,
  `OccupiedSeats` int(11) NOT NULL,
  `Cutoff` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `collegebranch`
--

INSERT INTO `collegebranch` (`CollegeID`, `BranchID`, `TotalSeats`, `OccupiedSeats`, `Cutoff`) VALUES
('G', 'A3', 40, 1, 280),
('G', 'A7', 2, 2, 350),
('H', 'A7', 10, 0, 350),
('H', 'AA', 10, 0, 330),
('P', 'A3', 10, 0, 300),
('P', 'A7', 1, 0, 400);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `RegNo` int(11) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Email` varchar(20) NOT NULL,
  `Password` varchar(8) NOT NULL,
  `DOB` date NOT NULL,
  `MarksPhy` int(11) NOT NULL,
  `MarksChem` int(11) NOT NULL,
  `MarksMath` int(11) NOT NULL,
  `Total` int(11) DEFAULT NULL,
  `Rank` int(11) DEFAULT NULL,
  `InstiID` varchar(1) DEFAULT NULL,
  `BranchID` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`RegNo`, `Name`, `Email`, `Password`, `DOB`, `MarksPhy`, `MarksChem`, `MarksMath`, `Total`, `Rank`, `InstiID`, `BranchID`) VALUES
(1, 'Sivaramakrishnan', 'siva@gmail.com', 'password', '1999-02-12', 99, 100, 100, 299, 1, 'G', 'A7'),
(2, 'ASfni', 'rasfa@safo.com', 'password', '2112-04-21', 100, 99, 97, 296, 3, 'G', 'A3'),
(3, 'Pokemon', 'poke@mon.com', 'password', '1412-02-21', 100, 98, 99, 297, 2, 'G', 'A7');

-- --------------------------------------------------------

--
-- Table structure for table `studentpreference`
--

CREATE TABLE `studentpreference` (
  `RegNo` int(11) NOT NULL,
  `CollegeID` varchar(1) NOT NULL,
  `BranchID` varchar(2) NOT NULL,
  `PreferenceNo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentpreference`
--

INSERT INTO `studentpreference` (`RegNo`, `CollegeID`, `BranchID`, `PreferenceNo`) VALUES
(1, 'G', 'A7', 1),
(2, 'G', 'A7', 1),
(3, 'G', 'A7', 1),
(1, 'G', 'A3', 2),
(2, 'G', 'A3', 2),
(3, 'G', 'A3', 2),
(1, 'H', 'A7', 3),
(2, 'H', 'A7', 3),
(3, 'H', 'A7', 3),
(1, 'H', 'AA', 4),
(2, 'H', 'AA', 4),
(3, 'H', 'AA', 4),
(1, 'P', 'A3', 5),
(2, 'P', 'A3', 5),
(3, 'P', 'A3', 5),
(1, 'P', 'A7', 6),
(2, 'P', 'A7', 6),
(3, 'P', 'A7', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`BranchID`);

--
-- Indexes for table `college`
--
ALTER TABLE `college`
  ADD PRIMARY KEY (`CollegeID`);

--
-- Indexes for table `collegebranch`
--
ALTER TABLE `collegebranch`
  ADD PRIMARY KEY (`CollegeID`,`BranchID`),
  ADD KEY `CollegeID` (`CollegeID`) USING BTREE,
  ADD KEY `BranchID` (`BranchID`) USING BTREE;

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`RegNo`);

--
-- Indexes for table `studentpreference`
--
ALTER TABLE `studentpreference`
  ADD PRIMARY KEY (`RegNo`,`CollegeID`,`BranchID`),
  ADD KEY `RegNo` (`RegNo`) USING BTREE,
  ADD KEY `CollegeID` (`CollegeID`) USING BTREE,
  ADD KEY `BranchID` (`BranchID`) USING BTREE,
  ADD KEY `PreferenceNo` (`PreferenceNo`) USING BTREE;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `collegebranch`
--
ALTER TABLE `collegebranch`
  ADD CONSTRAINT `FK1` FOREIGN KEY (`BranchID`) REFERENCES `branch` (`BranchID`),
  ADD CONSTRAINT `FK2` FOREIGN KEY (`CollegeID`) REFERENCES `college` (`CollegeID`);

--
-- Constraints for table `studentpreference`
--
ALTER TABLE `studentpreference`
  ADD CONSTRAINT `f1` FOREIGN KEY (`RegNo`) REFERENCES `student` (`RegNo`),
  ADD CONSTRAINT `f2` FOREIGN KEY (`BranchID`) REFERENCES `collegebranch` (`BranchID`),
  ADD CONSTRAINT `f3` FOREIGN KEY (`CollegeID`) REFERENCES `collegebranch` (`CollegeID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
