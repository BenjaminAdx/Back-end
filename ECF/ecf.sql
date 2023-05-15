-- MySQL dump 10.13  Distrib 8.0.33, for Linux (x86_64)
--
-- Host: localhost    Database: ecf
-- ------------------------------------------------------
-- Server version	8.0.33-0ubuntu0.22.04.1

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
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clients` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `adresse1` varchar(255) NOT NULL,
  `adresse2` varchar(255) DEFAULT NULL,
  `code_postal` int NOT NULL,
  `ville` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telephone` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (2,'Andrieux','Benjamin','73 avenue de Toulon','',13006,'MARSEILLE 06','andrieux.benjamin1@gmail.com','0667882151'),(3,'auber','jonathan','54 rue bidon','',13000,'Marseille','john@john.fr','0404040404');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `facture`
--

DROP TABLE IF EXISTS `facture`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `facture` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `prix_ht` decimal(10,2) NOT NULL,
  `prix_ttc` decimal(10,2) NOT NULL,
  `id_clients` int NOT NULL,
  `id_personnel` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_clients_id_clients_facture` (`id_clients`),
  KEY `FK_personnel_id_personnel_facture` (`id_personnel`),
  CONSTRAINT `FK_clients_id_clients_facture` FOREIGN KEY (`id_clients`) REFERENCES `clients` (`id`),
  CONSTRAINT `FK_personnel_id_personnel_facture` FOREIGN KEY (`id_personnel`) REFERENCES `personnel` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facture`
--

LOCK TABLES `facture` WRITE;
/*!40000 ALTER TABLE `facture` DISABLE KEYS */;
INSERT INTO `facture` VALUES (1,'2023-05-10 12:45:42',0.00,0.00,2,1),(2,'2023-05-10 14:05:44',0.00,0.00,2,1),(3,'2023-05-10 14:07:41',0.00,0.00,2,1),(4,'2023-05-10 14:11:06',0.00,0.00,2,1),(5,'2023-05-10 14:11:21',0.00,0.00,2,1),(6,'2023-05-10 14:12:27',0.00,0.00,2,1),(7,'2023-05-10 14:16:25',0.00,0.00,2,1),(8,'2023-05-10 14:17:32',0.00,0.00,2,1),(9,'2023-05-10 14:19:41',0.00,0.00,2,1),(10,'2023-05-10 14:21:06',0.00,0.00,2,1),(11,'2023-05-10 14:34:57',0.00,0.00,2,1),(12,'2023-05-10 15:21:44',0.00,0.00,2,1),(13,'2023-05-10 15:23:10',0.00,0.00,2,1),(14,'2023-05-10 15:31:29',0.00,0.00,2,1),(15,'2023-05-10 15:35:05',0.00,0.00,2,1),(16,'2023-05-10 15:45:43',0.00,0.00,2,1),(17,'2023-05-11 08:40:52',0.00,0.00,2,1),(18,'2023-05-11 09:16:15',216.20,259.44,2,1),(19,'2023-05-11 12:44:49',256.30,295.56,2,1),(20,'2023-05-11 12:58:22',827.20,988.64,3,1),(21,'2023-05-12 08:51:11',150.00,176.00,3,3),(22,'2023-05-15 10:48:55',235.80,282.96,2,3);
/*!40000 ALTER TABLE `facture` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ligne_facture`
--

DROP TABLE IF EXISTS `ligne_facture`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ligne_facture` (
  `quantité` int NOT NULL,
  `id_produits` int DEFAULT NULL,
  `id_facture` int DEFAULT NULL,
  KEY `FK_produits_id_produits_ligne_facture` (`id_produits`),
  KEY `FK_facture_id_facture_ligne_facture` (`id_facture`),
  CONSTRAINT `FK_facture_id_facture_ligne_facture` FOREIGN KEY (`id_facture`) REFERENCES `facture` (`id`),
  CONSTRAINT `FK_produits_id_produits_ligne_facture` FOREIGN KEY (`id_produits`) REFERENCES `produits` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ligne_facture`
--

LOCK TABLES `ligne_facture` WRITE;
/*!40000 ALTER TABLE `ligne_facture` DISABLE KEYS */;
INSERT INTO `ligne_facture` VALUES (2,1,11),(3,3,11),(2,1,12),(4,4,12),(2,1,13),(2,2,14),(2,3,15),(3,5,15),(2,1,16),(3,3,16),(2,1,17),(3,3,17),(2,1,18),(3,4,18),(2,4,19),(3,2,19),(1,3,19),(3,4,20),(1,2,20),(2,3,20),(10,1,20),(2,1,21),(1,2,21),(3,1,22),(2,4,22);
/*!40000 ALTER TABLE `ligne_facture` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personnel`
--

DROP TABLE IF EXISTS `personnel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personnel` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personnel`
--

LOCK TABLES `personnel` WRITE;
/*!40000 ALTER TABLE `personnel` DISABLE KEYS */;
INSERT INTO `personnel` VALUES (1,'benjamin','$2y$10$L3v.Q085/m47cHmfEtgrSuVMFEZyyhuiSW9quJUtW4VO8dlF73G62',1),(3,'admin','$2y$10$qhazqDzGeXscn.qCaJQBUOUmtZ9i64X0ZuHBAwTU1eTipnO0c1Qhu',2);
/*!40000 ALTER TABLE `personnel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produits`
--

DROP TABLE IF EXISTS `produits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produits` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `reference` varchar(5) NOT NULL,
  `price_ht` decimal(4,2) NOT NULL,
  `stock` int DEFAULT NULL,
  `alerte` int NOT NULL,
  `id_tva` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tva_id_tva_produits` (`id_tva`),
  CONSTRAINT `FK_tva_id_tva_produits` FOREIGN KEY (`id_tva`) REFERENCES `tva` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produits`
--

LOCK TABLES `produits` WRITE;
/*!40000 ALTER TABLE `produits` DISABLE KEYS */;
INSERT INTO `produits` VALUES (1,'Doussofess','SD',55.00,20,15,2),(2,'Duracuir','SC',40.00,15,10,1),(3,'Voiclair','VC',65.50,17,15,2),(4,'Korn2vach','GT',35.40,14,12,2),(5,'MacGyver','MG',28.00,20,10,2);
/*!40000 ALTER TABLE `produits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tva`
--

DROP TABLE IF EXISTS `tva`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tva` (
  `id` int NOT NULL AUTO_INCREMENT,
  `taux` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tva`
--

LOCK TABLES `tva` WRITE;
/*!40000 ALTER TABLE `tva` DISABLE KEYS */;
INSERT INTO `tva` VALUES (1,10),(2,20);
/*!40000 ALTER TABLE `tva` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-05-15 13:30:28
