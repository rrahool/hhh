-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2020 at 05:21 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lions`
--

-- --------------------------------------------------------

--
-- Table structure for table `content_setting`
--

CREATE TABLE `content_setting` (
  `id` int(11) NOT NULL,
  `field_name` varchar(255) NOT NULL,
  `field_value` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `content_setting`
--

INSERT INTO `content_setting` (`id`, `field_name`, `field_value`, `created_at`) VALUES
(1, 'organization', 'HELPING HEARTS AND HANDS, INC. (HHH) is bridging the prospect and demands of Bangladesh and the USA in terms of human resources. They look to help the Bangladeshi investors, students, and skilled workers to migrate to the USA in these respective categories.\r\n\r\nHHH will help these want-to-migrate people in ways such as finding an established business using their e-commerce site for the investors in the US, providing rental residence near the workspace for the investors/workers, and processing the above category of visas.\r\n\r\nThis model is designed to ensure the right business for investors with a suitable dwelling location. It also includes managing part-time jobs and future business opportunities for the students, and that too near their universities. As the students get involved in the business, especially with the technology-related business they will need virtual, offshore, and onshore workers. The demand for offshore workers will lead the way for the HHH to process the skilled workers’ visa for Bangladeshis.', '2020-05-10 03:40:05'),
(2, 'behind_machine', 'The man behind this model is Momirul I. Bhuyian, an expert in the field of IT and MIS, living in the US since 2007. He received several scholarships and recognitions from different organizations around the world and worked as a consultant for different projects of Bangladesh that are sponsored by international organizations such as USAID, WB, ADB, etc. He has a colorific employment history of playing a different important role for several prominent national/international organizations related to a variety of sectors.', '2020-05-10 03:40:05');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `field_name` varchar(100) NOT NULL,
  `field_value` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `field_name`, `field_value`, `created_at`) VALUES
(1, 'address', 'Selma, Alabama', '2020-04-25 04:13:01'),
(2, 'name', 'Helping Hands & Hearts', '2020-04-25 07:01:22'),
(3, 'email', 'abc@hhh.com', '2020-04-25 05:06:40'),
(4, 'phone', '123456895', '2020-04-25 07:01:22'),
(6, 'image', 'logo_hhh_LLC.png', '2020-04-25 07:01:22'),
(7, 'caddress', 'Selma, Alabama', '2020-04-25 04:13:01'),
(8, 'cname', 'Momirul', '2020-04-25 07:01:22'),
(9, 'cemail', 'abc@hhh.com', '2020-04-25 05:06:40'),
(10, 'cphone', '123456895', '2020-04-25 07:01:22'),
(11, 'cimage', 'logo_hhh_LLC.png', '2020-04-25 07:01:22'),
(12, 'cdesignation', 'CEO', '2020-04-25 07:01:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `shortname` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `conflict` tinyint(4) NOT NULL DEFAULT 1,
  `image` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Pending',
  `role` varchar(20) NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `fullname`, `shortname`, `email`, `conflict`, `image`, `status`, `role`, `created_at`, `updated_at`) VALUES
(1, 'mahbub', 'e10adc3949ba59abbe56e057f20f883e', 'Mahbub', 'mahbub', 'admin@israttstech.com', 1, '', 'Pending', 'admin', '2020-04-01 15:41:34', ''),
(2, 'user2', 'e10adc3949ba59abbe56e057f20f883e', 'Mahbub', 'mahbub', 'mahbub@israttstech.com', 1, '', 'Active', 'user', '2020-04-01 15:48:35', ''),
(3, 'user3', 'e10adc3949ba59abbe56e057f20f883e', 'User 3', 'user_3', 'user3@gmail.com', 1, '', 'Active', 'user', '2020-06-09 06:30:58', ''),
(4, 'user4', 'd0970714757783e6cf17b26fb8e2298f', 'User 4', 'user_4', 'u4@gmail.com', 1, '', 'Pending', 'user', '2020-06-14 12:23:21', ''),
(5, 'user5', 'd0970714757783e6cf17b26fb8e2298f', 'User 5', 'user_5', 'u5@gmail.com', 1, '', 'Pending', 'user', '2020-06-14 12:49:28', ''),
(6, 'mary123', 'd0970714757783e6cf17b26fb8e2298f', 'Mary Jane', 'mary_jane', 'mary123@gmail.com', 1, '', 'Pending', 'user', '2020-06-15 15:15:17', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `mname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` varchar(10) NOT NULL,
  `doj` varchar(10) NOT NULL,
  `occupation` text NOT NULL,
  `occupation2` varchar(30) NOT NULL,
  `occupation3` varchar(30) NOT NULL,
  `degree` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `srvc_yr` varchar(255) NOT NULL,
  `business_type` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `address2` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `zip` int(11) NOT NULL,
  `country` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `interest` varchar(100) NOT NULL,
  `user_code` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `fname`, `mname`, `lname`, `gender`, `dob`, `doj`, `occupation`, `occupation2`, `occupation3`, `degree`, `designation`, `srvc_yr`, `business_type`, `address`, `address2`, `city`, `state`, `zip`, `country`, `email`, `interest`, `user_code`, `created_at`) VALUES
(1, 4, 'Mahbub', 'sdfsdf', 'sdfsd', 'Male', '10/10/1988', '06/02/2020', 'Business', 'Partnership', '50', '', '', '', '', 'O R Nizam Road', '', 'New York City', 'New York', 4100, 'USA', 'john@doe.com', 'IT Related in USA', '111', '2020-06-02 05:57:29'),
(5, 0, 'John', 'M', 'Doe', 'Male', '10/06/2010', '02/09/2014', 'Student', '', '', 'Master', 'Select', '', 'Select Business Type', 'New Market', 'Kotwali', 'Chattogram', 'Chattogram', 4000, 'Bangladesh', '', 'Equipment or Spare Parts', '102367', '2020-06-15 15:07:43'),
(6, 0, 'Mary', 'D', 'Jane', 'Female', '07/10/1990', '06/15/2020', 'Business', '', '', 'Select', 'Select', '', 'Proprietorship', '23/A, Block 7', 'Realm Street', 'San Diego', 'California', 6629, 'USA', '', 'Investment in USA', '2424', '2020-06-15 15:19:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `content_setting`
--
ALTER TABLE `content_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `content_setting`
--
ALTER TABLE `content_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
