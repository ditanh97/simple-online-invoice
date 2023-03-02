-- MySQL dump 10.13  Distrib 8.0.25, for Win64 (x86_64)
--
-- Host: localhost    Database: invoiceapp
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
-- Table structure for table `log_invoices`
--

DROP TABLE IF EXISTS `log_invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `log_invoices` (
  `log_id` char(38) NOT NULL,
  `invoice_id` varchar(14) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `status` varchar(100) NOT NULL,
  `payment` decimal(19,2) DEFAULT NULL,
  `note` text,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_invoices`
--

LOCK TABLES `log_invoices` WRITE;
/*!40000 ALTER TABLE `log_invoices` DISABLE KEYS */;
/*!40000 ALTER TABLE `log_invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `m_invoice_status`
--

DROP TABLE IF EXISTS `m_invoice_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `m_invoice_status` (
  `invoice_status_id` int NOT NULL AUTO_INCREMENT,
  `label` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`invoice_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `m_invoice_status`
--

LOCK TABLES `m_invoice_status` WRITE;
/*!40000 ALTER TABLE `m_invoice_status` DISABLE KEYS */;
INSERT INTO `m_invoice_status` VALUES (1,'Draft','2023-03-02 09:31:57','2023-03-02 09:31:57'),(2,'Sent','2023-03-02 09:31:57','2023-03-02 09:31:57'),(3,'Viewed','2023-03-02 09:31:57','2023-03-02 09:31:57'),(4,'Partial','2023-03-02 09:31:57','2023-03-02 09:31:57'),(5,'Paid','2023-03-02 09:31:57','2023-03-02 09:31:57'),(6,'Overdue','2023-03-02 09:31:57','2023-03-02 09:31:57'),(7,'Canceled','2023-03-02 09:31:57','2023-03-02 09:31:57');
/*!40000 ALTER TABLE `m_invoice_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `m_items`
--

DROP TABLE IF EXISTS `m_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `m_items` (
  `item_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `type` enum('Service','Goods') NOT NULL,
  `description` varchar(256) NOT NULL,
  `qty` decimal(18,2) NOT NULL,
  `unit_price` decimal(19,2) NOT NULL,
  `amount` decimal(19,2) NOT NULL,
  `cur_code` varchar(3) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_paid` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `m_items`
--

LOCK TABLES `m_items` WRITE;
/*!40000 ALTER TABLE `m_items` DISABLE KEYS */;
INSERT INTO `m_items` VALUES (1,2,'Service','Design',41.00,230.00,9430.00,'GBP','2023-03-02 09:48:50','2023-03-02 09:48:50',0),(2,2,'Service','Development',57.00,330.00,18810.00,'GBP','2023-03-02 09:48:50','2023-03-02 09:48:50',0),(3,2,'Service','Development',4.50,60.00,270.00,'GBP','2023-03-02 09:48:50','2023-03-02 09:48:50',0);
/*!40000 ALTER TABLE `m_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `m_roles`
--

DROP TABLE IF EXISTS `m_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `m_roles` (
  `role_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `m_roles`
--

LOCK TABLES `m_roles` WRITE;
/*!40000 ALTER TABLE `m_roles` DISABLE KEYS */;
INSERT INTO `m_roles` VALUES (1,'Admin'),(2,'Client');
/*!40000 ALTER TABLE `m_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tt_invoice_item`
--

DROP TABLE IF EXISTS `tt_invoice_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tt_invoice_item` (
  `id` int NOT NULL AUTO_INCREMENT,
  `invoice_id` varchar(14) NOT NULL,
  `item_id` int NOT NULL,
  `qty_billed` decimal(18,2) NOT NULL,
  `unit_price` decimal(19,2) NOT NULL,
  `total_price` decimal(19,2) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cur_code` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tt_invoice_item`
--

LOCK TABLES `tt_invoice_item` WRITE;
/*!40000 ALTER TABLE `tt_invoice_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `tt_invoice_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tt_invoices`
--

DROP TABLE IF EXISTS `tt_invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tt_invoices` (
  `invoice_id` varchar(14) NOT NULL,
  `user_id` int NOT NULL,
  `issue_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `due_date` datetime NOT NULL,
  `subject` varchar(100) NOT NULL,
  `subtotal` decimal(19,2) NOT NULL,
  `tax` decimal(19,2) DEFAULT NULL,
  `payment` decimal(19,2) DEFAULT NULL,
  `due_amount` decimal(19,2) NOT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cur_code` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`invoice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tt_invoices`
--

LOCK TABLES `tt_invoices` WRITE;
/*!40000 ALTER TABLE `tt_invoices` DISABLE KEYS */;
/*!40000 ALTER TABLE `tt_invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tt_users`
--

DROP TABLE IF EXISTS `tt_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tt_users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `role_id` int NOT NULL,
  `email` varchar(256) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `address` varchar(400) NOT NULL,
  `country` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `zip_code` varchar(10) NOT NULL,
  `remember_token` text,
  `email_verified_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tt_users`
--

LOCK TABLES `tt_users` WRITE;
/*!40000 ALTER TABLE `tt_users` DISABLE KEYS */;
INSERT INTO `tt_users` VALUES (1,'Discovery Designs',1,NULL,NULL,'41 St Vincent Place','Scotland','Glasglow','G1 2ER',NULL,NULL,'2023-03-02 09:28:16','2023-03-02 09:28:16'),(2,'Barrington Publishers',2,NULL,NULL,'17 Great Suffolk Street','United Kingdom','London','SE1 0NS',NULL,NULL,'2023-03-02 09:28:16','2023-03-02 09:28:16');
/*!40000 ALTER TABLE `tt_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'invoiceapp'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-03-02 13:45:05
