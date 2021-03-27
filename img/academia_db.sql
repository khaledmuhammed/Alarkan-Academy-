-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2019 at 05:54 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.27

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
-- Table structure for table `attendace`
--

CREATE TABLE `attendace` (
  `id` int(11) UNSIGNED NOT NULL,
  `student_id` int(11) UNSIGNED NOT NULL,
  `date` datetime NOT NULL,
  `subject` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`) VALUES
(1, 'cairo'),
(2, 'alex');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `status`) VALUES
(1, 'التمريض', 1),
(2, 'مساعد صيدلى', 1),
(3, 'أشعة', 1),
(4, 'تحاليل', 1),
(5, 'خياطة', 1),
(6, 'سباكة', 1);

-- --------------------------------------------------------

--
-- Table structure for table `department_subjects`
--

CREATE TABLE `department_subjects` (
  `id` int(11) UNSIGNED NOT NULL,
  `department_id` tinyint(3) UNSIGNED NOT NULL,
  `subjects` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department_subjects`
--

INSERT INTO `department_subjects` (`id`, `department_id`, `subjects`) VALUES
(1, 2, '{\"4\":\"subject 4\",\"2\":\"subject 2\"}'),
(2, 1, '{\"2\":\"subject 2\",\"4\":\"subject 4\"}'),
(3, 3, '{\"4\":\"subject 4\"}'),
(4, 4, '{\"3\":\"subject 3\",\"2\":\"subject 2\"}'),
(5, 5, '{\"5\":\"subject 5\"}'),
(6, 6, '{\"1\":\"subject 1\"}');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `expense_for_id` tinyint(3) UNSIGNED NOT NULL,
  `value` decimal(7,2) NOT NULL,
  `date` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `student_id`, `expense_for_id`, `value`, `date`, `status`) VALUES
(1, 2, 6, '1000.00', '2019-07-02 12:47:10', 0),
(2, 1, 6, '400.00', '2019-07-15 10:18:52', 0);

-- --------------------------------------------------------

--
-- Table structure for table `expense_for`
--

CREATE TABLE `expense_for` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expense_for`
--

INSERT INTO `expense_for` (`id`, `name`, `price`, `status`) VALUES
(1, 'ex registration form', '100.00', 1),
(2, 'ex 1st fund', '900.00', 1),
(3, 'ex 2nd fund', '2000.00', 1),
(4, 'ex trips', '0.00', 1),
(5, 'ex uniform', '0.00', 1),
(6, 'ex branch', '400.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `joining_purposes`
--

CREATE TABLE `joining_purposes` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `joining_purposes`
--

INSERT INTO `joining_purposes` (`id`, `name`, `status`) VALUES
(1, 'التعلم', 1),
(2, 'التوظيف', 1),
(3, 'التعلم والتوظيف', 1);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  `table_name` varchar(30) NOT NULL,
  `note` varchar(50) NOT NULL,
  `fun` varchar(20) NOT NULL,
  `ref_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `user_id`, `create_date`, `table_name`, `note`, `fun`, `ref_id`) VALUES
(1, 3, '2019-07-08 16:41:31', '`student`', 'del this col.', 'Add New Patient', 0),
(2, 3, '2019-07-08 16:41:31', '`student_details`', 'del this col.', 'Add New Patient', 0),
(3, 4, '2019-07-10 10:35:17', '`payment`', 'del this col.', 'Add New Patient', 0),
(4, 3, '2019-07-10 10:35:17', '`student`', '', 'Edit User Details', 0),
(5, 6, '2019-07-10 10:54:28', '`payment`', 'del this col.', 'Add New Patient', 0),
(6, 3, '2019-07-10 10:54:28', '`student`', '', 'Edit User Details', 0),
(7, 7, '2019-07-10 10:54:53', '`payment`', 'del this col.', 'Add New Patient', 0),
(8, 3, '2019-07-10 10:54:53', '`student`', '', 'Edit User Details', 0),
(9, 1, '2019-07-10 10:55:38', '`student`', '', 'Edit User Details', 0),
(10, 4, '2019-07-10 15:19:25', '`student`', 'del this col.', 'Add New Patient', 0),
(11, 4, '2019-07-10 15:19:25', '`student_details`', 'del this col.', 'Add New Patient', 0),
(12, 8, '2019-07-10 15:22:41', '`payment`', 'del this col.', 'Add New Patient', 0),
(13, 3, '2019-07-10 15:22:41', '`student`', '', 'Edit User Details', 0),
(14, 9, '2019-07-10 15:22:44', '`payment`', 'del this col.', 'Add New Patient', 0),
(15, 3, '2019-07-10 15:22:44', '`student`', '', 'Edit User Details', 0),
(16, 1, '2019-07-10 15:28:18', '`student`', '', 'Edit User Details', 0),
(17, 5, '2019-07-10 16:19:06', '`student`', 'del this col.', 'Add New Patient', 0),
(18, 5, '2019-07-10 16:19:06', '`student_details`', 'del this col.', 'Add New Patient', 0),
(19, 9, '2019-07-10 16:28:10', '`student`', 'del this col.', 'Add New Patient', 0),
(20, 6, '2019-07-10 16:28:10', '`student_details`', 'del this col.', 'Add New Patient', 0),
(21, 12, '2019-07-11 16:40:12', '`payment`', 'del this col.', 'Add New Patient', 0),
(22, 3, '2019-07-11 16:40:12', '`student`', '', 'Edit User Details', 0),
(23, 13, '2019-07-11 17:09:08', '`payment`', 'del this col.', 'Add New Patient', 0),
(24, 3, '2019-07-11 17:09:08', '`student`', '', 'Edit User Details', 0),
(25, 14, '2019-07-13 09:29:52', '`payment`', 'del this col.', 'Add New Patient', 0),
(26, 3, '2019-07-13 09:29:52', '`student`', '', 'Edit User Details', 0),
(27, 15, '2019-07-13 09:34:35', '`payment`', 'del this col.', 'Add New Patient', 0),
(28, 3, '2019-07-13 09:34:35', '`student`', '', 'Edit User Details', 0),
(29, 16, '2019-07-13 10:33:23', '`payment`', 'del this col.', 'Add New Patient', 0),
(30, 3, '2019-07-13 10:33:24', '`student`', '', 'Edit User Details', 0),
(31, 17, '2019-07-13 10:36:52', '`payment`', 'del this col.', 'Add New Patient', 0),
(32, 3, '2019-07-13 10:36:52', '`student`', '', 'Edit User Details', 0),
(33, 18, '2019-07-13 10:44:31', '`payment`', 'del this col.', 'Add New Patient', 0),
(34, 3, '2019-07-13 10:44:32', '`student`', '', 'Edit User Details', 0),
(35, 3, '2019-07-13 10:53:29', '`student`', '', 'Edit User Details', 0),
(36, 19, '2019-07-13 10:54:53', '`payment`', 'del this col.', 'Add New Patient', 0),
(37, 3, '2019-07-13 10:54:53', '`student`', '', 'Edit User Details', 0),
(38, 20, '2019-07-13 10:56:36', '`payment`', 'del this col.', 'Add New Patient', 0),
(39, 3, '2019-07-13 10:56:36', '`student`', '', 'Edit User Details', 0),
(40, 21, '2019-07-13 11:00:11', '`payment`', 'del this col.', 'Add New Patient', 0),
(41, 3, '2019-07-13 11:00:11', '`student`', '', 'Edit User Details', 0),
(42, 3, '2019-07-13 11:03:18', '`student`', '', 'Edit User Details', 0),
(43, 22, '2019-07-13 11:11:03', '`payment`', 'del this col.', 'Add New Patient', 0),
(44, 3, '2019-07-13 11:11:03', '`student`', '', 'Edit User Details', 0),
(45, 23, '2019-07-13 11:23:33', '`payment`', 'del this col.', 'Add New Patient', 0),
(46, 3, '2019-07-13 11:23:33', '`student`', '', 'Edit User Details', 0),
(47, 3, '2019-07-13 11:25:13', '`student`', '', 'Edit User Details', 0),
(48, 10, '2019-07-13 11:38:24', '`student`', 'del this col.', 'Add New Patient', 0),
(49, 7, '2019-07-13 11:38:24', '`student_details`', 'del this col.', 'Add New Patient', 0),
(50, 3, '2019-07-13 12:33:40', '`student`', '', 'Edit User Details', 0),
(51, 1, '2019-07-13 14:57:41', '`results`', '', 'Edit User Details', 0),
(52, 1, '2019-07-13 15:13:28', '`results`', '', 'Edit User Details', 0),
(53, 3, '2019-07-14 15:58:32', '`student`', '', 'Edit User Details', 0),
(54, 3, '2019-07-15 09:54:03', '`expense_for`', '', 'Edit User Details', 0),
(55, 11, '2019-07-15 13:17:43', '`student`', 'del this col.', 'Add New Patient', 0),
(56, 8, '2019-07-15 13:17:43', '`student_details`', 'del this col.', 'Add New Patient', 0),
(57, 12, '2019-07-15 13:21:38', '`student`', 'del this col.', 'Add New Patient', 0),
(58, 9, '2019-07-15 13:21:38', '`student_details`', 'del this col.', 'Add New Patient', 0),
(59, 2, '2019-07-15 15:25:37', '`results`', 'del this col.', 'Add New Patient', 0),
(60, 3, '2019-07-15 15:29:22', '`results`', 'del this col.', 'Add New Patient', 0),
(61, 4, '2019-07-15 15:29:22', '`results`', 'del this col.', 'Add New Patient', 0),
(62, 5, '2019-07-15 15:29:23', '`results`', 'del this col.', 'Add New Patient', 0),
(63, 6, '2019-07-15 15:29:23', '`results`', 'del this col.', 'Add New Patient', 0),
(64, 7, '2019-07-15 15:29:23', '`results`', 'del this col.', 'Add New Patient', 0),
(65, 8, '2019-07-15 15:29:23', '`results`', 'del this col.', 'Add New Patient', 0),
(66, 13, '2019-07-15 15:42:45', '`student`', 'del this col.', 'Add New Patient', 0),
(67, 10, '2019-07-15 15:42:45', '`student_details`', 'del this col.', 'Add New Patient', 0),
(68, 14, '2019-07-15 15:53:25', '`student`', 'del this col.', 'Add New Patient', 0),
(69, 11, '2019-07-15 15:53:25', '`student_details`', 'del this col.', 'Add New Patient', 0),
(70, 9, '2019-07-15 16:16:20', '`results`', 'del this col.', 'Add New Patient', 0),
(71, 10, '2019-07-15 16:16:20', '`results`', 'del this col.', 'Add New Patient', 0),
(72, 11, '2019-07-15 16:16:20', '`results`', 'del this col.', 'Add New Patient', 0),
(73, 12, '2019-07-15 16:18:15', '`results`', 'del this col.', 'Add New Patient', 0),
(74, 13, '2019-07-15 16:18:15', '`results`', 'del this col.', 'Add New Patient', 0),
(75, 14, '2019-07-15 16:18:16', '`results`', 'del this col.', 'Add New Patient', 0),
(76, 15, '2019-07-15 16:35:23', '`results`', 'del this col.', 'Add New Patient', 0),
(77, 16, '2019-07-15 16:35:23', '`results`', 'del this col.', 'Add New Patient', 0),
(78, 17, '2019-07-15 16:35:24', '`results`', 'del this col.', 'Add New Patient', 0),
(79, 18, '2019-07-15 16:35:32', '`results`', 'del this col.', 'Add New Patient', 0),
(80, 19, '2019-07-15 16:35:32', '`results`', 'del this col.', 'Add New Patient', 0),
(81, 20, '2019-07-15 16:35:32', '`results`', 'del this col.', 'Add New Patient', 0),
(82, 21, '2019-07-15 16:39:20', '`results`', 'del this col.', 'Add New Patient', 0),
(83, 22, '2019-07-15 16:39:20', '`results`', 'del this col.', 'Add New Patient', 0),
(84, 23, '2019-07-15 16:39:20', '`results`', 'del this col.', 'Add New Patient', 0),
(85, 24, '2019-07-15 16:41:08', '`results`', 'del this col.', 'Add New Patient', 0),
(86, 25, '2019-07-15 16:41:08', '`results`', 'del this col.', 'Add New Patient', 0),
(87, 26, '2019-07-15 16:41:08', '`results`', 'del this col.', 'Add New Patient', 0),
(88, 27, '2019-07-15 16:43:05', '`results`', 'del this col.', 'Add New Patient', 0),
(89, 28, '2019-07-15 16:43:05', '`results`', 'del this col.', 'Add New Patient', 0),
(90, 29, '2019-07-15 16:43:05', '`results`', 'del this col.', 'Add New Patient', 0),
(91, 30, '2019-07-15 17:50:29', '`results`', 'del this col.', 'Add New Patient', 0),
(92, 31, '2019-07-15 17:50:29', '`results`', 'del this col.', 'Add New Patient', 0),
(93, 32, '2019-07-15 17:50:29', '`results`', 'del this col.', 'Add New Patient', 0);

-- --------------------------------------------------------

--
-- Table structure for table `lost_cards`
--

CREATE TABLE `lost_cards` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `image` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lost_cards`
--

INSERT INTO `lost_cards` (`id`, `student_id`, `image`) VALUES
(12, 1, 'img/yafta.jpg'),
(13, 1, 'img/yafta-s.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `military_status`
--

CREATE TABLE `military_status` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `military_status`
--

INSERT INTO `military_status` (`id`, `name`, `status`) VALUES
(1, 'إعفاء', 1),
(2, 'مطلوب', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) UNSIGNED NOT NULL,
  `student_id` int(11) NOT NULL,
  `pay_for_id` tinyint(3) UNSIGNED NOT NULL,
  `value` decimal(7,2) NOT NULL,
  `date` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `student_id`, `pay_for_id`, `value`, `date`, `status`) VALUES
(1, 1, 8, '1000.00', '2019-07-02 10:20:43', 1),
(3, 2, 2, '1000.00', '2019-07-02 11:36:22', 1),
(5, 3, 2, '1000.00', '2019-07-10 00:00:00', 1),
(10, 9, 1, '100.00', '2019-07-10 16:28:10', 1),
(12, 3, 2, '1000.00', '2019-07-11 16:40:12', 1),
(19, 2, 2, '1000.00', '2019-07-13 10:54:53', 1),
(24, 10, 1, '100.00', '2019-07-13 11:38:24', 1),
(25, 10, 2, '1000.00', '2019-07-13 11:38:24', 1),
(27, 1, 6, '200.00', '2019-07-04 00:00:00', 1),
(38, 1, 6, '200.00', '2019-07-14 12:42:12', 0),
(39, 1, 6, '200.00', '2019-07-14 12:48:19', 0),
(40, 11, 1, '100.00', '2019-07-15 13:17:44', 0),
(41, 11, 1, '1000.00', '2019-07-15 13:17:44', 0),
(42, 12, 1, '100.00', '2019-07-15 13:21:39', 0),
(43, 12, 1, '1000.00', '2019-07-15 13:21:39', 0),
(44, 13, 1, '100.00', '2019-07-15 15:42:45', 0),
(45, 13, 1, '1000.00', '2019-07-15 15:42:45', 0),
(46, 14, 1, '100.00', '2019-07-15 15:53:25', 0),
(47, 14, 1, '1000.00', '2019-07-15 15:53:25', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pay_for`
--

CREATE TABLE `pay_for` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pay_for`
--

INSERT INTO `pay_for` (`id`, `name`, `price`, `status`) VALUES
(1, 'registration form', '100.00', 1),
(2, '1st fund', '1000.00', 1),
(3, '2nd fund', '2000.00', 1),
(4, 'trips', '0.00', 1),
(5, 'uniform', '500.00', 1),
(6, 'Lost Crad', '200.00', 1),
(7, 'collection', '300.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `qualifications`
--

CREATE TABLE `qualifications` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `qualifications`
--

INSERT INTO `qualifications` (`id`, `name`, `status`) VALUES
(1, 'ثانوية عامة', 1),
(2, 'ثانوية أزهري', 1),
(3, 'ثانوية تجارية', 1);

-- --------------------------------------------------------

--
-- Table structure for table `relation_status`
--

CREATE TABLE `relation_status` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `relation_status`
--

INSERT INTO `relation_status` (`id`, `name`, `status`) VALUES
(1, 'الزوج', 1),
(2, 'الأب', 1);

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`id`, `name`, `status`) VALUES
(1, 'فيس بوك', 1),
(2, 'أخرى', 1);

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(11) UNSIGNED NOT NULL,
  `student_barcode_id` int(11) NOT NULL,
  `year` year(4) NOT NULL,
  `subject_id` tinyint(3) UNSIGNED NOT NULL,
  `midterm` varchar(28) NOT NULL,
  `activity` tinyint(3) UNSIGNED DEFAULT NULL,
  `attendace` tinyint(3) UNSIGNED DEFAULT NULL,
  `final` varchar(28) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `student_barcode_id`, `year`, `subject_id`, `midterm`, `activity`, `attendace`, `final`) VALUES
(30, 1, 2020, 2, '12\r', NULL, NULL, '12\r'),
(31, 2, 2020, 2, '', NULL, NULL, '25\r'),
(32, 300, 2020, 2, '', NULL, NULL, '140\r');

-- --------------------------------------------------------

--
-- Table structure for table `site_setting`
--

CREATE TABLE `site_setting` (
  `id` int(11) NOT NULL,
  `skin` varchar(70) NOT NULL COMMENT 'Skins [skin-blue, skin-black, skin-purple, skin-green, skin-red, skin-yellow, skin-blue-light, skin-black-light, skin-purple-light, skin-green-light, skin-red-light, skin-yellow-light]',
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `site_setting`
--

INSERT INTO `site_setting` (`id`, `skin`, `status`) VALUES
(1, 'skin-purple-light', 1);

-- --------------------------------------------------------

--
-- Table structure for table `social_status`
--

CREATE TABLE `social_status` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `social_status`
--

INSERT INTO `social_status` (`id`, `name`, `status`) VALUES
(1, 'متزوج', 1),
(2, 'أعزب', 1);

-- --------------------------------------------------------

--
-- Table structure for table `specializations`
--

CREATE TABLE `specializations` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `specializations`
--

INSERT INTO `specializations` (`id`, `name`, `status`) VALUES
(1, 'أدبي', 1),
(2, 'علمي', 1),
(3, 'شريعة', 1),
(4, 'أخرى', 1),
(5, 'شريعة وقانون', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `name_ar` varchar(255) DEFAULT NULL,
  `national_id` varchar(15) NOT NULL,
  `barcode_id` varchar(255) NOT NULL,
  `image` varchar(500) DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL,
  `branch_id` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `name`, `name_ar`, `national_id`, `barcode_id`, `image`, `status`, `branch_id`, `date`) VALUES
(1, 'NOHA MOHAMED MOHAMED ELHOSINY SHIRF ', 'نهى محمد محمد الحسينى شريف', '2345678912345', '123456789', 'img/1.jpg', 6, 2, '2019-07-10 00:00:00'),
(2, 'MOHAMED MOHAMED ELHOSINY SHIRF ', ' محمد محمد الحسينى شريف', '2345678912348', '123456781', NULL, 2, 1, '0000-00-00 00:00:00'),
(3, 'khaled mohamed mostafa', 'خالد محمد مصطفى', '111111111111111', '111111111111', 'img/yafta-s.jpg', 2, 1, '0000-00-00 00:00:00'),
(9, 'karem', 'كريم', '44444444444444', '5555555555555', NULL, 1, 1, '0000-00-00 00:00:00'),
(10, 'test', 'تيست', '989565989565', '88766979', NULL, 2, 1, '0000-00-00 00:00:00'),
(11, 'ahmed mostafa', 'احمد مصطفي', '7979498646464', '5545484851', NULL, 1, 2, '0000-00-00 00:00:00'),
(12, 'mohamed salah', 'محمد صلاح', '2342', '3242342', NULL, 1, 1, '0000-00-00 00:00:00'),
(13, 'testt', 'ٍ]لسيليس', '5678568', '97896', NULL, 1, 1, '0000-00-00 00:00:00'),
(14, 'ggggg', 'ٍ]لسيليس', '435435', '4354', NULL, 1, 1, '2019-07-15 15:53:25');

-- --------------------------------------------------------

--
-- Table structure for table `student_details`
--

CREATE TABLE `student_details` (
  `id` int(11) UNSIGNED NOT NULL,
  `student_id` int(11) UNSIGNED NOT NULL,
  `ph_num_one` varchar(15) NOT NULL,
  `ph_num_two` varchar(15) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `graduation_year` year(4) NOT NULL,
  `home_num` varchar(15) DEFAULT NULL,
  `dob` date NOT NULL,
  `age` tinyint(3) UNSIGNED NOT NULL,
  `qual_id` tinyint(3) UNSIGNED NOT NULL,
  `spec_id` tinyint(3) UNSIGNED NOT NULL,
  `military_status_id` tinyint(3) UNSIGNED NOT NULL,
  `social_status_id` tinyint(3) UNSIGNED NOT NULL,
  `dep_id` tinyint(3) UNSIGNED NOT NULL,
  `join_purpose_id` tinyint(3) UNSIGNED NOT NULL,
  `source_id` int(11) NOT NULL,
  `ref_one` text NOT NULL,
  `ref_two` text,
  `problem` text NOT NULL,
  `medical` text NOT NULL,
  `computer_skills` varchar(4) NOT NULL,
  `general_skills` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_details`
--

INSERT INTO `student_details` (`id`, `student_id`, `ph_num_one`, `ph_num_two`, `address`, `graduation_year`, `home_num`, `dob`, `age`, `qual_id`, `spec_id`, `military_status_id`, `social_status_id`, `dep_id`, `join_purpose_id`, `source_id`, `ref_one`, `ref_two`, `problem`, `medical`, `computer_skills`, `general_skills`) VALUES
(1, 1, '01145690322', '01065690344', 'ميت ابو غالب – مركز كفر سعد - دمياط ', 2016, '22446335', '1995-01-01', 23, 1, 1, 1, 1, 1, 3, 2, '{\"name\":\"خالد محمود رمضان عبدالحميد\",\"mobile\":\"01005991344\",\"relation\":\"الزوج\"}', '{\"name\":\"محمد محمد الحسني\",\"mobile\":\"01279657300\",\"relation\":\"الأب\"}', '{\"answer\":\"no\",\"reason\":\"\"}', '{\"answer\":\"no\",\"disease\":\"\"}', 'yes', ''),
(2, 2, '01145690322', '', 'ميت ابو غالب – مركز كفر على - الفيوم', 2013, '', '1992-01-01', 27, 2, 3, 1, 2, 2, 2, 1, '{\"name\":\"محمد الحسينى شريف\",\"mobile\":\"01045690377\",\"relation\":\"الأب\"}', '{\"name\":\"\",\"mobile\":\"\",\"relation\":\"\"}', '{\"answer\":\"no\",\"reason\":\"\"}', '{\"answer\":\"no\",\"disease\":\"\"}', 'no', ''),
(3, 3, '0111111111', '0111111111', '69 xyz st', 2020, '242222222', '1998-07-11', 21, 1, 2, 1, 2, 1, 3, 1, '{\"name\":\"mohamed\",\"mobile\":\"01222222222\",\"relation\":\"الأب\"}', '{\"name\":\"\",\"mobile\":\"\",\"relation\":\"\"}', '{\"answer\":\"yes\",\"reason\":\"any thing\"}', '{\"answer\":\"no\",\"disease\":\"\"}', 'no', ''),
(4, 4, '012222222', '01222222222', '69 ستشهخاشهبش', 2020, '', '2019-07-11', 27, 1, 2, 2, 2, 1, 1, 1, '{\"name\":\"mahmoud\",\"mobile\":\"0133333333\",\"relation\":\"الأب\"}', '{\"name\":\"\",\"mobile\":\"\",\"relation\":\"\"}', '{\"answer\":\"no\",\"reason\":\"\"}', '{\"answer\":\"no\",\"disease\":\"\"}', 'yes', ''),
(5, 5, '0133333333', '013333333', 'شسبشسبشششلشس', 2020, '', '2019-07-13', 21, 1, 2, 1, 2, 1, 2, 1, '{\"name\":\"kareem\",\"mobile\":\"012222222\",\"relation\":\"الأب\"}', '{\"name\":\"\",\"mobile\":\"\",\"relation\":\"\"}', '{\"answer\":\"yes\",\"reason\":\"\"}', '{\"answer\":\"no\",\"disease\":\"\"}', 'no', ''),
(6, 9, '01555555555', '', 'يلسيلسسساسيا', 2020, '', '2019-07-05', 21, 1, 3, 1, 2, 2, 1, 1, '{\"name\":\"dsgsdhs\",\"mobile\":\"0111111111111111\",\"relation\":\"الزوج\"}', '{\"name\":\"\",\"mobile\":\"\",\"relation\":\"\"}', '{\"answer\":\"yes\",\"reason\":\"\"}', '{\"answer\":\"no\",\"disease\":\"\"}', 'yes', ''),
(7, 10, '019999999', '019999999999', 'samfishafoha', 2012, '', '2019-07-04', 54, 2, 2, 1, 1, 2, 2, 1, '{\"name\":\"asdadas\",\"mobile\":\"01222222222\",\"relation\":\"الأب\"}', '{\"name\":\"\",\"mobile\":\"\",\"relation\":\"\"}', '{\"answer\":\"no\",\"reason\":\"\"}', '{\"answer\":\"no\",\"disease\":\"\"}', 'no', ''),
(8, 11, '015555555', '0177777777777', 'بسيلس', 2023, '', '2019-07-11', 32, 1, 2, 1, 1, 3, 2, 1, '{\"name\":\"mohamed\",\"mobile\":\"01222222222\",\"relation\":\"الأب\"}', '{\"name\":\"\",\"mobile\":\"\",\"relation\":\"\"}', '{\"answer\":\"no\",\"reason\":\"\"}', '{\"answer\":\"no\",\"disease\":\"\"}', 'no', ''),
(9, 12, '23423423432234', '', 'سيبسيلللص', 0000, '', '2019-07-05', 20, 2, 2, 2, 1, 2, 1, 1, '{\"name\":\"amfioahag\",\"mobile\":\"234234\",\"relation\":\"الزوج\"}', '{\"name\":\"\",\"mobile\":\"\",\"relation\":\"\"}', '{\"answer\":\"no\",\"reason\":\"\"}', '{\"answer\":\"no\",\"disease\":\"\"}', 'no', ''),
(10, 13, '0166666', '', 'سيلسلسيل', 2020, '', '2019-07-12', 56, 1, 3, 2, 1, 3, 1, 2, '{\"name\":\"بلاتبلتب\",\"mobile\":\"بايايا\",\"relation\":null}', '{\"name\":\"\",\"mobile\":\"\",\"relation\":\"\"}', '{\"answer\":\"no\",\"reason\":\"\"}', '{\"answer\":\"no\",\"disease\":\"\"}', 'no', ''),
(11, 14, '23423423432234', '', 'dffr34534rsg', 1970, '', '2019-07-19', 53, 2, 2, 2, 2, 2, 2, 1, '{\"name\":\"sdfsd\",\"mobile\":\"53345435\",\"relation\":null}', '{\"name\":\"\",\"mobile\":\"\",\"relation\":\"\"}', '{\"answer\":\"no\",\"reason\":\"\"}', '{\"answer\":\"no\",\"disease\":\"\"}', 'no', '');

-- --------------------------------------------------------

--
-- Table structure for table `student_status`
--

CREATE TABLE `student_status` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(70) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_status`
--

INSERT INTO `student_status` (`id`, `name`, `status`) VALUES
(1, 'has form', 1),
(2, '1st fund paid', 1),
(3, 'accepted', 1),
(4, 'delayed', 1),
(5, 'unaccepted', 1),
(6, '2nd fund paid', 1),
(7, 'money is back', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_training`
--

CREATE TABLE `student_training` (
  `id` int(11) UNSIGNED NOT NULL,
  `student_id` int(11) NOT NULL,
  `training_id` tinyint(4) NOT NULL,
  `date` date NOT NULL,
  `is_paid` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_training`
--

INSERT INTO `student_training` (`id`, `student_id`, `training_id`, `date`, `is_paid`) VALUES
(1, 1, 1, '2019-06-30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `final` tinyint(3) UNSIGNED NOT NULL,
  `midterm` tinyint(3) UNSIGNED NOT NULL,
  `activity` tinyint(3) UNSIGNED NOT NULL,
  `attendace` tinyint(3) UNSIGNED NOT NULL,
  `total` tinyint(3) UNSIGNED NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `final`, `midterm`, `activity`, `attendace`, `total`, `status`) VALUES
(1, 'english', 100, 30, 10, 10, 150, 1),
(2, 'math', 100, 30, 10, 10, 150, 1),
(3, 'physics', 100, 30, 10, 10, 150, 1),
(4, 'italy', 100, 30, 10, 10, 150, 1),
(5, 'subject 5', 100, 30, 10, 10, 150, 1),
(6, 'subject 6', 100, 30, 10, 10, 150, 1),
(7, 'subject 7', 100, 20, 10, 10, 140, 1);

-- --------------------------------------------------------

--
-- Table structure for table `training`
--

CREATE TABLE `training` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `start_at` date NOT NULL,
  `end_at` date NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `training`
--

INSERT INTO `training` (`id`, `name`, `price`, `start_at`, `end_at`, `status`) VALUES
(1, 'traning 1', '1000.00', '2019-11-01', '2020-01-20', 1),
(2, 'training 2', '500.00', '2019-08-01', '2019-12-30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `user_type_id` tinyint(4) NOT NULL,
  `color` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `password`, `status`, `user_type_id`, `color`) VALUES
(1, 'Admin', 'admin', '123456', 1, 1, ''),
(2, 'Sa', 'sa', '123456', 1, 2, ''),
(3, 'Safe', 'safe', '123456', 1, 3, ''),
(4, 'Cs', 'cs', '123456', 1, 4, ''),
(5, 'Offiser', 'offiser', '123456', 1, 5, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `color` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `name`, `status`, `color`) VALUES
(1, 'admin', 1, ''),
(2, 'student affairs', 1, ''),
(3, 'safe', 1, ''),
(4, 'customer service', 1, ''),
(5, 'officer', 1, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendace`
--
ALTER TABLE `attendace`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid_index` (`student_id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department_subjects`
--
ALTER TABLE `department_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_for`
--
ALTER TABLE `expense_for`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `joining_purposes`
--
ALTER TABLE `joining_purposes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lost_cards`
--
ALTER TABLE `lost_cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `military_status`
--
ALTER TABLE `military_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id_index` (`student_id`);

--
-- Indexes for table `pay_for`
--
ALTER TABLE `pay_for`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qualifications`
--
ALTER TABLE `qualifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `relation_status`
--
ALTER TABLE `relation_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id_index` (`student_barcode_id`),
  ADD KEY `year_index` (`year`);

--
-- Indexes for table `site_setting`
--
ALTER TABLE `site_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_status`
--
ALTER TABLE `social_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `specializations`
--
ALTER TABLE `specializations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `national_id_index` (`national_id`),
  ADD KEY `name_index` (`name`);

--
-- Indexes for table `student_details`
--
ALTER TABLE `student_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_status`
--
ALTER TABLE `student_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_training`
--
ALTER TABLE `student_training`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training`
--
ALTER TABLE `training`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendace`
--
ALTER TABLE `attendace`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `department_subjects`
--
ALTER TABLE `department_subjects`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `expense_for`
--
ALTER TABLE `expense_for`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `joining_purposes`
--
ALTER TABLE `joining_purposes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `lost_cards`
--
ALTER TABLE `lost_cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `military_status`
--
ALTER TABLE `military_status`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `pay_for`
--
ALTER TABLE `pay_for`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `qualifications`
--
ALTER TABLE `qualifications`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `relation_status`
--
ALTER TABLE `relation_status`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `site_setting`
--
ALTER TABLE `site_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `social_status`
--
ALTER TABLE `social_status`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `specializations`
--
ALTER TABLE `specializations`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `student_details`
--
ALTER TABLE `student_details`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `student_status`
--
ALTER TABLE `student_status`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `student_training`
--
ALTER TABLE `student_training`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `training`
--
ALTER TABLE `training`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
