<?php

namespace LMS\Model;

use LMS\model;
use LMS\badge_model_trait;
use LMS\title_model_trait;

class badge_model extends model {
	use badge_model_trait, title_model_trait;

	function __construct($database, $cache) {
		parent::__construct('badge', $database, $cache);
	}
}
