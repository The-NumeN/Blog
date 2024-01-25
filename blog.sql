-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 24 jan. 2024 à 22:06
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

DROP DATABASE if exists blog;
CREATE DATABASE blog;
USE blog;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id_article` int NOT NULL AUTO_INCREMENT,
  `Titre` varchar(50) DEFAULT NULL,
  `Texte` text,
  `Date_pub` date DEFAULT NULL,
  `img_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_article`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id_article`, `Titre`, `Texte`, `Date_pub`, `img_path`) VALUES
(2, 'test', 'me', '2024-01-24', 'images/Numen.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `id_article` int DEFAULT NULL,
  `id_utilisateur` int DEFAULT NULL,
  `id_commentaire` int NOT NULL AUTO_INCREMENT,
  `text_comm` varchar(250) DEFAULT NULL,
  `date_heure` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_commentaire`),
  KEY `id_article` (`id_article`),
  KEY `id_utilisateur` (`id_utilisateur`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id_article`, `id_utilisateur`, `id_commentaire`, `text_comm`, `date_heure`) VALUES
(2, 7, 11, 'you\r\n', '2024-01-24 20:22:31');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id_utilisateur` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `passwd` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `mail` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_utilisateur`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateur`, `pseudo`, `passwd`, `mail`) VALUES
(3, 'gsm', '$2y$10$WFEcqSs868twFRVbr4jUquBWNpx3iu0fDM1KzIasv7MMWZWC7kBja', 'gsm@gsm.com'),
(7, 'admin', '$2y$10$FoJZnDRRIEteG7cwDY0h2ulpY1eEwDW76tfND0hLo8PPP7pcB4Zs6', 'admin@admin.fr'),
(8, 'new', '', 'new@new'),
(9, 'numen', '$2y$10$D2O/9hKHqp2T9FcTuK26w.B1oKMVD5OVxiS4ckBta5o2jmpBAzboy', 'numen@numen.fr'),
(10, 'me', '$2y$10$eahbPnr.xkm/8asui3PgfuxN2AXxoRKsn5N3CWjbwv6UhtAvTs5l6', 'me@me.fr'),
(11, 'man', '$2y$10$k2oXC7L2fvonjJaLfhpE0eWueGMD.7Q/z3/laPGP5gcmsNnhc1Ybm', 'man@man');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
