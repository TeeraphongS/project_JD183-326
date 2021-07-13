-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2021 at 08:41 PM
-- Server version: 8.0.25
-- PHP Version: 7.4.16

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
  `choose_id` int NOT NULL,
  `master_id` int NOT NULL,
  `subject_id` int NOT NULL,
  `class_id` int NOT NULL,
  `status_choose` varchar(20) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `choose_a_teaching`
--

INSERT INTO `choose_a_teaching` (`choose_id`, `master_id`, `subject_id`, `class_id`, `status_choose`) VALUES
(1, 29, 4, 2, 'Active'),
(2, 32, 3, 2, 'Active'),
(4, 42, 2, 1, 'Active'),
(5, 42, 4, 7, 'Active'),
(6, 29, 5, 2, 'Inactive'),
(7, 41, 10, 14, 'Active'),
(8, 40, 8, 3, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `classroom`
--

CREATE TABLE `classroom` (
  `class_id` int NOT NULL,
  `name_classroom` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `classroom`
--

INSERT INTO `classroom` (`class_id`, `name_classroom`, `status`) VALUES
(1, 'ป.1/1', 'Active'),
(2, 'ป.1/2', 'Active'),
(3, 'ป.2/1', 'Active'),
(4, 'ป.2/2', 'Active'),
(7, 'ป.3/1', 'Active'),
(8, 'ป.3/2', 'Active'),
(9, 'ป.4/1', 'Active'),
(10, 'ป.4/2', 'Active'),
(11, 'ป.5/1', 'Active'),
(12, 'ป.5/2', 'Active'),
(13, 'ป.6/1', 'Active'),
(14, 'ป.6/2', 'Active'),
(15, 'ป.1/112', 'Active'),
(16, 'ป.1/111', 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `grade_level`
--

CREATE TABLE `grade_level` (
  `id` int NOT NULL,
  `name_gradelevel` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `grade_level`
--

INSERT INTO `grade_level` (`id`, `name_gradelevel`, `status`) VALUES
(1, 'ประถมต้น', 'Active'),
(2, 'ประถมปลาย', 'Active'),
(3, 'อิสลามศึกษา ประถม', 'Active'),
(4, 'มัธยมต้น', 'Active'),
(5, 'มัธยมปลาย', 'Active'),
(6, 'อิสลามศึกษา มัธยม', 'Active'),
(7, 'ประถมต้น1234', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `login_information`
--

CREATE TABLE `login_information` (
  `master_id` int NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `user_role_id` int NOT NULL,
  `status_master` varchar(20) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
(50, '', '', 'test', 'test', 'test', 1, 'Active');

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
  `id_prepare` int NOT NULL,
  `master_id` int NOT NULL,
  `subject_id` int NOT NULL,
  `class_id` int NOT NULL,
  `date_prepare` date NOT NULL,
  `learning` varchar(200) NOT NULL,
  `purpose` varchar(200) NOT NULL,
  `how_to_teach` varchar(200) NOT NULL,
  `media` varchar(200) NOT NULL,
  `measure` varchar(200) NOT NULL,
  `status_prepare_hours` varchar(20) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `prepare_to_teach`
--

INSERT INTO `prepare_to_teach` (`id_prepare`, `master_id`, `subject_id`, `class_id`, `date_prepare`, `learning`, `purpose`, `how_to_teach`, `media`, `measure`, `status_prepare_hours`) VALUES
(56, 42, 2, 1, '2021-03-25', 'สาระการเรียนรู้/ตัวชี้วัดนี้', 'จุดประสงค์นี้', 'สอนอย่างไร(กระบวนการจัดการเรียน)นี้', 'สื่อ/อุปกรณ์การเรียนรู้นี้', 'วิธีวัดและประเมินการสอน/เครื่องมือนี้', 'Complete'),
(57, 42, 4, 7, '2021-03-19', '                w45gerga', '                gseatgsdfg', '                dafsg', '                drfabg', '                dfbsdfb', '2'),
(58, 42, 2, 7, '2021-03-26', '                wrgtrtg', '                wrgtr', '                wtgrt', '                regter', '                wrtgegt', '2');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subject_id` int NOT NULL,
  `code_subject` varchar(20) NOT NULL,
  `name_subject` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_id`, `code_subject`, `name_subject`, `status`) VALUES
(2, 'ค 11101', 'คณิตศาสตร์', 'Active'),
(3, 'ท 11101', 'ภาษาไทย', 'Active'),
(4, 'ธ 11201', 'ภาษาอาหรับ', 'Active'),
(5, 'อ 11101', 'อังกฤษ', 'Active'),
(6, 'ส 11102', 'ประวัติศาสตร์', 'Active'),
(7, 'ส 11201', 'อิสลามศึกษา', 'Active'),
(8, 'ว 11101', 'วิทยาศาสตร์และเทคโนโลยี', 'Active'),
(9, 'พ 11101', 'สุขศึกษาและพลศีกษา', 'Active'),
(10, 'อ 11201', 'อังกฤษเพื่อการสื่อสาร', 'Active'),
(11, 'ก 11401', 'ชุมนุม', 'Active'),
(12, 'ก 11401', 'ภาษาไทย', 'Active'),
(13, 'ENG112', 'ENGLISH', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `user_role_id` int NOT NULL,
  `name_role` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`user_role_id`, `name_role`, `status`) VALUES
(1, 'ผู้ดูแลระบบ', 'Active'),
(2, 'ผู้อำนวยการ', 'Inactive'),
(3, 'รองผู้อำนวยการ', 'Active'),
(4, 'ฝ่ายวิชาการ', 'Active'),
(5, 'ครู', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `weekly_summary`
--

CREATE TABLE `weekly_summary` (
  `id_prepare_week` int NOT NULL,
  `fname_lname` varchar(75) NOT NULL,
  `subject_id` int NOT NULL,
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
  ADD KEY `FK_subject_id` (`subject_id`),
  ADD KEY `FK_class_id` (`class_id`),
  ADD KEY `master_id` (`master_id`);

--
-- Indexes for table `classroom`
--
ALTER TABLE `classroom`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `grade_level`
--
ALTER TABLE `grade_level`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `master_id` (`master_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subject_id`);
--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`user_role_id`);

--
-- Indexes for table `weekly_summary`
--
ALTER TABLE `weekly_summary`
  ADD PRIMARY KEY (`id_prepare_week`),
  ADD KEY `subject_id` (`subject_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `choose_a_teaching`
--
ALTER TABLE `choose_a_teaching`
  MODIFY `choose_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `classroom`
--
ALTER TABLE `classroom`
  MODIFY `class_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `grade_level`
--
ALTER TABLE `grade_level`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `login_information`
--
ALTER TABLE `login_information`
  MODIFY `master_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `prepare_to_teach`
--
ALTER TABLE `prepare_to_teach`
  MODIFY `id_prepare` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subject_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `user_role_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `weekly_summary`
--
ALTER TABLE `weekly_summary`
  MODIFY `id_prepare_week` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `choose_a_teaching`
--
ALTER TABLE `choose_a_teaching`
  ADD CONSTRAINT `FK_class_id` FOREIGN KEY (`class_id`) REFERENCES `classroom` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_master_id` FOREIGN KEY (`master_id`) REFERENCES `login_information` (`master_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_subject_id` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `login_information`
--
ALTER TABLE `login_information`
  ADD CONSTRAINT `FK_role` FOREIGN KEY (`user_role_id`) REFERENCES `user_role` (`user_role_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prepare_to_teach`
--
ALTER TABLE `prepare_to_teach`
  ADD CONSTRAINT `subject` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
