-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 07-Jan-2018 às 21:49
-- Versão do servidor: 10.1.13-MariaDB
-- PHP Version: 5.5.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projeto_museus_portugal`
--
CREATE DATABASE IF NOT EXISTS `projeto_museus_portugal` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `projeto_museus_portugal`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `codigo` int(11) NOT NULL,
  `descricao` varchar(60) NOT NULL,
  `unidade_contexto` int(11) DEFAULT NULL,
  `tipo_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias_museus`
--

CREATE TABLE `categorias_museus` (
  `museu` int(11) NOT NULL,
  `tema` int(11) NOT NULL,
  `unidade_analise` int(11) NOT NULL,
  `unidade_contexto` int(11) NOT NULL,
  `categoria` int(11) NOT NULL,
  `sub_categoria` int(11) DEFAULT NULL,
  `texto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cidades`
--

CREATE TABLE `cidades` (
  `cod_cidade` int(11) NOT NULL,
  `nome` varchar(80) CHARACTER SET latin1 NOT NULL,
  `uf` varchar(2) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `imagens_museus`
--

CREATE TABLE `imagens_museus` (
  `codigo` int(11) NOT NULL,
  `codigo_museu` int(11) NOT NULL,
  `nome` varchar(250) NOT NULL,
  `descricao` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `museus`
--

CREATE TABLE `museus` (
  `codigo` int(11) NOT NULL,
  `indice` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `ano_fundacao` year(4) NOT NULL,
  `sem_fundacao` tinyint(1) NOT NULL,
  `horario_funcionamento_administrativo` varchar(100) DEFAULT NULL,
  `horario_atendimento_publico` varchar(100) DEFAULT NULL,
  `telefone` varchar(100) NOT NULL,
  `cod_cidade` int(11) NOT NULL,
  `endereco` varchar(200) NOT NULL,
  `situacao` int(11) NOT NULL,
  `observacoes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `situacoes`
--

CREATE TABLE `situacoes` (
  `cod_situacao` int(11) NOT NULL,
  `descricao` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `sub_categorias`
--

CREATE TABLE `sub_categorias` (
  `codigo` int(11) NOT NULL,
  `categoria` int(11) NOT NULL,
  `descricao` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `temas`
--

CREATE TABLE `temas` (
  `codigo` int(11) NOT NULL,
  `letra` varchar(2) NOT NULL,
  `descricao` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipos_categorias`
--

CREATE TABLE `tipos_categorias` (
  `codigo` int(11) NOT NULL,
  `descricao` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `unidades_analises`
--

CREATE TABLE `unidades_analises` (
  `codigo` int(11) NOT NULL,
  `tema` int(11) NOT NULL,
  `num_romano` varchar(7) NOT NULL,
  `descricao` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `unidades_contextos`
--

CREATE TABLE `unidades_contextos` (
  `codigo` int(11) NOT NULL,
  `unidade_analise` int(11) NOT NULL,
  `num_cardinal` int(3) NOT NULL,
  `descricao` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `fk_categoria_tipo_categoria` (`tipo_categoria`),
  ADD KEY `fk_categoria_unidade_contexto` (`unidade_contexto`) USING BTREE;

--
-- Indexes for table `categorias_museus`
--
ALTER TABLE `categorias_museus`
  ADD KEY `museu` (`museu`),
  ADD KEY `tema` (`tema`),
  ADD KEY `unidade_analise` (`unidade_analise`),
  ADD KEY `unidade_contexto` (`unidade_contexto`),
  ADD KEY `fk_categorias_museus_categorias` (`categoria`),
  ADD KEY `fk_categorias_museus_subcategorias` (`sub_categoria`);

--
-- Indexes for table `cidades`
--
ALTER TABLE `cidades`
  ADD PRIMARY KEY (`cod_cidade`);

--
-- Indexes for table `imagens_museus`
--
ALTER TABLE `imagens_museus`
  ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `museus`
--
ALTER TABLE `museus`
  ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `situacoes`
--
ALTER TABLE `situacoes`
  ADD PRIMARY KEY (`cod_situacao`);

--
-- Indexes for table `sub_categorias`
--
ALTER TABLE `sub_categorias`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `fk_sub_categorias_categorias` (`categoria`);

--
-- Indexes for table `temas`
--
ALTER TABLE `temas`
  ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `tipos_categorias`
--
ALTER TABLE `tipos_categorias`
  ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `unidades_analises`
--
ALTER TABLE `unidades_analises`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `fk_unidade_analise_tema` (`tema`) USING BTREE;

--
-- Indexes for table `unidades_contextos`
--
ALTER TABLE `unidades_contextos`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `fk_uc_ua` (`unidade_analise`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=523;
--
-- AUTO_INCREMENT for table `cidades`
--
ALTER TABLE `cidades`
  MODIFY `cod_cidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11389;
--
-- AUTO_INCREMENT for table `imagens_museus`
--
ALTER TABLE `imagens_museus`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=858;
--
-- AUTO_INCREMENT for table `museus`
--
ALTER TABLE `museus`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sub_categorias`
--
ALTER TABLE `sub_categorias`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;
--
-- AUTO_INCREMENT for table `temas`
--
ALTER TABLE `temas`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tipos_categorias`
--
ALTER TABLE `tipos_categorias`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `unidades_analises`
--
ALTER TABLE `unidades_analises`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `unidades_contextos`
--
ALTER TABLE `unidades_contextos`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `categorias`
--
ALTER TABLE `categorias`
  ADD CONSTRAINT `fk_categoria_tipo_categoria` FOREIGN KEY (`tipo_categoria`) REFERENCES `tipos_categorias` (`codigo`),
  ADD CONSTRAINT `fk_categoria_uc` FOREIGN KEY (`unidade_contexto`) REFERENCES `unidades_contextos` (`codigo`);

--
-- Limitadores para a tabela `categorias_museus`
--
ALTER TABLE `categorias_museus`
  ADD CONSTRAINT `categorias_museus_ibfk_1` FOREIGN KEY (`museu`) REFERENCES `museus` (`codigo`),
  ADD CONSTRAINT `categorias_museus_ibfk_2` FOREIGN KEY (`tema`) REFERENCES `temas` (`codigo`),
  ADD CONSTRAINT `categorias_museus_ibfk_3` FOREIGN KEY (`unidade_analise`) REFERENCES `unidades_analises` (`codigo`),
  ADD CONSTRAINT `categorias_museus_ibfk_4` FOREIGN KEY (`unidade_contexto`) REFERENCES `unidades_contextos` (`codigo`),
  ADD CONSTRAINT `fk_categorias_museus_categorias` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`codigo`),
  ADD CONSTRAINT `fk_categorias_museus_subcategorias` FOREIGN KEY (`sub_categoria`) REFERENCES `sub_categorias` (`codigo`);

--
-- Limitadores para a tabela `sub_categorias`
--
ALTER TABLE `sub_categorias`
  ADD CONSTRAINT `fk_sub_categorias_categorias` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`codigo`);

--
-- Limitadores para a tabela `unidades_analises`
--
ALTER TABLE `unidades_analises`
  ADD CONSTRAINT `fk_ua_tema` FOREIGN KEY (`tema`) REFERENCES `temas` (`codigo`);

--
-- Limitadores para a tabela `unidades_contextos`
--
ALTER TABLE `unidades_contextos`
  ADD CONSTRAINT `fk_uc_ua` FOREIGN KEY (`unidade_analise`) REFERENCES `unidades_analises` (`codigo`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
