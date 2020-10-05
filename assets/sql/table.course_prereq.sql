CREATE TABLE `course_prereq` (
	`course_id` INT UNSIGNED NOT NULL,
	`prereq_id` INT UNSIGNED NOT NULL,
	PRIMARY KEY (`course_id`,`prereq_id`),
	KEY `prereq_id` (`prereq_id`)
) DEFAULT CHARSET=utf8;
