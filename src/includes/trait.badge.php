<?php

namespace LMS;

trait badge_ctrl_trait {
	function badge_api($vars) {
		if ($record = @$vars[renderer::RECORD]) {
			$category = $this->get_record($record->category_id, 'category');
			$difficulty = $this->get_record($record->difficulty_id, 'difficulty');

			$vars[renderer::EMBEDDED]['category'] = $category;
			$vars[renderer::EMBEDDED]['difficulty'] = $difficulty;
		}

		return $vars;
	}
}

trait badge_model_trait {
	public function populate($result) {
		$category_ids = [];
		$difficulty_ids = [];

		foreach ($result as $record) {
			$category_ids[] = $record->category_id;
			$difficulty_ids[] = $record->difficulty_id;
		}

		$category_ids = array_unique($category_ids);
		$difficulty_ids = array_unique($difficulty_ids);

		$categories = $this->get_result([
			'args' => ['id' => $category_ids]
		], 'category')->key_map(function($category) {
			return $category->id;
		});

		$difficulties = $this->get_result([
			'args' => ['id' => $difficulty_ids]
		], 'difficulty')->key_map(function($difficulty) {
			return $difficulty->id;
		});

		$result->walk(function(&$record) use ($categories, $difficulties) {
			$record->category = $categories[$record->category_id];
			$record->difficulty = $difficulties[$record->difficulty_id];
		});
	}
}
