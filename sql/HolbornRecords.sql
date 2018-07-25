-- MySQL dump 10.13  Distrib 5.5.58, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: HolbornRecords
-- ------------------------------------------------------
-- Server version	5.5.58-0+deb8u1

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
-- Current Database: `HolbornRecords`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `HolbornRecords` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `HolbornRecords`;

--
-- Table structure for table `diver_dives`
--

DROP TABLE IF EXISTS `diver_dives`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `diver_dives` (
  `diver_id` int(10) unsigned NOT NULL,
  `dive_id` int(10) unsigned NOT NULL,
  `gas_id` int(10) unsigned NOT NULL,
  `instructional_role_id` int(10) unsigned NOT NULL,
  UNIQUE KEY `idx_diver_dive` (`diver_id`,`dive_id`),
  KEY `dive_id` (`dive_id`),
  KEY `fk_diver_dives_gas` (`gas_id`),
  KEY `fk_diver_dives_instructional_role` (`instructional_role_id`),
  CONSTRAINT `fk_diver_dives_instructional_role` FOREIGN KEY (`instructional_role_id`) REFERENCES `instructional_roles` (`instructional_role_id`),
  CONSTRAINT `diver_dives_ibfk_1` FOREIGN KEY (`diver_id`) REFERENCES `divers` (`diver_id`),
  CONSTRAINT `diver_dives_ibfk_2` FOREIGN KEY (`dive_id`) REFERENCES `dives` (`dive_id`),
  CONSTRAINT `fk_diver_dives_gas` FOREIGN KEY (`gas_id`) REFERENCES `gas` (`gas_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `divers`
--

DROP TABLE IF EXISTS `divers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `divers` (
  `diver_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `manager` tinyint(1) NOT NULL DEFAULT '0',
  `Instructor` tinyint(1) NOT NULL DEFAULT '0',
  `cox` tinyint(1) NOT NULL DEFAULT '0',
  `diver_name` varchar(128) DEFAULT NULL,
  `username` varchar(200) NOT NULL DEFAULT '',
  `password` varchar(56) NOT NULL DEFAULT '',
  PRIMARY KEY (`diver_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`timothy`@`localhost`*/ /*!50003 trigger http_user_ins before insert on divers for each row
begin
SET NEW.password = SHA2(NEW.password, 224);
end */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`timothy`@`localhost`*/ /*!50003 trigger http_user_upd before update on divers for each row
begin
if LENGTH(NEW.password) != 56 then
SET NEW.password = SHA2(NEW.password, 224);
end if;
end */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `dives`
--

DROP TABLE IF EXISTS `dives`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dives` (
  `dive_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(10) unsigned NOT NULL,
  `educational_types_id` int(10) unsigned NOT NULL,
  `depth` decimal(3,1) NOT NULL COMMENT 'in meters',
  `time` int(11) NOT NULL COMMENT 'in minutes',
  `date` date NOT NULL,
  PRIMARY KEY (`dive_id`),
  KEY `site_id` (`site_id`),
  KEY `fk_dives_educational_types` (`educational_types_id`),
  CONSTRAINT `fk_dives_educational_types` FOREIGN KEY (`educational_types_id`) REFERENCES `educational_types` (`educational_types_id`),
  CONSTRAINT `dives_ibfk_1` FOREIGN KEY (`site_id`) REFERENCES `sites` (`site_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `educational_types`
--

DROP TABLE IF EXISTS `educational_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `educational_types` (
  `educational_types_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `educational_name` varchar(128) NOT NULL COMMENT 'Brief Description of Skill',
  `educational_description` text COMMENT 'Full Description as needed',
  PRIMARY KEY (`educational_types_id`),
  UNIQUE KEY `educational_name` (`educational_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `gas`
--

DROP TABLE IF EXISTS `gas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gas` (
  `gas_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `gas_name` varchar(10) NOT NULL,
  PRIMARY KEY (`gas_id`),
  UNIQUE KEY `gas` (`gas_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `instructional_roles`
--

DROP TABLE IF EXISTS `instructional_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `instructional_roles` (
  `instructional_role_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `instructional_role` varchar(15) NOT NULL,
  PRIMARY KEY (`instructional_role_id`),
  UNIQUE KEY `instructional_role` (`instructional_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `phplogin_admins`
--

DROP TABLE IF EXISTS `phplogin_admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phplogin_admins` (
  `adminid` char(23) NOT NULL DEFAULT 'uuid_short();',
  `userid` char(23) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `superadmin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`adminid`,`userid`),
  UNIQUE KEY `phplogin_adminid_UNIQUE` (`adminid`),
  UNIQUE KEY `phplogin_userid_UNIQUE` (`userid`),
  CONSTRAINT `fk_phplogin_userid_admins` FOREIGN KEY (`userid`) REFERENCES `phplogin_members` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `phplogin_app_config`
--

DROP TABLE IF EXISTS `phplogin_app_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phplogin_app_config` (
  `setting` char(26) NOT NULL,
  `value` varchar(12000) NOT NULL,
  `sortorder` int(5) DEFAULT NULL,
  `category` varchar(25) NOT NULL,
  `type` varchar(15) NOT NULL,
  `description` varchar(140) DEFAULT NULL,
  `required` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`setting`),
  UNIQUE KEY `phplogin_setting_UNIQUE` (`setting`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `phplogin_cookies`
--

DROP TABLE IF EXISTS `phplogin_cookies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phplogin_cookies` (
  `cookieid` char(23) NOT NULL,
  `userid` char(23) NOT NULL,
  `tokenid` char(25) NOT NULL,
  `expired` tinyint(1) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`userid`),
  CONSTRAINT `userid` FOREIGN KEY (`userid`) REFERENCES `phplogin_members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `phplogin_deleted_members`
--

DROP TABLE IF EXISTS `phplogin_deleted_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phplogin_deleted_members` (
  `id` char(23) NOT NULL,
  `username` varchar(65) NOT NULL DEFAULT '',
  `password` varchar(65) NOT NULL DEFAULT '',
  `email` varchar(65) NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `mod_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `phplogin_login_attempts`
--

DROP TABLE IF EXISTS `phplogin_login_attempts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phplogin_login_attempts` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(65) DEFAULT NULL,
  `IP` varchar(20) NOT NULL,
  `Attempts` int(11) NOT NULL,
  `LastLogin` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `phplogin_mail_log`
--

DROP TABLE IF EXISTS `phplogin_mail_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phplogin_mail_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) NOT NULL DEFAULT 'generic',
  `status` varchar(45) DEFAULT NULL,
  `recipient` varchar(5000) DEFAULT NULL,
  `response` mediumtext NOT NULL,
  `isread` tinyint(1) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `phplogin_member_info`
--

DROP TABLE IF EXISTS `phplogin_member_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phplogin_member_info` (
  `userid` char(23) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(55) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address1` varchar(45) DEFAULT NULL,
  `address2` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `state` varchar(30) DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  `bio` varchar(20000) DEFAULT NULL,
  `userimage` varchar(255) DEFAULT NULL,
  UNIQUE KEY `phplogin_userid_UNIQUE` (`userid`),
  KEY `fk_phplogin_userid_idx` (`userid`),
  CONSTRAINT `fk_phplogin_userid` FOREIGN KEY (`userid`) REFERENCES `phplogin_members` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `phplogin_members`
--

DROP TABLE IF EXISTS `phplogin_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phplogin_members` (
  `id` char(23) NOT NULL,
  `username` varchar(65) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(65) NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `mod_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `phplogin_username_UNIQUE` (`username`),
  UNIQUE KEY `phplogin_id_UNIQUE` (`id`),
  UNIQUE KEY `phplogin_email_UNIQUE` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`timothy`@`localhost`*/ /*!50003 TRIGGER phplogin_add_admin AFTER INSERT ON phplogin_members FOR EACH ROW BEGIN IF (NEW.admin = 1) THEN  INSERT INTO phplogin_admins (adminid, userid, active, superadmin ) VALUES (uuid_short(), NEW.id, 1, 0 ); END IF; END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`timothy`@`localhost`*/ /*!50003 TRIGGER phplogin_add_admin_beforeUpdate BEFORE UPDATE ON phplogin_members FOR EACH ROW BEGIN set @s = (SELECT superadmin from phplogin_admins where userid = NEW.id); set @a = (SELECT adminid from phplogin_admins where userid = NEW.id); IF (NEW.admin = 1 && isnull(@a)) THEN INSERT INTO phplogin_admins ( adminid, userid, active, superadmin ) VALUES ( uuid_short(), NEW.id, 1, 0 ); ELSEIF (NEW.admin = 0) THEN IF (@s = 0) THEN DELETE FROM phplogin_admins WHERE userid = NEW.id and superadmin = 0; ELSEIF (@s = 1) THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='Cannot delete superadmin'; END IF; END IF; END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`timothy`@`localhost`*/ /*!50003 TRIGGER phplogin_move_to_deleted_members AFTER DELETE ON phplogin_members FOR EACH ROW BEGIN DELETE FROM phplogin_deleted_members WHERE deleted_members.id = OLD.id; UPDATE phplogin_admins SET active = '0' where phplogin_admins.userid = OLD.id;  INSERT INTO phplogin_deleted_members ( id, username, password, email, verified, admin) VALUES ( OLD.id, OLD.username, OLD.password, OLD.email, OLD.verified, OLD.admin ); END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `phplogin_tokens`
--

DROP TABLE IF EXISTS `phplogin_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phplogin_tokens` (
  `tokenid` char(25) NOT NULL,
  `userid` char(23) NOT NULL,
  `expired` tinyint(1) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`tokenid`),
  UNIQUE KEY `phplogin_tokenid_UNIQUE` (`tokenid`),
  UNIQUE KEY `phplogin_userid_UNIQUE` (`userid`),
  CONSTRAINT `phplogin_userid_t` FOREIGN KEY (`userid`) REFERENCES `phplogin_members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sites`
--

DROP TABLE IF EXISTS `sites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sites` (
  `site_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `port` tinyint(1) NOT NULL DEFAULT '0',
  `site_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `site_notes` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`site_id`),
  UNIQUE KEY `Name` (`site_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sites_gps`
--

DROP TABLE IF EXISTS `sites_gps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sites_gps` (
  `gps_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(10) unsigned NOT NULL,
  `north` decimal(8,5) NOT NULL,
  `east` decimal(8,5) NOT NULL,
  `gps_notes` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`gps_id`),
  KEY `site_id` (`site_id`),
  CONSTRAINT `sites_gps_ibfk_1` FOREIGN KEY (`site_id`) REFERENCES `sites` (`site_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-07-25 12:31:22
