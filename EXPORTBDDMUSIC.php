-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Mer 14 Juin 2017 à 20:04
-- Version du serveur :  5.6.28
-- Version de PHP :  7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `zebrolfrertest`
--

-- --------------------------------------------------------

--
-- Structure de la table `MUSIC`
--

CREATE TABLE `MUSIC` (
  `music_id` int(11) NOT NULL,
  `music_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `subtype_type` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtype_name` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `author_comment` text COLLATE utf8_unicode_ci,
  `lyrics` text COLLATE utf8_unicode_ci,
  `music_image` text COLLATE utf8_unicode_ci,
  `note_music` int(11) DEFAULT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `dateupload` date DEFAULT NULL,
  `upload_music` text COLLATE utf8_unicode_ci,
  `visibility` tinyint(1) NOT NULL DEFAULT '1',
  `upload_date` date DEFAULT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `MUSIC`
--

INSERT INTO `MUSIC` (`music_id`, `music_name`, `subtype_type`, `subtype_name`, `author_comment`, `lyrics`, `music_image`, `note_music`, `isDeleted`, `dateupload`, `upload_music`, `visibility`, `upload_date`, `email`) VALUES
(9, 'SALUT', NULL, NULL, '', 'C\'est des--fez^p oferopf,erpozak,s km,am , )))', '1', NULL, 0, '2017-06-04', './musics/antoine@a.a/SALUT.mp3', 1, NULL, 'antoine@a.a'),
(10, 'Antreoj', NULL, NULL, '', '', './music_images/5934114a83e40.jpg', NULL, 0, '2017-06-04', './musics/antoine@a.a/Antreoj.mp3', 1, NULL, 'antoine@a.a'),
(11, 'Derniertest', 'roc', 'Array', 'commentaire', 'lyrics', './music_images/59341a0a90ad2.jpg', NULL, 0, '2017-06-04', './musics/antoine@a.a/Derniertest.mp3', 1, NULL, 'antoine@a.a'),
(12, 'eazeaz', 'roc', 'Array', '', '', NULL, NULL, 0, '2017-06-04', './musics/antoine@a.a/eazeaz.mp3', 1, NULL, 'antoine@a.a'),
(13, 'rezrez', 'roc', 'Array', '', '', NULL, NULL, 0, '2017-06-04', './musics/Confirmation@a.a/rezrez.mp3', 1, NULL, 'Confirmation@a.a'),
(14, 'rezrezrez', 'roc', 'Array', '', '', NULL, NULL, 0, '2017-06-04', './musics/Confirmation@a.a/rezrezrez.mp3', 1, NULL, 'Confirmation@a.a'),
(15, 'ezaezaeaz', 'chafr', 'rock2', '', '', NULL, NULL, 0, '2017-06-10', './musics/Confirmation@a.a/ezaezaeaz.mp3', 1, NULL, 'Confirmation@a.a'),
(16, 'AntoineSamedi', 'blu', 'rock4', '', '', NULL, NULL, 0, '2017-06-10', './musics/Confirmation@a.a/AntoineSamedi.mp3', 1, NULL, 'Confirmation@a.a'),
(17, 'dzadzadzadzadzad', 'rap', 'rock2', '', '', NULL, NULL, 0, '2017-06-10', './musics/Confirmation@a.a/dzadzadzadzadzad.mp3', 1, NULL, 'Confirmation@a.a'),
(18, 'efùlùflezfez', 'dis', 'rock2', '', '', NULL, NULL, 0, '2017-06-10', './musics/Confirmation@a.a/efùlùflezfez.mp3', 1, NULL, 'Confirmation@a.a'),
(19, 'dzdzadzadzadzadzadzadzad', 'blu', 'rock2', '', '', NULL, NULL, 0, '2017-06-10', './musics/Confirmation@a.a/dzdzadzadzadzadzadzadzad.mp3', 1, NULL, 'Confirmation@a.a'),
(20, 'dzladkzjandpk', 'blu', 'rock2', '', '', NULL, NULL, 0, '2017-06-10', './musics/Confirmation@a.a/dzladkzjandpk.mp3', 1, NULL, 'Confirmation@a.a'),
(21, 'dlazdzadpkzamd', 'blu', 'rock2', '', '', NULL, NULL, 0, '2017-06-10', './musics/Confirmation@a.a/dlazdzadpkzamd.mp3', 1, NULL, 'Confirmation@a.a'),
(22, 'dùzaldùlazùd', 'chafr', 'rock2', '', '', NULL, NULL, 0, '2017-06-10', './musics/Confirmation@a.a/dùzaldùlazùd.mp3', 1, NULL, 'Confirmation@a.a'),
(23, 'dzaldùza', 'rap', 'rock2', '', '', NULL, NULL, 0, '2017-06-10', './musics/Confirmation@a.a/dzaldùza.mp3', 1, NULL, 'Confirmation@a.a');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `MUSIC`
--
ALTER TABLE `MUSIC`
  ADD PRIMARY KEY (`music_id`),
  ADD KEY `FK_MUSIC_email` (`email`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `MUSIC`
--
ALTER TABLE `MUSIC`
  MODIFY `music_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `MUSIC`
--
ALTER TABLE `MUSIC`
  ADD CONSTRAINT `FK_MUSIC_email` FOREIGN KEY (`email`) REFERENCES `USERS` (`email`);
