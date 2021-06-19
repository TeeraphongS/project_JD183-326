-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2021 at 09:55 AM
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
-- Table structure for table `login_information`
--

CREATE TABLE `login_information` (
  `user_id` smallint NOT NULL,
  `email` varchar(64) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `username` varchar(64) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(64) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fname` varchar(64) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lname` varchar(64) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_role_id` tinyint DEFAULT NULL,
  `master_id` smallint DEFAULT NULL,
  `status_master` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_information`
--

INSERT INTO `login_information` (`user_id`, `email`, `username`, `password`, `fname`, `lname`, `user_role_id`, `master_id`, `status_master`) VALUES
(1, 'admin@gmail.com', 'admin', '123456', 'admin', 'add', 1, 29, 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login_information`
--
ALTER TABLE `login_information`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `master_id` (`master_id`),
  ADD KEY `main_data` (`email`,`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login_information`
--
ALTER TABLE `login_information`
  MODIFY `user_id` smallint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
