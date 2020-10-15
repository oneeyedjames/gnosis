CREATE VIEW `user_badge` AS
SELECT `s`.`id`, `us`.`user_id`, 'series' AS `type`,
`s`.`title`, `s`.`alias`, `s`.`image`, `s`.`summary`,
`us`.`score`, `us`.`total`, `us`.`percent`,
`us`.`created_date`, `us`.`modified_date`
FROM `series` AS `s`
INNER JOIN `user_series` AS `us`
ON `s`.`id` = `us`.`series_id`
UNION
SELECT `c`.`id`, `uc`.`user_id`, 'course' AS `type`,
`c`.`title`, `c`.`alias`, `c`.`image`, `c`.`summary`,
`uc`.`score`, `uc`.`total`, `uc`.`percent`,
`uc`.`created_date`, `uc`.`modified_date`
FROM `course` AS `c`
INNER JOIN `user_course` AS `uc`
ON `c`.`id` = `uc`.`course_id`
UNION
SELECT `m`.`id`, `um`.`user_id`, 'module' AS `type`,
`m`.`title`, `m`.`alias`, `m`.`image`, `m`.`summary`,
`um`.`score`, `um`.`total`, `um`.`percent`,
`um`.`created_date`, `um`.`modified_date`
FROM `module` AS `m`
INNER JOIN `user_module` AS `um`
ON `m`.`id` = `um`.`module_id`;
