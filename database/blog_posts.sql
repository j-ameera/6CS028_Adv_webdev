-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2024 at 04:06 AM
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
  `gif_url` varchar(255) DEFAULT NULL,
  `youtube_keywords` varchar(255) DEFAULT NULL,
  `giphy_keywords` varchar(255) DEFAULT NULL,
  `author_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `hashtags` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `title`, `content`, `image`, `video_url`, `gif_url`, `youtube_keywords`, `giphy_keywords`, `author_id`, `created_at`, `hashtags`) VALUES
(16, 'testing hashtags again.', 'holy hell.', 'image1.jpg', 'https://www.youtube.com/watch?v=ZsT1nj6UfvA', 'https://media4.giphy.com/media/7wk6RQYXDDytXalsL4/giphy.gif?cid=bedcbe04q7n5ix522gvdibeut6wusrw125gc8vkktvtfyuon&ep=v1_gifs_search&rid=giphy.gif&ct=g', '', 'nope', 1, '2024-06-27 02:44:59', '#arcane #test'),
(17, 'testing hashtags again', 'hello', 'DhxlblnXkAAg2sJ1.jpg', 'https://www.youtube.com/watch?v=Pxj2hWgodag', 'https://media2.giphy.com/media/GRPy8MKag9U1U88hzY/giphy.gif?cid=bedcbe047mad3335iji8vl24kfg5opdern19jb54rl4t1ysc&ep=v1_gifs_search&rid=giphy.gif&ct=g', 'gwgaw', 'hello', 1, '2024-06-27 03:02:54', '#hello');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
