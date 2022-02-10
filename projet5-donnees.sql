-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 10 fév. 2022 à 14:08
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet5`
--

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `user_id`, `post_id`, `created_at`, `content`, `is_validated`) VALUES
(1, 1, 1, '2021-11-29 16:21:34', 'Ceci est un commentaire de test, pour s\'assurer du bon fonctionnement de la page.', 1),
(2, 2, 1, '2022-01-06 15:33:24', 'Ceci est un commentaire non valide pour le test.', 0),
(3, 4, 3, '2022-01-10 16:43:30', 'Ceci un commentaire sur le 3Ã¨me article.', 1),
(4, 4, 15, '2022-01-18 17:55:14', 'Commentaire test sur l\'article nÂ°13', 0),
(5, 4, 16, '2022-01-20 16:32:25', 'Suspendisse potenti. Praesent tempor tortor nec aliquet laoreet. Nam et urna in dolor consequat commodo vel ut purus. Suspendisse sit amet consectetur arcu. ', 1),
(6, 4, 4, '2022-02-01 13:33:04', 'commentaire de l\'utilisateurtest.', 1),
(7, 4, 16, '2022-02-02 14:29:57', 'Commentaire sur l\'article 16', 0),
(8, 4, 16, '2022-02-02 14:44:12', 'test 02/02/2022', 0),
(9, 4, 18, '2022-02-04 21:55:06', 'Commentaire haha', 0);

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `user_id`, `title`, `slug`, `updated_at`, `chapo`, `content`) VALUES
(1, 1, 'Titre Test', 'titre-test', '2021-11-25 11:30:29', 'Chapo test', 'Content Test'),
(2, 4, 'titre test 2', 'titre-test-2', '2022-01-05 16:51:36', 'chapo test 2', 'contenu test 2'),
(3, 4, 'article 3', 'article-3', '2022-01-10 14:11:49', 'chapo 3', 'Contenu 3'),
(4, 4, 'Titre exemple 4', 'titre-exemple-4', '2022-01-10 16:29:03', 'Chapo exemple 4', 'Content exemple 4'),
(5, 4, 'titre 5', 'titre-5', '2022-01-13 13:33:54', 'chapo 5', 'contenu 5'),
(6, 4, 'titre 6', 'titre-6', '2022-01-13 13:34:07', 'chapo 6', 'contenu 6'),
(7, 4, 'titre 7', 'titre-7', '2022-01-13 13:34:20', 'chapo 7', 'contenu 7'),
(8, 4, 'titre 8', 'titre-8', '2022-01-13 13:34:42', 'chapo 8', 'contenu 8'),
(9, 4, 'titre 9', 'titre-9', '2022-01-13 13:34:54', 'chapo9', 'contenu 9'),
(10, 4, 'titre 10', 'titre-10', '2022-01-13 13:35:08', 'chapo 10', 'contenu 10'),
(12, 4, 'titre 1', 'titre-1', '2022-01-15 14:48:12', 'chapo 1', 'contenu 1 modifiÃ© le 15/01/2022'),
(13, 4, 'titre 0 (modified)', 'titre-0-modified', '2022-01-18 17:04:13', 'chapo 0', 'contenu 0 modified on 18/01/2022 at 18:04'),
(15, 4, 'Article NÂ°13 ', 'article-n013', '2022-01-18 17:24:31', 'chapo de l\'artcile nÂ°13.', 'Contenu de l\'article NÂ°13.'),
(16, 4, 'Ce Titre Contient un minimumum de 20 caractÃ¨res', 'ce-titre-contient-20-caracteres', '2022-02-01 14:16:49', 'chapo avec plus de 20 caracteres (article 16)', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas volutpat quis lorem vel molestie. Pellentesque tincidunt ipsum euismod, pellentesque sapien ac, posuere mauris. Nunc ultrices nisl lacus, non sollicitudin quam ornare at. Fusce mattis, nunc vel semper feugiat, diam mauris vestibulum augue, id tempor velit lorem vitae sem. In sit amet nulla id nisi luctus posuere. Nunc sed massa sapien. Curabitur rhoncus turpis nisi, ac aliquam eros auctor at. Suspendisse potenti. Praesent tempor tortor nec aliquet laoreet. Nam et urna in dolor consequat commodo vel ut purus. Suspendisse sit amet consectetur arcu. '),
(17, 4, 'Nous sommes le 02/02/2022, voici un article', 'nous-sommes-le-02-02-2022-voici-un-article', '2022-02-02 15:55:20', 'Voici le chapo de l\'article du jour', 'Ceci est le corps de l\'article, contenant toute les informations nÃ©cessaires.'),
(18, 4, 'Titre De Plus De 20 CaratÃ¨res', 'titre-de-plus-de-20-carateres', '2022-02-04 15:14:18', 'Chapo De Plus De 20 CaratÃ¨res', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `alias`, `firstname`, `lastname`, `is_admin`) VALUES
(1, 'user@mail.com', '$2y$10$QFsNv7kAoiLFrhaoyr/HVugs2LQaw5UKrWGKOuo833sjF0SNbkrOS', 'user1', 'John', 'Test', 0),
(2, 'test@email.fr', 'password', 'user2', 'prenom2', 'nom2', 0),
(3, 'alias@mail.fr', 'mdp123789', 'alias', 'nom', 'prenom', 0),
(4, 'UtilisateurTest@mail.com', '$2y$10$6c3NycLFnTGzgbtaXCI4k.FcTIewxdAh7LZH.losjxUA311Q76Tmi', 'UtilisateurTest', 'UtilisateurTest', 'UtilisateurTest', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
