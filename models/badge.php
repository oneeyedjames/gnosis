<?php

namespace LMS\Model;

use LMS\model;
use LMS\title_model;

class badge_model extends model {
	use title_model;

	function __construct($database, $cache) {
		parent::__construct('badge', $database, $cache);
	}
}
