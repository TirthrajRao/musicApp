-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 06, 2019 at 07:32 PM
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
(7, 'Sad', 'This is for sad category', 'categoryImages/sad.jpeg'),
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
(11, 10, 8);

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
(9, 1, 3),
(12, 1, 5);

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
(5, 29, 'user2', 'nice #nice #good');

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
(2, 3, 6),
(3, 4, 12),
(4, 5, 13),
(5, 5, 2),
(6, 5, 3);

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
(2, 11, 'songs/DS_Fizzer140C-05.mp3', 'advanced snog', 'Sample Artist', 'songImages/song1.png', 'yt', 'Nice Song', '3min'),
(3, 11, 'songs/DS_BassB140D-01.mp3', 'UPDATED sONG', 'Sample Artist', 'songImages/song3.jpeg', 'yt', 'Nice Song', '3min'),
(7, 11, 'songs/DS_Fizzer140C-05.mp3', 'song2U', 'Vishal', 'songImages/song2.jpeg', 'unknown', 'Nice Song', '30sec'),
(10, 11, 'songs/DS_Fizzer140C-05.mp3', 'jhghg', 'hghgh', 'songImages/song2.jpeg', 'hfghf', 'hghfh', 'hfh'),
(11, 11, 'songs/DS_Fizzer140C-05.mp3', 'ghnhnh', 'nnn', 'songImages/song1.png', 'hh', 'hgh', 'ghfh'),
(13, 29, '../admin/songs/DS_Fizzer140C-05.mp3', 'new', 'me', '../admin/songImages/song3.jpeg', 'yt', 'nice', '2min'),
(14, 1, '../admin/songs/DS_Fizzer140C-05.mp3', 'SDFDF', 'DFDFF', '../admin/songImages/song1.png', 'FF', 'FDFDF', '2MIN'),
(15, 1, '../admin/songs/DS_Fizzer140C-05.mp3', 'FSSDF', 'FFDF', '../admin/songImages/song1.png', 'FSDF', 'FD', 'SDFDF');

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
  `uDateOfReg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uId`, `uFirstName`, `uLastName`, `uDisplayName`, `isBlocked`, `uEmail`, `uPassword`, `uProfilePic`, `role`, `uDateOfReg`) VALUES
(1, 'Bhavik', 'Kalariya', '#beMusical', 0, 'bhavikkalariya103@gmail.com', 'bhavik10', 'userImages/Screenshot from 2019-03-13 20-15-53.png', 'user', '2019-04-03 11:53:41'),
(11, 'Bhavik', 'Kalariya', 'Bhavik', 0, 'admin@gmail.com', 'admin', 'userImages/Screenshot from 2019-03-13 20-15-53.png', 'admin', '2019-04-03 11:53:41'),
(20, 'ggghg', 'gg', 'displayname', 1, 'a@gmail.com', '123', 'userImages/Screenshot from 2019-03-13 20-15-39.png', 'user', '2019-04-04 06:16:31'),
(21, 'Vishal', 'Pankhania', 'Vishal', 0, 'fgggfg@fddgfgf.gg', 'bhavik10', 'userImages/Screenshot from 2019-03-13 20-15-53.png', 'user', '2019-04-03 11:53:41'),
(22, 'Bhavik', 'Kalariya', 'Bhavik', 0, 'admin@gmail.com', 'admin', 'userImages/Screenshot from 2019-03-13 20-15-53.png', 'admin', '2019-04-03 11:53:41'),
(23, 'ggghg', 'gg', 'displayname', 0, 'a@gmail.com', '123', 'userImages/Screenshot from 2019-03-13 20-15-39.png', 'user', '2019-04-04 06:16:31'),
(24, 'Vishal', 'Pankhania', 'Vishal', 0, 'bhavikkalsdfffariya103@gmail.com', 'bhavik10', 'userImages/Screenshot from 2019-03-13 20-15-53.png', 'user', '2019-04-03 11:53:41'),
(26, 'ggghg', 'gg', 'displayname', 0, 'a@gmail.com', '123', 'userImages/Screenshot from 2019-03-13 20-15-39.png', 'user', '2019-04-04 06:16:31'),
(29, 'ggghg', 'gg', 'displayname', 0, 'a@gmail.com', '123', 'userImages/Screenshot from 2019-03-13 20-15-39.png', 'user', '2019-04-04 06:16:31');

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
  MODIFY `cId` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `catSongs`
--
ALTER TABLE `catSongs`
  MODIFY `catSongId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `favUnfav`
--
ALTER TABLE `favUnfav`
  MODIFY `fuId` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `playlist`
--
ALTER TABLE `playlist`
  MODIFY `pId` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `playlistSong`
--
ALTER TABLE `playlistSong`
  MODIFY `playlistSongId` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `songs`
--
ALTER TABLE `songs`
  MODIFY `sId` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uId` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
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
