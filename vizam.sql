-- MySQL dump 10.13  Distrib 5.6.23, for Win32 (x86)
--
-- Host: localhost    Database: vizam
-- ------------------------------------------------------
-- Server version	5.6.24-log

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
-- Table structure for table `carroussel`
--

DROP TABLE IF EXISTS `carroussel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carroussel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `data` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `cat_id` (`cat_id`),
  CONSTRAINT `carroussel_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `cat` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carroussel`
--

LOCK TABLES `carroussel` WRITE;
/*!40000 ALTER TABLE `carroussel` DISABLE KEYS */;
INSERT INTO `carroussel` VALUES (30,11,'2015/07/11-ec44c12e4db113bc7c82d0cf1d12e429.jpg','2015-07-09 02:42:32'),(31,11,'2015/07/11-a6484ea70c1eb0860e1a3959c1d353fa.jpg','2015-07-09 02:42:32'),(33,11,'2015/07/11-25d17b5be7751d53d498cd07d569712e.jpg','2015-07-09 02:42:33'),(34,11,'2015/07/11-ed6b5fb3d205a7988dad9d9c60e70937.jpg','2015-07-09 02:42:34'),(62,22,'2015/07/22-e85518fa37d7b239d662bb3f809ea8ac.jpg','2015-07-17 21:15:22'),(63,22,'2015/07/22-4cd656901c40c99529f3215be3ea8621.jpg','2015-07-17 21:15:22'),(64,22,'2015/07/22-80dc67a24a2812579158dd57e878fbb6.jpg','2015-07-17 21:15:23'),(92,10,'2015/07/10-5eb23aab895c9f66e764170c8d77db4d.jpg','2015-07-17 22:36:46'),(93,10,'2015/07/10-6cadcd73be9ffa3da300903e55a2d1e0.jpg','2015-07-17 22:36:46'),(94,10,'2015/07/10-4e40678b84684d3c959303aabec9ccd1.jpg','2015-07-17 22:36:47'),(95,12,'2015/07/12-8f60dafac3299e71a027d1daf73710a6.jpg','2015-07-17 22:37:30'),(96,12,'2015/07/12-cff9aa3da7354f828fc06537c35773fc.jpg','2015-07-17 22:37:30'),(97,12,'2015/07/12-006bd60d3eec58fcf375d3cfa94b9e53.jpg','2015-07-17 22:37:31'),(101,24,'2015/07/24-c1a35c364aa8eb6d450e9ad2930f060f.jpg','2015-07-18 17:00:59'),(102,24,'2015/07/24-3a607f0d2269c4664bdc102df3118b15.jpg','2015-07-18 17:00:59'),(103,24,'2015/07/24-723343af18a7b5441f125291d3042106.jpg','2015-07-18 17:01:00'),(104,25,'2015/07/25-1cf8a6d0708946c244dbd573cf5bae1d.jpg','2015-07-18 17:01:36'),(105,25,'2015/07/25-b2c1a9f4022703a3b75571aab89079c3.jpg','2015-07-18 17:01:37'),(106,25,'2015/07/25-f06f5573e72725f3acb93d7c817951ef.jpg','2015-07-18 17:01:38'),(107,26,'2015/07/26-82e2fc758a3bc7cba2fd30fcaa1454ed.jpg','2015-07-18 17:02:40'),(108,26,'2015/07/26-99b4087b74610b8cd4965f6ad88abfb4.jpg','2015-07-18 17:02:40'),(109,26,'2015/07/26-6e1a2f31fceed34cf0adc85a552291e1.jpg','2015-07-18 17:02:41'),(110,27,'2015/07/27-289bbdaf9e96d31baabc5f1e17f3edde.jpg','2015-07-18 17:03:47'),(111,27,'2015/07/27-720957f84b1b9236a0caad9087a0f778.jpg','2015-07-18 17:03:48'),(112,27,'2015/07/27-22003df304fc88c8aaf3e28403ecaefa.jpg','2015-07-18 17:03:49'),(113,28,'2015/07/28-24deec7177001ec9541fae377e5c41e8.jpg','2015-07-18 17:05:06'),(114,28,'2015/07/28-ad0cb8e91b15505cec1024e5cf9e7bc0.jpg','2015-07-18 17:05:07'),(115,28,'2015/07/28-294fdd8b08b19f44ecfde0b95d28ea5f.jpg','2015-07-18 17:05:08');
/*!40000 ALTER TABLE `carroussel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cat`
--

DROP TABLE IF EXISTS `cat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pai` int(11) DEFAULT NULL,
  `nome` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tipo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_pai` (`id_pai`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cat`
--

LOCK TABLES `cat` WRITE;
/*!40000 ALTER TABLE `cat` DISABLE KEYS */;
INSERT INTO `cat` VALUES (8,NULL,'Produtos','produtos','2015-07-14 01:31:26','dropmenu'),(10,8,'Foto Livros','produtos-foto-livros','2015-07-02 05:39:51','0'),(11,8,'Decorações','produtos-decoracoes','2015-07-02 05:40:50','0'),(12,8,'Foto Presentes','produtos-foto-presentes','2015-07-02 05:41:18','0'),(22,NULL,'home','home','2015-07-17 21:12:49','menu'),(24,8,'Impressões Digitais','produtos-impressoes-digitais','2015-07-18 16:28:20','0'),(25,8,'Lembranças e Convite','produtos-lembrancas-e-convite','2015-07-18 16:28:36','0'),(26,8,'Painéis de Madeira','produtos-paineis-de-madeira','2015-07-18 16:29:11','0'),(27,8,'Tudo para sua Festa','produtos-tudo-para-sua-festa','2015-07-18 16:29:28','0'),(28,8,'Volta ás Aulas','produtos-volta-as-aulas','2015-07-18 16:29:44','0');
/*!40000 ALTER TABLE `cat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `colors`
--

DROP TABLE IF EXISTS `colors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `colors` (
  `color_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `color_name` varchar(40) NOT NULL,
  `color_hexadecimal` varchar(7) DEFAULT NULL,
  `color_rgb` varchar(11) DEFAULT NULL,
  `color_name_url` varchar(40) NOT NULL,
  PRIMARY KEY (`color_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `colors`
--

LOCK TABLES `colors` WRITE;
/*!40000 ALTER TABLE `colors` DISABLE KEYS */;
INSERT INTO `colors` VALUES (1,'Amarelo','#FFFF00','255,255,0','yellow'),(2,'Azul','#0000FF','0,0,255','blue'),(3,'Branco','#FFFFFF','255,255,255','white'),(4,'Cian','#00FFFF','0,255,255','cyan'),(5,'Laranja','#FF8C00','255,140,0','orange'),(6,'Preto','#000000','0,0,0','black'),(7,'Rosa','#FF1493','255,20,147','pink'),(8,'Rosa Claro','#FF69B4','255,105,180','light-pink'),(9,'Roxo','#8B008B','139,0,139','purple'),(10,'Verde','#00FF00','0,255,0','green'),(11,'Verde Menta','#008B45','0,139,69','peppermint-green'),(12,'Violeta','#9400D3','148,0,211','violet');
/*!40000 ALTER TABLE `colors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `measures`
--

DROP TABLE IF EXISTS `measures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `measures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `measure` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `medidas` (`post_id`),
  CONSTRAINT `medidas` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `measures`
--

LOCK TABLES `measures` WRITE;
/*!40000 ALTER TABLE `measures` DISABLE KEYS */;
INSERT INTO `measures` VALUES (1,34,'Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fa'),(2,37,'Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou'),(4,42,'Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou'),(5,43,'Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de ');
/*!40000 ALTER TABLE `measures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pagers`
--

DROP TABLE IF EXISTS `pagers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pagers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `paginas` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pag` (`post_id`),
  CONSTRAINT `pag` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagers`
--

LOCK TABLES `pagers` WRITE;
/*!40000 ALTER TABLE `pagers` DISABLE KEYS */;
INSERT INTO `pagers` VALUES (1,34,'Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fa'),(2,39,'Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou'),(3,38,'Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou'),(5,42,'Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou'),(6,43,'Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de ');
/*!40000 ALTER TABLE `pagers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `papers`
--

DROP TABLE IF EXISTS `papers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `papers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `paper_type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `papel` (`post_id`),
  CONSTRAINT `papel` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `papers`
--

LOCK TABLES `papers` WRITE;
/*!40000 ALTER TABLE `papers` DISABLE KEYS */;
INSERT INTO `papers` VALUES (1,34,'Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fa'),(2,35,'Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fa'),(7,42,'Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou'),(8,43,'Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de ');
/*!40000 ALTER TABLE `papers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_colors`
--

DROP TABLE IF EXISTS `post_colors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post_colors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `color_post` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `colors` (`post_id`),
  CONSTRAINT `colors` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_colors`
--

LOCK TABLES `post_colors` WRITE;
/*!40000 ALTER TABLE `post_colors` DISABLE KEYS */;
INSERT INTO `post_colors` VALUES (30,34,'\'#FFFF00\', \'#0000FF\', \'#00FFFF\', \'#000000\''),(32,40,'\'#FFFF00\', \'#0000FF\', \'#00FFFF\', \'#000000\''),(33,42,'\'#0000FF\', \'#FFFFFF\', \'#00FFFF\', \'#FF8C00\', \'#000000\', \'#FF1493\', \'#FF69B4\', \'#8B008B\', \'#00FF00\', \'#008B45\', \'#9400D3\''),(34,43,'\'#00FFFF\', \'#000000\', \'#FF69B4\', \'#00FF00\', \'#9400D3\'');
/*!40000 ALTER TABLE `post_colors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `thumb` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'default.png',
  `titulo` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `preco` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'preço não cadastrado',
  `url` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `visitas` float DEFAULT NULL,
  `autor` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL DEFAULT '1',
  `cat_pai` int(11) DEFAULT NULL,
  `nivel` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `cat` (`cat_id`),
  KEY `catpai` (`cat_pai`),
  CONSTRAINT `cat` FOREIGN KEY (`cat_id`) REFERENCES `cat` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `catpai` FOREIGN KEY (`cat_pai`) REFERENCES `cat` (`id_pai`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (34,'2015/07/foto-presentes.jpg','Foto Presente','Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fa','R$ 9,99','foto-presente','post','2015-07-02 05:41:18',114,10,12,8,0,1),(35,'2015/07/foto-livro.jpg','Foto Livro','Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fa','R$ 9,99','foto-livro','post','2015-07-02 05:39:51',14,10,10,8,0,1),(37,'2015/07/impressoes-digitais.jpg','Impressões Digitais','Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou','R$ 9,99','impressoes-digitais','post','2015-07-18 16:28:20',3,10,24,8,0,1),(38,'2015/07/lembrancas-e-convite.jpg','Lembranças e Convite','Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou','R$ 9,99','lembrancas-e-convite','post','2015-07-18 16:28:36',1,10,25,8,0,1),(39,'2015/07/paineis-de-madeira.jpg','Painéis de madeira','Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou','R$ 9,99','paineis-de-madeira','post','2015-07-18 16:29:11',2,10,26,8,0,1),(40,'2015/07/tudo-para-sua-festa.jpg','Tudo Para sua festa','Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou','R$ 9,99','tudo-para-sua-festa','post','2015-07-18 16:29:28',NULL,10,27,8,0,1),(41,'2015/07/volta-as-aulas.jpg','Volta as aulas','Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou','R$ 9,99','volta-as-aulas','post','2015-07-18 16:29:44',2,10,28,8,0,1),(42,'2015/07/decoracoes.jpg','Decorações','Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou','R$ 9,99','decoracoes','post','2015-07-02 05:40:50',7,10,11,8,0,1),(43,'2015/07/decoracoes-2.jpg','Decorações 2','Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de ','R$ 9,99','decoracoes-2','post','2015-07-02 05:40:50',10,10,11,8,0,1);
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts_gb`
--

DROP TABLE IF EXISTS `posts_gb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts_gb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `post-image` (`post_id`),
  CONSTRAINT `post-image` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts_gb`
--

LOCK TABLES `posts_gb` WRITE;
/*!40000 ALTER TABLE `posts_gb` DISABLE KEYS */;
/*!40000 ALTER TABLE `posts_gb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `cpf` varchar(15) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `rua` varchar(100) NOT NULL,
  `cidade` varchar(30) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `telefone` varchar(18) NOT NULL,
  `celular` varchar(18) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `nivel` int(11) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '0',
  `cadData` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `premium_end` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (10,'Anderson silva','33995564895','teste@teste.com','25f9e794323b453885f5181f1b624d0b','Rua jp 1234','sao paulo','17800-000','11 9 99999999','11 46564646','86dbb9ef25dfca127a840fc696ef2ab9.jpg',1,1,'2015-06-14 15:44:18','2015-07-22 17:54:51'),(11,'Anderson','027.336.748-03','teste2@teste.com','25f9e794323b453885f5181f1b624d0b','rua japao, 567','São Paulo','07500-000','1146571349','Anderson',NULL,1,1,'2015-06-17 04:57:49','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `views`
--

DROP TABLE IF EXISTS `views`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `views` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mes` varchar(2) NOT NULL,
  `ano` varchar(4) NOT NULL,
  `visitas` int(20) NOT NULL DEFAULT '1',
  `visitantes` int(20) NOT NULL DEFAULT '1',
  `pageviews` int(20) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `views`
--

LOCK TABLES `views` WRITE;
/*!40000 ALTER TABLE `views` DISABLE KEYS */;
INSERT INTO `views` VALUES (5,'06','2015',26,12,491),(6,'07','2015',84,20,3557);
/*!40000 ALTER TABLE `views` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `views_online`
--

DROP TABLE IF EXISTS `views_online`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `views_online` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sessao` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `time_end` int(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=164 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `views_online`
--

LOCK TABLES `views_online` WRITE;
/*!40000 ALTER TABLE `views_online` DISABLE KEYS */;
INSERT INTO `views_online` VALUES (163,'tunlgk3jpl5du4vvp7iqtst9u3','::1','/VIZAM/index.php',1437775191);
/*!40000 ALTER TABLE `views_online` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-07-26 17:19:23
