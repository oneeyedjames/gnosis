CREATE VIEW `lesson_badge` AS
SELECT `l`.*,
IFNULL(COUNT(DISTINCT `e`.`id`), 0) AS `exercise_count`,
IFNULL(SUM(`e`.`value`), 0) AS `value_total`
FROM `lesson` AS `l`
LEFT JOIN `exercise` AS `e` ON `e`.`lesson_id` = `l`.`id`
GROUP BY `l`.`id`;
