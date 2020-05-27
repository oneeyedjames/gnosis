<?php

namespace LMS;

use PHPunk\Component\controller as controller_base;

class controller extends controller_base {
	public function __call($func, $args) {
		if (method_exists($this->_model, $func))
			return call_user_func_array([$this->_model, $func], $args);

		trigger_error("Call to undefined method controller::$func()", E_USER_WARNING);
	}
}
