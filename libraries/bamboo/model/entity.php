<?php

namespace Bamboo\Model;

use Bamboo\Entity;
use Bamboo\ArrayLike;

abstract class EntityModel implements Model, ArrayLike {
	use Entity;
}
