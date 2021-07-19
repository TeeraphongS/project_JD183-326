CREATE TABLE `customer` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `customer_code` varchar(255) DEFAULT NULL,
 `customer_name` varchar(255) DEFAULT NULL,
 `customer_address` varchar(255) DEFAULT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8