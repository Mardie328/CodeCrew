-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 22, 2025 at 02:55 PM
-- Server version: 8.0.21
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `cat_id` int NOT NULL AUTO_INCREMENT,
  `cat_title` varchar(255) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(21, 'Electric Work'),
(19, 'Borehole Drilling'),
(20, 'Building Constraction'),
(22, 'Plumbing Work');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int NOT NULL AUTO_INCREMENT,
  `comment_post_id` int NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` varchar(255) NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` datetime NOT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(12, 7, 'Rose Leputu', 'rose@gmail.com', 'Wooow my man rocks all the times, I like that.', 'approved', '2024-08-09 15:26:16'),
(14, 7, 'Urize Masepela', 'urize@gmail.com', 'Hey dad, you rock all the times, you are the best at all the time', 'approved', '2024-08-09 15:28:25'),
(17, 7, 'Masepela Winstan', 'rose@gmail.com', 'This is ausome', 'pendding', '2024-12-20 09:50:40');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `OID` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `ORDER_NO` varchar(45) NOT NULL DEFAULT '',
  `ORDER_DATE` date NOT NULL DEFAULT '0000-00-00',
  `UID` int UNSIGNED NOT NULL DEFAULT '0',
  `TOTAL_AMT` double(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`OID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE IF NOT EXISTS `order_details` (
  `ID` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `OID` int UNSIGNED NOT NULL DEFAULT '0',
  `PID` int UNSIGNED NOT NULL DEFAULT '0',
  `PNAME` varchar(45) NOT NULL DEFAULT '',
  `PRICE` double(10,2) NOT NULL DEFAULT '0.00',
  `QTY` int UNSIGNED NOT NULL DEFAULT '0',
  `TOTAL` double(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int NOT NULL AUTO_INCREMENT,
  `post_cat_id` int NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_date` datetime NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` text NOT NULL,
  `post_comment_count` int NOT NULL,
  `post_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Draft',
  PRIMARY KEY (`post_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_cat_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`) VALUES
(12, 21, ' ', '', '2025-01-21 23:11:06', '', '', '', 0, 'Draft'),
(5, 20, ' Building Contractions and maintenance', 'Masepela Winstan', '2024-08-07 00:00:00', 'img1.jpg', 'Building construction is an ancient human activity that began purely from a functional need to provide shelter from the elements We do assembling or erecting structures, typically residential, commercial, or industrial buildings, from individual elements or components. We involves a combination of design, planning, and execution to create a functional and safe built environment. We also provide maintenance and renovation to old buildings.', 'buiding, plastering, maintanace', 2, 'published'),
(6, 22, ' Our best plumbing services', 'Masepela Winstan', '2024-08-07 00:00:00', 'img2.jpg', 'PB General Traiding is knowledgeble of hydraulic systems. They are patient individuals with a practical mind and manual dexterity, able to work efficiently with great attention to detail, Reading blueprints and drawings to understand or plan the layout of plumbing, waste disposal and water supply systems. Installing and maintaining water supply systems. Cutting, assembling and installing pipes and tubes with attention to existing infrastructure', 'plumbing, pbgeneral, toilet, bathroom', 1, 'published'),
(8, 21, 'Water Drilling', 'Urize Masepela', '2025-01-21 23:10:59', 'img4.jpg', 'PB General Traiding are an expert assess the geophysical properties of the site and soil, using a range of techniques to determine the conditions. After mapping the site and planning the borehole, we can proceed with the drilling in line with the hydrogeologist’s recommendations. We subsequently reinforce the borehole with a casing of steel, PVC, or both to securely maintain its structure through challenging outdoor conditions.', 'drilling, water, pipes, water connection', 0, 'published');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `PID` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `PRODUCT` varchar(45) NOT NULL DEFAULT '',
  `PRICE` double(10,2) NOT NULL DEFAULT '0.00',
  `IMAGE` varchar(45) NOT NULL DEFAULT '',
  `DESCRIPTION` text,
  PRIMARY KEY (`PID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`PID`, `PRODUCT`, `PRICE`, `IMAGE`, `DESCRIPTION`) VALUES
(2, 'Product 1', 100.00, '2.jpg', 'The boy walked down the street in a carefree way, playing without notice of what was about him. He didn\'t hear the sound of the car as his ball careened into the road. He took a step toward it, and in doing so sealed his fate.'),
(3, 'Product 2', 75.00, '3.jpg', 'The boy walked down the street in a carefree way, playing without notice of what was about him. He didn\'t hear the sound of the car as his ball careened into the road. He took a step toward it, and in doing so sealed his fate.'),
(4, 'Product 3', 45.00, '4.jpg', 'The boy walked down the street in a carefree way, playing without notice of what was about him. He didn\'t hear the sound of the car as his ball careened into the road. He took a step toward it, and in doing so sealed his fate.'),
(5, 'Product 4', 85.00, '5.jpg', 'The boy walked down the street in a carefree way, playing without notice of what was about him. He didn\'t hear the sound of the car as his ball careened into the road. He took a step toward it, and in doing so sealed his fate.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'subscriber',
  `randsalt` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `randsalt`, `created_date`) VALUES
(5, 'RoseL', '12345', 'Rose', 'Leputu', 'leputu.rose@gmail.com', '', 'subscriber', '', '2024-08-17 13:48:44'),
(6, 'WinstanM', '12345', 'Winstan', 'Masepela', 'masepela.winstan@gmail.com', '', 'admin', '', '2024-08-17 13:49:24');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

