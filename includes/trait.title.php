<?php

namespace LMS;

trait title_model {
	public function generate_alias(&$record) {
		return $record->alias = $this->sanitize($record->title);
	}

	private function sanitize($input) {
		$output = strtolower($input);
		$output = preg_replace('/\s+/', '-', $output);
		$output = preg_replace('/[^a-z0-9-._~]/', '', $output);

		return $output;
	}
}
