-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2025 at 08:10 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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
(30, 'Sports', 0),
(31, 'Entertainment', 1),
(32, 'Politics', 1),
(42, 'Banking', 0),
(41, 'Education', 0),
(40, 'Technology', 1),
(43, 'Regional', 1);

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
(58, 'App Development', '                                                                lipsum.com is committed to protecting your privacy online. This Privacy Policy endeavours to describe to you our practices regarding the personal information we collect from users on our website, located at lipsum.com (the “Site”), and the services offered through the Site. If you have any questions about our Privacy Policy, our collection practices, the processing of user information, or if you would like to report a security violation to us directly, please contact us at help@lipsum.com                                ', '40', '01 Jan, 2025', 48, 'App Development.jpg'),
(63, 'Pushpa 2', 'Pushpa 2: The Rule is a 2024 Indian Telugu-language action drama film[8] directed by Sukumar and produced by Mythri Movie Makers, in association with Sukumar Writings. The film stars Allu Arjun in the titular role, alongside Rashmika Mandanna, Fahadh Faasil, Jagapathi Babu, Sunil and Rao Ramesh. It is the second instalment of the Pushpa film series and the sequel to Pushpa: The Rise (2021). The film follows Pushpa Raj, a coolie risen to the ranks of sandalwood smuggler, who begins to face tough opposition from enemies, including SP Bhanwar Singh Shekhawat IPS.', '31', '01 Feb, 2025', 45, 'Pushpa-2-The-Rule-Box-Office-Day-1.jpg'),
(62, 'Mahakumbh', 'Kumbh Mela v t e Prayagraj Haridwar Nashik Ujjain Kumbh Mela is an important Hindu pilgrimage, celebrated approximately every 6, 12 and 144 years, correlated with the partial or full revolution of Jupiter and representing the largest human gathering in the world. ', '43', '31 Jan, 2025', 45, 'mahakumbh.webp'),
(53, 'Dr. Manmohan singh Died', 'Dr. Manmohan Singh, the former Prime Minister of India, passed away. His legacy as one of the most prominent political figures in India\'s history is unparalleled. Serving as the country\'s Prime Minister from 2004 to 2014, Dr. Singh played a crucial role in shaping India\'s economic policies, particularly through economic reforms and liberalization that led to significant growth. His leadership and dedication to public service will be remembered by generations to come. His death marks the end of an era, leaving behind a profound impact on Indian politics and global diplomacy.', '32', '27 Dec, 2024', 45, 'Manmohan Singh.avif');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `website_name` varchar(60) NOT NULL,
  `logo` varchar(50) NOT NULL,
  `footer_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`website_name`, `logo`, `footer_desc`) VALUES
('Clone News Portal', 'news.png', '                                                                                                                                                                                                © Copyright 2024 News Portal | Powered by                      ');

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
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
