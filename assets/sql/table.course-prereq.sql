CREATE TABLE `course_prereq` (
	`course_id` int(10) UNSIGNED NOT NULL,
	`prereq_id` int(10) UNSIGNED NOT NULL,
	PRIMARY KEY (`course_id`,`prereq_id`)
) DEFAULT CHARSET=utf8;
