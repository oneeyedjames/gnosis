ALTER TABLE `question`
ADD CONSTRAINT `question_exercise` FOREIGN KEY (`exercise_id`) REFERENCES `exercise` (`id`);
