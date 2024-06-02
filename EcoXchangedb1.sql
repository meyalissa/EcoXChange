-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.3.37-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for ecoxchangedb
CREATE DATABASE IF NOT EXISTS `ecoxchangedb` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `ecoxchangedb`;

-- Dumping structure for table ecoxchangedb.address
CREATE TABLE IF NOT EXISTS `address` (
  `address_ID` varchar(10) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Contact` varchar(13) NOT NULL,
  `house_no` varchar(10) NOT NULL,
  `street_name` varchar(70) NOT NULL,
  `city` varchar(70) NOT NULL,
  `postcode` int(11) NOT NULL,
  `state` varchar(20) NOT NULL,
  `cust_ID` varchar(10) NOT NULL,
  PRIMARY KEY (`address_ID`),
  KEY `cust_ID` (`cust_ID`),
  CONSTRAINT `address_ibfk_2` FOREIGN KEY (`cust_ID`) REFERENCES `customer` (`cust_ID`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table ecoxchangedb.address: ~7 rows (approximately)
DELETE FROM `address`;
INSERT INTO `address` (`address_ID`, `Name`, `Contact`, `house_no`, `street_name`, `city`, `postcode`, `state`, `cust_ID`) VALUES
	('A001', 'Melda Hana', '0135678490', 'No 2', 'Jalan Mahligai 2', 'Seksyen 7, Shah alam', 43009, 'Selangor', 'C001'),
	('A002', 'Fadlan Amzar', '01372847238', 'No 17A', 'Jalan Suakasih 2/3', 'Bandar Tun Hussein Onn, Cheras', 43200, 'Selangor', 'C001'),
	('A003', 'Norhashidah Sharif', '01136699192', 'No 1', 'Jalan Putra Heights 2', 'Subang Jaya', 43901, 'Selangor', 'C001'),
	('A004', 'Siti Nursyuhada', '012378028', 'Lot 2001', 'Lorong Haji Mat', 'Jerantut', 26400, 'Pahang', 'C004'),
	('A005', 'Rohana Binti Jaafar', '0126689080', 'A-02-01', 'Jalan RSKU 3 ', 'Putra Heights', 43800, 'Selangor', 'C002'),
	('A006', 'Rohaidah Has', '01266082982', 'Lot 1009', 'Jalan Semarak kubang ulu', 'Bukit Mertajam', 14000, 'Pulau Pinang', 'C003'),
	('A007', 'Ellysha Diana', '01137341592', 'B-2-1 KKKA', 'Kg Pandan', 'Kuala Lumpur', 55100, 'W.P. Kuala Lumpur', 'C007'),
	('A008', 'Eiman', '012910231', '123', '123', 'SKDSKDOP', 123, 'asdmsakda', 'C008');

-- Dumping structure for table ecoxchangedb.bank_details
CREATE TABLE IF NOT EXISTS `bank_details` (
  `bank_id` varchar(10) NOT NULL,
  `bank_name` varchar(50) DEFAULT NULL,
  `bank_acc_no` varchar(20) DEFAULT NULL,
  `bank_full_name` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`bank_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table ecoxchangedb.bank_details: ~7 rows (approximately)
DELETE FROM `bank_details`;
INSERT INTO `bank_details` (`bank_id`, `bank_name`, `bank_acc_no`, `bank_full_name`) VALUES
	('B101', 'Hong Leong Bank', '162309809611', 'Nur Melda Hana Binti Ahmad'),
	('B102', 'Hong Leong Bank', '10972992001', 'Irdina Iman Binti Zainuddin'),
	('B103', 'Maybank', '7063486780', 'Farah Adibah Binti Abdul Malek'),
	('B104', 'Rhb Bank', '190988290111', 'Siti Nursyuhada Binti Nur Azman'),
	('B105', '', '', ''),
	('B106', 'Maybank', '1623098092132', 'Ellysha Diana Binti Shahran'),
	('B107', NULL, NULL, NULL),
	('B108', NULL, NULL, NULL);

-- Dumping structure for table ecoxchangedb.booking
CREATE TABLE IF NOT EXISTS `booking` (
  `book_ID` varchar(10) NOT NULL,
  `vehicle_type` varchar(12) NOT NULL,
  `pickup_date` date NOT NULL,
  `pickup_time` varchar(30) NOT NULL,
  `deposit_receipt` varchar(255) NOT NULL,
  `deposit_status` varchar(15) NOT NULL,
  `book_status` varchar(15) NOT NULL,
  `address_ID` varchar(10) NOT NULL,
  `cust_ID` varchar(10) NOT NULL,
  PRIMARY KEY (`book_ID`),
  KEY `cust_ID` (`cust_ID`),
  KEY `address_ID` (`address_ID`) USING BTREE,
  CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`cust_ID`) REFERENCES `customer` (`cust_ID`) ON UPDATE CASCADE,
  CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`address_ID`) REFERENCES `address` (`address_ID`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table ecoxchangedb.booking: ~8 rows (approximately)
DELETE FROM `booking`;
INSERT INTO `booking` (`book_ID`, `vehicle_type`, `pickup_date`, `pickup_time`, `deposit_receipt`, `deposit_status`, `book_status`, `address_ID`, `cust_ID`) VALUES
	('B001', 'lorry', '2024-05-06', 'Immediately', ' ../filepdf/receipt1.pdf', 'success', 'cancel', 'A001', 'C001'),
	('B002', 'lorry', '2024-07-12', 'Immediately', '../filepdf/receipt1.pdf', 'success', 'pending', 'A002', 'C002'),
	('B003', 'motorcycle', '2024-07-15', 'Pickup in 30 minutes', '../filepdf/receipt1.pdf', 'success', 'inProgress', 'A003', 'C003'),
	('B004', 'car', '2024-07-16', 'Pickup in 1 hour', '../filepdf/receipt1.pdf', 'success', 'inProgress', 'A004', 'C004'),
	('B005', 'motorcycle', '2024-07-22', 'Immediately', '../filepdf/receipt1.pdf', 'success', 'success', 'A005', 'C002'),
	('B006', 'car', '2024-07-23', 'Pickup in 30 minutes', '../filepdf/receipt1.pdf', 'success', 'success', 'A006', 'C001'),
	('B007', 'Motorcycle', '2024-06-01', 'Immediately', '../filepdf/MELISSA YURAN PENGAJIAN RESIT.pdf', 'pending', 'pending', 'A002', 'C001'),
	('B008', 'Motorcycle', '2024-06-01', 'Immediately', '../filepdf/YURAN MYTECC MELISSA SOFIA BINTI SHAHRAN.pdf', 'pending', 'pending', 'A001', 'C001'),
	('B009', 'Motorcycle', '2024-06-02', 'Immediately', '../filepdf/Screenshot 2024-04-19 003710.pdf', 'pending', 'cancel', 'A008', 'C008'),
	('B010', 'Motorcycle', '2024-06-02', 'Immediately', '../filepdf/Screenshot 2024-04-19 003710.pdf', 'success', 'pending', 'A008', 'C008');

-- Dumping structure for table ecoxchangedb.collection_record
CREATE TABLE IF NOT EXISTS `collection_record` (
  `collect_ID` varchar(10) NOT NULL,
  `collect_weight` float NOT NULL,
  `total_amount` decimal(6,2) NOT NULL,
  `collect_date` date NOT NULL,
  `collect_time` time NOT NULL,
  `reward_status` varchar(15) NOT NULL,
  `book_ID` varchar(10) NOT NULL,
  `item_ID` varchar(10) NOT NULL,
  `staff_ID` varchar(10) NOT NULL,
  PRIMARY KEY (`collect_ID`),
  KEY `book_ID` (`book_ID`,`item_ID`),
  KEY `fk3` (`staff_ID`),
  KEY `fk2` (`item_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table ecoxchangedb.collection_record: ~13 rows (approximately)
DELETE FROM `collection_record`;
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

-- Dumping structure for table ecoxchangedb.customer
CREATE TABLE IF NOT EXISTS `customer` (
  `cust_ID` varchar(10) NOT NULL,
  `cust_username` varchar(20) NOT NULL,
  `cust_password` varchar(128) NOT NULL,
  `cust_first_name` varchar(30) DEFAULT NULL,
  `cust_last_name` varchar(30) DEFAULT NULL,
  `cust_contact_no` varchar(12) DEFAULT NULL,
  `cust_email` varchar(30) NOT NULL,
  `cust_pict` varchar(255) DEFAULT NULL,
  `bank_id` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`cust_ID`),
  KEY `bank_id` (`bank_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table ecoxchangedb.customer: ~7 rows (approximately)
DELETE FROM `customer`;
INSERT INTO `customer` (`cust_ID`, `cust_username`, `cust_password`, `cust_first_name`, `cust_last_name`, `cust_contact_no`, `cust_email`, `cust_pict`, `bank_id`) VALUES
	('C001', 'melda', '$2y$10$8GeARt/071btIy0n2uEKZOrU3ONI8uTS3tjxn/7Y3hjQhD2UoQfNC', 'Melda', 'Hanaa', '0197789022', 'meldaa04@gmail.com', '../images/profile_pict/pict3.jpg', 'B101'),
	('C002', 'dinagfr', '$2y$10$3FNCw.4OHq530P0oPXc3ruE2MiBOKnegVyWQBtRaoUEpvp9ZyFThy', 'Irdina', 'Iman', '0127890879', 'dinagfr@yahoo.com', '../images/profile_pict/pict13.jpg', 'B102'),
	('C003', 'farah', '$2y$10$JpUsnyJOVyFlyarOu9Nrkeo5MDmlF/OXJ88AfSafHKO30.X8joKrm', 'Farah', 'Adibahh', '0192367890', 'farah@gmail.com', '../images/profile_pict/pict5.jpg', 'B103'),
	('C004', 'syuhada', '$2y$10$TQag7e.Ex5.H0DgWYEJtiuQpa0BBE3w3dhk.XDnlTVPgOyd3ST5YW', 'Siti', 'Nursyuhada', '0112309789', 'syuhada@yahoo.com', '../images/profile_pict/pict6.jpg', 'B104'),
	('C006', 'ahmadzaki', '$2y$10$ABhjHG.3oIUiU9Qp1/zvl.dRG.NDx/HHu5UN.NfmJpDsygdEe9J5C', 'Ahmad', 'Zaki', '01132323232', 'zaki@gmail.com', '../images/profile_pict/default.png', 'B105'),
	('C007', 'elly', '$2y$10$Q/GL4TjZ3cqMJXG4myKzbe8zGE4HWPtl/N5jRgusSZTZtuOneF8Sa', 'Ellysha', 'Diana', '', 'elly@gmail.com', '../images/profile-pict/C007.jpg', 'B106'),
	('C008', 'damien', '$2y$10$GsjEzk.eqttg.TMGlCmdDO4f45ASQn/eOOlcVHIc.HdrD41ktb4wm', NULL, NULL, NULL, 'damien@gmail.com', '../images/profile_pict/default.png', 'B108');

-- Dumping structure for table ecoxchangedb.item
CREATE TABLE IF NOT EXISTS `item` (
  `item_ID` varchar(10) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `item_price` decimal(16,2) DEFAULT NULL,
  `item_pict` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`item_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table ecoxchangedb.item: ~8 rows (approximately)
DELETE FROM `item`;
INSERT INTO `item` (`item_ID`, `item_name`, `item_price`, `item_pict`) VALUES
	('I001', 'Cardboard', 0.25, '../images/items/cardboard.png'),
	('I002', 'Old News Paper', 0.20, '../images/items/newpaper.png'),
	('I003', 'Black & White Paper', 0.35, '../images/items/bnw paper.png'),
	('I004', 'Plastic Bottle', 0.40, '../images/items/plasticBot.png'),
	('I005', 'Aluminium Can', 3.00, '../images/items/alCan.png'),
	('I006', 'Tin', 0.45, '../images/items/tin.png'),
	('I007', 'Glass', 0.40, '../images/items/glass bottle.png'),
	('I008', 'Used Cooking Oil', 3.00, '../images/items/usedOil.png');

-- Dumping structure for table ecoxchangedb.staff
CREATE TABLE IF NOT EXISTS `staff` (
  `staff_ID` varchar(10) NOT NULL,
  `staff_username` varchar(20) NOT NULL,
  `staff_password` varchar(200) NOT NULL,
  `staff_first_name` varchar(30) NOT NULL,
  `staff_last_name` varchar(30) NOT NULL,
  `staff_contact_no` varchar(12) NOT NULL,
  `staff_email` varchar(30) NOT NULL,
  `category` varchar(30) NOT NULL,
  `staff_pict` varchar(255) NOT NULL,
  PRIMARY KEY (`staff_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table ecoxchangedb.staff: ~5 rows (approximately)
DELETE FROM `staff`;
INSERT INTO `staff` (`staff_ID`, `staff_username`, `staff_password`, `staff_first_name`, `staff_last_name`, `staff_contact_no`, `staff_email`, `category`, `staff_pict`) VALUES
	('S001', 'meyalissa', '$2y$10$/PP.9qWHmj7TwwCIqEbJD.BU6VA9crKQR1vQuaoGY5ml.8Y/iLhQ6', 'Melissa', 'Sofia', '0136653982', 'melissa.sofia0204@gmail.com', 'admin', '../images/profile_pict/pict8.jpg'),
	('S002', 'fadlan', '$2y$10$h3A1.oalHCh/.qN6rl3iS.B42c8VWTA0HS2V6PdQtGHrFli/PQYTa', 'Fadlan', 'Amzar', '0187087819', 'fadlan04@gmail.com', 'rider', '../images/profile_pict/pict4.jpg'),
	('S003', 'dina', '$2y$10$rWvr6y7sugyvzHn9qjn09.Uofc8OlOO/5M9CJHZqHIJJEJnkEsZRK', 'Irdina', 'Ghafar', '0134768901', 'irdina.cntk@gmail.com', 'admin', '../images/profile_pict/pict12.jpg'),
	('S004', 'amira', '$2y$10$TyQowrCwmQhFwg.9weQgWuDC.f/B/wwkA8ekCmyc.1k2jmKHh/fEK', 'Amalia', 'Amira', '0123450987', 'amalia@gmail.com', 'admin', '../images/profile_pict/pict14.jpg'),
	('S005', 'Danial09', '$2y$10$nI1VlWDxvLpvgD8l.UI0qukD4YY/y9RuGlE7nJyZ64eqaQryXOQ8y', 'Danial', 'Amin', '0123450900', 'danial02.haikal@gmail.com', 'rider', '../images/profile_pict/pict11.jpg');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
