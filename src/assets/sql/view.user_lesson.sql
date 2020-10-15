CREATE VIEW `user_lesson` AS
SELECT `ul`.`user_id`, `ul`.`lesson_id`,
`ul`.`score`, `l`.`value_total` AS `total`,
`ul`.`score` / `l`.`value_total` AS `percent`,
`ul`.`created_date`, `ul`.`modified_date`
FROM `lesson_badge` AS `l` INNER JOIN (
	SELECT `ue`.`user_id`, `e`.`lesson_id`,
	SUM(`ue`.`score`) AS `score`,
	MIN(`ue`.`created_date`) AS `created_date`,
	MAX(`ue`.`modified_date`) AS `modified_date`
	FROM `exercise` AS `e`
	INNER JOIN `user_exercise` AS `ue`
	ON `ue`.`exercise_id` = `e`.`id`
	GROUP BY `ue`.`user_id`, `e`.`lesson_id`
) AS `ul` ON `ul`.`lesson_id` = `l`.`id`;
