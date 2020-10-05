CREATE VIEW `user_series` AS
SELECT `us`.*, `s`.`total`, `us`.`score` / `s`.`total` AS `percent`
FROM (
	SELECT `sc`.`series_id`, SUM(`l`.`value`) AS `total`
	FROM `lesson` AS `l`
	INNER JOIN `course_module` AS `cm`
	ON `l`.`module_id` = `cm`.`module_id`
	INNER JOIN `series_course` AS `sc`
	ON `cm`.`course_id` = `sc`.`series_id`
	GROUP BY `cm`.`course_id`
) AS `s` INNER JOIN (
	SELECT `ul`.`user_id`, `sc`.`series_id`,
	MIN(`ul`.`created_date`) AS `created_date`,
	MAX(`ul`.`modified_date`) AS `modified_date`,
	SUM(`ul`.`score`) AS `score`
	FROM `lesson` AS `l`
	INNER JOIN `user_lesson` AS `ul`
	ON `l`.`id` = `ul`.`lesson_id`
	INNER JOIN `course_module` AS `cm`
	ON `l`.`module_id` = `cm`.`module_id`
	INNER JOIN `series_course` AS `sc`
	ON `cm`.`course_id` = `sc`.`course_id`
	GROUP BY `ul`.`user_id`, `cm`.`course_id`, `sc`.`series_id`
) AS `us` ON `s`.`series_id` = `us`.`series_id`;
