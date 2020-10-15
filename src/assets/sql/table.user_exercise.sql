CREATE TABLE `user_exercise` (
	`user_id` INT UNSIGNED NOT NULL,
	`exercise_id` INT UNSIGNED NOT NULL,
	`score` TINYINT UNSIGNED NOT NULL DEFAULT 0,
	`created_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`modified_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`user_id`,`exercise_id`),
	KEY `exercise_id` (`exercise_id`)
) DEFAULT CHARSET=utf8;
