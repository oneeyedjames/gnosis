<?php

namespace LMS;

use PHPunk\Component\model as model_base;

class model extends model_base {
	private static $_default_database = false;
	private static $_default_cache    = false;
	private static $_default_model    = false;

	private static $_models = [];

	private $_parent_relations = [];
	private $_child_relations  = [];

	public static function init($database = false, $cache = false) {
		if (!self::$_default_database)
			self::$_default_database = $database;

		if (!self::$_default_cache)
			self::$_default_cache = $cache;
	}

	public static function load($resource = false) {
		$database = self::$_default_database;
		$cache    = self::$_default_cache;

		if (!$database)
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
}
