<?php

namespace LMS\Model;

use LMS\model;
use LMS\badge_model;
use LMS\title_model;

class course_model extends model {
	use badge_model, title_model;

	function __construct($database, $cache) {
		parent::__construct('course', $database, $cache);
	}

	function get_prereqs($course_id, $args = []) {
		$args['bridge'] = 'cp_prereq';
		$args['args'] = ['cp_course' => $course_id];
		$args['sort'] = ['title' => 'asc'];

		return $this->get_result($args);
	}
}
