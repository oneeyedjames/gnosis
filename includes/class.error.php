<?php

namespace LMS;

class error_handler {
	private $debug;

	function __construct($debug = false) {
		$this->debug = (bool) $debug;
	}

	function __get($key) {
		switch ($key) {
			case 'debug':
				return $this->debug;
		}
	}

	function __invoke($errno, $error, $file, $line, $context) {
		switch ($errno) {
			case E_ERROR:
			case E_USER_ERROR:
				return $this->error($error, $file, $line);
			case E_WARNING:
			case E_USER_WARNING:
				return $this->warning($error, $file, $line);
			case E_NOTICE:
			case E_USER_NOTICE:
				return $this->notice($error, $file, $line);
		}
	}

	function register() {
		set_error_handler($this);
	}

	function deregister() {
		restore_error_handler();
	}

	protected function error($message, $file, $line) {
		http_response_code(500);
		die("$message in $file on line #$line");
	}

	protected function warning($message, $file, $line) {
		echo "$message\n$file:$line\n";
		if ($this->debug) debug_print_backtrace();
	}

	protected function notice($message, $file, $line) {}
}
