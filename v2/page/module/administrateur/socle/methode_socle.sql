-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 24 juil. 2021 à 15:22
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `methode`
--

-- --------------------------------------------------------

--
-- Structure de la table `methode_socle`
--

CREATE TABLE `methode_socle` (
  `methode_socle_id` bigint(20) NOT NULL,
  `methode_socle_date` date NOT NULL,
  `methode_socle_nom` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `methode_socle_user` int(11) NOT NULL DEFAULT 0,
  `methode_socle_statut` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `methode_socle`
--

INSERT INTO `methode_socle` (`methode_socle_id`, `methode_socle_date`, `methode_socle_nom`, `methode_socle_user`, `methode_socle_statut`) VALUES
(1, '2020-06-29', 'Socle_Entretien_A_N1', 0, 1),
(2, '2020-06-29', 'Socle_Entretien_A_N2', 0, 1),
(3, '2020-06-29', 'Socle_Entretien_B_N1', 0, 1),
(4, '2020-06-29', 'Socle_Entretien_B_N2', 0, 1),
(5, '2020-06-29', 'Socle_Entretien_B_N3', 0, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `methode_socle`
--
ALTER TABLE `methode_socle`
  ADD PRIMARY KEY (`methode_socle_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `methode_socle`
--
ALTER TABLE `methode_socle`
  MODIFY `methode_socle_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
