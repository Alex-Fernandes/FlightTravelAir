-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 14-Jun-2021 às 23:31
-- Versão do servidor: 5.7.24
-- versão do PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
-- Estrutura da tabela `airports`
--

DROP TABLE IF EXISTS `airports`;
CREATE TABLE IF NOT EXISTS `airports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `pais` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `airports`
--

INSERT INTO `airports` (`id`, `nome`, `cidade`, `pais`) VALUES
(1, 'Aeroporto da Madeira', 'Madeira', 'Portugal Continental'),
(5, 'aero teste', 'teaste', 'tesate'),
(6, 'Aeroporto Alcobaca', 'Alcobaça', 'Portugal');

-- --------------------------------------------------------

--
-- Estrutura da tabela `flights`
--

DROP TABLE IF EXISTS `flights`;
CREATE TABLE IF NOT EXISTS `flights` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idaeroporto` int(11) NOT NULL,
  `precoVenda` decimal(7,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idEscala` (`idaeroporto`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `flights`
--

INSERT INTO `flights` (`id`, `idaeroporto`, `precoVenda`) VALUES
(1, 1, '25.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `flightsales`
--

DROP TABLE IF EXISTS `flightsales`;
CREATE TABLE IF NOT EXISTS `flightsales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) NOT NULL,
  `idVooIda` int(11) NOT NULL,
  `idVooVolta` int(11) NOT NULL,
  `precoPago` int(11) NOT NULL,
  `dataCompra` datetime NOT NULL,
  `registoCheckIn` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idUser` (`idUser`),
  KEY `idVooIda` (`idVooIda`),
  KEY `idVooVolta` (`idVooVolta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `layoverplanes`
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `layoverplanes`
--

INSERT INTO `layoverplanes` (`idEscalaAviao`, `idEscala`, `idAviao`, `numPassageiros`, `numBilhetesVendidos`) VALUES
(1, 1, 1, 1000, 525),
(2, 1, 2, 2500, 1999);

-- --------------------------------------------------------

--
-- Estrutura da tabela `layovers`
--

DROP TABLE IF EXISTS `layovers`;
CREATE TABLE IF NOT EXISTS `layovers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idVoo` int(11) NOT NULL,
  `idAeroportoDestino` int(11) NOT NULL,
  `idAeroportoOrigem` int(11) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `layovers`
--

INSERT INTO `layovers` (`id`, `idVoo`, `idAeroportoDestino`, `idAeroportoOrigem`, `dateOrigin`, `dateEnd`, `horaOrigin`, `horaEnd`, `distancia`, `numOrdem`) VALUES
(1, 1, 5, 1, '2021-06-21', '2021-06-22', '00:00:00', '00:00:00', 120, 5),
(3, 1, 6, 1, '2021-06-16', '2021-06-14', '22:12:00', '12:33:10', 1200, 6),
(4, 1, 5, 1, '2021-06-24', '2021-06-14', '21:12:00', '12:25:00', 1200, 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `planes`
--

DROP TABLE IF EXISTS `planes`;
CREATE TABLE IF NOT EXISTS `planes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `referencia` varchar(20) NOT NULL,
  `lotacao` int(11) NOT NULL,
  `tipoAviao` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `planes`
--

INSERT INTO `planes` (`id`, `referencia`, `lotacao`, `tipoAviao`) VALUES
(1, 'AB125', 1024, 'AIRB&B'),
(2, 'AR240', 2048, 'R&R123');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `nome`, `morada`, `email`, `nif`, `telefone`, `username`, `password`, `role`) VALUES
(1, 'Alex', 'morada', 'alex@hotmail.com', '123456789', '916073037', 'Alex', '123456789', 'admin'),
(2, 'opcheckin', 'opcheckin', 'opcheckin@opcheckin.com', '987654321', '265887845', 'opcheckin', '123456789', 'opcheckin'),
(6, 'gestorVoo', 'gestorVo1', 'gestorVoo@gestorVoo.com', '123654875', '235469879', 'gestorVoo', 'gestorVoo(#3E', 'gestorvoo'),
(8, 'Afonso', 'debaixo da ponte ', 'afonso@afonso.com', '694206942', '420699642', 'Afonso', '123456789()E#_s', 'admin');

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `flights`
--
ALTER TABLE `flights`
  ADD CONSTRAINT `flights_ibfk_1` FOREIGN KEY (`idaeroporto`) REFERENCES `airports` (`id`);

--
-- Limitadores para a tabela `flightsales`
--
ALTER TABLE `flightsales`
  ADD CONSTRAINT `flightsales_ibfk_1` FOREIGN KEY (`idVooIda`) REFERENCES `flights` (`id`),
  ADD CONSTRAINT `flightsales_ibfk_2` FOREIGN KEY (`idVooVolta`) REFERENCES `flights` (`id`),
  ADD CONSTRAINT `flightsales_ibfk_3` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `layoverplanes`
--
ALTER TABLE `layoverplanes`
  ADD CONSTRAINT `layoverplanes_ibfk_1` FOREIGN KEY (`idEscala`) REFERENCES `layovers` (`id`),
  ADD CONSTRAINT `layoverplanes_ibfk_2` FOREIGN KEY (`idAviao`) REFERENCES `planes` (`id`);

--
-- Limitadores para a tabela `layovers`
--
ALTER TABLE `layovers`
  ADD CONSTRAINT `layovers_ibfk_1` FOREIGN KEY (`idAeroportoDestino`) REFERENCES `airports` (`id`),
  ADD CONSTRAINT `layovers_ibfk_2` FOREIGN KEY (`idAeroportoOrigem`) REFERENCES `airports` (`id`),
  ADD CONSTRAINT `layovers_ibfk_3` FOREIGN KEY (`idVoo`) REFERENCES `flights` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
