<?php

namespace LMS;

trait badge_model {
	public function get_category(&$record) {
		$model = application::load()->model('category');
		$record->category = $model->get_record($record->category_id);
	}

	public function get_categories(&$records) {
		$ids = $records->map(function($record) {
			return $record->category_id;
		})->toArray();

		$categories = application::load()->model('category')->get_result([
			'args' => ['id' => $ids]
		])->key_map(function($category) {
			return $category->id;
		});

		$records->walk(function(&$record) use ($categories) {
			$record->category = $categories[$record->category_id];
		});
	}

	public function get_difficulty(&$record) {
		$model = application::load()->model('difficulty');
		$record->difficulty = $model->get_record($record->difficulty_id);
	}

	public function get_difficulties(&$records) {
		$ids = $records->map(function($record) {
			return $record->difficulty_id;
		})->toArray();

		$difficulties = application::load()->model('difficulty')->get_result([
			'args' => ['id' => $ids]
		])->key_map(function($difficulty) {
			return $difficulty->id;
		});

		$records->walk(function(&$record) use ($difficulties) {
			$record->difficulty = $difficulties[$record->difficulty_id];
		});
	}
}
