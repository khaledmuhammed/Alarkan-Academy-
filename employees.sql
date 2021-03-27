-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2019 at 02:24 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `academia_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(155) NOT NULL,
  `type` varchar(12) NOT NULL,
  `phone` varchar(155) NOT NULL,
  `address` longtext NOT NULL,
  `salary` varchar(128) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `type`, `phone`, `address`, `salary`, `start_date`, `end_date`, `status`) VALUES
(1, 'Mohamed Ahmed', 'Lecturer', '0112566456', 'cdsdsds', '2000', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(2, 'Ahmed Salah', 'Officer', '01008895654', 'cdsdsds', '3000', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(3, '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(4, 'kahled ahmed', 'Officer', '010008881414', 'dsaflsa;jdflakjdadass', '5000', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(5, 'kahled ahmed', 'Officer', '010008881414', 'dsaflsa;jdflakjdadass', '5000', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(6, 'mohamed salah', 'Officer', '010008881414', '68dsakhjdkas', '5000', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(7, 'mohamed salah', 'Officer', '010008881414', '68dsakhjdkas', '5000', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(8, 'mohamed salah', 'Officer', '010008881414', '68dsakhjdkas', '5000', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(9, 'mohamed salah23', 'Officer', '01000888141412', '68dsakhjdkas', '12000', '2019-07-12 21:16:05', '0000-00-00 00:00:00', 1),
(10, 'rewfrds', 'Officer', '010008881414', 'refdsafds', '5000', '2019-07-12 21:18:16', '0000-00-00 00:00:00', 0),
(11, 'fdxgfsdgfdgre', 'Lecturer', '010008881414', 'wadadasda', '630', '2019-07-17 16:02:04', '0000-00-00 00:00:00', 0),
(12, 'dsadsadas', 'Lecturer', '010008881414', 'dsafdzsafsf', '500', '2019-07-17 16:01:55', '0000-00-00 00:00:00', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
