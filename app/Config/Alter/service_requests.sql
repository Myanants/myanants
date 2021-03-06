DROP TABLE IF EXISTS `service_requests`;
CREATE TABLE `service_requests` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) DEFAULT NULL,
  `service_id` bigint(20) NOT NULL,
  `service_provider_id` bigint(20) DEFAULT NULL,
  `service_request_id` varchar(255) DEFAULT NULL,
  `sub_service_id` bigint(20) DEFAULT NULL,
  `township` bigint(20) DEFAULT NULL,
  `request_datetime` datetime DEFAULT NULL,
  `status` tinyint(2) DEFAULT '4',
  `answer` varchar(255) DEFAULT NULL,
  `deactivate` tinyint(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;