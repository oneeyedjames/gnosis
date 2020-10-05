CREATE TABLE `user` (
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`nickname` VARCHAR(255) NOT NULL,
	`username` VARCHAR(64) NOT NULL,
	`password` VARCHAR(64) NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `username` (`username`),
	UNIQUE KEY `nickname` (`nickname`)
) DEFAULT CHARSET=utf8;
