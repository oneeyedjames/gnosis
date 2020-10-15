<?php

namespace LMS\Model;

use LMS\model;
use LMS\title_model;

class series_model extends model {
	use title_model;

	function __construct($database, $cache) {
		parent::__construct('series', $database, $cache);
	}
}
