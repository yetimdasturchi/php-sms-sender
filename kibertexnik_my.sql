-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 09, 2021 at 12:41 AM
-- Server version: 10.3.29-MariaDB-0+deb10u1
-- PHP Version: 7.3.29-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kibertexnik_my`
--

-- --------------------------------------------------------

--
-- Table structure for table `my_gsmcontacts`
--

CREATE TABLE `my_gsmcontacts` (
  `contact_id` bigint(22) NOT NULL,
  `contact_phone` varchar(255) NOT NULL,
  `contact_name` varchar(255) NOT NULL,
  `contact_note` text NOT NULL,
  `contact_group` bigint(22) NOT NULL,
  `contact_status` int(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `my_gsmcontacts`
--

INSERT INTO `my_gsmcontacts` (`contact_id`, `contact_phone`, `contact_name`, `contact_note`, `contact_group`, `contact_status`) VALUES
(35944, '998911805015', 'Rahbariyat', 'Devcon xususiy korxonasi', 52, 1),
(35943, '998882312202', 'Ta\'lim markazi', 'Kibertexnik kompyuter injinering maktabi', 52, 1);

-- --------------------------------------------------------

--
-- Table structure for table `my_gsmcontact_groups`
--

CREATE TABLE `my_gsmcontact_groups` (
  `contactgroup_id` bigint(22) NOT NULL,
  `contactgroup_name` varchar(255) NOT NULL,
  `contactgroup_note` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `my_gsmcontact_groups`
--

INSERT INTO `my_gsmcontact_groups` (`contactgroup_id`, `contactgroup_name`, `contactgroup_note`) VALUES
(52, 'Devcon', 'Devcon xususiy korxonasi aloqa ma\'lumotlari');

-- --------------------------------------------------------

--
-- Table structure for table `my_gsmmessages`
--

CREATE TABLE `my_gsmmessages` (
  `sms_id` bigint(22) NOT NULL,
  `sms_phone` varchar(255) NOT NULL,
  `sms_message` text NOT NULL,
  `sms_date` bigint(22) NOT NULL,
  `sms_senddate` bigint(22) NOT NULL,
  `sms_received` bigint(22) NOT NULL,
  `sms_importance` int(3) NOT NULL,
  `sms_status` int(3) NOT NULL,
  `sms_type` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `my_gsmtemplates`
--

CREATE TABLE `my_gsmtemplates` (
  `smstemplate_id` bigint(22) NOT NULL,
  `smstemplate_key` varchar(255) NOT NULL,
  `smstemplate_note` varchar(255) DEFAULT NULL,
  `smstemplate_text` text NOT NULL,
  `smstemplate_type` int(11) NOT NULL,
  `smstemplate_status` int(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `my_gsmtemplates`
--

INSERT INTO `my_gsmtemplates` (`smstemplate_id`, `smstemplate_key`, `smstemplate_note`, `smstemplate_text`, `smstemplate_type`, `smstemplate_status`) VALUES
(1, 'my_site_login_otp', 'Tizimga kirish xabari', 'my.kibertexnik.uz tizimiga kirish uchun tekshirish kodi: {otpcode}', 0, 1),
(5, 'sayt_reklama', NULL, 'Kibertexnik o\'quv markazining rasmiy veb sahifasiga tashrif buyuring va markaz haqida ko\'proq ma\'lumotga ega bo\'ling http://kibertexnik.uz/', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `my_settings`
--

CREATE TABLE `my_settings` (
  `settings_id` int(11) NOT NULL,
  `settings_key` varchar(255) NOT NULL,
  `settings_value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `my_settings`
--

INSERT INTO `my_settings` (`settings_id`, `settings_key`, `settings_value`) VALUES
(1, 'sendingstatus', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `my_users`
--

CREATE TABLE `my_users` (
  `user_id` bigint(22) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `user_avatar` varchar(255) NOT NULL DEFAULT 'noimage.png',
  `user_lastname` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_middlename` varchar(255) NOT NULL,
  `user_status` int(3) NOT NULL,
  `user_type` varchar(52) NOT NULL,
  `user_otp` int(6) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `my_users`
--

INSERT INTO `my_users` (`user_id`, `user_phone`, `user_avatar`, `user_lastname`, `user_firstname`, `user_middlename`, `user_status`, `user_type`, `user_otp`) VALUES
(1, '998911805015', 'manuchehr.jpg', 'Usmonov', 'Manuchehr', 'Xurshedbel o\'g\'li', 1, 'superadmin', 532625);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `my_gsmcontacts`
--
ALTER TABLE `my_gsmcontacts`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `my_gsmcontact_groups`
--
ALTER TABLE `my_gsmcontact_groups`
  ADD PRIMARY KEY (`contactgroup_id`);

--
-- Indexes for table `my_gsmmessages`
--
ALTER TABLE `my_gsmmessages`
  ADD PRIMARY KEY (`sms_id`);

--
-- Indexes for table `my_gsmtemplates`
--
ALTER TABLE `my_gsmtemplates`
  ADD PRIMARY KEY (`smstemplate_id`);

--
-- Indexes for table `my_settings`
--
ALTER TABLE `my_settings`
  ADD PRIMARY KEY (`settings_id`);

--
-- Indexes for table `my_users`
--
ALTER TABLE `my_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `my_gsmcontacts`
--
ALTER TABLE `my_gsmcontacts`
  MODIFY `contact_id` bigint(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35945;
--
-- AUTO_INCREMENT for table `my_gsmcontact_groups`
--
ALTER TABLE `my_gsmcontact_groups`
  MODIFY `contactgroup_id` bigint(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `my_gsmmessages`
--
ALTER TABLE `my_gsmmessages`
  MODIFY `sms_id` bigint(22) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `my_gsmtemplates`
--
ALTER TABLE `my_gsmtemplates`
  MODIFY `smstemplate_id` bigint(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `my_settings`
--
ALTER TABLE `my_settings`
  MODIFY `settings_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `my_users`
--
ALTER TABLE `my_users`
  MODIFY `user_id` bigint(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
