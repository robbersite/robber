-- MySQL dump 10.13  Distrib 5.5.47, for Win32 (x86)
--
-- Host: localhost    Database: robber
-- ------------------------------------------------------
-- Server version	5.5.47

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
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'robber','605159011@qq.com','$2y$10$cLVlsdl.sE7ZaFUPdxHDx.Hj.ZlfqjsICF7aLE7gSVAvIw07..on.','0Emk0XiHIosmLZWJja9y7aoXAOXFDiCbndmlrtbIBRo1jftW9crzFgXSmday',NULL,'2016-12-05 07:49:47');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_baikes`
--

DROP TABLE IF EXISTS `item_baikes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item_baikes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `thumb` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '/images/default.png',
  `website_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_baikes_website_id_foreign` (`website_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_baikes`
--

LOCK TABLES `item_baikes` WRITE;
/*!40000 ALTER TABLE `item_baikes` DISABLE KEYS */;
INSERT INTO `item_baikes` VALUES (1,'1','1','/upload/images/34bb58e272f01eb43a9f36c875fb3e82.gif',10,NULL,NULL),(2,'1','1','/images/default.png',11,NULL,NULL);
/*!40000 ALTER TABLE `item_baikes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_guanwangs`
--

DROP TABLE IF EXISTS `item_guanwangs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item_guanwangs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `thumb` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '/images/default.png',
  `website_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_guanwangs_website_id_foreign` (`website_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_guanwangs`
--

LOCK TABLES `item_guanwangs` WRITE;
/*!40000 ALTER TABLE `item_guanwangs` DISABLE KEYS */;
INSERT INTO `item_guanwangs` VALUES (1,'1','1','/images/default.png',10,NULL,NULL),(2,'1','1','/images/default.png',11,NULL,NULL);
/*!40000 ALTER TABLE `item_guanwangs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_kefus`
--

DROP TABLE IF EXISTS `item_kefus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item_kefus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `website_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_kefus_website_id_foreign` (`website_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_kefus`
--

LOCK TABLES `item_kefus` WRITE;
/*!40000 ALTER TABLE `item_kefus` DISABLE KEYS */;
INSERT INTO `item_kefus` VALUES (1,'11','1',10,NULL,NULL),(2,'1','1',11,NULL,NULL);
/*!40000 ALTER TABLE `item_kefus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_pinpais`
--

DROP TABLE IF EXISTS `item_pinpais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item_pinpais` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `thumb` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '/images/default.png',
  `nav_top` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nav_thumb` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '/images/default.png',
  `nav_thumb_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '/images/default.png',
  `nav_bottom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `extra_thumb` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '/images/default.png',
  `extra_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `extra_list` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `website_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_pinpais_website_id_foreign` (`website_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_pinpais`
--

LOCK TABLES `item_pinpais` WRITE;
/*!40000 ALTER TABLE `item_pinpais` DISABLE KEYS */;
INSERT INTO `item_pinpais` VALUES (2,'阿三','1','/images/default.png','栏目1,栏目2,栏目3,栏目4,栏目5,栏目6','/images/default.png','/images/default.png','栏目1,栏目2,栏目3,栏目4,栏目5','/images/default.png','1','1',10,NULL,NULL),(3,'1','1','/images/default.png','栏目1,栏目2,栏目3,栏目4,栏目5,栏目6','/images/default.png','/images/default.png','栏目1,栏目2,栏目3,栏目4,栏目5','/images/default.png','1','1',11,NULL,NULL);
/*!40000 ALTER TABLE `item_pinpais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_tuiguangs`
--

DROP TABLE IF EXISTS `item_tuiguangs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item_tuiguangs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `thumb` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '/images/default.png',
  `website_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_tuiguangs_website_id_foreign` (`website_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_tuiguangs`
--

LOCK TABLES `item_tuiguangs` WRITE;
/*!40000 ALTER TABLE `item_tuiguangs` DISABLE KEYS */;
INSERT INTO `item_tuiguangs` VALUES (1,'1','1','/images/default.png',10,NULL,NULL),(2,'2','2','/images/default.png',11,NULL,NULL);
/*!40000 ALTER TABLE `item_tuiguangs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `thumb` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '/images/default.png',
  `website_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `items_website_id_foreign` (`website_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` VALUES (5,'1','2','2','/upload/images/aec972de4da971327e4452c5b4b5fda1.gif',10,NULL,NULL);
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `keywords`
--

DROP TABLE IF EXISTS `keywords`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `keywords` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `keyword_default` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `keyword_trigger` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `matching` int(11) NOT NULL,
  `website_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `keywords_website_id_foreign` (`website_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `keywords`
--

LOCK TABLES `keywords` WRITE;
/*!40000 ALTER TABLE `keywords` DISABLE KEYS */;
INSERT INTO `keywords` VALUES (2,'阿三','阿三',0,10,NULL,NULL),(3,'2','2',1,11,NULL,NULL);
/*!40000 ALTER TABLE `keywords` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2016_11_09_062923_create_admins_table',1),(4,'2016_11_14_135029_create_websites_table',1),(5,'2016_11_14_142416_create_website_orders_table',1),(6,'2016_11_15_074816_create_keywords_table',1),(7,'2016_11_16_084545_create_item_pinpais_table',1),(8,'2016_11_21_142402_create_item_tuiguangs_table',1),(9,'2016_11_22_061034_create_item_guanwangs_table',1),(10,'2016_11_22_070111_create_item_baikes_table',1),(11,'2016_11_22_074634_create_item_kefus_table',1),(12,'2016_11_22_135739_create_items_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `group_id` int(11) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'官方代理','605159011@qq.com','$2y$10$wBT49Jsv8edUDbTT8XgdA.iSgXQZRpY.urnJAaA847H8Mc5ERy7Fu',1,'wic4ZFPzcTn2IrMXn5c6JojnvFoqKiWM7MZcf4ZDQ7OYG1ABjRic8G0aDI2t','2016-12-05 01:20:52','2016-12-05 09:13:32'),(2,'普通用户','asdf@asdf.com','$2y$10$695XDcbwzj2b00nHwlOGm.jVMLMrp4SKKRrlf6pb4shPoKawYiRAe',0,'dh95me8Kq3AEHiJEnheVaD6nDTXmOIfrhHjayzVss0dIwux59xVG9rdM2rxp','2016-12-05 02:19:12','2016-12-05 02:19:41'),(3,'1','1@1.com','$2y$10$PJ04FOXWGRJXyUxUdIg1.OAZpOkGkw5Nn1VBZteU5jjZ/3kB1NTsi',0,NULL,'2016-12-05 02:26:21','2016-12-05 02:26:21'),(4,'1','1@1.com1','$2y$10$2ysbEWiFsN.kkPZM1KDwoebZlO9NHM7U5vhf.dlfPBMY83ObPXgZ.',0,NULL,'2016-12-05 02:26:41','2016-12-05 02:26:41'),(5,'默认用户','aas@asdf.comsadf','$2y$10$ie0pn4F.za8ie6dtWH1nXO0tIOkutPwuffmQsuSbka8vduBNA8O..',1,NULL,'2016-12-05 02:29:41','2016-12-05 02:29:41'),(6,'guan1','asdf@asdf.c1','$2y$10$UP10y2ozBVBr7nme69Xyi.Ej5wUT9SErlzYArYNb0yb9/tD7IuLN2',1,'lQTqCDMIuHrt2BUeTzfR2IwjWV1bmjX1b3IYIp7S741VvM6x2QkVaoTja00Z','2016-12-08 07:25:56','2016-12-05 07:33:04'),(7,'guan2','as@afs.com','$2y$10$CEKXUPn9OFQYLwObay3TXea0ZOYYSYK3cBlYa8Ipcm79V7r.uDW4a',1,'q1rnUuq6jeYlrf60W6GLDI2LlFWQkkT1pNZytgQreI5bwRY7JgjEjOKWFHZV','2016-12-05 07:33:25','2016-12-05 07:45:52'),(8,'1','1@ad.com','$2y$10$vGwubHTFHAmWx/v466x5d.TgYWb9fPAKFV4hXk/wtDg10aX3rjIdi',1,NULL,'2016-12-05 07:48:52','2016-12-05 07:48:52'),(9,'2','asf@asdf.com','$2y$10$draYKmiTqCaq28i4FYDFQ.9CmIO2VUYunhfDyYUICrvUbYHesvwNC',0,'DQYOSfnUUPtR6oSwzbJ3AwSVga9dFeYRf4iRAWerey420nqz38qWXr9Trb2V','2016-12-05 07:51:05','2016-12-05 07:52:02');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `website_orders`
--

DROP TABLE IF EXISTS `website_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `website_orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `start` int(11) NOT NULL,
  `stop` int(11) NOT NULL,
  `last` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `website_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `website_orders_website_id_foreign` (`website_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `website_orders`
--

LOCK TABLES `website_orders` WRITE;
/*!40000 ALTER TABLE `website_orders` DISABLE KEYS */;
INSERT INTO `website_orders` VALUES (2,1480933781,1481020181,'1',2,NULL,NULL),(18,1480955329,1481041729,'1',11,NULL,NULL),(17,1480953137,1481039537,'1',10,NULL,NULL),(16,1480953065,1481039465,'1',9,NULL,NULL),(9,1481210756,1481297156,'1',3,NULL,NULL),(10,1480952005,1481038405,'1',4,NULL,NULL),(11,1481038405,1481124805,'1',4,NULL,NULL),(12,1480952649,1481039049,'1',5,NULL,NULL),(13,1480952652,1481039052,'1',6,NULL,NULL);
/*!40000 ALTER TABLE `website_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `websites`
--

DROP TABLE IF EXISTS `websites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `websites` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `domain` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `websites_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `websites`
--

LOCK TABLES `websites` WRITE;
/*!40000 ALTER TABLE `websites` DISABLE KEYS */;
INSERT INTO `websites` VALUES (9,'默认站点','http://www.robber.site','qvJG2ywc9pbhb6IKg4KsNEmBMB22uIGn',9,NULL,NULL),(2,'默认站点','http://www.robber.site','Q15JjKgWqioTtFLIPlw8LMsNUU1K2e1C',5,NULL,NULL),(3,'默认站点','http://www.robber.site','Xc4Y1BYmdVYggwgjIqzI7sPjV8BxE9Fr',6,NULL,NULL),(4,'默认站点','http://www.robber.site','i1GSPnosm4Yox3pPpSoG959pRhorpGKS',7,NULL,NULL),(5,'1','1','2bbYIiIauchFhXP9RxDQjVa4yv8FkZ5o',7,NULL,NULL),(6,'2','2','unTPHUGCN4tvlh994oquv5QAPBFer3uA',7,NULL,NULL),(10,'1','1','s5CvCEuQVXSG2peFPm4Pu3Nn52abJ8bh',1,NULL,NULL),(11,'2','2','XblQahkSNdgC8XTBWh1qibB0J0eyfIEo',1,NULL,NULL);
/*!40000 ALTER TABLE `websites` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-12-06  5:38:41
