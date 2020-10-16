CREATE VIEW `module_badge` AS
SELECT `l`.`module_id`, IFNULL(SUM(`e`.`value`), 0) AS `value`,
IFNULL(COUNT(DISTINCT `l`.`id`), 0) AS `lesson_count`,
IFNULL(COUNT(DISTINCT `e`.`id`), 0) AS `exercise_count`
FROM `lesson` AS `l`
LEFT JOIN `exercise` AS `e` ON `e`.`lesson_id` = `l`.`id`
GROUP BY `l`.`module_id`;
