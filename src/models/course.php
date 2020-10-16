<?php

namespace LMS\Model;

use LMS\model;
use LMS\title_model_trait;

class course_model extends model {
	use title_model_trait;

	function __construct($database, $cache) {
		parent::__construct('course', $database, $cache);
	}

	function get_prereqs($course_id, $args = []) {
		$args['bridge'] = 'cp_prereq';
		$args['args'] = ['cp_course' => $course_id];
		$args['sort'] = ['title' => 'asc'];

		return $this->get_result($args);
	}

	function get_for_series($series_id, $args = []) {
		$args['bridge'] = 'sc_course';
		$args['args'] = ['sc_series' => $series_id];
		$args['sort'] = ['position' => 'asc'];

		return $this->get_result($args);
	}
}
