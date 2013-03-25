-- MySQL dump 10.13  Distrib 5.5.29, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: careerbook
-- ------------------------------------------------------
-- Server version	5.5.29-0ubuntu0.12.04.1-log

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
-- Table structure for table `city`
--

DROP TABLE IF EXISTS `city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `city` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'THIS WILL BE AUTO GENERATED UNIQUE ID',
  `name` char(35) COLLATE utf8_unicode_ci NOT NULL COMMENT 'CITY NAME',
  `state_id` int(11) unsigned NOT NULL COMMENT 'THIS WILL BE STATE ID OF STATE TABLE',
  PRIMARY KEY (`id`),
  KEY `FK_state_id_to_id` (`state_id`),
  CONSTRAINT `FK_state_id_to_id` FOREIGN KEY (`state_id`) REFERENCES `state` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `city`
--

LOCK TABLES `city` WRITE;
/*!40000 ALTER TABLE `city` DISABLE KEYS */;
/*!40000 ALTER TABLE `city` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `friends`
--

DROP TABLE IF EXISTS `friends`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `friends` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'primary id',
  `user_id` bigint(11) unsigned NOT NULL COMMENT 'user id',
  `friend_id` bigint(11) unsigned NOT NULL COMMENT 'friends id',
  `status` enum('R','F','D','W') NOT NULL COMMENT 'F for friend, R for request, D for deleted,W for waiting for request',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `friend_id` (`friend_id`),
  CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `friends_ibfk_2` FOREIGN KEY (`friend_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `friends`
--

LOCK TABLES `friends` WRITE;
/*!40000 ALTER TABLE `friends` DISABLE KEYS */;
INSERT INTO `friends` VALUES (1,17,18,'F'),(2,18,17,'F'),(3,17,21,'F'),(4,21,17,'F'),(5,21,18,'F'),(6,18,21,'F'),(7,21,22,'F'),(8,22,21,'F'),(9,22,17,'F'),(10,17,22,'F');
/*!40000 ALTER TABLE `friends` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group_details`
--

DROP TABLE IF EXISTS `group_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group_details` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'group id act as primary key',
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'description of the group',
  `group_image` blob COMMENT 'group image',
  `created_by` bigint(11) unsigned NOT NULL COMMENT 'user id of group creator',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'creation time of group',
  `updated_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'last updation time by user',
  `status` enum('A','D') NOT NULL DEFAULT 'A' COMMENT 'status of group whether active or not',
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group_details`
--

LOCK TABLES `group_details` WRITE;
/*!40000 ALTER TABLE `group_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `group_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group_discussion`
--

DROP TABLE IF EXISTS `group_discussion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group_discussion` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'group discussion id act as primary key',
  `group_id` bigint(11) unsigned NOT NULL COMMENT 'group id of group',
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'description of topic',
  `created_by` bigint(11) unsigned NOT NULL COMMENT 'user id of group creator',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'creation time of group',
  `updated_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'last updation time by user',
  PRIMARY KEY (`id`),
  KEY `fk_group_id` (`group_id`),
  KEY `created_by` (`created_by`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group_discussion`
--

LOCK TABLES `group_discussion` WRITE;
/*!40000 ALTER TABLE `group_discussion` DISABLE KEYS */;
/*!40000 ALTER TABLE `group_discussion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group_discussion_comment`
--

DROP TABLE IF EXISTS `group_discussion_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group_discussion_comment` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'group comment id act as primary key',
  `discussion_id` bigint(11) unsigned NOT NULL COMMENT 'discussion id of group',
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'description of comment',
  `created_by` bigint(11) unsigned NOT NULL COMMENT 'user id of group creator',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'creation time of group',
  `updated_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'last updation time by user',
  PRIMARY KEY (`id`),
  KEY `fk_discussion_id` (`discussion_id`),
  KEY `created_by` (`created_by`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group_discussion_comment`
--

LOCK TABLES `group_discussion_comment` WRITE;
/*!40000 ALTER TABLE `group_discussion_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `group_discussion_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group_log`
--

DROP TABLE IF EXISTS `group_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group_log` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'log id act as primary key',
  `user_id` bigint(11) unsigned NOT NULL COMMENT 'user id',
  `user_ip_address` char(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'user ip address',
  `log_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'log time of user activity',
  `group_id` bigint(11) unsigned NOT NULL COMMENT 'group id on which activity perform',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `group_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group_log`
--

LOCK TABLES `group_log` WRITE;
/*!40000 ALTER TABLE `group_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `group_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group_members`
--

DROP TABLE IF EXISTS `group_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group_members` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'primary id',
  `group_id` bigint(11) unsigned NOT NULL COMMENT 'group id of group',
  `member_id` bigint(11) unsigned NOT NULL COMMENT 'member user id',
  PRIMARY KEY (`id`),
  KEY `fk_group_id` (`group_id`),
  KEY `member_id` (`member_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group_members`
--

LOCK TABLES `group_members` WRITE;
/*!40000 ALTER TABLE `group_members` DISABLE KEYS */;
/*!40000 ALTER TABLE `group_members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messaging`
--

DROP TABLE IF EXISTS `messaging`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messaging` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'messaging id act as primary key',
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'description of messaging',
  `user_from` bigint(11) unsigned NOT NULL COMMENT 'user id of sender',
  `user_to` bigint(11) unsigned NOT NULL COMMENT 'user id of reciever',
  `messaging_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'messaging time',
  `status` enum('R','U','D') NOT NULL DEFAULT 'U' COMMENT 'status of message R:Read,U:Unread,D:Deleted',
  PRIMARY KEY (`id`),
  KEY `user_to` (`user_to`),
  KEY `user_from` (`user_from`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messaging`
--

LOCK TABLES `messaging` WRITE;
/*!40000 ALTER TABLE `messaging` DISABLE KEYS */;
INSERT INTO `messaging` VALUES (1,'',17,0,'2013-03-23 11:17:09','U'),(2,'helllooo',17,17,'2013-03-25 04:56:19','U'),(3,'hiii jsadjhkj',17,17,'2013-03-25 04:57:06','U'),(4,'djhsjdjaj',17,18,'2013-03-25 04:59:20','U'),(5,'admin dfgffdg',18,1,'2013-03-25 05:08:11','U');
/*!40000 ALTER TABLE `messaging` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `state`
--

DROP TABLE IF EXISTS `state`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `state` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'THIS WILL BE AUTO GENERATED UNIQUE ID',
  `name` char(35) COLLATE utf8_unicode_ci NOT NULL COMMENT 'STATE NAME',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `state`
--

LOCK TABLES `state` WRITE;
/*!40000 ALTER TABLE `state` DISABLE KEYS */;
INSERT INTO `state` VALUES (1,'dgsjhdg'),(2,'dgsjhdg'),(3,'dgsjhdg'),(4,'dgsjhdg'),(5,'dgsjhdg'),(6,'dgsjhdg');
/*!40000 ALTER TABLE `state` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_academic_info`
--

DROP TABLE IF EXISTS `user_academic_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_academic_info` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'THIS WILL BE AUTO GENERATED UNIQUE ID',
  `user_id` bigint(11) unsigned NOT NULL COMMENT 'THIS WILL BE USER ID OF USER TABLE',
  `board_10` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '10TH STANDARD BOARD',
  `school_10` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '10TH STANDARF SCHOOL',
  `percentage_GPA_10` int(3) unsigned zerofill DEFAULT NULL COMMENT 'PERCENTAGE IN 10TH STANDARD',
  `board_12` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '12TH STANDARD BOARD',
  `school_12` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '12TH STANDARF SCHOOL',
  `percentage_12` int(3) unsigned zerofill DEFAULT NULL COMMENT 'PERCENTAGE IN 12TH STANDARD',
  `graduation_degree` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'GRADUATION DEGREE',
  `graduation_specialization` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'GRADUATION SPECIALIZATION',
  `graduation_college` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'GRADUATION COLLEGE',
  `graduation_percentage` int(3) unsigned zerofill DEFAULT NULL COMMENT 'PERCENTAGE IN GRADUATION STANDARD',
  `post_graduation_degree` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'POST GRADUATION DEGREE',
  `post_graduation_specialization` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'POST GRADUATION SPECIALIZATION',
  `post_graduation_college` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'POST GRADUATION COLLEGE',
  `post_graduation_percentage` int(3) unsigned zerofill DEFAULT NULL COMMENT 'PERCENTAGE IN POST GRADUATION STANDARD',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_academic_info_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_academic_info`
--

LOCK TABLES `user_academic_info` WRITE;
/*!40000 ALTER TABLE `user_academic_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_academic_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_achievements`
--

DROP TABLE IF EXISTS `user_achievements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_achievements` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'THIS WILL BE AUTO GENERATED UNIQUE ID',
  `user_id` bigint(11) unsigned NOT NULL COMMENT 'THIS WILL BE USER ID OF USER TABLE',
  `achievement` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'USER ACHIEVEMENT',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_achievements_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_achievements`
--

LOCK TABLES `user_achievements` WRITE;
/*!40000 ALTER TABLE `user_achievements` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_achievements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_discussion`
--

DROP TABLE IF EXISTS `user_discussion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_discussion` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'THIS WILL BE AUTO GENERATED UNIQUE ID',
  `group_id` bigint(11) unsigned DEFAULT NULL COMMENT 'THIS WILL BE LINKED TO ID OF GROUP TABLE',
  `topic_description` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'DESCRIPTION OF TOPIC',
  `created_by` bigint(11) unsigned NOT NULL COMMENT 'USER ID WHO CREATED DISCUSSION',
  `created_on` datetime NOT NULL COMMENT 'discussion creation time',
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'last updation time by user',
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  CONSTRAINT `user_discussion_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_discussion`
--

LOCK TABLES `user_discussion` WRITE;
/*!40000 ALTER TABLE `user_discussion` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_discussion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_discussion_comments`
--

DROP TABLE IF EXISTS `user_discussion_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_discussion_comments` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'THIS WILL BE AUTO GENERATED UNIQUE ID',
  `discussion_id` bigint(11) unsigned DEFAULT NULL COMMENT 'THIS WILL BE LINKED TO ID OF DISCUSSION TABLE',
  `comment_discusn_form` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'COMMENT ON Discussion',
  `created_by` bigint(11) unsigned NOT NULL COMMENT 'THIS WILL BE USER ID OF USER TABLE',
  `created_on` datetime NOT NULL COMMENT 'discussion creation time',
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'last updation time by user',
  PRIMARY KEY (`id`),
  KEY `FK_discussion_id_to_id` (`discussion_id`),
  KEY `created_by` (`created_by`),
  CONSTRAINT `FK_discussion_id_to_id` FOREIGN KEY (`discussion_id`) REFERENCES `user_discussion` (`id`),
  CONSTRAINT `user_discussion_comments_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_discussion_comments`
--

LOCK TABLES `user_discussion_comments` WRITE;
/*!40000 ALTER TABLE `user_discussion_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_discussion_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_other_academic_info`
--

DROP TABLE IF EXISTS `user_other_academic_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_other_academic_info` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'THIS WILL BE AUTO GENERATED UNIQUE ID',
  `user_id` bigint(11) unsigned NOT NULL COMMENT 'THIS WILL BE USER ID OF USER TABLE',
  `degree` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'DEGREE',
  `specialization` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'SPECIALIZATION',
  `college` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'COLLEGE',
  `percentage` int(3) unsigned zerofill DEFAULT NULL COMMENT 'PERCENTAGE',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_other_academic_info_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_other_academic_info`
--

LOCK TABLES `user_other_academic_info` WRITE;
/*!40000 ALTER TABLE `user_other_academic_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_other_academic_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_personal_info`
--

DROP TABLE IF EXISTS `user_personal_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_personal_info` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'THIS WILL BE AUTO GENERATED UNIQUE ID',
  `user_id` bigint(11) unsigned NOT NULL COMMENT 'THIS WILL BE USER ID OF USER TABLE',
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'USER HOME ADDRESS',
  `city_id` int(11) unsigned NOT NULL COMMENT 'THIS WILL BE CITY ID OF CITY TABLE',
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'updation time of the user',
  PRIMARY KEY (`id`),
  KEY `FK_city_id_to_id` (`city_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `FK_city_id_to_id` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`),
  CONSTRAINT `user_personal_info_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_personal_info`
--

LOCK TABLES `user_personal_info` WRITE;
/*!40000 ALTER TABLE `user_personal_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_personal_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_previous_job_info`
--

DROP TABLE IF EXISTS `user_previous_job_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_previous_job_info` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'THIS WILL BE AUTO GENERATED UNIQUE ID',
  `user_id` bigint(11) unsigned NOT NULL COMMENT 'THIS WILL BE USER ID OF USER TABLE',
  `position` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'USER CURRENT JOB POSITION',
  `company` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'USER CURRENT COMPANY',
  `start_period` date DEFAULT NULL COMMENT 'USER OLD JOB START PERIOD',
  `end_period` date DEFAULT NULL COMMENT 'USER OLD JOB END PERIOD',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_previous_job_info_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_previous_job_info`
--

LOCK TABLES `user_previous_job_info` WRITE;
/*!40000 ALTER TABLE `user_previous_job_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_previous_job_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_professional_info`
--

DROP TABLE IF EXISTS `user_professional_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_professional_info` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'THIS WILL BE AUTO GENERATED UNIQUE ID',
  `user_id` bigint(11) unsigned NOT NULL COMMENT 'THIS WILL BE USER ID OF USER TABLE',
  `skill_set` text COLLATE utf8_unicode_ci COMMENT 'USER SKILL SET',
  `current_position` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'USER CURRENT JOB POSITION',
  `current_company` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'USER CURRENT COMPANY',
  `start_period` date DEFAULT NULL COMMENT 'USER CURRENT JOB START PERIOD',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_professional_info_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_professional_info`
--

LOCK TABLES `user_professional_info` WRITE;
/*!40000 ALTER TABLE `user_professional_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_professional_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'career book uers id',
  `first_name` char(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'user first name ',
  `middle_name` char(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user middle name',
  `last_name` char(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user last name',
  `date_of_birth` datetime NOT NULL COMMENT 'user date of birth',
  `email_primary` char(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'user valid primary  email id',
  `email_secondary` char(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user valid  secondary email id',
  `phone_no` bigint(20) DEFAULT NULL COMMENT 'user phone number',
  `gender` enum('male','female') NOT NULL COMMENT 'user gender',
  `password` text NOT NULL COMMENT 'user encrypted password',
  `status` enum('A','D','I') NOT NULL DEFAULT 'A' COMMENT 'user status A for Active D for Deleted and I for Inactive ',
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'last updation time of user',
  `created_on` datetime NOT NULL COMMENT 'account creation time of user',
  `updated_by` bigint(11) unsigned DEFAULT NULL COMMENT 'userid who update this account',
  `created_by` bigint(11) unsigned DEFAULT NULL COMMENT 'userid who create this account',
  `profile_image` mediumblob COMMENT 'user profile image',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Administrator',NULL,NULL,'2013-03-01 00:00:00','admin@admin.com',NULL,12345,'male','7d793037a0760186574b0282f2f435','A','2013-03-01 18:26:59','2013-03-01 00:00:00',NULL,NULL,NULL),(17,'Rahul',NULL,'Kumar','1988-09-20 00:00:00','timetorock1001@gmail.com',NULL,8375959679,'male','827ccb0eea8a706c4c34a16891f84e7b','A','2013-03-03 18:07:36','2013-03-03 06:07:36',NULL,NULL,NULL),(18,'rahul',NULL,'singh','1988-09-20 00:00:00','rahul@osscube.com',NULL,8375959679,'male','827ccb0eea8a706c4c34a16891f84e7b','A','2013-03-04 04:09:15','2013-03-04 09:39:15',NULL,NULL,NULL),(21,'Mohit','K','Singh','0000-00-00 00:00:00','lookforward007@gmail.com',NULL,8975959679,'male','827ccb0eea8a706c4c34a16891f84e7b','A','2013-03-12 15:11:46','2013-03-12 03:11:46',NULL,NULL,NULL),(22,'Amit',NULL,'Rana','2013-03-20 00:00:00','amit@gmail.com',NULL,856893217,'male','827ccb0eea8a706c4c34a16891f84e7b','A','2013-03-23 17:00:48','2013-03-23 05:00:48',NULL,NULL,NULL),(23,'Ajay',NULL,'Devgan','2013-03-28 00:00:00','Ajay@rediffmail.com',NULL,46548979,'male','827ccb0eea8a706c4c34a16891f84e7b','A','2013-03-23 17:02:00','2013-03-23 05:02:00',NULL,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-03-25 17:27:05
