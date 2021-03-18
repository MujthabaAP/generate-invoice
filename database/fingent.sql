-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Mar 18, 2021 at 04:23 AM
-- Server version: 8.0.23
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fingent`
--

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int NOT NULL,
  `invoice_no` varchar(50) NOT NULL,
  `created_at` date NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `invoice_to` varchar(200) NOT NULL,
  `discount_type` varchar(20) NOT NULL,
  `sub_total_tax` float NOT NULL,
  `sub_total_without_tax` float NOT NULL,
  `net_total` float NOT NULL,
  `discount_value` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_no`, `created_at`, `is_active`, `invoice_to`, `discount_type`, `sub_total_tax`, `sub_total_without_tax`, `net_total`, `discount_value`) VALUES
(1, '16159992833821', '2021-03-17', 1, 'asd', 'PERCENTAGE', 72, 72, 72, 0),
(2, '1615999283821', '2021-03-17', 1, 'asd', 'PERCENTAGE', 72, 72, 72, 0),
(3, '1616001946285', '2021-03-17', 1, 'sadasd', 'PERCENTAGE', 12, 12, 12, 0),
(4, '1616002180031', '2021-03-17', 1, 'asdasd', 'PERCENTAGE', 1769.1, 1769, 1769, 0),
(5, '1616002546622', '2021-03-17', 1, 'sdfsdf', 'PERCENTAGE', 97, 97, 97, 0),
(6, '1616003284034', '2021-03-17', 1, 'asdsad', 'PERCENTAGE', 104425, 104425, 104425, 0),
(7, '1616003512731', '2021-03-17', 1, 'wqe', 'PERCENTAGE', 104425, 104425, 104425, 0),
(8, '1616003563809', '2021-03-17', 1, 'asd', 'PERCENTAGE', 64, 64, 64, 0),
(9, '1616003618663', '2021-03-17', 1, 'asd', 'PERCENTAGE', 743, 743, 743, 0),
(10, '1616003686973', '2021-03-17', 1, 'asdasd', 'PERCENTAGE', 4133, 4133, 4133, 0),
(11, '1616039192823', '2021-03-18', 1, 'Mujthaba AP\n8547872101', 'PERCENTAGE', 40.2, 40.2, 38.994, 3),
(12, '1616039937716', '2021-03-18', 1, 'sdf', 'PERCENTAGE', 6481650, 6481650, 6481650, 0),
(13, '1616040013747', '2021-03-18', 1, 'sdfsdf', 'PERCENTAGE', 107687, 107687, 104456, 3),
(14, '1616040704377', '2021-03-18', 1, '123', 'PERCENTAGE', 28818.9, 28818.9, 28818.9, 0);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

CREATE TABLE `invoice_items` (
  `id` int NOT NULL,
  `invoice_id` int NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `quantity` int NOT NULL,
  `unit_price` float NOT NULL,
  `tax` int NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `invoice_items`
--

INSERT INTO `invoice_items` (`id`, `invoice_id`, `item_name`, `quantity`, `unit_price`, `tax`, `is_active`) VALUES
(1, 3, 'qwqe', 1, 12, 1, 1),
(2, 4, 'qqq', 1, 12, 1, 1),
(3, 4, '3123', 34, 23, 5, 1),
(4, 4, 'werwer', 234, 4, 0, 1),
(5, 5, 'fsdf', 32, 3, 1, 1),
(6, 6, 'asd', 23, 4324, 5, 1),
(7, 7, 'asd', 23, 4324, 5, 1),
(8, 8, 'ds', 21, 3, 1, 1),
(9, 9, 'dsad', 23, 32, 1, 1),
(10, 10, '123', 123, 32, 5, 1),
(11, 11, 'Pen', 2, 10, 0, 1),
(12, 11, 'Book: the last girl', 1, 20, 1, 1),
(13, 12, 'sdfsdf', 234, 4234, 1, 1),
(14, 12, '423423', 234, 23423, 0, 1),
(15, 13, 'adsad', 23, 234, 1, 1),
(16, 13, 'fdgfg', 23, 4234, 5, 1),
(17, 14, 'asA', 213, 123, 10, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_invoice_id` (`invoice_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD CONSTRAINT `fk_invoice_id` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
