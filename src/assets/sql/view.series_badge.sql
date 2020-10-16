CREATE VIEW `series_badge` AS
SELECT `sm`.`series_id`, IFNULL(SUM(`e`.`value`), 0) AS `value`,
IFNULL(COUNT(DISTINCT `sm`.`module_id`), 0) AS `module_count`,
IFNULL(COUNT(DISTINCT `l`.`id`), 0) AS `lesson_count`,
IFNULL(COUNT(DISTINCT `e`.`id`), 0) AS `exercise_count`
FROM `series_module` AS `sm`
LEFT JOIN `lesson` AS `l` ON `l`.`module_id` = `sm`.`module_id`
LEFT JOIN `exercise` AS `e` ON `e`.`lesson_id` = `l`.`id`
GROUP BY `sm`.`series_id`;
