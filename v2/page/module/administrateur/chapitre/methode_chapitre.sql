-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 24 juil. 2021 à 15:21
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
-- Structure de la table `methode_chapitre`
--

CREATE TABLE `methode_chapitre` (
  `methode_chapitre_id` int(11) NOT NULL,
  `methode_socle_id` int(11) NOT NULL,
  `methode_chapitre_date` date DEFAULT NULL,
  `methode_chapitre_nom` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `methode_chapitre_statut` int(1) NOT NULL DEFAULT 1,
  `methode_chapitre_user` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `methode_chapitre`
--

INSERT INTO `methode_chapitre` (`methode_chapitre_id`, `methode_socle_id`, `methode_chapitre_date`, `methode_chapitre_nom`, `methode_chapitre_statut`, `methode_chapitre_user`) VALUES
(1, 1, '2020-06-29', 'Dépannage_(MR)', 1, 2),
(2, 1, '2020-06-29', 'Entretien allumage_(DT)', 1, 2),
(3, 1, '2020-06-29', 'Entretien moteur_(DT)', 1, 2),
(4, 1, '2020-06-29', 'Entretien moteur_(MR)', 1, 2),
(5, 1, '2020-06-29', 'Essuie-vitre_(MR)', 1, 2),
(6, 1, '2020-06-29', 'Freins arrière_(DT)', 1, 2),
(7, 1, '2020-06-29', 'Freins avant_(DT)', 1, 2),
(8, 1, '2020-06-29', 'Freins commande_(DT)', 1, 2),
(9, 1, '2020-06-29', 'Identification_(DT)', 1, 2),
(10, 1, '2020-06-29', 'Indicateur de maintenance_(MR)', 1, 2),
(11, 1, '2020-06-29', 'Liaisons au sol_(DT)', 1, 2),
(12, 1, '2020-06-29', 'Liaisons au sol_(MR)', 1, 2),
(13, 1, '2020-06-29', 'Prise diagnostic_(DT)', 1, 2),
(14, 2, '2020-06-29', 'Additif_(MR)', 1, 2),
(15, 2, '2020-06-29', 'Electricité_(MR)', 1, 2),
(16, 2, '2020-06-29', 'Frein de stationnement_(MR)', 1, 2),
(17, 2, '2020-06-29', 'Freins arrière_(MR)', 1, 2),
(18, 2, '2020-06-29', 'Freins avant_(MR)', 1, 2),
(19, 2, '2020-06-29', 'Freins commande_(MR)', 1, 2),
(20, 3, '2020-06-29', 'Climatisation_(DT)', 1, 2),
(21, 3, '2020-06-29', 'Entretien refroidissement_(DT)', 1, 2),
(22, 3, '2020-06-29', 'Suspensions-Direction_(DT)', 1, 2),
(23, 3, '2020-06-29', 'Transmissions_(DT)', 1, 2),
(24, 4, '2020-06-29', 'Bas moteur_(DT)', 1, 2),
(25, 4, '2020-06-29', 'Caractéristiques moteur_(DT)', 1, 2),
(26, 4, '2020-06-29', 'Electricité_(DT)', 1, 2),
(27, 4, '2020-06-29', 'Géométrie des trains_(DT)', 1, 2),
(28, 4, '2020-06-29', 'Géométrie des trains_(MR)', 1, 2),
(29, 4, '2020-06-29', 'Transmissions_(MR)', 1, 2),
(30, 5, '2020-06-29', 'Climatisation_(MR)', 1, 2),
(31, 5, '2020-06-29', 'Courroie(s) auxiliaire(s)_(DT)', 1, 2),
(32, 5, '2020-06-29', 'Courroie(s) auxiliaire(s)_(MR)', 1, 2),
(33, 5, '2020-06-29', 'Distribution_(DT)', 1, 2),
(34, 5, '2020-06-29', 'Entraînement distribution_(MR)', 1, 2),
(35, 5, '2020-06-29', 'Entretien refroidissement_(MR)', 1, 2),
(36, 5, '2020-06-29', 'Filtre à particules_(MR)', 1, 2),
(37, 5, '2020-06-29', 'Haut moteur_(DT)', 1, 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `methode_chapitre`
--
ALTER TABLE `methode_chapitre`
  ADD PRIMARY KEY (`methode_chapitre_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `methode_chapitre`
--
ALTER TABLE `methode_chapitre`
  MODIFY `methode_chapitre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
