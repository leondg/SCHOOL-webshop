/*
Navicat MySQL Data Transfer

Source Server         : vagrant
Source Server Version : 50549
Source Host           : localhost:3306
Source Database       : webshop

Target Server Type    : MYSQL
Target Server Version : 50549
File Encoding         : 65001

Date: 2016-06-22 08:37:01
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for account
-- ----------------------------
DROP TABLE IF EXISTS `account`;
CREATE TABLE `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phonenumber` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `createdon` datetime NOT NULL,
  `updatedon` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_7D3656A4F85E0677` (`username`),
  KEY `account_index` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of account
-- ----------------------------
INSERT INTO `account` VALUES ('1', 'leon', '$2y$13$S0VAFFkkjbWQ94ks1PDPv.5wksUxQEw1WEgyt36aDhVnnRJiMV4e2', 'leon90@outlook.com', 'Léon', 'de Groot', '0627577597', 'nl', 'enabled', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for account_address
-- ----------------------------
DROP TABLE IF EXISTS `account_address`;
CREATE TABLE `account_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `name` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `street` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `number` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `zipcode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `residence` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `createdon` datetime NOT NULL,
  `updatedon` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C4657BC99B6B5FBA` (`account_id`),
  CONSTRAINT `account_address_account` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of account_address
-- ----------------------------

-- ----------------------------
-- Table structure for discount_code
-- ----------------------------
DROP TABLE IF EXISTS `discount_code`;
CREATE TABLE `discount_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `name` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `reusable` int(11) NOT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `createdon` datetime NOT NULL,
  `updatedon` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_E997352277153098` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of discount_code
-- ----------------------------

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `payment_method_id` int(11) NOT NULL,
  `discount_code_id` int(11) DEFAULT NULL,
  `deliverymethod` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `paymentstatus` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `createdon` datetime NOT NULL,
  `updatedon` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F52993989B6B5FBA` (`account_id`),
  KEY `IDX_F52993985AA1164F` (`payment_method_id`),
  KEY `IDX_F529939891D29306` (`discount_code_id`),
  CONSTRAINT `order_account` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`),
  CONSTRAINT `order_discount_code` FOREIGN KEY (`discount_code_id`) REFERENCES `discount_code` (`id`),
  CONSTRAINT `order_payment_method` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_method` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of order
-- ----------------------------
INSERT INTO `order` VALUES ('4', '1', '3', null, 'default', 'wait', 'open', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `order` VALUES ('5', '1', '3', null, 'default', 'wait', 'open', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `order` VALUES ('6', '1', '3', null, 'default', 'wait', 'open', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for order_line
-- ----------------------------
DROP TABLE IF EXISTS `order_line`;
CREATE TABLE `order_line` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `createdon` datetime NOT NULL,
  `updatedon` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9CE58EE18D9F6D38` (`order_id`),
  KEY `IDX_9CE58EE14584665A` (`product_id`),
  CONSTRAINT `order_line_order` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`),
  CONSTRAINT `order_line_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of order_line
-- ----------------------------
INSERT INTO `order_line` VALUES ('1', '4', '2', '49999', 'ok', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `order_line` VALUES ('2', '4', '2', '49999', 'ok', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `order_line` VALUES ('3', '4', '3', '62900', 'ok', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `order_line` VALUES ('4', '4', '4', '5990', 'ok', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `order_line` VALUES ('5', '4', '10', '5990', 'ok', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `order_line` VALUES ('6', '4', '8', '2499', 'ok', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `order_line` VALUES ('7', '5', '2', '49999', 'ok', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `order_line` VALUES ('8', '5', '2', '49999', 'ok', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `order_line` VALUES ('9', '5', '3', '62900', 'ok', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `order_line` VALUES ('10', '5', '4', '5990', 'ok', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `order_line` VALUES ('11', '5', '10', '5990', 'ok', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `order_line` VALUES ('12', '5', '8', '2499', 'ok', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `order_line` VALUES ('13', '6', '2', '49999', 'ok', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `order_line` VALUES ('14', '6', '2', '49999', 'ok', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `order_line` VALUES ('15', '6', '3', '62900', 'ok', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `order_line` VALUES ('16', '6', '4', '5990', 'ok', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `order_line` VALUES ('17', '6', '10', '5990', 'ok', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `order_line` VALUES ('18', '6', '8', '2499', 'ok', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for payment_method
-- ----------------------------
DROP TABLE IF EXISTS `payment_method`;
CREATE TABLE `payment_method` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` int(11) NOT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `createdon` datetime NOT NULL,
  `updatedon` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of payment_method
-- ----------------------------
INSERT INTO `payment_method` VALUES ('1', 'paypal', '50', 'enabled', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `payment_method` VALUES ('2', 'ideal', '0', 'enabled', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `payment_method` VALUES ('3', 'dummy', '0', 'enabled', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `brand` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` int(11) NOT NULL,
  `msrp` int(11) DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `options` longtext COLLATE utf8_unicode_ci,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `createdon` datetime NOT NULL,
  `updatedon` datetime NOT NULL,
  `spotlight` int(11) DEFAULT NULL,
  `fullname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_D34A04AD5E237E06` (`name`),
  KEY `IDX_D34A04AD7B00651C` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES ('1', 'geforce-gtx-1080-strix', 'asus', 'gpu', '79900', '89900', '5', '{\"specs\":{\"chip\":\"Nvidia GTX 1080 Pascal\"}}', 'enabled', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', 'ROG Strix GeForce GTX 1080');
INSERT INTO `product` VALUES ('2', 'geforce-gtx-1070-strix', 'asus', 'gpu', '49999', '52900', '0', '{\"specs\":{\"chip\":\"Nvidia GTX 1070 Pascal\"}}', 'enabled', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', 'ROG Strix GeForce GTX 1070');
INSERT INTO `product` VALUES ('3', 'geforce-gtx-980ti', 'evga', 'gpu', '62900', '62900', '1', null, 'enabled', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', 'GeForce GTX 980 Ti');
INSERT INTO `product` VALUES ('4', 'rival-300-black', 'steelseries', 'mouse', '5990', '6500', '20', null, 'enabled', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', 'Rival 300 Black');
INSERT INTO `product` VALUES ('6', 'rival-300-silver', 'steelseries', 'mouse', '5790', '6500', '9', null, 'enabled', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', 'Rival 300 Silver');
INSERT INTO `product` VALUES ('7', 'fk1', 'zowie', 'mouse', '6999', '6999', '1', null, 'enabled', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', 'FK1');
INSERT INTO `product` VALUES ('8', 'camade', 'zowie', 'accessory', '2499', '2499', '2', null, 'enabled', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', 'Camade');
INSERT INTO `product` VALUES ('9', 'xps15-9550-cnx5521', 'dell', 'laptop', '154901', '160000', '1', null, 'enabled', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', 'XPS 15 9550');
INSERT INTO `product` VALUES ('10', 'rival-300-white', 'steelseries', 'mouse', '5990', '6500', '0', null, 'enabled', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', 'Rival 300 White');

-- ----------------------------
-- Table structure for search_history
-- ----------------------------
DROP TABLE IF EXISTS `search_history`;
CREATE TABLE `search_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) DEFAULT NULL,
  `search` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `createdon` datetime NOT NULL,
  `updatedon` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_AA6B9FD19B6B5FBA` (`account_id`),
  CONSTRAINT `search_history_account` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of search_history
-- ----------------------------

-- ----------------------------
-- Table structure for wish_list
-- ----------------------------
DROP TABLE IF EXISTS `wish_list`;
CREATE TABLE `wish_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `name` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `createdon` datetime NOT NULL,
  `updatedon` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5B8739BD9B6B5FBA` (`account_id`),
  CONSTRAINT `wish_list_account` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of wish_list
-- ----------------------------

-- ----------------------------
-- Table structure for wish_list_line
-- ----------------------------
DROP TABLE IF EXISTS `wish_list_line`;
CREATE TABLE `wish_list_line` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wish_list_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `createdon` datetime NOT NULL,
  `updatedon` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_547036F9D69F3311` (`wish_list_id`),
  KEY `IDX_547036F94584665A` (`product_id`),
  CONSTRAINT `wish_list_line_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `wish_list_line_wish_list` FOREIGN KEY (`wish_list_id`) REFERENCES `wish_list` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of wish_list_line
-- ----------------------------