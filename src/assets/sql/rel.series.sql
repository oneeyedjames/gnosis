ALTER TABLE `series`
ADD CONSTRAINT `series_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
ADD CONSTRAINT `series_difficulty` FOREIGN KEY (`difficulty_id`) REFERENCES `difficulty` (`id`);
