-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2024 at 05:51 PM
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
-- Database: `ecoxchangedb`
--
DROP DATABASE IF EXISTS `ecoxchangedb`;
CREATE DATABASE IF NOT EXISTS `ecoxchangedb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ecoxchangedb`;

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_ID` varchar(10) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Contact` varchar(13) NOT NULL,
  `house_no` varchar(10) NOT NULL,
  `street_name` varchar(70) NOT NULL,
  `city` varchar(70) NOT NULL,
  `postcode` int(11) NOT NULL,
  `state` varchar(20) NOT NULL,
  `cust_ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_ID`, `Name`, `Contact`, `house_no`, `street_name`, `city`, `postcode`, `state`, `cust_ID`) VALUES
('A001', 'Melda Hana', '0135678490', 'No 2', 'Jalan Mahligai 2', 'Seksyen 7, Shah alam', 43009, 'Selangor', 'C001'),
('A002', 'Fadlan Amzar', '01372847238', 'No 17A', 'Jalan Suakasih 2/3', 'Bandar Tun Hussein Onn, Cheras', 43200, 'Selangor', 'C001'),
('A003', 'Norhashidah Sharif', '01136699192', 'No 1', 'Jalan Putra Heights 2', 'Subang Jaya', 43901, 'Selangor', 'C001'),
('A004', 'Siti Nursyuhada', '012378028', 'Lot 2001', 'Lorong Haji Mat', 'Jerantut', 26400, 'Pahang', 'C004'),
('A005', 'Rohana Binti Jaafar', '0126689080', 'A-02-01', 'Jalan RSKU 3 ', 'Putra Heights', 43800, 'Selangor', 'C002'),
('A006', 'Rohaidah Has', '01266082982', 'Lot 1009', 'Jalan Semarak kubang ulu', 'Bukit Mertajam', 14000, 'Pulau Pinang', 'C003');

-- --------------------------------------------------------

--
-- Table structure for table `bank_details`
--

CREATE TABLE `bank_details` (
  `bank_id` varchar(10) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `bank_acc_no` varchar(20) NOT NULL,
  `bank_full_name` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bank_details`
--

INSERT INTO `bank_details` (`bank_id`, `bank_name`, `bank_acc_no`, `bank_full_name`) VALUES
('B101', 'Hong Leong Bank', '162309809611', 'Nur Melda Hana Binti Ahmad'),
('B102', 'Hong Leong Bank', '10972992001', 'Irdina Iman Binti Zainuddin'),
('B103', 'Maybank', '7063486780', 'Farah Adibah Binti Abdul Malek'),
('B104', 'Rhb Bank', '190988290111', 'Siti Nursyuhada Binti Nur Azman'),
('B105', '', '', ''),
('B111', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `book_ID` varchar(10) NOT NULL,
  `vehicle_type` varchar(12) NOT NULL,
  `pickup_date` date NOT NULL,
  `pickup_time` varchar(30) NOT NULL,
  `deposit_receipt` varchar(255) NOT NULL,
  `deposit_status` varchar(15) NOT NULL,
  `book_status` varchar(15) NOT NULL,
  `address_ID` varchar(10) NOT NULL,
  `cust_ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`book_ID`, `vehicle_type`, `pickup_date`, `pickup_time`, `deposit_receipt`, `deposit_status`, `book_status`, `address_ID`, `cust_ID`) VALUES
('B001', 'lorry', '2024-05-06', 'Immediately', ' ../filepdf/receipt1.pdf', 'pending', 'cancel', 'A001', 'C001'),
('B002', 'lorry', '2024-07-12', 'Immediately', '../filepdf/receipt1.pdf', 'success', 'pending', 'A002', 'C002'),
('B003', 'motorcycle', '2024-07-15', 'Pickup in 30 minutes', '../filepdf/receipt1.pdf', 'success', 'inProgress', 'A003', 'C003'),
('B004', 'car', '2024-07-16', 'Pickup in 1 hour', '../filepdf/receipt1.pdf', 'success', 'inProgress', 'A004', 'C004'),
('B005', 'motorcycle', '2024-07-22', 'Immediately', '../filepdf/receipt1.pdf', 'success', 'success', 'A005', 'C002'),
('B006', 'car', '2024-07-23', 'Pickup in 30 minutes', '../filepdf/receipt1.pdf', 'success', 'success', 'A006', 'C001'),
('B007', 'Motorcycle', '2024-06-01', 'Immediately', '../filepdf/MELISSA YURAN PENGAJIAN RESIT.pdf', 'pending', 'pending', 'A002', 'C001'),
('B008', 'Motorcycle', '2024-06-01', 'Immediately', '../filepdf/YURAN MYTECC MELISSA SOFIA BINTI SHAHRAN.pdf', 'pending', 'pending', 'A001', 'C001');

-- --------------------------------------------------------

--
-- Table structure for table `collection_record`
--

CREATE TABLE `collection_record` (
  `collect_ID` varchar(10) NOT NULL,
  `collect_weight` float NOT NULL,
  `total_amount` decimal(6,2) NOT NULL,
  `collect_date` date NOT NULL,
  `collect_time` time NOT NULL,
  `reward_status` varchar(15) NOT NULL,
  `book_ID` varchar(10) NOT NULL,
  `item_ID` varchar(10) NOT NULL,
  `staff_ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `collection_record`
--

INSERT INTO `collection_record` (`collect_ID`, `collect_weight`, `total_amount`, `collect_date`, `collect_time`, `reward_status`, `book_ID`, `item_ID`, `staff_ID`) VALUES
('CR001', 1, 0.25, '2024-05-06', '14:23:00', 'pending', 'B001', 'I001', 'S002'),
('CR002', 3, 2.00, '2024-07-12', '12:00:11', 'pending', 'B002', 'I004', 'S002'),
('CR003', 5, 15.00, '2024-07-15', '12:30:00', 'success', 'B003', 'I005', 'S005'),
('CR004', 0.5, 0.20, '2024-07-16', '09:00:00', 'success', 'B004', 'I007', 'S005'),
('CR005', 3, 1.40, '2024-07-17', '15:22:36', 'success', 'B004', 'I007', 'S005'),
('CR006', 0.5, 2.00, '2024-07-22', '16:30:14', 'pending', 'B005', 'I004', 'S002'),
('CR007', 2, 0.80, '2024-05-22', '12:35:22', 'success', 'B005', 'I006', 'S006'),
('CR008', 30, 30.00, '2024-05-06', '12:35:22', 'success', 'B001', 'I006', 'S006'),
('CR009', 50, 12.50, '2024-07-12', '09:46:41', 'pending', 'B002', 'I001', 'S006'),
('CR010', 1, 0.20, '2024-07-15', '09:30:00', 'pending', 'B003', 'I003', 'S006'),
('CR011', 20, 60.00, '2024-07-23', '13:50:05', 'success', 'B006', 'I008', 'S005'),
('CR012', 10, 4.00, '2024-07-23', '10:51:38', 'success', 'B006', 'I007', 'S002'),
('CR013', 5, 2.00, '2024-05-30', '20:53:49', 'Pending', 'B002', 'I004', 'S001');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cust_ID` varchar(10) NOT NULL,
  `cust_username` varchar(20) NOT NULL,
  `cust_password` varchar(128) NOT NULL,
  `cust_first_name` varchar(30) NOT NULL,
  `cust_last_name` varchar(30) NOT NULL,
  `cust_contact_no` varchar(12) NOT NULL,
  `cust_email` varchar(30) NOT NULL,
  `cust_pict` varchar(255) NOT NULL,
  `bank_id` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cust_ID`, `cust_username`, `cust_password`, `cust_first_name`, `cust_last_name`, `cust_contact_no`, `cust_email`, `cust_pict`, `bank_id`) VALUES
('C001', 'melda', '$2y$10$8GeARt/071btIy0n2uEKZOrU3ONI8uTS3tjxn/7Y3hjQhD2UoQfNC', 'Melda', 'Hanaa', '0197789022', 'meldaa04@gmail.com', '../images/profile_pict/pict3.jpg', 'B101'),
('C002', 'dinagfr', '$2y$10$3FNCw.4OHq530P0oPXc3ruE2MiBOKnegVyWQBtRaoUEpvp9ZyFThy', 'Irdina', 'Iman', '0127890879', 'dinagfr@yahoo.com', '../images/profile_pict/pict13.jpg', 'B102'),
('C003', 'farah', '$2y$10$JpUsnyJOVyFlyarOu9Nrkeo5MDmlF/OXJ88AfSafHKO30.X8joKrm', 'Farah', 'Adibahh', '0192367890', 'farah@gmail.com', '../images/profile_pict/pict5.jpg', 'B103'),
('C004', 'syuhada', '$2y$10$TQag7e.Ex5.H0DgWYEJtiuQpa0BBE3w3dhk.XDnlTVPgOyd3ST5YW', 'Siti', 'Nursyuhada', '0112309789', 'syuhada@yahoo.com', '../images/profile_pict/pict6.jpg', 'B104'),
('C006', 'ahmadzaki', '$2y$10$ABhjHG.3oIUiU9Qp1/zvl.dRG.NDx/HHu5UN.NfmJpDsygdEe9J5C', 'Ahmad', 'Zaki', '01132323232', 'zaki@gmail.com', '../images/profile_pict/default.png', 'B105'),
('C007', 'elly', '$2y$10$BBxhb6fLTMcslRyun0a.meA6D3OBa49EJ4dRYiIKG4za4ZWMSoYzS', '', '', '', 'elly@gmail.com', '../images/profile_pict/default.png', 'B111');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_ID` varchar(10) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `item_price` decimal(16,2) DEFAULT NULL,
  `item_pict` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_ID`, `item_name`, `item_price`, `item_pict`) VALUES
('I001', 'Cardboard', 0.25, '../images/items/cardboard.png'),
('I002', 'Old News Paper', 0.20, '../images/items/newpaper.png'),
('I003', 'Black & White Paper', 0.35, '../images/items/bnw paper.png'),
('I004', 'Plastic Bottle', 0.40, '../images/items/plasticBot.png'),
('I005', 'Aluminium Can', 3.00, '../images/items/alCan.png'),
('I006', 'Tin', 0.45, '../images/items/tin.png'),
('I007', 'Glass', 0.40, '../images/items/glass bottle.png'),
('I008', 'Used Cooking Oil', 3.00, '../images/items/usedOil.png');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_ID` varchar(10) NOT NULL,
  `staff_username` varchar(20) NOT NULL,
  `staff_password` varchar(20) NOT NULL,
  `staff_first_name` varchar(30) NOT NULL,
  `staff_last_name` varchar(30) NOT NULL,
  `staff_contact_no` varchar(12) NOT NULL,
  `staff_email` varchar(30) NOT NULL,
  `category` varchar(30) NOT NULL,
  `staff_pict` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_ID`, `staff_username`, `staff_password`, `staff_first_name`, `staff_last_name`, `staff_contact_no`, `staff_email`, `category`, `staff_pict`) VALUES
('S001', 'meyalissa', '$2y$10$clOX2AgadWQOk', 'Melissa', 'Sofia', '0136653982', 'melissa.sofia0204@gmail.com', 'admin', '../images/profile_pict/pict8.jpg'),
('S002', 'fadlan', '$2y$10$rJ791m9KaecW1', 'Fadlan', 'Amzar', '0187087819', 'fadlan04@gmail.com', 'rider', '../images/profile_pict/pict4.jpg'),
('S003', 'dina', '$2y$10$8uwSoyjGatfj2', 'Irdina', 'Ghafar', '0134768901', 'irdina.cntk@gmail.com', 'admin', '../images/profile_pict/pict12.jpg'),
('S004', 'amira', '$2y$10$9gbHfzgR./mND', 'Amalia', 'Amira', '0123450987', 'amalia@gmail.com', 'admin', '../images/profile_pict/pict14.jpg'),
('S005', 'imanMalek', '$2y$10$vg6u4ITpfcceP', 'Iman', 'Danish', '0199228901', 'imanDanish@gmail.com', 'rider', '../images/profile_pict/pict10.jpg'),
('S006', 'Danial09', '$2y$10$HY60syMnE6a7e', 'Danial', 'Amin', '0123450900', 'danial02.haikal@gmail.com', 'rider', '../images/profile_pict/pict11.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_ID`),
  ADD KEY `cust_ID` (`cust_ID`);

--
-- Indexes for table `bank_details`
--
ALTER TABLE `bank_details`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`book_ID`),
  ADD KEY `cust_ID` (`cust_ID`),
  ADD KEY `address_ID` (`address_ID`) USING BTREE;

--
-- Indexes for table `collection_record`
--
ALTER TABLE `collection_record`
  ADD PRIMARY KEY (`collect_ID`),
  ADD KEY `book_ID` (`book_ID`,`item_ID`),
  ADD KEY `fk3` (`staff_ID`),
  ADD KEY `fk2` (`item_ID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cust_ID`),
  ADD KEY `bank_id` (`bank_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_ID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_ID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_2` FOREIGN KEY (`cust_ID`) REFERENCES `customer` (`cust_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`cust_ID`) REFERENCES `customer` (`cust_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`address_ID`) REFERENCES `address` (`address_ID`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
