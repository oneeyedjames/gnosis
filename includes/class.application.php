<?php

namespace LMS;

use PHPunk\Component\application as application_base;

class application extends application_base {
	private static $_instance;

	public static function load() {
		if (is_null(self::$_instance))
			self::$_instance = new self();

		return self::$_instance;
	}

	private function __construct() {}

	protected function create_model($resource = false) {
		if (!($database = $this->database)) {
			trigger_error("No default database", E_USER_ERROR);
			return false;
		}

		if ($resource) {
			$class = "\\LMS\\Model\\{$resource}_model";

			if (class_exists($class)) return new $class($database, $this->cache);
			else return new model($resource, $database, $this->cache);
		}

		return new model(false, $database, $this->cache);
	}

	protected function create_controller($resource = false) {
		$model = $this->load_model($resource);

		if ($resource) {
			$class = "\\LMS\Controller\\{$resource}_controller";

			if (class_exists($class)) return new $class($model);
			else return new controller($model);
		}

		return new controller($model);
	}

	protected function create_renderer($resource = false) {
		if ($resource) {
			$class = "\\LMS\\Renderer\\{$resource}_renderer";

			if (class_exists($class)) return new $class();
			else return new renderer($resource);
		}

		return new renderer();
	}
}
