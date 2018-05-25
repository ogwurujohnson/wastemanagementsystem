-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2018 at 04:19 PM
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
-- Table structure for table `tblpayments`
--

CREATE TABLE `tblpayments` (
  `id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `Transaction_Id` varchar(255) NOT NULL,
  `Amount` varchar(255) NOT NULL,
  `responseType` varchar(255) NOT NULL,
  `payReference` varchar(255) NOT NULL,
  `returnedReference` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpayments`
--

INSERT INTO `tblpayments` (`id`, `User_Id`, `Transaction_Id`, `Amount`, `responseType`, `payReference`, `returnedReference`, `description`, `status`, `Date`) VALUES
(1, 6, 'REF-00001', '50000', '', '', '', '', 0, '2018-02-16 22:37:28'),
(2, 9, 'REF-0002', '65000', '', '', '', '', 0, '2018-02-16 22:38:18'),
(3, 6, 'REF-0003', '25000', '', '', '', '', 0, '2018-02-16 22:38:38'),
(4, 9, 'REF-0004', '100000', '', '', '', '', 0, '2018-02-16 22:39:17'),
(5, 7, 'JB4290203', '6066000', '00', 'FBN|WEB|WEBDEMO|21-05-2018|242307|362271', '000629489617', 'Approved by Financial Institution', 0, '2018-05-21 13:14:18'),
(6, 7, 'JB9871313', '400000', '00', 'FBN|WEB|WEBDEMO|21-05-2018|242319|182128', '000629495829', 'Approved by Financial Institution', 0, '2018-05-21 13:16:10'),
(7, 7, 'JB9871313', '400000', '00', 'FBN|WEB|WEBDEMO|21-05-2018|242319|182128', '000629495829', 'Approved by Financial Institution', 0, '2018-05-21 13:17:31'),
(8, 7, 'JB9126324', '4000', '00', 'FBN|WEB|WEBDEMO|21-05-2018|242325|386982', '000629497246', 'Approved by Financial Institution><div class =', 1, '2018-05-21 13:21:44'),
(9, 7, 'JB9567243', '6000', '00', 'FBN|WEB|WEBDEMO|21-05-2018|242326|691772', '000629498182', 'Approved by Financial Institution><div class =', 1, '2018-05-21 13:25:59'),
(10, 11, 'JB9925623', '6000', '00', 'FBN|WEB|WEBDEMO|21-05-2018|242328|142998', '000629499755', 'Approved by Financial Institution', 0, '2018-05-21 13:32:11'),
(11, 7, '', '0', '', '', '', '', 0, '2018-05-22 10:58:53'),
(12, 7, '', '0', '', '', '', '', 0, '2018-05-22 11:02:15'),
(13, 7, 'JB7212353', '6000', '00', 'FBN|WEB|WEBDEMO|22-05-2018|242455|781028', '000629806494', 'Approved by Financial Institution', 0, '2018-05-22 12:11:31'),
(14, 7, 'JB5189217', '8000', '00', 'FBN|WEB|WEBDEMO|22-05-2018|242456|546792', '000629807669', 'Approved by Financial Institution', 0, '2018-05-22 12:16:34'),
(15, 7, 'JB8957699', '2000', '00', 'FBN|WEB|WEBDEMO|22-05-2018|242457|764131', '000629808395', 'Approved by Financial Institution', 0, '2018-05-22 12:19:42'),
(16, 7, 'JB3459729', '1000', '00', 'FBN|WEB|WEBDEMO|22-05-2018|242458|130850', '000629809292', 'Approved by Financial Institution', 0, '2018-05-22 12:23:12'),
(17, 7, 'JB3777803', '1000', '00', 'FBN|WEB|WEBDEMO|22-05-2018|242459|627381', '000629810550', 'Approved by Financial Institution><div class =', 1, '2018-05-22 12:27:52'),
(21, 7, 'JB1080617', '8900', '', '', '', '', 0, '2018-05-22 16:50:30'),
(22, 7, 'JB1068113', '8900', '', '', '', '', 0, '2018-05-22 16:58:52'),
(23, 7, 'JB6601433', '9000', '', '', '', '', 0, '2018-05-22 17:01:25'),
(24, 7, 'JB4720612', '9000', '', '', '', '', 0, '2018-05-22 17:03:08'),
(25, 7, 'JB3909488', '600', 'X03', '', '', 'Amount greater than daily transaction limit', 0, '2018-05-22 17:08:32'),
(26, 7, 'JB3036326', '8100', '', '', '', '', 0, '2018-05-23 07:32:53'),
(27, 7, 'JB3956948', '8100', '00', 'FBN|WEB|WEBDEMO|23-05-2018|242631|165362', '000630177230', 'Approved by Financial Institution', 1, '2018-05-23 13:41:03'),
(28, 7, 'JB8434405', '2100', '00', 'FBN|WEB|WEBDEMO|23-05-2018|242633|453121', '000630178163', 'Approved by Financial Institution', 1, '2018-05-23 13:46:46'),
(29, 7, 'JB1269498', '1100', '', '', '', '', 0, '2018-05-23 13:49:04'),
(31, 7, 'JB5814947', '1100', '', '', '', '', 0, '2018-05-23 13:57:22'),
(32, 7, 'JB5393930', '1100', '', '', '', '', 0, '2018-05-23 13:59:07'),
(33, 7, 'JB4205123', '1100', 'XS1', '', '', 'Your payment has exceeded the time required to pay', 1, '2018-05-23 14:01:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblpayments`
--
ALTER TABLE `tblpayments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `User_Id` (`User_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblpayments`
--
ALTER TABLE `tblpayments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblpayments`
--
ALTER TABLE `tblpayments`
  ADD CONSTRAINT `tblpayments_ibfk_1` FOREIGN KEY (`User_Id`) REFERENCES `tbluser` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
