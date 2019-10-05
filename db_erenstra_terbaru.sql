/*
SQLyog Ultimate v9.20 
MySQL - 5.5.5-10.1.19-MariaDB : Database - e_renstra
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`e_renstra` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `e_renstra`;

/*Table structure for table `erenstra_default_indikator` */

DROP TABLE IF EXISTS `erenstra_default_indikator`;

CREATE TABLE `erenstra_default_indikator` (
  `id_default_indikator` char(36) NOT NULL,
  `id_kategori` char(6) DEFAULT NULL,
  `id_indikator` char(6) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `added_by` char(36) DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id_default_indikator`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `erenstra_default_indikator` */

insert  into `erenstra_default_indikator`(`id_default_indikator`,`id_kategori`,`id_indikator`,`date_added`,`added_by`,`deleted`) values ('29e89e79-d699-11e9-864d-38baf8a51c7e','ktg-4','idt-3','2019-09-14 10:41:33','52183d7c-7eb1-11e7-8752-00ff9594c640',0),('29f06e1b-d699-11e9-864d-38baf8a51c7e','ktg-4','idt-4','2019-09-14 10:41:33','52183d7c-7eb1-11e7-8752-00ff9594c640',0),('29f58f59-d699-11e9-864d-38baf8a51c7e','ktg-4','idt-5','2019-09-14 10:41:33','52183d7c-7eb1-11e7-8752-00ff9594c640',0),('345e0ec5-d699-11e9-864d-38baf8a51c7e','ktg-3','idt-1','2019-09-14 10:41:50','52183d7c-7eb1-11e7-8752-00ff9594c640',0),('3464e384-d699-11e9-864d-38baf8a51c7e','ktg-3','idt-10','2019-09-14 10:41:50','52183d7c-7eb1-11e7-8752-00ff9594c640',0),('346877e2-d699-11e9-864d-38baf8a51c7e','ktg-3','idt-7','2019-09-14 10:41:50','52183d7c-7eb1-11e7-8752-00ff9594c640',0),('346be9a3-d699-11e9-864d-38baf8a51c7e','ktg-3','idt-9','2019-09-14 10:41:50','52183d7c-7eb1-11e7-8752-00ff9594c640',0),('3a3d4f04-d699-11e9-864d-38baf8a51c7e','ktg-2','idt-10','2019-09-14 10:42:00','52183d7c-7eb1-11e7-8752-00ff9594c640',0),('3a415c6c-d699-11e9-864d-38baf8a51c7e','ktg-2','idt-11','2019-09-14 10:42:00','52183d7c-7eb1-11e7-8752-00ff9594c640',0),('6afcc717-d699-11e9-864d-38baf8a51c7e','ktg-1','idt-6','2019-09-14 10:43:22','52183d7c-7eb1-11e7-8752-00ff9594c640',0),('6b08b43e-d699-11e9-864d-38baf8a51c7e','ktg-1','idt-7','2019-09-14 10:43:22','52183d7c-7eb1-11e7-8752-00ff9594c640',0);

/*Table structure for table `erenstra_re_data` */

DROP TABLE IF EXISTS `erenstra_re_data`;

CREATE TABLE `erenstra_re_data` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `field` varchar(20) NOT NULL,
  `value` text NOT NULL,
  `ket` varchar(255) DEFAULT NULL,
  `added_by` char(36) NOT NULL,
  `date_added` datetime NOT NULL,
  `modified_by` char(36) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `id_sinkron` int(11) DEFAULT '0',
  `deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `erenstra_re_data` */

insert  into `erenstra_re_data`(`id`,`field`,`value`,`ket`,`added_by`,`date_added`,`modified_by`,`date_modified`,`id_sinkron`,`deleted`) values (1,'name','Mediterranean Bali',NULL,'','0000-00-00 00:00:00',NULL,NULL,0,0),(2,'address','Jl. Prof. Moh. Yamin No.9, Panjer, Denpasar Sel., Kota Denpasar, Bali 80239, Indonesia',NULL,'','0000-00-00 00:00:00',NULL,NULL,0,0),(3,'phone','+62 361 255457',NULL,'','0000-00-00 00:00:00',NULL,NULL,0,0),(4,'email','',NULL,'','0000-00-00 00:00:00',NULL,NULL,0,0),(5,'logo','',NULL,'','0000-00-00 00:00:00',NULL,NULL,0,0),(6,'start_date','2018-11-30',NULL,'de0f98ba-e491-11e7-baca-f45c89ab4a0b','2019-01-02 05:10:46',NULL,NULL,0,0),(7,'singkatan','MEDI',NULL,'','0000-00-00 00:00:00',NULL,NULL,0,0),(8,'versi','0.01',NULL,'','0000-00-00 00:00:00',NULL,NULL,0,0),(9,'verified_status','4','verifikasi status 0 : tidak aktif, 1 : aktif, 3 : untuk mmb, 4 : medi','','0000-00-00 00:00:00',NULL,NULL,0,0),(10,'offline_status','0',NULL,'','0000-00-00 00:00:00',NULL,NULL,0,0),(11,'registrasi_value','200000',NULL,'','0000-00-00 00:00:00',NULL,NULL,0,0),(12,'daftar_to_siak','1','1:aktif, 0:nonaktif. sinkron invoice otomatis jika sudah di verifikasi oleh admin keuangan masuk langsung ke siak','','0000-00-00 00:00:00',NULL,NULL,0,0),(13,'daftar_ulang_value','5000000',NULL,'','0000-00-00 00:00:00',NULL,NULL,0,0);

/*Table structure for table `erenstra_re_indikator` */

DROP TABLE IF EXISTS `erenstra_re_indikator`;

CREATE TABLE `erenstra_re_indikator` (
  `id_indikator` varchar(36) NOT NULL,
  `nm_indikator` varchar(255) DEFAULT NULL,
  `bobot` float DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `added_by` char(36) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` char(36) DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id_indikator`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `erenstra_re_indikator` */

insert  into `erenstra_re_indikator`(`id_indikator`,`nm_indikator`,`bobot`,`date_added`,`added_by`,`date_modified`,`modified_by`,`deleted`) values ('idt-1','Mendukung Kegiatan Prioritas Nasional / Strategis Nasional',0.203,'2019-08-19 19:47:35','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,0),('idt-10','Usulan Dukungan Pemerintah Daerah',0.046,'2019-08-19 20:36:59','52183d7c-7eb1-11e7-8752-00ff9594c640','2019-08-19 22:33:14','52183d7c-7eb1-11e7-8752-00ff9594c640',0),('idt-11','Memiliki Manfaat Sosial dan fasilitas umum',0.025,'2019-08-19 20:39:01','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,0),('idt-12','Tanggap Darurat Bencana',0.785,'2019-09-05 16:21:02','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,0),('idt-2','Kegiatan yang Bersifat Lanjutan',0.171,'2019-08-19 20:12:00','52183d7c-7eb1-11e7-8752-00ff9594c640','2019-08-19 22:33:57','52183d7c-7eb1-11e7-8752-00ff9594c640',0),('idt-3','Kegiatan yang bersifat Rehabilitasi',0.156,'2019-08-19 20:12:32','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,0),('idt-4','Tertuang di dalam Pola dan Rencana Pengelolaan Sumber Daya Air',0.084,'2019-08-19 20:13:01','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,0),('idt-5','Kesiapan Lahan',0.072,'2019-08-19 20:13:33','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,0),('idt-6','Kesesuaian terhadap RTRW',0.067,'2019-08-19 20:14:01','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,0),('idt-7','Tertuang di dalam RPJM / Renstra',0.065,'2019-08-19 20:14:42','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,0),('idt-8','Kesiapan Dokumen Desain',0.058,'2019-08-19 20:15:31','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,0),('idt-9','Kesiapan Dokumen Lingkungan dan Ijin Lingkungan',0.052,'2019-08-19 20:16:10','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,0);

/*Table structure for table `erenstra_re_kategorifile` */

DROP TABLE IF EXISTS `erenstra_re_kategorifile`;

CREATE TABLE `erenstra_re_kategorifile` (
  `id_kategorifile` char(6) NOT NULL,
  `nm_kategorifile` varchar(50) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `added_by` char(36) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` char(36) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  PRIMARY KEY (`id_kategorifile`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `erenstra_re_kategorifile` */

insert  into `erenstra_re_kategorifile`(`id_kategorifile`,`nm_kategorifile`,`date_added`,`added_by`,`date_modified`,`modified_by`,`deleted`) values ('ktf-1','Desain','2019-08-30 11:17:01','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,0),('ktf-2','Dokumen Lingkungan','2019-08-30 11:17:29','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,0),('ktf-3','Surat Usulan','2019-08-30 11:17:44','52183d7c-7eb1-11e7-8752-00ff9594c640','2019-09-05 12:42:34','52183d7c-7eb1-11e7-8752-00ff9594c640',0),('ktf-4','Dokumentasi Lokasi','2019-08-30 11:17:57','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,0);

/*Table structure for table `erenstra_re_nmkegiatan` */

DROP TABLE IF EXISTS `erenstra_re_nmkegiatan`;

CREATE TABLE `erenstra_re_nmkegiatan` (
  `id_nmkegiatan` char(36) NOT NULL,
  `id_kategori` char(6) DEFAULT NULL,
  `nm_kegiatan` varchar(255) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `added_by` char(36) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` char(36) DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id_nmkegiatan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `erenstra_re_nmkegiatan` */

insert  into `erenstra_re_nmkegiatan`(`id_nmkegiatan`,`id_kategori`,`nm_kegiatan`,`date_added`,`added_by`,`date_modified`,`modified_by`,`deleted`) values ('nmk-1','ktg-1','5036 - Pembangunan dan Rehabilitasi Jaringan Irigasi Permukaan, Rawa dan Tambak','2019-08-30 11:58:59','52183d7c-7eb1-11e7-8752-00ff9594c640','2019-09-10 19:00:00','52183d7c-7eb1-11e7-8752-00ff9594c640',0),('nmk-2','ktg-1','5038 - Pengendalian Banjir, Lahar Gunung Berapi, Dan Pengamanan Pantai','2019-08-30 11:59:35','52183d7c-7eb1-11e7-8752-00ff9594c640','2019-09-10 18:59:43','52183d7c-7eb1-11e7-8752-00ff9594c640',0),('nmk-3','ktg-2','5037 - Pengelolaan Bendungan, Danau, Dan Bangunan Penampung Air Lainnya','2019-08-30 11:59:44','52183d7c-7eb1-11e7-8752-00ff9594c640','2019-09-10 18:59:21','52183d7c-7eb1-11e7-8752-00ff9594c640',0),('nmk-4','ktg-2','5039 - Penyediaan Pengelolaan Air Tanah Dan Air Baku','2019-08-30 11:59:54','52183d7c-7eb1-11e7-8752-00ff9594c640','2019-09-10 18:58:45','52183d7c-7eb1-11e7-8752-00ff9594c640',0),('nmk-5','ktg-2','5040 - Operasi Dan Pemeliharaan Sarana Dan Prasarana Sda','2019-08-30 12:00:03','52183d7c-7eb1-11e7-8752-00ff9594c640','2019-09-10 18:58:17','52183d7c-7eb1-11e7-8752-00ff9594c640',0),('nmk-6','ktg-3','5300 - Dukungan Manajemen Bbws/Bws','2019-08-30 12:00:13','52183d7c-7eb1-11e7-8752-00ff9594c640','2019-09-10 18:57:53','52183d7c-7eb1-11e7-8752-00ff9594c640',0),('nmk-7','ktg-4','5030 - Peningkatan Tatakelola Pengelolaan Sda Terpadu','2019-08-30 12:00:23','52183d7c-7eb1-11e7-8752-00ff9594c640','2019-09-10 18:49:52','52183d7c-7eb1-11e7-8752-00ff9594c640',0),('nmk-8','ktg-2','5042 - Pembangunan Pengaman Tsunami','2019-09-10 13:33:34','52183d7c-7eb1-11e7-8752-00ff9594c640','2019-09-10 13:39:03','52183d7c-7eb1-11e7-8752-00ff9594c640',0);

/*Table structure for table `erenstra_re_satuan` */

DROP TABLE IF EXISTS `erenstra_re_satuan`;

CREATE TABLE `erenstra_re_satuan` (
  `id_satuan` char(36) NOT NULL,
  `nm_satuan` varchar(255) DEFAULT NULL,
  `jns_satuan` varchar(255) DEFAULT NULL,
  `added_by` char(36) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `modified_by` char(36) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted_by` char(36) DEFAULT NULL,
  `date_deleted` datetime DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id_satuan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `erenstra_re_satuan` */

insert  into `erenstra_re_satuan`(`id_satuan`,`nm_satuan`,`jns_satuan`,`added_by`,`date_added`,`modified_by`,`date_modified`,`deleted_by`,`date_deleted`,`deleted`) values ('sat-1','Layanan','output','52183d7c-7eb1-11e7-8752-00ff9594c640','2019-08-30 12:29:15',NULL,NULL,NULL,NULL,0),('sat-10','are','outcome','52183d7c-7eb1-11e7-8752-00ff9594c640','2019-09-05 16:25:25',NULL,NULL,NULL,NULL,0),('sat-12','radiasi','0.0098','52183d7c-7eb1-11e7-8752-00ff9594c640','2019-09-05 16:25:55',NULL,NULL,NULL,NULL,0),('sat-13','m2','output','52183d7c-7eb1-11e7-8752-00ff9594c640','2019-09-05 16:43:58',NULL,NULL,NULL,NULL,0),('sat-14','mil','outcome','52183d7c-7eb1-11e7-8752-00ff9594c640','2019-09-05 16:44:19',NULL,NULL,NULL,NULL,0),('sat-2','Layanan','outcome','52183d7c-7eb1-11e7-8752-00ff9594c640','2019-08-30 12:37:54',NULL,NULL,NULL,NULL,0),('sat-3','Dokumen','output','52183d7c-7eb1-11e7-8752-00ff9594c640','2019-08-30 12:38:13',NULL,NULL,NULL,NULL,0),('sat-4','Dokumen','outcome','52183d7c-7eb1-11e7-8752-00ff9594c640','2019-08-30 12:38:22',NULL,NULL,NULL,NULL,0),('sat-5','Km','output','52183d7c-7eb1-11e7-8752-00ff9594c640','2019-08-30 12:38:37',NULL,NULL,NULL,NULL,0),('sat-6','Km','outcome','52183d7c-7eb1-11e7-8752-00ff9594c640','2019-08-30 12:38:47',NULL,NULL,NULL,NULL,0),('sat-7','Ha','output','52183d7c-7eb1-11e7-8752-00ff9594c640','2019-08-30 12:39:00',NULL,NULL,NULL,NULL,0),('sat-8','Ha','outcome','52183d7c-7eb1-11e7-8752-00ff9594c640','2019-08-30 12:39:10',NULL,NULL,NULL,NULL,0),('sat-9','m3/detik','output','52183d7c-7eb1-11e7-8752-00ff9594c640','2019-09-05 16:25:13',NULL,NULL,NULL,NULL,0);

/*Table structure for table `erenstra_tr_file_support` */

DROP TABLE IF EXISTS `erenstra_tr_file_support`;

CREATE TABLE `erenstra_tr_file_support` (
  `id_file_support` char(36) NOT NULL,
  `id_paket` char(36) DEFAULT NULL,
  `nm_file` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `path_unduh` varchar(255) DEFAULT NULL,
  `id_kategorifile` char(6) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `added_by` char(36) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` char(36) DEFAULT NULL,
  `date_deleted` datetime DEFAULT NULL,
  `deleted_by` char(36) DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id_file_support`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `erenstra_tr_file_support` */

insert  into `erenstra_tr_file_support`(`id_file_support`,`id_paket`,`nm_file`,`keterangan`,`path_unduh`,`id_kategorifile`,`date_added`,`added_by`,`date_modified`,`modified_by`,`date_deleted`,`deleted_by`,`deleted`) values ('09cf96f6-c56a-11e9-bc75-0492260242dc','bba36227-c128-11e9-ada9-0492260242dc','Dokumen Akomodasi Hotel ','Dokumen Lingkungan qwertyuiop asdfghjkl zxcvbnm ','Hotel Accomodation.pdf',NULL,'2019-08-23 13:51:15','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,NULL,NULL,0),('1b7159e0-c56b-11e9-bc75-0492260242dc','bba36227-c128-11e9-ada9-0492260242dc','Proposal Pengadaan Lencana Jabatan ','Dokumen Lingkungan qwertyuiop asdfghjkl zxcvbnm  ','KARTU_BIMBINGAN_TRAINING.pdf',NULL,'2019-08-23 13:58:54','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,NULL,NULL,0),('24b5a8a6-cbac-11e9-b276-38baf8a51c7e','bba36227-c128-11e9-ada9-0492260242dc','Master Plan Reklamasi','Peta Rencana Pelaksanaan Pengembangan Pulau Buatan / Reklamasi di Tanjung Benoa, Kabupaten Badung, Provinsi Bali','C3 HK.xlsx','ktf-1','2019-08-31 12:59:42','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,NULL,NULL,0),('3188f488-c572-11e9-bc75-0492260242dc','bba36227-c128-11e9-ada9-0492260242dc','Pengajuan Dana Talangan ','Dokumen Lingkungan qwertyuiop asdfghjkl zxcvbnm ','2019-08-23(02:49:38), Hotel Accomodation.pdf','ktf-2','2019-08-23 14:49:38','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,NULL,NULL,0),('41a80cc5-d04f-11e9-bdd0-38baf8a51c7e','d3f580ae-d04d-11e9-bdd0-38baf8a51c7e','Map Reklamasi',' Peta Area Reklamasi','loker_pesiar_2.jpg','ktf-4','2019-09-06 10:37:23','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,NULL,NULL,0),('7f29f7c1-c578-11e9-bc75-0492260242dc','bba36227-c128-11e9-ada9-0492260242dc','Modul Teknik Bangunan Anti Gempa','Dokumen Lingkungan qwertyuiop asdfghjkl zxcvbnm ','Modul PHP 1 pens.pdf','ktf-4','2019-08-23 15:34:45','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,NULL,NULL,0),('ab4ed624-c57e-11e9-bc75-0492260242dc','bba36227-c128-11e9-ada9-0492260242dc','Foto Prosedur K3','   foto wisuda   ','loker_pesiar_1.jpg','ktf-3','2019-08-23 16:18:56','52183d7c-7eb1-11e7-8752-00ff9594c640','2019-08-31 15:10:18','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,0);

/*Table structure for table `erenstra_tr_indikator` */

DROP TABLE IF EXISTS `erenstra_tr_indikator`;

CREATE TABLE `erenstra_tr_indikator` (
  `id_tr_indikator` char(36) NOT NULL,
  `id_paket` char(36) DEFAULT NULL,
  `id_kegiatan` char(36) DEFAULT NULL,
  `id_indikator` varchar(255) DEFAULT NULL,
  `sub_nilai` float DEFAULT NULL,
  `tot_nilai` float DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `added_by` char(36) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` char(36) DEFAULT NULL,
  `date_deleted` datetime DEFAULT NULL,
  `deleted_by` char(36) DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id_tr_indikator`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `erenstra_tr_indikator` */

insert  into `erenstra_tr_indikator`(`id_tr_indikator`,`id_paket`,`id_kegiatan`,`id_indikator`,`sub_nilai`,`tot_nilai`,`date_added`,`added_by`,`date_modified`,`modified_by`,`date_deleted`,`deleted_by`,`deleted`) values ('2b568b5d-c73c-11e9-bb14-38baf8a51c7e','81aace30-c126-11e9-ada9-0492260242dc','61f1b38e-c0c6-11e9-bd11-0492260242dc','idt-7',NULL,NULL,'2019-08-25 21:28:04','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,NULL,NULL,0),('2b6b5ce9-c73c-11e9-bb14-38baf8a51c7e','81aace30-c126-11e9-ada9-0492260242dc','61f1b38e-c0c6-11e9-bd11-0492260242dc','idt-8',NULL,NULL,'2019-08-25 21:28:05','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,NULL,NULL,0),('4d1ddb32-c324-11e9-b815-0492260242dc','13583d15-c129-11e9-ada9-0492260242dc','47602fca-c0c6-11e9-bd11-0492260242dc','idt-11',NULL,NULL,'2019-08-20 16:27:09','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,NULL,NULL,0),('4d2e49d9-c324-11e9-b815-0492260242dc','13583d15-c129-11e9-ada9-0492260242dc','47602fca-c0c6-11e9-bd11-0492260242dc','idt-5',NULL,NULL,'2019-08-20 16:27:09','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,NULL,NULL,0),('4d351a4f-c324-11e9-b815-0492260242dc','13583d15-c129-11e9-ada9-0492260242dc','47602fca-c0c6-11e9-bd11-0492260242dc','idt-8',NULL,NULL,'2019-08-20 16:27:09','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,NULL,NULL,0),('4d3dc516-c324-11e9-b815-0492260242dc','13583d15-c129-11e9-ada9-0492260242dc','47602fca-c0c6-11e9-bd11-0492260242dc','idt-9',NULL,NULL,'2019-08-20 16:27:09','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,NULL,NULL,0),('4f3d015e-cd4e-11e9-92e5-0492260242dc','45960d9b-cd4e-11e9-92e5-0492260242dc','47602fca-c0c6-11e9-bd11-0492260242dc','idt-10',NULL,NULL,'2019-09-02 14:53:03','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,NULL,NULL,0),('4f3e0786-cd4e-11e9-92e5-0492260242dc','45960d9b-cd4e-11e9-92e5-0492260242dc','47602fca-c0c6-11e9-bd11-0492260242dc','idt-11',NULL,NULL,'2019-09-02 14:53:03','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,NULL,NULL,0),('68a3c9c2-c323-11e9-b815-0492260242dc','bba36227-c128-11e9-ada9-0492260242dc','47602fca-c0c6-11e9-bd11-0492260242dc','idt-2',NULL,NULL,'2019-08-20 16:20:45','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,NULL,NULL,0),('68ad5ee1-c323-11e9-b815-0492260242dc','bba36227-c128-11e9-ada9-0492260242dc','47602fca-c0c6-11e9-bd11-0492260242dc','idt-5',NULL,NULL,'2019-08-20 16:20:45','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,NULL,NULL,0),('68b42c8d-c323-11e9-b815-0492260242dc','bba36227-c128-11e9-ada9-0492260242dc','47602fca-c0c6-11e9-bd11-0492260242dc','idt-7',NULL,NULL,'2019-08-20 16:20:45','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,NULL,NULL,0),('7e529cd1-c323-11e9-b815-0492260242dc','054f02a4-c129-11e9-ada9-0492260242dc','47602fca-c0c6-11e9-bd11-0492260242dc','idt-10',NULL,NULL,'2019-08-20 16:21:22','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,NULL,NULL,0),('7e5f05ba-c323-11e9-b815-0492260242dc','054f02a4-c129-11e9-ada9-0492260242dc','47602fca-c0c6-11e9-bd11-0492260242dc','idt-11',NULL,NULL,'2019-08-20 16:21:22','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,NULL,NULL,0),('8c4ab689-d2c4-11e9-a5e9-38baf8a51c7e','cc13e8d1-c128-11e9-ada9-0492260242dc','47602fca-c0c6-11e9-bd11-0492260242dc','idt-2',NULL,NULL,'2019-09-09 13:42:02','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,NULL,NULL,0),('8c54c50e-d2c4-11e9-a5e9-38baf8a51c7e','cc13e8d1-c128-11e9-ada9-0492260242dc','47602fca-c0c6-11e9-bd11-0492260242dc','idt-3',NULL,NULL,'2019-09-09 13:42:02','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,NULL,NULL,0),('8c6acb3c-d2c4-11e9-a5e9-38baf8a51c7e','cc13e8d1-c128-11e9-ada9-0492260242dc','47602fca-c0c6-11e9-bd11-0492260242dc','idt-4',NULL,NULL,'2019-09-09 13:42:02','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,NULL,NULL,0),('8c6e443a-d2c4-11e9-a5e9-38baf8a51c7e','cc13e8d1-c128-11e9-ada9-0492260242dc','47602fca-c0c6-11e9-bd11-0492260242dc','idt-5',NULL,NULL,'2019-09-09 13:42:02','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,NULL,NULL,0),('c68d1719-cb2e-11e9-868e-38baf8a51c7e','8ba84c84-c124-11e9-ada9-0492260242dc','363dae57-c0c7-11e9-bd11-0492260242dc','idt-11',NULL,NULL,'2019-08-30 22:02:17','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,NULL,NULL,0),('c694e5bf-cb2e-11e9-868e-38baf8a51c7e','8ba84c84-c124-11e9-ada9-0492260242dc','363dae57-c0c7-11e9-bd11-0492260242dc','idt-4',NULL,NULL,'2019-08-30 22:02:17','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,NULL,NULL,0),('c696b229-cb2e-11e9-868e-38baf8a51c7e','8ba84c84-c124-11e9-ada9-0492260242dc','363dae57-c0c7-11e9-bd11-0492260242dc','idt-6',NULL,NULL,'2019-08-30 22:02:17','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,NULL,NULL,0);

/*Table structure for table `erenstra_tr_kategori` */

DROP TABLE IF EXISTS `erenstra_tr_kategori`;

CREATE TABLE `erenstra_tr_kategori` (
  `id_kategori` char(6) NOT NULL,
  `nm_kategori` varchar(255) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `added_by` char(36) DEFAULT NULL,
  `modified_by` char(36) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted_by` char(36) DEFAULT NULL,
  `date_deleted` datetime DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `erenstra_tr_kategori` */

insert  into `erenstra_tr_kategori`(`id_kategori`,`nm_kategori`,`date_added`,`added_by`,`modified_by`,`date_modified`,`deleted_by`,`date_deleted`,`deleted`) values ('ktg-1','Desain','2019-08-17 01:33:29','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,NULL,NULL,0),('ktg-2','Konstruksi','2019-08-17 01:34:02','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,NULL,NULL,0),('ktg-3','Operasi & Pemeliharaan','2019-08-17 01:34:33','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,NULL,NULL,0),('ktg-4','Wajib Balai','2019-08-17 01:34:51','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,NULL,NULL,0);

/*Table structure for table `erenstra_tr_kegiatan` */

DROP TABLE IF EXISTS `erenstra_tr_kegiatan`;

CREATE TABLE `erenstra_tr_kegiatan` (
  `id_kegiatan` char(36) NOT NULL,
  `id_kategori` char(6) DEFAULT NULL,
  `id_nmkegiatan` char(36) DEFAULT NULL,
  `provinsi` varchar(25) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `added_by` char(36) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` char(36) DEFAULT NULL,
  `date_deleted` datetime DEFAULT NULL,
  `deleted_by` char(36) DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id_kegiatan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `erenstra_tr_kegiatan` */

insert  into `erenstra_tr_kegiatan`(`id_kegiatan`,`id_kategori`,`id_nmkegiatan`,`provinsi`,`date_added`,`added_by`,`date_modified`,`modified_by`,`date_deleted`,`deleted_by`,`deleted`) values ('363dae57-c0c7-11e9-bd11-0492260242dc','ktg-4','nmk-7','Bali','2019-08-17 16:15:45','52183d7c-7eb1-11e7-8752-00ff9594c640','2019-08-30 21:43:15','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,0),('47602fca-c0c6-11e9-bd11-0492260242dc','ktg-1','nmk-1','Bali','2019-08-17 16:09:04','52183d7c-7eb1-11e7-8752-00ff9594c640','2019-08-30 21:42:00','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,0),('51115cca-c0c7-11e9-bd11-0492260242dc','ktg-1','nmk-2','Bali','2019-08-17 16:16:30','52183d7c-7eb1-11e7-8752-00ff9594c640','2019-08-30 21:45:05','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,0),('61f1b38e-c0c6-11e9-bd11-0492260242dc','ktg-2','nmk-3','Bali','2019-08-17 16:09:49','52183d7c-7eb1-11e7-8752-00ff9594c640','2019-08-30 21:42:09','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,0),('79a7e640-c0c6-11e9-bd11-0492260242dc','ktg-2','nmk-4','Bali','2019-08-17 16:10:28','52183d7c-7eb1-11e7-8752-00ff9594c640','2019-08-30 21:42:22','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,0),('a5fe5ba2-d44d-11e9-b529-38baf8a51c7e','ktg-3','nmk-6','Jawa Timur','2019-09-11 12:35:57','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,NULL,NULL,0),('a9c75e21-c100-11e9-ada9-0492260242dc','ktg-2','nmk-3','Bali','2019-08-17 23:07:00','52183d7c-7eb1-11e7-8752-00ff9594c640','2019-08-17 23:07:29',NULL,NULL,NULL,1),('c2dfcf79-c0c6-11e9-bd11-0492260242dc','ktg-2','nmk-5','Bali','2019-08-17 16:12:31','52183d7c-7eb1-11e7-8752-00ff9594c640','2019-08-30 21:42:33','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,0),('f910d8d6-c0c6-11e9-bd11-0492260242dc','ktg-3','nmk-6','Bali','2019-08-17 16:14:02','52183d7c-7eb1-11e7-8752-00ff9594c640','2019-08-30 21:42:53','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,0),('fe0d9a0e-cae1-11e9-99c5-38baf8a51c7e','ktg-1','nmk-2','Bali','2019-08-30 12:52:41','52183d7c-7eb1-11e7-8752-00ff9594c640','2019-09-12 12:08:38','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,1);

/*Table structure for table `erenstra_tr_lokasi` */

DROP TABLE IF EXISTS `erenstra_tr_lokasi`;

CREATE TABLE `erenstra_tr_lokasi` (
  `id_lokasi` char(36) NOT NULL,
  `id_paket` char(36) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `kab_kota` varchar(50) DEFAULT NULL,
  `kecamatan` varchar(50) DEFAULT NULL,
  `desa` varchar(50) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `added_by` char(36) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` char(36) DEFAULT NULL,
  `date_deleted` datetime DEFAULT NULL,
  `deleted_by` char(36) DEFAULT NULL,
  `show` int(1) DEFAULT '0',
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id_lokasi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `erenstra_tr_lokasi` */

insert  into `erenstra_tr_lokasi`(`id_lokasi`,`id_paket`,`latitude`,`longitude`,`kab_kota`,`kecamatan`,`desa`,`date_added`,`added_by`,`date_modified`,`modified_by`,`date_deleted`,`deleted_by`,`show`,`deleted`) values ('40774a59-c73c-11e9-bb14-38baf8a51c7e','81aace30-c126-11e9-ada9-0492260242dc','-9.5028333','30.374138',NULL,NULL,NULL,'2019-08-25 21:28:40','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,NULL,NULL,0,0),('64c64418-c1b0-11e9-9644-0492260242dc','bba36227-c128-11e9-ada9-0492260242dc','-8.7028333','11.374138','Karangasem','selat','manggis','2019-08-18 20:04:56','52183d7c-7eb1-11e7-8752-00ff9594c640','2019-09-13 00:36:33','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,0,0);

/*Table structure for table `erenstra_tr_paket` */

DROP TABLE IF EXISTS `erenstra_tr_paket`;

CREATE TABLE `erenstra_tr_paket` (
  `id_paket` char(36) NOT NULL,
  `id_kegiatan` char(36) DEFAULT NULL,
  `kode` varchar(5) DEFAULT NULL,
  `nm_paket` varchar(50) DEFAULT NULL,
  `id_tahun` char(6) DEFAULT NULL,
  `anggaran_kegiatan` bigint(20) DEFAULT NULL,
  `tot_nilai_prioritas` varchar(10) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `added_by` char(36) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` char(36) DEFAULT NULL,
  `date_deleted` datetime DEFAULT NULL,
  `deleted_by` char(36) DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id_paket`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `erenstra_tr_paket` */

insert  into `erenstra_tr_paket`(`id_paket`,`id_kegiatan`,`kode`,`nm_paket`,`id_tahun`,`anggaran_kegiatan`,`tot_nilai_prioritas`,`date_added`,`added_by`,`date_modified`,`modified_by`,`date_deleted`,`deleted_by`,`deleted`) values ('054f02a4-c129-11e9-ada9-0492260242dc','47602fca-c0c6-11e9-bd11-0492260242dc','A','Sistem Manajemen Mutu BWS Bali-Penida','thn-3',9800000000,NULL,'2019-08-18 03:55:53','52183d7c-7eb1-11e7-8752-00ff9594c640','2019-09-13 13:34:33','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,0),('13583d15-c129-11e9-ada9-0492260242dc','47602fca-c0c6-11e9-bd11-0492260242dc','A','Survey, Pengukuran dan Koordinasi','thn-4',NULL,NULL,'2019-08-18 03:56:17','52183d7c-7eb1-11e7-8752-00ff9594c640','2019-08-18 09:10:15','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,0),('1f8861d0-c124-11e9-ada9-0492260242dc','79a7e640-c0c6-11e9-bd11-0492260242dc','A','Unit Desain BWS Bali-Penida','thn-2',NULL,NULL,'2019-08-18 03:20:50','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,NULL,NULL,0),('45960d9b-cd4e-11e9-92e5-0492260242dc','47602fca-c0c6-11e9-bd11-0492260242dc','b','tes 123','thn-1',NULL,NULL,'2019-09-02 14:52:47','52183d7c-7eb1-11e7-8752-00ff9594c640','2019-09-04 14:08:43',NULL,NULL,NULL,1),('81aace30-c126-11e9-ada9-0492260242dc','61f1b38e-c0c6-11e9-bd11-0492260242dc','A','Sistem Manajemen Mutu BWS Bali-Penida','thn-3',NULL,NULL,'2019-08-18 03:37:53','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,NULL,NULL,0),('8ba84c84-c124-11e9-ada9-0492260242dc','363dae57-c0c7-11e9-bd11-0492260242dc','A','Kegiatan Penyusunan Program dan Rencana Anggaran','thn-1',NULL,NULL,'2019-08-18 03:23:51','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,NULL,NULL,0),('bba36227-c128-11e9-ada9-0492260242dc','47602fca-c0c6-11e9-bd11-0492260242dc','A','Unit Desain BWS Bali-Penida','thn-1',NULL,NULL,'2019-08-18 03:53:50','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,NULL,NULL,0),('c72ce507-d5de-11e9-83d7-38baf8a51c7e','47602fca-c0c6-11e9-bd11-0492260242dc','zxz','Pembangunan Panel Surya di Desa','thn-2',54000000,NULL,'2019-09-13 12:27:21','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,NULL,NULL,0),('cc13e8d1-c128-11e9-ada9-0492260242dc','47602fca-c0c6-11e9-bd11-0492260242dc','A','Kegiatan Penyusunan Program dan Rencana Anggaran','thn-2',NULL,NULL,'2019-08-18 03:54:17','52183d7c-7eb1-11e7-8752-00ff9594c640','2019-08-18 09:09:22','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,0),('d3f580ae-d04d-11e9-bdd0-38baf8a51c7e','47602fca-c0c6-11e9-bd11-0492260242dc','X6X','Master Plan Reklamasi','thn-5',5000,NULL,'2019-09-06 10:27:09','52183d7c-7eb1-11e7-8752-00ff9594c640','2019-09-13 13:33:26','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,0);

/*Table structure for table `erenstra_tr_rencana_pelaksanaan` */

DROP TABLE IF EXISTS `erenstra_tr_rencana_pelaksanaan`;

CREATE TABLE `erenstra_tr_rencana_pelaksanaan` (
  `id_rencana` char(36) NOT NULL,
  `id_paket` char(36) DEFAULT NULL,
  `sub_komponen` varchar(255) DEFAULT NULL,
  `output_satuan` char(36) DEFAULT NULL,
  `output_target` float DEFAULT NULL,
  `outcome_satuan` char(36) DEFAULT NULL,
  `outcome_target` float DEFAULT NULL,
  `anggaran` bigint(20) DEFAULT NULL,
  `date_added` date DEFAULT NULL,
  `added_by` char(36) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` char(36) DEFAULT NULL,
  `date_deleted` datetime DEFAULT NULL,
  `deleted_by` char(36) DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id_rencana`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `erenstra_tr_rencana_pelaksanaan` */

insert  into `erenstra_tr_rencana_pelaksanaan`(`id_rencana`,`id_paket`,`sub_komponen`,`output_satuan`,`output_target`,`outcome_satuan`,`outcome_target`,`anggaran`,`date_added`,`added_by`,`date_modified`,`modified_by`,`date_deleted`,`deleted_by`,`deleted`) values ('16d180f2-c955-11e9-8048-38baf8a51c7e','bba36227-c128-11e9-ada9-0492260242dc','Peningkatan Jaringan Irigasi DI Tukad Ayung di Kab. Badung','sat-5',512,'sat-6',0.03,9500000,'2019-08-28','b838207d-54c2-11e7-a1b2-00ff9594c640','2019-09-13 13:31:00','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,0),('442a459a-c42b-11e9-b0d4-0492260242dc','bba36227-c128-11e9-ada9-0492260242dc','Peningkatan Jaringan Irigasi DI Tukad Penet di Kab. Badung','',1,'',1,457770,'2019-08-21','52183d7c-7eb1-11e7-8752-00ff9594c640','2019-08-27 18:53:17',NULL,NULL,NULL,1),('53413a85-cfb2-11e9-a183-38baf8a51c7e','bba36227-c128-11e9-ada9-0492260242dc','Reklamasi Teluk Benoa','sat-9',99.65,'sat-10',98750,789500000,'2019-09-05','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,NULL,NULL,0),('7bae371a-d04e-11e9-bdd0-38baf8a51c7e','d3f580ae-d04d-11e9-bdd0-38baf8a51c7e','Snack Konsumsi','sat-13',65,'sat-6',85,50000,'2019-09-06','52183d7c-7eb1-11e7-8752-00ff9594c640','2019-09-06 10:33:38',NULL,NULL,NULL,1),('8788c306-c437-11e9-b0d4-0492260242dc','bba36227-c128-11e9-ada9-0492260242dc','Peningkatan Jaringan Irigasi DI Petanu di Kab. Gianyar','',5,'',65,3506654670,'2019-08-22','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,NULL,NULL,0),('9ae85975-c436-11e9-b0d4-0492260242dc','bba36227-c128-11e9-ada9-0492260242dc','Peningkatan Jaringan Irigasi DI Tukad Oos di Kab. Gianyar','',99.65,'',5559,2147483647,'2019-08-22','52183d7c-7eb1-11e7-8752-00ff9594c640','2019-08-27 18:53:09',NULL,NULL,NULL,1),('afc30027-c42d-11e9-b0d4-0492260242dc','bba36227-c128-11e9-ada9-0492260242dc','Peningkatan Jaringan Irigasi DI Tukad Pakerisan di Kab. Gianyar ','',7.3,'',0.03,72247482,'2019-08-22','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,NULL,NULL,0),('b83ca0b9-c95a-11e9-8048-38baf8a51c7e','bba36227-c128-11e9-ada9-0492260242dc','Pembangunan Pembangkit Nuklir','sat-7',5,'sat-8',0.688423,98750500000,'2019-08-28','b838207d-54c2-11e7-a1b2-00ff9594c640','2019-09-05 11:33:04','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,0),('fbb9f5da-cbca-11e9-b276-38baf8a51c7e','bba36227-c128-11e9-ada9-0492260242dc','Pembuatan Daratan Reklamasi','sat-5',4587.98,'sat-8',7689.5,985500999,'2019-08-31','52183d7c-7eb1-11e7-8752-00ff9594c640','2019-09-05 11:32:01','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,0);

/*Table structure for table `erenstra_tr_tahun` */

DROP TABLE IF EXISTS `erenstra_tr_tahun`;

CREATE TABLE `erenstra_tr_tahun` (
  `id_tahun` char(6) NOT NULL,
  `nm_tahun` varchar(4) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `erenstra_tr_tahun` */

insert  into `erenstra_tr_tahun`(`id_tahun`,`nm_tahun`,`deleted`) values ('thn-1','2019',0),('thn-2','2020',0),('thn-3','2021',0),('thn-4','2022',0),('thn-5','2023',0);

/*Table structure for table `global_employee` */

DROP TABLE IF EXISTS `global_employee`;

CREATE TABLE `global_employee` (
  `id_sdm` char(36) NOT NULL,
  `id_ikatan_kerja` char(36) DEFAULT NULL,
  `nm_sdm` varchar(100) DEFAULT NULL,
  `nidn` char(30) DEFAULT NULL,
  `nsdmi` char(12) DEFAULT NULL,
  `nip` varchar(18) DEFAULT NULL,
  `jk` char(1) DEFAULT NULL,
  `tmpt_lahir` varchar(32) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `nik` char(16) DEFAULT NULL,
  `niy_nigk` varchar(30) DEFAULT NULL,
  `nuptk` char(16) DEFAULT NULL,
  `id_stat_pegawai` int(11) DEFAULT NULL,
  `id_jns_ptk` int(11) DEFAULT NULL,
  `id_bid_pengawas` int(11) DEFAULT NULL,
  `id_agama` smallint(6) DEFAULT NULL,
  `jln` varchar(80) DEFAULT NULL,
  `rt` decimal(2,0) DEFAULT NULL,
  `rw` decimal(2,0) DEFAULT NULL,
  `nm_dsn` varchar(60) DEFAULT NULL,
  `ds_kel` varchar(60) DEFAULT NULL,
  `id_wil` char(8) DEFAULT NULL,
  `kode_pos` char(5) DEFAULT NULL,
  `no_tel_rmh` varchar(20) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `id_stat_aktif` decimal(2,0) DEFAULT NULL,
  `sk_cpns` varchar(80) DEFAULT NULL,
  `tgl_sk_cpns` date DEFAULT NULL,
  `nm_wp` varchar(100) DEFAULT NULL,
  `id_blob` char(36) DEFAULT NULL,
  `sk_angkat` varchar(80) DEFAULT NULL,
  `tmt_sk_angkat` date DEFAULT NULL,
  `id_lemb_angkat` decimal(2,0) DEFAULT NULL,
  `id_pangkat_gol` decimal(2,0) DEFAULT NULL,
  `id_keahlian_lab` smallint(6) DEFAULT NULL,
  `id_sumber_gaji` decimal(2,0) DEFAULT NULL,
  `nm_ibu_kandung` varchar(100) DEFAULT NULL,
  `stat_kawin` decimal(1,0) DEFAULT NULL,
  `nm_suami_istri` varchar(100) DEFAULT NULL,
  `nip_suami_istri` char(18) DEFAULT NULL,
  `id_pekerjaan_suami_istri` int(11) DEFAULT NULL,
  `tmt_pns` date DEFAULT NULL,
  `a_lisensi_kepsek` decimal(1,0) DEFAULT NULL,
  `jml_sekolah_binaan` smallint(6) DEFAULT NULL,
  `a_diklat_awas` decimal(1,0) DEFAULT NULL,
  `akta_ijin_ajar` char(1) DEFAULT NULL,
  `nira` char(30) DEFAULT NULL,
  `stat_data` int(11) DEFAULT NULL,
  `mampu_handle_kk` int(11) DEFAULT NULL,
  `a_braille` decimal(1,0) DEFAULT NULL,
  `a_bhs_isyarat` decimal(1,0) DEFAULT NULL,
  `npwp` char(15) DEFAULT NULL,
  `id_jns_sdm` decimal(2,0) DEFAULT NULL,
  `kewarganegaraan` char(2) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `added_by` char(36) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` char(36) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  PRIMARY KEY (`id_sdm`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `global_employee` */

insert  into `global_employee`(`id_sdm`,`id_ikatan_kerja`,`nm_sdm`,`nidn`,`nsdmi`,`nip`,`jk`,`tmpt_lahir`,`tgl_lahir`,`nik`,`niy_nigk`,`nuptk`,`id_stat_pegawai`,`id_jns_ptk`,`id_bid_pengawas`,`id_agama`,`jln`,`rt`,`rw`,`nm_dsn`,`ds_kel`,`id_wil`,`kode_pos`,`no_tel_rmh`,`no_hp`,`email`,`id_stat_aktif`,`sk_cpns`,`tgl_sk_cpns`,`nm_wp`,`id_blob`,`sk_angkat`,`tmt_sk_angkat`,`id_lemb_angkat`,`id_pangkat_gol`,`id_keahlian_lab`,`id_sumber_gaji`,`nm_ibu_kandung`,`stat_kawin`,`nm_suami_istri`,`nip_suami_istri`,`id_pekerjaan_suami_istri`,`tmt_pns`,`a_lisensi_kepsek`,`jml_sekolah_binaan`,`a_diklat_awas`,`akta_ijin_ajar`,`nira`,`stat_data`,`mampu_handle_kk`,`a_braille`,`a_bhs_isyarat`,`npwp`,`id_jns_sdm`,`kewarganegaraan`,`date_added`,`added_by`,`date_modified`,`modified_by`,`deleted`) values ('1c942d32-d052-11e9-bdd0-38baf8a51c7e',NULL,'Sekretaris Utama','2110157013',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2019-09-06 10:57:49','52183d7c-7eb1-11e7-8752-00ff9594c640','2019-09-06 11:17:27',NULL,1),('4c699345-ce2e-11e9-9da9-0492260242dc',NULL,'Staf Khusus','2110157010',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2019-09-03 17:36:25','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,0),('513e3a82-cee4-11e9-97be-0492260242dc',NULL,'Admin Kantor','2110157011',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2019-09-04 15:19:22','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,0),('52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,'Administrator','1108605050',NULL,'-','L','Denpasar','1993-04-17','5031245124521',NULL,NULL,10,NULL,NULL,4,'-',NULL,NULL,NULL,'Denpasar Utara','226004','80111',NULL,'-','admin@siak.io','1',NULL,NULL,NULL,NULL,NULL,NULL,'2',NULL,NULL,'99','Administrator IT','0',NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,'-','12','ID','2017-08-12 00:22:56',NULL,'2018-02-28 19:02:04',NULL,0),('b767ff22-cab3-11e9-99c5-38baf8a51c7e',NULL,'Staf Umum','2110157009',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2019-08-30 07:21:23','52183d7c-7eb1-11e7-8752-00ff9594c640',NULL,NULL,0);

/*Table structure for table `global_hakakses` */

DROP TABLE IF EXISTS `global_hakakses`;

CREATE TABLE `global_hakakses` (
  `id_global_hakakses` int(6) NOT NULL AUTO_INCREMENT,
  `jenis_hakakses` varchar(100) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id_global_hakakses`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `global_hakakses` */

insert  into `global_hakakses`(`id_global_hakakses`,`jenis_hakakses`,`date_added`,`date_modified`,`deleted`) values (1,'SUPER ADMIN',NULL,NULL,0),(2,'ADMIN',NULL,NULL,0),(3,'KEUANGAN',NULL,NULL,1),(4,'ASRAMA',NULL,NULL,1),(5,'SIMPEG',NULL,NULL,1),(6,'EVALUASI',NULL,NULL,1),(7,'STAF',NULL,NULL,0),(8,'MAHASISWA',NULL,NULL,1),(9,'ADMIN SEKOLAH',NULL,NULL,1),(10,'STAF SEKOLAH',NULL,NULL,1),(11,'SISWA',NULL,NULL,1);

/*Table structure for table `global_jabatan` */

DROP TABLE IF EXISTS `global_jabatan`;

CREATE TABLE `global_jabatan` (
  `id_global_jabatan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(255) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id_global_jabatan`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `global_jabatan` */

insert  into `global_jabatan`(`id_global_jabatan`,`nama_jabatan`,`date_added`,`date_modified`,`deleted`) values (1,'Administrator / IT Support',NULL,NULL,0);

/*Table structure for table `global_kontak_kami` */

DROP TABLE IF EXISTS `global_kontak_kami`;

CREATE TABLE `global_kontak_kami` (
  `id_global_kontak_kami` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `lang` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `tlp` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `bank_account` varchar(255) DEFAULT NULL,
  `bank_an` varchar(255) DEFAULT NULL,
  `bank_name_pendaftaran` varchar(255) DEFAULT NULL,
  `bank_account_pendaftaran` varchar(255) DEFAULT NULL,
  `bank_an_pendaftaran` varchar(255) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id_global_kontak_kami`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `global_kontak_kami` */

insert  into `global_kontak_kami`(`id_global_kontak_kami`,`title`,`lat`,`lang`,`name`,`address`,`city`,`state`,`zip`,`tlp`,`email`,`facebook`,`bank_name`,`bank_account`,`bank_an`,`bank_name_pendaftaran`,`bank_account_pendaftaran`,`bank_an_pendaftaran`,`date_added`,`date_modified`,`deleted`) values (1,'Kontak Kami','','','SIAK','Kopertis8','','','','','','','','','','','','',NULL,NULL,0);

/*Table structure for table `global_user` */

DROP TABLE IF EXISTS `global_user`;

CREATE TABLE `global_user` (
  `id_global_user` char(36) NOT NULL,
  `id_user` char(36) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id_global_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `global_user` */

insert  into `global_user`(`id_global_user`,`id_user`,`username`,`password`,`date_added`,`date_modified`,`deleted`) values ('09e36b3c-ce48-11e9-9da9-0492260242dc','4c699345-ce2e-11e9-9da9-0492260242dc','stafk','effa2671a9a14380829d89365d58636a','2019-09-03 08:40:41',NULL,0),('2f8543fb-d052-11e9-bdd0-38baf8a51c7e','1c942d32-d052-11e9-bdd0-38baf8a51c7e','sekre','7e005ba18411fc8a3fa6d4d9702e0e49','2019-09-06 10:58:21',NULL,0),('58ef9ef0-cee4-11e9-97be-0492260242dc','513e3a82-cee4-11e9-97be-0492260242dc','kantor','7e005ba18411fc8a3fa6d4d9702e0e49','2019-09-04 03:19:35',NULL,0),('5f5d50ab-42b7-11e8-8761-f23c91ccd916','2b0a3139-418f-11e8-8761-f23c91ccd916','1108605010','81dc9bdb52d04dc20036dbd8313ed055','2018-04-18 11:19:58',NULL,0),('726ac1d2-947d-11e8-b2b4-f23c91ccd916','6114f3cd-947d-11e8-b2b4-f23c91ccd916','180731125154','4c52825b21bc8e6a6035f41c04bdaaa6','2018-07-31 12:51:54',NULL,0),('761c56ed-42be-11e8-8761-f23c91ccd916','2b0b4515-418f-11e8-8761-f23c91ccd916','1208605011','4c52825b21bc8e6a6035f41c04bdaaa6','2018-04-18 12:10:42',NULL,0),('7ca82bd8-1c62-11e8-80b6-f45c89ab4a0b','69adb9cb-9b61-11e7-81d7-5deb82c968af','admin_bendahara','d3881351d3f4b9a48d2d1e232e7c26d3','2018-02-28 04:36:35',NULL,0),('863911b2-418b-11e8-8761-f23c91ccd916','64cce630-418b-11e8-8761-f23c91ccd916','superuser','81dc9bdb52d04dc20036dbd8313ed055','2018-04-16 11:33:34',NULL,0),('db05ba34-1c61-11e8-80b6-f45c89ab4a0b','9d7156c5-9b61-11e7-81d7-5deb82c968af','admin_akuntan','d3881351d3f4b9a48d2d1e232e7c26d3','2018-02-28 04:32:04',NULL,0),('dbed396d-3e56-11e9-a617-020000354689','10733fed-3c1e-11e9-a617-020000354689','1108605050','4c52825b21bc8e6a6035f41c04bdaaa6','2019-03-04 04:24:01',NULL,0),('dfb0ba34-1c61-11e8-80b6-f45c89ab4a0b','52183d7c-7eb1-11e7-8752-00ff9594c640','admin','0192023a7bbd73250516f069df18b500','2018-02-28 04:32:12',NULL,0),('fb6837a3-ce46-11e9-9da9-0492260242dc','b767ff22-cab3-11e9-99c5-38baf8a51c7e','general staf','7e005ba18411fc8a3fa6d4d9702e0e49','2019-09-03 08:33:07',NULL,0);

/*Table structure for table `global_user_hakakses` */

DROP TABLE IF EXISTS `global_user_hakakses`;

CREATE TABLE `global_user_hakakses` (
  `id_global_user_hakakses` char(36) NOT NULL,
  `id_global_user` char(36) DEFAULT NULL,
  `id_global_hakakses` int(11) DEFAULT NULL,
  `id_sp` char(36) DEFAULT NULL,
  `id_sms` char(36) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id_global_user_hakakses`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `global_user_hakakses` */

insert  into `global_user_hakakses`(`id_global_user_hakakses`,`id_global_user`,`id_global_hakakses`,`id_sp`,`id_sms`,`date_added`,`date_modified`,`deleted`) values ('05776d38-ce47-11e9-9da9-0492260242dc','fb6837a3-ce46-11e9-9da9-0492260242dc',7,'0','0','2019-09-03 08:33:24','2019-09-03 08:33:24',0),('09ebc8cd-ce48-11e9-9da9-0492260242dc','09e36b3c-ce48-11e9-9da9-0492260242dc',7,'0','0','2019-09-03 08:40:41','2019-09-03 08:40:41',0),('2f90b8ef-d052-11e9-bdd0-38baf8a51c7e','2f8543fb-d052-11e9-bdd0-38baf8a51c7e',7,'0','0','2019-09-06 10:58:21','2019-09-06 10:58:21',0),('5269510b-ce48-11e9-9da9-0492260242dc','7ca82bd8-1c62-11e8-80b6-f45c89ab4a0b',2,'0','0','2019-09-03 08:42:42','2019-09-03 08:42:42',0),('575568af-ce48-11e9-9da9-0492260242dc','dfb0ba34-1c61-11e8-80b6-f45c89ab4a0b',1,'0','0','2019-09-03 08:42:50','2019-09-03 08:42:50',0),('5d3aff10-ce48-11e9-9da9-0492260242dc','db05ba34-1c61-11e8-80b6-f45c89ab4a0b',2,'0','0','2019-09-03 08:43:00','2019-09-03 08:43:00',0),('5f5d84e3-42b7-11e8-8761-f23c91ccd916','5f5d50ab-42b7-11e8-8761-f23c91ccd916',8,'95633562-1c73-11e8-80b6-f45c89ab4a0b','61ffbeaa-1c75-11e8-80b6-f45c89ab4a0b','2018-04-18 11:19:58',NULL,0),('726b1e85-947d-11e8-b2b4-f23c91ccd916','726ac1d2-947d-11e8-b2b4-f23c91ccd916',3,'04198090-7928-11e8-ab14-f23c91ccd916','6760af67-85b9-11e8-b2b4-f23c91ccd916','2018-07-31 12:51:54','2018-07-31 12:51:54',0),('726b584e-947d-11e8-b2b4-f23c91ccd916','726ac1d2-947d-11e8-b2b4-f23c91ccd916',3,'1a42f4ac-7924-11e8-ab14-f23c91ccd916','56c4846f-85c4-11e8-b2b4-f23c91ccd916','2018-07-31 12:51:54','2018-07-31 12:51:54',0),('726b8f67-947d-11e8-b2b4-f23c91ccd916','726ac1d2-947d-11e8-b2b4-f23c91ccd916',3,'1a42f4ac-7924-11e8-ab14-f23c91ccd916','62553da2-85c5-11e8-b2b4-f23c91ccd916','2018-07-31 12:51:54','2018-07-31 12:51:54',0),('726bc81a-947d-11e8-b2b4-f23c91ccd916','726ac1d2-947d-11e8-b2b4-f23c91ccd916',3,'1a42f4ac-7924-11e8-ab14-f23c91ccd916','ebeb0490-85c4-11e8-b2b4-f23c91ccd916','2018-07-31 12:51:54','2018-07-31 12:51:54',0),('726c05cf-947d-11e8-b2b4-f23c91ccd916','726ac1d2-947d-11e8-b2b4-f23c91ccd916',3,'2f9c024e-7924-11e8-ab14-f23c91ccd916','44cf8153-85bc-11e8-b2b4-f23c91ccd916','2018-07-31 12:51:54','2018-07-31 12:51:54',0),('726c6728-947d-11e8-b2b4-f23c91ccd916','726ac1d2-947d-11e8-b2b4-f23c91ccd916',3,'41ba6af8-7924-11e8-ab14-f23c91ccd916','423c2c4e-85c6-11e8-b2b4-f23c91ccd916','2018-07-31 12:51:54','2018-07-31 12:51:54',0),('726ca297-947d-11e8-b2b4-f23c91ccd916','726ac1d2-947d-11e8-b2b4-f23c91ccd916',3,'6594843c-7924-11e8-ab14-f23c91ccd916','7a4c61f5-85bb-11e8-b2b4-f23c91ccd916','2018-07-31 12:51:54','2018-07-31 12:51:54',0),('726cd9ec-947d-11e8-b2b4-f23c91ccd916','726ac1d2-947d-11e8-b2b4-f23c91ccd916',3,'6594843c-7924-11e8-ab14-f23c91ccd916','d36235f3-85bb-11e8-b2b4-f23c91ccd916','2018-07-31 12:51:54','2018-07-31 12:51:54',0),('726d10dd-947d-11e8-b2b4-f23c91ccd916','726ac1d2-947d-11e8-b2b4-f23c91ccd916',3,'7bfcccd8-48fc-11e8-8761-f23c91ccd916','74b3ce4a-1c77-11e8-80b6-f45c89ab4a0b','2018-07-31 12:51:54','2018-07-31 12:51:54',0),('726d47c2-947d-11e8-b2b4-f23c91ccd916','726ac1d2-947d-11e8-b2b4-f23c91ccd916',3,'80913720-7924-11e8-ab14-f23c91ccd916','91c537a6-85c7-11e8-b2b4-f23c91ccd916','2018-07-31 12:51:54','2018-07-31 12:51:54',0),('726d8121-947d-11e8-b2b4-f23c91ccd916','726ac1d2-947d-11e8-b2b4-f23c91ccd916',3,'80913720-7924-11e8-ab14-f23c91ccd916','f09350a6-85c7-11e8-b2b4-f23c91ccd916','2018-07-31 12:51:54','2018-07-31 12:51:54',0),('726dbc93-947d-11e8-b2b4-f23c91ccd916','726ac1d2-947d-11e8-b2b4-f23c91ccd916',3,'95633562-1c73-11e8-80b6-f45c89ab4a0b','61ffbeaa-1c75-11e8-80b6-f45c89ab4a0b','2018-07-31 12:51:54','2018-07-31 12:51:54',0),('726df55d-947d-11e8-b2b4-f23c91ccd916','726ac1d2-947d-11e8-b2b4-f23c91ccd916',3,'abc63785-7922-11e8-ab14-f23c91ccd916','cdb76398-85b9-11e8-b2b4-f23c91ccd916','2018-07-31 12:51:54','2018-07-31 12:51:54',0),('726e2f05-947d-11e8-b2b4-f23c91ccd916','726ac1d2-947d-11e8-b2b4-f23c91ccd916',3,'cc943395-42b3-11e8-8761-f23c91ccd916','c7e64c86-85c5-11e8-b2b4-f23c91ccd916','2018-07-31 12:51:54','2018-07-31 12:51:54',0),('726e66dd-947d-11e8-b2b4-f23c91ccd916','726ac1d2-947d-11e8-b2b4-f23c91ccd916',3,'d0b81e08-42b5-11e8-8761-f23c91ccd916','f8772124-85ba-11e8-b2b4-f23c91ccd916','2018-07-31 12:51:54','2018-07-31 12:51:54',0),('726e9d6f-947d-11e8-b2b4-f23c91ccd916','726ac1d2-947d-11e8-b2b4-f23c91ccd916',3,'db277831-7924-11e8-ab14-f23c91ccd916','33a7597a-85c7-11e8-b2b4-f23c91ccd916','2018-07-31 12:51:54','2018-07-31 12:51:54',0),('761c83e0-42be-11e8-8761-f23c91ccd916','761c56ed-42be-11e8-8761-f23c91ccd916',8,'95633562-1c73-11e8-80b6-f45c89ab4a0b','74b3ce4a-1c77-11e8-80b6-f45c89ab4a0b','2018-04-18 12:10:42',NULL,0),('86394815-418b-11e8-8761-f23c91ccd916','863911b2-418b-11e8-8761-f23c91ccd916',1,'0','0','2018-04-16 11:33:34','2018-04-16 11:33:34',0),('86397c05-418b-11e8-8761-f23c91ccd916','863911b2-418b-11e8-8761-f23c91ccd916',2,'95633562-1c73-11e8-80b6-f45c89ab4a0b','61ffbeaa-1c75-11e8-80b6-f45c89ab4a0b','2018-04-16 11:33:34','2018-04-16 11:33:34',0),('8639b6d6-418b-11e8-8761-f23c91ccd916','863911b2-418b-11e8-8761-f23c91ccd916',2,'95633562-1c73-11e8-80b6-f45c89ab4a0b','74b3ce4a-1c77-11e8-80b6-f45c89ab4a0b','2018-04-16 11:33:34','2018-04-16 11:33:34',0),('8639efc6-418b-11e8-8761-f23c91ccd916','863911b2-418b-11e8-8761-f23c91ccd916',3,'95633562-1c73-11e8-80b6-f45c89ab4a0b','61ffbeaa-1c75-11e8-80b6-f45c89ab4a0b','2018-04-16 11:33:34','2018-04-16 11:33:34',0),('863a2e1e-418b-11e8-8761-f23c91ccd916','863911b2-418b-11e8-8761-f23c91ccd916',3,'95633562-1c73-11e8-80b6-f45c89ab4a0b','74b3ce4a-1c77-11e8-80b6-f45c89ab4a0b','2018-04-16 11:33:34','2018-04-16 11:33:34',0),('863a5871-418b-11e8-8761-f23c91ccd916','863911b2-418b-11e8-8761-f23c91ccd916',7,'95633562-1c73-11e8-80b6-f45c89ab4a0b','61ffbeaa-1c75-11e8-80b6-f45c89ab4a0b','2018-04-16 11:33:34','2018-04-16 11:33:34',0),('863a84ee-418b-11e8-8761-f23c91ccd916','863911b2-418b-11e8-8761-f23c91ccd916',7,'95633562-1c73-11e8-80b6-f45c89ab4a0b','74b3ce4a-1c77-11e8-80b6-f45c89ab4a0b','2018-04-16 11:33:34','2018-04-16 11:33:34',0),('98c9918f-ce44-11e9-9da9-0492260242dc','98b20f83-ce44-11e9-9da9-0492260242dc',2,'0','0','2019-09-03 08:16:02','2019-09-03 08:16:02',0),('99cbb8e8-ce44-11e9-9da9-0492260242dc','99c55741-ce44-11e9-9da9-0492260242dc',2,'0','0','2019-09-03 08:16:04','2019-09-03 08:16:04',0),('9a5be810-ce44-11e9-9da9-0492260242dc','9a55d9d4-ce44-11e9-9da9-0492260242dc',2,'0','0','2019-09-03 08:16:05','2019-09-03 08:16:05',0),('9abb0056-ce44-11e9-9da9-0492260242dc','9aaf22b5-ce44-11e9-9da9-0492260242dc',2,'0','0','2019-09-03 08:16:06','2019-09-03 08:16:06',0),('9f618a08-ce43-11e9-9da9-0492260242dc','9f5a5caf-ce43-11e9-9da9-0492260242dc',2,'0','0','2019-09-03 08:09:04','2019-09-03 08:09:04',0),('a0f87398-ce43-11e9-9da9-0492260242dc','a0ef6bee-ce43-11e9-9da9-0492260242dc',2,'0','0','2019-09-03 08:09:07','2019-09-03 08:09:07',0),('a18d17ed-ce43-11e9-9da9-0492260242dc','a17f6cd3-ce43-11e9-9da9-0492260242dc',2,'0','0','2019-09-03 08:09:07','2019-09-03 08:09:07',0),('a1f834d0-ce43-11e9-9da9-0492260242dc','a1ee916c-ce43-11e9-9da9-0492260242dc',2,'0','0','2019-09-03 08:09:08','2019-09-03 08:09:08',0),('a233a470-ce43-11e9-9da9-0492260242dc','a22bc3dc-ce43-11e9-9da9-0492260242dc',2,'0','0','2019-09-03 08:09:09','2019-09-03 08:09:09',0),('a25e1fe1-ce43-11e9-9da9-0492260242dc','a2512729-ce43-11e9-9da9-0492260242dc',2,'0','0','2019-09-03 08:09:09','2019-09-03 08:09:09',0),('a2b65635-ce43-11e9-9da9-0492260242dc','a2ab48cb-ce43-11e9-9da9-0492260242dc',2,'0','0','2019-09-03 08:09:09','2019-09-03 08:09:09',0),('a30d10bd-ce43-11e9-9da9-0492260242dc','a300df1c-ce43-11e9-9da9-0492260242dc',2,'0','0','2019-09-03 08:09:10','2019-09-03 08:09:10',0),('a32d3eb5-ce43-11e9-9da9-0492260242dc','a323a566-ce43-11e9-9da9-0492260242dc',2,'0','0','2019-09-03 08:09:10','2019-09-03 08:09:10',0),('dbede6a1-3e56-11e9-a617-020000354689','dbed396d-3e56-11e9-a617-020000354689',8,'04198090-7928-11e8-ab14-f23c91ccd916','0d490853-c636-11e8-bf67-f23c91ccd916','2019-03-04 04:24:01',NULL,0),('ddbffdde-cee4-11e9-97be-0492260242dc','58ef9ef0-cee4-11e9-97be-0492260242dc',1,'0','0','2019-09-04 03:23:17','2019-09-04 03:23:17',0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
