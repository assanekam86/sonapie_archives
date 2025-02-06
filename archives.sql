-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 08 déc. 2021 à 20:16
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
  `id_annee` int(11) NOT NULL AUTO_INCREMENT,
  `annee` int(4) DEFAULT NULL,
  `mois` int(2) DEFAULT NULL,
  `jour` int(2) DEFAULT NULL,
  PRIMARY KEY (`id_annee`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id_cat` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(60) NOT NULL,
  `date_creation_cat` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_cat`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id_cat`, `designation`, `date_creation_cat`) VALUES
(1, 'FACTURE', '2021-12-08 18:14:02'),
(2, 'RAPPORT DE REUNION', '2021-12-08 18:14:50');

-- --------------------------------------------------------

--
-- Structure de la table `documents`
--

DROP TABLE IF EXISTS `documents`;
CREATE TABLE IF NOT EXISTS `documents` (
  `num_doc` int(11) NOT NULL AUTO_INCREMENT,
  `reference` varchar(60) DEFAULT NULL,
  `libelle` varchar(60) DEFAULT NULL,
  `description` text,
  `id_utilisateur` int(11) NOT NULL,
  `id_cat` int(11) NOT NULL,
  `id_annee` int(11) NOT NULL,
  `date_creation_doc` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`num_doc`),
  KEY `fk_document_user` (`id_utilisateur`),
  KEY `fk_document_categorie` (`id_cat`),
  KEY `fk_document_annee` (`id_annee`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `fichiers`
--

DROP TABLE IF EXISTS `fichiers`;
CREATE TABLE IF NOT EXISTS `fichiers` (
  `id_fichier` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(60) NOT NULL,
  `type` varchar(60) DEFAULT NULL,
  `date_creation` datetime DEFAULT CURRENT_TIMESTAMP,
  `num_doc` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_fichier`),
  KEY `fk_fichier_doc` (`num_doc`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `historiques`
--

DROP TABLE IF EXISTS `historiques`;
CREATE TABLE IF NOT EXISTS `historiques` (
  `code_historique` int(11) NOT NULL,
  `libelle` varchar(60) NOT NULL,
  `action` varchar(50) DEFAULT NULL,
  `date_historique` datetime DEFAULT CURRENT_TIMESTAMP,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`code_historique`),
  KEY `fk_historique` (`id_utilisateur`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id_service` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(60) NOT NULL,
  `date_ajout` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_service`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`id_service`, `designation`, `date_ajout`) VALUES
(1, 'informatique', '2021-12-06 13:19:24'),
(2, 'Comptabilite', '2021-12-08 15:19:27'),
(7, 'Ressources Humaines', '2021-12-08 16:03:17'),
(9, 'economie', '2021-12-08 16:28:44');

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
  `password` text NOT NULL,
  `contact` varchar(20) NOT NULL,
  `fonction` varchar(80) NOT NULL,
  `roles` json DEFAULT NULL,
  `date_creation_utilisateur` datetime DEFAULT CURRENT_TIMESTAMP,
  `id_service` int(11) NOT NULL,
  `validate_token` varchar(60) DEFAULT NULL,
  `confirmed_at` timestamp NULL DEFAULT NULL,
  `reset_token` varchar(60) DEFAULT NULL,
  `remember_token` varchar(60) DEFAULT NULL,
  `reset_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_contact` (`contact`),
  UNIQUE KEY `uk_matricule` (`matricule`),
  UNIQUE KEY `uk_email` (`email`),
  KEY `fk_service` (`id_service`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `matricule`, `nom`, `prenom`, `email`, `password`, `contact`, `fonction`, `roles`, `date_creation_utilisateur`, `id_service`, `validate_token`, `confirmed_at`, `reset_token`, `remember_token`, `reset_at`) VALUES
(1, '0123', 'kamara', 'assane', 'assanekam@gmail.com', '7d2183f44d7adf37303b2a6b7252be4c78334a4b', '0201030405', 'informaticien', '1', '2021-12-06 12:06:01', 1, NULL, NULL, NULL, NULL, NULL),
(2, '12540', 'assane', 'kam', 'kam@live.fr', '$argon2i$v=19$m=65536,t=4,p=1$QmhjQ3RXdHR6RHhOZC9CMA$hFwGr3fraGzgE/7y77q2SxI5ZbBTFG4HYff+mYnYRio', '0102050604', 'informaticien', NULL, '2021-12-08 02:36:53', 1, NULL, NULL, NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
