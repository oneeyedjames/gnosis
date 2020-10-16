CREATE VIEW `series_module` AS
SELECT DISTINCT `sc`.`series_id`, `cm`.`module_id`
FROM `series_course` AS `sc`
INNER JOIN `course_module` AS `cm`
ON `cm`.`course_id` = `sc`.`course_id`;
