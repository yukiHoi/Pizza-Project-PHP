-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: pizzadb
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

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
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `category_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(20) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Meat Lovers'),(2,'Vegetarian'),(3,'Specialty');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `crusttype`
--

DROP TABLE IF EXISTS `crusttype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `crusttype` (
  `crust_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `crust_type` varchar(20) NOT NULL,
  `crust_price` decimal(5,2) NOT NULL CHECK (`crust_price` >= 0),
  PRIMARY KEY (`crust_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `crusttype`
--

LOCK TABLES `crusttype` WRITE;
/*!40000 ALTER TABLE `crusttype` DISABLE KEYS */;
INSERT INTO `crusttype` VALUES (1,'Regular',2.00),(2,'Cheese Stuffed',3.50),(3,'Deep Pan',2.75),(4,'Thin',1.50);
/*!40000 ALTER TABLE `crusttype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `customer_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone_no` varchar(15) NOT NULL,
  `address` varchar(50) NOT NULL,
  `county` varchar(30) NOT NULL,
  `town` varchar(20) NOT NULL,
  `eircode` varchar(7) NOT NULL,
  `password` varchar(10) NOT NULL,
  PRIMARY KEY (`customer_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (1,'ioki','hoi','ioki@hotmail.com','0987654345','ABC address','kerry','Tralee','g67v432','123');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customerorders`
--

DROP TABLE IF EXISTS `customerorders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customerorders` (
  `order_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `order_date` date DEFAULT curdate(),
  `total_price` decimal(7,2) DEFAULT NULL CHECK (`total_price` >= 0),
  `customer_id` smallint(6) NOT NULL,
  `payment_status` enum('Y','N','R') DEFAULT NULL,
  `order_status` enum('Success','Cancelled') DEFAULT 'Success',
  PRIMARY KEY (`order_id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `customerorders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customerorders`
--

LOCK TABLES `customerorders` WRITE;
/*!40000 ALTER TABLE `customerorders` DISABLE KEYS */;
INSERT INTO `customerorders` VALUES (1,'2025-05-02',16.99,1,'Y','Success'),(2,'2025-05-02',52.98,1,'Y','Success');
/*!40000 ALTER TABLE `customerorders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orderdetails`
--

DROP TABLE IF EXISTS `orderdetails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orderdetails` (
  `order_id` smallint(6) NOT NULL,
  `pizza_id` smallint(6) NOT NULL,
  `crust_id` smallint(6) NOT NULL,
  `size_id` smallint(6) NOT NULL,
  `quantity` tinyint(4) NOT NULL CHECK (`quantity` > 0),
  `line_total_price` decimal(5,2) NOT NULL CHECK (`line_total_price` >= 0),
  PRIMARY KEY (`order_id`,`pizza_id`,`crust_id`,`size_id`),
  KEY `pizza_id` (`pizza_id`),
  KEY `size_id` (`size_id`),
  KEY `crust_id` (`crust_id`),
  CONSTRAINT `orderdetails_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `customerorders` (`order_id`),
  CONSTRAINT `orderdetails_ibfk_2` FOREIGN KEY (`pizza_id`) REFERENCES `pizza` (`pizza_id`),
  CONSTRAINT `orderdetails_ibfk_3` FOREIGN KEY (`size_id`) REFERENCES `pizzasize` (`size_id`),
  CONSTRAINT `orderdetails_ibfk_4` FOREIGN KEY (`crust_id`) REFERENCES `crusttype` (`crust_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orderdetails`
--

LOCK TABLES `orderdetails` WRITE;
/*!40000 ALTER TABLE `orderdetails` DISABLE KEYS */;
INSERT INTO `orderdetails` VALUES (1,2,1,1,1,16.99),(2,8,2,2,2,52.98);
/*!40000 ALTER TABLE `orderdetails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pizza`
--

DROP TABLE IF EXISTS `pizza`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pizza` (
  `pizza_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `pizza_name` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `category_id` smallint(6) NOT NULL,
  `base_price` decimal(5,2) NOT NULL CHECK (`base_price` >= 0),
  PRIMARY KEY (`pizza_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `pizza_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pizza`
--

LOCK TABLES `pizza` WRITE;
/*!40000 ALTER TABLE `pizza` DISABLE KEYS */;
INSERT INTO `pizza` VALUES (1,'Pepperoni','Classic pepperoni slices on a cheesy crust.',1,6.00),(2,'Spicy Sausage Pizza','Spicy sausage with Italian flavors.',1,8.00),(3,'Margarita','A classic pizza with fresh tomato sauce, mozzarella, and basil leaves.',2,7.00),(4,'Buffalo Chicken Pizza','Buffalo chicken with tangy sauce.',1,7.00),(5,'Chef Special Pizza','A special blend of premium toppings.',1,9.00),(6,'Summer Squash California Style','Healthy California-style veggie pizza.',2,5.00),(7,'Bacon Pizza','Bacon pizza with crispy, smoky bites.',3,9.00),(8,'Seafood Delight','Shrimp, calamari, and crab on a creamy white sauce base.',3,12.00),(9,'Pesto Chicken Pizza','Grilled chicken, pesto sauce, sun-dried tomatoes, and cheese.',1,10.00),(10,'Buffalo Ranch Pizza','Spicy buffalo sauce, ranch dressing, and crispy chicken.',3,9.00);
/*!40000 ALTER TABLE `pizza` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pizzasize`
--

DROP TABLE IF EXISTS `pizzasize`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pizzasize` (
  `size_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `pizza_size` varchar(20) NOT NULL,
  `size_price` decimal(5,2) NOT NULL CHECK (`size_price` >= 0),
  PRIMARY KEY (`size_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pizzasize`
--

LOCK TABLES `pizzasize` WRITE;
/*!40000 ALTER TABLE `pizzasize` DISABLE KEYS */;
INSERT INTO `pizzasize` VALUES (1,'Small',6.99),(2,'Regular',10.99),(3,'Large',13.99),(4,'XLarge',16.99);
/*!40000 ALTER TABLE `pizzasize` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-02 12:56:53
