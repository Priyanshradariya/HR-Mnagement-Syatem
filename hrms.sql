-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2025 at 05:56 PM
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
-- Database: `hrms`
--

-- --------------------------------------------------------

--
-- Table structure for table `leave_req`
--

CREATE TABLE `leave_req` (
  `leave_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('Pending','Approved','Rejected','Completed') NOT NULL,
  `message` text DEFAULT NULL,
  `created_at` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave_req`
--

INSERT INTO `leave_req` (`leave_id`, `created_by`, `type`, `start_date`, `end_date`, `status`, `message`, `created_at`) VALUES
(1, 2, 'Work From Home', '2025-03-25', '2025-03-31', 'Pending', 'mrg', '14:53:48'),
(2, 2, 'Leave', '2025-03-25', '2025-03-28', 'Pending', 'sick', '14:54:12'),
(3, 3, 'Leave', '2025-03-20', '2025-03-31', 'Approved', 'pkfosjdfkl;.', '14:55:16'),
(4, 3, 'Leave', '2025-03-20', '2025-03-31', 'Pending', 'pkfosjdfkl;.', '15:07:16'),
(5, 3, 'Leave', '2025-03-20', '2025-03-31', 'Pending', 'pkfosjdfkl;.', '15:07:41'),
(7, 9, 'Other', '2025-03-27', '2025-03-31', 'Pending', 'bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb', '21:09:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','employee') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'jeko', 'jeko@gmail.com', 'Jenish@10', 'admin', '2025-03-23 08:42:31'),
(2, 'priyansh', 'pilo@gmail.com', 'Priyansh@10', 'employee', '2025-03-23 08:43:23'),
(3, 'Harsh', 'harsh@gmail.com', 'Harsh@10', 'employee', '2025-03-23 08:45:35'),
(8, 'jay', 'jay@gmail.com', 'Jaygori@10', 'employee', '2025-03-23 10:47:14'),
(9, 'Jenil', 'Jenil@gmail.com', 'Jenil@10', 'employee', '2025-03-23 10:47:41'),
(10, 'utsav', 'uv@gmail.com', 'Utsav@10', 'employee', '2025-03-23 10:49:37'),
(11, 'khajur', 'khajur@gmail.com', 'Khajur@10', 'employee', '2025-03-23 10:50:04'),
(12, 'xyz', 'xyz@gmail.com', 'Xyzabc@10', 'employee', '2025-03-24 09:55:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `leave_req`
--
ALTER TABLE `leave_req`
  ADD PRIMARY KEY (`leave_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `leave_req`
--
ALTER TABLE `leave_req`
  MODIFY `leave_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `leave_req`
--
ALTER TABLE `leave_req`
  ADD CONSTRAINT `leave_req_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
