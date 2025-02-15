-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2025 at 07:52 AM
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
-- Database: `valorantdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `weaponstat`
--

CREATE TABLE `weaponstat` (
  `Name` varchar(50) NOT NULL,
  `Weapon_Type` varchar(20) NOT NULL,
  `Price` int(11) NOT NULL,
  `Fire_Rate` decimal(5,2) NOT NULL,
  `Wall_Penetration` varchar(10) NOT NULL,
  `Magazine_Capacity` int(11) NOT NULL,
  `HDMG_0` int(11) NOT NULL,
  `BDMG_0` int(11) NOT NULL,
  `LDMG_0` int(11) NOT NULL,
  `HDMG_1` int(11) NOT NULL,
  `BDMG_1` int(11) NOT NULL,
  `LDMG_1` int(11) NOT NULL,
  `HDMG_2` int(11) NOT NULL,
  `BDMG_2` int(11) NOT NULL,
  `LDMG_2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `weaponstat`
--

INSERT INTO `weaponstat` (`Name`, `Weapon_Type`, `Price`, `Fire_Rate`, `Wall_Penetration`, `Magazine_Capacity`, `HDMG_0`, `BDMG_0`, `LDMG_0`, `HDMG_1`, `BDMG_1`, `LDMG_1`, `HDMG_2`, `BDMG_2`, `LDMG_2`) VALUES
('Ares', 'Heavy', 1600, 10.00, '3', 50, 72, 30, 25, 72, 30, 25, 67, 28, 23),
('Bucky', 'Shotgun', 900, 1.10, '1', 5, 55, 22, 19, 34, 17, 14, 18, 9, 8),
('Bulldog', 'Rifle', 2100, 9.15, '2', 24, 116, 35, 30, 116, 35, 30, 116, 35, 30),
('Classic', 'Sidearm', 0, 6.75, '1', 12, 78, 26, 22, 78, 26, 22, 66, 22, 18),
('Frenzy', 'Sidearm', 400, 10.00, '1', 13, 78, 26, 22, 63, 21, 17, 63, 21, 17),
('Ghost', 'Sidearm', 500, 6.75, '2', 15, 105, 33, 26, 88, 25, 21, 88, 25, 21),
('Guardian', 'Rifle', 2500, 6.50, '2', 12, 195, 65, 49, 195, 65, 49, 195, 65, 49),
('Judge', 'Shotgun', 1500, 3.50, '2', 7, 34, 17, 14, 26, 13, 11, 20, 10, 9),
('Marshall', 'Sniper', 1100, 1.50, '2', 5, 202, 101, 85, 202, 101, 85, 202, 101, 85),
('Odin', 'Heavy', 3200, 12.00, '3', 100, 95, 38, 32, 95, 38, 32, 77, 31, 26),
('Operator', 'Sniper', 4500, 0.75, '3', 5, 255, 150, 127, 255, 150, 127, 255, 150, 127),
('Phantom', 'Rifle', 2900, 11.00, '2', 30, 156, 39, 33, 140, 35, 30, 124, 31, 26),
('Sheriff', 'Sidearm', 800, 4.00, '3', 6, 160, 55, 47, 160, 55, 47, 145, 50, 43),
('Shorty', 'Sidearm', 200, 3.30, '1', 2, 36, 12, 10, 24, 8, 6, 9, 3, 2),
('Spectre', 'SMG', 1600, 13.33, '2', 30, 78, 26, 22, 66, 22, 18, 66, 22, 18),
('Stinger', 'SMG', 1000, 18.00, '1', 20, 67, 27, 23, 62, 25, 21, 62, 25, 21),
('Vandal', 'Rifle', 2900, 9.25, '2', 25, 156, 39, 33, 156, 39, 33, 156, 39, 33);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `weaponstat`
--
ALTER TABLE `weaponstat`
  ADD PRIMARY KEY (`Name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
