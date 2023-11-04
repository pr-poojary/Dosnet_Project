-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2023 at 04:26 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `heading1` varchar(255) NOT NULL,
  `heading2` varchar(255) NOT NULL,
  `btn_txt` varchar(55) DEFAULT NULL,
  `btn_link` varchar(55) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `order_no` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `heading1`, `heading2`, `btn_txt`, `btn_link`, `image`, `order_no`, `status`) VALUES
(1, '10% Off Your First Order', 'Fashionable Dress', 'Shop Now', 'categories.php?id=cat1', '575322908_carousel-2.jpg', 3, 1),
(2, '10% Off Your First Order', 'Reasonable Price', 'Shop Now', 'categories.php?id=cat2', '325368295_carousel-1.jpg', 1, 1),
(3, 'How are you', 'Special offer for you', 'Click to Shop', '#', '900962217_Laptop.jpg', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `categories` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `categories`, `status`) VALUES
(10, 'cat2', 1),
(11, 'cat3', 1),
(12, 'cat4', 1),
(13, 'cat1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(75) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `query` text NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `mobile`, `query`, `added_on`) VALUES
(1, 'Prajwal', 'prajwal@gmail.com', '1234567890', 'Test Query', '2020-01-14 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `coupon_name`
--

CREATE TABLE `coupon_name` (
  `id` int(11) NOT NULL,
  `coupon_code` varchar(50) NOT NULL,
  `coupon_value` int(11) NOT NULL,
  `coupon_type` varchar(10) NOT NULL,
  `cart_min_value` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coupon_name`
--

INSERT INTO `coupon_name` (`id`, `coupon_code`, `coupon_value`, `coupon_type`, `cart_min_value`, `status`) VALUES
(1, 'First50', 100, 'Rupee', 500, 1),
(2, 'First60', 10, '1', 1000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `pincode` int(11) NOT NULL,
  `payment_type` varchar(20) NOT NULL,
  `total_price` float NOT NULL,
  `payment_status` varchar(20) NOT NULL,
  `order_statu` int(11) NOT NULL,
  `txnid` varchar(200) NOT NULL,
  `mihpayid` varchar(200) NOT NULL,
  `payu_status` varchar(10) NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `coupon_value` int(50) NOT NULL,
  `coupon_code` varchar(50) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `user_id`, `address`, `city`, `state`, `pincode`, `payment_type`, `total_price`, `payment_status`, `order_statu`, `txnid`, `mihpayid`, `payu_status`, `coupon_id`, `coupon_value`, `coupon_code`, `added_on`) VALUES
(1, 1, '123 Street', 'new york', 'new york', 123, 'COD', 8999, 'success', 1, '', '', '', 0, 0, '', '2023-08-02 08:21:34'),
(2, 1, '321', 'York', 'York', 231, 'COD', 61998, 'success', 1, '', '', '', 0, 0, '', '2023-08-02 08:24:10'),
(3, 1, 'new street', 'dubai', 'uae', 432, 'COD', 55798.2, 'success', 1, '', '', '', 2, 6200, 'First60', '2023-08-02 08:28:44'),
(4, 1, 'hjhk', 'cfghvv', 'bhjj', 1456, 'COD', 15111, 'success', 1, '', '', '', 0, 0, '', '2023-08-03 04:53:59'),
(5, 1, 'street', 'gahh', 'new', 78261, 'COD', 15011, 'success', 1, '', '', '', 1, 100, 'First50', '2023-08-03 05:45:44');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `qty`, `price`) VALUES
(1, 1, 8, 1, 8999),
(2, 2, 10, 1, 14999),
(3, 2, 11, 1, 46999),
(4, 3, 10, 1, 14999),
(5, 3, 11, 1, 46999),
(6, 4, 31, 1, 112),
(7, 4, 10, 1, 14999),
(8, 5, 31, 1, 112),
(9, 5, 10, 1, 14999);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `name`) VALUES
(1, 'Pending'),
(2, 'Processing'),
(3, 'Shipped'),
(4, 'Canceled'),
(5, 'Complete');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `sub_categories_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mrp` float NOT NULL,
  `price` float NOT NULL,
  `qty` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `short_desc` varchar(2000) NOT NULL,
  `description` text NOT NULL,
  `best_sellers` int(11) NOT NULL,
  `meta_title` varchar(2000) NOT NULL,
  `meta_desc` varchar(2000) NOT NULL,
  `meta_keyword` varchar(2000) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `categories_id`, `sub_categories_id`, `name`, `mrp`, `price`, `qty`, `image`, `short_desc`, `description`, `best_sellers`, `meta_title`, `meta_desc`, `meta_keyword`, `status`) VALUES
(8, 13, 2, 'Galaxy S4', 10999, 8999, 24, '298914824_watch-2.jpg', 'ghgagggdhgUGSWJWSJ', 'nndhdhhditeyueiejdhffhhgfjeueiowpwlsjsjshyeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeehhhhhhhhhhhhhhhhh\r\nhhhhhhhhhhhhhhhhhhhhhhhhhhhhhddddddddddddddddddddddddddddddddddddddddd', 1, 'jkhudhie', 'lnhiueje', 'nkjjiekjw', 1),
(9, 11, 3, 'Analog Clock', 5999, 5499, 20, '752384978_watch-4.jpg', 'hhdiuoijjhjkhjvhdhuivhuvuh', 'nekjhfhiurriey78rruyhuhkjsjhghdhfduysfhuihjkbnbdmvscvjgjhsguihfieuhwghuhasjdhksahduuhsad\r\nhhhhhhhhhhhhaaaadiuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuhfdasmhbfwehjgkwhekjhwkjwnejf', 0, 'djhgfjhiugihuuif', 'kdjhfghifhiuhiurhuighjfh', 'hgudiufhgjihiuf', 1),
(10, 11, 3, 'IPad', 15999, 14999, 15, '151564335_product17.png', 'FGHFGHFJSAHJGSAJHGjhgjhgjhgjggfuy', 'gsiugsiushuishdhkjshkjhskjdhiudhhkjchkjcskjshkjh clkjslkjsdlk slkji jwdij wjoi ijw ij oi wjoi oijwioj oij doi do d ohdwowdoiod i dodhw oihi wooh wod oidhoiw   ijoidjd wdi oiw owi oidj oiidw j joihoid wo wh oiudhoui wiwd huhwihwdui  hwui idwhk jhwdiud kwdou woiw kd k kd uwh wduh ui', 0, 'IPad', 'gsiugsiushuishdhkjshkjhskjdhiudhhkjchkjcskjshkjh clkjslkjsdlk slkji jwdij wjoi ijw ij oi wjoi oijwioj oij doi do d ohdwowdoiod i dodhw oihi wooh wod oidhoiw   ijoidjd wdi oiw owi oidj oiidw j joihoid wo wh oiudhoui wiwd huhwihwdui  hwui idwhk jhwdiud kwdou woiw kd k kd uwh wduh ui', 'Tablet', 1),
(11, 13, 1, 'Microsoft Surface', 48999, 46999, 14, '526461769_product23.png', 'Laptop ndews agygsiqui  jkkahjakh', 'gsiugsiushuishdhkjshkjhskjdhiudhhkjchkjcskjshkjh clkjslkjsdlk slkji jwdij wjoi ijw ij oi wjoi oijwioj oij doi do d ohdwowdoiod i dodhw oihi wooh wod oidhoiw   ijoidjd wdi oiw owi oidj oiidw j joihoid wo wh oiudhoui wiwd huhwihwdui  hwui idwhk jhwdiud kwdou woiw kd k kd uwh wduh uiijiosdjoih oishu odw wdoidodw oo', 1, 'ghjgaius loaiuspo', 'gsiugsiushuishdhkjshkjhskjdhiudhhkjchkjcskjshkjh clkjslkjsdlk slkji jwdij wjoi ijw ij oi wjoi oijwioj oij doi do d ohdwowdoiod i dodhw oihi wooh wod oidhoiw   ijoidjd wdi oiw owi oidj oiidw j joihoid wo wh oiudhoui wiwd huhwihwdui  hwui idwhk jhwdiud kwdou woiw kd k kd uwh wduh ui', 'Laptop', 1),
(12, 11, 4, 'Sony Camera', 89999, 83999, 50, '720666705_cat-4.jpg', 'Digital Camera', 'qghuisiuhsh hqh q yq  yn jwhsoij hqus hhu uhushhj  qshs his  uhqhshshiq oohjajijaiss  oohokajiozjihhjaih shoiajsijqioj sz hsohqhsuh qijiqjih qjhquhquh qhu iqjih qhq hquhihq q h qhoqh', 0, 'Digital Camera', 'qghuisiuhsh hqh q yq  yn jwhsoij hqus hhu uhushhj  qshs his  uhqhshshiq oohjajijaiss  oohokajiozjihhjaih shoiajsijqioj sz hsohqhsuh qijiqjih qjhquhquh qhu iqjih qhq hquhihq q h qhoqh', 'Sony Camera', 1),
(31, 13, 1, 'werrd', 120, 112, 15, '726216404_watch-4.jpg', 'qwerty', 'dndjk', 0, 'ddne', 'kemkme', 'djje', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `product_image`) VALUES
(1, 28, '255343960_watch-2.jpg'),
(2, 1, '168082230_product17.png'),
(3, 29, '388717094_product17.png'),
(4, 29, '150686684_watch-4.jpg'),
(6, 30, '735508024_DSC_7306_00001.jpg'),
(10, 30, '769434569_DSC_7375_00001.jpg'),
(13, 31, '295812481_watch-4.jpg'),
(14, 31, '451722921_cat-4.jpg'),
(15, 31, '982003862_cat-2.jpg'),
(17, 31, '150793589_cat-6.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_review`
--

CREATE TABLE `product_review` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` varchar(20) NOT NULL,
  `review` text NOT NULL,
  `status` int(11) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_review`
--

INSERT INTO `product_review` (`id`, `product_id`, `user_id`, `rating`, `review`, `status`, `added_on`) VALUES
(1, 9, 1, 'Good', 'The product is good to use', 1, '2023-06-29 05:04:56'),
(5, 9, 2, 'Fantastic', 'Diam amet duo labore stet elitr ea clita ipsum, tempor labore accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed sed eirmod ipsum.', 1, '2023-06-29 05:24:53'),
(6, 9, 2, 'Fantastic', 'Diam amet duo labore stet elitr ea clita ipsum, tempor labore accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed sed eirmod ipsum.', 0, '2023-06-29 05:25:44'),
(7, 9, 2, 'Very Good', 'Diam amet duo labore stet elitr ea clita ipsum, tempor labore accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed sed eirmod ipsum.', 0, '2023-06-29 05:27:43'),
(9, 9, 2, 'Good', 'Diam amet duo labore stet elitr ea clita ipsum, tempor labore accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed sed eirmod ipsum.', 1, '2023-06-29 05:29:18'),
(10, 31, 2, 'Good', 'It good as much I used', 1, '2023-06-29 06:08:24');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `sub_categories` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `categories_id`, `sub_categories`, `status`) VALUES
(1, 13, 'Test', 1),
(2, 13, 'Test1', 1),
(3, 11, 'Test', 1),
(4, 11, 'Test2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `mobile`, `added_on`) VALUES
(1, 'Prajwal', '12345678', 'prajwal@gmail.com', '1234567890', '2020-01-14 00:00:00'),
(2, 'Demo', '12345678', 'praj@gmail.com', '3456789012', '2023-06-29 17:13:53');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `product_id`, `added_on`) VALUES
(14, 1, 7, '2023-05-28 08:09:44'),
(19, 1, 10, '2023-08-02 08:22:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon_name`
--
ALTER TABLE `coupon_name`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_review`
--
ALTER TABLE `product_review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coupon_name`
--
ALTER TABLE `coupon_name`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `product_review`
--
ALTER TABLE `product_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
