-- MySQL Script generated by MySQL Workbench
-- 06/16/15 16:27:09
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema estacionamento
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `estacionamento` ;

-- -----------------------------------------------------
-- Schema estacionamento
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `estacionamento` ;
USE `estacionamento` ;

-- -----------------------------------------------------
-- Table `estacionamento`.`vaga`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `estacionamento`.`vaga` ;

CREATE TABLE IF NOT EXISTS `estacionamento`.`vaga` (
  `id_vaga` INT(11) NOT NULL AUTO_INCREMENT,
  `nro_vaga` VARCHAR(50) NOT NULL COMMENT 'tempo em de estacionamento',
  `descricao` VARCHAR(100) NOT NULL COMMENT 'o custo em relação ao tempo',
  `tipo` VARCHAR(45) NULL,
  PRIMARY KEY (`id_vaga`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'Table storing all customers. Holds foreign keys to the addre' /* comment truncated */ /*s table and the store table where this customer is registered.

Basic information about the customer like first and last name are stored in the table itself. Same for the date the record was created and when the information was last updated.*/;


-- -----------------------------------------------------
-- Table `estacionamento`.`cliente`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `estacionamento`.`cliente` ;

CREATE TABLE IF NOT EXISTS `estacionamento`.`cliente` (
  `id_cliente` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(50) NOT NULL COMMENT 'tempo em de estacionamento',
  `cpf_cnpj` VARCHAR(30) NOT NULL COMMENT 'o custo em relação ao tempo',
  `email` VARCHAR(45) NULL,
  `logradouro` VARCHAR(45) NULL,
  `nro` INT NULL,
  `cep` VARCHAR(45) NULL,
  `bairro` VARCHAR(45) NULL,
  `cidade` VARCHAR(45) NULL,
  `estado` VARCHAR(45) NULL,
  `telefone` VARCHAR(45) NULL,
  PRIMARY KEY (`id_cliente`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'Table storing all customers. Holds foreign keys to the addre' /* comment truncated */ /*s table and the store table where this customer is registered.

Basic information about the customer like first and last name are stored in the table itself. Same for the date the record was created and when the information was last updated.*/;


-- -----------------------------------------------------
-- Table `estacionamento`.`estacionamento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `estacionamento`.`estacionamento` ;

CREATE TABLE IF NOT EXISTS `estacionamento`.`estacionamento` (
  `id_estacionamento` INT(11) NOT NULL AUTO_INCREMENT,
  `dh_entrada` VARCHAR(100) NOT NULL COMMENT 'o custo em relação ao tempo',
  `dh_saida` VARCHAR(45) NULL,
  `nro_vaga` VARCHAR(45) NULL,
  `vaga_id_vaga` INT(11) NOT NULL,
  `cliente_id_cliente` INT(11) NOT NULL,
  `status` INT NULL,
  `token` CHAR(6) NOT NULL,
  PRIMARY KEY (`id_estacionamento`),
  INDEX `fk_estacionamento_vaga1_idx` (`vaga_id_vaga` ASC),
  INDEX `fk_estacionamento_cliente1_idx` (`cliente_id_cliente` ASC),
  UNIQUE INDEX `token_UNIQUE` (`token` ASC),
  CONSTRAINT `fk_estacionamento_vaga1`
    FOREIGN KEY (`vaga_id_vaga`)
    REFERENCES `estacionamento`.`vaga` (`id_vaga`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_estacionamento_cliente1`
    FOREIGN KEY (`cliente_id_cliente`)
    REFERENCES `estacionamento`.`cliente` (`id_cliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'Table storing all customers. Holds foreign keys to the addre' /* comment truncated */ /*s table and the store table where this customer is registered.

Basic information about the customer like first and last name are stored in the table itself. Same for the date the record was created and when the information was last updated.*/;


-- -----------------------------------------------------
-- Table `estacionamento`.`plano`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `estacionamento`.`plano` ;

CREATE TABLE IF NOT EXISTS `estacionamento`.`plano` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `horas` INT NOT NULL COMMENT 'tempo em de estacionamento',
  `valor` DOUBLE NOT NULL COMMENT 'o custo em relação ao tempo',
  `valor_exente` DOUBLE NULL,
  `descr` VARCHAR(45) NULL,
  `observacao` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'Table storing all customers. Holds foreign keys to the addre' /* comment truncated */ /*s table and the store table where this customer is registered.

Basic information about the customer like first and last name are stored in the table itself. Same for the date the record was created and when the information was last updated.*/;


-- -----------------------------------------------------
-- Table `estacionamento`.`plano_contratado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `estacionamento`.`plano_contratado` ;

CREATE TABLE IF NOT EXISTS `estacionamento`.`plano_contratado` (
  `id_cliente` INT(11) NOT NULL,
  `cliente_id_cliente` INT(11) NOT NULL,
  `plano_id_plano` INT(11) NOT NULL,
  `data_contrato` DATE NULL,
  `observacao` VARCHAR(45) NULL,
  PRIMARY KEY (`id_cliente`, `cliente_id_cliente`, `plano_id_plano`),
  INDEX `fk_plano_contratado_cliente1_idx` (`cliente_id_cliente` ASC),
  INDEX `fk_plano_contratado_plano1_idx` (`plano_id_plano` ASC),
  CONSTRAINT `fk_plano_contratado_cliente1`
    FOREIGN KEY (`cliente_id_cliente`)
    REFERENCES `estacionamento`.`cliente` (`id_cliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_plano_contratado_plano1`
    FOREIGN KEY (`plano_id_plano`)
    REFERENCES `estacionamento`.`plano` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'Table storing all customers. Holds foreign keys to the addre' /* comment truncated */ /*s table and the store table where this customer is registered.

Basic information about the customer like first and last name are stored in the table itself. Same for the date the record was created and when the information was last updated.*/;


-- -----------------------------------------------------
-- Table `estacionamento`.`mensalidade`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `estacionamento`.`mensalidade` ;

CREATE TABLE IF NOT EXISTS `estacionamento`.`mensalidade` (
  `id_mensalidade` INT(11) NOT NULL AUTO_INCREMENT,
  `ano` VARCHAR(100) NOT NULL COMMENT 'o custo em relação ao tempo',
  `mes` VARCHAR(45) NULL,
  `val_plano` DOUBLE NULL,
  `val_execed` DOUBLE NULL,
  `cliente_id_cliente` INT(11) NOT NULL,
  PRIMARY KEY (`id_mensalidade`, `cliente_id_cliente`),
  INDEX `fk_mensalidade_cliente1_idx` (`cliente_id_cliente` ASC),
  CONSTRAINT `fk_mensalidade_cliente1`
    FOREIGN KEY (`cliente_id_cliente`)
    REFERENCES `estacionamento`.`cliente` (`id_cliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'Table storing all customers. Holds foreign keys to the addre' /* comment truncated */ /*s table and the store table where this customer is registered.

Basic information about the customer like first and last name are stored in the table itself. Same for the date the record was created and when the information was last updated.*/;


-- -----------------------------------------------------
-- Table `estacionamento`.`usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `estacionamento`.`usuario` ;

CREATE TABLE IF NOT EXISTS `estacionamento`.`usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `senha` VARCHAR(45) NOT NULL,
  `login` VARCHAR(45) NOT NULL,
  `cliente_id_cliente` INT(11) NOT NULL,
  PRIMARY KEY (`id`, `cliente_id_cliente`),
  INDEX `fk_usuario_cliente1_idx` (`cliente_id_cliente` ASC),
  CONSTRAINT `fk_usuario_cliente1`
    FOREIGN KEY (`cliente_id_cliente`)
    REFERENCES `estacionamento`.`cliente` (`id_cliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
