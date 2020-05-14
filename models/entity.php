<?php

namespace LMS\Model;

abstract class EntityModel extends \Bamboo\Model\EntityModel {
	const SELECT_QUERY = 'SELECT * FROM `@table`';
	const INSERT_QUERY = 'INSERT INTO `@table` (@fields) VALUES (@params)';
	const UPDATE_QUERY = 'UPDATE `@table` SET @fields WHERE `id` = ?';
	const DELETE_QUERY = 'DELETE FROM `@table` WHERE `id` = ?';

	private static $mysql;

	static function init($mysql) {
		self::$mysql = $mysql;
	}

	protected static function query($query, $values = []) {
		if ($stmt = self::$mysql->prepare($query)) {
			if (count($values)) {
				$params = [''];

				foreach ($values as $value) {
					if (is_bool($value))
						$value = intval($value);

					if (is_int($value))
						$params[0] .= 'i';
					elseif (is_float($value))
						$params[0] .= 'd';
					elseif (is_string($value))
						$params[0] .= 's';

					$params[] = &$value;
				}

				call_user_func_array(array($stmt, 'bind_param'), $params);
			}

			if ($stmt->execute() && $result = $stmt->get_result()) {
				$records = [];

				while ($record = $result->fetch_assoc())
					$records[] = $record;

				return $records;
			} else {
				trigger_error($stmt->error, E_USER_ERROR);
			}

			$stmt->close();
		}

		return false;
	}

	protected static function execute($query, $values) {
		if ($stmt = self::$mysql->prepare($query)) {
			if (count($values)) {
				$params = [''];

				foreach ($values as &$value) {
					if (is_bool($value))
						$value = intval($value);

					if (is_int($value))
						$params[0] .= 'i';
					elseif (is_float($value))
						$params[0] .= 'd';
					elseif (is_string($value))
						$params[0] .= 's';

					$params[] = &$value;
				}

				call_user_func_array(array($stmt, 'bind_param'), $params);
			}

			if (!($result = $stmt->execute()))
				trigger_error(self::$mysql->error, E_USER_ERROR);

			$stmt->close();

			return $result;
		} else {
			trigger_error(self::$mysql->error, E_USER_ERROR);
		}

		return false;
	}

	protected $table;

	function __construct($table, $data = []) {
		$this->table = $table;
		$this->load($data);
	}

	function __get($key) {
		switch ($key) {
			case 'unique_key':
				return $this->alias ?: $this->id;
			default:
				return $this[$key];
		}
	}

	function __set($key, $value) {
		switch ($key) {
			case 'unique_key':
				if (is_numeric($value))
					$this->id = intval($value);
				else
					$this->alias = $value;
				break;
			default:
				$this[$key] = $value;
				break;
		}
	}

	function getAll() {
		$query = str_replace('@table', $this->table, self::SELECT_QUERY);

		if (($result = self::query($query)) !== false) {
			$class = get_class($this);

			return array_map(function($record) use ($class) {
				return new $class($record);
			}, $result);
		}

		return false;
	}

	function getOne() {
		$query = str_replace('@table', $this->table, self::SELECT_QUERY);

		$values = [];

		if (isset($this->id)) {
			$query .= " WHERE `id` = ?";
			$values[] = $this->id;
		} elseif (isset($this->alias)) {
			$query .= " WHERE `alias` = ?";
			$values[] = $this->alias;
		}

		if ($result = self::query($query, $values)) {
			$this->load($result[0]);
			return true;
		}

		return false;
	}

	function create() {
		if ($this->validate()) {
			$fields = [];
			$values = [];

			foreach ($this as $key => $value) {
				if ($key != 'id') {
					$fields[] = "`$key`";
					$values[] = $value;
				}
			}

			$fields = implode(', ', $fields);
			$params = implode(', ', array_fill(0, count($values), '?'));

			$query = str_replace(
				['@table', '@fields', '@params'],
				[$this->table, $fields, $params],
				self::INSERT_QUERY
			);

			if ($result = self::execute($query, $values))
				$this->id = self::$mysql->insert_id;

			return $result;
		}
	}

	function update() {
		if ($this->validate()) {
			$fields = [];
			$values = [];

			foreach ($this as $key => $value) {
				if ($key != 'id') {
					$fields[] = "`$key` = ?";
					$values[] = $value;
				}
			}

			$fields = implode(', ', $fields);
			$values[] = $this->id;

			$query = str_replace(
				['@table', '@fields'],
				[$this->table, $fields],
				self::UPDATE_QUERY
			);

			return self::execute($query, $values);
		}
	}

	function delete() {
		if ($this->validate()) {
			$query = str_replace('@table', $this->table, self::DELETE_QUERY);

			return self::execute($query, [$this->id]);
		}
	}

	abstract protected function validate();
}
