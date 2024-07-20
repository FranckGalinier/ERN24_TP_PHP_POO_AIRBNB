-- MySQL dump 10.13  Distrib 5.7.29, for Linux (x86_64)
--
-- Host: localhost    Database: appliAirbnb
-- ------------------------------------------------------
-- Server version	5.7.29

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES UTF8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `equipements`
--

DROP TABLE IF EXISTS `equipements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equipements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipements`
--

LOCK TABLES `equipements` WRITE;
/*!40000 ALTER TABLE `equipements` DISABLE KEYS */;
INSERT INTO `equipements` VALUES (1,'Produits de nettoyage','Salle de bain','produit.svg'),(2,'Shampooing','Salle de bain','shampooing.svg'),(3,'Douche extérieure','Salle de bain','douche-ex.svg'),(4,'Eau chaude','Salle de bain','eau-chaude.svg'),(5,'Lave-linge','Chambre et linge','lave-linge.svg'),(6,'Draps','Chambre et linge','draps.svg'),(7,'Oreillers et couvertures supplémentaires','Chambre et linge','oreiller.svg'),(8,'Stores','Chambre et linge','store.svg'),(9,'Fer à repasser','Chambre et linge','fer.svg'),(10,'Étendoir à linge','Chambre et linge','etendoir.svg'),(11,'TV HD','Divertissement','tv.svg'),(12,'Système audio','Divertissement','audio.svg'),(13,'Lit pour bébé','Famille','lit-baby.svg'),(14,'Lit parapluie','Famille','lit-parapluie.svg'),(15,'Jouets et livres pour enfants','Famille','jouet.svg'),(16,'Baignoire pour bébés','Famille','baignoir-baby.svg'),(17,'Vaisselle pour enfants','Famille','vaisselle-baby.svg'),(18,'Caches-prises','Famille','cache-prise.svg'),(19,'Barrières de sécurité pour bébé','Famille','security-barriere.svg'),(20,'Climatisation centrale','Chauffage et climisation','clim.svg'),(21,'Chauffage central','Chauffage et climisation','chauffage.svg'),(22,'Wi-Fi','Internet et bureau','wifi.svg'),(23,'Espace de travail','Internet et bureau','bureau.svg'),(24,'Cuisine','Cuisine et salle à manger','cuisine.svg'),(25,'Réfrigérateur','Cuisine et salle à manger','frigo.svg'),(26,'Four à micro-ondes','Cuisine et salle à manger','microndes.svg'),(27,'Équipements de cuisine de base','Cuisine et salle à manger','ustensible.svg'),(28,'Vaisselle et couverts','Cuisine et salle à manger','vaisselle.svg'),(29,'Four','Cuisine et salle à manger','four.svg'),(30,'Bouilloire électrique','Cuisine et salle à manger','bouilloire.svg'),(31,'Cafetière','Cuisine et salle à manger','cafetiere.svg'),(32,'Grille-pain','Cuisine et salle à manger','grille-pain.svg'),(33,'Table à manger','Cuisine et salle à manger','table-manger.svg'),(34,'Plaque de cuisson','Cuisine et salle à manger','plaque.svg'),(35,'Entrée privée','Caractéristiques','entrer.svg'),(36,'Entrée public','Caractéristiques','entrer.svg'),(37,'Privé : patio ou balcon','Extérieur','balcon.svg'),(38,'Mobilier extérieur','Extérieur','mobilier.svg'),(39,'Espace repas en plein air','Extérieur','mobilier.svg'),(40,'Barbecue','Extérieur','barbecue.svg'),(41,'Vélos','Extérieur','velo.svg'),(42,'Chaises longues','Extérieur','chaise-longue.svg'),(43,'Parking privé (2 places)','Parking et installations','voiture.svg'),(44,'Parking gratuit dans la rue','Parking et installations','voiture.svg');
/*!40000 ALTER TABLE `equipements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favoris`
--

DROP TABLE IF EXISTS `favoris`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `favoris` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `logement_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_logement_id` (`logement_id`),
  KEY `fk_user_id` (`user_id`),
  CONSTRAINT `fk_logement_id` FOREIGN KEY (`logement_id`) REFERENCES `logement` (`id`),
  CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favoris`
--

LOCK TABLES `favoris` WRITE;
/*!40000 ALTER TABLE `favoris` DISABLE KEYS */;
/*!40000 ALTER TABLE `favoris` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `information`
--

DROP TABLE IF EXISTS `information`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `information` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zip_code` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `information`
--

LOCK TABLES `information` WRITE;
/*!40000 ALTER TABLE `information` DISABLE KEYS */;
INSERT INTO `information` VALUES (1,'13 Cami Vall Lloreres, France métropolitaine','Paris','0','France','668581561'),(2,'13 Cami Vall Lloreres, France métropolitaine','Saint-Etienne','0','France','668581561'),(3,'13 Cami Vall Lloreres, France métropolitaine','Myon','0','France','668581561'),(4,'13 Cami Vall Lloreres, France métropolitaine','Perpignan','0','France','668581561'),(5,'13 Cami Vall Lloreres, France métropolitaine','Saint-Estève','0','France','668581561'),(6,'Plage de saint-cyp','Prades','0','France','755886699'),(7,'Pyrénées','Mont-louis','66500','France','668581561'),(8,'dfgdf','Port','4545','dfgfdg','4545'),(9,'fdgdfg','Ille','44','jhf','44'),(10,'Chemin de la montagne','FONT-ROMEU','66500','FRANCE','2254585'),(11,'13 Cami Vall Lloreres, France métropolitaine','RIGARDA','66320','France','668581561'),(12,'13 Cami Vall Lloreres, France métropolitaine','RIGARDA','66320','France','668581561'),(13,'13 Cami Vall Lloreres, France métropolitaine','RIGARDA','66320','France','668581561'),(14,'5 rue du chaufour','Rozerieulles','57160','france','781357076'),(15,'Avenue julien panchot','Perpignan','66','france','102030405');
/*!40000 ALTER TABLE `information` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logement`
--

DROP TABLE IF EXISTS `logement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `nb_rooms` int(11) NOT NULL,
  `nb_traveler` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `information_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type_logement_id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `information_id` (`information_id`),
  KEY `user_id` (`user_id`),
  KEY `type_logement_id` (`type_logement_id`),
  CONSTRAINT `logement_ibfk_1` FOREIGN KEY (`information_id`) REFERENCES `information` (`id`),
  CONSTRAINT `logement_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `logement_ibfk_3` FOREIGN KEY (`type_logement_id`) REFERENCES `typeLogement` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logement`
--

LOCK TABLES `logement` WRITE;
/*!40000 ALTER TABLE `logement` DISABLE KEYS */;
INSERT INTO `logement` VALUES (1,'tipi sur la plage','très belle plage',3,1,1,1,6,2,1,0),(2,'Chalet à la montagne','trèes belle montagna',77,2,1,23,7,2,1,0),(3,'gdfgfd','dfgdf',454,1,1,1,8,2,1,1),(4,'PizzzaPapa','dhgdf',474,1,1,1,9,2,1,0),(5,'Chalet à la montagne','Belle propriété, de belle randonnées à faire',60,1,2,50,10,3,1,0),(6,'fdgfdg','dfgfd',44,1,1,1,11,2,1,0),(7,'fgdsfsdf','dsf',44,1,1,1,12,2,1,0),(8,'fgdsfsdf','dsf',44,1,1,1,13,2,1,0),(9,'Maison de eymeric','super petite maison',50,1,1,1,14,4,2,0),(10,'Maison d&#039;une pute','Si tu souhaites passer un bon moment réserves chez moi !',25,1,1,1,15,4,1,0);
/*!40000 ALTER TABLE `logement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logement_equipement`
--

DROP TABLE IF EXISTS `logement_equipement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logement_equipement` (
  `logement_id` int(11) NOT NULL,
  `equipement_id` int(11) NOT NULL,
  KEY `logement_id` (`logement_id`),
  KEY `equipement_id` (`equipement_id`),
  CONSTRAINT `logement_equipement_ibfk_1` FOREIGN KEY (`logement_id`) REFERENCES `logement` (`id`),
  CONSTRAINT `logement_equipement_ibfk_2` FOREIGN KEY (`equipement_id`) REFERENCES `equipements` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logement_equipement`
--

LOCK TABLES `logement_equipement` WRITE;
/*!40000 ALTER TABLE `logement_equipement` DISABLE KEYS */;
INSERT INTO `logement_equipement` VALUES (1,4),(1,5),(1,6),(2,27),(2,34),(2,35),(2,41),(2,42),(3,5),(3,13),(4,5),(4,6),(4,7),(4,13),(4,14),(4,15),(4,20),(4,21),(4,28),(4,36),(5,4),(5,12),(5,19),(5,26),(5,33),(5,40),(6,5),(6,13),(6,20),(8,5),(8,13),(8,20),(9,5),(9,28),(9,29),(9,30),(9,39),(10,2),(10,3),(10,4),(10,5),(10,11),(10,14),(10,21);
/*!40000 ALTER TABLE `logement_equipement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `logement_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `logement_id` (`logement_id`),
  CONSTRAINT `media_ibfk_1` FOREIGN KEY (`logement_id`) REFERENCES `logement` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
INSERT INTO `media` VALUES (1,'appart','appart1.jpg',1,1),(2,'plage','images.jpeg',1,1);
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_number` varchar(255) NOT NULL,
  `date_start` varchar(255) NOT NULL,
  `date_end` varchar(255) NOT NULL,
  `nb_adults` int(11) NOT NULL,
  `nb_child` int(11) NOT NULL,
  `price_total` float NOT NULL,
  `logement_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `logement_id` (`logement_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`logement_id`) REFERENCES `logement` (`id`),
  CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservation`
--

LOCK TABLES `reservation` WRITE;
/*!40000 ALTER TABLE `reservation` DISABLE KEYS */;
INSERT INTO `reservation` VALUES (1,'ORDER\'20240618_000001','2024-06-21','2024-06-22',2,0,77,2,3),(2,'ORDER\'20240618_000002','2024-06-20','2024-06-21',1,0,77,2,3),(3,'ORDER\'20240618_000003','2024-06-19','2024-06-27',3,1,480,5,4);
/*!40000 ALTER TABLE `reservation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `typeLogement`
--

DROP TABLE IF EXISTS `typeLogement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `typeLogement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `typeLogement`
--

LOCK TABLES `typeLogement` WRITE;
/*!40000 ALTER TABLE `typeLogement` DISABLE KEYS */;
INSERT INTO `typeLogement` VALUES (1,'Propriété entière','none',1),(2,'Chambre privée','none',1),(3,'Chambre partagée','none',1);
/*!40000 ALTER TABLE `typeLogement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `information_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `information_id` (`information_id`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`information_id`) REFERENCES `information` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'fgalinier51@gmail.com','Admin1234','rdg','dfg',1,1,1),(2,'admin@admin.com','$2y$10$ZY6vJ7nzl64JlGNLe1Imn.ls3fwl1bm0D3aw.DQN2Nu8qMBC46HNa','GALINIER','Franck',1,0,1),(3,'admin2@admin.com','$2y$10$ZW2QWVfe.nQS6Vbft.sIzOoUIFKs5yQ4XyCRJHfsNBMyE9snolgu6','GALINIER','Franck',1,0,NULL),(4,'dfsrfsd@hortm.xn--fr-fsa','$2y$10$M68lA/DBhqSSTsPX0gZaGOTwWk2k/by87zTIyaOOXveN032YD9mqO','efsf','fsefs',1,0,NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-07-06 21:33:44
