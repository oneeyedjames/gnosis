CREATE TABLE `question` (
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`exercise_id` INT UNSIGNED NOT NULL,
	`type` VARCHAR(10) NOT NULL DEFAULT 'multiple',
	`content` TINYTEXT,
	`correct_answer` TINYTEXT,
	PRIMARY KEY (`id`),
	KEY `exercise_id` (`exercise_id`)
) DEFAULT CHARSET=utf8;
