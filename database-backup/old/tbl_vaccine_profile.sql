/*
SQLyog Ultimate v10.00 Beta1
MySQL - 8.0.22 : Database - sccdrrmo
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`sccdrrmo` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `sccdrrmo`;

/*Table structure for table `tbl_vaccine_profile` */

DROP TABLE IF EXISTS `tbl_vaccine_profile`;

CREATE TABLE `tbl_vaccine_profile` (
  `entity_no` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `datecreate` date DEFAULT NULL,
  `time_reg` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Category` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `CategoryID` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `IDNumber` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `PhilHealthID` int DEFAULT NULL,
  `Suffix` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Civil_status` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Employed` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Profession` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Direct_covid` tinyint DEFAULT '0',
  `Employer_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Employer_address` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Employer_contact_no` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Preg_status` tinyint DEFAULT '0',
  `W_allergy` tinyint DEFAULT '0',
  `Allergy` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `W_comorbidities` tinyint DEFAULT '0',
  `Comorbidity` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `covid_history` tinyint DEFAULT '0',
  `covid_date` date DEFAULT NULL,
  `covid_classification` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `consent` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`entity_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
