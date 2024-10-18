-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2024 at 08:16 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ticket_booking_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_tbl`
--

CREATE TABLE `admin_tbl` (
  `admin_tbl_id` int(11) NOT NULL,
  `admin_name` text NOT NULL,
  `admin_mobile` text NOT NULL,
  `admin_email` text NOT NULL,
  `admin_password` text NOT NULL,
  `status` text NOT NULL,
  `entry_time` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_tbl`
--

INSERT INTO `admin_tbl` (`admin_tbl_id`, `admin_name`, `admin_mobile`, `admin_email`, `admin_password`, `status`, `entry_time`) VALUES
(1, 'admin', '1234567890', 'admin@gmail.com', 'admin@123', 'active', '1727668485');

-- --------------------------------------------------------

--
-- Table structure for table `booking_seat_details_tbl`
--

CREATE TABLE `booking_seat_details_tbl` (
  `booking_seat_details_tbl_id` int(11) NOT NULL,
  `customer_tbl_id` text NOT NULL,
  `seat_name` text NOT NULL,
  `booking_tbl_id` text NOT NULL,
  `status` text NOT NULL,
  `entry_by` text NOT NULL,
  `entry_time` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_seat_details_tbl`
--

INSERT INTO `booking_seat_details_tbl` (`booking_seat_details_tbl_id`, `customer_tbl_id`, `seat_name`, `booking_tbl_id`, `status`, `entry_by`, `entry_time`) VALUES
(10, '1', '2A', '5', 'active', '1', '1727886206'),
(11, '1', '2B', '5', 'active', '1', '1727886206'),
(12, '1', '2C', '5', 'active', '1', '1727886206'),
(13, '1', '2D', '5', 'active', '1', '1727886206');

-- --------------------------------------------------------

--
-- Table structure for table `booking_tbl`
--

CREATE TABLE `booking_tbl` (
  `booking_tbl_id` int(11) NOT NULL,
  `buses_tbl_id` text NOT NULL,
  `customer_tbl_id` text NOT NULL,
  `booked_seats` text NOT NULL,
  `from_location` text NOT NULL,
  `to_location` text NOT NULL,
  `totalPrice` int(11) NOT NULL,
  `status` text NOT NULL,
  `entry_time` text NOT NULL,
  `entry_by` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_tbl`
--

INSERT INTO `booking_tbl` (`booking_tbl_id`, `buses_tbl_id`, `customer_tbl_id`, `booked_seats`, `from_location`, `to_location`, `totalPrice`, `status`, `entry_time`, `entry_by`) VALUES
(5, '1', '1', '2A, 2B, 2C, 2D', '1', '4', 7980, 'active', '1727886206', '1');

-- --------------------------------------------------------

--
-- Table structure for table `buses_tbl`
--

CREATE TABLE `buses_tbl` (
  `buses_tbl_id` int(11) NOT NULL,
  `bus_name` text NOT NULL,
  `bus_desc` text NOT NULL,
  `status` text NOT NULL,
  `entry_time` text NOT NULL,
  `entry_by` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buses_tbl`
--

INSERT INTO `buses_tbl` (`buses_tbl_id`, `bus_name`, `bus_desc`, `status`, `entry_time`, `entry_by`) VALUES
(1, 'Bus 1', 'Mumbai to Latur', 'active', '1727717002', '1'),
(2, 'Bus 2', 'Ahmednagar to Pune', 'active', '1727718382', '1');

-- --------------------------------------------------------

--
-- Table structure for table `city_tbl`
--

CREATE TABLE `city_tbl` (
  `city_tbl_id` int(11) NOT NULL,
  `buses_tbl_id` text NOT NULL,
  `city_name` text NOT NULL,
  `status` text NOT NULL,
  `entry_time` text NOT NULL,
  `entry_by` text NOT NULL,
  `prev_city` text NOT NULL,
  `distance_form_parent` text NOT NULL,
  `amount_to_reach_single` int(11) NOT NULL,
  `amount_to_reach_double` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `city_tbl`
--

INSERT INTO `city_tbl` (`city_tbl_id`, `buses_tbl_id`, `city_name`, `status`, `entry_time`, `entry_by`, `prev_city`, `distance_form_parent`, `amount_to_reach_single`, `amount_to_reach_double`) VALUES
(1, '1', 'Mumbai', 'active', '1727006188', '1', '1', '0', 0, 0),
(2, '1', 'Pune', 'active', '1727006188', '1', '1', '150', 420, 720),
(3, '1', 'Solapur', 'active', '1727006188', '1', '2', '250', 700, 1200),
(4, '1', 'Latur', 'active', '1727006188', '1', '3', '125', 350, 600),
(5, '2', 'A.Nagar', 'active', '1727839947', '1', '5', '0', 0, 0),
(6, '2', 'Pune', 'active', '1727839947', '1', '5', '150', 170, 300),
(7, '2', 'Mumbai', 'active', '1727839947', '1', '6', '200', 220, 400);

-- --------------------------------------------------------

--
-- Table structure for table `customer_tbl`
--

CREATE TABLE `customer_tbl` (
  `customer_tbl_id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `mobile` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `password` text DEFAULT NULL,
  `status` text DEFAULT NULL,
  `entry_time` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_tbl`
--

INSERT INTO `customer_tbl` (`customer_tbl_id`, `name`, `mobile`, `email`, `password`, `status`, `entry_time`) VALUES
(1, 'Tejas Madan Tathe', '9579535583', 'tejastathe302@gmail.com', 'pass@123', 'active', '1727020205');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  ADD PRIMARY KEY (`admin_tbl_id`);

--
-- Indexes for table `booking_seat_details_tbl`
--
ALTER TABLE `booking_seat_details_tbl`
  ADD PRIMARY KEY (`booking_seat_details_tbl_id`);

--
-- Indexes for table `booking_tbl`
--
ALTER TABLE `booking_tbl`
  ADD PRIMARY KEY (`booking_tbl_id`);

--
-- Indexes for table `buses_tbl`
--
ALTER TABLE `buses_tbl`
  ADD PRIMARY KEY (`buses_tbl_id`);

--
-- Indexes for table `city_tbl`
--
ALTER TABLE `city_tbl`
  ADD PRIMARY KEY (`city_tbl_id`);

--
-- Indexes for table `customer_tbl`
--
ALTER TABLE `customer_tbl`
  ADD PRIMARY KEY (`customer_tbl_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  MODIFY `admin_tbl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking_seat_details_tbl`
--
ALTER TABLE `booking_seat_details_tbl`
  MODIFY `booking_seat_details_tbl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `booking_tbl`
--
ALTER TABLE `booking_tbl`
  MODIFY `booking_tbl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `buses_tbl`
--
ALTER TABLE `buses_tbl`
  MODIFY `buses_tbl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `city_tbl`
--
ALTER TABLE `city_tbl`
  MODIFY `city_tbl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `customer_tbl`
--
ALTER TABLE `customer_tbl`
  MODIFY `customer_tbl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
