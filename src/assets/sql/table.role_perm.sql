CREATE TABLE `role_perm` (
	`role_id` INT UNSIGNED NOT NULL,
	`perm_id` INT UNSIGNED NOT NULL,
	`override` TINYINT UNSIGNED NOT NULL,
	PRIMARY KEY (`role_id`,`perm_id`),
	KEY `perm_id` (`perm_id`)
) DEFAULT CHARSET=utf8;
