-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2019 at 11:47 AM
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
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` int(11) NOT NULL,
  `resource_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `resource_id`, `name`) VALUES
(1, 1, 'khaled');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) UNSIGNED NOT NULL,
  `student_barcode` varchar(255) DEFAULT NULL,
  `class_id` varchar(11) NOT NULL,
  `subject_id` varchar(11) NOT NULL,
  `register_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `student_barcode`, `class_id`, `subject_id`, `register_date`) VALUES
(15, '72', '2', '2', '2018-08-18 13:24:58'),
(16, '72', '2', '3', '2018-08-25 00:00:00'),
(17, '180101328', '4', '1', '2019-08-18 13:33:05'),
(18, '180101328', '4', '3', '2019-08-18 13:33:05'),
(19, '72', '4', '4', '2019-08-18 13:33:05'),
(20, '18010410972', '3', '2', '2019-08-20 16:58:51'),
(21, '180104109', '1', '1', '2019-08-20 16:58:51'),
(22, '180101328', '3', '2', '2019-08-20 16:59:00'),
(23, '72', '3', '3', '2019-08-13 16:59:00'),
(24, '180104109', '3', '2', '2019-08-20 16:59:52'),
(25, '180104109', '3', '3', '2019-08-20 16:59:52'),
(26, '180104109', '3', '2', '2019-08-20 16:59:57'),
(27, '180104109', '3', '3', '2019-08-20 16:59:57'),
(28, '72', '3', '2', '2019-08-20 17:00:01'),
(29, '18010410972', '3', '3', '2019-08-20 17:00:01'),
(30, '18010410972', '3', '2', '2019-08-20 17:00:10'),
(31, '18010410972', '3', '3', '2019-08-20 17:00:10'),
(32, '18010410972', '1', '1', '2019-08-20 17:03:50'),
(33, '180104109180104109', '1', '1', '2019-08-20 17:03:51');

-- --------------------------------------------------------

--
-- Table structure for table `attendance_exams`
--

CREATE TABLE `attendance_exams` (
  `id` int(11) NOT NULL,
  `student_barcode` varchar(255) NOT NULL,
  `subject_id` varchar(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance_exams`
--

INSERT INTO `attendance_exams` (`id`, `student_barcode`, `subject_id`, `date`) VALUES
(1, '180101328', '1', '2019-08-18 10:23:20'),
(2, '180101328', '1', '2019-08-18 12:27:58'),
(3, '180104109', '1', '2019-08-19 09:46:58');

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
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `name`) VALUES
(1, 'A1'),
(2, 'A2'),
(3, 'B1'),
(4, 'B2'),
(5, 'C1');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `frist_fund` int(11) NOT NULL,
  `secound_fund` int(11) NOT NULL,
  `third_fund` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `frist_fund`, `secound_fund`, `third_fund`, `status`) VALUES
(1, 'التمريض', 1700, 2000, 2000, 1),
(2, 'مساعد صيدلى', 0, 0, 0, 1),
(3, 'أشعة', 0, 0, 0, 1),
(4, 'تحاليل', 0, 0, 0, 1),
(5, 'خياطة', 0, 0, 0, 1),
(6, 'سباكة', 0, 0, 0, 1);

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
(3, 'mohamed hassan', 'officer', '011111111111', 'safsaf', '5000', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(4, 'kahled ahmed', 'Officer', '010008881414', 'dsaflsa;jdflakjdadass', '5000', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(5, 'kahled ahmed', 'Officer', '010008881414', 'dsaflsa;jdflakjdadass', '5000', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(6, 'mohamed salah', 'Officer', '010008881414', '68dsakhjdkas', '5000', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(7, 'mohamed salah', 'Officer', '010008881414', '68dsakhjdkas', '5000', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(8, 'mohamed salah', 'Officer', '010008881414', '68dsakhjdkas', '5000', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(9, 'mohamed salah23', 'Officer', '01000888141412', '68dsakhjdkas', '12000', '2019-07-12 21:16:05', '0000-00-00 00:00:00', 1),
(10, 'rewfrds', 'Officer', '010008881414', 'refdsafds', '5000', '2019-07-12 21:18:16', '0000-00-00 00:00:00', 0),
(11, 'fdxgfsdgfdgre', 'Lecturer', '010008881414', 'wadadasda', '630', '2019-07-17 16:02:04', '0000-00-00 00:00:00', 0),
(12, 'dsadsadas', 'Lecturer', '010008881414', 'dsafdzsafsf', '500', '2019-07-17 16:01:55', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `expense_for_id` tinyint(3) UNSIGNED NOT NULL,
  `value` decimal(7,2) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `date` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `student_id`, `expense_for_id`, `value`, `employee_id`, `description`, `date`, `status`) VALUES
(1, 2, 1, '1000.00', NULL, NULL, '2019-07-01 12:47:10', 1),
(2, 1, 6, '400.00', NULL, NULL, '2019-07-21 11:20:42', 1),
(3, 1, 6, '400.00', NULL, NULL, '2019-07-21 11:20:42', 0),
(4, 1, 5, '300.00', NULL, NULL, '2019-07-21 11:20:42', 0),
(5, 0, 7, '150.00', 5, 'dsgfg', '2019-07-02 00:00:00', 1),
(6, 0, 7, '350.00', 2, '', '2019-07-24 00:00:00', 1),
(7, 0, 7, '130.00', 2, '', '2007-08-07 00:00:00', 0),
(8, 0, 7, '50.00', 12, 'trhrt', '2019-07-24 00:00:00', 0),
(9, 0, 7, '150.00', 12, 'udhfwe', '2019-07-24 16:28:48', 1),
(13, 0, 8, '370.00', 0, '', '2019-07-31 09:57:56', 0),
(17, 2, 6, '400.00', NULL, NULL, '2019-08-07 14:51:58', 1),
(18, 0, 7, '500.00', 12, 'help me please', '2019-08-07 14:54:32', 0),
(19, 0, 7, '400.00', 12, '00000', '2019-08-07 14:55:08', 1),
(21, 2, 6, '400.00', NULL, NULL, '2019-08-21 15:03:21', 0);

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
(4, 'ex trips', '120.00', 1),
(5, 'ex uniform', '300.00', 1),
(6, 'ex branch', '400.00', 1),
(7, 'borrowing', '0.00', 1),
(8, 'paying salaries', '0.00', 1),
(9, 'other', '0.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `status`) VALUES
(1, 'Group One', 1),
(2, 'Group Two', 1),
(3, 'Group Three', 1),
(4, 'Group Four', 0);

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
-- Table structure for table `lecture`
--

CREATE TABLE `lecture` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lecture`
--

INSERT INTO `lecture` (`id`, `group_id`, `subject_id`, `emp_id`, `date`) VALUES
(1, 1, 1, 1, '2019-09-02 04:22:17');

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
(93, 32, '2019-07-15 17:50:29', '`results`', 'del this col.', 'Add New Patient', 0),
(94, 49, '2019-07-21 12:56:37', '`payment`', 'del this col.', 'Add New Patient', 0),
(95, 3, '2019-07-21 12:56:37', '`student`', '', 'Edit User Details', 0),
(96, 15, '2019-07-21 13:09:25', '`student`', 'del this col.', 'Add New Patient', 0),
(97, 12, '2019-07-21 13:09:25', '`student_details`', 'del this col.', 'Add New Patient', 0),
(98, 16, '2019-07-21 13:23:31', '`student`', 'del this col.', 'Add New Patient', 0),
(99, 13, '2019-07-21 13:23:31', '`student_details`', 'del this col.', 'Add New Patient', 0),
(100, 54, '2019-07-21 13:24:19', '`payment`', 'del this col.', 'Add New Patient', 0),
(101, 3, '2019-07-21 13:24:19', '`student`', '', 'Edit User Details', 0),
(102, 55, '2019-07-21 13:25:06', '`payment`', 'del this col.', 'Add New Patient', 0),
(103, 3, '2019-07-21 13:25:06', '`student`', '', 'Edit User Details', 0),
(104, 3, '2019-07-21 13:42:58', '`student`', '', 'Edit User Details', 0),
(105, 3, '2019-07-21 13:45:33', '`student`', '', 'Edit User Details', 0),
(106, 3, '2019-07-21 13:45:57', '`student`', '', 'Edit User Details', 0),
(107, 3, '2019-07-21 15:26:19', '`student`', '', 'Edit User Details', 0),
(108, 3, '2019-07-21 15:28:40', '`student`', '', 'Edit User Details', 0),
(109, 3, '2019-07-21 15:30:00', '`student`', '', 'Edit User Details', 0),
(110, 3, '2019-07-21 15:31:00', '`student`', '', 'Edit User Details', 0),
(111, 3, '2019-07-21 15:31:26', '`student`', '', 'Edit User Details', 0),
(112, 33, '2019-07-22 13:08:41', '`results`', 'del this col.', 'Add New Patient', 0),
(113, 34, '2019-07-22 13:08:41', '`results`', 'del this col.', 'Add New Patient', 0),
(114, 35, '2019-07-22 13:08:41', '`results`', 'del this col.', 'Add New Patient', 0),
(115, 36, '2019-07-22 13:09:57', '`results`', 'del this col.', 'Add New Patient', 0),
(116, 37, '2019-07-22 13:09:57', '`results`', 'del this col.', 'Add New Patient', 0),
(117, 38, '2019-07-22 13:09:57', '`results`', 'del this col.', 'Add New Patient', 0),
(118, 39, '2019-07-22 13:12:41', '`results`', 'del this col.', 'Add New Patient', 0),
(119, 40, '2019-07-22 13:12:41', '`results`', 'del this col.', 'Add New Patient', 0),
(120, 41, '2019-07-22 13:12:41', '`results`', 'del this col.', 'Add New Patient', 0),
(121, 42, '2019-07-22 13:24:52', '`results`', 'del this col.', 'Add New Patient', 0),
(122, 43, '2019-07-22 13:24:53', '`results`', 'del this col.', 'Add New Patient', 0),
(123, 44, '2019-07-22 13:24:53', '`results`', 'del this col.', 'Add New Patient', 0),
(124, 45, '2019-07-22 14:01:35', '`results`', 'del this col.', 'Add New Patient', 0),
(125, 46, '2019-07-22 14:01:35', '`results`', 'del this col.', 'Add New Patient', 0),
(126, 47, '2019-07-22 14:01:35', '`results`', 'del this col.', 'Add New Patient', 0),
(127, 48, '2019-07-22 14:02:02', '`results`', 'del this col.', 'Add New Patient', 0),
(128, 49, '2019-07-22 14:02:02', '`results`', 'del this col.', 'Add New Patient', 0),
(129, 50, '2019-07-22 14:02:02', '`results`', 'del this col.', 'Add New Patient', 0),
(130, 51, '2019-07-22 14:28:35', '`results`', 'del this col.', 'Add New Patient', 0),
(131, 52, '2019-07-22 14:28:35', '`results`', 'del this col.', 'Add New Patient', 0),
(132, 53, '2019-07-22 14:28:35', '`results`', 'del this col.', 'Add New Patient', 0),
(133, 54, '2019-07-22 14:40:07', '`results`', 'del this col.', 'Add New Patient', 0),
(134, 55, '2019-07-22 14:40:07', '`results`', 'del this col.', 'Add New Patient', 0),
(135, 56, '2019-07-22 14:40:07', '`results`', 'del this col.', 'Add New Patient', 0),
(136, 57, '2019-07-22 14:49:55', '`results`', 'del this col.', 'Add New Patient', 0),
(137, 58, '2019-07-22 14:49:55', '`results`', 'del this col.', 'Add New Patient', 0),
(138, 59, '2019-07-22 14:49:55', '`results`', 'del this col.', 'Add New Patient', 0),
(139, 1, '2019-07-22 16:07:05', '`results`', '', 'Edit User Details', 0),
(140, 1, '2019-07-22 16:07:05', '`results`', '', 'Edit User Details', 0),
(141, 1, '2019-07-24 12:55:37', '`results`', '', 'Edit User Details', 0),
(142, 1, '2019-07-24 12:55:37', '`results`', '', 'Edit User Details', 0),
(143, 1, '2019-07-24 12:59:44', '`results`', '', 'Edit User Details', 0),
(144, 1, '2019-07-24 13:25:13', '`results`', '', 'Edit User Details', 0),
(145, 19, '2019-07-27 10:26:37', '`student`', 'del this col.', 'Add New Patient', 0),
(146, 14, '2019-07-27 10:26:37', '`student_details`', 'del this col.', 'Add New Patient', 0),
(147, 20, '2019-07-27 10:30:36', '`student`', 'del this col.', 'Add New Patient', 0),
(148, 15, '2019-07-27 10:30:36', '`student_details`', 'del this col.', 'Add New Patient', 0),
(149, 22, '2019-07-27 10:32:11', '`student`', 'del this col.', 'Add New Patient', 0),
(150, 16, '2019-07-27 10:32:11', '`student_details`', 'del this col.', 'Add New Patient', 0),
(151, 1, '2019-07-31 10:12:30', '`results`', '', 'Edit User Details', 0),
(152, 3, '2019-07-31 14:18:07', '`student`', '', 'Edit User Details', 0),
(153, 3, '2019-07-31 14:18:11', '`student`', '', 'Edit User Details', 0),
(154, 3, '2019-07-31 14:25:53', '`student`', '', 'Edit User Details', 0),
(155, 23, '2019-08-04 09:49:24', '`student`', 'del this col.', 'Add New Patient', 0),
(156, 17, '2019-08-04 09:49:24', '`student_details`', 'del this col.', 'Add New Patient', 0),
(157, 24, '2019-08-04 10:10:21', '`student`', 'del this col.', 'Add New Patient', 0),
(158, 18, '2019-08-04 10:10:21', '`student_details`', 'del this col.', 'Add New Patient', 0),
(159, 25, '2019-08-04 10:12:30', '`student`', 'del this col.', 'Add New Patient', 0),
(160, 19, '2019-08-04 10:12:30', '`student_details`', 'del this col.', 'Add New Patient', 0),
(161, 26, '2019-08-04 10:14:40', '`student`', 'del this col.', 'Add New Patient', 0),
(162, 20, '2019-08-04 10:14:40', '`student_details`', 'del this col.', 'Add New Patient', 0),
(163, 1, '2019-08-07 14:05:03', '`student`', '', 'Edit User Details', 0),
(164, 26, '2019-08-20 10:01:40', '`student`', 'del this col.', 'Add New Patient', 0),
(165, 29, '2019-08-20 10:03:33', '`student`', 'del this col.', 'Add New Patient', 0),
(166, 31, '2019-08-20 10:04:28', '`student`', 'del this col.', 'Add New Patient', 0),
(167, 32, '2019-08-20 10:06:56', '`student`', 'del this col.', 'Add New Patient', 0),
(168, 33, '2019-08-20 10:08:08', '`student`', 'del this col.', 'Add New Patient', 0),
(169, 21, '2019-08-20 10:08:08', '`student_details`', 'del this col.', 'Add New Patient', 0),
(170, 34, '2019-08-20 10:10:07', '`student`', 'del this col.', 'Add New Patient', 0),
(171, 22, '2019-08-20 10:10:07', '`student_details`', 'del this col.', 'Add New Patient', 0),
(172, 3, '2019-08-20 14:05:30', '`student`', '', 'Edit User Details', 0),
(173, 3, '2019-08-20 16:51:05', '`student`', '', 'Edit User Details', 0),
(174, 3, '2019-08-20 16:53:16', '`student`', '', 'Edit User Details', 0),
(175, 3, '2019-08-21 09:47:14', '`student`', '', 'Edit User Details', 0),
(176, 3, '2019-08-21 09:55:15', '`student`', '', 'Edit User Details', 0),
(177, 3, '2019-08-21 09:56:41', '`student`', '', 'Edit User Details', 0),
(178, 1, '2019-08-21 09:59:08', '`student`', '', 'Edit User Details', 0),
(179, 3, '2019-08-21 10:03:07', '`student`', '', 'Edit User Details', 0),
(180, 3, '2019-08-21 10:03:32', '`student`', '', 'Edit User Details', 0),
(181, 3, '2019-08-21 10:04:46', '`student`', '', 'Edit User Details', 0),
(182, 3, '2019-08-21 10:04:53', '`student`', '', 'Edit User Details', 0),
(183, 3, '2019-08-21 10:06:26', '`student`', '', 'Edit User Details', 0),
(184, 3, '2019-08-21 10:09:50', '`student`', '', 'Edit User Details', 0),
(185, 3, '2019-08-21 10:10:51', '`student`', '', 'Edit User Details', 0),
(186, 3, '2019-08-21 10:10:58', '`student`', '', 'Edit User Details', 0),
(187, 3, '2019-08-21 11:40:30', '`student`', '', 'Edit User Details', 0),
(188, 3, '2019-08-21 11:41:31', '`student`', '', 'Edit User Details', 0),
(189, 1, '2019-08-21 11:59:11', '`student`', '', 'Edit User Details', 0),
(190, 1, '2019-08-21 12:01:11', '`student`', '', 'Edit User Details', 0),
(191, 35, '2019-09-01 12:20:56', '`student`', 'del this col.', 'Add New Patient', 0),
(192, 23, '2019-09-01 12:20:56', '`student_details`', 'del this col.', 'Add New Patient', 0),
(193, 2, '2019-09-01 14:48:30', '`student`', '', 'Edit User Details', 0),
(194, 2, '2019-09-01 14:48:30', '`student_details`', '', 'Edit User Details', 0),
(195, 2, '2019-09-01 14:49:23', '`student`', '', 'Edit User Details', 0),
(196, 2, '2019-09-01 14:49:23', '`student_details`', '', 'Edit User Details', 0),
(197, 4, '2019-09-01 14:56:32', '`student`', '', 'Edit User Details', 0),
(198, 4, '2019-09-01 14:56:32', '`student_details`', '', 'Edit User Details', 0),
(199, 4, '2019-09-01 14:59:12', '`student`', '', 'Edit User Details', 0),
(200, 4, '2019-09-01 14:59:12', '`student_details`', '', 'Edit User Details', 0),
(201, 4, '2019-09-01 14:59:55', '`student`', '', 'Edit User Details', 0),
(202, 4, '2019-09-01 14:59:55', '`student_details`', '', 'Edit User Details', 0),
(203, 4, '2019-09-01 15:00:49', '`student`', '', 'Edit User Details', 0),
(204, 4, '2019-09-01 15:00:49', '`student_details`', '', 'Edit User Details', 0),
(205, 4, '2019-09-01 15:02:25', '`student`', '', 'Edit User Details', 0),
(206, 4, '2019-09-01 15:02:25', '`student_details`', '', 'Edit User Details', 0),
(207, 4, '2019-09-01 15:03:32', '`student`', '', 'Edit User Details', 0),
(208, 4, '2019-09-01 15:03:32', '`student_details`', '', 'Edit User Details', 0),
(209, 4, '2019-09-01 15:04:40', '`student`', '', 'Edit User Details', 0),
(210, 4, '2019-09-01 15:04:40', '`student_details`', '', 'Edit User Details', 0),
(211, 4, '2019-09-01 15:04:59', '`student`', '', 'Edit User Details', 0),
(212, 4, '2019-09-01 15:04:59', '`student_details`', '', 'Edit User Details', 0),
(213, 4, '2019-09-01 15:05:09', '`student`', '', 'Edit User Details', 0),
(214, 4, '2019-09-01 15:05:10', '`student_details`', '', 'Edit User Details', 0),
(215, 4, '2019-09-01 15:05:40', '`student`', '', 'Edit User Details', 0),
(216, 4, '2019-09-01 15:05:40', '`student_details`', '', 'Edit User Details', 0),
(217, 4, '2019-09-01 15:06:13', '`student`', '', 'Edit User Details', 0),
(218, 4, '2019-09-01 15:06:13', '`student_details`', '', 'Edit User Details', 0),
(219, 4, '2019-09-01 15:06:29', '`student`', '', 'Edit User Details', 0),
(220, 4, '2019-09-01 15:06:29', '`student_details`', '', 'Edit User Details', 0),
(221, 4, '2019-09-01 15:07:41', '`student`', '', 'Edit User Details', 0),
(222, 4, '2019-09-01 15:07:41', '`student_details`', '', 'Edit User Details', 0),
(223, 4, '2019-09-01 15:08:13', '`student`', '', 'Edit User Details', 0),
(224, 4, '2019-09-01 15:08:13', '`student_details`', '', 'Edit User Details', 0),
(225, 4, '2019-09-01 15:08:21', '`student`', '', 'Edit User Details', 0),
(226, 4, '2019-09-01 15:08:21', '`student_details`', '', 'Edit User Details', 0),
(227, 4, '2019-09-01 15:08:55', '`student`', '', 'Edit User Details', 0),
(228, 4, '2019-09-01 15:08:55', '`student_details`', '', 'Edit User Details', 0),
(229, 4, '2019-09-01 15:10:44', '`student`', '', 'Edit User Details', 0),
(230, 4, '2019-09-01 15:10:44', '`student_details`', '', 'Edit User Details', 0),
(231, 4, '2019-09-01 15:12:42', '`student`', '', 'Edit User Details', 0),
(232, 4, '2019-09-01 15:12:42', '`student_details`', '', 'Edit User Details', 0),
(233, 4, '2019-09-01 15:13:18', '`student`', '', 'Edit User Details', 0),
(234, 4, '2019-09-01 15:13:18', '`student_details`', '', 'Edit User Details', 0),
(235, 4, '2019-09-01 15:14:03', '`student`', '', 'Edit User Details', 0),
(236, 4, '2019-09-01 15:14:03', '`student_details`', '', 'Edit User Details', 0),
(237, 4, '2019-09-01 15:15:35', '`student`', '', 'Edit User Details', 0),
(238, 4, '2019-09-01 15:15:35', '`student_details`', '', 'Edit User Details', 0);

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
(13, 1, 'img/yafta-s.jpg'),
(14, 2, 'img/Moon.jpg'),
(15, 2, 'img/Moon.jpg'),
(16, 2, 'img/Moon.jpg'),
(17, 2, 'img/Moon.jpg'),
(18, 2, 'img/Moon.jpg'),
(19, 2, 'img/Moon.jpg'),
(20, 2, 'img/Moon.jpg');

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
-- Table structure for table `old_salaries`
--

CREATE TABLE `old_salaries` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `salary` varchar(28) CHARACTER SET utf8 NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `old_salaries`
--

INSERT INTO `old_salaries` (`id`, `employee_id`, `salary`, `date`) VALUES
(2, 12, '500012', '2019-07-16'),
(3, 12, '500012', '2019-07-16'),
(4, 12, '5000123', '2019-07-16'),
(5, 12, '5000123', '2019-07-16'),
(6, 12, '5000', '2019-07-16'),
(7, 12, '50200', '2019-07-17'),
(8, 11, '232321', '2019-07-17');

-- --------------------------------------------------------

--
-- Table structure for table `old_status`
--

CREATE TABLE `old_status` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `old_status_id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `old_status`
--

INSERT INTO `old_status` (`id`, `student_id`, `old_status_id`, `date`) VALUES
(1, 2, 3, '0000-00-00'),
(3, 2, 2, '2019-08-01');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) UNSIGNED NOT NULL,
  `student_id` int(11) NOT NULL,
  `pay_for_id` tinyint(3) UNSIGNED NOT NULL,
  `value` decimal(7,2) NOT NULL,
  `description` varchar(500) NOT NULL,
  `date` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `student_id`, `pay_for_id`, `value`, `description`, `date`, `status`) VALUES
(1, 1, 8, '1000.00', '', '2020-04-15 00:00:00', 1),
(3, 2, 2, '1000.00', '', '2019-07-02 11:36:22', 1),
(5, 3, 3, '1000.00', '', '2019-07-10 00:00:00', 1),
(10, 9, 1, '100.00', '', '2019-07-10 16:28:10', 1),
(12, 3, 2, '1000.00', '', '2019-07-11 16:40:12', 1),
(19, 2, 2, '1000.00', '', '2019-07-13 10:54:53', 1),
(24, 10, 1, '100.00', '', '2019-07-13 11:38:24', 1),
(25, 10, 2, '1000.00', '', '2019-07-13 11:38:24', 1),
(27, 1, 6, '200.00', '', '2019-07-04 00:00:00', 1),
(38, 1, 6, '200.00', '', '2019-07-31 12:42:12', 1),
(44, 2, 8, '200.00', '', '2019-08-07 14:59:08', 0),
(45, 34, 1, '100.00', '', '2019-08-20 10:10:07', 1),
(46, 34, 2, '1000.00', '', '2019-08-20 10:10:07', 1),
(48, 2, 7, '0.00', '', '2019-08-21 15:03:21', 1),
(51, 34, 3, '2000.00', '', '2019-08-29 11:14:27', 0),
(52, 35, 1, '100.00', '', '2019-09-01 12:20:56', 0),
(53, 35, 2, '1000.00', '', '2019-09-01 12:20:56', 0),
(54, 36, 1, '100.00', '', '2019-09-01 13:45:34', 1),
(55, 36, 2, '1700.00', '', '2019-09-01 13:45:34', 1),
(56, 36, 3, '2000.00', '', '2019-09-01 13:45:34', 1),
(57, 36, 4, '2000.00', '', '2019-09-01 13:45:34', 1),
(58, 37, 1, '100.00', '', '2019-09-01 13:51:35', 1),
(59, 37, 2, '1700.00', '', '2019-09-01 13:51:35', 1),
(60, 38, 1, '100.00', '', '2019-09-01 14:07:26', 1),
(61, 38, 2, '1700.00', '', '2019-09-01 14:07:26', 1),
(62, 38, 3, '2000.00', '', '2019-09-01 14:07:26', 1),
(63, 38, 4, '2000.00', '', '2019-09-01 14:07:26', 1),
(64, 39, 1, '100.00', '', '2019-09-01 14:08:05', 1),
(65, 39, 2, '1700.00', '', '2019-09-01 14:08:05', 1),
(66, 39, 3, '2000.00', '', '2019-09-01 14:08:05', 1),
(67, 39, 4, '2000.00', '', '2019-09-01 14:08:05', 1),
(68, 40, 1, '100.00', '', '2019-09-01 14:14:22', 1),
(69, 40, 2, '1700.00', '', '2019-09-01 14:14:22', 1),
(70, 40, 3, '2000.00', '', '2019-09-01 14:14:22', 1),
(71, 40, 4, '2000.00', '', '2019-09-01 14:14:22', 1),
(72, 41, 1, '100.00', '', '2019-09-01 14:23:31', 1),
(73, 41, 2, '1700.00', '', '2019-09-01 14:23:31', 1),
(74, 41, 3, '2000.00', '', '2019-09-01 14:23:31', 1),
(75, 41, 4, '2000.00', '', '2019-09-01 14:23:31', 1),
(76, 42, 1, '100.00', '', '2019-09-01 14:24:33', 1),
(77, 42, 2, '1700.00', '', '2019-09-01 14:24:33', 1),
(78, 42, 3, '2000.00', '', '2019-09-01 14:24:33', 1),
(79, 42, 4, '2000.00', '', '2019-09-01 14:24:33', 1),
(80, 43, 1, '100.00', '', '2019-09-01 14:26:03', 1),
(81, 43, 2, '1700.00', '', '2019-09-01 14:26:03', 1),
(82, 43, 3, '2000.00', '', '2019-09-01 14:26:03', 1),
(83, 43, 4, '2000.00', '', '2019-09-01 14:26:03', 1),
(84, 0, 5, '500.00', 'خيتلسملصثلصث', '2019-09-02 15:10:51', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pay_cat`
--

CREATE TABLE `pay_cat` (
  `id` int(11) NOT NULL,
  `name` varchar(155) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pay_cat`
--

INSERT INTO `pay_cat` (`id`, `name`) VALUES
(1, 'Book'),
(2, 'Trips');

-- --------------------------------------------------------

--
-- Table structure for table `pay_for`
--

CREATE TABLE `pay_for` (
  `id` int(11) UNSIGNED NOT NULL,
  `cat_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `name_ar` varchar(254) NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pay_for`
--

INSERT INTO `pay_for` (`id`, `cat_id`, `name`, `name_ar`, `price`, `status`) VALUES
(1, 0, 'registration form', 'فتح ملف', '100.00', 1),
(2, 1, '1st fund', 'القسط الاول', '1000.00', 1),
(3, 0, '2nd fund', 'القسط الثاني', '2000.00', 1),
(4, 2, '3rd fund', 'القسط الثالث', '0.00', 0),
(5, 0, 'uniform', 'الزي', '500.00', 1),
(6, 1, 'Lost Card', 'بدل كارت مفقود', '200.00', 1),
(7, 0, 'collection', 'تحصيل', '0.00', 1),
(8, 1, 'math', 'رياضه', '200.00', 0),
(9, 2, 'Re-enrollment', 'اعادة قيد', '580.00', 1),
(10, 2, 'trips', 'رحلات', '0.00', 0);

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
(1, 'طالب', 1),
(2, 'خريج', 1),
(3, 'مندوب', 1);

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
  `activity` varchar(28) NOT NULL,
  `attendace` varchar(28) NOT NULL,
  `final` varchar(28) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `student_barcode_id`, `year`, `subject_id`, `midterm`, `activity`, `attendace`, `final`) VALUES
(51, 72, 2019, 4, '430', '55', '120', '90'),
(52, 72, 2020, 4, '444', '444', '943', '943'),
(53, 14, 2020, 4, '333\r', '333\r', '7777\r', '7777\r'),
(54, 12, 2020, 2, '99\r', '16\r', '120\r', '120\r'),
(55, 72, 2020, 2, '88', '9', '943', '97'),
(56, 14, 2020, 2, '77\r', '34\r', '7777\r', '7777\r'),
(57, 12, 2020, 1, '555\r', '555\r', '120\r', '120\r'),
(58, 72, 2020, 1, '444\r', '444\r', '943\r', '943\r'),
(59, 14, 2020, 1, '333\r', '333\r', '7777\r', '7777\r');

-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

CREATE TABLE `salaries` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `working_time` varchar(155) CHARACTER SET utf8 NOT NULL,
  `discount` varchar(155) CHARACTER SET utf8 NOT NULL,
  `total` varchar(155) CHARACTER SET utf8 NOT NULL,
  `salary_date` date NOT NULL,
  `date` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salaries`
--

INSERT INTO `salaries` (`id`, `employee_id`, `working_time`, `discount`, `total`, `salary_date`, `date`, `status`) VALUES
(40, 2, '29', '350.00', '2616.6666666667', '2019-07-01', '2019-07-25', 1),
(41, 3, '27.5', '0', '4861.1111111111', '2019-08-01', '2019-07-25', 1),
(42, 4, '26.5', '0', '4805.5555555556', '2019-07-01', '2019-07-25', 1),
(43, 5, '26', '150.00', '4627.7777777778', '2019-07-01', '2019-07-25', 1),
(44, 6, '23', '0', '4611.1111111111', '2019-07-01', '2019-07-25', 1),
(45, 7, '20', '0', '4444.4444444444', '2019-07-01', '2019-07-25', 1),
(52, 2, '29', '0', '2966.6666666667', '2019-06-01', '2019-07-27', 1),
(53, 3, '27.5', '0', '4861.1111111111', '2019-06-01', '2019-07-27', 1),
(54, 4, '26.5', '0', '4805.5555555556', '2019-06-01', '2019-07-27', 1),
(55, 5, '26', '0', '4777.7777777778', '2019-06-01', '2019-07-27', 1),
(56, 6, '23', '0', '4611.1111111111', '2019-06-01', '2019-07-27', 1),
(57, 7, '20', '0', '4444.4444444444', '2019-06-01', '2019-07-27', 1),
(64, 2, '29', '0', '2966.6666666667', '2019-09-01', '2019-07-27', 1),
(65, 3, '27.5', '0', '4861.1111111111', '2019-09-01', '2019-07-27', 1),
(66, 4, '26.5', '0', '4805.5555555556', '2019-09-01', '2019-07-27', 1),
(67, 5, '26', '0', '4777.7777777778', '2019-09-01', '2019-07-27', 1),
(68, 6, '23', '0', '4611.1111111111', '2019-09-01', '2019-07-27', 1),
(69, 7, '20', '0', '4444.4444444444', '2019-09-01', '2019-07-27', 1);

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
  `group_id` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `name`, `name_ar`, `national_id`, `barcode_id`, `image`, `status`, `branch_id`, `group_id`, `date`) VALUES
(1, 'NOHA MOHAMED MOHAMED ELHOSINY SHIRF ', 'نهى محمد محمد الحسينى شريف', '2345678912345', '72', 'img/1.jpg', 1, 1, 1, '2019-09-01 14:49:23'),
(2, 'MOHAMED MOHAMED ELHOSINY SHIRF ', ' محمد محمد الحسينى شريف', '2345678912348', '123456781', 'img/Moon.jpg', 3, 1, 2, '0000-00-00 00:00:00'),
(3, 'khaled mohamed mostafa', 'خالد محمد مصطفى', '111111111111111', '180104109', 'img/yafta-s.jpg', 6, 1, 1, '0000-00-00 00:00:00'),
(9, 'karem', 'كريم', '44444444444444', '5555555555555', NULL, 1, 1, 0, '0000-00-00 00:00:00'),
(10, 'test', 'تيست', '989565989565', '88766979', NULL, 1, 1, 0, '0000-00-00 00:00:00'),
(11, 'ahmed mostafa', 'احمد مصطفي', '7979498646464', '180101328', NULL, 6, 2, 0, '0000-00-00 00:00:00'),
(12, 'mohamed salah', 'محمد صلاح', '2342', '3242342', NULL, 1, 1, 0, '0000-00-00 00:00:00'),
(13, 'testt', 'ٍ]لسيليس', '5678568', '97896', NULL, 1, 1, 0, '0000-00-00 00:00:00'),
(14, 'ggggg', 'ٍ]لسيليس', '435435', '4354', NULL, 1, 1, 0, '2019-07-15 15:53:25'),
(15, 'khaled', 'خالد', '87987959598', '48448784', NULL, 2, 1, 0, '2019-07-21 13:09:25'),
(16, 'hesham', 'هشام', '484697496569', '689789979546', NULL, 1, 1, 0, '2019-07-21 13:23:31'),
(25, 'Hhhhhhhhhh', 'لللللللللللللل', '4534543534543', '', NULL, 1, 2, 0, '2019-08-04 10:12:29'),
(34, 'farouq', 'فاروق', '2132131221321', '', NULL, 1, 2, 0, '2019-08-20 10:10:07'),
(35, 'tttttt', 'تتتتت', '546546465454544', '', NULL, 1, 1, 0, '2019-09-01 12:20:56'),
(36, 'football', 'p.gr,l', '79794986464642', '', 'img/2019-06-25.jpg', 9, 1, 0, '2019-09-01 15:15:34'),
(37, '', 'خالد محمد', '79794986464641', '', NULL, 1, 0, 0, '2019-09-01 13:51:35'),
(38, '', 'خالد محمد', '79794986464', '', NULL, 1, 0, 0, '2019-09-01 14:07:26'),
(39, '', 'خالد محمد', '7979498646', '', NULL, 9, 0, 0, '2019-09-01 14:08:04'),
(40, '', 'خالد محمد', '7979498', '', NULL, 1, 0, 0, '2019-09-01 14:14:22'),
(41, '', 'خالد محمد', '797949862', '', NULL, 1, 0, 0, '2019-09-01 14:23:31'),
(42, '', 'خالد محمد', '77777788', '', NULL, 9, 0, 0, '2019-09-01 14:24:33'),
(43, '', 'خالد محمد', '79794981', '', NULL, 1, 0, 0, '2019-09-01 14:26:03');

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
  `general_skills` text NOT NULL,
  `note` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_details`
--

INSERT INTO `student_details` (`id`, `student_id`, `ph_num_one`, `ph_num_two`, `address`, `graduation_year`, `home_num`, `dob`, `age`, `qual_id`, `spec_id`, `military_status_id`, `social_status_id`, `dep_id`, `join_purpose_id`, `source_id`, `ref_one`, `ref_two`, `problem`, `medical`, `computer_skills`, `general_skills`, `note`) VALUES
(1, 1, '01145690322', '01065690344', 'ميت ابو غالب – مركز كفر سعد - دمياط ', 2016, '22446335', '1995-01-01', 23, 1, 1, 1, 1, 1, 3, 2, '{\"name\":\"خالد محمود رمضان عبدالحميد\",\"mobile\":\"01005991344\",\"relation\":null}', '{\"name\":\"خالد محمود رمضان عبدالحميد\",\"mobile\":\"01005991344\",\"relation\":null}', '{\"answer\":\"no\",\"reason\":\"\"}', '{\"answer\":\"no\",\"disease\":\"\"}', 'yes', '', ''),
(2, 2, '01145690322', '', 'ميت ابو غالب – مركز كفر على - الفيوم', 2013, '', '1992-01-01', 27, 2, 3, 1, 2, 2, 2, 1, '{\"name\":\"محمد الحسينى شريف\",\"mobile\":\"01045690377\",\"relation\":\"الأب\"}', '{\"name\":\"\",\"mobile\":\"\",\"relation\":\"\"}', '{\"answer\":\"no\",\"reason\":\"\"}', '{\"answer\":\"no\",\"disease\":\"\"}', 'no', '', 'هذا الطالب لدية حالة من العصبية الشديدة'),
(3, 3, '0111111111', '0111111111', '69 xyz st', 2020, '242222222', '1998-07-11', 21, 1, 2, 1, 2, 1, 3, 1, '{\"name\":\"mohamed\",\"mobile\":\"01222222222\",\"relation\":\"الأب\"}', '{\"name\":\"\",\"mobile\":\"\",\"relation\":\"\"}', '{\"answer\":\"yes\",\"reason\":\"any thing\"}', '{\"answer\":\"no\",\"disease\":\"\"}', 'no', '', ''),
(4, 4, '012222222', '01222222222', '69 ستشهخاشهبش', 2020, '', '2019-07-11', 27, 1, 2, 2, 2, 1, 1, 1, '{\"name\":\"mahmoud\",\"mobile\":\"0133333333\",\"relation\":\"الأب\"}', '{\"name\":\"\",\"mobile\":\"\",\"relation\":\"\"}', '{\"answer\":\"no\",\"reason\":\"\"}', '{\"answer\":\"no\",\"disease\":\"\"}', 'yes', '', ''),
(5, 5, '0133333333', '013333333', 'شسبشسبشششلشس', 2020, '', '2019-07-13', 21, 1, 2, 1, 2, 1, 2, 1, '{\"name\":\"kareem\",\"mobile\":\"012222222\",\"relation\":\"الأب\"}', '{\"name\":\"\",\"mobile\":\"\",\"relation\":\"\"}', '{\"answer\":\"yes\",\"reason\":\"\"}', '{\"answer\":\"no\",\"disease\":\"\"}', 'no', '', ''),
(6, 9, '01555555555', '', 'يلسيلسسساسيا', 2020, '', '2019-07-05', 21, 1, 3, 1, 2, 2, 1, 1, '{\"name\":\"dsgsdhs\",\"mobile\":\"0111111111111111\",\"relation\":\"الزوج\"}', '{\"name\":\"\",\"mobile\":\"\",\"relation\":\"\"}', '{\"answer\":\"yes\",\"reason\":\"\"}', '{\"answer\":\"no\",\"disease\":\"\"}', 'yes', '', ''),
(7, 10, '019999999', '019999999999', 'samfishafoha', 2012, '', '2019-07-04', 54, 2, 2, 1, 1, 2, 2, 1, '{\"name\":\"asdadas\",\"mobile\":\"01222222222\",\"relation\":\"الأب\"}', '{\"name\":\"\",\"mobile\":\"\",\"relation\":\"\"}', '{\"answer\":\"no\",\"reason\":\"\"}', '{\"answer\":\"no\",\"disease\":\"\"}', 'no', '', ''),
(8, 11, '015555555', '0177777777777', 'بسيلس', 2023, '', '2019-07-11', 32, 1, 2, 1, 1, 3, 2, 1, '{\"name\":\"mohamed\",\"mobile\":\"01222222222\",\"relation\":\"الأب\"}', '{\"name\":\"\",\"mobile\":\"\",\"relation\":\"\"}', '{\"answer\":\"no\",\"reason\":\"\"}', '{\"answer\":\"no\",\"disease\":\"\"}', 'no', '', ''),
(9, 12, '23423423432234', '', 'سيبسيلللص', 0000, '', '2019-07-05', 20, 2, 2, 2, 1, 2, 1, 1, '{\"name\":\"amfioahag\",\"mobile\":\"234234\",\"relation\":\"الزوج\"}', '{\"name\":\"\",\"mobile\":\"\",\"relation\":\"\"}', '{\"answer\":\"no\",\"reason\":\"\"}', '{\"answer\":\"no\",\"disease\":\"\"}', 'no', '', ''),
(10, 13, '0166666', '', 'سيلسلسيل', 2020, '', '2019-07-12', 56, 1, 3, 2, 1, 3, 1, 2, '{\"name\":\"بلاتبلتب\",\"mobile\":\"بايايا\",\"relation\":null}', '{\"name\":\"\",\"mobile\":\"\",\"relation\":\"\"}', '{\"answer\":\"no\",\"reason\":\"\"}', '{\"answer\":\"no\",\"disease\":\"\"}', 'no', '', ''),
(11, 14, '23423423432234', '', 'dffr34534rsg', 1970, '', '2019-07-19', 53, 2, 2, 2, 2, 2, 2, 1, '{\"name\":\"sdfsd\",\"mobile\":\"53345435\",\"relation\":null}', '{\"name\":\"\",\"mobile\":\"\",\"relation\":\"\"}', '{\"answer\":\"no\",\"reason\":\"\"}', '{\"answer\":\"no\",\"disease\":\"\"}', 'no', '', ''),
(12, 15, '01222222222', '013333333333333', 'sdmfusgfuwhf', 2020, '24548945', '2019-07-04', 21, 1, 3, 1, 2, 1, 2, 1, '{\"name\":\"mohamed\",\"mobile\":\"015555555\",\"relation\":null}', '{\"name\":\"\",\"mobile\":\"\",\"relation\":\"\"}', '{\"answer\":\"no\",\"reason\":\"\"}', '{\"answer\":\"no\",\"disease\":\"\"}', 'no', '', ''),
(13, 16, '0155555555', '', 'fjhafuwwe', 2030, '', '2019-07-09', 21, 2, 2, 1, 2, 2, 2, 1, '{\"name\":\"amfioahag\",\"mobile\":\"53345435\",\"relation\":null}', '{\"name\":\"\",\"mobile\":\"\",\"relation\":\"\"}', '{\"answer\":\"no\",\"reason\":\"\"}', '{\"answer\":\"no\",\"disease\":\"\"}', 'no', '', ''),
(14, 19, '0166666', '', 'لاغهلخبف', 2030, '', '2019-07-12', 21, 1, 2, 2, 2, 3, 2, 1, '{\"name\":\"mohamed\",\"mobile\":\"53345435\",\"relation\":null}', '{\"name\":\"\",\"mobile\":\"\",\"relation\":\"\"}', '{\"answer\":\"Select Answer\",\"reason\":\"\"}', '{\"answer\":\"Select Answer\",\"disease\":\"\"}', 'Sele', '', ''),
(15, 20, '23423423432234', '', 'يلسللللسي', 2030, '', '2019-07-04', 31, 1, 2, 1, 2, 2, 1, 2, '{\"name\":\"mohamed\",\"mobile\":\"53345435\",\"relation\":null}', '{\"name\":\"\",\"mobile\":\"\",\"relation\":\"\"}', '{\"answer\":\"Select Answer\",\"reason\":\"\"}', '{\"answer\":\"Select Answer\",\"disease\":\"\"}', 'Sele', '', ''),
(16, 22, '23423423432234', '', 'يلسللللسي', 2030, '', '2019-07-04', 31, 1, 2, 1, 2, 2, 1, 2, '{\"name\":\"mohamed\",\"mobile\":\"53345435\",\"relation\":null}', '{\"name\":\"\",\"mobile\":\"\",\"relation\":\"\"}', '{\"answer\":\"Select Answer\",\"reason\":\"\"}', '{\"answer\":\"Select Answer\",\"disease\":\"\"}', 'Sele', '', ''),
(17, 23, '05498435435', '', 'يابسلت', 2015, '', '2019-08-16', 34, 2, 3, 2, 1, 2, 3, 1, '{\"name\":\"بيايتياي\",\"mobile\":\"24352523523\",\"relation\":null}', '{\"name\":\"\",\"mobile\":\"\",\"relation\":\"\"}', '{\"answer\":\"إختر إجابة\",\"reason\":\"\"}', '{\"answer\":\"إختر إجابة\",\"disease\":\"\"}', 'إختر', '', ''),
(18, 24, '01333333333', '', 'سلاياي', 2030, '', '2019-08-22', 23, 1, 1, 1, 1, 2, 1, 1, '{\"name\":\"بيايباي\",\"mobile\":\"3242342\",\"relation\":null}', '{\"name\":\"\",\"mobile\":\"\",\"relation\":\"\"}', '{\"answer\":\"إختر إجابة\",\"reason\":\"\"}', '{\"answer\":\"إختر إجابة\",\"disease\":\"\"}', 'إختر', '', ''),
(19, 25, '01333333333', '', 'بيايبايبا', 2020, '', '2019-08-10', 32, 2, 2, 2, 1, 2, 1, 2, '{\"name\":\"amfioahag\",\"mobile\":\"01222222222\",\"relation\":null}', '{\"name\":\"\",\"mobile\":\"\",\"relation\":\"\"}', '{\"answer\":\"إختر إجابة\",\"reason\":\"\"}', '{\"answer\":\"إختر إجابة\",\"disease\":\"\"}', 'إختر', '', ''),
(20, 26, '346363464363', '', 'فقفتلتبل', 2016, '', '2019-08-08', 56, 3, 3, 1, 2, 2, 2, 2, '{\"name\":\"لبءالباب\",\"mobile\":\"565463654\",\"relation\":null}', '{\"name\":\"\",\"mobile\":\"\",\"relation\":\"\"}', '{\"answer\":\"إختر إجابة\",\"reason\":\"\"}', '{\"answer\":\"إختر إجابة\",\"disease\":\"\"}', 'إختر', '', ''),
(21, 33, '2352325323', '', 'gwgwewe', 2030, '', '2019-08-02', 32, 1, 2, 1, 1, 1, 2, 1, '{\"name\":\"sdsgw\",\"mobile\":\"423423\",\"relation\":null}', '{\"name\":\"\",\"mobile\":\"\",\"relation\":\"\"}', '{\"answer\":\"إختر إجابة\",\"reason\":\"\"}', '{\"answer\":\"إختر إجابة\",\"disease\":\"\"}', 'إختر', '', ''),
(22, 34, '32123123', '', 'agagasa', 2020, '', '2019-08-09', 32, 2, 2, 1, 1, 2, 3, 2, '{\"name\":\"afgwegwew\",\"mobile\":\"123123213\",\"relation\":null}', '{\"name\":\"\",\"mobile\":\"\",\"relation\":\"\"}', '{\"answer\":\"إختر إجابة\",\"reason\":\"\"}', '{\"answer\":\"إختر إجابة\",\"disease\":\"\"}', 'إختر', '', ''),
(23, 35, '01222222222', '', 'يسلسيلسلسيل', 2030, '', '2019-09-05', 0, 1, 1, 1, 2, 1, 3, 1, '{\"name\":\"سيبسيبسبي\",\"mobile\":\"23123123\",\"relation\":null}', '{\"name\":\"\",\"mobile\":\"\",\"relation\":\"\"}', '{\"answer\":\"إختر إجابة\",\"reason\":\"\"}', '{\"answer\":\"إختر إجابة\",\"disease\":\"\"}', 'إختر', '', ''),
(24, 36, '432423423243', '', 'wefewgrere', 2014, '', '2017-02-01', 0, 3, 2, 1, 1, 1, 1, 1, '{\"name\":\"mohamed\",\"mobile\":\"53345435\",\"relation\":null}', '{\"name\":\"mohammed\",\"mobile\":\"53345435\",\"relation\":\"\"}', '{\"answer\":\"إختر إجابة\",\"reason\":\"\"}', '{\"answer\":\"إختر إجابة\",\"disease\":\"\"}', 'إختر', '', ''),
(25, 37, '022222222222', NULL, '', 0000, NULL, '0000-00-00', 0, 0, 0, 0, 0, 2, 0, 0, '', NULL, '', '', '', '', ''),
(26, 38, '432423423243', NULL, '', 0000, NULL, '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, '', NULL, '', '', '', '', ''),
(27, 39, '432423423243', NULL, '', 0000, NULL, '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, '', NULL, '', '', '', '', ''),
(28, 40, '022222222222', NULL, '', 0000, NULL, '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, '', NULL, '', '', '', '', ''),
(29, 41, '432423423243', NULL, '', 0000, NULL, '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, '', NULL, '', '', '', '', ''),
(30, 42, '432423423243', NULL, '', 0000, NULL, '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, '', NULL, '', '', '', '', ''),
(31, 43, '432423423243', NULL, '', 0000, NULL, '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, '', NULL, '', '', '', '', '');

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
(7, 'money is back', 1),
(8, 'suspended', 1),
(9, 'closed', 1);

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
(1, 1, 1, '2019-06-30', 1),
(2, 36, 0, '2019-09-01', 0),
(3, 37, 0, '2019-09-01', 0),
(4, 38, 0, '2019-09-01', 0),
(5, 39, 0, '2019-09-01', 0),
(6, 40, 0, '2019-09-01', 0),
(7, 41, 0, '2019-09-01', 0),
(8, 42, 0, '2019-09-01', 0),
(9, 43, 0, '2019-09-01', 0);

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
-- Table structure for table `table 29`
--

CREATE TABLE `table 29` (
  `COL 1` int(1) DEFAULT NULL,
  `COL 2` decimal(2,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `table 29`
--

INSERT INTO `table 29` (`COL 1`, `COL 2`) VALUES
(2, '4.5');

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
(5, 'Officer', 'officer', '123456', 1, 5, ''),
(6, 'Trainer', 'trainer', '123456', 1, 6, '');

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
(5, 'officer', 1, ''),
(6, 'trainer', 1, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance_exams`
--
ALTER TABLE `attendance_exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
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
-- Indexes for table `employees`
--
ALTER TABLE `employees`
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
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `joining_purposes`
--
ALTER TABLE `joining_purposes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lecture`
--
ALTER TABLE `lecture`
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
-- Indexes for table `old_salaries`
--
ALTER TABLE `old_salaries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `old_status`
--
ALTER TABLE `old_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id_index` (`student_id`);

--
-- Indexes for table `pay_cat`
--
ALTER TABLE `pay_cat`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `salaries`
--
ALTER TABLE `salaries`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `attendance_exams`
--
ALTER TABLE `attendance_exams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `expense_for`
--
ALTER TABLE `expense_for`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `joining_purposes`
--
ALTER TABLE `joining_purposes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lecture`
--
ALTER TABLE `lecture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=239;

--
-- AUTO_INCREMENT for table `lost_cards`
--
ALTER TABLE `lost_cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `military_status`
--
ALTER TABLE `military_status`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `old_salaries`
--
ALTER TABLE `old_salaries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `old_status`
--
ALTER TABLE `old_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `pay_cat`
--
ALTER TABLE `pay_cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pay_for`
--
ALTER TABLE `pay_for`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `salaries`
--
ALTER TABLE `salaries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `student_details`
--
ALTER TABLE `student_details`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `student_status`
--
ALTER TABLE `student_status`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `student_training`
--
ALTER TABLE `student_training`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
