-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 25, 2022 at 02:14 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Officewears_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `Orders`
--

CREATE TABLE `Orders` (
  `Order_id` int(11) NOT NULL,
  `User_id` int(11) NOT NULL,
  `Amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Order_details`
--

CREATE TABLE `Order_details` (
  `Order_details_id` int(11) NOT NULL,
  `Order_id` int(11) NOT NULL,
  `Product_id` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Product`
--

CREATE TABLE `Product` (
  `Product_id` int(11) NOT NULL,
  `Type` varchar(20) NOT NULL,
  `Price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Product`
--

INSERT INTO `Product` (`Product_id`, `Type`, `Price`) VALUES
(3, 'Suit-Male', 200),
(4, 'Suit-Female', 200);

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `User_id` int(11) NOT NULL,
  `User_role` int(11) NOT NULL,
  `User_name` varchar(50) NOT NULL,
  `User_address` text NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Phone_no` varchar(12) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `User_password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`User_id`, `User_role`, `User_name`, `User_address`, `Email`, `Phone_no`, `Username`, `User_password`) VALUES
(1, 1, 'Shashank Limaye', '1001,180 City Road, Southabk, VIC 3006', 'shashanklimye19@gmail.com', '422758443', 'shashanklimaye', '$2y$10$ukntinPMLhA8RTK//gW.IeAupkDGQWocbueVwiVleyD02bz9/Pake'),
(3, 2, 'Test', 'Test', 'test@gmail.com', '422345112', 'Testuser', '$2y$10$NkQcdDKtuGOSmArmKF5IqOgihSm/gcd6PDse5Ny3ewKnVWmk0EOwS');

-- --------------------------------------------------------

--
-- Table structure for table `User_role`
--

CREATE TABLE `User_role` (
  `User_role_id` int(11) NOT NULL,
  `User_role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `User_role`
--

INSERT INTO `User_role` (`User_role_id`, `User_role`) VALUES
(1, 'Admin'),
(2, 'Customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`Order_id`),
  ADD KEY `Customer` (`User_id`);

--
-- Indexes for table `Order_details`
--
ALTER TABLE `Order_details`
  ADD PRIMARY KEY (`Order_details_id`),
  ADD KEY `ordereid` (`Order_id`),
  ADD KEY `Productid` (`Product_id`);

--
-- Indexes for table `Product`
--
ALTER TABLE `Product`
  ADD PRIMARY KEY (`Product_id`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`User_id`),
  ADD KEY `userrole` (`User_role`);

--
-- Indexes for table `User_role`
--
ALTER TABLE `User_role`
  ADD PRIMARY KEY (`User_role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Orders`
--
ALTER TABLE `Orders`
  MODIFY `Order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `Order_details`
--
ALTER TABLE `Order_details`
  MODIFY `Order_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Product`
--
ALTER TABLE `Product`
  MODIFY `Product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `User_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `User_role`
--
ALTER TABLE `User_role`
  MODIFY `User_role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `User_id` FOREIGN KEY (`User_id`) REFERENCES `user` (`User_id`);

--
-- Constraints for table `Order_details`
--
ALTER TABLE `Order_details`
  ADD CONSTRAINT `Productid` FOREIGN KEY (`Product_id`) REFERENCES `Product` (`Product_id`),
  ADD CONSTRAINT `ordereid` FOREIGN KEY (`Order_id`) REFERENCES `Orders` (`Order_id`);

--
-- Constraints for table `User`
--
ALTER TABLE `User`
  ADD CONSTRAINT `userrole` FOREIGN KEY (`User_role`) REFERENCES `User_role` (`User_role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
