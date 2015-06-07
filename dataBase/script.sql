-- MySQL Script generated by MySQL Workbench
-- 06/07/15 17:03:41
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
-- Table `estacionamento`.`vehicle`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `estacionamento`.`vehicle` ;

CREATE TABLE IF NOT EXISTS `estacionamento`.`vehicle` (
  `vehicle_id` INT(11) NOT NULL AUTO_INCREMENT,
  `plate` VARCHAR(50) NOT NULL,
  `name` VARCHAR(50) NULL,
  `fabricator` VARCHAR(20) NULL DEFAULT NULL,
  `model` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`vehicle_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `estacionamento`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `estacionamento`.`user` ;

CREATE TABLE IF NOT EXISTS `estacionamento`.`user` (
  `user_id` INT(11) NOT NULL COMMENT 'O id do usuário será o seu CPF ou CNPJ',
  `first_name` VARCHAR(50) NOT NULL,
  `last_name` VARCHAR(50) NOT NULL,
  `type` VARCHAR(50) NOT NULL COMMENT 'Identifica a pessoa física ou juridica',
  `phone` VARCHAR(45) NULL,
  `category` VARCHAR(45) NULL COMMENT 'identifica a categoria: cliente ou administrador',
  `cash_money` VARCHAR(45) NULL DEFAULT NULL COMMENT 'o valor que ele possui de creditos',
  `city` VARCHAR(45) NULL,
  `country` VARCHAR(45) NULL,
  `address` VARCHAR(45) NULL,
  PRIMARY KEY (`user_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `estacionamento`.`plane_vehicle`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `estacionamento`.`plane_vehicle` ;

CREATE TABLE IF NOT EXISTS `estacionamento`.`plane_vehicle` (
  `plane_vehicle_id` INT(11) NOT NULL AUTO_INCREMENT,
  `date_input` DATETIME NULL DEFAULT NULL COMMENT 'data de entrada e hora',
  `date_output` DATETIME NULL DEFAULT NULL COMMENT 'Data da saida e hora',
  `user_id` INT(11) NOT NULL,
  `vehicle_id` INT(11) NOT NULL,
  `parking_space_id` INT(11) NOT NULL,
  `parking_space_cost_id` INT(11) NOT NULL,
  `cust` FLOAT NOT NULL COMMENT 'custo normal da vaga',
  `cust_time_over` FLOAT NULL COMMENT 'adicional de mustas',
  PRIMARY KEY (`plane_vehicle_id`, `user_id`, `vehicle_id`, `parking_space_id`, `parking_space_cost_id`),
  INDEX `fk_user_vehicle_usuario1_idx` (`user_id` ASC),
  INDEX `fk_user_vehicle_vehicle1_idx` (`vehicle_id` ASC),
  CONSTRAINT `fk_user_vehicle_usuario1`
    FOREIGN KEY (`user_id`)
    REFERENCES `estacionamento`.`user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_vehicle_vehicle1`
    FOREIGN KEY (`vehicle_id`)
    REFERENCES `estacionamento`.`vehicle` (`vehicle_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `estacionamento`.`user_vehicle`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `estacionamento`.`user_vehicle` ;

CREATE TABLE IF NOT EXISTS `estacionamento`.`user_vehicle` (
  `user_space_id` INT(11) NOT NULL,
  `vehicle_id` INT(11) NOT NULL,
  `user_id` INT(11) NOT NULL,
  PRIMARY KEY (`user_space_id`, `vehicle_id`, `user_id`),
  INDEX `fk_user_vehicle_vehicle2_idx` (`vehicle_id` ASC),
  INDEX `fk_user_vehicle_usuario2_idx` (`user_id` ASC),
  CONSTRAINT `fk_user_vehicle_vehicle2`
    FOREIGN KEY (`vehicle_id`)
    REFERENCES `estacionamento`.`vehicle` (`vehicle_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_vehicle_usuario2`
    FOREIGN KEY (`user_id`)
    REFERENCES `estacionamento`.`user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'Table storing all customers. Holds foreign keys to the addre' /* comment truncated */ /*s table and the store table where this customer is registered.

Basic information about the customer like first and last name are stored in the table itself. Same for the date the record was created and when the information was last updated.*/;


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
  `id_estacionamento` INT(11) NOT NULL,
  `dh_entrada` VARCHAR(100) NOT NULL COMMENT 'o custo em relação ao tempo',
  `dh_saida` VARCHAR(45) NULL,
  `nro_vaga` VARCHAR(45) NULL,
  `vaga_id_vaga` INT(11) NOT NULL,
  `cliente_id_cliente` INT(11) NOT NULL,
  `status` INT NULL,
  `token` CHAR(6) NOT NULL,
  `codi_gerado` VARCHAR(6) NULL,
  PRIMARY KEY (`id_estacionamento`, `vaga_id_vaga`, `cliente_id_cliente`),
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
  `id_mensalidade` INT(11) NOT NULL,
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
  `id` INT NOT NULL,
  `senha` VARCHAR(45) NULL,
  `login` VARCHAR(45) NULL,
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
