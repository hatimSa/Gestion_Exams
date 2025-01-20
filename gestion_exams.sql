-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 20 jan. 2025 à 18:03
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_exams`
--

-- --------------------------------------------------------

--
-- Structure de la table `comptes`
--

CREATE TABLE `comptes` (
  `compte_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `etat` enum('pending','accepted','rejected') NOT NULL DEFAULT 'pending',
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `comptes`
--

INSERT INTO `comptes` (`compte_id`, `first_name`, `last_name`, `email`, `password`, `phone_number`, `etat`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(37, 'simo', 'adly', 'simo@example.com', '$2y$10$c99fh3LGv.i.eQWXwpACju.9TG7Vl.Cj7rhA67Zaj94nJTZlvCUuu', '0606589873', 'accepted', 37, 1, '2025-01-11 19:47:24', '2025-01-16 00:26:58'),
(16, 'hatim', 'salhi', 'hatim@gmail.com', '$2y$10$czPmCSXnGmnjqMcc51J9leT4qiDmHKLgIsEjwnp27w46GjX5YYugW', '0642444654', 'accepted', 16, 3, '2025-01-07 13:31:05', '2025-01-16 00:24:33'),
(27, 'hicham', 'amazigh', 'hicham@example.com', '$2y$10$WjhmmuJDjrB3WC39eTnIOOgOuQWKntQtQsLOc2RoIz3Fe98lp.XlW', '0302459681', 'pending', 27, 1, '2025-01-07 16:11:32', '2025-01-16 18:27:50'),
(26, 'saad', 'elfakkak', 'saad@gmail.com', '$2y$10$ljhE2alguYZtYSWWiEmtneWNqjhDPClGqNSMcIPrKijNoq8k.sq4i', '0706524174', 'pending', 26, 1, '2025-01-07 14:27:44', '2025-01-16 00:25:19'),
(28, 'Lionel', 'Messi', 'liolio@gmail.com', '$2y$10$68U5p7MEIUwmO462EBlPVOiu6yRCdg1r2UpGcPfe2nOqDCSVmCtKO', '0001112225', 'accepted', 28, 2, '2025-01-07 16:17:22', '2025-01-16 00:25:42'),
(29, 'luis', 'suarez', 'luis@gmail.com', '$2y$10$FnLhGjQ8ozpk5c4iFMBIsO3EnIeYjkA35PfgSxC1GfxqD5jQ73wBi', '0804569874', 'accepted', 29, 2, '2025-01-07 16:35:59', '2025-01-16 00:25:56'),
(35, 'sergio', 'busquets', 'sergio@gmail.com', '$2y$10$FXkqwvS0UD.FB58cSg7TBOkfNbEZ4rL8hhNz5h3eI9qoxb3JPpDcq', '0587988754', 'accepted', 35, 2, '2025-01-09 07:45:39', '2025-01-16 00:26:27'),
(36, 'karim', 'benzima', 'karim@gmail.com', '$2y$10$0eQEp/t3krnrBsC0q5A9h.HfwiderKt7zmpXzgqnSFTyYqno4Q9le', '0796321473', 'rejected', 36, 1, '2025-01-09 08:30:31', '2025-01-16 00:26:48'),
(38, 'gareth', 'bale', 'bale@gmail.com', '$2y$10$NNrjpWsZL0Cd7TpGR95dfu0e5bwTOeWHBqFaGJXjXBkwcsmLjaHMy', '0405987456', 'pending', 38, 1, '2025-01-11 20:13:10', '2025-01-16 17:45:12'),
(39, 'pep', 'guardiola', 'pep@gmail.com', '$2y$10$.sl8jZ4M4yCUV68rlwrAk.C11s4VFhrbJUQtHeSpP3eq7wUXXSaia', '0304589636', 'rejected', 39, 2, '2025-01-11 20:14:05', '2025-01-16 00:27:49'),
(40, 'Youssef', 'Belhdi', 'youssef@gmail.com', '$2y$10$qOopF.CfaTYRPbxKOoRqy.UyJKinXHZtxEpJNqmq6n/vB4/4IAQji', '0688969685', 'accepted', 40, 1, '2025-01-13 18:45:12', '2025-01-16 00:28:18'),
(42, 'john', 'doe', 'john.doe@example.com', '$2y$10$xK8YCw1G1gxCrN27E2HTm.taGKINGC7pjKN/28UDBOV78eJ3CGZL2', '0669857496', 'accepted', 42, 1, '2025-01-14 16:52:07', '2025-01-16 00:28:26'),
(43, 'Mohamed', 'Tazi', 'mohamed.tazi@example.com', '$2y$10$uGh2Hk7ZRIv36MZRmFHZd0E2SOTztiTcN5A.MKnsh30M3ZnR1XZKi', '0601234567', 'accepted', 43, 2, '2025-01-15 23:00:00', '2025-01-16 18:20:37'),
(44, 'Amina', 'El Alaoui', 'amina.alaoui@example.com', '$2y$10$1vQf5t.MnKoDtv8zphEqDk6sOwp9RBO3wnY5hFXuI72eMZXaYm7qa', '0602345678', 'accepted', 44, 2, '2025-01-15 23:00:00', '2025-01-16 18:20:44'),
(45, 'Youssef', 'Oukacha', 'youssef.oukacha@example.com', '$2y$10$FXhRIaDF0VRv9OvmnTe3p7VwczkHptm0eFy5vD1u9FihLf9osw4Qu', '0603456789', 'accepted', 45, 1, '2025-01-15 23:00:00', '2025-01-16 18:27:25'),
(46, 'Imane', 'Benjelloun', 'imane.benjelloun@example.com', '$2y$10$5uMjZZkm7Z8FZHgUG1Wx6J8sqq6x13T1Amf.wE0YotWpkjeyb4cCm', '0604567890', 'accepted', 46, 2, '2025-01-15 23:00:00', '2025-01-16 18:20:57'),
(47, 'Rachid', 'Fassi', 'rachid.fassi@example.com', '$2y$10$BZH10hFzM5Yg9tpdI7Kp8yq.fADz5jxxK1gCk3NNN6py3ohubHoS6', '0605678901', 'accepted', 47, 2, '2025-01-15 23:00:00', '2025-01-16 18:21:03'),
(48, 'Karim', 'Tariq', 'karim.tariq@example.com', '$2y$10$NKhXkXfOxKplzFsk9rXFSdOCN.KMcLg69bb0FZvwzTRHZ3Cq.W3He', '0606789012', 'accepted', 48, 1, '2025-01-16 18:25:43', '2025-01-16 18:25:43'),
(49, 'Sami', 'El Moutaouakkil', 'sami.moutaouakkil@example.com', '$2y$10$GZZpglRHmRytGbNMbmbkaHRlgOlAsvq4jH.EyzEjzNuytkaVbZX0S.', '0607890123', 'accepted', 49, 1, '2025-01-16 18:25:43', '2025-01-16 18:25:43'),
(50, 'Fatima', 'Zahra', 'fatima.zahra@example.com', '$2y$10$kqerOls0zXZyFEyT91STU1Zt6fy7Lpn0yTzYglqDlMttc0Af7ZngcC', '0609876543', 'accepted', 50, 1, '2025-01-16 18:25:43', '2025-01-16 18:25:43'),
(51, 'oussama', 'ahorig', 'just_ouss@gmail.com', '$2y$10$Gm4/o8pUcFgrDSe8VMT2qOBNCSaRSBnPmPcV3rg7j2UyTXrUsUTjG', '0630587496', 'accepted', 51, 1, '2025-01-16 18:29:15', '2025-01-16 18:29:15');

--
-- Déclencheurs `comptes`
--
DELIMITER $$
CREATE TRIGGER `before_comptes_insert` BEFORE INSERT ON `comptes` FOR EACH ROW BEGIN
    -- Ensure user_id is set to the same value as compte_id on insert
    SET NEW.user_id = NEW.compte_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `exams`
--

CREATE TABLE `exams` (
  `exam_id` int(11) NOT NULL,
  `module` varchar(100) NOT NULL,
  `exam_date` date NOT NULL,
  `responsable_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `notes`
--

CREATE TABLE `notes` (
  `note_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `note` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_type` enum('etd','prof','admin') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`role_id`, `role_type`) VALUES
(3, 'admin'),
(2, 'prof'),
(1, 'etd');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `compte_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `password`, `email`, `compte_id`, `created_at`, `updated_at`) VALUES
(39, '$2y$10$.sl8jZ4M4yCUV68rlwrAk.C11s4VFhrbJUQtHeSpP3eq7wUXXSaia', 'pep@gmail.com', 39, '2025-01-11 19:14:05', '2025-01-11 19:14:05'),
(37, '$2y$10$c99fh3LGv.i.eQWXwpACju.9TG7Vl.Cj7rhA67Zaj94nJTZlvCUuu', 'simo@example.com', 37, '2025-01-11 18:47:24', '2025-01-11 18:47:24'),
(16, '$2y$10$czPmCSXnGmnjqMcc51J9leT4qiDmHKLgIsEjwnp27w46GjX5YYugW', 'hatim@gmail.com', 16, '2025-01-07 13:31:09', '2025-01-07 13:31:09'),
(38, '$2y$10$NNrjpWsZL0Cd7TpGR95dfu0e5bwTOeWHBqFaGJXjXBkwcsmLjaHMy', 'bale@gmail.com', 38, '2025-01-11 19:13:10', '2025-01-11 19:13:10'),
(26, '$2y$10$ljhE2alguYZtYSWWiEmtneWNqjhDPClGqNSMcIPrKijNoq8k.sq4i', 'saad@gmail.com', 26, '2025-01-07 14:27:44', '2025-01-07 14:27:44'),
(27, '$2y$10$WjhmmuJDjrB3WC39eTnIOOgOuQWKntQtQsLOc2RoIz3Fe98lp.XlW', 'hicham@example.com', 27, '2025-01-07 16:11:32', '2025-01-07 16:11:32'),
(28, '$2y$10$68U5p7MEIUwmO462EBlPVOiu6yRCdg1r2UpGcPfe2nOqDCSVmCtKO', 'liolio@gmail.com', 28, '2025-01-07 16:17:22', '2025-01-07 16:17:22'),
(29, '$2y$10$FnLhGjQ8ozpk5c4iFMBIsO3EnIeYjkA35PfgSxC1GfxqD5jQ73wBi', 'luis@gmail.com', 29, '2025-01-07 16:35:59', '2025-01-07 16:35:59'),
(40, '$2y$10$qOopF.CfaTYRPbxKOoRqy.UyJKinXHZtxEpJNqmq6n/vB4/4IAQji', 'youssef@gmail.com', 40, '2025-01-13 17:45:12', '2025-01-13 17:45:12'),
(35, '$2y$10$FXkqwvS0UD.FB58cSg7TBOkfNbEZ4rL8hhNz5h3eI9qoxb3JPpDcq', 'sergio@gmail.com', 35, '2025-01-09 07:45:39', '2025-01-09 07:45:39'),
(36, '$2y$10$0eQEp/t3krnrBsC0q5A9h.HfwiderKt7zmpXzgqnSFTyYqno4Q9le', 'karim@gmail.com', 36, '2025-01-09 08:30:31', '2025-01-09 08:30:31'),
(43, '$2y$10$uGh2Hk7ZRIv36MZRmFHZd0E2SOTztiTcN5A.MKnsh30M3ZnR1XZKi', 'mohamed.tazi@example.com', 43, '2025-01-15 23:00:00', '2025-01-15 23:00:00'),
(42, '$2y$10$xK8YCw1G1gxCrN27E2HTm.taGKINGC7pjKN/28UDBOV78eJ3CGZL2', 'john.doe@example.com', 42, '2025-01-14 15:52:07', '2025-01-14 15:52:07'),
(44, '$2y$10$1vQf5t.MnKoDtv8zphEqDk6sOwp9RBO3wnY5hFXuI72eMZXaYm7qa', 'amina.alaoui@example.com', 44, '2025-01-15 23:00:00', '2025-01-15 23:00:00'),
(45, '$2y$10$FXhRIaDF0VRv9OvmnTe3p7VwczkHptm0eFy5vD1u9FihLf9osw4Qu', 'youssef.oukacha@example.com', 45, '2025-01-15 23:00:00', '2025-01-15 23:00:00'),
(46, '$2y$10$5uMjZZkm7Z8FZHgUG1Wx6J8sqq6x13T1Amf.wE0YotWpkjeyb4cCm', 'imane.benjelloun@example.com', 46, '2025-01-15 23:00:00', '2025-01-15 23:00:00'),
(47, '$2y$10$BZH10hFzM5Yg9tpdI7Kp8yq.fADz5jxxK1gCk3NNN6py3ohubHoS6', 'rachid.fassi@example.com', 47, '2025-01-15 23:00:00', '2025-01-15 23:00:00'),
(48, '$2y$10$NKhXkXfOxKplzFsk9rXFSdOCN.KMcLg69bb0FZvwzTRHZ3Cq.W3He', 'karim.tariq@example.com', 48, '2025-01-16 18:25:43', '2025-01-16 18:25:43'),
(49, '$2y$10$GZZpglRHmRytGbNMbmbkaHRlgOlAsvq4jH.EyzEjzNuytkaVbZX0S.', 'sami.moutaouakkil@example.com', 49, '2025-01-16 18:25:43', '2025-01-16 18:25:43'),
(50, '$2y$10$kqerOls0zXZyFEyT91STU1Zt6fy7Lpn0yTzYglqDlMttc0Af7ZngcC', 'fatima.zahra@example.com', 50, '2025-01-16 18:25:43', '2025-01-16 18:25:43'),
(51, '$2y$10$Gm4/o8pUcFgrDSe8VMT2qOBNCSaRSBnPmPcV3rg7j2UyTXrUsUTjG', 'just_ouss@gmail.com', 51, '2025-01-16 17:29:15', '2025-01-16 17:29:15');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comptes`
--
ALTER TABLE `comptes`
  ADD PRIMARY KEY (`compte_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_comptes_users` (`user_id`),
  ADD KEY `fk_comptes_roles` (`role_id`);

--
-- Index pour la table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`exam_id`),
  ADD KEY `fk_exams_responsable` (`responsable_id`);

--
-- Index pour la table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`note_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `exam_id` (`exam_id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_comptes_user` (`compte_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comptes`
--
ALTER TABLE `comptes`
  MODIFY `compte_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT pour la table `exams`
--
ALTER TABLE `exams`
  MODIFY `exam_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `notes`
--
ALTER TABLE `notes`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
