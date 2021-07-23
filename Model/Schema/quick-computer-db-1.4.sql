-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2021 at 04:32 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quick-computer-db`
--

-- --------------------------------------------------------

--
-- Table structure for table `dependant`
--

CREATE TABLE `dependant` (
  `id_dependant` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `nom_2` varchar(50) NOT NULL,
  `prenom_2` varchar(50) NOT NULL,
  `nom_3` varchar(50) NOT NULL,
  `prenom_3` varchar(50) NOT NULL,
  `nom_4` varchar(50) NOT NULL,
  `prenom_4` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `entreprise`
--

CREATE TABLE `entreprise` (
  `id_ent` int(11) NOT NULL,
  `code_entreprise` varchar(50) NOT NULL,
  `nom_entreprise` varchar(100) NOT NULL,
  `date_creation` date NOT NULL,
  `date_expiration` date NOT NULL,
  `id_statut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `entreprise`
--

INSERT INTO `entreprise` (`id_ent`, `code_entreprise`, `nom_entreprise`, `date_creation`, `date_expiration`, `id_statut`) VALUES
(1, 'brana', 'brana', '2023-07-21', '2021-07-21', 1),
(2, 'ckhardware.qc', 'CK Hadware', '2021-07-09', '2021-07-11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `groupe`
--

CREATE TABLE `groupe` (
  `id_group` int(11) NOT NULL,
  `nom_groupe` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `date_creation` date NOT NULL,
  `date_expiration` date NOT NULL,
  `id_program` int(11) NOT NULL,
  `code_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `groupe`
--

INSERT INTO `groupe` (`id_group`, `nom_groupe`, `description`, `date_creation`, `date_expiration`, `id_program`, `code_user`) VALUES
(1, 'Group 1', 'Test du group 1', '2012-07-21', '2021-07-12', 3, 3),
(2, 'Groupe 2', 'Test du groupe 2', '2012-07-21', '2021-07-12', 3, 3),
(3, 'Group 3', 'Test du groupe numéro 3', '2012-07-21', '2021-07-12', 3, 2),
(4, 'Département des ventes', 'Ceci est un test pour le nouveau groupe', '2012-07-21', '2021-07-13', 2, 2),
(5, 'Test group du 1er program', 'Test group du 1er program', '2012-07-21', '2021-07-21', 1, 2),
(6, 'Second test du group 1', 'Second test', '2012-07-21', '2021-07-13', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `personne`
--

CREATE TABLE `personne` (
  `id_person` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `date_naissance` date NOT NULL,
  `lieu_naissance` varchar(50) NOT NULL,
  `telephone_1` varchar(20) NOT NULL,
  `telephone_2` varchar(20) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `id_statut` int(11) NOT NULL,
  `id_dependant` int(11) DEFAULT NULL,
  `id_group` int(11) NOT NULL,
  `id_program` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `personne`
--

INSERT INTO `personne` (`id_person`, `nom`, `prenom`, `date_naissance`, `lieu_naissance`, `telephone_1`, `telephone_2`, `adresse`, `email`, `profile_image`, `id_statut`, `id_dependant`, `id_group`, `id_program`) VALUES
(1, 'Jhon', 'Mc Field', '2021-07-01', 'NYC', '1234', '3456', '12, B2B, Street', 'jmc@gmail.com', '', 2, NULL, 5, 1),
(2, 'Jhon', 'Mc Field', '2021-07-01', 'NYC', '1234', '3456', '12, B2B, Street', 'jmc@gmail.com', '', 1, NULL, 4, 2),
(3, 'Marcos', 'Peloti', '2021-07-01', 'NYC', '1234', '3456', '12, B2B, Street', 'pelotimarcos@gmail.com', '', 2, NULL, 1, 3),
(4, 'Barzagli', 'Florenzo', '2021-07-01', 'NYC', '1234', '3456', '12, B2B, Street', 'pelotimarcos@gmail.com', '', 2, NULL, 5, 1),
(5, 'Ritchmond', 'Gilles', '2021-07-15', 'HT', '44387245', '1234', '112, Rue delmas', 'gritchmond@gmail.com', '', 1, NULL, 3, 3),
(6, 'Jean', 'Michel', '2021-07-15', 'P-au-P', '123456', '123456', 'P-au-P', 'jeanmichel@gmail.com', '', 1, NULL, 2, 3),
(7, 'Test', 'Test', '2021-07-14', 'Test', '12345', '12345', 'Test', 'test@gmail.com', '61157-une_curiosite_infinie_544x746.jpg', 1, NULL, 5, 1),
(8, 'OverFlow', 'Doe', '2021-07-08', 'NYC', '44387245', '12345', '112, Rue delmas', 'overFLow@gmail.com', '61530-untitled-2.jpg', 2, NULL, 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `id_program` int(11) NOT NULL,
  `program_name` varchar(50) NOT NULL,
  `date_creation` date NOT NULL,
  `date_expiration` date NOT NULL,
  `description` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `code_entreprise` varchar(50) NOT NULL,
  `code_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`id_program`, `program_name`, `date_creation`, `date_expiration`, `description`, `image`, `code_entreprise`, `code_user`) VALUES
(1, 'Program 1', '2021-07-21', '2021-07-12', 'sdfas', '19119-2285582-illustration-design-chocolat-cacao-vectoriel.jpg', 'ckhardware.qc', 2),
(2, 'Program 2', '2021-07-21', '2021-07-12', 'Test d\'enregistrement du second program', '4567-code-promo-abeille-heureuse@2x.png', 'ckhardware.qc', 3),
(3, 'Program 3', '2021-07-21', '2021-07-12', 'Test de la date de création', '73585-istockphoto-1042533778-612x612.png', 'ckhardware.qc', 3);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `role_name`) VALUES
(1, 'read only'),
(2, 'write only'),
(3, 'read-write');

-- --------------------------------------------------------

--
-- Table structure for table `statut`
--

CREATE TABLE `statut` (
  `id_statut` int(11) NOT NULL,
  `statut_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `statut`
--

INSERT INTO `statut` (`id_statut`, `statut_name`) VALUES
(1, 'activé'),
(2, 'désactivé');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `code_user` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `telephone_1` varchar(20) NOT NULL,
  `telephone_2` varchar(20) NOT NULL,
  `code_entreprise` varchar(50) NOT NULL,
  `id_role` int(11) NOT NULL,
  `id_statut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`code_user`, `nom`, `prenom`, `email`, `password`, `adresse`, `telephone_1`, `telephone_2`, `code_entreprise`, `id_role`, `id_statut`) VALUES
(2, 'John', 'Doe', 'johndoe@gmail.com', '$2y$10$HutFoRniSZZi/iGg/tIR9OxPMMtZcuNYOUYzuXlzwqCWV4cWyMgUS', '112, Rue delmas', '44387245', '', 'ckhardware.qc', 3, 1),
(3, 'Karl', 'Henry', 'kh.quick@gmail.com', '$2y$10$dyBXhmZoY1NF/FPhao9k5uQOzzCK/F3F56PlcoDDVTuFnZdybBfZO', '5, Pèlerin', '1234556', '', 'ckhardware.qc', 3, 1),
(4, 'quick', 'computer', 'quickcomputer@gmail.com', '$2y$10$ex7r3T7vXef8jYNgQR3ZtexvMJLC3PVPKYgFoHa8fzCZJmQdz.xA6', '12, rue QC', '46151', '461354', 'ckhardware.qc', 1, 1),
(5, 'admin', 'test', 'admin@test.com', '$2y$10$Q/NWkjakgOSjciWBMitsROgaL1m13Z0dl9vz8NJNN.Wa8mP/lxtAC', 'admin', '12324', '123123', 'brana', 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dependant`
--
ALTER TABLE `dependant`
  ADD PRIMARY KEY (`id_dependant`);

--
-- Indexes for table `entreprise`
--
ALTER TABLE `entreprise`
  ADD PRIMARY KEY (`code_entreprise`),
  ADD UNIQUE KEY `id_ent` (`id_ent`);

--
-- Indexes for table `groupe`
--
ALTER TABLE `groupe`
  ADD PRIMARY KEY (`id_group`);

--
-- Indexes for table `personne`
--
ALTER TABLE `personne`
  ADD PRIMARY KEY (`id_person`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`id_program`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `statut`
--
ALTER TABLE `statut`
  ADD PRIMARY KEY (`id_statut`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`code_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dependant`
--
ALTER TABLE `dependant`
  MODIFY `id_dependant` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `entreprise`
--
ALTER TABLE `entreprise`
  MODIFY `id_ent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `groupe`
--
ALTER TABLE `groupe`
  MODIFY `id_group` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personne`
--
ALTER TABLE `personne`
  MODIFY `id_person` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `id_program` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `statut`
--
ALTER TABLE `statut`
  MODIFY `id_statut` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `code_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
