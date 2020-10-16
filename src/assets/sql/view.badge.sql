CREATE VIEW `badge` AS
SELECT `s`.`id`, 'series' AS `type`,
`s`.`title`, `s`.`alias`, `s`.`summary`, `b`.`value`
FROM `series` AS `s`
INNER JOIN `series_badge` AS `b`
ON `b`.`series_id` = `s`.`id`
UNION SELECT `c`.`id`, 'course' AS `type`,
`c`.`title`, `c`.`alias`, `c`.`summary`, `b`.`value`
FROM `course` AS `c`
INNER JOIN `course_badge` AS `b`
ON `b`.`course_id` = `c`.`id`
UNION SELECT `m`.`id`, 'module' AS `type`,
`m`.`title`, `m`.`alias`, `m`.`summary`, `b`.`value`
FROM `module` AS `m`
INNER JOIN `module_badge` AS `b`
ON `b`.`module_id` = `m`.`id`;
