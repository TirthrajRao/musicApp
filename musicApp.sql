-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 09, 2019 at 07:09 PM
-- Server version: 5.7.25-0ubuntu0.18.04.2
-- PHP Version: 5.6.40-1+ubuntu18.04.1+deb.sury.org+2+will+reach+end+of+life+in+april+2019

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `musicApp`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cId` int(3) NOT NULL,
  `cName` varchar(256) NOT NULL,
  `cDescription` varchar(256) NOT NULL,
  `cImage` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cId`, `cName`, `cDescription`, `cImage`) VALUES
(8, 'Happy1', 'This is for happy songs', 'categoryImages/happy.jpeg'),
(9, 'Rock', 'This is for rock songs', 'categoryImages/rock.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `catSongs`
--

CREATE TABLE `catSongs` (
  `catSongId` int(11) NOT NULL,
  `sId` int(11) NOT NULL,
  `cId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `catSongs`
--

INSERT INTO `catSongs` (`catSongId`, `sId`, `cId`) VALUES
(5, 2, 8),
(6, 3, 9),
(9, 11, 8),
(10, 7, 8),
(11, 10, 8),
(12, 19, 9);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `commentId` int(11) NOT NULL,
  `comment` varchar(256) NOT NULL,
  `sId` int(11) NOT NULL,
  `uId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentId`, `comment`, `sId`, `uId`) VALUES
(1, 'demo comment', 2, 11),
(2, 'demo 2', 2, 11),
(3, 'demo 3', 2, 11),
(4, 'demo4', 2, 11),
(5, 'DEMO 5', 2, 11),
(6, 'THIS IS DEMO COMMENT WHICH IS NOT SINGLE LINED', 2, 11),
(7, 'Nice Song', 14, 11),
(8, 'Hey this is awesome!', 14, 11),
(9, 'rocking song', 14, 11),
(10, 'nice one', 16, 11),
(11, 'nice', 16, 11),
(12, 'demo comment', 14, 11);

-- --------------------------------------------------------

--
-- Table structure for table `favUnfav`
--

CREATE TABLE `favUnfav` (
  `fuId` int(3) NOT NULL,
  `uId` int(3) NOT NULL,
  `pId` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `favUnfav`
--

INSERT INTO `favUnfav` (`fuId`, `uId`, `pId`) VALUES
(15, 29, 5),
(20, 31, 8),
(26, 1, 5),
(27, 1, 4),
(29, 11, 14);

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE `playlist` (
  `pId` int(3) NOT NULL,
  `uId` int(3) NOT NULL,
  `pName` varchar(256) NOT NULL,
  `pDescription` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `playlist`
--

INSERT INTO `playlist` (`pId`, `uId`, `pName`, `pDescription`) VALUES
(3, 1, 'fav1', 'my fav playlist #fav #best'),
(4, 1, 'Playlist 2', 'another playlist #playlist2 #myfav'),
(5, 29, 'user2', 'nice #nice #good'),
(8, 31, 'Mehul', 'Mehul #mehul #rao '),
(14, 11, 'demo', '#demo'),
(15, 11, 'demo2', '#rock');

-- --------------------------------------------------------

--
-- Table structure for table `playlistSong`
--

CREATE TABLE `playlistSong` (
  `playlistSongId` int(3) NOT NULL,
  `pId` int(3) NOT NULL,
  `sId` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `playlistSong`
--

INSERT INTO `playlistSong` (`playlistSongId`, `pId`, `sId`) VALUES
(4, 5, 13),
(5, 4, 2),
(8, 8, 20),
(9, 8, 24),
(10, 8, 19),
(11, 4, 7),
(12, 4, 26);

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE `songs` (
  `sId` int(3) NOT NULL,
  `uId` int(3) NOT NULL,
  `sSong` text NOT NULL,
  `sTitle` varchar(256) NOT NULL,
  `sArtist` varchar(256) NOT NULL,
  `sImage` text NOT NULL,
  `sSource` text NOT NULL,
  `sDescription` varchar(256) NOT NULL,
  `sDuration` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`sId`, `uId`, `sSong`, `sTitle`, `sArtist`, `sImage`, `sSource`, `sDescription`, `sDuration`) VALUES
(2, 11, 'songs/DS_Fizzer140C-05.mp3', 'Pehli Bar', 'Sanam', 'songImages/song1.png', 'yt', 'Nice Song', '3min'),
(3, 11, 'songs/DS_BassB140D-01.mp3', 'Faded', 'Arijit', 'songImages/song3.jpeg', 'yt', 'Nice Song', '3min'),
(7, 11, 'songs/DS_Fizzer140C-05.mp3', 'Love me like you do', 'Atif', 'songImages/song2.jpeg', 'unknown', 'Nice Song', '30sec'),
(10, 11, 'songs/DS_Fizzer140C-05.mp3', 'Tum hi ho', 'Raj', 'songImages/song2.jpeg', 'hfghf', 'hghfh', 'hfh'),
(11, 11, 'songs/DS_Fizzer140C-05.mp3', 'Pehli nazar', '', 'songImages/song1.png', 'hh', 'hgh', 'ghfh'),
(14, 1, '../admin/songs/DS_Fizzer140C-05.mp3', 'Khabb', 'Arijit', '../admin/songImages/song1.png', 'FF', 'FDFDF', '2MIN'),
(16, 1, '../admin/songs/DS_DubPad145G-01.mp3', 'Lag ja gale', 'None', '../admin/songImages/Screenshot from 2019-03-13 20-15-17.png', 'fsdf', 'fsdff', 'ff'),
(19, 31, '../admin/songs/AUD-20190122-WA0021.mp3', 'Inch', 'Various', '../admin/songImages/Screenshot_20190308-093817.jpg', 'My own', 'Abc', '9'),
(20, 31, '../admin/songs/Koun hai wo 1.mp3', 'Kon hai wo', 'Various', '../admin/songImages/IMG-20181021-WA0001.jpg', 'My own', 'My second song', '1'),
(24, 31, '../admin/songs/Edit-Sanzone.mp3', 'Sanzone', 'None', '../admin/songImages/song3.jpeg', 'none', 'Nice one', '3min'),
(26, 1, '../admin/songs/DS_BassB140D-01.mp3', 'Tum hi ho', 'Arijit', '../admin/songImages/Screenshot from 2019-03-13 20-15-27.png', 'yt', 'nice song', '3min');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uId` int(3) NOT NULL,
  `uFirstName` varchar(256) NOT NULL,
  `uLastName` varchar(256) NOT NULL,
  `uDisplayName` varchar(256) NOT NULL,
  `isBlocked` tinyint(1) NOT NULL DEFAULT '0',
  `uEmail` varchar(256) NOT NULL,
  `uPassword` varchar(256) NOT NULL,
  `uProfilePic` text NOT NULL,
  `role` varchar(256) NOT NULL DEFAULT 'user',
  `uDateOfReg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `token` varchar(256) NOT NULL,
  `tokenValid` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uId`, `uFirstName`, `uLastName`, `uDisplayName`, `isBlocked`, `uEmail`, `uPassword`, `uProfilePic`, `role`, `uDateOfReg`, `token`, `tokenValid`) VALUES
(1, 'Vivek', 'Gohel', 'Raj', 0, 'bhavikkalariya103@gmail.com', '1234', 'userImages/Screenshot from 2019-03-13 20-15-53.png', 'user', '2019-04-03 11:53:41', 'af23890fb503946d3fb888e6b53a36ad', 0),
(11, 'Bhavik', 'Kalariya', 'Bhavik', 0, 'admin@gmail.com', 'admin', 'userImages/Screenshot from 2019-03-13 20-15-53.png', 'admin', '2019-04-03 11:53:41', '', 1),
(20, 'Dixit', 'Patel', 'Dixit', 1, 'rajgohel0001@gmail.com', '123', 'userImages/Screenshot from 2019-03-13 20-15-39.png', 'user', '2019-04-04 06:16:31', '31a78d234827ec82b4bcf66c8ad4baa3', 1),
(21, 'Vishal', 'Pankhania', 'Vishal', 1, 'fgggfg@fddgfgf.gg', 'bhavik10', 'userImages/Screenshot from 2019-03-13 20-15-53.png', 'user', '2019-04-03 11:53:41', '', 1),
(23, 'Swati', 'Chauhan', 'Swati', 0, 'a@gmail.com', '123', 'userImages/Screenshot from 2019-03-13 20-15-39.png', 'user', '2019-04-04 06:16:31', '', 1),
(24, 'Vishal', 'Pankhania', 'Vishal', 0, 'bhavikkalsdfffariya103@gmail.com', 'bhavik10', 'userImages/Screenshot from 2019-03-13 20-15-53.png', 'user', '2019-04-03 11:53:41', '', 1),
(26, 'Happy', 'Bhalodia', 'Happy', 0, 'a@gmail.com', '123', 'userImages/Screenshot from 2019-03-13 20-15-39.png', 'user', '2019-04-04 06:16:31', '', 1),
(29, 'Vivek', 'Malvi', 'Vivek', 0, 'a@gmail.com', '123', 'userImages/Screenshot from 2019-03-13 20-15-39.png', 'user', '2019-04-04 06:16:31', '', 1),
(31, 'Mehul', 'Bhatt', 'Mehul', 0, 'mehul.2287884@gmail.com', 'mehul', 'userImages/IMG-20181109-WA0000.jpg', 'user', '2019-04-08 13:59:13', '', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cId`);

--
-- Indexes for table `catSongs`
--
ALTER TABLE `catSongs`
  ADD PRIMARY KEY (`catSongId`),
  ADD KEY `sId` (`sId`),
  ADD KEY `cId` (`cId`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentId`),
  ADD KEY `sId` (`sId`),
  ADD KEY `uId` (`uId`);

--
-- Indexes for table `favUnfav`
--
ALTER TABLE `favUnfav`
  ADD PRIMARY KEY (`fuId`),
  ADD KEY `pId` (`pId`),
  ADD KEY `uId` (`uId`);

--
-- Indexes for table `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`pId`),
  ADD KEY `uId` (`uId`);

--
-- Indexes for table `playlistSong`
--
ALTER TABLE `playlistSong`
  ADD PRIMARY KEY (`playlistSongId`),
  ADD KEY `sId` (`sId`),
  ADD KEY `pId` (`pId`);

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`sId`),
  ADD KEY `songs_ibfk_1` (`uId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cId` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `catSongs`
--
ALTER TABLE `catSongs`
  MODIFY `catSongId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `favUnfav`
--
ALTER TABLE `favUnfav`
  MODIFY `fuId` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `playlist`
--
ALTER TABLE `playlist`
  MODIFY `pId` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `playlistSong`
--
ALTER TABLE `playlistSong`
  MODIFY `playlistSongId` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `songs`
--
ALTER TABLE `songs`
  MODIFY `sId` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uId` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `catSongs`
--
ALTER TABLE `catSongs`
  ADD CONSTRAINT `catSongs_ibfk_1` FOREIGN KEY (`sId`) REFERENCES `songs` (`sId`),
  ADD CONSTRAINT `catSongs_ibfk_2` FOREIGN KEY (`cId`) REFERENCES `category` (`cId`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`sId`) REFERENCES `songs` (`sId`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`uId`) REFERENCES `users` (`uId`);

--
-- Constraints for table `favUnfav`
--
ALTER TABLE `favUnfav`
  ADD CONSTRAINT `favUnfav_ibfk_2` FOREIGN KEY (`pId`) REFERENCES `playlist` (`pId`),
  ADD CONSTRAINT `favUnfav_ibfk_3` FOREIGN KEY (`uId`) REFERENCES `users` (`uId`);

--
-- Constraints for table `playlist`
--
ALTER TABLE `playlist`
  ADD CONSTRAINT `playlist_ibfk_1` FOREIGN KEY (`uId`) REFERENCES `users` (`uId`);

--
-- Constraints for table `playlistSong`
--
ALTER TABLE `playlistSong`
  ADD CONSTRAINT `playlistSong_ibfk_1` FOREIGN KEY (`pId`) REFERENCES `playlist` (`pId`);

--
-- Constraints for table `songs`
--
ALTER TABLE `songs`
  ADD CONSTRAINT `songs_ibfk_1` FOREIGN KEY (`uId`) REFERENCES `users` (`uId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
