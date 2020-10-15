ALTER TABLE `lesson`
ADD CONSTRAINT `lesson_module` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`);
