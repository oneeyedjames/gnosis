<?php

namespace LMS\Controller;

use LMS\controller;
use LMS\renderer;

use LMS\badge_ctrl_trait;

class badge_controller extends controller {
	use badge_ctrl_trait;

	function index_view($vars) {
		$vars['badges'] = $this->get_result([
			'sort' => ['title' => 'asc']
		]);

		$this->populate($vars['badges']);

		return $vars;
	}

	function item_api($vars) {
		$vars = parent::item_api($vars);
		$vars = $this->badge_api($vars);

		return $vars;
	}
}
