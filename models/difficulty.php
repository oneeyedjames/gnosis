<?php

namespace LMS\Model;

class DifficultyModel extends EntityModel {
	function __construct($data = []) {
		parent::__construct('difficulty', $data);
	}

	function validate() { return true; }
}
