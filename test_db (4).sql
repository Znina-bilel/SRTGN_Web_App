-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 22 fév. 2024 à 14:53
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `test_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `adminn`
--

DROP TABLE IF EXISTS `adminn`;
CREATE TABLE IF NOT EXISTS `adminn` (
  `id` int NOT NULL AUTO_INCREMENT,
  `namee` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `passwordd` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `adminn`
--

INSERT INTO `adminn` (`id`, `namee`, `user_name`, `passwordd`) VALUES
(1, 'marwen', 'marwen', 'marwen'),
(2, 'amal', 'amal', 'amal');

-- --------------------------------------------------------

--
-- Structure de la table `equipement`
--

DROP TABLE IF EXISTS `equipement`;
CREATE TABLE IF NOT EXISTS `equipement` (
  `marque` varchar(255) NOT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  `equipement_type` varchar(255) NOT NULL,
  `reference` varchar(255) NOT NULL,
  `etat` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `equipement`
--

INSERT INTO `equipement` (`marque`, `id`, `equipement_type`, `reference`, `etat`) VALUES
('Laser', 1, 'Imprimante', 'Imp 100', 'Enservice');

-- --------------------------------------------------------

--
-- Structure de la table `infoutilisateur`
--

DROP TABLE IF EXISTS `infoutilisateur`;
CREATE TABLE IF NOT EXISTS `infoutilisateur` (
  `idu` int NOT NULL AUTO_INCREMENT,
  `tel` int NOT NULL,
  `mail` varchar(255) NOT NULL,
  `serviceu` varchar(255) NOT NULL,
  PRIMARY KEY (`idu`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `infoutilisateur`
--

INSERT INTO `infoutilisateur` (`idu`, `tel`, `mail`, `serviceu`) VALUES
(1, 50159684, 'azhar11@gmail.com', 'informatique');

-- --------------------------------------------------------

--
-- Structure de la table `nouvelledemande`
--

DROP TABLE IF EXISTS `nouvelledemande`;
CREATE TABLE IF NOT EXISTS `nouvelledemande` (
  `nomu` varchar(255) NOT NULL,
  `agenceu` varchar(255) NOT NULL,
  `inventaireu` varchar(255) NOT NULL,
  `marqueu` varchar(255) NOT NULL,
  `dateu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `referenceu` int NOT NULL,
  `observationu` varchar(255) NOT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  `idu` int NOT NULL,
  `idemp` int NOT NULL,
  `datedtrait` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateftrait` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `descriptionu` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idu` (`idu`),
  KEY `idemp` (`idemp`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `nouvelledemande`
--

INSERT INTO `nouvelledemande` (`nomu`, `agenceu`, `inventaireu`, `marqueu`, `dateu`, `referenceu`, `observationu`, `id`, `idu`, `idemp`, `datedtrait`, `dateftrait`, `descriptionu`) VALUES
('azhar', 'korba', 'Scanner', 'Scanner à plat', '2024-02-20 13:40:00', 159878, 'probleme d\'affichage', 2, 1, 0, '2024-02-20 13:42:02', '2024-02-20 13:56:02', 'traitement 4'),
('azhar', 'menzelt mim', 'Ordinateur', 'Dell', '2024-02-20 13:40:00', 145689, 'probleme de connexion', 4, 1, 0, '2024-02-20 13:50:17', '2024-02-20 13:59:17', 'traitement 4');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `namea` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `passworda` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `namea`, `user_name`, `passworda`) VALUES
(1, 'azhar', 'azhar', 'azhar'),
(2, 'aya', 'aya', 'aya');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
