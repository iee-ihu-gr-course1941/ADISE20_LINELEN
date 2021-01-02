-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Φιλοξενητής: 127.0.0.1
-- Χρόνος δημιουργίας: 02 Ιαν 2021 στις 13:40:39
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
-- Βάση δεδομένων: `project_db`
--

DELIMITER $$
--
-- Διαδικασίες
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `clean_board` ()  BEGIN
	REPLACE INTO board SELECT * FROM board_empty;
    UPDATE players SET username=null, token=null;
    UPDATE game_status SET `status`='not active', p_turn=null, result=null;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deal_cards` (IN `n` TINYINT, IN `position` VARCHAR(5))  BEGIN
	UPDATE board
	SET c_position=position
	WHERE card_id IN
	(SELECT card_id
		FROM (SELECT card_id
			FROM board
                	WHERE c_position='deck'
			ORDER BY c_order
			LIMIT n) as x);
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `play_card` (IN `c_id` TINYINT)  BEGIN
	UPDATE board
    SET c_position='stack'
    WHERE c_position='top';
    
    UPDATE board
	SET c_position='top'
	WHERE card_id=c_id;
    
    UPDATE game_status
    SET p_turn=if(p_turn=1,2,1);
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `win_stack` (IN `p_id` TINYINT, IN `c_id` TINYINT)  BEGIN
	UPDATE board
	SET c_position=if(p_id=1,'stack1','stack2')
	WHERE c_position='top' or card_id=c_id;

	UPDATE game_status
    	SET p_turn=if(p_turn=1,2,1);
    END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `board`
--

CREATE TABLE `board` (
  `card_id` tinyint(4) NOT NULL,
  `c_value` tinyint(4) NOT NULL,
  `c_score` tinyint(4) NOT NULL,
  `c_position` enum('deck','stack','top','hand1','hand2','stack1','stack2') COLLATE utf8mb4_bin NOT NULL DEFAULT 'deck',
  `c_order` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Άδειασμα δεδομένων του πίνακα `board`
--

INSERT INTO `board` (`card_id`, `c_value`, `c_score`, `c_position`, `c_order`) VALUES
(1, 1, 1, 'deck', NULL),
(2, 2, 2, 'deck', NULL),
(3, 3, 3, 'deck', NULL),
(4, 4, 4, 'deck', NULL),
(5, 5, 5, 'deck', NULL),
(6, 6, 6, 'deck', NULL),
(7, 7, 7, 'deck', NULL),
(8, 8, 8, 'deck', NULL),
(9, 9, 9, 'deck', NULL),
(10, 10, 10, 'deck', NULL),
(11, 11, 3, 'deck', NULL),
(12, 12, 12, 'deck', NULL),
(13, 13, 13, 'deck', NULL),
(14, 1, 1, 'deck', NULL),
(15, 2, 2, 'deck', NULL),
(16, 3, 3, 'deck', NULL),
(17, 4, 4, 'deck', NULL),
(18, 5, 5, 'deck', NULL),
(19, 6, 6, 'deck', NULL),
(20, 7, 7, 'deck', NULL),
(21, 8, 8, 'deck', NULL),
(22, 9, 9, 'deck', NULL),
(23, 10, 10, 'deck', NULL),
(24, 11, 3, 'deck', NULL),
(25, 12, 12, 'deck', NULL),
(26, 13, 13, 'deck', NULL),
(27, 1, 1, 'deck', NULL),
(28, 2, 2, 'deck', NULL),
(29, 3, 3, 'deck', NULL),
(30, 4, 4, 'deck', NULL),
(31, 5, 5, 'deck', NULL),
(32, 6, 6, 'deck', NULL),
(33, 7, 7, 'deck', NULL),
(34, 8, 8, 'deck', NULL),
(35, 9, 9, 'deck', NULL),
(36, 10, 10, 'deck', NULL),
(37, 11, 3, 'deck', NULL),
(38, 12, 12, 'deck', NULL),
(39, 13, 13, 'deck', NULL),
(40, 1, 1, 'deck', NULL),
(41, 2, 2, 'deck', NULL),
(42, 3, 3, 'deck', NULL),
(43, 4, 4, 'deck', NULL),
(44, 5, 5, 'deck', NULL),
(45, 6, 6, 'deck', NULL),
(46, 7, 7, 'deck', NULL),
(47, 8, 8, 'deck', NULL),
(48, 9, 9, 'deck', NULL),
(49, 10, 10, 'deck', NULL),
(50, 11, 3, 'deck', NULL),
(51, 12, 12, 'deck', NULL),
(52, 13, 13, 'deck', NULL);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `board_empty`
--

CREATE TABLE `board_empty` (
  `card_id` tinyint(4) NOT NULL,
  `c_value` tinyint(4) NOT NULL,
  `c_score` tinyint(4) NOT NULL,
  `c_position` enum('deck','stack','top','hand1','hand2','stack1','stack2') COLLATE utf8mb4_bin NOT NULL DEFAULT 'deck',
  `c_order` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Άδειασμα δεδομένων του πίνακα `board_empty`
--

INSERT INTO `board_empty` (`card_id`, `c_value`, `c_score`, `c_position`, `c_order`) VALUES
(1, 1, 1, 'deck', NULL),
(2, 2, 2, 'deck', NULL),
(3, 3, 3, 'deck', NULL),
(4, 4, 4, 'deck', NULL),
(5, 5, 5, 'deck', NULL),
(6, 6, 6, 'deck', NULL),
(7, 7, 7, 'deck', NULL),
(8, 8, 8, 'deck', NULL),
(9, 9, 9, 'deck', NULL),
(10, 10, 10, 'deck', NULL),
(11, 11, 3, 'deck', NULL),
(12, 12, 12, 'deck', NULL),
(13, 13, 13, 'deck', NULL),
(14, 1, 1, 'deck', NULL),
(15, 2, 2, 'deck', NULL),
(16, 3, 3, 'deck', NULL),
(17, 4, 4, 'deck', NULL),
(18, 5, 5, 'deck', NULL),
(19, 6, 6, 'deck', NULL),
(20, 7, 7, 'deck', NULL),
(21, 8, 8, 'deck', NULL),
(22, 9, 9, 'deck', NULL),
(23, 10, 10, 'deck', NULL),
(24, 11, 3, 'deck', NULL),
(25, 12, 12, 'deck', NULL),
(26, 13, 13, 'deck', NULL),
(27, 1, 1, 'deck', NULL),
(28, 2, 2, 'deck', NULL),
(29, 3, 3, 'deck', NULL),
(30, 4, 4, 'deck', NULL),
(31, 5, 5, 'deck', NULL),
(32, 6, 6, 'deck', NULL),
(33, 7, 7, 'deck', NULL),
(34, 8, 8, 'deck', NULL),
(35, 9, 9, 'deck', NULL),
(36, 10, 10, 'deck', NULL),
(37, 11, 3, 'deck', NULL),
(38, 12, 12, 'deck', NULL),
(39, 13, 13, 'deck', NULL),
(40, 1, 1, 'deck', NULL),
(41, 2, 2, 'deck', NULL),
(42, 3, 3, 'deck', NULL),
(43, 4, 4, 'deck', NULL),
(44, 5, 5, 'deck', NULL),
(45, 6, 6, 'deck', NULL),
(46, 7, 7, 'deck', NULL),
(47, 8, 8, 'deck', NULL),
(48, 9, 9, 'deck', NULL),
(49, 10, 10, 'deck', NULL),
(50, 11, 3, 'deck', NULL),
(51, 12, 12, 'deck', NULL),
(52, 13, 13, 'deck', NULL);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `game_status`
--

CREATE TABLE `game_status` (
  `s_id` int(11) NOT NULL,
  `status` enum('not active','initialized','started','ended','aborted') COLLATE utf8mb4_bin NOT NULL DEFAULT 'not active',
  `p_turn` tinyint(4) DEFAULT NULL,
  `result` tinyint(4) DEFAULT NULL,
  `last_change` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Άδειασμα δεδομένων του πίνακα `game_status`
--

INSERT INTO `game_status` (`s_id`, `status`, `p_turn`, `result`, `last_change`) VALUES
(1, 'not active', NULL, NULL, '2021-01-02 11:21:38');

--
-- Δείκτες `game_status`
--
DELIMITER $$
CREATE TRIGGER `game_status_update` BEFORE UPDATE ON `game_status` FOR EACH ROW BEGIN
    	SET NEW.last_change = NOW();
	END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `players`
--

CREATE TABLE `players` (
  `p_id` tinyint(4) NOT NULL,
  `username` varchar(20) COLLATE utf8mb4_bin DEFAULT NULL,
  `token` varchar(32) COLLATE utf8mb4_bin DEFAULT NULL,
  `last_action` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Άδειασμα δεδομένων του πίνακα `players`
--

INSERT INTO `players` (`p_id`, `username`, `token`, `last_action`) VALUES
(1, NULL, NULL, '2021-01-02 11:21:37'),
(2, NULL, NULL, '2021-01-02 11:21:37');

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `board`
--
ALTER TABLE `board`
  ADD PRIMARY KEY (`card_id`);

--
-- Ευρετήρια για πίνακα `board_empty`
--
ALTER TABLE `board_empty`
  ADD PRIMARY KEY (`card_id`);

--
-- Ευρετήρια για πίνακα `game_status`
--
ALTER TABLE `game_status`
  ADD PRIMARY KEY (`s_id`);

--
-- Ευρετήρια για πίνακα `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`p_id`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `board`
--
ALTER TABLE `board`
  MODIFY `card_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT για πίνακα `board_empty`
--
ALTER TABLE `board_empty`
  MODIFY `card_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT για πίνακα `game_status`
--
ALTER TABLE `game_status`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT για πίνακα `players`
--
ALTER TABLE `players`
  MODIFY `p_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
