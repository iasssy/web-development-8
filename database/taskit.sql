-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jul 19, 2024 at 01:22 PM
-- Server version: 5.7.24
-- PHP Version: 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `taskit`
--
CREATE DATABASE IF NOT EXISTS `taskit` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `taskit`;

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

DROP TABLE IF EXISTS `contact_us`;
CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `comment` text NOT NULL,
  `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `username`, `email`, `comment`, `time_created`) VALUES
(4, 'nh', 'gyhj@fgd.com', 'ghj', '2024-07-19 16:24:03'),
(5, 'Mary', 'm.johns@mail.com', 'dfgd gfdgfd gfdh gf', '2024-07-19 17:07:29');

-- --------------------------------------------------------

--
-- Table structure for table `lists`
--

DROP TABLE IF EXISTS `lists`;
CREATE TABLE `lists` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `list_color` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lists`
--

INSERT INTO `lists` (`id`, `name`, `list_color`) VALUES
(1, 'Music', NULL),
(2, 'Personal', NULL),
(3, 'Shopping', NULL),
(4, 'Travel', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reminders`
--

DROP TABLE IF EXISTS `reminders`;
CREATE TABLE `reminders` (
  `id` int(11) NOT NULL,
  `task_id` int(11) DEFAULT NULL,
  `reminder_time` datetime DEFAULT NULL,
  `repeat_interval` int(11) DEFAULT NULL,
  `repeat_end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Stand-in structure for view `tasklistview`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `tasklistview`;
CREATE TABLE `tasklistview` (
`task_id` int(11)
,`task_title` varchar(300)
,`task_description` text
,`user_id` int(11)
,`task_due_date` timestamp
,`task_completed` tinyint(1)
,`list_id` int(11)
,`list_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `title` varchar(300) DEFAULT NULL,
  `description` text,
  `user_id` int(11) DEFAULT NULL,
  `list_order` int(11) DEFAULT '1',
  `list_id` int(11) DEFAULT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `due_date` timestamp NULL DEFAULT NULL,
  `completed` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `description`, `user_id`, `list_order`, `list_id`, `creation_date`, `due_date`, `completed`) VALUES
(1, 'Compose lyrics and melody for upcoming album', 'Work again on the new album\'s main track.', 1, 1, 1, '2024-07-19 00:00:00', NULL, 0),
(2, 'Approve designs for the new album cover', 'Review the final designs for the new album cover', 1, 1, 1, '2024-07-15 20:45:31', NULL, 0),
(3, 'Photoshoot for magazine cover', '', 1, 1, 1, '2024-07-14 20:45:31', NULL, 0),
(4, 'Rehearsal with the band for upcoming tour', '', 1, 1, 1, '2024-07-14 20:45:31', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar_image` varchar(200) DEFAULT NULL,
  `email` varchar(200) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `avatar_image`, `email`, `registration_date`) VALUES
(1, 'Harry Styles', '123123', NULL, 'h.styles@gmail.com', '2024-07-19 03:42:41');

-- --------------------------------------------------------

--
-- Structure for view `tasklistview`
--
DROP TABLE IF EXISTS `tasklistview`;

DROP VIEW IF EXISTS `tasklistview`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tasklistview`  AS SELECT `t`.`id` AS `task_id`, `t`.`title` AS `task_title`, `t`.`description` AS `task_description`, `t`.`user_id` AS `user_id`, `t`.`due_date` AS `task_due_date`, `t`.`completed` AS `task_completed`, `l`.`id` AS `list_id`, `l`.`name` AS `list_name` FROM (`tasks` `t` join `lists` `l` on((`t`.`list_id` = `l`.`id`)))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lists`
--
ALTER TABLE `lists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `reminders`
--
ALTER TABLE `reminders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_id` (`task_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `list_id` (`list_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lists`
--
ALTER TABLE `lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reminders`
--
ALTER TABLE `reminders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reminders`
--
ALTER TABLE `reminders`
  ADD CONSTRAINT `reminders_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`);

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tasks_ibfk_2` FOREIGN KEY (`list_id`) REFERENCES `lists` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
