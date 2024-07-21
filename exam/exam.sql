-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2022 at 05:41 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exam`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `id` int(100) NOT NULL,
  `qid` varchar(100) NOT NULL,
  `ansid` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`id`, `qid`, `ansid`) VALUES
(41, 'Q-61e93f71dfc9c', 'OP-61e93f71e076f'),
(42, 'Q-61e93f71e37a7', 'OP-61e93f71e4187'),
(43, 'Q-61e93f71e6dce', 'OP-61e93f71e7772'),
(44, 'Q-61e93f71ea5b2', 'OP-61e93f71eade8'),
(45, 'Q-61e93f71ee1dc', 'OP-61e93f71eeb1f');

-- --------------------------------------------------------

--
-- Table structure for table `class_years`
--

CREATE TABLE `class_years` (
  `id` int(10) NOT NULL,
  `year_id` varchar(250) NOT NULL,
  `year_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `class_years`
--

INSERT INTO `class_years` (`id`, `year_id`, `year_name`) VALUES
(13, 'Y-61e506d677dd1', 'First Year');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(10) NOT NULL,
  `dept_id` varchar(250) NOT NULL,
  `dept_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `dept_id`, `dept_name`) VALUES
(27, 'D-61e93cd7655c9', 'Computer Science and Engineering '),
(30, 'D-61ee9ce44ffa4', 'Textile technology Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` int(10) NOT NULL,
  `div_id` varchar(100) NOT NULL,
  `div_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `div_id`, `div_name`) VALUES
(14, 'DIV-61e506e62d3a5', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `grp_member`
--

CREATE TABLE `grp_member` (
  `id` int(10) NOT NULL,
  `grp_id` varchar(100) NOT NULL,
  `student_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `grp_member`
--

INSERT INTO `grp_member` (`id`, `grp_id`, `student_id`) VALUES
(11, 'GRP-61e2efe4c2bca', 'STD61e2efbbd8449'),
(26, 'GRP-61e93f9444688', 'STD61e93e34db6bb'),
(27, 'GRP-61e93f9444688', 'STD61ea95c54f3af');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `eid` varchar(100) NOT NULL,
  `score` float NOT NULL,
  `level` float NOT NULL,
  `correct` float NOT NULL,
  `wrong` float NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `timestamp` bigint(50) NOT NULL,
  `status` varchar(40) NOT NULL,
  `score_updated` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `institute_admin`
--

CREATE TABLE `institute_admin` (
  `id` int(10) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `type` varchar(15) NOT NULL DEFAULT 'regular',
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `institute_admin`
--

INSERT INTO `institute_admin` (`id`, `fname`, `lname`, `email`, `type`, `password`) VALUES
(1, 'Super', 'Admin', 'institutelogin@institute.com', 'super', 'cc2de1ffacacc335a101a2675b26882a');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(10) NOT NULL,
  `qid` varchar(100) NOT NULL,
  `options` varchar(5000) NOT NULL,
  `optionid` varchar(100) NOT NULL,
  `opno` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `qid`, `options`, `optionid`, `opno`) VALUES
(161, 'Q-61e93f71dfc9c', 'Lorem Ipsum', 'OP-61e93f71e0763', '1'),
(162, 'Q-61e93f71dfc9c', 'Lorem Ipsum', 'OP-61e93f71e076b', '2'),
(163, 'Q-61e93f71dfc9c', 'Lorem Ipsum', 'OP-61e93f71e076d', '3'),
(164, 'Q-61e93f71dfc9c', 'Lorem Ipsum', 'OP-61e93f71e076f', '4'),
(165, 'Q-61e93f71e37a7', 'Lorem Ipsum', 'OP-61e93f71e417e', '1'),
(166, 'Q-61e93f71e37a7', 'Lorem Ipsum', 'OP-61e93f71e4186', '2'),
(167, 'Q-61e93f71e37a7', 'Lorem Ipsum', 'OP-61e93f71e4187', '3'),
(168, 'Q-61e93f71e37a7', 'Lorem Ipsum', 'OP-61e93f71e4188', '4'),
(169, 'Q-61e93f71e6dce', 'Lorem Ipsum', 'OP-61e93f71e7769', '1'),
(170, 'Q-61e93f71e6dce', 'Lorem Ipsum', 'OP-61e93f71e7771', '2'),
(171, 'Q-61e93f71e6dce', 'Lorem Ipsum', 'OP-61e93f71e7772', '3'),
(172, 'Q-61e93f71e6dce', 'Lorem Ipsum', 'OP-61e93f71e7774', '4'),
(173, 'Q-61e93f71ea5b2', 'Lorem Ipsum', 'OP-61e93f71eade3', '1'),
(174, 'Q-61e93f71ea5b2', 'Lorem Ipsum', 'OP-61e93f71eade8', '2'),
(175, 'Q-61e93f71ea5b2', 'Lorem Ipsum', 'OP-61e93f71eade9', '3'),
(176, 'Q-61e93f71ea5b2', 'Lorem Ipsum', 'OP-61e93f71eadea', '4'),
(177, 'Q-61e93f71ee1dc', 'Lorem Ipsum', 'OP-61e93f71eeb1f', '1'),
(178, 'Q-61e93f71ee1dc', 'Lorem Ipsum', 'OP-61e93f71eeb24', '2'),
(179, 'Q-61e93f71ee1dc', 'Lorem Ipsum', 'OP-61e93f71eeb25', '3'),
(180, 'Q-61e93f71ee1dc', 'Lorem Ipsum', 'OP-61e93f71eeb26', '4');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(10) NOT NULL,
  `eid` varchar(100) NOT NULL,
  `qid` varchar(100) NOT NULL,
  `qns` text NOT NULL,
  `choice` int(10) NOT NULL,
  `sn` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `eid`, `qid`, `qns`, `choice`, `sn`) VALUES
(41, 'T61e93eb43c25d', 'Q-61e93f71dfc9c', '<p><strong>Rewrite the following statements by selecting the correct option:&nbsp;</strong></p>\r\n<p style=\"padding-left: 40px;\">1)A......... converges the rays of light falling on it.</p>\r\n<p style=\"padding-left: 40px;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; (a) concave mirror (c) plane mirror b) convex mirror</p>\r\n<p style=\"padding-left: 40px;\">2) Mirror used by a dental surgeon is.....</p>\r\n<p style=\"padding-left: 40px;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;(a) plane &nbsp;(b) convex (e) concave &nbsp; &nbsp;(d) convex and concave</p>', 4, 1),
(42, 'T61e93eb43c25d', 'Q-61e93f71e37a7', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took</p>', 4, 2),
(43, 'T61e93eb43c25d', 'Q-61e93f71e6dce', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took</p>', 4, 3),
(44, 'T61e93eb43c25d', 'Q-61e93f71ea5b2', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took</p>', 4, 4),
(45, 'T61e93eb43c25d', 'Q-61e93f71ee1dc', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took</p>', 4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `id` int(10) NOT NULL,
  `sem_id` varchar(100) NOT NULL,
  `sem_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`id`, `sem_id`, `sem_name`) VALUES
(29, 'S-61e93cea039b6', 'Semester 1');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(10) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `mname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dob` varchar(100) NOT NULL,
  `dept_id` varchar(100) NOT NULL,
  `year_id` varchar(100) NOT NULL,
  `sem_id` varchar(100) NOT NULL,
  `exam_num` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `student_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `fname`, `mname`, `lname`, `email`, `dob`, `dept_id`, `year_id`, `sem_id`, `exam_num`, `password`, `student_id`) VALUES
(16, ' Akash', 'Balaso', 'Patil', 'imakash@gmail.com', '2022-01-20', 'D-61e93cd7655c9', 'Y-61e506d677dd1', 'S-61e93cea039b6', '19UCS094', 'ed3f7b5be4991da2dca15b98ae9c9bd5', 'STD61e93e34db6bb'),
(17, 'Pruthvi', 'Mahavir', 'patil', 'pruthvi@gmail.com', '2022-01-21', 'D-61e93cd7655c9', 'Y-61e506d677dd1', 'S-61e93cea039b6', '19UCS097', 'ec6a6536ca304edf844d1d248a4f08dc', 'STD61ea95c54f3af');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(10) NOT NULL,
  `subject_id` varchar(100) NOT NULL,
  `dept_id` varchar(100) NOT NULL,
  `year_id` varchar(100) NOT NULL,
  `sem_id` varchar(100) NOT NULL,
  `subject_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_id`, `dept_id`, `year_id`, `sem_id`, `subject_name`) VALUES
(21, 'SUB-61e93cf995ef5', 'D-61e93cd7655c9', 'Y-61e506d677dd1', 'S-61e93cea039b6', 'Engineering Maths 1'),
(23, 'SUB-61eab0b2d03f2', 'D-61e93cd7655c9', 'Y-61e506d677dd1', 'S-61e93cea039b6', 'Engineering Chemistry'),
(24, 'SUB-61eab0b99e253', 'D-61e93cd7655c9', 'Y-61e506d677dd1', 'S-61e93cea039b6', 'Engineering Graphics'),
(25, 'SUB-61eab0c8db918', 'D-61e93cd7655c9', 'Y-61e506d677dd1', 'S-61e93cea039b6', 'Engineering Physics'),
(26, 'SUB-61eab0d090508', 'D-61e93cd7655c9', 'Y-61e506d677dd1', 'S-61e93cea039b6', 'Engineering Mechanics'),
(27, 'SUB-61eab0fb6b84d', 'D-61e93cd7655c9', 'Y-61e506d677dd1', 'S-61e93cea039b6', 'Fundamental of programming'),
(28, 'SUB-61ee9cf9f3d19', 'D-61ee9ce44ffa4', 'Y-61e506d677dd1', 'S-61e93cea039b6', 'YYM');

-- --------------------------------------------------------

--
-- Table structure for table `testdetails`
--

CREATE TABLE `testdetails` (
  `id` int(10) NOT NULL,
  `eid` varchar(100) NOT NULL,
  `dept_id` varchar(100) NOT NULL,
  `year_id` varchar(100) NOT NULL,
  `sem_id` varchar(100) NOT NULL,
  `subject_id` varchar(100) NOT NULL,
  `title` varchar(500) NOT NULL,
  `correct` varchar(100) NOT NULL,
  `wrong` varchar(100) NOT NULL,
  `total` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL,
  `date` varchar(250) NOT NULL,
  `status` varchar(50) NOT NULL,
  `subjective` varchar(4) NOT NULL,
  `submark` varchar(4) NOT NULL,
  `grp_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `testdetails`
--

INSERT INTO `testdetails` (`id`, `eid`, `dept_id`, `year_id`, `sem_id`, `subject_id`, `title`, `correct`, `wrong`, `total`, `time`, `date`, `status`, `subjective`, `submark`, `grp_id`) VALUES
(24, 'T61e93eb43c25d', 'D-61e93cd7655c9', 'Y-61e506d677dd1', 'S-61e93cea039b6', 'SUB-61e93cf995ef5', 'Demo', '1', '0', '5', '3', '20-01-2022 16:21:32', 'disabled', '', '', 'GRP-61e93f9444688');

-- --------------------------------------------------------

--
-- Table structure for table `test_groups`
--

CREATE TABLE `test_groups` (
  `id` int(10) NOT NULL,
  `grp_id` varchar(100) NOT NULL,
  `grp_name` varchar(250) NOT NULL,
  `dept_id` varchar(100) NOT NULL,
  `year_id` varchar(100) NOT NULL,
  `sem_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `test_groups`
--

INSERT INTO `test_groups` (`id`, `grp_id`, `grp_name`, `dept_id`, `year_id`, `sem_id`) VALUES
(12, 'GRP-61e93f9444688', 'G1', 'D-61e93cd7655c9', 'Y-61e506d677dd1', 'S-61e93cea039b6'),
(13, 'GRP-61eb1c2b3119e', 'G2', 'D-61e93cd7655c9', 'Y-61e506d677dd1', 'S-61e93cea039b6'),
(14, 'GRP-61eb1c2eb07db', 'G3', 'D-61e93cd7655c9', 'Y-61e506d677dd1', 'S-61e93cea039b6'),
(15, 'GRP-61eb1c326ea7b', 'G4', 'D-61e93cd7655c9', 'Y-61e506d677dd1', 'S-61e93cea039b6'),
(16, 'GRP-61eb1c35ec071', 'G5', 'D-61e93cd7655c9', 'Y-61e506d677dd1', 'S-61e93cea039b6'),
(17, 'GRP-61eb1c39dd4c2', 'G6', 'D-61e93cd7655c9', 'Y-61e506d677dd1', 'S-61e93cea039b6'),
(18, 'GRP-61eb1c64b393e', 'G7', 'D-61e93cd7655c9', 'Y-61e506d677dd1', 'S-61e93cea039b6'),
(19, 'GRP-61eb1c6841f98', 'G8', 'D-61e93cd7655c9', 'Y-61e506d677dd1', 'S-61e93cea039b6'),
(20, 'GRP-61eb1c6c2ad2a', 'G9', 'D-61e93cd7655c9', 'Y-61e506d677dd1', 'S-61e93cea039b6'),
(21, 'GRP-61ee9d30a63bd', 'V1', 'D-61e93cd7655c9', 'Y-61e506d677dd1', 'S-61e93cea039b6');

-- --------------------------------------------------------

--
-- Table structure for table `user_answer`
--

CREATE TABLE `user_answer` (
  `id` int(100) NOT NULL,
  `qid` varchar(100) NOT NULL,
  `ans` varchar(100) NOT NULL,
  `correctans` varchar(100) NOT NULL,
  `eid` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `user_answer`
--

INSERT INTO `user_answer` (`id`, `qid`, `ans`, `correctans`, `eid`, `username`, `status`) VALUES
(46, 'Q-61e93f71dfc9c', 'OP-61e93f71e0763', 'OP-61e93f71e076f', 'T61e93eb43c25d', 'STD61e93e34db6bb', 0),
(47, 'Q-61e93f71e37a7', 'OP-61e93f71e4187', 'OP-61e93f71e4187', 'T61e93eb43c25d', 'STD61e93e34db6bb', 0),
(48, 'Q-61e93f71e6dce', 'OP-61e93f71e7772', 'OP-61e93f71e7772', 'T61e93eb43c25d', 'STD61e93e34db6bb', 0),
(49, 'Q-61e93f71ea5b2', 'OP-61e93f71eade9', 'OP-61e93f71eade8', 'T61e93eb43c25d', 'STD61e93e34db6bb', 0),
(50, 'Q-61e93f71ee1dc', 'OP-61e93f71eeb1f', 'OP-61e93f71eeb1f', 'T61e93eb43c25d', 'STD61e93e34db6bb', 0),
(51, 'Q-61e93f71dfc9c', 'OP-61e93f71e076b', 'OP-61e93f71e076f', 'T61e93eb43c25d', 'STD61ea95c54f3af', 0),
(52, 'Q-61e93f71e37a7', 'OP-61e93f71e4186', 'OP-61e93f71e4187', 'T61e93eb43c25d', 'STD61ea95c54f3af', 0),
(53, 'Q-61e93f71e6dce', '', 'OP-61e93f71e7772', 'T61e93eb43c25d', 'STD61ea95c54f3af', 2),
(54, 'Q-61e93f71ea5b2', '', 'OP-61e93f71eade8', 'T61e93eb43c25d', 'STD61ea95c54f3af', 2),
(55, 'Q-61e93f71ee1dc', '', 'OP-61e93f71eeb1f', 'T61e93eb43c25d', 'STD61ea95c54f3af', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_years`
--
ALTER TABLE `class_years`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grp_member`
--
ALTER TABLE `grp_member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `institute_admin`
--
ALTER TABLE `institute_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testdetails`
--
ALTER TABLE `testdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_groups`
--
ALTER TABLE `test_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_answer`
--
ALTER TABLE `user_answer`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `class_years`
--
ALTER TABLE `class_years`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `grp_member`
--
ALTER TABLE `grp_member`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `institute_admin`
--
ALTER TABLE `institute_admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=193;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `testdetails`
--
ALTER TABLE `testdetails`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `test_groups`
--
ALTER TABLE `test_groups`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user_answer`
--
ALTER TABLE `user_answer`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
