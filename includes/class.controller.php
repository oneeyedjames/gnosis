<?php

namespace LMS;

use PHPunk\Component\controller as controller_base;

class controller extends controller_base {
	public function __call($func, $args) {
		if (method_exists($this->_model, $func))
			return call_user_func_array([$this->_model, $func], $args);

		trigger_error("Call to undefined method controller::$func()", E_USER_WARNING);
	}

	public function get_result($args = []) {
		$defaults = $this->get_default_args();
		$args = array_merge($defaults, $args);
		return $this->_model->get_result($args);
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
}
