<?php

namespace LMS;

function get_resource() {
	return application::load()->router->is_resource(@$_GET['resource']);
}

function get_action() {
	return application::load()->router->is_action(@$_GET['action'], @$_GET['resource']);
}

function get_view() {
	$router = application::load()->router;

	if ($resource = get_resource()) {
		if ($view = $router->is_view(@$_GET['view'], $resource))
			return $view;

		return is_numeric(@$_GET['id']) ? 'item' : 'index';
	} else {
		return $router->is_view(@$_GET['view']) ?: 'index';
	}
}

function is_api() {
	return boolval(@$_GET['api']);
}

function is_ajax() {
	return boolval(@$_GET['ajax']);
}
