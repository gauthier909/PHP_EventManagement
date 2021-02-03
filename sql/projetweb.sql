-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 15 Mai 2018 à 12:09
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projetweb`
--

-- --------------------------------------------------------

--
-- Structure de la table `details_plan`
--

CREATE TABLE `details_plan` (
  `num_detail` int(11) NOT NULL,
  `date_training` date NOT NULL,
  `day_program` varchar(256) NOT NULL,
  `num_plan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `details_plan`
--

INSERT INTO `details_plan` (`num_detail`, `date_training`, `day_program`, `num_plan`) VALUES
(1, '2018-05-09', 'Jambon', 1);

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

CREATE TABLE `events` (
  `num_event` int(11) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `location` varchar(500) NOT NULL,
  `cost` double NOT NULL,
  `url` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `events`
--

INSERT INTO `events` (`num_event`, `date_start`, `date_end`, `title`, `description`, `location`, `cost`, `url`) VALUES
(2, '2018-04-01', '2018-04-27', 'Semaine du jambon', 'Tous les jours, un marché vend toutes sortes de jambon', 'Rue Charles Maigret 87, 1090 Jette', 15, 'www.marchedusaucisson.be'),
(3, '1996-04-01', '2010-03-02', 'Jogging', '3km', 'parc woluwe', 5, ''),
(4, '1996-04-01', '2010-03-02', 'Course inter-clubs', 'Divison 3', 'Alma', 5, ''),
(6, '2018-04-04', '2018-04-06', 'Cardio', '30 min cardio', 'fitness club', 15, ''),
(7, '2018-04-12', '2018-04-18', 'Tir à l\'arc', 'Initiation au tir à l\'arc', 'Stockel', 4, ''),
(8, '2018-04-12', '2018-04-18', 'Natation', 'Concours de natation', 'Woluwe Saint Pierre', 4, ''),
(9, '2018-04-12', '2018-03-30', 'Marathon', '20km', 'Bruxelles', 5, ''),
(16, '2018-05-10', '2018-05-11', 'Course Relais', 'course relais 200m', 'parc royale', 2, 'www.drive.com'),
(18, '2018-05-18', '2018-05-18', 'Fitness', '<p><i>fitness salle de sport</i></p>', 'salle', 5, 'facebook');

-- --------------------------------------------------------

--
-- Structure de la table `follow`
--

CREATE TABLE `follow` (
  `num_follow` int(11) NOT NULL,
  `num_plan` int(11) NOT NULL,
  `no_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `follow`
--

INSERT INTO `follow` (`num_follow`, `num_plan`, `no_user`) VALUES
(1, 1, 23);

-- --------------------------------------------------------

--
-- Structure de la table `interests`
--

CREATE TABLE `interests` (
  `num_interest` int(11) NOT NULL,
  `num_event` int(11) NOT NULL,
  `no_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `interests`
--

INSERT INTO `interests` (`num_interest`, `num_event`, `no_user`) VALUES
(9, 2, 23),
(4, 2, 42),
(7, 3, 23),
(3, 3, 45),
(2, 3, 49),
(5, 4, 23),
(11, 6, 23),
(10, 6, 42),
(1, 8, 49);

-- --------------------------------------------------------

--
-- Structure de la table `markers`
--

CREATE TABLE `markers` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `address` varchar(80) NOT NULL,
  `lat` decimal(10,6) NOT NULL,
  `lng` decimal(10,6) NOT NULL,
  `type` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `markers`
--

INSERT INTO `markers` (`id`, `name`, `address`, `lat`, `lng`, `type`) VALUES
(1, 'Institut Paul Lambin', 'Clos Chapelle-aux-champs, 43 à 1200 Bruxelles', '50.849696', '4.451145', 'école'),
(2, 'Centre sportif Mounier', 'Avenue E. Mounier 87 1200 Bruxelles', '50.850368', '4.458414', 'Centre sportif');

-- --------------------------------------------------------

--
-- Structure de la table `membership_fees`
--

CREATE TABLE `membership_fees` (
  `annee_mf` int(11) NOT NULL,
  `cost_mf` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `membership_fees`
--

INSERT INTO `membership_fees` (`annee_mf`, `cost_mf`) VALUES
(2013, 7),
(2017, 5),
(2018, 15);

-- --------------------------------------------------------

--
-- Structure de la table `payements`
--

CREATE TABLE `payements` (
  `no_user` int(11) NOT NULL,
  `annee_mf` int(11) NOT NULL,
  `amount` double NOT NULL,
  `has_payed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `payements`
--

INSERT INTO `payements` (`no_user`, `annee_mf`, `amount`, `has_payed`) VALUES
(23, 2017, 3, 0),
(23, 2018, 15, 1),
(28, 2013, 1, 0),
(28, 2017, 2, 0),
(42, 2013, 2, 0),
(42, 2017, 5, 1),
(42, 2018, 15, 1),
(43, 2013, 3, 0),
(43, 2017, 5, 1),
(44, 2017, 5, 1),
(44, 2018, 15, 1),
(45, 2017, 5, 1),
(45, 2018, 7, 0),
(46, 2013, 7, 1),
(46, 2017, 5, 1),
(48, 2013, 7, 1),
(48, 2017, 5, 1),
(50, 2017, 4, 0);

-- --------------------------------------------------------

--
-- Structure de la table `plans`
--

CREATE TABLE `plans` (
  `num_plan` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `file_plan` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `plans`
--

INSERT INTO `plans` (`num_plan`, `name`, `file_plan`) VALUES
(1, 'Plan de base', 'base.csv');

-- --------------------------------------------------------

--
-- Structure de la table `registered`
--

CREATE TABLE `registered` (
  `num_registered` int(11) NOT NULL,
  `num_event` int(11) NOT NULL,
  `no_user` int(11) NOT NULL,
  `has_payed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `registered`
--

INSERT INTO `registered` (`num_registered`, `num_event`, `no_user`, `has_payed`) VALUES
(1, 9, 28, 1),
(3, 2, 28, 1),
(4, 8, 42, 1),
(5, 16, 42, 1),
(6, 8, 48, 1),
(7, 8, 44, 1),
(8, 7, 49, 1),
(9, 3, 48, 1),
(10, 18, 50, 1),
(11, 19, 51, 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `no_user` int(11) NOT NULL,
  `first_name` varchar(256) NOT NULL,
  `last_name` varchar(256) NOT NULL,
  `num_phone` varchar(11) NOT NULL,
  `e_mail` varchar(256) NOT NULL,
  `address` varchar(256) NOT NULL,
  `num_account` varchar(256) NOT NULL,
  `photo` varchar(256) DEFAULT NULL,
  `password` varchar(256) NOT NULL,
  `coach` tinyint(1) NOT NULL,
  `staff` tinyint(1) NOT NULL,
  `checked` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`no_user`, `first_name`, `last_name`, `num_phone`, `e_mail`, `address`, `num_account`, `photo`, `password`, `coach`, `staff`, `checked`) VALUES
(23, 'root', 'root', 'root', 'root', 'root', 'root', NULL, '$2y$10$DhBVmzT3CSPumfX6GIy/f.d0j6e0QQLXztKUatNIXGznFHDoNvob2', 0, 1, 1),
(28, 'Charles', 'Duffour', '047864464', 'charles@hotmail.com', 'avenue 2', 'Be87465464846', NULL, '$2y$10$Bt3bRchp7EIfq/HwfysjUuO2VE9AJntNec8ThHW6SO/oCjaEGr59G', 0, 1, 1),
(42, 'Philipe', 'Fuot', '3554+156', 'phi@mail.com', 'rue ipl', '3554', 'views/images/1526216418_7395téléchargement.jpg', '$2y$10$SsHctRbreI3my3HCQoSCLe1Di9wr.kw.QZoY0RQjdR5q9awa9xtPq', 1, 0, 1),
(43, 'William', 'Delbrume', '0448786465', 'will@gmail.com', 'rue ipl', 'BE546844654', NULL, '$2y$10$VnBnz66lgvbN.Ko.gyJxr.obfoIN1u8fEVyfR9cnc0AEnsO7qwBFK', 0, 0, 1),
(44, 'Denis', 'Lioret', '04285664', 'denis@hotmail.com', 'rue ipl', 'Be8484848464', NULL, '$2y$10$.jfAFGi4bgS9IE0o4535keHrNLDKml8jDCWIOi5l/qBWQ97czYAYy', 0, 0, 1),
(45, 'Bernard', 'Brusset', '055444894', 'bru2@gmail.com', 'rue ipl', '04154844848', NULL, '$2y$10$vSCQQfSZSMLgT2f3ewoL9e28VA9WZsCwyECfIyQUv4ld6VkPrYH8i', 0, 0, 1),
(46, 'Joahnna', 'Trello', '04756545', 'jo@hotmail.com', 'rue ipl', 'BE51564646', NULL, '$2y$10$QEejEZsHEZ70tHyS/4yf4u/Fbhn4kBScMNrFCDaIz5e2ugzt4nk4S', 0, 0, 1),
(48, 'RF', 'Gauth', '56', 'gauthier.rogerfrance@student.vinci.be', '4654', '54', NULL, '$2y$10$dH6URExvIdvq7YZD3G07POcd/C.7ALqgiEdj600YIxjYhzZsNvtta', 0, 1, 1),
(49, 'Rual', 'Jacques', '04178524663', 'jacquerual@hotmail.be', '1050', 'BE48759-6412-78', NULL, '$2y$10$kunB7uomY9/NIYFZg12KZ.KwBMPbTr79APtqa21bqJPbgvYn/4SGy', 0, 1, 1),
(50, 'Noémie', 'Pilard', '0417863', 'no78@hotmail.com', 'rue ipl', 'Be48486464', NULL, '$2y$10$zD7n4DhLiUh5ZuXiY4t5kO2d7ACbcctI5ZPjN3OiGJ.q0GRg/vXBi', 0, 1, 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `details_plan`
--
ALTER TABLE `details_plan`
  ADD PRIMARY KEY (`num_detail`),
  ADD KEY `no_plan` (`num_plan`) USING BTREE;

--
-- Index pour la table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`num_event`) USING BTREE;

--
-- Index pour la table `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`num_follow`),
  ADD KEY `no_user` (`no_user`),
  ADD KEY `no_plan` (`num_plan`) USING BTREE;

--
-- Index pour la table `interests`
--
ALTER TABLE `interests`
  ADD PRIMARY KEY (`num_interest`),
  ADD KEY `num_event` (`num_event`,`no_user`),
  ADD KEY `num_event_2` (`num_event`),
  ADD KEY `no_user` (`no_user`);

--
-- Index pour la table `markers`
--
ALTER TABLE `markers`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `membership_fees`
--
ALTER TABLE `membership_fees`
  ADD PRIMARY KEY (`annee_mf`);

--
-- Index pour la table `payements`
--
ALTER TABLE `payements`
  ADD PRIMARY KEY (`no_user`,`annee_mf`),
  ADD KEY `no_user` (`no_user`),
  ADD KEY `num_mf` (`annee_mf`);

--
-- Index pour la table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`num_plan`);

--
-- Index pour la table `registered`
--
ALTER TABLE `registered`
  ADD PRIMARY KEY (`num_registered`),
  ADD KEY `num_event` (`num_event`),
  ADD KEY `user` (`no_user`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`no_user`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `details_plan`
--
ALTER TABLE `details_plan`
  MODIFY `num_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `events`
--
ALTER TABLE `events`
  MODIFY `num_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT pour la table `follow`
--
ALTER TABLE `follow`
  MODIFY `num_follow` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `interests`
--
ALTER TABLE `interests`
  MODIFY `num_interest` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `markers`
--
ALTER TABLE `markers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `membership_fees`
--
ALTER TABLE `membership_fees`
  MODIFY `annee_mf` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2035;
--
-- AUTO_INCREMENT pour la table `plans`
--
ALTER TABLE `plans`
  MODIFY `num_plan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `registered`
--
ALTER TABLE `registered`
  MODIFY `num_registered` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `no_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `details_plan`
--
ALTER TABLE `details_plan`
  ADD CONSTRAINT `details_plan_ibfk_1` FOREIGN KEY (`num_plan`) REFERENCES `plans` (`num_plan`);

--
-- Contraintes pour la table `follow`
--
ALTER TABLE `follow`
  ADD CONSTRAINT `follow_ibfk_1` FOREIGN KEY (`num_plan`) REFERENCES `plans` (`num_plan`),
  ADD CONSTRAINT `follow_ibfk_2` FOREIGN KEY (`no_user`) REFERENCES `users` (`no_user`);

--
-- Contraintes pour la table `interests`
--
ALTER TABLE `interests`
  ADD CONSTRAINT `interests_ibfk_1` FOREIGN KEY (`num_event`) REFERENCES `events` (`num_event`),
  ADD CONSTRAINT `interests_ibfk_2` FOREIGN KEY (`no_user`) REFERENCES `users` (`no_user`);

--
-- Contraintes pour la table `payements`
--
ALTER TABLE `payements`
  ADD CONSTRAINT `payements_ibfk_1` FOREIGN KEY (`annee_mf`) REFERENCES `membership_fees` (`annee_mf`),
  ADD CONSTRAINT `payements_ibfk_2` FOREIGN KEY (`no_user`) REFERENCES `users` (`no_user`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
