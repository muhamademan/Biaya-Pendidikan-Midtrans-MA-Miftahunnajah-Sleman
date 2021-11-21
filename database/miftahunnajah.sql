/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.37-MariaDB : Database - miftahunnajah
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`miftahunnajah` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `miftahunnajah`;

/*Table structure for table `biaya_bangunan` */

DROP TABLE IF EXISTS `biaya_bangunan`;

CREATE TABLE `biaya_bangunan` (
  `id_bangunan` int(11) NOT NULL AUTO_INCREMENT,
  `id_siswa` int(11) NOT NULL,
  `jenis_pembayaran` varchar(100) NOT NULL,
  `tahun_ajaran` varchar(100) NOT NULL,
  PRIMARY KEY (`id_bangunan`),
  KEY `id_siswa` (`id_siswa`),
  CONSTRAINT `biaya_bangunan_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

/*Data for the table `biaya_bangunan` */

insert  into `biaya_bangunan`(`id_bangunan`,`id_siswa`,`jenis_pembayaran`,`tahun_ajaran`) values (1,15,'Biaya Bangunan','2021/2022'),(11,8,'Biaya Bangunan','2019/2020'),(12,7,'Biaya Bangunan','2020/2021'),(13,9,'Biaya Bangunan','2019/2020'),(14,10,'Biaya Bangunan','2021/2022'),(15,11,'Biaya Bangunan','2021/2022'),(16,13,'Biaya Bangunan','2021/2022'),(31,14,'Biaya Bangunan','2021/2022'),(35,16,'Biaya Bangunan','2021/2022'),(36,17,'Biaya Bangunan','2021/2022'),(37,18,'Biaya Bangunan','2021/2022'),(38,19,'Biaya Bangunan','2021/2022'),(39,20,'Biaya Bangunan','2021/2022'),(40,21,'Biaya Bangunan','2021/2022'),(41,22,'Biaya Bangunan','2021/2022'),(42,23,'Biaya Bangunan','2021/2022'),(43,24,'Biaya Bangunan','2021/2022'),(44,25,'Biaya Bangunan','2021/2022'),(45,26,'Biaya Bangunan','2021/2022'),(46,27,'Biaya Bangunan','2021/2022'),(47,28,'Biaya Bangunan','2021/2022'),(48,29,'Biaya Bangunan','2021/2022'),(49,30,'Biaya Bangunan','2021/2022'),(50,31,'Biaya Bangunan','2021/2022'),(51,32,'Biaya Bangunan','2021/2022');

/*Table structure for table `biaya_spp` */

DROP TABLE IF EXISTS `biaya_spp`;

CREATE TABLE `biaya_spp` (
  `id_spp` int(11) NOT NULL AUTO_INCREMENT,
  `id_siswa` int(11) NOT NULL,
  `jenis_pembayaran` varchar(100) NOT NULL,
  `tahun_ajaran` varchar(255) NOT NULL,
  PRIMARY KEY (`id_spp`),
  KEY `id_siswa` (`id_siswa`)
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=latin1;

/*Data for the table `biaya_spp` */

insert  into `biaya_spp`(`id_spp`,`id_siswa`,`jenis_pembayaran`,`tahun_ajaran`) values (1,15,'Spp Bulanan','2021/2022'),(2,16,'Spp Bulanan','2021/2022'),(3,17,'Spp Bulanan','2021/2022'),(4,18,'Spp Bulanan','2021/2022'),(5,19,'Spp Bulanan','2021/2022'),(6,20,'Spp Bulanan','2021/2022'),(7,21,'Spp Bulanan','2021/2022'),(8,22,'Spp Bulanan','2021/2022'),(9,23,'Spp Bulanan','2021/2022'),(10,24,'Spp Bulanan','2021/2022'),(11,25,'Spp Bulanan','2021/2022'),(12,26,'Spp Bulanan','2021/2022'),(13,27,'Spp Bulanan','2021/2022'),(114,8,'Spp Bulanan','2019/2020'),(115,7,'Spp Bulanan','2020/2021'),(116,9,'Spp Bulanan','2019/2020'),(117,10,'Spp Bulanan','2021/2022'),(118,11,'Spp Bulanan','2021/2022'),(119,13,'Spp Bulanan','2021/2022'),(120,14,'Spp Bulanan','2021/2022'),(134,28,'Spp Bulanan','2021/2022'),(139,29,'Spp Bulanan','2021/2022'),(140,30,'Spp Bulanan','2021/2022'),(141,31,'Spp Bulanan','2021/2022'),(142,32,'Spp Bulanan','2021/2022');

/*Table structure for table `biaya_tahunan` */

DROP TABLE IF EXISTS `biaya_tahunan`;

CREATE TABLE `biaya_tahunan` (
  `id_tahunan` int(11) NOT NULL AUTO_INCREMENT,
  `id_siswa` int(11) NOT NULL,
  `jenis_pembayaran` varchar(100) NOT NULL,
  `tahun_ajaran` varchar(255) NOT NULL,
  PRIMARY KEY (`id_tahunan`),
  KEY `id_siswa` (`id_siswa`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;

/*Data for the table `biaya_tahunan` */

insert  into `biaya_tahunan`(`id_tahunan`,`id_siswa`,`jenis_pembayaran`,`tahun_ajaran`) values (1,15,'Biaya Tahunan','2021/2022'),(10,8,'Biaya Tahunan','2019/2020'),(11,7,'Biaya Tahunan','2020/2021'),(12,9,'Biaya Tahunan','2019/2020'),(13,10,'Biaya Tahunan','2021/2022'),(14,11,'Biaya Tahunan','2021/2022'),(15,13,'Biaya Tahunan','2021/2022'),(30,14,'Biaya Tahunan','2021/2022'),(38,16,'Biaya Tahunan','2021/2022'),(42,17,'Biaya Tahunan','2021/2022'),(43,18,'Biaya Tahunan','2021/2022'),(44,19,'Biaya Tahunan','2021/2022'),(53,20,'Biaya Tahunan','2021/2022'),(54,21,'Biaya Tahunan','2021/2022'),(55,22,'Biaya Tahunan','2021/2022'),(56,23,'Biaya Tahunan','2021/2022'),(57,24,'Biaya Tahunan','2021/2022'),(58,25,'Biaya Tahunan','2021/2022'),(59,26,'Biaya Tahunan','2021/2022'),(60,27,'Biaya Tahunan','2021/2022'),(66,28,'Biaya Tahunan','2021/2022'),(67,29,'Biaya Tahunan','2021/2022'),(68,30,'Biaya Tahunan','2021/2022'),(69,31,'Biaya Tahunan','2021/2022'),(70,32,'Biaya Tahunan','2021/2022');

/*Table structure for table `bulan` */

DROP TABLE IF EXISTS `bulan`;

CREATE TABLE `bulan` (
  `id_bulan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_bulan` varchar(15) NOT NULL,
  PRIMARY KEY (`id_bulan`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `bulan` */

insert  into `bulan`(`id_bulan`,`nama_bulan`) values (1,'Januari'),(2,'Februari'),(3,'Maret'),(4,'April'),(5,'Mei'),(6,'Juni'),(7,'Juli'),(8,'Agustus'),(9,'September'),(10,'Oktober'),(11,'November'),(12,'Desember');

/*Table structure for table `hapus_transaksi` */

DROP TABLE IF EXISTS `hapus_transaksi`;

CREATE TABLE `hapus_transaksi` (
  `id_hapus` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi` varchar(50) NOT NULL,
  `nis` varchar(30) NOT NULL,
  `id_bulan` int(11) NOT NULL,
  `id_tahun` int(11) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_hapus`),
  KEY `id_tahun` (`id_tahun`),
  CONSTRAINT `hapus_transaksi_ibfk_1` FOREIGN KEY (`id_tahun`) REFERENCES `tahun_ajaran` (`id_tahun`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `hapus_transaksi` */

insert  into `hapus_transaksi`(`id_hapus`,`id_transaksi`,`nis`,`id_bulan`,`id_tahun`,`tgl_bayar`,`id_user`) values (1,'0','12345678',5,3,'2021-04-19',9),(2,'0','12345678',4,3,'2021-04-19',9),(3,'0','12345678',5,3,'2021-04-19',9),(4,'0','12345678',4,3,'2021-04-19',9),(5,'0','1234567',1,3,'2021-04-20',9),(6,'0','1234567',1,3,'2021-04-20',9),(7,'0','1234567',1,3,'2021-04-20',9),(8,'0','5170411156',1,3,'2021-04-18',9),(9,'SPP-280421001','081327617223',2,1,'2021-04-28',2147483647),(10,'SPP-270421001','5170411156',5,3,'2021-04-27',2147483647),(11,'SPP-280421002','5170411156',6,3,'2021-04-28',9),(12,'SPP-280421001','5170411156',5,3,'2021-04-28',9),(13,'SPP-240421004','5170411156',4,3,'2021-04-24',9),(14,'SPP-240421003','5170411156',3,3,'2021-04-24',9),(15,'SPP-290421003','5170411156',3,3,'2021-04-29',9),(16,'SPP-300521002','5170411155',4,4,'2021-05-30',2147483647);

/*Table structure for table `kelas` */

DROP TABLE IF EXISTS `kelas`;

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(50) NOT NULL,
  PRIMARY KEY (`id_kelas`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `kelas` */

insert  into `kelas`(`id_kelas`,`nama_kelas`) values (1,'X'),(2,'XI'),(3,'XII'),(4,'XIIA'),(6,'Reguler i');

/*Table structure for table `pembayaran_bangunan` */

DROP TABLE IF EXISTS `pembayaran_bangunan`;

CREATE TABLE `pembayaran_bangunan` (
  `id_transaksi` varchar(50) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `nis` varchar(50) NOT NULL,
  `nama_siswa` varchar(50) NOT NULL,
  `id_bulan` int(11) NOT NULL,
  `id_tahun` int(11) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `metode_pembayaran` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `status` char(1) NOT NULL COMMENT '0=lunas, 1=pending, 2=error',
  `order_id` varchar(50) NOT NULL,
  KEY `id_tahun` (`id_tahun`),
  KEY `id_bulan` (`id_bulan`),
  CONSTRAINT `pembayaran_bangunan_ibfk_1` FOREIGN KEY (`id_bulan`) REFERENCES `bulan` (`id_bulan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pembayaran_bangunan` */

insert  into `pembayaran_bangunan`(`id_transaksi`,`id_siswa`,`nis`,`nama_siswa`,`id_bulan`,`id_tahun`,`tgl_bayar`,`metode_pembayaran`,`jumlah`,`id`,`status`,`order_id`) values ('BGN-290421001',7,'5170411156','Eman',1,3,'2021-04-29','Online',1500000,2147483647,'0','54507646'),('BGN-180521002',8,'2147483647','Mega Revilia',3,1,'2021-05-18','Online',1500000,9,'0','1206098710'),('BGN-180521004',11,'123456789','Anton Sunanto',3,4,'2021-05-18','Online',2000000,9,'0','1354444707'),('BGN-290521001',10,'5170411190','Salsa Bila',2,4,'2021-05-29','Online',2000000,9,'1','525034958'),('BGN-020621001',14,'5170411159','Afra Nafisah Makarim',1,4,'2021-06-02','Online',9000000,9,'0','191279941'),('BGN-020621002',16,'5170431156','Alimah Nur Latifah Alghina',1,4,'2021-06-02','Online',9000000,9,'0','248111408'),('BGN-020621003',18,'5170411256','Annisa Fadhilah',1,4,'2021-06-02','Online',9000000,9,'0','1497785696'),('BGN-020621004',20,'5170412356','Maulana Ashim',1,4,'2021-06-02','Online',9000000,9,'0','1987205059'),('BGN-020621005',23,'5170511156','Salma Rofifah',1,4,'2021-06-02','Online',9000000,9,'0','289889371'),('BGN-020621006',24,'5170911156','Sarah Syarifah Assyima',1,4,'2021-06-02','Online',9000000,9,'0','149531379'),('BGN-020621007',26,'5170411166','Shafiya Hanin',1,4,'2021-06-02','Online',9000000,9,'0','962224648');

/*Table structure for table `pembayaran_spp` */

DROP TABLE IF EXISTS `pembayaran_spp`;

CREATE TABLE `pembayaran_spp` (
  `id_transaksi` varchar(50) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `nis` varchar(30) NOT NULL,
  `nama_siswa` varchar(50) NOT NULL,
  `id_bulan` int(11) NOT NULL,
  `id_tahun` int(11) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `metode_pembayaran` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `status` char(1) NOT NULL COMMENT '0=lunas, 1=pending, 2=error',
  `order_id` varchar(50) NOT NULL,
  KEY `id_bulan` (`id_bulan`),
  KEY `id_tahun` (`id_tahun`),
  KEY `id_siswa` (`id_siswa`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pembayaran_spp` */

insert  into `pembayaran_spp`(`id_transaksi`,`id_siswa`,`nis`,`nama_siswa`,`id_bulan`,`id_tahun`,`tgl_bayar`,`metode_pembayaran`,`jumlah`,`id`,`status`,`order_id`) values ('SPP-230421001',8,'2147483647','Mega Revilia',1,1,'2021-04-23','Manual',175000,9,'0',''),('SPP-240421001',7,'5170411156','Eman',1,3,'2021-04-24','Manual',100000,9,'0',''),('SPP-240421002',7,'5170411156','Eman',2,3,'2021-04-24','Manual',100000,9,'0',''),('SPP-270421002',9,'081327617223','Muhamad Eman Sulaeman',1,1,'2021-04-27','Manual',175000,16,'0',''),('SPP-290421001',9,'081327617223','Muhamad Eman Sulaeman',2,1,'2021-04-29','Online',175000,9,'0','212772675'),('SPP-290421002',9,'081327617223','Muhamad Eman Sulaeman',3,1,'2021-04-29','Online',175000,2147483647,'0','244044835'),('SPP-110521001',10,'5170411190','Salsa Bila',1,4,'2021-05-11','Online',150000,2147483647,'0','1490062107'),('SPP-180521001',11,'123456789','Anton Sunanto',1,4,'2021-05-18','Online',150000,9,'0','791847303'),('SPP-180521002',11,'123456789','Anton Sunanto',2,4,'2021-05-18','Online',150000,9,'0','791847303'),('SPP-180521003',11,'123456789','Anton Sunanto',3,4,'2021-05-18','Online',150000,9,'0','791847303'),('SPP-180521004',11,'123456789','Anton Sunanto',4,4,'2021-05-18','Online',150000,9,'0','791847303'),('SPP-180521005',11,'123456789','Anton Sunanto',5,4,'2021-05-18','Online',150000,9,'0','791847303'),('SPP-180521006',11,'123456789','Anton Sunanto',6,4,'2021-05-18','Online',150000,9,'0','791847303'),('SPP-180521007',11,'123456789','Anton Sunanto',7,4,'2021-05-18','Online',150000,9,'0','791847303'),('SPP-180521008',11,'123456789','Anton Sunanto',8,4,'2021-05-18','Online',150000,9,'0','791847303'),('SPP-180521009',11,'123456789','Anton Sunanto',9,4,'2021-05-18','Online',150000,9,'0','791847303'),('SPP-180521010',11,'123456789','Anton Sunanto',10,4,'2021-05-18','Online',150000,9,'0','791847303'),('SPP-180521011',11,'123456789','Anton Sunanto',11,4,'2021-05-18','Online',150000,9,'0','791847303'),('SPP-180521012',11,'123456789','Anton Sunanto',12,4,'2021-05-18','Online',150000,9,'0','791847303'),('SPP-180521013',10,'5170411190','Salsa Bila',2,4,'2021-05-18','Online',150000,9,'0','2032585533'),('SPP-250521001',13,'5170411155','muhamad',1,4,'2021-05-25','Manual',150000,9,'0',''),('SPP-250521002',13,'5170411155','muhamad',2,4,'2021-05-25','Online',150000,9,'0','691495241'),('SPP-250521003',13,'5170411155','muhamad',3,4,'2021-05-25','Manual',150000,9,'0',''),('SPP-290521001',7,'5170411156','Eman',3,3,'2021-05-29','Online',100000,9,'0','2087774126'),('SPP-300521001',7,'5170411156','Eman',4,3,'2021-05-30','Online',100000,2147483647,'0','1411810765'),('SPP-020621001',14,'5170411159','Afra Nafisah Makarim',1,4,'2021-06-02','Online',700000,9,'0','1212460891'),('SPP-020621002',14,'5170411159','Afra Nafisah Makarim',2,4,'2021-06-02','Online',700000,9,'0','1212460891'),('SPP-020621003',14,'5170411159','Afra Nafisah Makarim',3,4,'2021-06-02','Online',700000,9,'0','1212460891'),('SPP-020621004',14,'5170411159','Afra Nafisah Makarim',4,4,'2021-06-02','Online',700000,9,'0','1212460891'),('SPP-020621005',14,'5170411159','Afra Nafisah Makarim',5,4,'2021-06-02','Online',700000,9,'0','1212460891'),('SPP-020621006',15,'5170421156','Aldino Diru Sansongko',1,4,'2021-06-02','Online',700000,9,'0','1834521147'),('SPP-020621007',15,'5170421156','Aldino Diru Sansongko',2,4,'2021-06-02','Online',700000,9,'0','1834521147'),('SPP-020621008',15,'5170421156','Aldino Diru Sansongko',3,4,'2021-06-02','Online',700000,9,'0','1834521147'),('SPP-020621009',15,'5170421156','Aldino Diru Sansongko',4,4,'2021-06-02','Online',700000,9,'0','1834521147'),('SPP-020621010',15,'5170421156','Aldino Diru Sansongko',5,4,'2021-06-02','Online',700000,9,'0','1834521147'),('SPP-020621011',16,'5170431156','Alimah Nur Latifah Alghina',1,4,'2021-06-02','Online',700000,9,'0','1167367622'),('SPP-020621012',16,'5170431156','Alimah Nur Latifah Alghina',2,4,'2021-06-02','Online',700000,9,'0','1167367622'),('SPP-020621013',16,'5170431156','Alimah Nur Latifah Alghina',3,4,'2021-06-02','Online',700000,9,'0','1167367622'),('SPP-020621014',16,'5170431156','Alimah Nur Latifah Alghina',4,4,'2021-06-02','Online',700000,9,'0','1167367622'),('SPP-020621015',16,'5170431156','Alimah Nur Latifah Alghina',5,4,'2021-06-02','Online',700000,9,'0','1167367622'),('SPP-020621016',17,'5170412156','Alvian Akhmad Mauzaki',1,4,'2021-06-02','Online',700000,9,'0','1419259825'),('SPP-020621017',17,'5170412156','Alvian Akhmad Mauzaki',2,4,'2021-06-02','Online',700000,9,'0','1419259825'),('SPP-020621018',17,'5170412156','Alvian Akhmad Mauzaki',3,4,'2021-06-02','Online',700000,9,'0','1419259825'),('SPP-020621019',17,'5170412156','Alvian Akhmad Mauzaki',4,4,'2021-06-02','Online',700000,9,'0','1419259825'),('SPP-020621020',17,'5170412156','Alvian Akhmad Mauzaki',5,4,'2021-06-02','Online',700000,9,'0','1419259825'),('SPP-020621021',18,'5170411256','Annisa Fadhilah',1,4,'2021-06-02','Online',700000,9,'0','1899291804'),('SPP-020621022',18,'5170411256','Annisa Fadhilah',2,4,'2021-06-02','Online',700000,9,'0','1899291804'),('SPP-020621023',18,'5170411256','Annisa Fadhilah',3,4,'2021-06-02','Online',700000,9,'0','1899291804'),('SPP-020621024',18,'5170411256','Annisa Fadhilah',4,4,'2021-06-02','Online',700000,9,'0','1899291804'),('SPP-020621025',18,'5170411256','Annisa Fadhilah',5,4,'2021-06-02','Online',700000,9,'0','1899291804'),('SPP-020621026',19,'5170451156','Fathiya Nabila Al Khonsa',1,4,'2021-06-02','Online',700000,9,'0','531420132'),('SPP-020621027',19,'5170451156','Fathiya Nabila Al Khonsa',2,4,'2021-06-02','Online',700000,9,'0','531420132'),('SPP-020621028',19,'5170451156','Fathiya Nabila Al Khonsa',3,4,'2021-06-02','Online',700000,9,'0','531420132'),('SPP-020621029',19,'5170451156','Fathiya Nabila Al Khonsa',4,4,'2021-06-02','Online',700000,9,'0','531420132'),('SPP-020621030',19,'5170451156','Fathiya Nabila Al Khonsa',5,4,'2021-06-02','Online',700000,9,'0','531420132'),('SPP-020621031',20,'5170412356','Maulana Ashim',1,4,'2021-06-02','Online',700000,9,'0','280537278'),('SPP-020621032',20,'5170412356','Maulana Ashim',2,4,'2021-06-02','Online',700000,9,'0','280537278'),('SPP-020621033',20,'5170412356','Maulana Ashim',3,4,'2021-06-02','Online',700000,9,'0','280537278'),('SPP-020621034',20,'5170412356','Maulana Ashim',4,4,'2021-06-02','Online',700000,9,'0','280537278'),('SPP-020621035',20,'5170412356','Maulana Ashim',5,4,'2021-06-02','Online',700000,9,'0','280537278'),('SPP-020621036',21,'5170481156','Mufida Husnia',1,4,'2021-06-02','Online',700000,9,'0','1336061292'),('SPP-020621037',21,'5170481156','Mufida Husnia',2,4,'2021-06-02','Online',700000,9,'0','1336061292'),('SPP-020621038',21,'5170481156','Mufida Husnia',3,4,'2021-06-02','Online',700000,9,'0','1336061292'),('SPP-020621039',21,'5170481156','Mufida Husnia',4,4,'2021-06-02','Online',700000,9,'0','1336061292'),('SPP-020621040',21,'5170481156','Mufida Husnia',5,4,'2021-06-02','Online',700000,9,'0','1336061292'),('SPP-020621041',22,'5180411156','Nur Faiq',1,4,'2021-06-02','Online',700000,9,'0','581826902'),('SPP-020621042',22,'5180411156','Nur Faiq',2,4,'2021-06-02','Online',700000,9,'0','581826902'),('SPP-020621043',22,'5180411156','Nur Faiq',3,4,'2021-06-02','Online',700000,9,'0','581826902'),('SPP-020621044',22,'5180411156','Nur Faiq',4,4,'2021-06-02','Online',700000,9,'0','581826902'),('SPP-020621045',22,'5180411156','Nur Faiq',5,4,'2021-06-02','Online',700000,9,'0','581826902'),('SPP-020621046',23,'5170511156','Salma Rofifah',1,4,'2021-06-02','Online',700000,9,'0','1598452160'),('SPP-020621047',23,'5170511156','Salma Rofifah',2,4,'2021-06-02','Online',700000,9,'0','1598452160'),('SPP-020621048',23,'5170511156','Salma Rofifah',3,4,'2021-06-02','Online',700000,9,'0','1598452160'),('SPP-020621049',23,'5170511156','Salma Rofifah',4,4,'2021-06-02','Online',700000,9,'0','1598452160'),('SPP-020621050',23,'5170511156','Salma Rofifah',5,4,'2021-06-02','Online',700000,9,'0','1598452160'),('SPP-020621051',24,'5170911156','Sarah Syarifah Assyima',1,4,'2021-06-02','Online',700000,9,'0','1690493266'),('SPP-020621052',24,'5170911156','Sarah Syarifah Assyima',2,4,'2021-06-02','Online',700000,9,'0','1690493266'),('SPP-020621053',24,'5170911156','Sarah Syarifah Assyima',3,4,'2021-06-02','Online',700000,9,'0','1690493266'),('SPP-020621054',24,'5170911156','Sarah Syarifah Assyima',4,4,'2021-06-02','Online',700000,9,'0','1690493266'),('SPP-020621055',24,'5170911156','Sarah Syarifah Assyima',5,4,'2021-06-02','Online',700000,9,'0','1690493266'),('SPP-020621056',25,'5170446956','Ulil Absor',1,4,'2021-06-02','Online',700000,9,'0','1971509516'),('SPP-020621057',25,'5170446956','Ulil Absor',2,4,'2021-06-02','Online',700000,9,'0','1971509516'),('SPP-020621058',25,'5170446956','Ulil Absor',3,4,'2021-06-02','Online',700000,9,'0','1971509516'),('SPP-020621059',25,'5170446956','Ulil Absor',4,4,'2021-06-02','Online',700000,9,'0','1971509516'),('SPP-020621060',25,'5170446956','Ulil Absor',5,4,'2021-06-02','Online',700000,9,'0','1971509516'),('SPP-020621061',26,'5170411166','Shafiya Hanin',1,4,'2021-06-02','Online',700000,9,'0','676230289'),('SPP-020621062',26,'5170411166','Shafiya Hanin',2,4,'2021-06-02','Online',700000,9,'0','676230289'),('SPP-020621063',26,'5170411166','Shafiya Hanin',3,4,'2021-06-02','Online',700000,9,'0','676230289'),('SPP-020621064',26,'5170411166','Shafiya Hanin',4,4,'2021-06-02','Online',700000,9,'0','676230289'),('SPP-020621065',26,'5170411166','Shafiya Hanin',5,4,'2021-06-02','Online',700000,9,'0','676230289'),('SPP-020621066',27,'5170411137','Aulia Khansa Nabila',1,4,'2021-06-02','Online',700000,9,'0','697699317'),('SPP-020621067',27,'5170411137','Aulia Khansa Nabila',2,4,'2021-06-02','Online',700000,9,'0','697699317'),('SPP-020621068',27,'5170411137','Aulia Khansa Nabila',3,4,'2021-06-02','Online',700000,9,'0','697699317'),('SPP-020621069',27,'5170411137','Aulia Khansa Nabila',4,4,'2021-06-02','Online',700000,9,'0','697699317'),('SPP-020621070',27,'5170411137','Aulia Khansa Nabila',5,4,'2021-06-02','Online',700000,9,'0','697699317'),('SPP-020621071',28,'5170411100','Halimah Nur Azizah',1,4,'2021-06-02','Online',700000,9,'0','1670970796'),('SPP-020621072',28,'5170411100','Halimah Nur Azizah',2,4,'2021-06-02','Online',700000,9,'0','1670970796'),('SPP-020621073',28,'5170411100','Halimah Nur Azizah',3,4,'2021-06-02','Online',700000,9,'0','1670970796'),('SPP-020621074',28,'5170411100','Halimah Nur Azizah',4,4,'2021-06-02','Online',700000,9,'0','1670970796'),('SPP-020621075',28,'5170411100','Halimah Nur Azizah',5,4,'2021-06-02','Online',700000,9,'0','1670970796'),('SPP-020621076',28,'5170411100','Halimah Nur Azizah',6,4,'2021-06-02','Online',700000,9,'0','1670970796'),('SPP-020621077',28,'5170411100','Halimah Nur Azizah',7,4,'2021-06-02','Online',700000,9,'0','1670970796'),('SPP-020621078',28,'5170411100','Halimah Nur Azizah',8,4,'2021-06-02','Online',700000,9,'0','1670970796'),('SPP-020621079',28,'5170411100','Halimah Nur Azizah',9,4,'2021-06-02','Online',700000,9,'0','1670970796'),('SPP-020621080',28,'5170411100','Halimah Nur Azizah',10,4,'2021-06-02','Online',700000,9,'0','1670970796'),('SPP-020621081',28,'5170411100','Halimah Nur Azizah',11,4,'2021-06-02','Online',700000,9,'0','1670970796'),('SPP-020621082',28,'5170411100','Halimah Nur Azizah',12,4,'2021-06-02','Online',700000,9,'0','1670970796'),('SPP-020621083',29,'5170411106','Salsabila Ristina',1,4,'2021-06-02','Online',700000,9,'0','1224237835'),('SPP-020621084',29,'5170411106','Salsabila Ristina',2,4,'2021-06-02','Online',700000,9,'0','1224237835'),('SPP-020621085',29,'5170411106','Salsabila Ristina',3,4,'2021-06-02','Online',700000,9,'0','1224237835'),('SPP-020621086',29,'5170411106','Salsabila Ristina',4,4,'2021-06-02','Online',700000,9,'0','1224237835'),('SPP-020621087',29,'5170411106','Salsabila Ristina',5,4,'2021-06-02','Online',700000,9,'0','1224237835'),('SPP-020621088',29,'5170411106','Salsabila Ristina',6,4,'2021-06-02','Online',700000,9,'0','1224237835'),('SPP-020621089',29,'5170411106','Salsabila Ristina',7,4,'2021-06-02','Online',700000,9,'0','1224237835'),('SPP-020621090',29,'5170411106','Salsabila Ristina',8,4,'2021-06-02','Online',700000,9,'0','1224237835'),('SPP-020621091',29,'5170411106','Salsabila Ristina',9,4,'2021-06-02','Online',700000,9,'0','1224237835'),('SPP-020621092',29,'5170411106','Salsabila Ristina',10,4,'2021-06-02','Online',700000,9,'0','1224237835'),('SPP-020621093',29,'5170411106','Salsabila Ristina',11,4,'2021-06-02','Online',700000,9,'0','1224237835'),('SPP-020621094',29,'5170411106','Salsabila Ristina',12,4,'2021-06-02','Online',700000,9,'0','1224237835'),('SPP-020621095',30,'5170411150','Muhammad Naufal Dzaky',1,4,'2021-06-02','Online',700000,9,'0','582190704'),('SPP-020621096',30,'5170411150','Muhammad Naufal Dzaky',2,4,'2021-06-02','Online',700000,9,'0','582190704'),('SPP-020621097',30,'5170411150','Muhammad Naufal Dzaky',3,4,'2021-06-02','Online',700000,9,'0','582190704'),('SPP-020621098',30,'5170411150','Muhammad Naufal Dzaky',4,4,'2021-06-02','Online',700000,9,'0','582190704'),('SPP-020621099',30,'5170411150','Muhammad Naufal Dzaky',5,4,'2021-06-02','Online',700000,9,'0','582190704'),('SPP-020621100',30,'5170411150','Muhammad Naufal Dzaky',6,4,'2021-06-02','Online',700000,9,'0','582190704'),('SPP-020621101',30,'5170411150','Muhammad Naufal Dzaky',7,4,'2021-06-02','Online',700000,9,'0','582190704'),('SPP-020621102',30,'5170411150','Muhammad Naufal Dzaky',8,4,'2021-06-02','Online',700000,9,'0','582190704'),('SPP-020621103',30,'5170411150','Muhammad Naufal Dzaky',9,4,'2021-06-02','Online',700000,9,'0','582190704'),('SPP-020621104',30,'5170411150','Muhammad Naufal Dzaky',10,4,'2021-06-02','Online',700000,9,'0','582190704'),('SPP-020621105',30,'5170411150','Muhammad Naufal Dzaky',11,4,'2021-06-02','Online',700000,9,'0','582190704'),('SPP-020621106',30,'5170411150','Muhammad Naufal Dzaky',12,4,'2021-06-02','Online',700000,9,'0','582190704'),('SPP-020621107',31,'5174411156','Syarifatul Hadijah',1,4,'2021-06-02','Online',700000,9,'0','1977538963'),('SPP-020621108',31,'5174411156','Syarifatul Hadijah',2,4,'2021-06-02','Online',700000,9,'0','1977538963'),('SPP-020621109',31,'5174411156','Syarifatul Hadijah',3,4,'2021-06-02','Online',700000,9,'0','1977538963'),('SPP-020621110',31,'5174411156','Syarifatul Hadijah',4,4,'2021-06-02','Online',700000,9,'0','1977538963'),('SPP-020621111',31,'5174411156','Syarifatul Hadijah',5,4,'2021-06-02','Online',700000,9,'0','1977538963'),('SPP-020621112',31,'5174411156','Syarifatul Hadijah',6,4,'2021-06-02','Online',700000,9,'0','1977538963'),('SPP-020621113',31,'5174411156','Syarifatul Hadijah',7,4,'2021-06-02','Online',700000,9,'0','1977538963'),('SPP-020621114',31,'5174411156','Syarifatul Hadijah',8,4,'2021-06-02','Online',700000,9,'0','1977538963'),('SPP-020621115',31,'5174411156','Syarifatul Hadijah',9,4,'2021-06-02','Online',700000,9,'0','1977538963'),('SPP-020621116',31,'5174411156','Syarifatul Hadijah',10,4,'2021-06-02','Online',700000,9,'0','1977538963'),('SPP-020621117',31,'5174411156','Syarifatul Hadijah',11,4,'2021-06-02','Online',700000,9,'0','1977538963'),('SPP-020621118',31,'5174411156','Syarifatul Hadijah',12,4,'2021-06-02','Online',700000,9,'0','1977538963'),('SPP-020621119',32,'5170422256','Hasna Afifah Hijriah',1,4,'2021-06-02','Online',700000,9,'0','333923839'),('SPP-020621120',32,'5170422256','Hasna Afifah Hijriah',2,4,'2021-06-02','Online',700000,9,'0','333923839'),('SPP-020621121',32,'5170422256','Hasna Afifah Hijriah',3,4,'2021-06-02','Online',700000,9,'0','333923839'),('SPP-020621122',32,'5170422256','Hasna Afifah Hijriah',4,4,'2021-06-02','Online',700000,9,'0','333923839'),('SPP-020621123',32,'5170422256','Hasna Afifah Hijriah',5,4,'2021-06-02','Online',700000,9,'0','333923839'),('SPP-020621124',32,'5170422256','Hasna Afifah Hijriah',6,4,'2021-06-02','Online',700000,9,'0','333923839'),('SPP-020621125',32,'5170422256','Hasna Afifah Hijriah',7,4,'2021-06-02','Online',700000,9,'0','333923839'),('SPP-020621126',32,'5170422256','Hasna Afifah Hijriah',8,4,'2021-06-02','Online',700000,9,'0','333923839'),('SPP-020621127',32,'5170422256','Hasna Afifah Hijriah',9,4,'2021-06-02','Online',700000,9,'0','333923839'),('SPP-020621128',32,'5170422256','Hasna Afifah Hijriah',10,4,'2021-06-02','Online',700000,9,'0','333923839'),('SPP-020621129',32,'5170422256','Hasna Afifah Hijriah',11,4,'2021-06-02','Online',700000,9,'0','333923839'),('SPP-020621130',32,'5170422256','Hasna Afifah Hijriah',12,4,'2021-06-02','Online',700000,9,'1','333923839');

/*Table structure for table `pembayaran_tahunan` */

DROP TABLE IF EXISTS `pembayaran_tahunan`;

CREATE TABLE `pembayaran_tahunan` (
  `id_transaksi` varchar(50) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `nis` varchar(50) NOT NULL,
  `nama_siswa` varchar(50) NOT NULL,
  `id_bulan` int(11) NOT NULL,
  `id_tahun` int(11) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `metode_pembayaran` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `status` char(1) NOT NULL COMMENT '0=lunas, 1=pending, 2=error',
  `order_id` varchar(50) NOT NULL,
  KEY `id_bulan` (`id_bulan`),
  KEY `id_tahun` (`id_tahun`),
  KEY `id_siswa` (`id_siswa`),
  CONSTRAINT `pembayaran_tahunan_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pembayaran_tahunan` */

insert  into `pembayaran_tahunan`(`id_transaksi`,`id_siswa`,`nis`,`nama_siswa`,`id_bulan`,`id_tahun`,`tgl_bayar`,`metode_pembayaran`,`jumlah`,`id`,`status`,`order_id`) values ('THN-180521001',7,'5170411156','Eman',5,3,'2021-05-18','Online',1100000,9,'0','1589072268'),('THN-180521003',9,'081327617223','Muhamad Eman Sulaeman',5,1,'2021-05-18','Online',1000000,9,'0','1085814991'),('THN-180521004',11,'123456789','Anton Sunanto',2,4,'2021-05-18','Online',1200000,9,'0','1877740529'),('THN-290521001',10,'5170411190','Salsa Bila',5,4,'2021-05-29','Online',1200000,9,'0','1876831271'),('THN-020621001',15,'5170421156','Aldino Diru Sansongko',2,4,'2021-06-02','Online',1500000,9,'0','1599842918'),('THN-020621002',17,'5170412156','Alvian Akhmad Mauzaki',3,4,'2021-06-02','Online',1500000,9,'0','1398597225'),('THN-020621003',19,'5170451156','Fathiya Nabila Al Khonsa',1,4,'2021-06-02','Online',1500000,9,'0','1608415002'),('THN-020621004',21,'5170481156','Mufida Husnia',1,4,'2021-06-02','Online',1500000,9,'0','587967452'),('THN-020621005',22,'5180411156','Nur Faiq',2,4,'2021-06-02','Online',1500000,9,'0','844264790'),('THN-020621006',25,'5170446956','Ulil Absor',1,4,'2021-06-02','Online',1500000,9,'0','1019388346'),('THN-020621007',27,'5170411137','Aulia Khansa Nabila',1,4,'2021-06-02','Online',1500000,9,'0','138768845');

/*Table structure for table `redaksi_surat` */

DROP TABLE IF EXISTS `redaksi_surat`;

CREATE TABLE `redaksi_surat` (
  `id_redaksi` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) NOT NULL,
  `isi_redaksi` text NOT NULL,
  PRIMARY KEY (`id_redaksi`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `redaksi_surat` */

insert  into `redaksi_surat`(`id_redaksi`,`judul`,`isi_redaksi`) values (1,'Cara Pembayaran Online','<h2 style=\"font-style:italic; text-align:center\"><span style=\"font-size:26px\"><span style=\"color:#c0392b\"><strong><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Tata Cara Pembayaran Menggunakan Midtrans</span></strong></span></span></h2>\r\n\r\n<ol style=\"list-style-type:upper-alpha\">\r\n	<li><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\"><strong>Melalui Bank Transfer</strong></span></span></span></li>\r\n</ol>\r\n\r\n<ol>\r\n	<li><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Pilih jenis pembayaran biaya pendidikan (Biaya spp, tahunan, atau bangunan)</span></span></span></li>\r\n	<li><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Pilih tahun ajaran -&gt; bulan -&gt; dan metode pembayaran (<em>Online) </em>-&gt; bayar</span></span></span></li>\r\n	<li><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Setelah klik tombol bayar akan muncul snap / tampilan untuk pembayaran</span></span></span></li>\r\n	<li><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Pilih <strong>&quot;Continue&quot;<em>.</em></strong></span></span></span></li>\r\n	<li><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Pilih <em>payment </em>ATM/Bank Transfer</span></span></span></li>\r\n	<li><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Pilih Bank BCA, Mandiri, atau BRI</span></span></span></li>\r\n	<li><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Ketika setelah memilih salah satu Bank yang ada di nomor 6, kemudian pilih ATM Banking, Klik Banking atau M-Banking.</span></span></span></li>\r\n	<li><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Kemudian klik <strong>&ldquo;See Account Number&rdquo;</strong></span></span></span></li>\r\n	<li><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Selanjutnya siswa akan mendapatkan <strong><em>Account number </em>/ </strong><em><strong>Virtual Account</strong> </em>dan harus di <em>copy </em>karena akan digunakan pada saat melakukan pembayaran melalui ATM Banking, Klik Banking atau M-Banking.</span></span></span></li>\r\n	<li><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Selanjutnya klik <strong>&ldquo;Please Complete Payment&rdquo;.</strong></span></span></span></li>\r\n</ol>\r\n\r\n<p style=\"margin-left:48px\">&nbsp;</p>\r\n\r\n<p><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:#e74c3c\"><strong>Perhatian!</strong></span><em> Pembayaran harus segera dilakukan karena batasnya <strong>1x24 jam</strong> dihitung setelah menekan <strong>&ldquo;See Account Number&rdquo;</strong> pada halaman midtrans.</em></span></span></p>\r\n');

/*Table structure for table `siswa` */

DROP TABLE IF EXISTS `siswa`;

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL AUTO_INCREMENT,
  `nis` varchar(30) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `nama_wali` varchar(100) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `image` varchar(100) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` date NOT NULL,
  PRIMARY KEY (`id_siswa`),
  KEY `id_kelas` (`id_kelas`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`),
  CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

/*Data for the table `siswa` */

insert  into `siswa`(`id_siswa`,`nis`,`id_kelas`,`role_id`,`nama`,`email`,`password`,`tgl_lahir`,`jenis_kelamin`,`alamat`,`nama_wali`,`no_hp`,`image`,`is_active`,`date_created`) values (7,'5170411156',1,3,'Eman','eman@gmail.com','$2y$10$ZcOuEmL1l1uW2TC8FgZ7o.69TeA/u29OdIaRTTS/mwnMMLWY3x7GG','2021-04-14','laki-laki','Dusun Manis RT/RW 008/003 Desa Kamarang Kecamatan Greged Kabupaten Cirebon','Nunung','081327617223','default.png',1,'0000-00-00'),(8,'2147483647',2,3,'Mega Revilia','mega@gmail.com','$2y$10$RNleZDadu43TYmpjxmEWZeG5eXfgfeS7EX2aiKoUewE3hEjOP8q4i','2021-04-15','perempuan','Dusun Manis RT/RW 008/003 Desa Kamarang Kecamatan Greged Kabupaten Cirebon','Jajang','081327617223','default.png',1,'0000-00-00'),(9,'081327617223',3,3,'Muhamad Eman Sulaeman','muhamad.eman8@gmail.com','$2y$10$mwvREoaS3SOeDDWT4wI3G.WGdpMIyJcg4pjUM3/I8Ts0rOteDE0w2','2021-04-06','laki-laki','Dusun Manis RT/RW 008/003 Desa Kamarang Kecamatan Greged Kabupaten Cirebon','Rusdi','081327617909','default.png',1,'0000-00-00'),(10,'5170411190',4,3,'Salsa Bila','salsa@gmail.com','$2y$10$wUD409F8RioP3tdePNJmQ.13KH0su6fbNMD2o0iq1vvBwgBieYgt6','2000-01-04','perempuan','Dusun Manis RT/RW 008/003 Desa Kamarang Kecamatan Greged Kabupaten Cirebon','Gilang','081327617123','default.png',1,'0000-00-00'),(11,'123456789',4,3,'Anton Sunanto','anton@gmail.com','$2y$10$LLPmWssDCm/NL80sQf0k9.CcerST3DCnIo7ErrJo9FQ912.ar2Opi','2021-05-04','laki-laki','Dusun Manis RT/RW 008/003 Desa Kamarang Kecamatan Greged Kabupaten Cirebon','antoni','081327612342','default.png',1,'0000-00-00'),(13,'5170411155',4,3,'muhamad','muhamad@gmail.com','$2y$10$73e64SoSv8ZxnxpPRjWqcOOkZMwesqdL.CAfWVbZcG7qAeIri1O3q','2021-05-13','laki-laki','Dusun Manis RT/RW 008/003 Desa Kamarang Kecamatan Greged Kabupaten Cirebon','Nunung','081327617223','default.png',1,'0000-00-00'),(14,'5170411159',3,3,'Afra Nafisah Makarim','nafsa@gmail.com','$2y$10$MECKKDQmP.OypUoT5GzMYuvBL6cH4ZQy4Ql6OMt85BfJtyT5N43Hm','2022-07-11','perempuan','Dusun Manis RT/RW 008/003 Desa Kamarang Kecamatan Greged Kabupaten Cirebon','Nafisah','081327617223','default.png',1,'0000-00-00'),(15,'5170421156',3,3,'Aldino Diru Sansongko','aldino@gmail.com','$2y$10$9S2B/NVVNfXxFIAc84pVY.G7Ql9s46cNKETDBJz54HawMGe2zYKaK','2022-10-02','laki-laki','Dusun Manis RT/RW 008/003 Desa Kamarang Kecamatan Greged Kabupaten Cirebon','Diru','081327617223','default.png',1,'0000-00-00'),(16,'5170431156',3,3,'Alimah Nur Latifah Alghina','alimah@gmail.com','$2y$10$fV6IIe1shIrzG36mok6TnuWf8AF1GfCGu662a019ZtTX1yjsMqfAu','2021-01-27','perempuan','Dusun Manis RT/RW 008/003 Desa Kamarang Kecamatan Greged Kabupaten Cirebon','latifah','081327617223','default.png',1,'0000-00-00'),(17,'5170412156',3,3,'Alvian Akhmad Mauzaki','alvian@gmail.com','$2y$10$.48k52gnkK.lIaZl.uq.Gur9slmbbjAEdGPITduS07LMpYmRVnPnG','2022-07-12','laki-laki','Dusun Manis RT/RW 008/003 Desa Kamarang Kecamatan Greged Kabupaten Cirebon','Mauzaki','081327617223','default.png',1,'0000-00-00'),(18,'5170411256',3,3,'Annisa Fadhilah','annisa@gmail.com','$2y$10$yTpry1aFz7Rop5wJNMFFdeA73Xu0CfK.Gy9ai2gWqWTG5ocPkDffq','2005-06-15','perempuan','Dusun Manis RT/RW 008/003 Desa Kamarang Kecamatan Greged Kabupaten Cirebon','Annisa','081327617223','default.png',1,'0000-00-00'),(19,'5170451156',3,3,'Fathiya Nabila Al Khonsa','fathiya@gmail.com','$2y$10$dB99bD3S145PrMCSXK8gauaz/T88LChi3Kgw.LiKfn9ybkCiDJ/0q','2003-11-25','perempuan','Dusun Manis RT/RW 008/003 Desa Kamarang Kecamatan Greged Kabupaten Cirebon','Fathiya','081327617223','default.png',1,'0000-00-00'),(20,'5170412356',3,3,'Maulana Ashim','maulana@gmail.com','$2y$10$A0csqntAXZ/CqCuJ9Ktny.d1Vj3aVRjAFNP.8ii6UFdOBplPnaXHK','2003-03-05','laki-laki','Dusun Manis RT/RW 008/003 Desa Kamarang Kecamatan Greged Kabupaten Cirebon','Maulana','081327617223','default.png',1,'0000-00-00'),(21,'5170481156',3,3,'Mufida Husnia','mufida@gmail.com','$2y$10$KEpHd4rDkPVnvqDMqQ6mo.kHMjhKI7wqRxPs.5LINmeXih1QxHvIu','2002-12-28','perempuan','Dusun Manis RT/RW 008/003 Desa Kamarang Kecamatan Greged Kabupaten Cirebon','Husnia','081327617223','default.png',1,'0000-00-00'),(22,'5180411156',3,3,'Nur Faiq','nur@gmail.com','$2y$10$br8N.sXIKEraLs6D4mxWs.qSoaNrgeIpcmVvHWPugvvoRIWlT/8XO','2003-09-24','perempuan','Dusun Manis RT/RW 008/003 Desa Kamarang Kecamatan Greged Kabupaten Cirebon','Faiq','081327617223','default.png',1,'0000-00-00'),(23,'5170511156',3,3,'Salma Rofifah','salma@gmail.com','$2y$10$KRpQJkTFEZt74XT0IW79jeJc9xKANjOUkNh24Gu9mb3OfLi.f/THy','2002-11-30','perempuan','Dusun Manis RT/RW 008/003 Desa Kamarang Kecamatan Greged Kabupaten Cirebon','Rofifah','081327617223','default.png',1,'0000-00-00'),(24,'5170911156',3,3,'Sarah Syarifah Assyima','sarah@gmail.com','$2y$10$N/xjvQl6jg1qCZxOjoXxaenP3H.dOdIZFi13adgXPy5a1f6aYh11u','2002-08-21','perempuan','Dusun Manis RT/RW 008/003 Desa Kamarang Kecamatan Greged Kabupaten Cirebon','Sarah','081327617223','default.png',1,'0000-00-00'),(25,'5170446956',3,3,'Ulil Absor','ulil@gmail.com','$2y$10$O8r4sQjzQ5KmRA.FzcBAmOuwWcgg5rPzB/AEVEXfIWR83iqFZ61c.','2002-12-18','laki-laki','Dusun Manis RT/RW 008/003 Desa Kamarang Kecamatan Greged Kabupaten Cirebon','Absor','081327617223','default.png',1,'0000-00-00'),(26,'5170411166',3,3,'Shafiya Hanin','hanin@gmail.com','$2y$10$qXpNhHOnU88AR9GmwQblbOwWhOVt9DNvkkyDjz63O680kfJO3M5OG','2003-01-01','perempuan','Dusun Manis RT/RW 008/003 Desa Kamarang Kecamatan Greged Kabupaten Cirebon','Hanin','081327617223','default.png',1,'0000-00-00'),(27,'5170411137',3,3,'Aulia Khansa Nabila','aulia@gmail.com','$2y$10$L4gFBBk3pDIKyZeLRMvkIe9eSwXDyaCifwufKz9ZH3uS635tYpthi','2002-08-21','perempuan','Dusun Manis RT/RW 008/003 Desa Kamarang Kecamatan Greged Kabupaten Cirebon','Khansa','081327617223','default.png',1,'0000-00-00'),(28,'5170411100',3,3,'Halimah Nur Azizah','halimah@gmail.com','$2y$10$8MF.0mmtT9Z3zTH9/JBdo.UrTaFBe23FtnE0Xp8goOahaTaOf9Jjm','2002-07-02','perempuan','Dusun Manis RT/RW 008/003 Desa Kamarang Kecamatan Greged Kabupaten Cirebon','Halimah','081327617223','default.png',1,'0000-00-00'),(29,'5170411106',3,3,'Salsabila Ristina','salsabila@gmail.com','$2y$10$FrYP31kkIS8urTqE2g7r3uVQThA0akOzavA1W99ngz5PUvcPV.1o.','2002-06-28','perempuan','Dusun Manis RT/RW 008/003 Desa Kamarang Kecamatan Greged Kabupaten Cirebon','Salsabila','081327617223','default.png',1,'0000-00-00'),(30,'5170411150',3,3,'Muhammad Naufal Dzaky','naufal@gmail.com','$2y$10$IjjfZJ2wlDPvoMNOjzfSyeAuk6XPJN8VXguNUdWjIh9bZsVgqG3U2','2002-10-20','laki-laki','Dusun Manis RT/RW 008/003 Desa Kamarang Kecamatan Greged Kabupaten Cirebon','Naufal','081327617223','default.png',1,'0000-00-00'),(31,'5174411156',3,3,'Syarifatul Hadijah','syarifatul@gmail.com','$2y$10$pl043fN4lJ6fZpyy0596r.1VUMP60OphpzWj1vHKzIx9UEVYA.ffO','2001-06-27','perempuan','Dusun Manis RT/RW 008/003 Desa Kamarang Kecamatan Greged Kabupaten Cirebon','Hadijah','081327617223','default.png',1,'0000-00-00'),(32,'5170422256',3,3,'Hasna Afifah Hijriah','hasna@gmail.com','$2y$10$vUCF.MXA5kS68PR9ueXoaOeQXPvzUx.c3KagnPc1yYS95HTftIohK','2002-08-20','perempuan','Dusun Manis RT/RW 008/003 Desa Kamarang Kecamatan Greged Kabupaten Cirebon','Hijriah','081327617223','default.png',1,'0000-00-00');

/*Table structure for table `tahun_ajaran` */

DROP TABLE IF EXISTS `tahun_ajaran`;

CREATE TABLE `tahun_ajaran` (
  `id_tahun` int(11) NOT NULL AUTO_INCREMENT,
  `tahun_ajaran` varchar(10) NOT NULL,
  `besar_spp` varchar(255) NOT NULL,
  `besar_tahunan` varchar(255) NOT NULL,
  `besar_bangunan` varchar(255) NOT NULL,
  `status` enum('ON','OFF') NOT NULL,
  PRIMARY KEY (`id_tahun`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tahun_ajaran` */

insert  into `tahun_ajaran`(`id_tahun`,`tahun_ajaran`,`besar_spp`,`besar_tahunan`,`besar_bangunan`,`status`) values (1,'2019/2020','175000','1000000','1500000','ON'),(3,'2020/2021','100000','1100000','1500000','ON'),(4,'2021/2022','700000','1500000','9000000','ON');

/*Table structure for table `tahun_aktif` */

DROP TABLE IF EXISTS `tahun_aktif`;

CREATE TABLE `tahun_aktif` (
  `id_tahun_aktif` int(11) NOT NULL AUTO_INCREMENT,
  `id_siswa` int(11) NOT NULL,
  PRIMARY KEY (`id_tahun_aktif`),
  KEY `id_siswa` (`id_siswa`),
  CONSTRAINT `tahun_aktif_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`)
) ENGINE=InnoDB AUTO_INCREMENT=9056 DEFAULT CHARSET=latin1;

/*Data for the table `tahun_aktif` */

insert  into `tahun_aktif`(`id_tahun_aktif`,`id_siswa`) values (8832,7),(758,8),(1682,9),(2763,10),(3884,11),(120,13),(3045,14),(4051,15),(8426,16),(1779,17),(8151,18),(5023,19),(3729,20),(1121,21),(127,22),(3011,23),(3230,24),(8031,25),(4678,26),(1889,27),(8291,28),(6681,29),(6112,30),(9055,31),(5151,32);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `jenis_kelamin` enum('Laki - Laki','Perempuan') NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `image` varchar(100) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`id`,`role_id`,`name`,`email`,`password`,`jenis_kelamin`,`no_hp`,`image`,`is_active`,`date_created`) values (8,2,'Muhamad Eman Sulaeman','kepala@gmail.com','$2y$10$AxP7d7IeG1plHr6WNfs7EOoEUgjttQo5EQuRV4lsUomm5Firu31RK','Laki - Laki','0989789000','IMG_20180510_101705.jpg',1,'2021-03-03'),(9,1,'Bendahara satu','bendahara@gmail.com','$2y$10$KRXeWWgTh5EGzlwdhXzvJ.xQI9krsmVvBZCvNcV9SOeVPT0qL5a3W','Laki - Laki','08974294238','IMG_20161018_172739.jpg',1,'2021-03-10'),(15,2,'Admin sistem','adminsistem@gmail.com','$2y$10$y0AAp4fX.wjLC09uzeqt2enBu1cs0PjA/BFY.y.SNdVMcvZzRwPxq','Laki - Laki','09090912090','default.png',1,'0000-00-00'),(16,1,'Bendahara dua','bendahara2@gmail.com','$2y$10$gL5loytzT5Gf8ICcuMcNNOlriPmqjwCxd6bDcn6HjAH6GMuntVgF.','Perempuan','9090909','default.png',1,'0000-00-00'),(17,1,'Bendahara baru','bendaharabaru@gmail.com','$2y$10$ubv6PyC6I60SX47lJoV9bu6M2akM57q9XrV71wd3vqsX6RciDT8JG','Perempuan','08132761898','default.png',1,'0000-00-00');

/*Table structure for table `user_access_menu` */

DROP TABLE IF EXISTS `user_access_menu`;

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  KEY `menu_id` (`menu_id`),
  CONSTRAINT `user_access_menu_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`),
  CONSTRAINT `user_access_menu_ibfk_2` FOREIGN KEY (`menu_id`) REFERENCES `user_menu` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `user_access_menu` */

insert  into `user_access_menu`(`id`,`role_id`,`menu_id`) values (1,2,1),(6,1,2);

/*Table structure for table `user_menu` */

DROP TABLE IF EXISTS `user_menu`;

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu` varchar(128) NOT NULL,
  `is_active` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `user_menu` */

insert  into `user_menu`(`id`,`menu`,`is_active`) values (1,'Kepala Madrasah',1),(2,'Bendahara',1),(3,'Siswa',1);

/*Table structure for table `user_role` */

DROP TABLE IF EXISTS `user_role`;

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `user_role` */

insert  into `user_role`(`id`,`role`) values (1,'Bendahara'),(2,'Kepala Madrasah'),(3,'Siswa'),(4,'aku');

/*Table structure for table `user_sub_menu` */

DROP TABLE IF EXISTS `user_sub_menu`;

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_id` (`menu_id`),
  CONSTRAINT `user_sub_menu_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `user_menu` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

/*Data for the table `user_sub_menu` */

insert  into `user_sub_menu`(`id`,`menu_id`,`title`,`url`,`icon`,`is_active`) values (1,1,'Dashboard','user/dashboard','fas fa-fw fa-tachometer-alt',1),(3,1,'Data Admin','user/dataadmin','fas fa-fw fa-users',1),(13,2,'Dashboard','admin','fas fa-fw fa-tachometer-alt',1),(19,2,'Informasi Pembayaran','admin/redaksi','fas fa-bullhorn',1),(27,1,'cobaaabu','coba/coba','fas fa-fw fa-tachometer-alt',0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
