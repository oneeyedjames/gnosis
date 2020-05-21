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

require_all(ROOT_PATH, 'models/*.php');
require_all(ROOT_PATH, 'controllers/*.php');
require_all(ROOT_PATH, 'renderers/*.php');

use PHPunk\cache;
use PHPunk\Util\object;



$mysql = new object();

if (is_file($config = CONFIG_PATH . '/mysql.php'))
	require $config;

$tables = json_decode(file_get_contents(ASSET_PATH . '/json/tables.json'));
database::init($mysql, $tables);



$resources = json_decode(file_get_contents(ASSET_PATH . '/json/resources.json'));
url_schema::init($_SERVER['HTTP_HOST'], $resources);



$url_path   = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$url_params = url_schema::load()->parse_path($url_path);

foreach ($url_params as $key => $value)
	$_GET[$key] = $_REQUEST[$key] = $value;

$_GET['ajax'] = $_REQUEST['ajax'] = @$_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';



model::init(new cache());

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
		$view = get_view() ?: 'index';

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
