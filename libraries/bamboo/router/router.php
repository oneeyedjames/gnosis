<?php

namespace Bamboo\Router;

class Router {
	private $routes = [
		'GET'    => [],
		'POST'   => [],
		'PUT'    => [],
		'DELETE' => []
	];

	function registerHandler($method, $route, $handler) {
		$method = strtoupper($method);
		$route  = strtolower($route);

		if (!array_key_exists($method, $this->routes))
			return trigger_error("Invalid HTTP method: $method", E_USER_WARNING);

		if (empty($route))
			return trigger_error("Cannot register empty route", E_USER_WARNING);

		if (!is_callable($handler))
			return trigger_error("Handler for route ($method $route) is not callable", E_USER_WARNING);

		$this->routes[$method][$route] = $handler;

		return $this;
	}

	function registerController($ctrl) {
		foreach ($ctrl->getRoutes() as $method => $routes) {
			foreach ($routes as $route => $handler) {
				$this->registerHandler($method, $route, [$ctrl, $handler]);
			}
		}
	}

	function route($method, $path, $body) {
		$method = strtoupper($method);
		$path   = '/' . trim($path, '/');

		foreach ($this->routes[$method] as $route => $handler) {
			$keys = [];

			if (preg_match_all('/@([a-z0-9_]+)/i', $route, $match))
				$keys = $match[1];

			$regex = preg_replace('/@[a-z0-9_]+/i', '([a-z0-9-_]+)', $route);

			if (preg_match('|^' . $regex . '$|i', $path, $match)) {
				array_shift($match);

				$params = array_combine($keys, $match);

				call_user_func($handler, new RouteParams($route, $params, $body));

				return $route;
			}
		}

		return false;
	}
}
