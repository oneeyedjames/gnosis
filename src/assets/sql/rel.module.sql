ALTER TABLE `module`
ADD CONSTRAINT `module_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
ADD CONSTRAINT `module_difficulty` FOREIGN KEY (`difficulty_id`) REFERENCES `difficulty` (`id`);
