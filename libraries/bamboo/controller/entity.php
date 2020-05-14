<?php

namespace Bamboo\Controller;

abstract class EntityController implements Controller {
	function getRoutes() {
		return [
			'GET' => [
				$this->getListRoute() => 'getAll',
				$this->getItemRoute() => 'getOne',
			],
			'POST' => [
				$this->getListRoute() => 'create'
			],
			'PUT' => [
				$this->getItemRoute() => 'update'
			],
			'DELETE' => [
				$this->getItemRoute() => 'delete'
			]
		];
	}

	abstract function getListRoute();
	abstract function getItemRoute();
	abstract function getItemLinks($item);
	abstract function getItemEmbeds($item);
}
