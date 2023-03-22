-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mar. 21 mars 2023 à 10:32
-- Version du serveur : 10.6.12-MariaDB-0ubuntu0.22.04.1
-- Version de PHP : 8.1.2-1ubuntu2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `userConnect`
--

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_user` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `email`, `password`) VALUES
(1, 'foo@bar.com', '$2b$10$Y66cjmSEjDxV7.8eO.jfReC4A1Ed4yakJuu4jwp9v6LLXkQqvf1tC'),
(2, 'gerard.tourres@gmail.com', '$2b$10$udb94nCZo8saZEaxg7YUFei/BhF7P.kdyyN10fOfWKgjTmv4n4Xry'),
(3, 'test@test.com', '$2b$10$8Km/1nweITjaqmgR2HY2oukJCfS1FR6MxFXuy5GdQBl5Tl0S3dNs6'),
(4, 'tarte@molle.com', '$2b$10$/2wfrjol7Thqc/cknE6aA.gvlQGdrhuHkcuEJXInSPf2cKF11IJeC');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
