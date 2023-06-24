-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24-Jun-2023 às 01:04
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_imoveis`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `bairros`
--

CREATE TABLE `bairros` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `regiao` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `bairros`
--

INSERT INTO `bairros` (`id`, `nome`, `regiao`) VALUES
(1, 'Alvorada', 'oeste'),
(2, 'Araés', 'oeste'),
(3, 'Barra do Pari', 'oeste'),
(4, 'Centro Norte', 'oeste'),
(5, 'Centro Sul', 'oeste'),
(6, 'Cidade Alta', 'oeste'),
(7, 'Cidade Verde', 'oeste'),
(8, 'Coophamil', 'oeste'),
(9, 'Consil', 'oeste'),
(10, 'Despraiado', 'oeste'),
(11, 'Duque de Caxias', 'oeste'),
(12, 'Goiabeiras', 'oeste'),
(13, 'Jardim Beira Rio', 'oeste'),
(14, 'Jardim Cuiabá', 'oeste'),
(15, 'Jardim Mariana', 'oeste'),
(16, 'Jardim Santa Isabel', 'oeste'),
(17, 'Jardim Ubirajara', 'oeste'),
(18, 'Jardim Monte Líbano', 'oeste'),
(19, 'Jardim Primavera', 'oeste'),
(20, 'Novo Colorado', 'oeste'),
(21, 'Novo Terceiro', 'oeste'),
(22, 'Parque Residencial Tropical Ville', 'oeste'),
(23, 'Popular', 'oeste'),
(24, 'Porto', 'oeste'),
(25, 'Quilombo', 'oeste'),
(26, 'Ribeirão Da Ponte', 'oeste'),
(27, 'Ribeirão do Lipa', 'oeste'),
(28, 'Santa Marta', 'oeste'),
(29, 'Santa Rosa', 'oeste'),
(30, 'Residencial Sucuri', 'oeste'),
(31, 'Verdão', 'oeste'),
(32, 'Centro Político Administrativo', 'norte'),
(33, 'Jardim Florianópolis', 'norte'),
(34, 'Jardim União', 'norte'),
(35, 'Jardim Vitória', 'norte'),
(36, 'Jardim Aroeiras', 'norte'),
(37, 'Morada da Serra (CPA cv, II, III, IV)', 'norte'),
(38, 'Morada do Ouro', 'norte'),
(39, 'Nova Conquista', 'norte'),
(40, 'Novo Paraíso I,II', 'norte'),
(41, 'Primeiro de Março', 'norte'),
(42, 'Três Barras', 'norte'),
(43, 'Ouro Fino', 'norte'),
(44, 'Residencial Pádova', 'norte'),
(45, 'Serra Dourada', 'norte'),
(46, 'Doutor Fábio leite I e II(atual Santa fé)', 'norte'),
(47, 'Altos da Glória', 'norte'),
(48, 'Jardim Umuarama I e II', 'norte'),
(49, 'Nova Canaã I,I e III', 'norte'),
(50, 'Jardim Brasil', 'norte'),
(51, 'Altos da Serra I e II', 'norte'),
(52, 'Centro America', 'norte'),
(53, 'Flor da Mata (área invadida)', 'norte'),
(54, 'Tancredo Neves', 'norte'),
(55, 'Residencial Jardim Videira', 'norte'),
(56, 'Araés', 'leste'),
(57, 'Areão', 'leste'),
(58, 'Bandeirantes', 'leste'),
(59, 'Baú', 'leste'),
(60, 'Bela Marina', 'leste'),
(61, 'Bela Vista', 'leste'),
(62, 'Boa Esperança', 'leste'),
(63, 'Bosque da Saúde', 'leste'),
(64, 'Cachoeira das Garças', 'leste'),
(65, 'Campo Velho', 'leste'),
(66, 'São Mateus', 'leste'),
(67, 'Canjica', 'leste'),
(68, 'Carumbé', 'leste'),
(69, 'Dom Aquino', 'leste'),
(70, 'Dom Bosco', 'leste'),
(71, 'Grande Terceiro', 'leste'),
(72, 'Jardim Aclimação', 'leste'),
(73, 'Jardim das Américas', 'leste'),
(74, 'Jardim Califórnia', 'leste'),
(75, 'Jardim Eldorado', 'leste'),
(76, 'Jardim Europa', 'leste'),
(77, 'Jardim Imperial', 'leste'),
(78, 'Jardim Itália', 'leste'),
(79, 'Jardim Leblon', 'leste'),
(80, 'Jardim Paulista', 'leste'),
(81, 'Jardim Petrópolis', 'leste'),
(82, 'Jardim Shangri-Lá', 'leste'),
(83, 'Jardim Tropical', 'leste'),
(84, 'Jardim Universitário', 'leste'),
(85, 'Da Lixeira', 'leste'),
(86, 'Morada dos Nobres', 'leste'),
(87, 'Novo Mato Grosso', 'leste'),
(88, 'Novo Horizonte', 'leste'),
(89, 'Planalto', 'leste'),
(90, 'Paiaguás', 'leste'),
(91, 'Pedregal', 'leste'),
(92, 'Pico do Amor', 'leste'),
(93, 'Do Poção', 'leste'),
(94, 'Praeirinho', 'leste'),
(95, 'Praeiro', 'leste'),
(96, 'Recanto dos Pássaros', 'leste'),
(97, 'Residencial Itamarati', 'leste'),
(98, 'Residencial Santa Inês', 'leste'),
(99, 'Residencial São Carlos', 'leste'),
(100, 'Santa Cruz', 'leste'),
(101, 'São Roque', 'leste'),
(102, 'Sol Nascente', 'leste'),
(103, 'Terra Nova', 'leste'),
(104, 'Do Terceiro', 'leste'),
(105, 'UFMT (Campus Universitário)', 'leste'),
(106, 'Altos do Cerrado', 'sul'),
(107, 'Altos do Coxipó', 'sul'),
(108, 'Cohab São Gonçalo', 'sul'),
(109, 'Coophema', 'sul'),
(110, 'Coxipó', 'sul'),
(111, 'Jardim Comodoro', 'sul'),
(112, 'Jardim Fortaleza', 'sul'),
(113, 'Jardim Gramado', 'sul'),
(114, 'Jardim Industriário', 'sul'),
(115, 'Jardim dos Ipês', 'sul'),
(116, 'Jardim Mossoró', 'sul'),
(117, 'Jardim das Palmeiras', 'sul'),
(118, 'Jardim Passaredo', 'sul'),
(119, 'Jardim Presidente', 'sul'),
(120, 'Jordão', 'sul'),
(121, 'Lagoa Azul', 'sul'),
(122, 'Nossa Senhora Aparecida', 'sul'),
(123, 'Nova Esperança', 'sul'),
(124, 'Novo Milenio', 'sul'),
(125, 'Osmar Cabral', 'sul'),
(126, 'Parque Atalaia', 'sul'),
(127, 'Parque Cuiabá', 'sul'),
(128, 'Parque Georgia', 'sul'),
(129, 'Parque Residencial', 'sul'),
(130, 'Parque Ohara', 'sul'),
(131, 'Pascoal Ramos', 'sul'),
(132, 'Pedra 90', 'sul'),
(133, 'Real Parque', 'sul'),
(134, 'Residencial Coxipó', 'sul'),
(135, 'Residencial Itapajé', 'sul'),
(136, 'Residencial Santa Terezinha I', 'sul'),
(137, 'Residencial Santa Terezinha II', 'sul'),
(138, 'Santa Laura', 'sul'),
(139, 'São Gonçalo', 'sul'),
(140, 'São Gonçalo Beira Rio', 'sul'),
(141, 'São João Del Rei', 'sul'),
(142, 'São José', 'sul'),
(143, 'São Sebastião', 'sul'),
(144, 'São Francisco', 'sul'),
(145, 'Tijucal', 'sul'),
(146, 'Vista Alegre', 'sul'),
(147, 'Jd Itamarati', 'sul');

-- --------------------------------------------------------

--
-- Estrutura da tabela `faixavalor`
--

CREATE TABLE `faixavalor` (
  `id_valor` int(11) NOT NULL,
  `faixa_preco` varchar(255) NOT NULL,
  `faixa_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `faixavalor`
--

INSERT INTO `faixavalor` (`id_valor`, `faixa_preco`, `faixa_desc`) VALUES
(1, '100000-200000', '100mil - 200mil'),
(2, '200001-300000', '201mil - 300mil'),
(3, '300001-400000', '301mil - 400mil'),
(4, '400001-500000', '401mil - 500mil'),
(5, '500001-600000', '501mil - 600mil'),
(6, '600001-700000', '601mil - 700mil'),
(7, '700001-800000', '701mil - 800mil'),
(8, '800001-900000', '801mil - 900mil'),
(9, '900001-1000000', '901mil - 1 Milhão'),
(10, '1000001-1000000000', 'Acima de 1 Milhão');

-- --------------------------------------------------------

--
-- Estrutura da tabela `imagem`
--

CREATE TABLE `imagem` (
  `id` int(11) NOT NULL,
  `id_imovel` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `incluida_em` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `imovel`
--

CREATE TABLE `imovel` (
  `id_imovel` int(11) NOT NULL,
  `cod_imovel` varchar(255) DEFAULT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `id_bairro` varchar(255) NOT NULL,
  `id_proprietario` varchar(255) NOT NULL,
  `valor` int(11) DEFAULT NULL,
  `valor_condominio` int(11) DEFAULT NULL,
  `iptu` int(11) DEFAULT NULL,
  `area_construida` varchar(255) DEFAULT NULL,
  `quartos` varchar(255) DEFAULT NULL,
  `banheiros` varchar(255) DEFAULT NULL,
  `garagem` varchar(255) DEFAULT NULL,
  `cozinha` varchar(255) DEFAULT NULL,
  `sala` varchar(255) DEFAULT NULL,
  `garden` varchar(255) DEFAULT NULL,
  `sacada` varchar(255) DEFAULT NULL,
  `lavanderia` varchar(255) DEFAULT NULL,
  `suite` varchar(255) DEFAULT NULL,
  `elevador` varchar(255) DEFAULT NULL,
  `area_lazer` varchar(255) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `views` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1' COMMENT '"1=Ativado | 2=Desativado"',
  `data_criacao` datetime DEFAULT NULL,
  `data_atualizacao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `leads`
--

CREATE TABLE `leads` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `whatsapp` varchar(255) DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `valor` varchar(255) DEFAULT NULL,
  `bairro` varchar(255) DEFAULT NULL,
  `quartos` varchar(255) NOT NULL,
  `data` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `leads`
--

INSERT INTO `leads` (`id`, `nome`, `whatsapp`, `url`, `valor`, `bairro`, `quartos`, `data`) VALUES
(1, 'João Victor', '(65) 99633-5509', 'C:\\xampp\\htdocs\\apartamentoavendacuiaba\\real-estate/apartamentoavendacuiaba/real-estate/apartamento-de-3-quartos-20230011 ', NULL, NULL, '', '2023-06-16 00:00:00'),
(2, 'João Victor', '(65) 99999-9999', 'C:\\xampp\\htdocs\\apartamentoavendacuiaba\\real-estate/apartamentoavendacuiaba/real-estate/apartamento-de-3-quartos-20230011 ', '100000 ', 'Cachoeira das Garças ', '1', '2023-06-16 00:00:00'),
(3, 'João Victor', '(65) 99999-9999', 'C:\\xampp\\htdocs\\apartamentoavendacuiaba\\real-estate/apartamentoavendacuiaba/real-estate/apartamento-de-3-quartos-20230011 ', '100000 ', 'Cachoeira das Garças ', '1', '2023-06-17 00:00:00'),
(4, 'eee', '6599999999999', 'C:\\xampp\\htdocs\\apartamentoavendacuiaba\\real-estate/apartamentoavendacuiaba/real-estate/apto2-2222-3333-20230004 ', '120000 ', 'Cachoeira das Garças ', '12', '2023-06-17 00:00:00'),
(5, 'João Victor', '65 99633-5509', 'C:\\xampp\\htdocs\\apartamentoavendacuiaba\\real-estate/apartamentoavendacuiaba/real-estate/apto2-2222-3333-20230004 ', '120000 ', 'Cachoeira das Garças ', '12', '2023-06-17 00:00:00'),
(6, 'João Victor', '65 99633-5509', 'C:\\xampp\\htdocs\\apartamentoavendacuiaba\\real-estate/apartamentoavendacuiaba/real-estate/apto2-2222-3333-20230004 ', '120000 ', 'Cachoeira das Garças ', '12', '2023-06-17 17:54:14'),
(7, 'João Victor', '65 99633-5509', 'C:\\xampp\\htdocs\\apartamentoavendacuiaba\\real-estate/apartamentoavendacuiaba/real-estate/apto2-2222-3333-20230004 ', '120000 ', 'Cachoeira das Garças ', '12', '2023-06-17 11:55:53'),
(8, 'joao victor', '(88) 88888-8888', 'C:\\xampp\\htdocs\\apartamentoavendacuiaba\\real-estate/apartamentoavendacuiaba/real-estate/apto2-2222-3333-20230004 ', '120000 ', 'Cachoeira das Garças ', '12', '2023-06-17 11:57:29'),
(9, 'eeeee', '(33) 33333-3333', 'C:\\xampp\\htdocs\\apartamentoavendacuiaba\\real-estate/apartamentoavendacuiaba/real-estate/apto2-2222-3333-20230004 ', '120000 ', 'Cachoeira das Garças ', '12', '2023-06-17 12:09:16'),
(10, 'João Victor', '659933333333333', 'C:\\xampp\\htdocs\\apartamentoavendacuiaba\\real-estate/apartamentoavendacuiaba/real-estate/apto2-2222-3333-20230004 ', '120000 ', 'Cachoeira das Garças ', '12', '2023-06-17 12:13:28'),
(11, 'João Victor', '65996339999', 'C:\\xampp\\htdocs\\apartamentoavendacuiaba\\real-estate/apartamentoavendacuiaba/real-estate/apto2-2222-3333-20230004 ', '120000 ', 'Cachoeira das Garças ', '12', '2023-06-17 12:13:50'),
(12, 'João Victor Vieira', '(65) 99999-9999', 'C:\\xampp\\htdocs\\apartamentoavendacuiaba\\real-estate/apartamentoavendacuiaba/real-estate/apto2-2222-3333-20230004 ', '120000 ', 'Cachoeira das Garças ', '12', '2023-06-17 12:15:36'),
(13, 'João', '(65) 99633-5509', 'C:\\xampp\\htdocs\\apartamentoavendacuiaba\\real-estate/apartamentoavendacuiaba/real-estate/apartamento-no-araes-20230007 ', '290000 ', 'Alvorada ', '3', '2023-06-17 12:28:22'),
(14, 'João', '(65) 99633-5509', 'C:\\xampp\\htdocs\\apartamentoavendacuiaba\\real-estate/apartamentoavendacuiaba/real-estate/Grande-apartamento-na-Av--do-CPA-com-3-quartos-1-suite-20230012 ', '320000 ', 'Duque de Caxias ', '2', '2023-06-17 15:40:03');

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfil`
--

CREATE TABLE `perfil` (
  `id` int(11) NOT NULL,
  `nome_user` varchar(255) NOT NULL,
  `imob_autonomo` varchar(255) DEFAULT NULL,
  `whatsapp` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `descricao_user` varchar(255) NOT NULL,
  `fb` varchar(255) NOT NULL,
  `ig` varchar(255) NOT NULL,
  `linkedin` varchar(255) NOT NULL,
  `site` varchar(255) NOT NULL,
  `creci` varchar(255) NOT NULL,
  `access_type` varchar(255) NOT NULL DEFAULT 'user',
  `payment` varchar(255) NOT NULL DEFAULT 'free'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `bairros`
--
ALTER TABLE `bairros`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `faixavalor`
--
ALTER TABLE `faixavalor`
  ADD PRIMARY KEY (`id_valor`);

--
-- Índices para tabela `imagem`
--
ALTER TABLE `imagem`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `imovel`
--
ALTER TABLE `imovel`
  ADD PRIMARY KEY (`id_imovel`);

--
-- Índices para tabela `leads`
--
ALTER TABLE `leads`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `bairros`
--
ALTER TABLE `bairros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT de tabela `faixavalor`
--
ALTER TABLE `faixavalor`
  MODIFY `id_valor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `imagem`
--
ALTER TABLE `imagem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=638;

--
-- AUTO_INCREMENT de tabela `leads`
--
ALTER TABLE `leads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
