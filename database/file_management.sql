-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2023 at 11:52 PM
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
-- Database: `file_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `log_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `activity_message` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`log_id`, `timestamp`, `activity_message`) VALUES
(14, '2023-10-26 17:55:22', 'Admin ID 1 uploaded a new profile picture.'),
(15, '2023-10-26 19:13:07', 'Successful login for username: stvenx1x'),
(16, '2023-10-26 20:03:00', 'Successful login for username: stvenx1x'),
(17, '2023-10-26 20:05:10', 'File uploaded: Jamel_Manuscript.docx'),
(18, '2023-10-26 23:38:23', 'Successful login for username: stvenx1x'),
(19, '2023-10-26 23:54:50', 'Successful login for username: stvenx1x'),
(20, '2023-10-27 00:13:36', 'Successful login for username: cning'),
(21, '2023-10-27 00:17:36', 'Admin ID 7 uploaded a new profile picture.'),
(22, '2023-10-27 00:31:32', 'Successful login for username: stvenx1x'),
(23, '2023-10-27 00:38:41', 'Successful login for username: stvenx1x'),
(24, '2023-10-27 00:49:44', 'Successful login for username: stvenx1x'),
(25, '2023-10-27 00:53:33', 'Successful login for username: stvenx1x'),
(26, '2023-10-27 00:59:00', 'Successful login for username: stvenx1x'),
(27, '2023-10-27 01:03:50', 'Successful login for username: stvenx1x'),
(28, '2023-10-27 01:09:53', 'Successful login for username: stvenx1x'),
(29, '2023-10-27 01:21:32', 'Successful login for username: stvenx1x'),
(30, '2023-10-27 01:45:29', 'File uploaded: Narrative Report.docx'),
(31, '2023-10-27 01:50:36', 'Successful login for username: stvenx1x'),
(32, '2023-10-27 03:03:25', 'Successful login for username: stvenx1x'),
(33, '2023-11-09 00:24:49', 'Applicants ID 3 uploaded a new profile picture.'),
(34, '2023-11-09 00:25:11', 'Applicants ID 3 uploaded a new profile picture.'),
(35, '2023-11-14 00:08:37', 'Successful login for username: stvenx1x'),
(36, '2023-11-14 06:17:56', 'File uploaded: BRGY.-INDIGENCY.docx'),
(37, '2023-11-14 06:18:40', 'Successful login for username: stvenx1x'),
(38, '2023-11-14 12:14:25', 'Successful login for username: stvenx1x'),
(39, '2023-11-14 12:48:21', 'Admin ID 1 uploaded a new profile picture.'),
(40, '2023-11-14 14:29:09', 'Successful login for username: stvenx1x'),
(41, '2023-11-14 15:18:49', 'Successful login for username: stvenx1x'),
(42, '2023-11-14 15:30:45', 'Successful login for username: stvenx1x'),
(43, '2023-11-14 16:17:45', 'Successful login for username: stvenx1x'),
(44, '2023-11-14 22:38:57', 'Successful login for username: stvenx1x');

-- --------------------------------------------------------

--
-- Table structure for table `admin_tb`
--

CREATE TABLE `admin_tb` (
  `admin_id` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `admin_profile_pic` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_tb`
--

INSERT INTO `admin_tb` (`admin_id`, `fullname`, `username`, `email`, `admin_profile_pic`, `password`) VALUES
(1, 'Steven Epis', 'stvenx1x', 'stevenepis9@gmail.com', 'admin_uploads/bg5.jpg', '$2y$10$TxYch1GpbNioo'),
(2, 'marish kuju', 'ande', 'kuju@gmail.com', '', '$2y$10$CPpGbfYd.1A7t'),
(3, 'marish kuju', 'ande', 'kuju@gmail.com', '', '$2y$10$OoVU8p2o3GEuR'),
(4, 'marish kuju', 'ande', 'kuju@gmail.com', '', '$2y$10$PWiHVK64IMIU6'),
(5, 'chelsea', 'neng', 'neng@gmail', '', '$2y$10$xX15sVnQSv9ca'),
(6, 'Stephen', 'steve', 'stevenepis9@gmail.com', '', '$2y$10$2ac/q.6IE8yi6'),
(7, 'Chelsea Mariae Panugaling', 'cning', 'cning@gmail.com', 'admin_uploads/bg4.jpg', '$2y$10$xWXYkB5DtYHFW');

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE `applicants` (
  `applicant_id` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `applicant_profile` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applicants`
--

INSERT INTO `applicants` (`applicant_id`, `fullname`, `applicant_profile`, `username`, `email`, `password`, `status`) VALUES
(3, 'andelene', 'applicant_uploads/images.jpg', 'ande', 'kuju@gmail.com', '$2y$10$OmuXhMJE3FT3aWqWLfUR1urvbKGr3IFj2CzNiEbfe7vdIV/wGrfwy', 'approved'),
(9, 'marish kuju', '', 'qqw', 'qq@gamil.com', '962012d09b8170d912f0669f6d7d9d07', 'pending'),
(10, '', '', 'steve', 'steven@gmail.com', '$2y$10$/fbB/wdWsJUN3bqlaIqZeeUCv8dNhZK6BoWnjEULetuIb3AhUFFTa', 'pending'),
(14, 'chelsea', '', 'chel', 'chels@gmail.com', '$2y$10$o78/rwqKOPhYrjKRUTktp.MR/hwONzPcISqyDJT7UkwrXJ5ehCSaq', 'pending'),
(15, 'Applicant Name', '', '', '', '', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `app_activity_log`
--

CREATE TABLE `app_activity_log` (
  `logg_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `activity_message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `app_activity_log`
--

INSERT INTO `app_activity_log` (`logg_id`, `timestamp`, `activity_message`) VALUES
(1, '2023-11-12 16:55:39', 'Successful login for username: ande'),
(2, '2023-11-13 15:29:46', 'Successful login for username: ande'),
(3, '2023-11-13 15:41:09', 'Successful login for username: ande'),
(4, '2023-11-14 00:18:23', 'Successful login for username: ande'),
(5, '2023-11-14 01:46:32', 'Successful login for username: ande'),
(6, '2023-11-14 01:58:21', 'Successful login for username: ande'),
(7, '2023-11-14 02:00:04', 'Successful login for username: ande'),
(8, '2023-11-14 02:27:33', 'Successful login for username: ande'),
(9, '2023-11-14 02:42:51', 'Successful login for username: ande'),
(10, '2023-11-14 04:20:33', 'Successful login for username: ande'),
(11, '2023-11-14 04:41:19', 'Successful login for username: ande'),
(12, '2023-11-14 05:15:00', 'Successful login for username: ande'),
(13, '2023-11-14 12:55:15', 'Successful login for username: ande'),
(14, '2023-11-14 13:07:13', 'Successful login for username: ande'),
(15, '2023-11-14 13:14:16', 'Successful login for username: ande'),
(16, '2023-11-14 13:18:43', 'Successful login for username: ande'),
(17, '2023-11-14 13:56:41', 'Successful login for username: ande'),
(18, '2023-11-14 14:53:01', 'Successful login for username: ande'),
(19, '2023-11-14 15:24:54', 'Successful login for username: ande'),
(20, '2023-11-14 15:31:39', 'Successful login for username: ande'),
(21, '2023-11-14 16:25:17', 'Successful login for username: ande'),
(22, '2023-11-14 21:30:09', 'Successful login for username: ande'),
(23, '2023-11-14 21:52:23', 'Successful login for username: ande');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `file_id` int(11) NOT NULL,
  `file_uploads` varchar(255) NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`file_id`, `file_uploads`, `upload_date`) VALUES
(107, 'file_uploads/Jamel_Manuscript.docx', '2023-10-27 02:05:10'),
(108, 'Narrative Report.docx', '2023-10-27 07:45:29'),
(109, 'BRGY.-INDIGENCY.docx', '2023-11-14 13:17:56');

-- --------------------------------------------------------

--
-- Table structure for table `permission_messages`
--

CREATE TABLE `permission_messages` (
  `request_id` int(11) NOT NULL,
  `applicant_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permission_messages`
--

INSERT INTO `permission_messages` (`request_id`, `applicant_id`, `message`, `timestamp`) VALUES
(16, 3, 'Your permission request has been accepted. You can now download the file.', '2023-11-14 23:15:12');

-- --------------------------------------------------------

--
-- Table structure for table `permission_requests`
--

CREATE TABLE `permission_requests` (
  `request_id` int(11) NOT NULL,
  `applicant_id` int(11) DEFAULT NULL,
  `file_id` int(11) DEFAULT NULL,
  `reason` varchar(255) NOT NULL,
  `request_date` datetime DEFAULT current_timestamp(),
  `status` enum('Pending','Accepted','Rejected') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permission_requests`
--

INSERT INTO `permission_requests` (`request_id`, `applicant_id`, `file_id`, `reason`, `request_date`, `status`) VALUES
(16, 3, 109, 'kapoyaahahahah', '2023-11-15 07:15:12', 'Accepted');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `admin_tb`
--
ALTER TABLE `admin_tb`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `applicants`
--
ALTER TABLE `applicants`
  ADD PRIMARY KEY (`applicant_id`);

--
-- Indexes for table `app_activity_log`
--
ALTER TABLE `app_activity_log`
  ADD PRIMARY KEY (`logg_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`file_id`);

--
-- Indexes for table `permission_messages`
--
ALTER TABLE `permission_messages`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `applicant_id` (`applicant_id`);

--
-- Indexes for table `permission_requests`
--
ALTER TABLE `permission_requests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `applicant_id` (`applicant_id`),
  ADD KEY `file_id` (`file_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `admin_tb`
--
ALTER TABLE `admin_tb`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `applicants`
--
ALTER TABLE `applicants`
  MODIFY `applicant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `app_activity_log`
--
ALTER TABLE `app_activity_log`
  MODIFY `logg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `permission_messages`
--
ALTER TABLE `permission_messages`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `permission_requests`
--
ALTER TABLE `permission_requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `permission_messages`
--
ALTER TABLE `permission_messages`
  ADD CONSTRAINT `permission_messages_ibfk_1` FOREIGN KEY (`applicant_id`) REFERENCES `applicants` (`applicant_id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_requests`
--
ALTER TABLE `permission_requests`
  ADD CONSTRAINT `permission_requests_ibfk_1` FOREIGN KEY (`applicant_id`) REFERENCES `applicants` (`applicant_id`),
  ADD CONSTRAINT `permission_requests_ibfk_2` FOREIGN KEY (`file_id`) REFERENCES `documents` (`file_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
