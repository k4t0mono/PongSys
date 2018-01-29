-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `mydb` ;

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`Equipe`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Equipe` (
  `idEquipe` INT NOT NULL AUTO_INCREMENT,
  `nomeEquipe` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idEquipe`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Partida`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Partida` (
  `idPartida` INT NOT NULL AUTO_INCREMENT,
  `equipe1` INT NOT NULL,
  `equipe2` INT NOT NULL,
  `data` DATE NOT NULL,
  `estado` INT NOT NULL,
  `resultado` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idPartida`),
  INDEX `fk_Partidas_Equipes1_idx` (`equipe1` ASC),
  INDEX `fk_Partidas_Equipes2_idx` (`equipe2` ASC),
  CONSTRAINT `fk_Partidas_Equipes1`
    FOREIGN KEY (`equipe1`)
    REFERENCES `mydb`.`Equipe` (`idEquipe`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Partidas_Equipes2`
    FOREIGN KEY (`equipe2`)
    REFERENCES `mydb`.`Equipe` (`idEquipe`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Jogador`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Jogador` (
  `email` VARCHAR(45) NOT NULL,
  `idEquipe` INT NOT NULL,
  `nickname` VARCHAR(45) NOT NULL,
  `nome` VARCHAR(45) NOT NULL,
  `senha` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`email`),
  INDEX `fk_Jogador_Equipe1_idx` (`idEquipe` ASC),
  CONSTRAINT `fk_Jogador_Equipe1`
    FOREIGN KEY (`idEquipe`)
    REFERENCES `mydb`.`Equipe` (`idEquipe`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Desempenho`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Desempenho` (
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
    REFERENCES `mydb`.`Partida` (`idPartida`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Desempenho_Jogador1`
    FOREIGN KEY (`email_jogador`)
    REFERENCES `mydb`.`Jogador` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Organizador`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Organizador` (
  `email` VARCHAR(45) NOT NULL,
  `senha` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`email`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
