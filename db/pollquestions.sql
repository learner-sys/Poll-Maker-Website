-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2023 at 01:13 AM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pollquestions`
--
ALTER TABLE `pollquestions`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `Foreign Key` (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pollquestions`
--
ALTER TABLE `pollquestions`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pollquestions`
--
ALTER TABLE `pollquestions`
  ADD CONSTRAINT `Foreign Key` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
