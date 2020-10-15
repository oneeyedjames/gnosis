<?php

namespace LMS;

use PHPunk\Component\renderer as renderer_base;

use PHPunk\Database\record;
use PHPunk\Database\result;

use PHPunk\Util\object;

class renderer extends renderer_base {
	public function __get($key) {
		switch ($key) {
			case 'application':
				return application::load();
			case 'controller':
				return application::load()->controller($this->resource);
			default:
				return parent::__get($key);
		}
	}

	public function render($view, $vars = []) {
		$this->controller->pre_render($view, $vars);

		if (empty($vars[self::URL_PARAMS])) {
			if ($result = @$vars[self::RESULT]) {
				$args = $result->meta->args;

				$vars[self::URL_PARAMS]['page'] = $args->offset / $args->limit + 1;
				$vars[self::URL_PARAMS]['per_page'] = $args->limit;
			} else {
				$vars[self::URL_PARAMS]['page'] = DEFAULT_PAGE;
				$vars[self::URL_PARAMS]['per_page'] = DEFAULT_PER_PAGE;
			}
		}

		return parent::render($view, $vars);
	}

	/**
	 * Provide implementation for framework class
	 * @param array $params List of key-value parameters for URL
	 * @return string Fully-constructed URL
	 */
	protected function build_url($params) {
		if (DEFAULT_PAGE == @$params['page']) unset($params['page']);
		if (DEFAULT_PER_PAGE == @$params['per_page']) unset($params['per_page']);
		return $this->application->router->build($params);
	}

	protected function embed($object) {
		if ($object->meta->resource &&
			$object->meta->resource != $this->resource) {
			$that = $this->application->renderer($object->meta->resource);
			return $that->embed($object);
		}

		return parent::embed($object);
	}
}
