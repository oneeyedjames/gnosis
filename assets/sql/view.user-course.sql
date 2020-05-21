CREATE VIEW `user_course` AS
SELECT `uc`.*, `c`.`total`, `uc`.`progress` / `c`.`total` AS `percentage`
FROM (
	SELECT `cm`.`course_id`, COUNT(`l`.`id`) AS `total`
	FROM `course_module` AS `cm`
	INNER JOIN `lesson` AS `l`
	ON `cm`.`module_id` = `l`.`module_id`
	GROUP BY `cm`.`course_id`
) AS `c` INNER JOIN (
	SELECT `ul`.`user_id`, `cm`.`course_id`, COUNT(*) AS `progress`
	FROM `lesson` AS `l`
	INNER JOIN `course_module` AS `cm`
	ON `l`.`module_id` = `cm`.`module_id`
	INNER JOIN `user_lesson` AS `ul`
	ON `l`.`id` = `ul`.`lesson_id`
	WHERE `ul`.`done` > 0
	GROUP BY `ul`.`user_id`, `cm`.`course_id`
) AS `uc` ON `c`.`course_id` = `uc`.`course_id`;