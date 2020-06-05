<?php

namespace LMS\Renderer;

use LMS\model;
use LMS\renderer;

class module_renderer extends renderer {
	public function __construct() {
		parent::__construct('module');
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

	protected function get_result_name() {
		return 'modules';
	}
}
