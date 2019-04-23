-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2019 at 05:06 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `train_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `loginfo`
--

CREATE TABLE `loginfo` (
  `user_id` int(100) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loginfo`
--

INSERT INTO `loginfo` (`user_id`, `firstname`, `lastname`, `Email`, `password`) VALUES
(1, 'Keshavan', 'selva', 'k7@gmail.com', '$2y$10$leE43uSAmNGePTCIX8nx2.R5dwE6Z8/EWzW0uIUzO6B');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `author` varchar(255) NOT NULL,
  `dates` varchar(255) NOT NULL,
  `Times` varchar(255) NOT NULL,
  `verify` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `title`, `description`, `author`, `dates`, `Times`, `verify`) VALUES
(24, 'Train derailed at Kurunegala', 'A Canadian Pacific Railway train derailed in a southeast Calgary rail yard Sunday morning.\r\n\r\nCalgary Fire Department said they responded to the derailment Alyth yard in southeast Calgary around 10:30 a.m.\r\n\r\nOf the 22 cars that derailed, 11 were hopper c', 'User', '2019-01-07', '07:22:26pm', 'VERIFIED'),
(26, 'Kandy Express Train Broke down at Polgahawela', 'A CP rail spokesperson said the derailment happened during switching just after 7 a.m., and the company is responding to the situation with crews and equipment.\r\n\r\nNo one was injured and an investigation is ongoing, the company said.\r\n\r\nOn Friday, a CP train derailed with multiple cars going off the tracks near Field, B.C., and a CN train derailed Wednesday near Jasper, Alta.', 'Admin', '2019-01-08', '07:22:26pm', 'VERIFIED'),
(27, 'Galle Express train is late today', 'Galle express train is late today due to unavoidable circumstances', 'User', '', '12:50:35', 'VERIFIED'),
(29, 'Train cancelled.!!', 'Badulla train cancelled today..', 'User', '2019-01-08', '12:57:59', 'VERIFIED');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `train_id` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `train_rating` varchar(255) NOT NULL,
  `comments` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`train_id`, `email`, `train_rating`, `comments`) VALUES
('T003', 'shamalka@gmail.com', '5.0', ''),
('T004', 'shamalka@gmail.com', '5.0', ''),
('T001', 'shamalka@gmail.com', '4.0', 'too much crowd'),
('T001', 'cloud.luckyloop@gmail.com', '5.0', 'Greate Train');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservation_id` int(255) NOT NULL,
  `train_id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `first_class_seats` text NOT NULL,
  `second_class_seats` text NOT NULL,
  `third_class_seats` text NOT NULL,
  `total_price` varchar(255) NOT NULL,
  `start_station` varchar(255) NOT NULL,
  `end_station` varchar(255) NOT NULL,
  `arrival_time` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`reservation_id`, `train_id`, `user_id`, `first_class_seats`, `second_class_seats`, `third_class_seats`, `total_price`, `start_station`, `end_station`, `arrival_time`, `date`, `status`, `quantity`) VALUES
(1, 'T001', 'shamalka@gmail.com', '', 'S1,S2', '', '500', 'Anuradhapura', 'Kurunegala', '', '2018/12/31', '', 3),
(2, 'T001', 'shamalka@gmail.com', 'F1,F2', '', '', '500', '', '', '', '2018/12/31', '', 1),
(3, 'T001', 'navod@gmail.com', 'F3', 'S3,S4,S4,S5,s6', '', '1000', '', '', '', '2018/12/31', '', 2),
(4, 'T001', 'shamalka@gmail.com', '', '', '', '800', '', '', '', '2018/12/31', 'PAID', 0),
(5, 'T001', 'shamalka@gmail.com', '', '', '', '500', '', '', '', '2018/12/31', 'PAID', 0),
(6, 'T001', 'shamalka@gmail.com', '', 'S6,S7', '', '1000', '', '', '', '2019/1/5', 'CANCEL', 0),
(7, 'T001', 'shamalka@gmail.com', '', 'S1,S2', '', '1000', 'Anuradhapura', 'Colombo', '', '2019/1/6', 'PAID', 0),
(90, 'T001', 'shamalka@gmail.com', '', 'S3,S4', '', '1000', 'Anuradhapura', 'Colombo', '7.00AM', '2019/1/6', 'PAID', 0),
(92, 'T001', 'shamalka@gmail.com', '', 'S5,S6', '', '1000', 'Anuradhapura', 'Colombo', '7.00AM', '2019/1/6', 'PAID', 0),
(98, 'T001', 'cloud.luckyloop@gmail.com', '', 'S7,S8', '', '1000', 'Anuradhapura', 'Colombo', '7.00AM', '2019/1/6', 'PAID', 0),
(107, 'T001', 'chanuka@gmail.com', '', 'S3', '', '500', 'Anuradhapura', 'Colombo', '7.00AM', '2019/1/7', 'PAID', 0),
(100, 'T001', 'chanuka@gmail.com', '', 'S9', '', '500', 'Anuradhapura', 'Colombo', '7.00AM', '2019/1/7', 'CANCEL', 0),
(106, 'T001', 'chanuka@gmail.com', '', 'S2', '', '500', 'Anuradhapura', 'Colombo', '7.00AM', '2019/1/7', 'PAID', 0),
(108, 'T001', 'chanuka@gmail.com', '', 'S4', '', '500', 'Anuradhapura', 'Colombo', '7.00AM', '2019/1/7', 'PAID', 0),
(110, 'T001', 'chanuka@gmail.com', 'F2,F3', '', '', '2000', 'Anuradhapura', 'Colombo', '7.00AM', '2019/1/7', 'PENDING', 0),
(111, 'T001', 'chanuka@gmail.com', '', 'S5', '', '500', 'Anuradhapura', 'Colombo', '7.00AM', '2019/1/7', 'PAID', 0),
(112, 'T001', 'cloud.luckyloop@gmail.com', '', 'S7', '', '500', 'Anuradhapura', 'Colombo', '7.00AM', '2019/1/7', 'PAID', 0),
(113, 'T001', 'cloud.luckyloop@gmail.com', '', 'S6', '', '500', 'Anuradhapura', 'Colombo', '7.00AM', '2019/1/7', 'PAID', 0),
(114, 'T001', 'cloud.luckyloop@gmail.com', '', 'S8', '', '500', 'Anuradhapura', 'Colombo', '7.00AM', '2019/1/7', 'PAID', 0),
(134, 'T001', '', '', '', '', '', 'Anuradhapura', 'Mahawa', '7.00AM', '2019/1/7', 'TEST', 0),
(132, 'T001', '', '', '', '', '', 'Anuradhapura', 'Mahawa', '7.00AM', '2019/1/7', 'TEST', 0),
(129, 'T001', 'cloud.luckyloop@gmail.com', '', '', '', '', 'Anuradhapura', 'Colombo', '7.00AM', '2019/1/30', 'PAID', 0),
(131, 'T001', '', '', '', '', '', 'Anuradhapura', 'Mahawa', '7.00AM', '2019/1/9', 'TEST', 0),
(130, 'T001', '', '', '', '', '', 'Anuradhapura', 'Mahawa', '7.00AM', '2019/1/8', 'TEST', 0),
(144, 'T001', 'cloud.luckyloop@gmail.com', '', 'S2,S3', '', '1000', 'Anuradhapura', 'Colombo', '7.00AM', '2019/1/25', 'CANCEL', 0),
(158, 'T014', 'pvchanukapamal@gmail.com', '', '', '', '', 'Anuradhapura', 'Colombo', '5.50AM', '2019/1/23', 'TEST', 0),
(159, 'T001', 'pvchanukapamal@gmail.com', '', '', '', '', 'Anuradhapura', 'Colombo', '7.00AM', '2019/1/17', 'TEST', 0),
(142, 'T001', 'cloud.luckyloop@gmail.com', '', 'S2,S3', '', '1000', 'Anuradhapura', 'Colombo', '7.00AM', '2019/1/23', 'PAID', 0),
(153, 'T013', 'cloud.luckyloop@gmail.com', '', 'S2,S3', '', '1000', 'Colombo', 'Anuradhapura', '5.50AM', '2019/1/17', 'PAID', 0),
(157, 'T014', 'pvchanukapamal@gmail.com', '', '', '', '', 'Anuradhapura', 'Colombo', '5.50AM', '2019/1/23', 'TEST', 0),
(147, 'T001', 'cloud.luckyloop@gmail.com', '', 'S1,S2', '', '1000', 'Anuradhapura', 'Maradana', '7.00AM', '2019/1/10', 'PAID', 0),
(156, 'T001', 'cloud.luckyloop@gmail.com', '', '', '', '', 'Anuradhapura', 'Colombo', '7.00AM', '2019/1/8', 'TEST', 0),
(151, 'T001', 'cloud.luckyloop@gmail.com', '', 'S4', '', '500', 'Anuradhapura', 'Colombo', '7.00AM', '2019/1/17', 'PAID', 0),
(160, 'T001', 'pvchanukapamal@gmail.com', '', 'S3,S5', '', '1000', 'Anuradhapura', 'Colombo', '7.00AM', '2019/1/17', 'PAID', 0),
(161, 'T001', 'shamalkanavod95@gmail.com', '', '', '', '', 'Anuradhapura', 'Colombo', '7.00AM', '2019/1/24', 'TEST', 0),
(162, 'T001', 'shamalkanavod95@gmail.com', '', 'S4,S5', '', '1000', 'Anuradhapura', 'Colombo', '7.00AM', '2019/1/24', 'CANCEL', 0),
(163, 'T001', 'shamalkanavod95@gmail.com', '', '', '', '', 'Anuradhapura', 'Colombo', '7.00AM', '2019/1/18', 'TEST', 0),
(164, 'T001', 'shamalkanavod95@gmail.com', '', 'S3,S4', '', '1000', 'Anuradhapura', 'Colombo', '7.00AM', '2019/1/18', 'PENDING', 0),
(165, 'T001', 'shamalkanavod95@gmail.com', '', '', '', '', 'Anuradhapura', 'Colombo', '7.00AM', '2019/1/18', 'TEST', 0),
(166, 'T001', 'shamalkanavod95@gmail.com', '', 'S7', '', '500', 'Anuradhapura', 'Colombo', '7.00AM', '2019/1/18', 'PENDING', 0),
(167, 'T001', 'shamalkanavod95@gmail.com', '', 'S7,S8', '', '1000', 'Anuradhapura', 'Colombo', '7.00AM', '2019/1/18', 'PENDING', 0),
(168, 'T001', 'cloud.luckyloop@gmail.com', '', '', '', '', 'Anuradhapura', 'Colombo', '7.00AM', '2019/1/25', 'TEST', 0),
(169, 'T001', 'cloud.luckyloop@gmail.com', '', 'S6,S7', '', '1000', 'Anuradhapura', 'Colombo', '7.00AM', '2019/1/25', 'PENDING', 0),
(170, 'T002', 'cloud.luckyloop@gmail.com', '', '', '', '', 'Anuradhapura', 'Colombo', '8.00AM', '2019/1/25', 'TEST', 0),
(171, 'T002', 'cloud.luckyloop@gmail.com', '', 'S4,S5', '', '1000', 'Anuradhapura', 'Colombo', '8.00AM', '2019/1/25', 'PENDING', 0);

-- --------------------------------------------------------

--
-- Table structure for table `seat`
--

CREATE TABLE `seat` (
  `train_id` int(11) NOT NULL,
  `first_class_seats` text NOT NULL,
  `second_class_seats` text NOT NULL,
  `thrid_class_seats` text NOT NULL,
  `sleping_berth` varchar(255) NOT NULL,
  `observation` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `train_id` varchar(255) NOT NULL,
  `first_class_seats` text NOT NULL,
  `second_class_seats` text NOT NULL,
  `third_class_seats` text NOT NULL,
  `sleping_berth` varchar(255) NOT NULL,
  `observation` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`train_id`, `first_class_seats`, `second_class_seats`, `third_class_seats`, `sleping_berth`, `observation`) VALUES
('T001', 'F1,F2,F3,F4,F5,F6,F7,F8,F9,F10', 'S1,S2,S3,S4,S5,S6,S7,S8,S9,S10', 'T1,T2,T3,T4,T5,T6,T7,T8,T9,T10', '', ''),
('T002', 'F1,F2,F3,F4,F5,F6,F7,F8,F9', 'S1,S2,S3,S4,S5,S6,S7,S8,S9,S10', 'T1,T2,T3,T4,T5,T6,T7,T8,T9,T10', '', ''),
('T003', 'F1,F2,F3,F4,F5,F6,F7,F8,F9,F10', 'S1,S2,S3,S4,S5,S6,S7,S8,S9,S10', 'T1,T2,T3,T4,T5,T6,T7,T8,T9,T10', '', ''),
('T004', 'F1,F2,F3,F4,F5,F6,F7,F8,F9', 'S1,S2,S3,S4,S5,S6,S7,S8,S9,S10', 'T1,T2,T3,T4,T5,T6,T7,T8,T9,T10', '', ''),
('T005', 'F1,F2,F3,F4,F5,F6,F7,F8,F9,F10', 'S1,S2,S3,S4,S5,S6,S7,S8,S9,S10', 'T1,T2,T3,T4,T5,T6,T7,T8,T9,T10', '', ''),
('T006', 'F1,F2,F3,F4,F5,F6,F7,F8,F9,F10', 'S1,S2,S3,S4,S5,S6,S7,S8,S9,S10', 'T1,T2,T3,T4,T5,T6,T7,T8,T9,T10', '', ''),
('T007', 'F1,F2,F3,F4,F5,F6,F7,F8,F9,F10', 'S1,S2,S3,S4,S5,S6,S7,S8,S9,S10', 'T1,T2,T3,T4,T5,T6,T7,T8,T9,T10', '', ''),
('T008', 'F1,F2,F3,F4,F5,F6,F7,F8,F9,F10', 'S1,S2,S3,S4,S5,S6,S7,S8,S9,S10', 'T1,T2,T3,T4,T5,T6,T7,T8,T9,T10', '', ''),
('T009', 'F1,F2,F3,F4,F5,F6,F7,F8,F9,F10', 'S1,S2,S3,S4,S5,S6,S7,S8,S9,S10', 'T1,T2,T3,T4,T5,T6,T7,T8,T9,T10', '', ''),
('T010', 'F1,F2,F3,F4,F5,F6,F7,F8,F9,F10', 'S1,S2,S3,S4,S5,S6,S7,S8,S9,S10', 'T1,T2,T3,T4,T5,T6,T7,T8,T9,T10', '', ''),
('T011', 'F1,F2,F3,F4,F5,F6,F7,F8,F9,F10', 'S1,S2,S3,S4,S5,S6,S7,S8,S9,S10', 'T1,T2,T3,T4,T5,T6,T7,T8,T9,T10', '', ''),
('T012', 'F1,F2,F3,F4,F5,F6,F7,F8,F9,F10', 'S1,S2,S3,S4,S5,S6,S7,S8,S9,S10', 'T1,T2,T3,T4,T5,T6,T7,T8,T9,T10', '', ''),
('T013', 'F1,F2,F3,F4,F5,F6,F7,F8,F9,F10', 'S1,S2,S3,S4,S5,S6,S7,S8,S9,S10', 'T1,T2,T3,T4,T5,T6,T7,T8,T9,T10', '', ''),
('T014', '', '', '', '', ''),
('T015', '', '', '', '', ''),
('T016', '', '', '', '', ''),
('T017', '', '', '', '', ''),
('T018', '', '', '', '', ''),
('T019', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `stations`
--

CREATE TABLE `stations` (
  `train_id` varchar(255) NOT NULL,
  `stations` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stations`
--

INSERT INTO `stations` (`train_id`, `stations`) VALUES
('T001', 'Vawniya,Anuradhapura,Mahawa,Kurunegala,Maradana,Colombo'),
('T002', 'Jaffna,Vawniya,Anuradhapura,Thalawa,Kurunegala,Gampaha,Maradana,Colombo'),
('T003', 'Colombo,Maradana,Kurunegala,Mahawa,Anuradhapura,Vawniya'),
('T004', 'Colombo,Maradana,Gampaha,Kurunegala,Thalawa,Anuradhapura,Vawniya,Jaffna'),
('T005', 'Colombo,Maradana,Gampaha,Kurunegala,Thalawa,Anurad...'),
('T006', 'Colombo,Maradana,Gampaha,Kurunegala,Thalawa,Anurad...'),
('T007', 'Colombo,Maradana,Gampaha,Kurunegala,Thalawa,Anurad...'),
('T010', 'Anuradhapura,Gampaha'),
('T011', 'Anuradhapura'),
('T012', 'Anuradhapura'),
('T013', 'Colombo,Gampaha,Kurunegala,Anuradhapura'),
('T014', 'Anuradhapura,Colombo,Gampaha,Kurunegala');

-- --------------------------------------------------------

--
-- Table structure for table `station_names`
--

CREATE TABLE `station_names` (
  `station_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `station_names`
--

INSERT INTO `station_names` (`station_id`, `name`) VALUES
(1, 'Anuradhapura'),
(2, 'Thalawa'),
(3, 'Galgamuwa'),
(4, 'Mahawa'),
(5, 'Kurunegala'),
(6, 'Polgahawela'),
(7, 'Gampaha'),
(8, 'Ragama'),
(9, 'Maradana'),
(10, 'Colombo');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_price`
--

CREATE TABLE `ticket_price` (
  `train_id` varchar(255) NOT NULL,
  `station` varchar(255) NOT NULL,
  `arrival_time` varchar(255) NOT NULL,
  `departure_time` varchar(255) NOT NULL,
  `first_class_price` int(255) NOT NULL,
  `second_class_price` int(255) NOT NULL,
  `third_class_price` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket_price`
--

INSERT INTO `ticket_price` (`train_id`, `station`, `arrival_time`, `departure_time`, `first_class_price`, `second_class_price`, `third_class_price`) VALUES
('T001', 'Vawniya', '6.00AM', '6.10AM', 0, 0, 0),
('T001', 'Anuradhapura', '7.00AM', '7.10AM', 0, 0, 0),
('T001', 'Mahawa', '8.00AM', '8.10AM', 0, 0, 0),
('T001', 'Kurunegala', '9.00AM', '9.10AM', 800, 400, 0),
('T001', 'Maradana', '10.00AM', '10.10AM', 1000, 500, 0),
('T001', 'Colombo', '11.00AM', '11.10AM', 1000, 500, 0),
('T002', 'Jaffna', '6.00AM', '6.10AM', 0, 0, 0),
('T002', 'Vawniya', '7.00AM', '7.10AM', 0, 0, 0),
('T002', 'Anuradhapura', '8.00AM', '8.10AM', 0, 0, 0),
('T002', 'Thalawa', '9.00AM', '9.10AM', 800, 400, 0),
('T002', 'Mahawa', '10.00AM', '10.10AM', 1000, 500, 0),
('T002', 'Kurunegala', '11.00AM', '11.10AM', 1000, 500, 0),
('T002', 'Gampaha', '12.00AM', '12.10AM', 1000, 500, 0),
('T002', 'Maradana', '1.00PM', '1.10PM', 1000, 500, 0),
('T002', 'Colombo', '2.00PM', '2.10PM', 1000, 500, 0),
('T003', 'Colombo', '4.00PM', '4.10PM', 0, 0, 0),
('T003', 'Kurunegala', '6.00PM', '6.10PM', 0, 300, 0),
('T003', 'Mahawa', '7.00PM', '7.10PM', 0, 500, 0),
('T003', 'Anuradhapura', '8.00PM', '8.10PM', 0, 500, 0),
('T003', 'Vawniya', '9.00PM', '9.10PM', 0, 600, 0),
('T004', 'Colombo', '1PM', '1.10PM', 0, 0, 0),
('T004', 'Maradana', '2.00PM', '2.10PM', 0, 0, 0),
('T004', 'Gampaha', '3.00PM', '3.10PM', 0, 300, 0),
('T004', 'Kurunegala', '4.00PM', '4.10PM', 0, 300, 0),
('T004', 'Mahawa', '5.00PM', '5.10PM', 0, 500, 0),
('T004', 'Thalawa', '6.00PM', '6.10PM', 0, 500, 0),
('T004', 'Anuradhapura', '7.00PM', '7.10PM', 0, 500, 1000),
('T004', 'Vawniya', '8.00PM', '8.10PM', 0, 600, 1000),
('T004', 'Jaffna', '9.00PM', '9.10PM', 0, 700, 1000),
('T005', 'Anuradhapura', '6.40', '6.40', 0, 500, 0),
('T005', 'Mahawa', '7.40', '7.50', 0, 500, 0),
('T006', 'Anuradhapura', '6.40', '7.50', 0, 500, 0),
('T006', 'Kurunegala', '6.40', '7.50', 0, 500, 0),
('T007', 'Anuradhapura', '6.40', '6.40', 0, 500, 0),
('T007', 'Gampaha', '6.40', '7.50', 0, 500, 0),
('T010', 'Anuradhapura', '6.40', '6.40', 0, 500, 0),
('T010', 'Gampaha', '6.40', '7.50', 0, 500, 0),
('T011', 'Anuradhapura', '6.40', '7.50', 0, 500, 0),
('T012', 'Anuradhapura', '7.40', '7.50', 0, 500, 0),
('T013', 'Colombo', '5.50AM', '6.00AM', 0, 0, 0),
('T013', 'Gampaha', '7.00AM', '7.10AM', 300, 200, 0),
('T013', 'Kurunegala', '8.00AM', '8.10AM', 600, 400, 0),
('T013', 'Anuradhapura', '9.00AM', '9.10AM', 1000, 500, 0),
('T014', 'Anuradhapura', '5.50AM', '6.00AM', 300, 500, 0),
('T014', 'Kurunegala', '6.40', '6.50', 500, 300, 0),
('T014', 'Gampaha', '8.00AM', '8.10AM', 1000, 500, 0),
('T014', 'Colombo', '9.00AM', '9.10AM', 1000, 500, 0);

-- --------------------------------------------------------

--
-- Table structure for table `trains`
--

CREATE TABLE `trains` (
  `train_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `start_station` varchar(255) NOT NULL,
  `end_station` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trains`
--

INSERT INTO `trains` (`train_id`, `name`, `type`, `start_station`, `end_station`, `time`) VALUES
('T001', 'Vawniya Intercity Express', '9/10', 'Vawniya', 'Colombo', '3.55PM'),
('T002', 'Rajarata Rajina', '6/10', 'Anuradhapura', 'Colombo', '6.35AM'),
('T003', 'Vawniya Intercity Express Down', '8/10', 'Colombo', 'Vawniya', '7.00AM'),
('T004', 'Rajarata Rajina Down', '9/10', 'Colombo', 'Anuradhapura', '12.10PM'),
('T005', 'Yal Devi', '9/10', 'Colombo', 'Anuradhapura', '12.12PM'),
('T006', 'Yal Devi Down', '', '', '', ''),
('T007', 'Kandy Express', '', '', '', ''),
('T010', 'Test Train', '', '', '', ''),
('T011', 'Testing', '', '', '', ''),
('T012', 'Test 3', '', '', '', ''),
('T013', 'Yal Devi', '', '', '', ''),
('T014', 'Test Train 014', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `nic` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`name`, `email`, `password`, `phone_number`, `nic`, `status`) VALUES
('', '', '', '', '', ''),
('Shamalka', 'cloud.luckyloop2@gmail.com', '0713631082', '0711234567', '9543193721v', ''),
('Shamalka', 'cloud.luckyloop@gmail.com', '555589ffb7ea2a8ddfa24cea8b5b62269fbaa3c0d09d7b259d44030188dbc5e6', '0713631082', '7372772v', 'ACTIVE'),
('fgaha', 'gahaj', 'gahsh', '', '', ''),
('Gayan', 'gayan@gmail.com', '123456789', '', '', ''),
('Nimal', 'nimal@gmail.com', '555589ffb7ea2a8ddfa24cea8b5b62269fbaa3c0d09d7b259d44030188dbc5e6', '0713636122', '7271881939v', 'ACTIVE'),
('Niranga', 'niranga@gmail.com', '555589ffb7ea2a8ddfa24cea8b5b62269fbaa3c0d09d7b259d44030188dbc5e6', '0713621023', '959273729v', 'ACTIVE'),
('Pamaljith', 'pamaljith@gmail.com', '555589ffb7ea2a8ddfa24cea8b5b62269fbaa3c0d09d7b259d44030188dbc5e6', '0713618192', '9529301071v', ''),
('pavithra', 'pavithra@gmail.com', '12345678', '', '', ''),
('Supul', 'pvchanukapamal@gmail.com', '555589ffb7ea2a8ddfa24cea8b5b62269fbaa3c0d09d7b259d44030188dbc5e6', '0713631072', '618388391v', 'ACTIVE'),
('shamalka', 'shamalka@gmail.com', '0713631082', '', '', ''),
('shamalka', 'shamalkanavod95@gmail.com', '03431299c60cb3362405b4dc1d1be2ee924ab2a67d2445ac2beaeb3646ac3666', '0713631072', '937447281v', 'ACTIVE'),
('Shamalka', 'shamalkanavod@gmail.com', '0713631082', '', '', ''),
('shamalka', 'sng@gmail.com', '0713631082', '', '', ''),
('Thari', 'thari@gmail.com', '555589ffb7ea2a8ddfa24cea8b5b62269fbaa3c0d09d7b259d44030188dbc5e6', '0713626281', '952819101v', 'ACTIVE'),
('Tharindya', 'tharindya@gmail.com', 'shamalka', '0713631082', '963150743v', ''),
('gsjsh', 'vajav', 'aja', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `loginfo`
--
ALTER TABLE `loginfo`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`train_id`,`email`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`);

--
-- Indexes for table `seat`
--
ALTER TABLE `seat`
  ADD PRIMARY KEY (`train_id`);

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`train_id`);

--
-- Indexes for table `stations`
--
ALTER TABLE `stations`
  ADD PRIMARY KEY (`train_id`);

--
-- Indexes for table `station_names`
--
ALTER TABLE `station_names`
  ADD PRIMARY KEY (`station_id`);

--
-- Indexes for table `ticket_price`
--
ALTER TABLE `ticket_price`
  ADD PRIMARY KEY (`train_id`,`station`);

--
-- Indexes for table `trains`
--
ALTER TABLE `trains`
  ADD PRIMARY KEY (`train_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `loginfo`
--
ALTER TABLE `loginfo`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT for table `station_names`
--
ALTER TABLE `station_names`
  MODIFY `station_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
