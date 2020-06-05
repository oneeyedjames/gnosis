<?php

namespace LMS\Controller;

use LMS\application;
use LMS\controller;
use LMS\renderer;

class module_controller extends controller {
	function item_api($vars) {
		$vars = parent::item_api($vars);

		if ($record = @$vars[renderer::RECORD]) {
			$category = $this->get_record($record->category_id, 'category');
			$difficulty = $this->get_record($record->difficulty_id, 'difficulty');

			$model = $this->application->model('lesson');
			$lessons = $model->get_for_module($record->id);

			$vars[renderer::EMBEDDED] = compact(
				'category',
				'difficulty',
				'lessons'
			);
		}

		return $vars;
	}
}
