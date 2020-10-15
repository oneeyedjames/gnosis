CREATE VIEW `module_badge` AS
SELECT `m`.*,
IFNULL(COUNT(DISTINCT `l`.`id`), 0) AS `lesson_count`,
IFNULL(COUNT(DISTINCT `e`.`id`), 0) AS `exercise_count`,
IFNULL(SUM(`e`.`value`), 0) AS `value_total`
FROM `module` AS `m`
LEFT JOIN `lesson` AS `l` ON `l`.`module_id` = `m`.`id`
LEFT JOIN `exercise` AS `e` ON `e`.`lesson_id` = `l`.`id`
GROUP BY `m`.`id`;
