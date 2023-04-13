-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 13 avr. 2023 à 11:12
-- Version du serveur :  5.7.19-log
-- Version de PHP : 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `symfony_argentik`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_64C19C1727ACA70` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `parent_id`, `name`, `slug`) VALUES
(1, 10, 'Normandie', 'normandie'),
(2, 11, 'New-York', 'new-york'),
(3, 14, 'Chine', 'chine'),
(6, 10, 'Bretagne', 'bretagne'),
(7, 10, 'Paris', 'paris'),
(8, 14, 'Turquie', 'turquie'),
(9, 14, 'Inde', 'inde'),
(10, NULL, 'France', 'france'),
(11, NULL, 'Amériques', 'ameriques'),
(12, NULL, 'Afrique', 'afrique'),
(13, 12, 'Tunisie', 'tunisie'),
(14, NULL, 'Asie', 'asie');

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9474526C4B89032C` (`post_id`),
  KEY `IDX_9474526CA76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `created_at`, `content`, `post_id`, `user_id`) VALUES
(1, '2022-05-17 17:34:49', 'Joli pédiluve !', 3, 23),
(2, '2022-05-17 17:41:07', 'Malheureusement avec l\'érosion des falaises cette église va disparaitre ', 2, 23),
(3, '2022-05-18 14:18:23', 'Je connais bien cet endroit, il y a une friterie juste à côté ;)', 3, 23),
(8, '2022-05-19 16:25:05', 'Ciel chargé mais belle lumière !', 4, 23),
(9, '2022-05-20 08:35:57', 'Belle lumière', 3, 23),
(10, '2022-05-20 08:38:35', 'Cadrage réussi', 3, 23),
(12, '2022-05-25 13:29:56', 'Déjà vu cette photo ailleurs', 8, 23),
(13, '2022-05-28 14:09:33', 'Jolie photo et très bel endroit', 8, 23),
(14, '2022-07-04 16:12:23', 'Test', 15, 24);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220412114745', '2022-04-12 11:55:51', 1330),
('DoctrineMigrations\\Version20220412131002', '2022-04-12 13:12:52', 827),
('DoctrineMigrations\\Version20220413095102', '2022-04-13 09:53:51', 2537),
('DoctrineMigrations\\Version20220413101748', '2022-04-13 10:17:58', 3587),
('DoctrineMigrations\\Version20220414124249', '2022-04-14 16:33:58', 3860),
('DoctrineMigrations\\Version20220517155539', '2022-05-17 16:01:04', 1565),
('DoctrineMigrations\\Version20220517160117', '2022-05-17 16:01:45', 4459),
('DoctrineMigrations\\Version20220531053126', '2022-05-31 05:33:07', 1644),
('DoctrineMigrations\\Version20220603120055', '2022-06-03 12:02:53', 8712),
('DoctrineMigrations\\Version20220608090314', '2022-06-08 09:10:15', 1985),
('DoctrineMigrations\\Version20220620150340', '2022-06-20 15:05:01', 16151),
('DoctrineMigrations\\Version20220620161335', '2022-06-20 16:14:30', 5266);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `active` tinyint(1) NOT NULL,
  `price` float(10,2) NOT NULL,
  `views` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5A8A6C8DA76ED395` (`user_id`),
  KEY `IDX_5A8A6C8D12469DE2` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `user_id`, `category_id`, `title`, `slug`, `content`, `image`, `created_at`, `active`, `price`, `views`) VALUES
(2, 24, 1, 'Eglise et cimetière en péril', 'eglise-et-cimetiere-en-peril', '<p>Photo prise sur les hauts de Veules les Roses, C&ocirc;te d&#39;Alb&acirc;tre, Normandie.<br />\r\nPhoto prise avec un Lubitel 166 avec une pellicule Fuji Reala 100 ISO p&eacute;rim&eacute;e depuis 2012.<br />\r\nD&eacute;veloppement et scan par <a href=\"https://negatifplus.com/\">N&eacute;gatif Plus</a> &agrave; Paris.&nbsp;</p>', 'NO6.jpg', '2022-04-12 09:44:34', 1, 0.00, 0),
(3, 24, 1, 'Piscine de Veules les Roses', 'piscine-de-veules-les-roses', '<p>Photo prise sur les hauts de Veules les Roses, C&ocirc;te d&#39;Alb&acirc;tre, Normandie.<br />\r\nPhoto prise avec un Lubitel 166 avec une pellicule Fuji Reala 100 ISO p&eacute;rim&eacute;e depuis 2012.<br />\r\nD&eacute;veloppement et scan par <a href=\"https://negatifplus.com/\">N&eacute;gatif Plus</a> &agrave; Paris.&nbsp;&nbsp;</p>', 'NO5.jpg', '2022-04-19 09:49:36', 1, 0.00, 0),
(4, 24, 1, 'Digue et falaise du Tréport', 'digue-et-falaise-du-treport', '<p>Photo prise sur les hauts de Veules les Roses, Côte d\'Albâtre, Normandie.<br>Photo prise avec un Lubitel 166 avec une pellicule Fuji Reala 100 ISO périmée depuis 2012.<br>Développement et scan par <a href=\"https://negatifplus.com/\">Négatif Plus</a> à Paris.&nbsp;</p>', 'NO4.jpg', '2022-04-19 11:23:05', 1, 0.00, 0),
(5, 24, 1, 'Phare de Saint Valéry en Caux', 'phare-de-saint-valery-en-caux', '<p>Photo prise sur la digue du phare de Saint Valéry en Caux, Côte d\'Albâtre, Normandie.<br>Temps couvert, mais heureusement luminosité du bord de mer, pas de pied photo.<br>Photo réalisée avec un Lubitel 166 avec une pellicule Fuji Reala 100 ISO périmée depuis 2012.<br>Développement et scan par <a href=\"https://negatifplus.com/\">Négatif Plus</a> à Paris.&nbsp;</p>', 'NO3.jpg', '2022-04-19 11:28:04', 1, 0.00, 0),
(6, 24, 1, 'Estacade de Veules les Roses', 'estacade-de-veules-les-roses', '<p>Photo prise sous l\'estacade au bout de la plage de Veules les Roses, Côte d\'Albâtre, Normandie.<br>Zone sombre avec un fort contrejour pas facile à régler.<br>Photo réalisée avec un Lubitel 166 avec une pellicule Fuji Reala 100 ISO périmée depuis 2012.<br>Développement et scan par <a href=\"https://negatifplus.com/\">Négatif Plus</a> à Paris.&nbsp;</p>', 'NO2.jpg', '2022-05-24 06:53:48', 1, 0.00, 0),
(7, 24, 1, 'Du haut de la falaise à Veules les Roses', 'du-haut-de-la-falaise-a-veules-les-roses', '<p>Photo prise sur les hauts de Veules les Roses, Côte d\'Albâtre, Normandie.<br>Photo réalisée avec un Lubitel 166 avec une pellicule Fuji Reala 100 ISO périmée depuis 2012.<br>Développement et scan par <a href=\"https://negatifplus.com/\">Négatif Plus</a> à Paris.&nbsp;</p>', 'NO1.jpg', '2022-05-24 08:52:25', 1, 0.00, 1),
(8, 24, 2, 'Washington Street', 'washington-street', '<p>Photo tr&egrave;s connue de Brooklyn dans Washington Street, avec le Manhattan Bridge en perspective.</p>\r\n\r\n<p>Appareil photo pos&eacute; au sol sur les pav&eacute;s avec d&eacute;clencheur.</p>\r\n\r\n<p>Appareil photo : Lubitel 166</p>\r\n\r\n<p>Film : Fujicolor Reala 100</p>\r\n\r\n<p>Aucun filtre.</p>', 'NY3.jpg', '2022-05-30 16:41:59', 1, 0.00, 2),
(9, 24, 3, 'Hong-Kong by night', 'hong-kong-by-night', '<p>Photo de la baie de Hong-Kong prise du ferry terminal avec au fond Hong-Kong Island etle quartier des affaires.</p>\r\n\r\n<p>Appareil photo sur pied, avec d&eacute;clencheur.</p>\r\n\r\n<p>Appareil photo : Lubitel 166</p>\r\n\r\n<p>Film : Fujicolor Reala 100</p>\r\n\r\n<p>Aucun filtre.</p>', 'CH4.jpg', '2022-05-30 16:44:28', 1, 0.00, 2),
(10, 24, 6, 'Seul sur le sable...', 'seul-sur-le-sable', '<p>Photo prise en Mai 2022 dans le port de Locquirec en Bretagne. Bateau de p&ecirc;che &eacute;chou&eacute; &agrave; mar&eacute;e basse le long du quai au fond du port.</p>\r\n\r\n<p>Appareil photo : Lubitel 166</p>\r\n\r\n<p>Film : Fujicolor Reala 100</p>\r\n\r\n<p>Aucun filtre.</p>', 'BR12.jpg', '2022-05-30 19:13:57', 1, 0.00, 0),
(11, 24, 7, 'Grande Arche de la Défense', 'grande-arche-de-la-defense', '<p>Photo de la grande arche de la D&eacute;fense prise depuis la promenade suspendue en bois dans les jardins de Nanterre construits sur les anciennes friches industrielles.</p>\r\n\r\n<p>Appareil photo pos&eacute; au sol, avec d&eacute;clencheur.</p>\r\n\r\n<p>Appareil photo : Lubitel 166</p>\r\n\r\n<p>Film : Fujicolor Reala 100</p>\r\n\r\n<p>Aucun filtre.</p>', 'PA1.jpg', '2022-05-30 19:17:57', 1, 0.00, 0),
(12, 24, 2, 'On the bridge', 'on-the-bridge', '<p>Photo prise sur la promenade pi&eacute;tonne sur le pont de Brooklyn, au-dessus des voitures.</p>\r\n\r\n<p>Appareil photo pos&eacute; au sol, avec d&eacute;clencheur.</p>\r\n\r\n<p>Appareil photo : Lubitel 166</p>\r\n\r\n<p>Film : Fujicolor Reala 100</p>\r\n\r\n<p>Aucun filtre.</p>', 'NY8.jpg', '2022-05-31 11:29:49', 1, 0.00, 0),
(13, 24, 2, 'Ground Zero', 'ground-zero', '<p>Photo prise &agrave; Ground Zero en 2010 pendant le chantier de reconstruction.</p>\r\n\r\n<p>Triste souvenir de l&#39;attentat du 11 Septembre 2001.</p>\r\n\r\n<p>Appareil photo : Lubitel 166</p>\r\n\r\n<p>Film : Fujicolor Reala 100</p>\r\n\r\n<p>Aucun filtre.</p>', 'NY10.jpg', '2022-05-31 11:42:01', 1, 0.00, 3),
(14, 24, 2, 'Brooklyn Bridge', 'brooklyn-bridge-1', '<p>Photo du pont de Brooklyn, prise depuis une petite crique au nord sur la rive c&ocirc;t&eacute; Brooklyn de l&#39;East River.</p>\r\n\r\n<p>Appareil photo pos&eacute; au sol sur la plage en graviers, avec d&eacute;clencheur.</p>\r\n\r\n<p>Appareil photo : Lubitel 166</p>\r\n\r\n<p>Film : Fujicolor Reala 100</p>\r\n\r\n<p>Aucun filtre.</p>', 'NY5.jpg', '2022-05-31 12:55:15', 1, 0.00, 2),
(15, 24, 8, 'Détroit du Bosphore', 'detroit-du-bosphore', '<p>Photo d&#39;un paquebot dans le d&eacute;troit du Bosphore &agrave; Istanbul en Turquie. Souvenir d&#39;un voyage en 2011.</p>\r\n\r\n<p>Appareil photo : Kodak R&eacute;tinette 1a de 1965.</p>\r\n\r\n<p>Film : Fujicolor Velvia 50 tr&egrave;s largement p&eacute;rim&eacute;e.</p>\r\n\r\n<p>Aucun filtre.</p>', 'IS1.jpg', '2022-06-03 07:14:04', 1, 123.00, 12),
(16, 24, 9, 'Le Taj Mahal à Agra', 'le-taj-mahal-a-agra', '<p>Photo du Taj Mahal &agrave; Agra en Inde prise depuis la campagne dans un chemin moins touristique que l&#39;acc&egrave;s officiel. Souvenir d&#39;un voyage en 2011. Test des accents : &eacute;&agrave;&egrave;&ccedil;</p>\r\n\r\n<p>Appareil photo : Kodak R&eacute;tinette 1a de 1965.</p>\r\n\r\n<p>Film : Fujicolor Velvia 50 tr&egrave;s largement p&eacute;rim&eacute;e.&nbsp;</p>\r\n\r\n<p>Aucun filtre.</p>', 'IN9.jpg', '2022-06-03 10:36:48', 1, 132.25, 48);

-- --------------------------------------------------------

--
-- Structure de la table `post_tag`
--

DROP TABLE IF EXISTS `post_tag`;
CREATE TABLE IF NOT EXISTS `post_tag` (
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`post_id`,`tag_id`),
  KEY `IDX_5ACE3AF04B89032C` (`post_id`),
  KEY `IDX_5ACE3AF0BAD26311` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `post_tag`
--

INSERT INTO `post_tag` (`post_id`, `tag_id`) VALUES
(13, 1),
(13, 3),
(14, 1),
(14, 3),
(15, 1),
(15, 2),
(16, 1),
(16, 2);

-- --------------------------------------------------------

--
-- Structure de la table `reset_password_request`
--

DROP TABLE IF EXISTS `reset_password_request`;
CREATE TABLE IF NOT EXISTS `reset_password_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `selector` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hashed_token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requested_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `expires_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_7CE748AA76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

DROP TABLE IF EXISTS `tag`;
CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tag`
--

INSERT INTO `tag` (`id`, `name`, `slug`) VALUES
(1, 'Voyage', 'voyage'),
(2, 'Rétinette', 'retinette'),
(3, 'Lubitel 166', 'lubitel-166');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `displayname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `is_verified`, `displayname`) VALUES
(23, 'moder@mail.com', '[\"ROLE_MODERATEUR\"]', '$2y$13$8R4UwQyxNP1FVBPplc.k7OqflJ/LEYIu8bXzuwWJE4JtjXMUICJdq', 1, 'Modérateur'),
(24, 'phgiraud@cogitium.com', '[\"ROLE_ADMIN\"]', '$2y$13$BXc7oPALh2dv7mqEJ2qfe.TPqvPh8ODKl1NsbvNBbIgoATKVcNfBy', 1, 'Philippe G.'),
(26, 'admin@admin.com', '[\"ROLE_ADMIN\"]', '$2y$13$8R4UwQyxNP1FVBPplc.k7OqflJ/LEYIu8bXzuwWJE4JtjXMUICJdq', 1, 'Administrateur');

-- --------------------------------------------------------

--
-- Structure de la table `user_post`
--

DROP TABLE IF EXISTS `user_post`;
CREATE TABLE IF NOT EXISTS `user_post` (
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`post_id`),
  KEY `IDX_200B2044A76ED395` (`user_id`),
  KEY `IDX_200B20444B89032C` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user_post`
--

INSERT INTO `user_post` (`user_id`, `post_id`) VALUES
(23, 16),
(24, 15),
(24, 16);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `FK_64C19C1727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `category` (`id`);

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526C4B89032C` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`),
  ADD CONSTRAINT `FK_9474526CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `FK_5A8A6C8D12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `FK_5A8A6C8DA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `post_tag`
--
ALTER TABLE `post_tag`
  ADD CONSTRAINT `FK_5ACE3AF04B89032C` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_5ACE3AF0BAD26311` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD CONSTRAINT `FK_7CE748AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `user_post`
--
ALTER TABLE `user_post`
  ADD CONSTRAINT `FK_200B20444B89032C` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_200B2044A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
