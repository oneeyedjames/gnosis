<?php

namespace LMS;

trait request_handler {
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
