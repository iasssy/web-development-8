-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jul 26, 2024 at 11:45 AM
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
-- Database: `fsd12_08`
--
CREATE DATABASE IF NOT EXISTS `fsd12_08` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `fsd12_08`;

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
(43, 'Mary', 'm.johns@mail.com', 'df gfgh hghgf hftg ftg fg', '2024-07-22 12:55:52'),
(44, 'Mary', 'm.johns@mail.com', 'df gfgh hghgf hftg ftg fg', '2024-07-22 13:08:48'),
(45, 'Mary', 'm.johns@mail.com', 'ffjb u gj  giuiu uig itiu', '2024-07-22 13:23:35'),
(46, 'Mary', 'm.johns@mail.com', 'fd g gggf hg fg f gf', '2024-07-22 14:18:08'),
(47, 'Mary', 'juls@example.com', 'fhgfh f ghfg ftg', '2024-07-23 01:56:15'),
(48, 'sdfdgffdgd', 'juls@example.com', 'dff fdgdgd fg', '2024-07-26 14:30:37');

-- --------------------------------------------------------

--
-- Table structure for table `lists`
--

DROP TABLE IF EXISTS `lists`;
CREATE TABLE `lists` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `list_order` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lists`
--

INSERT INTO `lists` (`id`, `title`, `user_id`, `list_order`) VALUES
(1, 'Music', 1, 1),
(2, 'Personal', 1, 2),
(3, 'Shopping', 1, 3),
(4, 'Travel', 1, 4),
(86, 'List X', 1, 0);

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
,`task_order` int(11)
,`list_id` int(11)
,`creation_date` timestamp
,`due_date` timestamp
,`completed` tinyint(1)
,`importance` tinyint(1)
,`list_title` varchar(255)
,`list_order` int(11)
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
  `task_order` int(11) DEFAULT '1',
  `list_id` int(11) DEFAULT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `due_date` timestamp NULL DEFAULT NULL,
  `completed` tinyint(1) DEFAULT '0',
  `importance` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `description`, `user_id`, `task_order`, `list_id`, `creation_date`, `due_date`, `completed`, `importance`) VALUES
(1, 'Compose lyrics and melody for upcoming album', 'Work again on the new album\'s main track.', 1, 1, 1, '2024-07-19 00:00:00', '2024-07-24 14:42:46', 0, 0),
(2, 'Approve designs for the new album cover', 'Review the final designs for the new album cover', 1, 1, 1, '2024-07-15 20:45:31', NULL, 0, 1),
(3, 'Photoshoot for magazine cover', '', 1, 1, 1, '2024-07-14 20:45:31', NULL, 1, 1),
(4, 'Rehearsal with the band for upcoming tour', '', 1, 1, 1, '2024-07-14 20:45:31', NULL, 0, 1),
(12, 'Beachfront Mansion in Malibu', '', 1, 1, 3, '2024-07-25 14:45:45', NULL, 1, 0),
(13, 'Penthouse in New York City', '', 1, 1, 3, '2024-07-25 14:46:29', NULL, 0, 0),
(14, 'Private Yacht', '', 1, 1, 3, '2024-07-25 14:49:53', NULL, 1, 0),
(15, 'Schedule a Relaxation Day', '', 1, 1, 2, '2024-07-25 14:51:37', NULL, 0, 0),
(16, 'Attend Charity Events', '', 1, 1, 2, '2024-07-25 14:51:53', NULL, 1, 0),
(17, 'Plan a Family Gathering', '', 1, 1, 2, '2024-07-25 14:52:08', NULL, 0, 1),
(18, 'Explore New Music Genres', '', 1, 1, 2, '2024-07-25 14:56:47', NULL, 0, 0),
(19, 'Paris, France', ' Attend a fashion show ', 1, 1, 4, '2024-07-25 15:10:05', NULL, 0, 1),
(20, 'Tokyo, Japan', ' Perform at a music festival', 1, 1, 4, '2024-07-25 15:10:25', NULL, 0, 1),
(21, 'Task X', 'desc X', 1, 1, 86, '2024-07-25 17:19:37', NULL, 1, 1),
(22, 'Task Y', 'Y desc', 1, 1, 86, '2024-07-25 17:27:22', NULL, 0, 0),
(25, 'Task Z', 'Desc Z', 1, 1, 86, '2024-07-26 02:07:47', NULL, 1, 1);

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
(1, 'Harry Styles', '$2y$10$c/5jQ0P3K3tYDgSQtiQExObayh6HEyrDyOvGIcJu.xVRVxGnJIFlC', 'images/how-many-grammys-harry-styles.jpg', 'h.styles@gmail.com', '2024-07-19 03:42:41'),
(26, 'Julia', '$2y$10$oY80/qfdyDr5591wfjwPI.T6SSh.kB/WS2.wMJMggJnc27BD2vzg2', NULL, 'juls@example.com', '2024-07-22 15:13:15'),
(27, 'Mary Jones', '$2y$10$Ya9zWtC2bErmtSGMDmPLAeoKaf/jRHUxbIPTlz30ln5JmuToQsNp6', NULL, 'm.jones@mail.com', '2024-07-22 15:54:19'),
(28, 'Jack', '$2y$10$9/jPJUhZHUGnKS.eZVKRNehGzOvsyBrdli6LXzq.0PPhDn0gVvbuq', NULL, 'jack@sdfd.com', '2024-07-26 13:50:03'),
(29, 'Mary', '$2y$10$DAtfxaNpHFzthuSfizScaOMMN54Abqe8sa5eXOgMwfkR758rVf3Ka', NULL, 'fgfdg@asdd.com', '2024-07-26 14:26:42');

-- --------------------------------------------------------

--
-- Structure for view `tasklistview`
--
DROP TABLE IF EXISTS `tasklistview`;

DROP VIEW IF EXISTS `tasklistview`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tasklistview`  AS SELECT `t`.`id` AS `task_id`, `t`.`title` AS `task_title`, `t`.`description` AS `task_description`, `t`.`user_id` AS `user_id`, `t`.`task_order` AS `task_order`, `t`.`list_id` AS `list_id`, `t`.`creation_date` AS `creation_date`, `t`.`due_date` AS `due_date`, `t`.`completed` AS `completed`, `t`.`importance` AS `importance`, `l`.`title` AS `list_title`, `l`.`list_order` AS `list_order` FROM (`tasks` `t` left join `lists` `l` on((`t`.`list_id` = `l`.`id`)))  ;

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
  ADD UNIQUE KEY `name` (`title`),
  ADD KEY `fk_user` (`user_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `lists`
--
ALTER TABLE `lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `reminders`
--
ALTER TABLE `reminders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lists`
--
ALTER TABLE `lists`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

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
