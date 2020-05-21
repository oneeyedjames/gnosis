<?php

namespace LMS;

use mysqli;
use Memcached;

use PHPunk\cache;
use PHPunk\url_schema;

use PHPunk\Util\object;

use PHPunk\Database\schema as db_schema;

function init_database() {
	static $database = false;

	if (!$database) {
		$mysql = new object();

		if (is_file($config = CONFIG_PATH . '/mysql.php'))
			require $config;

		$host = $mysql->hostname('127.0.0.1');
		$user = $mysql->username;
		$pass = $mysql->password;
		$db   = $mysql->database('lms');

		$mysql = new mysqli($host, $user, $pass);

		if ($mysql->connect_errno) {
			error_log($mysql->connect_error);
			return false;
		}

		$mysql->set_charset('utf8');

		if ($result = $mysql->query("SHOW DATABASES LIKE '$db'")) {
			if (0 == $result->num_rows) {
				if (!$mysql->query("CREATE DATABASE `$db`"))
					trigger_error($mysql->error);
			}

			$result->close();
		}

		$mysql->select_db($db);

		$database = new db_schema($mysql);

		$tables = json_decode(file_get_contents(ASSET_PATH . '/json/tables.json'));

		foreach ($tables as $table_name => $table_meta) {
			$database->add_table($table_name, @$table_meta->pkey);

			if (isset($table_meta->relations)) {
				foreach ($table_meta->relations as $rel_name => $rel_meta) {
					$rel_meta->ftable = $table_name;

					$database->add_relation(
						$rel_name,
						$rel_meta->ptable,
						$rel_meta->ftable,
						$rel_meta->fkey
					);
				}
			}
		}
	}

	return $database;
}

function init_cache() {
	static $cache = false;

	if (!$cache) {
		// $memcached = new object();
		//
		// if (is_file($config = CONFIG_PATH . '/memcached.php'))
		// 	require $config;
		//
		// $host = $memcached->host('localhost');
		// $port = $memcached->port(11211);
		//
		// $memcached = new Memcached();
		// $memcached->addServer($host, $port);

		$cache = new cache();
	}

	return $cache;
}

function init_url() {
	static $url_schema = false;

	if (!$url_schema) {
		$url_path = $_SERVER['REQUEST_URI'];

		if (($pos = strpos($url_path, '?')) !== false)
			$url_path = substr($url_path, 0, $pos);
		elseif (($pos = strpos($url_path, '#')) !== false)
			$url_path = substr($url_path, 0, $pos);

		$url_schema = new url_schema($_SERVER['HTTP_HOST']);

		$resources = json_decode(file_get_contents(ASSET_PATH . '/json/resources.json'), true);
		$actions = json_decode(file_get_contents(ASSET_PATH . '/json/actions.json'));
		// $views = json_decode(file_get_contents(ASSET_PATH . '/json/views.json'));

		foreach ($resources as $resource => $config) {
			$url_schema->add_resource($resource);

			$aliases = @$config['aliases'] ?: [];
			$actions = @$config['actions'] ?: [];
			$views   = @$config['views']   ?: [];

			foreach ($aliases as $alias)
				$url_schema->add_alias($alias, $resource);

			foreach ($actions as $action)
				$url_schema->add_action($action, $resource);

			foreach ($views as $view)
				$url_schema->add_view($view, $resource);
		}

		foreach ($actions as $action)
			$url_schema->add_action($action);

		// foreach ($views as $view)
		// 	$url_schema->add_view($view);

		$url_params = $url_schema->parse_path($url_path);

		foreach ($url_params as $key => $value)
			$_GET[$key] = $_REQUEST[$key] = $value;

		$_GET['ajax'] = $_REQUEST['ajax'] = @$_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
	}

	return $url_schema;
}
