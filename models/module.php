<?php

namespace LMS\Model;

use LMS\model;
use LMS\badge_model;
use LMS\title_model;

class module_model extends model {
	use badge_model, title_model;

	function __construct($database, $cache) {
		parent::__construct('module', $database, $cache);
	}

	function render($record, $embedded = false) {
		$data = parent::render($record, $embedded);
		$data = $this->render_badge($data);

		return $data;
	}

	function get_for_course($course_id, $args = []) {
		$args['bridge'] = 'cm_module';
		$args['args'] = ['cm_course' => $course_id];
		$args['sort'] = ['position' => 'asc'];

		return $this->get_result($args);
	}
}
