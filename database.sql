-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 26 Octobre 2017 à 13:53
-- Version du serveur :  5.7.19-0ubuntu0.16.04.1
-- Version de PHP :  7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `simple-mvc`
--

-- --------------------------------------------------------

--
-- Structure de la table `item`
--

CREATE TABLE `instrument` (
  `id` INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  `image` VARCHAR(255) NOT NULL,
  `icon` VARCHAR(255) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `tag` (
  `id` INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `instrument_tag` (
  `tag_id` INT UNSIGNED NOT NULL,
  `instrument_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY(tag_id, instrument_id),
  FOREIGN KEY(tag_id) REFERENCES tag(id),
  FOREIGN KEY(instrument_id) REFERENCES instrument(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
-- Contenu de la table `item`
--

INSERT INTO `instrument` (`id`, `name`, `image`, `icon`) VALUES
(1, 'accoustic guitar', '/assets/images/accoustic_guitar_image.jpg', '/assets/images/accoustic_guitar_icon.png'), 
(2, 'bass guitar','/assets/images/bass_image.jpg', '/assets/images/bass_icon.png'), 
(3, 'drums', '/assets/images/drums_image.jpg', '/assets/images/drums_icon.png'),
(4, 'piano', '/assets/images/piano_image.jpg', '/assets/images/piano_icon.png'),
(5, 'synthesizer', '/assets/images/synthesizer_image.jpg', '/assets/images/synthesizer_icon.png'),
(6, 'violin', '/assets/images/violin_image.jpg', '/assets/images/violin_icon.png'),
(7, 'cello', '/assets/images/cello_image.jpg', '/assets/images/cello_icon.png'),
(8, 'trumpet', '/assets/images/trumpet_image.jpg', '/assets/images/trumpet_icon.png'),
(9, 'saxophone', '/assets/images/saxophone_image.jpg', '/assets/images/saxophone_icon.png'),
(10, 'electric guitar', '/assets/images/electric_guitar_image.jpg', '/assets/images/electric_guitar_icon.png'),
(11, 'harpe', '/assets/images/harpe_image.jpg', '/assets/images/harpe_icon.png'),
(12, 'flute', '/assets/images/flute_image.jpg', '/assets/images/flute_icon.png');


INSERT INTO `tag` (`id`, `name`) VALUES 
(1, 'rock'),
(2, 'electronic'),
(3, 'alternative'),
(4, 'pop'),
(5, 'metal'),
(6, 'alternative rock'),
(7, 'jazz'),
(8, 'classic rock'),
(9, 'folk'),
(10, 'punk'),
(11, 'Hip-Hop'),
(12, 'hard rock'),
(13, 'instrumental'),
(14, 'Progressive rock'),
(15, 'soul'),
(16, 'rap'),
(17, 'Classical'),
(18, 'blues'),
(19, 'funk'),
(20, 'new wave'),
(21, 'House'),
(22, 'electronica');

INSERT INTO `instrument_tag` (`tag_id`, `instrument_id`) VALUES
(1,1), (1,2), (1,3), (1,10),
(2,5),
(3,1), (3,2), (3,3), (3,10),
(4,1), (4,2), (4,3), (4,10),
(5,2), (5,3),
(6,1), (6,2), (6,3), (6,10),
(7,1), (7,3), (7,4), (7,6), (7,7), (7,8), (7,9), (7,10),
(8,1), (8,2), (8,3), (8,10),
(9,1), (9,6), (9,12),
(10,2), (10,3), (10,10),
(11,3), (11,5),
(12,2), (12,3), (12,9), (12,10),
(13,4), (13,6), (13,7), (13,8), (13,9), (13,11), (13,12),
(14,1), (14,2), (14,3), (14,10),
(15,2), (15,3), (15,4), (15,10),
(16,3), (16,5),
(17,4), (17,6), (17,7), (17,8), (17,9), (17,11), (17,12),
(18,1), (18,3), (18,4), (18,6), (18,7), (18,8), (18,9), (18,10),
(19,1), (19,2), (19,3), (19,5),
(20,2), (20,10),
(21,10),
(22,10);



--
-- -- Index pour les tables exportées
-- --

-- --
-- -- Index pour la table `item`
-- --
-- ALTER TABLE `item`
--   ADD PRIMARY KEY (`id`);

-- --
-- -- AUTO_INCREMENT pour les tables exportées
-- --

-- --
-- -- AUTO_INCREMENT pour la table `item`
-- --
-- ALTER TABLE `item`
--   MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
-- /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
-- /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
-- /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
