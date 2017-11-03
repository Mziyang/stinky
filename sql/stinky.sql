-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 03, 2017 at 03:57 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


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
(5, 'other drinks', 'Sports Drinks', 1),
(6, 'energy drinks', 'Energy Drinks', 1),
(7, 'beer', 'Flavored Drinking Water', 1),
(8, 'top snacks', 'Beer', 2),
(9, 'energy food', 'Sodas', 2),
(10, 'chicken wing', 'Chicken Wing', 2),
(11, 'newcategory1', 'newcategory1desc', 2);

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
(1, 'Toby', 'Mao', '8618224081279', 'CDUT', '513945442@qq.com', '82bfd261c775a50ec038e1c75217eb93', '2017-10-14 14:35:23', '2017-11-03 10:54:42');

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
(2, 1, 'Address2');

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
(1, 2, '2017-10-14 19:31:37'),
(2, 3, '2017-10-19 11:14:37'),
(3, 5, '2017-11-01 23:40:11');

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
(1, 1, '2017-10-14 19:30:47', '2017-10-17 19:30:47', 'CDUT', NULL, 5.00, 1),
(2, 1, '2017-10-14 19:31:25', '2017-10-17 19:31:25', 'CDUT2', NULL, 5.00, 1),
(3, 1, '2017-10-19 11:13:43', '2017-10-22 11:13:43', 'CDUT', NULL, 5.00, 1),
(4, 1, '2017-11-01 23:39:06', '2017-11-04 23:39:06', 'new', NULL, 5.00, 1),
(5, 1, '2017-11-01 23:40:00', '2017-11-04 23:40:03', 'sdafadsaf', NULL, 5.00, 1);

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
(6, 1, 3, 1, 3.00, 1, 1),
(7, 1, 5, 1, 2.00, 1, 1),
(8, 2, 4, 1, 2.00, 1, 1),
(14, 3, 3, 1, 3.00, 1, 1),
(21, 4, 19, 1, 0.00, 1, 1),
(22, 4, 19, 1, 0.00, 4, 1),
(23, 5, 4, 1, 2.00, 1, 1);

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
  `name` text CHARACTER SET utf8 NOT NULL,
  `img` text CHARACTER SET utf8 NOT NULL,
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

INSERT INTO `products` (`id`, `name`, `img`, `brand`, `category_id`, `flavor`, `size`, `description`, `unit_price`, `expiration_date`, `date_added`, `store_price`, `inventory`) VALUES
(1, '加多宝凉茶植物饮料', '36.90 加多宝凉茶植物饮料盒装250ml*24 箱装.jpg', 'Harbin', 5, 'flavor1', '24 bottles', 'Nice beer', 24.00, '2017-07-01', '2017-06-02', 20.00, 332),
(2, '可口可乐330ml', '38.80 可口可乐330ml*24听整箱.jpg', 'TY', 4, 'flavor1', '9pcs', 'Chicken Wing', 19.90, '2017-06-07', '2017-06-01', 16.00, 55),
(3, '锐澳（RIO）洋酒 鸡尾酒', '75.00 锐澳（RIO）洋酒 鸡尾酒 预调酒果酒混合装（六种口味）275ml*6瓶.jpg', 'brand1', 7, 'default', 'test', '', 3.00, '2017-06-14', '2017-06-09', 2.00, 0),
(4, '雪碧 330ml', '38.80 雪碧 330ml*24听箱.jpg', 'brand2', 4, 'flavor1', 'test', 'test', 2.00, '2017-06-14', '2017-06-09', 2.00, 6),
(5, '芬达碳酸饮料', '39.80 芬达碳酸饮料330ml*24听 整箱.jpg', 'brand2', 4, 'flavor2', 'test', 'test', 2.00, '2017-06-14', '2017-06-09', 1.00, 6),
(6, '雪碧 500ml', '59.90 雪碧 500ml*24箱.jpg', 'brand2', 4, 'flavor3', 'test', 'test', 2.00, '2017-06-14', '2017-06-09', 1.00, 9),
(7, '养元', '61.90 养元240ml*20.jpg', 'brand3', 6, 'flavor1', 'test', 'test', 2.00, '2017-06-14', '2017-06-09', 1.00, 10),
(8, '雀巢（Nestle） (丝滑拿铁)咖啡', '77.90 雀巢（Nestle） (丝滑拿铁)咖啡268ml*15瓶.jpg', 'brand3', 5, 'flavor2', 'test', 'test', 2.00, '2017-06-14', '2017-06-09', 3.00, 7),
(9, '红牛维生素功能饮料250ml', '135.00 红牛维生素功能饮料250ml*24罐 整箱.jpg', 'brand3', 6, 'flavor3', 'test', 'test', 2.00, '2017-06-14', '2017-06-09', 1.00, 10),
(10, '红牛牛磺酸强化型饮料250ml', '149.00 红牛牛磺酸强化型饮料250ml*24罐 整箱.jpg', 'brand4', 6, 'flavorN', 'test', 'test', 2.00, '2017-06-14', '2017-06-09', 1.00, 10),
(11, '士力架花生夹心巧克力', '13.9 士力架花生夹心巧克力（分享装）糖果巧克力休闲零食240g.jpg', '', 8, '', '', '', 0.00, '0000-00-00', '0000-00-00', 0.00, 9),
(12, '德芙Dove巧克力分享碗装', '29.90 德芙Dove巧克力分享碗装 丝滑牛奶巧克力糖果巧克力休闲零食252g.jpg', '', 8, '', '', '', 0.00, '0000-00-00', '0000-00-00', 0.00, 4),
(13, ' 好时（Hershey’s）Kisses袋装散装', '45.90 好时（Hershey’s）Kisses袋装散装 牛奶巧克力(电商版红色) 糖果休闲零食500g.jpg', '', 8, '', '', '', 0.00, '0000-00-00', '0000-00-00', 0.00, 6),
(14, '伊利 安慕希希腊风味常温酸奶原味', '59.20 伊利 安慕希希腊风味常温酸奶原味205g*12盒 礼盒装.jpg', '', 6, '', '', '', 0.00, '0000-00-00', '0000-00-00', 0.00, 111),
(15, '京东海外直采 费列罗Ferrero Rocher榛子牛奶巧克力礼盒', '72.00 京东海外直采 费列罗Ferrero Rocher榛子牛奶巧克力礼盒30粒 意大利进口 375g.jpg', '', 8, '', '', '', 0.00, '0000-00-00', '0000-00-00', 0.00, 55),
(16, '韩国进口 韩国农协 蜂蜜柚子茶', '42.90 韩国进口 韩国农协 蜂蜜柚子茶1000g.jpg', '', 5, '', '', '', 0.00, '0000-00-00', '0000-00-00', 0.00, 111),
(17, '果果贝瑞(GOGO BERRY) 加拿大进口 蜜饯果干 休闲零食 蓝莓干', '43.80 果果贝瑞(GOGO BERRY) 加拿大进口 蜜饯果干 休闲零食 蓝莓干100g袋.jpg', '', 8, '', '', '', 0.00, '0000-00-00', '0000-00-00', 0.00, 623),
(18, '印尼进口 Danisa 皇冠 丹麦 曲奇', '49.90 印尼进口 Danisa 皇冠 丹麦 曲奇 454g（新旧包装随机发货） 盒装.jpg', '', 9, '', '', '', 0.00, '0000-00-00', '0000-00-00', 0.00, 1245),
(19, '家乐氏 Kellogg’s 水果麦片 谷兰诺拉 草莓什锦', '52.80 家乐氏 Kellogg’s 水果麦片 谷兰诺拉 草莓什锦 即食谷物早餐 490g（35g*14小袋）.jpg', '', 9, '', '', '', 0.00, '0000-00-00', '0000-00-00', 0.00, 1245),
(20, '三匠苦荞茶官方旗舰店 黑苦荞茶全株茶', '53.00 三匠苦荞茶官方旗舰店 黑苦荞茶全株茶240克盒装 麦香型.jpg', '', 5, '', '', '', 0.00, '0000-00-00', '0000-00-00', 0.00, 1245),
(21, '法国进口 雀巢（Nestle） 金牌咖啡法式烘焙', '69.00 法国进口 雀巢（Nestle） 金牌咖啡法式烘焙 100g.png', '', 5, '', '', '', 0.00, '0000-00-00', '0000-00-00', 0.00, 14),
(22, '美国进口优鲜沛Ocean Spray蔓越莓干', '69.00 美国进口优鲜沛Ocean Spray蔓越莓干1360g.jpg', '', 8, '', '', '', 0.00, '0000-00-00', '0000-00-00', 0.00, 145),
(23, 'knoppers 牛奶巧克力榛子威化饼干', '69.90 knoppers 牛奶巧克力榛子威化饼干 600g盒 德国进口.jpg', '', 8, '', '', '', 0.00, '0000-00-00', '0000-00-00', 0.00, 733),
(24, '丹麦进口 Kjeldsens 丹麦蓝罐 曲奇饼干 礼盒 ', '99.00 丹麦进口 Kjeldsens 丹麦蓝罐 曲奇饼干 礼盒 908g 盒装.jpg', '', 8, '', '', '', 0.00, '0000-00-00', '0000-00-00', 0.00, 34621),
(25, '法国进口 巴黎水Perrier气泡矿泉水 原味 玻璃瓶装1箱 ', '139.00 法国进口 巴黎水Perrier气泡矿泉水 原味 玻璃瓶装1箱 330MLx24瓶.jpg', '', 5, '', '', '', 0.00, '0000-00-00', '0000-00-00', 0.00, 1235),
(26, '', '158.00 浓情厚礼·品味装806g 四川成都特产牛肉干礼盒大礼包送礼.jpg', '', 7, '', '', '', 0.00, '0000-00-00', '0000-00-00', 0.00, 0),
(27, '', '7.5 中国台湾进口张君雅小妹妹休闲丸子（日式风味）80g.jpg', '', 7, '', '', '', 0.00, '0000-00-00', '0000-00-00', 0.00, 0),
(28, '', '9.9 马来西亚进口 马奇新新 巧克力夹心巧心卷饼干 80g 鸡蛋卷酥 休闲零食.jpg', '', 8, '', '', '', 0.00, '0000-00-00', '0000-00-00', 0.00, 0),
(29, '', '14.80 泰国进口 休闲零食 小老板 烤海苔卷 脆紫菜卷 原味 32.4g盒.jpg', '', 8, '', '', '', 0.00, '0000-00-00', '0000-00-00', 0.00, 0),
(30, '', '23.8 印尼进口 丽芝士 休闲零食 Richeese 纳宝帝 奶酪味 威化饼干 350g罐.jpg', '', 8, '', '', '', 0.00, '0000-00-00', '0000-00-00', 0.00, 0),
(31, '', '25.00 葡韵手信 澳门特色 休闲零食 传统糕点小吃 千层酥150g.jpg', '', 8, '', '', '', 0.00, '0000-00-00', '0000-00-00', 0.00, 0),
(32, '', '36.90 韩国进口海牌海苔2g*32包.jpg', '', 8, '', '', '', 0.00, '0000-00-00', '0000-00-00', 0.00, 0),
(33, '', '41.90 泰国进口Durian Monthong榴的华金枕头榴莲干100g.jpg', '', 8, '', '', '', 0.00, '0000-00-00', '0000-00-00', 0.00, 0),
(34, '', '99.00 美国进口 万多福（Wonderful）加州开心果 经典盐焗味668g.jpg', '', 8, '', '', '', 0.00, '0000-00-00', '0000-00-00', 0.00, 0),
(35, '', '119.00 美国进口 绅士牌(Planters)精选大罐混合坚果（腰果、巴旦木、碧根果、巴西果、榛子）963g.jpg', '', 8, '', '', '', 0.00, '0000-00-00', '0000-00-00', 0.00, 0),
(36, '', '155.00 日本进口Calbee卡乐比薯条三兄弟180g*2盒 北海道卡乐B进口休闲零食品.jpg', '', 8, '', '', '', 0.00, '0000-00-00', '0000-00-00', 0.00, 0),
(37, '', '78.00 茅台集团 习酒 红习酱1952 53度 单瓶装白酒500ml 口感酱香型.jpg', '', 7, '', '', '', 0.00, '0000-00-00', '0000-00-00', 0.00, 0),
(38, '', '156.00 洋河蓝色经典 海之蓝 52度 480ml 口感绵柔浓香型.jpg', '', 7, '', '', '', 0.00, '0000-00-00', '0000-00-00', 0.00, 0),
(39, '', '359.00 茅台集团 习酒 红习酱359.00 1952 53度500ml*6瓶 整箱装白酒 口感酱香型.jpg', '', 7, '', '', '', 0.00, '0000-00-00', '0000-00-00', 0.00, 0),
(40, '', '378.00 剑南春 水晶剑 52度 单瓶装白酒 500ml 口感浓香型.jpg', '', 7, '', '', '', 0.00, '0000-00-00', '0000-00-00', 0.00, 0),
(41, '', '468.00 茅台 迎宾 53度 整箱装白酒 500ml*6瓶 口感酱香型.jpg', '', 7, '', '', '', 0.00, '0000-00-00', '0000-00-00', 0.00, 0),
(42, '', '88.00 法国进口红酒 拉菲（LAFITE）传奇波尔多干红葡萄酒 750ml（ASC）.jpg', '', 7, '', '', '', 0.00, '0000-00-00', '0000-00-00', 0.00, 0),
(43, '', '108.00 法国进口红酒 克鲁斯大帝干红葡萄酒双支礼盒装带酒具 750ml*2瓶.jpg', '', 7, '', '', '', 0.00, '0000-00-00', '0000-00-00', 0.00, 0),
(44, '', '148.00 长城（GreatWall）红酒 特酿3年解百纳干红葡萄酒 整箱装 750ml*6瓶.jpg', '', 7, '', '', '', 0.00, '0000-00-00', '0000-00-00', 0.00, 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `sql_log`
--
ALTER TABLE `sql_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
