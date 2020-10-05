ALTER TABLE `course`
ADD CONSTRAINT `course_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
ADD CONSTRAINT `course_difficulty` FOREIGN KEY (`difficulty_id`) REFERENCES `difficulty` (`id`);
