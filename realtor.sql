-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Dec 04, 2016 at 04:57 AM
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
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Login Info ';

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`) VALUES
('admin12@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
('mxk1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
('testUser@realtor.com', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE IF NOT EXISTS `orderitems` (
  `orderid` int(11) NOT NULL,
  `propertyid` int(11) NOT NULL,
  `sellingprice` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='order item table';

--
-- Dumping data for table `orderitems`
--

INSERT INTO `orderitems` (`orderid`, `propertyid`, `sellingprice`) VALUES
(1, 4, 450000);

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

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderid`, `userid`, `cost`, `timestamp`) VALUES
(1, 'mxk1@gmail.com', 450000, '2016-12-04 04:44:06');

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
(1, 0, '123', '7650 Mccallum Blvd', 'Dallas', 'TX', '75252', 123, 3, 2, 1, 0, 300000, '1.jpg'),
(2, 1, '1501', '7740 Coit Road', 'Dallas', 'TX', '75252', 2300, 2, 2, 1, 0, 200000, '2.jpg'),
(3, 1, '145', '7730 xyz Rd', 'LewisVille', 'TX', '75689', 750, 1, 1, 1, 0, 125000, '3.jpg'),
(4, 0, '123', 'JohnConnally', 'Houston', 'TX', '75006', 2300, 3, 3, 0, 0, 450000, '4.jpg'),
(5, 0, '6789', '1600 Metrocrest Drive', 'Carroltton', 'TX', '75006', 2300, 2, 2, 1, 0, 340000, '5.jpg'),
(6, 1, '456', '7890 Waterview pkwy', 'Houston', 'TX', '34567', 2300, 3, 3, 1, 0, 230000, '6.jpg'),
(7, 1, '1256', 'Koppal St', 'Koppal', 'TX', '75001', 178, 2, 2, 1, 0, 700000, '7.jpg'),
(8, 1, '9034', 'Arapaho Rd', 'Austin', 'TX', '10006', 3500, 4, 3, 1, 0, 300000, '8.jpg'),
(9, 0, '0', 'RockerFeller st', 'Austin', 'TX', '678934', 3000, 2, 2, 1, 0, 120000, '9.jpg'),
(10, 0, '0', '800W Campbell Road', 'Dallas', 'TX', '75080', 800, 2, 2, 1, 0, 340000, '10.jpg'),
(11, 1, '1501', 'North Lamar St', 'Austin', 'TX', '89023', 900, 2, 2, 1, 0, 250000, '11.jpg'),
(12, 1, '2389', 'Ashwood Park', 'Kentucky', 'MD', '75252', 2000, 3, 3, 1, 0, 500000, '12.jpg'),
(13, 1, '890', 'Stormont Circle', 'Baltimore', 'MD', '34567', 1300, 3, 3, 1, 0, 340000, '13.jpg'),
(14, 1, '876', 'Lamar st', 'NewYork', 'NY', '456789', 2300, 3, 2, 1, 0, 340000, '14.jpg');

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

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`userid`, `isadmin`, `firstname`, `lastname`, `dob`, `city`, `contactno`, `isactive`) VALUES
('admin12@gmail.com', 1, 'admintest', 'test', '1991-06-01', 'Dallas', '4696643541', 1),
('mxk1@gmail.com', 0, 'test', 'xyz', '1991-06-01', 'Dallas', '9724977860', 1),
('testUser@realtor.com', 0, 'testUser', 'Normal', '1991-06-01', 'Austin', '4696643541', 1);

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
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`userid`, `propertyid`, `timestamp`) VALUES
('mxk1@gmail.com', 3, '2016-12-04 04:45:07'),
('mxk1@gmail.com', 4, '2016-12-03 04:34:45');

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
  ADD KEY `propertyid` (`propertyid`),
  ADD KEY `orderid` (`orderid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`userid`,`orderid`),
  ADD KEY `orderid` (`orderid`),
  ADD KEY `orderid_2` (`orderid`);

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
  ADD CONSTRAINT `orderitems_ibfk_1` FOREIGN KEY (`propertyid`) REFERENCES `property` (`propertyId`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`orderid`) REFERENCES `orders` (`orderid`);

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
