-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 19 juil. 2023 à 23:55
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

-- CETTE BASE DE DONNÉES EST UNE BASE DE DONNÉE D'EXEMPLE
-- RETROUVEZ LES INFOS DE CONNEXIONS POUR LES COMPTES DANS LE README GITHUB

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `snitch`
--

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `comportement` tinyint(1) NOT NULL DEFAULT 0,
  `vol` tinyint(1) NOT NULL DEFAULT 0,
  `grief` tinyint(1) NOT NULL DEFAULT 0,
  `xray` tinyint(1) NOT NULL DEFAULT 0,
  `triche` tinyint(1) NOT NULL DEFAULT 0,
  `informations` varchar(350) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reported_user_uuid` varchar(36) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `comportement`, `vol`, `grief`, `xray`, `triche`, `informations`, `user_id`, `reported_user_uuid`, `created_at`) VALUES
(1, 1, 0, 0, 0, 0, 'Le joueur en question a envoyé plusieurs messages inappropriés dans le chat.\r\n\r\nMalgré plusieurs avertissements, il a décidé de continuer et après l\'avoir réprimandé, il est revenu à la charge sur Discord en insultant tout le monde.', 2, '853c80ef-3c37-49fd-aa49-938b674adae6', '2023-07-19 21:42:56'),
(2, 0, 1, 0, 0, 0, 'Chicken a volé dans plusieurs coffres d\'un joueur et s\'est ensuite donné les droits de vider tous les coffres communautaires.\r\n\r\nCe n\'était pas la première fois que ça arrivait.', 2, 'b4733311-a93c-4b40-9a92-0ab907660752', '2023-07-19 21:45:57'),
(3, 0, 1, 1, 0, 0, 'Le joueur a détruit plusieurs bases et a piqué des items rares dans les coffres.\r\n\r\nIl s\'en est servi pour les distribuer au spawn du serveur.', 4, '55b0cd96-996f-438f-9507-208df9c2f5a8', '2023-07-19 21:48:16'),
(4, 0, 0, 0, 1, 1, 'Pig a cette fois été attrapé en train de se diriger tout droit vers les minerais.\r\n\r\nIl a plus tard été apperçu en train de voler, d\'avancer en speed et de aimbot.', 4, '55b0cd96-996f-438f-9507-208df9c2f5a8', '2023-07-19 21:49:46');

-- --------------------------------------------------------

--
-- Structure de la table `reported_users`
--

CREATE TABLE `reported_users` (
  `id` int(11) NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `username` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reported_users`
--

INSERT INTO `reported_users` (`id`, `uuid`, `username`) VALUES
(1, '853c80ef-3c37-49fd-aa49-938b674adae6', 'jeb_'),
(2, 'b4733311-a93c-4b40-9a92-0ab907660752', 'Chicken'),
(3, '55b0cd96-996f-438f-9507-208df9c2f5a8', 'Pig');

-- --------------------------------------------------------

--
-- Structure de la table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`) VALUES
(1, 'maintenance.enabled', '0'),
(2, 'maintenance.title', 'En construction...'),
(3, 'maintenance.description', 'Le site arrive bientôt !');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(150) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(500) NOT NULL,
  `permissions` tinyint(4) NOT NULL DEFAULT 3,
  `discord_id` varchar(18) NOT NULL,
  `discord_webhook` varchar(300) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `permissions`, `discord_id`, `discord_webhook`, `created_at`) VALUES
(1, 'WAXIIE', 'wa@wa.wa', '$argon2id$v=19$m=65536,t=4,p=1$WHBWMEt5aW1Ma0lrOXJpRw$u+nxdIjUzit0xDH/J196CoGaPlCYKoOf/df0o+lfENQ', 1, '', '', '2023-07-19'),
(2, 'Notch', 'ab@ab.ab', '$argon2id$v=19$m=65536,t=4,p=1$bS5FUHF0ajhxWFk2RVVocw$emvRSvUenb6V27Up2EZ47wA9GYSn1LqXJ4puJcxLMCw', 2, '', '', '2023-07-19'),
(3, 'Creeper', 'cd@cd.cd', '$argon2id$v=19$m=65536,t=4,p=1$SFIyRUh3Ty51MzVwalR6MQ$3dKvlzbaTiynvSmL3sZ7SUjZ29d/K+VnqjXzuCUAWhE', 3, '', '', '2023-07-19'),
(4, 'Axolotl', 'ef@ef.ef', '$argon2id$v=19$m=65536,t=4,p=1$bUd4VEI2Uk1MeUJUTUlxZA$p9G1Ajlck2M0CbjTlXrhIGY8/wUBVFkcA08r3L5YpaI', 2, '', '', '2023-07-19');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `reported_users`
--
ALTER TABLE `reported_users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `reported_users`
--
ALTER TABLE `reported_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
