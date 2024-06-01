-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2024 at 11:57 AM
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
-- Database: `filmbase2`
--

-- --------------------------------------------------------

--
-- Table structure for table `characters`
--

CREATE TABLE `characters` (
  `character_id` int(10) UNSIGNED NOT NULL,
  `entity` mediumint(8) UNSIGNED NOT NULL,
  `character_name` varchar(50) NOT NULL,
  `actor` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `country_id` tinyint(3) UNSIGNED NOT NULL,
  `country_name` varchar(50) NOT NULL,
  `flag` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `entities`
--

CREATE TABLE `entities` (
  `entity_id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(70) NOT NULL,
  `year` tinyint(3) UNSIGNED NOT NULL,
  `type` tinyint(3) UNSIGNED NOT NULL,
  `genre` tinyint(3) UNSIGNED NOT NULL,
  `entity_desc` varchar(250) DEFAULT NULL,
  `poster` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `entities_countries`
--

CREATE TABLE `entities_countries` (
  `e_c_id` int(10) UNSIGNED NOT NULL,
  `country_id` tinyint(3) UNSIGNED NOT NULL,
  `entity_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `entities_people_professions`
--

CREATE TABLE `entities_people_professions` (
  `stuff_id` int(10) UNSIGNED NOT NULL,
  `entity_id` mediumint(8) UNSIGNED NOT NULL,
  `person_id` mediumint(8) UNSIGNED NOT NULL,
  `profession_id` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `entities_tags`
--

CREATE TABLE `entities_tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `entity_id` mediumint(8) UNSIGNED NOT NULL,
  `tag_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `genre_id` tinyint(3) UNSIGNED NOT NULL,
  `genre_name` varchar(50) NOT NULL,
  `genre_desc` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `entity` mediumint(8) UNSIGNED NOT NULL,
  `duration_min` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE `people` (
  `person_id` mediumint(8) UNSIGNED NOT NULL,
  `person_name` varchar(20) NOT NULL,
  `person_surname` varchar(25) DEFAULT NULL,
  `gender` char(1) NOT NULL,
  `person_birthdate` date DEFAULT NULL,
  `person_death_date` date DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `people_countries`
--

CREATE TABLE `people_countries` (
  `p_c_id` int(11) NOT NULL,
  `country_id` tinyint(3) UNSIGNED NOT NULL,
  `person_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `professions`
--

CREATE TABLE `professions` (
  `profession_id` tinyint(3) UNSIGNED NOT NULL,
  `profession_name` varchar(30) NOT NULL,
  `profession_desc` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(10) UNSIGNED NOT NULL,
  `review_entity` mediumint(8) UNSIGNED NOT NULL,
  `review_author` mediumint(8) UNSIGNED NOT NULL,
  `review_name` varchar(50) DEFAULT NULL,
  `review_text` varchar(500) NOT NULL,
  `review_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `series`
--

CREATE TABLE `series` (
  `entity` mediumint(8) UNSIGNED NOT NULL,
  `num_seasons` tinyint(3) UNSIGNED NOT NULL,
  `num_episodes` smallint(5) UNSIGNED NOT NULL,
  `year_end` tinyint(3) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `tag_id` mediumint(10) UNSIGNED NOT NULL,
  `tag_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `type_id` tinyint(3) UNSIGNED NOT NULL,
  `type_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `username` varchar(40) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `role` tinyint(3) UNSIGNED NOT NULL DEFAULT 2,
  `email` varchar(40) NOT NULL,
  `date_joined` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `role_id` tinyint(3) UNSIGNED NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `role_desc` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `years`
--

CREATE TABLE `years` (
  `year_id` tinyint(3) UNSIGNED NOT NULL,
  `year` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `characters`
--
ALTER TABLE `characters`
  ADD PRIMARY KEY (`character_id`),
  ADD UNIQUE KEY `entity_2` (`entity`,`character_name`,`actor`),
  ADD KEY `entity` (`entity`),
  ADD KEY `actor` (`actor`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`country_id`),
  ADD UNIQUE KEY `country_name` (`country_name`);

--
-- Indexes for table `entities`
--
ALTER TABLE `entities`
  ADD PRIMARY KEY (`entity_id`),
  ADD KEY `genre` (`genre`),
  ADD KEY `type` (`type`),
  ADD KEY `year` (`year`);

--
-- Indexes for table `entities_countries`
--
ALTER TABLE `entities_countries`
  ADD PRIMARY KEY (`e_c_id`),
  ADD UNIQUE KEY `country_id_2` (`country_id`,`entity_id`),
  ADD KEY `country_id` (`country_id`),
  ADD KEY `entity_id` (`entity_id`);

--
-- Indexes for table `entities_people_professions`
--
ALTER TABLE `entities_people_professions`
  ADD PRIMARY KEY (`stuff_id`),
  ADD UNIQUE KEY `entity_id_2` (`entity_id`,`person_id`,`profession_id`),
  ADD KEY `entity_id` (`entity_id`),
  ADD KEY `person_id` (`person_id`),
  ADD KEY `profession_id` (`profession_id`);

--
-- Indexes for table `entities_tags`
--
ALTER TABLE `entities_tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `entity_id_2` (`entity_id`,`tag_id`),
  ADD KEY `entity_id` (`entity_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`genre_id`),
  ADD UNIQUE KEY `genre_name` (`genre_name`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`entity`);

--
-- Indexes for table `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`person_id`);

--
-- Indexes for table `people_countries`
--
ALTER TABLE `people_countries`
  ADD PRIMARY KEY (`p_c_id`),
  ADD UNIQUE KEY `country_id_2` (`country_id`,`person_id`),
  ADD KEY `person_id` (`person_id`),
  ADD KEY `country_id` (`country_id`);

--
-- Indexes for table `professions`
--
ALTER TABLE `professions`
  ADD PRIMARY KEY (`profession_id`),
  ADD UNIQUE KEY `profession_name` (`profession_name`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD UNIQUE KEY `review_entity_2` (`review_entity`,`review_author`),
  ADD KEY `review_author` (`review_author`),
  ADD KEY `review_entity` (`review_entity`);

--
-- Indexes for table `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`entity`),
  ADD KEY `year_end` (`year_end`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tag_id`),
  ADD UNIQUE KEY `tag_name` (`tag_name`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `role` (`role`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `years`
--
ALTER TABLE `years`
  ADD PRIMARY KEY (`year_id`),
  ADD UNIQUE KEY `year` (`year`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `characters`
--
ALTER TABLE `characters`
  MODIFY `character_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `country_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `entities`
--
ALTER TABLE `entities`
  MODIFY `entity_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `entities_countries`
--
ALTER TABLE `entities_countries`
  MODIFY `e_c_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `entities_people_professions`
--
ALTER TABLE `entities_people_professions`
  MODIFY `stuff_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `entities_tags`
--
ALTER TABLE `entities_tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `genre_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `people`
--
ALTER TABLE `people`
  MODIFY `person_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `people_countries`
--
ALTER TABLE `people_countries`
  MODIFY `p_c_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `professions`
--
ALTER TABLE `professions`
  MODIFY `profession_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `tag_id` mediumint(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `type_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `role_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `years`
--
ALTER TABLE `years`
  MODIFY `year_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `characters`
--
ALTER TABLE `characters`
  ADD CONSTRAINT `characters_ibfk_1` FOREIGN KEY (`entity`) REFERENCES `entities` (`entity_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `characters_ibfk_2` FOREIGN KEY (`actor`) REFERENCES `people` (`person_id`);

--
-- Constraints for table `entities`
--
ALTER TABLE `entities`
  ADD CONSTRAINT `entities_ibfk_1` FOREIGN KEY (`genre`) REFERENCES `genres` (`genre_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `entities_ibfk_2` FOREIGN KEY (`type`) REFERENCES `types` (`type_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `entities_ibfk_3` FOREIGN KEY (`year`) REFERENCES `years` (`year_id`);

--
-- Constraints for table `entities_countries`
--
ALTER TABLE `entities_countries`
  ADD CONSTRAINT `entities_countries_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `countries` (`country_id`),
  ADD CONSTRAINT `entities_countries_ibfk_2` FOREIGN KEY (`entity_id`) REFERENCES `entities` (`entity_id`);

--
-- Constraints for table `entities_people_professions`
--
ALTER TABLE `entities_people_professions`
  ADD CONSTRAINT `entities_people_professions_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `entities` (`entity_id`),
  ADD CONSTRAINT `entities_people_professions_ibfk_2` FOREIGN KEY (`person_id`) REFERENCES `people` (`person_id`),
  ADD CONSTRAINT `entities_people_professions_ibfk_3` FOREIGN KEY (`profession_id`) REFERENCES `professions` (`profession_id`);

--
-- Constraints for table `entities_tags`
--
ALTER TABLE `entities_tags`
  ADD CONSTRAINT `entities_tags_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `entities` (`entity_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `entities_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`tag_id`) ON DELETE CASCADE;

--
-- Constraints for table `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `movies_ibfk_1` FOREIGN KEY (`entity`) REFERENCES `entities` (`entity_id`) ON DELETE CASCADE;

--
-- Constraints for table `people_countries`
--
ALTER TABLE `people_countries`
  ADD CONSTRAINT `people_countries_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `people` (`person_id`),
  ADD CONSTRAINT `people_countries_ibfk_2` FOREIGN KEY (`country_id`) REFERENCES `countries` (`country_id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`review_author`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`review_entity`) REFERENCES `entities` (`entity_id`) ON DELETE CASCADE;

--
-- Constraints for table `series`
--
ALTER TABLE `series`
  ADD CONSTRAINT `series_ibfk_1` FOREIGN KEY (`year_end`) REFERENCES `years` (`year_id`),
  ADD CONSTRAINT `series_ibfk_2` FOREIGN KEY (`entity`) REFERENCES `entities` (`entity_id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role`) REFERENCES `user_roles` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
