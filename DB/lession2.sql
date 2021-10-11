-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2021 at 11:44 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE lession2 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lession2`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `parent_id`) VALUES
(1, 'Category1', 0),
(2, 'Category2', 0),
(3, 'Category3', 0),
(4, 'Category4', 0),
(6, 'Category6', 0),
(7, 'Category7', 0),
(8, 'Category8', 11),
(9, 'Category9', 0),
(10, 'Category10', 0),
(11, 'Category11', 1),
(12, 'Category12', 0),
(13, 'Category13', 2),
(14, 'Category14', 1),
(15, 'Category15', 3),
(16, 'Category16', 11),
(17, 'Category17', 14),
(18, 'Category18', 3),
(19, 'Category19', 0),
(20, 'Category20', 0),
(22, 'Category22', 0),
(23, 'Category23', 0),
(24, 'Category24', 0),
(25, 'Category25', 9),
(29, 'Category29', 19);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
