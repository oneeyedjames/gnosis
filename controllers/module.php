<?php

namespace LMS\Controller;

use PHPunk\Util\object;

use LMS\controller;

use function LMS\get_offset;

class module_controller extends controller {
	function api_index_view($get, $post) {
		if ($course_id = self::get_filter('course')) {
			// Delegated model method doesn't apply default args
			$limit = self::get_per_page();
			$offset = (self::get_page() - 1) * $limit;
			$result = $this->get_for_course($course_id, $limit, $offset);
		} else {
			$result = $this->get_result();
		}

		$this->get_categories($result);
		$this->get_difficulties($result);

		return $result;
	}

	function api_item_view($get, $post) {
		if ($id = self::get_record_id()) {
			return $this->get_record($id);
		}
	}
}
