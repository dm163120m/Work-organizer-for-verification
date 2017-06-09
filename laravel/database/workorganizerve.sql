-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2017 at 09:11 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `workorganizerve`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) COLLATE utf8_bin NOT NULL,
  `comment` text COLLATE utf8_bin NOT NULL,
  `task_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`),
  KEY `task_id` (`task_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `username`, `comment`, `task_id`) VALUES
(1, 'goca', 'This regression needs to be runned from work folder.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`) VALUES
(1, 'Bandwidth'),
(2, 'Grupa 2'),
(3, 'Grupa 3');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` datetime NOT NULL,
  `message` text COLLATE utf8_bin NOT NULL,
  `username` varchar(20) COLLATE utf8_bin NOT NULL,
  `task_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `task_id` (`task_id`),
  KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=11 ;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `time`, `message`, `username`, `task_id`) VALUES
(1, '2017-03-08 00:00:00', 'Assigned task Run the regression (TSK#1) to Jelena Jelenic.', 'pavle', 1),
(2, '2017-03-15 00:00:00', 'Test bendwidth_check_all_ports_active.e added to the group Bandwidth_check.', 'pavle', NULL),
(8, '2017-03-29 00:00:00', 'Test removing_port_on_the_fly.e added to the group Remove port.', 'pavle', NULL),
(9, '2017-03-24 00:00:00', 'Task Run the regression(TSK#1) - state changed to ''In Progress''', 'jeca', 1),
(10, '2017-03-19 00:00:00', 'Assigned task Run the regression (TSK#2) to Gorica Goric.', 'peca', 2);

-- --------------------------------------------------------

--
-- Table structure for table `priorities`
--

CREATE TABLE IF NOT EXISTS `priorities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `priority` varchar(15) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Dumping data for table `priorities`
--

INSERT INTO `priorities` (`id`, `priority`) VALUES
(1, 'High'),
(2, 'Medium'),
(3, 'Low');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE IF NOT EXISTS `reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `latest_change` date NOT NULL,
  `latest_run` date NOT NULL,
  `count` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `seed` bigint(20) DEFAULT NULL,
  `fail_description` text COLLATE utf8_bin,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `reports_tests`
--

CREATE TABLE IF NOT EXISTS `reports_tests` (
  `id_test` int(11) NOT NULL,
  `id_report` int(11) NOT NULL,
  PRIMARY KEY (`id_test`,`id_report`),
  KEY `id_test` (`id_test`),
  KEY `id_report` (`id_report`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE IF NOT EXISTS `statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(15) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `status`) VALUES
(1, 'Created'),
(2, 'In Progress'),
(3, 'On Hold'),
(4, 'Done');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text COLLATE utf8_bin NOT NULL,
  `author` varchar(20) COLLATE utf8_bin NOT NULL,
  `assignee` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `priority` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `author` (`author`),
  KEY `assignee` (`assignee`),
  KEY `priority` (`priority`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=16 ;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `author`, `assignee`, `description`, `priority`, `status`) VALUES
(1, 'Run Bandwidth Regression', 'mica', 'jeca', 'Run bandwidth regression on count 5 using 2 licences.dfgfdgdfg', 1, 2),
(2, 'Task2', 'peca', 'goca', 'Some task description.', 2, 2),
(3, 'Neki task', 'peca', 'joca', 'Ovo je opis nekog taska. Visokog prioriteta. Dodajem izmene.', 2, 1),
(6, 'Evo jos jedan zadatak', 'peca', 'joca', 'Ovaj task cu da dodelim Joci i bice veoma niskog prioriteta. \nTakoreci bleja. :)', 3, 2),
(9, 'Yet Another Task For Batman', 'mica', 'goca', 'Task for Baaaaataman! Confidential. menjam nesto Evo piseeeeeeeeemmmm Dragana', 3, 3),
(10, 'testiranje kreiranja taskova na nasoj Jiri', 'peca', 'joca', 'lalalalalallal And lalalalala', 2, 1),
(11, 'Problem dupliranja koda mora da se resi', 'peca', 'jeca', 'Neki opis, zamislite ovde. Moze da bude i dugacak recimo. Mada sta pisati toliko dugo. Hm... Nije dovoljno dugo. Evo ti jos, da popunimo i jos jos jos.', 1, 1),
(13, 'Populisanje polja ako te vrati zbog greske', 'peca', 'jeca', 'Znaci kada recimo  se ne unese description da ostala polja budu popunjena.', 1, 1),
(15, 'Evo jedan skroz bezveze', 'peca', 'goca', 'Samo da proverim redirect.', 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tasks_tests`
--

CREATE TABLE IF NOT EXISTS `tasks_tests` (
  `task_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  PRIMARY KEY (`task_id`,`test_id`),
  KEY `task_id` (`task_id`),
  KEY `test_id` (`test_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tasks_tests`
--

INSERT INTO `tasks_tests` (`task_id`, `test_id`) VALUES
(1, 1),
(1, 4),
(3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE IF NOT EXISTS `tests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_bin NOT NULL,
  `author` varchar(20) COLLATE utf8_bin NOT NULL,
  `group_id` int(11) NOT NULL,
  `path` varchar(150) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `created` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `author` (`author`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`id`, `title`, `author`, `group_id`, `path`, `description`, `created`) VALUES
(1, 'Test1', 'pavle', 1, '/home/work/tests', 'Test Description 1', '0000-00-00'),
(2, 'Testic', 'pavle', 1, '/putanja/neka', 'Ovo je neki test i njegov desc', '0000-00-00'),
(3, 'Jos jedan test', 'pavle', 1, 'neki test/test', 'Ovo je neki test', '0000-00-00'),
(4, 'Naziv testa', 'pavle', 1, '/putanja/neka', 'Ovo je neki test i njegov desc', '2017-06-04'),
(5, 'neki test title', 'pavle', 1, 'neki test/test', 'Ovo je neki test', '2017-06-04'),
(7, 'hgmghmgh', 'pavle', 1, 'fgjghjgjghjghjgh', 'gjghjghjghjghj', '0000-00-00'),
(8, 'Verovatno dobar test', 'peca', 3, 'hej/hej/hej', 'Tralalala tralallalala Opis', '0000-00-00'),
(9, 'Test name 2', 'peca', 2, '/blab/bla/bla', 'Ovo je neki test sample.', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(20) COLLATE utf8_bin NOT NULL,
  `Name` varchar(50) COLLATE utf8_bin NOT NULL,
  `Surname` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(20) COLLATE utf8_bin NOT NULL,
  `email` varchar(30) COLLATE utf8_bin NOT NULL,
  `imageUrl` varchar(256) COLLATE utf8_bin DEFAULT NULL,
  `role` varchar(10) COLLATE utf8_bin NOT NULL,
  `approved` int(11) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `Name`, `Surname`, `password`, `email`, `imageUrl`, `role`, `approved`) VALUES
('goca', 'Gorica', 'Goric', 'goca123', 'goca@gmail.com', 'https://s-media-cache-ak0.pinimg.com/736x/14/76/71/1476718f02b6038645a26ffcb844b1f8.jpg', 'junior', 1),
('jeca', 'Jelena', 'Jelenic', 'jeca123', 'jeca@gmail.com', 'https://s-media-cache-ak0.pinimg.com/originals/17/07/71/170771cfc1964a5155fcaa0624ba5749.jpg', 'junior', 1),
('joca', 'Jovan', 'Jovanovic', 'joca123', 'joca@gmail.com', 'https://s-media-cache-ak0.pinimg.com/originals/7b/48/4b/7b484ba2e5892516a06b758669dc5a7a--baby-beagle-baby-dogs.jpg', 'junior', 0),
('mica', 'Milica', 'Milicic', 'mica123', 'mica@gmail.com', 'https://s-media-cache-ak0.pinimg.com/originals/0f/d8/93/0fd893fe69df88bfa8bc84cf1d497563.jpg', 'senior', 0),
('misa', 'Misa', 'Misic', 'misa123', 'misa@gmail.com', 'https://s-media-cache-ak0.pinimg.com/originals/cc/5e/56/cc5e56ac246abfaed70d5ff2e0deca91.jpg', 'junior', 0),
('pavle', 'Pavle', 'Pavlekic', 'pavle123', 'pavle@gmail.com', 'https://s-media-cache-ak0.pinimg.com/736x/e4/45/2c/e4452cc8ef5d6dac58d8b0b0aa290ac8.jpg', 'senior', 1),
('peca', 'Petar', 'Petrovic', 'peca123', 'peca@gmail.com', 'https://s-media-cache-ak0.pinimg.com/736x/31/94/88/319488b64c14adb603ead90fac8f17fc.jpg', 'senior', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`username`) REFERENCES `users` (`username`);

--
-- Constraints for table `reports_tests`
--
ALTER TABLE `reports_tests`
  ADD CONSTRAINT `reports_tests_ibfk_1` FOREIGN KEY (`id_test`) REFERENCES `tests` (`id`),
  ADD CONSTRAINT `reports_tests_ibfk_2` FOREIGN KEY (`id_report`) REFERENCES `reports` (`id`);

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`author`) REFERENCES `users` (`username`),
  ADD CONSTRAINT `tasks_ibfk_2` FOREIGN KEY (`assignee`) REFERENCES `users` (`username`),
  ADD CONSTRAINT `tasks_ibfk_3` FOREIGN KEY (`priority`) REFERENCES `priorities` (`id`),
  ADD CONSTRAINT `tasks_ibfk_4` FOREIGN KEY (`status`) REFERENCES `statuses` (`id`);

--
-- Constraints for table `tasks_tests`
--
ALTER TABLE `tasks_tests`
  ADD CONSTRAINT `tasks_tests_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`),
  ADD CONSTRAINT `tasks_tests_ibfk_2` FOREIGN KEY (`test_id`) REFERENCES `tests` (`id`);

--
-- Constraints for table `tests`
--
ALTER TABLE `tests`
  ADD CONSTRAINT `tests_ibfk_1` FOREIGN KEY (`author`) REFERENCES `users` (`username`),
  ADD CONSTRAINT `tests_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
