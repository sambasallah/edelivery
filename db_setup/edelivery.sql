-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2020 at 02:24 PM
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

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `first_name`, `last_name`, `email`, `username`, `password`, `role`) VALUES
(6, 'Samba', 'Sallah', 'sambasallah10@gmail.com', 'sambasallah', '$argon2id$v=19$m=2048,t=4,p=4$TE9HY1UyYjVkcEpkUTBaaQ$sCU7/EcSaaby83e9kbSTZjrWOGRAiBf+X5oe0BCfBco', 'admin');

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
  `rate_id` int(11) DEFAULT NULL,
  `delivery_note` text COLLATE utf8_unicode_ci NOT NULL,
  `payment_method` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `arrival_time` datetime NOT NULL,
  `received` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `delivery_requests`
--

INSERT INTO `delivery_requests` (`id`, `to_location`, `from_location`, `receipient_name`, `receipient_mobile_number`, `receipient_address`, `sender_name`, `sender_mobile_number`, `sender_address`, `pick_up_date`, `package_type`, `package_size`, `request_time`, `request_status`, `partner_id`, `merchant_id`, `rate_id`, `delivery_note`, `payment_method`, `arrival_time`, `received`) VALUES
(68, 'Serrekunda', 'Banjul', 'Lamin Fatty', '3911176', 'London corner, Serrekunda', 'Lamin Cham', '3911176', 'London corner, Serrekunda', '2020/01/21 01:17', 'Furniture', 'Small', '2020-01-01 01:21:18', 'Delivered', 3, 4, 2, 'Testing', 'Cash On Delivery', '0000-00-00 00:00:00', ''),
(69, 'Serrekunda', 'Banjul', 'Buba', '3911176', 'London corner, Serrekunda', 'Foday Sanneh', '3911176', 'London corner, Serrekunda', '2020/01/21 01:35', 'Electronics', 'Medium', '2020-01-01 01:35:57', 'Delivered', 3, 4, 2, 'This is for testing', 'Cash On Delivery', '0000-00-00 00:00:00', ''),
(70, 'Serrekunda', 'Banjul', 'Lamin Fatty', '3911176', 'London corner, Serrekunda', 'Lamin Mballo', '3911176', 'London corner, Serrekunda', '2020/01/21 11:21', 'Electronics', 'Large', '2020-01-08 12:31:01', 'Delivered', 3, 4, 2, '', 'Cash On Delivery', '2020-01-03 21:00:00', 'Yes'),
(71, 'Serrekunda', 'Banjul', 'Lamin Fatty', '3911176', 'London corner, Serrekunda', 'Lamin Cham', '3911176', 'London corner, Serrekunda', '2020/01/25 21:01', 'Furniture', 'Medium', '2020-01-08 12:45:05', 'Delivered', 3, 4, 2, 'Testing delivery note', 'Cash On Delivery', '2020-01-04 12:09:00', 'Yes'),
(72, 'Serrekunda', 'Serrekunda', 'Lamin Fatty', '3911176', 'London corner, Serrekunda', 'Buba Jallo', '3911176', 'London corner, Serrekunda', '2020/01/18 03:00', 'Furniture', 'Medium', '2020-01-08 12:51:56', 'Delivered', 4, 4, 3, 'This is for testing', 'Cash On Delivery', '2020-01-03 02:00:00', 'Yes'),
(73, 'Serrekunda', 'Banjul', 'Lamin Fatty', '3911176', 'London corner, Serrekunda', 'Samba Sallah', '3911176', 'London corner, Serrekunda', '2020/01/02 21:00', 'Furniture', 'Large', '2020-01-08 12:29:04', 'Delivered', 3, 4, 2, 'This is for testing', 'Cash On Delivery', '2020-01-11 21:57:00', 'Yes'),
(74, 'Serrekunda', 'Serrekunda', 'Lamin Fatty', '3911176', 'London corner, Serrekunda', 'Samba Sallah', '3911176', 'London corner, Serrekunda', '2020/01/25 17:43', 'Furniture', 'Medium', '2020-01-08 12:24:02', 'Delivered', 3, 4, 3, 'Testing', 'Cash On Delivery', '0000-00-00 00:00:00', 'Yes'),
(75, 'Serrekunda', 'Banjul', 'Lamin Fatty', '3911176', 'London corner, Serrekunda', 'Samba Sallah', '3911176', 'London corner, Serrekunda', '2020/01/25 17:44', 'Electronics', 'Large', '2020-01-08 12:17:26', 'Delivered', 3, 4, 2, 'Testing note', 'Cash On Delivery', '0000-00-00 00:00:00', 'Yes'),
(85, 'Serrekunda', 'Serrekunda', 'Saikou Marong', '4253867', 'London corner', 'Fatou Jaiteh', '3207726', 'Bakoteh Layout', '2020/01/8 13:45', 'Electronics', 'Medium', '2020-01-08 12:22:04', 'Delivered', 3, 4, 3, 'Pick it up at my office', 'Cash On Delivery', '2020-01-04 02:00:00', 'Yes'),
(86, 'Serrekunda', 'Serrekunda', 'Saikou Marong', '4253867', 'London corner', 'Fatou Jaiteh', '3207726', 'Bakoteh Layout', '2020/01/8 13:45', 'Electronics', 'Medium', '2020-01-08 12:19:02', 'Delivered', 3, 4, 3, 'Pick it up at my office', 'Cash On Delivery', '2020-01-25 21:48:00', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `earnings`
--

CREATE TABLE `earnings` (
  `to_location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `from_location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `package_size` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `package_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `earned` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `partner_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `request_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `earnings`
--

INSERT INTO `earnings` (`to_location`, `from_location`, `package_size`, `package_type`, `rate`, `earned`, `partner_id`, `request_time`) VALUES
('Serrekunda', 'Banjul', 'Small', 'Furniture', '500', '350', '3', '2020-01-01 01:21:18'),
('Serrekunda', 'Banjul', 'Medium', 'Electronics', '500', '350', '3', '2020-01-01 01:35:57'),
('Serrekunda', 'Banjul', 'Large', 'Electronics', '500', '350', '3', '2020-01-01 11:22:25'),
('Serrekunda', 'Banjul', 'Medium', 'Furniture', '500', '350', '3', '2020-01-01 21:02:26'),
('Serrekunda', 'Serrekunda', 'Medium', 'Furniture', '150', '105', '4', '2020-01-01 23:38:06'),
('Serrekunda', 'Banjul', 'Large', 'Electronics', '500', '350', '3', '2020-01-02 12:09:42'),
('Serrekunda', 'Banjul', 'Large', 'Furniture', '500', '350', '3', '2020-01-02 22:05:13'),
('Serrekunda', 'Serrekunda', 'Medium', 'Furniture', '150', '105', '3', '2020-01-03 16:50:02'),
('Serrekunda', 'Banjul', 'Large', 'Electronics', '500', '350', '3', '2020-01-03 16:50:09'),
('Serrekunda', 'Serrekunda', 'Medium', 'Electronics', '150', '105', '3', '2020-01-03 23:35:42'),
('Serrekunda', 'Serrekunda', 'Medium', 'Electronics', '150', '105', '3', '2020-01-06 21:41:19');

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
  `total_spent` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jwt-token` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `merchant`
--

INSERT INTO `merchant` (`merchant_id`, `first_name`, `middle_name`, `last_name`, `username`, `password`, `email`, `dob`, `address`, `business_name`, `business_location`, `business_email`, `business_phone`, `account_balance`, `total_spent`, `jwt-token`) VALUES
(4, 'samba', '', 'sallah', 'sambasallah', '$argon2id$v=19$m=2048,t=4,p=4$c2xESnUxeVdYNERLWnVBZw$hpFWs0bHjXMmwnQ0sgCaZcoAh11iR7HMa+kvAdi1VXY', 'sambasallah10@gmail.com', '2015-02-01', 'London Corner', 'eBaaba', 'Brusubi Phase 2 ', 'info@ebaaba.com', '3911176', '6900', '3900', ''),
(5, 'merchant', '', 'merchant', 'merchant', '$argon2id$v=19$m=2048,t=4,p=4$c1J5ZGU1SlMwL3JWREV2MA$0P2SugmZDzyohECQ5v+qBtxBB6U0xRsRn5eDG45wDjo', 'merchant@merchant.com', NULL, NULL, NULL, NULL, NULL, NULL, '10000', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `partner`
--

CREATE TABLE `partner` (
  `partner_id` int(11) NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `earnings` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `withdrawals` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `municipality` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `license` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `national_document` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vehicle_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `partner`
--

INSERT INTO `partner` (`partner_id`, `first_name`, `last_name`, `username`, `password`, `email`, `phone_number`, `address`, `earnings`, `withdrawals`, `account_status`, `municipality`, `license`, `national_document`, `vehicle_type`) VALUES
(3, 'samba', 'sallah', 'sambasallah', '$argon2id$v=19$m=2048,t=4,p=4$dWNCYUlTN3pIQmsxL2lwMg$uZLufeXsE+1raGjJm+fsURfFrYFQcRnYSZM0qE18Ato', 'sambasallah10@gmail.com', '3911176', '', '7420', '0', 'Approved', 'KMC', 'drivers_license1135881988.jpg', 'national_id851042153.jpg', ''),
(4, 'Lamin ', 'Cham', 'lamincham', '$argon2id$v=19$m=2048,t=4,p=4$d0hGMjEzckhWRHowQ0Y1UQ$eTLNtij/U2hyCDeUfKhS1dxptyKOSifpt2l4r5BetHc', 'lamincham@gmail.com', '7506442', '', '105', '0', 'Approved', 'BAC', 'drivers_license1303260740.jpg', 'national_id1261232944.jpg', 'Pick Up');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `delivery_rates`
--
ALTER TABLE `delivery_rates`
  MODIFY `rate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `delivery_requests`
--
ALTER TABLE `delivery_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `merchant`
--
ALTER TABLE `merchant`
  MODIFY `merchant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `partner`
--
ALTER TABLE `partner`
  MODIFY `partner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
