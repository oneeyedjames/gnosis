CREATE VIEW `badge` AS
SELECT `s`.*, `lsum`.`value`, 'series' AS `type`
FROM `series` AS `s` INNER JOIN (
	SELECT `sc`.`series_id`, SUM(`l`.`value`) AS `value`
	FROM `lesson` AS `l`
	INNER JOIN `course_module` AS `cm`
	ON `l`.`module_id` = `cm`.`module_id`
	INNER JOIN `series_course` AS `sc`
	ON `cm`.`course_id` = `sc`.`series_id`
	GROUP BY `sc`.`series_id`
) AS `lsum` ON  `lsum`.`series_id` = `s`.`id`
UNION SELECT `c`.*, `lsum`.`value`, 'course' AS `type`
FROM `course` AS `c` INNER JOIN (
	SELECT `cm`.`course_id`, SUM(`l`.`value`) AS `value`
	FROM `lesson` AS `l`
	INNER JOIN `course_module` AS `cm`
	ON `l`.`module_id` = `cm`.`module_id`
	GROUP BY `cm`.`course_id`
) AS `lsum` ON `lsum`.`course_id` = `c`.`id`
UNION SELECT `m`.*, `lsum`.`value`, 'module' AS `type`
FROM `module` AS `m` INNER JOIN (
	SELECT `l`.`module_id`, SUM(`l`.`value`) AS `value`
	FROM `lesson` AS `l`
	GROUP BY `module_id`
) AS `lsum` ON `lsum`.`module_id` = `m`.`id`;
