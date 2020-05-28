<?php

namespace LMS\Controller;

use PHPunk\Util\object;

use LMS\controller;

class course_controller extends controller {
	function api_index_view($get, $post) {
		$result = $this->get_result();

		$this->get_categories($result);
		$this->get_difficulties($result);

		return $result;
	}

	function api_item_view($get, $post) {
		if ($id = self::get_record_id()) {
			$record = $this->get_record($id);

			$this->get_category($record);
			$this->get_difficulty($record);

			return $record;
		}
	}
}
