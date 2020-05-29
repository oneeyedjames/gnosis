<?php

namespace LMS\Controller;

use LMS\application;
use LMS\controller;

class lesson_controller extends controller {
	function index_api($vars) {
		$result = $this->get_result();

		$vars['count'] = count($result);
		$vars['total'] = $result->found;

		$vars['_links'] = $this->get_result_links($result);
		$vars['_embedded']['lessons'] = $this->embed($result);

		return $vars;
	}

	function item_api($vars) {
		if ($id = self::get_record_id()) {
			$record = $this->get_record($id);

			foreach ($this->render($record) as $field => $value)
				$vars[$field] = $value;

			$ctrl = application::load()->controller('module');
			$module = $ctrl->get_record($record->module_id);

			$vars['_links'] = $this->get_record_links($record);
			$vars['_embedded']['module'] = $ctrl->embed($module, true);

			return $vars;
		}
	}
}
