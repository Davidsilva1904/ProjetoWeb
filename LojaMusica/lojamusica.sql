-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14-Abr-2021 às 14:20
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `lojamusica`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `carrinhos`
--

CREATE TABLE `carrinhos` (
  `carrinhos_id` int(11) NOT NULL,
  `carrinhos_ref` varchar(150) NOT NULL,
  `carrinhos_log_id` int(11) NOT NULL,
  `carrinhos_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `carrinhos`
--

INSERT INTO `carrinhos` (`carrinhos_id`, `carrinhos_ref`, `carrinhos_log_id`, `carrinhos_status`) VALUES
(0, '71986561e44866b750a9dd1de57ffc616519e6bf371846f19fdae1a8265765ea', 1, 0),
(0, '507a22f0b64e39795d981a32c9dbcebd6c9c3a95d264f0cb914b2eb88782409c', 0, 0),
(0, '74fd1856920d0d92b3ac53b28190d2f6985e327af54fddbb3b005eda84429c5e', 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `carrinho_items`
--

CREATE TABLE `carrinho_items` (
  `items_id` int(11) NOT NULL,
  `items_carrinhos_id` int(11) NOT NULL,
  `items_prd_id` int(11) NOT NULL,
  `items_prd_qta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `dados`
--

CREATE TABLE `dados` (
  `dados_id` int(11) NOT NULL,
  `dados_nome` varchar(100) NOT NULL,
  `dados_apelido` varchar(100) NOT NULL,
  `dados_morada` varchar(100) NOT NULL,
  `dados_localidade` varchar(100) NOT NULL,
  `dados_cp` varchar(100) NOT NULL,
  `dados_telefone` varchar(15) NOT NULL,
  `login_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `dados`
--

INSERT INTO `dados` (`dados_id`, `dados_nome`, `dados_apelido`, `dados_morada`, `dados_localidade`, `dados_cp`, `dados_telefone`, `login_id`) VALUES
(18, 'david', 'Sivilino', 'caganeira', '', '2835', '939012554', 23);

-- --------------------------------------------------------

--
-- Estrutura da tabela `logins`
--

CREATE TABLE `logins` (
  `log_id` int(11) NOT NULL,
  `log_email` varchar(100) NOT NULL,
  `log_senha` varchar(100) NOT NULL,
  `log_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `logins`
--

INSERT INTO `logins` (`log_id`, `log_email`, `log_senha`, `log_type`) VALUES
(1, 'damigsilva@gmail.com', '123', 0),
(2, 'damigsilva@gmail.com', '123', 1),
(23, '1@gmail.com', '123', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `prd_id` int(11) NOT NULL,
  `prd_nome` varchar(100) NOT NULL,
  `prd_preço` decimal(2,0) NOT NULL,
  `prd_descricao` text NOT NULL,
  `prd_foto` varchar(100) NOT NULL,
  `prd_destaque` int(11) NOT NULL,
  `prd_ref` varchar(100) NOT NULL,
  `prd_promo_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`prd_id`, `prd_nome`, `prd_preço`, `prd_descricao`, `prd_foto`, `prd_destaque`, `prd_ref`, `prd_promo_id`) VALUES
(2, 'Zé', '11', 'aaaa', '6.jpg', 1, '5\r\n', NULL),
(8, 'xcvxcv', '3', 'zxczxc', '5.jpg', 1, '1', NULL),
(9, 'valete', '99', 'asdasd', '4.jpg', 1, 'vanessa', 1),
(11, 'David', '99', 'ss', '7.jpg', 1, '3', 2),
(12, 'Zé', '21', 'ssss', '5.jpg', 1, 'sss', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `promos`
--

CREATE TABLE `promos` (
  `promo_id` int(11) NOT NULL,
  `promo_nome` varchar(100) NOT NULL,
  `promo_val` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `promos`
--

INSERT INTO `promos` (`promo_id`, `promo_nome`, `promo_val`) VALUES
(1, 'ss', 10),
(2, 'sss', 11);

-- --------------------------------------------------------

--
-- Estrutura da tabela `stocks`
--

CREATE TABLE `stocks` (
  `stock_id` int(11) NOT NULL,
  `stock_prd_id` int(11) NOT NULL,
  `stock_qta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `stocks`
--

INSERT INTO `stocks` (`stock_id`, `stock_prd_id`, `stock_qta`) VALUES
(0, 0, 0),
(0, 0, 0),
(0, 0, 0),
(0, 0, 0),
(0, 0, 0),
(0, 0, 0),
(0, 0, 0),
(0, 0, 0),
(0, 0, 0),
(0, 0, 0),
(0, 0, 0),
(0, 0, 0),
(0, 0, 0),
(0, 0, 0),
(1, 16, 20),
(1, 1, 22),
(0, 0, 0),
(0, 0, 0),
(0, 0, 0),
(0, 0, 0),
(0, 0, 0),
(0, 0, 0),
(0, 0, 0),
(0, 0, 0),
(0, 0, 0),
(0, 0, 0),
(0, 0, 0),
(0, 0, 0),
(0, 0, 0),
(0, 0, 0),
(0, 1, 0),
(0, 2, 0),
(0, 3, 0),
(0, 4, 0),
(0, 5, 0),
(0, 6, 0),
(0, 7, 0),
(0, 8, 1),
(0, 9, 22),
(0, 10, 0),
(0, 11, 0),
(0, 0, 0),
(0, 0, 0),
(0, 0, 0),
(0, 0, 0),
(0, 0, 0),
(0, 12, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `venda_carrinho`
--

CREATE TABLE `venda_carrinho` (
  `venda_id` int(11) NOT NULL,
  `venda_valor` varchar(100) NOT NULL,
  `venda_carrinho` int(11) NOT NULL,
  `venda_data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `venda_carrinho`
--

INSERT INTO `venda_carrinho` (`venda_id`, `venda_valor`, `venda_carrinho`, `venda_data`) VALUES
(0, '0', 0, '2020-08-21'),
(0, '14.4', 25, '2020-07-07'),
(1, '14.4', 25, '2020-07-07'),
(0, '0', 0, '2020-08-23'),
(0, '26.4', 0, '2020-08-23'),
(0, '26.4', 0, '2020-08-23'),
(0, '0', 0, '2020-08-23'),
(0, '3', 0, '2020-08-23'),
(0, '3', 0, '2020-08-23'),
(0, '11', 0, '2020-08-24'),
(0, '11', 0, '2020-08-24'),
(0, '44', 0, '2020-08-24');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `dados`
--
ALTER TABLE `dados`
  ADD PRIMARY KEY (`dados_id`),
  ADD UNIQUE KEY `login_id` (`login_id`);

--
-- Índices para tabela `logins`
--
ALTER TABLE `logins`
  ADD PRIMARY KEY (`log_id`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`prd_id`);

--
-- Índices para tabela `promos`
--
ALTER TABLE `promos`
  ADD PRIMARY KEY (`promo_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `dados`
--
ALTER TABLE `dados`
  MODIFY `dados_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `logins`
--
ALTER TABLE `logins`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `prd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
