<?php

namespace LMS\Controller;

use LMS\controller;

class module_controller extends controller {
	function api_index_view($get, $post) {
		if ($course_id = self::get_filter('course'))
			$result = $this->get_for_course($course_id, $this->filter_args());
		else
			$result = $this->get_result();

		$this->get_categories($result);
		$this->get_difficulties($result);

		return $result;
	}

	function api_item_view($get, $post) {
		if ($id = self::get_record_id())
			return $this->get_record($id);
	}
}
