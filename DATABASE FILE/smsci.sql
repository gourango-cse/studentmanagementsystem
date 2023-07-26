-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2022 at 11:12 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smsci`
--

-- --------------------------------------------------------

--
-- Table structure for table `running_session`
--

CREATE TABLE `running_session` (
  `id` int(11) NOT NULL,
  `session` text NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `running_session`
--

INSERT INTO `running_session` (`id`, `session`, `active`) VALUES
(1, '2022-2023', 1),
(2, '2023-2024', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sms_account_fees`
--

CREATE TABLE `sms_account_fees` (
  `id` int(11) NOT NULL,
  `ac_type` mediumint(9) DEFAULT NULL,
  `class_id` int(11) NOT NULL,
  `amount` double DEFAULT NULL,
  `session_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms_account_fees`
--

INSERT INTO `sms_account_fees` (`id`, `ac_type`, `class_id`, `amount`, `session_id`) VALUES
(26, 1, 1, 100, 1),
(27, 2, 1, 200, 1),
(28, 1, 30, 200, 1),
(29, 2, 30, 680, 1),
(30, 3, 30, 110, 1),
(31, 1, 41, 350, 1),
(32, 2, 41, 2088, 1),
(33, 3, 41, 120, 1),
(34, 3, 1, 110, 1),
(35, 2, 37, 1755, 1),
(36, 1, 37, 660, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sms_account_month`
--

CREATE TABLE `sms_account_month` (
  `id` int(11) NOT NULL,
  `name` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms_account_month`
--

INSERT INTO `sms_account_month` (`id`, `name`) VALUES
(1, 'January'),
(2, 'February'),
(3, 'March'),
(4, 'April'),
(5, 'May'),
(6, 'June'),
(7, 'July'),
(8, 'August'),
(9, 'September'),
(10, 'October'),
(11, 'November'),
(12, 'December');

-- --------------------------------------------------------

--
-- Table structure for table `sms_account_monthly_payment`
--

CREATE TABLE `sms_account_monthly_payment` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `month` varchar(10) NOT NULL,
  `amount` int(11) NOT NULL,
  `session_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms_account_monthly_payment`
--

INSERT INTO `sms_account_monthly_payment` (`id`, `student_id`, `month`, `amount`, `session_id`) VALUES
(40, 49, '1', 680, 1),
(41, 49, '2', 680, 1),
(42, 49, '3', 680, 1),
(43, 49, '4', 680, 1),
(44, 49, '5', 680, 1),
(45, 56, '1', 2088, 1),
(46, 56, '2', 2088, 1),
(47, 56, '3', 2088, 1),
(48, 56, '4', 2088, 1),
(49, 56, '5', 2088, 1),
(50, 56, '6', 2088, 1),
(51, 55, '1', 2088, 1),
(52, 55, '2', 2088, 1),
(53, 55, '3', 2088, 1),
(54, 55, '4', 2088, 1),
(55, 55, '5', 2088, 1),
(56, 55, '6', 2088, 1),
(57, 57, '1', 2088, 1),
(58, 57, '2', 2088, 1),
(59, 57, '3', 2088, 1),
(60, 58, '1', 2088, 1),
(61, 58, '2', 2088, 1),
(62, 59, '1', 2088, 1),
(63, 59, '2', 2088, 1),
(64, 59, '3', 2088, 1),
(65, 59, '4', 2088, 1),
(66, 59, '5', 2088, 1),
(67, 59, '1', 2088, 1),
(68, 59, '2', 2088, 1),
(69, 61, '1', 2088, 1),
(70, 62, '1', 2088, 1),
(71, 62, '2', 2088, 1),
(72, 62, '3', 2088, 1),
(73, 63, '1', 2088, 1),
(74, 63, '2', 2088, 1),
(75, 63, '3', 2088, 1),
(76, 66, '1', 2088, 1),
(77, 66, '2', 2088, 1),
(78, 66, '3', 2088, 1),
(79, 66, '4', 2088, 1),
(80, 72, '1', 2088, 1),
(81, 72, '2', 2088, 1),
(82, 72, '3', 2088, 1),
(83, 72, '4', 2088, 1),
(84, 72, '5', 2088, 1),
(85, 73, '1', 2088, 1),
(86, 73, '2', 2088, 1),
(87, 73, '3', 2088, 1),
(88, 74, '1', 2088, 1),
(89, 74, '2', 2088, 1),
(90, 74, '3', 2088, 1),
(91, 74, '4', 2088, 1),
(92, 74, '5', 2088, 1),
(93, 74, '6', 2088, 1),
(94, 74, '7', 2088, 1),
(95, 66, '5', 2088, 1),
(96, 66, '6', 2088, 1),
(97, 66, '7', 2088, 1),
(98, 73, '4', 2088, 1),
(99, 78, '1', 2088, 1),
(100, 78, '2', 2088, 1),
(101, 78, '3', 2088, 1),
(102, 78, '4', 2088, 1),
(103, 78, '5', 2088, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sms_account_type`
--

CREATE TABLE `sms_account_type` (
  `id` int(11) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `session_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms_account_type`
--

INSERT INTO `sms_account_type` (`id`, `name`, `session_id`) VALUES
(1, 'Admission', 1),
(2, 'Monthly', 1),
(3, 'Examination', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sms_attendance`
--

CREATE TABLE `sms_attendance` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `dt` date NOT NULL,
  `session_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms_attendance`
--

INSERT INTO `sms_attendance` (`id`, `student_id`, `class_id`, `section_id`, `dt`, `session_id`) VALUES
(23, 56, 41, 44, '2022-08-01', 1),
(24, 55, 41, 44, '2022-08-01', 1),
(25, 58, 41, 44, '2022-08-01', 1),
(26, 59, 41, 44, '2022-08-01', 1),
(27, 60, 41, 44, '2022-08-01', 1),
(28, 62, 41, 44, '2022-08-01', 1),
(29, 66, 41, 44, '2022-08-01', 1),
(30, 49, 30, 46, '2022-08-01', 1),
(31, 56, 41, 44, '2022-08-02', 1),
(32, 55, 41, 44, '2022-08-02', 1),
(33, 58, 41, 44, '2022-08-02', 1),
(34, 59, 41, 44, '2022-08-02', 1),
(35, 60, 41, 44, '2022-08-02', 1),
(36, 61, 41, 44, '2022-08-02', 1),
(37, 62, 41, 44, '2022-08-02', 1),
(38, 66, 41, 44, '2022-08-02', 1),
(39, 72, 41, 44, '2022-08-02', 1),
(40, 73, 41, 44, '2022-08-02', 1),
(41, 76, 41, 44, '2022-08-02', 1),
(42, 78, 41, 44, '2022-08-02', 1),
(43, 79, 41, 44, '2022-08-02', 1),
(44, 80, 41, 44, '2022-08-02', 1),
(45, 49, 30, 46, '2022-08-02', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sms_class`
--

CREATE TABLE `sms_class` (
  `name` varchar(20) NOT NULL,
  `id` int(2) NOT NULL,
  `num` int(11) NOT NULL,
  `teacher_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms_class`
--

INSERT INTO `sms_class` (`name`, `id`, `num`, `teacher_id`) VALUES
('One', 1, 1, 67),
('Eight', 36, 8, 51),
('Seven', 35, 7, NULL),
('Six', 34, 6, 54),
('Five', 33, 5, NULL),
('Three', 31, 3, NULL),
('Four', 32, 4, NULL),
('Two', 30, 2, 50),
('Nine', 37, 9, 53),
('Ten', 41, 10, 52);

-- --------------------------------------------------------

--
-- Table structure for table `sms_class_section`
--

CREATE TABLE `sms_class_section` (
  `id` int(11) NOT NULL,
  `name` varchar(5) NOT NULL,
  `class_id` int(11) NOT NULL,
  `teacher_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms_class_section`
--

INSERT INTO `sms_class_section` (`id`, `name`, `class_id`, `teacher_id`) VALUES
(34, 'A', 32, NULL),
(35, 'A', 33, NULL),
(21, 'A', 1, 37),
(33, 'A', 31, NULL),
(44, 'A', 41, 75),
(31, 'A', 24, NULL),
(36, 'A', 34, NULL),
(37, 'A', 35, NULL),
(38, 'A', 36, NULL),
(39, 'A', 37, 67),
(40, 'A', 38, NULL),
(41, 'A', 39, NULL),
(42, 'A', 40, NULL),
(43, 'B', 1, 38),
(46, 'A', 30, NULL),
(47, 'D', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sms_exam_marks`
--

CREATE TABLE `sms_exam_marks` (
  `id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `exam_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `marks` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms_exam_marks`
--

INSERT INTO `sms_exam_marks` (`id`, `class_id`, `exam_id`, `subject_id`, `student_id`, `marks`, `session_id`, `created_at`, `updated_at`) VALUES
(125, 41, 60, 82, 79, 47, 1, '2022-08-02 08:22:56', '2022-08-02 08:22:56'),
(124, 41, 60, 82, 78, 80, 1, '2022-08-02 08:22:56', '2022-08-02 08:22:56'),
(123, 41, 60, 82, 77, 58, 1, '2022-08-02 08:22:56', '2022-08-02 08:22:56'),
(122, 41, 60, 82, 76, 62, 1, '2022-08-02 08:22:56', '2022-08-02 08:22:56'),
(121, 41, 60, 82, 74, 79, 1, '2022-08-02 08:22:56', '2022-08-02 08:22:56'),
(120, 41, 60, 82, 73, 82, 1, '2022-08-02 08:22:56', '2022-08-02 08:22:56'),
(119, 41, 60, 82, 72, 70, 1, '2022-08-02 08:22:56', '2022-08-02 08:22:56'),
(118, 41, 60, 82, 66, 78, 1, '2022-08-02 08:22:56', '2022-08-02 08:22:56'),
(117, 41, 60, 82, 63, 51, 1, '2022-08-02 08:22:56', '2022-08-02 08:22:56'),
(116, 41, 60, 82, 62, 67, 1, '2022-08-02 08:22:56', '2022-08-02 08:22:56'),
(115, 41, 60, 82, 61, 62, 1, '2022-08-02 08:22:56', '2022-08-02 08:22:56'),
(114, 41, 60, 82, 60, 71, 1, '2022-08-02 08:22:56', '2022-08-02 08:22:56'),
(113, 41, 60, 82, 59, 49, 1, '2022-08-02 08:22:56', '2022-08-02 08:22:56'),
(112, 41, 60, 82, 58, 55, 1, '2022-08-02 08:22:56', '2022-08-02 08:22:56'),
(111, 41, 60, 82, 57, 61, 1, '2022-08-02 08:22:56', '2022-08-02 08:22:56'),
(110, 41, 60, 82, 55, 66, 1, '2022-08-02 08:22:56', '2022-08-02 08:22:56'),
(109, 41, 60, 82, 56, 62, 1, '2022-08-02 08:22:56', '2022-08-02 08:22:56'),
(108, 41, 60, 81, 80, 51, 1, '2022-08-02 08:21:48', '2022-08-02 08:21:48'),
(107, 41, 60, 81, 79, 66, 1, '2022-08-02 08:21:48', '2022-08-02 08:21:48'),
(106, 41, 60, 81, 78, 59, 1, '2022-08-02 08:21:48', '2022-08-02 08:21:48'),
(105, 41, 60, 81, 77, 50, 1, '2022-08-02 08:21:48', '2022-08-02 08:21:48'),
(104, 41, 60, 81, 76, 71, 1, '2022-08-02 08:21:48', '2022-08-02 08:21:48'),
(103, 41, 60, 81, 74, 49, 1, '2022-08-02 08:21:48', '2022-08-02 08:21:48'),
(102, 41, 60, 81, 73, 32, 1, '2022-08-02 08:21:47', '2022-08-02 08:21:47'),
(101, 41, 60, 81, 72, 42, 1, '2022-08-02 08:21:47', '2022-08-02 08:21:47'),
(100, 41, 60, 81, 66, 79, 1, '2022-08-02 08:21:47', '2022-08-02 08:21:47'),
(99, 41, 60, 81, 63, 55, 1, '2022-08-02 08:21:47', '2022-08-02 08:21:47'),
(98, 41, 60, 81, 62, 40, 1, '2022-08-02 08:21:47', '2022-08-02 08:21:47'),
(97, 41, 60, 81, 61, 84, 1, '2022-08-02 08:21:47', '2022-08-02 08:21:47'),
(96, 41, 60, 81, 60, 72, 1, '2022-08-02 08:21:47', '2022-08-02 08:21:47'),
(95, 41, 60, 81, 59, 69, 1, '2022-08-02 08:21:47', '2022-08-02 08:21:47'),
(94, 41, 60, 81, 58, 45, 1, '2022-08-02 08:21:47', '2022-08-02 08:21:47'),
(93, 41, 60, 81, 57, 57, 1, '2022-08-02 08:21:47', '2022-08-02 08:21:47'),
(92, 41, 60, 81, 55, 52, 1, '2022-08-02 08:21:47', '2022-08-02 08:21:47'),
(91, 41, 60, 81, 56, 66, 1, '2022-08-02 08:21:47', '2022-08-02 08:21:47'),
(90, 41, 60, 80, 80, 72, 1, '2022-08-02 08:20:23', '2022-08-02 08:20:23'),
(89, 41, 60, 80, 79, 88, 1, '2022-08-02 08:20:23', '2022-08-02 08:20:23'),
(88, 41, 60, 80, 78, 40, 1, '2022-08-02 08:20:23', '2022-08-02 08:20:23'),
(87, 41, 60, 80, 77, 60, 1, '2022-08-02 08:20:23', '2022-08-02 08:20:23'),
(86, 41, 60, 80, 76, 64, 1, '2022-08-02 08:20:23', '2022-08-02 08:20:23'),
(85, 41, 60, 80, 74, 49, 1, '2022-08-02 08:20:23', '2022-08-02 08:20:23'),
(84, 41, 60, 80, 73, 71, 1, '2022-08-02 08:20:23', '2022-08-02 08:20:23'),
(83, 41, 60, 80, 72, 57, 1, '2022-08-02 08:20:23', '2022-08-02 08:20:23'),
(82, 41, 60, 80, 66, 66, 1, '2022-08-02 08:20:23', '2022-08-02 08:20:23'),
(81, 41, 60, 80, 63, 44, 1, '2022-08-02 08:20:23', '2022-08-02 08:20:23'),
(80, 41, 60, 80, 62, 92, 1, '2022-08-02 08:20:23', '2022-08-02 08:20:23'),
(79, 41, 60, 80, 61, 79, 1, '2022-08-02 08:20:23', '2022-08-02 08:20:23'),
(78, 41, 60, 80, 60, 75, 1, '2022-08-02 08:20:23', '2022-08-02 08:20:23'),
(77, 41, 60, 80, 59, 75, 1, '2022-08-02 08:20:23', '2022-08-02 08:20:23'),
(76, 41, 60, 80, 58, 48, 1, '2022-08-02 08:20:23', '2022-08-02 08:20:23'),
(75, 41, 60, 80, 57, 50, 1, '2022-08-02 08:20:23', '2022-08-02 08:20:23'),
(74, 41, 60, 80, 55, 52, 1, '2022-08-02 08:20:23', '2022-08-02 08:20:23'),
(73, 41, 60, 80, 56, 67, 1, '2022-08-02 08:20:23', '2022-08-02 08:20:23'),
(126, 41, 60, 82, 80, 77, 1, '2022-08-02 08:22:56', '2022-08-02 08:22:56'),
(127, 41, 60, 83, 56, 48, 1, '2022-08-02 08:24:47', '2022-08-02 08:24:47'),
(128, 41, 60, 83, 55, 51, 1, '2022-08-02 08:24:47', '2022-08-02 08:24:47'),
(129, 41, 60, 83, 57, 44, 1, '2022-08-02 08:24:47', '2022-08-02 08:24:47'),
(130, 41, 60, 83, 58, 41, 1, '2022-08-02 08:24:47', '2022-08-02 08:24:47'),
(131, 41, 60, 83, 59, 59, 1, '2022-08-02 08:24:47', '2022-08-02 08:24:47'),
(132, 41, 60, 83, 60, 62, 1, '2022-08-02 08:24:47', '2022-08-02 08:24:47'),
(133, 41, 60, 83, 61, 70, 1, '2022-08-02 08:24:47', '2022-08-02 08:24:47'),
(134, 41, 60, 83, 62, 70, 1, '2022-08-02 08:24:47', '2022-08-02 08:24:47'),
(135, 41, 60, 83, 63, 53, 1, '2022-08-02 08:24:47', '2022-08-02 08:24:47'),
(136, 41, 60, 83, 66, 59, 1, '2022-08-02 08:24:47', '2022-08-02 08:24:47'),
(137, 41, 60, 83, 72, 64, 1, '2022-08-02 08:24:47', '2022-08-02 08:24:47'),
(138, 41, 60, 83, 73, 44, 1, '2022-08-02 08:24:47', '2022-08-02 08:24:47'),
(139, 41, 60, 83, 74, 40, 1, '2022-08-02 08:24:47', '2022-08-02 08:24:47'),
(140, 41, 60, 83, 76, 78, 1, '2022-08-02 08:24:47', '2022-08-02 08:24:47'),
(141, 41, 60, 83, 77, 69, 1, '2022-08-02 08:24:47', '2022-08-02 08:24:47'),
(142, 41, 60, 83, 78, 51, 1, '2022-08-02 08:24:47', '2022-08-02 08:24:47'),
(143, 41, 60, 83, 79, 53, 1, '2022-08-02 08:24:47', '2022-08-02 08:24:47'),
(144, 41, 60, 83, 80, 79, 1, '2022-08-02 08:24:47', '2022-08-02 08:24:47'),
(145, 41, 60, 84, 56, 71, 1, '2022-08-02 08:26:04', '2022-08-02 08:26:04'),
(146, 41, 60, 84, 55, 55, 1, '2022-08-02 08:26:04', '2022-08-02 08:26:04'),
(147, 41, 60, 84, 57, 59, 1, '2022-08-02 08:26:04', '2022-08-02 08:26:04'),
(148, 41, 60, 84, 58, 63, 1, '2022-08-02 08:26:04', '2022-08-02 08:26:04'),
(149, 41, 60, 84, 59, 67, 1, '2022-08-02 08:26:04', '2022-08-02 08:26:04'),
(150, 41, 60, 84, 60, 41, 1, '2022-08-02 08:26:04', '2022-08-02 08:26:04'),
(151, 41, 60, 84, 61, 75, 1, '2022-08-02 08:26:04', '2022-08-02 08:26:04'),
(152, 41, 60, 84, 62, 44, 1, '2022-08-02 08:26:04', '2022-08-02 08:26:04'),
(153, 41, 60, 84, 63, 59, 1, '2022-08-02 08:26:04', '2022-08-02 08:26:04'),
(154, 41, 60, 84, 66, 66, 1, '2022-08-02 08:26:04', '2022-08-02 08:26:04'),
(155, 41, 60, 84, 72, 69, 1, '2022-08-02 08:26:04', '2022-08-02 08:26:04'),
(156, 41, 60, 84, 73, 61, 1, '2022-08-02 08:26:04', '2022-08-02 08:26:04'),
(157, 41, 60, 84, 74, 80, 1, '2022-08-02 08:26:04', '2022-08-02 08:26:04'),
(158, 41, 60, 84, 76, 83, 1, '2022-08-02 08:26:04', '2022-08-02 08:26:04'),
(159, 41, 60, 84, 77, 90, 1, '2022-08-02 08:26:04', '2022-08-02 08:26:04'),
(160, 41, 60, 84, 78, 74, 1, '2022-08-02 08:26:04', '2022-08-02 08:26:04'),
(161, 41, 60, 84, 79, 47, 1, '2022-08-02 08:26:04', '2022-08-02 08:26:04'),
(162, 41, 60, 84, 80, 68, 1, '2022-08-02 08:26:04', '2022-08-02 08:26:04'),
(163, 41, 59, 80, 56, 62, 1, '2022-08-02 12:56:39', '2022-08-02 12:56:39'),
(164, 41, 59, 80, 55, 45, 1, '2022-08-02 12:56:39', '2022-08-02 12:56:39'),
(165, 41, 59, 80, 57, 52, 1, '2022-08-02 12:56:39', '2022-08-02 12:56:39'),
(166, 41, 59, 80, 58, 66, 1, '2022-08-02 12:56:39', '2022-08-02 12:56:39'),
(167, 41, 59, 80, 59, 79, 1, '2022-08-02 12:56:39', '2022-08-02 12:56:39'),
(168, 41, 59, 80, 60, 91, 1, '2022-08-02 12:56:39', '2022-08-02 12:56:39'),
(169, 41, 59, 80, 61, 82, 1, '2022-08-02 12:56:39', '2022-08-02 12:56:39'),
(170, 41, 59, 80, 62, 83, 1, '2022-08-02 12:56:39', '2022-08-02 12:56:39'),
(171, 41, 59, 80, 63, 40, 1, '2022-08-02 12:56:39', '2022-08-02 12:56:39'),
(172, 41, 59, 80, 66, 48, 1, '2022-08-02 12:56:39', '2022-08-02 12:56:39'),
(173, 41, 59, 80, 72, 59, 1, '2022-08-02 12:56:39', '2022-08-02 12:56:39'),
(174, 41, 59, 80, 73, 67, 1, '2022-08-02 12:56:39', '2022-08-02 12:56:39'),
(175, 41, 59, 80, 74, 65, 1, '2022-08-02 12:56:39', '2022-08-02 12:56:39'),
(176, 41, 59, 80, 76, 43, 1, '2022-08-02 12:56:39', '2022-08-02 12:56:39'),
(177, 41, 59, 80, 77, 93, 1, '2022-08-02 12:56:39', '2022-08-02 12:56:39'),
(178, 41, 59, 80, 78, 82, 1, '2022-08-02 12:56:39', '2022-08-02 12:56:39'),
(179, 41, 59, 80, 79, 70, 1, '2022-08-02 12:56:39', '2022-08-02 12:56:39'),
(180, 41, 59, 80, 80, 40, 1, '2022-08-02 12:56:39', '2022-08-02 12:56:39');

-- --------------------------------------------------------

--
-- Table structure for table `sms_exam_routine`
--

CREATE TABLE `sms_exam_routine` (
  `id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `exam_id` int(11) DEFAULT NULL,
  `name` text,
  `routine` text,
  `session_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms_exam_routine`
--

INSERT INTO `sms_exam_routine` (`id`, `class_id`, `exam_id`, `name`, `routine`, `session_id`, `created_at`, `updated_at`) VALUES
(2, 0, 60, 'sample_routine.jpg', '0e56756af42dc5ec69b1ecb2dda1f47a.jpg', 1, '2022-08-01 15:38:57', '2022-08-01 15:38:57'),
(3, 0, 59, 'sample_routine.jpg', '4c02c383649328e016fe212e433ddfb4.jpg', 1, '2022-08-01 16:52:57', '2022-08-01 16:52:57');

-- --------------------------------------------------------

--
-- Table structure for table `sms_exam_type`
--

CREATE TABLE `sms_exam_type` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms_exam_type`
--

INSERT INTO `sms_exam_type` (`id`, `name`, `created_at`, `updated_at`) VALUES
(60, 'First Terminal', '2016-09-05 09:40:22', '2016-09-05 09:40:22'),
(62, 'Third Terminal', '2016-09-13 13:29:22', '2016-09-13 13:29:22'),
(59, 'Second Terminal', '2016-09-05 09:40:16', '2016-09-05 09:40:16'),
(63, 'Final Terminal', '2022-08-01 16:33:03', '2022-08-01 16:33:03');

-- --------------------------------------------------------

--
-- Table structure for table `sms_groups`
--

CREATE TABLE `sms_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `definition` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sms_groups`
--

INSERT INTO `sms_groups` (`id`, `name`, `definition`) VALUES
(1, 'Admin', 'Super Admin Group'),
(2, 'Teacher', 'Teacher Access Group'),
(3, 'Student', 'Student Access Group'),
(4, 'Parent', 'Parent Access Group');

-- --------------------------------------------------------

--
-- Table structure for table `sms_group_to_group`
--

CREATE TABLE `sms_group_to_group` (
  `group_id` int(11) UNSIGNED NOT NULL,
  `subgroup_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sms_library`
--

CREATE TABLE `sms_library` (
  `id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `publication` varchar(30) DEFAULT NULL,
  `author` varchar(30) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `subject_id` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms_library`
--

INSERT INTO `sms_library` (`id`, `name`, `publication`, `author`, `class_id`, `subject_id`, `updated_at`, `created_at`) VALUES
(21, 'Programming Basics', 'Astro Publications', 'Alger Cummings', 41, 82, '2022-08-01 15:56:53', '2022-08-01 15:56:53'),
(22, 'The Structure of Scientific Re', 'University of Chicago Press', 'Thomas Kuhn', 41, 81, '2022-08-01 16:01:45', '2022-08-01 16:01:45'),
(23, 'Linear Algebra Done Right', 'Springer Science & Business Me', 'Sheldon Axler', 41, 80, '2022-08-01 16:04:39', '2022-08-01 16:04:39');

-- --------------------------------------------------------

--
-- Table structure for table `sms_notice`
--

CREATE TABLE `sms_notice` (
  `id` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `body` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms_notice`
--

INSERT INTO `sms_notice` (`id`, `title`, `body`, `created_at`, `updated_at`) VALUES
(1, 'Testing', 'This is a demo message', '2022-05-09 22:25:17', '2022-05-09 22:45:31'),
(2, 'Testing 2.0', 'Testing. This is a demo notice for all', '2022-05-09 22:28:40', '2022-05-09 22:29:59'),
(3, 'Demo Notice', 'Just a demo notice for testing', '2022-08-01 16:27:08', '2022-08-01 16:27:08');

-- --------------------------------------------------------

--
-- Table structure for table `sms_perms`
--

CREATE TABLE `sms_perms` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `definition` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sms_perms`
--

INSERT INTO `sms_perms` (`id`, `name`, `definition`) VALUES
(1, 'Admin', 'Administration only'),
(2, 'Teacher', 'teacher'),
(3, 'Student', NULL),
(4, 'Parent', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sms_perm_to_group`
--

CREATE TABLE `sms_perm_to_group` (
  `perm_id` int(11) UNSIGNED NOT NULL,
  `group_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sms_perm_to_group`
--

INSERT INTO `sms_perm_to_group` (`perm_id`, `group_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `sms_perm_to_user`
--

CREATE TABLE `sms_perm_to_user` (
  `perm_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sms_perm_to_user`
--

INSERT INTO `sms_perm_to_user` (`perm_id`, `user_id`) VALUES
(1, 1),
(1, 44),
(1, 71),
(2, 37),
(2, 48),
(2, 50),
(2, 51),
(2, 52),
(2, 53),
(2, 54),
(2, 67),
(2, 75),
(3, 38),
(3, 43),
(3, 45),
(3, 47),
(3, 49),
(3, 55),
(3, 56),
(3, 57),
(3, 58),
(3, 59),
(3, 60),
(3, 61),
(3, 62),
(3, 63),
(3, 66),
(3, 72),
(3, 73),
(3, 74),
(3, 76),
(3, 77),
(3, 78),
(3, 79),
(3, 80),
(4, 40),
(4, 41),
(4, 42),
(4, 46),
(4, 81);

-- --------------------------------------------------------

--
-- Table structure for table `sms_pms`
--

CREATE TABLE `sms_pms` (
  `id` int(11) UNSIGNED NOT NULL,
  `sender_id` int(11) UNSIGNED NOT NULL,
  `receiver_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text,
  `date_sent` datetime DEFAULT NULL,
  `date_read` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sms_pms`
--

INSERT INTO `sms_pms` (`id`, `sender_id`, `receiver_id`, `title`, `message`, `date_sent`, `date_read`) VALUES
(6, 71, 52, 'Welcome', '<p>Welcome Mr. McDaniel to this wonderful School Management System.</p>', '2022-07-31 18:16:02', '2022-08-02 15:06:14'),
(7, 52, 71, 'Regarding Test Subject', '<p>This is a demo text message for testing purpose.&nbsp;\r\n\r\nThis is a demo text message for testing purpose.&nbsp;\r\n\r\nThis is a demo text message for testing purpose.&nbsp;\r\n\r\nThis is a demo text message for testing purpose.\r\n\r\n</p>', '2022-08-02 10:17:57', NULL),
(8, 54, 71, 'Sample Subject', '<p>And here goes the second testing. An attempt to compose and send mails to the system administrator.</p>', '2022-08-02 10:58:24', '2022-08-02 15:02:41'),
(9, 52, 66, 'Demo Subject', '<p>Hello there Mr. Moore,</p><p>This is a demo text message from teacher\'s account.</p>', '2022-08-02 15:06:52', '2022-08-02 15:11:19');

-- --------------------------------------------------------

--
-- Table structure for table `sms_security`
--

CREATE TABLE `sms_security` (
  `user_id` int(11) NOT NULL,
  `warning` int(11) DEFAULT '0',
  `log` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms_security`
--

INSERT INTO `sms_security` (`user_id`, `warning`, `log`) VALUES
(38, 0, NULL),
(1, 0, NULL),
(43, 0, NULL),
(44, 0, NULL),
(45, 0, NULL),
(37, 0, NULL),
(46, 0, NULL),
(47, 0, NULL),
(48, 0, NULL),
(42, 0, NULL),
(49, 0, NULL),
(50, 0, NULL),
(51, 0, NULL),
(52, 0, NULL),
(53, 0, NULL),
(54, 0, NULL),
(55, 0, NULL),
(56, 0, NULL),
(57, 0, NULL),
(58, 0, NULL),
(59, 0, NULL),
(60, 0, NULL),
(61, 0, NULL),
(62, 0, NULL),
(63, 0, NULL),
(64, 0, NULL),
(65, 0, NULL),
(66, 0, NULL),
(67, 0, NULL),
(68, 0, NULL),
(69, 0, NULL),
(70, 0, NULL),
(71, 0, NULL),
(72, 0, NULL),
(73, 0, NULL),
(74, 0, NULL),
(75, 0, NULL),
(76, 0, NULL),
(77, 0, NULL),
(78, 0, NULL),
(79, 0, NULL),
(80, 0, NULL),
(81, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sms_student`
--

CREATE TABLE `sms_student` (
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) DEFAULT NULL,
  `parent_id` int(11) NOT NULL,
  `roll` int(11) NOT NULL,
  `transport_id` int(11) DEFAULT NULL,
  `hostel_id` int(11) DEFAULT NULL,
  `session_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms_student`
--

INSERT INTO `sms_student` (`student_id`, `class_id`, `section_id`, `parent_id`, `roll`, `transport_id`, `hostel_id`, `session_id`, `created_at`, `updated_at`) VALUES
(56, 41, 44, 1, 2, 0, 0, 1, '2022-07-31 16:46:52', '2022-07-31 16:46:52'),
(55, 41, 44, 2, 1, 0, 0, 1, '2022-07-31 16:41:35', '2022-07-31 16:41:35'),
(49, 30, 46, 1, 1, 0, 0, 1, '2022-07-31 12:21:35', '2022-07-31 12:21:35'),
(57, 41, 44, 1, 3, 0, 0, 1, '2022-07-31 16:48:26', '2022-07-31 16:48:26'),
(58, 41, 44, 3, 4, 0, 0, 1, '2022-07-31 16:49:38', '2022-07-31 16:49:38'),
(59, 41, 44, 1, 5, 0, 0, 1, '2022-07-31 16:51:34', '2022-07-31 16:51:34'),
(60, 41, 44, 2, 6, 0, 0, 1, '2022-07-31 16:52:55', '2022-07-31 16:52:55'),
(61, 41, 44, 1, 7, 0, 0, 1, '2022-07-31 16:55:18', '2022-07-31 16:55:18'),
(62, 41, 44, 3, 8, 0, 0, 1, '2022-07-31 16:56:50', '2022-07-31 16:56:50'),
(63, 41, 44, 3, 9, 0, 0, 1, '2022-07-31 16:58:00', '2022-07-31 16:58:00'),
(66, 41, 44, 1, 10, 0, 0, 1, '2022-08-01 14:31:57', '2022-08-01 14:31:57'),
(72, 41, 44, 3, 11, 0, 0, 1, '2022-08-02 05:51:01', '2022-08-02 05:51:01'),
(73, 41, 44, 3, 12, 0, 0, 1, '2022-08-02 05:52:03', '2022-08-02 05:52:03'),
(74, 41, 44, 3, 13, 0, 0, 1, '2022-08-02 05:53:05', '2022-08-02 05:53:05'),
(76, 41, 44, 1, 14, 0, 0, 1, '2022-08-02 07:53:28', '2022-08-02 07:53:28'),
(77, 41, 44, 2, 15, 0, 0, 1, '2022-08-02 07:54:28', '2022-08-02 07:54:28'),
(78, 41, 44, 3, 16, 0, 0, 1, '2022-08-02 07:55:23', '2022-08-02 07:55:23'),
(79, 41, 44, 2, 17, 0, 0, 1, '2022-08-02 07:56:38', '2022-08-02 07:56:38'),
(80, 41, 44, 3, 18, 0, 0, 1, '2022-08-02 07:58:01', '2022-08-02 07:58:01');

-- --------------------------------------------------------

--
-- Table structure for table `sms_student_account`
--

CREATE TABLE `sms_student_account` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `month` varchar(15) DEFAULT NULL,
  `amount` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sms_studycomments`
--

CREATE TABLE `sms_studycomments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `body` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sms_studymaterial`
--

CREATE TABLE `sms_studymaterial` (
  `id` int(11) NOT NULL,
  `name` text,
  `class_id` int(11) DEFAULT NULL,
  `section_id` int(11) NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `detail` text,
  `file` text NOT NULL,
  `count` int(11) DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `session_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms_studymaterial`
--

INSERT INTO `sms_studymaterial` (`id`, `name`, `class_id`, `section_id`, `subject_id`, `detail`, `file`, `count`, `user_id`, `created_at`, `updated_at`, `session_id`) VALUES
(11, 'sample_image.jpg', 41, 44, 82, 'Just a demo study material for Grade Ten - Computer Science', 'aa746bdfc54e20f6577c5fcd4d7c6f63.jpg', 9, 52, '2022-07-31 13:17:10', '2022-07-31 13:17:10', 1),
(12, 'pdfsample.jpg', 41, 44, 81, 'Question Sets', '19d857e81ec3511e3b971d7d4501327d.jpg', 4, 51, '2022-08-02 04:56:32', '2022-08-02 04:56:32', 1),
(13, 'quesample.png', 41, 44, 80, 'List of practice question for all the Grade 10 students. Keep Practicing, Keep Learning!!', '57c45948ae08c401fe0b71f5efd8bdb1.png', 11, 54, '2022-08-02 05:09:56', '2022-08-02 05:09:56', 1),
(14, 'quesample_lst.png', 41, 44, 82, 'List of question set for all the Grade Ten students.', 'f94e3e23c290db5d86e584da3e71ff3c.png', 1, 52, '2022-08-02 09:20:14', '2022-08-02 09:20:14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sms_subject`
--

CREATE TABLE `sms_subject` (
  `id` int(11) NOT NULL,
  `name` varchar(40) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT '0',
  `class_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms_subject`
--

INSERT INTO `sms_subject` (`id`, `name`, `teacher_id`, `class_id`) VALUES
(3, 'Math', 0, 1),
(61, 'Science', 0, 1),
(71, 'Math', 0, 37),
(73, 'Social', 0, 37),
(75, 'Account', 0, 37),
(74, 'EPH', 0, 37),
(69, 'English', 0, 31),
(64, 'English', 0, 36),
(63, 'English', 0, 37),
(60, 'Math', 0, 30),
(59, 'Social Studies', 0, 30),
(58, 'Science', 0, 30),
(68, 'English', 0, 32),
(67, 'English', 0, 33),
(66, 'English', 0, 34),
(65, 'English', 0, 35),
(77, 'OPT Math', 0, 37),
(76, 'Science', 0, 37),
(78, 'Health', 0, 1),
(80, 'Mathematics', 54, 41),
(81, 'Science', 51, 41),
(82, 'Computer Science', 52, 41),
(83, 'Social Studies', 50, 41),
(84, 'Health', 51, 41);

-- --------------------------------------------------------

--
-- Table structure for table `sms_syllabus`
--

CREATE TABLE `sms_syllabus` (
  `id` int(11) NOT NULL,
  `name` text,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `file` text NOT NULL,
  `count` int(11) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms_syllabus`
--

INSERT INTO `sms_syllabus` (`id`, `name`, `class_id`, `subject_id`, `file`, `count`, `created_at`, `updated_at`) VALUES
(17, 'sample_syllabus.png', 41, 82, '2ab6fc8c426a577f0022bd29f04f66eb.png', 6, '2022-08-01 16:51:41', '2022-08-01 16:51:41'),
(18, 'sample_syllabus.png', 41, 81, '2cffa926995f94507a533678049bc4b0.png', 2, '2022-08-01 16:58:04', '2022-08-01 16:58:04');

-- --------------------------------------------------------

--
-- Table structure for table `sms_system_variables`
--

CREATE TABLE `sms_system_variables` (
  `id` int(11) UNSIGNED NOT NULL,
  `data_key` varchar(100) NOT NULL,
  `value` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sms_transport`
--

CREATE TABLE `sms_transport` (
  `id` int(11) NOT NULL,
  `driver` varchar(30) DEFAULT NULL,
  `bus` varchar(10) DEFAULT NULL,
  `route` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms_transport`
--

INSERT INTO `sms_transport` (`id`, `driver`, `bus`, `route`) VALUES
(1, 'Driver M', 'Evrt Bus', '55 Blecker Street');

-- --------------------------------------------------------

--
-- Table structure for table `sms_users`
--

CREATE TABLE `sms_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(64) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `role` varchar(7) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `contact` text NOT NULL,
  `address` text NOT NULL,
  `dob` text NOT NULL,
  `pro_pic` text NOT NULL,
  `banned` tinyint(1) DEFAULT '0',
  `last_login` datetime DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `last_login_attempt` datetime DEFAULT NULL,
  `forgot_exp` text,
  `remember_time` datetime DEFAULT NULL,
  `remember_exp` text,
  `verification_code` text,
  `totp_secret` varchar(16) DEFAULT NULL,
  `ip_address` text,
  `login_attempts` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sms_users`
--

INSERT INTO `sms_users` (`id`, `email`, `pass`, `name`, `role`, `gender`, `full_name`, `contact`, `address`, `dob`, `pro_pic`, `banned`, `last_login`, `last_activity`, `last_login_attempt`, `forgot_exp`, `remember_time`, `remember_exp`, `verification_code`, `totp_secret`, `ip_address`, `login_attempts`) VALUES
(42, 'carlos@mail.com', '58bc6f9d25988ed5e1dda828fe1ddb0539f787dffae675d43e983c0f5ecb34bf', 'carlos', 'Parent', 'male', 'Carlos Bollinger', '+(101) 1260-001130', '58 Stout Street', '06/12/1985', 'defaultimg01.jpg', 0, '2022-08-02 15:11:50', '2022-08-02 15:11:50', '2022-08-02 15:00:00', NULL, NULL, NULL, 'KBqPbOkVnPLnLTKM', NULL, '::1', NULL),
(46, 'dannyl@mail.com', '289f9c1a054dc0e81d65f723419f548e6273cc7abc0324c50951b0f290f18199', 'dannyl', 'Parent', 'male', 'Danny Lockwood', '+(001) 7775-552000', '4003 Hoffman Avenue', '12/02/1975', 'avatarm7-min.jpg', 0, '2022-08-01 15:20:56', '2022-08-01 15:20:56', '2022-08-01 15:00:00', NULL, NULL, NULL, 'Cussw3lBYyg94hnl', NULL, '::1', NULL),
(49, 'rudolph@mail.com', 'ad1d908ef46e309bcf6b422be0239524358d809499561c3d7b9c095d1cf24743', 'rudolph', 'Student', 'male', 'Rudolph Thomson', '+(001) 1234-568887', '85 Hillcrest Avenue', '05/09/2017', 'gr1.png', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'uv2uQbbB06Z06k5T', NULL, NULL, 0),
(50, 'audrey@mail.com', '3acbefd3cb5105dfed7e8ebf48f74a06aea7e7bf6c637f51f8ddd71377d6029c', 'audrey', 'Teacher', 'female', 'Audrey O. Whitehead', '+(000) 1112-224458', '86 Carolyns Circle', '03/08/1986', 'avatarm4-min.jpg', 0, '2022-07-31 14:30:05', '2022-07-31 14:30:05', '2022-07-31 14:00:00', NULL, NULL, NULL, 'a9fjHegH6WnbHNzB', NULL, '::1', NULL),
(51, 'michaelc@mail.com', '26095d49a7f4716c67a1ecfed03856b99704bd0dcf791a82a1e819e74e4aad60', 'michael', 'Teacher', 'male', 'Michael S. Cohee', '+(000) 0012-124588', '7 Conaway Street', '11/03/1988', 'user-profile-min.png', 0, '2022-08-02 11:13:56', '2022-08-02 11:13:56', '2022-08-02 11:00:00', NULL, NULL, NULL, 'mGgkFU0n09tRdIiy', NULL, '::1', NULL),
(52, 'arthurm@mail.com', '415150b8a1c2bb968afae2f8da0b35eb2f2c3ff24dab8315e543ff7e4025b8a2', 'arthur', 'Teacher', 'male', 'Arthur M. McDaniel', '+(000) 1255-884458', '11 Overlook Drive', '07/05/1982', 'user-default-min.png', 0, '2022-08-02 15:03:43', '2022-08-02 15:03:43', '2022-08-02 15:00:00', NULL, NULL, NULL, 'Dux55c0BUfilExxz', NULL, '::1', NULL),
(53, 'kathleen@mail.com', '43ee9d7c230c042dc7109149e1ddc271df471b94d131cb47433ceefabb5a688c', 'kathleen', 'Teacher', 'female', 'Kathleen S. Bouknight', '+(001) 0021-254587', '37 Emma Street', '03/02/1980', 'useravatar7-min.png', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'cTRP8CENZQcHBMin', NULL, NULL, 0),
(54, 'robert@mail.com', 'f78fde7183a5be80ae33ca9a4885fba564eeaf9f48e595eec43d8c2f540f17d7', 'robert', 'Teacher', 'male', 'Robert D. Pickel', '+(000) 1258-888965', '602 Hidden Valley Road', '07/05/1981', 'avatarm7-min1.jpg', 0, '2022-08-02 10:50:59', '2022-08-02 10:51:00', '2022-08-02 10:00:00', NULL, NULL, NULL, 'EwZWVbxshTK8OnLn', NULL, '::1', NULL),
(55, 'bessied@mail.com', 'e4764e0dde075f5ae3e7380fdfd058c3484f75ed9901076cdfeb8beb22af37ec', 'bessie', 'Student', 'female', 'Bessie Denton', '+(002) 1254-545555', '68 Angus Road', '11/04/2006', 'user-min.png', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'nw3EfGImzi86Hm4p', NULL, NULL, 0),
(56, 'deborahc@mail.com', '241518aef5333d4a380da97e85ab8ccce6ed23df7c5c96c7b7ca923eed3a45b7', 'deborah', 'Student', 'female', 'Deborah Conner', '+(001) 4545-854588', '96 Sharon Lane', '07/20/2005', 'defaultimg.jpg', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'isIpxbC6WUpMO8jh', NULL, NULL, 0),
(57, 'charlesm@mail.com', '56c16d2dd6f7a2d699e0d20214c4482ea21d50b8d485c478702e506fc22b8f2d', 'charles', 'Student', 'male', 'Charles Martinez', '+(002) 1212-121255', '201 Benson Park Drive', '06/01/2006', 'defaultimg1.jpg', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'u95VuxBroRZ2VrQN', NULL, NULL, 0),
(58, 'thomashart@mail.com', '2cc95327ac73089ebda5b7c12e8409bb2580314e26459732e3d3d2afa3a3388d', 'thomas', 'Student', 'male', 'Thomas Hartley', '+(003) 1256-969696', '25 Lodgeville Road', '04/01/2004', 'defaultimg2.jpg', 0, NULL, NULL, '2022-08-01 15:00:00', NULL, NULL, NULL, 'yI5EyHe3kgKOgIGG', NULL, NULL, 1),
(59, 'sammplum@mail.com', 'e7684dc18281f23dc32175f954c94f752c7e6781e9ff88aa6af0ab09d46cd211', 'samm', 'Student', 'male', 'Sam Plummer', '+(002) 1245-889657', '88 Clay Lick Road', '03/16/2007', 'defaultimg3.jpg', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'tQ3ATtUftbvPFv6Z', NULL, NULL, 0),
(60, 'amanda@mail.com', '933973292226d0b305740e0e380c53a1910589c46c4c474f29e25dfc2d978f5e', 'amanda', 'Student', 'female', 'Amanda', '+(002) 4545-896544', '44 Green Gate Lane', '12/02/2006', 'defaultimg4.jpg', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'Wzb4UR9svp5XG8pN', NULL, NULL, 0),
(61, 'gloriair@mail.com', 'b0f52ffa85c91c7efe2ce88cda49352602baed98b16706f098406f103acabd45', 'gloria', 'Student', 'female', 'Gloria Irons', '+(001) 1256-988874', '78 Heavner Avenue', '01/12/2006', 'defaultimg5.jpg', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'ELn3IJkoAMnl0IPb', NULL, NULL, 0),
(62, 'juanjrdn@mail.com', '49c67b0b2b0191e370db6962d9b63d57a914a5a0aacd4f33e77fbf6efecf4c48', 'juan', 'Student', 'male', 'Juan Jordan', '+(001) 1257-878799', '76 Tyler Avenue', '12/08/2005', 'defaultimg6.jpg', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'aEp5dRCJ52CNuf7m', NULL, NULL, 0),
(63, 'jlewis@mail.com', '15fd0f253cdbb0a6520ebc9861ae71b4e0a5dd6a0f40086436f3ab2a360b07af', 'lewis', 'Student', 'female', 'Jayne Lewis', '+(002) 1212-124545', '86 Oak Way', '08/18/2006', 'defaultimg7.jpg', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'lonXmNUQrfIDjtWB', NULL, NULL, 0),
(66, 'liamoore@mail.com', '7f80af246c83ad33e0e6a73c6c44b7919f0f3b8558290fee30f77083c09b34b3', 'liamoore', 'Student', 'male', 'Liam Moore', '+(010) 1010-101011', '15 Hewes Avenue', '09/01/1995', 'defaultimg8.jpg', 0, '2022-08-02 15:10:32', '2022-08-02 15:10:32', '2022-08-02 15:00:00', NULL, NULL, NULL, '2YenNvMnnlgBx5Oo', NULL, '::1', NULL),
(67, 'johnwilson@mail.com', 'c3f55258ce7edba64e6f78144fc8fb4faf10d30dfb1b8950c978ef2497e972e6', 'johnwilson', 'Teacher', 'male', 'John H. Wilson', '+(010) 2254-588888', '55 Argonne Street', '10/05/1989', 'defaultimg9.jpg', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'sZ0z6HXq6KIVUol8', NULL, NULL, 0),
(71, 'admin@mail.com', '5822e5fadbb0afc731207069f450cd7657e669ce15e4183cb7551913d94e1584', 'admin', 'Admin', 'male', 'Admin Astro', '+(010) 2211-698544', '78 Ashwood Drive', '08/24/1991', 'admin-icn.png', 0, '2022-08-03 10:43:11', '2022-08-03 10:49:00', '2022-08-03 10:00:00', NULL, NULL, NULL, '', NULL, '::1', NULL),
(72, 'naomi@mail.com', '3f2f0ab25f5bc1e685a3903716ddabb6a80bd5314a38b9a556dc7df69e1b4641', 'naomi', 'Student', 'female', 'Naomi Lott', '+(011) 1111-225475', '31 Hartway Street', '09/01/2005', 'defaultimg10.jpg', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'sVZSFnX3u1OORwNN', NULL, NULL, 0),
(73, 'williemin@mail.com', '78458b4e624663a63bf634c1d26e30556a6b99fbe7aee9a918ac9b77218a4e45', 'williem', 'Student', 'male', 'Willie Minnick', '+(001) 2121-254588', '58 Dogwood Lane', '08/30/2006', 'defaultimg11.jpg', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'ZdO9fQ2w5t2dDmJj', NULL, NULL, 0),
(74, 'mikek11@mail.com', '17a740b0575d084d47c41515c3fae122cf90bcd9786efa775fe213e9a54d54fb', 'mikek', 'Student', 'male', 'Mike Kirkman', '+(010) 2121-00000', '806 McDonald Avenue', '10/18/2007', 'defaultimg12.jpg', 0, NULL, NULL, NULL, NULL, NULL, NULL, '8VcVgj7Qg1Oj34fU', NULL, NULL, 0),
(75, 'murphyverse@mail.com', '42d164d2425afa0f24a708a111474590f738d57e6de83c4fe545eb2d1dd6c5dd', 'murphy', 'Teacher', 'male', 'Daniel E. Murphy', '+(010) 1010-256969', '76 Joss Street', '11/10/1988', 'defaultimg13.jpg', 0, NULL, NULL, NULL, NULL, NULL, NULL, '4XkOthCyAwnYpPIo', NULL, NULL, 0),
(76, 'rolandpker@mail.com', 'e407f6a5a2d4c14133b89c6786e42098780c10e2b8e17b4da36129c6774f302b', 'parker', 'Student', 'male', 'Roland Parker', '+(010) 2255-447796', '11 Ben Street', '06/28/2006', 'defaultimg14.jpg', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'mPhks5IkdgFQjGOn', NULL, NULL, 0),
(77, 'brendac55@mail.com', '59769892bc92f3ef646ecc8018f3ec86fe980216360a04d9caf92c2e2e27cc05', 'brendac', 'Student', 'female', 'Brenda Calhoun', '+(010) 1011-445878', '41 Southside Lane', '01/20/2006', 'defaultimg15.jpg', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'utjLkpTr9TQlAsEk', NULL, NULL, 0),
(78, 'royyjn@mail.com', '1765e1fb9dca92272cfba56dde49831b5b7eaabad567fa789389acb1796f967d', 'royy', 'Student', 'male', 'Roy Jones', '+(010) 1478-545896', '94 Post Farm Road', '12/31/2005', 'defaultimg16.jpg', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'ASBcNUSZgEBmYEl3', NULL, NULL, 0),
(79, 'walker77c@mail.com', '85cbc91c2a385121ea366b7e6ebda053a49873c42615eb8f62c8d1dc9b3c8870', 'walkerc', 'Student', 'male', 'Charles Walker', '+(010) 2255-458788', '79 North Street', '01/23/2006', 'defaultimg17.jpg', 0, NULL, NULL, NULL, NULL, NULL, NULL, '9DkNZyXNKJ74nn0R', NULL, NULL, 0),
(80, 'nellie.walker@mail.com', '0a3217229168bf3b2b87331d418d01b9dff131002b71da8bfe52fb7419272a8f', 'nellie', 'Student', 'female', 'Nellie Walker', '+(010) 2232-545855', '87 Grasselli Street', '03/16/2006', 'defaultimg18.jpg', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'UkPEqWJllfiT7mlN', NULL, NULL, 0),
(81, 'rebeccamld@mail.com', '8e552e89ed8e674f2c6e237459039d6561c7612866b20b73f3d6b7770a75018a', 'rebecca', 'Parent', 'female', 'Rebecca J. Mallard', '+(010) 2254-789654', '22 Green Gate Lane', '02/14/2022', 'defaultimg19.jpg', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'cq17V25pz92PpACQ', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sms_user_to_group`
--

CREATE TABLE `sms_user_to_group` (
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sms_user_to_group`
--

INSERT INTO `sms_user_to_group` (`user_id`, `group_id`) VALUES
(42, 4),
(44, 1),
(46, 4),
(49, 3),
(50, 2),
(51, 2),
(52, 2),
(53, 2),
(54, 2),
(55, 3),
(56, 3),
(57, 3),
(58, 3),
(59, 3),
(60, 3),
(61, 3),
(62, 3),
(63, 3),
(66, 3),
(67, 2),
(71, 1),
(72, 3),
(73, 3),
(74, 3),
(75, 2),
(76, 3),
(77, 3),
(78, 3),
(79, 3),
(80, 3),
(81, 4);

-- --------------------------------------------------------

--
-- Table structure for table `sms_user_variables`
--

CREATE TABLE `sms_user_variables` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `data_key` varchar(100) NOT NULL,
  `value` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `system_sessions`
--

CREATE TABLE `system_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_data` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_sessions`
--

INSERT INTO `system_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('1c0fdb8d088ef1231cfe9da39975afc2', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', 1659517897, 'a:13:{s:9:\"user_data\";s:0:\"\";s:2:\"id\";s:2:\"71\";s:4:\"name\";s:5:\"admin\";s:5:\"email\";s:14:\"admin@mail.com\";s:9:\"full_name\";s:11:\"Admin Astro\";s:7:\"contact\";s:18:\"+(010) 2211-698544\";s:7:\"address\";s:16:\"78 Ashwood Drive\";s:7:\"pro_pic\";s:13:\"admin-icn.png\";s:4:\"role\";s:5:\"Admin\";s:3:\"dob\";s:10:\"08/24/1991\";s:10:\"last_login\";s:19:\"2022-08-02 15:14:36\";s:18:\"running_session_id\";s:1:\"1\";s:8:\"loggedin\";b:1;}');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `running_session`
--
ALTER TABLE `running_session`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_account_fees`
--
ALTER TABLE `sms_account_fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_account_month`
--
ALTER TABLE `sms_account_month`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_account_monthly_payment`
--
ALTER TABLE `sms_account_monthly_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_account_type`
--
ALTER TABLE `sms_account_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_attendance`
--
ALTER TABLE `sms_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_class`
--
ALTER TABLE `sms_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_class_section`
--
ALTER TABLE `sms_class_section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_exam_marks`
--
ALTER TABLE `sms_exam_marks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_exam_routine`
--
ALTER TABLE `sms_exam_routine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_exam_type`
--
ALTER TABLE `sms_exam_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_groups`
--
ALTER TABLE `sms_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_group_to_group`
--
ALTER TABLE `sms_group_to_group`
  ADD PRIMARY KEY (`group_id`,`subgroup_id`);

--
-- Indexes for table `sms_library`
--
ALTER TABLE `sms_library`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_notice`
--
ALTER TABLE `sms_notice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_perms`
--
ALTER TABLE `sms_perms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_perm_to_group`
--
ALTER TABLE `sms_perm_to_group`
  ADD PRIMARY KEY (`perm_id`,`group_id`);

--
-- Indexes for table `sms_perm_to_user`
--
ALTER TABLE `sms_perm_to_user`
  ADD PRIMARY KEY (`perm_id`,`user_id`);

--
-- Indexes for table `sms_pms`
--
ALTER TABLE `sms_pms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `full_index` (`id`,`sender_id`,`receiver_id`,`date_read`);

--
-- Indexes for table `sms_student`
--
ALTER TABLE `sms_student`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `id` (`student_id`);

--
-- Indexes for table `sms_student_account`
--
ALTER TABLE `sms_student_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_studycomments`
--
ALTER TABLE `sms_studycomments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_studymaterial`
--
ALTER TABLE `sms_studymaterial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_subject`
--
ALTER TABLE `sms_subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_syllabus`
--
ALTER TABLE `sms_syllabus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_system_variables`
--
ALTER TABLE `sms_system_variables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_transport`
--
ALTER TABLE `sms_transport`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_users`
--
ALTER TABLE `sms_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_user_to_group`
--
ALTER TABLE `sms_user_to_group`
  ADD PRIMARY KEY (`user_id`,`group_id`);

--
-- Indexes for table `sms_user_variables`
--
ALTER TABLE `sms_user_variables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_index` (`user_id`);

--
-- Indexes for table `system_sessions`
--
ALTER TABLE `system_sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `last_activity_idx` (`last_activity`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `running_session`
--
ALTER TABLE `running_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sms_account_fees`
--
ALTER TABLE `sms_account_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `sms_account_month`
--
ALTER TABLE `sms_account_month`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `sms_account_monthly_payment`
--
ALTER TABLE `sms_account_monthly_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;
--
-- AUTO_INCREMENT for table `sms_account_type`
--
ALTER TABLE `sms_account_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `sms_attendance`
--
ALTER TABLE `sms_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `sms_class`
--
ALTER TABLE `sms_class`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `sms_class_section`
--
ALTER TABLE `sms_class_section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `sms_exam_marks`
--
ALTER TABLE `sms_exam_marks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;
--
-- AUTO_INCREMENT for table `sms_exam_routine`
--
ALTER TABLE `sms_exam_routine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sms_exam_type`
--
ALTER TABLE `sms_exam_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT for table `sms_groups`
--
ALTER TABLE `sms_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `sms_library`
--
ALTER TABLE `sms_library`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `sms_notice`
--
ALTER TABLE `sms_notice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sms_perms`
--
ALTER TABLE `sms_perms`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `sms_pms`
--
ALTER TABLE `sms_pms`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `sms_student_account`
--
ALTER TABLE `sms_student_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sms_studycomments`
--
ALTER TABLE `sms_studycomments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sms_studymaterial`
--
ALTER TABLE `sms_studymaterial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `sms_subject`
--
ALTER TABLE `sms_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
--
-- AUTO_INCREMENT for table `sms_syllabus`
--
ALTER TABLE `sms_syllabus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `sms_system_variables`
--
ALTER TABLE `sms_system_variables`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sms_transport`
--
ALTER TABLE `sms_transport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sms_users`
--
ALTER TABLE `sms_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
--
-- AUTO_INCREMENT for table `sms_user_variables`
--
ALTER TABLE `sms_user_variables`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
