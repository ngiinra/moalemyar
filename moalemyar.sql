-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2020 at 09:05 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moalemyar`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblbase`
--

CREATE TABLE `tblbase` (
  `base_id` int(11) NOT NULL,
  `base_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblbase`
--

INSERT INTO `tblbase` (`base_id`, `base_name`) VALUES
(1, 'دهم'),
(3, 'دوازدهم'),
(6, 'یازدهم');

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `cat_id` int(255) NOT NULL,
  `title` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `parent` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`cat_id`, `title`, `parent`) VALUES
(1, 'ورزشی', 0),
(2, 'اردوها', 0),
(4, 'والیبال', 1),
(5, 'آموزشی', 0),
(7, 'اردو به مشهد', 2),
(9, 'کنکوری', 5),
(18, 'اردو به شلمچه', 2),
(11, 'فوتبال', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblclass`
--

CREATE TABLE `tblclass` (
  `class_id` int(11) NOT NULL,
  `course_id` varchar(100) NOT NULL,
  `base_id` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblclass`
--

INSERT INTO `tblclass` (`class_id`, `course_id`, `base_id`) VALUES
(108, '1', '1'),
(109, '1', '6'),
(110, '1', '3'),
(111, '2', '1'),
(112, '2', '6'),
(113, '2', '3'),
(114, '3', '1'),
(115, '3', '6');

-- --------------------------------------------------------

--
-- Table structure for table `tblcourse`
--

CREATE TABLE `tblcourse` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblcourse`
--

INSERT INTO `tblcourse` (`course_id`, `course_name`) VALUES
(1, 'کامپیوتر'),
(2, 'برق صنعتی'),
(3, 'حسابداری');

-- --------------------------------------------------------

--
-- Table structure for table `tbldate`
--

CREATE TABLE `tbldate` (
  `date_id` int(11) NOT NULL,
  `exam_date` text NOT NULL,
  `exam_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblexam`
--

CREATE TABLE `tblexam` (
  `exam_id` int(11) NOT NULL,
  `exam_type` varchar(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblfile`
--

CREATE TABLE `tblfile` (
  `id` int(11) NOT NULL,
  `lesson_id` int(200) NOT NULL,
  `file_address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblfile`
--

INSERT INTO `tblfile` (`id`, `lesson_id`, `file_address`) VALUES
(1, 1, '13990321p122m5u231.pdf'),
(2, 1, '085-133-C451.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tbllesson`
--

CREATE TABLE `tbllesson` (
  `lesson_id` int(200) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `type` int(1) NOT NULL,
  `course_id` int(100) NOT NULL,
  `base_id` int(100) NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbllesson`
--

INSERT INTO `tbllesson` (`lesson_id`, `lname`, `type`, `course_id`, `base_id`, `teacher_id`) VALUES
(1, 'دین و زندگی 1', 0, 1, 1, 5),
(2, 'ادبیات', 0, 1, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tblnews`
--

CREATE TABLE `tblnews` (
  `id_news` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `accept` int(1) NOT NULL,
  `datee` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `title` varchar(1000) NOT NULL,
  `descript` text NOT NULL,
  `cat_id` int(11) NOT NULL,
  `pic` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblnews`
--

INSERT INTO `tblnews` (`id_news`, `user_id`, `accept`, `datee`, `title`, `descript`, `cat_id`, `pic`) VALUES
(1, 1, 0, '2020-02-04 23:42:27', 'اردوی دوازدهمی ها به مشهد', 'ما دوازدهمی ها را به مشهد بردیم', 18, ''),
(7, 1, 1, '2020-02-05 15:44:42', 'پخش', '                                    \r\n            از فردا شیر رایگان در مدارس کل کشور پخش خواهد شد و بچه ها میتوانند از ان استفاده کنند\r\nسهمیه هر دانش آموز 1 شیر میباشد.   \r\n                                    ', 9, 'cloud.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbloptions`
--

CREATE TABLE `tbloptions` (
  `op_id` int(255) NOT NULL,
  `title` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `pages` varchar(1000) NOT NULL,
  `op_icon` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbloptions`
--

INSERT INTO `tbloptions` (`op_id`, `title`, `pages`, `op_icon`) VALUES
(1, 'افزودن کاربر جدید', 'insertuser.php', 'users.png'),
(2, 'تائید و عدم تائید خبر', 'accept_news.php', 'yesornot.png'),
(3, 'افزودن دسته و زیر دسته', 'set.php', 'set.png'),
(6, 'افزودن دانش آموز', 'addstu.php', 'stu.png'),
(5, 'افزودن عکس اسلایدرها', 'slider.php', 'image.png'),
(7, 'افزودن خبر', 'addnews.php', 'note-and-pencil.png'),
(8, 'کلاس بندی ها', 'define_class.php', 'class-open-door.png'),
(9, 'افزودن همکار', 'addtea.php', 'teacher-pointing-blackboard.png'),
(10, 'افزودن نمره', 'addscore.php', 'scores.png'),
(11, 'تعریف امتیازات دانش آموزی', 'addstate.php', 'emtiazat.png'),
(12, 'افزودن درس', 'addlesson.php', 'lesson.png'),
(13, 'سطح دسترسی کاربران', 'user_ables.php', 'ables_black.png'),
(14, 'مشاهده نمرات', 'stuscore.php', 'score.png'),
(15, 'آیین نامه انظباطی', 'sturules.php', 'cap.png'),
(16, 'بانک سوالات', 'stuqueez.php', 'checklist.png'),
(19, 'افزودن فایل نمونه سوال', 'addfile.php', 'folder.png');

-- --------------------------------------------------------

--
-- Table structure for table `tblpanel`
--

CREATE TABLE `tblpanel` (
  `pan_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `op_id` int(11) NOT NULL,
  `show_id` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblpanel`
--

INSERT INTO `tblpanel` (`pan_id`, `user_id`, `op_id`, `show_id`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 1, 3, 1),
(4, 1, 6, 1),
(5, 1, 5, 0),
(6, 1, 7, 1),
(7, 1, 8, 1),
(8, 1, 9, 1),
(9, 13, 10, 1),
(10, 1, 12, 1),
(11, 1, 11, 1),
(12, 1, 13, 1),
(13, 15, 12, 0),
(14, 16, 14, 1),
(15, 16, 15, 1),
(16, 16, 16, 1),
(20, 18, 14, 1),
(21, 18, 15, 1),
(22, 18, 16, 1),
(34, 25, 19, 1),
(33, 25, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblscore`
--

CREATE TABLE `tblscore` (
  `score_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `student_score` float NOT NULL,
  `date_id` varchar(22) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblscore`
--

INSERT INTO `tblscore` (`score_id`, `lesson_id`, `student_id`, `student_score`, `date_id`) VALUES
(1, 2, 2, 20, '12');

-- --------------------------------------------------------

--
-- Table structure for table `tblslider`
--

CREATE TABLE `tblslider` (
  `slider_id` int(255) NOT NULL,
  `slider_name` varchar(1000) NOT NULL,
  `slider_text` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblslider`
--

INSERT INTO `tblslider` (`slider_id`, `slider_name`, `slider_text`) VALUES
(1, 'cloud.jpg', 'ابرهای بار ان زا اسمان شهر را فرا گرفته اند.\r\n    ');

-- --------------------------------------------------------

--
-- Table structure for table `tblstate`
--

CREATE TABLE `tblstate` (
  `state_id` int(5) NOT NULL,
  `state_description` text NOT NULL,
  `state_grade` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblstate`
--

INSERT INTO `tblstate` (`state_id`, `state_description`, `state_grade`) VALUES
(1, 'دعوا در مدرسه', -0.5),
(2, 'شورای دانش آموزی', 0.5),
(3, 'بی ادبی به معلم', -0.5),
(4, 'شرکت در کارهای پژوهشی، فرهنگی', 0.5);

-- --------------------------------------------------------

--
-- Table structure for table `tblstudent`
--

CREATE TABLE `tblstudent` (
  `student_id` int(11) NOT NULL,
  `sname` varchar(200) NOT NULL,
  `sfamily` varchar(200) NOT NULL,
  `class_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `mobile` varchar(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblstudent`
--

INSERT INTO `tblstudent` (`student_id`, `sname`, `sfamily`, `class_id`, `state_id`, `mobile`) VALUES
(10, 'علی', 'تدین', 108, 10, '09876543232'),
(8, 'محمد', 'مرادی', 108, 0, '09342153432');

-- --------------------------------------------------------

--
-- Table structure for table `tblteacher`
--

CREATE TABLE `tblteacher` (
  `teacher_id` int(100) NOT NULL,
  `tname` varchar(20) NOT NULL,
  `tfamily` varchar(50) NOT NULL,
  `tmobile` varchar(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblteacher`
--

INSERT INTO `tblteacher` (`teacher_id`, `tname`, `tfamily`, `tmobile`) VALUES
(13, 'یاشار', 'بنی هاشم', '0987123456');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `user_id` int(200) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `type` int(2) NOT NULL,
  `mobile` varchar(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='اطلاعات کاربران';

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`user_id`, `fname`, `lname`, `username`, `password`, `type`, `mobile`) VALUES
(1, 'زهرا', 'رحمتی', 'zara', '123', 1, '123'),
(9, 'نگین  ', 'رحیمی', 'negin  ', '234  ', 3, '1234'),
(15, 'علیرضا', 'مراد بختی', 'alireza', '123', 3, '0934567893'),
(16, 'محمد', 'مرادی', 'student', '09342153432', 3, '09342153432'),
(25, 'یاشار', 'بنی هاشم', 'teacher', '0987123456', 2, '0987123456'),
(18, 'علی', 'تدین', 'student', '09876543232', 3, '09876543232');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblbase`
--
ALTER TABLE `tblbase`
  ADD PRIMARY KEY (`base_id`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `tblclass`
--
ALTER TABLE `tblclass`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `tblcourse`
--
ALTER TABLE `tblcourse`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `tbldate`
--
ALTER TABLE `tbldate`
  ADD PRIMARY KEY (`date_id`);

--
-- Indexes for table `tblexam`
--
ALTER TABLE `tblexam`
  ADD PRIMARY KEY (`exam_id`);

--
-- Indexes for table `tblfile`
--
ALTER TABLE `tblfile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbllesson`
--
ALTER TABLE `tbllesson`
  ADD PRIMARY KEY (`lesson_id`);

--
-- Indexes for table `tblnews`
--
ALTER TABLE `tblnews`
  ADD PRIMARY KEY (`id_news`);

--
-- Indexes for table `tbloptions`
--
ALTER TABLE `tbloptions`
  ADD PRIMARY KEY (`op_id`);

--
-- Indexes for table `tblpanel`
--
ALTER TABLE `tblpanel`
  ADD PRIMARY KEY (`pan_id`);

--
-- Indexes for table `tblscore`
--
ALTER TABLE `tblscore`
  ADD PRIMARY KEY (`score_id`);

--
-- Indexes for table `tblslider`
--
ALTER TABLE `tblslider`
  ADD PRIMARY KEY (`slider_id`);

--
-- Indexes for table `tblstate`
--
ALTER TABLE `tblstate`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `tblstudent`
--
ALTER TABLE `tblstudent`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `tblteacher`
--
ALTER TABLE `tblteacher`
  ADD PRIMARY KEY (`teacher_id`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblbase`
--
ALTER TABLE `tblbase`
  MODIFY `base_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `cat_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tblcourse`
--
ALTER TABLE `tblcourse`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbldate`
--
ALTER TABLE `tbldate`
  MODIFY `date_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblexam`
--
ALTER TABLE `tblexam`
  MODIFY `exam_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblfile`
--
ALTER TABLE `tblfile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbllesson`
--
ALTER TABLE `tbllesson`
  MODIFY `lesson_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblnews`
--
ALTER TABLE `tblnews`
  MODIFY `id_news` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbloptions`
--
ALTER TABLE `tbloptions`
  MODIFY `op_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tblpanel`
--
ALTER TABLE `tblpanel`
  MODIFY `pan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tblscore`
--
ALTER TABLE `tblscore`
  MODIFY `score_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblslider`
--
ALTER TABLE `tblslider`
  MODIFY `slider_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblstate`
--
ALTER TABLE `tblstate`
  MODIFY `state_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblstudent`
--
ALTER TABLE `tblstudent`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tblteacher`
--
ALTER TABLE `tblteacher`
  MODIFY `teacher_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `user_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
