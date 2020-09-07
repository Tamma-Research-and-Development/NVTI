
-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2020 at 02:05 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `schoolmass _covid-19`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounttype`
--

CREATE TABLE `accounttype` (
  `id` int(11) NOT NULL,
  `accounts` varchar(40) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounttype`
--

INSERT INTO `accounttype` (`id`, `accounts`, `description`) VALUES
(1, 'admin', ''),
(2, 'teacher', ''),
(3, 'finance', ''),
(4, 'admission', '');

-- --------------------------------------------------------

--
-- Table structure for table `admin_account`
--

CREATE TABLE `admin_account` (
  `id` int(11) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `First_Name` varchar(200) NOT NULL,
  `Last_Name` varchar(200) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `Phone_number` varchar(50) NOT NULL,
  `accountType` varchar(40) NOT NULL,
  `Password` varchar(200) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `years_in_teaching` varchar(100) NOT NULL,
  `professional_qualification` varchar(255) NOT NULL,
  `national_id` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `academic_qualification` varchar(255) NOT NULL,
  `biography` text NOT NULL,
  `payroll_number` varchar(100) NOT NULL,
  `ec_fullname` varchar(255) NOT NULL,
  `ec_relationship` varchar(50) NOT NULL,
  `ec_primary_tel` varchar(50) NOT NULL,
  `ec_secondaary_tel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_account`
--

INSERT INTO `admin_account` (`id`, `photo`, `First_Name`, `Last_Name`, `Gender`, `Phone_number`, `accountType`, `Password`, `email`, `dob`, `years_in_teaching`, `professional_qualification`, `national_id`, `address`, `academic_qualification`, `biography`, `payroll_number`, `ec_fullname`, `ec_relationship`, `ec_primary_tel`, `ec_secondaary_tel`) VALUES
(1, '', 'Michael ', 'Nimley', 'male', '0777007009', 'admin', '$2y$10$s/g63OgKOJubz7C2JuV0j.JFl5iu/0aty7A9Vc43rUzkjW7G2gsLC', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(34, '', 'John', 'Doe', 'male', '0777007008', 'teacher', '$2y$10$hAr2hxqzs8z/5qtAaIkhdem9yXjjFhRKOzvCqEy2mgLTGGELJhaEm', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(36, '', 'Ephraim', 'Doherty', 'male', '0770964566', 'finance', '$2y$10$hAr2hxqzs8z/5qtAaIkhdem9yXjjFhRKOzvCqEy2mgLTGGELJhaEm', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(47, '', 'Hartina Vonyee', 'Cleon', 'female', '0880187033', 'admission', '$2y$10$/cNb0B4jlgGfq0Ka5C.1nOJed.nx4/Jx3/Ls4HiJZut.gzJZrOQV.', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `application_settings`
--

CREATE TABLE `application_settings` (
  `id` int(11) NOT NULL,
  `app_logo` varchar(200) NOT NULL,
  `app_school_name` varchar(200) NOT NULL,
  `app_contact_phone` mediumtext NOT NULL,
  `app_contact_email` varchar(200) NOT NULL,
  `app_contact_address` varchar(200) NOT NULL,
  `app_about_info` longtext NOT NULL,
  `app_motto` mediumtext NOT NULL,
  `app_mission` mediumtext NOT NULL,
  `app_vision` mediumtext NOT NULL,
  `app_history` mediumtext NOT NULL,
  `social_facebook` varchar(200) NOT NULL COMMENT 'holds url to social site',
  `social_twitter` varchar(200) NOT NULL COMMENT 'holds url to social site',
  `app_home_background_image` varchar(200) NOT NULL,
  `app_student_login_background_image` varchar(200) NOT NULL,
  `app_educator_login_background_image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Holds configuration information for the school';

--
-- Dumping data for table `application_settings`
--

INSERT INTO `application_settings` (`id`, `app_logo`, `app_school_name`, `app_contact_phone`, `app_contact_email`, `app_contact_address`, `app_about_info`, `app_motto`, `app_mission`, `app_vision`, `app_history`, `social_facebook`, `social_twitter`, `app_home_background_image`, `app_student_login_background_image`, `app_educator_login_background_image`) VALUES
(1, '2logo.png', 'Netlib', '0777007009', 'info@tammacorp.com', 'Du port Road', 'WE BRIDGE THE GAP BETWEEN STUDENTS AND TEACHERS ALLOWING YOU TO EASILY LEARN FROM THE COMFORT OF YOUR HOME', 'We mold minds for the better', 'Go the distance', 'Study hard', 'Add your own stuff', 'https://www.facebook.com/', 'https://www.twitter.com', 'home7.jpg', 'picture2.jpg', 'download (1).jpg.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ask_teacher`
--

CREATE TABLE `ask_teacher` (
  `id` int(11) NOT NULL,
  `studentId` int(11) NOT NULL,
  `teacherPhone` varchar(200) NOT NULL,
  `class` varchar(30) NOT NULL,
  `Qsubject` varchar(100) NOT NULL,
  `Question` text NOT NULL,
  `teacher_response` text NOT NULL,
  `added_date` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `class` varchar(500) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `semester` varchar(50) NOT NULL,
  `school_year` varchar(50) CHARACTER SET latin1 NOT NULL,
  `period` varchar(70) CHARACTER SET latin1 NOT NULL,
  `presence` varchar(1) NOT NULL,
  `absence` varchar(1) NOT NULL,
  `excused` varchar(1) NOT NULL,
  `comment` varchar(1000) NOT NULL,
  `date_added` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bulletin`
--

CREATE TABLE `bulletin` (
  `bulletin_id` int(11) NOT NULL,
  `news_title` text NOT NULL,
  `news_file` varchar(200) NOT NULL,
  `news_details` longtext NOT NULL,
  `news_target_audience` varchar(200) DEFAULT 'All',
  `postedBy` int(11) NOT NULL,
  `added_date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bulletin`
--

INSERT INTO `bulletin` (`bulletin_id`, `news_title`, `news_file`, `news_details`, `news_target_audience`, `postedBy`, `added_date`) VALUES
(16, 'New active hours', 'certificate-border-2.jpg', 'Online classes will now run from 6:00 am to 12:00 am', 'student', 1, 'Tuesday 02, June 2020 - 6:29:39 PM'),
(17, 'Senior High Teacher Training Program', '', 'Seminar will be held at Royal Grand Hotel from 1:00 pm to 5:00pm', 'teacher', 1, 'Tuesday 02, June 2020 - 6:44:48 PM'),
(19, 'Grade 12 Warning Notice', '', 'It has been brought to my attention that you guys refused to do your English assignment.', 'student', 1, 'Wednesday 03, June 2020 - 3:18:11 PM'),
(20, 'Grade 12 Warning Notice', 'rest codes.txt', 'It has been brought to my attention that you guys refused to do your English assignment.\r\n\r\nsdfsbdjgkdsfjhgdsjfgdsjfgdsjfgdsfgsdfhdsfgdsjhfgdsjkfhgsdjkfgsdhfgdsjhfgsdjfgsdjkfgkjsdgfhjsdgfhsdgfdshfgdsfgdshfjgdsjfhgsdjkgwrwer7y7rywyuirqiwueytruyewtruywetriueywtryetrwufqwerhjdfgjshdgfjksdgfsdfgkgfdsjhfgdsjkfhgweuyqwtrydgfdshfgdsfhgdsfjgsdfhegkjgdfhgasfdsgfjsgdfkjsdgfjsd.\r\n\r\n\r\nsdahfkjsdafgghjgsajfgjgjksgdfghweryoiywiyuiyrwqeryroiyiowryweqrjbdskfbsdkjhgfkjhwieyiwuerqiyriowyrioewyriweo', 'public', 1, 'Sunday 07, June 2020 - 6:52:27 PM'),
(21, 'PTA meeting via video conference 12:00 pm', '', 'Hope China will be having its first ever PTA meeting via video conference', 'public', 1, 'Sunday 07, June 2020 - 7:05:29 PM'),
(22, 'Chart', 'newstuff.png', 'Hope China will be having its first ever PTA meeting via video conference', 'public', 1, 'Sunday 07, June 2020 - 9:53:08 PM'),
(23, 'Article', 'subjectmathematics.jpg', 'Those who are being educated have rather a difficult time with their parents, their educators and their fellow students: already the tide of struggle, anxiety, fear and competition has swept in. They have to face a world that is overpopulated, with undernourished people, a world of war, increasing terrorism, inefficient governments, corruption and the threat of poverty. This threat is less evident in affluent and fairly well-organized societies, but it is felt in those parts of the world where there is tremendous poverty, overpopulation and the indifference of inefficient rulers. This is the world the young people have to face, and naturally they are really frightened. They have an idea that they should be free, independent of routine, should not be dominated by their elders; and they shy away from all authority. Freedom to them means to choose what they want to do; but they are confused, uncertain and want to be shown what they should do. The student is caught between his own desire for freedom to do what he wants and society’s demands for conformity to its own necessities, that people become engineers, scientists, soldiers, or specialists of some kind. This is the world students have to face and become a part of through their education. It is a frightening world. We all want security physically as well as emotionally, and having this is becoming more and more difficult and painful.', 'public', 1, 'Monday 08, June 2020 - 3:19:09 PM');

-- --------------------------------------------------------

--
-- Table structure for table `classmates`
--

CREATE TABLE `classmates` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `fav-subject` varchar(100) NOT NULL,
  `photo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `department_name` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `position` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `years_in_teaching` varchar(255) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `prof_qualification` varchar(500) NOT NULL,
  `academic_qualification` varchar(500) NOT NULL,
  `national_id` varchar(100) NOT NULL,
  `address` varchar(500) NOT NULL,
  `emc_fullname` varchar(255) NOT NULL,
  `emc_relationship` varchar(255) NOT NULL,
  `emc_primary_tel` varchar(50) NOT NULL,
  `emc_secondary_tel` varchar(50) NOT NULL,
  `biography` text NOT NULL,
  `payroll_no.` varchar(100) NOT NULL,
  `added_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `exercise2`
--

CREATE TABLE `exercise2` (
  `id` int(11) NOT NULL,
  `taskId` int(11) NOT NULL,
  `intendedClass` varchar(500) NOT NULL,
  `addedBy` varchar(50) NOT NULL,
  `test_question` text NOT NULL,
  `WrongAnswer1` text NOT NULL,
  `WrongAnswer2` text NOT NULL,
  `WrongAnswer3` text NOT NULL,
  `CorrectAnswer` text NOT NULL,
  `timer` varchar(255) NOT NULL,
  `year` varchar(50) CHARACTER SET latin1 NOT NULL,
  `addedDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `mobile` varchar(20) NOT NULL,
  `message` longtext NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'new',
  `submitted_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `first_name`, `last_name`, `email`, `mobile`, `message`, `status`, `submitted_at`) VALUES
(22, 'Happy', 'Person', '', '0777007009', 'Yuuhh', 'new', 'Wednesday 10, June 2020 - 6:33:10 PM');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `class` varchar(500) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `activities` varchar(100) NOT NULL,
  `score` varchar(50) NOT NULL,
  `period` varchar(70) CHARACTER SET latin1 NOT NULL,
  `semester` varchar(50) NOT NULL,
  `school_year` varchar(50) CHARACTER SET latin1 NOT NULL,
  `approved` tinyint(1) NOT NULL,
  `date_added` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `installment`
--

CREATE TABLE `installment` (
  `id` int(11) NOT NULL,
  `installment` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `recipient_id` int(11) NOT NULL,
  `message` longtext NOT NULL,
  `added_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `note_creator_id` int(11) NOT NULL,
  `class` varchar(500) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `note_title` varchar(5000) NOT NULL,
  `note` longtext NOT NULL,
  `added_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `id` int(11) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `UserName` varchar(200) NOT NULL,
  `Fullname` varchar(200) NOT NULL,
  `Mobile` varchar(200) NOT NULL,
  `status` varchar(75) CHARACTER SET utf8mb4 NOT NULL,
  `year` varchar(50) NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  `birth_month` varchar(200) NOT NULL,
  `birth_day` varchar(200) NOT NULL,
  `birth_year` varchar(200) NOT NULL,
  `place_of_birth` varchar(200) NOT NULL,
  `nationality` varchar(200) NOT NULL,
  `gender` varchar(200) NOT NULL,
  `emial` varchar(200) NOT NULL,
  `tuition_status` varchar(200) NOT NULL DEFAULT 'self-cash payment',
  `academic status` varchar(200) NOT NULL,
  `first_time_attending_vocational_school` varchar(200) NOT NULL,
  `terms_agreement` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`id`, `photo`, `UserName`, `Fullname`, `Mobile`, `status`, `year`, `deleted`, `birth_month`, `birth_day`, `birth_year`, `place_of_birth`, `nationality`, `gender`, `emial`, `tuition_status`, `academic status`, `first_time_attending_vocational_school`, `terms_agreement`) VALUES
(41, '', '$2y$10$46/ZRgndY8tHgJizxBN3x.aVjRfMqg5iqF1pYLta8PeXKT62zf8Ha', 'Michael Nimley', '0777007007', 'Active', '2020/2021', 1, '', '', '', '', '', '', '', 'self-cash payment', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `participant_selected_courses`
--

CREATE TABLE `participant_selected_courses` (
  `p_s_c_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `departments` varchar(90) NOT NULL,
  `trade_area` varchar(500) NOT NULL,
  `section` varchar(20) NOT NULL,
  `year` varchar(50) NOT NULL,
  `date_of_selection` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `periods`
--

CREATE TABLE `periods` (
  `id` int(11) NOT NULL,
  `periods` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `periods`
--

INSERT INTO `periods` (`id`, `periods`) VALUES
(1, '1st period'),
(2, '2nd period'),
(3, '3rd period'),
(4, '4th period'),
(5, '5th period'),
(6, '6th period');

-- --------------------------------------------------------

--
-- Table structure for table `phases`
--

CREATE TABLE `phases` (
  `id` int(11) NOT NULL,
  `phases` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `phases`
--

INSERT INTO `phases` (`id`, `phases`) VALUES
(1, 'phase 1'),
(2, 'phase 2'),
(3, 'phase 3'),
(4, 'phase 4');

-- --------------------------------------------------------

--
-- Table structure for table `registration_payment`
--

CREATE TABLE `registration_payment` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `trade_area` varchar(500) NOT NULL,
  `amount_paid` varchar(255) NOT NULL,
  `charges` varchar(255) NOT NULL,
  `school_year` varchar(50) CHARACTER SET latin1 NOT NULL,
  `added_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `registration_payment_history`
--

CREATE TABLE `registration_payment_history` (
  `id` int(11) NOT NULL,
  `reg_id` int(11) NOT NULL,
  `reg_student_id` int(11) NOT NULL,
  `amount_paid` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `date_of_payment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `registration_payment_plan`
--

CREATE TABLE `registration_payment_plan` (
  `id` int(11) NOT NULL,
  `trade_area` varchar(500) NOT NULL,
  `charges` varchar(100) NOT NULL,
  `school_year` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `responsibilities`
--

CREATE TABLE `responsibilities` (
  `id` int(11) NOT NULL,
  `account_type` varchar(40) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `class_name` varchar(500) NOT NULL,
  `subject_name` varchar(100) CHARACTER SET latin1 NOT NULL,
  `school_year` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `school_year`
--

CREATE TABLE `school_year` (
  `id` int(11) NOT NULL,
  `year` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `school_year`
--

INSERT INTO `school_year` (`id`, `year`) VALUES
(1, '2020/2021');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `student_status` varchar(75) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `student_status`, `description`) VALUES
(1, 'Active', 'shows that student is using the system'),
(2, 'Suspended', 'Tells that a student account is locked for a particular time'),
(3, 'NTR', 'Never to return to that school'),
(5, 'Applicant', 'someone who has just applied but is not yet accepted');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `taskType` varchar(70) NOT NULL,
  `intendedSchool` text NOT NULL,
  `intendedClass` text NOT NULL,
  `subject` varchar(200) NOT NULL,
  `taskDescription` text NOT NULL,
  `files` text NOT NULL,
  `viewed` tinyint(1) NOT NULL DEFAULT 0,
  `addedBy` varchar(50) NOT NULL,
  `addedDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `taskType`, `intendedSchool`, `intendedClass`, `subject`, `taskDescription`, `files`, `viewed`, `addedBy`, `addedDate`) VALUES
(91, 'Pop Quiz', 'Weltona Christian Academy', 'Grade One', 'Literature', 'Read Thomas Sowell\'s Basic Economics book', 'COVID-19-UPDATE.pdf.pdf', 0, '0777007009', '2020-05-31 22:08:24');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_responsibilities`
--

CREATE TABLE `teacher_responsibilities` (
  `t_r_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `department` varchar(90) NOT NULL,
  `trade_area` varchar(500) NOT NULL,
  `subject` varchar(90) NOT NULL,
  `section` varchar(20) NOT NULL,
  `added_on` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `trade_area`
--

CREATE TABLE `trade_area` (
  `trade_area` varchar(500) NOT NULL,
  `department` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `trade_area_sections`
--

CREATE TABLE `trade_area_sections` (
  `trade_area_sections_id` int(11) NOT NULL,
  `trade_areas` varchar(500) NOT NULL,
  `sections` varchar(20) NOT NULL,
  `year` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tuition_payment`
--

CREATE TABLE `tuition_payment` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `trade_area` varchar(500) NOT NULL,
  `amount_paid` varchar(255) NOT NULL,
  `school_year` varchar(50) CHARACTER SET latin1 NOT NULL,
  `added_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tuition_payment_history`
--

CREATE TABLE `tuition_payment_history` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `installment` varchar(100) NOT NULL,
  `amount_paid` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `date_of_payment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tuition_payment_plan`
--

CREATE TABLE `tuition_payment_plan` (
  `id` int(11) NOT NULL,
  `trade_area` varchar(500) NOT NULL,
  `1st_installment` varchar(100) NOT NULL,
  `2nd_installment` varchar(100) NOT NULL,
  `3rd_installment` varchar(100) NOT NULL,
  `4th_installment` varchar(100) NOT NULL,
  `amount_paid` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `school_year` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `us_rate`
--

CREATE TABLE `us_rate` (
  `id` int(11) NOT NULL,
  `current_rate` varchar(255) NOT NULL,
  `added_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounttype`
--
ALTER TABLE `accounttype`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `accounts` (`accounts`);

--
-- Indexes for table `admin_account`
--
ALTER TABLE `admin_account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Phone_number` (`Phone_number`),
  ADD KEY `accountType` (`accountType`);

--
-- Indexes for table `application_settings`
--
ALTER TABLE `application_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ask_teacher`
--
ALTER TABLE `ask_teacher`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class` (`class`),
  ADD KEY `studentId` (`studentId`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`) USING BTREE,
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `class` (`class`),
  ADD KEY `subject` (`subject`),
  ADD KEY `period` (`period`),
  ADD KEY `school_year` (`school_year`),
  ADD KEY `semester` (`semester`);

--
-- Indexes for table `bulletin`
--
ALTER TABLE `bulletin`
  ADD PRIMARY KEY (`bulletin_id`),
  ADD KEY `postedBy` (`postedBy`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `department_name` (`department_name`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exercise2`
--
ALTER TABLE `exercise2`
  ADD PRIMARY KEY (`id`),
  ADD KEY `taskId` (`taskId`),
  ADD KEY `addedBy` (`addedBy`),
  ADD KEY `Exercise` (`year`),
  ADD KEY `intendedClass` (`intendedClass`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mobile` (`mobile`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `class` (`class`),
  ADD KEY `subject` (`subject`),
  ADD KEY `period` (`period`),
  ADD KEY `semester` (`semester`),
  ADD KEY `school_year` (`school_year`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `recipient_id` (`recipient_id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD KEY `note_creator_id` (`note_creator_id`),
  ADD KEY `class` (`class`),
  ADD KEY `subject` (`subject`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UserName_2` (`UserName`),
  ADD UNIQUE KEY `status` (`status`),
  ADD KEY `Fullname` (`Fullname`),
  ADD KEY `UserName` (`UserName`),
  ADD KEY `status_2` (`status`),
  ADD KEY `year` (`year`);

--
-- Indexes for table `participant_selected_courses`
--
ALTER TABLE `participant_selected_courses`
  ADD PRIMARY KEY (`p_s_c_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `departments` (`departments`),
  ADD KEY `trade_area` (`trade_area`),
  ADD KEY `section` (`section`),
  ADD KEY `year` (`year`);

--
-- Indexes for table `periods`
--
ALTER TABLE `periods`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `periods` (`periods`);

--
-- Indexes for table `phases`
--
ALTER TABLE `phases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration_payment`
--
ALTER TABLE `registration_payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `class` (`trade_area`),
  ADD KEY `school_year` (`school_year`);

--
-- Indexes for table `registration_payment_history`
--
ALTER TABLE `registration_payment_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reg_id` (`reg_id`),
  ADD KEY `reg_student_id` (`reg_student_id`);

--
-- Indexes for table `registration_payment_plan`
--
ALTER TABLE `registration_payment_plan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_year` (`school_year`),
  ADD KEY `class_name` (`trade_area`);

--
-- Indexes for table `responsibilities`
--
ALTER TABLE `responsibilities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_year` (`school_year`),
  ADD KEY `account_type` (`account_type`),
  ADD KEY `class_name` (`class_name`),
  ADD KEY `subject_name` (`subject_name`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `school_year`
--
ALTER TABLE `school_year`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `year` (`year`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_status` (`student_status`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `taskType` (`taskType`),
  ADD KEY `addedBy` (`addedBy`);

--
-- Indexes for table `teacher_responsibilities`
--
ALTER TABLE `teacher_responsibilities`
  ADD PRIMARY KEY (`t_r_id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `department` (`department`),
  ADD KEY `trade_area` (`trade_area`),
  ADD KEY `subject` (`subject`),
  ADD KEY `section` (`section`);

--
-- Indexes for table `trade_area`
--
ALTER TABLE `trade_area`
  ADD PRIMARY KEY (`trade_area`),
  ADD UNIQUE KEY `class_name` (`trade_area`),
  ADD UNIQUE KEY `department` (`department`);

--
-- Indexes for table `trade_area_sections`
--
ALTER TABLE `trade_area_sections`
  ADD PRIMARY KEY (`trade_area_sections_id`),
  ADD KEY `trade_areas` (`trade_areas`),
  ADD KEY `sections` (`sections`),
  ADD KEY `year` (`year`);

--
-- Indexes for table `tuition_payment`
--
ALTER TABLE `tuition_payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `class` (`trade_area`),
  ADD KEY `school_year` (`school_year`);

--
-- Indexes for table `tuition_payment_history`
--
ALTER TABLE `tuition_payment_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `tuition_payment_plan`
--
ALTER TABLE `tuition_payment_plan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_name` (`trade_area`),
  ADD KEY `school_year` (`school_year`);

--
-- Indexes for table `us_rate`
--
ALTER TABLE `us_rate`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounttype`
--
ALTER TABLE `accounttype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `admin_account`
--
ALTER TABLE `admin_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `application_settings`
--
ALTER TABLE `application_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ask_teacher`
--
ALTER TABLE `ask_teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bulletin`
--
ALTER TABLE `bulletin`
  MODIFY `bulletin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exercise2`
--
ALTER TABLE `exercise2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `participant_selected_courses`
--
ALTER TABLE `participant_selected_courses`
  MODIFY `p_s_c_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `periods`
--
ALTER TABLE `periods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `phases`
--
ALTER TABLE `phases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `registration_payment`
--
ALTER TABLE `registration_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registration_payment_history`
--
ALTER TABLE `registration_payment_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registration_payment_plan`
--
ALTER TABLE `registration_payment_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `responsibilities`
--
ALTER TABLE `responsibilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `school_year`
--
ALTER TABLE `school_year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `teacher_responsibilities`
--
ALTER TABLE `teacher_responsibilities`
  MODIFY `t_r_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trade_area_sections`
--
ALTER TABLE `trade_area_sections`
  MODIFY `trade_area_sections_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tuition_payment`
--
ALTER TABLE `tuition_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tuition_payment_history`
--
ALTER TABLE `tuition_payment_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tuition_payment_plan`
--
ALTER TABLE `tuition_payment_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `us_rate`
--
ALTER TABLE `us_rate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_account`
--
ALTER TABLE `admin_account`
  ADD CONSTRAINT `admin_account_ibfk_2` FOREIGN KEY (`accountType`) REFERENCES `accounttype` (`accounts`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ask_teacher`
--
ALTER TABLE `ask_teacher`
  ADD CONSTRAINT `ask_teacher_ibfk_1` FOREIGN KEY (`class`) REFERENCES `trade_area` (`trade_area`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ask_teacher_ibfk_2` FOREIGN KEY (`studentId`) REFERENCES `participants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `participants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attendance_ibfk_3` FOREIGN KEY (`class`) REFERENCES `trade_area` (`trade_area`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attendance_ibfk_4` FOREIGN KEY (`period`) REFERENCES `periods` (`periods`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attendance_ibfk_5` FOREIGN KEY (`subject`) REFERENCES `subject` (`subject_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attendance_ibfk_6` FOREIGN KEY (`school_year`) REFERENCES `school_year` (`year`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attendance_ibfk_7` FOREIGN KEY (`semester`) REFERENCES `semester` (`semester`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exercise2`
--
ALTER TABLE `exercise2`
  ADD CONSTRAINT `Exercise` FOREIGN KEY (`year`) REFERENCES `school_year` (`year`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exercise2_ibfk_1` FOREIGN KEY (`taskId`) REFERENCES `task` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `participants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `grades_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `grades_ibfk_3` FOREIGN KEY (`class`) REFERENCES `trade_area` (`trade_area`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `grades_ibfk_4` FOREIGN KEY (`subject`) REFERENCES `subject` (`subject_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `grades_ibfk_5` FOREIGN KEY (`period`) REFERENCES `periods` (`periods`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `grades_ibfk_6` FOREIGN KEY (`semester`) REFERENCES `semester` (`semester`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `grades_ibfk_7` FOREIGN KEY (`school_year`) REFERENCES `school_year` (`year`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `participants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`recipient_id`) REFERENCES `participants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`note_creator_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notes_ibfk_2` FOREIGN KEY (`class`) REFERENCES `trade_area` (`trade_area`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notes_ibfk_3` FOREIGN KEY (`subject`) REFERENCES `subject` (`subject_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `participants`
--
ALTER TABLE `participants`
  ADD CONSTRAINT `participants_ibfk_1` FOREIGN KEY (`status`) REFERENCES `status` (`student_status`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `participants_ibfk_2` FOREIGN KEY (`year`) REFERENCES `school_year` (`year`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `registration_payment`
--
ALTER TABLE `registration_payment`
  ADD CONSTRAINT `registration_payment_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `participants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `registration_payment_ibfk_2` FOREIGN KEY (`trade_area`) REFERENCES `trade_area` (`trade_area`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `registration_payment_ibfk_3` FOREIGN KEY (`school_year`) REFERENCES `school_year` (`year`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `registration_payment_history`
--
ALTER TABLE `registration_payment_history`
  ADD CONSTRAINT `registration_payment_history_ibfk_1` FOREIGN KEY (`reg_id`) REFERENCES `registration_payment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `registration_payment_history_ibfk_2` FOREIGN KEY (`reg_student_id`) REFERENCES `registration_payment` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `registration_payment_plan`
--
ALTER TABLE `registration_payment_plan`
  ADD CONSTRAINT `registration_payment_plan_ibfk_1` FOREIGN KEY (`trade_area`) REFERENCES `trade_area` (`trade_area`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `registration_payment_plan_ibfk_2` FOREIGN KEY (`school_year`) REFERENCES `school_year` (`year`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `responsibilities`
--
ALTER TABLE `responsibilities`
  ADD CONSTRAINT `responsibilities_ibfk_1` FOREIGN KEY (`account_type`) REFERENCES `admin_account` (`accountType`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `responsibilities_ibfk_2` FOREIGN KEY (`school_year`) REFERENCES `school_year` (`year`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `responsibilities_ibfk_3` FOREIGN KEY (`class_name`) REFERENCES `trade_area` (`trade_area`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `responsibilities_ibfk_4` FOREIGN KEY (`school_year`) REFERENCES `school_year` (`year`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `responsibilities_ibfk_5` FOREIGN KEY (`teacher_id`) REFERENCES `admin_account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`addedBy`) REFERENCES `admin_account` (`Phone_number`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teacher_responsibilities`
--
ALTER TABLE `teacher_responsibilities`
  ADD CONSTRAINT `teacher_responsibilities_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `admin_account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teacher_responsibilities_ibfk_2` FOREIGN KEY (`department`) REFERENCES `departments` (`department_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teacher_responsibilities_ibfk_3` FOREIGN KEY (`section`) REFERENCES `trade_area_sections` (`sections`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teacher_responsibilities_ibfk_4` FOREIGN KEY (`trade_area`) REFERENCES `trade_area` (`trade_area`);

--
-- Constraints for table `trade_area`
--
ALTER TABLE `trade_area`
  ADD CONSTRAINT `trade_area_ibfk_1` FOREIGN KEY (`department`) REFERENCES `departments` (`department_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tuition_payment`
--
ALTER TABLE `tuition_payment`
  ADD CONSTRAINT `tuition_payment_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `grades` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tuition_payment_ibfk_2` FOREIGN KEY (`trade_area`) REFERENCES `trade_area` (`trade_area`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tuition_payment_ibfk_3` FOREIGN KEY (`school_year`) REFERENCES `school_year` (`year`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tuition_payment_history`
--
ALTER TABLE `tuition_payment_history`
  ADD CONSTRAINT `tuition_payment_history_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `grades` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tuition_payment_plan`
--
ALTER TABLE `tuition_payment_plan`
  ADD CONSTRAINT `tuition_payment_plan_ibfk_1` FOREIGN KEY (`trade_area`) REFERENCES `trade_area` (`trade_area`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tuition_payment_plan_ibfk_2` FOREIGN KEY (`school_year`) REFERENCES `school_year` (`year`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
