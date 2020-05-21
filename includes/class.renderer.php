<?php

namespace LMS;

use PHPunk\Component\renderer as renderer_base;

class renderer extends renderer_base {
	private static $_default_renderer = false;
	private static $_renderers = [];

	public static function load($resource = false) {
		if ($resource) {
			if (!isset(self::$_renderers[$resource])) {
				$class = "\\LMS\\Renderer\\{$resource}_renderer";

				if (class_exists($class))
					self::$_renderers[$resource] = new $class();
				else
					self::$_renderers[$resource] = new self($resource);
			}

			return self::$_renderers[$resource];
		} else {
			if (!self::$_default_renderer)
				self::$_default_renderer = new self(false);

			return self::$_default_renderer;
		}
	}

	public function render($view) {
		if (is_string($view)) {
			$controller = controller::load($this->resource);
			$controller->pre_render($view, $result);

			parent::render($result);
		} else {
			parent::render($view);
		}
	}

	protected function build_url($params) {
		return url_schema::load()->build($params);
	}

	protected function create_response($record) {
		$response = parent::create_response($record);

		if ($embeds = $this->get_embeds($record)) {
			$response->_embeds = $embeds;
		}

		return $response;
	}

	protected function get_embeds($record) {
		return [];
	}
}
