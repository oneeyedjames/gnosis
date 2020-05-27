<?php

namespace LMS;

function get_resource() {
	return application::load()->router->is_resource(@$_GET['resource']);
}

function get_action() {
	return application::load()->router->is_action(@$_GET['action'], @$_GET['resource']);
}

function get_view() {
	return application::load()->router->is_view(@$_GET['view'], @$_GET['resource']);
}

function is_api() {
	return boolval(@$_GET['api']);
}

function is_ajax() {
	return boolval(@$_GET['ajax']);
}
