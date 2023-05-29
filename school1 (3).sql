-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2022 at 03:52 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school1`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_year`
--

CREATE TABLE `academic_year` (
  `id` int(11) NOT NULL,
  `sname` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `academic_year`
--

INSERT INTO `academic_year` (`id`, `sname`) VALUES
(29, '2020/2021'),
(30, '2021/2022'),
(31, '2022/2023'),
(32, '2023/2024');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `passwords` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `email`, `passwords`) VALUES
('victor', 'victor@gmail.com', 'gambino');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `class_id` int(11) NOT NULL,
  `class_name` varchar(255) NOT NULL,
  `session_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`class_id`, `class_name`, `session_id`) VALUES
(8, 'form1 2020', 29),
(11, 'form two 2020', 29),
(13, 'form three 2020', 29),
(14, 'form one', 31),
(15, 'form two', 31),
(16, 'form two', 31),
(17, 'form two', 31),
(18, 'Form three 2021', 30),
(19, 'Form one 2021', 30),
(20, 'Form Two 2021', 30),
(21, 'Form Four 2021', 30),
(22, 'form four 2023', 32),
(23, 'form three', 32);

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `exam_id` int(11) NOT NULL,
  `exam_name` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `class` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`exam_id`, `exam_name`, `year`, `class`) VALUES
(2, 'End-Term one', 29, 8),
(3, 'End-term one ', 29, 11),
(4, 'End term two', 29, 11),
(5, 'End term Three', 29, 11),
(6, 'end term three', 31, 14),
(7, 'end term one', 29, 13),
(8, 'End Term One', 30, 18),
(9, 'end term one', 32, 22),
(10, 'End term one', 32, 23);

-- --------------------------------------------------------

--
-- Stand-in structure for view `examview`
-- (See below for the actual view)
--
CREATE TABLE `examview` (
`regno` varchar(50)
,`exam_name` varchar(255)
,`exam_id` int(11)
,`class` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `final`
-- (See below for the actual view)
--
CREATE TABLE `final` (
`subject_id` int(11)
,`class_id` int(11)
,`student_id` int(11)
,`subject_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `finalmarks`
-- (See below for the actual view)
--
CREATE TABLE `finalmarks` (
`marks` int(10)
,`id` int(11)
,`s_name` varchar(50)
,`regno` varchar(50)
,`class` int(11)
,`exam_id` int(11)
,`exam_name` varchar(255)
,`subject_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `mark`
--

CREATE TABLE `mark` (
  `id` int(10) NOT NULL,
  `mark` int(20) NOT NULL,
  `subject` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mark`
--

INSERT INTO `mark` (`id`, `mark`, `subject`) VALUES
(19, 48, 8),
(20, 67, 11);

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `marks_id` int(10) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `regno` varchar(50) NOT NULL,
  `student_id` int(11) NOT NULL,
  `subject_id` int(10) NOT NULL,
  `exam` int(11) NOT NULL,
  `marks` int(10) NOT NULL,
  `comment` varchar(1000) NOT NULL DEFAULT 'No comment'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `marks`
--

INSERT INTO `marks` (`marks_id`, `student_name`, `regno`, `student_id`, `subject_id`, `exam`, `marks`, `comment`) VALUES
(196, '', '', 10, 773, 2, 50, 'No comment'),
(197, '', '', 10, 774, 2, 70, 'No comment'),
(198, '', '', 10, 775, 2, 90, 'No comment'),
(199, '', '', 11, 773, 2, 20, 'No comment'),
(200, '', '', 13, 776, 3, 60, 'No comment'),
(201, '', '', 13, 777, 3, 70, 'No comment'),
(202, '', '', 13, 778, 3, 80, 'No comment'),
(203, '', '', 14, 776, 3, 70, 'No comment'),
(204, '', '', 14, 777, 3, 60, 'No comment'),
(205, '', '', 14, 778, 3, 90, 'No comment'),
(206, '', '', 16, 773, 2, 70, 'No comment'),
(207, '', '', 16, 774, 2, 20, 'No comment'),
(208, '', '', 16, 775, 2, 40, 'No comment'),
(209, '', '', 32, 776, 3, 70, 'No comment'),
(210, '', '', 32, 777, 3, 90, 'No comment'),
(211, '', '', 32, 778, 3, 40, 'No comment'),
(212, '', '', 30, 776, 4, 70, 'No comment'),
(213, '', '', 30, 777, 4, 90, 'No comment'),
(214, '', '', 30, 778, 4, 20, 'No comment'),
(215, '', '', 32, 776, 4, 5, 'No comment'),
(216, '', '', 32, 777, 4, 3, 'No comment'),
(217, '', '', 32, 778, 4, 7, 'No comment'),
(218, '', '', 34, 781, 7, 70, 'No comment'),
(219, '', '', 34, 782, 7, 20, 'No comment'),
(220, '', '', 30, 776, 3, 45, 'No comment'),
(221, '', '', 33, 776, 3, 80, 'No comment'),
(222, '', '', 33, 777, 3, 35, 'No comment'),
(223, '', '', 33, 778, 3, 56, 'No comment'),
(224, '', '', 33, 784, 8, 80, 'No comment'),
(225, '', '', 33, 785, 8, 70, 'No comment'),
(226, '', '', 33, 786, 8, 80, 'No comment'),
(227, '', '', 35, 784, 8, 80, 'No comment'),
(228, '', '', 35, 785, 8, 90, 'No comment'),
(229, '', '', 35, 786, 8, 40, 'No comment'),
(233, '', '', 36, 784, 8, 70, 'No comment'),
(234, '', '', 36, 785, 8, 45, 'No comment'),
(235, '', '', 36, 786, 8, 90, 'No comment'),
(239, 'kelvin nyerere', 'bbit-004', 35, 787, 9, 90, 'No comment'),
(240, 'kelvin nyerere', 'bbit-004', 35, 788, 9, 45, 'No comment'),
(241, 'ernest kariuki', 'bbit-005', 36, 787, 9, 35, 'No comment'),
(242, 'ernest kariuki', 'bbit-005', 36, 788, 9, 89, 'No comment'),
(243, 'kelvin nyerere', 'bbit-004', 35, 789, 10, 56, 'No comment'),
(244, 'kelvin nyerere', 'bbit-004', 35, 790, 10, 90, 'No comment'),
(245, 'Ann Nkirote', 'bbit-006', 37, 789, 10, 90, 'Good improvements nkirote, keep up.'),
(246, 'Ann Nkirote', 'bbit-006', 37, 790, 10, 60, 'Good improvements nkirote, keep up.');

-- --------------------------------------------------------

--
-- Stand-in structure for view `markssview`
-- (See below for the actual view)
--
CREATE TABLE `markssview` (
`s_name` varchar(50)
,`regno` varchar(50)
,`class` int(11)
,`subject_name` varchar(255)
,`exam_name` varchar(255)
,`marks` int(10)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `marksview`
-- (See below for the actual view)
--
CREATE TABLE `marksview` (
`id` int(11)
,`regno` varchar(50)
,`s_name` varchar(50)
,`exam_id` int(11)
,`exam_name` varchar(255)
,`class` int(11)
,`marks` int(10)
);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `details` text NOT NULL,
  `img` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `details`, `img`) VALUES
(63, 'victor', 'the most typical virgo ik.the most typical virgo ik.the most typical virgo ik.the most typical virgo ik.the most typical virgo ik.the most typical virgo ik.', 'download.jfif'),
(64, 'the quick brown fox.', 'the quick brown fox jumped over the lazy dog.the quick brown fox jumped over the lazy dog.the quick brown fox jumped over the lazy dog.the quick brown fox jumped over the lazy dog.the quick brown fox jumped over the lazy dog.the quick brown fox jumped over the lazy dog.the quick brown fox jumped over the lazy dog.the quick brown fox jumped over the lazy dog.the quick brown fox jumped over the lazy dog.the quick brown fox jumped over the lazy dog.the quick brown fox jumped over the lazy dog.', 'gettyimages.jpg'),
(65, 'ANNUAL GENERAL MEETING', 'The quick brown fox jumped over the lazy dog.The quick brown fox jumped over the lazy dog.The quick brown fox jumped over the lazy dog.The quick brown fox jumped over the lazy dog.The quick brown fox jumped over the lazy dog.The quick brown fox jumped over the lazy dog.The quick brown fox jumped over the lazy dog.The quick brown fox jumped over the lazy dog.The quick brown fox jumped over the lazy dog.The quick brown fox jumped over the lazy dog.The quick brown fox jumped over the lazy dog.The quick brown fox jumped over the lazy dog.The quick brown fox jumped over the lazy dog.The quick brown fox jumped over the lazy dog.', 'coach-and-parent-meeting.jpg'),
(66, 'rshhz', 'gasegs', 'person-holds-a-hand-out-and-gets-someone-to-hold-it.jpg'),
(67, 'ANNUAL GENERAL MEETING', 'the quick brown fox jumped over the lazy dog.the quick brown fox jumped over the lazy dog.the quick brown fox jumped over the lazy dog.the quick brown fox jumped over the lazy dog.the quick brown fox jumped over the lazy dog.the quick brown fox jumped over the lazy dog.', 'Untitled (3).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `result_id` int(10) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `regno` varchar(50) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `class_id` int(10) NOT NULL,
  `student_id` int(11) NOT NULL,
  `result percentage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`result_id`, `student_name`, `regno`, `exam_id`, `class_id`, `student_id`, `result percentage`) VALUES
(54, '', '', 2, 8, 10, 50),
(55, '', '', 2, 8, 10, 120),
(56, '', '', 2, 8, 10, 210),
(57, '', '', 2, 8, 11, 20),
(58, '', '', 3, 11, 13, 60),
(59, '', '', 3, 11, 13, 130),
(60, '', '', 3, 11, 13, 210),
(61, '', '', 3, 11, 14, 70),
(62, '', '', 3, 11, 14, 130),
(63, '', '', 3, 11, 14, 220),
(64, '', '', 2, 8, 16, 70),
(65, '', '', 2, 8, 16, 90),
(66, '', '', 2, 8, 16, 130),
(67, '', '', 3, 11, 32, 70),
(68, '', '', 3, 11, 32, 160),
(69, '', '', 3, 11, 32, 200),
(70, '', '', 4, 11, 30, 70),
(71, '', '', 4, 11, 30, 160),
(72, '', '', 4, 11, 30, 180),
(73, '', '', 4, 11, 32, 5),
(74, '', '', 4, 11, 32, 8),
(75, '', '', 4, 11, 32, 15),
(76, '', '', 7, 13, 34, 70),
(77, '', '', 7, 13, 34, 90),
(78, '', '', 3, 11, 30, 45),
(79, '', '', 3, 11, 33, 80),
(80, '', '', 3, 11, 33, 115),
(81, '', '', 3, 11, 33, 171),
(82, '', '', 8, 18, 33, 80),
(83, '', '', 8, 18, 33, 150),
(84, '', '', 8, 18, 33, 230),
(85, '', '', 8, 18, 35, 80),
(86, '', '', 8, 18, 35, 170),
(87, '', '', 8, 18, 35, 210),
(91, '', '', 8, 18, 36, 70),
(92, '', '', 8, 18, 36, 115),
(93, '', '', 8, 18, 36, 205),
(94, '', '', 9, 22, 35, 70),
(95, 'kelvin nyerere', 'bbit-004', 9, 22, 35, 90),
(96, 'kelvin nyerere', 'bbit-004', 9, 22, 35, 135),
(97, 'kelvin nyerere', 'bbit-004', 9, 22, 35, 90),
(98, 'kelvin nyerere', 'bbit-004', 9, 22, 35, 135),
(99, 'ernest kariuki', 'bbit-005', 9, 22, 36, 35),
(100, 'ernest kariuki', 'bbit-005', 9, 22, 36, 124),
(101, 'kelvin nyerere', 'bbit-004', 10, 23, 35, 56),
(102, 'kelvin nyerere', 'bbit-004', 10, 23, 35, 146),
(103, 'Ann Nkirote', 'bbit-006', 10, 23, 37, 90),
(104, 'Ann Nkirote', 'bbit-006', 10, 23, 37, 150);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `s_name` varchar(50) NOT NULL,
  `dob` varchar(20) NOT NULL,
  `regno` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `class` int(11) NOT NULL,
  `session_id` int(10) NOT NULL,
  `parent_name` varchar(255) NOT NULL,
  `pno` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `p_password` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `s_name`, `dob`, `regno`, `password`, `class`, `session_id`, `parent_name`, `pno`, `email`, `p_password`, `photo`, `year`) VALUES
(30, 'linet mu', '5/5/1999', 'bscit-01-0003/2020', 'victor', 11, 29, 'Alice Muthomi', '0728158753', 'alice@gmail.com', 'victor', '', 29),
(31, 'linet muthomi', '5/5/1997', 'bscit-01-004/2020', 'linet', 11, 29, 'Alice Muthomi', '0728158753', 'alice@gmail.com', 'linet', 'HD 4K WallPaper Landscape Desktop Backgrounds.jpg', 29),
(32, 'kelvin mutuma', '25/08/2020', 'bbit-01', 'kelvin', 18, 29, 'silas muthomi', '2356874532', 'silas@gmail.com', 'kelvin', 'pexels-luis-del-río-15286.jpg', 30),
(33, 'oliver asenji', '25/07/1995', 'bbit-02', 'asenji', 18, 29, 'senje ', '31231221', 'senje@gmail.com', 'asenji', 'pexels-maxime-francis-2246476.jpg', 30),
(34, 'oliver asenji', '25/07/1995', 'bbit-03', 'asenji', 13, 29, 'senje ', '31231221', 'senje@gmail.com', 'asenji', 'Untitled (4).jpg', 2003),
(35, 'kelvin nyerere', '25/08/2000', 'bbit-004', 'kelvin', 23, 30, 'nyerere', '0740843795', 'nyerere@gmail.com', 'kelvin', 'HD 4K WallPaper Landscape Desktop Backgrounds.jpg', 32),
(36, 'ernest kariuki', '25/08/2000', 'bbit-005', 'ernest', 22, 30, 'kariuki', '0740843795', 'kariuki@gmail.com', 'ernest', 'Untitled (4).jpg', 32),
(37, 'Ann Nkirote', '25/08/1993', 'bbit-006', 'nkirote', 23, 32, 'silas muthomi', '0740843795', 'silas@gmail.com', 'nkirote', 'pexels-luis-del-río-15286.jpg', 2023);

-- --------------------------------------------------------

--
-- Stand-in structure for view `student_exam`
-- (See below for the actual view)
--
CREATE TABLE `student_exam` (
`exam_id` int(11)
,`class` int(11)
,`s_name` varchar(50)
,`id` int(11)
,`regno` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `subject_name` varchar(255) NOT NULL,
  `class` int(11) NOT NULL,
  `subject_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `subject_name`, `class`, `subject_code`) VALUES
(772, 'math', 5, 'math_f2'),
(773, 'mathematics', 8, 'math 101'),
(774, 'kiswahili', 8, 'kiswa 101'),
(775, 'English', 8, 'Eng 101'),
(776, 'kiswahili f2', 11, 'kiswf2'),
(777, 'mathematics f2', 11, 'mathf2'),
(778, 'chemistry f2', 11, 'chemf2'),
(779, '', 13, ''),
(780, '', 13, ''),
(781, 'eng f3', 13, 'engf3'),
(782, 'kiswahili f3', 13, 'kf3'),
(783, 'py form one', 14, 'py01'),
(784, 'Kishwahili F3', 18, 'k-f3-2021'),
(785, 'Mathematics f3', 18, 'm-f3-2021'),
(786, 'English F3', 18, 'e-f3-2021'),
(787, 'mathematics f4', 22, 'math-f4-23'),
(788, 'English F4', 22, 'E-f4-23'),
(789, 'Mathematics F3', 23, 'm-f3-23'),
(790, 'English F3', 23, 'e-f3-23');

-- --------------------------------------------------------

--
-- Table structure for table `subjectandstudent`
--

CREATE TABLE `subjectandstudent` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjectandstudent`
--

INSERT INTO `subjectandstudent` (`id`, `subject_id`, `class_id`, `student_id`) VALUES
(26, 773, 8, 10),
(27, 774, 8, 10),
(28, 775, 8, 10),
(29, 773, 8, 11),
(30, 774, 8, 11),
(31, 775, 8, 11),
(32, 776, 11, 13),
(33, 777, 11, 13),
(34, 778, 11, 13),
(35, 776, 11, 14),
(36, 777, 11, 14),
(37, 778, 11, 14),
(38, 773, 8, 16),
(39, 774, 8, 16),
(40, 775, 8, 16),
(41, 781, 13, 17),
(42, 782, 13, 17),
(43, 776, 11, 23),
(44, 777, 11, 23),
(45, 778, 11, 23),
(46, 776, 11, 29),
(47, 777, 11, 29),
(48, 778, 11, 29),
(49, 776, 11, 30),
(50, 777, 11, 30),
(51, 778, 11, 30),
(52, 776, 11, 32),
(53, 777, 11, 32),
(54, 778, 11, 32),
(55, 781, 13, 34),
(56, 782, 13, 34),
(57, 776, 11, 33),
(58, 777, 11, 33),
(59, 778, 11, 33),
(60, 784, 18, 33),
(61, 785, 18, 33),
(62, 786, 18, 33),
(63, 784, 18, 32),
(64, 785, 18, 32),
(65, 786, 18, 32),
(66, 784, 18, 35),
(67, 785, 18, 35),
(68, 786, 18, 35),
(69, 784, 18, 36),
(70, 785, 18, 36),
(71, 786, 18, 36),
(73, 787, 22, 35),
(74, 788, 22, 35),
(75, 787, 22, 36),
(76, 788, 22, 36),
(77, 789, 23, 35),
(78, 790, 23, 35),
(79, 789, 23, 37),
(80, 790, 23, 37);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `username`, `email`, `password`) VALUES
(1, '', '', ''),
(2, 'frank cheruiyot', 'frank@gmail.com', '12345'),
(3, 'lydia mosbey', 'lydia@gmail.com', '1234'),
(4, 'Alice gitau', 'alice@gmail.com', 'alice'),
(5, 'linet mukiri', 'linet@gmail.com', 'linet'),
(6, 'ian Adeya', 'adeya@gmail.com', 'adeya');

-- --------------------------------------------------------

--
-- Table structure for table `term`
--

CREATE TABLE `term` (
  `term_id` int(11) NOT NULL,
  `term_name` text NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `term`
--

INSERT INTO `term` (`term_id`, `term_name`, `year`) VALUES
(2, 'ii', 1),
(3, 'i', 1),
(4, 'i', 1),
(5, 'i', 1),
(6, 'ii', 1),
(0, 'i', 29);

-- --------------------------------------------------------

--
-- Structure for view `examview`
--
DROP TABLE IF EXISTS `examview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `examview`  AS SELECT `student`.`regno` AS `regno`, `exam`.`exam_name` AS `exam_name`, `exam`.`exam_id` AS `exam_id`, `exam`.`class` AS `class` FROM (`student` join `exam`) WHERE `student`.`class` = `exam`.`class` ;

-- --------------------------------------------------------

--
-- Structure for view `final`
--
DROP TABLE IF EXISTS `final`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `final`  AS SELECT `subjectandstudent`.`subject_id` AS `subject_id`, `subjectandstudent`.`class_id` AS `class_id`, `subjectandstudent`.`student_id` AS `student_id`, `subject`.`subject_name` AS `subject_name` FROM (`subjectandstudent` join `subject`) WHERE `subjectandstudent`.`subject_id` = `subject`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `finalmarks`
--
DROP TABLE IF EXISTS `finalmarks`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `finalmarks`  AS SELECT `marks`.`marks` AS `marks`, `student`.`id` AS `id`, `student`.`s_name` AS `s_name`, `student`.`regno` AS `regno`, `exam`.`class` AS `class`, `exam`.`exam_id` AS `exam_id`, `exam`.`exam_name` AS `exam_name`, `subject`.`subject_name` AS `subject_name` FROM (((`marks` join `student`) join `exam`) join `subject`) WHERE `marks`.`marks_id` = `marks`.`marks_id` AND `subject`.`id` = `marks`.`subject_id` AND `exam`.`exam_id` = `marks`.`exam` AND `student`.`id` = `marks`.`student_id` ;

-- --------------------------------------------------------

--
-- Structure for view `markssview`
--
DROP TABLE IF EXISTS `markssview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `markssview`  AS SELECT `student`.`s_name` AS `s_name`, `student`.`regno` AS `regno`, `student`.`class` AS `class`, `subject`.`subject_name` AS `subject_name`, `exam`.`exam_name` AS `exam_name`, `marks`.`marks` AS `marks` FROM (((`student` join `subject`) join `exam`) join `marks`) WHERE `student`.`id` = `marks`.`student_id` AND `subject`.`id` = `marks`.`subject_id` AND `exam`.`exam_id` = `marks`.`exam` ;

-- --------------------------------------------------------

--
-- Structure for view `marksview`
--
DROP TABLE IF EXISTS `marksview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `marksview`  AS SELECT `student`.`id` AS `id`, `student`.`regno` AS `regno`, `student`.`s_name` AS `s_name`, `exam`.`exam_id` AS `exam_id`, `exam`.`exam_name` AS `exam_name`, `exam`.`class` AS `class`, `marks`.`marks` AS `marks` FROM ((`marks` join `student`) join `exam`) WHERE `marks`.`marks_id` = `marks`.`marks_id` AND `student`.`id` = `marks`.`student_id` AND `exam`.`exam_id` = `marks`.`exam` ;

-- --------------------------------------------------------

--
-- Structure for view `student_exam`
--
DROP TABLE IF EXISTS `student_exam`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `student_exam`  AS SELECT `exam`.`exam_id` AS `exam_id`, `exam`.`class` AS `class`, `student`.`s_name` AS `s_name`, `student`.`id` AS `id`, `student`.`regno` AS `regno` FROM (`exam` join `student`) WHERE `exam`.`class` = `student`.`class` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_year`
--
ALTER TABLE `academic_year`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`exam_id`);

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`marks_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`result_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjectandstudent`
--
ALTER TABLE `subjectandstudent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_year`
--
ALTER TABLE `academic_year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `exam_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `marks`
--
ALTER TABLE `marks`
  MODIFY `marks_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `result_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=791;

--
-- AUTO_INCREMENT for table `subjectandstudent`
--
ALTER TABLE `subjectandstudent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
