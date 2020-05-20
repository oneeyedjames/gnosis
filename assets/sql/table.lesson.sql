CREATE TABLE `lesson` (
	`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`module_id` int(11) NOT NULL,
	`position` tinyint(3) UNSIGNED NOT NULL,
	`title` varchar(255) NOT NULL,
	`alias` varchar(255) DEFAULT NULL,
	`summary` text,
	`content` text,
	PRIMARY KEY (`id`),
	UNIQUE KEY `position` (`module_id`,`position`),
	UNIQUE KEY `alias` (`alias`)
) DEFAULT CHARSET=utf8;
