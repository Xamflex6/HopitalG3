-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : ven. 20 déc. 2024 à 11:06
-- Version du serveur : 11.3.2-MariaDB
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_soins_intensifs`
--

-- --------------------------------------------------------

--
-- Structure de la table `alerte_intensif`
--

DROP TABLE IF EXISTS `alerte_intensif`;
CREATE TABLE IF NOT EXISTS `alerte_intensif` (
  `alerte_id` int(11) NOT NULL AUTO_INCREMENT,
  `alerte_type` enum('lit','equipement') DEFAULT NULL,
  `alerte_description` varchar(255) DEFAULT NULL,
  `resolu` tinyint(1) DEFAULT NULL,
  `date_creation` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`alerte_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `alerte_intensif`
--

INSERT INTO `alerte_intensif` (`alerte_id`, `alerte_type`, `alerte_description`, `resolu`, `date_creation`) VALUES
(1, 'lit', 'ih rfzeguio gipoer ge^ge', 0, '2024-12-19 15:16:25'),
(2, 'lit', 'uwu', 0, '2024-12-19 17:16:40'),
(5, 'equipement', 'Ceci n\'est pas une description', 1, '2024-12-20 12:04:13');

-- --------------------------------------------------------

--
-- Structure de la table `equipement_intensif`
--

DROP TABLE IF EXISTS `equipement_intensif`;
CREATE TABLE IF NOT EXISTS `equipement_intensif` (
  `equipement_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_equipement` varchar(255) DEFAULT NULL,
  `disponible` tinyint(1) DEFAULT 1,
  `date_modification` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`equipement_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `equipement_intensif`
--

INSERT INTO `equipement_intensif` (`equipement_id`, `type_equipement`, `disponible`, `date_modification`) VALUES
(1, 'Moniteur de fréquence cardiaque', 1, '2024-12-20 09:27:46'),
(2, 'moniteur de temperature', 1, '2024-12-20 09:27:49'),
(3, 'moniteur multiparametrique', 1, '2024-12-20 09:27:54'),
(4, 'ventilateur mecanique', 1, '2024-12-20 09:27:58'),
(5, 'Moniteur de fréquence cardiaque', 1, '2024-12-20 09:41:33');

-- --------------------------------------------------------

--
-- Structure de la table `lit_intensif`
--

DROP TABLE IF EXISTS `lit_intensif`;
CREATE TABLE IF NOT EXISTS `lit_intensif` (
  `lit_id` int(11) NOT NULL AUTO_INCREMENT,
  `disponible` tinyint(1) DEFAULT 1,
  `type_lit` enum('Standard','Pédiatrique','Intensif') DEFAULT NULL,
  `date_creation` datetime DEFAULT current_timestamp(),
  `date_modification` datetime DEFAULT current_timestamp(),
  `chambre` int(11) DEFAULT NULL,
  PRIMARY KEY (`lit_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `lit_intensif`
--

INSERT INTO `lit_intensif` (`lit_id`, `disponible`, `type_lit`, `date_creation`, `date_modification`, `chambre`) VALUES
(1, 1, 'Intensif', '2024-12-19 09:52:37', '2024-12-19 09:52:37', 42),
(2, 1, 'Standard', '2024-12-19 11:44:49', '2024-12-19 11:44:49', 42),
(3, 1, 'Standard', '2024-12-19 11:45:02', '2024-12-19 11:45:02', 42),
(4, 1, 'Standard', '2024-12-19 11:50:23', '2024-12-19 11:50:23', NULL),
(5, 1, 'Standard', '2024-12-19 11:50:30', '2024-12-19 11:50:30', NULL),
(6, 1, 'Standard', '2024-12-19 11:51:21', '2024-12-19 11:51:21', NULL),
(7, 0, 'Standard', '2024-12-19 11:55:23', '2024-12-19 11:55:23', NULL),
(8, 0, 'Intensif', '2024-12-19 11:56:33', '2024-12-19 11:56:33', NULL),
(9, 1, 'Pédiatrique', '2024-12-19 11:56:48', '2024-12-19 11:56:48', NULL),
(10, 1, 'Pédiatrique', '2024-12-19 11:56:57', '2024-12-19 11:56:57', NULL),
(11, 1, 'Standard', '2024-12-19 11:59:06', '2024-12-19 11:59:06', 1),
(12, 1, 'Standard', '2024-12-19 11:59:24', '2024-12-19 11:59:24', 1),
(13, 1, 'Standard', '2024-12-19 12:00:24', '2024-12-19 12:00:24', 1),
(14, 1, 'Standard', '2024-12-19 12:01:23', '2024-12-19 12:01:23', 1),
(15, 1, 'Standard', '2024-12-19 12:02:01', '2024-12-19 12:02:01', 0),
(16, 1, 'Standard', '2024-12-19 12:16:49', '2024-12-19 12:16:49', NULL),
(17, 1, 'Standard', '2024-12-19 14:24:48', '2024-12-19 14:24:48', NULL),
(18, 1, 'Intensif', '2024-12-19 14:25:48', '2024-12-19 14:25:48', NULL),
(19, 0, 'Intensif', '2024-12-19 14:25:59', '2024-12-19 14:25:59', NULL),
(20, 0, 'Pédiatrique', '2024-12-19 20:21:14', '2024-12-19 20:21:14', NULL),
(21, 0, 'Standard', '2024-12-19 20:21:30', '2024-12-19 20:21:30', NULL),
(22, 0, 'Standard', '2024-12-19 20:22:19', '2024-12-19 20:22:19', NULL),
(23, 1, 'Standard', '2024-12-19 20:23:56', '2024-12-19 20:23:56', 458);

-- --------------------------------------------------------

--
-- Structure de la table `patient_intensif`
--

DROP TABLE IF EXISTS `patient_intensif`;
CREATE TABLE IF NOT EXISTS `patient_intensif` (
  `patient_id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `date_naissance` datetime DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `actif` tinyint(1) DEFAULT NULL,
  `date_creation` datetime DEFAULT current_timestamp(),
  `date_modification` datetime DEFAULT current_timestamp(),
  `lit_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`patient_id`),
  KEY `lit_id` (`lit_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `patient_intensif`
--

INSERT INTO `patient_intensif` (`patient_id`, `nom`, `prenom`, `date_naissance`, `contact`, `adresse`, `actif`, `date_creation`, `date_modification`, `lit_id`) VALUES
(1, 'uwu', 'aaaaaa', '2024-12-03 00:00:00', ';drop database db_soins_intensifs;', 'uwu rue des awa', NULL, '2024-12-19 07:54:25', '2024-12-19 07:54:25', 42),
(9, 'boby', 'Bryan', '2010-01-19 00:00:00', '068904865', 'rue des flop', NULL, '2024-12-19 19:20:47', '2024-12-19 19:20:47', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `personnel_medical_intensif`
--

DROP TABLE IF EXISTS `personnel_medical_intensif`;
CREATE TABLE IF NOT EXISTS `personnel_medical_intensif` (
  `personned_medical_id` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `date_naissance` datetime DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `specialite` varchar(255) DEFAULT NULL,
  `date_creation` datetime DEFAULT current_timestamp(),
  `date_modification` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`personned_medical_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
