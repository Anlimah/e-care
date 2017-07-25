                                
DROP TABLE IF EXISTS `doctor`;
CREATE TABLE `doctor` (
  `Doc_ID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(70) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` varchar(40) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `tel` varchar(10) NOT NULL,
  `marital_status` varchar(20) DEFAULT NULL,
  `region` varchar(20) DEFAULT NULL,
  `photo` longblob DEFAULT NULL,
  `createdate` datetime DEFAULT NULL,
  `doc_flag` varchar(30) DEFAULT NULL,
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `doctor_field`;
CREATE TABLE `doctor_field` (
  `Doc_field_ID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  `Doc_ID` int(11) NOT NULL PRIMARY KEY ,
  `doc_field_code` varchar(50) UNIQUE NOT NULL,
  `division` varchar(100) NOT NULL,
  `createdate` datetime DEFAULT NULL,
  `doc_field_flag` varchar(30) DEFAULT NULL,
  KEY `Doc_Code` (`Doc_field_Code`),
  KEY `doc_id` (`Doc_ID`),
  CONSTRAINT `fk_doc_id` FOREIGN KEY (`Doc_ID`) REFERENCES `doctor` (`Doc_ID`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `doctor_account`;
CREATE TABLE `doctor_account` (
  `Doc_Ac_ID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `doc_field_code` varchar(255) UNIQUE NOT NULL,
  `date_reg` datetime NOT NULL,
  `username` varchar(70) NOT NULL,
  `email` varchar(100) UNIQUE NOT NULL,
  `pswd` varchar(20) NOT NULL,
  `docac_flag` varchar(30) DEFAULT NULL,
  KEY `fk_doc_code` (`Doc_field_Code`),
  CONSTRAINT `fk_doc_code` FOREIGN KEY (`Doc_field_Code`) REFERENCES `doctor_field` (`Doc_field_Code`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `patient`;
CREATE TABLE `patient` (
  `Pat_ID` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(70) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` varchar(40) NOT NULL,
  `tel` varchar(40) NOT NULL,
  `address` varchar(50) DEFAULT NULL,
  `marital_status` varchar(20) DEFAULT NULL,
  `region` varchar(20) DEFAULT NULL,
  `photo` longblob DEFAULT NULL,
  `createdate` datetime DEFAULT NULL,
  `pat_flag` varchar(30) DEFAULT NULL,
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `patient_account`;
CREATE TABLE `patient_account` (
  `Pat_Ac_ID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Pat_ID` int(11) NOT NULL ,
  `date_reg` datetime NOT NULL,
  `username` varchar(70) NOT NULL,
  `email` varchar(70) UNIQUE NOT NULL,
  `pswd` varchar(200) NOT NULL,
  `patac_flag` varchar(30) DEFAULT NULL,
  KEY `fk_pat_id` (`Pat_ID`),
  CONSTRAINT `fk_patacc` FOREIGN KEY (`Pat_ID`) REFERENCES `patient` (`Pat_ID`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `Email`;
CREATE TABLE `Email` (
  `e_ID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `e_from` varchar(255) NOT NULL,
  `e_to` varchar(255) NOT NULL,
  `e_subject` date DEFAULT NULL,
  `e_msg` int(11) DEFAULT NULL,
  `e_status` varchar(30) DEFAULT NULL,
  KEY `e_key` (`e_from`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `useraccount`;
CREATE TABLE `useraccount` (
  `user_ID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `username` varchar(50) NOT NULL,
  `email` varchar(70) UNIQUE NOT NULL,
  `pswd` varchar(100) NOT NULL,
  `level` varchar(30) NOT NULL,
  `user_flag` varchar(30) DEFAULT NULL,
  `user_status` varchar(20) NOT NULL,
  `createdate` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS `user_log`;
CREATE TABLE `user_log` (
  `log_ID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user_ID` int(11) NOT NULL,
  `ip_add` varchar(100) DEFAULT NULL,
  `login_time` datetime DEFAULT NULL,
  `logout_time` datetime DEFAULT NULL,
  KEY `fk_user` (`user_ID`),
  CONSTRAINT `fk_user` FOREIGN KEY (`user_ID`) REFERENCES `useraccount` (`user_ID`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;
