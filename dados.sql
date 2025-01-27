-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 25-Nov-2024 às 15:28
-- Versão do servidor: 5.6.13
-- versão do PHP: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `dados`
--
CREATE DATABASE IF NOT EXISTS `dados` DEFAULT CHARACTER SET utf32 COLLATE utf32_unicode_ci;
USE `dados`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nome_categoria` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nome_categoria`) VALUES
(1, 'Encanamento'),
(2, 'Eletrica'),
(3, 'Construcao Civil'),
(4, 'Marcenaria'),
(5, 'Piscina'),
(6, 'Faxina');

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) CHARACTER SET latin1 NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 NOT NULL,
  `senha` varchar(255) CHARACTER SET latin1 NOT NULL,
  `endereco` varchar(255) CHARACTER SET latin1 NOT NULL,
  `foto_perfil` varchar(500) CHARACTER SET latin1 NOT NULL,
  `id_situacao` int(11) NOT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nome`, `email`, `senha`, `endereco`, `foto_perfil`, `id_situacao`) VALUES
(4, 'Jose Augusto', 'jose@gmail.com', 'jose', 'Rua Jose Augusto', '', 0),
(5, 'Augusto', 'augusto@gmail.com', 'augusto', 'Rua Augusto', '', 0),
(6, 'Milena', 'milena@gmail.com', 'mimi', 'Rua Milena', '', 0),
(7, 'Pedro ', 'pedro@hotmail.com', 'predo', 'Rua Pedro', '', 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `profissional`
--

CREATE TABLE IF NOT EXISTS `profissional` (
  `id_profissional` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(500) CHARACTER SET latin1 NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `voluntario` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_profissional`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `profissional`
--

INSERT INTO `profissional` (`id_profissional`, `descricao`, `id_categoria`, `voluntario`) VALUES
(3, 'ForneÃ§a uma breve descriÃ§Ã£o', 1, 1),
(4, 'ForneÃ§a uma breve a', 6, 1);
--