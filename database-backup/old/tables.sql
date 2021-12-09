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

/*Table structure for table `civil_status` */

DROP TABLE IF EXISTS `civil_status`;

CREATE TABLE `civil_status` (
  `idno` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `objid` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `name_civilstatus` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `civil_status` */

insert  into `civil_status`(`idno`,`objid`,`name_civilstatus`) values ('01','Single ','Single'),('02','Married','Married'),('03','Widow/Widower','Widow/Widower'),('04','Seperated/Annulled','Seperated/Annulled'),('05','Living with Partner','Living with Partner');

/*Table structure for table `tbl_allergy` */

DROP TABLE IF EXISTS `tbl_allergy`;

CREATE TABLE `tbl_allergy` (
  `idno` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `allergy` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_allergy` */

insert  into `tbl_allergy`(`idno`,`allergy`) values ('01','Drug'),('02','Food'),('03','Insect'),('04','Latex'),('05','Mold'),('06','Pet'),('07','Pollen'),('08','Vaccine and related products');

/*Table structure for table `tbl_category` */

DROP TABLE IF EXISTS `tbl_category`;

CREATE TABLE `tbl_category` (
  `idno` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `category` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_category` */

insert  into `tbl_category`(`idno`,`category`) values ('01','Health Care Worker'),('02','Senior Citizen'),('03','Indigent'),('04','Uniformed Personnel'),('05','Essential Worker'),('06','Other');

/*Table structure for table `tbl_category_id` */

DROP TABLE IF EXISTS `tbl_category_id`;

CREATE TABLE `tbl_category_id` (
  `idno` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `categ_id_type` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_category_id` */

insert  into `tbl_category_id`(`idno`,`categ_id_type`) values ('01','PRC number'),('02','OSCA number'),('03','Facility ID number'),('04','PWD ID'),('05','Other ID'),('06','Other ID');

/*Table structure for table `tbl_employment` */

DROP TABLE IF EXISTS `tbl_employment`;

CREATE TABLE `tbl_employment` (
  `idno` varchar(12) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_employment` */

insert  into `tbl_employment`(`idno`,`status`) values ('01','Government Employed'),('02','Private Employed'),('03','Self-Employed'),('04','Private Practitioner'),('05','Others');

/*Table structure for table `tbl_gender` */

DROP TABLE IF EXISTS `tbl_gender`;

CREATE TABLE `tbl_gender` (
  `idno` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `name_gender` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_gender` */

insert  into `tbl_gender`(`idno`,`name_gender`) values ('01','Female'),('02','Male'),('03','Not to disclose');

/*Table structure for table `tbl_infection` */

DROP TABLE IF EXISTS `tbl_infection`;

CREATE TABLE `tbl_infection` (
  `idno` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `classification` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_infection` */

insert  into `tbl_infection`(`idno`,`classification`) values ('01','Asymptomatic'),('02','Mild'),('03','Moderate'),('04','Severe'),('05','Critical');

/*Table structure for table `tbl_profession` */

DROP TABLE IF EXISTS `tbl_profession`;

CREATE TABLE `tbl_profession` (
  `idno` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `profession` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_profession` */

insert  into `tbl_profession`(`idno`,`profession`) values ('01','Dental Hygienist'),('02','Dental Technologist'),('03','Dentist'),('04','Medical Technologist'),('05','Midwife'),('06','Nurse'),('07','Nutritionist-Dietician'),('08','Occupational Therapist'),('09','Optemitrist'),('10','Pharmacist'),('11','Physical Therapist'),('12','Physician'),('13','Radiologic Therapist'),('14','Respiratory Therapist'),('15','X-ray Technologist'),('16','Barangay Health Worker'),('17','Maintenance Staff'),('18','Administrative Staff'),('19','Other');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
