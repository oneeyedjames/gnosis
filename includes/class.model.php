<?php

namespace LMS;

use PHPunk\Component\model as model_base;

class model extends model_base {
	public function __get($key) {
		switch ($key) {
			case 'application':
				return application::load();
			default:
				return parent::__get($key);
		}
	}

	public function get_result($args) {
		$result = $this->make_query($args)->get_result();
		$result->meta->resource = $this->resource;
		$result->meta->args = $args;

		return $result;
	}

	/**
	 * Allow record retrieval from another model
	 */
	public function get_record($id, $resource = false) {
		if ($resource && $resource != $this->resource)
			return $this->application->model($resource)->get_record($id);

		return parent::get_record($id);
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
