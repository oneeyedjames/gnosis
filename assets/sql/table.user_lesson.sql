CREATE TABLE `user_lesson` (
	`user_id` INT UNSIGNED NOT NULL,
	`lesson_id` INT UNSIGNED NOT NULL,
	`score` TINYINT UNSIGNED NOT NULL DEFAULT 0,
	`created_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`modified_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`user_id`,`lesson_id`),
	KEY `lesson_id` (`lesson_id`)
) DEFAULT CHARSET=utf8;
