-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2024 at 08:22 AM
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
-- Database: `purrfectpetsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminaccount`
--

CREATE TABLE `adminaccount` (
  `adminID` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password_hash` varchar(20) NOT NULL,
  `pic_url` text NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adminaccount`
--

INSERT INTO `adminaccount` (`adminID`, `username`, `password_hash`, `pic_url`, `first_name`, `last_name`) VALUES
(1, 'jayn95', 'sv216', 'Song Kang.png', 'Jay', 'N'),
(2, 'aozicode', '0903', '', 'Ashley', 'Feliciano'),
(3, 'plnjbautista', '0511', '', 'Pauline', 'Bautista'),
(4, 'patsyjoseph', '5678', '../uploads/OIP (4).jpg', 'Patrick', 'Napud');

-- --------------------------------------------------------

--
-- Table structure for table `animalprofiles`
--

CREATE TABLE `animalprofiles` (
  `petID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `breed` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `image_url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `animalprofiles`
--

INSERT INTO `animalprofiles` (`petID`, `name`, `breed`, `description`, `image_url`) VALUES
(16, 'Yamyam', 'Puspin', 'Confident and charming, Yamyam struts through campus with style, captivating everyone he meets with his personality.', '../uploads/pet6.png'),
(17, 'Katy', 'Puspin', 'Despite her mean appearance, Katy is a friendly cat with a heart of gold.', '../uploads/pet8.png'),
(18, 'Tricia', 'Puspin', 'A silent observer of the night, Tricia\'s mysterious nature hides a playful streak beneath her light fur.', '../uploads/pet9.png'),
(19, 'Pocholo', 'Aspin', 'With a sunny vibe and a love for playtime, Pocholo is an popular for the Taga-West community.', '../uploads/pet1.png'),
(21, 'Mama', 'Aspin', 'With her soulful eyes and gentle demeanor, Mama is a calming presence in the gardens of General Services Office.', '../uploads/pet2.png'),
(29, 'Butchog', 'Aspin', 'With boundless energy and a love for adventure, Butchog brings joy wherever he goes with his colorful personality.', '../uploads/pet5.png'),
(78, 'Michael', 'Dog', 'Basketbolista', '../uploads/pet8.png');

-- --------------------------------------------------------

--
-- Table structure for table `forum_comments`
--

CREATE TABLE `forum_comments` (
  `comment_id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `comment` varchar(1000) NOT NULL,
  `comment_img` blob NOT NULL,
  `comment_date` datetime NOT NULL DEFAULT current_timestamp(),
  `username` varchar(100) NOT NULL,
  `content_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forum_comments`
--

INSERT INTO `forum_comments` (`comment_id`, `userID`, `comment`, `comment_img`, `comment_date`, `username`, `content_id`) VALUES
(1, 16, 'Cutiee!', '', '2024-05-11 20:28:32', '', 1),
(2, 16, 'Hakdog!', '', '2024-05-11 20:28:48', '', 1),
(3, 1, 'hoho', '', '2024-05-13 14:52:01', '', 1),
(4, 17, 'hi;ok;lk;', '', '2024-05-16 07:21:59', '', 2),
(5, 18, 'cuteee', '', '2024-05-16 15:32:04', '', 1),
(6, 1, 'Hi.', '', '2024-05-21 18:52:24', '', 13),
(7, 1, 'Hello', '', '2024-05-21 20:31:43', '', 13);

-- --------------------------------------------------------

--
-- Table structure for table `forum_subject`
--

CREATE TABLE `forum_subject` (
  `content_id` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `fcontent` varchar(200) DEFAULT NULL,
  `comment` varchar(200) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `picture` text NOT NULL,
  `userID` int(11) NOT NULL,
  `username` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forum_subject`
--

INSERT INTO `forum_subject` (`content_id`, `title`, `fcontent`, `comment`, `date_created`, `picture`, `userID`, `username`) VALUES
(1, 'Rainbows and Dreams', 'Indulge with the cuteness of our fur babies.', '', '2024-05-11 20:25:12', '../uploads/cho-lap-xuong-khi-cuoi.jpg', 16, ''),
(2, 'The Enigmatic World of Cats: A Closer Look into Our Feline Friends', 'Cats: mysterious, elegant, and endlessly fascinating. These enigmatic creatures have captured the hearts of humans for centuries, their grace and independence earning them a revered place in our homes', '', '2024-05-13 15:28:01', '../uploads/cat3.jpg', 1, ''),
(13, 'hello!', 'for testing lang', '', '2024-05-21 18:50:28', '../uploads/cute.jpg', 1, ''),
(14, 'Hello World!', 'Blehhhhhh', '', '2024-05-21 20:29:55', '../uploads/pexels-hossamashoor-14913190.jpg', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `reactions`
--

CREATE TABLE `reactions` (
  `reactionID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `petID` int(11) NOT NULL,
  `reacted_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `liked` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reactions`
--

INSERT INTO `reactions` (`reactionID`, `userID`, `petID`, `reacted_at`, `liked`) VALUES
(12, 17, 18, '2024-05-15 23:21:27', 1),
(14, 17, 78, '2024-05-16 03:10:41', 1),
(19, 1, 78, '2024-05-17 06:14:47', 1),
(26, 1, 21, '2024-05-21 10:46:40', 1),
(27, 1, 16, '2024-05-21 12:27:25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `temp_animal_submissions`
--

CREATE TABLE `temp_animal_submissions` (
  `petID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `breed` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `temp_animal_submissions`
--

INSERT INTO `temp_animal_submissions` (`petID`, `name`, `breed`, `description`, `image_url`) VALUES
(36, 'Serena', 'Cat', 'Black', 'IMG-662a6790325a15.03671601.jpg'),
(37, 'Pinch', 'Dog', 'Brown and White', 'IMG-662a67a70049f2.46991979.jpg'),
(40, 'Krishnah', 'Aspin', 'Masabad kag magahod.', 'IMG-66389edff092e5.15200780.jpg'),
(41, 'Bear', 'dog', 'jio', 'IMG-663de16b332fd7.31866590.png');

-- --------------------------------------------------------

--
-- Table structure for table `temp_user_account`
--

CREATE TABLE `temp_user_account` (
  `userID` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image_prof` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `temp_user_account`
--

INSERT INTO `temp_user_account` (`userID`, `username`, `first_name`, `last_name`, `email_address`, `password`, `image_prof`) VALUES
(14, 'aozicode', 'Ashley', 'Feliciano', '123@gmail.com', '0903', ''),
(15, 'plnjbautista', 'Pauline', 'Bautista', '456@gmail.com', '0511', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE `user_account` (
  `userID` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image_prof` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`userID`, `username`, `first_name`, `last_name`, `email_address`, `password`, `image_prof`) VALUES
(1, 'lily08', 'Lily', 'Cruz', 'lilycruz@gmail.com', 'ivy13', 'Rarity.jpg'),
(2, 'orion18', 'Orion', 'Hunter', 'orionthehunter@gmail.com', 'orion012', 'RB.jpg'),
(3, 'lovesomeone<3', 'Lukas', 'Graham', 'lukasgraham@gmail.com', 'real45', 'TS.jpg'),
(4, 'ilavkat06', 'Pika', 'Chu', 'katsu234@gmail.com', 'meh4h', 'Fluttershy.jpg'),
(14, 'iamselena', 'Selena ', 'Gomez ', 'selena@yahoo.com ', 'jfo35 ', ''),
(15, 'jillnavarra03', 'Jill ', 'Navarra ', 'jill60579@gmail.com ', '2003 ', ''),
(16, 'micthyla', 'kitkat ', 'smith ', 'chinniesquirl@gmail.com ', 'kitkatbato ', ''),
(17, 'aozi', 'Denise ', 'Fel ', 'efg@gmail.com ', 'dog123 ', ''),
(18, 'ashley20', 'Ashley ', 'Bautista ', 'ashley@gmail.com ', 'ashley123 ', ''),
(19, 'ashley20', 'Ashley ', 'Bautista ', 'ashley@gmail.com ', 'ashley123 ', ''),
(20, 'cris', 'Chris ', 'Dela Cruz ', '1234@gmail.com ', '123 ', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminaccount`
--
ALTER TABLE `adminaccount`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `animalprofiles`
--
ALTER TABLE `animalprofiles`
  ADD PRIMARY KEY (`petID`);

--
-- Indexes for table `forum_comments`
--
ALTER TABLE `forum_comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `fk_usid` (`userID`),
  ADD KEY `fk_cont` (`content_id`);

--
-- Indexes for table `forum_subject`
--
ALTER TABLE `forum_subject`
  ADD PRIMARY KEY (`content_id`),
  ADD KEY `fk_use` (`userID`);

--
-- Indexes for table `reactions`
--
ALTER TABLE `reactions`
  ADD PRIMARY KEY (`reactionID`),
  ADD KEY `fk_user` (`userID`),
  ADD KEY `fk_newstray` (`petID`);

--
-- Indexes for table `temp_animal_submissions`
--
ALTER TABLE `temp_animal_submissions`
  ADD PRIMARY KEY (`petID`);

--
-- Indexes for table `temp_user_account`
--
ALTER TABLE `temp_user_account`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminaccount`
--
ALTER TABLE `adminaccount`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `animalprofiles`
--
ALTER TABLE `animalprofiles`
  MODIFY `petID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `forum_comments`
--
ALTER TABLE `forum_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `forum_subject`
--
ALTER TABLE `forum_subject`
  MODIFY `content_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `reactions`
--
ALTER TABLE `reactions`
  MODIFY `reactionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `temp_animal_submissions`
--
ALTER TABLE `temp_animal_submissions`
  MODIFY `petID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `temp_user_account`
--
ALTER TABLE `temp_user_account`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user_account`
--
ALTER TABLE `user_account`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `forum_comments`
--
ALTER TABLE `forum_comments`
  ADD CONSTRAINT `fk_cont` FOREIGN KEY (`content_id`) REFERENCES `forum_subject` (`content_id`),
  ADD CONSTRAINT `fk_usid` FOREIGN KEY (`userID`) REFERENCES `user_account` (`userID`);

--
-- Constraints for table `forum_subject`
--
ALTER TABLE `forum_subject`
  ADD CONSTRAINT `fk_use` FOREIGN KEY (`userID`) REFERENCES `user_account` (`userID`);

--
-- Constraints for table `reactions`
--
ALTER TABLE `reactions`
  ADD CONSTRAINT `fk_newstray` FOREIGN KEY (`petID`) REFERENCES `animalprofiles` (`petID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`userID`) REFERENCES `user_account` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
