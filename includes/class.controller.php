<?php

namespace LMS;

use PHPunk\Component\controller as controller_base;

class controller extends controller_base {
	private static $_default_controller = false;

	private static $_controllers = [];

	public static function load($resource = false) {
		if ($resource) {
			if (!isset(self::$_controllers[$resource])) {
				$model = model::load($resource);
				$class = "\\LMS\\Controller\\{$resource}_controller";

				if (class_exists($class))
					self::$_controllers[$resource] = new $class($model);
				else
					self::$_controllers[$resource] = new self($model);
			}

			return self::$_controllers[$resource];
		} else {
			if (!self::$_default_controller)
				self::$_default_controller = new self(model::load());

			return self::$_default_controller;
		}
	}

	public function __call($func, $args) {
		if (method_exists($this->_model, $func))
			return call_user_func_array([$this->_model, $func], $args);

		trigger_error("Call to undefined method controller::$func()", E_USER_WARNING);
	}
}
