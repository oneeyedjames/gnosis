ALTER TABLE `answer`
ADD CONSTRAINT `answer_question` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`);
