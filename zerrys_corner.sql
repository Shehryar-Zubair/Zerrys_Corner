-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2025 at 07:38 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zerrys_corner`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `c_id` int(11) NOT NULL,
  `c_Name` varchar(20) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `phone_no` varchar(20) NOT NULL,
  `c_Email` varchar(20) NOT NULL,
  `c_Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`c_id`, `c_Name`, `Address`, `phone_no`, `c_Email`, `c_Password`) VALUES
(1, 'Zubair', '2 Llannerch Road East, Colwyn Bay\",LL28 4DD', '02323019396', 'zubair@gmail.com', '123'),
(2, 'Baber', 'Lanyard Street 45 east manhattan city ', '2194920934', 'baber@gmail.com', '123'),
(9, 'Zehra', '1829 Chestnut Street ,Arizona', '01234567891', 'zehra@gmail.com', '123'),
(10, 'Shehryar', 'G.K.5/22, Kharadar', '12121121210', 'sherry@gmail.com', '123'),
(11, 'jabeen', 'FAST NUCES Landhi', '03321234567', 'jabeen@gmail.com', '123'),
(12, 'Abeer', '1829 Chestnut Street ,california', '123456678901', 'Abeer@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `f_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `feedback_type` varchar(50) NOT NULL,
  `feedback_text` text NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`f_id`, `c_id`, `feedback_type`, `feedback_text`, `submitted_at`) VALUES
(10, 9, 'Feedback', 'The Food was Amazing', '2024-11-24 16:09:05'),
(11, 10, 'Feedback', 'The Cake was WONDERFUL!!!!', '2024-11-25 06:36:20'),
(12, 10, 'Complaint', 'sandwich was cold:(', '2024-11-25 07:22:58'),
(13, 12, 'Complaint', 'bad food', '2024-11-25 08:06:03');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `m_id` int(10) NOT NULL COMMENT 'Item_id',
  `item_name` varchar(30) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`m_id`, `item_name`, `price`) VALUES
(1, 'Hot & Loaded', 3.50),
(2, 'No Strings Attached', 2.99),
(3, 'Macho Nacho', 3.50),
(4, 'Tiny But Mighty', 4.99),
(5, 'Wingin It', 3.99),
(6, 'Say Cheese!', 5.99),
(7, 'Creamy Carbonara', 6.99),
(8, 'Marios First Love', 6.99),
(9, 'Sear-iously Epic', 9.99),
(10, 'Stack Attack', 7.99),
(11, 'Wrap It Like Its Hot', 6.99),
(12, 'A Sweet Escape', 5.99),
(13, 'Fudged Up', 4.99),
(14, 'Bean There Done That', 3.99);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `o_id` int(11) NOT NULL,
  `c_id` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `order_date` timestamp NULL DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`o_id`, `c_id`, `total_price`, `order_date`, `status`) VALUES
(34, 9, 22.96, '2024-11-24 11:37:15', 'completed'),
(35, 9, 32.94, '2024-11-24 13:15:26', 'completed'),
(36, 10, 25.46, '2024-11-25 02:33:55', 'completed'),
(37, 10, 52.90, '2024-11-25 03:21:50', 'completed'),
(38, 12, 17.48, '2024-11-25 04:04:16', 'completed'),
(39, 9, 7.00, '2025-02-13 10:23:57', 'completed'),
(40, 9, 5.98, '2025-02-13 10:25:30', 'completed'),
(41, 9, 8.49, '2025-02-13 10:36:07', 'completed'),
(42, 9, 0.00, '2025-02-13 11:58:04', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `ot_id` int(11) NOT NULL,
  `o_id` int(11) NOT NULL,
  `m_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`ot_id`, `o_id`, `m_id`, `quantity`, `price`) VALUES
(124, 34, 11, 1, 6.99),
(125, 34, 12, 2, 5.99),
(127, 34, 14, 1, 3.99),
(129, 35, 5, 1, 3.99),
(130, 35, 2, 1, 2.99),
(131, 35, 6, 1, 5.99),
(132, 35, 9, 1, 9.99),
(133, 35, 13, 2, 4.99),
(134, 36, 3, 1, 3.50),
(135, 36, 7, 1, 6.99),
(136, 36, 13, 3, 4.99),
(137, 37, 10, 1, 7.99),
(138, 37, 13, 9, 4.99),
(139, 38, 11, 2, 6.99),
(140, 38, 3, 1, 3.50),
(141, 39, 3, 1, 3.50),
(142, 39, 3, 1, 3.50),
(143, 40, 2, 1, 2.99),
(144, 40, 2, 1, 2.99),
(147, 41, 3, 1, 3.50),
(148, 41, 4, 1, 4.99),
(150, 42, 1, 1, 2.99);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`f_id`),
  ADD KEY `c_id` (`c_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`o_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`ot_id`),
  ADD KEY `o_id` (`o_id`),
  ADD KEY `m_id` (`m_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `m_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Item_id', AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `ot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `customers` (`c_id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`o_id`) REFERENCES `orders` (`o_id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`m_id`) REFERENCES `menu` (`m_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
