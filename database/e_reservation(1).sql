-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 18, 2022 at 12:35 PM
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
-- Database: `e_reservation`
--

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservation_id` varchar(200) NOT NULL,
  `reservation_room_id` varchar(200) DEFAULT NULL,
  `client_name` varchar(200) DEFAULT NULL,
  `client_id_no` varchar(200) DEFAULT NULL,
  `client_email` varchar(200) DEFAULT NULL,
  `client_phone` varchar(200) DEFAULT NULL,
  `mode_of_payment` varchar(200) DEFAULT NULL,
  `duration` varchar(200) DEFAULT NULL,
  `cost` varchar(200) DEFAULT NULL,
  `transaction_id` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`reservation_id`, `reservation_room_id`, `client_name`, `client_id_no`, `client_email`, `client_phone`, `mode_of_payment`, `duration`, `cost`, `transaction_id`) VALUES
('Reservation-1987', 'Room-5389', 'Martin Mbithi', '35574881', 'martdevelopers254@gmail.com', '07123456790', 'card', '2', '180', '1642497995'),
('Reservation-4671', 'Room-8563', 'Martin Mbithi', '35574881', 'martdevelopers254@gmail.com', '07123456790', 'card', '3', '4500', '1642498260'),
('Reservation-5218', 'Room-8563', 'Martin Mbithi', '35574881', 'martdevelopers254@gmail.com', '07123456790', 'card', '1', '1500', '1642498378'),
('Reservation-7093', 'Room-1324', 'Martin Mbithi', '35574881', 'martdevelopers254@gmail.com', '07123456790', 'mpesa', NULL, '1', 'QAE4L0H97A'),
('Reservation-9214', 'Room-6845', 'Martin Mbithi', '35574881', 'martdevelopers254@gmail.com', '07123456790', 'card', '2', '2', '1642505483'),
('Reservation-9423', 'Room-1324', 'Martin Mbithi', '35574881', 'martdevelopers254@gmail.com', '07123456790', 'card', '10', '10', '1642496991');

-- --------------------------------------------------------

--
-- Table structure for table `reservation_payments`
--

CREATE TABLE `reservation_payments` (
  `payment_id` int(200) NOT NULL,
  `payment_reservation_id` varchar(200) DEFAULT NULL,
  `payment_room_id` varchar(200) DEFAULT NULL,
  `payment_amount` varchar(200) DEFAULT NULL,
  `payment_txn_code` varchar(200) DEFAULT NULL,
  `payment_date_posted` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservation_payments`
--

INSERT INTO `reservation_payments` (`payment_id`, `payment_reservation_id`, `payment_room_id`, `payment_amount`, `payment_txn_code`, `payment_date_posted`) VALUES
(4, 'Reservation-0965', 'Room-1324', '2', 'FLW-MOCK-64dfe5197f82dfe4b8d793db716dff65', '2022-01-18T08:59:06.000Z'),
(5, 'Reservation-7093', 'Room-1324', '1', '1642496702', '2022-01-18T09:08:09.000Z'),
(6, 'Reservation-9423', 'Room-1324', '10', '1642496991', '2022-01-18T09:10:28.000Z'),
(7, 'Reservation-9423', 'Room-1324', '10', '1642496991', '2022-01-18T09:10:28.000Z'),
(8, 'Reservation-1987', 'Room-5389', '180', '1642497995', '2022-01-18T09:27:39.000Z'),
(9, 'Reservation-4671', 'Room-8563', '4500', '1642498260', '2022-01-18T09:31:53.000Z'),
(10, 'Reservation-5218', 'Room-8563', '1500', '1642498378', '2022-01-18T09:33:21.000Z'),
(11, 'Reservation-9214', 'Room-6845', '2', '1642505483', '2022-01-18T11:32:48.000Z');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` varchar(200) NOT NULL,
  `room_number` varchar(200) NOT NULL,
  `room_price` varchar(200) NOT NULL,
  `room_status` varchar(200) NOT NULL DEFAULT 'vacant'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `room_number`, `room_price`, `room_status`) VALUES
('Room-1324', '002', '1', 'vacant'),
('Room-5389', '005', '90', 'vacant'),
('Room-6845', '001', '1', 'reserved'),
('Room-8563', '9091', '1500', 'vacant');

-- --------------------------------------------------------

--
-- Table structure for table `stkpush`
--

CREATE TABLE `stkpush` (
  `id` int(11) NOT NULL,
  `merchantRequestID` varchar(254) DEFAULT NULL,
  `checkoutRequestID` varchar(254) DEFAULT NULL,
  `resultCode` varchar(254) DEFAULT NULL,
  `resultDesc` varchar(254) DEFAULT NULL,
  `amount` varchar(11) DEFAULT NULL,
  `mpesaReceiptNumber` varchar(254) DEFAULT NULL,
  `transactionDate` varchar(254) DEFAULT NULL,
  `phoneNumber` varchar(254) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stkpush`
--

INSERT INTO `stkpush` (`id`, `merchantRequestID`, `checkoutRequestID`, `resultCode`, `resultDesc`, `amount`, `mpesaReceiptNumber`, `transactionDate`, `phoneNumber`) VALUES
(3, '16834-3113735-1', 'ws_CO_140120221137359210', '0', 'The service request is processed successfully.', '1', 'QAE4L0H97A', '20220114113853', '254799155770');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(200) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `user_email` varchar(200) NOT NULL,
  `user_password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`) VALUES
('2345678', 'Demo', 'demo@test.com', 'a69681bcf334ae130217fea4505fd3c994f5683f');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `ReservationRoomsID` (`reservation_room_id`);

--
-- Indexes for table `reservation_payments`
--
ALTER TABLE `reservation_payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `ReservationRoomID` (`payment_room_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `stkpush`
--
ALTER TABLE `stkpush`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reservation_payments`
--
ALTER TABLE `reservation_payments`
  MODIFY `payment_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `stkpush`
--
ALTER TABLE `stkpush`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `ReservationRoomsID` FOREIGN KEY (`reservation_room_id`) REFERENCES `rooms` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservation_payments`
--
ALTER TABLE `reservation_payments`
  ADD CONSTRAINT `ReservationRoomID` FOREIGN KEY (`payment_room_id`) REFERENCES `rooms` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
