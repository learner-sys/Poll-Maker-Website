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
(24, 'Olivia', 'olivia@gmail.com', '$2y$10$6tM3mCcMwoPAB71Y6JJUYOgv8dwOrirK9K8/rfs1pqJ8jFiGwnY/.'),
(25, 'Ayesha', 'ayesha@gmail.com', '$2y$10$PcjBWEevmhzJYQ0uK58rbe0XxDGRsYlz4JjdfCrRw9VpnnQbH75jC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
