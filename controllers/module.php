<?php

namespace LMS\Controller;

use LMS\controller;
use LMS\renderer;

use LMS\badge_ctrl_trait;

class module_controller extends controller {
	use badge_ctrl_trait;

	function item_api($vars) {
		$vars = parent::item_api($vars);
		$vars = $this->badge_api($vars);

		if ($record = @$vars[renderer::RECORD]) {
			$model = $this->application->model('lesson');
			$lessons = $model->get_for_module($record->id);

			$vars[renderer::EMBEDDED]['lessons'] = $lessons;
		}

		return $vars;
	}
}
