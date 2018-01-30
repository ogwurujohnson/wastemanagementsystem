-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2018 at 04:22 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `tblogindetails`
--

CREATE TABLE `tblogindetails` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Table structure for table `tblpropertygroup`
--

CREATE TABLE `tblpropertygroup` (
  `id` int(11) NOT NULL,
  `property_name` varchar(255) NOT NULL,
  `property_price` int(245) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbltickets`
--

CREATE TABLE `tbltickets` (
  `id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `priority` varchar(255) NOT NULL,
  `property_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblticket_category`
--

CREATE TABLE `tblticket_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

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
  `access` varchar(30) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblwallet`
--

CREATE TABLE `tblwallet` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
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
-- Indexes for table `tblogindetails`
--
ALTER TABLE `tblogindetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

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
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `tblticket_category`
--
ALTER TABLE `tblticket_category`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `tblogindetails`
--
ALTER TABLE `tblogindetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblproperty`
--
ALTER TABLE `tblproperty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblpropertygroup`
--
ALTER TABLE `tblpropertygroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbltickets`
--
ALTER TABLE `tbltickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblticket_category`
--
ALTER TABLE `tblticket_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
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
-- Constraints for table `tblogindetails`
--
ALTER TABLE `tblogindetails`
  ADD CONSTRAINT `tblogindetails_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbluser` (`id`);

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
  ADD CONSTRAINT `tbltickets_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `tbluser` (`id`),
  ADD CONSTRAINT `tbltickets_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `tblticket_category` (`id`);

--
-- Constraints for table `tblwallet`
--
ALTER TABLE `tblwallet`
  ADD CONSTRAINT `tblwallet_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbluser` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
