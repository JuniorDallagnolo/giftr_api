-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 17, 2018 at 06:03 PM
-- Server version: 5.6.35
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `giftr`
--

-- --------------------------------------------------------

--
-- Table structure for table `gifts`
--

CREATE TABLE `gifts` (
  `gift_id` int(10) NOT NULL,
  `gift_title` varchar(100) NOT NULL,
  `person_id` int(10) NOT NULL,
  `gift_url` varchar(100) NOT NULL,
  `gift_price` decimal(10,2) NOT NULL,
  `gift_store` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gifts`
--

INSERT INTO `gifts` (`gift_id`, `gift_title`, `person_id`, `gift_url`, `gift_price`, `gift_store`) VALUES
(3, 'Amazing fabulous TAG', 1, 'http://polda.com.br', '3.59', 'Amazon'),
(4, 'Amazing fabulous TAG', 1, 'http://polda.com.br', '1.00', 'Amazon'),
(5, 'Amazing fabulous TAG', 1, 'http://polda.com.br', '10123.10', 'Amazon123123'),
(6, 'Amazing fabulous TAG', 10, 'http://polda.com.br', '10123.10', 'Amazon123123'),
(7, 'Amazing fabulous TAG', 10, 'http://polda.com.br', '10123.10', 'Amazon123123'),
(8, 'Amazing fabulous TAG', 10, 'http://polda.com.br', '10123.10', 'Amazon123123'),
(9, 'Amazing fabulous TAG', 10, 'http://polda.com.br', '10123.10', 'Amazon123123');

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE `people` (
  `person_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `person_dob` date NOT NULL,
  `person_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`person_id`, `user_id`, `person_dob`, `person_name`) VALUES
(6, 2, '2000-02-02', 'Jordan Willis'),
(7, 2, '2000-02-02', 'Jordan Willis'),
(8, 2, '2000-02-02', 'Jordan Willis'),
(9, 2, '2000-02-02', 'Jordan Willis'),
(10, 2, '2000-02-02', 'Jordan Willis'),
(11, 2, '2000-02-02', 'Jordan Willis'),
(12, 2, '2000-02-02', 'Jordan Willis'),
(13, 2, '2000-02-02', 'Jordan Willis'),
(14, 2, '2001-02-02', 'Jordan Willis'),
(16, 2, '2001-02-02', 'Jordan Morrison'),
(17, 2, '2001-02-02', 'Jordan Willis'),
(18, 2, '2001-02-02', 'Jordan Willis'),
(19, 2, '2001-02-02', 'Jordan Willis'),
(20, 1, '2001-02-02', 'Jordan Morrison'),
(21, 1, '2001-02-02', 'Jordan Morrison'),
(22, 1, '2001-02-02', 'Jordan Morrison'),
(23, 1, '2001-02-02', 'Jordan Morrison'),
(24, 1, '2001-02-02', 'Jordan Morrison'),
(25, 1, '2001-02-02', 'Jordan Morrison'),
(26, 1, '2001-02-02', 'Jordan Morrison');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `user_device_id` char(36) NOT NULL COMMENT 'UUID',
  `user_password` char(40) DEFAULT NULL,
  `user_token` char(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_device_id`, `user_password`, `user_token`) VALUES
(1, 'first', '77777777-7777-7777-7777-777777777777', 'e0996a37c13d44c3b06074939d43fa3759bd32c1', '6067c0c0dc5a33b2e7f80d848f9d71f676a37d36'),
(2, 'junior', '12345678-1234-1234-1234-123456789012', '9009337cf16333f07109b593405cf7552ed8059a', 'ea40755d31b91971c95696ade2610a910e4c70da');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gifts`
--
ALTER TABLE `gifts`
  ADD PRIMARY KEY (`gift_id`);

--
-- Indexes for table `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`person_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gifts`
--
ALTER TABLE `gifts`
  MODIFY `gift_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `people`
--
ALTER TABLE `people`
  MODIFY `person_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;