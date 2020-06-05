<?php

namespace LMS\Renderer;

use LMS\model;
use LMS\renderer;

class lesson_renderer extends renderer {
	public function __construct() {
		parent::__construct('lesson');
	}

	protected function map_field_name($field, $embedded = false) {
		switch ($field) {
			case 'id':
			case 'title':
			case 'alias':
			case 'summary':
				return $field;
			case 'video':
			case 'content':
				return $embedded ? null : $field;
		}
	}
}
