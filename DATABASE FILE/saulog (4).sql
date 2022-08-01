-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2022 at 05:55 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saulog`
--

-- --------------------------------------------------------

--
-- Table structure for table `booked`
--

CREATE TABLE `booked` (
  `id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `class` varchar(10) NOT NULL DEFAULT 'second',
  `no` int(11) NOT NULL DEFAULT 1,
  `seat` varchar(30) NOT NULL,
  `date` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booked`
--

INSERT INTO `booked` (`id`, `schedule_id`, `payment_id`, `user_id`, `code`, `class`, `no`, `seat`, `date`) VALUES
(35, 117, 52, 11, '2022/0117/1652', 'first', 1, '', 'Mon, 01-Aug-2022 04:46:22 AM');

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE `bus` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `first_seat` int(11) NOT NULL,
  `plate_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`id`, `name`, `first_seat`, `plate_number`) VALUES
(14, 'Ordinary', 61, 'AbcD123'),
(16, 'Ordinary', 50, 'Zbv222');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` varchar(400) NOT NULL,
  `response` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `passenger`
--

CREATE TABLE `passenger` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(70) NOT NULL,
  `password` varchar(40) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `address` varchar(200) NOT NULL,
  `loc` varchar(40) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `passenger`
--

INSERT INTO `passenger` (`id`, `name`, `email`, `password`, `phone`, `address`, `loc`, `status`) VALUES
(10, 'Red Dalunos', 'reddalunos@gmail.com', '6ed0035385e538afeabd92fbaf9a3ae2', '09569961990', '37.b simpson st.', 'f6960646a6ec637a011340f1a4041189.jpg', 1),
(11, 'Demo account', 'demoacct@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '09892929292', 'f3f23f23f23f32f32fff', '2dcae8fa5122337fc7c29a5de4bdf20c.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `passenger_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `ref` varchar(100) NOT NULL,
  `date` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `passenger_id`, `schedule_id`, `amount`, `ref`, `date`) VALUES
(46, 11, 117, '505', 'R81JWDTDQV', 'Mon, 01-Aug-2022 04:40:51 AM'),
(47, 11, 117, '505', 'R81JWDTDQV', 'Mon, 01-Aug-2022 04:42:41 AM'),
(48, 11, 117, '505', 'R81JWDTDQV', 'Mon, 01-Aug-2022 04:43:52 AM'),
(49, 11, 117, '505', 'R81JWDTDQV', 'Mon, 01-Aug-2022 04:43:57 AM'),
(50, 11, 117, '505', 'R81JWDTDQV', 'Mon, 01-Aug-2022 04:45:28 AM'),
(51, 11, 117, '505', 'R81JWDTDQV', 'Mon, 01-Aug-2022 04:46:06 AM'),
(52, 11, 117, '505', 'R81JWDTDQV', 'Mon, 01-Aug-2022 04:46:22 AM');

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

CREATE TABLE `route` (
  `id` int(11) NOT NULL,
  `start` varchar(100) NOT NULL,
  `stop` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `route`
--

INSERT INTO `route` (`id`, `start`, `stop`) VALUES
(20, 'Cavite', 'Olongapo'),
(21, 'Olongapo', 'Cavite'),
(22, 'Pasay', 'Olongapo'),
(23, 'Olongapo', 'Pasay'),
(24, 'PITX', 'Cavite'),
(25, 'Cavite', 'PITX');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL,
  `date` varchar(30) NOT NULL,
  `time` varchar(10) NOT NULL,
  `fee` float NOT NULL,
  `bus_id` int(11) NOT NULL,
  `bus_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `route_id`, `date`, `time`, `fee`, `bus_id`, `bus_number`) VALUES
(105, 20, '29-07-2022', '05:15', 500, 14, 0),
(113, 23, '31-07-2022', '13:45', 555, 14, 0),
(114, 20, '31-07-2022', '13:14', 555, 14, 2222),
(117, 22, '05-08-2022', '00:39', 500, 14, 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`) VALUES
(1, 'admin@admin.com', 'D00F5D5217896FB7FD601412CB890830');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booked`
--
ALTER TABLE `booked`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `schedule_id` (`schedule_id`,`user_id`,`payment_id`) USING BTREE,
  ADD KEY `schedule_id_2` (`schedule_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plate_number` (`plate_number`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `passenger`
--
ALTER TABLE `passenger`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_ibfk_1` (`passenger_id`),
  ADD KEY `payment_ibfk_2` (`schedule_id`);

--
-- Indexes for table `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `route_id` (`route_id`),
  ADD KEY `schedule_ibfk_1` (`bus_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booked`
--
ALTER TABLE `booked`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `bus`
--
ALTER TABLE `bus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `passenger`
--
ALTER TABLE `passenger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `route`
--
ALTER TABLE `route`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booked`
--
ALTER TABLE `booked`
  ADD CONSTRAINT `booked_ibfk_1` FOREIGN KEY (`schedule_id`) REFERENCES `schedule` (`id`),
  ADD CONSTRAINT `booked_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `passenger` (`id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`passenger_id`) REFERENCES `passenger` (`id`),
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`schedule_id`) REFERENCES `schedule` (`id`);

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`bus_id`) REFERENCES `bus` (`id`),
  ADD CONSTRAINT `schedule_ibfk_2` FOREIGN KEY (`route_id`) REFERENCES `route` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
