CREATE VIEW `user_lesson` AS
SELECT `ue`.`user_id`, `e`.`lesson_id`,
SUM(`ue`.`score`) AS `score`,
MIN(`ue`.`created_date`) AS `created_date`,
MAX(`ue`.`modified_date`) AS `modified_date`
FROM `user_exercise` AS `ue`
INNER JOIN `exercise` AS `e`
ON `e`.`id` = `ue`.`exercise_id`
GROUP BY `ue`.`user_id`, `e`.`lesson_id`;
