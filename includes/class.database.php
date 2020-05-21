<?php

namespace LMS;

use mysqli;

use PHPunk\Database\schema;

class database extends schema {
	private static $mysql;
	private static $tables;

	private static $instance;

	public static function init($config, $tables) {
		if (!self::$mysql) {
			self::$mysql = self::connect($config);
			self::$tables = $tables;
		}
	}

	public static function load() {
		if (is_null(self::$instance)) {
			if (!($mysql = self::$mysql))
				trigger_error("No database connection", E_USER_ERROR);

			self::$instance = new self($mysql);

			foreach (self::$tables as $table_name => $table_meta) {
				self::$instance->add_table($table_name, @$table_meta->pkey);

				if (isset($table_meta->relations)) {
					foreach ($table_meta->relations as $rel_name => $rel_meta) {
						$rel_meta->ftable = $table_name;

						self::$instance->add_relation(
							$rel_name,
							$rel_meta->ptable,
							$rel_meta->ftable,
							$rel_meta->fkey
						);
					}
				}
			}
		}

		return self::$instance;
	}

	private static function connect($config) {
		$host = $config->hostname('127.0.0.1');
		$user = $config->username;
		$pass = $config->password;
		$db   = $config->database('lms');

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

		return $mysql;
	}
}
