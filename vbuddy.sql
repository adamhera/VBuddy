-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2023 at 12:20 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vbuddy`
--

-- --------------------------------------------------------

--
-- Table structure for table `assign`
--

CREATE TABLE `assign` (
  `ASSIGNID` varchar(10) NOT NULL,
  `ADMINID` varchar(10) NOT NULL,
  `MENTORID` varchar(10) NOT NULL,
  `COURSEID` varchar(10) NOT NULL,
  `DATESTART` date DEFAULT NULL,
  `DATEEND` date DEFAULT NULL,
  `REMARKS` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assign`
--

INSERT INTO `assign` (`ASSIGNID`, `ADMINID`, `MENTORID`, `COURSEID`, `DATESTART`, `DATEEND`, `REMARKS`) VALUES
('G001', '2020400800', '2021819166', 'CSC264', '2023-06-13', '2023-12-13', ''),
('G002', '2020400800', '2021487464', 'MAT210', '2023-06-13', '2023-12-13', ''),
('G003', '2020400800', '2021493822', 'CSC305', '2023-06-13', '2023-12-13', ''),
('G004', '2020400800', '2021891588', 'ISP250', '2023-06-13', '2023-12-13', '');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `ASSIGNID` varchar(10) NOT NULL,
  `TOPICID` varchar(10) NOT NULL,
  `MENTEEID` varchar(10) NOT NULL,
  `DATEATTEND` date NOT NULL,
  `ATTENDSTATUS` varchar(10) NOT NULL DEFAULT 'absent',
  `REMARKS` varchar(100) DEFAULT NULL,
  `STARTTIME` time NOT NULL,
  `ENDTIME` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`ASSIGNID`, `TOPICID`, `MENTEEID`, `DATEATTEND`, `ATTENDSTATUS`, `REMARKS`, `STARTTIME`, `ENDTIME`) VALUES
('G001', 'TG0011', '2021207626', '2023-06-15', 'present', NULL, '20:00:00', '22:00:00'),
('G001', 'TG0011', '2021896734', '2023-06-15', 'present', NULL, '20:00:00', '22:00:00'),
('G001', 'TG0011', '2021215058', '2023-06-15', 'present', NULL, '20:00:00', '22:00:00'),
('G002', 'TG0021', '2021833358', '2023-06-01', 'absent', NULL, '20:00:00', '22:00:00'),
('G001', 'TG0012', '2021207626', '2023-06-18', 'absent', NULL, '20:00:00', '22:00:00'),
('G001', 'TG0012', '2021896734', '2023-06-18', 'present', NULL, '20:00:00', '22:00:00'),
('G001', 'TG0012', '2021215058', '2023-06-18', 'present', NULL, '20:00:00', '22:00:00'),
('G003', 'TG0031', '2021856862', '2023-06-22', 'present', NULL, '21:00:00', '23:00:00'),
('G003', 'TG0031', '2021479718', '2023-06-22', 'present', NULL, '21:00:00', '23:00:00'),
('G001', 'TG0013', '2021207626', '2023-06-28', 'present', NULL, '21:00:00', '23:00:00'),
('G001', 'TG0013', '2021896734', '2023-06-28', 'absent', NULL, '21:00:00', '23:00:00'),
('G001', 'TG0013', '2021215058', '2023-06-28', 'absent', NULL, '21:00:00', '23:00:00'),
('G002', 'TG0022', '2021833358', '2023-07-01', 'present', NULL, '20:00:00', '22:00:00'),
('G003', 'TG0032', '2021856862', '2023-07-03', 'absent', NULL, '20:00:00', '22:00:00'),
('G003', 'TG0032', '2021479718', '2023-07-03', 'present', NULL, '20:00:00', '22:00:00'),
('G003', 'TG0033', '2021856862', '2023-07-10', 'present', NULL, '21:00:00', '23:00:00'),
('G003', 'TG0033', '2021479718', '2023-07-10', 'present', NULL, '21:00:00', '23:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `COURSEID` varchar(10) NOT NULL,
  `COURSENAME` varchar(100) NOT NULL,
  `COURSEDESC` varchar(1000) DEFAULT NULL,
  `COURSESEMESTER` int(2) NOT NULL,
  `COURSESTATUS` varchar(10) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`COURSEID`, `COURSENAME`, `COURSEDESC`, `COURSESEMESTER`, `COURSESTATUS`) VALUES
('', '', '', 0, 'active'),
('CSC126', 'FUNDAMENTALS OF ALGORITHMS AND COMPUTER PROBLEM SOLVING', '', 1, 'active'),
('CSC159', 'COMPUTER ORGANIZATION', 'null', 2, 'active'),
('CSC186', 'OBJECT ORIENTED PROGRAMMING', NULL, 2, 'acitve'),
('CSC204', 'PRACTICAL APPROACH OF OPERATING SYSTEMS', NULL, 3, 'active'),
('CSC248', 'FUNDAMENTALS OF DATA STRUCTURES', NULL, 3, 'active'),
('CSC253', 'INTERACTIVE MULTIMEDIA', NULL, 1, 'active'),
('CSC264', 'INTRODUCTION TO WEB AND MOBILE APPLICATION', '', 4, 'active'),
('CSC305', 'PROGRAMMING PARADIGMS', '', 4, 'active'),
('ICT200', 'INTRODUCTION TO DATABASE MANAGEMENT', NULL, 3, 'active'),
('ISP250', 'INFORMATION SYSTEM DEVELOPMENT', '', 4, 'active'),
('ITT270', 'DIGITAL ELECTRONICS', NULL, 3, 'active'),
('ITT320', 'INTRODUCTION OF COMPUTER SECURITY', NULL, 3, 'active'),
('MAT133', 'PRE CALCULUS', NULL, 1, 'active'),
('MAT183', 'CALCULUS I', NULL, 2, 'active'),
('MAT210', 'DISCRETE MATHEMATICS', NULL, 3, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `discuss`
--

CREATE TABLE `discuss` (
  `DISCUSSID` int(11) NOT NULL,
  `TOPICID` varchar(10) NOT NULL,
  `MEMBERID` varchar(10) NOT NULL,
  `CONTENT` varchar(100) DEFAULT NULL,
  `TIME` timestamp NULL DEFAULT current_timestamp(),
  `ATTACHMENT` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `discuss`
--

INSERT INTO `discuss` (`DISCUSSID`, `TOPICID`, `MEMBERID`, `CONTENT`, `TIME`, `ATTACHMENT`) VALUES
(500001, 'TG0011', '2021819166', 'Hi, is anyone online?', '2023-07-12 17:03:50', ''),
(500002, 'TG0031', '2021493822', 'Hi Class, If you not understand about what we learn please chat me okay', '2023-07-13 01:59:41', ''),
(500003, 'TG0021', '2021487464', 'Hi', '2023-07-13 02:31:27', ''),
(500004, 'TG0021', '2021487464', 'So as for today, kita akan belajar a bit about Discrete Mathematics', '2023-07-13 02:31:49', ''),
(500006, 'TG0022', '2021487464', 'Hi, are you ready to begin the class ?', '2023-07-13 02:37:31', '');

-- --------------------------------------------------------

--
-- Table structure for table `enroll`
--

CREATE TABLE `enroll` (
  `ENROLLID` int(6) NOT NULL,
  `USERID` varchar(10) NOT NULL,
  `COURSEID` varchar(10) NOT NULL,
  `ROLE` varchar(10) NOT NULL,
  `DATE` date NOT NULL,
  `SEMESTER` decimal(2,0) NOT NULL,
  `REMARKS` varchar(2000) DEFAULT NULL,
  `STATUS` varchar(10) NOT NULL DEFAULT 'pending',
  `CONDITION` varchar(15) NOT NULL DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enroll`
--

INSERT INTO `enroll` (`ENROLLID`, `USERID`, `COURSEID`, `ROLE`, `DATE`, `SEMESTER`, `REMARKS`, `STATUS`, `CONDITION`) VALUES
(300001, '2021819166', 'CSC264', 'MENTOR', '2023-07-12', 4, 'I love teaching', 'approved', 'unavailable'),
(300002, '2021487464', 'MAT210', 'MENTOR', '2023-07-12', 4, 'I love mathematics, and I love to see everyone\'s happy when they understand about some particular topics.', 'approved', 'unavailable'),
(300003, '2021493822', 'CSC305', 'MENTOR', '2023-07-12', 4, 'I want to help all student to make sure their grade can improve and better for this semester', 'approved', 'unavailable'),
(300004, '2021891588', 'ISP250', 'MENTOR', '2023-07-12', 4, 'I just want to make people be a better student that has improve their study and their grade', 'approved', 'unavailable'),
(300005, '2021207626', 'CSC264', 'MENTEE', '2023-07-12', 4, 'I want to enhance my coding skills', 'approved', 'unavailable'),
(300006, '2021215058', 'CSC264', 'MENTEE', '2023-07-12', 4, 'I need to pass this semester', 'approved', 'unavailable'),
(300007, '2021833358', 'MAT210', 'MENTEE', '2023-07-12', 4, 'i want to pass mat210', 'approved', 'unavailable'),
(300008, '2021847782', 'ISP250', 'MENTEE', '2023-07-12', 4, 'i dont know how to connect to database', 'approved', 'unavailable'),
(300009, '2021856862', 'CSC305', 'MENTEE', '2023-07-12', 4, 'i need to learn more method about handling my coding', 'approved', 'unavailable'),
(300010, '2021479718', 'CSC305', 'MENTEE', '2023-07-12', 4, 'trying to pass the exam next month', 'approved', 'unavailable'),
(300011, '2021896734', 'CSC264', 'MENTEE', '2023-07-12', 4, 'I prefer learning with friends', 'approved', 'unavailable'),
(300012, '2021619128', 'ISP250', 'MENTEE', '2023-07-12', 4, 'I want to learn how to write a report for my project and database', 'approved', 'unavailable'),
(300013, '2021400000', 'CSC253', 'MENTEE', '2023-07-08', 4, 'CVCVCXJNVCJNC', 'rejected', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `FEEDID` int(11) NOT NULL,
  `TOPICID` varchar(10) NOT NULL,
  `MEMBERID` varchar(10) NOT NULL,
  `FEEDBACK` varchar(2000) NOT NULL,
  `SUGGESTION` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`FEEDID`, `TOPICID`, `MEMBERID`, `FEEDBACK`, `SUGGESTION`) VALUES
(700001, 'TG0031', '2021493822', 'All students are good and really active in my class ', '-'),
(700002, 'TG0021', '2021487464', ' My mentee is not attend the class, but however he already completed the assignment that has been given to me', '-'),
(700003, 'TG0022', '2021487464', ' Everything are good so far, my mentte still not attend the class but he already completed the assignment that has been given to me.', '-'),
(700004, 'TG0011', '2021819166', 'There is nothing to report so far, student had been very cooperative', 'No suggestion ! '),
(700005, 'TG0012', '2021819166', 'the class is going great so far, I enjoy teaching the student as they are very responsive', 'i want to handle more class'),
(700006, 'TG0013', '2021819166', 'The class is great!', 'i have no suggestion for now');

-- --------------------------------------------------------

--
-- Table structure for table `mentee`
--

CREATE TABLE `mentee` (
  `ASSIGNID` varchar(10) NOT NULL,
  `MENTEEID` varchar(10) NOT NULL,
  `REMARKS` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mentee`
--

INSERT INTO `mentee` (`ASSIGNID`, `MENTEEID`, `REMARKS`) VALUES
('G001', '2021207626', ''),
('G001', '2021896734', ''),
('G003', '2021856862', ''),
('G003', '2021479718', ''),
('G002', '2021833358', ''),
('G004', '2021847782', ''),
('G004', '2021619128', ''),
('G001', '2021215058', '');

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `RESULTID` int(10) NOT NULL,
  `SEMESTER` decimal(2,0) NOT NULL,
  `GPA` decimal(10,2) NOT NULL,
  `CGPA` decimal(10,2) NOT NULL,
  `USERID` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`RESULTID`, `SEMESTER`, `GPA`, `CGPA`, `USERID`) VALUES
(100001, 4, 3.68, 3.86, '2021819166'),
(100002, 4, 3.95, 3.96, '2021487464'),
(100003, 4, 3.97, 3.92, '2021493822'),
(100004, 4, 3.78, 3.79, '2021891588'),
(100005, 4, 3.20, 3.33, '2021207626'),
(100006, 4, 3.45, 3.23, '2021215058'),
(100007, 4, 3.33, 3.20, '2021833358'),
(100009, 4, 3.65, 3.10, '2021847782'),
(100010, 4, 3.23, 3.57, '2021856862'),
(100011, 4, 3.10, 3.40, '2021479718'),
(100012, 4, 3.28, 3.00, '2021896734'),
(100013, 4, 3.30, 3.40, '2021619128');

-- --------------------------------------------------------

--
-- Table structure for table `topic`
--

CREATE TABLE `topic` (
  `TOPICID` varchar(10) NOT NULL,
  `TOPIC` varchar(100) NOT NULL,
  `DATE` date NOT NULL,
  `PLATFORM` varchar(20) NOT NULL,
  `LINK_MEETING` mediumtext NOT NULL,
  `ATTACHMENT` varchar(100) NOT NULL,
  `DESCRIPTION` varchar(1000) DEFAULT NULL,
  `ASSIGNID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `topic`
--

INSERT INTO `topic` (`TOPICID`, `TOPIC`, `DATE`, `PLATFORM`, `LINK_MEETING`, `ATTACHMENT`, `DESCRIPTION`, `ASSIGNID`) VALUES
('TG0011', 'Basic to Javascript', '2023-06-15', 'Google Meet', 'https://meet.google.com/mnr-rzmp-evb', 'CSC264 Business Project Proposal - V-BUDDY MENTORSHIP SYSTEM.pdf', 'We will learn chapter 1.3', 'G001'),
('TG0012', 'Basic to HTML', '2023-06-18', 'Google Meet', 'https://meet.google.com/ffc-preg-ffb', 'TEMPLATE CSC204.pdf', 'Learning the basic for creating a website', 'G001'),
('TG0013', 'Tutorial for mobile app ', '2023-06-28', 'Google Meet', 'https://meet.google.com/qox-xute-xov', 'Copy of Copy of PHP and MySQL (with mobile).pptx', 'we will learn how to create mobile app via MIT app invetor', 'G001'),
('TG0021', 'Introduction to Discrete Mathematics', '2023-06-01', 'Google Meet', 'https://meet.google.com/yba-jkdf-xpx', 'Discrete Maths.pdf', 'A little bit of intro, regarding Discrete Mathematics', 'G002'),
('TG0022', 'Chapter 3 - Union/Partition', '2023-07-01', 'Google Meet', 'https://meet.google.com/hwb-piid-tse', 'Mat210 report.pdf', 'A little bit intro of Chapter 3', 'G002'),
('TG0031', 'CHAPTER 1 PROGRAMMING PARADIGM', '2023-06-22', 'Google Meet', 'https://meet.google.com/xmb-xtwv-mwu', 'CHAPTER 1 PROGRAMMING PARADIGM.pdf', 'THIS CHAPTER WILL GO THROUGH THE FACT OF EACH OF PROGRAMMING LANGUAGE', 'G003'),
('TG0032', 'CHAPTER 2 PROGRAMMING PARADIGM', '2023-07-03', 'Google Meet', 'https://meet.google.com/nmw-hhvv-jcr', 'CHAPTER 2 (1).pdf', 'WE WILL LEARN ABOUT THE SYNTAX AND SEMANTICS', 'G003'),
('TG0033', 'CHAPTER 2 PROGRAMMING PARADIGM', '2023-07-10', 'Google Meet', 'https://meet.google.com/svo-dnhm-pxc', 'CHAPTER 2 (1).pdf', 'CONTINUE PREVIOUS CHAPTER START FROM POINTER TYPES', 'G003');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `USERID` varchar(10) NOT NULL,
  `USERNAME` varchar(30) NOT NULL,
  `PASSWORD` varchar(20) NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `AGE` int(3) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `ADDRESS` varchar(100) NOT NULL,
  `PHONE_NUMBER` int(12) NOT NULL,
  `GENDER` varchar(10) NOT NULL,
  `LEVELID` int(2) NOT NULL,
  `STATUS` varchar(10) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`USERID`, `USERNAME`, `PASSWORD`, `NAME`, `AGE`, `EMAIL`, `ADDRESS`, `PHONE_NUMBER`, `GENDER`, `LEVELID`, `STATUS`) VALUES
('2020400800', 'admin', '123', 'Umi Mastura binti Johari', 38, 'umimastura1@gmail.com', '1402, Jalan Bandar Puteri Jaya 08000, Sungai Petani, Kedah', 118334162, 'Female', 1, 'approved'),
('2021207626', 'zamaninazr', '123', 'MOHAMMAD ZAMANI BIN MOHD NAZRI', 20, 'mohammadzamani322@gmail.com', 'Suite 7-13A Level 7 Wisma UOA II 21 Jalan Pinang', 1116500103, 'Male', 3, 'approved'),
('2021215058', 'adamdaniel', '123', 'ADAM DANIEL BIN MOHD RIZAL NIZAM', 20, 'adamdaniel2401@gmail.com', '8 Medan Lahat 3 Medan Lahat Baru,31500,Perak', 195509411, 'Male', 3, 'approved'),
('2021400000', 'atasha', '123', 'NUR ATASHA BINTI DAHLAN', 20, 'atasha@gmail.com', 'N0 2, PANDAN JAYA, 08100 BEDONG KEDAH', 182085802, 'FEMALE', 2, 'approved'),
('2021479718', 'athirahnaz', '123', 'NUR ATHIRAH BINTI NAZRI', 20, 'athirahnazri@gmail.com', ' 28 Lun Perindustrian Silibin 2 Kawasan Perkilangan Jelapang M ,Ipoh ,30020,  Perak', 164010525, 'Female', 3, 'approved'),
('2021487464', 'danielsahid', '123', 'MUHAMMAD DANIEL BIN MOHD SAHID', 20, 'danielsahid05@gmail.com', 'NO 267, 1/8 LORONG LEMBAH PERMAI, TAMAN LEMBAH PERMAI, 08100 BEDONG, KEDAH', 138955601, 'Male', 2, 'approved'),
('2021493822', 'danialazizi', '123', 'MUHAMAD DANIAL AZIZI BIN MOHD SALEHUDDIN', 20, 'danialazizi292003@gmail.com', '25, JALAN ELEKTROUN 12/U16 DENAI ALAM, 40160 SHAH ALAM SELANGOR', 182085802, 'Male', 2, 'approved'),
('2021619128', 'Izzo', '123', 'MUHAMMAD FAIZ BIN AZIDI', 20, 'faizkane09@gmail.com', '100, TAMAN DESA JALAN MAWAR 9, JALAN PEGAWAI 05050 ALOR SETAR, KEDAH', 1139435760, 'Male', 3, 'approved'),
('2021819166', 'irfan', '123', 'MUHAMMAD IRFAN NAFIS BIN OMAR', 20, 'irfansahaja03@gmail.com', '2505,1/21 Bandar Puteri Jaya, 0800,Sungai Petani,Kedah', 1151885383, 'Male', 2, 'approved'),
('2021833358', 'amsyardani', '123', 'AMSYAR DANIAL BIN MOHAMAD NIZAM', 20, 'amsyardanial0@gmail.com', '5 JALAN PERMAS 3/8 BANDAR BARU PERMAS JAYA,87150,JOHOR', 133327313, 'Male', 3, 'approved'),
('2021847782', 'ainnajjah', '123', 'NURUL AIN NAJJAH BINTI NORSAM', 20, 'ainnajjah@gmail.com', ' 28A Lorong Sungai Puloh 13C Taman Utama,42100,Selangor', 1170763866, 'Female', 3, 'approved'),
('2021856862', 'paan', '123', 'NUR MUHAMMAD FARHAN BIN AHMAD TAGUDIN', 20, 'farhan@gmail.com', '34 Jalan PJS 11/14 Taman Bandar Sunway  ,  Petaling Jaya,46150,Selangor', 132102516, 'Male', 3, 'approved'),
('2021891588', 'daneaashro', '123', 'DANEA BINTI ASHROF', 20, 'daneashrof@gmail.com', 'NO. 1 TAMAN SRI PELANG, 06000 JITRA, KEDAH', 124555077, 'Female', 2, 'approved'),
('2021896734', 'iqbalsyahmi', '123', 'MUHAMMAD IQBAL SYAHM BIN JOHARI', 20, 'iqbalSyah@gmail.com', '4021 Jalan Limau Kampung Pasir,Johor Bahru ,81200,Johor', 1124393118, 'Male', 3, 'approved');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assign`
--
ALTER TABLE `assign`
  ADD PRIMARY KEY (`ASSIGNID`),
  ADD KEY `ADMINID` (`ADMINID`),
  ADD KEY `MENTORID` (`MENTORID`),
  ADD KEY `COURSEID` (`COURSEID`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD KEY `ASSIGNID` (`ASSIGNID`),
  ADD KEY `TOPICID` (`TOPICID`),
  ADD KEY `MENTEEID` (`MENTEEID`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`COURSEID`);

--
-- Indexes for table `discuss`
--
ALTER TABLE `discuss`
  ADD PRIMARY KEY (`DISCUSSID`),
  ADD KEY `MEMBERID` (`MEMBERID`),
  ADD KEY `TOPICID_2` (`TOPICID`);
ALTER TABLE `discuss` ADD FULLTEXT KEY `TOPICID` (`TOPICID`);

--
-- Indexes for table `enroll`
--
ALTER TABLE `enroll`
  ADD PRIMARY KEY (`ENROLLID`,`USERID`,`COURSEID`),
  ADD KEY `USERID` (`USERID`),
  ADD KEY `COURSEID` (`COURSEID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`FEEDID`),
  ADD KEY `TOPICID` (`TOPICID`),
  ADD KEY `MEMBERID` (`MEMBERID`);

--
-- Indexes for table `mentee`
--
ALTER TABLE `mentee`
  ADD KEY `ASSIGNID` (`ASSIGNID`),
  ADD KEY `MENTEEID` (`MENTEEID`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`RESULTID`),
  ADD KEY `USERID` (`USERID`);

--
-- Indexes for table `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`TOPICID`),
  ADD KEY `ASSIGNID` (`ASSIGNID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`USERID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `discuss`
--
ALTER TABLE `discuss`
  MODIFY `DISCUSSID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=500007;

--
-- AUTO_INCREMENT for table `enroll`
--
ALTER TABLE `enroll`
  MODIFY `ENROLLID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=300014;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `FEEDID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=700007;

--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `RESULTID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100014;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assign`
--
ALTER TABLE `assign`
  ADD CONSTRAINT `assign_ibfk_1` FOREIGN KEY (`ADMINID`) REFERENCES `user` (`USERID`),
  ADD CONSTRAINT `assign_ibfk_2` FOREIGN KEY (`MENTORID`) REFERENCES `user` (`USERID`),
  ADD CONSTRAINT `assign_ibfk_3` FOREIGN KEY (`COURSEID`) REFERENCES `course` (`COURSEID`);

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`ASSIGNID`) REFERENCES `assign` (`ASSIGNID`),
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`TOPICID`) REFERENCES `topic` (`TOPICID`),
  ADD CONSTRAINT `attendance_ibfk_3` FOREIGN KEY (`MENTEEID`) REFERENCES `mentee` (`MENTEEID`);

--
-- Constraints for table `discuss`
--
ALTER TABLE `discuss`
  ADD CONSTRAINT `discuss_ibfk_1` FOREIGN KEY (`TOPICID`) REFERENCES `topic` (`TOPICID`),
  ADD CONSTRAINT `discuss_ibfk_2` FOREIGN KEY (`MEMBERID`) REFERENCES `user` (`USERID`);

--
-- Constraints for table `enroll`
--
ALTER TABLE `enroll`
  ADD CONSTRAINT `enroll_ibfk_1` FOREIGN KEY (`USERID`) REFERENCES `user` (`USERID`),
  ADD CONSTRAINT `enroll_ibfk_2` FOREIGN KEY (`COURSEID`) REFERENCES `course` (`COURSEID`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`TOPICID`) REFERENCES `topic` (`TOPICID`),
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`MEMBERID`) REFERENCES `user` (`USERID`);

--
-- Constraints for table `mentee`
--
ALTER TABLE `mentee`
  ADD CONSTRAINT `mentee_ibfk_1` FOREIGN KEY (`ASSIGNID`) REFERENCES `assign` (`ASSIGNID`),
  ADD CONSTRAINT `mentee_ibfk_2` FOREIGN KEY (`MENTEEID`) REFERENCES `user` (`USERID`);

--
-- Constraints for table `result`
--
ALTER TABLE `result`
  ADD CONSTRAINT `result_ibfk_1` FOREIGN KEY (`USERID`) REFERENCES `user` (`USERID`);

--
-- Constraints for table `topic`
--
ALTER TABLE `topic`
  ADD CONSTRAINT `topic_ibfk_1` FOREIGN KEY (`ASSIGNID`) REFERENCES `assign` (`ASSIGNID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
