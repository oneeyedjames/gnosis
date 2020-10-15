CREATE TABLE `user_role` (
	`user_id` INT UNSIGNED NOT NULL,
	`role_id` INT UNSIGNED NOT NULL,
	PRIMARY KEY (`user_id`,`role_id`),
	KEY `role_id` (`role_id`)
) DEFAULT CHARSET=utf8;
