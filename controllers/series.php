<?php

namespace LMS\Controller;

use LMS\controller;
use LMS\renderer;

use LMS\badge_ctrl_trait;

class series_controller extends controller {
	use badge_ctrl_trait;

	function item_api($vars) {
		$vars = parent::item_api($vars);

		if ($record = @$vars[renderer::RECORD]) {
			$model = $this->application->model('course');
			$courses = $model->get_for_series($record->id);
			$vars[renderer::EMBEDDED]['courses'] = $courses;
		}

		return $vars;
	}
}
