-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 27, 2021 at 09:06 AM
-- Server version: 5.7.18
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `listecourses`
--

-- --------------------------------------------------------

--
-- Table structure for table `liste`
--

CREATE TABLE `liste` (
  `id_magasin` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `quantite` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `liste`
--

INSERT INTO `liste` (`id_magasin`, `id_produit`, `quantite`) VALUES
(1, 2, '1.00'),
(1, 3, '1.00'),
(2, 6, '3.00'),
(4, 6, '4.00'),
(5, 7, '3.00'),
(6, 8, '26.50'),
(7, 9, '2.00'),
(7, 10, '3.00'),
(8, 11, '1.00'),
(8, 12, '1.00'),
(9, 13, '4.00');

-- --------------------------------------------------------

--
-- Table structure for table `magasin`
--

CREATE TABLE `magasin` (
  `id_magasin` int(11) NOT NULL,
  `nom` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `magasin`
--

INSERT INTO `magasin` (`id_magasin`, `nom`, `contact`) VALUES
(1, 'Auchan', NULL),
(2, 'Carrefour', '04855095095'),
(3, 'Gelatissimo', NULL),
(4, 'leclerc', NULL),
(5, 'superU', NULL),
(6, 'Intermarché', NULL),
(7, 'Picard', NULL),
(8, 'Fnac', NULL),
(9, 'Lidl', NULL),
(10, 'Carrefour', '0448595598');

-- --------------------------------------------------------

--
-- Table structure for table `produit`
--

CREATE TABLE `produit` (
  `id_produit` int(11) NOT NULL,
  `nom` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'mon premier sql',
  `prix_unit` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produit`
--

INSERT INTO `produit` (`id_produit`, `nom`, `prix_unit`) VALUES
(2, 'tomates', '2.00'),
(3, 'salade', '2.00'),
(4, 'gaufre', '3.00'),
(5, 'crepe', '3.00'),
(6, 'lardons', '2.00'),
(7, 'bonbon', '12.00'),
(8, 'pamplemousses', '10.00'),
(9, 'Frittes', '5.00'),
(10, 'Steak', '8.00'),
(11, 'PS5', '600.00'),
(12, 'Nintendo Switch', '390.00'),
(13, 'saumon', '38.00'),
(14, 'couteau', '50.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `liste`
--
ALTER TABLE `liste`
  ADD PRIMARY KEY (`id_magasin`,`id_produit`),
  ADD KEY `id_produit` (`id_produit`);

--
-- Indexes for table `magasin`
--
ALTER TABLE `magasin`
  ADD PRIMARY KEY (`id_magasin`);

--
-- Indexes for table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id_produit`),
  ADD UNIQUE KEY `nom` (`nom`),
  ADD UNIQUE KEY `nom_2` (`nom`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `magasin`
--
ALTER TABLE `magasin`
  MODIFY `id_magasin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `produit`
--
ALTER TABLE `produit`
  MODIFY `id_produit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `liste`
--
ALTER TABLE `liste`
  ADD CONSTRAINT `liste_ibfk_1` FOREIGN KEY (`id_magasin`) REFERENCES `magasin` (`id_magasin`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `liste_ibfk_2` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id_produit`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
