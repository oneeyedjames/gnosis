CREATE TABLE `answer` (
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`question_id` INT UNSIGNED NOT NULL,
	`content` TINYTEXT
	PRIMARY KEY (`id`),
	KEY `question_id` (`question_id`)
) DEFAULT CHARSET=utf8;
