<?php

namespace LMS\Model;

use LMS\model;
use LMS\title_model_trait;

class lesson_model extends model {
	use title_model_trait;

	function __construct($database, $cache) {
		parent::__construct('lesson', $database, $cache);
	}

	function get_for_module($module_id, $args = []) {
		$args['args'] = compact('module_id');
		$args['sort'] = ['position' => 'asc'];

		return $this->get_result($args);
	}
}
