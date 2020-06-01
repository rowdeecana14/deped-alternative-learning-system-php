-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2019 at 09:39 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `deped_als`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_learners`
--

CREATE TABLE `tbl_learners` (
  `member_id` varchar(200) NOT NULL,
  `learner_fullname` varchar(200) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `date_of_birth` varchar(100) NOT NULL,
  `mother_toungue` varchar(100) NOT NULL,
  `religion` varchar(100) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `occupation` varchar(100) NOT NULL,
  `father_fullname` varchar(100) NOT NULL,
  `mother_fullname` varchar(100) NOT NULL,
  `contact_no` varchar(100) DEFAULT NULL,
  `grade_level` varchar(100) DEFAULT NULL,
  `category_of_learner` varchar(100) DEFAULT NULL,
  `date_mapped` varchar(100) DEFAULT NULL,
  `interested_in_als` varchar(100) DEFAULT NULL,
  `preferred_program` varchar(100) DEFAULT NULL,
  `date_attendance` varchar(100) DEFAULT NULL,
  `lrn` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_logs`
--

CREATE TABLE `tbl_logs` (
  `logs_id` int(11) NOT NULL,
  `learner_fullname` varchar(200) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `date_of_birth` varchar(100) NOT NULL,
  `mother_toungue` varchar(100) NOT NULL,
  `religion` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `occupation` varchar(100) NOT NULL,
  `father_fullname` varchar(100) NOT NULL,
  `mother_fullname` varchar(100) NOT NULL,
  `contact_no` varchar(100) NOT NULL,
  `grade_level` varchar(100) NOT NULL,
  `category_of_learner` varchar(100) NOT NULL,
  `date_mapped` varchar(100) NOT NULL,
  `interested_in_als` varchar(100) NOT NULL,
  `preferred_program` varchar(100) NOT NULL,
  `date_attendance` varchar(100) NOT NULL,
  `lrn` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `category` varchar(200) DEFAULT NULL,
  `member_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `token` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `fullname`, `username`, `password`, `token`) VALUES
('ADMIN-001', 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'su9do4ne1za0bu5ho8se5ha6gu7zo6be5');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_learners`
--
ALTER TABLE `tbl_learners`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `tbl_logs`
--
ALTER TABLE `tbl_logs`
  ADD PRIMARY KEY (`logs_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_logs`
--
ALTER TABLE `tbl_logs`
  MODIFY `logs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=533;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
