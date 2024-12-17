-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: localhost    Database: el_detalle
-- ------------------------------------------------------
-- Server version	8.0.39

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
-- Table structure for table `bebidas`
--

DROP TABLE IF EXISTS `bebidas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bebidas` (
  `bebida_id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `ingredientes` varchar(6500) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `detalles` varchar(1000) NOT NULL,
  PRIMARY KEY (`bebida_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bebidas`
--

LOCK TABLES `bebidas` WRITE;
/*!40000 ALTER TABLE `bebidas` DISABLE KEYS */;
INSERT INTO `bebidas` VALUES (1,'Mojijto','Ron blanco\nHojas de menta fresca\nAzúcar o jarabe de azúcar\nJugo de lima\nAgua con gas\nHielo','mojito4.jpeg','El mojito es un clásico cóctel cubano, conocido por su refrescante combinación de sabores. Originario de La Habana, este cóctel combina ron blanco, hojas de menta fresca, azúcar (o jarabe de azúcar), jugo de lima y agua con gas. El mojito es la elección perfecta para aquellos que buscan una bebida ligera y revitalizante, ideal para disfrutar en un día caluroso.'),(2,'Bloody Mary','Para 2 personas\r\nVodka\r\n70 ml\r\nZumo de tomate\r\n210 ml\r\nZumo de limón\r\n15 ml\r\nSalsa Tabasco dos gotas\r\nSalsa Worcestershire tres gotas\r\nPimienta negra molida\r\nApio','Bloody_Mary.jpg','El Bloody Mary es uno de los cócteles más populares de todos los tiempos. No es seguro que fuera exactamente así, pero parece ser que fue un barman llamado Fernand Petiot, quien inventó este combinado en el Harry’s New York Bar de París en 1920, mezclando a partes iguales vodka y zumo de tomate. Posteriormente, cuando Petiot se trasladó a los Estados Unidos como jefe del Bar King Cole en el Hotel Saint Regis de Nueva York, cambió la fórmula refinando el cóctel, añadiendo sal y pimienta, zumo de limón, y toques de salsa Worthestershire (Perrins) y unas gotas de salsa Tabasco rojo.'),(3,'ALISIOS DE PASIÓN','Ingredientes\r\nRon Bacardi Superior\r\nCacao blanco\r\nPisang\r\nZumo de piña\r\nZumo de mango – maracuya','ALISIOS_DE_PASIÓN.jpg','Se elabora en coctelera.\r\nSe sirve en vaso de Long drink.\r\nReceta de creación.'),(4,'Margarita','Tequila\r\nLicor de naranja (Triple sec o Cointreau)\r\nJugo de lima\r\nSal (para escarchar el vaso)\r\nHielo','margarita.jpg','Originaria de México, la margarita es un cóctel vibrante que combina tequila, licor de naranja y jugo de lima. Suele servirse en un vaso escarchado con sal, lo que realza su sabor ácido y refrescante.');
/*!40000 ALTER TABLE `bebidas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empleados`
--

DROP TABLE IF EXISTS `empleados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `empleados` (
  `empleado_id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellido_paterno` varchar(100) NOT NULL,
  `apellido_materno` varchar(100) NOT NULL,
  `celular` varchar(15) DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_actualizacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` tinyint DEFAULT NULL,
  PRIMARY KEY (`empleado_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleados`
--

LOCK TABLES `empleados` WRITE;
/*!40000 ALTER TABLE `empleados` DISABLE KEYS */;
INSERT INTO `empleados` VALUES (1,'Gabriela','Choque','Perez','74757679','2024-09-14 17:46:38','2024-11-03 20:53:10',1),(2,'Gustavoo','Marquez','Mendieta','62609245','2024-09-14 18:21:17','2024-11-02 22:03:34',1),(3,'Josue','Carata','Inca','74523689','2024-09-14 18:21:33','2024-11-02 22:03:35',1),(4,'Juan Daniel','Vicente ','Quispe','74253212','2024-09-14 18:21:55','2024-11-02 22:03:35',1),(5,'Cesar','Huanca','Huchani','65856954','2024-09-14 18:22:21','2024-11-02 22:03:36',1),(6,'Roly','Lazaro','Cari','62356854','2024-09-14 18:22:47','2024-11-02 22:03:36',1),(7,'Abram','Mamani','Quispe','74523156','2024-09-14 18:23:10','2024-11-02 22:03:37',1),(8,'Kevin ','Agreda ','Agrega','76896254','2024-09-14 18:23:53','2024-11-02 22:03:37',1),(10,'Maria Silvia','Mendieta','Salazar','71794445','2024-11-02 22:11:01','2024-11-05 20:14:13',1),(11,'Raul','Vera','Portanda','74252535','2024-11-02 22:15:35','2024-11-05 20:14:13',1),(12,'mario bros','Quispe','mata','74121225','2024-11-02 22:18:30','2024-11-05 20:14:13',1),(13,'Evito','Morales ','Ayma','74232325','2024-11-03 20:44:30','2024-11-03 20:53:25',1),(14,'Masiburro','Evista','Coyas','77777777','2024-11-03 20:54:07','2024-11-05 20:14:13',1);
/*!40000 ALTER TABLE `empleados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `garzones_reservas`
--

DROP TABLE IF EXISTS `garzones_reservas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `garzones_reservas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reserva_id` int DEFAULT NULL,
  `empleado_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reserva_id` (`reserva_id`),
  KEY `empleado_id` (`empleado_id`),
  CONSTRAINT `garzones_reservas_ibfk_1` FOREIGN KEY (`reserva_id`) REFERENCES `reservas` (`reserva_id`),
  CONSTRAINT `garzones_reservas_ibfk_2` FOREIGN KEY (`empleado_id`) REFERENCES `empleados` (`empleado_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `garzones_reservas`
--

LOCK TABLES `garzones_reservas` WRITE;
/*!40000 ALTER TABLE `garzones_reservas` DISABLE KEYS */;
INSERT INTO `garzones_reservas` VALUES (1,1,3),(2,1,1),(3,1,5),(4,1,7),(5,1,11),(6,1,12),(7,2,2),(8,2,1),(9,2,7),(10,2,10),(11,3,1),(12,3,2),(13,5,1),(14,5,4),(15,5,2),(16,5,7),(17,6,1),(18,6,3),(19,6,2),(21,13,11),(22,13,2),(23,13,6),(26,13,1),(27,21,1),(28,21,2),(29,12,2),(30,12,1),(31,12,6),(32,12,12),(33,53,1),(34,53,2),(35,53,5),(36,53,8);
/*!40000 ALTER TABLE `garzones_reservas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `manteleria`
--

DROP TABLE IF EXISTS `manteleria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `manteleria` (
  `manteleria_id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `precio` int NOT NULL,
  `stock` int NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`manteleria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manteleria`
--

LOCK TABLES `manteleria` WRITE;
/*!40000 ALTER TABLE `manteleria` DISABLE KEYS */;
INSERT INTO `manteleria` VALUES (2,'Manteleria','Basico',80,138,'basico.jpeg'),(3,'Manteleria','Basico',80,121,'basico2.jpeg'),(4,'Manteleria','Basico',90,154,'basico3.jpg'),(6,'Manteleria','Intermedio',120,95,'intermedio2.jpg'),(7,'Manteleria','Intermedio',120,80,'intermedio3.jpg'),(11,'Manteleria','Premium',160,100,'premium.jpeg'),(12,'Manteleria','Premium',170,90,'premium1.png');
/*!40000 ALTER TABLE `manteleria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reserva_detalles`
--

DROP TABLE IF EXISTS `reserva_detalles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reserva_detalles` (
  `detalle_id` int NOT NULL AUTO_INCREMENT,
  `reserva_id` int NOT NULL,
  `vajilla_id` int DEFAULT NULL,
  `manteleria_id` int DEFAULT NULL,
  `cantidad` int NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  PRIMARY KEY (`detalle_id`),
  KEY `reserva_id` (`reserva_id`),
  KEY `vajilla_id` (`vajilla_id`),
  KEY `manteleria_id` (`manteleria_id`),
  CONSTRAINT `reserva_detalles_ibfk_1` FOREIGN KEY (`reserva_id`) REFERENCES `reservas` (`reserva_id`),
  CONSTRAINT `reserva_detalles_ibfk_2` FOREIGN KEY (`vajilla_id`) REFERENCES `vajilla` (`vajilla_id`),
  CONSTRAINT `reserva_detalles_ibfk_3` FOREIGN KEY (`manteleria_id`) REFERENCES `manteleria` (`manteleria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reserva_detalles`
--

LOCK TABLES `reserva_detalles` WRITE;
/*!40000 ALTER TABLE `reserva_detalles` DISABLE KEYS */;
INSERT INTO `reserva_detalles` VALUES (1,1,1,NULL,10,15.00),(2,1,NULL,3,30,80.00),(3,2,3,NULL,2,35.00),(4,2,7,NULL,10,20.00),(5,2,9,NULL,6,30.00),(6,2,8,NULL,6,150.00),(7,2,NULL,3,30,80.00),(8,2,1,NULL,10,15.00),(9,2,2,NULL,40,45.00),(10,2,3,NULL,2,35.00),(11,2,7,NULL,10,20.00),(12,2,9,NULL,30,30.00),(13,3,1,NULL,20,15.00),(14,3,2,NULL,10,45.00),(15,3,8,NULL,2,150.00),(16,3,9,NULL,2,30.00),(17,3,NULL,4,10,90.00),(18,4,2,NULL,10,45.00),(19,4,1,NULL,10,15.00),(20,5,2,NULL,10,45.00),(21,5,1,NULL,10,15.00),(22,5,NULL,2,5,80.00),(23,6,8,NULL,5,150.00),(24,6,9,NULL,5,30.00),(25,6,NULL,11,5,160.00),(26,7,1,NULL,4,15.00),(27,7,8,NULL,4,150.00),(28,7,9,NULL,4,30.00),(31,9,1,NULL,6,15.00),(32,9,8,NULL,2,150.00),(33,9,9,NULL,2,30.00),(34,10,1,NULL,10,15.00),(35,10,2,NULL,10,45.00),(36,10,7,NULL,10,20.00),(37,10,8,NULL,4,150.00),(38,10,9,NULL,4,30.00),(39,10,NULL,7,20,120.00),(40,11,1,NULL,10,15.00),(41,11,8,NULL,4,150.00),(42,11,9,NULL,4,30.00),(43,12,1,NULL,4,15.00),(44,12,2,NULL,4,45.00),(45,12,7,NULL,8,20.00),(46,12,NULL,6,15,120.00),(47,13,NULL,2,10,80.00),(48,13,NULL,3,10,80.00),(49,13,NULL,4,10,90.00),(50,13,1,NULL,10,15.00),(51,13,8,NULL,2,150.00),(52,13,9,NULL,2,30.00),(53,14,1,NULL,6,15.00),(54,15,1,NULL,10,15.00),(55,16,2,NULL,5,45.00),(56,17,2,NULL,4,45.00),(57,18,2,NULL,4,45.00),(58,19,2,NULL,4,45.00),(59,20,2,NULL,4,45.00),(60,21,2,NULL,3,45.00),(61,22,2,NULL,2,45.00),(62,23,1,NULL,1,15.00),(63,24,2,NULL,2,45.00),(64,24,NULL,3,3,80.00),(65,25,1,NULL,1,15.00),(66,25,NULL,2,1,80.00),(67,26,1,NULL,1,15.00),(68,26,NULL,2,1,80.00),(69,27,1,NULL,1,15.00),(70,27,NULL,2,1,80.00),(71,28,1,NULL,1,15.00),(72,28,NULL,2,1,80.00),(73,29,1,NULL,1,15.00),(74,29,NULL,2,1,80.00),(75,30,1,NULL,1,15.00),(76,30,NULL,2,1,80.00),(77,31,1,NULL,1,15.00),(78,31,NULL,2,1,80.00),(79,32,1,NULL,1,15.00),(80,32,NULL,2,1,80.00),(81,33,1,NULL,1,15.00),(82,33,NULL,2,1,80.00),(83,34,1,NULL,1,15.00),(84,34,NULL,2,1,80.00),(85,35,2,NULL,3,45.00),(86,35,NULL,3,3,80.00),(87,36,1,NULL,2,15.00),(88,36,NULL,2,2,80.00),(89,37,1,NULL,1,15.00),(90,37,2,NULL,16,45.00),(91,38,2,NULL,3,45.00),(92,39,2,NULL,2,45.00),(93,40,NULL,2,3,80.00),(94,41,1,NULL,1,15.00),(95,42,1,NULL,1,15.00),(96,43,1,NULL,1,15.00),(97,44,1,NULL,1,15.00),(98,45,4,NULL,1,45.00),(99,46,1,NULL,1,15.00),(100,47,NULL,2,1,80.00),(101,48,2,NULL,1,45.00),(102,49,1,NULL,1,15.00),(103,49,NULL,3,3,80.00),(104,49,NULL,2,4,80.00),(105,49,5,NULL,4,20.00),(106,50,2,NULL,4,45.00),(107,50,3,NULL,3,35.00),(108,50,NULL,2,2,80.00),(109,51,2,NULL,3,45.00),(110,52,2,NULL,3,45.00),(111,53,3,NULL,3,35.00),(112,54,1,NULL,10,15.00),(113,54,NULL,12,10,170.00);
/*!40000 ALTER TABLE `reserva_detalles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservas`
--

DROP TABLE IF EXISTS `reservas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservas` (
  `reserva_id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `fecha_reserva` date NOT NULL,
  `tipo_evento` varchar(200) DEFAULT NULL,
  `dias` int NOT NULL,
  `monto_total` decimal(10,2) NOT NULL,
  `estado_pago` varchar(50) NOT NULL,
  `garzones` varchar(20) DEFAULT NULL,
  `detalle_evento` varchar(500) NOT NULL,
  `aprobado_por` int DEFAULT NULL,
  `fecha_entrega_vajilla` datetime DEFAULT NULL,
  `entregado_por` int DEFAULT NULL,
  `fecha_recogida_vajilla` datetime DEFAULT NULL,
  `recogido_por` int DEFAULT NULL,
  `detalles` varchar(1800) NOT NULL,
  PRIMARY KEY (`reserva_id`),
  KEY `usuario_id` (`usuario_id`),
  KEY `aprobado_por` (`aprobado_por`),
  KEY `entregado_por` (`entregado_por`),
  KEY `recogido_por` (`recogido_por`),
  CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`usuario_id`),
  CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`aprobado_por`) REFERENCES `usuarios` (`usuario_id`),
  CONSTRAINT `reservas_ibfk_3` FOREIGN KEY (`entregado_por`) REFERENCES `usuarios` (`usuario_id`),
  CONSTRAINT `reservas_ibfk_4` FOREIGN KEY (`recogido_por`) REFERENCES `usuarios` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservas`
--

LOCK TABLES `reservas` WRITE;
/*!40000 ALTER TABLE `reservas` DISABLE KEYS */;
INSERT INTO `reservas` VALUES (1,2,'2024-01-06','Matrimonio',2,3450.00,'Evento Completado','6','Matriminio simple solo para 300 personas ',1,'2024-01-06 16:22:01',1,'2024-01-09 16:22:30',1,'Sin novedad todo completo'),(2,2,'2024-01-13','Matrimonio',2,7470.00,'Evento Completado','4','En el salon de eventos \"Laureles\"',1,'2024-01-13 16:29:44',1,'2024-01-15 16:30:04',1,'ningun detalle'),(3,2,'2024-10-12','Otro',1,2310.00,'Evento Completado','2','Fiesta para la entrada de colcapirua para atender luego de bailar afuera de la iglesia a los presentes',1,'2024-10-12 16:35:33',1,'2024-10-14 16:36:31',NULL,'media caja de cervera rota se repuso con copas cerveras del mismo modelo, sin novedad'),(4,2,'2024-10-19','Bautizo',2,600.00,'Evento Completado','0','',3,'2024-10-19 16:40:03',3,'2024-10-21 16:40:32',3,'se rompio 1 caja de champaneras se repuso con dinero en efectivo total 50Bs'),(5,2,'2024-10-26','15 Años',1,1600.00,'Evento Completado','4','',2,'2024-10-26 16:43:18',2,'2024-10-28 16:43:37',NULL,'ninguno sin novedad'),(6,2,'2024-11-02','Matrimonio',1,2150.00,'Evento Completado','3','matrimonio de civil de 1 dia algo sencillo pero elegante',3,'2024-11-02 16:47:06',3,'2024-11-04 16:47:55',NULL,'1 mantel dañado y 2 centros de mesa rotos, se repuso en dinero 240 Bs.'),(7,2,'2024-11-03','Fiesta de Santito',1,780.00,'Evento Completado','0','',3,'2024-11-03 16:50:04',3,'2024-11-03 16:50:11',3,'sin ningun detalle'),(9,2,'2024-11-08','Fiesta de Santito',1,450.00,'En Curso de entrega','0','',3,NULL,NULL,NULL,NULL,''),(10,2,'2024-11-09','Matrimonio',2,4520.00,'aprobado-esperando adelanto','4','',3,NULL,NULL,NULL,NULL,''),(11,2,'2024-11-13','Cumpleaños',1,870.00,'Pendiente','0','',NULL,NULL,NULL,NULL,NULL,''),(12,2,'2024-11-16','Matrimonio',1,2800.00,'Pendiente','4','2',NULL,NULL,NULL,NULL,NULL,''),(13,2,'2025-01-10','Cumpleaños',1,3610.00,'Evento Completado','4','',3,'2024-11-05 20:14:32',3,'2024-11-29 19:10:11',3,'ninguna novedad'),(14,1,'2024-11-09','Bautizo',1,90.00,'Pendiente','0','asd',NULL,NULL,NULL,NULL,NULL,''),(15,1,'2025-05-21','Bautizo',1,300.00,'Pendiente','1','',NULL,NULL,NULL,NULL,NULL,''),(16,1,'2025-05-21','Bautizo',1,225.00,'Pendiente','0','asd',NULL,NULL,NULL,NULL,NULL,''),(17,1,'2025-05-21','Cumpleaños',1,180.00,'aprobado-esperando adelanto','0','',3,NULL,NULL,NULL,NULL,''),(18,1,'2025-05-21','Bautizo',1,480.00,'Pendiente','2','asd',NULL,NULL,NULL,NULL,NULL,''),(19,1,'2025-05-24','Matrimonio',2,330.00,'Pendiente','1','asd',NULL,NULL,NULL,NULL,NULL,''),(20,1,'2025-05-24','Matrimonio',2,480.00,'Pendiente','2','',NULL,NULL,NULL,NULL,NULL,''),(21,1,'2025-05-26','Bautizo',2,435.00,'aprobado-esperando adelanto','2','',3,NULL,NULL,NULL,NULL,''),(22,1,'2025-05-26','Matrimonio',1,540.00,'Pendiente','3','',NULL,NULL,NULL,NULL,NULL,''),(23,1,'2025-05-27','Bautizo',2,465.00,'Pendiente','3','',NULL,NULL,NULL,NULL,NULL,''),(24,1,'2024-11-10','Bautizo',1,330.00,'Pendiente','0','',NULL,NULL,NULL,NULL,NULL,''),(25,1,'2024-11-10','Bautizo',1,95.00,'Pendiente','0','',NULL,NULL,NULL,NULL,NULL,''),(26,1,'2024-11-09','Bautizo',1,95.00,'Pendiente','0','',NULL,NULL,NULL,NULL,NULL,''),(27,1,'2024-11-09','Bautizo',1,95.00,'Pendiente','0','',NULL,NULL,NULL,NULL,NULL,''),(28,1,'2024-11-09','Cumpleaños',1,95.00,'Pendiente','0','',NULL,NULL,NULL,NULL,NULL,''),(29,1,'2024-11-09','15 Años',1,95.00,'Pendiente','0','',NULL,NULL,NULL,NULL,NULL,''),(30,1,'2024-11-09','Bautizo',1,95.00,'Pendiente','0','',NULL,NULL,NULL,NULL,NULL,''),(31,1,'2024-11-09','Cumpleaños',1,95.00,'Pendiente','0','',NULL,NULL,NULL,NULL,NULL,''),(32,1,'2025-06-19','Cumpleaños',1,545.00,'Pendiente','3','',NULL,NULL,NULL,NULL,NULL,''),(33,1,'2024-11-09','Cumpleaños',1,95.00,'Pendiente','0','',NULL,NULL,NULL,NULL,NULL,''),(34,1,'2024-11-09','Cumpleaños',1,95.00,'Pendiente','0','',NULL,NULL,NULL,NULL,NULL,''),(35,1,'2024-11-13','Matrimonio',2,675.00,'Pendiente','2','aasd',NULL,NULL,NULL,NULL,NULL,''),(36,1,'2024-11-13','Bautizo',1,490.00,'Pendiente','2','',NULL,NULL,NULL,NULL,NULL,''),(37,1,'2024-11-13','Cumpleaños',2,735.00,'Pendiente','0','',NULL,NULL,NULL,NULL,NULL,''),(38,3,'2024-11-15','Bautizo',2,435.00,'Pendiente','2','',NULL,NULL,NULL,NULL,NULL,''),(39,3,'2024-11-15','Cumpleaños',2,90.00,'Pendiente','0','',NULL,NULL,NULL,NULL,NULL,''),(40,3,'2024-11-15','Bautizo',2,240.00,'Pendiente','0','',NULL,NULL,NULL,NULL,NULL,''),(41,1,'2025-04-04','Matrimonio',1,15.00,'Pendiente','0','Prueba de generar pdf automatico',NULL,NULL,NULL,NULL,NULL,''),(42,1,'2024-11-21','Matrimonio',1,15.00,'Pendiente','0','asdasdasdasdasda',NULL,NULL,NULL,NULL,NULL,''),(43,1,'2024-11-21','Matrimonio',2,15.00,'Pendiente','0','Prueba pdf',NULL,NULL,NULL,NULL,NULL,''),(44,1,'2024-11-21','Bautizo',1,15.00,'Pendiente','0','asda',NULL,NULL,NULL,NULL,NULL,''),(45,1,'2024-11-20','Cumpleaños',2,45.00,'Pendiente','0','asdasd',NULL,NULL,NULL,NULL,NULL,''),(46,1,'2024-11-20','Bautizo',2,15.00,'Pendiente','0','asdasd',NULL,NULL,NULL,NULL,NULL,''),(47,1,'2024-11-21','Bautizo',1,80.00,'Pendiente','0','12',NULL,NULL,NULL,NULL,NULL,''),(48,1,'2024-11-21','Matrimonio',1,45.00,'Pendiente','0','sfd',NULL,NULL,NULL,NULL,NULL,''),(49,3,'2025-06-12','Bautizo',1,1105.00,'Pendiente','3','',NULL,NULL,NULL,NULL,NULL,''),(50,3,'2024-12-05','Matrimonio',2,445.00,'Pendiente','0','fiesta',NULL,NULL,NULL,NULL,NULL,''),(51,3,'2024-11-29','Matrimonio',1,585.00,'Pendiente','3','',NULL,NULL,NULL,NULL,NULL,''),(52,3,'2024-11-29','Bautizo',1,135.00,'Pendiente','0','asd',NULL,NULL,NULL,NULL,NULL,''),(53,3,'2024-11-29','Bautizo',1,705.00,'aprobado-esperando adelanto','4','',3,NULL,NULL,NULL,NULL,''),(54,6,'2024-12-01','15 Años',1,1850.00,'aprobado-esperando adelanto','0','',6,NULL,NULL,NULL,NULL,'');
/*!40000 ALTER TABLE `reservas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `usuario_id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `primerApellido` varchar(255) NOT NULL,
  `segundoApellido` varchar(255) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `celular` varchar(15) NOT NULL,
  `estado` tinyint DEFAULT NULL,
  `rol` varchar(50) NOT NULL DEFAULT 'cliente',
  `fechaCreacionUsuario` datetime DEFAULT CURRENT_TIMESTAMP,
  `fechaActualizacionUsuario` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`usuario_id`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Gustavo','Marquez','Mendieta','gustavomarquezmendieta@gmail.com','$2y$10$MgOwJCquHdtztnnmFo4FbuzdU6yj8M6XXA.UPUI6.gfrTV/ddKwDO','62609245',1,'cliente','2024-11-05 15:10:53','2024-11-05 20:09:48'),(2,'Jhery ','Marquez','Mendieta','marquez.gustavo.1296@gmail.com','$2y$10$QsAViPi3FTYnnx1EvkhGqOrSAbDRdaNflMyTNbRKgCjToGF8zJ4L.','62609245',1,'cliente','2024-11-05 15:14:58','2024-11-05 16:00:03'),(3,'El Detalle','Eventos','','eldetalle6260@gmail.com','$2y$10$7xMukcNksICZ9pFfQukqr.40RkIwRX0HV7vPzp9CNuj9bwnINTbP.','75915873',1,'administrador','2024-11-05 16:01:02','2024-10-14 16:39:22'),(5,'Roly','lazado','cary','lazaro.roly.407@gmail.com','$2y$10$.RIiSICsDg6AvITHLnRucuU.AyB9u8d8Z6U.J94m47Li4uLN8tnfm','74589626',1,'cliente','2024-11-05 22:54:55',NULL),(6,'gabriela','choque','','gabrielachoque678@gmail.com','$2y$10$ZIOgDdlCUW0O278mZ0URXO.92TJ9mKKTx6Zk/bEwydpba9z8Yr8I6','74859625',1,'cliente','2024-11-29 19:14:25','2024-11-29 19:15:11');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vajilla`
--

DROP TABLE IF EXISTS `vajilla`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vajilla` (
  `vajilla_id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `precio` int NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `cantidad` int NOT NULL,
  `stock_cajas` int NOT NULL,
  PRIMARY KEY (`vajilla_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vajilla`
--

LOCK TABLES `vajilla` WRITE;
/*!40000 ALTER TABLE `vajilla` DISABLE KEYS */;
INSERT INTO `vajilla` VALUES (1,'Cervecera','Copa',15,'cervecera.png',25,0),(2,'Champanera','Copa',45,'champanera.png',12,3),(3,'Copa Brandy','Copa',35,'Copa_Brandy.png',25,91),(4,'Copa Coñac','Copa',45,'Copa_de_Coñac.png',20,89),(5,'Copa Margarita','Copa',20,'Copa_Margarita.png',20,86),(6,'Copa Uracan','Copa',30,'Copa_Uracan.png',20,100),(7,'Copa Larga Higball','Copa',20,'Copa_Larga_Highball.png',25,72),(8,'Plato Plano','Plato',150,'Platos.png',50,90),(9,'Cubiertos','Cubierto',30,'cubiertos.png',50,90),(10,'cocteleros','Copa',25,'Copa_Larga_Highball1.png',30,40);
/*!40000 ALTER TABLE `vajilla` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-17  9:02:39
