-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2022 at 12:09 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpexercise`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategoriya`
--

CREATE TABLE `kategoriya` (
  `id` int(11) NOT NULL,
  `kat_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kategoriya`
--

INSERT INTO `kategoriya` (`id`, `kat_name`) VALUES
(1, 'Kommunal'),
(2, 'Telefon'),
(3, 'İnternet'),
(4, 'Bank xidmətləri'),
(5, 'Sığorta'),
(6, 'Əyləncə'),
(7, 'Təhsil'),
(8, 'Mərc oyunları'),
(9, 'Xeyriyyəçilik'),
(10, 'Hüquq xidmətləri'),
(11, 'Əmlak'),
(12, 'Otellər'),
(13, 'Taksi');

-- --------------------------------------------------------

--
-- Table structure for table `odenis`
--

CREATE TABLE `odenis` (
  `id` int(11) NOT NULL,
  `nov` int(11) NOT NULL,
  `kategoriya` int(11) NOT NULL,
  `valyuta` int(11) NOT NULL,
  `mebleg` double NOT NULL,
  `rey` text NOT NULL,
  `tarix` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `odenis`
--

INSERT INTO `odenis` (`id`, `nov`, `kategoriya`, `valyuta`, `mebleg`, `rey`, `tarix`) VALUES
(1, 1, 1, 1, 450, '', '2022-04-14 13:22:31'),
(2, 1, 7, 3, 457, 'ela', '2022-04-17 13:49:26'),
(3, 1, 1, 1, 543, '', '2022-04-17 13:57:24'),
(4, 2, 1, 5, 4000, '', '2022-04-17 13:58:12'),
(5, 1, 3, 1, 200, '', '2022-04-17 14:50:48'),
(6, 2, 6, 3, 100, '', '2022-04-17 14:51:14'),
(7, 2, 5, 4, 300, '', '2022-04-17 14:53:04'),
(8, 2, 8, 2, 500, 'heyf\r\n', '2022-04-17 14:57:41'),
(9, 1, 4, 2, 135, 'bjbdv', '2022-04-17 15:18:58'),
(10, 1, 1, 4, 247, '', '2022-04-17 15:20:13'),
(11, 2, 1, 5, 1386, '', '2022-04-17 15:29:43'),
(12, 2, 7, 3, 35, '', '2022-04-17 15:53:08'),
(13, 2, 9, 1, 233, '', '2022-04-17 15:54:28'),
(14, 1, 12, 4, 778, '', '2022-04-17 16:29:44'),
(15, 2, 11, 2, 350, 'tesekkurler', '2022-04-17 16:34:13'),
(16, 1, 4, 4, 1678, 'nhnh', '2022-04-17 17:20:19'),
(17, 1, 4, 3, 400, ',kkm,k', '2022-04-17 20:32:03'),
(18, 1, 7, 1, 120, 'jkj', '2022-04-17 20:33:28'),
(19, 2, 5, 1, 23, 'fvfv', '2022-04-17 20:35:31'),
(20, 2, 6, 4, 466, 'nnmm', '2022-04-17 20:43:25'),
(21, 2, 12, 4, 455, '', '2022-04-17 20:45:24'),
(22, 1, 1, 1, 123, '', '2022-04-17 20:48:40'),
(23, 1, 2, 1, 23, '', '2022-04-17 20:56:18'),
(24, 2, 10, 1, 88, 'okuj', '2022-04-17 21:05:40'),
(25, 1, 1, 1, 23, '2gfbgb', '2022-04-17 21:11:21'),
(26, 1, 1, 1, 67, 'hnh', '2022-04-17 21:12:27'),
(27, 2, 3, 3, 109, 'jghk', '2022-04-17 21:13:43'),
(28, 2, 11, 4, 343, 'fgf', '2022-04-17 21:16:22'),
(29, 1, 7, 1, 335, 'gffgg', '2022-04-17 21:17:46'),
(30, 2, 8, 5, 5656, '', '2022-04-17 21:23:10'),
(31, 1, 5, 2, 36, 'ghghg', '2022-04-17 21:25:02'),
(32, 1, 4, 1, 344, 'gghhj', '2022-04-17 21:29:54'),
(33, 2, 1, 4, 435, 'cdcs ', '2022-04-17 23:10:00'),
(34, 1, 7, 3, 34, 'vvf vv', '2022-04-17 23:11:20'),
(35, 1, 1, 3, 433, 'rfbgfb gf', '2022-04-17 23:47:54'),
(36, 2, 1, 2, 67, 'elA', '2022-04-17 23:49:27');

-- --------------------------------------------------------

--
-- Table structure for table `odenis_novu`
--

CREATE TABLE `odenis_novu` (
  `id` int(11) NOT NULL,
  `odn_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `odenis_novu`
--

INSERT INTO `odenis_novu` (`id`, `odn_name`) VALUES
(1, 'Mədaxil'),
(2, 'Məxaric');

-- --------------------------------------------------------

--
-- Table structure for table `valyuta`
--

CREATE TABLE `valyuta` (
  `id` int(11) NOT NULL,
  `val_name` varchar(3) NOT NULL,
  `full_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `valyuta`
--

INSERT INTO `valyuta` (`id`, `val_name`, `full_name`) VALUES
(1, 'AZN', 'Azərbaycan manatı'),
(2, 'USD', 'ABŞ dolları'),
(3, 'EUR', 'Avro'),
(4, 'TRY', 'Türk lirəsi'),
(5, 'RUB', 'Rusiya rublu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategoriya`
--
ALTER TABLE `kategoriya`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `odenis`
--
ALTER TABLE `odenis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategoriya` (`kategoriya`),
  ADD KEY `nov` (`nov`),
  ADD KEY `valyuta` (`valyuta`);

--
-- Indexes for table `odenis_novu`
--
ALTER TABLE `odenis_novu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `valyuta`
--
ALTER TABLE `valyuta`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategoriya`
--
ALTER TABLE `kategoriya`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `odenis`
--
ALTER TABLE `odenis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `odenis_novu`
--
ALTER TABLE `odenis_novu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `valyuta`
--
ALTER TABLE `valyuta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `odenis`
--
ALTER TABLE `odenis`
  ADD CONSTRAINT `odenis_ibfk_1` FOREIGN KEY (`kategoriya`) REFERENCES `kategoriya` (`id`),
  ADD CONSTRAINT `odenis_ibfk_2` FOREIGN KEY (`nov`) REFERENCES `odenis_novu` (`id`),
  ADD CONSTRAINT `odenis_ibfk_3` FOREIGN KEY (`valyuta`) REFERENCES `valyuta` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
