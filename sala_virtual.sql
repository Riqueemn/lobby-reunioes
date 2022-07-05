-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 05-Jul-2022 às 02:11
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sala_virtual`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `lobbys`
--

CREATE TABLE `lobbys` (
  `id` int(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `status` int(255) NOT NULL,
  `sala` int(255) NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `lobbys`
--

INSERT INTO `lobbys` (`id`, `nome`, `status`, `sala`, `link`) VALUES
(1, 'lobby_1', 1, 0, ''),
(2, 'lobby_2', 0, 0, ''),
(3, 'lobby_3', 0, 0, ''),
(4, 'lobby_4', 0, 0, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users_suporte`
--

CREATE TABLE `users_suporte` (
  `id` int(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `senha` int(255) NOT NULL,
  `status` int(255) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users_suporte`
--

INSERT INTO `users_suporte` (`id`, `nome`, `senha`, `status`) VALUES
(1, 'Henrique', 1234, 1),
(3, 'Leones', 12345, 0),
(4, 'Lindalana', 123456, 0),
(5, 'Camille', 1234567, 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `lobbys`
--
ALTER TABLE `lobbys`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users_suporte`
--
ALTER TABLE `users_suporte`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `lobbys`
--
ALTER TABLE `lobbys`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `users_suporte`
--
ALTER TABLE `users_suporte`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
