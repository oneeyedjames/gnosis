<?php

namespace LMS\Model;

use LMS\model;
use LMS\title_model;

class difficulty_model extends model {
	use title_model;

	function __construct($database, $cache) {
		parent::__construct('difficulty', $database, $cache);
	}
}
