-- MySQL Script generated by MySQL Workbench
-- Qui 25 Jan 2018 00:53:35 -02
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema PongSys
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema PongSys
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `PongSys` DEFAULT CHARACTER SET utf8 ;
USE `PongSys` ;

-- -----------------------------------------------------
-- Table `PongSys`.`Equipe`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PongSys`.`Equipe` (
  `idEquipe` INT NOT NULL,
  `nomeEquipe` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idEquipe`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PongSys`.`Partida`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PongSys`.`Partida` (
  `idPartida` INT NOT NULL,
  `equipe1` INT NOT NULL,
  `equipe2` INT NOT NULL,
  `data` DATE NOT NULL,
  `estado` INT NOT NULL,
  `resultado` VARCHAR(45) NULL,
  PRIMARY KEY (`idPartida`),
  INDEX `fk_Partidas_Equipes1_idx` (`equipe1` ASC),
  INDEX `fk_Partidas_Equipes2_idx` (`equipe2` ASC),
  CONSTRAINT `fk_Partidas_Equipes1`
    FOREIGN KEY (`equipe1`)
    REFERENCES `PongSys`.`Equipe` (`idEquipe`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Partidas_Equipes2`
    FOREIGN KEY (`equipe2`)
    REFERENCES `PongSys`.`Equipe` (`idEquipe`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PongSys`.`Partidas_has_Equipes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PongSys`.`Partidas_has_Equipes` (
  `Partidas_idPartidas` INT NOT NULL,
  `Equipes_token` INT NOT NULL,
  PRIMARY KEY (`Partidas_idPartidas`, `Equipes_token`),
  INDEX `fk_Partidas_has_Equipes_Equipes1_idx` (`Equipes_token` ASC),
  INDEX `fk_Partidas_has_Equipes_Partidas1_idx` (`Partidas_idPartidas` ASC),
  CONSTRAINT `fk_Partidas_has_Equipes_Partidas1`
    FOREIGN KEY (`Partidas_idPartidas`)
    REFERENCES `PongSys`.`Partida` (`idPartida`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Partidas_has_Equipes_Equipes1`
    FOREIGN KEY (`Equipes_token`)
    REFERENCES `PongSys`.`Equipe` (`idEquipe`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PongSys`.`Pessoa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PongSys`.`Pessoa` (
  `idPessoa` INT NOT NULL,
  `nickname` VARCHAR(45) NOT NULL,
  `nome` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `senha` VARCHAR(45) NOT NULL,
  `ehOrganizador` TINYINT(1) NOT NULL,
  PRIMARY KEY (`idPessoa`),
  UNIQUE INDEX `nickname_UNIQUE` (`nickname` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PongSys`.`Jogador`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PongSys`.`Jogador` (
  `idJogador` INT NOT NULL,
  `idEquipe` INT NOT NULL,
  PRIMARY KEY (`idJogador`),
  INDEX `fk_Jogador_Equipe1_idx` (`idEquipe` ASC),
  CONSTRAINT `fk_Jogador_Pessoa1`
    FOREIGN KEY (`idJogador`)
    REFERENCES `PongSys`.`Pessoa` (`idPessoa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Jogador_Equipe1`
    FOREIGN KEY (`idEquipe`)
    REFERENCES `PongSys`.`Equipe` (`idEquipe`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PongSys`.`Desempenho`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PongSys`.`Desempenho` (
  `idJogador` INT NOT NULL,
  `idPartida` INT NOT NULL,
  `eliminações` INT NOT NULL,
  `mortes` INT NOT NULL,
  `assistencias` INT NOT NULL,
  PRIMARY KEY (`idJogador`, `idPartida`),
  INDEX `fk_Desempenho_Partida1_idx` (`idPartida` ASC),
  CONSTRAINT `fk_Desempenho_Jogador1`
    FOREIGN KEY (`idJogador`)
    REFERENCES `PongSys`.`Jogador` (`idJogador`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Desempenho_Partida1`
    FOREIGN KEY (`idPartida`)
    REFERENCES `PongSys`.`Partida` (`idPartida`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;