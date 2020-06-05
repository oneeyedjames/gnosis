<?php

namespace LMS;

use PHPunk\Component\renderer as renderer_base;

use PHPunk\Database\record;
use PHPunk\Database\result;

use PHPunk\Util\object;

class renderer extends renderer_base {
	const RESULT = 'result';
	const RECORD = 'record';
	const EMBEDDED = 'embedded';
	const URL_PARAMS = 'url_params';

	public function __get($key) {
		switch ($key) {
			case 'application':
				return application::load();
			case 'controller':
				return application::load()->controller($this->resource);
			default:
				return parent::__get($key);
		}
	}

	/**
	 * TODO backport to PHPunk project
	 */
	public function render($view, $vars = []) {
		if (is_string($view)) {
			$this->controller->pre_render($view, $vars);

			// $response = @$vars['response'];
			// $embedded = @$vars['embedded'];

			if ($result = @$vars[self::RESULT]) {
				$params = @$vars[self::URL_PARAMS];

				if (empty($params)) {
					$args = $result->meta->args;

					$params = [
						'page' => $args->offset / $args->limit + 1,
						'per_page' => $args->limit
					];
				}

				$output = new object();
				$output->count = count($result);
				$output->total = $result->found;
				$output->_links = $this->get_result_links($result, $params);

				$vars[self::EMBEDDED][$this->get_result_name()] = $result;
			} elseif ($record = @$vars[self::RECORD]) {
				$output = $this->map_record($record);
				$output->_links = $this->get_record_links($record);
			}

			if ($embedded = @$vars[self::EMBEDDED]) {
				$embeds = [];

				foreach ($embedded as $key => $value) {
					$that = $this->application->renderer($value->meta->resource);
					$embeds[$key] = $that->embed($value);
				}

				$output->_embedded = $embeds;
			}

			header('Content-Type: application/hal+json');
			echo json_encode($output);
		} else {
			parent::render($view);
		}
	}

	/**
	 * TODO backport to PHPunk project
	 */
	protected function embed($object) {
		if ($object instanceof record) {
			$embedded = $this->map_record($object, true);
			$embedded['_links'] = $this->get_record_links($object);
		} elseif ($object instanceof result) {
			$embedded = $object->map(function($record) {
				return $this->embed($record);
			});
		} else {
			$class = get_class($object);
			trigger_error("Invalid object type: $class", E_USER_WARNING);
			return false;
		}

		return $embedded;
	}

	/**
	 * TODO backport to PHPunk project, merge with create_response()
	 */
	protected function map_record($record, $embedded = false) {
		$object = new object();

		foreach ($record as $key => $value) {
			$map_key = $key;
			$map_value = $this->map_field_value($value, $map_key, $embedded);
			if ($map_key) $object[$map_key] = $map_value;
		}

		return $object;
	}

	/**
	 * TODO backport to PHPunk project
	 */
	protected function map_field_name($field, $embedded = false) {
		return $field;
	}

	/**
	 * TODO backport to PHPunk project
	 */
	protected function map_field_value($value, &$field, $embedded = false) {
		$field = $this->map_field_name($field, $embedded);
		return $field ? $value : null;
	}

	/**
	 * Provide implementation for framework class
	 * @param array $params List of key-value parameters for URL
	 * @return string Fully-constructed URL
	 */
	protected function build_url($params) {
		if (DEFAULT_PAGE == @$params['page']) unset($params['page']);
		if (DEFAULT_PER_PAGE == @$params['per_page']) unset($params['per_page']);
		return $this->application->router->build($params);
	}

	/**
	 * TODO backport to PHPunk project
	 */
	protected function get_result_links($result, $params = []) {
		$params['resource'] = $this->resource;
		$params['api'] = true;

		$first = $params;
		$first['page'] = 1;

		$last = $params;
		$last['page'] = intval(ceil($result->found / $params['per_page']));

		$prev = $params;
		$prev['page']--;

		$next = $params;
		$next['page']++;

		$links = [
			'self'  => ['href' => $this->build_url($params)],
			'first' => ['href' => $this->build_url($first)],
			'last'  => ['href' => $this->build_url($last)]
		];

		if ($prev['page'] >= $first['page'])
			$links['prev'] = ['href' => $this->build_url($prev)];

		if ($next['page'] <= $last['page'])
			$links['next'] = ['href' => $this->build_url($next)];

		return $links;
	}

	/**
	 * TODO backport to PHPunk project
	 */
	protected function get_record_links($record, $params = []) {
		$params['resource'] = $this->resource;
		$params['id'] = $record->id;
		$params['api'] = true;

		return ['self' => ['href' => $this->build_url($params)]];
	}

	/**
	 * TODO backport to PHPunk project
	 */
	protected function get_result_name() {
		return $this->resource;
	}
}
