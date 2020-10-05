CREATE TABLE `course` (
	`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`category_id` int(10) UNSIGNED NOT NULL,
	`difficulty_id` int(10) UNSIGNED NOT NULL,
	`title` varchar(255) NOT NULL,
	`alias` varchar(255) DEFAULT NULL,
	`image` tinytext NOT NULL,
	`summary` text,
	PRIMARY KEY (`id`),
	KEY `category_id` (`category_id`),
	KEY `difficulty_id` (`difficulty_id`),
	UNIQUE KEY `alias` (`alias`)
) DEFAULT CHARSET=utf8;
