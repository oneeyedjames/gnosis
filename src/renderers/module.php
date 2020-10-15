<?php

namespace LMS\Renderer;

use LMS\model;
use LMS\renderer;

class module_renderer extends renderer {
	public function __construct() {
		parent::__construct('module');
	}

	public function __get($key) {
		switch ($key) {
			case 'result_name':
				return 'modules';
			default:
				return parent::__get($key);
		}
	}

	protected function map_field_name($field, $embedded = false) {
		switch ($field) {
			case 'id':
			case 'title':
			case 'alias':
			case 'image':
			case 'summary':
				return $field;
		}
	}
}
