<?php

namespace LMS\Model;

class CourseModel extends EntityModel {
	use TitleEntity;

	function __construct($data = []) {
		parent::__construct('course', $data);
	}

	function validate() {
		if (empty($this->category_id))
			$this->category_id = 0;

		if (empty($this->difficulty_id))
			$this->difficulty_id = 0;

		if (empty($this->image))
			$this->image = '';

		$this->createAlias();

		return true;
	}

	function getPrereqs() {
		$query = 'SELECT `p`.* FROM `course_prereq` AS `cp`
			INNER JOIN `course` AS `c` ON `cp`.`course_id`
			LEFT JOIN `course` AS `p` ON `cp`.`prereq_id`';

		$values = [];

		if (isset($this->id)) {
			$query .= " WHERE `c`.`id` = ?";
			$values[] = $this->id;
		} elseif (isset($this->alias)) {
			$query .= " WHERE `c`.`alias` = ?";
			$values[] = $this->alias;
		}

		if (($result = self::query($query, $values)) !== false) {
			return array_map(function($record) use ($class) {
				return new CourseModel($record);
			}, $result);
		}

		return false;
	}

	function getModules() {
		$query = 'SELECT `m`.*, `cm`.`position` FROM `course_module` AS `cm`
			INNER JOIN `course` AS `c` ON `cm`.`course_id` = `c`.`id`
			LEFT JOIN `module` AS `m` ON `cm`.`module_id` = `m`.`id`';

		$values = [];

		if (isset($this->id)) {
			$query .= " WHERE `c`.`id` = ?";
			$values[] = $this->id;
		} elseif (isset($this->alias)) {
			$query .= " WHERE `c`.`alias` = ?";
			$values[] = $this->alias;
		}

		$query .= ' ORDER BY `cm`.`position` ASC';

		if (($result = self::query($query, $values)) !== false) {
			return array_map(function($record) use ($class) {
				return new ModuleModel($record);
			}, $result);
		}

		return false;
	}
}
