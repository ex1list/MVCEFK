-- MySQL dump 10.13  Distrib 8.0.22, for Linux (x86_64)
--
-- Host: localhost    Database: cms
-- ------------------------------------------------------
-- Server version	8.0.22-0ubuntu0.20.04.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Subcategories`
--


DROP TABLE IF EXISTS `notes`;
CREATE TABLE `notes` (   
id int NOT NULL AUTO_INCREMENT,   
SDATE date DEFAULT  NULL, 
BDate date DEFAULT  NULL,  
user_id varchar(255) NOT NULL,   
content mediumtext NOT NULL, 
Checked int DEFAULT NULL,  PRIMARY KEY (id) 
) 
ENGINE=InnoDB AUTO_INCREMENT=5  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `notes` VALUES (26,'2018-07-04','2018-07-14',1,'Proshy vidat otpusk',1),(28,'2018-05-04','2018-05-24',2,'Proshy vidat otpusk eshe raz',1),(30,'2018-09-14','2018-09-24',1,'Proshy vidat otpusk',1);
 
 



DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `login` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timestamp` date NOT NULL,
  `email` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salt` int(11) NOT NULL,
  `role` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (26,'Mery','$2y$10$YyvPebNkLg90fkx1w/NIdOF62nJ.LgOU5VhcL4LPDd/hvXmOg0NKG','2017-08-01','email@rrt',426915,'auth_user'),(28,'user2','$2y$10$T4vHM9v.9MbOgFA9xKOMHeOwSA1vytKA52AqspBAoAUFpH6x8FXWW','2017-08-02','email@mail',962448,'auth_user'),(30,'admin','$2y$10$pZFOjksKoy9zS0T.6w3Ll.07kvWgaV6qSXr/n5V0cu5HHR6TkXy9i','2018-07-04','admin@admin.admin',716953,'admin');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


DROP TABLE IF EXISTS `users_articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_articles` (
  `users_id` int NOT NULL AUTO_INCREMENT,
  `article_id` int NOT NULL,
  PRIMARY KEY (`users_id`,`article_id`),
  KEY `authors_id` (`users_id`),
  KEY `articles_id` (`article_id`),
  CONSTRAINT `FK_Articles` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_Author` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Таблица связи заявок участников и номинаций конкурса';
LOCK TABLES `users_articles` WRITE;
INSERT INTO `users_articles` VALUES (1,1),(1,2),(1,3),(2,1),(2,3),(3,1);
UNLOCK TABLES;

