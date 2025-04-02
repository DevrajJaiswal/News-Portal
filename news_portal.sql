-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2025 at 12:19 PM
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
-- Database: `news_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `post` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `post`) VALUES
(30, 'Sports', 1),
(31, 'Entertainment', 1),
(32, 'Politics', 1),
(42, 'Banking', 1),
(41, 'Education', 1),
(40, 'Technology', 3);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(100) NOT NULL,
  `post_date` varchar(50) NOT NULL,
  `author` int(11) NOT NULL,
  `post_img` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `title`, `description`, `category`, `post_date`, `author`, `post_img`) VALUES
(60, 'New Portal', '                                New PortalNew Portal.........................jununm uyhy uhbuyhu ybgybnh uybuh uyb             ', '41', '02 Jan, 2025', 48, '676d87bbba1fe-manmohan-singh-served-as-prime-minister-from-2004-to-2014-264333889-16x9.avif'),
(54, 'Web Development', 'Log Files: As is true of most websites, we gather certain information automatically and store it in log files. This information includes IP addresses, browser type, Internet service provider (ISP), referring/exit pages, operating system, date/time stamp, and clickstream data. We use this information to maintain and improve the performance of the Services.', '40', '27 Dec, 2024', 45, 'Top-10-Web-Development-Companies-in-USA.jpeg'),
(58, 'App Development', '                                lipsum.com is committed to protecting your privacy online. This Privacy Policy endeavours to describe to you our practices regarding the personal information we collect from users on our website, located at lipsum.com (the “Site”), and the services offered through the Site. If you have any questions about our Privacy Policy, our collection practices, the processing of user information, or if you would like to report a security violation to us directly, please contact us at help@lipsum.com                ', '40', '01 Jan, 2025', 48, 'Top-10-Web-Development-Companies-in-USA.jpeg'),
(59, 'Cricket', '                                                                lipsum.com is committed to protecting your privacy online. This Privacy Policy endeavours to describe to you our practices regarding the personal information we collect from users on our website, located at lipsum.com (the “Site”), and the services offered through the Site. If you have any questions about our Privacy Policy, our collection practices, the processing of user information, or if you would like to report a security violation to us directly, please contact us at help@lipsum.com                                ', '30', '02 Jan, 2025', 48, 'Pushpa-2-The-Rule-Box-Office-Day-1.jpg'),
(55, 'Bank Froad', 'Log Files: As is true of most websites, we gather certain information automatically and store it in log files. This information includes IP addresses, browser type, Internet service provider (ISP), referring/exit pages, operating system, date/time stamp, and clickstream data. We use this information to maintain and improve the performance of the Services.', '42', '27 Dec, 2024', 45, 'bank-fraud.jpg'),
(56, 'Pushp-2 broke all the records of hit movies!', 'lipsum.com is committed to protecting your privacy online. This Privacy Policy endeavours to describe to you our practices regarding the personal information we collect from users on our website, located at lipsum.com (the “Site”), and the services offered through the Site. If you have any questions about our Privacy Policy, our collection practices, the processing of user information, or if you would like to report a security violation to us directly, please contact us at help@lipsum.com', '31', '27 Dec, 2024', 48, 'Pushpa-2-The-Rule-Box-Office-Day-1.jpg'),
(61, 'test', '123', '40', '05 Jan, 2025', 45, 'bank-fraud.jpg'),
(53, 'Dr. Manmohan singh Died', 'Dr. Manmohan Singh, the former Prime Minister of India, passed away. His legacy as one of the most prominent political figures in India\'s history is unparalleled. Serving as the country\'s Prime Minister from 2004 to 2014, Dr. Singh played a crucial role in shaping India\'s economic policies, particularly through economic reforms and liberalization that led to significant growth. His leadership and dedication to public service will be remembered by generations to come. His death marks the end of an era, leaving behind a profound impact on Indian politics and global diplomacy.', '32', '27 Dec, 2024', 45, '676d87bbba1fe-manmohan-singh-served-as-prime-minister-from-2004-to-2014-264333889-16x9.avif');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `role` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `username`, `password`, `role`) VALUES
(47, 'Kaushal', 'Patel', 'kaushal', '68053af2923e00204c3ca7c6a3150cf7', 0),
(48, 'Saurabh', 'Jha', 'saurabh', '250cf8b51c773f3f8dc8b4be867a9a02', 0),
(45, 'Devraj', 'Jaiswal', 'devraj', '202cb962ac59075b964b07152d234b70', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`),
  ADD UNIQUE KEY `post_id` (`post_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
