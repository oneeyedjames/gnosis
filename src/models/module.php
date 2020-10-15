<?php

namespace LMS\Model;

use LMS\model;
use LMS\title_model;

class module_model extends model {
	use title_model;

	function __construct($database, $cache) {
		parent::__construct('module', $database, $cache);
	}

	function get_for_course($course_id, $args = []) {
		$args['bridge'] = 'cm_module';
		$args['args'] = ['cm_course' => $course_id];
		$args['sort'] = ['position' => 'asc'];

		return $this->get_result($args);
	}
}
