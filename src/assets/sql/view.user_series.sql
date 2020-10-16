CREATE VIEW `user_series` AS
SELECT `ue`.`user_id`, `sm`.`series_id`,
SUM(`ue`.`score`) AS `score`,
MIN(`ue`.`created_date`) AS `created_date`,
MAX(`ue`.`modified_date`) AS `modified_date`
FROM `user_exercise` AS `ue`
INNER JOIN `exercise` AS `e` ON `e`.`id` = `ue`.`exercise_id`
INNER JOIN `lesson` AS `l` ON `l`.`id` = `e`.`lesson_id`
INNER JOIN `series_module` AS `sm` ON `sm`.`module_id` = `l`.`module_id`
GROUP BY `ue`.`user_id`, `sm`.`series_id`;
