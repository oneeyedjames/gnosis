<?php

namespace LMS\Controller;

use PHPunk\Util\object;

use LMS\model;
use LMS\controller;

use function LMS\get_offset;

class course_controller extends controller {
	function api_index_view($get, $post) {
		$get = new object($get);

		$limit = $get->per_page(DEFAULT_PER_PAGE);
		$offset = get_offset($get->page(DEFAULT_PAGE), $limit);

		$result = $this->get_result(compact('limit', 'offset'));

		$model = model::load($this->resource);
		$model->get_categories($result);
		$model->get_difficulties($result);

		return $result;
	}

	function api_item_view($get, $post) {
		$get = new object($get);

		if ($record_id = $get->id) {
			return $this->get_record($record_id);
		}
	}
}
