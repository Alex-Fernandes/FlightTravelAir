-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 21, 2021 at 05:15 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flighttravelair`
--

-- --------------------------------------------------------

--
-- Table structure for table `airports`
--

DROP TABLE IF EXISTS `airports`;
CREATE TABLE IF NOT EXISTS `airports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `pais` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `airports`
--

INSERT INTO `airports` (`id`, `nome`, `cidade`, `pais`) VALUES
(1, 'Aeroporto da Madeira', 'Madeira', 'Portugal Continental'),
(5, 'Aeroporto de Paris', 'Londres', 'FranÃ§a'),
(6, 'Aeroporto Alcobaca', 'Alcobaca', 'Portugal'),
(7, 'So de Ida', 'So de Ida', 'So de Ida'),
(8, 'Aeroporto Santander', 'Caldas da Rainha', 'Portugal'),
(9, 'Aeroporto de Moscovo', 'Moscovo', 'Vodka');

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

DROP TABLE IF EXISTS `flights`;
CREATE TABLE IF NOT EXISTS `flights` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idaeroportoorigem` int(11) NOT NULL,
  `idaeroportodestino` int(11) NOT NULL,
  `precoVenda` decimal(7,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idEscala` (`idaeroportoorigem`),
  KEY `idaeroportodestino` (`idaeroportodestino`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `flights`
--

INSERT INTO `flights` (`id`, `idaeroportoorigem`, `idaeroportodestino`, `precoVenda`) VALUES
(1, 1, 6, '25.00'),
(2, 5, 1, '520.00'),
(3, 7, 7, '0.00'),
(4, 8, 9, '15.50'),
(5, 5, 8, '13.00'),
(6, 9, 8, '150.00'),
(7, 6, 1, '42.00'),
(8, 5, 1, '69.00'),
(9, 5, 9, '200.00'),
(10, 1, 6, '80.00'),
(11, 9, 5, '15.50'),
(12, 8, 5, '800.00');

-- --------------------------------------------------------

--
-- Table structure for table `flightsales`
--

DROP TABLE IF EXISTS `flightsales`;
CREATE TABLE IF NOT EXISTS `flightsales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) NOT NULL,
  `idVooIda` int(11) NOT NULL,
  `idVooVolta` int(11) NOT NULL DEFAULT '3',
  `precoPago` int(11) NOT NULL,
  `dataCompra` datetime NOT NULL,
  `registoCheckIn` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idUser` (`idUser`),
  KEY `idVooIda` (`idVooIda`),
  KEY `idVooVolta` (`idVooVolta`),
  KEY `registoCheckIn` (`registoCheckIn`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `flightsales`
--

INSERT INTO `flightsales` (`id`, `idUser`, `idVooIda`, `idVooVolta`, `precoPago`, `dataCompra`, `registoCheckIn`) VALUES
(1, 9, 1, 2, 122, '2021-06-20 15:57:55', 2),
(2, 9, 2, 1, 545, '2021-06-20 18:06:46', 2),
(7, 9, 2, 3, 520, '2021-06-20 22:06:29', 2),
(9, 9, 2, 3, 520, '2021-06-20 23:06:28', NULL),
(13, 9, 2, 3, 520, '2021-06-21 00:06:15', 2),
(14, 8, 1, 2, 545, '2021-06-21 12:06:29', NULL),
(15, 8, 1, 3, 25, '2021-06-21 13:06:05', NULL),
(16, 8, 1, 2, 50, '2021-06-21 13:06:32', NULL),
(17, 8, 1, 3, 25, '2021-06-21 13:06:46', NULL),
(18, 8, 2, 1, 545, '2021-06-21 13:06:31', NULL),
(19, 10, 2, 3, 520, '2021-06-21 13:06:48', 2),
(20, 8, 1, 3, 25, '2021-06-21 14:06:09', NULL),
(21, 8, 1, 3, 25, '2021-06-21 14:06:09', NULL),
(22, 8, 1, 3, 25, '2021-06-21 14:06:35', NULL),
(23, 8, 1, 3, 25, '2021-06-21 15:06:53', NULL),
(24, 8, 4, 6, 165, '2021-06-21 16:06:40', 2),
(25, 8, 4, 3, 15, '2021-06-21 16:06:52', NULL),
(26, 8, 4, 5, 28, '2021-06-21 16:06:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `layoverplanes`
--

DROP TABLE IF EXISTS `layoverplanes`;
CREATE TABLE IF NOT EXISTS `layoverplanes` (
  `idEscalaAviao` int(11) NOT NULL AUTO_INCREMENT,
  `idEscala` int(11) NOT NULL,
  `idAviao` int(11) NOT NULL,
  `numPassageiros` int(200) NOT NULL,
  `numBilhetesVendidos` int(200) NOT NULL,
  PRIMARY KEY (`idEscalaAviao`),
  KEY `idEscala` (`idEscala`),
  KEY `idAviao` (`idAviao`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `layoverplanes`
--

INSERT INTO `layoverplanes` (`idEscalaAviao`, `idEscala`, `idAviao`, `numPassageiros`, `numBilhetesVendidos`) VALUES
(3, 4, 1, 2500, 1999),
(5, 5, 1, 30, 30),
(6, 7, 1, 5000, 5000),
(7, 8, 6, 150, 150),
(8, 9, 3, 300, 300),
(9, 10, 4, 200, 200),
(10, 11, 2, 2048, 2048),
(11, 12, 1, 1024, 1024),
(12, 13, 4, 150, 150),
(13, 14, 1, 70, 70),
(14, 15, 5, 2500, 2500),
(15, 16, 3, 150, 150),
(16, 17, 4, 20, 20),
(17, 18, 3, 150, 150),
(18, 19, 2, 1000, 1000),
(19, 20, 1, 999, 999),
(20, 21, 4, 177, 177),
(21, 22, 5, 4500, 4500),
(22, 23, 6, 105, 130),
(23, 24, 1, 679, 700);

-- --------------------------------------------------------

--
-- Table structure for table `layovers`
--

DROP TABLE IF EXISTS `layovers`;
CREATE TABLE IF NOT EXISTS `layovers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idVoo` int(11) NOT NULL,
  `idAeroportoOrigem` int(11) NOT NULL,
  `idAeroportoDestino` int(11) NOT NULL,
  `dateOrigin` date NOT NULL,
  `dateEnd` date NOT NULL,
  `horaOrigin` time NOT NULL,
  `horaEnd` time NOT NULL,
  `distancia` int(11) NOT NULL,
  `numOrdem` int(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idAeroporto` (`idVoo`),
  KEY `idAeroportoDestino` (`idAeroportoDestino`),
  KEY `idAeroportoOrigem` (`idAeroportoOrigem`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `layovers`
--

INSERT INTO `layovers` (`id`, `idVoo`, `idAeroportoOrigem`, `idAeroportoDestino`, `dateOrigin`, `dateEnd`, `horaOrigin`, `horaEnd`, `distancia`, `numOrdem`) VALUES
(1, 1, 1, 5, '2021-06-21', '2021-06-22', '00:00:00', '00:00:00', 120, 5),
(3, 1, 1, 6, '2021-06-16', '2021-06-30', '22:12:00', '12:33:10', 1200, 6),
(4, 1, 1, 5, '2021-06-24', '2021-06-30', '21:12:00', '12:25:00', 1200, 9),
(5, 2, 6, 5, '2021-06-30', '2021-06-20', '05:06:40', '05:06:36', 2000, 9),
(6, 2, 1, 1, '2021-06-22', '2021-06-24', '05:06:40', '05:06:36', 160, 10),
(7, 4, 9, 8, '2021-06-22', '2021-06-23', '05:00:10', '15:00:00', 500, 50),
(8, 5, 8, 5, '2021-07-01', '2021-07-02', '16:00:05', '15:00:00', 600, 70),
(9, 6, 8, 9, '2021-07-04', '2021-07-08', '04:20:00', '01:30:00', 2500, 32),
(10, 7, 6, 5, '2021-07-05', '2021-07-10', '12:05:00', '15:00:00', 20, 87),
(11, 7, 1, 5, '2021-07-11', '2021-07-12', '16:00:05', '01:30:00', 150, 7),
(12, 8, 5, 8, '2021-07-14', '2021-07-15', '16:00:05', '15:00:00', 2000, 70),
(13, 8, 8, 1, '2021-07-26', '2021-07-28', '04:20:00', '08:00:00', 1000, 2),
(14, 9, 5, 6, '2021-07-30', '2021-07-31', '08:00:00', '08:00:00', 2000, 3),
(15, 9, 6, 9, '2021-08-01', '2021-08-02', '04:20:00', '01:30:00', 500, 70),
(16, 10, 1, 5, '2021-07-01', '2021-07-02', '08:00:00', '08:00:00', 1500, 32),
(17, 10, 5, 9, '2021-07-30', '2021-07-31', '16:00:05', '01:30:00', 1000, 70),
(18, 10, 9, 6, '2021-09-01', '2021-09-02', '08:00:00', '08:00:00', 1000, 32),
(19, 11, 9, 1, '2021-07-14', '2021-07-15', '16:00:05', '10:00:00', 2000, 6),
(20, 11, 1, 6, '2021-07-17', '2021-07-18', '08:00:00', '01:30:00', 150, 32),
(21, 11, 6, 5, '2021-07-20', '2021-07-20', '04:20:00', '15:00:00', 2000, 70),
(22, 12, 8, 9, '2021-10-05', '2021-10-06', '04:20:00', '18:00:00', 1000, 7),
(23, 12, 9, 1, '2021-10-08', '2021-10-08', '08:00:00', '15:00:00', 799, 50),
(24, 12, 1, 5, '2021-10-30', '2021-11-01', '16:00:05', '01:30:00', 150, 32);

-- --------------------------------------------------------

--
-- Table structure for table `planes`
--

DROP TABLE IF EXISTS `planes`;
CREATE TABLE IF NOT EXISTS `planes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `referencia` varchar(20) NOT NULL,
  `lotacao` int(11) NOT NULL,
  `tipoAviao` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `planes`
--

INSERT INTO `planes` (`id`, `referencia`, `lotacao`, `tipoAviao`) VALUES
(1, 'AB125', 1024, 'AIRB&B'),
(2, 'AR240', 2048, 'R&R123'),
(3, 'J35-A2', 300, 'Leve'),
(4, 'S41-J', 200, 'SAW'),
(5, 'F40-75D', 5000, 'Big Chungus'),
(6, 'F4B-50', 150, 'TL-50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) NOT NULL,
  `morada` varchar(100) NOT NULL,
  `email` varchar(60) NOT NULL,
  `nif` varchar(9) NOT NULL,
  `telefone` varchar(9) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `role` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nome`, `morada`, `email`, `nif`, `telefone`, `username`, `password`, `role`) VALUES
(1, 'Alex', 'morada', 'alex@hotmail.com', '123456789', '916073037', 'Alex', '123456789$xD', 'admin'),
(2, 'opcheckin', 'opcheckin', 'opcheckin@opcheckin.com', '987654321', '265887845', 'opcheckin', '123456789$xD', 'opcheckin'),
(6, 'gestorVoo', 'gestorVo1', 'gestorVoo@gestorVoo.com', '123654875', '235469879', 'gestorVoo', 'gestorVoo(#3E', 'gestorvoo'),
(8, 'Afonso', 'debaixo da ponte ', 'afonso@afonso.com', '694206942', '420699642', 'Afonso', '123456789$xD', 'passageiro'),
(9, 'passageiro', 'passageiro', 'passageiro@gmail.com', '123456789', '915823265', 'passageiro', '123Er&123', 'passageiro'),
(10, 'le derp', 'old memes', 'lederp@gmail.com', '123456789', '921831833', 'le_derp', '123456789DerpÂ§', 'passageiro');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `flights`
--
ALTER TABLE `flights`
  ADD CONSTRAINT `flights_ibfk_1` FOREIGN KEY (`idaeroportoorigem`) REFERENCES `airports` (`id`),
  ADD CONSTRAINT `flights_ibfk_2` FOREIGN KEY (`idaeroportodestino`) REFERENCES `airports` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `flightsales`
--
ALTER TABLE `flightsales`
  ADD CONSTRAINT `flightsales_ibfk_1` FOREIGN KEY (`idVooIda`) REFERENCES `flights` (`id`),
  ADD CONSTRAINT `flightsales_ibfk_2` FOREIGN KEY (`idVooVolta`) REFERENCES `flights` (`id`),
  ADD CONSTRAINT `flightsales_ibfk_3` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `flightsales_ibfk_4` FOREIGN KEY (`registoCheckIn`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `layoverplanes`
--
ALTER TABLE `layoverplanes`
  ADD CONSTRAINT `layoverplanes_ibfk_1` FOREIGN KEY (`idEscala`) REFERENCES `layovers` (`id`),
  ADD CONSTRAINT `layoverplanes_ibfk_2` FOREIGN KEY (`idAviao`) REFERENCES `planes` (`id`);

--
-- Constraints for table `layovers`
--
ALTER TABLE `layovers`
  ADD CONSTRAINT `layovers_ibfk_1` FOREIGN KEY (`idAeroportoDestino`) REFERENCES `airports` (`id`),
  ADD CONSTRAINT `layovers_ibfk_2` FOREIGN KEY (`idAeroportoOrigem`) REFERENCES `airports` (`id`),
  ADD CONSTRAINT `layovers_ibfk_3` FOREIGN KEY (`idVoo`) REFERENCES `flights` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
