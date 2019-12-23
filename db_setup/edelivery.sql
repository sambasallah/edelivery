-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2019 at 06:58 PM
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
  `item_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `item_price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `item_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `request_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `request_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `partner_id` int(11) DEFAULT NULL,
  `merchant_id` int(11) DEFAULT NULL,
  `rate_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `delivery_requests`
--

INSERT INTO `delivery_requests` (`id`, `to_location`, `from_location`, `receipient_name`, `receipient_mobile_number`, `receipient_address`, `sender_name`, `sender_mobile_number`, `sender_address`, `item_name`, `item_price`, `item_type`, `request_time`, `request_status`, `partner_id`, `merchant_id`, `rate_id`) VALUES
(27, 'Serrekunda', 'Banjul', 'Lamin Fatty', '3911176', 'London corner, Serrekunda', 'Buba Jallo', '3911176', 'London corner, Serrekunda', 'Printer', '2000', 'heavy', '2019-11-27 21:46:12', 'Delivered', 1, 1, 2),
(28, 'Serrekunda', 'Serrekunda', 'Buba', '3911176', 'London corner, Serrekunda', 'Lamin Cham', '3911176', 'London corner, Serrekunda', 'samsung galaxy s4', '8000', 'medium', '2019-11-27 21:52:16', 'Delivered', 1, 1, 3),
(29, 'Banjul', 'Banjul', 'Lamin Fatty', '3911176', 'London corner, Serrekunda', 'Buba Jallo', '3911176', 'London corner, Serrekunda', 'Iphone 8', '3000', 'medium', '2019-11-28 16:08:41', 'On Route', 1, 1, 4),
(31, 'Banjul', 'Serrekunda', 'Lamin Fatty', '3911176', 'London corner, Serrekunda', 'Lamin Cham', '3911176', 'London corner, Serrekunda', 'Iphone 7', '4000', 'medium', '2019-11-17 16:44:06', 'Pending', NULL, 1, 1),
(35, 'Serrekunda', 'Banjul', 'Lamin Fatty', '3911176', 'London corner, Serrekunda', 'Lamin Saidykhan', '3911176', 'London corner, Serrekunda', 'Samsung Galaxy s10', '8000', 'medium', '2019-11-24 15:10:10', 'Pending', NULL, 1, 2),
(36, 'Serrekunda', 'Banjul', 'Lamin Fatty', '3911176', 'London corner, Serrekunda', 'Lamin Saidykhan', '3911176', 'London corner, Serrekunda', 'Samsung Galaxy s10', '4000', 'heavy', '2019-11-24 15:11:02', 'Pending', NULL, 1, 2),
(38, 'Serrekunda', 'Banjul', 'Lamin Fatty', '3911176', 'London corner, Serrekunda', 'Lamin Saidykhan', '3911176', 'London corner, Serrekunda', 'Printer', '2000', 'medium', '2019-11-28 20:01:17', 'Pending', NULL, 1, 2),
(40, 'Serrekunda', 'Banjul', 'Buba', '3911176', 'London corner, Serrekunda', 'Lamin Cham', '3911176', 'London corner, Serrekunda', 'Iphone 7', '2000', 'heavy', '2019-11-28 20:01:56', 'Pending', NULL, 1, 2),
(41, 'Serrekunda', 'Banjul', 'Lamin Fatty', '3911176', 'London corner, Serrekunda', 'Buba Jallo', '3911176', 'London corner, Serrekunda', 'Printer', '10000', 'medium', '2019-11-28 20:02:15', 'Pending', NULL, 1, 2),
(42, 'Serrekunda', 'Serrekunda', 'Lamin Fatty', '3911176', 'London corner, Serrekunda', 'Foday Sanneh', '3911176', 'London corner, Serrekunda', 'samsung galaxy s4', '10000', 'medium', '2019-11-28 20:02:34', 'Pending', NULL, 1, 3),
(43, 'Serrekunda', 'Serrekunda', 'Lamin Fatty', '3911176', 'London corner, Serrekunda', 'Lamin Mballo', '3911176', 'London corner, Serrekunda', 'samsung galaxy s4', '3000', 'medium', '2019-11-28 20:03:06', 'Pending', NULL, 1, 3),
(44, 'Serrekunda', 'Banjul', 'Lamin Fatty', '3911176', 'London corner, Serrekunda', 'Lamin Cham', '3911176', 'London corner, Serrekunda', 'Printer', '10000', 'medium', '2019-11-28 20:03:25', 'Pending', NULL, 1, 2),
(46, 'Serrekunda', 'Banjul', 'Lamin Fatty', '3911176', 'London corner, Serrekunda', 'Foday Sanneh', '3911176', 'London corner, Serrekunda', 'Printer', '4000', 'medium', '2019-11-30 20:23:22', 'Pending', NULL, 1, 2),
(47, 'Serrekunda', 'Banjul', 'Lamin Fatty', '3911176', 'London corner, Serrekunda', 'Lamin Saidykhan', '3911176', 'London corner, Serrekunda', 'Iphone 8', '10000', 'medium', '2019-11-30 21:49:52', 'Pending', NULL, 1, 2),
(48, 'Serrekunda', 'Banjul', 'Lamin Fatty', '3911176', 'London corner, Serrekunda', 'Lamin Saidykhan', '3911176', 'London Corner, Serrekunda', 'Samsung Galaxy s10', '8000', 'medium', '2019-11-30 22:02:14', 'Pending', NULL, 1, 2),
(49, 'Serrekunda', 'Banjul', 'Lamin Fatty', '3911176', 'London corner, Serrekunda', 'Lamin Cham', '3911176', 'London corner, Serrekunda', 'Iphone 8', '8000', 'medium', '2019-12-01 10:43:12', 'Pending', NULL, 1, 2),
(50, 'Serrekunda', 'Serrekunda', 'Lamin Fatty', '3911176', 'London corner, Serrekunda', 'Lamin Mballo', '3911176', 'London corner, Serrekunda', 'Printer', '30000', 'medium', '2019-12-01 21:09:22', 'Pending', NULL, 1, 3),
(51, 'Banjul', 'Serrekunda', 'Lamin Fatty', '3911176', 'London corner, Serrekunda', 'Buba Jallo', '3911176', 'London Corner, Serrekunda', 'samsung galaxy s4', '10000', 'medium', '2019-12-04 22:24:26', 'Pending', NULL, 1, 1),
(52, 'Serrekunda', 'Banjul', 'Lamin Fatty', '3911176', 'London corner, Serrekunda', 'Foday Sanneh', '3911176', 'London corner, Serrekunda', 'Iphone 7', '8000', 'medium', '2019-12-07 11:06:55', 'Pending', NULL, 1, 2),
(53, 'Serrekunda', 'Serrekunda', 'Lamin Fatty', '3911176', 'London corner, Serrekunda', 'Foday Sanneh', '3911176', 'London corner, Serrekunda', 'Iphone 7', '4000', 'medium', '2019-12-07 19:00:47', 'Pending', NULL, 1, 3),
(54, 'Serrekunda', 'Banjul', 'Lamin Fatty', '3911176', 'London corner, Serrekunda', 'Buba Jallo', '3911176', 'London corner, Serrekunda', 'Samsung Galaxy s10', '4000', 'medium', '2019-12-07 21:56:56', 'Pending', NULL, 1, 2),
(55, 'Serrekunda', 'Serrekunda', 'Lamin Fatty', '3911176', 'London corner, Serrekunda', 'Lamin Cham', '3911176', 'London corner, Serrekunda', 'samsung galaxy s4', '3000', 'medium', '2019-12-08 22:02:47', 'Pending', NULL, 2, 3),
(56, 'Serrekunda', 'Banjul', 'Lamin Fatty', '3911176', 'London corner, Serrekunda', 'Lamin Cham', '3911176', 'London corner, Serrekunda', 'Iphone 7', '4000', 'medium', '2019-12-12 22:43:55', 'Pending', NULL, 1, 2),
(57, 'Serrekunda', 'Banjul', 'Lamin Fatty', '3911176', 'London corner, Serrekunda', 'Lamin Mballo', '3911176', 'London corner, Serrekunda', 'samsung galaxy s4', '4000', 'medium', '2019-12-18 22:01:01', 'Pending', NULL, 1, 2);

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
(1, 'Samba', '', 'Sallah', 'sambasallah10', '$argon2id$v=19$m=2048,t=2,p=4$TVRaWndwZEtVWkVTRTZUVw$bCwtl6cNb7+pvm4ZNdcP4YLhOi7xEvoMT1hZDCKaQYQ', 'sambasallah10@gmail.com', '1996-12-29', 'London corner, Serrekunda', 'eBaaba', 'eBaaba', 'sambasallah10@gmail.com', '3911176', '13396', '9850'),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

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
