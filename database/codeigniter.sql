-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2024 at 03:43 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `site`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `author_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `youtube_keywords` varchar(255) DEFAULT NULL,
  `giphy_keywords` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `title`, `content`, `image`, `video_url`, `author_id`, `created_at`, `youtube_keywords`, `giphy_keywords`) VALUES
(3, 'cringe', 'segsegsegse', 'DhxlblnXkAAg2sJ.jpg', '', 1, '2024-06-26 00:33:15', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL CHECK (char_length(`username`) >= 5),
  `password` varchar(255) NOT NULL CHECK (char_length(`password`) >= 8),
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` enum('admin','visitor') DEFAULT 'visitor'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `Created_at`, `role`) VALUES
(1, 'admin', '$2b$12$ceE.zuS810xS1J67ZebPsuq5N9L4GV2sTWmXH8.e3q1aVqGx.pAMq', '2024-06-25 10:15:10', 'admin'),
(4, 'testing123', '$2y$10$oXivQsPlD/3wLxlWQGtoA.EJ3ylm77zDvOpPrQWptjCsPX9ZBFmTW', '2024-06-25 10:37:05', 'visitor'),
(9, 'hello123', 'f30aa7a662c728b7407c54ae6bfd27d1', '2024-06-25 14:01:25', 'visitor'),
(10, 'sunimita1', '$2y$10$Oky2CJrFkUxspZObOwHVBe8ITDLeMCopy6dkWPkSonKAV10N8bc2e', '2024-06-25 19:42:45', 'visitor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
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
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
