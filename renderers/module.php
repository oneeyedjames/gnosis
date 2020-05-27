<?php

namespace LMS\Renderer;

use LMS\model;
use LMS\renderer;

class module_renderer extends renderer {
	public function __construct() {
		parent::__construct('module');
	}

	protected function map_field_name($field) {
		switch ($field) {
			case 'id':
			case 'title':
			case 'alias':
			case 'image':
			case 'summary':
			case 'position':
				return $field;
		}
	}

	protected function get_links($record) {
		$links = parent::get_links($record);
		$links['lessons'] = [
			'resource' => $this->resource,
			'id' => $record->id,
			'view' => 'lessons'
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
