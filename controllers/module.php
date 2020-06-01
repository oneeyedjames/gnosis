<?php

namespace LMS\Controller;

use LMS\application;
use LMS\controller;

class module_controller extends controller {
	function index_api($vars) {
		$result = $this->get_result();

		$vars['count'] = count($result);
		$vars['total'] = $result->found;

		$vars['_links'] = $this->get_result_links($result);
		$vars['_embedded']['modules'] = $this->embed($result);

		return $vars;
	}

	function item_api($vars) {
		if ($id = self::get_record_id()) {
			$record = $this->get_record($id);

			foreach ($this->render($record) as $field => $value)
				$vars[$field] = $value;

			$cat_ctrl = $this->application->controller('category');
			$category = $cat_ctrl->get_record($record->category_id);

			$diff_ctrl = $this->application->controller('difficulty');
			$difficulty = $diff_ctrl->get_record($record->difficulty_id);

			$les_ctrl = $this->application->controller('lesson');
			$lessons = $les_ctrl->get_for_module($record->id);

			$vars['_links'] = $this->get_record_links($record);
			$vars['_embedded']['category'] = $cat_ctrl->embed($category, true);
			$vars['_embedded']['difficulty'] = $diff_ctrl->embed($difficulty, true);
			$vars['_embedded']['lessons'] = $les_ctrl->embed($lessons, true);

			return $vars;
		}
	}
}
