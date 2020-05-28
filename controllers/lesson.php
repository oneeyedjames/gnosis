<?php

namespace LMS\Controller;

use LMS\controller;

class lesson_controller extends controller {
	function api_index_view($get, $post) {
		if ($module_id = self::get_filter('module'))
			return $this->get_for_module($module_id, $this->filter_args());
		else
			return $this->get_result();
	}

	function api_item_view($get, $post) {
		if ($id = self::get_record_id())
			return $this->get_record($id);
	}
}
