CREATE VIEW `course_badge` AS
SELECT `c`.*,
IFNULL(COUNT(DISTINCT `cm`.`module_id`), 0) AS `module_count`,
IFNULL(COUNT(DISTINCT `l`.`id`), 0) AS `lesson_count`,
IFNULL(COUNT(DISTINCT `e`.`id`), 0) AS `exercise_count`,
IFNULL(SUM(`e`.`value`), 0) AS `value_total`
FROM `course` AS `c`
LEFT JOIN `course_module` AS `cm` ON `cm`.`course_id` = `c`.`id`
LEFT JOIN `lesson` AS `l` ON `l`.`module_id` = `cm`.`module_id`
LEFT JOIN `exercise` AS `e` ON `e`.`lesson_id` = `l`.`id`
GROUP BY `c`.`id`;
