-- MySQL dump 10.13  Distrib 8.0.25, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: lessons
-- ------------------------------------------------------
-- Server version	8.0.25

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `message` (
  `id` int NOT NULL AUTO_INCREMENT,
  `report` varchar(1000) DEFAULT NULL,
  `header` varchar(255) NOT NULL,
  `date_time` datetime NOT NULL,
  `sender_id` int NOT NULL,
  `addressee_id` int NOT NULL,
  `section_id` int NOT NULL,
  `is_reading` tinyint NOT NULL,
  PRIMARY KEY (`id`),
  KEY `message_users_fk_idx` (`sender_id`,`addressee_id`),
  KEY `s_idx` (`addressee_id`),
  KEY `messege_sections_fk_idx` (`section_id`),
  CONSTRAINT `addressee_user_fk` FOREIGN KEY (`addressee_id`) REFERENCES `users` (`id`),
  CONSTRAINT `messege_sections_fk` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`),
  CONSTRAINT `sender_users_fk` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
INSERT INTO `message` VALUES (65,'123123123123','Messege 1','2021-06-18 11:55:32',3,1,1,1),(66,'123123123123','Messege 2','2021-06-18 11:55:45',3,1,1,1),(67,'123123123123','Messege 3','2021-06-18 11:56:29',3,1,1,1),(68,'123123123123','Messege 4','2021-06-18 11:57:20',3,1,1,0),(69,'123123123123','Messege 5','2021-06-18 11:57:30',3,1,1,0),(70,'Text1','Messege 6','2021-06-18 11:57:53',3,2,1,0),(71,'Text22','Messege 33','2021-06-18 13:47:50',1,3,1,0);
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-06-18 14:23:20
