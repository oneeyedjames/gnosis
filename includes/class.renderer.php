<?php

namespace LMS;

use PHPunk\Component\renderer as renderer_base;

class renderer extends renderer_base {
	public function render($view) {
		if (is_string($view)) {
			$controller = application::load()->controller($this->resource);
			$controller->pre_render($view, $result);

			parent::render($result);
		} else {
			parent::render($view);
		}
	}

	protected function build_url($params) {
		return application::load()->router->build($params);
	}
}
