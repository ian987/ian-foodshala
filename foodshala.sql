-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2020 at 06:51 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodshala`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cus_id` int(11) NOT NULL,
  `cus_name` varchar(255) COLLATE utf16_bin NOT NULL,
  `cus_email` varchar(255) COLLATE utf16_bin NOT NULL,
  `cus_contact` varchar(255) COLLATE utf16_bin NOT NULL,
  `cus_pref` enum('Vegetarian','Non-Vegetarian','','') COLLATE utf16_bin NOT NULL,
  `cus_password` varchar(255) COLLATE utf16_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cus_id`, `cus_name`, `cus_email`, `cus_contact`, `cus_pref`, `cus_password`) VALUES
(1, 'ian', 'ian@gmail.com', '9678618460', 'Non-Vegetarian', '123'),
(2, 'elena', 'elena@gmail.com', '6000405098', 'Vegetarian', '123'),
(3, 'Rocky ', 'rocky@gmail.com', '7896321457', 'Vegetarian', '456'),
(4, 'Braxy', 'braxy@gmail.com', '7896541239', 'Non-Vegetarian', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(255) COLLATE utf16_bin NOT NULL,
  `resturant_id` int(10) NOT NULL,
  `item_image` text COLLATE utf16_bin NOT NULL,
  `item_price` double NOT NULL,
  `item_category` enum('Vegetarian','Non-Vegetarian','','') COLLATE utf16_bin NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_name`, `resturant_id`, `item_image`, `item_price`, `item_category`, `status`) VALUES
(2, 'Fried chicken', 5, '61589069.jpg', 320, 'Non-Vegetarian', 1),
(3, 'chicken popcorn', 5, 'popcorn.jpg', 150, 'Non-Vegetarian', 1),
(4, 'pizza', 2, 'pizza.jpg', 500, 'Vegetarian', 1),
(5, 'Caffe Latte Grande', 6, 'caffe latte grande.jpg', 250, 'Vegetarian', 1),
(6, 'Caffe Mocha Grande', 6, 'mocha.jpg', 200, 'Vegetarian', 1),
(7, 'Cheese Danish', 6, 'danish.jpg', 280, 'Vegetarian', 1),
(8, 'Blueberry Scone', 6, 'scone.jpg', 185, 'Vegetarian', 1),
(9, 'Banana Nut Bread', 6, 'nut bread.jpg', 220, 'Vegetarian', 1),
(10, 'Stuffed Crust', 1, 'stuffed.jpg', 450, 'Non-Vegetarian', 1),
(11, 'Veggie Feast', 1, 'veggie feast.jpg', 325, 'Vegetarian', 1),
(12, 'Veggie Lover', 1, 'veggie lover.jpg', 385, 'Vegetarian', 1),
(13, 'Chicken Sausage', 1, 'chicken sausage.jpg', 455, 'Non-Vegetarian', 1),
(14, 'Chicken Tikka ', 1, 'tikka.jpg', 550, 'Non-Vegetarian', 1),
(15, 'Cloud 9 ', 2, 'cloud 9.jpg', 350, 'Vegetarian', 1),
(16, 'Chef Veg Wonder', 2, 'veg wonder.jpg', 275, 'Vegetarian', 1),
(17, 'Chicken Dominator', 2, 'dominator.jpg', 475, 'Non-Vegetarian', 1),
(18, 'Seventh Heaven', 2, 'seventh heaven.jpg', 450, 'Non-Vegetarian', 1),
(19, 'Cheese Pepperoni', 2, 'pepperoni.jpg', 365, 'Non-Vegetarian', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `item_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `item_id`, `customer_id`, `quantity`, `status`) VALUES
(31, 2, 1, 3, 1),
(32, 3, 1, 1, 1),
(33, 4, 2, 1, 1),
(34, 10, 3, 3, 1),
(35, 14, 3, 3, 1),
(36, 18, 3, 1, 1),
(37, 2, 3, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `resturant`
--

CREATE TABLE `resturant` (
  `res_id` int(11) NOT NULL,
  `res_name` varchar(255) COLLATE utf16_bin NOT NULL,
  `res_username` varchar(255) COLLATE utf16_bin NOT NULL,
  `res_password` varchar(255) COLLATE utf16_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `resturant`
--

INSERT INTO `resturant` (`res_id`, `res_name`, `res_username`, `res_password`) VALUES
(1, 'pizzahut', 'Pizza Hut', '123'),
(2, 'dominos', 'Dominos', '12345'),
(3, 'woakingmama', 'The Woaking Mama', '12345'),
(4, 'briyaniblues', 'Briyani Blues', '1456'),
(5, 'kfc', 'KFC', '123'),
(6, 'starbucks', 'StarBucks', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cus_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `resturant`
--
ALTER TABLE `resturant`
  ADD PRIMARY KEY (`res_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `resturant`
--
ALTER TABLE `resturant`
  MODIFY `res_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
