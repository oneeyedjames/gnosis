<?php

namespace LMS\Model;

use LMS\model;

class difficulty_model extends model {
	function __construct($database, $cache) {
		parent::__construct('difficulty', $database, $cache);
	}
}
