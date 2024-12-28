-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2024 at 05:21 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(127) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(127) NOT NULL,
  `lname` varchar(127) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`, `fname`, `lname`) VALUES
(1, 'admin', '$2y$10$H7obJEdmLzqqcPy7wQWhsOLUvrgzC8f1Y1or2Gxaza5z1PT0tvLy6', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `courseCode` varchar(10) NOT NULL,
  `courseTitle` varchar(100) NOT NULL,
  `credit` varchar(5) NOT NULL,
  `type` varchar(10) NOT NULL,
  `semester` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`courseCode`, `courseTitle`, `credit`, `type`, `semester`) VALUES
('CSE E-1CSE', 'Elective Course', '3.0', 'Theory', '5th'),
('CSE101', 'Introduction to Computer Science', '3.0', 'Theory', '1st'),
('CSE102', 'Programming Fundamentals', '3.0', 'Theory', '1st'),
('CSE102L', 'Programming Fundamentals Lab', '1.5', 'Lab', '1st'),
('CSE111', 'Data Structures and Algorithms', '3.0', 'Theory', '2nd'),
('CSE111L', 'Data Structures and Algorithms Lab', '1.5', 'Lab', '2nd'),
('CSE121', 'Object-Oriented Programming', '3.0', 'Theory', '2nd'),
('CSE121L', 'Object-Oriented Programming Lab', '1.5', 'Lab', '2nd'),
('CSE201', 'Digital Logic Design', '3.0', 'Theory', '3rd'),
('CSE201L', 'Digital Logic Design Lab', '1.5', 'Lab', '3rd'),
('CSE211', 'Computer Organization and Architecture', '3.0', 'Theory', '3rd'),
('CSE211L', 'Computer Organization and Architecture Lab', '1.5', 'Lab', '3rd'),
('CSE221', 'Operating Systems', '3.0', 'Theory', '3rd'),
('CSE221L', 'Operating Systems Lab', '1.5', 'Lab', '3rd'),
('CSE231', 'Database Systems', '3.0', 'Theory', '4th'),
('CSE231L', 'Database Systems Lab', '1.5', 'Lab', '4th'),
('CSE241', 'Computer Networks', '3.0', 'Theory', '4th'),
('CSE241L', 'Computer Networks Lab', '1.5', 'Lab', '4th'),
('CSE251', 'Software Engineering', '3.0', 'Theory', '4th'),
('CSE251P', 'Software Engineering Project', '1.0', 'Project', '4th'),
('CSE301', 'Algorithm Design and Analysis', '3.0', 'Theory', '5th'),
('CSE311', 'Artificial Intelligence', '3.0', 'Theory', '5th'),
('CSE321', 'Computer Graphics', '3.0', 'Theory', '5th'),
('CSE321L', 'Computer Graphics Lab', '1.5', 'Lab', '5th'),
('CSE331', 'Web Technologies', '3.0', 'Theory', '6th'),
('CSE331L', 'Web Technologies Lab', '1.5', 'Lab', '6th'),
('CSE341', 'Computer Security', '3.0', 'Theory', '6th'),
('CSE341L', 'Computer Security Lab', '1.5', 'Lab', '6th'),
('CSE401', 'Compiler Design', '3.0', 'Theory', '7th'),
('CSE411', 'Machine Learning', '3.0', 'Theory', '7th'),
('CSE411L', 'Machine Learning Lab', '1.5', 'Lab', '7th'),
('CSE421', 'Data Mining', '3.0', 'Theory', '7th'),
('CSE421L', 'Data Mining Lab', '1.5', 'Lab', '7th'),
('CSE431', 'Cloud Computing', '3.0', 'Theory', '8th'),
('CSE431L', 'Cloud Computing Lab', '1.5', 'Lab', '8th'),
('CSE441', 'Mobile Computing', '3.0', 'Theory', '8th'),
('CSE441L', 'Mobile Computing Lab', '1.5', 'Lab', '8th'),
('CSE451', 'Capstone Project', '3.0', 'Project', '8th'),
('CSEE02', 'Elective Course-02', '3.0', 'Theory', '6th'),
('MAT101', 'Calculus I', '3.0', 'Theory', '1st'),
('MAT102', 'Calculus II', '3.0', 'Theory', '2nd'),
('PHY101', 'Physics I', '3.0', 'Theory', '1st'),
('PHY101L', 'Physics I Lab', '1.5', 'Lab', '1st'),
('PHY102', 'Physics II', '3.0', 'Theory', '2nd'),
('PHY102L', 'Physics II Lab', '1.5', 'Lab', '2nd');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `depId` int(11) NOT NULL,
  `deptName` varchar(255) DEFAULT NULL,
  `deptHead` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quarterly_grades`
--

CREATE TABLE `quarterly_grades` (
  `id` int(11) NOT NULL,
  `student_id` varchar(255) DEFAULT NULL,
  `course_name` varchar(255) DEFAULT NULL,
  `first_quarter` decimal(5,2) DEFAULT NULL,
  `second_quarter` decimal(5,2) DEFAULT NULL,
  `overall` decimal(5,2) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `academic_year` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quarterly_grades`
--

INSERT INTO `quarterly_grades` (`id`, `student_id`, `course_name`, `first_quarter`, `second_quarter`, `overall`, `remarks`, `academic_year`) VALUES
(1, '13', 'MS101', 95.00, 95.00, 95.00, 'Passed', '2024-2025'),
(2, '1', 'SIA101', 85.00, 75.00, 80.00, 'Passed', '2024-2025');

-- --------------------------------------------------------

--
-- Table structure for table `register_std_course`
--

CREATE TABLE `register_std_course` (
  `std_id` int(11) DEFAULT NULL,
  `std_name` varchar(250) DEFAULT NULL,
  `courseTitle` varchar(100) DEFAULT NULL,
  `courseCode` varchar(200) DEFAULT NULL,
  `credit` varchar(5) DEFAULT NULL,
  `semester` varchar(20) DEFAULT NULL,
  `year` varchar(4) DEFAULT NULL,
  `semester_no` varchar(10) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `section` varchar(10) DEFAULT NULL,
  `intake` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `tech_id` varchar(200) DEFAULT NULL,
  `std_id` varchar(200) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `courseCode` varchar(200) DEFAULT NULL,
  `courseName` varchar(200) DEFAULT NULL,
  `credit` varchar(200) DEFAULT NULL,
  `semester` varchar(200) DEFAULT NULL,
  `year` varchar(200) DEFAULT NULL,
  `section` varchar(200) DEFAULT NULL,
  `intake` varchar(200) DEFAULT NULL,
  `mark` varchar(200) DEFAULT NULL,
  `grade` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`tech_id`, `std_id`, `department`, `courseCode`, `courseName`, `credit`, `semester`, `year`, `section`, `intake`, `mark`, `grade`) VALUES
('8', '13', 'Computer Science & Engineering', 'CSE101', 'Introduction to Computer Science', '3.0', 'Spring', '2024', '1', '1', '85', 'A+'),
('8', '16', 'Computer Science & Engineering', 'CSE101', 'Introduction to Computer Science', '3.0', 'Spring', '2024', '1', '1', '70', 'A-'),
('8', '17', 'Computer Science & Engineering', 'CSE101', 'Introduction to Computer Science', '3.0', 'Spring', '2024', '1', '1', '85', 'A+'),
('8', '29', 'Computer Science & Engineering', 'CSE101', 'Introduction to Computer Science', '3.0', 'Spring', '2024', '1', '1', '70', 'A-'),
('8', '30', 'Computer Science & Engineering', 'CSE101', 'Introduction to Computer Science', '3.0', 'Spring', '2024', '1', '1', '85', 'A+'),
('8', '31', 'Computer Science & Engineering', 'CSE101', 'Introduction to Computer Science', '3.0', 'Spring', '2024', '1', '1', '85', 'A+'),
('8', '32', 'Computer Science & Engineering', 'CSE101', 'Introduction to Computer Science', '3.0', 'Spring', '2024', '1', '1', '70', 'A-'),
('8', '33', 'Computer Science & Engineering', 'CSE101', 'Introduction to Computer Science', '3.0', 'Spring', '2024', '1', '1', '85', 'A+'),
('8', '13', 'Computer Science & Engineering', 'CSE102', 'Programming Fundamentals', '3.0', 'Spring', '2024', '1', '1', '85', 'A+'),
('8', '16', 'Computer Science & Engineering', 'CSE102', 'Programming Fundamentals', '3.0', 'Spring', '2024', '1', '1', '70', 'A-'),
('8', '17', 'Computer Science & Engineering', 'CSE102', 'Programming Fundamentals', '3.0', 'Spring', '2024', '1', '1', '85', 'A+'),
('8', '29', 'Computer Science & Engineering', 'CSE102', 'Programming Fundamentals', '3.0', 'Spring', '2024', '1', '1', '85', 'A+'),
('8', '30', 'Computer Science & Engineering', 'CSE102', 'Programming Fundamentals', '3.0', 'Spring', '2024', '1', '1', '70', 'A-'),
('8', '31', 'Computer Science & Engineering', 'CSE102', 'Programming Fundamentals', '3.0', 'Spring', '2024', '1', '1', '50', 'C+'),
('8', '32', 'Computer Science & Engineering', 'CSE102', 'Programming Fundamentals', '3.0', 'Spring', '2024', '1', '1', '70', 'A-'),
('8', '33', 'Computer Science & Engineering', 'CSE102', 'Programming Fundamentals', '3.0', 'Spring', '2024', '1', '1', '70', 'A-'),
('8', '13', 'Computer Science & Engineering', 'CSE102L', 'Programming Fundamentals Lab', '1.5', 'Spring', '2024', '1', '1', '70', 'A-'),
('8', '16', 'Computer Science & Engineering', 'CSE102L', 'Programming Fundamentals Lab', '1.5', 'Spring', '2024', '1', '1', '85', 'A+'),
('8', '17', 'Computer Science & Engineering', 'CSE102L', 'Programming Fundamentals Lab', '1.5', 'Spring', '2024', '1', '1', '70', 'A-'),
('8', '29', 'Computer Science & Engineering', 'CSE102L', 'Programming Fundamentals Lab', '1.5', 'Spring', '2024', '1', '1', '70', 'A-'),
('8', '30', 'Computer Science & Engineering', 'CSE102L', 'Programming Fundamentals Lab', '1.5', 'Spring', '2024', '1', '1', '70', 'A-'),
('8', '31', 'Computer Science & Engineering', 'CSE102L', 'Programming Fundamentals Lab', '1.5', 'Spring', '2024', '1', '1', '85', 'A+'),
('8', '32', 'Computer Science & Engineering', 'CSE102L', 'Programming Fundamentals Lab', '1.5', 'Spring', '2024', '1', '1', '85', 'A+'),
('8', '33', 'Computer Science & Engineering', 'CSE102L', 'Programming Fundamentals Lab', '1.5', 'Spring', '2024', '1', '1', '85', 'A+'),
('14', '13', 'Computer Science & Engineering', 'MAT101', 'Calculus I', '3.0', 'Spring', '2024', '1', '1', '85', 'A+'),
('14', '16', 'Computer Science & Engineering', 'MAT101', 'Calculus I', '3.0', 'Spring', '2024', '1', '1', '85', 'A+'),
('14', '17', 'Computer Science & Engineering', 'MAT101', 'Calculus I', '3.0', 'Spring', '2024', '1', '1', '70', 'A-'),
('14', '29', 'Computer Science & Engineering', 'MAT101', 'Calculus I', '3.0', 'Spring', '2024', '1', '1', '70', 'A-'),
('14', '30', 'Computer Science & Engineering', 'MAT101', 'Calculus I', '3.0', 'Spring', '2024', '1', '1', '85', 'A+'),
('14', '31', 'Computer Science & Engineering', 'MAT101', 'Calculus I', '3.0', 'Spring', '2024', '1', '1', '13', 'F'),
('14', '32', 'Computer Science & Engineering', 'MAT101', 'Calculus I', '3.0', 'Spring', '2024', '1', '1', '70', 'A-'),
('14', '33', 'Computer Science & Engineering', 'MAT101', 'Calculus I', '3.0', 'Spring', '2024', '1', '1', '85', 'A+'),
('14', '13', 'Computer Science & Engineering', 'PHY101', 'Physics I', '3.0', 'Spring', '2024', '1', '1', '85', 'A+'),
('14', '16', 'Computer Science & Engineering', 'PHY101', 'Physics I', '3.0', 'Spring', '2024', '1', '1', '85', 'A+'),
('14', '17', 'Computer Science & Engineering', 'PHY101', 'Physics I', '3.0', 'Spring', '2024', '1', '1', '85', 'A+'),
('14', '29', 'Computer Science & Engineering', 'PHY101', 'Physics I', '3.0', 'Spring', '2024', '1', '1', '85', 'A+'),
('14', '30', 'Computer Science & Engineering', 'PHY101', 'Physics I', '3.0', 'Spring', '2024', '1', '1', '85', 'A+'),
('14', '31', 'Computer Science & Engineering', 'PHY101', 'Physics I', '3.0', 'Spring', '2024', '1', '1', '50', 'C+'),
('14', '32', 'Computer Science & Engineering', 'PHY101', 'Physics I', '3.0', 'Spring', '2024', '1', '1', '85', 'A+'),
('14', '33', 'Computer Science & Engineering', 'PHY101', 'Physics I', '3.0', 'Spring', '2024', '1', '1', '85', 'A+'),
('14', '13', 'Computer Science & Engineering', 'PHY101L', 'Physics I Lab', '1.5', 'Spring', '2024', '1', '1', '85', 'A+'),
('14', '16', 'Computer Science & Engineering', 'PHY101L', 'Physics I Lab', '1.5', 'Spring', '2024', '1', '1', '85', 'A+'),
('14', '17', 'Computer Science & Engineering', 'PHY101L', 'Physics I Lab', '1.5', 'Spring', '2024', '1', '1', '85', 'A+'),
('14', '29', 'Computer Science & Engineering', 'PHY101L', 'Physics I Lab', '1.5', 'Spring', '2024', '1', '1', '85', 'A+'),
('14', '30', 'Computer Science & Engineering', 'PHY101L', 'Physics I Lab', '1.5', 'Spring', '2024', '1', '1', '85', 'A+'),
('14', '31', 'Computer Science & Engineering', 'PHY101L', 'Physics I Lab', '1.5', 'Spring', '2024', '1', '1', '85', 'A+'),
('14', '32', 'Computer Science & Engineering', 'PHY101L', 'Physics I Lab', '1.5', 'Spring', '2024', '1', '1', '85', 'A+'),
('14', '33', 'Computer Science & Engineering', 'PHY101L', 'Physics I Lab', '1.5', 'Spring', '2024', '1', '1', '85', 'A+');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `strand_id` int(11) DEFAULT NULL,
  `subject_code` varchar(10) NOT NULL,
  `subject_description` varchar(255) NOT NULL,
  `professor` varchar(100) NOT NULL,
  `schedule` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `strand_id`, `subject_code`, `subject_description`, `professor`, `schedule`) VALUES
(3, 4, 'SIA101', 'Systems Integration and Architecture 1', 'Rose Anne Tanjente', 'Thursday | 9:00AM-11:00AM/1:00AM-4:00PM'),
(4, 4, 'MS101', 'Discrete Mathematics', 'Maria Aura Impang', 'TUESDAY | 11:00AM-2:00PM');

-- --------------------------------------------------------

--
-- Table structure for table `sem_course_list`
--

CREATE TABLE `sem_course_list` (
  `dept` varchar(100) DEFAULT NULL,
  `year` varchar(100) DEFAULT NULL,
  `semester` varchar(100) DEFAULT NULL,
  `intake` varchar(255) DEFAULT NULL,
  `section` varchar(255) DEFAULT NULL,
  `semno` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sem_course_list`
--

INSERT INTO `sem_course_list` (`dept`, `year`, `semester`, `intake`, `section`, `semno`) VALUES
('Computer Science & Engineering', '2024', 'Spring', '1', '1', '1st'),
('Computer Science & Engineering', '2024', 'Fall', '1', '1', '2nd'),
('Computer Science & Engineering', '2025', 'Spring', '1', '1', '3rd'),
('Computer Science & Engineering', '2025', 'Fall', '1', '1', '4th'),
('Computer Science & Engineering', '2026', 'Spring', '1', '1', '5th'),
('Computer Science & Engineering', '2026', 'Fall', '1', '1', '6th'),
('Computer Science & Engineering', '2027', 'Spring', '1', '1', '7th'),
('Computer Science & Engineering', '2027', 'Fall', '1', '1', '8th'),
('Computer Science & Engineering', '2024', 'Fall', '2', '1', '1st'),
('Computer Science & Engineering', '2025', 'Spring', '2', '1', '2nd'),
('Computer Science & Engineering', '2025', 'Fall', '2', '1', '3rd'),
('Computer Science & Engineering', '2026', 'Spring', '2', '1', '4th'),
('Computer Science & Engineering', '2026', 'Fall', '2', '1', '5th'),
('Computer Science & Engineering', '2027', 'Spring', '2', '1', '6th'),
('Computer Science & Engineering', '2027', 'Fall', '2', '1', '7th'),
('Computer Science & Engineering', '2028', 'Spring', '2', '1', '8th');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `current_year` int(11) NOT NULL,
  `current_semester` varchar(11) NOT NULL,
  `school_name` varchar(100) NOT NULL,
  `slogan` varchar(300) NOT NULL,
  `about` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`current_year`, `current_semester`, `school_name`, `slogan`, `about`) VALUES
(2024, '1st Quarter', 'Student Information System - UNILINK', 'Your Source for Academic Information', 'This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.');

-- --------------------------------------------------------

--
-- Table structure for table `strands`
--

CREATE TABLE `strands` (
  `strand_id` int(11) NOT NULL,
  `strand_name` varchar(100) NOT NULL,
  `strand_code` varchar(20) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `strands`
--

INSERT INTO `strands` (`strand_id`, `strand_name`, `strand_code`, `description`) VALUES
(1, 'Science, Technology, Engineering, and Mathematics', 'STEM', 'STEM strand focuses on science, technology, engineering, and mathematics'),
(2, 'Accountancy, Business, and Management', 'ABM', 'ABM strand focuses on basic business and financial management principles'),
(3, 'Humanities and Social Sciences', 'HUMSS', 'HUMSS strand focuses on literature, philosophy, social sciences'),
(4, 'Information Communication and Technology', 'ICT', 'Information Communication and Technology for students with varied interests');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(12) NOT NULL,
  `lrn` varchar(12) DEFAULT NULL,
  `username` varchar(127) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(127) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `section` int(11) NOT NULL,
  `address` varchar(31) NOT NULL,
  `gender` varchar(7) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `date_of_joined` timestamp NULL DEFAULT current_timestamp(),
  `parent_fname` varchar(127) NOT NULL,
  `parent_lname` varchar(127) NOT NULL,
  `parent_phone_number` varchar(31) NOT NULL,
  `intake` varchar(30) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `semester` varchar(100) DEFAULT NULL,
  `year` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `lrn`, `username`, `password`, `fname`, `lname`, `section`, `address`, `gender`, `email_address`, `date_of_birth`, `date_of_joined`, `parent_fname`, `parent_lname`, `parent_phone_number`, `intake`, `department`, `semester`, `year`) VALUES
(1, '136603090064', 'miguel', '$2y$10$hcAHJQrMWLtcs/eEp8/JGOz.hB8PF4U0dpZe.fty5uJXk4veHEHSy', 'Miguel Enrique ', 'Dasalla', 1, 'Bagong Silang Caloocan City', 'Male', 'miguel@gmail.com', '2003-12-23', '2024-05-13 18:36:14', 'N/A', 'N/A', 'N/A', '1', 'ICT', '1st Quarter', '2024'),
(2, '000000000000', 'powell', '$2y$10$e9B1ZNRv/Q8ZGsIvJ6FlNu7bK4RYiClVC1WLIL//a8cjVzWmxTtsK', 'John Powell ', 'Delos Santos', 1, 'La Mesa Dam', 'Male', 'powell@gmail.com', '2024-12-06', '2024-12-06 15:16:10', 'N/A', 'N/A', 'N/A', '1', 'ICT', '1st Quarter', '2024'),
(36, '000000000001', 'znarf', '$2y$10$GmVvZAilosWQCzU.ZgEzduwpcquF1Djp5B./hqli0Lxs2HCJO9j7G', 'Franz Jeremy', 'Señora', 1, 'Kiko Camarin Caloocan City', 'Male', 'franz@gmail.com', '2003-06-07', '2024-12-12 04:12:22', 'N/A', 'N/A', 'N/A', '1', 'ICT', '1st Quarter', '2024');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`depId`);

--
-- Indexes for table `quarterly_grades`
--
ALTER TABLE `quarterly_grades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_schedule_strand` (`strand_id`);

--
-- Indexes for table `strands`
--
ALTER TABLE `strands`
  ADD PRIMARY KEY (`strand_id`),
  ADD UNIQUE KEY `strand_code` (`strand_code`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `lrn` (`lrn`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `depId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `quarterly_grades`
--
ALTER TABLE `quarterly_grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `strands`
--
ALTER TABLE `strands`
  MODIFY `strand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `fk_schedule_strand` FOREIGN KEY (`strand_id`) REFERENCES `strands` (`strand_id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
