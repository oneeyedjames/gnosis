<?php

namespace LMS;

require_once __DIR__ . '/vendor/autoload.php';

require_once __DIR__ . '/reset.php';

define_constants(__DIR__);

require_all(INCLUDE_PATH, [
	'func.*.php',
	'trait.*.php',
	'class.*.php'
]);

require_all(ROOT_PATH, 'models/course.php');
require_all(ROOT_PATH, 'controllers/course.php');

$handler = new error_handler(true);
$handler->register();

header('Content-type: text/plain');

if (!($database = init_database()))
	http_response_code(500);

if (!($cache = init_cache()))
	http_response_code(500);

model::init($database, $cache);

define('IS_LOGIN', 'login' == get_action() || 'login-form' == get_view());
// define('SESSION_USER_ID', init_session());

if ($action = get_action()) {
	$params = controller::load(get_resource())->do_action($action);

	if (is_array($params)) {
		header('Location: ' . build_url($params));
		exit;
	}
}

if (is_api()) {
	if ($resource = get_resource()) {
		if (!($view = get_view()))
			$view = get_record_id() ? 'item' : 'index';

		renderer::load($resource)->render($view);
	} else {
		var_dump('API', $view);
	}
} else {
	// $template = new template(TEMPLATE_PATH);

	// if (!is_ajax())
	// 	$template->load('header');

	if ($resource = get_resource()) {
		if (!($view = get_view()))
			$view = get_resource_id() ? 'item' : 'index';

		var_dump('VIEW', $resource, $view);
		// $template->load($view, $resource);
	} else {
		$view = get_view() ?: 'index';

		var_dump('VIEW', $view);
		// $template->load(get_view() ?: 'index');
	}

	// if (!is_ajax())
	// 	$template->load('footer');
}
