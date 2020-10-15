<?php

namespace LMS\Controller;

use LMS\controller;
use LMS\renderer;

use LMS\badge_ctrl_trait;

class course_controller extends controller {
	use badge_ctrl_trait;

	function item_api($vars) {
		$vars = parent::item_api($vars);
		$vars = $this->badge_api($vars);

		if ($record = @$vars[renderer::RECORD]) {
			$prereqs = $this->get_prereqs($record->id);

			$model = $this->application->model('module');
			$modules = $model->get_for_course($record->id);

			$vars[renderer::EMBEDDED]['prereqs'] = $prereqs;
			$vars[renderer::EMBEDDED]['modules'] = $modules;
		}

		return $vars;
	}
}
