DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `customer_id` varchar(255) COLLATE utf8_bin NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8_bin NOT NULL,
  `township` tinyint(2) DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `fbid` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `fbname` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `fbemail` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `email_token_expires` date DEFAULT NULL,
  `password_token` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `deactivate` tinyint(2) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;