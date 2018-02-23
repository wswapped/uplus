-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2018 at 03:53 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `events`
--

-- --------------------------------------------------------

--
-- Table structure for table `akokanya`
--

CREATE TABLE `akokanya` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `code` varchar(128) NOT NULL,
  `details` varchar(1024) NOT NULL,
  `status` int(11) NOT NULL,
  `from_time` date NOT NULL,
  `to_time` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `available_place` int(11) NOT NULL,
  `location` varchar(128) NOT NULL,
  `event_payment_model_id` int(11) NOT NULL,
  `event_category_id` int(11) NOT NULL,
  `file1` text,
  `file2` text,
  `file3` text,
  `deleted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `counting` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akokanya`
--

INSERT INTO `akokanya` (`id`, `name`, `code`, `details`, `status`, `from_time`, `to_time`, `user_id`, `available_place`, `location`, `event_payment_model_id`, `event_category_id`, `file1`, `file2`, `file3`, `deleted_at`, `created_at`, `updated_at`, `counting`) VALUES
(40, 'Kigali Jazz Junction', 'ev0b36e', 'Kigali Jazz Junction is back with Irene Ntale featuring Jules Sentore and Neptunez Band', 1, '2018-02-15', '2018-02-23', 197, 5, 'Kigali Serena Hotel', 1, 1, 'uploads/event/2018event_36a0f9685ff2a04ea28dd42b38def3251bc923e91.jpg', 'uploads/event/2018event_36a0f9685ff2a04ea28dd42b38def3251bc923e92.jpg', '', '2017-12-30 00:00:10', '2018-02-15 16:30:13', '2018-02-15 16:37:28', 2),
(41, 'the mane', 'ev1508074322', 'sssss', -2, '2018-02-02', '2018-02-24', 194, 5, 'kigali', 1, 1, '', '', '', '2017-12-30 00:00:10', '2018-02-14 14:14:18', '2018-02-15 08:29:37', 3),
(42, 'cash', 'ev1508074322', 'DEMO FOR MTN', 0, '2018-02-06', '2018-02-24', 15, 5, '', 1, 1, 'uploads/event/2018event_f5fa67a01fadafee10a1c6c3fd7613604e0bc1df1.jpg', 'uploads/event/2018event_f5fa67a01fadafee10a1c6c3fd7613604e0bc1df2.jpg', 'uploads/event/2018event_f5fa67a01fadafee10a1c6c3fd7613604e0bc1df3.jpg', '2017-12-30 00:00:10', '2018-02-06 06:59:16', '2018-02-15 14:32:58', 7),
(43, 'Diplomatic Private Party', 'ev1508074322', 'Bronze events ltd present Diplomatic Private Party', -2, '2017-12-26', '2017-12-30', 2, 5, 'Kigali Marriot Hotel', 1, 1, 'uploads/event/2017event_81bc4815b0a37b95c59e7996eb5c7818342787291.jpeg', 'uploads/event/2017event_81bc4815b0a37b95c59e7996eb5c7818342787292.jpeg', '', '2017-12-30 00:00:10', '2017-12-26 13:02:52', '2017-12-27 11:06:56', 4),
(44, 'East Africa Party', 'ev1508074322', 'East Africa Party', -2, '2017-12-24', '2018-01-01', 73, 0, 'amahoro stadium', 1, 1, 'uploads/event/2017event_54cf6c9d801c23912bcb1fca4d9982503258be5e1.jpeg', 'uploads/event/2017event_54cf6c9d801c23912bcb1fca4d9982503258be5e2.jpeg', '', '2017-12-30 00:00:10', '2017-12-24 13:11:52', '2018-02-15 20:36:22', 317),
(45, 'Rwanda Konnect Gala', 'ev1508074322', 'Diapora Home Welcome 2017', -2, '2017-12-16', '2017-12-22', 130, 5, 'Gikondo Expo Ground Tent', 1, 1, 'uploads/event/2017event_fff8ec60454a3dae89c396cc84d27959c5923cad1.jpg', 'uploads/event/2017event_fff8ec60454a3dae89c396cc84d27959c5923cad2.jpg', '', '2017-12-30 00:00:10', '2017-12-16 09:17:21', '2018-02-14 19:58:16', 306),
(46, 'Kurya', 'ev1508074322', 'Kurya', -2, '2017-08-11', '2017-12-01', 51, 5, 'Kacyiru', 2, 4, 'uploads/event/2017event_0babdbcda7e90a2ef7c6dcf851805ebb5b3ee3a71.jpg', '', '', '2017-12-30 00:00:10', '2017-12-02 12:01:00', '2017-12-02 12:01:04', 1),
(47, 'Kurya', 'ev1508074322', 'Kurya', -2, '2017-08-11', '2017-12-01', 51, 5, 'Kacyiru', 2, 4, 'uploads/event/2017event_81fc5fe29392af3cc241651b8a8c66959ee89a291.jpg', '', '', '2017-12-30 00:00:10', '2017-12-02 11:59:28', '2017-12-02 12:00:05', 1),
(48, 'Holiday Cheer', 'ev1508074322', 'With Bruce Melodie and Butera Knowless', -2, '2017-11-27', '2017-12-23', 59, 5, 'Radisson Blu Hotel & Convention Centre, Kigali', 1, 1, 'uploads/event/2017event_1604fc66534f256c9cc2b6a0b88573b9ee5375a31.jpeg', 'uploads/event/2017event_1604fc66534f256c9cc2b6a0b88573b9ee5375a32.jpeg', '', '2017-12-30 00:00:10', '2017-11-27 14:17:35', '2018-02-14 23:02:33', 773),
(49, 'Holiday Cheer', 'ev1508074322', 'With Bruce Melodie and Butera Knowless! ', -2, '2017-11-27', '2017-11-23', 2, 5, 'Radisson Blu Hotel & Convention Centre, Kigali', 1, 1, '/tmp/phpPngvLc', '/tmp/phpy0yMt8', '', '2017-12-30 00:00:10', '2017-11-27 14:12:50', '2017-11-27 14:12:50', 1),
(50, 'Demo', 'ev1508074322', 'event ', -2, '2017-11-01', '2017-12-31', 19, 5, 'Amahoro stadium', 1, 1, 'uploads/event/2017event_ade006d8f3b8cd99e5f29a0d468ed966741663ee1.png', 'uploads/event/2017event_ade006d8f3b8cd99e5f29a0d468ed966741663ee2.png', '', '2017-12-30 00:00:10', '2017-11-23 17:39:22', '2017-11-23 17:39:22', 1),
(51, 'Demo events', 'ev1508074322', 'rock event', -2, '2017-11-23', '2017-12-31', 2, 5, 'Petit stade', 1, 1, 'uploads/event/2017event_2ebc25f00ce2c49c35b75c6ec3ea1bec2bb778e71.png', 'uploads/event/2017event_2ebc25f00ce2c49c35b75c6ec3ea1bec2bb778e72.png', '', '2017-12-30 00:00:10', '2017-11-22 16:24:09', '2017-11-22 16:24:09', 1),
(52, 'RWANDA MODESTY FASHION SHOW ', 'ev1508074322', 'Ubwiza bw\'uwikwije', -2, '2017-11-17', '2017-12-12', 45, 5, 'Kigali Serena Hotel', 1, 1, 'uploads/event/2017event_75e5d9ada693afe6357ccfcf12f7fc617f08f5f01.jpeg', 'uploads/event/2017event_75e5d9ada693afe6357ccfcf12f7fc617f08f5f02.jpeg', '', '2017-12-30 00:00:10', '2017-11-17 12:36:05', '2018-02-13 14:27:20', 102),
(53, 'test', 'ev1508074322', 'test', -2, '2017-11-30', '2017-11-17', 2, 5, 'kigali', 1, 1, 'uploads/event/2017event_960ff6f6f8ba4875feeb6b8c9d04a3e23f0f2a751.JPG', '', '', '2017-12-30 00:00:10', '2017-11-17 12:22:54', '2017-11-17 12:22:54', 1),
(54, 'Test', 'ev1508074322', 'Test', -2, '2017-11-02', '2017-11-17', 2, 5, 'Kigai', 1, 1, '', '', '', '2017-12-30 00:00:10', '2017-11-17 12:20:23', '2017-11-17 12:20:23', 1),
(55, 'test', 'ev1508074322', 'test', -2, '2017-11-01', '2017-11-17', 2, 5, 'kigali', 1, 1, '', '', '', '2017-12-30 00:00:10', '2017-11-17 12:13:00', '2017-11-17 12:13:00', 1),
(56, 'rw evn', 'ev1508074322', 'fhg\r\nfhxgc\r\nghkdjrtcg\r\nmhgdtyfcnmbjb', -2, '2017-11-04', '2017-11-07', 44, 5, 'KCC', 1, 1, '', '', '', '2017-12-30 00:00:10', '2017-11-16 07:16:46', '2017-11-16 07:16:46', 1),
(57, 'gfggg', 'ev1508074322', 'dddddd', -2, '2017-11-14', '2017-11-14', 28, 5, 'kigsdsds543', 0, 0, '', '', '', '2017-12-30 00:00:10', '2017-11-09 09:28:52', '2017-11-09 09:28:52', 1),
(58, 'gura gura', 'ev1508074322', 'welcom ', -2, '2017-10-31', '2017-10-31', 2, 5, 'klab', 0, 0, '', '', '', '2017-12-30 00:00:10', '2017-11-08 14:09:26', '2017-11-08 14:09:26', 1),
(59, 'tiger', 'ev1508074322', 'simba', -2, '2017-10-01', '2017-10-31', 2, 5, 'amahoro stadium', 0, 0, 'uploads/event/2017event_f3d6ffad8a541f5c5b11122859af427161350de51.png', 'uploads/event/2017event_f3d6ffad8a541f5c5b11122859af427161350de52.png', 'uploads/event/2017event_f3d6ffad8a541f5c5b11122859af427161350de53.png', '2017-12-30 00:00:10', '2017-10-25 18:10:30', '2017-12-13 12:38:37', 2),
(60, 'simba', 'ev1508074322', 'simba event', -2, '2017-10-01', '2017-10-31', 2, 5, 'Kimihurura', 0, 0, 'uploads/event/2017event_38e37396a0ce97ed3d5d6bab89b447161a141fb01.png', 'uploads/event/2017event_38e37396a0ce97ed3d5d6bab89b447161a141fb02.png', 'uploads/event/2017event_38e37396a0ce97ed3d5d6bab89b447161a141fb03.png', '2017-12-30 00:00:10', '2017-10-25 18:05:36', '2018-02-03 13:51:13', 9),
(61, 'simba', 'ev1508074322', 'simba event', -2, '2017-10-01', '2017-10-31', 2, 5, 'Kimihurura', 0, 0, '/tmp/phpcmv6Bm', '/tmp/phpuAKBuF', '/tmp/phpIopanY', '2017-12-30 00:00:10', '2017-10-25 18:04:59', '2017-10-25 18:04:59', 1),
(62, 'house party kanombe', 'ev1508074322', 'we are going to chill this coming Friday don\'t miss ', -2, '2017-09-29', '2017-09-30', 12, 50, 'kanombe ', 0, 0, '', '', '', '2017-12-30 00:00:10', '2017-10-24 12:54:04', '2017-10-24 12:54:04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `eventing_pricing`
--

CREATE TABLE `eventing_pricing` (
  `id` int(11) NOT NULL,
  `event_code` int(11) NOT NULL,
  `pricing_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eventing_pricing`
--

INSERT INTO `eventing_pricing` (`id`, `event_code`, `pricing_code`) VALUES
(43, 74, 99),
(44, 75, 100),
(45, 75, 101),
(46, 76, 102),
(47, 76, 103),
(48, 77, 104),
(49, 77, 105),
(50, 83, 108),
(51, 83, 109),
(52, 83, 110),
(53, 84, 111),
(54, 84, 112),
(55, 84, 113),
(56, 85, 114),
(57, 85, 115),
(58, 86, 116),
(59, 86, 117),
(60, 86, 118),
(61, 87, 119),
(62, 87, 120),
(63, 1, 121),
(64, 1, 122),
(65, 1, 123),
(66, 2, 124),
(67, 2, 125),
(68, 2, 126),
(69, 3, 127),
(70, 3, 128),
(71, 3, 129);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id_event` int(11) NOT NULL,
  `Event_Name` varchar(100) DEFAULT NULL,
  `Event_Desc` varchar(255) DEFAULT NULL,
  `Event_Cover` text,
  `Event_Location` varchar(255) DEFAULT NULL,
  `phone` text,
  `Event_Start` datetime DEFAULT CURRENT_TIMESTAMP,
  `Event_End` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `active` enum('YES','NO') DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `createdDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `archive` enum('NO','YES') DEFAULT NULL,
  `archivedBy` int(11) DEFAULT NULL,
  `archivedDate` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id_event`, `Event_Name`, `Event_Desc`, `Event_Cover`, `Event_Location`, `phone`, `Event_Start`, `Event_End`, `user_id`, `active`, `createdBy`, `createdDate`, `updatedBy`, `updatedDate`, `archive`, `archivedBy`, `archivedDate`, `status`) VALUES
(1, 'Kigali Jazz Function', 'testDesc', 'https://akokanya.com/uploads/event/2018event_36a0f9685ff2a04ea28dd42b38def3251bc923e91.jpg', 'Kigali Serena Hotel', '0788556677', '2018-02-28 00:00:00', '2018-03-01 00:00:00', 1, NULL, 1, '2018-02-19 08:28:18', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Davido tour', 'Davido tour', 'images/davido.jpeg', 'Amahoro Stadium', '0788556677', '2018-03-03 00:00:00', '2018-03-03 00:00:00', 1, '', 1, '2018-02-22 08:48:13', NULL, NULL, NULL, NULL, NULL, 1),
(3, 'Fally Ipupa ', 'testDesc', 'test.jpg', 'Kigali Serena Hotel', '0788556677', '2018-03-17 00:00:00', '2018-03-18 00:00:00', 1, NULL, 1, '2018-02-20 10:38:38', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pricing`
--

CREATE TABLE `pricing` (
  `pricing_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `event_property` varchar(100) NOT NULL,
  `event_seats` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pricing`
--

INSERT INTO `pricing` (`pricing_id`, `price`, `event_property`, `event_seats`) VALUES
(99, 10000, 'All', 200),
(100, 20000, 'VIP', 1000),
(101, 10000, 'Other', 300),
(102, 10000, 'VIP', 100),
(103, 5000, 'Other', 200),
(104, 2000, 'vip', 20),
(105, 1000, 'other', 50),
(106, 10000, 'Good People', 1000),
(107, 10000, 'Good People', 1000),
(108, 30000, 'VVIP', 100),
(109, 20000, 'VIP', 1000),
(110, 10000, 'Others', 20000),
(111, 30000, 'VVIP', 100),
(112, 20000, 'VIP', 1000),
(113, 10000, 'Others', 20000),
(114, 30000, 'VVIP', 100),
(115, 15000, 'Couples', 200),
(116, 25000, 'VVIP', 50),
(117, 15000, 'VIP', 100),
(118, 5000, 'Others', 500),
(119, 50000, 'Vip', 100),
(120, 250, 'Others', 1000),
(121, 10000, 'Bronze', 500),
(122, 20000, 'Silver', 100),
(123, 160000, 'Gold', 30),
(124, 50000, 'VVIP', 200),
(125, 20000, 'VIP', 1000),
(126, 5000, 'OTHERS', 8200),
(127, 30000, 'VVIP', 100),
(128, 20000, 'VIP', 500),
(129, 5000, 'Others', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `price` float NOT NULL,
  `event` int(11) NOT NULL,
  `number` int(11) NOT NULL COMMENT 'number of people who could buy the ticket'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`id`, `name`, `price`, `event`, `number`) VALUES
(1, 'VIP', 10000, 2, 10),
(2, 'V-VIP', 30000, 2, 10);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `customer_pay_id` int(11) NOT NULL,
  `cust_event_choose` varchar(100) NOT NULL,
  `cust_pay_phone` text NOT NULL,
  `amount` int(11) NOT NULL,
  `cust_event_seats` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ticketCode` varchar(250) DEFAULT NULL,
  `paidStatus` varchar(50) DEFAULT NULL,
  `createdDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `createdBy` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`customer_pay_id`, `cust_event_choose`, `cust_pay_phone`, `amount`, `cust_event_seats`, `user_id`, `ticketCode`, `paidStatus`, `createdDate`, `createdBy`, `status`) VALUES
(17, '74', '07746154151', 10000, '99', 3, NULL, NULL, '2018-01-08 07:18:33', NULL, NULL),
(18, '75', '.0321515646468468468', 20000, '100', 3, NULL, NULL, '2018-01-08 07:18:33', NULL, NULL),
(19, '75', '078542666', 20000, '101', 3, NULL, NULL, '2018-01-08 07:18:33', NULL, NULL),
(20, '75', '', 20000, '100', 3, NULL, NULL, '2018-01-08 07:18:33', NULL, NULL),
(21, '75', '07855266544', 10000, '101', 3, NULL, NULL, '2018-01-08 07:18:33', NULL, NULL),
(22, '74', '07746154151', 10000, '99', 3, NULL, NULL, '2018-01-08 07:18:33', NULL, NULL),
(23, '74', '07854545454545', 10000, '99', 1, NULL, NULL, '2018-01-08 07:18:33', NULL, NULL),
(24, '76', '07555165465165', 5000, '103', 1, NULL, NULL, '2018-01-08 07:18:33', NULL, NULL),
(25, '75', '078523654', 10000, '101', 2, NULL, NULL, '2018-01-08 07:18:33', NULL, NULL),
(26, '76', '0785214566', 10000, '102', 2, NULL, NULL, '2018-01-08 07:18:33', NULL, NULL),
(27, '77', '078541236', 1000, '105', 1, NULL, NULL, '2018-01-08 07:18:33', NULL, NULL),
(28, '75', '07854454545431', 20000, '100', 3, NULL, NULL, '2018-01-08 07:18:33', NULL, NULL),
(29, '76', '07854126977', 10000, '102', 1, NULL, NULL, '2018-01-08 07:18:33', NULL, NULL),
(30, '76', '0785412544', 5000, '103', 1, NULL, NULL, '2018-01-08 07:18:33', NULL, NULL),
(31, '74', '0784848236', 10000, '99', 3, NULL, NULL, '2018-01-08 07:18:33', NULL, NULL),
(32, '74', '0784848236', 10000, '99', 3, '32d92188888888888888888888888851c6', NULL, '2018-01-08 07:19:09', NULL, NULL),
(33, '', '0784848236', 0, 'null', 3, '332d8f', NULL, '2018-01-08 07:21:23', NULL, NULL),
(34, '75', '0784848236', 20000, '100', 3, '3409a6', NULL, '2018-01-08 07:21:50', NULL, NULL),
(35, '76', '0784848236', 10000, '102', 3, '359a48', NULL, '2018-01-08 07:23:09', NULL, NULL),
(36, '77', '0784848236', 2000, '104', 3, '368368', 'PAID', '2018-01-08 07:25:48', NULL, 'UNUSED'),
(37, '83', '0784848236', 30000, '108', 3, '3710eb', 'PAID', '2018-01-08 07:27:34', 3, 'UNUSED'),
(38, '', '0784848236', 10000, '110', 3, '3888a5', 'PAID', '2018-01-08 07:27:53', 3, 'UNUSED'),
(39, '83', '0784848236', 10000, '110', 3, '394f8c', 'PAID', '2018-01-08 07:28:17', 3, 'UNUSED');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `password` int(11) NOT NULL,
  `phone` text NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fullname`, `password`, `phone`, `status`) VALUES
(1, 'Muhoza yves', 12345, '0782178563', 'admin'),
(2, 'Mugisha clement', 12345, '0783191816', 'client'),
(3, 'clement', 12345, '0784848236', 'client');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akokanya`
--
ALTER TABLE `akokanya`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eventing_pricing`
--
ALTER TABLE `eventing_pricing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id_event`);

--
-- Indexes for table `pricing`
--
ALTER TABLE `pricing`
  ADD PRIMARY KEY (`pricing_id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`customer_pay_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akokanya`
--
ALTER TABLE `akokanya`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `eventing_pricing`
--
ALTER TABLE `eventing_pricing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pricing`
--
ALTER TABLE `pricing`
  MODIFY `pricing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `customer_pay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
