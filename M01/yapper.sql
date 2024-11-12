-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2024 at 02:20 PM
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
-- Database: `yapper`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `addressID` int(11) NOT NULL,
  `cityID` int(11) DEFAULT NULL,
  `provinceID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`addressID`, `cityID`, `provinceID`) VALUES
(1, 2, 1),
(2, 4, 1),
(3, 1, 1),
(4, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `cityID` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`cityID`, `name`) VALUES
(1, 'Lipa'),
(2, 'Sto. Tomas'),
(3, 'Tanauan'),
(4, 'Calamba'),
(5, 'Rosario');

-- --------------------------------------------------------

--
-- Table structure for table `closefriends`
--

CREATE TABLE `closefriends` (
  `closeFriendID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `ownerID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `commentID` int(11) NOT NULL,
  `dateTime` varchar(30) DEFAULT NULL,
  `content` varchar(2000) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  `postID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `friendID` int(11) NOT NULL,
  `requesterID` int(11) DEFAULT NULL,
  `requesteeID` int(11) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`friendID`, `requesterID`, `requesteeID`, `status`) VALUES
(1, 3, 1, 'friends'),
(2, 1, 4, 'pending'),
(3, 2, 1, 'friends'),
(4, 2, 3, 'friends'),
(5, 4, 2, 'friends');

-- --------------------------------------------------------

--
-- Table structure for table `gcmembers`
--

CREATE TABLE `gcmembers` (
  `gcMemberID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `gcID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groupchat`
--

CREATE TABLE `groupchat` (
  `gcID` int(11) NOT NULL,
  `adminID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `messageID` int(11) NOT NULL,
  `senderID` int(11) DEFAULT NULL,
  `receiverID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `postID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `content` varchar(2000) DEFAULT NULL,
  `dateTime` varchar(30) DEFAULT NULL,
  `privacy` varchar(30) DEFAULT NULL,
  `isDeleted` varchar(5) DEFAULT NULL,
  `attachment` varchar(50) DEFAULT NULL,
  `cityID` int(11) DEFAULT NULL,
  `provinceID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `provinceID` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`provinceID`, `name`) VALUES
(1, 'Batangas');

-- --------------------------------------------------------

--
-- Table structure for table `reactions`
--

CREATE TABLE `reactions` (
  `reactionID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `postID` int(11) DEFAULT NULL,
  `kind` varchar(30) DEFAULT NULL,
  `commentID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `userInfoID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `addressID` int(11) DEFAULT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `birthDay` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`userInfoID`, `userID`, `addressID`, `firstName`, `lastName`, `birthDay`) VALUES
(1, 1, 1, 'Zhongli', 'Morax', '2021-12-31'),
(2, 2, 2, 'Raiden', 'Shogun', '2021-06-26'),
(3, 3, 3, 'Changli', 'Angel', '2021-06-26'),
(4, 4, 4, 'Haseo', 'Skeith', '2004-02-01'),
(5, 5, NULL, 'Harry', 'Potter', '1980-07-31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `messageID` int(11) DEFAULT NULL,
  `userName` varchar(50) NOT NULL,
  `userpfp` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `messageID`, `userName`, `userpfp`, `password`) VALUES
(1, NULL, 'moraxnomora', 'zhonglipfp.png', 'iloveraiden'),
(2, NULL, 'raidencantcook', 'raidenpfp.png', 'eternity'),
(3, NULL, 'changli_baby', 'changlipfp.png', 'ganda'),
(4, NULL, 'haseoTOD', 'haseopfp.png', 'pogi'),
(5, NULL, 'harry_pota', 'nopfp.png', 'password1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`addressID`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`cityID`);

--
-- Indexes for table `closefriends`
--
ALTER TABLE `closefriends`
  ADD PRIMARY KEY (`closeFriendID`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentID`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`friendID`);

--
-- Indexes for table `gcmembers`
--
ALTER TABLE `gcmembers`
  ADD PRIMARY KEY (`gcMemberID`);

--
-- Indexes for table `groupchat`
--
ALTER TABLE `groupchat`
  ADD PRIMARY KEY (`gcID`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`messageID`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`postID`);

--
-- Indexes for table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`provinceID`);

--
-- Indexes for table `reactions`
--
ALTER TABLE `reactions`
  ADD PRIMARY KEY (`reactionID`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`userInfoID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `addressID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `cityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `closefriends`
--
ALTER TABLE `closefriends`
  MODIFY `closeFriendID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `friendID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `gcmembers`
--
ALTER TABLE `gcmembers`
  MODIFY `gcMemberID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groupchat`
--
ALTER TABLE `groupchat`
  MODIFY `gcID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `messageID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `postID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `provinceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reactions`
--
ALTER TABLE `reactions`
  MODIFY `reactionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `userInfoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
