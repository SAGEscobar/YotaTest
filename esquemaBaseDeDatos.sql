-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema gestiontikets
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema gestiontikets
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `gestiontikets` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci ;
USE `gestiontikets` ;

-- -----------------------------------------------------
-- Table `gestiontikets`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestiontikets`.`usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(45) NOT NULL,
  `password` VARCHAR(200) NOT NULL,
  `nombreUsuario` VARCHAR(70) NOT NULL,
  `apellidoUsuario` VARCHAR(70) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `idUsuario_index` (`id` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `gestiontikets`.`gestion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestiontikets`.`gestion` (
  `idgestion` INT NOT NULL AUTO_INCREMENT,
  `nombreGestion` VARCHAR(70) NOT NULL,
  `aplicaVisitaTecnica` TINYINT NOT NULL,
  `idUsuario` INT NOT NULL,
  `fechaCreacion` DATE NOT NULL,
  PRIMARY KEY (`idgestion`),
  INDEX `creadorGestion_FK_idx` (`idUsuario` ASC) VISIBLE,
  INDEX `idGestion_index` (`idgestion` ASC) VISIBLE,
  CONSTRAINT `creadorGestion_FK`
    FOREIGN KEY (`idUsuario`)
    REFERENCES `gestiontikets`.`usuario` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 11
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `gestiontikets`.`gestioncliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestiontikets`.`gestioncliente` (
  `idGestionCliente` INT NOT NULL AUTO_INCREMENT,
  `idGestion` INT NOT NULL,
  `atendido` TINYINT NOT NULL,
  `fechaCreacion` DATE NOT NULL,
  PRIMARY KEY (`idGestionCliente`),
  INDEX `gestion_index` (`idGestion` ASC) VISIBLE,
  INDEX `idGestionCliente` (`idGestionCliente` ASC) VISIBLE,
  CONSTRAINT `idGestion_fk`
    FOREIGN KEY (`idGestion`)
    REFERENCES `gestiontikets`.`gestion` (`idgestion`))
ENGINE = InnoDB
AUTO_INCREMENT = 25
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `gestiontikets`.`tiket`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestiontikets`.`tiket` (
  `idTiket` INT NOT NULL AUTO_INCREMENT,
  `idGestionCliente` INT NOT NULL,
  `nombreCliente` VARCHAR(70) NULL DEFAULT NULL,
  `apellidoCliente` VARCHAR(70) NULL DEFAULT NULL,
  `direccionCliente` VARCHAR(200) NULL DEFAULT NULL,
  `telefonoCliente` VARCHAR(20) NULL DEFAULT NULL,
  `idGestion` INT NULL DEFAULT NULL,
  `problemaExpuesto` LONGTEXT NULL DEFAULT NULL,
  `solucionBrindada` LONGTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`idTiket`),
  INDEX `idGestionCliente_fk_idx` (`idGestionCliente` ASC) VISIBLE,
  INDEX `idGestion_tiket_fk_idx` (`idGestion` ASC) VISIBLE,
  CONSTRAINT `idGestion_tiket_fk`
    FOREIGN KEY (`idGestion`)
    REFERENCES `gestiontikets`.`gestion` (`idgestion`),
  CONSTRAINT `idGestionCliente_fk`
    FOREIGN KEY (`idGestionCliente`)
    REFERENCES `gestiontikets`.`gestioncliente` (`idGestionCliente`))
ENGINE = InnoDB
AUTO_INCREMENT = 15
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
