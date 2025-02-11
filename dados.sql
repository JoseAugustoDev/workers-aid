-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 11-Fev-2025 às 19:55
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
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nome`, `email`, `senha`, `endereco`, `foto_perfil`, `id_situacao`, `is_admin`) VALUES
(4, 'Jose Augusto', 'jose@gmail.com', 'jose', 'Rua Jose Augusto', '', 0, 0),
(5, 'Augusto', 'augusto@gmail.com', 'augusto', 'Rua Augusto', '', 0, 0),
(6, 'Milena', 'milena@gmail.com', 'mimi', 'Rua Milena', '', 0, 0),
(7, 'Pedro ', 'pedro@hotmail.com', 'predo', 'Rua Pedro', 'uploads/cleaner.png', 4, 0),
(8, 'Marcos', 'marcos@engenheiro.com', 'marcos', 'Rua Marcos', 'uploads/construction_worker.jpg', 5, 0),
(9, 'Messi', 'messi@piscineiro.com', 'piscina', 'Rua Piscina', 'uploads/poll-2.png', 6, 0),
(10, 'Zezin', 'zezin@eletricista.com', 'zezin', 'Rua da eletrica', 'uploads/eletrician.png', 7, 0),
(11, 'Milena', 'milena@encanadora.com', 'milena', 'Rua Tucano', 'uploads/plumber.jpg', 8, 0),
(12, 'Jose Augusto', 'jose@piscina.com', 'piscina', 'Rua da Piscina', 'uploads/pool.jpg', 9, 0),
(13, 'Calhau', 'calhau@engenheiro.com', 'calhau', 'Rua da Calha', 'uploads/construction-worker-icon.jpg', 10, 0),
(14, 'Leo', 'leo@marceneiro.com', 'leo', 'Rua da Madeira', 'uploads/marceneiro.png', 12, 0),
(15, 'Wilma', 'wilma@gmail.com', 'wilma', 'Rua da Madeira', '', 0, 0),
(16, 'PeÃ§anha', 'pecanha@engenheiro.com', 'pecanha', 'Rua Sao Pedro', 'uploads/icone-construcao.png', 13, 0),
(17, 'Admin', 'admin-ifes@workersaid.com', '@Trabalh0T3cn1co', 'IFES SERRA', '', 0, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
