-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 26, 2023 at 12:31 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

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

-- --------------------------------------------------------

--
-- Table structure for table `pollquestions`
--

CREATE TABLE `pollquestions` (
  `pid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `questions` text NOT NULL,
  `endBy` varchar(50) NOT NULL,
  `endDate` varchar(100) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `votes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pollquestions`
--

INSERT INTO `pollquestions` (`pid`, `uid`, `questions`, `endBy`, `endDate`, `status`, `votes`) VALUES
(87, 13, 'What is the capital of France?', 'date', '2023-12-29', 'open', 9),
(88, 13, 'Which is the largest ocean on Earth?', 'stopbtn', NULL, 'open', 4),
(89, 13, 'What is your favorite genre of music?', 'stopbtn', NULL, 'open', 4),
(90, 14, 'What is the primary language spoken in Brazil?', 'date', '2023-12-29', 'open', 2),
(91, 14, 'Which is your preferred mode of transportation?', 'stopbtn', NULL, 'open', 3),
(92, 14, 'Who is your favorite author?', 'date', '2023-12-31', 'open', 3),
(93, 15, 'Who is the main character in the novel \"1984\"?', 'stopbtn', NULL, 'open', 1),
(94, 15, 'What is the largest continent on Earth?', 'date', '2023-12-28', 'open', 3),
(95, 16, 'Which country is home to the kangaroo?', 'stopbtn', NULL, 'open', 3),
(96, 19, 'Which famous scientist developed the theory of relativity?', 'stopbtn', NULL, 'open', 2),
(97, 20, 'Should college education be tuition-free?', 'stopbtn', NULL, 'open', 4),
(98, 20, 'Should the use of plastic bags be banned?', 'date', '2023-12-31', 'open', 2),
(99, 21, 'Which planet is known as the \"Morning Star\" or \"Evening Star\"?', 'date', '2023-12-29', 'open', 2),
(100, 22, 'What is the chemical symbol for silver?', 'stopbtn', NULL, 'close', 2),
(101, 22, 'Which country is famous for the pyramids of Giza?', 'date', '2024-01-17', 'open', 2),
(102, 23, 'What is your favorite movie genre?', 'stopbtn', NULL, 'open', 1),
(103, 24, 'Who is the best football player?', 'stopbtn', NULL, 'open', 1),
(104, 24, 'What is your preferred social media platform?', 'stopbtn', NULL, 'open', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `email`, `password`) VALUES
(13, 'John', 'johnsmith@gmail.com', '$2y$10$sPpTea1c4vHJc4fVLIoO0e6FEKjaFbsUX7.ACINJwoOPuK9wwbixS'),
(14, 'Emily', 'emily@gmail.com', '$2y$10$NwvZzk5c/r6hDmO7zRkbGO.c/ja.L2F9nyT8ZJ2cReUwJyCukZPnu'),
(15, 'Michael', 'michael@gmail.com', '$2y$10$fXJEst9tb/en4xlJEFreAOtOf/RbWTLngLe5p9CIZHn8do/TGgbdG'),
(16, 'Sarah', 'sarah@gmail.com', '$2y$10$S/uz0aoAtwb9N9E3OkWkw.NesfnSsGPGbIPwdudzHe.HOuH2om1wC'),
(19, 'david', 'david@gmail.com', '$2y$10$2RRGpm3n9xyKKkgbo5bwA.JOgCH.m3ACtnTYFM/rPPcx2jnzTCyry'),
(20, 'Jennifer', 'jennifer@gmail.com', '$2y$10$5XsInsp.qk4eZbIN4wCSPuWyyzPAi69LvuYJjjQG5a2ht9AHTEh0a'),
(21, 'Christopher', 'christopher@gmail.com', '$2y$10$7hm8bX/FjdduPtRrm28U0.YOQE505COAqwZqELMtsc4P7qHxO/fQ6'),
(22, 'Jessica', 'jessica@gmail.com', '$2y$10$GlK5hGEvNu089GPbgPGWtOZGmujkOVaGCbqWf2V3xGw1fYSDKElkW'),
(23, 'Matthew', 'matthew@gmail.com', '$2y$10$rj.jUbfysO4levokiUjnOOxKHZZE5yDxqE0nJZhHOk6z3Ec/mvEny'),
(24, 'Olivia', 'olivia@gmail.com', '$2y$10$6tM3mCcMwoPAB71Y6JJUYOgv8dwOrirK9K8/rfs1pqJ8jFiGwnY/.');

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
-- Indexes for table `polloptions`
--
ALTER TABLE `polloptions`
  ADD PRIMARY KEY (`oid`),
  ADD KEY `FK to pollquestions` (`pid`);

--
-- Indexes for table `pollquestions`
--
ALTER TABLE `pollquestions`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `Foreign Key` (`uid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `email` (`email`);

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
-- AUTO_INCREMENT for table `polloptions`
--
ALTER TABLE `polloptions`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=231;

--
-- AUTO_INCREMENT for table `pollquestions`
--
ALTER TABLE `pollquestions`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `vote`
--
ALTER TABLE `vote`
  MODIFY `vid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pollquestions`
--
ALTER TABLE `pollquestions`
  ADD CONSTRAINT `Foreign Key` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`);

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
