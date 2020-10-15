CREATE TABLE `exercise` (
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`lesson_id` INT UNSIGNED NOT NULL,
	`position` TINYINT UNSIGNED NOT NULL,
	`content` TEXT,
	`value` TINYINT UNSIGNED NOT NULL DEFAULT 1,
	PRIMARY KEY (`id`),
	UNIQUE KEY `position` (`lesson_id`,`position`)
) DEFAULT CHARSET=utf8;
