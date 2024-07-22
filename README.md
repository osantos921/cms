-----------------------------------Delete this -------------------------------------
Note : Import this SQL for Database
Please delete this note before importing the database
----------------------------------- Delete this-------------------------------------


-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2024 at 03:39 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `catId` int(11) NOT NULL,
  `catTitle` varchar(255) NOT NULL,
  `inActive` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`catId`, `catTitle`, `inActive`) VALUES
(1, 'VB.net', 0),
(2, 'CSharp', 0),
(3, 'Php', 0),
(5, 'RestAPI', 0);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `commentId` int(11) NOT NULL,
  `commentPostId` int(11) NOT NULL,
  `commentDate` date NOT NULL,
  `commentAuthor` varchar(255) NOT NULL,
  `commentEmail` varchar(255) NOT NULL,
  `commentContent` text NOT NULL,
  `commentStatus` varchar(255) NOT NULL,
  `inActive` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentId`, `commentPostId`, `commentDate`, `commentAuthor`, `commentEmail`, `commentContent`, `commentStatus`, `inActive`) VALUES
(1, 1, '2024-07-19', 'Oscar Santos', 'oscar.santos921@gmail.com', 'Wow comment features is comming', 'Approved', 0),
(2, 1, '2024-07-19', 'Oscar Santos', 'oscar.santos921@gmail.com', 'test2', 'Approved', 0),
(3, 1, '2024-07-19', 'Oscar Santos', 'oscar.santos921@gmail.com', 'test3', 'Draft', 0),
(4, 1, '2024-07-19', 'Oscar Santos', 'oscar.santos921@gmail.com', 'test4', 'Draft', 0);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `postId` int(11) NOT NULL,
  `postCategoryId` int(11) NOT NULL,
  `postTitle` varchar(255) NOT NULL,
  `postAuthor` varchar(255) NOT NULL,
  `postUser` varchar(255) NOT NULL,
  `postDate` date NOT NULL,
  `postImage` varchar(255) NOT NULL,
  `postContent` text NOT NULL,
  `postTags` varchar(255) NOT NULL,
  `postCommentCount` int(11) NOT NULL,
  `postStatus` varchar(255) NOT NULL,
  `postViewCount` int(11) NOT NULL,
  `inActive` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`postId`, `postCategoryId`, `postTitle`, `postAuthor`, `postUser`, `postDate`, `postImage`, `postContent`, `postTags`, `postCommentCount`, `postStatus`, `postViewCount`, `inActive`) VALUES
(1, 1, 'New Php App', 'Oscar Santos', 'Oscar Santos', '2024-07-18', 'php.jpg', 'this is a great challenge for me to recreate this php again Lol.', 'Vb.Net,CSharp,Php', 0, 'Published', 0, 0),
(2, 1, 'Test', 'Oscar', 'Admin', '2024-07-19', 'Java.jpg', 'wow mate this is great', 'cSharp', 0, 'Published', 0, 0),
(3, 1, 'Test', 'Oscar', 'Admin', '2024-07-19', 'cSharp.jpg', 'this is improve version of my old php codes', 'Vb.net', 0, 'Published', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `userPassword` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `userImage` varchar(255) NOT NULL,
  `userRole` varchar(255) NOT NULL,
  `randSalt` varchar(255) NOT NULL,
  `inActive` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userName`, `userPassword`, `firstName`, `lastName`, `userEmail`, `userImage`, `userRole`, `randSalt`, `inActive`) VALUES
(1, 'admin', 'admin', 'Oscar', 'Santos', 'asd@asd.com', 'admin.jpg', 'Admin', 'dsa', 0),
(2, 'user', 'user', 'Jeje', 'Santos', 'Jeje@gmail.com', 'user.jpg', 'Subsciber', 'user', 0),
(5, 'test', 'test', 'test', 'test', 'test@test.com', 'user.jpg', 'Subscriber', 'user', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`catId`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentId`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`postId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `postId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

