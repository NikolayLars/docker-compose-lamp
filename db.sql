-- Adminer 4.8.1 MySQL 8.0.27 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `benutzer`;
CREATE TABLE `benutzer` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Benutzername` varchar(255) NOT NULL,
  `Passwort` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `benutzer` (`ID`, `Benutzername`, `Passwort`, `Email`) VALUES
(1,	'admin',	'1234',	'admin@test.de'),
(14,	'fe',	'ef5fdojA',	'fe@test.de');

DROP TABLE IF EXISTS `produkte`;
CREATE TABLE `produkte` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `Preis` double NOT NULL,
  `Anzahl` int NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `produkte` (`ID`, `Name`, `Preis`, `Anzahl`) VALUES
(6,	'Regale',	398.99,	18),
(8,	'Stuhl',	22.33,	6);

DROP TABLE IF EXISTS `rollen`;
CREATE TABLE `rollen` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Benutzer_ID` int NOT NULL,
  `Rolle` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `rollen_ibfk_1` (`Benutzer_ID`),
  CONSTRAINT `rollen_ibfk_1` FOREIGN KEY (`Benutzer_ID`) REFERENCES `benutzer` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `rollen` (`ID`, `Benutzer_ID`, `Rolle`) VALUES
(1,	1,	1),
(7,	14,	0);

-- 2021-11-27 11:05:35