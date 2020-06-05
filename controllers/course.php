<?php

namespace LMS\Controller;

use LMS\application;
use LMS\controller;
use LMS\renderer;

class course_controller extends controller {
	function index_api($vars) {
		$vars[renderer::RESULT] = $this->get_result();
		$vars[renderer::URL_PARAMS]['page'] = self::get_page();
		$vars[renderer::URL_PARAMS]['per_page'] = self::get_per_page();

		return $vars;
	}

	function item_api($vars) {
		if ($id = self::get_record_id()) {
			$record = $this->get_record($id);

			$category = $this->get_record($record->category_id, 'category');
			$difficulty = $this->get_record($record->difficulty_id, 'difficulty');

			// $prereqs = $this->get_prereqs($record->id);

			$model = $this->application->model('module');
			$modules = $model->get_for_course($record->id);

			$vars[renderer::RECORD] = $record;
			$vars[renderer::EMBEDDED] = compact(
				'category',
				'difficulty',
				// 'prereqs',
				'modules'
			);

			return $vars;
		}
	}
}
