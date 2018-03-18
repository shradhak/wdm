-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2016 at 04:19 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cheapbook`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `ssn` int(9) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`ssn`, `name`, `address`, `phone`) VALUES
(12357898, 'Adam Shook', 'Arlington', 2147483647),
(75857896, 'Tom White', 'Mumbai', 123456),
(84845615, 'Dean Wampler', 'Dallas', 1238426262),
(89486166, 'Holden Karau', 'New York', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `ISBN` int(13) NOT NULL,
  `title` varchar(45) DEFAULT NULL,
  `year` date DEFAULT NULL,
  `price` decimal(6,2) DEFAULT NULL,
  `publisher` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`ISBN`, `title`, `year`, `price`, `publisher`) VALUES
(21474, 'Learning Spark: Lightning-Fast Big Data Analy', '2016-02-06', '470.25', 'ORELLY'),
(43131, 'Mapreduce Design Patterns', '2016-02-28', '222.25', 'SHROFF'),
(44564, 'Programming Hive', '2016-02-06', '490.00', 'SHROFF'),
(125485549, 'Hadoop: The Definitive Guide ', '2014-08-09', '255.55', 'DreamTech Press');

-- --------------------------------------------------------

--
-- Table structure for table `contains`
--

CREATE TABLE `contains` (
  `isbn` varchar(20) DEFAULT NULL,
  `basketid` varchar(13) DEFAULT NULL,
  `number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contains`
--

INSERT INTO `contains` (`isbn`, `basketid`, `number`) VALUES
('125485549', '78', 2),
('21474', '79', 2);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `username` varchar(10) NOT NULL,
  `password` varchar(32) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`username`, `password`, `address`, `phone`, `email`) VALUES
('arya', '5882985c8b1e2dce2763072d56a1d6e5', 'Irving', '66997', 'aray@g.com'),
('jon', '006cb570acdab0e0bfc8e3dcb7bb4edf', 'north', '57856', 'jon@g.com'),
('ron', '45798f269709550d6f6e1d2cf4b7d485', 'forthworth', '87549', 'ron@g.com'),
('sam', '332532dcfaa1cbf61e2a266bd723612c', 'sam', '58', 'sa@m.com');

-- --------------------------------------------------------

--
-- Table structure for table `shippingorder`
--

CREATE TABLE `shippingorder` (
  `isbn` varchar(20) DEFAULT NULL,
  `warehousecode` varchar(20) DEFAULT NULL,
  `username` varchar(10) DEFAULT NULL,
  `number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shippingorder`
--

INSERT INTO `shippingorder` (`isbn`, `warehousecode`, `username`, `number`) VALUES
('125485549', '4', 'jon', 2),
('21474', '1', 'jon', 2),
('21474', '3', 'jon', 2),
('21474', '1', 'jon', 2),
('21474', '3', 'jon', 2);

-- --------------------------------------------------------

--
-- Table structure for table `shoppingbasket`
--

CREATE TABLE `shoppingbasket` (
  `basketId` int(11) NOT NULL,
  `username` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shoppingbasket`
--

INSERT INTO `shoppingbasket` (`basketId`, `username`) VALUES
(78, 'jon'),
(79, 'jon'),
(80, 'arya');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `ISBN` int(13) DEFAULT NULL,
  `warehouseCode` int(11) DEFAULT NULL,
  `number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`ISBN`, `warehouseCode`, `number`) VALUES
(21474, 1, 6),
(43131, 2, 12),
(44564, 3, 9),
(125485549, 4, 11),
(21474, 3, 9);

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE `warehouse` (
  `warehouseCode` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `warehouse`
--

INSERT INTO `warehouse` (`warehouseCode`, `name`, `address`, `phone`) VALUES
(1, 'Central India', 'Mumbai', 1245789535),
(2, 'US ', 'NewYork', 1247854636),
(3, 'South US', 'Dallas', 1245789534),
(4, 'UK', 'London', 1245789532);

-- --------------------------------------------------------

--
-- Table structure for table `writtenby`
--

CREATE TABLE `writtenby` (
  `ssn` int(9) NOT NULL,
  `ISBN` int(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `writtenby`
--

INSERT INTO `writtenby` (`ssn`, `ISBN`) VALUES
(12357898, 21474),
(75857896, 43131),
(84845615, 44564),
(89486166, 125485549);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`ssn`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`ISBN`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `shoppingbasket`
--
ALTER TABLE `shoppingbasket`
  ADD PRIMARY KEY (`basketId`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD KEY `warehouseCode_idx` (`warehouseCode`),
  ADD KEY `Stocks.ISBN` (`ISBN`);

--
-- Indexes for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`warehouseCode`);

--
-- Indexes for table `writtenby`
--
ALTER TABLE `writtenby`
  ADD PRIMARY KEY (`ssn`),
  ADD KEY `ISBN_idx` (`ISBN`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `shoppingbasket`
--
ALTER TABLE `shoppingbasket`
  MODIFY `basketId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `Stocks.ISBN` FOREIGN KEY (`ISBN`) REFERENCES `book` (`ISBN`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Stocks.warehouseCode` FOREIGN KEY (`warehouseCode`) REFERENCES `warehouse` (`warehouseCode`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `writtenby`
--
ALTER TABLE `writtenby`
  ADD CONSTRAINT `ISBN` FOREIGN KEY (`ISBN`) REFERENCES `book` (`ISBN`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `ssn` FOREIGN KEY (`ssn`) REFERENCES `author` (`ssn`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
