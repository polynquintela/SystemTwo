-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2015 at 08:52 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cmsc128`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `account_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_username` varchar(30) NOT NULL,
  `account_password` varchar(30) NOT NULL,
  `emp_num` int(11) NOT NULL,
  PRIMARY KEY (`account_id`),
  UNIQUE KEY `account_username` (`account_username`),
  KEY `emp_num` (`emp_num`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`account_id`, `account_username`, `account_password`, `emp_num`) VALUES
(0, 'admin', 'password', 0);

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE IF NOT EXISTS `attendance` (
  `grading_period` varchar(10) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `student_days_tardy` int(11) NOT NULL,
  `student_days_present` int(11) NOT NULL,
  `school_days` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  KEY `batch_id` (`batch_id`),
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE IF NOT EXISTS `batch` (
  `batch_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_year` varchar(20) NOT NULL,
  `section` varchar(20) NOT NULL,
  `adviser` varchar(50) NOT NULL,
  `start_of_academic_year` year(4) NOT NULL,
  `end_of_academic_year` year(4) NOT NULL,
  PRIMARY KEY (`batch_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`batch_id`, `student_year`, `section`, `adviser`, `start_of_academic_year`, `end_of_academic_year`) VALUES
(5, 'Freshman', 'Kampupot', 'Paolo Javelona', 2016, 2017),
(6, 'Freshman', 'Katuray', 'Mary Clarino', 2020, 2021),
(8, 'Senior', 'Kamachile', 'Mary Clarino', 2040, 2041),
(9, 'Freshman', 'Kalachuchi', 'Paolo Javelona', 2016, 2017);

-- --------------------------------------------------------

--
-- Table structure for table `batch_student_reference`
--

CREATE TABLE IF NOT EXISTS `batch_student_reference` (
  `batch_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `total_school_days` int(11) NOT NULL,
  `total_days_present` int(11) NOT NULL,
  `total_days_tardy` int(11) NOT NULL,
  KEY `batch_id` (`batch_id`),
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `edit_history`
--

CREATE TABLE IF NOT EXISTS `edit_history` (
  `edit_history_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `emp_num` varchar(11) NOT NULL,
  `page` varchar(50) NOT NULL,
  `remarks` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `edit_history`
--

INSERT INTO `edit_history` (`edit_history_id`, `date`, `emp_num`, `page`, `remarks`) VALUES
(0, '2015-04-24 07:06:24', '201220694', 'edit attendance', '200317354 1 Fourth 23 23 23'),
(0, '2015-04-24 07:33:46', '201220694', 'edit attendance', '200317354   1   Fourth   23   23   23'),
(0, '2015-04-24 07:34:30', '201220694', 'edit attendance', '200317354   1   Fourth   23   23   0'),
(0, '2015-04-24 07:36:04', '201220694', 'edit attendance', '200317354   1   Fourth   21   0   21'),
(0, '2015-04-24 09:24:38', '201220694', 'edit attendance', 'Fourth   1   0      78   78200317354'),
(0, '2015-04-24 09:37:26', '201220694', 'edit attendance', 'Marion Dagang   adviser   '),
(0, '2015-04-24 10:15:07', '201220694', 'edit attendance', 'IV   Acacia   Joman Encinas      2012   2013'),
(0, '2015-04-24 10:19:06', '201220694', 'edit attendance', 'III   Acacia   Joman Encinas      2012   2013');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `Emp_num` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `Admin_flag` tinyint(1) DEFAULT NULL,
  `Subj_teacher_flag` tinyint(1) DEFAULT NULL,
  `Adviser_flag` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`Emp_num`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`Emp_num`, `name`, `Admin_flag`, `Subj_teacher_flag`, `Adviser_flag`) VALUES
(0, 'Mary Clarino', 1, 1, 1),
(3, 'Paolo Javelona', 0, 0, 1),
(21, 'Jessica Soho', 1, 0, 0),
(23, 'Mel Tiangco', 0, 1, 0),
(24, 'Karen Davila', 0, 0, 1),
(123, 'John Paul Quijano', 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `logs_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `emp_num` varchar(11) NOT NULL,
  `activity` varchar(30) NOT NULL,
  `remarks` varchar(300) NOT NULL,
  PRIMARY KEY (`logs_id`),
  KEY `emp_num` (`emp_num`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=78 ;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`logs_id`, `date`, `emp_num`, `activity`, `remarks`) VALUES
(29, '2015-05-09 21:22:00', '0', 'LOG-IN', ' '),
(30, '2015-05-09 21:22:05', '0', 'LOG-OUT', ''),
(31, '2015-05-09 21:26:19', '0', 'LOG-IN', ' '),
(32, '2015-05-09 21:26:23', '0', 'LOG-OUT', ''),
(33, '2015-05-09 21:26:47', '0', 'LOG-IN', ' '),
(34, '2015-05-09 21:26:51', '0', 'LOG-OUT', ''),
(35, '2015-05-10 03:19:24', '0', 'LOG-IN', ' '),
(36, '2015-05-10 04:27:12', '0', 'LOG-IN', ' '),
(37, '2015-05-10 04:44:50', '0', 'LOG-OUT', ''),
(38, '2015-05-10 04:44:55', '0', 'LOG-IN', ' '),
(39, '2015-05-10 04:46:39', '0', 'LOG-OUT', ''),
(40, '2015-05-10 04:48:26', '0', 'LOG-IN', ' '),
(41, '2015-05-10 04:48:32', '0', 'LOG-OUT', ''),
(42, '2015-05-10 04:48:37', '0', 'LOG-IN', ' '),
(43, '2015-05-10 05:10:32', '0', 'LOG-IN', ' '),
(44, '2015-05-10 05:22:19', '0', 'LOG-OUT', ''),
(45, '2015-05-10 05:22:23', '0', 'LOG-IN', ' '),
(46, '2015-05-10 09:58:46', '0', 'LOG-IN', ' '),
(47, '2015-05-10 10:26:30', '0', 'LOG-IN', ' '),
(48, '2015-05-10 10:26:34', '0', 'LOG-IN', ' '),
(49, '2015-05-10 10:27:11', '0', 'LOG-IN', ' '),
(50, '2015-05-10 10:27:16', '0', 'LOG-IN', ' '),
(51, '2015-05-10 10:27:36', '0', 'LOG-IN', ' '),
(52, '2015-05-10 10:30:19', '0', 'LOG-IN', ' '),
(53, '2015-05-10 10:30:39', '0', 'LOG-IN', ' '),
(54, '2015-05-10 10:30:56', '0', 'LOG-IN', ' '),
(55, '2015-05-10 10:33:59', '0', 'LOG-IN', ' '),
(56, '2015-05-10 10:35:36', '0', 'LOG-IN', ' '),
(57, '2015-05-10 10:36:18', '0', 'LOG-IN', ' '),
(58, '2015-05-10 10:36:39', '0', 'LOG-IN', ' '),
(59, '2015-05-10 10:43:45', '0', 'LOG-IN', ' '),
(60, '2015-05-10 10:58:34', '0', 'LOG-IN', ' '),
(61, '2015-05-10 11:06:38', '0', 'LOG-IN', ' '),
(62, '2015-05-10 11:31:15', '0', 'LOG-IN', ' '),
(63, '2015-05-10 11:35:45', '0', 'LOG-OUT', ''),
(64, '2015-05-10 11:36:08', '0', 'LOG-IN', ' '),
(65, '2015-05-10 11:38:58', '0', 'LOG-IN', ' '),
(66, '2015-05-10 11:48:52', '0', 'LOG-IN', ' '),
(67, '2015-05-10 12:06:36', '0', 'LOG-IN', ' '),
(68, '2015-05-10 12:24:41', '0', 'LOG-IN', ' '),
(69, '2015-05-10 12:24:58', '0', 'LOG-IN', ' '),
(70, '2015-05-10 12:28:13', '0', 'LOG-IN', ' '),
(71, '2015-05-10 12:29:37', '0', 'LOG-IN', ' '),
(72, '2015-05-10 12:30:27', '0', 'LOG-IN', ' '),
(73, '2015-05-10 12:30:59', '0', 'LOG-IN', ' '),
(74, '2015-05-10 12:34:51', '0', 'LOG-IN', ' '),
(75, '2015-05-10 17:27:40', '0', 'LOG-IN', ' '),
(76, '2015-05-10 17:37:43', '0', 'LOG-OUT', ''),
(77, '2015-05-10 17:37:47', '0', 'LOG-IN', ' ');

-- --------------------------------------------------------

--
-- Table structure for table `report_card`
--

CREATE TABLE IF NOT EXISTS `report_card` (
  `Report_card_id` int(11) NOT NULL AUTO_INCREMENT,
  `Student_ave_grade` float NOT NULL,
  `Student_id` int(11) NOT NULL,
  `Emp_num` int(11) NOT NULL,
  PRIMARY KEY (`Report_card_id`),
  KEY `Student_id` (`Student_id`,`Emp_num`),
  KEY `Emp_num` (`Emp_num`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `Student_id` int(11) NOT NULL AUTO_INCREMENT,
  `Student_name` varchar(50) NOT NULL,
  `Student_sex` varchar(6) NOT NULL,
  `status` varchar(20) NOT NULL,
  `address` varchar(50) NOT NULL,
  `nationality` varchar(20) NOT NULL,
  `curriculum` varchar(30) NOT NULL,
  `birthdate` varchar(20) NOT NULL,
  PRIMARY KEY (`Student_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`Student_id`, `Student_name`, `Student_sex`, `status`, `address`, `nationality`, `curriculum`, `birthdate`) VALUES
(3, 'Mary Clarino', 'Female', 'Good', 'Biak Na Bato, Los Banos, Laguna', 'British', 'Nursery', 'September 13 1992'),
(5, 'Arnold Clavicle', 'Male', 'Suspended', 'Batong Bato, Los Banos, Laguna', 'Klingon', 'Preschool', 'December 25 1992'),
(7, 'Bilbil Baggings', 'Male', 'Enrolled', 'Shire, Batong Malake, Los Banos, Laguna', 'Shirefolk', '2-Year Vocational', 'October 15 2005'),
(9, 'Jaypee Keanu', 'Female', 'Currently Lifting 15', 'Batong Mapink, Los Banos, Laguna', 'Japinoy', 'Fitness Education', 'April 4 2000');

-- --------------------------------------------------------

--
-- Table structure for table `student_subject_reference`
--

CREATE TABLE IF NOT EXISTS `student_subject_reference` (
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `Final_grade` int(11) NOT NULL,
  `Subject_action` varchar(20) NOT NULL,
  KEY `student_id` (`student_id`,`subject_id`),
  KEY `subject_id` (`subject_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `Subject_id` int(11) NOT NULL AUTO_INCREMENT,
  `Subject_type` varchar(20) NOT NULL,
  `Subject_unit` int(11) NOT NULL,
  `Subject_name` varchar(20) NOT NULL,
  `Time_slot_start` varchar(8) NOT NULL,
  `Description` varchar(100) NOT NULL,
  `Emp_num` int(11) NOT NULL,
  `Time_slot_end` varchar(8) NOT NULL,
  PRIMARY KEY (`Subject_id`),
  KEY `Student_id` (`Emp_num`),
  KEY `Emp_num` (`Emp_num`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`Subject_id`, `Subject_type`, `Subject_unit`, `Subject_name`, `Time_slot_start`, `Description`, `Emp_num`, `Time_slot_end`) VALUES
(13, 'Regular', 3, 'Humanities', '10 00 AM', 'Ridiculous!', 0, '11 30 AM'),
(14, 'Regular', 3, 'Social Science', '1 00 PM', 'Obnoxious!', 23, '2 00 PM'),
(15, 'Regular', 5, 'Microbiology', '7 00 PM', 'Scandalous!', 23, '9 30 PM'),
(16, 'Regular', 3, 'Analytic Geometry', '8 00 AM', '', 0, '9 00 AM');

-- --------------------------------------------------------

--
-- Table structure for table `subject_grade`
--

CREATE TABLE IF NOT EXISTS `subject_grade` (
  `grading_period` varchar(20) NOT NULL,
  `grade` float NOT NULL,
  `Subject_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  KEY `Subject_id` (`Subject_id`),
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subject_section`
--

CREATE TABLE IF NOT EXISTS `subject_section` (
  `Subject_id` int(11) NOT NULL,
  `section_name` varchar(20) NOT NULL,
  KEY `Subject_id` (`Subject_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `emp_num_fk` FOREIGN KEY (`emp_num`) REFERENCES `employee` (`Emp_num`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `batch_id_fk` FOREIGN KEY (`batch_id`) REFERENCES `batch` (`batch_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_id_fk4` FOREIGN KEY (`student_id`) REFERENCES `student` (`Student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `batch_student_reference`
--
ALTER TABLE `batch_student_reference`
  ADD CONSTRAINT `batch_to_student_fk` FOREIGN KEY (`batch_id`) REFERENCES `batch` (`batch_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_id_fk7` FOREIGN KEY (`student_id`) REFERENCES `student` (`Student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `report_card`
--
ALTER TABLE `report_card`
  ADD CONSTRAINT `emp_num_fk2` FOREIGN KEY (`Emp_num`) REFERENCES `employee` (`Emp_num`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_id_fk2` FOREIGN KEY (`Student_id`) REFERENCES `student` (`Student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_subject_reference`
--
ALTER TABLE `student_subject_reference`
  ADD CONSTRAINT `student_id_fk6` FOREIGN KEY (`student_id`) REFERENCES `student` (`Student_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subject_id_student_fk` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`Subject_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `emp_num_fk3` FOREIGN KEY (`Emp_num`) REFERENCES `employee` (`Emp_num`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subject_grade`
--
ALTER TABLE `subject_grade`
  ADD CONSTRAINT `student_id_fk3` FOREIGN KEY (`student_id`) REFERENCES `student` (`Student_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subject_id_fk` FOREIGN KEY (`Subject_id`) REFERENCES `subject` (`Subject_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subject_section`
--
ALTER TABLE `subject_section`
  ADD CONSTRAINT `subject_id_fk2` FOREIGN KEY (`Subject_id`) REFERENCES `subject` (`Subject_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
