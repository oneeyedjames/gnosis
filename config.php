<?php

$mysql['host'] = '127.0.0.1';
$mysql['user'] = 'root';
$mysql['pass'] = 'root';
$mysql['db']   = 'lms';

$mysql = new mysqli($mysql['host'], $mysql['user'], $mysql['pass'], $mysql['db']);

if ($mysql->connect_errno)
	trigger_error("MySQL Error #$mysql->connect_errno: $mysql->connect_error", E_USER_ERROR);
