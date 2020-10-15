<?php

namespace LMS;

use PHPunk\Component\controller as controller_base;

class controller extends controller_base {
	use request_controller;

	public function __get($key) {
		switch ($key) {
			case 'application':
				return application::load();
			default:
				return parent::__get($key);
		}
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

	public function index_api($vars) {
		$vars[renderer::RESULT] = $this->get_result();
		$vars[renderer::URL_PARAMS]['page'] = self::get_page();
		$vars[renderer::URL_PARAMS]['per_page'] = self::get_per_page();

		return $vars;
	}

	public function item_api($vars) {
		if ($id = self::get_record_id())
			$vars[renderer::RECORD] = $this->get_record($id);

		return $vars;
	}
}
