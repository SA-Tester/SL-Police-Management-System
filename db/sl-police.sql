-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 23, 2023 at 04:52 AM
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
  `previous_court_date` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `court_order`
--

INSERT INTO `court_order` (`complaint_id`, `nic`, `next_court_date`, `previous_court_date`) VALUES
(1, '198044377789', '2023-11-24', '2023-11-24'),
(1, '199078675523', '2023-08-30', ''),
(26, '197089678833', '2023-11-27', '2023-11-24'),
(29, '198234355534', '2023-11-28', '2023-11-28'),
(25, '199578678900', '2023-11-28', NULL),
(2, '199078675523', '2023-11-22', NULL);

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
(2, 'EMP0002', 'Special', 'Special Office Request', '2023-07-23 06:00:00', '2023-07-24 06:00:00', NULL),
(4, 'EMP0002', 'Emergency', 'Robbery', '2023-07-21 12:00:00', '2023-07-21 17:00:00', NULL),
(8, 'EMP0004', 'Special', 'Religious Function', '2023-09-13 21:46:00', '2023-09-19 21:46:00', 3),
(10, 'EMP0002', 'General', 'Office Duty', '2023-09-04 08:00:00', '2023-09-04 10:00:00', 2),
(11, 'EMP0004', 'Special', 'Special Parade Request', '2023-09-12 07:00:00', '2023-09-14 07:00:00', 3),
(53, 'EMP0002', 'General', 'Office Duty', '2023-11-23 08:00:00', '2023-11-23 08:30:00', 3),
(56, 'EMP0004', 'General', 'Night Duty', '2023-11-23 18:00:00', '2023-11-23 02:41:00', 13),
(60, 'EMP0001', 'General', 'Investigation', '2023-11-23 07:00:00', '2023-11-23 14:00:00', 3),
(61, 'EMP0001', 'Special', 'Religious Function', '2023-11-25 08:00:00', '2023-11-29 08:00:00', 3),
(62, 'EMP0004', 'Emergency', 'Accident', '2023-11-23 02:41:00', '2023-11-23 08:00:00', 99),
(63, 'EMP0002', 'Emergency', 'Robbery', '2023-11-23 08:30:00', '2023-11-24 18:30:00', 100);

-- --------------------------------------------------------

--
-- Table structure for table `duty_feedback`
--

CREATE TABLE `duty_feedback` (
  `duty_id` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT 2,
  `feedback` varchar(255) DEFAULT 'N/A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `duty_feedback`
--

INSERT INTO `duty_feedback` (`duty_id`, `status`, `feedback`) VALUES
(1, 0, 'N/A'),
(2, 1, 'Accepted. Confirming the availability for the entire duration of the duty.\n'),
(4, 1, 'N/A'),
(7, 1, 'Managed the duty efficiently despite adverse weather conditions.'),
(8, 1, 'Effectively managed the crowd during the religious event.'),
(10, 0, 'N/A'),
(11, 0, 'N/A'),
(36, 1, 'N/A'),
(37, 1, 'Efficient handling of the initial stages of the incident.'),
(38, 1, 'N/A'),
(39, 1, 'Conducted a comprehensive investigation into the matter'),
(40, 0, 'N/A');

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
('EMP0001', 'Sisira', 'Fernando', '1973-02-02', 'siattanayake@gmail.com', '0777296279', '34/1 A, King Street, Passara Rd, Badulla', '197312400034', 'Male', '1993-04-26', 'Married', 'IP', 0),
('EMP0002', 'Nayanamali', 'Jeewanthi', '1975-10-20', 'njeewanthi@gmail.com', '0701497334', 'No 11, Flower Rd, Hali Ela', '197558600011', 'Female', '1997-01-06', 'Married', 'WPC', 0),
('EMP0003', 'Saman', 'Krishnakumar', '1960-06-20', 'cst20076@std.uwu.ac.lk', '0768907867', '15/23 C, Kolonna Rd, Meegahakiula\r\n', '196022300089', 'Male', '1980-03-10', 'Unmarried', 'ASP', 1),
('EMP0004', 'Gimhani', 'Sandeepani', '1997-05-03', 'cst20043@std.uwu.ac.lk', '0701284679', 'No 5, ABC Rd, Ratnapura', '19978978666534', 'Female', '2021-06-05', 'Married', 'PC', 0),
('EMP0005', 'Bodhika ', 'Nishadhi ', '1980-09-03', 'cst20097@std.uwu.ac.lk', '0786756555', 'ABCd', '19607867555', 'Female', '1980-03-01', 'Married', 'IP', 1),
('EMP0006', 'Nayomi', 'Kodithuwakku', '1996-11-01', 'cst20004@std.uwu.ac.lk', '0777296279', 'No 13/A, Independence Road, Badulla', '199678732212', 'Female', '2023-01-01', 'Unmarried', 'WPC', 0),
('EMP0007', 'Kasunika', 'Ratnayake', '1990-10-12', 'cst20002@std.uwu.ac.lk', '0701497334', 'No 19, Raja Mawatha, Badulla', '199089786678', 'Female', '2018-06-14', 'Married', 'IP', 0);

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
(1, 'EMP0001', '2023-07-25', '2023-07-27', 'Personal', 'Will be going out of town for a personal matter.', NULL, 1),
(2, 'EMP0002', '2023-07-16', '2023-07-17', 'Health', 'Medical clinic', '../uploads/medicals/EMP0002.pdf', 0),
(4, 'EMP0003', '2023-07-21', '2023-07-26', 'Personal', 'To attend a wedding ceremony.', NULL, 1),
(5, 'EMP0001', '2023-08-02', '2023-08-07', 'Vacation', 'Monthly vacation. ', '', 1),
(9, 'EMP0001', '2023-08-21', '2023-08-23', 'Personal', 'Visit my parent', NULL, 0),
(10, 'EMP0001', '2023-08-28', '2023-08-30', 'Personal', 'Visit my parent', NULL, 1),
(11, 'EMP0003', '2023-09-05', '2023-09-10', 'Vacation', 'Monthly Vacation.', NULL, 1),
(57, 'EMP0002', '2023-10-27', '2023-11-01', 'Vacation', 'Monthly vacation', '', 1),
(58, 'EMP0005', '2023-09-12', '2023-09-13', 'Personal', 'Will be going out of town for a personal matter.', '', 1),
(59, 'EMP0003', '2023-09-15', '2023-09-16', 'Personal', 'Attend for parent meeting.', '', 0),
(60, 'EMP0002', '2023-10-16', '2023-10-17', 'Health', 'Recovering from recent illness.', '', 1),
(61, 'EMP0003', '2023-10-19', '2023-10-20', 'Personal', 'Will be going out of town for a personal matter.', NULL, 1),
(62, 'EMP0005', '2023-10-20', '2023-10-25', 'Vacation', 'Monthly vacation.', NULL, 1),
(63, 'EMP0001', '2023-11-24', '2023-11-26', 'Personal', 'Moving to a new residence and requiring time for relocation tasks.', '', 2),
(64, 'EMP0003', '2023-11-24', '2023-11-27', 'Health', 'Recovering from a short-term illness and needing time to rest and recuperate.', '1698236630.jpeg', 2),
(65, 'EMP0005', '2023-11-29', '2023-12-04', 'Vacation', 'Requesting monthly vacation.', '', 2),
(66, 'EMP0002', '2023-11-25', '2023-11-28', 'Vacation', 'For personal reasons I may need a 3 day vacation.', '', 1);

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
(77, 'Crime Scene', 'Badulla', 'Lunuwatta', 6.95572, 80.9194),
(78, 'Crime Scene', 'Badulla', 'Liyangahawela', 6.81189, 81.0299),
(79, 'Crime Scene', 'Badulla', 'Aluttaramma', 6.9934, 81.055),
(80, 'Crime Scene', 'Badulla', 'Central Camp', 6.9934, 81.055),
(84, 'Crime Scene', 'Badulla', 'Atakiriya', 6.98189, 81.0763),
(85, 'Crime Scene', 'Badulla', 'Kahataruppa', 6.98189, 81.0763),
(86, 'Crime Scene', 'Badulla', 'Kahataruppa', 6.98189, 81.0763),
(87, 'Crime Scene', 'Badulla', 'Kendagolla', 6.99276, 81.1085),
(88, 'Crime Scene', 'Badulla', 'Koslanda', 6.74312, 81.0178),
(89, 'Crime Scene', 'Monaragala', 'Obbegoda', 6.92507, 81.3541),
(90, 'Crime Scene', 'Badulla', 'Dikkapitiya', 6.89369, 80.9374),
(91, 'Crime Scene', 'Badulla', 'Haldummulla', 6.76892, 80.8927),
(93, 'Crime Scene', 'Badulla', 'Hopton', 6.98823, 81.1975),
(96, 'Crime Scene', 'Badulla', 'Diganatenna', 6.85589, 80.9653),
(97, 'Crime Scene', 'Badulla', 'Gawarawela', 6.90285, 81.0713),
(98, 'Crime Scene', 'Badulla', 'Ella', 6.8667, 81.0466),
(99, 'Crime Scene', 'Badulla', 'Gurutalawa', 6.84351, 80.9),
(100, 'Crime Scene', 'Monaragala', 'Marawa', 6.80901, 81.3812);

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
('EMP0001', 'U0001', '$2y$10$0CeHfFaKLmxKqRekAGUyguvGbeILYZxu2FJ6oilSB9TKMR45lPUL6', 'accountant_officer'),
('EMP0002', 'A0003', '$2y$10$5BeGZ8eWpQ9KVBCUS2G4hehZn8grMHnLjx5XGTl0gwRl0lBEKNbSq', 'admin'),
('EMP0003', 'U0003', '$2y$10$Ihqden1I7OSy6/fYz9ngie/aFDoLroRjNH3hnP3r01kDzmhliakpi', 'user'),
('EMP0004', 'gimhani', '$2y$10$gWd70I49j/STaZHqcTCydewxORLXuCQIzA9ANGab0ACi4Oek6PIN.', 'external_ officer'),
('EMP0005', 'bodhika', '$2y$10$NFdZ7L3V4cOJmIl91Vxh3.WjpLOiqtiX/4LvNlHHMNG8ub3kKgZ6S', 'user'),
('EMP0006', 'nayomi', '$2y$10$m02/hem8KUPCLP0Mzq6AO.d66zlm2MRZziAyizUJYXHIivqKXm74O', 'user'),
('EMP0007', 'kasunika', '$2y$10$UYYCjy4LBZ0SyEtSLYcMt.UDEH1rgbVeykZnenvHl4XsMa3enGG.6', 'user');

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
('197089678833', 'K. Priyantha', 'No 12/5, Malwatte Rd, Pitamaruwa ', '0782323211', 'siattanayake@gmail.com'),
('197345231111', 'A.K Kumari', 'No 12/5, Malwatte Rd, Pitamaruwa', '0712312222', ''),
('197789234564', 'A. A Kamalan', 'No 1A, Malwatte Rd, Arawa', '0765654332', 'kamalana@gmail.com'),
('197867466678', 'C.K Sandamali', 'No 34/1, Passara Rd, Badulla', '0788978666', 'ksandamali@gmail.com'),
('197867567889', 'A.B Herath', 'No 13, Old Cross Street, Badulla', '0712345234', ''),
('198044377789', 'K.M.P Bandara', '12/45 R, Kuttiyagolla, Badulla', '0778978666', 'pramoadbandara@gmail.com'),
('198077665823', 'A.B Silva', 'No 3, Temple Rd, Kendagolla', '0712334456', ''),
('198234355534', 'L.L Marasinghe', '1/B, Badulla Rd, Kalupahana.', '0764545667', 'marasinghe@senaholdings.lk'),
('198567342212', 'J.K Murugan', 'No 12, Pansalwatte Road, Baduluoya', '0556778774', ''),
('199078675523', 'M.N.N Karunaratne', 'No 8/1 C, Polwatte Road, Lunugala', '0759997788', 'mayanthakaru@yahoo.net'),
('199578678900', 'J M Jayaratne', 'No 4, Passara Road, Arawa', '0782323222', 'jayaratne95@gmail.com'),
('199845299989', 'K.G Samanthi', 'No 17, Marabedda Road, Badulla', '0775645333', ''),
('199923100023', 'K. Kumari Dharmaratne', 'No 22, Udayaya Road, Spirng Valley', '0712233231', '');

-- --------------------------------------------------------

--
-- Table structure for table `role_in_case`
--

CREATE TABLE `role_in_case` (
  `complaint_id` int(11) NOT NULL,
  `nic` varchar(15) NOT NULL,
  `role_in_case` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role_in_case`
--

INSERT INTO `role_in_case` (`complaint_id`, `nic`, `role_in_case`) VALUES
(1, '198044377789', 'Plantiff'),
(2, '199078675523', 'Culprit'),
(1, '199078675523', 'Suspect'),
(15, '197867567889', 'Plantiff'),
(22, '197789234564', 'Suspect'),
(25, '199578678900', 'Suspect'),
(26, '197089678833', 'Plantiff'),
(27, '198567342212', 'Plantiff'),
(29, '198234355534', 'Plantiff'),
(31, '198234355534', 'Plantiff'),
(32, '198077665823', 'Plantiff'),
(33, '197867466678', 'Plantiff'),
(1, '199923100023', 'Witness'),
(40, '199578678900', 'Plantiff'),
(40, '199845299989', 'Witness');

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
('EMP0004', 20000, 2, 12000, 22000, NULL),
('EMP0006', 23000, 0, 12000, 23000, NULL);

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
-- Indexes for table `duty_feedback`
--
ALTER TABLE `duty_feedback`
  ADD PRIMARY KEY (`duty_id`);

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
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `duty`
--
ALTER TABLE `duty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `leaveID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

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
