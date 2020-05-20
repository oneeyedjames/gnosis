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
		$category = model::load('category')->get_record($record->category_id);
		$difficulty = model::load('difficulty')->get_record($record->difficulty_id);

		return compact('category', 'difficulty');
	}
}
