DROP TABLE IF EXISTS `sub_services`;
CREATE TABLE `sub_services` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `service_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `myan_name` varchar(255) DEFAULT NULL,
  `text` varchar(255) DEFAULT NULL,
  `myan_text` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `deactivate` tinyint(1) DEFAULT NULL,
  `delete` tinyint(1) DEFAULT NULL,
  `created` date DEFAULT NULL,
  `modified` date DEFAULT NULL,
  `deleted` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;