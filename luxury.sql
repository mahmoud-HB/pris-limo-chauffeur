-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Sam 22 Novembre 2014 à 16:04
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `luxury`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(11) NOT NULL,
  `mdp` int(11) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `arrivee`
--

CREATE TABLE IF NOT EXISTS `arrivee` (
  `id_arriv` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(255) NOT NULL,
  PRIMARY KEY (`id_arriv`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `arrivee`
--

INSERT INTO `arrivee` (`id_arriv`, `designation`) VALUES
(1, 'Paris 75001'),
(2, 'Paris 75012');

-- --------------------------------------------------------

--
-- Structure de la table `cacultrajets`
--

CREATE TABLE IF NOT EXISTS `cacultrajets` (
  `idTrajet` int(11) NOT NULL AUTO_INCREMENT,
  `id_Departs` int(11) NOT NULL,
  `id_Arrivee` int(11) NOT NULL,
  `id_Prix` int(11) NOT NULL,
  `idVoiture` int(11) NOT NULL,
  `idOption` int(11) NOT NULL,
  PRIMARY KEY (`idTrajet`),
  KEY `id_Departs` (`id_Departs`),
  KEY `id_Arrivee` (`id_Arrivee`),
  KEY `id_Prix` (`id_Prix`),
  KEY `idVoiture` (`idVoiture`),
  KEY `idOption` (`idOption`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `cacultrajets`
--

INSERT INTO `cacultrajets` (`idTrajet`, `id_Departs`, `id_Arrivee`, `id_Prix`, `idVoiture`, `idOption`) VALUES
(1, 1, 1, 1, 1, 1),
(2, 1, 2, 2, 2, 1),
(3, 2, 1, 3, 3, 1),
(5, 3, 2, 3, 2, 1),
(6, 4, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `calcultrajetexcursion`
--

CREATE TABLE IF NOT EXISTS `calcultrajetexcursion` (
  `idTrajet` int(11) NOT NULL AUTO_INCREMENT,
  `idLieux` int(11) NOT NULL,
  `idVoiture` int(11) NOT NULL,
  `prix` double NOT NULL,
  PRIMARY KEY (`idTrajet`),
  KEY `idLieux` (`idLieux`,`idVoiture`),
  KEY `idLieux_2` (`idLieux`),
  KEY `idVoiture` (`idVoiture`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `calcultrajetexcursion`
--

INSERT INTO `calcultrajetexcursion` (`idTrajet`, `idLieux`, `idVoiture`, `prix`) VALUES
(1, 1, 1, 260),
(2, 1, 2, 320),
(3, 1, 3, 290),
(4, 2, 1, 240),
(5, 2, 2, 360),
(6, 2, 3, 310),
(7, 3, 1, 280),
(8, 3, 2, 350),
(9, 3, 3, 320),
(10, 4, 1, 950),
(11, 4, 2, 1350),
(12, 4, 3, 1100);

-- --------------------------------------------------------

--
-- Structure de la table `calcultrajetfix`
--

CREATE TABLE IF NOT EXISTS `calcultrajetfix` (
  `idPrix` int(11) NOT NULL AUTO_INCREMENT,
  `idDepart` int(11) NOT NULL,
  `idArrivee` int(11) NOT NULL,
  `idVoiture` int(11) NOT NULL,
  `prix` double NOT NULL,
  PRIMARY KEY (`idPrix`),
  KEY `idDepart` (`idDepart`,`idArrivee`,`idVoiture`),
  KEY `idDepart_2` (`idDepart`),
  KEY `idArrivee` (`idArrivee`),
  KEY `idVoiture` (`idVoiture`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Contenu de la table `calcultrajetfix`
--

INSERT INTO `calcultrajetfix` (`idPrix`, `idDepart`, `idArrivee`, `idVoiture`, `prix`) VALUES
(1, 1, 2, 1, 60),
(2, 1, 2, 2, 120),
(3, 1, 2, 3, 90),
(4, 1, 3, 1, 80),
(5, 1, 3, 2, 160),
(6, 1, 3, 3, 120),
(7, 1, 4, 1, 90),
(8, 1, 4, 2, 180),
(9, 1, 4, 3, 120),
(10, 2, 1, 1, 60),
(11, 2, 1, 2, 120),
(12, 2, 1, 3, 90),
(13, 3, 1, 1, 80),
(14, 3, 1, 2, 160),
(15, 3, 1, 3, 120),
(16, 4, 1, 1, 90),
(17, 4, 1, 2, 180),
(18, 4, 1, 3, 120),
(19, 1, 5, 1, 365),
(20, 5, 1, 1, 365),
(21, 1, 5, 2, 730),
(22, 5, 1, 2, 730),
(23, 1, 5, 3, 415),
(24, 5, 1, 3, 415),
(25, 1, 6, 1, 390),
(26, 6, 1, 1, 390),
(27, 1, 6, 2, 780),
(28, 6, 1, 2, 780),
(29, 1, 6, 3, 440),
(30, 6, 1, 3, 440),
(31, 1, 7, 1, 510),
(32, 7, 1, 1, 510),
(33, 1, 7, 2, 1020),
(34, 7, 1, 2, 1020),
(35, 1, 7, 3, 580),
(36, 7, 1, 3, 580),
(37, 1, 8, 1, 890),
(38, 8, 1, 1, 890),
(39, 1, 8, 2, 1780),
(40, 8, 1, 2, 1780),
(41, 1, 8, 3, 995),
(42, 8, 1, 3, 995),
(43, 1, 9, 1, 770),
(44, 9, 1, 1, 770),
(45, 1, 9, 2, 1540),
(46, 9, 1, 2, 1540),
(47, 1, 9, 3, 865),
(48, 9, 1, 3, 865),
(49, 1, 10, 1, 810),
(50, 10, 1, 1, 810),
(51, 1, 10, 2, 1620),
(52, 10, 1, 2, 1620),
(53, 1, 10, 3, 915),
(54, 10, 1, 3, 915);

-- --------------------------------------------------------

--
-- Structure de la table `calcultrajetslieuxfixe`
--

CREATE TABLE IF NOT EXISTS `calcultrajetslieuxfixe` (
  `idPrix` int(11) NOT NULL AUTO_INCREMENT,
  `idLieux` int(11) NOT NULL,
  `idVoiture` int(11) NOT NULL,
  `Prix` double NOT NULL,
  PRIMARY KEY (`idPrix`),
  KEY `idLieux` (`idLieux`,`idVoiture`),
  KEY `idLieux_2` (`idLieux`),
  KEY `idVoiture` (`idVoiture`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `calcultrajetslieuxfixe`
--

INSERT INTO `calcultrajetslieuxfixe` (`idPrix`, `idLieux`, `idVoiture`, `Prix`) VALUES
(1, 1, 1, 80),
(2, 1, 2, 160),
(3, 1, 3, 110),
(4, 2, 1, 90),
(5, 2, 2, 180),
(6, 2, 3, 150),
(7, 3, 1, 70),
(8, 3, 2, 140),
(9, 3, 3, 100),
(10, 4, 1, 90),
(11, 4, 2, 180),
(12, 4, 3, 160),
(13, 5, 1, 120),
(14, 5, 2, 240),
(15, 5, 3, 190);

-- --------------------------------------------------------

--
-- Structure de la table `codereduction`
--

CREATE TABLE IF NOT EXISTS `codereduction` (
  `idCode` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `valeur` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `validate` bit(1) NOT NULL,
  `nbrPersonnes` int(11) NOT NULL,
  `NbLimites` int(11) NOT NULL,
  PRIMARY KEY (`idCode`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `codereduction`
--

INSERT INTO `codereduction` (`idCode`, `code`, `valeur`, `type`, `validate`, `nbrPersonnes`, `NbLimites`) VALUES
(1, 'CODETEST', '5', '%', b'1', 0, 0),
(2, 'CODETEST2', '15', 'euros', b'1', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id_contact` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `tel` int(20) NOT NULL,
  `message` varchar(255) NOT NULL,
  PRIMARY KEY (`id_contact`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `contact`
--

INSERT INTO `contact` (`id_contact`, `nom`, `prenom`, `mail`, `tel`, `message`) VALUES
(1, 'sss', 'sss', 'sss', 0, 'sss@hss.fr'),
(2, 'sss', 'sss', '', 0, '');

-- --------------------------------------------------------

--
-- Structure de la table `departs`
--

CREATE TABLE IF NOT EXISTS `departs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `departs`
--

INSERT INTO `departs` (`id`, `designation`) VALUES
(1, 'CDG terminal 3'),
(2, 'CDG terminal 2'),
(3, 'Orly Ter 1'),
(4, 'Orly Ter 2');

-- --------------------------------------------------------

--
-- Structure de la table `devis`
--

CREATE TABLE IF NOT EXISTS `devis` (
  `id_devis` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `tel` int(20) NOT NULL,
  `add_dep` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `heure` int(50) NOT NULL,
  `add_arriv` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  PRIMARY KEY (`id_devis`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `excursion`
--

CREATE TABLE IF NOT EXISTS `excursion` (
  `idExcursion` int(11) NOT NULL AUTO_INCREMENT,
  `lieux` varchar(255) NOT NULL,
  PRIMARY KEY (`idExcursion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `excursion`
--

INSERT INTO `excursion` (`idExcursion`, `lieux`) VALUES
(1, 'Traversée de Paris (4 heures)'),
(2, 'Transfert vers Disneyland Paris (4 heures)'),
(3, 'Transfert vers le château de Versailles (4 heures)'),
(4, 'Transfert vers Mont-Saint-Michel (12 heures)');

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

CREATE TABLE IF NOT EXISTS `facture` (
  `id_facture` int(11) NOT NULL AUTO_INCREMENT,
  `id_reserv` int(11) NOT NULL,
  `id_prix` int(11) NOT NULL,
  `id_option` int(11) NOT NULL,
  `id_from` int(11) NOT NULL,
  `id_to` int(11) NOT NULL,
  PRIMARY KEY (`id_facture`),
  KEY `id_reserv` (`id_reserv`,`id_prix`),
  KEY `id_reserv_2` (`id_reserv`),
  KEY `id_reserv_3` (`id_reserv`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `fixed_addresse`
--

CREATE TABLE IF NOT EXISTS `fixed_addresse` (
  `id_addresse` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(255) NOT NULL,
  PRIMARY KEY (`id_addresse`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `fixed_addresse`
--

INSERT INTO `fixed_addresse` (`id_addresse`, `designation`) VALUES
(1, 'Paris'),
(2, 'Paris, gares parisiennes'),
(3, 'Aéroport Orly\r\n'),
(4, 'Aéroport Roissy CDG'),
(5, 'Deauville'),
(6, 'Lille'),
(7, 'Bruxelles'),
(8, 'Genève'),
(9, 'Lyon'),
(10, 'Strasbourg');

-- --------------------------------------------------------

--
-- Structure de la table `lieuxfixe`
--

CREATE TABLE IF NOT EXISTS `lieuxfixe` (
  `idLieux` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(255) NOT NULL,
  PRIMARY KEY (`idLieux`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `lieuxfixe`
--

INSERT INTO `lieuxfixe` (`idLieux`, `designation`) VALUES
(1, 'Paris (75)'),
(2, 'Hauts-de-Seine (92)'),
(3, 'Seine-Saint-Denis (93)'),
(4, 'Val-de-Marne (94)'),
(5, 'Val-d''Oise (95)');

-- --------------------------------------------------------

--
-- Structure de la table `minute`
--

CREATE TABLE IF NOT EXISTS `minute` (
  `id_min` int(11) NOT NULL AUTO_INCREMENT,
  `val` varchar(20) NOT NULL,
  `sup_logic` int(1) NOT NULL,
  PRIMARY KEY (`id_min`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `minute`
--

INSERT INTO `minute` (`id_min`, `val`, `sup_logic`) VALUES
(1, '00', 0),
(2, '05', 0),
(3, '10', 0),
(4, '15', 0),
(5, '20', 0),
(6, '25', 0),
(7, '30', 0),
(8, '35', 0),
(9, '40', 0),
(10, '45', 0),
(11, '50', 0),
(12, '55', 0);

-- --------------------------------------------------------

--
-- Structure de la table `nb_pass`
--

CREATE TABLE IF NOT EXISTS `nb_pass` (
  `id_pass` int(11) NOT NULL AUTO_INCREMENT,
  `designation` int(10) NOT NULL,
  PRIMARY KEY (`id_pass`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `nb_pass`
--

INSERT INTO `nb_pass` (`id_pass`, `designation`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4);

-- --------------------------------------------------------

--
-- Structure de la table `options`
--

CREATE TABLE IF NOT EXISTS `options` (
  `id_option` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(255) NOT NULL,
  PRIMARY KEY (`id_option`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `options`
--

INSERT INTO `options` (`id_option`, `designation`) VALUES
(1, 'Siège bébé');

-- --------------------------------------------------------

--
-- Structure de la table `parameters`
--

CREATE TABLE IF NOT EXISTS `parameters` (
  `id_param` int(11) NOT NULL AUTO_INCREMENT,
  `param` varchar(255) NOT NULL,
  `valeur` varchar(255) NOT NULL,
  PRIMARY KEY (`id_param`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `parameters`
--

INSERT INTO `parameters` (`id_param`, `param`, `valeur`) VALUES
(1, 'prix_km', '1.8'),
(2, 'jours_ferier', '15'),
(3, 'heure_max', '20'),
(4, 'heure_min', '8'),
(5, 'aug_heure', '15'),
(6, 'prix_depart', '50'),
(7, 'prix_fixe_mariage', '240'),
(8, 'prix_heure', '60');

-- --------------------------------------------------------

--
-- Structure de la table `parametersmiseadispo`
--

CREATE TABLE IF NOT EXISTS `parametersmiseadispo` (
  `idParam` int(11) NOT NULL AUTO_INCREMENT,
  `idVoiture` int(11) NOT NULL,
  `prixHeure` double NOT NULL,
  PRIMARY KEY (`idParam`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `parametersmiseadispo`
--

INSERT INTO `parametersmiseadispo` (`idParam`, `idVoiture`, `prixHeure`) VALUES
(1, 1, 60),
(2, 2, 90),
(3, 3, 70);

-- --------------------------------------------------------

--
-- Structure de la table `prix`
--

CREATE TABLE IF NOT EXISTS `prix` (
  `id_prix` int(11) NOT NULL AUTO_INCREMENT,
  `designation` int(20) NOT NULL,
  PRIMARY KEY (`id_prix`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `prix`
--

INSERT INTO `prix` (`id_prix`, `designation`) VALUES
(1, 60),
(2, 80),
(3, 100),
(4, 120);

-- --------------------------------------------------------

--
-- Structure de la table `rappel_moi`
--

CREATE TABLE IF NOT EXISTS `rappel_moi` (
  `id_tel` int(11) NOT NULL AUTO_INCREMENT,
  `num_tel` int(20) NOT NULL,
  PRIMARY KEY (`id_tel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
  `id_res` int(11) NOT NULL AUTO_INCREMENT,
  `id_pers` int(11) NOT NULL,
  `id_pass` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `code_postale` int(11) NOT NULL,
  `societe` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `tel` int(20) NOT NULL,
  PRIMARY KEY (`id_res`),
  KEY `id_pers` (`id_pers`,`id_pass`),
  KEY `id_pass` (`id_pass`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Contenu de la table `reservation`
--

INSERT INTO `reservation` (`id_res`, `id_pers`, `id_pass`, `nom`, `prenom`, `adresse`, `ville`, `code_postale`, `societe`, `mail`, `tel`) VALUES
(7, 1, 1, 'KHAROUF', 'Maher', '143 boulevard', 'Paris', 75019, 'test@test.com', 'test@test.com', 123456789),
(8, 1, 1, 'KHAROUF', 'Maher', '143 boulevard', 'Paris', 75019, 'test@test.com', 'test@test.com', 123),
(9, 1, 1, 'KHAROUF', 'Maher', '143 boulevard', 'Paris', 75019, 'test@test.com', 'test@test.com', 123),
(10, 1, 1, 'KHAROUF', 'Maher', '143 boulevard', 'Paris', 75019, 'test@test.com', 'test@test.com', 213654789),
(11, 1, 1, 'KHAROUF', 'Maher', '143 boulevard', 'Paris', 75019, 'test@test.com', 'test@test.com', 1230),
(12, 1, 1, 'KHAROUF', 'Maher', '143 boulevard', 'Paris', 75019, 'test@test.com', 'test@test.com', 1230),
(13, 1, 2, 'jbb,n', 'gvhb', 'hj', 'hj', 0, 'uhj', 'uhj', 0);

-- --------------------------------------------------------

--
-- Structure de la table `tarifhoraire`
--

CREATE TABLE IF NOT EXISTS `tarifhoraire` (
  `idHor` int(11) NOT NULL AUTO_INCREMENT,
  `nbHor` int(11) NOT NULL,
  `prix` double NOT NULL,
  `validate` bit(1) NOT NULL,
  PRIMARY KEY (`idHor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `tarifhoraire`
--

INSERT INTO `tarifhoraire` (`idHor`, `nbHor`, `prix`, `validate`) VALUES
(1, 4, 280, b'1'),
(2, 5, 350, b'1'),
(3, 6, 420, b'1'),
(4, 7, 490, b'1'),
(5, 8, 560, b'1');

-- --------------------------------------------------------

--
-- Structure de la table `time`
--

CREATE TABLE IF NOT EXISTS `time` (
  `id_time` int(11) NOT NULL AUTO_INCREMENT,
  `val_fr` varchar(10) NOT NULL,
  `val_en` varchar(20) NOT NULL,
  `supp_logic` int(1) NOT NULL,
  PRIMARY KEY (`id_time`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Contenu de la table `time`
--

INSERT INTO `time` (`id_time`, `val_fr`, `val_en`, `supp_logic`) VALUES
(1, '00', '12pm', 0),
(2, '01', '1am', 0),
(3, '02', '2am', 0),
(4, '03', '3am', 0),
(5, '04', '4am', 0),
(6, '05', '5am', 0),
(7, '06', '6am', 0),
(8, '07', '7am', 0),
(9, '08', '8am', 0),
(10, '09', '9am', 0),
(11, '10', '10am', 0),
(12, '11', '11am', 0),
(13, '12', '12am', 0),
(14, '13', '1pm', 0),
(15, '14', '2pm', 0),
(16, '15', '3pm', 0),
(17, '16', '4pm', 0),
(18, '17', '5pm', 0),
(19, '18', '6pm', 0),
(20, '19', '7pm', 0),
(21, '20', '8pm', 0),
(22, '21', '9pm', 0),
(23, '22', '10pm', 0),
(24, '23', '11pm', 0);

-- --------------------------------------------------------

--
-- Structure de la table `type_perso`
--

CREATE TABLE IF NOT EXISTS `type_perso` (
  `id_perso` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(255) NOT NULL,
  PRIMARY KEY (`id_perso`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `type_perso`
--

INSERT INTO `type_perso` (`id_perso`, `designation`) VALUES
(1, 'M.'),
(2, 'Mme.');

-- --------------------------------------------------------

--
-- Structure de la table `voitures`
--

CREATE TABLE IF NOT EXISTS `voitures` (
  `id_voiture` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(255) NOT NULL,
  `selected` bit(1) NOT NULL,
  PRIMARY KEY (`id_voiture`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `voitures`
--

INSERT INTO `voitures` (`id_voiture`, `designation`, `selected`) VALUES
(1, 'Classe E', b'0'),
(2, 'Classe S', b'1'),
(3, 'Vianno', b'0');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `cacultrajets`
--
ALTER TABLE `cacultrajets`
  ADD CONSTRAINT `cacultrajets_ibfk_1` FOREIGN KEY (`id_Departs`) REFERENCES `departs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `cacultrajets_ibfk_2` FOREIGN KEY (`id_Arrivee`) REFERENCES `arrivee` (`id_arriv`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `cacultrajets_ibfk_3` FOREIGN KEY (`id_Prix`) REFERENCES `prix` (`id_prix`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `cacultrajets_ibfk_4` FOREIGN KEY (`idVoiture`) REFERENCES `voitures` (`id_voiture`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `cacultrajets_ibfk_5` FOREIGN KEY (`idOption`) REFERENCES `options` (`id_option`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `calcultrajetexcursion`
--
ALTER TABLE `calcultrajetexcursion`
  ADD CONSTRAINT `calcultrajetexcursion_ibfk_2` FOREIGN KEY (`idVoiture`) REFERENCES `voitures` (`id_voiture`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `calcultrajetexcursion_ibfk_1` FOREIGN KEY (`idLieux`) REFERENCES `excursion` (`idExcursion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `calcultrajetfix`
--
ALTER TABLE `calcultrajetfix`
  ADD CONSTRAINT `calcultrajetfix_ibfk_1` FOREIGN KEY (`idDepart`) REFERENCES `fixed_addresse` (`id_addresse`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `calcultrajetfix_ibfk_2` FOREIGN KEY (`idArrivee`) REFERENCES `fixed_addresse` (`id_addresse`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `calcultrajetfix_ibfk_3` FOREIGN KEY (`idVoiture`) REFERENCES `voitures` (`id_voiture`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `calcultrajetslieuxfixe`
--
ALTER TABLE `calcultrajetslieuxfixe`
  ADD CONSTRAINT `calcultrajetslieuxfixe_ibfk_1` FOREIGN KEY (`idLieux`) REFERENCES `lieuxfixe` (`idLieux`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `calcultrajetslieuxfixe_ibfk_2` FOREIGN KEY (`idVoiture`) REFERENCES `voitures` (`id_voiture`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `facture`
--
ALTER TABLE `facture`
  ADD CONSTRAINT `facture_ibfk_1` FOREIGN KEY (`id_reserv`) REFERENCES `reservation` (`id_res`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`id_pers`) REFERENCES `type_perso` (`id_perso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`id_pass`) REFERENCES `nb_pass` (`id_pass`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
