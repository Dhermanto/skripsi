-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2018 at 04:19 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elearning`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `category_name` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `created_by`, `created_at`, `updated_by`, `deleted_at`, `deleted_by`, `category_name`, `content`, `updated_at`) VALUES
(6, 25, '2016-09-07 01:14:11', 25, NULL, NULL, 'GENERAL BANKING', '<p>Keterangan general banking</p>\r\n', '2018-08-06 12:42:30'),
(7, 25, '2016-09-07 01:14:23', 25, NULL, NULL, 'CREDIT & MARKETING', '<p>Keterangan credit &amp; marketing</p>\r\n', '2018-08-06 12:42:18'),
(8, 25, '2016-09-07 01:14:34', 25, NULL, NULL, 'BANK OPERATION', '<p>Keterangan bank operation</p>\r\n', '2018-08-06 12:42:04'),
(9, 25, '2016-09-07 01:14:48', 25, NULL, NULL, 'CORPORATE SOFTSKILL', '<p>Keterangan corporate softskill</p>', '2018-08-06 12:41:26'),
(23, 25, '2018-08-06 10:40:49', 25, NULL, NULL, 'Category Bimbingan', '<p>Keterangan category bimbingan</p>\r\n', '2018-08-06 12:41:02');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `course_wizlearn_id` varchar(100) DEFAULT NULL,
  `course_title` varchar(200) NOT NULL,
  `credit_point` int(11) DEFAULT NULL,
  `active_duration` int(11) NOT NULL DEFAULT '0',
  `course_prerequisit` text,
  `course_demo` varchar(50) DEFAULT NULL,
  `course_description` text NOT NULL,
  `course_image` varchar(50) NOT NULL DEFAULT 'no-image.png',
  `course_opened_date` date DEFAULT NULL,
  `course_closed_date` date DEFAULT NULL,
  `course_status` int(11) NOT NULL COMMENT '1: Aktif, 0: Tidak Aktif',
  `course_category` int(11) NOT NULL,
  `lms_sync` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`, `course_wizlearn_id`, `course_title`, `credit_point`, `active_duration`, `course_prerequisit`, `course_demo`, `course_description`, `course_image`, `course_opened_date`, `course_closed_date`, `course_status`, `course_category`, `lms_sync`) VALUES
(15, 0, 25, '2016-12-13 11:35:55', 25, NULL, NULL, '3173', 'INTRODUCTION TO BANKING', 10, 30, 'prerequisit', 'https://www.youtube.com/embed/jMBMRMAeXy0', 'desc', 'banking.jpg', NULL, NULL, 1, 6, '1'),
(16, 0, 25, '2017-01-15 20:40:50', 25, NULL, NULL, '2949', 'BANKING PRODUCT', 10, 30, '', 'https://www.youtube.com/embed/jMBMRMAeXy0', '', 'no-image.png', NULL, NULL, 1, 6, '1'),
(17, 0, 25, '2017-01-13 00:51:37', 25, NULL, NULL, '2947', 'BANKING OPERATION', 10, 30, '', 'https://www.youtube.com/embed/jMBMRMAeXy0', 'Banking operation description', 'no-image.png', NULL, NULL, 1, 6, '1'),
(18, 0, 25, '2017-01-15 20:42:55', 25, NULL, NULL, '2946', 'BANKING FINANCE', 10, 30, '', 'https://www.youtube.com/embed/jMBMRMAeXy0', 'Are You sure want to enroll this course? Once You enrolled this course, You cannot cancel it anymore.', 'no-image.png', NULL, NULL, 1, 6, '1'),
(20, 0, 25, '2016-12-10 13:33:32', 25, NULL, NULL, '2951', 'BASIC TREASURY', 10, 30, NULL, 'https://www.youtube.com/embed/jMBMRMAeXy0', '', 'no-image.png', NULL, NULL, 1, 6, '1'),
(21, 0, 25, '2016-12-13 11:35:37', 25, NULL, NULL, '3172', 'PREPARATION FOR CREDIT', 10, 30, NULL, 'https://www.youtube.com/embed/jMBMRMAeXy0', '', 'no-image.png', NULL, NULL, 1, 7, '1'),
(22, 0, 25, '2016-12-16 05:41:00', 25, NULL, NULL, '3408', 'LENDING RATIONALE', 10, 30, NULL, 'https://www.youtube.com/embed/jMBMRMAeXy0', '', 'no-image.png', NULL, NULL, 1, 7, '1'),
(23, 0, 25, '2016-12-16 05:34:00', 25, NULL, NULL, '3402', 'FINANCIAL STATEMENT ANALYSIS', 10, 30, NULL, 'https://www.youtube.com/embed/jMBMRMAeXy0', '', 'no-image.png', NULL, NULL, 1, 7, '1'),
(24, 0, 25, '2016-12-16 05:34:04', 25, NULL, NULL, '3403', 'FINANCIAL STATEMENT ANALYSIS - PERFORMA', 10, 30, NULL, 'https://www.youtube.com/embed/jMBMRMAeXy0', '', 'no-image.png', NULL, NULL, 1, 7, '1'),
(25, 0, 25, NULL, NULL, NULL, NULL, NULL, 'LOAN STRUCTURING', 10, 30, NULL, 'https://www.youtube.com/embed/jMBMRMAeXy0', '', 'no-image.png', NULL, NULL, 1, 7, '0'),
(26, 0, 25, NULL, NULL, NULL, NULL, NULL, 'LEGAL', 10, 30, NULL, 'https://www.youtube.com/embed/jMBMRMAeXy0', '', 'no-image.png', NULL, NULL, 1, 7, '0'),
(27, 0, 25, '2016-12-16 10:56:00', 25, NULL, NULL, '3415', 'INDUSTRY                          ', 10, 30, NULL, 'https://www.youtube.com/embed/jMBMRMAeXy0', '', 'no-image.png', NULL, NULL, 1, 7, '1'),
(28, 0, 25, NULL, NULL, NULL, NULL, NULL, 'INTRODUCTION TO BANKING INDUSTRY', 10, 30, NULL, 'https://www.youtube.com/embed/jMBMRMAeXy0', '', 'no-image.png', NULL, NULL, 1, 8, '0'),
(29, 0, 25, '2016-12-10 13:33:11', 25, NULL, NULL, '2950', 'BASIC OPERATION', 10, 30, NULL, 'https://www.youtube.com/embed/jMBMRMAeXy0', '', 'no-image.png', NULL, NULL, 1, 8, '1'),
(30, 0, 25, '2016-09-07 10:27:36', 25, NULL, NULL, NULL, 'RISK MANAGEMENT', 10, 30, NULL, 'https://www.youtube.com/embed/jMBMRMAeXy0', '', 'no-image.png', NULL, NULL, 1, 8, '0'),
(31, 0, 25, NULL, NULL, NULL, NULL, NULL, 'SALES AND MARKETING', 10, 30, NULL, 'https://www.youtube.com/embed/jMBMRMAeXy0', '', 'no-image.png', NULL, NULL, 1, 0, '0'),
(32, 0, 25, NULL, NULL, NULL, NULL, NULL, 'SERVICE QUALITY', 10, 30, NULL, 'https://www.youtube.com/embed/jMBMRMAeXy0', '', 'no-image.png', NULL, NULL, 1, 0, '0'),
(33, 0, 25, NULL, NULL, NULL, NULL, NULL, 'BUSINESS ETHICS AND ETIQUETTE', 10, 30, NULL, 'https://www.youtube.com/embed/jMBMRMAeXy0', '', 'no-image.png', NULL, NULL, 1, 0, '0'),
(34, 0, 25, NULL, NULL, NULL, NULL, NULL, 'TOTAL QUALITY MANAGEMENT', 10, 30, NULL, 'https://www.youtube.com/embed/jMBMRMAeXy0', '', 'no-image.png', NULL, NULL, 1, 9, '0'),
(35, 0, 25, NULL, NULL, NULL, NULL, NULL, 'SALES AND MARKETING', 10, 30, NULL, 'https://www.youtube.com/embed/jMBMRMAeXy0', '', 'no-image.png', NULL, NULL, 1, 9, '0'),
(36, 0, 25, '2016-09-07 10:34:03', 25, NULL, NULL, NULL, 'SERVICE QUALITY', 10, 30, NULL, 'https://www.youtube.com/embed/jMBMRMAeXy0', '', 'no-image.png', NULL, NULL, 1, 9, '0'),
(37, 0, 25, '2016-12-15 05:00:36', 25, NULL, NULL, '3321', 'BUSINESS ETHICS AND ETIQUETTE', 10, 30, NULL, 'https://www.youtube.com/embed/jMBMRMAeXy0', '', 'no-image.png', NULL, NULL, 1, 9, '1'),
(38, 0, 25, '2016-09-07 10:33:50', 25, NULL, NULL, NULL, 'PERSONAL AND TEAM DEVELOPMENT', 10, 30, NULL, 'https://www.youtube.com/embed/jMBMRMAeXy0', '', 'no-image.png', NULL, NULL, 1, 9, '0'),
(39, 0, 25, NULL, NULL, NULL, NULL, NULL, 'MANAGEMENT AND LEADERSHIP', 10, 30, NULL, 'https://www.youtube.com/embed/jMBMRMAeXy0', '', 'no-image.png', NULL, NULL, 1, 9, '0'),
(40, 0, 25, '2016-12-13 11:35:19', 25, NULL, NULL, '3171', 'BUSINESS MANAGEMENT', 10, 30, NULL, 'https://www.youtube.com/embed/jMBMRMAeXy0', '', 'no-image.png', NULL, NULL, 1, 9, '1'),
(41, 0, 25, NULL, NULL, NULL, NULL, NULL, 'OTHER ADVANCE TRAINING', 10, 30, NULL, 'https://www.youtube.com/embed/jMBMRMAeXy0', '', 'no-image.png', NULL, NULL, 1, 9, '0'),
(42, 0, 25, '2016-12-08 14:49:05', 25, '2018-03-06 18:56:49', 25, '0', 'TEST COURSE 1', 20, 30, NULL, 'https://www.youtube.com/embed/jMBMRMAeXy0', 'Course 1 description', 'no-image.png', NULL, NULL, 1, 8, '0'),
(43, 0, 25, '2016-12-08 14:50:34', 25, '2018-03-06 18:56:54', 25, '2795', 'TEST COURSE 2', 10, 30, NULL, 'https://www.youtube.com/embed/jMBMRMAeXy0', 'Course description 2', 'no-image.png', NULL, NULL, 1, 8, '0'),
(44, 0, 25, NULL, NULL, '2018-03-06 18:56:58', 25, NULL, 'TEST COURSE 3', 15, 30, NULL, 'https://www.youtube.com/embed/jMBMRMAeXy0', 'Course 3 desription', 'no-image.png', NULL, NULL, 1, 8, '0'),
(45, 0, 25, NULL, NULL, '2018-03-06 18:57:01', 25, NULL, 'TEST COURSE 4', 10, 30, NULL, 'https://www.youtube.com/embed/jMBMRMAeXy0', 'Course 4 description', 'no-image.png', NULL, NULL, 1, 8, '0'),
(46, 0, 25, NULL, NULL, '2018-03-06 18:57:04', 25, NULL, 'TEST COURSE 4', 10, 30, NULL, 'https://www.youtube.com/embed/jMBMRMAeXy0', 'Course 4 description', 'no-image.png', NULL, NULL, 1, 8, '0'),
(47, 0, 25, NULL, NULL, '2018-03-06 18:57:08', 25, NULL, 'TEST COURSE 4', 10, 30, NULL, 'https://www.youtube.com/embed/jMBMRMAeXy0', 'Course 4 description', 'no-image.png', NULL, NULL, 1, 8, '0'),
(48, 0, 25, NULL, NULL, '2018-03-06 18:57:11', 25, NULL, 'TEST COURSE 4', 10, 30, NULL, 'https://www.youtube.com/embed/jMBMRMAeXy0', 'Course 4 description', 'no-image.png', NULL, NULL, 1, 8, '0'),
(49, 0, 25, NULL, NULL, '2018-03-06 18:57:15', 25, NULL, 'TEST COURSE 4', 10, 30, NULL, 'https://www.youtube.com/embed/jMBMRMAeXy0', 'Course 4 description', 'no-image.png', NULL, NULL, 1, 8, '0'),
(50, 0, 25, NULL, NULL, '2018-03-06 18:56:45', 25, '2793', 'TEST COURSE 5', 25, 30, NULL, 'https://www.youtube.com/embed/jMBMRMAeXy0', 'Course 5 description', 'no-image.png', NULL, NULL, 1, 8, '0'),
(51, 0, 25, NULL, NULL, '2016-12-14 09:11:21', 25, NULL, 'CREATE', 10, 30, NULL, 'https://www.youtube.com/embed/jMBMRMAeXy0', 'ada', '81c96cedf675e2bb270e08db3087d510.png', NULL, NULL, 1, 8, '0'),
(52, 0, 25, '2016-12-20 08:36:09', 25, '2016-12-14 09:13:11', 25, NULL, 'ADA', 10, 30, NULL, 'https://www.youtube.com/embed/jMBMRMAeXy0', 'ada', 'no-image.png', NULL, NULL, 1, 8, '0'),
(53, 0, 25, '2016-12-15 05:00:46', 25, NULL, NULL, '3322', 'FINANCIAL INSTITUTIONS', 10, 30, NULL, 'https://www.youtube.com/embed/jMBMRMAeXy0', '', 'no-image.png', NULL, NULL, 1, 6, '1'),
(54, 0, 25, NULL, NULL, '2016-12-15 17:51:31', 25, NULL, 'KEUANGAN', 20, 30, NULL, 'https://www.youtube.com/embed/jMBMRMAeXy0', 'Ada', 'no-image.png', NULL, NULL, 1, 10, '0'),
(55, 0, 25, NULL, NULL, '2016-12-15 17:51:13', 25, NULL, 'ACCOUNTING', 30, 30, NULL, 'https://www.youtube.com/embed/jMBMRMAeXy0', 'ada', 'no-image.png', NULL, NULL, 1, 8, '1'),
(56, 0, 25, '2017-01-12 00:33:06', 25, NULL, NULL, '6278', 'WORKING INVESTMENT', 10, 30, '', 'https://www.youtube.com/embed/jMBMRMAeXy0', '', 'no-image.png', NULL, NULL, 1, 7, '1'),
(57, 0, 25, NULL, NULL, NULL, NULL, NULL, '', 0, 0, '0', 'https://www.youtube.com/embed/jMBMRMAeXy0', '0', 'no-image.png', NULL, NULL, 0, 0, '0'),
(58, 0, 25, NULL, NULL, '2017-01-12 00:31:21', 25, NULL, 'WORKING INVESTMENT', 10, 30, '', 'https://www.youtube.com/embed/jMBMRMAeXy0', '', 'no-image.png', NULL, NULL, 1, 7, '1'),
(59, 0, 25, '2018-04-08 16:16:02', 25, NULL, NULL, NULL, 'TESTING COURSE', 100, 30, '0', 'https://www.youtube.com/embed/jMBMRMAeXy0', '<p>Testing course adalah testing course</p>\r\n', '1250189849bbcc01c3799577bfec1163.png', NULL, NULL, 1, 14, '1'),
(60, 0, 25, NULL, NULL, NULL, NULL, NULL, 'JUDULKOLOKIUM', 100, 30, '0', 'https://www.youtube.com/embed/jMBMRMAeXy0', '<p>Kolokium</p>\r\n', '6c360d851c53e5c6927fcc4aee7be06e.png', NULL, NULL, 1, 15, '0'),
(61, 0, 25, NULL, NULL, '2018-04-14 07:15:16', 25, NULL, 'TESTING COURSE FOR ', 2000, 30, '0', 'https://www.youtube.com/embed/jMBMRMAeXy0', '<p>Testing</p>\r\n', '7a4b0e1fc809d03a651ce8c6b4d2d86c.png', NULL, NULL, 1, 8, '0'),
(62, 0, 25, '2018-04-14 07:15:47', 25, '2018-04-14 07:15:52', 25, NULL, 'TESTINGCOURSE', 3000, 30, '0', 'https://www.youtube.com/embed/jMBMRMAeXy0', '<p>testing</p>\r\n', '38b7180b3b1f62f93b55a9cc49a83361.png', NULL, NULL, 1, 8, '1'),
(63, 0, 25, NULL, NULL, '2018-08-06 12:43:38', 25, NULL, 'TESTINGCOURSE11', 10, 0, '0', 'https://www.youtube.com/embed/jMBMRMAeXy0', '<p>Testing</p>\r\n', 'no-image.png', NULL, NULL, 1, 8, '0'),
(64, 0, 25, '2018-08-06 15:12:05', 25, NULL, NULL, NULL, 'BIMBINGAN SKRIPSI', 10, 30, '0', 'https://www.youtube.com/embed/jMBMRMAeXy0', '<p>Deskripsi bimbingan skripsi</p>\r\n', 'c16c674df3894b12818eada1352d18ad.png', NULL, NULL, 1, 23, '1');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_slug` varchar(100) NOT NULL,
  `customer_logo` varchar(50) NOT NULL,
  `customer_address` text NOT NULL,
  `customer_phone` varchar(50) NOT NULL,
  `customer_fax` varchar(50) NOT NULL,
  `customer_email` varchar(200) NOT NULL,
  `customer_website` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`, `customer_name`, `customer_slug`, `customer_logo`, `customer_address`, `customer_phone`, `customer_fax`, `customer_email`, `customer_website`) VALUES
(83, '2016-12-09 19:00:39', 25, '2016-12-10 08:59:35', 25, NULL, NULL, 'BANK WINDU', 'BankWindu', 'bank_windu1.jpg', '', '', '', '', ''),
(84, '2016-09-07 01:18:56', 25, NULL, NULL, NULL, NULL, 'OCBC NISP', 'OcbcNisp', 'OBC.jpg', '', '', '', '', ''),
(85, '2016-09-07 01:19:25', 25, NULL, NULL, NULL, NULL, 'RABOBANK', 'Rabobank', 'rabobank.gif', '', '', '', '', ''),
(86, '2016-09-07 01:20:16', 25, NULL, NULL, NULL, NULL, 'BUANA FINANCE', 'BuanaFinance', 'bu_fin.gif', '', '', '', '', ''),
(87, '2016-09-07 01:20:41', 25, NULL, NULL, NULL, NULL, 'PT. TELKOM', 'Pt.Telkom', 'telkom.gif', '', '', '', '', ''),
(88, '2016-09-07 01:21:00', 25, NULL, NULL, NULL, NULL, 'BANK SYARIAH MANDIRI', 'BankSyariahMandiri', 'syariah.gif', '', '', '', '', ''),
(89, '2016-09-07 01:21:51', 25, NULL, NULL, NULL, NULL, 'PT. SCHENKER PETROLOG UTAMA ', 'Pt.SchenkerPetrologUtama', 'schenker.gif', '', '', '', '', ''),
(90, '2016-09-07 01:22:14', 25, NULL, NULL, NULL, NULL, 'PT. RELIANCE INSURANCE', 'Pt.RelianceInsurance', 'reliance.gif', '', '', '', '', ''),
(91, '2016-09-07 01:22:34', 25, NULL, NULL, NULL, NULL, 'BANK PERMATA', 'BankPermata', 'bank-permata.jpg', '', '', '', '', ''),
(92, '2016-09-07 01:23:00', 25, NULL, NULL, NULL, NULL, 'BANK PANIN', 'BankPanin', 'bankpanin.gif', '', '', '', '', ''),
(93, '2016-12-16 04:45:19', 25, '2016-12-16 05:45:19', 25, NULL, NULL, 'Bank Mestika', 'BankMestika', 'mestika-x.gif', 'x', '', '', '', ''),
(94, '2016-12-09 23:54:49', 25, NULL, NULL, NULL, NULL, 'PT.BANK MEGA ', 'Pt.BankMega', 'bankmega.gif', '', '', '', '', ''),
(95, '2016-12-09 18:42:18', 25, NULL, NULL, '2016-12-10 08:42:42', 25, 'Briq Software', 'BriqSoftware', 'Briq Software Color.png', 'Jl. Merpati No. 13', '021-22983887', '021-22983887', 'mail@briqsoftware.com', 'briqsoftware.com'),
(96, '2018-04-14 05:18:33', 25, '2016-12-10 09:02:07', 25, '2018-04-14 07:18:33', 25, 'PT. BERINGIN', 'Pt.Beringin', 'Briq_Software_Grayscale.png', 'Merpati 13', '021-22983887', '021-22983887', 'mail@briqsoftware.com', 'briqsoftware.com'),
(97, '2016-12-15 16:35:16', 25, NULL, NULL, '2016-12-15 17:35:16', 25, 'Bank indonesia', 'BankIndonesia', '', 'Jakarta', 'danang', 'danang', 'BI@gmail.com', 'BI@gmail.com'),
(98, '2016-12-15 16:52:11', 25, NULL, NULL, '2016-12-15 17:52:11', 25, 'Bank Indonesia', 'BankIndonesia', 'no-image.png', 'Jakarta', '0857', 'ada', 'gmail@com', 'gmail@com'),
(99, '2018-04-14 05:18:37', 25, NULL, NULL, '2018-04-14 07:18:37', 25, 'Testing Course', 'TestingCourse', 'Screenshot_(20).png', 'Bogor', '085925065195', '', 'testingcourse@gmail', 'testingcourse@gmail'),
(100, '2018-04-14 05:18:41', 25, NULL, NULL, '2018-04-14 07:18:41', 25, 'UIKA', 'Uika', 'if_group_2431357.png', 'Bogor', '085925065195', 'danang@gmail.com', 'danang@gmail.com', 'danang@gmail.com'),
(101, '2018-04-14 12:33:31', 25, '2018-04-14 14:31:16', 25, '2018-04-14 14:33:31', 25, 'TokoKelontong', 'Tokokelontong', 'if_group_2431357.png', 'Ada', '0859', '0', 'dante@gmail.com', ''),
(102, '2018-04-14 12:55:00', 25, NULL, NULL, '2018-04-14 14:55:00', 25, 'Testing', 'Testing', 'if_group_2431357.png', 'ada', 'ada', '0', 'ada@gmail.com', 'ada'),
(103, '2018-08-06 10:47:34', 25, '2018-08-06 12:47:34', 25, NULL, NULL, 'Customer bimbingan', 'CustomerBimbingan', 'APROGSI_MANTAP1.png', 'Jl. Jakarta bogor no 20', '08574177113', '0', 'bimbingan@gmail.com', 'bimbingan@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `customer_credits`
--

CREATE TABLE `customer_credits` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `trx_no` varchar(20) NOT NULL,
  `trx_date` date NOT NULL,
  `customer_id` int(11) NOT NULL,
  `credit_point` int(11) NOT NULL,
  `credit_exp_date` date NOT NULL,
  `remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_credits`
--

INSERT INTO `customer_credits` (`id`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`, `trx_no`, `trx_date`, `customer_id`, `credit_point`, `credit_exp_date`, `remarks`) VALUES
(1, '2018-08-06 10:48:04', 25, NULL, NULL, NULL, NULL, 'CR/2018/0001', '2018-08-06', 103, 1000, '2019-08-01', 'ada');

-- --------------------------------------------------------

--
-- Table structure for table `customer_journals`
--

CREATE TABLE `customer_journals` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `journal_date` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `credit_point` int(11) NOT NULL,
  `credit_exp_date` date NOT NULL,
  `remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_journals`
--

INSERT INTO `customer_journals` (`id`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`, `journal_date`, `customer_id`, `credit_point`, `credit_exp_date`, `remarks`) VALUES
(1, '2018-08-06 10:48:04', 25, NULL, NULL, NULL, NULL, 0, 103, 1000, '2019-08-01', 'ada'),
(2, '2018-08-06 11:05:32', 72, NULL, NULL, NULL, NULL, 0, 103, 0, '0000-00-00', ''),
(3, '2018-08-06 11:07:44', 72, NULL, NULL, NULL, NULL, 0, 103, -300, '0000-00-00', ''),
(4, '2018-08-06 11:14:22', 72, NULL, NULL, NULL, NULL, 0, 103, -100, '0000-00-00', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `user_name` varchar(200) NOT NULL,
  `user_wizlearn_id` varchar(50) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_group` enum('admin','customer','admin_bank') NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `position` int(11) DEFAULT NULL,
  `lms_sync` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`, `user_name`, `user_wizlearn_id`, `user_password`, `user_group`, `user_email`, `customer_id`, `position`, `lms_sync`) VALUES
(25, '2017-01-10 09:21:09', 19, '2017-01-10 03:21:09', 25, NULL, NULL, 'ADMIN', 'admin', '9E2D3248FC9551DB2B5DC453481CD9DD', 'admin', 'erham@iim.co.id', 0, NULL, '0'),
(40, '2016-12-09 23:02:41', 25, '2016-12-10 13:03:05', 25, NULL, NULL, 'ERHAM AFFANDY', 'erham', 'EDFB3F35488C50068962F812B7928FC3', 'admin', 'erham.affandy@gmail.com', 86, NULL, '0'),
(72, '2018-08-06 10:49:03', 25, NULL, NULL, NULL, NULL, 'ADMIN BANK BIMBINGAN', 'adminBimbingan', '9E2D3248FC9551DB2B5DC453481CD9DD', 'admin_bank', 'bimbinganuser@gmail.com', 103, NULL, '0'),
(73, '2018-08-06 10:57:24', 72, NULL, NULL, NULL, NULL, 'PESERTA BIMBINGAN', 'pesertaBimbingan', '9E2D3248FC9551DB2B5DC453481CD9DD', 'customer', 'admin@gmail.com', 103, 1, '0'),
(74, '2018-08-06 11:12:54', 72, NULL, NULL, NULL, NULL, 'PESERTA BIMBINGAN 2', 'pesertaBimbinganTwo', '9E2D3248FC9551DB2B5DC453481CD9DD', 'customer', 'admin@gmail.com', 103, 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `user_course`
--

CREATE TABLE `user_course` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `user_wizlearn_id` varchar(100) NOT NULL,
  `course_id` int(11) NOT NULL,
  `course_wizlearn_id` varchar(100) NOT NULL,
  `enrollment_status` int(11) NOT NULL COMMENT '0: bookmark, 1: enrolled',
  `bookmarked_time` datetime NOT NULL,
  `enrolled_time` datetime NOT NULL,
  `completion_date` datetime DEFAULT NULL,
  `exam` text,
  `answer_exam` text,
  `score` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_course`
--

INSERT INTO `user_course` (`id`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`, `user_id`, `user_wizlearn_id`, `course_id`, `course_wizlearn_id`, `enrollment_status`, `bookmarked_time`, `enrolled_time`, `completion_date`, `exam`, `answer_exam`, `score`) VALUES
(1, '2018-08-06 14:14:17', 73, '2018-08-06 16:14:17', 103, NULL, NULL, 73, 'pesertaBimbingan', 64, '', 1, '2018-08-06 13:09:43', '2018-08-06 13:09:51', '2018-08-06 14:53:24', NULL, '491dcefc9a4a9dd5a69c589e96ac1f8f.docx', NULL),
(5, '2018-08-06 11:49:38', 74, '2018-08-06 13:49:38', 103, NULL, NULL, 74, 'pesertaBimbinganTwo', 64, '', 1, '2018-08-06 13:38:22', '2018-08-06 13:48:36', '2018-08-06 13:49:38', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_journals`
--

CREATE TABLE `user_journals` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `journal_date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `credit_point` int(11) NOT NULL,
  `credit_exp_date` datetime NOT NULL,
  `remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_journals`
--

INSERT INTO `user_journals` (`id`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`, `journal_date`, `user_id`, `credit_point`, `credit_exp_date`, `remarks`) VALUES
(1, '2018-08-06 11:05:32', 72, NULL, NULL, NULL, NULL, '0000-00-00', 73, 0, '0000-00-00 00:00:00', ''),
(2, '2018-08-06 11:07:44', 72, NULL, NULL, NULL, NULL, '0000-00-00', 73, 300, '0000-00-00 00:00:00', ''),
(3, '2018-08-06 11:09:43', 73, NULL, NULL, NULL, NULL, '0000-00-00', 73, -10, '0000-00-00 00:00:00', ''),
(4, '2018-08-06 11:13:36', 74, NULL, NULL, NULL, NULL, '0000-00-00', 74, -10, '0000-00-00 00:00:00', ''),
(5, '2018-08-06 11:13:42', 74, NULL, NULL, NULL, NULL, '0000-00-00', 74, 10, '0000-00-00 00:00:00', ''),
(6, '2018-08-06 11:36:15', 72, NULL, NULL, NULL, NULL, '0000-00-00', 74, 100, '0000-00-00 00:00:00', ''),
(7, '2018-08-06 11:14:38', 74, NULL, NULL, NULL, NULL, '0000-00-00', 74, -10, '0000-00-00 00:00:00', ''),
(8, '2018-08-06 11:14:47', 74, NULL, NULL, NULL, NULL, '0000-00-00', 74, 10, '0000-00-00 00:00:00', ''),
(9, '2018-08-06 11:38:07', 74, NULL, NULL, NULL, NULL, '0000-00-00', 74, -10, '0000-00-00 00:00:00', ''),
(10, '2018-08-06 11:38:18', 74, NULL, NULL, NULL, NULL, '0000-00-00', 74, 10, '0000-00-00 00:00:00', ''),
(11, '2018-08-06 11:38:22', 74, NULL, NULL, NULL, NULL, '0000-00-00', 74, -10, '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_position`
--

CREATE TABLE `user_position` (
  `id` int(11) NOT NULL,
  `position_name` varchar(255) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_position`
--

INSERT INTO `user_position` (`id`, `position_name`, `customer_id`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 'penguji', 103, NULL, 72, '2018-08-06 12:56:33', 103, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_position_detail`
--

CREATE TABLE `user_position_detail` (
  `id` int(11) NOT NULL,
  `user_position_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `exam` text NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_position_detail`
--

INSERT INTO `user_position_detail` (`id`, `user_position_id`, `course_id`, `exam`, `deleted_by`, `deleted_at`, `updated_by`, `updated_at`, `created_by`, `created_at`) VALUES
(1, 1, 64, '2d3d7ca04bf3691ce8f6933e46c73d6f.txt', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 72, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_report`
--

CREATE TABLE `user_report` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `course_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `default_class` varchar(50) NOT NULL,
  `count` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `completion_date` int(11) NOT NULL,
  `completion_status` int(11) NOT NULL,
  `scorm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_credits`
--
ALTER TABLE `customer_credits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `customer_journals`
--
ALTER TABLE `customer_journals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `user_course`
--
ALTER TABLE `user_course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_journals`
--
ALTER TABLE `user_journals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_position`
--
ALTER TABLE `user_position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_position_detail`
--
ALTER TABLE `user_position_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_report`
--
ALTER TABLE `user_report`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `customer_credits`
--
ALTER TABLE `customer_credits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer_journals`
--
ALTER TABLE `customer_journals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `user_course`
--
ALTER TABLE `user_course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_journals`
--
ALTER TABLE `user_journals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_position`
--
ALTER TABLE `user_position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_position_detail`
--
ALTER TABLE `user_position_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_report`
--
ALTER TABLE `user_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
