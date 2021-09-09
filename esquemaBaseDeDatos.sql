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

INSERT INTO `usuario` VALUES (1,'admin','admin','Sergio','Escobar');

INSERT INTO `gestion` VALUES (1,'Arreglo de pago',0,1,'2021-09-08'),(2,'Cancelacion',0,1,'2021-09-08'),(3,'Compra',0,1,'2021-09-08'),(4,'Nuevo Servicio',0,1,'2021-09-08'),(5,'Reclamo',0,1,'2021-09-08'),(6,'Renovacion',0,1,'2021-09-08'),(7,'Soporte Tecnico',1,1,'2021-09-08'),(8,'Devolucion',0,1,'2021-09-08'),(9,'Consulta',0,1,'2021-09-08'),(10,'Reemplazo',1,1,'2021-09-08');

INSERT INTO `gestioncliente` VALUES (3,1,1,'2021-08-09'),(4,2,1,'2021-09-09'),(5,2,1,'2021-09-09'),(6,2,1,'2021-09-09'),(11,6,1,'2021-09-09'),(12,6,1,'2021-09-09'),(13,7,1,'2021-09-09'),(14,2,1,'2021-09-09'),(15,4,1,'2021-09-09'),(16,7,1,'2021-09-09'),(17,10,0,'2021-09-09'),(18,4,1,'2021-09-09'),(19,8,1,'2021-09-09'),(20,1,0,'2021-09-09'),(21,4,0,'2021-09-09'),(22,5,0,'2021-09-09'),(23,3,1,'2021-09-09'),(24,8,1,'2021-09-09');

INSERT INTO `tiket` VALUES (1,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,6,'Alfredo','Escobar','Villa Sol','8422-00xx',1,'Quiere hacer un arreglo de pago','Yo no quiero'),(5,19,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,18,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,11,'Marisol','Casetellon','18 de Mayo primera etapa','8465-xxxx',6,'Quiere renovar.','Que bueno, no?'),(8,12,'Marlon','Mendieta','Santa Rosa','8577-xxxx',6,'Quiere renovar.','Uno mas, ya son dos.'),(9,13,'Jorge','Leiba','Bo. Adolfo Reyes','7123-xxxx',7,'No tiene internet desde hace tres dias','El modem estaba desconectado.'),(10,14,'Isabel','Estrada','El dorado','7928-xxx',2,'Su contrato se ha vencido y quiere cancelar.','Su servicio fue dado de baja.'),(11,15,'Jose','Hernandez','Sanjuan del Sur','8613-xxxx',4,'Desea contratar el servicio de internet.','Su contrato ha sido completado.'),(12,24,'Marcela','Montano','Carretera a Masaya','7912-xxx',8,'Devolucion','Devolucion'),(13,16,'Dylan','Idiaquez','Villa livertad','8713-xxxx',1,'Arreglo de pago','Arreglo de pago'),(14,23,'Melvin','Valladarez','Villa Livertad','7234-xxxx',3,'Compra','Compra');


