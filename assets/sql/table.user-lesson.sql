CREATE TABLE `user_lesson` (
	`user_id` int(10) UNSIGNED NOT NULL,
	`lesson_id` int(10) UNSIGNED NOT NULL,
	`done` tinyint(3) UNSIGNED NOT NULL,
	PRIMARY KEY (`user_id`,`lesson_id`),
	KEY `lesson_id` (`lesson_id`)
) DEFAULT CHARSET=utf8;
