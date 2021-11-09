-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2021 at 11:05 AM
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
-- Database: `vaccination`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `phone` int(8) NOT NULL,
  `id_number` bigint(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `name`, `email`, `phone`, `id_number`, `date`) VALUES
(1, 'Deividas Urbanavičius', 'deividelis7@gmail.com', 68115379, 39513254465, '2021-10-30 09:25:00'),
(5, 'Petras Petrauskas', 'petraitis@petras.lt', 68845466, 38512313213, '2021-11-30 14:41:00'),
(7, 'Zita Zitavytė', 'zita123@gmail.com', 54654654, 49512123132, '2021-11-30 19:37:00'),
(8, 'Paulius Paulauskas', 'paulius@gmail.com', 65151515, 37515156156, '2021-12-05 05:44:00'),
(9, 'Aidas Aidauskas', 'aidas@gmail.com', 69887846, 32046545646, '2021-12-05 04:26:00'),
(10, 'Antanas Smetona', 'antanelis@gmail.com', 67896541, 34512121978, '2021-12-05 11:56:00'),
(11, 'Nerijus Nerijauskas', 'nerijus@gmail.com', 65456156, 37426454561, '2021-11-30 17:44:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
