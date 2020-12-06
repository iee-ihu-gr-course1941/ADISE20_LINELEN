-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Φιλοξενητής: 127.0.0.1
-- Χρόνος δημιουργίας: 06 Δεκ 2020 στις 15:40:06
-- Έκδοση διακομιστή: 10.4.8-MariaDB
-- Έκδοση PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `dbgame`
--

-- --------------------------------------------------------


CREATE TABLE `cards` (
  `id` int(11) NOT NULL,
  `card_name` text NOT NULL,
  `card_value` text NOT NULL,
  `owner` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `cards` (`id`, `card_name`, `card_value`, `owner`) VALUES
(1, 'H1', '1', NULL),
(2, 'H2', '2', NULL),
(3, 'H3', '3', NULL),
(4, 'H4', '4', NULL),
(5, 'H5', '5', NULL),
(6, 'H6', '6', NULL),
(7, 'H7', '7', NULL),
(8, 'H8', '8', NULL),
(9, 'H9', '9', NULL),
(10, 'H10', '10', NULL),
(11, 'HJ', 'J', NULL),
(12, 'HQ', 'Q', NULL),
(13, 'HK', 'K', NULL),
(14, 'C1', '1', NULL),
(15, 'C2', '2', NULL),
(16, 'C3', '3', NULL),
(17, 'C4', '4', NULL),
(18, 'C5', '5', NULL),
(19, 'C6', '6', NULL),
(20, 'C7', '7', NULL),
(21, 'C8', '8', NULL),
(22, 'C9', '9', NULL),
(23, 'C10', '10', NULL),
(24, 'CJ', 'J', NULL),
(25, 'CQ', 'Q', NULL),
(26, 'CK', 'K', NULL),
(27, 'S1', '1', NULL),
(28, 'S2', '2', NULL),
(29, 'S3', '3', NULL),
(30, 'S4', '4', NULL),
(31, 'S5', '5', NULL),
(32, 'S6', '6', NULL),
(33, 'S7', '7', NULL),
(34, 'S8', '8', NULL),
(35, 'S9', '9', NULL),
(36, 'S10', '10', NULL),
(37, 'SJ', 'J', NULL),
(38, 'SQ', 'Q', NULL),
(39, 'SK', 'K', NULL),
(40, 'T1', '1', NULL),
(41, 'T2', '2', NULL),
(42, 'T3', '3', NULL),
(43, 'T4', '4', NULL),
(44, 'T5', '5', NULL),
(45, 'T6', '6', NULL),
(46, 'T7', '7', NULL),
(47, 'T8', '8', NULL),
(48, 'T9', '9', NULL),
(49, 'T10', '10', NULL),
(50, 'TJ', 'J', NULL),
(51, 'TQ', 'Q', NULL),
(52, 'TK', 'K', NULL);

CREATE TABLE `played_cards` (
  `id` int(11) NOT NULL,
  `card_name` text NOT NULL,
  `card_value` text NOT NULL,
  `owner` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `played_cards` (`id`, `card_name`, `card_value`, `owner`) VALUES
(1, 'H1', '1', NULL),
(2, 'H2', '2', NULL),
(3, 'H3', '3', NULL),
(4, 'H4', '4', NULL),
(5, 'H5', '5', NULL),
(6, 'H6', '6', NULL),
(7, 'H7', '7', NULL),
(8, 'H8', '8', NULL),
(9, 'H9', '9', NULL),
(10, 'H10', '10', NULL),
(11, 'HJ', 'J', NULL),
(12, 'HQ', 'Q', NULL),
(13, 'HK', 'K', NULL),
(14, 'C1', '1', NULL),
(15, 'C2', '2', NULL),
(16, 'C3', '3', NULL),
(17, 'C4', '4', NULL),
(18, 'C5', '5', NULL),
(19, 'C6', '6', NULL),
(20, 'C7', '7', NULL),
(21, 'C8', '8', NULL),
(22, 'C9', '9', NULL),
(23, 'C10', '10', NULL),
(24, 'CJ', 'J', NULL),
(25, 'CQ', 'Q', NULL),
(26, 'CK', 'K', NULL),
(27, 'S1', '1', NULL),
(28, 'S2', '2', NULL),
(29, 'S3', '3', NULL),
(30, 'S4', '4', NULL),
(31, 'S5', '5', NULL),
(32, 'S6', '6', NULL),
(33, 'S7', '7', NULL),
(34, 'S8', '8', NULL),
(35, 'S9', '9', NULL),
(36, 'S10', '10', NULL),
(37, 'SJ', 'J', NULL),
(38, 'SQ', 'Q', NULL),
(39, 'SK', 'K', NULL),
(40, 'T1', '1', NULL),
(41, 'T2', '2', NULL),
(42, 'T3', '3', NULL),
(43, 'T4', '4', NULL),
(44, 'T5', '5', NULL),
(45, 'T6', '6', NULL),
(46, 'T7', '7', NULL),
(47, 'T8', '8', NULL),
(48, 'T9', '9', NULL),
(49, 'T10', '10', NULL),
(50, 'TJ', 'J', NULL),
(51, 'TQ', 'Q', NULL),
(52, 'TK', 'K', NULL);


CREATE TABLE `start` (
  `games` text DEFAULT NULL,
  `turn` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `game`
--

INSERT INTO `start` (`games`, `turn`) VALUES
('started', 'Eleni');

--
-- Δομή πίνακα για τον πίνακα `login`
--

CREATE TABLE `login` (
  `Id` text NOT NULL,
  `Username` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
COMMIT;

INSERT INTO `login` (`Id`, `Username`) VALUES
('Id1', 'Eleni'),
('Id2', 'Lina');

ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `played_cards`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

ALTER TABLE `played_cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
