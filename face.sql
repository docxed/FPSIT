-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2019 at 10:38 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `face`
--

-- --------------------------------------------------------

--
-- Table structure for table `checked`
--

CREATE TABLE `checked` (
  `c_id` int(4) NOT NULL,
  `c_sid` int(8) NOT NULL,
  `c_pre` varchar(30) NOT NULL,
  `c_first` varchar(50) NOT NULL,
  `c_last` varchar(50) NOT NULL,
  `c_fac` varchar(100) NOT NULL,
  `c_seat` varchar(3) NOT NULL,
  `c_session` int(4) NOT NULL,
  `c_checked` varchar(30) NOT NULL DEFAULT 'รอการเช็ค',
  `c_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `checked`
--

INSERT INTO `checked` (`c_id`, `c_sid`, `c_pre`, `c_first`, `c_last`, `c_fac`, `c_seat`, `c_session`, `c_checked`, `c_timestamp`) VALUES
(12, 62070168, 'นาย', 'วิชยุตม์', 'ทวิชัยยุทธ', 'เทคโนโลยีสารสนเทศ', 'A1', 3, 'รอการเช็ค', '2019-12-12 16:34:39'),
(14, 62070168, 'นาย', 'วิชยุตม์', 'ทวิชัยยุทธ', 'เทคโนโลยีสารสนเทศ', 'A1', 2, 'รอการเช็ค', '2019-12-12 16:36:02'),
(15, 62070169, 'นางสาว', 'วิภาวดี', 'สถาพร', 'เทคโนโลยีสารสนเทศ', 'A2', 2, 'เช็คแล้ว', '2019-12-12 16:36:28');

-- --------------------------------------------------------

--
-- Table structure for table `classroom`
--

CREATE TABLE `classroom` (
  `class_id` int(4) NOT NULL,
  `class_date` date NOT NULL,
  `class_start` time NOT NULL,
  `class_end` time NOT NULL,
  `class_subjectid` varchar(8) NOT NULL,
  `class_subject` varchar(100) NOT NULL,
  `class_fac` varchar(100) NOT NULL,
  `class_term` int(2) NOT NULL,
  `class_year` int(4) NOT NULL,
  `class_building` varchar(30) NOT NULL,
  `class_room` varchar(30) NOT NULL,
  `class_status` varchar(30) NOT NULL,
  `class_email` varchar(50) NOT NULL,
  `class_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `classroom`
--

INSERT INTO `classroom` (`class_id`, `class_date`, `class_start`, `class_end`, `class_subjectid`, `class_subject`, `class_fac`, `class_term`, `class_year`, `class_building`, `class_room`, `class_status`, `class_email`, `class_timestamp`) VALUES
(2, '2019-12-16', '13:30:00', '16:30:00', '06016319', 'INTRODUCTION TO COMPUTER SYSTEMS', 'เทคโนโลยีสารสนเทศ', 1, 2562, 'IT', 'M23', 'ยังไม่จัดสอบ', 'akira.ajeyb@gmail.com', '2019-12-12 04:43:22'),
(3, '2019-12-06', '09:30:00', '12:30:00', '90101007', 'INTRODUCTION TO MATHEMATICAL ECONOMICS', 'เทคโนโลยีสารสนเทศ', 1, 2562, 'IT', 'M04', 'จัดสอบแล้ว', 'akira.ajeyb@gmail.com', '2019-12-12 06:09:28');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `m_id` int(4) NOT NULL,
  `m_first` varchar(50) NOT NULL,
  `m_last` varchar(50) NOT NULL,
  `m_email` varchar(50) NOT NULL,
  `m_pass` varchar(30) NOT NULL,
  `m_level` enum('teacher','student','admin') NOT NULL DEFAULT 'teacher',
  `m_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`m_id`, `m_first`, `m_last`, `m_email`, `m_pass`, `m_level`, `m_timestamp`) VALUES
(1, 'อคิราภ์', 'สีแสนยง', 'akira.ajeyb@gmail.com', '1234', 'teacher', '2019-12-11 07:51:30'),
(2, 'สากล', 'ธีรสุวรรณจักร', '62070195@kmitl.ac.th', '1234', 'teacher', '2019-12-11 08:01:13');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `stu_id` int(4) NOT NULL,
  `stu_sid` int(8) NOT NULL,
  `stu_pre` varchar(30) NOT NULL,
  `stu_first` varchar(50) NOT NULL,
  `stu_last` varchar(50) NOT NULL,
  `stu_fac` varchar(100) NOT NULL,
  `stu_img` varchar(50) NOT NULL,
  `stu_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`stu_id`, `stu_sid`, `stu_pre`, `stu_first`, `stu_last`, `stu_fac`, `stu_img`, `stu_timestamp`) VALUES
(3, 62070169, 'นางสาว', 'วิภาวดี', 'สถาพร', 'เทคโนโลยีสารสนเทศ', 'stu_5df20827f24ab.jpg', '2019-12-12 09:28:07'),
(4, 62070168, 'นาย', 'วิชยุตม์', 'ทวิชัยยุทธ', 'เทคโนโลยีสารสนเทศ', 'stu_5df203691d3a0.jpg', '2019-12-12 13:01:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checked`
--
ALTER TABLE `checked`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `classroom`
--
ALTER TABLE `classroom`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`stu_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checked`
--
ALTER TABLE `checked`
  MODIFY `c_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `classroom`
--
ALTER TABLE `classroom`
  MODIFY `class_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `m_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `stu_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
