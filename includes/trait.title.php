<?php

namespace LMS;

trait title_trait {
	function sanitize_title($title) {
		$alias = strtolower($title);
		$alias = preg_replace('/\s+/', '-', $alias);
		$alias = preg_replace('/[^a-z0-9-._~]/', '', $alias);

		return $alias;
	}
}
