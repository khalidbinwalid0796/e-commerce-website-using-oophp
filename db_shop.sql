-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2021 at 04:43 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `adminId` int(11) NOT NULL,
  `adminName` varchar(255) NOT NULL,
  `adminUser` varchar(255) NOT NULL,
  `adminEmail` varchar(255) NOT NULL,
  `adminPass` varchar(32) NOT NULL,
  `level` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`adminId`, `adminName`, `adminUser`, `adminEmail`, `adminPass`, `level`) VALUES
(2, 'Khalid Bin Walid', 'khalid', 'khalidbucse02@gmail.com', '25d55ad283aa400af464c76d713c07ad', 0),
(3, 'Rony', 'Rony', 'rony@gmail.com', '202cb962ac59075b964b07152d234b70', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `brandId` int(11) NOT NULL,
  `brandName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`brandId`, `brandName`) VALUES
(1, 'IPHONE'),
(2, 'SAMSUNG'),
(3, 'ACER'),
(4, 'CANON');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cartId` int(11) NOT NULL,
  `sId` varchar(255) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` float(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `catId` int(11) NOT NULL,
  `catName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`catId`, `catName`) VALUES
(1, 'Mobile Phones'),
(2, 'Desktop'),
(3, 'Laptop'),
(4, 'Accessories'),
(5, 'Software'),
(6, 'Sports &amp; Fitness'),
(7, 'Footwear'),
(8, 'Jewellery'),
(10, 'Clothing');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_compare`
--

CREATE TABLE `tbl_compare` (
  `id` int(11) NOT NULL,
  `cmrId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` float(10,2) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `zip` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `name`, `address`, `city`, `country`, `zip`, `phone`, `email`, `pass`) VALUES
(3, 'khalid', 'Rupatoly', 'Barishal', 'Bangladesh', '1000', '0171065988', 'khalidbucse02@gmail.com', '25d55ad283aa400af464c76d713c07ad'),
(4, 'Rony', 'Rupatoly', 'Barishal', 'Bangladesh', '1000', '0171065988', 'rony@gmail.com', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(11) NOT NULL,
  `cmrId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `cmrId`, `productId`, `productName`, `quantity`, `price`, `image`, `date`, `status`) VALUES
(72, 3, 10, 'HP', 1, 900.00, 'upload/5fa019938a.jpg', '2020-03-02 11:26:32', 2),
(73, 3, 8, 'Freeze', 1, 300.00, 'upload/b021d2e6b7.png', '2020-03-02 11:26:32', 2),
(76, 3, 10, 'HP', 1, 900.00, 'upload/5fa019938a.jpg', '2020-04-14 10:16:31', 2),
(77, 3, 9, 'Iphone6', 1, 200.00, 'upload/828b99d248.png', '2021-01-12 19:03:47', 2),
(78, 3, 12, 'Iron Machine', 5, 10000.00, 'upload/273dc41622.png', '2021-01-12 22:09:19', 2),
(79, 3, 9, 'Iphone6', 5, 1000.00, 'upload/828b99d248.png', '2021-01-12 22:09:19', 2),
(80, 3, 12, 'Iron Machine', 4, 8000.00, 'upload/273dc41622.png', '2021-01-12 22:10:16', 2),
(81, 3, 11, 'Samsung A50', 3, 63000.00, 'upload/9b88243a29.jpg', '2021-01-12 22:10:16', 2),
(82, 3, 12, 'Iron Machine', 1, 2000.00, 'upload/273dc41622.png', '2021-01-12 22:36:22', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `catId` int(11) NOT NULL,
  `brandId` int(11) NOT NULL,
  `body` text NOT NULL,
  `price` float(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`productId`, `productName`, `catId`, `brandId`, `body`, `price`, `image`, `type`) VALUES
(1, 'Box', 4, 3, '<p><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></p>\r\n<p><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></p>\r\n<p><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></p>', 500.22, 'upload/b50f715503.jpg', 0),
(3, 'Fan', 4, 3, '<p><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span></p>', 3444.00, 'upload/eca32f3ea5.jpg', 0),
(5, 'Blendar', 4, 4, '<p><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit.<span>Lorem ipsum dolor sit amet, consectetur adipisicing elit.<span>Lorem ipsum dolor sit amet, consectetur adipisicing elit.<span>Lorem ipsum dolor sit amet, consectetur adipisicing elit.<span>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></span></span></span></span></p>', 500.22, 'upload/7c2a8007fd.png', 0),
(7, 'Core-5', 2, 2, '<p>Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.</p>', 500.22, 'upload/479845be82.jpg', 0),
(8, 'Freeze', 4, 4, '<p>Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simplyLorem Ipsum is simplyLorem Ipsum is simplyLorem Ipsum is simplyLorem Ipsum is simplyLorem Ipsum is simplyLorem Ipsum is simplyLorem Ipsum is simplyLorem Ipsum is simply.</p>', 300.00, 'upload/b021d2e6b7.png', 1),
(9, 'Iphone6', 1, 1, '<p>Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.v.Lorem Ipsum is simply.</p>', 200.00, 'upload/828b99d248.png', 1),
(10, 'HP', 3, 3, '<p>Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simplyLorem Ipsum is simplyLorem Ipsum is simplyLorem Ipsum is simplyLorem Ipsum is simply.</p>', 900.00, 'upload/5fa019938a.jpg', 1),
(11, 'Samsung A50', 1, 2, '<p>Lorem Ipsum is simply. Lorem Ipsum is simply. Lorem Ipsum is simply. Lorem Ipsum is simply. Lorem Ipsum is simply. Lorem Ipsum is simply. Lorem Ipsum is simply. Lorem Ipsum is simply. Lorem Ipsum is simply. Lorem Ipsum is simply.</p>', 21000.00, 'upload/9b88243a29.jpg', 1),
(12, 'Iron Machine', 4, 2, '<p>good......................good....................good...............good......................good.................good............</p>', 2000.00, 'upload/273dc41622.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wlist`
--

CREATE TABLE `tbl_wlist` (
  `id` int(11) NOT NULL,
  `cmrId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` float(10,2) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_wlist`
--

INSERT INTO `tbl_wlist` (`id`, `cmrId`, `productId`, `productName`, `price`, `image`) VALUES
(12, 3, 5, 'Blendar', 500.22, 'upload/7c2a8007fd.png'),
(13, 3, 3, 'Fan', 3444.00, 'upload/eca32f3ea5.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`brandId`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cartId`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`catId`);

--
-- Indexes for table `tbl_compare`
--
ALTER TABLE `tbl_compare`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `tbl_wlist`
--
ALTER TABLE `tbl_wlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `brandId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_compare`
--
ALTER TABLE `tbl_compare`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_wlist`
--
ALTER TABLE `tbl_wlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
