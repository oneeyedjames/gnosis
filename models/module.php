<?php

namespace LMS\Model;

class ModuleModel extends EntityModel {
	use TitleEntity, BadgeEntity;

	function __construct($data = []) {
		parent::__construct('module', $data);
	}

	function validate() {
		$this->setDefaults();
		$this->createAlias();

		return true;
	}

	function getLessons() {
		$query = 'SELECT `l`.* FROM `module` AS `m`
			LEFT JOIN `lesson` AS `l` ON `l`.`module_id` = `m`.`id`';

		$values = [];

		if (isset($this->id)) {
			$query .= " WHERE `m`.`id` = ?";
			$values[] = $this->id;
		} elseif (isset($this->alias)) {
			$query .= " WHERE `m`.`alias` = ?";
			$values[] = $this->alias;
		}

		$query .= ' ORDER BY `l`.`position` ASC';

		if (($result = self::query($query, $values)) !== false) {
			return array_map(function($record) {
				return new LessonModel($record);
			}, $result);
		}

		return false;
	}
}
