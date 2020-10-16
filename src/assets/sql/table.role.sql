CREATE TABLE `role` (
	`id` INT UNSIGNED NOT NULL,
	`title` VARCHAR(255) NOT NULL,
	`alias` VARCHAR(255) DEFAULT NULL,
	`summary` TINYTEXT NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `alias` (`alias`)
) DEFAULT CHARSET=utf8;