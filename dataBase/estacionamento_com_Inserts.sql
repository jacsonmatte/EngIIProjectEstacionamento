-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 16-Jun-2015 às 22:03
-- Versão do servidor: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `estacionamento`
--

-- --------------------------------------------------------
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



--
-- Estrutura da tabela `cliente`
--

CREATE TABLE IF NOT EXISTS `estacionamento`.`cliente` (
`id_cliente` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL COMMENT 'tempo em de estacionamento',
  `cpf_cnpj` varchar(30) NOT NULL COMMENT 'o custo em relação ao tempo',
  `email` varchar(45) DEFAULT NULL,
  `logradouro` varchar(45) DEFAULT NULL,
  `nro` int(11) DEFAULT NULL,
  `cep` varchar(45) DEFAULT NULL,
  `bairro` varchar(45) DEFAULT NULL,
  `cidade` varchar(45) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `telefone` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='Table storing all customers. Holds foreign keys to the addre';

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nome`, `cpf_cnpj`, `email`, `logradouro`, `nro`, `cep`, `bairro`, `cidade`, `estado`, `telefone`) VALUES
(1, 'Pedro', '05015283609', 'pedro@gmail.com', 'Rua dos indios', 23, '89814021', 'São Pedro', 'Chapecó', 'Santa Catarina', '(49) 99560123');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estacionamento`
--

CREATE TABLE IF NOT EXISTS `estacionamento`.`estacionamento` (
`id_estacionamento` int(11) NOT NULL,
  `dh_entrada` varchar(100) NOT NULL COMMENT 'o custo em relação ao tempo',
  `dh_saida` varchar(45) DEFAULT NULL,
  `nro_vaga` varchar(45) DEFAULT NULL,
  `vaga_id_vaga` int(11) NOT NULL,
  `cliente_id_cliente` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `token` char(6) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='Table storing all customers. Holds foreign keys to the addre';

--
-- Extraindo dados da tabela `estacionamento`
--

INSERT INTO `estacionamento` (`id_estacionamento`, `dh_entrada`, `dh_saida`, `nro_vaga`, `vaga_id_vaga`, `cliente_id_cliente`, `status`, `token`) VALUES
(1, '09/05/2015 às 19h', '09/05/2015 às 20h', '00001', 1, 1, 1, '1', '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensalidade`
--

CREATE TABLE IF NOT EXISTS `estacionamento`.`mensalidade` (
`id_mensalidade` int(11) NOT NULL,
  `ano` varchar(100) NOT NULL COMMENT 'o custo em relação ao tempo',
  `mes` varchar(45) DEFAULT NULL,
  `val_plano` double DEFAULT NULL,
  `val_execed` double DEFAULT NULL,
  `cliente_id_cliente` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='Table storing all customers. Holds foreign keys to the addre';

--
-- Extraindo dados da tabela `mensalidade`
--

INSERT INTO `mensalidade` (`id_mensalidade`, `ano`, `mes`, `val_plano`, `val_execed`, `cliente_id_cliente`) VALUES
(2, '2015', '06', 13.36, 2.36, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `plano`
--

CREATE TABLE IF NOT EXISTS `estacionamento`.`plano` (
  `id` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `valor` double NOT NULL COMMENT 'o custo em relação ao tempo',
  `horas` int(11) NOT NULL COMMENT 'tempo em de estacionamento',
  `valor_excedente` double DEFAULT NULL,
  `descr` varchar(45) DEFAULT NULL
  
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='Table storing all customers. Holds foreign keys to the addre';

--
-- Extraindo dados da tabela `plano`
--

INSERT INTO `plano` (`id`, `nome`, `valor`, `horas`, `valor_excedente`, `descr`) VALUES
(1, 'Plano1', 20.0, 3, 0.5,'plano 1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `plano_contratado`
--

CREATE TABLE IF NOT EXISTS `estacionamento`.`plano_contratado` (
  `id_cliente` int(11) NOT NULL,
  `cliente_id_cliente` int(11) NOT NULL,
  `plano_id_plano` int(11) NOT NULL,
  `data_contrato` date DEFAULT NULL,
  `observacao` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table storing all customers. Holds foreign keys to the addre';

--
-- Extraindo dados da tabela `plano_contratado`
--

INSERT INTO `plano_contratado` (`id_cliente`, `cliente_id_cliente`, `plano_id_plano`, `data_contrato`, `observacao`) VALUES
(0, 1, 1, '2015-06-16', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `estacionamento`.`usuario` (
  `id` int(11) NOT NULL,
  `senha` varchar(45) DEFAULT NOT NULL,
  `login` varchar(45) DEFAULT NOT NULL,
  `cliente_id_cliente` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `senha`, `login`, `cliente_id_cliente`) VALUES
(1, 'ok', 'admin', 1),
(2, 'ok', 'cliente', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `vaga`
--


CREATE TABLE IF NOT EXISTS `estacionamento`.`vaga` (
`id_vaga` int(11) NOT NULL,
  `nro_vaga` varchar(50) NOT NULL COMMENT 'tempo em de estacionamento',
  `descricao` varchar(100) NOT NULL COMMENT 'o custo em relação ao tempo',
  `tipo` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='Table storing all customers. Holds foreign keys to the addre';

--
-- Extraindo dados da tabela `vaga`
--

INSERT INTO `vaga` (`id_vaga`, `nro_vaga`, `descricao`, `tipo`) VALUES
(1, '00001', 'Vaga para motos', 'Carro');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
 ADD PRIMARY KEY (`id_cliente`);

--
-- Indexes for table `estacionamento`
--
ALTER TABLE `estacionamento`
 ADD PRIMARY KEY (`id_estacionamento`), ADD KEY `fk_estacionamento_vaga1_idx` (`vaga_id_vaga`), ADD KEY `fk_estacionamento_cliente1_idx` (`cliente_id_cliente`);

--
-- Indexes for table `mensalidade`
--
ALTER TABLE `mensalidade`
 ADD PRIMARY KEY (`id_mensalidade`,`cliente_id_cliente`), ADD KEY `fk_mensalidade_cliente1_idx` (`cliente_id_cliente`);

--
-- Indexes for table `plano`
--
ALTER TABLE `plano`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plano_contratado`
--
ALTER TABLE `plano_contratado`
 ADD PRIMARY KEY (`id_cliente`,`cliente_id_cliente`,`plano_id_plano`), ADD KEY `fk_plano_contratado_cliente1_idx` (`cliente_id_cliente`), ADD KEY `fk_plano_contratado_plano1_idx` (`plano_id_plano`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
 ADD PRIMARY KEY (`id`,`cliente_id_cliente`), ADD KEY `fk_usuario_cliente1_idx` (`cliente_id_cliente`);

--
-- Indexes for table `vaga`
--
ALTER TABLE `vaga`
 ADD PRIMARY KEY (`id_vaga`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `estacionamento`
--
ALTER TABLE `estacionamento`
MODIFY `id_estacionamento` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `mensalidade`
--
ALTER TABLE `mensalidade`
MODIFY `id_mensalidade` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `plano`
--
ALTER TABLE `plano`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `vaga`
--
ALTER TABLE `vaga`
MODIFY `id_vaga` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `estacionamento`
--
ALTER TABLE `estacionamento`
ADD CONSTRAINT `fk_estacionamento_cliente1` FOREIGN KEY (`cliente_id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_estacionamento_vaga1` FOREIGN KEY (`vaga_id_vaga`) REFERENCES `vaga` (`id_vaga`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `mensalidade`
--
ALTER TABLE `mensalidade`
ADD CONSTRAINT `fk_mensalidade_cliente1` FOREIGN KEY (`cliente_id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `plano_contratado`
--
ALTER TABLE `plano_contratado`
ADD CONSTRAINT `fk_plano_contratado_cliente1` FOREIGN KEY (`cliente_id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_plano_contratado_plano1` FOREIGN KEY (`plano_id_plano`) REFERENCES `plano` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
ADD CONSTRAINT `fk_usuario_cliente1` FOREIGN KEY (`cliente_id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
