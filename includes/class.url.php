<?php

namespace LMS;

use PHPunk\url_schema as url_schema_base;

class url_schema extends url_schema_base {
	private static $host;
	private static $meta;

	private static $instance;

	public static function init($host, $meta) {
		self::$host = $host;
		self::$meta = $meta;
	}

	public static function load() {
		if (is_null(self::$instance)) {
			$host = self::$host;
			$meta = self::$meta;

			self::$instance = new self($host);

			foreach ($meta as $res_name => $res_meta) {
				if ('<global>' == $res_name)
					$res_name = false;
				else
					self::$instance->add_resource($res_name);

				$aliases = @$res_meta->aliases ?: [];
				$actions = @$res_meta->actions ?: [];
				$views   = @$res_meta->views   ?: [];

				foreach ($aliases as $alias)
					self::$instance->add_alias($alias, $res_name);

				foreach ($actions as $action)
					self::$instance->add_action($action, $res_name);

				foreach ($views as $view)
					self::$instance->add_view($view, $res_name);
			}
		}

		return self::$instance;
	}
}
