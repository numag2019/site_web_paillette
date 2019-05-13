-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 06 mai 2019 à 07:06
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `crabase`
--

-- --------------------------------------------------------

--
-- Structure de la table `bovins`
--

DROP TABLE IF EXISTS `bovins`;
CREATE TABLE IF NOT EXISTS `bovins` (
  `id_bovin` varchar(40) NOT NULL,
  `nom_bovin` varchar(30) NOT NULL,
  `sexe` tinyint(4) NOT NULL,
  `mort` tinyint(1) NOT NULL,
  `id_race` tinyint(3) UNSIGNED NOT NULL,
  `id_utilisateur` smallint(5) UNSIGNED NOT NULL,
  PRIMARY KEY (`id_bovin`),
  KEY `id_race` (`id_race`),
  KEY `id_utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `bovins_intermediaire`
--

DROP TABLE IF EXISTS `bovins_intermediaire`;
CREATE TABLE IF NOT EXISTS `bovins_intermediaire` (
  `id_bovin` varchar(40) NOT NULL,
  `nom_bovin` varchar(30) NOT NULL,
  `sexe` tinyint(4) NOT NULL,
  `mort` tinyint(1) NOT NULL,
  `id_race` tinyint(3) UNSIGNED NOT NULL,
  `id_eleveur` smallint(5) UNSIGNED NOT NULL,
  PRIMARY KEY (`id_bovin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `coefficients`
--

DROP TABLE IF EXISTS `coefficients`;
CREATE TABLE IF NOT EXISTS `coefficients` (
  `id_coeff` int(11) NOT NULL,
  `valeur_coeff` int(11) NOT NULL,
  `id_vache` varchar(40) NOT NULL,
  `id_taureau` varchar(40) NOT NULL,
  PRIMARY KEY (`id_coeff`),
  KEY `coefficients_ibfk_1` (`id_taureau`),
  KEY `coefficients_ibfk_2` (`id_vache`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `coefficients_intermediaire`
--

DROP TABLE IF EXISTS `coefficients_intermediaire`;
CREATE TABLE IF NOT EXISTS `coefficients_intermediaire` (
  `id_coeff_int` smallint(6) NOT NULL AUTO_INCREMENT,
  `valeur_coeff` decimal(4,2) NOT NULL,
  `id_vache` smallint(6) NOT NULL,
  `id_taureau` smallint(6) NOT NULL,
  PRIMARY KEY (`id_coeff_int`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `eleveurs_intermediaire`
--

DROP TABLE IF EXISTS `eleveurs_intermediaire`;
CREATE TABLE IF NOT EXISTS `eleveurs_intermediaire` (
  `id_eleveur` int(10) UNSIGNED NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id_eleveur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `periodes`
--

DROP TABLE IF EXISTS `periodes`;
CREATE TABLE IF NOT EXISTS `periodes` (
  `id_periode` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `date_debut` date NOT NULL,
  `date_fin` date DEFAULT NULL,
  `id_race` tinyint(3) UNSIGNED NOT NULL,
  PRIMARY KEY (`id_periode`),
  KEY `race` (`id_race`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `previsions`
--

DROP TABLE IF EXISTS `previsions`;
CREATE TABLE IF NOT EXISTS `previsions` (
  `id_prevision` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nbr_paillettes` varchar(10) NOT NULL,
  `id_periode` tinyint(3) UNSIGNED NOT NULL,
  `id_vache` varchar(40) NOT NULL,
  `id_taureau` varchar(40) NOT NULL,
  PRIMARY KEY (`id_prevision`),
  KEY `id_periode` (`id_periode`),
  KEY `id_taureau` (`id_taureau`),
  KEY `previsions_ibfk_3` (`id_vache`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `races`
--

DROP TABLE IF EXISTS `races`;
CREATE TABLE IF NOT EXISTS `races` (
  `id_race` tinyint(3) UNSIGNED NOT NULL,
  `nom_race` varchar(40) NOT NULL,
  `seuil_min` decimal(4,2) DEFAULT NULL,
  `seuil_max` decimal(4,2) DEFAULT NULL,
  PRIMARY KEY (`id_race`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `races_intermediaire`
--

DROP TABLE IF EXISTS `races_intermediaire`;
CREATE TABLE IF NOT EXISTS `races_intermediaire` (
  `id_race_int` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom_race` varchar(20) NOT NULL,
  PRIMARY KEY (`id_race_int`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `type_utilisateur`
--

DROP TABLE IF EXISTS `type_utilisateur`;
CREATE TABLE IF NOT EXISTS `type_utilisateur` (
  `id_type` tinyint(3) UNSIGNED NOT NULL,
  `libelle_type` varchar(30) NOT NULL,
  PRIMARY KEY (`id_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Attribution des droits';

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id_utilisateur` smallint(5) UNSIGNED NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(80) DEFAULT NULL,
  `identifiant` varchar(30) DEFAULT NULL,
  `mdp` char(8) DEFAULT NULL,
  `id_type` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `id_race_admin` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id_utilisateur`),
  KEY `id_type` (`id_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='table des utilisateurs';

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `bovins`
--
ALTER TABLE `bovins`
  ADD CONSTRAINT `bovins_ibfk_1` FOREIGN KEY (`id_race`) REFERENCES `races` (`id_race`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bovins_ibfk_2` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `coefficients`
--
ALTER TABLE `coefficients`
  ADD CONSTRAINT `coefficients_ibfk_1` FOREIGN KEY (`id_taureau`) REFERENCES `bovins` (`id_bovin`),
  ADD CONSTRAINT `coefficients_ibfk_2` FOREIGN KEY (`id_vache`) REFERENCES `bovins` (`id_bovin`);

--
-- Contraintes pour la table `periodes`
--
ALTER TABLE `periodes`
  ADD CONSTRAINT `race` FOREIGN KEY (`id_race`) REFERENCES `races` (`id_race`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `previsions`
--
ALTER TABLE `previsions`
  ADD CONSTRAINT `previsions_ibfk_1` FOREIGN KEY (`id_periode`) REFERENCES `periodes` (`id_periode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `previsions_ibfk_2` FOREIGN KEY (`id_taureau`) REFERENCES `bovins` (`id_bovin`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `previsions_ibfk_3` FOREIGN KEY (`id_vache`) REFERENCES `bovins` (`id_bovin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD CONSTRAINT `utilisateurs_ibfk_1` FOREIGN KEY (`id_type`) REFERENCES `type_utilisateur` (`id_type`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
