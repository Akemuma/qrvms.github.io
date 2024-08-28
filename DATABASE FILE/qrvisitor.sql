-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2024 at 08:01 PM
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
-- Database: `qrvisitor`
--
CREATE DATABASE IF NOT EXISTS `qrvisitor` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `qrvisitor`;

-- --------------------------------------------------------

--
-- Table structure for table `attendee`
--

DROP TABLE IF EXISTS `attendee`;
CREATE TABLE IF NOT EXISTS `attendee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(70) NOT NULL,
  `password` varchar(40) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `address` varchar(200) NOT NULL,
  `loc` varchar(40) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendee`
--

INSERT INTO `attendee` (`id`, `name`, `email`, `password`, `phone`, `address`, `loc`, `status`) VALUES(6, 'Test Attendee', 'testpass@mail.com', 'abe1bcf64eb68c39847b962e8caadadf', '0000002000', 'Ilorin', 'f3fc8566140434f0a3f47303c62d5146.jpg', 0);
INSERT INTO `attendee` (`id`, `name`, `email`, `password`, `phone`, `address`, `loc`, `status`) VALUES(8, 'Demo Account', 'demoaccount@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '7800000000', '100 Demo Address', '404a6378027a553d980b99162a5b4ce8.png', 0);
INSERT INTO `attendee` (`id`, `name`, `email`, `password`, `phone`, `address`, `loc`, `status`) VALUES(9, 'Dennis Nzioki', 'denno@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '+2547177831', 'begonia height 3B5', 'e30d8cd5357012c56a1badaf252639e3.jpg', 1);
INSERT INTO `attendee` (`id`, `name`, `email`, `password`, `phone`, `address`, `loc`, `status`) VALUES(10, 'Dennis Nzioki', 'wetry@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '0717783146', 'wetry@gmail.com', 'c800c77e63daaa2ff5144dae2676fd63.jpg', 1);
INSERT INTO `attendee` (`id`, `name`, `email`, `password`, `phone`, `address`, `loc`, `status`) VALUES(13, 'test oneone', 'test@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '0111111111', '1111', '3dddd26db4a5d532c16ae5621a7c6dca.jpg', 1);
INSERT INTO `attendee` (`id`, `name`, `email`, `password`, `phone`, `address`, `loc`, `status`) VALUES(14, 'yasmin Choma', 'yaska@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '0707650404', '23 amani court', '1f64b1aa994a1296b898d1f715ecda35.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `booked`
--

DROP TABLE IF EXISTS `booked`;
CREATE TABLE IF NOT EXISTS `booked` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `VisitSchedule_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `class` varchar(10) NOT NULL DEFAULT 'second',
  `no` int(11) NOT NULL DEFAULT 1,
  `seat` varchar(30) NOT NULL,
  `date` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `EventSchedule_id` (`VisitSchedule_id`,`user_id`,`payment_id`) USING BTREE,
  KEY `EventSchedule_id_2` (`VisitSchedule_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booked`
--

INSERT INTO `booked` (`id`, `VisitSchedule_id`, `payment_id`, `user_id`, `code`, `class`, `no`, `seat`, `date`) VALUES(35, 105, 46, 9, '2024/0105/1660', 'first', 5, 'F001 - F005', 'Mon, 04-Mar-2024 05:09:49 AM');
INSERT INTO `booked` (`id`, `VisitSchedule_id`, `payment_id`, `user_id`, `code`, `class`, `no`, `seat`, `date`) VALUES(36, 107, 47, 9, '2024/0107/1501', 'first', 1, 'F1', 'Wed, 20-Mar-2024 10:52:49 PM');
INSERT INTO `booked` (`id`, `VisitSchedule_id`, `payment_id`, `user_id`, `code`, `class`, `no`, `seat`, `date`) VALUES(37, 108, 51, 9, '2024/0108/1137', 'first', 1, 'F1', 'Thu, 21-Mar-2024 11:30:16 PM');
INSERT INTO `booked` (`id`, `VisitSchedule_id`, `payment_id`, `user_id`, `code`, `class`, `no`, `seat`, `date`) VALUES(38, 110, 53, 9, '2024/0110/1855', 'first', 2, 'F1 - F2', 'Fri, 22-Mar-2024 04:15:57 AM');
INSERT INTO `booked` (`id`, `VisitSchedule_id`, `payment_id`, `user_id`, `code`, `class`, `no`, `seat`, `date`) VALUES(39, 109, 54, 10, '2024/0109/1583', 'first', 1, 'F1', 'Sat, 23-Mar-2024 09:22:17 PM');
INSERT INTO `booked` (`id`, `VisitSchedule_id`, `payment_id`, `user_id`, `code`, `class`, `no`, `seat`, `date`) VALUES(40, 109, 55, 13, '2024/0109/2287', 'first', 2, 'F2 - F3', 'Sat, 23-Mar-2024 09:35:32 PM');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `first_seat` int(11) NOT NULL,
  `second_seat` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `name`, `first_seat`, `second_seat`) VALUES(15, 'Visitation', 1, 1);
INSERT INTO `event` (`id`, `name`, `first_seat`, `second_seat`) VALUES(16, 'Private birthday party', 20, 10);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `message` varchar(400) NOT NULL,
  `response` varchar(400) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `user_id`, `message`, `response`) VALUES(3, 6, 'Demo Test - 2', 'Are you sure that this is another test? ');
INSERT INTO `feedback` (`id`, `user_id`, `message`, `response`) VALUES(9, 6, 'Test Test Test Test Test', NULL);
INSERT INTO `feedback` (`id`, `user_id`, `message`, `response`) VALUES(11, 8, 'This is a demo test for feedback sections!!!', 'none');
INSERT INTO `feedback` (`id`, `user_id`, `message`, `response`) VALUES(12, 13, 'i didnt receive a good service', 'we working on that');

-- --------------------------------------------------------

--
-- Table structure for table `free`
--

DROP TABLE IF EXISTS `free`;
CREATE TABLE IF NOT EXISTS `free` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Event_id` int(11) NOT NULL,
  `Location_id` int(11) NOT NULL,
  `date` varchar(30) NOT NULL,
  `time` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Event_id` (`Event_id`),
  KEY `Location_id` (`Location_id`)
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `free`
--

INSERT INTO `free` (`id`, `Event_id`, `Location_id`, `date`, `time`) VALUES(106, 16, 22, '28-03-2024', '22:32');

-- --------------------------------------------------------

--
-- Table structure for table `host`
--

DROP TABLE IF EXISTS `host`;
CREATE TABLE IF NOT EXISTS `host` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(70) NOT NULL,
  `password` varchar(40) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `address` varchar(200) NOT NULL,
  `loc` varchar(40) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `host`
--

INSERT INTO `host` (`id`, `name`, `email`, `password`, `phone`, `address`, `loc`, `status`) VALUES(10, 'Dennis Nzioki', 'yes@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '0717783146', 'begonia height 3B5', 'ab1f7175cb5920c7694bdf6dd4cbe598.jpg', 1);
INSERT INTO `host` (`id`, `name`, `email`, `password`, `phone`, `address`, `loc`, `status`) VALUES(11, 'Host Hosting', 'host@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '0111111111', '111111', '40bf98a16cb0be3037107f4a70ed5945.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
CREATE TABLE IF NOT EXISTS `location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start` varchar(100) NOT NULL,
  `stop` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `start`, `stop`) VALUES(21, 'Siwaka', '');
INSERT INTO `location` (`id`, `start`, `stop`) VALUES(22, 'nyayo Gate a', 'nyayo gate b');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Attendee_id` int(11) NOT NULL,
  `EventSchedule_id` int(11) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `ref` varchar(100) NOT NULL,
  `date` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Attendee_id` (`Attendee_id`,`EventSchedule_id`),
  KEY `Attendee_id_2` (`Attendee_id`) USING BTREE,
  KEY `EventSchedule_id` (`EventSchedule_id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `Attendee_id`, `EventSchedule_id`, `amount`, `ref`, `date`) VALUES(46, 9, 105, '5050', 'PB50KCRQOO', 'Mon, 04-Mar-2024 05:09:49 AM');
INSERT INTO `payment` (`id`, `Attendee_id`, `EventSchedule_id`, `amount`, `ref`, `date`) VALUES(47, 9, 107, '21', 'S9HSL10MWC', 'Wed, 20-Mar-2024 10:52:49 PM');
INSERT INTO `payment` (`id`, `Attendee_id`, `EventSchedule_id`, `amount`, `ref`, `date`) VALUES(51, 9, 108, '13', '41QEYFFOS7', 'Thu, 21-Mar-2024 11:30:16 PM');
INSERT INTO `payment` (`id`, `Attendee_id`, `EventSchedule_id`, `amount`, `ref`, `date`) VALUES(53, 9, 110, '61', 'FPPA0NS6I1', 'Fri, 22-Mar-2024 04:15:57 AM');
INSERT INTO `payment` (`id`, `Attendee_id`, `EventSchedule_id`, `amount`, `ref`, `date`) VALUES(54, 10, 109, '31', 'TZZ4K4ZT8L', 'Sat, 23-Mar-2024 09:22:17 PM');
INSERT INTO `payment` (`id`, `Attendee_id`, `EventSchedule_id`, `amount`, `ref`, `date`) VALUES(55, 13, 109, '61', '8EHV6UL60Y', 'Sat, 23-Mar-2024 09:35:32 PM');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`) VALUES(1, 'admin@admin.com', 'c93ccd78b2076528346216b3b2f701e6');

-- --------------------------------------------------------

--
-- Table structure for table `visitschedule`
--

DROP TABLE IF EXISTS `visitschedule`;
CREATE TABLE IF NOT EXISTS `visitschedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Event_id` int(11) NOT NULL,
  `Location_id` int(11) NOT NULL,
  `date` varchar(30) NOT NULL,
  `time` varchar(10) NOT NULL,
  `first_fee` float NOT NULL,
  `second_fee` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Event_id` (`Event_id`),
  KEY `Location_id` (`Location_id`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visitschedule`
--

INSERT INTO `visitschedule` (`id`, `Event_id`, `Location_id`, `date`, `time`, `first_fee`, `second_fee`) VALUES(106, 15, 21, '20-03-2024', '16:00', 0, 0);
INSERT INTO `visitschedule` (`id`, `Event_id`, `Location_id`, `date`, `time`, `first_fee`, `second_fee`) VALUES(108, 15, 21, '23-03-2024', '12:20', 12, 1);
INSERT INTO `visitschedule` (`id`, `Event_id`, `Location_id`, `date`, `time`, `first_fee`, `second_fee`) VALUES(109, 15, 21, '25-03-2024', '05:10', 30, 10);
INSERT INTO `visitschedule` (`id`, `Event_id`, `Location_id`, `date`, `time`, `first_fee`, `second_fee`) VALUES(110, 15, 21, '01-04-2024', '05:10', 30, 10);
INSERT INTO `visitschedule` (`id`, `Event_id`, `Location_id`, `date`, `time`, `first_fee`, `second_fee`) VALUES(111, 16, 22, '30-03-2024', '17:45', 100, 30);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`Attendee_id`) REFERENCES `attendee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
