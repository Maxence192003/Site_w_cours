-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql
-- Généré le : mer. 14 mai 2025 à 13:37
-- Version du serveur : 8.4.4
-- Version de PHP : 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `test_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `biblio`
--

CREATE TABLE `biblio` (
  `id_titre` int NOT NULL,
  `Titre` varchar(255) NOT NULL,
  `Auteur` varchar(255) NOT NULL,
  `Bio` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `biblio`
--

INSERT INTO `biblio` (`id_titre`, `Titre`, `Auteur`, `Bio`, `Desc`, `image`) VALUES
(3, 'Le trône de fer tome1', 'George R. R. Martin', 'George R. R. Martin, né le 20 septembre 1948 à Bayonne, est un écrivain américain de science-fiction et de fantasy, également scénariste et producteur de télévision. Son œuvre la plus célèbre est la série romanesque du Trône de fer, adaptée sous forme de série télévisée par HBO sous le titre Game of Thrones.', 'Game of Thrones est le premier livre de la saga Le Trône de fer écrite par George R. R. Martin. Le livre, d\'ambiance médiévale, a été publié en version originale en 1996, puis en version française de 1998 à 1999. Il a remporté le prix Locus du meilleur roman de fantasy en 1997 coucou', 'assets/img/livre/67f7b1c3c8526-images.jpg'),
(6, 'The Winds of Winter', 'George R. R. Martin', 'George R. R. Martin, né le 20 septembre 1948 à Bayonne, est un écrivain américain de science-fiction et de fantasy, également scénariste et producteur de télévision. Son œuvre la plus célèbre est la série romanesque du Trône de fer, adaptée sous forme de série télévisée par HBO sous le titre Game of Thrones.', 'The Winds of Winter est le sixième tome de la saga Le Trône de fer écrite par George R. R. Martin. ', NULL),
(8, 'Feu et Sang', 'George R. R. Martin', 'George R. R. Martin, né le 20 septembre 1948 à Bayonne, est un écrivain américain de science-fiction et de fantasy, également scénariste et producteur de télévision. Son œuvre la plus célèbre est la série romanesque du Trône de fer, adaptée sous forme de série télévisée par HBO sous le titre Game of Thrones.', 'Feu et Sang est un roman de fantasy écrit par George R. R. Martin et publié en deux parties. La première partie, publiée le 20 novembre 2018 aux États-Unis et le lendemain en France', NULL),
(10, 'Nains tome 1 - Redwin de la Forge', 'Nicolas Jarry', 'Nicolas Jarry est un auteur de bande dessinée, né le 19 juin 1976 à Rosny-sous-bois. Il a passé une partie de son enfance chez ses grands-parents à Excideuil, en Dordogne. Il réside à Périgueux en Périgord.', 'Nains, la nouvelle grande saga Fantasy ! Une histoire des plus poignantes ! Une tragédie épique !Redwin, fils d\'Ulrog, a grandi auprès d\'un père aimant et attentif à son apprentissage de la forge. Mais, autrefois admiré de tous, Ulrog ne veut plus créer d\'armes runiques. à compter de ce jour, Ulrog le forgeron est devenu Ulrog le Lâche.?Humilié, fou de rage, Redwin est prêt à tout pour s\'éloigner de son père et devenir un seigneur des runes : le maître forgeron et maître combattant de l\'ordre de la Forge.?Contre la volonté de son père, il se rend à la forteresse-état retrouver son oncle, un Vénérable de l\'Ordre qui accepte de lui enseigner le combat et la forge d\'armes.?Pourtant ses victoires ne lui apportent aucune paix, aucun répit, bien au contraire, sa haine envers son père grandit de jour en jour. ?Dévoré par sa propre colère, Redwin deviendra seigneur des runes. Loin d\'être un aboutissement, ce sera le début d\'un long calvaire...', 'assets/img/livre/67dc2daed44ef-91Z-61+htRL._AC_UL600_SR600,600_.jpg'),
(37, '1', '1', '1', 'Nains, la nouvelle grande saga Fantasy ! \r\nUne histoire des plus poignantes ! \r\nUne tragédie épique !Redwin, fils d\'Ulrog, a grandi auprès d\'un père aimant et attentif à son apprentissage de la forge. \r\nMais, autrefois admiré de tous, Ulrog ne veut plus créer d\'armes runiques. à compter de ce jour, Ulrog le forgeron est devenu Ulrog le Lâche.\r\nHumilié, fou de rage, Redwin est prêt à tout pour s\'éloigner de son père et devenir un seigneur des runes : le maître forgeron et maître combattant de l\'ordre de la Forge.?\r\nContre la volonté de son père, il se rend à la forteresse-état retrouver son oncle, un Vénérable de l\'Ordre qui accepte de lui enseigner le combat et la forge d\'armes.?\r\nPourtant ses victoires ne lui apportent aucune paix, aucun répit, bien au contraire, sa haine envers son père grandit de jour en jour. ?\r\nDévoré par sa propre colère, Redwin deviendra seigneur des runes. Loin d\'être un aboutissement, ce sera le début d\'un long calvaire...', 'assets/img/livre/6821e46ebf401-La-Guerre-Solaire.jpg'),
(39, '2', '2', '2', '2', NULL),
(40, '22', '22', '22', '22', NULL),
(41, '222', '222', '222', '222', NULL),
(42, '2222', '2222', '2222', '2222', NULL),
(43, '22222', '22222', '22222', '22222', NULL),
(44, '222222', '222222', '222222', '222222', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(10) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `role`) VALUES
(14, 'Brullon', 'maxence192003@gmail.com', '$2y$10$H2ha56qpknJAruK7hFXa.uYj9S4YMsB96/EBfk7cBRVzzeH7y/lNm', '2025-01-22 20:46:25', 'A'),
(17, 'test', 'test@gmail.com', '$2y$10$PhreE7pScUw131TBrCopl.9YE1Zh/WeQkWSgGrPXKgSoaKpurNNJ.', '2025-02-13 13:08:35', '0'),
(18, 'Achete du viagras https://http://localhost:8080/www/pages/inscription.php', 'testviagra@gmai.com', '$2y$10$bZ.wn5qVthx/1E0S6JE4Lehx0rVHzQFDR9PUVRb8wDpGQxu9xA162', '2025-02-17 14:09:51', '0'),
(19, 'test10', 'test10@gmail.com', '$2y$10$9l2EtyCuTSYro8Pd6Ld3K.Hk4ev4Ha33U2drXqwADXmiZmlFSt8fm', '2025-02-20 13:38:44', '0'),
(20, 'root', 'root@gmail.com', '$2y$10$J5uCtkIHPfnbu7O6PPsudOkQF3zyNzYnVf9Bk.PPIKUhXOkme.7Hi', '2025-02-20 13:52:04', 'A'),
(21, 'Maryline', 'maryline.vialard@gmail.com', '$2y$10$2HtkMJz1Lbvf7cku0WYbf.BVYNWA.q7mF47Yb5WRH/Us7GUuQ3Ea.', '2025-03-18 21:18:15', '0'),
(22, 'Fred', 'fbrullon@gmail.com', '$2y$10$zrgguiyCWHGY/VVjfe/IBeFL5uaLsEjItstCaOHQZ8vAzo/dMnCbq', '2025-03-19 15:47:54', '0'),
(23, 'maxene192003@gmail.com', 'maxene192003@gmail.com', '$2y$10$CNtJeP8w7qeynJpQTcwqfecLZXhXhGq2Lh3PLUFeD5V2KbqVb9Vxe', '2025-03-20 14:27:05', '0'),
(24, '10', '10@gmail.com', '$2y$10$Mew3dUj0PXi3A6LwjlrIde6WXcpkAa4yd3dm8XwJz6/ZSd3SpmG8i', '2025-03-27 12:55:06', '0'),
(25, '1', '1@gmail.com', '$2y$10$2krTNk6FVMIMLQuZzJHKNuxrRMCCDYwoDfe9fDsy2s9s7I3TCVUVi', '2025-05-12 10:42:10', '0');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `biblio`
--
ALTER TABLE `biblio`
  ADD PRIMARY KEY (`id_titre`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `biblio`
--
ALTER TABLE `biblio`
  MODIFY `id_titre` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
