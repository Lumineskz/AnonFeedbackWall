-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2025 at 12:43 PM
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
-- Database: `anonymous-feedback-wall`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `group_name` varchar(50) NOT NULL,
  `username` varchar(100) DEFAULT 'Anon',
  `message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `user_id`, `group_name`, `username`, `message`, `timestamp`, `image_path`) VALUES
(11, NULL, 'BCSIT 1st Batch', 'Anonymous', 'Kurukuru', '2025-12-02 11:38:39', 'uploads/feedback_692ecfbfbe9f55.06955904.gif'),
(12, NULL, 'BCSIT 1st Batch', 'lumi', 'Does anyone have notes for today\'s classes? If so can you dm me on whatsapp?', '2025-12-02 11:39:14', NULL),
(13, NULL, 'BCSIT 1st Batch', 'Anonymous', 'Here\'s the notes, lumi', '2025-12-02 11:39:39', 'uploads/feedback_692ecffb1f1611.35178537.jpeg'),
(14, NULL, 'BCSIT 1st Batch', 'Anonymous', 'hi', '2025-12-02 11:41:30', NULL),
(15, NULL, 'BCSIT 1st Batch', 'lumi', 'look', '2025-12-02 11:41:58', 'uploads/feedback_692ed086bf21c8.32088461.png'),
(16, NULL, 'BCSIT 1st Batch', 'lumi', 'hello', '2025-12-08 13:38:15', NULL),
(17, NULL, 'ALL', 'administrator', 'hii', '2025-12-08 13:38:42', NULL),
(18, NULL, 'BCSIT 1st Batch', 'Anonymous', 'photo', '2025-12-08 13:39:09', 'uploads/feedback_6936d4fd274988.31343124.png'),
(19, NULL, 'BCSIT 2nd Batch', 'user1', 'hello', '2025-12-08 13:40:06', NULL),
(20, NULL, 'BCSIT 2nd Batch', 'Anonymous', 'gi', '2025-12-08 13:41:02', NULL),
(21, NULL, 'BCSIT 2nd Batch', 'Anonymous', 'gif', '2025-12-08 13:41:25', 'uploads/feedback_6936d585d8aa17.13721899.gif'),
(22, NULL, 'BCSIT 2nd Batch', 'user2', 'photo', '2025-12-08 13:41:45', 'uploads/feedback_6936d599a124c0.16200700.png');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `group_id` int(11) NOT NULL,
  `group_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`group_id`, `group_name`) VALUES
(3, 'BBA 1st Batch'),
(4, 'BBA 2nd Batch'),
(5, 'BBA 3rd Batch'),
(6, 'BBA 4th Batch'),
(7, 'BBA 5th Batch'),
(8, 'BBA 6th Batch'),
(1, 'BCSIT 1st Batch'),
(2, 'BCSIT 2nd Batch'),
(9, 'MBA 1st Batch'),
(10, 'MBA 2nd Batch'),
(11, 'MBA 3rd Batch'),
(12, 'MBA 4th Batch');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `group_name` varchar(50) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `group_name`, `role`, `created_at`) VALUES
(9, 'administrator', '$2y$10$Gnz3jeyzAnRLV7T8rG/cE.GXKDE2X4/3dbLzDYWeEaDyegQ/7j63u', 'ALL', 'admin', '2025-11-10 16:31:01'),
(11, 'lumi', '$2y$10$xowChDMXn8v80lxiWEvZnu07uZ7gQSjSljFGtBO2vaRPTVakMXrBa', 'BCSIT 1st Batch', 'user', '2025-12-02 10:55:25'),
(12, 'user1', '$2y$10$DvDhKBws2Hy88oWtmT4.H.8VtdYc3h4DT7BuAuHUoJ5tWp9Sz/uxG', 'BCSIT 2nd Batch', 'user', '2025-12-08 13:39:47'),
(13, 'user2', '$2y$10$K21.wCoW6V3zShV6X35rh.MfEyseNa3Lz5itaKucC4fUEwnojfBGu', 'BCSIT 2nd Batch', 'user', '2025-12-08 13:40:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`group_id`),
  ADD UNIQUE KEY `group_name` (`group_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
