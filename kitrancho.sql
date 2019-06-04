-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 29-Maio-2019 às 01:22
-- Versão do servidor: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kitrancho`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cesta`
--

CREATE TABLE `cesta` (
  `id_cesta` int(5) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `valor` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cesta`
--

INSERT INTO `cesta` (`id_cesta`, `nome`, `valor`) VALUES
(1, 'Kit Médio', 170),
(2, 'Kit Grande', 220),
(3, 'Kit Super', 280),
(4, 'Kit Kids', 50);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(5) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `celular` int(11) NOT NULL,
  `telefone` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `link_facebook` varchar(255) DEFAULT NULL,
  `id_endereco` int(5) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nome`, `celular`, `telefone`, `email`, `link_facebook`, `id_endereco`, `foto`) VALUES
(1, 'Andressa Rocha', 2147483647, 5998556, 'sias.andressa@gmail.com', 'facebook.com/andressa', NULL, 'maria.jpg'),
(3, 'Lucas', 2147483647, 6541648, 'lucasbmalonn@gmail.com', 'facebook.com/lucas', NULL, NULL),
(6, 'Maria Silva', 2147483647, 33448845, 'maria@gmail.com', 'fabebook.com/maria', NULL, NULL),
(11, 'João', 2659569, 2147483647, 'jose@gmail.com', 'facebook.com/joao', NULL, NULL),
(13, 'Fulaninho', 645485476, 44546464, 'fulano@gmail.com', 'facebook.com/fulano', NULL, 'jose.jpg'),
(15, 'Ciclano', 656256, 26161515, 'ciclano@gmail.com', 'facebook.com/ciclano', NULL, 'joao.jpg'),
(17, '', 0, 0, '', '', NULL, ''),
(18, 'Julia ', 994999988, 2147483647, 'julia@gmail.com', 'facebook.com/julia', NULL, 'joana.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

CREATE TABLE `endereco` (
  `id_endereco` int(5) UNSIGNED NOT NULL,
  `rua` varchar(255) NOT NULL,
  `numero` int(5) NOT NULL,
  `cep` int(8) DEFAULT NULL,
  `bairro` varchar(255) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `complemento` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `endereco`
--

INSERT INTO `endereco` (`id_endereco`, `rua`, `numero`, `cep`, `bairro`, `cidade`, `estado`, `complemento`) VALUES
(1, 'Rua CanadÃ¡, 384', 666, 94965, 'bairro bom', 'Cachoeirinha', 'RS', 'vila'),
(2, 'R JOAO NUNES', 488, 79910, 'ifjgifjig', 'AntÃ´nio JoÃ£o', 'Ma', 'gfdd');

-- --------------------------------------------------------

--
-- Estrutura da tabela `item_cesta`
--

CREATE TABLE `item_cesta` (
  `id_item` int(5) UNSIGNED NOT NULL,
  `id_produto` int(5) NOT NULL,
  `quantidade` int(10) NOT NULL,
  `id_cesta` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `item_cesta`
--

INSERT INTO `item_cesta` (`id_item`, `id_produto`, `quantidade`, `id_cesta`) VALUES
(1, 1, 5, 1),
(2, 2, 4, 1),
(3, 3, 3, 1),
(4, 1, 9, 3),
(5, 2, 8, 3),
(6, 3, 7, 3),
(7, 1, 6, 1),
(8, 2, 5, 1),
(9, 3, 7, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

CREATE TABLE `pedido` (
  `id_pedido` int(5) UNSIGNED NOT NULL,
  `id_cliente` int(5) NOT NULL,
  `id_cesta` int(5) NOT NULL,
  `data_contato` date NOT NULL,
  `data_desejada_entrega` date NOT NULL,
  `horario_desejado_entrega` time NOT NULL,
  `data_entrega` date NOT NULL,
  `horario_entrega` time NOT NULL,
  `forma_contato` varchar(255) NOT NULL,
  `observacao` text,
  `forma_pagamento` varchar(255) NOT NULL,
  `valor` float NOT NULL,
  `troco` float DEFAULT NULL,
  `id_endereco` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pedido`
--

INSERT INTO `pedido` (`id_pedido`, `id_cliente`, `id_cesta`, `data_contato`, `data_desejada_entrega`, `horario_desejado_entrega`, `data_entrega`, `horario_entrega`, `forma_contato`, `observacao`, `forma_pagamento`, `valor`, `troco`, `id_endereco`) VALUES
(1, 1, 1, '2019-04-02', '2019-04-17', '11:00:00', '2019-04-10', '00:37:00', 'telefone', 'sddwsdsds', 'dinheiro', 1, 200, 1),
(2, 1, 1, '2019-04-02', '2019-04-17', '11:00:00', '2019-04-10', '00:37:00', 'whats', 'vfgghhg', 'dinheiro', 200, 100, 1),
(3, 1, 1, '2019-04-02', '2019-04-17', '11:00:00', '2019-04-10', '00:37:00', 'whats', 'vfgghhg', 'dinheiro', 200, 100, 2),
(6, 11, 3, '2019-04-02', '2019-04-10', '00:00:00', '2019-04-22', '00:00:00', 'face', '565858', 'debito', 1, 666, 2),
(7, 6, 2, '2019-04-15', '2019-04-18', '15:22:00', '2019-04-29', '16:22:00', 'telefone', 'frgtyht', 'dinheiro', 1, 100, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `id_produto` int(5) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `tipo_pesagem` varchar(10) NOT NULL,
  `peso` float NOT NULL,
  `marca` varchar(255) NOT NULL,
  `custo` float NOT NULL,
  `imagem` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id_produto`, `nome`, `tipo_pesagem`, `peso`, `marca`, `custo`, `imagem`) VALUES
(1, 'Suco', 'gramas', 80, 'Tang', 0.89, NULL),
(2, 'Farinha de Milho', 'kilo', 1, 'OrquÃ­dea', 1, NULL),
(3, 'Bolacha Recheada', 'gramas', 90, 'Bauduco', 0.89, 'bolacha.webp'),
(4, 'Ã“leo de Soja', 'ml', 500, 'ConcÃ³rdia', 2.89, NULL),
(5, 'Arroz2', 'kilo', 5, 'Namorado', 8, 'arroz.png'),
(6, 'FeijÃ£o', 'kilo', 1, 'Namorado', 3, NULL),
(7, 'AÃ§ucar', 'kilo', 5, 'Caravelas', 2.5, 'acucar.jpg'),
(8, 'MacarrÃ£o', 'gramas', 500, 'Isabela', 2.7, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cesta`
--
ALTER TABLE `cesta`
  ADD PRIMARY KEY (`id_cesta`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indexes for table `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`id_endereco`);

--
-- Indexes for table `item_cesta`
--
ALTER TABLE `item_cesta`
  ADD PRIMARY KEY (`id_item`);

--
-- Indexes for table `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_pedido`);

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id_produto`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cesta`
--
ALTER TABLE `cesta`
  MODIFY `id_cesta` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `endereco`
--
ALTER TABLE `endereco`
  MODIFY `id_endereco` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `item_cesta`
--
ALTER TABLE `item_cesta`
  MODIFY `id_item` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `id_produto` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
