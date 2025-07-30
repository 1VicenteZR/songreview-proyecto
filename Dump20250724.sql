CREATE DATABASE  IF NOT EXISTS `api_canciones` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `api_canciones`;
-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: localhost    Database: api_canciones
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

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
-- Table structure for table `album_artista`
--

DROP TABLE IF EXISTS `album_artista`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `album_artista` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `album_id` bigint(20) unsigned NOT NULL,
  `artista_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `album_artista_album_id_foreign` (`album_id`),
  KEY `album_artista_artista_id_foreign` (`artista_id`),
  CONSTRAINT `album_artista_album_id_foreign` FOREIGN KEY (`album_id`) REFERENCES `albumes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `album_artista_artista_id_foreign` FOREIGN KEY (`artista_id`) REFERENCES `artistas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `album_artista`
--

LOCK TABLES `album_artista` WRITE;
/*!40000 ALTER TABLE `album_artista` DISABLE KEYS */;
INSERT INTO `album_artista` VALUES (1,1,1,NULL,NULL);
/*!40000 ALTER TABLE `album_artista` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `albumes`
--

DROP TABLE IF EXISTS `albumes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `albumes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `fecha_lanzamiento` date NOT NULL,
  `urlSpotify` varchar(255) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `albumes`
--

LOCK TABLES `albumes` WRITE;
/*!40000 ALTER TABLE `albumes` DISABLE KEYS */;
INSERT INTO `albumes` VALUES (1,'Graduation','2007-09-11','https://open.spotify.com/album/4SZko61aMnmgvNhfhgTuD3?si=sCBf7w26RyKJKOagb_p1zw','assets/4axp0b55.png','2025-07-24 10:14:53','2025-07-24 20:09:37');
/*!40000 ALTER TABLE `albumes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `artista_cancion`
--

DROP TABLE IF EXISTS `artista_cancion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `artista_cancion` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `artista_id` bigint(20) unsigned NOT NULL,
  `cancion_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `artista_cancion_artista_id_foreign` (`artista_id`),
  KEY `artista_cancion_cancion_id_foreign` (`cancion_id`),
  CONSTRAINT `artista_cancion_artista_id_foreign` FOREIGN KEY (`artista_id`) REFERENCES `artistas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `artista_cancion_cancion_id_foreign` FOREIGN KEY (`cancion_id`) REFERENCES `canciones` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artista_cancion`
--

LOCK TABLES `artista_cancion` WRITE;
/*!40000 ALTER TABLE `artista_cancion` DISABLE KEYS */;
INSERT INTO `artista_cancion` VALUES (1,1,3,NULL,NULL),(2,1,1,NULL,NULL),(3,1,4,NULL,NULL),(4,1,5,NULL,NULL),(5,1,6,NULL,NULL),(6,2,6,NULL,NULL),(7,1,7,NULL,NULL),(8,1,8,NULL,NULL),(9,3,8,NULL,NULL),(10,1,9,NULL,NULL),(11,4,9,NULL,NULL),(12,1,10,NULL,NULL),(13,5,10,NULL,NULL),(14,1,11,NULL,NULL),(15,6,11,NULL,NULL),(16,1,12,NULL,NULL),(17,1,13,NULL,NULL),(18,7,13,NULL,NULL),(19,1,14,NULL,NULL);
/*!40000 ALTER TABLE `artista_cancion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `artistas`
--

DROP TABLE IF EXISTS `artistas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `artistas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `urlSpotify` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artistas`
--

LOCK TABLES `artistas` WRITE;
/*!40000 ALTER TABLE `artistas` DISABLE KEYS */;
INSERT INTO `artistas` VALUES (1,'Kanye West','Kanye West, also known as Ye, is a highly influential American rapper, singer, songwriter, record producer, fashion designer, and entrepreneur. He is known for his distinctive musical style, which blends hip-hop with various other genres, and for his often controversial public persona and outspoken commentary. West\'s career began as a producer before he transitioned to solo artist, achieving widespread success with albums like The College Dropout, Late Registration, and Graduation.','assets/uvjozzcv.png','https://open.spotify.com/artist/5K4W6rqBFWDnAN6FQUkS6x?si=9ktOhrEPQYevUO32ECMydQ','2025-07-24 10:14:50','2025-07-24 10:14:50'),(2,'T-Pain','T-Pain, born Faheem Rasheed Najm on September 30, 1984, is an American rapper, singer, songwriter, and record producer known for popularizing the creative use of Auto-Tune in music.','assets/tpain.png','https://open.spotify.com/artist/3aQeKQSyrW4qWr35idm0cy?si=OYN0EC5GQveD_oP7QSUEww','2025-07-24 20:19:24','2025-07-24 20:19:24'),(3,'Lil Wayne','Lil Wayne, born Dwayne Michael Carter Jr., is an American rapper widely regarded as one of the most influential hip-hop artists of his generation and one of the greatest rappers of all time','assets/lilwayne.png','https://open.spotify.com/artist/55Aa2cqylxrFIXC767Z865?si=abVhM9uFTEegQkRZQ0gvMw','2025-07-24 20:22:56','2025-07-24 20:22:56'),(4,'Mos Def','Mos Def, also known as Yasiin Bey, is an American rapper, singer, songwriter, and actor, known for his conscious hip hop and impactful social commentary. He\'s recognized for his thought-provoking lyrics, engaging performances, and versatile artistic career that spans music, acting, and activism.','assets/mos.png','https://open.spotify.com/artist/0Mz5XE0kb1GBnbLQm2VbcO?si=KYNiwNFIQb2NsGB9MuQPmA','2025-07-24 20:26:12','2025-07-24 20:26:12'),(5,'Dwele','Dwele, born Andwele Gardner on February 14, 1978, is an American R&B and soul singer, songwriter, and producer from Detroit, Michigan. He\'s known for his work with artists like Slum Village, Kanye West, and Common, and for his own critically acclaimed albums, including his 2003 debut, Subject. Dwele\'s music blends neo-soul with jazz and hip-hop influences, creating a unique sound often described as -smoky café soul-.','assets/Dwele.png','https://open.spotify.com/artist/7u6LfVyYpEzMpHLL7jTyvU?si=HaITC45xRcW7z7gtcDgKtA','2025-07-24 20:28:52','2025-07-24 20:28:52'),(6,'DJ Premier','DJ Premier, born Christopher Edward Martin on March 21, 1966, is a highly acclaimed American record producer and DJ, widely regarded as one of the greatest in hip-hop. He\'s best known as one half of the legendary duo Gang Starr with the late Guru, and for his distinctive boom bap production style, characterized by intricate samples and scratched elements.','assets/DJ Premier.png','https://open.spotify.com/artist/6GEykX11lQqp92UVOQQCC7?si=RtTvxYS4QF2yX3ArjmS2PA','2025-07-24 20:31:09','2025-07-24 20:31:09'),(7,'Chris Martin','Christopher Anthony John Martin (born 2 March 1977) is an English singer, songwriter, musician and producer. He is best known as the vocalist, pianist and co-founder of the rock band Coldplay.','assets/Chris Martin.png','https://open.spotify.com/artist/0LQoZQIV0mIs0y0XQb0Sw2?si=LwtZMvX6QbGCWuw-Pnl-3w','2025-07-24 20:34:49','2025-07-24 20:34:49');
/*!40000 ALTER TABLE `artistas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `calificacion_album`
--

DROP TABLE IF EXISTS `calificacion_album`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `calificacion_album` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `usuario_id` bigint(20) unsigned NOT NULL,
  `album_id` bigint(20) unsigned NOT NULL,
  `calificacion` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `calificacion_album_usuario_id_foreign` (`usuario_id`),
  KEY `calificacion_album_album_id_foreign` (`album_id`),
  CONSTRAINT `calificacion_album_album_id_foreign` FOREIGN KEY (`album_id`) REFERENCES `albumes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `calificacion_album_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calificacion_album`
--

LOCK TABLES `calificacion_album` WRITE;
/*!40000 ALTER TABLE `calificacion_album` DISABLE KEYS */;
/*!40000 ALTER TABLE `calificacion_album` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `calificacion_cancion`
--

DROP TABLE IF EXISTS `calificacion_cancion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `calificacion_cancion` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `usuario_id` bigint(20) unsigned NOT NULL,
  `cancion_id` bigint(20) unsigned NOT NULL,
  `calificacion` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `calificacion_cancion_usuario_id_foreign` (`usuario_id`),
  KEY `calificacion_cancion_cancion_id_foreign` (`cancion_id`),
  CONSTRAINT `calificacion_cancion_cancion_id_foreign` FOREIGN KEY (`cancion_id`) REFERENCES `canciones` (`id`) ON DELETE CASCADE,
  CONSTRAINT `calificacion_cancion_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calificacion_cancion`
--

LOCK TABLES `calificacion_cancion` WRITE;
/*!40000 ALTER TABLE `calificacion_cancion` DISABLE KEYS */;
/*!40000 ALTER TABLE `calificacion_cancion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `canciones`
--

DROP TABLE IF EXISTS `canciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `canciones` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `urlSpotify` varchar(255) DEFAULT NULL,
  `album_id` bigint(20) unsigned NOT NULL,
  `duracion` int(11) NOT NULL,
  `ruta_audio` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `canciones_album_id_foreign` (`album_id`),
  CONSTRAINT `canciones_album_id_foreign` FOREIGN KEY (`album_id`) REFERENCES `albumes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `canciones`
--

LOCK TABLES `canciones` WRITE;
/*!40000 ALTER TABLE `canciones` DISABLE KEYS */;
INSERT INTO `canciones` VALUES (1,'Good Morning','https://open.spotify.com/track/6MXXY2eiWkpDCezVCc0cMH?si=739f0c365e974905',1,189,NULL,'2025-07-24 19:27:29','2025-07-24 20:46:41'),(3,'Champion','https://open.spotify.com/track/4UQMOPSUVJVicIQzjAcRRZ?si=817f5b086c2146e6',1,167,NULL,'2025-07-24 19:48:41','2025-07-24 20:41:10'),(4,'Stronger','https://open.spotify.com/track/0j2T0R9dR9qdJYsB7ciXhf?si=5255828bd0f44d3f',1,312,NULL,'2025-07-24 19:57:43','2025-07-24 20:47:53'),(5,'I Wonder','https://open.spotify.com/track/7rbECVPkY5UODxoOUVKZnA?si=62d31a8793e94f62',1,241,NULL,'2025-07-24 19:58:03','2025-07-24 20:48:38'),(6,'Good Life (feat. T-Pain)','https://open.spotify.com/track/4ZPdLEztrlZqbJkgHNw54L?si=2f9aa2ca496243ef',1,214,NULL,'2025-07-24 19:58:13','2025-07-24 20:56:09'),(7,'Can\'t Tell Me Nothing','https://open.spotify.com/track/0mEdbdeRFQwBhN4xfyIeUM?si=c39f33f40b02442a',1,267,NULL,'2025-07-24 19:58:29','2025-07-24 20:57:02'),(8,'Barry Bonds (feat. Lil Wayne)','https://open.spotify.com/track/7387VaiHpOsSIZ5nmjseya?si=cdcf3bbb76ae4c5d',1,188,NULL,'2025-07-24 19:58:42','2025-07-24 20:58:54'),(9,'Drunk and Hot Girls (feat. Mos Def)','https://open.spotify.com/track/7DRuzSlhjKadgdsQRYZ0tr?si=640e241be6954394',1,310,NULL,'2025-07-24 19:58:51','2025-07-24 21:07:19'),(10,'Flashing Lights (feat. Dwele)','https://open.spotify.com/track/5TRPicyLGbAF2LGBFbHGvO?si=21e6c4d1c77442d3',1,227,NULL,'2025-07-24 19:59:06','2025-07-24 21:11:50'),(11,'Everything I Am (feat. DJ Premier)','https://open.spotify.com/track/0NrtwAmRAdLxua31SzHvXr?si=ad8614aa0e644b3d',1,203,NULL,'2025-07-24 19:59:18','2025-07-24 21:25:52'),(12,'The Glory','https://open.spotify.com/track/0lWjRSzq5chA9fps3pM8Zr?si=b931f4a420b04d6b',1,215,NULL,'2025-07-24 19:59:29','2025-07-24 21:26:23'),(13,'Homecoming (feat. Chris Martin)','https://open.spotify.com/track/4iz9lGMjU1lXS51oPmUmTe?si=481b420b358a4f25',1,223,NULL,'2025-07-24 19:59:38','2025-07-24 21:27:41'),(14,'Big Brother','https://open.spotify.com/track/2L47m9erkB5KBZcaqWtYen?si=65e0cf14a3b64c7f',1,289,NULL,'2025-07-24 20:00:01','2025-07-24 21:28:10');
/*!40000 ALTER TABLE `canciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
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
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2025_07_23_132248_create_usuarios_table',1),(6,'2025_07_23_132259_create_artistas_table',1),(7,'2025_07_23_132308_create_albums_table',1),(8,'2025_07_23_132315_create_cancions_table',1),(9,'2025_07_23_132324_create_calificacion_albums_table',1),(10,'2025_07_23_132334_create_calificacion_cancions_table',1),(11,'2025_07_23_132340_create_playlists_table',1),(12,'2025_07_23_132346_create_playlist_cancions_table',1),(13,'2025_07_23_200000_create_album_artista_table',1),(14,'2025_07_24_132836_create_artista_cancion_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `playlist_cancion`
--

DROP TABLE IF EXISTS `playlist_cancion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `playlist_cancion` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `playlist_id` bigint(20) unsigned NOT NULL,
  `cancion_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `playlist_cancion_playlist_id_foreign` (`playlist_id`),
  KEY `playlist_cancion_cancion_id_foreign` (`cancion_id`),
  CONSTRAINT `playlist_cancion_cancion_id_foreign` FOREIGN KEY (`cancion_id`) REFERENCES `canciones` (`id`) ON DELETE CASCADE,
  CONSTRAINT `playlist_cancion_playlist_id_foreign` FOREIGN KEY (`playlist_id`) REFERENCES `playlists` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `playlist_cancion`
--

LOCK TABLES `playlist_cancion` WRITE;
/*!40000 ALTER TABLE `playlist_cancion` DISABLE KEYS */;
/*!40000 ALTER TABLE `playlist_cancion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `playlists`
--

DROP TABLE IF EXISTS `playlists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `playlists` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `usuario_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `playlists_usuario_id_foreign` (`usuario_id`),
  CONSTRAINT `playlists_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `playlists`
--

LOCK TABLES `playlists` WRITE;
/*!40000 ALTER TABLE `playlists` DISABLE KEYS */;
/*!40000 ALTER TABLE `playlists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('admin','cliente') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuarios_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Eric Juarez','eric.aaron.jf@gmail.com','$2y$12$PHhtz1qIOEuycAoGTLyiNe2IRIgETz9ZB6JS0xAwSmX7u66XJuj2S','cliente','2025-07-25 00:07:03','2025-07-25 00:12:12'),(2,'Eric Juarez','21161599@itoaxaca.edu.mx','$2y$12$XNxzhI9NItaue0UeScAbKeQImbyHkHuE.4csGFuwWuP165If0sj9i','admin','2025-07-25 00:13:31','2025-07-25 00:13:31'),(3,'Vicente de Jesús zenón regalado','vicenteregalado11@hotmail.com','$2y$12$NKeovywSMfwZHnis8vlX1OmA66d.m4f9du1ZLlY0yUl86bLqud8wG','cliente','2025-07-25 00:18:04','2025-07-25 00:18:04');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-07-24 19:26:20
