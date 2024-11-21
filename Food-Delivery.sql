-- phpMyAdmin SQL Dump
-- version 5.2.1deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 21, 2024 at 11:14 AM
-- Server version: 11.4.3-MariaDB-1
-- PHP Version: 8.2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Food-Delivery`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phonenumber` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `fullname`, `username`, `email`, `password`, `phonenumber`) VALUES
(1, 'Omar omar omar', 'admin', 'omar_admin@gmail.com', '$2y$10$A/YfhjOViOoAZ4wksGaxI.4i01mgNgTWAKTlR0A9ETXw0EnIAvVaO', '01234567890');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 1,
  `added_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `food_id`, `quantity`, `added_at`) VALUES
(21, 23, 3, 1, '2024-10-18 13:34:52'),
(22, 23, 7, 1, '2024-10-18 13:34:58'),
(23, 23, 12, 1, '2024-10-18 13:35:01'),
(24, 19, 4, 1, '2024-10-18 14:43:51'),
(26, 19, 11, 1, '2024-10-18 14:43:54'),
(27, 19, 2, 2, '2024-10-18 14:43:56'),
(28, 19, 1, 1, '2024-10-18 18:21:14');

-- --------------------------------------------------------

--
-- Table structure for table `foods`
--

CREATE TABLE `foods` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `food_picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`id`, `name`, `description`, `price`, `food_picture`) VALUES
(1, 'Pizza', 'best pizza ever', 123.00, '/Food-Delivery/uploads/food_pictures/pizza.jpg'),
(2, 'Sea Food', 'best sea food ever you cat eat', 234.00, '/Food-Delivery/uploads/food_pictures/seafood.jpeg'),
(3, 'Sweet Potatoes', 'best Sweet potatoes you can ever imagine', 345.00, '/Food-Delivery/uploads/food_pictures/potates.jpeg'),
(4, 'Fried Chicken', 'Best Fried Chicken you can see in your life', 456.00, '/Food-Delivery/uploads/food_pictures/friedchicken.jpeg'),
(5, 'Burger', 'Best Burger ever', 352.00, '/Food-Delivery/uploads/food_pictures/burger.jpeg'),
(6, 'Kabab', 'Best Kabab ever', 235.00, '/Food-Delivery/uploads/food_pictures/Kabab.jpg'),
(7, 'Meat', 'Best Middle meat you will eat', 234.00, '/Food-Delivery/uploads/food_pictures/meat.jpeg'),
(8, 'Nodels', 'Best Nodels you will find', 11.00, '/Food-Delivery/uploads/food_pictures/Nodels.jpeg'),
(9, 'Pasta', 'Best pasta you will ever see', 34.00, '/Food-Delivery/uploads/food_pictures/pasta.jpeg'),
(10, 'Ramen', 'Best Ramen you will ever eat', 32.00, '/Food-Delivery/uploads/food_pictures/Ramen.jpg'),
(11, 'Rendang', 'Best Rendang you will see', 34.00, '/Food-Delivery/uploads/food_pictures/Rendang.jpg'),
(12, 'Sushi', 'Best Sushi you will eat', 56.00, '/Food-Delivery/uploads/food_pictures/Sushi.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phonenumber` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `username`, `email`, `password`, `phonenumber`) VALUES
(18, 'Joe Cardone', 'joe', 'joe_1337@gmail.com', '$2y$10$EeRttQs.JH45s6IcL7V5UeCrvALkAyL//D0L87ZDphAu6nzuwn1d6', '1234567890'),
(19, 'Alexa Frans', 'alexa', 'alexaishere@gmail.com', '$2y$10$vcdB15ZwWYIY156cZjZMHOTKBtr8bNuRM2LCTfl4F7mdM4rA.k8CC', '123442345234'),
(21, 'omar for testing', 'omar1111', 'omar@gmail.com', '$2y$10$tz1LRs.mSdZWHTJ.X/Y1euaGFVEtoU3mPXHNS38GRVdh1PBwfTf2q', '124231323224324324'),
(22, 'JOE', 'alexa11', '03b8d6d6a4@emailaoa.pro', '$2y$10$NlZ/xvxpP/ccFtNUmaymt.rfz/XvN4sgb9e3a3TAxDRGml0Lh0DIy', '01066970621'),
(23, 'sdfds', 'erer', 'yousseffusa8787@gmail.com', '$2y$10$byJDA8C.d0hMfCvc3A3.G.BIU.W0UgOgA6Tj0LavfKR9YylBx.pGC', '01066970621');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `food_id` (`food_id`);

--
-- Indexes for table `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `foods`
--
ALTER TABLE `foods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`food_id`) REFERENCES `foods` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
