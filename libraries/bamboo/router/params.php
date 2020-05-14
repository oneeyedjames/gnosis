<?php

namespace Bamboo\Router;

use Bamboo\Entity;
use Bamboo\ArrayLike;

class RouteParams implements ArrayLike {
	use Entity;

	private $route;
	private $body;

	function __construct($route, $params = [], $body = null) {
		$this->route = $route;
		$this->load($params);
		$this->body = $body;
	}

	function __get($key) {
		switch ($key) {
			case 'route':
			case 'body':
				return $this->$key;
			default:
				return $this[$key];
		}
	}
}
