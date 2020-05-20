<?php

namespace LMS\Controller;

use PHPunk\Util\object;

use LMS\controller;

use function LMS\get_offset;

class module_controller extends controller {
	function api_index_view($get, $post) {
		$get = new object($get);

		$limit = $get->per_page(DEFAULT_PER_PAGE);
		$offset = get_offset($get->page(DEFAULT_PAGE), $limit);

		if ($course_id = $get->filter['course']) {
			return $this->get_for_course($course_id, $limit, $offset);
		} else {
			return $this->get_result(compact('limit', 'offset'));
		}
	}

	function api_item_view($get, $post) {
		$get = new object($get);

		if (isset($get->id)) {
			return $this->get_record($get->id);
		}
	}

	// function getLessons($params) {
	// 	$module = new ModuleModel();
	// 	$module->unique_key = $params->route_key;
	//
	// 	$lessons = $module->getLessons();
	//
	// 	die(json_encode($lessons));
	// }
}
