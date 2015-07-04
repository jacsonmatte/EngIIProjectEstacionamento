-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 03-Jul-2015 às 18:40
-- Versão do servidor: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `estacionamento`
--
CREATE DATABASE IF NOT EXISTS `estacionamento` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `estacionamento`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL COMMENT 'tempo em de estacionamento',
  `cpf_cnpj` varchar(14) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `logradouro` varchar(45) DEFAULT NULL,
  `nro` int(6) DEFAULT NULL,
  `cep` varchar(8) DEFAULT NULL,
  `bairro` varchar(45) DEFAULT NULL,
  `cidade` varchar(45) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `telefone` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='Table storing all customers. Holds foreign keys to the addre';

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nome`, `cpf_cnpj`, `email`, `logradouro`, `nro`, `cep`, `bairro`, `cidade`, `estado`, `telefone`) VALUES(1, 'Aristides Peiter', '01097284085', 'adpeiter@hotmail.com', 'Av. Nereu Ramos', 1431, '89801800', 'Centro', 'Chapecó', 'SC', '4988396699');
INSERT INTO `cliente` (`id_cliente`, `nome`, `cpf_cnpj`, `email`, `logradouro`, `nro`, `cep`, `bairro`, `cidade`, `estado`, `telefone`) VALUES(2, 'Cliente 1', '33333333333', 'email@email.com', 'rua 1', 3, '99999999', 'bairro 1', 'cidade 1', 'XX', '9977778888');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estacionamento`
--

DROP TABLE IF EXISTS `estacionamento`;
CREATE TABLE `estacionamento` (
  `id_estacionamento` int(11) NOT NULL,
  `dh_entrada` varchar(100) NOT NULL COMMENT 'o custo em relação ao tempo',
  `dh_saida` varchar(45) DEFAULT NULL,
  `vaga_id_vaga` int(11) NOT NULL,
  `cliente_id_cliente` int(11) NOT NULL,
  `plano_id_plano_contratado` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `token` char(6) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COMMENT='Table storing all customers. Holds foreign keys to the addre';

--
-- Extraindo dados da tabela `estacionamento`
--

INSERT INTO `estacionamento` (`id_estacionamento`, `dh_entrada`, `dh_saida`, `vaga_id_vaga`, `cliente_id_cliente`, `plano_id_plano_contratado`, `status`, `token`) VALUES(1, '2015-01-01T00:00', '2015-01-01T01:00', 1, 2, 1, 1, '913078');
INSERT INTO `estacionamento` (`id_estacionamento`, `dh_entrada`, `dh_saida`, `vaga_id_vaga`, `cliente_id_cliente`, `plano_id_plano_contratado`, `status`, `token`) VALUES(8, '2015-12-02T23:00', '2015-12-03T05:00', 1, 2, 1, 1, '975605');
INSERT INTO `estacionamento` (`id_estacionamento`, `dh_entrada`, `dh_saida`, `vaga_id_vaga`, `cliente_id_cliente`, `plano_id_plano_contratado`, `status`, `token`) VALUES(15, '2015-12-01T00:00', '2015-12-01T03:00', 5, 2, 1, 3, '698410');
INSERT INTO `estacionamento` (`id_estacionamento`, `dh_entrada`, `dh_saida`, `vaga_id_vaga`, `cliente_id_cliente`, `plano_id_plano_contratado`, `status`, `token`) VALUES(18, '2015-06-02T20:00', '2015-06-02T22:00', 1, 2, 1, 0, '988711');
INSERT INTO `estacionamento` (`id_estacionamento`, `dh_entrada`, `dh_saida`, `vaga_id_vaga`, `cliente_id_cliente`, `plano_id_plano_contratado`, `status`, `token`) VALUES(19, '2015-01-31T23:00', '2015-01-31T23:59', 1, 2, 1, 3, '287811');

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensalidade`
--

DROP TABLE IF EXISTS `mensalidade`;
CREATE TABLE `mensalidade` (
  `id_mensalidade` int(11) NOT NULL,
  `ano` int(4) NOT NULL COMMENT 'o custo em relação ao tempo',
  `mes` int(2) NOT NULL,
  `val_plano` double NOT NULL,
  `val_execed` double NOT NULL,
  `cliente_id_cliente` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='Table storing all customers. Holds foreign keys to the addre';

--
-- Extraindo dados da tabela `mensalidade`
--

INSERT INTO `mensalidade` (`id_mensalidade`, `ano`, `mes`, `val_plano`, `val_execed`, `cliente_id_cliente`) VALUES(1, 2015, 6, 15, 2, 2);
INSERT INTO `mensalidade` (`id_mensalidade`, `ano`, `mes`, `val_plano`, `val_execed`, `cliente_id_cliente`) VALUES(2, 2015, 5, 15, 0, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `plano`
--

DROP TABLE IF EXISTS `plano`;
CREATE TABLE `plano` (
  `id` int(11) NOT NULL,
  `horas` int(3) NOT NULL,
  `valor` double NOT NULL COMMENT 'o custo em relação ao tempo',
  `valor_excedente` double NOT NULL,
  `descr` varchar(45) DEFAULT NULL,
  `observacao` varchar(45) DEFAULT NULL,
  `nome` varchar(20) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='Table storing all customers. Holds foreign keys to the addre';

--
-- Extraindo dados da tabela `plano`
--

INSERT INTO `plano` (`id`, `horas`, `valor`, `valor_excedente`, `descr`, `observacao`, `nome`, `status`) VALUES(1, 100, 100, 1.2, '', '', 'plano 1', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `plano_contratado`
--

DROP TABLE IF EXISTS `plano_contratado`;
CREATE TABLE `plano_contratado` (
  `id_plano_contratado` int(11) NOT NULL,
  `cliente_id_cliente` int(11) NOT NULL,
  `plano_id_plano` int(11) NOT NULL,
  `data_contrato` date DEFAULT NULL,
  `observacao` varchar(45) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table storing all customers. Holds foreign keys to the addre';

--
-- Extraindo dados da tabela `plano_contratado`
--

INSERT INTO `plano_contratado` (`id_plano_contratado`, `cliente_id_cliente`, `plano_id_plano`, `data_contrato`, `observacao`, `status`) VALUES(1, 2, 1, '2015-06-25', '', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `login` varchar(45) NOT NULL,
  `cliente_id_cliente` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `senha`, `login`, `cliente_id_cliente`) VALUES(1, '123', 'admin', 1);
INSERT INTO `usuario` (`id`, `senha`, `login`, `cliente_id_cliente`) VALUES(2, '123', 'cli1', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `vaga`
--

DROP TABLE IF EXISTS `vaga`;
CREATE TABLE `vaga` (
  `id_vaga` int(11) NOT NULL,
  `nro_vaga` varchar(50) NOT NULL COMMENT 'tempo em de estacionamento',
  `descricao` varchar(100) NOT NULL COMMENT 'o custo em relação ao tempo',
  `tipo` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='Table storing all customers. Holds foreign keys to the addre';

--
-- Extraindo dados da tabela `vaga`
--

INSERT INTO `vaga` (`id_vaga`, `nro_vaga`, `descricao`, `tipo`) VALUES(1, '1', '', '1');
INSERT INTO `vaga` (`id_vaga`, `nro_vaga`, `descricao`, `tipo`) VALUES(2, '2', '', '1');
INSERT INTO `vaga` (`id_vaga`, `nro_vaga`, `descricao`, `tipo`) VALUES(3, '3', '', '1');
INSERT INTO `vaga` (`id_vaga`, `nro_vaga`, `descricao`, `tipo`) VALUES(4, '4', '', '1');
INSERT INTO `vaga` (`id_vaga`, `nro_vaga`, `descricao`, `tipo`) VALUES(5, '5', '', '1');
INSERT INTO `vaga` (`id_vaga`, `nro_vaga`, `descricao`, `tipo`) VALUES(6, '6', '', '1');

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
  ADD PRIMARY KEY (`id_estacionamento`,`vaga_id_vaga`,`cliente_id_cliente`), ADD UNIQUE KEY `token_UNIQUE` (`token`), ADD KEY `fk_estacionamento_vaga1_idx` (`vaga_id_vaga`), ADD KEY `fk_estacionamento_cliente1_idx` (`cliente_id_cliente`);

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
  ADD PRIMARY KEY (`id_plano_contratado`,`cliente_id_cliente`,`plano_id_plano`), ADD KEY `fk_plano_contratado_cliente1_idx` (`cliente_id_cliente`), ADD KEY `fk_plano_contratado_plano1_idx` (`plano_id_plano`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`,`cliente_id_cliente`), ADD UNIQUE KEY `login` (`login`), ADD KEY `fk_usuario_cliente1_idx` (`cliente_id_cliente`);

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
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `estacionamento`
--
ALTER TABLE `estacionamento`
  MODIFY `id_estacionamento` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
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
  MODIFY `id_vaga` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
  
  -- AUTO_INCREMENT for table `plano_contratado`
--
ALTER TABLE `plano_contratado`
MODIFY `id_plano_contratado` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
  
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
