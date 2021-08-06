-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql-36994-db.mysql-36994:36994
-- Generation Time: Aug 05, 2021 at 02:30 PM
-- Server version: 8.0.25
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quick_computer_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `dependant`
--

CREATE TABLE `dependant` (
  `id_dependant` int NOT NULL,
  `nom_1` varchar(255) NOT NULL,
  `nom_2` varchar(255) NOT NULL,
  `nom_3` varchar(255) NOT NULL,
  `nom_4` varchar(255) NOT NULL,
  `nom_5` varchar(255) NOT NULL,
  `nom_6` varchar(255) NOT NULL,
  `nom_7` varchar(255) NOT NULL,
  `nom_8` varchar(255) NOT NULL,
  `nom_9` varchar(255) NOT NULL,
  `nom_10` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `dependant`
--

INSERT INTO `dependant` (`id_dependant`, `nom_1`, `nom_2`, `nom_3`, `nom_4`, `nom_5`, `nom_6`, `nom_7`, `nom_8`, `nom_9`, `nom_10`) VALUES
(5, '', '', '', '', '', '', '', '', '', ''),
(6, '', '', '', '', '', '', '', '', '', ''),
(7, '', '', '', '', '', '', '', '', '', ''),
(8, 'Jean', 'Michel', 'Patrice ', 'Marc', 'Oui ', 'Zuck', 'Filtr', 'Afsgc', 'Waaes', 'Gcs'),
(9, '', '', '', '', '', '', '', '', '', ''),
(10, '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `entreprise`
--

CREATE TABLE `entreprise` (
  `id_ent` int NOT NULL,
  `code_entreprise` varchar(50) NOT NULL,
  `nom_entreprise` varchar(100) NOT NULL,
  `date_creation` date NOT NULL,
  `date_expiration` date NOT NULL,
  `statut_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `entreprise`
--

INSERT INTO `entreprise` (`id_ent`, `code_entreprise`, `nom_entreprise`, `date_creation`, `date_expiration`, `statut_id`) VALUES
(6, '21134-Test p100', 'Test p100', '2021-08-04', '2021-08-04', 1),
(1, 'brana', 'brana', '2023-07-21', '2021-07-21', 1),
(2, 'ckhardware.qc', 'CK Hadware', '2021-07-09', '2021-07-11', 1),
(3, 'Sogebank', 'Sogebank', '2003-08-21', '2021-10-03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `groupe`
--

CREATE TABLE `groupe` (
  `id_group` int NOT NULL,
  `nom_groupe` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `date_creation` date NOT NULL,
  `date_expiration` date NOT NULL,
  `id_program` int NOT NULL,
  `code_user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `groupe`
--

INSERT INTO `groupe` (`id_group`, `nom_groupe`, `description`, `date_creation`, `date_expiration`, `id_program`, `code_user`) VALUES
(1, 'Group 1', 'Test du group 1', '2012-07-21', '2021-07-12', 3, 3),
(2, 'Groupe 2', 'Test du groupe 2', '2012-07-21', '2021-07-12', 3, 3),
(3, 'Group 3', 'Test du groupe numéro 3', '2012-07-21', '2021-07-12', 3, 2),
(4, 'Département des ventes', 'Ceci est un test pour le nouveau groupe', '2012-07-21', '2021-07-13', 2, 2),
(5, 'Test group du 1er program', 'Test group du 1er program', '2012-07-21', '2021-07-21', 1, 2),
(6, 'Second test du group 1', 'Second test', '2012-07-21', '2021-07-13', 1, 2),
(7, 'Les cayes - Covid-19', 'Vaccination', '2021-07-28', '2021-07-31', 4, 3),
(8, 'Jacmel - Covid -19', 'Vaccination', '2021-07-28', '2021-07-31', 4, 3),
(9, 'Xp0', '', '2021-08-01', '2021-08-01', 7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `personne`
--

CREATE TABLE `personne` (
  `id_person` int NOT NULL,
  `card_number` varchar(255) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `date_naissance` date NOT NULL,
  `lieu_naissance` varchar(50) NOT NULL,
  `telephone_1` varchar(20) NOT NULL,
  `telephone_2` varchar(20) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `date_exp` date NOT NULL,
  `creation_date` date NOT NULL,
  `id_statut` int NOT NULL,
  `id_dependant` int DEFAULT NULL,
  `id_group` int NOT NULL,
  `id_program` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `personne`
--

INSERT INTO `personne` (`id_person`, `card_number`, `nom`, `prenom`, `date_naissance`, `lieu_naissance`, `telephone_1`, `telephone_2`, `adresse`, `email`, `profile_image`, `date_exp`, `creation_date`, `id_statut`, `id_dependant`, `id_group`, `id_program`) VALUES
(16, '012321', 'Xls', 'Test', '2021-08-27', 'Ou ', '1235', '12467', 'Qrycx', 'xls@test.com', 'ava.jpg', '2021-08-26', '2021-08-02', 1, 8, 9, 7),
(17, '163545', 'Jim', 'Dire', '2021-08-24', '', '1235', '', 'P-au-P', '', '47317-image.jpg', '2021-08-27', '2021-08-02', 1, 9, 9, 7),
(18, '234523', 'Card', 'number', '2021-08-01', 'p-au-p', '1324', '2134', 'sddff', 'cn@gmil.com', '', '2021-08-17', '2021-08-03', 1, 1, 4, 3),
(19, '445448', 'gritchmond', 'Ritchmond', '2021-08-03', 'HT', '44387245', '12212', '112, Rue delmas', 'gritchmond@gmail.com', '', '2021-08-03', '2021-08-04', 1, 10, 9, 7);

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `id_program` int NOT NULL,
  `program_name` varchar(50) NOT NULL,
  `date_creation` date NOT NULL,
  `date_expiration` date NOT NULL,
  `description` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `code_entreprise` varchar(50) NOT NULL,
  `code_user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`id_program`, `program_name`, `date_creation`, `date_expiration`, `description`, `image`, `code_entreprise`, `code_user`) VALUES
(1, 'Program 1', '2021-07-21', '2021-07-12', 'sdfas', '19119-2285582-illustration-design-chocolat-cacao-vectoriel.jpg', 'ckhardware.qc', 2),
(2, 'Program 2', '2021-07-21', '2021-07-12', 'Test d\'enregistrement du second program', '4567-code-promo-abeille-heureuse@2x.png', 'ckhardware.qc', 3),
(3, 'Program 3', '2021-07-21', '2021-07-12', 'Test de la date de création', '73585-istockphoto-1042533778-612x612.png', 'ckhardware.qc', 3),
(4, 'COVID-19 Vaccination', '2021-07-28', '2021-07-30', ' Vaccination de la ville de Mopelo', '36260-b3-ej246_medtar_gr_20190626085306.jpg', 'ckhardware.qc', 3),
(7, 'Xs', '2021-08-01', '2021-08-01', '', '60566-2fee6544-26db-4473-9ea2-04c266f77ff6.jpeg', 'ckhardware.qc', 2);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id_role` int NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `role_name`) VALUES
(1, 'read only'),
(2, 'write only'),
(3, 'read-write'),
(4, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `statut`
--

CREATE TABLE `statut` (
  `id_statut` int NOT NULL,
  `statut_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `statut`
--

INSERT INTO `statut` (`id_statut`, `statut_name`) VALUES
(1, 'Enable'),
(2, 'Disable');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `code_user` int NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `telephone_1` varchar(20) NOT NULL,
  `telephone_2` varchar(20) NOT NULL,
  `code_entreprise` varchar(50) NOT NULL,
  `id_role` int NOT NULL,
  `id_statut` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`code_user`, `nom`, `prenom`, `email`, `password`, `adresse`, `telephone_1`, `telephone_2`, `code_entreprise`, `id_role`, `id_statut`) VALUES
(2, 'John', 'Doe', 'johndoe@gmail.com', '$2y$10$HutFoRniSZZi/iGg/tIR9OxPMMtZcuNYOUYzuXlzwqCWV4cWyMgUS', '112, Rue delmas', '44387245', '', 'ckhardware.qc', 3, 1),
(3, 'Karl', 'Henry', 'kh.quick@gmail.com', '$2y$10$dyBXhmZoY1NF/FPhao9k5uQOzzCK/F3F56PlcoDDVTuFnZdybBfZO', '5, Pèlerin', '1234556', '', 'ckhardware.qc', 3, 1),
(4, 'quick', 'computer', 'quickcomputer@gmail.com', '$2y$10$ex7r3T7vXef8jYNgQR3ZtexvMJLC3PVPKYgFoHa8fzCZJmQdz.xA6', '12, rue QC', '46151', '461354', 'ckhardware.qc', 1, 1),
(5, 'admin', 'test', 'admin@test.com', '$2y$10$Q/NWkjakgOSjciWBMitsROgaL1m13Z0dl9vz8NJNN.Wa8mP/lxtAC', 'admin', '12324', '123123', 'brana', 2, 2),
(6, 'SGBK', 'Client', 'sgbk@test.com', '$2y$10$AQFbFS4VtIIHWHJyH3u1rOex2ZAVTL6xPHUgVa6X3M3LX0SlUyTIm', '12, B2B, Street', '4412345', '4438123', 'ckhardware.qc', 3, 1),
(7, 'admin', 'admin', 'admin@gmail.com', '$2y$10$Ba5B1KTfdsOTpCE88Qa7IO3riI0wngFilBDOlC51n8/tKCUu4QClW', 'admin', '1234', '12312', 'ckhardware.qc', 4, 1);

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
  MODIFY `id_dependant` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `entreprise`
--
ALTER TABLE `entreprise`
  MODIFY `id_ent` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `groupe`
--
ALTER TABLE `groupe`
  MODIFY `id_group` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personne`
--
ALTER TABLE `personne`
  MODIFY `id_person` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `id_program` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `statut`
--
ALTER TABLE `statut`
  MODIFY `id_statut` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `code_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
