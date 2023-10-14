/*
SQLyog Ultimate v12.5.0 (64 bit)
MySQL - 10.4.28-MariaDB : Database - support_poor_students
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`support_poor_students` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `support_poor_students`;

/*Table structure for table `academic_degree` */

DROP TABLE IF EXISTS `academic_degree`;

CREATE TABLE `academic_degree` (
  `academic_degree_id` int(11) NOT NULL AUTO_INCREMENT,
  `degree_title` varchar(50) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`academic_degree_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `academic_degree` */

insert  into `academic_degree`(`academic_degree_id`,`degree_title`,`created_at`,`updated_at`) values 
(1,'Matric','2023-09-23',NULL),
(2,'Intermediate','2023-09-23',NULL),
(3,'Bachelor\'s','2023-09-23',NULL),
(4,'Master\'s','2023-09-23',NULL),
(5,'Diploma','2023-09-23',NULL);

/*Table structure for table `academic_degree_attachment` */

DROP TABLE IF EXISTS `academic_degree_attachment`;

CREATE TABLE `academic_degree_attachment` (
  `academic_degree_attachment_id` int(11) NOT NULL AUTO_INCREMENT,
  `beneficiary_id` int(11) DEFAULT NULL,
  `academic_degree_attachment` text DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`academic_degree_attachment_id`),
  KEY `beneficiary_id` (`beneficiary_id`),
  CONSTRAINT `academic_degree_attachment_ibfk_1` FOREIGN KEY (`beneficiary_id`) REFERENCES `beneficiary` (`beneficiary_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


/*Table structure for table `beneficiary` */

DROP TABLE IF EXISTS `beneficiary`;

CREATE TABLE `beneficiary` (
  `beneficiary_id` int(11) NOT NULL AUTO_INCREMENT,
  `academic_degree_id` int(11) DEFAULT NULL,
  `applicant_first_name` varchar(25) NOT NULL,
  `applicant_middle_name` varchar(25) NOT NULL,
  `applicant_last_name` varchar(25) DEFAULT NULL,
  `applicant_gender` enum('Male','Female') NOT NULL,
  `applicant_contact_number` varchar(25) NOT NULL,
  `applicant_email` varchar(25) DEFAULT NULL,
  `applicant_date_of_birth` date NOT NULL,
  `applicant_cnic` varchar(25) NOT NULL,
  `applicant_current_address` text DEFAULT NULL,
  `applicant_permanent_address` text DEFAULT NULL,
  `applicant_picture` text DEFAULT NULL,
  `applicant_apply_for_stipend` enum('Yes','No') DEFAULT NULL,
  `applicant_eligible_receive_zakat` enum('Yes','No') DEFAULT NULL,
  `applicant_reason_receive_zakat` text DEFAULT NULL,
  `is_father_alive` enum('Yes','No') DEFAULT NULL,
  `father_death_certificate_image` text DEFAULT NULL,
  `father_cnic` varchar(25) DEFAULT NULL,
  `father_cnic_image` text DEFAULT NULL,
  `father_first_name` varchar(25) DEFAULT NULL,
  `father_middle_name` varchar(25) DEFAULT NULL,
  `father_last_name` varchar(25) DEFAULT NULL,
  `father_occupation` varchar(50) DEFAULT NULL,
  `applicant_currently_enrolled` enum('Yes','No') DEFAULT NULL,
  `applicant_university_admission_type` enum('Merit','Self') DEFAULT NULL,
  `unversity_id` int(11) DEFAULT NULL,
  `current_enrolled_year_id` int(11) DEFAULT NULL,
  `passing_degree_year` date DEFAULT NULL,
  `expense_Of_education` varchar(50) DEFAULT NULL,
  `applicant_currently_working` enum('Yes','No') DEFAULT NULL,
  `applicant_how_much_earn_per_month` varchar(50) DEFAULT NULL,
  `does_applicant_have_skills` enum('Yes','No') DEFAULT NULL,
  `what_applicant_skills` varchar(50) DEFAULT NULL,
  `applicant_receive_financial_help` enum('Yes','No') DEFAULT NULL,
  `how_much_applicant_received_financial_help` varchar(50) DEFAULT NULL,
  `from_where` varchar(50) DEFAULT NULL,
  `financial_help_image` text DEFAULT NULL,
  `total_number_of_family_member` varchar(25) DEFAULT NULL,
  `total_adults` varchar(25) DEFAULT NULL,
  `total_childrens` varchar(25) DEFAULT NULL,
  `total_monthly_family_income` varchar(50) DEFAULT NULL,
  `how_many_earning_family_members` varchar(25) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`beneficiary_id`),
  UNIQUE KEY `applicant_cnic` (`applicant_cnic`),
  UNIQUE KEY `applicant_email` (`applicant_email`),
  KEY `academic_degree_id` (`academic_degree_id`),
  KEY `unversity_id` (`unversity_id`),
  KEY `current_year_id` (`current_enrolled_year_id`),
  KEY `passing_degree_year_id` (`passing_degree_year`),
  CONSTRAINT `beneficiary_ibfk_1` FOREIGN KEY (`academic_degree_id`) REFERENCES `academic_degree` (`academic_degree_id`),
  CONSTRAINT `beneficiary_ibfk_2` FOREIGN KEY (`unversity_id`) REFERENCES `university` (`university_id`),
  CONSTRAINT `beneficiary_ibfk_3` FOREIGN KEY (`current_enrolled_year_id`) REFERENCES `current_enrolled_year` (`current_enrolled_year_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


/*Table structure for table `current_enrolled_year` */

DROP TABLE IF EXISTS `current_enrolled_year`;

CREATE TABLE `current_enrolled_year` (
  `current_enrolled_year_id` int(11) NOT NULL AUTO_INCREMENT,
  `enrolled_year` varchar(50) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`current_enrolled_year_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `current_enrolled_year` */

insert  into `current_enrolled_year`(`current_enrolled_year_id`,`enrolled_year`,`created_at`,`updated_at`) values 
(1,'First Year','2023-09-23',NULL),
(2,'Second Year','2023-09-23',NULL),
(3,'Third Year','2023-09-23',NULL),
(4,'Fourth Year','2023-09-23',NULL),
(5,'Fifth Year','2023-09-23',NULL);

/*Table structure for table `university` */

DROP TABLE IF EXISTS `university`;

CREATE TABLE `university` (
  `university_id` int(11) NOT NULL AUTO_INCREMENT,
  `university_name` text DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`university_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `university` */

insert  into `university`(`university_id`,`university_name`,`created_at`,`updated_at`) values 
(1,'Isra University (Hyderabad)','2023-09-23',NULL),
(2,'Liaquat University of Medical and Health Sciences (Jamshoro)','2023-09-23',NULL),
(3,'Mehran University of Engineering and Technology (Jamshoro)','2023-09-23',NULL),
(4,'Quaid-e-Awam University of Engineering, Science and Technology (Nawabshah)','2023-09-23',NULL),
(5,'Shah Abdul Latif University (Khairpur)','2023-09-23',NULL),
(6,'Sindh Agriculture University (Tandojam)','2023-09-23',NULL),
(7,'University of Sindh (Jamshoro)','2023-09-23',NULL);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(25) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `user` */

insert  into `user`(`user_id`,`first_name`,`last_name`,`email`,`password`,`created_at`,`updated_at`) values 
(1,'ali','khan','ali@gmail.com','12345','2023-09-23',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
