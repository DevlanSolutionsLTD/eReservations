-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 21, 2021 at 07:36 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sale_id` varchar(200) NOT NULL,
  `sale_product_id` varchar(200) NOT NULL,
  `sale_quantity` varchar(200) DEFAULT NULL,
  `sale_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `sale_user_id` varchar(200) DEFAULT NULL,
  `sale_customer_name` varchar(200) DEFAULT NULL,
  `sale_customer_phoneno` varchar(200) DEFAULT NULL,
  `sale_customer_address` longtext DEFAULT NULL,
  `sale_receipt_number` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sale_id`, `sale_product_id`, `sale_quantity`, `sale_date`, `sale_user_id`, `sale_customer_name`, `sale_customer_phoneno`, `sale_customer_address`, `sale_receipt_number`) VALUES
('2698-5595', '02780e196206f5b6eb5471eea8460a1828c3be25', '2', '2021-11-21 17:24:58', '0314047b42eb00a4dc9a660b07148c086af393cf3c', 'MACHAKOS', 'MWALA', NULL, '1290'),
('6940-6791', '00ea0f31f3eed6b55bdf91395dcc0521fd3659a3', '1', '2021-11-21 17:20:42', '0314047b42eb00a4dc9a660b07148c086af393cf3c', 'MBOONI', 'KIKIMA', '120', '123456'),
('7895-2839', '21ef37a0952c0cc058ca32edb5f1acbf99a332ff', '9', '2021-11-21 18:01:29', '27fe387a8dc5b2228f05d8edb0318c533dca5334f1', 'MAKUENI', 'MBOONI', NULL, '900'),
('8063-9373', '5cdefe10e8f1ca11fd51c47cd5e6801be94069c5', '3', '2021-11-21 18:30:40', 'd054b820d56a7b575be827a3728f9c43285b63f41e', 'MACHAKOS', 'MWALA', NULL, '9045');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sale_id`),
  ADD KEY `UserSaleRecord` (`sale_user_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `UserSaleRecord` FOREIGN KEY (`sale_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
