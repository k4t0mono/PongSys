-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 29, 2018 at 01:14 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `PongSys`
--

-- -----------------------------------------------------
-- Schema PongSys
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `PongSys` ;

-- -----------------------------------------------------
-- Schema PongSys
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `PongSys` DEFAULT CHARACTER SET utf8 ;
USE `PongSys` ;

-- --------------------------------------------------------

--
-- Table structure for table `Desempenho`
--

CREATE TABLE `Desempenho` (
  `idPartida` int(11) NOT NULL,
  `email_jogador` varchar(45) NOT NULL,
  `eliminações` int(11) NOT NULL,
  `mortes` int(11) NOT NULL,
  `assistencias` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Desempenho`
--

INSERT INTO `Desempenho` (`idPartida`, `email_jogador`, `eliminações`, `mortes`, `assistencias`) VALUES
(2, 'maul@sw.io', 1, 0, 0),
(2, 'obi@sw.io', 1, 0, 1),
(2, 'qgj@sw.io', 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Equipe`
--

CREATE TABLE `Equipe` (
  `idEquipe` int(11) NOT NULL,
  `nomeEquipe` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Equipe`
--

INSERT INTO `Equipe` (`idEquipe`, `nomeEquipe`) VALUES
(1, 'Malachor'),
(2, 'Dantooine');

-- --------------------------------------------------------

--
-- Table structure for table `Jogador`
--

CREATE TABLE `Jogador` (
  `email` varchar(45) NOT NULL,
  `idEquipe` int(11) NOT NULL,
  `nickname` varchar(45) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `senha` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Jogador`
--

INSERT INTO `Jogador` (`email`, `idEquipe`, `nickname`, `nome`, `senha`) VALUES
('grad.inq@sw.io', 1, 'Imp', 'Grand Inquisitor', '123'),
('maul@sw.io', 1, 'Maul', 'Darth Maul', '123'),
('obi@sw.io', 2, 'ben_kenobi', 'Obi-Wan Kenobi', '123'),
('qgj@sw.io', 2, 'qg_jin', 'Qui Gon Jinn', '123');

-- --------------------------------------------------------

--
-- Table structure for table `Organizador`
--

CREATE TABLE `Organizador` (
  `email` varchar(45) NOT NULL,
  `senha` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Organizador`
--

INSERT INTO `Organizador` (`email`, `senha`) VALUES
('root@root.io', 'root');


-- --------------------------------------------------------

--
-- Table structure for table `Partida`
--

CREATE TABLE `Partida` (
  `idPartida` int(11) NOT NULL,
  `equipe1` int(11) NOT NULL,
  `equipe2` int(11) NOT NULL,
  `data` date NOT NULL,
  `estado` int(11) NOT NULL,
  `resultado` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Partida`
--

INSERT INTO `Partida` (`idPartida`, `equipe1`, `equipe2`, `data`, `estado`, `resultado`) VALUES
(1, 1, 2, '2018-01-28', 0, '1'),
(2, 2, 1, '2018-01-26', 2, '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Desempenho`
--
ALTER TABLE `Desempenho`
  ADD PRIMARY KEY (`idPartida`,`email_jogador`),
  ADD KEY `fk_Desempenho_Partida1_idx` (`idPartida`),
  ADD KEY `fk_Desempenho_Jogador1_idx` (`email_jogador`);

--
-- Indexes for table `Equipe`
--
ALTER TABLE `Equipe`
  ADD PRIMARY KEY (`idEquipe`);

--
-- Indexes for table `Jogador`
--
ALTER TABLE `Jogador`
  ADD PRIMARY KEY (`email`),
  ADD KEY `fk_Jogador_Equipe1_idx` (`idEquipe`);

--
-- Indexes for table `Organizador`
--
ALTER TABLE `Organizador`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `Partida`
--
ALTER TABLE `Partida`
  ADD PRIMARY KEY (`idPartida`),
  ADD KEY `fk_Partidas_Equipes1_idx` (`equipe1`),
  ADD KEY `fk_Partidas_Equipes2_idx` (`equipe2`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Equipe`
--
ALTER TABLE `Equipe`
  MODIFY `idEquipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Partida`
--
ALTER TABLE `Partida`
  MODIFY `idPartida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Desempenho`
--
ALTER TABLE `Desempenho`
  ADD CONSTRAINT `fk_Desempenho_Jogador1` FOREIGN KEY (`email_jogador`) REFERENCES `Jogador` (`email`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Desempenho_Partida1` FOREIGN KEY (`idPartida`) REFERENCES `Partida` (`idPartida`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `Jogador`
--
ALTER TABLE `Jogador`
  ADD CONSTRAINT `fk_Jogador_Equipe1` FOREIGN KEY (`idEquipe`) REFERENCES `Equipe` (`idEquipe`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `Partida`
--
ALTER TABLE `Partida`
  ADD CONSTRAINT `fk_Partidas_Equipes1` FOREIGN KEY (`equipe1`) REFERENCES `Equipe` (`idEquipe`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Partidas_Equipes2` FOREIGN KEY (`equipe2`) REFERENCES `Equipe` (`idEquipe`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
