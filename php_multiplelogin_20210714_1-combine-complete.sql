-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2021 at 07:46 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_multiplelogin`
--

-- --------------------------------------------------------

--
-- Table structure for table `choose_a_teaching`
--

CREATE TABLE `choose_a_teaching` (
  `choose_id` int(20) NOT NULL,
  `master_id` int(20) NOT NULL,
  `grade_id` int(10) NOT NULL,
  `subject_id` int(20) NOT NULL,
  `class_id` int(20) NOT NULL,
  `time_id` int(20) NOT NULL,
  `date` varchar(30) NOT NULL,
  `year_id` int(10) NOT NULL,
  `status_choose` varchar(20) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `choose_a_teaching`
--

INSERT INTO `choose_a_teaching` (`choose_id`, `master_id`, `grade_id`, `subject_id`, `class_id`, `time_id`, `date`, `year_id`, `status_choose`) VALUES
(57, 50, 9, 35, 1, 1, 'จันทร์', 1, 'Active'),
(58, 50, 9, 36, 7, 2, 'อังคาร', 1, 'Active'),
(59, 50, 10, 37, 13, 3, 'พุธ', 1, 'Active'),
(60, 50, 10, 38, 19, 4, 'พฤหัสบดี', 1, 'Active'),
(61, 50, 10, 39, 23, 5, 'ศุกร์', 1, 'Active'),
(62, 50, 9, 38, 1, 6, 'วันพุธ', 1, 'Active'),
(63, 50, 9, 35, 1, 1, 'จันทร์', 1, 'Active'),
(64, 50, 9, 36, 7, 2, 'อังคาร', 1, 'Active'),
(65, 50, 10, 37, 13, 3, 'พุธ', 1, 'Active'),
(66, 50, 10, 38, 19, 4, 'พฤหัสบดี', 1, 'Active'),
(67, 50, 10, 39, 23, 5, 'ศุกร์', 1, 'Active'),
(68, 56, 12, 36, 14, 3, 'วันอังคาร', 1, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `classroom`
--

CREATE TABLE `classroom` (
  `class_id` int(20) NOT NULL,
  `grade_id` int(10) NOT NULL,
  `name_classroom` varchar(50) NOT NULL,
  `status_class` varchar(20) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `classroom`
--

INSERT INTO `classroom` (`class_id`, `grade_id`, `name_classroom`, `status_class`) VALUES
(1, 9, 'ป.1/1', 'Active'),
(2, 9, 'ป.1/2', 'Active'),
(3, 9, 'ป.2/1', 'Active'),
(4, 9, 'ป.2/2', 'Active'),
(5, 9, 'ป.3/1', 'Active'),
(6, 9, 'ป.3/2', 'Active'),
(7, 12, 'ป.4/1', 'Active'),
(8, 12, 'ป.4/2', 'Active'),
(9, 12, 'ป.5/1', 'Active'),
(10, 12, 'ป.5/2', 'Active'),
(11, 12, 'ป.6/1', 'Active'),
(12, 12, 'ป.6/2', 'Active'),
(13, 10, 'ม.1/1', 'Active'),
(14, 10, 'ม.1/2', 'Active'),
(15, 10, 'ม.2/1', 'Active'),
(16, 10, 'ม.2/2', 'Active'),
(17, 10, 'ม.3/1', 'Active'),
(18, 10, 'ม.3/2', 'Active'),
(19, 11, 'ม.4/1', 'Active'),
(20, 11, 'ม.4/2', 'Active'),
(21, 11, 'ม.5/1', 'Active'),
(22, 11, 'ม.5/2', 'Active'),
(23, 11, 'ม.6/1', 'Active'),
(24, 11, 'ม.6/2', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `grade_level`
--

CREATE TABLE `grade_level` (
  `grade_id` int(20) NOT NULL,
  `grade_level_user` varchar(50) NOT NULL,
  `name_gradelevel` varchar(50) NOT NULL,
  `status_grade` varchar(20) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grade_level`
--

INSERT INTO `grade_level` (`grade_id`, `grade_level_user`, `name_gradelevel`, `status_grade`) VALUES
(9, 'ประถมศึกษา', 'ประถมต้น', 'Active'),
(10, 'ประถมศึกษา', 'ประถมปลาย', 'Active'),
(11, 'มัธยมศึกษา', 'มัธยมต้น', 'Active'),
(12, 'มัธยมศึกษา', 'มัธยมปลาย', 'Active'),
(13, 'ประถมศึกษา', 'อิสลามศึกษา', 'Active'),
(14, 'มัธยมศึกษา', 'อิสลามศึกษา', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `login_information`
--

CREATE TABLE `login_information` (
  `master_id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `user_role_id` int(20) NOT NULL,
  `status_master` varchar(20) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_information`
--

INSERT INTO `login_information` (`master_id`, `fname`, `lname`, `username`, `password`, `email`, `user_role_id`, `status_master`) VALUES
(29, 'admin', 'add', 'admin', '123456', 'admin@gmail.com', 1, 'Active'),
(32, 'director', 'di', 'director', '123456', 'director@gmail.com', 2, 'Active'),
(40, 'aaa', 'aaaa', 'deputydirector', '123456', 'aaaa@aa.com', 3, 'Active'),
(41, 'Teeraphong', 'Singsaro', 'academicdepartment', '123456', '6110210183@psu.ac.th', 4, 'Active'),
(42, 'Teera', 'phong', 'teacher', '123456', 'f@e.com', 5, 'Active'),
(44, 'Teeraphong', 'Singsaro', 'we', '123456', '6110210183@psu.ac.th', 2, 'Active'),
(45, 'Teeraphong', 'Singsaro', 'teacher1', '123456', '6110210183@psu.ac.th', 5, 'Active'),
(46, 'Coconut', 'aaaa', 'teacher11', '123456', 'theaterace1@gmail.co', 5, 'Active'),
(47, 'Teeraphong123', 'Singsaro44', 'teagreen', '12123', '6110210183@psu.ac.th', 5, 'Active'),
(48, '', '', 'test', 'test', 'test', 1, 'Active'),
(49, 'นายทดสอบ', 'แอดมิน', 'testadmin', '123456', 'testadmin@gmail.com', 1, 'Active'),
(50, 'นางสาวทดสอบ', 'คุณครู', 'test_teacher', '123456', 'test_teacher@gmail.c', 5, 'Active'),
(51, 'นายทดสอบ1', 'แอดมิน', 'test_aca', '123456', 'testadmin@gmail.com', 4, 'Active'),
(52, 'นายทดสอบ', 'ผู้อำนวยการ', 'director', '123456', 'testadmin@gmail.com', 2, 'Active'),
(53, 'Teeraphong', 'Singsaro', 'admin298', '123456', '6110210183@psu.ac.th', 1, 'Inactive'),
(54, 'Teeraphong', 'Singsaro', 'teacher111', '123123', '6110210183@psu.ac.th', 4, 'Active'),
(55, 'ธีรพงค์', 'ppp', 'adminwww', '12123', 'Teeraphongsingsaro@g', 4, 'Active'),
(56, 'kanom', 'pang', 'teacher', '123', 'kanom_pang@gmail.com', 5, 'Active'),
(57, 'admin', 'aiai', 'admin', '1111', 'admin123@gmail.com', 1, 'Active'),
(58, 'Teeraphong', 'Singsaro123', 'admin298', '111', '6110210183@psu.ac.th', 1, 'Active'),
(59, 'ธีรพงค์', 'สิงสาโร', 'admin121', '123456', '6110210183@psu.ac.th', 5, 'Active'),
(61, 'Teeraphong', 'Singsaro', 'aca_test', '123456', '6110210183@psu.ac.th', 15, 'Active'),
(62, 'kanom', 'pang', 'user1', '123456', 'kanom_pang@gmail.com', 1, 'Active'),
(75, 'Teeraphong', 'Singsaro', 'admin', '111', '6110210183@psu.ac.th', 3, 'Active'),
(76, 'นายทดสอบ', 'หัวหน้าประถม', 'test_primary', '123456', 'test_primary@gmail.c', 6, 'Active'),
(77, 'นายทดสอบ', 'หัวหน้ามัธยม', 'test_high', '123456', 'test_high@hmail.com', 7, 'Active'),
(78, 'นายทดสอบ1', 'ครู', 'test_teacher1', '123456', 'test_teacher1@gmail.', 5, 'Active'),
(79, 'guktyk', 'fjghm', 'gfhjm', '121', 'dfghn', 3, 'Active'),
(80, 'Teeraphong', 'Singsaro', 'ddd', 'qqq', '6110210183@psu.ac.th', 6, 'Active'),
(81, 'Teeraphong', 'Singsaro', 'a', 'sa', '6110210183@psu.ac.th', 1, 'Active'),
(82, 'Teeraphong', 'Singsaro', 'sss', '11', '6110210183@psu.ac.th', 3, 'Active'),
(83, 'Teeraphong', 'Singsaro', 'aa', 's', '6110210183@psu.ac.th', 5, 'Active'),
(84, 'Teeraphong', 'Singsaro', 'df', 'd', '6110210183@psu.ac.th', 1, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `notify`
--

CREATE TABLE `notify` (
  `master_id` int NOT NULL,
  `code` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notify`
--

INSERT INTO `notify` (`master_id`, `code`, `token`) VALUES
(29, 'koKEOUT4h2Zs6sFbAqTyZ6', '6mfimexZoSytrghk7g42DpEM42IlNTajid9ZVlwYwc3'),
(50, '', ''),
(32, '', ''),
(44, '', ''),
(40, '', ''),
(41, '', ''),
(42, '', ''),
(45, '', ''),
(46, '', ''),
(47, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `prepare_to_teach`
--

CREATE TABLE `prepare_to_teach` (
  `id_prepare` int(11) NOT NULL,
  `choose_id` int(20) NOT NULL,
  `date_prepare` varchar(50) NOT NULL,
  `learning` varchar(200) NOT NULL,
  `purpose` varchar(200) NOT NULL,
  `how_to_teach` varchar(200) NOT NULL,
  `media` varchar(200) NOT NULL,
  `measure` varchar(200) NOT NULL,
  `status_prepare_hours` varchar(20) NOT NULL DEFAULT 'Checking',
  `status_prepare` varchar(20) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prepare_to_teach`
--

INSERT INTO `prepare_to_teach` (`id_prepare`, `choose_id`, `date_prepare`, `learning`, `purpose`, `how_to_teach`, `media`, `measure`, `status_prepare_hours`, `status_prepare`) VALUES
(7, 30, '17/05/2021', 'การงาน', 'การงาน', 'การงาน', 'การงาน', 'การงาน', 'Checking', 'Active'),
(8, 29, '17/05/2021', 'การงาน', 'การงาน', 'การงาน', 'การงาน', 'การงาน', 'Checking', 'Active'),
(9, 28, '17/05/2021', 'การงาน', 'การงาน', 'การงาน', 'การงาน', 'การงาน', 'Complete', 'Active'),
(10, 28, '17/05/2021', 'ssssssss', 's', 's', 's', 's', 'Complete', 'Active'),
(11, 1, '10/06/2021', 'jjj', 'jjj', 'jjj', 'jj', 'jj', 'Complete', 'Active'),
(12, 6, '10/06/2021', 'stgsd', 'sdgb', 'sdgsgdb', 'sgdb', 'fgb', 'Checking', 'Active'),
(13, 57, '14/06/2021', 'ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ', 'ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ', 'ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบ\r\nระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบ\r\nระบบ,ทดสอบระบบ', 'ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ', 'ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ', 'Checking', 'Active'),
(14, 58, '14/06/2021', 'ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ', 'ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ', 'ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบ\r\nระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบ\r\nระบบ,ทดสอบระบบ', 'ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ', 'ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ', 'Complete', 'Active'),
(15, 59, '14/06/2021', 'ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ', 'ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ', 'ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบ\r\nระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบ\r\nระบบ,ทดสอบระบบ', 'ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ', 'ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ', 'Incomplete', 'Active'),
(16, 60, '14/06/2021', 'ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ', 'ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ', 'ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบ\r\nระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบ\r\nระบบ,ทดสอบระบบ', 'ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ', 'ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ,ทดสอบระบบ', 'Complete', 'Active'),
(17, 59, '05/07/2564', 'nghng', 'nghn', 'ghn', 'gn', 'g', 'Checking', 'Active'),
(18, 57, '15/07/2021', 'g', 'g', 'g', 'g', 'g', 'Checking', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subject_id` int(20) NOT NULL,
  `grade_id` int(10) NOT NULL,
  `code_subject` varchar(20) NOT NULL,
  `name_subject` varchar(50) NOT NULL,
  `status_subject` varchar(20) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_id`, `grade_id`, `code_subject`, `name_subject`, `status_subject`) VALUES
(2, 11, 'ค 11101', 'คณิตศาสตร์', 'Active'),
(3, 12, 'ท 11101', 'ภาษาไทย', 'Active'),
(4, 14, 'ธ 11201', 'ภาษาอาหรับ', 'Active'),
(5, 12, 'อ 11101', 'อังกฤษ', 'Active'),
(6, 10, 'ส 11102', 'ประวัติศาสตร์', 'Active'),
(7, 13, 'ส 11201', 'อิสลามศึกษา', 'Active'),
(8, 11, 'ว 11101', 'วิทยาศาสตร์และเทคโนโลยี', 'Active'),
(9, 10, 'พ 11101', 'สุขศึกษาและพลศีกษา', 'Active'),
(10, 12, 'อ 11201', 'อังกฤษเพื่อการสื่อสาร', 'Active'),
(11, 10, 'ก 11401', 'ชุมนุม', 'Active'),
(12, 11, 'ก 11401', 'ภาษาไทย', 'Active'),
(13, 12, 'ENG112', 'ENGLISH', 'Active'),
(35, 9, 'อ 11011', 'อังกฤษ', 'Active'),
(36, 9, 'ค 11012', 'คณิตศาสตร์', 'Active'),
(37, 10, 'อ 12012', 'อังกฤษเพื่อการสื่อสาร', 'Active'),
(38, 12, 'ว 21021', 'ฟิสิกส์', 'Active'),
(39, 12, 'ว 42002', 'เคมี', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `time`
--

CREATE TABLE `time` (
  `time_id` int(20) NOT NULL,
  `time_name` varchar(50) NOT NULL,
  `year_id` int(10) NOT NULL,
  `status_time` varchar(20) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `time`
--

INSERT INTO `time` (`time_id`, `time_name`, `year_id`, `status_time`) VALUES
(1, '08:00 - 09:00', 1, 'Active'),
(2, '09:00 - 10:00', 1, 'Active'),
(3, '10:00 - 11:00', 1, 'Active'),
(4, '11:00 - 12:00', 1, 'Active'),
(5, '13:00 - 14:00', 1, 'Active'),
(6, '14:00 - 15:00', 1, 'Active'),
(7, '15:00 - 16:00', 1, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `user_role_id` int(20) NOT NULL,
  `name_role` varchar(50) NOT NULL,
  `status_role` varchar(20) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`user_role_id`, `name_role`, `status_role`) VALUES
(1, 'ผู้ดูแลระบบ', 'Active'),
(2, 'ผู้อำนวยการ', 'Active'),
(3, 'รองผู้อำนวยการ', 'Active'),
(4, 'ฝ่ายวิชาการ', 'Inactive'),
(5, 'ครู', 'Active'),
(6, 'หัวหน้าช่วงชั้นประถม', 'Active'),
(7, 'หัวหน้าช่วงชั้นมัธยม', 'Active'),
(10, 'ผู้จัดการ', 'Inactive'),
(12, 'adminๆ', 'Inactive'),
(13, 'ประถมต้น', 'Inactive'),
(14, 'Adminqq1', 'Inactive'),
(15, 'ผู้ดูแลระบบ11', 'Inactive'),
(16, 'ฝ่ายวิชาการ112', 'Inactive'),
(17, 'ผู้อำนวยการmm', 'Inactive');
-- --------------------------------------------------------

--
-- Table structure for table `weekly_summary`
--

CREATE TABLE `weekly_summary` (
  `id_prepare_week` int NOT NULL,
  `fname_lname` varchar(75) NOT NULL,
  `subject_id` int(20) NOT NULL,
  `date_prepare_week` date NOT NULL,
  `goal` varchar(200) NOT NULL,
  `result` varchar(200) NOT NULL,
  `activity_good` varchar(200) NOT NULL,
  `activity_nogood` varchar(200) NOT NULL,
  `problem` varchar(200) NOT NULL,
  `student` varchar(200) NOT NULL,
  `Solve_the_problem` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `weekly_summary`
--

INSERT INTO `weekly_summary` (`id_prepare_week`, `fname_lname`, `subject_id`, `date_prepare_week`, `goal`, `result`, `activity_good`, `activity_nogood`, `problem`, `student`, `Solve_the_problem`) VALUES
(6, 'Teera phong', 2021, '0000-00-00', '                e rgaedgv', '                adrfgvbadfvb', '                dfbvdfs', '                bsdfvbsdfb', '                dfbdfsb', '                sdfbsdfb', '                sdfbsdfb'),
(7, 'Teera phong', 2021, '0000-00-00', '                sdvsd', '                vsdvsdvs', '                dvsdv', '                sdvsdv', '                sDV', '                SDV', '                SDV');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `choose_a_teaching`
--
ALTER TABLE `choose_a_teaching`
  ADD PRIMARY KEY (`choose_id`),
  ADD KEY `FK_class_id` (`class_id`),
  ADD KEY `master_id` (`master_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `grade_id` (`grade_id`),
  ADD KEY `time_id` (`time_id`),
  ADD KEY `year` (`year_id`);

--
-- Indexes for table `classroom`
--
ALTER TABLE `classroom`
  ADD PRIMARY KEY (`class_id`),
  ADD KEY `grade_id` (`grade_id`);

--
-- Indexes for table `grade_level`
--
ALTER TABLE `grade_level`
  ADD PRIMARY KEY (`grade_id`);

--
-- Indexes for table `login_information`
--
ALTER TABLE `login_information`
  ADD PRIMARY KEY (`master_id`),
  ADD KEY `user_role_id` (`user_role_id`);

--
-- Indexes for table `prepare_to_teach`
--
ALTER TABLE `prepare_to_teach`
  ADD PRIMARY KEY (`id_prepare`),
  ADD KEY `choose_id` (`choose_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subject_id`),
  ADD KEY `grade_id` (`grade_id`);

--
-- Indexes for table `time`
--
ALTER TABLE `time`
  ADD PRIMARY KEY (`time_id`),
  ADD KEY `year_id` (`year_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`user_role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `choose_a_teaching`
--
ALTER TABLE `choose_a_teaching`
  MODIFY `choose_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `classroom`
--
ALTER TABLE `classroom`
  MODIFY `class_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `grade_level`
--
ALTER TABLE `grade_level`
  MODIFY `grade_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `login_information`
--
ALTER TABLE `login_information`
  MODIFY `master_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `prepare_to_teach`
--
ALTER TABLE `prepare_to_teach`
  MODIFY `id_prepare` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subject_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `time`
--
ALTER TABLE `time`
  MODIFY `time_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `user_role_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `login_information`
--
ALTER TABLE `login_information`
  ADD CONSTRAINT `FK_role` FOREIGN KEY (`user_role_id`) REFERENCES `user_role` (`user_role_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
