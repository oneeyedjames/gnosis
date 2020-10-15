ALTER TABLE `category`
ADD CONSTRAINT `category_parent` FOREIGN KEY (`parent_id`) REFERENCES `category`(`id`);
