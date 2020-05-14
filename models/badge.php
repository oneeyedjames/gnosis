<?php

namespace LMS\Model;

trait BadgeEntity {
	function setDefaults() {
		if (empty($this->category_id))
			$this->category_id = 0;

		if (empty($this->difficulty_id))
			$this->difficulty_id = 0;

		if (empty($this->image))
			$this->image = '';
	}
}
