<?php

namespace LMS\Model;

trait TitleEntity {
	function createAlias() {
		if (isset($this->title)) {
			$alias = strtolower($this->title);
			$alias = preg_replace('/\s+/', '-', $alias);
			$alias = preg_replace('/[^a-z0-9-._~]/', '', $alias);

			return $this->alias = $alias;
		}
	}
}
