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

		$this->get_categories($result);
		$this->get_difficulties($result);

		return $result;
	}

	function api_item_view($get, $post) {
		$get = new object($get);

		if ($record_id = $get->id) {
			return $this->get_record($record_id);
		}
	}

	protected function get_categories(&$courses) {
		$category_ids = $courses->map(function($course) {
			return $course->category_id;
		})->toArray();

		$categories = model::load('category')->get_result([
			'args' => [
				'id' => $category_ids
			]
		])->key_map(function($category) {
			return $category->id;
		});

		$courses->walk(function(&$course) use ($categories) {
			$course->category = $categories[$course->category_id];
		});
	}

	protected function get_difficulties(&$courses) {
		$difficulty_ids = $courses->map(function($course) {
			return $course->difficulty_id;
		})->toArray();

		$difficulties = model::load('difficulty')->get_result([
			'args' => [
				'id' => $difficulty_ids
			]
		])->key_map(function($difficulty) {
			return $difficulty->id;
		});

		$courses->walk(function(&$course) use ($difficulties) {
			$course->difficulty = $difficulties[$course->difficulty_id];
		});
	}
}
