<?php

namespace LMS\Controller;

abstract class EntityController extends \Bamboo\Controller\EntityController {
	function getAll($params) {
		$model = $this->getModel();

		if (($result = $model->getAll()) !== false) {
			foreach ($result as &$item) {
				$item->_links = $this->getItemLinks($item);
				$item->_embedded = $this->getItemEmbeds($item);
			}

			echo json_encode($result);
		}
	}

	function getOne($params) {
		$model = $this->getModel();
		$model->unique_key = $params->route_key;

		if ($model->getOne()) {
			$model->_links = $this->getItemLinks($model);
			$model->_embedded = $this->getItemEmbeds($model);

			echo json_encode($model);
		}
	}

	function create($params) {
		$model = $this->getModel($params->body);

		if ($model->create()) {
			$model->_links = $this->getItemLinks($model);
			$model->_embedded = $this->getItemEmbeds($model);

			echo json_encode($model);
		}
	}

	function update($params) {
		$model = $this->getModel($params->body);
		$model->unique_key = $params->route_key;

		if ($model->update())
			echo json_encode($model);
	}

	function delete($params) {
		$model = $this->getModel();
		$model->unique_key = $params->route_key;

		if ($model->delete())
			echo json_encode($model);
	}

	function getListRoute() {
		return $this->getBaseRoute();
	}

	function getItemRoute() {
		return $this->getBaseRoute() . '/@route_key';
	}

	function getItemLinks($model) {
		return [
			'self' => [
				'href' => $this->getBaseRoute() . "/$model->unique_key"
			]
		];
	}

	function getItemEmbeds($item) {
		return [];
	}

	abstract protected function getBaseRoute();

	abstract protected function getModel($data = []);
}
