CREATE TABLE `series_course` (
	`series_id` INT UNSIGNED NOT NULL,
	`course_id` INT UNSIGNED NOT NULL,
	`position` TINYINT UNSIGNED NOT NULL,
	PRIMARY KEY (`series_id`,`course_id`),
	KEY `course_id` (`course_id`),
	UNIQUE KEY `position` (`series_id`,`course_id`,`position`)
) DEFAULT CHARSET=utf8;
