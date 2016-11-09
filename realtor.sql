-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Nov 09, 2016 at 10:41 PM
-- Server version: 5.5.49-log
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `realtor`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `username` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Login Info ';

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE IF NOT EXISTS `orderitems` (
  `orderid` int(11) NOT NULL,
  `propertyid` int(11) NOT NULL,
  `sellingprice` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='order item table';

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `orderid` int(11) NOT NULL,
  `userid` varchar(50) NOT NULL,
  `cost` float NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='order information for the user';

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE IF NOT EXISTS `property` (
  `propertyId` int(11) NOT NULL,
  `isapt` tinyint(1) NOT NULL,
  `aptno` varchar(10) NOT NULL,
  `street` varchar(100) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(2) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `sqft` int(11) NOT NULL,
  `bhk` int(11) NOT NULL,
  `bath` float NOT NULL,
  `isavailable` tinyint(1) NOT NULL,
  `isdeleted` tinyint(1) NOT NULL,
  `price` float NOT NULL,
  `image` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='property information';

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`propertyId`, `isapt`, `aptno`, `street`, `city`, `state`, `zipcode`, `sqft`, `bhk`, `bath`, `isavailable`, `isdeleted`, `price`, `image`) VALUES
(1, 1, '123', '7650 Mccallum Blvd', 'Dallas', 'TX', '75252', 123, 3, 2, 1, 0, 30000, '1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE IF NOT EXISTS `userinfo` (
  `userid` varchar(50) NOT NULL,
  `isadmin` tinyint(1) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `city` varchar(20) NOT NULL,
  `contactno` varchar(15) NOT NULL,
  `isactive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='User Info from signup ';

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE IF NOT EXISTS `wishlist` (
  `userid` varchar(50) NOT NULL,
  `propertyid` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='wishlist info for user';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`orderid`,`propertyid`),
  ADD KEY `propertyid` (`propertyid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`userid`,`orderid`);

--
-- Indexes for table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`propertyId`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`propertyid`,`userid`),
  ADD KEY `userid` (`userid`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`username`) REFERENCES `userinfo` (`userid`);

--
-- Constraints for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD CONSTRAINT `orderitems_ibfk_1` FOREIGN KEY (`propertyid`) REFERENCES `property` (`propertyId`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `userinfo` (`userid`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `userinfo` (`userid`),
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`propertyid`) REFERENCES `property` (`propertyId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
