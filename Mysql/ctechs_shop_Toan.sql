-- MariaDB dump 10.19  Distrib 10.4.27-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: ctechs
-- ------------------------------------------------------
-- Server version	10.4.27-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `ctechs`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `ctechs` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `ctechs`;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `pid` varchar(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `pCount` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`cart_id`,`pid`),
  KEY `product_cart_pID` (`pid`),
  CONSTRAINT `product_cart_pID` FOREIGN KEY (`pID`) REFERENCES `product` (`pID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` VALUES (22,24,'Asu001',4,'2022-12-18'),(23,24,'ip001',2,'2022-12-18'),(24,24,'Asu002',4,'2022-12-18');
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `cat_id` varchar(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `catName` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES ('Asu','Asus'),('iph','iPhone'),('Opp','OPPO'),('Sam','Samsung');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `pid` varchar(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `pName` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `pPrice` decimal(8,0) NOT NULL,
  `pStatus` tinyint(1) NOT NULL,
  `pDescription` varchar(400) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `pImage` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `pQuantity` int(8) NOT NULL DEFAULT 1,
  `cat_id` varchar(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`pid`),
  KEY `product_cat_id` (`cat_id`),
  CONSTRAINT `product_cat_id` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES ('Asu001','Asus ROG Phone 5S 5G 16GB-512GB',22990000,0,'Trademark: Asus\r\nOrigin: China\r\nRelease time: 12/2021\r\nWarranty period (months): 12\r\nStorage instructions: Store in a dry, light, fragile place.\r\n','asus001',6,'Asu'),('Asu002','Asus ROG 6 BATMAN 12GB-256GB',27990000,0,'Trademark: Asus\r\nOrigin: China\r\nRelease time: 08/2022\r\nWarranty period (months): 12\r\nStorage instructions: Store in a dry, light, fragile place.\r\n','asus002',4,'Asu'),('Asu003','Asus ROG 6 DIABLO 16GB-512GB ',29990000,0,'Trademark: Asus\nOrigin: China\nRelease time: 08/2022\nWarranty period (months): 12\nStorage instructions: Store in a dry, light, fragile place.\n','asus003',5,'Asu'),('ip001','iPhone 14 Pro Max 12',34990000,0,'Trademark: Apple\r\nOrigin: China\r\nRelease time: 09/2022\r\nWarranty period (months): 12\r\nStorage instructions: Store in a dry, light, fragile place.\r\n','ip001',5,'iph'),('ip002','iPhone 14 128GB',24990000,0,'Trademark: Apple\nOrigin: China\nRelease time: 09/2022\nWarranty period (months): 12\nStorage instructions: Store in a dry, light, fragile place.\n','ip002',6,'iph'),('ip003','iPhone 13 Pro Max 256GB',36990000,0,'Trademark: Apple\r\nOrigin: China\r\nRelease time: 09/2021\r\nWarranty period (months): 12\r\nStorage instructions: Store in a dry, light, fragile place.\r\n','ip003',3,'iph'),('ip004','iPhone 13 128GB',24990000,0,'Trademark: Apple\r\nOrigin: China\r\nRelease time: 09/2021\r\nWarranty period (months): 12\r\nStorage instructions: Store in a dry, light, fragile place.\r\n','ip004',4,'iph'),('ip005','iPhone 12 64GB',19999000,0,'Trademark: Apple\r\nOrigin: China\r\nRelease time: 10/2020\r\nWarranty period (months): 12\r\nStorage instructions: Store in a dry, light, fragile place.\r\n','ip005',4,'iph'),('Opp001','OPPO Find X5 Pro 256GB ',32990000,0,'Trademark: OPPO\r\nOrigin: China\r\nRelease time: 05/2022\r\nWarranty period (months): 12\r\nStorage instructions: Store in a dry, light, fragile place.\r\n','opp001',5,'Opp'),('Opp002','OPPO Reno8 Z 5G 8GB - 256GB',10490000,0,'Trademark: OPPO\r\nOrigin: China\r\nRelease time: 03/2022\r\nWarranty period (months): 12\r\nStorage instructions: Store in a dry, light, fragile place.\r\n','opp002',3,'Opp'),('Opp003','OPPO Reno8 Pro 5G 12GB - 256GB',18990000,0,'Trademark: OPPO\r\nOrigin: China\r\nRelease time: 03/2022\r\nWarranty period (months): 12\r\nStorage instructions: Store in a dry, light, fragile place.\r\n','opp003',4,'Opp'),('Opp004','OPPO Reno7 Z 5G 8GB - 128GB',9990000,0,'Trademark: OPPO\r\nOrigin: China\r\nRelease time: 03/2022\r\nWarranty period (months): 12\r\nStorage instructions: Store in a dry, light, fragile place.\r\n','opp004',5,'Opp'),('Opp005','OPPO A96 8GB-128GB',6490000,0,'Trademark: OPPO\r\nOrigin: China\r\nRelease time: 06/2022\r\nWarranty period (months): 12\r\nStorage instructions: Store in a dry, light, fragile place.\r\n','opp005',4,'Opp'),('sam001','Samsung Galaxy Z Fold4 5G 512GB',44490000,0,'Brand: Samsung\r\nMade in Viet Nam\r\nRelease date: 08/2022\r\nWarranty period (month): 12\r\nCare instructions: Keep in a dry, light, fragile place.\r\nImporter: Samsung\r\nManufacturer: Samsung\r\nDistributor: Samsung Vietnam','sam001',6,'Sam'),('sam002','Samsung Galaxy A73 5G',11990000,0,'Brand: Samsung\r\nMade in: Viet Nam / China\r\nRelease date: 2022\r\nWarranty period (month): 12\r\nCare instructions: Keep in a dry, light, fragile place.\r\nImporter: Samsung\r\nManufacturer: Samsung\r\nDistributor: Samsung Vietnam','sam002',4,'Sam'),('sam003','Samsung Galaxy S22 Ultra 5G 512GB',36990000,0,'Brand: Samsung\r\nMade in: Viet Nam / China\r\nRelease date: 03/2022\r\nWarranty period (month): 12\r\nCare instructions: Keep in a dry, light, fragile place.','sam003',3,'Sam'),('sam004','Samsung Galaxy S21 FE 5G 8GB - 128GB',16990000,0,'Brand: Samsung\r\nMade in: Viet Nam / China\r\nRelease date: 01/2022\r\nWarranty period (month): 12\r\nCare instructions: Keep in a dry, light, fragile place.','sam004',4,'Sam'),('sam005','Samsung Galaxy A13',4690000,0,'Brand: Samsung\r\nMade in: Viet Nam / China\r\nRelease date: 2022\r\nWarranty period (month): 12\r\nCare instructions: Keep in a dry, light, fragile place.\r\nImporter: Samsung\r\nManufacturer: Samsung\r\nDistributor: Samsung Vietnam','sam005',4,'Sam');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `email` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fullname` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `address` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `role` int(11) NOT NULL,
  `phone` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `birthday` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (24,'skaosinki@gmail.com','Toan',0,'Can Tho','123456',0,'0362164801','2003-08-09'),(25,'toanntgcc210097@fpt.edu.vn','Ton',0,'Can Tho','123456',0,'0362164801','2003-08-09'),(26,'superbat4869@gmail.com','Ton',0,'Can Tho','1234567',0,'0362164801','2003-08-09'),(27,'karasumasensi@gmail.com','Ton',0,'Can tho','09082003',0,'0362164801','2003-08-09'),(28,'aswdad@gmail.com','Ton',0,'Can Tho','09082003',0,'0362164801','2003-08-09');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `verified_order`
--

DROP TABLE IF EXISTS `verified_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `verified_order` (
  `oder_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sum` bigint(20) NOT NULL,
  `pid` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Quantity` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`oder_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `verified_order`
--

LOCK TABLES `verified_order` WRITE;
/*!40000 ALTER TABLE `verified_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `verified_order` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-12-18  8:23:52
