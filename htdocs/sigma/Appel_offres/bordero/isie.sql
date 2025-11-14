-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Ven 29 Mars 2019 à 07:44
-- Version du serveur :  10.1.21-MariaDB
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `isie`
--

-- --------------------------------------------------------

--
-- Structure de la table `candidat`
--

CREATE TABLE `candidat` (
  `CINCANDIDAT` text COLLATE utf8_bin NOT NULL,
  `NOM_ELECTIONS` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `NOM_CANDIDAT` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `PRENOM_CANDIDAT` varchar(100) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `demande_org`
--

CREATE TABLE `demande_org` (
  `ID_ORG` int(11) NOT NULL,
  `NOM_ELECTIONS` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `CINP` varchar(8) COLLATE utf8_bin DEFAULT NULL,
  `NOM_ORGANISME` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `TYPE_ORGANISME` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `TYPE_DEMANDE` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `NOM_PP` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `NOM_TETE_LISTE` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `ADRESSE` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `TELEPHONE_ORG` varchar(66) COLLATE utf8_bin DEFAULT NULL,
  `EMAIL_ORG` longtext COLLATE utf8_bin,
  `LIEU_DEMANDE` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `NBRE_ELEMENT` varchar(66) COLLATE utf8_bin DEFAULT NULL,
  `etat_demande` varchar(56) COLLATE utf8_bin DEFAULT NULL,
  `NBRE_INTERPRETE` varchar(76) COLLATE utf8_bin DEFAULT NULL,
  `NOM__DEMANDEUR` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `PRENOM__DEMANDEUR` varchar(67) COLLATE utf8_bin DEFAULT NULL,
  `CIN_DEMANDEUR` int(11) DEFAULT NULL,
  `DATE_DEL_CIN_DEM` varchar(56) COLLATE utf8_bin DEFAULT NULL,
  `TYPE_DEMANDEUR` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `ADRESSE_DEMANDEUR` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `TE_DEMANDEUR` varchar(8) COLLATE utf8_bin DEFAULT NULL,
  `EMAIL_DEMANDEUR` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `NBRE_PAGE` varchar(67) COLLATE utf8_bin DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `demande_org`
--

INSERT INTO `demande_org` (`ID_ORG`, `NOM_ELECTIONS`, `CINP`, `NOM_ORGANISME`, `TYPE_ORGANISME`, `TYPE_DEMANDE`, `NOM_PP`, `NOM_TETE_LISTE`, `ADRESSE`, `TELEPHONE_ORG`, `EMAIL_ORG`, `LIEU_DEMANDE`, `NBRE_ELEMENT`, `etat_demande`, `NBRE_INTERPRETE`, `NOM__DEMANDEUR`, `PRENOM__DEMANDEUR`, `CIN_DEMANDEUR`, `DATE_DEL_CIN_DEM`, `TYPE_DEMANDEUR`, `ADRESSE_DEMANDEUR`, `TE_DEMANDEUR`, `EMAIL_DEMANDEUR`, `NBRE_PAGE`, `id`) VALUES
(9, 'إنتخابات التشريعية', NULL, 'sabri', 'حزبية', 'null', 'ممثلي ,', 'ter erer ysstst', 'souusee', 'null', 'null', 'الهيئة الفرعية قبلي', '23', NULL, '0', 'إستمارة', 'إعتماد ', 45525, '23-4-2011', 'ممثل القائمة', 'tunis', NULL, 'test@yahho.fr', '0', 1),
(10, 'إنتخابات التشريعية', NULL, 'المرشحة ', 'إئتلافية', '', ',ممثلي ', 'ter erer ysstst', 'souusee', 'null', 'null', 'الهيئة الفرعية قبلي', '23', NULL, '0', 'إستمارة', 'إعتماد ', 455257, '23-4-2011', 'رئيس القائمة', 'tunis', NULL, 'test@yahho.fr', '0', 2);

-- --------------------------------------------------------

--
-- Structure de la table `document_afournir`
--

CREATE TABLE `document_afournir` (
  `LOBELLE_PIECE` varchar(100) COLLATE utf8_bin NOT NULL,
  `NUMERO_PIECE` int(11) DEFAULT NULL,
  `ACTIF_JN` int(11) DEFAULT NULL,
  `ACTIF_JE` int(11) DEFAULT NULL,
  `ACTIF_ON` int(11) DEFAULT NULL,
  `ACTIF_OE` int(11) DEFAULT NULL,
  `ACTIF_RL` int(11) DEFAULT NULL,
  `ACTIF_RC` int(11) DEFAULT NULL,
  `ACTIF_HOTE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `electeur`
--

CREATE TABLE `electeur` (
  `CIN_ELECTEUR` text COLLATE utf8_bin NOT NULL,
  `NOM_ELECTEUR` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `PRENOM_ELECTEUR` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `elections`
--

CREATE TABLE `elections` (
  `id` int(11) NOT NULL,
  `NOM_ELECTIONS` varchar(100) COLLATE utf8_bin NOT NULL,
  `DATE_DEBUT` date DEFAULT NULL,
  `DATE_FIN` date DEFAULT NULL,
  `DATE_VOTE` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `elections`
--

INSERT INTO `elections` (`id`, `NOM_ELECTIONS`, `DATE_DEBUT`, `DATE_FIN`, `DATE_VOTE`) VALUES
(1, 'إنتخابات الرئاسية', '2019-03-10', '2019-01-13', '2019-04-16'),
(2, 'إنتخابات التشريعية', '2019-03-24', '2018-12-24', '2019-10-17'),
(3, 'Ø¥ÙØªØ®Ø§Ø¨Ø§Øª Ø§ÙØ±Ø¦Ø§Ø³ÙØ©', '2019-03-11', '2019-06-13', '2019-04-24');

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `id` int(11) NOT NULL,
  `NUM_CIN_PASSPORT` varchar(100) COLLATE utf8_bin NOT NULL,
  `ID_ORG` int(11) DEFAULT NULL,
  `NOM_MEMBRE` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `PRENOM_MEMBRE` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `TYPE_MEMBRE` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `NATIONALITE` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `DATE_DELIVRANCE_CIN` varchar(67) COLLATE utf8_bin DEFAULT NULL,
  `QUALITE` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `etat_membre` varchar(56) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `membre`
--

INSERT INTO `membre` (`id`, `NUM_CIN_PASSPORT`, `ID_ORG`, `NOM_MEMBRE`, `PRENOM_MEMBRE`, `TYPE_MEMBRE`, `NATIONALITE`, `DATE_DELIVRANCE_CIN`, `QUALITE`, `etat_membre`) VALUES
(1, 'null', 2, 'إنتخابات الرئاسية', 'null', 'null', 'null', 'null', 'ÙÙØ«Ù ÙØªØ±Ø´Ø­', '0'),
(7, '444444444', 10, 'sabri', 'sabri', 'ÙÙØ«Ù ÙØ§Ø¦ÙØ© ÙØªØ±Ø´Ø­Ø©', 'tunisienne', '12-3-2012', 'ÙØµÙØ±', '0'),
(8, '12345690', 19, 'tester', 'tester', 'ÙÙØ«Ù ÙØ§Ø¦ÙØ© ÙØªØ±Ø´Ø­Ø©', 'tunisienne', '12-3-2012', 'ÙØµÙØ±', '0'),
(9, '123456567', 9, 'sami', 'salah', 'ÙÙØ«Ù ÙØ§Ø¦ÙØ© ÙØªØ±Ø´Ø­Ø©', 'tunisienne', '12-3-2012', 'ÙØµÙØ±', '0'),
(10, '123456904', 9, 'testts', 'tststs', 'ÙÙØ«Ù ÙØ§Ø¦ÙØ© ÙØªØ±Ø´Ø­Ø©', 'tetettet', '12-3-2012', 'ÙØµÙØ±', '0'),
(11, '7777777', 9, 'ali', 'saber', 'ÙÙØ«Ù ÙØ§Ø¦ÙØ© ÙØªØ±Ø´Ø­Ø©', 'tunisienneggggggg', '12-3-2012', 'ÙØµÙØ±', '0');

-- --------------------------------------------------------

--
-- Structure de la table `personnel`
--

CREATE TABLE `personnel` (
  `id` int(11) NOT NULL,
  `CINP` varchar(8) COLLATE utf8_bin NOT NULL,
  `NOMP` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `PRENOMP` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `EMAIL_P` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `ETAT` longtext COLLATE utf8_bin,
  `DATE_DEL_CIN_P` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `TELEPHONE_P` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `LIEU_TRAVAIL` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `PASSWORD` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `ROLE` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `autorisation` varchar(56) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `personnel`
--

INSERT INTO `personnel` (`id`, `CINP`, `NOMP`, `PRENOMP`, `EMAIL_P`, `ETAT`, `DATE_DEL_CIN_P`, `TELEPHONE_P`, `LIEU_TRAVAIL`, `PASSWORD`, `ROLE`, `autorisation`) VALUES
(11, '1934567', 'إستمارة', 'إستمارة', 'ali@yahoo.fr', 'يشتغل', '2019-03-18', '12222222', 'الهيئة الفرعية قبلي', 'users', 'Agent saisie', 'oui'),
(12, '1234560', 'إستمارة', 'إستمارة', 'ali@yahoo.fr', 'يشتغل', '2019-03-12', '12222222', 'الهيئة الفرعية منوبة', 'admin', 'Admin centrale', 'null'),
(14, '99999', 'إستمارة', 'إستمارة', 'ali@yahoo.fr', 'يشتغل', '2019-02-26', '12222222', 'الهيئة المركزية', 'adm', 'Admin regionale', 'null');

-- --------------------------------------------------------

--
-- Structure de la table `perso_elections`
--

CREATE TABLE `perso_elections` (
  `NOM_ELECTIONS` varchar(100) COLLATE utf8_bin NOT NULL,
  `CINP` varchar(8) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `piece_fournit`
--

CREATE TABLE `piece_fournit` (
  `LIBELLE_PIECE` varchar(100) COLLATE utf8_bin NOT NULL,
  `NUM_CIN_PASSPORT` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `demande_org`
--
ALTER TABLE `demande_org`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `electeur`
--
ALTER TABLE `electeur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `elections`
--
ALTER TABLE `elections`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `personnel`
--
ALTER TABLE `personnel`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `demande_org`
--
ALTER TABLE `demande_org`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `electeur`
--
ALTER TABLE `electeur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `elections`
--
ALTER TABLE `elections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `personnel`
--
ALTER TABLE `personnel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
