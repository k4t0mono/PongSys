-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema PongSys
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `PongSys` ;

-- -----------------------------------------------------
-- Schema PongSys
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `PongSys` DEFAULT CHARACTER SET utf8 ;
USE `PongSys` ;

-- -----------------------------------------------------
-- Table `PongSys`.`Equipe`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PongSys`.`Equipe` (
  `idEquipe` INT NOT NULL AUTO_INCREMENT,
  `nomeEquipe` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idEquipe`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PongSys`.`Partida`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PongSys`.`Partida` (
  `idPartida` INT NOT NULL AUTO_INCREMENT,
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
-- Table `PongSys`.`Jogador`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PongSys`.`Jogador` (
  `email` VARCHAR(45) NOT NULL,
  `idEquipe` INT NOT NULL,
  `nickname` VARCHAR(45) NOT NULL,
  `nome` VARCHAR(45) NOT NULL,
  `senha` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`email`),
  INDEX `fk_Jogador_Equipe1_idx` (`idEquipe` ASC),
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
  `idPartida` INT NOT NULL,
  `email_jogador` VARCHAR(45) NOT NULL,
  `eliminações` INT NOT NULL,
  `mortes` INT NOT NULL,
  `assistencias` INT NOT NULL,
  PRIMARY KEY (`idPartida`, `email_jogador`),
  INDEX `fk_Desempenho_Partida1_idx` (`idPartida` ASC),
  INDEX `fk_Desempenho_Jogador1_idx` (`email_jogador` ASC),
  CONSTRAINT `fk_Desempenho_Partida1`
    FOREIGN KEY (`idPartida`)
    REFERENCES `PongSys`.`Partida` (`idPartida`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Desempenho_Jogador1`
    FOREIGN KEY (`email_jogador`)
    REFERENCES `PongSys`.`Jogador` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PongSys`.`Organizador`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PongSys`.`Organizador` (
  `email` VARCHAR(45) NOT NULL,
  `senha` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`email`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
