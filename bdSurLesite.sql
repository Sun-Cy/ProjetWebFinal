-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour microphone

USE `thdfgtfd_microphone`;

-- Listage de la structure de table microphone. cartouche
DROP TABLE IF EXISTS `cartouche`;
CREATE TABLE IF NOT EXISTS `cartouche` (
  `idCartouche` int NOT NULL AUTO_INCREMENT,
  `cartouche` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idCartouche`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table microphone. commandemicro
DROP TABLE IF EXISTS `commandemicro`;
CREATE TABLE IF NOT EXISTS `commandemicro` (
  `idCommande` int NOT NULL,
  `idMicro` int NOT NULL,
  PRIMARY KEY (`idCommande`,`idMicro`),
  KEY `idMicro` (`idMicro`),
  CONSTRAINT `commandemicro_ibfk_1` FOREIGN KEY (`idCommande`) REFERENCES `commandes` (`idCommande`),
  CONSTRAINT `commandemicro_ibfk_2` FOREIGN KEY (`idMicro`) REFERENCES `microphone` (`idMicro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table microphone. commandes
DROP TABLE IF EXISTS `commandes`;
CREATE TABLE IF NOT EXISTS `commandes` (
  `idCommande` int NOT NULL AUTO_INCREMENT,
  `idClient` int DEFAULT NULL,
  `dateCommande` datetime DEFAULT NULL,
  `quantite` int DEFAULT NULL,
  `prixTotal` decimal(19,4) DEFAULT NULL,
  PRIMARY KEY (`idCommande`),
  KEY `FK_CommandeUser` (`idClient`),
  CONSTRAINT `commandes_ibfk_1` FOREIGN KEY (`idClient`) REFERENCES `utilisateur` (`idUser`),
  CONSTRAINT `FK_CommandeUser` FOREIGN KEY (`idClient`) REFERENCES `utilisateur` (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table microphone. garantie
DROP TABLE IF EXISTS `garantie`;
CREATE TABLE IF NOT EXISTS `garantie` (
  `garantie` varchar(10) DEFAULT NULL,
  `idGarantie` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idGarantie`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table microphone. interface
DROP TABLE IF EXISTS `interface`;
CREATE TABLE IF NOT EXISTS `interface` (
  `idInterface` int NOT NULL AUTO_INCREMENT,
  `interface` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idInterface`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table microphone. marque
DROP TABLE IF EXISTS `marque`;
CREATE TABLE IF NOT EXISTS `marque` (
  `marque` varchar(50) DEFAULT NULL,
  `idMarque` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idMarque`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table microphone. micropattern
DROP TABLE IF EXISTS `micropattern`;
CREATE TABLE IF NOT EXISTS `micropattern` (
  `idMicro` int NOT NULL,
  `idModeleDirectionnel` int NOT NULL,
  PRIMARY KEY (`idMicro`,`idModeleDirectionnel`),
  KEY `FK_idPattern` (`idModeleDirectionnel`),
  CONSTRAINT `FK_idMicro` FOREIGN KEY (`idMicro`) REFERENCES `microphone` (`idMicro`),
  CONSTRAINT `FK_idPattern` FOREIGN KEY (`idModeleDirectionnel`) REFERENCES `modeledirectionnel` (`idModeleDirectionnel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table microphone. microphone
DROP TABLE IF EXISTS `microphone`;
CREATE TABLE IF NOT EXISTS `microphone` (
  `idMicro` int NOT NULL AUTO_INCREMENT,
  `idMarque` int DEFAULT NULL,
  `modele` varchar(50) DEFAULT NULL,
  `idGarantie` int DEFAULT NULL,
  `idInterface` int DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `prix` decimal(19,4) DEFAULT NULL,
  `lienAchat` text,
  `idCartouche` int DEFAULT NULL,
  `frequenceMin` int DEFAULT NULL,
  `frequenceMax` int DEFAULT NULL,
  `maxSPL` int DEFAULT NULL,
  `ratedImpedance` int DEFAULT NULL,
  `RGB` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idMicro`),
  KEY `FK_idMarque` (`idMarque`),
  KEY `FK_idGarantie` (`idGarantie`),
  KEY `FK_idCartouche` (`idCartouche`),
  KEY `FK_idInterface` (`idInterface`),
  CONSTRAINT `FK_idCartouche` FOREIGN KEY (`idCartouche`) REFERENCES `cartouche` (`idCartouche`),
  CONSTRAINT `FK_idGarantie` FOREIGN KEY (`idGarantie`) REFERENCES `garantie` (`idGarantie`),
  CONSTRAINT `FK_idInterface` FOREIGN KEY (`idInterface`) REFERENCES `interface` (`idInterface`),
  CONSTRAINT `FK_idMarque` FOREIGN KEY (`idMarque`) REFERENCES `marque` (`idMarque`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table microphone. modeledirectionnel
DROP TABLE IF EXISTS `modeledirectionnel`;
CREATE TABLE IF NOT EXISTS `modeledirectionnel` (
  `idModeleDirectionnel` int NOT NULL AUTO_INCREMENT,
  `ModeleDirectionnel` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idModeleDirectionnel`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table microphone. revue
DROP TABLE IF EXISTS `revue`;
CREATE TABLE IF NOT EXISTS `revue` (
  `idRevue` int NOT NULL AUTO_INCREMENT,
  `idMicro` int DEFAULT NULL,
  `idUser` int DEFAULT NULL,
  `titre` varchar(50) DEFAULT NULL,
  `score` float DEFAULT NULL,
  `textRevue` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`idRevue`),
  KEY `FK_userRevue` (`idUser`),
  KEY `FK_RevueMicro` (`idMicro`),
  CONSTRAINT `FK_RevueMicro` FOREIGN KEY (`idMicro`) REFERENCES `microphone` (`idMicro`),
  CONSTRAINT `FK_userRevue` FOREIGN KEY (`idUser`) REFERENCES `utilisateur` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table microphone. utilisateur
DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `idUser` int NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `prenom` varchar(20) DEFAULT NULL,
  `nom` varchar(20) DEFAULT NULL,
  `adresse` varchar(50) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
