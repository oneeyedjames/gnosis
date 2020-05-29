<?php

namespace LMS;

use PHPunk\Database\record;
use PHPunk\Database\result;

use PHPunk\Component\controller as controller_base;

class controller extends controller_base {
	static function get_record_id() {
		return is_numeric(@$_GET['id']) ? intval($_GET['id']) : false;
	}

	/**
	 * Default is page 1, page count is 1-based
	 */
	static function get_page() {
		return is_numeric(@$_GET['page']) ? intval($_GET['page']) : DEFAULT_PAGE;
	}

	/**
	 * Default is 12 items per page
	 */
	static function get_per_page() {
		return is_numeric(@$_GET['per_page']) ? intval($_GET['per_page']) : DEFAULT_PER_PAGE;
	}

	static function get_sorting() {
		return is_array(@$_GET['sort']) ? $_GET['sort'] : false;
	}

	static function get_filter($key) {
		return isset($_GET['filter'][$key]) ? $_GET['filter'][$key] : false;
	}

	public function __call($func, $args) {
		if (method_exists($this->_model, $func))
			return call_user_func_array([$this->_model, $func], $args);

		$class = get_class($this);
		trigger_error("Call to undefined method $class::$func()", E_USER_WARNING);
	}

	public function get_result($args = []) {
		$args = $this->filter_args($args);
		return $this->_model->get_result($args);
	}

	protected function filter_args($args = []) {
		$defaults = $this->get_default_args();
		return array_merge($defaults, $args);
	}

	protected function get_default_args() {
		$page     = self::get_page();
		$per_page = self::get_per_page();

		$args = [
			'limit' => $per_page,
			'offset' => ($page - 1) * $per_page
		];

		if ($sort = self::get_sorting())
			$args['sort'] = $sort;

		return $args;
	}

	/**
	 * TODO backport to PHPunk project
	 */
	public function pre_render($view, &$vars) {
		$method = str_replace('-', '_', $view) . '_api';
		if (method_exists($this, $method))
			$vars = call_user_func([$this, $method], $vars);
	}

	/**
	 * TODO backport to PHPunk project
	 */
	protected function build_url($params) {
		if (DEFAULT_PAGE == @$params['page']) unset($params['page']);
		if (DEFAULT_PER_PAGE == @$params['per_page']) unset($params['per_page']);

		return application::load()->router->build($params);
	}

	/**
	 * TODO backport to PHPunk project
	 */
	protected function get_result_links($result, $args = []) {
		$args['resource'] = $this->resource;
		$args['api'] = true;

		if (empty($args['page']))
			$args['page'] = self::get_page();

		if (empty($args['per_page']))
			$args['per_page'] = self::get_per_page();

		$first = $args;
		$first['page'] = 1;

		$last = $args;
		$last['page'] = intval(ceil($result->found / $args['per_page']));

		$links = [
			'self' => [
				'href' => $this->build_url($args)
			],
			'first' => [
				'href' => $this->build_url($first)
			],
			'last' => [
				'href' => $this->build_url($last)
			]
		];

		$prev = $args;
		$prev['page']--;

		$next = $args;
		$next['page']++;

		if ($prev['page'] >= $first['page'])
			$links['prev'] = ['href' => $this->build_url($prev)];

		if ($next['page'] <= $last['page'])
			$links['next'] = ['href' => $this->build_url($next)];

		return $links;
	}

	/**
	 * TODO backport to PHPunk project
	 */
	protected function get_record_links($record, $args = []) {
		$args['resource'] = $this->resource;
		$args['id'] = $record->id;
		$args['api'] = true;

		return ['self' => ['href' => $this->build_url($args)]];
	}

	/**
	 * TODO backport to PHPunk project
	 */
	protected function embed($object) {
		if ($object instanceof record) {
			$embedded = $this->render($object, true);
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
}
