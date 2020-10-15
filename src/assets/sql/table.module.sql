CREATE TABLE `module` (
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`category_id` INT UNSIGNED NOT NULL,
	`difficulty_id` INT UNSIGNED NOT NULL,
	`title` VARCHAR(255) NOT NULL,
	`alias` VARCHAR(255) DEFAULT NULL,
	`image` TINYTEXT NOT NULL,
	`summary` TEXT,
	PRIMARY KEY (`id`),
	KEY `category_id` (`category_id`),
	KEY `difficulty_id` (`difficulty_id`),
	UNIQUE KEY `alias` (`alias`)
) DEFAULT CHARSET=utf8;
