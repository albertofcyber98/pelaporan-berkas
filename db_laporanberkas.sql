-- Adminer 4.6.3 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `tbl_pegawai`;
CREATE TABLE `tbl_pegawai` (
  `nip` int(11) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `tempat_lahir` varchar(30) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(25) NOT NULL,
  `level` varchar(20) NOT NULL,
  `password` varchar(200) NOT NULL,
  PRIMARY KEY (`nip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tbl_pegawai` (`nip`, `nama`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `email`, `level`, `password`) VALUES
(12,	'asdas',	'sad',	'2021-07-17',	'L',	'sads',	'dsad@gmail.com',	'ADMIN',	'$2y$10$aRsHDqirlE3QJEscmF69d.ERpWFh36ntY1.wi0aMTSnY4kybdQx72'),
(123,	'Haun',	'Makassar',	'2021-01-09',	'L',	'Makassar',	'haun@gmail.com',	'PEGAWAI',	'$2y$10$GRKj.uGmljF63iwxs6gi7eILpT9EsojKoiDL5vCDpE6YMtz9VZ1Ae'),
(12345,	'Halo',	'Makassar',	'2021-01-01',	'L',	'Makassar',	'halo@gmail.com',	'PEMIMPIN',	'$2y$10$2Hgy6mtO7oJaDbh1dRc69OVysk4lR0UCcGcJxW2C/.mzKSiU9m77q');

DROP TABLE IF EXISTS `tbl_pelaporan`;
CREATE TABLE `tbl_pelaporan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kegiatan` varchar(50) NOT NULL,
  `tanggal_kegiatan` date NOT NULL,
  `catatan_kegiatan` text NOT NULL,
  `file_kegiatan` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2021-07-15 13:49:10
