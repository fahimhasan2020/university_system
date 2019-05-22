-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2017 at 08:21 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `happy_coders_sms`
--
CREATE DATABASE IF NOT EXISTS `happy_coders_sms` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `happy_coders_sms`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(13) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` enum('Admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `role`) VALUES
(1, 'azimbitm@gmail.com', '123456', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `class_id` int(13) NOT NULL,
  `class_name` varchar(30) NOT NULL,
  `class_numeric` int(3) NOT NULL,
  `section` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`class_id`, `class_name`, `class_numeric`, `section`) VALUES
(6, 'Class One', 1, 'B'),
(13, 'Class One', 1, 'E'),
(14, 'Class One', 1, 'D'),
(15, 'Class One', 1, 'G');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(13) NOT NULL,
  `name` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `father_name` varchar(100) NOT NULL,
  `mother_name` varchar(100) NOT NULL,
  `class_id` int(13) NOT NULL,
  `roll_number` varchar(100) NOT NULL,
  `gender` varchar(13) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `name`, `dob`, `father_name`, `mother_name`, `class_id`, `roll_number`, `gender`, `address`, `email`, `password`, `phone`, `photo`) VALUES
(10, 'asdasd', '2010-01-04', 'asdsad', 'asdasdas', 13, '122', 'female', 'sdfdsfdsfdsf', 'admin@gmail.com', '123456', '1314564', '1508672644user.jpg'),
(15, 'Asad', '2009-01-04', 'Mona', 'Moni', 15, '255', 'male', 'asdfdsf', 'asad@gmail.com', '123456', '1314564', '1508693161');

-- --------------------------------------------------------

--
-- Table structure for table `students_result`
--

CREATE TABLE `students_result` (
  `result_id` int(13) NOT NULL,
  `student_id` int(13) NOT NULL,
  `class_id` int(13) NOT NULL,
  `subject_id` int(13) NOT NULL,
  `marks` varchar(10) NOT NULL,
  `grade` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students_result`
--

INSERT INTO `students_result` (`result_id`, `student_id`, `class_id`, `subject_id`, `marks`, `grade`) VALUES
(1, 10, 13, 14, '80', ''),
(2, 10, 13, 12, '80', ''),
(3, 15, 15, 16, '65', ''),
(4, 15, 15, 14, '55', ''),
(5, 15, 15, 15, '80', ''),
(6, 15, 15, 12, '55', '');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int(13) NOT NULL,
  `subject_name` varchar(100) NOT NULL,
  `subject_code` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `subject_name`, `subject_code`) VALUES
(12, 'Math', 'M-101'),
(14, 'Economic', 'Ec-101'),
(15, 'English', 'E-101'),
(16, 'Bangla', 'B-101');

-- --------------------------------------------------------

--
-- Table structure for table `sub_class_combination`
--

CREATE TABLE `sub_class_combination` (
  `combination_id` int(13) NOT NULL,
  `class_id` int(13) NOT NULL,
  `subject_id` int(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_class_combination`
--

INSERT INTO `sub_class_combination` (`combination_id`, `class_id`, `subject_id`) VALUES
(14, 14, 14),
(15, 13, 14),
(16, 13, 12),
(17, 15, 16),
(18, 15, 14),
(19, 15, 12),
(20, 15, 15);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teacher_id` int(13) NOT NULL,
  `name` varchar(100) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `gender` varchar(30) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `photo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `name`, `designation`, `gender`, `dob`, `address`, `email`, `password`, `phone`, `photo`) VALUES
(6, 'asdf', 'fasdf', 'Male', '2017-10-02', 'asdfs', 'dsfasdf@df.com', '5115', '95898', '1508604756user.jpg'),
(17, 'admin', 'dsfdsf', 'Male', '2017-10-11', 'sdfasfdsdf', 'admin@gmail.com', '123456', 'asdfsf', '1508434362user.jpg'),
(18, 'Abul', 'Head Teacher', 'male', '0000-00-00', 'adsfdsf', 'teacher@gmail.com', '64465', '56456456456', '1508594907user.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `students_result`
--
ALTER TABLE `students_result`
  ADD PRIMARY KEY (`result_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `sub_class_combination`
--
ALTER TABLE `sub_class_combination`
  ADD PRIMARY KEY (`combination_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacher_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `students_result`
--
ALTER TABLE `students_result`
  MODIFY `result_id` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `sub_class_combination`
--
ALTER TABLE `sub_class_combination`
  MODIFY `combination_id` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacher_id` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `students_result`
--
ALTER TABLE `students_result`
  ADD CONSTRAINT `students_result_ibfk_10` FOREIGN KEY (`subject_id`) REFERENCES `sub_class_combination` (`subject_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `students_result_ibfk_11` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `students_result_ibfk_9` FOREIGN KEY (`class_id`) REFERENCES `sub_class_combination` (`class_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sub_class_combination`
--
ALTER TABLE `sub_class_combination`
  ADD CONSTRAINT `sub_class_combination_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sub_class_combination_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
