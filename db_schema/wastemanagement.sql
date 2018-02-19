-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 19, 2018 at 07:10 AM
-- Server version: 10.1.24-MariaDB
-- PHP Version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wastemanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblbilling`
--

CREATE TABLE `tblbilling` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `wallet_id` int(11) NOT NULL,
  `charge` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbllastlogin`
--

CREATE TABLE `tbllastlogin` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbllogindetails`
--

CREATE TABLE `tbllogindetails` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `access` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `activated` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbllogindetails`
--

INSERT INTO `tbllogindetails` (`id`, `email`, `password`, `access`, `user_id`, `activated`) VALUES
(2, 'daviddisu8@gmail.com', 'password', 'admin', 6, 1),
(3, 'ogwurujohnson@gmail.com', 'test', 'driver', 7, 1),
(4, 'tariak2@gmail.com', 'test', 'agent', 9, 0),
(5, 'json@mail.com', 'test', 'driver', 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblpayments`
--

CREATE TABLE `tblpayments` (
  `id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `Transaction_Id` varchar(255) NOT NULL,
  `Amount` varchar(255) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpayments`
--

INSERT INTO `tblpayments` (`id`, `User_Id`, `Transaction_Id`, `Amount`, `Date`) VALUES
(1, 6, 'REF-00001', '50000', '2018-02-16 22:37:28'),
(2, 9, 'REF-0002', '65000', '2018-02-16 22:38:18'),
(3, 6, 'REF-0003', '25000', '2018-02-16 22:38:38'),
(4, 9, 'REF-0004', '100000', '2018-02-16 22:39:17');

-- --------------------------------------------------------

--
-- Table structure for table `tblproperty`
--

CREATE TABLE `tblproperty` (
  `id` int(11) NOT NULL,
  `property_name` varchar(255) NOT NULL,
  `propertygroup_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblproperty`
--

INSERT INTO `tblproperty` (`id`, `property_name`, `propertygroup_id`, `address`, `user_id`, `date`) VALUES
(4, 'Compunet Limited', 1, 'Jos, Nigeria', 7, '2018-02-17 04:58:50'),
(5, 'New Property', 1, 'Nigeria', 6, '2018-02-15 02:24:08');

-- --------------------------------------------------------

--
-- Table structure for table `tblpropertygroup`
--

CREATE TABLE `tblpropertygroup` (
  `id` int(11) NOT NULL,
  `property_type` varchar(255) NOT NULL,
  `property_price` int(245) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpropertygroup`
--

INSERT INTO `tblpropertygroup` (`id`, `property_type`, `property_price`, `date`) VALUES
(1, 'Real Estate', 5000, '2018-01-23 22:32:07');

-- --------------------------------------------------------

--
-- Table structure for table `tbltickets`
--

CREATE TABLE `tbltickets` (
  `id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `priority` varchar(255) NOT NULL,
  `property_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pickup_date` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbltickets`
--

INSERT INTO `tbltickets` (`id`, `subject`, `status`, `priority`, `property_id`, `user_id`, `pickup_date`, `address`, `driver_id`, `date`) VALUES
(1, 'To Dispose My Waste', 'done', 'High', 4, 6, 'Today', 'Nigeria', 0, '2018-02-19 01:38:19'),
(4, 'Fish Head', 'ongoing', 'high', 5, 7, 'Tomorrow', 'Nigeria', 10, '2018-02-19 03:18:49');

-- --------------------------------------------------------

--
-- Table structure for table `tbltickettimeline`
--

CREATE TABLE `tbltickettimeline` (
  `id` int(11) NOT NULL,
  `Activity` varchar(255) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbltickettimeline`
--

INSERT INTO `tbltickettimeline` (`id`, `Activity`, `User_Id`, `Date`) VALUES
(1, 'Added new feature', 6, '2018-02-19 01:00:47'),
(2, 'New ticket created', 6, '2018-02-19 01:01:22');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`id`, `firstname`, `lastname`, `phone`, `email`, `address`, `date`) VALUES
(6, 'David', 'Disu', '08188621047', 'daviddisu8@gmail.com', '', '2018-01-24 05:23:12'),
(7, 'Johnson', 'Ogwuru', '0801122334', 'ogwurujohnson@gmail.com', '', '2018-01-26 22:11:27'),
(9, 'Gloria', 'Okoro', '08184748234', 'tariak2@gmail.com', 'Jos, Nigeria', '2018-02-15 12:43:06'),
(10, 'Johnson Jnr', 'Ogwuru', '093049593', 'json@mail.com', 'Somalia', '2018-02-19 02:29:59');

-- --------------------------------------------------------

--
-- Table structure for table `tblwallet`
--

CREATE TABLE `tblwallet` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `balance` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblbilling`
--
ALTER TABLE `tblbilling`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `wallet_id` (`wallet_id`);

--
-- Indexes for table `tbllastlogin`
--
ALTER TABLE `tbllastlogin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbllogindetails`
--
ALTER TABLE `tbllogindetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tblpayments`
--
ALTER TABLE `tblpayments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `User_Id` (`User_Id`);

--
-- Indexes for table `tblproperty`
--
ALTER TABLE `tblproperty`
  ADD PRIMARY KEY (`id`),
  ADD KEY `propertygroup_id` (`propertygroup_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tblpropertygroup`
--
ALTER TABLE `tblpropertygroup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbltickets`
--
ALTER TABLE `tbltickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_id` (`property_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbltickettimeline`
--
ALTER TABLE `tbltickettimeline`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbltickettimeline_ibfk_1` (`User_Id`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblwallet`
--
ALTER TABLE `tblwallet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblbilling`
--
ALTER TABLE `tblbilling`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbllastlogin`
--
ALTER TABLE `tbllastlogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbllogindetails`
--
ALTER TABLE `tbllogindetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tblpayments`
--
ALTER TABLE `tblpayments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tblproperty`
--
ALTER TABLE `tblproperty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tblpropertygroup`
--
ALTER TABLE `tblpropertygroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbltickets`
--
ALTER TABLE `tbltickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbltickettimeline`
--
ALTER TABLE `tbltickettimeline`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tblwallet`
--
ALTER TABLE `tblwallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblbilling`
--
ALTER TABLE `tblbilling`
  ADD CONSTRAINT `tblbilling_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbluser` (`id`),
  ADD CONSTRAINT `tblbilling_ibfk_2` FOREIGN KEY (`wallet_id`) REFERENCES `tblwallet` (`id`);

--
-- Constraints for table `tbllastlogin`
--
ALTER TABLE `tbllastlogin`
  ADD CONSTRAINT `tbllastlogin_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbluser` (`id`);

--
-- Constraints for table `tbllogindetails`
--
ALTER TABLE `tbllogindetails`
  ADD CONSTRAINT `tbllogindetails_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbluser` (`id`);

--
-- Constraints for table `tblpayments`
--
ALTER TABLE `tblpayments`
  ADD CONSTRAINT `tblpayments_ibfk_1` FOREIGN KEY (`User_Id`) REFERENCES `tbluser` (`id`);

--
-- Constraints for table `tblproperty`
--
ALTER TABLE `tblproperty`
  ADD CONSTRAINT `tblproperty_ibfk_1` FOREIGN KEY (`propertygroup_id`) REFERENCES `tblpropertygroup` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblproperty_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `tbluser` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbltickets`
--
ALTER TABLE `tbltickets`
  ADD CONSTRAINT `tbltickets_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `tblproperty` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbltickets_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `tbluser` (`id`);

--
-- Constraints for table `tbltickettimeline`
--
ALTER TABLE `tbltickettimeline`
  ADD CONSTRAINT `tbltickettimeline_ibfk_1` FOREIGN KEY (`User_Id`) REFERENCES `tbluser` (`id`);

--
-- Constraints for table `tblwallet`
--
ALTER TABLE `tblwallet`
  ADD CONSTRAINT `tblwallet_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbluser` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
