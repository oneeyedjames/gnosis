CREATE VIEW `user_badge` AS
SELECT `s`.`id`, `us`.`user_id`, `s`.`category_id`, `s`.`difficulty_id`,
'series' AS `type`, `s`.`title`, `s`.`alias`, `s`.`image`, `s`.`summary`,
`us`.`complete`, `us`.`complete` / `sb`.`exercise_count` AS `progress`,
`us`.`score`, `sb`.`value` AS `total`, `us`.`score` / `sb`.`value` AS `percent`
FROM `series` AS `s`
INNER JOIN `series_badge` AS `sb` ON `sb`.`series_id` = `s`.`id`
INNER JOIN `user_series` AS `us` ON `us`.`series_id` = `s`.`id`
UNION SELECT `c`.`id`, `uc`.`user_id`, `c`.`category_id`, `c`.`difficulty_id`,
'course' AS `type`, `c`.`title`, `c`.`alias`, `c`.`image`, `c`.`summary`,
`uc`.`complete`, `uc`.`complete` / `cb`.`exercise_count` AS `progress`,
`uc`.`score`, `cb`.`value` AS `total`, `uc`.`score` / `cb`.`value` AS `percent`
FROM `course` AS `c`
INNER JOIN `course_badge` AS `cb` ON `cb`.`course_id` = `c`.`id`
INNER JOIN `user_course` AS `uc` ON `uc`.`course_id` = `c`.`id`
UNION SELECT `m`.`id`, `um`.`user_id`, `m`.`category_id`, `m`.`difficulty_id`,
'module' AS `type`, `m`.`title`, `m`.`alias`, `m`.`image`, `m`.`summary`,
`um`.`complete`, `um`.`complete` / `mb`.`exercise_count` AS `progress`,
`um`.`score`, `mb`.`value` AS `total`, `um`.`score` / `mb`.`value` AS `percent`
FROM `module` AS `m`
INNER JOIN `module_badge` AS `mb` ON `mb`.`module_id` = `m`.`id`
INNER JOIN `user_module` AS `um` ON `um`.`module_id` = `m`.`id`;
