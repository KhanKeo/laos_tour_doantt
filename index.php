<?php
include_once './config.php';
require_once './Bridge.php';

session_start();
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: Content-Type, x-requested-with');
header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Request-Method: GET, POST');


date_default_timezone_set($GLOBALS['timezone']);

$app = new App();