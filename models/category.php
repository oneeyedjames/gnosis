<?php

namespace LMS\Model;

class CategoryModel extends EntityModel {
	function __construct($data = []) {
		parent::__construct('category', $data);
	}

	function validate() { return true; }
}
