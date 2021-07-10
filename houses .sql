-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2021 at 08:19 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `houses`
--

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `house_series` varchar(255) NOT NULL,
  `payment_description` varchar(255) NOT NULL,
  `payment_amount` int(11) NOT NULL,
  `payment_period` varchar(255) NOT NULL,
  `datetime` datetime(6) NOT NULL,
  `year` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `house_details`
--

CREATE TABLE `house_details` (
  `id` int(11) NOT NULL,
  `house_series` varchar(255) NOT NULL,
  `full_rent` int(11) NOT NULL,
  `service_charge` int(11) NOT NULL,
  `water_bill` int(11) NOT NULL,
  `payment_period` varchar(255) NOT NULL,
  `year` year(4) NOT NULL,
  `datetime` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `statement`
--

CREATE TABLE `statement` (
  `id` int(11) NOT NULL,
  `house_series` varchar(255) NOT NULL,
  `payment_period` varchar(255) NOT NULL,
  `statement` varchar(255) NOT NULL,
  `datetime` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tenant_data`
--

CREATE TABLE `tenant_data` (
  `id` int(11) NOT NULL,
  `house_series` varchar(255) NOT NULL,
  `house_no` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `amount_paid` int(11) NOT NULL,
  `service_charge` int(11) NOT NULL,
  `water_bill` int(11) NOT NULL,
  `payment_period` varchar(255) NOT NULL,
  `year` year(4) NOT NULL,
  `datetime` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tenant_data`
--

INSERT INTO `tenant_data` (`id`, `house_series`, `house_no`, `name`, `amount_paid`, `service_charge`, `water_bill`, `payment_period`, `year`, `datetime`) VALUES
(1, 'A', 'A1', 'amos koech', 3000, 0, 0, '', 0000, '0000-00-00 00:00:00.000000'),
(2, 'B', 'B1', 'koech Bii', 89000, 0, 0, '', 0000, '0000-00-00 00:00:00.000000'),
(3, 'C', 'c3', 'bett tim', 17890, 0, 0, '', 0000, '0000-00-00 00:00:00.000000'),
(4, 'A', 'a1', 'G k', 1234, 43234, 1234, 'January', 2021, '2021-01-18 20:55:03.000000'),
(5, 'A', 'a1', 'jj kiovi', 223456, 3456, 34356, 'June', 2021, '2021-01-18 23:56:51.000000'),
(6, 'a', 'A1', 'amos koech', 0, 0, 460000, 'February', 2021, '2021-01-19 21:50:52.000000'),
(7, 'a', 'a2', 'jj kiovi', 2300, 123, 340, 'February', 2021, '2021-01-21 20:15:26.000000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `house_details`
--
ALTER TABLE `house_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statement`
--
ALTER TABLE `statement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tenant_data`
--
ALTER TABLE `tenant_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `house_details`
--
ALTER TABLE `house_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `statement`
--
ALTER TABLE `statement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tenant_data`
--
ALTER TABLE `tenant_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
