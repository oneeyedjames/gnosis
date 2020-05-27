<?php

namespace LMS\Controller;

use PHPunk\Util\object;

use LMS\controller;

use function LMS\get_offset;

class lesson_controller extends controller {
	function api_index_view($get, $post) {
		if ($module_id = self::get_filter('module')) {
			$limit = self::get_per_page();
			$offset = (self::get_page() - 1) * $limit;
			return $this->get_for_module($module_id, $limit, $offset);
		} else {
			return $this->get_result();
		}
	}

	function api_item_view($get, $post) {
		if ($id = self::get_record_id()) {
			return $this->get_record($id);
		}
	}
}
