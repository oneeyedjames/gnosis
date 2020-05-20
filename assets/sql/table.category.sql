CREATE TABLE `category` (
	`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`parent_id` int(10) UNSIGNED DEFAULT NULL,
	`title` varchar(255) NOT NULL,
	`alias` varchar(255) DEFAULT NULL,
	`summary` text,
	PRIMARY KEY (`id`),
	UNIQUE KEY `alias` (`alias`)
) DEFAULT CHARSET=utf8;
