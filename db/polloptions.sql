-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2023 at 01:14 AM
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
-- Table structure for table `polloptions`
--

CREATE TABLE `polloptions` (
  `oid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `options` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `polloptions`
--

INSERT INTO `polloptions` (`oid`, `pid`, `options`) VALUES
(174, 87, ' Paris'),
(175, 87, 'Rome'),
(176, 87, 'Madrid'),
(177, 87, 'London'),
(178, 88, 'Pacific Ocean'),
(179, 88, 'Atlantic Ocean'),
(180, 88, 'Indian Ocean'),
(181, 88, 'Arctic Ocean'),
(182, 89, 'Pop'),
(183, 89, 'Rock'),
(184, 89, 'Hip-hop'),
(185, 90, 'Spanish'),
(186, 90, 'Portuguese'),
(187, 91, 'Car'),
(188, 91, 'Bicycle'),
(189, 91, 'Public transportation'),
(190, 91, 'Walking'),
(191, 92, 'J.K. Rowling'),
(192, 92, 'Stephen King'),
(193, 92, 'Jane Austen'),
(194, 93, 'Winston Smith'),
(195, 93, 'Big Brother'),
(196, 93, 'Julia'),
(197, 93, 'Brien'),
(198, 94, 'Asia'),
(199, 94, 'Europe'),
(200, 94, 'Africa'),
(201, 95, 'Australia'),
(202, 95, 'Canada'),
(203, 95, 'Brazil'),
(204, 96, 'Albert Einstein'),
(205, 96, 'Isaac Newton'),
(206, 96, 'Galileo Galilei'),
(207, 96, 'Nikola Tesla'),
(208, 97, 'Yes'),
(209, 97, 'No'),
(210, 98, 'Yes'),
(211, 98, 'No'),
(212, 99, 'Venus'),
(213, 99, 'Mercury'),
(214, 99, 'Mars'),
(215, 99, 'Jupiter'),
(216, 100, 'Ag'),
(217, 100, 'Si'),
(218, 100, 'Au'),
(219, 100, 'Ag2'),
(220, 101, 'Egypt'),
(221, 101, 'Mexico'),
(222, 102, 'Action'),
(223, 102, 'Comedy'),
(224, 102, 'Drama'),
(225, 102, 'Science fiction'),
(226, 103, 'Lionel Messi'),
(227, 103, 'Cristiano Ronaldo'),
(228, 104, 'Instagram'),
(229, 104, 'TikTok'),
(230, 104, 'Snapchat');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `polloptions`
--
ALTER TABLE `polloptions`
  ADD PRIMARY KEY (`oid`),
  ADD KEY `FK to pollquestions` (`pid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `polloptions`
--
ALTER TABLE `polloptions`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=231;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
