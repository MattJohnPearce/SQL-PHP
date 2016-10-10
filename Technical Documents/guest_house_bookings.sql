-- phpMyAdmin SQL Dump
-- version 4.6.0
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2016 at 05:56 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `guest_house_bookings`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `BookingID` int(10) NOT NULL,
  `DateFrom` varchar(10) DEFAULT NULL,
  `DateTo` varchar(10) DEFAULT NULL,
  `GuestHouseID_fk` int(10) DEFAULT NULL,
  `GuestID_fk` int(10) DEFAULT NULL,
  `RoomNumber_fk` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`BookingID`, `DateFrom`, `DateTo`, `GuestHouseID_fk`, `GuestID_fk`, `RoomNumber_fk`) VALUES
(1, '2016-06-06', '2016-06-10', 4, 1, 101),
(2, '2016-05-17', '2016-05-25', 1, 2, 102),
(3, '2016-05-12', '2016-06-12', 7, 3, 103),
(4, '2016-08-01', '2016-08-16', 9, 4, 101);

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `GuestID` int(10) NOT NULL,
  `FamilyName` varchar(20) NOT NULL,
  `FirstName` varchar(20) DEFAULT NULL,
  `Suburb` varchar(26) DEFAULT NULL,
  `StreetAddress` varchar(30) DEFAULT NULL,
  `Postcode` int(4) NOT NULL,
  `State` varchar(28) DEFAULT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(18) NOT NULL,
  `Marketing` varchar(250) DEFAULT NULL,
  `Feedback` varchar(250) DEFAULT NULL,
  `FutureImprov` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guests`
--

INSERT INTO `guests` (`GuestID`, `FamilyName`, `FirstName`, `Suburb`, `StreetAddress`, `Postcode`, `State`, `Email`, `Password`, `Marketing`, `Feedback`, `FutureImprov`) VALUES
(1, 'Pearce', 'Matthew', 'Kardinya', '41 Davies Cres', 6163, 'WA', 'mattjohnpearce@hotmail.com', '', 'Through the grape vine.', 'Place is alright', 'Mow the lawn again but this time leave it a little longer'),
(2, 'Max', 'Mad', 'Silverton', '7 Silverton Rd', 2880, 'NSW', 'madmax87@gmail.com', '', 'On the road.', 'Place is clean', 'Needs more salt'),
(3, 'Skywalker', 'Luke', 'Dunes', '221 Deserst Ln', 3783, 'VIC', 'lskywalker@msn.com', '', 'The force directed me to you', 'I like how theres no sand', 'I kinda miss the sand'),
(4, 'Croft', 'Lara', 'Croftby', '41 Wyree Rd', 4310, 'QLD', 'larac@eidos.com', '', 'Found a flyer on a cave wall', 'Nice pool', 'Prefer sovling puzzles to open doors rather than door knobs'),
(5, 'Bond', 'James', 'Bondi', '221 Bakers St', 2026, 'NSW', '007@HMSS.com', '', 'classified', 'top secret', 'retracted'),
(6, 'Tomata', 'Rosella', 'South Melbourne', '121 Cecil St', 3205, 'Victoria', 'tomtom@rosellagroup.com.au', 'tomtom', 'Reviews from goolge.', 'Nice and relaxing like a bowl of tomato soup', 'Needs more tomato sauce in the condiments'),
(7, 'Beard', 'Black', 'High Seas', '7 Seas', 0, 'WA', 'Mjp@hotmail.com', '', 'qwerty', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `GuestHouseID` int(10) NOT NULL,
  `Location` varchar(20) DEFAULT NULL,
  `City` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`GuestHouseID`, `Location`, `City`) VALUES
(1, 'Murdoch', 'Perth'),
(2, 'Northbridge', 'Perth'),
(3, 'Sunny Hills', 'Sydney'),
(4, 'Marrickville', 'Sydney'),
(5, 'Chapel Hill', 'Brisbane'),
(6, 'Fairfield', 'Brisbane'),
(7, 'Stuart Park', 'Darwin'),
(8, 'Wulagi', 'Darwin'),
(9, 'Edithvale', 'Melbourne'),
(10, 'Westmeadows', 'Melbourne');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `RoomNumber` int(3) NOT NULL,
  `NumOfBeds` int(2) DEFAULT NULL,
  `CostPerDay` double DEFAULT NULL,
  `Extras` char(1) DEFAULT NULL,
  `GuestHouseID_fk` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`RoomNumber`, `NumOfBeds`, `CostPerDay`, `Extras`, `GuestHouseID_fk`) VALUES
(101, 1, 150, 'y', NULL),
(102, 1, 120, 'n', NULL),
(103, 2, 115, 'n', NULL),
(104, 5, 250, 'n', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`BookingID`),
  ADD KEY `GstHse_bkns_idx` (`GuestHouseID_fk`),
  ADD KEY `GstID_bkns_idx` (`GuestID_fk`),
  ADD KEY `RmNo_bkns_idx` (`RoomNumber_fk`);

--
-- Indexes for table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`GuestID`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`GuestHouseID`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`RoomNumber`),
  ADD KEY `GstHse_idx` (`GuestHouseID_fk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `BookingID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `GuestID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `GuestHouseID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `RoomNumber` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bks_GstHse_Const` FOREIGN KEY (`GuestHouseID_fk`) REFERENCES `locations` (`GuestHouseID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bks_GstID_Const` FOREIGN KEY (`GuestID_fk`) REFERENCES `guests` (`GuestID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bks_RmNo_Const` FOREIGN KEY (`RoomNumber_fk`) REFERENCES `rooms` (`RoomNumber`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rms_GstHse_Const` FOREIGN KEY (`GuestHouseID_fk`) REFERENCES `locations` (`GuestHouseID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
