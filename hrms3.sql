-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2025 at 03:59 AM
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
-- Database: `hrms3`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `attender_id` int(11) DEFAULT NULL,
  `attendance_date` date DEFAULT NULL,
  `attendance_time` time DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `attender_id`, `attendance_date`, `attendance_time`, `status`) VALUES
(1, 13, '2025-03-31', '15:05:54', 'Late'),
(2, 9, '2025-03-31', '15:06:32', 'Late'),
(4, 9, '2025-03-28', '11:10:39', 'Late'),
(5, 2, '2025-03-29', '09:12:18', 'On-time'),
(6, 11, '2025-03-29', '11:13:17', 'Late'),
(7, 10, '2025-03-30', '14:43:57', 'Late'),
(8, 0, '2025-03-31', '14:52:28', 'Late'),
(9, 12, '2025-03-31', '16:59:10', 'Late'),
(26, 9, '2025-04-02', '09:54:07', 'On-time'),
(34, 17, '2025-04-05', '17:08:30', 'Late'),
(35, 2, '2025-04-07', '11:33:25', 'Late'),
(36, 3, '2025-04-07', '11:54:53', 'Late'),
(37, 18, '2025-04-10', '00:01:01', 'On-time'),
(38, 1, '2025-04-10', '00:01:47', 'On-time'),
(39, 3, '2025-04-11', '13:44:29', 'Late'),
(40, 27, '2025-04-11', '14:13:03', 'Late'),
(41, 2, '2025-04-15', '20:13:09', 'Late'),
(42, 2, '2025-04-30', '19:07:10', 'Late'),
(43, 2, '2025-04-30', '17:01:53', 'On-time'),
(44, 2, '2025-04-30', '17:01:53', 'On-time'),
(45, 2, '2025-04-29', '09:01:53', 'On-time'),
(46, 2, '2025-04-28', '09:01:53', 'On-time'),
(47, 2, '2025-04-26', '09:01:53', 'On-time'),
(48, 2, '2025-04-24', '09:01:53', 'On-time'),
(49, 2, '2025-04-22', '09:01:53', 'On-time'),
(50, 2, '2025-04-21', '09:01:53', 'On-time'),
(51, 2, '2025-04-19', '09:01:53', 'On-time'),
(52, 2, '2025-04-17', '09:01:53', 'On-time'),
(53, 2, '2025-04-16', '09:01:53', 'On-time'),
(54, 2, '2025-04-11', '09:01:53', 'On-time'),
(55, 2, '2025-04-09', '09:01:53', 'On-time'),
(56, 2, '2025-04-08', '09:01:53', 'On-time'),
(57, 2, '2025-04-04', '09:01:53', 'On-time'),
(58, 2, '2025-04-03', '09:01:53', 'On-time'),
(59, 2, '2025-05-02', '10:23:37', 'Late'),
(60, 31, '2025-05-02', '11:27:40', 'Late'),
(61, 9, '2025-05-02', '13:58:28', 'Late'),
(62, 2, '2025-05-12', '14:57:53', 'Late'),
(63, 2, '2025-06-25', '13:57:58', 'Late');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` int(11) NOT NULL,
  `emp_name` varchar(100) DEFAULT NULL,
  `emp_phone` varchar(15) DEFAULT NULL,
  `emp_email` varchar(100) DEFAULT NULL,
  `emp_gender` varchar(20) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `hiredate` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `basic_salary` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `emp_name`, `emp_phone`, `emp_email`, `emp_gender`, `birthdate`, `hiredate`, `address`, `basic_salary`) VALUES
(2, 'Abc', '9874563432', 'Abc@gmail.com', 'Male', '2005-06-13', '2025-03-23', 'mota varachha', 32000.00),
(3, 'Bcd', '9825341444', 'Bcd@gmail.com', 'Male', '2005-01-25', '2025-03-23', 'Navsari', 25000.00),
(8, 'Cde', '9099441235', 'Cde@gmail.com', 'Male', '2025-03-15', '2025-03-23', 'Hirabaug', 28000.00),
(9, 'Def', '9900014558', 'Def@gmail.com', 'Male', '2005-03-02', '2025-03-23', 'surat', 32000.00),
(10, 'Efg', '9090909090', 'Efg@gmail.com', 'Male', '2004-07-13', '2025-03-23', 'surat', 37000.00),
(11, 'Fgh', NULL, 'Fgh@gmail.com', NULL, NULL, '2025-03-23', NULL, 22000.00),
(12, 'Ghi', '0987654321', 'Ghi@gmail.com', 'Male', '2025-03-21', '2025-03-24', 'fewadzs', 50000.00),
(13, 'Hij', NULL, 'Hij@gmail.com', NULL, NULL, '2025-03-31', NULL, 40000.00),
(14, 'Ijk', NULL, 'Ijk@gmail.com', NULL, NULL, '2025-03-31', NULL, 25000.00),
(15, 'Jkl', NULL, 'Jkl@gmail.com', NULL, NULL, '2025-03-31', NULL, 39000.00),
(16, 'Klm', NULL, 'Klm@gmail.com', NULL, NULL, '2025-04-05', NULL, 50000.00),
(27, 'Mno', '9099441235', 'Mno@gmail.com', 'Female', '2025-04-07', '2025-04-11', '63, Dayaram nagar society,Punagam', 0.00),
(29, 'Nop', '8238906396', 'Nop@gmail.com', 'Female', '2002-07-20', '2025-04-13', '63, nagar society,Punagam', 0.00),
(30, 'Khushi', NULL, 'mrpriyansh1475@gmail.com', NULL, NULL, '2025-04-29', NULL, 0.00),
(31, 'Sahil Vasani', NULL, 'sahilvasani37@gmail.com', NULL, NULL, '2025-05-02', NULL, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` enum('MEETING','HOLIDAY','EVENT','OTHER') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `date`, `title`, `type`, `created_at`) VALUES
(1, '2025-04-14', 'ambedkr jayanti', 'HOLIDAY', '2025-04-01 11:57:10'),
(2, '2025-04-16', '11 pm', 'MEETING', '2025-04-01 12:07:18'),
(3, '2025-04-23', 'work from home', 'EVENT', '2025-04-01 12:08:03'),
(4, '2025-04-29', 'boss birthday', 'OTHER', '2025-04-01 12:08:19'),
(6, '2025-04-09', 'title', 'MEETING', '2025-04-07 06:35:48'),
(7, '2025-04-18', 'hoiday due to heavy rain', 'HOLIDAY', '2025-04-09 18:33:45'),
(8, '2025-04-12', 'Hanuman Jayanti', 'HOLIDAY', '2025-04-11 08:53:41'),
(9, '2025-04-10', 'Mahavir Jayanti', 'HOLIDAY', '2025-04-13 15:09:09'),
(10, '2025-04-25', 'Good Friday', 'HOLIDAY', '2025-04-15 14:47:43'),
(11, '2025-05-09', 'Ravindrnath Jayanti', 'HOLIDAY', '2025-05-02 05:15:33'),
(12, '2025-05-21', 'meeting at conferance', 'MEETING', '2025-05-02 08:32:28');

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
(1, 2, 'Work From Home', '2025-03-25', '2025-03-31', 'Approved', 'mrg', '14:53:48'),
(2, 2, 'Leave', '2025-03-25', '2025-03-28', 'Approved', 'sick', '14:54:12'),
(3, 3, 'Leave', '2025-03-20', '2025-03-31', 'Approved', 'pkfosjdfkl;.', '14:55:16'),
(4, 3, 'Leave', '2025-03-20', '2025-03-31', 'Pending', 'pkfosjdfkl;.', '15:07:16'),
(5, 3, 'Leave', '2025-03-20', '2025-03-31', 'Pending', 'pkfosjdfkl;.', '15:07:41'),
(7, 9, 'Other', '2025-03-27', '2025-03-31', 'Pending', 'bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb', '21:09:56'),
(25, 2, 'Leave', '2025-04-17', '2025-04-19', 'Approved', 'sagai', '20:14:48'),
(26, 2, 'Leave', '2025-05-01', '2025-05-05', 'Pending', 'marrige', '22:27:17'),
(28, 9, 'Leave', '2025-05-03', '2025-05-05', 'Approved', 'sick', '14:00:27');

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE `payroll` (
  `pay_id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `month` varchar(20) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `total_salary` decimal(10,2) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Pending',
  `bonus` decimal(10,2) DEFAULT 0.00,
  `deduction` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payroll`
--

INSERT INTO `payroll` (`pay_id`, `employee_id`, `month`, `year`, `total_salary`, `status`, `bonus`, `deduction`) VALUES
(1, 2, '03', 2025, 1967.74, 'Paid', 1000.00, 0.00),
(2, 3, '03', 2025, 100.00, 'Paid', 100.00, 0.00),
(3, 8, '03', 2025, 903.23, 'Paid', 0.00, 0.00),
(4, 9, '03', 2025, 2064.52, 'Paid', 0.00, 0.00),
(5, 10, '03', 2025, 1193.55, 'Paid', 0.00, 0.00),
(6, 11, '03', 2025, 0.00, 'Paid', 0.00, 0.00),
(7, 12, '03', 2025, 0.00, 'Paid', 0.00, 0.00),
(8, 13, '03', 2025, 1290.32, 'Pending', 0.00, 0.00),
(9, 14, '03', 2025, 2064.52, 'Paid', 0.00, 0.00),
(10, 15, '03', 2025, 0.00, 'Pending', 0.00, 0.00),
(11, 16, '03', 2025, 0.00, 'Pending', 0.00, 0.00),
(12, 2, '04', 2025, 23000.00, 'Pending', 0.00, 0.00),
(13, 3, '04', 2025, 3433.33, 'Pending', 0.00, 0.00),
(14, 8, '04', 2025, 1866.67, 'Pending', 0.00, 0.00),
(15, 9, '04', 2025, 2133.33, 'Pending', 0.00, 0.00),
(16, 10, '04', 2025, 2466.67, 'Pending', 0.00, 0.00),
(17, 11, '04', 2025, 733.33, 'Pending', 0.00, 0.00),
(18, 12, '04', 2025, 0.00, 'Pending', 0.00, 0.00),
(19, 13, '04', 2025, 2666.67, 'Pending', 0.00, 0.00),
(20, 14, '04', 2025, 0.00, 'Pending', 0.00, 0.00),
(21, 15, '04', 2025, 0.00, 'Pending', 0.00, 0.00),
(22, 16, '04', 2025, 1666.67, 'Pending', 0.00, 0.00),
(23, 27, '04', 2025, 0.00, 'Pending', 0.00, 0.00),
(24, 29, '04', 2025, 0.00, 'Pending', 0.00, 0.00),
(25, 30, '04', 2025, 0.00, 'Pending', 0.00, 0.00);

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `OTP` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `email`, `password`, `role`, `created_at`, `OTP`) VALUES
(1, 'Admin', 'admin@gmail.com', 'Admin@10', 'admin', '2025-03-23 03:12:31', 5561),
(2, 'Abc', 'Abc@gmail.com', 'Abc@10', 'employee', '2025-03-23 03:13:23', NULL),
(3, 'Bcd', 'Bcd@gmail.com', 'Bcd@10', 'employee', '2025-03-23 03:15:35', 7150),
(8, 'Cde', 'Cde@gmail.com', 'Cde@10', 'employee', '2025-03-23 05:17:14', NULL),
(9, 'Def', 'Def@gmail.com', 'Def@10', 'employee', '2025-03-23 05:17:41', 9763),
(10, 'Efg', 'Efg@gmail.com', 'Efg@10', 'employee', '2025-03-23 05:19:37', NULL),
(11, 'Fgh', 'Fgh@gmail.com', 'Fgh@10', 'employee', '2025-03-23 05:20:04', NULL),
(12, 'Ghi', 'xyz@gmail.com', 'Xyzabc@10', 'employee', '2025-03-24 04:25:39', NULL),
(13, 'Hij', 'emp@gmail.com', 'Employee@10', 'employee', '2025-03-31 09:33:20', NULL),
(14, 'Ijk', 'abc@gmail.com', 'Abcde@10', 'employee', '2025-03-31 09:34:03', NULL),
(15, 'Jkl', 'Jkl@gmail.com', 'Jkl@10', 'employee', '2025-03-31 10:44:22', NULL),
(16, 'Klm', 'Klm@gmail.com', 'Klm@10', 'employee', '2025-03-31 11:34:50', NULL),
(17, 'Lmn', 'Lmn@gmail.com', 'Lmn@100', 'employee', '2025-04-05 11:38:17', NULL),
(27, 'Mno', 'Mno@gmail.com', 'Mno@10', 'employee', '2025-04-11 08:42:46', NULL),
(29, 'Nop', 'Nop@gmail.com', 'Nop@10', 'employee', '2025-04-13 15:00:02', NULL),
(30, 'Opq', 'Opq@gmail.com', 'Opq@12', 'employee', '2025-04-29 12:44:39', 3614),
(31, 'Pqr', 'Pqr@gmail.com', 'Pqr@10', 'employee', '2025-05-02 04:56:41', 2788);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attender_id` (`attender_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`),
  ADD UNIQUE KEY `emp_email` (`emp_email`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_req`
--
ALTER TABLE `leave_req`
  ADD PRIMARY KEY (`leave_id`);

--
-- Indexes for table `payroll`
--
ALTER TABLE `payroll`
  ADD PRIMARY KEY (`pay_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `leave_req`
--
ALTER TABLE `leave_req`
  MODIFY `leave_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `payroll`
--
ALTER TABLE `payroll`
  MODIFY `pay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `payroll`
--
ALTER TABLE `payroll`
  ADD CONSTRAINT `payroll_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`emp_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
