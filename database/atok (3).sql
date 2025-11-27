-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2025 at 05:54 PM
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
-- Database: `atok`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `remember_token` text NOT NULL,
  `remember_expiry` text NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `remember_token`, `remember_expiry`, `last_login`, `created_at`) VALUES
(1, 'admin', '$2y$10$JUlGXQVfXKY1uLYA2rJU7Oe8ogsBkJoiSg0Sx8o9jn4614RcJ1ODy', '', '', '2025-11-25 22:08:38', '2025-11-24');

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `config_key` varchar(100) NOT NULL,
  `config_value` text NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `config_key`, `config_value`, `description`, `created_at`) VALUES
(1, 'daily_tourguide_limit', '5', 'Maximum number of registrations per tour guide per day', '2025-11-27 11:00:00'),
(2, 'parking_fee', '200', 'Daily parking fee in PHP', '2025-11-27 11:00:00'),
(3, 'tourguide_fee_per_pax', '50', 'Tour guide fee per person in PHP', '2025-11-28 00:40:26');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parking`
--

CREATE TABLE `parking` (
  `id` int(11) NOT NULL,
  `parking_name` text NOT NULL,
  `status` enum('available','maintenance') NOT NULL DEFAULT 'available',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parking`
--

INSERT INTO `parking` (`id`, `parking_name`, `status`, `created_at`) VALUES
(1, 'Parking Slot A-1', 'available', '2025-11-27 11:00:00'),
(2, 'Parking Slot A-2', 'available', '2025-11-27 11:00:00'),
(3, 'Parking Slot B-1', 'available', '2025-11-27 11:00:00'),
(4, 'Parking Slot B-2', 'available', '2025-11-27 11:00:00'),
(5, 'Parking Slot C-1', 'available', '2025-11-27 11:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `parking_occupancy`
--

CREATE TABLE `parking_occupancy` (
  `id` int(11) NOT NULL,
  `parking_id` int(11) NOT NULL,
  `registration_id` int(11) NOT NULL,
  `occupancy_date` date NOT NULL,
  `vehicles_count` int(11) DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parking_occupancy`
--

INSERT INTO `parking_occupancy` (`id`, `parking_id`, `registration_id`, `occupancy_date`, `vehicles_count`, `created_at`) VALUES
(2, 5, 2, '2025-11-28', 1, '2025-11-28 00:41:43'),
(3, 2, 2, '2025-11-28', 1, '2025-11-28 00:41:43'),
(4, 3, 3, '2025-11-28', 1, '2025-11-28 00:45:51'),
(5, 1, 3, '2025-11-28', 1, '2025-11-28 00:45:51');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `reference` varchar(20) NOT NULL,
  `tourguide_id` int(11) DEFAULT NULL,
  `parking_id` int(11) DEFAULT NULL,
  `full_name` text NOT NULL,
  `contact_number` text NOT NULL,
  `email` text NOT NULL,
  `visit_date` date NOT NULL,
  `pax` int(11) DEFAULT 1 CHECK (`pax` between 1 and 50),
  `car` enum('yes','no') NOT NULL DEFAULT 'no',
  `num_vehicles` int(11) DEFAULT 0,
  `total` decimal(12,2) NOT NULL DEFAULT 0.00,
  `status` enum('pending','confirmed','cancelled') NOT NULL DEFAULT 'pending',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `reference`, `tourguide_id`, `parking_id`, `full_name`, `contact_number`, `email`, `visit_date`, `pax`, `car`, `num_vehicles`, `total`, `status`, `created_at`) VALUES
(2, 'ATOK94613568', NULL, NULL, 'ARC J DATARIO', '0968640934', 'datarioarc@gmail.com', '2025-11-28', 9, 'yes', 2, 850.00, 'pending', '2025-11-28 00:41:43'),
(3, 'ATOK94922696', NULL, NULL, 'ARC J DATARIO', '0968640934', 'datarioarc@gmail.com', '2025-11-28', 19, 'yes', 2, 1350.00, 'pending', '2025-11-28 00:45:51');

-- --------------------------------------------------------

--
-- Table structure for table `registration_tourguides`
--

CREATE TABLE `registration_tourguides` (
  `id` int(11) NOT NULL,
  `registration_id` int(11) DEFAULT NULL,
  `tourguide_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration_tourguides`
--

INSERT INTO `registration_tourguides` (`id`, `registration_id`, `tourguide_id`) VALUES
(1, 2, 2),
(2, 3, 4),
(3, 3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tourguide`
--

CREATE TABLE `tourguide` (
  `id` int(11) NOT NULL,
  `full_name` text NOT NULL,
  `tour_count` int(11) NOT NULL DEFAULT 0,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tourguide`
--

INSERT INTO `tourguide` (`id`, `full_name`, `tour_count`, `status`, `created_at`) VALUES
(1, 'Juan Dela Cruz', 0, 'active', '2025-11-27 11:00:00'),
(2, 'Maria Santos', 0, 'active', '2025-11-27 11:00:00'),
(3, 'Pedro Reyes', 0, 'active', '2025-11-27 11:00:00'),
(4, 'Ana Lopez', 0, 'active', '2025-11-27 11:00:00'),
(5, 'Michael Tan', 0, 'active', '2025-11-27 11:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tourguide_daily_count`
--

CREATE TABLE `tourguide_daily_count` (
  `id` int(11) NOT NULL,
  `tourguide_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `registration_count` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tourguide_daily_count`
--

INSERT INTO `tourguide_daily_count` (`id`, `tourguide_id`, `date`, `registration_count`, `created_at`, `updated_at`) VALUES
(1, 3, '2025-11-28', 1, '2025-11-28 00:31:41', '2025-11-28 00:31:41'),
(2, 2, '2025-11-28', 1, '2025-11-28 00:41:43', '2025-11-28 00:41:43'),
(3, 4, '2025-11-28', 1, '2025-11-28 00:45:51', '2025-11-28 00:45:51'),
(4, 5, '2025-11-28', 1, '2025-11-28 00:45:51', '2025-11-28 00:45:51');

-- --------------------------------------------------------

--
-- Table structure for table `tourguide_dayoff`
--

CREATE TABLE `tourguide_dayoff` (
  `id` int(11) NOT NULL,
  `tourguide_id` int(11) NOT NULL,
  `dayoff_date` date NOT NULL,
  `reason` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `registration_id` int(11) NOT NULL,
  `registration_reference` text NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `registration_id`, `registration_reference`, `content`, `created_at`) VALUES
(1, 1, 'ATOK34835207', 'New registration created: ARC J DATARIO for 2025-11-28 with 3 pax (with car)', '2025-11-27 16:31:41'),
(2, 2, 'ATOK94613568', 'New registration created: ARC J DATARIO for 2025-11-28 with 9 pax (with 2 vehicles) - 1 tour guide(s) assigned', '2025-11-27 16:41:43'),
(3, 3, 'ATOK94922696', 'New registration created: ARC J DATARIO for 2025-11-28 with 19 pax (with 2 vehicles) - 2 tour guide(s) assigned', '2025-11-27 16:45:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `config_key` (`config_key`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parking`
--
ALTER TABLE `parking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parking_occupancy`
--
ALTER TABLE `parking_occupancy`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_occupancy` (`parking_id`,`occupancy_date`),
  ADD KEY `registration_id` (`registration_id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reference` (`reference`),
  ADD KEY `tourguide_id` (`tourguide_id`),
  ADD KEY `parking_id` (`parking_id`);

--
-- Indexes for table `registration_tourguides`
--
ALTER TABLE `registration_tourguides`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `registration_id` (`registration_id`,`tourguide_id`),
  ADD KEY `tourguide_id` (`tourguide_id`);

--
-- Indexes for table `tourguide`
--
ALTER TABLE `tourguide`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tourguide_daily_count`
--
ALTER TABLE `tourguide_daily_count`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_daily_count` (`tourguide_id`,`date`);

--
-- Indexes for table `tourguide_dayoff`
--
ALTER TABLE `tourguide_dayoff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_dayoff` (`tourguide_id`,`dayoff_date`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parking`
--
ALTER TABLE `parking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `parking_occupancy`
--
ALTER TABLE `parking_occupancy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `registration_tourguides`
--
ALTER TABLE `registration_tourguides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tourguide`
--
ALTER TABLE `tourguide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tourguide_daily_count`
--
ALTER TABLE `tourguide_daily_count`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tourguide_dayoff`
--
ALTER TABLE `tourguide_dayoff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `parking_occupancy`
--
ALTER TABLE `parking_occupancy`
  ADD CONSTRAINT `parking_occupancy_ibfk_1` FOREIGN KEY (`parking_id`) REFERENCES `parking` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `parking_occupancy_ibfk_2` FOREIGN KEY (`registration_id`) REFERENCES `registration` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `registration`
--
ALTER TABLE `registration`
  ADD CONSTRAINT `registration_ibfk_1` FOREIGN KEY (`tourguide_id`) REFERENCES `tourguide` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `registration_ibfk_2` FOREIGN KEY (`parking_id`) REFERENCES `parking` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `registration_tourguides`
--
ALTER TABLE `registration_tourguides`
  ADD CONSTRAINT `registration_tourguides_ibfk_1` FOREIGN KEY (`registration_id`) REFERENCES `registration` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `registration_tourguides_ibfk_2` FOREIGN KEY (`tourguide_id`) REFERENCES `tourguide` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tourguide_daily_count`
--
ALTER TABLE `tourguide_daily_count`
  ADD CONSTRAINT `tourguide_daily_count_ibfk_1` FOREIGN KEY (`tourguide_id`) REFERENCES `tourguide` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tourguide_dayoff`
--
ALTER TABLE `tourguide_dayoff`
  ADD CONSTRAINT `tourguide_dayoff_ibfk_1` FOREIGN KEY (`tourguide_id`) REFERENCES `tourguide` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
