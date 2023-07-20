-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 18, 2023 at 03:26 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sl-police`
--

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

CREATE TABLE `complaint` (
  `complaint_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `complaint_type` varchar(75) NOT NULL,
  `complaint_title` varchar(250) NOT NULL,
  `audio_src` varchar(400) DEFAULT NULL,
  `complaint_text` varchar(6000) NOT NULL,
  `complaint_status` varchar(10) NOT NULL,
  `empID` varchar(10) NOT NULL,
  `location_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaint`
--

INSERT INTO `complaint` (`complaint_id`, `date`, `complaint_type`, `complaint_title`, `audio_src`, `complaint_text`, `complaint_status`, `empID`, `location_id`) VALUES
(1, '2023-06-12', 'Bribery and Corruption', 'An attempted bribe during school admission', '..assets/uploads/complaint-recordings/1.mp3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Ongoing', 'EMP0001', 2),
(2, '2023-07-03', 'Traffic & Road Safety', 'Committed road rule violation on Road B67', 'N/A', 'Ignored the police stop sign and continued to drive.', 'Ongoing', 'EMP0002', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `court_order`
--

CREATE TABLE `court_order` (
  `complaint_id` int(11) NOT NULL,
  `nic` varchar(15) NOT NULL,
  `next_court_date` date NOT NULL,
  `previous_court_dates` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `court_order`
--

INSERT INTO `court_order` (`complaint_id`, `nic`, `next_court_date`, `previous_court_dates`) VALUES
(1, '198044377789', '2023-08-15', ''),
(1, '199078675523', '2023-08-30', '');

-- --------------------------------------------------------

--
-- Table structure for table `duty`
--

CREATE TABLE `duty` (
  `empID` varchar(10) NOT NULL,
  `duty_type` varchar(40) NOT NULL,
  `duty_cause` varchar(30) DEFAULT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `duty`
--

INSERT INTO `duty` (`empID`, `duty_type`, `duty_cause`, `start`, `end`, `location_id`) VALUES
('EMP0001', 'General', NULL, '2023-07-18 06:30:00', '2023-07-18 17:30:00', 3),
('EMP0002', 'Special', 'Special Office Request', '2023-07-23 06:00:00', '2023-07-24 06:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emplD` varchar(10) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `tel_no` varchar(10) NOT NULL,
  `address` varchar(250) NOT NULL,
  `nic` varchar(15) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `appointment_date` date NOT NULL,
  `marital_status` varchar(20) NOT NULL,
  `rank` varchar(20) NOT NULL,
  `retired_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emplD`, `first_name`, `last_name`, `dob`, `email`, `tel_no`, `address`, `nic`, `gender`, `appointment_date`, `marital_status`, `rank`, `retired_status`) VALUES
('EMP0001', 'Sisira', 'Fernando', '1973-02-12', 'sisirafernando@gmail.com', '0716778898', '34/1 A, King Street, Passara Rd, Badulla', '197312400034', 'Male', '1993-04-26', 'Married', 'IP', 0),
('EMP0002', 'Nayanamali', 'Jeewanthi', '1975-10-20', 'njeewanthi@gmail.com', '0744423111', 'No 5, Flower Rd, Hali Ela', '197558600011', 'Female', '1997-01-06', 'Married', 'WPC', 0),
('EMP0003', 'Saman', 'Krishnakumar', '1960-06-20', '', '0768907867', '15/23 C, Kolonna Rd, Meegahakiula\r\n', '196022300089', 'Male', '1980-03-10', 'Unmarried', 'ASP', 1);

-- --------------------------------------------------------

--
-- Table structure for table `evidence`
--

CREATE TABLE `evidence` (
  `complaint_id` int(11) NOT NULL,
  `nic` varchar(15) NOT NULL,
  `eyewitness_description` varchar(500) DEFAULT NULL,
  `fingerprint_description` varchar(500) DEFAULT NULL,
  `photo_description` varchar(500) DEFAULT NULL,
  `court_medical_reports` varchar(500) DEFAULT NULL,
  `accident_chart` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `evidence`
--

INSERT INTO `evidence` (`complaint_id`, `nic`, `eyewitness_description`, `fingerprint_description`, `photo_description`, `court_medical_reports`, `accident_chart`) VALUES
(1, '198044377789', NULL, NULL, '../uploads/case-imagery/1-1.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fine`
--

CREATE TABLE `fine` (
  `complaint_id` int(11) NOT NULL,
  `nic` varchar(15) NOT NULL,
  `vehicle_number` varchar(10) DEFAULT NULL,
  `temp_license_start_date` date DEFAULT NULL,
  `temp_license_end_date` date DEFAULT NULL,
  `fine_amount` double NOT NULL,
  `fine_status` tinyint(1) NOT NULL,
  `license_issued` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fine`
--

INSERT INTO `fine` (`complaint_id`, `nic`, `vehicle_number`, `temp_license_start_date`, `temp_license_end_date`, `fine_amount`, `fine_status`, `license_issued`) VALUES
(2, '199078675523', 'BST-8998', '2023-07-10', '2023-07-24', 2000, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `leaveID` int(11) NOT NULL,
  `empID` varchar(10) NOT NULL,
  `leave_start` date NOT NULL,
  `leave_end` date NOT NULL,
  `reason_type` varchar(50) NOT NULL,
  `reason` varchar(500) DEFAULT NULL,
  `medical` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`leaveID`, `empID`, `leave_start`, `leave_end`, `reason_type`, `reason`, `medical`) VALUES
(1, 'EMP0001', '2023-07-25', '2023-07-27', 'Personal', 'Will be going out of town for a personal matter.', NULL),
(2, 'EMP0002', '2023-07-16', '2023-07-17', 'Health', 'Medical clinic', '../uploads/medicals/EMP0002.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `location_id` int(11) NOT NULL,
  `location_name` varchar(30) DEFAULT NULL,
  `district` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_id`, `location_name`, `district`, `city`, `latitude`, `longitude`) VALUES
(1, 'Crime Scene', 'Badulla', 'Mawanagama', 7.59698, 81.1527),
(2, 'Crime Scene', 'Badulla', 'Liyangahawela', 6.81189, 81.0299),
(3, 'Office', 'Badulla', 'Badulla', 6.9934, 81.055);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `empID` varchar(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`empID`, `username`, `password`, `role`) VALUES
('EMP0001', 'U0001', '1234', 'user'),
('EMP0002', 'A0003', '1234', 'admin'),
('EMP0003', 'U0003', '1234', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE `people` (
  `nic` varchar(15) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(400) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`nic`, `name`, `address`, `contact`, `email`) VALUES
('198044377789', 'K.M.P Bandara', '12/45 R, Kuttiyagolla, Badulla', '0778978666', 'pramoadbandara@gmail.com'),
('198077665823', 'A.B Silva', 'No 3, Temple Rd, Kendagolla', '0712334456', NULL),
('199078675523', 'M.N.N Karunaratne', 'No 8/1 C, Polwatte Road, Lunugala', '0713423288', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_in_case`
--

CREATE TABLE `role_in_case` (
  `nic` varchar(15) NOT NULL,
  `role_in_case` varchar(30) NOT NULL,
  `complaint_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role_in_case`
--

INSERT INTO `role_in_case` (`nic`, `role_in_case`, `complaint_id`) VALUES
('198044377789', 'Plantiff', 1),
('199078675523', 'Culprit', 2),
('199078675523', 'Suspect', 1);

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `empID` varchar(10) NOT NULL,
  `base_salary` float NOT NULL,
  `service_years` int(11) NOT NULL,
  `bartar_amount` float DEFAULT NULL,
  `total_salary` float DEFAULT NULL,
  `pension_amount` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`empID`, `base_salary`, `service_years`, `bartar_amount`, `total_salary`, `pension_amount`) VALUES
('EMP0001', 30000, 30, 400, 42000, NULL),
('EMP0002', 35000, 26, 450, 46700, NULL),
('EMP0003', 30000, 40, NULL, NULL, 30000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `complaint`
--
ALTER TABLE `complaint`
  ADD PRIMARY KEY (`complaint_id`),
  ADD KEY `empID` (`empID`),
  ADD KEY `location_id` (`location_id`);

--
-- Indexes for table `court_order`
--
ALTER TABLE `court_order`
  ADD KEY `complaint_id` (`complaint_id`),
  ADD KEY `nic` (`nic`);

--
-- Indexes for table `duty`
--
ALTER TABLE `duty`
  ADD KEY `empID` (`empID`),
  ADD KEY `location_id` (`location_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emplD`);

--
-- Indexes for table `evidence`
--
ALTER TABLE `evidence`
  ADD KEY `complaint_id` (`complaint_id`),
  ADD KEY `nic` (`nic`);

--
-- Indexes for table `fine`
--
ALTER TABLE `fine`
  ADD KEY `complaint_id` (`complaint_id`),
  ADD KEY `fine_ibfk_2` (`nic`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`leaveID`),
  ADD KEY `empID` (`empID`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD KEY `empID` (`empID`);

--
-- Indexes for table `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`nic`);

--
-- Indexes for table `role_in_case`
--
ALTER TABLE `role_in_case`
  ADD KEY `complaint_id` (`complaint_id`),
  ADD KEY `nic` (`nic`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD KEY `empID` (`empID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `complaint`
--
ALTER TABLE `complaint`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `leaveID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `complaint`
--
ALTER TABLE `complaint`
  ADD CONSTRAINT `complaint_ibfk_1` FOREIGN KEY (`empID`) REFERENCES `employee` (`emplD`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `complaint_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `court_order`
--
ALTER TABLE `court_order`
  ADD CONSTRAINT `court_order_ibfk_1` FOREIGN KEY (`complaint_id`) REFERENCES `complaint` (`complaint_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `court_order_ibfk_2` FOREIGN KEY (`nic`) REFERENCES `people` (`nic`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `duty`
--
ALTER TABLE `duty`
  ADD CONSTRAINT `duty_ibfk_1` FOREIGN KEY (`empID`) REFERENCES `employee` (`emplD`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `duty_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `evidence`
--
ALTER TABLE `evidence`
  ADD CONSTRAINT `evidence_ibfk_1` FOREIGN KEY (`complaint_id`) REFERENCES `complaint` (`complaint_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `evidence_ibfk_2` FOREIGN KEY (`nic`) REFERENCES `people` (`nic`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fine`
--
ALTER TABLE `fine`
  ADD CONSTRAINT `fine_ibfk_1` FOREIGN KEY (`complaint_id`) REFERENCES `complaint` (`complaint_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fine_ibfk_2` FOREIGN KEY (`nic`) REFERENCES `people` (`nic`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `leaves`
--
ALTER TABLE `leaves`
  ADD CONSTRAINT `leaves_ibfk_1` FOREIGN KEY (`empID`) REFERENCES `employee` (`emplD`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`empID`) REFERENCES `employee` (`emplD`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_in_case`
--
ALTER TABLE `role_in_case`
  ADD CONSTRAINT `role_in_case_ibfk_1` FOREIGN KEY (`complaint_id`) REFERENCES `complaint` (`complaint_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_in_case_ibfk_2` FOREIGN KEY (`nic`) REFERENCES `people` (`nic`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `salary`
--
ALTER TABLE `salary`
  ADD CONSTRAINT `salary_ibfk_1` FOREIGN KEY (`empID`) REFERENCES `employee` (`emplD`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
