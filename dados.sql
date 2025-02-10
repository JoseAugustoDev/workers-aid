-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 10-Fev-2025 às 21:46
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
-- Estrutura da tabela `avaliacao`
--

CREATE TABLE IF NOT EXISTS `avaliacao` (
  `id_avaliacao` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `id_profissional` int(11) NOT NULL,
  `nota` int(11) NOT NULL,
  `comentario` varchar(255) COLLATE utf32_unicode_ci NOT NULL,
  PRIMARY KEY (`id_avaliacao`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `avaliacao`
--

INSERT INTO `avaliacao` (`id_avaliacao`, `id_cliente`, `id_profissional`, `nota`, `comentario`) VALUES
(1, 4, 5, 5, 'Gostei bastante do trabalho dele!'),
(2, 4, 10, 5, 'Otimo Profissional'),
(3, 4, 5, 3, 'NÃ£o gostei tanto'),
(4, 4, 6, 1, 'NÃ£o gostei tanto');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nome_categoria` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nome_categoria`) VALUES
(1, 'Encanamento'),
(2, 'Eletrica'),
(3, 'Construcao Civil'),
(4, 'Marcenaria'),
(5, 'Piscina'),
(6, 'Faxina'),
(7, 'Informatica');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nome`, `email`, `senha`, `endereco`, `foto_perfil`, `id_situacao`) VALUES
(4, 'Jose Augusto', 'jose@gmail.com', 'jose', 'Rua Jose Augusto', '', 0),
(5, 'Augusto', 'augusto@gmail.com', 'augusto', 'Rua Augusto', '', 0),
(6, 'Milena', 'milena@gmail.com', 'mimi', 'Rua Milena', '', 0),
(7, 'Pedro ', 'pedro@hotmail.com', 'predo', 'Rua Pedro', '', 4),
(8, 'Marcos', 'marcos@engenheiro.com', 'marcos', 'Rua Marcos', '', 5),
(9, 'Messi', 'messi@piscineiro.com', 'piscina', 'Rua Piscina', '', 6),
(10, 'Zezin', 'zezin@eletricista.com', 'zezin', 'Rua da eletrica', '', 7),
(11, 'Milena', 'milena@encanadora.com', 'milena', 'Rua Tucano', '', 8),
(12, 'Jose Augusto', 'jose@piscina.com', 'piscina', 'Rua da Piscina', '', 9),
(13, 'Calhau', 'calhau@engenheiro.com', 'calhau', 'Rua da Calha', '', 10),
(14, 'Leo', 'leo@marceneiro.com', 'leo', 'Rua da Madeira', '', 12);

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensagem`
--

CREATE TABLE IF NOT EXISTS `mensagem` (
  `id_mensagem` int(11) NOT NULL AUTO_INCREMENT,
  `id_profissional` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `mensagem` varchar(255) COLLATE utf32_unicode_ci NOT NULL,
  PRIMARY KEY (`id_mensagem`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `mensagem`
--

INSERT INTO `mensagem` (`id_mensagem`, `id_profissional`, `id_cliente`, `mensagem`) VALUES
(1, 5, 4, 'OlÃ¡, Marcos!'),
(2, 5, 4, 'Preciso de um orÃ§amento para construir minha casa.'),
(3, 10, 4, 'OrÃ§amento para um software'),
(4, 6, 7, 'Piscina de criaÃ§a'),
(5, 6, 10, 'Boa tarde');

-- --------------------------------------------------------

--
-- Estrutura da tabela `profissional`
--

CREATE TABLE IF NOT EXISTS `profissional` (
  `id_profissional` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(500) CHARACTER SET latin1 NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `voluntario` tinyint(1) NOT NULL,
  `avaliacao` int(11) NOT NULL,
  PRIMARY KEY (`id_profissional`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Extraindo dados da tabela `profissional`
--

INSERT INTO `profissional` (`id_profissional`, `descricao`, `id_categoria`, `voluntario`, `avaliacao`) VALUES
(4, 'ForneÃ§a uma breve a', 6, 1, 0),
(5, 'Sou o Marcos e trabalho como engenheiro civil hÃ¡ 10 anos', 3, 1, 0),
(6, 'Sou o messi e tenho especialidade em limpeza de piscinas', 5, 0, 0),
(7, 'Sou o Zezin da eletrica. 15 anos de experiencia', 2, 0, 0),
(8, 'Sou a Milena e nÃ£o tenho tanta experiencia na area', 1, 1, 0),
(9, 'Sou o Jose Augusto e nÃ£o tenho experiencia limpando piscinas', 5, 1, 0),
(10, 'Sou o Calhau', 3, 0, 0),
(12, 'Sou o Leo Marceneiro', 4, 1, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
