/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 5.6.21 : Database - pegada_energetica
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`pegada_energetica` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `pegada_energetica`;

/*Table structure for table `authassignment` */

DROP TABLE IF EXISTS `authassignment`;

CREATE TABLE `authassignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`),
  CONSTRAINT `authassignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `authassignment` */

insert  into `authassignment`(`itemname`,`userid`,`bizrule`,`data`) values ('Admin','1',NULL,'N;');

/*Table structure for table `authitem` */

DROP TABLE IF EXISTS `authitem`;

CREATE TABLE `authitem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `authitem` */

insert  into `authitem`(`name`,`type`,`description`,`bizrule`,`data`) values ('Admin',2,NULL,NULL,'N;'),('Authenticated',2,NULL,NULL,'N;'),('Guest',2,NULL,NULL,'N;');

/*Table structure for table `authitemchild` */

DROP TABLE IF EXISTS `authitemchild`;

CREATE TABLE `authitemchild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `authitemchild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `authitemchild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `authitemchild` */

/*Table structure for table `cae` */

DROP TABLE IF EXISTS `cae`;

CREATE TABLE `cae` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `cae` */

/*Table structure for table `cliente` */

DROP TABLE IF EXISTS `cliente`;

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilizador` int(11) NOT NULL,
  `empresa` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`utilizador`),
  KEY `empresa` (`empresa`),
  CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`utilizador`) REFERENCES `utilizador` (`id`),
  CONSTRAINT `cliente_ibfk_2` FOREIGN KEY (`empresa`) REFERENCES `empresa` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `cliente` */

/*Table structure for table `empresa` */

DROP TABLE IF EXISTS `empresa`;

CREATE TABLE `empresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `localidade` varchar(50) NOT NULL,
  `cae` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cae` (`cae`),
  CONSTRAINT `empresa_ibfk_1` FOREIGN KEY (`cae`) REFERENCES `cae` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `empresa` */

/*Table structure for table `equipamento` */

DROP TABLE IF EXISTS `equipamento`;

CREATE TABLE `equipamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `potencia` int(11) NOT NULL,
  `horas` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `consumo` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `potencia` (`potencia`),
  CONSTRAINT `equipamento_ibfk_1` FOREIGN KEY (`potencia`) REFERENCES `potencia` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `equipamento` */

/*Table structure for table `potencia` */

DROP TABLE IF EXISTS `potencia`;

CREATE TABLE `potencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `potencia` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `potencia` */

/*Table structure for table `profiles` */

DROP TABLE IF EXISTS `profiles`;

CREATE TABLE `profiles` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(50) NOT NULL DEFAULT '',
  `firstname` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`user_id`),
  CONSTRAINT `user_profile_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `profiles` */

insert  into `profiles`(`user_id`,`lastname`,`firstname`) values (1,'Admin','Administrator'),(2,'Demo','Demo');

/*Table structure for table `profiles_fields` */

DROP TABLE IF EXISTS `profiles_fields`;

CREATE TABLE `profiles_fields` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `varname` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `field_type` varchar(50) NOT NULL,
  `field_size` varchar(15) NOT NULL DEFAULT '0',
  `field_size_min` varchar(15) NOT NULL DEFAULT '0',
  `required` int(1) NOT NULL DEFAULT '0',
  `match` varchar(255) NOT NULL DEFAULT '',
  `range` varchar(255) NOT NULL DEFAULT '',
  `error_message` varchar(255) NOT NULL DEFAULT '',
  `other_validator` varchar(5000) NOT NULL DEFAULT '',
  `default` varchar(255) NOT NULL DEFAULT '',
  `widget` varchar(255) NOT NULL DEFAULT '',
  `widgetparams` varchar(5000) NOT NULL DEFAULT '',
  `position` int(3) NOT NULL DEFAULT '0',
  `visible` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `varname` (`varname`,`widget`,`visible`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `profiles_fields` */

insert  into `profiles_fields`(`id`,`varname`,`title`,`field_type`,`field_size`,`field_size_min`,`required`,`match`,`range`,`error_message`,`other_validator`,`default`,`widget`,`widgetparams`,`position`,`visible`) values (1,'lastname','Last Name','VARCHAR','50','3',1,'','','Incorrect Last Name (length between 3 and 50 characters).','','','','',1,3),(2,'firstname','First Name','VARCHAR','50','3',1,'','','Incorrect First Name (length between 3 and 50 characters).','','','','',0,3);

/*Table structure for table `profissional` */

DROP TABLE IF EXISTS `profissional`;

CREATE TABLE `profissional` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilizador` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`utilizador`),
  CONSTRAINT `profissional_ibfk_1` FOREIGN KEY (`utilizador`) REFERENCES `utilizador` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `profissional` */

/*Table structure for table `rights` */

DROP TABLE IF EXISTS `rights`;

CREATE TABLE `rights` (
  `itemname` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  PRIMARY KEY (`itemname`),
  CONSTRAINT `rights_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `rights` */

/*Table structure for table `simulacao` */

DROP TABLE IF EXISTS `simulacao`;

CREATE TABLE `simulacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa` int(11) NOT NULL,
  `data` date NOT NULL,
  `consumo_total` double NOT NULL,
  `equipamento` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `empresa` (`empresa`),
  KEY `equipamento` (`equipamento`),
  CONSTRAINT `simulacao_ibfk_1` FOREIGN KEY (`empresa`) REFERENCES `empresa` (`id`),
  CONSTRAINT `simulacao_ibfk_2` FOREIGN KEY (`equipamento`) REFERENCES `equipamento` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `simulacao` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `activkey` varchar(128) NOT NULL DEFAULT '',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastvisit_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `superuser` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `status` (`status`),
  KEY `superuser` (`superuser`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`password`,`email`,`activkey`,`create_at`,`lastvisit_at`,`superuser`,`status`) values (1,'admin','21232f297a57a5a743894a0e4a801fc3','webmaster@example.com','9a24eff8c15a6a141ece27eb6947da0f','2015-04-22 12:32:11','2015-04-22 13:37:19',1,1),(2,'demo','fe01ce2a7fbac8fafaed7c982a04e229','demo@example.com','099f825543f7850cc038b90aaff39fac','2015-04-22 12:32:11','0000-00-00 00:00:00',0,1);

/*Table structure for table `utilizador` */

DROP TABLE IF EXISTS `utilizador`;

CREATE TABLE `utilizador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `contacto` int(9) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `utilizador` */

/*Table structure for table `visita` */

DROP TABLE IF EXISTS `visita`;

CREATE TABLE `visita` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` date NOT NULL,
  `empresa` int(11) NOT NULL,
  `profissional` int(11) NOT NULL,
  `equipamento` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `empresa` (`empresa`),
  KEY `profissional` (`profissional`),
  KEY `equipamento` (`equipamento`),
  CONSTRAINT `visita_ibfk_1` FOREIGN KEY (`empresa`) REFERENCES `empresa` (`id`),
  CONSTRAINT `visita_ibfk_2` FOREIGN KEY (`profissional`) REFERENCES `profissional` (`id`),
  CONSTRAINT `visita_ibfk_3` FOREIGN KEY (`equipamento`) REFERENCES `equipamento` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `visita` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;