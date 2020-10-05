CREATE TABLE `course_module` (
	`course_id` INT UNSIGNED NOT NULL,
	`module_id` INT UNSIGNED NOT NULL,
	`position` TINYINT UNSIGNED NOT NULL,
	PRIMARY KEY (`course_id`,`module_id`),
	KEY `module_id` (`module_id`),
	UNIQUE KEY `position` (`course_id`,`module_id`,`position`)
) DEFAULT CHARSET=utf8;
