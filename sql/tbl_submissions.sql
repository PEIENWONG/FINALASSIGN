-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2025 at 08:51 AM
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
-- Database: `labasm2_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_submissions`
--

CREATE TABLE `tbl_submissions` (
  `id` int(11) NOT NULL,
  `work_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `submission_text` text NOT NULL,
  `submitted_at` datetime DEFAULT current_timestamp(),
  `updated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_submissions`
--

INSERT INTO `tbl_submissions` (`id`, `work_id`, `user_id`, `submission_text`, `submitted_at`, `updated_on`) VALUES
(1, 1, 1, 'Delivering materials to assembly station with proper handling procedures', '2025-05-28 19:41:30', NULL),
(2, 6, 1, 'Completed routine paint booth inspection including checking filters, spray nozzles, ventilation, and safety systems, confirming all components are functioning properly for production use.', '2025-05-28 19:51:31', NULL),
(7, 2, 2, 'Conducted a thorough inspection of Machine X to assess its operational condition, safety compliance, and maintenance needs, with findings documented for further action.', '2025-05-28 21:52:30', NULL),
(10, 2, 2, '123 testing', '2025-06-14 12:32:42', '2025-06-14 13:21:53'),
(11, 2, 2, 'Condcut a full inspection of Machine X including safety guards, fluid leaks, and oeprational sounds, documenting any issues in the maintenance log.', '2025-06-14 14:22:31', '2025-06-14 14:24:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_submissions`
--
ALTER TABLE `tbl_submissions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_submissions`
--
ALTER TABLE `tbl_submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
