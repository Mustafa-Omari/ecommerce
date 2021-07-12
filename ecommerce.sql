-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2021 at 06:54 PM
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
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Parent` int(11) NOT NULL,
  `Ordering` int(11) DEFAULT NULL,
  `Visiblity` tinyint(4) NOT NULL DEFAULT 0,
  `Allow_Comment` tinyint(4) NOT NULL DEFAULT 0,
  `Allow_Ads` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`ID`, `Name`, `Description`, `Parent`, `Ordering`, `Visiblity`, `Allow_Comment`, `Allow_Ads`) VALUES
(14, 'Hand Made', 'Hand Made Items', 0, 1, 1, 1, 1),
(15, 'Computers', 'Computers Items', 0, 2, 0, 0, 0),
(16, 'Cell Phones', 'Cell Phones', 0, 3, 0, 0, 0),
(17, 'Clothes', 'Clothes And Fashion', 0, 4, 0, 0, 0),
(21, 'Cars', 'Cars', 0, 5, 0, 0, 0),
(22, 'Huwaie', 'Huawie Phones', 16, 1, 0, 0, 0),
(24, 'Toyota', 'Toyta Cars', 21, 1, 0, 0, 0),
(25, 'Boxes', 'Boxes Hand Made ', 14, 1, 0, 0, 0),
(26, 'Iphone Phones ', 'Iphone Phones', 16, 2, 0, 0, 0),
(27, 'Games ', 'Games To Computers', 15, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `Comm_ID` int(11) NOT NULL,
  `Comment` text NOT NULL,
  `Status` tinyint(4) NOT NULL,
  `Comm_Date` date NOT NULL,
  `Item_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`Comm_ID`, `Comment`, `Status`, `Comm_Date`, `Item_ID`, `User_ID`) VALUES
(15, 'Very Nice', 1, '2020-12-16', 25, 15),
(16, 'Nice Item Thanks So Much ', 0, '2020-12-16', 23, 15),
(17, 'Nice Sound ', 0, '2020-12-24', 22, 12),
(19, 'Nice Camera ', 0, '2020-12-24', 24, 9),
(20, 'The Bettery Stay Along Time ', 0, '2020-12-24', 24, 9),
(21, 'Nice Cammera ', 0, '2020-12-25', 24, 9),
(28, 'Zagoga7', 1, '2020-12-25', 24, 9),
(30, 'Fast Send Data ', 0, '2020-12-25', 26, 3),
(31, 'Faster Capel ', 1, '2020-12-25', 26, 15),
(32, 'Very Nice This Is  Second Comment ', 1, '2020-12-25', 26, 15),
(35, 'This Is Third Comment ', 1, '2020-12-25', 26, 8),
(36, 'I Like This ', 1, '2020-12-25', 26, 15),
(37, 'Nice Sound ', 0, '2020-12-30', 22, 29),
(38, 'nice car ', 0, '2021-01-18', 40, 29),
(39, 'Nice Jacket ', 0, '2021-06-06', 44, 1);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `Item_ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Price` varchar(255) NOT NULL,
  `Add_Date` date NOT NULL,
  `Country_Made` varchar(255) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `Status` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `Rating` smallint(6) NOT NULL,
  `Approve` tinyint(4) NOT NULL DEFAULT 0,
  `Cat_ID` int(11) NOT NULL,
  `Member_ID` int(11) NOT NULL,
  `Tags` varchar(255) NOT NULL,
  `Avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`Item_ID`, `Name`, `Description`, `Price`, `Add_Date`, `Country_Made`, `Image`, `Status`, `Rating`, `Approve`, `Cat_ID`, `Member_ID`, `Tags`, `Avatar`) VALUES
(22, 'Speaker', 'Very Good Speaker', '10', '2020-12-18', 'China', '', '1', 0, 1, 15, 12, '', ''),
(23, 'Yeti Blue Microphone', 'Very Good Microphone Very Good Microphone', '50', '2020-12-18', 'USA', '', '2', 0, 0, 15, 15, '', ''),
(24, 'P40 Pro', 'Huwaei  P40 Pro', '400', '2020-12-18', 'China', '', '3', 0, 1, 16, 9, '', ''),
(25, 'Magic Mouse', 'Apple Magic Mouse', '100', '2020-12-18', 'USA', '', '1', 0, 1, 15, 15, '', ''),
(26, 'Network Capel', 'Cat 9 Network Capel', '100', '2020-12-18', 'USA', '', '1', 0, 1, 15, 3, '', ''),
(27, 'Game', 'Test Game ', '100', '2020-12-23', 'Jordan', '', '1', 0, 1, 15, 15, '', ''),
(28, 'Huwaei Mate 30 Pro', 'Nice Camera ', '300', '2020-12-23', 'China', '', '2', 0, 1, 16, 15, '', ''),
(31, 'Box For Items', 'Amazing Box ', '75', '2020-12-26', 'Jordan', '', '1', 0, 1, 14, 15, '', ''),
(33, 'Jaket', 'Nice Jaket In Could Winter', '30', '2020-12-27', 'Jordan', '', '1', 0, 1, 17, 15, '', ''),
(36, 'Bracelet', 'Accessories For Hand', '9', '2020-12-27', 'Jordan', '', '1', 0, 1, 14, 15, 'Accessories , Bracelet ,Hand ', ''),
(37, 'Iron Game ', 'Iron Man Game ', '30', '2020-12-29', 'Jordan', '', '1', 0, 1, 14, 12, 'Iron , Game , Hand , children', ''),
(38, 'Diablo III', 'Good Computer Game ', '50', '2020-12-29', 'USA', '', '1', 0, 1, 27, 15, 'RPG , Game , Online', ''),
(39, 'Ys Oath In Felghana', 'Good Ps Game ', '19', '2020-12-29', 'Japan', '', '1', 0, 1, 27, 15, 'RPG ,  Online ,Game ', ''),
(40, 'Prius 2020', 'Amazing Car ', '20000', '2021-01-01', 'Japan', '', '1', 0, 1, 24, 29, 'Car , hybridCars ', '328597190_prius.jpg'),
(41, 'Toyota Camry 2020 ', 'Amazing Sport Car ', '22000', '2021-01-01', 'Japan', '', '1', 0, 1, 24, 12, 'Car , hybridCars  , SportCar', '11219521_camry.jpg'),
(43, 'Computer ', 'Amazing Computer ', '1000', '2021-01-01', 'USA', '', '1', 0, 1, 15, 35, 'computer , Gaming  ', '722166280_computer.jpg'),
(44, 'Jacket', 'Amazing Jacket', '20', '2021-01-10', 'Jordan', '', '1', 0, 1, 17, 29, 'Jacket, clothes ', '732861315_jacket.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL COMMENT 'To Identify User',
  `Username` varchar(255) NOT NULL COMMENT 'Username To Login',
  `Password` varchar(255) NOT NULL COMMENT 'Password To Login ',
  `Email` varchar(255) NOT NULL,
  `Fullname` varchar(255) NOT NULL,
  `GroupID` int(11) NOT NULL DEFAULT 0 COMMENT 'Identify User Group',
  `TrustStatus` int(11) NOT NULL DEFAULT 0 COMMENT 'Seller Rank ',
  `RegStatus` int(11) NOT NULL DEFAULT 0 COMMENT 'User Approval ',
  `Date` date NOT NULL,
  `Avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Password`, `Email`, `Fullname`, `GroupID`, `TrustStatus`, `RegStatus`, `Date`, `Avatar`) VALUES
(1, 'Mustafa', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'mostomari16@gmail.com', 'Mustafa Omari', 1, 0, 1, '2020-11-18', ''),
(3, 'Omar', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'omar@omari.com', 'Omar Omari', 1, 0, 1, '2020-12-01', ''),
(8, 'Hind', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'hind@hind.com', 'Hind Ahmed ', 0, 0, 1, '2020-12-07', ''),
(9, 'Lojain ', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'lojain@lojain.com', 'Lojain Rami', 0, 0, 1, '2020-12-06', ''),
(12, 'Zeed', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'zeed@zeed.com', 'Zeed Talafha', 0, 0, 1, '2020-12-07', ''),
(15, 'Lara', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'lara@lara.com', 'Lara Ahmed ', 0, 0, 0, '2020-12-07', ''),
(20, 'Last', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'l@l.com', 'Last', 0, 0, 0, '2020-12-17', ''),
(21, 'root', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Amera@amera.com', '', 0, 0, 0, '2020-12-21', ''),
(25, 'zaki', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'zaki@zaki.com', '', 0, 0, 0, '2020-12-21', ''),
(26, 'roro', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'roro@roro.com', '', 0, 0, 0, '2020-12-21', ''),
(28, 'Samera', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'samera@samera.com', 'Samera Ahmad', 0, 0, 1, '2020-12-30', '477151858_WhatsApp Image 2020-12-10 at 10.59.02 AM.jpeg'),
(29, 'Abdallah', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'abd@abd.com', 'Abdallah Omari', 0, 0, 1, '2020-12-30', '709652650_avatar.png'),
(30, 'Amera', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Amera@amera.com', 'Amera El Amera', 0, 0, 0, '2020-12-31', ''),
(31, 'asfasfasfas', 'c961184ceb88d46cdb7ec142cb741278740aa114', 'asdasd@sad.com', 'asfas', 0, 0, 1, '2020-12-31', '611476078_WhatsApp Image 2020-12-10 at 10.59.02 AM.jpeg'),
(34, 'Lolo', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'lolo@lolo.com', 'Lolo Ahmad', 0, 0, 0, '2020-12-31', '410671320_IMG_5258.JPG'),
(35, 'jamal', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'jamal@jamal.com', 'Jamal ahmad', 0, 0, 0, '2021-01-01', '570120794_avatar.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`Comm_ID`),
  ADD KEY `items_comment` (`Item_ID`),
  ADD KEY `users_comment` (`User_ID`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`Item_ID`),
  ADD KEY `mebmer_1` (`Member_ID`),
  ADD KEY `cat_1` (`Cat_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `Comm_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `Item_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'To Identify User', AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `items_comment` FOREIGN KEY (`item_id`) REFERENCES `items` (`Item_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_comment` FOREIGN KEY (`user_id`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `cat_1` FOREIGN KEY (`Cat_ID`) REFERENCES `categories` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mebmer_1` FOREIGN KEY (`Member_ID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
