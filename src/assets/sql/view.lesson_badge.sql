CREATE VIEW `lesson_badge` AS
SELECT `e`.`lesson_id`, IFNULL(SUM(`e`.`value`), 0) AS `value`,
IFNULL(COUNT(DISTINCT `e`.`id`), 0) AS `exercise_count`
FROM `exercise`
GROUP BY `e`.`lesson_id`;
