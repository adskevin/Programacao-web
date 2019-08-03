-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 03-Ago-2019 às 18:08
-- Versão do servidor: 10.1.38-MariaDB
-- versão do PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forum`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `idCategoria` int(11) NOT NULL,
  `nome` char(100) DEFAULT NULL,
  `dataDeCriacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fk_idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`idCategoria`, `nome`, `dataDeCriacao`, `fk_idUsuario`) VALUES
(1, 'Categoria 1', '2019-07-14 17:01:34', 16),
(2, 'Categoria 2', '2019-07-14 18:32:53', 16),
(3, 'Categoria 3', '2019-07-14 22:49:22', 16),
(4, 'Categoria 4', '2019-07-14 22:49:28', 16),
(5, 'Categoria 5', '2019-07-14 22:49:34', 16),
(6, 'Categoria 6', '2019-07-14 22:49:42', 16);

-- --------------------------------------------------------

--
-- Estrutura da tabela `foruns`
--

CREATE TABLE `foruns` (
  `idForum` int(11) NOT NULL,
  `nome` char(100) DEFAULT NULL,
  `dataDeCriacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fk_idUsuario` int(11) DEFAULT NULL,
  `fk_idCategoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `foruns`
--

INSERT INTO `foruns` (`idForum`, `nome`, `dataDeCriacao`, `fk_idUsuario`, `fk_idCategoria`) VALUES
(6, 'Forum Somente', '2019-07-17 16:38:07', 16, 1),
(14, 'Mais um', '2019-07-17 19:06:25', 16, 2),
(15, 'Outro novo', '2019-07-17 19:06:34', 16, 3),
(16, 'Mais outro', '2019-07-17 19:06:41', 16, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `posts`
--

CREATE TABLE `posts` (
  `idPost` int(11) NOT NULL,
  `nome` char(100) DEFAULT NULL,
  `conteudo` text,
  `dataDeCriacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fk_idTopico` int(11) DEFAULT NULL,
  `fk_idUsuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `posts`
--

INSERT INTO `posts` (`idPost`, `nome`, `conteudo`, `dataDeCriacao`, `fk_idTopico`, `fk_idUsuario`) VALUES
(1, 'Post mudanÃ§a', 'Se faz como vc jÃ¡ fez. Nice >:)', '2019-07-14 20:23:17', 4, 16),
(10, 'Titulo', 'Teste', '2019-07-17 06:12:39', 4, 16),
(11, 'Primeira', 'Primeira resposta', '2019-07-17 17:02:05', 6, 16),
(12, 'Ã‰ FÃ¡cil', 'Ã‰ sÃ³ escrever da mesma forma que escreveu entre as aspas.', '2019-07-17 18:28:29', 8, 16),
(13, 'Ã‰', 'SÃ³ escreve serto, uÃ©', '2019-07-17 18:30:43', 9, 16),
(14, 'Nova resposta', '', '2019-07-17 18:38:20', 9, 16),
(20, 'Primeira resposta', 'Resposta de teste', '2019-07-17 20:51:24', 12, 16),
(21, 'Mais uma', 'Nova', '2019-07-17 20:51:37', 12, 16);

-- --------------------------------------------------------

--
-- Estrutura da tabela `topicos`
--

CREATE TABLE `topicos` (
  `idTopico` int(11) NOT NULL,
  `nome` char(100) DEFAULT NULL,
  `conteudo` text,
  `dataDeCriacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fk_idForum` int(11) DEFAULT NULL,
  `fk_idUsuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `topicos`
--

INSERT INTO `topicos` (`idTopico`, `nome`, `conteudo`, `dataDeCriacao`, `fk_idForum`, `fk_idUsuario`) VALUES
(4, 'Como preencher conteudo', 'Teste Completo 2', '2019-07-14 19:58:36', 2, 16),
(5, 'Topico Saindo do forno', 'Novissimo', '2019-07-17 16:59:01', 2, 16),
(6, 'Topico Saindo do forno', 'Novissimo', '2019-07-17 16:59:35', 2, 16),
(7, 'DÃºvida', 'Quanto Ã© um vigensentÃ©simo?', '2019-07-17 17:03:03', 8, 16),
(8, 'Topper', 'Topper', '2019-07-17 17:08:35', 9, 16),
(10, 'Topico nice', 'Nice topic you got', '2019-07-17 18:32:10', 13, 16),
(12, 'Topico 1', 'Teste 2', '2019-07-17 18:49:37', 6, 16),
(13, 'Segundo nice', 'Topper', '2019-07-17 19:02:23', 13, 16);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `nome` char(100) DEFAULT NULL,
  `nivel` int(11) DEFAULT NULL,
  `senha` char(100) DEFAULT NULL,
  `email` char(100) DEFAULT NULL,
  `dataDeCriacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nome`, `nivel`, `senha`, `email`, `dataDeCriacao`) VALUES
(16, 'User1', 3, '12345', '', '2019-07-12 22:40:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indexes for table `foruns`
--
ALTER TABLE `foruns`
  ADD PRIMARY KEY (`idForum`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`idPost`);

--
-- Indexes for table `topicos`
--
ALTER TABLE `topicos`
  ADD PRIMARY KEY (`idTopico`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `foruns`
--
ALTER TABLE `foruns`
  MODIFY `idForum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `idPost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `topicos`
--
ALTER TABLE `topicos`
  MODIFY `idTopico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
