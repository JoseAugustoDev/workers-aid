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
-- Base de Dados: `despachante`
--
CREATE DATABASE IF NOT EXISTS `despachante` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `despachante`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `emplacamento`
--

CREATE TABLE IF NOT EXISTS `emplacamento` (
  `id_emplacamento` int(11) NOT NULL AUTO_INCREMENT,
  `id_processo` int(11) DEFAULT NULL,
  `nota_fiscal` varchar(255) DEFAULT NULL,
  `nome_dono_veiculo` varchar(255) DEFAULT NULL,
  `modelo_veiculo` varchar(255) DEFAULT NULL,
  `marca_veiculo` varchar(255) DEFAULT NULL,
  `data_da_venda` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_emplacamento`),
  KEY `id_processo` (`id_processo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Extraindo dados da tabela `emplacamento`
--

INSERT INTO `emplacamento` (`id_emplacamento`, `id_processo`, `nota_fiscal`, `nome_dono_veiculo`, `modelo_veiculo`, `marca_veiculo`, `data_da_venda`) VALUES
(7, 16, 'C:\\Users\\Jose Augusto\\Downloads\\august-10-2019-nebula-ngc-2074.jpg', 'Jose Augusto', 'Uno', 'Fiat', '25/08/2024'),
(8, 19, 'C:\\Users\\Jose Augusto\\Downloads\\august-10-2019-nebula-ngc-2074.jpg', 'Jose Augusto', 'Onix', 'Chevrolet', '12/12/2012'),
(9, 21, 'C:\\Users\\Jose Augusto\\Downloads\\august-10-2019-nebula-ngc-2074.jpg', 'Mauricio', 'Fusca', 'Volkswagem', '12/12/2014'),
(10, 22, 'C:\\Users\\Jose Augusto\\Downloads\\august-10-2019-nebula-ngc-2074.jpg', 'Teste', 'Teste', 'Teste', '01/02/2023'),
(11, 24, 'C:\\Users\\Jose Augusto\\Downloads\\august-10-2019-nebula-ngc-2074.jpg', 'Jose Augusto', 'Onix 2022', 'Chevrolet', '28/08/2024'),
(12, 27, 'C:\\Users\\Jose Augusto\\Downloads\\august-10-2019-nebula-ngc-2074.jpg', 'Pedro Henrique', 'Panamera', 'Porsche', '28/08/2024'),
(13, 30, 'C:\\Users\\Jose Augusto\\Downloads\\august-10-2019-nebula-ngc-2074.jpg', 'Jose Augusto', 'C4', 'Renault', '31/08/2024'),
(14, 32, 'C:\\Users\\Jose Augusto\\Downloads\\august-10-2019-nebula-ngc-2074.jpg', 'Jose', 'Camaro', 'Chevrolet', '28/08/2024');

-- --------------------------------------------------------

--
-- Estrutura da tabela `processos`
--

CREATE TABLE IF NOT EXISTS `processos` (
  `id_processo` int(11) NOT NULL AUTO_INCREMENT,
  `servico` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_processo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Extraindo dados da tabela `processos`
--

INSERT INTO `processos` (`id_processo`, `servico`) VALUES
(16, 'Emplacamento'),
(17, 'Transferencia'),
(18, 'Transferencia'),
(19, 'Emplacamento'),
(20, 'Transferencia'),
(21, 'Emplacamento'),
(22, 'Emplacamento'),
(23, 'Emplacamento'),
(24, 'Emplacamento'),
(25, 'Transferencia'),
(26, 'Transferencia'),
(27, 'Emplacamento'),
(28, 'Transferencia'),
(29, 'Transferencia'),
(30, 'Emplacamento'),
(31, 'Transferencia'),
(32, 'Emplacamento');

-- --------------------------------------------------------

--
-- Estrutura da tabela `transferencia`
--

CREATE TABLE IF NOT EXISTS `transferencia` (
  `id_transferencia` int(11) NOT NULL AUTO_INCREMENT,
  `id_processo` int(11) DEFAULT NULL,
  `doc_antigo_dono` varchar(255) DEFAULT NULL,
  `doc_novo_dono` varchar(255) DEFAULT NULL,
  `recibo_preenchido` varchar(255) DEFAULT NULL,
  `comprovante_residencia` varchar(255) DEFAULT NULL,
  `vistoria_feita` tinyint(1) DEFAULT NULL,
  `modelo_veiculo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_transferencia`),
  KEY `id_processo` (`id_processo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `transferencia`
--

INSERT INTO `transferencia` (`id_transferencia`, `id_processo`, `doc_antigo_dono`, `doc_novo_dono`, `recibo_preenchido`, `comprovante_residencia`, `vistoria_feita`, `modelo_veiculo`) VALUES
(3, 18, '3.252-145', '2.452-624', 'C:\\Users\\Jose Augusto\\Downloads\\august-10-2019-nebula-ngc-2074.jpg', 'C:\\Users\\Jose Augusto\\Downloads\\august-10-2019-nebula-ngc-2074.jpg', 1, 'Onix'),
(4, 20, '1.231-231', '1.535-114', 'C:\\Users\\Jose Augusto\\Downloads\\august-10-2019-nebula-ngc-2074.jpg', 'C:\\Users\\Jose Augusto\\Downloads\\august-10-2019-nebula-ngc-2074.jpg', 1, 'Corolla'),
(5, 25, '1.234-567', '7.654-321', 'C:\\Users\\Jose Augusto\\Downloads\\august-10-2019-nebula-ngc-2074.jpg', 'C:\\Users\\Jose Augusto\\Downloads\\august-10-2019-nebula-ngc-2074.jpg', 1, 'Camaro'),
(6, 26, '2.251-116', '3.331-142', 'C:\\Users\\Jose Augusto\\Downloads\\august-10-2019-nebula-ngc-2074.jpg', 'C:\\Users\\Jose Augusto\\Downloads\\august-10-2019-nebula-ngc-2074.jpg', 0, 'Panamera'),
(7, 29, '1.233-214', '3.211-235', 'C:\\Users\\Jose Augusto\\Downloads\\august-10-2019-nebula-ngc-2074.jpg', 'C:\\Users\\Jose Augusto\\Downloads\\august-10-2019-nebula-ngc-2074.jpg', 1, 'C4'),
(8, 31, '1.233-214', '3.521-426', 'C:\\Users\\Jose Augusto\\Downloads\\august-10-2019-nebula-ngc-2074.jpg', 'C:\\Users\\Jose Augusto\\Downloads\\august-10-2019-nebula-ngc-2074.jpg', 1, 'Camaro');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome_completo` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome_completo`, `email`, `senha`) VALUES
(1, 'Jose Augusto', 'jose@despachante.com', 'jose'),
(2, 'Pedro', 'pedro@despachante.com', 'pedro'),
(3, 'Victoria', 'victoria@despachante.com', 'victoria'),
(4, 'teste', 'teste@despachante.com', 'teste');

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `emplacamento`
--
ALTER TABLE `emplacamento`
  ADD CONSTRAINT `emplacamento_ibfk_1` FOREIGN KEY (`id_processo`) REFERENCES `processos` (`id_processo`);

--
-- Limitadores para a tabela `transferencia`
--
ALTER TABLE `transferencia`
  ADD CONSTRAINT `transferencia_ibfk_1` FOREIGN KEY (`id_processo`) REFERENCES `processos` (`id_processo`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
