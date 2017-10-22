-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 02, 2017 at 08:55 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+8:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stinky`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `referto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `referto`) VALUES
(1, 'drinks', 'drinks descriptions', 0),
(2, 'snacks', 'snacks descriptions', 0),
(3, 'fruit juice', 'Fruit Juice', 1),
(4, 'soft drinks', 'Soft Drinks', 1),
(5, 'sports drinks', 'Sports Drinks', 1),
(6, 'energy drinks', 'Energy Drinks', 1),
(7, 'flavored drinking water', 'Flavored Drinking Water', 1),
(8, 'beer', 'Beer', 1),
(9, 'sodas', 'Sodas', 1),
(10, 'chicken wing', 'Chicken Wing', 2),
(11, 'test2', 'Test2', 2),
(12, 'test3', 'Test3', 1),
(13, 'test4', 'Test4', 2);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `address` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(32) NOT NULL,
  `register_date` datetime NOT NULL,
  `active_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `first_name`, `last_name`, `phone_number`, `address`, `email`, `password`, `register_date`, `active_date`) VALUES
(1, 'Toby', 'Mao', '8618224081279', 'CDUT', '513945442@qq.com', 'cce7d3b6f7dcb063a3c32263b5660ca6', '2017-05-19 10:04:03', '2017-06-02 13:51:29'),
(2, 'user2', 'user2', '1234', 'user2', '1234@56.com', '82bfd261c775a50ec038e1c75217eb93', '2017-05-30 00:00:00', '2017-05-31 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_address`
--

CREATE TABLE `delivery_address` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_address`
--

INSERT INTO `delivery_address` (`id`, `customer_id`, `address`) VALUES
(1, 1, 'Address1'),
(2, 1, 'SomeAddress');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`, `description`) VALUES
(1, 'test1', 'test1');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `first_name` varchar(60) NOT NULL,
  `last_name` varchar(60) NOT NULL,
  `job` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `department_id` int(11) NOT NULL,
  `login_user` varchar(60) NOT NULL,
  `active_key` text NOT NULL,
  `referto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `first_name`, `last_name`, `job`, `phone_number`, `department_id`, `login_user`, `active_key`, `referto`) VALUES
(0, 'Admin', 'Admin', 'Admin0', '1234', 1, 'admin', '1234', 0);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `invoices_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `order_id`, `invoices_date`) VALUES
(1, 10, '2017-06-02 10:07:23'),
(2, 9, '2017-06-14 00:00:00'),
(3, 11, '2017-06-02 12:37:31'),
(4, 12, '2017-06-02 12:44:12'),
(5, 13, '2017-06-02 13:59:47'),
(6, 14, '2017-06-02 14:00:21'),
(7, 15, '2017-06-02 14:15:25'),
(8, 17, '2017-06-02 14:16:40'),
(9, 20, '2017-06-02 14:27:07'),
(10, 24, '2017-06-02 14:33:59');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL,
  `required_date` datetime DEFAULT NULL,
  `ship_address` text,
  `shipped_date` datetime DEFAULT NULL,
  `freight` float(19,2) DEFAULT '5.00',
  `status_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `order_date`, `required_date`, `ship_address`, `shipped_date`, `freight`, `status_id`) VALUES
(1, 0, '2017-06-02 06:37:06', '2017-06-05 09:02:43', 'CD', '2017-06-01 00:00:00', NULL, 1),
(4, 1, '2017-06-02 08:45:21', '2017-06-05 14:00:17', 'CU', NULL, 5.00, 1),
(5, 2, '2017-06-02 09:02:43', '2017-06-05 09:02:43', 'CD', NULL, 5.00, 1),
(6, 1, '2017-06-02 09:41:06', '2017-06-05 14:00:17', 'CU', NULL, 5.00, 1),
(9, 1, '2017-06-02 09:58:13', '2017-06-05 14:00:17', 'CU', NULL, 5.00, 1),
(10, 1, '2017-06-02 10:07:19', '2017-06-05 14:00:17', 'CU', NULL, 5.00, 1),
(11, 1, '2017-06-02 12:37:27', '2017-06-05 14:00:17', 'CU', NULL, 5.00, 1),
(12, 1, '2017-06-02 12:44:08', '2017-06-05 14:00:17', 'CU', NULL, 5.00, 1),
(13, 1, '2017-06-02 13:59:36', '2017-06-05 14:00:17', 'CU', NULL, 5.00, 1),
(14, 1, '2017-06-02 14:00:17', '2017-06-05 14:00:17', 'CU', NULL, 5.00, 1),
(15, 1, '2017-06-02 14:15:20', '2017-06-05 14:15:20', 'U', NULL, 5.00, 1),
(16, 1, '2017-06-02 14:16:18', '2017-06-05 14:16:18', 'Y', NULL, 5.00, 1),
(17, 1, '2017-06-02 14:16:33', NULL, NULL, NULL, 5.00, 1),
(19, 1, '2017-06-02 14:25:26', '2017-06-05 14:25:26', 's', NULL, 5.00, 1),
(20, 1, '2017-06-02 14:25:48', '2017-06-05 14:25:48', 't', NULL, 5.00, 1),
(23, 1, '2017-06-02 14:33:02', '2017-06-05 14:33:04', 'CU', NULL, 5.00, 1),
(24, 1, '2017-06-02 14:33:28', '2017-06-05 14:33:31', 'T', NULL, 5.00, 1),
(26, 1, '2017-06-02 14:44:39', '2017-06-05 14:45:57', 'CDUT', NULL, 5.00, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders_status`
--

CREATE TABLE `orders_status` (
  `id` tinyint(4) NOT NULL,
  `status_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders_status`
--

INSERT INTO `orders_status` (`id`, `status_name`) VALUES
(0, 'New'),
(1, 'Invoiced'),
(2, 'Shipped'),
(3, 'Closed'),
(4, 'Canceled');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `temp_cutomer_id` int(11) NOT NULL,
  `unit_price` float(19,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `identifier_inventory` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `temp_cutomer_id`, `unit_price`, `quantity`, `identifier_inventory`) VALUES
(1, 1, 1, 1, 24.00, 5, 1),
(2, 1, 1, 1, 24.00, 3, 1),
(5, 4, 2, 1, 19.90, 3, 1),
(6, 5, 2, 2, 19.90, 1, 1),
(7, 6, 1, 1, 24.00, 3, 1),
(10, 9, 1, 1, 24.00, 1, 1),
(11, 10, 2, 1, 19.90, 1, 1),
(12, 11, 4, 1, 2.00, 10, 1),
(13, 12, 1, 1, 24.00, 1, 1),
(14, 13, 3, 1, 2.00, 4, 1),
(15, 14, 5, 1, 2.00, 1, 1),
(16, 15, 5, 1, 2.00, 1, 1),
(18, 16, 3, 1, 2.00, 1, 1),
(19, 17, 3, 1, 2.00, 1, 1),
(21, 19, 3, 1, 2.00, 1, 1),
(22, 19, 5, 1, 2.00, 1, 1),
(23, 20, 6, 1, 2.00, 1, 1),
(26, 23, 8, 1, 2.00, 3, 1),
(27, 24, 3, 1, 2.00, 1, 1),
(29, 26, 5, 1, 2.00, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_details_status`
--

CREATE TABLE `order_details_status` (
  `id` tinyint(1) NOT NULL,
  `name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_details_status`
--

INSERT INTO `order_details_status` (`id`, `name`) VALUES
(0, 'None'),
(1, 'Allocated'),
(2, 'Invoiced'),
(3, 'Shipped'),
(4, 'On Order'),
(5, 'No Stock');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `brand` varchar(60) NOT NULL,
  `category_id` int(11) NOT NULL,
  `flavor` varchar(60) NOT NULL,
  `size` text NOT NULL,
  `description` text NOT NULL,
  `unit_price` float(19,2) NOT NULL,
  `expiration_date` date NOT NULL,
  `date_added` date NOT NULL,
  `store_price` float(19,2) NOT NULL,
  `inventory` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `brand`, `category_id`, `flavor`, `size`, `description`, `unit_price`, `expiration_date`, `date_added`, `store_price`, `inventory`) VALUES
(1, 'Beer', 'Harbin', 3, '', '24 bottles', 'Nice beer', 24.00, '2017-07-01', '2017-06-02', 20.00, 974),
(2, 'fried chicken wings', 'TY', 44, '', '9pcs', 'Chicken Wing', 19.90, '2017-06-07', '2017-06-01', 16.00, 55),
(3, 'test', 'test', 4, 'test', 'test', 'test', 2.00, '2017-06-14', '2017-06-09', 1.00, 2),
(4, 'test', 'test', 4, 'test', 'test', 'test', 2.00, '2017-06-14', '2017-06-09', 1.00, 0),
(5, 'test', 'test', 4, 'test', 'test', 'test', 2.00, '2017-06-14', '2017-06-09', 1.00, 7),
(6, 'test', 'test', 4, 'test', 'test', 'test', 2.00, '2017-06-14', '2017-06-09', 1.00, 9),
(7, 'test', 'test', 4, 'test', 'test', 'test', 2.00, '2017-06-14', '2017-06-09', 1.00, 10),
(8, 'test', 'test', 4, 'test', 'test', 'test', 2.00, '2017-06-14', '2017-06-09', 1.00, 7),
(9, 'test', 'test', 4, 'test', 'test', 'test', 2.00, '2017-06-14', '2017-06-09', 1.00, 10),
(10, 'test', 'test', 4, 'test', 'test', 'test', 2.00, '2017-06-14', '2017-06-09', 1.00, 10);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_status`
--

CREATE TABLE `purchase_order_status` (
  `id` int(11) NOT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_order_status`
--

INSERT INTO `purchase_order_status` (`id`, `status`) VALUES
(0, 'New'),
(1, 'Submitted'),
(2, 'Approved'),
(3, 'Closed');

-- --------------------------------------------------------

--
-- Table structure for table `sql_log`
--

CREATE TABLE `sql_log` (
  `id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `query` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone_number` (`phone_number`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `register_date` (`register_date`,`active_date`);

--
-- Indexes for table `delivery_address`
--
ALTER TABLE `delivery_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`,`customer_id`,`order_date`),
  ADD KEY `id` (`id`,`customer_id`),
  ADD KEY `order_date` (`order_date`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `orders_status`
--
ALTER TABLE `orders_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`,`order_id`,`product_id`,`temp_cutomer_id`);

--
-- Indexes for table `order_details_status`
--
ALTER TABLE `order_details_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`,`unit_price`,`inventory`);

--
-- Indexes for table `purchase_order_status`
--
ALTER TABLE `purchase_order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sql_log`
--
ALTER TABLE `sql_log`
  ADD PRIMARY KEY (`id`,`datetime`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `delivery_address`
--
ALTER TABLE `delivery_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `sql_log`
--
ALTER TABLE `sql_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
