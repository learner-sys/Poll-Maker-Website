-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2023 at 01:15 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pollmaker`
--

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

CREATE TABLE `vote` (
  `vid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `oid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vote`
--

INSERT INTO `vote` (`vid`, `uid`, `pid`, `oid`) VALUES
(32, 14, 89, 184),
(33, 14, 88, 178),
(34, 14, 87, 174),
(35, 15, 87, 174),
(36, 15, 88, 181),
(37, 15, 90, 186),
(38, 15, 92, 192),
(39, 15, 91, 188),
(40, 16, 87, 175),
(41, 16, 92, 193),
(42, 16, 94, 198),
(43, 19, 87, 177),
(44, 19, 89, 184),
(45, 19, 91, 190),
(46, 19, 95, 201),
(47, 20, 96, 204),
(48, 20, 95, 202),
(49, 20, 87, 176),
(50, 21, 87, 175),
(51, 21, 97, 208),
(52, 21, 98, 211),
(53, 22, 99, 212),
(54, 22, 98, 210),
(55, 22, 97, 209),
(56, 22, 96, 206),
(57, 22, 95, 203),
(58, 22, 94, 198),
(59, 22, 93, 195),
(60, 22, 92, 192),
(61, 22, 91, 189),
(62, 22, 90, 186),
(63, 22, 89, 183),
(64, 22, 88, 178),
(65, 22, 87, 177),
(66, 23, 101, 220),
(67, 23, 100, 217),
(68, 23, 97, 208),
(69, 23, 99, 215),
(70, 23, 87, 174),
(71, 23, 88, 178),
(72, 24, 101, 220),
(73, 24, 100, 219),
(74, 24, 87, 174),
(75, 24, 94, 198),
(76, 24, 89, 182),
(77, 24, 97, 208),
(78, 24, 102, 225),
(79, 22, 103, 226);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`vid`),
  ADD KEY `uid` (`uid`),
  ADD KEY `pid` (`pid`),
  ADD KEY `oid` (`oid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `vote`
--
ALTER TABLE `vote`
  MODIFY `vid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `vote_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`),
  ADD CONSTRAINT `vote_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `pollquestions` (`pid`),
  ADD CONSTRAINT `vote_ibfk_3` FOREIGN KEY (`oid`) REFERENCES `polloptions` (`oid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
