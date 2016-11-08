-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 08 Novembre 2016 à 22:03
-- Version du serveur :  5.7.16-0ubuntu0.16.04.1
-- Version de PHP :  7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `kebabstagram_bdd`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_photo` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `message`, `date`, `id_photo`, `id_user`) VALUES
(1, '#berbere et des commentaires', '2016-11-07 10:39:21', 109, 2),
(2, 'je voudrais connaitre les #ingrédients associés à cette #recette', '2016-11-07 11:54:42', 112, 2),
(3, 'ceci est un commentaire avec des tags #amazigh et d\'autres tags comme #berbere', '2016-11-07 19:58:37', 115, 2),
(4, 'La recette est un peu longue je donnerai les #ingrédients plus tard!\r\nJe me contenterai de vous dire de #gouter à ce #kebab', '2016-11-08 20:41:58', 117, 3);

-- --------------------------------------------------------

--
-- Structure de la table `departement`
--

CREATE TABLE `departement` (
  `id` int(11) NOT NULL,
  `code` int(11) DEFAULT NULL,
  `nom` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `departement`
--

INSERT INTO `departement` (`id`, `code`, `nom`) VALUES
(1, 1, 'Ain'),
(2, 2, 'Aisne'),
(3, 3, 'Allier'),
(4, 4, 'Alpes-de-Haute-Provence'),
(5, 5, 'Hautes-Alpes'),
(6, 6, 'Alpes-Maritimes'),
(7, 7, 'Ardèche'),
(8, 8, 'Ardennes'),
(9, 9, 'Ariège'),
(10, 10, 'Aube'),
(11, 11, 'Aude'),
(12, 12, 'Aveyron'),
(13, 13, 'Bouches-du-Rhône'),
(14, 14, 'Calvados'),
(15, 15, 'Cantal'),
(16, 16, 'Charente'),
(17, 17, 'Charente-Maritime'),
(18, 18, 'Cher'),
(19, 19, 'Corrèze'),
(20, 2, 'Corse-du-sud'),
(21, 2, 'Haute-corse'),
(22, 21, 'Côte-d\'or'),
(23, 22, 'Côtes-d\'armor'),
(24, 23, 'Creuse'),
(25, 24, 'Dordogne'),
(26, 25, 'Doubs'),
(27, 26, 'Drôme'),
(28, 27, 'Eure'),
(29, 28, 'Eure-et-Loir'),
(30, 29, 'Finistère'),
(31, 30, 'Gard'),
(32, 31, 'Haute-Garonne'),
(33, 32, 'Gers'),
(34, 33, 'Gironde'),
(35, 34, 'Hérault'),
(36, 35, 'Ile-et-Vilaine'),
(37, 36, 'Indre'),
(38, 37, 'Indre-et-Loire'),
(39, 38, 'Isère'),
(40, 39, 'Jura'),
(41, 40, 'Landes'),
(42, 41, 'Loir-et-Cher'),
(43, 42, 'Loire'),
(44, 43, 'Haute-Loire'),
(45, 44, 'Loire-Atlantique'),
(46, 45, 'Loiret'),
(47, 46, 'Lot'),
(48, 47, 'Lot-et-Garonne'),
(49, 48, 'Lozère'),
(50, 49, 'Maine-et-Loire'),
(51, 50, 'Manche'),
(52, 51, 'Marne'),
(53, 52, 'Haute-Marne'),
(54, 53, 'Mayenne'),
(55, 54, 'Meurthe-et-Moselle'),
(56, 55, 'Meuse'),
(57, 56, 'Morbihan'),
(58, 57, 'Moselle'),
(59, 58, 'Nièvre'),
(60, 59, 'Nord'),
(61, 60, 'Oise'),
(62, 61, 'Orne'),
(63, 62, 'Pas-de-Calais'),
(64, 63, 'Puy-de-Dôme'),
(65, 64, 'Pyrénées-Atlantiques'),
(66, 65, 'Hautes-Pyrénées'),
(67, 66, 'Pyrénées-Orientales'),
(68, 67, 'Bas-Rhin'),
(69, 68, 'Haut-Rhin'),
(70, 69, 'Rhône'),
(71, 70, 'Haute-Saône'),
(72, 71, 'Saône-et-Loire'),
(73, 72, 'Sarthe'),
(74, 73, 'Savoie'),
(75, 74, 'Haute-Savoie'),
(76, 75, 'Paris'),
(77, 76, 'Seine-Maritime'),
(78, 77, 'Seine-et-Marne'),
(79, 78, 'Yvelines'),
(80, 79, 'Deux-Sèvres'),
(81, 80, 'Somme'),
(82, 81, 'Tarn'),
(83, 82, 'Tarn-et-Garonne'),
(84, 83, 'Var'),
(85, 84, 'Vaucluse'),
(86, 85, 'Vendée'),
(87, 86, 'Vienne'),
(88, 87, 'Haute-Vienne'),
(89, 88, 'Vosges'),
(90, 89, 'Yonne'),
(91, 90, 'Territoire de Belfort'),
(92, 91, 'Essonne'),
(93, 92, 'Hauts-de-Seine'),
(94, 93, 'Seine-Saint-Denis'),
(95, 94, 'Val-de-Marne'),
(96, 95, 'Val-d\'oise'),
(97, 976, 'Mayotte'),
(98, 971, 'Guadeloupe'),
(99, 973, 'Guyane'),
(100, 972, 'Martinique'),
(101, 974, 'Réunion');

-- --------------------------------------------------------

--
-- Structure de la table `notation`
--

CREATE TABLE `notation` (
  `id` int(11) NOT NULL,
  `id_photo` int(11) NOT NULL,
  `rating` float NOT NULL,
  `total_rating` float NOT NULL,
  `total_rates` int(11) NOT NULL,
  `id_users` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `notation`
--

INSERT INTO `notation` (`id`, `id_photo`, `rating`, `total_rating`, `total_rates`, `id_users`) VALUES
(16, 109, 2.975, 11.9, 4, '0,6,5,2,3'),
(17, 110, 3, 12, 4, '0,6,5,2,3'),
(18, 111, 3.8, 19, 5, '0,2,5,6,7,3'),
(19, 112, 2.33333, 7, 3, '0,6,2,3'),
(20, 113, 3, 9, 3, '0,6,2,3'),
(22, 115, 2.5, 5, 2, '0,2,3'),
(23, 116, 2, 2, 1, '0,3'),
(24, 117, 4, 4, 1, '0,3'),
(25, 118, 2, 2, 1, '0,3');

-- --------------------------------------------------------

--
-- Structure de la table `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `titre` varchar(256) DEFAULT NULL,
  `description` text,
  `endroit` text,
  `extension` varchar(10) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `photos`
--

INSERT INTO `photos` (`id`, `titre`, `description`, `endroit`, `extension`, `id_user`, `created_at`, `updated_at`) VALUES
(109, 'Kebab d\'Azouza', 'Ceci est un kebab fait maison!', 'LARBA NATH IRATHEN', 'jpg', 6, '2016-11-07 00:25:15', '2016-11-07 00:25:15'),
(110, 'Kebab spécial Seddouk', 'Une spécialité régionale', 'Béjaia', 'jpg', 5, '2016-11-07 00:26:53', '2016-11-07 00:26:53'),
(111, 'Kebab amazigh', 'Ceci est une spécialité de chez nous les kabyles', 'EL KLAA', 'jpg', 2, '2016-11-07 07:44:11', '2016-11-07 07:44:11'),
(112, 'KEBAB DE MEKLA', 'Kebab pas cher!', 'MEKLA', 'jpg', 2, '2016-11-07 11:18:15', '2016-11-07 11:18:15'),
(113, 'KEBAB TEST', 'FSFDGDSFGF', 'LAXOU', 'jpg', 6, '2016-11-07 13:07:39', '2016-11-07 13:07:39'),
(115, 'Kebab natal', 'COUCOU', 'MEKLA', 'jpg', 2, '2016-11-07 18:13:35', '2016-11-07 18:13:35'),
(116, 'Kebab de ma ELIAS NACERA', 'C\'est un kebab d\'azouza et amazigh', 'AZOUZA', 'jpg', 3, '2016-11-08 13:12:49', '2016-11-08 13:12:49'),
(117, 'Kebab algérien', 'La recette de ce kebab est spéciale!', 'AZOUZA', 'jpg', 3, '2016-11-08 20:38:48', '2016-11-08 20:38:48'),
(118, 'Kebab kabyle', 'Ceci est un kebab amazigh également ', 'TIZI OUZOU', 'jpg', 3, '2016-11-08 20:55:07', '2016-11-08 20:55:07');

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `label` varchar(128) NOT NULL,
  `id_photo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tags`
--

INSERT INTO `tags` (`id`, `label`, `id_photo`) VALUES
(1, 'amazigh', 111),
(2, 'berbere', 111),
(3, 'berbere', 109),
(4, 'ingrédients', 112),
(5, 'recette', 112),
(6, 'amazigh', 115),
(7, 'berbere', 115),
(8, 'LAXOU', 110),
(9, 'amazigh', 116),
(10, 'berbere', 116),
(11, 'ELKLAA', 116),
(12, 'AZOUZA', 117),
(13, 'LNI', 117),
(14, 'ingrédients', 117),
(15, 'gouter', 117),
(16, 'kebab', 117);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(128) DEFAULT NULL,
  `nom` varchar(128) NOT NULL,
  `prenom` varchar(128) DEFAULT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `profil` enum('membre','admin') DEFAULT NULL,
  `radie` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `nom`, `prenom`, `email`, `password`, `profil`, `radie`) VALUES
(2, 'Kamel79', 'REMAKI', 'Kamel', 'remakikamel@hotmail.fr', '$2y$10$lZq65fYOQlar7Lgv995K8etZGFM4diuoU1LyDl7RrCwFtjQT2D0ka', NULL, NULL),
(3, 'Nacera86', 'ELIAS ', 'Nacera', 'eliasnacera@hotmail.fr', '$2y$10$VE.YprCmnMWvKL0KSxvbSuQtNh.jF5CUvlSO9xrlhBY1qPzLADQT2', NULL, NULL),
(5, 'SOUSOU', 'GUEMINI', 'SOUAD', 'remakisouad@hotmail.fr', '$2y$10$Y5K0zeUi6hLNNGbzryoDDuXcdYxQhv9wqCU/2mTXPOtmAKJwjMbni', NULL, NULL),
(6, 'Sonia92', 'ELIAS', 'SONIA', 'eliassonia@hotmail.fr', '$2y$10$y74aOyIjuj4VaXvk97g3uehTah5G6G0PN.30CsWXAvrZQU6pEwxqa', NULL, NULL),
(7, 'Hakim93', 'REMAKI', 'Hakim', 'remakihakim@hotmail.fr', '$2y$10$caZkP1oolxNobpIJtu.da.c7BtXehisV.b9SqfyYctT2MujfN0h.K', NULL, NULL);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_billet` (`id_photo`),
  ADD KEY `id_utilisateur` (`id_user`);

--
-- Index pour la table `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `notation`
--
ALTER TABLE `notation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_photo` (`id_photo`);

--
-- Index pour la table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tag_phot` (`id_photo`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pseudo` (`pseudo`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `departement`
--
ALTER TABLE `departement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;
--
-- AUTO_INCREMENT pour la table `notation`
--
ALTER TABLE `notation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT pour la table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;
--
-- AUTO_INCREMENT pour la table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `fk_comm_phot` FOREIGN KEY (`id_photo`) REFERENCES `photos` (`id`),
  ADD CONSTRAINT `fk_comm_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `notation`
--
ALTER TABLE `notation`
  ADD CONSTRAINT `fk_not_phot` FOREIGN KEY (`id_photo`) REFERENCES `photos` (`id`);

--
-- Contraintes pour la table `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `fk_phot_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `tags`
--
ALTER TABLE `tags`
  ADD CONSTRAINT `fk_tag_phot` FOREIGN KEY (`id_photo`) REFERENCES `photos` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
