<?php

namespace LMS;

use PHPunk\Component\model as model_base;

class model extends model_base {
	public function get_result($args) {
		return $this->make_query($args)->get_result();
	}

	public function put_record($record) {
		if ($this->validate($record))
			return parent::put_record($record);

		return false;
	}

	public function validate(&$record) {
		trigger_error('Method should be implemented in child class. model::validate()', E_USER_WARNING);

		return false;
	}
}
