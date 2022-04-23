-- CREACIÓN DE BASE DE DATOS
CREATE DATABASE `bibliotech_DAW` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `bibliotech_DAW`;

-- USUARIO DE BASE DE DATOS
CREATE USER adminBD@'localhost' IDENTIFIED BY "passwordBD";
GRANT ALL on `bibliotech_DAW`.* TO adminBD@'localhost';

-- TABLA USUARIO
CREATE TABLE `user` (
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255),
  `name` varchar(255),
  `password` varchar(255) NOT NULL,
  `role` enum('ADMIN', 'MOD', 'USER') NOT NULL,
  PRIMARY KEY (`username`)
);

-- TABLA CATEGORÍA
CREATE TABLE `category` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `image` varchar(255),
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);

-- TABLA LIBRO
CREATE TABLE `book` (
  `ISBN` varchar(255) NOT NULL,
  `name` varchar(255),
  `author` varchar(255),
  `description` varchar(3000),
  `price` double,
  `quantity` int(5),
  `category_id` int(4) NOT NULL,
  `pages` int(5),
  `publish_date` datetime,
  `modified_at` datetime,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`ISBN`),
  CONSTRAINT `fk_book_category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
);

-- TABLA PRÉSTAMO
CREATE TABLE `lending` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `book_id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `returned` tinyint(1) NOT NULL,
  `assigned_return_date` datetime,
  `real_return_date` datetime,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_lending_book_id` FOREIGN KEY (`book_id`) REFERENCES `book` (`ISBN`),
  CONSTRAINT `fk_lending_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`username`)
);
