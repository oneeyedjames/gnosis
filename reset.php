<?php

if ('/favicon.ico' == $_SERVER['REQUEST_URI']) {
	http_response_code(404);
	exit;
}

ini_set('default_charset', 'UTF-8');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function define_constants($root) {
	if (defined('ROOT_PATH')) return false;

	define('ROOT_PATH',     $root);
	define('ASSET_PATH',    ROOT_PATH . '/assets');
	define('CONFIG_PATH',   ROOT_PATH . '/configs');
	define('INCLUDE_PATH',  ROOT_PATH . '/includes');
	define('TEMPLATE_PATH', ROOT_PATH . '/templates');

	define('DEFAULT_PAGE',      1);
	define('DEFAULT_PER_PAGE', 12);

	return true;
}


if (!function_exists('require_all')) {
	function require_all($path, $files = []) {
		$path = rtrim($path, '/');

		if (is_string($files)) $files = [$files];

		if (empty($files)) $files[] = '*.php';

		foreach ($files as $file) {
			$file = ltrim($file, '/');

			foreach (glob("$path/$file") as $filepath)
				require_once $filepath;
		}
	}
}
