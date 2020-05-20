<?php

namespace LMS\Model;

use LMS\model;

class category_model extends model {
	function __construct($database, $cache) {
		parent::__construct('category', $database, $cache);
	}
}
