-- phpMyAdmin SQL Dump
-- version 3.5.0
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 
-- Versão do Servidor: 5.5.16
-- Versão do PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `autor`
--

CREATE TABLE IF NOT EXISTS `autor` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `f_name` varchar(30) NOT NULL,
  `l_name` varchar(20) NOT NULL,
  `observacoes` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Extraindo dados da tabela `autor`
--

INSERT INTO `autor` (`id`, `f_name`, `l_name`, `observacoes`) VALUES
(1, 'Mario', 'Quintana', NULL),
(2, 'Max', 'Kanat-Alexander', 'Max Kanat-Alexander, Chief Architect of the open-source Bugzilla Project, Google Software Engineer, and writer, has been fixing computers since he was eight years old and writing software since he was fourteen.'),
(3, 'Larry', 'Ullmann', NULL),
(4, 'Brett', 'McLaughlin', NULL),
(5, 'Pablo', 'Dall''Oglio', NULL),
(6, 'Dan', 'Brown', NULL),
(7, 'Paulo', 'Coelho', ''),
(8, 'William', 'Shekespeare', NULL),
(9, 'Dustin', 'Boswell', NULL),
(10, 'Trevor', 'Foucher', NULL),
(11, 'Remy', 'Sharp', NULL),
(12, 'Bruce', 'Lawson', NULL),
(13, 'Talal', 'Husseini', ''),
(14, 'Machado de', 'Assis', 'Joaquim Maria Machado de Assis (Rio de Janeiro, 21 de junho de 1839 — Rio de Janeiro, 29 de setembro de 1908) foi um escritor brasileiro, amplamente considerado como o maior nome da literatura nacional.'),
(15, 'Nitesh', 'Dhanjani', ''),
(16, 'Billy', 'Rios', ''),
(17, 'Brett', 'Hardin', ''),
(18, 'Amit', 'Goswami', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `contato`
--

CREATE TABLE IF NOT EXISTS `contato` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `telefone` varchar(10) DEFAULT NULL,
  `mensagem` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `contato`
--

INSERT INTO `contato` (`id`, `nome`, `email`, `telefone`, `mensagem`) VALUES
(1, 'Leandro', 'lassisg@gmail.com', '99339104', 'Gostaria de informações sobre como pegar um livro emprestado. Como devo proceder?');

-- --------------------------------------------------------

--
-- Estrutura da tabela `editora`
--

CREATE TABLE IF NOT EXISTS `editora` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Extraindo dados da tabela `editora`
--

INSERT INTO `editora` (`id`, `nome`) VALUES
(1, 'Ciência Moderna'),
(2, 'Novatec'),
(3, 'O''Reilly Media'),
(4, 'Sextante'),
(5, 'Abril'),
(6, 'Panini'),
(7, 'Lua de Papel'),
(8, 'Objetiva'),
(9, 'Fronteira'),
(10, 'Alta Books'),
(11, 'Livraria Garnier'),
(12, 'Th Editora'),
(13, 'Aleph');

-- --------------------------------------------------------

--
-- Estrutura da tabela `livro`
--

CREATE TABLE IF NOT EXISTS `livro` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) CHARACTER SET latin1 NOT NULL,
  `resenha` text CHARACTER SET latin1,
  `edicao` int(2) unsigned DEFAULT NULL,
  `data_publicacao` date NOT NULL,
  `isbn` varchar(13) CHARACTER SET latin1 DEFAULT NULL,
  `n_exemplares` int(2) unsigned NOT NULL DEFAULT '1',
  `localizacao` varchar(6) CHARACTER SET latin1 NOT NULL,
  `id_editora` int(4) NOT NULL,
  `imgext` varchar(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_livro_editora1` (`id_editora`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Extraindo dados da tabela `livro`
--

INSERT INTO `livro` (`id`, `nome`, `resenha`, `edicao`, `data_publicacao`, `isbn`, `n_exemplares`, `localizacao`, `id_editora`, `imgext`) VALUES
(1, 'A Física da Alma', 'De forma excitante e inovadora, Amit Goswami emprega os fundamentos da física quântica para explicar e provar cientificamente conceitos místicos como imortalidade, reencarnação e pós-vida.', 2, '2008-00-00', '9788576570462', 1, 'E01P02', 13, ''),
(2, 'Esaú e Jacó', 'O livro conta a história de Pedro e Paulo, irmãos gêmeos. Ambos se apaixonam pela bela Flora. Esaú e Jacó, é um livro recomendado pelos vestibulandos.', 1, '2002-00-00', '9788572324939', 1, 'E02P01', 11, ''),
(3, 'Dom Casmurro', 'O narrador-personagem tenta restaurar, na velhice, a adolescï¿½ncia e, desta forma, viver o jï¿½ havia vivido, e assim, conta a histï¿½ria...', 1, '2002-00-00', '9788572322645', 1, 'E02P01', 11, ''),
(4, 'Hacking: The Next Generation', 'With the advent of rich Internet applications, the explosion of social media, and the increased use of powerful cloud computing infrastructures, a new generation of attackers has added cunning new techniques to its arsenal.', 1, '2009-08-00', '9780596807016', 1, 'E01P01', 3, ''),
(5, 'PHP 6 E MYSQL 5', 'Fï¿½cil abordagem visual, utiliza imagens para guiï¿½-lo pelo PHP 6 e MySQL 5 e mostrar o que fazer. Etapas e explicaï¿½ï¿½es precisas permitem colocar as atividades em prï¿½tica imediatamente.', 1, '2008-00-00', '9788573937510', 1, 'E01P01', 1, ''),
(6, 'PHP & MySQL: The Missing Manual', 'If you can build websites with CSS and JavaScript, this book takes you to the next level-creating dynamic, database-driven websites with PHP and MySQL.', 1, '2011-11-00', '9780596515867', 1, 'E01P01', 3, ''),
(7, 'PHP: Programando com Orientação a Objetos', 'O foco deste livro é demonstrar como se dá a construção de uma aplicação totalmente orientada a objetos.', 2, '2009-00-00', '9788575222003', 1, 'E01P01', 2, ''),
(8, 'Criando Relatórios com PHP', 'Uma das grandes demandas de quem desenvolve em PHP sempre foi a geração de relatórios. Este livro ensina diversas técnicas para gerá-los em PHP, nos mais diversos formatos, como HTML, PDF e RTF.', 1, '2011-12-00', '9788575222638', 1, 'E01P01', 2, ''),
(9, 'Código Da Vinci', 'Que mistério se esconde por trás do sorriso de Mona Lisa? Durante séculos, a igreja conseguiu manter a verdade oculta... até agora.', 1, '2004-00-00', '9788575421130', 1, 'E01P01', 4, ''),
(10, 'Paz Guerreira', 'Nesta obra epica, atemporal, dois mundos se encontram, num cruzamento bem elaborado de histï¿½rias e personagens de diferentes ï¿½pocas, mas cujas vidas se entrelaï¿½am da maneira mais profunda do que se pode supor.', 4, '2011-12-00', '9788587389619', 2, 'E02P01', 12, ''),
(11, 'Romeu e Julieta', 'A obra dramï¿½tica de Shakespeare funde uma visï¿½o poï¿½tica e refinada a um forte carï¿½ter popular, no qual os assassinos, as violaï¿½ï¿½es, os incestos e as traiï¿½ï¿½es sï¿½o ingredientes.', 1, '2002-00-00', '9788572325271', 1, 'E01P01', 5, ''),
(12, 'The Art of Readable Code', 'Simple and Practical Techniques for Writing Better Code', 1, '2011-11-00', '9781449314170', 1, 'E02P02', 3, ''),
(13, 'Code Simplicity', 'Good software design is simple and easy to understand. This concise guide helps you understand the fundamentals of good design through scientific laws & principles you can apply to any programming language or project from here to eternity.', 1, '2012-00-00', '9781449313883', 1, 'E01P02', 3, ''),
(14, 'O Aprendiz de Feiticeiro', 'Nesta obra, dedicada ao tambï¿½m gaï¿½cho e poeta Augusto Meyer, Quintana dï¿½ novo tratamento a temas abordados anteriormente, com um olhar incorporado a partir da prosa e seu respectivo traï¿½o coloquial.', 1, '2005-00-00', '9788525034960', 1, 'E01P02', 9, ''),
(15, 'O Monte Cinco', 'No dia 12 do mï¿½s de agosto de 1979, eu fui dormir com uma ï¿½nica certeza: aos 30 anos de idade, eu estava conseguindo chegar ao topo de minha carreira como executivo.', 1, '2006-00-00', '9788576651932', 1, 'E01P02', 8, ''),
(16, 'Introdução Ao Html 5', 'Escrito por desenvolvedores que têm utilizado esta nova linguagem em seu trabalho. O Introdução ao HTML 5 mostra a você como começar a adotar a linguagem agora para perceber seus benefícios em navegadores atuais.', 1, '2011-12-00', '9788576085935', 2, 'E01P01', 10, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `livro_autor`
--

CREATE TABLE IF NOT EXISTS `livro_autor` (
  `id_livro` int(8) NOT NULL,
  `id_autor` int(4) NOT NULL,
  PRIMARY KEY (`id_livro`,`id_autor`),
  KEY `fk_autor_livro` (`id_autor`),
  KEY `fk_livro_autor` (`id_livro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `livro_autor`
--

INSERT INTO `livro_autor` (`id_livro`, `id_autor`) VALUES
(14, 1),
(13, 2),
(5, 3),
(6, 4),
(7, 5),
(8, 5),
(9, 6),
(15, 7),
(11, 8),
(12, 9),
(12, 10),
(16, 11),
(16, 12),
(10, 13),
(2, 14),
(3, 14),
(4, 15),
(4, 16),
(4, 17),
(1, 18);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `nome` varchar(30) NOT NULL,
  `login` varchar(30) NOT NULL,
  `senha` varchar(40) NOT NULL,
  UNIQUE KEY `login` (`login`),
  UNIQUE KEY `login_2` (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`nome`, `login`, `senha`) VALUES
('Alessandro','alessandro','8ccb5427407acc438a6e02b9c659ae5155d12eae'),
('Leandro', 'leandro', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `livro`
--
ALTER TABLE `livro`
  ADD CONSTRAINT `fk_livro_editora1` FOREIGN KEY (`id_editora`) REFERENCES `editora` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `livro_autor`
--
ALTER TABLE `livro_autor`
  ADD CONSTRAINT `fk_autor_livro` FOREIGN KEY (`id_autor`) REFERENCES `autor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_livro_autor` FOREIGN KEY (`id_livro`) REFERENCES `livro` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
