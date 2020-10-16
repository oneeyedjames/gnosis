CREATE VIEW `course_badge` AS
SELECT `cm`.`course_id`, IFNULL(SUM(`e`.`value`), 0) AS `value`,
IFNULL(COUNT(DISTINCT `cm`.`module_id`), 0) AS `module_count`,
IFNULL(COUNT(DISTINCT `l`.`id`), 0) AS `lesson_count`,
IFNULL(COUNT(DISTINCT `e`.`id`), 0) AS `exercise_count`
FROM `course_module` AS `cm`
LEFT JOIN `lesson` AS `l` ON `l`.`module_id` = `cm`.`module_id`
LEFT JOIN `exercise` AS `e` ON `e`.`lesson_id` = `l`.`id`
GROUP BY `cm`.`course_id`;
