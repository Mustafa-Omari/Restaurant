-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2021 at 06:41 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(9, 'Arden Campbell', 'judyvys', 'f3ed11bbdb94fd9ebdefbaf646ab94d3'),
(10, 'Boris Duffy', 'rimoget', 'f3ed11bbdb94fd9ebdefbaf646ab94d3'),
(14, 'Omar Ali', 'omarali', '25d55ad283aa400af464c76d713c07ad'),
(15, 'Adminstrator', 'admin', '25d55ad283aa400af464c76d713c07ad'),
(16, 'Mustafa Omari', 'mustafa ', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(3, 'Pizza', 'Food_Category_436.jpg', 'Yes', 'Yes'),
(4, 'Burger', 'Food_Category_639.jpg', 'Yes', 'Yes'),
(5, 'Momo', 'Food_Category_695.jpg', 'Yes', 'Yes'),
(11, 'Proident ut volupta', '', 'Yes', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(7, 'Dumplings Specials', 'Chicken Dumpling with herbs from mountains', '5.00', 'Food-Name-1215.jpg', 5, 'Yes', 'Yes'),
(8, 'Best Burger', 'Burger with Ham,  Pineapple , lots of Cheese', '4.00', 'Food-Name-8578.jpg', 4, 'Yes', 'Yes'),
(9, 'Smoke BBQ Pizza', 'Best Firewood Pizza in town ', '6.00', 'Food-Name-9818.jpg', 3, 'Yes', 'Yes'),
(13, 'Halloumi Burger', ' Halloumi Burger With Cranberry And Maple Sauce And Lettuce\r\n', '6.00', 'Food-Name-250.jpg', 4, 'Yes', 'Yes'),
(14, 'Vegetables Pizza', 'Made with Italian Sauce, Chicken, and organice vegetables.\r\n\r\n', '6.00', 'Food-Name-7295.jpg', 3, 'No', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(1, 'Best Burger', '4.00', 5, '20.00', '2021-03-17 05:34:31', 'Cancelled', 'Blair Hines', '+1 (912) 221-3414', 'wuzi@mailinator.com', 'Odit occaecat maxime'),
(2, 'Dumplings Specials', '4.00', 4, '16.00', '2021-03-17 05:45:21', 'On Dilevelry', 'Blair Hines', '+1 (912) 221-3414', 'wuzi@mailinator.com', 'Odit occaecat maxime'),
(4, 'Best Burger', '4.00', 2, '8.00', '2021-03-17 05:48:01', 'Ordered', 'Blair Hines', '+1 (912) 221-3414', 'wuzi@mailinator.com', 'Odit occaecat maxime'),
(5, 'Dumplings Specials', '4.00', 3, '12.00', '2021-03-17 05:49:35', 'Delivered', 'Blair Hines', '+1 (912) 221-3414', 'wuzi@mailinator.com', 'Odit occaecat maxime'),
(6, 'Smoke BBQ Pizza', '6.00', 3, '18.00', '2021-03-18 04:51:21', 'Delivered', 'Caleb Holmes', '+1 (772) 634-6524', 'xefaxigof@mailinator.com', 'Blanditiis numquam v'),
(7, 'Halloumi Burger', '6.00', 1, '6.00', '2021-05-30 04:46:44', 'Orderd', 'asdasdasd', 'asdsad', 'mostomari16@gmail.com', 'sdads');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
