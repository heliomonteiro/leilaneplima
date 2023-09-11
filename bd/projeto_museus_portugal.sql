-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 04-Jul-2018 às 00:25
-- Versão do servidor: 10.1.13-MariaDB
-- PHP Version: 5.5.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projeto_museus_portugal`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `codigo` int(11) NOT NULL,
  `descricao` varchar(60) NOT NULL,
  `unidade_contexto` int(11) DEFAULT NULL,
  `tipo_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`codigo`, `descricao`, `unidade_contexto`, `tipo_categoria`) VALUES
(1, 'Museu de Arte', 1, 1),
(2, 'Museu de Arqueologia', 1, 1),
(3, 'Museu de História', 1, 1),
(4, 'Museu de Ciências Naturais e História Natural', 1, 1),
(5, 'Museu de Ciências e Tecnologia', 1, 1),
(6, 'Museu de Etnografia e Antropologia', 1, 1),
(7, 'Museu Temático', 1, 1),
(8, 'Administração Central', 2, 1),
(9, 'Governo Regional', 2, 1),
(10, 'Administração Local', 2, 1),
(11, 'Privado', 2, 1),
(14, 'Etnográficos', 3, 1),
(15, 'Arqueológicos', 3, 1),
(22, 'Artísticos e Históricos', 3, 1),
(23, 'Naturais', 3, 1),
(24, 'Técnico-científicos e Industriais', 3, 1),
(25, 'Bibliográficos, Documentais e Arquivísticos', 3, 1),
(26, 'Audiovisuais', 3, 1),
(31, 'Amistoso', 4, 1),
(32, 'Formal', 4, 1),
(33, 'Indiferente', 4, 1),
(34, 'Inquiridor', 4, 1),
(35, 'Inexistente', 4, 1),
(36, 'E-mail', 5, 1),
(37, 'Site', 5, 1),
(38, 'Mídias Sociais', 5, 1),
(39, 'Recetivo', 6, 1),
(40, 'Formal', 6, 1),
(41, 'Indiferente', 6, 1),
(42, 'Inexistente', 6, 1),
(43, 'Zona Urbana Central', 7, 1),
(44, 'Zona Rural', 7, 1),
(45, 'Teatro', 8, 1),
(46, 'Museu', 8, 1),
(47, 'Biblioteca', 8, 1),
(48, 'Galeria', 8, 1),
(49, 'Cineteatro', 8, 1),
(50, 'Nenhum', 8, 1),
(51, 'Restrita', 9, 1),
(52, 'Média', 9, 1),
(53, 'Ampla', 9, 1),
(54, 'Atrativo', 10, 1),
(55, 'Seguro', 10, 1),
(56, 'Poluído', 10, 1),
(57, 'Abandonado', 10, 1),
(58, 'Inseguro', 10, 1),
(59, 'Núcleos expositivos', 11, 1),
(60, 'Atividades Educativas', 11, 1),
(61, 'Descanso e Lazer', 11, 1),
(62, 'Nenhum', 11, 1),
(63, 'Placas no trajeto', 12, 1),
(64, 'Identificação na fachada', 12, 1),
(68, 'Informações institucionais na parte externa', 12, 1),
(69, 'Informações operacionais na parte externa', 12, 1),
(70, 'Painéis em relevo', 12, 1),
(71, 'Língua', 12, 4),
(72, 'Símbolos internacionais de acesso', 13, 1),
(73, 'Setores e áreas do museu', 13, 1),
(74, 'Rotas e direções', 13, 1),
(75, 'Mapa do visitante', 13, 1),
(76, 'Nenhuma', 13, 1),
(77, 'Língua', 13, 4),
(78, 'Autocarro', 14, 1),
(79, 'Automóvel', 14, 1),
(80, 'Motocicleta', 14, 1),
(81, 'Bicicleta', 14, 1),
(82, 'A pé', 14, 1),
(83, 'Rampa', 15, 1),
(84, 'Escada', 15, 1),
(85, 'Ascensor', 15, 1),
(86, 'Escada rolante', 15, 1),
(87, 'Sinalização tátil direcional', 16, 1),
(88, 'Sinalização tátil de alerta', 16, 1),
(89, 'Gratuita', 17, 1),
(90, 'Paga', 17, 1),
(91, 'Desníveis/obstáculos', 18, 1),
(92, 'Ladeiras', 18, 1),
(93, 'Portões fechados', 18, 1),
(94, 'Portas fechadas', 18, 1),
(95, 'Transporte restrito', 18, 1),
(96, 'Ausência de sinalização', 18, 1),
(97, 'Nenhuma', 18, 1),
(98, 'Monumento Nacional', 19, 1),
(99, 'Interesse Público', 19, 1),
(100, 'Interesse Municipal', 19, 1),
(101, 'Histórico não classificado', 19, 1),
(102, 'Contemporâneo', 19, 1),
(103, 'Arquivo', 20, 1),
(104, 'Secretaria', 20, 1),
(105, 'Centro Cultural', 20, 1),
(106, 'Biblioteca', 20, 1),
(107, 'Grêmio Recreativo', 20, 1),
(108, 'Construção', 21, 1),
(109, 'Adaptação', 21, 1),
(110, 'Cessão', 21, 1),
(111, 'Estacionamento', 22, 1),
(112, 'Refeitório/copa', 22, 1),
(113, 'Cacifos', 22, 1),
(114, 'Sanitários', 22, 1),
(115, 'Arrumos', 22, 1),
(116, 'Estacionamento', 23, 1),
(117, 'Estacionamento acessível', 23, 1),
(118, 'Receção', 23, 1),
(119, 'Áreas de descanso', 23, 1),
(120, 'Lanchonete', 23, 1),
(121, 'Loja/livraria', 23, 1),
(122, 'Lavatórios', 23, 1),
(123, 'Bebedouro', 23, 1),
(124, 'Fraldário', 23, 1),
(125, 'Sanitários', 23, 1),
(126, 'Sanitários acessíveis', 23, 1),
(127, 'Bilheteria', 23, 1),
(128, 'Auditório', 23, 1),
(129, 'Sala multimídia', 23, 1),
(130, 'Cinema', 23, 1),
(131, 'Sala de pesquisa', 23, 1),
(132, 'Biblioteca', 23, 1),
(133, 'Cacifos', 23, 1),
(134, 'Cadeiras de rodas', 23, 1),
(135, 'Carrinhos de bebé', 23, 1),
(136, 'Vigilância', 24, 1),
(137, 'Detetor de presença', 24, 1),
(138, 'Câmeras', 24, 1),
(139, 'Alarmes', 24, 1),
(140, 'Ausente', 24, 1),
(141, 'Extintores', 25, 1),
(142, 'Mangueiras', 25, 1),
(143, 'Detetor e alarme de incêndio', 25, 1),
(144, 'Saídas de emergência', 25, 1),
(145, 'Iluminação', 25, 1),
(146, 'Sinalização', 25, 1),
(147, 'Ausente', 25, 1),
(148, 'Espaço para exposição de longa duração', 26, 1),
(149, 'Espaço para exposição temporária', 26, 1),
(150, 'Espaço para exposição itinerante', 26, 1),
(151, 'Reserva ', 27, 1),
(152, 'Laboratório', 27, 1),
(153, 'Educativo', 27, 1),
(154, 'Secretaria', 28, 1),
(155, 'Diretoria', 28, 1),
(156, 'Sala de reunião', 28, 1),
(157, 'Livro de visitas e/ou registo interno', 29, 1),
(158, 'Virtual (acessos)', 29, 1),
(159, 'Ausente', 29, 1),
(160, 'Painéis/livros de comentários', 30, 1),
(161, 'Livro de sugestões e reclamações', 30, 1),
(162, 'Inquéritos (questionários)', 30, 1),
(163, 'Ausente', 30, 1),
(164, 'Newsletter', 31, 1),
(165, 'Fôlderes informativos', 31, 1),
(166, 'Cartões de visita', 31, 1),
(167, 'Campanhas Virtuais', 31, 1),
(168, 'Horários alternativos de atendimento', 31, 1),
(169, 'Distribuição/sorteio de brindes', 31, 1),
(171, 'SMS', 31, 1),
(172, 'Ausente', 31, 1),
(173, 'Visitas guiadas/orientadas', 32, 1),
(174, 'Debates', 32, 1),
(175, 'Palestras', 32, 1),
(176, 'Seminários', 32, 1),
(177, 'Cursos', 32, 1),
(178, 'Oficinas/ateliês', 32, 1),
(179, 'Atendimento ao público especial', 32, 1),
(180, 'Apresentações cênicas/espetáculos', 32, 1),
(181, 'Lançamento de livros', 32, 1),
(182, 'Decisão autocrática', 34, 1),
(183, 'Decisão em equipa', 34, 1),
(184, 'Decisão cooperativa', 34, 1),
(185, 'Título da exposição', 35, 2),
(186, 'Longa duração', 36, 1),
(187, 'Temporária', 36, 1),
(188, 'Itinerante', 36, 1),
(210, 'Cronológica', 37, 1),
(211, 'Classificatória', 37, 1),
(212, 'Temática', 37, 1),
(217, 'História Municipal', 38, 1),
(218, 'Memória Rural', 38, 1),
(219, 'Diversidade Científica', 38, 1),
(220, 'Recorte', 39, 2),
(226, 'Personalidades', 40, 1),
(228, 'Agricultura e trabalho rural', 40, 1),
(229, 'Cotidiano doméstico', 40, 1),
(230, 'Religião', 40, 1),
(231, 'Política', 40, 1),
(232, 'Educação', 40, 1),
(233, 'Saúde', 40, 1),
(234, 'Transportes', 40, 1),
(235, 'Artes', 40, 1),
(236, 'Comunicação', 40, 1),
(237, 'Relíquias e curiosidades', 40, 1),
(238, 'Festas cívicas', 40, 1),
(239, 'Comércio e Indústria', 40, 1),
(240, 'Economia', 40, 1),
(241, 'Profissões', 40, 1),
(242, 'Obras e desenvolvimento', 40, 1),
(243, 'Arquitetura', 40, 1),
(244, 'Esporte', 40, 1),
(245, 'Revolução', 40, 1),
(246, 'Tecnologia', 40, 1),
(247, 'Eventos militares', 40, 1),
(248, 'História familiar', 40, 1),
(249, 'Eras geológicas', 40, 1),
(250, 'Fauna', 40, 1),
(251, 'Flora', 40, 1),
(252, 'Minerais e Rochas', 40, 1),
(253, 'Astros', 40, 1),
(254, 'Anatomia', 40, 1),
(255, 'Experimentos científicos', 40, 1),
(256, 'Evolução humana', 40, 1),
(257, 'Etnográficos', 41, 4),
(258, 'Arqueológicos', 41, 4),
(259, 'Artísticos ', 41, 4),
(260, 'Naturais', 41, 4),
(261, 'Técnico-científicos e Industriais', 41, 4),
(262, 'Históricos', 41, 4),
(263, 'Audiovisuais', 41, 4),
(264, 'Outros bens', 41, 4),
(265, 'Bibliográficos', 41, 4),
(266, 'Documentais', 41, 4),
(267, 'Arquivísticos', 41, 4),
(269, 'Geográfica', 42, 1),
(270, 'Informacional', 42, 1),
(271, 'Conceitual', 42, 1),
(272, 'Ausente', 42, 1),
(273, 'Sinalização', 43, 1),
(274, 'Audiovisual', 43, 1),
(275, 'Sonorização', 43, 1),
(276, 'Iluminação', 43, 1),
(277, 'Objetos atrativos', 43, 1),
(278, 'Ausente', 43, 1),
(279, 'Aberto', 44, 1),
(280, 'Fechado', 44, 1),
(281, 'Sugerido', 44, 1),
(282, 'Livre', 45, 1),
(283, 'Orientada', 45, 1),
(284, 'Indicada', 45, 1),
(285, 'Informação', 46, 1),
(286, 'Atenção', 46, 1),
(287, 'Retenção', 46, 1),
(288, 'Contraste', 46, 1),
(289, 'Interação', 46, 1),
(290, 'Portas amplas', 47, 1),
(291, 'Janelas acessiveis visualmente e fisicamente', 47, 1),
(292, 'Corredores largos', 47, 1),
(293, 'Sinalização tátil', 47, 1),
(294, 'Áreas de repouso com assento', 47, 1),
(295, 'Ascensor', 47, 1),
(296, 'Escada com corrimão', 47, 1),
(297, 'Placas e painéis em relevo', 47, 1),
(298, 'Audioguias', 47, 1),
(299, 'Maquetas', 47, 1),
(300, 'Objetos táteis', 47, 1),
(301, 'Materiais educativos específicos', 47, 1),
(302, 'Bases de sustentação de vitrines com encaixe para cadeirante', 47, 1),
(303, 'Vitrinas', 48, 1),
(304, 'Sons', 48, 1),
(305, 'Iluminação', 48, 1),
(306, 'Cenários', 48, 1),
(307, 'Cores', 48, 1),
(308, 'Textos', 48, 1),
(309, 'Painéis', 48, 1),
(310, 'Legendas', 48, 1),
(311, 'Fotos', 48, 1),
(312, 'Mapas', 48, 1),
(313, 'Ilustrações', 48, 1),
(314, 'Maquetas', 48, 1),
(315, 'Vídeos', 48, 1),
(316, 'Manequins', 48, 1),
(318, 'Mesas', 49, 1),
(321, 'Suportes ', 49, 1),
(322, 'De mesa', 50, 1),
(323, 'De parede', 50, 1),
(324, 'De centro', 50, 1),
(325, 'Modular', 50, 1),
(326, 'Quentes', 51, 1),
(327, 'Frias', 51, 1),
(328, 'Neutras', 51, 1),
(329, 'Natural', 52, 1),
(330, 'Artificial', 52, 1),
(331, 'Etiquetas', 53, 1),
(332, 'Textos explicativos', 53, 1),
(333, 'Padrão Tipográfico', 53, 4),
(334, 'Conteúdo padronizado', 53, 4),
(335, 'Localização padronizada', 53, 4),
(336, 'Legibilidade', 53, 4),
(337, 'Informações apresentadas', 53, 4),
(338, 'Línguas', 53, 4),
(339, 'Tradicional', 54, 1),
(340, 'Sensorial', 54, 1),
(341, 'Cenográfica', 54, 1),
(342, 'Tecnológica', 54, 1),
(343, 'Temperatura', 55, 1),
(344, 'Umidade', 55, 1),
(345, 'Pragas', 55, 1),
(348, 'Câmeras', 56, 1),
(349, 'Vigilância', 56, 1),
(350, 'Barreiras físicas', 56, 1),
(351, 'Avisos', 56, 1),
(352, 'Ausente', 56, 1),
(353, 'Observações', 56, 2),
(354, 'Ciência', 57, 1),
(355, 'Método de campo', 57, 1),
(356, 'Laboratório', 57, 1),
(357, 'Tipos de sítios arqueológicos', 57, 1),
(358, 'Nome de seção expositiva', 57, 1),
(359, 'Textos', 58, 1),
(360, 'Fotos', 58, 1),
(361, 'Vídeos', 58, 1),
(362, 'Ilustrações', 58, 1),
(363, 'Placas indicativas', 58, 1),
(364, 'Equipamentos e materiais de trabalho expostos', 58, 1),
(365, 'Em uma seção do espaço expositivo', 59, 1),
(366, 'Dentro de uma sala específica', 59, 1),
(367, 'Em todo o espaço expositivo', 59, 1),
(368, 'Dentro de uma gaveta ou vitrine expositiva', 59, 1),
(376, 'Poluentes', 55, 1),
(377, 'Ausente', 55, 1),
(399, 'Local e/ou regional', 60, 1),
(400, 'De outros municípios', 60, 1),
(401, 'De outros estados', 60, 1),
(402, 'De outros países', 60, 1),
(403, 'Não indicada', 60, 1),
(404, 'Um espaço', 61, 1),
(405, 'Sala/seção Arqueologia', 61, 1),
(406, 'Sala/seção Pré-história', 61, 1),
(407, 'Sala/seção História', 61, 1),
(408, 'Sala/seção Etnografia', 61, 1),
(409, 'Sala/seção Ciências Naturais', 61, 1),
(410, 'Todo espaço', 61, 1),
(411, 'Isolados', 63, 1),
(412, 'Agrupados por tipo', 63, 1),
(413, 'Agrupados por função', 63, 1),
(414, 'Agrupados por forma', 63, 1),
(415, 'Agrupados por matéria-prima', 63, 1),
(416, 'Misturados entre objetos arqueológicos', 63, 1),
(417, 'Misturados entre objetos históricos', 63, 1),
(418, 'Misturados entre objetos de ciências naturais', 63, 1),
(419, 'Misturados entre objetos etnográficos', 63, 1),
(420, 'Início', 64, 1),
(421, 'Meio', 64, 1),
(422, 'Fim', 64, 1),
(423, 'Textos', 65, 1),
(424, 'Vitrinas', 65, 1),
(425, 'Fotos', 65, 1),
(426, 'Vídeos', 65, 1),
(427, 'Painéis/banners', 65, 1),
(428, 'Ilustrações', 65, 1),
(429, 'Mapas', 65, 1),
(430, 'Legendas', 65, 1),
(431, 'Cenários', 65, 1),
(432, 'Maquetas', 65, 1),
(433, 'Cores', 65, 1),
(434, 'Abandonada', 66, 1),
(435, 'Organizada', 66, 1),
(436, 'Desorganizada', 66, 1),
(437, 'Ultrapassada', 66, 1),
(438, 'Excitação', 67, 1),
(439, 'Satisfação', 67, 1),
(440, 'Admiração', 67, 1),
(441, 'Emoção', 67, 1),
(442, 'Insatisfação', 67, 1),
(443, 'Tédio', 67, 1),
(444, 'Deceção', 67, 1),
(445, 'Preocupação', 67, 1),
(446, 'Profissionalismo', 68, 1),
(447, 'Familiaridade', 68, 1),
(448, 'Pouca relevância', 68, 1),
(449, 'Passividade', 68, 1),
(450, 'Fragilidade', 68, 1),
(451, 'Observações', 68, 2),
(452, 'Observações', 6, 2),
(453, 'Observações', 12, 2),
(455, 'Observações', 13, 2),
(456, 'Vitrinas', 62, 1),
(457, 'Armários', 62, 1),
(458, 'Gavetas', 62, 1),
(459, 'Paredes', 62, 1),
(460, 'Suportes', 62, 1),
(461, 'Chão', 62, 1),
(462, 'Inexistente', 5, 1),
(463, 'Zona Urbana Periférica', 7, 1),
(464, 'Arquivo', 8, 1),
(465, ' Unifuncional', 20, 1),
(466, 'Observações', 28, 2),
(467, 'Sim', 33, 1),
(468, 'Não', 33, 1),
(469, 'História do edifício-sede', 40, 1),
(470, 'Sim', 69, 1),
(471, 'Não', 69, 1),
(472, 'Sim', 70, 1),
(473, 'Não', 70, 1),
(474, 'Observações', 65, 2),
(475, 'Nenhum', 16, 1),
(476, 'Símbolos internacionais de acesso', 12, 1),
(477, 'Observações', 37, 2),
(478, 'Observações', 41, 2),
(479, 'Observações', 19, 2),
(481, 'Observações', 46, 2),
(482, 'Observações', 47, 2),
(483, 'Rampa', 47, 1),
(484, 'Inexistente', 27, 1),
(485, 'Inexistente', 28, 1),
(486, 'Nenhuma', 32, 1),
(487, 'Branco', 51, 1),
(488, 'Preto', 51, 1),
(490, 'Observações', 23, 2),
(491, 'Desorientação', 67, 1),
(492, 'Informações institucionais na parte interna', 13, 1),
(494, 'Observações', 25, 2),
(496, 'Iluminação', 55, 1),
(497, 'Observações', 55, 2),
(498, 'Outros bens', 3, 2),
(499, 'Observações', 44, 2),
(500, 'Observações', 45, 2),
(501, 'Observações', 34, 2),
(502, 'Cinema', 8, 1),
(503, 'Observações', 18, 2),
(504, 'Ausente', 12, 1),
(505, 'Ausente', 50, 1),
(506, 'Observações', 59, 2),
(508, 'Departamento de Patrimônio', 20, 1),
(509, 'Cotidiano de trabalho', 40, 1),
(510, 'Escravidão', 40, 1),
(511, 'Império', 40, 1),
(512, 'Meio ambiente', 38, 1),
(513, 'Cômodas', 62, 1),
(514, 'Ausente', 65, 1),
(516, 'Sertanejos', 40, 1),
(517, 'Exibição de filmes', 32, 1),
(518, 'Manequins', 65, 1),
(520, 'Outros', 20, 1),
(521, 'Arqueológicos', 70, 1),
(522, 'Etnográficos', 70, 1),
(523, 'Comboio', 14, 1),
(524, 'Métro', 14, 1),
(525, 'Especializado', 38, 1),
(526, 'Observações', 50, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias_museus`
--

CREATE TABLE `categorias_museus` (
  `museu` int(11) NOT NULL,
  `tema` int(11) NOT NULL,
  `unidade_analise` int(11) NOT NULL,
  `unidade_contexto` int(11) NOT NULL,
  `categoria` int(11) NOT NULL,
  `sub_categoria` int(11) DEFAULT NULL,
  `texto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categorias_museus`
--

INSERT INTO `categorias_museus` (`museu`, `tema`, `unidade_analise`, `unidade_contexto`, `categoria`, `sub_categoria`, `texto`) VALUES
(1, 1, 1, 1, 7, NULL, ''),
(1, 1, 1, 2, 10, NULL, ''),
(1, 1, 1, 3, 15, NULL, ''),
(1, 1, 1, 3, 22, NULL, ''),
(1, 1, 1, 3, 23, NULL, ''),
(1, 1, 1, 3, 498, NULL, ''),
(1, 1, 2, 4, 31, NULL, ''),
(1, 1, 2, 5, 36, NULL, ''),
(1, 1, 2, 5, 37, NULL, ''),
(1, 1, 2, 6, 452, NULL, 'O e-mail institucional é museudapedra@cm-marco.canaveses.pt. O site da instituição corresponde a uma página vinculada à Cultura da Câmara Municipal do Marco de Canaveses. Nesta página há informações sobre a Biblioteca Municipal, Concertos/Música, Museu da Pedra e Museu Municipal. A respeito do Museu da Pedra, há os horários de atendimento, o endereço e os contatos. Também há informações sobre núcleos expositivos, algumas fotografias e a brochura (fôlder sobre o museu) para download (frente e verso). O Museu tem Facebook (última atualização ocorreu em outubro de 2017). '),
(1, 1, 3, 7, 463, NULL, ''),
(1, 1, 3, 8, 46, NULL, ''),
(1, 1, 3, 9, 52, NULL, ''),
(1, 1, 3, 10, 54, NULL, ''),
(1, 1, 3, 10, 55, NULL, ''),
(1, 1, 3, 11, 60, NULL, ''),
(1, 1, 3, 11, 61, NULL, ''),
(1, 1, 4, 12, 63, NULL, ''),
(1, 1, 4, 12, 64, NULL, ''),
(1, 1, 4, 12, 68, NULL, ''),
(1, 1, 4, 12, 69, NULL, ''),
(1, 1, 4, 13, 73, NULL, ''),
(1, 1, 4, 13, 74, NULL, ''),
(1, 1, 4, 13, 492, NULL, ''),
(1, 1, 4, 12, 71, 1, ''),
(1, 1, 4, 13, 77, 6, ''),
(1, 1, 4, 12, 453, NULL, 'A identificação do museu é frontal e lateral. A informação institucional na parte externa corresponde à placa de inauguração (06/09/09). As informações operacionais correspondem aos dias e horários de funcionamento. Estas informações estão junto à porta de entrada de forma quase imperceptível. '),
(1, 1, 4, 13, 455, NULL, 'As informações institucionais correspondem aos apoiadores: Operação Norte (Câmara Municipal do Marco de Canaveses, Núcleo Museológico do Baixo Tâmega, Museu da Pedra, 2008); Governo Português (Ministério da Educação) e União Europeia (FEDER, Fundo Europeu de Desenvolvimento Regional). '),
(1, 1, 5, 14, 78, NULL, ''),
(1, 1, 5, 14, 79, NULL, ''),
(1, 1, 5, 14, 80, NULL, ''),
(1, 1, 5, 14, 81, NULL, ''),
(1, 1, 5, 14, 82, NULL, ''),
(1, 1, 5, 15, 83, NULL, ''),
(1, 1, 5, 15, 84, NULL, ''),
(1, 1, 5, 16, 475, NULL, ''),
(1, 1, 5, 17, 89, NULL, ''),
(1, 1, 5, 18, 93, NULL, ''),
(1, 1, 5, 18, 94, NULL, ''),
(1, 1, 5, 18, 503, NULL, 'A rampa de acesso é pela área lateral. Cabe dizer que no momento da visita técnica o portão e a porta principais estavam fechados. '),
(1, 1, 6, 19, 101, NULL, ''),
(1, 1, 6, 20, 520, NULL, ''),
(1, 1, 6, 21, 109, NULL, ''),
(1, 1, 6, 19, 479, NULL, 'Na fachada do edifício há os seguintes dizeres: "Edifício concluído sob o governo da ditadura nacional, ano de 1931"; "Vila de Alpendorada, Centro Cívico, 1993". Cabe ressaltar que o Museu fica no mesmo edifício em que está a Junta de Freguesia de Alpendorada, Várzea e Torrão. '),
(1, 1, 6, 23, 490, NULL, ''),
(1, 1, 6, 25, 494, NULL, ''),
(1, 1, 6, 22, 115, NULL, ''),
(1, 1, 6, 23, 118, NULL, ''),
(1, 1, 6, 23, 119, NULL, ''),
(1, 1, 6, 23, 125, NULL, ''),
(1, 1, 6, 23, 126, NULL, ''),
(1, 1, 6, 24, 140, NULL, ''),
(1, 1, 6, 25, 141, NULL, ''),
(1, 1, 6, 25, 146, NULL, ''),
(1, 1, 7, 26, 148, NULL, ''),
(1, 1, 7, 27, 153, NULL, ''),
(1, 1, 7, 28, 154, NULL, ''),
(1, 1, 7, 28, 466, NULL, 'O museu tem uma componente associada à promoção de ateliers direcionados para o público infanto-juvenil. Ainda, possui um serviço de atendimento.'),
(1, 1, 8, 29, 157, NULL, ''),
(1, 1, 8, 30, 160, NULL, ''),
(1, 1, 8, 31, 165, NULL, ''),
(1, 1, 8, 31, 168, NULL, ''),
(1, 1, 8, 32, 178, NULL, ''),
(1, 2, 9, 33, 467, NULL, ''),
(1, 2, 9, 34, 183, NULL, ''),
(1, 2, 9, 34, 501, NULL, 'Empresas, artistas, professores e outros museus são citados como colaboradores e doadores de acervos museológicos. '),
(1, 2, 10, 36, 186, NULL, ''),
(1, 2, 10, 37, 212, NULL, ''),
(1, 2, 10, 40, 235, NULL, ''),
(1, 2, 10, 40, 240, NULL, ''),
(1, 2, 10, 40, 241, NULL, ''),
(1, 2, 10, 40, 256, NULL, ''),
(1, 2, 10, 41, 258, 37, ''),
(1, 2, 10, 41, 258, 38, ''),
(1, 2, 10, 41, 258, 49, ''),
(1, 2, 10, 41, 259, 113, ''),
(1, 2, 10, 41, 260, 55, ''),
(1, 2, 10, 41, 260, 56, ''),
(1, 2, 10, 35, 185, NULL, 'A Pedra na Cultura'),
(1, 2, 10, 37, 477, NULL, 'Propõe apresentar o  testemunho do trabalho da pedra desde a sua extração e comercialização, justificando sua relevância como referência histórica, antropológica, cultural e socioeconômica do concelho. '),
(1, 2, 10, 39, 220, NULL, 'Apresentar a pedra e sua relação antiga com o homem, apresentar a pedra como instrumento de arte e como base da riqueza local. Nesse sentido, foram propostos três núcleos: O Homem e a Pedra; A Pedra nas Artes e A Pedra e o Desenvolvimento Local. "O Homem e a Pedra: a relação do homem com a pedra é tão antiga como a existência do próprio homem. Dela nos falam os vestígios já descobertos e os que se vão descobrindo. Há mais de dois milhões de anos, a pedra começou a ser lascada para se transformar no mais longo instrumento da vida humana"; "A Pedra nas Artes: o homem começou, desde muito cedo, a revelar as suas capacidades artísticas. Primeiro de representação, depois de abstração. A pedra foi o meio primordial de fixação de sensibilidade artística"; "A Pedra e o Desenvolvimento Local: o granito marca o pulsar do desenvolvimento local. A pedra é fria, mas aquece o dinamismo industrial. Os indicadores económicos mostram que a extração, transformação e comercialização do granito representam milhares de postos de trabalho, constituindo um forte contributo para a sustentabilidade económica do concelho do Marco de Canaveses". '),
(1, 2, 10, 41, 478, NULL, ''),
(1, 2, 10, 44, 499, NULL, 'No momento da visita técnica acessei o espaço pela entrada lateral, uma vez que a porta e o portão principais estavam fechados. '),
(1, 2, 10, 45, 500, NULL, 'Apesar de livre, a circulação foi acompanhada pela colaboradora da Junta da Freguesia que estava presente no momento da visita técnica. '),
(1, 2, 10, 46, 481, NULL, 'Há poemas, painéis com textos e fotografias que podem ser pontos de informação e retenção. '),
(1, 2, 10, 47, 482, NULL, ''),
(1, 2, 10, 42, 270, NULL, ''),
(1, 2, 10, 42, 271, NULL, ''),
(1, 2, 10, 43, 278, NULL, ''),
(1, 2, 10, 44, 281, NULL, ''),
(1, 2, 10, 45, 282, NULL, ''),
(1, 2, 10, 46, 285, NULL, ''),
(1, 2, 10, 46, 287, NULL, ''),
(1, 2, 10, 47, 290, NULL, ''),
(1, 2, 10, 47, 292, NULL, ''),
(1, 2, 10, 41, 262, 85, ''),
(1, 2, 10, 41, 262, 118, ''),
(1, 2, 11, 48, 308, NULL, ''),
(1, 2, 11, 48, 309, NULL, ''),
(1, 2, 11, 48, 310, NULL, ''),
(1, 2, 11, 48, 311, NULL, ''),
(1, 2, 11, 50, 505, NULL, ''),
(1, 2, 11, 51, 487, NULL, ''),
(1, 2, 11, 51, 488, NULL, ''),
(1, 2, 11, 52, 329, NULL, ''),
(1, 2, 11, 52, 330, NULL, ''),
(1, 2, 11, 53, 331, NULL, ''),
(1, 2, 11, 53, 332, NULL, ''),
(1, 2, 11, 54, 339, NULL, ''),
(1, 2, 11, 55, 343, NULL, ''),
(1, 2, 11, 55, 376, NULL, ''),
(1, 2, 11, 56, 349, NULL, ''),
(1, 2, 11, 53, 333, 19, ''),
(1, 2, 11, 53, 334, 22, ''),
(1, 2, 11, 53, 336, 25, ''),
(1, 2, 11, 53, 337, 28, ''),
(1, 2, 11, 53, 337, 29, ''),
(1, 2, 11, 53, 338, 32, ''),
(1, 2, 11, 55, 497, NULL, 'A respeito das legendas, estas são genéricas e as informações variam. Ademais, há objetos expostos sem legenda específica. Sobre o controle ambiental, notei a presença de ar condicionado e a limpeza no ambiente. '),
(1, 2, 11, 56, 353, NULL, 'A vigilância é feita pelos colaboradores do museu. '),
(1, 3, 12, 69, 471, NULL, ''),
(1, 3, 12, 59, 506, NULL, ''),
(1, 4, 13, 70, 472, NULL, ''),
(1, 4, 13, 70, 521, NULL, ''),
(1, 4, 13, 60, 399, NULL, ''),
(1, 4, 13, 61, 404, NULL, ''),
(1, 4, 13, 62, 460, NULL, ''),
(1, 4, 13, 63, 411, NULL, ''),
(1, 4, 13, 63, 412, NULL, ''),
(1, 4, 13, 63, 413, NULL, ''),
(1, 4, 13, 63, 414, NULL, ''),
(1, 4, 13, 63, 415, NULL, ''),
(1, 4, 13, 65, 425, NULL, ''),
(1, 4, 13, 65, 427, NULL, ''),
(1, 4, 13, 65, 428, NULL, ''),
(1, 4, 13, 65, 430, NULL, ''),
(1, 4, 13, 65, 474, NULL, 'As peças arqueológicas expostas são: dois machados polidos (sílex), um martelão de ferro do século XI, encontrado no Mosteiro de Alpendorada, mó, fragmento de mó e balas de canhão (estes últimos sem indicação de contexto). No espaço "O Homem e a Pedra" há uma ecrã, mas não estava funcionando no momento da visita técnica. '),
(1, 5, 14, 66, 435, NULL, ''),
(1, 5, 14, 67, 439, NULL, ''),
(1, 5, 14, 68, 446, NULL, ''),
(1, 5, 14, 68, 451, NULL, 'O Museu da Pedra fica próximo ao Memorial de Alpendorada. Esta instituição também está na Rota das Minas e Pontos de Interesse Mineiro e Geológico de Portugal. No dia da visita técnica, o colaborador responsável pelo atendimento não estava presente. Fui recepcionada e atendida por uma colaborada da Junta da Freguesia, que acompanhou toda a visita.  Apesar de ser um pequeno museu, o espaço estava limpo e organizado. '),
(1, 1, 2, 5, 38, NULL, ''),
(1, 1, 8, 32, 173, NULL, ''),
(1, 2, 11, 49, 321, NULL, ''),
(1, 2, 11, 50, 526, NULL, 'Havia uma única vitrine, mas estava deslocada do espaço expositivo principal. '),
(1, 4, 13, 64, 420, NULL, ''),
(1, 2, 10, 38, 525, NULL, ''),
(1, 1, 2, 6, 39, NULL, ''),
(1, 2, 11, 48, 313, NULL, ''),
(1, 2, 11, 51, 327, NULL, ''),
(1, 4, 13, 60, 403, NULL, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cidades`
--

CREATE TABLE `cidades` (
  `cod_cidade` int(11) NOT NULL,
  `nome` varchar(80) CHARACTER SET latin1 NOT NULL,
  `uf` varchar(2) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cidades`
--

INSERT INTO `cidades` (`cod_cidade`, `nome`, `uf`) VALUES
(11060, 'Açores', 'AC'),
(11061, 'Angra do Heroísmo', 'AC'),
(11062, 'Calheta', 'AC'),
(11063, 'Corvo', 'AC'),
(11064, 'Horta', 'AC'),
(11065, 'Lagoa', 'AC'),
(11066, 'Lajes das Flores', 'AC'),
(11067, 'Lajes do Pico', 'AC'),
(11068, 'Madalena', 'AC'),
(11069, 'Nordeste', 'AC'),
(11070, 'Ponta Delgada', 'AC'),
(11071, 'Povoação', 'AC'),
(11072, 'Praia da Vitória', 'AC'),
(11073, 'Ribeira Grande', 'AC'),
(11074, 'Santa Cruz da Graciosa', 'AC'),
(11075, 'Santa Cruz das Flores', 'AC'),
(11076, 'São Roque do Pico', 'AC'),
(11077, 'Velas', 'AC'),
(11078, 'Vila do Porto', 'AC'),
(11079, 'Vila Franca do Campo', 'AC'),
(11080, 'Aveiro', 'AV'),
(11081, 'Águeda', 'AV'),
(11082, 'Albergaria-a-Velha', 'AV'),
(11083, 'Anadia', 'AV'),
(11084, 'Arouca', 'AV'),
(11085, 'Aveiro', 'AV'),
(11086, 'Castelo de Paiva', 'AV'),
(11087, 'Espinho', 'AV'),
(11088, 'Estarreja', 'AV'),
(11089, 'Ílhavo', 'AV'),
(11090, 'Mealhada', 'AV'),
(11091, 'Murtosa', 'AV'),
(11092, 'Oliveira de Azeméis', 'AV'),
(11093, 'Oliveira do Bairro', 'AV'),
(11094, 'Ovar', 'AV'),
(11095, 'Santa Maria da Feira', 'AV'),
(11096, 'São João da Madeira', 'AV'),
(11097, 'Sever do Vouga', 'AV'),
(11098, 'Vagos', 'AV'),
(11099, 'Vale de Cambra', 'AV'),
(11100, 'Beja', 'BE'),
(11101, 'Aljustrel', 'BE'),
(11102, 'Almodôvar', 'BE'),
(11103, 'Alvito', 'BE'),
(11104, 'Barrancos', 'BE'),
(11105, 'Beja', 'BE'),
(11106, 'Castro Verde', 'BE'),
(11107, 'Cuba', 'BE'),
(11108, 'Ferreira do Alentejo', 'BE'),
(11109, 'Mértola', 'BE'),
(11110, 'Moura', 'BE'),
(11111, 'Odemira', 'BE'),
(11112, 'Ourique', 'BE'),
(11113, 'Serpa', 'BE'),
(11114, 'Vidigueira', 'BE'),
(11115, 'Braga', 'BE'),
(11116, 'Amares', 'BE'),
(11117, 'Barcelos', 'BE'),
(11118, 'Braga', 'BG'),
(11119, 'Cabeceiras de Basto', 'BG'),
(11120, 'Celorico de Basto', 'BG'),
(11121, 'Esposende', 'BG'),
(11122, 'Fafe', 'BG'),
(11123, 'Guimarães', 'BG'),
(11124, 'Póvoa de Lanhoso', 'BG'),
(11125, 'Terras de Bouro', 'BG'),
(11126, 'Vieira do Minho', 'BG'),
(11127, 'Vila Nova de Famalicão', 'BG'),
(11128, 'Vila Verde', 'BG'),
(11129, 'Vizela', 'BG'),
(11130, 'Bragança', 'BG'),
(11131, 'Alfândega da Fé', 'BG'),
(11132, 'Bragança', 'BC'),
(11133, 'Carrazeda de Ansiães', 'BC'),
(11134, 'Freixo de Espada à Cinta', 'BC'),
(11135, 'Macedo de Cavaleiros', 'BC'),
(11136, 'Miranda do Douro', 'BC'),
(11137, 'Mirandela', 'BC'),
(11138, 'Mogadouro', 'BC'),
(11139, 'Torre de Moncorvo', 'BC'),
(11140, 'Vila Flor', 'BC'),
(11141, 'Vimioso', 'BC'),
(11142, 'Vinhais', 'BC'),
(11143, 'Castelo Branco', 'BC'),
(11144, 'Belmonte', 'BC'),
(11145, 'Castelo Branco', 'CB'),
(11146, 'Covilhã', 'CB'),
(11147, 'Fundão', 'CB'),
(11148, 'Idanha-a-Nova', 'CB'),
(11149, 'Oleiros', 'CB'),
(11150, 'Penamacor', 'CB'),
(11151, 'Proença-a-Nova', 'CB'),
(11152, 'Sertã', 'CB'),
(11153, 'Vila de Rei', 'CB'),
(11154, 'Vila Velha de Ródão', 'CB'),
(11155, 'Coimbra', 'CB'),
(11156, 'Arganil', 'CB'),
(11157, 'Cantanhede', 'CB'),
(11158, 'Coimbra', 'CO'),
(11159, 'Condeixa-a-Nova', 'CO'),
(11160, 'Figueira da Foz', 'CO'),
(11161, 'Góis', 'CO'),
(11162, 'Lousã', 'CO'),
(11163, 'Mira', 'CO'),
(11164, 'Miranda do Corvo', 'CO'),
(11165, 'Montemor-o-Velho', 'CO'),
(11166, 'Oliveira do Hospital', 'CO'),
(11167, 'Pampilhosa da Serra', 'CO'),
(11168, 'Penacova', 'CO'),
(11169, 'Penela', 'CO'),
(11170, 'Soure', 'CO'),
(11171, 'Tábua', 'CO'),
(11172, 'Vila Nova de Poiares', 'CO'),
(11173, 'Évora', 'EV'),
(11174, 'Alandroal', 'EV'),
(11175, 'Arraiolos', 'EV'),
(11176, 'Borba', 'EV'),
(11177, 'Estremoz', 'EV'),
(11178, 'Évora', 'EV'),
(11179, 'Montemor-o-Novo', 'EV'),
(11180, 'Mora', 'EV'),
(11181, 'Mourão', 'EV'),
(11182, 'Olivença', 'EV'),
(11183, 'Portel', 'EV'),
(11184, 'Redondo', 'EV'),
(11185, 'Reguengos de Monsaraz', 'EV'),
(11186, 'Vendas Novas', 'EV'),
(11187, 'Viana do Alentejo', 'EV'),
(11188, 'Vila Viçosa', 'EV'),
(11189, 'Faro', 'FA'),
(11190, 'Albufeira', 'FA'),
(11191, 'Alcoutim', 'FA'),
(11192, 'Aljezur', 'FA'),
(11193, 'Castro Marim', 'FA'),
(11194, 'Faro', 'FA'),
(11195, 'Lagoa', 'FA'),
(11196, 'Lagos', 'FA'),
(11197, 'Loulé', 'FA'),
(11198, 'Monchique', 'FA'),
(11199, 'Olhão', 'FA'),
(11200, 'Portimão', 'FA'),
(11201, 'São Brás de Alportel', 'FA'),
(11202, 'Silves', 'FA'),
(11203, 'Tavira', 'FA'),
(11204, 'Vila do Bispo', 'FA'),
(11205, 'Vila Real de Santo António', 'FA'),
(11206, 'Guarda', 'GA'),
(11207, 'Aguiar da Beira', 'GA'),
(11208, 'Almeida', 'GA'),
(11209, 'Celorico da Beira', 'GA'),
(11210, 'Figueira de Castelo Rodrigo', 'GA'),
(11211, 'Fornos de Algodres', 'GA'),
(11212, 'Gouveia', 'GA'),
(11213, 'Guarda', 'GA'),
(11214, 'Manteigas', 'GA'),
(11215, 'Mêda', 'GA'),
(11216, 'Pinhel', 'GA'),
(11217, 'Sabugal', 'GA'),
(11218, 'Seia', 'GA'),
(11219, 'Trancoso', 'GA'),
(11220, 'Vila Nova de Foz Côa', 'GA'),
(11221, 'Leiria', 'LE'),
(11222, 'Alcobaça', 'LE'),
(11223, 'Alvaiázere', 'LE'),
(11224, 'Ansião', 'LE'),
(11225, 'Batalha', 'LE'),
(11226, 'Bombarral', 'LE'),
(11227, 'Caldas da Rainha', 'LE'),
(11228, 'Castanheira de Pera', 'LE'),
(11229, 'Figueiró dos Vinhos', 'LE'),
(11230, 'Leiria', 'LE'),
(11231, 'Marinha Grande', 'LE'),
(11232, 'Nazaré', 'LE'),
(11233, 'Óbidos', 'LE'),
(11234, 'Pedrógão Grande', 'LE'),
(11235, 'Peniche', 'LE'),
(11236, 'Pombal', 'LE'),
(11237, 'Porto de Mós', 'LE'),
(11238, 'Lisboa', 'LI'),
(11239, 'Alenquer', 'LI'),
(11240, 'Amadora', 'LI'),
(11241, 'Arruda dos Vinhos', 'LI'),
(11242, 'Azambuja', 'LI'),
(11243, 'Cadaval', 'LI'),
(11244, 'Cascais', 'LI'),
(11245, 'Lisboa', 'LI'),
(11246, 'Loures', 'LI'),
(11247, 'Lourinhã', 'LI'),
(11248, 'Mafra', 'LI'),
(11249, 'Odivelas', 'LI'),
(11250, 'Oeiras', 'LI'),
(11251, 'Sintra', 'LI'),
(11252, 'Sobral de Monte Agraço', 'LI'),
(11253, 'Torres Vedras', 'LI'),
(11254, 'Vila Franca de Xira', 'LI'),
(11255, 'Madeira', 'MA'),
(11256, 'Calheta', 'MA'),
(11257, 'Câmara de Lobos', 'MA'),
(11258, 'Funchal', 'MA'),
(11259, 'Machico', 'MA'),
(11260, 'Ponta do Sol', 'MA'),
(11261, 'Porto Moniz', 'MA'),
(11262, 'Porto Santo', 'MA'),
(11263, 'Ribeira Brava', 'MA'),
(11264, 'Santa Cruz', 'MA'),
(11265, 'Santana', 'MA'),
(11266, 'São Vicente', 'MA'),
(11267, 'Portalegre', 'PA'),
(11268, 'Alter do Chão', 'PA'),
(11269, 'Arronches', 'PA'),
(11270, 'Avis', 'PA'),
(11271, 'Campo Maior', 'PA'),
(11272, 'Castelo de Vide', 'PA'),
(11273, 'Crato', 'PA'),
(11274, 'Elvas', 'PA'),
(11275, 'Fronteira', 'PA'),
(11276, 'Gavião', 'PA'),
(11277, 'Marvão', 'PA'),
(11278, 'Monforte', 'PA'),
(11279, 'Nisa', 'PA'),
(11280, 'Ponte de Sor', 'PA'),
(11281, 'Portalegre', 'PA'),
(11282, 'Sousel', 'PA'),
(11283, 'Porto', 'PO'),
(11284, 'Amarante', 'PO'),
(11285, 'Baião', 'PO'),
(11286, 'Felgueiras', 'PO'),
(11287, 'Gondomar', 'PO'),
(11288, 'Lousada', 'PO'),
(11289, 'Maia', 'PO'),
(11290, 'Marco de Canaveses', 'PO'),
(11291, 'Matosinhos', 'PO'),
(11292, 'Paços de Ferreira', 'PO'),
(11293, 'Paredes', 'PO'),
(11294, 'Penafiel', 'PO'),
(11295, 'Porto', 'PO'),
(11296, 'Póvoa de Varzim', 'PO'),
(11297, 'Santo Tirso', 'PO'),
(11298, 'Trofa', 'PO'),
(11299, 'Valongo', 'PO'),
(11300, 'Vila do Conde', 'PO'),
(11301, 'Vila Nova de Gaia', 'PO'),
(11302, 'Santarém', 'AS'),
(11303, 'Abrantes', 'AS'),
(11304, 'Alcanena', 'AS'),
(11305, 'Almeirim', 'AS'),
(11306, 'Alpiarça', 'AS'),
(11307, 'Benavente', 'AS'),
(11308, 'Cartaxo', 'AS'),
(11309, 'Chamusca', 'AS'),
(11310, 'Constância', 'AS'),
(11311, 'Coruche', 'AS'),
(11312, 'Entroncamento', 'AS'),
(11313, 'Ferreira do Zêzere', 'AS'),
(11314, 'Golegã', 'AS'),
(11315, 'Mação', 'AS'),
(11316, 'Ourém', 'AS'),
(11317, 'Rio Maior', 'AS'),
(11318, 'Salvaterra de Magos', 'AS'),
(11319, 'Santarém', 'AS'),
(11320, 'Sardoal', 'AS'),
(11321, 'Tomar', 'AS'),
(11322, 'Torres Novas', 'AS'),
(11323, 'Vila Nova da Barquinha', 'AS'),
(11324, 'Setúbal', 'SE'),
(11325, 'Alcácer do Sal', 'SE'),
(11326, 'Alcochete', 'SE'),
(11327, 'Almada', 'SE'),
(11328, 'Barreiro', 'SE'),
(11329, 'Grândola', 'SE'),
(11330, 'Moita', 'SE'),
(11331, 'Montijo', 'SE'),
(11332, 'Palmela', 'SE'),
(11333, 'Santiago do Cacém', 'SE'),
(11334, 'Seixal', 'SE'),
(11335, 'Sesimbra', 'SE'),
(11336, 'Setúbal', 'SE'),
(11337, 'Sines', 'SE'),
(11338, 'Viana do Castelo', 'VC'),
(11339, 'Arcos de Valdevez', 'VC'),
(11340, 'Caminha', 'VC'),
(11341, 'Melgaço', 'VC'),
(11342, 'Monção', 'VC'),
(11343, 'Paredes de Coura', 'VC'),
(11344, 'Ponte da Barca', 'VC'),
(11345, 'Ponte de Lima', 'VC'),
(11346, 'Valença', 'VC'),
(11347, 'Viana do Castelo', 'VC'),
(11348, 'Vila Nova de Cerveira', 'VC'),
(11349, 'Vila Real', 'VR'),
(11350, 'Alijó', 'VR'),
(11351, 'Boticas', 'VR'),
(11352, 'Chaves', 'VR'),
(11353, 'Mesão Frio', 'VR'),
(11354, 'Mondim de Basto', 'VR'),
(11355, 'Montalegre', 'VR'),
(11356, 'Murça', 'VR'),
(11357, 'Peso da Régua', 'VR'),
(11358, 'Ribeira de Pena', 'VR'),
(11359, 'Sabrosa', 'VR'),
(11360, 'Santa Marta de Penaguião', 'VR'),
(11361, 'Valpaços', 'VR'),
(11362, 'Vila Pouca de Aguiar', 'VR'),
(11363, 'Vila Real', 'VR'),
(11364, 'Viseu', 'VI'),
(11365, 'Armamar', 'VI'),
(11366, 'Carregal do Sal', 'VI'),
(11367, 'Castro Daire', 'VI'),
(11368, 'Cinfães', 'VI'),
(11369, 'Lamego', 'VI'),
(11370, 'Mangualde', 'VI'),
(11371, 'Moimenta da Beira', 'VI'),
(11372, 'Mortágua', 'VI'),
(11373, 'Nelas', 'VI'),
(11374, 'Oliveira de Frades', 'VI'),
(11375, 'Penalva do Castelo', 'VI'),
(11376, 'Penedono', 'VI'),
(11377, 'Resende', 'VI'),
(11378, 'Santa Comba Dão', 'VI'),
(11379, 'São João da Pesqueira', 'VI'),
(11380, 'São Pedro do Sul', 'VI'),
(11381, 'Sátão', 'VI'),
(11382, 'Sernancelhe', 'VI'),
(11383, 'Tabuaço', 'VI'),
(11384, 'Tarouca', 'VI'),
(11385, 'Tondela', 'VI'),
(11386, 'Vila Nova de Paiva', 'VI'),
(11387, 'Viseu', 'VI'),
(11388, 'Vouzela', 'VI');

-- --------------------------------------------------------

--
-- Estrutura da tabela `imagens_museus`
--

CREATE TABLE `imagens_museus` (
  `codigo` int(11) NOT NULL,
  `codigo_museu` int(11) NOT NULL,
  `nome` varchar(250) NOT NULL,
  `descricao` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `museus`
--

CREATE TABLE `museus` (
  `codigo` int(11) NOT NULL,
  `indice` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `ano_fundacao` year(4) NOT NULL,
  `sem_fundacao` tinyint(1) NOT NULL,
  `horario_funcionamento_administrativo` varchar(100) DEFAULT NULL,
  `horario_atendimento_publico` varchar(100) DEFAULT NULL,
  `telefone` varchar(100) NOT NULL,
  `cod_cidade` int(11) NOT NULL,
  `endereco` varchar(200) NOT NULL,
  `situacao` int(11) NOT NULL,
  `observacoes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `museus`
--

INSERT INTO `museus` (`codigo`, `indice`, `nome`, `ano_fundacao`, `sem_fundacao`, `horario_funcionamento_administrativo`, `horario_atendimento_publico`, `telefone`, `cod_cidade`, `endereco`, `situacao`, `observacoes`) VALUES
(1, 0, 'Museu da Pedra do Marco de Canaveses', 2009, 0, 'De segunda-feira a sexta-feira, das 9h às 12h30min; das 14h às 17h.  ', 'Inverno: de segunda-feira a sexta-feira, das 9h às 12h30min; das 14h às 17h. ', '255 616 150', 11290, 'Avenida São João, 900. Código Postal: 4575-029, Alpendorada e Matos. ', 1, 'O Museu da Pedra foi fundado na data de 06 de setembro de 2009, em Alpendorada e Matos, concelho de Marco de Canaveses. A instituição atende o público em horário especial no Verão: de terça a sexta-feira, das 9h às 12h30min; das 14h às 17h, aos sábados das 10h às 15h. O Museu comporta essencialmente peças em granito - elementos decorativos - bem como os elementos associados do trabalho de extração e transformação do granito, segundo informações repassadas pela equipe. O Museu está na Rota das Minas e Pontos de Interesse Mineiro e Geológico de Portugal e encontra-se em um concelho que está na Rota do Românico por suas Igrejas e Mosteiro (Santo Isidoro, São Nicolau, São Martinho de Soalhães etc., Pontes (Ponte do Arco) e Memorial (Memorial de Alpendorada). ');

-- --------------------------------------------------------

--
-- Estrutura da tabela `situacoes`
--

CREATE TABLE `situacoes` (
  `cod_situacao` int(11) NOT NULL,
  `descricao` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `situacoes`
--

INSERT INTO `situacoes` (`cod_situacao`, `descricao`) VALUES
(1, 'ativo'),
(2, 'inativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sub_categorias`
--

CREATE TABLE `sub_categorias` (
  `codigo` int(11) NOT NULL,
  `categoria` int(11) NOT NULL,
  `descricao` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `sub_categorias`
--

INSERT INTO `sub_categorias` (`codigo`, `categoria`, `descricao`) VALUES
(1, 71, 'Monolingue'),
(2, 71, 'Bilingue'),
(3, 71, 'Trilingue'),
(4, 71, 'Braille'),
(5, 71, 'Áudio'),
(6, 77, 'Monolingue'),
(7, 77, 'Bilingue'),
(8, 77, 'Trilingue'),
(9, 77, 'Braille'),
(10, 77, 'Áudio'),
(11, 257, 'Cerâmicas'),
(12, 257, 'Cestarias'),
(13, 257, 'Artefatos tecidos'),
(14, 257, 'Plumárias'),
(15, 257, 'Adornos'),
(16, 257, 'Instrumentos musicais'),
(17, 257, 'Armas'),
(18, 257, 'Objetos folclóricos'),
(19, 333, 'Sim'),
(20, 333, 'Não'),
(21, 334, 'Sim'),
(22, 334, 'Não'),
(23, 335, 'Sim'),
(24, 335, 'Não'),
(25, 336, 'Boa'),
(26, 336, 'Ruim'),
(27, 336, 'Péssima'),
(28, 337, 'Históricas'),
(29, 337, 'Físicas'),
(30, 337, 'Funcionais'),
(31, 337, 'Simbólicas'),
(32, 338, 'Monolingue'),
(33, 338, 'Bilingue'),
(34, 338, 'Trilingue'),
(35, 338, 'Braille'),
(36, 338, 'Áudio'),
(37, 258, 'Artefatos/fragmentos lascados'),
(38, 258, 'Artefatos/fragmentos polidos'),
(39, 258, 'Objetos/fragmentos de cerâmica'),
(40, 258, 'Artefatos ósseos'),
(41, 258, 'Fauna malacológica'),
(47, 258, 'Ossos humanos'),
(48, 258, 'Adornos'),
(49, 258, 'Objetos de metal'),
(50, 258, 'Materiais construtivos'),
(51, 259, 'Pinturas'),
(52, 259, 'Gravuras'),
(53, 259, 'Plantas e mapas'),
(54, 259, 'Artes aplicadas'),
(55, 260, 'Rochas'),
(56, 260, 'Minerais'),
(57, 260, 'Cristais'),
(58, 260, 'Amostras de solos'),
(59, 260, 'Fósseis de animais e/ou plantas'),
(60, 261, 'Exemplares de Biologia Humana'),
(61, 261, 'Aparelhos de informática'),
(62, 261, 'Aparelhos de comunicação'),
(63, 261, 'Dispositivos de captura de imagens'),
(64, 261, 'Aparelhos de física/química'),
(65, 261, 'Instrumentos astronômicos'),
(66, 261, 'Invenções científicas'),
(67, 261, 'Veículos'),
(68, 261, 'Maquinários agrícolas'),
(69, 261, 'Maquinários e equipamentos industriais'),
(70, 261, 'Maquinários e equipamentos do transporte'),
(71, 262, 'Vestimentas'),
(72, 262, 'Móveis domésticos'),
(73, 262, 'Utensílios domésticos'),
(74, 262, 'Instrumentos musicais'),
(75, 262, 'Aparelhos pré-elétricos e elétricos'),
(76, 262, 'Ferramentas e utensílios agrícolas'),
(77, 262, 'Ferramentas da indústria'),
(78, 262, 'Móveis e instrumentos hospitalares'),
(79, 262, 'Objetos de escritório e comércio'),
(80, 262, 'Ferramentas e instrumentos de transporte'),
(81, 262, 'Relíquias'),
(82, 262, 'Moedas e notas'),
(83, 262, 'Objetos e móveis religiosos'),
(84, 262, 'Armas'),
(85, 262, 'Materiais construtivos'),
(86, 262, 'Placas'),
(87, 262, 'Troféus e/ou medalhas'),
(88, 263, 'Documentos sonoros'),
(89, 263, 'Vídeos'),
(90, 263, 'Filmes'),
(91, 263, 'Fotografias'),
(92, 264, 'Numismático'),
(93, 264, 'Trajes'),
(97, 265, 'Livros'),
(98, 265, 'Revistas'),
(99, 265, 'Periódicos'),
(100, 266, 'Documentos manuscritos'),
(101, 266, 'Jornais'),
(102, 266, 'Cartazes'),
(103, 266, 'Documentos oficiais'),
(104, 266, 'Documentos pessoais'),
(105, 267, 'Conjunto de documentos institucionais'),
(109, 267, 'Conjunto de documentos pessoais'),
(110, 262, 'Ferramentas da construção civil'),
(111, 262, 'Móveis escolares'),
(112, 262, 'Brinquedos '),
(113, 259, 'Esculturas'),
(114, 262, 'Objetos cívicos'),
(115, 262, 'Relógios'),
(116, 257, 'Brinquedos '),
(117, 260, 'Grãos/sementes/plantas'),
(118, 262, 'Ferramentas e utensílios especializados');

-- --------------------------------------------------------

--
-- Estrutura da tabela `temas`
--

CREATE TABLE `temas` (
  `codigo` int(11) NOT NULL,
  `letra` varchar(2) NOT NULL,
  `descricao` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `temas`
--

INSERT INTO `temas` (`codigo`, `letra`, `descricao`) VALUES
(1, 'A', 'MUSEU'),
(2, 'B', 'EXPOSIÇÃO'),
(3, 'C', 'ARQUEOLOGIA'),
(4, 'D', 'PATRIMÔNIO INDÍGENA'),
(5, 'E', 'EXPERIÊNCIA');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipos_categorias`
--

CREATE TABLE `tipos_categorias` (
  `codigo` int(11) NOT NULL,
  `descricao` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tipos_categorias`
--

INSERT INTO `tipos_categorias` (`codigo`, `descricao`) VALUES
(1, 'checkboxes'),
(2, 'texto'),
(3, 'imagens'),
(4, 'subcategorias');

-- --------------------------------------------------------

--
-- Estrutura da tabela `unidades_analises`
--

CREATE TABLE `unidades_analises` (
  `codigo` int(11) NOT NULL,
  `tema` int(11) NOT NULL,
  `num_romano` varchar(7) NOT NULL,
  `descricao` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `unidades_analises`
--

INSERT INTO `unidades_analises` (`codigo`, `tema`, `num_romano`, `descricao`) VALUES
(1, 1, 'I', 'Sobre a identidade do museu pesquisado'),
(2, 1, 'II', 'Sobre os pontos de encontro com o público'),
(3, 1, 'III', 'Sobre o espaço geográfico e físico'),
(4, 1, 'IV', 'Comunicação Visual'),
(5, 1, 'V', 'Sobre o acesso à instituição'),
(6, 1, 'VI', 'Sobre o espaço arquitetônico'),
(7, 1, 'VII', 'Sobre a organização espacial'),
(8, 1, 'VIII', 'Sobre o relacionamento com o público'),
(9, 2, 'IX', 'Concepção Política'),
(10, 2, 'X', 'Concepção Museológica'),
(11, 2, 'XI', 'Concepção Expográfica'),
(12, 3, 'XII', 'Arqueologia'),
(13, 4, 'XIII', 'Patrimônio Indígena'),
(14, 5, 'XIV', 'Experiência da visita');

-- --------------------------------------------------------

--
-- Estrutura da tabela `unidades_contextos`
--

CREATE TABLE `unidades_contextos` (
  `codigo` int(11) NOT NULL,
  `unidade_analise` int(11) NOT NULL,
  `num_cardinal` int(3) NOT NULL,
  `descricao` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `unidades_contextos`
--

INSERT INTO `unidades_contextos` (`codigo`, `unidade_analise`, `num_cardinal`, `descricao`) VALUES
(1, 1, 1, 'Categoria institucional'),
(2, 1, 2, 'Natureza administrativa'),
(3, 1, 3, 'Tipologia de acervo'),
(4, 2, 4, 'Atendimento telefônico'),
(5, 2, 5, 'Atendimento eletrônico'),
(6, 2, 6, 'Atendimento presencial'),
(7, 3, 7, 'Localização'),
(8, 3, 8, 'Equipamentos culturais próximos'),
(9, 3, 9, 'Circulação no entorno'),
(10, 3, 10, 'Entorno imediato da instituição'),
(11, 3, 11, 'Uso do espaço externo'),
(12, 4, 12, 'Comunicação externa'),
(13, 4, 13, 'Comunicação interna'),
(14, 5, 14, 'Meios'),
(15, 5, 15, 'Formas'),
(16, 5, 16, 'Pisos'),
(17, 5, 17, 'Entrada'),
(18, 5, 18, 'Potenciais barreiras de acesso'),
(19, 6, 19, 'Tipo de imóvel'),
(20, 6, 20, 'Funções do imóvel'),
(21, 6, 21, 'Formas de institucionalização'),
(22, 6, 22, 'Infraestrutura de uso interno'),
(23, 6, 23, 'Infraestrutura e equipamentos de uso externo (público)'),
(24, 6, 24, 'Segurança'),
(25, 6, 25, 'Segurança contra incêndio'),
(26, 7, 26, 'Setor expositivo'),
(27, 7, 27, 'Setor técnico'),
(28, 7, 28, 'Setor administrativo'),
(29, 8, 29, 'Controle de visitas (quantitativo)'),
(30, 8, 30, 'Controle de visitas (qualitativo)'),
(31, 8, 31, 'Ações de Marketing'),
(32, 8, 32, 'Ações de atendimento'),
(33, 9, 33, 'Ficha técnica'),
(34, 9, 34, 'Tomada de decisão'),
(35, 10, 35, 'Título'),
(36, 10, 36, 'Tipo de exposição'),
(37, 10, 37, 'Narrativa'),
(38, 10, 38, 'Temas'),
(39, 10, 39, 'Recorte conceitual'),
(40, 10, 40, 'Desenvolvimento conceitual'),
(41, 10, 41, 'Acervo exposto'),
(42, 10, 42, 'Orientações para o público'),
(43, 10, 43, 'Elementos de atração'),
(44, 10, 44, 'Trajeto'),
(45, 10, 45, 'Circulação interna'),
(46, 10, 46, 'Pontos de percurso'),
(47, 10, 47, 'Acessibilidade na exposição'),
(48, 11, 48, 'Recursos Expográficos'),
(49, 11, 49, 'Mobiliário de suporte ao acervo'),
(50, 11, 50, 'Vitrines'),
(51, 11, 51, 'Cores'),
(52, 11, 52, 'Iluminação'),
(53, 11, 53, 'Textos verbais'),
(54, 11, 54, 'Expografia'),
(55, 11, 55, 'Controle ambiental'),
(56, 11, 56, 'Segurança'),
(57, 12, 57, 'Formas de apresentação'),
(58, 12, 58, 'Representação'),
(59, 12, 59, 'Localização'),
(60, 13, 60, 'Procedência'),
(61, 13, 61, 'Espaços ocupados'),
(62, 13, 62, 'Acomodação'),
(63, 13, 63, 'Apresentação'),
(64, 13, 64, 'Localização'),
(65, 13, 65, 'Recursos expográficos'),
(66, 14, 66, 'Aparência visual da exposição'),
(67, 14, 67, 'Sentimentos da visita'),
(68, 14, 68, 'Imagem do museu'),
(69, 12, 0, 'A Arqueologia está nesta exposição?'),
(70, 13, 0, 'Há objetos indígenas nesta exposição?');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `fk_categoria_tipo_categoria` (`tipo_categoria`),
  ADD KEY `fk_categoria_unidade_contexto` (`unidade_contexto`) USING BTREE;

--
-- Indexes for table `categorias_museus`
--
ALTER TABLE `categorias_museus`
  ADD KEY `museu` (`museu`),
  ADD KEY `tema` (`tema`),
  ADD KEY `unidade_analise` (`unidade_analise`),
  ADD KEY `unidade_contexto` (`unidade_contexto`),
  ADD KEY `fk_categorias_museus_categorias` (`categoria`),
  ADD KEY `fk_categorias_museus_subcategorias` (`sub_categoria`);

--
-- Indexes for table `cidades`
--
ALTER TABLE `cidades`
  ADD PRIMARY KEY (`cod_cidade`);

--
-- Indexes for table `imagens_museus`
--
ALTER TABLE `imagens_museus`
  ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `museus`
--
ALTER TABLE `museus`
  ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `situacoes`
--
ALTER TABLE `situacoes`
  ADD PRIMARY KEY (`cod_situacao`);

--
-- Indexes for table `sub_categorias`
--
ALTER TABLE `sub_categorias`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `fk_sub_categorias_categorias` (`categoria`);

--
-- Indexes for table `temas`
--
ALTER TABLE `temas`
  ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `tipos_categorias`
--
ALTER TABLE `tipos_categorias`
  ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `unidades_analises`
--
ALTER TABLE `unidades_analises`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `fk_unidade_analise_tema` (`tema`) USING BTREE;

--
-- Indexes for table `unidades_contextos`
--
ALTER TABLE `unidades_contextos`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `fk_uc_ua` (`unidade_analise`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=527;
--
-- AUTO_INCREMENT for table `cidades`
--
ALTER TABLE `cidades`
  MODIFY `cod_cidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11389;
--
-- AUTO_INCREMENT for table `imagens_museus`
--
ALTER TABLE `imagens_museus`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `museus`
--
ALTER TABLE `museus`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sub_categorias`
--
ALTER TABLE `sub_categorias`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;
--
-- AUTO_INCREMENT for table `temas`
--
ALTER TABLE `temas`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tipos_categorias`
--
ALTER TABLE `tipos_categorias`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `unidades_analises`
--
ALTER TABLE `unidades_analises`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `unidades_contextos`
--
ALTER TABLE `unidades_contextos`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `categorias`
--
ALTER TABLE `categorias`
  ADD CONSTRAINT `fk_categoria_tipo_categoria` FOREIGN KEY (`tipo_categoria`) REFERENCES `tipos_categorias` (`codigo`),
  ADD CONSTRAINT `fk_categoria_uc` FOREIGN KEY (`unidade_contexto`) REFERENCES `unidades_contextos` (`codigo`);

--
-- Limitadores para a tabela `categorias_museus`
--
ALTER TABLE `categorias_museus`
  ADD CONSTRAINT `categorias_museus_ibfk_1` FOREIGN KEY (`museu`) REFERENCES `museus` (`codigo`),
  ADD CONSTRAINT `categorias_museus_ibfk_2` FOREIGN KEY (`tema`) REFERENCES `temas` (`codigo`),
  ADD CONSTRAINT `categorias_museus_ibfk_3` FOREIGN KEY (`unidade_analise`) REFERENCES `unidades_analises` (`codigo`),
  ADD CONSTRAINT `categorias_museus_ibfk_4` FOREIGN KEY (`unidade_contexto`) REFERENCES `unidades_contextos` (`codigo`),
  ADD CONSTRAINT `fk_categorias_museus_categorias` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`codigo`),
  ADD CONSTRAINT `fk_categorias_museus_subcategorias` FOREIGN KEY (`sub_categoria`) REFERENCES `sub_categorias` (`codigo`);

--
-- Limitadores para a tabela `sub_categorias`
--
ALTER TABLE `sub_categorias`
  ADD CONSTRAINT `fk_sub_categorias_categorias` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`codigo`);

--
-- Limitadores para a tabela `unidades_analises`
--
ALTER TABLE `unidades_analises`
  ADD CONSTRAINT `fk_ua_tema` FOREIGN KEY (`tema`) REFERENCES `temas` (`codigo`);

--
-- Limitadores para a tabela `unidades_contextos`
--
ALTER TABLE `unidades_contextos`
  ADD CONSTRAINT `fk_uc_ua` FOREIGN KEY (`unidade_analise`) REFERENCES `unidades_analises` (`codigo`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
