<?php

namespace LMS;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/functions.php';

readRequest();

require_once __DIR__ . '/libraries/bamboo/autoload.php';

requirePath(__DIR__ . '/models', ['entity', 'title']);
requirePath(__DIR__ . '/controllers', 'entity');

header('Content-type: application/json');

require_once __DIR__ . '/error.php';
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/router.php';

\LMS\Model\EntityModel::init($mysql);

$router->route(REQUEST_METHOD, REQUEST_URI, REQUEST_BODY);
