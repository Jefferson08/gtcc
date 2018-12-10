CREATE DATABASE  IF NOT EXISTS `projeto` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `projeto`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: projeto
-- ------------------------------------------------------
-- Server version	5.7.14

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `alunos`
--

DROP TABLE IF EXISTS `alunos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alunos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `RA` int(11) NOT NULL,
  `senha` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alunos`
--

LOCK TABLES `alunos` WRITE;
/*!40000 ALTER TABLE `alunos` DISABLE KEYS */;
INSERT INTO `alunos` VALUES (1,'Jefferson Carvalho','jefferson@teste.com',28250001,'698dc19d489c4e4db73e28a713eab07b'),(2,'Matheus Pereira','matheus@teste.com',28250002,'698dc19d489c4e4db73e28a713eab07b'),(3,'Gabriel Pereira','gabriel@teste.com',28250003,'698dc19d489c4e4db73e28a713eab07b'),(4,'Vinicius Costa','vinicius@teste.com',28250004,'698dc19d489c4e4db73e28a713eab07b'),(5,'Vinycius Batista','vinycius@teste.com',28250005,'698dc19d489c4e4db73e28a713eab07b'),(6,'Matheus Tiberio','tiberio@teste.com',28250006,'698dc19d489c4e4db73e28a713eab07b'),(7,'Aluno 7','aluno7@teste.com',28250007,'698dc19d489c4e4db73e28a713eab07b'),(8,'Aluno 8','aluno8@teste.com',28250008,'698dc19d489c4e4db73e28a713eab07b'),(9,'Aluno 9','aluno9@teste.com',28250009,'698dc19d489c4e4db73e28a713eab07b'),(10,'Aluno 10','aluno10@teste.com',28250010,'698dc19d489c4e4db73e28a713eab07b');
/*!40000 ALTER TABLE `alunos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `banca`
--

DROP TABLE IF EXISTS `banca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banca` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banca`
--

LOCK TABLES `banca` WRITE;
/*!40000 ALTER TABLE `banca` DISABLE KEYS */;
INSERT INTO `banca` VALUES (1,'Avaliador 1','avaliador1@teste.com','698dc19d489c4e4db73e28a713eab07b'),(2,'Avaliador 2 ','avaliador2@teste.com','698dc19d489c4e4db73e28a713eab07b'),(3,'Avaliador 3','avaliador3@teste.com','698dc19d489c4e4db73e28a713eab07b');
/*!40000 ALTER TABLE `banca` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comentarios`
--

DROP TABLE IF EXISTS `comentarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_trabalho` int(11) NOT NULL,
  `id_orientador` int(11) NOT NULL,
  `id_etapa` int(11) NOT NULL,
  `comentario` text NOT NULL,
  `data_envio` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comentarios`
--

LOCK TABLES `comentarios` WRITE;
/*!40000 ALTER TABLE `comentarios` DISABLE KEYS */;
INSERT INTO `comentarios` VALUES (1,2,2,1,'Precisa arrumar alguns detalhes na parte que fala do objetivos','2018-12-10 16:15:38');
/*!40000 ALTER TABLE `comentarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coordenadores`
--

DROP TABLE IF EXISTS `coordenadores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coordenadores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coordenadores`
--

LOCK TABLES `coordenadores` WRITE;
/*!40000 ALTER TABLE `coordenadores` DISABLE KEYS */;
INSERT INTO `coordenadores` VALUES (1,'Coordenador1','coordenador@teste.com','698dc19d489c4e4db73e28a713eab07b');
/*!40000 ALTER TABLE `coordenadores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cronograma`
--

DROP TABLE IF EXISTS `cronograma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cronograma` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `evento` varchar(100) NOT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cronograma`
--

LOCK TABLES `cronograma` WRITE;
/*!40000 ALTER TABLE `cronograma` DISABLE KEYS */;
INSERT INTO `cronograma` VALUES (1,'IntroduÃ§Ã£o','2018-12-10'),(2,'Metodologia','2018-12-21'),(3,'Resumo','2019-01-24'),(4,'Artigo Final','2019-01-31');
/*!40000 ALTER TABLE `cronograma` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `diretrizes`
--

DROP TABLE IF EXISTS `diretrizes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `diretrizes` (
  `qtdMax` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `diretrizes`
--

LOCK TABLES `diretrizes` WRITE;
/*!40000 ALTER TABLE `diretrizes` DISABLE KEYS */;
INSERT INTO `diretrizes` VALUES (3);
/*!40000 ALTER TABLE `diretrizes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `etapas`
--

DROP TABLE IF EXISTS `etapas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `etapas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_trabalho` int(11) NOT NULL,
  `id_evento` int(11) NOT NULL,
  `data_envio` datetime NOT NULL,
  `ultima_atualizacao` datetime NOT NULL,
  `url` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `etapas`
--

LOCK TABLES `etapas` WRITE;
/*!40000 ALTER TABLE `etapas` DISABLE KEYS */;
INSERT INTO `etapas` VALUES (1,2,1,'2018-12-10 16:12:55','2018-12-10 16:12:55','db7859cf08c2d537d309cdc7bbcd055b.pdf'),(2,2,4,'2018-12-10 16:35:52','2018-12-10 16:35:52','d637b85e33951396d9e006427dc48e61.pdf');
/*!40000 ALTER TABLE `etapas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupos`
--

DROP TABLE IF EXISTS `grupos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grupos` (
  `id_trabalho` int(11) NOT NULL,
  `id_aluno` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupos`
--

LOCK TABLES `grupos` WRITE;
/*!40000 ALTER TABLE `grupos` DISABLE KEYS */;
INSERT INTO `grupos` VALUES (1,1),(1,2),(1,3),(2,4),(2,5),(2,6);
/*!40000 ALTER TABLE `grupos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materiais`
--

DROP TABLE IF EXISTS `materiais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `materiais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_trabalho` int(11) NOT NULL,
  `id_orientador` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descricao` text NOT NULL,
  `link` varchar(100) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `data_envio` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materiais`
--

LOCK TABLES `materiais` WRITE;
/*!40000 ALTER TABLE `materiais` DISABLE KEYS */;
INSERT INTO `materiais` VALUES (1,2,2,'Artigo sobre o uso de computadores nas escolas','Leiam esse artigo, vai ajudar na pesquisa e desenvolvimento','http://www.google.com.br/',NULL,'2018-12-10 16:19:29');
/*!40000 ALTER TABLE `materiais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notas_banca`
--

DROP TABLE IF EXISTS `notas_banca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notas_banca` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_trabalho` int(11) NOT NULL,
  `id_avaliador` int(11) NOT NULL,
  `nota` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notas_banca`
--

LOCK TABLES `notas_banca` WRITE;
/*!40000 ALTER TABLE `notas_banca` DISABLE KEYS */;
INSERT INTO `notas_banca` VALUES (1,2,1,2);
/*!40000 ALTER TABLE `notas_banca` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notas_coordenador`
--

DROP TABLE IF EXISTS `notas_coordenador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notas_coordenador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_trabalho` int(11) NOT NULL,
  `nota` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notas_coordenador`
--

LOCK TABLES `notas_coordenador` WRITE;
/*!40000 ALTER TABLE `notas_coordenador` DISABLE KEYS */;
/*!40000 ALTER TABLE `notas_coordenador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notas_orientador`
--

DROP TABLE IF EXISTS `notas_orientador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notas_orientador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_trabalho` int(11) NOT NULL,
  `nota` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notas_orientador`
--

LOCK TABLES `notas_orientador` WRITE;
/*!40000 ALTER TABLE `notas_orientador` DISABLE KEYS */;
/*!40000 ALTER TABLE `notas_orientador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notificacoes`
--

DROP TABLE IF EXISTS `notificacoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notificacoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_trabalho` int(11) DEFAULT NULL,
  `id_orientador` int(11) DEFAULT NULL,
  `texto` text NOT NULL,
  `link` varchar(100) NOT NULL,
  `lido` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notificacoes`
--

LOCK TABLES `notificacoes` WRITE;
/*!40000 ALTER TABLE `notificacoes` DISABLE KEYS */;
INSERT INTO `notificacoes` VALUES (1,NULL,2,'ProgramaÃ§Ã£o no auxÃ­lio ao ensino infantil - Etapa: IntroduÃ§Ã£o enviada!','http://projeto.pc/orientador/trabalhos/etapas/2',1),(2,2,NULL,'Thiago Alexandre adicionou um novo comentÃ¡rio em: IntroduÃ§Ã£o','http://projeto.pc/aluno/etapas',1),(3,2,NULL,'Novo material: Artigo sobre o uso de computadores nas escolas','http://projeto.pc/aluno/materiais',1),(4,2,NULL,'Nova orientaÃ§Ã£o cadastrada por: Thiago Alexandre','http://projeto.pc/aluno/materiais',1),(5,NULL,2,'ProgramaÃ§Ã£o no auxÃ­lio ao ensino infantil - Etapa: Artigo Final enviada!','http://projeto.pc/orientador/trabalhos/etapas/2',1),(6,2,NULL,'Avaliado por Thiago Alexandre','http://projeto.pc/aluno/notas',1),(7,2,NULL,'Avaliado por Avaliador 1','http://projeto.pc/aluno/notas',0),(8,2,NULL,'Avaliado por Thiago Alexandre','http://projeto.pc/aluno/notas',0),(9,2,NULL,'Avaliado por Avaliador 1','http://projeto.pc/aluno/notas',0),(10,2,NULL,'Avaliado por Avaliador 1','http://projeto.pc/aluno/notas',0);
/*!40000 ALTER TABLE `notificacoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orientacoes`
--

DROP TABLE IF EXISTS `orientacoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orientacoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_trabalho` int(11) NOT NULL,
  `id_orientador` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descricao` text NOT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orientacoes`
--

LOCK TABLES `orientacoes` WRITE;
/*!40000 ALTER TABLE `orientacoes` DISABLE KEYS */;
INSERT INTO `orientacoes` VALUES (1,2,2,'Desenvolvimeto','AlteraÃ§Ãµes no desenvolvimento e correÃ§Ãµes nas normas ABNT','2018-12-10');
/*!40000 ALTER TABLE `orientacoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orientadores`
--

DROP TABLE IF EXISTS `orientadores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orientadores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orientadores`
--

LOCK TABLES `orientadores` WRITE;
/*!40000 ALTER TABLE `orientadores` DISABLE KEYS */;
INSERT INTO `orientadores` VALUES (1,'Erwin Uhlmann','erwin@teste.com','698dc19d489c4e4db73e28a713eab07b'),(2,'Thiago Alexandre','thiago@teste.com','698dc19d489c4e4db73e28a713eab07b');
/*!40000 ALTER TABLE `orientadores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temas`
--

DROP TABLE IF EXISTS `temas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tema` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temas`
--

LOCK TABLES `temas` WRITE;
/*!40000 ALTER TABLE `temas` DISABLE KEYS */;
INSERT INTO `temas` VALUES (1,'InteligÃªncia artificial'),(2,'AutomaÃ§Ã£o industrial'),(3,'Pedagogia');
/*!40000 ALTER TABLE `temas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trabalhos`
--

DROP TABLE IF EXISTS `trabalhos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trabalhos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_tema` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `id_orientador` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trabalhos`
--

LOCK TABLES `trabalhos` WRITE;
/*!40000 ALTER TABLE `trabalhos` DISABLE KEYS */;
INSERT INTO `trabalhos` VALUES (1,1,'Algoritmo autÃ´nomo inteligente',1),(2,3,'ProgramaÃ§Ã£o no auxÃ­lio ao ensino infantil',2);
/*!40000 ALTER TABLE `trabalhos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-12-10 18:06:55
