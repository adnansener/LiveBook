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
(1, 'A Game of Thrones', 'George R. R. Martin', 4, 'myImages/a_game_of_thrones.png'),
(2, 'A Feast for Crows', 'George R. R. Martin', 3, 'myImages/a_feast_for_crows.png'),
(3, 'A Dance With Dragons', 'George R. R. Martin', 5, 'myImages/a_dance_with_dragons.png'),
(4, 'A Storm of Swords', 'George R. R. Martin', 0, 'myImages/a_storm_of_swords.png'),
(5, 'The Hobbit', 'J. R. R. Tolkien', 1, 'myImages/the_hobbit.png'),
(6, 'Unfinished Tales', 'J. R. R. Tolkien', 6, 'myImages/unfinished_tales.png'),
(7, 'The Lord of the Rings', 'J. R. R. Tolkien', 1, 'myImages/the_lord_of_the_rings.png'),
(8, 'Harry Potter and the Philosophers Stone', 'J. K. Rowling', 21, 'myImages/harry_potter_and_the_philosophers_stone.png'),
(9, 'Harry Potter and the Chamber of Secrets', 'J. K. Rowling', 3, 'myImages/harry_potter_and_the_chamber_of_secrets.png'),
(10, 'Harry Potter and the Prisoner of Azkaban', 'J. K. Rowling', 6, 'myImages/harry_potter_and_the_prisoner_of_azkaban.png'),
(11, 'Harry Potter and the Goblet of Fire', 'J. K. Rowling', 2, 'myImages/harry_potter_and_the_goblet_of_fire.png'),
(12, 'Harry Potter and the Order of the Phoenix', 'J. K. Rowling', 0, 'myImages/harry_potter_and_the_order_of_the_phoenix.png'),
(13, 'Harry Potter and the Half Blood Prince', 'J. K. Rowling', 3, 'myImages/harry_potter_and_the_half_blood_prince.png'),
(14, 'Harry Potter and the Deathly Hallows', 'J. K. Rowling', 4, 'myImages/harry_potter_and_the_deathly_hallows.png');
