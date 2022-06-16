-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2022 at 12:00 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpcrud`
--

-- --------------------------------------------------------

--
-- Table structure for table `publish`
--

CREATE TABLE `publish` (
  `usersid` int(11) NOT NULL,
  `usersText` text NOT NULL,
  `usersDTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `usersName` varchar(255) NOT NULL,
  `userHome` varchar(255) NOT NULL,
  `usersEmail` varchar(255) NOT NULL,
  `usersUid` varchar(255) NOT NULL,
  `usersPwd` varchar(255) NOT NULL,
  `usersReference` varchar(255) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `usersName`, `userHome`, `usersEmail`, `usersUid`, `usersPwd`, `usersReference`, `status`) VALUES
(1, 'Greg Ian S. Florenosos', '', 'gregianflorenosos21@gmail.com', 'gregian530', '$2y$10$5j2H5aFb7X72sYCk.AzRTOKbEeFMItwoc5wsY8m4w3itSXdd6dbiy', 'admin', 1),
(2, 'Greg Florenosos', 'Cebu City', 'greg@gmail.com', 'gregian531', '$2y$10$GCkLxvevClw6JfZa8AnH1.L1Vhx4ZXUFip1gLfimQrx7d9ezF.nDe', 'admin', 0),
(4, 'Jian Florenosos', 'Cebu City', 'jian@gmail.com', 'jian530142', '$2y$10$FD9XGdiGoAxQQsQ8SzpLUOTXD9qMQIQLtf0tArqH3iehAypiYXItq', 'member', 1),
(5, 'Mary Joy', 'Cebu City', 'mary@gmail.com', 'mary1111', '$2y$10$EsNlLSmKOLEU0q9cZWoePe9qFM6XYvr78wnhM6TdXdzDeFCbi4fLi', 'member', 1),
(6, 'Ian Florenosos', 'Cebu, City', 'ian@gmail.com', 'gregian532', '$2y$10$5xb7.G9THE2S9yKzgTg57eU.Wf0N4qK3C4PsJ/xn.O.zPh1MgGWvC', 'member', 0),
(7, 'Gabriel Florenosos', 'Cebu City', 'gabriel@gmail.com', 'gab1111', '$2y$10$FShhS2DDRqoft8ZXTEPjZ.taZkRss73i5VgYsboLBaLrf4xtiCbtS', 'member', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `publish`
--
ALTER TABLE `publish`
  ADD PRIMARY KEY (`usersid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `publish`
--
ALTER TABLE `publish`
  MODIFY `usersid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
