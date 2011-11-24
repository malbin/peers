-- MySQL dump 10.13  Distrib 5.5.16, for Linux (i686)
--
-- Host: 1.1.0.16    Database: pr
-- ------------------------------------------------------
-- Server version	5.1.52-log

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
-- Table structure for table `auth_codes`
--

DROP TABLE IF EXISTS `auth_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_codes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` enum('accepted','pending') NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `status_INDEX` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_codes`
--

LOCK TABLES `auth_codes` WRITE;
/*!40000 ALTER TABLE `auth_codes` DISABLE KEYS */;
INSERT INTO `auth_codes` VALUES (1,2,'3146','2011-11-02 15:51:48','2011-11-02 15:55:54','accepted'),(2,3,'8848','2011-11-02 16:00:17','2011-11-02 16:02:48','accepted'),(3,4,'2052','2011-11-02 16:22:46','2011-11-02 16:22:46','pending'),(4,5,'1290','2011-11-02 17:40:44','2011-11-02 17:45:33','accepted'),(6,7,'1192','2011-11-02 18:56:57','2011-11-02 18:56:57','pending'),(7,8,'4596','2011-11-02 19:32:13','2011-11-02 19:41:19','accepted'),(8,9,'1675','2011-11-02 21:39:52','2011-11-02 21:44:34','accepted'),(9,10,'3463','2011-11-02 21:45:57','2011-11-02 21:46:37','accepted'),(11,12,'6937','2011-11-03 20:43:31','2011-11-03 20:43:47','accepted'),(12,13,'5497','2011-11-04 13:18:23','2011-11-04 13:19:23','accepted'),(13,14,'5480','2011-11-04 13:48:32','2011-11-04 13:48:52','accepted'),(14,15,'7656','2011-11-04 16:30:29','2011-11-04 16:31:30','accepted');
/*!40000 ALTER TABLE `auth_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `board_invitations`
--

DROP TABLE IF EXISTS `board_invitations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `board_invitations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `inviter_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `board_id` int(10) unsigned NOT NULL,
  `status` enum('accepted','rejected','pending') NOT NULL DEFAULT 'pending',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `status_INDEX` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `board_invitations`
--

LOCK TABLES `board_invitations` WRITE;
/*!40000 ALTER TABLE `board_invitations` DISABLE KEYS */;
INSERT INTO `board_invitations` VALUES (1,5,5,2,'accepted','2011-11-04 13:20:49','2011-11-04 13:20:56'),(2,5,8,2,'pending','2011-11-04 13:20:49','2011-11-04 13:20:49'),(3,5,10,2,'pending','2011-11-04 13:20:49','2011-11-04 13:20:49'),(4,5,13,2,'pending','2011-11-04 13:20:49','2011-11-04 13:20:49'),(5,1,14,3,'pending','2011-11-04 13:53:58','2011-11-04 13:53:58'),(6,5,15,3,'pending','2011-11-04 17:10:25','2011-11-04 17:10:25');
/*!40000 ALTER TABLE `board_invitations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `board_notifications`
--

DROP TABLE IF EXISTS `board_notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `board_notifications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `board_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `cause` enum('job_changed','compensation_changed','user_joined','user_left') NOT NULL,
  `status` enum('pending','sent') NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `status_INDEX` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `board_notifications`
--

LOCK TABLES `board_notifications` WRITE;
/*!40000 ALTER TABLE `board_notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `board_notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `board_updates`
--

DROP TABLE IF EXISTS `board_updates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `board_updates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `board_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `last_viewed` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `board_user_UNIQUE` (`board_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `board_updates`
--

LOCK TABLES `board_updates` WRITE;
/*!40000 ALTER TABLE `board_updates` DISABLE KEYS */;
/*!40000 ALTER TABLE `board_updates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `boards`
--

DROP TABLE IF EXISTS `boards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `boards` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `expiry_date` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `boards`
--

LOCK TABLES `boards` WRITE;
/*!40000 ALTER TABLE `boards` DISABLE KEYS */;
INSERT INTO `boards` VALUES (1,NULL,11,'Test','2011-11-08 01:04:38','2011-11-03 01:04:38','2011-11-03 01:53:01'),(2,NULL,5,'First Board','2011-11-09 13:20:49','2011-11-04 13:20:49','2011-11-04 13:20:49'),(3,NULL,1,'Everyone','2011-11-09 13:31:14','2011-11-04 13:31:14','2011-11-04 13:31:14');
/*!40000 ALTER TABLE `boards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compensations`
--

DROP TABLE IF EXISTS `compensations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compensations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `job_id` int(10) unsigned NOT NULL,
  `currency` varchar(10) NOT NULL,
  `cash` float(10,2) NOT NULL DEFAULT '0.00',
  `type` enum('Signing','Performance','Severance','Other') NOT NULL DEFAULT 'Other',
  `deferred` float(10,2) NOT NULL DEFAULT '0.00',
  `award_date` datetime NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compensations`
--

LOCK TABLES `compensations` WRITE;
/*!40000 ALTER TABLE `compensations` DISABLE KEYS */;
INSERT INTO `compensations` VALUES (1,1,'USD',2000.00,'Performance',0.00,'2011-11-02 00:00:00','2011-11-02 15:56:47','2011-11-02 15:56:47'),(3,4,'USD',1.00,'Signing',0.00,'2011-11-30 00:00:00','2011-11-03 16:44:06','2011-11-03 16:44:06'),(7,14,'USD',10000.00,'Performance',0.00,'2020-06-01 00:00:00','2011-11-03 20:46:18','2011-11-03 20:46:18'),(8,17,'USD',0.00,'Other',300000.00,'2011-11-01 00:00:00','2011-11-04 16:32:16','2011-11-04 16:32:16');
/*!40000 ALTER TABLE `compensations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configs`
--

DROP TABLE IF EXISTS `configs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configs` (
  `key` varchar(100) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`key`),
  UNIQUE KEY `key_UNIQUE` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configs`
--

LOCK TABLES `configs` WRITE;
/*!40000 ALTER TABLE `configs` DISABLE KEYS */;
INSERT INTO `configs` VALUES ('App.BoardExpiryInDays','5','2011-11-02 21:17:46'),('App.Email','Peers and Rivals <no_reply@peersandrivals.com>','2011-11-02 21:17:46'),('App.FemaleDemoBoardId','0','2011-11-02 21:17:46'),('App.MaleDemoBoardId','0','2011-11-02 21:17:46'),('App.MinBoardMembers','5','2011-11-02 21:17:46'),('App.RequestInviteDelayInSeconds','7200','2011-11-02 21:17:46'),('App.SignupWithCode','0','2011-11-02 21:17:46');
/*!40000 ALTER TABLE `configs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `sms` tinyint(1) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '999',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'United States',1,1),(2,'Canada',0,2),(3,'United Kingdom',0,3),(4,'Austria',0,999),(5,'Belgium',0,999),(6,'Cyprus',0,999),(7,'Estonia',0,999),(8,'Finland',0,999),(9,'France',0,999),(10,'Germany',0,999),(11,'Greece',0,999),(12,'Ireland',0,999),(13,'Italy',0,999),(14,'Luxembourg',0,999),(15,'Malta',0,999),(16,'Netherlands',0,999),(17,'Portugal',0,999),(18,'Slovakia',0,999),(19,'Slovenia',0,999),(20,'Spain',0,999);
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employers`
--

DROP TABLE IF EXISTS `employers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name_INDEX` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employers`
--

LOCK TABLES `employers` WRITE;
/*!40000 ALTER TABLE `employers` DISABLE KEYS */;
INSERT INTO `employers` VALUES (1,'Peers and Rivals','2011-11-02 15:51:47','2011-11-02 15:51:47'),(2,'Acme Inc.','2011-11-02 17:49:00','2011-11-02 17:49:00'),(3,'Fueled','2011-11-02 18:56:56','2011-11-02 18:56:56'),(4,'Opco','2011-11-03 01:03:48','2011-11-03 01:03:48'),(5,'Graham Allen Partners','2011-11-03 20:43:31','2011-11-03 20:43:31'),(6,'gem','2011-11-04 13:48:32','2011-11-04 13:48:32');
/*!40000 ALTER TABLE `employers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exchange_rates`
--

DROP TABLE IF EXISTS `exchange_rates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exchange_rates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `currency_code` varchar(11) NOT NULL,
  `value_usd` float(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `currency_code` (`currency_code`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exchange_rates`
--

LOCK TABLES `exchange_rates` WRITE;
/*!40000 ALTER TABLE `exchange_rates` DISABLE KEYS */;
INSERT INTO `exchange_rates` VALUES (1,'USD',1.00),(2,'CAD',1.01),(3,'GBP',0.64),(4,'EUR',0.72);
/*!40000 ALTER TABLE `exchange_rates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `employer_id` int(10) unsigned NOT NULL,
  `country_id` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `salary` float(10,2) NOT NULL,
  `currency` enum('USD','GBP','EUR','CAD') NOT NULL DEFAULT 'USD' COMMENT 'USD, GBP, EUR, PLN...',
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(45) NOT NULL,
  `zip_code` varchar(45) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
INSERT INTO `jobs` VALUES (1,2,1,1,'Techie','',84000.00,'USD','2011-03-01','0000-00-00','','New York','New York','10011','2011-11-02 15:51:47','2011-11-02 15:51:47'),(2,3,1,1,'Techie','',25000.00,'USD','2011-11-02','0000-00-00','','New York','New York','10011','2011-11-02 16:00:16','2011-11-02 16:00:16'),(3,4,1,1,'Techie','',25000.00,'USD','2011-11-02','0000-00-00','','New York','New York','10011','2011-11-02 16:22:45','2011-11-02 16:22:45'),(4,5,1,1,'Techie','',84000.00,'USD','2011-02-28','0000-00-00','','New York','New York','10011','2011-11-02 17:40:44','2011-11-02 17:40:44'),(5,6,2,1,'Tester','',10000.00,'USD','2011-11-01','0000-00-00','','Luxemburg','IA','52056','2011-11-02 17:49:00','2011-11-02 17:49:00'),(6,7,3,1,'Developer','',10000.00,'USD','2011-11-10','0000-00-00','','Bangalore','Karnataka','560071','2011-11-02 18:56:56','2011-11-02 18:56:56'),(8,1,1,1,'New Job','',25555.00,'USD','2008-12-17','0000-00-00','','New York','New York','10011','2011-11-02 19:18:33','2011-11-02 19:18:33'),(9,8,1,1,'Techie','',25000.00,'USD','2011-11-02','0000-00-00','','New York','New York','10011','2011-11-02 19:32:13','2011-11-02 19:32:13'),(10,9,2,1,'Tester','',10000.00,'USD','2011-11-01','0000-00-00','','Luxemburg','IA','52056','2011-11-02 21:39:52','2011-11-02 21:39:52'),(11,10,1,1,'test','',25000.00,'USD','2011-11-02','0000-00-00','','New York','New York','10011','2011-11-02 21:45:57','2011-11-02 21:45:57'),(14,12,5,1,'Associate','',83000.00,'USD','2020-06-01','0000-00-00','','South Bend','Indiana','46617','2011-11-03 20:45:19','2011-11-03 20:45:19'),(15,13,1,1,'Techie','',25000.00,'USD','2011-11-04','0000-00-00','','New York','New York','10011','2011-11-04 13:18:22','2011-11-04 13:18:22'),(16,14,6,1,'ceo','',300000.00,'USD','2011-11-04','0000-00-00','','New York','NY','10011','2011-11-04 13:48:32','2011-11-04 13:48:32'),(17,15,1,1,'Founder','',0.00,'USD','2011-05-16','0000-00-00','','New York','NY','10016','2011-11-04 16:30:29','2011-11-04 16:30:29');
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `networks`
--

DROP TABLE IF EXISTS `networks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `networks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `name_UNIQUE` (`user_id`,`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `networks`
--

LOCK TABLES `networks` WRITE;
/*!40000 ALTER TABLE `networks` DISABLE KEYS */;
INSERT INTO `networks` VALUES (1,2,'Admin','2011-11-02 16:14:26','2011-11-02 16:15:23');
/*!40000 ALTER TABLE `networks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reset_codes`
--

DROP TABLE IF EXISTS `reset_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reset_codes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code_UNIQUE` (`code`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reset_codes`
--

LOCK TABLES `reset_codes` WRITE;
/*!40000 ALTER TABLE `reset_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `reset_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL DEFAULT '',
  `data` text,
  `expires` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('0k8ad94p1u2q44cbraua2mmj44','',1320761631),('2bggeq1j1qgu7rhqq8vev649p3','Config|a:3:{s:9:\"userAgent\";s:32:\"bae1bec991bf5709e271a52b1a9a0537\";s:4:\"time\";i:1320784357;s:7:\"timeout\";i:10;}user_id|s:2:\"15\";Message|a:1:{s:5:\"flash\";a:3:{s:7:\"message\";s:18:\"Compensation saved\";s:7:\"element\";s:7:\"default\";s:6:\"params\";a:0:{}}}',1320784358),('2ch23s50pogvrvdh6f2u0khge4','Config|a:3:{s:9:\"userAgent\";s:32:\"b80b435f36fde0694681c1c808806cf0\";s:4:\"time\";i:1320629966;s:7:\"timeout\";i:10;}',1320629967),('2heuo1cst5r5ee0ubasigj9h85','Config|a:3:{s:9:\"userAgent\";s:32:\"49feb5594db130274e470094cd1f3a56\";s:4:\"time\";i:1320745367;s:7:\"timeout\";i:10;}',1320745368),('39u81v7ju09cqilpjphumvd280','Config|a:3:{s:9:\"userAgent\";s:32:\"bae1bec991bf5709e271a52b1a9a0537\";s:4:\"time\";i:1320781751;s:7:\"timeout\";i:10;}Message|a:1:{s:5:\"flash\";a:3:{s:7:\"message\";s:27:\"Incorect login or password.\";s:7:\"element\";s:7:\"default\";s:6:\"params\";a:0:{}}}',1320781752),('4qri6b79td4v93nqt318brs9c3','',1320720676),('4v15e6br7jursb63cvn9thiqu4','Config|a:3:{s:9:\"userAgent\";s:32:\"852c8a351ceb6e947e474a1e7082a3b7\";s:4:\"time\";i:1320761631;s:7:\"timeout\";i:10;}',1320761631),('5q7a9rfl4rst7qicec7oseo6q5','Config|a:3:{s:9:\"userAgent\";s:32:\"e68dc43e206742cd1fc8d4a4beff93f0\";s:4:\"time\";i:1320647329;s:7:\"timeout\";i:10;}',1320647332),('6rfpluampt23ep2tp3fivrf6b3','Config|a:3:{s:9:\"userAgent\";s:32:\"c52cd19728571c0b342b2150d93f5c0b\";s:4:\"time\";i:1320705254;s:7:\"timeout\";i:10;}Message|a:1:{s:5:\"flash\";a:3:{s:7:\"message\";s:27:\"Incorect login or password.\";s:7:\"element\";s:7:\"default\";s:6:\"params\";a:0:{}}}',1320705254),('7rs475tdf1a36vc81a1jhb9pi6','Config|a:3:{s:9:\"userAgent\";s:32:\"c52cd19728571c0b342b2150d93f5c0b\";s:4:\"time\";i:1320774714;s:7:\"timeout\";i:10;}user_id|s:2:\"14\";',1320774720),('8g31gafq5tddrqmr3pvj3ouae6','Config|a:3:{s:9:\"userAgent\";s:32:\"852c8a351ceb6e947e474a1e7082a3b7\";s:4:\"time\";i:1320609796;s:7:\"timeout\";i:10;}',1320609796),('8gfedied37akjpi4835s2glfp6','',1320737404),('9irmgr0its4vp3grd8l80i9om3','Config|a:3:{s:9:\"userAgent\";s:32:\"5cdf2187324032a99427ef4e6f8339bc\";s:4:\"time\";i:1320792370;s:7:\"timeout\";i:10;}user_id|s:1:\"1\";Message|a:0:{}',1320792371),('af45b60mk96u0b502ntbnavhk2','Config|a:3:{s:9:\"userAgent\";s:32:\"66e69dba5eb939520982c11611796f10\";s:4:\"time\";i:1320617097;s:7:\"timeout\";i:10;}',1320617097),('bpuf5adg372ncas5fntduvuek4','',1320609796),('d4orqi3n5fii6c4fks676mg002','Config|a:3:{s:9:\"userAgent\";s:32:\"66e69dba5eb939520982c11611796f10\";s:4:\"time\";i:1320713210;s:7:\"timeout\";i:10;}user_id|s:2:\"12\";Message|a:1:{s:5:\"flash\";a:3:{s:7:\"message\";s:18:\"Compensation saved\";s:7:\"element\";s:7:\"default\";s:6:\"params\";a:0:{}}}',1320713210),('emcj6sh328251auefoq3um9ff7','Config|a:3:{s:9:\"userAgent\";s:32:\"852c8a351ceb6e947e474a1e7082a3b7\";s:4:\"time\";i:1320676179;s:7:\"timeout\";i:10;}',1320676179),('f7l3uvnucmaf68mn2bcescpd13','Config|a:3:{s:9:\"userAgent\";s:0:\"\";s:4:\"time\";i:1320610799;s:7:\"timeout\";i:10;}',1320610800),('fkdn9hb9l29ktgs5a9p6kesih2','Config|a:3:{s:9:\"userAgent\";s:32:\"49feb5594db130274e470094cd1f3a56\";s:4:\"time\";i:1320737404;s:7:\"timeout\";i:10;}',1320737405),('gq93r0vdv34n8loau5igmi24e6','Config|a:3:{s:9:\"userAgent\";s:32:\"afe3d55454560fc1617233528fb8bfc2\";s:4:\"time\";i:1320786578;s:7:\"timeout\";i:10;}',1320786579),('h4lm47gt70volbv822upsp4jv4','Config|a:3:{s:9:\"userAgent\";s:32:\"ccc0466f534f8f0b3bb9974556664135\";s:4:\"time\";i:1320612695;s:7:\"timeout\";i:10;}',1320612696),('h7bs3palfg2mhm6819cho01no0','Config|a:3:{s:9:\"userAgent\";s:32:\"66e69dba5eb939520982c11611796f10\";s:4:\"time\";i:1320621078;s:7:\"timeout\";i:10;}user_id|s:1:\"7\";',1320621079),('h7r9f20uj589ftd4iiphhmr9h2','Config|a:3:{s:9:\"userAgent\";s:32:\"0fdd4c17cfc4c390d23302d0caf3446b\";s:4:\"time\";i:1320630279;s:7:\"timeout\";i:10;}',1320630280),('ibo9klivmdcn763531mcpj5cv6','Config|a:3:{s:9:\"userAgent\";s:32:\"60de7a17d9f58e094f91026268860b6a\";s:4:\"time\";i:1320636358;s:7:\"timeout\";i:10;}',1320636359),('ikfip3ci5vi1mhu69g8le3ls64','Config|a:3:{s:9:\"userAgent\";s:0:\"\";s:4:\"time\";i:1320753263;s:7:\"timeout\";i:10;}',1320753263),('jhgjcjnuk89p32oo9a42o628m6','',1320782839),('jjhddq8e0n20cuau7i0rpbvph5','',1320676179),('jpb8ha21cjnpg1cuaku54et1p0','Config|a:3:{s:9:\"userAgent\";s:0:\"\";s:4:\"time\";i:1320609785;s:7:\"timeout\";i:10;}',1320609786),('kjd87f8k0ao7pqebiiv53vjdf7','Config|a:3:{s:9:\"userAgent\";s:32:\"70f9e30ca26df8fc8533fef5965ca645\";s:4:\"time\";i:1320782006;s:7:\"timeout\";i:10;}Message|a:1:{s:5:\"flash\";a:3:{s:7:\"message\";s:30:\"The site invite has been saved\";s:7:\"element\";s:7:\"default\";s:6:\"params\";a:0:{}}}',1320782006),('m0fko8j7gobs64eqhrrkm9gv66','Config|a:3:{s:9:\"userAgent\";s:32:\"b1d6c6eb2c36b2528b76c2fdb78c82e9\";s:4:\"time\";i:1320717171;s:7:\"timeout\";i:10;}Message|a:1:{s:5:\"flash\";a:3:{s:7:\"message\";s:27:\"Incorect login or password.\";s:7:\"element\";s:7:\"default\";s:6:\"params\";a:0:{}}}',1320717172),('n9qetkhbdkd2anu1m3amedtb94','Config|a:3:{s:9:\"userAgent\";s:32:\"e8950cb911849e024e901f0bec705ec4\";s:4:\"time\";i:1320616252;s:7:\"timeout\";i:10;}Message|a:1:{s:5:\"flash\";a:3:{s:7:\"message\";s:30:\"The site invite has been saved\";s:7:\"element\";s:7:\"default\";s:6:\"params\";a:0:{}}}',1320616252),('nne98jotjlcnjlaqhdpfm60vu3','Config|a:3:{s:9:\"userAgent\";s:32:\"6f5e8fe43a0785a90388f5f4951b65cb\";s:4:\"time\";i:1320742221;s:7:\"timeout\";i:10;}',1320742221),('ocgi4sklt4n0rp5ongpkg27p14','Config|a:3:{s:9:\"userAgent\";s:32:\"0fdd4c17cfc4c390d23302d0caf3446b\";s:4:\"time\";i:1320628623;s:7:\"timeout\";i:10;}user_id|s:1:\"6\";',1320628623),('omj1n8qgeladup1n5ft0rfg6s4','Config|a:3:{s:9:\"userAgent\";s:32:\"0fdd4c17cfc4c390d23302d0caf3446b\";s:4:\"time\";i:1320628803;s:7:\"timeout\";i:10;}Message|a:1:{s:5:\"flash\";a:3:{s:7:\"message\";s:30:\"The site invite has been saved\";s:7:\"element\";s:7:\"default\";s:6:\"params\";a:0:{}}}',1320628803),('picqq5n5abc48qjdp1a857fs55','Config|a:3:{s:9:\"userAgent\";s:0:\"\";s:4:\"time\";i:1320615199;s:7:\"timeout\";i:10;}',1320615199),('rriupshaknhvoakdlffhotj985','Config|a:3:{s:9:\"userAgent\";s:32:\"49feb5594db130274e470094cd1f3a56\";s:4:\"time\";i:1320737405;s:7:\"timeout\";i:10;}',1320737406),('sfecf951r93r9dn41corj2glt5','Config|a:3:{s:9:\"userAgent\";s:32:\"66e69dba5eb939520982c11611796f10\";s:4:\"time\";i:1320617474;s:7:\"timeout\";i:10;}',1320617474),('t6sjeqkqapd2q3kss4ijctaj84','Config|a:3:{s:9:\"userAgent\";s:0:\"\";s:4:\"time\";i:1320609549;s:7:\"timeout\";i:10;}',1320609549),('tpub5o5pro50va06lh7vsvjki0','Config|a:3:{s:9:\"userAgent\";s:32:\"b80b435f36fde0694681c1c808806cf0\";s:4:\"time\";i:1320649669;s:7:\"timeout\";i:10;}',1320649670),('trtojck0mtiul91u0mjg47p297','Config|a:3:{s:9:\"userAgent\";s:32:\"e8950cb911849e024e901f0bec705ec4\";s:4:\"time\";i:1320616682;s:7:\"timeout\";i:10;}Message|a:1:{s:5:\"flash\";a:3:{s:7:\"message\";s:30:\"The site invite has been saved\";s:7:\"element\";s:7:\"default\";s:6:\"params\";a:0:{}}}',1320616682),('v4kg0muecs8kbkgvu4fpi1rtd3','Config|a:3:{s:9:\"userAgent\";s:32:\"afe3d55454560fc1617233528fb8bfc2\";s:4:\"time\";i:1320788958;s:7:\"timeout\";i:10;}user_id|s:1:\"1\";',1320788960),('vdc9sl0qhkejrsfmv6nuouun02','Config|a:3:{s:9:\"userAgent\";s:32:\"59b1db7c57e9c66e6303ce9e4f6bac11\";s:4:\"time\";i:1320645208;s:7:\"timeout\";i:10;}',1320645208);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_invites`
--

DROP TABLE IF EXISTS `site_invites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `site_invites` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `country_id` int(10) unsigned NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `scheduled_time` datetime DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `status` enum('accepted','expired','sent','pending') NOT NULL DEFAULT 'pending',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `code_UNIQUE` (`code`),
  KEY `email_INDEX` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_invites`
--

LOCK TABLES `site_invites` WRITE;
/*!40000 ALTER TABLE `site_invites` DISABLE KEYS */;
INSERT INTO `site_invites` VALUES (2,1,'jmalbin@peersandrivals.com','Jaryd Malbin','b96e902ad180a67fd5b63af94bbcf3f6','2011-11-02 17:38:28',NULL,'sent','2011-11-02 15:38:27','2011-11-04 17:47:25'),(3,1,'jmalbin@peersandrivals.com','jaryd','ec04d9d4b868721c2399733391ebc2fd',NULL,2,'accepted','2011-11-02 15:58:11','2011-11-02 16:00:17'),(4,1,'quinn@fueled.com','ryan','02ec175e8ef34798bcdc0bbcb719fd0a',NULL,3,'sent','2011-11-02 16:02:57','2011-11-02 16:03:06'),(5,1,'jmalbin@peersandrivals.com','aryd','5795fcb349bb5f5fb1be0551d21fcbba',NULL,2,'sent','2011-11-02 16:19:45','2011-11-02 16:19:59'),(6,1,'jm@jaryd.org','jm','a741ad23594d3a84fcbefd96fa68940d',NULL,2,'accepted','2011-11-02 16:19:56','2011-11-02 16:22:46'),(7,1,'jmalbin@peersandrivals.com','jaryd','5a28e61ed35e89ee3d4e3732b64dad1b',NULL,2,'sent','2011-11-02 17:33:07','2011-11-02 17:33:19'),(8,1,'jmalbin@peersandrivals.com','jaryd','1aa880f1daa29319c12c0faaac3e2fba','2011-11-02 19:34:41',NULL,'accepted','2011-11-02 17:34:41','2011-11-02 17:40:44'),(10,1,'info@hammerandsteele.com','Mike','328ee9929ee5e023050d502ba5ab6792','2011-11-02 19:50:52',NULL,'pending','2011-11-02 17:50:52','2011-11-02 17:50:52'),(11,1,'quinn@fueled.com','Test user','debe45ee26b478e0f0e0cd0b18745a3a','2011-11-02 19:58:02',NULL,'accepted','2011-11-02 17:58:02','2011-11-02 18:56:57'),(12,1,'jmalbin@peersandrivals.com','jaryd','86bc877577a932fd742e051f2c8c5126','2011-11-02 21:30:44',NULL,'accepted','2011-11-02 19:30:44','2011-11-02 19:32:14'),(13,1,'jmalbin@peersandrivals.com','jmalbin@peersandrivals.com','14ea74de8139c60ea3c772e8a74d0e47','2011-11-02 21:41:33',NULL,'sent','2011-11-02 19:41:33','2011-11-02 21:44:01'),(14,1,'ryanpq@gmail.com','Ryan Quinn','7371342192f6214654455628a9cc369a','2011-11-02 23:20:03',NULL,'sent','2011-11-02 21:20:03','2011-11-02 21:21:28'),(15,1,'jmalbin@peersandrivals.com','Jaryd','3deaa0156c9d2c0c3c104a910973a907','2011-11-02 23:42:56',NULL,'pending','2011-11-02 21:42:56','2011-11-02 21:42:56'),(16,1,'gm@gmail.com','d j asdflkjl','6a161348425b9e8057dfad5bc4f7da5c','2011-11-03 17:38:24',NULL,'pending','2011-11-03 15:38:24','2011-11-03 15:38:24'),(17,1,'jaryd@jaryd.org','Jaryd','d0743600d8a50802b4a52907266a4ef9','2011-11-03 17:40:16',NULL,'pending','2011-11-03 15:40:16','2011-11-03 15:40:16'),(18,1,'jaryd@jaryd.org','Jaryd','9233e7c81754453382406ee0a170b5e2','2011-11-03 17:40:55',NULL,'pending','2011-11-03 15:40:55','2011-11-03 15:40:55'),(19,1,'jm@jaryd.org','JAryd','147b3aa2b21829b13a86d0329d1c865f','2011-11-03 17:42:09',NULL,'pending','2011-11-03 15:42:09','2011-11-03 15:42:09'),(20,1,'pkbanks@pk.pk','P.K. ','90fead4fbf9a41280a1efa76dff32a45','2011-11-03 18:01:25',NULL,'pending','2011-11-03 16:01:25','2011-11-03 16:01:25'),(21,1,'pkbanks@pk.pk','P       K       R','dd9ca707a3f9faa2a54d904024e28c2e','2011-11-03 18:01:59',NULL,'pending','2011-11-03 16:01:59','2011-11-03 16:01:59'),(22,1,'jmalbin@peersandrivals.com','jaryd','854f3d44bd28d0de7b31e5370bdfade2',NULL,1,'sent','2011-11-04 13:17:15','2011-11-04 18:42:37'),(23,1,'eric@gem-llc.com','Eric Horwitz','a1a49a66c0d24d71da4bae021650708c',NULL,13,'sent','2011-11-04 13:20:01','2011-11-04 13:35:53'),(24,1,'pkbanks@peersandrivals.com','PK Banks','8bde30aadcc3b16c98db91a5d3a84523',NULL,13,'sent','2011-11-04 13:20:09','2011-11-04 13:21:38'),(25,0,'omar.dione@gmail.com','omar dione','7f097994aaeb6fc6348cb01551df1600','2011-11-04 17:53:26',NULL,'pending','2011-11-04 15:53:26','2011-11-04 15:53:26');
/*!40000 ALTER TABLE `site_invites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(10) unsigned NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `birthdate` date NOT NULL,
  `gender` enum('Male','Female') NOT NULL DEFAULT 'Male',
  `language` enum('English') NOT NULL DEFAULT 'English',
  `currency` enum('USD','GBP','EUR') NOT NULL DEFAULT 'USD',
  `phone` varchar(255) NOT NULL,
  `phone_carrier` varchar(45) NOT NULL,
  `status` enum('active','inactive','banned') NOT NULL DEFAULT 'inactive',
  `searchable` tinyint(1) NOT NULL DEFAULT '1',
  `last_employer_name` varchar(255) DEFAULT NULL,
  `last_job_title` varchar(255) DEFAULT NULL,
  `last_logged_in` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `phone_UNIQUE` (`phone`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `email_INDEX` (`email`),
  KEY `password_INDEX` (`password`),
  KEY `status_INDEX` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,2,'admin@peersandrivals.fake','94b0aa40d599d2befd2fc975ca1396a1','Gall','Anonym','1991-01-01','Male','English','USD','11000000000','verizon','active',0,'Peers and Rivals','New Job','2011-11-04 18:46:08','2011-07-20 17:23:46','2011-11-04 18:46:08'),(5,1,'jmalbin@peersandrivals.com','94b0aa40d599d2befd2fc975ca1396a1','Jaryd','Malbin','1985-01-01','Male','English','USD','2039848330','att','active',1,'Peers and Rivals','Techie','2011-11-04 17:10:25','2011-11-02 17:40:44','2011-11-04 17:10:25'),(7,1,'testuser@test.com','5ee8a4827b0f0eecabf677a070e071b9','Test','User','1985-01-01','Male','English','USD','1231232132','att','inactive',1,'Fueled','Developer',NULL,'2011-11-02 18:56:56','2011-11-02 18:56:57'),(8,1,'jj@jaryd.org','94b0aa40d599d2befd2fc975ca1396a1','Jaryd','Malbin','1993-01-01','Male','English','USD','2224243242','att','active',1,'Peers and Rivals','Techie','2011-11-02 19:41:20','2011-11-02 19:32:13','2011-11-02 19:41:20'),(9,1,'ryanpq@gmail.com','afa30e87625fbccae932590e05fd81bc','Ryan','Quinn','1977-01-01','Male','English','USD','5632108632','att','active',1,'Acme Inc.','Tester','2011-11-02 21:44:35','2011-11-02 21:39:52','2011-11-02 21:44:35'),(10,1,'jmalbi2n@peersandrivals.com','94b0aa40d599d2befd2fc975ca1396a1','Jaryd','Malbin','1993-01-01','Male','English','USD','2222222222','att','active',1,'Peers and Rivals','test','2011-11-02 22:09:10','2011-11-02 21:45:57','2011-11-02 22:09:10'),(12,1,'brendan.condon@gmail.com','a67faa2a774817065bd84d7ad4606bd0','Brendan','Condon','1981-01-01','Male','English','USD','6317422838','att','active',1,'Graham Allen Partners','Associate','2011-11-03 20:46:49','2011-11-03 20:43:31','2011-11-03 20:46:49'),(13,1,'jm@jaryd.org','94b0aa40d599d2befd2fc975ca1396a1','Jaryd','Malbin','1985-01-01','Male','English','USD','2442442424','att','active',1,'Peers and Rivals','Techie','2011-11-04 13:20:14','2011-11-04 13:18:22','2011-11-04 13:20:14'),(14,1,'Eric@gem-llc.com','bcdbbb332fd797d9d127a0afa60783ce','Eric','horwitz','1978-01-01','Male','English','USD','9175751878','att','active',1,'gem','ceo','2011-11-04 13:51:45','2011-11-04 13:48:32','2011-11-04 13:51:45'),(15,1,'pkbanks@peersandrivals.com','fd86f8353dff94e3ac01cda3db6afff0','PK','BANKS','1978-01-01','Male','English','USD','2152921186','att','active',1,'Peers and Rivals','Founder','2011-11-04 16:32:37','2011-11-04 16:30:29','2011-11-04 16:32:37');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_boards`
--

DROP TABLE IF EXISTS `users_boards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_boards` (
  `user_id` int(10) unsigned NOT NULL,
  `board_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`board_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_boards`
--

LOCK TABLES `users_boards` WRITE;
/*!40000 ALTER TABLE `users_boards` DISABLE KEYS */;
INSERT INTO `users_boards` VALUES (1,3),(5,2),(5,3),(7,3),(8,3),(9,3),(10,3),(13,3);
/*!40000 ALTER TABLE `users_boards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_networks`
--

DROP TABLE IF EXISTS `users_networks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_networks` (
  `user_id` int(10) unsigned NOT NULL,
  `network_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`network_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_networks`
--

LOCK TABLES `users_networks` WRITE;
/*!40000 ALTER TABLE `users_networks` DISABLE KEYS */;
INSERT INTO `users_networks` VALUES (1,1),(2,1);
/*!40000 ALTER TABLE `users_networks` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2011-11-04 15:47:38
