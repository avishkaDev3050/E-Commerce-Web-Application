-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               8.0.37 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table neo_mobiles.address
CREATE TABLE IF NOT EXISTS `address` (
  `id` int NOT NULL AUTO_INCREMENT,
  `line_1` varchar(45) NOT NULL,
  `line_2` varchar(45) NOT NULL,
  `zip_code` varchar(45) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `district_id` int NOT NULL,
  `city_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_address_user1_idx` (`user_email`),
  KEY `fk_address_district1_idx` (`district_id`),
  KEY `fk_address_city1_idx` (`city_id`),
  CONSTRAINT `fk_address_city1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`),
  CONSTRAINT `fk_address_district1` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`),
  CONSTRAINT `fk_address_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table neo_mobiles.address: ~0 rows (approximately)

-- Dumping structure for table neo_mobiles.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `email` varchar(100) NOT NULL,
  `password` text,
  `mobile` varchar(10) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `status` varchar(1) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table neo_mobiles.admin: ~1 rows (approximately)
INSERT INTO `admin` (`email`, `password`, `mobile`, `fname`, `lname`, `status`) VALUES
	('avishkapriyasoma@gmail.com', '66de7c77be6a1', '0741387807', 'Avishka', 'Madushan', '1');

-- Dumping structure for table neo_mobiles.advertiesment
CREATE TABLE IF NOT EXISTS `advertiesment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `post` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table neo_mobiles.advertiesment: ~0 rows (approximately)

-- Dumping structure for table neo_mobiles.brand
CREATE TABLE IF NOT EXISTS `brand` (
  `id` int NOT NULL AUTO_INCREMENT,
  `brand` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table neo_mobiles.brand: ~1 rows (approximately)
INSERT INTO `brand` (`id`, `brand`) VALUES
	(7, 'Apple');

-- Dumping structure for table neo_mobiles.cart
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `qty` int NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `color` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cart_product1_idx` (`product_id`),
  KEY `fk_cart_user1_idx` (`user_email`),
  CONSTRAINT `fk_cart_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_cart_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table neo_mobiles.cart: ~0 rows (approximately)

-- Dumping structure for table neo_mobiles.catagary
CREATE TABLE IF NOT EXISTS `catagary` (
  `id` int NOT NULL AUTO_INCREMENT,
  `catagary` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table neo_mobiles.catagary: ~0 rows (approximately)
INSERT INTO `catagary` (`id`, `catagary`) VALUES
	(7, 'Mobile Phone');

-- Dumping structure for table neo_mobiles.city
CREATE TABLE IF NOT EXISTS `city` (
  `id` int NOT NULL AUTO_INCREMENT,
  `district_id` int NOT NULL,
  `city` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cities_districts1_idx` (`district_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1847 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table neo_mobiles.city: ~0 rows (approximately)

-- Dumping structure for table neo_mobiles.color
CREATE TABLE IF NOT EXISTS `color` (
  `id` int NOT NULL AUTO_INCREMENT,
  `color` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table neo_mobiles.color: ~0 rows (approximately)
INSERT INTO `color` (`id`, `color`) VALUES
	(14, 'White');

-- Dumping structure for table neo_mobiles.district
CREATE TABLE IF NOT EXISTS `district` (
  `id` int NOT NULL AUTO_INCREMENT,
  `province_id` int NOT NULL,
  `district` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `provinces_id` (`province_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table neo_mobiles.district: ~0 rows (approximately)

-- Dumping structure for table neo_mobiles.feedback
CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int NOT NULL AUTO_INCREMENT,
  `feedback` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_feedback_user1_idx` (`user_email`),
  KEY `fk_feedback_product1_idx` (`product_id`),
  CONSTRAINT `fk_feedback_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_feedback_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table neo_mobiles.feedback: ~0 rows (approximately)

-- Dumping structure for table neo_mobiles.model
CREATE TABLE IF NOT EXISTS `model` (
  `id` int NOT NULL AUTO_INCREMENT,
  `model` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table neo_mobiles.model: ~0 rows (approximately)
INSERT INTO `model` (`id`, `model`) VALUES
	(16, 'iPhone 11');

-- Dumping structure for table neo_mobiles.order
CREATE TABLE IF NOT EXISTS `order` (
  `id` varchar(20) NOT NULL,
  `price` double NOT NULL,
  `qty` int DEFAULT NULL,
  `user_email` varchar(100) NOT NULL,
  `order_status_id` int NOT NULL,
  `product_id` varchar(45) NOT NULL,
  `date` date NOT NULL,
  `address_id` int DEFAULT NULL,
  `color_id` int NOT NULL,
  `invoice_id` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_order_user1_idx` (`user_email`),
  KEY `fk_order_order_status1_idx` (`order_status_id`),
  KEY `fk_order_address1_idx` (`address_id`),
  KEY `fk_order_color1_idx` (`color_id`),
  CONSTRAINT `fk_order_address1` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`),
  CONSTRAINT `fk_order_color1` FOREIGN KEY (`color_id`) REFERENCES `color` (`id`),
  CONSTRAINT `fk_order_order_status1` FOREIGN KEY (`order_status_id`) REFERENCES `order_status` (`id`),
  CONSTRAINT `fk_order_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table neo_mobiles.order: ~0 rows (approximately)

-- Dumping structure for table neo_mobiles.order_status
CREATE TABLE IF NOT EXISTS `order_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `status` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table neo_mobiles.order_status: ~0 rows (approximately)

-- Dumping structure for table neo_mobiles.product
CREATE TABLE IF NOT EXISTS `product` (
  `id` varchar(50) NOT NULL,
  `price` double NOT NULL,
  `description` text NOT NULL,
  `catagary_id` int NOT NULL,
  `brand_id` int NOT NULL,
  `model_id` int NOT NULL,
  `qty` varchar(45) NOT NULL,
  `color_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_catagary1_idx` (`catagary_id`),
  KEY `fk_product_brand1_idx` (`brand_id`),
  KEY `fk_product_model1_idx` (`model_id`),
  KEY `fk_product_color1_idx` (`color_id`),
  CONSTRAINT `fk_product_brand1` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`),
  CONSTRAINT `fk_product_catagary1` FOREIGN KEY (`catagary_id`) REFERENCES `catagary` (`id`),
  CONSTRAINT `fk_product_color1` FOREIGN KEY (`color_id`) REFERENCES `color` (`id`),
  CONSTRAINT `fk_product_model1` FOREIGN KEY (`model_id`) REFERENCES `model` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table neo_mobiles.product: ~1 rows (approximately)
INSERT INTO `product` (`id`, `price`, `description`, `catagary_id`, `brand_id`, `model_id`, `qty`, `color_id`) VALUES
	('300', 100000, 'Apple iPhone 11 256 GB', 7, 7, 16, '10', 14),
	('301', 120000, 'Apple iPhone 11 128 GB', 7, 7, 16, '12', 14),
	('302', 120000, 'Apple iPhone 11 128 GB', 7, 7, 16, '12', 14);

-- Dumping structure for table neo_mobiles.product_img
CREATE TABLE IF NOT EXISTS `product_img` (
  `id` int NOT NULL AUTO_INCREMENT,
  `img` text NOT NULL,
  `product_id` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_img_product1_idx` (`product_id`),
  CONSTRAINT `fk_product_img_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table neo_mobiles.product_img: ~1 rows (approximately)
INSERT INTO `product_img` (`id`, `img`, `product_id`) VALUES
	(16, 'resource/products/66de7adfbdbee11-pro-max.png', '300'),
	(19, 'resource/products/30111-pro-max.png', '301'),
	(20, 'resource/products/30211-pro-max.png', '302');

-- Dumping structure for table neo_mobiles.promo_code
CREATE TABLE IF NOT EXISTS `promo_code` (
  `id` int NOT NULL AUTO_INCREMENT,
  `promo_code` varchar(20) NOT NULL,
  `discount` double NOT NULL,
  `exp_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table neo_mobiles.promo_code: ~0 rows (approximately)

-- Dumping structure for table neo_mobiles.promo_usage
CREATE TABLE IF NOT EXISTS `promo_usage` (
  `id` int NOT NULL AUTO_INCREMENT,
  `promo_code_id` int NOT NULL,
  `dis_value` double NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `invoice_id` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_promo_usage_promo_code1_idx` (`promo_code_id`),
  KEY `fk_promo_usage_user1_idx` (`user_email`),
  CONSTRAINT `fk_promo_usage_promo_code1` FOREIGN KEY (`promo_code_id`) REFERENCES `promo_code` (`id`),
  CONSTRAINT `fk_promo_usage_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table neo_mobiles.promo_usage: ~0 rows (approximately)

-- Dumping structure for table neo_mobiles.province
CREATE TABLE IF NOT EXISTS `province` (
  `id` int NOT NULL AUTO_INCREMENT,
  `province` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table neo_mobiles.province: ~0 rows (approximately)

-- Dumping structure for table neo_mobiles.user
CREATE TABLE IF NOT EXISTS `user` (
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `verification_code` varchar(50) DEFAULT NULL,
  `joined_date` datetime NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `address_status` int NOT NULL DEFAULT '0',
  `profile_pic` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table neo_mobiles.user: ~0 rows (approximately)

-- Dumping structure for table neo_mobiles.watch_list
CREATE TABLE IF NOT EXISTS `watch_list` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` varchar(45) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table neo_mobiles.watch_list: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
