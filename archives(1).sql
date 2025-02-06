-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 17 mars 2022 à 15:30
-- Version du serveur : 5.7.23
-- Version de PHP : 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `archives`
--

-- --------------------------------------------------------

--
-- Structure de la table `annees`
--

DROP TABLE IF EXISTS `annees`;
CREATE TABLE IF NOT EXISTS `annees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `annee` int(4) DEFAULT NULL,
  `mois` int(2) DEFAULT NULL,
  `jour` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `boites`
--

DROP TABLE IF EXISTS `boites`;
CREATE TABLE IF NOT EXISTS `boites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `boite` varchar(255) NOT NULL,
  `desc_boite` text,
  `id_etagere` int(11) NOT NULL,
  `date_creation_boite` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `boites`
--

INSERT INTO `boites` (`id`, `boite`, `desc_boite`, `id_etagere`, `date_creation_boite`, `update_at`) VALUES
(1, 'ARTILLESS', 'CONTENU DES ARTICLES CONFIDENTIELS ', 2, '2022-02-27 00:00:30', '2022-02-27 00:05:22');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(60) NOT NULL,
  `desc_cat` varchar(255) DEFAULT NULL,
  `id_service` int(11) DEFAULT NULL,
  `date_creation_cat` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `designation`, `desc_cat`, `id_service`, `date_creation_cat`, `update_at`) VALUES
(1, 'ANL', 'ATTESTATION DE NON LOGEMENT', 1, '2022-03-07 14:22:09', '2022-03-07 14:22:09'),
(2, 'CESSION', 'DOMAINE DES CESSIONS', 1, '2022-03-07 14:22:09', '2022-03-07 14:22:09'),
(3, 'RESSOURCES HUMAINES', 'DOMAINES DES RESSOURCES HUMAINES', 5, '2022-03-07 14:24:25', '2022-03-07 14:24:25'),
(4, 'BAUX', 'DOMAINE DES BEAUX', 1, '2022-03-07 14:24:25', '2022-03-07 14:24:25');

-- --------------------------------------------------------

--
-- Structure de la table `cotes`
--

DROP TABLE IF EXISTS `cotes`;
CREATE TABLE IF NOT EXISTS `cotes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) CHARACTER SET utf8 NOT NULL,
  `date_creation_cotes` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_cotes` (`libelle`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cotes`
--

INSERT INTO `cotes` (`id`, `libelle`, `date_creation_cotes`, `update_at`) VALUES
(1, 'ARCHIVES', '2022-01-06 00:03:58', '2022-01-06 00:03:58'),
(2, 'MARKETING INTER', '2022-01-06 00:08:18', '2022-01-08 13:59:10'),
(3, 'DIRECTION INFORMATIQUE', '2022-01-12 15:54:34', '2022-01-12 15:54:34');

-- --------------------------------------------------------

--
-- Structure de la table `depot`
--

DROP TABLE IF EXISTS `depot`;
CREATE TABLE IF NOT EXISTS `depot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user_depot` varchar(255) NOT NULL,
  `id_emprunt` int(11) NOT NULL,
  `date_depot` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `depot`
--

INSERT INTO `depot` (`id`, `id_user_depot`, `id_emprunt`, `date_depot`) VALUES
(11, '15896M - BILETO LATAILLE', 19, '2022-02-18 15:14:00'),
(10, '1234A - LOBOGNON LOBOGNON', 18, '2022-01-12 11:11:00'),
(9, '12451A - CAMSO CAMSO', 17, '2022-01-13 10:12:00');

-- --------------------------------------------------------

--
-- Structure de la table `documents`
--

DROP TABLE IF EXISTS `documents`;
CREATE TABLE IF NOT EXISTS `documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference` varchar(60) DEFAULT NULL,
  `libelle` varchar(60) DEFAULT NULL,
  `description` text,
  `tauxindem` varchar(255) DEFAULT NULL,
  `gains` varchar(255) DEFAULT NULL,
  `retenues` varchar(255) DEFAULT NULL,
  `montant` varchar(255) DEFAULT NULL,
  `reglement` varchar(255) DEFAULT NULL,
  `compte` varchar(255) DEFAULT NULL,
  `pieces` varchar(100) DEFAULT NULL,
  `logroupe` varchar(255) DEFAULT NULL,
  `ville` varchar(255) DEFAULT NULL,
  `baille` varchar(255) DEFAULT NULL,
  `logement` varchar(255) DEFAULT NULL,
  `arriere` varchar(255) DEFAULT NULL,
  `solde` varchar(255) DEFAULT NULL,
  `nbrep` varchar(200) DEFAULT NULL,
  `expertise` varchar(255) DEFAULT NULL,
  `decision` varchar(255) DEFAULT NULL,
  `imputation` varchar(255) DEFAULT NULL,
  `duree` varchar(255) DEFAULT NULL,
  `effet` date DEFAULT NULL,
  `retour` date DEFAULT NULL,
  `codebanque` varchar(255) DEFAULT NULL,
  `codeguichet` varchar(255) DEFAULT NULL,
  `domiciliation` varchar(255) DEFAULT NULL,
  `rib` varchar(255) DEFAULT NULL,
  `etabli` date DEFAULT NULL,
  `actif` enum('1','0') NOT NULL DEFAULT '1',
  `status` varchar(50) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `id_cat` int(11) NOT NULL,
  `id_dos` int(11) NOT NULL,
  `id_types` int(11) NOT NULL DEFAULT '1',
  `id_usager` int(11) DEFAULT NULL,
  `date_creation_doc` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_document_user` (`id_user`),
  KEY `fk_document_categorie` (`id_cat`),
  KEY `fk_idtypes` (`id_types`),
  KEY `fk_document_dossier` (`id_dos`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `documents`
--

INSERT INTO `documents` (`id`, `reference`, `libelle`, `description`, `tauxindem`, `gains`, `retenues`, `montant`, `reglement`, `compte`, `pieces`, `logroupe`, `ville`, `baille`, `logement`, `arriere`, `solde`, `nbrep`, `expertise`, `decision`, `imputation`, `duree`, `effet`, `retour`, `codebanque`, `codeguichet`, `domiciliation`, `rib`, `etabli`, `actif`, `status`, `id_user`, `id_cat`, `id_dos`, `id_types`, `id_usager`, `date_creation_doc`, `update_at`) VALUES
(2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 2, 1, 1, 1, 3, '2022-03-12 13:06:40', '2022-03-16 18:51:02'),
(3, '12365', 'direct', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-10', '1', NULL, 2, 1, 1, 2, 3, '2022-03-12 13:36:35', '2022-03-12 13:36:35'),
(4, '12365', 'taf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-16', '1', NULL, 2, 1, 1, 2, 3, '2022-03-12 13:41:31', '2022-03-12 13:41:31'),
(5, '1458A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-01', '1', NULL, 2, 1, 1, 1, 2, '2022-03-12 13:55:33', '2022-03-12 13:55:33'),
(6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 2, 1, 1, 2, 3, '2022-03-12 13:59:26', '2022-03-12 13:59:26'),
(7, '1258', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-09', '1', NULL, 2, 1, 1, 1, 3, '2022-03-12 14:25:09', '2022-03-12 14:25:09'),
(8, '12347', 'master', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-02', '1', NULL, 2, 1, 1, 2, 2, '2022-03-12 14:27:39', '2022-03-12 14:27:39'),
(9, 'ds15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-15', '1', NULL, 2, 1, 1, 3, 3, '2022-03-12 14:29:23', '2022-03-12 14:29:23'),
(10, 'gh45', NULL, NULL, '200', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-01', '1', NULL, 2, 1, 1, 4, 3, '2022-03-12 14:43:46', '2022-03-12 14:43:46'),
(11, '14558i', 'BAIL', NULL, NULL, '215', '200', '1000', 'baci', '145569872', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-01', '1', NULL, 2, 1, 1, 5, 3, '2022-03-12 14:58:54', '2022-03-12 14:58:54'),
(12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'yam', NULL, '201', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 2, 2, 1, 7, 3, '2022-03-12 15:17:28', '2022-03-12 15:17:28'),
(13, '456A', NULL, NULL, NULL, NULL, NULL, '2000000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-15', '1', NULL, 2, 2, 1, 8, 2, '2022-03-12 15:22:30', '2022-03-12 15:22:30'),
(15, '012365', NULL, NULL, NULL, NULL, NULL, '20000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '15000', '20000', '2', '15at', '1256', NULL, NULL, '2020-02-01', NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 2, 2, 1, 9, 3, '2022-03-12 15:39:47', '2022-03-12 15:39:47'),
(16, '123655A', 'ARRET DE TRAVAIL', 'arret de travail du mardi 16 au jeudi 18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-16', '1', NULL, 2, 3, 1, 10, 3, '2022-03-12 15:52:30', '2022-03-12 15:52:30'),
(17, '14587', 'FOURNITURE DE BUREAU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-17', '1', NULL, 2, 3, 1, 12, 2, '2022-03-12 16:36:18', '2022-03-12 16:36:18'),
(18, '14587', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-02', '1', NULL, 2, 3, 1, 11, 3, '2022-03-12 16:37:55', '2022-03-12 16:37:55'),
(19, 'GF154', NULL, 'BIEN RAS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-15', '1', NULL, 2, 3, 1, 11, 2, '2022-03-12 16:41:21', '2022-03-12 16:41:21'),
(20, '145R', NULL, 'VISITE TECHNIQUE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '200000', NULL, NULL, '2022-03-11', NULL, NULL, NULL, NULL, '2022-03-16', '1', NULL, 2, 3, 1, 13, 3, '2022-03-12 17:17:10', '2022-03-12 17:17:10'),
(21, '145', NULL, 'RAS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '250000', NULL, '2022-03-01', '2022-03-23', NULL, NULL, NULL, NULL, '2022-03-11', '1', NULL, 2, 3, 1, 13, 3, '2022-03-12 17:19:53', '2022-03-12 17:19:53'),
(22, '145478874', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1417181612', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '151', '15', 'baci', '12', NULL, '1', NULL, 2, 4, 1, 18, 3, '2022-03-12 17:51:16', '2022-03-12 17:51:16'),
(23, '32145', NULL, 'RAS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-08', '1', NULL, 2, 4, 1, 17, 2, '2022-03-12 17:52:57', '2022-03-12 17:52:57'),
(24, '12589', 'AVENANT DE CONTRAT', 'RAS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2mois', NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-25', '1', NULL, 2, 4, 1, 19, 3, '2022-03-12 18:02:36', '2022-03-12 18:02:36'),
(25, '5489', 'CONTRAT DE BAIL', 'RAS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1an', '2022-03-09', NULL, NULL, NULL, NULL, NULL, '2022-03-22', '1', NULL, 2, 4, 1, 19, 3, '2022-03-12 18:06:20', '2022-03-12 18:06:20');

-- --------------------------------------------------------

--
-- Structure de la table `dossiers`
--

DROP TABLE IF EXISTS `dossiers`;
CREATE TABLE IF NOT EXISTS `dossiers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dossier` varchar(255) NOT NULL,
  `desc_dossier` text,
  `id_cat` int(11) NOT NULL,
  `id_boite` int(11) NOT NULL,
  `date_creation_dossier` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `dossiers`
--

INSERT INTO `dossiers` (`id`, `dossier`, `desc_dossier`, `id_cat`, `id_boite`, `date_creation_dossier`, `update_at`) VALUES
(1, 'ABOBO BAOULE', 'ABOBO VILLE ', 4, 1, '2022-02-27 00:51:11', '2022-02-27 00:53:31');

-- --------------------------------------------------------

--
-- Structure de la table `emplacements`
--

DROP TABLE IF EXISTS `emplacements`;
CREATE TABLE IF NOT EXISTS `emplacements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `casier` varchar(255) NOT NULL,
  `date_creation_emp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`,`casier`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `emplacements`
--

INSERT INTO `emplacements` (`id`, `casier`, `date_creation_emp`, `update_at`) VALUES
(2, 'C2', '2022-01-08 14:59:04', '2022-01-08 14:59:04'),
(3, 'C3', '2022-01-12 15:56:39', '2022-02-05 15:06:48');

-- --------------------------------------------------------

--
-- Structure de la table `emprunter`
--

DROP TABLE IF EXISTS `emprunter`;
CREATE TABLE IF NOT EXISTS `emprunter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_entrees` int(11) NOT NULL,
  `date_emprunt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status_emp` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_id_user` (`id_user`),
  KEY `fk_id_entree` (`id_entrees`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `emprunter`
--

INSERT INTO `emprunter` (`id`, `id_user`, `id_entrees`, `date_emprunt`, `status_emp`) VALUES
(19, 3, 5, '2022-02-03 14:15:00', '0'),
(18, 6, 4, '2022-01-04 10:00:00', '0'),
(17, 4, 4, '2022-01-04 14:08:00', '0'),
(16, 2, 5, '2022-01-12 12:12:00', '0'),
(15, 5, 4, '2022-01-04 11:00:00', '0'),
(14, 4, 3, '2021-12-28 15:20:00', '0');

-- --------------------------------------------------------

--
-- Structure de la table `entrees`
--

DROP TABLE IF EXISTS `entrees`;
CREATE TABLE IF NOT EXISTS `entrees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `id_cote` varchar(255) NOT NULL,
  `id_cat` varchar(255) NOT NULL,
  `id_rayon` varchar(255) NOT NULL,
  `id_empl` varchar(255) NOT NULL,
  `id_type` varchar(255) NOT NULL,
  `status_entrees` enum('1','0') NOT NULL DEFAULT '0',
  `date_creation_ent` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_idcategory` (`id_cat`),
  KEY `fk_idrayon` (`id_rayon`),
  KEY `fk_idempl` (`id_empl`),
  KEY `fk_idtype` (`id_type`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `entrees`
--

INSERT INTO `entrees` (`id`, `name`, `description`, `id_cote`, `id_cat`, `id_rayon`, `id_empl`, `id_type`, `status_entrees`, `date_creation_ent`, `update_at`) VALUES
(4, 'ITMAN', 'TESTQSDFG', 'MARKETING INTER', 'FACTURE ', 'IINFORMATIQUES', 'C2', 'JURIDIQUES', '0', '2022-01-11 18:56:06', '2022-01-12 11:00:17'),
(3, 'MON DOC', 'TESTA', 'MARKETING INTER', 'RAPPORT DE REUNION', 'IINFORMATIQUES', 'C2', 'IINFORMATIQUES', '0', '2022-01-11 12:31:20', '2022-01-11 13:39:15'),
(5, 'FACTURE IMMOBILIERE', 'TEST', 'DIRECTION INFORMATIQUE', 'CESSION', 'RESSOURCES HUMAINES', 'CASIER 3', 'FACTURE', '0', '2022-01-12 15:57:54', '2022-01-12 16:01:51');

-- --------------------------------------------------------

--
-- Structure de la table `etageres`
--

DROP TABLE IF EXISTS `etageres`;
CREATE TABLE IF NOT EXISTS `etageres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `etagere` varchar(255) NOT NULL,
  `id_rayon` int(11) DEFAULT NULL,
  `date_creation_etag` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `etageres`
--

INSERT INTO `etageres` (`id`, `etagere`, `id_rayon`, `date_creation_etag`, `update_at`) VALUES
(2, 'BASIQUES', 5, '2022-02-25 11:37:52', '2022-02-25 11:41:44');

-- --------------------------------------------------------

--
-- Structure de la table `fichiers`
--

DROP TABLE IF EXISTS `fichiers`;
CREATE TABLE IF NOT EXISTS `fichiers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fichier` varchar(255) NOT NULL,
  `type` varchar(60) DEFAULT NULL,
  `actif` enum('1','0') NOT NULL DEFAULT '1',
  `date_creation` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `id_doc` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_fichier_doc` (`id_doc`)
) ENGINE=MyISAM AUTO_INCREMENT=65 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `fichiers`
--

INSERT INTO `fichiers` (`id`, `fichier`, `type`, `actif`, `date_creation`, `update_at`, `id_doc`) VALUES
(1, '82857_Bourse_ITA.pdf', 'pdf', '1', '2022-02-01 15:34:13', '2022-02-01 15:34:13', 1),
(2, '82857_generated_2.pdf', 'pdf', '1', '2022-02-01 15:34:13', '2022-02-01 15:34:13', 1),
(3, '32253_generated_2.pdf', 'pdf', '0', '2022-02-01 16:34:13', '2022-03-16 14:32:34', 2),
(4, '54901_CV_AICHA.pdf', 'pdf', '1', '2022-02-01 17:32:55', '2022-02-01 17:32:55', 3),
(5, '66070_M_Jeudi.pdf', 'pdf', '1', '2022-02-01 17:38:27', '2022-02-01 17:38:27', 4),
(6, '55841_M_Vendredi.pdf', 'pdf', '1', '2022-02-01 17:55:00', '2022-02-01 17:55:00', 5),
(7, '14175_M_Mardi.pdf', 'pdf', '0', '2022-02-01 23:36:14', '2022-02-01 23:42:53', 6),
(8, '14175_ecosarl.png', 'png', '1', '2022-02-01 23:36:14', '2022-02-01 23:36:14', 6),
(9, '46605_bibliotheque.png', 'png', '1', '2022-02-01 23:47:36', '2022-02-01 23:47:36', 6),
(10, '61fa75a3ca6df.jpeg', 'jpeg', '1', '2022-02-02 12:16:26', '2022-02-02 12:16:26', 7),
(11, '8569_1.jpeg', 'jpeg', '1', '2022-02-02 12:16:26', '2022-02-02 12:16:26', 7),
(12, '61fa79693cfbe.jpg', 'jpeg', '1', '2022-02-02 12:31:55', '2022-02-02 12:31:55', 8),
(13, '84631_3.png', 'png', '1', '2022-02-02 12:31:55', '2022-02-02 12:31:55', 8),
(14, '61fa7d721097e.jpg', 'jpeg', '1', '2022-02-02 12:47:53', '2022-02-02 12:47:53', 9),
(15, '92948_7.png', 'png', '1', '2022-02-02 12:47:53', '2022-02-02 12:47:53', 9),
(19, '98267_videoconference.pdf', 'pdf', '1', '2022-02-02 14:34:18', '2022-02-02 14:34:18', 11),
(18, '61fa9666727d5.jpg', 'jpeg', '1', '2022-02-02 14:34:18', '2022-02-02 14:34:18', 11),
(20, '61fa96f98ad6a.jpg', 'jpeg', '1', '2022-02-02 14:36:43', '2022-02-02 14:36:43', 12),
(21, '10444_bachelier.png', 'png', '1', '2022-02-02 14:36:43', '2022-02-02 14:36:43', 12),
(22, 'aicha.png', 'png', '1', '2022-02-02 18:37:25', '2022-02-02 18:37:25', 13),
(23, '72126_convocation_14508352.pdf', 'pdf', '1', '2022-02-03 12:37:08', '2022-02-03 12:37:08', 14),
(24, '72126_4.png', 'png', '1', '2022-02-03 12:37:08', '2022-02-03 12:37:08', 14),
(25, '44452_diplome.png', 'png', '1', '2022-02-04 12:07:25', '2022-02-04 12:07:25', 15),
(26, '44452_videoconference.pdf', 'pdf', '1', '2022-02-04 12:07:25', '2022-02-04 12:07:25', 15),
(27, '18574_Trouvez_votre_p-WPS_Office.pdf', 'pdf', '1', '2022-02-04 14:06:28', '2022-02-04 14:06:28', 16),
(28, '18574_DEVIS_3_modifie.pdf', 'pdf', '1', '2022-02-04 14:06:28', '2022-02-04 14:06:28', 16),
(29, '95730_21.csv', 'csv', '1', '2022-02-07 13:53:57', '2022-02-07 13:53:57', 17),
(30, '95730_Document.pdf', 'pdf', '1', '2022-02-07 13:53:57', '2022-02-07 13:53:57', 17),
(31, '69813_DEZY_CHAMPION_-_HOPITAL_-_ALBUM_MON_JUBILE_2015_[AJo3_p7mC-4]_(1).mp3', 'mp3', '1', '2022-02-07 13:57:39', '2022-02-07 13:57:39', 17),
(32, '620279b669456.jpg', 'jpg', '1', '2022-02-08 14:12:00', '2022-02-08 14:12:00', 18),
(33, '67929_Techno_Batiment_2.mp4', 'mp4', '1', '2022-02-08 14:12:00', '2022-02-08 14:12:00', 18),
(34, '67929_guidetudiant.pdf', 'pdf', '1', '2022-02-08 14:12:00', '2022-02-08 14:12:00', 18),
(35, '59520_diplome.pdf', 'pdf', '1', '2022-02-09 16:21:44', '2022-02-09 16:21:44', 19),
(36, '59520_22.csv', 'csv', '1', '2022-02-09 16:21:44', '2022-02-09 16:21:44', 19),
(37, '48440_._techno.pdf', 'pdf', '1', '2022-02-09 16:37:53', '2022-02-09 16:37:53', 19),
(38, '75590_PROGRAMME_DE_COMPOSITION_N1.pdf', 'pdf', '0', '2022-02-11 18:01:28', '2022-03-16 13:52:42', 20),
(39, '38882_cv_aicha.pdf', 'pdf', '1', '2022-03-12 12:54:32', '2022-03-12 12:54:32', 1),
(40, '49961_cv_aicha.pdf', 'pdf', '1', '2022-03-12 13:06:40', '2022-03-12 13:06:40', 2),
(41, '88265_photo.PNG', 'png', '1', '2022-03-12 13:36:35', '2022-03-12 13:36:35', 3),
(42, '88699_CV_S.docx', 'docx', '1', '2022-03-12 13:41:31', '2022-03-12 13:41:31', 4),
(43, '11352_attestation_de_travail.jpg', 'jpg', '1', '2022-03-12 13:55:33', '2022-03-12 13:55:33', 5),
(44, '8246_DIAKITE_Ibrahima_Sory.docx', 'docx', '1', '2022-03-12 13:59:26', '2022-03-12 13:59:26', 6),
(45, '1285_CV_S.docx', 'docx', '1', '2022-03-12 14:01:23', '2022-03-12 14:01:23', 0),
(46, '81792_CV_S.docx', 'docx', '1', '2022-03-12 14:25:09', '2022-03-12 14:25:09', 7),
(47, '30369_DIAKITE_Ibrahima_Sory.docx', 'docx', '1', '2022-03-12 14:27:39', '2022-03-12 14:27:39', 8),
(48, '33360_DIAKITE_Ibrahima_Sory.docx', 'docx', '1', '2022-03-12 14:29:23', '2022-03-12 14:29:23', 9),
(49, '10520_DIAKITE_Ibrahima_Sory.docx', 'docx', '1', '2022-03-12 14:43:46', '2022-03-12 14:43:46', 10),
(50, '26141_DIAKITE_Ibrahima_Sory.docx', 'docx', '1', '2022-03-12 14:58:54', '2022-03-12 14:58:54', 11),
(51, '52495_DIAKITE_Ibrahima_Sory.docx', 'docx', '1', '2022-03-12 15:17:28', '2022-03-12 15:17:28', 12),
(52, '88135_Admission.jpg', 'jpg', '1', '2022-03-12 15:22:30', '2022-03-12 15:22:30', 13),
(53, '54395_attestation_de_stage.jpg', 'jpg', '1', '2022-03-12 15:37:59', '2022-03-12 15:37:59', 14),
(54, '57997_DIAKITE_Ibrahima_Sory.docx', 'docx', '1', '2022-03-12 15:39:47', '2022-03-12 15:39:47', 15),
(55, '61543_CV_S.docx', 'docx', '1', '2022-03-12 15:52:30', '2022-03-12 15:52:30', 16),
(56, '50656_CV_S.docx', 'docx', '1', '2022-03-12 16:36:18', '2022-03-12 16:36:18', 17),
(57, '24719_attestation_de_travail.jpg', 'jpg', '1', '2022-03-12 16:37:55', '2022-03-12 16:37:55', 18),
(58, '24296_CV_S.docx', 'docx', '1', '2022-03-12 16:41:21', '2022-03-12 16:41:21', 19),
(59, '75811_SEMESTRE_1_ANNEE_1.jpg', 'jpg', '1', '2022-03-12 17:17:10', '2022-03-12 17:17:10', 20),
(60, '35504_CV_S.docx', 'docx', '1', '2022-03-12 17:19:53', '2022-03-12 17:19:53', 21),
(61, '20796_CISSAO_Mamadou.docx', 'docx', '1', '2022-03-12 17:51:16', '2022-03-12 17:51:16', 22),
(62, '45641_CV_S.docx', 'docx', '1', '2022-03-12 17:52:57', '2022-03-12 17:52:57', 23),
(63, '57772_DIAKITE_Ibrahima_Sory.docx', 'docx', '1', '2022-03-12 18:02:36', '2022-03-12 18:02:36', 24),
(64, '49709_CV_S.docx', 'docx', '1', '2022-03-12 18:06:20', '2022-03-12 18:06:20', 25);

-- --------------------------------------------------------

--
-- Structure de la table `historiques`
--

DROP TABLE IF EXISTS `historiques`;
CREATE TABLE IF NOT EXISTS `historiques` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(60) NOT NULL,
  `action` varchar(50) DEFAULT NULL,
  `date_historique` datetime DEFAULT CURRENT_TIMESTAMP,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_historique` (`id_utilisateur`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `natures`
--

DROP TABLE IF EXISTS `natures`;
CREATE TABLE IF NOT EXISTS `natures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nature` varchar(255) NOT NULL,
  `date_creation_nature` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `natures`
--

INSERT INTO `natures` (`id`, `nature`, `date_creation_nature`, `update_at`) VALUES
(1, 'CESSION DU PATRIMOINE', '2022-01-14 00:15:51', '2022-01-14 00:15:51'),
(2, 'ATTESTATION DE NON LOGEMENT', '2022-01-14 10:41:12', '2022-01-14 10:41:12'),
(3, 'COMPTABILITE', '2022-01-14 10:42:36', '2022-01-14 10:42:36'),
(4, 'TEXTE OFFICIELS', '2022-01-14 10:47:50', '2022-01-14 10:47:50'),
(5, 'PLAN', '2022-01-14 10:49:01', '2022-01-14 10:49:01'),
(6, 'COCODY', '2022-01-14 11:00:00', '2022-01-14 11:00:00'),
(7, 'ABOBO', '2022-01-14 11:01:08', '2022-01-14 11:01:08'),
(8, 'ABOISSO', '2022-01-14 11:01:29', '2022-01-14 11:01:29'),
(9, 'ADJAME', '2022-01-14 11:01:45', '2022-01-14 11:01:45'),
(10, 'AGBOVILLE', '2022-01-14 11:01:59', '2022-01-14 11:01:59'),
(11, 'ADZOPE', '2022-01-14 11:02:30', '2022-01-14 11:02:30'),
(12, 'ANTENNE YAMOUSSOUKRO', '2022-01-14 11:03:27', '2022-01-14 11:03:27'),
(13, 'ANYAMA', '2022-01-14 11:03:42', '2022-01-14 11:03:42'),
(14, 'ATTECOUBE', '2022-01-14 11:03:50', '2022-01-14 11:03:50'),
(15, 'BINGERVILLE', '2022-01-14 11:04:00', '2022-01-14 11:04:00'),
(16, 'BONDOUKOU', '2022-01-14 11:04:13', '2022-01-14 11:04:13'),
(17, '2007', '2022-02-02 00:55:44', '2022-02-02 00:55:44'),
(18, '2008', '2022-02-02 00:56:10', '2022-02-02 00:56:10'),
(19, '2009', '2022-02-02 00:56:21', '2022-02-02 00:56:21'),
(20, '2010', '2022-02-02 00:56:35', '2022-02-02 00:56:35'),
(21, '2011', '2022-02-02 00:56:50', '2022-02-02 00:56:50'),
(22, '2012', '2022-02-02 00:57:00', '2022-02-02 00:57:00'),
(23, '2013', '2022-02-02 00:57:09', '2022-02-02 00:57:09'),
(24, '2014', '2022-02-02 00:57:22', '2022-02-02 00:57:22'),
(25, '2015', '2022-02-02 00:57:35', '2022-02-02 00:57:35'),
(26, '2016', '2022-02-02 00:57:46', '2022-02-02 00:57:46'),
(27, '2017', '2022-02-02 00:57:54', '2022-02-02 00:57:54'),
(28, '2018', '2022-02-02 00:58:03', '2022-02-02 00:58:03'),
(29, '2019', '2022-02-02 00:58:15', '2022-02-02 00:58:15'),
(30, '2020', '2022-02-02 00:58:24', '2022-02-02 00:58:24'),
(31, '2021', '2022-02-02 00:58:33', '2022-02-02 00:58:33'),
(32, '2022', '2022-02-02 00:58:50', '2022-02-02 00:58:50'),
(33, 'ANALYSES DES POSTES', '2022-02-02 01:03:42', '2022-02-02 01:03:42'),
(34, 'BANQUE', '2022-02-02 01:03:54', '2022-02-02 01:03:54'),
(35, 'DIVERS DOCUMENTS COMPATIBLES', '2022-02-02 01:04:23', '2022-02-02 01:04:23'),
(36, 'ETAT ET ORDRE DE VIREMENT', '2022-02-02 01:04:51', '2022-02-02 01:04:51'),
(37, 'FACTURES', '2022-02-02 01:05:28', '2022-02-02 01:05:28'),
(38, 'FICHES DE CONTROLE BUDGETAIRE', '2022-02-02 01:05:59', '2022-02-02 01:05:59'),
(39, 'HISTORIQUE DE PAIEMENT A LA SOLDE', '2022-02-02 01:06:26', '2022-02-02 01:06:26'),
(40, 'DIVO', '2022-02-02 01:11:53', '2022-02-02 01:11:53'),
(41, 'GAGNOA', '2022-02-02 01:12:04', '2022-02-02 01:12:04'),
(42, 'GRAND BASSAM', '2022-02-02 01:12:18', '2022-02-02 01:12:18'),
(43, 'KOUMASSI', '2022-02-02 01:12:30', '2022-02-02 01:12:30'),
(44, 'LAKOTA', '2022-02-02 01:12:38', '2022-02-02 01:12:38'),
(45, 'MARCORY', '2022-02-02 01:12:52', '2022-02-02 01:12:52'),
(46, 'PLATEAU', '2022-02-02 01:13:17', '2022-02-02 01:13:17'),
(47, 'PORT BOUET', '2022-02-02 01:13:28', '2022-02-02 01:13:28'),
(48, 'SANPEDRO', '2022-02-02 01:13:48', '2022-02-02 01:13:48'),
(49, 'SASSANDRA', '2022-02-02 01:14:06', '2022-02-02 01:14:06'),
(50, 'TABOU', '2022-02-02 01:14:16', '2022-02-02 01:14:16'),
(51, 'TOULEPLEU', '2022-02-02 01:14:33', '2022-02-02 01:14:33'),
(52, 'TOUMODI', '2022-02-02 01:14:43', '2022-02-02 01:14:43'),
(53, 'TREICHVILLE', '2022-02-02 01:14:55', '2022-02-02 01:14:55'),
(54, 'YOPOUGON', '2022-02-02 01:15:08', '2022-02-02 01:15:08'),
(55, '1184', '2022-02-02 01:15:58', '2022-02-02 01:15:58'),
(56, '2102', '2022-02-02 01:29:42', '2022-02-02 01:29:42'),
(57, '2103', '2022-02-02 01:29:54', '2022-02-02 01:29:54'),
(58, '2104', '2022-02-02 01:30:12', '2022-02-02 01:30:12'),
(59, '2105', '2022-02-02 01:30:22', '2022-02-02 01:30:22'),
(60, '2106', '2022-02-02 01:30:30', '2022-02-02 01:30:30'),
(61, '2107', '2022-02-02 01:30:38', '2022-02-02 01:30:38'),
(62, '2108', '2022-02-02 01:30:46', '2022-02-02 01:30:46'),
(63, '2109', '2022-02-02 01:30:55', '2022-02-02 01:30:55'),
(64, '2112', '2022-02-02 01:31:12', '2022-02-02 01:31:12'),
(65, '2115', '2022-02-02 01:31:22', '2022-02-02 01:31:22'),
(66, '2116', '2022-02-02 01:31:29', '2022-02-02 01:31:29'),
(67, '2117', '2022-02-02 01:31:38', '2022-02-02 01:31:38'),
(68, '2118', '2022-02-02 01:31:56', '2022-02-02 01:31:56'),
(69, '2218', '2022-02-02 01:45:06', '2022-02-02 01:45:06'),
(70, '2297', '2022-02-02 01:45:18', '2022-02-02 01:45:18'),
(71, '2683', '2022-02-02 01:45:31', '2022-02-02 01:45:31'),
(72, 'ADIAKE', '2022-02-02 01:45:44', '2022-02-02 01:45:44'),
(73, 'BOUNDIALI', '2022-02-02 01:47:05', '2022-02-02 01:47:05');

-- --------------------------------------------------------

--
-- Structure de la table `rayons`
--

DROP TABLE IF EXISTS `rayons`;
CREATE TABLE IF NOT EXISTS `rayons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rayon` varchar(255) NOT NULL,
  `id_salle` int(11) DEFAULT NULL,
  `date_creation_rayon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_rayons` (`rayon`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `rayons`
--

INSERT INTO `rayons` (`id`, `rayon`, `id_salle`, `date_creation_rayon`, `update_at`) VALUES
(5, 'LOGEMENTS', 2, '2022-02-23 14:29:48', '2022-02-23 14:29:48');

-- --------------------------------------------------------

--
-- Structure de la table `rl_services`
--

DROP TABLE IF EXISTS `rl_services`;
CREATE TABLE IF NOT EXISTS `rl_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_service` int(11) NOT NULL,
  `date_creation_rl` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_id_user` (`id_user`),
  KEY `pk__id_service` (`id_service`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `rl_services`
--

INSERT INTO `rl_services` (`id`, `id_user`, `id_service`, `date_creation_rl`) VALUES
(26, 2, 7, '2022-01-11 16:51:31'),
(25, 2, 2, '2022-01-11 16:51:31'),
(24, 2, 1, '2022-01-11 16:51:31'),
(7, 4, 1, '2022-01-10 11:19:40'),
(8, 4, 10, '2022-01-10 11:19:40'),
(9, 3, 2, '2022-01-10 11:19:40'),
(30, 5, 7, '2022-01-11 16:53:10'),
(29, 5, 2, '2022-01-11 16:53:10'),
(28, 5, 1, '2022-01-11 16:53:10'),
(27, 2, 10, '2022-01-11 16:51:31'),
(23, 6, 10, '2022-01-11 14:15:20'),
(22, 6, 2, '2022-01-11 14:15:20'),
(21, 6, 1, '2022-01-11 14:15:20');

-- --------------------------------------------------------

--
-- Structure de la table `rl_types`
--

DROP TABLE IF EXISTS `rl_types`;
CREATE TABLE IF NOT EXISTS `rl_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  `date_creation_rltype` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `rl_types`
--

INSERT INTO `rl_types` (`id`, `id_user`, `id_type`, `date_creation_rltype`) VALUES
(2, 2, 13, '2022-03-16 19:18:44'),
(3, 2, 15, '2022-03-16 19:18:44'),
(4, 4, 8, '2022-03-16 19:30:20');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(80) NOT NULL,
  `roles` varchar(100) NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `libelle`, `roles`, `date_creation`, `update_at`) VALUES
(1, 'Administrateur', 'ROLE_ADMIN', '2021-12-10 15:26:14', '2021-12-10 15:29:20'),
(2, 'Utilisateur simple', 'ROLE_USER', '2021-12-10 15:28:44', '2021-12-10 15:28:44'),
(3, 'Super utilisateur', 'ROLE_SUPERUSER', '2022-01-03 10:40:48', '2022-01-03 10:40:48');

-- --------------------------------------------------------

--
-- Structure de la table `salles`
--

DROP TABLE IF EXISTS `salles`;
CREATE TABLE IF NOT EXISTS `salles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `salle` varchar(255) NOT NULL,
  `id_ville` int(11) NOT NULL,
  `date_creation_salle` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `salles`
--

INSERT INTO `salles` (`id`, `salle`, `id_ville`, `date_creation_salle`, `update_at`) VALUES
(2, 'SALLE A', 1, '2022-02-22 15:15:12', '2022-02-22 15:15:12');

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(255) NOT NULL,
  `date_ajout` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`id`, `designation`, `date_ajout`, `update_at`) VALUES
(1, 'LOGEMENT DES SERVICES ADMINISTRATIFS ET DES DONNEES COMPTABLES DU PATRIMOINE', '2022-03-05 12:16:03', '2022-03-05 12:16:03'),
(2, 'ADMINISTRATIVE ET FINANCIERE', '2022-03-05 12:16:58', '2022-03-05 12:16:58'),
(3, 'TECHNIQUE', '2022-03-05 12:17:09', '2022-03-05 12:17:09'),
(4, 'TRANSACTIONS ET DU PARC IMMOBILIER DE L\'ETAT', '2022-03-05 12:17:37', '2022-03-05 12:17:37'),
(5, 'AFFAIRES FINANCIERES', '2022-03-05 13:16:00', '2022-03-05 13:16:00');

-- --------------------------------------------------------

--
-- Structure de la table `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `types` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `status`
--

INSERT INTO `status` (`id`, `types`) VALUES
(1, 'ENTREPRISE'),
(2, 'PARTICULIER');

-- --------------------------------------------------------

--
-- Structure de la table `types`
--

DROP TABLE IF EXISTS `types`;
CREATE TABLE IF NOT EXISTS `types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `desc_type` varchar(255) DEFAULT NULL,
  `id_cat` int(11) DEFAULT NULL,
  `date_creation_type` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `types`
--

INSERT INTO `types` (`id`, `type`, `desc_type`, `id_cat`, `date_creation_type`, `update_at`) VALUES
(16, 'DECISIONS', 'LES DECISIONS', 3, '2022-03-05 22:53:28', '2022-03-05 22:53:28'),
(15, 'ATTESTATIONS', 'ATTESTATION (PRISE , CESSATION, REPRISE) DE SERVICE', 3, '2022-03-05 22:53:04', '2022-03-05 22:53:04'),
(14, 'PERSONNEL', 'PERSONNEL FONCTIONNAIRE OU CONTRACTUEL', 3, '2022-03-05 22:51:10', '2022-03-05 22:51:10'),
(21, 'ACTE INDIVUDUALITE', 'ACTE D\'INDIVIDUALITE', 4, '2022-03-05 22:50:01', '2022-03-05 22:50:01'),
(17, 'PROCURATION', 'LA PROCURATION', 4, '2022-03-05 22:48:48', '2022-03-05 22:48:48'),
(18, 'RIB', 'RELEVÃ‰ Dâ€™IDENTITE BANCAIRE', 4, '2022-03-05 22:48:23', '2022-03-05 22:48:23'),
(19, 'AVENANTS', 'LES AVENANTS', 4, '2022-03-05 22:46:54', '2022-03-05 22:46:54'),
(20, 'CONTRAT DE BAIL', 'CONTRAT DE BAIL', 4, '2022-03-05 22:46:23', '2022-03-05 22:46:23'),
(13, 'ORDRE DE MISSION', 'ORDRE DE MISSION', 3, '2022-03-05 22:53:57', '2022-03-05 22:53:57'),
(12, 'FICHE DE SORTIE DE FOURNITURES', 'FICHE DE SORTIE DE FOURNITURE', 3, '2022-03-05 22:54:47', '2022-03-05 22:54:47'),
(11, 'FICHE DE PRESENCE', 'FICHE DE PRESENCE', 3, '2022-03-05 22:55:21', '2022-03-05 22:55:21'),
(10, 'NOTE INTERNE', 'NOTE INTERNE', 3, '2022-03-05 22:55:48', '2022-03-05 22:55:48'),
(9, 'SITUATION DES REGLEMENTS ACQUEREUR', 'SITUATION DES REGLEMENTS ACQUEREUR ', 2, '2022-03-05 22:57:36', '2022-03-05 23:06:04'),
(8, 'ATTESTATION DE FIN DE PAIEMENT', 'ATTESTATION DE FIN DE PAIEMENT ', 2, '2022-03-05 22:58:40', '2022-03-05 23:06:31'),
(7, 'DECISION D\'AFFECTATION DE LOGEMENT', 'DECISION D\'AFFECTATION DE LOGEMENT ', 2, '2022-03-05 22:59:29', '2022-03-05 23:06:51'),
(5, 'BULLETINS DE SOLDE', 'LES BULLETINS DE SOLDE', 1, '2022-03-05 23:00:39', '2022-03-05 23:00:39'),
(4, 'ATTESTATION DE NON LOGEMENT', 'ATTESTATION DE NON LOGEMENT', 1, '2022-03-05 23:01:22', '2022-03-05 23:01:22'),
(3, 'CERTIFICAT DE NON HEBERGEMENT', 'CERTIFICAT DE NON HEBERGEMENT', 1, '2022-03-05 23:01:52', '2022-03-05 23:01:52'),
(2, 'ARRETE DE NOMMINATION', 'L\'ARRETE DE NOMMINATION', 1, '2022-03-05 23:02:29', '2022-03-05 23:02:29'),
(1, 'CERTIFICAT DE PREMIERE PRISE DE SERVICE', 'CERTIFICAT DE PREMIERE PRISE DE SERVICE', 1, '2022-03-05 23:03:20', '2022-03-05 23:03:20'),
(6, 'BULLETINS DE SOLDE', 'BULLETINS DE SOLDE', 2, '2022-03-05 23:18:19', '2022-03-05 23:18:19');

-- --------------------------------------------------------

--
-- Structure de la table `usagers`
--

DROP TABLE IF EXISTS `usagers`;
CREATE TABLE IF NOT EXISTS `usagers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usager` varchar(255) NOT NULL,
  `type_usager` varchar(2556) NOT NULL,
  `matricule` varchar(255) DEFAULT NULL,
  `fonction` varchar(500) DEFAULT NULL,
  `grade` varchar(255) DEFAULT NULL,
  `date_service` date DEFAULT NULL,
  `etablissement` varchar(1000) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `adresse` text,
  `date_creation_usager` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `usagers`
--

INSERT INTO `usagers` (`id`, `usager`, `type_usager`, `matricule`, `fonction`, `grade`, `date_service`, `etablissement`, `contact`, `email`, `adresse`, `date_creation_usager`, `update_at`) VALUES
(2, 'KAMIS', '1', NULL, NULL, NULL, NULL, NULL, '+2250709582193', 'KAMIVOIRESERVICE@GMAIL.COM', '05 BP 1983ABIDJAN 05', '2022-03-08 18:44:59', '2022-03-09 13:44:08'),
(3, 'KAMARA ASSANE', '2', '120540T', 'INFORMATICIEN', 'A4', '2022-03-09', 'CITELCOM', '002250102173565', NULL, NULL, '2022-03-08 19:13:15', '2022-03-09 12:54:38');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matricule` varchar(50) DEFAULT NULL,
  `nom` varchar(60) NOT NULL,
  `prenom` varchar(80) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `login` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `contact` varchar(20) NOT NULL,
  `fonction` varchar(80) NOT NULL,
  `direction` int(11) NOT NULL,
  `roles` varchar(100) NOT NULL,
  `actif` enum('1','0') NOT NULL DEFAULT '1',
  `signature` varchar(255) DEFAULT NULL,
  `date_creation_utilisateur` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_service` int(11) NOT NULL DEFAULT '0',
  `validate_token` varchar(60) DEFAULT NULL,
  `confirmed_at` timestamp NULL DEFAULT NULL,
  `reset_token` varchar(60) DEFAULT NULL,
  `remember_token` varchar(60) DEFAULT NULL,
  `reset_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_contact` (`contact`),
  UNIQUE KEY `uk_login` (`login`),
  UNIQUE KEY `uk_matricule` (`matricule`),
  UNIQUE KEY `uk_email` (`email`),
  KEY `fk_service` (`id_service`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `matricule`, `nom`, `prenom`, `email`, `login`, `password`, `contact`, `fonction`, `direction`, `roles`, `actif`, `signature`, `date_creation_utilisateur`, `update_at`, `id_service`, `validate_token`, `confirmed_at`, `reset_token`, `remember_token`, `reset_at`) VALUES
(2, '125400', 'assane', 'kam', 'kam@live.fr', 'killer', '$argon2i$v=19$m=65536,t=4,p=1$U3dybkltNmVjNmJwTXJ4Uw$1xaIgCFQDSX06Wdo1ye8LJraMdEP9JAu7DS/AzQX28A', '0102050604', 'informaticien', 1, 'ROLE_ADMIN', '1', '61e82bcdcd7c1.png', '2021-12-08 02:36:53', '2022-01-11 16:51:31', 1, NULL, NULL, NULL, '3vaXsKYoXROAVNuLzfJJW99Lk6nRfcVSl3La9UEmJ3UuQ35JEeriX11b73mi', NULL),
(3, '1256A', 'Kamara', 'Assane', 'kamso@live.fr', 'kamso', '$argon2i$v=19$m=65536,t=4,p=1$ejV2Ulk1a0FnMGZqN1NxQQ$U9OYCHL22qPLMeQulfQNuO0bIAr0Xwyrugc84sbNeHM', '02173565', 'Comptable', 2, 'ROLE_SUPERUSER', '1', '', '2021-12-10 18:42:33', '2022-01-03 13:39:48', 2, NULL, NULL, NULL, 'oksXXq2ftzIKPOB01Eu1Fy3rSGE5KMki7FSm6WB1jbGxyC4ZeRnU2kKjx9M8', NULL),
(4, '1234A', 'LOBOGNON', 'LOBOGNON', 'lobo2', 'lobo', '$argon2i$v=19$m=65536,t=4,p=1$NVhIRUdwQ25IMVZJZlZUbg$2cGuhSZBIM564sCNWq/YnaHbU8r9rNL+ouPTskt1Fw8', '0758316053', 'informaticien', 3, 'ROLE_USER', '1', '', '2021-12-27 16:29:58', '2022-01-03 14:06:07', 1, NULL, NULL, NULL, 'hsHze8zwTVW3vEbKwnkdGTfYkS7MyQASiGWGNTr8dweUdgmhaadgXV0WSR8x', NULL),
(5, '15896M', 'Bileto', 'Lataille', 'camso@live.fr', 'camso', '$argon2i$v=19$m=65536,t=4,p=1$My42U1N1S2U0cFVrVW1JVA$s6roINjj4oI/nAkjMgFlkCo0OFHtudQBcRgwdMhWOoM', '02159868', 'Comptable', 4, 'ROLE_USER', '1', '', '2022-01-08 15:50:55', '2022-01-11 16:53:10', 0, NULL, NULL, NULL, 'bAqNtSt00vuQFJ0X8Q872xaWMTEnQYVOwY85Eyic3ZhZ7ORbynjyf74130zF', NULL),
(6, '12451A', 'camso', 'camso', 'typos@live.fr', 'typos', '$argon2i$v=19$m=65536,t=4,p=1$SzJoLllIMXpNUkhQLk5pSw$ZI+zmkJLCUv9Z83Huatq+axN0wkQIiEdAyZGOtDjngM', '0103060504', 'comptable', 5, 'ROLE_USER', '1', '', '2022-01-08 15:52:51', '2022-01-13 00:56:01', 0, NULL, NULL, NULL, 'Tmsyi3KpZMtZBBXViUoMvpbMVzDb8EJk4fSZ09eBT2OxkmbBG7vfrQL0FUa9', NULL),
(7, '125A', 'KODJANE', 'TIDIANE', 'killer@live.fr', 'kodjane', '$argon2i$v=19$m=65536,t=4,p=1$bzM4MmJvNnNLUW52RzQuVQ$YNYPs1Uk7tCaLS4raUF3EOzX4YShUyKm1VAvk2fNqSs', '0102144586', 'Comptable', 16, 'ROLE_USER', '0', NULL, '2022-03-01 12:27:30', '2022-03-01 13:12:27', 0, NULL, NULL, NULL, 'qYjGcpA3Qp4z47U7NQ4XSPC1rtZvxiZ4HJAPKe2BtNaf0B32Tl1SuBvOt5oT', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `villes`
--

DROP TABLE IF EXISTS `villes`;
CREATE TABLE IF NOT EXISTS `villes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ville` varchar(255) NOT NULL,
  `date_creation_ville` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `villes`
--

INSERT INTO `villes` (`id`, `ville`, `date_creation_ville`, `update_at`) VALUES
(1, 'ABIDJAN', '2022-02-22 13:01:07', '2022-02-22 13:06:11'),
(3, 'KORHOGO', '2022-02-22 13:06:37', '2022-02-22 13:06:37');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
