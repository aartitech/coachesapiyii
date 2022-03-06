-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2022 at 01:31 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rt`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `coache_name` varchar(255) NOT NULL,
  `booking_date` date NOT NULL,
  `time_slot` varchar(255) NOT NULL,
  `coaches_master_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `coache_name`, `booking_date`, `time_slot`, `coaches_master_id`) VALUES
(3, 'John Doe', '2022-03-04', '07:30 - 08:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `coaches_master`
--

CREATE TABLE `coaches_master` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coaches_master`
--

INSERT INTO `coaches_master` (`id`, `name`) VALUES
(1, 'John Doe'),
(2, 'Jane Doe'),
(3, 'Rachel Green'),
(4, 'Margaret Houlihan'),
(5, 'Hawkeye Pierce');

-- --------------------------------------------------------

--
-- Table structure for table `dataset`
--

CREATE TABLE `dataset` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `timezone` varchar(255) NOT NULL,
  `day_of_week` varchar(255) NOT NULL,
  `available_at` varchar(255) NOT NULL,
  `available_until` varchar(255) NOT NULL,
  `coaches_master_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dataset`
--

INSERT INTO `dataset` (`id`, `name`, `timezone`, `day_of_week`, `available_at`, `available_until`, `coaches_master_id`) VALUES
(2, 'John Doe', '(GMT-06:00) America/North_Dakota/New_Salem', 'Monday', '09:00:00', '17:30:00', 1),
(3, 'John Doe', '(GMT-06:00) America/North_Dakota/New_Salem', 'Tuesday', '08:00:00', '16:00:00', 1),
(4, 'John Doe', '(GMT-06:00) America/North_Dakota/New_Salem', 'Thursday', '09:00:00', '16:00:00', 1),
(5, 'John Doe', '(GMT-06:00) America/North_Dakota/New_Salem', 'Friday', '07:00:00', '14:00:00', 1),
(6, 'Jane Doe', '(GMT-06:00) Central Time (US & Canada)', 'Tuesday', '08:00:00', '10:00:00', 2),
(7, 'Jane Doe', '(GMT-06:00) Central Time (US & Canada)', 'Wednesday', '11:00:00', '18:00:00', 2),
(8, 'Jane Doe', '(GMT-06:00) Central Time (US & Canada)', 'Saturday', '09:00:00', '15:00:00', 2),
(9, 'Jane Doe', '(GMT-06:00) Central Time (US & Canada)', 'Sunday', '08:00:00', '15:00:00', 2),
(10, 'Rachel Green', '(GMT-09:00) America/Yakutat', 'Monday', '08:00:00', '10:00:00', 3),
(11, 'Rachel Green', '(GMT-09:00) America/Yakutat', 'Tuesday', '11:00:00', '13:00:00', 3),
(12, 'Rachel Green', '(GMT-09:00) America/Yakutat', 'Wednesday', '08:00:00', '10:00:00', 3),
(13, 'Rachel Green', '(GMT-09:00) America/Yakutat', 'Saturday', '08:00:00', '11:00:00', 3),
(14, 'Rachel Green', '(GMT-09:00) America/Yakutat', 'Sunday', '07:00:00', '09:00:00', 3),
(15, 'Margaret Houlihan', '(GMT-06:00) Central Time (US & Canada)', 'Monday', '09:00:00', '15:00:00', 4),
(16, 'Margaret Houlihan', '(GMT-06:00) Central Time (US & Canada)', 'Tuesday', '06:00:00', '13:00:00', 4),
(17, 'Margaret Houlihan', '(GMT-06:00) Central Time (US & Canada)', 'Wednesday', '06:00:00', '11:00:00', 4),
(18, 'Margaret Houlihan', '(GMT-06:00) Central Time (US & Canada)', 'Friday', '08:00:00', '12:00:00', 4),
(19, 'Margaret Houlihan', '(GMT-06:00) Central Time (US & Canada)', 'Saturday', '09:00:00', '16:00:00', 4),
(20, 'Margaret Houlihan', '(GMT-06:00) Central Time (US & Canada)', 'Sunday', '08:00:00', '10:00:00', 4),
(21, 'Hawkeye Pierce', '(GMT-06:00) Central Time (US & Canada)', 'Thursday', '07:00:00', '14:00:00', 5),
(22, 'Hawkeye Pierce', '(GMT-06:00) Central Time (US & Canada)', 'Thursday', '15:00:00', '17:00:00', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coaches_master`
--
ALTER TABLE `coaches_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dataset`
--
ALTER TABLE `dataset`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `coaches_master`
--
ALTER TABLE `coaches_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `dataset`
--
ALTER TABLE `dataset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
