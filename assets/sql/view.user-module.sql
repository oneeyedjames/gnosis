CREATE VIEW `user_module` AS
SELECT `um`.*, `m`.`total`, `um`.`progress` / `m`.`total` AS `percentage`
FROM (
	SELECT `module_id`, COUNT(*) AS `total`
	FROM `lesson`
	GROUP BY `module_id`
) AS `m` INNER JOIN (
	SELECT `ul`.`user_id`, `l`.`module_id`, COUNT(*) AS `progress`
	FROM `lesson` AS `l`
	INNER JOIN `user_lesson` AS `ul`
	ON `ul`.`lesson_id` = `l`.`id`
	WHERE `ul`.`done` > 0
	GROUP BY `ul`.`user_id`, `l`.`module_id`
) AS `um` ON `m`.`module_id` = `um`.`module_id`;
