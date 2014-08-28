# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.6.14)
# Database: record-trac
# Generation Time: 2014-08-28 15:59:32 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table closed_reasons
# ------------------------------------------------------------

LOCK TABLES `closed_reasons` WRITE;
/*!40000 ALTER TABLE `closed_reasons` DISABLE KEYS */;

INSERT INTO `closed_reasons` (`id`, `label`, `reason`)
VALUES
	(1,'Fulfilled - Records provided ','Copies / web links of records are provided, or the records were inspected. '),
	(2,'Fulfilled - Information redacted','Copies / web links of records are provided. We have released the portions of the record which are not exempt from disclosure by RCW 42.56 and /or other statutes, as noted on the records. Please contact us if you require additional information. '),
	(3,'Fulfilled - Sensitive information','We cannot upload your document online.  The records contain sensitive information only you can view. '),
	(4,'Closed - Records withheld','We cannot upload the documents you requested. An explanation of the withholding is provided.  Please contact us if you require additional information. '),
	(5,'Closed - Request abandoned','The request has been canceled or not clarified, or the request records were not claimed within thirty days.  Please contact us if you require additional information. '),
	(6,'Closed - Not a records request','This is not a public records request. Please contact us if you require additional information. '),
	(7,'Closed - No responsive records','No records have been located that are responsive to your request.  If you believe that the City is mistaken, please provide a more detailed description of the records you are seeking. ');

/*!40000 ALTER TABLE `closed_reasons` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table departments
# ------------------------------------------------------------

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;

INSERT INTO `departments` (`id`, `date_created`, `date_updated`, `name`, `contact_id`, `backup_id`)
VALUES
	(1,'2014-07-24 11:05:37','2014-07-24 11:05:37','Information Technology Services',1,2),
	(2,'2014-07-24 13:56:06','2014-07-24 13:56:06','Human Resources',2,1),
	(3,'2014-08-07 15:45:28','2014-08-07 15:45:28','City Manager\'s Office',1,2),
	(4,'2014-08-07 15:48:48','2014-08-07 15:49:02','Engineering',1,2),
	(5,'2014-08-07 15:48:49','2014-08-07 15:49:03','Planning',1,2),
	(6,'2014-08-07 15:48:49','2014-08-07 15:49:03','Police Department',1,2),
	(7,'2014-08-07 15:48:50','2014-08-07 15:49:04','Purchasing',1,2),
	(8,'2014-08-07 15:48:51','2014-08-07 15:49:05','Public Works',1,2),
	(9,'2014-08-07 15:48:52','2014-08-07 15:49:06','Utility Services',1,2),
	(10,'2014-08-07 15:48:53','2014-08-07 15:49:07','Water and Irrigation',1,2),
	(11,'2014-08-07 15:48:54','2014-08-07 15:49:08','Codes',1,2),
	(12,'2014-08-07 15:48:55','2014-08-07 15:49:08','Community Relations',1,2),
	(13,'2014-08-07 15:48:56','2014-08-07 15:49:09','Wastewater',1,2),
	(14,'2014-08-07 15:48:57','2014-08-07 15:49:10','Economic Development',1,2),
	(15,'2014-08-07 15:48:58','2014-08-07 15:49:11','Air Terminal',1,2),
	(16,'2014-08-07 15:48:59','2014-08-07 15:49:11','Fire Department',1,2),
	(17,'2014-08-07 15:48:59','2014-08-07 15:49:12','Legal',1,2),
	(18,'2014-08-07 15:49:00','2014-08-07 15:49:13','Transit',1,2),
	(19,'2014-08-07 15:49:01','2014-08-07 15:49:13','Finance',1,1),
	(20,'2014-08-07 15:49:33','2014-08-07 15:49:33','Clerks',1,2),
	(21,'2014-08-07 15:53:32','2014-08-07 15:53:32','Parks and Recreation',2,1);

/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table doc_types
# ------------------------------------------------------------

LOCK TABLES `doc_types` WRITE;
/*!40000 ALTER TABLE `doc_types` DISABLE KEYS */;

INSERT INTO `doc_types` (`id`, `name`, `department_id`)
VALUES
	(1,'Recruitment Records',2),
	(2,'Job Announcements',2),
	(3,'Job Applications',2),
	(4,'Equal Access Records',2),
	(5,'Workers\' Compensation Records',2),
	(6,'Civil Service Board Records',2),
	(7,'Cable Franchise Records',1),
	(8,'A/P Records',2),
	(9,'Accounting Records',19),
	(10,'Administrative Instructions',20),
	(11,'Americans with Disabilities Act Records',20),
	(12,'Annual Report Card',19),
	(13,'Bid Bond Forms',19),
	(14,'Boards and Commissions Agendas',20),
	(15,'Building Permit Records',5),
	(16,'Building Project Records',5),
	(17,'Building Records',5),
	(18,'Business Development Records',5),
	(19,'Business Permit Parking Application and Petition Forms',5),
	(20,'Business Tax Records',5),
	(21,'City Attorney Press Releases',17),
	(22,'City Budget Records',19),
	(23,'City Council Agendas',20),
	(24,'City Council Minutes',20),
	(25,'City Council Reports',20),
	(26,'City Manager\'s Correspondence',3),
	(27,'City of Accounting Records',19),
	(28,'Claims Records',20),
	(29,'Closed Session Agendas',20),
	(30,'Commercial Development Records',5),
	(31,'Complaints to Police Department',6),
	(32,'Construction Contracts',5),
	(33,'Contracts for Professional Services',7),
	(34,'Contracts of companies and individuals doing business with the city',7),
	(35,'Council records',20),
	(36,'Crime Report',6),
	(37,'Dog Attack Report',6),
	(38,'Financial Analysis of Ballot Measures',19),
	(39,'Financial Records',19),
	(40,'Fire Code Forms',16),
	(41,'Fire Department Citation Records',16),
	(42,'Fire Department Staffing Records',16),
	(43,'Fire Dispatch Records',16),
	(44,'Fire Dispatch Tapes',16),
	(45,'Fire Inspection Records',11),
	(46,'Fisher Golf Course Contracts',21),
	(47,'Fraud Waste and Abuse Reports',6),
	(48,'Hazardous Materials Forms',11),
	(49,'Historic Preservation Records',5),
	(50,'Housing Development Records',5),
	(51,'Housing Development Records',5),
	(52,'In-Car Video Recording',6),
	(53,'Inspection Records',11),
	(54,'Legal opinions from the City Attorney',17),
	(55,'Litigation Records',17),
	(56,'Local and Small Business Certification',5),
	(57,'Ordinances',20),
	(58,'Park Maintenance Records',21),
	(59,'Police Audio Recording',6),
	(60,'Police Department Employment Contract (MOU)',6),
	(61,'Police Department Publications',6),
	(62,'Police Training Record',6),
	(63,'Police Video Recording',6),
	(64,'Public Financing Compliance Reviews and Performance Audits',19),
	(65,'Purchase Records',7),
	(66,'Purchasing Records',7),
	(67,'Real Estate Services',5),
	(68,'Records on City Property for Sale',20),
	(69,'Residential Permit Parking Application and Petition Forms',5),
	(70,'Resolutions',20),
	(71,'Retirement Records',20),
	(72,'Revenue Records',19),
	(73,'Salary Records',19),
	(74,'Sewer Maintenance Records',13),
	(75,'Sidewalk Maintenance Records',8),
	(76,'Statements of Economic Interest',19),
	(77,'Street Maintenance Records',8),
	(78,'Traffic Accident',8),
	(79,'Traffic Control Plan Application',8),
	(80,'Traffic Enforcement Incident',8),
	(81,'Traffic Signal Maintenance Records',8),
	(82,'Traffic Studies',8),
	(83,'Transportation Plans',18),
	(84,'Airport Connector Records',15),
	(85,'Zoning Records',5);

/*!40000 ALTER TABLE `doc_types` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table extend_reasons
# ------------------------------------------------------------

LOCK TABLES `extend_reasons` WRITE;
/*!40000 ALTER TABLE `extend_reasons` DISABLE KEYS */;

INSERT INTO `extend_reasons` (`id`, `label`, `reason`)
VALUES
	(1,'Additional Time Needed','Pursuant to RCW 42.56.520, additional time is necessary to clarify the intent of the request and/or gather and review records, to determine whether any of the information requested is exempt from disclosure, and to provide third parties with notice and the opportunity to seek a court order to prevent the release of record(s) in response to your request.');

/*!40000 ALTER TABLE `extend_reasons` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table notes
# ------------------------------------------------------------

LOCK TABLES `notes` WRITE;
/*!40000 ALTER TABLE `notes` DISABLE KEYS */;

INSERT INTO `notes` (`id`, `created`, `text`, `request_id`, `user_id`, `staff_mins`, `type_id`)
VALUES
	(66,'2014-08-21 15:11:46','I have received this request and will begin work on it today.',106,1,NULL,1),
	(67,'2014-08-25 10:41:59','another note',106,1,32,1),
	(72,'2014-08-25 11:42:14','Pursuant to RCW 42.56.520, additional time is necessary to clarify the intent of the request and/or gather and review records, to determine whether any of the information requested is exempt from disclosure, and to provide third parties with notice and the opportunity to seek a court order to prevent the release of record(s) in response to your request.',106,1,0,2),
	(73,'2014-08-25 11:43:33','Copies / web links of records are provided, or the records were inspected. We cannot upload the documents you requested. An explanation of the withholding is provided.  Please contact us if you require additional information. ',106,1,0,3),
	(74,'2014-08-25 16:52:25','Dude, this is cool',106,1,NULL,1),
	(75,'2014-08-25 16:52:57','Copies / web links of records are provided, or the records were inspected. ',106,1,0,3),
	(76,'2014-08-25 16:56:19','Pursuant to RCW 42.56.520, additional time is necessary to clarify the intent of the request and/or gather and review records, to determine whether any of the information requested is exempt from disclosure, and to provide third parties with notice and the opportunity to seek a court order to prevent the release of record(s) in response to your request.',106,1,0,2),
	(78,'2014-08-26 14:14:40','This is not a public records request. Please contact us if you require additional information. ',105,1,0,3),
	(79,'2014-08-26 14:53:43','This is not a public records request. Please contact us if you require additional information. ',94,1,0,3),
	(80,'2014-08-26 15:20:55','This is not a public records request. Please contact us if you require additional information. ',67,1,0,3),
	(82,'2014-08-26 15:25:31','Copies / web links of records are provided. We have released the portions of the record which are not exempt from disclosure by RCW 42.56 and /or other statutes, as noted on the records. Please contact us if you require additional information. ',104,1,0,3),
	(83,'2014-08-26 15:46:06','This is not a public records request. Please contact us if you require additional information. ',107,1,0,3),
	(84,'2014-08-26 15:54:08','No records have been located that are responsive to your request.  If you believe that the City is mistaken, please provide a more detailed description of the records you are seeking. ',108,1,0,3),
	(85,'2014-08-27 15:17:42','Pursuant to RCW 42.56.520, additional time is necessary to clarify the intent of the request and/or gather and review records, to determine whether any of the information requested is exempt from disclosure, and to provide third parties with notice and the opportunity to seek a court order to prevent the release of record(s) in response to your request.',103,1,0,2),
	(86,'2014-08-27 15:19:27','Pursuant to RCW 42.56.520, additional time is necessary to clarify the intent of the request and/or gather and review records, to determine whether any of the information requested is exempt from disclosure, and to provide third parties with notice and the opportunity to seek a court order to prevent the release of record(s) in response to your request.',102,1,0,2);

/*!40000 ALTER TABLE `notes` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table notes_types
# ------------------------------------------------------------

LOCK TABLES `notes_types` WRITE;
/*!40000 ALTER TABLE `notes_types` DISABLE KEYS */;

INSERT INTO `notes_types` (`id`, `name`)
VALUES
	(1,'note'),
	(2,'extension'),
	(3,'closed');

/*!40000 ALTER TABLE `notes_types` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table offline_submissions
# ------------------------------------------------------------

LOCK TABLES `offline_submissions` WRITE;
/*!40000 ALTER TABLE `offline_submissions` DISABLE KEYS */;

INSERT INTO `offline_submissions` (`id`, `name`)
VALUES
	(1,'Fax'),
	(2,'Phone'),
	(3,'Email'),
	(4,'Mail'),
	(5,'In-Person');

/*!40000 ALTER TABLE `offline_submissions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table owners
# ------------------------------------------------------------

LOCK TABLES `owners` WRITE;
/*!40000 ALTER TABLE `owners` DISABLE KEYS */;

INSERT INTO `owners` (`id`, `user_id`, `request_id`, `active`, `reason`, `reason_unassigned`, `created`, `updated`, `is_point_person`)
VALUES
	(2,2,102,0,'Helper of Information Technology Services','He is the point of contact for this type of request','2014-07-30 11:17:14','2014-08-14 10:50:38',1),
	(8,1,66,1,'Point of Contact for Information Technology Services',NULL,'2014-08-01 16:49:57','2014-08-01 16:49:57',1),
	(9,2,66,1,'Backup for Information Technology Services',NULL,'2014-08-01 16:49:57','2014-08-01 16:49:57',0),
	(10,1,67,1,'Point of Contact for Information Technology Services',NULL,'2014-08-01 16:50:54','2014-08-01 16:50:54',1),
	(11,2,67,1,'Backup for Information Technology Services',NULL,'2014-08-01 16:50:54','2014-08-01 16:50:54',0),
	(12,1,68,1,'Point of Contact for Information Technology Services',NULL,'2014-08-01 16:51:24','2014-08-01 16:51:24',1),
	(13,2,68,1,'Backup for Information Technology Services',NULL,'2014-08-01 16:51:24','2014-08-01 16:51:24',0),
	(14,1,72,1,'Point of Contact for Information Technology Services',NULL,'2014-08-04 08:18:57','2014-08-04 08:18:57',1),
	(15,2,72,1,'Backup for Information Technology Services',NULL,'2014-08-04 08:18:57','2014-08-04 08:18:57',0),
	(16,1,73,1,'Point of Contact for Information Technology Services',NULL,'2014-08-04 08:21:36','2014-08-04 08:21:36',1),
	(17,2,73,1,'Backup for Information Technology Services',NULL,'2014-08-04 08:21:36','2014-08-04 08:21:36',0),
	(18,1,74,1,'Point of Contact for Information Technology Services',NULL,'2014-08-04 08:27:24','2014-08-04 08:27:24',1),
	(19,2,74,1,'Backup for Information Technology Services',NULL,'2014-08-04 08:27:24','2014-08-04 08:27:24',0),
	(20,1,75,1,'Point of Contact for Information Technology Services',NULL,'2014-08-04 08:27:41','2014-08-04 08:27:41',1),
	(21,2,75,1,'Backup for Information Technology Services',NULL,'2014-08-04 08:27:41','2014-08-04 08:27:41',0),
	(22,1,76,1,'Point of Contact for Information Technology Services',NULL,'2014-08-04 08:50:25','2014-08-04 08:50:25',1),
	(23,2,76,1,'Backup for Information Technology Services',NULL,'2014-08-04 08:50:25','2014-08-04 08:50:25',0),
	(24,1,77,1,'Point of Contact for Information Technology Services',NULL,'2014-08-04 11:31:59','2014-08-04 11:31:59',1),
	(25,2,77,1,'Backup for Information Technology Services',NULL,'2014-08-04 11:31:59','2014-08-04 11:31:59',0),
	(26,1,78,1,'Point of Contact for Information Technology Services',NULL,'2014-08-04 11:33:51','2014-08-04 11:33:51',1),
	(27,2,78,1,'Backup for Information Technology Services',NULL,'2014-08-04 11:33:51','2014-08-04 11:33:51',0),
	(28,1,79,1,'Point of Contact for Information Technology Services',NULL,'2014-08-04 11:36:42','2014-08-04 11:36:42',1),
	(29,2,79,1,'Backup for Information Technology Services',NULL,'2014-08-04 11:36:42','2014-08-04 11:36:42',0),
	(30,1,80,1,'Point of Contact for Information Technology Services',NULL,'2014-08-04 11:40:14','2014-08-04 11:40:14',1),
	(31,2,80,1,'Backup for Information Technology Services',NULL,'2014-08-04 11:40:14','2014-08-04 11:40:14',0),
	(32,1,81,1,'Point of Contact for Information Technology Services',NULL,'2014-08-04 12:00:26','2014-08-04 12:00:26',1),
	(33,2,81,1,'Backup for Information Technology Services',NULL,'2014-08-04 12:00:26','2014-08-04 12:00:26',0),
	(34,1,82,1,'Point of Contact for Information Technology Services',NULL,'2014-08-04 12:03:51','2014-08-04 12:03:51',1),
	(35,2,82,1,'Backup for Information Technology Services',NULL,'2014-08-04 12:03:51','2014-08-04 12:03:51',0),
	(36,1,83,1,'Point of Contact for Information Technology Services',NULL,'2014-08-04 12:05:34','2014-08-04 12:05:34',1),
	(37,2,83,1,'Backup for Information Technology Services',NULL,'2014-08-04 12:05:34','2014-08-04 12:05:34',0),
	(38,1,84,1,'Point of Contact for Information Technology Services',NULL,'2014-08-04 12:06:37','2014-08-04 12:06:37',1),
	(39,2,84,1,'Backup for Information Technology Services',NULL,'2014-08-04 12:06:37','2014-08-04 12:06:37',0),
	(40,1,85,1,'Point of Contact for Information Technology Services',NULL,'2014-08-04 12:59:42','2014-08-04 12:59:42',1),
	(41,2,85,1,'Backup for Information Technology Services',NULL,'2014-08-04 12:59:42','2014-08-04 12:59:42',0),
	(42,1,86,1,'Point of Contact for Information Technology Services',NULL,'2014-08-04 14:15:56','2014-08-04 14:15:56',1),
	(43,2,86,1,'Backup for Information Technology Services',NULL,'2014-08-04 14:15:56','2014-08-04 14:15:56',0),
	(44,1,87,1,'Point of Contact for Information Technology Services',NULL,'2014-08-04 14:16:23','2014-08-04 14:16:23',1),
	(45,2,87,1,'Backup for Information Technology Services',NULL,'2014-08-04 14:16:23','2014-08-04 14:16:23',0),
	(46,2,88,1,'Point of Contact for Human Resources',NULL,'2014-08-04 14:17:10','2014-08-04 14:17:10',1),
	(47,1,88,1,'Backup for Human Resources',NULL,'2014-08-04 14:17:10','2014-08-04 14:17:10',0),
	(48,1,89,1,'Point of Contact for Information Technology Services',NULL,'2014-08-04 15:38:00','2014-08-04 15:38:00',1),
	(49,2,89,1,'Backup for Information Technology Services',NULL,'2014-08-04 15:38:00','2014-08-04 15:38:00',0),
	(50,2,90,1,'Point of Contact for Human Resources',NULL,'2014-08-04 15:55:32','2014-08-04 15:55:32',1),
	(51,1,90,1,'Backup for Human Resources',NULL,'2014-08-04 15:55:32','2014-08-04 15:55:32',0),
	(52,1,91,1,'Point of Contact for Information Technology Services',NULL,'2014-08-04 16:00:37','2014-08-04 16:00:37',1),
	(53,2,91,1,'Backup for Information Technology Services',NULL,'2014-08-04 16:00:37','2014-08-04 16:00:37',0),
	(54,1,92,1,'Point of Contact for Information Technology Services',NULL,'2014-08-04 16:06:41','2014-08-04 16:06:41',1),
	(55,2,92,1,'Backup for Information Technology Services',NULL,'2014-08-04 16:06:41','2014-08-04 16:06:41',0),
	(56,1,93,1,'Point of Contact for Information Technology Services',NULL,'2014-08-04 16:09:24','2014-08-04 16:09:24',1),
	(57,2,93,1,'Backup for Information Technology Services',NULL,'2014-08-04 16:09:24','2014-08-04 16:09:24',0),
	(58,1,94,1,'Point of Contact for Information Technology Services',NULL,'2014-08-04 16:09:39','2014-08-04 16:09:39',1),
	(59,2,94,1,'Backup for Information Technology Services',NULL,'2014-08-04 16:09:39','2014-08-04 16:09:39',0),
	(60,2,95,1,'Point of Contact for Human Resources',NULL,'2014-08-04 16:12:25','2014-08-04 16:12:25',1),
	(61,1,95,1,'Backup for Human Resources',NULL,'2014-08-04 16:12:25','2014-08-04 16:12:25',0),
	(62,1,96,1,'Point of Contact for Information Technology Services',NULL,'2014-08-04 16:42:29','2014-08-04 16:42:29',1),
	(63,2,96,1,'Backup for Information Technology Services',NULL,'2014-08-04 16:42:29','2014-08-04 16:42:29',0),
	(64,1,97,1,'Point of Contact for Information Technology Services',NULL,'2014-08-04 16:53:13','2014-08-04 16:53:13',1),
	(65,2,97,1,'Backup for Information Technology Services',NULL,'2014-08-04 16:53:13','2014-08-04 16:53:13',0),
	(66,2,98,1,'Point of Contact for Human Resources',NULL,'2014-08-06 09:38:14','2014-08-06 09:38:14',1),
	(67,1,98,1,'Backup for Human Resources',NULL,'2014-08-06 09:38:14','2014-08-06 09:38:14',0),
	(68,19,98,1,'He loves networks',NULL,'2014-08-06 14:31:20','2014-08-06 14:31:20',0),
	(69,19,97,1,'He loves networks',NULL,'2014-08-06 14:31:20','2014-08-06 14:31:20',0),
	(70,2,99,1,'Point of Contact for Human Resources',NULL,'2014-08-07 11:32:59','2014-08-07 11:32:59',1),
	(71,1,99,1,'Backup for Human Resources',NULL,'2014-08-07 11:32:59','2014-08-07 11:32:59',0),
	(72,2,100,1,'Point of Contact for Human Resources',NULL,'2014-08-07 11:37:04','2014-08-07 11:37:04',1),
	(73,1,100,1,'Backup for Human Resources',NULL,'2014-08-07 11:37:04','2014-08-07 11:37:04',0),
	(74,1,101,0,'Point of Contact for Human Resources','Coz','2014-08-07 11:37:20','2014-08-14 11:49:52',1),
	(76,2,102,0,'Point of Contact for Human Resources','He is the point of contact for this type of request','2014-08-07 11:37:30','2014-08-14 10:55:00',1),
	(77,1,102,1,'Backup for Human Resources',NULL,'2014-08-07 11:37:30','2014-08-07 11:37:30',0),
	(78,2,103,0,'Point of Contact for Information Technology Services','He is the point of contact for this type of request','2014-08-07 13:51:50','2014-08-14 11:17:52',1),
	(79,2,103,1,'Backup for Information Technology Services',NULL,'2014-08-07 13:51:50','2014-08-07 13:51:50',0),
	(88,2,102,0,'He is the point of contact for this type of request','He is the point of contact for this type of request','2014-08-14 10:55:00','2014-08-14 10:56:45',1),
	(89,15,102,0,'He is the point of contact for this type of request','He is the point of contact for this type of request','2014-08-14 10:55:59','2014-08-14 10:57:19',1),
	(90,15,102,0,'He is the point of contact for this type of request','He','2014-08-14 10:56:45','2014-08-14 10:57:42',1),
	(91,1,102,0,'He is the point of contact for this type of request','He is the point of contact for this type of request','2014-08-14 10:57:19','2014-08-14 11:01:14',1),
	(92,1,102,0,'He','He is the point of contact for this type of request','2014-08-14 10:57:42','2014-08-14 11:13:03',1),
	(93,2,102,0,'He is the point of contact for this type of request','coz','2014-08-14 11:01:14','2014-08-14 12:30:14',1),
	(95,1,103,0,'He is the point of contact for this type of request','He is the point of contact for this type of request','2014-08-14 11:17:11','2014-08-14 11:18:41',1),
	(98,1,103,1,'He is the point of contact for this type of request',NULL,'2014-08-14 11:18:41','2014-08-14 11:18:41',1),
	(99,2,101,1,'Coz','He is the point of contact for this type of request','2014-08-14 11:49:52','2014-08-14 11:57:53',1),
	(100,1,101,0,'He is the point of contact for this type of request','He is the point of contact for this type of request','2014-08-14 11:57:53','2014-08-14 11:58:13',1),
	(101,2,101,0,'He is the point of contact for this type of request','Coz','2014-08-14 11:58:13','2014-08-14 11:58:25',1),
	(103,15,101,0,'He has the documents','coz','2014-08-14 12:13:06','2014-08-14 14:43:40',0),
	(107,1,101,0,'Coz','Task completed','2014-08-14 12:25:32','2014-08-14 14:49:36',0),
	(108,1,103,0,'coz','Task completed','2014-08-14 12:26:50','2014-08-14 15:40:43',0),
	(109,2,102,1,'coz',NULL,'2014-08-14 12:30:14','2014-08-14 12:30:14',1),
	(110,2,102,1,'coz',NULL,'2014-08-14 12:30:26','2014-08-14 12:30:26',0),
	(111,2,101,0,'zoa','Task completed','2014-08-14 13:36:29','2014-08-14 14:49:55',0),
	(115,1,101,1,'He has the documents',NULL,'2014-08-14 14:57:40','2014-08-14 14:57:40',0),
	(116,15,103,1,'He has the documents',NULL,'2014-08-14 15:49:42','2014-08-14 15:49:42',0),
	(117,1,104,1,'Point of Contact for Police Department',NULL,'2014-08-14 15:52:43','2014-08-14 15:52:43',1),
	(118,2,104,1,'Backup for Police Department',NULL,'2014-08-14 15:52:43','2014-08-14 15:52:43',0),
	(119,2,105,1,'Point of Contact for Human Resources',NULL,'2014-08-19 11:53:36','2014-08-19 11:53:36',1),
	(120,1,105,1,'Backup for Human Resources',NULL,'2014-08-19 11:53:36','2014-08-19 11:53:36',0),
	(121,2,106,1,'Point of Contact for Human Resources',NULL,'2014-08-19 11:54:39','2014-08-19 11:54:39',1),
	(122,1,106,1,'Backup for Human Resources',NULL,'2014-08-19 11:54:39','2014-08-19 11:54:39',0),
	(123,1,107,1,'Point of Contact for Information Technology Services',NULL,'2014-08-26 15:45:57','2014-08-26 15:45:57',1),
	(124,2,107,1,'Backup for Information Technology Services',NULL,'2014-08-26 15:45:57','2014-08-26 15:45:57',0),
	(125,1,108,1,'Point of Contact for Information Technology Services',NULL,'2014-08-26 15:54:02','2014-08-26 15:54:02',1),
	(126,2,108,1,'Backup for Information Technology Services',NULL,'2014-08-26 15:54:02','2014-08-26 15:54:02',0);

/*!40000 ALTER TABLE `owners` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table questions
# ------------------------------------------------------------

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;

INSERT INTO `questions` (`id`, `question`, `answer`, `request_id`, `creator_id`, `created`)
VALUES
	(3,'Did you mean Tony O\'Rourke? He is our city manager.','Yes!',106,1,'2014-08-27 09:46:37');

/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table records
# ------------------------------------------------------------

LOCK TABLES `records` WRITE;
/*!40000 ALTER TABLE `records` DISABLE KEYS */;

INSERT INTO `records` (`id`, `created`, `user_id`, `request_id`, `description`, `filename`, `url`, `access`, `staff_mins`)
VALUES
	(45,'2014-08-25 11:56:43',1,106,'The document was too darn large',NULL,'','Pick it up at the Clerk\'s window at City Hall',NULL),
	(46,'2014-08-25 11:58:23',1,106,'Outdoor','outdoor.png','','',NULL),
	(47,'2014-08-25 12:00:28',1,106,'Learn to spell','learntospell8x11.pdf','','',NULL);

/*!40000 ALTER TABLE `records` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table requests
# ------------------------------------------------------------

LOCK TABLES `requests` WRITE;
/*!40000 ALTER TABLE `requests` DISABLE KEYS */;

INSERT INTO `requests` (`id`, `created`, `due_date`, `extended`, `status_updated`, `text`, `status_id`, `requester_id`, `creator_id`, `department_id`, `date_received`, `offline_submission_id`)
VALUES
	(66,'2014-08-01 16:49:57','2014-08-08 04:49:57',NULL,'2014-08-27 14:08:11','I need a copy of all of Mayor Jean Deuxâs emails sent to City Manager Kenobi between July 30, 2013-August 8, 2013.',4,84,NULL,1,'2014-08-01 04:49:57',NULL),
	(67,'2014-08-01 16:50:54','2014-08-08 04:50:54',NULL,'2014-08-26 03:20:55','I need a copy of all of Mayor Jean Deuxâs emails sent to City Manager Kenobi between July 30, 2013-August 8, 2013.',2,85,NULL,8,'2014-08-01 04:50:54',NULL),
	(68,'2014-08-01 16:51:24','2014-08-08 04:51:24',NULL,'2014-08-27 14:08:11','I need a copy of all of Mayor Jean Deuxâs emails sent to City Manager Kenobi between July 30, 2013-August 8, 2013.',4,86,NULL,1,'2014-08-01 04:51:24',NULL),
	(72,'2014-08-04 08:18:57','2014-08-11 08:18:57',NULL,'2014-08-27 14:08:11','I need a copy of all of Mayor Jean Deuxâs emails sent to City Manager Kenobi between July 30, 2013-August 8, 2013.',4,90,NULL,1,'2014-08-04 08:18:57',NULL),
	(73,'2014-08-04 08:21:36','2014-08-11 08:21:36',NULL,'2014-08-27 14:08:11','I need a copy of all of Mayor Jean Deuxâs emails sent to City Manager Kenobi between July 30, 2013-August 8, 2013.',4,91,NULL,1,'2014-08-04 08:21:36',NULL),
	(74,'2014-08-04 08:27:24','2014-08-11 08:27:24',NULL,'2014-08-27 14:08:11','I need a copy of all of Mayor Jean Deuxâs emails sent to City Manager Kenobi between July 30, 2013-August 8, 2013.',4,92,NULL,1,'2014-08-04 08:27:24',NULL),
	(75,'2014-08-04 08:27:41','2014-08-11 08:27:41',NULL,'2014-08-27 14:08:11','I need a copy of all of Mayor Jean Deuxâs emails sent to City Manager Kenobi between July 30, 2013-August 8, 2013.',4,93,NULL,1,'2014-08-04 08:27:41',NULL),
	(76,'2014-08-04 08:50:25','2014-08-11 08:50:25',NULL,'2014-08-27 14:08:11','I need a copy of all of Mayor Jean Deuxâs emails sent to City Manager Kenobi between July 30, 2013-August 8, 2013.',4,94,NULL,6,'2014-08-04 08:50:25',NULL),
	(77,'2014-08-04 11:31:59','2014-08-11 11:31:59',NULL,'2014-08-27 14:08:11','I need a copy of all of Mayor Jean Deuxâs emails sent to City Manager Kenobi between July 30, 2013-August 8, 2013.',4,95,NULL,1,'2014-08-04 11:31:59',NULL),
	(78,'2014-08-04 11:33:51','2014-08-11 11:33:51',NULL,'2014-08-27 14:08:11','I need a copy of all of Mayor Jean Deuxâs emails sent to City Manager Kenobi between July 30, 2013-August 8, 2013.',4,96,NULL,1,'2014-08-04 11:33:51',NULL),
	(79,'2014-08-04 11:36:42','2014-08-11 11:36:42',NULL,'2014-08-27 14:08:11','I need a copy of all of Mayor Jean Deuxâs emails sent to City Manager Kenobi between July 30, 2013-August 8, 2013.',4,98,NULL,1,'2014-08-04 11:36:42',NULL),
	(80,'2014-08-04 11:40:14','2014-08-11 11:40:14',NULL,'2014-08-27 14:08:11','I need a copy of all of Mayor Jean Deuxâs emails sent to City Manager Kenobi between July 30, 2013-August 8, 2013.',4,99,NULL,1,'2014-08-04 11:40:14',NULL),
	(81,'2014-08-04 12:00:26','2014-08-11 12:00:25',NULL,'2014-08-27 14:08:11','I need a copy of all of Mayor Jean Deuxâs emails sent to City Manager Kenobi between July 30, 2013-August 8, 2013.',4,100,NULL,1,'2014-08-04 12:00:25',NULL),
	(82,'2014-08-04 12:03:51','2014-08-11 12:03:51',NULL,'2014-08-27 14:08:11','I need a copy of all of Mayor Jean Deuxâs emails sent to City Manager Kenobi between July 30, 2013-August 8, 2013.',4,101,NULL,1,'2014-08-04 12:03:51',NULL),
	(83,'2014-08-04 12:05:34','2014-08-11 12:05:34',NULL,'2014-08-27 14:08:11','I need a copy of all of Mayor Jean Deuxâs emails sent to City Manager Kenobi between July 30, 2013-August 8, 2013.',4,102,NULL,1,'2014-08-04 12:05:34',NULL),
	(84,'2014-08-04 12:06:37','2014-08-11 12:06:37',NULL,'2014-08-27 14:08:11','I need a copy of all of Mayor Jean Deuxâs emails sent to City Manager Kenobi between July 30, 2013-August 8, 2013.',4,103,NULL,1,'2014-08-04 12:06:37',NULL),
	(85,'2014-08-04 12:59:42','2014-08-11 12:59:42',NULL,'2014-08-27 14:08:11','I need a copy of all of Mayor Jean Deuxâs emails sent to City Manager Kenobi between July 30, 2013-August 8, 2013.',4,104,NULL,1,'2014-08-04 12:59:42',NULL),
	(86,'2014-08-04 14:15:56','2014-08-11 02:15:56',NULL,'2014-08-27 14:08:11','Per the procedure, we are making a public information request of the following: \r\n* Employees of the City \r\n* Name, work mailing address, work email address, work phone number \r\nIn the form of an Excel document on CD, or whichever is typically consistent with this type of request.',4,105,NULL,1,'2014-08-04 02:15:56',3),
	(87,'2014-08-04 14:16:23','2014-08-11 02:16:23',NULL,'2014-08-27 14:08:11','Per the procedure, we are making a public information request of the following: \r\n* Employees of the City \r\n* Name, work mailing address, work email address, work phone number \r\nIn the form of an Excel document on CD, or whichever is typically consistent with this type of request.',4,106,1,1,'2014-08-04 02:16:23',3),
	(88,'2014-08-04 14:17:10','2014-08-11 02:17:10',NULL,'2014-08-27 14:08:11','Per the procedure, we are making a public information request of the following: \r\n* Employees of the City \r\n* Name, work mailing address, work email address, work phone number \r\nIn the form of an Excel document on CD, or whichever is typically consistent with this type of request.',4,107,1,2,'2014-08-04 02:17:10',3),
	(89,'2014-08-04 15:38:00','2014-08-11 03:38:00',NULL,'2014-08-27 14:08:11','I need a copy of all of Mayor Jean Deuxâs emails sent to City Manager Kenobi between July 30, 2013-August 8, 2013.',4,108,NULL,1,'2014-08-04 03:38:00',NULL),
	(90,'2014-08-04 15:55:32','2014-08-11 03:55:32',NULL,'2014-08-27 14:08:11','I need a copy of all of Mayor Jean Deuxâs emails sent to City Manager Kenobi between July 30, 2013-August 8, 2013.',4,109,NULL,2,'2014-08-04 03:55:32',NULL),
	(91,'2014-08-04 16:00:37','2014-08-11 04:00:37',NULL,'2014-08-27 14:08:11','I need a copy of all of Mayor Jean Deuxâs emails sent to City Manager Kenobi between July 30, 2013-August 8, 2013.',4,110,NULL,1,'2014-08-04 04:00:37',NULL),
	(92,'2014-08-04 16:06:41','2014-08-11 04:06:41',NULL,'2014-08-27 14:08:11','I need a copy of all of Mayor Jean Deuxâs emails sent to City Manager Kenobi between July 30, 2013-August 8, 2013.\r\n\r\nThe emails should contain the words \"Art+Soul festival\" or \"Art + Soul City.\"',4,111,NULL,1,'2014-08-04 04:06:41',NULL),
	(93,'2014-08-04 16:09:24','2014-08-11 04:09:24',NULL,'2014-08-27 14:08:11','I need a copy of all of Mayor Jean Deuxâs emails sent to City Manager Kenobi between July 30, 2013-August 8, 2013.\r\n\r\nThe emails should contain the words \"Art+Soul festival\" or \"Art + Soul City.\"',4,112,NULL,1,'2014-08-04 04:09:24',NULL),
	(94,'2014-08-04 16:09:39','2014-08-11 04:09:39',NULL,'2014-08-26 02:53:43','I need a copy of all of Mayor Jean Deuxâs emails sent to City Manager Kenobi between July 30, 2013-August 8, 2013.\r\n\r\nThe emails should contain the words \"Art+Soul festival\" or \"Art + Soul City.\"',2,113,NULL,1,'2014-08-04 04:09:39',NULL),
	(95,'2014-08-04 16:12:24','2014-08-11 04:12:24',NULL,'2014-08-27 14:08:11','I need a copy of all of Mayor Jean Deuxâs emails sent to City Manager Kenobi between July 30, 2013-August 8, 2013.\r\n\r\nThe emails should contain the words \"Art+Soul festival\" or \"Art + Soul City.\"',4,114,NULL,2,'2014-08-04 04:12:24',NULL),
	(96,'2014-08-04 16:42:29','2014-08-11 04:42:29',NULL,'2014-08-27 14:08:11','I need a copy of all of Mayor Jean Deuxâs emails sent to City Manager Kenobi between July 30, 2013-August 8, 2013.\r\n\r\nThe emails should contain the words \"Art+Soul festival\" or \"Art + Soul City.\"',4,115,NULL,1,'2014-08-04 04:42:29',NULL),
	(97,'2014-08-04 16:53:13','2014-08-04 04:53:13',NULL,'2014-08-27 14:08:11','I need a copy of all of Mayor Jean Deuxâs emails sent to City Manager Kenobi between July 30, 2013-August 8, 2013.\r\n\r\nThe emails should contain the words \"Art+Soul festival\" or \"Art + Soul City.\"',4,116,NULL,1,'2014-08-04 04:53:13',NULL),
	(98,'2014-08-06 09:38:14','2014-08-13 09:38:14',NULL,'2014-08-27 14:08:11','I\'d like a copy of the contract and bid results for the roadway lighting project that got awarded to GE in 2014 for LED lighting. (this is just a test)',4,117,1,2,'2014-08-06 09:38:14',3),
	(99,'2014-08-07 11:32:59','2014-08-14 11:32:59',NULL,'2014-08-27 14:08:11','I need a copy of all of Mayor Jean Deuxâs emails sent to City Manager Kenobi between July 30, 2013-August 8, 2013.',4,53,NULL,2,'2014-08-07 11:32:59',NULL),
	(100,'2014-08-07 11:37:04','2014-08-14 11:37:04',NULL,'2014-08-27 14:08:11','I need a copy of all of Mayor Jean Deuxâs emails sent to City Manager Kenobi between July 30, 2013-August 8, 2013.',4,53,NULL,2,'2014-08-07 11:37:04',NULL),
	(101,'2014-08-07 11:37:20','2014-08-14 11:37:20',NULL,'2014-08-27 14:08:11','I need a copy of all of Mayor Jean Deuxâs emails sent to City Manager Kenobi between July 30, 2013-August 8, 2013.',4,53,NULL,2,'2014-08-07 11:37:20',NULL),
	(102,'2014-08-07 11:37:30','2014-08-28 11:37:30',1,'2014-08-27 15:20:47','I need a copy of all of Mayor Jean Deuxâs emails sent to City Manager Kenobi between July 30, 2013-August 8, 2013.',3,53,NULL,2,'2014-08-07 11:37:30',NULL),
	(103,'2014-08-07 13:51:50','2014-08-28 01:51:50',1,'2014-08-27 15:20:47','I would like all the emails be conducted between John Carney and Randy Bonds. ',3,120,NULL,1,'2014-08-07 01:51:50',NULL),
	(104,'2014-08-14 15:52:43','2014-08-21 03:52:43',NULL,'2014-08-26 03:25:31','Can you advise how I can obtain incident report from Oakland PD involving Mohammed F. Kahn on 3-4-2014. Driver crashed into fire hydrant and our fence was damged at Adeline Street. I requested this report back in April with a check for 12.50, they called and requested 2.00 more dollars which I provided with another check but have not seen report. I was hoping to check status',2,116,1,6,'2014-08-14 03:52:43',3),
	(105,'2014-08-19 11:53:36','2014-08-29 02:11:19',NULL,'2014-08-26 02:14:40','I need a copy of all of Mayor Jean Deuxâs emails sent to City Manager Kenobi between July 30, 2013-August 8, 2013.\r\n\r\nThe emails should contain the words \"Art+Soul festival\" or \"Art + Soul City.\"',2,122,NULL,2,'2014-08-19 11:53:36',NULL),
	(106,'2014-08-19 11:54:39','2014-09-08 04:52:57',1,'2014-08-25 08:18:55','I need a copy of all of Mayor Jean Deuxâs emails sent to City Manager Kenobi between July 30, 2013-August 8, 2013.\r\n\r\nThe emails should contain the words \"Art+Soul festival\" or \"Art + Soul City.\"',1,122,NULL,2,'2014-08-19 11:54:39',NULL),
	(107,'2014-08-26 15:45:57','2014-09-02 03:45:57',NULL,'2014-08-26 15:46:06','I need a copy of all of Mayor Jean Deuxâs emails sent to City Manager Kenobi between July 30, 2013-August 8, 2013.\r\n\r\nThe emails should contain the words \"Art+Soul festival\" or \"Art + Soul City.\"',2,122,1,1,'2014-08-26 03:45:57',NULL),
	(108,'2014-08-26 15:54:02','2014-09-02 03:54:02',NULL,'2014-08-26 15:54:08','I need a copy of all of Mayor Jean Deuxâs emails sent to City Manager Kenobi between July 30, 2013-August 8, 2013.\r\n\r\nThe emails should contain the words \"Art+Soul festival\" or \"Art + Soul City.\"',2,122,1,1,'2014-08-26 03:54:02',NULL);

/*!40000 ALTER TABLE `requests` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table statuses
# ------------------------------------------------------------

LOCK TABLES `statuses` WRITE;
/*!40000 ALTER TABLE `statuses` DISABLE KEYS */;

INSERT INTO `statuses` (`id`, `name`, `type`)
VALUES
	(1,'<span class=\"status status-success\"> &nbsp; </span> &nbsp;Open','private'),
	(2,'<span class=\"status status-closed\"> &nbsp; </span> &nbsp;Closed','public'),
	(3,'<span class=\"status status-warning\"> &nbsp; </span> &nbsp;Due Soon','private'),
	(4,'<span class=\"status status-danger\"> &nbsp; </span> &nbsp;Over Due','private');

/*!40000 ALTER TABLE `statuses` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table subscribers
# ------------------------------------------------------------

LOCK TABLES `subscribers` WRITE;
/*!40000 ALTER TABLE `subscribers` DISABLE KEYS */;

INSERT INTO `subscribers` (`id`, `should_notify`, `user_id`, `request_id`, `created`)
VALUES
	(5,1,NULL,66,'2014-08-01 16:49:57'),
	(6,NULL,NULL,67,'2014-08-01 16:50:54'),
	(7,NULL,NULL,68,'2014-08-01 16:51:24'),
	(8,NULL,NULL,72,'2014-08-04 08:18:57'),
	(9,NULL,NULL,73,NULL),
	(10,NULL,NULL,74,'2014-08-04 08:27:24'),
	(11,NULL,NULL,75,'2014-08-04 08:27:41'),
	(12,1,NULL,76,'2014-08-04 08:50:25'),
	(13,1,NULL,77,'2014-08-04 11:31:59'),
	(14,1,NULL,78,'2014-08-04 11:33:51'),
	(15,1,NULL,79,'2014-08-04 11:36:42'),
	(16,1,NULL,80,'2014-08-04 11:40:14'),
	(17,1,NULL,81,'2014-08-04 12:00:26'),
	(18,1,NULL,82,'2014-08-04 12:03:51'),
	(19,NULL,101,NULL,'2014-08-04 12:03:51'),
	(20,1,102,83,'2014-08-04 12:05:34'),
	(21,1,103,84,'2014-08-04 12:06:37'),
	(22,1,104,85,'2014-08-04 12:59:42'),
	(23,1,105,86,'2014-08-04 14:15:56'),
	(24,1,106,87,'2014-08-04 14:16:23'),
	(25,1,107,88,'2014-08-04 14:17:10'),
	(26,1,108,89,'2014-08-04 15:38:00'),
	(27,1,109,90,'2014-08-04 15:55:32'),
	(28,1,110,91,'2014-08-04 16:00:37'),
	(29,1,111,92,'2014-08-04 16:06:41'),
	(30,1,112,93,'2014-08-04 16:09:24'),
	(31,1,113,94,'2014-08-04 16:09:39'),
	(32,1,114,95,'2014-08-04 16:12:25'),
	(33,1,115,96,'2014-08-04 16:42:29'),
	(34,1,116,97,'2014-08-04 16:53:13'),
	(35,1,117,98,'2014-08-06 09:38:14'),
	(36,1,NULL,97,'2014-08-07 09:59:11'),
	(37,1,NULL,97,'2014-08-07 10:00:38'),
	(38,1,NULL,97,'2014-08-07 10:00:40'),
	(39,1,NULL,97,'2014-08-07 10:00:47'),
	(40,1,NULL,97,'2014-08-07 10:00:59'),
	(41,1,118,99,'2014-08-07 11:32:59'),
	(42,1,NULL,100,'2014-08-07 11:37:04'),
	(43,1,53,101,'2014-08-07 11:37:20'),
	(44,1,53,102,'2014-08-07 11:37:30'),
	(46,1,118,102,'2014-08-07 11:53:18'),
	(47,1,119,102,'2014-08-07 11:53:57'),
	(48,1,120,103,'2014-08-07 13:51:50'),
	(49,1,116,104,'2014-08-14 15:52:43'),
	(50,1,121,104,'2014-08-19 10:56:13'),
	(51,1,122,105,'2014-08-19 11:53:36'),
	(52,1,122,106,'2014-08-19 11:54:39'),
	(53,1,2,106,'2014-08-20 08:59:03'),
	(54,1,1,106,'2014-08-21 15:11:04'),
	(55,1,122,107,'2014-08-26 15:45:57'),
	(56,1,122,108,'2014-08-26 15:54:02');

/*!40000 ALTER TABLE `subscribers` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `alias`, `email`, `phone`, `created`, `password`, `department_id`, `is_admin`)
VALUES
	(1,'Admin User','admin@example.com','555.555.555','2014-07-24 11:34:04','2d5b5aced90077a16a83ae434475cfab9cec3462',1,1),
	(2,'Michael User','michael@example.com','555.555.555','2014-07-24 12:09:33','01c410966fa2d8f2fd771d39024fdcdc989d4f4b',2,1),
	(15,'John User','john@example.com','555.555.5555','2014-07-25 16:38:45','1b5938e7fd23f5faf4b5cdc93aa2d48e88756e03',1,0),
	(16,'Tom User','tom@example.com','555.555.5555','2014-07-25 16:39:10','e1beec020c29302ec9087bd210c23d289309f435',1,0),
	(19,'Ray User','ray@example.com','555.555.5555','2014-07-25 16:40:30','01802769709c5fbd0514afc5db76d48b444b4a95',1,0),
	(20,'Ethan User','ethan@example.com','555.555.5555','2014-07-25 16:41:06','1decd03211ac341bb989a7ad4a990e098b0c027f',1,0),
	(21,'Justin User','justin@example.com','555.555.5555','2014-07-25 16:41:33','522512b96bc5731f2397a72e3ea4ee1e3e803ff3',1,0),
	(22,'Wayne User','wayne@example.com','555.555.5555','2014-07-25 16:42:03','5cc3168c954624822b276ca3b5bde0f07fa5c0c9',1,0),
	(116,'Randy User','rexample@example.com','555.555.5555','2014-08-04 16:53:13',NULL,NULL,0),
	(117,'Tom User','texample@example.com','509.575.6602','2014-08-06 09:38:14',NULL,NULL,0),
	(118,NULL,'somedude@example.com',NULL,'2014-08-07 11:16:09',NULL,NULL,0),
	(120,'Agustin','augustin@example.com','','2014-08-07 13:51:50',NULL,NULL,0),
	(121,NULL,'rdizzle@example.com',NULL,'2014-08-19 10:56:13',NULL,NULL,0),
	(122,'','','','2014-08-19 11:53:36',NULL,NULL,0);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
