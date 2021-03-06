CREATE TABLE `category` (
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`parent_id` INT UNSIGNED DEFAULT NULL,
	`title` VARCHAR(255) NOT NULL,
	`alias` VARCHAR(255) DEFAULT NULL,
	`summary` TEXT,
	PRIMARY KEY (`id`),
	KEY `parent_id` (`parent_id`),
	UNIQUE KEY `alias` (`alias`)
) DEFAULT CHARSET=utf8;
