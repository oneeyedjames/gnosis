CREATE TABLE `difficulty` (
	`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`title` varchar(255) NOT NULL,
	`alias` varchar(255) DEFAULT NULL,
	`summary` text,
	PRIMARY KEY (`id`),
	UNIQUE KEY `alias` (`alias`)
) DEFAULT CHARSET=utf8;
