-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02-Out-2020 às 23:13
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `coletareversa`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbdagente`
--

CREATE TABLE `tbdagente` (
  `IDREGISTRO` int(11) NOT NULL,
  `NOME` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbdagente`
--

INSERT INTO `tbdagente` (`IDREGISTRO`, `NOME`) VALUES
(1, 'POA-UPX');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbdautorizacao`
--

CREATE TABLE `tbdautorizacao` (
  `IDREGISTRO` int(11) NOT NULL,
  `IDCOLETA` int(100) NOT NULL,
  `AUTORIZACAO` varchar(200) NOT NULL,
  `NOME` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbdautorizacao`
--

INSERT INTO `tbdautorizacao` (`IDREGISTRO`, `IDCOLETA`, `AUTORIZACAO`, `NOME`) VALUES
(3046, 129, './../uploads/489846541687.pdf', '489846541687.pdf'),
(3047, 129, './../uploads/521346879879.pdf', '521346879879.pdf'),
(3048, 130, './../uploads/489846541687.pdf', '489846541687.pdf'),
(3049, 130, './../uploads/521346879879.pdf', '521346879879.pdf'),
(3050, 130, './../uploads/612315467513.pdf', '612315467513.pdf'),
(3051, 131, './../uploads/216548679879.pdf', '216548679879.pdf'),
(3052, 131, './../uploads/321354654879.pdf', '321354654879.pdf'),
(3053, 131, './../uploads/489846541687.pdf', '489846541687.pdf'),
(3054, 132, './../uploads/216548679879.pdf', '216548679879.pdf'),
(3055, 132, './../uploads/321354654879.pdf', '321354654879.pdf'),
(3056, 132, './../uploads/489846541687.pdf', '489846541687.pdf'),
(3057, 133, './../uploads/489846541687.pdf', '489846541687.pdf'),
(3058, 133, './../uploads/521346879879.pdf', '521346879879.pdf'),
(3059, 133, './../uploads/612315467513.pdf', '612315467513.pdf'),
(3060, 136, './../uploads/785468498798.pdf', '785468498798.pdf'),
(3061, 136, './../uploads/879846518797.pdf', '879846518797.pdf'),
(3062, 136, './../uploads/984615468798.pdf', '984615468798.pdf'),
(3063, 137, './../uploads/autorizacao/785468498798.pdf', '785468498798.pdf'),
(3064, 137, './../uploads/autorizacao/879846518797.pdf', '879846518797.pdf'),
(3065, 137, './../uploads/autorizacao/984615468798.pdf', '984615468798.pdf'),
(3066, 138, './../uploads/autorizacao/785468498798.pdf', '785468498798.pdf'),
(3067, 138, './../uploads/autorizacao/879846518797.pdf', '879846518797.pdf'),
(3068, 138, './../uploads/autorizacao/984615468798.pdf', '984615468798.pdf'),
(3069, 139, './../uploads/autorizacao/879846518797.pdf', '879846518797.pdf'),
(3070, 139, './../uploads/autorizacao/984615468798.pdf', '984615468798.pdf');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbdcoletas`
--

CREATE TABLE `tbdcoletas` (
  `IDREGISTRO` int(11) NOT NULL,
  `CTE` tinyint(1) NOT NULL,
  `PDFCOLETA` varchar(300) NOT NULL,
  `NUMEROCOLETA` varchar(300) NOT NULL,
  `ACEITA` tinyint(1) NOT NULL DEFAULT 0,
  `AUTORIZACAO` tinyint(1) NOT NULL,
  `NUMEROEMBARQUE` varchar(300) NOT NULL,
  `DOCUMENTADO` tinyint(1) NOT NULL,
  `CONCLUIDO` tinyint(1) NOT NULL,
  `COLETADO` tinyint(1) NOT NULL,
  `EMBARQUE` tinyint(1) NOT NULL,
  `DATAACEITE` date NOT NULL,
  `HORAACEITE` time NOT NULL,
  `VISTODADOS` tinyint(1) NOT NULL,
  `EMITIDO` tinyint(1) NOT NULL,
  `DATASOLICITACAO` date NOT NULL,
  `HORASOLICITACAO` time NOT NULL,
  `DATACOLETADO` date NOT NULL,
  `HORACOLETADO` time NOT NULL,
  `DATADOCUMENTADO` date NOT NULL,
  `HORADOCUMENTADO` time NOT NULL,
  `DATAEMITIDO` date NOT NULL,
  `HORAEMITIDO` time NOT NULL,
  `DATAEMBARQUE` date NOT NULL,
  `HORAEMBARQUE` time NOT NULL,
  `HORAINI` time NOT NULL,
  `HORAFIM` time NOT NULL,
  `CLIENTE` varchar(200) NOT NULL,
  `LACRE` varchar(100) NOT NULL,
  `OBSERVACAO` text NOT NULL,
  `DATALIMITE` date NOT NULL,
  `HORALIMITE` time NOT NULL,
  `AGENTE` varchar(100) NOT NULL,
  `VISIVEL` tinyint(1) NOT NULL,
  `PDFNOME` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbdcoletas`
--

INSERT INTO `tbdcoletas` (`IDREGISTRO`, `CTE`, `PDFCOLETA`, `NUMEROCOLETA`, `ACEITA`, `AUTORIZACAO`, `NUMEROEMBARQUE`, `DOCUMENTADO`, `CONCLUIDO`, `COLETADO`, `EMBARQUE`, `DATAACEITE`, `HORAACEITE`, `VISTODADOS`, `EMITIDO`, `DATASOLICITACAO`, `HORASOLICITACAO`, `DATACOLETADO`, `HORACOLETADO`, `DATADOCUMENTADO`, `HORADOCUMENTADO`, `DATAEMITIDO`, `HORAEMITIDO`, `DATAEMBARQUE`, `HORAEMBARQUE`, `HORAINI`, `HORAFIM`, `CLIENTE`, `LACRE`, `OBSERVACAO`, `DATALIMITE`, `HORALIMITE`, `AGENTE`, `VISIVEL`, `PDFNOME`) VALUES
(129, 1, './../uploads/165165468494.pdf', '123', 1, 0, '', 1, 1, 1, 1, '2020-09-29', '19:49:00', 1, 1, '2020-09-29', '19:47:00', '2020-09-29', '19:49:00', '2020-09-29', '19:49:00', '0000-00-00', '00:00:00', '0000-00-00', '19:52:00', '08:00:00', '18:00:00', 'Teste', '1234', 'Sed ut perspiciatis unde omnis iste natus err sit voluptatem accusantium dolemque laudantium, totam rem aperiam eaque ipsa, quae ab illo invente veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni doles eos, qui ratione voluptatem sequi nesciunt, neque pro quisquam est, qui', '2020-09-30', '18:00:00', 'POA-UPX', 1, '165165468494.pdf'),
(130, 1, './../uploads/165165468494.pdf', '123', 1, 0, '', 1, 1, 1, 1, '2020-09-29', '21:26:00', 1, 1, '2020-09-29', '21:26:00', '2020-09-29', '21:26:00', '2020-09-29', '21:52:00', '0000-00-00', '00:00:00', '0000-00-00', '22:08:00', '08:00:00', '18:00:00', 'Teste', '1234', 'Sed ut perspiciatis unde omnis iste natus err sit voluptatem accusantium dolemque laudantium, totam rem aperiam eaque ipsa, quae ab illo invente veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni doles eos, qui ratione voluptatem sequi nesciunt, neque pro quisquam est, qui', '2020-09-30', '18:00:00', 'POA-UPX', 1, '165165468494.pdf'),
(131, 1, './../uploads/165165468494.pdf', '123', 1, 0, '', 1, 1, 1, 1, '2020-09-30', '20:13:00', 1, 1, '2020-09-30', '20:12:00', '2020-09-30', '20:13:00', '2020-09-30', '20:14:00', '0000-00-00', '00:00:00', '0000-00-00', '20:17:00', '08:00:00', '18:00:00', 'Teste', '1234', 'Lem ipsum lita turpis quam consequat amet scelerisque ultricies erat hendrerit scelerisque, dui maecenas justo ante tellus placerat sem quisque sit etiam. mbi himenaeos a quisque pharetra commodo tellus quam sem, metus hac mattis congue est ante duis at iaculis, bibendum viverra vitae at convallis ac class. mollis nisl sagittis a hendrerit praesent.', '2020-10-01', '18:00:00', 'POA-UPX', 1, '165165468494.pdf'),
(132, 0, './../uploads/165165468494.pdf', '123', 1, 0, '', 1, 1, 1, 1, '2020-09-30', '20:58:00', 1, 1, '2020-09-30', '20:58:00', '2020-09-30', '20:58:00', '2020-09-30', '20:58:00', '0000-00-00', '00:00:00', '0000-00-00', '21:00:00', '07:00:00', '18:00:00', 'Teste', '1234', 'Lem ipsum lita turpis quam consequat amet scelerisque ultricies erat hendrerit scelerisque, dui maecenas justo ante tellus placerat sem quisque sit etiam. mbi himenaeos a quisque pharetra commodo tellus quam sem, metus hac mattis congue est ante duis at iaculis, bibendum viverra vitae at convallis ac class. mollis nisl sagittis a hendrerit praesent.', '2020-10-01', '18:00:00', 'POA-UPX', 1, '165165468494.pdf'),
(133, 1, './../uploads/165165468494.pdf', '123', 1, 0, '', 1, 1, 1, 1, '2020-10-01', '20:53:00', 1, 1, '2020-10-01', '20:53:00', '2020-10-01', '20:53:00', '2020-10-01', '20:53:00', '0000-00-00', '00:00:00', '0000-00-00', '21:01:00', '08:00:00', '18:00:00', 'Teste', '1234', 'teste', '2020-10-02', '18:00:00', 'POA-UPX', 1, '165165468494.pdf'),
(134, 0, './../uploads/165165468494.pdf', '123', 0, 0, '', 0, 0, 0, 0, '0000-00-00', '00:00:00', 0, 0, '2020-10-01', '20:53:00', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '08:00:00', '18:00:00', 'Teste', '1234', 'teste', '2020-10-02', '18:00:00', 'POA-UPX', 0, '165165468494.pdf'),
(135, 0, './../uploads/solicitacao165165468494.pdf', '123', 0, 0, '', 0, 0, 0, 0, '0000-00-00', '00:00:00', 0, 0, '2020-10-01', '22:17:00', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '08:00:00', '18:00:00', 'Teste', '1234', 'teste', '2020-10-02', '18:00:00', 'POA-UPX', 0, '165165468494.pdf'),
(136, 0, './../uploads/solicitacao/165165468494.pdf', '123', 1, 0, '', 1, 0, 1, 0, '2020-10-01', '22:20:00', 1, 1, '2020-10-01', '22:18:00', '2020-10-01', '22:20:00', '2020-10-01', '22:22:00', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '08:00:00', '18:00:00', 'Teste', '1234', 'teste', '2020-10-02', '08:00:00', 'POA-UPX', 0, '165165468494.pdf'),
(137, 0, './../uploads/solicitacao/165165468494.pdf', '123', 1, 0, '', 1, 1, 1, 1, '2020-10-01', '22:30:00', 1, 1, '2020-10-01', '22:30:00', '2020-10-01', '22:30:00', '2020-10-01', '22:30:00', '0000-00-00', '00:00:00', '0000-00-00', '22:39:00', '08:00:00', '18:00:00', 'Teste', '1234', 'teste', '2020-10-02', '18:00:00', 'POA-UPX', 1, '165165468494.pdf'),
(138, 0, './../uploads/solicitacao/165165468494.pdf', '456', 1, 0, '', 1, 1, 1, 1, '2020-10-01', '22:46:00', 1, 1, '2020-10-01', '22:46:00', '2020-10-01', '22:46:00', '2020-10-01', '22:46:00', '0000-00-00', '00:00:00', '0000-00-00', '22:51:00', '08:00:00', '18:00:00', 'Teste', '1234', 'teste', '2020-10-02', '18:00:00', 'POA-UPX', 1, '165165468494.pdf'),
(139, 0, './../uploads/solicitacao/165165468494.pdf', '456', 1, 0, '', 1, 1, 1, 1, '2020-10-01', '22:54:00', 1, 1, '2020-10-01', '22:54:00', '2020-10-01', '22:54:00', '2020-10-01', '22:55:00', '0000-00-00', '00:00:00', '0000-00-00', '23:09:00', '08:00:00', '18:00:00', 'Teste', '1234', 'teste', '2020-10-02', '18:00:00', 'POA-UPX', 1, '165165468494.pdf');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbdcte`
--

CREATE TABLE `tbdcte` (
  `IDREGISTRO` int(11) NOT NULL,
  `CTE` varchar(100) NOT NULL,
  `IDCOLETA` int(100) NOT NULL,
  `NOME` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbdcte`
--

INSERT INTO `tbdcte` (`IDREGISTRO`, `CTE`, `IDCOLETA`, `NOME`) VALUES
(58, './../uploads/216548679879.pdf', 129, '216548679879.pdf'),
(59, './../uploads/321354654879.pdf', 129, '321354654879.pdf'),
(60, './../uploads/612315467513.pdf', 130, '612315467513.pdf'),
(61, './../uploads/785468498798.pdf', 130, '785468498798.pdf'),
(62, './../uploads/879846518797.pdf', 130, '879846518797.pdf'),
(63, './../uploads/984615468798.pdf', 130, '984615468798.pdf'),
(64, './../uploads/521346879879.pdf', 131, '521346879879.pdf'),
(65, './../uploads/612315467513.pdf', 131, '612315467513.pdf'),
(66, './../uploads/785468498798.pdf', 131, '785468498798.pdf'),
(67, './../uploads/785468498798.pdf', 132, '785468498798.pdf'),
(68, './../uploads/879846518797.pdf', 132, '879846518797.pdf'),
(69, './../uploads/984615468798.pdf', 132, '984615468798.pdf'),
(70, './../uploads/785468498798.pdf', 133, '785468498798.pdf'),
(71, './../uploads/879846518797.pdf', 133, '879846518797.pdf'),
(72, './../uploads/984615468798.pdf', 133, '984615468798.pdf'),
(73, './../uploads/785468498798.pdf', 136, '785468498798.pdf'),
(74, './../uploads/879846518797.pdf', 136, '879846518797.pdf'),
(75, './../uploads/984615468798.pdf', 136, '984615468798.pdf'),
(76, './../uploads/216548679879.pdf', 136, '216548679879.pdf'),
(77, './../uploads/cte/785468498798.pdf', 137, '785468498798.pdf'),
(78, './../uploads/cte/879846518797.pdf', 137, '879846518797.pdf'),
(79, './../uploads/cte/984615468798.pdf', 137, '984615468798.pdf'),
(80, './../uploads/cte/785468498798.pdf', 138, '785468498798.pdf'),
(81, './../uploads/cte/879846518797.pdf', 138, '879846518797.pdf'),
(82, './../uploads/cte/984615468798.pdf', 138, '984615468798.pdf'),
(83, './../uploads/cte/879846518797.pdf', 139, '879846518797.pdf'),
(84, './../uploads/cte/984615468798.pdf', 139, '984615468798.pdf');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbddadosnf`
--

CREATE TABLE `tbddadosnf` (
  `IDREGISTRO` int(11) NOT NULL,
  `QUANTIDADE` varchar(10) NOT NULL,
  `PESOREAL` varchar(10) NOT NULL,
  `PESOCUBADO` varchar(10) NOT NULL,
  `CUBAGEM` varchar(200) NOT NULL,
  `IDNF` int(100) NOT NULL,
  `ALTURA` float NOT NULL,
  `COMPRIMENTO` float NOT NULL,
  `LARGURA` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbddadosnf`
--

INSERT INTO `tbddadosnf` (`IDREGISTRO`, `QUANTIDADE`, `PESOREAL`, `PESOCUBADO`, `CUBAGEM`, `IDNF`, `ALTURA`, `COMPRIMENTO`, `LARGURA`) VALUES
(152, '2', '2', '', '', 104, 2, 2, 2),
(153, '2', '2', '', '', 105, 2, 2, 2),
(154, '2', '2', '', '', 105, 2, 2, 2),
(155, '2', '2', '', '', 105, 2, 2, 2),
(156, '2', '2', '', '', 105, 2, 2, 2),
(157, '2', '2', '', '', 106, 2, 2, 2),
(158, '2', '2', '', '', 107, 2, 2, 2),
(159, '2', '2', '', '', 108, 3, 2, 2),
(160, '2', '2', '', '', 109, 2, 2, 2),
(161, '3', '3', '', '', 109, 3, 3, 3),
(162, '2', '2', '', '', 110, 2, 2, 2),
(163, '2', '2', '', '', 111, 2, 2, 2),
(164, '2', '2', '', '', 112, 2, 2, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbdembarque`
--

CREATE TABLE `tbdembarque` (
  `IDREGISTRO` int(11) NOT NULL,
  `NUMEROEMBARQUE` int(50) NOT NULL,
  `TRANSFERIDOR` varchar(100) NOT NULL,
  `IDCOLETA` int(50) NOT NULL,
  `CTE` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbdembarque`
--

INSERT INTO `tbdembarque` (`IDREGISTRO`, `NUMEROEMBARQUE`, `TRANSFERIDOR`, `IDCOLETA`, `CTE`) VALUES
(11, 1231231, 'SOL', 129, 3213123),
(12, 1231231, 'SOL', 130, 3213123),
(13, 1231231, 'SOL', 131, 3213123),
(14, 1231231, 'SOL', 132, 3213123),
(15, 1231231, 'LATAM', 133, 3213123),
(16, 1231231, 'LATAM', 133, 3213123),
(17, 1231231, 'SOL', 137, 3213123),
(18, 1231231, 'JEM (DFL)', 138, 3213123),
(19, 1231231, 'SOL', 139, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbdnf`
--

CREATE TABLE `tbdnf` (
  `IDREGISTRO` int(11) NOT NULL,
  `IDCOLETA` int(10) NOT NULL,
  `NUMERONOTA` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbdnf`
--

INSERT INTO `tbdnf` (`IDREGISTRO`, `IDCOLETA`, `NUMERONOTA`) VALUES
(104, 129, 1),
(105, 130, 1),
(106, 131, 1),
(107, 132, 1),
(108, 133, 1),
(109, 136, 1),
(110, 137, 1),
(111, 138, 1),
(112, 139, 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tbdagente`
--
ALTER TABLE `tbdagente`
  ADD PRIMARY KEY (`IDREGISTRO`);

--
-- Índices para tabela `tbdautorizacao`
--
ALTER TABLE `tbdautorizacao`
  ADD PRIMARY KEY (`IDREGISTRO`);

--
-- Índices para tabela `tbdcoletas`
--
ALTER TABLE `tbdcoletas`
  ADD PRIMARY KEY (`IDREGISTRO`);

--
-- Índices para tabela `tbdcte`
--
ALTER TABLE `tbdcte`
  ADD PRIMARY KEY (`IDREGISTRO`);

--
-- Índices para tabela `tbddadosnf`
--
ALTER TABLE `tbddadosnf`
  ADD PRIMARY KEY (`IDREGISTRO`);

--
-- Índices para tabela `tbdembarque`
--
ALTER TABLE `tbdembarque`
  ADD PRIMARY KEY (`IDREGISTRO`);

--
-- Índices para tabela `tbdnf`
--
ALTER TABLE `tbdnf`
  ADD PRIMARY KEY (`IDREGISTRO`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tbdagente`
--
ALTER TABLE `tbdagente`
  MODIFY `IDREGISTRO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tbdautorizacao`
--
ALTER TABLE `tbdautorizacao`
  MODIFY `IDREGISTRO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3071;

--
-- AUTO_INCREMENT de tabela `tbdcoletas`
--
ALTER TABLE `tbdcoletas`
  MODIFY `IDREGISTRO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT de tabela `tbdcte`
--
ALTER TABLE `tbdcte`
  MODIFY `IDREGISTRO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT de tabela `tbddadosnf`
--
ALTER TABLE `tbddadosnf`
  MODIFY `IDREGISTRO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT de tabela `tbdembarque`
--
ALTER TABLE `tbdembarque`
  MODIFY `IDREGISTRO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `tbdnf`
--
ALTER TABLE `tbdnf`
  MODIFY `IDREGISTRO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
