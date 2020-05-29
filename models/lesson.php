<?php

namespace LMS\Model;

use LMS\model;

class lesson_model extends model {
	function __construct($database, $cache) {
		parent::__construct('lesson', $database, $cache);
	}

	function render($record, $embedded = false) {
		$data = parent::render($record, $embedded);

		unset($data['module_id'], $data['position']);
		if ($embedded) unset($data['content']);

		return $data;
	}

	function get_for_module($module_id, $args = []) {
		$args['args'] = compact('module_id');
		$args['sort'] = ['position' => 'asc'];

		return $this->get_result($args);
	}
}
