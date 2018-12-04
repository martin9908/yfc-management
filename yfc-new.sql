-- MySQL dump 10.13  Distrib 5.7.17, for macos10.12 (x86_64)
--
-- Host: localhost    Database: yfc_db
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.33-MariaDB

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
-- Table structure for table `info_area`
--

DROP TABLE IF EXISTS `info_area`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `info_area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `areaName` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `info_area`
--

LOCK TABLES `info_area` WRITE;
/*!40000 ALTER TABLE `info_area` DISABLE KEYS */;
INSERT INTO `info_area` VALUES (1,'Admin'),(4,'Metro Manila'),(5,'South Luzon'),(6,'North Luzon');
/*!40000 ALTER TABLE `info_area` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `info_attendance`
--

DROP TABLE IF EXISTS `info_attendance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `info_attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `payment_status` varchar(45) NOT NULL,
  `remarks` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user_idx` (`user_id`),
  KEY `id_events_idx` (`event_id`),
  CONSTRAINT `id_events` FOREIGN KEY (`event_id`) REFERENCES `reservation_venue` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `id_user` FOREIGN KEY (`user_id`) REFERENCES `info_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `info_attendance`
--

LOCK TABLES `info_attendance` WRITE;
/*!40000 ALTER TABLE `info_attendance` DISABLE KEYS */;
/*!40000 ALTER TABLE `info_attendance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `info_chapter`
--

DROP TABLE IF EXISTS `info_chapter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `info_chapter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chapterName` varchar(45) NOT NULL,
  `sectorId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Sector_ID_idx` (`sectorId`),
  CONSTRAINT `Sector_ID` FOREIGN KEY (`sectorId`) REFERENCES `info_sector` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `info_chapter`
--

LOCK TABLES `info_chapter` WRITE;
/*!40000 ALTER TABLE `info_chapter` DISABLE KEYS */;
INSERT INTO `info_chapter` VALUES (1,'Admin',1),(7,'Las PiÃ±as',7),(8,'Villamor',8),(9,'Merville',8),(10,'Mapua Intramuros',9),(11,'Mapua Makati',9),(12,'De La Salle University - Taft',9),(13,'Bacoor',10),(14,'DasmariÃ±as',10),(15,'Lipa',11),(16,'Batangas City',11),(17,'Malolos',13),(18,'Angeles City',14),(19,'San Fernando',14);
/*!40000 ALTER TABLE `info_chapter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `info_payment`
--

DROP TABLE IF EXISTS `info_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `info_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `pament_type` varchar(45) NOT NULL,
  `payment_date` date NOT NULL,
  `pament_time` time NOT NULL,
  `payment_made` float NOT NULL,
  `payment_reference` varchar(45) NOT NULL,
  `processed_by` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `remarks` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_idx` (`user_id`),
  KEY `event_id_idx` (`event_id`),
  CONSTRAINT `event_id` FOREIGN KEY (`event_id`) REFERENCES `reservation_venue` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `info_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `info_payment`
--

LOCK TABLES `info_payment` WRITE;
/*!40000 ALTER TABLE `info_payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `info_payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `info_sector`
--

DROP TABLE IF EXISTS `info_sector`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `info_sector` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sectorName` varchar(50) NOT NULL,
  `areaId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Area_ID_idx` (`areaId`),
  CONSTRAINT `AREA_ID` FOREIGN KEY (`areaId`) REFERENCES `info_area` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `info_sector`
--

LOCK TABLES `info_sector` WRITE;
/*!40000 ALTER TABLE `info_sector` DISABLE KEYS */;
INSERT INTO `info_sector` VALUES (1,'Admin',1),(7,'South A',4),(8,'South B',4),(9,'Central C',4),(10,'Cavite',5),(11,'Batangas',5),(12,'Laguna',5),(13,'Bulacan',6),(14,'Pampanga',6);
/*!40000 ALTER TABLE `info_sector` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `info_user`
--

DROP TABLE IF EXISTS `info_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `info_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `User_Number` varchar(50) NOT NULL,
  `First_Name` varchar(50) NOT NULL,
  `Middle_Name` varchar(50) DEFAULT NULL,
  `Last_Name` varchar(50) NOT NULL,
  `Gender` varchar(45) NOT NULL,
  `Address` varchar(500) NOT NULL,
  `Contact_Number` varchar(45) NOT NULL,
  `Account_Type` int(11) NOT NULL,
  `Account_Status` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `Area` int(11) NOT NULL,
  `Sector` int(11) NOT NULL,
  `Chapter` int(11) NOT NULL,
  `Member_Since` date NOT NULL,
  `Account_Picture` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `area_idx` (`Area`),
  KEY `sector_idx` (`Sector`),
  KEY `CHAPTER_idx` (`Chapter`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `info_user`
--

LOCK TABLES `info_user` WRITE;
/*!40000 ALTER TABLE `info_user` DISABLE KEYS */;
INSERT INTO `info_user` VALUES (1,'1001','Admin','','Data','M','Test Data','9123456789',1,'Active','admin123',1,1,1,'2018-01-01',NULL),(21,'YMM-2018-797480','Encoder','of','Villamor','M','Address','9132456789',2,'Active','Villamor',4,8,8,'2018-06-01',NULL),(22,'YMM-2018-728789','Encoder','M','Mapua Makati','F','Makati','9123456789',2,'Active','Mapua Makati',4,9,11,'2018-06-20',NULL),(23,'YMM-2018-698892','Encoder','I','Mapua Intramuros','F','Intramuros','09132456789',2,'Active','Mapua Intramuros',4,9,10,'2018-06-20',NULL),(24,'YMM-2018-130964','One','Ragos','Ragos','F','Address','09132456789',0,'Pending','1234',4,9,11,'2008-05-29',NULL),(25,'YMM-2018-809382','TEST','ENCODER','DATA','M','TEST DATA','09123456789',2,'Active','DATA',5,10,13,'2017-06-13',NULL),(26,'YMM-2018-115450','Test','Sector','Encoder','M','TEST DATA','9123456789',3,'Active','Encoder',4,8,8,'2018-07-03','');
/*!40000 ALTER TABLE `info_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservation_venue`
--

DROP TABLE IF EXISTS `reservation_venue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reservation_venue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reservation_place` varchar(100) NOT NULL,
  `reservation_date` date NOT NULL,
  `reservation_end_date` date NOT NULL,
  `reservation_time` time NOT NULL,
  `reservation_end_time` time NOT NULL,
  `event_type` varchar(45) NOT NULL,
  `reservation_event` varchar(500) NOT NULL,
  `reservation_status` varchar(45) NOT NULL,
  `reservation_area` int(11) NOT NULL,
  `reservation_sector` int(11) NOT NULL,
  `reservation_chapter` int(11) NOT NULL,
  `reservation_fee` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sector_fk_idx` (`reservation_sector`),
  KEY `area_fk_idx` (`reservation_area`),
  KEY `user_fk_idx` (`id`),
  CONSTRAINT `area_fk` FOREIGN KEY (`reservation_area`) REFERENCES `info_area` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sector_fk` FOREIGN KEY (`reservation_sector`) REFERENCES `info_sector` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservation_venue`
--

LOCK TABLES `reservation_venue` WRITE;
/*!40000 ALTER TABLE `reservation_venue` DISABLE KEYS */;
INSERT INTO `reservation_venue` VALUES (11,'YFC International Conference','2018-06-30','2018-06-30','13:00:00','17:00:00','International','Circuit Makati','Reserved',4,9,11,0),(13,'New Test Venue','2018-09-17','2018-09-18','22:00:00','21:00:00','local','New Test Event','Reserved',4,7,7,2500);
/*!40000 ALTER TABLE `reservation_venue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `time_avail`
--

DROP TABLE IF EXISTS `time_avail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `time_avail` (
  `idtime_avail` int(11) NOT NULL AUTO_INCREMENT,
  `Time` time NOT NULL,
  PRIMARY KEY (`idtime_avail`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `time_avail`
--

LOCK TABLES `time_avail` WRITE;
/*!40000 ALTER TABLE `time_avail` DISABLE KEYS */;
INSERT INTO `time_avail` VALUES (1,'07:30:00'),(2,'09:30:00'),(3,'11:30:00'),(4,'13:30:00'),(5,'15:30:00'),(6,'17:30:00');
/*!40000 ALTER TABLE `time_avail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'yfc_db'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-09-17  9:56:18
