CREATE TABLE `lesson` (
	`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`module_id` int(10) UNSIGNED NOT NULL,
	`position` tinyint(3) UNSIGNED NOT NULL,
	`title` varchar(255) NOT NULL,
	`alias` varchar(255) DEFAULT NULL,
	`summary` text,
	`content` text,
	`value` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
	PRIMARY KEY (`id`),
	KEY `module_id` (`module_id`),
	UNIQUE KEY `position` (`module_id`,`position`),
	UNIQUE KEY `alias` (`alias`)
) DEFAULT CHARSET=utf8;
