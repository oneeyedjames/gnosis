<?php

namespace LMS\Controller;

use LMS\Model\CourseModel;
use LMS\Model\CategoryModel;
use LMS\Model\DifficultyModel;

class CourseController extends EntityController {
	protected function getBaseRoute() {
		return '/courses';
	}

	protected function getModel($data = []) {
		return new CourseModel($data);
	}

	function getItemLinks($item) {
		$links = parent::getItemLinks($item);
		$links['modules'] = [
			'href' => $this->getBaseRoute() . "/$item->unique_key/modules"
		];

		return $links;
	}

	function getItemEmbeds($item) {
		$embeds = parent::getItemEmbeds($item);

		if ($item->category_id) {
			$embeds['category'] = new CategoryModel();
			$embeds['category']->id = $item->category_id;
			$embeds['category']->getOne();
		}

		if ($item->difficulty_id) {
			$embeds['difficulty'] = new DifficultyModel();
			$embeds['difficulty']->id = $item->difficulty_id;
			$embeds['difficulty']->getOne();
		}

		return $embeds;
	}

	function getRoutes() {
		$itemRoute = $this->getItemRoute();

		$routes = parent::getRoutes();
		$routes['GET']["$itemRoute/prereqs"] = 'getPrereqs';
		$routes['GET']["$itemRoute/modules"] = 'getModules';

		return $routes;
	}

	function getPrereqs($params) {
		$course = new CourseModel();
		$course->unique_key = $params->route_key;

		$courses = $course->getPrereqs();

		die(json_encode($courses));
	}

	function getModules($params) {
		$course = new CourseModel();
		$course->unique_key = $params->route_key;

		$modules = $course->getModules();

		die(json_encode($modules));
	}
}
