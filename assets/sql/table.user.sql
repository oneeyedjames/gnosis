CREATE TABLE `user` (
	`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`nickname` varchar(255) NOT NULL,
	`username` varchar(64) NOT NULL,
	`password` varchar(64) NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `username` (`username`),
	UNIQUE KEY `nickname` (`nickname`)
) DEFAULT CHARSET=utf8;
