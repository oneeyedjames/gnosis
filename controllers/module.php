<?php

namespace LMS\Controller;

use LMS\Model\ModuleModel;

class ModuleController extends EntityController {
	protected function getBaseRoute() {
		return '/modules';
	}

	protected function getModel($data = []) {
		return new ModuleModel($data);
	}

	function getRoutes() {
		$itemRoute = $this->getItemRoute();

		$routes = parent::getRoutes();
		$routes['GET']["$itemRoute/lessons"] = 'getLessons';

		return $routes;
	}

	function getLessons($params) {
		$module = new ModuleModel();
		$module->unique_key = $params->route_key;

		$lessons = $module->getLessons();

		die(json_encode($lessons));
	}
}
