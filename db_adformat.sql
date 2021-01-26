-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for db_adformat
CREATE DATABASE IF NOT EXISTS `db_adformat` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `db_adformat`;

-- Dumping structure for table db_adformat.t_dokumen
CREATE TABLE IF NOT EXISTS `t_dokumen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `kode` varchar(50) NOT NULL,
  `file` varchar(255) NOT NULL,
  `kata_kunci` text NOT NULL,
  `kecocokan` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table db_adformat.t_dokumen: ~1 rows (approximately)
/*!40000 ALTER TABLE `t_dokumen` DISABLE KEYS */;
INSERT IGNORE INTO `t_dokumen` (`id`, `nama`, `kode`, `file`, `kata_kunci`, `kecocokan`) VALUES
	(8, 'SIDANG KERJA PRAKTEK', 'F.AKA-03-08-19', '0be820ff7cfd3c7a1010ba40c4845ed6.html', 'Mengajukan Kerja Praktek KP pada tanggal Pendaftaran', 70);
/*!40000 ALTER TABLE `t_dokumen` ENABLE KEYS */;

-- Dumping structure for table db_adformat.t_form_data
CREATE TABLE IF NOT EXISTS `t_form_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_permintaan` int(11) NOT NULL,
  `field` varchar(50) DEFAULT NULL,
  `value` text,
  PRIMARY KEY (`id`),
  KEY `id_permintaan` (`id_permintaan`),
  CONSTRAINT `FK_t_form_data_t_permintaan` FOREIGN KEY (`id_permintaan`) REFERENCES `t_permintaan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=latin1;

-- Dumping data for table db_adformat.t_form_data: ~0 rows (approximately)
/*!40000 ALTER TABLE `t_form_data` DISABLE KEYS */;
INSERT IGNORE INTO `t_form_data` (`id`, `id_permintaan`, `field`, `value`) VALUES
	(111, 14, 'TEXT-KODE_SURAT', 'F.AKA-03-08-19'),
	(112, 14, 'TEXT-JUDUL_SURAT', 'SIDANG KERJA PRAKTEK'),
	(113, 14, 'TEXT-PROGRAM_STUDI', 'S1'),
	(114, 14, 'TEXT-JURUSAN', 'Teknik Informatika'),
	(115, 14, 'TEXT-JUDUL', 'JONOJJK'),
	(116, 14, 'TEXT-TEMPAT', 'T4EY5HDRTY'),
	(117, 14, 'NUMBER-NO', '213254'),
	(118, 14, 'TEXT-NIM', '1218016'),
	(119, 14, 'TEXT-NAMA', 'Ibnu Rizqia Ramadan'),
	(120, 14, 'TEXT-PEMBIMBING', 'TFVITYVG'),
	(121, 14, 'TEXT-CATATAN', 'YRTJYFGVJ'),
	(122, 15, 'TEXT-KODE_SURAT', 'F.AKA-03-08-19'),
	(123, 15, 'TEXT-JUDUL_SURAT', 'SIDANG KERJA PRAKTEK'),
	(124, 15, 'TEXT-PROGRAM_STUDI', 'S1'),
	(125, 15, 'TEXT-JURUSAN', 'Teknik Informatika'),
	(126, 15, 'TEXT-JUDUL', '123123'),
	(127, 15, 'TEXT-TEMPAT', '123123'),
	(128, 15, 'NUMBER-NO', '123123'),
	(129, 15, 'TEXT-NIM', '1218016'),
	(130, 15, 'TEXT-NAMA', 'Ibnu Rizqia Ramadan'),
	(131, 15, 'TEXT-PEMBIMBING', '123'),
	(132, 15, 'TEXT-CATATAN', '123123'),
	(133, 16, 'TEXT-KODE_SURAT', 'F.AKA-03-08-19'),
	(134, 16, 'TEXT-JUDUL_SURAT', 'SIDANG KERJA PRAKTEK'),
	(135, 16, 'TEXT-PROGRAM_STUDI', '12312'),
	(136, 16, 'TEXT-JURUSAN', 'Teknik Informatika'),
	(137, 16, 'TEXT-JUDUL', '1231'),
	(138, 16, 'TEXT-TEMPAT', '123'),
	(139, 16, 'NUMBER-NO', '123'),
	(140, 16, 'TEXT-NIM', '1218016'),
	(141, 16, 'TEXT-NAMA', 'Ibnu Rizqia Ramadan'),
	(142, 16, 'TEXT-PEMBIMBING', '123'),
	(143, 16, 'TEXT-CATATAN', '123');
/*!40000 ALTER TABLE `t_form_data` ENABLE KEYS */;

-- Dumping structure for table db_adformat.t_notif
CREATE TABLE IF NOT EXISTS `t_notif` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_permintaan` int(11) NOT NULL,
  `status` enum('1','2') NOT NULL DEFAULT '1' COMMENT '1 = unread; 2= read',
  PRIMARY KEY (`id`),
  KEY `FK__t_permintaan` (`id_permintaan`),
  CONSTRAINT `FK__t_permintaan` FOREIGN KEY (`id_permintaan`) REFERENCES `t_permintaan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Dumping data for table db_adformat.t_notif: ~3 rows (approximately)
/*!40000 ALTER TABLE `t_notif` DISABLE KEYS */;
INSERT IGNORE INTO `t_notif` (`id`, `id_permintaan`, `status`) VALUES
	(14, 14, '1'),
	(15, 15, '1'),
	(16, 16, '1');
/*!40000 ALTER TABLE `t_notif` ENABLE KEYS */;

-- Dumping structure for table db_adformat.t_pengguna
CREATE TABLE IF NOT EXISTS `t_pengguna` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `level` enum('1','2') NOT NULL DEFAULT '2' COMMENT '1 = admin; 2 = mahasiswa',
  `jur` enum('Teknik Informatika','Sistem Informasi') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table db_adformat.t_pengguna: ~2 rows (approximately)
/*!40000 ALTER TABLE `t_pengguna` DISABLE KEYS */;
INSERT IGNORE INTO `t_pengguna` (`id`, `username`, `password`, `nama`, `level`, `jur`) VALUES
	(1, 'admin', '580097c0183509887837571145ccc3ad', 'Admin', '1', 'Teknik Informatika'),
	(2, '1218016', 'd8eafa69af6854b431fc8a3c15660cdc', 'Ibnu Rizqia Ramadan', '2', 'Teknik Informatika');
/*!40000 ALTER TABLE `t_pengguna` ENABLE KEYS */;

-- Dumping structure for table db_adformat.t_permintaan
CREATE TABLE IF NOT EXISTS `t_permintaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `status` enum('pending','acc','ditolak','selesai','acc-system','selesai-system') NOT NULL DEFAULT 'pending' COMMENT '1 = pending; 2 = acc; 3 = reject',
  `tgl` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `FK_t_permintaan_t_jenis` (`id_jenis`),
  CONSTRAINT `FK__t_user` FOREIGN KEY (`id_user`) REFERENCES `t_pengguna` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_t_permintaan_t_jenis` FOREIGN KEY (`id_jenis`) REFERENCES `t_dokumen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Dumping data for table db_adformat.t_permintaan: ~2 rows (approximately)
/*!40000 ALTER TABLE `t_permintaan` DISABLE KEYS */;
INSERT IGNORE INTO `t_permintaan` (`id`, `id_user`, `id_jenis`, `keterangan`, `status`, `tgl`) VALUES
	(14, 2, 8, '', 'acc', '2020-08-26 13:40:31'),
	(15, 2, 8, '', 'selesai', '2020-08-26 13:41:14'),
	(16, 2, 8, '', 'pending', '2020-08-26 14:07:15');
/*!40000 ALTER TABLE `t_permintaan` ENABLE KEYS */;

-- Dumping structure for trigger db_adformat.t_permintaan_after_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `t_permintaan_after_insert` AFTER INSERT ON `t_permintaan` FOR EACH ROW BEGIN
	INSERT INTO t_notif SET	t_notif.id_permintaan = NEW.id;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
