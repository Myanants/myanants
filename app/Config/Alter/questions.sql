DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `service_id` bigint(20) NOT NULL,
  `sub_service_id` bigint(20) NOT NULL,
  `Ename` varchar(255) NOT NULL,
  `Mname` varchar(255) NOT NULL,
  `mm_answer` varchar(255) DEFAULT NULL,
  `en_answer` varchar(255) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `deactivate` tinyint(10) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;