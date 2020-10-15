CREATE VIEW `series_badge` AS
SELECT `s`.*,
IFNULL(COUNT(DISTINCT `sm`.`module_id`), 0) AS `module_count`,
IFNULL(COUNT(DISTINCT `l`.`id`), 0) AS `lesson_count`,
IFNULL(COUNT(DISTINCT `e`.`id`), 0) AS `exercise_count`,
IFNULL(SUM(`e`.`value`), 0) AS `value_total`
FROM `series` AS `s`
LEFT JOIN (
	SELECT DISTINCT `sc`.`series_id`, `cm`.`module_id`
	FROM `series_course` AS `sc`
	INNER JOIN `course_module` AS `cm`
	ON `cm`.`course_id` = `sc`.`course_id`
) AS `sm` ON `sm`.`series_id` = `s`.`id`
LEFT JOIN `lesson` AS `l` ON `l`.`module_id` = `sm`.`module_id`
LEFT JOIN `exercise` AS `e` ON `e`.`lesson_id` = `l`.`id`
GROUP BY `s`.`id`;
