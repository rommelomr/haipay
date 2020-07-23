-- MySQL dump 10.13  Distrib 5.7.28, for Linux (x86_64)
--
-- Host: localhost    Database: hi
-- ------------------------------------------------------
-- Server version	5.7.28-0ubuntu0.19.04.2

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
-- Table structure for table `acciones`
--

DROP TABLE IF EXISTS `acciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acciones` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acciones`
--

LOCK TABLES `acciones` WRITE;
/*!40000 ALTER TABLE `acciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `acciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auditorias`
--

DROP TABLE IF EXISTS `auditorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auditorias` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` bigint(20) unsigned NOT NULL,
  `id_accion` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `auditorias_id_usuario_foreign` (`id_usuario`),
  KEY `auditorias_id_accion_foreign` (`id_accion`),
  CONSTRAINT `auditorias_id_accion_foreign` FOREIGN KEY (`id_accion`) REFERENCES `acciones` (`id`),
  CONSTRAINT `auditorias_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auditorias`
--

LOCK TABLES `auditorias` WRITE;
/*!40000 ALTER TABLE `auditorias` DISABLE KEYS */;
/*!40000 ALTER TABLE `auditorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carteras`
--

DROP TABLE IF EXISTS `carteras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carteras` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_cliente` bigint(20) unsigned NOT NULL,
  `id_hai_criptomoneda` bigint(20) unsigned NOT NULL,
  `cantidad` decimal(20,9) NOT NULL,
  `direccion` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `carteras_id_cliente_foreign` (`id_cliente`),
  KEY `carteras_id_hai_criptomoneda_foreign` (`id_hai_criptomoneda`),
  CONSTRAINT `carteras_id_cliente_foreign` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`),
  CONSTRAINT `carteras_id_hai_criptomoneda_foreign` FOREIGN KEY (`id_hai_criptomoneda`) REFERENCES `hai_criptomonedas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carteras`
--

LOCK TABLES `carteras` WRITE;
/*!40000 ALTER TABLE `carteras` DISABLE KEYS */;
INSERT INTO `carteras` VALUES (1,1,3,20.000000000,'mmmmmmmmmm111111111m','2020-07-18 02:47:57','2020-07-18 05:01:52'),(2,1,2,0.005000000,NULL,'2020-07-18 02:48:03','2020-07-18 02:48:03'),(3,1,1,200.000000000,'asdfg12345asdfg12345','2020-07-18 02:48:09','2020-07-18 03:15:22');
/*!40000 ALTER TABLE `carteras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente_video`
--

DROP TABLE IF EXISTS `cliente_video`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliente_video` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_video` bigint(20) unsigned NOT NULL,
  `id_cliente` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cliente_video_id_video_foreign` (`id_video`),
  KEY `cliente_video_id_cliente_foreign` (`id_cliente`),
  CONSTRAINT `cliente_video_id_cliente_foreign` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`),
  CONSTRAINT `cliente_video_id_video_foreign` FOREIGN KEY (`id_video`) REFERENCES `videos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente_video`
--

LOCK TABLES `cliente_video` WRITE;
/*!40000 ALTER TABLE `cliente_video` DISABLE KEYS */;
/*!40000 ALTER TABLE `cliente_video` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` bigint(20) unsigned NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `clientes_id_usuario_foreign` (`id_usuario`),
  CONSTRAINT `clientes_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,2,0,'2020-02-10 23:05:15','2020-02-10 23:05:15'),(2,3,0,'2020-02-10 23:05:33','2020-02-10 23:05:33'),(3,6,0,'2020-02-10 23:05:33','2020-02-10 23:05:33'),(4,7,0,'2020-02-10 23:05:33','2020-02-10 23:05:33'),(5,8,0,'2020-02-10 23:05:33','2020-02-10 23:05:33'),(6,9,0,'2020-02-10 23:05:33','2020-02-10 23:05:33'),(7,10,0,'2020-02-10 23:05:33','2020-02-10 23:05:33'),(8,11,0,'2020-02-10 23:05:33','2020-02-10 23:05:33'),(9,12,0,'2020-02-10 23:05:33','2020-02-10 23:05:33'),(10,13,0,'2020-02-10 23:05:33','2020-02-10 23:05:33'),(11,14,0,'2020-02-10 23:05:33','2020-02-10 23:05:33'),(12,15,0,'2020-02-10 23:05:33','2020-02-10 23:05:33'),(13,16,0,'2020-02-10 23:05:33','2020-02-10 23:05:33'),(14,17,0,'2020-02-10 23:05:33','2020-02-10 23:05:33'),(15,18,0,'2020-02-10 23:05:33','2020-02-10 23:05:33'),(16,19,0,'2020-02-10 23:05:33','2020-02-10 23:05:33'),(17,20,0,'2020-02-10 23:05:33','2020-02-10 23:05:33');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comisiones`
--

DROP TABLE IF EXISTS `comisiones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comisiones` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` char(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `minimo` double(6,2) NOT NULL,
  `maximo` double(6,2) NOT NULL,
  `porcentaje` double(5,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comisiones`
--

LOCK TABLES `comisiones` WRITE;
/*!40000 ALTER TABLE `comisiones` DISABLE KEYS */;
INSERT INTO `comisiones` VALUES (1,'General',0.00,1000.00,2.00,'2020-06-23 04:00:00','2020-06-23 04:00:00'),(2,'Buy 1',0.00,99.99,4.00,'2020-06-23 04:00:00','2020-06-23 04:00:00'),(3,'Buy 2',100.00,399.99,3.00,'2020-06-23 04:00:00','2020-06-23 04:00:00'),(4,'Buy 3',400.00,1000.00,2.50,'2020-06-23 04:00:00','2020-06-23 04:00:00'),(5,'Withdraw',0.00,1000.00,12.00,'2020-06-23 04:00:00','2020-06-23 04:00:00'),(6,'Trade',0.00,1000.00,0.20,'2020-06-23 04:00:00','2020-06-23 04:00:00'),(7,'Deposit',0.00,1000.00,12.00,'2020-06-23 04:00:00','2020-06-23 04:00:00');
/*!40000 ALTER TABLE `comisiones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compras_criptomoneda`
--

DROP TABLE IF EXISTS `compras_criptomoneda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compras_criptomoneda` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_hai_criptomoneda` bigint(20) unsigned NOT NULL,
  `id_moneda` bigint(20) unsigned NOT NULL,
  `id_transaccion` bigint(20) unsigned NOT NULL,
  `id_metodo_pago` bigint(20) unsigned NOT NULL,
  `precio_moneda_a_comprar` decimal(13,9) NOT NULL,
  `precio_moneda_a_pagar` decimal(13,9) NOT NULL,
  `comision_general` decimal(5,2) NOT NULL,
  `comision_compra` decimal(5,2) NOT NULL,
  `monto` decimal(13,9) NOT NULL,
  `total_sin_comision` decimal(13,9) NOT NULL,
  `total_con_comision` decimal(13,9) NOT NULL,
  `ganancia` decimal(13,9) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `compras_criptomoneda_id_hai_criptomoneda_foreign` (`id_hai_criptomoneda`),
  KEY `compras_criptomoneda_id_moneda_foreign` (`id_moneda`),
  KEY `compras_criptomoneda_id_transaccion_foreign` (`id_transaccion`),
  KEY `compras_criptomoneda_id_metodo_pago_foreign` (`id_metodo_pago`),
  CONSTRAINT `compras_criptomoneda_id_hai_criptomoneda_foreign` FOREIGN KEY (`id_hai_criptomoneda`) REFERENCES `hai_criptomonedas` (`id`),
  CONSTRAINT `compras_criptomoneda_id_metodo_pago_foreign` FOREIGN KEY (`id_metodo_pago`) REFERENCES `metodos_pago` (`id`),
  CONSTRAINT `compras_criptomoneda_id_moneda_foreign` FOREIGN KEY (`id_moneda`) REFERENCES `monedas` (`id`),
  CONSTRAINT `compras_criptomoneda_id_transaccion_foreign` FOREIGN KEY (`id_transaccion`) REFERENCES `transacciones` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compras_criptomoneda`
--

LOCK TABLES `compras_criptomoneda` WRITE;
/*!40000 ALTER TABLE `compras_criptomoneda` DISABLE KEYS */;
INSERT INTO `compras_criptomoneda` VALUES (1,1,1,1,3,0.190000000,1.000000000,2.00,4.00,200.000000000,38.000000000,40.280000000,2.280000000,'2020-07-18 02:46:29','2020-07-18 02:46:29'),(2,2,1,2,5,9204.800000000,1.000000000,2.00,4.00,0.005000000,46.024000000,48.785440000,2.761440000,'2020-07-18 02:46:47','2020-07-18 02:46:47'),(3,3,1,3,4,42.130000000,1.000000000,2.00,2.50,20.000000000,842.600000000,880.517000000,37.917000000,'2020-07-18 02:47:04','2020-07-18 02:47:04');
/*!40000 ALTER TABLE `compras_criptomoneda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `crypto_tags`
--

DROP TABLE IF EXISTS `crypto_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `crypto_tags` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_cartera` bigint(20) unsigned NOT NULL,
  `tag` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `crypto_tags_id_cartera_foreign` (`id_cartera`),
  CONSTRAINT `crypto_tags_id_cartera_foreign` FOREIGN KEY (`id_cartera`) REFERENCES `carteras` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `crypto_tags`
--

LOCK TABLES `crypto_tags` WRITE;
/*!40000 ALTER TABLE `crypto_tags` DISABLE KEYS */;
INSERT INTO `crypto_tags` VALUES (1,3,'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','2020-07-18 04:41:22','2020-07-18 04:41:22');
/*!40000 ALTER TABLE `crypto_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hai_criptomonedas`
--

DROP TABLE IF EXISTS `hai_criptomonedas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hai_criptomonedas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_moneda` bigint(20) unsigned NOT NULL,
  `id_origen` bigint(20) unsigned NOT NULL,
  `comision_red` double(10,6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hai_criptomonedas_id_moneda_foreign` (`id_moneda`),
  KEY `hai_criptomonedas_id_origen_foreign` (`id_origen`),
  CONSTRAINT `hai_criptomonedas_id_moneda_foreign` FOREIGN KEY (`id_moneda`) REFERENCES `monedas` (`id`),
  CONSTRAINT `hai_criptomonedas_id_origen_foreign` FOREIGN KEY (`id_origen`) REFERENCES `origenes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hai_criptomonedas`
--

LOCK TABLES `hai_criptomonedas` WRITE;
/*!40000 ALTER TABLE `hai_criptomonedas` DISABLE KEYS */;
INSERT INTO `hai_criptomonedas` VALUES (1,2,1,0.250000,NULL,NULL),(2,3,1,0.000400,NULL,NULL),(3,4,1,0.001000,NULL,NULL),(4,5,1,100.000000,NULL,NULL),(5,6,2,100.000000,NULL,NULL);
/*!40000 ALTER TABLE `hai_criptomonedas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `imagen_verificacion`
--

DROP TABLE IF EXISTS `imagen_verificacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `imagen_verificacion` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_cliente` bigint(20) unsigned NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT '0',
  `tipo` tinyint(4) NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `imagen_verificacion_id_cliente_foreign` (`id_cliente`),
  CONSTRAINT `imagen_verificacion_id_cliente_foreign` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imagen_verificacion`
--

LOCK TABLES `imagen_verificacion` WRITE;
/*!40000 ALTER TABLE `imagen_verificacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `imagen_verificacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `imagenes_transaccion`
--

DROP TABLE IF EXISTS `imagenes_transaccion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `imagenes_transaccion` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_transaccion` bigint(20) unsigned NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `imagenes_transaccion_id_transaccion_foreign` (`id_transaccion`),
  CONSTRAINT `imagenes_transaccion_id_transaccion_foreign` FOREIGN KEY (`id_transaccion`) REFERENCES `transacciones` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imagenes_transaccion`
--

LOCK TABLES `imagenes_transaccion` WRITE;
/*!40000 ALTER TABLE `imagenes_transaccion` DISABLE KEYS */;
INSERT INTO `imagenes_transaccion` VALUES (1,3,'1595026035','2020-07-18 02:47:15','2020-07-18 02:47:15'),(2,2,'1595026041','2020-07-18 02:47:21','2020-07-18 02:47:21'),(3,1,'1595026049','2020-07-18 02:47:29','2020-07-18 02:47:29');
/*!40000 ALTER TABLE `imagenes_transaccion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `metodos_pago`
--

DROP TABLE IF EXISTS `metodos_pago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `metodos_pago` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `metodos_pago`
--

LOCK TABLES `metodos_pago` WRITE;
/*!40000 ALTER TABLE `metodos_pago` DISABLE KEYS */;
INSERT INTO `metodos_pago` VALUES (1,'Change (trading)',1,NULL,NULL),(2,'Deposit',1,NULL,NULL),(3,'Bank Account',1,NULL,NULL),(4,'Mon Cash',1,NULL,NULL),(5,'Wester Union',1,NULL,NULL),(6,'MoneyGram',1,NULL,NULL),(7,'paypal',1,NULL,NULL),(8,'Skrill',1,NULL,NULL),(9,'Uphold',1,NULL,NULL),(10,'Zelle',1,NULL,NULL),(11,'Payoneer',1,NULL,NULL);
/*!40000 ALTER TABLE `metodos_pago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `metodos_retiro`
--

DROP TABLE IF EXISTS `metodos_retiro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `metodos_retiro` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `metodos_retiro`
--

LOCK TABLES `metodos_retiro` WRITE;
/*!40000 ALTER TABLE `metodos_retiro` DISABLE KEYS */;
INSERT INTO `metodos_retiro` VALUES (1,'Cash',NULL,NULL),(2,'MonCash',NULL,NULL),(3,'Same Crypto',NULL,NULL);
/*!40000 ALTER TABLE `metodos_retiro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (31,'2014_10_11_000000_create_table_personas',1),(32,'2014_10_12_000000_create_users_table',1),(33,'2014_10_12_100000_create_password_resets_table',1),(34,'2019_08_19_000000_create_failed_jobs_table',1),(35,'2019_10_02_210558_create_table_clientes',1),(36,'2019_10_02_210613_create_table_moderadores',1),(37,'2019_10_02_210616_create_table_tipos_transaccion',1),(38,'2019_10_02_210617_create_table_metodos_pago',1),(39,'2019_10_02_210618_create_table_transacciones',1),(40,'2019_10_02_210619_create_monedas_table',1),(41,'2019_10_02_210628_create_table_acciones',1),(42,'2019_10_02_210632_create_table_auditorias',1),(43,'2019_10_02_210634_create_table_imagen_verificacion',1),(44,'2019_10_02_210637_create_table_referidos',1),(45,'2019_10_02_210640_create_table_imagenes_transaccion',1),(46,'2019_10_25_220915_create_table_videos',1),(47,'2019_10_25_220930_create_table_cliente_video',1),(48,'2020_02_01_185653_create_metodos_retiro_table',1),(49,'2020_02_01_185653_create_tipos_remesa_table',1),(50,'2020_02_01_185654_create_remesas_table',1),(51,'2020_02_01_190312_create_no_usuarios_table',1),(52,'2020_02_01_190419_create_remesas_no_usuario_table',1),(53,'2020_02_01_203509_create_origenes_table',1),(54,'2020_02_01_203509_create_remesas_cliente_table',1),(55,'2020_02_01_203510_create_hai_criptomonedas_table',1),(56,'2020_02_01_203511_create_compras_criptomoneda_table',1),(57,'2020_02_01_203512_create_table_carteras',1),(58,'2020_02_10_223746_create_prefijos_telefono_table',1),(59,'2020_02_25_192526_create_comisiones_table',1),(60,'2020_07_17_214347_create_crypto_tags_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `moderadores`
--

DROP TABLE IF EXISTS `moderadores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `moderadores` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `moderadores_id_usuario_foreign` (`id_usuario`),
  CONSTRAINT `moderadores_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `moderadores`
--

LOCK TABLES `moderadores` WRITE;
/*!40000 ALTER TABLE `moderadores` DISABLE KEYS */;
INSERT INTO `moderadores` VALUES (1,4,'2020-02-11 00:16:53','2020-02-11 00:16:53');
/*!40000 ALTER TABLE `moderadores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `monedas`
--

DROP TABLE IF EXISTS `monedas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `monedas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `siglas` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `monedas`
--

LOCK TABLES `monedas` WRITE;
/*!40000 ALTER TABLE `monedas` DISABLE KEYS */;
INSERT INTO `monedas` VALUES (1,'United States Dollar','USD',NULL,NULL),(2,'XRP','XRP',NULL,NULL),(3,'Bitcoin','BTC',NULL,NULL),(4,'Litecoin','LTC',NULL,NULL),(5,'Ethereum','ETH',NULL,NULL),(6,'Dogecoin','DOGE',NULL,NULL),(7,'Gourde','HTG',NULL,NULL);
/*!40000 ALTER TABLE `monedas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `no_usuarios`
--

DROP TABLE IF EXISTS `no_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `no_usuarios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_persona` bigint(20) unsigned NOT NULL,
  `id_anfitrion` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `no_usuarios_id_persona_foreign` (`id_persona`),
  KEY `no_usuarios_id_anfitrion_foreign` (`id_anfitrion`),
  CONSTRAINT `no_usuarios_id_anfitrion_foreign` FOREIGN KEY (`id_anfitrion`) REFERENCES `users` (`id`),
  CONSTRAINT `no_usuarios_id_persona_foreign` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `no_usuarios`
--

LOCK TABLES `no_usuarios` WRITE;
/*!40000 ALTER TABLE `no_usuarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `no_usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `origenes`
--

DROP TABLE IF EXISTS `origenes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `origenes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `url` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `origenes`
--

LOCK TABLES `origenes` WRITE;
/*!40000 ALTER TABLE `origenes` DISABLE KEYS */;
INSERT INTO `origenes` VALUES (1,'wss://ws-feed.pro.coinbase.com','w',NULL,NULL),(2,'https://api.coinlore.com/api/ticker/?id=2','h',NULL,NULL);
/*!40000 ALTER TABLE `origenes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personas`
--

DROP TABLE IF EXISTS `personas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cedula` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `es_usuario` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personas_cedula_unique` (`cedula`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personas`
--

LOCK TABLES `personas` WRITE;
/*!40000 ALTER TABLE `personas` DISABLE KEYS */;
INSERT INTO `personas` VALUES (1,'root',NULL,1,'2019-11-22 05:31:47','2019-11-22 05:31:47'),(2,'Carlos Bolivar',NULL,1,'2020-02-10 23:05:15','2020-02-10 23:05:15'),(3,'kewin',NULL,1,'2020-02-10 23:05:33','2020-02-10 23:05:33'),(4,'moderador','0000001',1,'2020-02-11 00:16:29','2020-02-11 00:16:29'),(5,'Administrador','0000002',1,'2020-02-11 00:16:29','2020-02-11 00:16:29'),(6,'Marcos','000006',1,'2020-02-11 00:16:29','2020-02-11 00:16:29'),(7,'Misael','000007',1,'2020-02-11 00:16:29','2020-02-11 00:16:29'),(8,'Andrea','000008',1,'2020-02-11 00:16:29','2020-02-11 00:16:29'),(9,'Edglis','000009',1,'2020-02-11 00:16:29','2020-02-11 00:16:29'),(10,'Estefani','0000010',1,'2020-02-11 00:16:29','2020-02-11 00:16:29'),(11,'Zoralid','0000011',1,'2020-02-11 00:16:29','2020-02-11 00:16:29'),(12,'Dioselid','0000012',1,'2020-02-11 00:16:29','2020-02-11 00:16:29'),(13,'Margaret','0000013',1,'2020-02-11 00:16:29','2020-02-11 00:16:29'),(14,'Juan Diego','0000014',1,'2020-02-11 00:16:29','2020-02-11 00:16:29'),(15,'Elianny','0000015',1,'2020-02-11 00:16:29','2020-02-11 00:16:29'),(16,'Ricardo','0000016',1,'2020-02-11 00:16:29','2020-02-11 00:16:29'),(17,'Emanuel','0000017',1,'2020-02-11 00:16:29','2020-02-11 00:16:29'),(18,'Sabrina','0000018',1,'2020-02-11 00:16:29','2020-02-11 00:16:29'),(19,'Mario','0000019',1,'2020-02-11 00:16:29','2020-02-11 00:16:29'),(20,'Adriana','0000020',1,'2020-02-11 00:16:53','2020-02-11 00:16:53');
/*!40000 ALTER TABLE `personas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prefijos_telefono`
--

DROP TABLE IF EXISTS `prefijos_telefono`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prefijos_telefono` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pais` char(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigo` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=244 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prefijos_telefono`
--

LOCK TABLES `prefijos_telefono` WRITE;
/*!40000 ALTER TABLE `prefijos_telefono` DISABLE KEYS */;
INSERT INTO `prefijos_telefono` VALUES (1,'Afghanistan','+93',NULL,NULL),(2,'Albania','+355',NULL,NULL),(3,'Algeria','+213',NULL,NULL),(4,'American Samoa','+1-684',NULL,NULL),(5,'Andorra','+376',NULL,NULL),(6,'Angola','+244',NULL,NULL),(7,'Anguilla','+1-264',NULL,NULL),(8,'Antarctica','+672',NULL,NULL),(9,'Antigua and Barbuda','+1-268',NULL,NULL),(10,'Argentina','+54',NULL,NULL),(11,'Armenia','+374',NULL,NULL),(12,'Aruba','+297',NULL,NULL),(13,'Australia','+61',NULL,NULL),(14,'Austria','+43',NULL,NULL),(15,'Azerbaijan','+994',NULL,NULL),(16,'Bahamas','+1-242',NULL,NULL),(17,'Bahrain','+973',NULL,NULL),(18,'Bangladesh','+880',NULL,NULL),(19,'Barbados','+1-246',NULL,NULL),(20,'Belarus','+375',NULL,NULL),(21,'Belgium','+32',NULL,NULL),(22,'Belize','+501',NULL,NULL),(23,'Benin','+229',NULL,NULL),(24,'Bermuda','+1-441',NULL,NULL),(25,'Bhutan','+975',NULL,NULL),(26,'Bolivia','+591',NULL,NULL),(27,'Bosnia and Herzegovina','+387',NULL,NULL),(28,'Botswana','+267',NULL,NULL),(29,'Brazil','+55',NULL,NULL),(30,'British Indian Ocean Territory','+246',NULL,NULL),(31,'British Virgin Islands','+1-284',NULL,NULL),(32,'Brunei','+673',NULL,NULL),(33,'Bulgaria','+359',NULL,NULL),(34,'Burkina Faso','+226',NULL,NULL),(35,'Burundi','+257',NULL,NULL),(36,'Cambodia','+855',NULL,NULL),(37,'Cameroon','+237',NULL,NULL),(38,'Canada','+1',NULL,NULL),(39,'Cape Verde','+238',NULL,NULL),(40,'Cayman Islands','+1-345',NULL,NULL),(41,'Central African Republic','+236',NULL,NULL),(42,'Chad','+235',NULL,NULL),(43,'Chile','+56',NULL,NULL),(44,'China','+86',NULL,NULL),(45,'Christmas Island','+61',NULL,NULL),(46,'Cocos Islands','+61',NULL,NULL),(47,'Colombia','+57',NULL,NULL),(48,'Comoros','+269',NULL,NULL),(49,'Cook Islands','+682',NULL,NULL),(50,'Costa Rica','+506',NULL,NULL),(51,'Croatia','+385',NULL,NULL),(52,'Cuba','+53',NULL,NULL),(53,'Curacao','+599',NULL,NULL),(54,'Cyprus','+357',NULL,NULL),(55,'Czech Republic','+420',NULL,NULL),(56,'Democratic Republic of the Congo','+243',NULL,NULL),(57,'Denmark','+45',NULL,NULL),(58,'Djibouti','+253',NULL,NULL),(59,'Dominica','+1-767',NULL,NULL),(60,'Dominican Republic','+1-809',NULL,NULL),(61,'Dominican Republic','+1-829',NULL,NULL),(62,'Dominican Republic','+1-849',NULL,NULL),(63,'East Timor','+670',NULL,NULL),(64,'Ecuador','+593',NULL,NULL),(65,'Egypt','+20',NULL,NULL),(66,'El Salvador','+503',NULL,NULL),(67,'Equatorial Guinea','+240',NULL,NULL),(68,'Eritrea','+291',NULL,NULL),(69,'Estonia','+372',NULL,NULL),(70,'Ethiopia','+251',NULL,NULL),(71,'Falkland Islands','+500',NULL,NULL),(72,'Faroe Islands','+298',NULL,NULL),(73,'Fiji','+679',NULL,NULL),(74,'Finland','+358',NULL,NULL),(75,'France','+33',NULL,NULL),(76,'French Polynesia','+689',NULL,NULL),(77,'Gabon','+241',NULL,NULL),(78,'Gambia','+220',NULL,NULL),(79,'Georgia','+995',NULL,NULL),(80,'Germany','+49',NULL,NULL),(81,'Ghana','+233',NULL,NULL),(82,'Gibraltar','+350',NULL,NULL),(83,'Greece','+30',NULL,NULL),(84,'Greenland','+299',NULL,NULL),(85,'Grenada','+1-473',NULL,NULL),(86,'Guam','+1-671',NULL,NULL),(87,'Guatemala','+502',NULL,NULL),(88,'Guernsey','+44-1481',NULL,NULL),(89,'Guinea','+224',NULL,NULL),(90,'Guinea-Bissau','+245',NULL,NULL),(91,'Guyana','+592',NULL,NULL),(92,'Haiti','+509',NULL,NULL),(93,'Honduras','+504',NULL,NULL),(94,'Hong Kong','+852',NULL,NULL),(95,'Hungary','+36',NULL,NULL),(96,'Iceland','+354',NULL,NULL),(97,'India','+91',NULL,NULL),(98,'Indonesia','+62',NULL,NULL),(99,'Iran','+98',NULL,NULL),(100,'Iraq','+964',NULL,NULL),(101,'Ireland','+353',NULL,NULL),(102,'Isle of Man','+44-1624',NULL,NULL),(103,'Israel','+972',NULL,NULL),(104,'Italy','+39',NULL,NULL),(105,'Ivory Coast','+225',NULL,NULL),(106,'Jamaica','+1-876',NULL,NULL),(107,'Japan','+81',NULL,NULL),(108,'Jersey','+44-1534',NULL,NULL),(109,'Jordan','+962',NULL,NULL),(110,'Kazakhstan','+7',NULL,NULL),(111,'Kenya','+254',NULL,NULL),(112,'Kiribati','+686',NULL,NULL),(113,'Kosovo','+383',NULL,NULL),(114,'Kuwait','+965',NULL,NULL),(115,'Kyrgyzstan','+996',NULL,NULL),(116,'Laos','+856',NULL,NULL),(117,'Latvia','+371',NULL,NULL),(118,'Lebanon','+961',NULL,NULL),(119,'Lesotho','+266',NULL,NULL),(120,'Liberia','+231',NULL,NULL),(121,'Libya','+218',NULL,NULL),(122,'Liechtenstein','+423',NULL,NULL),(123,'Lithuania','+370',NULL,NULL),(124,'Luxembourg','+352',NULL,NULL),(125,'Macau','+853',NULL,NULL),(126,'Macedonia','+389',NULL,NULL),(127,'Madagascar','+261',NULL,NULL),(128,'Malawi','+265',NULL,NULL),(129,'Malaysia','+60',NULL,NULL),(130,'Maldives','+960',NULL,NULL),(131,'Mali','+223',NULL,NULL),(132,'Malta','+356',NULL,NULL),(133,'Marshall Islands','+692',NULL,NULL),(134,'Mauritania','+222',NULL,NULL),(135,'Mauritius','+230',NULL,NULL),(136,'Mayotte','+262',NULL,NULL),(137,'Mexico','+52',NULL,NULL),(138,'Micronesia','+691',NULL,NULL),(139,'Moldova','+373',NULL,NULL),(140,'Monaco','+377',NULL,NULL),(141,'Mongolia','+976',NULL,NULL),(142,'Montenegro','+382',NULL,NULL),(143,'Montserrat','+1-664',NULL,NULL),(144,'Morocco','+212',NULL,NULL),(145,'Mozambique','+258',NULL,NULL),(146,'Myanmar','+95',NULL,NULL),(147,'Namibia','+264',NULL,NULL),(148,'Nauru','+674',NULL,NULL),(149,'Nepal','+977',NULL,NULL),(150,'Netherlands','+31',NULL,NULL),(151,'Netherlands Antilles','+599',NULL,NULL),(152,'New Caledonia','+687',NULL,NULL),(153,'New Zealand','+64',NULL,NULL),(154,'Nicaragua','+505',NULL,NULL),(155,'Niger','+227',NULL,NULL),(156,'Nigeria','+234',NULL,NULL),(157,'Niue','+683',NULL,NULL),(158,'North Korea','+850',NULL,NULL),(159,'Northern Mariana Islands','+1-670',NULL,NULL),(160,'Norway','+47',NULL,NULL),(161,'Oman','+968',NULL,NULL),(162,'Pakistan','+92',NULL,NULL),(163,'Palau','+680',NULL,NULL),(164,'Palestine','+970',NULL,NULL),(165,'Panama','+507',NULL,NULL),(166,'Papua New Guinea','+675',NULL,NULL),(167,'Paraguay','+595',NULL,NULL),(168,'Peru','+51',NULL,NULL),(169,'Philippines','+63',NULL,NULL),(170,'Pitcairn','+64',NULL,NULL),(171,'Poland','+48',NULL,NULL),(172,'Portugal','+351',NULL,NULL),(173,'Puerto Rico','+1-787',NULL,NULL),(174,'Puerto Rico','+1-939',NULL,NULL),(175,'Qatar','+974',NULL,NULL),(176,'Republic of the Congo','+242',NULL,NULL),(177,'Reunion','+262',NULL,NULL),(178,'Romania','+40',NULL,NULL),(179,'Russia','+7',NULL,NULL),(180,'Rwanda','+250',NULL,NULL),(181,'Saint Barthelemy','+590',NULL,NULL),(182,'Saint Helena','+290',NULL,NULL),(183,'Saint Kitts and Nevis','+1-869',NULL,NULL),(184,'Saint Lucia','+1-758',NULL,NULL),(185,'Saint Martin','+590',NULL,NULL),(186,'Saint Pierre and Miquelon','+508',NULL,NULL),(187,'Saint Vincent and the Grenadines','+1-784',NULL,NULL),(188,'Samoa','+685',NULL,NULL),(189,'San Marino','+378',NULL,NULL),(190,'Sao Tome and Principe','+239',NULL,NULL),(191,'Saudi Arabia','+966',NULL,NULL),(192,'Senegal','+221',NULL,NULL),(193,'Serbia','+381',NULL,NULL),(194,'Seychelles','+248',NULL,NULL),(195,'Sierra Leone','+232',NULL,NULL),(196,'Singapore','+65',NULL,NULL),(197,'Sint Maarten','+1-721',NULL,NULL),(198,'Slovakia','+421',NULL,NULL),(199,'Slovenia','+386',NULL,NULL),(200,'Solomon Islands','+677',NULL,NULL),(201,'Somalia','+252',NULL,NULL),(202,'South Africa','+27',NULL,NULL),(203,'South Korea','+82',NULL,NULL),(204,'South Sudan','+211',NULL,NULL),(205,'Spain','+34',NULL,NULL),(206,'Sri Lanka','+94',NULL,NULL),(207,'Sudan','+249',NULL,NULL),(208,'Suriname','+597',NULL,NULL),(209,'Svalbard and Jan Mayen','+47',NULL,NULL),(210,'Swaziland','+268',NULL,NULL),(211,'Sweden','+46',NULL,NULL),(212,'Switzerland','+41',NULL,NULL),(213,'Syria','+963',NULL,NULL),(214,'Taiwan','+886',NULL,NULL),(215,'Tajikistan','+992',NULL,NULL),(216,'Tanzania','+255',NULL,NULL),(217,'Thailand','+66',NULL,NULL),(218,'Togo','+228',NULL,NULL),(219,'Tokelau','+690',NULL,NULL),(220,'Tonga','+676',NULL,NULL),(221,'Trinidad and Tobago','+1-868',NULL,NULL),(222,'Tunisia','+216',NULL,NULL),(223,'Turkey','+90',NULL,NULL),(224,'Turkmenistan','+993',NULL,NULL),(225,'Turks and Caicos Islands','+1-649',NULL,NULL),(226,'Tuvalu','+688',NULL,NULL),(227,'U.S. Virgin Islands','+1-340',NULL,NULL),(228,'Uganda','+256',NULL,NULL),(229,'Ukraine','+380',NULL,NULL),(230,'United Arab Emirates','+971',NULL,NULL),(231,'United Kingdom','+44',NULL,NULL),(232,'United States','+1',NULL,NULL),(233,'Uruguay','+598',NULL,NULL),(234,'Uzbekistan','+998',NULL,NULL),(235,'Vanuatu','+678',NULL,NULL),(236,'Vatican','+379',NULL,NULL),(237,'Venezuela','+58',NULL,NULL),(238,'Vietnam','+84',NULL,NULL),(239,'Wallis and Futuna','+681',NULL,NULL),(240,'Western Sahara','+212',NULL,NULL),(241,'Yemen','+967',NULL,NULL),(242,'Zambia','+260',NULL,NULL),(243,'Zimbabwe','+263',NULL,NULL);
/*!40000 ALTER TABLE `prefijos_telefono` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `referidos`
--

DROP TABLE IF EXISTS `referidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `referidos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_cliente` bigint(20) unsigned NOT NULL,
  `id_referido` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `referidos_id_cliente_foreign` (`id_cliente`),
  KEY `referidos_id_referido_foreign` (`id_referido`),
  CONSTRAINT `referidos_id_cliente_foreign` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`),
  CONSTRAINT `referidos_id_referido_foreign` FOREIGN KEY (`id_referido`) REFERENCES `referidos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `referidos`
--

LOCK TABLES `referidos` WRITE;
/*!40000 ALTER TABLE `referidos` DISABLE KEYS */;
/*!40000 ALTER TABLE `referidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `remesas`
--

DROP TABLE IF EXISTS `remesas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `remesas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_emisor` bigint(20) unsigned NOT NULL,
  `id_transaccion` bigint(20) unsigned NOT NULL,
  `id_metodo_retiro` bigint(20) unsigned NOT NULL,
  `id_tipo_remesa` bigint(20) unsigned DEFAULT NULL,
  `id_metodo_pago` bigint(20) unsigned NOT NULL,
  `monto` decimal(6,2) NOT NULL,
  `comision_general` decimal(6,2) NOT NULL,
  `comision_compra` decimal(6,2) NOT NULL,
  `precio_bitcoin_htg` decimal(15,2) NOT NULL,
  `monto_total` decimal(15,2) NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `remesas_id_emisor_foreign` (`id_emisor`),
  KEY `remesas_id_transaccion_foreign` (`id_transaccion`),
  KEY `remesas_id_metodo_retiro_foreign` (`id_metodo_retiro`),
  KEY `remesas_id_tipo_remesa_foreign` (`id_tipo_remesa`),
  KEY `remesas_id_metodo_pago_foreign` (`id_metodo_pago`),
  CONSTRAINT `remesas_id_emisor_foreign` FOREIGN KEY (`id_emisor`) REFERENCES `clientes` (`id`),
  CONSTRAINT `remesas_id_metodo_pago_foreign` FOREIGN KEY (`id_metodo_pago`) REFERENCES `metodos_pago` (`id`),
  CONSTRAINT `remesas_id_metodo_retiro_foreign` FOREIGN KEY (`id_metodo_retiro`) REFERENCES `metodos_retiro` (`id`),
  CONSTRAINT `remesas_id_tipo_remesa_foreign` FOREIGN KEY (`id_tipo_remesa`) REFERENCES `tipos_remesa` (`id`),
  CONSTRAINT `remesas_id_transaccion_foreign` FOREIGN KEY (`id_transaccion`) REFERENCES `transacciones` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `remesas`
--

LOCK TABLES `remesas` WRITE;
/*!40000 ALTER TABLE `remesas` DISABLE KEYS */;
/*!40000 ALTER TABLE `remesas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `remesas_cliente`
--

DROP TABLE IF EXISTS `remesas_cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `remesas_cliente` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_remesa` bigint(20) unsigned NOT NULL,
  `id_cliente` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `remesas_cliente_id_remesa_foreign` (`id_remesa`),
  KEY `remesas_cliente_id_cliente_foreign` (`id_cliente`),
  CONSTRAINT `remesas_cliente_id_cliente_foreign` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`),
  CONSTRAINT `remesas_cliente_id_remesa_foreign` FOREIGN KEY (`id_remesa`) REFERENCES `remesas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `remesas_cliente`
--

LOCK TABLES `remesas_cliente` WRITE;
/*!40000 ALTER TABLE `remesas_cliente` DISABLE KEYS */;
/*!40000 ALTER TABLE `remesas_cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `remesas_no_usuario`
--

DROP TABLE IF EXISTS `remesas_no_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `remesas_no_usuario` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_remesa` bigint(20) unsigned NOT NULL,
  `id_no_usuario` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `remesas_no_usuario_id_remesa_foreign` (`id_remesa`),
  KEY `remesas_no_usuario_id_no_usuario_foreign` (`id_no_usuario`),
  CONSTRAINT `remesas_no_usuario_id_no_usuario_foreign` FOREIGN KEY (`id_no_usuario`) REFERENCES `no_usuarios` (`id`),
  CONSTRAINT `remesas_no_usuario_id_remesa_foreign` FOREIGN KEY (`id_remesa`) REFERENCES `remesas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `remesas_no_usuario`
--

LOCK TABLES `remesas_no_usuario` WRITE;
/*!40000 ALTER TABLE `remesas_no_usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `remesas_no_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipos_remesa`
--

DROP TABLE IF EXISTS `tipos_remesa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipos_remesa` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos_remesa`
--

LOCK TABLES `tipos_remesa` WRITE;
/*!40000 ALTER TABLE `tipos_remesa` DISABLE KEYS */;
INSERT INTO `tipos_remesa` VALUES (1,'Internal',NULL,NULL),(2,'External',NULL,NULL);
/*!40000 ALTER TABLE `tipos_remesa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipos_transaccion`
--

DROP TABLE IF EXISTS `tipos_transaccion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipos_transaccion` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos_transaccion`
--

LOCK TABLES `tipos_transaccion` WRITE;
/*!40000 ALTER TABLE `tipos_transaccion` DISABLE KEYS */;
INSERT INTO `tipos_transaccion` VALUES (1,'Internal Remittance',NULL,NULL),(2,'External Remittance',NULL,NULL),(3,'Buy',NULL,NULL),(4,'Trade',NULL,NULL),(5,'Retirement',NULL,NULL);
/*!40000 ALTER TABLE `tipos_transaccion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transacciones`
--

DROP TABLE IF EXISTS `transacciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transacciones` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_cliente` bigint(20) unsigned NOT NULL,
  `id_moderador` bigint(20) unsigned DEFAULT NULL,
  `id_tipo_transaccion` bigint(20) unsigned DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transacciones_id_cliente_foreign` (`id_cliente`),
  KEY `transacciones_id_moderador_foreign` (`id_moderador`),
  KEY `transacciones_id_tipo_transaccion_foreign` (`id_tipo_transaccion`),
  CONSTRAINT `transacciones_id_cliente_foreign` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`),
  CONSTRAINT `transacciones_id_moderador_foreign` FOREIGN KEY (`id_moderador`) REFERENCES `moderadores` (`id`),
  CONSTRAINT `transacciones_id_tipo_transaccion_foreign` FOREIGN KEY (`id_tipo_transaccion`) REFERENCES `tipos_transaccion` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transacciones`
--

LOCK TABLES `transacciones` WRITE;
/*!40000 ALTER TABLE `transacciones` DISABLE KEYS */;
INSERT INTO `transacciones` VALUES (1,1,NULL,3,1,'2020-07-18 02:46:29','2020-07-18 02:48:09'),(2,1,NULL,3,1,'2020-07-18 02:46:47','2020-07-18 02:48:02'),(3,1,NULL,3,1,'2020-07-18 02:47:04','2020-07-18 02:47:57');
/*!40000 ALTER TABLE `transacciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_persona` bigint(20) unsigned NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `telefono` char(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verificado` tinyint(4) NOT NULL DEFAULT '0',
  `estado` tinyint(4) NOT NULL DEFAULT '1',
  `tipo` tinyint(4) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_telefono_unique` (`telefono`),
  KEY `users_id_persona_foreign` (`id_persona`),
  CONSTRAINT `users_id_persona_foreign` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'root@root.com',NULL,'$2y$10$.Ow35MqAVARI/Kyqpz0VPO4AHVU84sb41PFO9YdoARp.F/z9vphKW',NULL,NULL,0,1,3,NULL,'2019-11-22 05:31:48','2019-11-22 05:31:48'),(2,2,'carlos@gmail.com',NULL,'$2y$10$rLuM.6J70KKx/T6ip7Fq2.UDVLeDuWB86K7kpV8Dnu7wmgwHnzTFm',NULL,NULL,0,1,1,NULL,'2020-02-10 23:05:16','2020-02-10 23:05:16'),(3,3,'kewin@gmail.com',NULL,'$2y$10$QbG6.aCT.TrOPyAMFXI7.u5/xJglrrpqeykJlf9Myv5TZ8jTYMKvu',NULL,NULL,0,1,1,NULL,'2020-02-10 23:05:34','2020-02-10 23:05:34'),(4,4,'mod@gmail.com',NULL,'$2y$10$XjMGgI7FZlkjv4y4hCCfa.OVvne6l0.Q6qAe/6zQKzRRQaOJcgIGS','2020-01-01',NULL,0,1,2,NULL,'2020-02-11 00:16:30','2020-02-11 00:16:30'),(5,5,'admin@gmail.com',NULL,'$2y$10$jyctYinHsanIxT0PDHa4L.7GGNRbZLhDveBImQ0EUgqQK1tYOHV1q','2020-01-01',NULL,0,1,3,NULL,'2020-02-11 00:16:53','2020-02-11 00:16:53'),(6,6,'Marcos@gmail.com',NULL,'$2y$10$jyctYinHsanIxT0PDHa4L.7GGNRbZLhDveBImQ0EUgqQK1tYOHV1q','2020-01-01',NULL,0,1,3,NULL,'2020-02-11 00:16:53','2020-02-11 00:16:53'),(7,7,'Misael@gmail.com',NULL,'$2y$10$jyctYinHsanIxT0PDHa4L.7GGNRbZLhDveBImQ0EUgqQK1tYOHV1q','2020-01-01',NULL,0,1,3,NULL,'2020-02-11 00:16:53','2020-02-11 00:16:53'),(8,8,'Andrea@gmail.com',NULL,'$2y$10$jyctYinHsanIxT0PDHa4L.7GGNRbZLhDveBImQ0EUgqQK1tYOHV1q','2020-01-01',NULL,0,1,3,NULL,'2020-02-11 00:16:53','2020-02-11 00:16:53'),(9,9,'Edglis@gmail.com',NULL,'$2y$10$jyctYinHsanIxT0PDHa4L.7GGNRbZLhDveBImQ0EUgqQK1tYOHV1q','2020-01-01',NULL,0,1,3,NULL,'2020-02-11 00:16:53','2020-02-11 00:16:53'),(10,10,'Estefani@gmail.com',NULL,'$2y$10$jyctYinHsanIxT0PDHa4L.7GGNRbZLhDveBImQ0EUgqQK1tYOHV1q','2020-01-01',NULL,0,1,3,NULL,'2020-02-11 00:16:53','2020-02-11 00:16:53'),(11,11,'Zoralid@gmail.com',NULL,'$2y$10$jyctYinHsanIxT0PDHa4L.7GGNRbZLhDveBImQ0EUgqQK1tYOHV1q','2020-01-01',NULL,0,1,3,NULL,'2020-02-11 00:16:53','2020-02-11 00:16:53'),(12,12,'Dioselid@gmail.com',NULL,'$2y$10$jyctYinHsanIxT0PDHa4L.7GGNRbZLhDveBImQ0EUgqQK1tYOHV1q','2020-01-01',NULL,0,1,3,NULL,'2020-02-11 00:16:53','2020-02-11 00:16:53'),(13,13,'Margaret@gmail.com',NULL,'$2y$10$jyctYinHsanIxT0PDHa4L.7GGNRbZLhDveBImQ0EUgqQK1tYOHV1q','2020-01-01',NULL,0,1,3,NULL,'2020-02-11 00:16:53','2020-02-11 00:16:53'),(14,14,'Juan@gmail.com',NULL,'$2y$10$jyctYinHsanIxT0PDHa4L.7GGNRbZLhDveBImQ0EUgqQK1tYOHV1q','2020-01-01',NULL,0,1,3,NULL,'2020-02-11 00:16:53','2020-02-11 00:16:53'),(15,15,'Elianny@gmail.com',NULL,'$2y$10$jyctYinHsanIxT0PDHa4L.7GGNRbZLhDveBImQ0EUgqQK1tYOHV1q','2020-01-01',NULL,0,1,3,NULL,'2020-02-11 00:16:53','2020-02-11 00:16:53'),(16,16,'Ricardo@gmail.com',NULL,'$2y$10$jyctYinHsanIxT0PDHa4L.7GGNRbZLhDveBImQ0EUgqQK1tYOHV1q','2020-01-01',NULL,0,1,3,NULL,'2020-02-11 00:16:53','2020-02-11 00:16:53'),(17,17,'Emanuel@gmail.com',NULL,'$2y$10$jyctYinHsanIxT0PDHa4L.7GGNRbZLhDveBImQ0EUgqQK1tYOHV1q','2020-01-01',NULL,0,1,3,NULL,'2020-02-11 00:16:53','2020-02-11 00:16:53'),(18,18,'Sabrina@gmail.com',NULL,'$2y$10$jyctYinHsanIxT0PDHa4L.7GGNRbZLhDveBImQ0EUgqQK1tYOHV1q','2020-01-01',NULL,0,1,3,NULL,'2020-02-11 00:16:53','2020-02-11 00:16:53'),(19,19,'Mario@gmail.com',NULL,'$2y$10$jyctYinHsanIxT0PDHa4L.7GGNRbZLhDveBImQ0EUgqQK1tYOHV1q','2020-01-01',NULL,0,1,3,NULL,'2020-02-11 00:16:53','2020-02-11 00:16:53'),(20,20,'Adriana@gmail.com',NULL,'$2y$10$jyctYinHsanIxT0PDHa4L.7GGNRbZLhDveBImQ0EUgqQK1tYOHV1q','2020-01-01',NULL,0,1,3,NULL,'2020-02-11 00:16:53','2020-02-11 00:16:53');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `videos`
--

DROP TABLE IF EXISTS `videos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `videos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `videos`
--

LOCK TABLES `videos` WRITE;
/*!40000 ALTER TABLE `videos` DISABLE KEYS */;
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

-- Dump completed on 2020-07-21 15:48:18
