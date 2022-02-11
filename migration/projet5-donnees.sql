-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 11 fév. 2022 à 13:51
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
(2, 1, 1, '2022-01-06 15:33:24', 'Ceci est un commentaire non valide pour le test.', 0),
(3, 2, 3, '2022-01-10 16:43:30', 'Ceci un commentaire sur le 3Ã¨me article.', 1),
(4, 2, 4, '2022-02-01 13:33:04', 'commentaire de l\'utilisateurtest.', 1);

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `user_id`, `title`, `slug`, `updated_at`, `chapo`, `content`) VALUES
(1, 1, 'Lorem ipsum titre article 1', 'lorem-ipsum-titre-article-1', '2021-11-25 11:30:29', 'Chapo 1 : At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.'),
(2, 2, 'Lorem ipsum titre article 2', 'lorem-ipsum-titre-article-2', '2022-01-05 16:51:36', 'chapo 2 : At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.'),
(3, 2, 'Lorem ipsum titre article 3', 'lorem-ipsum-titre-article-3', '2022-01-10 14:11:49', 'chapo 3 : At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.'),
(4, 2, 'Lorem ipsum titre article 4', 'lorem-ipsum-titre-article-4', '2022-01-10 16:29:03', 'Chapo 4 : At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.'),
(5, 2, 'Lorem ipsum titre article 5', 'lorem-ipsum-titre-article-5', '2022-01-13 13:33:54', 'chapo 5 : At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.'),
(6, 2, 'Lorem ipsum titre article 6', 'lorem-ipsum-titre-article-6', '2022-01-13 13:34:07', 'chapo 6 : At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.'),
(7, 2, 'Lorem ipsum titre article 7', 'lorem-ipsum-titre-article-7', '2022-01-13 13:34:20', 'chapo 7 : At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.'),
(8, 2, 'Lorem ipsum titre article 8', 'lorem-ipsum-titre-article-8', '2022-01-13 13:34:42', 'chapo 8 : At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.'),
(9, 2, 'Lorem ipsum titre article 9', 'lorem-ipsum-titre-article-9', '2022-01-13 13:34:54', 'chapo 9 : At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.'),
(10, 2, 'Lorem ipsum titre article 10', 'lorem-ipsum-titre-article-10', '2022-01-13 13:35:08', 'chapo 10 : At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.'),
(13, 2, 'Lorem ipsum titre article 11', 'lorem-ipsum-titre-article-11', '2022-01-15 14:48:12', 'chapo 1 : At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.'),
(12, 2, 'Lorem ipsum titre article 12', 'lorem-ipsum-titre-article-12', '2022-01-18 17:04:13', 'chapo 0 : At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.');

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `alias`, `firstname`, `lastname`, `is_admin`) VALUES
(1, 'user@mail.com', '$2y$10$QFsNv7kAoiLFrhaoyr/HVugs2LQaw5UKrWGKOuo833sjF0SNbkrOS', 'user1', 'Jeff', 'Denton', 0),
(2, 'admin@mail.com', '$2y$10$6c3NycLFnTGzgbtaXCI4k.FcTIewxdAh7LZH.losjxUA311Q76Tmi', 'admin1', 'John', 'Anderson', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
