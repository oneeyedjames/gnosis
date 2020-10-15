<?php

namespace LMS\Model;

use LMS\model;
use LMS\title_model;

class category_model extends model {
	use title_model;

	function __construct($database, $cache) {
		parent::__construct('category', $database, $cache);
	}
}
