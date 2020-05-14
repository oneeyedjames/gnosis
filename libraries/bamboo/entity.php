<?php

namespace Bamboo;

interface ArrayLike extends \ArrayAccess, \Iterator, \Countable, \JsonSerializable {}

/**
 * Implements ArrayLike
 */
trait Entity {
	private $data;

	function __get($key) { return $this[$key]; }

	function __set($key, $value) { $this[$key] = $value; }

	function __isset($key) { return isset($this[$key]); }

	function __unset($key) { unset($this[$key]); }

	function offsetGet($key) { return @$this->data[$key]; }

	function offsetSet($key, $value) { $this->data[$key] = $value; }

	function offsetExists($key) { return isset($this->data[$key]); }

	function offsetUnset($key) { unset($this->data[$key]); }

	function current() { return  current($this->data); }

	function key() { return key($this->data); }

	function next() { next($this->data); }

	function rewind() { reset($this->data); }

	function valid() { return key($this->data) != null; }

	function count() { return count($this->data); }

	function jsonSerialize() { return $this->data; }

	protected function load($data = []) {
		if (is_array($data)) {
			$this->data = $data;
		} elseif (is_a($data, 'Iterator')) {
			$this->data = iterator_to_array($data);
		} elseif (is_object($data)) {
			$this->data = get_object_vars($data);
		} elseif (is_string($data)) {
			$this->data = json_decode($data, true);
		}
	}
}
