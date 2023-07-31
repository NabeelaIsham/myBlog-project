-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2023 at 08:08 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `title`, `description`) VALUES
(1, 'food', 'description for food is compulsory'),
(3, 'wild life', 'description wild life'),
(9, 'Uncategories', 'description is unknown'),
(10, 'Arts', 'Life of Arts'),
(12, 'Music', 'love the music'),
(13, 'Nature', 'Nature has special love');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `com_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `comment_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`com_id`, `name`, `email`, `comment_text`, `created_at`, `avatar`) VALUES
(4, 'nawra', 'nawra@gmail.com', 'nice view', '2023-07-09 12:52:19', ''),
(5, 'nabeela isham', 'nabeelaisham28@gmail.com', 'this site gives more attraction', '2023-07-09 13:28:37', ''),
(6, 'Alina arose', 'alina@gmail.com', 'best site ever i have watched or browse out', '2023-07-09 13:55:19', '');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `po_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `category_id` int(11) UNSIGNED DEFAULT NULL,
  `author_id` int(11) UNSIGNED NOT NULL,
  `is_featured` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`po_id`, `title`, `body`, `thumbnail`, `date_time`, `category_id`, `author_id`, `is_featured`) VALUES
(6, 'Tiger on prey', 'Always tiger waits for the prey', '1688400967_sumatran-tiger-eating-its-prey-18137579.jpg', '2023-07-03 16:16:07', 3, 19, 0),
(7, 'Violin ', 'sounds all fine with lovely tune', '1688401627_photo-1612225330812-01a9c6b355ec.jpg', '2023-07-03 16:27:07', 12, 5, 0),
(8, 'Art of Love', 'Being deeply loved by someone gives you strength, while loving someone deeply gives you courage.&quot; &quot;We are most alive when we are in love.&quot; &quot;The only thing we never get enough of is love; and the only thing we never give enough of is love.&quot; &quot;There is only one happiness in this life, to love and be loved.', '1688401758_Arts2 (14).jpg', '2023-07-03 16:29:18', 10, 5, 0),
(9, 'Family of an Elephant', 'Elephants are the largest existing land animals. Three living species are currently recognised: the African bush elephant, the African forest elephant, and the Asian elephant. They are the only surviving members of the family Elephantidae and the order Proboscidea; extinct relatives include mammoths and mastodons. Distinctive features of elephants include a long proboscis called a trunk, tusks, large ear flaps, pillar-like legs, and tough but sensitive grey skin.', '1688401883_photo-1587372653831-820c40aa336d.jpg', '2023-07-03 16:31:23', 3, 5, 1),
(10, 'Hike Mountain', 'Hiking is a long distance walk along a specific trail, most commonly across country. Some hikes can be challenging and last for days including camping, but others can be a long day walk at a steady pace. However, mountain climbing is a challenging sport in which people climb steep rocky slopes to reach the top.', '1688833352_travel (2).jpeg', '2023-07-08 16:22:32', 13, 5, 0),
(12, 'Grape wine', 'Early last long wines gives more taste with high ages of wines.\r\nA varietal wine is a wine made primarily from a single named grape variety, and which typically displays the name of that variety on the wine label. Examples of grape varieties commonly used in varietal wines are Cabernet Sauvignon, Chardonnay and Merlot.', '1689340588_Arts2 (23).jpg', '2023-07-14 13:16:28', 1, 20, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `password`, `avatar`, `is_admin`) VALUES
(5, 'Nabeela', 'Isham', 'Nabeela', 'nabeelaisham28@gmail.com', '$2y$10$D4r1Y2tcD0rxn3hwDWYpyeXeGfkjYyG3Wr8yPJqehGvgmBXho7YOu', '1686660331Author6.jpeg', 1),
(18, 'dlan', 'pramodhya', 'dilan', 'dilan@gmail.com', '$2y$10$CbQjGS2rCfBPdHpOZIBgj.lDC4UbXrbZKtzwsbyW7GjhNyKRTOB6m', '1687966530Arts2 (4).jpg', 0),
(19, 'Nawra', 'Isham', 'Nawra', 'nawra@gmail.com', '$2y$10$3AtfH0G3oHOmIvaqryCmDO3d9KK7mLjn3iHgQAW34nZ4Yv9TE4BNS', '1688400706Author9.jpg', 0),
(20, 'alex', 'duckworth', 'alex', 'alex@gmail.com', '$2y$10$sxB0mw7bOFt9MPktO.x6puswOyous6IoMoQv7mpAtuORoKhzd5KdO', '1689340425download.jpg', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`com_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`po_id`),
  ADD KEY `FK_blog_category` (`category_id`),
  ADD KEY `FK_blog_auhtor` (`author_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `com_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `po_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `FK_blog_auhtor` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_blog_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`cat_id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
