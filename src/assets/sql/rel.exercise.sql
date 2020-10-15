ALTER TABLE `exercise`
ADD CONSTRAINT `exercise_lesson` FOREIGN KEY (`lesson_id`) REFERENCES `lesson` (`id`);
