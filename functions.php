<?php

namespace LMS;

function readRequest() {
	define('REQUEST_METHOD', $_SERVER['REQUEST_METHOD']);
	define('REQUEST_URI', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

	define('ACCEPT_TYPE', $_SERVER['HTTP_ACCEPT'] ?: '*/*');
	define('CONTENT_TYPE', @$_SERVER['CONTENT_TYPE']);

	if (in_array(REQUEST_METHOD, ['POST', 'PUT'])) {
		$body = file_get_contents('php://input');

		switch (CONTENT_TYPE) {
			case 'application/json':
			default:
				$body = json_decode($body, true);
				break;
		}

		define('REQUEST_BODY', $body);
	} else {
		define('REQUEST_BODY', null);
	}
}

function requirePath($path, $parent = [], $ext = 'php') {
	if (is_string($parent)) $parent = [$parent];

	foreach ($parent as $file)
		require_once "$path/$file.$ext";

	foreach (glob("$path/*.$ext") as $file)
		require_once $file;
}
