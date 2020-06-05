<?php

namespace LMS\Controller;

use LMS\controller;
use LMS\renderer;

class lesson_controller extends controller {
	function item_api($vars) {
		$vars = parent::item_api($vars);

		if ($record = @$vars[renderer::RECORD]) {
			$module = $this->get_record($record->module_id, 'module');

			$vars[renderer::EMBEDDED] = compact('module');

			return $vars;
		}
	}
}
