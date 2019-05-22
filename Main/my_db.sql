-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 17, 2018 at 11:54 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.1.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL COMMENT '文章id',
  `title` varchar(60) NOT NULL COMMENT '標題',
  `category` varchar(50) NOT NULL COMMENT '分類',
  `content` text NOT NULL COMMENT '內文',
  `publish` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否發布',
  `create_date` datetime NOT NULL COMMENT '建立日期',
  `create_user_id` int(11) NOT NULL COMMENT '文章建立者id',
  `modify_date` datetime DEFAULT NULL COMMENT '修改日期'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `category`, `content`, `publish`, `create_date`, `create_user_id`, `modify_date`) VALUES
(7, 'What is cross-site scripting (XSS)?', 'Cross-site Scripting', 'With XSS\nNow known as the Samy worm, his JavaScript automatically made friends with visitors and popped up a message that proclaimed, &quot;Samy is my hero!&quot; By the time MySpace pulled the plug, Samy had made a million friends in 24 hours.', 1, '2018-08-22 18:12:14', 5, '2018-08-22 18:16:24'),
(8, 'SQL injection prevention', 'Injection', 'Here are ten steps you can take to significantly reduce the risk of falling victim to a SQL injection attack\n\n\n\n\n\nHere are ten steps you can take to significantly reduce the risk of falling victim to a SQL injection attack\n///\nHere are ten steps you can take to significantly reduce the risk of falling victim to a SQL injection attack\nHere are ten steps you can take to significantly reduce the risk of falling victim to a SQL injection attack', 1, '2018-08-22 18:20:46', 5, '2018-08-22 18:21:21');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL COMMENT '評論id',
  `comment_article_id` int(11) NOT NULL COMMENT '評論的文章id',
  `content` text NOT NULL COMMENT '評論內容',
  `create_date` datetime NOT NULL COMMENT '建立日期',
  `create_user_id` int(11) NOT NULL COMMENT '評論者id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `demo`
--

CREATE TABLE `demo` (
  `id` int(11) NOT NULL,
  `article` varchar(50) NOT NULL,
  `author` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `demo`
--

INSERT INTO `demo` (`id`, `article`, `author`) VALUES
(1, 'article1', 'author1'),
(2, 'article2', 'author2');

-- --------------------------------------------------------

--
-- Table structure for table `realuser`
--

CREATE TABLE `realuser` (
  `id` int(11) NOT NULL COMMENT 'userid',
  `name` varchar(50) NOT NULL COMMENT 'name',
  `email` varchar(100) NOT NULL COMMENT 'email',
  `password` varchar(100) NOT NULL COMMENT 'password',
  `img_path` text COMMENT 'image path',
  `img_css` varchar(50) NOT NULL DEFAULT 'circular-portrait',
  `L1` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'F0 T1',
  `L2` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'F0 T1',
  `L3` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'F0 T1',
  `L4` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'F0 T1',
  `L5` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'F0 T1',
  `L6` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'F0 T1',
  `L7` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'F0 T1',
  `L8` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'F0 T1',
  `L9` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'F0 T1',
  `L10` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'F0 T1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `realuser`
--

INSERT INTO `realuser` (`id`, `name`, `email`, `password`, `img_path`, `img_css`, `L1`, `L2`, `L3`, `L4`, `L5`, `L6`, `L7`, `L8`, `L9`, `L10`) VALUES
(5, 'Ting-Yu Liu', 'tyl2y17@soton.ac.uk', '59b94c2d71db0f9166684e6830dccf21', 'files/images/logo.png', 'circular-portrait', 1, 1, 1, 0, 0, 0, 0, 0, 0, 1),
(6, 'Tingyu Liu', 'tinyu1016@gmail.com', '59b94c2d71db0f9166684e6830dccf21', NULL, 'circular-portrait', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(8, 'Tester02', 'test02@soton.ac.uk', '59b94c2d71db0f9166684e6830dccf21', 'files/images/logo.jpg', 'circular-portrait', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(11, 'giraffe', 'tyl@sss', '59b94c2d71db0f9166684e6830dccf21', 'images/giraffe.jpg', 'circular-portrait', 1, 0, 1, 1, 0, 0, 1, 0, 0, 0),
(12, 'Giraffe', 'giraffe@soton.ac.uk', '59b94c2d71db0f9166684e6830dccf21', 'files/images/3.jpg', 'circular-portrait', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL COMMENT '使用者id',
  `username` varchar(30) NOT NULL COMMENT '登⼊帳號',
  `password` varchar(100) NOT NULL COMMENT '使用者密碼',
  `name` varchar(30) NOT NULL COMMENT '名字'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `name`) VALUES
(6, 'jolin', '17f2813766a1d90945e5e255c9f37179', 'Jolin');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'user1', 'password1'),
(2, 'user2', 'password2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `create_user_id` (`create_user_id`),
  ADD KEY `comment_article_id` (`comment_article_id`);

--
-- Indexes for table `demo`
--
ALTER TABLE `demo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `realuser`
--
ALTER TABLE `realuser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
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
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '文章id', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '評論id';

--
-- AUTO_INCREMENT for table `demo`
--
ALTER TABLE `demo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `realuser`
--
ALTER TABLE `realuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'userid', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '使用者id', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
