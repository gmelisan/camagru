-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 20, 2019 at 12:50 AM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `camagru`
--
CREATE DATABASE IF NOT EXISTS `camagru` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `camagru`;

-- --------------------------------------------------------

--
-- Table structure for table `collages`
--

CREATE TABLE `collages` (
  `id` int(4) NOT NULL,
  `user_id` int(4) NOT NULL,
  `date` datetime NOT NULL,
  `src` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `collages`
--

INSERT INTO `collages` (`id`, `user_id`, `date`, `src`) VALUES
(1, 1, '2019-06-19 00:00:01', 'collages/1.jpg'),
(2, 1, '2019-06-19 00:00:02', 'collages/2.jpg'),
(3, 2, '2019-06-19 00:00:03', 'collages/3.jpg'),
(4, 2, '2019-06-19 00:00:04', 'collages/4.jpg'),
(5, 1, '2019-06-19 00:00:05', 'collages/5.jpg'),
(6, 3, '2019-06-19 00:00:06', 'collages/6.jpg'),
(7, 1, '2019-06-19 00:00:07', 'collages/7.jpg'),
(8, 1, '2019-06-19 00:00:08', 'collages/8.jpg'),
(9, 2, '2019-06-19 00:00:09', 'collages/9.jpg'),
(10, 1, '2019-06-19 00:00:10', 'collages/10.jpg'),
(11, 3, '2019-06-19 00:00:11', 'collages/11.jpg'),
(12, 3, '2019-06-19 00:00:12', 'collages/12.jpg'),
(13, 3, '2019-06-19 00:00:13', 'collages/13.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `collage_id` int(4) NOT NULL,
  `user_id` int(4) NOT NULL,
  `text` varchar(1024) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`collage_id`, `user_id`, `text`, `date`) VALUES
(3, 1, 'OMG this pic 10 out of 10!', '2019-06-20 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(4) NOT NULL,
  `src` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `src`) VALUES
(1, 'images/1.png'),
(2, 'images/2.png'),
(3, 'images/3.png');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `collage_id` int(4) NOT NULL,
  `user_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`collage_id`, `user_id`) VALUES
(1, 1),
(3, 2),
(1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(4) NOT NULL,
  `login` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `send_email` tinyint(1) NOT NULL DEFAULT 1,
  `reg_date` datetime NOT NULL,
  `verification_code` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `email`, `send_email`, `reg_date`, `verification_code`) VALUES
(1, 'gmelisan', '7917357096b21ccc7217b0f0abbcd077111eb5fa65c0083a3299bcdef854b023d3812b6360129f8f6bdba0a47b893ffa7f1834e5ba92a30a94f4944b9c9e35cd', 'test@test.com', 1, '2019-06-16 19:28:09', ''),
(2, 'test1', 'test1', 'test@test.com', 0, '2019-06-20 00:00:00', ''),
(3, 'test2', 'test2', 'test@test.com', 1, '2019-06-20 00:00:00', ''),
(4, 'test3', 'test3', 'test@test.com', 0, '2019-06-20 00:00:00', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `collages`
--
ALTER TABLE `collages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD KEY `collage_id` (`collage_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD KEY `likes_ibfk_1` (`collage_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `collages`
--
ALTER TABLE `collages`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `collages`
--
ALTER TABLE `collages`
  ADD CONSTRAINT `collages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`collage_id`) REFERENCES `collages` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`collage_id`) REFERENCES `collages` (`id`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
