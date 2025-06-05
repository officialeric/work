-- MySQL dump 10.13  Distrib 8.0.42, for Win64 (x86_64)
--
-- Host: localhost    Database: work
-- ------------------------------------------------------
-- Server version	8.0.42

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
-- Table structure for table `accommodation_sections`
--

DROP TABLE IF EXISTS `accommodation_sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `accommodation_sections` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `main_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accommodation_sections`
--

LOCK TABLES `accommodation_sections` WRITE;
/*!40000 ALTER TABLE `accommodation_sections` DISABLE KEYS */;
INSERT INTO `accommodation_sections` VALUES (1,'Luxury Accommodations','We offers 12 exceptional rooms, divided between 4 family villas and 8 elegantly appointed double villas. The family villas, each measuring a minimum of 25 m², include a living room, two separate bedrooms and a small office with comfortable armchairs.','accommodation-sections/baFm1xqyrJAA5NhxQUVUF9yXH0axaNhFuQqZJ3Eg.jpg','accommodation-sections/gwk6sKkOIT8dWjU1tnvKiOxntI5KK5OCttk0ovuJ.jpg','accommodation-sections/IeJkIfQH6tbYSKaMgNJmTantPD6DR2caquVBRP48.jpg',1,1,'2025-06-05 11:15:05','2025-06-05 11:18:10');
/*!40000 ALTER TABLE `accommodation_sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `activities`
--

DROP TABLE IF EXISTS `activities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `activities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activities`
--

LOCK TABLES `activities` WRITE;
/*!40000 ALTER TABLE `activities` DISABLE KEYS */;
INSERT INTO `activities` VALUES (1,'Madete Beach','Enjoy **Madete Beach**, an exceptional protected sanctuary. Both a national park and a marine park, accessible only to authorized visitors, this stretch of white sand stretches for 5 km around the lodge, offering bathing at any time, with very little tidal variation.','1/7','https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=600&h=400&fit=crop&crop=center',1,1,'2025-06-05 11:15:05','2025-06-05 11:15:05'),(2,'Safari in Saadani National Park','Go on **safari in Saadani National Park**, where remarkable wildlife awaits you: a dozen species of antelope, monkeys, warthogs, majestic elephants, elegant giraffes, imposing buffalo, and even lions on the loose.','2/7','https://images.unsplash.com/photo-1516426122078-c23e76319801?w=600&h=400&fit=crop&crop=center',2,1,'2025-06-05 11:15:05','2025-06-05 11:15:05'),(3,'Wami River Boat Trip','Take a boat trip **up the Wami River** to observe crocodiles, hippos and a rich diversity of birds. A magical moment on the water, in the heart of the wilderness.','3/7','https://images.unsplash.com/photo-1544551763-77ef2d0cfc6c?w=600&h=400&fit=crop&crop=center',3,1,'2025-06-05 11:15:05','2025-06-05 11:15:05'),(4,'Fishing Villages','Discover local life by visiting **fishing villages**. Live an authentic experience by embarking with them for a traditional fishing session in the waters of the Indian Ocean.','4/7','https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=600&h=400&fit=crop&crop=center',4,1,'2025-06-05 11:15:05','2025-06-05 11:15:05'),(5,'Mafui Sandbank','**Sail to Mafui Sandbank**, a secluded sandbar just 5 km from the beach. This idyllic spot is a small paradise for divers and snorkelers, surrounded by crystal-clear waters.','5/7','https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=600&h=400&fit=crop&crop=center',5,1,'2025-06-05 11:15:05','2025-06-05 11:15:05'),(6,'Sunset Cruise','Enjoy a **sunset cruise**, a sea excursion to admire the golden hues of the sunset.','6/7','https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=600&h=400&fit=crop&crop=center',6,1,'2025-06-05 11:15:05','2025-06-05 11:15:05'),(7,'Explore the Mangroves','**Explore the mangroves** on foot along the beach or by gallawas, the traditional boats of the Tanzanian coast.','7/7','https://images.unsplash.com/photo-1547036967-23d11aacaee0?w=600&h=400&fit=crop&crop=center',7,1,'2025-06-05 11:15:05','2025-06-05 11:15:05');
/*!40000 ALTER TABLE `activities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_activity_logs`
--

DROP TABLE IF EXISTS `admin_activity_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_activity_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` bigint unsigned NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_id` bigint unsigned DEFAULT NULL,
  `old_values` json DEFAULT NULL,
  `new_values` json DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_activity_logs_admin_id_foreign` (`admin_id`),
  CONSTRAINT `admin_activity_logs_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_activity_logs`
--

LOCK TABLES `admin_activity_logs` WRITE;
/*!40000 ALTER TABLE `admin_activity_logs` DISABLE KEYS */;
INSERT INTO `admin_activity_logs` VALUES (1,1,'login',NULL,NULL,NULL,NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','2025-06-05 11:16:24','2025-06-05 11:16:24'),(2,1,'updated',NULL,NULL,'{\"favicon\": \"\", \"site_logo\": \"\", \"site_name\": \"Cterra Saadani Luxury\", \"hero_title\": \"Discover Unparalleled\", \"hero_video\": \"\", \"twitter_url\": \"\", \"facebook_url\": \"https://facebook.com/cterrasaadani\", \"site_tagline\": \"Luxury Eco-Lodge Tanzania\", \"contact_email\": \"info@cterra.co.tz\", \"contact_phone\": \"+255 783 442 868\", \"hero_subtitle\": \"Hospitality\", \"instagram_url\": \"https://www.instagram.com/cterra.saadani\", \"meta_keywords\": \"luxury eco-lodge, Tanzania, safari, Indian Ocean, sustainable tourism, Saadani National Park\", \"contact_address\": \"Tanzania\", \"google_analytics\": \"\", \"hero_description\": \"Unmatched hospitality. Luxurious stays. Personalized service. Unforgettable experiences. Elevate your journey with us.\", \"site_description\": \"Escape the mundane and explore the untamed beauty of Saadani at our latest addition to the Cterra Collection.\"}','{\"favicon\": \"settings/ouxZ1wY2WgJ02Z9Y9WIDkKNEOLfZcQAHrn6Aq6JY.png\", \"site_logo\": \"settings/ybLgmslU6XcKaSqN0ACq5CjoEBE1dU81KsTmc0xI.png\", \"site_name\": \"Cterra Saadani Luxury\", \"hero_title\": \"Discover Unparalleled\", \"hero_video\": null, \"twitter_url\": null, \"facebook_url\": \"https://facebook.com/cterrasaadani\", \"site_tagline\": \"Luxury Eco-Lodge Tanzania\", \"contact_email\": \"info@cterra.co.tz\", \"contact_phone\": \"+255 783 442 868\", \"hero_subtitle\": \"Hospitality\", \"instagram_url\": \"https://www.instagram.com/cterra.saadani\", \"meta_keywords\": \"luxury eco-lodge, Tanzania, safari, Indian Ocean, sustainable tourism, Saadani National Park\", \"contact_address\": \"Tanzania\", \"google_analytics\": null, \"hero_description\": \"Unmatched hospitality. Luxurious stays. Personalized service. Unforgettable experiences. Elevate your journey with us.\", \"site_description\": \"Escape the mundane and explore the untamed beauty of Saadani at our latest addition to the Cterra Collection.\"}','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','2025-06-05 11:16:53','2025-06-05 11:16:53'),(3,1,'updated','App\\Models\\AccommodationSection',1,'{\"id\": 1, \"title\": \"Luxury Accommodations\", \"image_1\": null, \"image_2\": null, \"is_active\": true, \"created_at\": \"2025-06-05T14:15:05.000000Z\", \"main_image\": null, \"sort_order\": 1, \"updated_at\": \"2025-06-05T14:15:05.000000Z\", \"description\": \"We offers 12 exceptional rooms, divided between 4 family villas and 8 elegantly appointed double villas. The family villas, each measuring a minimum of 25 m², include a living room, two separate bedrooms and a small office with comfortable armchairs.\"}','{\"id\": 1, \"title\": \"Luxury Accommodations\", \"image_1\": \"accommodation-sections/gwk6sKkOIT8dWjU1tnvKiOxntI5KK5OCttk0ovuJ.jpg\", \"image_2\": \"accommodation-sections/IeJkIfQH6tbYSKaMgNJmTantPD6DR2caquVBRP48.jpg\", \"is_active\": true, \"created_at\": \"2025-06-05T14:15:05.000000Z\", \"main_image\": \"accommodation-sections/baFm1xqyrJAA5NhxQUVUF9yXH0axaNhFuQqZJ3Eg.jpg\", \"sort_order\": 1, \"updated_at\": \"2025-06-05T14:18:10.000000Z\", \"description\": \"We offers 12 exceptional rooms, divided between 4 family villas and 8 elegantly appointed double villas. The family villas, each measuring a minimum of 25 m², include a living room, two separate bedrooms and a small office with comfortable armchairs.\"}','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','2025-06-05 11:18:10','2025-06-05 11:18:10'),(4,1,'updated','App\\Models\\Location',1,'{\"id\": 1, \"title\": \"Location\", \"image_1\": \"https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?w=600&h=800&fit=crop&crop=center\", \"image_2\": \"https://images.unsplash.com/photo-1547036967-23d11aacaee0?w=600&h=400&fit=crop&crop=center\", \"image_3\": \"https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=600&h=300&fit=crop&crop=center\", \"subtitle\": \"A breathtaking setting\", \"is_active\": true, \"created_at\": \"2025-06-05T14:15:05.000000Z\", \"sort_order\": 1, \"updated_at\": \"2025-06-05T14:15:05.000000Z\", \"button_link\": \"#gallery\", \"button_text\": \"View Gallery\", \"description\": \"100 km north of Dar es Salaam, facing the island of Zanzibar, discover Saadani Kasa Bay. Nestled between a pristine white sand beach and the infinite blue of the Indian Ocean, this unique lodge offers an idyllic setting where luxury meets untamed nature.\", \"additional_description\": \"On the land side, Saadani National Park reveals a mosaic of fascinating landscapes and exceptional wildlife, perfect for unforgettable safaris. Every moment spent here is a promise of experiences rich in emotion and authenticity, a unique adventure in the heart of Tanzania.\"}','{\"id\": 1, \"title\": \"Location\", \"image_1\": \"locations/YmGFjEz5L1oU4avN0etjW50yFezsncC7mpmMZIWN.jpg\", \"image_2\": \"locations/rI6EzVua7qgUEvYWqbEjRUNdbwzWMqlz1CLYmPBa.jpg\", \"image_3\": \"locations/73nLWalqCblOnYlY1Yn2wXsycSouvjH7tCJOn1JY.jpg\", \"subtitle\": \"A breathtaking setting\", \"is_active\": true, \"created_at\": \"2025-06-05T14:15:05.000000Z\", \"sort_order\": 1, \"updated_at\": \"2025-06-05T14:19:04.000000Z\", \"button_link\": \"#gallery\", \"button_text\": \"View Gallery\", \"description\": \"100 km north of Dar es Salaam, facing the island of Zanzibar, discover Saadani Kasa Bay. Nestled between a pristine white sand beach and the infinite blue of the Indian Ocean, this unique lodge offers an idyllic setting where luxury meets untamed nature.\", \"additional_description\": \"On the land side, Saadani National Park reveals a mosaic of fascinating landscapes and exceptional wildlife, perfect for unforgettable safaris. Every moment spent here is a promise of experiences rich in emotion and authenticity, a unique adventure in the heart of Tanzania.\"}','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','2025-06-05 11:19:04','2025-06-05 11:19:04'),(5,1,'deleted',NULL,NULL,'{\"id\": 2, \"title\": \"Sample Gallery Image 2\", \"alt_text\": \"Ocean view from lodge\", \"is_active\": true, \"created_at\": \"2025-06-05T14:15:05.000000Z\", \"image_path\": \"https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800&h=600&fit=crop&crop=center\", \"sort_order\": 2, \"updated_at\": \"2025-06-05T14:15:05.000000Z\", \"thumbnail_path\": \"https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=300&h=200&fit=crop&crop=center\"}',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','2025-06-05 11:19:33','2025-06-05 11:19:33'),(6,1,'deleted',NULL,NULL,'{\"id\": 4, \"title\": \"Sample Gallery Image 4\", \"alt_text\": \"Luxury accommodation interior\", \"is_active\": true, \"created_at\": \"2025-06-05T14:15:05.000000Z\", \"image_path\": \"https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=800&h=600&fit=crop&crop=center\", \"sort_order\": 4, \"updated_at\": \"2025-06-05T14:15:05.000000Z\", \"thumbnail_path\": \"https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=300&h=200&fit=crop&crop=center\"}',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','2025-06-05 11:19:40','2025-06-05 11:19:40'),(7,1,'deleted',NULL,NULL,'{\"id\": 1, \"title\": \"Sample Gallery Image 1\", \"alt_text\": \"Beautiful lodge view\", \"is_active\": true, \"created_at\": \"2025-06-05T14:15:05.000000Z\", \"image_path\": \"https://images.unsplash.com/photo-1571896349842-33c89424de2d?w=800&h=600&fit=crop&crop=center\", \"sort_order\": 1, \"updated_at\": \"2025-06-05T14:15:05.000000Z\", \"thumbnail_path\": \"https://images.unsplash.com/photo-1571896349842-33c89424de2d?w=300&h=200&fit=crop&crop=center\"}',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','2025-06-05 11:19:44','2025-06-05 11:19:44'),(8,1,'deleted',NULL,NULL,'{\"id\": 5, \"title\": \"Sample Gallery Image 5\", \"alt_text\": \"Sunset over the ocean\", \"is_active\": true, \"created_at\": \"2025-06-05T14:15:05.000000Z\", \"image_path\": \"https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&h=600&fit=crop&crop=center\", \"sort_order\": 5, \"updated_at\": \"2025-06-05T14:15:05.000000Z\", \"thumbnail_path\": \"https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=300&h=200&fit=crop&crop=center\"}',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','2025-06-05 11:19:47','2025-06-05 11:19:47'),(9,1,'deleted',NULL,NULL,'{\"id\": 6, \"title\": \"Sample Gallery Image 6\", \"alt_text\": \"Beach and mangroves\", \"is_active\": true, \"created_at\": \"2025-06-05T14:15:05.000000Z\", \"image_path\": \"https://images.unsplash.com/photo-1547036967-23d11aacaee0?w=800&h=600&fit=crop&crop=center\", \"sort_order\": 6, \"updated_at\": \"2025-06-05T14:15:05.000000Z\", \"thumbnail_path\": \"https://images.unsplash.com/photo-1547036967-23d11aacaee0?w=300&h=200&fit=crop&crop=center\"}',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','2025-06-05 11:19:50','2025-06-05 11:19:50'),(10,1,'deleted',NULL,NULL,'{\"id\": 3, \"title\": \"Sample Gallery Image 3\", \"alt_text\": \"Safari wildlife experience\", \"is_active\": true, \"created_at\": \"2025-06-05T14:15:05.000000Z\", \"image_path\": \"https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?w=800&h=600&fit=crop&crop=center\", \"sort_order\": 3, \"updated_at\": \"2025-06-05T14:15:05.000000Z\", \"thumbnail_path\": \"https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?w=300&h=200&fit=crop&crop=center\"}',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','2025-06-05 11:19:54','2025-06-05 11:19:54'),(11,1,'created','App\\Models\\GalleryImage',7,NULL,'{\"id\": 7, \"title\": \"WhatsApp Image 2025-06-04 at 21.48.00\", \"alt_text\": \"WhatsApp Image 2025-06-04 at 21.48.00\", \"is_active\": true, \"created_at\": \"2025-06-05T14:20:21.000000Z\", \"image_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.48.00_1749133221_0.jpeg\", \"sort_order\": 1, \"updated_at\": \"2025-06-05T14:20:21.000000Z\", \"thumbnail_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.48.00_1749133221_0.jpeg\"}','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','2025-06-05 11:20:21','2025-06-05 11:20:21'),(12,1,'created','App\\Models\\GalleryImage',8,NULL,'{\"id\": 8, \"title\": \"WhatsApp Image 2025-06-04 at 21.47.59\", \"alt_text\": \"WhatsApp Image 2025-06-04 at 21.47.59\", \"is_active\": true, \"created_at\": \"2025-06-05T14:20:21.000000Z\", \"image_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.59_1749133221_0.jpeg\", \"sort_order\": 2, \"updated_at\": \"2025-06-05T14:20:21.000000Z\", \"thumbnail_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.59_1749133221_0.jpeg\"}','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','2025-06-05 11:20:21','2025-06-05 11:20:21'),(13,1,'created','App\\Models\\GalleryImage',9,NULL,'{\"id\": 9, \"title\": \"WhatsApp Image 2025-06-04 at 21.47.58\", \"alt_text\": \"WhatsApp Image 2025-06-04 at 21.47.58\", \"is_active\": true, \"created_at\": \"2025-06-05T14:20:22.000000Z\", \"image_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.58_1749133222_0.jpeg\", \"sort_order\": 3, \"updated_at\": \"2025-06-05T14:20:22.000000Z\", \"thumbnail_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.58_1749133222_0.jpeg\"}','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','2025-06-05 11:20:22','2025-06-05 11:20:22'),(14,1,'created','App\\Models\\GalleryImage',10,NULL,'{\"id\": 10, \"title\": \"WhatsApp Image 2025-06-04 at 21.47.57\", \"alt_text\": \"WhatsApp Image 2025-06-04 at 21.47.57\", \"is_active\": true, \"created_at\": \"2025-06-05T14:20:23.000000Z\", \"image_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.57_1749133223_0.jpeg\", \"sort_order\": 4, \"updated_at\": \"2025-06-05T14:20:23.000000Z\", \"thumbnail_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.57_1749133223_0.jpeg\"}','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','2025-06-05 11:20:23','2025-06-05 11:20:23'),(15,1,'created','App\\Models\\GalleryImage',11,NULL,'{\"id\": 11, \"title\": \"WhatsApp Image 2025-06-04 at 21.47.56 (1)\", \"alt_text\": \"WhatsApp Image 2025-06-04 at 21.47.56 (1)\", \"is_active\": true, \"created_at\": \"2025-06-05T14:20:23.000000Z\", \"image_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.56 (1)_1749133223_0.jpeg\", \"sort_order\": 5, \"updated_at\": \"2025-06-05T14:20:23.000000Z\", \"thumbnail_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.56 (1)_1749133223_0.jpeg\"}','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','2025-06-05 11:20:23','2025-06-05 11:20:23'),(16,1,'created','App\\Models\\GalleryImage',12,NULL,'{\"id\": 12, \"title\": \"WhatsApp Image 2025-06-04 at 21.47.56\", \"alt_text\": \"WhatsApp Image 2025-06-04 at 21.47.56\", \"is_active\": true, \"created_at\": \"2025-06-05T14:20:24.000000Z\", \"image_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.56_1749133224_0.jpeg\", \"sort_order\": 6, \"updated_at\": \"2025-06-05T14:20:24.000000Z\", \"thumbnail_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.56_1749133224_0.jpeg\"}','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','2025-06-05 11:20:24','2025-06-05 11:20:24'),(17,1,'created','App\\Models\\GalleryImage',13,NULL,'{\"id\": 13, \"title\": \"WhatsApp Image 2025-06-04 at 21.47.55\", \"alt_text\": \"WhatsApp Image 2025-06-04 at 21.47.55\", \"is_active\": true, \"created_at\": \"2025-06-05T14:20:25.000000Z\", \"image_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.55_1749133225_0.jpeg\", \"sort_order\": 7, \"updated_at\": \"2025-06-05T14:20:25.000000Z\", \"thumbnail_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.55_1749133225_0.jpeg\"}','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','2025-06-05 11:20:25','2025-06-05 11:20:25'),(18,1,'created','App\\Models\\GalleryImage',14,NULL,'{\"id\": 14, \"title\": \"WhatsApp Image 2025-06-04 at 21.47.54\", \"alt_text\": \"WhatsApp Image 2025-06-04 at 21.47.54\", \"is_active\": true, \"created_at\": \"2025-06-05T14:20:26.000000Z\", \"image_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.54_1749133226_0.jpeg\", \"sort_order\": 8, \"updated_at\": \"2025-06-05T14:20:26.000000Z\", \"thumbnail_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.54_1749133226_0.jpeg\"}','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','2025-06-05 11:20:26','2025-06-05 11:20:26'),(19,1,'created','App\\Models\\GalleryImage',15,NULL,'{\"id\": 15, \"title\": \"WhatsApp Image 2025-06-04 at 21.47.53 (1)\", \"alt_text\": \"WhatsApp Image 2025-06-04 at 21.47.53 (1)\", \"is_active\": true, \"created_at\": \"2025-06-05T14:20:26.000000Z\", \"image_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.53 (1)_1749133226_0.jpeg\", \"sort_order\": 9, \"updated_at\": \"2025-06-05T14:20:26.000000Z\", \"thumbnail_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.53 (1)_1749133226_0.jpeg\"}','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','2025-06-05 11:20:26','2025-06-05 11:20:26'),(20,1,'created','App\\Models\\GalleryImage',16,NULL,'{\"id\": 16, \"title\": \"WhatsApp Image 2025-06-04 at 21.47.53\", \"alt_text\": \"WhatsApp Image 2025-06-04 at 21.47.53\", \"is_active\": true, \"created_at\": \"2025-06-05T14:20:27.000000Z\", \"image_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.53_1749133227_0.jpeg\", \"sort_order\": 10, \"updated_at\": \"2025-06-05T14:20:27.000000Z\", \"thumbnail_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.53_1749133227_0.jpeg\"}','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','2025-06-05 11:20:27','2025-06-05 11:20:27'),(21,1,'created','App\\Models\\GalleryImage',17,NULL,'{\"id\": 17, \"title\": \"WhatsApp Image 2025-06-04 at 21.47.52\", \"alt_text\": \"WhatsApp Image 2025-06-04 at 21.47.52\", \"is_active\": true, \"created_at\": \"2025-06-05T14:20:28.000000Z\", \"image_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.52_1749133228_0.jpeg\", \"sort_order\": 11, \"updated_at\": \"2025-06-05T14:20:28.000000Z\", \"thumbnail_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.52_1749133228_0.jpeg\"}','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','2025-06-05 11:20:28','2025-06-05 11:20:28'),(22,1,'created','App\\Models\\GalleryImage',18,NULL,'{\"id\": 18, \"title\": \"WhatsApp Image 2025-06-04 at 21.47.51\", \"alt_text\": \"WhatsApp Image 2025-06-04 at 21.47.51\", \"is_active\": true, \"created_at\": \"2025-06-05T14:20:29.000000Z\", \"image_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.51_1749133229_0.jpeg\", \"sort_order\": 12, \"updated_at\": \"2025-06-05T14:20:29.000000Z\", \"thumbnail_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.51_1749133229_0.jpeg\"}','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','2025-06-05 11:20:29','2025-06-05 11:20:29'),(23,1,'created','App\\Models\\GalleryImage',19,NULL,'{\"id\": 19, \"title\": \"WhatsApp Image 2025-06-04 at 21.47.49 (1)\", \"alt_text\": \"WhatsApp Image 2025-06-04 at 21.47.49 (1)\", \"is_active\": true, \"created_at\": \"2025-06-05T14:20:29.000000Z\", \"image_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.49 (1)_1749133229_0.jpeg\", \"sort_order\": 13, \"updated_at\": \"2025-06-05T14:20:29.000000Z\", \"thumbnail_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.49 (1)_1749133229_0.jpeg\"}','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','2025-06-05 11:20:29','2025-06-05 11:20:29'),(24,1,'created','App\\Models\\GalleryImage',20,NULL,'{\"id\": 20, \"title\": \"WhatsApp Image 2025-06-04 at 21.47.49\", \"alt_text\": \"WhatsApp Image 2025-06-04 at 21.47.49\", \"is_active\": true, \"created_at\": \"2025-06-05T14:20:30.000000Z\", \"image_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.49_1749133230_0.jpeg\", \"sort_order\": 14, \"updated_at\": \"2025-06-05T14:20:30.000000Z\", \"thumbnail_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.49_1749133230_0.jpeg\"}','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','2025-06-05 11:20:30','2025-06-05 11:20:30'),(25,1,'created','App\\Models\\GalleryImage',21,NULL,'{\"id\": 21, \"title\": \"WhatsApp Image 2025-06-04 at 21.47.48\", \"alt_text\": \"WhatsApp Image 2025-06-04 at 21.47.48\", \"is_active\": true, \"created_at\": \"2025-06-05T14:20:31.000000Z\", \"image_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.48_1749133231_0.jpeg\", \"sort_order\": 15, \"updated_at\": \"2025-06-05T14:20:31.000000Z\", \"thumbnail_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.48_1749133231_0.jpeg\"}','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','2025-06-05 11:20:31','2025-06-05 11:20:31'),(26,1,'created','App\\Models\\GalleryImage',22,NULL,'{\"id\": 22, \"title\": \"WhatsApp Image 2025-06-04 at 21.47.47\", \"alt_text\": \"WhatsApp Image 2025-06-04 at 21.47.47\", \"is_active\": true, \"created_at\": \"2025-06-05T14:20:32.000000Z\", \"image_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.47_1749133231_0.jpeg\", \"sort_order\": 16, \"updated_at\": \"2025-06-05T14:20:32.000000Z\", \"thumbnail_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.47_1749133231_0.jpeg\"}','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','2025-06-05 11:20:32','2025-06-05 11:20:32'),(27,1,'created','App\\Models\\GalleryImage',23,NULL,'{\"id\": 23, \"title\": \"WhatsApp Image 2025-06-04 at 21.47.46 (1)\", \"alt_text\": \"WhatsApp Image 2025-06-04 at 21.47.46 (1)\", \"is_active\": true, \"created_at\": \"2025-06-05T14:20:32.000000Z\", \"image_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.46 (1)_1749133232_0.jpeg\", \"sort_order\": 17, \"updated_at\": \"2025-06-05T14:20:32.000000Z\", \"thumbnail_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.46 (1)_1749133232_0.jpeg\"}','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','2025-06-05 11:20:32','2025-06-05 11:20:32'),(28,1,'created','App\\Models\\GalleryImage',24,NULL,'{\"id\": 24, \"title\": \"WhatsApp Image 2025-06-04 at 21.47.46\", \"alt_text\": \"WhatsApp Image 2025-06-04 at 21.47.46\", \"is_active\": true, \"created_at\": \"2025-06-05T14:20:33.000000Z\", \"image_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.46_1749133233_0.jpeg\", \"sort_order\": 18, \"updated_at\": \"2025-06-05T14:20:33.000000Z\", \"thumbnail_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.46_1749133233_0.jpeg\"}','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','2025-06-05 11:20:33','2025-06-05 11:20:33'),(29,1,'created','App\\Models\\GalleryImage',25,NULL,'{\"id\": 25, \"title\": \"WhatsApp Image 2025-06-04 at 21.47.45\", \"alt_text\": \"WhatsApp Image 2025-06-04 at 21.47.45\", \"is_active\": true, \"created_at\": \"2025-06-05T14:20:34.000000Z\", \"image_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.45_1749133234_0.jpeg\", \"sort_order\": 19, \"updated_at\": \"2025-06-05T14:20:34.000000Z\", \"thumbnail_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.45_1749133234_0.jpeg\"}','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','2025-06-05 11:20:34','2025-06-05 11:20:34'),(30,1,'created','App\\Models\\GalleryImage',26,NULL,'{\"id\": 26, \"title\": \"WhatsApp Image 2025-06-04 at 21.47.44\", \"alt_text\": \"WhatsApp Image 2025-06-04 at 21.47.44\", \"is_active\": true, \"created_at\": \"2025-06-05T14:20:34.000000Z\", \"image_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.44_1749133234_0.jpeg\", \"sort_order\": 20, \"updated_at\": \"2025-06-05T14:20:34.000000Z\", \"thumbnail_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.44_1749133234_0.jpeg\"}','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','2025-06-05 11:20:34','2025-06-05 11:20:34'),(31,1,'created','App\\Models\\GalleryImage',27,NULL,'{\"id\": 27, \"title\": \"WhatsApp Image 2025-06-04 at 21.47.43\", \"alt_text\": \"WhatsApp Image 2025-06-04 at 21.47.43\", \"is_active\": true, \"created_at\": \"2025-06-05T14:20:35.000000Z\", \"image_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.43_1749133235_0.jpeg\", \"sort_order\": 21, \"updated_at\": \"2025-06-05T14:20:35.000000Z\", \"thumbnail_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.43_1749133235_0.jpeg\"}','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','2025-06-05 11:20:35','2025-06-05 11:20:35'),(32,1,'created','App\\Models\\GalleryImage',28,NULL,'{\"id\": 28, \"title\": \"WhatsApp Image 2025-06-04 at 21.47.42 (1)\", \"alt_text\": \"WhatsApp Image 2025-06-04 at 21.47.42 (1)\", \"is_active\": true, \"created_at\": \"2025-06-05T14:20:36.000000Z\", \"image_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.42 (1)_1749133236_0.jpeg\", \"sort_order\": 22, \"updated_at\": \"2025-06-05T14:20:36.000000Z\", \"thumbnail_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.42 (1)_1749133236_0.jpeg\"}','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','2025-06-05 11:20:36','2025-06-05 11:20:36'),(33,1,'created','App\\Models\\GalleryImage',29,NULL,'{\"id\": 29, \"title\": \"WhatsApp Image 2025-06-04 at 21.47.42\", \"alt_text\": \"WhatsApp Image 2025-06-04 at 21.47.42\", \"is_active\": true, \"created_at\": \"2025-06-05T14:20:37.000000Z\", \"image_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.42_1749133237_0.jpeg\", \"sort_order\": 23, \"updated_at\": \"2025-06-05T14:20:37.000000Z\", \"thumbnail_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.42_1749133237_0.jpeg\"}','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','2025-06-05 11:20:37','2025-06-05 11:20:37'),(34,1,'created','App\\Models\\GalleryImage',30,NULL,'{\"id\": 30, \"title\": \"WhatsApp Image 2025-06-04 at 21.47.41\", \"alt_text\": \"WhatsApp Image 2025-06-04 at 21.47.41\", \"is_active\": true, \"created_at\": \"2025-06-05T14:20:37.000000Z\", \"image_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.41_1749133237_0.jpeg\", \"sort_order\": 24, \"updated_at\": \"2025-06-05T14:20:37.000000Z\", \"thumbnail_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.41_1749133237_0.jpeg\"}','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','2025-06-05 11:20:37','2025-06-05 11:20:37'),(35,1,'created','App\\Models\\GalleryImage',31,NULL,'{\"id\": 31, \"title\": \"WhatsApp Image 2025-06-04 at 21.47.40\", \"alt_text\": \"WhatsApp Image 2025-06-04 at 21.47.40\", \"is_active\": true, \"created_at\": \"2025-06-05T14:20:38.000000Z\", \"image_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.40_1749133238_0.jpeg\", \"sort_order\": 25, \"updated_at\": \"2025-06-05T14:20:38.000000Z\", \"thumbnail_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.40_1749133238_0.jpeg\"}','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','2025-06-05 11:20:38','2025-06-05 11:20:38'),(36,1,'created','App\\Models\\GalleryImage',32,NULL,'{\"id\": 32, \"title\": \"WhatsApp Image 2025-06-04 at 21.47.39 (1)\", \"alt_text\": \"WhatsApp Image 2025-06-04 at 21.47.39 (1)\", \"is_active\": true, \"created_at\": \"2025-06-05T14:20:39.000000Z\", \"image_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.39 (1)_1749133239_0.jpeg\", \"sort_order\": 26, \"updated_at\": \"2025-06-05T14:20:39.000000Z\", \"thumbnail_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.39 (1)_1749133239_0.jpeg\"}','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','2025-06-05 11:20:39','2025-06-05 11:20:39'),(37,1,'created','App\\Models\\GalleryImage',33,NULL,'{\"id\": 33, \"title\": \"WhatsApp Image 2025-06-04 at 21.47.39\", \"alt_text\": \"WhatsApp Image 2025-06-04 at 21.47.39\", \"is_active\": true, \"created_at\": \"2025-06-05T14:20:40.000000Z\", \"image_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.39_1749133240_0.jpeg\", \"sort_order\": 27, \"updated_at\": \"2025-06-05T14:20:40.000000Z\", \"thumbnail_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.39_1749133240_0.jpeg\"}','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','2025-06-05 11:20:40','2025-06-05 11:20:40'),(38,1,'created','App\\Models\\GalleryImage',34,NULL,'{\"id\": 34, \"title\": \"WhatsApp Image 2025-06-04 at 21.47.38\", \"alt_text\": \"WhatsApp Image 2025-06-04 at 21.47.38\", \"is_active\": true, \"created_at\": \"2025-06-05T14:20:40.000000Z\", \"image_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.38_1749133240_0.jpeg\", \"sort_order\": 28, \"updated_at\": \"2025-06-05T14:20:40.000000Z\", \"thumbnail_path\": \"gallery/WhatsApp Image 2025-06-04 at 21.47.38_1749133240_0.jpeg\"}','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','2025-06-05 11:20:40','2025-06-05 11:20:40'),(39,1,'updated',NULL,NULL,'{\"site_name\": \"Cterra Saadani Luxury\", \"hero_image\": \"\", \"hero_title\": \"Discover Unparalleled\", \"hero_video\": \"\", \"twitter_url\": \"\", \"facebook_url\": \"https://facebook.com/cterrasaadani\", \"site_tagline\": \"Luxury Eco-Lodge Tanzania\", \"contact_email\": \"info@cterra.co.tz\", \"contact_phone\": \"+255 783 442 868\", \"hero_subtitle\": \"Hospitality\", \"instagram_url\": \"https://www.instagram.com/cterra.saadani\", \"meta_keywords\": \"luxury eco-lodge, Tanzania, safari, Indian Ocean, sustainable tourism, Saadani National Park\", \"contact_address\": \"Tanzania\", \"google_analytics\": \"\", \"hero_description\": \"Unmatched hospitality. Luxurious stays. Personalized service. Unforgettable experiences. Elevate your journey with us.\", \"site_description\": \"Escape the mundane and explore the untamed beauty of Saadani at our latest addition to the Cterra Collection.\"}','{\"site_name\": \"Cterra Saadani Luxury\", \"hero_image\": \"settings/TJHvGok7avMDCOtFp1VrCpQijMmwA3of68QG4UpM.jpg\", \"hero_title\": \"Discover Unparalleled\", \"hero_video\": null, \"twitter_url\": null, \"facebook_url\": \"https://facebook.com/cterrasaadani\", \"site_tagline\": \"Luxury Eco-Lodge Tanzania\", \"contact_email\": \"info@cterra.co.tz\", \"contact_phone\": \"+255 783 442 868\", \"hero_subtitle\": \"Hospitality\", \"instagram_url\": \"https://www.instagram.com/cterra.saadani\", \"meta_keywords\": \"luxury eco-lodge, Tanzania, safari, Indian Ocean, sustainable tourism, Saadani National Park\", \"contact_address\": \"Tanzania\", \"google_analytics\": null, \"hero_description\": \"Unmatched hospitality. Luxurious stays. Personalized service. Unforgettable experiences. Elevate your journey with us.\", \"site_description\": \"Escape the mundane and explore the untamed beauty of Saadani at our latest addition to the Cterra Collection.\"}','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','2025-06-05 11:21:16','2025-06-05 11:21:16');
/*!40000 ALTER TABLE `admin_activity_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `last_login_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'Eric','admin@gmail.com',NULL,'$2y$12$i0b5cipQccj7CJqoKLHQOucdsi1Bg0Rttr1y2ae9gLGeKtntXZGUy','super_admin',1,'2025-06-05 11:16:24',NULL,'2025-06-05 11:15:05','2025-06-05 11:16:24');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `amenities`
--

DROP TABLE IF EXISTS `amenities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `amenities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `amenities`
--

LOCK TABLES `amenities` WRITE;
/*!40000 ALTER TABLE `amenities` DISABLE KEYS */;
INSERT INTO `amenities` VALUES (1,'12 luxury rooms','Bathroom, toilet, terrace','fas fa-bed',1,1,'2025-06-05 11:15:05','2025-06-05 11:15:05'),(2,'Sleeps up to 4','','fas fa-users',2,1,'2025-06-05 11:15:05','2025-06-05 11:15:05'),(3,'Restaurant','','fas fa-utensils',3,1,'2025-06-05 11:15:05','2025-06-05 11:15:05'),(4,'Bar','','fas fa-cocktail',4,1,'2025-06-05 11:15:05','2025-06-05 11:15:05'),(5,'Pool','','fas fa-swimming-pool',5,1,'2025-06-05 11:15:05','2025-06-05 11:15:05'),(6,'Security agents','','fas fa-shield-alt',6,1,'2025-06-05 11:15:05','2025-06-05 11:15:05'),(7,'Electricity 24/24','','fas fa-bolt',7,1,'2025-06-05 11:15:05','2025-06-05 11:15:05'),(8,'Wifi','','fas fa-wifi',8,1,'2025-06-05 11:15:05','2025-06-05 11:15:05');
/*!40000 ALTER TABLE `amenities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('laravel_cache_setting.site_favicon','s:0:\"\";',1749136558),('laravel_cache_setting.site_logo','s:53:\"settings/ybLgmslU6XcKaSqN0ACq5CjoEBE1dU81KsTmc0xI.png\";',1749136614),('laravel_cache_setting.site_name','s:21:\"Cterra Saadani Luxury\";',1749136876);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commitments`
--

DROP TABLE IF EXISTS `commitments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `commitments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commitments`
--

LOCK TABLES `commitments` WRITE;
/*!40000 ALTER TABLE `commitments` DISABLE KEYS */;
INSERT INTO `commitments` VALUES (1,'Solar-powered electricity','fas fa-solar-panel',1,1,'2025-06-05 11:15:05','2025-06-05 11:15:05'),(2,'Rainwater harvesting to cover most of the lodge\'s needs','fas fa-tint',2,1,'2025-06-05 11:15:05','2025-06-05 11:15:05'),(3,'A zero-plastic approach','fas fa-leaf',3,1,'2025-06-05 11:15:05','2025-06-05 11:15:05'),(4,'Construction and furnishings made from local materials','fas fa-hammer',4,1,'2025-06-05 11:15:05','2025-06-05 11:15:05'),(5,'Safaris in electric vehicles (100% retrofitted, 100% electric, 100% solar)','fas fa-car-battery',5,1,'2025-06-05 11:15:05','2025-06-05 11:15:05'),(6,'Filtered drinking water','fas fa-filter',6,1,'2025-06-05 11:15:05','2025-06-05 11:15:05');
/*!40000 ALTER TABLE `commitments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
-- Table structure for table `gallery_images`
--

DROP TABLE IF EXISTS `gallery_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gallery_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallery_images`
--

LOCK TABLES `gallery_images` WRITE;
/*!40000 ALTER TABLE `gallery_images` DISABLE KEYS */;
INSERT INTO `gallery_images` VALUES (7,'WhatsApp Image 2025-06-04 at 21.48.00','WhatsApp Image 2025-06-04 at 21.48.00','gallery/WhatsApp Image 2025-06-04 at 21.48.00_1749133221_0.jpeg','gallery/WhatsApp Image 2025-06-04 at 21.48.00_1749133221_0.jpeg',1,1,'2025-06-05 11:20:21','2025-06-05 11:20:21'),(8,'WhatsApp Image 2025-06-04 at 21.47.59','WhatsApp Image 2025-06-04 at 21.47.59','gallery/WhatsApp Image 2025-06-04 at 21.47.59_1749133221_0.jpeg','gallery/WhatsApp Image 2025-06-04 at 21.47.59_1749133221_0.jpeg',2,1,'2025-06-05 11:20:21','2025-06-05 11:20:21'),(9,'WhatsApp Image 2025-06-04 at 21.47.58','WhatsApp Image 2025-06-04 at 21.47.58','gallery/WhatsApp Image 2025-06-04 at 21.47.58_1749133222_0.jpeg','gallery/WhatsApp Image 2025-06-04 at 21.47.58_1749133222_0.jpeg',3,1,'2025-06-05 11:20:22','2025-06-05 11:20:22'),(10,'WhatsApp Image 2025-06-04 at 21.47.57','WhatsApp Image 2025-06-04 at 21.47.57','gallery/WhatsApp Image 2025-06-04 at 21.47.57_1749133223_0.jpeg','gallery/WhatsApp Image 2025-06-04 at 21.47.57_1749133223_0.jpeg',4,1,'2025-06-05 11:20:23','2025-06-05 11:20:23'),(11,'WhatsApp Image 2025-06-04 at 21.47.56 (1)','WhatsApp Image 2025-06-04 at 21.47.56 (1)','gallery/WhatsApp Image 2025-06-04 at 21.47.56 (1)_1749133223_0.jpeg','gallery/WhatsApp Image 2025-06-04 at 21.47.56 (1)_1749133223_0.jpeg',5,1,'2025-06-05 11:20:23','2025-06-05 11:20:23'),(12,'WhatsApp Image 2025-06-04 at 21.47.56','WhatsApp Image 2025-06-04 at 21.47.56','gallery/WhatsApp Image 2025-06-04 at 21.47.56_1749133224_0.jpeg','gallery/WhatsApp Image 2025-06-04 at 21.47.56_1749133224_0.jpeg',6,1,'2025-06-05 11:20:24','2025-06-05 11:20:24'),(13,'WhatsApp Image 2025-06-04 at 21.47.55','WhatsApp Image 2025-06-04 at 21.47.55','gallery/WhatsApp Image 2025-06-04 at 21.47.55_1749133225_0.jpeg','gallery/WhatsApp Image 2025-06-04 at 21.47.55_1749133225_0.jpeg',7,1,'2025-06-05 11:20:25','2025-06-05 11:20:25'),(14,'WhatsApp Image 2025-06-04 at 21.47.54','WhatsApp Image 2025-06-04 at 21.47.54','gallery/WhatsApp Image 2025-06-04 at 21.47.54_1749133226_0.jpeg','gallery/WhatsApp Image 2025-06-04 at 21.47.54_1749133226_0.jpeg',8,1,'2025-06-05 11:20:26','2025-06-05 11:20:26'),(15,'WhatsApp Image 2025-06-04 at 21.47.53 (1)','WhatsApp Image 2025-06-04 at 21.47.53 (1)','gallery/WhatsApp Image 2025-06-04 at 21.47.53 (1)_1749133226_0.jpeg','gallery/WhatsApp Image 2025-06-04 at 21.47.53 (1)_1749133226_0.jpeg',9,1,'2025-06-05 11:20:26','2025-06-05 11:20:26'),(16,'WhatsApp Image 2025-06-04 at 21.47.53','WhatsApp Image 2025-06-04 at 21.47.53','gallery/WhatsApp Image 2025-06-04 at 21.47.53_1749133227_0.jpeg','gallery/WhatsApp Image 2025-06-04 at 21.47.53_1749133227_0.jpeg',10,1,'2025-06-05 11:20:27','2025-06-05 11:20:27'),(17,'WhatsApp Image 2025-06-04 at 21.47.52','WhatsApp Image 2025-06-04 at 21.47.52','gallery/WhatsApp Image 2025-06-04 at 21.47.52_1749133228_0.jpeg','gallery/WhatsApp Image 2025-06-04 at 21.47.52_1749133228_0.jpeg',11,1,'2025-06-05 11:20:28','2025-06-05 11:20:28'),(18,'WhatsApp Image 2025-06-04 at 21.47.51','WhatsApp Image 2025-06-04 at 21.47.51','gallery/WhatsApp Image 2025-06-04 at 21.47.51_1749133229_0.jpeg','gallery/WhatsApp Image 2025-06-04 at 21.47.51_1749133229_0.jpeg',12,1,'2025-06-05 11:20:29','2025-06-05 11:20:29'),(19,'WhatsApp Image 2025-06-04 at 21.47.49 (1)','WhatsApp Image 2025-06-04 at 21.47.49 (1)','gallery/WhatsApp Image 2025-06-04 at 21.47.49 (1)_1749133229_0.jpeg','gallery/WhatsApp Image 2025-06-04 at 21.47.49 (1)_1749133229_0.jpeg',13,1,'2025-06-05 11:20:29','2025-06-05 11:20:29'),(20,'WhatsApp Image 2025-06-04 at 21.47.49','WhatsApp Image 2025-06-04 at 21.47.49','gallery/WhatsApp Image 2025-06-04 at 21.47.49_1749133230_0.jpeg','gallery/WhatsApp Image 2025-06-04 at 21.47.49_1749133230_0.jpeg',14,1,'2025-06-05 11:20:30','2025-06-05 11:20:30'),(21,'WhatsApp Image 2025-06-04 at 21.47.48','WhatsApp Image 2025-06-04 at 21.47.48','gallery/WhatsApp Image 2025-06-04 at 21.47.48_1749133231_0.jpeg','gallery/WhatsApp Image 2025-06-04 at 21.47.48_1749133231_0.jpeg',15,1,'2025-06-05 11:20:31','2025-06-05 11:20:31'),(22,'WhatsApp Image 2025-06-04 at 21.47.47','WhatsApp Image 2025-06-04 at 21.47.47','gallery/WhatsApp Image 2025-06-04 at 21.47.47_1749133231_0.jpeg','gallery/WhatsApp Image 2025-06-04 at 21.47.47_1749133231_0.jpeg',16,1,'2025-06-05 11:20:32','2025-06-05 11:20:32'),(23,'WhatsApp Image 2025-06-04 at 21.47.46 (1)','WhatsApp Image 2025-06-04 at 21.47.46 (1)','gallery/WhatsApp Image 2025-06-04 at 21.47.46 (1)_1749133232_0.jpeg','gallery/WhatsApp Image 2025-06-04 at 21.47.46 (1)_1749133232_0.jpeg',17,1,'2025-06-05 11:20:32','2025-06-05 11:20:32'),(24,'WhatsApp Image 2025-06-04 at 21.47.46','WhatsApp Image 2025-06-04 at 21.47.46','gallery/WhatsApp Image 2025-06-04 at 21.47.46_1749133233_0.jpeg','gallery/WhatsApp Image 2025-06-04 at 21.47.46_1749133233_0.jpeg',18,1,'2025-06-05 11:20:33','2025-06-05 11:20:33'),(25,'WhatsApp Image 2025-06-04 at 21.47.45','WhatsApp Image 2025-06-04 at 21.47.45','gallery/WhatsApp Image 2025-06-04 at 21.47.45_1749133234_0.jpeg','gallery/WhatsApp Image 2025-06-04 at 21.47.45_1749133234_0.jpeg',19,1,'2025-06-05 11:20:34','2025-06-05 11:20:34'),(26,'WhatsApp Image 2025-06-04 at 21.47.44','WhatsApp Image 2025-06-04 at 21.47.44','gallery/WhatsApp Image 2025-06-04 at 21.47.44_1749133234_0.jpeg','gallery/WhatsApp Image 2025-06-04 at 21.47.44_1749133234_0.jpeg',20,1,'2025-06-05 11:20:34','2025-06-05 11:20:34'),(27,'WhatsApp Image 2025-06-04 at 21.47.43','WhatsApp Image 2025-06-04 at 21.47.43','gallery/WhatsApp Image 2025-06-04 at 21.47.43_1749133235_0.jpeg','gallery/WhatsApp Image 2025-06-04 at 21.47.43_1749133235_0.jpeg',21,1,'2025-06-05 11:20:35','2025-06-05 11:20:35'),(28,'WhatsApp Image 2025-06-04 at 21.47.42 (1)','WhatsApp Image 2025-06-04 at 21.47.42 (1)','gallery/WhatsApp Image 2025-06-04 at 21.47.42 (1)_1749133236_0.jpeg','gallery/WhatsApp Image 2025-06-04 at 21.47.42 (1)_1749133236_0.jpeg',22,1,'2025-06-05 11:20:36','2025-06-05 11:20:36'),(29,'WhatsApp Image 2025-06-04 at 21.47.42','WhatsApp Image 2025-06-04 at 21.47.42','gallery/WhatsApp Image 2025-06-04 at 21.47.42_1749133237_0.jpeg','gallery/WhatsApp Image 2025-06-04 at 21.47.42_1749133237_0.jpeg',23,1,'2025-06-05 11:20:37','2025-06-05 11:20:37'),(30,'WhatsApp Image 2025-06-04 at 21.47.41','WhatsApp Image 2025-06-04 at 21.47.41','gallery/WhatsApp Image 2025-06-04 at 21.47.41_1749133237_0.jpeg','gallery/WhatsApp Image 2025-06-04 at 21.47.41_1749133237_0.jpeg',24,1,'2025-06-05 11:20:37','2025-06-05 11:20:37'),(31,'WhatsApp Image 2025-06-04 at 21.47.40','WhatsApp Image 2025-06-04 at 21.47.40','gallery/WhatsApp Image 2025-06-04 at 21.47.40_1749133238_0.jpeg','gallery/WhatsApp Image 2025-06-04 at 21.47.40_1749133238_0.jpeg',25,1,'2025-06-05 11:20:38','2025-06-05 11:20:38'),(32,'WhatsApp Image 2025-06-04 at 21.47.39 (1)','WhatsApp Image 2025-06-04 at 21.47.39 (1)','gallery/WhatsApp Image 2025-06-04 at 21.47.39 (1)_1749133239_0.jpeg','gallery/WhatsApp Image 2025-06-04 at 21.47.39 (1)_1749133239_0.jpeg',26,1,'2025-06-05 11:20:39','2025-06-05 11:20:39'),(33,'WhatsApp Image 2025-06-04 at 21.47.39','WhatsApp Image 2025-06-04 at 21.47.39','gallery/WhatsApp Image 2025-06-04 at 21.47.39_1749133240_0.jpeg','gallery/WhatsApp Image 2025-06-04 at 21.47.39_1749133240_0.jpeg',27,1,'2025-06-05 11:20:40','2025-06-05 11:20:40'),(34,'WhatsApp Image 2025-06-04 at 21.47.38','WhatsApp Image 2025-06-04 at 21.47.38','gallery/WhatsApp Image 2025-06-04 at 21.47.38_1749133240_0.jpeg','gallery/WhatsApp Image 2025-06-04 at 21.47.38_1749133240_0.jpeg',28,1,'2025-06-05 11:20:40','2025-06-05 11:20:40');
/*!40000 ALTER TABLE `gallery_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hosting_sections`
--

DROP TABLE IF EXISTS `hosting_sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hosting_sections` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `video_button_text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Watch Experience Video',
  `video_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `background_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hosting_sections`
--

LOCK TABLES `hosting_sections` WRITE;
/*!40000 ALTER TABLE `hosting_sections` DISABLE KEYS */;
INSERT INTO `hosting_sections` VALUES (1,'Hosting','Escape & Serenity','A blend of refined comfort and authenticity, Saadani Kasa Bay invites you to enjoy a unique experience, combining discovery, tranquillity and wonder. A timeless escape to the essential, a view of the ocean from your room as a call to serenity, and a breathtakingly beautiful natural setting to enhance your stay.','Watch Experience Video','https://www.youtube.com/watch?v=dQw4w9WgXcQ','https://images.unsplash.com/photo-1571896349842-33c89424de2d?w=1200&h=800&fit=crop&crop=center',1,1,'2025-06-05 11:15:05','2025-06-05 11:15:05');
/*!40000 ALTER TABLE `hosting_sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `locations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `additional_description` text COLLATE utf8mb4_unicode_ci,
  `image_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'View Gallery',
  `button_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#gallery',
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locations`
--

LOCK TABLES `locations` WRITE;
/*!40000 ALTER TABLE `locations` DISABLE KEYS */;
INSERT INTO `locations` VALUES (1,'Location','A breathtaking setting','100 km north of Dar es Salaam, facing the island of Zanzibar, discover Saadani Kasa Bay. Nestled between a pristine white sand beach and the infinite blue of the Indian Ocean, this unique lodge offers an idyllic setting where luxury meets untamed nature.','On the land side, Saadani National Park reveals a mosaic of fascinating landscapes and exceptional wildlife, perfect for unforgettable safaris. Every moment spent here is a promise of experiences rich in emotion and authenticity, a unique adventure in the heart of Tanzania.','locations/YmGFjEz5L1oU4avN0etjW50yFezsncC7mpmMZIWN.jpg','locations/rI6EzVua7qgUEvYWqbEjRUNdbwzWMqlz1CLYmPBa.jpg','locations/73nLWalqCblOnYlY1Yn2wXsycSouvjH7tCJOn1JY.jpg','View Gallery','#gallery',1,1,'2025-06-05 11:15:05','2025-06-05 11:19:04');
/*!40000 ALTER TABLE `locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2024_01_01_000001_create_admins_table',1),(5,'2024_01_01_000002_create_website_settings_table',1),(6,'2024_01_01_000003_create_activities_table',1),(7,'2024_01_01_000004_create_amenities_table',1),(8,'2024_01_01_000005_create_gallery_images_table',1),(9,'2024_01_01_000006_create_commitments_table',1),(10,'2024_01_01_000007_create_admin_activity_logs_table',1),(11,'2024_12_05_120000_create_accommodation_sections_table',1),(12,'2025_01_15_000000_create_room_types_table',1),(13,'2025_06_04_115915_create_locations_table',1),(14,'2025_06_04_115959_create_hosting_sections_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `room_types`
--

DROP TABLE IF EXISTS `room_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `room_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(10,2) NOT NULL,
  `currency` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'USD',
  `tent_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tent_quantity` int NOT NULL DEFAULT '1',
  `main_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `max_occupancy` int DEFAULT NULL,
  `features` text COLLATE utf8mb4_unicode_ci,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `room_types`
--

LOCK TABLES `room_types` WRITE;
/*!40000 ALTER TABLE `room_types` DISABLE KEYS */;
INSERT INTO `room_types` VALUES (1,'DELUXE ROOM','Experience luxury in our Deluxe Room featuring a spacious big tent with premium amenities. Perfect for couples seeking an intimate and comfortable stay with stunning views and modern conveniences.',800.00,'USD','Big Tent',1,NULL,NULL,NULL,NULL,2,'[\"Private bathroom with hot water\",\"Air conditioning\",\"Ocean view\",\"King-size bed\",\"Mini bar\",\"Private terrace\",\"WiFi access\",\"Room service\"]',1,1,1,'2025-06-05 11:15:05','2025-06-05 11:15:05'),(2,'DOUBLE ROOM','Our Double Room offers a unique experience with two small tents, ideal for friends or family members who prefer separate sleeping spaces while staying close together.',500.00,'USD','Small Tents',2,NULL,NULL,NULL,NULL,4,'[\"Two separate small tents\",\"Shared bathroom facilities\",\"Fan cooling\",\"Twin beds in each tent\",\"Shared outdoor seating area\",\"WiFi access\",\"Daily housekeeping\"]',2,1,0,'2025-06-05 11:15:05','2025-06-05 11:15:05'),(3,'FAMILY ROOM','Perfect for families, our Family Room features a large big tent with ample space for parents and children. Designed with comfort and convenience in mind for memorable family vacations.',800.00,'USD','Big Tent',1,NULL,NULL,NULL,NULL,4,'[\"Spacious big tent\",\"Family bathroom\",\"Air conditioning\",\"Multiple bed configurations\",\"Children-friendly amenities\",\"Private outdoor area\",\"WiFi access\",\"Complimentary breakfast\",\"Baby cot available\"]',3,1,1,'2025-06-05 11:15:05','2025-06-05 11:15:05'),(4,'SUITE ROOM','Indulge in our luxurious Suite Room with a premium big tent featuring separate living and sleeping areas. The ultimate in comfort and elegance for discerning guests.',1000.00,'USD','Big Tent',1,NULL,NULL,NULL,NULL,2,'[\"Separate living area\",\"Premium bathroom with bathtub\",\"Climate control\",\"King-size bed\",\"Private bar\",\"Panoramic views\",\"Butler service\",\"Premium WiFi\",\"Complimentary spa access\",\"Private dining area\"]',4,1,1,'2025-06-05 11:15:05','2025-06-05 11:15:05'),(5,'TWIN ROOM','Our Twin Room offers a sophisticated big tent with twin bed configuration, perfect for business travelers or friends who prefer separate beds while sharing premium accommodations.',1200.00,'USD','Big Tent',1,NULL,NULL,NULL,NULL,2,'[\"Twin beds\",\"Premium bathroom\",\"Air conditioning\",\"Work desk\",\"Mini bar\",\"Garden view\",\"High-speed WiFi\",\"Daily newspaper\",\"Laundry service\",\"Room service\"]',5,1,0,'2025-06-05 11:15:05','2025-06-05 11:15:05');
/*!40000 ALTER TABLE `room_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('HmUJkH2e7eOx9xTiyarU0Y0pPRm6j7NjXMyqQuY4',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZXZHNTBUdkVVaHN0ckhWTFVUajNCNWxxRVVndEFxaXpQUzN3RkVzbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1749132973),('s22RxUcO4MT2dM5saX8uV6l6DdY5AoSYRaTD0dbh',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNHZkU1VMWkRBYzczSnhuaE9EUk1ONmlScDBGdXVhM1dZN1VhMnZPUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9zZXR0aW5ncyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTI6ImxvZ2luX2FkbWluXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9',1749133276);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Test User','test@example.com','2025-06-05 11:15:05','$2y$12$XcQCxD/WqUwqsNetYGPUVencGv8WNr43c1apwxd/OWBCe8ZjGGVny','FM0w09bmyz','2025-06-05 11:15:05','2025-06-05 11:15:05');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `website_settings`
--

DROP TABLE IF EXISTS `website_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `website_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'text',
  `group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'general',
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `website_settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `website_settings`
--

LOCK TABLES `website_settings` WRITE;
/*!40000 ALTER TABLE `website_settings` DISABLE KEYS */;
INSERT INTO `website_settings` VALUES (1,'site_name','Cterra Saadani Luxury','text','general','Site Name','The name of your website',1,'2025-06-05 11:15:05','2025-06-05 11:15:05'),(2,'site_tagline','Luxury Eco-Lodge Tanzania','text','general','Site Tagline','A short description of your website',2,'2025-06-05 11:15:05','2025-06-05 11:15:05'),(3,'site_description','Escape the mundane and explore the untamed beauty of Saadani at our latest addition to the Cterra Collection.','textarea','general','Site Description','A longer description for SEO purposes',3,'2025-06-05 11:15:05','2025-06-05 11:15:05'),(4,'site_logo','settings/ybLgmslU6XcKaSqN0ACq5CjoEBE1dU81KsTmc0xI.png','image','general','Site Logo','Upload your website logo',4,'2025-06-05 11:15:05','2025-06-05 11:16:53'),(5,'favicon','settings/ouxZ1wY2WgJ02Z9Y9WIDkKNEOLfZcQAHrn6Aq6JY.png','image','general','Favicon','Upload your website favicon (16x16 or 32x32 pixels)',5,'2025-06-05 11:15:05','2025-06-05 11:16:53'),(6,'contact_email','info@cterra.co.tz','email','contact','Contact Email','Main contact email address',1,'2025-06-05 11:15:05','2025-06-05 11:15:05'),(7,'contact_phone','+255 783 442 868','text','contact','Contact Phone','Main contact phone number',2,'2025-06-05 11:15:05','2025-06-05 11:15:05'),(8,'contact_address','Tanzania','textarea','contact','Contact Address','Physical address or location',3,'2025-06-05 11:15:05','2025-06-05 11:15:05'),(9,'hero_title','Discover Unparalleled','text','hero','Hero Title','Main title in the hero section',1,'2025-06-05 11:15:05','2025-06-05 11:15:05'),(10,'hero_subtitle','Hospitality','text','hero','Hero Subtitle','Subtitle in the hero section',2,'2025-06-05 11:15:05','2025-06-05 11:15:05'),(11,'hero_description','Unmatched hospitality. Luxurious stays. Personalized service. Unforgettable experiences. Elevate your journey with us.','textarea','hero','Hero Description','Description text in the hero section',3,'2025-06-05 11:15:05','2025-06-05 11:15:05'),(12,'hero_video','','text','hero','Hero Video URL','URL for the hero background video',4,'2025-06-05 11:15:05','2025-06-05 11:15:05'),(13,'hero_image','settings/TJHvGok7avMDCOtFp1VrCpQijMmwA3of68QG4UpM.jpg','image','hero','Hero Background Image','Fallback image if video is not available',5,'2025-06-05 11:15:05','2025-06-05 11:21:16'),(14,'meta_keywords','luxury eco-lodge, Tanzania, safari, Indian Ocean, sustainable tourism, Saadani National Park','textarea','seo','Meta Keywords','SEO keywords separated by commas',1,'2025-06-05 11:15:05','2025-06-05 11:15:05'),(15,'google_analytics','','textarea','seo','Google Analytics Code','Google Analytics tracking code',2,'2025-06-05 11:15:05','2025-06-05 11:15:05'),(16,'facebook_url','https://facebook.com/cterrasaadani','text','social','Facebook URL','Facebook page URL',1,'2025-06-05 11:15:05','2025-06-05 11:15:05'),(17,'instagram_url','https://www.instagram.com/cterra.saadani','text','social','Instagram URL','Instagram profile URL',2,'2025-06-05 11:15:05','2025-06-05 11:15:05'),(18,'twitter_url','','text','social','Twitter URL','Twitter profile URL',3,'2025-06-05 11:15:05','2025-06-05 11:15:05');
/*!40000 ALTER TABLE `website_settings` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-05 17:22:00
