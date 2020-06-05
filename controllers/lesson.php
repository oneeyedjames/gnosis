<?php

namespace LMS\Controller;

use LMS\application;
use LMS\controller;
use LMS\renderer;

class lesson_controller extends controller {
	function index_api($vars) {
		$vars[renderer::RESULT] = $this->get_result();
		$vars[renderer::URL_PARAMS]['page'] = self::get_page();
		$vars[renderer::URL_PARAMS]['per_page'] = self::get_per_page();

		return $vars;
	}

	function item_api($vars) {
		if ($id = self::get_record_id()) {
			$record = $this->get_record($id);
			$module = $this->get_record($record->module_id, 'module');

			$vars[renderer::RECORD] = $record;
			$vars[renderer::EMBEDDED] = compact('module');

			return $vars;
		}
	}
}
