CREATE TABLE `lesson` (
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`module_id` INT UNSIGNED NOT NULL,
	`position` TINYINT UNSIGNED NOT NULL,
	`title` VARCHAR(255) NOT NULL,
	`alias` VARCHAR(255) DEFAULT NULL,
	`summary` TEXT,
	`content` TEXT,
	PRIMARY KEY (`id`),
	UNIQUE KEY `position` (`module_id`,`position`),
	UNIQUE KEY `alias` (`alias`)
) DEFAULT CHARSET=utf8;
