<?php

namespace LMS;

function disabled($actual, $expected = null) {
	if (is_null($expected) ? $actual : $actual == $expected)
		echo ' disabled="disabled"';
}

function selected($actual, $expected = null) {
	if (is_null($expected) ? $actual : $actual == $expected)
		echo ' selected="selected"';
}

function checked($actual, $expected = null) {
	if (is_null($expected) ? $actual : $actual == $expected)
		echo ' checked="checked"';
}

function page_url($params, $page) {
	$params['page'] = $page;

	return build_url($params);
}

function per_page_url($params, $per_page) {
	$params['per_page'] = $per_page;
	unset($params['page']);

	return build_url($params);
}

function sort_url($params, $key, $order) {
	$params['sort'] = [$key => $order];
	unset($params['page']);

	return build_url($params);
}

function build_url($params) {
	return url_schema::load()->build($params);
}
