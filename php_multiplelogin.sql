-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2021 at 10:44 AM
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
  `subject_id` int(20) NOT NULL,
  `class_id` int(20) NOT NULL,
  `status_choose` varchar(20) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `choose_a_teaching`
--

INSERT INTO `choose_a_teaching` (`choose_id`, `master_id`, `subject_id`, `class_id`, `status_choose`) VALUES
(1, 29, 4, 2, 'Active'),
(2, 32, 3, 2, 'Active'),
(4, 42, 2, 1, 'Active'),
(5, 42, 4, 7, 'Active'),
(6, 29, 5, 2, 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `classroom_user`
--

CREATE TABLE `classroom_user` (
  `class_id` int(20) NOT NULL,
  `name_classroom` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `classroom_user`
--

INSERT INTO `classroom_user` (`class_id`, `name_classroom`, `status`) VALUES
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
(14, 'ป.6/2', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `grade_level_user`
--

CREATE TABLE `grade_level_user` (
  `id` int(20) NOT NULL,
  `name_gradelevel` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grade_level_user`
--

INSERT INTO `grade_level_user` (`id`, `name_gradelevel`, `status`) VALUES
(1, 'ประถมต้น', 'Active'),
(2, 'ประถมปลาย', 'Active'),
(3, 'อิสลามศึกษา ประถม', 'Active'),
(4, 'มัธยมต้น', 'Active'),
(5, 'มัธยมปลาย', 'Active'),
(6, 'อิสลามศึกษา มัธยม', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `import_excel`
--

CREATE TABLE `import_excel` (
  `excel_id` int(10) NOT NULL,
  `exfname` varchar(25) NOT NULL,
  `exlname` varchar(25) NOT NULL,
  `number_phone` char(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `masterlogin`
--

CREATE TABLE `masterlogin` (
  `master_id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `user_role_id` int(20) NOT NULL,
  `status_master` varchar(20) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `masterlogin`
--

INSERT INTO `masterlogin` (`master_id`, `fname`, `lname`, `username`, `password`, `email`, `user_role_id`, `status_master`) VALUES
(29, 'admin', 'add', 'admin', '123456', 'admin@gmail.com', 1, 'Active'),
(32, 'director', 'di', 'director', '123456', 'director@gmail.com', 2, 'Active'),
(40, 'aaa', 'aaaa', 'deputydirector', '123456', 'aaaa@aa.com', 3, 'Active'),
(41, 'Teeraphong', 'Singsaro', 'academicdepartment', '123456', '6110210183@psu.ac.th', 4, 'Active'),
(42, 'Teera', 'phong', 'teacher', '123456', 'f@e.com', 5, 'Active'),
(44, 'Teeraphong', 'Singsaro', 'we', '123456', '6110210183@psu.ac.th', 2, 'Active'),
(45, 'Teeraphong', 'Singsaro', 'teacher1', '123456', '6110210183@psu.ac.th', 5, 'Active'),
(46, 'Coconut', 'aaaa', 'teacher11', '123456', 'theaterace1@gmail.co', 5, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `prepare_hours`
--

CREATE TABLE `prepare_hours` (
  `id_prepare` int(11) NOT NULL,
  `master_id` int(20) NOT NULL,
  `subject_id` int(20) NOT NULL,
  `class_id` int(20) NOT NULL,
  `date_prepare` date NOT NULL,
  `learning` varchar(200) NOT NULL,
  `purpose` varchar(200) NOT NULL,
  `how_to_teach` varchar(200) NOT NULL,
  `media` varchar(200) NOT NULL,
  `measure` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prepare_hours`
--

INSERT INTO `prepare_hours` (`id_prepare`, `master_id`, `subject_id`, `class_id`, `date_prepare`, `learning`, `purpose`, `how_to_teach`, `media`, `measure`) VALUES
(49, 42, 2, 7, '2021-02-18', 'n hmcjufu', 'fiufififuif', 'fuifiu', 'fiufiui', 'fiufui'),
(50, 42, 4, 1, '2021-02-08', '                klgligo', 'giogiogo                ', 'oigiogo                ', 'igiogikf                ', 'fuififiu                '),
(51, 42, 4, 1, '2021-02-10', '                ooo', 'ooo                ', 'oo                ', 'oooo                ', 'ooo                '),
(52, 42, 2, 1, '2021-02-10', '                glig', 'g                ', 'gg                ', 'ggg                ', 'ggg                '),
(53, 42, 2, 7, '2021-02-10', '                แแแ<br><br><br><br>', 'แแแ                <br><br><br><br>', 'แแแแ                <br><br><br><br>', 'แแแ                <br><br><br><br>', 'แแแ                <br><br><br><br>'),
(54, 42, 2, 1, '2021-02-17', '                สาระการเรียนรู้/ตัวชี้วัด', '                จุดประสงค์', '                สอนอย่างไร(กระบวนการจัดการเรียน)', '                สื่อ/อุปกรณ์การเรียนรู้', '                วิธีวัดและประเมินการสอน/เครื่องมือ');

-- --------------------------------------------------------

--
-- Table structure for table `prepare_week`
--

CREATE TABLE `prepare_week` (
  `id_prepare_week` int(20) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prepare_week`
--

INSERT INTO `prepare_week` (`id_prepare_week`, `fname_lname`, `subject_id`, `date_prepare_week`, `goal`, `result`, `activity_good`, `activity_nogood`, `problem`, `student`, `Solve_the_problem`) VALUES
(6, 'Teera phong', 2021, '0000-00-00', '                e rgaedgv', '                adrfgvbadfvb', '                dfbvdfs', '                bsdfvbsdfb', '                dfbdfsb', '                sdfbsdfb', '                sdfbsdfb'),
(7, 'Teera phong', 2021, '0000-00-00', '                sdvsd', '                vsdvsdvs', '                dvsdv', '                sdvsdv', '                sDV', '                SDV', '                SDV');

-- --------------------------------------------------------

--
-- Table structure for table `subject_user`
--

CREATE TABLE `subject_user` (
  `subject_id` int(20) NOT NULL,
  `code_subject` varchar(20) NOT NULL,
  `name_subject` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subject_user`
--

INSERT INTO `subject_user` (`subject_id`, `code_subject`, `name_subject`, `status`) VALUES
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
(12, 'ก 11401', 'ภาษาไทย', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `user_role_id` int(20) NOT NULL,
  `name_role` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`user_role_id`, `name_role`, `status`) VALUES
(1, 'ผู้ดูแลระบบ', 'Active'),
(2, 'ผู้อำนวยการ', 'Inactive'),
(3, 'รองผู้อำนวยการ', 'Active'),
(4, 'ฝ่ายวิชาการ', 'Active'),
(5, 'ครู', 'Active');

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
-- Indexes for table `classroom_user`
--
ALTER TABLE `classroom_user`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `grade_level_user`
--
ALTER TABLE `grade_level_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `import_excel`
--
ALTER TABLE `import_excel`
  ADD PRIMARY KEY (`excel_id`);

--
-- Indexes for table `masterlogin`
--
ALTER TABLE `masterlogin`
  ADD PRIMARY KEY (`master_id`),
  ADD KEY `user_role_id` (`user_role_id`);

--
-- Indexes for table `prepare_hours`
--
ALTER TABLE `prepare_hours`
  ADD PRIMARY KEY (`id_prepare`),
  ADD KEY `master_id` (`master_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `prepare_week`
--
ALTER TABLE `prepare_week`
  ADD PRIMARY KEY (`id_prepare_week`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `subject_user`
--
ALTER TABLE `subject_user`
  ADD PRIMARY KEY (`subject_id`);

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
  MODIFY `choose_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `classroom_user`
--
ALTER TABLE `classroom_user`
  MODIFY `class_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `grade_level_user`
--
ALTER TABLE `grade_level_user`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `import_excel`
--
ALTER TABLE `import_excel`
  MODIFY `excel_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `masterlogin`
--
ALTER TABLE `masterlogin`
  MODIFY `master_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `prepare_hours`
--
ALTER TABLE `prepare_hours`
  MODIFY `id_prepare` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `prepare_week`
--
ALTER TABLE `prepare_week`
  MODIFY `id_prepare_week` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `subject_user`
--
ALTER TABLE `subject_user`
  MODIFY `subject_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `user_role_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `choose_a_teaching`
--
ALTER TABLE `choose_a_teaching`
  ADD CONSTRAINT `FK_class_id` FOREIGN KEY (`class_id`) REFERENCES `classroom_user` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_master_id` FOREIGN KEY (`master_id`) REFERENCES `masterlogin` (`master_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_subject_id` FOREIGN KEY (`subject_id`) REFERENCES `subject_user` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `masterlogin`
--
ALTER TABLE `masterlogin`
  ADD CONSTRAINT `FK_role` FOREIGN KEY (`user_role_id`) REFERENCES `user_role` (`user_role_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prepare_hours`
--
ALTER TABLE `prepare_hours`
  ADD CONSTRAINT `subject` FOREIGN KEY (`subject_id`) REFERENCES `subject_user` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
