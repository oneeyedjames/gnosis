<?php

namespace LMS\Model;

use LMS\model;

class lesson_model extends model {
	function __construct($database, $cache) {
		parent::__construct('lesson', $database, $cache);
	}

	function get_for_module($module_id, $limit = DEFAULT_PER_PAGE, $offset = 0) {
		$args = compact('limit', 'offset');
		$args['args'] = compact('module_id');
		$args['sort']['position'] = 'asc';

		return $this->get_result($args);
	}
}
