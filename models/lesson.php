<?php

namespace LMS\Model;

class LessonModel extends EntityModel {
	use TitleEntity;

	function __construct($data = []) {
		parent::__construct('lesson', $data);
	}

	function validate() {
		if (empty($this->position))
			$this->position = 0;

		$this->createAlias();

		return true;
	}
}
