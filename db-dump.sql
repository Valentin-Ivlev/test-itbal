-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 20, 2022 at 03:36 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `it-balans`
--

-- --------------------------------------------------------

--
-- Table structure for table `citys`
--

CREATE TABLE `citys` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `citys`
--

INSERT INTO `citys` (`id`, `name`) VALUES
(1, 'Москва'),
(2, 'Санкт-Перербург'),
(3, 'Нижний Новгород'),
(4, 'Екатеринбург'),
(5, 'Новосибирск'),
(6, 'Уфа'),
(7, 'Красноярск'),
(8, 'Самара'),
(9, 'Воронеж'),
(10, 'Ростов-на-Дону'),
(11, 'Краснодар'),
(12, 'Казань');

-- --------------------------------------------------------

--
-- Table structure for table `education_levels`
--

CREATE TABLE `education_levels` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `education_levels`
--

INSERT INTO `education_levels` (`id`, `name`) VALUES
(1, 'среднее'),
(2, 'бакалавр'),
(3, 'магистр'),
(4, 'специалист');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `education_level_id` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `education_level_id`) VALUES
(1, 'Александр', 3),
(2, 'Сергей', 4),
(3, 'Павел', 2),
(4, 'Ирина', 2),
(5, 'Анна', 2),
(6, 'Мария', 1),
(7, 'Михаил', 3),
(8, 'Евгений', 2),
(9, 'Петр', 1),
(10, 'Иван', 4),
(11, 'Елена', 3),
(12, 'Дмитрий', 2),
(13, 'Алексей', 3),
(14, 'Марина', 3),
(15, 'Вячеслав', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users_to_citys`
--

CREATE TABLE `users_to_citys` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `city_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_to_citys`
--

INSERT INTO `users_to_citys` (`user_id`, `city_id`) VALUES
(1, 1),
(1, 2),
(2, 10),
(3, 7),
(4, 11),
(4, 1),
(4, 4),
(5, 8),
(5, 9),
(6, 2),
(7, 5),
(7, 11),
(8, 12),
(8, 2),
(9, 10),
(9, 9),
(10, 1),
(10, 12),
(11, 5),
(11, 11),
(12, 3),
(12, 5),
(13, 3),
(13, 6),
(14, 4),
(14, 7),
(14, 12),
(15, 5),
(15, 9),
(15, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `citys`
--
ALTER TABLE `citys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `education_levels`
--
ALTER TABLE `education_levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `citys`
--
ALTER TABLE `citys`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `education_levels`
--
ALTER TABLE `education_levels`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
