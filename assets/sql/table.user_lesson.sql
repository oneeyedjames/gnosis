CREATE TABLE `user_lesson` (
	`user_id` int(10) UNSIGNED NOT NULL,
	`lesson_id` int(10) UNSIGNED NOT NULL,
	`score` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
	`created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`user_id`,`lesson_id`),
	KEY `lesson_id` (`lesson_id`)
) DEFAULT CHARSET=utf8;
