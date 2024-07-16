-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2024 at 08:10 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cakey-bakey`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cake_name` varchar(100) NOT NULL,
  `price` varchar(20) NOT NULL,
  `picture` varchar(250) NOT NULL,
  `img` varchar(500) NOT NULL,
  `quantity` int(30) NOT NULL,
  `total_amount` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `cake_name`, `price`, `picture`, `img`, `quantity`, `total_amount`) VALUES
(27, 6, 'Wedding Cake', '15000', 'cake-images/wedding-cake.jpg', '', 0, 0),
(29, 6, 'Fruit Cake', '1700', 'cake-images/fruit-cake.jpg', '', 0, 0),
(30, 6, 'ice cream Cake', '1500', 'cake-images/icecream-cake.jpg', '', 0, 0),
(37, 8, 'brownie with ice cream', '5000', 'cake-images/ice-brownie.jpg', '', 0, 0),
(38, 8, 'Pastry Cake', '3200', 'cake-images/pastry-cake.jpg', '', 0, 0),
(40, 8, 'rainbow macroons', '1500', 'cake-images/macroons.jpg', '', 0, 0),
(41, 9, 'Chocalate Cake', '3500', 'cake-images/chocalate-cake.jpg', '', 0, 0),
(42, 9, 'fruit cheese Cake', '1500', 'cake-images/cheese-2.jpg', '', 0, 0),
(43, 9, 'waffles', '1800', 'cake-images/waffles.jpg', '', 0, 0),
(51, 6, 'Cookies', '3000', 'cake-images/cookies.jpg', '', 0, 0),
(62, 12, 'blue cup cake', '100', 'cake-images/bg.jpg', '', 0, 0),
(63, 12, 'orange cheese Cake', '6500', 'cake-images/cheese-4', '', 0, 0),
(64, 12, 'Wedding Cake', '15000', 'cake-images/wedding-cake.jpg', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ordered_iems`
--

CREATE TABLE `ordered_iems` (
  `order_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `quantity` int(10) NOT NULL,
  `price` int(30) NOT NULL,
  `payment_method` varchar(250) NOT NULL,
  `delivery_option` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ordered_iems`
--

INSERT INTO `ordered_iems` (`order_id`, `user_id`, `item_name`, `quantity`, `price`, `payment_method`, `delivery_option`) VALUES
(28, 6, 'Fruit Cake', 1, 1700, '', ''),
(29, 6, 'ice cream Cake', 1, 1500, '', ''),
(56, 8, 'Pastry Cake', 4, 3200, '', ''),
(64, 8, 'brownie with ice cream', 3, 5000, '', ''),
(65, 8, 'undefined', 0, 0, '', ''),
(66, 8, 'brownie with ice cream', 5, 5000, '', ''),
(67, 8, 'undefined', 0, 0, '', ''),
(68, 8, 'Pastry Cake', 3, 3200, '', ''),
(69, 8, 'undefined', 0, 0, '', ''),
(70, 8, 'rainbow macroons', 2, 1500, '', ''),
(71, 9, 'undefined', 0, 0, '', ''),
(74, 10, 'Fruit Cake', 1, 1700, '', ''),
(84, 10, 'Wedding Cake', 1, 15000, '', ''),
(86, 10, 'Chocalate Cake', 1, 3500, '', ''),
(99, 11, 'undefined', 0, 0, '', ''),
(105, 12, 'undefined', 0, 0, '', ''),
(107, 12, 'undefined', 0, 0, '', ''),
(111, 12, 'undefined', 0, 0, '', ''),
(113, 12, 'undefined', 0, 0, '', ''),
(115, 12, 'undefined', 0, 0, '', ''),
(116, 12, 'blue cup cake', 1, 100, '', ''),
(117, 12, 'undefined', 0, 0, '', ''),
(118, 12, 'orange cheese Cake', 2, 6500, '', ''),
(119, 12, 'undefined', 0, 0, '', ''),
(120, 12, 'Wedding Cake', 1, 15000, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(150) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(30) NOT NULL,
  `confirm_password` varchar(30) NOT NULL,
  `address` varchar(200) NOT NULL,
  `contact` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`user_id`, `user_name`, `email`, `password`, `confirm_password`, `address`, `contact`) VALUES
(1, 'BSCS0122011293', 'minuridahara709@gmail.com', '123', '123', 'dgdfh', '0761634517'),
(2, 'BSSE0122011288', 'jsandarudilshan@gmail.com', '156', '156', '49/karawketiya road balangoda', '422'),
(3, 'dfdf', 'dvfg', 'fgfh', 'dvfdgdh', 'dgfbh', 'fgfdg'),
(4, 'fgb', 'cdgbf', 'dfrg', 'dfh', 'fg', 'dfh'),
(5, 'fgbfdg', 'fdgfh', 'ghbgfh', 'fhfgjnhg', 'fhfgj', 'fbgfh'),
(6, 'minuri dahara kahangama', 'minuri@gmail.com', '123', '123', 'nugegoda', '0761634517'),
(7, 'sdasd', 'dasd', '123', '123', 'sdac', 'scacf'),
(8, 'minuri dahara', 'dcfdf@gmail.com', '123', '123', 'balangoda', '123456987'),
(9, 'dahara', 'dahara@gmail.com', '123', '123', '49/karawketiya road balangoda', '0761634517'),
(10, 'gayani', 'gayani@gmail.com', '159', '159', '49/karawketiya road balangoda', '0123678'),
(11, 'nisha', 'nisha@gmail.com', '1234', '1234', '49/karawketiya road balangoda', '0165423698'),
(12, 'abhi', 'abhi@gmail.com', '123', '123', '49/karawketiya road balangoda', '012548963');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id_fk` (`user_id`);

--
-- Indexes for table `ordered_iems`
--
ALTER TABLE `ordered_iems`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id_fk` (`user_id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `ordered_iems`
--
ALTER TABLE `ordered_iems`
  MODIFY `order_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user` int(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
