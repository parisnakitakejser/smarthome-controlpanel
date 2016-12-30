<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
date_default_timezone_set('Europe/Copenhagen');
session_start();

$basePath = str_finish(dirname(__FILE__), '/');

# Path setup
define('ROOT_PATH', $basePath );
define('CONTROLLER_PATH' , ROOT_PATH .'controller/');
define('RESOURCES_PATH' , ROOT_PATH .'resources/');
define('ORM_PATH' , RESOURCES_PATH .'orm/');

# Database setup
define( 'MONGODB_DB_HOST' , 'localhost' );
define( 'MONGODB_DB_PORT' , '27017' );
define( 'MONGODB_DB_NAME' , 'smarthome' );

# Mail settings - config
define('MAIL_SMTP_SERVER', '{smtp-server}');
define('MAIL_SMTP_SERVER_PORT', '{smtp-server-port}');
define('MAIL_SMTP_USERNAME', '{smtp-username}');
define('MAIL_SMTP_PASSWORD', '{smtp-password}');

define('BLADE_VIEWS', ROOT_PATH .'resources/blade/views');
define('BLADE_CACHE', ROOT_PATH .'resources/blade/cache');
?>
