-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 15, 2022 at 04:47 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `share_story`
--

-- --------------------------------------------------------

--
-- Table structure for table `stories`
--

CREATE TABLE `stories` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stories`
--

INSERT INTO `stories` (`id`, `user_id`, `title`, `description`, `is_active`) VALUES
(1, 1, 'Kisah Ban Motorku', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit, minus a quae eaque ipsam neque aspernatur reprehenderit? Laboriosam atque aliquid nisi saepe, debitis fuga iusto beatae quasi impedit delectus illum.</p>\r\n<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Perspiciatis dolorem sunt pariatur impedit similique veniam beatae accusamus ex officia id, vel cum voluptatibus iure. Pariatur ut ipsum ratione quas optio, tempore neque magnam vero consequatur blanditiis numquam exercitationem! Debitis dicta commodi, ea assumenda quisquam autem. Asperiores esse voluptatum quos recusandae, quae ut, possimus illo ullam dolorum qui aut, perspiciatis incidunt! Fuga aperiam explicabo dolor suscipit optio consectetur sed iste, natus neque maxime possimus, ad beatae blanditiis cum modi fugiat iusto assumenda. Nesciunt exercitationem quos eum, ad laboriosam culpa. Quo nemo ut eaque natus eveniet quae vero molestiae at culpa incidunt!</p>\r\n<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque iusto culpa repellendus? Numquam ratione dicta velit exercitationem, illum deserunt inventore itaque cumque maiores, delectus dolor molestiae autem quis repellat ut!</p>', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `is_active`) VALUES
(1, 'Budi Laksana', 'budi', '$2y$10$.V969.cqvtvT09thQRtHJ.VBr1ZCAs9JAlXD31RACwOnsIR9pGcgu', 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_stories`
-- (See below for the actual view)
--
CREATE TABLE `vw_stories` (
`user_id` int(11)
,`user_name` varchar(255)
,`user_username` varchar(255)
,`story_id` int(11)
,`story_title` varchar(255)
,`story_description` text
);

-- --------------------------------------------------------

--
-- Structure for view `vw_stories`
--
DROP TABLE IF EXISTS `vw_stories`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_stories`  AS SELECT `users`.`id` AS `user_id`, `users`.`name` AS `user_name`, `users`.`username` AS `user_username`, `stories`.`id` AS `story_id`, `stories`.`title` AS `story_title`, `stories`.`description` AS `story_description` FROM (`users` left join `stories` on(`stories`.`user_id` = `users`.`id`)) WHERE `stories`.`is_active` = 1 AND `users`.`is_active` = 11  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `stories`
--
ALTER TABLE `stories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_story` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `stories`
--
ALTER TABLE `stories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `stories`
--
ALTER TABLE `stories`
  ADD CONSTRAINT `stories_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
