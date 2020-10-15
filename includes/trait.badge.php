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
