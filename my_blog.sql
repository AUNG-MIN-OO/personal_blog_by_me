-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 18, 2021 at 05:57 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `user_id`, `category_name`, `created_at`) VALUES
(1, 3, 'News', '2021-07-18 11:20:09'),
(2, 3, 'Blogs', '2021-07-18 11:20:11'),
(3, 3, 'Health', '2021-07-18 11:20:14'),
(4, 3, 'Articles', '2021-07-18 11:20:16'),
(5, 3, 'Entertainment', '2021-07-18 11:20:19'),
(6, 3, 'Crime', '2021-07-18 11:20:52');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `image` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `description`, `image`, `category_id`, `created_at`) VALUES
(1, 1, 'Javascript Ebook', 'Best Javascript Ebook is published now!!!', 'preview.png', 1, '2021-07-17 19:06:52'),
(2, 1, 'Javascript Ebook', 'Best Javascript Ebook is published now!!!', 'preview.png', 1, '2021-07-17 19:07:59'),
(5, 1, 'title is gaung sin', 'Description is body', 'b.png', 1, '2021-07-17 19:12:49'),
(6, 1, 'title is gaung sin', 'Description is body', 'b.png', 1, '2021-07-17 19:13:13'),
(7, 1, 'title is gaung sin', 'Description is body', 'b.png', 1, '2021-07-17 19:13:26'),
(8, 1, 'title is gaung sin', 'Description is body', 'b.png', 1, '2021-07-17 19:13:46'),
(9, 1, 'title is gaung sin', 'Description is body', 'b.png', 1, '2021-07-17 19:13:56'),
(10, 1, 'title is gaung sin', 'Description is body', 'b.png', 1, '2021-07-17 19:14:06'),
(16, 1, 'title is gaung sin', 'Description is body', 'b.png', 1, '2021-07-17 19:16:40'),
(20, 3, 'Lorem', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', '20141225_204934.jpg', 6, '2021-07-18 10:54:46'),
(21, 3, 'edit test Update', 'test update\r\n', 'aa.jpeg', 4, '2021-07-18 15:00:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` tinyint(1) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `image`, `created_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$iwDduxxE2jG.Ui557psYieDAKtcsVzHlcpukUsC1rwCY03icr8owm', 1, NULL, '2021-07-17 18:13:59'),
(2, 'Pro', 'pro@gmail.com', '$2y$10$pHVR3y4AAbcqE.QggBg1m.iahnOKqxiK1A4nbcCpw/2WtesknlbYW', 1, NULL, '2021-07-18 05:21:37'),
(3, 'Kyaw Gyii', 'kyawgyi@gmail.com', '$2y$10$mYFWXEAkcn03EQDK9RR6fu3J.FqcoxAVtEGUT8AoR70UFtAak6gN2', 1, NULL, '2021-07-18 05:23:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
