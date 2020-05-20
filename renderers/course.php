<?php

namespace LMS\Renderer;

use LMS\model;
use LMS\renderer;

class course_renderer extends renderer {
	public function __construct() {
		parent::__construct('course');
	}

	protected function map_field_name($field) {
		switch ($field) {
			case 'id':
			case 'title':
			case 'alias':
			case 'image':
			case 'summary':
				return $field;
		}
	}

	protected function get_links($record) {
		$links = parent::get_links($record);
		$links['modules'] = [
			'resource' => 'module',
			'filter'  => [
				'course' => $record->id
			]
		];

		return $links;
	}

	protected function get_embeds($record) {
		$embeds = parent::get_embeds($record);

		if (isset($record->category))
			$embeds['category'] = $record->category;

		if (isset($record->difficulty))
			$embeds['difficulty'] = $record->difficulty;

		return $embeds;
	}
}
