-- phpMyAdmin SQL Dump
-- version 4.7.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 12, 2017 at 07:27 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `referto`) VALUES
(1, 'drinks', 'drinks descriptions', 1),
(2, 'snacks', 'snacks descriptions', 2),
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `first_name`, `last_name`, `phone_number`, `address`, `email`, `password`, `register_date`, `active_date`) VALUES
(1, 'Toby', 'Mao', '8618224081279', 'CDUT', '513945442@qq.com', '82bfd261c775a50ec038e1c75217eb93', '2017-10-14 14:35:23', '2017-12-11 13:47:58'),
(2, 'Toby', 'Mao', '86182240812791', 'adsffds', '513945442qwqesd@qq.com', 'dd3a6d85aea3df0d5bfa80339e566aac', '2017-11-03 11:32:17', '2017-11-03 11:32:30');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_address`
--

CREATE TABLE `delivery_address` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `first_name`, `last_name`, `job`, `phone_number`, `department_id`, `login_user`, `active_key`, `referto`) VALUES
(1, 'Admin', 'Admin', 'Admin0', '1234', 1, 'admin', '1234', 0);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `invoices_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `order_id`, `invoices_date`) VALUES
(1, 1, '2017-11-14 16:26:54'),
(2, 2, '2017-11-14 21:24:11'),
(3, 3, '2017-12-09 18:06:11'),
(4, 4, '2017-12-09 18:07:28');

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
  `status_id` tinyint(4) NOT NULL DEFAULT '0',
  `purchase_order_status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `order_date`, `required_date`, `ship_address`, `shipped_date`, `freight`, `status_id`, `purchase_order_status_id`) VALUES
(1, 1, '2017-11-14 16:26:51', NULL, NULL, NULL, 5.00, 1, 0),
(2, 1, '2017-11-14 21:24:02', '2017-11-17 21:24:02', 'CDUT', NULL, 5.00, 1, 0),
(3, 1, '2017-12-09 18:05:43', NULL, NULL, NULL, 5.00, 1, 0),
(4, 1, '2017-12-09 18:07:24', NULL, NULL, NULL, 5.00, 1, 0);

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
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `temp_cutomer_id` int(11) NOT NULL,
  `order_details_status_id` tinyint(1) NOT NULL DEFAULT '0',
  `unit_price` float(19,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `identifier_inventory` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `temp_cutomer_id`, `order_details_status_id`, `unit_price`, `quantity`, `identifier_inventory`) VALUES
(1, 1, 13, 1, 0, 45.90, 3, 1),
(2, 2, 11, 1, 0, 13.90, 3, 1),
(3, 3, 11, 1, 0, 13.90, 1, 1),
(4, 4, 13, 1, 0, 45.90, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_details_status`
--

CREATE TABLE `order_details_status` (
  `id` tinyint(1) NOT NULL,
  `name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `code` varchar(20) NOT NULL,
  `name` text NOT NULL,
  `img` text NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `code`, `name`, `img`, `brand`, `category_id`, `flavor`, `size`, `description`, `unit_price`, `expiration_date`, `date_added`, `store_price`, `inventory`) VALUES
(1, '1', '加多宝凉茶植物饮料', '36.90 加多宝凉茶植物饮料盒装250ml*24 箱装.jpg', '加多宝', 5, 'default', '250ml*24', '36.90 加多宝凉茶植物饮料盒装250ml*24 箱装', 36.90, '2018-06-02', '2017-06-02', 36.90, 332),
(2, '2', '可口可乐330ml', '38.80 可口可乐330ml*24听整箱.jpg', '可口可乐', 4, 'default', '330ml*24', '38.80 可口可乐330ml*24听整箱', 38.80, '2018-06-01', '2017-06-01', 38.80, 55),
(3, '3', '锐澳（RIO）洋酒 鸡尾酒', '75.00 锐澳（RIO）洋酒 鸡尾酒 预调酒果酒混合装（六种口味）275ml*6瓶.jpg', '锐澳', 7, 'default', '275ml*6', '75.00 锐澳（RIO）洋酒 鸡尾酒 预调酒果酒混合装（六种口味）275ml*6瓶', 75.00, '2018-06-09', '2017-06-09', 75.00, 1),
(4, '4', '雪碧 330ml', '38.80 雪碧 330ml*24听箱.jpg', '雪碧', 4, 'default', '330ml*24', '38.80 雪碧 330ml*24听箱', 38.80, '2018-06-09', '2017-06-09', 38.80, 5),
(5, '5', '芬达碳酸饮料', '39.80 芬达碳酸饮料330ml*24听 整箱.jpg', '芬达', 4, 'default', '330ml*24', '39.80 芬达碳酸饮料330ml*24听 整箱', 39.80, '2018-06-09', '2017-06-09', 39.80, 6),
(6, '6', '雪碧 500ml', '59.90 雪碧 500ml*24箱.jpg', '雪碧', 4, 'default', '500ml*24', '59.90 雪碧 500ml*24箱', 59.00, '2018-06-09', '2017-06-09', 59.00, 9),
(7, '7', '养元', '61.90 养元240ml*20.jpg', '养元', 6, 'default', '240ml*20', '61.90 养元240ml*20', 61.90, '2018-06-09', '2017-06-09', 61.90, 8),
(8, '8', '雀巢（Nestle） (丝滑拿铁)咖啡', '77.90 雀巢（Nestle） (丝滑拿铁)咖啡268ml*15瓶.jpg', '雀巢', 5, 'default', '268ml*15', '77.90 雀巢（Nestle） (丝滑拿铁)咖啡268ml*15瓶', 77.90, '2018-06-09', '2017-06-09', 77.90, 7),
(9, '9', '红牛维生素功能饮料250ml', '135.00 红牛维生素功能饮料250ml*24罐 整箱.jpg', '红牛', 6, 'default', '250ml*24', '135.00 红牛维生素功能饮料250ml*24罐 整箱', 135.00, '2018-06-09', '2017-06-09', 135.00, 10),
(10, '10', '红牛牛磺酸强化型饮料250ml', '149.00 红牛牛磺酸强化型饮料250ml*24罐 整箱.jpg', '红牛', 6, 'default', '250ml*24', '149.00 红牛牛磺酸强化型饮料250ml*24罐 整箱', 149.00, '2018-06-09', '2017-06-09', 149.00, 10),
(11, '11', '士力架花生夹心巧克力', '13.9 士力架花生夹心巧克力（分享装）糖果巧克力休闲零食240g.jpg', '士力架', 8, 'default', '240g', '13.9 士力架花生夹心巧克力（分享装）糖果巧克力休闲零食240g', 13.90, '2018-11-04', '2017-11-04', 13.90, 0),
(12, '12', '德芙Dove巧克力分享碗装', '29.90 德芙Dove巧克力分享碗装 丝滑牛奶巧克力糖果巧克力休闲零食252g.jpg', '德芙', 8, 'default', '252g', '29.90 德芙Dove巧克力分享碗装 丝滑牛奶巧克力糖果巧克力休闲零食252g', 29.90, '2018-11-04', '2017-11-04', 29.90, 0),
(13, '13', '好时（Hershey’s）Kisses袋装散装', '45.90 好时（Hershey’s）Kisses袋装散装 牛奶巧克力(电商版红色) 糖果休闲零食500g.jpg', '好时', 8, 'default', '500g', '45.90 好时（Hershey’s）Kisses袋装散装 牛奶巧克力(电商版红色) 糖果休闲零食500g', 45.90, '2018-11-04', '2017-11-04', 45.90, 1),
(14, '14', '伊利 安慕希希腊风味常温酸奶原味', '59.20 伊利 安慕希希腊风味常温酸奶原味205g*12盒 礼盒装.jpg', '伊利', 6, 'default', '205g*12', '59.20 伊利 安慕希希腊风味常温酸奶原味205g*12盒 礼盒装', 59.20, '2018-11-04', '2017-11-04', 59.20, 110),
(15, '15', '京东海外直采 费列罗Ferrero Rocher榛子牛奶巧克力礼盒', '72.00 京东海外直采 费列罗Ferrero Rocher榛子牛奶巧克力礼盒30粒 意大利进口 375g.jpg', '费列罗', 8, 'default', '375g', '72.00 京东海外直采 费列罗Ferrero Rocher榛子牛奶巧克力礼盒30粒 意大利进口 375g', 72.00, '2018-11-04', '2017-11-04', 72.00, 55),
(16, '16', '韩国进口 韩国农协 蜂蜜柚子茶', '42.90 韩国进口 韩国农协 蜂蜜柚子茶1000g.jpg', '韩国农协', 5, 'default', '1000g', '42.90 韩国进口 韩国农协 蜂蜜柚子茶1000g', 42.90, '2018-11-04', '2017-11-04', 42.90, 111),
(17, '17', '果果贝瑞(GOGO BERRY) 加拿大进口 蜜饯果干 休闲零食 蓝莓干', '43.80 果果贝瑞(GOGO BERRY) 加拿大进口 蜜饯果干 休闲零食 蓝莓干100g袋.jpg', '果果贝瑞', 8, 'default', '100g', '43.80 果果贝瑞(GOGO BERRY) 加拿大进口 蜜饯果干 休闲零食 蓝莓干100g袋', 43.80, '2018-11-04', '2017-11-04', 43.80, 623),
(18, '18', '印尼进口 Danisa 皇冠 丹麦 曲奇', '49.90 印尼进口 Danisa 皇冠 丹麦 曲奇 454g（新旧包装随机发货） 盒装.jpg', 'Danisa', 9, 'default', '454g', '49.90 印尼进口 Danisa 皇冠 丹麦 曲奇 454g（新旧包装随机发货） 盒装', 49.90, '2018-11-04', '2017-11-04', 49.90, 1245),
(19, '19', '家乐氏 Kellogg’s 水果麦片 谷兰诺拉 草莓什锦', '52.80 家乐氏 Kellogg’s 水果麦片 谷兰诺拉 草莓什锦 即食谷物早餐 490g（35g*14小袋）.jpg', '家乐氏', 9, 'default', '35g*14袋', '52.80 家乐氏 Kellogg’s 水果麦片 谷兰诺拉 草莓什锦 即食谷物早餐 490g（35g*14小袋）', 52.80, '2018-11-04', '2017-11-04', 52.80, 1243),
(20, '20', '三匠苦荞茶官方旗舰店 黑苦荞茶全株茶', '53.00 三匠苦荞茶官方旗舰店 黑苦荞茶全株茶240克盒装 麦香型.jpg', '三匠', 5, '麦香', '240g盒', '53.00 三匠苦荞茶官方旗舰店 黑苦荞茶全株茶240克盒装 麦香型', 53.00, '2018-11-04', '2017-11-04', 53.00, 1245),
(21, '21', '法国进口 雀巢（Nestle） 金牌咖啡法式烘焙', '69.00 法国进口 雀巢（Nestle） 金牌咖啡法式烘焙 100g.png', '雀巢', 5, 'default', '100g', '69.00 法国进口 雀巢（Nestle） 金牌咖啡法式烘焙 100g', 69.00, '2018-11-04', '2017-11-04', 69.00, 14),
(22, '22', '美国进口优鲜沛Ocean Spray蔓越莓干', '69.00 美国进口优鲜沛Ocean Spray蔓越莓干1360g.jpg', 'new', 8, 'default', '1360g', '69.00 美国进口优鲜沛Ocean Spray蔓越莓干1360g', 69.00, '2018-11-04', '2017-11-04', 69.00, 145),
(23, '23', 'knoppers 牛奶巧克力榛子威化饼干', '69.90 knoppers 牛奶巧克力榛子威化饼干 600g盒 德国进口.jpg', 'knoppers', 8, 'default', '600g盒', '69.90 knoppers 牛奶巧克力榛子威化饼干 600g盒 德国进口', 69.90, '2018-11-04', '2017-11-04', 69.90, 733),
(24, '24', '丹麦进口 Kjeldsens 丹麦蓝罐 曲奇饼干 礼盒 ', '99.00 丹麦进口 Kjeldsens 丹麦蓝罐 曲奇饼干 礼盒 908g 盒装.jpg', 'Kjeldsens', 8, 'default', '908g盒', '99.00 丹麦进口 Kjeldsens 丹麦蓝罐 曲奇饼干 礼盒 908g 盒装', 99.00, '2018-11-04', '2017-11-04', 99.00, 34621),
(25, '25', '法国进口 巴黎水Perrier气泡矿泉水 原味 玻璃瓶装1箱 ', '139.00 法国进口 巴黎水Perrier气泡矿泉水 原味 玻璃瓶装1箱 330MLx24瓶.jpg', 'Perrier', 5, 'default', '330MLx24瓶', '139.00 法国进口 巴黎水Perrier气泡矿泉水 原味 玻璃瓶装1箱 330MLx24瓶', 139.00, '2018-11-04', '2017-11-04', 139.00, 1235),
(26, '26', '浓情厚礼·品味装806g 四川成都特产牛肉干礼盒大礼包送礼', '158.00 浓情厚礼·品味装806g 四川成都特产牛肉干礼盒大礼包送礼.jpg', '四川成都特产', 7, 'default', '806g', '158.00 浓情厚礼·品味装806g 四川成都特产牛肉干礼盒大礼包送礼', 158.00, '2018-11-04', '2017-11-04', 158.00, 299),
(27, '27', '中国台湾进口张君雅小妹妹休闲丸子（日式风味）80g', '7.5 中国台湾进口张君雅小妹妹休闲丸子（日式风味）80g.jpg', '张君雅', 7, '日式风味', '80g', '7.5 中国台湾进口张君雅小妹妹休闲丸子（日式风味）80g', 7.50, '2018-11-04', '2017-11-04', 7.50, 299),
(28, '28', '马来西亚进口 马奇新新 巧克力夹心巧心卷饼干 80g 鸡蛋卷酥 休闲零食', '9.9 马来西亚进口 马奇新新 巧克力夹心巧心卷饼干 80g 鸡蛋卷酥 休闲零食.jpg', '马来西亚进口 ', 8, 'default', '80g', '9.9 马来西亚进口 马奇新新 巧克力夹心巧心卷饼干 80g 鸡蛋卷酥 休闲零食', 9.90, '2018-11-04', '2017-11-04', 9.90, 299),
(29, '29', '泰国进口 休闲零食 小老板 烤海苔卷 脆紫菜卷 原味 32.4g盒', '14.80 泰国进口 休闲零食 小老板 烤海苔卷 脆紫菜卷 原味 32.4g盒.jpg', '泰国进口', 8, 'default', '32.4g盒', '14.80 泰国进口 休闲零食 小老板 烤海苔卷 脆紫菜卷 原味 32.4g盒', 14.80, '2018-11-04', '2017-11-04', 14.80, 299),
(30, '30', '印尼进口 丽芝士 休闲零食 Richeese 纳宝帝 奶酪味 威化饼干 350g罐', '23.8 印尼进口 丽芝士 休闲零食 Richeese 纳宝帝 奶酪味 威化饼干 350g罐.jpg', '印尼进口', 8, '奶酪味', '350g罐', '23.8 印尼进口 丽芝士 休闲零食 Richeese 纳宝帝 奶酪味 威化饼干 350g罐', 23.80, '2018-11-04', '2017-11-04', 23.80, 299),
(31, '31', '葡韵手信 澳门特色 休闲零食 传统糕点小吃 千层酥150g', '25.00 葡韵手信 澳门特色 休闲零食 传统糕点小吃 千层酥150g.jpg', '葡韵手信', 8, 'default', '150g', '25.00 葡韵手信 澳门特色 休闲零食 传统糕点小吃 千层酥150g', 25.00, '2018-11-04', '2017-11-04', 25.00, 299),
(32, '32', '韩国进口海牌海苔2g*32包', '36.90 韩国进口海牌海苔2g*32包.jpg', '韩国进口', 8, 'default', '2g*32包', '36.90 韩国进口海牌海苔2g*32包', 36.00, '2018-11-04', '2017-11-04', 36.00, 299),
(33, '33', '泰国进口Durian Monthong榴的华金枕头榴莲干100g', '41.90 泰国进口Durian Monthong榴的华金枕头榴莲干100g.jpg', '泰国进口', 8, 'default', '100g', '41.90 泰国进口Durian Monthong榴的华金枕头榴莲干100g', 41.90, '2018-11-04', '2017-11-04', 41.90, 299),
(34, '34', '美国进口 万多福（Wonderful）加州开心果 经典盐焗味668g', '99.00 美国进口 万多福（Wonderful）加州开心果 经典盐焗味668g.jpg', '美国进口', 8, '盐焗味', '668g', '99.00 美国进口 万多福（Wonderful）加州开心果 经典盐焗味668g', 99.00, '2018-11-04', '2017-11-04', 99.00, 299),
(35, '35', '美国进口 绅士牌(Planters)精选大罐混合坚果（腰果、巴旦木、碧根果、巴西果、榛...', '119.00 美国进口 绅士牌(Planters)精选大罐混合坚果（腰果、巴旦木、碧根果、巴西果、榛子）963g.jpg', '美国进口 ', 8, 'default', '963g', '119.00 美国进口 绅士牌(Planters)精选大罐混合坚果（腰果、巴旦木、碧根果、巴西果、榛子）963g', 119.00, '2018-11-04', '2017-11-04', 119.00, 299),
(36, '36', '日本进口Calbee卡乐比薯条三兄弟180g*2盒 北海道卡乐B进口休闲零食品', '155.00 日本进口Calbee卡乐比薯条三兄弟180g*2盒 北海道卡乐B进口休闲零食品.jpg', '日本进口', 8, 'default', '180g*2盒', '155.00 日本进口Calbee卡乐比薯条三兄弟180g*2盒 北海道卡乐B进口休闲零食品', 155.00, '2018-11-04', '2017-11-04', 155.00, 299),
(37, '37', '茅台集团 习酒 红习酱1952 53度 单瓶装白酒500ml 口感酱香型', '78.00 茅台集团 习酒 红习酱1952 53度 单瓶装白酒500ml 口感酱香型.jpg', '茅台', 7, '酱香', '53度 500ml', '78.00 茅台集团 习酒 红习酱1952 53度 单瓶装白酒500ml 口感酱香型', 78.00, '2018-11-04', '2017-11-04', 78.00, 299),
(38, '38', '洋河蓝色经典 海之蓝 52度 480ml 口感绵柔浓香型', '156.00 洋河蓝色经典 海之蓝 52度 480ml 口感绵柔浓香型.jpg', '海之蓝', 7, '浓香', '52度 480ml', '156.00 洋河蓝色经典 海之蓝 52度 480ml 口感绵柔浓香型', 156.00, '2018-11-04', '2017-11-04', 156.00, 299),
(39, '39', '茅台集团 习酒 红习酱359.00 1952 53度500ml*6瓶 整箱装白酒 口感...', '359.00 茅台集团 习酒 红习酱359.00 1952 53度500ml*6瓶 整箱装白酒 口感酱香型.jpg', '茅台', 7, '酱香', '53度 500ml*6瓶', '359.00 茅台集团 习酒 红习酱359.00 1952 53度500ml*6瓶 整箱装白酒 口感酱香型', 359.00, '2018-11-04', '2017-11-04', 359.00, 299),
(40, '40', '剑南春 水晶剑 52度 单瓶装白酒 500ml 口感浓香型', '378.00 剑南春 水晶剑 52度 单瓶装白酒 500ml 口感浓香型.jpg', '剑南春 ', 7, '浓香', '52度 500ml', '378.00 剑南春 水晶剑 52度 单瓶装白酒 500ml 口感浓香型', 378.00, '2018-11-04', '2017-11-04', 378.00, 299),
(41, '41', '茅台 迎宾 53度 整箱装白酒 500ml*6瓶 口感酱香型', '468.00 茅台 迎宾 53度 整箱装白酒 500ml*6瓶 口感酱香型.jpg', '茅台', 7, '酱香', '500ml*6瓶', '468.00 茅台 迎宾 53度 整箱装白酒 500ml*6瓶 口感酱香型', 468.00, '2018-11-04', '2017-11-04', 468.00, 299),
(42, '42', '法国进口红酒 拉菲（LAFITE）传奇波尔多干红葡萄酒 750ml（ASC', '88.00 法国进口红酒 拉菲（LAFITE）传奇波尔多干红葡萄酒 750ml（ASC）.jpg', '法国进口', 7, 'default', '750ml', '88.00 法国进口红酒 拉菲（LAFITE）传奇波尔多干红葡萄酒 750ml（ASC）', 88.00, '2018-11-04', '2017-11-04', 88.00, 299),
(43, '43', '法国进口红酒 克鲁斯大帝干红葡萄酒双支礼盒装带酒具 750ml*2瓶', '108.00 法国进口红酒 克鲁斯大帝干红葡萄酒双支礼盒装带酒具 750ml*2瓶.jpg', '法国进口', 7, 'default', '750ml*2瓶', '108.00 法国进口红酒 克鲁斯大帝干红葡萄酒双支礼盒装带酒具 750ml*2瓶', 108.00, '2018-11-04', '2017-11-04', 108.00, 299),
(44, '44', '长城（GreatWall）红酒 特酿3年解百纳干红葡萄酒 整箱装 750ml*6瓶', '148.00 长城（GreatWall）红酒 特酿3年解百纳干红葡萄酒 整箱装 750ml*6瓶.jpg', '长城', 7, 'default', '750ml*6瓶', '148.00 长城（GreatWall）红酒 特酿3年解百纳干红葡萄酒 整箱装 750ml*6瓶', 148.00, '2018-11-04', '2017-11-04', 148.00, 299);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_status`
--

CREATE TABLE `purchase_order_status` (
  `id` int(11) NOT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `referto` (`referto`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `referto` (`referto`),
  ADD KEY `department_id` (`department_id`);

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
  ADD KEY `status_id` (`status_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `purchase_order_status_id` (`purchase_order_status_id`);

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
  ADD KEY `id` (`id`,`order_id`,`product_id`,`temp_cutomer_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `order_details_status_id` (`order_details_status_id`);

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
  ADD UNIQUE KEY `code` (`code`),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `sql_log`
--
ALTER TABLE `sql_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`referto`) REFERENCES `categories` (`id`);

--
-- Constraints for table `delivery_address`
--
ALTER TABLE `delivery_address`
  ADD CONSTRAINT `delivery_address_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`);

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`purchase_order_status_id`) REFERENCES `purchase_order_status` (`id`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `orders_status` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`order_details_status_id`) REFERENCES `order_details_status` (`id`),
  ADD CONSTRAINT `order_details_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
