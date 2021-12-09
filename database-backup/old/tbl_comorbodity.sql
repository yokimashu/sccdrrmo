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

/*Table structure for table `tbl_comorbidity` */

DROP TABLE IF EXISTS `tbl_comorbidity`;

CREATE TABLE `tbl_comorbidity` (
  `idno` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `comorbidity` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_comorbidity` */

insert  into `tbl_comorbidity`(`idno`,`comorbidity`) values ('01','Hypertension'),('02','Heart disease'),('03','Kindey disease'),('04','Diabetes mellitus'),('05','Bronchial Asthma'),('06','Immunodefiency state'),('07','Cancer'),('08','Other');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;