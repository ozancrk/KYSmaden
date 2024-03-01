<?php

// TARİH TİME ZONE
date_default_timezone_set('Europe/Istanbul');

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'admin_kys');
define('DB_PASSWORD', 'zxdsl831C..');
define('DB_DATABASE', 'admin_kys');

require_once  server_root_dir().'/classes/BasicDB.php';

$dbhost = DB_SERVER;
$dbuser = DB_USERNAME;
$dbpass = DB_PASSWORD;
$dbname = DB_DATABASE;


$db = new BasicDB($dbhost, $dbname, $dbuser, $dbpass,'utf8','main_');
