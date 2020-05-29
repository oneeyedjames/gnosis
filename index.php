<?php

namespace LMS;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/reset.php';

require_all(INCLUDE_PATH, [
	'func.*.php',
	'trait.*.php',
	'class.*.php'
]);

require_all(ROOT_PATH, [
	'models/*.php',
	'controllers/*.php',
	'renderers/*.php'
]);



use PHPunk\Util\object;

$mysql = new object();
if (is_file($config = CONFIG_PATH . '/mysql.php')) require $config;
$tables = json_decode(file_get_contents(ASSET_PATH . '/json/tables.json'));
$resources = json_decode(file_get_contents(ASSET_PATH . '/json/resources.json'));

$application = application::load();
$application->init_database($mysql, $tables);
$application->init_router(REQUEST_HOST, $resources);



$params = $application->router->parse_path(REQUEST_PATH);
foreach ($params as $key => $value)
	$_GET[$key] = $_REQUEST[$key] = $value;

$_GET['ajax'] = $_REQUEST['ajax'] = @$_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';

switch (REQUEST_METHOD) {
	case 'GET':
		break;
	case 'POST':
	case 'PUT':
		$data = file_get_contents('php://input');
		$vars = [];

		switch (REQUEST_TYPE) {
			case 'application/x-www-form-urlencoded':
				parse_str($data, $vars);
				break;
			case 'application/json':
				$vars = json_decode($data, true);
				break;
		}

		foreach ($vars as $key => $value)
			$_POST[$key] = $value;

		$_GET['action'] = $_REQUEST['action'] = 'save';
		break;
	case 'DELETE':
		$_GET['action'] = $_REQUEST['action'] = 'delete';
		break;
}

// define('IS_LOGIN', 'login' == get_action() || 'login-form' == get_view());



if ($action = get_action()) {
	$params = $application->controller(get_resource())->do_action($action);

	if (is_array($params)) {
		header('Location: ' . build_url($params));
		exit;
	}
}

$template = new template(TEMPLATE_PATH);

if (is_api()) {
	if ($resource = get_resource()) {
		if (!($view = get_view()))
			$view = controller::get_record_id() ? 'item' : 'index';

		$template->render($view, $resource);
	} else {
		$view = get_view() ?: 'index';

		$template->render($view);
	}
} else {
	if (!is_ajax())
		$template->load('header');

	if ($resource = get_resource()) {
		if (!($view = get_view()))
			$view = controller::get_record_id() ? 'item' : 'index';

		$template->load($view, $resource);
	} else {
		$view = get_view() ?: 'index';

		$template->load($view);
	}

	if (!is_ajax())
		$template->load('footer');
}
