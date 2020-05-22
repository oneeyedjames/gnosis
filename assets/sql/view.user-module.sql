CREATE VIEW `user_module` AS
SELECT `um`.*, `m`.`total`, `um`.`progress` / `m`.`total` AS `percentage`
FROM (
	SELECT `l`.`module_id`, COUNT(`l`.`id`) AS `total`
	FROM `lesson` AS `l`
	GROUP BY `module_id`
) AS `m` INNER JOIN (
	SELECT `ul`.`user_id`, `l`.`module_id`, COUNT(*) AS `progress`,
	MIN(`ul`.`created_date`) AS `created_date`,
	MAX(`ul`.`modified_date`) AS `modified_date`
	FROM `lesson` AS `l`
	INNER JOIN `user_lesson` AS `ul`
	ON  `l`.`id` = `ul`.`lesson_id`
	WHERE `ul`.`done` > 0
	GROUP BY `ul`.`user_id`, `l`.`module_id`
) AS `um` ON `m`.`module_id` = `um`.`module_id`;
