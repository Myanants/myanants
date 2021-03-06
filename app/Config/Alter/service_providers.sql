DROP TABLE IF EXISTS `service_providers`;
CREATE TABLE `service_providers` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `service_provider_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `nirc` varchar(255) DEFAULT NULL,
  `phone` varchar(20) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `business_summary` varchar(255) DEFAULT NULL,
  `prefer_location` varchar(500) DEFAULT NULL,
  `business_type` varchar(255) DEFAULT NULL,
  `pricing` varchar(255) DEFAULT NULL,
  `experience` varchar(255) DEFAULT NULL,
  `townships` varchar(255) DEFAULT NULL,
  `teammember` bigint(5) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `legal` tinyint(2) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `deactivate` tinyint(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;