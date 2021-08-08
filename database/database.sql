/*
SQLyog Enterprise v12.09 (64 bit)
MySQL - 10.4.8-MariaDB : Database - penelitian
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`penelitian` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `penelitian`;

/*Table structure for table `evaluasi` */

DROP TABLE IF EXISTS `evaluasi`;

CREATE TABLE `evaluasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_penelitian` int(11) DEFAULT NULL,
  `status` varchar(120) DEFAULT NULL,
  `komentar` text DEFAULT NULL,
  `id_pengecek` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `evaluasi` */

/*Table structure for table `penelitian` */

DROP TABLE IF EXISTS `penelitian`;

CREATE TABLE `penelitian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `judul` varchar(120) DEFAULT NULL,
  `lokasi` varchar(120) DEFAULT NULL,
  `jumlah_anggota` int(11) DEFAULT NULL,
  `jumlah_biaya` double DEFAULT NULL,
  `objek_penelitian` varchar(120) DEFAULT NULL,
  `masa_pelaksanaan` year(4) DEFAULT NULL,
  `target_temuan` varchar(120) DEFAULT NULL,
  `abstrak` text DEFAULT NULL,
  `tanggal_pelaksanaan` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `aktif` tinyint(1) DEFAULT 1,
  `anggota` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `penelitian` */

/*Table structure for table `penilaian` */

DROP TABLE IF EXISTS `penilaian`;

CREATE TABLE `penilaian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_penelitian` int(11) DEFAULT NULL,
  `id_penilai` int(11) DEFAULT NULL,
  `pernyataan` text DEFAULT NULL,
  `bobot` int(11) DEFAULT NULL,
  `nilai` float DEFAULT NULL,
  `skor` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

/*Data for the table `penilaian` */

/*Table structure for table `pernyataan` */

DROP TABLE IF EXISTS `pernyataan`;

CREATE TABLE `pernyataan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_evaluasi` int(11) DEFAULT NULL,
  `pernyataan` text DEFAULT NULL,
  `bobot` int(11) DEFAULT NULL,
  `nilai` float DEFAULT NULL,
  `skor` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pernyataan` */

/*Table structure for table `tahapan` */

DROP TABLE IF EXISTS `tahapan`;

CREATE TABLE `tahapan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_penelitian` int(11) DEFAULT NULL,
  `file` text DEFAULT NULL,
  `status` varchar(120) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tahapan` */

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nip` varchar(120) DEFAULT NULL,
  `nama` varchar(120) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `telepon` varchar(120) DEFAULT NULL,
  `username` varchar(120) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `golongan` varchar(120) DEFAULT NULL,
  `jabatan_struktural` varchar(120) DEFAULT NULL,
  `jabatan_fungsional` varchar(120) DEFAULT NULL,
  `role` varchar(120) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

/*Data for the table `user` */

insert  into `user`(`id`,`nip`,`nama`,`email`,`telepon`,`username`,`password`,`golongan`,`jabatan_struktural`,`jabatan_fungsional`,`role`,`created_at`) values (7,'123456789','Admin','admin@mail.com','089693943932','bimafebriansyah','$2y$10$dY.FMZBxzBhjHdBf9C6QZezHjqO5lQSciL6hQbNqpkigv6Zw5yXza','1','Department IT',NULL,'admin','2021-07-31 10:33:25');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
