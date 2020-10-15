<?php

namespace LMS;

use PHPunk\Component\template as template_base;

class template extends template_base {
	private $_controllers = [];

	public function __call($func, $args) {
		if ($count = count($this->_controllers)) {
			$controller = $this->_controllers[$count - 1];

			if (method_exists($controller, $func))
				return call_user_func_array([$controller, $func], $args);
		}

		$class = get_class($this);
		trigger_error("Call to undefined method $class::$func()", E_USER_WARNING);
	}

	public function __get($key) {
		if ($count = count($this->_controllers)) {
			$controller = $this->_controllers[$count - 1];

			return $controller->__get($key);
		}

		$class = get_class($this);
		trigger_error("Call to undefined property $class::$key", E_USER_WARNING);
	}

	public function load($view, $resource = false, $vars = []) {
		$app = application::load();

		$ctrl = $this->_controllers[] = $app->controller($resource);
		$ctrl->pre_view($view, $vars);

		parent::load($view, $resource, $vars);

		array_pop($this->_controllers);
	}
}
