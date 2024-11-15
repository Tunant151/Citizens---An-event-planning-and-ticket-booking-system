-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2024 at 08:30 AM
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
-- Database: `citizens`
--

-- --------------------------------------------------------

--
-- Table structure for table `canceled`
--

CREATE TABLE `canceled` (
  `id` int(11) NOT NULL,
  `event` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `venue` varchar(50) NOT NULL,
  `seats` int(11) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `poster` binary(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cancelled_events`
--

CREATE TABLE `cancelled_events` (
  `id` int(11) NOT NULL,
  `event` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `venue` varchar(50) NOT NULL,
  `seats` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `description` text NOT NULL,
  `tickets_bought` int(11) NOT NULL DEFAULT 0,
  `poster` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `venue` varchar(50) NOT NULL,
  `seats` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `description` text NOT NULL,
  `tickets_bought` int(11) NOT NULL DEFAULT 0,
  `poster` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stakeholder_cancelled_stake`
--

CREATE TABLE `stakeholder_cancelled_stake` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `event` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `venue` varchar(50) NOT NULL,
  `seats` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `description` text NOT NULL,
  `tickets_bought` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stakeholder_stake`
--

CREATE TABLE `stakeholder_stake` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `event` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `ticket_number` varchar(50) NOT NULL,
  `ticket_code` varchar(50) NOT NULL,
  `event` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `ticket_status` varchar(50) NOT NULL DEFAULT 'open',
  `payment_method` varchar(50) NOT NULL,
  `reference_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `try`
--

CREATE TABLE `try` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `age` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `try`
--

INSERT INTO `try` (`id`, `name`, `age`) VALUES
(1, 'tunant', 21);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `role`) VALUES
(1, 'admin@gmail.com', 'admin', 'admin', 'admin'),
(3, 'steward@gmail.com', 'steward', 'steward', 'steward'),
(4, 'stakeholder@gmail.com', 'stakeholder', 'stakeholder', 'stakeholder'),
(5, 'stakeholder1@gmail.com', 'stakeholder1', 'stakeholder1', 'stakeholder'),
(6, 'stakeholder2@gmail.com', 'stakeholder2', 'stakeholder2', 'stakeholder');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `canceled`
--
ALTER TABLE `canceled`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cancelled_events`
--
ALTER TABLE `cancelled_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stakeholder_cancelled_stake`
--
ALTER TABLE `stakeholder_cancelled_stake`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stakeholder_stake`
--
ALTER TABLE `stakeholder_stake`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `try`
--
ALTER TABLE `try`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `canceled`
--
ALTER TABLE `canceled`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cancelled_events`
--
ALTER TABLE `cancelled_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `stakeholder_cancelled_stake`
--
ALTER TABLE `stakeholder_cancelled_stake`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `stakeholder_stake`
--
ALTER TABLE `stakeholder_stake`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `try`
--
ALTER TABLE `try`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
