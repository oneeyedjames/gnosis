CREATE TABLE `perm` (
	`id` INT UNSIGNED NOT NULL,
	`resource` VARCHAR(255) NOT NULL,
	`action` VARCHAR(255) NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `action` (`resource`,`action`)
) DEFAULT CHARSET=utf8;
