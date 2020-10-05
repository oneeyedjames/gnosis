CREATE TABLE `course_module` (
	`course_id` int(10) UNSIGNED NOT NULL,
	`module_id` int(10) UNSIGNED NOT NULL,
	`position` tinyint(3) UNSIGNED DEFAULT NULL,
	PRIMARY KEY (`course_id`,`module_id`),
	KEY `module_id` (`module_id`),
	UNIQUE KEY `position` (`course_id`,`module_id`,`position`)
) DEFAULT CHARSET=utf8;
