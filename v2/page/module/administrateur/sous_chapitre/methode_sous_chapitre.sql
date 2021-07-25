-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 24 juil. 2021 à 23:32
-- Version du serveur :  10.4.13-MariaDB
-- Version de PHP : 7.4.7

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
-- Structure de la table `methode_sous_chapitre`
--

CREATE TABLE `methode_sous_chapitre` (
  `methode_sous_chapitre_id` bigint(20) NOT NULL,
  `methode_chapitre_id` int(10) NOT NULL DEFAULT 0,
  `methode_sous_chapitre_date` date NOT NULL,
  `methode_sous_chapitre_nom` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `methode_sous_chapitre_user` int(11) NOT NULL DEFAULT 0,
  `methode_sous_chapitre_statut` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `methode_sous_chapitre`
--

INSERT INTO `methode_sous_chapitre` (`methode_sous_chapitre_id`, `methode_chapitre_id`, `methode_sous_chapitre_date`, `methode_sous_chapitre_nom`, `methode_sous_chapitre_user`, `methode_sous_chapitre_statut`) VALUES
(1, 1, '2020-06-29', 'Points de levage', 2, 1),
(2, 1, '2020-06-29', 'Remorquage', 2, 1),
(3, 2, '2020-06-29', 'Bougies d\'allumage_Couples de serrage', 2, 1),
(4, 2, '2020-06-29', 'Ecartement électrodes de bougies d\'allumage', 2, 1),
(5, 3, '2020-06-29', 'Capacité additif antipollution', 2, 1),
(6, 3, '2020-06-29', 'Capacité huile moteur', 2, 1),
(7, 3, '2020-06-29', 'Filtre à huile_Couples de serrage', 2, 1),
(8, 3, '2020-06-29', 'Préconisation additif antipollution', 2, 1),
(9, 3, '2020-06-29', 'Préconisation huile moteur', 2, 1),
(10, 4, '2020-06-29', 'Remplacement du filtre à air', 2, 1),
(11, 4, '2020-06-29', 'Remplacement du filtre à carburant_(D)', 2, 1),
(12, 4, '2020-06-29', 'Remplacement du filtre à carburant_(E)', 2, 1),
(13, 4, '2020-06-29', 'Remplacement du filtre à huile', 2, 1),
(14, 4, '2020-06-29', 'Remplacement du filtre habitacle', 2, 1),
(15, 5, '2020-06-29', 'Mise en position de service des essuie-glace', 2, 1),
(16, 6, '2020-06-29', 'Diamètre des disques arrière', 2, 1),
(17, 6, '2020-06-29', 'Diamètre des tambours arrière', 2, 1),
(18, 6, '2020-06-29', 'Epaisseur des disques arrière', 2, 1),
(19, 6, '2020-06-29', 'Epaisseur des garnitures arrière', 2, 1),
(20, 6, '2020-06-29', 'Epaisseur des plaquettes arrière', 2, 1),
(21, 6, '2020-06-29', 'Etrier arrière_Couples de serrage', 2, 1),
(22, 6, '2020-06-29', 'Tambours arrière_Couples de serrage', 2, 1),
(23, 6, '2020-06-29', 'Voile des disques arrière', 2, 1),
(24, 7, '2020-06-29', 'Diamètre des disques avant', 2, 1),
(25, 7, '2020-06-29', 'Epaisseur des disques avant', 2, 1),
(26, 7, '2020-06-29', 'Epaisseur des garnitures avant', 2, 1),
(27, 7, '2020-06-29', 'Epaisseur des plaquettes avant', 2, 1),
(28, 7, '2020-06-29', 'Etrier avant_Couples de serrage', 2, 1),
(29, 7, '2020-06-29', 'Voile des disques avant', 2, 1),
(30, 8, '2020-06-29', 'Capacité liquide de freins', 2, 1),
(31, 8, '2020-06-29', 'Préconisation liquide de freins', 2, 1),
(32, 9, '2020-06-29', 'Plaque constructeur', 2, 1),
(33, 10, '2020-06-29', 'Fonctionnement indicateur de maintenance', 2, 1),
(34, 10, '2020-06-29', 'Reinit. indicateur de maintenance', 2, 1),
(35, 11, '2020-06-29', 'Arbre de transmission_Couples de serrage', 2, 1),
(36, 11, '2020-06-29', 'Fixations de roue_Couples de serrage', 2, 1),
(37, 12, '2020-06-29', 'Descriptif surveillance pression des pneus', 2, 1),
(38, 12, '2020-06-29', 'Réinit. système surveillance pression des pneus', 2, 1),
(39, 13, '2020-06-29', 'Implantation de la prise diagnostic', 2, 1),
(40, 14, '2020-06-29', 'Remplacement de l\'additif antipollution', 2, 1),
(41, 15, '2020-06-29', 'Précautions avant débranchement batterie', 2, 1),
(42, 15, '2020-06-29', 'Précautions/réinit. après rebranchement batterie', 2, 1),
(43, 15, '2020-06-29', 'Programmation de l\'antidémarrage', 2, 1),
(44, 16, '2020-06-29', 'Désa/réactivation frein stationnement automatique', 2, 1),
(45, 16, '2020-06-29', 'Réglage du frein de stationnement', 2, 1),
(46, 17, '2020-06-29', 'Remplacement des plaquettes arrière', 2, 1),
(47, 17, '2020-06-29', 'Remplacement des segments de freins arrière', 2, 1),
(48, 18, '2020-06-29', 'Remplacement des plaquettes avant', 2, 1),
(49, 19, '2020-06-29', 'Purge du circuit de freinage', 2, 1),
(50, 20, '2020-06-29', 'Capacité huile du circuit de climatisation', 2, 1),
(51, 20, '2020-06-29', 'Capacité réfrigérant', 2, 1),
(52, 20, '2020-06-29', 'Implantation des valves', 2, 1),
(53, 20, '2020-06-29', 'Préconisation huile du circuit de climatisation', 2, 1),
(54, 20, '2020-06-29', 'Préconisation réfrigérant', 2, 1),
(55, 21, '2020-06-29', 'Capacité liquide de refroidissement', 2, 1),
(56, 21, '2020-06-29', 'Préconisation liquide de refroidissement', 2, 1),
(57, 22, '2020-06-29', 'Capacité huile de direction assistée', 2, 1),
(58, 22, '2020-06-29', 'Capacité liquide hydraulique Citroën', 2, 1),
(59, 22, '2020-06-29', 'Préconisation huile de direction assistée', 2, 1),
(60, 22, '2020-06-29', 'Préconisation liquide hydraulique Citroën', 2, 1),
(61, 23, '2020-06-29', 'Capacité huile d\'actuateur BVR', 2, 1),
(62, 23, '2020-06-29', 'Capacité huile de boîte de transfert', 2, 1),
(63, 23, '2020-06-29', 'Capacité huile de boîte de vitesses BVA', 2, 1),
(64, 23, '2020-06-29', 'Capacité huile de boîte de vitesses BVM', 2, 1),
(65, 23, '2020-06-29', 'Capacité huile de pont', 2, 1),
(66, 23, '2020-06-29', 'Capacité huile différentiel de BDV', 2, 1),
(67, 23, '2020-06-29', 'Mécanisme d\'embrayage_Couples de serrage', 2, 1),
(68, 23, '2020-06-29', 'Préconisation huile d\'actuateur BVR', 2, 1),
(69, 23, '2020-06-29', 'Préconisation huile de boîte de transfert', 2, 1),
(70, 23, '2020-06-29', 'Préconisation huile de boîte de vitesses BVA', 2, 1),
(71, 23, '2020-06-29', 'Préconisation huile de boîte de vitesses BVM', 2, 1),
(72, 23, '2020-06-29', 'Préconisation huile de pont', 2, 1),
(73, 23, '2020-06-29', 'Préconisation huile différentiel de BDV', 2, 1),
(74, 23, '2020-06-29', 'Préconisation liquide d\'embrayage', 2, 1),
(75, 24, '2020-06-29', 'Volant moteur_Couples de serrage', 2, 1),
(76, 25, '2020-06-29', 'Pression de compression', 2, 1),
(77, 25, '2020-06-29', 'Régime de ralenti', 2, 1),
(78, 26, '2020-06-29', 'Implantation/affectation fusibles et relais', 2, 1),
(79, 27, '2020-06-29', 'Carrossage arrière', 2, 1),
(80, 27, '2020-06-29', 'Carrossage avant', 2, 1),
(81, 27, '2020-06-29', 'Chasse arrière', 2, 1),
(82, 27, '2020-06-29', 'Chasse avant', 2, 1),
(83, 27, '2020-06-29', 'Conditions de réglage', 2, 1),
(84, 27, '2020-06-29', 'Hauteurs de caisse', 2, 1),
(85, 27, '2020-06-29', 'Parallélisme arrière', 2, 1),
(86, 27, '2020-06-29', 'Parallélisme avant', 2, 1),
(87, 27, '2020-06-29', 'Pivot avant', 2, 1),
(88, 28, '2020-06-29', 'Réglage de la géométrie du train arrière', 2, 1),
(89, 28, '2020-06-29', 'Réglage de la géométrie du train avant', 2, 1),
(90, 29, '2020-06-29', 'Remplacement du liquide d\'embrayage', 2, 1),
(91, 29, '2020-06-29', 'Vidange/remplissage/mise à niveau de l\'huile BVA', 2, 1),
(92, 29, '2020-06-29', 'Vidange/remplissage/mise à niveau de l\'huile BVM', 2, 1),
(93, 30, '0000-00-00', 'Dépose-repose de l\'élément déshydratant', 2, 1),
(94, 31, '2020-06-29', 'Descriptif  courroie de pompe à eau', 2, 1),
(95, 31, '2020-06-29', 'Descriptif  courroie de pompe d\'assistance', 2, 1),
(96, 31, '2020-06-29', 'Descriptif de la courroie de compresseur', 2, 1),
(97, 32, '2020-06-29', 'Tension de la courroie de compresseur', 2, 1),
(98, 32, '2020-06-29', 'Tension de la courroie de pompe à eau', 2, 1),
(99, 32, '2020-06-29', 'Tension de la courroie de pompe d\'assistance', 2, 1),
(100, 33, '2020-06-29', 'Courroie de distribution_Couples de serrage', 2, 1),
(101, 33, '2020-06-29', 'Pompe à eau_Couples de serrage', 2, 1),
(102, 33, '2020-06-29', 'Pompe injection_Couples de serrage', 2, 1),
(103, 34, '2020-06-29', 'Dépose-repose de la courroie de distribution', 2, 1),
(104, 35, '2020-06-29', 'Vidange/remplissage/purge liquide refroidissement', 2, 1),
(105, 36, '2020-06-29', 'Dépose-repose du filtre à particules', 2, 1),
(106, 37, '2020-06-29', 'Arbres à cames_Couples de serrage', 2, 1),
(107, 37, '2020-06-29', 'Bougies préchauffage_Couples de serrage', 2, 1),
(108, 37, '2020-06-29', 'Descriptif jeu aux soupapes', 2, 1),
(109, 37, '2020-06-29', 'Injecteurs_Couples de serrage', 2, 1),
(110, 37, '2020-06-29', 'Ordre de desserrage/serrage culasse', 2, 1),
(111, 37, '2020-06-29', 'Valeurs de serrage de la culasse', 2, 1),
(112, 37, '2020-06-29', 'Valeurs du jeu aux soupapes', 2, 1),
(113, 1, '2020-08-25', 'sous chapitre test', 2, 1),
(120, 1, '2021-07-24', 'MENCHAOUI test ', 5, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `methode_sous_chapitre`
--
ALTER TABLE `methode_sous_chapitre`
  ADD PRIMARY KEY (`methode_sous_chapitre_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `methode_sous_chapitre`
--
ALTER TABLE `methode_sous_chapitre`
  MODIFY `methode_sous_chapitre_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
