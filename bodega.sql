-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11/06/2024 às 22:33
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bodega`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `cpf` varchar(255) DEFAULT NULL,
  `contato` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nome`, `cpf`, `contato`) VALUES
(1, 'teste', '000.000.000-00', 'null'),
(3, 'aasafasfasf', 'fsafsaf', 'gfsgsdgdsgas'),
(4, 'teste', 'Não declarado', 'Não declarado'),
(5, 'teste 3', '000.000.000-01', 'teste@email.com'),
(7, 'Bruno', '123.456.789-12', 'Não declarado'),
(8, 'Daniel', '234.567.890-12', '+55 54 4893-5403 zap');

-- --------------------------------------------------------

--
-- Estrutura para tabela `comanda`
--

CREATE TABLE `comanda` (
  `id_comanda` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `total` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `comanda`
--

INSERT INTO `comanda` (`id_comanda`, `id_cliente`, `data`, `total`) VALUES
(3, 7, '2024-06-11', 25.99),
(4, 7, '2024-06-11', 46.99),
(5, 8, '2024-06-11', 10.5),
(6, 8, '2024-06-11', 3.5),
(7, 7, '2024-06-11', 7),
(8, 7, '2024-06-11', 3.5),
(9, 1, '2024-06-11', 17.5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `comandaproduto`
--

CREATE TABLE `comandaproduto` (
  `id_comandaproduto` int(11) NOT NULL,
  `id_comanda` int(11) DEFAULT NULL,
  `id_produto` int(11) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `comandaproduto`
--

INSERT INTO `comandaproduto` (`id_comandaproduto`, `id_comanda`, `id_produto`, `quantidade`) VALUES
(1, 3, 2, 1),
(2, 4, 1, 6),
(3, 4, 2, 1),
(4, 5, 1, 3),
(5, 6, 1, 1),
(6, 7, 1, 2),
(7, 8, 1, 1),
(8, 9, 1, 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id_produto` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `marca` varchar(255) DEFAULT NULL,
  `tamanho` varchar(255) DEFAULT NULL,
  `validade` date DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `preco` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id_produto`, `nome`, `marca`, `tamanho`, `validade`, `quantidade`, `preco`) VALUES
(1, 'Cerveja', 'Brahma', '350ml', '2024-08-08', 95, 3.5),
(2, 'Vinho Tinto', 'Casillero del Diablo', '750ml', '2024-02-16', 20, 25.99),
(3, 'Vodka', 'Absolut', '1L', '2025-06-01', 10, 49.99),
(4, 'Whisky', 'Johnnie Walker', '700ml', '2026-03-01', 15, 59.99),
(5, 'Rum', 'Havana Club', '750ml', '2025-12-01', 0, 39.99),
(6, 'Cachaça', '51', '910ml', '2026-08-27', 26, 12.5);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Índices de tabela `comanda`
--
ALTER TABLE `comanda`
  ADD PRIMARY KEY (`id_comanda`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Índices de tabela `comandaproduto`
--
ALTER TABLE `comandaproduto`
  ADD PRIMARY KEY (`id_comandaproduto`),
  ADD KEY `id_comanda` (`id_comanda`),
  ADD KEY `id_produto` (`id_produto`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id_produto`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `comanda`
--
ALTER TABLE `comanda`
  MODIFY `id_comanda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `comandaproduto`
--
ALTER TABLE `comandaproduto`
  MODIFY `id_comandaproduto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `comanda`
--
ALTER TABLE `comanda`
  ADD CONSTRAINT `comanda_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`);

--
-- Restrições para tabelas `comandaproduto`
--
ALTER TABLE `comandaproduto`
  ADD CONSTRAINT `comandaproduto_ibfk_1` FOREIGN KEY (`id_comanda`) REFERENCES `comanda` (`id_comanda`),
  ADD CONSTRAINT `comandaproduto_ibfk_2` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id_produto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
