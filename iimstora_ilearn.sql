-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jan 16, 2017 at 11:49 AM
-- Server version: 10.1.20-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `iimstora_ilearn`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `category_name` varchar(100) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `created_by`, `created_at`, `updated_by`, `deleted_at`, `deleted_by`, `category_name`, `updated_at`) VALUES
(6, 25, '2016-09-07 01:14:11', 0, NULL, NULL, 'GENERAL BANKING', NULL),
(7, 25, '2016-09-07 01:14:23', 0, NULL, NULL, 'CREDIT & MARKETING', NULL),
(8, 25, '2016-09-07 01:14:34', 0, NULL, NULL, 'BANK OPERATION', NULL),
(9, 25, '2016-09-07 01:14:48', 0, NULL, NULL, 'CORPORATE SOFTSKILL', NULL),
(10, 25, '2016-12-15 14:45:41', NULL, '2016-12-15 17:35:51', 25, 'Accounting', NULL),
(11, 25, '2017-01-09 04:41:06', NULL, '2017-01-08 22:41:14', 25, 'test', NULL),
(12, 25, '2017-01-09 06:16:31', NULL, '2017-01-09 00:16:35', 25, 'test', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `course_wizlearn_id` varchar(100) DEFAULT NULL,
  `course_title` varchar(200) NOT NULL,
  `credit_point` int(11) NOT NULL,
  `active_duration` int(11) NOT NULL DEFAULT '0',
  `course_prerequisit` text,
  `course_demo` varchar(50) DEFAULT NULL,
  `course_description` text NOT NULL,
  `course_image` varchar(50) NOT NULL DEFAULT 'no-image.png',
  `course_opened_date` date DEFAULT NULL,
  `course_closed_date` date DEFAULT NULL,
  `course_status` int(11) NOT NULL COMMENT '1: Aktif, 0: Tidak Aktif',
  `course_category` int(11) NOT NULL,
  `lms_sync` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=59 ;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`, `course_wizlearn_id`, `course_title`, `credit_point`, `active_duration`, `course_prerequisit`, `course_demo`, `course_description`, `course_image`, `course_opened_date`, `course_closed_date`, `course_status`, `course_category`, `lms_sync`) VALUES
(15, 0, 25, '2016-12-13 11:35:55', 25, NULL, NULL, '3173', 'INTRODUCTION TO BANKING', 10, 30, 'prerequisit', 'https://www.youtube.com/embed/wBBt-Z_PzYg', 'desc', 'banking.jpg', NULL, NULL, 1, 6, '1'),
(16, 0, 25, '2017-01-15 20:40:50', 25, NULL, NULL, '2949', 'BANKING PRODUCT', 10, 30, '', '', '', 'no-image.png', NULL, NULL, 1, 6, '1'),
(17, 0, 25, '2017-01-13 00:51:37', 25, NULL, NULL, '2947', 'BANKING OPERATION', 10, 30, '', 'https://www.youtube.com/watch?v=RhU9MZ98jxo', 'Banking operation description', 'no-image.png', NULL, NULL, 1, 6, '1'),
(18, 0, 25, '2017-01-15 20:42:55', 25, NULL, NULL, '2946', 'BANKING FINANCE', 10, 30, '', 'https://www.youtube.com/embed/ClCAj_xRezA', 'Are You sure want to enroll this course? Once You enrolled this course, You cannot cancel it anymore.', 'no-image.png', NULL, NULL, 1, 6, '1'),
(20, 0, 25, '2016-12-10 13:33:32', 25, NULL, NULL, '2951', 'BASIC TREASURY', 10, 30, NULL, NULL, '', 'no-image.png', NULL, NULL, 1, 6, '1'),
(21, 0, 25, '2016-12-13 11:35:37', 25, NULL, NULL, '3172', 'PREPARATION FOR CREDIT', 10, 30, NULL, NULL, '', 'no-image.png', NULL, NULL, 1, 7, '1'),
(22, 0, 25, '2016-12-16 05:41:00', 25, NULL, NULL, '3408', 'LENDING RATIONALE', 10, 30, NULL, NULL, '', 'no-image.png', NULL, NULL, 1, 7, '1'),
(23, 0, 25, '2016-12-16 05:34:00', 25, NULL, NULL, '3402', 'FINANCIAL STATEMENT ANALYSIS', 10, 30, NULL, NULL, '', 'no-image.png', NULL, NULL, 1, 7, '1'),
(24, 0, 25, '2016-12-16 05:34:04', 25, NULL, NULL, '3403', 'FINANCIAL STATEMENT ANALYSIS - PERFORMA', 10, 30, NULL, NULL, '', 'no-image.png', NULL, NULL, 1, 7, '1'),
(25, 0, 25, NULL, NULL, NULL, NULL, NULL, 'LOAN STRUCTURING', 10, 30, NULL, NULL, '', 'no-image.png', NULL, NULL, 1, 7, '0'),
(26, 0, 25, NULL, NULL, NULL, NULL, NULL, 'LEGAL', 10, 30, NULL, NULL, '', 'no-image.png', NULL, NULL, 1, 7, '0'),
(27, 0, 25, '2016-12-16 10:56:00', 25, NULL, NULL, '3415', 'INDUSTRY                          ', 10, 30, NULL, NULL, '', 'no-image.png', NULL, NULL, 1, 7, '1'),
(28, 0, 25, NULL, NULL, NULL, NULL, NULL, 'INTRODUCTION TO BANKING INDUSTRY', 10, 30, NULL, NULL, '', 'no-image.png', NULL, NULL, 1, 8, '0'),
(29, 0, 25, '2016-12-10 13:33:11', 25, NULL, NULL, '2950', 'BASIC OPERATION', 10, 30, NULL, NULL, '', 'no-image.png', NULL, NULL, 1, 8, '1'),
(30, 0, 25, '2016-09-07 10:27:36', 25, NULL, NULL, NULL, 'RISK MANAGEMENT', 10, 30, NULL, NULL, '', 'no-image.png', NULL, NULL, 1, 8, '0'),
(31, 0, 25, NULL, NULL, NULL, NULL, NULL, 'SALES AND MARKETING', 10, 30, NULL, NULL, '', 'no-image.png', NULL, NULL, 1, 0, '0'),
(32, 0, 25, NULL, NULL, NULL, NULL, NULL, 'SERVICE QUALITY', 10, 30, NULL, NULL, '', 'no-image.png', NULL, NULL, 1, 0, '0'),
(33, 0, 25, NULL, NULL, NULL, NULL, NULL, 'BUSINESS ETHICS AND ETIQUETTE', 10, 30, NULL, NULL, '', 'no-image.png', NULL, NULL, 1, 0, '0'),
(34, 0, 25, NULL, NULL, NULL, NULL, NULL, 'TOTAL QUALITY MANAGEMENT', 10, 30, NULL, NULL, '', 'no-image.png', NULL, NULL, 1, 9, '0'),
(35, 0, 25, NULL, NULL, NULL, NULL, NULL, 'SALES AND MARKETING', 10, 30, NULL, NULL, '', 'no-image.png', NULL, NULL, 1, 9, '0'),
(36, 0, 25, '2016-09-07 10:34:03', 25, NULL, NULL, NULL, 'SERVICE QUALITY', 10, 30, NULL, NULL, '', 'no-image.png', NULL, NULL, 1, 9, '0'),
(37, 0, 25, '2016-12-15 05:00:36', 25, NULL, NULL, '3321', 'BUSINESS ETHICS AND ETIQUETTE', 10, 30, NULL, NULL, '', 'no-image.png', NULL, NULL, 1, 9, '1'),
(38, 0, 25, '2016-09-07 10:33:50', 25, NULL, NULL, NULL, 'PERSONAL AND TEAM DEVELOPMENT', 10, 30, NULL, NULL, '', 'no-image.png', NULL, NULL, 1, 9, '0'),
(39, 0, 25, NULL, NULL, NULL, NULL, NULL, 'MANAGEMENT AND LEADERSHIP', 10, 30, NULL, NULL, '', 'no-image.png', NULL, NULL, 1, 9, '0'),
(40, 0, 25, '2016-12-13 11:35:19', 25, NULL, NULL, '3171', 'BUSINESS MANAGEMENT', 10, 30, NULL, NULL, '', 'no-image.png', NULL, NULL, 1, 9, '1'),
(41, 0, 25, NULL, NULL, NULL, NULL, NULL, 'OTHER ADVANCE TRAINING', 10, 30, NULL, NULL, '', 'no-image.png', NULL, NULL, 1, 9, '0'),
(42, 0, 25, '2016-12-08 14:49:05', 25, NULL, NULL, '0', 'TEST COURSE 1', 20, 30, NULL, NULL, 'Course 1 description', 'no-image.png', NULL, NULL, 1, 8, '0'),
(43, 0, 25, '2016-12-08 14:50:34', 25, NULL, NULL, '2795', 'TEST COURSE 2', 10, 30, NULL, NULL, 'Course description 2', 'no-image.png', NULL, NULL, 1, 8, '0'),
(44, 0, 25, NULL, NULL, NULL, NULL, NULL, 'TEST COURSE 3', 15, 30, NULL, NULL, 'Course 3 desription', 'no-image.png', NULL, NULL, 1, 8, '0'),
(45, 0, 25, NULL, NULL, NULL, NULL, NULL, 'TEST COURSE 4', 10, 30, NULL, NULL, 'Course 4 description', 'no-image.png', NULL, NULL, 1, 8, '0'),
(46, 0, 25, NULL, NULL, NULL, NULL, NULL, 'TEST COURSE 4', 10, 30, NULL, NULL, 'Course 4 description', 'no-image.png', NULL, NULL, 1, 8, '0'),
(47, 0, 25, NULL, NULL, NULL, NULL, NULL, 'TEST COURSE 4', 10, 30, NULL, NULL, 'Course 4 description', 'no-image.png', NULL, NULL, 1, 8, '0'),
(48, 0, 25, NULL, NULL, NULL, NULL, NULL, 'TEST COURSE 4', 10, 30, NULL, NULL, 'Course 4 description', 'no-image.png', NULL, NULL, 1, 8, '0'),
(49, 0, 25, NULL, NULL, NULL, NULL, NULL, 'TEST COURSE 4', 10, 30, NULL, NULL, 'Course 4 description', 'no-image.png', NULL, NULL, 1, 8, '0'),
(50, 0, 25, NULL, NULL, NULL, NULL, '2793', 'TEST COURSE 5', 25, 30, NULL, NULL, 'Course 5 description', 'no-image.png', NULL, NULL, 1, 8, '0'),
(51, 0, 25, NULL, NULL, '2016-12-14 09:11:21', 25, NULL, 'CREATE', 10, 30, NULL, NULL, 'ada', '81c96cedf675e2bb270e08db3087d510.png', NULL, NULL, 1, 8, '0'),
(52, 0, 25, '2016-12-20 08:36:09', 25, '2016-12-14 09:13:11', 25, NULL, 'ADA', 10, 30, NULL, NULL, 'ada', 'no-image.png', NULL, NULL, 1, 8, '0'),
(53, 0, 25, '2016-12-15 05:00:46', 25, NULL, NULL, '3322', 'FINANCIAL INSTITUTIONS', 10, 30, NULL, NULL, '', 'no-image.png', NULL, NULL, 1, 6, '1'),
(54, 0, 25, NULL, NULL, '2016-12-15 17:51:31', 25, NULL, 'KEUANGAN', 20, 30, NULL, NULL, 'Ada', 'no-image.png', NULL, NULL, 1, 10, '0'),
(55, 0, 25, NULL, NULL, '2016-12-15 17:51:13', 25, NULL, 'ACCOUNTING', 30, 30, NULL, NULL, 'ada', 'no-image.png', NULL, NULL, 1, 8, '1'),
(56, 0, 25, '2017-01-12 00:33:06', 25, NULL, NULL, '6278', 'WORKING INVESTMENT', 10, 30, '', '', '', 'no-image.png', NULL, NULL, 1, 7, '1'),
(57, 0, 25, NULL, NULL, NULL, NULL, NULL, '', 0, 0, '0', '0', '0', 'no-image.png', NULL, NULL, 0, 0, '0'),
(58, 0, 25, NULL, NULL, '2017-01-12 00:31:21', 25, NULL, 'WORKING INVESTMENT', 10, 30, '', '', '', 'no-image.png', NULL, NULL, 1, 7, '1');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `customer_website` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=99 ;

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
(96, '2016-12-09 19:01:43', 25, '2016-12-10 09:02:07', 25, NULL, NULL, 'PT. BERINGIN', 'Pt.Beringin', 'Briq_Software_Grayscale.png', 'Merpati 13', '021-22983887', '021-22983887', 'mail@briqsoftware.com', 'briqsoftware.com'),
(97, '2016-12-15 16:35:16', 25, NULL, NULL, '2016-12-15 17:35:16', 25, 'Bank indonesia', 'BankIndonesia', '', 'Jakarta', 'danang', 'danang', 'BI@gmail.com', 'BI@gmail.com'),
(98, '2016-12-15 16:52:11', 25, NULL, NULL, '2016-12-15 17:52:11', 25, 'Bank Indonesia', 'BankIndonesia', 'no-image.png', 'Jakarta', '0857', 'ada', 'gmail@com', 'gmail@com');

-- --------------------------------------------------------

--
-- Table structure for table `customer_credits`
--

CREATE TABLE IF NOT EXISTS `customer_credits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `remarks` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

--
-- Dumping data for table `customer_credits`
--

INSERT INTO `customer_credits` (`id`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`, `trx_no`, `trx_date`, `customer_id`, `credit_point`, `credit_exp_date`, `remarks`) VALUES
(43, '2016-09-07 03:30:58', 25, NULL, NULL, NULL, NULL, 'CR/2016/0001', '2016-09-07', 92, 100, '2017-09-07', 'ADA'),
(44, '2016-09-07 20:25:26', 25, NULL, NULL, NULL, NULL, 'CR/2016/0002', '2016-09-08', 86, 10, '2017-09-08', 'ada'),
(45, '2016-09-07 23:37:43', 25, NULL, NULL, NULL, NULL, 'CR/2016/0003', '2016-09-08', 86, 200, '2017-09-08', ''),
(46, '2016-09-08 00:21:06', 25, NULL, NULL, NULL, NULL, 'CR/2016/0004', '2016-09-08', 92, 100, '2017-09-08', 'ada'),
(47, '2016-09-08 00:34:10', 25, NULL, NULL, NULL, NULL, 'CR/2016/0005', '2016-09-08', 91, 100, '2017-09-08', 'ada'),
(48, '2016-09-08 01:29:58', 25, NULL, NULL, NULL, NULL, 'CR/2016/0006', '2016-09-08', 92, 10, '2017-09-08', 'ada'),
(49, '2016-12-09 23:50:30', 25, NULL, NULL, NULL, NULL, 'CR/2016/0007', '2016-12-10', 93, 1000, '2017-12-17', ''),
(50, '2016-12-14 07:21:18', 25, NULL, NULL, NULL, NULL, 'CR/2016/0008', '2016-12-14', 88, 150, '2017-02-12', 'Beli lagi'),
(51, '2016-12-14 07:21:59', 25, NULL, NULL, NULL, NULL, 'CR/2016/0009', '2016-12-14', 88, 50, '2017-02-12', ''),
(52, '2016-12-15 16:38:11', 25, NULL, NULL, '2016-12-15 17:38:11', 25, 'CR/2016/0010', '2016-12-15', 97, 3000, '2017-02-13', 'ada'),
(53, '2016-12-16 04:46:10', 25, NULL, NULL, NULL, NULL, 'CR/2016/0011', '2016-12-16', 93, 300, '2017-02-14', ''),
(54, '2016-12-16 08:24:15', 25, NULL, NULL, '2016-12-16 09:24:15', 25, 'CR/2016/0012', '2016-12-16', 93, 100, '2017-02-14', ''),
(55, '2016-12-16 08:26:11', 25, NULL, NULL, NULL, NULL, 'CR/2016/0013', '2016-12-16', 86, 200, '2017-02-14', '');

-- --------------------------------------------------------

--
-- Table structure for table `customer_journals`
--

CREATE TABLE IF NOT EXISTS `customer_journals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `remarks` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=104 ;

--
-- Dumping data for table `customer_journals`
--

INSERT INTO `customer_journals` (`id`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`, `journal_date`, `customer_id`, `credit_point`, `credit_exp_date`, `remarks`) VALUES
(83, '2016-09-07 03:30:58', 25, NULL, NULL, NULL, NULL, 0, 92, 100, '2017-09-07', 'ADA'),
(84, '2016-09-07 03:32:30', 25, NULL, NULL, NULL, NULL, 0, 92, -100, '0000-00-00', ''),
(85, '2016-09-07 20:25:26', 25, NULL, NULL, NULL, NULL, 0, 86, 10, '2017-09-08', 'ada'),
(86, '2016-09-07 23:37:43', 25, NULL, NULL, NULL, NULL, 0, 86, 200, '2017-09-08', ''),
(87, '2016-09-07 23:39:33', 25, NULL, NULL, NULL, NULL, 0, 86, -210, '0000-00-00', ''),
(88, '2016-09-08 00:21:06', 25, NULL, NULL, NULL, NULL, 0, 92, 100, '2017-09-08', 'ada'),
(89, '2016-09-08 00:34:10', 25, NULL, NULL, NULL, NULL, 0, 91, 100, '2017-09-08', 'ada'),
(90, '2016-09-08 01:29:58', 25, NULL, NULL, NULL, NULL, 0, 92, 10, '2017-09-08', 'ada'),
(91, '2016-12-09 23:50:30', 25, NULL, NULL, NULL, NULL, 0, 93, 1000, '2017-12-17', ''),
(92, '2016-12-14 06:47:11', 25, NULL, NULL, NULL, NULL, 0, 93, -1000, '0000-00-00', ''),
(93, '2016-12-14 07:21:18', 25, NULL, NULL, NULL, NULL, 0, 88, 150, '2017-02-12', 'Beli lagi'),
(94, '2016-12-14 07:21:42', 25, NULL, NULL, NULL, NULL, 0, 88, -150, '0000-00-00', ''),
(95, '2016-12-14 07:21:59', 25, NULL, NULL, NULL, NULL, 0, 88, 50, '2017-02-12', ''),
(96, '2016-12-14 07:22:58', 25, NULL, NULL, NULL, NULL, 0, 88, -50, '0000-00-00', ''),
(97, '2016-12-15 14:50:59', 25, NULL, NULL, NULL, NULL, 0, 97, 3000, '2017-02-13', 'ada'),
(98, '2016-12-15 14:51:17', 25, NULL, NULL, NULL, NULL, 0, 97, -3000, '0000-00-00', ''),
(99, '2016-12-16 04:46:10', 25, NULL, NULL, NULL, NULL, 0, 93, 300, '2017-02-14', ''),
(100, '2016-12-16 04:46:23', 25, NULL, NULL, NULL, NULL, 0, 93, -300, '0000-00-00', ''),
(101, '2016-12-16 07:00:31', 25, NULL, NULL, NULL, NULL, 0, 93, 100, '2017-02-14', ''),
(102, '2016-12-16 07:00:45', 25, NULL, NULL, NULL, NULL, 0, 93, -100, '0000-00-00', ''),
(103, '2016-12-16 08:26:11', 25, NULL, NULL, NULL, NULL, 0, 86, 200, '2017-02-14', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `lms_sync` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`, `user_name`, `user_wizlearn_id`, `user_password`, `user_group`, `user_email`, `customer_id`, `lms_sync`) VALUES
(25, '2017-01-10 09:21:09', 19, '2017-01-10 03:21:09', 25, NULL, NULL, 'ADMIN', 'admin', '9E2D3248FC9551DB2B5DC453481CD9DD', 'admin', 'erham@iim.co.id', 0, '0'),
(40, '2016-12-09 23:02:41', 25, '2016-12-10 13:03:05', 25, NULL, NULL, 'ERHAM AFFANDY', 'erham', 'EDFB3F35488C50068962F812B7928FC3', 'admin', 'erham.affandy@gmail.com', 86, '0'),
(41, '2016-12-09 23:02:48', 25, NULL, NULL, '2016-12-10 13:03:12', 25, 'ALAM', 'alam', '5B160A497A9815CC2833E9F9FF696DA0', 'customer', 'alam@com', 92, '0'),
(42, '2016-12-12 21:12:25', 25, '2016-12-13 11:03:16', NULL, NULL, NULL, 'GABRIEL BATISTUTA', 'batistuta', '027F1513059C68546818C70EA64C3FBF', 'customer', 'gabriel.batistuta@briq.com', 93, '1'),
(43, '2016-12-09 23:40:50', 25, '2016-12-10 13:41:14', 25, NULL, NULL, 'DIEGO SIMEONE', 'simeone', '3E92A0D2A7550A0E593307FE9270C711', 'customer', 'diego.simeone@briq.com', 93, '1'),
(44, '2016-12-09 23:11:31', 25, '2016-12-10 13:43:18', 25, NULL, NULL, 'ROBERTO AYALA', 'ayala', 'C7EF654E7CC8026A9A7D8DADA39B4398', 'customer', 'roberto.ayala@briq.com', 93, '1'),
(45, '2016-12-09 23:12:45', 25, NULL, NULL, NULL, NULL, 'HERNAN CRESPO', 'crespo', 'D4A312AE165211D1CC328778E2ED862B', 'customer', 'hernan.crespo@briq.com', 93, '1'),
(46, '2016-12-16 07:59:59', 25, NULL, NULL, '2016-12-16 08:59:59', 25, 'LEE BOWYER', 'bowyer', '9CB75AB7DE344E46FD6B44A788146189', 'customer', 'bowyer@gmail.com', 88, '1'),
(47, '2016-12-15 02:55:01', 25, '2016-12-15 03:55:01', 25, NULL, NULL, 'HEUNG MING SON', 'son', '4AD651948BC170877BDD6F5DA4996B4F', 'customer', 'son@gmail.com', 88, '1'),
(48, '2017-01-13 06:46:16', 25, '2017-01-13 00:46:16', 25, NULL, NULL, 'MAURICIO POCHETTINO', 'pochettino', 'F5B5485DA3A5190A0D3FD3787009B290', 'customer', 'pochettino@gmail.com', 88, '1'),
(49, '2016-12-15 16:34:58', 25, NULL, NULL, '2016-12-15 17:34:58', 25, 'DANANG', 'danang', '86310E16FE3C790024D5BD8BAFF58820', 'customer', 'danang@gmail.com', 97, '0'),
(50, '2016-12-15 16:51:44', 25, NULL, NULL, '2016-12-15 17:51:44', 25, 'DANTE', 'dante', '04AC9F44061EC85BFE60F01678CF8A2E', 'customer', 'dante@gmail.com', 98, '1'),
(55, '2016-12-29 06:08:33', 25, '2016-12-29 07:08:33', 25, NULL, NULL, 'DANTE VINCENT', 'Dante vincent', '9E2D3248FC9551DB2B5DC453481CD9DD', 'admin_bank', 'Dante_vincent@gmail.com', 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `user_course`
--

CREATE TABLE IF NOT EXISTS `user_course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `updated_score_time` datetime DEFAULT NULL,
  `completion_date` datetime DEFAULT NULL,
  `scorm_score` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=99 ;

--
-- Dumping data for table `user_course`
--

INSERT INTO `user_course` (`id`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`, `user_id`, `user_wizlearn_id`, `course_id`, `course_wizlearn_id`, `enrollment_status`, `bookmarked_time`, `enrolled_time`, `updated_score_time`, `completion_date`, `scorm_score`) VALUES
(1, '2016-12-12 22:00:06', 42, NULL, NULL, NULL, NULL, 42, 'batistuta', 17, '2947', 1, '2016-12-13 11:59:13', '2016-12-13 12:00:30', NULL, NULL, NULL),
(2, '2016-12-14 08:32:09', 42, NULL, NULL, NULL, NULL, 42, 'batistuta', 15, '3173', 1, '2016-12-13 11:59:19', '2016-12-14 09:32:09', NULL, NULL, NULL),
(3, '2016-12-12 22:02:58', 42, NULL, NULL, NULL, NULL, 42, 'batistuta', 40, '3171', 1, '2016-12-13 11:59:28', '2016-12-13 12:03:22', NULL, NULL, NULL),
(4, '2016-12-14 07:27:40', 47, NULL, NULL, NULL, NULL, 47, 'son', 16, '2949', 1, '2016-12-14 08:24:50', '2016-12-14 08:27:40', NULL, NULL, NULL),
(5, '2016-12-15 02:59:21', 47, NULL, NULL, NULL, NULL, 47, 'son', 17, '2947', 1, '2016-12-14 08:24:53', '2016-12-15 03:59:21', NULL, NULL, NULL),
(6, '2016-12-15 03:58:56', 47, NULL, NULL, NULL, NULL, 47, 'son', 15, '3173', 1, '2016-12-14 08:24:57', '2016-12-15 04:58:56', NULL, NULL, NULL),
(7, '2016-12-15 03:59:18', 47, NULL, NULL, NULL, NULL, 47, 'son', 18, '2946', 1, '2016-12-14 08:25:07', '2016-12-15 04:59:18', NULL, NULL, NULL),
(8, '2016-12-15 03:00:05', 47, NULL, NULL, NULL, NULL, 47, 'son', 20, '2951', 1, '2016-12-14 08:25:12', '2016-12-15 04:00:05', NULL, NULL, NULL),
(9, '2016-12-14 07:25:16', 47, NULL, NULL, NULL, NULL, 47, '', 19, '', 0, '2016-12-14 08:25:16', '0000-00-00 00:00:00', NULL, NULL, NULL),
(10, '2016-12-14 07:45:19', 45, NULL, NULL, NULL, NULL, 45, 'crespo', 17, '2947', 1, '2016-12-14 08:31:58', '2016-12-14 08:45:19', NULL, NULL, NULL),
(12, '2016-12-14 07:34:50', 46, NULL, NULL, NULL, NULL, 46, 'bowyer', 15, '3173', 1, '2016-12-14 08:32:34', '2016-12-14 08:34:50', NULL, NULL, NULL),
(13, '2016-12-14 07:35:25', 46, NULL, NULL, NULL, NULL, 46, 'bowyer', 16, '2949', 1, '2016-12-14 08:32:35', '2016-12-14 08:35:25', NULL, NULL, NULL),
(14, '2016-12-14 07:36:10', 46, NULL, NULL, NULL, NULL, 46, 'bowyer', 17, '2947', 1, '2016-12-14 08:32:37', '2016-12-14 08:36:10', NULL, NULL, NULL),
(15, '2016-12-14 07:36:55', 46, NULL, NULL, NULL, NULL, 46, 'bowyer', 18, '2946', 1, '2016-12-14 08:32:38', '2016-12-14 08:36:55', NULL, NULL, NULL),
(16, '2016-12-14 07:32:43', 46, NULL, NULL, NULL, NULL, 46, '', 19, '', 0, '2016-12-14 08:32:43', '0000-00-00 00:00:00', NULL, NULL, NULL),
(17, '2016-12-14 07:32:46', 46, NULL, NULL, NULL, NULL, 46, '', 20, '', 0, '2016-12-14 08:32:46', '0000-00-00 00:00:00', NULL, NULL, NULL),
(18, '2016-12-14 07:32:50', 46, NULL, NULL, NULL, NULL, 46, '', 30, '', 0, '2016-12-14 08:32:50', '0000-00-00 00:00:00', NULL, NULL, NULL),
(43, '2016-12-14 09:16:20', 45, NULL, NULL, NULL, NULL, 45, 'crespo', 18, '2946', 1, '2016-12-14 10:16:12', '2016-12-14 10:16:20', NULL, NULL, NULL),
(45, '2016-12-14 09:17:11', 45, NULL, NULL, NULL, NULL, 45, 'crespo', 15, '3173', 1, '2016-12-14 10:16:46', '2016-12-14 10:17:11', NULL, NULL, NULL),
(48, '2016-12-14 09:20:04', 45, NULL, NULL, NULL, NULL, 45, 'crespo', 16, '2949', 1, '2016-12-14 10:19:03', '2016-12-14 10:20:04', NULL, NULL, NULL),
(49, '2016-12-14 10:02:26', 45, NULL, NULL, NULL, NULL, 45, 'crespo', 20, '2951', 1, '2016-12-14 10:20:20', '2016-12-14 11:02:26', NULL, NULL, NULL),
(56, '2016-12-14 10:18:53', 45, NULL, NULL, NULL, NULL, 45, 'crespo', 50, '2793', 1, '2016-12-14 11:18:15', '2016-12-14 11:18:53', NULL, NULL, NULL),
(65, '2016-12-15 02:10:23', 42, NULL, NULL, NULL, NULL, 42, 'batistuta', 29, '2950', 1, '2016-12-15 03:10:08', '2016-12-15 03:10:23', NULL, NULL, NULL),
(83, '2016-12-15 02:32:00', 42, NULL, NULL, NULL, NULL, 42, 'batistuta', 43, '2795', 1, '2016-12-15 03:31:45', '2016-12-15 03:32:00', NULL, NULL, NULL),
(84, '2016-12-15 02:59:44', 25, NULL, NULL, NULL, NULL, 47, '', 53, '', 0, '2016-12-15 03:59:44', '0000-00-00 00:00:00', NULL, NULL, NULL),
(85, '2016-12-15 04:02:36', 45, NULL, NULL, NULL, NULL, 45, 'crespo', 53, '3322', 1, '2016-12-15 05:02:22', '2016-12-15 05:02:36', NULL, NULL, NULL),
(86, '2016-12-16 01:59:55', 42, NULL, NULL, NULL, NULL, 42, 'batistuta', 20, '2951', 1, '2016-12-16 02:59:41', '2016-12-16 02:59:55', NULL, NULL, NULL),
(87, '2016-12-16 02:15:42', 42, NULL, NULL, NULL, NULL, 42, 'batistuta', 16, '2949', 1, '2016-12-16 03:06:31', '2016-12-16 03:15:42', NULL, NULL, NULL),
(88, '2016-12-16 02:20:31', 42, NULL, NULL, NULL, NULL, 42, 'batistuta', 37, '3321', 1, '2016-12-16 03:17:27', '2016-12-16 03:20:31', NULL, NULL, NULL),
(89, '2016-12-16 02:18:06', 42, NULL, NULL, NULL, NULL, 42, 'batistuta', 18, '2946', 1, '2016-12-16 03:17:36', '2016-12-16 03:18:06', NULL, NULL, NULL),
(91, '2016-12-16 02:27:29', 42, NULL, NULL, NULL, NULL, 42, 'batistuta', 50, '2793', 1, '2016-12-16 03:27:11', '2016-12-16 03:27:29', NULL, NULL, NULL),
(94, '2016-12-16 09:15:43', 45, NULL, NULL, NULL, NULL, 45, '', 24, '', 0, '2016-12-16 10:15:43', '0000-00-00 00:00:00', NULL, NULL, NULL),
(95, '2017-01-13 06:54:05', 25, NULL, NULL, NULL, NULL, 45, 'crespo', 21, '3172', 1, '2016-12-19 03:09:53', '2017-01-13 00:54:05', NULL, NULL, NULL),
(96, '2017-01-16 02:47:58', 45, NULL, NULL, NULL, NULL, 45, '', 47, '', 0, '2017-01-15 20:47:58', '0000-00-00 00:00:00', NULL, NULL, NULL),
(97, '2017-01-16 02:50:06', 45, NULL, NULL, NULL, NULL, 45, 'crespo', 56, '6278', 1, '2017-01-15 20:48:40', '2017-01-15 20:50:06', NULL, NULL, NULL),
(98, '2017-01-16 02:51:16', 45, NULL, NULL, NULL, NULL, 45, '', 28, '', 0, '2017-01-15 20:51:16', '0000-00-00 00:00:00', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_journals`
--

CREATE TABLE IF NOT EXISTS `user_journals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `journal_date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `credit_point` int(11) NOT NULL,
  `credit_exp_date` int(11) NOT NULL,
  `remarks` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=539 ;

--
-- Dumping data for table `user_journals`
--

INSERT INTO `user_journals` (`id`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`, `journal_date`, `user_id`, `credit_point`, `credit_exp_date`, `remarks`) VALUES
(342, '2016-09-07 03:32:29', 25, NULL, NULL, NULL, NULL, '0000-00-00', 41, 100, 0, ''),
(343, '2016-09-07 03:34:04', 41, NULL, NULL, NULL, NULL, '0000-00-00', 41, -10, 0, ''),
(344, '2016-09-07 03:34:08', 41, NULL, NULL, NULL, NULL, '0000-00-00', 41, -10, 0, ''),
(345, '2016-09-07 03:35:04', 41, NULL, NULL, NULL, NULL, '0000-00-00', 41, 10, 0, ''),
(346, '2016-09-07 03:35:07', 41, NULL, NULL, NULL, NULL, '0000-00-00', 41, 10, 0, ''),
(347, '2016-09-07 03:35:20', 41, NULL, NULL, NULL, NULL, '0000-00-00', 41, -10, 0, ''),
(348, '2016-09-07 03:35:22', 41, NULL, NULL, NULL, NULL, '0000-00-00', 41, -10, 0, ''),
(349, '2016-09-07 03:57:32', 41, NULL, NULL, NULL, NULL, '0000-00-00', 41, -10, 0, ''),
(350, '2016-09-07 03:57:36', 41, NULL, NULL, NULL, NULL, '0000-00-00', 41, -10, 0, ''),
(351, '2016-09-07 23:39:33', 25, NULL, NULL, NULL, NULL, '0000-00-00', 40, 210, 0, ''),
(352, '2016-09-07 23:39:55', 40, NULL, NULL, NULL, NULL, '0000-00-00', 40, -10, 0, ''),
(353, '2016-09-07 23:39:59', 40, NULL, NULL, NULL, NULL, '0000-00-00', 40, -10, 0, ''),
(354, '2016-09-07 23:40:07', 40, NULL, NULL, NULL, NULL, '0000-00-00', 40, -10, 0, ''),
(355, '2016-09-07 23:40:29', 40, NULL, NULL, NULL, NULL, '0000-00-00', 40, 10, 0, ''),
(356, '2016-09-08 02:44:37', 40, NULL, NULL, NULL, NULL, '0000-00-00', 40, 10, 0, ''),
(357, '2016-09-08 02:44:48', 40, NULL, NULL, NULL, NULL, '0000-00-00', 40, -10, 0, ''),
(358, '2016-09-16 21:56:06', 25, NULL, NULL, NULL, NULL, '0000-00-00', 41, -10, 0, ''),
(359, '2016-12-10 06:48:34', NULL, NULL, NULL, NULL, NULL, '2016-12-10', 42, 100, 2017, ''),
(360, '2016-12-10 06:49:15', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(361, '2016-12-10 06:49:22', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(362, '2016-12-10 06:49:25', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(363, '2016-12-10 06:49:44', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, 10, 0, ''),
(364, '2016-12-10 06:53:57', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(365, '2016-12-10 06:54:10', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(366, '2016-12-10 06:54:20', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(367, '2016-12-10 06:58:32', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(368, '2016-12-12 21:58:49', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(369, '2016-12-12 21:58:55', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(370, '2016-12-12 21:59:04', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(371, '2016-12-14 06:47:11', 25, NULL, NULL, NULL, NULL, '0000-00-00', 43, 250, 0, ''),
(372, '2016-12-14 06:47:11', 25, NULL, NULL, NULL, NULL, '0000-00-00', 42, 250, 0, ''),
(373, '2016-12-14 06:47:11', 25, NULL, NULL, NULL, NULL, '0000-00-00', 45, 250, 0, ''),
(374, '2016-12-14 06:47:11', 25, NULL, NULL, NULL, NULL, '0000-00-00', 44, 250, 0, ''),
(375, '2016-12-14 07:21:41', 25, NULL, NULL, NULL, NULL, '0000-00-00', 47, 75, 0, ''),
(376, '2016-12-14 07:21:42', 25, NULL, NULL, NULL, NULL, '0000-00-00', 46, 75, 0, ''),
(377, '2016-12-14 07:22:58', 25, NULL, NULL, NULL, NULL, '0000-00-00', 47, 0, 0, ''),
(378, '2016-12-14 07:22:58', 25, NULL, NULL, NULL, NULL, '0000-00-00', 46, 0, 0, ''),
(379, '2016-12-14 07:22:58', 25, NULL, NULL, NULL, NULL, '0000-00-00', 48, 50, 0, ''),
(380, '2016-12-14 07:24:50', 47, NULL, NULL, NULL, NULL, '0000-00-00', 47, -10, 0, ''),
(381, '2016-12-14 07:24:53', 47, NULL, NULL, NULL, NULL, '0000-00-00', 47, -10, 0, ''),
(382, '2016-12-14 07:24:57', 47, NULL, NULL, NULL, NULL, '0000-00-00', 47, -10, 0, ''),
(383, '2016-12-14 07:25:08', 47, NULL, NULL, NULL, NULL, '0000-00-00', 47, -10, 0, ''),
(384, '2016-12-14 07:25:12', 47, NULL, NULL, NULL, NULL, '0000-00-00', 47, -10, 0, ''),
(385, '2016-12-14 07:25:16', 47, NULL, NULL, NULL, NULL, '0000-00-00', 47, -10, 0, ''),
(386, '2016-12-14 07:31:58', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, -10, 0, ''),
(387, '2016-12-14 07:32:02', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, -10, 0, ''),
(388, '2016-12-14 07:32:34', 46, NULL, NULL, NULL, NULL, '0000-00-00', 46, -10, 0, ''),
(389, '2016-12-14 07:32:36', 46, NULL, NULL, NULL, NULL, '0000-00-00', 46, -10, 0, ''),
(390, '2016-12-14 07:32:37', 46, NULL, NULL, NULL, NULL, '0000-00-00', 46, -10, 0, ''),
(391, '2016-12-14 07:32:38', 46, NULL, NULL, NULL, NULL, '0000-00-00', 46, -10, 0, ''),
(392, '2016-12-14 07:32:43', 46, NULL, NULL, NULL, NULL, '0000-00-00', 46, -10, 0, ''),
(393, '2016-12-14 07:32:46', 46, NULL, NULL, NULL, NULL, '0000-00-00', 46, -10, 0, ''),
(394, '2016-12-14 07:32:50', 46, NULL, NULL, NULL, NULL, '0000-00-00', 46, -10, 0, ''),
(395, '2016-12-14 08:32:27', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(396, '2016-12-14 08:32:29', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(397, '2016-12-14 08:32:49', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(398, '2016-12-14 08:32:52', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(399, '2016-12-14 08:33:25', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, 10, 0, ''),
(400, '2016-12-14 08:33:26', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, 10, 0, ''),
(401, '2016-12-14 08:33:50', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(402, '2016-12-14 08:33:55', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(403, '2016-12-14 08:33:59', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(404, '2016-12-14 08:34:02', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(405, '2016-12-14 08:34:15', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, 10, 0, ''),
(406, '2016-12-14 08:34:17', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, 10, 0, ''),
(407, '2016-12-14 08:34:18', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, 10, 0, ''),
(408, '2016-12-14 08:34:23', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, 10, 0, ''),
(409, '2016-12-14 08:50:19', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(410, '2016-12-14 08:51:15', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(411, '2016-12-14 08:51:30', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(412, '2016-12-14 08:51:47', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(413, '2016-12-14 08:52:08', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(414, '2016-12-14 08:52:30', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(415, '2016-12-14 08:52:43', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(416, '2016-12-14 09:14:32', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, -10, 0, ''),
(417, '2016-12-14 09:14:34', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, -10, 0, ''),
(418, '2016-12-14 09:14:37', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, -10, 0, ''),
(419, '2016-12-14 09:14:40', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, -10, 0, ''),
(420, '2016-12-14 09:14:48', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, 10, 0, ''),
(421, '2016-12-14 09:14:50', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, 10, 0, ''),
(422, '2016-12-14 09:14:51', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, 10, 0, ''),
(423, '2016-12-14 09:14:53', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, 10, 0, ''),
(424, '2016-12-14 09:14:54', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, 10, 0, ''),
(425, '2016-12-14 09:15:09', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, -10, 0, ''),
(426, '2016-12-14 09:15:11', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, -10, 0, ''),
(427, '2016-12-14 09:15:15', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, -10, 0, ''),
(428, '2016-12-14 09:15:17', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, -10, 0, ''),
(429, '2016-12-14 09:15:23', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, -10, 0, ''),
(430, '2016-12-14 09:15:29', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, 10, 0, ''),
(431, '2016-12-14 09:15:30', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, 10, 0, ''),
(432, '2016-12-14 09:15:49', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, 10, 0, ''),
(433, '2016-12-14 09:15:52', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, 10, 0, ''),
(434, '2016-12-14 09:15:53', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, 10, 0, ''),
(435, '2016-12-14 09:16:12', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, -10, 0, ''),
(436, '2016-12-14 09:16:44', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, -10, 0, ''),
(437, '2016-12-14 09:16:46', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, -10, 0, ''),
(438, '2016-12-14 09:16:49', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, -10, 0, ''),
(439, '2016-12-14 09:16:51', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, -10, 0, ''),
(440, '2016-12-14 09:17:03', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, 10, 0, ''),
(441, '2016-12-14 09:17:06', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, 10, 0, ''),
(442, '2016-12-14 09:17:35', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, 10, 0, ''),
(443, '2016-12-14 09:19:03', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, -10, 0, ''),
(444, '2016-12-14 09:20:20', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, -10, 0, ''),
(445, '2016-12-14 09:20:24', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, -10, 0, ''),
(446, '2016-12-14 10:03:11', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, 10, 0, ''),
(447, '2016-12-14 10:03:16', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, -10, 0, ''),
(448, '2016-12-14 10:03:20', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, -10, 0, ''),
(449, '2016-12-14 10:06:04', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, -10, 0, ''),
(450, '2016-12-14 10:12:22', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, -10, 0, ''),
(451, '2016-12-14 10:15:54', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, -10, 0, ''),
(452, '2016-12-14 10:17:26', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, 10, 0, ''),
(453, '2016-12-14 10:17:28', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, 10, 0, ''),
(454, '2016-12-14 10:18:15', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, -25, 0, ''),
(455, '2016-12-14 10:20:29', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, -10, 0, ''),
(456, '2016-12-14 10:22:45', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, 10, 0, ''),
(457, '2016-12-15 01:52:03', 25, NULL, NULL, NULL, NULL, '0000-00-00', 45, -10, 0, ''),
(458, '2016-12-15 01:52:10', 25, NULL, NULL, NULL, NULL, '0000-00-00', 45, 10, 0, ''),
(459, '2016-12-15 01:56:23', 25, NULL, NULL, NULL, NULL, '0000-00-00', 45, -10, 0, ''),
(460, '2016-12-15 02:03:04', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, -10, 0, ''),
(461, '2016-12-15 02:03:50', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, 10, 0, ''),
(462, '2016-12-15 02:04:17', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, 10, 0, ''),
(463, '2016-12-15 02:04:19', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, 10, 0, ''),
(464, '2016-12-15 02:04:20', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, 10, 0, ''),
(465, '2016-12-15 02:04:22', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, 10, 0, ''),
(466, '2016-12-15 02:07:31', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(467, '2016-12-15 02:07:34', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(468, '2016-12-15 02:07:54', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, 10, 0, ''),
(469, '2016-12-15 02:07:55', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, 10, 0, ''),
(470, '2016-12-15 02:08:06', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(471, '2016-12-15 02:08:09', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(472, '2016-12-15 02:10:04', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(473, '2016-12-15 02:10:08', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(474, '2016-12-15 02:10:14', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, 10, 0, ''),
(475, '2016-12-15 02:10:15', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, 10, 0, ''),
(476, '2016-12-15 02:31:03', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(477, '2016-12-15 02:31:05', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(478, '2016-12-15 02:31:08', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(479, '2016-12-15 02:31:09', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(480, '2016-12-15 02:31:10', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(481, '2016-12-15 02:31:12', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(482, '2016-12-15 02:31:14', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(483, '2016-12-15 02:31:15', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(484, '2016-12-15 02:31:18', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(485, '2016-12-15 02:31:20', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(486, '2016-12-15 02:31:22', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(487, '2016-12-15 02:31:24', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(488, '2016-12-15 02:31:27', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(489, '2016-12-15 02:31:28', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(490, '2016-12-15 02:31:32', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(491, '2016-12-15 02:31:35', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(492, '2016-12-15 02:31:39', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -20, 0, ''),
(493, '2016-12-15 02:31:45', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(494, '2016-12-15 02:34:33', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, 10, 0, ''),
(495, '2016-12-15 02:34:34', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, 10, 0, ''),
(496, '2016-12-15 02:34:37', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, 10, 0, ''),
(497, '2016-12-15 02:34:39', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, 10, 0, ''),
(498, '2016-12-15 02:34:40', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, 10, 0, ''),
(499, '2016-12-15 02:34:41', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, 10, 0, ''),
(500, '2016-12-15 02:34:43', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, 10, 0, ''),
(501, '2016-12-15 02:34:44', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, 10, 0, ''),
(502, '2016-12-15 02:34:45', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, 10, 0, ''),
(503, '2016-12-15 02:34:46', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, 10, 0, ''),
(504, '2016-12-15 02:34:47', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, 10, 0, ''),
(505, '2016-12-15 02:34:48', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, 10, 0, ''),
(506, '2016-12-15 02:34:49', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, 10, 0, ''),
(507, '2016-12-15 02:34:50', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, 10, 0, ''),
(508, '2016-12-15 02:34:51', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, 10, 0, ''),
(509, '2016-12-15 02:34:53', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, 10, 0, ''),
(510, '2016-12-15 02:34:53', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, 10, 0, ''),
(511, '2016-12-15 02:34:54', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, 20, 0, ''),
(512, '2016-12-15 02:59:44', 25, NULL, NULL, NULL, NULL, '0000-00-00', 47, -10, 0, ''),
(513, '2016-12-15 04:02:22', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, -10, 0, ''),
(514, '2016-12-15 14:51:16', 25, NULL, NULL, NULL, NULL, '0000-00-00', 49, 3000, 0, ''),
(515, '2016-12-16 01:59:41', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(516, '2016-12-16 02:06:31', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(517, '2016-12-16 02:17:27', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(518, '2016-12-16 02:17:36', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -10, 0, ''),
(519, '2016-12-16 02:21:18', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -15, 0, ''),
(520, '2016-12-16 02:26:29', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, 15, 0, ''),
(521, '2016-12-16 02:27:11', 42, NULL, NULL, NULL, NULL, '0000-00-00', 42, -25, 0, ''),
(522, '2016-12-16 04:46:22', 25, NULL, NULL, NULL, NULL, '0000-00-00', 43, 75, 0, ''),
(523, '2016-12-16 04:46:22', 25, NULL, NULL, NULL, NULL, '0000-00-00', 42, 75, 0, ''),
(524, '2016-12-16 04:46:22', 25, NULL, NULL, NULL, NULL, '0000-00-00', 45, 75, 0, ''),
(525, '2016-12-16 04:46:22', 25, NULL, NULL, NULL, NULL, '0000-00-00', 44, 75, 0, ''),
(526, '2016-12-16 07:00:45', 25, NULL, NULL, NULL, NULL, '0000-00-00', 43, 25, 0, ''),
(527, '2016-12-16 07:00:45', 25, NULL, NULL, NULL, NULL, '0000-00-00', 42, 25, 0, ''),
(528, '2016-12-16 07:00:45', 25, NULL, NULL, NULL, NULL, '0000-00-00', 45, 25, 0, ''),
(529, '2016-12-16 07:00:45', 25, NULL, NULL, NULL, NULL, '0000-00-00', 44, 25, 0, ''),
(530, '2016-12-16 07:01:39', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, -10, 0, ''),
(531, '2016-12-16 07:01:51', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, 10, 0, ''),
(532, '2016-12-16 09:15:33', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, -10, 0, ''),
(533, '2016-12-16 09:15:43', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, -10, 0, ''),
(534, '2016-12-19 02:09:53', 25, NULL, NULL, NULL, NULL, '0000-00-00', 45, -10, 0, ''),
(535, '2017-01-09 06:18:53', 25, NULL, NULL, NULL, NULL, '0000-00-00', 45, 10, 0, ''),
(536, '2017-01-16 02:47:58', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, -10, 0, ''),
(537, '2017-01-16 02:48:40', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, -10, 0, ''),
(538, '2017-01-16 02:51:16', 45, NULL, NULL, NULL, NULL, '0000-00-00', 45, -10, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_report`
--

CREATE TABLE IF NOT EXISTS `user_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `scorm` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
