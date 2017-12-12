DROP TABLE IF EXISTS `service_providers`;
CREATE TABLE `service_providers` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `service_provider_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nirc` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `business_summary` varchar(255) NOT NULL,
  `business_type` varchar(255) NOT NULL,
  `where_hear` varchar(255) NOT NULL,
  `experience` varchar(255) NOT NULL,
  `teammember` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `legal` varchar(3) NOT NULL,
  `password` varchar(255) NOT NULL,
  `deactivate` tinyint(2) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;