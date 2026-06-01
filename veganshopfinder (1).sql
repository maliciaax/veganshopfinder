-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 01 juin 2026 à 16:25
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `veganshopfinder`
--

-- --------------------------------------------------------

--
-- Structure de la table `appartenir`
--

DROP TABLE IF EXISTS `appartenir`;
CREATE TABLE IF NOT EXISTS `appartenir` (
  `idMag` int NOT NULL,
  `idProd` int NOT NULL,
  `stock` int DEFAULT NULL,
  PRIMARY KEY (`idMag`,`idProd`),
  KEY `idProd` (`idProd`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `appartenir`
--

INSERT INTO `appartenir` (`idMag`, `idProd`, `stock`) VALUES
(1, 1, 50),
(1, 2, 70),
(2, 1, 58),
(3, 3, 42),
(5, 1, 48),
(6, 2, 78),
(7, 4, 48),
(7, 2, 20);

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`) VALUES
(13),
(14),
(18);

-- --------------------------------------------------------

--
-- Structure de la table `codes_invitation`
--

DROP TABLE IF EXISTS `codes_invitation`;
CREATE TABLE IF NOT EXISTS `codes_invitation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `utilise` tinyint(1) DEFAULT '0',
  `idUser` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `idUser` (`idUser`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `codes_invitation`
--

INSERT INTO `codes_invitation` (`id`, `code`, `utilise`, `idUser`) VALUES
(1, 'VEGAN2026-AAA', 1, NULL),
(2, 'VEGAN2026-BBB', 1, NULL),
(3, 'VEGAN2026-CCC', 1, 17);

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `idComm` int NOT NULL AUTO_INCREMENT,
  `note` int DEFAULT NULL,
  `titre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contenu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dateCom` date DEFAULT NULL,
  `idMag` int NOT NULL,
  `id` int NOT NULL,
  PRIMARY KEY (`idComm`),
  KEY `idMag` (`idMag`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`idComm`, `note`, `titre`, `contenu`, `dateCom`, `idMag`, `id`) VALUES
(1, 5, 'Génial !!', 'Les commerçants sont très gentil et respectueux !', '2026-05-29', 1, 13),
(2, 4, 'Trop bon !', 'C\'était trop bien mais le gérant m\'a pas dit bonjour..', '2026-05-31', 3, 18);

-- --------------------------------------------------------

--
-- Structure de la table `gerant`
--

DROP TABLE IF EXISTS `gerant`;
CREATE TABLE IF NOT EXISTS `gerant` (
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `gerant`
--

INSERT INTO `gerant` (`id`) VALUES
(15),
(16),
(17);

-- --------------------------------------------------------

--
-- Structure de la table `magasin`
--

DROP TABLE IF EXISTS `magasin`;
CREATE TABLE IF NOT EXISTS `magasin` (
  `idMag` int NOT NULL AUTO_INCREMENT,
  `nomMag` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ville` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `codePostal` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numMag` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mailMag` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` decimal(15,6) DEFAULT NULL,
  `longitude` decimal(15,6) DEFAULT NULL,
  `altitude` decimal(15,6) DEFAULT NULL,
  `id` int DEFAULT NULL,
  `imgSrc` varchar(5000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idMag`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `magasin`
--

INSERT INTO `magasin` (`idMag`, `nomMag`, `ville`, `adresse`, `codePostal`, `numMag`, `mailMag`, `latitude`, `longitude`, `altitude`, `id`, `imgSrc`) VALUES
(1, 'Un monde vegan', 'Allauch', '12 traverse Victor', '13190', '0666956695', 'un-monde-vegan@gmail.com', 43.322131, 5.468949, 1.000000, NULL, 'magasin1.jpg'),
(2, 'L\'ère vegane', 'Allauch', '30 rue des Camoins', '13005', '0666956694', 'ereVegane1@gmail.com', 43.335406, 5.481610, 2.000000, NULL, 'magasin2.webp'),
(3, 'La maison Vegane', 'Marseille', '78 rue George', '13005', '0486597852', 'lamaisonvenage@gmail.com', 43.295814, 5.397842, 0.000000, NULL, 'magasin.jpg'),
(5, 'Naturalia', 'Allauch', '22-112 Chem. de l\'Afférage', '13190', '0589457841', 'naturalia@gmail.com', 43.338367, 5.473818, 1.000000, NULL, 'magasin3.webp'),
(6, 'GreenBay', 'Allauch', '8 rue des Oliviers', '13190', '0589457841', 'green-bay@gmail.com', 43.329417, 5.474302, 1.000000, NULL, 'greenbay.png'),
(7, 'Vegan & Co', 'Martigue', '15 Av. du Groupe Manouchian', '13110', '0781865860', 'veganNco@gmail.com', 43.413011, 4.989551, 1.000000, 15, 'veganNco.jfif');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `idProd` int NOT NULL AUTO_INCREMENT,
  `nomProd` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idProd`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`idProd`, `nomProd`) VALUES
(1, 'Soja'),
(2, 'Seitan'),
(3, 'PST'),
(4, 'Légumes bios'),
(5, 'Fruits bios');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `login` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mdp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prenom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numTel` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('client','gerant','admin') COLLATE utf8mb4_unicode_ci DEFAULT 'client',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `login`, `mdp`, `nom`, `prenom`, `numTel`, `mail`, `role`) VALUES
(13, 'maliciaax', '$2y$10$YXMMuSYVrAvgdfAlDtUEU.Z78EIArtORsHaatFHYy6Q4whLv5mkL6', 'Mans', 'Malicia', '0666536695', 'mans.malicia@gmail.com', 'client'),
(14, 'test', '$2y$10$GTAzYVhmakD6ZwYAwHGbNOXq.oJ/QErLULBzbeG6fbf17bOCpcHta', 'Mans', 'Malicia', '0666536695', 'mans.malicia@gmail.com', 'client'),
(15, 'gerantTest', '$2y$10$uk/9vNzlEMKdlnPItitNMu1e2slnGkvubS2nPXtWbwrJtmdOm546G', 'Mans', 'Malicia', '0666536695', 'mans.malicia@gmail.com', 'gerant'),
(16, 'gerant2', '$2y$10$4ZyaKo9dBiDeV6nn078PQOJ6f6tC23wfkt3nJ5YMbKOEo00L5Bem6', 'Judas', 'Nanas', '0666666666', 'judas.nanas@gmail.com', 'gerant'),
(17, 'HenriTran', '$2y$10$Z7jU6iBDUj6q1j0mlZs4c.qD1N19PAJPQ8l4cyDCIcWUGi.2tFpLO', 'Tran', 'Henri', '0678954215', 'henri-le-plus-fort@gmail.com', 'gerant'),
(18, 'Judananas', '$2y$10$SxprSRwMdJS0S0A2GNY.EewektU4oUkh/mwgDyBp8B6YYQYTo/g6C', 'LeGoff', 'Erwan', '0645572541', 'judananas@gmail.com', 'client');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
