<?php

namespace LMS;

trait badge_model {
	public function get_categories(&$records) {
		$ids = $records->map(function($record) {
			return $record->category_id;
		})->toArray();

		$categories = model::load('category')->get_result([
			'args' => ['id' => $ids]
		])->key_map(function($category) {
			return $category->id;
		});

		$records->walk(function(&$record) use ($categories) {
			$record->category = $categories[$record->category_id];
		});
	}

	public function get_difficulties(&$records) {
		$ids = $records->map(function($record) {
			return $record->difficulty_id;
		})->toArray();

		$difficulties = model::load('difficulty')->get_result([
			'args' => ['id' => $ids]
		])->key_map(function($difficulty) {
			return $difficulty->id;
		});

		$records->walk(function(&$record) use ($difficulties) {
			$record->difficulty = $difficulties[$record->difficulty_id];
		});
	}
}
