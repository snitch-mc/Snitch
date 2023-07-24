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

-- --------------------------------------------------------

--
-- Structure de la table `reported_users`
--

CREATE TABLE `reported_users` (
                                  `id` int(11) NOT NULL,
                                  `uuid` varchar(36) NOT NULL,
                                  `username` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


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
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT pour la table `reported_users`
--
ALTER TABLE `reported_users`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT pour la table `settings`
--
ALTER TABLE `settings`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

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
