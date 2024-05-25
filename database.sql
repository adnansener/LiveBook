--  CREATE DATABASE

CREATE DATABASE `library`;


--  CREATE TABLES INSIDE OUR DATABASE

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `product_author` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `product_quantity` int(5) NOT NULL,
  `product_photo` varchar(60) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

CREATE TABLE `user_info` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `user_mail` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `user_password` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

CREATE TABLE `user_product` (
  `process_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_product_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `purchase_date` date NOT NULL,
  PRIMARY KEY (`process_id`),
  KEY `user_urun_ibfk_1` (`user_product_id`),
  KEY `user_urun_ibfk_2` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=100 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

CREATE TABLE `user_thoughts` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_message` varchar(500) COLLATE utf8_turkish_ci NOT NULL,
  `spoiler` int(11) NOT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

CREATE TABLE `all_message` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_mail` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `user_message` varchar(500) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

CREATE TABLE `buy_history` (
  `process_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `purchase_date` date NOT NULL,
  PRIMARY KEY (`process_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;


-- INSERT SOME VALUES INTO OUR TABLES

INSERT INTO `product` (`product_id`, `product_name`, `product_author`, `product_quantity`, `product_photo`) VALUES
(1, 'fareler ve insanlar', 'john steinbeck', 4, 'myImages/farelerveinsanlar.jpg'),
(2, 'inci', 'john steinbeck', 3, 'myImages/inci.jpg'),
(3, 'On Sözcükte Çin', 'Yu Hua', 5, 'myImages/onsozcuktecin.jpg'),
(4, 'Yaşamak', 'Yu Hua', 0, 'myImages/yasamak.jpg'),
(5, 'Kırmızı Papağan', 'jose Mauro De Vasconcelos', 1, 'myImages/kirmizipapagan.jpg'),
(6, 'Şeker Portakalı', 'jose Mauro De Vasconcelos', 6, 'myImages/sekerportakali.jpg'),
(7, 'Momo', 'Michael Ende', 5, 'myImages/momo.jpg');