-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2020 at 09:38 PM
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
(8, 'Samba', 'Sallah', 'sambasallah10@gmail.com', 'sambasallah10', '$argon2id$v=19$m=2048,t=4,p=4$Skw1ZjJxQVRNalhWOTNrbw$EKTF/mEEpX5ItgK8a840FBvbthFwnnDkP9bw71CbiNY', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` int(11) NOT NULL,
  `partner_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `partner_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `partner_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `partner_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `merchant_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `merchant_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `merchant_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `complaint_text` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`id`, `partner_id`, `partner_name`, `partner_number`, `partner_email`, `merchant_name`, `merchant_email`, `merchant_number`, `complaint_text`) VALUES
(20, '5', 'Samba Sallah', '3911176', 'sambasallah10@gmail.com', 'samba sallah', 'info@ebaaba.com', '3911176', 'I didn\'t still receive it'),
(21, '5', 'Samba Sallah', '3911176', 'sambasallah10@gmail.com', 'samba sallah', 'info@ebaaba.com', '3911176', 'I didn\'t still receive it'),
(22, '7', 'ebaaba gambia', '3827137', 'ebaabagambia@gmail.com', 'Samba Sallah', 'business@ebaaba.com', '42877275', 'Not received'),
(23, '7', 'ebaaba gambia', '3827137', 'ebaabagambia@gmail.com', 'Samba Sallah', 'business@ebaaba.com', '42877275', 'Not received');

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
  `received` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `item_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `delivery_requests`
--

INSERT INTO `delivery_requests` (`id`, `to_location`, `from_location`, `receipient_name`, `receipient_mobile_number`, `receipient_address`, `sender_name`, `sender_mobile_number`, `sender_address`, `pick_up_date`, `package_type`, `package_size`, `request_time`, `request_status`, `partner_id`, `merchant_id`, `rate_id`, `delivery_note`, `payment_method`, `arrival_time`, `received`, `item_name`) VALUES
(5, 'Serrekunda', 'Serrekunda', 'Lamin Fatty', '3911176', 'London corner, Serrekunda', 'Lamin Cham', '3911176', 'London corner, Serrekunda', '2020/02/15 20:57', 'Electronics', 'Medium', '2020-02-08 23:00:46', 'Delivered', 7, 8, 3, 'I want this to be delivered tomorrow', 'Cash On Delivery', '2020-02-08 21:05:00', 'No', 'Samsung Galaxy s10'),
(6, 'Serrekunda', 'Serrekunda', 'Buba', '3911176', 'London corner, Serrekunda', 'Lamin Cham', '3911176', 'London corner, Serrekunda', '2020/02/15 22:49', 'Electronics', 'Medium', '2020-02-14 19:39:33', 'Delivered', 7, 8, 3, 'Delivery note sample', 'Cash On Delivery', '2020-02-15 19:36:00', '', 'samsung galaxy s4'),
(7, 'Serrekunda', 'Banjul', 'Lamin Fatty', '3911176', 'London corner, Serrekunda', 'Lamin Mballo', '3911176', 'London corner, Serrekunda', '2020/02/08 22:50', 'Electronics', 'Medium', '2020-02-20 14:01:33', 'Delivered', 7, 8, 2, 'Delivery free ', 'Cash On Delivery', '2020-02-15 13:42:00', '', 'Iphone 7'),
(8, 'Serrekunda', 'Serrekunda', 'Lamin Fatty', '3911176', 'London corner, Serrekunda', 'Lamin Mballo', '3911176', 'London corner, Serrekunda', '2020/02/01 22:51', 'Electronics', 'Medium', '2020-02-20 14:03:26', 'Delivered', 7, 8, 3, 'Deliver it tomorrow', 'Cash On Delivery', '0000-00-00 00:00:00', '', 'samsung galaxy s4'),
(9, 'Serrekunda', 'Banjul', 'Lamin Fatty', '3911176', 'London corner, Serrekunda', 'Buba Jallo', '3911176', 'London corner, Serrekunda', '2020/02/22 21:10', 'Electronics', 'Medium', '2020-03-01 16:03:50', 'Delivered', 7, 8, 2, 'Testing', 'Cash On Delivery', '0000-00-00 00:00:00', '', 'Printer'),
(10, 'Serrekunda', 'Banjul', 'Lamin Fatty', '3911176', 'London corner, Serrekunda', 'Samba Sallah', '3911176', 'London corner, Serrekunda', '2020/03/28 21:59', 'Electronics', 'Medium', '2020-03-22 22:12:28', 'Delivered', 7, 8, 2, 'testing', 'Cash On Delivery', '2020-03-21 22:11:00', '', 'Iphone X');

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
('Serrekunda', 'Serrekunda', 'Medium', 'Electronics', '150', '105', '3', '2020-01-06 21:41:19'),
('Serrekunda', 'Banjul', 'Small', 'Electronic', '500', '350', '3', '2020-01-11 14:15:08'),
('Serrekunda', 'Banjul', 'Medium', 'Electronics', '500', '350', '3', '2020-01-14 20:35:59'),
('Serrekunda', 'Banjul', 'Medium', 'Electronics', '500', '350', '5', '2020-01-15 21:23:23'),
('Banjul', 'Serrekunda', 'Small', 'Electronics', '500', '350', '5', '2020-01-16 21:54:25'),
('Serrekunda', 'Banjul', 'Medium', 'Electronics', '500', '350', '5', '2020-01-18 13:26:10'),
('Serrekunda', 'Serrekunda', 'Medium', 'Electronics', '150', '105', '5', '2020-01-18 23:26:21'),
('Serrekunda', 'Serrekunda', 'Medium', 'Electronics', '150', '105', '5', '2020-01-21 18:17:53'),
('Serrekunda', 'Banjul', 'Medium', 'Electronics', '500', '350', '1', '2020-01-26 17:35:01'),
('Serrekunda', 'Banjul', 'Small', 'Electronic', '500', '350', '2', '2020-01-27 23:39:33'),
('Serrekunda', 'Banjul', 'Small', 'Electronic', '500', '350', '5', '2020-01-30 22:41:10'),
('Serrekunda', 'Banjul', 'Small', 'Furniture', '500', '350', '6', '2020-01-30 23:05:40'),
('Serrekunda', 'Serrekunda', 'Medium', 'Electronics', '150', '105', '7', '2020-02-08 23:00:46'),
('Serrekunda', 'Serrekunda', 'Medium', 'Electronics', '150', '105', '7', '2020-02-14 19:39:33'),
('Serrekunda', 'Banjul', 'Medium', 'Electronics', '500', '350', '7', '2020-02-20 14:01:33'),
('Serrekunda', 'Serrekunda', 'Medium', 'Electronics', '150', '105', '7', '2020-02-20 14:03:25'),
('Serrekunda', 'Banjul', 'Medium', 'Electronics', '500', '350', '7', '2020-03-01 16:03:50'),
('Serrekunda', 'Banjul', 'Medium', 'Electronics', '500', '350', '7', '2020-03-22 22:12:28');

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

INSERT INTO `merchant` (`merchant_id`, `first_name`, `middle_name`, `last_name`, `username`, `password`, `email`, `address`, `business_name`, `business_location`, `business_email`, `business_phone`, `account_balance`, `total_spent`, `jwt-token`) VALUES
(8, 'Samba', '', 'Sallah', 'sambasallah10', '$argon2id$v=19$m=2048,t=4,p=4$SjkwQ24ucnhxdU5EeFJJVg$YoYjD9ajXAAYY6nmoVSQx+glChGnNGUdaydepHFD1Nc', 'sambasallah10@gmail.com', 'London corner, Serrekunda', 'eBaaba', 'Banjul', 'business@ebaaba.com', '42877275', '6050', '2450', '');

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
  `vehicle_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `profile_picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `partner`
--

INSERT INTO `partner` (`partner_id`, `first_name`, `last_name`, `username`, `password`, `email`, `phone_number`, `address`, `earnings`, `withdrawals`, `account_status`, `municipality`, `license`, `national_document`, `vehicle_type`, `profile_picture`) VALUES
(7, 'ebaaba', 'gambia', 'ebaabagambia', '$argon2id$v=19$m=2048,t=4,p=4$VUYwb05EMkJOMDdkaVpFNA$ENOMAcD6W7KkaY6sQ/RYx+v408m1+ewJ0OchW2jyZog', 'ebaabagambia@gmail.com', '3827137', '', '1365', '560', 'Approved', 'BAC', 'resume (5)974909419.pdf', 'resume (4)1058189558.pdf', 'Motor Bike', 'business-man-1125324_6401563124471.jpg'),
(8, 'ebaaba', 'gambia', 'ebaaba1', '$argon2id$v=19$m=2048,t=4,p=4$U2Y0MTY1dG9pRzNYRlM0Tw$/D79Fl0dC4fj9CtPOsXoIaMbBjvdJnHobFmNWh7a2lQ', 'ebaaba@gmail.com', '8274284372', '', '0', '0', 'Approved', 'BCC', 'resume (3)424133466.pdf', 'resume (6)1480233168.pdf', 'Pick Up', 'WhatsApp Image 2019-12-18 at 7743028876.58');

-- --------------------------------------------------------

--
-- Table structure for table `reset_password`
--

CREATE TABLE `reset_password` (
  `id` int(11) NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `reset_password`
--

INSERT INTO `reset_password` (`id`, `token`, `email`) VALUES
(1, 'EDV33935786', 'sambasallah10@gmail.com'),
(2, 'EDV738279837', 'sambasallah10@gmail.com'),
(3, 'EDV1502801590', 'sambasallah10@gmail.com'),
(4, 'EDV327892504', 'sambasallah10@gmail.com'),
(5, 'EDV248364022', 'sambasallah10@gmail.com'),
(6, 'EDV1542687140', 'sambasallah100@yahoo.com'),
(7, 'EDV733375521', 'sambasallah10@gmail.com'),
(8, 'EDV1409160884', 'sambasallah10@gmail.com'),
(9, 'EDV162542779', 'sambasallah10@gmail.com'),
(10, 'EDV596401228', 'sambasallah10@gmail.com'),
(11, 'EDV664149000', 'sambasallah10@gmail.com'),
(12, 'EDV114871805', 'sambasallah10@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(2) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `user_type`) VALUES
(2, 'sambasallah10', 'sambasallah10@gmail.com', '$argon2id$v=19$m=2048,t=4,p=4$SjkwQ24ucnhxdU5EeFJJVg$YoYjD9ajXAAYY6nmoVSQx+glChGnNGUdaydepHFD1Nc', 'merchant'),
(9, 'ebaabagambia', 'ebaabagambia@gmail.com', '$argon2id$v=19$m=2048,t=4,p=4$VUYwb05EMkJOMDdkaVpFNA$ENOMAcD6W7KkaY6sQ/RYx+v408m1+ewJ0OchW2jyZog', 'partner'),
(10, 'ebaaba1', 'ebaaba@gmail.com', '$argon2id$v=19$m=2048,t=4,p=4$U2Y0MTY1dG9pRzNYRlM0Tw$/D79Fl0dC4fj9CtPOsXoIaMbBjvdJnHobFmNWh7a2lQ', 'partner');

-- --------------------------------------------------------

--
-- Table structure for table `withdrawal_requests`
--

CREATE TABLE `withdrawal_requests` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `withdrawal_amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bank_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `account_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bban_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `request_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `partner_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `withdrawal_requests`
--

INSERT INTO `withdrawal_requests` (`id`, `name`, `withdrawal_amount`, `bank_name`, `account_number`, `bban_number`, `request_status`, `partner_id`) VALUES
(1, 'Samba Sallah', '460', 'Ecobank Gambia Ltd', '27847275872', '82785727572857827', 'Approved', '7');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
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
-- Indexes for table `reset_password`
--
ALTER TABLE `reset_password`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdrawal_requests`
--
ALTER TABLE `withdrawal_requests`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `delivery_rates`
--
ALTER TABLE `delivery_rates`
  MODIFY `rate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `delivery_requests`
--
ALTER TABLE `delivery_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `merchant`
--
ALTER TABLE `merchant`
  MODIFY `merchant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `partner`
--
ALTER TABLE `partner`
  MODIFY `partner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `reset_password`
--
ALTER TABLE `reset_password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `withdrawal_requests`
--
ALTER TABLE `withdrawal_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
