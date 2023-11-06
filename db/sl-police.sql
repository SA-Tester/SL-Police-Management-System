-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 06, 2023 at 10:36 AM
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
(1, '2023-06-14', 'Bribery and Corruption', 'An attempted bribe during school admission', '../uploads/complaint-recordings/Rec-1.mp3', 'An amount of 500000 LKR was requested as bribe during my daughter\'s admission to XYZ girls\' school in Badulla.', 'Ongoing', 'EMP0001', 2),
(2, '2023-07-03', 'Traffic & Road Safety', 'Committed road rule violation on Road B67', NULL, 'Ignored the police stop sign and continued to drive.', 'Ongoing', 'EMP0002', NULL),
(15, '2023-07-22', 'Appreciation', 'Appreciating Service', NULL, 'Appreciating service of the traffic officer assigned near Uva College.', 'Ongoing', 'EMP0002', NULL),
(22, '2023-07-22', 'Traffic & Road Safety', 'Not obeying the traffic light signals', NULL, 'The suspect did not stop at the \"Red\" colour light. Instead he sped up causing a possible threat to pedestrians.', 'Resolved', 'EMP0001', NULL),
(25, '2023-07-22', 'Traffic & Road Safety', 'Honking near a hospital ignoring police warnings.', NULL, 'The suspect honked loud ignoring the warning and the advices of the police officer near the Badulla general hospital.', 'Ongoing', 'EMP0001', 13),
(26, '2023-07-24', 'Foreign Employment Issue', 'House maid harresment in Saudi Arabia', '../uploads/complaint-recordings/Rec-26.mp3', 'Mrs K.D Samanthi, my wife, is being harassed in Saudi Arabia. She was sent to that country during last September (2022) . She is currently being subjected to severe domestic violence and the agency is not taking necessary actions to bring her back to this country.', 'Ongoing', 'EMP0002', 14),
(27, '2023-07-24', 'Illegal Mining', 'Illegal Mining site in Badulu Oya valley', '../uploads/complaint-recordings/Rec-27.mp3', 'An illegal mining site was found in Badulu Oya, 2-3 km upper in the Bandarapura Road, near the old bridge.', 'Ongoing', 'EMP0001', 15),
(29, '2023-07-23', 'Information', 'Misuse of office information', NULL, 'Mr K.B Kumara, a minor staff member of Sena Holdings is suspected with handing over office secrets to potential competitors of the business.', 'Ongoing', 'EMP0001', 20),
(31, '2023-07-25', 'House Breaking', 'A house breaking reported in Bibilegama', NULL, 'The house number 44, Badulla Rd, Bibilegama has subjected to house breaking on 24th July 2023. Most of the house property has been misplaced after the theft.', 'Ongoing', 'EMP0001', 21),
(32, '2023-07-25', 'Exchange Fault', 'Used a devalued rate for a dollar exchange', '../uploads/complaint-recordings/Rec-32.mp3', 'The exchange unit of ABC Bank used a devalued rate to exchange the foreign currencies which is very much lower than that what is recommended from the central bank.', 'Ongoing', 'EMP0002', 22),
(33, '2023-07-24', 'Intellectual Property Dispute', 'Suspected plagiarism is a popular song', NULL, 'The song ABC is published by an unknown user in all major streaming platform without any permission from the original artist.', 'Ongoing', 'EMP0002', NULL),
(40, '2023-09-05', 'Criminal Offence', 'Attempted crime in a house robbery', '../uploads/complaint-recordings/Rec-40.mp3', 'An attempt to commit a child harassment during a house robbery was reported in Damanwara, Badulla.', 'Ongoing', 'EMP0004', 40);

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
  `id` int(11) NOT NULL,
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

INSERT INTO `duty` (`id`, `empID`, `duty_type`, `duty_cause`, `start`, `end`, `location_id`) VALUES
(1, 'EMP0001', 'General', NULL, '2023-07-18 06:30:00', '2023-07-18 17:30:00', 3),
(2, 'EMP0002', 'Special', 'Special Office Request', '2023-07-23 06:00:00', '2023-07-24 06:00:00', NULL),
(4, 'EMP0002', 'Emergency', 'Robbery', '2023-07-21 12:00:00', '2023-07-21 17:00:00', NULL),
(7, 'EMP0001', 'General', 'Traffic', '2023-09-04 08:10:00', '2023-09-04 15:10:00', 2),
(8, 'EMP0004', 'Special', 'Religious Function', '2023-09-13 21:46:00', '2023-09-19 21:46:00', 3),
(10, 'EMP0002', 'General', 'Office Duty', '2023-09-04 08:00:00', '2023-09-04 10:00:00', 2),
(11, 'EMP0004', 'Special', 'Special Parade Request', '2023-09-12 07:00:00', '2023-09-14 07:00:00', 3),
(36, 'EMP0001', 'General', 'Office Duty', '2023-11-06 12:00:00', '2023-11-06 13:00:00', 3),
(37, 'EMP0001', 'Emergency', 'Crime', '2023-11-06 13:00:00', '2023-11-06 15:00:00', 77),
(38, 'EMP0001', 'Special', 'Civil Unrest', '2023-11-06 15:00:00', '2023-11-07 15:00:00', 3),
(39, 'EMP0002', 'General', 'Investigation', '2023-11-06 14:45:00', '2023-11-06 18:00:00', 13);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `empID` varchar(10) NOT NULL,
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

INSERT INTO `employee` (`empID`, `first_name`, `last_name`, `dob`, `email`, `tel_no`, `address`, `nic`, `gender`, `appointment_date`, `marital_status`, `rank`, `retired_status`) VALUES
('EMP0001', 'Sisira', 'Fernando', '1973-02-12', 'siattanayake@gmail.com', '0716778898', '34/1 A, King Street, Passara Rd, Badulla', '197312400034', 'Male', '1993-04-26', 'Married', 'IP', 0),
('EMP0002', 'Nayanamali', 'Jeewanthi', '1975-10-20', 'njeewanthi@gmail.com', '0744423111', 'No 5, Flower Rd, Hali Ela', '197558600011', 'Female', '1997-01-06', 'Married', 'WPC', 0),
('EMP0003', 'Saman', 'Krishnakumar', '1960-06-20', 'cst20076@std.uwu.ac.lk', '0768907867', '15/23 C, Kolonna Rd, Meegahakiula\r\n', '196022300089', 'Male', '1980-03-10', 'Unmarried', 'ASP', 1),
('EMP0004', 'Gimhani', 'Sandeepani', '1997-05-03', 'cst20043@std.uwu.ac.lk', '0778978675', 'No 5, ABC Rd, Ratnapura', '19978978666534', 'Female', '2021-06-05', 'Married', 'PC', 0),
('EMP0005', 'Bodhika ', 'Nishadhi ', '1980-09-03', 'cst20097@std.uwu.ac.lk', '0786756555', 'ABCd', '19607867555', 'Female', '1980-03-01', 'Married', 'IP', 1);

-- --------------------------------------------------------

--
-- Table structure for table `evidence`
--

CREATE TABLE `evidence` (
  `complaint_id` int(11) NOT NULL,
  `nic` varchar(15) DEFAULT NULL,
  `witness_description` varchar(500) DEFAULT NULL,
  `fingerprint_description` varchar(500) DEFAULT NULL,
  `photo_description` varchar(500) DEFAULT NULL,
  `court_medical_reports` varchar(500) DEFAULT NULL,
  `accident_chart` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `evidence`
--

INSERT INTO `evidence` (`complaint_id`, `nic`, `witness_description`, `fingerprint_description`, `photo_description`, `court_medical_reports`, `accident_chart`) VALUES
(1, '199923100023', 'I am the secretary of the above spoken principal. He threatened me to help in bribe committed otherwise I\'ll loose my job. This is not the first time he has committed such acts. This has happened around 3 times during my course of work, which is currently about 1 year (I started the job on 4th July 2022). He used fake projects to collect the funds, such as building fund, sports fund etc.', NULL, NULL, NULL, NULL),
(40, '199845299989', 'My niece aged 10 was subjected to this harassment. The robber tried to use my daughter as a hostage to scare us and runaway from the scene.', NULL, NULL, NULL, NULL),
(31, NULL, NULL, NULL, 'uploads/case-imagery/31P1698953401.jpeg', NULL, NULL),
(31, NULL, NULL, NULL, 'uploads/case-imagery/31P1698953524.jpeg', NULL, NULL),
(27, NULL, NULL, NULL, 'uploads/case-imagery/27P1698953865.jpeg', NULL, NULL),
(26, NULL, NULL, NULL, NULL, 'uploads/court-medicals/26F1698954522.jpeg', NULL),
(22, NULL, NULL, NULL, NULL, NULL, 'uploads/accident-charts/22P1698954690.jpeg'),
(40, NULL, NULL, 'uploads/fingerprints/40F1698955857.jpeg', NULL, NULL, NULL);

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
(2, '199078675523', 'BST-8998', '2023-07-10', '2023-07-24', 2000, 0, 0),
(22, '197789234564', 'BST-2332', '2023-07-22', '2023-08-05', 3500, 1, 1),
(25, '199578678900', 'GH-8989', '2023-07-22', '2023-08-05', 3000, 0, 0);

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
  `medical` varchar(500) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`leaveID`, `empID`, `leave_start`, `leave_end`, `reason_type`, `reason`, `medical`, `status`) VALUES
(1, 'EMP0001', '2023-07-25', '2023-07-27', 'Personal', 'Will be going out of town for a personal matter.', NULL, 2),
(2, 'EMP0002', '2023-07-16', '2023-07-17', 'Health', 'Medical clinic', '../uploads/medicals/EMP0002.pdf', 2),
(3, 'EMP0002', '2023-09-07', '2023-09-10', 'Personal', 'To go home', 'Algorithms Roadmap.png', 2),
(4, 'EMP0002', '2023-09-13', '2023-09-17', 'Health', 'Sick', 'Algorithms Roadmap.png', 2),
(5, 'EMP0001', '2023-09-08', '2023-09-11', 'Personal', 'To attend my child&#39;s new school admission procedures', 'Algorithms Roadmap.png', 2);

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
(2, 'Case Location', 'Badulla', 'Hali Ela', 6.95553, 81.0314),
(3, 'Office', 'Badulla', 'Badulla', 6.9934, 81.055),
(13, 'Case Location', 'Badulla', 'Arawa', 7.16667, 81.0833),
(14, 'Case Location', 'Badulla', 'Pitamaruwa', 7.11015, 81.1592),
(15, 'Case Location', 'Badulla', 'Baduluoya', 7.12483, 81.0303),
(20, 'Case Location', 'Badulla', 'Kalupahana', 6.79101, 80.8454),
(21, 'Case Location', 'Badulla', 'Bibilegama', 6.89617, 81.1403),
(22, 'Case Location', 'Badulla', 'Kendagolla', 6.99276, 81.1085),
(40, 'Case Location', 'Badulla', 'Dambana', 7.41362, 81.1083),
(62, 'Crime Scene', 'Monaragala', 'Pitakumbura', 7.17869, 81.2931),
(72, 'Crime Scene', 'Badulla', 'Ambadandegama', 6.81901, 81.0561),
(73, 'Crime Scene', 'Badulla', 'Kalugahakandura', 7.12267, 81.0948),
(74, 'Crime Scene', 'Badulla', 'Arawakumbura', 7.08739, 81.1996),
(75, 'Crime Scene', 'Badulla', 'Kahataruppa', 6.98189, 81.0763),
(76, 'Crime Scene', 'Monaragala', 'Nilgala', 7.19334, 81.3964),
(77, 'Crime Scene', 'Badulla', 'Lunuwatta', 6.95572, 80.9194);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `empID` varchar(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(64) NOT NULL,
  `role` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`empID`, `username`, `password`, `role`) VALUES
('EMP0001', 'U0001', '$2y$10$R/CFWJmz6EzGLmNoqbMTVOu9TRiQIyTOekggnSFpWFA.DT2RYsRVi', 'accountant_officer'),
('EMP0002', 'A0003', '$2y$10$5BeGZ8eWpQ9KVBCUS2G4hehZn8grMHnLjx5XGTl0gwRl0lBEKNbSq', 'admin'),
('EMP0003', 'U0003', '$2y$10$Ihqden1I7OSy6/fYz9ngie/aFDoLroRjNH3hnP3r01kDzmhliakpi', 'user'),
('EMP0004', 'gimhani', '$2y$10$gWd70I49j/STaZHqcTCydewxORLXuCQIzA9ANGab0ACi4Oek6PIN.', 'external_ officer'),
('EMP0005', 'bodhika', '$2y$10$NFdZ7L3V4cOJmIl91Vxh3.WjpLOiqtiX/4LvNlHHMNG8ub3kKgZ6S', 'user');

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
('197089678833', 'K. Priyantha', 'No 12/5, Malwatte Rd, Pitamaruwa ', '0782323211', ''),
('197567342345', 'A.B Rodrigo', 'No 5, Raja Mawatha, Dambana, Badulla.', '0771223345', ''),
('197578678890', 'A. Lopez', '14, ABC Rd, Kadana', '0789988765', ''),
('197789234564', 'A. A Kamalan', 'No 1A, Malwatte Rd, Arawa', '0765654332', 'kamalana@gmail.com'),
('197867466678', 'C.K Sandamali', 'No 34/1, Passara Rd, Badulla', '0788978666', 'ksandamali@gmail.com'),
('197867567889', 'A.B Herath', 'No 13, Old Cross Street, Badulla', '0712345234', ''),
('198044377789', 'K.M.P Bandara', '12/45 R, Kuttiyagolla, Badulla', '0778978666', 'pramoadbandara@gmail.com'),
('198077665823', 'A.B Silva', 'No 3, Temple Rd, Kendagolla', '0712334456', ''),
('198234355534', 'L.L Marasinghe', '1/B, Badulla Rd, Kalupahana.', '0764545667', 'marasinghe@senaholdings.lk'),
('198567342212', 'J.K Murugan', 'No 12, Pansalwatte Road, Baduluoya', '0556778774', ''),
('199078675523', 'M.N.N Karunaratne', 'No 8/1 C, Polwatte Road, Lunugala', '0759997788', 'mayanthakaru@yahoo.net'),
('199123341234', 'A. Kumara', 'No 5/1 C, Polwatte Road, Lunugala', '0712312222', ''),
('199389782290', 'Thilini Kumarasiri', 'No 34, Sring Vally Mw, Badulla', '0778978777', 'thilinikumarasiri@gmail.com'),
('199578678900', 'J M Jayaratne', 'No 4, Passara Road, Arawa', '0782323222', 'jayaratne95@gmail.com'),
('199845299989', 'K.G Samanthi', 'No 17, Marabedda Road, Badulla', '0775645333', ''),
('199923100023', 'K. Kumari Dharmaratne', 'No 22, Udayaya Road, Spirng Valley', '0712233231', '');

-- --------------------------------------------------------

--
-- Table structure for table `role_in_case`
--

CREATE TABLE `role_in_case` (
  `row_no` int(11) NOT NULL,
  `nic` varchar(15) NOT NULL,
  `role_in_case` varchar(30) NOT NULL,
  `complaint_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role_in_case`
--

INSERT INTO `role_in_case` (`row_no`, `nic`, `role_in_case`, `complaint_id`) VALUES
(1, '198044377789', 'Plantiff', 1),
(2, '199078675523', 'Culprit', 2),
(3, '199078675523', 'Suspect', 1),
(6, '197867567889', 'Plantiff', 15),
(13, '197789234564', 'Suspect', 22),
(15, '199578678900', 'Suspect', 25),
(16, '197089678833', 'Plantiff', 26),
(17, '198567342212', 'Plantiff', 27),
(18, '198234355534', 'Plantiff', 29),
(20, '198234355534', 'Plantiff', 31),
(21, '198077665823', 'Plantiff', 32),
(22, '197867466678', 'Plantiff', 33),
(35, '199923100023', 'Witness', 1),
(36, '199578678900', 'Plantiff', 40),
(38, '199845299989', 'Witness', 40);

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
('EMP0001', 30000, 30, 20000, 60000, NULL),
('EMP0002', 35000, 26, 12000, 61000, NULL),
('EMP0003', 35000, 43, NULL, NULL, 28000),
('EMP0004', 20000, 2, 12000, 22000, NULL);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `empID` (`empID`),
  ADD KEY `location_id` (`location_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`empID`);

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
  ADD PRIMARY KEY (`row_no`),
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
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `duty`
--
ALTER TABLE `duty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `leaveID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `role_in_case`
--
ALTER TABLE `role_in_case`
  MODIFY `row_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `complaint`
--
ALTER TABLE `complaint`
  ADD CONSTRAINT `complaint_ibfk_1` FOREIGN KEY (`empID`) REFERENCES `employee` (`empID`) ON DELETE CASCADE ON UPDATE CASCADE,
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
  ADD CONSTRAINT `duty_ibfk_1` FOREIGN KEY (`empID`) REFERENCES `employee` (`empID`) ON DELETE CASCADE ON UPDATE CASCADE,
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
  ADD CONSTRAINT `leaves_ibfk_1` FOREIGN KEY (`empID`) REFERENCES `employee` (`empID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`empID`) REFERENCES `employee` (`empID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `salary_ibfk_1` FOREIGN KEY (`empID`) REFERENCES `employee` (`empID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
