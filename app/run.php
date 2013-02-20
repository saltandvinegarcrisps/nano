<?php

/*
 * Set your applications current timezone
 */
date_default_timezone_set(Config::app('timezone', 'UTC'));

/*
 * Define the application error reporting level based on your environment
 * using the ENV constant.
 *
 * You can set the APP_ENV var in your htaccess or webserver to switch
 * between environments or change the code below to detect a url or
 * anthing thing you want ...
 */
switch(constant('ENV')) {
	case 'dev':
		error_reporting(-1);
		break;

	default:
		error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
}

/*
 * Set autoload directories to include your app models and libraries
 */
Autoloader::directory(array(
	APP . 'models',
	APP . 'libraries'
));