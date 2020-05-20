<?php

namespace LMS\Model;

use LMS\model;
use LMS\badge_model;
use LMS\title_model;

class course_model extends model {
	use badge_model, title_model;

	public function __construct($database, $cache) {
		parent::__construct('course', $database, $cache);
	}

	function get_prereqs($course_id, $limit = DEFAULT_PER_PAGE, $offset = 0) {
		$args = compact('limit', 'offset');
		$args['bridge'] = 'cp_prereq';
		$args['args']['cp_course'] = $course_id;

		return $this->get_result($args);
	}
}
