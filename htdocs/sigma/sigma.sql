-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 09 juin 2023 à 11:44
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sigma`
--

-- --------------------------------------------------------

--
-- Structure de la table `arrives`
--

CREATE TABLE `arrives` (
  `id` int(11) NOT NULL,
  `date` varchar(45) DEFAULT NULL,
  `affaire` varchar(45) DEFAULT NULL,
  `emis_par` varchar(56) DEFAULT NULL,
  `lot` varchar(45) DEFAULT NULL,
  `phse` varchar(67) DEFAULT NULL,
  `miss` varchar(56) DEFAULT NULL,
  `code` varchar(56) DEFAULT NULL,
  `code_sousprojet` varchar(67) DEFAULT NULL,
  `mdo` varchar(56) DEFAULT NULL,
  `projet` text DEFAULT NULL,
  `architecte` varchar(56) DEFAULT NULL,
  `typeuser` varchar(67) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `bordero`
--

CREATE TABLE `bordero` (
  `id` int(11) NOT NULL,
  `mdo` varchar(255) NOT NULL,
  `code_op` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `article1` varchar(255) DEFAULT NULL,
  `prix1` varchar(255) DEFAULT NULL,
  `article2` varchar(255) DEFAULT NULL,
  `prix2` varchar(255) DEFAULT NULL,
  `article3` varchar(255) DEFAULT NULL,
  `prix3` varchar(255) DEFAULT NULL,
  `article4` varchar(255) DEFAULT NULL,
  `prix4` varchar(255) DEFAULT NULL,
  `article5` varchar(255) DEFAULT NULL,
  `prix5` varchar(255) DEFAULT NULL,
  `article6` varchar(255) DEFAULT NULL,
  `prix6` varchar(255) DEFAULT NULL,
  `article7` varchar(255) DEFAULT NULL,
  `prix7` varchar(255) DEFAULT NULL,
  `article8` varchar(255) DEFAULT NULL,
  `prix8` varchar(255) DEFAULT NULL,
  `article9` varchar(255) DEFAULT NULL,
  `prix9` varchar(255) DEFAULT NULL,
  `article10` varchar(255) DEFAULT NULL,
  `prix10` varchar(255) DEFAULT NULL,
  `article11` varchar(255) DEFAULT NULL,
  `prix11` varchar(255) DEFAULT NULL,
  `article12` varchar(255) DEFAULT NULL,
  `prix12` varchar(255) DEFAULT NULL,
  `article13` varchar(255) DEFAULT NULL,
  `prix13` varchar(255) DEFAULT NULL,
  `article14` varchar(255) DEFAULT NULL,
  `prix14` varchar(255) DEFAULT NULL,
  `article15` varchar(255) DEFAULT NULL,
  `prix15` varchar(255) DEFAULT NULL,
  `article16` varchar(255) DEFAULT NULL,
  `prix16` varchar(255) DEFAULT NULL,
  `article17` varchar(255) DEFAULT NULL,
  `prix17` varchar(255) DEFAULT NULL,
  `article18` varchar(255) DEFAULT NULL,
  `prix18` varchar(255) DEFAULT NULL,
  `article19` varchar(255) DEFAULT NULL,
  `prix19` varchar(255) DEFAULT NULL,
  `article20` varchar(255) DEFAULT NULL,
  `prix20` varchar(255) DEFAULT NULL,
  `qte1` int(11) DEFAULT NULL,
  `qte2` int(11) DEFAULT NULL,
  `qte3` int(11) DEFAULT NULL,
  `qte4` int(11) DEFAULT NULL,
  `qte5` int(11) DEFAULT NULL,
  `qte6` int(11) DEFAULT NULL,
  `qte7` int(11) DEFAULT NULL,
  `qte8` int(11) DEFAULT NULL,
  `qte9` int(11) DEFAULT NULL,
  `qte10` int(11) DEFAULT NULL,
  `qte11` int(11) DEFAULT NULL,
  `qte12` int(11) DEFAULT NULL,
  `qte13` int(11) DEFAULT NULL,
  `qte14` int(11) DEFAULT NULL,
  `qte15` int(11) DEFAULT NULL,
  `qte16` int(11) DEFAULT NULL,
  `qte17` int(11) DEFAULT NULL,
  `qte18` int(11) DEFAULT NULL,
  `qte19` int(11) DEFAULT NULL,
  `qte20` int(11) DEFAULT NULL,
  `AutreFacture` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `bordero`
--

INSERT INTO `bordero` (`id`, `mdo`, `code_op`, `type`, `article1`, `prix1`, `article2`, `prix2`, `article3`, `prix3`, `article4`, `prix4`, `article5`, `prix5`, `article6`, `prix6`, `article7`, `prix7`, `article8`, `prix8`, `article9`, `prix9`, `article10`, `prix10`, `article11`, `prix11`, `article12`, `prix12`, `article13`, `prix13`, `article14`, `prix14`, `article15`, `prix15`, `article16`, `prix16`, `article17`, `prix17`, `article18`, `prix18`, `article19`, `prix19`, `article20`, `prix20`, `qte1`, `qte2`, `qte3`, `qte4`, `qte5`, `qte6`, `qte7`, `qte8`, `qte9`, `qte10`, `qte11`, `qte12`, `qte13`, `qte14`, `qte15`, `qte16`, `qte17`, `qte18`, `qte19`, `qte20`, `AutreFacture`) VALUES
(290, '', '00000', 'consultation', 'EXAMEN ET AVIS SUR DOSSIER D.A.O DU LOT STRUCTURE ET VRD', '5000', 'EXAMEN ET AVIS SUR DOSSIER D.A..O DU LOT ELECTRICITÃ‰ ET SÃ‰CURITÃ‰ INCENDIE', '2500', 'EXAMEN ET AVIS SUR DOSSIER D.A.O DU LOT FLUIDE', '1700', 'VISITE DE CHANTIER POUR EXAMEN ET SUIVI DES TRAVAUX', '150', 'PRÃ‰PARATION DES RAPPORT D\'ASSURANCE D0', '500', 'ASSISTANCE AU PRES DU MAÃŽTRE D\'OUVRAGE AU COURS DE LA RÃ‰CEPTION PROVISOIRE DES TRAVAUX', '450', 'ASSISTANCE AU PRES DU MAÃŽTRE D\'OUVRAGE AU COURS DE LA RÃ‰CEPTION DÃ‰FINITIF DES TRAVAUX', '450', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 1, 1, 15, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `cheques`
--

CREATE TABLE `cheques` (
  `id` int(11) NOT NULL,
  `num` varchar(78) NOT NULL,
  `ordre_de` varchar(200) DEFAULT NULL,
  `date_sortie` varchar(200) DEFAULT NULL,
  `montant` varchar(56) DEFAULT NULL,
  `date_echeance` varchar(200) DEFAULT NULL,
  `etat` varchar(67) DEFAULT NULL,
  `date_payement` varchar(56) DEFAULT NULL,
  `soldes` varchar(67) DEFAULT NULL,
  `typeuser` varchar(200) DEFAULT NULL,
  `autre` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `cr_visite`
--

CREATE TABLE `cr_visite` (
  `id` int(11) NOT NULL,
  `date_cr` varchar(45) DEFAULT NULL,
  `emis_par` varchar(56) DEFAULT NULL,
  `lot_cr` varchar(67) NOT NULL,
  `code` varchar(56) DEFAULT NULL,
  `mdo` varchar(56) DEFAULT NULL,
  `projet` text DEFAULT NULL,
  `reference` varchar(56) NOT NULL,
  `codesp` varchar(56) DEFAULT NULL,
  `user` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `dep`
--

CREATE TABLE `dep` (
  `id` int(11) NOT NULL,
  `DATE` varchar(67) DEFAULT NULL,
  `Montant` varchar(67) DEFAULT NULL,
  `Beneficiare` varchar(250) DEFAULT NULL,
  `RAISON` varchar(67) DEFAULT NULL,
  `typeuser` varchar(56) DEFAULT NULL,
  `journal_caisse` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `factures`
--

CREATE TABLE `factures` (
  `id` int(11) NOT NULL,
  `numFacture` int(40) NOT NULL,
  `annee` int(40) DEFAULT NULL,
  `codeAO` varchar(67) DEFAULT NULL,
  `codeProjet` varchar(56) DEFAULT NULL,
  `mdo` varchar(67) DEFAULT NULL,
  `titre` text DEFAULT NULL,
  `intitule` varchar(89) DEFAULT NULL,
  `mantant` varchar(50) NOT NULL,
  `avancement` varchar(78) DEFAULT NULL,
  `facture` varchar(200) DEFAULT NULL,
  `envoye` varchar(89) DEFAULT NULL,
  `recouvre` varchar(78) DEFAULT NULL,
  `qte1` varchar(50) NOT NULL,
  `qte2` int(11) NOT NULL,
  `qte3` int(11) NOT NULL,
  `qte4` int(11) NOT NULL,
  `qte5` int(11) NOT NULL,
  `qte6` int(11) DEFAULT NULL,
  `qte7` int(11) DEFAULT NULL,
  `qte8` int(11) DEFAULT NULL,
  `qte9` int(11) DEFAULT NULL,
  `qte10` int(11) DEFAULT NULL,
  `qte11` int(11) DEFAULT NULL,
  `qte12` int(11) DEFAULT NULL,
  `qte13` int(11) DEFAULT NULL,
  `qte14` int(11) DEFAULT NULL,
  `qte15` int(11) DEFAULT NULL,
  `qte16` int(11) DEFAULT NULL,
  `qte17` int(11) DEFAULT NULL,
  `qte18` int(11) DEFAULT NULL,
  `qte19` int(11) DEFAULT NULL,
  `qte20` int(11) DEFAULT NULL,
  `lien` varchar(50) DEFAULT NULL,
  `observation` text DEFAULT NULL,
  `designation` text NOT NULL,
  `pourcentage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `factures_news`
--

CREATE TABLE `factures_news` (
  `id` int(11) NOT NULL,
  `numFacture` int(40) NOT NULL,
  `annee` int(40) DEFAULT NULL,
  `codeAO` varchar(67) DEFAULT NULL,
  `codeProjet` varchar(56) DEFAULT NULL,
  `mdo` varchar(67) DEFAULT NULL,
  `titre` text DEFAULT NULL,
  `intitule` varchar(89) DEFAULT NULL,
  `mantant` varchar(50) NOT NULL,
  `avancement` varchar(78) DEFAULT NULL,
  `facture` varchar(200) DEFAULT NULL,
  `envoye` varchar(89) DEFAULT NULL,
  `recouvre` varchar(78) DEFAULT NULL,
  `qte1` varchar(50) NOT NULL,
  `qte2` int(11) NOT NULL,
  `qte3` int(11) NOT NULL,
  `qte4` int(11) NOT NULL,
  `qte5` int(11) NOT NULL,
  `qte6` int(11) DEFAULT NULL,
  `qte7` int(11) DEFAULT NULL,
  `qte8` int(11) DEFAULT NULL,
  `qte9` int(11) DEFAULT NULL,
  `qte10` int(11) DEFAULT NULL,
  `qte11` int(11) DEFAULT NULL,
  `qte12` int(11) DEFAULT NULL,
  `qte13` int(11) DEFAULT NULL,
  `qte14` int(11) DEFAULT NULL,
  `qte15` int(11) DEFAULT NULL,
  `qte16` int(11) DEFAULT NULL,
  `qte17` int(11) DEFAULT NULL,
  `qte18` int(11) DEFAULT NULL,
  `qte19` int(11) DEFAULT NULL,
  `qte20` int(11) DEFAULT NULL,
  `lien` varchar(50) DEFAULT NULL,
  `observation` text DEFAULT NULL,
  `designation` text NOT NULL,
  `pourcentage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `offres`
--

CREATE TABLE `offres` (
  `id` int(11) NOT NULL,
  `code` varchar(56) NOT NULL,
  `type` varchar(56) DEFAULT NULL,
  `etat` varchar(56) DEFAULT NULL,
  `mdo` varchar(56) DEFAULT NULL,
  `titre` text DEFAULT NULL,
  `date_limite` varchar(56) DEFAULT NULL,
  `date_decharge` varchar(56) DEFAULT NULL,
  `cout` varchar(56) DEFAULT NULL,
  `hono` varchar(67) DEFAULT NULL,
  `intitule` varchar(56) DEFAULT NULL,
  `pourcentage` varchar(56) DEFAULT NULL,
  `nb_vis` int(11) DEFAULT NULL,
  `rp_rd` varchar(56) DEFAULT NULL,
  `bordero` varchar(67) DEFAULT NULL,
  `observation` text DEFAULT NULL,
  `Typeuser` varchar(250) DEFAULT NULL,
  `vis_a_vis` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Structure de la table `partenaires`
--

CREATE TABLE `partenaires` (
  `id` int(11) NOT NULL,
  `type` varchar(67) NOT NULL,
  `client` varchar(250) DEFAULT NULL,
  `designation` text DEFAULT NULL,
  `date_decharge` varchar(250) DEFAULT NULL,
  `Adresse` varchar(250) DEFAULT NULL,
  `fax` varchar(250) DEFAULT NULL,
  `tel` varchar(250) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `contact` varchar(200) DEFAULT NULL,
  `typeuser` varchar(56) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ponctuel`
--

CREATE TABLE `ponctuel` (
  `id` int(11) NOT NULL,
  `num` varchar(67) DEFAULT NULL,
  `code` varchar(67) DEFAULT NULL,
  `code_offre` varchar(60) DEFAULT NULL,
  `mdo` varchar(56) DEFAULT NULL,
  `projet` varchar(250) DEFAULT NULL,
  `vis_a_vis` varchar(67) DEFAULT NULL,
  `lot` varchar(245) DEFAULT NULL,
  `honoraire` varchar(67) DEFAULT NULL,
  `av` varchar(56) DEFAULT NULL,
  `arr` varchar(200) DEFAULT NULL,
  `mission` varchar(200) DEFAULT NULL,
  `date` varchar(56) DEFAULT NULL,
  `v_estime` varchar(56) DEFAULT NULL,
  `dem` varchar(56) DEFAULT NULL,
  `v_fait` varchar(67) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

CREATE TABLE `projet` (
  `id` int(11) NOT NULL,
  `code_AO` varchar(67) NOT NULL,
  `type` varchar(56) DEFAULT NULL,
  `mdo` varchar(56) DEFAULT NULL,
  `titre` text DEFAULT NULL,
  `date_limite` varchar(56) DEFAULT NULL,
  `date_decharge` varchar(56) DEFAULT NULL,
  `cout` varchar(56) DEFAULT NULL,
  `hono` varchar(67) DEFAULT NULL,
  `intitule` varchar(45) DEFAULT NULL,
  `pourcentage` varchar(56) DEFAULT NULL,
  `rp_rd` varchar(56) DEFAULT NULL,
  `date_B_C` varchar(67) DEFAULT NULL,
  `date_receptionBC` varchar(56) DEFAULT NULL,
  `code_projet` varchar(56) NOT NULL,
  `etat_p` varchar(45) DEFAULT NULL,
  `dem` varchar(56) DEFAULT NULL,
  `rp` varchar(56) DEFAULT NULL,
  `rd` varchar(56) DEFAULT NULL,
  `observation` text DEFAULT NULL,
  `BC` varchar(67) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `rec_p`
--

CREATE TABLE `rec_p` (
  `id` int(11) NOT NULL,
  `num` varchar(67) NOT NULL,
  `code` varchar(67) NOT NULL,
  `mdo` varchar(56) NOT NULL,
  `projet` varchar(250) NOT NULL,
  `vis_a_vis` varchar(67) NOT NULL,
  `HONORAIRE` varchar(245) NOT NULL,
  `COMM` varchar(56) NOT NULL,
  `ing` varchar(200) NOT NULL,
  `FACTURE` varchar(200) NOT NULL,
  `RECOUV` varchar(56) NOT NULL,
  `date` varchar(67) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `sortie`
--

CREATE TABLE `sortie` (
  `id` int(11) NOT NULL,
  `date_sortie` varchar(45) DEFAULT NULL,
  `emis_par` varchar(56) DEFAULT NULL,
  `lot_sortie` varchar(67) NOT NULL,
  `phse` varchar(67) DEFAULT NULL,
  `miss` varchar(56) DEFAULT NULL,
  `code` varchar(56) DEFAULT NULL,
  `mdo` varchar(56) DEFAULT NULL,
  `projet` text DEFAULT NULL,
  `reference` varchar(56) NOT NULL,
  `codesp` varchar(56) DEFAULT NULL,
  `user` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sous_projet`
--

CREATE TABLE `sous_projet` (
  `id` int(11) NOT NULL,
  `codeP` varchar(56) DEFAULT NULL,
  `code_sous_P` varchar(56) DEFAULT NULL,
  `mdo` varchar(56) DEFAULT NULL,
  `titre` varchar(67) DEFAULT NULL,
  `etat` varchar(56) DEFAULT NULL,
  `arrive` varchar(56) DEFAULT NULL,
  `sortie` varchar(56) DEFAULT NULL,
  `titre_sous_projet` varchar(67) DEFAULT NULL,
  `date_rp` varchar(67) DEFAULT NULL,
  `date_rd` varchar(67) DEFAULT NULL,
  `demarrage` varchar(56) DEFAULT NULL,
  `crv` varchar(67) DEFAULT NULL,
  `observation` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `arrives`
--
ALTER TABLE `arrives`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `bordero`
--
ALTER TABLE `bordero`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cheques`
--
ALTER TABLE `cheques`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `num` (`num`);

--
-- Index pour la table `cr_visite`
--
ALTER TABLE `cr_visite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Index pour la table `dep`
--
ALTER TABLE `dep`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `factures`
--
ALTER TABLE `factures`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `factures_news`
--
ALTER TABLE `factures_news`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `offres`
--
ALTER TABLE `offres`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Index pour la table `partenaires`
--
ALTER TABLE `partenaires`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ponctuel`
--
ALTER TABLE `ponctuel`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `projet`
--
ALTER TABLE `projet`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `rec_p`
--
ALTER TABLE `rec_p`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sortie`
--
ALTER TABLE `sortie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sous_projet`
--
ALTER TABLE `sous_projet`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `arrives`
--
ALTER TABLE `arrives`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `bordero`
--
ALTER TABLE `bordero`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=871;

--
-- AUTO_INCREMENT pour la table `cheques`
--
ALTER TABLE `cheques`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `cr_visite`
--
ALTER TABLE `cr_visite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `dep`
--
ALTER TABLE `dep`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `factures`
--
ALTER TABLE `factures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `factures_news`
--
ALTER TABLE `factures_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `offres`
--
ALTER TABLE `offres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `partenaires`
--
ALTER TABLE `partenaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ponctuel`
--
ALTER TABLE `ponctuel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `projet`
--
ALTER TABLE `projet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `rec_p`
--
ALTER TABLE `rec_p`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `sortie`
--
ALTER TABLE `sortie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `sous_projet`
--
ALTER TABLE `sous_projet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
