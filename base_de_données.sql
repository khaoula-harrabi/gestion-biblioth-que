-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 15 fév. 2021 à 11:54
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projetsymfony`
--

-- --------------------------------------------------------

--
-- Structure de la table `abonne`
--

DROP TABLE IF EXISTS `abonne`;
CREATE TABLE IF NOT EXISTS `abonne` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_abonn` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pays` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `abonnee`
--

DROP TABLE IF EXISTS `abonnee`;
CREATE TABLE IF NOT EXISTS `abonnee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomabonne` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pays` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `abonnee`
--

INSERT INTO `abonnee` (`id`, `nomabonne`, `adresse`, `pays`, `telephone`) VALUES
(1, 'abir belguith', 'route tunis', 'tunis', 23654789),
(3, 'khaoula', 'toute el matar', 'sfax', 236554789);

-- --------------------------------------------------------

--
-- Structure de la table `auteur`
--

DROP TABLE IF EXISTS `auteur`;
CREATE TABLE IF NOT EXISTS `auteur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `biographie` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `auteur`
--

INSERT INTO `auteur` (`id`, `prenom`, `nom`, `biographie`) VALUES
(1, 'amin', 'arous', 'directeur apple'),
(4, 'richard', 'sallman', 'le plus dramatique acteur');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `designation`, `description`) VALUES
(1, 'scientifiques', 'regrouppe tous les livres scientifisues'),
(4, 'geographie', 'livres geographique sur tous le monde');

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
('DoctrineMigrations\\Version20201203173217', '2020-12-03 18:32:36', 49),
('DoctrineMigrations\\Version20201204161701', '2020-12-04 17:21:40', 653),
('DoctrineMigrations\\Version20201204194038', '2020-12-04 20:40:59', 381),
('DoctrineMigrations\\Version20201211165901', '2020-12-11 17:59:29', 749),
('DoctrineMigrations\\Version20201211220130', '2021-02-14 00:49:56', 512);

-- --------------------------------------------------------

--
-- Structure de la table `editeur`
--

DROP TABLE IF EXISTS `editeur`;
CREATE TABLE IF NOT EXISTS `editeur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomediteur` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pays` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `editeur`
--

INSERT INTO `editeur` (`id`, `nomediteur`, `pays`, `adresse`, `telephone`) VALUES
(5, 'Daound', 'France', 'Parix', 21456987),
(6, 'ERIC', 'France', 'paris', 22556698),
(7, 'florence', 'France', 'marseil', 778899654);

-- --------------------------------------------------------

--
-- Structure de la table `emprunt`
--

DROP TABLE IF EXISTS `emprunt`;
CREATE TABLE IF NOT EXISTS `emprunt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `date_retour` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `emprunt`
--

INSERT INTO `emprunt` (`id`, `date`, `date_retour`) VALUES
(1, '2016-01-01', '2016-01-01'),
(2, '2020-06-12', '2021-05-08');

-- --------------------------------------------------------

--
-- Structure de la table `emprunt_livre`
--

DROP TABLE IF EXISTS `emprunt_livre`;
CREATE TABLE IF NOT EXISTS `emprunt_livre` (
  `emprunt_id` int(11) NOT NULL,
  `livre_id` int(11) NOT NULL,
  PRIMARY KEY (`emprunt_id`,`livre_id`),
  KEY `IDX_562087F2AE7FEF94` (`emprunt_id`),
  KEY `IDX_562087F237D925CB` (`livre_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `emprunt_user`
--

DROP TABLE IF EXISTS `emprunt_user`;
CREATE TABLE IF NOT EXISTS `emprunt_user` (
  `emprunt_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`emprunt_id`,`user_id`),
  KEY `IDX_C166DE57AE7FEF94` (`emprunt_id`),
  KEY `IDX_C166DE57A76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `livres_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C53D045FEBF07F38` (`livres_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`id`, `livres_id`, `name`) VALUES
(10, 17, 'mer.jpg'),
(11, 18, 'IA.jpg'),
(12, 19, 'bi.jpg'),
(13, 20, 'symfony.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `livre`
--

DROP TABLE IF EXISTS `livre`;
CREATE TABLE IF NOT EXISTS `livre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nbpages` int(11) NOT NULL,
  `dateedition` date NOT NULL,
  `nbreexemplaires` int(11) NOT NULL,
  `prix` double NOT NULL,
  `isbn` bigint(20) NOT NULL,
  `editeur_id` int(11) NOT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_AC634F993375BD21` (`editeur_id`),
  KEY `IDX_AC634F99BCF5E72D` (`categorie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `livre`
--

INSERT INTO `livre` (`id`, `titre`, `nbpages`, `dateedition`, `nbreexemplaires`, `prix`, `isbn`, `editeur_id`, `categorie_id`) VALUES
(17, 'mer', 320, '2021-01-05', 300, 150, 1236674, 7, 4),
(18, 'ia', 220, '2021-01-19', 300, 150, 1236647, 5, 1),
(19, 'BI', 220, '2021-01-20', 563, 54, 1236678, 5, 1),
(20, 'symfony', 202, '2020-12-28', 80, 54000, 1236644, 6, 1);

-- --------------------------------------------------------

--
-- Structure de la table `livre_abonnee`
--

DROP TABLE IF EXISTS `livre_abonnee`;
CREATE TABLE IF NOT EXISTS `livre_abonnee` (
  `livre_id` int(11) NOT NULL,
  `abonnee_id` int(11) NOT NULL,
  PRIMARY KEY (`livre_id`,`abonnee_id`),
  KEY `IDX_9F62FE9937D925CB` (`livre_id`),
  KEY `IDX_9F62FE998BACA6B1` (`abonnee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `livre_auteur`
--

DROP TABLE IF EXISTS `livre_auteur`;
CREATE TABLE IF NOT EXISTS `livre_auteur` (
  `livre_id` int(11) NOT NULL,
  `auteur_id` int(11) NOT NULL,
  PRIMARY KEY (`livre_id`,`auteur_id`),
  KEY `IDX_A11876B537D925CB` (`livre_id`),
  KEY `IDX_A11876B560BB6FE6` (`auteur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `livre_auteur`
--

INSERT INTO `livre_auteur` (`livre_id`, `auteur_id`) VALUES
(17, 1),
(18, 1),
(19, 4),
(20, 4);

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
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`) VALUES
(12, 'khaoula@gmail.com', '[\"ROLE_ADMIN\"]', '$argon2i$v=19$m=65536,t=4,p=1$VGNycU9GaG5qa0NrZDRUWg$+B4IJNsE536I7g1MtjnTbgothYLoZ0MSBhbwQ/hRspY'),
(13, 'user@gmail.com', '[\"ROLE_USER\"]', '$argon2i$v=19$m=65536,t=4,p=1$cVJzeDNaVzJ0cVY0NzZKQQ$2okiLyN6O/cac0a7kJR+5t5LNCnpSrVZIC7dT3qn6cs');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `emprunt_livre`
--
ALTER TABLE `emprunt_livre`
  ADD CONSTRAINT `FK_562087F237D925CB` FOREIGN KEY (`livre_id`) REFERENCES `livre` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_562087F2AE7FEF94` FOREIGN KEY (`emprunt_id`) REFERENCES `emprunt` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `emprunt_user`
--
ALTER TABLE `emprunt_user`
  ADD CONSTRAINT `FK_C166DE57A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_C166DE57AE7FEF94` FOREIGN KEY (`emprunt_id`) REFERENCES `emprunt` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `FK_C53D045FEBF07F38` FOREIGN KEY (`livres_id`) REFERENCES `livre` (`id`);

--
-- Contraintes pour la table `livre`
--
ALTER TABLE `livre`
  ADD CONSTRAINT `FK_AC634F993375BD21` FOREIGN KEY (`editeur_id`) REFERENCES `editeur` (`id`),
  ADD CONSTRAINT `FK_AC634F99BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`);

--
-- Contraintes pour la table `livre_abonnee`
--
ALTER TABLE `livre_abonnee`
  ADD CONSTRAINT `FK_9F62FE9937D925CB` FOREIGN KEY (`livre_id`) REFERENCES `livre` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_9F62FE998BACA6B1` FOREIGN KEY (`abonnee_id`) REFERENCES `abonnee` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `livre_auteur`
--
ALTER TABLE `livre_auteur`
  ADD CONSTRAINT `FK_A11876B537D925CB` FOREIGN KEY (`livre_id`) REFERENCES `livre` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_A11876B560BB6FE6` FOREIGN KEY (`auteur_id`) REFERENCES `auteur` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
