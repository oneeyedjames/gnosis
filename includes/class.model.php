<?php

namespace LMS;

use PHPunk\Component\model as model_base;

class model extends model_base {
	private static $_default_cache = false;
	private static $_default_model = false;

	private static $_models = [];

	public static function init($cache) {
		if (!self::$_default_cache)
			self::$_default_cache = $cache;
	}

	public static function load($resource = false) {
		$cache = self::$_default_cache;

		if (!($database = database::load()))
			trigger_error("No default database", E_USER_ERROR);

		if ($resource) {
			if (!isset(self::$_models[$resource])) {
				$class = "\\LMS\\Model\\{$resource}_model";

				if (class_exists($class))
					self::$_models[$resource] = new $class($database, $cache);
				else
					self::$_models[$resource] = new self($resource, $database, $cache);
			}

			return self::$_models[$resource];
		} else {
			if (!self::$_default_model)
				self::$_default_model = new self(null, $database, $cache);

			return self::$_default_model;
		}
	}

	public function get_result($args) {
		return $this->make_query($args)->get_result();
	}

	public function put_record($record) {
		if ($this->validate($record))
			return parent::put_record($record);

		return false;
	}

	public function validate(&$record) {
		trigger_error('Method should be implemented in child class. model::validate()', E_USER_WARNING);

		return false;
	}
}
