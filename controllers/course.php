<?php

namespace LMS\Controller;

use LMS\application;
use LMS\controller;
use LMS\renderer;

class course_controller extends controller {
	function item_api($vars) {
		$vars = parent::item_api($vars);

		if ($record = @$vars[renderer::RECORD]) {
			$category = $this->get_record($record->category_id, 'category');
			$difficulty = $this->get_record($record->difficulty_id, 'difficulty');

			// $prereqs = $this->get_prereqs($record->id);

			$model = $this->application->model('module');
			$modules = $model->get_for_course($record->id);

			$vars[renderer::EMBEDDED] = compact(
				'category',
				'difficulty',
				// 'prereqs',
				'modules'
			);
		}

		return $vars;
	}
}
