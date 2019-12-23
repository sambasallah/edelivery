-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2019 at 12:02 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edelivery`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_rates`
--

CREATE TABLE `delivery_rates` (
  `rate_id` int(11) NOT NULL,
  `to_town` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `from_town` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `delivery_rates`
--

INSERT INTO `delivery_rates` (`rate_id`, `to_town`, `from_town`, `rate`) VALUES
(1, 'Banjul', 'Serrekunda', '500'),
(2, 'Serrekunda', 'Banjul', '500'),
(3, 'Serrekunda', 'Serrekunda', '150'),
(4, 'Banjul', 'Banjul', '100');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_requests`
--

CREATE TABLE `delivery_requests` (
  `id` int(11) NOT NULL,
  `to_location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `from_location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `receipient_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `receipient_mobile_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `receipient_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sender_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sender_mobile_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sender_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pick_up_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `package_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `package_size` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `request_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `request_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `partner_id` int(11) DEFAULT NULL,
  `merchant_id` int(11) DEFAULT NULL,
  `rate_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `delivery_requests`
--

INSERT INTO `delivery_requests` (`id`, `to_location`, `from_location`, `receipient_name`, `receipient_mobile_number`, `receipient_address`, `sender_name`, `sender_mobile_number`, `sender_address`, `pick_up_date`, `package_type`, `package_size`, `request_time`, `request_status`, `partner_id`, `merchant_id`, `rate_id`) VALUES
(58, 'Serrekunda', 'Banjul', 'Lamin Fatty', '3911176', 'London corner, Serrekunda', 'Lamin Saidykhan', '3911176', 'London corner, Serrekunda', '2019/12/23 23:00', 'Electronics', 'Small', '2019-12-23 21:14:00', 'Pending', NULL, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `merchant`
--

CREATE TABLE `merchant` (
  `merchant_id` int(11) NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `middle_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dob` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `business_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `business_location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `business_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `business_phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_balance` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_spent` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `merchant`
--

INSERT INTO `merchant` (`merchant_id`, `first_name`, `middle_name`, `last_name`, `username`, `password`, `email`, `dob`, `address`, `business_name`, `business_location`, `business_email`, `business_phone`, `account_balance`, `total_spent`) VALUES
(1, 'Samba', '', 'Sallah', 'sambasallah10', '$argon2id$v=19$m=2048,t=2,p=4$TVRaWndwZEtVWkVTRTZUVw$bCwtl6cNb7+pvm4ZNdcP4YLhOi7xEvoMT1hZDCKaQYQ', 'sambasallah10@gmail.com', '1996-12-29', 'London corner, Serrekunda', 'eBaaba', 'eBaaba', 'sambasallah10@gmail.com', '3911176', '12896', '1000'),
(2, 'admin', '', 'admin', 'admin', '$argon2id$v=19$m=2048,t=2,p=4$LzJXdHJrTXdEc2hFVWxkNw$6CabvdUz8BdZRCuQeYl+WMobyH1DcHy5xNRmCVmW4vI', 'admin@admin.com', NULL, NULL, NULL, NULL, NULL, NULL, '350', '300');

-- --------------------------------------------------------

--
-- Table structure for table `partner`
--

CREATE TABLE `partner` (
  `partner_id` int(11) NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `middle_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dob` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `national_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `drivers_license` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `earnings` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `withdrawals` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `arrival_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `partner`
--

INSERT INTO `partner` (`partner_id`, `first_name`, `middle_name`, `last_name`, `username`, `password`, `email`, `phone_number`, `dob`, `address`, `national_id`, `drivers_license`, `earnings`, `withdrawals`, `account_status`, `arrival_time`) VALUES
(1, 'Lamin', '', 'Sillah', 'laminsillah', '1234', 'lamin@sillah.com', '+2203911186', '30/12/1996', 'Latrikunda, German, the Gambia', 'ID National', 'Drivers License', '20000', '10000', 'Active', '2019-11-27 06:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_rates`
--
ALTER TABLE `delivery_rates`
  ADD PRIMARY KEY (`rate_id`);

--
-- Indexes for table `delivery_requests`
--
ALTER TABLE `delivery_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `partner_id` (`partner_id`),
  ADD KEY `merchant_id` (`merchant_id`),
  ADD KEY `rate_id` (`rate_id`);

--
-- Indexes for table `merchant`
--
ALTER TABLE `merchant`
  ADD PRIMARY KEY (`merchant_id`);

--
-- Indexes for table `partner`
--
ALTER TABLE `partner`
  ADD PRIMARY KEY (`partner_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery_rates`
--
ALTER TABLE `delivery_rates`
  MODIFY `rate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `delivery_requests`
--
ALTER TABLE `delivery_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `merchant`
--
ALTER TABLE `merchant`
  MODIFY `merchant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `partner`
--
ALTER TABLE `partner`
  MODIFY `partner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `delivery_requests`
--
ALTER TABLE `delivery_requests`
  ADD CONSTRAINT `delivery_requests_ibfk_1` FOREIGN KEY (`partner_id`) REFERENCES `partner` (`partner_id`),
  ADD CONSTRAINT `delivery_requests_ibfk_2` FOREIGN KEY (`merchant_id`) REFERENCES `merchant` (`merchant_id`),
  ADD CONSTRAINT `delivery_requests_ibfk_3` FOREIGN KEY (`rate_id`) REFERENCES `delivery_rates` (`rate_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
