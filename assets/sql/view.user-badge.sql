CREATE VIEW `user_badge` AS
SELECT *, 'course' AS `type`
FROM `course` AS `c`
INNER JOIN `user_course` AS `uc`
ON `c`.`id` = `uc`.`course_id`
UNION
SELECT *, 'module' AS `type`
FROM `module` AS `m`
INNER JOIN `user_module` AS `um`
ON `m`.`id` = `um`.`module_id`;
