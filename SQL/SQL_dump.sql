-- MariaDB dump 10.17  Distrib 10.4.11-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: vids
-- ------------------------------------------------------
-- Server version	10.4.11-MariaDB

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Animation & Filme'),(2,'Autos & Fahrzeuge'),(3,'Musik'),(4,'Tiere'),(5,'Sport'),(6,'Reisen & Events'),(7,'Gaming'),(8,'Menschen & Blogs'),(9,'Comedy'),(10,'Entertainment'),(11,'Neuigkeiten & Politik'),(12,'Howto & Style'),(13,'Bildung'),(14,'Wissenschaft & Technologie');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `postedBy` varchar(50) NOT NULL,
  `videoid` int(11) NOT NULL,
  `responseTo` int(11) NOT NULL,
  `body` text NOT NULL,
  `datePosted` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,'admin',41,0,'hello World','2020-04-29 00:37:48'),(2,'admin',41,0,'NICE!','2020-04-29 00:44:39'),(3,'admin',41,0,'test','2020-04-29 01:08:49'),(4,'admin',41,0,'SPAM!','2020-04-29 01:10:35'),(5,'admin',41,0,'asd','2020-04-29 01:14:08'),(6,'admin',41,0,'HOLY IT WORKS!','2020-04-29 01:14:14'),(7,'admin',41,0,'test','2020-04-29 01:26:33'),(8,'admin',41,0,'test','2020-04-29 03:22:23'),(9,'admin',41,0,'Try','2020-04-29 03:23:53'),(10,'admin',41,0,'tRY','2020-04-29 03:24:21'),(11,'admin',41,0,'asdsad','2020-04-29 03:29:54'),(12,'admin',41,0,'test','2020-04-29 03:37:26'),(13,'admin',41,0,'Another one!','2020-04-29 03:39:47'),(14,'admin',41,0,'test','2020-04-29 03:40:58'),(15,'admin',41,0,'test','2020-04-29 03:42:04'),(16,'admin',41,0,'test','2020-04-29 03:46:27'),(17,'admin',41,0,'te','2020-04-29 03:46:33'),(18,'admin',41,0,'test','2020-04-29 03:46:47'),(19,'admin',41,0,'asd','2020-04-29 03:47:43'),(20,'admin',41,0,'asd','2020-04-29 03:48:14'),(21,'admin',41,0,'asd','2020-04-29 03:48:58'),(22,'admin',41,21,'asdasd','2020-04-29 03:49:03'),(23,'admin',41,0,'fsdgsdf','2020-04-29 03:50:03'),(24,'admin',41,0,'sdfsdf','2020-04-29 03:50:27'),(25,'admin',41,0,'asd','2020-04-29 03:53:19'),(26,'admin',41,0,'asdad','2020-04-29 03:53:26'),(27,'admin',41,0,'asd','2020-04-29 03:53:59'),(28,'admin',41,0,'asd','2020-04-29 03:54:32'),(29,'admin',41,0,'asd','2020-04-29 03:55:46'),(30,'admin',41,0,'asd','2020-04-29 03:56:17'),(31,'admin',41,0,'asd','2020-04-29 03:56:42'),(32,'admin',41,0,'asd','2020-04-29 03:57:07'),(33,'admin',41,0,'asd','2020-04-29 03:58:26'),(34,'admin',41,33,'asdasdasdasdasdasdsadadasdad','2020-04-29 03:59:20'),(35,'admin',41,0,'Kommentar','2020-04-29 03:59:39'),(36,'admin',41,0,'asd','2020-04-29 04:00:35'),(37,'admin',41,0,'asd','2020-04-29 04:02:07'),(38,'admin',41,0,'asd','2020-04-29 04:02:37'),(39,'admin',41,0,'asd','2020-04-29 04:02:54'),(40,'admin',41,39,'asdasdasd','2020-04-29 04:03:04'),(41,'admin',41,0,'asd','2020-04-29 04:04:17'),(42,'admin',41,0,'d','2020-04-29 04:05:16'),(43,'admin',41,0,'asd','2020-04-29 04:06:02'),(44,'admin',41,0,'asd','2020-04-29 04:06:58'),(45,'admin',41,0,'asd','2020-04-29 04:07:16'),(46,'admin',41,0,'asd','2020-04-29 04:07:24'),(47,'admin',41,0,'asd','2020-04-29 04:08:20'),(48,'admin',41,47,'Neuer Kommentar','2020-04-29 04:08:31'),(49,'admin',41,0,'asd','2020-04-29 04:09:39'),(50,'admin',41,0,'asd','2020-04-29 04:10:35'),(51,'admin',41,0,'asd','2020-04-29 04:10:52'),(52,'admin',41,0,'asd','2020-04-29 04:12:19'),(53,'admin',41,52,'asdasd','2020-04-29 04:12:23'),(54,'admin',41,0,'asd','2020-04-29 04:13:11'),(55,'admin',41,0,'asd','2020-04-29 04:13:24'),(56,'admin',41,0,'asd','2020-04-29 04:14:44'),(57,'admin',41,0,'asd','2020-04-29 04:17:12'),(58,'admin',41,57,'asdasd','2020-04-29 04:17:21'),(59,'admin',41,0,'asd','2020-04-29 04:17:48'),(60,'admin',41,0,'a','2020-04-29 04:18:24'),(61,'admin',41,0,'asd','2020-04-29 04:18:39'),(62,'admin',41,0,'asd','2020-04-29 04:19:04'),(63,'admin',41,0,'asd','2020-04-29 04:22:08'),(64,'admin',41,0,'asd','2020-04-29 04:23:41'),(65,'admin',41,0,'asd','2020-04-29 04:24:14'),(66,'admin',41,0,'asd','2020-04-29 04:29:46'),(67,'admin',41,0,'s','2020-04-29 04:32:37'),(68,'admin',41,0,'Test','2020-04-29 04:36:31'),(69,'admin',41,0,'Ein Kommentar','2020-04-29 04:37:58'),(70,'admin',41,69,'asdasd','2020-04-29 04:38:02'),(71,'admin',41,0,'test','2020-04-29 04:38:15'),(72,'admin',41,0,'Test','2020-04-29 04:49:29'),(73,'admin',41,0,'asd','2020-04-29 04:53:40'),(74,'admin',41,0,'HATER','2020-04-29 04:55:46'),(75,'admin',41,0,'asdasd','2020-04-29 05:03:43'),(76,'admin',41,0,'THIS COMMENT!!!!','2020-04-29 05:14:08'),(77,'admin',41,76,'Antwort1','2020-04-29 05:14:18'),(78,'admin',41,77,'Antwort 2','2020-04-29 05:14:24'),(79,'admin',41,76,'Try','2020-04-29 05:14:42'),(80,'admin',41,76,'KOMMENTAR','2020-04-29 05:22:25'),(81,'admin',41,76,'KOMMENTAR2','2020-04-29 05:22:29'),(82,'admin',41,79,'NO YOU TRY','2020-04-29 05:34:42'),(83,'admin',41,0,'asd','2020-04-29 05:45:22'),(84,'account',41,0,'NICE!','2020-04-29 15:16:35'),(85,'account',41,84,'NICE2','2020-04-29 15:16:41');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dislikes`
--

DROP TABLE IF EXISTS `dislikes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dislikes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `commentid` int(11) NOT NULL,
  `videoid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dislikes`
--

LOCK TABLES `dislikes` WRITE;
/*!40000 ALTER TABLE `dislikes` DISABLE KEYS */;
INSERT INTO `dislikes` VALUES (79,'Krigam',0,40),(83,'admin',75,0),(84,'admin',73,0),(85,'account',85,0);
/*!40000 ALTER TABLE `dislikes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `commentid` int(11) DEFAULT NULL,
  `videoid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likes`
--

LOCK TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;
INSERT INTO `likes` VALUES (113,'Krigam',0,41),(120,'admin',0,41),(123,'admin',72,0),(135,'admin',74,0),(136,'admin',82,0),(137,'account',84,0),(138,'account',0,47),(139,'admin',NULL,44),(141,'admin',NULL,47);
/*!40000 ALTER TABLE `likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscribers`
--

DROP TABLE IF EXISTS `subscribers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userTo` varchar(50) NOT NULL,
  `userFrom` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscribers`
--

LOCK TABLES `subscribers` WRITE;
/*!40000 ALTER TABLE `subscribers` DISABLE KEYS */;
INSERT INTO `subscribers` VALUES (16,'admin','Krigam'),(20,'Krigam','admin'),(21,'Krigam','account');
/*!40000 ALTER TABLE `subscribers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `thumbnails`
--

DROP TABLE IF EXISTS `thumbnails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `thumbnails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `videoid` int(11) NOT NULL,
  `filePath` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `thumbnails`
--

LOCK TABLES `thumbnails` WRITE;
/*!40000 ALTER TABLE `thumbnails` DISABLE KEYS */;
INSERT INTO `thumbnails` VALUES (17,31,'uploads/thumbnails/31-5ea38eba538ba.jpg'),(18,32,'uploads/thumbnails/32-5ea38ee9bd22d.jpg'),(19,33,'uploads/thumbnails/33-5ea38f0cad587.jpg'),(20,34,'uploads/thumbnails/34-5ea38fab9ed42.jpg'),(21,35,'uploads/thumbnails/35-5ea38fc18980e.jpg'),(22,36,'uploads/thumbnails/36-5ea612f350796.jpg'),(23,40,'uploads/thumbnails/40-5ea7bab8f2ea1.jpg'),(24,41,'uploads/thumbnails/41-5ea81b7c52504.jpg'),(25,42,'uploads/thumbnails/42-5ea915eed6477.jpg'),(26,43,'uploads/thumbnails/43-5ea915f8d985b.jpg'),(27,44,'uploads/thumbnails/44-5ea9160038916.jpg'),(28,45,'uploads/thumbnails/45-5ea9160e711ac.jpg'),(29,46,'uploads/thumbnails/46-5ea91d3f232f4.jpg'),(30,47,'uploads/thumbnails/47-5ea97dfdabcb4.jpg');
/*!40000 ALTER TABLE `thumbnails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(25) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `signUpDate` datetime NOT NULL DEFAULT current_timestamp(),
  `profilePicture` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Robert','Merk','Krigam','robert-merk98@web.de','3f23b4f6aa157596cc0f859e3d21b90d12be06d7679a99bf32d6fdb5e5c58518168f60c440c5531f154b16d9d1f31e2a59fa9c438cbef81b82efc4077860c8ed','2020-04-27 07:43:26','assets/images/profile/profile.png'),(2,'Don','Quichote','testingnames','robert-merk98e@web.de','3f23b4f6aa157596cc0f859e3d21b90d12be06d7679a99bf32d6fdb5e5c58518168f60c440c5531f154b16d9d1f31e2a59fa9c438cbef81b82efc4077860c8ed','2020-04-27 07:47:30','assets/images/profile/profile.png'),(3,'Admin','Admin','admin','admin@admin.de','c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec','2020-04-28 14:42:48','assets/images/profile/profile.png'),(4,'Testt','Testt','testt','test@web.de','3f23b4f6aa157596cc0f859e3d21b90d12be06d7679a99bf32d6fdb5e5c58518168f60c440c5531f154b16d9d1f31e2a59fa9c438cbef81b82efc4077860c8ed','2020-04-29 11:06:38','assets/images/profile/profilecolored.png'),(5,'Account','Account','account','account@web.de','1120073317f32dc4fa805e721c2b760fc379bdb7ea3b8d1943402d1f51b183a2ac3ef86cdaede190dd36c95b578b1b2ff5dd9ebeff41eb3e11846d6a389fe5f5','2020-04-29 15:15:23','assets/images/profile/profilecolored.png');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `videos`
--

DROP TABLE IF EXISTS `videos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uploadedBy` varchar(50) NOT NULL,
  `title` varchar(70) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `privacy` int(11) NOT NULL,
  `filePath` varchar(256) NOT NULL,
  `category` int(11) NOT NULL,
  `uploadDate` datetime NOT NULL DEFAULT current_timestamp(),
  `views` int(11) NOT NULL,
  `duration` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `videos`
--

LOCK TABLES `videos` WRITE;
/*!40000 ALTER TABLE `videos` DISABLE KEYS */;
INSERT INTO `videos` VALUES (40,'Krigam','A tiny angry squeaking Frog','',0,'uploads/videos/5ea7bab3245ff.mp4',1,'2020-04-28 07:10:11',227,'00:45'),(41,'Krigam','A tiny angry squeaking Frog','A little Frog showed by BBC',0,'uploads/videos/5ea81b767cd7c.mp4',6,'2020-04-28 14:03:02',286,'00:45'),(42,'admin','Maaaaaagisk!','Maaaaaagisk!Maaaaaagisk!Maaaaaagisk!Maaaaaagisk!Maaaaaagisk!',0,'uploads/videos/5ea915ee5844f.mp4',1,'2020-04-29 07:51:42',1,'00:05'),(43,'admin','name a yellow fruit','name a yellow fruitname a yellow fruitname a yellow fruitname a yellow fruitname a yellow fruit',0,'uploads/videos/5ea915f88dec2.mp4',1,'2020-04-29 07:51:52',10,'00:03'),(44,'admin','test','',0,'uploads/videos/5ea915ffa1c82.mp4',1,'2020-04-29 07:51:59',7,'00:07'),(45,'admin','Paranormal','',0,'uploads/videos/5ea9160a44034.mp4',1,'2020-04-29 07:52:10',25,'00:20'),(46,'admin','OBAMA','OBAMA',0,'uploads/videos/5ea91d3e7ceef.mp4',1,'2020-04-29 08:22:54',6,'00:03'),(47,'account','Worlds Largest Functioning Whoopee Cushion... And my thoroughly unimpr','Worlds Largest Functioning Whoopee Cushion... And my thoroughly unimpressed cat.mp4Worlds Largest Functioning Whoopee Cushion... And my thoroughly unimpressed cat.mp4',0,'uploads/videos/5ea97df9d0d0c.mp4',1,'2020-04-29 15:15:37',4,'00:15');
/*!40000 ALTER TABLE `videos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-10-08 19:20:53
